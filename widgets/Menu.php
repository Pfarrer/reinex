<?php
namespace app\widgets;

use \yii\helpers\Url;

class Menu extends \yii\base\Widget {

	public $items;

	public static function frontpage() {
		return [
			['label'=>'Products', 'url'=>Url::home().'#products'],
			['label'=>'Company', 'url'=>Url::home().'#company'],
			['label'=>'Partners', 'url'=>Url::home().'#partners'],
			['label'=>'Contact', 'url'=>Url::home().'#contact'],
		];
	}
	
	public static function admin() {
		return [
			['label'=>'Dashboard', 'url'=>Url::to(['/admin'])],
			['label'=>'Products', 'url'=>Url::to(['/product'])],
			['label'=>'Tags', 'url'=>Url::to(['/tag'])],
		];
	}

	public function run() {
		echo $this->render('menu', ['items'=>$this->items]);
	}
	
}

