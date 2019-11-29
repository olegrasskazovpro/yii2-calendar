<?php


namespace app\models\tables;


use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $access_token
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Activities[] $activities
 * @property mixed $passwordHash
 * @property UserActivities[] $userActivities
 */
class Users extends ActiveRecord
{
	const SCENARIO_UPDATE = 'update';

	public function behaviors()
	{
		return [
			TimestampBehavior::class,
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['username', 'email', 'password_hash', 'auth_key'], 'required'],
			[['username', 'email', 'auth_key'], 'required', 'on' => self::SCENARIO_UPDATE],
			[['created_at', 'updated_at'], 'safe'],
			[['username', 'email', 'password_hash', 'auth_key', 'access_token'], 'string', 'max' => 255],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'username' => 'Username',
			'email' => 'Email',
			'password_hash' => 'Password Hash',
			'auth_key' => 'Auth Key',
			'access_token' => 'Access Token',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	/**
	 * @return ActiveQuery
	 */
	public function getActivities()
	{
		return $this->hasMany(Activities::class, ['user_id' => 'id']);
	}

	/**
	 * @return ActiveQuery
	 */
	public function getUserActivities()
	{
		return $this->hasMany(UserActivities::class, ['user_id' => 'id']);
	}

	public function setAuthKey()
	{
		$this->auth_key = Yii::$app->security->generateRandomString();
	}

	/**
	 * @param $password
	 * @throws Exception
	 */
	public function setPasswordHash($password)
	{
		$this->password_hash = Yii::$app->security->generatePasswordHash($password);
	}

	/**
	 * @return array|false
	 */
	public function fields()
	{
		return [
			'id',
			'username',
			'email',
			'password' => 'password_hash',
			'authKey' => 'auth_key',
			'accessToken' =>'access_token',
		];
	}
}