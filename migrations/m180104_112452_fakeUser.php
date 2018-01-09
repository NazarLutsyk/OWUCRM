<?php

use yii\db\Migration;

/**
 * Class m180104_112452_fakeUser
 */
class m180104_112452_fakeUser extends Migration
{
    public function up()
    {
        $this->createTable('fakeUser',[
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'images' => $this->string(),
            'fakeUserComments' => $this->string()
        ]);
    }

    public function down()
    {
        $this->dropTable('fakeUser');
    }
}
