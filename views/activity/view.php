<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\Activity $model
 */

header("Content-type: text/html; charset=utf-8");
?>

<h1>Activity View</h1>

<h2><?= $model->title?></h2>

<?php if(date("d.m.Y", $model->startDay) == date("d.m.Y", $model->endDay)): ?>
	<p>Событие на <?=date("d.m.Y", $model->startDay)?></p>
<?php else: ?>
	<p>Событие c <?=date("d.m.Y", $model->startDay)?> по <?=date("d.m.Y", $model->endDay)?></p>
<?php endif; ?>


<?php if (!is_null($model->repeat)): ?>
<p>Повторять: <?= $model->repeat ?></p>
<p>Закончить повторять: <?= ($model->endRepeat) ? date("d.m.Y", $model->endRepeat) : 'Вечно' ?></p>
<?php endif; ?>

<?php if (!$model->blockOther): ?>
<p>Не позволяет другие события в эти даты</p>
<?php endif; ?>

<h3><?=$model->getAttributeLabel('description') ?></h3>
<div><?=$model->description ?></div>
