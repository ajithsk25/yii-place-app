<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tours`.
 */
class m180524_162304_create_tours_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tours', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'country_id' => $this->integer()->notNull(),
            'place_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `country_id`
        $this->createIndex(
            'idx-tours-country_id',
            'tours',
            'country_id'
        );

        // creates index for column `place_id`
        $this->createIndex(
            'idx-tours-place_id',
            'tours',
            'place_id'
        );

        // add foreign key for table `tours`
        $this->addForeignKey(
            'fk-tours-country_id',
            'tours',
            'country_id',
            'countries',
            'id',
            'CASCADE'
        );

        // add foreign key for table `tours`
        $this->addForeignKey(
            'fk-tours-place_id',
            'tours',
            'place_id',
            'places',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `countries`
        $this->dropForeignKey(
            'fk-tours-country_id',
            'places'
        );

        // drops index for column `country_id`
        $this->dropIndex(
            'idx-tours-country_id',
            'places'
        );

        // drops foreign key for table `countries`
        $this->dropForeignKey(
            'fk-tours-place_id',
            'places'
        );

        // drops index for column `country_id`
        $this->dropIndex(
            'idx-tours-place_id',
            'places'
        );

        $this->dropTable('tours');
    }
}
