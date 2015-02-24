<?php
  //Alumno: Jonathan Oliva
  
  $registros = array();
  $txtCodigo = 0;
  $txtDescripcion = "";
  $txtEstado = "";
  
  $conn = new mysqli("127.0.0.1", "root", "studentpwd", "nw201501");
  if($conn->errno){
    die("DB no can: " . $conn->error);
  }
  if(isset($_POST["btnIns"])){
    $txtCodigo = 0;
    $txtDescripcion = $_POST["txtDsc"];
    $txtEstado = $_POST["txtSts"];
    
    $sqlstr = "INSERT INTO `nw201501`.`categorias` ( `ctgdsc`, `ctgest`)";
    $sqlstr .= "VALUES ( '".   $txtDescripcion ."' , '" . $txtEstado ."');";
  
    $result = $conn->query($sqlstr);
  }
  if(isset($_POST["btnAct"])){
    $txtCodigo = intval($_POST["txtCod"]);
    $txtDescripcion = $_POST["txtDsc"];
    $txtEstado = $_POST["txtSts"];
    
    $sqlstr="UPDATE `nw201501`.`categorias` SET ";
    
    if((!is_null($txtCodigo)) && $txtCodigo!=0){
      if((!is_null($txtDescripcion)) && $txtDescripcion!=""){
        $sqlstr.="`ctgdsc` = '".$txtDescripcion."',";
      }
      $sqlstr.=" `ctgest` = '".$txtEstado."' WHERE `ctgid` = ".$txtCodigo.";";
      $result = $conn->query($sqlstr);
    }
  }
  $sqlQuery  = "SELECT `categorias`.`ctgid`,`categorias`.`ctgdsc`,`categorias`.`ctgest` FROM `nw201501`.`categorias`;";
  $resulCursor = $conn->query($sqlQuery);
  while($registro = $resulCursor->fetch_assoc()){
    $registros[] = $registro;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Formulario categorias</title>
  </head>
  <body>
    <h1>Categorias</h1>
    <form action="categorias.php" method="POST">
        <label for="txtCod">Codigo</label>
        <input type="text" name="txtCod" id="txtCod" value="<?php echo $txtCodigo;?>"/>
        <br/>
        <label for="txtDsc">Descripción</label>
        <input type="text" name="txtDsc" id="txtDsc" value="<?php echo $txtDescripcion;?>"/>
        <br/>
        <label for="txtSts">Estado</label>
        <select name="txtSts" id="txtSts">
            <option value="PND" <?php echo $txtEstado=="PND"?"selected":"";?>>Pendiente</option>
            <option value="CNF" <?php echo $txtEstado=="CNF"?"selected":"";?>>Confirmado</option>
            <option value="CNL" <?php echo $txtEstado=="CNL"?"selected":"";?>>Cancelado</option>
        </select>
        <br/>
        <input type="submit" name="btnIns" value="Ingresar" />
        <input type="submit" name="btnAct" value="Actualizar" />
    </form>
    <div>
      <h2>Datos</h2>
      <table>
        <tr>
          <th>Codigo</th>
          <th>Descripción</th>
          <th>Estado</th>
        </tr>
      <?php
        if(count($registros) > 0){
          foreach($registros as $registro){
            echo "<tr><td>".$registro["ctgid"]."</td>";
            echo "<td>".$registro["ctgdsc"]."</td>";
            echo "<td>".$registro["ctgest"]."</td></tr>";
          }
        }
        ?>
      </table>
    </div>
  </body>
</html>