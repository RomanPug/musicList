<?php

use yii\db\Migration;

/**
 * Handles adding position to table `user`.
 */
class m170730_102942_add_position_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'auth_key', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'position');
    }
}
