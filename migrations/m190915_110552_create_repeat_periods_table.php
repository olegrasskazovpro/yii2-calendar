<?php

use yii\db\Migration;

/**
 * Handles the creation of table `repeat_periods`.
 */
class m190915_110552_create_repeat_periods_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('repeat_periods', [
			'id' => $this->primaryKey(),
			'name' => $this->string(),
		]);

		$this->createIndex(
			'idx-repeat_periods-id',
			'repeat_periods',
			'id'
		);

		$this->batchInsert(
			'repeat_periods',
			['name'],
			[
				['Never'],
				['Daily'],
				['Weekly'],
				['Monthly'],
				['Yearly'],
			]
		);

		$this->addForeignKey(
			'fk-repeat_periods-activities',
			'activities',
			'repeat',
			'repeat_periods',
			'id'
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropForeignKey(
			'fk-repeat_periods-activities',
			'activities'
		);

		$this->dropIndex(
			'idx-repeat_periods-id',
			'repeat_periods'
		);

		$this->dropTable('repeat_periods');
	}
}
