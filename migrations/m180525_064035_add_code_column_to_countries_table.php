<?php

use yii\db\Migration;

/**
 * Handles adding code to table `countries`.
 */
class m180525_064035_add_code_column_to_countries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('countries', 'code', $this->string(15)->after('name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('countries', 'code');
    }
}
