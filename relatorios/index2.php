<?php
/**
 * Created by PhpStorm.
 * User: Dionisio
 * Date: 16/11/2017
 * Time: 18:44
 */

?>
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
$itens_por_pagina = 99999;
// Pegar a pagina atual
$pagina = intval($_GET['pagina']);

$item = $pagina*$itens_por_pagina;
// Puxar moradores do banco
$sql_code = "SELECT id, calldate, clid, src, dst, lastdata, duration, disposition FROM cdr ORDER BY id DESC  LIMIT $item, $itens_por_pagina";
$execute = $mysqli->query($sql_code) or die($mysqli->error);
$relatorio = $execute->fetch_assoc();
$num = $execute->num_rows;

// Pega a qtd total de objetos no banco de dados
$num_total = $mysqli->query("SELECT id, calldate, clid, src, dst, lastdata, duration, disposition FROM cdr")->num_rows;

// Definir numero de páginas
$num_paginas = ceil($num_total/$itens_por_pagina);
?>

<?php include('modal.php'); ?>

<?php include(HEADER_TEMPLATE); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link href="<?php echo BASEURL; ?>css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="<?php echo BASEURL; ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASEURL; ?>js/bootstrap-datepicker.pt-BR.min.js" charset="UTF-8"></script>

<header>
    <div class="row">
        <div class="col-sm-4">
            <h2><i class="fa fa-area-chart"></i> Relatórios</h2>
        </div>
        <div class="col-sm-8 text-right h2">
            <form class="form-inline" method="GET" action="pesquisar.php">
                <div class="input-group date">
                    <div class="input-group-addon" style="
    font-family: Segoe UI;
    color: black;
    background-color: white;
    border: white;
">
                        <span style="font-family: segoe UI;">De</span>
                    </div>
                    <input type="text" class="form-control" id="datainicio" name="datainicio" placeholder="Data de Inicio">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                    <div class="input-group-addon" style="
    font-family: Segoe UI;
    color: black;
    background-color: white;
    border: white;
">
                        <span style="font-family: segoe UI;">Até</span>
                    </div>
                    <input type="text" class="form-control" id="datafinal" name="datafinal" placeholder="Data Final">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Filtrar</button>

            </form>
        </div>
    </div>
    <hr>
</header>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION['message']; ?>

    </div>
<?php endif; ?>
<?php if($num > 0){ ?>
    <table class="table table-bordered table-hover" id="id_da_tabela" style="font-size: 12px">
        <thead>
        <tr>
            <th>ID</th>
            <th>Data/Hora</th>
            <th>Chamador</th>
            <th>Origem</th>
            <th>Destino</th>
            <th>Número</th>
            <th>Duração(Minutos)</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php do{ ?>
            <tr>
                <td><?php echo $relatorio['id']; ?></td>
                <td><?php echo $relatorio['calldate']; ?></td>
                <td><?php

                    $string = $relatorio['clid'];
                    $chamador1 = str_replace("\"", "", $string);
                    $chamador2 = str_replace("<", "", $chamador1);
                    $chamador3 = str_replace(">", "", $chamador2);
                    echo "<font color=#0040ff> $chamador3 </font>";?></td>
                <td><?php echo $relatorio['src']; ?></td>
                <td><?php echo $relatorio['dst']; ?></td>
                <td><?php
                    $numero = $relatorio['lastdata'];
                   
                 //$string = str_replace("IAX2", "", $numero); 

                 //echo preg_replace("/[^0-9\s]/", "", $numero);
                 
                    echo $relatorio['lastdata'];?></td>
                <td><?php
                    $total = $relatorio['duration'];
                    echo gmdate("H:i:s", $total); ?></td>
                <td><?php
                    $status = $relatorio['disposition'];
                    if ($status == 'ANSWERED'){
                        $statusfinal = 'Atendida';
                        echo "<b><font color=#007e03> Atendida </font></b>";
                    }else if ($status == 'NO ANSWER'){
                        $statusfinal = 'Não Atendida';
                        echo "<b><font color=#d70808> Não Atendida </font></b>";
                    }else if ($status == 'BUSY') {
                        $statusfinal = 'Ocupada';
                        echo "<b><font color=#fca000> Ocupada </font></b>";
                    }else if ($status == 'FAILED') {
                        $statusfinal = 'Falhou';
                        echo "<b><font color=#FF0000> Falhou </font></b>";

                    }?></td>

            </tr>
        <?php } while($relatorio = $execute->fetch_assoc()); ?>
        </tbody>
    </table>
<?php } ?>
<script type="text/javascript">
    $('#datainicio').datepicker({
        format: "yyyy-mm-dd",
        language: "pt-BR",
    });
</script>
<script type="text/javascript">
    $('#datafinal').datepicker({
        format: "yyyy-mm-dd",
        language: "pt-BR",
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('#id_da_tabela').DataTable({
            "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado :/",
                "info": "Mostrando Página _PAGE_ de _PAGES_",
                "sSearch": "Pesquisar",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registro no total)",
                "oPaginate": {
                    "sFirst":    "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext":     "Próximo",
                    "sLast":     "Último"
                }
            }
        });
    });
</script>