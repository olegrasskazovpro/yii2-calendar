<?php


namespace app\commands;

use app\models\Activity;
use app\models\User;
use yii\console\Controller;
use Yii;

class AppController extends Controller
{
	/**
	 * Create some test users records in DB
	 * php yii app/users
	 */
	public function actionUsers()
	{
		$users = [
			'admin',
			'moderator',
			'user',
		];

		foreach ($users as $login) {
			$user = new User([
				'username' => $login,
				'email' => $login . '@site.ru',
				'access_token' => "{$login}-token",
				'created_at' => time(),
				'updated_at' => time(),
			]);
			$user->generateAuthKey();
			$user->password = '123123'; // аналогично $this->setPassword('123123');

				$user->save();
		}
	}

	/**
	 * Create some test activities records in DB
	 */
	public function actionActivities()
	{
		$titles = [
			'Событие 1',
			'Событие 2',
			'Событие 3',
			'Событие 4',
		];

		$day = 1;
		$today = time();

		foreach ($titles as $title) {
			$activityDate = date('Y-m-d H:i:s', strtotime("+ {$day} days", $today));

			$activity = new Activity([
				'title' => $title,
				'start' => $activityDate,
				'end' => $activityDate,
				'user_id' => random_int(1, 3),
				'description' => 'Какое-то описание' . chunk_split(Yii::$app->security->generateRandomString(64), random_int(10, 20), ' '),
				'repeat' => '1',
				'end_repeat' => '',
				'block_other' => random_int(0,1),
			]);

			$activity->save();

			$day++;
		}
	}
}