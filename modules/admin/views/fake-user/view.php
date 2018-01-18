<?php

use app\controllers\MyHelper;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\FakeUser */

$this->title = $model->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Fake Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fake-user-view">

    <div>
        <?
        if (!empty($model->images)) {
            foreach ($model->getImagesArr() as $image) {
                echo Html::img(
                    Yii::getAlias('@web') . '/' . $image,
                    [
                        'height' => '200',
                        'width' => '150',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'title' => $image,
                        'style' =>
                            [
                                'float' => 'right'
                            ]
                    ]
                );
            }
        }
        ?>
        <div>
            <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Create account', ['/admin/fake-account/create', 'user_id' => $model->id], ['class' => 'btn btn-success']); ?>
                <?= Html::a('Manage images', ['images', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'surname',
            'phone',
            'email:email',
            [
                'attribute' => 'images',
                'value' => function ($model) {
                    return MyHelper::buildDomArray($model->images, ',');
                },
                'format' => 'html'
            ],
            'fakeUserComments',
        ],
    ]) ?>

        <?= GridView::widget([
            'dataProvider' => $fakeaccs,
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

                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            $url = \yii\helpers\Url::toRoute(['/admin/fake-account/view', 'id' => $model->id]);
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('yii', 'Create'),
                            ]);
                        },
                        'update' => function ($url, $model) {
                            $url = \yii\helpers\Url::toRoute(['/admin/fake-account/update', 'id' => $model->id]);
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('yii', 'Update'),
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            $url = \yii\helpers\Url::toRoute(['/admin/fake-account/delete', 'id' => $model->id]);
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('yii', 'Delete'),
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]);
                        }
                    ]
                ]
            ],
        ]); ?>

</div>
