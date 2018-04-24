<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use tomaivanovtomov\order\models\Currency;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Currency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-primary">

    <div class="panel-heading"><?= $model->isNewRecord ? $this->title : $model->sign ?></div>

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

                                    <?= $form->field($model, 'sign') ?>

                                </div>
                            </div>
                        </div>
                    </div>

                <?php else : ?>

                    <div id="<?= $key ?>" class="tab-pane fade">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-12">

                                    <?= $form->field($model, "sign_{$lang['extension']}") ?>

                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

            <?php endforeach; ?>

        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-sm-6">

                    <?= $form->field($model, 'value')->widget(MaskedInput::class, [
                        'mask' => '9{1,2}.999999999999999'
                    ]) ?>

                </div>
                <div class="col-sm-3 text-center">

                    <label class='display-b'><?= Html::activeLabel($model, 'default') ?></label>
                    <?= $model->switchField(Currency::ACTION_UPDATE, Currency::ATTRIBUTE_DEFAULT) ?>
                    <?= Html::input('hidden', 'hidden-default', $model->isNewRecord ? 2 : $model->default, ['class' => 'hidden-status']) ?>

                </div>
                <div class="col-sm-3 text-center">

                    <label class='display-b'><?= Html::activeLabel($model, 'enable') ?></label>
                    <?= $model->switchField(Currency::ACTION_UPDATE, Currency::ATTRIBUTE_ENABLE) ?>
                    <?= Html::input('hidden', 'hidden-enable', $model->isNewRecord ? 2 : $model->enable, ['class' => 'hidden-status']) ?>

                </div>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
