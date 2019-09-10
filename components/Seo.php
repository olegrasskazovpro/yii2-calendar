<?php

namespace app\components;

use yii\base\Component;
use Yii;

class Seo extends Component
{
	public function registerTitle($value)
	{
		Yii::$app->view->title = $value;
	}
}