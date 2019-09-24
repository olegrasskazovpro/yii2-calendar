<?php

namespace app\modules\first\controllers;

use app\controllers\MyController;
use Yii;

/**
 * Default controller for the `first` module
 */
class DefaultController extends MyController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
			Yii::$app->seo->registerTitle('New Value');
    	return $this->render('index');
    }
}
