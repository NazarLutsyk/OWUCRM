<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $phone
 * @property string $city
 * @property string $commentsAboutClient
 * @property string $tagsAboutClient
 * @property int $recomendation_id
 *
 * @property Application[] $applications
 * @property Client $recomendation
 * @property Client[] $clients
 * @property ClientGroup[] $clientGroups
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'phone'], 'required'],
            [['recomendation_id'], 'integer'],
            [['name', 'surname', 'email', 'phone', 'city', 'commentsAboutClient', 'tagsAboutClient'], 'string', 'max' => 255],
            [['recomendation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['recomendation_id' => 'id']],
            [['email'], 'email'],
            [['fullname'], 'safe'],
            [['phone'], 'match', 'pattern' => ' /^(1[ \-\+]{0,3}|\+1[ -\+]{0,3}|\+1|\+)?((\(\+?1-[2-9][0-9]{1,2}\))|(\(\+?[2-8][0-9][0-9]\))|(\(\+?[1-9][0-9]\))|(\(\+?[17]\))|(\([2-9][2-9]\))|([ \-\.]{0,3}[0-9]{2,4}))?([ \-\.][0-9])?([ \-\.]{0,3}[0-9]{2,4}){2,3}$/'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'phone' => 'Phone',
            'city' => 'City',
            'commentsAboutClient' => 'Comments About Client',
            'tagsAboutClient' => 'Tags About Client',
            'recomendation_id' => 'Recomendation',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::className(), ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecomendation()
    {
        return $this->hasOne(Client::className(), ['id' => 'recomendation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['recomendation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientGroups()
    {
        return $this->hasMany(ClientGroup::className(), ['client_id' => 'id']);
    }

    public function getFullname()
    {
        return $this->name . " " . $this->surname;
    }

    public static function findClientsWitchNotFromGroupAndWithApp($groupId)
    {
        $group = Group::find()->where('id=:id', ['id' => $groupId])->one();
        $clientsWithApp = Client::find()
            ->select('client.id')
            ->innerJoin('application a', 'client.id=a.client_id')
            ->innerJoin("course c", 'a.course_id=c.id')
            ->where('c.id=:cid', ['cid' => $group->course_id])
            ->andWhere('a.checked=0');
        $clientsInGroup = Client::find()
            ->select('client.id')
            ->innerJoin("client_group cg", 'client.id=cg.client_id')
            ->innerJoin("group g", 'cg.group_id=g.id')
            ->innerJoin("course c", 'g.course_id = c.id')
            ->where('c.id=:cid', ['cid' => $group->course_id]);
        $clients = Client::find()
            ->where(['in', 'id', $clientsWithApp])
            ->andWhere(['not in', 'id', $clientsInGroup]);
        return $clients;
    }
}
