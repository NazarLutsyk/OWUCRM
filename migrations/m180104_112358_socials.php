<?php

use yii\db\Migration;

/**
 * Class m180104_112358_socials
 */
class m180104_112358_socials extends Migration
{
    public function up()
    {
        $this->createTable("social",[
            'id' => $this->primaryKey(),
            'name' => $this->string()
        ]);
    }

    public function down()
    {
        $this->dropTable("application");
    }
}
