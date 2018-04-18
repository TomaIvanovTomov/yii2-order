<?php

namespace tomaivanovtomov\order\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $more_info
 * @property string $date_receive
 * @property string $date_send
 * @property string $ip
 * @property string $discount
 * @property string $sum
 * @property string $delivery
 * @property string $total
 * @property int $payment_type
 * @property int $currency_id
 * @property string $way_bill
 *
 * @property Currency $currency
 * @property PaymentType $paymentType
 * @property OrderProps[] $orderProps
 * @property Status $status
 * @property UserInfo[] $userInfo
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['more_info'], 'string'],
            [['date_receive', 'date_send'], 'safe'],
            [['discount', 'sum', 'delivery', 'total'], 'number'],
            [['status', 'payment_type', 'currency_id'], 'integer'],
            [['ip'], 'string', 'max' => 20],
            [['way_bill'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'more_info' => Yii::t('app', 'More Info'),
            'date_receive' => Yii::t('app', 'Date Receive'),
            'date_send' => Yii::t('app', 'Date Send'),
            'ip' => Yii::t('app', 'Ip'),
            'discount' => Yii::t('app', 'Discount'),
            'status' => Yii::t('app', 'Status'),
            'sum' => Yii::t('app', 'Sum'),
            'delivery' => Yii::t('app', 'Delivery'),
            'total' => Yii::t('app', 'Total'),
            'payment_type' => Yii::t('app', 'Payment Type'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'way_bill' => Yii::t('app', 'Way Bill'),
        ];
    }

    public function getStatus()
    {
        $status = Status::findOne($this->status);
        return "<span class='btn {$status->class}'>{$status->title}</span>";

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentType()
    {
        return $this->hasOne(PaymentType::className(), ['id' => 'payment_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProps()
    {
        return $this->hasMany(OrderProps::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserInfo()
    {
        return $this->hasOne(UserInfo::className(), ['order_id' => 'id']);
    }
}
