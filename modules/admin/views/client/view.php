<?php

use app\controllers\MyHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = $model->getFullname();
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-view">

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
            'name',
            'surname',
            'email:email',
            'phone',
            'city',
            [
                'attribute' => 'commentsAboutClient',
                'value' => function ($model) {
                    return MyHelper::buildDomArray($model->commentsAboutClient, ';');
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'tagsAboutClient',
                'value' => function ($model) {
                    return MyHelper::buildDomArray($model->tagsAboutClient, ';');
                },
                'format' => 'html'
            ],
            [
                'label' => "Recommendation client",
                'attribute' => 'recomendation.fullname',
                'value' =>
                    Html::a($model->recomendation->fullname,
                        ['/admin/client/view', 'id' => $model->recomendation_id]
                    ),
                'format' => 'html'
            ],
        ],
    ]) ?>

</div>
