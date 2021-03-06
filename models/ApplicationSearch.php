<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Application;

/**
 * ApplicationSearch represents the model behind the search form of `app\models\Application`.
 */
class ApplicationSearch extends Application
{
    public $clientname;
    public $clientsurname;
    public $clientfullname;
    public $coursename;
    public $socialname;
    public $statusname;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'checked', 'discount', 'paid', 'leftToPay', 'social_id', 'client_id', 'course_id', 'status_id'], 'integer'],
            [['clientfullname','statusname','socialname', 'coursename', 'clientname', 'clientsurname' ,'appReciveDate', 'appCloseDate', 'commentFromClient', 'commentFromManager', 'tagsAboutApplication', 'futureCourse'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Application::find()->joinWith(['client','course','social','status']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        $dataProvider->sort->attributes['clientname'] = [
            'asc' => ['client.name' => SORT_ASC],
            'desc' => ['client.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['clientfullname'] = [
            'asc' => ['CONCAT(client.name,client.surname)' => SORT_ASC],
            'desc' => ['CONCAT(client.name,client.surname)' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['statusname'] = [
            'asc' => ['status.value' => SORT_ASC],
            'desc' => ['status.value' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['clientsurname'] = [
            'asc' => ['client.surname' => SORT_ASC],
            'desc' => ['client.surname' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['coursename'] = [
            'asc' => ['course.name' => SORT_ASC],
            'desc' => ['course.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['socialname'] = [
            'asc' => ['social.name' => SORT_ASC],
            'desc' => ['social.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'checked' => $this->checked,
            'discount' => $this->discount,
            'paid' => $this->paid,
            'leftToPay' => $this->leftToPay,
            'social_id' => $this->social_id,
            'client_id' => $this->client_id,
            'course_id' => $this->course_id,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'commentFromClient', $this->commentFromClient])
            ->andFilterWhere(['like', 'commentFromManager', $this->commentFromManager])
            ->andFilterWhere(['like', 'tagsAboutApplication', $this->tagsAboutApplication])
            ->andFilterWhere(['like', 'futureCourse', $this->futureCourse])
            ->andFilterWhere(['like', 'appReciveDate', $this->appReciveDate])
            ->andFilterWhere(['like', 'appCloseDate', $this->appCloseDate])
            ->andFilterWhere(['like', 'client.name', $this->clientname])
            ->andFilterWhere(['like', 'client.surname', $this->clientsurname])
            ->andFilterWhere(['like', 'course.name', $this->coursename])
            ->andFilterWhere(['like', 'social.name', $this->socialname])
            ->andFilterWhere(['like', 'status.value', $this->statusname])
            ->andFilterWhere(['like', 'CONCAT(client.name,client.surname)', $this->clientfullname]);

        return $dataProvider;
    }
}
