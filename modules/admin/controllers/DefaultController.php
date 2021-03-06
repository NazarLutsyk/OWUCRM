<?php

namespace app\modules\admin\controllers;

use app\models\Course;
use app\models\Social;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAnalitics()
    {
        return $this->render('analitics',
            [
                'socials' => ArrayHelper::map(Social::find()->all(),'id','name'),
                'courses' => ArrayHelper::map(Course::find()->all(),'id','name'),
                'freeCourses' => ArrayHelper::map(Course::findByPrice(0)->all(),'id','name')
            ]);
    }
}
