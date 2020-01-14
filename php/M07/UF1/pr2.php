<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </head>
    <body>
        <div style="margin-left: 15px; width: 70%;">
            <!-- array_count_values() -->
            <p style="font-size: 20px; font-weight: bold;">array_count_values():</p>
            <p>La función array_count_values() cuenta todos los valores de un array.</p>
            <?php
                $_Elements=array("A","Perro","Gato","A","Perro");
                echo "<b>Array original:</b><br/>";
                print_r($_Elements);
                echo "<br/><b>Funcion 'array_count_values()':</b><br/>";
                print_r(array_count_values($_Elements));
                echo "<br/><hr/>";
            ?>
            <!-- explode() -->
            <p style="font-size: 20px; font-weight: bold;">explode():</p>
            <p>La función explode() rompe un string en un array.</p>
            <?php
                echo "<b>String original:</b><br/>";
                $str = "Esto es una prueba de string para transformarla en un array";
                echo "$str";
                echo "<br/><b>Funcion 'explode()':</b><br/>";
                print_r (explode(" ",$str));
                echo "<br/><hr/>";
            ?>
            <!-- array_keys() -->
            <p style="font-size: 20px; font-weight: bold;">array_keys():</p>
            <p>La función array_keys() devuelve las claves que contiene el array.</p>
            <?php
                $_Elements=array("Volvo"=>"XC90","BMW"=>"X5","Toyota"=>"Highlander");
                echo "<b>Array original:</b><br/>";
                print_r($_Elements);
                echo "<br/><b>Funcion 'array_keys()':</b><br/>";
                print_r(array_keys($_Elements));
                echo "<br/><hr/>";
            ?>
            <!-- array_values() -->
            <p style="font-size: 20px; font-weight: bold;">array_values():</p>
            <p>La función array_values() devuelve todos los valores de un array (no las claves).</p>
            <?php
                $_Elements=array("Nombre"=>"Antonio","Edad"=>"20","Ciudad"=>"Badalona");
                echo "<b>Array original:</b><br/>";
                print_r($_Elements);
                echo "<br/><b>Funcion 'array_values()':</b><br/>";
                print_r(array_values($_Elements));
                echo "<br/><hr/>";
            ?>
            <!-- array_merge() -->
            <p style="font-size: 20px; font-weight: bold;">array_merge():</p>
            <p>La función array_merge() combina dos arrays en uno.</p>
            <?php
                $_Elements1=array("Rojo","Verde");
                $_Elements2=array("Azul","Amarillo");
                echo "<b>Arrays originales:</b><br/>";
                print_r(array_values($_Elements1));
                echo "<br/>";
                print_r(array_values($_Elements2));
                echo "<br/><b>Funcion 'array_merge()':</b><br/>";
                print_r(array_merge($_Elements1,$_Elements2));
                echo "<br/><hr/>";
            ?>
            <!-- array_shift() -->
            <p style="font-size: 20px; font-weight: bold;">array_shift():</p>
            <p>La función array_shift() elimina el primer elemento de un array y devuelve el valor del elemento eliminado.</p>
            <?php
                $_Elements=array("a"=>"Rojo","b"=>"Verde","c"=>"Azul");
                echo "<b>Array original:</b><br/>";
                print_r($_Elements);
                echo "<br/><b>Funcion 'array_shift()':</b><br/>";
                echo array_shift($_Elements);
                print_r ($_Elements);
            ?>
        </div>
    </body>
</html>