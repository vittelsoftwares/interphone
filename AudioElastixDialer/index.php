<?php
include("funciones_bd.php");
?>
<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="audioelastixdialer.php">
  <table width="660" border="1">
  <tr>
      <td colspan="2"><div align="center">AUDIO ELASTIX DIALER 0.1 <br />
        Generador de Campa&ntilde;as / Destino : Audio <br />
      </div></td>
    </tr>
  <tr>
      <td width="309">Nombre de Campa&ntilde;a </td>
      <td width="335"><input name="campana" type="text" id="campana" />
      <input name="idcampana" type="text" id="idcampana" value="<?php  echo $nuevocodigo_dc=calcular_nuevo_codigo_bd("calloutcampana","idcampana");?>" /></td>
    </tr>
    <tr>
      <td width="309"><p>Troncal</p>      </td>
      <td width="335"><select name="troncal" id="troncal">
        <option value="1">An&aacute;loga</option>
        <option value="2" selected="selected">Voip</option>
      </select>
      <input name="Callerid" type="hidden" id="Callerid" value="4832730" />      </td>
    </tr>
    <tr>
      <td>Extension</td>
      <td><input name="Extension" type="text" id="Extension" value="s" /></td>
    </tr>
	<tr>
      <td>Priority</td>
      <td><input name="Priority" type="text" id="Priority" value="1" /></td>
    </tr>
	<tr>
      <td>Contexto donde se reproduce la grabaci&oacute;n(Context)</td>
      <td><input name="Context" type="text" id="numerocontexto" value="call-file-test" /></td>
	</tr>
    <tr>
      <td>Numero de reintentos (MaxRetries)</td>
      <td><input name="MaxRetries" type="text" id="MaxRetries" value="1" /></td>
    </tr>
    <tr>
      <td>Segundos entre reintentos (RetryTime)</td>
      <td><input name="RetryTime" type="text" id="RetryTime" value="60" /></td>
    </tr>
    <tr>
      <td>Segundos antes de colgar la llamada(WaitTime) </td>
      <td><input name="WaitTime" type="text" id="WaitTime" value="30" /></td>
    </tr>
    <tr>
      <td>Archivo de llamadas </td>
      <td><input type="file" name="archivocvs"/>
      <input name="Priority" type="hidden" id="Priority" value="1" /></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>
    <input type="submit" name="Submit" value="Crear Campa&ntilde;a" />
  </p>
</form>
