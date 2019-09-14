<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $category
 * @property string $sub_category
 * @property string $sub_category_level_1
 * @property string $sub_category_level_2
 * @property string $sub_category_level_3
 * @property string $full_text
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['category', 'sub_category', 'sub_category_level_1', 'sub_category_level_2', 'sub_category_level_3', 'full_text'], 'string', 'max' => 128],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'sub_category' => 'Sub Category',
            'sub_category_level_1' => 'Sub Category Level 1',
            'sub_category_level_2' => 'Sub Category Level 2',
            'sub_category_level_3' => 'Sub Category Level 3',
            'full_text' => 'Full Text',
        ];
    }

    public static function primaryKey()
    {
        return ['id'];
    }
}
