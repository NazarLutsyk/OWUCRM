<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ApplicationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="application-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'appReciveDate') ?>

    <?= $form->field($model, 'appCloseDate') ?>

    <?= $form->field($model, 'commentFromClient') ?>

    <?= $form->field($model, 'commentFromManager') ?>

    <?php // echo $form->field($model, 'tagsAboutApplication') ?>

    <?php // echo $form->field($model, 'futureCourse') ?>

    <?php // echo $form->field($model, 'checked') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'paid') ?>

    <?php // echo $form->field($model, 'leftToPay') ?>

    <?php // echo $form->field($model, 'social_id') ?>

    <?php // echo $form->field($model, 'client_id') ?>

    <?php // echo $form->field($model, 'course_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
