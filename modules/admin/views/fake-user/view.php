<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FakeUser */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Fake Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fake-user-view">

    <div>
        <?= Html::img(Yii::getAlias('@web') . '/' . $model->images, ['height' => '200', 'width' => '150', 'style' => ['float'=>'right']]); ?>
        <div>
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
            'images',
            'fakeUserComments',
        ],
    ]) ?>

</div>
