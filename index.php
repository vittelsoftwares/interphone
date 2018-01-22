<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>


<?php include(HEADER_TEMPLATE); ?>
<?php $db = open_database(); ?>
	<title>Moradores</title>

<h1>Painel de Controle</h1>
<hr />

<?php if ($db) : ?>

	<?php

	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();

	// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['UsuarioID'])) {
		// Destrói a sessão por segurança
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: login.php"); exit;
	}

	?>

<br/>
<div class="row">
	<div class="col-xs-6 col-sm-3 col-md-2">
		<a href="customers/add.php" class="btn btn-success">
			<div class="row">
				<div class="col-xs-12 text-center">
					<i class="fa fa-plus-square fa-5x"></i>
				</div>
				<div class="col-xs-12 text-center">
					<p>Novo Morador</p>
				</div>
			</div>
		</a>
	</div>

	<div class="col-xs-6 col-sm-3 col-md-2">
		<a href="customers" class="btn btn-default">
			<div class="row">
				<div class="col-xs-12 text-center">
					<i class="fa fa-users fa-5x"></i>
				</div>
				<div class="col-xs-12 text-center">
					<p>Moradores</p>
				</div>
			</div>
		</a>
	</div>

	<div class="col-xs-6 col-sm-3 col-md-2">
		<a href="relatorios" class="btn btn-default">
			<div class="row">
				<div class="col-xs-12 text-center">
					<i class="fa fa-area-chart fa-5x"></i>
				</div>
				<div class="col-xs-12 text-center">
					<p>Relatórios</p>
				</div>
			</div>
		</a>
	</div>

	<div class="col-xs-6 col-sm-3 col-md-2">
		<a href="anuncios" class="btn btn-default">
			<div class="row">
				<div class="col-xs-12 text-center">
					<i class="fa fa-bullhorn fa-5x"></i>
				</div>
				<div class="col-xs-12 text-center">
					<p>Anúncios</p>
				</div>
			</div>
		</a>
	</div>
</div>
<?php else : ?>
	<div class="alert alert-danger" role="alert">
		<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
	</div>

<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>