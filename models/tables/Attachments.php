<?php


namespace app\models\tables;


use app\models\Activity;
use yii\db\ActiveRecord;

/**
 * Class Attachments
 * @package app\models
 * @property int $id [int(11)]
 * @property int $activity [int(11)]
 * @property string $filename [varchar(255)]
 */
class Attachments extends ActiveRecord
{
	public function getActivity()
	{
		return $this->hasOne(Activity::class, ['id' => 'activity']);
	}
}