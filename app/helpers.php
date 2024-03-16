<?php

function format_tgl($tgl)
{
    if ($tgl) {
        return date('d-M-Y', strtotime($tgl));
    }
}

function durasiCheckedIn($waktu)
{

    $chekedIn =  Carbon::parse($waktu);
    $jamSekarang = Carbon::now();
    return $chekedIn->diffInMinutes($jamSekarang);
}

function durasiAbsen($waktu1, $waktu2)
{

    $chekedIn =  Carbon::parse($waktu1);
    $chekedOut =  Carbon::parse($waktu2);
    return $chekedIn->diffInMinutes($chekedOut);
}
