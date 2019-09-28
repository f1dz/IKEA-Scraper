<?php
/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 09/17/19
 * Time: 09.33
 *
 * @author Khofidin <offiedz@gmail.com>
 */

namespace app\components\helpers;


use app\models\Product;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use function var_dump;
use Yii;
use yii\base\Component;
use yii\db\ActiveRecord;

class Spout extends Component
{
    public $file_name;

    /**
     * @var Product|array|ActiveRecord $products
     */
    public $products;

    public function init()
    {
        $this->file_name = (empty($this->file_name)) ? "upload_file.xlsx" : $this->file_name;
        parent::init();
    }

    public function write(){

        $writer  = WriterEntityFactory::createXLSXWriter();
        $writer->openToFile(Yii::$app->basePath . "/downloads/$this->file_name");

        /** Add Row */
        $values = ['category', 'name', 'description','price','stock', 'weight','send_within','sku'];
        $rowFromValue = WriterEntityFactory::createRowFromArray($values);
        $writer->addRow($rowFromValue);

        $rows = [];
        /** @var Product $product */
        foreach ($this->products as $product){
            $weight = (max(@$product->packagePlus->gross_weight, @$product->packagePlus->volume_weight) * 1000);
            $cells = [
                WriterEntityFactory::createCell(@$product->category_id),
                WriterEntityFactory::createCell('IKEA ' . @$product->name . ' ' . @$product->sub_name),
                WriterEntityFactory::createCell(@$product->main_feature . "\n\r" . @$product->dimension . "\n\r" . @$product->care_instructions . "\n\r" . @$product->additional_info),
                WriterEntityFactory::createCell((float)@$product->price_profit),
                WriterEntityFactory::createCell(5),
                WriterEntityFactory::createCell($weight),
                WriterEntityFactory::createCell(''),
                WriterEntityFactory::createCell(@$product->article_no),
                ];

            $rows[] = WriterEntityFactory::createRow($cells);
        }
        $writer->addRows($rows);

        $writer->close();
    }
}