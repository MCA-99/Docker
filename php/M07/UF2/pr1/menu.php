<?php
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
        public function setTipoVertical(){
            $this->tipo = "vertical";
        }

        public function setTipoHorizontal(){
            $this->tipo = "horizontal";
        }

        public function addOpcion($opcion){
            $this->opciones[$this->num_opc] = $opcion;
            $this->num_opc++;
        }

        public function imprimir(){
            if($this->tipo=="vertical"){
                echo "<ul>";
                foreach($this->opciones as $key => $value){
                    echo "<li><a href='#'>".$value."</a></li>";
                }
                echo "</ul>";
            }else if($this->tipo=="horizontal"){
                echo "<ul>";
                foreach($this->opciones as $key => $value){
                    echo "<li style='display: inline; margin-left: 20px;'><a href='#'>".$value."</a></li>";
                }
                echo "</ul>";
            }
        }
    }
    // FI Clase Menu

    // MAIN
    $horizontal = new Menu();
    $vertical = new Menu();

    for($i=0; $i<8; $i++){
        $horizontal->addOpcion("Vertical");
    }
    $horizontal->setTipoVertical();
    $horizontal->imprimir();

    for($i=0; $i<8; $i++){
        $vertical->addOpcion("Horizontal");
    }
    $vertical->setTipoHorizontal();
    $vertical->imprimir();
?>