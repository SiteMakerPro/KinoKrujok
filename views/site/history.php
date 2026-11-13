<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
?>

<!-- Форма со всеми фильтрами и сортировкой -->
<form method="get" action="<?= Url::to(['site/history']) ?>" class="history-filters" style="display: flex; gap: 15px; margin-bottom: 20px; align-items: center; justify-content: flex-end;">
    
    <!-- 1. Сортировка -->
    <select name="sort" class="custom-select" onchange="this.form.submit()">
        <option value="newest" <?= $currentSort === 'newest' ? 'selected' : '' ?>>Сначала новые</option>
        <option value="oldest" <?= $currentSort === 'oldest' ? 'selected' : '' ?>>Сначала старые</option>
        <option value="rating" <?= $currentSort === 'rating' ? 'selected' : '' ?>>По рейтингу</option>
    </select>

    <!-- 2. Фильтр по жанру -->
    <select name="genre_id" class="custom-select" onchange="this.form.submit()">
        <option value="">Все жанры</option>
        <?php foreach ($genres as $genre): ?>
            <option value="<?= $genre->id ?>" <?= $currentGenreId == $genre->id ? 'selected' : '' ?>>
                <?= Html::encode($genre->name) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- 3. Фильтр по статусу -->
    <select name="status" class="custom-select" onchange="this.form.submit()">
        <option value="">Все оценки</option>
        <option value="1" <?= $currentStatus === '1' ? 'selected' : '' ?>>Понравилось</option>
        <option value="0" <?= $currentStatus === '0' ? 'selected' : '' ?>>Не понравилось</option>
    </select>

    <!-- Кнопка сброса (показывается, если активен хотя бы один фильтр или сортировка не по умолчанию) -->
    <?php if ($currentGenreId || $currentStatus !== null || $currentSort !== 'newest'): ?>
        <a href="<?= Url::to(['site/history']) ?>" style="color: var(--text-muted); font-size: 14px; text-decoration: underline;">Сбросить</a>
    <?php endif; ?>
</form>

<!-- Твой ListView (или таблица) -->
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_history_item', // твой файл карточки
    'summary' => '',
    'layout' => "{items}\n<div class=\"pagination-wrapper\" style=\"display: flex; justify-content: center; margin-top: 30px;\">{pager}</div>", // <--- Добавили {pager}
    'pager' => [
        'options' => ['class' => 'pagination-list'], // Класс для UL
        'prevPageLabel' => 'Назад',
        'nextPageLabel' => 'Вперед',
        'firstPageLabel' => false,
        'lastPageLabel' => false,
        'activePageCssClass' => 'active-page',
        'disabledPageCssClass' => 'disabled-page',
    ],
]) ?>