<?php
require_once("../Modelo/Conexion.php");
class DBParticipante{

    private $conexion;

    function __construct()
    {
        $this->conexion =  new Conexion();
    }

    public function listaParticipante(){
        $sqlListaParticipante = "SELECT *, CONCAT_WS(' ',primerApellido,segundoApellido,primerNombre,segundoNombre) AS nombreCompleto
                            FROM personaltesis;";
        $cmd = $this->conexion->prepare($sqlListaParticipante);
        $cmd->execute();
        $listaParticipante = $cmd->fetchAll();
        if($listaParticipante){
            return $listaParticipante;
        }else{
            return NULL;
        }
    }
}
?>