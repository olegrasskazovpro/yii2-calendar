<?php
/**
 * @var View $this
 * @var $provider ActiveDataProvider
 */

use app\models\Activity;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\VarDumper;
use yii\web\View;

?>
	<h1>Список задач</h1>
	<hr>
<?= Html::a('Создать задачу', ['/activity/update?id='], ['class' => 'btn btn-primary']) ?>
	<hr>

<?= GridView::widget([
	'dataProvider' => $provider,
	'columns' => [
		['class' => SerialColumn::class,
			'header' => '#'
		],
		'id',
		'title',
		'start',
		'username',
		'repeatPeriod',
		'end_repeat',
		'block_other:boolean',
		[
				'class' => ActionColumn::class,
		],
	],
]) ?>