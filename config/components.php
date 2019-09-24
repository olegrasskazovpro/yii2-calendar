<?php

use app\models\User;

$db = require __DIR__ . '/db.php';

return [
	'authManager' => [
		'class' => yii\rbac\DbManager::class,
	],
	'formatter' => [
		'dateFormat' => 'php:Y-m-d',
		'datetimeFormat' => 'php:Y-m-d H:i:s',
	],
	'seo' => [
		'class' => app\components\Seo::class,
	],
	'request' => [
		// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
		'cookieValidationKey' => 'elDezX9dnrq7d82xFx4h-_-MQm8I5koG',
	],
	'cache' => [
		'class' => 'yii\caching\FileCache',
	],
	'user' => [
		'identityClass' => User::class,
		'enableAutoLogin' => true,
	],
	'errorHandler' => [
		'errorAction' => 'site/error',
	],
	'mailer' => [
		'class' => 'yii\swiftmailer\Mailer',
		// send all mails to a file by default. You have to set
		// 'useFileTransport' to false and configure a transport
		// for the mailer to send real emails.
		'useFileTransport' => true,
	],
	'log' => [
		'traceLevel' => YII_DEBUG ? 3 : 0,
		'targets' => [
			[
				'class' => 'yii\log\FileTarget',
				'levels' => ['error', 'warning'],
			],
		],
	],
	'db' => $db,
	'urlManager' => [
		'enablePrettyUrl' => true,
		'showScriptName' => false,
		'rules' => [
		],
	],
]
?>