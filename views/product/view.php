<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view panel panel-success">
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
                'name',
                'sub_name',
                'source.url:url',
                'price:decimal',
                'price_profit:decimal',
                ['label' => 'Category', 'format' => 'raw', 'value' => function($data){
                    return "<strong>$data->category_id</strong> - " . $data->category->full_text;
                }],
                'article_no',
                'stock',
                'packagePlus.gross_weight',
                'main_feature:ntext',
                'dimension:ntext',
                'package:ntext',
                'material:ntext',
                'location:ntext',
            ],
        ]) ?>
    </div>
</div>
