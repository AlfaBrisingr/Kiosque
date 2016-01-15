<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%;">
					40%
				</div>
			</div>
			<h3>Renseignement sur la classe</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p class="text-justify"><span class="require">*</span> : champs obligatoires</p>
		</div>
	</div>
	<form action="?uc=jp&action=etape3" method="post"  autocomplete="off">
		<input type="hidden" name="civEns" value="">
		<input type="hidden" name="classe" value="">
		<div class="form-group">
			<label>Civilité <span class="require">*</span></label>
			<div class="radio">
				<label>
					<input required type="radio" class="radio-inline" <?php if(isset($_SESSION['enseignant']) && $_SESSION['enseignant']->getCivilite() == 'Madame'){ echo 'checked="checked"'; } ?> name="civEns" value="Madame">Madame
				</label>
				<label>
					<input required type="radio" class="radio-inline" <?php if(isset($_SESSION['enseignant']) && $_SESSION['enseignant']->getCivilite() == 'Monsieur'){ echo 'checked="checked"'; } ?> name="civEns" value="Monsieur">Monsieur
				</label>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-3 col-lg-3 col-xs-3">
					<label>Nom de l'enseignant <span class="require">*</span></label>
					<input required="" class="form-control" type="text" <?php if(isset($_SESSION['enseignant']) && $_SESSION['enseignant']->getNom() != ""){ echo 'value='.$_SESSION['enseignant']->getNom(); } ?> name="nomEns" placeholder="Nom de l'enseignant">
				</div>
				<div class="col-xs-3 col-md-3 col-lg-3">
					<label>Prénom de l'enseignant <span class="require">*</span></label>
					<input required="" class="form-control" type="text" <?php if(isset($_SESSION['enseignant']) && $_SESSION['enseignant']->getPrenom() != ""){ echo 'value='.$_SESSION['enseignant']->getPrenom(); } ?> placeholder="Prénom de l'enseignant" name="prenomEns">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3 col-md-3 col-lg-3">
					<label>N° Portable de l'enseignant</label>
					<p class="text-justify">Ce n° n'est utilisé qu'en cas d'urgence ou d'impossibilités de vous joindre par le biais de l'établissement ou de votre adresse mail</p>
					<input class="form-control" type="text" <?php if(isset($_SESSION['enseignant']) && $_SESSION['enseignant']->getTel() != ""){ echo 'value='.$_SESSION['enseignant']->getTel(); } ?> placeholder="ex: 0202020202" name="telEns">
				</div>
				<div class="col-xs-3 col-md-3 col-lg-3">
					<label>Adresse mail de l'enseignant</label>
					<p class="text-justify">Nous permet de vous transmettre efficacement les informations et de vous joindre facilement<br><br></p>
					<input class="form-control" type="email" <?php if(isset($_SESSION['enseignant']) && $_SESSION['enseignant']->getMail() != ""){ echo 'value='.$_SESSION['enseignant']->getMail(); } ?> placeholder="Si différent de l'établissement" name="mailEns">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="form-group">
				<label>Classe (niveau) <span class="require">*</span></label>
				<p class="inline">Merci d'indiquer tous les niveaux concernés en cas de classe multiple</p>
			</div>
			<div class="checkbox">
				<div class="row">
					<div class="col-xs-3 col-md-3 col-lg-3">
						<label>
							<input type="checkbox" name="classe[]" <?php if(isset($_SESSION['classe']) && $_SESSION['classe'] == 'Maternelle petite section'){ echo 'checked="checked"'; } ?> value="Maternelle petite section">Maternelle petite section
						</label>
						<label>
							<input type="checkbox" name="classe[]" value="Maternelle moyenne section">Maternelle moyenne section
						</label>
						<label>
							<input type="checkbox" name="classe[]" value="Maternelle grande section">Maternelle grande section
						</label>
					</div>
					<div class="col-xs-2 col-md-2 col-lg-2">
						<label>
							<input type="checkbox" name="classe[]" value="CP">Primaire CP
						</label>
						<label>
							<input type="checkbox" name="classe[]" value="CE1">Primaire CE1
						</label>
						<label>
							<input type="checkbox" name="classe[]" value="CE2">Primaire CE2
						</label>
					</div>
					<div class="col-xs-2 col-md-2 col-lg-2">
						<label>
							<input type="checkbox" name="classe[]" value="CM1">Primaire CM1
						</label>
						<label>
							<input type="checkbox" name="classe[]" value="CM2">Primaire CM2
						</label>
						<label>
							<input type="checkbox" name="classe[]" value="C.L.I.S">C.L.I.S
						</label>
					</div>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<label>
							<input type="checkbox" name="classe[]" value="Autre">Autre
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2 col-md-2 col-lg-2">
					<label>Nombre d'élèves <span class="require">*</span></label>
					<input required class="form-control" type="text" <?php if(isset($_SESSION['nbrEleve']) && $_SESSION['nbrEleve'] != ""){ echo 'value='.$_SESSION['nbrEleve']; } ?>  placeholder="ex: 12" name="nbrEleve">
				</div>
				<div class="col-xs-3 col-md-3 col-lg-3">
					<label>Nombre d'accompagnateurs <span class="require">*</span></label>
					<input required class="form-control" type="text" <?php if(isset($_SESSION['nbrAccom']) && $_SESSION['nbrAccom'] != ""){ echo 'value='.$_SESSION['nbrAccom']; } ?>  placeholder="ex: 2" name="nbrAccom">
				</div>
			</div>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Continuer</button>
		</div>
	</form>
	<script src="js/validate.js"></script>
	<script type="text/javascript">$.noConflict();</script>
	<div class="col-md-12 row">
		<a href="?uc=jp&action=etape1" class="btn btn-link">Retour</a>
		<a href="?uc=index" class="btn btn-link">Revenir à l'accueil</a>
	</div>
</div>
