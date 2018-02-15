<?php

namespace app\modules\admin\controllers;

use app\models\Application;
use app\models\ClientGroup;
use app\models\Group;
use app\models\TaskSearch;
use Yii;
use app\models\Client;
use app\models\ClientSearch;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class ClientController extends Controller
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
     * Lists all Client models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Client model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $client = $this->findModel($id);
        $appDataProvider = new ArrayDataProvider([
            'allModels' => $client->applications
        ]);
        $groupDataProvider = new ArrayDataProvider([
            'allModels' => Group::find()
                ->innerJoin("client_group", 'group.id=client_group.group_id')
                ->innerJoin("client", 'client_group.client_id=client.id')
                ->where("client_id=:id", array(':id' => $id))->all()
        ]);
        $taskSearch = new TaskSearch();
        $tasks = $taskSearch->search(['TaskSearch' => ['client_id' => $id]]);
        return $this->render('view', [
            'model' => $client,
            'applications' => $appDataProvider,
            'groups' => $groupDataProvider,
            'tasks' => $tasks,

        ]);
    }

    /**
     * Creates a new Client model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Client();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $clients = ArrayHelper::map(Client::find()->all(), 'id', 'fullname');

        return $this->render('create', [
            'model' => $model,
            'clients' => $clients
        ]);
    }

    /**
     * Updates an existing Client model.
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
        $clients = ArrayHelper::map(Client::find()->all(), 'id', 'fullname');

        return $this->render('update', [
            'model' => $model,
            'clients' => $clients
        ]);
    }

    /**
     * Deletes an existing Client model.
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

    public function actionAdd()
    {
        if (Yii::$app->request->isGet) {
            $groupRecords = Group::findGroupsToClient(Yii::$app->request->get('client_id'))->all();
            $groups = ArrayHelper::map($groupRecords, 'id', 'name');

            $model = Client::find()->where('id=:id', ['id' => Yii::$app->request->get('client_id')])->one();

            return $this->render("addGroups", [
                'model' => $model,
                'groups' => $groups
            ]);
        } elseif (Yii::$app->request->isPost) {
            $clientId = Yii::$app->request->post('id');
            $groupIds = Yii::$app->request->post('groups');
            foreach ($groupIds as $index => $groupId) {
                $relation = new ClientGroup();
                $relation->client_id = $clientId;
                $relation->group_id = $groupId;
                if ($relation->save()) {
                    Yii::info('Client : ' . Json::encode(Client::findOne($clientId)) .
                        'Added to group:' . Json::encode(Group::findOne($clientId)) .
                        'Admin:' . Json::encode(Yii::$app->user->identity),
                        'my_info_log');
                }
            }

            return $this->redirect(["view",
                'id' => $clientId
            ]);
        }
    }


    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Client::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
