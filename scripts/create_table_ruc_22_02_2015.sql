CREATE TABLE ruc
(
  id serial NOT NULL,  
  ruc_raz_soc character(150),
  ruc_num integer,
  ruc_dir character(200),
  ruc_est character(1)  
)
WITH (
  OIDS=FALSE
);