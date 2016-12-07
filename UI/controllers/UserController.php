<?php

namespace app\controllers;

use yii\db\Query;
use Yii;
use yii\web\Controller;
use app\utility\PictureManager;
use app\models\LoginForm;
use app\models\SignUpForm;
use app\models\EditProfilForm;
use app\models\Users;
use app\models\Friends;
use app\models\EditProfileForm;

class UserController extends Controller
{
	/**
	 * Login action.
	 *
	 * @return string
	 */
	public function actionLogin ()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->goHome ();
		}

		$model = new LoginForm ();
		if ($model->load (Yii::$app->request->post ()) && $model->login ()) {
			return $this->goBack ();
		}
		return $this->render ('login', Array ('model' => $model));
	}

	/**
	 * Logout action.
	 *
	 * @return string
	 */
	public function actionLogout ()
	{
		Yii::$app->user->logout ();

		return $this->goHome ();
	}
	
	/**SingUp action
	 * 
	 * @return string
	 */
	public function actionSignUp ()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->goHome ();
		}
		
		$model = new SignUpForm ();
		if ($model->load (Yii::$app->request->post ()) && $model->signUp ())
		{
			return $this->redirect (Array ('/user/login'));
		}
		return $this->render ('signup', Array ('model' => $model));
	}
	
	public function actionShowProfile ($userId)
	{
		$model = Users::findOne ($userId);
		$isFriend = false;
		//$relationId for delete friends 
		$relationId = NULL;
		//type of user for show profile: logged in user(myProfile, default) || other user's profile(otherUserProfile)
		$profileType = 'myProfile';
		//if (user profile request's id != logged in user's id) => $userType = 'otherUserProfile'
		if ($userId != Yii::$app->user->getId ())
		{
			$profileType = 'otherUserProfile';
			if (Friends::isFriend($userId))
			{
				$isFriend = true;
				$relationId = Friends::getRelationId ($userId);
			}
		}
		$profilePicture = PictureManager::displayBlobPicture ($userId, "users", "profile_picture", "user_id");
		return $this->render ('profile', Array ('model' 	 	 => $model,
												'profileType' 	 => $profileType,
												'isFriend' 	 	 => $isFriend,
												'relationId' 	 => $relationId,
												'profilePicture' => $profilePicture));
	}
	
	public function actionEditProfile ($userId)
	{
		$model = new EditProfileForm ();
		if ($model->load (Yii::$app->request->post ()) && $model->editProfile ())
		{
			return $this->redirect (Array ('/user/profile/show/' . $userId));
		}
		return $this->render ('editProfile', Array ('model' => $model));
	}
	
}
