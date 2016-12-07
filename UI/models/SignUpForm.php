<?php 	 

namespace app\models;

use yii\base\Model;
use yii\validators\EmailValidator;
use app\utility\PictureManager;
use app\utility\PasswordManager;
use app\models\Users;

/**
 * SignUpForm is the model behind the signup form. *
 */
class SignUpForm extends Model
{
	public $userName;
 	public $eMail;
 	public $password;
 	public $firstName;
 	public $lastName;
 	public $profilePicture;

	/**
	 * @return array the validation rules.
	 */
	public function rules ()
	{
		return Array (
 				// username, password and e-mail are required
 				Array (Array ('userName', 'eMail', 'password', 'firstName', 'lastName'), 'required'),
 				// userName is validated by validateUserName()
 				Array ('userName', 'validateUserName'),
 				// eMail is validated by validateEMail()
 				Array ('eMail', 'validateEMail'),
 				// password is validated by validatePassword()
 				Array ('password', 'validatePassword'),
				// profilePicture must be file type, picture's extension must be .png or .jpg and picture's max. size must be smaller than 500KB
				Array (Array ('profilePicture'), 'file', 'extensions' => 'png, jpg', 'maxSize' => 512000, 'tooBig' => 'Limit is 500KB'),
 		);
	}
	
	//return labels for the input fields
	public function attributeLabels ()
	{
		return Array (
			'userName' 		 => 'User Name',
			'eMail'			 => 'Email',
			'password'		 => 'Password',
			'firstName'		 => 'First Name',
			'lastName'		 => 'Last Name',
			'profilePicture' => 'Profile Picture'
		);
	}
	
	public function validateUserName ($attribute)
	{
		if (Users::findByUsername ($this->userName))
		{
			$this->addError ($attribute, "This username is already exists!");
		}
	}
	
	public function validateEMail ($attribute)
	{
		$validator = new EmailValidator ();
		if (! $validator->validate ($this->eMail, $error))
		{
			$this->addError ($attribute, "Email is not valid!");
		}	
		
		if (Users::findByEMail ($this->eMail))
		{
			$this->addError ($attribute, "This email is already exists!");
		}
	}
	
	public function validatePassword ($attribute)
	{
		if (strlen ($this->password) < 8)
		{
			$this->addError ($attribute, "The password must be at least 8 characters!");
		}
	}
	
	// crete new user
	public function signUp ()
	{
		if ($this->validate ())
		{
			$user = new Users ();
			$user->user_name 		= $this->userName;
			$user->e_mail 			= $this->eMail;
			$user->password 		= PasswordManager::hashPassword ($this->password);
			$user->first_name 		= $this->firstName;
			$user->last_name 		= $this->lastName;
			$user->profile_picture  = PictureManager::insertBlobPicture ('SignUpForm', 'profilePicture'); 
			$success = $user->insert ();
			return $success;
		}
		return false;
	}
}
