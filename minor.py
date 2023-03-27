import pyaudio
import numpy as np
import torch
import whisper

model = whisper.load_model("base.en")
p = pyaudio.PyAudio()

FORMAT = pyaudio.paInt16
CHANNELS = 1
RATE = 16000
CHUNK = int(RATE/10)  # 100 ms

stream = p.open(format=FORMAT,
                channels=CHANNELS,
                rate=RATE,
                input=True,
                frames_per_buffer=CHUNK)

print("Speak!")

audio = np.array([], dtype=np.int16)

for i in range(int(RATE/CHUNK * 3)):
    data = stream.read(CHUNK)
    audio = np.append(audio, np.frombuffer(data, dtype=np.int16))

torch_audio = torch.from_numpy(audio.flatten().astype(np.float32) / 32768.0)

result = model.transcribe(torch_audio)
predicted_text = result["text"]
print(predicted_text)
stream.stop_stream()
stream.close()
p.terminate()
