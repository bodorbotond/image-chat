<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "friends".
 *
 * @property integer $relation_id
 * @property integer $user_id
 * @property integer $friend_id
 *
 * @property Users $friend
 * @property Users $user
 */
class Friends extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName ()
    {
        return 'friends';
    }

    /**
     * @inheritdoc
     */
    public function rules ()
    {
        return [
            [['user_id', 'friend_id'], 'required'],
            [['user_id', 'friend_id'], 'integer'],
            [['friend_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['friend_id' => 'user_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels ()
    {
        return [
            'relation_id' 	=> 'Relation ID',
            'user_id' 		=> 'User ID',
            'friend_id' 	=> 'Friend ID',
        ];
    }
    
    public static function getRelationId ($friendId)
    {
    	$query = new Query ();
    	$result = $query->select ('relation_id')
    					->from ('friends')
    					->where ('user_id = ' . Yii::$app->user->getId ()  . ' and friend_id = ' . $friendId)->all ();
    	if ($result)
    	{
    		return $result[0]['relation_id'];
    	}
    	else
    	{
    		return NULL;
    	}
    }

    //returns whether logged in user is friend with $friendId's user
    public static function isFriend ($friendId)
    {
    	$relationId = self::getRelationId ($friendId);
    	if ($relationId === NULL)
    	{
    		return false;
    	}
    	else
    	{
    		return true;	
    	}
    }
    
    //list logged in user's friends
    public static function listFriends ()
    {
    	$query = new Query ();
    	$result = $query->select ('u2.user_name, u2.user_id')
    					->from ('users u1, users u2, friends f')
    					->where ('u1.user_id = f.user_id
				 		and u1.user_id = ' . Yii::$app->user->getId () .
    			 		' and f.friend_id = u2.user_id')->all ();
    	return $result;
    }
}
