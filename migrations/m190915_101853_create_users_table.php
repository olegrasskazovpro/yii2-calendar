<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m190915_101853_create_users_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('users', [
			'id' => $this->primaryKey(),
			'username' => $this->string(),
			'password' => $this->string(),
			'authKey' => $this->string(),
			'accessToken' => $this->string(),
		]);

		$this->createIndex(
			'user_id_index',
			'users',
			'id');
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('users');
	}
}
