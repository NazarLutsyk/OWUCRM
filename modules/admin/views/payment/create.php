<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Payment */

$this->title = 'Create Payment';
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => \app\models\Application::findOne($app_id)->applicationname, 'url' => ['/admin/application/view','id'=>$app_id]];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'app_id' => $app_id
    ]) ?>

</div>
