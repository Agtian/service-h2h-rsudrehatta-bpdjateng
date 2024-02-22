<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InformasiPasienSudahBayar extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    // protected $table = 'public.informasipasiensudahbayar_v';

    // protected $primaryKey = 'pegawai_id';

    protected $guarded = [];

    public function getDataTagihan()
    {
        $query = DB::connection('pgsql')->select("SELECT nopembayaran, concat(substring(nopembayaran, 3, 6), substring(nopembayaran, 10, 3)) as nokuitansi,
            nobuktibayar, totalbiayapelayanan, nama_pasien, no_rekam_medik, alamat_pasien, jeniskelamin, tanggal_lahir,
            extract('YEAR' from age(tgl_pendaftaran, tanggal_lahir)) as usia, ruangan_nama, tgl_pendaftaran
            FROM public.informasipasiensudahbayar_v where cast(tglpembayaran as date) = current_date order by tglpembayaran  desc");

        return $query;
    }
}
