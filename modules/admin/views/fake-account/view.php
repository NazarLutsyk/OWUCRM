<?php

use app\controllers\MyHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FakeAccount */

$this->title = $model->login;
$this->params['breadcrumbs'][] = ['label' => 'Fake Users', 'url' => ['/admin/fake-user/index']];
$this->params['breadcrumbs'][] = ['label' => $model->fakeUser->getFullName(), 'url' => ['/admin/fake-user/view','id'=>$model->fakeUser_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fake-account-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'login',
            'password',
            'siteUrl',
            'registrationDate',
            'lastVisitDate',
            [
                'attribute' => 'fakeAccountComments',
                'value' => function ($model) {
                    return MyHelper::buildDomArray($model->fakeAccountComments, ';');
                },
                'format' => 'html'
            ],
            'fakeUser_id',
        ],
    ]) ?>

</div>
