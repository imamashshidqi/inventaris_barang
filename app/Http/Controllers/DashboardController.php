<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function checkReplicationStatus()
    {
        // 1. Tentukan sebuah kunci unik untuk cache kita
        $cacheKey = 'replication_status_is_ok';

        // 2. Periksa apakah status 'OK' sudah tersimpan di cache
        if (Cache::has($cacheKey)) {
            // Jika ADA, langsung kembalikan response sukses tanpa perlu query ke database.
            // Inilah bagian "tidak memeriksa status lagi".
            return response()->json([
                'connected' => true,
                'message' => 'Replikasi terhubung (Status dari Cache).',
                'details' => null, // Tidak ada detail karena kita tidak query ke DB
            ]);
        }

        // 3. JIKA TIDAK ADA DI CACHE, baru kita lanjutkan pengecekan ke database
        $replicationStatus = [
            'connected' => false,
            'message' => 'Replikasi tidak aktif atau gagal diperiksa.',
            'details' => null,
        ];

        try {
            $status = DB::select('SHOW SLAVE STATUS');

            if (!empty($status)) {
                $slaveStatus = $status[0];
                $replicationStatus['details'] = $slaveStatus;

                if ($slaveStatus->Slave_IO_Running == 'Yes' && $slaveStatus->Slave_SQL_Running == 'Yes') {
                    $replicationStatus['connected'] = true;
                    $replicationStatus['message'] = 'Replikasi Master-Master terhubung dan berjalan lancar.';

                    // 4. KARENA STATUSNYA BAIK, kita simpan ke cache
                    // Simpan nilai 'true' dengan kunci '$cacheKey' selama 10 detik.
                    Cache::put($cacheKey, true, now()->addSeconds(10));
                } else {
                    $replicationStatus['message'] = 'Replikasi terkonfigurasi tetapi tidak berjalan!';
                    // Kita tidak menyimpan status buruk ke cache, agar sistem mencoba lagi nanti.
                }
            }
        } catch (\Exception $e) {
            Log::error('Gagal memeriksa status replikasi: ' . $e->getMessage());
            $replicationStatus['message'] = 'Gagal memeriksa status replikasi. Periksa log aplikasi.';
        }

        // 5. Kembalikan hasil pengecekan yang sebenarnya (karena tidak ada di cache)
        return response()->json($replicationStatus);
    }
}
