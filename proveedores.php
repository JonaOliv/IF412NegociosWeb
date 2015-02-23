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
    $registro["email"] = $_POST["txtEmail"];
    $registro["tel"] = $_POST["txtTel"];
    $registro["cont"] = $_POST["txtCont"];
    $registro["direccion"] = $_POST["txtDir"];
    $registro["estado"] = $_POST["txtSts"];
    
    $sqlstr = "INSERT INTO `nw201501`.`proveedores` ( `prvdsc`, `prvemail`, `prvtel`, `prvcont`, `prvdir`, `prvest`)";
    $sqlstr .= "VALUES ( '". $registro["descripcion"] ." ' , '" . $registro["email"]  . "', '". $registro["tel"] ."', '" . $registro["cont"] . "', '". $registro["direccion"] ."', '" . $registro["estado"] . "');";
    
    $result = $conn->query($sqlstr);
  }
  if(isset($_POST["btnAct"])){
    $registro = array();
    $registro["codigo"] = intval($_POST["txtCod"]);
    $registro["descripcion"] = $_POST["txtDsc"];
    $registro["email"] = $_POST["txtEmail"];
    $registro["tel"] = $_POST["txtTel"];
    $registro["cont"] = $_POST["txtCont"];
    $registro["direccion"] = $_POST["txtDir"];
    $registro["estado"] = $_POST["txtSts"];
    $sqlstr="UPDATE `nw201501`.`proveedores` SET ";
    $intComa=0;
    
    if(!is_null($registro["codigo"])){
      if((!is_null($registro["descripcion"])) && $registro["descripcion"]!=""){
        $sqlstr.="`prvdsc` = '".$registro["descripcion"]."'";
        $intComa=1;
      }
      if((!is_null($registro["email"])) && $registro["email"]!=""){
        if($intComa==1){
          $sqlstr.=",`prvemail` = '".$registro["email"]."'";
        }else{
          $sqlstr.="`prvemail` = '".$registro["email"]."'";
        }
        $intComa=1;
      }
      if((!is_null($registro["tel"])) && $registro["tel"]!=""){
        if($intComa==1){
          $sqlstr.=",`prvtel` = '".$registro["tel"]."'";
        }else{
          $sqlstr.="`prvtel` = '".$registro["tel"]."'";
        }
        $intComa=1;
      }
      if((!is_null($registro["cont"])) && $registro["cont"]!=""){
        if($intComa==1){
          $sqlstr.=",`prvcont` = '".$registro["cont"]."'";
        }else{
          $sqlstr.="`prvcont` = '".$registro["cont"]."'";
        }
        $intComa=1;
      }
      if((!is_null($registro["direccion"])) && $registro["direccion"]!=""){
        if($intComa==1){
          $sqlstr.=",`prvdir` = '".$registro["direccion"]."'";
        }else{
          $sqlstr.="`prvdir` = '".$registro["direccion"]."'";
        }
        $intComa=1;
      }
      if($intComa==1){
        $sqlstr.=",`prvest` = '".$registro["estado"]."'";
      }else{
        $sqlstr.="`prvest` = '".$registro["estado"]."'";
      }
      
      $sqlstr.=" WHERE `prvid` = ".$registro["codigo"].";";
      $result = $conn->query($sqlstr);
    }
  }
  $sqlQuery  = "Select * from `nw201501`.`proveedores`;";
  $resulCursor = $conn->query($sqlQuery);
  while($registro = $resulCursor->fetch_assoc()){
    $registros[] = $registro;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Formulario proveedores</title>
  </head>
  <body>
    <h1>Proveedores</h1>
    <form action="proveedores.php" method="POST">
        <label for="txtCod">Codigo</label>
        <input type="text" name="txtCod" id="txtCod" />
        <br/>
        <label for="txtDsc">Descripción</label>
        <input type="text" name="txtDsc" id="txtDsc" />
        <br/>
        <label for="txtEmail">Email</label>
        <input type="email" name="txtEmail" id="txtEmail" />
        <br/>
        <label for="txtTel">Telefono</label>
        <input type="text" name="txtTel" id="txtTel" />
        <br/>
        <label for="txtCont">Contacto</label>
        <input type="text" name="txtCont" id="txtCont" />
        <br/>
        <label for="txtDir">Direccion</label>
        <input type="text" name="txtDir" id="txtDir" />
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
          <th>Email</th>
          <th>Telefono</th>
          <th>Contacto</th>
          <th>Direccion</th>
          <th>Estado</th>
        </tr>
      <?php
        if(count($registros) > 0){
          foreach($registros as $registro){
            echo "<tr><td>".$registro["prvid"]."</td>";
            echo "<td>".$registro["prvdsc"]."</td>";
            echo "<td>".$registro["prvemail"]."</td>";
            echo "<td>".$registro["prvtel"]."</td>";
            echo "<td>".$registro["prvcont"]."</td>";
            echo "<td>".$registro["prvdir"]."</td>";
            echo "<td>".$registro["prvest"]."</td></tr>";
          }
        }
        ?>
      </table>
    </div>
  </body>
</html>