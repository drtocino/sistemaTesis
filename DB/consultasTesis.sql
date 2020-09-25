/*SELECT dt.idDocumentoTesis,dt.codigoTesis, CONCAT_WS(' ',p.primerApellido,p.segundoApellido,p.primerNombre,p.segundoNombre) AS autor,
dt.titulo, tt.nombre AS tipoTesis, dt.fechaHoraRegistro
FROM tipoTesis tt INNER JOIN documentoTesis dt
ON tt.idTipoTesis = dt.idTipoTesis
INNER JOIN participantesTesis pt
ON dt.idDocumentoTesis = pt.idDocumentoTesis
INNER JOIN persona p
ON pt.idPersona = p.idPersona
INNER JOIN asignacionCarrera ac
ON p.idPersona = ac.idPersona
AND dt.idAsignacionCarrera = ac.idAsignacionCarrera
ORDER BY dt.fechaHoraRegistro DESC;*/


-- 1. ....
SELECT dt.idDocumentoTesis,dt.codigoTesis, CONCAT_WS(' ',p.primerApellido,p.segundoApellido,p.primerNombre,p.segundoNombre) AS autor,
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
AND p.idPersona = ac.idPersona;

-- 2. ....
SELECT CONCAT_WS(' ',p.primerApellido,p.segundoApellido,p.primerNombre,p.segundoNombre) AS autor,dt.titulo,dt.codigoTesis, 
dt.fechaHoraRegistro,tt.nombre AS tipoTesis,f.nombre AS facultad,c.nombre,dt.resumen,dt.codigoTesis
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
AND ac.idAsignacionCarrera = dt.idAsignacionCarrera;

-- 3. a. ...(27)
SELECT COUNT(idDocumentoTesis)
FROM documentoTesis;

-- 3. b. ...(27)
SELECT COUNT(dt.idDocumentoTesis) AS documentos, f.nombre, f.idFacultad
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
GROUP BY f.idFacultad;

-- 28
SELECT COUNT(dt.idDocumentoTesis) AS documentos, f.nombre
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
WHERE dt.fechaHoraRegistro > "2017-11-01"
AND dt.fechaHoraRegistro < "2018-04-01"
GROUP BY f.idFacultad;

-- 29
SELECT COUNT(dt.idDocumentoTesis) AS documentos, c.nombre, f.nombre AS fnombre
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
WHERE f.idFacultad = 2
GROUP BY c.idCarrera;

-- 30
SELECT COUNT(dt.idDocumentoTesis) AS documentos, f.nombre, YEAR(dt.fechaHoraRegistro) AS anio
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
WHERE f.idFacultad = 1
GROUP BY YEAR(dt.fechaHoraRegistro);

--  31
SELECT COUNT(dt.idDocumentoTesis) AS documentos, tt.nombre, c.nombre AS carrera
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
WHERE c.idCarrera = 1
GROUP BY tt.idTipoTesis;