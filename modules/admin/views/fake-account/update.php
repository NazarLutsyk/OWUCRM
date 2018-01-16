<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FakeAccount */

$this->title = 'Update Fake Account: '.$model->login;
$this->params['breadcrumbs'][] = ['label' => 'Fake Users', 'url' => ['/admin/fake-user/index']];
$this->params['breadcrumbs'][] = ['label' => $model->fakeUser->getFullName(), 'url' => ['/admin/fake-user/view','id'=>$model->fakeUser_id]];
$this->params['breadcrumbs'][] = ['label' => $model->login, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fake-account-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user_id' => $model->fakeUser_id
    ]) ?>

</div>
