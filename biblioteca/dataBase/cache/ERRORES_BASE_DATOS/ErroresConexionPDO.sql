----------------------------------------INICIO FECHA: 02-02-2023 08:38:50----------------------------------------
ARCHIVO: E:\Archivos de programa\xampp\htdocs\DEV\biblioteca\biblioteca\dataBase\index.php
LINEA: 66
FUNCION CLASE PDO: selectPointer
FUNCION CLASE: 
MENSAJE:
SQLSTATE[42601]: Syntax error: 7 ERROR:  error de sintaxis en o cerca de Â«ANDÂ»
LINE 52:                   AND hsm.tipo_solicitud = 'M'
                           ^
CONSULTA:

SELECT 
                hfq.ingreso
                , i.tipo_id_paciente
                , i.paciente_id
                , p.primer_nombre||' '||p.segundo_nombre||' '||p.primer_apellido||' '||p.segundo_apellido as nombre_paciente
                , pqd.diagnostico_id as cod_diagnostico
                , d.diagnostico_nombre as descrpcion_diagnostico
                , pq.descripcion as descripcion_protocolo
                , hfq.codigo_producto as cod_producto
                , ip.descripcion as descripcion_producto
                , hfme.dosis||' '||hfme.unidad_dosificacion as dosis_unidadDosificacion
                , hfme.frecuencia
                , hfq.fecha_aplicacion
                , CASE 
                    WHEN epq.apto_aplicacion1 = '1' THEN 'SI'
                    WHEN epq.apto_aplicacion1 = '2' THEN 'NO'
                  END as apto_aplicacion1
                , CASE 
                    WHEN epq.apto_aplicacion2 = '1' THEN 'SI' 
                    WHEN epq.apto_aplicacion2 = '2' THEN 'NO'
                  END as apto_aplicacion2
                , hsmd.solicitud_id
                , CASE
                  WHEN hsm.sw_estado = '0' THEN 'SIN DESPACHO'
                  WHEN hsm.sw_estado = '1' THEN 'DESPACHADO DESDE FARMACIA'
                  WHEN hsm.sw_estado = '2' THEN 'DESPACHO CONFIRMADO'
                  WHEN hsm.sw_estado = '3' THEN 'CANCELADO'
                  WHEN hsm.sw_estado = '4' THEN 'CONSUMO DIRECTO'
                  WHEN hsm.sw_estado = '5' THEN 'RECIBIDO PARCIALMENTE'
                  WHEN hsm.sw_estado = '6' THEN 'DESPACHO DESDE BODEGA Y CANCELADO EN LA ESTACION'
                  END as estado_solicitud

                  FROM hc_protocolo_formulacion_quimioterapia pfq
                  INNER JOIN fase_riesgo_ciclo_quimioterapia frcq ON (frcq.fase_riesgo_ciclo_id = pfq.fase_riesgo_ciclo_id)
                  INNER JOIN hc_formulacion_quimioterapia hfq ON (hfq.fase_riesgo_ciclo_id = frcq.fase_riesgo_ciclo_id AND hfq.fase_riesgo_ciclo_id = pfq.fase_riesgo_ciclo_id)
                  LEFT JOIN medicamentos m ON (m.codigo_medicamento = hfq.codigo_producto)
                  INNER JOIN ingresos i ON (i.ingreso = pfq.ingreso AND i.ingreso = hfq.ingreso)
                  INNER JOIN pacientes p ON (p.tipo_id_paciente = i.tipo_id_paciente AND p.paciente_id = i.paciente_id)
                  LEFT JOIN hc_solicitudes_medicamentos hsm ON (hsm.ingreso = hfq.ingreso)
                  INNER JOIN hc_solicitudes_medicamentos_d hsmd ON (hsmd.ingreso = hsm.ingreso AND hsmd.ingreso = hfq.ingreso AND hsmd.solicitud_id = hsm.solicitud_id AND hsmd.medicamento_id = hfq.codigo_producto AND hsmd.num_reg = hfq.num_reg_formulacion)
                  INNER JOIN hc_formulacion_medicamentos_eventos hfme ON (hfme.num_reg = hfq.num_reg_formulacion AND hfme.codigo_producto = hfq.codigo_producto AND hfme.ingreso = hfq.ingreso AND hfme.ingreso = pfq.ingreso)
                  LEFT JOIN encabezado_encuesta_pacientes_quimioterapia epq ON (epq.ingreso = hfme.ingreso AND epq.ingreso = i.ingreso AND epq.fecha_aplicacion = hfq.fecha_aplicacion)
                  INNER JOIN inventarios_productos ip ON (ip.codigo_producto = hfme.codigo_producto AND ip.codigo_producto = hfq.codigo_producto)
                  INNER JOIN fase_quimioterapia fq ON (fq.fase_id = frcq.fase_id)
                  LEFT JOIN protocolo_quimioterapia pq ON (pq.protocolo_id = fq.protocolo_id)
                  LEFT JOIN protocolo_quimioterapia_diagnostico pqd ON (pqd.protocolo_id = fq.protocolo_id AND pqd.protocolo_id = pq.protocolo_id)
                  LEFT JOIN diagnosticos d ON (d.diagnostico_id = pqd.diagnostico_id)
                                   
                  WHERE hfq.fecha_aplicacion::date BETWEEN '2023-01-20' AND '2023-01-20'
                           and         
                  AND hsm.tipo_solicitud = 'M'
                  ORDER BY hfq.fecha_aplicacion, hsmd.solicitud_id
                  limit 20;

PARAMETROS:
NULL
----------------------------------------FIN FECHA: 02-02-2023 08:38:50----------------------------------------

----------------------------------------INICIO FECHA: 02-02-2023 08:54:47----------------------------------------
ARCHIVO: E:\Archivos de programa\xampp\htdocs\DEV\biblioteca\biblioteca\dataBase\index.php
LINEA: 64
FUNCION CLASE PDO: selectPointer
FUNCION CLASE: 
MENSAJE:
SQLSTATE[42601]: Syntax error: 7 ERROR:  error de sintaxis en o cerca de Â«ORDERÂ»
LINE 51:                   ORDER BY hfq.fecha_aplicacion, hsmd.solici...
                           ^
CONSULTA:

SELECT DISTINCT 
                hfq.ingreso
                , i.tipo_id_paciente
                , i.paciente_id
                , p.primer_nombre||' '||p.segundo_nombre||' '||p.primer_apellido||' '||p.segundo_apellido as nombre_paciente
                , pqd.diagnostico_id as cod_diagnostico
                , d.diagnostico_nombre as descrpcion_diagnostico
                , pq.descripcion as descripcion_protocolo
                , hfq.codigo_producto as cod_producto
                , ip.descripcion as descripcion_producto
                , hfme.dosis||' '||hfme.unidad_dosificacion as dosis_unidadDosificacion
                , hfme.frecuencia
                , hfq.fecha_aplicacion
                , CASE 
                    WHEN epq.apto_aplicacion1 = '1' THEN 'SI'
                    WHEN epq.apto_aplicacion1 = '2' THEN 'NO'
                  END as apto_aplicacion1
                , CASE 
                    WHEN epq.apto_aplicacion2 = '1' THEN 'SI' 
                    WHEN epq.apto_aplicacion2 = '2' THEN 'NO'
                  END as apto_aplicacion2
                , hsmd.solicitud_id
                , CASE
                  WHEN hsm.sw_estado = '0' THEN 'SIN DESPACHO'
                  WHEN hsm.sw_estado = '1' THEN 'DESPACHADO DESDE FARMACIA'
                  WHEN hsm.sw_estado = '2' THEN 'DESPACHO CONFIRMADO'
                  WHEN hsm.sw_estado = '3' THEN 'CANCELADO'
                  WHEN hsm.sw_estado = '4' THEN 'CONSUMO DIRECTO'
                  WHEN hsm.sw_estado = '5' THEN 'RECIBIDO PARCIALMENTE'
                  WHEN hsm.sw_estado = '6' THEN 'DESPACHO DESDE BODEGA Y CANCELADO EN LA ESTACION'
                  END as estado_solicitud

                  FROM hc_protocolo_formulacion_quimioterapia pfq
                  INNER JOIN fase_riesgo_ciclo_quimioterapia frcq ON (frcq.fase_riesgo_ciclo_id = pfq.fase_riesgo_ciclo_id)
                  INNER JOIN hc_formulacion_quimioterapia hfq ON (hfq.fase_riesgo_ciclo_id = frcq.fase_riesgo_ciclo_id AND hfq.fase_riesgo_ciclo_id = pfq.fase_riesgo_ciclo_id)
                  LEFT JOIN medicamentos m ON (m.codigo_medicamento = hfq.codigo_producto)
                  INNER JOIN ingresos i ON (i.ingreso = pfq.ingreso AND i.ingreso = hfq.ingreso)
                  INNER JOIN pacientes p ON (p.tipo_id_paciente = i.tipo_id_paciente AND p.paciente_id = i.paciente_id)
                  LEFT JOIN hc_solicitudes_medicamentos hsm ON (hsm.ingreso = hfq.ingreso)
                  INNER JOIN hc_solicitudes_medicamentos_d hsmd ON (hsmd.ingreso = hsm.ingreso AND hsmd.ingreso = hfq.ingreso AND hsmd.solicitud_id = hsm.solicitud_id AND hsmd.medicamento_id = hfq.codigo_producto AND hsmd.num_reg = hfq.num_reg_formulacion)
                  INNER JOIN hc_formulacion_medicamentos_eventos hfme ON (hfme.num_reg = hfq.num_reg_formulacion AND hfme.codigo_producto = hfq.codigo_producto AND hfme.ingreso = hfq.ingreso AND hfme.ingreso = pfq.ingreso)
                  LEFT JOIN encabezado_encuesta_pacientes_quimioterapia epq ON (epq.ingreso = hfme.ingreso AND epq.ingreso = i.ingreso AND epq.fecha_aplicacion = hfq.fecha_aplicacion)
                  INNER JOIN inventarios_productos ip ON (ip.codigo_producto = hfme.codigo_producto AND ip.codigo_producto = hfq.codigo_producto)
                  INNER JOIN fase_quimioterapia fq ON (fq.fase_id = frcq.fase_id)
                  LEFT JOIN protocolo_quimioterapia pq ON (pq.protocolo_id = fq.protocolo_id)
                  LEFT JOIN protocolo_quimioterapia_diagnostico pqd ON (pqd.protocolo_id = fq.protocolo_id AND pqd.protocolo_id = pq.protocolo_id)
                  LEFT JOIN diagnosticos d ON (d.diagnostico_id = pqd.diagnostico_id)
                  WHERE hfq.fecha_aplicacion::date BETWEEN '2023-01-20' AND '2023-02-28'     
                  AND hsm.tipo_solicitud = 'M' and
                  ORDER BY hfq.fecha_aplicacion, hsmd.solicitud_id
                  limit 20;

PARAMETROS:
NULL
----------------------------------------FIN FECHA: 02-02-2023 08:54:47----------------------------------------

----------------------------------------INICIO FECHA: 02-02-2023 10:15:23----------------------------------------
ARCHIVO: E:\Archivos de programa\xampp\htdocs\DEV\biblioteca\biblioteca\dataBase\index.php
LINEA: 104
FUNCION CLASE PDO: selectPointer
FUNCION CLASE: 
MENSAJE:
SQLSTATE[42601]: Syntax error: 7 ERROR:  error de sintaxis en o cerca de Â«ANDÂ»
LINE 90:   AND hsm.tipo_solicitud = 'M'
           ^
CONSULTA:

SELECT hfq.ingreso
  ,i.tipo_id_paciente
  ,i.paciente_id
  ,p.primer_nombre || ' ' || p.segundo_nombre || ' ' || p.primer_apellido || ' ' || p.segundo_apellido AS nombre_paciente
  ,pqd.diagnostico_id AS cod_diagnostico
  ,d.diagnostico_nombre AS descrpcion_diagnostico
  ,pq.descripcion AS descripcion_protocolo
  ,hfq.codigo_producto AS cod_producto
  ,ip.descripcion AS descripcion_producto
  ,hfme.dosis || ' ' || hfme.unidad_dosificacion AS dosis_unidadDosificacion
  ,hfme.frecuencia
  ,hfq.fecha_aplicacion
  ,CASE 
    WHEN epq.apto_aplicacion1 = '1'
      THEN 'SI'
    WHEN epq.apto_aplicacion1 = '2'
      THEN 'NO'
    END AS apto_aplicacion1
  ,CASE 
    WHEN epq.apto_aplicacion2 = '1'
      THEN 'SI'
    WHEN epq.apto_aplicacion2 = '2'
      THEN 'NO'
    END AS apto_aplicacion2
  ,hsmd.solicitud_id
  ,CASE 
    WHEN hsm.sw_estado = '0'
      THEN 'SIN DESPACHO'
    WHEN hsm.sw_estado = '1'
      THEN 'DESPACHADO DESDE FARMACIA'
    WHEN hsm.sw_estado = '2'
      THEN 'DESPACHO CONFIRMADO'
    WHEN hsm.sw_estado = '3'
      THEN 'CANCELADO'
    WHEN hsm.sw_estado = '4'
      THEN 'CONSUMO DIRECTO'
    WHEN hsm.sw_estado = '5'
      THEN 'RECIBIDO PARCIALMENTE'
    WHEN hsm.sw_estado = '6'
      THEN 'DESPACHO DESDE BODEGA Y CANCELADO EN LA ESTACION'
    END AS estado_solicitud
  FROM hc_protocolo_formulacion_quimioterapia pfq
  INNER JOIN fase_riesgo_ciclo_quimioterapia frcq ON (frcq.fase_riesgo_ciclo_id = pfq.fase_riesgo_ciclo_id)
  INNER JOIN hc_formulacion_quimioterapia hfq ON (
    hfq.fase_riesgo_ciclo_id = frcq.fase_riesgo_ciclo_id
    AND hfq.fase_riesgo_ciclo_id = pfq.fase_riesgo_ciclo_id
    )
  LEFT JOIN medicamentos m ON (m.codigo_medicamento = hfq.codigo_producto)
  INNER JOIN ingresos i ON (
    i.ingreso = pfq.ingreso
    AND i.ingreso = hfq.ingreso
    )
  INNER JOIN pacientes p ON (
    p.tipo_id_paciente = i.tipo_id_paciente
    AND p.paciente_id = i.paciente_id
    )
  LEFT JOIN hc_solicitudes_medicamentos hsm ON (hsm.ingreso = hfq.ingreso)
  INNER JOIN hc_solicitudes_medicamentos_d hsmd ON (
    hsmd.ingreso = hsm.ingreso
    AND hsmd.ingreso = hfq.ingreso
    AND hsmd.solicitud_id = hsm.solicitud_id
    AND hsmd.medicamento_id = hfq.codigo_producto
    AND hsmd.num_reg = hfq.num_reg_formulacion
    )
  INNER JOIN hc_formulacion_medicamentos_eventos hfme ON (
    hfme.num_reg = hfq.num_reg_formulacion
    AND hfme.codigo_producto = hfq.codigo_producto
    AND hfme.ingreso = hfq.ingreso
    AND hfme.ingreso = pfq.ingreso
    )
  LEFT JOIN encabezado_encuesta_pacientes_quimioterapia epq ON (
    epq.ingreso = hfme.ingreso
    AND epq.ingreso = i.ingreso
    AND epq.fecha_aplicacion = hfq.fecha_aplicacion
    )
  INNER JOIN inventarios_productos ip ON (
    ip.codigo_producto = hfme.codigo_producto
    AND ip.codigo_producto = hfq.codigo_producto
    )
  INNER JOIN fase_quimioterapia fq ON (fq.fase_id = frcq.fase_id)
  LEFT JOIN protocolo_quimioterapia pq ON (pq.protocolo_id = fq.protocolo_id)
  LEFT JOIN protocolo_quimioterapia_diagnostico pqd ON (
    pqd.protocolo_id = fq.protocolo_id
    AND pqd.protocolo_id = pq.protocolo_id
    )
  LEFT JOIN diagnosticos d ON (d.diagnostico_id = pqd.diagnostico_id)
  WHERE hfq.fecha_aplicacion::DATE BETWEEN '2023-01-01'
    AND '2023-02-02' and
  AND hsm.tipo_solicitud = 'M'
  ORDER BY hfq.fecha_aplicacion
  ,hsmd.solicitud_id

PARAMETROS:
NULL
----------------------------------------FIN FECHA: 02-02-2023 10:15:23----------------------------------------

