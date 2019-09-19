<?php

/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 09/15/19
 * Time: 14.27
 *
 * @author Khofidin <offiedz@gmail.com>
 *
 */

namespace app\commands;


use app\components\helpers\Utils;
use app\components\scraper\ikea\Ikea;
use app\models\Product;
use app\models\ProductSource;
use yii\console\Controller;

/**
 * Class ScraperController
 * @package app\commands
 *
 */

class ScraperController extends Controller
{
    public function actionIkea()
    {
        $sources = ProductSource::find()->where(['status' => 0])->all();

        /**
         * @var ProductSource $source
         */
        foreach ($sources as $source) {

            $ikea = new Ikea();
            $ikea->source = $source;

            $product = new Product();

            echo "Processing: " . Utils::urlToTitle($source->url) . "\n";

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