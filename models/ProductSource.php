<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_source".
 *
 * @property int $id
 * @property string $url
 * @property int $category
 * @property int $status
 */
class ProductSource extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_source';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category', 'status'], 'integer'],
            [['url'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'category' => 'Category',
            'status' => 'Status',
        ];
    }
}
