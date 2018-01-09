<?php

namespace app\models;

use Yii;

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


}
