<?php
require_once('functions.php');
edit();
include_once("connection.php");

?>
<?php

//Enviando os dados para o banco de dados.
mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app) VALUES ('from-internal', '_$_POST[quadralote]', '1', 'Answer')");

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$_POST[quadralote]', '2', 'Dial', 'SIP/$_POST[quadralote]1,15,t' )");

$dial = '$["${DIALSTATUS}" = "NOANSWER"]?:4:5';

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$_POST[quadralote]', '3', 'Dial', 'SIP/$_POST[quadralote]2,15,t')");

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$_POST[quadralote]', '4', 'Playback', 'followme/pls-hold-while-try')");

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$_POST[quadralote]', '5', 'Dial', 'SIP/Vittel/55$_POST[telfixo],30,TtM(execamd)')");

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$_POST[quadralote]', '6', 'Dial', 'SIP/Vittel/55$_POST[celular1],30,TtM(execamd2)')");

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$_POST[quadralote]', '7', 'Dial', 'SIP/Vittel/55$_POST[celular2],30,Tt')");

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app) VALUES ('from-internal', '_$_POST[quadralote]', '8', 'Hangup')");
//Enviando para o usuario 1
mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app) VALUES ('from-internal', '_$_POST[quadralote]1', '1', 'Answer')");

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$_POST[quadralote]1', '2', 'Dial', 'SIP/$_POST[quadralote]1,15,t' )");

$dial = '$["${DIALSTATUS}" = "NOANSWER"]?:4:5';

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$_POST[quadralote]1', '3', 'GotoIf', '$dial')");

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$_POST[quadralote]1', '4', 'Playback', 'followme/pls-hold-while-try')");

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$_POST[quadralote]1', '5', 'Dial', 'SIP/Vittel/55$_POST[celular1]')");

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app) VALUES ('from-internal', '_$_POST[quadralote]1', '6', 'Hangup')");
// FIM
//Enviando para o usuario 2
mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app) VALUES ('from-internal', '_$_POST[quadralote]2', '1', 'Answer')");

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$_POST[quadralote]2', '2', 'Dial', 'SIP/$_POST[quadralote]2,15,t' )");

$dial = '$["${DIALSTATUS}" = "NOANSWER"]?:4:5';

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$_POST[quadralote]2', '3', 'GotoIf', '$dial')");

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$_POST[quadralote]2', '4', 'Playback', 'followme/pls-hold-while-try')");

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$_POST[quadralote]2', '5', 'Dial', 'SIP/Vittel/55$_POST[celular2]')");

mysqli_query($mysqli,"INSERT INTO extensions (context, exten, priority, app) VALUES ('from-internal', '_$_POST[quadralote]2', '6', 'Hangup')");
// FIM
mysqli_query($mysqli,"INSERT INTO sip_buddies (name, defaultuser, secret, callerid) VALUES ( '$_POST[quadralote]', '$_POST[quadralote]', '172839', '$_POST[name]')");

mysqli_query($mysqli,"INSERT INTO sip_buddies (name, defaultuser, secret, callerid, context) VALUES ( '$_POST[quadralote]1', '$_POST[quadralote]1', '$_POST[senhagerada]', '$_POST[name]', 'from-users')");

mysqli_query($mysqli,"INSERT INTO sip_buddies (name, defaultuser, secret, callerid, context) VALUES ( '$_POST[quadralote]2', '$_POST[quadralote]2', '$_POST[senhagerada2]', '$_POST[name]', 'from-users')");


//Adicionando na tabela de visualização
mysqli_query($mysqli,"INSERT INTO moradores (id, name, quadraelote, usuario1, senha1, celular1, usuario2, senha2, celular2, created, telfixo, conjuge) VALUES ( '$id_destino', '$_POST[name]', '$_POST[quadralote]', '$_POST[quadralote]1', '$_POST[senhagerada]', '$_POST[celular1]', '$_POST[quadralote]2', '$_POST[senhagerada2]', '$_POST[celular2]', '$_POST[hoje]', '$_POST[telfixo]', '$_POST[conjuge]')");

//Atualiza ID da tabela
mysqli_query($mysqli,"ALTER TABLE extensions AUTO_INCREMENT = 1");
mysqli_query($mysqli,"ALTER TABLE moradores AUTO_INCREMENT = 1");
mysqli_query($mysqli,"ALTER TABLE sip_buddies AUTO_INCREMENT = 1");
?>
<?php
header("location: ../customers"); /* Redireciona o navegador */

exit;
?>

