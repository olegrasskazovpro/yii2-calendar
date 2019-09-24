<?php

namespace app\controllers;

use app\models\Activity;
use app\models\LoginForm;
use app\models\User;
use Yii;

class UserController extends MyController
{
	public function actionIndex()
	{
		if ($user = Yii::$app->user->identity) {
			return $this->render('index', [
				'model' => $user,
			]);
		} else {
			$this->redirect('site/login');
		}
	}

	public function actionCreate()
	{
		$user = new User();
		return $this->render('create', [
			'model' => $user,
		]);
	}

	public function actionSave()
	{
		if ($userId = Yii::$app->user->identity->getId()) {
			$user = User::findOne($userId);
			$user->load(Yii::$app->request->post());
			if ($user->registration()) {
				$this->redirect('/user');
				Yii::$app->session->setFlash('success', "Добро пожаловать, {$user->username}");
			} else {
				return 'Registration failed with errors: ' . $user->errors;
			}
		} else {
			$user = new User();
			$user->load(Yii::$app->request->post());
			if ($user->save()){
				Yii::$app->session->setFlash('success', 'Пользователь сохранен');
				$this->redirect('/user');
			} else {
				return 'User update failed with errors: ' . $user->errors;
			};
		};
	}
}