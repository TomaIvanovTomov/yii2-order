<?php

namespace tomaivanovtomov\order\models;

use tomaivanovtomov\order\components\Multilingual;
use Yii;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 *
 * @property Statuslang[] $statuslangs
 */
class Status extends Multilingual
{
    /**
    * Used for switchField function
    */
    const ACTION_INDEX = "index";

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
                'langForeignKey' => 'status_id',
                'tableName' => "{{%statusLang}}",
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
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $string = $this->multilingualFields(['title']);

        return [
            ['title', 'required'],
            ['title', 'string', 'max' => 100],
            [$string, 'string', 'max' => 100],
            ['enable', 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
        ];
    }

    public static function getAllTypesSelect2()
    {
        return ArrayHelper::map(PaymentType::findAll(['enable' => 1]), 'id', 'title');
    }

    public function switchField($action)
    {
        $checked = "";
        $controller = Yii::$app->controller->id;
        if($this->enable == 1){
            $checked = 'checked';
        }
        return "<input type=\"checkbox\" 
                        $checked 
                        id=\"enable_{$this->id}\" 
                        class=\"codepen-checkbox\" 
                        onchange=\"changeSwitch(
                                        '{$this->id}',
                                         this, 
                                         '{$controller}', 
                                         '{$action}',
                                     )\">
                <label for=\"enable_{$this->id}\">
                    <span class=\"check\"></span>
                </label>";
    }

    public static function getAllStatusesSelect2()
    {
        return ArrayHelper::map(Status::findAll(['enable' => 1]), 'id', 'title');
    }

    public function getOrders()
    {
        return $this->hasMany(Order::class, ['status' => 'id']);
    }

}
