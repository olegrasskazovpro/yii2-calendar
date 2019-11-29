<?php


namespace app\controllers;


use app\models\Activity;
use app\models\search\CalendarSearch;
use Yii;

class CalendarController extends MyController
{
	public function actionIndex()
	{
		$searchModel = new CalendarSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

		return $this->render('index', [
			'dataProvider' => $dataProvider
		]);
	}
}