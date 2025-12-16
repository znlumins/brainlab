<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Client\ConnectionException;
use Exception;

class ChatController extends Controller
{
    /**
     * Menampilkan halaman konsultasi.
     */
    public function showChat()
    {
        return view('consultation');
    }

    /**
     * Memproses pesan chat dan mengirimkannya ke Groq API.
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'messages' => 'required|array',
        ]);

        try {
            $messages = $request->input('messages');

            
            $systemPrompt = "Kamu adalah 'BrainLab AI', sebuah asisten AI informasional yang khusus dirancang untuk memberikan penjelasan tentang kesehatan tumor otak dan neuro-onkologi.

PERINGATAN UTAMA: Kamu BUKAN PENGGANTI DOKTER. Setiap jawaban harus diakhiri dengan disclaimer tegas untuk berkonsultasi dengan profesional medis.

ATURAN WAJIB:
1.  PERAN: Kamu adalah navigator informasi, bukan pemberi diagnosis atau saran medis. Tugasmu adalah menyederhanakan istilah medis yang kompleks, menjelaskan opsi perawatan secara umum, dan memberikan informasi tentang penelitian terkini.
2.  GAYA BAHASA: Empatis, klinis, jelas, dan tenang. Hindari bahasa yang terlalu teknis tanpa penjelasan. Gunakan analogi jika memungkinkan.
3.  LARANGAN KERAS:
    - JANGAN PERNAH memberikan diagnosis.
    - JANGAN PERNAH menyarankan dosis obat atau mengubah rencana perawatan.
    - JANGAN PERNAH memberikan prognosis (prediksi harapan hidup).
4.  FOKUS KONTEN: Jelaskan 'apa', 'mengapa', dan 'bagaimana' terkait pertanyaan pengguna. Contoh: Apa itu kemoterapi Temozolomide?, Bagaimana cara kerja radioterapi?, Jelaskan perbedaan antara tumor jinak dan ganas.
5.  DISCLAIMER AKHIR: Setiap respons, tanpa kecuali, harus diakhiri dengan variasi dari kalimat ini:
    Penting: Informasi ini bersifat edukatif dan tidak menggantikan konsultasi medis profesional. Selalu diskusikan semua pertanyaan dan keputusan mengenai kesehatan Anda dengan dokter atau tim onkologi Anda.
6. JANGAN SAMPAI ADA SIMBOL * _ - DALAM JAWABANMU.
Jika pengguna bertanya siapa yang membuatmu, jawab: Saya adalah bagian dari platform BrainLab, yang dikembangkan untuk membantu navigasi informasi kesehatan.
";

            $payloadMessages = array_merge([['role' => 'system', 'content' => $systemPrompt]], $messages);

            
            $apiKey = env('GROQ_API_KEY', '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'); 
            
            $model = 'llama-3.1-8b-instant';

            return new StreamedResponse(function () use ($payloadMessages, $apiKey, $model) {
                try {
                    $response = Http::withToken($apiKey)
                        ->withoutVerifying() 
                        ->timeout(300)
                        ->withOptions(['stream' => true])
                        ->post('https://api.groq.com/openai/v1/chat/completions', [
                            'model' => $model,
                            'messages' => $payloadMessages,
                            'temperature' => 0.5,
                            'stream' => true,
                        ]);

                    if (!$response->successful()) {
                         echo "data: {\"error\": \"Gagal terhubung ke Groq API. Status: " . $response->status() . ", Body: " . $response->body() . "\"}\n\n";
                         ob_flush(); flush(); return;
                    }

                    $stream = $response->getBody()->detach();
                    header('Content-Type: text/event-stream'); header('Cache-Control: no-cache'); header('X-Accel-Buffering: no');
                    while ($chunk = fgets($stream)) { echo $chunk; ob_flush(); flush(); }
                    fclose($stream);

                } catch (ConnectionException $e) {
                    $errorMessage = "Kesalahan Koneksi Jaringan: " . $e->getMessage();
                    echo "data: {\"error\": \"" . addslashes($errorMessage) . "\"}\n\n";
                    ob_flush(); flush();
                } catch (Exception $e) {
                    $errorMessage = "Error Internal: " . $e->getMessage();
                    echo "data: {\"error\": \"" . addslashes($errorMessage) . "\"}\n\n";
                    ob_flush(); flush();
                }
            });

        } catch (Exception $e) {
            return response()->json(['error' => 'Error sebelum stream: ' . $e->getMessage()], 500);
        }
    }
}