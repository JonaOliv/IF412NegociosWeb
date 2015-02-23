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
    $registro["prdbrc"] = $_POST["txtPrdbrc"];
    $registro["cantidad"] = intval($_POST["txtCtd"]);
    $registro["estado"] = $_POST["txtSts"];
    $registro["categoria"] = intval($_POST["txtCat"]);
    
    $sqlstr = "INSERT INTO `nw201501`.`productos` ( `prddsc`, `prdbrc`, `prdctd`, `prdest`, `ctgid`)";
    $sqlstr .= "VALUES ( '". $registro["descripcion"] ." ' , '" . $registro["prdbrc"]  . "', ". $registro["cantidad"] .", '" . $registro["estado"] . "', ". $registro["categoria"] .");";
    
    $result = $conn->query($sqlstr);
  }
  
  if(isset($_POST["btnAct"])){
    $registro = array();
    $registro["codigo"] = intval($_POST["txtCod"]);
    $registro["descripcion"] = $_POST["txtDsc"];
    $registro["prdbrc"] = $_POST["txtPrdbrc"];
    $registro["cantidad"] = intval($_POST["txtCtd"]);
    $registro["estado"] = $_POST["txtSts"];
    $registro["categoria"] = intval($_POST["txtCat"]);
    $sqlstr="UPDATE `nw201501`.`productos` SET ";
    $intComa=0;
    
    if(!is_null($registro["codigo"])){
      if((!is_null($registro["descripcion"])) && $registro["descripcion"]!=""){
        $sqlstr.="`prddsc` = '".$registro["descripcion"]."'";
        $intComa=1;
      }
      if((!is_null($registro["prdbrc"])) && $registro["prdbrc"]!=""){
        if($intComa==1){
          $sqlstr.=",`prdbrc` = '".$registro["prdbrc"]."'";
        }else{
          $sqlstr.="`prdbrc` = '".$registro["prdbrc"]."'";
        }
        $intComa=1;
      }
      if((!is_null($registro["cantidad"])) && $registro["cantidad"]!=0){
        if($intComa==1){
          $sqlstr.=",`prdctd` = ".$registro["cantidad"];
        }else{
          $sqlstr.="`prdctd` = ".$registro["cantidad"];
        }
        $intComa=1;
      }
      if((!is_null($registro["categoria"])) && $registro["categoria"]!=0){
        if($intComa==1){
          $sqlstr.=",`ctgid` = ".$registro["categoria"];
        }else{
          $sqlstr.="`ctgid` = ".$registro["categoria"];
        }
        $intComa=1;
      }
      if($intComa==1){
        $sqlstr.=",`prdest` = '".$registro["estado"]."'";
      }else{
        $sqlstr.="`prdest` = '".$registro["estado"]."'";
      }
      
      $sqlstr.=" WHERE `prdid` = ".$registro["codigo"].";";
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
        <input type="text" name="txtCod" id="txtCod" />
        <br/>
        <label for="txtDsc">Descripción</label>
        <input type="text" name="txtDsc" id="txtDsc" />
        <br/>
        <label for="txtPrdbrc">prdbrc</label>
        <input type="text" name="txtPrdbrc" id="txtPrdbrc" />
        <br/>
        <label for="txtCtd">Cantidad</label>
        <input type="text" name="txtCtd" id="txtCtd" />
        <br/>
        <label for="txtSts">Estado</label>
        <select name="txtSts" id="txtSts">
            <option value="PND">Pendiente</option>
            <option value="CNF">Confirmado</option>
            <option value="CNL">Cancelado</option>
        </select>
        <br/>
        <label for="txtCat">Categoria</label>
        <input type="text" name="txtCat" id="txtCat" />
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