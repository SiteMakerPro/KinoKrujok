<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<!-- 1. Контент карточки (картинка и текст) -->
<?= Html::img('@web/img/home/' . $model['imgPath'] . '.jpg', ['alt' => $model['title'], 'class' => 'mood-img']) ?>

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

<!-- 2. Невидимая форма на весь размер карточки -->
<form action="<?= Url::to(['site/mark-as-watched', 'id' => $model['id']]) ?>" method="post" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 10; margin: 0; padding: 0;">
	<input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
	
	<!-- Кнопка, которая занимает 100% карточки, но она прозрачная -->
	<button type="submit" style="width: 100%; height: 100%; background: transparent; border: none; cursor: pointer; padding: 0; position: relative; outline: none;" title="Отметить как просмотренное">
		
		<!-- А вот тут лежит наша стрелочка, которую мы жестко прибили в правый нижний угол -->
		<span class="mood-arrow" style="position: absolute; bottom: 20px; right: 20px; display: flex; align-items: center; justify-content: center; color: var(--text-main);">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z" /></svg>
		</span>
		
	</button>
</form>