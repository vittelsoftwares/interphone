<?php 
  require_once('functions.php'); 
  edit();
  include_once("connection.php");

?>
<?php
//Exclusao da tabela extensions

mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador2]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador3]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador4]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador5]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador6]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador7]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador8]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador9]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador10]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador11]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador12]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador13]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador14]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador15]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador16]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador17]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador18]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador19]'");
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`extensions` WHERE id='$_POST[identificador20]'");

//Exclusao da tabela sip_buddies
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`sip_buddies` WHERE id='$_POST[idsip2]'");

mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`sip_buddies` WHERE id='$_POST[idsip3]'");

mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`sip_buddies` WHERE id='$_POST[idsip4]'");
//Exclusao da tabela moradores
mysqli_query($mysqli,"DELETE FROM `asteriskrealtime`.`moradores` WHERE id='$_POST[idenmorador]'");

//Atualiza ID da tabela
mysqli_query($mysqli,"ALTER TABLE extensions AUTO_INCREMENT = 1");
mysqli_query($mysqli,"ALTER TABLE moradores AUTO_INCREMENT = 1");
mysqli_query($mysqli,"ALTER TABLE sip_buddies AUTO_INCREMENT = 1");
?>
<?php
header("location: ../customers"); /* Redireciona o navegador */

exit;
?>


