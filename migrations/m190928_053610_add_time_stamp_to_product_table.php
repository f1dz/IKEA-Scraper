<?php

use yii\db\Migration;

/**
 * Class m190928_053610_add_time_stamp_to_product_table
 */
class m190928_053610_add_time_stamp_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product','created_at', $this->dateTime());
        $this->addColumn('product','updated_at', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190928_053610_add_time_stamp_to_product_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190928_053610_add_time_stamp_to_product_table cannot be reverted.\n";

        return false;
    }
    */
}
