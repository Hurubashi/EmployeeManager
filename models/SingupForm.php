<?php


namespace app\models;


use Yii;
use yii\base\Model;

class SingupForm extends Model
{
	public $username;
	public $email;
	public $password;
	public $rePassword;

	public function rules()
	{
		return [
			[['username', 'email', 'password', 'rePassword'], 'required'],
			[['username'], 'string', 'min' => 3],
			[['email'], 'email'],
			['rePassword', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
			[['email'], 'unique', 'targetClass'=>'app\models\User', 'targetAttribute'=>'email'],
			[['username'], 'unique', 'targetClass'=>'app\models\User', 'targetAttribute'=>'username']
		];
	}

	public function attributeLabels()
	{
		return [
			'rePassword' => 'Confirm Password',
		];
	}

	public function signup()
	{
		if($this->validate())
		{
			$user = new User();
			$user->attributes = $this->attributes;
			$hash = Yii::$app->getSecurity()->generatePasswordHash($user->password);
			$user->password = $hash;
			return $user->create();
		}
	}
}