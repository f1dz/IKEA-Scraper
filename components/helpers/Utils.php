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
use function trim;
use function ucwords;

class Utils
{
    public static function urlToTitle($url){
        $arr = explode('/',$url);

        return self::strNormalize($arr[count($arr)-1]);
    }

    public static function strNormalize($str){
        $replace = preg_replace('/([\-]|art-[\d]+)/',' ', $str);
        $trim = trim($replace);
        return ucwords($trim);
    }
}