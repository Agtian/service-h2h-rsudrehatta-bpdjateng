<?php

namespace App\Http\Controllers\Api;

use App\Helpers\SMSHelper;
use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use App\Models\LogPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TagihanPasienController extends Controller
{
    public function getTagihanPasien($key, $nomedis_or_notagihan)
    {
        $apiKeys = ApiKey::where('key', $key)->first();
        if ($apiKeys->status_key == 1) {
            // Jika production menampilkan data hanya pembayaran kategori BPD Jateng
            $dataQueryByNoPembayaran = DB::connection('pgsql')->select("SELECT jnspembayar_m.jnspembayar_nama, nopembayaran, concat(substring(nopembayaran, 3, 6),
                substring(nopembayaran, 10, 3)) AS nokuitansi, nobuktibayar, totalbiayapelayanan, nama_pasien, no_rekam_medik, tanggal_lahir, extract('YEAR' FROM age(tgl_pendaftaran, ruangan_nama, tgl_pendaftaran
                FROM public.informasipasiensudahbayar_v
                LEFT JOIN jenispembayaran_t on informasipasiensudahbayar_v.tandabuktibayar_id  = jenispembayaran_t.tandabuktibayar_id
                LEFT JOIN jnspembayar_m on jenispembayaran_t.jnspembayar_id = jnspembayar_m.jnspembayar_id
                WHERE jenispembayaran_t.jnspembayar_id = 11 -- BPD JATENG
                    AND concat(substring(nopembayaran, 3, 6), substring(nopembayaran, 10, 3)) = '$nomedis_or_notagihan'
                    AND cast(tglpembayaran AS DATE) = current_date
                ORDER BY tglpembayaran  DESC");

            if (count($dataQueryByNoPembayaran) === 0) {
                $dataQueryByNoMedis = DB::connection('pgsql')->select("SELECT jnspembayar_m.jnspembayar_nama, nopembayaran, concat(substring(nopembayaran, 3, 6),
                substring(nopembayaran, 10, 3)) AS nokuitansi, nobuktibayar, totalbiayapelayanan, nama_pasien, no_rekam_medik, tanggal_lahir, extract('YEAR' FROM age(tgl_pendaftaran, ruangan_nama, tgl_pendaftaran
                FROM public.informasipasiensudahbayar_v
                LEFT JOIN jenispembayaran_t on informasipasiensudahbayar_v.tandabuktibayar_id  = jenispembayaran_t.tandabuktibayar_id
                LEFT JOIN jnspembayar_m on jenispembayaran_t.jnspembayar_id = jnspembayar_m.jnspembayar_id
                WHERE jenispembayaran_t.jnspembayar_id = 11 -- BPD JATENG
                    AND cast(tglpembayaran AS DATE) = current_date
                    AND no_rekam_medik = '$nomedis_or_notagihan'
                ORDER BY tglpembayaran  DESC");

                return $dataQueryByNoMedis;
            } else {
                return $dataQueryByNoPembayaran;
            }
        } else {
            // Jika development
            $dataQueryByNoPembayaran = DB::connection('pgsql')->select("SELECT nopembayaran, concat(substring(nopembayaran, 3, 6),
            substring(nopembayaran, 10, 3)) AS nokuitansi, nobuktibayar, totalbiayapelayanan, nama_pasien, no_rekam_medik, tanggal_lahir, ruangan_nama, tgl_pendaftaran
            FROM public.informasipasiensudahbayar_v
            WHERE concat(substring(nopembayaran, 3, 6), substring(nopembayaran, 10, 3)) = '$nomedis_or_notagihan'
                AND cast(tglpembayaran AS DATE) = current_date
            ORDER BY tglpembayaran  DESC");

            if (count($dataQueryByNoPembayaran) === 0) {
                $dataQueryByNoMedis = DB::connection('pgsql')->select("SELECT nopembayaran, concat(substring(nopembayaran, 3, 6),
                substring(nopembayaran, 10, 3)) AS nokuitansi, nobuktibayar, totalbiayapelayanan, nama_pasien, no_rekam_medik, tanggal_lahir, ruangan_nama, tgl_pendaftaran
                FROM public.informasipasiensudahbayar_v
                    WHERE cast(tglpembayaran AS DATE) = current_date
                    and no_rekam_medik = '$nomedis_or_notagihan'
                ORDER BY tglpembayaran  DESC");

                return $dataQueryByNoMedis;
            } else {
                return $dataQueryByNoPembayaran;
            }
        }
    }

    public function getBiodataPasien($nomormedis)
    {
        $query = DB::connection('pgsql')->select("SELECT alamat_pasien, jeniskelamin, extract('YEAR' FROM age(tgl_pendaftaran, tanggal_lahir)) AS usia
                     FROM public.informasipasiensudahbayar_v
                    WHERE no_rekam_medik = '$nomormedis'
                        AND cast(tglpembayaran AS DATE) = current_date
                    ORDER BY tglpembayaran  DESC");
    }

    public function detailStatusPayment($status_payment)
    {
        if ($status_payment == 0) {
            $response = [
                'status'    => 'false',
                'message'   => 'Belum bayar'
            ];
        } elseif ($status_payment == 1) {
            $response = [
                'status'    => 'true',
                'message'   => 'Lunas'
            ];
        } elseif ($status_payment == 2) {
            $response = [
                'status'    => 'false',
                'message'   => 'Batal bayar'
            ];
        }

        return $response;
    }

    public function detailStatusReversal($status_reversal)
    {
        if ($status_reversal == 0) {
            $response = [
                'status'    => 'false',
                'message'   => 'Connection time out'
            ];
        } elseif ($status_reversal == 1) {
            $response = [
                'status'    => 'true',
                'message'   => 'Connceted'
            ];
        }

        return $response;
    }

    public function patientBill(Request $request)
    {
        $apiKeys = ApiKey::where('key', $request->header('api_key'))->first();
        if ($apiKeys->status_key == 1) {
            // Jika production maka tidak boleh akses
            return response()->json([
                'status'    => false,
                'message'   => 'API Key Production akses dibatasi.',
            ], 401);
        }

        $dataQuery = DB::connection('pgsql')->select("SELECT nopembayaran, concat(substring(nopembayaran, 3, 6),
                            substring(nopembayaran, 10, 3)) AS nokuitansi, nobuktibayar, totalbiayapelayanan, nama_pasien, no_rekam_medik, tanggal_lahir, ruangan_nama, tgl_pendaftaran
                            FROM public.informasipasiensudahbayar_v
                                WHERE cast(tglpembayaran AS DATE) = current_date
                            ORDER BY tglpembayaran  DESC
                            LIMIT 2");

        if ($dataQuery == null) {
            return response()->json([
                'status'    => false,
                'message'   => 'Data tagihan tidak ditemukan',
            ], 401);
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Data tagihan ditemukan',
            'data'      => $dataQuery
        ], 200);
    }

    public function patientBillById(Request $request)
    {
        $key        = $request->header('api_key');
        $dataQuery  = $this->getTagihanPasien($key, $request->nomormedis);

        if ($request->nomormedis == null) {
            return response()->json([
                'status'    => false,
                'message'   => 'Parameter nomor medis tidak ditemukan',
            ], 401);
        }

        if ($dataQuery == null) {
            return response()->json([
                'status'    => false,
                'message'   => 'Data tagihan tidak ditemukan',
            ], 401);
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Data tagihan ditemukan',
            'data'      => $dataQuery
        ], 200);
    }

    public function storeResponseFlag(Request $request)
    {
        $rules = [
            'nopembayaran'          => 'required',
            'nokuitansi'            => 'required',
            'nobuktibayar'          => 'required',
            'totalbiayapelayanan'   => 'required',
            'nama_pasien'           => 'required',
            'no_rekam_medik'        => 'required',
            'tanggal_lahir'         => 'required',
            'tgl_pendaftaran'       => 'required',
            'status_payment'        => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        $dataQuery = $this->getTagihanPasien($request->header('api_key'), $request->nokuitansi);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag payment is failed',
                'data'      => $validator->errors()
            ], 401);
        }

        if ($dataQuery == null) {
            return response()->json([
                'status'    => false,
                'message'   => 'Data tagihan tidak ditemukan',
            ], 401);
        }

        $queryLogPayments = LogPayment::select('id', 'nokuitansi', 'status_payment')
            ->where('nokuitansi', $request->nokuitansi)
            ->first();

        if ($queryLogPayments != null) {
            if ($queryLogPayments->status_payment == 1) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Process flag payment is failed, payment status in full',
                ], 401);
            }
        }

        if ($dataQuery[0]->nopembayaran != $request->nopembayaran) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag payment is failed',
                'data'      => [
                    'nopembayaran' => ['Nomor pembayaran tidak sesuai']
                ]
            ], 401);
        }

        if ($dataQuery[0]->nobuktibayar != $request->nobuktibayar) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag payment is failed',
                'data'      => [
                    'nobuktibayar' => ['Nomor bukti bayar tidak sesuai']
                ]
            ], 401);
        }

        if ($dataQuery[0]->totalbiayapelayanan != $request->totalbiayapelayanan) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag payment is failed',
                'data'      => [
                    'totalbiayapelayanan' => ['Total biaya tidak sesuai']
                ]
            ], 401);
        }

        if ($dataQuery[0]->nama_pasien != $request->nama_pasien) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag payment is failed',
                'data'      => [
                    'nama_pasien' => ['Nama pasien tidak tidak sesuai']
                ]
            ], 401);
        }

        if ($dataQuery[0]->no_rekam_medik != $request->no_rekam_medik) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag payment is failed',
                'data'      => [
                    'no_rekam_medik' => ['Nomor rekam medis tidak tidak sesuai']
                ]
            ], 401);
        }

        if ($dataQuery[0]->tanggal_lahir != $request->tanggal_lahir) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag payment is failed',
                'data'      => [
                    'tanggal_lahir' => ['Tanggal lahir tidak tidak sesuai']
                ]
            ], 401);
        }

        if ($dataQuery[0]->tgl_pendaftaran != $request->tgl_pendaftaran) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag payment is failed',
                'data'      => [
                    'tgl_pendaftaran' => ['Tanggal pendaftaran tidak tidak sesuai']
                ]
            ], 401);
        }

        if ($request->status_payment > 2) {
            return response()->json([
                'status'    => false,
                'message'   => 'Payment flag status unrecognized',
            ], 401);
        }

        $apiKeys = ApiKey::where('key', $request->header('api_key'))->first();
        $getBiodata = $this->getBiodataPasien($request->no_rekam_medik);

        $dataPayment = new LogPayment();
        $dataPayment->api_key_id            = $apiKeys->id;
        $dataPayment->nopembayaran          = $request->nopembayaran;
        $dataPayment->nokuitansi            = $request->nokuitansi;
        $dataPayment->nobuktibayar          = $request->nobuktibayar;
        $dataPayment->totalbiayapelayanan   = $request->totalbiayapelayanan;
        $dataPayment->nama_pasien           = $request->nama_pasien;
        $dataPayment->no_rekam_medik        = $request->no_rekam_medik;
        $dataPayment->tanggal_lahir         = $request->tanggal_lahir;
        $dataPayment->alamat_pasien         = $getBiodata['alamat_pasien'];
        $dataPayment->jeniskelamin          = $getBiodata['jeniskelamin'];
        $dataPayment->usia                  = $getBiodata['usia'];
        $dataPayment->ruangan_nama          = $getBiodata['ruangan_nama'];
        $dataPayment->tgl_pendaftaran       = $request->tgl_pendaftaran;
        $dataPayment->status_payment        = $request->status_payment;
        $dataPayment->payment_response_status   = $this->detailStatusPayment($request->status_payment)['status'];
        $dataPayment->payment_response_message  = $this->detailStatusPayment($request->status_payment)['message'];
        $dataPayment->save();

        return response()->json([
            'status'    => true,
            'message'   => 'Process flag payment is successfuly'
        ], 200);
    }

    public function storeResponseReversal(Request $request)
    {
        $rules = [
            'nopembayaran'          => 'required',
            'nokuitansi'            => 'required',
            'nobuktibayar'          => 'required',
            'totalbiayapelayanan'   => 'required',
            'nama_pasien'           => 'required',
            'no_rekam_medik'        => 'required',
            'tanggal_lahir'         => 'required',
            'tgl_pendaftaran'       => 'required',
            'status_reversal'       => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        $dataQuery = $this->getTagihanPasien($request->header('api_key'), $request->nokuitansi);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag reversal is failed',
                'data'      => $validator->errors()
            ], 401);
        }

        if ($dataQuery == null) {
            return response()->json([
                'status'    => false,
                'message'   => 'Data reversal tidak ditemukan',
            ], 401);
        }

        if ($dataQuery[0]->nopembayaran != $request->nopembayaran) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag reversal is failed',
                'data'      => [
                    'nopembayaran' => ['Nomor pembayaran tidak sesuai']
                ]
            ], 401);
        }

        if ($dataQuery[0]->nobuktibayar != $request->nobuktibayar) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag reversal is failed',
                'data'      => [
                    'nobuktibayar' => ['Nomor bukti bayar tidak sesuai']
                ]
            ], 401);
        }

        if ($dataQuery[0]->totalbiayapelayanan != $request->totalbiayapelayanan) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag reversal is failed',
                'data'      => [
                    'totalbiayapelayanan' => ['Total biaya tidak sesuai']
                ]
            ], 401);
        }

        if ($dataQuery[0]->nama_pasien != $request->nama_pasien) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag reversal is failed',
                'data'      => [
                    'nama_pasien' => ['Nama pasien tidak tidak sesuai']
                ]
            ], 401);
        }

        if ($dataQuery[0]->no_rekam_medik != $request->no_rekam_medik) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag reversal is failed',
                'data'      => [
                    'no_rekam_medik' => ['Nomor rekam medis tidak tidak sesuai']
                ]
            ], 401);
        }

        if ($dataQuery[0]->tanggal_lahir != $request->tanggal_lahir) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag reversal is failed',
                'data'      => [
                    'tanggal_lahir' => ['Tanggal lahir tidak tidak sesuai']
                ]
            ], 401);
        }

        if ($dataQuery[0]->tgl_pendaftaran != $request->tgl_pendaftaran) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag reversal is failed',
                'data'      => [
                    'tgl_pendaftaran' => ['Tanggal pendaftaran tidak tidak sesuai']
                ]
            ], 401);
        }

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag reversal is failed',
                'data'      => $validator->errors()
            ], 401);
        }

        if ($request->status_reversal > 1) {
            return response()->json([
                'status'    => false,
                'message'   => 'Reversal status not found',
            ], 401);
        }

        $apiKeys = ApiKey::where('key', $request->header('api_key'))->first();
        $getBiodata = $this->getBiodataPasien($request->no_rekam_medik);

        $dataPayment = new LogPayment();
        $dataPayment->api_key_id            = $apiKeys->id;
        $dataPayment->nopembayaran          = $request->nopembayaran;
        $dataPayment->nokuitansi            = $request->nokuitansi;
        $dataPayment->nobuktibayar          = $request->nobuktibayar;
        $dataPayment->totalbiayapelayanan   = $request->totalbiayapelayanan;
        $dataPayment->nama_pasien           = $request->nama_pasien;
        $dataPayment->no_rekam_medik        = $request->no_rekam_medik;
        $dataPayment->tanggal_lahir         = $request->tanggal_lahir;
        $dataPayment->alamat_pasien         = $getBiodata['alamat_pasien'];
        $dataPayment->jeniskelamin          = $getBiodata['jeniskelamin'];
        $dataPayment->usia                  = $getBiodata['usia'];
        $dataPayment->ruangan_nama          = $getBiodata['ruangan_nama'];
        $dataPayment->tgl_pendaftaran       = $request->tgl_pendaftaran;
        $dataPayment->status_reversal       = $request->status_reversal;
        $dataPayment->reversal_response_status  = $this->detailStatusReversal($request->status_reversal)['status'];
        $dataPayment->reversal_response_message = $this->detailStatusReversal($request->status_reversal)['message'];
        $dataPayment->save();

        return response()->json([
            'status'    => true,
            'message'   => 'Process flag reversal is successfuly'
        ], 200);
    }
}
