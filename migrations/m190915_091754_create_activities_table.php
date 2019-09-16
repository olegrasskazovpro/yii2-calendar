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
			'title' => $this->string()->notNull(),
			'startDay' => $this->string(),
			'endDay' => $this->string(),
			'userID' => $this->integer(),
			'description' => $this->text(),
			'repeat' => $this->integer(),
			'endRepeat' => $this->string(),
			'blockOther' => $this->boolean(),

//			'attachments' => '', //TODO реляционная связь
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('activities');
	}
}
