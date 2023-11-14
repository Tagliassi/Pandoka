-- Consultas --

-- Consulta 01 --
SELECT
    c.nome AS nome_cliente,
    c.cpf,
    p.id_pedido,
    ip.quantidade AS quantidade_produto,
    pr.nome AS nome_produto,
    CONCAT('R$ ', FORMAT(pr.valor, 2)) AS valor_unitario
FROM
    Clientes c
JOIN
    Pedidos p ON c.id_cliente = p.fk_Clientes_id_cliente
JOIN
    ItensPedido ip ON p.id_pedido = ip.fk_Pedidos_id_pedido
JOIN
    Produtos pr ON ip.fk_Produtos_id_produto = pr.id_produto;

-- Consulta 02 --
DELIMITER //

CREATE PROCEDURE ObterDetalhesPedido (IN pedido_id INT)
BEGIN
    -- Declaração de variáveis
    DECLARE total_pedido DECIMAL(10, 2);
    
    -- Tabela temporária para armazenar detalhes do pedido
    CREATE TEMPORARY TABLE TempDetalhesPedido (
        nome_cliente VARCHAR(100),
        cpf_cliente VARCHAR(11),
        id_pedido INT,
        nome_produto VARCHAR(100),
        quantidade INT,
        valor_unitario DECIMAL(10, 2),
        subtotal DECIMAL(10, 2)
    );

    -- Popula a tabela temporária com os detalhes do pedido
    INSERT INTO TempDetalhesPedido
    SELECT
        c.nome AS nome_cliente,
        c.cpf AS cpf_cliente,
        p.id_pedido,
        pr.nome AS nome_produto,
        ip.quantidade,
        pr.valor AS valor_unitario,
        ip.quantidade * pr.valor AS subtotal
    FROM
        Clientes c
    JOIN
        Pedidos p ON c.id_cliente = p.fk_Clientes_id_cliente
    JOIN
        ItensPedido ip ON p.id_pedido = ip.fk_Pedidos_id_pedido
    JOIN
        Produtos pr ON ip.fk_Produtos_id_produto = pr.id_produto
    WHERE
        p.id_pedido = pedido_id;

    -- Calcula o total do pedido
    SELECT SUM(subtotal) INTO total_pedido FROM TempDetalhesPedido;

    -- Seleciona todos os detalhes do pedido
    SELECT * FROM TempDetalhesPedido;

    -- Retorna o total do pedido
    SELECT total_pedido AS total_pedido;

    -- Drop da tabela temporária
    DROP TEMPORARY TABLE IF EXISTS TempDetalhesPedido;
END //

DELIMITER ;

SET @pedido_id = 1; -- Use a variable that matches the parameter name
CALL ObterDetalhesPedido(@pedido_id);
SELECT @pedido_id;
