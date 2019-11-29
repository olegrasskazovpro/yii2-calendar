<?php
/**
 * @var View $this
 * @var User $model
 */

use app\models\User;
use yii\bootstrap\Html;
use yii\web\View;
use yii\widgets\DetailView;

?>

<?= Html::a('Редактировать', ["/user/update?id={$model->id}"], ['class' => 'btn btn-primary']) ?>

<hr>
<?= DetailView::widget([
	'model' => $model,
	'attributes' => [
		'id',
		'username',
		'email',
		'created_at',
		'updated_at',
	],
]); ?>
