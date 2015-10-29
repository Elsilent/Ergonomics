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

--
-- TOC entry 1933 (class 0 OID 25296)
-- Dependencies: 171
-- Data for Name: logs; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (1, 'wdw', 900, 5000, 6000, 863);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (3, 'Иванов Иван Иванович', 3465, 3091, 1448, 1422);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (4, 'test', NULL, NULL, NULL, 1300);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (5, 'test', NULL, NULL, NULL, 1340);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (6, 'test', NULL, NULL, NULL, 1290);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (7, 'test', NULL, NULL, NULL, 1250);
INSERT INTO logs (id, username, form1, form2, form3, form4) VALUES (2, 'test', 2000, 3000, 4000, 2000);


--
-- TOC entry 1943 (class 0 OID 0)
-- Dependencies: 170
-- Name: logs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('logs_id_seq', 3, true);


-- Completed on 2015-10-27 10:01:41

--
-- PostgreSQL database dump complete
--






