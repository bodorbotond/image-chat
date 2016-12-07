<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use app\models\Friends;

class SearchFriendForm extends Model
{
	public $friendUserName;
	
	public function rules ()
	{
		return Array (
				Array ('friendUserName', 'required'),
		);
	}
	
	public function attributeLabels ()
	{
		return Array (
			'friendUserName' => 'Friend Name'	
		);
	}
	
	//search friends by friendUserName from users table
	public function searchFriends ()
	{
		$query = new Query ();
		$result = $query->select ('user_name, user_id')
			  			->from ('users')
			  			->where ("user_name like '%" . $this->friendUserName . "%'")->all ();
		
		//delete logged in user from result
		//if logged in user's name is similar to the searched friendUserName
		foreach ($result as $key=>$value)
		{
			if ($value['user_id'] == Yii::$app->user->getId ())
			{
				unset ($result[$key]);
			}
		}
		return $result;
	}
	
}
