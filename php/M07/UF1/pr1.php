<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </head>
    <body>
        <!-- Generate table --> 
        <?php
            if($_GET["num"]!=''){
                echo "<table class='striped' style='width: 8%;'>";
                for($i=0; $i<11; $i++){
                    $res = $i*$_GET["num"];
                    echo "
                    <tr>
                        <td>
                            <center>".$i." x ".$_GET["num"]." = ".$res."</center>
                        </td>
                    </tr>
                    ";
                }
                echo "</table>";
            }else if($_GET["num"]==''){
            }     
        ?>
        <!-- Pide al usuario que introduzca un numero -->
        <form method="GET" action="index.php">  
            <input type="text" name="num" style="width: 25%; margin-top: 1%; margin-left: 15px; margin-right: 15px;"
                placeholder="Introduce un numero para hacer su tabla de multiplicar..."
            >
            <button type="submit" value="Send" class="waves-effect waves-light btn">Send</button>
        </form>
    </body>
</html>