<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dateExec')->input("datetime")->widget(
        "kartik\datetime\DateTimePicker",
        [
            'name' => 'startDate',
            'options' => ['placeholder' => 'Select close date ...'],
            'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-MM-dd HH:mm',
                'todayHighlight' => true,
                'autoclose'=>true,
            ]
        ]
    ) ?>

    <?if(empty($client_id)):?>
        <?= $form->field($model, 'client_id')->dropDownList(
            $clients,
            [
                'class' => 'js-example-basic-single',
                'name' => 'client_id',
                'id' => 'client_id'
            ]
        )->label('Client') ?>
    <?else:?>
        <div style="display: none">
            <?= $form->field($model, 'client_id')->hiddenInput(['value' => $client_id]) ?>
        </div>
    <?endif;?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
