<?php 
 include_once("connection.php");

?>
<?php
//Exclusao da tabela extensions
$iden = $_GET["id"];
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`login` WHERE id='$iden'");

//Atualiza ID da tabela
mysqli_query($mysqli,"ALTER TABLE login AUTO_INCREMENT = 1");
?>
<?php
header("location: /interphone/novouser.php?excluir=01"); /* Redireciona o navegador */

exit;
?>


