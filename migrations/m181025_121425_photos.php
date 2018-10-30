<?php

use yii\db\Migration;

/**
 * Class m181025_121425_photos
 */
class m181025_121425_photos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('photos', [
            'id' => $this->primaryKey(),
            'photo' => $this->text()->notNull(),
            'caption' => $this->text()->notNull(),
            'author' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('photos');
    }
}
