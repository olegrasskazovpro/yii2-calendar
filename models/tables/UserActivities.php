<?php

namespace app\models\tables;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_activities".
 *
 * @property int $id
 * @property int $user_id
 * @property int $activity_id
 *
 * @property Activities $activity
 * @property Users $user
 */
class UserActivities extends ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'user_activities';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['user_id', 'activity_id'], 'integer'],
			[['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activities::class, 'targetAttribute' => ['activity_id' => 'id']],
			[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'user_id' => 'User ID',
			'activity_id' => 'Activity ID',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getActivity()
	{
		return $this->hasOne(Activities::class, ['id' => 'activity_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(Users::class, ['id' => 'user_id']);
	}
}
