<?php

namespace app\utility;

use Yii;
use yii\db\Query;
use yii\helpers\Html;

class PictureManager
{
	//function to insert picture to database
	public static function insertBlobPicture ($formName, $fieldName)
	{
		if (!empty ($_FILES[$formName]['tmp_name'][$fieldName]))
		{
			$tmpName = $_FILES[$formName]['tmp_name'][$fieldName];
			if (($picture = file_get_contents ($tmpName) ) === false) {
				return NULL;
			}
			return $picture;
		}
		return NULL;
	}
	
	//function to display picture from database
	public static function displayBlobPicture ($id, $tableName, $pictureColumnName, $idColumnName)
	{
		
		$query = new Query ();
		$result = $query->select ($pictureColumnName)
						->from ($tableName)
						->where ($idColumnName . ' = ' . $id)->one ();
		if ( !empty ($result[$pictureColumnName]))
		{
			$picture = '<img src="data:image/jpeg;base64,' . base64_encode( $result[$pictureColumnName] ) . '"/>';
		}
		else
		{
			$picture = Html::img (Yii::$app->homeUrl . 'images/profileImage.jpg');
		}
		return $picture;			
	}
}