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
                    "nopembayaran": "K-240419-258",
                    "nokuitansi": "240419258",
                    "nobuktibayar": "4238/BKM/IV/2024",
                    "totalbiayapelayanan": "1198942",
                    "nama_pasien": "SAKIJAN",
                    "no_rekam_medik": "124448",
                    "tanggal_lahir": "1959-11-15",
                    "ruangan_nama": "ANYELIR",
                    "tgl_pendaftaran": "2024-04-16 22:49:14"
                },
                {
                    "nopembayaran": "K-240419-257",
                    "nokuitansi": "240419257",
                    "nobuktibayar": "4237/BKM/IV/2024",
                    "totalbiayapelayanan": "161869",
                    "nama_pasien": "SILVIA AULIA ANISA",
                    "no_rekam_medik": "124294",
                    "tanggal_lahir": "2009-04-12",
                    "ruangan_nama": "POLI ANAK",
                    "tgl_pendaftaran": "2024-04-18 12:14:56"
                },
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
                    "tanggal_lahir": "2023-10-19",
                    "ruangan_nama": "POLI ANAK",
                    "tgl_pendaftaran": "2024-03-13 08:24:50"
                }
            ]
        }';

        $responseIsPaid = '{
            "status": true,
            "message": "Tagihan nomor medis tersebut sudah lunas"
        }';

        $responseRequiredNoMedis = '{
            "status": false,
            "message": "Parameter nomor rekam medis tidak ditemukan"
        }';

        $responseGetTagihanNotInclucdeParameter = '{
            "status": false,
            "message": "Parameter nomor rekam medis tidak ditemukan"
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
            'responseGetTagihanPaid'                    => $responseIsPaid,
            'responseRequiredNoMedis'                   => $responseRequiredNoMedis,
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
