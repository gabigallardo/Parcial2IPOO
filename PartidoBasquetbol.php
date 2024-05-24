<?php
class PartidoBasquetbol extends Partido
{
    private $cantInfracciones;
    private $coefPenalizaciones;
    public function __construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2, $cantInfracciones)
    {
        parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2);
        $this->cantInfracciones = $cantInfracciones;
        $this->coefPenalizaciones = 0.75;
    }
    public function getCantInfracciones()
    {
        return $this->cantInfracciones;
    }
    public function getCoefPenalizaciones()
    {
        return $this->coefPenalizaciones;
    }
    public function setCantInfracciones($cantidad)
    {
        $this->cantInfracciones = $cantidad;
    }
    public function setCoefPenalizaciones($coeficiente)
    {
        $this->coefPenalizaciones = $coeficiente;
    }
    public function coeficientePartido()
    {

        $coefBase = parent::coeficientePartido();
        return $coefBase - ($this->getCoefPenalizaciones() * $this->getCantInfracciones());
    }
    public function __toString()
    {
        $cadena = "Partido de Basquetbol:\n";
        $cadena = $cadena . "\n" . "--------------------------------------------------------" . "\n";
        $cadena .= parent::__toString();
        return $cadena;
    }
}
