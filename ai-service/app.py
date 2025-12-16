# File: ai-service/app.py
from flask import Flask, request, jsonify
from ultralytics import YOLO
import cv2
import numpy as np

app = Flask(__name__)

# --- CONFIG ---
MODEL_PATH = 'best.pt' 
# --------------

print(f"Loading model {MODEL_PATH}...")
try:
    model = YOLO(MODEL_PATH)
    print("Model loaded successfully!")
except Exception as e:
    print(f"ERROR: Gagal load model. Pastikan file '{MODEL_PATH}' ada.")
    print(e)
    exit(1)

@app.route('/predict', methods=['POST'])
def predict():
    try:
        # 1. Cek file
        if 'image' not in request.files:
            return jsonify({'error': 'No image uploaded'}), 400
            
        file = request.files['image']
        
        # 2. Convert gambar untuk OpenCV
        img_bytes = file.read()
        nparr = np.frombuffer(img_bytes, np.uint8)
        img = cv2.imdecode(nparr, cv2.IMREAD_COLOR)

        # 3. Prediksi
        results = model(img)

        # 4. Format Output (JSON)
        detections = []
        for result in results:
            for box in result.boxes:
                # Kita pakai xywhn (Normalized: 0.0 - 1.0) agar responsif di frontend
                x, y, w, h = box.xywhn[0].tolist()
                conf = float(box.conf[0])
                cls = int(box.cls[0])
                label = model.names[cls]
                
                detections.append({
                    'label': label,
                    'conf': conf,
                    'x': x, # Titik tengah X (persen)
                    'y': y, # Titik tengah Y (persen)
                    'w': w, # Lebar (persen)
                    'h': h  # Tinggi (persen)
                })
        
        return jsonify(detections)
    
    except Exception as e:
        print(f"Error processing: {str(e)}")
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(host='127.0.0.1', port=5000)