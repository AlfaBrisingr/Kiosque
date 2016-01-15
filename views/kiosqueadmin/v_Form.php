<script src="/JP/js/focus.js" type="text/javascript"></script>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-centered">
			<?php if(isset($_SESSION['error'])) { ?>
			<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<span class="sr-only">Error:</span>
				<?= $_SESSION['error'] ?>
			</div>
			<?php } ?>
			<form action="?uc=admin&action=voirAdmin" method="POST" autocomplete="off">
				<div class="form-group">
					<label for="login">Identifiant</label>
					<input class="form-control" type="text" name="login" id="login" placeholder="Identifiant...">
				</div>
				<div class="form-group">
					<label for="password">Mot de passe</label>
					<input class="form-control" type="password" name="password" id="password" placeholder="Mot de passe...">
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Se connecter">
					<input type="reset" class="btn btn-default">
				</div>
			</form>
		</div>
	</div>
</div>
<?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
