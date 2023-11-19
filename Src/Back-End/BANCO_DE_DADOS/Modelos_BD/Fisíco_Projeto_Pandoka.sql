/* Lógico_Projeto_Pandoka: */

CREATE TABLE Clientes (
    id_cliente int PRIMARY KEY,
    nome varchar(100),
    cpf varchar(20),
    rua VARCHAR(100),
    numero VARCHAR(20),
    bairro VARCHAR(100),
    cidade VARCHAR(100),
    cep VARCHAR(20),
    data_nascimento date
);

CREATE TABLE Pedidos (
    id_pedido INT PRIMARY KEY,
    fk_Clientes_id_cliente int,
    fk_Funcionarios_id_funcionario int,
    data_realizacao DATE,
    observacao VARCHAR(100)
);

CREATE TABLE Produtos (
    id_produto int PRIMARY KEY,
    fk_Categoria_id_categoria int,
    nome varchar(100),
    valor decimal,
    quantidade_estoque int,
    disponibilidade bool
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
    nome varchar(100)
);

CREATE TABLE Lotes (
    numero_serie varchar(25) PRIMARY KEY,
    fk_Produtos_id_produto int,
    data_validade date,
    data_lote date
);

CREATE TABLE ItensPedido (
    id_itensPedido int PRIMARY KEY,
    fk_Produtos_id_produto int,
    fk_Pedidos_id_pedido INT,
    quantidade INT
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
 
ALTER TABLE Lotes ADD CONSTRAINT FK_Lotes_2
    FOREIGN KEY (fk_Produtos_id_produto)
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