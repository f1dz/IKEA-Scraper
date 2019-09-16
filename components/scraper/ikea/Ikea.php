<?php

/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 09/15/19
 * Time: 10.11
 *
 * @author Khofidin <offiedz@gmail.com>
 */

namespace app\components\scraper\ikea;

use app\components\helpers\Utils;
use app\models\Product;
use app\models\ProductSource;
use function copy;
use Exception;
use function explode;
use function file_put_contents;
use Goutte\Client;
use function implode;
use function is_dir;
use function mkdir;
use function print_r;
use SebastianBergmann\CodeCoverage\Util;
use function trim;
use function var_dump;
use Yii;
use yii\base\Component;

/**
 * Class Ikea
 * @package app\components\scraper\ikea
 */
class Ikea extends Component
{
    /**
     * @var Client $client
     */
    private $client;

    /**
     * @var ProductSource $source
     */
    public $source;

    /**
     * @var Product $product
     */
    private $product;

    public function init()
    {
        $_client = new Client();
        $this->client = $_client;
        $this->product = new Product();
        parent::init();
    }

    /**
     * @return Product
     */
    public function scrap()
    {
        $crawler = $this->client->request('GET', $this->source->url);

        try {
            $crawler->filter('#productSelected > div.itemInfo > a.itemName > h6')->each(function ($node) {
                $this->product->name = trim($node->text());
            });
        } catch (Exception $e) {
        }

        try {
            $crawler->filter('#productSelected > div.itemInfo > div.itemDetails > span')->each(function ($node) {
                $this->product->sub_name = trim($node->text());
            });
        } catch (Exception $e) {
        }

        try {
            $crawler->filter('#productSelected > div.itemInfo > div.itemPriceBox > div > p > span:nth-child(1)')->each(function ($node) {
                $this->product->price = trim($node->attr('data-price'));
                $this->product->price_profit = Utils::getProfitPrice($this->product->price);
            });
        } catch (Exception $e) {
        }

        $this->product->category_id = $this->source->category_id;

        try {
            $crawler->filter('#productSelected > div.itemInfo > p.partNumber.mt-3')->each(function ($node) {
                $data = explode(':', trim($node->text()));
                $this->product->article_no = trim($data[1]);
            });
        } catch (Exception $e) {
        }

        try {
            $crawler->filter('#productSelected > div.itemTextBlock.notes > p.stockTxt > span:nth-child(1)')->each(function ($node) {
                $this->product->stock = Utils::strToNumber(trim($node->text()));
            });
        } catch (Exception $e) {
        }

        try {
            $crawler->filter('#pills-features > div')->each(function ($node) {
                $this->product->main_feature = trim($node->text());
            });
        } catch (Exception $e) {
        }

        try {
            $crawler->filter('#pills-measurements > div > table')->each(function ($node) {
                $this->product->dimension = trim($node->text());
            });
        } catch (Exception $e) {
        }

        try {
            $crawler->filter('#collapsePackage > table')->each(function ($node) {
                $this->product->package = trim($node->text());
            });
        } catch (Exception $e) {
        }

        try {
            $crawler->filter('#pills-environment > div > div')->each(function ($node) {
                $this->product->material = trim($node->text());
            });
        } catch (Exception $e) {
        }

        try {
            $crawler->filter('#pills-stock > div > div > div')->each(function ($node) {
                $this->product->location = trim($node->text());
            });
        } catch (Exception $e) {
        }

        try {
            $crawler->filter('#sidenavWrapper > header > div.container-fluid.breadcrumbContainer > div > nav > ol')->each(function ($node) {
                $this->product->breadcrumb = trim($node->text());
            });
        } catch (Exception $e) {
        }

        try {
            if(count($crawler->filter('img.img-thumbnail')) > 1) {
                $crawler->filter('img.img-thumbnail')->each(function ($node) {
                    $this->product->images .= Utils::imgUrl($node->attr('src')) . ',';
                });
            } else {
                $crawler->filter('a.slideImg')->each(function ($node) {
                    $this->product->images = $node->attr('href');
                });
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $this->product->images = trim($this->product->images, ',');
        return $this->product;
    }

    public function downloadImages($debug = false)
    {
        $path = Yii::$app->basePath. '/web/downloads/' . $this->product->name;

        if(!is_dir($path)) mkdir($path);

        $images = explode(',', $this->product->images);
        foreach ($images as $img) {
            if($debug)
                echo "Downloading... $img...";

            file_put_contents($path .'/'. Utils::urlToTitle($img), file_get_contents($img));

            if($debug)
                echo " downloaded!\n" ;
        }

    }
}