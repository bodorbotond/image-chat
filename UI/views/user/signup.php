<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Sign Up';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to sign up:</p>
	
	<div class="row">
		<div class="col-lg-4">
		    <?php $form = ActiveForm::begin (Array (
		        'id' 		=> 'signup-form',
		    	'options' 	=> Array ('enctype' => 'multipart/form-data'),
		    )); ?>
		
		        <?= $form->field ($model, 'userName')->textInput () ?>
		        
		        <?= $form->field ($model, 'eMail')->textInput () ?>
		
		        <?= $form->field ($model, 'password')->passwordInput () ?>
		        
		        <?= $form->field ($model, 'firstName')->textInput () ?>
		        
		        <?= $form->field ($model, 'lastName')->textInput () ?>
		        
		        <?= $form->field ($model, 'profilePicture')->fileInput ()?>
		
		        <div class="form-group">
		        	<?= Html::submitButton ('Sign Up', Array ('class' => 'btn btn-primary', 'name' => 'signup-button')) ?>
		        </div>
		
		    <?php ActiveForm::end (); ?>
		</div>
	</div>
</div>