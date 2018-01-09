<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FakeUser */

$this->title = 'Create Fake User';
$this->params['breadcrumbs'][] = ['label' => 'Fake Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fake-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
