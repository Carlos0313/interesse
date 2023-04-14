CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarPrincipal`(
                in nom VARCHAR(80),
                in ape VARCHAR(100),
                in email VARCHAR(40),
                in phone VARCHAR(20),
                in titular_id int
            )
BEGIN
                        UPDATE principal 
                        SET nombre =nom
                            ,apellidos=ape
                            ,correo=email
                            ,telefono = phone
                        WHERE id = titular_id;

                        SELECT id, nombre, apellidos, correo, telefono from principal  WHERE id = titular_id order by id DESC;
            END