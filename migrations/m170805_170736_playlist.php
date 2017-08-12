<?php

use yii\db\Migration;

class m170805_170736_playlist extends Migration
{
    public function up()
    {
        $this->createTable('playlist', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(10)->notNull(),
            'playlist_name' => $this->string(100)->notNull(),
        ]);
    }

    public function down()
    {
        echo "m170805_170736_playlist cannot be reverted.\n";

        return false;
    }
}
