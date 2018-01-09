<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FakeAccount */

$this->title = 'Update Fake Account: '.$model->login;
$this->params['breadcrumbs'][] = ['label' => 'Fake Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fake-account-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'fakeUsers' => $fakeUsers
    ]) ?>

</div>
