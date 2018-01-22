<?php 
  require_once('functions.php'); 
  edit();
  include_once("connection.php");

?>
<?php
//Atualizando a tabela extensions
mysqli_query($mysqli,"UPDATE extensions SET appdata='SIP/Vittel/55$_POST[telfixo],30,TtM(execamd)' WHERE id= '$_POST[identificador]'");

mysqli_query($mysqli,"UPDATE extensions SET appdata='SIP/Vittel/55$_POST[celular1],30,TtM(execamd2)' WHERE id= '$_POST[identificador2]'");

mysqli_query($mysqli,"UPDATE extensions SET appdata='SIP/Vittel/55$_POST[celular2],30,Tt' WHERE id= '$_POST[identificador3]'");

mysqli_query($mysqli,"UPDATE extensions SET appdata='SIP/Vittel/55$_POST[celular1]' WHERE id= '$_POST[identificador4]'");

mysqli_query($mysqli,"UPDATE extensions SET appdata='SIP/Vittel/55$_POST[celular2]' WHERE id= '$_POST[identificador5]'");

//Atualizando a tabela sip_buddies
mysqli_query($mysqli,"UPDATE sip_buddies SET callerid='$_POST[name]' WHERE id= '$_POST[identificador6]'");

mysqli_query($mysqli,"UPDATE sip_buddies SET callerid='$_POST[name]' WHERE id= '$_POST[identificador7]'");

mysqli_query($mysqli,"UPDATE sip_buddies SET callerid='$_POST[name]' WHERE id= '$_POST[identificador8]'");

mysqli_query($mysqli,"UPDATE sip_buddies SET secret='$_POST[senhagerada]' WHERE id= '$_POST[identificador7]'");

mysqli_query($mysqli,"UPDATE sip_buddies SET secret='$_POST[senhagerada2]' WHERE id= '$_POST[identificador8]'");

//Atualizando a tabela moradores
mysqli_query($mysqli,"UPDATE moradores SET celular1='$_POST[celular1]' WHERE id='$_POST[idenmorador]'");

mysqli_query($mysqli,"UPDATE moradores SET celular2='$_POST[celular2]' WHERE id='$_POST[idenmorador]'");

mysqli_query($mysqli,"UPDATE moradores SET name='$_POST[name]' WHERE id='$_POST[idenmorador]'");

mysqli_query($mysqli,"UPDATE moradores SET senha1='$_POST[senhagerada]' WHERE id='$_POST[idenmorador]'");

mysqli_query($mysqli,"UPDATE moradores SET senha2='$_POST[senhagerada2]' WHERE id='$_POST[idenmorador]'");

mysqli_query($mysqli,"UPDATE moradores SET conjuge='$_POST[conjuge]' WHERE id='$_POST[idenmorador]'");

mysqli_query($mysqli,"UPDATE moradores SET telfixo='$_POST[telfixo]' WHERE id='$_POST[idenmorador]'");

//Atualiza ID da tabela
mysqli_query($mysqli,"ALTER TABLE extensions AUTO_INCREMENT = 1");
mysqli_query($mysqli,"ALTER TABLE moradores AUTO_INCREMENT = 1");
mysqli_query($mysqli,"ALTER TABLE sip_buddies AUTO_INCREMENT = 1");
?>
<?php
header("location: ../customers"); /* Redireciona o navegador */

exit;
?>


