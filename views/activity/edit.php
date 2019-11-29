<?php
/**
 * @var View $this
 * @var Activity $model
 */

use app\models\Activity;
use app\models\tables\RepeatPeriods;
use kartik\datetime\DateTimePicker;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

?>

<?= Html::a('Назад в календарь', ['/calendar'], ['class' => 'btn btn-success']) ?>

	<h1><?= ($model->isNewRecord) ? 'Создание задачи' : "Редактирование задачи '{$model->title}'" ?></h1>
	<p>Создатель: <?= $model->getUsername() ?> </p>
	<hr>

<?php $form = ActiveForm::begin(['action' => '/activity/save', 'method' => 'post']) ?>
<?= Html::activeHiddenInput($model, 'id', ['value' => $model->id]) ?>
<?php // Html::activeHiddenInput($model, 'user_id', ['value' => $model->getUserId()]) ?>
<?= $form->field($model, 'title')->textInput(['value' => $model->title]) ?>
<?= $form->field($model, 'description')->textarea(['value' => $model->description]) ?>
<?= $form->field($model, 'start')->widget(DateTimePicker::class, [
	'name' => 'start',
	'options' => ['placeholder' => 'Выберите дату начала события'],
	'convertFormat' => true,
	'value' => $model->startDatetime,
	'pluginOptions' => [
		'format' => Yii::$app->formatter->datetimeFormat,
		'todayHighlight' => true
	]
]); ?>
<?= $form->field($model, 'end')->widget(DateTimePicker::class, [
	'name' => 'end',
	'options' => ['placeholder' => 'Выберите дату конца события'],
	'convertFormat' => true,
	'value' => $model->endDate,
	'pluginOptions' => [
		'format' => Yii::$app->formatter->datetimeFormat,
		'todayHighlight' => true
	]
]); ?>
<?= $form->field($model, 'repeat')->dropDownList(RepeatPeriods::getPeriods(), ['value' => $model->repeat])
?>
<?= $form->field($model, 'end_repeat')->widget(DateTimePicker::class, [
	'name' => 'end_repeat',
	'options' => ['placeholder' => 'До какой даты повторять?'],
	'convertFormat' => true,
	'value' => $model->end_repeat,
	'pluginOptions' => [
		'format' => Yii::$app->formatter->datetimeFormat,
		'todayHighlight' => true
	]
]); ?>
<?= $form->field($model, 'block_other')->checkbox(['value' => $model->block_other]) ?>
<? //= $form->field($model, 'attachments[]')->fileInput(['multiple' => true]) ?>

<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>