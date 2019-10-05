<?php

namespace app\controllers;

use app\components\helpers\Spout;
use app\models\ExportForm;
use app\models\Product;
use Yii;

class ExportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $form = new ExportForm();

        if($form->load(Yii::$app->request->post())){

            $file_name = "shopee_{$form->from_id}-{$form->to_id}.xlsx";

            if($form->file_name) $file_name = $form->file_name;

            $products = Product::find()
                ->where(['not', ['stock' => null]])
                ->andWhere(['>=', 'id', $form->from_id]);

            if($form->to_id != null)
                $products->andWhere(['<=','id', $form->to_id]);

            $spout = new Spout();
            $spout->file_name = $file_name;
            $spout->products = $products->all();
            $spout->write();

            Yii::$app->session->setFlash('success', "File $file_name saved");
        }

        return $this->render('index', ['model' => $form]);
    }

}
