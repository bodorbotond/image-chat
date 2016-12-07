<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadImageForm;
use app\models\Images;

class ImageController extends Controller
{
	
	public function actionIndex ()
	{
		$model = new UploadImageForm ();
		$imageList = Images::listImages (); 
		if ($model->load (Yii::$app->request->post ()) && $model->uploadImage ())
		{
			$imageList = Images::listImages ();
			return $this->render ('index', Array ('model' 	  => $model,
												  'imageList' => $imageList
										   ));
		}
		return $this->render ('index', Array ('model' 	  => $model,
											  'imageList' => $imageList
									   ));
	}
	
}