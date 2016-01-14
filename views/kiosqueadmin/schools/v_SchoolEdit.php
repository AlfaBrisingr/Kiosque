<?php ob_start(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="jumbotron">
				<fieldset><legend>Modifier l'école <?= $listEcole['nomEcole'] ?></legend>
					<form action="/JP/kiosqueadmin/schools/?schoolsseditfinish=1&schools=<?= $listEcole['idEcole'] ?>" method="POST">
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="typeEcole">Type</label>
								<select name="typeEcole" class="form-control">
									<option value="1" <?php if($listEcole['typeEcole'] == '1') { ?> selected="selected" <?php } ?>>Publique</option>
									<option value="2" <?php if($listEcole['typeEcole'] == '2') { ?> selected="selected" <?php } ?>>Privée</option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="nomEcole">Nom</label>
								<input type="text" value="<?= $listEcole['nomEcole'] ?>" name="nomEcole" class="form-control" placeholder="Nom de l'école">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="adresseEcole">Adresse</label>
								<input type="text" value="<?= $listEcole['adresseEcole'] ?>" name="adresseEcole" class="form-control" placeholder="Adresse de l'école"><br>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="cpEcole">Code Postal</label>
								<input type="text" value="<?= $listEcole['cpEcole'] ?>" name="cpEcole" class="form-control" placeholder="Code Postal de l'école">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="villeEcole">Ville</label>
								<input type="text" value="<?= $listEcole['villeEcole'] ?>" name="villeEcole" class="form-control" placeholder="Ville de l'école">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="mailDir">Mail</label>
								<input type="email" value="<?= $listEcole['mail_dir'] ?>" name="mailDir" class="form-control" placeholder="Adresse mail de l'école"><br>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="telDir">Téléphone</label>
								<input type="text" value="<?= $listEcole['telEns'] ?>" name="telDir" class="form-control" placeholder="Téléphone de l'école"><br>
							</div>
						</div>
						<div class="row"></div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
								<label for="civDir">Civilité du Directeur</label>
								<div class="radio">
									<label>
										<input type="radio" name="civDir" id="input" value="Madame" <?php if($listEcole['civEns'] == 'Madame') { ?> checked="checked" <?php } ?>>
										Madame
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="civDir" value="Monsieur" <?php if($listEcole['civEns'] == 'Monsieur') { ?> checked="checked" <?php } ?>>
										Monsieur
									</label>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="nomDir">Nom du Directeur</label>
								<input type="text" name="nomDir" value="<?= $listEcole['nomEns'] ?>" placeholder="Nom du directeur" class="form-control">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="prenomDir">Prénom du Directeur</label>
								<input type="text" name="prenomDir" value="<?= $listEcole['prenomEns'] ?>" placeholder="Prénom du directeur" class="form-control"><br><br>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<input type="submit" value="Envoyer" class="btn btn-primary">
								<input type="reset" value="Par défault" class="btn btn-default">
							</div>
						</div>
					</form>
				</fieldset>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<a href="/JP/kiosqueadmin/schools/" class="btn btn-link">Retour</a>
			</div>
		</div>
	</div>
	<?php $contenu = ob_get_clean(); ?>
