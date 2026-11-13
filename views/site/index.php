<?php


use yii\helpers\Html;
use yii\widgets\ListView;

?>
<section class="hero">
	<div class="hero-bg"></div>
	<div class="hero-content">
		<h1>Твой вечер —<br /><span>твой фильм.</span></h1>
		<p>Собирай друзей, выбирай кино вместе и отслеживай историю просмотров.</p>
		<a href="#" class="btn-primary">
			Перейти к голосованию
			<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
				<path d="M8 5v14l11-7z" />
			</svg>
		</a>
	</div>
</section>

<section class="voting">
	<h2 class="section-title">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
			<circle cx="12" cy="12" r="10"></circle>
			<polyline points="12 6 12 12 16 14"></polyline>
		</svg>
		Сейчас выбираем фильм на пятницу
	</h2>
	<div class="voting-card">
		<div class="voting-movie">
			<?= Html::img('@web/img/home/' . $topMovie['imgPath'] . '.jpg', [
            'alt' => $topMovie['title'], 
            'class' => 'voting-poster', 
            'width' => 268 
            ]) ?>

			<div class="voting-info">
				<h3><?= Html::encode($topMovie['title']) ?></h3>

				<div class="tags">
					<?php foreach ($topMovie['genres'] as $genre): ?>
					<span class="tag"><?= Html::encode($genre['name']) ?></span>
					<?php endforeach; ?>
				</div>

				<div class="timer-label">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<circle cx="12" cy="12" r="10"></circle>
						<polyline points="12 6 12 12 16 14"></polyline>
					</svg>
					До конца голосования
				</div>

				<div class="timer">
					<span id="timer-hours">00</span> : 
					<span id="timer-minutes">00</span> : 
					<span id="timer-seconds">00</span>
				</div>
				<div class="timer-labels">
					<span>часов</span>
					<span>минут</span>
					<span>секунд</span>
				</div>

                <?php if (Yii::$app->user->isGuest): ?>
                    <a href="<?= \yii\helpers\Url::to(['site/auth']) ?>" class="btn-vote" style="display: inline-flex; justify-content: center; align-items: center; text-decoration: none;">
                        Войти, чтобы голосовать
                    </a>
                <?php elseif ($userVoteMovieId == $topMovie['id']): ?>
                    <button class="btn-vote" disabled style="background-color: #1e2c3a; color: #8b9ba8; cursor: not-allowed;">
                        Вы проголосовали
                    </button>
                <?php elseif ($userVoteMovieId): ?>
                    <a href="<?= \yii\helpers\Url::to(['site/vote']) ?>" class="btn-vote" style="display: inline-flex; justify-content: center; align-items: center; text-decoration: none;">
                        Изменить голос
                    </a>
                <?php else: ?>
                    <a href="<?= \yii\helpers\Url::to(['site/vote']) ?>" class="btn-vote" style="display: inline-flex; justify-content: center; align-items: center; text-decoration: none;">
                        Мой голос
                    </a>
                <?php endif; ?>
			</div>
		</div>

		<div class="voting-stats">
			<div class="stats-header">
				<div class="stats-label">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
						<circle cx="9" cy="7" r="4"></circle>
						<path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
						<path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
					</svg>
					Уже проголосовали
				</div>
				<div class="stats-value">
					<?= $totalVotes ?>
					из
					<?= $totalUsers ?>
				</div>
			</div>

			<div class="progress-bar">
				<div class="progress-fill" style="width: <?= $totalUsers > 0 ? round(($totalVotes / $totalUsers) * 100) : 0 ?>%;"></div>
			</div>

			<a href="<?= \yii\helpers\Url::to(['site/participants']) ?>" class="btn-outline" style="display: flex; align-items: center; justify-content: space-between; text-decoration: none; width: 100%; box-sizing: border-box;">
				Посмотреть всех участников
				<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
					<path d="M8 5v14l11-7z" />
				</svg>
			</a>
		</div>
	</div>
</section>

<section class="moods">
	<h2 class="section-title">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
			<rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
			<path d="M8 12h8"></path>
			<path d="M8 8h8"></path>
		</svg>
		Настроение вечера
	</h2>
	<?php echo ListView::widget([
	'dataProvider' =>
	$moodDataProvider, 'itemView' => '_mood_item', 'summary' => '', 'options' => [ 'class' => 'moods-grid' ], 'itemOptions' => [ 'class' => 'mood-card'
	], 'layout' => '{items}' ]) ?>
</section>

<section class="history">
	<div class="history-header">
		<h2 class="section-title" style="margin-bottom: 0">
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
				<polyline points="12 6 12 12 16 14"></polyline>
			</svg>
			Вы уже посмотрели
		</h2>
		<a href="#" class="history-link">Вся история</a>
	</div>

	<div class="history-carousel-container">
		<button class="carousel-btn prev">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" /></svg>
		</button>
		<?php echo ListView::widget([
        'dataProvider' =>
		$historyDataProvider, 'itemView' => '_history_home_item', 'summary' => '', 'options' => [ 'class' => 'history-grid' ], 'itemOptions' => [ 'class'
		=> 'movie-card' ], 'layout' => '{items}' ]) ?>
		<button class="carousel-btn next">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z" /></svg>
		</button>
	</div>

	<button class="btn-outline mobile-history-btn">
		Вся история
		<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
			<path d="M8 5v14l11-7z" />
		</svg>
	</button>
</section>
