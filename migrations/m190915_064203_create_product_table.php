<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m190915_064203_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128),
            'sub_name' => $this->string(128),
            'price' => $this->decimal(12,2),
            'price_profit' => $this->decimal(12,2),
            'category_id' => $this->integer(16),
            'article_no' => $this->string(128),
            'stock' => $this->integer(),
            'main_feature' => $this->text(),
            'dimension' => $this->text(),
            'package' => $this->text(),
            'material' => $this->text(),
            'location' => $this->text()
        ]);

        $this->addForeignKey('fk-product-category_id', 'product','category_id','category','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
