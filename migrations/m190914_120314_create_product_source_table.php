<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_source}}`.
 */
class m190914_120314_create_product_source_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_source}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(256),
            'category_id' => $this->integer(),
            'status' => $this->integer()
        ]);

        $this->addForeignKey('fk-product_source-id','%product_source','category_id', 'category','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_source}}');
    }
}
