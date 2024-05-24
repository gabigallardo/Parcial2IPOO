<?php
include_once("Categoria.php");
include_once("Torneo.php");
include_once("Equipo.php");
include_once("Partido.php");
include_once("PartidoFutbol.php");
include_once("PartidoBasquetbol.php");
function contarEquipos($colPartidos)
{
    $equiposUnicos = [];

    foreach ($colPartidos as $partido) {
        $equiposUnicos[$partido->GetObjEquipo1()->getNombre()] = true;
        $equiposUnicos[$partido->GetObjEquipo2()->getNombre()] = true;
    }

    return count($equiposUnicos);
}

$catMayores = new Categoria(1, 'Mayores');
$catJuveniles = new Categoria(2, 'juveniles');
$catMenores = new Categoria(1, 'Menores');

$objE1 = new Equipo("Equipo Uno", "Cap.Uno", 1, $catMayores);
$objE2 = new Equipo("Equipo Dos", "Cap.Dos", 2, $catMayores);

$objE3 = new Equipo("Equipo Tres", "Cap.Tres", 3, $catJuveniles);
$objE4 = new Equipo("Equipo Cuatro", "Cap.Cuatro", 4, $catJuveniles);

$objE5 = new Equipo("Equipo Cinco", "Cap.Cinco", 5, $catMayores);
$objE6 = new Equipo("Equipo Seis", "Cap.Seis", 6, $catMayores);

$objE7 = new Equipo("Equipo Siete", "Cap.Siete", 7, $catJuveniles);
$objE8 = new Equipo("Equipo Ocho", "Cap.Ocho", 8, $catJuveniles);

$objE9 = new Equipo("Equipo Nueve", "Cap.Nueve", 9, $catMenores);
$objE10 = new Equipo("Equipo Diez", "Cap.Diez", 9, $catMenores);

$objE11 = new Equipo("Equipo Once", "Cap.Once", 11, $catMayores);
$objE12 = new Equipo("Equipo Doce", "Cap.Doce", 11, $catMayores);
$torneo = new Torneo(100000);
$partidoBasquetbol1 = new PartidoBasquetbol(11, '2024-05-05', $objE7, 80, $objE8, 120, 7);
$partidoBasquetbol2 = new PartidoBasquetbol(12, '2024-05-06', $objE9, 81, $objE10, 110, 8);
$partidoBasquetbol3 = new PartidoBasquetbol(13, '2024-05-07', $objE11, 115, $objE12, 85, 9);
$partidoFutbol1 = new PartidoFutbol(14, '2024-05-07', $objE1, 3, $objE2, 2);
$partidoFutbol2 = new PartidoFutbol(15, '2024-05-08', $objE3, 0, $objE4, 1);
$partidoFutbol3 = new PartidoFutbol(16, '2024-05-09', $objE5, 2, $objE6, 3);
$torneo->setColObjPartidos([$partidoBasquetbol1, $partidoBasquetbol2, $partidoBasquetbol3, $partidoFutbol1, $partidoFutbol2, $partidoFutbol3]);
$partidoNuevo1 = $torneo->ingresarPartido($objE5, $objE11, '2024-05-23', 'Futbol');
echo $partidoNuevo1;
echo "La cantidad actual de equipos que hay es de " . contarEquipos($torneo->getColObjPartidos()) . "\n";
$partidoNuevo2 = $torneo->ingresarPartido($objE11, $objE11, '2024-05-23', 'Basquetbol');
echo $partidoNuevo2;
echo "La cantidad actual de equipos que hay es de " . contarEquipos($torneo->getColObjPartidos()) . "\n";
$partidoNuevo3 = $torneo->ingresarPartido($objE9, $objE10, '2024-05-25', 'Basquetbol');
echo $partidoNuevo3;
echo "La cantidad actual de equipos que hay es de " . contarEquipos($torneo->getColObjPartidos()) . "\n";
$colGanadoresBasquetbol = $torneo->darGanadores('Basquet');
echo "Equipos ganadores de Basquetbol: \n";
foreach ($colGanadoresBasquetbol as $equipo) {
    echo $equipo;
}
$colGanadoresFutbol = $torneo->darGanadores('Futbol');
echo "Equipos ganadores de Futbol: \n";
foreach ($colGanadoresFutbol as $equipo) {
    echo $equipo;
}
echo $torneo->calcularPremioPartido($partidoNuevo1);
echo $torneo;
