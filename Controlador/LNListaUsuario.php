<?php
require_once("../Modelo/DBUsuario.php");
class LNListaUsuario{
    private $objDBUsuario;
		function __construct(){	
			$this->objDBUsuario = new DBUsuario();
        }

    public function listaUsuario(){
        $lista = $this->objDBUsuario->listaUsuario();
		return $lista;
    }
    public function datosUsuario($idPersona){
        $lista = $this->objDBUsuario->datosUsuario($idPersona);
		return $lista;
    }
    public function datosAsignacionCarrera($idPersona,$idCarrera){
        $lista = $this->objDBUsuario->datosAsignacionCarrera($idPersona,$idCarrera);
		return $lista;
    }
}
?>