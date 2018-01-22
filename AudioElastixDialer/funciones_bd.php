<?php
function conectar_bd()
{
     		if(!($conector=mysql_connect("localhost","root","tucontrasena")))
				 {
						echo "Error al conectar al servidor de base de datos";
						exit();
				 }
								 
			if(!mysql_select_db("AdioElastixDialerBD",$conector))
				 {
						echo "Error al conectarse a la base de datos";
						exit();
				 }
				 
				 return $conector;
}

function desconectar_bd($conector)
{
		mysql_close($conector);

}

function consultar_bd($sentencia)
{
		
		$conector=conectar_bd();
		
		if(!($resultado=mysql_query($sentencia,$conector)))
		 {
				echo "Error en consulta a la base de datos";
				exit();
		 }
		 
		 desconectar_bd($conector);
		 
		return $resultado;
}

function insertar_modificar_eliminar_bd($sentencia)
{
		
		$conector=conectar_bd();
		
		if(!($resultado=mysql_query($sentencia,$conector)))
		 {
				echo "Error en transacción de base de datos";
				exit();
		 }
		 
		 desconectar_bd($conector);
		 
		
}

function calcular_nuevo_codigo_bd($nombretabla,$codigocampo)
{
		
				$nuevocodigo="";
				$sentencia="select max(".$codigocampo.") from ".$nombretabla.";";
				$resultado=consultar_bd($sentencia);
				$fila=mysql_fetch_array($resultado);
				$cadena=$fila[0];
    			$numero= intval($cadena);
				$numero=$numero+1;
				$cadena= (string) $numero;
				$nuevocodigo=$cadena;
		   		 return $nuevocodigo;
}


?>






