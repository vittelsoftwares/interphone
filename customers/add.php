<?php
function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
  // Caracteres de cada tipo
$lmin = 'abcdefghijklmnopqrstuvwxyz';
$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$num = '1234567890';
$simb = '!@#$%*-';
// Variaveis internas
$retorno = '';
$caracteres = '';
// Agrupamos todos os caracteres que poderão ser utilizados
$caracteres .= $lmin;
if ($maiusculas) $caracteres .= $lmai;
if ($numeros) $caracteres .= $num;
if ($simbolos) $caracteres .= $simb;

// Calculamos o total de caracteres possíveis
$len = strlen($caracteres);
for ($n = 1; $n <= $tamanho; $n++) {

// Criamos um número aleatório de 1 até $len para pegar um dos caracteres
$rand = mt_rand(1, $len);

// Concatenamos um dos caracteres na variável $retorno
$retorno .= $caracteres[$rand-1];
}
return $retorno;

} 

?>

<?php 
      $senha = geraSenha(4, false, true);
      $senha2 = geraSenha(4, false, true);

    $hoje =  date_create('now', new DateTimeZone('America/Sao_Paulo'));
    $moradors = $hoje->format("Y-m-d H:i:s");
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


<?php include(HEADER_TEMPLATE); ?>

<h2><i class="fa fa-user-plus"></i> Novo Morador</h2>

<form action="send_post.php" method="post">
  <!-- area de campos do form -->
  <hr />
  <div class="row">
    <div class="form-group col-sm-1">
        <label for="campo2">QD/LT</label>
        <input type="text" class="form-control" name="quadralote" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="4" size="4" required>
    </div>
  </div>

    <div class="row">
    <div class="form-group col-sm-3">
        <label for="name">Proprietário/Nome</label>
        <input type="text" class="form-control" name="name" required>
    </div>

        <div class="form-group col-sm-2">
            <label for="campo3">Celular</label>
            <input type="text" class="form-control" name="celular1" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11" size="11" required>
        </div>
    </div>

          <input type="hidden" class="form-control" name="senhagerada" value="<?php echo $senha; ?>" readonly><!--Senha!-->
    <hr>

    <div class="row">
        <div class="form-group col-sm-3">
            <label for="name">Cônjuge</label>
            <input type="text" class="form-control" name="conjuge" >
        </div>

        <div class="form-group col-sm-2">
            <label for="campo3">Celular</label>
            <input type="text" class="form-control" name="celular2" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11" size="11" >
        </div>
    </div>
    <input type="hidden" class="form-control" name="senhagerada2" value="<?php echo $senha2; ?>" readonly><!--Senha2!-->

    <hr>
    <div class="row">
        <div class="form-group col-sm-2">
            <label for="name">Telefone Fixo</label>
            <input type="text" class="form-control" name="telfixo" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10" size="10">
        </div>

    <div class="form-group col-sm-2">
      <label for="campo3">Data de Criação</label>
      <input type="text" class="form-control" name="hoje" value="<?php echo $moradors; ?>" readonly>
    </div>




  <div id="actions">
    <div class="col-md-12">
      <button type="submit" class="btn btn-success">Cadastrar</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
        </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>