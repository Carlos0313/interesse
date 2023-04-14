CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarGuest`(
                in nom VARCHAR(80),
                in ape VARCHAR(100),
                in email VARCHAR(40),
                in phone VARCHAR(20),
                in guest_id int
            )
BEGIN
                    UPDATE guest 
                    SET nombre =nom
                        ,apellidos=ape
                        ,correo=email
                        ,telefono = phone
                    WHERE id = guest_id;
            
                    SELECT id, nombre, apellidos, correo, telefono from guest  WHERE id = guest_id order by id DESC;
            END