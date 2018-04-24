<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PaymentType */

$this->title = Yii::t('app', 'Create Payment Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
