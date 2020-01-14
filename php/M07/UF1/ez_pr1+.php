<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->
    </head>
    <body>
    
        <form action="calcez.php" method="post">
            <select name="selector">
                <option value="" disabled selected>Escoge una opcion</option>
                <option value="suma">+</option>
                <option value="resta">-</option>
                <option value="multiplicacion">*</option>
                <option value="division">/</option>
                <option value="raiz">√</option>
                <option value="potencia">^</option>
            </select>
            <p>
                <input type="text" name="num1" placeholder="Valor 1 ..." style="width: 150px;">
            </p>
            <p>
                <input type="text" name="num2" placeholder="Valor 2 ..." style="width: 150px;">
            </p>
            <p>
                <input type="submit" class="waves-effect waves-light btn" value="Calcular">
                <input type="reset" class="waves-effect waves-light btn" value="Borrar">
            </p>
        </form>

        <?php 
            if ($_POST ["num1"] !=""){
                if ($_POST["selector"] == "suma") {
                    print ("Resultado = ".$resultado = $_POST ["num1"] + $_POST ["num2"]);
                    print ('<br /><a href="calcez.php">Volver</a>');
                }elseif ($_POST["selector"] == "resta") {
                    print ("Resultado = ".$resultado = $_POST ["num1"] - $_POST ["num2"]);
                    print ('<br /><a href="calcez.php">Volver</a>');
                }elseif ($_POST["selector"] == "multiplicacion") {
                    print ("Resultado = ".$resultado = $_POST ["num1"] * $_POST ["num2"]);
                    print ('<br /><a href="calcez.php">Volver</a>');
                }elseif ($_POST["selector"] == "division") {
                    print ("Resultado = ".$resultado = $_POST ["num1"] / $_POST ["num2"]);
                    print ('<br /><a href="calcez.php">Volver</a>');
                }elseif ($_POST["selector"] == "raiz") {
                    print ("Resultado = ".$resultado = sqrt($_POST ["num1"]));
                    print ('<br /><a href="calcez.php">Volver</a>');
                }elseif ($_POST["selector"] == "potencia") {
                    print ("Resultado = ".$resultado = pow($_POST ["num1"], $_POST ["num2"]));
                    print ('<br /><a href="calcez.php">Volver</a>');
                }
            } else {
            }
        ?>
    </body>
</html>