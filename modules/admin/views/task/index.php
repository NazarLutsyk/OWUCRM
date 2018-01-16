<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            $now = new DateTime();
            $dateExec = new DateTime($model->dateExec);
            if ($now->format('Y-m-d') == $dateExec->format('Y-m-d') && $model->checked == false) {
                return ['style' => 'background-color:#f0ad4e;'];
            }
            if ($now > $dateExec && $model->checked == false) {
                return ['style' => 'background-color:#d9534f;'];
            }
            if ($model->checked == 1) {
                return ['style' => 'background-color:#5cb85c;'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'value',
            'dateExec',
            [
                'attribute' => 'clientname',
                'label' => 'Client',
                'value' => function($model){
                    return Html::a($model->clientname,[\yii\helpers\Url::to(['/admin/client/view','id'=>$model->client_id])]);
                },
                'format' => 'html'
            ],
            'checked',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
