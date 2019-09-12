<?php


namespace app\controllers;


use Yii;
use yii\web\Controller;

class SessionController extends Controller
{
	public function beforeAction($action)
	{
		Yii::$app->session->set('referrer', Yii::$app->request->referrer);
		return parent::beforeAction($action);
	}
}