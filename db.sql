--
-- PostgreSQL database dump
--

-- Database: "Ergonomics"

-- DROP DATABASE "Ergonomics";

CREATE DATABASE "Ergonomics"
WITH OWNER = postgres
ENCODING = 'UTF8'
TABLESPACE = pg_default
LC_COLLATE = 'Russian_Russia.1251'
LC_CTYPE = 'Russian_Russia.1251'
CONNECTION LIMIT = -1;

-- Table: logs

-- DROP TABLE logs;

CREATE TABLE logs
(
  id serial NOT NULL,
  username character varying NOT NULL,
  form1 integer,
  form2 integer,
  form3 integer,
  form4 integer
)
WITH (
OIDS=FALSE
);
ALTER TABLE logs
OWNER TO postgres;


-- Dumped from database version 9.3.5
-- Dumped by pg_dump version 9.3.5
-- Started on 2015-10-27 10:01:41

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (4, 'Эксперт1', 33616, 32596, 31211, 28792);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (5, 'Эксперт2', 28744, 33830, 28763, 25397);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (7, 'Эксперт3', 26338, 30631, 27970, 24437);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (8, 'Эксперт4', 26569, 30736, 28769, 29264);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (10, 'Эксперт1', NULL, NULL, NULL, 23460);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (11, 'Эксперт1', NULL, NULL, NULL, 22210);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (12, 'Эксперт1', NULL, NULL, NULL, 22253);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (13, 'Эксперт1', NULL, NULL, NULL, 21685);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (19, 'Эксперт2', NULL, NULL, NULL, 25100);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (20, 'Эксперт2', NULL, NULL, NULL, 25072);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (21, 'Эксперт2', NULL, NULL, NULL, 24572);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (22, 'Эксперт2', NULL, NULL, NULL, 24472);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (23, 'Эксперт3', NULL, NULL, NULL, 23000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (24, 'Эксперт3', NULL, NULL, NULL, 22800);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (25, 'Эксперт3', NULL, NULL, NULL, 22900);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (26, 'Эксперт3', NULL, NULL, NULL, 22000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (29, 'Эксперт4', NULL, NULL, NULL, 27000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (30, 'Эксперт4', NULL, NULL, NULL, 25000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (31, 'Эксперт4', NULL, NULL, NULL, 24500);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (32, 'Эксперт4', NULL, NULL, NULL, 24000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (34, 'Эксперт6', NULL, NULL, NULL, 19000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (35, 'Эксперт6', NULL, NULL, NULL, 18000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (36, 'Эксперт6', NULL, NULL, NULL, 18000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (37, 'Эксперт6', NULL, NULL, NULL, 17500);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (39, 'Эксперт7', NULL, NULL, NULL, 17000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (40, 'Эксперт7', NULL, NULL, NULL, 16000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (41, 'Эксперт7', NULL, NULL, NULL, 16000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (42, 'Эксперт7', NULL, NULL, NULL, 14000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (44, 'Эксперт8', NULL, NULL, NULL, 31000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (45, 'Эксперт8', NULL, NULL, NULL, 33000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (46, 'Эксперт8', NULL, NULL, NULL, 29000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (47, 'Эксперт8', NULL, NULL, NULL, 27000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (49, 'Эксперт9', NULL, NULL, NULL, 38200);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (50, 'Эксперт9', NULL, NULL, NULL, 36200);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (51, 'Эксперт9', NULL, NULL, NULL, 35200);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (52, 'Эксперт9', NULL, NULL, NULL, 33200);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (54, 'Эксперт10', NULL, NULL, NULL, 28000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (55, 'Эксперт10', NULL, NULL, NULL, 27000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (56, 'Эксперт10', NULL, NULL, NULL, 28000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (57, 'Эксперт10', NULL, NULL, NULL, 25000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (48, 'Эксперт9', 45000, 55000, 44000, 40200);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (43, 'Эксперт8', 40000, 42000, 41000, 32000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (38, 'Эксперт7', 22000, 22500, 23000, 18000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (33, 'Эксперт6', 25000, 28000, 20000, 19800);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (53, 'Эксперт10', 32000, 45000, 38000, 29000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (58, 'Эксперт11', 28000, 34000, 31000, 30000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (59, 'Эксперт12', 40000, 42000, 45000, 39000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (60, 'Эксперт13', 25000, 27000, 24000, 23000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (61, 'Эксперт14', 22000, 25000, 24000, 22000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (62, 'Эксперт15', 27000, 28000, 25000, 25000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (63, 'Эксперт16', 21000, 21000, 23000, 22000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (64, 'Эксперт17', 25000, 27000, 30000, 29000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (65, 'Эксперт18', 24000, 27000, 26000, 22000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (66, 'Эксперт19', 21000, 22000, 25000, 24000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (67, 'Эксперт20', 35000, 41000, 37000, 34000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (17, 'Эксперт5', NULL, NULL, NULL, 59000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (18, 'Эксперт5', NULL, NULL, NULL, 57000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (14, 'Эксперт5', 79913, 99958, 80565, 75000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (15, 'Эксперт5', NULL, NULL, NULL, 65000);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (16, 'Эксперт5', NULL, NULL, NULL, 60000);


--
-- TOC entry 1943 (class 0 OID 0)
-- Dependencies: 170
-- Name: logs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('logs_id_seq', 67, true);


-- Completed on 2015-10-27 10:01:41

--
-- PostgreSQL database dump complete
--






