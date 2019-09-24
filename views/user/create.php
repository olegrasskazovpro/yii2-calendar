<?php
/**
 * @var View $this
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

?>

<?= Html::a('Авторизоваться', ['/site/login'], ['class' => 'btn btn-success']) ?>

	<h1>Регистрация</h1>
<?php $form = ActiveForm::begin(['action' => '/user/save']) ?>
<?= $form->field($model, 'username')->textInput()->label('Логин') ?>
<?= $form->field($model, 'email')->textInput()->label('Email') ?>
<?= $form->field($model, 'password_hash')->passwordInput()->label('Придумайте пароль от 6 знаков') ?>
<?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>