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

//Estava gerando uma senha igual para todos os moradores, coloquei no While.
//$senha1 = geraSenha(4, false, true);
//$senha2 = geraSenha(4, false, true);

$hoje =  date_create('now', new DateTimeZone('America/Sao_Paulo'));
$criado = $hoje->format("Y-m-d H:i:s");

?>
<?php
	//$dados = $_FILES['arquivo'];
	//var_dump($dados);

    $conn = new mysqli("localhost","root","rf1299adv2017","asteriskrealtime");
    mysqli_set_charset($conn,"utf8");

    $arquivo = $_FILES["file"]["tmp_name"];
    $nome = $_FILES["file"]["name"];

    $ext = explode(".", $nome);

    $extensao = end($ext);

    if($extensao != "csv"){
        echo "Extensão Inválida";
    }else{
        $objeto = fopen($arquivo, 'r');

            while(($dados = fgetcsv($objeto, 1000, ";")) !== false )
        {
            $nome           = utf8_encode($dados[0]);
            $conjuge        = utf8_encode($dados[1]);
            $quadraelote    = utf8_encode($dados[2]);
            //$usuario1       = utf8_encode($dados[3]);
            $senha1 = geraSenha(4, false, true);
            $celular1       = utf8_encode($dados[3]);
            //$usuario2       = utf8_encode($dados[6]);
            $senha2 = geraSenha(4, false, true);
            $celular2       = utf8_encode($dados[4]);
            $telfixo        = utf8_encode($dados[5]);
            //$criado         = utf8_encode($dados[10]);
            //$modificado     = utf8_encode($dados[11]);

            //Inserção dos dados do CSV
            $result1 = $conn->query("INSERT INTO extensions (context, exten, priority, app) VALUES ('from-internal', '_$quadraelote', '1', 'Answer')");

            $result2 = $conn->query("INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$quadraelote', '2', 'Dial', 'SIP/".$quadraelote."1,15,t' )");

            $dial = '$["${DIALSTATUS}" = "NOANSWER"]?:4:5';

            $result3 = $conn->query("INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$quadraelote', '3', 'Dial', 'SIP/".$quadraelote."2,15,t')");

            $result4 = $conn->query("INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$quadraelote', '4', 'Playback', 'followme/pls-hold-while-try')");

            $result5 = $conn->query("INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$quadraelote', '5', 'Dial', 'SIP/Vittel/55".$telfixo.",30,TtM(execamd)')");

            $result6 = $conn->query("INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$quadraelote', '6', 'Dial', 'SIP/Vittel/55".$celular1.",30,TtM(execamd2)')");

            $result7 = $conn->query("INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_$quadraelote', '7', 'Dial', 'SIP/Vittel/55".$celular2.",30,Tt')");

            $result8 = $conn->query("INSERT INTO extensions (context, exten, priority, app) VALUES ('from-internal', '_$quadraelote', '8', 'Hangup')");
            //Enviando para o usuario 1
            $result9 = $conn->query("INSERT INTO extensions (context, exten, priority, app) VALUES ('from-internal', '_".$quadraelote."1', '1', 'Answer')");

            $result10 = $conn->query("INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_".$quadraelote."1', '2', 'Dial', 'SIP/".$quadraelote."1,15,t' )");

            $dial = '$["${DIALSTATUS}" = "NOANSWER"]?:4:5';

            $result11 = $conn->query("INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_".$quadraelote."1', '3', 'GotoIf', '$dial')");

            $result12 = $conn->query("INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_".$quadraelote."1', '4', 'Playback', 'followme/pls-hold-while-try')");

            $result13 = $conn->query("INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_".$quadraelote."1', '5', 'Dial', 'SIP/Vittel/55".$celular1."')");

            $result14 = $conn->query("INSERT INTO extensions (context, exten, priority, app) VALUES ('from-internal', '_".$quadraelote."1', '6', 'Hangup')");
            // FIM
            //Enviando para o usuario 2
            $result15 = $conn->query("INSERT INTO extensions (context, exten, priority, app) VALUES ('from-internal', '_".$quadraelote."2', '1', 'Answer')");

            $result16 = $conn->query("INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_".$quadraelote."2', '2', 'Dial', 'SIP/".$quadraelote."2,15,t' )");

            $dial = '$["${DIALSTATUS}" = "NOANSWER"]?:4:5';

            $result17 = $conn->query("INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_".$quadraelote."2', '3', 'GotoIf', '$dial')");

            $result18 = $conn->query("INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_".$quadraelote."2', '4', 'Playback', 'followme/pls-hold-while-try')");

            $result19 = $conn->query("INSERT INTO extensions (context, exten, priority, app, appdata) VALUES ('from-internal', '_".$quadraelote."2', '5', 'Dial', 'SIP/Vittel/55".$celular2."')");

            $result20 = $conn->query("INSERT INTO extensions (context, exten, priority, app) VALUES ('from-internal', '_".$quadraelote."2', '6', 'Hangup')");
            // FIM
            $result21 = $conn->query("INSERT INTO sip_buddies (name, defaultuser, secret, callerid) VALUES ( '$quadraelote', '$quadraelote', '172839', '$nome')");

            $result22 = $conn->query("INSERT INTO sip_buddies (name, defaultuser, secret, callerid, context) VALUES ( '".$quadraelote."1', '".$quadraelote."1', '$senha1', '$nome', 'from-users')");

            $result23 = $conn->query("INSERT INTO sip_buddies (name, defaultuser, secret, callerid, context) VALUES ( '".$quadraelote."2', '".$quadraelote."2', '$senha2', '$nome', 'from-users')");


            $resultmoradores = $conn->query("INSERT INTO moradores (name, quadraelote, usuario1, senha1, celular1, usuario2, senha2, celular2, created, telfixo, conjuge) VALUES ('$nome', '$quadraelote', '".$quadraelote."1', '$senha1', '$celular1', '".$quadraelote."2', '$senha2', '$celular2', '$criado', '$telfixo', '$conjuge')");

        }
        if($resultmoradores){
            echo "Dados Inseridos com sucesso";
        }else{
            echo "Erro ao inserir os dados";
        }
    }
?>