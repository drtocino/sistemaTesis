DROP DATABASE IF EXISTS tesis;
CREATE DATABASE tesis;
USE tesis
-- TABLAS PRIMARIAS
-- Carlos
CREATE TABLE universidad (
idUniversidad INT PRIMARY KEY AUTO_INCREMENT,
nombre VARCHAR(35) NOT NULL,
direccion VARCHAR(75),
telefono VARCHAR(15),
logo VARCHAR(400) NOT NULL
)ENGINE=InnoDB;

-- Crear Facultad
CREATE TABLE facultad(
idFacultad INT PRIMARY KEY AUTO_INCREMENT,
idUniversidad INT NOT NULL,
nombre VARCHAR(50),
sigla VARCHAR(5),
FOREIGN KEY(idUniversidad) REFERENCES universidad(idUniversidad) 
)ENGINE=InnoDB;

-- Jose Maria
CREATE TABLE rol(
idRol INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(30) NOT NULL
)ENGINE=InnoDB;

-- Kevin Rod
CREATE TABLE tipotesis(
idTipoTesis INT UNSIGNED NOT NULL  AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(25) NOT NULL
)ENGINE=InnoDB;


-- Cristofer
CREATE TABLE rolPersonalTesis(
idRolPersonalTesis INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(15) NOT NULL
)ENGINE=InnoDB;
	
-- TABLAS RELACIONALES
-- Edson
CREATE TABLE carrera (
idCarrera INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
idFacultad  INT NOT NULL,
nombre VARCHAR(50) NOT NULL,
sigla VARCHAR(5) NOT NULL,
FOREIGN KEY(idFacultad) REFERENCES facultad(idFacultad)
)ENGINE = InnoDB;

-- Jose Zapata
create table persona (
idPersona INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
idRol INT UNSIGNED NOT NULL,
ci INT (10) NOT NULL,
primerNombre VARCHAR (15) NOT NULL,  
segundoNombre VARCHAR (15),
primerApellido VARCHAR (15) NOT NULL,
segundoApellido VARCHAR (15),
telefono INT (10) NOT NULL,
fotografia longblob , -- Pensar estudiantes el tipo
activo boolean NOT NULL DEFAULT 1,
usuario VARCHAR (50) NOT NULL,
contrasenia VARCHAR (50) NOT NULL,
fechaRegistro DATETIME NOT NULL,
fechaActualizacion DATETIME NOT NULL,
FOREIGN KEY (idRol) REFERENCES rol(idRol)
)ENGINE=InnoDB;

-- Neftali
CREATE TABLE personalTesis(
idPersonalTesis INT AUTO_INCREMENT PRIMARY KEY,
ci VARCHAR(10) UNIQUE NOT NULL,
primerNombre VARCHAR(15)NOT NULL,
segundoNombre VARCHAR(15),
apellidoPaterno VARCHAR(15)NOT NULL,
apellidoMaterno VARCHAR(15) 
)ENGINE=InnoDB;

-- FAUSTO
create table asignacionCarrera(
idAsignacionCarrera INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
idCarrera INT UNSIGNED NOT NULL,
idPersona INT UNSIGNED NOT NULL,
FOREIGN KEY(idCarrera) REFERENCES carrera(idCarrera),
FOREIGN KEY(idPersona) REFERENCES persona(idPersona)
)ENGINE=InnoDB;

-- DILAN Y DOUGLAS
CREATE TABLE documentoTesis(
idDocumentoTesis INT AUTO_INCREMENT PRIMARY KEY,
idAsignacionCarrera INT UNSIGNED NOT NULL,
idTipoTesis INT UNSIGNED NOT NULL,
codigoTesis VARCHAR (30) UNIQUE NOT NULL,
fechaHoraRegistro DATETIME NOT NULL,
titulo VARCHAR(200),
resumen LONGTEXT,
introduccion LONGTEXT,
palabrasClave VARCHAR(100),
imagenTapaTesis VARCHAR(200),
documentoCompleto VARCHAR(100),
FOREIGN KEY(idAsignacionCarrera) REFERENCES asignacionCarrera(idAsignacionCarrera),
FOREIGN KEY(idTipoTesis) REFERENCES tipoTesis(idTipoTesis)
)ENGINE=InnoDB;

-- RODRIGO
CREATE TABLE participantesTesis (
idDocumentoTesis INT NOT NULL,
idPersona INT UNSIGNED NOT NULL,
idPersonalTesis INT NOT NULL,
idRolPersonalTesis INT UNSIGNED NOT NULL,
FOREIGN KEY(idDocumentoTesis) REFERENCES documentoTesis(idDocumentoTesis),
FOREIGN KEY(idPersona) REFERENCES persona(idPersona),
FOREIGN KEY(idPersonalTesis) REFERENCES personalTesis(idPersonalTesis),
FOREIGN KEY(idRolPersonalTesis) REFERENCES rolPersonalTesis(idRolPersonalTesis)
)ENGINE=InnoDB;