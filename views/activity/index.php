<?php
/**
 * @var View $this
 * @var Activity $model
 * @var Activity[] $activities
 */

use app\models\Activity;
use yii\bootstrap\Html;
use yii\helpers\VarDumper;
use yii\web\View;
?>
<h1>Список задач</h1>
<hr>
<?= Html::a('Создать задачу', ['/activity/edit'], ['class' => 'btn btn-primary']) ?>
<hr>

<div style="display: flex">
<?php foreach ($activities as $item) { ?>
	<div style="padding: 10px">
		<h2><a href="/activity/view?id=<?= $item->id ?>"><?= $item->title ?></a></h2>
		<p><b>Создал:</b> <?= $item->user->username ?></p>
		<p><b>Начало:</b> <?= $item->startDate ?></p>
		<p><b>Конец:</b> <?= $item->endDate ?></p>
		<p><b>1 день?</b> <?= $result = ($item->start < $item->end) ? 'Да' : 'Нет' ?></p>
	</div>
<?php } ?>
</div>
