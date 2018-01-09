<?php

namespace app\modules\admin\controllers;
use app\models\Application;
use app\models\Social;
use Yii;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class RestController extends ActiveController
{
    public $modelClass = '';
    public function actionGet(){
        $startDateStr = Yii::$app->request->post('startDate');
        $endDateStr = Yii::$app->request->post('endDate');
        $socials = Yii::$app->request->post('socials');

        return Application::getSocialStatisticByPeriod($startDateStr,$endDateStr,$socials)->asArray()->all();
    }
}