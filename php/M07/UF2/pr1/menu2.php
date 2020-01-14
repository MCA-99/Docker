<?php
    session_start();
    
    /**
     * Clase Menu
     */
    class Menu{
        // Atributes
        private $tipo;
        private $opciones;
        private $num_opc = 0;

        // Constructors

        // Methods
        public function Menu(){
            
        }

        public function OpcioMenu(){
            
        }

    }
    // FI Clase Menu
?>

<html>
    <!-- MAIN -->
    <head></head>
    <body>
        <form action="menu2.php" method="GET">
            <input type="text" name="nombre"/>
            <select name="opcion">
                <option value="vertical">Vertical</option>
                <option value="horizontal">Horizontal</option>
            </select>
            <input type="submit" name="boton" value="enviar"/>
        </form>
    </body>
</html>