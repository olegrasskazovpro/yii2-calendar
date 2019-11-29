<?php


namespace app\commands;


use yii\console\Controller;
use Yii;

/**
 * Контроллер для настройки базовых RBAC ролей пользователей
 *
 * Предварительно выполнить - php yii migrate --migrationPath=@yii/rbac/migrations
 *
 * Class RbacController
 * @package app\commands
 */
class RbacController extends Controller
{
	/**
	 * Инициализация RBAC миграций и ролей
	 *
	 * php yii rbac/init
	 *
	 * @throws \yii\base\Exception
	 * @throws \yii\base\InvalidRouteException
	 * @throws \yii\console\Exception
	 */
	public function actionInit()
	{
		// аналогично выполнению в терминале 'php yii migrate --migrationPath=@yii/rbac/migrations'
		Yii::$app->runAction('migrate', ['migrationPath' => '@yii/rbac/migrations']);

		// компонент управления RBAC
		$auth = Yii::$app->authManager;

		/**
		 * Создание ролей пользователей
		 */

		// Пользователь
		$roleUser = $auth->createRole('user');
		$roleUser->description = 'Рядовой пользователь сайта';
		$auth->add($roleUser);

		// Менеджер
		$roleManager = $auth->createRole('manager');
		$roleManager->description = 'Менеджер сайта';
		$auth->add($roleManager);
		$auth->addChild($roleManager, $roleUser); // Менеджер наследует права пользователя

		// Админ
		$roleAdmin = $auth->createRole('admin');
		$roleAdmin->description = 'Админ сайта';
		$auth->add($roleAdmin);
		$auth->addChild($roleAdmin, $roleManager); // Менеджер наследует права менеджера (а значит, и пользователя)

		/**
		 * Установка ролей на пользователей
		 */

		$auth->assign($roleAdmin, 1);
		$auth->assign($roleManager, 2);
		$auth->assign($roleUser, 3);
	}
}