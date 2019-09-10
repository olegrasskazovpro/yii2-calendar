<?php

namespace app\modules\first\controllers;

use yii\web\Controller;
use Yii;

/**
 * Default controller for the `first` module
 */
class DefaultController extends Controller
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
