<?php


namespace app\controllers;


use app\models\UserMessage;
use Yii;

class MessageController extends SessionController
{
	public function actionIndex()
	{
		$model = new UserMessage();
		return $this->render('index',
			compact('model') // ['model' => $model,]
		);
	}

	public function actionSubmit()
	{
		$model = new UserMessage();
		$model->load(Yii::$app->request->post());

		if ($model->validate()) {
			return $this->redirect('/message/result');
		} else {
			return $this->redirect('/message/index');
		}
	}

	public function actionResult()
	{
		return 'Thanks'; // выдать результат
	}

}