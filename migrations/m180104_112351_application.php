<?php

use yii\db\Migration;

/**
 * Class m180104_112351_application
 */
class m180104_112351_application extends Migration
{
    public function up()
    {
        $this->createTable("application",[
            'id' => $this->primaryKey(),
            'appReciveDate'=> $this->dateTime(),
            'appCloseDate'=> $this->dateTime(),
            'commentFromClient' => $this->string(),
            'commentFromManager' => $this->string(),
            'tagsAboutApplication' => $this->string(),
            'futureCourse' => $this->string(),
            'checked'=>$this->boolean(),
            'discount'=>$this->integer(),
            'paid'=>$this->integer(),
            'leftToPay'=>$this->integer(),
            'social_id'=>$this->integer(),
            'client_id'=>$this->integer(),
            'course_id'=>$this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable("application");
    }
}
