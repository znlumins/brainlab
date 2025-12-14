<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    // Menampilkan Halaman Frontend
    public function index()
    {
        return view('analysis');
    }

    // API Bridge: Frontend -> Laravel -> Python
    public function predict(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:10240', // Max 10MB
        ]);

        try {
            $image = $request->file('image');

            // Kirim request ke Python (Flask)
            $response = Http::attach(
                'image', 
                file_get_contents($image), 
                $image->getClientOriginalName()
            )->timeout(30)->post('http://127.0.0.1:5000/predict');

            // Cek jika Python mati/error
            if ($response->failed()) {
                return response()->json([
                    'error' => 'Gagal koneksi ke AI Engine. Pastikan app.py berjalan.'
                ], 500);
            }

            // Kembalikan JSON hasil deteksi ke Frontend
            return response()->json($response->json());

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error: ' . $e->getMessage()
            ], 500);
        }
    }
}