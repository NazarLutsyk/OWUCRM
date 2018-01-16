<?php

use yii\db\Migration;

/**
 * Class m180116_111838_status
 */
class m180116_111838_status extends Migration
{
    public function up()
    {
        $this->createTable('status',[
            'id' => $this->primaryKey(),
            'value' => $this->string()
        ]);
    }

    public function down()
    {
        $this->dropTable('status');
    }
}
