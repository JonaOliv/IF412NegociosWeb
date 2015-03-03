<?php
  //Alumno: Jonathan Oliva
  
  $registros = array();
  
  $txtCodigo=0;
  $txtDescripcion="";
  $txtEmail="";
  $txtTel="";
  $txtCont="";
  $txtDir="";
  $txtEstado="";
  
  $conn = new mysqli("127.0.0.1", "root", "studentpwd", "nw201501");
  if($conn->errno){
    die("DB no can: " . $conn->error);
  }
  
  if(isset($_POST["btnIns"])){
    $txtCodigo = 0;
    $txtDescripcion = $_POST["txtDsc"];
    $txtEmail = $_POST["txtEmail"];
    $txtTel = $_POST["txtTel"];
    $txtCont = $_POST["txtCont"];
    $txtDir = $_POST["txtDir"];
    $txtEstado = $_POST["txtSts"];
    
    $sqlstr = "INSERT INTO `nw201501`.`proveedores` ( `prvdsc`, `prvemail`, `prvtel`, `prvcont`, `prvdir`, `prvest`)";
    $sqlstr .= "VALUES ( '". $txtDescripcion ." ' , '" . $txtEmail  . "', '". $txtTel ."', '" . $txtCont . "', '". $txtDir ."', '" . $txtEstado . "');";
    
    $result = $conn->query($sqlstr);
  }
  
  if(isset($_POST["btnAct"])){
    $txtCodigo = intval($_POST["txtCod"]);
    $txtDescripcion = $_POST["txtDsc"];
    $txtEmail = $_POST["txtEmail"];
    $txtTel = $_POST["txtTel"];
    $txtCont = $_POST["txtCont"];
    $txtDir = $_POST["txtDir"];
    $txtEstado = $_POST["txtSts"];
    
    $sqlstr="UPDATE `nw201501`.`proveedores` SET ";
    $intComa=0;
    
    if((!is_null($txtCodigo)) && $txtCodigo!=0){
      if((!is_null($txtDescripcion)) && $txtDescripcion!=""){
        $sqlstr.="`prvdsc` = '".$txtDescripcion."'";
        $intComa=1;
      }
      if((!is_null($txtEmail)) && $txtEmail!=""){
        if($intComa==1){
          $sqlstr.=",`prvemail` = '".$txtEmail."'";
        }else{
          $sqlstr.="`prvemail` = '".$txtEmail."'";
        }
        $intComa=1;
      }
      if((!is_null($txtTel)) && $txtTel!=""){
        if($intComa==1){
          $sqlstr.=",`prvtel` = '".$txtTel."'";
        }else{
          $sqlstr.="`prvtel` = '".$txtTel."'";
        }
        $intComa=1;
      }
      if((!is_null($txtCont)) && $txtCont!=""){
        if($intComa==1){
          $sqlstr.=",`prvcont` = '".$txtCont."'";
        }else{
          $sqlstr.="`prvcont` = '".$txtCont."'";
        }
        $intComa=1;
      }
      if((!is_null($txtDir)) && $txtDir!=""){
        if($intComa==1){
          $sqlstr.=",`prvdir` = '".$txtDir."'";
        }else{
          $sqlstr.="`prvdir` = '".$txtDir."'";
        }
        $intComa=1;
      }
      if($intComa==1){
        $sqlstr.=",`prvest` = '".$txtEstado."'";
      }else{
        $sqlstr.="`prvest` = '".$txtEstado."'";
      }
      
      $sqlstr.=" WHERE `prvid` = ".$txtCodigo.";";
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
        <input type="text" name="txtCod" id="txtCod" value="<?php echo $txtCodigo;?>"/>
        <br/>
        <label for="txtDsc">Descripción</label>
        <input type="text" name="txtDsc" id="txtDsc" value="<?php echo $txtDescripcion;?>"/>
        <br/>
        <label for="txtEmail">Email</label>
        <input type="email" name="txtEmail" id="txtEmail" value="<?php echo $txtEmail;?>"/>
        <br/>
        <label for="txtTel">Telefono</label>
        <input type="text" name="txtTel" id="txtTel" value="<?php echo $txtTel;?>"/>
        <br/>
        <label for="txtCont">Contacto</label>
        <input type="text" name="txtCont" id="txtCont" value="<?php echo $txtCont;?>"/>
        <br/>
        <label for="txtDir">Direccion</label>
        <input type="text" name="txtDir" id="txtDir" value="<?php echo $txtDir;?>"/>
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