update especialidad set esp_cos_dol=0.00

update especialidad set esp_cos_dol=800.00 where esp_id=71 and seg_id=1 and esp_cod=1 and esp_tip=9
update especialidad set esp_cos_dol=1000.00 where esp_id=72 and seg_id=1 and esp_cod=2 and esp_tip=9
update especialidad set esp_cos_dol=900.00 where esp_id=73 and seg_id=1 and esp_cod=3 and esp_tip=9

CREATE OR REPLACE VIEW vw_ver_trat_pac AS 
 SELECT a.trat_id,
    a.trat_num,
    a.trat_pac_id,
    a.trat_esp_tip,
    a.trat_esp_cod,
    a.trat_esp_des,
    a.trat_cant,
    a.trat_esp_cos_sol,
    a.trat_esp_cos_dol,
    a.trat_doc_id,
    a.trat_seg_id,
        CASE
            WHEN a.trat_seg_id = 1::numeric THEN 'SIN SEGURO'::text
            WHEN a.trat_seg_id = 2::numeric THEN 'LA POSITIVA'::text
            WHEN a.trat_seg_id = 3::numeric THEN 'CERRO VERDE'::text
            ELSE NULL::text
        END AS seguro,
    a.trat_fch,
    (b.doc_nom::text || ' '::text) || b.doc_ape::text AS doctor
   FROM tratamiento a
     LEFT JOIN doctores b ON a.trat_doc_id = b.doc_id::numeric
  WHERE a.trat_est = '1'::bpchar;

