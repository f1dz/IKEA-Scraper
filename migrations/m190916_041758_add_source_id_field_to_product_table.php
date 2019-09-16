<?php

use yii\db\Migration;

/**
 * Class m190916_041758_add_source_id_field_to_product_table
 */
class m190916_041758_add_source_id_field_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product','source_id', $this->integer()->notNull()->after('id')->defaultValue(1));
        $this->addForeignKey('fk-product-source_id','product','source_id','product_source','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190916_041758_add_source_id_field_to_product_table cannot be reverted.\n";
        $this->dropColumn('product','source_id');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190916_041758_add_source_id_field_to_product_table cannot be reverted.\n";

        return false;
    }
    */
}
