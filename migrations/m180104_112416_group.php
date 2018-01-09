<?php

use yii\db\Migration;

/**
 * Class m180104_112416_group
 */
class m180104_112416_group extends Migration
{
    public function up()
    {
        $this->createTable("group",[
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'room' => $this->string(),
            'startDate' => $this->dateTime(),
            'course_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable("group");
    }
}
