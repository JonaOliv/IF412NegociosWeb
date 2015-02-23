<?php
  //Alumno: Jonathan Oliva
  
  $registros = array();
  
  $conn = new mysqli("127.0.0.1", "root", "studentpwd", "nw201501");
  if($conn->errno){
    die("DB no can: " . $conn->error);
  }
  if(isset($_POST["btnIns"])){
    $registro = array();
    $registro["codigo"] = 0;
    $registro["descripcion"] = $_POST["txtDsc"];
    $registro["estado"] = $_POST["txtSts"];
    
    $sqlstr = "INSERT INTO `nw201501`.`categorias` ( `ctgdsc`, `ctgest`)";
    $sqlstr .= "VALUES ( '". $registro["descripcion"] ." ' , '" . $registro["estado"] ."');";
    
    $result = $conn->query($sqlstr);
  }
  if(isset($_POST["btnAct"])){
    $registro = array();
    $registro["codigo"] = intval($_POST["txtCod"]);
    $registro["descripcion"] = $_POST["txtDsc"];
    $registro["estado"] = $_POST["txtSts"];
    $sqlstr="UPDATE `nw201501`.`categorias` SET ";
    
    if(!is_null($registro["codigo"])){
      if((!is_null($registro["descripcion"])) && $registro["descripcion"]!=""){
        $sqlstr.="`ctgdsc` = '".$registro["descripcion"]."',";
      }
      $sqlstr.=" `ctgest` = '".$registro["estado"]."' WHERE `ctgid` = ".$registro["codigo"].";";
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
        <input type="text" name="txtCod" id="txtCod" />
        <br/>
        <label for="txtDsc">Descripción</label>
        <input type="text" name="txtDsc" id="txtDsc" />
        <br/>
        <label for="txtSts">Estado</label>
        <select name="txtSts" id="txtSts">
            <option value="PND">Pendiente</option>
            <option value="CNF">Confirmado</option>
            <option value="CNL">Cancelado</option>
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