<?php
/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 09/16/19
 * Time: 13.51
 *
 * @author Khofidin <offiedz@gmail.com>
 */

namespace app\models;


use yii\base\Model;

/**
 * Class Weight
 * @package app\models
 * @var int $package
 * @var float $gross_weight
 * @var float $nett_weight
 * @var float $long
 * @var float $width
 * @var float $height
 * @var float $volume
 * @var float $volume_weight
 */
class Package extends Model
{
    public $package;

    public $gross_weight;

    public $nett_weight;

    public $long;

    public $width;

    public $height;

    public $volume;

    public $volume_weight;


    public function attributeLabels()
    {
        return [
            'package' => 'Package',
            'gross_weight' => 'Gross',
            'nett_weight' => 'Nett',
            'long' => 'Long',
            'width' => 'Width',
            'height' => 'Height',
            'volume' => 'Volume',
            'volume_weight' => 'Volume Weight'
        ];
    }
}