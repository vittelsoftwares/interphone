<?php
$hoje2 =  date_create('now', new DateTimeZone('America/Sao_Paulo'));
$datacriacao = $hoje2->format("Y-m-d H:i:s");
?>

<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$nivel_necessario = 3;

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] <$nivel_necessario)) {
    // Destrói a sessão por segurança
    // Redireciona o visitante de volta pro login
    header("Location: /interphone"); exit;

}
?>

<?php
require_once('functions.php');
add();
include_once("connection.php");

?>
<?php
//consulta ID de anuncio
$sql = mysqli_query($mysqli,"SELECT MAX(id_anuncio) FROM anuncios");
$row=mysqli_fetch_array($sql);
$iden = $row[0];
$idanuncio = $iden +1;

//Recebe dados do BD para mostrar os audios disponiveis
$sql_code = "select id, audio from audios";
$execute = $mysqli->query($sql_code) or die($mysqli->error);
$audios = $execute->fetch_assoc();
$num = $execute->num_rows;

//Recebe dados do DB dos moradores
$page = 0;
$intervalInDays = 30;

$itens_por_pagina = 999999;
// Pegar a pagina atual
$pagina = intval($_GET['pagina']);

$item = $pagina*$itens_por_pagina;
// Puxar moradores do banco
$sql_code2 = "SELECT id, name, quadraelote FROM moradores ORDER BY id DESC";
$execute2 = $mysqli->query($sql_code2) or die($mysqli->error);
$moradores = $execute2->fetch_assoc();
$num2 = $execute2->num_rows;

// Pega a qtd total de objetos no banco de dados
$num_total = $mysqli->query("SELECT * FROM moradores")->num_rows;

// Definir numero de páginas
$num_paginas = ceil($num_total/$itens_por_pagina);
?>
<?php include(HEADER_TEMPLATE);
include('modalaudio.php');
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script language="JavaScript">
    function toggle(source) {
        checkboxes = document.getElementsByName('selectall');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }

    }

    $(function() {
        $('#departamento').on('keypress', function(e) {
            if (e.which == 32)
                return false;
        });
    });
</script>

<style>
    /* Ativa posicionamento absoluto */
    .inner-addon {
        position: relative;
    }

    /* estilo do icone */
    .inner-addon .glyphicon {
        position: absolute;
        padding: 10px;
        pointer-events: none;
    }

    /* alinha o icone */
    .left-addon .glyphicon  { left:  0px;}
    .right-addon .glyphicon { right: 0px;}

    /* adiciona margem  */
    .left-addon input  { padding-left:  30px; }
    .right-addon input { padding-right: 30px; }

    .padding {
        padding: 6px 25px;
    }
</style>

<h2><i class="fa fa-bullhorn"></i> Novo Anúncio</h2>
<?php if ($_GET["erro"] == 01){?>
    <div id="msgerro" class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Sucesso:</span>
        Audio enviado com sucesso!
    </div><?php }elseif ($_GET["erro"] == 02){?>
<div id="msgerro" class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Erro:</span>
    Não foi possivel enviar o audio!
</div><?php }?>
<div class="container">
    <div class="row">
        <form action="enviaanuncio.php" method="post">
            <!-- area de campos do form -->
            <div class="col-xs-6">
                <hr />
                <div class="row">
                    <div class="form-group .col-xs-6 .col-sm-3">
                        <label for="numeroanuncio">Número do Anúncio</label>
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon-list-alt"></i>
                            <input type="text" class="form-control" name="idanuncio" value="<?php echo $idanuncio;?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="4" size="4" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group .col-xs-6 .col-sm-3">
                        <label for="nomeanuncio">Nome do Anúncio</label>
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon-pencil"></i>
                            <input type="text" class="form-control" name="nome" placeholder="Digite o nome do anúncio" required>
                        </div>
                    </div>

                    <div class="form-group col-xs-6 col-sm-6">
                        <label for="operadornome">Operador</label>
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon-user"></i>
                            <input type="text" class="form-control" name="operador" placeholder="Informe o seu nome" required>
                        </div>
                    </div>

                    <div class="form-group col-xs-6 col-sm-6">
                        <label for="departamento">Departamento</label>
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon-briefcase"></i>
                            <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Informe o seu departamento" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="jumbotron">
                        <div class="form-group .col-xs-6 .col-sm-3">
                            <label for="audios">Audios</label>
                            <div class="inner-addon left-addon">
                                <i class="glyphicon glyphicon-volume-up"></i>
                                <select name="audioselecionado" class="form-control padding">
                                    <?php if($num > 0){ ?>
                                        <?php do{ ?>
                                            <option value="<?php echo $audios['audio']; ?>"><?php echo $audios['audio']; ?></option>
                                        <?php } while($audios = $execute->fetch_assoc()); ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group .col-xs-6 .col-sm-3">
                            <label for="importaraudio">Importar Audio</label>
                            <a href="#" class="form-control btn btn-primary text-right" data-toggle="modal" data-target="#import-modal"><i class="fa fa-upload"></i> Importar</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group .col-xs-6 .col-sm-3">
                        <label for="destino">Destino</label>
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon glyphicon-share"></i>
                            <select name="destino" class="form-control padding" required>
                                <option value="app">Aplicativo</option>
                                <option value="celfixo">Celulares/Fixo</option>
                                <option value="ambos">Ambos</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group .col-xs-6 .col-sm-3">
                        <label for="datacriacao">Data de Criação</label>
                        <input type="text" class="form-control" name="hoje" value="<?php echo $datacriacao; ?>" readonly>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div id="actions">
                        <div class="form-group .col-xs-6 .col-sm-3">
                            <button type="submit" class="btn btn-success">Cadastrar Anuncio</button>
                            <a href="/interphone" class="btn btn-default">Cancelar</a>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-xs-6">
            <hr>
            <label for="selecionamorador">Selecione os moradores que irão receber o Anúncio:</label>
            <br>
            <label for="selecionatodos">Enviar anúncio para todos <input type="checkbox" name="moradortodos" id="moradortodos" value="1"></label>
            <br>
            <hr style="    margin-top: 0px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid rgba(229, 222, 225, 0);">
            <?php if($num2 > 0){ ?>
                <table data-order='[[ 1, "desc" ]]' data-page-length='10' class="table table-bordered table-hover" id="id_da_tabela2" style="font-size: 12px">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Quadra/Lote</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do{ ?>
                        <tr>
                            <td><input type="checkbox" name="moradorselecionado[]" id="moradorselecionado" value="<?php echo $moradores['quadraelote']; ?>"></td>
                            <td><?php echo $moradores['id']; ?></td>
                            <td><?php echo $moradores['name']; ?></td>
                            <td><?php echo $moradores['quadraelote']; ?></td>
                        </tr>
                    <?php } while($moradores = $execute2->fetch_assoc()); ?>
                    </tbody>
                </table>
            <?php } ?>

        </div>
        </form>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('#id_da_tabela2').DataTable({
            "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página ",
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

