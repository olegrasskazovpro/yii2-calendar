<?php


namespace app\controllers;


use app\models\Activity;
use Yii;

class ActivityController extends SessionController
{
	public function actionIndex()
	{
		$activityItem = new Activity();

		$activityItem->title = 'New Activity Heading';
		$activityItem->repeat = 'Daily';
		$activityItem->startDay = '1568389223';
		$activityItem->endDay = '1568562023';
		$activityItem->endRepeat = '1568389223';

		return $this->render('index', [
			'model' => $activityItem,
		]);
	}

	public function actionEdit()
	{
		$model = new Activity();
		$model->load(Yii::$app->request->post());
		return $this->render('edit', [
			'model' => $model,
		]);
	}

	public function actionSave()
	{
		$model = Yii::$app->request->post();
		var_dump($model);
	}
}