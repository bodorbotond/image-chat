<?php

namespace app\models;

use yii\base\Model;

class SendMessageForm extends Model
{
	public $message;
	
	public function rules ()
	{
		return Array(
					Array ('message', 'required'),
				);
	}
	
	public function attributeLabels ()
	{
		return Array (
				'message' => 'Message'
		);
	}
	
	public function getMessage ()
	{
		return $this->message;
	}
}