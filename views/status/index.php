<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use tomaivanovtomov\order\models\Status;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Statuses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-type-index">

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
                'attribute' => 'title',
                'value' => function( $model ){
                    return Html::encode($model->title);
                },
                'vAlign' => 'middle',
                'width' => '65%'
            ],
            [
                'attribute' => 'enable',
                'value' => function( $model ){
                    return $model->switchField(Status::ACTION_INDEX);
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

        ],
    ]); ?>
</div>