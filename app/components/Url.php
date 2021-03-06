<?php namespace app\components;

use app\models\ProductMeta;
use app\models\TagMeta;
use yii\helpers\BaseUrl;

class Url extends BaseUrl
{
	public static function switchLanguageUrl($lang)
	{
		$current = self::to();
		if (strpos($current, '?') === FALSE) {
			$seperator = '?';
		}
		else {
			$seperator = '&';
		}

		return $current.$seperator.'lang='.$lang;
	}

	public static function toProduct(ProductMeta $meta)
	{
		// Show parent if there is any
		if ($meta->parent) {
			return static::toProduct($meta->parent);
		}

		if ($meta->i18n && $meta->i18n->shortcut_active) return Url::to(['/'.$meta->i18n->shortcut_active]);
		else return Url::to(['/product/view', 'id'=>$meta->id]);
	}

	public static function toTag(TagMeta $meta)
	{
		if ($meta->i18n && $meta->i18n->shortcut_active) return Url::to(['/'.$meta->i18n->shortcut_active]);
		else return Url::to(['tag/view', 'id'=>$meta->id]);
	}
}