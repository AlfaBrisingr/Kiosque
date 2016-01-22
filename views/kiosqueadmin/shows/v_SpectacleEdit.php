<div class="container">
	<div class="row">
		<div class="jumbotron">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<fieldset><legend>Modifier le spectacle <?= $listSpec['nomSpectacle'] ?></legend></fieldset>
			</div>
			<form action="/JP/kiosqueadmin/shows/?showseditfinish=1&shows=<?= $idSpectacle ?>" method="POST">
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Nom</label>
						<input type="text" name="nomSpectacle" value="<?= $listSpec['nomSpectacle'] ?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Nombre de places</label>
						<input type="text" name="nbPlaceSpectacle" value="<?= $listSpec['nbPlaceSpectacle'] ?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Classes</label>
						<input type="text" name="typeClasse" value="<?= $listSpec['typeClasse'] ?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Pour la saison</label>
						<select class="form-control" name="idSaison">
							<?php foreach ($listSaison as $key) { ?>
							<option value="<?= $key['idSaison'] ?>" <?php if($key['idSaison'] == $listSpec['idSaison']) {?>selected="selected" <?php } ?>><?= $key['nomSaison'] ?></option>
							<?php } ?>
						</select><br>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input type="submit" value="Envoyer" class="btn btn-primary">
						<input type="reset" value="Par défault" class="btn btn-default">
					</div>
				</div>
			</form>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<a href="/JP/kiosqueadmin/shows" class="btn btn-link">Retour</a>
		</div>
	</div>
</div>
