<?php
namespace app\models;

use yii\db\ActiveRecord;

class Image extends ActiveRecord
{
	public function init()
	{
		parent::init();
		$this->on(self::EVENT_BEFORE_DELETE, [$this, 'handleBeforeDelete']);
	}

	public function rules()
	{
		return [
			[['fid', 'fmodel', 'hash', 'extension'], 'required'],
		];
	}


	public function fullPath()
	{
		return "uploads/images/$this->hash.$this->extension";
	}

	public function handleBeforeDelete()
	{
		// Falls das Image nur einmal benutzt wird -> Bild löschen
		if (Image::find()->where(['hash' => $this->hash])->count() == 1) {
			// Bild wird nirgends wo sonst benutzt
			unlink($this->fullPath());
		}
	}
}