CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarGuest`(
                in nom VARCHAR(80),
                in ape VARCHAR(100),
                in email VARCHAR(40),
                in phone VARCHAR(20)
            )
BEGIN
                    INSERT INTO guest (nombre, apellidos, correo, telefono) VALUES (nom,ape, email, phone);
                    SELECT id, nombre, apellidos, correo, telefono from guest order by id DESC Limit 1;
            END