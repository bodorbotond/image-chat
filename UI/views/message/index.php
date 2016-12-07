<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use app\utility\PictureManager;

$this->title = 'Chat';
$this->params['breadcrumbs'][] = $this->title;

echo "<script type='text/javascript'> window.onload=addMessages (); </script>";
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Please enter a message:</p>
		    
<?php Pjax::begin (); ?>
<?= Html::beginForm (Array ('/message/index'), 'post', Array ('data-pjax' => '', 'class' => 'form-inline')); ?>
	<?= Html::input ('text', 'message', '', Array ('class' => 'form-control')) ?>
	<br><br>
	<?= Html::dropDownList('images', 0, $imagesForList, Array ('prompt' => 'Choose image...')) ?>
	<br><br>
	<?= Html::submitButton ('Send', Array ('class' => 'btn btn-primary', 'name' => 'send-message-button', 'onclick' => 'addMessages (' . ')')) ?>
<?= Html::endForm () ?>

<h2>Images:</h2>
<div id="PictureContainer">
	<?php
	foreach ($images as $key=>$value)
	{
		echo '<div class="SmallerImage">' .
			 PictureManager::displayBlobPicture($value['image_id'], 'images', 'image', 'image_id') .
			 '<p>' . $value['image_name'] . '</p>' .  
			 '</div>';
	}
	?>
	
</div>

<br>
<div id="MessageErrors">
	<?php 
	foreach ($errors as $key=>$value)
	{
		echo $value[0] . '<br><br>';
	}
	?>
	
</div>

<div id="MessageContainer">
	<h3>Messages</h3>
	<?= Html::img (Yii::$app->homeUrl . 'images/exitIcon.png', Array ('id' => 'ExitIcon', 'onclick' => 'hiddenMessages()',)) ?>
	<br>
	<div id="MessageContainerDiv">
		<?= Yii::$app->session->getFlash ('message') ?>
	</div>
</div>

<div id="OnlineFriends">
	<h3>Online Friends</h3><br>
	<div>
		<?php
		foreach ($onlineFriends as $key=>$value)
		{
			echo PictureManager::displayBlobPicture ($value['user_id'],
													'users',
													'profile_picture',
													'user_id') .
				 '<p id = "FriendName" onclick = "displayMessages()">' . $value['user_name'] . '</p>' .
				 '<br>';
		}
		?>
	</div>
</div>

<?php Pjax::end(); ?>
