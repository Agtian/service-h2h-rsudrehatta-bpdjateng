<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagihanPasienController extends Controller
{
    public function getTagihanPasien($nomedis_or_notagihan)
    {
        $dataQueryByNoPembayaran = DB::connection('pgsql')->select("SELECT nopembayaran, concat(substring(nopembayaran, 3, 6),
            substring(nopembayaran, 10, 3)) AS nokuitansi, nobuktibayar, totalbiayapelayanan, nama_pasien, no_rekam_medik, alamat_pasien,
            jeniskelamin, tanggal_lahir, extract('YEAR' FROM age(tgl_pendaftaran, tanggal_lahir)) AS usia, ruangan_nama, tgl_pendaftaran
            FROM public.informasipasiensudahbayar_v
            WHERE concat(substring(nopembayaran, 3, 6), substring(nopembayaran, 10, 3)) = '$nomedis_or_notagihan'
                AND cast(tglpembayaran AS DATE) = current_date
            ORDER BY tglpembayaran  DESC");

        if (count($dataQueryByNoPembayaran) === 0) {
            $dataQueryByNoMedis = DB::connection('pgsql')->select("SELECT nopembayaran, concat(substring(nopembayaran, 3, 6),
                substring(nopembayaran, 10, 3)) AS nokuitansi, nobuktibayar, totalbiayapelayanan, nama_pasien, no_rekam_medik, alamat_pasien,
                jeniskelamin, tanggal_lahir, extract('YEAR' FROM age(tgl_pendaftaran, tanggal_lahir)) AS usia, ruangan_nama, tgl_pendaftaran
                FROM public.informasipasiensudahbayar_v
                    WHERE cast(tglpembayaran AS DATE) = current_date
                    and no_rekam_medik = '$nomedis_or_notagihan'
                ORDER BY tglpembayaran  DESC");

            return $dataQueryByNoMedis;
        } else {
            return $dataQueryByNoPembayaran;
        }
    }

    public function patientBill()
    {
        $dataQuery = DB::connection('pgsql')->select("SELECT nopembayaran, concat(substring(nopembayaran, 3, 6),
                            substring(nopembayaran, 10, 3)) AS nokuitansi, nobuktibayar, totalbiayapelayanan, nama_pasien, no_rekam_medik, alamat_pasien,
                            jeniskelamin, tanggal_lahir, extract('YEAR' FROM age(tgl_pendaftaran, tanggal_lahir)) AS usia, ruangan_nama, tgl_pendaftaran
                            FROM public.informasipasiensudahbayar_v
                                WHERE cast(tglpembayaran AS DATE) = current_date
                            ORDER BY tglpembayaran  DESC");

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
        $dataQuery = $this->getTagihanPasien($request->nomormedis);

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
}
