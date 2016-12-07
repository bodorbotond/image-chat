<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\utility\PictureManager;

$this->title = 'Friends';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-search-friends">
	<h1><?= Html::encode ($this->title) ?></h1>

    <p>Please fill out the following field to search friends:</p>
	
	<div class="row">
		<div class="col-lg-4">
		    <?php $form = ActiveForm::begin (Array (
		        'id' => 'search-friend-form',
		    )); ?>
		
		        <?= $form->field ($model, 'friendUserName')->textInput() ?>
		
		        <div class="form-group">
		        	<?= Html::submitButton ('Search', ['class' => 'btn btn-primary', 'name' => 'search-friend-button']) ?>
		        </div>
		
		    <?php ActiveForm::end (); ?>
		</div>
	</div>
</div>

<div>
<?php foreach ($friendsList as $key=>$value): ?>
	<div class="Friend">
		<?= Html::a (PictureManager::displayBlobPicture($value['user_id'],
												'users',
												'profile_picture',
												'user_id'),
					Array ('/user/profile/show/' . $value['user_id']))
		?>
		<br>
		<?= $value['user_name'] ?>
	</div>
<?php endforeach;?>
</div>