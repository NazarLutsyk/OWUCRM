<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Group */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'startDate')->input("datetime")->widget(
        "kartik\datetime\DateTimePicker",
        [
            'name' => 'startDate',
            'options' => ['placeholder' => 'Select start date ...'],
            'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-MM-dd HH:mm',
                'todayHighlight' => true,
                'autoclose'=>true,
            ]
        ]
    )  ?>

    <?= $form->field($model, 'course_id')->dropDownList($courses,
        [
            'prompt' => 'Select...',
            $model->course_id => ['selected' => true],
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
