<?php

namespace app\controllers;

use app\models\Day;

class DayController extends MyController
{
	public function actionIndex()
	{
		$dayItem = new Day();
		$dayItem->dayOfWeek = date('l');
		return $this->render('index', [
			'model' => $dayItem,
		]);
	}

}
