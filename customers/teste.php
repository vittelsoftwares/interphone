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

//mysqli_query($mysqli,"UPDATE sis_lanc SET datavenc=(curdate() + interval 1 day), status='aberto' WHERE status='vencido' AND login='teste2'");

$x = 0;

while($linha = mysqli_fetch_array($boletos)) {
    $vboleto      = $linha["titulo"];
    $vdatavenc[]      = $linha["datavenc"];

}
$result = count($boletos);

while( $x <= $result ){

    echo $vdatavenc[$x];
    echo "<hr>";
    $x = $x +1;
}

//mysqli_query($mysqli,"UPDATE sis_cliente SET bloqueado='sim' WHERE cpf_cnpj='37101041817'");

?>