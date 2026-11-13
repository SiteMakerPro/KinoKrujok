<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Movie */

$this->title = 'Изменить данные фильма: ' . $model->title;
$this->registerCssFile('@web/css/admin.css');
?>

<div class="admin-layout">
    <div class="content">
        <div class="table-section" style="padding: 30px; max-width: 800px; margin: 0 auto;">
            
            <h1 style="margin-bottom: 25px; font-size: 28px; color: var(--text-main);">
                <?= Html::encode($this->title) ?>
            </h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
            
        </div>
    </div>
</div>