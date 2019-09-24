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
 * @property string $password_hash
 * @property string $auth_key
 * @property string $access_token
 * @property int $created_at
 * @property int $updated_at
 *
 * @property string $authKey
 * @property-write string $password -> setPassword()
 */
class UserDB extends ActiveRecord implements IdentityInterface
{
	public static function tableName()
	{
		return 'users';
	}

	public static function findIdentity($id)
	{
		return self::findOne(['id' => $id]);
	}


	public static function findIdentityByAccessToken($token, $type = null)
	{
		return self::findOne(['access_token' => $token]);
	}

	public static function findByUsername($username)
	{
		if ($user = self::findOne(['username' => $username])) {
			return $user;
		}
		return null;
	}

	public function getId()
	{
		return $this->id;
	}


	public function getAuthKey()
	{
		return $this->auth_key;
	}


	public function validateAuthKey($authKey)
	{
		return $this->auth_key === $authKey;
	}

	public function validatePassword($password)
	{
		return Yii::$app->security->validatePassword($password, $this->password_hash);
	}

	public function generateAuthKey()
	{
		$this->auth_key = Yii::$app->security->generateRandomString();
	}

	public function setPassword($password)
	{
		$this->password_hash = Yii::$app->security->generatePasswordHash($password);
	}


}