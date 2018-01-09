<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property string $appReciveDate
 * @property string $appCloseDate
 * @property string $commentFromClient
 * @property string $commentFromManager
 * @property string $tagsAboutApplication
 * @property string $futureCourse
 * @property int $checked
 * @property int $discount
 * @property int $paid
 * @property int $leftToPay
 * @property int $social_id
 * @property int $client_id
 * @property int $course_id
 *
 * @property Client $client
 * @property Course $course
 * @property Social $social
 * @property Payment[] $payments
 */
class Application extends \yii\db\ActiveRecord
{
    public function init()
    {
        $this->discount = 0;
        $this->paid = 0;
        $this->leftToPay = 0;
        $this->checked = 0;
        parent::init();
    }

    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'application';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['appReciveDate', 'appCloseDate', 'client_id', 'course_id'], 'required'],
            [['discount'],'integer', 'min' => 0, 'max' => 100],
            [['appReciveDate', 'appCloseDate'], 'safe'],
            [['checked', 'paid', 'leftToPay', 'social_id', 'client_id', 'course_id'], 'integer'],
            [['commentFromClient', 'commentFromManager', 'tagsAboutApplication', 'futureCourse'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['social_id'], 'exist', 'skipOnError' => true, 'targetClass' => Social::className(), 'targetAttribute' => ['social_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'appReciveDate' => 'App Recive Date',
            'appCloseDate' => 'App Close Date',
            'commentFromClient' => 'Comment From Client',
            'commentFromManager' => 'Comment From Manager',
            'tagsAboutApplication' => 'Tags About Application',
            'futureCourse' => 'Future Course',
            'checked' => 'Checked',
            'discount' => 'Discount',
            'paid' => 'Paid',
            'leftToPay' => 'Left To Pay',
            'social_id' => 'Social ID',
            'client_id' => 'Client ID',
            'course_id' => 'Course ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocial()
    {
        return $this->hasOne(Social::className(), ['id' => 'social_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['application_id' => 'id']);
    }

    public function getClientName(){
        return $this->client->name;
    }

    public function getClientSurname(){
        return $this->client->surname;
    }

    public function getCourseName(){
        return $this->course->name;
    }

    public function getSocialName(){
        return $this->social->name;
    }

    public function getApplicationName(){
        return $this->client->getFullname().'('.$this->course->name.')';
    }
}
