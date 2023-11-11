USE pandoka;

-- Criando Tabelas --
CREATE TABLE Clientes (
    id_cliente int PRIMARY KEY,
    nome varchar(100),
    cpf varchar(11) UNIQUE,
    rua varchar(100),
    numero int,
    bairro varchar(100),
    cidade varchar(100),
    cep varchar(8),
    data_nascimento date
);

CREATE TABLE Pedidos (
    id_pedido int PRIMARY KEY,
    data_realizacao DATE,
    observacao VARCHAR(1000),
    fk_Clientes_id_cliente int,
    fk_Funcionarios_id_funcionario int
);

CREATE TABLE Produtos (
    id_produto int PRIMARY KEY,
    nome varchar(100),
    valor decimal,
    data_validade date,
    quantidade_estoque int,
    disponibilidade bool,
    fk_Categoria_id_categoria int
);

CREATE TABLE Funcionarios (
    id_funcionario int PRIMARY KEY,
    nome varchar(100),
    data_nascimento date,
    data_admissao date,
    salario decimal
);

CREATE TABLE Categoria (
    id_categoria int PRIMARY KEY,
    nome varchar(100) UNIQUE
);

CREATE TABLE ItensPedido (
    fk_Produtos_id_produto int,
    fk_Pedidos_id_pedido int,
    quantidade int,
    Id_itensPedido int PRIMARY KEY,
    UNIQUE (fk_Produtos_id_produto, fk_Pedidos_id_pedido)
);

CREATE TABLE Lotes (
    numero_de_serie varchar(25) PRIMARY KEY,
    data_lote DATE,
    data_validade DATE,
    fk_Produto_id_produto int
);
 
ALTER TABLE Pedidos ADD CONSTRAINT FK_Pedidos_2
    FOREIGN KEY (fk_Clientes_id_cliente)
    REFERENCES Clientes (id_cliente)
    ON DELETE CASCADE;
 
ALTER TABLE Pedidos ADD CONSTRAINT FK_Pedidos_3
    FOREIGN KEY (fk_Funcionarios_id_funcionario)
    REFERENCES Funcionarios (id_funcionario)
    ON DELETE CASCADE;
 
ALTER TABLE Produtos ADD CONSTRAINT FK_Produtos_2
    FOREIGN KEY (fk_Categoria_id_categoria)
    REFERENCES Categoria (id_categoria)
    ON DELETE CASCADE;
 
ALTER TABLE Lotes ADD CONSTRAINT FKs_Lotes_1
    FOREIGN KEY (fk_Produto_id_produto)
    REFERENCES Produtos (id_produto)
    ON DELETE RESTRICT;
    
ALTER TABLE ItensPedido ADD CONSTRAINT FK_ItensPedido_1
    FOREIGN KEY (fk_Produtos_id_produto)
    REFERENCES Produtos (id_produto)
    ON DELETE RESTRICT;
 
ALTER TABLE ItensPedido ADD CONSTRAINT FK_ItensPedido_2
    FOREIGN KEY (fk_Pedidos_id_pedido)
    REFERENCES Pedidos (id_pedido)
    ON DELETE SET NULL;