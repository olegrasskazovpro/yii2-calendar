<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attachments`.
 */
class m190917_174149_create_attachments_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('attachments', [
			'id' => $this->primaryKey(),
			'activity' => $this->integer()->notNull(),
			'filename' => $this->string()->notNull(),
		]);

		$this->createIndex('idx_attachments_id', 'attachments', 'id');
		$this->addForeignKey('fk_attachments_activities-id', 'attachments', 'activity', 'activities', 'id');
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropForeignKey('fk_attachments_activities-id', 'attachments');
		$this->dropIndex('idx_attachments_id', 'attachments');
		$this->dropTable('attachments');
	}
}
