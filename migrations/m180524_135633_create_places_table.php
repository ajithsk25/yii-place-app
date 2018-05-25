<?php

use yii\db\Migration;

/**
 * Handles the creation of table `places`.
 */
class m180524_135633_create_places_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('places', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'country_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `country_id`
        $this->createIndex(
            'idx-places-country_id',
            'places',
            'country_id'
        );

        // add foreign key for table `places`
        $this->addForeignKey(
            'fk-places-country_id',
            'places',
            'country_id',
            'countries',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `places`
        $this->dropForeignKey(
            'fk-places-country_id',
            'places'
        );

        // drops index for column `country_id`
        $this->dropIndex(
            'idx-places-country_id',
            'places'
        );

        $this->dropTable('places');
    }
}
