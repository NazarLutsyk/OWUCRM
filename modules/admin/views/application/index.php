<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'clientname',
                'label' => 'Client Name'
            ],
            [
                'attribute' => 'clientsurname',
                'label' => 'Client Surname'
            ],
            [
                'attribute' => 'coursename',
                'label' => 'Course'
            ],
            'appReciveDate',
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
