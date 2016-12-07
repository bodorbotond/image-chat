<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-upload-image">
	<h1><?= Html::encode($this->title) ?></h1>

    <p>Please choose image from computer:</p>
	
	<div class="row">
		<div class="col-lg-4">
		    <?php $form = ActiveForm::begin (Array (
		        'id' => 'upload-image-form',
		    )); ?>
		
		        <?= $form->field ($model, 'image')->fileInput() ?>
		
		        <div class="form-group">
		        	<?= Html::submitButton ('Upload', ['class' => 'btn btn-primary', 'name' => 'upload-image-button']) ?>
		        </div>
		
		    <?php ActiveForm::end (); ?>
		</div>
	</div>
</div>

<div id="ImageGridView">
	<?php foreach ($imageList as $key=>$value)
	{
		echo '<div class="SmallImage" onclick="imageSizeChange(' . $key . ')">' .
			 $value .
			 '</div>';
	}
	?>
</div>
