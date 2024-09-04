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

go

create view v_departamentos
as
  SELECT 
    MIN([id]) AS id, -- Selecciona el ID mínimo o cualquier otro valor de agregación que prefieras
    [departamento_inei],
    [departamento]
FROM 
    [laboratorio_referencial].[dbo].[ubigeos]
GROUP BY 
    [departamento_inei], [departamento]
go

create view v_pacientes
as
select td.descripcion_larga, td.descripcion_corta,p.* from pacientes as p
inner join tipo_doc_identidads as td on td.id = p.tipoDocIndentidad_id
go
create procedure p_provincia_x_departamento @departamento_inei integer
as
select   MIN([id]) AS id, provincia_inei, provincia from ubigeos where departamento_inei = 15
group by
provincia_inei, provincia
go

create procedure p_distrito_x_provincia @provincia_inei integer
as
select id, ubigeo_reniec,ubigeo_inei,distrito from ubigeos where provincia_inei = @provincia_inei

    
