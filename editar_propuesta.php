<?php
include_once "lib/functions.php";

if(isset($_GET["id"]))
{
    $consulta_autor      = "SELECT p.autor_id FROM prog_propuestas as p, prog_users WHERE p.id=:id and p.autor_id=prog_users.id;";
    $consulta_propuestas = "SELECT p.id, p.autor_id, p.titulo,p.propuesta, p.sector_id, p.barrio_id FROM prog_propuestas as p, prog_users WHERE p.id=:id and p.autor_id=prog_users.id;";

    $barrios             = 'SELECT * FROM prog_barrios ORDER BY distrito_id, id';
    $sectores            = 'SELECT * FROM prog_sectores';
    $distritos           = 'SELECT * FROM prog_distritos';
    $id                  = (integer) $_GET['id'];
    $buscaID             = array('id' => $id);
    $autor               = (integer) autor_propuesta($buscaID, $consulta_autor);
    $usuario             = (integer) userid();
	
	//Compruebo que el autor de la propuesta sea el usuario logueado y sólo él pueda editar.
	if($autor == $usuario)
	{
		$datos = array(
			'autor' => $autor,
			'user' => autentificado(),
            'titulo' => 'Editar propuesta',
			'propuesta' => preparada($buscaID, $consulta_propuestas),
            'sectores' => listar($sectores),
            'barrios' => listar($barrios),
            'distritos' => listar($distritos)
		);
        
        $template = $twig->loadTemplate('editar_propuesta.html');
		echo $template->render($datos);
	}
	else
	{
		header('Location:detalle_propuesta.php?id=' . $id);
	}	
}
else
{	
	header('Location:index.php');
}

?>