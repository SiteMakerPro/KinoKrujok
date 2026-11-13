<?php

use yii\helpers\Html;
?>
<div class="rank"><?= Html::encode($model['id']) ?></div>
<?= Html::img('@web/img/vote/intersteilar_mini.jpg', ['alt' =>
'Интерстеллар', 'class' => 'leader-thumb']) ?>
<div class="leader-info">
	<div class="leader-header">
		<div class="leader-title">Интерстеллар</div>
		<div class="leader-year">(2014)</div>
	</div>
	<div class="leader-progress">
		<div class="progress-track"><div class="progress-fill" style="width: 45%"></div></div>
		<div class="leader-percent">45%</div>
	</div>
	<div class="leader-votes">(15 голосов)</div>
</div>
