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

//Acha os ID's do morador na tabela Extensions
$sql = mysqli_query($mysqli,"SELECT appdata, exten, id FROM extensions WHERE appdata = 'SIP/".$usuario."1,15,t' AND exten = '_".$usuario."'");
$row=mysqli_fetch_array($sql);
$iden = $row["id"];

//Achando ID do Answer Priority=1
$answer1 = $iden - 1;
//Achando ID do Dial Priority=3
$dial1 = $iden + 1;
//Achando ID do Playback Priority=4
$playback1 = $iden + 2;
//Achando ID do Dial Priority=5
$dial2 = $iden + 3;
//Achando ID do Dial Priority=6
$dial3 = $iden + 4;
//Achando ID do Dial Priority=7
$dial4 = $iden + 5;
//Achando ID do Hangup Priority=8
$hangup1 = $iden + 6;

//Achando ID do Answer2 Exten=USUARIO1
$answer2 = $iden + 7;
//Achando ID do Dial2
$dial5 = $iden + 8;
//Achando ID do Gotoif2
$gotoif2 = $iden + 9;
//Achando ID do Playback2
$playback2 = $iden + 10;
//Achando ID do Dial2 Exten=USUARIO1
$dial6 = $iden + 11;
//Achando ID do Hangup2
$hangup2 = $iden + 12;

//Achando ID do Answer3 Exten=USUARIO2
$answer3 = $iden + 13;
//Achando ID do Dial3
$dial7 = $iden + 14;
//Achando ID do Gotoif3
$gotoif3 = $iden + 15;
//Achando ID do Playback3
$playback3 = $iden + 16;
//Achando ID do Dial3 Exten=USUARIO2
$dial8 = $iden + 17;
//Achando ID do Hangup3
$hangup3 = $iden + 18;


//Acha os ID's do morador na tabela sip_buddies
$sql2 = mysqli_query($mysqli,"SELECT name, id FROM sip_buddies WHERE name = '".$usuario."'");
$row2=mysqli_fetch_array($sql2);
$iden2 = $row2["id"];

$sql3 = mysqli_query($mysqli,"SELECT name, id FROM sip_buddies WHERE name = '".$usuario."1'");
$row3=mysqli_fetch_array($sql3);
$iden3 = $row3["id"];

$sql4 = mysqli_query($mysqli,"SELECT name, id FROM sip_buddies WHERE name = '".$usuario."2'");
$row4=mysqli_fetch_array($sql4);
$iden4 = $row4["id"];

?>
<?php include('modal.php'); ?>
<?php include(HEADER_TEMPLATE); ?>

  <h2 style="color: #d9534f;"><i class="fa fa-trash"></i> Exclusão de morador</h2>

  <form action="delete_post.php" method="post">
    <hr />
    <div class="row">
      <div class="form-group col-md-7">
        <label for="name">Proprietário/Nome</label>
        <input type="text" class="form-control" name="name" value="<?php echo $morador['name']; ?>" required readonly>
      </div>

      <?php /* Envio dos ID's das duas tabelas*/ ?>
      <input type="hidden" class="form-control" name="identificador" value="<?php echo $iden; ?>">
      <input type="hidden" class="form-control" name="identificador2" value="<?php echo $answer1; ?>">
      <input type="hidden" class="form-control" name="identificador3" value="<?php echo $dial1; ?>">
      <input type="hidden" class="form-control" name="identificador4" value="<?php echo $playback1; ?>">
      <input type="hidden" class="form-control" name="identificador5" value="<?php echo $dial2; ?>">
      <input type="hidden" class="form-control" name="identificador6" value="<?php echo $dial3; ?>">
      <input type="hidden" class="form-control" name="identificador7" value="<?php echo $dial4; ?>">
      <input type="hidden" class="form-control" name="identificador8" value="<?php echo $hangup1; ?>">
      <input type="hidden" class="form-control" name="identificador9" value="<?php echo $answer2; ?>">
      <input type="hidden" class="form-control" name="identificador10" value="<?php echo $dial5; ?>">
      <input type="hidden" class="form-control" name="identificador11" value="<?php echo $gotoif2; ?>">
      <input type="hidden" class="form-control" name="identificador12" value="<?php echo $playback2; ?>">
      <input type="hidden" class="form-control" name="identificador13" value="<?php echo $dial6; ?>">
      <input type="hidden" class="form-control" name="identificador14" value="<?php echo $hangup2; ?>">
      <input type="hidden" class="form-control" name="identificador15" value="<?php echo $answer3; ?>">
      <input type="hidden" class="form-control" name="identificador16" value="<?php echo $dial7; ?>">
      <input type="hidden" class="form-control" name="identificador17" value="<?php echo $gotoif3; ?>">
      <input type="hidden" class="form-control" name="identificador18" value="<?php echo $playback3; ?>">
      <input type="hidden" class="form-control" name="identificador19" value="<?php echo $dial8; ?>">
      <input type="hidden" class="form-control" name="identificador20" value="<?php echo $hangup3; ?>">

      <input type="hidden" class="form-control" name="idenmorador" value="<?php echo $morador['id']; ?>">

      <input type="hidden" class="form-control" name="idsip2" value="<?php echo $iden2; ?>">
      <input type="hidden" class="form-control" name="idsip3" value="<?php echo $iden3; ?>">
      <input type="hidden" class="form-control" name="idsip4" value="<?php echo $iden4; ?>">

      <div class="form-group col-md-3">
        <label for="campo2">Quadra/Lote</label>
        <input type="text" class="form-control" name="quadraelote" value="<?php echo $morador['quadraelote']; ?>" disabled>

      </div>

      <div class="form-group col-md-2">
        <label for="campo3">Celular 1</label>
        <input type="text" class="form-control" name="celular1" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11" size="11" required value="<?php echo $morador['celular1']; ?>" readonly>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-5">
        <label for="campo1">Celular 2</label>
        <input type="text" class="form-control" name="celular2" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11" size="11" required value="<?php echo $morador['celular2']; ?>" readonly>
      </div>

      <div class="form-group col-md-2">
        <label for="campo3">Data de Cadastro</label>
        <input type="text" class="form-control" name="created" disabled value="<?php echo $morador['created']; ?>" readonly>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-3">
        <label for="campo1">Senha 1</label>
        <input type="text" class="form-control" name="senha1" maxlength="4" size="4" value="<?php echo $morador['senha1']; ?>" readonly>
      </div>

      <div class="form-group col-md-3">
        <label for="campo1">Senha 2</label>
        <input type="text" class="form-control" name="senha2" maxlength="4" size="4" value="<?php echo $morador['senha2']; ?>" readonly>
      </div>

    </div>
    <div id="actions" class="row">
      <div class="col-md-12">
        <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
        <a href="index.php" class="btn btn-primary">Cancelar</a>
      </div>
    </div>
  </form>

<?php include(FOOTER_TEMPLATE); ?>