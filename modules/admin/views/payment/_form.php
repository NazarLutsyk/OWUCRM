<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'date')->input("datetime")->widget(
        "kartik\datetime\DateTimePicker",
        [
            'name' => 'appReciveDate',
            'options' => ['placeholder' => 'Select payment date ...'],
            'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-MM-dd HH:mm',
                'todayHighlight' => true,
                'autoclose' => true,
            ]
        ]) ?>
    <div style="display: none">
        <?= $form->field($model, 'application_id')->hiddenInput(['value' => $app_id])->label("") ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success','id'=>'create-payment']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
    document.getElementById("create-payment").addEventListener('click', function(evt){
        var amount = parseInt(document.getElementById('payment-amount').value);
        if (typeof amount === 'number' && !isNaN(amount)){
            var submmittedAmount = prompt('Please submit the amount: ' + amount);
            if (amount != submmittedAmount){
                return evt.preventDefault();
            }
        }else {
            return evt.preventDefault();
        }
    });
JS;
$this->registerJs($script);
?>
