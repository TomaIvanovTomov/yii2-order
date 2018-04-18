<?php

use yii\helpers\Html;
use kartik\grid\GridView;

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
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        // set your toolbar
        'toolbar' =>  [
            ['content' =>
                Html::a(Yii::t('app', 'Create currency'), ['create'], ['class' => 'btn btn-success', 'data-pjax' => 0])
            ],
            '{export}',
            '{toggleData}',
        ],
        'pjax' => true,
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
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'sign',
                'value' => function( $model ){
                    return Html::encode($model->sign);
                }
            ],
            [
                'attribute' => 'value',
                'value' => function( $model ){
                    return Html::encode($model->value);
                }
            ],
            /*[
                'attributes' => 'enable',
                'value' => function( $model ){
                    return $model->switch();
                }
            ],*/

            ['class' => 'kartik\grid\ActionColumn', 'template'=>'{view}','width' => '5%','header' => ""],
            ['class' => 'kartik\grid\ActionColumn', 'template'=>'{update}','width' => '5%','header' => ""],
            ['class' => 'kartik\grid\ActionColumn', 'template'=>'{delete}','width' => '5%','header' => ""],
        ],
    ]); ?>
</div>
