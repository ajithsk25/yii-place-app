<?php

use yii\db\Migration;

/**
 * Handles the creation of table `countries`.
 */
class m180524_135314_create_countries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('countries', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('countries');
    }
}
