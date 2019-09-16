<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\VarDumper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//VarDumper::dump($dataProvider->models[0]->packagePlus, 10, true);
//VarDumper::dump($dataProvider->models[0]->packageOrigin, 10, true);exit;

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index panel panel-success">
    <div class="panel-heading">
        <h1 class="panel-title"><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="panel-body">
        <p>
            <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'header' => 'Name',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Html::a($data->name, ['product/view', 'id' => $data->id]);
                    }
                ],
                'sub_name',
                [
                    'attribute' => 'price',
                    'format' => 'decimal',
                    'contentOptions' => ['class' => 'text-right'],
                    'headerOptions' => ['class' => 'text-right'],
                ],
                [
                    'attribute' => 'price_profit',
                    'format' => 'decimal',
                    'contentOptions' => ['class' => 'text-right'],
                    'headerOptions' => ['class' => 'text-right']
                ],
                //'category_id',
                //'article_no',
                [
                    'attribute' => 'stock',
                    'format' => 'decimal',
                    'contentOptions' => ['class' => 'text-right'],
                    'headerOptions' => ['class' => 'text-right']
                ],

                [
                    'header' => 'Weight (kg)',
                    'format' => 'decimal',
                    'value' => function($data){
                        return $data->packagePlus->gross_weight;
                    },
                    'contentOptions' => ['class' => 'text-right'],
                    'headerOptions' => ['class' => 'text-right']
                ],

                [
                    'header' => 'Vol Wgt (kg)',
                    'format' => 'decimal',
                    'value' => function($data){
                        return $data->packagePlus->volume_weight;
                    },
                    'contentOptions' => ['class' => 'text-right'],
                    'headerOptions' => ['class' => 'text-right']
                ],

                [
                    'header' => 'Profit',
                    'format' => 'decimal',
                    'value' => function($data){
                        return $data->price_profit - $data->price;
                    },
                    'contentOptions' => ['class' => 'text-right'],
                    'headerOptions' => ['class' => 'text-right']
                ],

                //'main_feature:ntext',
                //'dimension:ntext',
                //'package:ntext',
                //'material:ntext',
                //'location:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>
