<?php


namespace app\models;


use yii\base\Model;

/**
 * Class Activity
 * @package app\models
 */
class Activity extends Model
{
	/**
	 * Event id
	 * @var int
	 */
	public $id;

	/**
	 * Event name
	 * @var string
	 */
	public $title;

	/**
	 * Event start day (UNIX timestamp)
	 * @var int
	 */
	public $startDay;

	/**
	 * Event end day (UNIX timestamp)
	 * @var int
	 */
	public $endDay;

	/**
	 * Event author ID
	 * @var int
	 */
	public $userID;

	/**
	 * Event description
	 * @var string
	 */
	public $description;

	/**
	 * Event regularity (Daily, Weekly, Monthly, Yearly)
	 * @var string
	 */
	public $repeat;

	/**
	 * The last day of event repeat (UNIX timestamp)
	 * @var int
	 */
	public $endRepeat;

	/**
	 * FALSE if other activities is possible in same days (default) or FALSE if not
	 * If FALSE days of this event becomes blocked
	 * @var boolean
	 */
	public $blockOther = false;

	public function attributeLabels()
	{
		return [
			'title' => 'Название события',
			'startDay' => 'Дата начала',
			'endDay' => 'Дата завершения',
			'repeat' => 'Повторять',
			'endRepeat' => 'Повторять до',
			'letOther' => 'Позволять другие события в эти даты',
			'idAuthor' => 'ID автора',
			'description' => 'Описание события'
		];
	}
}