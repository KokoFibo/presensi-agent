<?php

use Carbon\Carbon;

function get_location($id)
{
    $data = Location::find($id);
    if ($data != null) {
        return $data->location_name;
    } else {
        return '';
    }
}
function getRoleName($role_id)
{

    switch ($role_id) {
        case 0:
            $role = 'User';
            break;
        case 1:
            $role = 'Admin';
            break;
        case 2:
            $role = 'Super Admin';
            break;
        case 3:
            $role = 'Developer';
            break;
    }
    return $role;
}

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
