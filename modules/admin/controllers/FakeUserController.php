<?php

namespace app\modules\admin\controllers;

use app\models\FakeAccount;
use Yii;
use app\models\FakeUser;
use app\models\FakeUserSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FakeUserController implements the CRUD actions for FakeUser model.
 */
class FakeUserController extends Controller
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
     * Lists all FakeUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FakeUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FakeUser model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $fakeAccDataProvider = new ActiveDataProvider([
            'query' => FakeAccount::find()
                ->where("fakeUser_id=:id", array(':id' => $id))
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'fakeaccs' => $fakeAccDataProvider
        ]);
    }

    /**
     * Creates a new FakeUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FakeUser();

        if ($model->load(Yii::$app->request->post())) {
            $model->uploadFile();
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FakeUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->uploadFile();
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FakeUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $fakeUser = $this->findModel($id);
        $fakeUser->deleteImages();
        $fakeUser->delete();

        return $this->redirect(['index']);
    }

    public function actionImages($id)
    {
        return $this->render('images', [
                'model' => $this->findModel($id)
            ]
        );
    }

    public function actionAddImage()
    {
        $id = ArrayHelper::getValue(Yii::$app->request->post('FakeUser'), 'id');
        $fakeUser = $this->findModel($id);
        $fakeUser->uploadFile();
        $fakeUser->save(false);
        return $this->render('images', [
                'model' => $this->findModel($id)
            ]
        );
    }

    public function actionDeleteImage()
    {
        $id = Yii::$app->request->post('id');
        $fileName = Yii::$app->request->post('image');
        $fakeUser = $this->findModel($id);
        if (unlink($fileName)){
            Yii::info(
                'Deleted image: '.$fileName.
                'From fake user: '.Json::encode($fakeUser).
                'Admin:'.Json::encode(Yii::$app->user->identity),
                'my_info_log');
            $fakeUser->setImagesArr(array_diff($fakeUser->getImagesArr(),[$fileName]));
            $fakeUser->save(false);
        }
        return $this->render('images', [
                'model' => $this->findModel($id)
            ]
        );
    }

    /**
     * Finds the FakeUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FakeUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FakeUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
