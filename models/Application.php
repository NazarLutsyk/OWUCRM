<?php

namespace app\models;

use yii\helpers\ArrayHelper;

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
 * @property int $status_id
 *
 * @property Client $client
 * @property Course $course
 * @property Social $social
 * @property Status $status
 * @property Payment[] $payments
 */
class Application extends \yii\db\ActiveRecord
{

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (empty($this->discount))
                $this->discount = 0;
            if (empty($this->leftToPay))
                $this->leftToPay = 0;
            if (empty($this->paid))
                $this->paid = 0;
            if (empty($this->checked))
                $this->checked = 0;
            if (empty($this->appReciveDate)){
                $dateTime = new \DateTime('now', new \DateTimeZone('Europe/Kiev'));
                $dateTime->format('Y/m/d H:i');
                $dateTime->sub(new \DateInterval('PT1H'));
                $this->appReciveDate = date('Y/m/d H:i',$dateTime->getTimestamp());

            }
            return true;
        }
        return false;
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
            [[/*'appReciveDate',*/ 'appCloseDate', 'client_id', 'course_id'], 'required'],
            [['discount'], 'integer', 'min' => 0, 'max' => 100],
            [['appReciveDate', 'appCloseDate'], 'safe'],
            [['checked', 'paid', 'leftToPay', 'social_id', 'client_id', 'course_id','status_id'], 'integer'],
            [['commentFromClient', 'commentFromManager', 'tagsAboutApplication', 'futureCourse'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['social_id'], 'exist', 'skipOnError' => true, 'targetClass' => Social::className(), 'targetAttribute' => ['social_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
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
            'status_id' => 'Status ID',
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
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['application_id' => 'id']);
    }

    public function getClientName()
    {
        return $this->client->name;
    }

    public function getClientSurname()
    {
        return $this->client->surname;
    }

    public function getClientfullname(){
        return $this->client->getFullname();
    }

    public function getCourseName()
    {
        return $this->course->name;
    }

    public function getSocialName()
    {
        return $this->social->name;
    }

    public function getApplicationName()
    {
        return $this->client->getFullname() . '(' . $this->course->name . ')';
    }

    public function getStatusName()
    {
        return $this->status->value;
    }

    public static function getSocialStatisticByPeriod($startDate, $endDate, $socials)
    {
        if (!$startDate)
            $startDate = '1970/01/01';
        if (!$endDate)
            $endDate = '3000/01/01';
        if (sizeof($socials) <= 0) {
            $socials = ArrayHelper::getColumn(Social::find()->select('id')->asArray()->all(), 'id');
            if (sizeof($socials) <= 0)
                return null;
        }
        return Application::find()
            ->select('s.name, count(s.id) as count')
            ->innerJoin('social s', 'application.social_id = s.id')
            ->where('appReciveDate >=:startDate', ['startDate' => $startDate])
            ->andWhere('appReciveDate <=:endDate', ['endDate' => $endDate])
            ->andWhere(['in', 's.id', $socials])
            ->groupBy('s.name');
    }

    public static function getAppStatByCourses($startDate, $endDate, $courses)
    {
        if (!$startDate)
            $startDate = '1970/01/01';
        if (!$endDate)
            $endDate = '3000/01/01';
        if (sizeof($courses) <= 0) {
            $courses = ArrayHelper::getColumn(Course::find()->select('id')->asArray()->all(), 'id');
            if (sizeof($courses) <= 0)
                return null;
        }
        return Application::find()
            ->select('c.name, count(c.id) as count')
            ->innerJoin('course c', 'application.course_id = c.id')
            ->where('appReciveDate >=:startDate', ['startDate' => $startDate])
            ->andWhere('appReciveDate <=:endDate', ['endDate' => $endDate])
            ->andWhere(['in', 'c.id', $courses])
            ->groupBy('c.name');
    }

}
