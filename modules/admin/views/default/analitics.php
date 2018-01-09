<?php

/* @var $this \yii\web\View */

use app\assets\AnaliticAsset;
use yii\helpers\Html;

AnaliticAsset::register($this);
?>
<h3>Statistic by socials:</h3>
<div>
    <?= Html::dropDownList('socials', null, $socials, ['class' => 'js-example-basic-multiple', 'multiple' => true, 'id' => 'sources']) ?>
    <input name="startDate" type="date">
    <input name="endDate" type="date">
    <button id="selectByPeriod" class="btn btn-info btn-sm">Select by period</button>
    <div id="container" style="width: 90%;">
        <canvas id="canvas"></canvas>
    </div>
</div>
