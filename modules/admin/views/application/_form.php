<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Application */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="application-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->dropDownList($clients,
        [
            'prompt' => 'Select client...',
            $model->client_id => ['selected' => true],
        ])->label('Client')?>

    <?= $form->field($model, 'course_id')->dropDownList($courses,
        [
            'prompt' => 'Select course...',
            $model->course_id => ['selected' => true],
        ])->label('Course')?>

    <?= $form->field($model, 'appReciveDate')->input("datetime")->widget(
        "kartik\datetime\DateTimePicker",
        [
            'name' => 'appReciveDate',
            'options' => ['placeholder' => 'Select recive date ...'],
            'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-MM-dd HH:mm',
                'todayHighlight' => true,
                'autoclose'=>true,
            ]
        ]
    )?>

    <?= $form->field($model, 'appCloseDate')->input("datetime")->widget(
        "kartik\datetime\DateTimePicker",
        [
            'name' => 'startDate',
            'options' => ['placeholder' => 'Select close date ...'],
            'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-MM-dd HH:mm',
                'todayHighlight' => true,
                'autoclose'=>true,
            ]
        ]
    ) ?>

    <?= $form->field($model, 'commentFromClient')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'commentFromManager')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'tagsAboutApplication')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'futureCourse')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount')->textInput() ?>

    <?= $form->field($model, 'social_id')->dropDownList($socials,
        [
            'prompt' => 'Select social...',
            $model->social_id => ['selected' => true],
        ])->label('Social')?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
