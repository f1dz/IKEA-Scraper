<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m190914_114906_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->integer()->unique(),
            'category' => $this->string(128),
            'sub_category' => $this->string(128),
            'sub_category_level_1' => $this->string(128),
            'sub_category_level_2' => $this->string(128),
            'sub_category_level_3' => $this->string(128),
            'full_text' => $this->string(128)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
