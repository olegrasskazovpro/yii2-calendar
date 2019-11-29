<?php

namespace app\models\tables;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "activities".
 *
 * @property int $id
 * @property string $title
 * @property string $start
 * @property string $end
 * @property string $created_at
 * @property string $updated_at
 * @property int $user_id
 * @property string $description
 * @property int $repeat
 * @property string $end_repeat
 * @property int $block_other
 *
 * @property RepeatPeriods $repeat0
 * @property Users $user
 * @property Attachments[] $attachments
 * @property UserActivities[] $userActivities
 */
class Activities extends ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'activities';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['title', 'start', 'created_at', 'updated_at', 'user_id'], 'required'],
			[['start', 'end', 'created_at', 'updated_at', 'end_repeat'], 'safe'],
			[['user_id', 'repeat', 'block_other'], 'integer'],
			[['description'], 'string'],
			[['title'], 'string', 'max' => 255],
			[['repeat'], 'exist', 'skipOnError' => true, 'targetClass' => RepeatPeriods::class, 'targetAttribute' => ['repeat' => 'id']],
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
			'title' => 'Title',
			'start' => 'Start',
			'end' => 'End',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'user_id' => 'User ID',
			'description' => 'Description',
			'repeat' => 'Repeat',
			'end_repeat' => 'End Repeat',
			'block_other' => 'Block Other',
		];
	}

	/**
	 * @return ActiveQuery
	 */
	public function getRepeat0()
	{
		return $this->hasOne(RepeatPeriods::class, ['id' => 'repeat']);
	}

	/**
	 * @return ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(Users::class, ['id' => 'user_id']);
	}

	/**
	 * @return ActiveQuery
	 */
	public function getAttachments()
	{
		return $this->hasMany(Attachments::class, ['activity' => 'id']);
	}

	/**
	 * @return ActiveQuery
	 */
	public function getUserActivities()
	{
		return $this->hasMany(UserActivities::class, ['activity_id' => 'id']);
	}
}
