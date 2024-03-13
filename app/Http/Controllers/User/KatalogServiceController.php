<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KatalogServiceController extends Controller
{
    public function index()
    {
        $responseGetDataTagihan = '{
            "status": true,
            "message": "Data tagihan ditemukan",
            "data": [
                {
                    "nopembayaran": "K-240313-00335588",
                    "nokuitansi": "24031300335588",
                    "nobuktibayar": "2848/BKM/III/2024",
                    "totalbiayapelayanan": "100000",
                    "nama_pasien": "Adzana Shaliha",
                    "no_rekam_medik": "123456",
                    "alamat_pasien": "KELING",
                    "jeniskelamin": "PEREMPUAN",
                    "tanggal_lahir": "2023-10-19",
                    "usia": "0",
                    "ruangan_nama": "POLI ANAK",
                    "tgl_pendaftaran": "2024-03-13 08:24:50"
                }
            ]
        }';

        return view('template-dashboard.layouts.katalog-service.index', [
            'responseGetDataTagihan'    => $responseGetDataTagihan,
        ]);
    }
}
