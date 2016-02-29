<?php $jour = array('1' => 'Lundi','2' => 'Mardi','3' => 'Mercredi', '4' => 'Jeudi', '5' => 'Vendredi', '6' => 'Samedi', '7' => 'Dimanche'); ?>
	<script src="/JP/js/css_cond.js"></script>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h1 class="text-center">Gestion des inscriptions</h1>
				<?php if(isset($_SESSION['error'])) { ?>
					<div class="alert alert-danger" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						<?= $_SESSION['error'] ?>
					</div>
				<?php } ?>
				<?php if(isset($_SESSION['valid'])) { ?>
					<div class="alert alert-success" role="alert">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
						<?= $_SESSION['valid'] ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="inscription">
			<div class="table-responsive">
				<legend>Inscriptions : NbEnfants : <?=$enfant?> NbAdultes :  </legend>
				<div class="overflow-scroll-table">
					<table class="table table-hover table-condensed table-bordered">
						<thead>
						<tr>
							<th>N°</th>
							<th>Etat</th>
							<th>Ets</th>
							<th>Par</th>
							<th>Divers</th>
							<th>Impossibilités</th>
							<th>Nbr Enfants</th>
							<th>Nbr Adultes</th>
							<th>Classe</th>
							<th>Date d'inscription</th>
							<th>Spectacle n°1</th>
							<th>Spectacle n°2</th>
							<th>Spectacle n°3</th>
							<th>Options</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($listIns->getCollection() as $inscription) {;?>
						<tr>
							<td><?= $inscription->getId() ?></td>
							<td id="etat"><?php if($inscription->isValidated() == true ) { echo 'Validée'; } else { echo 'Non validée'; } ?></td>
							<td><?= $inscription->getEnseignant()->getEcole()->getNom() ?></td>
							<td><?= $inscription->getEnseignant()->getNom().' '.$inscription->getEnseignant()->getPrenom() ?></td>
							<td><?php if(empty($inscription->getDivers())){ echo '<strong><em>Vide</em></strong>'; } else { echo $inscription->getDivers(); } ?></td>
							<td><?php if(empty($inscription->getImpo()) || $inscription->getImpo() == ' - - ' || $inscription->getImpo() == '- -' || $inscription->getImpo() == ' -  - ') { echo '<strong><em>Vide</em></strong>'; } else { echo $inscription->getImpo(); } ?></td>
							<td><?= $inscription->getNbEnfants() ?></td>
							<td><?= $inscription->getNbAdultes() ?></td>
							<td><?= $inscription->getClasse() ?></td>
							<td><?php $d =$inscription->getDate();
								echo date_format($d, 'd/m/Y H:i'); ?>
							</td>
							<td><?php if($inscription->getLesChoix()->getElement(0)->getPriorite() == 1 ){ echo $inscription->getLesChoix()->getElement(0)->getSpectacle()->getNom(); }else{ echo '<strong><em>Vide</em></strong>'; }?></td>
							<td><?php if($inscription->getLesChoix()->taille() >= 2){if($inscription->getLesChoix()->getElement(1)->getPriorite() == 2 ){ echo $inscription->getLesChoix()->getElement(1)->getSpectacle()->getNom(); } }else{ echo '<strong><em>Aucun</em></strong>';}?></td>
							<td><?php if($inscription->getLesChoix()->taille() == 3){ if($inscription->getLesChoix()->getElement(2)->getPriorite() == 3 ){ echo $inscription->getLesChoix()->getElement(2)->getSpectacle()->getNom(); } }else{ echo '<strong><em>Aucun</em></strong>';}?></td>
							<td>
								<a href="?uc=admin&action=validerInscription&ins=<?= $inscription->getId()  ?>" title="Planifier l'inscription n° <?= $inscription->getId()  ?>">
									<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
								</a>
								<a href="?uc=admin&action=ModifierInscription&ins=<?= $inscription->getId()  ?>" title="Modifier l'inscription n° <?= $inscription->getId()  ?>">
									<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
								</a>
								<a onclick="return sure()" href="?uc=admin&action=SupprimerInscription&ins=<?= $inscription->getId()  ?>" title="Supprimer l'inscription n° <?= $inscription->getId()  ?>">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								</a>
							</td>
							<?php } ?>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<legend>Planning <a title="Mettre le Tableau en PDF" href="?uc=admin&action=PlanningPDF"><span class="pull-right glyphicon glyphicon-new-window" aria-hidden="true"></span></a></legend>
				<div class="overflow-scroll-table">
					<table class="table table-striped table-hover table-bordered table-condensed">
						<thead>
						<tr>
							<th>Séance</th>
							<th>Spectacle</th>
							<th>Séance</th>
							<th>Inscription</th>
							<th>Classe</th>
							<th>N° Téléphone</th>
							<th>Nbr Enfants</th>
							<th>Nbr Adultes</th>
							<th>Options</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($listPlan->getCollection() as $planning) { ?>
							<tr>
								<td><?= $planning->getSeance()->getId() ?></td>
								<td><?= $planning->getSeance()->getSpectacle()->getNom() ?></td>
								<td>
									<?php $d = $planning->getSeance()->getDate();
									echo $jour[$d->format('N')].' ';
									echo $d->format('d/m/Y - H:i'); ?>
								</td>
								<td><?= $planning->getInscription()->getEnseignant()->getEcole()->getNom() ?> <?= '- '.$planning->getInscription()->getEnseignant()->getNom().' '.$planning->getInscription()->getEnseignant()->getPrenom() ?></td>
								<td><?= $planning->getInscription()->getClasse() ?></td>
								<td><?= $planning->getInscription()->getEnseignant()->getEcole()->getDirecteur()->getTel() ?></td>
								<td><?= $planning->getInscription()->getNbEnfants()?></td>
								<td><?= $planning->getInscription()->getNbAdultes() ?></td>
								<td>
									<a onclick="return sure()" href="?uc=admin&action=SupprimerunPlanning&i=<?= $planning->getInscription()->getId() ?>" title="Supprimer du planning">
										<span class="glyphicon glyphicon-remove"></span>
									</a>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-9" id="jauge">
				<table class="table table-striped table-hover table-bordered table-condensed">
					<legend>Jauges<a title="Mettre le Tableau en PDF" href="?uc=admin&action=JaugePDF"><span class="pull-right glyphicon glyphicon-new-window" aria-hidden="true"></span></a></legend>
					<thead>
					<tr>
						<th>Séance</th>
						<th>Spectacle</th>
						<th>Date Séance</th>
						<th>Nbr Enfants</th>
						<th>Nbr Adultes</th>
						<th>Jauge utilisée</th>
						<th>Jauge restante</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($listJauge->getCollection() as $jauge) { ?>
						<tr>
							<td><?= $jauge->getSeance()->getId() ?></td>
							<td><?= $jauge->getSeance()->getSpectacle()->getNom() ?></td>
							<td>
								<?php $d =$jauge->getSeance()->getDate();
								echo $jour[$d->format('N')].' ';
								echo $d->format('d/m/Y - H:i'); ?>
							</td>
							<td><?= $jauge->getNbEnfants(); ?></td>
							<td><?= $jauge->getNbAdultes(); ?></td>
							<td><?= $jauge->getUtilise(); ?></td>
							<td><?= $jauge->getRestante(); ?></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
				<table class="table table-bordered table-hover table-striped table-condensed">
					<legend>Spectacle</legend>
					<thead>
					<tr>
						<th>N°</th>
						<th>Nom</th>
						<th>Nombre de places</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($listSpec->getCollection() as $spectacle) { ?>
						<tr>
							<td><?= $spectacle->getId() ?></td>
							<td><?= $spectacle->getNom() ?></td>
							<td><?= $spectacle->getNbPlace() ?></td>
						</tr>
						<?php
					} ?>
					</tbody>
				</table>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
				<legend>Séance <a title="Mettre le Tableau en PDF" href="?uc=admin&action=SeancePDF"><span class="pull-right glyphicon glyphicon-new-window" aria-hidden="true"></span></a> <a title="Ajouter une séance" href="?uc=admin&action=AjouterSeance"><span class="pull-right glyphicon glyphicon-plus" aria-hidden="true"></span></a></legend>
				<div class="overflow-scroll-table">
					<table class="clear table table-striped table-hover table-condensed table-bordered">
						<thead>
						<tr>
							<th>N°</th>
							<th>Spectacle</th>
							<th>Date/Heure</th>
							<th>Lieu</th>
							<th>Options</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($listSean->getCollection() as $seance) { ?>
							<tr>
								<td><?= $seance->getId() ?></td>
								<td><?= $seance->getSpectacle()->getNom() ?></td>
								<td>
									<?php $d = $seance->getDate();
									echo $jour[$d->format('N')].' ';
									echo $d->format('d/m/Y - H:i'); ?>
								</td>
								<td><?= $seance->getLieu()->getNom() ?></td>
								<td>
									<a onclick="return sure()" href="?uc=admin&action=SupprimerSeance&seance=<?= $seance->getId() ?>">
										<span class="glyphicon glyphicon-remove"></span>
									</a>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<a href="?uc=admin&action=voirAdmin" class="btn btn-primary">Retour</a>
			</div>
		</div>
	</div>
	<br>

