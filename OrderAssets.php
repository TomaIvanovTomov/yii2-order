<?php

namespace tomaivanovtomov\order;

use yii\web\AssetBundle;

class OrderAssets extends AssetBundle
{
    public $sourcePath = "@vendor/tomaivanovtomov/yii2-order/src";
    public $css = [
        'css/main.css',
    ];
    public $js = [
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}