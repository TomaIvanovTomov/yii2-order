<?php

namespace tomaivanovtomov\order\models;

use tomaivanovtomov\order\components\Multilingual;
use Yii;
use yii\helpers\ArrayHelper;
use omgdef\multilingual\MultilingualQuery;
use omgdef\multilingual\MultilingualBehavior;
use yii\helpers\Html;

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
class PaymentType extends Multilingual
{
    /**
     * Used for switchField function
     */
    const ACTION_INDEX = "index";

    /**
     * Used for switchField function
     */
    const ACTION_UPDATE= "update";

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
        $string = $this->multilingualFields(['title']);

        return [
            [$string, 'string', 'max' => 255],
            ['title', 'string', 'max' => 255],
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

    /**
     * Load all records in certain html view
     *
     * @return array
     */
    public function loadTypes()
    {
        $types = PaymentType::find()->joinWith('translation')->select(['payment_type.id', 'title'])->orderBy('sort ASC')->asArray()->all();

        $output = [];

        foreach ($types as $type) {
            $output[] = [
                'content' =>
                    "<div class=\"grid-item text-danger\" style='width: auto; height: 150px;'>
                        <input type='hidden' name='Type[{$type['id']}]' value='{$type['id']}'>
                        ".mb_substr($type['title'], 0, 50, 'UTF-8')."...
                    </div>"
            ];
        }

        return $output;
    }

    /**
     * Reorder records
     *
     * @param $id
     * @param $sort
     * @return bool
     */
    public function reorderTypes($id, $sort)
    {
        $model = PaymentType::findOne((int)$id);
        $model->sort = $sort;

        if($model->update() === false){
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['payment_type' => 'id']);
    }

}
