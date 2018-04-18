<?php

namespace tomaivanovtomov\order\models;

use tomaivanovtomov\order\models\CompanyInfo;
use tomaivanovtomov\order\models\Order;
use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property int $id
 * @property int $order_id
 * @property int $user_id
 * @property string $first_name
 * @property string $second_name
 * @property string $last_name
 * @property string $email
 * @property string $city
 * @property string $address_delivery
 * @property string $phone
 * @property int $post_code
 *
 * @property CompanyInfo[] $companyInfo
 * @property Order $order
 * @property User $user
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'post_code'], 'integer'],
            [['first_name', 'second_name', 'last_name', 'email', 'city', 'address_delivery'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
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
            'user_id' => Yii::t('app', 'User ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'second_name' => Yii::t('app', 'Second Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
            'city' => Yii::t('app', 'City'),
            'address_delivery' => Yii::t('app', 'Address Delivery'),
            'phone' => Yii::t('app', 'Phone'),
            'post_code' => Yii::t('app', 'Post Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyInfo()
    {
        return $this->hasOne(CompanyInfo::className(), ['user_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
