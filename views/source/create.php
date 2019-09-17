<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSource */

$this->title = 'Create Product Source';
$this->params['breadcrumbs'][] = ['label' => 'Product Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-source-create panel panel-success">
    <div class="panel-heading">
        <h1 class="panel-title"><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="panel-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
