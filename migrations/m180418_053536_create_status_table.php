<?php

use yii\db\Migration;

/**
 * Handles the creation of table `status`.
 */
class m180418_053536_create_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('status', [
            'id' => $this->primaryKey(),
            'enable' => $this->tinyInteger(1)->defaultValue(2),
            'class' => $this->string(20)
        ]);

        $this->createTable('statusLang', [
            'id' => $this->primaryKey(),
            'status_id' => $this->integer(),
            'title' => $this->string(100),
            'language' => $this->string(100),
        ]);

        $this->createIndex(
            'index-status',
            'statusLang',
            'status_id'
        );

        $this->addForeignKey(
            'fk_status_lang',
            'statusLang',
            'status_id',
            'status',
            'id'
        );

        $this->insert('status', [
            'id' => 1,
            'enable' => 1,
            'class' => 'btn-primary'
        ]);
        $this->insert('statusLang', [
            'id' => 1,
            'status_id' => 1,
            'title' => 'Необработена',
            'language' => 'bg',
        ]);
        $this->insert('statusLang', [
            'id' => 2,
            'status_id' => 1,
            'title' => 'Untreated',
            'language' => 'en',
        ]);

        $this->insert('status', [
            'id' => 2,
            'enable' => 1,
            'class' => 'btn-danger'
        ]);
        $this->insert('statusLang', [
            'id' => 3,
            'status_id' => 2,
            'title' => 'Няма в наличност или отказана',
            'language' => 'bg',
        ]);
        $this->insert('statusLang', [
            'id' => 4,
            'status_id' => 2,
            'title' => 'Not available or refused',
            'language' => 'en',
        ]);

        $this->insert('status', [
            'id' => 3,
            'enable' => 1,
            'class' => 'btn-warning'
        ]);
        $this->insert('statusLang', [
            'id' => 5,
            'status_id' => 3,
            'title' => 'Изпратена',
            'language' => 'bg',
        ]);
        $this->insert('statusLang', [
            'id' => 6,
            'status_id' => 3,
            'title' => 'Sent',
            'language' => 'en',
        ]);

        $this->insert('status', [
            'id' => 4,
            'enable' => 1,
            'class' => 'btn-danger'
        ]);
        $this->insert('statusLang', [
            'id' => 7,
            'status_id' => 4,
            'title' => 'Върнатa',
            'language' => 'bg',
        ]);
        $this->insert('statusLang', [
            'id' => 8,
            'status_id' => 4,
            'title' => 'Returned',
            'language' => 'en',
        ]);

        $this->insert('status', [
            'id' => 5,
            'enable' => 1,
            'class' => 'btn-success'
        ]);
        $this->insert('statusLang', [
            'id' => 9,
            'status_id' => 5,
            'title' => 'Платена',
            'language' => 'bg',
        ]);
        $this->insert('statusLang', [
            'id' => 10,
            'status_id' => 5,
            'title' => 'Paid',
            'language' => 'en',
        ]);

        $this->insert('status', [
            'id' => 6,
            'enable' => 1,
            'class' => 'btn-danger'
        ]);
        $this->insert('statusLang', [
            'id' => 11,
            'status_id' => 6,
            'title' => 'Неплатена',
            'language' => 'bg',
        ]);
        $this->insert('statusLang', [
            'id' => 12,
            'status_id' => 6,
            'title' => 'Unpaid',
            'language' => 'en',
        ]);

        $this->insert('status', [
            'id' => 7,
            'enable' => 1,
            'class' => 'btn-success'
        ]);
        $this->insert('statusLang', [
            'id' => 13,
            'status_id' => 7,
            'title' => 'Завършена',
            'language' => 'bg',
        ]);
        $this->insert('statusLang', [
            'id' => 14,
            'status_id' => 7,
            'title' => 'Finished',
            'language' => 'en',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'index-status',
            'statusLang'
        );

        $this->dropForeignKey(
            'fk_status_lang',
            'statusLang'
        );

        $this->dropTable('statusLang');
        $this->dropTable('status');
    }
}
