<?php
    include __DIR__ . '/Persona.php';

    class Empleat extends Persona{
        // Atributes
        private $_i_salari_mensual;

        // Constructors
            // no hi ha

        // Methods
        public function __construct($_i_salari_mensual, $_s_nom, $_i_edat, $_s_dni) {
            parent::__construct($_s_nom, $_i_edat, $_s_dni);
            $this->_i_salari_mensual =  $_i_salari_mensual;
            $this->_s_nom =  $_s_nom;
            $this->_i_edat =  $_i_edat;
            $this->_s_dni =  $_s_dni;
        }

        public function imprimirSalariAnual() {
            $this->_i_salari_mensual = $this->_i_salari_mensual*12;
            echo "<b>Nom: </b>$this->_s_nom <br/><b>Edat: </b>$this->_i_edat <br/><b>DNI: </b>$this->_s_dni<br/>";
            echo "<b>Salari Anual: </b>$this->_i_salari_mensual €";
        }
    }

    //Main
    echo "<br/><br/><b>Metodes classe Empleat+Persona: </b><br/>";
    $Empleat = new Empleat(1000, "Antonio", 30, "12345678A");
    $Empleat->imprimirSalariAnual();
?>
