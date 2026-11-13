<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Участники голосования';
?>

<div class="site-index" style="margin-top: 40px;">
    <div class="section-title" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--accent);">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <h2 style="font-size: 28px; margin: 0;">Участники</h2>
        </div>
        <a href="<?= Url::to(['site/index']) ?>" style="color: var(--text-muted); text-decoration: underline;">На главную</a>
    </div>

    <div class="profile-card" style="padding: 20px;">
        <div class="table-wrapper">
            <table class="data-table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--border-color); text-align: left; color: var(--text-muted);">
                        <th style="padding: 15px;">Пользователь</th>
                        <th style="padding: 15px;">Голос за фильм</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($votes as $vote): ?>
                        <tr style="border-bottom: 1px solid var(--border-color); transition: background 0.2s;">
                            <td style="padding: 15px; display: flex; align-items: center; gap: 10px;">
                                <!-- Аватарка-заглушка -->
                                <div style="width: 32px; height: 32px; background: var(--accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #000; font-weight: bold;">
                                    <?= mb_substr($vote->user->name, 0, 1) ?>
                                </div>
                                <span style="font-weight: 500;">
                                    <?= Html::encode($vote->user->name) ?>
                                    <?php if ($vote->user_id == Yii::$app->user->id): ?>
                                        <span style="color: var(--accent); font-size: 12px; margin-left: 5px;">(Вы)</span>
                                    <?php endif; ?>
                                </span>
                            </td>
                            <td style="padding: 15px;">
                                <a href="<?= Url::to(['site/vote']) ?>" style="color: var(--text-main); text-decoration: none; display: flex; align-items: center; gap: 10px;">
                                    <img src="<?= Yii::getAlias('@web') ?>/img/vote/<?= Html::encode($vote->movie->miniImgPath) ?>.jpg" style="width: 30px; height: 45px; object-fit: cover; border-radius: 4px;" alt="">
                                    <?= Html::encode($vote->movie->title) ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>