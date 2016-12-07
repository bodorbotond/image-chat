<?php

use yii\helpers\Html;
use app\models\Friends;
use app\utility\PictureManager;

$this->title = 'Searched Friends List';
$this->params['breadcrumbs'][] = ['label' => 'Friends', 'url' => ['/friends/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
	<?php foreach ($searchedFriendList as $key=>$value): ?>
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