<?php
    /**
     * Clase Empleat
     */
    class Empleat{
        // Atributes
        private $_s_nom;
        private $_s_dni;
        private $_i_npagadors;
        private $_i_salari;

        // Constructors

        // Methods
        public function inicialitzar($_s_nom, $_s_dni, $_i_npagadors, $_i_salari){
            $this->_s_nom =  $_s_nom;
            $this->_s_dni =  $_s_dni;
            $this->_i_npagadors = $_i_npagadors;
            $this->_i_salari =  $_i_salari;
        }

        public function mostrar(){
            if($this->_i_salari < 22000 && $this->_i_npagadors == 1){
                echo "$this->_s_nom<br/>No ha de fer la declaració de la renta";
            }elseif($this->_i_salari >= 14000 && $this->_i_npagadors > 1){
                echo "$this->_s_nom<br/>Si ha de fer la declaració de la renta";
            }
        }
    } 
    // FI clase Empleat

    // MAIN
    echo "El limit de declaracio de la renta 2020 es de 22.000€ per 1 pagador /// Per més d'1 pagador el limit es 14.000€<hr/>";
    $Empleat = new Empleat();
    $Empleat->inicialitzar("Antonio", "12345678A", 1, 12000);
    $Empleat->mostrar();
    echo "<br/><br/>";
    $Empleat = new Empleat();
    $Empleat->inicialitzar("Juan", "12345678B", 2, 23000);
    $Empleat->mostrar();
    
?>