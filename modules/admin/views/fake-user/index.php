<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FakeUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fake Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fake-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fake User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'surname',
            'phone',
            'email:email',
            //'images',
            //'fakeUserComments',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
