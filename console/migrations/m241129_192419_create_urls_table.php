<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%urls}}`.
 */
class m241129_192419_create_urls_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%urls}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull(),
            'test_frequency_minutes' => $this->integer()->notNull(),
            'test_error_repeats' => $this->integer()->notNull(),
            'delay_minutes' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%urls}}');
    }
}
