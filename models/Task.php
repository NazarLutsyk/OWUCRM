<?php

namespace app\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $value
 * @property string $dateExec
 * @property int $client_id
 * @property int $checked
 * @property Client $client
 */
class Task extends \yii\db\ActiveRecord
{

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            Yii::info('Task created: ' . Json::encode($this) .
                'Admin:' . Json::encode(Yii::$app->user->identity),
                'my_info_log');
        } else {
            Yii::info('Task updated: ' . Json::encode($this) .
                'Admin:' . Json::encode(Yii::$app->user->identity),
                'my_info_log');
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        Yii::info('Task deleted: ' . Json::encode($this) .
            'Admin:' . Json::encode(Yii::$app->user->identity),
            'my_info_log');
        parent::afterDelete();
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (empty($this->checked))
                $this->checked = 0;
            return true;
        }
        return false;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dateExec'], 'safe'],
            [['client_id','checked'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['client_id'],'required'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'dateExec' => 'Date Exec',
            'checked' => 'Checked',
            'client_id' => 'Client ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }

    public function getClientname(){
        return $this->client->getFullname();
    }
}
