<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="jumbotron">
				<fieldset>
					<form action="?uc=admin&action=ModifierInscription&ins=<?= $listIns->getId() ?>" method="POST">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<legend>Modifier l'inscription de <?php echo "\"".$listIns->getEnseignant()->getNom().' '.$listIns->getEnseignant()->getPrenom()."\""; ?></legend>
						</div>
						<div class="form-group">
							<div class="clear col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="idSpectacleC1">Choix n° 1</label>
								<select name="idSpectacleC1" class="form-control">
									<?php foreach ($listSpec->getCollection() as $spectacle) { ?>
									<?php if($spectacle->getId() == $listChoix1['idSpectacle']){ ?>
									<option selected="selected" value="<?= $spectacle->getId() ?>"><?= $spectacle->getNom() ?></option>
									<?php } else { ?>
									<option value="<?= $spectacle->getId() ?>"><?= $spectacle->getNom() ?></option>
									<?php } } ?>
								</select><br>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="idSpectacleC2">Choix n° 2</label>
								<select name="idSpectacleC2" class="form-control">
									<?php if(!isset($listChoix2)) { ?>
									<option selected="selected" value="non">Pas de choix n°2</option>
									<?php } else { ?>
									<option value="non">Pas de choix n°2</option>
									<?php } ?>
									<?php foreach ($listSpec2->getCollection() as $spectacle) { ?>
									<?php if(isset($listChoix2)){ ?>
									<?php if($spectacle->getId() == $listChoix2['idSpectacle']){ ?>
									<option selected="selected" value="<?= $spectacle->getId() ?>"><?= $spectacle->getNom() ?></option>
									<?php } else { ?>
									<option value="<?= $spectacle->getId() ?>"><?= $spectacle->getNom() ?></option>
									<?php } ?>
									<?php } else { ?>
									<option value="<?= $spectacle->getId() ?>"><?= $spectacle->getNom() ?></option>
									<?php } ?>
									<?php } ?>
								</select>
								<br>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="idSpectacleC3">Choix n° 3</label>
								<select name="idSpectacleC3" class="form-control">
									<?php if(!isset($listChoix3)) { ?>
									<option selected="selected" value="non">Pas de choix n°3</option>
									<?php } else { ?>
									<option value="non">Pas de choix n°3</option>
									<?php } ?>
									<?php foreach ($listSpec3->getCollection()  as $spectacle) { ?>
									<?php if(isset($listChoix3)){ ?>
									<?php if($spectacle->getId() == $listChoix2['idSpectacle']){ ?>
									<option selected="selected" value="<?= $spectacle->getId() ?>"><?= $spectacle->getNom() ?></option>
									<?php } else { ?>
									<option value="<?= $spectacle->getId() ?>"><?= $spectacle->getNom() ?></option>
									<?php } ?>
									<?php } else { ?>
									<option value="<?= $spectacle->getId() ?>"><?= $spectacle->getNom() ?></option>
									<?php } ?>
									<?php } ?>
								</select>
								<br>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="nbrEnfants">Nombre d'Enfants</label>
								<input type="text" value="<?= $listIns->getNbEnfants() ?>" name="nbrEnfants" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="nbrAdultes">Nombre d'Adultes</label>
								<input type="text" value="<?= $listIns->getNbAdultes() ?>" name="nbrAdultes" class="form-control"><br>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label>Mail de l'enseignant</label>
								<input type="text" class="form-control" name="mailEns" value="<?= $listIns->getEnseignant()->getMail() ?>" placeholder="Mail de l'enseignant">
							</div>
						</div>
						<div class="form-group">
							<div class="clear col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label>Classe</label>
								<input type="text" class="form-control" name="classe" value="<?= $listIns->getClasse() ?>" placeholder="Classe">
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label>Téléphone de l'établissement</label>
								<input type="text" class="form-control" name="telDir" value="<?= $listIns->getEnseignant()->getEcole()->getDirecteur()->getTel() ?>" placeholder="téléphone de l'établissement">
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<input type="submit" class="btn btn-primary" value="Envoyer">
								<input type="reset" class="btn btn-default" value="Par défaut">
							</div>
						</div>
					</form>
				</fieldset>
			</div>
			<a href="?uc=admin&action=voirInscription" class="btn btn-link">Retour</a>
		</div>
	</div>
</div>
