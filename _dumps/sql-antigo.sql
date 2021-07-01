drop database if exists projeto_php;

create database if not exists projeto_php;

use projeto_php;

drop table if exists pedido;

create table if not exists pedido(
	id int not null auto_increment primary key,
    numero_pedido int not null,
    nome_cliente varchar(100) not null,
    cpf char(11) not null,
    email nchar(10),
    dt_pedido datetime not null,
    cod_barras varchar(20) not null,
    nome_produto varchar(100),
    valor_unitario decimal(8,2),
    quantidade int not null
);

desc pedido;

alter table pedido modify email nchar(100) not null;

insert pedido values 
(default, 1, "Joao Paulo", "12345676334", "joao@email.com", now(), "1828128838", "produto 1", 10.00, 5);

select * from pedido;