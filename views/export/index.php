<?php
/**
 * @var $this yii\web\View
 * @var $model ExportForm
 */

use app\models\ExportForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = "Export Data";

?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h1 class="panel-title">Export to template</h1>
            </div>
            <div class="panel-body">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'export-form',
                    'layout' => 'horizontal',
                ]);
                echo $form->field($model, 'from_id')->textInput(['autofocus' => true]);
                echo $form->field($model, 'to_id');
                echo $form->field($model, 'file_name');

                echo Html::submitButton('Submit', ['class' => 'btn btn-success pull-right']);
                ActiveForm::end()
                ?>
            </div>
        </div>
    </div>
</div>