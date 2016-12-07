<?php

use yii\helpers\Html;

$this->title = 'Profile';
if ($profileType == 'otherUserProfile')
{
	$this->params['breadcrumbs'][] = ['label' => 'Friends', 'url' => ['/friends/index']];
	if (!$isFriend)
	{
		$this->params['breadcrumbs'][] = ['label' => 'Searched Friends List', 'url' => ['/friends/search']];
	}
}
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= $model->user_name ?></h1>
<div id="ProfileContainer">
	<div id="AboutProfile">
		<h3><b>About:</b></h3>
		<h3 style="margin-left: 2em"><?= $model->e_mail ?></h3>
		<h3 style="margin-left: 2em"><?= $model->first_name ?></h3>
		<h3 style="margin-left: 2em"><?= $model->last_name ?></h3>
	</div>
	<div id ="ProfilePicture">
		<?= $profilePicture ?>
	</div>
</div>

<br>
<div>
	<?php
	echo $profileType == 'otherUserProfile' ?
											  ($isFriend == true ? 
																   Html::a ('Delete Friend', Array ('/friends/delete/' . $relationId), Array ('class' => 'btn btn-primary', 'onclick' => 'return confirm("Are you sure you want to unfriend this person?")'))
																 : Html::a ('Add Friend', Array ('/friends/add/' . $model->user_id), Array ('class' => 'btn btn-primary')))
											: Html::a ('Edit Profile', Array ('/user/profile/edit/' . $model->user_id), Array ('class' => 'btn btn-primary'));
	?>
</div>