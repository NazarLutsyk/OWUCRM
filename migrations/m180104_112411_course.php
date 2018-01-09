<?php

use yii\db\Migration;

/**
 * Class m180104_112411_course
 */
class m180104_112411_course extends Migration
{
    public function up()
    {
        $this->createTable("course",[
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'price' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable("course");
    }
}
