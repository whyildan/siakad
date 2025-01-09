<?php
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

if (!function_exists('dayIndo')) {
    function dayIndo($day)
    {
        $dayMap = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];

        return $dayMap[$day];
    }
}

if (!function_exists('randomCardBackground')) {
    function randomCardBackground()
    {
        $background = [
            asset('assets/images/background/read.jpg'),
            asset('assets/images/background/bookclub.jpg'),
            asset('assets/images/background/design.jpg'),
            asset('assets/images/background/graduation.jpg'),
            asset('assets/images/background/honors.jpg'),
            asset('assets/images/background/reachout.jpg'),
            asset('assets/images/background/read.jpg'),
            asset('assets/images/background/code.jpg'),
            asset('assets/images/background/math.jpg'),
        ];

        return $background[random_int(0, 8)];
    }
}

if (!function_exists('encryptUrlId')) {
    function encryptUrlId($id)
    {
        return Crypt::encryptString($id);
        ;
    }
}


if (!function_exists('formatTanggal')) {
    function formatTanggal($tanggal)
    {
        Carbon::setLocale('id');

        $tanggal = Carbon::parse($tanggal);
        return $tanggal->translatedFormat('l, d F Y');
    }
}

if (!function_exists('formatTanggalWaktu')) {
    function formatTanggalWaktu($tanggal)
    {
        Carbon::setLocale('id');

        $tanggal = Carbon::parse($tanggal);
        return $tanggal->translatedFormat('l, d F Y | h:i');
    }
}

if (!function_exists('ambilGroup')) {
    function ambilGroup(){
        $userGroups = auth()->user()->group;

        return explode(',', json_decode($userGroups));
    }
}