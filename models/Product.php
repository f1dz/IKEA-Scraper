<?php

namespace app\models;

use app\components\helpers\Utils;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $source_id
 * @property string $name
 * @property string $sub_name
 * @property string $price
 * @property string $price_profit
 * @property int $category_id
 * @property string $article_no
 * @property int $stock
 * @property string $main_feature
 * @property string $dimension
 * @property string $package
 * @property string $material
 * @property string $location
 * @property string $breadcrumb
 * @property string $images
 * @property string $care_instructions
 * @property string $additional_info
 *
 * @property Category $category
 * @property Package $packageOrigin
 * @property Package $packagePlus
 * @property ProductSource $source
 * @property array $imagesArray
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'price_profit'], 'number'],
            [['category_id', 'stock', 'source_id'], 'integer'],
            [['main_feature', 'dimension', 'package', 'material', 'location', 'images', 'care_instructions', 'additional_info'], 'string'],
            [['name', 'sub_name', 'article_no', 'breadcrumb'], 'string', 'max' => 128],
            [['source_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductSource::class, 'targetAttribute' => ['source_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'source_id' => 'Source ID',
            'name' => 'Name',
            'sub_name' => 'Sub Name',
            'price' => 'Price',
            'price_profit' => 'Sale Price',
            'category_id' => 'Category ID',
            'article_no' => 'Article No',
            'stock' => 'Stock',
            'main_feature' => 'Main Feature',
            'dimension' => 'Dimension',
            'package' => 'Package',
            'material' => 'Material',
            'location' => 'Location',
            'breadcrumb' => 'Breadcrumb',
            'images' => 'Images',
            'care_instructions' => 'Care Instructions',
            'additional_info' => 'Additional Info',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(ProductSource::class, ['id' => 'source_id']);
    }

    /**
     * @return Package
     */
    public function getPackageOrigin()
    {
        $model = new Package();
        $model->package = Utils::strToPackage($this->package);
        $model->gross_weight = Utils::strToGrossWeight($this->package);
        $model->nett_weight = Utils::strToNetWeight($this->package);
        $model->long = Utils::strToLong($this->package);
        $model->width = Utils::strToWidth($this->package);
        $model->height = Utils::strToHeight($this->package);
        $model->volume = Utils::strToVolume($this->package);
        $model->volume_weight = Utils::volumeWeight($model);
        return $model;
    }

    /**
     * @return Package
     */
    public function getPackagePlus()
    {
        $model = new Package();
        $model->package = Utils::strToPackage($this->package);
        $model->gross_weight = Utils::strToGrossWeight($this->package) + 0.15;
        $model->nett_weight = Utils::strToNetWeight($this->package) + 0.15;
        $model->long = Utils::strToLong($this->package) + 1;
        $model->width = Utils::strToWidth($this->package) + 1;
        $model->height = Utils::strToHeight($this->package) + 1;
        $model->volume = Utils::strToVolume($this->package) + 0.1;
        $model->volume_weight = Utils::volumeWeight($model);
        return $model;
    }

    /**
     * @return array
     */
    public function getImagesArray(){
        return $images = explode(',', $this->images);
    }
}
