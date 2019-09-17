<?php
/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 09/15/19
 * Time: 14.27
 *
 * @author Khofidin <offiedz@gmail.com>
 */

namespace app\commands;


use app\components\scraper\ikea\Ikea;
use app\models\Product;
use app\models\ProductSource;
use function print_r;
use function var_dump;
use yii\console\Controller;

class ScraperController extends Controller
{
    public function actionIkea()
    {
        $sources = ProductSource::find()->where(['status' => 0])->all();

        foreach ($sources as $source) {

            $ikea = new Ikea();
            $ikea->source = $source;

            $product = new Product();

            $product->attributes = $ikea->scrap()->attributes;
            $product->source_id = $source->id;
            if ($product->save()) {
                $source->status = 1;
                $source->save();
                echo "$product->name saved\n";

                // Downloading image
                $ikea->downloadImages(true);
            } else echo "Error while saving product";
        }
    }
}