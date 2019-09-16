<?php
/**
 * @var View $this
 * @var Activity $model
 * @var array $activities
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

<ul>
<?php
foreach ($activities as $item) { ?>
	<li><?= VarDumper::export($item) ?></li>
<?php } ?>
</ul>