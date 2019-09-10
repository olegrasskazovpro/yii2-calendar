<?php


namespace app\controllers;


use app\models\Activity;
use Yii;

class ActivityController extends SessionController
{
	public function actionIndex()
	{
		return Yii::$app->session->get('page', 'NOT SET');
	}

	public function actionView()
	{
		$activityItem = new Activity();

		$activityItem->title = 'New Activity Heading';
		$activityItem->repeat = 'Daily';
		$activityItem->startDay = '1568389223';
		$activityItem->endDay = '1568562023';
		$activityItem->endRepeat = '1568389223';

		return $this->render('view', [
			'model' => $activityItem,
		]);
	}
}