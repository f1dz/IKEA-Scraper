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

use app\models\Package;
use function count;
use function preg_match_all;
use function preg_replace;
use function round;
use function str_replace;
use function trim;
use function ucwords;
use function var_dump;

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
        $profit = 1.1;

        if($price <= 10000)
            $profit = 1.3;
        else if($price <= 15000)
            $profit = 1.2;
        else if($price <= 20000)
            $profit = 1.15;

        return round(($price * $profit) + 500, -3)-100;

    }

    public static function strToNumber($str){
        preg_match_all('!\d+!', $str, $matches);
        return (int)$matches[0][0];
    }

    public static function imgUrl($url){
        return preg_replace('/_S1\./', '_S5.',$url);
    }

    /**
     * @param string $str
     * @return int
     */
    public static function strToPackage($str){
        preg_match_all('/(Paket: )([\d]+)/', $str, $matches);
        return (float) str_replace(',', '.', $matches[2][0]);
    }

    /**
     * @param string $str
     * @return float
     */
    public static function strToGrossWeight($str){
        preg_match_all('/(Berat Kotor: )([\d,]+)/', $str, $matches);
        return (float) str_replace(',', '.', $matches[2][0]);
    }

    /**
     * @param string $str
     * @return float
     */
    public static function strToNetWeight($str){
        preg_match_all('/(Berat Bersih: )([\d,]+)/', $str, $matches);
        return (float) str_replace(',', '.', $matches[2][0]);
    }

    /**
     * @param string $str
     * @return int
     */
    public static function strToLong($str){
        preg_match_all('/(Panjang: )([\d]+)/', $str, $matches);
        return (float) @str_replace(',', '.', $matches[2][0]);
    }

    /**
     * @param string $str
     * @return int
     */
    public static function strToWidth($str){
        preg_match_all('/(Lebar: )([\d]+)/', $str, $matches);
        return (float) @str_replace(',', '.', $matches[2][0]);
    }

    /**
     * @param string $str
     * @return int
     */
    public static function strToHeight($str){
        preg_match_all('/(Tinggi: )([\d]+)/', $str, $matches);
        return (float) @str_replace(',', '.', $matches[2][0]);
    }

    /**
     * @param string $str
     * @return float
     */
    public static function strToVolume($str){
        preg_match_all('/(Volume per paket: )([\d,]+)/', $str, $matches);
        return (float) str_replace(',', '.', $matches[2][0]);
    }

    /**
     * @param Package $model
     * @return float|int
     */
    public static function volumeWeight(Package $model){
        return $model->long * $model->width * $model->height / 6000;
    }

    /**
     * @param $str
     * @return null|string|string[]
     */
    public static function trimNewLine($str){
        return preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $str);
    }

    /**
     * @param $str
     * @return string
     */
    public static function trim($str){
        return implode("\n", array_map('trim', explode("\n", $str)));
    }

    /**
     * @param $bytes
     * @param int $precision
     * @return string
     *
     * @url https://stackoverflow.com/a/2510459
     */
    public static function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
         $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}