<?php
use app\components\Url;
use dosamigos\fileupload\FileUploadUI;

/** @var $this yii\web\View */
/** @var $id string */
/** @var $url array */

$this->registerCssFile(Url::base().'/css/modal.css');
?>

<style>
	.fileupload-buttonbar .cancel,
	.fileupload-buttonbar .delete,
	.fileupload-buttonbar .toggle {
		display: none;
	}
</style>

<button type="button" class="btn btn-default" data-toggle="modal" data-target="#image-upload-<?= $id ?>">
	<i class="glyphicon glyphicon-upload"></i>
	<?= Yii::t('common', 'Upload images') ?>
</button>

<div id="image-upload-<?= $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="image-upload-<?= $id ?>" data-backdrop="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" action="" enctype="multipart/form-data">

				<div class="modal-header">
					<h4 class="modal-title"><?= Yii::t('common', 'Image Upload') ?></h4>
				</div>

				<div class="modal-body">
					<?= FileUploadUI::widget([
						'name' => 'images',
						'url' => $url,
						'options' => ['accept' => 'image/*'],
						'clientOptions' => [
							'maxFileSize' => 20000000, // 20 MB
						],
					]) ?>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location=window.location">
						Close & Reload
					</button>
				</div>

			</form>
		</div>
	</div>
</div>