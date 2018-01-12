<?php

use app\controllers\MyHelper;
use yii\grid\GridView;
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
            'status',
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

    <?php if ($applications->count > 0): ?>
        <?= GridView::widget([
            'dataProvider' => $applications,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
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
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            $url = \yii\helpers\Url::toRoute(['/admin/application/view', 'id' => $model->id]);
                            return Html::a('SHOW', $url,
                                [
                                    'title' => Yii::t('yii', 'View'),
                                    'class' => 'btn btn-primary btn-xs'
                                ]);
                        },
                    ]
                ],
            ],
        ]); ?>
    <?php endif; ?>

    <?php if ($groups->count > 0): ?>
    <?= GridView::widget([
        'dataProvider' => $groups,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'room',
            'startDate',
            [
                'label' => 'Course',
                'attribute' => 'coursename',
                'value' => function ($model) {
                    return Html::a($model->course->name,
                        ['/admin/course/view', 'id' => $model->course_id]
                    );
                },
                'format' => 'html'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = \yii\helpers\Url::toRoute(['/admin/group/view', 'id' => $model->id]);
                        return Html::a('SHOW', $url,
                            [
                                'title' => Yii::t('yii', 'View'),
                                'class' => 'btn btn-primary btn-xs'
                            ]);
                    },
                ]
            ],
        ],
    ]); ?>
    <?php endif; ?>

</div>
