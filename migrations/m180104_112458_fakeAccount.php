<?php

use yii\db\Migration;

/**
 * Class m180104_112458_fakeAccount
 */
class m180104_112458_fakeAccount extends Migration
{
    public function up()
    {
        $this->createTable('fakeAccount', [
            'id' => $this->primaryKey(),
            'login' => $this->string(),
            'password' => $this->string(),
            'siteUrl' => $this->string(),
            'registrationDate' => $this->date(),
            'lastVisitDate' => $this->date(),
            'fakeAccountComments' => $this->string(),
            'fakeUser_id' => $this->integer(),
        ]);
    }

    public function down()
    {
        echo "m180104_112458_fakeAccount cannot be reverted.\n";

        return false;
    }
}
