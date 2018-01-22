<p>CAMPA&Ntilde;A CREADA , GENERANDO LLAMAS </p>
<p>ELASTIX PROWERFULL !! </p>
<?php
#--------------------------------------------------------------------------------------------------------------------
# Version: 0.1
#
# Copyright (C) 2013  Juan Oliva / jroliva@gmail.com / @jroliva
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#--------------------------------------------------------------------------------------------------------------------


include("funciones_bd.php");
//////////////////////////////////////////////////////////////////
//1.- PROCESO PARA SUBIR CVS AL SERVIDOR
//Defino carpeta para uploads
$dir = ''; // 
move_uploaded_file($_FILES['archivocvs']['tmp_name'], $dir.$_FILES['archivocvs']['name'] );

//Nombre del archivo cvs subido
$archivocvs = $_FILES['archivocvs']['name'];
/////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////
//2.- PROCESO DE CARGAR CVS A LA BASE DE DATOS
$nrocampana=$_POST['idcampana'];
$row = 1;
$handle = fopen($archivocvs, "r");
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    $row++;
    //$cadena = "insert into calloutnumeros(numero,nombre) values(";
    $cadena = "insert into calloutnumeros(campana,telefono,nombre) values('".$nrocampana."',";	
    for ($c=0; $c < $num; $c++) {
        if ($c==($num-1))
              $cadena = $cadena."'".$data[$c] . "'";
        else
              $cadena = $cadena."'".$data[$c] . "',";
    }

    $cadena = $cadena.");";
    //echo $cadena."<br>";

     //$enlace=Conectarse();
     //$result=mysql_query($cadena, $enlace);
	 $resultado=consultar_bd($cadena);
	 //echo $cadena;
     //mysql_close($enlace);
}

fclose($handle);
///////////////////////////////////////////////////

//3 .- RECIBIR LAS VARIABLES PARA GENERAR LA LLAMADA
$Channel= "Channel: " . $_POST['Channel'];
//$Callerid= "Callerid: " .$_POST['Callerid'];
$MaxRetries= "MaxRetries: " . $_POST['MaxRetries'];  //NUMERO DE REINTENTOS
$RetryTime= "RetryTime: " . $_POST['RetryTime'];  //SEGUNDO ENTRE INTENTOS
$WaitTime= "WaitTime: " . $_POST['WaitTime']; //SEGUNDOS ANTES DE COLGAR LA LLAMADA
$Context= "Context: " . $_POST['Context'];  //CONTEXTO
$Extension= "Extension: " . $_POST['Extension'];  //EXTENSION
$Priority= "Priority: " . $_POST['Priority'];  //PRIORIDAD DENTRO DE LA EXTENSION
$troncal= $_POST['troncal'];

if ($troncal=="2")
   {
    $tronc1="SIP/0051";
	$tronc2="@SERVILINE";  
   }
   else
   {
    $tronc1="ZAP/g1/";
    $tronc2=",20,Tt";  
   } 



/////////////////////////////////////////
//4.- INSERTAR DATOS DE CAMPAÑA EN LA BASE DE DATOS

$idcampana=$_POST['idcampana'];
$nombrecampana=$_POST['campana'];
$tipocampana="2";
$troncal=$_POST['troncal'];
$audiocampana=$_POST['Context'];
$archivo=$archivocvs;
$fechacreacion=date("Ymd");
$sentencia_ins_dc1="insert into calloutcampana  (idcampana,nombre,tipo,troncal,audio,archivo,fechacreacion)VALUES('".$idcampana."','".$nombrecampana."','".$tipocampana."','".$troncal."','".$audiocampana."','".$archivo."','".$fechacreacion."')";
insertar_modificar_eliminar_bd($sentencia_ins_dc1);


/////////////////////////////////////////////

//5.- GENERAR LA LLAMADA DE LA BASE DE DATOS
$sentencia="select id,telefono from calloutnumeros where campana = $idcampana;";
$resultado=consultar_bd($sentencia);
while ($row=mysql_fetch_array($resultado)){
   $id=$row[0];
   $numero=$row[1];
   $Channel= "Channel: " . $tronc1 . $numero . $tronc2 ;
   $Callerid= "Callerid: " . $numero;
   $fp = fopen("/var/spool/asterisk/outgoing/myarchivo$id.call","a");
   fwrite($fp, $Channel . PHP_EOL . $Callerid . PHP_EOL . $MaxRetries . PHP_EOL . $RetryTime . PHP_EOL . $WaitTime . PHP_EOL . $Context . PHP_EOL . $Extension . PHP_EOL . $Priority . PHP_EOL);
   fclose($fp);
   
} //CIERRE DE WHILE
mysql_free_result($resultado); 
die;


?>
