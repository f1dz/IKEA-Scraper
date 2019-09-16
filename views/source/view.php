<?php

use app\components\helpers\Utils;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSource */

$this->title = Utils::urlToTitle($model->url);
$this->params['breadcrumbs'][] = ['label' => 'Product Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-source-view panel panel-success">
    <div class="panel-heading">
        <h1 class="panel-title"><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="panel-body">
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'url:url',
                ['label' => 'Category', 'format' => 'raw', 'value' => "<strong>[$model->category_id]</strong> " . $model->category->full_text],
                ['label' => 'Status', 'format' => 'raw', 'value' => \app\widgets\StatusView::widget(['data' => $model])],
            ],
        ]) ?>
    </div>
</div>
