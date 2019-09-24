<?php


namespace app\commands;

use app\models\Activity;
use app\models\User;
use yii\console\Controller;

class AppController extends Controller
{
	/**
	 * Create some test users records in DB
	 */
	public function actionUsers()
	{
		$admin = new User([
			'username' => 'admin',
			'email' => 'admin@site.ru',
			'access_token' => 'test',
			'created_at' => time(),
			'updated_at' => time(),
		]);

		$admin->generateAuthKey();
		$admin->password = '123123'; // аналогично $this->setPassword('123123');
		$admin->save();

		$user = new User([
			'username' => 'user',
			'email' => 'user@site.ru',
			'access_token' => 'test',
			'created_at' => time(),
			'updated_at' => time(),
		]);

		$user->generateAuthKey();
		$user->password = '123123';
		$user->save();

		$moderator = new User([
			'username' => 'moderator',
			'email' => 'moderator@site.ru',
			'access_token' => 'test',
			'created_at' => time(),
			'updated_at' => time(),
		]);

		$moderator->generateAuthKey();
		$moderator->password = '123123';
		$moderator->save();
	}

	/**
	 * Create some test activities records in DB
	 */
	public function actionActivities()
	{
		$activity = new Activity([
			'title' => 'Событие админа 3',
			'start' => date('Y-m-d HH:mm:ss', time()),
			'end' => date('Y-m-d HH:mm:ss', time()),
			'user_id' => 1,
			'description' => 'Какое-то описание',
			'repeat' => '1',
			'end_repeat' => '',
			'block_other' => false,
		]);

		$activity->save();
		echo $activity->errors;
	}
}