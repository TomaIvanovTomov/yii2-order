<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'title',
                'value' => function( $model ){
                    return Html::encode($model->title);
                }
            ],
            'sort',
            [
                'attribute' => 'enable',
                'value' => function( $model ){
                    return $model->enable == 1 ? "<i class='fa fa-check bg-green check-cross'></i>" : "<i class='fa fa-times bg-red check-cross'></i>";
                },
                'format' => 'raw',
            ],
        ],
    ]) ?>

</div>