<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m190915_101853_create_users_table extends Migration
{
	/**
	 * @return bool|void
	 */
	public function safeUp()
	{
		$this->createTable('users', [
			'id' => $this->primaryKey(),
			'username' => $this->string()->notNull(),
			'email' => $this->string()->notNull(),
			'password_hash' => $this->string()->notNull(),
			'auth_key' => $this->string()->notNull(),
			'access_token' => $this->string(),
			'created_at' => $this->integer()->defaultValue(time()),
			'updated_at' => $this->integer()->defaultValue(time()),
		]);

		$this->createIndex(
			'user_id_index',
			'users',
			'id');

		$this->addForeignKey(
			'fk_activities_users_id',
			'activities',
			'user_id',
			'users',
			'id'
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropForeignKey('fk_activities_users_id','activities');
		$this->dropIndex('user_id_index','users');
		$this->dropTable('users');
	}
}
