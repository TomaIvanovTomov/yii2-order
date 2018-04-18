<?php

namespace tomaivanovtomov\order\models;

use Yii;
use yii\helpers\ArrayHelper;
use omgdef\multilingual\MultilingualQuery;
use omgdef\multilingual\MultilingualBehavior;

/**
 * This is the model class for table "payment_type".
 *
 * @property int $id
 * @property int $enable
 * @property int $sort
 *
 * @property Order[] $orders
 * @property PaymentTypelang[] $paymentTypelangs
 */
class PaymentType extends \yii\db\ActiveRecord
{
    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    public function behaviors()
    {
        $allLanguages = [];
        foreach (Yii::$app->params['languages'] as $title => $language) {
            $allLanguages[$title] = $language;
        }

        return [
            'ml' => [
                'class' => MultilingualBehavior::className(),
                'languages' => $allLanguages,
                //'languageField' => 'language',
                //'localizedPrefix' => '',
                //'requireTranslations' => false',
                //'dynamicLangClass' => true',
                //'langClassName' => PostLang::className(), // or namespace/for/a/class/PostLang
                'defaultLanguage' => Yii::$app->params['languageDefault'],
                'langForeignKey' => 'payment_id',
                'tableName' => "{{%payment_typeLang}}",
                'attributes' => [
                    'title',
                ]
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort', 'enable'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'enable' => Yii::t('app', 'Enable'),
            'sort' => Yii::t('app', 'Sort'),
        ];
    }

    public static function getAllTypesSelect2()
    {
        return ArrayHelper::map(PaymentType::findAll(['enable' => 1]), 'id', 'title');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['payment_type' => 'id']);
    }

}
