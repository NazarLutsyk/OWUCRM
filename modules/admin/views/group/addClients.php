<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Group */

$this->title = 'Add client';
$this->params['breadcrumbs'][] = ['label' => 'Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Add clients';
?>
<div class="group-view">
    <h1>Select clients</h1>
    <form class="form" method="POST">
        <div class="form-group">
            <input type="hidden" name="id" value="<?=$model->id?>">
            <?=Html::dropDownList("clients",$clients,$clients,['multiple'=>true, 'class' => 'js-example-basic-single'
            ])?>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->csrfToken?>">
        </div>
        <div>
            <input type="submit" class="btn btn-success">
        </div>
    </form>
</div>