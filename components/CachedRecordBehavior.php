<?php


namespace app\components;


use app\models\Activity;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class CachedRecordBehavior extends Behavior
{
	public $prefix;

	public function events()
	{
		return [
			ActiveRecord::EVENT_AFTER_UPDATE => 'clearCache',
		];
	}

	public function buildKey()
	{
		return "{$this->prefix}_{$this->owner->id}";
	}

	public function clearCache()
	{
		Yii::$app->cache->delete($this->buildKey());
	}
	
	public function findOne($condition)
	{
		$cacheKey = $this->buildKey();
		$owner = $this->owner;

		if (Yii::$app->cache->exists($cacheKey)){
			return Yii::$app->cache->get($cacheKey);
		} else {
			Yii::$app->cache->set($cacheKey, $owner);

			return $owner;
		}
	}
}