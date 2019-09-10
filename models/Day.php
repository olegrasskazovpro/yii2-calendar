<?php


namespace app\models;


use yii\base\Model;

class Day extends Model
{
	/**
	 * Mo-Su. Weekdays can be indentified
	 * @var string
	 */
	public $dayOfWeek;

	/**
	 * TRUE if this day is dayoff
	 * @var
	 */
	public $dayOff = false;

	/**
	 * @var array of associated Events' IDs
	 */
	public $activities = [];

	/**
	 * TRUE if this day blocked with some event or FALSE if it's OK for new events
	 * @var bool
	 */
	public $blocked = false;

	/**
	 * Getting events IDs from DB
	 * @return array of this day events' IDs
	 */
	public function getEvents()
	{
		return [];
	}

}