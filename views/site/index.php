<?php

app\assets\FullpageAsset::register($this);
$textile = new \Netcarver\Textile\Parser();
$textile->setRelativeImagePrefix(\yii\helpers\Url::base().'/img/');

?>

<?php include "_menu.php" ?>

<div id="fullpage" class="container">
	
	<div class="section row" data-anchor="products">
		<div class="col-md-10 col-md-offset-1">
			<div class="row">

				<div class="col-md-9">
					<h1><?= \Yii::t('menu', 'Products') ?></h1>

				</div>

				<div class="col-md-3">
					<h2><?= \Yii::t('menu', 'Categories') ?></h2>

				</div>

			</div>
		</div>
	</div>
	
	<hr />
	
	<div class="section row" data-anchor="company">
		<div class="col-md-10 col-md-offset-1">
			<h1><?= \Yii::t('menu', 'Company') ?></h1>
			<a href="legal_notice"><?= \Yii::t('menu', 'Legal Notice') ?></a>
		</div>
	</div>
	
	<hr />

	<div class="section row" data-anchor="partners">
		<div class="col-md-10 col-md-offset-1">

			<div class="centered" style="margin-bottom: 2em;">
				<img src="<?= \yii\helpers\Url::base() ?>/img/leistikow.gif" />
			</div>

			<div class="row">

				<div class="col-md-6 centered">
					<h3><strong>FRANKFURT / MAIN</strong></h3>

					<p>
						Joachim Leistikow GmbH<br />
						Altkoenigstraße 2<br />
						D-61138 Niederdorfelden
					</p>

					<p>
						<a href="http://www.leistikow-gmbh.de" target="_blank">www.leistikow-gmbh.de</a>
					</p>
				</div>
				<div class="col-md-6 centered">
					<h3><strong>BERLIN</strong></h3>

					<p>
						LEISTIKOW-UTAG GmbH<br />
						Rosenthaler Straße 29-36<br />
						D-13127 Berlin-Buchholz
					</p>

					<p>
						<a href="http://www.leistikow-utag.de" target="_blank">www.leistikow-utag.de</a>
					</p>
				</div>

			</div>

		</div>
	</div>
	
	<hr />
	
	<div class="section row" data-anchor="contact">
		<div class="col-md-10 col-md-offset-1">
			<h1><?= \Yii::t('menu', 'Contact') ?></h1>
		</div>
	</div>
	
</div>

<script>
$(function() {
	$("#fullpage").fullpage({
		fixedElements: ".navbar-fixed-top",
		paddingTop: "51px",
		menu: "#mainmenu-items",
		autoScrolling: false
	});
});
</script>
