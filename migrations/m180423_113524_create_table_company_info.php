<?php

use yii\db\Migration;

/**
 * Class m180423_113524_create_table_order_company_info
 */
class m180423_113524_create_table_order_company_info extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_company_info', [
            'id' => $this->primaryKey(),
            'user_info_id' => $this->integer(11),
            'name' => $this->string(255)->defaultValue(null),
            'city' => $this->string(255)->defaultValue(null),
            'address' => $this->string(255)->defaultValue(null),
            'eik' => $this->string(255)->defaultValue(null),
            'dds' => $this->tinyInteger(1)->defaultValue(2),
            'mol' => $this->string(255)->defaultValue(null)
        ]);

        $this->createIndex(
            'index_company_info',
            'company_info',
            'user_info_id'
        );

        $this->addForeignKey(
            'fk_user_company_info',
            'company_info',
            'user_info_id',
            'user_info',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'index_company_info',
            'company_info'
        );

        $this->dropForeignKey(
            'fk_user_company_info',
            'company_info'
        );

        $this->dropTable('company_info');
    }

}
