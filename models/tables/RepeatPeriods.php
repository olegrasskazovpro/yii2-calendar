<?php


namespace app\models\tables;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class RepeatPeriods
 * @package app\models\tables
 *
 * @property int $id [int(11)]
 * @property string $period [varchar(255)]
 */
class RepeatPeriods extends ActiveRecord
{
	public static function getPeriods()
	{
		$periods = self::find()->asArray()->all();
		return ArrayHelper::map($periods, 'id', 'period');
	}
}