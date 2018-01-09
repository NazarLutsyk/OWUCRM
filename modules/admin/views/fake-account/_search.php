<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FakeAccountSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fake-account-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'login') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'siteUrl') ?>

    <?= $form->field($model, 'registrationDate') ?>

    <?php // echo $form->field($model, 'lastVisitDate') ?>

    <?php // echo $form->field($model, 'fakeAccountComments') ?>

    <?php // echo $form->field($model, 'fakeUser_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
