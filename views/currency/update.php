<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Currency */

$this->title = Yii::t('app', 'Update Currency');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Currencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="currency-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
