<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "fakeUser".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property string $email
 * @property string $images
 * @property string $fakeUserComments
 *
 * @property FakeAccount[] $fakeAccounts
 */
class FakeUser extends \yii\db\ActiveRecord
{
    public $upload;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fakeUser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'phone', 'email', 'images', 'fakeUserComments'], 'string', 'max' => 255],
            [['name', 'surname', 'phone'], 'required'],
            [['email'], 'email'],
            [['fullname'], 'safe'],
            [['upload'], 'file', 'extensions' => 'png, jpg, jpeg, gif'],
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
            'phone' => 'Phone',
            'email' => 'Email',
            'images' => 'Images',
            'fakeUserComments' => 'Fake User Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFakeAccounts()
    {
        return $this->hasMany(FakeAccount::className(), ['fakeUser_id' => 'id']);
    }

    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function uploadFile()
    {
        $this->upload = UploadedFile::getInstance($this, 'upload');
        if ($this->upload) {
            $filePath = 'uploads/' . $this->upload->baseName . '.' . $this->upload->extension;
            if ($this->upload->saveAs($filePath,false)) {
                $this->images = $filePath;
                return true;
            }
        }
        return false;
    }
}
