<?php

use yii\db\Migration;

/**
 * Handles the creation of table `payment_type`.
 */
class m180418_074541_create_payment_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('payment_type', [
            'id' => $this->primaryKey(),
            'enable' => $this->tinyInteger(1)->defaultValue(2),
            'sort' => $this->integer(11)->defaultValue(999)
        ]);

        $this->createTable('payment_typeLang', [
            'id' => $this->primaryKey(),
            'payment_id' => $this->integer(11),
            'title' => $this->string(255)->defaultValue(null),
            'language' => $this->string(5)
        ]);

        $this->createIndex(
            'index_payment_lang',
            'payment_typeLang',
            'payment_id'
        );

        $this->addForeignKey(
            'fk_payment_lang',
            'payment_typeLang',
            'payment_id',
            'payment_type',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->insert('payment_type', [
            'id' => 1,
            'enable' => 1,
            'sort' => 1
        ]);
        $this->insert('payment_typeLang', [
            'id' => 1,
            'status_id' => 1,
            'title' => 'Наложен платеж',
            'language' => 'bg',
        ]);
        $this->insert('payment_typeLang', [
            'id' => 2,
            'status_id' => 1,
            'title' => 'Cash on delivery',
            'language' => 'en',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'index_payment_lang',
            'payment_typeLang'
        );

        $this->dropForeignKey(
            'fk_payment_lang',
            'payment_typeLang'
        );

        $this->dropTable('payment_typeLang');
        $this->dropTable('payment_type');
    }
}
