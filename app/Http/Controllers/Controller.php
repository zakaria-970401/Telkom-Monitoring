<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function generateUniqName()
    {
        return md5(uniqid(time(), true));
    }

    public function formatTanggal($date) {
        $year = explode('-', $date)[0];
        $month = explode('-', $date)[1];
        $date = explode('-', $date)[2];
        return $date . '/' . $month . '/' . $year;
    }

    function expired($expired_date) {
        return (strtotime($expired_date) - strtotime(date('Y-m-d'))) / 86400;
    }
}
