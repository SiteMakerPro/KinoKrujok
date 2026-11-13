<?php
use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'Вход в систему'; ?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
<div
	style="
		background: rgba(16, 185, 129, 0.1);
		color: #10b981;
		padding: 15px;
		border-radius: 8px;
		margin: 20px auto;
		max-width: 400px;
		text-align: center;
		border: 1px solid #10b981;
		position: relative;
		z-index: 10;
	">
	<?= Yii::$app->session->getFlash('success') ?>
</div>
<?php endif; ?>

<div class="site-index">
	<div class="bg-glow"></div>

	<div class="container">
		<main class="auth-wrapper">
			<div class="auth-card">
				<div class="auth-tabs">
					<button class="tab-btn active" type="button" id="tab-login">Вход</button>
					<button class="tab-btn" type="button" id="tab-register">Регистрация</button>
				</div>

				<form class="auth-form" id="form-login" action="<?= Url::to(['site/auth']) ?>" method="post">
					<input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />

					<div class="form-header">
						<h1 id="auth-title">С возвращением!</h1>
						<p id="auth-subtitle">Войдите, чтобы продолжить выбирать фильмы.</p>
					</div>

					<div class="form-group">
						<label for="email">Email</label>
						<div class="input-wrap">
							<svg
								class="input-icon"
								width="18"
								height="18"
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="2"
								stroke-linecap="round"
								stroke-linejoin="round">
								<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
								<polyline points="22,6 12,13 2,6"></polyline>
							</svg>
							<input
								type="email"
								id="email"
								name="LoginForm[email]"
								value="<?= Html::encode($model->email) ?>"
								placeholder="your@email.com"
								required />
						</div>
						<div style="color: #ff4d4d; font-size: 13px; margin-top: 5px; padding-left: 10px"><?= Html::error($model, 'email') ?></div>
					</div>

					<div class="form-group">
						<label for="password">Пароль</label>
						<div class="input-wrap">
							<svg
								class="input-icon"
								width="18"
								height="18"
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="2"
								stroke-linecap="round"
								stroke-linejoin="round">
								<rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
								<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
							</svg>
							<input type="password" id="password" name="LoginForm[password]" placeholder="••••••••" required />
						</div>
						<div style="color: #ff4d4d; font-size: 13px; margin-top: 5px; padding-left: 10px"><?= Html::error($model, 'password') ?></div>
					</div>

					<div class="form-options">
						<label class="checkbox-label">
							<input type="checkbox" name="LoginForm[rememberMe]" value="1" checked />
							<span class="checkmark"></span>
							Запомнить меня
						</label>
						<a href="#" class="forgot-link">Забыли пароль?</a>
					</div>

					<button type="submit" class="btn-submit">Войти</button>
				</form>

				<form class="auth-form" id="form-register" action="<?= Url::to(['site/auth']) ?>" method="post" style="display: none">
					<input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />

					<div class="form-header">
						<h1>Создать аккаунт</h1>
						<p>Присоединяйтесь к КиноКружку.</p>
					</div>

					<div class="form-group">
						<label for="reg-name">Ваше имя</label>
						<div class="input-wrap">
							<svg
								class="input-icon"
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
							<input type="text" id="reg-name" name="SignupForm[name]" value="<?= Html::encode($signupModel->name) ?>" placeholder="Иван" required />
						</div>
						<div style="color: #ff4d4d; font-size: 13px; margin-top: 5px; padding-left: 10px"><?= Html::error($signupModel, 'name') ?></div>
					</div>

					<div class="form-group">
						<label for="reg-email">Email</label>
						<div class="input-wrap">
							<svg
								class="input-icon"
								width="18"
								height="18"
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="2"
								stroke-linecap="round"
								stroke-linejoin="round">
								<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
								<polyline points="22,6 12,13 2,6"></polyline>
							</svg>
							<input
								type="email"
								id="reg-email"
								name="SignupForm[email]"
								value="<?= Html::encode($signupModel->email) ?>"
								placeholder="your@email.com"
								required />
						</div>
						<div style="color: #ff4d4d; font-size: 13px; margin-top: 5px; padding-left: 10px"><?= Html::error($signupModel, 'email') ?></div>
					</div>

					<div class="form-group">
						<label for="reg-password">Пароль</label>
						<div class="input-wrap">
							<svg
								class="input-icon"
								width="18"
								height="18"
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="2"
								stroke-linecap="round"
								stroke-linejoin="round">
								<rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
								<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
							</svg>
							<input type="password" id="reg-password" name="SignupForm[password]" placeholder="••••••••" required />
						</div>
						<div style="color: #ff4d4d; font-size: 13px; margin-top: 5px; padding-left: 10px"><?= Html::error($signupModel, 'password') ?></div>
					</div>

					<button type="submit" class="btn-submit" style="margin-top: 10px">Зарегистрироваться</button>
				</form>

				<div class="auth-divider">
					<span>или войдите через</span>
				</div>

				<div class="social-auth">
					<button class="social-btn" aria-label="Войти через VK">...</button>
				</div>

				<div class="auth-bottom-text">
					<span id="bottom-text">Нет аккаунта?</span>
					<a href="#" id="bottom-link">Зарегистрироваться</a>
				</div>
			</div>
		</main>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
		const tabLogin = document.getElementById('tab-login');
		const tabRegister = document.getElementById('tab-register');
		const formLogin = document.getElementById('form-login');
		const formRegister = document.getElementById('form-register');
		const bottomText = document.getElementById('bottom-text');
		const bottomLink = document.getElementById('bottom-link');

		function showLogin() {
			tabLogin.classList.add('active');
			tabRegister.classList.remove('active');
			formLogin.style.display = 'block';
			formRegister.style.display = 'none';
			bottomText.innerText = 'Нет аккаунта?';
			bottomLink.innerText = 'Зарегистрироваться';
			bottomLink.onclick = function(e) { e.preventDefault(); showRegister(); };
		}

		function showRegister() {
			tabRegister.classList.add('active');
			tabLogin.classList.remove('active');
			formLogin.style.display = 'none';
			formRegister.style.display = 'block';
			bottomText.innerText = 'Уже есть аккаунт?';
			bottomLink.innerText = 'Войти';
			bottomLink.onclick = function(e) { e.preventDefault(); showLogin(); };
		}

		tabLogin.addEventListener('click', showLogin);
		tabRegister.addEventListener('click', showRegister);

		bottomLink.onclick = function(e) { e.preventDefault(); showRegister(); };

		<?php if ($signupModel->hasErrors()): ?>
			showRegister();
		<?php endif; ?>
});
</script>
