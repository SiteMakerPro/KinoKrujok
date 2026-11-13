<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Админ-панель'; $this->registerCssFile('@web/css/admin.css'); ?>

<div class="admin-layout">
	<div class="content">
		<div class="stats">
			<div class="stats__card">
				<div class="stats__header">
					<span class="stats__title">Всего фильмов</span>
				</div>
				<div class="stats__value"><?= $totalMovies ?></div>
				<div class="stats__desc stats__desc_up">В базе данных</div>
			</div>

			<div class="stats__card">
				<div class="stats__header">
					<span class="stats__title">Всего голосов</span>
				</div>
				<div class="stats__value"><?= $totalVotes ?></div>
				<div class="stats__desc stats__desc_up">Отдано пользователями</div>
			</div>
		</div>

		<div class="table-section">
			<div class="table-section__header">
				<h2 class="table-section__title">Управление фильмами</h2>
				<a href="<?= Url::to(['/movie/create']) ?>" class="btn">Добавить фильм</a>
			</div>

			<div class="table-wrapper">
				<table class="data-table">
					<thead class="data-table__head">
						<tr>
							<th class="data-table__th">ID</th>
							<th class="data-table__th">Постер</th>
							<th class="data-table__th">Название</th>
							<th class="data-table__th">Год</th>
							<th class="data-table__th">Рейтинг</th>
							<th class="data-table__th">Действия</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($movies as $movie): ?>
						<tr class="data-table__row">
							<td class="data-table__td data-table__td_bold"><?= $movie->id ?></td>
							<td class="data-table__td">
								<img
									src="<?= Yii::getAlias('@web') ?>/img/vote/<?= Html::encode($movie->imgPath) ?>.jpg"
									alt=""
									style="width: 40px; height: 60px; object-fit: cover; border-radius: 4px" />
							</td>
							<td class="data-table__td data-table__td_bold"><?= Html::encode($movie->title) ?></td>
							<td class="data-table__td"><?= Html::encode($movie->year) ?></td>
							<td class="data-table__td">
								<span class="status status_success"
									>★
									<?= Html::encode($movie->rating) ?></span
								>
							</td>
							<td class="data-table__td">
								<a
									href="<?= Url::to(['/movie/update', 'id' => $movie->id]) ?>"
									class="btn btn_small"
									style="background-color: var(--admin-warning-color)"
									>Ред.</a
								>

								<form action="<?= Url::to(['/movie/delete', 'id' => $movie->id]) ?>" method="post" style="display: inline-block; margin: 0">
									<input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>" />
									<button
										type="submit"
										class="btn btn_small"
										style="background-color: var(--admin-danger-color); border: none; cursor: pointer"
										onclick="return confirm('Вы уверены, что хотите удалить этот фильм?');">
										Удалить
									</button>
								</form>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
