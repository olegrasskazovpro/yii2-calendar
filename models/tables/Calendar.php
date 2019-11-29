<?php


namespace app\models\tables;


use yii\db\ActiveRecord;

/**
 * Class Calendar
 * @package app\models\tables
 * @property int $id [int(11)]
 * @property string $date [datetime]  Date
 * @property int $val [int(11)]  Value
 */
class Calendar extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'calendar';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['date', 'val'], 'required'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'date' => 'Date',
			'val' => 'Value',
		];
	}
}