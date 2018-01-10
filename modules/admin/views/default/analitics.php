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
    <button id="selectByPeriod" class="btn btn-info btn-sm">Select</button>
    <div id="container" style="width: 90%;">
        <canvas id="canvas"></canvas>
    </div>

    <h3>Statistic by applications:</h3>
    <div>
        <?= Html::dropDownList('courses', null, $courses, ['class' => 'js-example-basic-multiple', 'multiple' => true, 'id' => 'courses']) ?>
        <input name="start" type="date">
        <input name="end" type="date">
        <button id="selectAppsStat" class="btn btn-info btn-sm">Select</button>
        <div id="appStatContainer">
            <h1 style="color: green"></h1>
        </div>
    </div>
</div>
