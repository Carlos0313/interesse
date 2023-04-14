CREATE DEFINER=`root`@`localhost` PROCEDURE `asociarTitularGuest`(
                in event_id integer,
                in titular_id integer,
                in guest_id integer
            )
BEGIN
                INSERT INTO asistencia (evento_id, titular_id, acompanante_id) VALUES (event_id, titular_id, guest_id);
                SELECT id, nombre, apellidos, correo, telefono from guest where id = guest_id order by id DESC;
            END