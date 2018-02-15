<?php

use yii\helpers\Html;

$this->title = 'Add client';
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Add Groups';
?>
<div class="group-view">
    <h1>Select Group</h1>
    <form class="form" method="POST">
        <div class="form-group">
            <input type="hidden" name="id" value="<?=$model->id?>">
            <?=Html::dropDownList("groups",$groups,$groups,
                ['multiple'=>true, 'class' => 'js-example-basic-single','required' => true])?>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->csrfToken?>">
        </div>
        <div>
            <input type="submit" class="btn btn-success">
        </div>
    </form>
</div>