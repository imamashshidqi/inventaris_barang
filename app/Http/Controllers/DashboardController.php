<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    //
}


public function checkReplicationStatus()
{
    $replicationStatus = [
        'connected' => false,
        'message' => 'Replikasi tidak aktif atau gagal diperiksa.',
        'details' => null,
    ];

    try {
        // Ganti SHOW SLAVE STATUS dengan SHOW REPLICA STATUS jika menggunakan MySQL 8+
        $status = DB::select('SHOW SLAVE STATUS');

        if (!empty($status)) {
            $slaveStatus = $status[0];
            $replicationStatus['details'] = $slaveStatus; // Kirim semua detail ke view

            if ($slaveStatus->Slave_IO_Running == 'Yes' && $slaveStatus->Slave_SQL_Running == 'Yes') {
                $replicationStatus['connected'] = true;
                $replicationStatus['message'] = 'Replikasi Master-Master terhubung dan berjalan lancar.';
            } else {
                $replicationStatus['message'] = 'Replikasi terkonfigurasi tetapi tidak berjalan! Periksa log.';
            }
        }
    } catch (\Exception $e) {
        // Tangani error jika user DB tidak punya permission atau koneksi gagal
        Log::error('Gagal memeriksa status replikasi: ' . $e->getMessage());
        $replicationStatus['message'] = 'Gagal memeriksa status replikasi. Periksa log aplikasi.';
    }

    // Kembalikan sebagai JSON untuk di-fetch oleh AJAX
    return response()->json($replicationStatus);
}