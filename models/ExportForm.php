<?php
/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 09/17/19
 * Time: 17.50
 *
 * @author Khofidin <offiedz@gmail.com>
 */

namespace app\models;


use yii\base\Model;

/**
 * Class ExportForm
 * @package app\models
 * @var int $from_id
 * @var int $to_id
 * @var string $file_name
 */

class ExportForm extends Model
{
    public $from_id;
    public $to_id;
    public $file_name;

    public function rules()
    {
        return [
            [['from_id'], 'required'],
            [['file_name'], 'string', 'max' => '64'],
            [['from_id', 'to_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'from_id' => 'From',
            'to_id' => 'To',
            'file_name' => 'File Name',
        ];
    }
}