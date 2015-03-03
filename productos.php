<?php
  //Alumno: Jonathan Oliva
  
  $registros = array();
  $txtCodigo=0;
  $txtDescripcion="";
  $txtPrdbrc="";
  $txtCantidad=0;
  $txtEstado="";
  $txtCategoria=1;
  
  $conn = new mysqli("127.0.0.1", "root", "studentpwd", "nw201501");
  if($conn->errno){
    die("DB no can: " . $conn->error);
  }
  
  if(isset($_POST["btnIns"])){
    $txtCodigo = 0;
    $txtDescripcion = $_POST["txtDsc"];
    $txtPrdbrc = $_POST["txtPrdbrc"];
    $txtCantidad = intval($_POST["txtCtd"]);
    $txtEstado = $_POST["txtSts"];
    $txtCategoria = intval($_POST["txtCat"]);
    
    $sqlstr = "INSERT INTO `nw201501`.`productos` ( `prddsc`, `prdbrc`, `prdctd`, `prdest`, `ctgid`)";
    $sqlstr .= "VALUES ( '". $txtDescripcion ." ' , '" . $txtPrdbrc  . "', ". $txtCantidad .", '" . $txtEstado . "', ". $txtCategoria .");";
    
    $result = $conn->query($sqlstr);
  }
  
  if(isset($_POST["btnAct"])){
    $txtCodigo = intval($_POST["txtCod"]);
    $txtDescripcion = $_POST["txtDsc"];
    $txtPrdbrc = $_POST["txtPrdbrc"];
    $txtCantidad = intval($_POST["txtCtd"]);
    $txtEstado = $_POST["txtSts"];
    $txtCategoria = intval($_POST["txtCat"]);
    
    $sqlstr="UPDATE `nw201501`.`productos` SET ";
    $intComa=0;
    
    if((!is_null($txtCodigo)) && $txtCodigo!=0){
      if((!is_null($txtDescripcion)) && $txtDescripcion!=""){
        $sqlstr.="`prddsc` = '".$txtDescripcion."'";
        $intComa=1;
      }
      if((!is_null($txtPrdbrc)) && $txtPrdbrc!=""){
        if($intComa==1){
          $sqlstr.=",`prdbrc` = '".$txtPrdbrc."'";
        }else{
          $sqlstr.="`prdbrc` = '".$txtPrdbrc."'";
        }
        $intComa=1;
      }
      if((!is_null($txtCantidad)) && $txtCantidad!=0){
        if($intComa==1){
          $sqlstr.=",`prdctd` = ".$txtCantidad;
        }else{
          $sqlstr.="`prdctd` = ".$txtCantidad;
        }
        $intComa=1;
      }
      if((!is_null($txtCategoria)) && $txtCategoria!=0){
        if($intComa==1){
          $sqlstr.=",`ctgid` = ".$txtCategoria;
        }else{
          $sqlstr.="`ctgid` = ".$txtCategoria;
        }
        $intComa=1;
      }
      if($intComa==1){
        $sqlstr.=",`prdest` = '".$txtEstado."'";
      }else{
        $sqlstr.="`prdest` = '".$txtEstado."'";
      }
      
      $sqlstr.=" WHERE `prdid` = ".$txtCodigo.";";
      $result = $conn->query($sqlstr);
    }
  }
  
  $sqlQuery  = "SELECT `productos`.`prdid`,`productos`.`prddsc`,`productos`.`prdbrc`,`productos`.`prdctd`,`productos`.`prdest`,`productos`.`ctgid` FROM `nw201501`.`productos`;";
  $resulCursor = $conn->query($sqlQuery);
  while($registro = $resulCursor->fetch_assoc()){
    $registros[] = $registro;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Formulario productos</title>
  </head>
  <body>
    <h1>Productos</h1>
    <form action="productos.php" method="POST">
        <label for="txtCod">Codigo</label>
        <input type="text" name="txtCod" id="txtCod" value="<?php echo $txtCodigo;?>"/>
        <br/>
        <label for="txtDsc">Descripción</label>
        <input type="text" name="txtDsc" id="txtDsc" value="<?php echo $txtDescripcion;?>"/>
        <br/>
        <label for="txtPrdbrc">prdbrc</label>
        <input type="text" name="txtPrdbrc" id="txtPrdbrc" value="<?php echo $txtPrdbrc;?>"/>
        <br/>
        <label for="txtCtd">Cantidad</label>
        <input type="text" name="txtCtd" id="txtCtd" value="<?php echo $txtCantidad;?>"/>
        <br/>
        <label for="txtSts">Estado</label>
        <select name="txtSts" id="txtSts">
            <option value="PND" <?php echo $txtEstado=="PND"?"selected":"";?>>Pendiente</option>
            <option value="CNF" <?php echo $txtEstado=="CNF"?"selected":"";?>>Confirmado</option>
            <option value="CNL" <?php echo $txtEstado=="CNL"?"selected":"";?>>Cancelado</option>
        </select>
        <br/>
        <label for="txtCat">Categoria</label>
        <input type="text" name="txtCat" id="txtCat" value="<?php echo $txtCategoria;?>"/>
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
          <th>prdbrc</th>
          <th>Cantidad</th>
          <th>Estado</th>
          <th>Categoria</th>
        </tr>
      <?php
        if(count($registros) > 0){
          foreach($registros as $registro){
            echo "<tr><td>".$registro["prdid"]."</td>";
            echo "<td>".$registro["prddsc"]."</td>";
            echo "<td>".$registro["prdbrc"]."</td>";
            echo "<td>".$registro["prdctd"]."</td>";
            echo "<td>".$registro["prdest"]."</td>";
            echo "<td>".$registro["ctgid"]."</td></tr>";
          }
        }
        ?>
      </table>
    </div>
  </body>
</html>