<?php

use yii\db\Migration;

/**
 * Handles the creation of table `currency`.
 */
class m180418_082719_create_currency_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('currency', [
            'id' => $this->primaryKey(),
            'default' => $this->tinyInteger(1)->defaultValue(2),
            'value' => $this->decimal(12, 10),
            'enable' => $this->tinyInteger(1)->defaultValue(2),
        ]);

        $this->createTable('currencyLang', [
            'id' => $this->primaryKey(),
            'currency_id' => $this->integer(),
            'sign' => $this->string(10)->defaultValue(null),
            'language' => $this->string(5),
        ]);

        $this->createIndex(
            'index_currency_lang',
            'currencyLang',
            'currency_id'
        );

        $this->addForeignKey(
            'fk_currency_lang',
            'currencyLang',
            'currency_id',
            'currency',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->insert('currency', [
            'id' => 1,
            'default' => 1,
            'value' => 1,
            'enable' => 1,
        ]);
        $this->insert('currencyLang', [
            'id' => 1,
            'currency_id' => 1,
            'sign' => 'лв.',
            'language' => 'bg',
        ]);
        $this->insert('currencyLang', [
            'id' => 2,
            'currency_id' => 1,
            'sign' => 'BGN',
            'language' => 'en',
        ]);

        $this->insert('currency', [
            'id' => 2,
            'default' => 2,
            'value' => 0.51118952,
            'enable' => 2
        ]);
        $this->insert('currencyLang', [
            'id' => 3,
            'currency_id' => 2,
            'sign' => 'EUR',
            'language' => 'bg',
        ]);
        $this->insert('currencyLang', [
            'id' => 4,
            'currency_id' => 2,
            'sign' => 'EUR',
            'language' => 'en',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'index_currency_lang',
            'currencyLang'
        );

        $this->dropForeignKey(
            'fk_currency_lang',
            'currencyLang'
        );

        $this->dropTable('currencyLang');
        $this->dropTable('currency');
    }
}
