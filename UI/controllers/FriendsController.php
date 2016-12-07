<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SearchFriendForm;
use app\models\Friends;

class FriendsController extends Controller
{
	public function actionIndex ()
	{
		$friendsList = Friends::listFriends ();
		
		$model = new SearchFriendForm ();
		if ($model->load (Yii::$app->request->post ()))
		{
			return $this->redirect (Array ('/friends/search'));
		}
		
		return $this->render ('index', Array ('model' 		 => $model,
											  'friendsList' => $friendsList
									   ));
	}
	
	public function actionSearch ()
	{
		$model = new SearchFriendForm ();
		$searchedFriendList = $model->searchFriends();
		return $this->render ('searchedFriendList', Array ('model' 				=> $model,
														   'searchedFriendList' => $searchedFriendList
													));
	}
	
	public function actionAddFriend ($friendId)
	{
		//get logged in user's id
		$userId = Yii::$app->user->getId ();
		// create relation and insert to friend's table
		$friends = new Friends ();
		$friends->user_id = $userId;
		$friends->friend_id = $friendId;
		$friends->insert ();
		
		/*$friends = new Friends ();
		$friends->user_id = $friendId;
		$friends->friend_id = $userId;
		$friends->insert ();*/
		return $this->redirect (Array ('/user/profile/show/' . $friendId));
	}
	
	public function actionDeleteFriend ($relationId)
	{
		//find relation in friends table by relation_id
		$relation = Friends::findone ($relationId);
		$relation->delete ();
		//$relation2 = Friends::findone ($relationId + 1);
		//$relation2->delete ();
		return $this->redirect (Array ('/friends/index'));
	}
}
