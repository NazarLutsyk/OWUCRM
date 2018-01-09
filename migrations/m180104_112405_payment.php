<?php

use yii\db\Migration;

/**
 * Class m180104_112405_payment
 */
class m180104_112405_payment extends Migration
{
    public function up()
    {
        $this->createTable("payment",[
            'id' => $this->primaryKey(),
            'amount' => $this->integer(),
            'date' => $this->dateTime(),
            'application_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable("payment");
    }
}
