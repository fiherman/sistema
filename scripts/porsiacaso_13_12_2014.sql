select * from vw_ver_trat_pac where trat_pac_id=4544 and trat_num=1

select * from tratamiento where trat_pac_id=4544

update tratamiento set trat_est='1' where trat_pac_id=4544

select sum(trat_esp_cos_sol) as total from vw_ver_trat_pac where trat_pac_id=4541 and trat_num=1 and trat_est='1'

select * from vw_ver_trat_pac where trat_pac_id=4541 and trat_num=1

UPDATE tratamiento set trat_seg_id=1,trat_esp_tip=4,trat_esp_cod=7,trat_esp_des='ODONTOPEDIATRA(NIÑOS) - RESINA SIMPLE',
trat_esp_cos_sol=70.00,trat_doc_id=15,trat_esp_cos_dol=0,trat_fch='27/11/2014',trat_cant=1,trat_est='1' 
where trat_num=1 and trat_id=143 and trat_pac_id=4541

SELECT esp_tip,(esp_tip_des || ' - ' || esp_des) as esp_des,esp_cod,esp_cos_sol,esp_cos_dol FROM especialidad where seg_id=1

update especialidad set esp_cos_dol=0.00

update especialidad set esp_cos_dol=800.00 where esp_id=71 and seg_id=1 and esp_cod=1 and esp_tip=9

select * from vw_ver_trat_pac where trat_pac_id=4541 and trat_num=1

update tratamiento set trat_est='1' where trat_id=151

select * from tratamiento where trat_est='1'



