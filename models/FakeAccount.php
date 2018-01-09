<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fakeAccount".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $siteUrl
 * @property string $registrationDate
 * @property string $lastVisitDate
 * @property string $fakeAccountComments
 * @property int $fakeUser_id
 *
 * @property FakeUser $fakeUser
 */
class FakeAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fakeAccount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lastVisitDate'], 'safe'],
            [['login','password','siteUrl','fakeUser_id','registrationDate'], 'required'],
            [['fakeUser_id'], 'integer'],
            [['login', 'password', 'siteUrl', 'fakeAccountComments'], 'string', 'max' => 255],
            [['fakeUser_id'], 'exist', 'skipOnError' => true, 'targetClass' => FakeUser::className(), 'targetAttribute' => ['fakeUser_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'siteUrl' => 'Site Url',
            'registrationDate' => 'Registration Date',
            'lastVisitDate' => 'Last Visit Date',
            'fakeAccountComments' => 'Fake Account Comments',
            'fakeUser_id' => 'Fake User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFakeUser()
    {
        return $this->hasOne(FakeUser::className(), ['id' => 'fakeUser_id']);
    }
}
