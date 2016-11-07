create sequence sq_id_t001 increment 1 minvalue 0 maxvalue 99999;

create table t001(

	cd_seg int default nextval('sq_id_t001') not null unique,
    nm_seg varchar(150),
	md_face text,
	md_twitter text,
    md_instag text,
    md_pinter text,
    md_ytube text,
    md_google text,
    tel_whpp varchar(12),
    tel_tim varchar(12),
    tel_vivo varchar(12),
    tel_oi varchar(12),
    tel_claro varchar(12),
    primary key (cd_seg)

);


create sequence sq_id_t002 increment 1 minvalue 0 maxvalue 99999;

create table t002(

	cd_classe int default nextval('sq_id_t002') not null unique,
    cd_seg int not null,
    nm_classe varchar(150) not null,
    seg_prinp boolean not null,
    url_classe text not null,
    tp_prod varchar(100) not null,
    classe_logo text not null,
    ordem_classe int not null,
    primary key (cd_classe, cd_seg),
    foreign key (cd_seg) references t001(cd_seg)

);



create sequence sq_id_t003 increment 1 minvalue 0 maxvalue 99999;

create table t003(

	cd_pag int default nextval('sq_id_t003') not null unique,
    cd_classe int not null,
    nm_pag varchar(100) not null,
    primary key(cd_pag, cd_classe),
    foreign key(cd_classe) references t002(cd_classe)

);



create sequence sq_id_t004 increment 1 minvalue 0 maxvalue 99999;

create table t004(

	cd_tp_contd int default nextval('sq_id_t004') not null unique,
    cd_pag int not null,
    nm_tp_contd varchar(100) not null,
    primary key(cd_tp_contd, cd_pag),
    foreign key(cd_pag) references t003(cd_pag)

);

create sequence sq_id_t005 increment 1 minvalue 0 maxvalue 99999;

create table t005(

	cd_contd int default nextval('sq_id_t005') not null unique,
    tl_contd varchar(150) not null,
    ds_contd text not null,
    img_contd text not null,
    primary key(cd_contd)

);



create table t006(

	cd_tp_contd int not null,
    cd_contd int not null,
    primary key(cd_tp_contd, cd_contd),
    foreign key(cd_contd) references t005(cd_contd),
	foreign key (cd_tp_contd) references t004(cd_tp_contd)

);




create sequence sq_id_t007 increment 1 minvalue 0 maxvalue 99999;

create table t007(

	cd_prod int default nextval('sq_id_t007') not null unique,
    cd_classe int not null,
    tl_prod varchar(150) not null,
    ds_prod text not null,
	local_prod text not null,
	vl_prod text not null,
	pl_ch_prod text not null,
    prod_dest boolean not null,
    tl_prod_comp text not null,
    ds_prod_comp text not null,
    dt_cad_prod varchar(8) not null,
    primary key(cd_prod, cd_classe),
    foreign key(cd_classe) references t002(cd_classe)

);



create sequence sq_id_t008 increment 1 minvalue 0 maxvalue 99999;

create table t008(

	cd_img int default nextval('sq_id_t008') not null,
    cd_prod int not null,
    prod_img text not null,
    img_prinp int not null, /*0 - img principal, 1 - banner, 2 - commum*/
    dt_cad_img varchar(8) not null,
    primary key(cd_img, cd_prod),
    foreign key(cd_prod) references t007(cd_prod)

);




CREATE SEQUENCE sq_id_t010 INCREMENT 1 MINVALUE 0 MAXVALUE 99999;

create table t010(
 
	id int DEFAULT nextval('sq_id_t010') primary key not null UNIQUE,
	oauth_provider varchar(255) not null,
	oauth_uid varchar(255) not null,
	fname varchar(255) NOT NULL,
	lname varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	gender varchar(10) NOT NULL,
	locale varchar(10) NOT NULL,
	gpluslink varchar(255) NOT NULL,
	picture varchar(255) NOT NULL,
	created Timestamp NOT NULL,
	modified Timestamp NOT NULL
 
);

COMMENT ON TABLE t010 is 'Tabela usuario google plus';






















































































