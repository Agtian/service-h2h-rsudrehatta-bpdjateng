<?php

namespace App\Helpers;

use App\Models\MYSQL_SMS\Outbox;
use Illuminate\Support\Facades\DB;

class SMSHelper
{
    public static function randomString($length)
    {
        $str        = "";
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
        $max        = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    public static function shortsms($nohp, $pesan)
    {
        return Outbox::insert([
            'InsertIntoDB'      => date('Y-m-d H:i:s'),
            'SendingDateTime'   => date('Y-m-d H:i:s'),
            'DestinationNumber' => $nohp,
            'TextDecoded'       => $pesan,
            'SendingTimeOut'    => date('Y-m-d H:i:s'),
            'CreatorID'         => '',
        ]);
    }

    public static function countTime($time1, $time2)
    {
        $time1_unix = strtotime(date('Y-m-d') . ' ' . $time1 . ':00');
        $time2_unix = strtotime(date('Y-m-d') . ' ' . $time2 . ':00');

        $begin_day_unix = strtotime(date('Y-m-d') . ' 00:00:00');

        return date('H:i', ($time1_unix + ($time2_unix - $begin_day_unix)));
    }

    public static function differenceTime($waktu_awal, $waktu_akhir)
    {
        $waktu_awal  = strtotime($waktu_awal);
        $waktu_akhir = strtotime($waktu_akhir);

        //menghitung selisih dengan hasil detik
        $diff = $waktu_akhir - $waktu_awal;

        //membagi detik menjadi jam
        $jam = floor($diff / (60 * 60));

        //membagi sisa detik setelah dikurangi $jam menjadi menit
        $menit = $diff - $jam * (60 * 60);

        // satuan detik
        return number_format($diff, 0, ",", ".");

        //menampilkan / print hasil
        // echo 'Hasilnya adalah '.number_format($diff,0,",",".").' detik<br /><br />';
        // echo 'Sehingga Anda memiliki sisa waktu promosi selama: ' . $jam .  ' jam dan ' . floor( $menit / 60 ) . ' menit';
    }

    public static function differenceDay($waktu_awal, $waktu_akhir)
    {
        $waktu_awal     = date_create(date('Y-m-d', strtotime($waktu_awal)));
        $waktu_akhir    = date_create(date('Y-m-d', strtotime($waktu_akhir)));
        $difference     = date_diff($waktu_awal, $waktu_akhir);
        return $difference->days;
    }

    public static function arrQuantityRequestAPIUsers($apiKeyId)
    {
        $query = DB::select("SELECT MONTHNAME(created_at) as bulan, COUNT(id) AS used_quantity, api_key_id
                    FROM api_event_histories
                    WHERE YEAR(created_at) = YEAR(CURDATE())
                        AND api_key_id = $apiKeyId
                    GROUP BY api_key_id, MONTHNAME(created_at)");

        $index = 0;
        $usedQuantityArr = [];
        foreach ($query as $item) {
            array_push($usedQuantityArr, $item->used_quantity);
            $index++;
        }

        // foreach ($usedQuantityArr as $x => $y) {
        //     echo $y . ',';
        // }

        return $usedQuantityArr;
    }
}
