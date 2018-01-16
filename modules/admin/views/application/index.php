<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ApplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Applications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Application', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            $color = $model->status->color;
            if (!empty($color))
                return ['style' => "background-color:${color};"];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'clientfullname',
                'label' => 'Client',
                'value' => function ($model) {
                    return Html::a($model->clientfullname, [\yii\helpers\Url::to(['/admin/client/view', 'id' => $model->client_id])]);
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'coursename',
                'label' => 'Course'
            ],
            'appReciveDate',
            [
                'attribute' => 'statusname',
                'label' => 'Status'
            ],
            'discount',
            'paid',
            'leftToPay',
            'appCloseDate',
            //'commentFromClient',
            //'commentFromManager',
            //'tagsAboutApplication',
            //'futureCourse',
            [
                'attribute' => 'socialname',
                'label' => 'Social'
            ],
            'checked',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
