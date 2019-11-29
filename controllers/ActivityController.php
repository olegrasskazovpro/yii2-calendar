<?php


namespace app\controllers;


use app\models\Activity;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class ActivityController extends MyController
{

	/**
	 * Задает параметры доступа к объектам Activity для RBAC
	 * @return array
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'allow' => true,
						'actions' => ['index', 'view', 'update', 'save', 'delete'],
						'roles' => ['@'],
					],
				],
			],
		];
	}

	/**
	 * View all activities
	 * @param bool $sort
	 * @return string
	 */
	public function actionIndex($sort = false)
	{
		$query = Activity::find(); //new Query();

		if (!Yii::$app->user->can('manager')){
			$query->andWhere(['user_id' => Yii::$app->user->id]);
		}

		$provider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 10,
			],
		]);

		return $this->render('index', [
			'provider' => $provider
		]);
	}

	/**
	 * 1 activity view
	 * @param $id
	 * @return string
	 */
	public function actionView($id)
	{
		$cacheKey = "activity_{$id}";

		if (Yii::$app->cache->exists($cacheKey)){
			$activity = Yii::$app->cache->get($cacheKey);
		} else {
			$activity = Activity::findOne(['id' => $id]);

			Yii::$app->cache->set($cacheKey, $activity);
		}

		if ($activity) {
			return $this->render('view', [
				'model' => $activity,
			]);
		} else {
			Yii::$app->session->setFlash('error', 'Событие не найдено');
			$this->redirect('/activity/index');
		};
	}

	/**
	 * Edit activity (or create new)
	 * @param $id
	 * @return string
	 */
	public function actionUpdate($id)
	{
		$model = $id ? Activity::findOne($id) : new Activity();

		if ($model->load(Yii::$app->request->post()) && $model->validate()){
			if ($model->save()){
				$this->redirect(['activity/view', 'id' => $model->id]);
			}
		}

		return $this->render('edit', compact('model'));
	}

	/**
	 * Save action to DB
	 * @return string
	 * @throws \yii\base\InvalidConfigException
	 */
	public function actionSave()
	{
		if ($activityId = Yii::$app->request->post((new Activity())->formName())['id']) {
			$model = Activity::findOne($activityId);
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				$this->redirect("/activity/view?id={$model->id}");
			} else {
				$this->redirect(Yii::$app->request->referrer);
			}
		} else {
			$model = new Activity();
			$model->load(Yii::$app->request->post());
			if ($model->save()) {
				$this->redirect("/activity/view?id={$model->id}");
			} else {
				$this->redirect(Yii::$app->request->referrer);
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