<?php
namespace app\models;

use app\components\MetaModel;

/**
 * Class ProductMeta
 *
 * @property int id
 * @property int sort
 * @property int|null parent_id
 * @property string|null youtube_playlist_id
 *
 * @property ProductI18n i18n
 * @property ProductI18n i18n_any
 * @property ProductMeta parent
 * @property Image frontimage
 * @property Image[] images
 */
class ProductMeta extends MetaModel
{
	public function init()
	{
		parent::init();
		$this->on(self::EVENT_BEFORE_DELETE, [$this, 'handleBeforeDelete']);
	}

	public function rules()
	{
		return [
			['sort', 'integer'],
			['parent_id', 'validateParent'],
			['youtube_playlist_id', 'string'],
		];
	}

	public function validateParent()
	{
		if ($this->parent_id === null) return true;
		return $this->getParent() !== null;
	}

	public function attributeLabels()
	{
		return [
			'youtube_playlist_id' => 'YouTube Playlist ID',
		];
	}

	public function attributeHints()
	{
		return [
			'youtube_playlist_id' => 'Die URL einer Playlist sieht in etwa so aus:
				<pre>https://www.youtube.com/playlist?list=PLqDM5nubkCia5fmO-D913NrmFNxKPNpBZ</pre>,
				die ID ist der letzte Teil nach dem Istgleich: <pre>PLqDM5nubkCia5fmO-D913NrmFNxKPNpBZ</pre>.',
		];
	}

	public function getImages()
	{
		return $this->hasMany(Image::className(), ['fid' => 'id'])
			->where('fmodel=:model', [':model' => $this::className()])->orderby('sort');
	}

	public function getFrontimage()
	{
		$image = $this->getImages()->limit(1)->one();
		if (!$image) {
			foreach ($this->children as $child) {
				/** @var $child ProductMeta */
				$image = $child->getFrontimage();
				if ($image) break;
			}
		}
		return $image;
	}

	public function getParent()
	{
		return $this->hasOne(ProductMeta::className(), ['id' => 'parent_id']);
	}

	public function getChildren()
	{
		return $this->hasMany(ProductMeta::className(), ['parent_id' => 'id'])->orderby('sort');
	}

	public function getTags()
	{
		return $this->hasMany(TagMeta::className(), ['id' => 'tag_id'])
			->viaTable('{{%product_tag}}', ['product_id' => 'id'])->joinWith('i18n')->orderby('name');
	}

	public function handleBeforeDelete($event)
	{
		foreach ($this->i18ns as $i18n) {
			/* @var $i18n ProductI18n */
			$i18n->delete();
		}

		foreach ($this->children as $child) {
			/* @var $child ProductMeta */
			$child->delete();
		}

		foreach ($this->images as $img) {
			/* @var $img Image */
			$img->delete();
		}
	}

	protected function getI18nClassname()
	{
		return ProductI18n::className();
	}
}