go
CREATE VIEW vista_examenes AS
SELECT 
    ex.id, 
    ex.nombre as nombre_examen,
    ex.descripcion, 
    ex.[III-1] as n1,
    ex.[II-2] as n2,
    ex.[II-1] as n3,
    ex.[I-4] as n4,
    ex.[I-3] as n5,
    ex.[I-2] as n6,
    ex.[I-1] as n7,
    ex.tipo_examen_id,
    ex.tipo_muestra_id,
    ex.estado,
    tex.id as identificador_texamen,
    tex.nombre as nombre_texamen,
    tex.descripcion as descripcion_texamen
FROM examens as ex
INNER JOIN tipo_examens as tex ON ex.tipo_examen_id = tex.id;
go
select * from vista_examenes
