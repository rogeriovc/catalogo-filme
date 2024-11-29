create database filmesdb
use filmesdb


create table filme(
	id int auto_increment primary key not null,
    nome varchar(45) not null,
     ano int not null,
    descricao varchar (100) not null
);