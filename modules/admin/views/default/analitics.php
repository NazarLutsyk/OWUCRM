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
    <div id="container1" style="width: 90%;">
        <canvas id="socialStat"></canvas>
    </div>
    <hr>
    <h3>Statistic by applications:</h3>
    <div>
        <?= Html::dropDownList('courses', null, $courses, ['class' => 'js-example-basic-multiple', 'multiple' => true, 'id' => 'courses']) ?>
        <input name="start" type="date">
        <input name="end" type="date">
        <button id="selectAppsStat" class="btn btn-info btn-sm">Select</button>
        <div id="container2" style="width: 90%;">
            <canvas id="coursesStat"></canvas>
        </div>
    </div>
    <hr>
    <h3>Statistic by free courses:</h3>
    <div>
        <?= Html::dropDownList('freeCourses', null, $freeCourses, ['class' => 'js-example-basic-multiple', 'multiple' => true, 'id' => 'freeCourses']) ?>
        <input name="start2" type="date">
        <input name="end2" type="date">
        <button id="selectFreeCoursesStat" class="btn btn-info btn-sm">Select</button>
        <div id="container3" style="width: 90%;">
            <canvas id="freeCoursesStat"></canvas>
        </div>
    </div>
    <hr>
</div>
