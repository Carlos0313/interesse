CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerEventos`()
BEGIN
                SELECT 
                    e.id,
                    e.codigo_evento, 
                    e.nombre, 
                    e.detalle, 
                    e.ubicacion, 
                    e.fecha_lanzamiento, 
                    e.estado,
                    (
						SELECT 
							count(a.id)
						FROM asistencia as a
                        WHERE a.evento_id = e.id
                        AND es_activo = true
                    ) as asistentes
                FROM event as e
                WHERE e.es_activo = true
                ORDER BY e.fecha_lanzamiento desc;
            END