<?php
/**
 * @var View $this
 * @var UserMessage $model
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use app\models\UserMessage;
use yii\web\View;
?>

<h1>Новое сообщение</h1>

<?php $form = ActiveForm::begin([
	'action' => '/message/submit',
]) ?>

<h3>Заполните форму</h3>
<?= $form->field($model, 'email')->textInput()->hint('Подсказка') ?>
<?= $form->field($model, 'title')->textInput() ?>
<?= $form->field($model, 'content')->textarea() ?>

<?= Html::submitButton('Отправить', ['class' => 'btn btn-success'])?>

<?php ActiveForm::end() ?>
