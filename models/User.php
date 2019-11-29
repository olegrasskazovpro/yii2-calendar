<?php
namespace app\models;

use app\models\forms\UserForm;
use app\models\tables\Users;
use Exception;
use Yii;
use yii\base\BaseObject;
use yii\web\IdentityInterface;

/**
 * Class User
 * @package app\models
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * @property int $created_at
 * @property int $updated_at
 * @property string $authKey
 */
class User extends BaseObject implements IdentityInterface
{
	public $id;
	public $username;
	public $email;
	public $password;
	public $authKey;
	public $accessToken;

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			[['username', 'email', 'password'], 'required'],
			[['username'], 'string', 'min' => 4, 'max' => 30],
			[['username'], 'unique', 'targetClass' => Users::class, 'targetAttribute' => 'username'],
			[['email'], 'email'],
			[['password'], 'string', 'min' => 6],
		];
	}

	/**
	 * @param int|string $id
	 * @return User|IdentityInterface|null
	 */
	public static function findIdentity($id)
	{
		if ($user = Users::findOne(['id' => $id])){
			return new static($user->toArray());
		}
		return null;
	}

	/**
	 * @param mixed $token
	 * @param null $type
	 * @return User|IdentityInterface|null
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		if ($user = Users::findOne(['access_token' => $token])){
			return new static($user->toArray());
		}
		return null;
	}

	/**
	 * @param $username
	 * @return User|null
	 */
	public static function findByUsername($username)
	{
		if ($user = Users::findOne(['username' => $username])) {
			return new static($user->toArray());
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
		return $this->authKey;
	}

	/**
	 * @param string $authKey
	 * @return bool
	 */
	public function validateAuthKey($authKey)
	{
		return $this->authKey === $authKey;
	}

	/**
	 * @param $password
	 * @return bool
	 */
	public function validatePassword($password)
	{
		return Yii::$app->security->validatePassword($password, $this->password);
	}

	/**
	 * Register new user. If success -> auto login
	 * @param array $userData
	 * @param $formName
	 * @return mixed
	 * @throws Exception
	 */
	public static function create(array $userData, $formName)
	{
		$user = new Users();
		$user->setAuthKey();
		$user->access_token = 'test';
		$user->load($userData, $formName);
		$user->setPasswordHash($userData["$formName"]['password']);

		if ($user->save()) {
			$auth = Yii::$app->authManager;
			$role = $auth->getRole('user'); // назначаем пользователю роль Юзера
			$auth->assign($role, $user->id);
			Yii::$app->user->login(User::findIdentity($user->id),0); // авторизуем вновь созданного пользователя
		}
			return $user;
	}

	public static function update($userId, array $userData, $formName)
	{
		$user = Users::findOne($userId);
		$user->scenario = Users::SCENARIO_UPDATE;
		$user->load($userData, $formName);
		$password = $userData["$formName"]['password'];
		if($password){
			$user->setPasswordHash($userData["$formName"]['password']);
		}
		if ($user->save()){
			Yii::$app->session->setFlash('success', 'Пользователь сохранен');
		}

		return $user;
	}

	/**
	 * @param $id - user id
	 * @return UserForm for editing
	 */
	public static function getUserForm($id)
	{
		if ($userData = Users::findOne($id)->toArray()) {
			$userForm = new UserForm(['scenario' => UserForm::SCENARIO_UPDATE]);
			$userForm->attributes = $userData;
			$userForm->password = '';
			return $userForm;
		} else {
			return null;
		}
	}

}