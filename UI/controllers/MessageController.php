<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;
use app\models\Socket;
use app\models\Friends;
use app\models\Images;

class MessageController extends Controller
{
	
	public function actionIndex ()
	{
		//connect to Server
		$socket = new Socket ();
		//$socket->connect ();
		//$socket->send('Bortttttttttt1');
		
		//$serverMessage = $socket->receive();
		//echo '<br><br><br><br><br>' . $serverMessage;
		//$socket->send('Bouu2');
		if ($socket->hasErrors ())
		{
			$errors = $socket->getErrors ();
		}
		else
		{
			$errors = Array ();
		}
		$imageIds = Array ();
		$message = Yii::$app->request->post ('message');
		$selectedImageId = Yii::$app->request->post ('images');
		Yii::$app->session->setFlash ('message', $message);
		$query = new Query();
		$images = $query->select ('image_id, image_name')
						->from ('images')
						->all ();
		foreach ($images as $key=>$value)
		{
			$imagesForList[$value['image_id']] = $value['image_name'];
		}
		return $this->render('index', Array ( 'message' 		=> $message,
											  'errors'			=> $errors,
											  'onlineFriends'	=> Friends::listFriends(),
											  'images'			=> $images,
											  'imagesForList'	=> $imagesForList,
											  'selectedImageId'	=> $selectedImageId,			
		));
	}
	
}