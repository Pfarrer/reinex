<?php
namespace app\widgets;

use app\models\MetaImage;

use \Yii;
use yii\base\Widget;
use yii\helpers\Url;
use WideImage\WideImage;

class ImageWidget extends Widget {

	private static $ROOT_DIR = 'runtime/imgcache';

	public static function thumbnail(MetaImage $img) {
		return self::getImage($img, 120, 120, false);
	}

	public static function medium(MetaImage $img) {
		return self::getImage($img, 200, 200, false);
	}

	public static function full(MetaImage $img) {
		return self::getImage($img, 1024, 768, true);
	}

	private static function getImage(MetaImage $img, $x, $y, $overlay) {
		$dirpath = self::$ROOT_DIR.'/'.$x.'x'.$y;
		if (!is_dir($dirpath)) {
			mkdir($dirpath, 0777, true) || die('ImageWidget::thumbnail(): mkdir failed');
		}

		$filepath = $dirpath.'/'.$img->hash.'.'.$img->extension;
		if (!is_file($filepath)) {
			self::createImage($img, $filepath, $x, $y, $overlay);
		}

		return Url::base().'/'.$filepath;
	}
	
	private static function createImage(MetaImage $img, $targetpath, $x, $y, $overlay) {

		$image = WideImage::load($img->fullPath());
		$image = $image->resize($x, $y);

		if ($overlay) {
			$upperWatermark = WideImage::load('img/watermark/top-left.png');
			$image = $image->merge($upperWatermark, 'left', 'top', 100);

			$lowerWatermark = WideImage::load('img/watermark/bottom-right.png');
			$image = $image->merge($lowerWatermark, 'right', 'bottom', 100);
		}
		
		$image->saveToFile($targetpath, 95);
	
	}

	//public function run() {}
	
}

