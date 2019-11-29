<?php


namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class MyController extends Controller
{
	public function beforeAction($action)
	{
		Yii::$app->session->set('referrer', Yii::$app->request->referrer);
		return parent::beforeAction($action);
	}
}