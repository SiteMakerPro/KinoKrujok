<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;

$this->title = 'Избранное';
?>

<div class="site-index" style="margin-top: 40px;">
    <div class="section-title" style="margin-bottom: 30px;">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--accent);">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
        </svg>
        <h2 style="font-size: 28px; margin: 0;">Избранные фильмы</h2>
    </div>

    <?php if ($dataProvider->getTotalCount() === 0): ?>
        <p style="color: var(--text-muted); font-size: 16px;">Вы пока не добавили ни одного фильма в избранное.</p>
        <a href="<?= Url::to(['site/vote']) ?>" class="btn-primary" style="display: inline-block; margin-top: 20px;">Перейти к фильмам</a>
    <?php else: ?>
        <?php echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_vote_item', // Используем ту же карточку!
            'summary' => '',
            'options' => ['class' => 'movie-grid'],
            'itemOptions' => ['class' => 'movie-card'],
            'layout' => '{items}',
        ]) ?>
    <?php endif; ?>
</div>