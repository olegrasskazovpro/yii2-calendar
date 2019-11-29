<?php

use yii\db\Migration;

/**
 * Handles the creation of table `calendar`.
 */
class m190928_210614_create_calendar_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('calendar', [
			'id' => $this->primaryKey(),
			'date' => $this->dateTime()->notNull()->comment('Date'),
			'val' => $this->integer()->notNull()->comment('Value'),
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('calendar');
	}
}
