<?php

namespace app\controllers;

use app\models\forms\UserForm;
use app\models\tables\Users;
use app\models\User;
use Yii;
use yii\helpers\StringHelper;

class UserController extends MyController
{
	public function actionIndex()
	{
		if ($user = Yii::$app->user->identity) {
			return $this->render('index', [
				'model' => $user,
			]);
		} else {
			$this->redirect('/site/login');
		}
	}

	public function actionCreate()
	{
		$user = new UserForm();
		return $this->render('create', [
			'model' => $user,
		]);
	}

	public function actionUpdate()
	{
		if ($id = Yii::$app->user->identity->getId()){
			return $this->render('update', [
				'model' => User::getUserForm($id),
			]);
		} else {
			$this->redirect('/site/login');
		}
	}

	/**
	 * @var $user Users
	 * @return string
	 * @throws \Exception
	 */
	public function actionSave()
	{
		$userData = Yii::$app->request->post();
		$formName = StringHelper::basename(UserForm::class);

		if ($identity = Yii::$app->user->identity) {
			$userId = $identity->getId();
			$user = User::update($userId, $userData, $formName);
		} else {
			$user = User::create($userData, $formName);
		}

		if (!$user->errors){
			$this->redirect('/user');
		} else {
			return 'User update failed with errors: ' . $user->errors;
		}
	}
}