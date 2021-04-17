create database db_listaContatos;
use db_listaContatos;
create table tb_usuario(
cd_usuario int not null auto_increment,
nm_usuario varchar(30),
pw_usuario varchar(70),
constraint pk_usuario primary key(cd_usuario)
);

create table tb_contato(
cd_contato int not null auto_increment,
nm_contato varchar(30),
nm_email varchar(40),
fk_cd_usuario int,
constraint pk_contato primary key(cd_contato),
constraint fk_contato_usuario foreign key(fk_cd_usuario) references tb_usuario(cd_usuario)
);

create table tb_tel(
cd_tel int not null auto_increment,
nr_tel int(15),
ddd_tel int(3),
tp_tel varchar(15),
fk_cd_contato int,
constraint pk_tel primary key(cd_tel),
constraint fk_tel_contato foreign key(fk_cd_contato) references tb_contato(cd_contato));