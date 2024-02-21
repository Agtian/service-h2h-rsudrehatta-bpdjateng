<?php

namespace App\Http\Controllers;

use App\Models\LogPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TagihanPasienController extends Controller
{
    public function getTagihanPasien($no_tagihan)
    {
        $dataQuery = DB::connection('pgsql')->select("SELECT nopembayaran, concat(substring(nopembayaran, 3, 6),
            substring(nopembayaran, 10, 3)) AS nokuitansi, nobuktibayar, totalbiayapelayanan, nama_pasien, no_rekam_medik, alamat_pasien,
            jeniskelamin, tanggal_lahir, extract('YEAR' FROM age(tgl_pendaftaran, tanggal_lahir)) AS usia, ruangan_nama, tgl_pendaftaran
            FROM public.informasipasiensudahbayar_v
            WHERE concat(substring(nopembayaran, 3, 6), substring(nopembayaran, 10, 3)) = '$no_tagihan'
                AND cast(tglpembayaran AS DATE) = current_date
            ORDER BY tglpembayaran  DESC");
        return $dataQuery;
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

    public function validatedValuePaymentReversal($nokuitansi, $nopembayaran, $nobuktibayar, $totalbiayapelayanan, $nama_pasien, $no_rekam_medik)
    {
        $dataQuery = $this->getTagihanPasien($nokuitansi);

        if ($dataQuery[0]->nopembayaran != $nopembayaran) {
            return response()->json([
                'status'    => false,
                'message'   => 'Nomor pembayaran tidak sesuai',
            ], 401);
        }

        if ($dataQuery[0]->nobuktibayar != $nobuktibayar) {
            return response()->json([
                'status'    => false,
                'message'   => 'Nomor bukti bayar tidak sesuai',
            ], 401);
        }

        if ($dataQuery[0]->totalbiayapelayanan != $totalbiayapelayanan) {
            return response()->json([
                'status'    => false,
                'message'   => 'Total biaya tidak sesuai',
            ], 401);
        }

        if ($dataQuery[0]->nama_pasien != $nama_pasien) {
            return response()->json([
                'status'    => false,
                'message'   => 'Nama pasien tidak tidak sesuai',
            ], 401);
        }

        if ($dataQuery[0]->no_rekam_medik != $no_rekam_medik) {
            return response()->json([
                'status'    => false,
                'message'   => 'Nomor rekam medis tidak tidak sesuai',
            ], 401);
        }
    }

    public function tagihanPasien($no_tagihan)
    {
        $dataQuery = $this->getTagihanPasien($no_tagihan);
        if ($dataQuery == null){
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

    public function storeResponsePayment(Request $request)
    {
        $rules = [
            'nopembayaran'          => 'required',
            'nokuitansi'            => 'required',
            'nobuktibayar'          => 'required',
            'totalbiayapelayanan'   => 'required',
            'nama_pasien'           => 'required',
            'no_rekam_medik'        => 'required',
            'tanggal_lahir'         => 'required',
            'status_payment'        => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        $dataQuery = $this->getTagihanPasien($request->nokuitansi);

        if ($dataQuery == null){
            return response()->json([
                'status'    => false,
                'message'   => 'Data tagihan tidak ditemukan',
            ], 401);
        }

        $queryLogPayments = DB::connection('mysql')->select("SELECT id, nokuitansi, status_payment
                                                            FROM log_payments
                                                            WHERE nokuitansi = $request->nokuitansi
                                                            ORDER BY created_at DESC
                                                            LIMIT 1");

        // dd($queryLogPayments[0]->status_payment);

        if ($queryLogPayments[0]->status_payment == 1) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag payment is failed, payment status in full',
            ], 401);
        }

        $this->validatedValuePaymentReversal($request->nokuitansi, $request->nopembayaran, $request->nobuktibayar, $request->totalbiayapelayanan, $request->nama_pasien, $request->no_rekam_medik);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process flag payment is failed',
                'data'      => $validator->errors()
            ], 401);
        }

        if ($request->status_payment > 2) {
            return response()->json([
                'status'    => false,
                'message'   => 'Payment flag status not found',
            ], 401);
        }

        $dataPayment = new LogPayment();
        $dataPayment->nopembayaran          = $request->nopembayaran;
        $dataPayment->nokuitansi            = $request->nokuitansi;
        $dataPayment->nobuktibayar          = $request->nobuktibayar;
        $dataPayment->totalbiayapelayanan   = $request->totalbiayapelayanan;
        $dataPayment->nama_pasien           = $request->nama_pasien;
        $dataPayment->no_rekam_medik        = $request->no_rekam_medik;
        $dataPayment->tanggal_lahir         = $request->tanggal_lahir;
        $dataPayment->alamat_pasien         = $dataQuery[0]->alamat_pasien;
        $dataPayment->jeniskelamin          = $dataQuery[0]->jeniskelamin;
        $dataPayment->usia                  = $dataQuery[0]->usia;
        $dataPayment->ruangan_nama          = $dataQuery[0]->ruangan_nama;
        $dataPayment->tgl_pendaftaran       = $dataQuery[0]->tgl_pendaftaran;
        $dataPayment->status_payment            = $request->status_payment;
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
            'status_reversal'       => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        $dataQuery = $this->getTagihanPasien($request->nokuitansi);

        if ($dataQuery == null){
            return response()->json([
                'status'    => false,
                'message'   => 'Data tagihan tidak ditemukan',
            ], 401);
        }

        $this->validatedValuePaymentReversal($request->nokuitansi, $request->nopembayaran, $request->nobuktibayar, $request->totalbiayapelayanan, $request->nama_pasien, $request->no_rekam_medik);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process reversal is failed',
                'data'      => $validator->errors()
            ], 401);
        }

        if ($request->status_reversal > 1) {
            return response()->json([
                'status'    => false,
                'message'   => 'Reversal status not found',
            ], 401);
        }

        $dataPayment = new LogPayment();
        $dataPayment->nopembayaran          = $request->nopembayaran;
        $dataPayment->nokuitansi            = $request->nokuitansi;
        $dataPayment->nobuktibayar          = $request->nobuktibayar;
        $dataPayment->totalbiayapelayanan   = $request->totalbiayapelayanan;
        $dataPayment->nama_pasien           = $request->nama_pasien;
        $dataPayment->no_rekam_medik        = $request->no_rekam_medik;
        $dataPayment->tanggal_lahir         = $request->tanggal_lahir;
        $dataPayment->alamat_pasien         = $dataQuery[0]->alamat_pasien;
        $dataPayment->jeniskelamin          = $dataQuery[0]->jeniskelamin;
        $dataPayment->usia                  = $dataQuery[0]->usia;
        $dataPayment->ruangan_nama          = $dataQuery[0]->ruangan_nama;
        $dataPayment->tgl_pendaftaran       = $dataQuery[0]->tgl_pendaftaran;
        $dataPayment->status_reversal           = $request->status_reversal;
        $dataPayment->reversal_response_status  = $this->detailStatusReversal($request->status_reversal)['status'];
        $dataPayment->reversal_response_message = $this->detailStatusReversal($request->status_reversal)['message'];
        $dataPayment->save();

        return response()->json([
            'status'    => true,
            'message'   => 'Process flag reversal is successfuly'
        ], 200);
    }

    public function tagihanPasienUnlock($no_tagihan)
    {

    }

    public function storeResponsePaymentUnlock()
    {

    }

    public function storeResponseReversalUnlock(Request $request)
    {
        $rules = [
            'nopembayaran'          => 'required',
            'nokuitansi'            => 'required',
            'nobuktibayar'          => 'required',
            'totalbiayapelayanan'   => 'required',
            'nama_pasien'           => 'required',
            'no_rekam_medik'        => 'required',
            'tanggal_lahir'         => 'required',
            'status_reversal'       => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        $dataQuery = $this->getTagihanPasien($request->nokuitansi);

        if ($dataQuery == null){
            return response()->json([
                'status'    => false,
                'message'   => 'Data tagihan tidak ditemukan',
            ], 401);
        }

        $this->validatedValuePaymentReversal($request->nokuitansi, $request->nopembayaran, $request->nobuktibayar, $request->totalbiayapelayanan, $request->nama_pasien, $request->no_rekam_medik);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Process reversal is failed',
                'data'      => $validator->errors()
            ], 401);
        }

        if ($request->status_reversal > 1) {
            return response()->json([
                'status'    => false,
                'message'   => 'Reversal status not found',
            ], 401);
        }

        $dataPayment = new LogPayment();
        $dataPayment->nopembayaran          = $request->nopembayaran;
        $dataPayment->nokuitansi            = $request->nokuitansi;
        $dataPayment->nobuktibayar          = $request->nobuktibayar;
        $dataPayment->totalbiayapelayanan   = $request->totalbiayapelayanan;
        $dataPayment->nama_pasien           = $request->nama_pasien;
        $dataPayment->no_rekam_medik        = $request->no_rekam_medik;
        $dataPayment->tanggal_lahir         = $request->tanggal_lahir;
        $dataPayment->alamat_pasien         = $dataQuery[0]->alamat_pasien;
        $dataPayment->jeniskelamin          = $dataQuery[0]->jeniskelamin;
        $dataPayment->usia                  = $dataQuery[0]->usia;
        $dataPayment->ruangan_nama          = $dataQuery[0]->ruangan_nama;
        $dataPayment->tgl_pendaftaran       = $dataQuery[0]->tgl_pendaftaran;
        $dataPayment->status_reversal           = $request->status_reversal;
        $dataPayment->reversal_response_status  = $this->detailStatusReversal($request->status_reversal)['status'];
        $dataPayment->reversal_response_message = $this->detailStatusReversal($request->status_reversal)['message'];
        $dataPayment->save();

        return response()->json([
            'status'    => true,
            'message'   => 'Process flag reversal is successfuly'
        ], 200);
    }
}
