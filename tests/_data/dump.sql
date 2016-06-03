--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.2
-- Dumped by pg_dump version 9.5.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: migrations; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE migrations (
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE migrations OWNER TO root;

--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: derrickmushangi
--

CREATE TABLE password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE password_resets OWNER TO derrickmushangi;

--
-- Name: users; Type: TABLE; Schema: public; Owner: derrickmushangi
--

CREATE TABLE users (
    id integer NOT NULL,
    uuid uuid NOT NULL,
    username character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    status character varying(255) DEFAULT 'Active'::character varying NOT NULL,
    avatar character varying(255),
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE users OWNER TO derrickmushangi;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: derrickmushangi
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_id_seq OWNER TO derrickmushangi;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: derrickmushangi
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: derrickmushangi
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: root
--

COPY migrations (migration, batch) FROM stdin;
2014_10_12_000000_create_users_table	1
2014_10_12_100000_create_password_resets_table	1
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: derrickmushangi
--

COPY password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: derrickmushangi
--

COPY users (id, uuid, username, email, password, status, avatar, remember_token, created_at, updated_at, deleted_at) FROM stdin;
1	ef451aa8-2dca-4a53-92d5-bff19d81c359	Rickie Bernier	admin@gmail.com	$2y$10$UlQlEdEM5ldWlxCkUmP95.2YpD/pP7pKMOYuRHmLb8PY298UrDL3G	1	http://localhost/profiles/avatars/avatar3.jpeg	\N	2016-06-02 06:41:52	2016-06-02 06:41:52	\N
2	45091731-31b6-4b07-9576-af24293c395a	Prof. Ceasar Altenwerth Jr.	arianna.kuhlman@beatty.com	$2y$10$Anx.2Y/xdB8IuSlNLTE0C.OOAzoTH1mCA/lP7FNHS3jRdCoFCOqu6	0	http://localhost/profiles/avatars/avatar4.jpeg	\N	2016-06-02 06:41:52	2016-06-02 06:41:52	\N
3	997f92b6-aefa-4e91-8aaa-81a83057a0a5	Miss Leslie Konopelski	stephan.dicki@yahoo.com	$2y$10$0B3Q/ArjvSZEVS4/4PE1ce3vqsJX/Ab.Ch2JvA8PJaRrYRoLyfMli	1	http://localhost/profiles/avatars/avatar3.jpeg	\N	2016-06-02 06:41:52	2016-06-02 06:41:52	\N
4	2194d4a7-a94a-4bde-bb62-7239566d9ff8	Prof. Dallin McLaughlin	uboyle@example.net	$2y$10$0jm8c2brcO1ui9OqUJnl3efXi7P66MyUiwjeWVwMgyyfTZxvwDKZ.	Active	\N	\N	2016-06-02 06:41:59	2016-06-02 06:41:59	\N
5	6e875131-8082-45ea-b0ba-208586289cb4	Oliver Beatty	uriah11@example.net	$2y$10$ikwlffhKNz8.bwOpM0U1G.I9UaseThZ4nFmjvJs5tCjzq0.ehaj.W	Active	\N	\N	2016-06-02 06:45:10	2016-06-02 06:45:10	\N
6	6db817f1-3a04-46ee-b56d-04cd3599fcf6	Dr. Myra Borer PhD	zherman@example.net	$2y$10$bvwtdr25rr5Pd/LQ.6h4LeOHpeP.XaOh2FV8i3Biu2qYtLlc5GvE6	Active	\N	\N	2016-06-02 06:45:10	2016-06-02 06:45:10	\N
7	5ba73344-52c9-479b-9e4e-e658522dc688	Harvey Corkery MD	betsy.oreilly@example.com	$2y$10$wM8VTG.MmB42t4i491oShOCt7v8P8SSE6xAHhgGuJXTz9dPOk1t6e	Active	\N	\N	2016-06-02 06:49:06	2016-06-02 06:49:06	\N
8	00bcd445-4acf-44db-b1d9-15bcc6667705	Prof. Rosamond Cassin	ntoy@example.org	$2y$10$ZOsCx5SSclIByhYXW4VveO64UiUxw0OnYf5QMRiJusayfoqUrKEiG	Active	\N	\N	2016-06-02 06:49:06	2016-06-02 06:49:06	\N
9	2be54777-a51d-44e7-8c11-8eee39e9fa97	Sigurd Toy	hcasper@example.net	$2y$10$DBnBqe9tkJE2mXUTz0eHtegET/I6KskX3GmTaLS2YeGduo/bpP6D6	Active	\N	\N	2016-06-02 06:49:56	2016-06-02 06:49:56	\N
10	97ca446f-3e4d-42fa-ad8a-73dc5bc3050e	Cathrine Frami	verlie28@example.com	$2y$10$tw/FTVyxNo4l9YyMxfToXuTRW55aUcqVtiWbI01ALc.x/ozSu5H9e	Active	\N	\N	2016-06-02 06:49:56	2016-06-02 06:49:56	\N
11	26783306-87d1-4e31-b75a-9ea5e76430e4	Axel Koch	morar.shaina@example.net	$2y$10$wOWn5M1bwgDIicKNHWsmJuGwB8w2PUTsKwRgiqBn2pBRfW9KabRU2	Active	\N	\N	2016-06-02 06:57:14	2016-06-02 06:57:14	\N
12	d16aa781-8f7b-4848-91a1-c3d1306bfff3	Miss Alyce Koss	alyce02@example.com	$2y$10$MgNK.I/cCyu31vyHrrQjjOCebwFzD4NwY7VWRnR8FgWJcTuFt/KVe	Active	\N	\N	2016-06-02 06:57:14	2016-06-02 06:57:14	\N
13	9dc76715-07de-4d03-a1e0-49d670d30222	Mr. Dino Schuster PhD	gerhold.melany@example.net	OkjLUcyWUF	Active	\N	\N	2016-06-02 07:01:41	2016-06-02 07:01:41	\N
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: derrickmushangi
--

SELECT pg_catalog.setval('users_id_seq', 17, true);


--
-- Name: users_email_unique; Type: CONSTRAINT; Schema: public; Owner: derrickmushangi
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: derrickmushangi
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: users_username_unique; Type: CONSTRAINT; Schema: public; Owner: derrickmushangi
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_username_unique UNIQUE (username);


--
-- Name: users_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: derrickmushangi
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_uuid_unique UNIQUE (uuid);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: derrickmushangi
--

CREATE INDEX password_resets_email_index ON password_resets USING btree (email);


--
-- Name: password_resets_token_index; Type: INDEX; Schema: public; Owner: derrickmushangi
--

CREATE INDEX password_resets_token_index ON password_resets USING btree (token);


--
-- Name: public; Type: ACL; Schema: -; Owner: derrickmushangi
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM derrickmushangi;
GRANT ALL ON SCHEMA public TO derrickmushangi;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

