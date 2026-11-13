<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

?>
<section class="voting-hero">
	<div class="voting-hero-bg"></div>
	<div class="voting-hero-content">
		<div class="voting-hero-label">
			<svg
				width="20"
				height="20"
				viewBox="0 0 24 24"
				fill="none"
				stroke="currentColor"
				stroke-width="2"
				stroke-linecap="round"
				stroke-linejoin="round">
				<rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
				<path d="M9 3v18"></path>
			</svg>
			Голосование
		</div>
		<h1>Голосование за<br /><span>фильм вечера</span></h1>
		<p class="voting-hero-subtitle">Выберите, что будем смотреть в этот раз.</p>
	</div>

	<div class="voting-hero-timer-block">
		Голосование заканчивается через <br class="mobile-break" />
		<span class="timer-value">
			<svg
				width="18"
				height="18"
				viewBox="0 0 24 24"
				fill="none"
				stroke="currentColor"
				stroke-width="2"
				stroke-linecap="round"
				stroke-linejoin="round">
				<circle cx="12" cy="12" r="10"></circle>
				<polyline points="12 6 12 12 16 14"></polyline>
			</svg>
			02:15:00.
		</span>
	</div>
</section>

<div class="filter" style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 30px">
	<a href="<?= Url::to(['site/vote']) ?>" class="filter-btn <?= empty($currentGenreId) ? 'active' : '' ?>"> Все жанры </a>

	<?php foreach ($genres as $genre): ?>
	<a href="<?= Url::to(['site/vote', 'genre_id' => $genre->id]) ?>" class="filter-btn <?= $currentGenreId == $genre->id ? 'active' : '' ?>">
		<?= Html::encode($genre->name) ?>
	</a>
	<?php endforeach; ?>
</div>

<?php echo ListView::widget([
	'dataProvider' =>
$dataProvider, 'itemView' => '_vote_item', 'summary' => '', 'options' => [ 'class' => 'movie-grid' ], 'itemOptions' => [ 'class' => 'movie-card' ],
'layout' => '{items}' ]) ?>

<section class="bottom-section">
	<div class="panel">
		<h2 class="panel-title">
			<svg
				width="24"
				height="24"
				viewBox="0 0 24 24"
				fill="none"
				stroke="currentColor"
				stroke-width="2"
				stroke-linecap="round"
				stroke-linejoin="round">
				<path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
				<path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
				<path d="M4 22h16"></path>
				<path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
				<path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
				<path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
			</svg>
			Лидеры голосования
		</h2>
		<div class="leaders-list">
			<?php foreach ($topMovies as $index =>
			$movie): ?>
			<div class="leader-item">
				<div class="rank"><?= $index + 1 ?></div>
				<?= Html::img('@web/img/vote/' . $movie['miniImgPath'] . '.jpg', ['alt' =>
				$movie['title'], 'class' => 'leader-thumb']) ?>
				<div class="leader-info">
					<div class="leader-header">
						<div class="leader-title"><?= $movie['title'] ?></div>
						<div class="leader-year">(<?= $movie['year'] ?>)</div>
					</div>
					<div class="leader-progress">
						<div class="progress-track"><div class="progress-fill" style="width: 45%"></div></div>
						<div class="leader-percent">
							<?= $percent = $totalVotes >
							0 ? round(($movie['voteCount'] / $totalVotes) * 100) : 0; ?>%
						</div>
					</div>
					<div class="leader-votes">
						(<?= $movie['voteCount'] ?>
						голосов)
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="panel rules-panel">
		<h2 class="panel-title">
			<svg
				width="24"
				height="24"
				viewBox="0 0 24 24"
				fill="none"
				stroke="currentColor"
				stroke-width="2"
				stroke-linecap="round"
				stroke-linejoin="round">
				<circle cx="12" cy="12" r="10"></circle>
				<line x1="12" y1="8" x2="12" y2="12"></line>
				<line x1="12" y1="16" x2="12.01" y2="16"></line>
			</svg>
			Правила:
		</h2>
		<div class="rules-content">
			Один голос на пользователя.<br />
			Победитель будет объявлен<br />
			в 18:00.
		</div>
	</div>
</section>
