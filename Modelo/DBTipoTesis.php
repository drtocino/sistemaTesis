<?php
    require_once("../Modelo/Conexion.php");
    class DBTipoTesis{

        private $conexion;

        function __construct()
        {
            $this->conexion =  new Conexion();
        }

        public function listaTipoTesis(){
			$sqlListaCarrera = "SELECT idTipoTesis,nombre
                                FROM tipoTesis;";
            $cmd = $this->conexion->prepare($sqlListaCarrera);
            $cmd->bindParam(':idFacultad',$idFacultad);
			$cmd->execute();
			$listaCarrera = $cmd->fetchAll();
			if($listaCarrera){
				return $listaCarrera;
			}else{
				return NULL;
			}
		}
    }
?>