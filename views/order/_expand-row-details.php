<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Brand;

?>

<div class="page-admin-view">

    <div class="row">
        <div class="col-sm-12">
            <p class="mt10 pull-right">
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['data-pjax' => 0, 'class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'data-pjax' => 0,
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-12">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'date_receive',
                        'value' => function( $model ){
                            return Html::encode(Yii::$app->formatter->asDatetime($model->date_receive, "long"));
                        },
                    ],
                    [
                        'attribute' => 'date_send',
                        'value' => function( $model ){
                            return Html::encode(Yii::$app->formatter->asDatetime($model->date_receive, "long"));
                        },
                    ],
                    'ip',
                    [
                        'attribute' => 'currency_id',
                        'value' => function( $model ){
                            return Html::encode($model->currency->sign);
                        }
                    ],
                    [
                        'attribute' => 'way_bill',
                        'value' => function( $model ){
                            return Html::encode($model->way_bill);
                        }
                    ],
                    'discount',
                    'delivery',
                    'sum',
                    'total',
                    [
                        'attribute' => 'more_info',
                        'value' => function( $model ){
                            return Html::encode($model->more_info);
                        }
                    ],
                ],
            ]) ?>
        </div>

    </div>

</div>