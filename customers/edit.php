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
  edit();
  include_once("connection.php");

//Armazena os numeros em uma variavel para procurar no sql
$cel1 = $morador['celular1'];
$cel2 = $morador['celular2'];
$usuario = $morador['quadraelote'];
$proprietario = $morador['name'];
$usuarioproprietario = $morador['usuario1'];
$usuarioconjuge = $morador['usuario2'];
$senhaproprietario = $morador['senha1'];
$senhaconjuge = $morador['senha2'];
$telefonefixo = $morador['telfixo'];
$conjuge = $morador['conjuge'];
$datacriacao = $morador['created'];


//Acha os ID's do morador na tabela Extensions
$connect = mysqli_connect("localhost","root","rf1299adv2017","asteriskrealtime");

$sql = mysqli_query($connect,"SELECT * FROM extensions WHERE priority = '5' AND exten = '_".$usuario."'");
$row=mysqli_fetch_array($sql);
$iden = $row["id"];

$connect = mysqli_connect("localhost","root","rf1299adv2017","asteriskrealtime");
$sql2 = mysqli_query($connect,"SELECT * FROM extensions WHERE priority = '6' AND exten = '_".$usuario."'");
$row2=mysqli_fetch_array($sql2);
$iden_exten2 = $row2["id"];

$connect = mysqli_connect("localhost","root","rf1299adv2017","asteriskrealtime");
$sql3 = mysqli_query($connect,"SELECT * FROM extensions WHERE priority = '7' AND exten = '_".$usuario."'");
$row3=mysqli_fetch_array($sql3);
$iden_exten3 = $row3["id"];

$connect = mysqli_connect("localhost","root","rf1299adv2017","asteriskrealtime");
$sql4 = mysqli_query($connect,"SELECT * FROM extensions WHERE priority = '5' AND exten = '_".$usuario."1'");
$row4=mysqli_fetch_array($sql4);
$iden_exten4 = $row4["id"];

$connect = mysqli_connect("localhost","root","rf1299adv2017","asteriskrealtime");
$sql5 = mysqli_query($connect,"SELECT * FROM extensions WHERE priority = '5' AND exten = '_".$usuario."2'");
$row5=mysqli_fetch_array($sql5);
$iden_exten5 = $row5["id"];


//Acha os ID's do morador na tabela sip_buddies
$connect = mysqli_connect("localhost","root","rf1299adv2017","asteriskrealtime");
$sql6 = mysqli_query($connect,"SELECT name, id FROM sip_buddies WHERE name = '".$usuario."'");
$row6=mysqli_fetch_array($sql6);
$iden6 = $row6["id"];

$connect = mysqli_connect("localhost","root","rf1299adv2017","asteriskrealtime");
$sql7 = mysqli_query($connect,"SELECT name, id FROM sip_buddies WHERE name = '".$usuario."1'");
$row7=mysqli_fetch_array($sql7);
$iden7 = $row7["id"];

$connect = mysqli_connect("localhost","root","rf1299adv2017","asteriskrealtime");
$sql8 = mysqli_query($connect,"SELECT name, id FROM sip_buddies WHERE name = '".$usuario."2'");
$row8=mysqli_fetch_array($sql8);
$iden8 = $row8["id"];

?>

<?php include(HEADER_TEMPLATE); ?>

<h2><i class="fa fa-refresh"></i> Atualizar Morador</h2>

<form action="update_post.php" method="post">
  <hr />

    <?php /* Envio dos ID's das duas tabelas*/ ?>
  <input type="hidden" class="form-control" name="identificador" value="<?php echo $iden; ?>">
  <input type="hidden" class="form-control" name="identificador2" value="<?php echo $iden_exten2; ?>">
  <input type="hidden" class="form-control" name="identificador3" value="<?php echo $iden_exten3; ?>">
  <input type="hidden" class="form-control" name="identificador4" value="<?php echo $iden_exten4; ?>">
  <input type="hidden" class="form-control" name="identificador5" value="<?php echo $iden_exten5; ?>">
  <input type="hidden" class="form-control" name="identificador6" value="<?php echo $iden6; ?>">
  <input type="hidden" class="form-control" name="identificador7" value="<?php echo $iden7; ?>">
  <input type="hidden" class="form-control" name="identificador8" value="<?php echo $iden8; ?>">
  <input type="hidden" class="form-control" name="idenmorador" value="<?php echo $morador['id']; ?>">


  <div class="row">
    <div class="form-group col-sm-1">
      <label for="campo2">QD/LT</label>
      <input type="text" class="form-control" name="quadralote" value="<?php echo $usuario; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="4" size="4" required readonly>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-sm-3">
      <label for="name">Proprietário/Nome</label>
      <input type="text" class="form-control" name="name" value="<?php echo $proprietario; ?>" required>
    </div>

    <div class="form-group col-sm-2">
      <label for="campo3">Celular</label>
      <input type="text" class="form-control" name="celular1" value="<?php echo $cel1; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11" size="11" required>
    </div>

    <div class="form-group col-sm-1">
      <label for="campo3">Usuario</label>
      <input type="text" class="form-control" name="usuario1" value="<?php echo $usuarioproprietario; ?>" readonly>
    </div>

    <div class="form-group col-sm-1">
      <label for="campo3">Senha</label>
      <input type="text" class="form-control" name="senhagerada" value="<?php echo $senhaproprietario; ?>" maxlength="4" size="4" required>
    </div>

  </div>

  <hr>

  <div class="row">
    <div class="form-group col-sm-3">
      <label for="name">Cônjuge</label>
      <input type="text" class="form-control" name="conjuge" value="<?php echo $conjuge; ?>" required>
    </div>

    <div class="form-group col-sm-2">
      <label for="campo3">Celular</label>
      <input type="text" class="form-control" name="celular2" value="<?php echo $cel2; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11" size="11" required>
    </div>

    <div class="form-group col-sm-1">
      <label for="campo3">Usuario</label>
      <input type="text" class="form-control" name="usuario2" value="<?php echo $usuarioconjuge; ?>" readonly>
    </div>

    <div class="form-group col-sm-1">
      <label for="campo3">Senha</label>
      <input type="text" class="form-control" name="senhagerada2" value="<?php echo $senhaconjuge; ?>"  maxlength="4" size="4" required>
    </div>

  </div>
  <hr>
  <div class="row">
    <div class="form-group col-sm-2">
      <label for="name">Telefone Fixo</label>
      <input type="text" class="form-control" name="telfixo" value="<?php echo $telefonefixo; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10" size="10" required>
    </div>

    <div class="form-group col-sm-2">
      <label for="campo3">Data de Criação</label>
      <input type="text" class="form-control" name="hoje" value="<?php echo $datacriacao; ?>" readonly>
    </div>

  <div id="actions">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary">Salvar</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>