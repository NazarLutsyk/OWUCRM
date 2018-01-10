<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FakeAccount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fake-account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'siteUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registrationDate')->input("datetime")->widget(
        "kartik\datetime\DateTimePicker",
        [
            'name' => 'registrationDate',
            'options' => ['placeholder' => 'Select registration date ...'],
            'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-MM-dd HH:mm',
                'todayHighlight' => true,
                'autoclose' => true,
            ]
        ]) ?>

    <?= $form->field($model, 'lastVisitDate')->input("datetime")->widget(
        "kartik\datetime\DateTimePicker",
        [
            'name' => 'appReciveDate',
            'options' => ['placeholder' => 'Select last visit date ...'],
            'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-MM-dd HH:mm',
                'todayHighlight' => true,
                'autoclose' => true,
            ]
        ]) ?>

    <?= $form->field($model, 'fakeAccountComments')->textarea(['maxlength' => true]) ?>

    <div style="display: none">
        <?= $form->field($model, 'fakeUser_id')->hiddenInput(['value' => $user_id])->label("") ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
