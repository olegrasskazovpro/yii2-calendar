<?php


namespace app\models;


use app\models\tables\RepeatPeriods;
use Yii;
use yii\db\ActiveRecord;

/**
 * Class Activity
 * @package app\models
 * @property int $id [int(11)]
 * @property string $title [varchar(255)]
 * @property string $start [varchar(255)]
 * @property string $end [varchar(255)]
 * @property int $user_id [int(11)]
 * @property string $description
 * @property int $repeat [int(11)]
 * @property string $end_repeat [varchar(255)]
 * @property bool $block_other [tinyint(1)]
 *
 * @property RepeatPeriods $repeatPeriods
 * @property mixed $startDate
 * @property mixed $endDate
 * @property mixed $startDatetime
 * @property mixed $endDatetime
 * @property-read User $user
 */
class Activity extends ActiveRecord
{
public static function tableName()
{
	return 'activities';
}

	public function rules()
	{
		return [
			[['title', 'start', 'user_id'], 'required'],
			['title', 'string', 'max' => 30],
			['description', 'string', 'max' => 5000],
			[['start', 'end', 'end_repeat'], 'datetime', 'format' => Yii::$app->formatter->datetimeFormat],
			['end', 'default', 'value' => function () { return $this->start;	}],
			['end', 'validateEnd'],
			[['id', 'user_id', 'repeat'], 'integer'],
			[['block_other'], 'boolean'],
//			[['attachments'], 'file', 'maxFiles' => 5, 'extensions' => 'jpg,png', 'maxSize' => 20971520],
		];
	}

	public function validateEnd()
	{
		if ($this->end < $this->start){
			return false;
		} else {
			return true;
		}
	}

	public function attributeLabels()
	{
		return [
			'id' => 'ID задачи',
			'user_id' => 'ID пользователя',
			'username' => 'Создатель',
			'title' => 'Название события',
			'description' => 'Описание события',
			'start' => 'Начало',
			'end' => 'Конец',
			'repeat' => 'Повторять',
			'end_repeat' => 'Повторять до',
			'block_other' => 'Блокировать другие события в эти даты',
//			'attachments' => 'Прикрепленные файлы',
		];
	}

	/**
	 * Return Username for activity
	 * @return string
	 */
	public function getUsername()
	{
		if ($this->isNewRecord) {
			return Yii::$app->user->identity->username;
		} else {
			return $this->user->username;
		}
	}

	/**
	 * Return user_id for Activity
	 * @return int
	 */
	public function getUserId()
	{
		if ($this->isNewRecord){
			return Yii::$app->user->identity->id;
		} else {
			return $this->user_id;
		}
	}

	public function getUser()
	{
		return $this->hasOne(User::class, ['id' => 'user_id']);
	}

	public function getRepeatPeriods()
	{
		return $this->hasOne(RepeatPeriods::class, ['id' => 'repeat']);
	}

	public function getStartDate()
	{
		return Yii::$app->formatter->asDate($this->start);
	}

	public function setStartDate($value)
	{
		$this->startDate = Yii::$app->formatter->asDate($value);
	}

	public function getStartDatetime()
	{
		return Yii::$app->formatter->asDatetime($this->start);
	}

	public function setStartDatetime($value)
	{
		$this->startDate = Yii::$app->formatter->asDatetime($value);
	}

	public function getEndDate()
	{
		return Yii::$app->formatter->asDate($this->end);
	}

	public function setEndDate($value)
	{
		$this->endDate = Yii::$app->formatter->asDate($value);
	}

	public function getEndDatetime()
	{
		return Yii::$app->formatter->asDatetime($this->end);
	}

	public function setEndDatetime($value)
	{
		$this->endDatetime = Yii::$app->formatter->asDatetime($value);
	}
}