<?php

namespace app\modules\admin\controllers;

use app\models\Application;
use app\models\Client;
use app\models\Social;
use Yii;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\Controller;

class RestController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::className(),
            'actions' => [
                'getStatBySocials' => ['post'],
                'getStatByCourses' => ['post'],
                'getStatByFreeCourses' => ['post'],
            ],
        ];

        return $behaviors;
    }


    public $modelClass = '';

    public function actionGetStatBySocials()
    {
        $startDateStr = Yii::$app->request->post('startDate');
        $endDateStr = Yii::$app->request->post('endDate');
        $socials = Yii::$app->request->post('socials');
        return Application::getSocialStatisticByPeriod($startDateStr, $endDateStr, $socials)->asArray()->all();
    }

    public function actionGetStatByCourses()
    {
        $startDateStr = Yii::$app->request->post('startDate');
        $endDateStr = Yii::$app->request->post('endDate');
        $courses = Yii::$app->request->post('courses');
        return Application::getAppStatByCourses($startDateStr, $endDateStr, $courses)->asArray()->all();
    }

    public function actionGetStatByFreeCourses(){
//        $startDateStr = Yii::$app->request->post('startDate');
//        $endDateStr = Yii::$app->request->post('endDate');
        $courses = Yii::$app->request->post('courses');
        return Client::getClientStatByFreeCourses(/*$startDateStr, $endDateStr,*/ $courses)->asArray()->all();
    }
}