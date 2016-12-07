<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $user_id
 * @property string $user_name
 * @property string $e_mail
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $profile_picture
 *
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
	
    /**
     * @inheritdoc
     */
    public static function tableName ()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules ()
    {
        return Array (
            Array (Array ('user_name', 'e_mail', 'password'), 'required'),
            Array (Array ('user_name', 'e_mail', 'password'), 'string', 'max' => 50),
            Array (Array ('first_name', 'last_name'), 'string', 'max' => 25),
            Array (Array ('user_name'), 'unique'),
            Array (Array ('e_mail'), 'unique'),
        );
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels ()
    {
        return Array (
            'user_id' 			=> 'User ID',
            'user_name' 		=> 'User Name',
            'e_mail' 			=> 'Email',
            'password' 			=> 'Password',
            'first_name' 		=> 'First Name',
            'last_name' 		=> 'Last Name',
        	'profile_picture' 	=> 'Profile Picture',
        );
    }
    
	public function getAuthKey ()
    {
    	
    }
    
    public function validateAuthKey ($authKey)
    {
    	
    }
    
    public function getId ()
    {
    	return $this->user_id;
    }
    
    public static function findIdentity ($id)
    {
    	return self::findOne ($id);
    }
    
    public static function findIdentityByAccessToken ($token, $type = null)
    {
    	throw new NotSupportedException ();
    }
    
    public static function findByUsername ($userName)
    {
    	return self::findOne (Array('user_name' => $userName));
    }
    
    public static function findByEMail ($eMail)
    {
    	return self::findOne (Array ('e_mail' => $eMail));
    }
    
    //Check the hashed password with the password entered by user
    public function validatePassword ($password) {
    	return $this->password === md5 ($password);
    }
}