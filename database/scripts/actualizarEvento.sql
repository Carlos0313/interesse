CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarEvento`(
                in codigo VARCHAR(30),
                in nom VARCHAR(200),
                in det TEXT,
                in ubi VARCHAR(250),
                in fecha DATETIME,
                in est VARCHAR(60),
                in evento_id int
            )
BEGIN

                UPDATE event 
                SET codigo_evento=codigo
                ,nombre=nom
                ,detalle=det
                ,ubicacion=ubi
                ,fecha_lanzamiento = fecha
                ,estado = est
                WHERE id = evento_id;

                SELECT codigo_evento, nombre, detalle, ubicacion, fecha_lanzamiento, estado from event order by id DESC Limit 1;
            END