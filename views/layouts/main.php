<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
$this->title = 'КиноКружок'; ?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->
		head() ?>
	</head>
	<body>
		<div class="container">
			<header class="header">
				<div class="header-top-mobile">
					<div class="header-left">
						<a href="#" class="logo">
							<?= Html::img('@web/img/logo.svg', ['height' =>
							32, 'alt' => 'Логотип']) ?>
						</a>
					</div>
					<div class="header-right">
						<button class="icon-btn" aria-label="Уведомления">
							<svg
								width="24"
								height="24"
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="2"
								stroke-linecap="round"
								stroke-linejoin="round">
								<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
								<path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
							</svg>
						</button>

						<?php if (Yii::$app->user->isGuest): ?>
						<a href="<?= Url::to(['site/auth']) ?>" class="btn-login">
							<svg
								width="18"
								height="18"
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="2"
								stroke-linecap="round"
								stroke-linejoin="round">
								<path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
								<polyline points="10 17 15 12 10 7"></polyline>
								<line x1="15" y1="12" x2="3" y2="12"></line>
							</svg>
							<span>Войти</span>
						</a>
						<?php else: ?>
						<div class="user-menu">
							<a href="<?= Url::to(['site/profile']) ?>" class="user-profile-link">
								<svg
									width="18"
									height="18"
									viewBox="0 0 24 24"
									fill="none"
									stroke="currentColor"
									stroke-width="2"
									stroke-linecap="round"
									stroke-linejoin="round">
									<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
									<circle cx="12" cy="7" r="4"></circle>
								</svg>
								<span><?= Html::encode(Yii::$app->user->identity->name) ?></span>
							</a>

							<form action="<?= Url::to(['site/logout']) ?>" method="post" style="display: inline-block; margin: 0">
								<input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>" />
								<button type="submit" class="btn-logout" style="background: none; border: none; cursor: pointer; padding: 0">Выйти</button>
							</form>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<nav class="nav">
					<a class="<?= Yii::$app->controller->route == 'site/index' ? 'active' : '' ?>" href="<?= Url::to(['/site/index']) ?>">Главная</a>
					<a class="<?= Yii::$app->controller->route == 'site/vote' ? 'active' : '' ?>" href="<?= Url::to(['/site/vote']) ?>">Голосование</a>
					<a class="<?= Yii::$app->controller->route == 'site/history' ? 'active' : '' ?>" href="<?= Url::to(['/site/history']) ?>">Просмотренные</a>

					<?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin'): ?>
					<a
						class="<?= Yii::$app->controller->route == 'site/admin-panel' ? 'active' : '' ?>"
						href="<?= Url::to(['/site/admin-panel']) ?>"
						style="color: #d4ff00; font-weight: bold">
						Админ-панель
					</a>
					<?php endif; ?>
				</nav>
			</header>
			<?= $content ?>
			<!-- Footer -->
			<footer class="footer">
				<div class="footer-left">
					<a href="#" class="logo">
						<?= Html::img('@web/img/logo.svg', ['height' =>
						32, 'alt' => 'Логотип']) ?>
					</a>
					<p class="footer-desc">Хорошие фильмы. В хорошей компании.</p>
				</div>

				<div class="footer-nav">
					<div class="footer-nav-col">
						<a href="#">Главная</a>
						<a href="#">Голосование</a>
						<a href="#">Просмотренные</a>
					</div>
					<div class="footer-nav-col">
						<a href="#">О проекте</a>
						<a href="#">Правила</a>
						<a href="#">Поддержка</a>
					</div>
				</div>

				<div class="footer-right">
					<div class="socials">
						<a href="#" class="social-icon" aria-label="VK">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
								<path
									d="M12.785 16.241s.288-.032.436-.193c.136-.148.132-.427.132-.427s-.02-1.304.576-1.496c.586-.19 1.339 1.258 2.136 1.814.603.42 1.061.328 1.061.328l2.133-.03s1.116-.07.587-.96c-.044-.073-.31-.664-1.597-1.88-1.347-1.27-1.166-1.064.456-3.26.988-1.333 1.383-2.147 1.26-2.495-.118-.331-.854-.243-.854-.243l-2.4.015s-.178-.025-.31.055c-.129.078-.212.262-.212.262s-.38 1.026-.887 1.898c-1.07 1.847-1.498 1.945-1.673 1.83-.407-.267-.305-1.075-.305-1.65 0-1.796.267-2.545-.52-2.738-.26-.063-.452-.105-1.118-.112-.853-.009-1.575.003-1.984.206-.272.135-.483.437-.355.454.159.022.518.098.71.36.247.337.238 1.096.238 1.096s.143 2.115-.333 2.378c-.326.18-.773-.188-1.73-1.865-.492-.86-.863-1.81-.863-1.81s-.072-.178-.2-.273c-.156-.115-.374-.15-.374-.15l-2.281.015s-.342.01-.468.16c-.112.134-.009.412-.009.412s1.787 4.253 3.81 6.398c1.855 1.967 3.962 1.838 3.962 1.838h.955z" />
							</svg>
						</a>
						<a href="#" class="social-icon" aria-label="Telegram">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
								<path
									d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69.01-.03.01-.14-.07-.2-.08-.06-.19-.04-.27-.02-.11.02-1.93 1.23-5.46 3.62-.51.35-.98.52-1.4.51-.46-.01-1.35-.26-2.01-.48-.81-.27-1.46-.42-1.4-.88.03-.24.36-.49.99-.74 3.87-1.69 6.45-2.8 7.73-3.34 3.67-1.54 4.43-1.81 4.93-1.82.11 0 .35.03.51.15.13.11.16.26.18.38 0 .06.01.25.01.26z" />
							</svg>
						</a>
						<a href="#" class="social-icon" aria-label="OK">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
								<path
									d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 3.5a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7zm-1.5 8.5h3a1.5 1.5 0 0 1 1.5 1.5v.5h1.5a1 1 0 0 1 0 2H15v1.5a1 1 0 0 1-2 0V16H8.5a1 1 0 0 1 0-2H10v-.5a1.5 1.5 0 0 1 1.5-1.5z" />
							</svg>
						</a>
					</div>
					<div class="copyright">© 2025 КиноКружок. Все права защищены.</div>
				</div>
			</footer>
		</div>
		<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage(); ?>
