<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
$this->registerJs("jQuery('#reveal-password').change(function(){jQuery('#userform-password').attr('type',this.checked?'text':'password');})");
?>

<div class="user-form">

	<?php $form = ActiveForm::begin(['action' => '/user/save']); ?>

	<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'password')->passwordInput() ?>
	<?= Html::checkbox('reveal-password', false, ['id' => 'reveal-password']) ?> <?= Html::label('Show password', 'reveal-password') ?>

	<div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
