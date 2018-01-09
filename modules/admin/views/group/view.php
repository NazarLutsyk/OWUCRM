<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Group */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-view">

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
        <?= Html::a('Add clients', ['add', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'room',
            'startDate',
            'courseName',
        ],
    ]) ?>

    <?php if ($clients->count > 0): ?>
    <?= GridView::widget([
        'dataProvider' => $clients,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'surname',
            'email:email',
            'phone',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}',
                'buttons' => [
                    'myButton' => function ($url, $client, $key) use ($model) {
                        return Html::a("DELETE",
                            \yii\helpers\Url::to(['/admin/group/expel', 'client_id' =>$client->id,'group_id'=>$model->id]),
                            ['class' => 'btn btn-danger btn-xs']);
                    }
                ]
            ]
        ],
    ]); ?>
    <?php endif;?>
</div>
