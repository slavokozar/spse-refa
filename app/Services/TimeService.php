<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 25.10.2018
 * Time: 23:59
 */

namespace App\Services;


class TimeService
{
    public function humanDiff($diff){
        $response = '';

        $d = floor($diff / (24 * 60 * 60));
        $diff = $diff - $d * (24 * 60 * 60);

        $h = floor($diff / (60 * 60));
        $diff = $diff - $h * (60 * 60);

        $m = floor($diff / 60);
        $diff = $diff - $m * 60;


        if($d > 0) $response .= $d . ' dní ';
        if($h > 0 || $d > 0) $response .= $h . ' hod. ';
        if($m > 0 || $h > 0 || $d > 0) $response .= $m . ' min. ';

        return $response;
    }
}