<?php
/**
 * @var View $this
 * @var Activity $model
 */

header("Content-type: text/html; charset=utf-8");

use app\models\Activity;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

?>

<?= Html::a('Назад в календарь', ['/'], ['class' => 'btn btn-success'])?>

<hr>
<h1><?= $model->title?></h1>

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
<hr>


<?php $form = ActiveForm::begin(['action' => '/activity/edit', 'method' => 'post']) ?>
<?= Html::activeHiddenInput($model, 'id')?>
<?= Html::activeHiddenInput($model, 'userID')?>
<?= Html::activeHiddenInput($model, 'title')?>
<?= Html::activeHiddenInput($model, 'description')?>
<?= Html::activeHiddenInput($model, 'startDay')?>
<?= Html::activeHiddenInput($model, 'endDay')?>
<?= Html::activeHiddenInput($model, 'repeat')?>
<?= Html::activeHiddenInput($model, 'endRepeat')?>
<?= Html::activeHiddenInput($model, 'blockOther')?>
<?= Html::submitButton('Edit', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>
