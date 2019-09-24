<?php


namespace app\controllers;


use app\models\Activity;
use app\models\RepeatPeriods;
use Yii;
use yii\db\Query;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

class ActivityController extends MyController
{
	public function actionIndex($sort = false)
	{
		$query = Activity::find(); //new Query();
		$query->select('*')->from('activities');

		if ($sort) {
			$query->orderBy('id desc');
		}

		$rows = $query->all();
		return $this->render('index', [
			'activities' => $rows
		]);
	}

	public function actionView($id)
	{
		if ($activity = Activity::findOne(['id' => $id])) {
			return $this->render('view', [
				'model' => $activity,
			]);
		} else {
			Yii::$app->session->setFlash('error', 'Событие не найдено');
			$this->redirect('/activity/index');
		};
	}

	public function actionEdit($id)
	{
		$model = $id ? Activity::findOne($id) : new Activity();
		return $this->render('edit', compact('model'));
	}

	public function actionSave()
	{
		if ($activityId = Yii::$app->request->post((new Activity())->formName())['id']) {
			$model = Activity::findOne($activityId);
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->render('view', compact('model'));
			} else {
				return 'Failed: ' . VarDumper::export($model->errors);
			}
		} else {
			$model = new Activity();
			$model->load(Yii::$app->request->post());
			if ($model->save()) {
//			$model->attachments = UploadedFile::getInstances($model, 'attachments');
				return $this->render('view', compact('model'));
			} else {
				return 'Failed: ' . VarDumper::export($model->errors);
			}
		}
	}

	/**
	 * Delete activity
	 * @return string
	 */
	public function actionDelete()
	{
		return 'task deleted'; //
	}
}