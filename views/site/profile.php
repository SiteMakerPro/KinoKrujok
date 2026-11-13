<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


$this->title = 'Мой профиль'; ?>

<div class="site-index">
	<?php if (Yii::$app->session->hasFlash('success')): ?>
	<div
		style="
			background: rgba(16, 185, 129, 0.1);
			color: #10b981;
			padding: 15px;
			border-radius: var(--radius-sm);
			margin-bottom: 20px;
			border: 1px solid #10b981;
			text-align: center;
		">
		<?= Yii::$app->session->getFlash('success') ?>
	</div>
	<?php endif; ?>

	<section class="profile-hero">
		<div class="profile-user-info">
			<div class="profile-avatar-wrap">
				<img src="<?= Yii::getAlias('@web') ?>/img/user.jpg" alt="<?= Html::encode($user->name) ?>" class="profile-avatar" />
			</div>
			<div class="profile-details">
				<h1><?= Html::encode($user->name) ?></h1>
				<p class="profile-email"><?= Html::encode($user->email) ?></p>
				<p class="profile-join-date">
					<svg
						width="14"
						height="14"
						viewBox="0 0 24 24"
						fill="none"
						stroke="currentColor"
						stroke-width="2"
						stroke-linecap="round"
						stroke-linejoin="round">
						<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
						<line x1="16" y1="2" x2="16" y2="6"></line>
						<line x1="8" y1="2" x2="8" y2="6"></line>
						<line x1="3" y1="10" x2="21" y2="10"></line>
					</svg>
					Статус:
					<?= $user->role === 'admin' ? 'Администратор' : 'Кинолюбитель' ?>
				</p>
			</div>
		</div>

		<div class="profile-stats">
			<div class="stat-box">
				<span class="stat-value"><?= $totalMovies ?></span>
				<span class="stat-label">Фильмов</span>
			</div>
			<div class="stat-box">
				<span class="stat-value"><?= $avgRating ?></span>
				<span class="stat-label">Ср. рейтинг</span>
			</div>
			<div class="stat-box">
				<span class="stat-value"><?= $totalVotes ?></span>
				<span class="stat-label">Голосов</span>
			</div>
		</div>
	</section>

	<div class="profile-layout">
		<aside class="profile-sidebar">
			<div class="profile-card">
				<h2 class="card-title">
					<svg
						width="20"
						height="20"
						viewBox="0 0 24 24"
						fill="none"
						stroke="currentColor"
						stroke-width="2"
						stroke-linecap="round"
						stroke-linejoin="round">
						<circle cx="12" cy="12" r="3"></circle>
						<path
							d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
					</svg>
					Настройки
				</h2>

				<?php $form = ActiveForm::begin(['options' =>
				['class' => 'settings-form']]); ?>
				<div class="form-group"><?= $form->field($user, 'email')->textInput(['class' => 'form-input'])->label('Email') ?></div>
				<div class="form-group">
					<?= $form->field($user, 'password')->passwordInput(['value' => $user->password, 'class' => 'form-input'])->label('Пароль') ?>
				</div>
				<div class="form-group">
					<?= Html::submitButton('Сохранить', ['class' =>
					'btn-save']) ?>
				</div>
				<?php ActiveForm::end(); ?>
			</div>
			<!-- Добавь это в любое удобное место в profile.php, например, после настроек -->
<a href="<?= Url::to(['site/favorites']) ?>" class="btn-primary" style="display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%; margin-top: 20px; text-decoration: none;">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
    </svg>
    Мои избранные фильмы
</a>
		</aside>

		<main class="profile-main">
			<div class="profile-card">
				<div class="card-header-flex">
					<h2 class="card-title">
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
						Недавняя активность
					</h2>
					<a href="<?= Url::to(['site/history']) ?>" class="link-accent">Вся история</a>
				</div>

				<div class="activity-list">
					<?php if (empty($recentActivity)): ?>
					<p style="color: var(--text-muted)">Вы еще не смотрели фильмы.</p>
					<?php else: ?>
					<?php foreach ($recentActivity as $movie): ?>
					<div class="activity-item">
						<img
							src="<?= Yii::getAlias('@web') ?>/img/vote/<?= Html::encode($movie['imgPath']) ?>.jpg"
							alt="<?= Html::encode($movie['title']) ?>"
							class="activity-poster" />
						<div class="activity-info">
							<div class="activity-title"><?= Html::encode($movie['title']) ?></div>
							<div class="activity-meta"><?= Yii::$app->formatter->asDate($movie['viewingDate'], 'php:d M Y') ?></div>
						</div>
						<div class="activity-rating">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
								<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
							</svg>
							<?= Html::encode($movie['rating']) ?>
						</div>
					</div>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>

			<!-- Favorite Genres -->
			<div class="profile-card" style="margin-top: 20px">
				<h2 class="card-title">
					<svg
						width="20"
						height="20"
						viewBox="0 0 24 24"
						fill="none"
						stroke="currentColor"
						stroke-width="2"
						stroke-linecap="round"
						stroke-linejoin="round">
						<path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
						<line x1="7" y1="7" x2="7.01" y2="7"></line>
					</svg>
					Любимые жанры
				</h2>
				<div class="genres-list">
					<?php if (empty($favoriteGenres)): ?>
					<p style="color: var(--text-muted)">Добавьте больше фильмов в историю, чтобы мы определили ваши жанры.</p>
					<?php else: ?>
					<?php foreach ($favoriteGenres as $genre): ?>
					<div class="genre-bar">
						<span class="genre-name"><?= Html::encode($genre['name']) ?></span>
						<div class="genre-progress"><div class="genre-fill" style="width: <?= $genre[ 'percent'] ?>%"></div></div>
						<span class="genre-percent"><?= $genre['percent'] ?>%</span>
					</div>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</main>
	</div>
</div>
