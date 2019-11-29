<?php
/**
 * @var View $this
 * @var Activity $model
 */

/**
 * <h1><?= $model->title?></h1>
 * <p><b>Создал: </b><?= $model->user->username ?></p>
 *
 * <?php if($model->start == $model->end): ?>
 * <p>Событие на <?= $model->startDate ?></p>
 * <?php else: ?>
 * <p>Событие c <?= $model->startDate ?> по <?= $model->endDate ?></p>
 * <?php endif; ?>
 *
 *
 * <?php if ($model->repeat != 1): ?>
 * <p>Повторять: <?= $model->repeatPeriods->period ?></p>
 * <p>Закончить повторять: <?= ($model->end_repeat) ? $model->end_repeat : 'Никогда' ?></p>
 * <?php endif; ?>
 *
 * <?php if ($model->block_other): ?>
 * <p>Не позволяет другие события в эти даты</p>
 * <?php endif; ?>
 *
 * <h3>Activity description</h3>
 * <div><?=$model->description ?></div>
 * <hr>
 */

use app\models\Activity;
use yii\bootstrap\Html;
use yii\web\View;
use yii\widgets\DetailView;

?>

<?= Html::a('Назад в календарь', ['/calendar'], ['class' => 'btn btn-success']) ?>
<?= Html::a('Редактировать', ["/activity/update?id={$model->id}"], ['class' => 'btn btn-primary']) ?>

<hr>
<?= DetailView::widget([
	'model' => $model,
	'attributes' => [
		'id',
		'title',
		'start',
		'end',
		'created_at',
		'updated_at',
		'username',
		'description',
		'repeatPeriod',
		'end_repeat',
		'block_other:boolean',
	],
]); ?>
