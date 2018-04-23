<?php

use yii\db\Migration;

/**
 * Class m180416_103401_create_order_table
 */
class m180416_103401_create_order_table extends Migration
{
    public function safeUp()
    {

        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'more_info' => $this->text()->defaultValue(null),
            'date_receive' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_send' => $this->timestamp()->defaultValue(null),
            'ip' => $this->string(20)->defaultValue(null),
            'discount' => $this->decimal(8, 2)->defaultValue(null),
            'status' => $this->integer(2),
            'sum' => $this->decimal(8, 2),
            'delivery' => $this->decimal(8, 2)->defaultValue(null),
            'total' => $this->decimal(8, 2),
            'payment_type' => $this->integer(1),
            'currency_id' => $this->integer(1),
            'way_bill' => $this->string(255),
        ]);

        $this->createIndex(
            'index_status_connection',
            'order',
            'status'
        );

        $this->addForeignKey(
            'fk_order_status',
            'order',
            'status',
            'status',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->createIndex(
            'index_payment_type',
            'order',
            'payment_type'
        );

        $this->addForeignKey(
            'fk_order_payment_type',
            'order',
            'payment_type',
            'payment_type',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'index_currency_id',
            'order',
            'currency_id'
        );

        $this->addForeignKey(
            'fk_order_currency',
            'order',
            'currency_id',
            'currency',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('order_prop', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11),
            'product_id' => $this->integer(11),
            'product_quantity' => $this->integer(11),
            'price' => $this->decimal(8, 2)
        ]);

        $this->createIndex(
            'index_order_prop_order',
            'order_prop',
            'order_id'
        );

        $this->addForeignKey(
            'fk_order_prop_order',
            'order_prop',
            'order_id',
            'order',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'index_order_prop_product',
            'order_prop',
            'product_id'
        );

        $this->addForeignKey(
            'fk_order_prop_product',
            'order_prop',
            'product_id',
            'product',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'index_order_prop_attr',
            'order_prop',
            'attr_id'
        );

        $this->addForeignKey(
            'fk_order_prop_attr',
            'order_prop',
            'attr_id',
            'attribute',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'index_order_prop_attr_val',
            'order_prop',
            'attr_value'
        );

        $this->addForeignKey(
            'fk_order_prop_attr_val',
            'order_prop',
            'attr_value',
            'attribute_value',
            'id',
            'CASCADE',
            'CASCADE'
        );

    }

    public function safeDown()
    {
        $this->dropIndex(
            'index_payment_type',
            'order'
        );
        $this->dropIndex(
            'index_currency_id',
            'order'
        );

        $this->dropForeignKey(
            'fk_order_payment',
            'order'
        );
        $this->dropForeignKey(
            'fk_order_currency',
            'order'
        );

        $this->dropTable('order');

        $this->dropIndex(
            'index_order_prop_order',
            'order_prop'
        );
        $this->dropIndex(
            'index_order_prop_product',
            'order_prop'
        );
        $this->dropIndex(
            'index_order_prop_attr',
            'order_prop'
        );
        $this->dropIndex(
            'index_order_prop_attr_val',
            'order_prop'
        );

        $this->dropForeignKey(
            'fk_order_prop_order',
            'order_prop'
        );
        $this->dropForeignKey(
            'fk_order_prop_product',
            'order_prop'
        );
        $this->dropForeignKey(
            'fk_order_prop_attr',
            'order_prop'
        );
        $this->dropForeignKey(
            'fk_order_prop_attr_val',
            'order_prop'
        );

        $this->dropTable('order_prop');

    }
}
