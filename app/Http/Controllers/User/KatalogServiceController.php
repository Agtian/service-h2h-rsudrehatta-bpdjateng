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
