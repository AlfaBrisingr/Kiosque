<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1 class="text-center">Gestion des lieux</h1>
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
			<legend>Lieux
				<a class="pull-right" title="Nouveau lieu" href="?uc=lieu&action=voirAjouterLieu">
					<span class="glyphicon glyphicon-plus" aria-hidden="true">
					</span>
				</a>
			</legend>
			<thead>
				<tr>
					<th>Numéro Lieu</th>
					<th>Nom</th>
					<th>Adresse</th>
					<th>Code Postal</th>
					<th>Ville</th>
					<th>Options</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($listLieu->getCollection() as $lieu) { ?>
				<tr>
					<td><?= $lieu->getId() ?></td>
					<td><?= $lieu->getNom() ?></td>
					<td><?= $lieu->getAdresse() ?></td>
					<td><?= $lieu->getCp() ?></td>
					<td><?= $lieu->getVille() ?></td>
					<td>
						<a title="Modifier <?= $lieu->getNom() ?>" href="?uc=lieu&action=voirModifierLieu?locations=<?= $lieu->getId() ?>">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true">
							</span>
						</a>
						<a title="Supprimer <?= $lieu->getNom() ?>" href="?uc=lieu&action=voirSupprimerLieu?locations=<?= $lieu->getId() ?>">
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
