document.addEventListener('DOMContentLoaded', () => {
	const tabs = document.querySelectorAll('.tab-btn');
	const formTitle = document.querySelector('.form-header h1');
	const formSubtitle = document.querySelector('.form-header p');
	const submitBtn = document.querySelector('.btn-submit');
	const bottomText = document.querySelector('.auth-bottom-text');

	// Состояния для каждой вкладки
	const content = {
		login: {
			title: 'С возвращением!',
			subtitle: 'Войдите, чтобы продолжить выбирать фильмы.',
			button: 'Войти',
			bottom: 'Нет аккаунта? <a href="#">Зарегистрироваться</a>',
		},
		register: {
			title: 'Создать аккаунт',
			subtitle: 'Присоединяйтесь к клубу любителей кино.',
			button: 'Зарегистрироваться',
			bottom: 'Уже есть аккаунт? <a href="#">Войти</a>',
		},
	};

	function switchTab(mode) {
		// Обновляем активный класс у кнопок
		tabs.forEach((btn) => btn.classList.remove('active'));
		document.querySelector(`.tab-btn[data-mode="${mode}"]`)?.classList.add('active') ||
			(mode === 'login' ? tabs[0].classList.add('active') : tabs[1].classList.add('active'));

		// Меняем тексты
		const c = content[mode];
		formTitle.textContent = c.title;
		formSubtitle.textContent = c.subtitle;
		submitBtn.textContent = c.button;
		bottomText.innerHTML = c.bottom;
	}

	// Вешаем обработчики на вкладки и на нижнюю ссылку
	tabs.forEach((tab, index) => {
		tab.addEventListener('click', () => {
			switchTab(index === 0 ? 'login' : 'register');
		});
	});

	// Делегирование клика для нижней ссылки (она динамически меняется)
	bottomText.addEventListener('click', (e) => {
		if (e.target.tagName === 'A') {
			e.preventDefault();
			const isLoginActive = tabs[0].classList.contains('active');
			switchTab(isLoginActive ? 'register' : 'login');
		}
	});
});
