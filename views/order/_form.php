<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use tomaivanovtomov\order\models\PaymentType;
use tomaivanovtomov\order\models\Currency;
use tomaivanovtomov\order\models\Status;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-primary">

    <div class="panel-heading"><?= $model->id ?></div>

    <div class="panel-body">

        <?php $form = ActiveForm::begin(['options' => ['multipart/form-data']]); ?>

        <!--Product info-->
        <ul class="nav nav-tabs">

            <li class="active">
                <a href="#mainInfo" data-toggle="tab"><?= Yii::t('app', 'Main information') ?></a>
            </li>
            <?php if(!empty($user)) : ?>
                <li>
                    <a href="#user_info" data-toggle="tab"><?= Yii::t('app', 'User information') ?></a>
                </li>
            <?php endif; ?>
            <li>
                <a href="#product_info" data-toggle="tab"><?= Yii::t('app', 'Products information') ?></a>
            </li>

        </ul>

        <!--Product info tabs-->
        <div class="tab-content pt20 pt20">

            <div id="mainInfo" class="tab-pane fade in active">

                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4">

                            <?= $form->field($model, 'date_receive')->widget(DateControl::class, [
                                    'displayFormat' => 'php:d-M-y H:i:s',
                                    'type' => DateControl::FORMAT_DATETIME,
                            ]) ?>

                        </div>
                        <div class="col-sm-4">

                            <?= $form->field($model, 'date_send')->widget(DateControl::class, [
                                    'displayFormat' => 'php:d-M-y H:i:s',
                                    'type' => DateControl::FORMAT_DATETIME,
                            ]) ?>

                        </div>
                        <div class="col-sm-4">

                            <?= $form->field($model, 'status')->widget(Select2::class, [
                                'data' => Status::getAllStatusesSelect2(),
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ]
                            ]) ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-3">

                            <?= $form->field($model, 'ip') ?>

                        </div>
                        <div class="col-sm-3">

                            <?= $form->field($model, 'payment_type')->widget(Select2::class, [
                                'data' => PaymentType::getAllTypesSelect2(),
                                'options' => [
                                    'placeholder' => 'Главна категория',
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ]
                            ]) ?>

                        </div>
                        <div class="col-sm-3">

                            <?= $form->field($model, 'currency_id')->widget(Select2::class, [
                                'data' => Currency::getAllCurrenciesSelect2(),
                                'options' => [
                                    'placeholder' => 'Главна категория',
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ]
                            ]) ?>

                        </div>
                        <div class="col-sm-3">

                            <?= $form->field($model, 'way_bill') ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">

                        <?= $form->field($model, 'discount') ?>

                    </div>
                    <div class="col-sm-3">

                        <?= $form->field($model, 'delivery') ?>

                    </div>
                    <div class="col-sm-3">

                        <?= $form->field($model, 'sum') ?>

                    </div>
                    <div class="col-sm-3">

                        <?= $form->field($model, 'total') ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">

                        <?= $form->field($model, 'more_info')->textarea(['rows' => 4]) ?>

                    </div>
                </div>

            </div>

            <?php if(!empty($user)): ?>

                <div id="user_info" class="tab-pane fade">

                    <pre>
                        <h3 class="text-center"><?= Yii::t('app', 'User information') ?></h3>
                    </pre>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-4">

                                <?= $form->field($user, 'first_name') ?>

                            </div>
                            <div class="col-sm-4">

                                <?= $form->field($user, 'second_name') ?>

                            </div>
                            <div class="col-sm-4">

                                <?= $form->field($user, 'last_name') ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-4">

                                <?= $form->field($user, 'email') ?>

                            </div>
                            <div class="col-sm-4">

                                <?= $form->field($user, 'city') ?>

                            </div>
                            <div class="col-sm-4">

                                <?= $form->field($user, 'address_delivery') ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-4">

                                <?= $form->field($user, 'phone') ?>

                            </div>
                            <div class="col-sm-4">

                                <?= $form->field($user, 'post_code') ?>

                            </div>
                        </div>
                    </div>

                    <?php if(!empty($company_info)): ?>

                        <pre>
                            <h3 class="text-center"><?= Yii::t('app', 'Company information') ?></h3>
                        </pre>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-4">

                                    <?= $form->field($company_info, 'name') ?>

                                </div>
                                <div class="col-sm-4">

                                    <?= $form->field($company_info, 'city') ?>

                                </div>
                                <div class="col-sm-4">

                                    <?= $form->field($company_info, 'address') ?>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-4">

                                    <?= $form->field($company_info, 'eik') ?>

                                </div>
                                <div class="col-sm-4">

                                    <?= $form->field($company_info, 'dds')->widget(Select2::class, [
                                        'data' => [
                                            1 => Yii::t('app', 'Yes'),
                                            2 => Yii::t('app', 'No'),
                                        ],
                                        'language' => Yii::$app->language,
                                        'options' => [
                                            'placeholder' => 'Главна категория',
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                        ]
                                    ]) ?>

                                </div>
                                <div class="col-sm-4">

                                    <?= $form->field($company_info, 'mol') ?>

                                </div>
                            </div>
                        </div>

                    <?php endif; ?>

                </div>

            <?php endif; ?>

            <div id="product_info" class="tab-pane fade">

            </div>

        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>