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
    public function registroParticipante($primerNombre,$segundoNombre,$primerApellido,$segundoApellido,$ci,$fotografia){
        $sqlRegistroParticipante = "INSERT INTO personalTesis(primerNombre,segundoNombre,primerApellido,segundoApellido,ci)
                                    VALUES(:primerNombre,:segundoNombre,:primerApellido,:segundoApellido,:ci);";
        try{
            $cmd = $this->conexion->prepare($sqlRegistroParticipante);
            $cmd->bindParam(':primerNombre',$primerNombre);
            $cmd->bindParam(':segundoNombre',$segundoNombre);
            $cmd->bindParam(':primerApellido',$primerApellido);
            $cmd->bindParam(':segundoApellido',$segundoApellido);
            $cmd->bindParam(':ci',$ci);
            //$cmd->bindParam(':fotografia',$fotografia);
            if($cmd->execute()){
                var_dump($cmd);
                return 1;  	
            }else{
                var_dump($cmd);
                return 0;
            }

        }catch(PDOException $e){
            echo 'ERROR: No se logro realizar la nueva insercion - '.$e->getMesage();
            exit();
            return 0;
        }
        
    }
}
?>