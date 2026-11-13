<?php


use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

?>
<section class="history-hero">
	<div class="history-hero-bg"></div>
	<div class="history-hero-content">
		<div class="history-hero-label">
			<svg
				width="20"
				height="20"
				viewBox="0 0 24 24"
				fill="none"
				stroke="currentColor"
				stroke-width="2"
				stroke-linecap="round"
				stroke-linejoin="round">
				<circle cx="12" cy="12" r="10"></circle>
				<polyline points="12 6 12 12 16 14"></polyline>
			</svg>
			История
		</div>
		<h1>Просмотренные<br /><span>фильмы.</span></h1>

		<div class="hero-stats">
			<div class="hero-stat-item">
				<svg
					class="hero-stat-icon"
					width="32"
					height="32"
					viewBox="0 0 24 24"
					fill="none"
					stroke="currentColor"
					stroke-width="2"
					stroke-linecap="round"
					stroke-linejoin="round">
					<circle cx="12" cy="12" r="10"></circle>
					<circle cx="12" cy="12" r="3"></circle>
					<path d="M12 2v4"></path>
					<path d="M12 18v4"></path>
					<path d="M2 12h4"></path>
					<path d="M18 12h4"></path>
				</svg>
				<div class="hero-stat-text">
					<span class="hero-stat-label">Всего просмотрено:</span>
					<span class="hero-stat-value">24 фильма</span>
				</div>
			</div>
			<div class="hero-stat-item">
				<svg
					class="hero-stat-icon"
					width="32"
					height="32"
					viewBox="0 0 24 24"
					fill="none"
					stroke="currentColor"
					stroke-width="2"
					stroke-linecap="round"
					stroke-linejoin="round">
					<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
				</svg>
				<div class="hero-stat-text">
					<span class="hero-stat-label">Средний рейтинг:</span>
					<span class="hero-stat-value">7.8</span>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="sorting">
	<select class="sort-select">
		<option>Сначала новые</option>
		<option>Сначала старые</option>
		<option>По рейтингу</option>
	</select>
</div>

<section class="history-list">
	<div class="list-header">
		<div>Фильм</div>
		<div>Дата просмотра</div>
		<div>Жанр</div>
		<div>Оценка</div>
		<div>Статус</div>
		<div>Действия</div>
	</div>
	<?php echo ListView::widget([
			'dataProvider' =>
	$dataProvider, 'itemView' => '_history_item', 'summary' => '', 'layout' => '{items}' ]); ?>

	<div class="list-footer">
		<div class="pagination-info">
			Показаны
			<?= $dataProvider->getCount() ?> из
			<?= $dataProvider->getTotalCount() ?> фильмов
		</div>
		<?= LinkPager::widget([
					'pagination' =>
		$dataProvider->pagination, 'options' => ['class' => 'pagination-controls'], 'prevPageLabel' => "&lArr;", 'nextPageLabel' => "&rArr;",
		'maxButtonCount' => 3, 'activePageCssClass' => 'active-page', 'disabledPageCssClass' => 'disabled-page', ]) ?>
	</div>
</section>

<section class="empty-state">
	<?= Html::img('@web/img/history/empty-popcorn.jpg', ['alt' =>
	'Пусто', 'class' => 'empty-img']) ?>
	<h2 class="empty-title">Вы еще ничего не смотрели.</h2>
	<p class="empty-text">Начните с голосования!</p>
	<button class="btn-primary">
		<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
			<rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
			<path d="M9 3v18"></path>
		</svg>
		Перейти к голосованию
	</button>
</section>
