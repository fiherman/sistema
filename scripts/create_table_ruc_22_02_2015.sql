CREATE TABLE ruc
(
  id serial NOT NULL,
  pac_id integer NOT NULL,
  ruc_raz_soc character(150),
  ruc_num integer,
  ruc_dir character(200),
  ruc_est character(1),
  CONSTRAINT pk_id_pac_ruc PRIMARY KEY (pac_id)
)
WITH (
  OIDS=FALSE
);