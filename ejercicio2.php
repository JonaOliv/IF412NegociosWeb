<?php
    $txtNumero1 =0;
    $txtNumero2 =0;
    $iteraciones=0;
    $msg="";
    if(isset($_POST["btnPrc"])){
        //eleve el numero 1 a la potencia del numer dos
        $txtNumero1 = intval($_POST["numero1"]);
        $txtNumero2 = intval($_POST["numero2"]);
        $newValue = $txtNumero1;
        for($i = 0; $i <$txtNumero2-1; $i++){
            $newValue *=$txtNumero1;
        }
        $msg = "El valor: $txtNumero1 a la potencia $txtNumero2 es igual a $newValue";
    }
    if(isset($_POST["btnRev"])){
      $txtNumero1 = intval($_POST["numero1"]);
      $iteraciones = intval($_POST["iteraciones"]);
      $contador=1;
      while($iteraciones > 0 ){
        $msg .= "$contador ). Producto: ".($txtNumero1 * $iteraciones)."</br>";
        $contador++;
        $iteraciones --;
      }
        //escribir el numero 1 multiplicado por la iteracion a la inversa
    }
    if(isset($_POST["btnFac"])){
        // factorial del numero 2
        $txtNumero2 = intval($_POST["numero2"]);
        $factorial=$txtNumero2;
        for($i=$factorial; $i-1>0; $i--){
            $factorial*=($i-1);
        }
        $msg = "El factorial de $txtNumero2 es $factorial"."</br>";
    }
    //reto es que la interacion que seleccionemos debe permanecer selecionada
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8"/>
            <title>Ejercicio 2 Switch y Ciclos</title>
        </head>
        <body>
            <h1>Ejemplo de Switch y Ciclos en PHP</h1>
            <form action="ejercicio2.php" method="post">
                <label for="numero1">Numero 1</label>
                <input name="numero1" type="text" id="numero1" value="<?php echo $txtNumero1;?>" /></br>
                <label for="numero2">Numero 2</label>
                <input name="numero2" type="text" id="numero2" value="<?php echo $txtNumero2;?>" />
                </br>
                <label for="iteraciones">Numero de interaciones</label>
                <select name="iteraciones" id="iteraciones" >
                    <option <?php if(10==$iteraciones){echo "selected";}?> value="10">10</option>
                    <option <?php if(20==$iteraciones){echo "selected";}?> value="20">20</option>
                    <option <?php if(50==$iteraciones){echo "selected";}?> value="50">50</option>
                </select>
                </br>
                <input type="submit" value="procesar" name="btnPrc" id="btnPrc"/>
                <input type="submit" value="reversar" name="btnRev" id="btnRev"/>
                <input type="submit" value="factorial" name="btnFac" id="btnFac"/>
            </form>
            <div>
                <?php echo $msg; ?>
            </div>
        </body>
    </html>
