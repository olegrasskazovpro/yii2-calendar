<?php


namespace app\controllers;


use app\models\Activity;
use Yii;
use yii\db\Query;
use yii\db\QueryBuilder;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

class ActivityController extends SessionController
{
	public function actionIndex($sort = false)
	{
//		$db = Yii::$app->db;
//		$rows = $db->createCommand('SELECT * FROM activities')->queryAll();

		$query = new Query();
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
//		$db = Yii::$app->db;
//		$rows = $db->createCommand('SELECT * FROM activities WHERE id=:id', [':id' => $id])->query();

		$query = new Query();
		$query->select('*')
			->from('activities')
			->where('id=:id', [':id' => $id]);
//		$query->leftJoin('repeat_periods', 'activities.repeat = repeat_periods.id');
		$rows = $query->one();

		return $this->render('view', [
			'model' => $rows,
		]);
	}

	public function actionEdit()
	{
		$model = new Activity();
		$model->load(Yii::$app->request->post());
		return $this->render('edit', compact('model'));
	}

	public function actionSave()
	{
		$model = new Activity();
		if ($model->load(Yii::$app->request->post())) {
			$model->attachments = UploadedFile::getInstances($model, 'attachments');

			if ($model->validate()) {

				$query = new QueryBuilder(Yii::$app->db);
				$params = [];
				echo $query->insert('activities', $model->attributes, $params);

				return 'Success: ' . VarDumper::export($model->attributes);
			} else {
				return 'Failed: ' . VarDumper::export($model->errors);
			}
		};

		return 'Activity_Save';
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