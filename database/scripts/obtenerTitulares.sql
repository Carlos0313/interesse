CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerTitulares`(
                in event_id integer
            )
BEGIN
                    SELECT  
                        p.id,
                        p.nombre,
                        p.apellidos,
                        concat(p.nombre,' ',p.apellidos) as nombre_completo,
                        p.correo,
                        p.telefono,
                        (
							SELECT  count(id)
                            FROM asistencia
                            WHERE evento_id = event_id
                            AND acompanante_id IS NOT NULL 
                        ) as qty_acompanantes
                    FROM asistencia as a
                    JOIN principal as p on a.titular_id = p.id
                    WHERE a.evento_id = event_id
                    AND a.es_activo = true
                    AND acompanante_id IS NULL
                    ORDER BY p.nombre ASC; 
                    
            END