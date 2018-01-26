<?php

require_once('functions.php');
add();
include_once("connection.php");

$hoje2 =  date_create('now', new DateTimeZone('America/Sao_Paulo'));
$datacriacao = $hoje2->format("Y-m-d H:i:s");

// make a folder upload to move your file.I think this code is necessary to modified but right now it working correctly.
    $allowedExts = array("wav", "gsm");
//echo $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $fileName = $_FILES['file']['name'];
    $extension = substr($fileName, strrpos($fileName, '.') + 1); // getting the info about the image to get its extension

    /*if ((($_FILES["file"]["type"] == "video/mp4")|| ($_FILES["file"]["type"] == "audio/mp3")|| ($_FILES["file"]["type"] == "audio/wma")|| ($_FILES["file"]["type"] == "image/pjpeg")|| ($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 200000) && in_array($extension, $allowedExts))*/

    if(in_array($extension, $allowedExts))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "Codigo de retorno: " . $_FILES["file"]["error"] . "<br />";
        }
        else
        {
            //echo "Upload: " . $_FILES["file"]["name"] . "<br />";
            //echo "Tipo: " . $_FILES["file"]["type"] . "<br />";
            //echo "Tamanho: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            //echo "Arquivo TEMP: " . $_FILES["file"]["tmp_name"] . "<br />";
            echo "Aguarde enquanto o arquivo é enviado...";

            if (file_exists("upload/" . $_FILES["file"]["name"]))
            {
                echo $_FILES["file"]["name"] . " Ja existe! ";
            }
            else
            {
                //move_uploaded_file($_FILES["file"]["tmp_name"],"/var/lib/asterisk/sounds/pt_BR/" . $_FILES["file"]["name"]);
                //echo "Armazenado em: " . "/var/lib/asterisk/sounds/pt_BR/" . $_FILES["file"]["name"];
                $nomearquivo = $_FILES["file"]["name"];

                move_uploaded_file($_FILES["file"]["tmp_name"],"audio/" . $_FILES["file"]["name"]);
                //echo "Armazenado em: " . "audio/" . $_FILES["file"]["name"];

                    $removewav = array(".wav");
                    $nomearquivofinal = str_replace($removewav, "", $nomearquivo);
                    $nomearquivofinal2 = $nomearquivofinal . ".wav";

                $output1 = shell_exec("sudo sox audio/$nomearquivofinal2 -t raw -r 8000 -e signed-integer -b 16 -c 1 audio/$nomearquivofinal.sln rate -ql");
                $output2 = shell_exec("sudo cp audio/$nomearquivofinal.sln /var/lib/asterisk/sounds/pt_BR/");
                $output3 = shell_exec("sudo chmod 0775 /var/lib/asterisk/sounds/pt_BR/$nomearquivofinal.sln");
                $output4 = shell_exec("sudo chown asterisk:asterisk /var/lib/asterisk/sounds/pt_BR/$nomearquivofinal.sln");

                //Armazena o caminho do audio
                $caminhoaudio = "/var/lib/asterisk/sounds/pt_BR/$nomearquivofinal.sln";
                $nomearquivofinal3 = $nomearquivofinal . ".sln";
                //Armazena nome do audio
                mysqli_query($mysqli,"INSERT INTO audios (audio, data, caminho) VALUES ('$nomearquivofinal3', '$datacriacao', '$caminhoaudio')");
                echo $output;
                echo $output2;
                echo $output3;

                header("refresh:3; url=index.php?erro=01");
                die();

            }
        }
    }
    else
    {
        header("refresh:1; url=index.php?erro=02");
    }

?>