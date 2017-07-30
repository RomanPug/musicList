<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170730_104024_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'email' => $this->string(100),
            'name' => $this->string(25),
            'password' => $this->string(15),
            'auth_key' => $this->string(255),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
