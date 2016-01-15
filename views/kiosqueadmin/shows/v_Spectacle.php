<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1 class="text-center">Gestion des spectacles</h1>
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
		<table class="table table-striped table-hover table-bordered table-condensed">
			<legend>Spectacles (<?= $actuel->getNom() ?>)
				<a class="pull-right" title="Changer la saison courante" href="?uc=spectacle&action=voirChangerSaison">
					<span class="glyphicon glyphicon-cog" aria-hidden="true">
					</span>
				</a>
				<a class="pull-right" title="Nouveau spectacle" href="?uc=spectacle&action=voirAjouterSpectacle">
					<span class="glyphicon glyphicon-plus" aria-hidden="true">
					</span>
				</a>
			</legend>
			<thead>
				<tr>
					<th>Numéro Spectacle</th>
					<th>Nom</th>
					<th>Nombre de places</th>
					<th>Classes</th>
					<th>Options</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($listSpec->getCollection() as $spectacle) { ?>
				<tr>
					<td><?= $spectacle->getId() ?></td>
					<td><?= $spectacle->getNom() ?></td>
					<td><?= $spectacle->getNbPlace() ?></td>
					<td><?= $spectacle->getTypeClasse() ?></td>
					<td>
						<a title="Modifier <?= $spectacle->getNom() ?>" href="?uc=spectacle&action=SupprimerSpectacle?shows=<?= $spectacle->getId() ?>">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true">
							</span>
						</a>
						<a title="Supprimer <?= $spectacle->getNom() ?>" href="?uc=spectacle&action=SupprimerSpectacle?shows=<?= $spectacle->getId() ?>">
							<span class="glyphicon glyphicon-remove" aria-hidden="true">
							</span>
						</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<a href="?uc=admin&action=voirAdmin" class="btn btn-primary">Retour</a>
		</div>
	</div>
</div>
<?php if(isset($_SESSION['error'])){ unset($_SESSION['error']); }
if(isset($_SESSION['valid'])){ unset($_SESSION['valid']); } ?>
