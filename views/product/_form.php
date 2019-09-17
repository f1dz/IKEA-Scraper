<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */

$url = \yii\helpers\Url::to(['/category/list'])
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_profit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->widget(\kartik\select2\Select2::class, [
        'initValueText' => @$model->category->full_text,
        'value' => @$model->category_id,
        'theme' => \kartik\select2\Select2::THEME_BOOTSTRAP,
        'options' => ['placeholder' => 'Search for a port ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => $url,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(category_id) { return category_id.text; }'),
            'templateSelection' => new JsExpression('function (category_id) { return category_id.text; }'),
        ]
    ]) ?>

    <?= $form->field($model, 'article_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock')->textInput() ?>

    <?= $form->field($model, 'main_feature')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dimension')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'package')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'material')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'location')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
