<?php

use yii\db\Migration;

/**
 * Class m180423_113150_create_table_user_info
 */
class m180423_113150_create_table_user_info extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_user_info', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11),
            'user_id' => $this->integer(11),
            'first_name' => $this->string(255)->defaultValue(null),
            'second_name' => $this->string(255)->defaultValue(null),
            'last_name' => $this->string(255)->defaultValue(null),
            'email' => $this->string(255)->defaultValue(null),
            'city' => $this->string(255)->defaultValue(null),
            'address_delivery' => $this->string(255)->defaultValue(null),
            'phone' => $this->string(50)->defaultValue(null),
            'post_code' => $this->integer(10)->defaultValue(null),
        ]);

        $this->createIndex(
            'index_order_user_info',
            'user_info',
            'order_id'
        );

        $this->addForeignKey(
            'fk_order_user_info',
            'user_info',
            'order_id',
            'order',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'index_user_info_user',
            'user_info',
            'user_id'
        );

        $this->addForeignKey(
            'fk_user_info_user',
            'user_info',
            'user_id',
            'user',
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
            'index_order_user_info',
            'user_info'
        );
        $this->dropIndex(
            'index_user_info_user',
            'user_info'
        );

        $this->dropForeignKey(
            'fk_order_user_info',
            'user_info'
        );
        $this->dropForeignKey(
            'fk_user_info_user',
            'user_info'
        );

        $this->dropTable('user_info');

        return false;
    }

}
