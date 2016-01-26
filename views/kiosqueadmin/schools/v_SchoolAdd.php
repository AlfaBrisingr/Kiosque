<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="jumbotron">
				<fieldset>
					<form action="?uc=ecole&action=AjouterEcole" method="POST">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<legend>Ajouter une école</legend>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="typeEcole">Type</label>
								<select name="typeEcole" class="form-control">
									<option value="1" selected="selected">Publique</option>
									<option value="2">Privée</option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="nomEcole">Nom</label>
								<input type="text" value="" name="nomEcole" class="form-control" placeholder="Nom de l'école">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="adresseEcole">Adresse</label>
								<input type="text" value="" name="adresseEcole" class="form-control" placeholder="Adresse de l'école"><br>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="cpEcole">Code Postal</label>
								<input type="text" value="" name="cpEcole" class="form-control" placeholder="Code Postal de l'école">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="villeEcole">Ville</label>
								<input type="text" value="" name="villeEcole" class="form-control" placeholder="Ville de l'école">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="mailDir">Mail</label>
								<input type="email" value="" name="mailDir" class="form-control" placeholder="Adresse mail de l'école"><br>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="telDir">Téléphone</label>
								<input type="text" value="" name="telDir" class="form-control" placeholder="Téléphone de l'école"><br>
							</div>
						</div>
						<div class="row"></div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
								<label for="civDir">Civilité du Directeur</label>
								<div class="radio">
									<label>
										<input type="radio" name="civDir" id="input" value="Madame" checked="checked">
										Madame
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="civDir" value="Monsieur">
										Monsieur
									</label>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="nomDir">Nom du Directeur</label>
								<input type="text" name="nomDir" value="" placeholder="Nom du directeur" class="form-control">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="prenomDir">Prénom du Directeur</label>
								<input type="text" name="prenomDir" value="" placeholder="Prénom du directeur" class="form-control"><br><br>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<input type="submit" class="btn btn-primary" value="Envoyer">
								<input type="reset" class="btn btn-default" value="Par défaut"><br><br>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<a href="?uc=ecole" class="btn btn-link">Retour</a>
							</div>
						</div>
					</form>
				</fieldset>
			</div>
		</div>
	</div>
</div>
