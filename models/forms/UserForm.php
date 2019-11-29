<?php

namespace app\models\forms;

use yii\base\Model;

class UserForm extends Model
{
	const SCENARIO_UPDATE = 'update';

	public $id = null;
	public $username;
	public $email;
	public $password;

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'Your id',
			'username' => 'Your name',
			'email' => 'Your email address',
			'password' => 'Your password',
		];
	}

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			['id', 'safe'],
			['email', 'email'],
			// username, email и password требуются в сценарии "update"
			[['username', 'email', 'password'], 'required', 'on' => self::SCENARIO_DEFAULT],
			[['username', 'email'], 'required', 'on' => self::SCENARIO_UPDATE],
			[['username', 'email', 'password'], 'string', 'max' => 255],
		];
	}
}