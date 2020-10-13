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
		public function listaTesisCarrera($busqueda,$idCarrera,$idTipoTesis){
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
									INNER JOIN carrera c
									ON ac.idCarrera = c.idCarrera
									INNER JOIN facultad f
									ON c.idFacultad = f.idFacultad
									INNER JOIN universidad u
									ON f.idUniversidad = u.idUniversidad
                                    WHERE dt.titulo LIKE '%".$busqueda."%'
									AND c.idCarrera = :idCarrera
									AND tt.idTipoTesis = :idTipoTesis
                                    ORDER BY dt.fechaHoraRegistro DESC;";
            
			$cmd = $this->conexion->prepare($sqlListaUsuarios);
			$cmd->bindParam(':idCarrera',$idCarrera);
			$cmd->bindParam(':idTipoTesis',$idTipoTesis);
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
                                dt.fechaHoraRegistro,tt.nombre AS tipoTesis,f.nombre AS facultad,c.nombre AS carrera,dt.resumen,dt.codigoTesis,dt.imagenTapaTesis, dt.introduccion, p.fotografia
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
        public function registrarTesis($idAsignacionCarrera,$titulo,$tipoBibliografia,$fechaHoraRegistro,$resumen,$introduccion,$imagenTapa){
			$sqlIngresarTesis = "INSERT INTO documentoTesis(idAsignacionCarrera,titulo,idTipoTesis,fechaHoraRegistro,resumen,introduccion,imagenTapa)
									VALUES(:idAsignacionCarrera,:titulo,:tipoBibliografia,:fechaHoraRegistro,:resumen,:introduccion,:imagenTapa)";
			try{
				$cmd = $this->conexion->prepare($sqlIngresarTesis);
				$cmd->bindParam(':titulo',$titulo);
				$cmd->bindParam(':tipoBibliografia',$tipoBibliografia);
				$cmd->bindParam(':fechaHoraRegistro',$fechaHoraRegistro);
				$cmd->bindParam(':resumen',$resumen);
				$cmd->bindParam(':introduccion',$introduccion);
				$cmd->bindParam(':imagenTapa',$imagenTapa);
				$cmd->bindParam(':idAsignacionCarrera',$idAsignacionCarrera);
				if($cmd->execute()){
					return 1;  	
				}else{
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