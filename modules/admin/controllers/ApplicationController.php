<?php

namespace app\modules\admin\controllers;

use app\controllers\MyHelper;
use app\models\Client;
use app\models\Course;
use app\models\Payment;
use app\models\Social;
use Yii;
use app\models\Application;
use app\models\ApplicationSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ApplicationController implements the CRUD actions for Application model.
 */
class ApplicationController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Application models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ApplicationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Application model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $paymentDataProvider = new ActiveDataProvider([
            'query' => Payment::find()
                ->where("application_id=:id", array(':id' => $id))
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'payment' => $paymentDataProvider
        ]);
    }

    /**
     * Creates a new Application model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Application();

        if ($model->load(Yii::$app->request->post())) {
            $model->leftToPay = MyHelper::calculatePrice($model->course->price, $model->discount);
            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        }
        $socials = ArrayHelper::map(Social::find()->all(), 'id', 'name');
        $clients = ArrayHelper::map(Client::find()->all(), 'id', 'fullname');
        $courses = ArrayHelper::map(Course::find()->all(), 'id', 'name');
        return $this->render('create', [
            'model' => $model,
            'socials' => $socials,
            'clients' => $clients,
            'courses' => $courses,
        ]);
    }

    /**
     * Updates an existing Application model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $socials = ArrayHelper::map(Social::find()->all(), 'id', 'name');
        $clients = ArrayHelper::map(Client::find()->all(), 'id', 'fullname');
        $courses = ArrayHelper::map(Course::find()->all(), 'id', 'name');
        return $this->render('update', [
            'model' => $model,
            'socials' => $socials,
            'clients' => $clients,
            'courses' => $courses,
        ]);
    }

    /**
     * Deletes an existing Application model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCheck($id)
    {
        $app = $this->findModel($id);
//        $app->checked = !$app->checked;
        if ($app->checked){
            $app->checked = 0;
        }else{
            $app->checked = 1;
        }
        $app->save();
        return $this->redirect(['view',"id"=>$id]);
    }

    /**
     * Finds the Application model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Application the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Application::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
