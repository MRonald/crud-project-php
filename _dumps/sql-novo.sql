drop database if exists projeto_php_estruturado;

create database if not exists projeto_php_estruturado;

use projeto_php_estruturado;

drop table if exists cliente;

create table if not exists cliente(
	id int not null auto_increment primary key,
    nome_cliente varchar(100) not null,
    cpf char(11) not null,
    email nchar(10)
);

drop table if exists produto;

create table if not exists produto(
	id int not null auto_increment primary key,
    cod_barras varchar(20) not null,
    nome_produto varchar(100),
    valor_unitario decimal(8,2),
    quantidade int not null
);

drop table if exists pedido;

create table if not exists pedido(
	id int not null auto_increment primary key,
    numero_pedido int not null,
    dt_pedido datetime not null,
    id_cliente int not null,
    id_produtos int not null,
    foreign key (id_cliente) references cliente (id),
    foreign key (produto) references produto (id)
);

