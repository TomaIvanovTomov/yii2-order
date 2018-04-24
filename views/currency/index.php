<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use tomaivanovtomov\order\models\Currency;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CurrencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Currencies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive' => true,
        'containerOptions' => ['style' => 'overflow: hidden'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'tableOptions' => [
            'class' => "wider-rows mb10"
        ],
        // set your toolbar
        'toolbar' =>  [
            ['content' =>
                Html::a(Yii::t('app', 'Create currency'), ['create'], ['class' => 'btn btn-success', 'data-pjax' => 0])
            ],
            '{export}',
            '{toggleData}',
        ],
        // set export properties
        'export' => [
            'fontAwesome' => true
        ],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => "<i class='fa fa-adjust font18'>&nbsp;&nbsp;".Html::encode($this->title)."</i>",
        ],
        'condensed' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', 'width' => '5%'],
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '5%',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    return Yii::$app->controller->renderPartial('_expand-row-details', ['model' => $model]);
                },
                'headerOptions' => ['class' => 'kartik-sheet-style'],
                'expandOneOnly' => true
            ],
            [
                'attribute' => 'sign',
                'value' => function( $model ){
                    return Html::encode($model->sign);
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'sign',
                    'data' => Currency::getAllSignsSelect2(),
                    'options' => [
                        'placeholder' => Yii::t('app', 'All')
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ]),
                'vAlign' => 'middle',
                'width' => '20%'
            ],
            [
                'attribute' => 'value',
                'value' => function( $model ){
                    return Html::encode($model->value);
                },
                'vAlign' => 'middle',
                'width' => '20%'
            ],
            [
                'attribute' => 'enable',
                'value' => function( $model ){
                    return $model->switchField(Currency::ACTION_INDEX, Currency::ATTRIBUTE_ENABLE);
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'enable',
                    'data' => [
                        1 => Yii::t('app', 'Enable'),
                        2 => Yii::t('app', 'Disable'),
                    ],
                    'options' => [
                        'placeholder' => Yii::t('app', 'All')
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ]),
                'contentOptions' => [
                    'style' => 'padding-bottom: 15px; text-align: center;'
                ],
                'format' => 'raw',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '10%'
            ],

            ['class' => 'kartik\grid\ActionColumn', 'template'=>'{view}','width' => '5%','header' => Yii::t('app', 'View')],
            ['class' => 'kartik\grid\ActionColumn', 'template'=>'{update}','width' => '5%','header' => Yii::t('app', 'Update')],
            ['class' => 'kartik\grid\ActionColumn', 'template'=>'{delete}','width' => '5%','header' => Yii::t('app', 'Delete')],
        ],
    ]); ?>
</div>
