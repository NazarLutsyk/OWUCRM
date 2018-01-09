<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FakeAccount */

$this->title = 'Create Fake Account';
$this->params['breadcrumbs'][] = ['label' => 'Fake Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $fakeUserName, 'url' => ['/admin/fake-user/view', 'id' => $user_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fake-account-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user_id' => $user_id,
    ]) ?>

</div>
