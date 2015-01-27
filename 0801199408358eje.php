<?php
$msg ="";
$txt1 ="";
//isset rebisa si esta establecida la variable
if(isset($_POST["btn1"])){
    $txt1 = $_POST["txt1"];
    $msg = "Buenos dias $txt1";
}
?>
<DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Prueba github</title>
    </head>
    <body>
        <h1>Ejercicio 1 PHP</h1>
        <form action="0801199408358eje.php" method="post">
            <label for="txt1"></label>
            <input type="text" id="txt1" name="txt1" value="<?php echo $txt1 ?>"/></br>
            <input type="submit" id="btn1" name="btn1" value="procesar"/>
        </form>
    </body>
</html>