<?php

namespace App\Helpers;

use App\Models\MYSQL_SMS\Outbox;

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
}
