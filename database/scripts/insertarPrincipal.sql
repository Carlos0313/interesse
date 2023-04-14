CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarPrincipal`(                
                in nom VARCHAR(80),
                in ape VARCHAR(100),
                in email VARCHAR(40),
                in phone VARCHAR(20)
            )
BEGIN
                INSERT INTO principal (nombre, apellidos, correo, telefono) VALUES (nom,ape, email, phone);
                SELECT id, nombre, apellidos, correo, telefono from principal order by id DESC Limit 1;
            END