<?php
    require_once("../Modelo/Conexion.php");
    class DBCarrera{

        private $conexion;

        function __construct()
        {
            $this->conexion =  new Conexion();
        }
        public function tesisCarrera($idFacultad){
			$sqlTesisCarrera = "SELECT COUNT(dt.idDocumentoTesis) AS documentos, c.nombre, f.nombre AS fnombre, c.idCarrera
                                FROM universidad u INNER JOIN facultad f
                                ON u.idUniversidad = f.idUniversidad
                                INNER JOIN carrera c
                                ON f.idFacultad = c.idFacultad
                                INNER JOIN asignacionCarrera ac
                                ON c.idCarrera = ac.idCarrera
                                INNER JOIN persona p
                                ON ac.idPersona = p.idPersona
                                INNER JOIN participantesTesis pt
                                ON p.idPersona = pt.idPersona
                                INNER JOIN documentoTesis dt
                                ON pt.idDocumentoTesis = dt.idDocumentoTesis
                                INNER JOIN tipoTesis tt
                                ON dt.idTipoTesis = tt.idTipoTesis
                                AND ac.idAsignacionCarrera = dt.idAsignacionCarrera
                                WHERE f.idFacultad = :idFacultad
                                GROUP BY c.idCarrera;";
            
            $cmd = $this->conexion->prepare($sqlTesisCarrera);
            $cmd->bindParam(':idFacultad',$idFacultad);
			$cmd->execute();
			$tesisCarrera = $cmd->fetchAll();
			if($tesisCarrera){
				return $tesisCarrera;
			}else{
				return NULL;
			}
        }
        public function tesisCarreraModalidad($idCarrera){
			$sqlTesisCarrera = "SELECT COUNT(dt.idDocumentoTesis) AS documentos, tt.idTipoTesis, tt.nombre, c.nombre AS carrera
                                FROM universidad u INNER JOIN facultad f
                                ON u.idUniversidad = f.idUniversidad
                                INNER JOIN carrera c
                                ON f.idFacultad = c.idFacultad
                                INNER JOIN asignacionCarrera ac
                                ON c.idCarrera = ac.idCarrera
                                INNER JOIN persona p
                                ON ac.idPersona = p.idPersona
                                INNER JOIN participantesTesis pt
                                ON p.idPersona = pt.idPersona
                                INNER JOIN documentoTesis dt
                                ON pt.idDocumentoTesis = dt.idDocumentoTesis
                                INNER JOIN tipoTesis tt
                                ON dt.idTipoTesis = tt.idTipoTesis
                                AND ac.idAsignacionCarrera = dt.idAsignacionCarrera
                                WHERE c.idCarrera = :idCarrera
                                GROUP BY tt.idTipoTesis;";
            
            $cmd = $this->conexion->prepare($sqlTesisCarrera);
            $cmd->bindParam(':idCarrera',$idCarrera);
			$cmd->execute();
			$tesisCarrera = $cmd->fetchAll();
			if($tesisCarrera){
				return $tesisCarrera;
			}else{
				return NULL;
			}
		}
    }
?>