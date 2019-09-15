<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
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
 *
 * @property Category $category
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
            [['category_id', 'stock'], 'integer'],
            [['main_feature', 'dimension', 'package', 'material', 'location'], 'string'],
            [['name', 'sub_name', 'article_no'], 'string', 'max' => 128],
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
            'name' => 'Name',
            'sub_name' => 'Sub Name',
            'price' => 'Price',
            'price_profit' => 'Price Profit',
            'category_id' => 'Category ID',
            'article_no' => 'Article No',
            'stock' => 'Stock',
            'main_feature' => 'Main Feature',
            'dimension' => 'Dimension',
            'package' => 'Package',
            'material' => 'Material',
            'location' => 'Location',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}
