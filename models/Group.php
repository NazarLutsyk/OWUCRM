<?php

namespace app\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $name
 * @property string $room
 * @property string $startDate
 * @property int $course_id
 *
 * @property ClientGroup[] $clientGroups
 * @property Course $course
 */
class Group extends \yii\db\ActiveRecord
{

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            Yii::info('Group: ' . Json::encode($this) .
                'Admin:' . Json::encode(Yii::$app->user->identity),
                'my_info_log');
        } else {
            Yii::info('Group: ' . Json::encode($this) .
                'Admin:' . Json::encode(Yii::$app->user->identity),
                'my_info_log');
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        Yii::info('Group: ' . Json::encode($this) .
            'Admin:' . Json::encode(Yii::$app->user->identity),
            'my_info_log');
        parent::afterDelete();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['startDate'], 'safe'],
            [['course_id'], 'integer'],
            [['name', 'room'], 'string', 'max' => 255],
            [['startDate', 'course_id', 'name'], 'required'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
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
            'room' => 'Room',
            'startDate' => 'Start Date',
            'course_id' => 'Course',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientGroups()
    {
        return $this->hasMany(ClientGroup::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * @return string
     */
    public function getCourseName()
    {
        return $this->course->name;
    }


    public static function findGroupsToClient($clientId)
    {
        $client = Client::find()->where('id=:id', ['id' => $clientId])->one();

        $clientApplications = Application::find()
            ->select('c.id')
            ->innerJoin('course c', 'application.course_id = c.id')
            ->where('client_id=:cid', ['cid' => $client->id])
            ->andWhere('checked=0');


        $groupsWithThisClient = Group::find()
            ->select('group.id')
            ->innerJoin("client_group cg", 'group.id=cg.group_id')
            ->innerJoin("client c", 'c.id=cg.client_id')
            ->where('c.id=:id',['id'=>$client->id]);

        $groups = Group::find()
            ->select('id,name')
            ->where(['in', 'course_id', $clientApplications])
            ->andWhere(['not in', 'id', $groupsWithThisClient]);

        return $groups;


    }

}
