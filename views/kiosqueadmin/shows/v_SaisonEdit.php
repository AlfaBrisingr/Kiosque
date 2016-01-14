<?php ob_start(); ?>

<div class="container">
	<div class="row">
		<div class="jumbotron">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<fieldset><legend>Changer la saison courante</legend></fieldset>
			</div>
			<form action="/JP/kiosqueadmin/shows/?seasoneditfinish=1&old=<?= $actuel['idSaison'] ?>" method="POST">
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<label>Saison actuelle</label>
						<h4><?= $actuel['nomSaison'] ?></h4>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<label>Nouvelle saison courante</label>
						<select name="nouvelleSaison" class="form-control">
							<?php foreach ($listSaison as $key) { ?>
							<option value="<?= $key['idSaison'] ?>"><?= $key['nomSaison'] ?></option>
							<?php } ?>
						</select><br>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input type="submit" value="Envoyer" class="btn btn-primary">
						<input type="reset" value="Par défaut" class="btn btn-default">
					</div>
				</div>
			</form>
		</div>
		<a href="/JP/kiosqueadmin/shows/" class="btn btn-link">Retour</a>
	</div>
</div>

<?php $contenu = ob_get_clean(); ?>
