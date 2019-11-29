<?php


namespace app\models;


use app\components\CachedRecordBehavior;
use app\models\tables\RepeatPeriods;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Class Activity
 * @package app\models
 * @property int $id [int(11)]
 * @property string $title [varchar(255)]
 * @property string $start [varchar(255)]
 * @property string $end [varchar(255)]
 * @property string $created_at [varchar(255)]
 * @property string $updated_at [varchar(255)]
 * @property int $user_id [int(11)]
 * @property string $description
 * @property int $repeat [int(11)]
 * @property string $end_repeat [varchar(255)]
 * @property bool $block_other [tinyint(1)]
 *
 * @property RepeatPeriods $repeatPeriods
 * @property RepeatPeriod $repeatPeriod
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
			'created_at' => 'Событие создано',
			'updated_at' => 'Событие обновлено',
			'repeatPeriod' => 'Повторять',
			'end_repeat' => 'Повторять до',
			'block_other' => 'Блокировать другие события в эти даты',
//			'attachments' => 'Прикрепленные файлы',
		];
	}

	public function behaviors()
	{
		return [
			TimestampBehavior::class,
			[
				'class' => TimestampBehavior::class,
				'value' => new Expression('NOW()'),
			],
			[
				'class' => BlameableBehavior::class,
				'createdByAttribute' => 'user_id',
				'updatedByAttribute' => 'user_id',
			],
			[
				'class' => CachedRecordBehavior::class,
				'prefix' => 'activity',
			],
		];
	}

	public function rules()
	{
		return [
			[['title', 'start'], 'required'],
			['title', 'string', 'max' => 30],
			['description', 'string', 'max' => 5000],
			[['start', 'end', 'end_repeat'], 'datetime', 'format' => Yii::$app->formatter->datetimeFormat],
			['end', 'default', 'value' => function () {
				return $this->start;
			}],
			['end', 'validateEnd'],
			[['id', 'user_id', 'repeat'], 'integer'],
			[['block_other'], 'boolean'],
//			[['attachments'], 'file', 'maxFiles' => 5, 'extensions' => 'jpg,png', 'maxSize' => 20971520],
		];
	}

	public function validateEnd()
	{
		if ($this->end < $this->start) {
			$this->addError('end', 'Событие не может кончаться раньше, чем началось');
			Yii::$app->session->setFlash('error', 'Событие не может кончаться раньше, чем началось');
			return false;
		}
	}

	/**
	 * @param $date_1 string
	 * @param $date_2 string
	 * @param string $differenceFormat
	 * @return string
	 */
	public static function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
	{
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);

		$interval = date_diff($datetime1, $datetime2);

		return $interval->format($differenceFormat);
	}

	public static function findOne($condition)
	{
		if (Yii::$app->cache->exists('activity'.$condition)) {
			//TODO реализовать этот метод так, чтобы он работал во всех моделях чисто за счет прикрепления поведения
		} else {
			$item = parent::findOne($condition);
		}

		return $item;
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
		if ($this->isNewRecord) {
			return Yii::$app->user->identity->id;
		} else {
			return $this->user_id;
		}
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::class, ['id' => 'user_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRepeatPeriods()
	{
		return $this->hasOne(RepeatPeriods::class, ['id' => 'repeat']);
	}

	/**
	 * @return string
	 */
	public function getRepeatPeriod()
	{
		if ($this->isNewRecord){
			return RepeatPeriods::findOne(1)->period;
		} else {
			return $this->repeatPeriods->period;
		}
	}

	/**
	 * @return string
	 * @throws \yii\base\InvalidConfigException
	 */
	public function getStartDate()
	{
		return Yii::$app->formatter->asDate($this->start);
	}

	/**
	 * @param $value
	 * @throws \yii\base\InvalidConfigException
	 */
	public function setStartDate($value)
	{
		$this->startDate = Yii::$app->formatter->asDate($value);
	}

	/**
	 * @return string
	 * @throws \yii\base\InvalidConfigException
	 */
	public function getStartDatetime()
	{
		return Yii::$app->formatter->asDatetime($this->start);
	}

	/**
	 * @param $value
	 * @throws \yii\base\InvalidConfigException
	 */
	public function setStartDatetime($value)
	{
		$this->startDate = Yii::$app->formatter->asDatetime($value);
	}

	/**
	 * @return string
	 * @throws \yii\base\InvalidConfigException
	 */
	public function getEndDate()
	{
		return Yii::$app->formatter->asDate($this->end);
	}

	/**
	 * @param $value
	 * @throws \yii\base\InvalidConfigException
	 */
	public function setEndDate($value)
	{
		$this->endDate = Yii::$app->formatter->asDate($value);
	}

	/**
	 * @return string
	 * @throws \yii\base\InvalidConfigException
	 */
	public function getEndDatetime()
	{
		return Yii::$app->formatter->asDatetime($this->end);
	}

	/**
	 * @param $value
	 * @throws \yii\base\InvalidConfigException
	 */
	public function setEndDatetime($value)
	{
		$this->endDatetime = Yii::$app->formatter->asDatetime($value);
	}
}