<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\validators\EmailValidator;
use yii\db\Query;
use app\utility\PictureManager;
use app\utility\PasswordManager;
use app\models\Users;

/**
 * SignUpForm is the model behind the signup form. *
 */
class EditProfileForm extends Model
{
	public $user;
	public $userName;
	public $eMail;
	public $password;
	public $firstName;
	public $lastName;
	public $profilePicture;
	
	public function __construct ()
	{
		$this->user 		= Users::findOne(Yii::$app->user->getId ());
		$this->userName 	= $this->user->user_name;
		$this->eMail 		= $this->user->e_mail;
		$this->firstName 	= $this->user->first_name;
		$this->lastName 	= $this->user->last_name;
	}

	/**
	 * @return array the validation rules.
	 */
	public function rules ()
	{
		return Array (
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
				'userName' 	=> 'User Name',
				'eMail'		=> 'Email',
				'password'	=> 'Password',
				'firstName'	=> 'First Name',
				'lastName'	=> 'Last Name',
				'profilePicture' => 'Profile Picture'
				);
	}

	public function validateUserName ($attribute)
	{
		$queryUserName = new Query;
		$userName = $queryUserName->select ('user_name')
								  ->from ('users')
								  ->where ('user_id = ' . Yii::$app->user->getId ())->one ();
			
		$query = new Query ();
		$result = $query->select ('user_name')
						->from ('users')->all ();
		
		foreach ($result as $key=>$value)
		{
			if ($value['user_name'] == $userName['user_name'])
			{
				unset($result[$key]);
			}
		}
		
		foreach ($result as $key=>$value)
		{
			if ($value['user_name'] == $this->userName)
			{
				 $this->addError($attribute, "This username is already exists!");
			}
		}
		/*if (Users::findByUsername ($this->userName))
		{
			$this->addError ($attribute, "This username is alredy exists!");
		}*/
	}

	public function validateEMail ($attribute)
	{
		$validator = new EmailValidator ();
		if (! $validator->validate ($this->eMail, $error))
		{
			$this->addError ($attribute, "Email is not valid!");
		}
		
		$queryEMail = new Query;
		$EMail = $queryEMail->select ('e_mail')
							   ->from ('users')
							   ->where ('user_id = ' . Yii::$app->user->getId ())->one ();
			
		$query = new Query ();
		$result = $query->select ('e_mail')
						->from ('users')->all ();
		
		foreach ($result as $key=>$value)
		{
			if ($value['e_mail'] == $EMail['e_mail'])
			{
				unset($result[$key]);
			}
		}
		
		foreach ($result as $key=>$value)
		{
			if ($value['e_mail'] == $this->eMail)
			{
				 $this->addError($attribute, "This email is already exists!");
			}
		}
		/*if (Users::findByEMail ($this->eMail))
		{
			$this->addError ($attribute, "This email is already exists!");
		}*/
	}

	public function validatePassword ($attribute)
	{
		if (strlen ($this->password) < 8)
		{
			$this->addError ($attribute, "The password must be at least 8 characters!");
		}
	}

	public function editProfile ()
	{
		if ($this->validate ())
		{
			$user = Users::findOne (Yii::$app->user->getId ());
			$user->user_name 	= $this->userName;
			$user->e_mail 		= $this->eMail;
			$user->password 	= PasswordManager::hashPassword($this->password);
			$user->first_name 	= $this->firstName;
			$user->last_name 	= $this->lastName;
			if (!empty ($_FILES['EditProfileForm']['tmp_name']['profilePicture']))
			{
				$user->profile_picture  = PictureManager::insertBlobPicture ('EditProfileForm', 'profilePicture');
			}
			$success = $user->update ();
			return $success;
		}
		return false;
	}
}
