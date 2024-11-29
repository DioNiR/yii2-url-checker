<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%url_checks}}`.
 */
class m241129_192549_create_url_checks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%url_checks}}', [
            'id' => $this->primaryKey(),
            'url_id' => $this->integer()->notNull(),
            'status_code' => $this->integer()->notNull(),
            'response' => $this->text(),
            'try_number' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%url_checks}}');
    }
}
