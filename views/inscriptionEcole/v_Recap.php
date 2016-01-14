
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="jumbotron">
				<div class="container">
					<h2>Récapitulatif de votre demande (<?= date('d/m/Y H:i'); ?>) </h2>
					<div class="row">
						<section>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
								<h4>Votre Etablisssement : </h4>
								<?php foreach ($Ent as $key => $value): ?>
									<?php if(!empty($value)) { ?>
									<?= $value; ?>
									<br>
									<?php } ?>
								<?php endforeach ?>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
								<h4>Votre Responsable : </h4>
								<?php foreach ($Resp as $key => $value): ?>
									<?= $value.' ' ?>
								<?php endforeach ?>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
								<h4>Enseignant : </h4>
								<?php foreach ($Ens1 as $key => $value): ?>
									<?php if(!(is_array($value))): ?>
										<?= $value ?>
									<?php endif ?>
								<?php endforeach ?>
								<br>
								<?php foreach ($Ens3 as $key => $value): ?>
									<?php if(!(is_array($value))): ?>
										<?php if(!empty($value)): ?>
											<?= $value ?><br>
										<?php endif ?>
									<?php endif ?>
								<?php endforeach ?>
								<?php foreach ($Ens2 as $key => $value): ?>
									<?php if(!(is_array($value))): ?>
										<strong><?= $key ?></strong> : <?= $value ?><br>
									<?php endif ?>
									<?php if(is_array($value)): ?>
										<strong><?= $key ?> : </strong>
										<?php foreach ($value as $subkey => $subval): ?>
											<br><?= $subval ?>
										<?php endforeach ?><br>
									<?php endif ?>
								<?php endforeach ?>
							</div>
						</section>
						<section>
							<div class="clear col-xs-12 col-sm-6 col-md-4 col-lg-4">
								<br><br>
								<h4>Votre choix n° 1 : </h4>
								<?php foreach ($Choix1 as $key => $value): ?>
									<?php if(!($value == 'non')){ ?>
									<?php if(!($value == "")) {
										echo '<strong>'.$key.'</strong> : '.$value.'<br>';
									} else {
										echo '<strong>'.$key.'</strong> : Aucune<br>';
									} ?>
									<?php } else {
										echo '<strong>Pas de choix n° 3</strong><br>';
									} ?>
								<?php endforeach ?>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
								<br><br>
								<h4>Votre choix n° 2 : </h4>
								<?php foreach ($Choix2 as $key => $value): ?>
									<?php if(!($value == 'non')){ ?>
									<?php if(!($value == "")) {
										echo '<strong>'.$key.'</strong> : '.$value.'<br>';
									} else {
										echo '<strong>'.$key.'</strong> : Aucune<br>';
									} ?>
									<?php } else {
										echo '<strong>Pas de choix n° 2</strong><br>';
									} ?>
								<?php endforeach ?>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
								<br><br>
								<h4>Votre choix n° 3 : </h4>
								<?php foreach ($Choix3 as $key => $value): ?>
									<?php if(!($value == 'non')){ ?>
									<?php if(!($value == "")) {
										echo '<strong>'.$key.'</strong> : '.$value.'<br>';
									} else {
										echo '<strong>'.$key.'</strong> : Aucune<br>';
									} ?>
									<?php } else {
										echo '<strong>Pas de choix n° 3</strong><br>';
									} ?>
								<?php endforeach ?>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<a onclick="document.location.href = '/JP/?submit=1'"><button class="btn btn-primary btn-lg">Confirmer la demande</button></a>
			<a onclick="document.location.href = '/controller/c_DestroySession.php'" class="btn btn-default btn-lg">Réinitialiser</a>
			<a <?php if($_SESSION['choix3'] == 'non' && $_SESSION['choix2'] == 'non'){ ?> href="/JP/?etapeJP=4" <?php } else { ?> href="/JP/?etapeJP=5" <?php } ?><button class="btn btn-primary btn-lg">Retour</button></a>
			<br><br>
		</div>
	</div>
</div>
