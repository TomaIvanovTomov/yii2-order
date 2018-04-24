<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>

<div class="page-admin-view">

    <div class="row">

        <div class="col-sm-12">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'title',
                        'value' => function( $model ){
                            return Html::encode($model->title);
                        },
                        'contentOptions' => [
                            'class' => 'index-title'
                        ]
                    ],
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

    </div>

</div>