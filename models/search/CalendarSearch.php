<?php

namespace app\models\search;

use app\models\Activity;
use app\models\tables\Calendar;
use Yii;
use yii\data\ActiveDataProvider;

class CalendarSearch extends Calendar
{
	public function search($params)
	{
		$query = Activity::find()->where(['user_id'=> Yii::$app->user->getId()]);

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => ['pageSize' => 30],
			'sort'=> ['defaultOrder' => ['start'=>SORT_DESC]]
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'start' => $this->start,
			'title' => $this->title,
		]);

		return $dataProvider;
	}
}