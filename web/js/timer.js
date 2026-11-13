document.addEventListener('DOMContentLoaded', function () {
	const elHours = document.getElementById('timer-hours');
	const elMinutes = document.getElementById('timer-minutes');
	const elSeconds = document.getElementById('timer-seconds');

	if (!elHours || !elMinutes || !elSeconds) return;

	function updateTimer() {
		const now = new Date();

		let target = new Date();
		target.setHours(18, 0, 0, 0);

		if (now > target) {
			target.setDate(target.getDate() + 1);
		}

		const diff = target - now;

		const hours = Math.floor(diff / (1000 * 60 * 60));
		const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
		const seconds = Math.floor((diff % (1000 * 60)) / 1000);

		const formatNumber = (num) => (num < 10 ? '0' + num : num);

		elHours.textContent = formatNumber(hours);
		elMinutes.textContent = formatNumber(minutes);
		elSeconds.textContent = formatNumber(seconds);
	}

	updateTimer();

	setInterval(updateTimer, 1000);
});
