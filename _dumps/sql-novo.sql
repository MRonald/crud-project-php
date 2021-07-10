drop database if exists php_crud_structured;

create database if not exists php_crud_structured;

use php_crud_structured;

drop table if exists cliente;

# Tabela CLIENTE
# Apenas o email é opcional
/*
 * Não coloquei a coluna cpf como chave primária pois
 * posso precisar inserir uma compra de algum cliente que não tenha cpf
 * ou que não queira informar.
 *
 * Pessoas estrangeiras não tem esse documento.
 *
 * O governo pode mudar a regra desse documento e o DU (documento único)
 * pode o substituir, isso causaria a necessidade de reestruturar o banco.
 */
create table if not exists cliente(
	id int not null auto_increment primary key,
    nome_cliente varchar(255) not null,
    cpf char(11) not null unique key,
    email varchar(100)
);

drop table if exists produto;

# Tabela PRODUTO
/*
 * Não coloquei a coluna cod_barras como chave primária pois
 * se o software for usado para controle interno, pode haver dois produtos
 * iguais com códigos diferentes.
 *
 * Além disso, não é bom tornar chave da tabela um dado público.
 *
 * A busca por uma chave do tipo string tbm é menos performática
 * do que com uma chave do tipo int
 */
create table if not exists produto(
	id int not null auto_increment primary key,
    cod_barras varchar(40) not null unique key,
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

