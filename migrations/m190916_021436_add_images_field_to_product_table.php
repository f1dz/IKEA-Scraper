<?php

use yii\db\Migration;

/**
 * Class m190916_021436_add_images_field_to_product_table
 */
class m190916_021436_add_images_field_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product','images', $this->text()->after('breadcrumb'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190916_021436_add_images_field_to_product_table cannot be reverted.\n";
        $this->dropColumn('product', 'images');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190916_021436_add_images_field_to_product_table cannot be reverted.\n";

        return false;
    }
    */
}
