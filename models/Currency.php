<?php

namespace tomaivanovtomov\order\models;

use Yii;
use yii\helpers\ArrayHelper;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property int $default
 * @property string $value
 * @property int $enable
 *
 * @property Currencylang[] $currencylangs
 * @property Order[] $orders
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * Used for switchField function
     */
    const ACTION_INDEX = "index";

    /**
     * Used for switchField function
     */
    const ACTION_UPDATE= "update";

    /**
     * Used for switchField function
     */
    const ATTRIBUTE_DEFAULT = "default";

    /**
     * Used for switchField function
     */
    const ATTRIBUTE_ENABLE = "enable";

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
                'langForeignKey' => 'currency_id',
                'tableName' => "{{%currencyLang}}",
                'attributes' => [
                    'sign',
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $string = $this->multilingualFields(['sign']);

        return [
            [['sign', 'value'], 'required'],
            [['value'], 'double'],
            [$string, 'string', 'max' => 10],
            ['sign', 'string', 'max' => 10],
            [['default', 'enable'], 'integer'],
        ];
    }

    /**
     * Fill multilingual fields
     *
     * @param $model
     * @param array $props
     */
    public function multilingualLoad($model, $props = [])
    {
        $model_name = explode('\\', get_class($model));
        $model_name = end($model_name);

        foreach (Yii::$app->params['languages'] as $language) {
            if (Yii::$app->params['languageDefault'] != $language) {
                foreach ($props as $property) {
                    $prop_lang = "{$property}_{$language}";
                    $model->$prop_lang = Yii::$app->request->post($model_name)["{$property}_{$language}"];
                }
            }
        }
    }

   /**
    * Iterate over the array of fileds and adds language suffix if the language is not default
    * @param $fields
    * @return array
    */
    private function multilingualFields($fields)
    {

        $output = [];

        foreach ($fields as $field) {
            foreach (Yii::$app->params['languages'] as $language) {
                if (Yii::$app->params['languageDefault'] != $language) {
                    $output[] = "{$field}_{$language}";
                }
            }
        }

        return $output;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'default' => Yii::t('app', 'Default'),
            'value' => Yii::t('app', 'Value'),
            'enable' => Yii::t('app', 'Enable'),
        ];
    }

    public static function getAllCurrenciesSelect2()
    {
        return ArrayHelper::map(Currency::findAll(['enable' => 1]), 'id', 'sign');
    }

    public static function getAllSignsSelect2()
    {
        return ArrayHelper::map(Currency::findAll(['enable' => 1]), 'sign', 'sign');
    }

    public function switchField($action, $attribute)
    {
        $checked = "";
        $controller = Yii::$app->controller->id;
        if($this->$attribute == 1){
            $checked = 'checked';
        }
        return "<input type=\"checkbox\" 
                        $checked 
                        id=\"{$attribute}_{$this->id}\" 
                        class=\"codepen-checkbox\" 
                        onchange=\"changeSwitch(
                                        '{$this->id}',
                                         this, 
                                         '{$controller}', 
                                         '{$action}',
                                     )\">
                <label for=\"{$attribute}_{$this->id}\">
                    <span class=\"check\"></span>
                </label>";
    }

    /**
     * If current value is set to default, turn off all others
     *
     * @param $value
     * @return bool
     */
    public function checkIfDefault($value)
    {
        if($value == 1){
            Yii::$app->db->createCommand("UPDATE `currency` SET `currency`.`default`=2")->execute();
        }

        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['currency_id' => 'id']);
    }
}
