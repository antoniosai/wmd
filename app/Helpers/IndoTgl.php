<?php

namespace App\Helpers;

class IndoTgl
{
    public static function bulanIndo($bln){      
        switch($bln)
        {
            case 1 : $bulan="Januari";break;
            case 2 : $bulan="Februari";break;
            case 3 : $bulan="Maret";break;
            case 4 : $bulan="April";break;
            case 5 : $bulan="Mei";break;
            case 6 : $bulan="Juni";break;
            case 7 : $bulan="Juli";break;
            case 8 : $bulan="Agustus";break;
            case 9 : $bulan="September";break;
            case 10 : $bulan="Oktober";break;
            case 11 : $bulan="November";break;
            case 12 : $bulan="Desember";break;
        }
        return $bulan;
    }
    
    public static function tglIndo($tgl){
        if($tgl == '' || $tgl == '0000-00-00'){
            return '-';
        }
        else{
            $tanggal = substr($tgl,8,2);
            $bulan   = substr($tgl,5,2);
            $tahun   = substr($tgl,0,4);
            
            return $tanggal.' '.IndoTgl::bulanIndo($bulan).' '.$tahun;
        }
    }

    public static function jamIndo($tgl){
        if($tgl == '' || $tgl == '0000-00-00'){
            return '-';
        }
        else{
            $tanggal = substr($tgl,8,2);
            $bulan   = substr($tgl,5,2);
            $tahun   = substr($tgl,0,4);
            
            return $tanggal.' '.IndoTgl::bulanIndo($bulan).' '.$tahun;
        }
    }

    public static function generateMonth()
    {
        $data = [
            [
                'no' => 1,
                'string' => 'Januari'
            ],
            [
                'no' => 2,
                'string' => 'Februari'
            ],
            [
                'no' => 3,
                'string' => 'Maret'
            ],
            [
                'no' => 4,
                'string' => 'April'
            ],
            [
                'no' => 5,
                'string' => 'Mei'
            ],
            [
                'no' => 6,
                'string' => 'Juni'
            ],
            [
                'no' => 7,
                'string' => 'Juli'
            ],
            [
                'no' => 8,
                'string' => 'Agustus'
            ],
            [
                'no' => 9,
                'string' => 'September'
            ],
            [
                'no' => 10,
                'string' => 'Oktober'
            ],
            [
                'no' => 11,
                'string' => 'November'
            ],
            [
                'no' => 12,
                'string' => 'Desember'
            ]
        ];

        return $data;
    }

    public static function generateYear()
    {
        $data = [];

        for($i = 2015; $i <= date('Y'); $i++)
        {
            array_push($data, $i);
        }

        return $data;
    }
}