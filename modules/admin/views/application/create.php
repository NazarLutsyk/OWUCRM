<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Application */

$this->title = 'Create Application';
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'socials' => $socials,
        'clients' => $clients,
        'courses' => $courses,
        'statuses' => $statuses,
        'client_id' => $client_id

    ]) ?>

</div>
