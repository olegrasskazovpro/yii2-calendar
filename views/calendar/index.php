<?php
/**
 * @var $dataProvider Calendar
 * @var $model Activity
 */

use app\models\Activity;
use app\models\tables\Calendar;
use marekpetras\calendarview\CalendarView;
use yii\helpers\Html;

echo CalendarView::widget(
	[
		// mandatory
		'dataProvider' => $dataProvider,
		'dateField' => 'start',
		'valueField' => 'title',


		// optional params with their defaults
		'unixTimestamp' => false, // indicate whether you use unix timestamp instead of a date/datetime format in the data provider
		'weekStart' => 1, // date('w') // which day to display first in the calendar
		'title' => 'Calendar',

		'views' => [
			'calendar' => '@vendor/marekpetras/yii2-calendarview-widget/views/calendar',
			'month' => '@vendor/marekpetras/yii2-calendarview-widget/views/month',
			'day' => '@vendor/marekpetras/yii2-calendarview-widget/views/day',
		],

		'startYear' => date('Y') - 1,
		'endYear' => date('Y') + 1,

		'link' => false,
		/*alternates to link , is called on every models valueField, used in Html::a( valueField , link )
		'link' => 'site/view',
		'link' => function ($model, $calendar) {
			return ['activity/view', 'id' => $model->id];
		},*/


		//'dayRender' => false,
		// alternate to dayRender
		'dayRender' => function ($model, $calendar) {
			$ancore = date('H:i', strtotime($model->start)) . ' - ' . $model->title;
			$item = Html::a($ancore, ['activity/view', 'id' => $model->id]);
			return "<p>{$item}</p>";
		},

	]
);
?>