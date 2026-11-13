<?php
use yii\helpers\Html;

$formattedDate = Yii::$app->formatter->asDate($model['viewingDate'], 'php:d M Y');
?>

<?= Html::img('@web/img/home/' . $model['imgPath'] . '.jpg', ['alt' => $model['title'], 'class' => 'movie-poster']) ?>

<div class="movie-title"><?= Html::encode($model['title']) ?></div>
<div class="movie-date"><?= $formattedDate ?></div>