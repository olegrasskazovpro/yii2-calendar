<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_activities`.
 */
class m190915_102357_create_user_activities_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('user_activities', [
			'id' => $this->primaryKey(),
			'user_id' => $this->integer(),
			'activity_id' => $this->integer(),
		]);

		$this->createIndex(
			'idx-user_activities-user_id',
			'user_activities',
			'user_id'
		);

		$this->addForeignKey(
			'fk-user_activities-users',
			'user_activities',
			'user_id',
			'users',
			'id',
			'CASCADE'
		);

		$this->addForeignKey(
			'fk-user_activities-activities',
			'user_activities',
			'activity_id',
			'activities',
			'id',
			'CASCADE'
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropForeignKey(
			'fk-user_activities-users',
			'user_activities'
		);

		$this->dropForeignKey(
			'fk-user_activities-activities',
			'user_activities'
		);

		$this->dropIndex(
			'idx-user_activities-user_id',
			'user_activities'
		);

		$this->dropTable('user_activities');
	}
}
