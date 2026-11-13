<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;




?>

<div class="movie-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'rating') ?>

    <?= $form->field($model, 'imgPath') ?>

    <?php // echo $form->field($model, 'miniImgPath') ?>

    <?php // echo $form->field($model, 'votesCountNumber') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
