-- Inserindo Clientes Teste --
 
 -- Cliente 1
INSERT INTO Clientes (id_cliente, nome, cpf, rua, numero, bairro, cidade, cep, data_nascimento)
VALUES (1, 'Enrico Ricardo Bento da Conceição', '44733799225', 'Estrada Transamazônica, s/n', 214, 'Sucunduri', 'Apuí', '69275970', '2001-07-17');

-- Cliente 2
INSERT INTO Clientes (id_cliente, nome, cpf, rua, numero, bairro, cidade, cep, data_nascimento)
VALUES (2, 'Lorenzo Mário Novaes', '63330296291', 'Estrada Transamazônica, s/n', 829, 'Sucunduri', 'Apuí', '69275970', '2001-09-10');

-- Cliente 3
INSERT INTO Clientes (id_cliente, nome, cpf, rua, numero, bairro, cidade, cep, data_nascimento)
VALUES (3, 'Julio Cláudio Oliver Souza', '21587939290', 'Avenida 13 de Novembro 850', 872, 'Centro', 'Apuí', '69265970', '2001-01-13');

-- Cliente 4
INSERT INTO Clientes (id_cliente, nome, cpf, rua, numero, bairro, cidade, cep, data_nascimento)
VALUES (4, 'Lorenzo Sérgio da Luz', '09927098227', 'Estrada Transamazônica, s/n', 853, 'Sucunduri', 'Apuí', '69275970', '2001-03-10');

-- Cliente 5
INSERT INTO Clientes (id_cliente, nome, cpf, rua, numero, bairro, cidade, cep, data_nascimento)
VALUES (5, 'Francisco Diego Enzo Baptista', '70623119285', 'Estrada Transamazônica, s/n', 985, 'Sucunduri', 'Apuí', '69275970', '2001-08-25');

-- Cliente 6
INSERT INTO Clientes (id_cliente, nome, cpf, rua, numero, bairro, cidade, cep, data_nascimento)
VALUES (6, 'Erick Fernando Pinto', '09057788209', 'Estrada Transamazônica, s/n', 668, 'Sucunduri', 'Apuí', '69275970', '2001-01-14');

-- Cliente 7
INSERT INTO Clientes (id_cliente, nome, cpf, rua, numero, bairro, cidade, cep, data_nascimento)
VALUES (7, 'Thales Márcio Murilo Araújo', '90897248260', 'Avenida 13 de Novembro 850', 563, 'Centro', 'Apuí', '69265970', '2001-05-07');

-- Cliente 8
INSERT INTO Clientes (id_cliente, nome, cpf, rua, numero, bairro, cidade, cep, data_nascimento)
VALUES (8, 'Matheus Augusto Porto', '07081493246', 'Estrada Transamazônica, s/n', 475, 'Sucunduri', 'Apuí', '69275970', '2001-01-04');

-- Cliente 9
INSERT INTO Clientes (id_cliente, nome, cpf, rua, numero, bairro, cidade, cep, data_nascimento)
VALUES (9, 'Geraldo Francisco Luís Nogueira', '08570690207', 'Estrada Transamazônica, s/n', 419, 'Sucunduri', 'Apuí', '69275970', '2001-04-14');

-- Cliente 10
INSERT INTO Clientes (id_cliente, nome, cpf, rua, numero, bairro, cidade, cep, data_nascimento)
VALUES (10, 'Marcelo Alexandre Márcio Martins', '71001629205', 'Estrada Transamazônica, s/n', 722, 'Sucunduri', 'Apuí', '69275970', '2001-02-03');

-- Inserindo Funcionários --

-- Funcionário 1
INSERT INTO Funcionarios (id_funcionario, nome, data_nascimento, data_admissao, salario)
VALUES (1, 'Tomás Lorenzo Lopes', '2000-01-16', '2023-09-24', 3500.00);

-- Funcionário 2
INSERT INTO Funcionarios (id_funcionario, nome, data_nascimento, data_admissao, salario)
VALUES (2, 'Sebastião Thales Assunção', '2000-04-05', '2023-09-24', 3200.00);

-- Funcionário 3
INSERT INTO Funcionarios (id_funcionario, nome, data_nascimento, data_admissao, salario)
VALUES (3, 'Julio Rafael Martin Rodrigues', '2000-04-12', '2023-09-24', 3400.00);

-- Funcionário 4
INSERT INTO Funcionarios (id_funcionario, nome, data_nascimento, data_admissao, salario)
VALUES (4, 'Filipe Márcio Davi Nogueira', '2000-04-26', '2023-09-24', 3600.00);

-- Funcionário 5
INSERT INTO Funcionarios (id_funcionario, nome, data_nascimento, data_admissao, salario)
VALUES (5, 'Matheus Isaac Daniel Oliveira', '2000-04-11', '2023-09-24', 3300.00);

-- Funcionário 6
INSERT INTO Funcionarios (id_funcionario, nome, data_nascimento, data_admissao, salario)
VALUES (6, 'Pedro Henrique Juan Castro', '2000-02-19', '2023-09-24', 3700.00);

-- Funcionário 7
INSERT INTO Funcionarios (id_funcionario, nome, data_nascimento, data_admissao, salario)
VALUES (7, 'Bryan Diogo Araújo', '2000-02-08', '2023-09-24', 3100.00);

-- Funcionário 8
INSERT INTO Funcionarios (id_funcionario, nome, data_nascimento, data_admissao, salario)
VALUES (8, 'Mateus Sebastião Theo Sales', '2000-06-13', '2023-09-24', 3800.00);

-- Funcionário 9
INSERT INTO Funcionarios (id_funcionario, nome, data_nascimento, data_admissao, salario)
VALUES (9, 'Lucas Osvaldo Osvaldo Silveira', '2000-08-27', '2023-09-24', 4000.00);

-- Funcionário 10
INSERT INTO Funcionarios (id_funcionario, nome, data_nascimento, data_admissao, salario)
VALUES (10, 'Davi Henry Kevin da Paz', '2000-01-09', '2023-09-24', 3900.00);

-- Inserindo Categorias --

-- Categoria 1: Pães
INSERT INTO Categoria (id_categoria, nome)
VALUES (1, 'Pães');

-- Categoria 2: Bolos
INSERT INTO Categoria (id_categoria, nome)
VALUES (2, 'Bolos');

-- Categoria 3: Bolachas
INSERT INTO Categoria (id_categoria, nome)
VALUES (3, 'Bolachas');

-- Categoria 4: Doces
INSERT INTO Categoria (id_categoria, nome)
VALUES (4, 'Doces');

-- Categoria 5: Salgados
INSERT INTO Categoria (id_categoria, nome)
VALUES (5, 'Salgados');

-- Inserindo Produtos --

-- Produto 1
INSERT INTO Produtos (id_produto, nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria)
VALUES (1, 'Pão Francês', 1.50, 100, 1, 1);

-- Produto 2
INSERT INTO Produtos (id_produto, nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria)
VALUES (2, 'Pão de Forma Integral', 2.00, 80, 1, 1);

-- Produto 3
INSERT INTO Produtos (id_produto, nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria)
VALUES (3, 'Bolo de Cenoura', 8.00, 20, 1, 2);

-- Produto 4
INSERT INTO Produtos (id_produto, nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria)
VALUES (4, 'Bolo de Chocolate', 8.00, 15, 1, 2);

-- Produto 5
INSERT INTO Produtos (id_produto, nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria)
VALUES (5, 'Biscoito de Chocolate', 3.50, 50, 1, 3);

-- Produto 6
INSERT INTO Produtos (id_produto, nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria)
VALUES (6, 'Biscoito de Coco', 3.50, 60, 1, 3);

-- Produto 7
INSERT INTO Produtos (id_produto, nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria)
VALUES (7, 'Doce de Leite', 5.00, 30, 1, 4);

-- Produto 8
INSERT INTO Produtos (id_produto, nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria)
VALUES (8, 'Brigadeiro', 2.50, 40, 1, 4);

-- Produto 9
INSERT INTO Produtos (id_produto, nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria)
VALUES (9, 'Salgado de Queijo', 3.00, 25, 1, 5);

-- Produto 10
INSERT INTO Produtos (id_produto, nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria)
VALUES (10, 'Salgado de Presunto', 3.00, 30, 1, 5);

-- Produto 11
INSERT INTO Produtos (id_produto, nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria)
VALUES (11, 'Croissant', 2.00, 20, 1, 1);

-- Produto 12
INSERT INTO Produtos (id_produto, nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria)
VALUES (12, 'Rosquinha', 1.50, 40, 1, 3);

-- Produto 13
INSERT INTO Produtos (id_produto, nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria)
VALUES (13, 'Pão de Queijo', 2.50, 30, 1, 5);

-- Produto 14
INSERT INTO Produtos (id_produto, nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria)
VALUES (14, 'Torta de Limão', 10.00, 10, 1, 2);

-- Produto 15
INSERT INTO Produtos (id_produto, nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria)
VALUES (15, 'Torta de Morango', 10.00, 12, 1, 2);

-- Inserindo Pedidos Testes --
-- Pedido 1
INSERT INTO Pedidos (id_pedido, data_realizacao, observacao, fk_Clientes_id_cliente, fk_Funcionarios_id_funcionario)
VALUES (1, '2023-09-24', 'Entregar na Rua A', 1, 1);

-- Itens do Pedido 1
INSERT INTO ItensPedido (Id_itensPedido, fk_Produtos_id_produto, fk_Pedidos_id_pedido, quantidade)
VALUES (1, 1, 1, 2), (2, 5, 1, 3);

-- Pedido 2
INSERT INTO Pedidos (id_pedido, data_realizacao, observacao, fk_Clientes_id_cliente, fk_Funcionarios_id_funcionario)
VALUES (2, '2023-09-25', 'Entregar na Rua B', 2, 2);

-- Itens do Pedido 2
INSERT INTO ItensPedido (Id_itensPedido, fk_Produtos_id_produto, fk_Pedidos_id_pedido, quantidade)
VALUES (3, 2, 2, 1), (4, 4, 2, 4);

-- Pedido 3
INSERT INTO Pedidos (id_pedido, data_realizacao, observacao, fk_Clientes_id_cliente, fk_Funcionarios_id_funcionario)
VALUES (3, '2023-09-26', 'Entregar na Rua C', 3, 3);

-- Itens do Pedido 3
INSERT INTO ItensPedido (Id_itensPedido, fk_Produtos_id_produto, fk_Pedidos_id_pedido, quantidade)
VALUES (5, 3, 3, 2), (6, 7, 3, 2);

-- Pedido 4
INSERT INTO Pedidos (id_pedido, data_realizacao, observacao, fk_Clientes_id_cliente, fk_Funcionarios_id_funcionario)
VALUES (4, '2023-09-27', 'Entregar na Rua D', 4, 4);

-- Itens do Pedido 4
INSERT INTO ItensPedido (Id_itensPedido, fk_Produtos_id_produto, fk_Pedidos_id_pedido, quantidade)
VALUES (7, 1, 4, 2), (8, 6, 4, 1);

-- Pedido 5
INSERT INTO Pedidos (id_pedido, data_realizacao, observacao, fk_Clientes_id_cliente, fk_Funcionarios_id_funcionario)
VALUES (5, '2023-09-28', 'Entregar na Rua E', 5, 5);

-- Itens do Pedido 5
INSERT INTO ItensPedido (Id_itensPedido, fk_Produtos_id_produto, fk_Pedidos_id_pedido, quantidade)
VALUES (9, 2, 5, 3), (10, 8, 5, 2);

-- Pedido 6
INSERT INTO Pedidos (id_pedido, data_realizacao, observacao, fk_Clientes_id_cliente, fk_Funcionarios_id_funcionario)
VALUES (6, '2023-09-29', 'Entregar na Rua F', 6, 6);

-- Itens do Pedido 6
INSERT INTO ItensPedido (Id_itensPedido, fk_Produtos_id_produto, fk_Pedidos_id_pedido, quantidade)
VALUES (11, 3, 6, 1), (12, 5, 6, 4);

-- Pedido 7
INSERT INTO Pedidos (id_pedido, data_realizacao, observacao, fk_Clientes_id_cliente, fk_Funcionarios_id_funcionario)
VALUES (7, '2023-09-30', 'Entregar na Rua G', 7, 7);

-- Itens do Pedido 7
INSERT INTO ItensPedido (Id_itensPedido, fk_Produtos_id_produto, fk_Pedidos_id_pedido, quantidade)
VALUES (13, 4, 7, 2), (14, 6, 7, 3);

-- Pedido 8
INSERT INTO Pedidos (id_pedido, data_realizacao, observacao, fk_Clientes_id_cliente, fk_Funcionarios_id_funcionario)
VALUES (8, '2023-10-01', 'Entregar na Rua H', 8, 8);

-- Itens do Pedido 8
INSERT INTO ItensPedido (Id_itensPedido, fk_Produtos_id_produto, fk_Pedidos_id_pedido, quantidade)
VALUES (15, 1, 8, 2), (16, 7, 8, 1);

-- Pedido 9
INSERT INTO Pedidos (id_pedido, data_realizacao, observacao, fk_Clientes_id_cliente, fk_Funcionarios_id_funcionario)
VALUES (9, '2023-10-02', 'Entregar na Rua I', 9, 9);

-- Itens do Pedido 9
INSERT INTO ItensPedido (Id_itensPedido, fk_Produtos_id_produto, fk_Pedidos_id_pedido, quantidade)
VALUES (17, 2, 9, 3), (18, 8, 9, 2);

-- Pedido 10
INSERT INTO Pedidos (id_pedido, data_realizacao, observacao, fk_Clientes_id_cliente, fk_Funcionarios_id_funcionario)
VALUES (10, '2023-10-03', 'Entregar na Rua J', 10, 10);

-- Itens do Pedido 10
INSERT INTO ItensPedido (Id_itensPedido, fk_Produtos_id_produto, fk_Pedidos_id_pedido, quantidade)
VALUES (19, 3, 10, 1), (20, 5, 10, 4);

-- Pedido 11
INSERT INTO Pedidos (id_pedido, data_realizacao, observacao, fk_Clientes_id_cliente, fk_Funcionarios_id_funcionario)
VALUES (11, '2023-10-08', 'Irei Buscar', 10, 10);

-- Pedido 12
INSERT INTO Pedidos (id_pedido, data_realizacao, observacao, fk_Clientes_id_cliente, fk_Funcionarios_id_funcionario)
VALUES (12, '2023-04-01', 'Vou pegar', 10, 10);

-- Pedido 13
INSERT INTO Pedidos (id_pedido, data_realizacao, observacao, fk_Clientes_id_cliente, fk_Funcionarios_id_funcionario)
VALUES (13, '2023-12-22', 'Entregar na Rua J', 1, 8);

-- Inserindo Lotes --
-- Lote 1 for Produto 1
INSERT INTO Lotes (numero_de_serie, data_lote, data_validade, fk_Produto_id_produto)
VALUES ('LOTE2023001', '2023-01-15', '2023-10-10', 1);

-- Lote 2 for Produto 2
INSERT INTO Lotes (numero_de_serie, data_lote, data_validade, fk_Produto_id_produto)
VALUES ('LOTE2023002', '2023-02-20', '2023-10-12', 2);

-- Lote 3 for Produto 3
INSERT INTO Lotes (numero_de_serie, data_lote, data_validade, fk_Produto_id_produto)
VALUES ('LOTE2023003', '2023-03-10', '2023-10-15', 3);

-- Lote 4 for Produto 4
INSERT INTO Lotes (numero_de_serie, data_lote, data_validade, fk_Produto_id_produto)
VALUES ('LOTE2023004', '2023-04-05', '2023-10-15', 4);

-- Lote 5 for Produto 5
INSERT INTO Lotes (numero_de_serie, data_lote, data_validade, fk_Produto_id_produto)
VALUES ('LOTE2023005', '2023-05-12', '2023-11-01', 5);

-- Lote 6 for Produto 6
INSERT INTO Lotes (numero_de_serie, data_lote, data_validade, fk_Produto_id_produto)
VALUES ('LOTE2023006', '2022-05-12', '2023-11-01', 6);

-- Lote 7 for Produto 7
INSERT INTO Lotes (numero_de_serie, data_lote, data_validade, fk_Produto_id_produto)
VALUES ('LOTE2023007', '2023-02-15', '2023-11-01', 7);

-- Lote 8 for Produto 8
INSERT INTO Lotes (numero_de_serie, data_lote, data_validade, fk_Produto_id_produto)
VALUES ('LOTE2023008', '2023-01-19', '2023-11-01', 8);

-- Lote 9 for Produto 9
INSERT INTO Lotes (numero_de_serie, data_lote, data_validade, fk_Produto_id_produto)
VALUES ('LOTE2023009', '2023-07-20', '2023-11-01', 9);

-- Lote 10 for Produto 10
INSERT INTO Lotes (numero_de_serie, data_lote, data_validade, fk_Produto_id_produto)
VALUES ('LOTE2023010', '2023-08-28', '2023-11-01', 10);

-- Lote 11 for Produto 11
INSERT INTO Lotes (numero_de_serie, data_lote, data_validade, fk_Produto_id_produto)
VALUES ('LOTE2023011', '2023-11-30', '2023-11-01', 11);

-- Lote 12 for Produto 12
INSERT INTO Lotes (numero_de_serie, data_lote, data_validade, fk_Produto_id_produto)
VALUES ('LOTE2023012', '2023-12-23', '2023-11-01', 12);

-- Lote 13 for Produto 13
INSERT INTO Lotes (numero_de_serie, data_lote, data_validade, fk_Produto_id_produto)
VALUES ('LOTE2023013', '2023-04-09', '2023-11-01', 13);

-- Lote 14 for Produto 14
INSERT INTO Lotes (numero_de_serie, data_lote, data_validade, fk_Produto_id_produto)
VALUES ('LOTE2023014', '2023-12-12', '2023-11-01', 14);

-- Lote 15 for Produto 15
INSERT INTO Lotes (numero_de_serie, data_lote, data_validade, fk_Produto_id_produto)
VALUES ('LOTE2023015', '2023-05-12', '2023-11-01', 15);