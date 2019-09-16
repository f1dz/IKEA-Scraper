<?php
/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 09/15/19
 * Time: 09.21
 *
 * @author Khofidin <offiedz@gmail.com>
 */

namespace app\components\helpers;

use function count;
use function preg_replace;
use function round;
use function trim;
use function ucwords;

class Utils
{
    public static function urlToTitle($url){
        $arr = explode('/',$url);

        return self::strNormalize($arr[count($arr)-1]);
    }

    public static function strNormalize($str){
        $replace = preg_replace('/([\-\+]|art-[\d]+)/',' ', $str);
        $trim = trim($replace);
        return ucwords($trim);
    }

    public static function getProfitPrice($price){
        // 199.000 x 10% = 218.900
        // 39.900 x 10% = 43.890 -> 43.900
        return round(($price * 1.1) + 500, -3)-100;
    }

    public static function strToNumber($str){
        preg_match_all('!\d+!', $str, $matches);
        return (int)$matches[0][0];
    }

    public static function imgUrl($url){
        return preg_replace('/_S1\./', '_S5.',$url);
    }
}