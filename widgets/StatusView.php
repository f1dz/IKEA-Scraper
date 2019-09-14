<?php
/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 09/14/19
 * Time: 19.49
 *
 * @author Khofidin <offiedz@gmail.com>
 */

namespace app\widgets;


use yii\bootstrap\Widget;

class StatusView extends Widget
{
    public $data;

    public function init()
    {
    }

    public function run()
    {
        return ($this->data->status == 1) ?
            '<span class="label label-success">Processed</span>' :
            '<span class="label label-danger">Waiting</span>';
    }
}