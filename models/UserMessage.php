<?php


namespace app\models;


use yii\base\Model;

class UserMessage extends Model
{
	public $email;
	public $title;
	public $content;

	public function attributeLabels()
	{
		return [
			'email' => 'Ваш e-mail *',
			'title' => 'Тема сообщения',
			'content' => 'Текст сообщения',
		];
	}

	public function rules()
	{
		return [
			[['email', 'content', 'title'], 'required'],
			[['email'], 'email'],
			[['title'], 'string', 'min' => 5, 'max' => 30],
		];
	}
}