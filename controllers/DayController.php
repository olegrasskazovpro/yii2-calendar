<?php

namespace app\controllers;

use app\models\Day;
use yii\web\Controller;

class DayController extends Controller
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
