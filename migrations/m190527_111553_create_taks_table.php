<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%taks}}`.
 */
class m190527_111553_create_taks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'created' => $this->timestamp(),
            'employee_id' => $this->integer()->notNull(),
	        'employee_name' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->string(),
            'status' => $this->boolean()->defaultValue(0)
        ]);

        // creates index for column `employee_id`
        $this->createIndex(
            '{{%idx-task-employee_id}}',
            '{{%task}}',
            'employee_id'
        );

        // add foreign key for table `{{%employee}}`
        $this->addForeignKey(
            '{{%fk-task-employee_id}}',
            '{{%task}}',
            'employee_id',
            '{{%employee}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%employee}}`
        $this->dropForeignKey(
            '{{%fk-task-employee_id}}',
            '{{%task}}'
        );

        // drops index for column `employee_id`
        $this->dropIndex(
            '{{%idx-task-employee_id}}',
            '{{%task}}'
        );

        $this->dropTable('{{%task}}');
    }
}
