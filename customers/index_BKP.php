<?php session_start(); ?>
 
<?php
if(!isset($_SESSION['valid'])) {
    header('Location: /interphone/login.php');
}
?>

<?php
include_once("connection.php");
    require_once('functions.php');
    index();
?>

<?php include('modal.php'); ?>

<?php include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Moradores</h2>
		</div>
		<div class="col-sm-6 text-right h2">
	    	<a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Morador</a>
	    	<a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
	    </div>
	</div>
</header>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $_SESSION['message']; ?>

	</div>
<?php endif; ?>

<hr>
	<hr>

<table class="table table-hover table-bordered">
<thead>
	<tr>
		<th>ID</th>
		<th width="30%">Nome</th>
		<th>Quadra/Lote</th>
		<th>Usuario 1</th>
		<th>Usuário 2</th>
		<th>Opções</th>
	</tr>
</thead>
<tbody>
<?php if ($moradores) : ?>
<?php foreach ($moradores as $morador) : ?>
	<tr>
		<td><?php echo $morador['id']; ?></td>
		<td><?php echo $morador['name']; ?></td>
		<td><?php echo $morador['quadraelote']; ?></td>
		<td><?php echo $morador['usuario1']; ?></td>
		<td><?php echo $morador['usuario2']; ?></td>
		<td class="actions text-right">
			<a href="view.php?id=<?php echo $morador['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
			<a href="edit.php?id=<?php echo $morador['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
		</td>
	</tr>
<?php endforeach; ?>
<?php else : ?>
	<tr>
		<td colspan="6">Nenhum registro encontrado.</td>
	</tr>
<?php endif; ?>
</tbody>
</table>

<?php include(FOOTER_TEMPLATE); ?>