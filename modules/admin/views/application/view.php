<?php

use app\controllers\MyHelper;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Application */

$this->title = $model->client->getFullname() . '(' . $model->course->name . ')';
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-view">
    <h1>
        <?= Html::a($model->client->getFullname(), ['/admin/client/view', 'id' => $model->client_id]) ?>
        <?= '(' . $model->course->name . ')' ?>
    </h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Check', ['check', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Pay', ['/admin/payment/create', 'app_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'clientfullname',
                'label' => 'Client',
                'value' => function($model){
                    return Html::a($model->clientfullname,[\yii\helpers\Url::to(['/admin/client/view','id'=>$model->client_id])]);
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'statusname',
                'label' => 'Status'
            ],
            'appReciveDate',
            'appCloseDate',
            'discount',
            'paid',
            'leftToPay',
            [
                'attribute' => 'commentFromClient',
                'value' => function ($model) {
                    return MyHelper::buildDomArray($model->commentFromClient, ';');
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'commentFromManager',
                'value' => function ($model) {
                    return MyHelper::buildDomArray($model->commentFromManager, ';');
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'tagsAboutApplication',
                'value' => function ($model) {
                    return MyHelper::buildDomArray($model->tagsAboutApplication, ';');
                },
                'format' => 'html'
            ],
            'futureCourse',
            [
                'attribute' => 'socialname',
                'label' => 'Social'
            ],
            'checked',
        ],
    ]) ?>

    <h2>Payments</h2>
    <?= GridView::widget([
        'dataProvider' => $payment,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'amount',
            'date',
        ],
    ]); ?>

</div>
