<?php ob_start(); ?>
<div class="container">
	<div class="row">
		<div class="jumbotron">
			<fieldset><legend>Nouveau lieu</legend></fieldset>
			<form action="/JP/kiosqueadmin/locations/?locationsaddfinish=1" method="POST">
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Nom</label>
						<input type="text" name="nomLieu" id="nomLieu" class="form-control" placeholder="Nom">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Adresse</label>
						<input type="text" name="adrLieu" class="form-control" placeholder="Adresse"><br>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Code Postal</label>
						<input type="text" name="cpLieu" class="form-control" placeholder="ex: 53000"><br>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Ville</label>
						<input type="text" name="villeLieu" class="form-control" placeholder="Ville"><br>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input type="submit" class="btn btn-primary" value="Envoyer">
						<input type="reset" class="btn btn-default" value="Par défaut">
					</div>
				</div>
			</form>
		</div>
		<a href="/JP/kiosqueadmin/locations/" charset="btn btn-link">Retour</a>
	</div>
</div>
<?php $contenu = ob_get_clean(); ?>
