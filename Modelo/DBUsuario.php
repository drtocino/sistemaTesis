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
        public function autentificacion($user,$pass){
            $consulta = "SELECT * FROM persona
                WHERE usuario=:usuario
                AND contrasenia=:contrasenia";
            $cmd = $this->conexion->prepare($consulta);
            $cmd->bindParam(':usuario',$user);
            $cmd->bindParam(':contrasenia',$pass);
            $cmd->execute();
            $result = $cmd->fetch();
            if($result){
                return 1;
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
            $sqlListaUsuarios = "SELECT *, CONCAT_WS(' ',primerNombre,segundoNombre,primerApellido,segundoApellido) AS nombres
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
        public function datosUsuario($idPersona){
            $sqlListaUsuarios = "SELECT *, CONCAT_WS(' ',primerNombre,segundoNombre,primerApellido,segundoApellido) AS nombres
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
    }
?>