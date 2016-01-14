<?php ob_start(); ?>

<div class="container">
	<div class="row">
		<div class="jumbotron">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<p class="text-justify"><?= $msgError ?></p>
			</div>
		</div>
	</div>
</div>
<?php $contenu = ob_get_clean(); ?>
