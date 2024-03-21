<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KatalogServiceController extends Controller
{
    public function index()
    {
        $responseGetAllTagihan = '{
            "status": true,
            "message": "Data tagihan ditemukan",
            "data": [
                {
                    "nopembayaran": "K-240321-001",
                    "nokuitansi": "240321001",
                    "nobuktibayar": "5204/BKM/III/2024",
                    "totalbiayapelayanan": "115201.18",
                    "nama_pasien": "Iwabe Yuino",
                    "no_rekam_medik": "123550",
                    "alamat_pasien": "PAYAK",
                    "jeniskelamin": "LAKI-LAKI",
                    "tanggal_lahir": "1995-01-08",
                    "usia": "29",
                    "ruangan_nama": "IGD KELET",
                    "tgl_pendaftaran": "2024-03-21 00:13:08"
                },
                {
                    "nopembayaran": "K-240321-002",
                    "nokuitansi": "240321002",
                    "nobuktibayar": "5205/BKM/III/2024",
                    "totalbiayapelayanan": "500258.02",
                    "nama_pasien": "Shikamaru",
                    "no_rekam_medik": "633005",
                    "alamat_pasien": "Konoha",
                    "jeniskelamin": "LAKI-LAKI",
                    "tanggal_lahir": "1993-06-08",
                    "usia": "29",
                    "ruangan_nama": "Poli Klinik Gigi",
                    "tgl_pendaftaran": "2024-03-21 09:13:08"
                }
            ]
        }';

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

        $responseGetTagihanNotInclucdeParameter = '{
            "status": false,
            "message": "Parameter nomor medis tidak ditemukan"
        }';

        $responseGetTagihanTidakDitemukan = '{
            "status": false,
            "message": "Data tagihan tidak ditemukan"
        }';

        $responseFlag = '{
            "status": true,
            "message": "Process flag payment is successfuly"
        }';

        $responseFlagStatusFull = '{
            "status": false,
            "message": "Process flag payment is failed, payment status in full"
        }';

        $responseFlagNoPembayaranFail = '{
            "status": false,
            "message": "Nomor medis tidak sesuai"
        }';

        $responseFlagRequired = '{
            "status": false,
            "message": "Process flag payment is failed",
            "data": {
                "nopembayaran": [
                    "The nopembayaran field is required."
                ],
                "nokuitansi": [
                    "The nokuitansi field is required."
                ],
                "nobuktibayar": [
                    "The nobuktibayar field is required."
                ],
                "totalbiayapelayanan": [
                    "The totalbiayapelayanan field is required."
                ],
                "nama_pasien": [
                    "The nama pasien field is required."
                ],
                "no_rekam_medik": [
                    "The no rekam medik field is required."
                ],
                "tanggal_lahir": [
                    "The tanggal lahir field is required."
                ],
                "tgl_pendaftaran": [
                    "The tgl pendaftaran field is required."
                ],
                "status_payment": [
                    "The status payment field is required."
                ]
            }
        }';

        $responseReversal = '{
            "status": true,
            "message": "Process flag reversal is successfuly"
        }';

        $responseReversalRequired = '{
            "status": false,
            "message": "Process reversal is failed",
            "data": {
                "nopembayaran": [
                    "The nopembayaran field is required."
                ],
                "nokuitansi": [
                    "The nokuitansi field is required."
                ],
                "nobuktibayar": [
                    "The nobuktibayar field is required."
                ],
                "totalbiayapelayanan": [
                    "The totalbiayapelayanan field is required."
                ],
                "nama_pasien": [
                    "The nama pasien field is required."
                ],
                "no_rekam_medik": [
                    "The no rekam medik field is required."
                ],
                "tanggal_lahir": [
                    "The tanggal lahir field is required."
                ],
                "tgl_pendaftaran": [
                    "The tgl pendaftaran field is required."
                ],
                "status_reversal": [
                    "The status reversal field is required."
                ]
            }
        }';

        $responseReversalNotFound = '{
            "status": false,
            "message": "Data reversal tidak ditemukan"
        }';

        return view('template-dashboard.layouts.katalog-service.index', [
            'responseGetAllTagihan'                     => $responseGetAllTagihan,
            'responseGetDataTagihan'                    => $responseGetDataTagihan,
            'responseGetTagihanNotInclucdeParameter'    => $responseGetTagihanNotInclucdeParameter,
            'responseGetTagihanTidakDitemukan'          => $responseGetTagihanTidakDitemukan,
            'responseFlag'                              => $responseFlag,
            'responseFlagStatusFull'                    => $responseFlagStatusFull,
            'responseFlagNoPembayaranFail'              => $responseFlagNoPembayaranFail,
            'responseFlagRequired'                      => $responseFlagRequired,
            'responseReversal'                          => $responseReversal,
            'responseReversalRequired'                  => $responseReversalRequired,
            'responseReversalNotFound'                  => $responseReversalNotFound
        ]);
    }
}
