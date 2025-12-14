import sys
import json
import os

# MATIKAN LOG ULTRALYTICS (PENTING BIAR GAK ERROR JSON)
os.environ["YOLO_VERBOSE"] = "False"

# Fungsi print aman untuk Windows (biar gak error encoding aneh-aneh)
def safe_print(data):
    try:
        print(json.dumps(data))
    except Exception as e:
        print(json.dumps({"error": "Encoding Error: " + str(e)}))

try:
    # Import library setelah environment variable diset
    from ultralytics import YOLO

    # Cek Argumen
    if len(sys.argv) < 3:
        safe_print({"error": "Missing arguments. Usage: python run_ai.py <image> <model>"})
        sys.exit(1)

    image_path = sys.argv[1]
    model_path = sys.argv[2]

    # Cek File Model
    if not os.path.exists(model_path):
        safe_print({"error": f"Model file not found: {model_path}"})
        sys.exit(1)

    # Load Model
    model = YOLO(model_path)

    # Jalankan Prediksi (verbose=False BIAR DIEM)
    results = model(image_path, verbose=False)

    output_data = []
    
    # Format Hasil
    for result in results:
        for box in result.boxes:
            x, y, w, h = box.xywhn[0].tolist()
            conf = float(box.conf)
            cls = int(box.cls)
            label = model.names[cls] if model.names else str(cls)

            output_data.append({
                "x": x, "y": y, "w": w, "h": h,
                "conf": conf,
                "label": label
            })

    # Cetak JSON Murni
    safe_print(output_data)

except Exception as e:
    # Tangkap error apapun dan jadikan JSON
    safe_print({"error": str(e)})