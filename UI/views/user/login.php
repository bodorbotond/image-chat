<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode ($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

	<div class="row">
		<div class="col-lg-4">
		    <?php $form = ActiveForm::begin (Array (
		        'id' => 'login-form',
		    )); ?>
		
		        <?= $form->field ($model, 'userName')->textInput () ?>
		
		        <?= $form->field ($model, 'password')->passwordInput () ?>
		
		        <div class="form-group">
		        	<?= Html::submitButton ('Login', Array ('class' => 'btn btn-primary', 'name' => 'login-button')) ?>
		        </div>
		
		    <?php ActiveForm::end (); ?>
	    </div>
	</div>
	<p>
		Don't have an account?
		<?= Html::a ("Sign Up!", Array ("/user/signup")) ?>
	</p>
</div>
