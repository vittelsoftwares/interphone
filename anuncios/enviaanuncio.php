<?php
include_once("connection.php");
?>
<?php

$sql_code = "SELECT quadraelote, celular1, celular2, telfixo FROM moradores";
$execute = $mysqli->query($sql_code) or die($mysqli->error);
$morador = $execute->fetch_assoc();
$num = $execute->num_rows;

$moradorselect = $_POST['moradorselecionado'];
$mtodos = $_POST['moradortodos'];
$iden = $_POST['idanuncio'];
$destino = $_POST['destino'];
$nomedoaudio = $_POST['audioselecionado'];
$dpto = $_POST['departamento'];
$operador = $_POST['operador'];

//Remover .SLN do nome do arquivo
$removesln = array(".sln");
$nomedoaudio2 = str_replace($removesln, "", $nomedoaudio);

//Enviando os dados para o banco de dados caso TODOS moradores foram selecionados
if (isset($_POST['moradortodos'])) {
    if ($num > 0) {
        do {
            mysqli_query($mysqli, "INSERT INTO anuncios (nome, operador, audio, destino, destino_discagem, id_anuncio, celular1, celular2, telfixo) VALUES ('$_POST[nome]', '$_POST[operador]', '$_POST[audioselecionado]', '$_POST[destino]', '$morador[quadraelote]', '$iden', '$morador[celular1]', '$morador[celular2]', '$morador[telfixo]')");
        } while ($morador = $execute->fetch_assoc());
    }else{
        echo "Não existe moradores!";
    }
    //Enviando os dados para o banco de dados caso ALGUNS moradores foram selecionados
} elseif (empty($mtodos)) { foreach ($moradorselect as $quadraelote) {

    $sql_code3 = "SELECT celular1, celular2, telfixo FROM moradores WHERE quadraelote='$quadraelote'";
    $executa = $mysqli->query($sql_code3) or die($mysqli->error);
    $morador3 = $executa->fetch_assoc();
    $cel1 = $morador3["celular1"];
    $cel2 = $morador3["celular2"];
    $fixo = $morador3["telfixo"];

    mysqli_query($mysqli, "INSERT INTO anuncios (nome, operador, audio, destino, destino_discagem, id_anuncio, celular1, celular2, telfixo) VALUES ('$_POST[nome]', '$_POST[operador]', '$_POST[audioselecionado]', '$_POST[destino]', '$quadraelote', '$iden', '$cel1', '$cel2', '$fixo')");
    }
} else {
    echo "Erro";
}

$sql_code2 = "SELECT id, destino_discagem, nome FROM anuncios WHERE id_anuncio = '$iden'";
$execute2 = $mysqli->query($sql_code2) or die($mysqli->error);
$morador2 = $execute2->fetch_assoc();
$num2 = $execute2->num_rows;

$query = mysqli_query($mysqli,"SELECT destino_discagem, celular1, celular2, telfixo FROM anuncios WHERE id_anuncio = '$iden'");
while($row = mysqli_fetch_array($query)){
    $linha[] = $row['destino_discagem'];
    $linha2[] = $row['celular1'];
    $linha3[] = $row['celular2'];
    $linha4[] = $row['telfixo'];
}

$i=0;
$canais = 3;

//Gera o arquivo
if ($destino == "app"){

while($num2 > 0 ){
if( count(glob("/var/spool/asterisk/outgoing/{*.call}",GLOB_BRACE)) < $canais ){
$id             = $morador2['id'];
$numero         = $linha[$i];
$nomeanuncio    = $morador2['nome'];
$channel        = "Channel: SIP/" . $numero."1";
$channel2       = "Channel: SIP/" . $numero."2";
$callerid       = "Callerid: ".$operador." ".$dpto."";
$maxretries     = "MaxRetries: 2";
$retrytime      = "RetryTime: 60";
$waittime       = "WaitTime: 30";
$context        = "Context: from-users";
$extension      = "Extension: s";
$priority       = "Priority: 1";
$set            = "Set: CDR(userfield)= ".$nomeanuncio;
$app            = "Application: Playback";
$data           = "Data: /var/lib/asterisk/sounds/pt_BR/" . $nomedoaudio2;

//Arquivo do app do Proprietario
$dados = $channel . PHP_EOL . $callerid . PHP_EOL . $maxretries . PHP_EOL . $retrytime . PHP_EOL . $waittime . PHP_EOL . $context . PHP_EOL . $extension . PHP_EOL . $priority . PHP_EOL . $set . PHP_EOL . $app . PHP_EOL . $data . PHP_EOL;
$file  = fopen("audio/".$numero."1.call","a");
fwrite($file,$dados);
fclose($file);

//Arquivo do app do Conjuge
$dados2 = $channel2 . PHP_EOL . $callerid . PHP_EOL . $maxretries . PHP_EOL . $retrytime . PHP_EOL . $waittime . PHP_EOL . $context . PHP_EOL . $extension . PHP_EOL . $priority . PHP_EOL . $set . PHP_EOL . $app . PHP_EOL . $data . PHP_EOL;
$file2  = fopen("audio/".$numero."2.call","a");
fwrite($file2,$dados2);
fclose($file2);
shell_exec("sudo mv audio/".$numero."1.call /var/spool/asterisk/outgoing/".$numero."1.call");
shell_exec("sudo mv audio/".$numero."2.call /var/spool/asterisk/outgoing/".$numero."2.call");

$num2 = $num2 -1;
$i    = $i + 1;
mysqli_query($mysqli, "UPDATE anuncios set status = 'Exito' WHERE destino_discagem ='$numero' AND id_anuncio = '$iden'");
}
sleep(2);
}

}elseif ($destino == "celfixo"){

    while($num2 > 0 ){
        if( count(glob("/var/spool/asterisk/outgoing/{*.call}",GLOB_BRACE)) < $canais ){
            $id             = $morador2['id'];
            $numero         = $linha2[$i];
            $numero2        = $linha3[$i];
            $numero3        = $linha4[$i];
            $nomeanuncio    = $morador2['nome'];
            $channel        = "Channel: SIP/Vittel/55" . $numero3;
            $channel2       = "Channel: SIP/Vittel/55" . $numero;
            $channel3       = "Channel: SIP/Vittel/55" . $numero2;
            $callerid       = "Callerid: ".$operador." ".$dpto."";
            $maxretries     = "MaxRetries: 2";
            $retrytime      = "RetryTime: 60";
            $waittime       = "WaitTime: 30";
            $context        = "Context: from-external";
            $extension      = "Extension: s";
            $priority       = "Priority: 1";
            $set            = "Set: CDR(userfield)= ".$nomeanuncio;
            $app            = "Application: Playback";
            $data           = "Data: /var/lib/asterisk/sounds/pt_BR/" . $nomedoaudio2;

            //Arquivo do telefone fixo
            $dados = $channel . PHP_EOL . $callerid . PHP_EOL . $maxretries . PHP_EOL . $retrytime . PHP_EOL . $waittime . PHP_EOL . $context . PHP_EOL . $extension . PHP_EOL . $priority . PHP_EOL . $set . PHP_EOL . $app . PHP_EOL . $data . PHP_EOL;
            $file  = fopen("audio/".$numero3.".call","a");
            fwrite($file,$dados);
            fclose($file);

            //Arquivo do Celular do Proprietario
            $dados2 = $channel2 . PHP_EOL . $callerid . PHP_EOL . $maxretries . PHP_EOL . $retrytime . PHP_EOL . $waittime . PHP_EOL . $context . PHP_EOL . $extension . PHP_EOL . $priority . PHP_EOL . $set . PHP_EOL . $app . PHP_EOL . $data . PHP_EOL;
            $file2  = fopen("audio/".$numero.".call","a");
            fwrite($file2,$dados2);
            fclose($file2);

            //Arquivo do Celular do Conjuge
            $dados3 = $channel3 . PHP_EOL . $callerid . PHP_EOL . $maxretries . PHP_EOL . $retrytime . PHP_EOL . $waittime . PHP_EOL . $context . PHP_EOL . $extension . PHP_EOL . $priority . PHP_EOL . $set . PHP_EOL . $app . PHP_EOL . $data . PHP_EOL;
            $file3  = fopen("audio/".$numero2.".call","a");
            fwrite($file3,$dados3);
            fclose($file3);

            shell_exec("sudo mv audio/".$numero3.".call /var/spool/asterisk/outgoing/".$numero3.".call");
            shell_exec("sudo mv audio/".$numero.".call /var/spool/asterisk/outgoing/".$numero.".call");
            shell_exec("sudo mv audio/".$numero2.".call /var/spool/asterisk/outgoing/".$numero2.".call");

            $num2 = $num2 -1;
            $i    = $i + 1;
            mysqli_query($mysqli, "UPDATE anuncios SET status = 'Exito' WHERE destino ='celfixo' AND id_anuncio = '$iden'");
        }
        sleep(2);
    }

}elseif ($destino == "ambos"){

    while($num2 > 0 ){
        if( count(glob("/var/spool/asterisk/outgoing/{*.call}",GLOB_BRACE)) < $canais ){
            $id             = $morador2['id'];
            $numero         = $linha[$i];
            $nomeanuncio    = $morador2['nome'];
            $channel        = "Channel: SIP/" . $numero;
            $callerid       = "Callerid: ".$operador." ".$dpto."";
            $maxretries     = "MaxRetries: 2";
            $retrytime      = "RetryTime: 60";
            $waittime       = "WaitTime: 30";
            $context        = "Context: from-internal";
            $extension      = "Extension: s";
            $priority       = "Priority: 1";
            $set            = "Set: CDR(userfield)= ".$nomeanuncio;
            $app            = "Application: Playback";
            $data           = "Data: /var/lib/asterisk/sounds/pt_BR/" . $nomedoaudio2;

            //Arquivo para ligar para o proprietário em todos os destinos (App, Cel1, Cel2 e Fixo)
            $dados = $channel . PHP_EOL . $callerid . PHP_EOL . $maxretries . PHP_EOL . $retrytime . PHP_EOL . $waittime . PHP_EOL . $context . PHP_EOL . $extension . PHP_EOL . $priority . PHP_EOL . $set . PHP_EOL . $app . PHP_EOL . $data . PHP_EOL;
            $file  = fopen("audio/".$numero.".call","a");
            fwrite($file,$dados);
            fclose($file);
            shell_exec("sudo mv audio/".$numero.".call /var/spool/asterisk/outgoing/".$numero.".call");
            $num2 = $num2 -1;
            $i    = $i + 1;
            mysqli_query($mysqli, "UPDATE anuncios set status = 'Exito' WHERE destino_discagem ='$numero' AND id_anuncio = '$iden'");
        }
        sleep(2);
    }
}

//Atualiza ID da tabela
mysqli_query($mysqli,"ALTER TABLE audios AUTO_INCREMENT = 1");
mysqli_query($mysqli,"ALTER TABLE anuncios AUTO_INCREMENT = 1");

?>
<?php
header("location: ../anuncios/index.php"); /* Redireciona o navegador */
exit;
?>

