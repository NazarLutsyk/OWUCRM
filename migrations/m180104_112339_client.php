<?php

use yii\db\Migration;

/**
 * Class m180104_112339_client
 */
class m180104_112339_client extends Migration
{
    public function up()
    {
        $this->createTable("client",[
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'city' => $this->string(),
            'status' => $this->string(),
            'commentsAboutClient' => $this->string(),
            'tagsAboutClient' => $this->string(),
            'recomendation_id' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable("client");
    }
}
