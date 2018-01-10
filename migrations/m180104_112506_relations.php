<?php

use yii\db\Migration;

/**
 * Class m180104_112506_relations
 */
class m180104_112506_relations extends Migration
{
    public function up()
    {
        $this->createIndex(
            'recomendation_client_id_index',
            'client',
            'recomendation_id'
        );
        $this->createIndex(
            'app_social_id_index',
            'application',
            'social_id'
        );
        $this->createIndex(
            'app_client_id_index',
            'application',
            'client_id'
        );
        $this->createIndex(
            'app_course_id_index',
            'application',
            'course_id'
        );
        $this->createIndex(
            'grp_course_id_index',
            'group',
            'course_id'
        );
        $this->createIndex(
            'pmt_app_id_index',
            'payment',
            'application_id'
        );
        $this->createIndex(
            'fakeAcc_fakeUser_id_index',
            'fakeAccount',
            'fakeUser_id'
        );

        $this->addForeignKey(
            'fk-recomendation-client',
            'client',
            'recomendation_id',
            'client',
            'id',
            'SET NULL'
        );

        $this->addForeignKey(
            'fk-app-source',
            'application',
            'social_id',
            'social',
            'id',
            'SET NULL'
        );

        $this->addForeignKey(
            'fk-app-client',
            'application',
            'client_id',
            'client',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-app-course',
            'application',
            'course_id',
            'course',
            'id',
            'SET NULL'
        );

        $this->addForeignKey(
            'fk-group-course',
            'group',
            'course_id',
            'course',
            'id',
            'SET NULL'
        );

        $this->addForeignKey(
            'fk-payment-app',
            'payment',
            'application_id',
            'application',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-fakeAcc-fakeUser',
            'fakeAccount',
            'fakeUser_id',
            'fakeUser',
            'id',
            'CASCADE'
        );

        $this->createTable('client_group', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer(),
            'group_id' => $this->integer()
        ]);

        $this->createIndex(
            'client_group_client_id_index',
            'client_group',
            'client_id'
        );

        $this->addForeignKey(
            'fk-client-group',
            'client_group',
            'group_id',
            'group',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'client_group_group_id_index',
            'client_group',
            'group_id'
        );

        $this->addForeignKey(
            'fk-group-client',
            'client_group',
            'client_id',
            'client',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropIndex("recomendation_client_id_index", "client");
        $this->dropIndex("app_social_id_index", "application");
        $this->dropIndex("app_client_id_index", "application");
        $this->dropIndex("app_course_id_index", "application");
        $this->dropIndex("grp_course_id_index", "group");
        $this->dropIndex("pmt_course_id_index", "payment");
        $this->dropIndex("fakeAcc_fakeUser_id_index", "fakeAccount");
        $this->dropIndex("client_group_client_id_index", "client_group");
        $this->dropIndex("client_group_group_id_index", "client_group");

        $this->dropForeignKey("fk-recomendation-client", "client");
        $this->dropForeignKey("fk-app-social", "application");
        $this->dropForeignKey("fk-app-client", "application");
        $this->dropForeignKey("fk-app-course", "application");
        $this->dropForeignKey("fk-group-course", "group");
        $this->dropForeignKey("fk-payment-app", "payment");
        $this->dropForeignKey("fk-fakeAcc-fakeUser", "fakeAccount");
        $this->dropForeignKey("fk-client-group", "client_group");
        $this->dropForeignKey("fk-group-client", "client_group");

        $this->dropTable("client_group");

    }
}
