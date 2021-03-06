<?php
    require_once("../Modelo/Conexion.php");
    class DBFacultad{

        private $conexion;

        function __construct()
        {
            $this->conexion =  new Conexion();
        }
        public function reporteFacultad(){
			$sqlReporteFacultad = "SELECT COUNT(dt.idDocumentoTesis) AS documentos, f.nombre, f.idFacultad
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
                                GROUP BY f.idFacultad;";
            
			$cmd = $this->conexion->prepare($sqlReporteFacultad);
			$cmd->execute();
			$reporteFacultad = $cmd->fetchAll();
			if($reporteFacultad){
				return $reporteFacultad;
			}else{
				return NULL;
			}
        }
        public function reporteAnualFacultad($idFacultad){
			$sqlReporteFacultad = "SELECT COUNT(dt.idDocumentoTesis) AS documentos, f.nombre, YEAR(dt.fechaHoraRegistro) AS anio
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
                                    GROUP BY YEAR(dt.fechaHoraRegistro)
                                    ORDER BY YEAR(dt.fechaHoraRegistro) DESC;";
            
            $cmd = $this->conexion->prepare($sqlReporteFacultad);
            $cmd->bindParam(':idFacultad',$idFacultad);
			$cmd->execute();
			$reporteFacultad = $cmd->fetchAll();
			if($reporteFacultad){
				return $reporteFacultad;
			}else{
				return NULL;
			}
        }
        public function reporteFacultadFecha($fechaInicio,$fechaFin){
			$sqlReporteFacultad = "SELECT COUNT(dt.idDocumentoTesis) AS documentos, f.nombre, f.idFacultad
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
                                    WHERE dt.fechaHoraRegistro > '".$fechaInicio."'
                                    AND dt.fechaHoraRegistro < '".$fechaFin."'
                                    GROUP BY f.idFacultad;";
            $cmd = $this->conexion->prepare($sqlReporteFacultad);
            $cmd->bindParam(':fechaInicio',$fechaInicio);
            $cmd->bindParam(':fechaFin',$fechaFin);
			$cmd->execute();
            $reporteFacultad = $cmd->fetchAll();
            //var_dump($reporteFacultad);
			if($reporteFacultad){
				return $reporteFacultad;
			}else{
				return NULL;
			}
        }
    }
?>