<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$nivel_necessario = 1;

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] <$nivel_necessario)) {
    // Destrói a sessão por segurança
    // Redireciona o visitante de volta pro login
    header("Location: index.php"); exit;

}
?>

<?php
include_once("connection.php");
require_once('functions.php');
index();
$itens_por_pagina = 50;
// Pegar a pagina atual
$pagina = intval($_GET['pagina']);

$item = $pagina*$itens_por_pagina;
// Puxar moradores do banco
$sql_code = "select id, name, quadraelote, usuario1, usuario2 from moradores LIMIT $item, $itens_por_pagina";
$execute = $mysqli->query($sql_code) or die($mysqli->error);
$morador = $execute->fetch_assoc();
$num = $execute->num_rows;

// Pega a qtd total de objetos no banco de dados
$num_total = $mysqli->query("select id, name, quadraelote, usuario1, usuario2 from moradores")->num_rows;

// Definir numero de páginas
$num_paginas = ceil($num_total/$itens_por_pagina);
?>

<?php include(HEADER_TEMPLATE);
        include('modal.php');
        include('modal2.php');
?>
<title>Moradores</title>
    <header>
        <div class="row">
            <div class="col-sm-6">
                <h2><i class="fa fa-users"></i> Moradores</h2>
            </div>
            <div class="col-sm-6 text-right h2">
<?php if($_SESSION['UsuarioNivel'] >$nivel_necessario){ ?>
    <a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Morador</a>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#import-modal"> <i class="fa fa-upload"></i> Importar</a>
    <?php }; ?>

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

    <form class="form-inline" method="GET" action="pesquisar.php">
        <div class="form-group">
            <label for="exampleInputName2" class="sr-only">Buscar</label>
            <input type="text" class="form-control" id="exampleInputName2" name="pesquisar" placeholder="Quadra/Lote">
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
    </form>
    <hr>

<?php if($num > 0){ ?>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th width="30%">Nome</th>
            <th>Quadra/Lote</th>
            <th>Proprietário</th>
            <th>Cônjuge</th>
            <th>Opções</th>
        </tr>
        </thead>
        <tbody>
        <?php do{ ?>
            <tr>
                <td><?php echo $morador['id']; ?></td>
                <td><?php echo $morador['name']; ?></td>
                <td><?php echo $morador['quadraelote']; ?></td>
                <td><?php echo $morador['usuario1']; ?></td>
                <td><?php echo $morador['usuario2']; ?></td>
                <td class="actions text-center">
                    <a href="view.php?id=<?php echo $morador['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
        <?php if($_SESSION['UsuarioNivel'] >$nivel_necessario){ ?>
            <a href="edit.php?id=<?php echo $morador['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
            <?php };?>
        <?php if($_SESSION['UsuarioNivel'] >$nivel_necessario){ ?>
            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-customer="<?php echo $morador['id']; ?>" data-morador="<?php echo $morador['name']; ?>"> <i class="glyphicon glyphicon-remove"></i> Excluir</a>
        <?php };?>
                </td>
            </tr>
        <?php } while($morador = $execute->fetch_assoc()); ?>
        </tbody>
    </table>
<?php } ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="index.php">Inicio</a></li>
            <li class="page-item"><a class="page-link" href="index.php?pagina=0">Anterior</a></li>
            <?php for($i=0;$i<$num_paginas;$i++){
                $estilo= "";
                if($pagina == $i)
                    $estilo = "class=\"active\"";
                ?>
                <li <?php echo $estilo; ?> ><a class="page-link" href="index.php?pagina=<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
            <?php } ?>
            <li class="page-item"><a class="page-link" href="index.php?pagina=<?php echo $num_paginas-1; ?>">Proxima</a></li>
        </ul>
    </nav>

<?php include(FOOTER_TEMPLATE); ?>