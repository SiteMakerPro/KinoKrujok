<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?= Html::img('@web/img/home/' . $model['imgPath'] . '.jpg', ['alt' =>
$model['title'], 'class' => 'mood-img']) ?>

<div class="mood-overlay">
	<div class="mood-icon">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
			<path d="M12 2a8 8 0 0 0-8 8v12l3-3 2.5 2.5L12 19l2.5 2.5L17 19l3 3V10a8 8 0 0 0-8-8z"></path>
			<line x1="9" y1="10" x2="9.01" y2="10"></line>
			<line x1="15" y1="10" x2="15.01" y2="10"></line>
		</svg>
	</div>
	<div class="mood-title"><?= Html::encode($model['title']) ?></div>

	<div class="mood-desc">
		<?= Html::encode(implode(', ', array_column($model['genres'], 'name'))) ?>
	</div>
</div>

<a href="<?= Url::to(['site/vote', 'id' => $model['id']]) ?>" class="mood-arrow">
	<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z" /></svg>
</a>
