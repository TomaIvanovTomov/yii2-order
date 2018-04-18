<?php

namespace tomaivanovtomov\order\models;

use Yii;

/**
 * This is the model class for table "order_props".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $attr_id
 * @property int $attr_value
 * @property int $product_quantity
 * @property string $price
 *
 * @property Order $order
 */
class OrderProps extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_props';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'attr_id', 'attr_value', 'product_quantity'], 'integer'],
            [['price'], 'number'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'attr_id' => Yii::t('app', 'Attr ID'),
            'attr_value' => Yii::t('app', 'Attr Value'),
            'product_quantity' => Yii::t('app', 'Product Quantity'),
            'price' => Yii::t('app', 'Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
