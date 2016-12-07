<?php

namespace app\models;

use Yii;
use yii\db\Query;
use app\utility\PictureManager;

/**
 * This is the model class for table "images".
 *
 * @property integer $image_id
 * @property string $image_name
 * @property string $image_type
 * @property resource $image
 * @property string $image_size
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_name'], 'string', 'max' => 50],
            [['image_type', 'image_size'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'image_name' => 'Image Name',
            'image_type' => 'Image Type',
            'image' => 'Image',
            'image_size' => 'Image Size',
        ];
    }
    
    public static function findByImageName ($imageName)
    {
    	if (self::findOne (Array ('image_name' => $imageName)))
    	{
    		return true;
    	}
    	return false;
    }
    
    public static function findByImageSize ($imageSize)
    {
    	if (self::findOne (Array ('image_size' => $imageSize)))
    	{
    		return true;
    	}
    	return false;
    }
    
    //list images from images table
    public static function listImages ()
    {
    	$query = new Query ();
    	$result = $query->select ('image_id')
    					->from ('images')->all ();
    	$imageList = Array ();
    	foreach ($result as $key=>$value)
		{
			array_push($imageList, PictureManager::displayBlobPicture ($value['image_id'], 'images', 'image', 'image_id'));
		}
		return $imageList;
    }
}
