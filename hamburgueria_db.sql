-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.27-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.5.0.6677
-- --------------------------------------------------------
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET NAMES utf8 */
;

/*!50503 SET NAMES utf8mb4 */
;

/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;

/*!40103 SET TIME_ZONE='+00:00' */
;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;

/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;

-- Copiando estrutura do banco de dados para hamburgueria_db
CREATE DATABASE IF NOT EXISTS `hamburgueria_db`
/*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */
;

USE `hamburgueria_db`;

-- Copiando estrutura para tabela hamburgueria_db.comandas
CREATE TABLE IF NOT EXISTS `comandas` (
	`mesa` int(11) NOT NULL,
	`produtos` varchar(50) DEFAULT NULL,
	`preco` decimal(10, 2) DEFAULT NULL,
	`data` int(11) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Copiando dados para a tabela hamburgueria_db.comandas: ~0 rows (aproximadamente)
-- Copiando estrutura para tabela hamburgueria_db.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
	`id_pedido` int(11) NOT NULL AUTO_INCREMENT,
	`mesa_pedido` int(11) NOT NULL,
	`nome_pedido` varchar(100) NOT NULL,
	`valor_pedido` decimal(10, 2) NOT NULL,
	`quantidade_pedido` varchar(100) NOT NULL,
	`observacao_pedido` varchar(150) NOT NULL,
	`status_pedido` enum('EM ANDAMENTO', 'CONCLUÍDO') NOT NULL,
	`status_comanda` enum('ABERTA', 'FECHADA') NOT NULL,
	`total` decimal(10, 2) NOT NULL DEFAULT 0.00,
	PRIMARY KEY (`id_pedido`)
) ENGINE = InnoDB AUTO_INCREMENT = 199 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Copiando dados para a tabela hamburgueria_db.pedidos: ~3 rows (aproximadamente)
INSERT INTO
	`pedidos` (
		`id_pedido`,
		`mesa_pedido`,
		`nome_pedido`,
		`valor_pedido`,
		`quantidade_pedido`,
		`observacao_pedido`,
		`status_pedido`,
		`status_comanda`,
		`total`
	)
VALUES
	(
		194,
		1,
		'Shazan Burguer',
		28.99,
		'1',
		'0',
		'EM ANDAMENTO',
		'ABERTA',
		53.98
	),
	(
		195,
		1,
		'Cosmico Burguer',
		24.99,
		'1',
		'0',
		'EM ANDAMENTO',
		'ABERTA',
		53.98
	),
	(
		196,
		1,
		'Oliver Burguer',
		50.99,
		'1',
		'0',
		'EM ANDAMENTO',
		'ABERTA',
		50.99
	);

-- Copiando estrutura para tabela hamburgueria_db.produtos_cadastrados
CREATE TABLE IF NOT EXISTS `produtos_cadastrados` (
	`id_produto` int(50) NOT NULL,
	`nome_produto` varchar(50) NOT NULL,
	`descricao_produto` varchar(500) NOT NULL,
	`img_produto` varchar(100) NOT NULL,
	`categoria_produto` enum(
		'Casuais',
		'Gourmet',
		'Veganos',
		'Da Casa',
		'Fritas',
		'Nuggets',
		'Calabresa',
		'Frango',
		'Refrigerantes',
		'Sucos',
		'Drinks'
	) NOT NULL,
	`valor_produto` decimal(10, 2) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Copiando dados para a tabela hamburgueria_db.produtos_cadastrados: ~47 rows (aproximadamente)
INSERT INTO
	`produtos_cadastrados` (
		`id_produto`,
		`nome_produto`,
		`descricao_produto`,
		`img_produto`,
		`categoria_produto`,
		`valor_produto`
	)
VALUES
	(
		1,
		'Neva Burguer',
		'Clássico com um toque especial, o Neva Burguer apresenta carne suculenta, queijo derretido e molho de mostarda e mel, tudo abraçado por pães macios.',
		'../img/Casuais/burguer1.png',
		'Casuais',
		20.99
	),
	(
		2,
		'Cosmico Burguer',
		'Hambúrguer suculento, cebolas caramelizadas, bacon crocante e molho especial de churrasco se unem no Cósmico Burguer, criando uma explosão de sabores inigualável.',
		'../img/Casuais/burguer2.png',
		'Casuais',
		24.99
	),
	(
		3,
		'Shazan Burguer',
		'Uma experiência ousada e clássica, unindo carne grelhada, bacon crocante, cebolas caramelizadas , realçados por molho de churrasco defumado.',
		'../img/Casuais/burguer3.png',
		'Casuais',
		28.99
	),
	(
		4,
		'Summer Burguer',
		'Um hambúrguer casual que combina carne suculenta, queijo derretido, alface crocante e um toque especial de molho de ervas.',
		'../img/Casuais/burguer4.png',
		'Casuais',
		26.99
	),
	(
		5,
		'Rustic Burguer',
		'Este hamburguer combina carne suculenta grelhada, cebolas caramelizadas, bacon crocante e um molho barbecue defumado. Uma experiência rústica e reconfortante que satisfaz os desejos por um sabor inigualável.',
		'../img/Casuais/burguer5.png',
		'Casuais',
		24.99
	),
	(
		6,
		'All Burguer',
		'Uma obra-prima da Gourmet, o All Burguer combina carne suculenta, ingredientes frescos e molho especial para uma experiência luxuosa.',
		'../img/Gourmet/gourmet1.png',
		'Gourmet',
		40.99
	),
	(
		7,
		'Better Burguer',
		'Elevando padrões, o Better Burguer celebra o sabor autêntico com ingredientes selecionados, garantindo qualidade superior.',
		'../img/Gourmet/gourmet3.png',
		'Gourmet',
		45.99
	),
	(
		8,
		'Dark Burguer',
		'Uma tentação de sabor, o Dark Burguer apresenta carne suculenta, queijo defumado e carvão ativado para uma experiência intensa.',
		'../img/Gourmet/gourmet2.png',
		'Gourmet',
		49.99
	),
	(
		9,
		'Truffle Burguer',
		'Uma experiência gourmet excepcional. O hambúrguer une carne premium, queijo derretido, cogumelos trufados e molho de trufas, criando uma harmonia de sabores refinados.',
		'../img/Gourmet/gourmet4.png',
		'Gourmet',
		40.99
	),
	(
		10,
		'Savory Burguer',
		'Uma sinfonia de sabores artesanais. Carne grelhada, caramelo de cebola, bacon crocante e queijo cheddar se unem em uma experiência harmoniosa.',
		'../img/Gourmet/gourmet5.png',
		'Gourmet',
		45.99
	),
	(
		11,
		'Light Burguer',
		'Equilíbrio perfeito entre sabor e saúde na Hamburgueria Gourmet Vegana. O Light Burguer combina ingredientes frescos para uma experiência leve e deliciosa.',
		'../img/Veganos/vegano1.png',
		'Veganos',
		30.99
	),
	(
		12,
		'Dalsa Burguer',
		'Explosão de sabores com lentilhas, espinafre e temperos selecionados. O Dalsa Burguer oferece uma combinação única de texturas e aromas para os amantes da culinária vegana.',
		'../img/Veganos/vegano2.png',
		'Veganos',
		34.99
	),
	(
		13,
		'Souk Burger',
		'Sabor local e sustentável. O Taubaté Burguer captura a essência da região em cada mordida, usando ingredientes sazonais para uma experiência autêntica.',
		'../img/Veganos/vegano4.png',
		'Veganos',
		37.99
	),
	(
		14,
		'Brown Burguer',
		'Uma harmonia de sabores vegetais em um hambúrguer vegano feito com leguminosas, vegetais frescos e molho à base de ervas.',
		'../img/Veganos/vegano5.png',
		'Veganos',
		30.99
	),
	(
		15,
		'Mediterranean Burguer',
		'Uma experiência mediterrânea em um hambúrguer vegano com grão-de-bico, vegetais frescos e azeite de oliva.',
		'../img/Veganos/vegano6.png',
		'Veganos',
		34.99
	),
	(
		16,
		'Oliver Burguer',
		'Um hambúrguer gourmet com carne premium, pão brioche artesanal, queijo Gruyère, cebolas caramelizadas, maionese de alho, vegetais frescos e picles caseiros. Uma experiência culinária única e inesquecível.',
		'../img/Da Casa/oliver-burguer.png',
		'Da Casa',
		50.99
	),
	(
		17,
		'Luz Burguer',
		'Servido em pão fresco, “Luz Burguer” é especialmente desenvolvido para realçar os sabores intensos. A textura equilibrada do pão complementa a suculência da carne, tornando cada mordida única.',
		'../img/Da Casa/light-burguer.png',
		'Da Casa',
		45.99
	),
	(
		18,
		'Bennto Burguer',
		'Uma fusão de sabores exóticos aguarda você com o Bennto Burguer. Com ingredientes dos mais derivados lugares cuidadosamente selecionados, criando uma harmonia.',
		'../img/Da Casa/bento-burguer.png',
		'Da Casa',
		40.99
	),
	(
		19,
		'Sauce Burguer',
		'Uma celebração de sabores diversos, o Sauce Burguer é feito com uma variedade de molhos especiais para agradar aos amantes de opções diversas.',
		'../img/Da Casa/sauce-burguer.png',
		'Da Casa',
		42.99
	),
	(
		20,
		'Wendell Burguer',
		'É a escolha reforçada para os amantes de academia. Com ingredientes nutritivos e ricos em proteína vegana, este hambúrguer é uma opção substancial para sustentar o seu estilo de vida ativo.',
		'../img/Da Casa/wendell-burguer.png',
		'Da Casa',
		41.99
	),
	(
		21,
		'Vitoria Burguer',
		'Nossa criação exclusiva combina carne suculenta, queijo derretido, alface fresca e molho especial da casa. Uma vitória de sabores em cada mordida.',
		'../img/Da Casa/vitoria-burguer.png',
		'Da Casa',
		48.99
	),
	(
		22,
		'Batata simples',
		'Cortadas em finos pedaços e fritas até ficarem douradas e crocantes por fora, são uma delícia versátil, perfeita para qualquer momento e acompanhadas por diversos temperos e molhos.',
		'../img/Fritas/batata-simples.png',
		'Fritas',
		29.99
	),
	(
		23,
		'Batata + Cheddar e Bacon',
		'Combinação perfeita de maciez, queijo cheddar derretido e pedaços crocantes de bacon. Uma explosão de sabores em cada mordida, irresistível para os paladares exigentes.',
		'../img/Fritas/batata-cheddar-bacon.png',
		'Fritas',
		39.99
	),
	(
		24,
		'Batata + Contra filé',
		'A combinação irresistível de batata frita e contrafilé grelhado proporciona uma refeição deliciosa e satisfatória, com a crocância das batatas complementando o sabor suculento da carne.',
		'../img/Fritas/batata-contra-file.png',
		'Fritas',
		59.99
	),
	(
		25,
		'Nuggets simples',
		'Nuggets são pedaços de carne, como frango, crocantes por fora e macios por dentro, ideais para lanches rápidos e deliciosos acompanhados de molhos variados. Uma opção saborosa e prática para todas as idades.',
		'../img/Nuggets/nugget-simples.png',
		'Nuggets',
		25.99
	),
	(
		26,
		'Nuggets + Molhos',
		'Crocantes e deliciosos, nossos Nuggets Gourmet vêm acompanhados por molhos artesanais que elevam o sabor a um novo nível.',
		'../img/Nuggets/nugget-molho.png',
		'Nuggets',
		26.99
	),
	(
		27,
		'Nuggets + Salada',
		'Uma opção equilibrada, nossos Nuggets Gourmet são servidos com uma salada fresca, combinando crocância com uma refeição nutritiva.',
		'../img/Nuggets/nugget-batata-salada.png',
		'Nuggets',
		28.99
	),
	(
		28,
		'Calabresa simples',
		'A autenticidade da calabresa artesanal em sua forma pura, celebração do sabor tradicional.',
		'../img/Calabresa/calabresa-simples.png',
		'Calabresa',
		29.99
	),
	(
		29,
		'Calabresa + Fritas',
		'Intensidade da calabresa artesanal com fritas crocantes, uma combinação que satisfaz os apreciadores de sabores marcantes.',
		'../img/Calabresa/calabresa-batata.png',
		'Calabresa',
		39.90
	),
	(
		30,
		'Calabresa + Fritas + Contra Filé',
		'Experiência completa: calabresa artesanal, fritas e suculento contra filé grelhado, tudo em uma única porção.',
		'../img/Calabresa/calabresa-contra-file.png',
		'Calabresa',
		52.99
	),
	(
		31,
		'Frango simples',
		'Sabor autêntico do frango em uma porção descomplicada.',
		'../img/Frango/frango-simples.png',
		'Frango',
		19.99
	),
	(
		32,
		'Frango empanado',
		'Textura crocante, sabor suculento. Frango empanado para quem ama uma experiência de sabores contrastantes.',
		'../img/Frango/frango-empanado.png',
		'Frango',
		22.99
	),
	(
		33,
		'Frango + fritas',
		'Frango e fritas gourmet em uma porção irresistível. Combinação de sabores que sacia seu desejo por uma refeição deliciosa.',
		'../img/Frango/frango-batata-frita.png',
		'Frango',
		29.99
	),
	(
		34,
		'Coca - Cola',
		'Aclamado em todo o mundo, o sabor icônico da Coca-Cola é uma explosão de refrescância e felicidade. Uma escolha clássica para saciar a sede.',
		'../img/Refrigerantes/coca.png',
		'Refrigerantes',
		6.99
	),
	(
		35,
		'Guaraná',
		'Com um toque brasileiro, o Guaraná oferece um sabor único e energizante. A doçura equilibrada e a efervescência fazem dele uma escolha popular.',
		'../img/Refrigerantes/guarana.png',
		'Refrigerantes',
		6.99
	),
	(
		36,
		'Sprite',
		'Brilhante e cítrico, o Sprite traz a sensação de limpeza e frescor. Seu sabor limonado é uma opção vibrante para momentos leves.',
		'../img/Refrigerantes/sprite.png',
		'Refrigerantes',
		6.99
	),
	(
		37,
		'Fanta',
		'Celebre a diversão com os diversos sabores da Fanta. Das frutas às cores vibrantes, cada gole é uma experiência alegre e refrescante.',
		'../img/Refrigerantes/fanta.png',
		'Refrigerantes',
		6.99
	),
	(
		38,
		'Pepsi',
		'Uma alternativa saborosa, a Pepsi oferece um sabor distinto e equilibrado. Satisfazendo paladares diversos, é uma escolha para quem busca uma opção diferente de cola.',
		'../img/Refrigerantes/pepsi.png',
		'Refrigerantes',
		6.99
	),
	(
		39,
		'Suco de laranja natural',
		'Desfrute da refrescância e do sabor autêntico da natureza em cada gole. Nosso suco de laranja natural é uma explosão cítrica que revitaliza seus sentidos.',
		'../img/Sucos/suco-laranja.png',
		'Sucos',
		12.99
	),
	(
		40,
		'Suco de Abacaxi',
		'Leve a doçura tropical para sua boca com nosso suco de abacaxi. Cada gole é uma viagem para as praias ensolaradas.',
		'../img/Sucos/suco-abacaxi.png',
		'Sucos',
		12.99
	),
	(
		41,
		'Suco de Morango',
		'Uma explosão de sabor frutado aguarda você com nosso suco de morango. A doçura dos morangos frescos é uma indulgência irresistível.',
		'../img/Sucos/suco-morango.png',
		'Sucos',
		12.99
	),
	(
		42,
		'Suco de Limão',
		'Revigore seu paladar com nosso suco de limão. O sabor cítrico é a escolha perfeita para um toque refrescante.',
		'../img/Sucos/suco-limao.png',
		'Sucos',
		12.99
	),
	(
		43,
		'Suco de Maracujá',
		'Delicie-se com a intensidade tropical do nosso suco de maracujá. Cada gole é uma viagem para climas exóticos e sabores marcantes.',
		'../img/Sucos/suco-maracuja.png',
		'Sucos',
		12.99
	),
	(
		44,
		'Cosmopolitan',
		'O Cosmopolitan é um coquetel refinado com vodka, licor de laranja, suco de cranberry e limão, oferecendo uma harmonia de sabores agridoces e cítricos.',
		'../img/Drinks/cosmopolian.png',
		'Drinks',
		19.99
	),
	(
		45,
		'Caipirinha',
		'A Caipirinha é um ícone brasileiro, combinando cachaça, limão fresco espremido e açúcar, resultando em um coquetel refrescante e cítrico, perfeito para celebrar a cultura e o sabor do Brasil.',
		'../img/Drinks/caipirinha.png',
		'Drinks',
		22.99
	),
	(
		46,
		'Old Fashioned',
		'O Old Fashioned é um clássico intemporal, unindo bourbon, açúcar, angostura e casca de laranja. Sua simplicidade destaca a riqueza do bourbon, criando uma experiência de coquetel marcante e sofisticada.',
		'../img/Drinks/old-fashioned.png',
		'Drinks',
		34.99
	),
	(
		47,
		'Whisky Sour',
		'Uma ode à sofisticação, o Whisky Sour é a harmonia perfeita entre o sabor robusto do whisky e o toque refrescante do limão. Cada gole é uma experiência que cativa os apreciadores de sabores refinados.',
		'../img/Drinks/whisky.png',
		'Drinks',
		26.99
	);

-- Copiando estrutura para tabela hamburgueria_db.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
	`id_usuario` int(11) NOT NULL AUTO_INCREMENT,
	`nome_usuario` varchar(50) NOT NULL,
	`senha_usuario` varchar(150) NOT NULL,
	`status_usuario` enum('Administrador', 'Cozinheiro') NOT NULL,
	PRIMARY KEY (`id_usuario`)
) ENGINE = InnoDB AUTO_INCREMENT = 31 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Copiando dados para a tabela hamburgueria_db.usuarios: ~1 rows (aproximadamente)
INSERT INTO
	`usuarios` (
		`id_usuario`,
		`nome_usuario`,
		`senha_usuario`,
		`status_usuario`
	)
VALUES
	(
		21,
		'adm',
		'$2y$10$4LCMNox141K57DRuMNfidOa8VkkFJOfismPAjwr6U1/M57kXVZCLm',
		'Administrador'
	),
	(
		30,
		'coz',
		'$2y$10$Du/ucmzCJyc4OJI53ntNYuPyfkzpS6t23860mRCdPv5JUF.eHqs7a',
		'Cozinheiro'
	);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */
;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */
;

/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */
;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */
;