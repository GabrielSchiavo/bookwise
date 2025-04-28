-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           PostgreSQL 17.4 (Debian 17.4-1.pgdg120+2) on x86_64-pc-linux-gnu, compiled by gcc (Debian 12.2.0-14) 12.2.0, 64-bit
-- OS do Servidor:               
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET NAMES  */
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
-- Copiando dados para a tabela public.books: -1 rows
DELETE FROM "books";
/*!40000 ALTER TABLE "books" DISABLE KEYS */
;
INSERT INTO "books" (
		"id",
		"cover_image",
		"title",
		"author",
		"literary_gender_id",
		"literary_gender",
		"publisher",
		"year",
		"isbn",
		"status",
		"created_at",
		"updated_at"
	)
VALUES (
		4,
		'51tAD6LyZLSY466_1745878127.jpg',
		'Fahrenheit 451',
		'Ray Bradbury',
		1,
		'Ficção',
		'Biblioteca Azul',
		2012,
		'8-525052-24-8',
		3,
		'2025-04-28 19:08:47',
		'2025-04-28 19:08:47'
	),
	(
		2,
		'81hCVEC0ExL_1745878025.jpg',
		'O Senhor dos Anéis: A Sociedade do Anel',
		'J.R.R. Tolkien',
		2,
		'Fantasia',
		'HarperCollins',
		2019,
		'8-595084-75-0',
		1,
		'2025-04-28 19:07:05',
		'2025-04-28 19:09:12'
	),
	(
		3,
		'91Bx5ilPELSY466_1745878083.jpg',
		'Neuromancer',
		'William Gibson',
		1,
		'Ficção',
		'Aleph',
		2016,
		'978-8-57-657300-5',
		2,
		'2025-04-28 19:08:03',
		'2025-04-28 19:09:57'
	),
	(
		1,
		'81zN7udGRUL_1745877970.jpg',
		'Duna',
		'Franklin Patrick Herbert Jr.',
		3,
		'Aventura',
		'Aleph',
		2017,
		'978-8-57-657313-5',
		4,
		'2025-04-28 19:06:10',
		'2025-04-28 19:09:58'
	);
/*!40000 ALTER TABLE "books" ENABLE KEYS */
;
-- Copiando dados para a tabela public.books_loans: -1 rows
DELETE FROM "books_loans";
/*!40000 ALTER TABLE "books_loans" DISABLE KEYS */
;
INSERT INTO "books_loans" (
		"id",
		"loan_date",
		"return_date",
		"person",
		"book_id",
		"book",
		"status",
		"created_at",
		"updated_at"
	)
VALUES (
		1,
		'2025-04-28',
		'2025-05-05',
		'José Silva',
		2,
		'O Senhor dos Anéis: A Sociedade do Anel',
		1,
		'2025-04-28 19:09:12',
		'2025-04-28 19:09:12'
	),
	(
		3,
		'2025-04-22',
		'2025-04-29',
		'Maria Soares',
		3,
		'Neuromancer',
		2,
		'2025-04-28 19:09:57',
		'2025-04-28 19:09:57'
	),
	(
		2,
		'2025-04-16',
		'2025-04-23',
		'João Santos',
		1,
		'Duna',
		4,
		'2025-04-28 19:09:34',
		'2025-04-28 19:09:58'
	);
/*!40000 ALTER TABLE "books_loans" ENABLE KEYS */
;
-- Copiando dados para a tabela public.literary_genres: 3 rows
DELETE FROM "literary_genres";
/*!40000 ALTER TABLE "literary_genres" DISABLE KEYS */
;
INSERT INTO "literary_genres" ("id", "name", "created_at", "updated_at")
VALUES (
		1,
		'Ficção',
		'2025-04-28 18:55:53',
		'2025-04-28 18:55:53'
	),
	(
		2,
		'Fantasia',
		'2025-04-28 18:56:02',
		'2025-04-28 18:56:02'
	),
	(
		3,
		'Aventura',
		'2025-04-28 18:58:21',
		'2025-04-28 18:58:21'
	);
/*!40000 ALTER TABLE "literary_genres" ENABLE KEYS */
;
-- Copiando dados para a tabela public.migrations: 6 rows
DELETE FROM "migrations";
/*!40000 ALTER TABLE "migrations" DISABLE KEYS */
;
INSERT INTO "migrations" ("id", "migration", "batch")
VALUES (1, '2025_04_25_102400_create_persons_table', 1),
	(
		2,
		'2025_04_25_102500_create_literary_genres_table',
		1
	),
	(3, '2025_04_25_102600_create_books_table', 1),
	(
		4,
		'2025_04_25_102700_create_books_loans_table',
		1
	),
	(
		5,
		'2025_04_25_102800_create_relationships_books_table',
		1
	),
	(
		6,
		'2025_04_25_102900_create_relationships_books_loans_table',
		1
	);
/*!40000 ALTER TABLE "migrations" ENABLE KEYS */
;
-- Copiando dados para a tabela public.persons: 3 rows
DELETE FROM "persons";
/*!40000 ALTER TABLE "persons" DISABLE KEYS */
;
INSERT INTO "persons" (
		"id",
		"name_last_name",
		"phone",
		"email",
		"created_at",
		"updated_at"
	)
VALUES (
		1,
		'José Silva',
		'(55) 55555-5555',
		'teste@teste.com',
		'2025-04-28 18:59:23',
		'2025-04-28 18:59:23'
	),
	(
		2,
		'João Santos',
		'(22) 22222-2222',
		'teste2@teste2.com',
		'2025-04-28 19:03:51',
		'2025-04-28 19:03:51'
	),
	(
		3,
		'Maria Soares',
		'(32) 33333-3333',
		'teste3@teste3.com',
		'2025-04-28 19:04:15',
		'2025-04-28 19:04:15'
	);
/*!40000 ALTER TABLE "persons" ENABLE KEYS */
;
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