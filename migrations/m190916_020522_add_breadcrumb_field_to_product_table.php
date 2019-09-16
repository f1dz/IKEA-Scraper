<?php

use yii\db\Migration;

/**
 * Class m190916_020522_add_breadcrumb_field_to_product_table
 */
class m190916_020522_add_breadcrumb_field_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'breadcrumb',$this->string(128)->after('location'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190916_020522_add_breadcrumb_field_to_product_table cannot be reverted.\n";
        $this->dropColumn('product','breadcrumb');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190916_020522_add_breadcrumb_field_to_product_table cannot be reverted.\n";

        return false;
    }
    */
}
