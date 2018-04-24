<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use tomaivanovtomov\order\models\PaymentType;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-primary">

<div class="panel-heading"><?= $model->isNewRecord ? $this->title : $model->title ?></div>

<div class="panel-body">

    <?= $this->render('../lang_tabs') ?>

    <?php $form = ActiveForm::begin(); ?>

    <div class="tab-content pt20 pb20">

        <?php foreach (Yii::$app->params['language-information'] as $key => $lang) : ?>

            <?php if(Yii::$app->params['languageDefault'] == $lang['extension']) : ?>

                <div id="BG" class="tab-pane fade in active">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-12">

                                <?= $form->field($model, 'title') ?>

                            </div>
                        </div>
                    </div>
                </div>

            <?php else : ?>

                <div id="<?= $key ?>" class="tab-pane fade">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-12">

                                <?= $form->field($model, "title_{$lang['extension']}") ?>

                            </div>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

        <?php endforeach; ?>

    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-sm-3 text-center pull-right">

                <label class='display-b'><?= Html::activeLabel($model, 'enable') ?></label>
                <?= $model->switchField(PaymentType::ACTION_UPDATE) ?>
                <?= Html::input('hidden', 'hidden-enable', $model->isNewRecord ? 2 : $model->enable, ['class' => 'hidden-status']) ?>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-sm-12">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>