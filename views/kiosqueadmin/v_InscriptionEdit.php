<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="jumbotron">
				<fieldset>
					<form action="?uc=admin&action=validerInscription&ins=<?= $listIns['idInscription'] ?>&editfinish=1" method="POST">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<legend>Modifier l'inscription de <?php echo "\"".$listIns['nomEns'].' '.$listIns['prenomEns']."\""; ?></legend>
						</div>
						<div class="form-group">
							<div class="clear col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="idSpectacleC1">Choix n° 1</label>
								<select name="idSpectacleC1" class="form-control">
									<?php foreach ($listSpec as $key) { ?>
									<?php if($key['idSpectacle'] == $listChoix1['idSpectacle']){ ?>
									<option selected="selected" value="<?= $key['idSpectacle'] ?>"><?= $key['nomSpectacle'] ?></option>
									<?php } else { ?>
									<option value="<?= $key['idSpectacle'] ?>"><?= $key['nomSpectacle'] ?></option>
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
									<?php foreach ($listSpec2 as $key) { ?>
									<?php if(isset($listChoix2)){ ?>
									<?php if($key['idSpectacle'] == $listChoix2['idSpectacle']){ ?>
									<option selected="selected" value="<?= $key['idSpectacle'] ?>"><?= $key['nomSpectacle'] ?></option>
									<?php } else { ?>
									<option value="<?= $key['idSpectacle'] ?>"><?= $key['nomSpectacle'] ?></option>
									<?php } ?>
									<?php } else { ?>
									<option value="<?= $key['idSpectacle'] ?>"><?= $key['nomSpectacle'] ?></option>
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
									<?php foreach ($listSpec3 as $key) { ?>
									<?php if(isset($listChoix3)){ ?>
									<?php if($key['idSpectacle'] == $listChoix2['idSpectacle']){ ?>
									<option selected="selected" value="<?= $key['idSpectacle'] ?>"><?= $key['nomSpectacle'] ?></option>
									<?php } else { ?>
									<option value="<?= $key['idSpectacle'] ?>"><?= $key['nomSpectacle'] ?></option>
									<?php } ?>
									<?php } else { ?>
									<option value="<?= $key['idSpectacle'] ?>"><?= $key['nomSpectacle'] ?></option>
									<?php } ?>
									<?php } ?>
								</select>
								<br>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="nbrEnfants">Nombre d'Enfants</label>
								<input type="text" value="<?= $listIns['nbEnfantsInscription'] ?>" name="nbrEnfants" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="nbrAdultes">Nombre d'Adultes</label>
								<input type="text" value="<?= $listIns['nbAdultesInscription'] ?>" name="nbrAdultes" class="form-control"><br>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label>Mail de l'enseignant</label>
								<input type="text" class="form-control" name="mailEns" value="<?= $listIns['telEns'] ?>" placeholder="Mail de l'enseignant">
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
			<a href="/JP/kiosqueadmin/?admin=registration" class="btn btn-link">Retour</a>
		</div>
	</div>
</div>
