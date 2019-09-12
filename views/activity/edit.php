<?php
/**
 * @var View $this
 * @var Activity $model
 */

header("Content-type: text/html; charset=utf-8");

use app\models\Activity;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

?>

<?= Html::a('Назад в календарь', ['/'], ['class' => 'btn btn-success']) ?>

	<h1>Редактирование задачи</h1>
	<p>Task ID: <?= $model->id ?></p>
	<p>User ID: <?= $model->userID ?></p>
<?php $form = ActiveForm::begin(['action' => '/activity/save']) ?>
<?= Html::activeHiddenInput($model, 'id') ?>
<?= Html::activeHiddenInput($model, 'userID') ?>
<?= $form->field($model, 'title')->textInput(['value' => $model->title]) ?>
<?= $form->field($model, 'description')->textarea(['value' => $model->description]) ?>
<?= $form->field($model, 'startDay')->textInput(['value' => $model->startDay, 'format' => 'dd.mm.yyyy']) ?>
<?= $form->field($model, 'endDay')->textInput(['value' => $model->endDay]) ?>
<?= $form->field($model, 'repeat')->textInput(['value' => $model->repeat]) ?>
<?= $form->field($model, 'endRepeat')->textInput(['value' => $model->endRepeat]) ?>
<?= $form->field($model, 'blockOther')->textInput(['value' => $model->blockOther]) ?>

<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>