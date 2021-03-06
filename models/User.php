<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Class User
 * @package app\models
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $access_token
 * @property int $created_at
 * @property int $updated_at
 *
 * @property string $authKey
 * @property-write string $password -> setPassword()
 */
class User extends ActiveRecord implements IdentityInterface
{
	public static function tableName()
	{
		return 'users';
	}

	/**
	 * @param int|string $id
	 * @return User|IdentityInterface|null
	 */
	public static function findIdentity($id)
	{
		return self::findOne(['id' => $id]);
	}

	/**
	 * @param mixed $token
	 * @param null $type
	 * @return User|IdentityInterface|null
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		return self::findOne(['access_token' => $token]);
	}

	/**
	 * @param $username
	 * @return User|null
	 */
	public static function findByUsername($username)
	{
		if ($user = self::findOne(['username' => $username])) {
			return $user;
		}
		return null;
	}

	/**
	 * Получаем id пользователя
	 * @return int|string
	 */
	public function getId()
	{
		return $this->id;
	}


	/**
	 * @return string
	 */
	public function getAuthKey()
	{
		return $this->auth_key;
	}

	/**
	 * @param string $authKey
	 * @return bool
	 */
	public function validateAuthKey($authKey)
	{
		return $this->auth_key === $authKey;
	}

	/**
	 * @param $password
	 * @return bool
	 */
	public function validatePassword($password)
	{
		return Yii::$app->security->validatePassword($password, $this->password_hash);
	}

	/**
	 * @throws \yii\base\Exception
	 */
	public function generateAuthKey()
	{
		$this->auth_key = Yii::$app->security->generateRandomString();
	}

	/**
	 * @param $password
	 * @throws \yii\base\Exception
	 */
	public function setPassword($password)
	{
		$this->password_hash = Yii::$app->security->generatePasswordHash($password);
	}

	/**
	 * Register new user. If success -> auto login
	 * @param $userData[]
	 * @return bool
	 * @throws \yii\base\Exception
	 */
	public function registration() {
		$this->setPassword($this->password_hash);
		$this->generateAuthKey();
		$this->access_token = 'test';

		if ($this->save()) {
			Yii::$app->user->login($this,0);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			[['username', 'email', 'password_hash'], 'required'],
			[['username'], 'string', 'min' => 5, 'max' => 30],
			[['username'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'username'],
			[['email'], 'email'],
			[['password_hash'], 'string', 'min' => 6],
		];
	}

}