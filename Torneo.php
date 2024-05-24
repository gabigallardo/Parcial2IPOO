<?php
class Torneo
{
    private $colObjPartidos;
    private $premio;
    public function __construct($premio)
    {
        $this->colObjPartidos = [];
        $this->premio = $premio;
    }
    public function getColObjPartidos()
    {
        return $this->colObjPartidos;
    }
    public function getPremio()
    {
        return $this->premio;
    }
    public function setColObjPartidos($colPartidos)
    {
        $this->colObjPartidos = $colPartidos;
    }
    public function setPremio($valor)
    {
        $this->premio = $valor;
    }
    // Implementar el método ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido) en
    //  la  clase Torneo el cual recibe por parámetro 2 equipos, la fecha en la que se realizará 
    //  el partido y si se trata de un partido de futbol o basquetbol . El método debe crear y retornar 
    //  la instancia de la clase Partido que corresponda y almacenarla en la colección de partidos del Torneo.
    //   Se debe chequear que los 2 equipos tengan la misma categoría e igual cantidad de jugadores, caso contrario
    //    no podrá ser registrado ese partido en el torneo.  
    public function ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido)
    {
        $retorno = null;
        $codigoPartido = 0;
        if ($OBJEquipo1 == $OBJEquipo2) {
            $retorno = "No se puede hacer el partido ya que son el mismo equipo\n";
        } else {
            if ($OBJEquipo1->getObjCategoria()->getDescripcion() === $OBJEquipo2->getObjCategoria()->getDescripcion() && $OBJEquipo1->getCantJugadores() === $OBJEquipo2->getCantJugadores()) {
                if (!empty($this->getColObjPartidos())) {
                    foreach ($this->getColObjPartidos() as $partido) {
                        $codigoPartido = $partido->getIdpartido();
                    }
                    $codigoPartido += 1;
                } else {
                    $codigoPartido = 1;
                }
                if ($tipoPartido == "Futbol") {
                    $objPartido = new PartidoFutbol($codigoPartido, $fecha, $OBJEquipo1, 0, $OBJEquipo2, 0);
                } else {
                    $objPartido = new PartidoBasquetbol($codigoPartido, $fecha, $OBJEquipo1, 0, $OBJEquipo2, 0, 0);
                }
                array_push($this->getColObjPartidos(), $objPartido);
                $retorno = $objPartido;
            } else {
                $retorno = "Los equipos no son de la misma categoria o no tienen la misma cantidad de jugadores\n";
            }
        }
        return $retorno;
    }
    // Implementar el método darGanadores($deporte) en la clase Torneo que recibe por parámetro
    //  si se trata de un partido de fútbol o de básquetbol y en  base  al parámetro busca entre esos partidos los equipos
    //  ganadores ( equipo con mayor cantidad de goles). El método retorna una colección con los
    //   objetos de los equipos encontrados.
    public function darGanadores($deporte)
    {
        $colEquiposGanadores = [];
        if ($deporte == 'Futbol') {
            foreach ($this->getColObjPartidos() as $partido) {
                if ($partido instanceof PartidoFutbol) {
                    $colEquiposGanadores[] = $partido->darEquipoGanador();
                }
            }
        } else {
            foreach ($this->getColObjPartidos() as $partido) {
                if ($partido instanceof PartidoBasquetbol) {
                    $colEquiposGanadores[] = $partido->darEquipoGanador();
                }
            }
        }
        return $colEquiposGanadores;
    }
    //     Implementar el método calcularPremioPartido($OBJPartido) que debe retornar un arreglo 
    //     asociativo donde una de sus claves es ‘equipoGanador’  y contiene la referencia al equipo ganador
    //     ; y la otra clave es ‘premioPartido’ que contiene el valor obtenido del coeficiente del Partido por 
    //     el importe configurado para el torneo. 
    // (premioPartido = Coef_partido * ImportePremio)
    public function calcularPremioPartido($objPartido)
    {

        if ($objPartido) {
            $coeficientePartido = $objPartido->coeficientePartido();
            $premioPartido = $coeficientePartido * $this->getPremio();
            $equipoGanador = $objPartido->darEquipoGanador();
            $premioPartido = [
                'equipoGanador' => $equipoGanador,
                'premioPartido' => $premioPartido
            ];
        } else {
            $premioPartido = "El partido no se llevo a cabo por ende no se puede calcular el premio";
        }

        return $premioPartido;
    }
    public function __toString()
    {
        $cadena = "";
        $arrayObjPartidos = $this->getColObjPartidos();
        foreach ($arrayObjPartidos as $partido) {
            $infoPartido = $partido->__toString();
            $cadena .= $infoPartido;
        }
        $cadena .= "Premio del torneo: " . $this->getPremio();
        return $cadena;
    }
}
