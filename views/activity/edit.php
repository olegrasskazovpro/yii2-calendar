<?php
/**
 * @var View $this
 * @var Activity $model
 */

use app\models\Activity;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

?>

<?= Html::a('Назад в календарь', ['/activity/index'], ['class' => 'btn btn-success']) ?>

	<h1>Редактирование задачи</h1>
	<p>Task ID: <?= $model->id ?></p>
	<p>User ID: <?= $model->userID ?></p>
	<p>BlockOther: <?= $model->blockOther ?></p>
<?php $form = ActiveForm::begin(['action' => '/activity/save']) ?>
<?= Html::activeHiddenInput($model, 'id') ?>
<?= Html::activeHiddenInput($model, 'userID') ?>
<?= $form->field($model, 'title')->textInput(['value' => $model->title]) ?>
<?= $form->field($model, 'description')->textarea(['value' => $model->description]) ?>
<?= $form->field($model, 'startDay')->textInput(['value' => $model->startDay, 'type' => 'date']) ?>
<?= $form->field($model, 'endDay')->textInput(['value' => $model->endDay, 'type' => 'date']) ?>
<?= $form->field($model, 'repeat')->dropDownList(
	[
		1 => 'Never',
		2 => 'Daily',
		3 => 'Monthly',
		4 => 'Yearly'
	],
	['value' => $model->repeat])
?>
<?= $form->field($model, 'endRepeat')->textInput(['value' => $model->endRepeat, 'type' => 'date']) ?>
<?= $form->field($model, 'blockOther')->checkbox(['value' => $model->blockOther]) ?>
<?= $form->field($model, 'attachments[]')->fileInput(['multiple' => true]) ?>

<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>