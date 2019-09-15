<?php

use yii\db\Migration;

/**
 * Class m190915_111719_create_users_activities_testdata
 */
class m190915_111719_create_users_activities_testdata extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->batchInsert(
			'users',
			['username', 'password'],
			[
				['Oleg-test', 'admin'],
				['Alex-test', 'admin']
			]
		);

		$this->batchInsert(
			'activities',
			['userID', 'title', 'description', 'startDay', 'endDay', 'repeat', 'endRepeat', 'blockOther'],
			[
				[1, 'Событие юзера 1 test', 'Описание', '2019-09-01', '2019-09-05', '1', '' , false],
				[2, 'Событие юзера 2 test', 'Описание', '2019-09-01', '2019-09-05', '2', '2019-10-05' , true]
			]
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		/**
		 * Clear all table data
		 */
		$this->delete(
			'users',
			"username like '%test%'"
		);

		$this->delete(
			'activities',
			"title like '%test%'"
		);

		$this->dropIndex(
			'user_id_index',
			'users'
		);

		$this->createIndex(
			'user_id_index',
			'users',
			'id');
	}
}
