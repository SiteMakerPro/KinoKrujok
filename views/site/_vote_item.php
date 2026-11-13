<?php

use yii\helpers\Html;
?>
<div class="movie-card-top">
	<div class="movie-poster-wrap">
		<?= Html::img('@web/img/vote/' . $model['imgPath'] . '.jpg', ['alt' =>
		$model['title']]) ?>
		<button class="fav-btn">
			<svg
				width="16"
				height="16"
				viewBox="0 0 24 24"
				fill="none"
				stroke="currentColor"
				stroke-width="2"
				stroke-linecap="round"
				stroke-linejoin="round">
				<path
					d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
			</svg>
		</button>
	</div>
	<div class="movie-info">
		<div class="movie-title"><?= $model['title'] ?></div>
		<div class="movie-year">(<?= $model['year'] ?>)</div>
		<div class="movie-genres">
			<?= Html::encode(implode(', ', array_column($model['genres'], 'name'))) ?>
		</div>
		<div class="movie-rating">
			<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
				<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
			</svg>
			<?= Html::encode($model['rating']) ?>
			<span>(<?= Yii::$app->formatter->asInteger($model['votesCountNumber']) ?>)</span>
		</div>
	</div>
</div>
<div class="movie-card-bottom">
	<button class="btn-vote">
		<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
			<polyline points="20 6 9 17 4 12"></polyline>
		</svg>
		Голосовать
	</button>
</div>
