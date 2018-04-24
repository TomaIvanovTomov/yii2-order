<?php

namespace tomaivanovtomov\order\components;

use Yii;
use yii\db\ActiveRecord;

/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 24.4.2018 г.
 * Time: 11:39
 */
class Multilingual extends ActiveRecord
{

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
    protected function multilingualFields($fields)
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

}