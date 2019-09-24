<?php

use yii\db\Migration;

/**
 * Handles the creation of table `activities`.
 */
class m190915_091754_create_activities_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('activities', [
			'id' => $this->primaryKey(),
			'title' => $this->string()->notNull()->notNull(),
			'start' => $this->dateTime()->notNull(),
			'end' => $this->dateTime(),
			'user_id' => $this->integer()->notNull(),
			'description' => $this->text(),
			'repeat' => $this->integer()->defaultValue(1),
			'end_repeat' => $this->dateTime(),
			'block_other' => $this->boolean()->defaultValue(false),
		]);

		$this->createIndex('idx_activities_id', 'activities', 'id');
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropIndex('idx_activities_id', 'activities');
		$this->dropTable('activities');
	}
}
