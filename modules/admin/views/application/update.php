<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Application */

$this->title = 'Update Application: '.$model->client->getFullname() . '(' . $model->course->name . ')';

$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->client->getFullname() . '(' . $model->course->name . ')', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="application-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'socials' => $socials,
        'clients' => $clients,
        'courses' => $courses,
        'statuses' => $statuses,

    ]) ?>

</div>
