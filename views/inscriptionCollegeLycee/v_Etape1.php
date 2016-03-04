<div class="container">
	<div class="progress">
		<div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
			20%
		</div>
	</div>
	<h3>Ecole <?= $_SESSION['ecole']->getNom() ?></h3>
	<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
		<div class="row">
			<div class="form-group">
				<h4><strong>Mail</strong> :  <?= $_SESSION['ecole']->getMailDirecteur() ?></h4>
			</div>
			<div class="form-group">
				<h4><strong>Responsable</strong> :  <?= $_SESSION['ecole']->getDirecteur()->getCivilite() ?> <?= $_SESSION['ecole']->getDirecteur()->getNom() ?> <?= $_SESSION['ecole']->getDirecteur()->getPrenom() ?></h4>
			</div>
		</div>
	</div>
	<h5 class="inline">
		Si ces informations sont incorrectes, merci de bien vouloir les modifier dans les champs
	</h5>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p class="text-justify"><span class="require">*</span> : champs obligatoires</p>
		</div>
	</div>
	<form id="form1" action="?uc=cl&action=etape2" method="post" autocomplete="off">
		<div class="from-group">
			<div class="row">
				<div class="col-sm-12 col-xs-12 col-md-3 col-lg-3">
					<label for="mailEns" >Mail :</label>
					<p class="inline">Si différente ci-dessus</p>
					<input class="form-control" type="email" placeholder="exemple@exemple.com" name="mailEns">
				</div>
				<div class="col-sm-12 col-xs-12 col-md-2 col-lg-2">
					<label>Civilité</label>
					<div class="radio">
						<label>
							<input type="radio" <?php if(isset($_SESSION['ecole']) && $_SESSION['ecole']->getDirecteur()->getCivilite() == 'Madame'){ echo 'checked="checked"'; } ?> name="civEns" value="Madame">Madame
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" <?php if(isset($_SESSION['ecole']) && $_SESSION['ecole']->getDirecteur()->getCivilite() == 'Monsieur'){ echo 'checked="checked"'; } ?> name="civEns" value="Monsieur">Monsieur
						</label>
					</div>
				</div>
				<div class="col-sm-12 col-xs-12 col-md-3 col-lg-3">
					<label for="nomEns" >Nom : </label>
					<p class="inline">Si différent ci-dessus</p>
					<input class="form-control" type="text" placeholder="du responsable" name="nomEns">
				</div>
				<div class="col-sm-12 col-xs-12 col-md-3 col-lg-3">
					<label for="prenomEns" >Prénom  : </label>
					<p class="inline">Si différent ci-dessus</p>
					<input class="form-control" type="text" placeholder="du responsable" name="prenomEns">
				</div>
			</div>
		</div><br>
		<div class="form-group">
			<div class="row">
				<div class="col-sm-12 col-md-6 col-xs-6 col-lg-6">
					<label for="facture" >A qui doit-on libeller la facture ? <span class="require">*</span></label>
					<div class="form-group">
						<textarea rows="6" cols="90" required="" style="resize:none" name="facture" class="form-control"><?php if(isset($_SESSION['facture']) && $_SESSION['facture'] != ""){ echo $_SESSION['facture']; } ?></textarea>
					</div>
			</div>
		</div>
			<input type="submit" class="btn btn-primary" value="Continuer">
	</form>
	<script src="js/validate.js"></script>
	<script type="text/javascript">$.noConflict();</script>
	<div class="col-md-12 row">
		<a href="?uc=index" class="btn btn-link">Revenir à l'accueil</a>
		<a href="?uc=cl&action=choisirTypeEcole" class="btn btn-link">Retour</a>
	</div>
</div>
