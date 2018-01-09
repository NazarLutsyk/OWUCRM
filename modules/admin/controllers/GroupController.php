<?php

namespace app\modules\admin\controllers;

use app\models\Client;
use app\models\ClientGroup;
use app\models\Course;
use Yii;
use app\models\Group;
use app\models\GroupSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupController implements the CRUD actions for Group model.
 */
class GroupController extends Controller
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
     * Lists all Group models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Group model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
            $clientDataProvider = new ActiveDataProvider([
                'query' => Client::find()
                    ->innerJoin("client_group",'client.id=client_group.client_id')
                    ->innerJoin("group",'client_group.group_id=group.id')
                    ->where("group_id=:id", array(':id' => $id))
            ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'clients' => $clientDataProvider
        ]);
    }

    /**
     * Creates a new Group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Group();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $courses = ArrayHelper::map(Course::find()->all(), 'id', 'name');
        return $this->render('create', [
            'model' => $model,
            'courses' => $courses,
        ]);
    }

    /**
     * Updates an existing Group model.
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
        $courses = ArrayHelper::map(Course::find()->all(), 'id', 'name');

        return $this->render('update', [
            'model' => $model,
            'courses' => $courses,

        ]);
    }

    /**
     * Deletes an existing Group model.
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
            $clientsRecords = Client::findClientsWitchNotFromGroupAndWithApp(Yii::$app->request->get('id'))->all();
            $clients = ArrayHelper::map($clientsRecords, 'id', 'fullname');
            return $this->render("addClients", [
                'model' => $this->findModel(Yii::$app->request->get('id')),
                'clients' => $clients
            ]);
        } elseif (Yii::$app->request->isPost) {
            $groupId = Yii::$app->request->post('id');
            $clientIds = Yii::$app->request->post('clients');

            foreach ($clientIds as $index => $clientId) {
                $relation = new ClientGroup();
                $relation->client_id = $clientId;
                $relation->group_id = $groupId;
                $relation->save();
            }

            return $this->redirect(["view",
                'id' => $groupId
            ]);
        }
    }

    public function actionExpel($client_id,$group_id){
        ClientGroup::deleteAll('client_id=:clid and group_id=:grpid',
            [':clid'=>$client_id,':grpid'=>$group_id]);
        return $this->redirect(Url::to(['/admin/group/view','id'=>$group_id]));
    }

    /**
     * Finds the Group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Group::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
