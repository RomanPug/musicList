<?php

use yii\db\Migration;

class m170801_172031_player extends Migration
{

    public function up()
    {
        $this->createTable('player', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(10)->notNull(),
            'playlist_id' => $this->integer(10)->notNull(),
            'music_name' => $this->string(100)->notNull(),
            'music_default_name' => $this->string(255)->notNull(),

        ]);
    }

    public function down()
    {
        echo "m170801_172031_player cannot be reverted.\n";

        return false;
    }
}
