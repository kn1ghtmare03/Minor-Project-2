from flask import Flask, render_template, request
import pyaudio
import numpy as np
import pandas as pd
import torch
import whisper
import tabula
from langchain.embeddings.openai import OpenAIEmbeddings
from langchain.text_splitter import CharacterTextSplitter
from langchain.vectorstores import ElasticVectorSearch, Pinecone, Weaviate, FAISS
from langchain.chains.question_answering import load_qa_chain
from langchain.llms import OpenAI

import os
os.environ["OPENAI_API_KEY"] = "************"

model = whisper.load_model("small.en")
app = Flask(__name__)

@app.route('/')
def home():
    return render_template('index.html')
@app.route('/login.html', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        sapid = request.form['sapid']
        password = request.form['password']
        return f'Logged in as {sapid}'
    else:
        return render_template('login.html')
filename=""
@app.route('/upload', methods=['POST'])
def upload():
    global filename
    file = request.files['file']
    filename = file.filename
    file.save(filename)
    print(filename)
    return "File uploaded successfully"

@app.route('/transcribe', methods=['POST'])
def speak():
    # p = pyaudio.PyAudio()
    # FORMAT = pyaudio.paInt16
    # CHANNELS = 1
    # RATE = 16000
    # CHUNK = int(RATE/10)  # 100 ms

    # stream = p.open(format=FORMAT,
    #                 channels=CHANNELS,
    #                 rate=RATE,
    #                 input=True,
    #                 frames_per_buffer=CHUNK)
    # audio = np.array([], dtype=np.int16)

    # for i in range(int(RATE/CHUNK * 3)):
    #     data = stream.read(CHUNK)
    #     audio = np.append(audio, np.frombuffer(data, dtype=np.int16))

    # torch_audio = torch.from_numpy(audio.flatten().astype(np.float32) / 32768.0)

    files = request.files
    audioFile = files.get('audio_data')
    result = model.transcribe(audioFile)
    query = result["text"]
    stream.stop_stream()
    stream.close()
    p.terminate()
    print(query)
    
    path=filename
    table = tabula.read_pdf(path, pages=1, encoding="ISO-8859-1")
    df = pd.DataFrame(table[1])
    result = ""
    for column in df.columns[1:]:
        result += column + ": " + df[column].astype(str).str.cat() + "\n"
    result = result.replace("nan","")

    texts =result.split("\n")
    embeddings = OpenAIEmbeddings()
    docsearch = FAISS.from_texts(texts, embeddings)
    chain = load_qa_chain(OpenAI(), chain_type="stuff")
    docs = docsearch.similarity_search(query)
    res=chain.run(input_documents=docs, question=query)
    return {"text": res}

if __name__ == '__main__':
    app.run(debug=True)
