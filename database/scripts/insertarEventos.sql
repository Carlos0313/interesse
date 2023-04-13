CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarEventos`(
                in codigo_evento VARCHAR(30),
                in nombre VARCHAR(200),
                in detalle TEXT,
                in ubicacion VARCHAR(250),
                in fecha_lanzamiento DATETIME,
                in estado VARCHAR(60)
            )
BEGIN
            
                INSERT INTO event VALUES (
                    codigo_evento,
                    nombre,
                    detalle,
                    ubicacion,
                    fecha_lanzamiento,
                    estado
                    );
            END