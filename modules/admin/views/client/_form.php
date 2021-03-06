<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'type' => 'phone']) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'commentsAboutClient')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'tagsAboutClient')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'recomendation_id')->dropDownList(
        $clients,
        [
            'prompt' => 'Select...',
            'class' => 'js-example-basic-single',
            $model->recomendation_id => ['selected' => true]
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
