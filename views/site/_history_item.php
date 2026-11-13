<?php

use yii\helpers\Html;
?>
<div class="list-row">
	<div class="col-film">
		<?= Html::img('@web/img/history/' . $model['imgPath'] . '.jpg', ['alt' =>
		'Интерстеллар', 'class' => 'film-poster']) ?>
		<div class="film-info">
			<span class="film-title"><?= Html::encode($model['title']) ?></span>
			<span class="film-year">(<?= Html::encode($model['year']) ?>)</span>
		</div>
	</div>
	<div class="col-date"><?= Yii::$app->formatter->asDate($model['viewingDate'], 'php:d M Y') ?></div>
	<p class="col-genres">
		<?= Html::encode(implode(', ', array_column($model['genres'], 'name'))) ?>
	</p>
	<div class="col-rating">
		<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
			<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
		</svg>
		<?= Html::encode($model['rating']) ?>
	</div>
	<div class="col-status">
		<span class="status-badge <?php echo (Html::encode($model['isLiked'])) ? 'status-like' : 'status-dislike' ?>"
			><?php echo (Html::encode($model['isLiked'])) ? 'Понравилось' : 'Не понравилось' ?></span
		>
	</div>
</div>
