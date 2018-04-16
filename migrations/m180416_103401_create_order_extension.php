<?php

use yii\db\Migration;

/**
 * Class m180416_103401_create_order_extension
 */
class m180416_103401_create_order_extension extends Migration
{
    public function safeUp()
    {
        $this->createTable('currency', [
            'id' => $this->primaryKey(),
            'default' => $this->tinyInteger(1)->defaultValue(2),
            'value' => $this->decimal(8, 2),
            'enable' => $this->tinyInteger(1)->defaultValue(2),
            'country' => $this->string(50)->defaultValue(null),
            'local' => $this->string(5)->defaultValue(null)
        ]);

        $this->createTable('currencyLang', [
            'id' => $this->primaryKey(),
            'currency_id' => $this->integer(),
            'name' => $this->string(255)->defaultValue(null),
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

        $this->createTable('payment_type', [
            'id' => $this->primaryKey(),
            'enable' => $this->tinyInteger(1)->defaultValue(2),
            'sort' => $this->integer(11)->defaultValue(999)
        ]);

        $this->createTable('payment_typeLang', [
            'id' => $this->primaryKey(),
            'payment_id' => $this->integer(11),
            'name' => $this->string(255)->defaultValue(null),
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

        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'more_info' => $this->text()->defaultValue(null),
            'date_receive' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_send' => $this->timestamp(),
            'ip' => $this->string(20)->defaultValue(null),
            'discount' => $this->decimal(8, 2)->defaultValue(null),
            'status' => $this->tinyInteger(2)->defaultValue(1),
            'sum' => $this->decimal(8, 2),
            'delivery' => $this->decimal(8, 2)->defaultValue(null),
            'total' => $this->decimal(8, 2),
            'payment_type' => $this->integer(1),
            'currency_id' => $this->integer(1),
            'way_bill' => $this->string(255),
        ]);

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

        $this->createTable('user_info', [
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

        $this->createTable('company_info', [
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

        $this->createTable('order_props', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11),
            'product_id' => $this->integer(11),
            'attr_id' => $this->integer(11),
            'attr_value' => $this->integer(11),
            'product_quantity' => $this->integer(11),
            'price' => $this->decimal(8, 2)
        ]);

        $this->createIndex(
            'index_order_prop_order',
            'order_props',
            'order_id'
        );

        $this->addForeignKey(
            'fk_order_prop_order',
            'order_props',
            'order_id',
            'order',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'index_order_prop_product',
            'order_props',
            'product_id'
        );

        $this->addForeignKey(
            'fk_order_prop_product',
            'order_props',
            'product_id',
            'product',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'index_order_prop_attr',
            'order_props',
            'attr_id'
        );

        $this->addForeignKey(
            'fk_order_prop_attr',
            'order_props',
            'attr_id',
            'attribute',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'index_order_prop_attr_val',
            'order_props',
            'attr_value'
        );

        $this->addForeignKey(
            'fk_order_prop_attr_val',
            'order_props',
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
            'index_currency_lang',
            'currencyLang'
        );

        $this->dropForeignKey(
            'fk_currency_lang',
            'currencyLang'
        );

        $this->dropTable('currencyLang');
        $this->dropTable('currency');

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
            'index_order_user_info',
            'user_info'
        );
        $this->dropIndex(
            'index_user_info_user',
            'user_ifno'
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

        $this->dropIndex(
            'index_company_info',
            'company_info'
        );

        $this->dropForeignKey(
            'fk_user_company_info',
            'company_info'
        );

        $this->dropTable('company_info');

        $this->dropIndex(
            'index_order_prop_order',
            'order_props'
        );
        $this->dropIndex(
            'index_order_prop_product',
            'order_props'
        );
        $this->dropIndex(
            'index_order_prop_attr',
            'order_props'
        );
        $this->dropIndex(
            'index_order_prop_attr_val',
            'order_props'
        );

        $this->dropForeignKey(
            'fk_order_prop_order',
            'order_props'
        );
        $this->dropForeignKey(
            'fk_order_prop_product',
            'order_props'
        );
        $this->dropForeignKey(
            'fk_order_prop_attr',
            'order_props'
        );
        $this->dropForeignKey(
            'fk_order_prop_attr_val',
            'order_props'
        );

        $this->dropTable('order_props');

    }
}
