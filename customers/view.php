<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$nivel_necessario = 1;

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
	// Destrói a sessão por segurança
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: login.php"); exit;
}

?>

<?php 
	require_once('functions.php'); 
	view($_GET['id']);
	include_once("connection.php");

?>

<?php include(HEADER_TEMPLATE); ?>

<h2><?php echo $morador['name']; ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php endif; ?>

<dl class="dl-horizontal">
	<dt>Nome:</dt>
	<dd><?php echo $morador['name']; ?></dd>

	<dt>Quadra/Lote:</dt>
	<dd><?php echo $morador['quadraelote']; ?></dd>

	<dt>Usuário Proprietário:</dt>
	<dd><?php echo $morador['usuario1']; ?></dd>

	<dt>Senha:</dt>
	<dd><?php echo $morador['senha1']; ?></dd>

	<dt>Celular:</dt>
	<dd><?php echo $morador['celular1']; ?></dd>
</dl>

<dl class="dl-horizontal">
	<dt>Nome:</dt>
	<dd><?php echo $morador['conjuge']; ?></dd>

	<dt>Usuário Cônjuge:</dt>
	<dd><?php echo $morador['usuario2']; ?></dd>

	<dt>Senha:</dt>
	<dd><?php echo $morador['senha2']; ?></dd>

	<dt>Celular:</dt>
	<dd><?php echo $morador['celular2']; ?></dd>

</dl>

	<dl class="dl-horizontal">
		<dt>Telefone Fixo:</dt>
		<dd><?php echo $morador['telfixo']; ?></dd>
	</dl>

	<dl class="dl-horizontal">
		<dt>Data de Cadastro:</dt>
		<dd><?php echo $morador['created']; ?></dd>
	</dl>

<div id="actions" class="row">
	<div class="col-md-12">
<?php if($_SESSION['UsuarioNivel'] >$nivel_necessario){ ?>
	<a href="edit.php?id=<?php echo $morador['id']; ?>" class="btn btn-primary">Editar</a>
	<?php };?>
	  <a href="index.php" class="btn btn-default">Voltar</a>
	</div>
</div>

<?php include(FOOTER_TEMPLATE); ?>