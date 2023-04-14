CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarEventos`(
                in codigo VARCHAR(30),
                in nom VARCHAR(200),
                in det TEXT,
                in ubi VARCHAR(250),
                in fecha DATETIME,
                in est VARCHAR(60)
            )
BEGIN
            
                INSERT INTO event (codigo_evento, nombre, detalle, ubicacion, fecha_lanzamiento, estado) VALUES (
                    codigo,
                    nom,
                    det,
                    ubi,
                    fecha,
                    est
                );
                SELECT codigo_evento, nombre, detalle, ubicacion, fecha_lanzamiento, estado from event order by id DESC Limit 1;
            END