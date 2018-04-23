<?php

namespace tomaivanovtomov\order\models;

use Yii;

/**
 * This is the model class for table "company_info".
 *
 * @property int $id
 * @property int $user_info_id
 * @property string $name
 * @property string $city
 * @property string $address
 * @property string $eik
 * @property int $dds
 * @property string $mol
 *
 * @property UserInfo $userInfo
 */
class CompanyInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $required = ['dds', 'name', 'address', 'city', 'eik', 'mol'];

        return [
            [$required, 'required'],
            ['dds', 'integer'],
            [['name', 'city', 'address', 'eik', 'mol'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_info_id' => Yii::t('app', 'User Info ID'),
            'name' => Yii::t('app', 'Name'),
            'city' => Yii::t('app', 'City'),
            'address' => Yii::t('app', 'Address'),
            'eik' => Yii::t('app', 'Eik'),
            'dds' => Yii::t('app', 'Dds'),
            'mol' => Yii::t('app', 'Mol'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserInfo()
    {
        return $this->hasOne(UserInfo::className(), ['id' => 'user_info_id']);
    }
}
