from flask import Flask, render_template, request, jsonify
import pyaudio
import numpy as np
import pandas as pd
import torch
import whisper
import tabula
import librosa
from langchain.embeddings.openai import OpenAIEmbeddings
from langchain.text_splitter import CharacterTextSplitter
from langchain.vectorstores import ElasticVectorSearch, Pinecone, Weaviate, FAISS
from langchain.chains.question_answering import load_qa_chain
from langchain.llms import OpenAI
import os
os.environ["OPENAI_API_KEY"] = "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"
os.environ['SERPAPI_API_KEY']="fe813d3e3091f31428eb2bf2f0631487f48c9cd5ddbd663f073c90d894068c63"

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
    print(audioFile)
    audioData, sr = librosa.load(audioFile)
    audio_tensor = torch.from_numpy(np.array(audioData))
    result = model.transcribe(audio_tensor)
    query = result["text"]
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
    data ={"text": res}
    return jsonify(data)

if __name__ == '__main__':
    app.run(debug=True)
    embeddings = OpenAIEmbeddings()
