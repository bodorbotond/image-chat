<?php

namespace app\models;

use yii\base\Model;
use app\utility\PictureManager;
use app\models\Images;

class UploadImageForm extends Model
{
	public $image;
	
	public function rules ()
	{
		return Array (
			Array (Array ('image'), 'file',
									'extensions' 	=> 'png, jpg',
									'maxSize' 		=> 512000,
									'tooBig' 		=> 'Limit is 500KB',
									'skipOnEmpty' 	=> false,
									'when'			=> function ()
													   {
													   		if (Images::findByImageName ($_FILES['UploadImageForm']['name']['image'])
													   			|| Images::findByImageSize ($_FILES['UploadImageForm']['size']['image']))
													   		{
													   			$this->addError("Exists:", "This picture is already exists!");
													   			return true;
													   		}
													   		return false;
													   }
				   ),
		);
	}
	
	public function attributeLabels ()
	{
		return Array (
			'image' => 'Image'
		);
	}
	
	public function uploadImage ()
	{
		if ($this->validate ())
		{
			$image = new Images ();
			$imageName = $_FILES['UploadImageForm']['name']['image'];
			$imageNameSplit = explode('.', $imageName);
			$imageType = $imageNameSplit[1];
			$image->image_name 	= $imageName;
			$image->image_type	= $imageType;
			$image->image 		= PictureManager::insertBlobPicture('UploadImageForm', 'image');
			$image->image_size 	= strval ($_FILES['UploadImageForm']['size']['image']);
			$success = $image->insert ();
			return $success;
		}
		return 'fail';
	}
}