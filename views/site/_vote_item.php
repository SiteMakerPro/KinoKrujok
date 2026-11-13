<?php

use yii\helpers\Html;
use yii\helpers\Url;
$hasVoted = false;
if (!Yii::$app->user->isGuest) {
    $hasVoted = \app\models\Vote::find()
        ->where(['user_id' => Yii::$app->user->id, 'movie_id' => $model['id']])
        ->exists();
}
$isFavorite = false;
if (!Yii::$app->user->isGuest) {
    $isFavorite = \app\models\Favorite::find()
        ->where(['user_id' => Yii::$app->user->id, 'movie_id' => $model['id']])
        ->exists();
}
?>

<div class="movie-card-top">
    <div class="movie-poster-wrap">
        <?= Html::img('@web/img/vote/' . $model['imgPath'] . '.jpg', ['alt' => $model['title']]) ?>
        
        <!-- Форма для добавления/удаления из избранного (СЕРДЕЧКО) -->
        <form action="<?= Url::to(['site/toggle-favorite', 'id' => $model['id']]) ?>" method="post" style="position: absolute; top: 10px; right: 10px; z-index: 10; margin: 0; padding: 0;">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
            <button type="submit" class="fav-btn" aria-label="В избранное" style="background: transparent; border: none; cursor: pointer; padding: 5px; <?= $isFavorite ? 'color: var(--accent);' : 'color: #fff;' ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="<?= $isFavorite ? 'currentColor' : 'none' ?>" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </button>
        </form>
    </div>
    
    <div class="movie-info">
        <div class="movie-title"><?= Html::encode($model['title']) ?></div>
        <div class="movie-year">(<?= Html::encode($model['year']) ?>)</div>
        <div class="movie-genres">
            <?= Html::encode(implode(', ', array_column($model['genres'], 'name'))) ?>
        </div>
        <div class="movie-rating">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <?= Html::encode($model['rating']) ?>
            <span>(<?= Yii::$app->formatter->asInteger($model['votesCountNumber']) ?>)</span>
        </div>
    </div>
</div>

<!-- Блок с кнопкой голосования -->
<div class="movie-card-bottom">
    <?php if ($hasVoted): ?>
        <button class="btn-vote" disabled style="background-color: #1e2c3a; color: #8b9ba8; cursor: not-allowed; width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; border: none;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            Ваш голос учтен
        </button>
    <?php else: ?>
        <?php if (Yii::$app->user->isGuest): ?>
            <?= Html::a(
                '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg> Голосовать',
                ['site/auth'],
                ['class' => 'btn-vote', 'style' => 'width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px;']
            ) ?>
        <?php else: ?>
            <!-- Используем форму для безопасности -->
            <form action="<?= Url::to(['site/add-vote', 'id' => $model['id']]) ?>" method="post" style="width: 100%; margin: 0;">
                <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
                <button type="submit" class="btn-vote" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; border: none; cursor: pointer;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Голосовать
                </button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
</div>