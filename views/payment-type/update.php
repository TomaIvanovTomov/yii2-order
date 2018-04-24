<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentType */

$this->title = Yii::t('app', 'Update Payment Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="payment-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
