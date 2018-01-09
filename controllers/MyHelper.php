<?php

namespace app\controllers;

use function GuzzleHttp\Psr7\str;

class MyHelper
{
    public static function calculatePrice($fullPrice, $discount = 0)
    {
        return $fullPrice - ($fullPrice * ($discount / 100));
    }

    public static function buildDomArray($str, $delimiter = ';')
    {
        if (strlen($str) > 0) {
            $array = explode($delimiter, $str);
            $result = '<ul>';
            foreach ($array as $key => $value) {
                $result .= '<li>' . $value . '</li>';
            }
            $result .= '</ul>';
            return $result;
        }
        return '';
    }

}