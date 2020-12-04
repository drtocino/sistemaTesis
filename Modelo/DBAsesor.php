<?php
    require_once("../Modelo/Conexion.php");
    class DBAsesor{

        private $conexion;

        function __construct()
        {
            $this->conexion =  new Conexion();
        }

        public function listaAsesor(){
            $sqlListaAsesor = "SELECT *, CONCAT_WS(' ',primerApellido,segundoApellido,primerNombre,segundoNombre) AS nombreCompleto FROM personalTesis ORDER BY segundoApellido";
            $cmd = $this->conexion->prepare($sqlListaAsesor);
			$cmd->execute();
            $listaAsesor = $cmd->fetchAll();
			if($listaAsesor){
				return $listaAsesor;
			}else{
				return NULL;
			}
        }
    }
?>