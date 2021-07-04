drop database if exists projeto_php_estruturado;

create database if not exists projeto_php_estruturado;

use projeto_php_estruturado;

drop table if exists cliente;

# Tabela CLIENTE
# Apenas o email é opcional
create table if not exists cliente(
	id int not null auto_increment primary key,
    nome_cliente varchar(255) not null,
    cpf char(11) not null,
    email varchar(100)
);

drop table if exists produto;

# Tabela PRODUTO
create table if not exists produto(
	id int not null auto_increment primary key,
    cod_barras varchar(40) not null,
    nome_produto varchar(255) not null,
    valor_unitario decimal(8,2) not null
);

drop table if exists pedido;

# Tabela PEDIDO
# Relação entre as tabelas CLIENTE e PRODUTO
create table if not exists pedido(
    numero_pedido int not null auto_increment primary key,
    data_pedido datetime not null,
    id_cliente int not null,
    id_produto int not null,
    quantidade int not null,
    foreign key (id_cliente) references cliente (id),
    foreign key (id_produto) references produto (id)
);
