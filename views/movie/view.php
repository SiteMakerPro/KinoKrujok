<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Movie */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Movies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="admin-layout">
    <div class="content">
        <div class="table-section" style="padding: 30px; max-width: 900px; margin: 0 auto;">
            
            <h1 style="margin-bottom: 20px; font-size: 32px;">Фильм: <?= Html::encode($this->title) ?></h1>

            <!-- Кнопки управления -->
            <div style="display: flex; gap: 10px; margin-bottom: 25px;">
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn', 'style' => 'background-color: var(--admin-primary-blue);']) ?>
                
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn',
                    'style' => 'background-color: var(--admin-danger-color);',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить этот фильм?',
                        'method' => 'post',
                    ],
                ]) ?>

                <?= Html::a('Назад в админку', ['site/admin-panel'], ['class' => 'btn', 'style' => 'background-color: #ccc; color: #333;']) ?>
            </div>

            <!-- Таблица с данными (в стиле твоей админки) -->
            <div class="table-wrapper">
                <table class="data-table">
                    <tbody>
                        <tr class="data-table__row">
                            <th class="data-table__th" style="width: 30%;">ID</th>
                            <td class="data-table__td data-table__td_bold"><?= $model->id ?></td>
                        </tr>
                        <tr class="data-table__row">
                            <th class="data-table__th">Название</th>
                            <td class="data-table__td data-table__td_bold"><?= Html::encode($model->title) ?></td>
                        </tr>
                        <tr class="data-table__row">
                            <th class="data-table__th">Год</th>
                            <td class="data-table__td"><?= Html::encode($model->year) ?></td>
                        </tr>
                        <tr class="data-table__row">
                            <th class="data-table__th">Рейтинг</th>
                            <td class="data-table__td">
                                <span class="status status_success">★ <?= Html::encode($model->rating) ?></span>
                            </td>
                        </tr>
                        <tr class="data-table__row">
                            <th class="data-table__th">Путь к картинке</th>
                            <td class="data-table__td"><?= Html::encode($model->imgPath) ?>.jpg</td>
                        </tr>
                        <tr class="data-table__row">
                            <th class="data-table__th">Путь к мини-картинке</th>
                            <td class="data-table__td"><?= Html::encode($model->miniImgPath) ?>.jpg</td>
                        </tr>
                        <tr class="data-table__row">
                            <th class="data-table__th">Кол-во голосов на данный момент</th>
                            <td class="data-table__td data-table__td_bold"><?= Html::encode($model->votesCountNumber) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>