<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;




?>

<div class="movie-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'rating')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imgPath')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'miniImgPath')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'votesCountNumber')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
