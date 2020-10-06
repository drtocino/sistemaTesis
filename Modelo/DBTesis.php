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
        public function registrarTesis(){
			$sqlIngresarTesis = "INSERT INTO informe(idUsuario,numeroPractica,fechaInicio,fechaFin,iglesia,distrito,grupoPequenio,recepcionSabado)
									VALUES(:idUsuario,:numeroPractica,:fechaInicio,:fechaFin,:iglesia,:distrito,:grupoPequenio,:recepcionSabado)";
			try{
				$cmd = $this->conexion->prepare($sqlIngresarTesis);
				$cmd->bindParam(':idUsuario',$idUsuario);
				$cmd->bindParam(':numeroPractica',$numeroPractica);
				$cmd->bindParam(':fechaInicio',$fechaInicio);
				$cmd->bindParam(':fechaFin',$fechaFin);
				$cmd->bindParam(':iglesia',$iglesia);
				$cmd->bindParam(':distrito',$distrito);
				$cmd->bindParam(':grupoPequenio',$grupoPequenio);
				$cmd->bindParam(':recepcionSabado',$recepcionSabado);
				$cmd->bindParam(':cultoConsagracion',$cultoConsagracion);
				$cmd->bindParam(':consejoMaestros',$consejoMaestros);
				$cmd->bindParam(':escuelaSabatica',$escuelaSabatica);
				$cmd->bindParam(':cultoDivino',$cultoDivino);
				$cmd->bindParam(':claseBiblica',$claseBiblica);
				$cmd->bindParam(':cultoJoven',$cultoJoven);
				$cmd->bindParam(':despedidaSabado',$despedidaSabado);
				$cmd->bindParam(':actividadExtra',$actividadExtra);
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