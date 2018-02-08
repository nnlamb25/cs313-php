--
-- PostgreSQL database dump
--

-- Dumped from database version 10.1
-- Dumped by pg_dump version 10.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
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
-- Name: opinion_post; Type: TABLE; Schema: public; Owner: bruigbiqkmqflz
--

CREATE TABLE opinion_post (
    id integer NOT NULL,
    poster_id integer NOT NULL,
    post_title character varying(350) NOT NULL,
    post_text text NOT NULL,
    votes_agree integer NOT NULL,
    votes_disagree integer NOT NULL,
    num_comments integer NOT NULL,
    date_posted date NOT NULL
);


ALTER TABLE opinion_post OWNER TO bruigbiqkmqflz;

--
-- Name: opinion_post_id_seq; Type: SEQUENCE; Schema: public; Owner: bruigbiqkmqflz
--

CREATE SEQUENCE opinion_post_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE opinion_post_id_seq OWNER TO bruigbiqkmqflz;

--
-- Name: opinion_post_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bruigbiqkmqflz
--

ALTER SEQUENCE opinion_post_id_seq OWNED BY opinion_post.id;


--
-- Name: post_comment; Type: TABLE; Schema: public; Owner: bruigbiqkmqflz
--

CREATE TABLE post_comment (
    id integer NOT NULL,
    post_id integer NOT NULL,
    poster_id integer NOT NULL,
    votes_agree integer NOT NULL,
    votes_disagree integer NOT NULL,
    reply_to_post_id integer,
    comment_text text NOT NULL,
    date_commented date NOT NULL
);


ALTER TABLE post_comment OWNER TO bruigbiqkmqflz;

--
-- Name: post_comment_id_seq; Type: SEQUENCE; Schema: public; Owner: bruigbiqkmqflz
--

CREATE SEQUENCE post_comment_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE post_comment_id_seq OWNER TO bruigbiqkmqflz;

--
-- Name: post_comment_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bruigbiqkmqflz
--

ALTER SEQUENCE post_comment_id_seq OWNED BY post_comment.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: bruigbiqkmqflz
--

CREATE TABLE "user" (
    id integer NOT NULL,
    username character varying(100) NOT NULL,
    password character varying(100) NOT NULL,
    is_mod boolean NOT NULL,
    data_registered date NOT NULL
);


ALTER TABLE "user" OWNER TO bruigbiqkmqflz;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: bruigbiqkmqflz
--

CREATE SEQUENCE user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE user_id_seq OWNER TO bruigbiqkmqflz;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: bruigbiqkmqflz
--

ALTER SEQUENCE user_id_seq OWNED BY "user".id;


--
-- Name: opinion_post id; Type: DEFAULT; Schema: public; Owner: bruigbiqkmqflz
--

ALTER TABLE ONLY opinion_post ALTER COLUMN id SET DEFAULT nextval('opinion_post_id_seq'::regclass);


--
-- Name: post_comment id; Type: DEFAULT; Schema: public; Owner: bruigbiqkmqflz
--

ALTER TABLE ONLY post_comment ALTER COLUMN id SET DEFAULT nextval('post_comment_id_seq'::regclass);


--
-- Name: user id; Type: DEFAULT; Schema: public; Owner: bruigbiqkmqflz
--

ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_id_seq'::regclass);


--
-- Data for Name: opinion_post; Type: TABLE DATA; Schema: public; Owner: bruigbiqkmqflz
--

COPY opinion_post (id, poster_id, post_title, post_text, votes_agree, votes_disagree, num_comments, date_posted) FROM stdin;
\.


--
-- Data for Name: post_comment; Type: TABLE DATA; Schema: public; Owner: bruigbiqkmqflz
--

COPY post_comment (id, post_id, poster_id, votes_agree, votes_disagree, reply_to_post_id, comment_text, date_commented) FROM stdin;
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: bruigbiqkmqflz
--

COPY "user" (id, username, password, is_mod, data_registered) FROM stdin;
\.


--
-- Name: opinion_post_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bruigbiqkmqflz
--

SELECT pg_catalog.setval('opinion_post_id_seq', 1, false);


--
-- Name: post_comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bruigbiqkmqflz
--

SELECT pg_catalog.setval('post_comment_id_seq', 1, false);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bruigbiqkmqflz
--

SELECT pg_catalog.setval('user_id_seq', 1, false);


--
-- Name: opinion_post opinion_post_pkey; Type: CONSTRAINT; Schema: public; Owner: bruigbiqkmqflz
--

ALTER TABLE ONLY opinion_post
    ADD CONSTRAINT opinion_post_pkey PRIMARY KEY (id);


--
-- Name: post_comment post_comment_pkey; Type: CONSTRAINT; Schema: public; Owner: bruigbiqkmqflz
--

ALTER TABLE ONLY post_comment
    ADD CONSTRAINT post_comment_pkey PRIMARY KEY (id);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: bruigbiqkmqflz
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: user user_username_key; Type: CONSTRAINT; Schema: public; Owner: bruigbiqkmqflz
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_username_key UNIQUE (username);


--
-- Name: opinion_post opinion_post_poster_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bruigbiqkmqflz
--

ALTER TABLE ONLY opinion_post
    ADD CONSTRAINT opinion_post_poster_id_fkey FOREIGN KEY (poster_id) REFERENCES "user"(id);


--
-- Name: post_comment post_comment_post_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bruigbiqkmqflz
--

ALTER TABLE ONLY post_comment
    ADD CONSTRAINT post_comment_post_id_fkey FOREIGN KEY (post_id) REFERENCES opinion_post(id);


--
-- Name: post_comment post_comment_poster_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bruigbiqkmqflz
--

ALTER TABLE ONLY post_comment
    ADD CONSTRAINT post_comment_poster_id_fkey FOREIGN KEY (poster_id) REFERENCES "user"(id);


--
-- Name: post_comment post_comment_reply_to_post_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bruigbiqkmqflz
--

ALTER TABLE ONLY post_comment
    ADD CONSTRAINT post_comment_reply_to_post_id_fkey FOREIGN KEY (reply_to_post_id) REFERENCES post_comment(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: bruigbiqkmqflz
--

REVOKE ALL ON SCHEMA public FROM postgres;
REVOKE ALL ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO bruigbiqkmqflz;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: plpgsql; Type: ACL; Schema: -; Owner: postgres
--

GRANT ALL ON LANGUAGE plpgsql TO bruigbiqkmqflz;


--
-- PostgreSQL database dump complete
--

