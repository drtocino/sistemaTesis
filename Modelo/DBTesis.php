<?php
    require_once("../Modelo/Conexion.php");
    class DBTesis{

        private $conexion;

        function __construct()
        {
            $this->conexion =  new Conexion();
        }
        public function listaTesis($busqueda){
			$sqlListaUsuarios = "SELECT dt.idDocumentoTesis,dt.codigoTesis, CONCAT_WS(' ',p.primerApellido,p.segundoApellido,p.primerNombre,p.segundoNombre) AS autor,
                                    dt.titulo, tt.nombre AS tipoTesis, dt.fechaHoraRegistro
                                    FROM rol r INNER JOIN persona p
                                    ON r.idRol = p.idRol
                                    INNER JOIN participantesTesis pt
                                    ON p.idPersona = pt.idPersona
                                    INNER JOIN documentoTesis dt
                                    ON pt.idDocumentoTesis = dt.idDocumentoTesis
                                    INNER JOIN tipoTesis tt
                                    ON dt.idTipoTesis = tt.idTipoTesis
                                    INNER JOIN asignacionCarrera ac
                                    ON dt.idAsignacionCarrera = ac.idAsignacionCarrera
                                    AND p.idPersona = ac.idPersona
                                    WHERE dt.titulo LIKE '%".$busqueda."%'
                                        ORDER BY dt.fechaHoraRegistro DESC;";
            
			$cmd = $this->conexion->prepare($sqlListaUsuarios);
			$cmd->execute();
			$listaUsuarios = $cmd->fetchAll();
			if($listaUsuarios){
				return $listaUsuarios;
			}else{
				return NULL;
			}
		}
        public function detalleTesis($idTesis){
			$sqlDatosTesis = "SELECT CONCAT_WS(' ',p.primerApellido,p.segundoApellido,p.primerNombre,p.segundoNombre) AS autor,dt.titulo,dt.codigoTesis, 
                                dt.fechaHoraRegistro,tt.nombre AS tipoTesis,f.nombre AS facultad,c.nombre AS carrera,dt.resumen,dt.codigoTesis,dt.imagenTapaTesis
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
                                WHERE dt.idDocumentoTesis = :idTesis;";
            
            $cmd = $this->conexion->prepare($sqlDatosTesis);
            $cmd->bindParam(':idTesis',$idTesis);
			$cmd->execute();
			$datosTesis = $cmd->fetch();
			if($datosTesis){
				return $datosTesis;
			}else{
				return NULL;
			}
		}
    }
?>