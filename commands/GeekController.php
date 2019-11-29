<?php


namespace app\commands;


use yii\console\Controller;

class GeekController extends Controller
{
	public $user = 'Henry';

	public function options($actionID)
	{
		return ['user'];
	}

	public function optionAliases()
	{
		return [
			'u' => 'user',
		];
	}

	public function actionIndex(int $times)
	{
		for ($i = 0; $i < $times; $i++){
			echo "Hello $this->user - {$i} \n";
		}
	}
}