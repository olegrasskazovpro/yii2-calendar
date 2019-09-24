<?php


namespace app\models;


use yii\base\Model;

/**
 * Class Activity
 * @package app\models
 */
class ActivityOldModel extends Model
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
	 * FALSE if other activities is possible in same days (default) or TRUE if not
	 * If TRUE days of this event becomes blocked
	 * @var boolean
	 */
	public $blockOther = false;

	/**
	 * @var array of attached files
	 */
	public $attachments = [];
	
	public function rules()
	{
		return [
			[['title', 'startDay', 'endDay'], 'required'],
			[['title'], 'string', 'min' => 5, 'max' => 30],
			[['description'], 'string', 'max' => 5000],
			[['id', 'userID', 'repeat'], 'string'],
			[['startDay', 'endDay', 'endRepeat'], 'date', 'format' => 'php:Y-m-d'],
			[['blockOther'], 'boolean'],
			[['attachments'], 'file', 'maxFiles' => 5, 'extensions' => 'jpg,png', 'maxSize' => 20971520],
		];
	}

	public function getRepeatPeriod()
	{
		
	}

	public function attributeLabels()
	{
		return [
			'id' => 'ID задачи',
			'userID' => 'ID пользователя',
			'title' => 'Название события',
			'description' => 'Описание события',
			'startDay' => 'Дата начала',
			'endDay' => 'Дата завершения',
			'repeat' => 'Повторять',
			'endRepeat' => 'Повторять до',
			'blockOther' => 'Блокировать другие события в эти даты',
			'attachments' => 'Прикрепленные файлы',
		];
	}
}