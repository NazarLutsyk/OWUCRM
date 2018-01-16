<?php

use yii\db\Migration;

/**
 * Class m180116_111831_task
 */
class m180116_111831_task extends Migration
{
    public function up()
    {
        $this->createTable('task',[
            'id' => $this->primaryKey(),
            'value' => $this->string(),
            'dateExec' => $this->dateTime(),
            'checked' => $this->boolean(),
            'client_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('task');
    }
}
