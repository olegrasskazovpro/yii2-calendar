<?php
/**
 * @var View $this
 */

use yii\bootstrap\Html;
use yii\web\View;

$this->registerJs("jQuery('#reveal-password').change(function(){jQuery('#user-password_hash').attr('type',this.checked?'text':'password');})");
?>

<?= Html::a('Авторизоваться', ['/site/login'], ['class' => 'btn btn-primary']) ?>

	<h1>Регистрация</h1>
<?= $this->render('_form', [
	'model' => $model,
]) ?>