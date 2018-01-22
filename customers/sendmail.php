<?php
/**
 * Created by PhpStorm.
 * User: Dionisio
 * Date: 14/12/2017
 * Time: 19:35
 */
$databaseHost = 'Brasilianet.ddns.com.br';
$databaseName = 'mkradius';
$databaseUsername = 'asterisk';
$databasePassword = 'rf1299adv2017';
$databasePort = '33306';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName, $databasePort);

// Consultas
$boletos = mysqli_query($mysqli,"SELECT titulo, datavenc FROM mkradius.vtab_titulos WHERE status='Vencido' AND cpf_cnpj='37101041817'");

$x = 0;

$result = count($boletos);

mysqli_query($mysqli,"UPDATE mkradius.vtab_titulos SET datavenc=(curdate() + interval 1 day) WHERE status='vencido' AND login='teste2'");


while($linha = mysqli_fetch_array($boletos)){
    $vboleto          = $linha["titulo"];
    $vboletoant[]     =$linha["titulo"];
    $vdatavenc[]      = $linha["datavenc"];

    $to = "adriano.vieira@vittel.com.br";
    $subject = '2°ViadeBoleto';
    $message = "SEGUE LINK PARA DOWNLOAD http://brasilianet.ddns.com.br:8081/boleto/boleto.php?titulo=$vboleto";
    $headers = 'From: contato@vittel.com.br' . "\r\n" .
        'Reply-To: contato@vittel.com.br' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);


}

while( $x <= $result ){

    mysqli_query($mysqli,"UPDATE mkradius.vtab_titulos SET datavenc='$vdatavenc[$x]' WHERE titulo='$vboletoant[$x]'");

    $x = $x +1;
}

mysqli_query($mysqli,"UPDATE sis_cliente SET bloqueado='sim' WHERE cpf_cnpj='37101041817'");

?>