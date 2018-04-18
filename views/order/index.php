<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\select2\Select2;
use tomaivanovtomov\order\models\Status;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
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
            'heading' => "<i class='fa fa-archive font18'>&nbsp;&nbsp;".Html::encode($this->title)."</i>",
        ],
        'condensed' => true,
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'contentOptions' => ['class' => 'kartik-sheet-style'],
                'width' => '3%',
                'header' => '',
                'headerOptions' => ['class' => 'kartik-sheet-style']
            ],
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '3%',
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
                'attribute' => 'first_name',
                'value' => function ( $model ){
                    return isset($model->userInfo->first_name) ? Html::encode($model->userInfo->first_name) : Yii::t('app', 'Not set');
                },
                'vAlign' => 'middle',
                'width' => '20%',
            ],
            [
                'attribute' => 'email',
                'value' => function ( $model ){
                    return isset($model->userInfo->email) ? Html::encode($model->userInfo->email) : Yii::t('app', 'Not set');
                },
                'vAlign' => 'middle',
                'width' => '20%',
            ],
            [
                'attribute' => 'date_receive',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '9%',
            ],
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->getStatus();
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'status',
                    'data' => Status::getAllStatusesSelect2(),
                    'options' => [
                        'placeholder' => Yii::t('app', 'Status')
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ]),
                'hAlign' => 'center',
                'format' => 'raw',
                'width' => '15%',
            ],
            ['class' => 'kartik\grid\ActionColumn', 'template'=>'{view}','width' => '5%','header' => ""],
            ['class' => 'kartik\grid\ActionColumn', 'template'=>'{update}','width' => '5%','header' => ""],
            ['class' => 'kartik\grid\ActionColumn', 'template'=>'{delete}','width' => '5%','header' => ""],
        ],
    ]); ?>
</div>