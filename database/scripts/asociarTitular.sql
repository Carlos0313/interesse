CREATE DEFINER=`root`@`localhost` PROCEDURE `asociarTitular`(
                in event_id integer,
                in titular_id integer
            )
BEGIN
                INSERT INTO asistencia (evento_id, titular_id) VALUES (event_id, titular_id);
                SELECT id, nombre, apellidos, correo, telefono from principal where id = titular_id order by id DESC;
            END