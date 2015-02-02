<?php
include_once "lib/functions.php";

$valoradas    = obtenerConsulta("", "valoradas", true);
$consensuadas = obtenerConsulta("", "consensuadas", true);
$debatidas    = obtenerConsulta("", "debatidas", true);
$recientes    = obtenerConsulta("", "recientes", true);
$sectores     = 'SELECT * FROM prog_sectores';
$barrios      = 'SELECT * FROM prog_barrios ORDER BY distrito_id, id';
$distritos    = 'SELECT * FROM prog_distritos';

$datos = array(
    'user' => autentificado(),
    'valoradas' => listar($valoradas),
    'debatidas' => listar($debatidas),
    'recientes' => listar($recientes),
    'consensuadas' => listar($consensuadas),
    'sectores' => listar($sectores),
    'barrios' => listar($barrios),
    'distritos' => listar($distritos)
);

//echo "<pre>";
//var_dump($datos);
//echo "</pre>";

$template = $twig->loadTemplate('index.html');
echo $template->render($datos);

?>