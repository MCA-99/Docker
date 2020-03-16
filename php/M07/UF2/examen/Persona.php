<?php
    class Persona {
        // Atributes
        protected $_s_nom;
        protected $_i_edat;
        protected $_s_dni;

        // Constructors
            // no hi ha

        // Methods
        public function __construct($_s_nom) {
            $this->_s_nom =  $_s_nom;
        }

        public function carregarDades($_i_edat, $_s_dni) {
            $this->_i_edat =  $_i_edat;
            $this->_s_dni =  $_s_dni;
        }

        public function imprimirDades() {
            echo "<b>Nom: </b>$this->_s_nom <br/><b>Edat: </b>$this->_i_edat <br/><b>DNI: </b>$this->_s_dni <br/>__________________________________";
        }
    }

    // Main
    echo "<b>Metodes classe Persona: </b><br/>";
    $Persona = new Persona("Antonio");
    $Persona->carregarDades(30, "12345678A");
    $Persona->imprimirDades();
?>
