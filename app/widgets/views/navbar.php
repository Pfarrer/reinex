<?php
use app\components\Url;
?>

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Show menu</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?= Url::home() ?>">
				<img src="<?= Url::base() ?>/images/toplogo.gif" />
			</a>
		</div>

		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav" id="mainmenu-items">
				<?php foreach ($items as $item): ?>
					
					<?php if (!isset($item['if']) || $item['if']): ?>
						<li data-menuanchor="<?= str_replace(' ', '_', strtolower($item['label'])) ?>">
							<a href="<?= $item['url'] ?>">
								<?php if (isset($item['icon'])): ?>
									<i class="glyphicon glyphicon-<?= $item['icon'] ?>"></i>
								<?php endif; ?>

								<?= Yii::t('menu', $item['label']) ?>
							</a>
						</li>
					<?php endif; ?>
					
				<?php endforeach; ?>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<?php if (!Yii::$app->user->isGuest): ?>
					<li>
						<a href="<?= Url::to(['/site/logout']) ?>" title="Logout">
							<i class="glyphicon glyphicon-log-out"></i>
						</a>
					</li>
				<?php endif; ?>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img id="language_flag"
							src="<?= Url::base() ?>/images/flags/<?= Yii::$app->language ?>.png" />
						<b class="caret"></b>
					</a>

					<ul class="dropdown-menu">
						<?php foreach (Yii::$app->params['languages'] as $lang): ?>
							<li>
								<a href="<?= Url::switchLanguageUrl($lang) ?>">
									<img src="<?= Url::base() ?>/images/flags/<?= $lang ?>.png" />
									<?= Yii::t('language', $lang) ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>
			</ul>
		</div>

	</div>
</div>