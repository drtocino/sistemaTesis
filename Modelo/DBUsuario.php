<?php
    require_once("../Modelo/Conexion.php");
    class DBUsuario{

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
        public function autentificacion($user){
            $consulta = "SELECT * FROM persona
                WHERE usuario=:usuario;";
            $cmd = $this->conexion->prepare($consulta);
            $cmd->bindParam(':usuario',$user);
            //$cmd->bindParam(':contrasenia',$pass);
            $cmd->execute();
            $result = $cmd->fetch();
            if($result){
                /*echo $result[0][];
                if(password_verify($result,)){

                }*/
                //var_dump($result);
                //echo "hello";
                return $result;
            }else{
                return 0;
            }
        }
        public function datosUsuarioUser($usuario){
			$sqlListaDeEstudiantes = "SELECT * FROM persona WHERE usuario = :usuario;";
            $cmd = $this->conexion->prepare($sqlListaDeEstudiantes);
            $cmd->bindParam(':usuario',$usuario);
			$cmd->execute();
            $listaEstudiantes = $cmd->fetch();
			if($listaEstudiantes){
				return $listaEstudiantes;
			}else{
				return NULL;
			}
        }
        public function listaUsuario(){
            $sqlListaUsuarios = "SELECT *, CONCAT_WS(' ',primerApellido,segundoApellido,primerNombre,segundoNombre) AS nombres
                                FROM persona;";
            $cmd = $this->conexion->prepare($sqlListaUsuarios);
			$cmd->execute();
			$listaUsuarios = $cmd->fetchAll();
			if($listaUsuarios){
				return $listaUsuarios;
			}else{
				return NULL;
			}
		}
		public function busquedaUsuario($estado,$tipoUsuario){
            $sqlListaUsuarios = "SELECT *, CONCAT_WS(' ',primerApellido,segundoApellido,primerNombre,segundoNombre) AS nombres
                                FROM persona
								WHERE activo LIKE '%".$estado."%'
								AND idRol LIKE '%".$tipoUsuario."%';";
								
			$cmd = $this->conexion->prepare($sqlListaUsuarios);
			$cmd->bindParam(':estado',$estado);
			$cmd->bindParam(':tipoUsuario',$tipoUsuario);
			$cmd->execute();
			$listaUsuarios = $cmd->fetchAll();
			if($listaUsuarios){
				return $listaUsuarios;
			}else{
				return NULL;
			}
        }
        public function datosUsuario($idPersona){
            $sqlListaUsuarios = "SELECT *, CONCAT_WS(' ',primerApellido,segundoApellido,primerNombre,segundoNombre) AS nombres
                                FROM persona
                                WHERE idPersona = :idPersona;";
            $cmd = $this->conexion->prepare($sqlListaUsuarios);
            $cmd->bindParam(':idPersona',$idPersona);
            $cmd->execute();
            $listaUsuarios = $cmd->fetch();
			if($listaUsuarios){
				return $listaUsuarios;
			}else{
				return NULL;
			}
        }
        public function datosAsignacion($idPersona){
            $sqlListaUsuarios = "SELECT ac.idAsignacionCarrera,CONCAT_WS(' ',p.primerApellido,p.segundoApellido,p.primerNombre,p.segundoNombre) AS autor, c.nombre AS carrera
                                    FROM universidad u INNER JOIN facultad f
                                    ON u.idUniversidad = f.idUniversidad
                                    INNER JOIN carrera c
                                    ON f.idFacultad = c.idFacultad
                                    INNER JOIN asignacionCarrera ac
                                    ON c.idCarrera = ac.idCarrera
                                    INNER JOIN persona p
                                    ON ac.idPersona = p.idPersona
                                    WHERE p.idPersona = :idPersona
                                    ORDER BY p.primerApellido;";
            $cmd = $this->conexion->prepare($sqlListaUsuarios);
            $cmd->bindParam(':idPersona',$idPersona);
            $cmd->execute();
            $listaUsuarios = $cmd->fetch();
			if($listaUsuarios){
				return $listaUsuarios;
			}else{
				return NULL;
			}
        }
        public function ciExiste($ci){
            $sqlListaUsuarios = "SELECT *, CONCAT_WS(' ',primerApellido,segundoApellido,primerNombre,segundoNombre) AS nombres
                                FROM persona
                                WHERE ci = :ci;";
            $cmd = $this->conexion->prepare($sqlListaUsuarios);
            $cmd->bindParam(':ci',$ci);
            $cmd->execute();
            $listaUsuarios = $cmd->fetch();
			if($listaUsuarios){
				return 1;
			}else{
				return NULL;
			}
        }
        public function registrarUsuario($primerNombre,$segundoNombre,$primerApellido,$segundoApellido,$ci,$rol,$telefono,$fotografia,$fechaRegistro,$usuario,$contrasenia){
			$sqlIngresarTesis = "INSERT INTO persona(primerNombre,segundoNombre,primerApellido,segundoApellido,ci,idRol,telefono,fotografia,fechaRegistro,usuario,contrasenia,activo)
									VALUES(:primerNombre,:segundoNombre,:primerApellido,:segundoApellido,:ci,:rol,:telefono,:fotografia,:fechaRegistro,:usuario,:contrasenia,1);";
			try{
				$cmd = $this->conexion->prepare($sqlIngresarTesis);
				$cmd->bindParam(':rol',$rol);
				$cmd->bindParam(':ci',$ci);
				$cmd->bindParam(':primerNombre',$primerNombre);
				$cmd->bindParam(':segundoNombre',$segundoNombre);
				$cmd->bindParam(':primerApellido',$primerApellido);
				$cmd->bindParam(':segundoApellido',$segundoApellido);
                $cmd->bindParam(':telefono',$telefono);
                $cmd->bindParam(':fotografia',$fotografia);
                $cmd->bindParam(':usuario',$usuario);
                $cmd->bindParam(':contrasenia',$contrasenia);
                $cmd->bindParam(':fechaRegistro',$fechaRegistro);
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
        public function actualizarUsuario($idPersona,$primerNombre,$segundoNombre,$primerApellido,$segundoApellido,$ci,$idRol,$telefono,$fotografia,$fechaActualizacion,$usuario,$contrasenia,$activo){
			$sqlActualizarUsuario= "UPDATE persona
									SET idRol = :idRol, primerNombre = :primerNombre, segundoNombre = :segundoNombre, primerApellido = :primerApellido, segundoApellido = :segundoApellido,
									ci = :ci, telefono = :telefono, fechaActualizacion = :fechaActualizacion, fotografia = :fotografia, usuario = :usuario, contrasenia = :contrasenia, activo = :activo
									WHERE idPersona = :idPersona;";
			try{
				$cmd = $this->conexion->prepare($sqlActualizarUsuario);
					$cmd->bindParam(':idPersona', $idPersona);
					$cmd->bindParam(':primerNombre', $primerNombre);
					$cmd->bindParam(':segundoNombre', $segundoNombre);
					$cmd->bindParam(':primerApellido', $primerApellido);
					$cmd->bindParam(':segundoApellido', $segundoApellido);
					$cmd->bindParam(':ci', $ci);
                	$cmd->bindParam(':idRol', $idRol);
					$cmd->bindParam(':telefono', $telefono);
                    $cmd->bindParam(':fotografia', $fotografia);
					$cmd->bindParam(':fechaActualizacion', $fechaActualizacion);
					$cmd->bindParam(':usuario', $usuario);
                    $cmd->bindParam(':contrasenia', $contrasenia);
					$cmd->bindParam(':activo', $activo);
					if($cmd->execute()){
						return 1;  	
					}else{
						return 0;
					}
			}catch(PDOException $e){
				echo 'ERROR: No se logro realizar la actualizacion'.$e->getMesage();
				exit();
				return 0;
			}
		}
        public function registrarAsignacionCarrera($idCarrera,$idPersona){
			$sqlIngresarTesis = "INSERT INTO asignacionCarrera(idCarrera,idPersona)
									VALUES(:idCarrera,:idPersona);";
			try{
				$cmd = $this->conexion->prepare($sqlIngresarTesis);
				$cmd->bindParam(':idCarrera',$idCarrera);
				$cmd->bindParam(':idPersona',$idPersona);
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
        public function actualizarAsignacionCarrera($idAsignacionCarrera,$idCarrera,$idPersona){
			$sqlIngresarTesis = "UPDATE asignacionCarrera
                                 SET idCarrera = :idCarrera, idPersona = :idPersona
                                 WHERE idAsignacionCarrera = :idAsignacionCarrera;";
			try{
                $cmd = $this->conexion->prepare($sqlIngresarTesis);
                $cmd->bindParam(':idAsignacionCarrera',$idAsignacionCarrera);
				$cmd->bindParam(':idCarrera',$idCarrera);
				$cmd->bindParam(':idPersona',$idPersona);
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
        public function datosAsignacionCarrera($idPersona,$idCarrera){
            $sqlListaUsuarios = "SELECT *
                                FROM asignacionCarrera
                                WHERE idPersona = :idPersona
                                AND idCarrera = :idCarrera;";
            $cmd = $this->conexion->prepare($sqlListaUsuarios);
            $cmd->bindParam(':idPersona',$idPersona);
            $cmd->bindParam(':idCarrera',$idCarrera);
            $cmd->execute();
            $listaUsuarios = $cmd->fetch();
			if($listaUsuarios){
				return $listaUsuarios;
			}else{
				return NULL;
			}
        }
    }
?>