<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Task;

/**
 * TaskSearch represents the model behind the search form of `app\models\Task`.
 */
class TaskSearch extends Task
{
    public $clientname;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'checked'], 'integer'],
            [['value', 'dateExec','clientname'], 'safe'],
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
        $query = Task::find()->joinWith(['client']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['clientname'] = [
            'asc' => ['CONCAT(client.name,client.surname)' => SORT_ASC],
            'desc' => ['CONCAT(client.name,client.surname)' => SORT_DESC],
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
            'client_id' => $this->client_id,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value]);
        $query->andFilterWhere(['like', 'dateExec', $this->dateExec]);
        $query->andFilterWhere(['like', 'CONCAT(client.name,client.surname)', $this->clientname]);

        return $dataProvider;
    }
}
