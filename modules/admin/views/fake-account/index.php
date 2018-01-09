<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FakeAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fake Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fake-account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fake Account', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'login',
            'password',
            'siteUrl',
            'registrationDate',
            //'lastVisitDate',
            //'fakeAccountComments',
            //'fakeUser_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
