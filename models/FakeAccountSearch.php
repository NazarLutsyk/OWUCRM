<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FakeAccount;

/**
 * FakeAccountSearch represents the model behind the search form of `app\models\FakeAccount`.
 */
class FakeAccountSearch extends FakeAccount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fakeUser_id'], 'integer'],
            [['login', 'password', 'siteUrl', 'registrationDate', 'lastVisitDate', 'fakeAccountComments'], 'safe'],
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
        $query = FakeAccount::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fakeUser_id' => $this->fakeUser_id,
        ]);

        $query->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'siteUrl', $this->siteUrl])
            ->andFilterWhere(['like', 'lastVisitDate', $this->lastVisitDate])
            ->andFilterWhere(['like', 'registrationDate', $this->registrationDate])
            ->andFilterWhere(['like', 'fakeAccountComments', $this->fakeAccountComments]);

        return $dataProvider;
    }
}
