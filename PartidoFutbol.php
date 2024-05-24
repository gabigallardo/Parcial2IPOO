<?php
class PartidoFutbol extends Partido
{
    public function __construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2)
    {
        parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2);
    }
    public function coeficientePartido()
    {
        $objEquipo1 = $this->getObjEquipo1();
        $categoriaEquipo = $objEquipo1->getObjCategoria()->getDescripcion();
        $coeficienteBase = 0.5;
        if ($categoriaEquipo === 'Mayores') {
            $coeficienteBase = 0.27;
        } elseif ($categoriaEquipo === 'Juveniles') {
            $coeficienteBase = 0.19;
        } elseif ($categoriaEquipo === 'Menores') {
            $coeficienteBase = 0.13;
        }
        $cantGoles = $this->getCantGolesE1() + $this->getCantGolesE2();
        $cantJugadores = ($this->getObjEquipo1()->getCantJugadores()) + ($this->getObjEquipo2()->getCantJugadores());
        $coeficiente = $coeficienteBase * $cantGoles * $cantJugadores;
        return $coeficiente;
    }
    public function __toString()
    {
        $cadena = "Partido de futbol:\n";
        $cadena = $cadena . "\n" . "--------------------------------------------------------" . "\n";
        $cadena .= parent::__toString();
        return $cadena;
    }
}
