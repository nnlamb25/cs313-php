--
-- PostgreSQL database dump
--

-- Dumped from database version 10.2 (Ubuntu 10.2-1.pgdg14.04+1)
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

--
-- Name: be_careful; Type: TYPE; Schema: public; Owner: bruigbiqkmqflz
--

CREATE TYPE be_careful AS ENUM (
    'exposing',
    'credentials',
    'isn''t',
    'safe'
);


ALTER TYPE be_careful OWNER TO bruigbiqkmqflz;

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
    date_posted date NOT NULL,
    changed_minds integer NOT NULL
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
    reply_to_comment_id integer,
    comment_text text NOT NULL,
    date_commented date NOT NULL,
    changed_minds integer NOT NULL
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
    date_registered date NOT NULL
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

COPY opinion_post (id, poster_id, post_title, post_text, votes_agree, votes_disagree, date_posted, changed_minds) FROM stdin;
2	1	This is the greatest website ever made.	I know that I'm biased, because I did make this site, but I really think it's the best site ever made in the history of the internet.	1	0	2018-02-08	0
3	1	We need to be more open to hearing opinions we disagree with.	With all the problems in the world, we don't seem to get anywhere when we can't even talk about them.  Too many people either only talk to people they agree with, or get angry when presented with an opinion they disagree with.  If we really want to solve this problems, we need to talk about them instead of living in an echo chamber or not listening to eachother.	1	0	2018-02-08	0
4	2	I think they should make more movies from Tolkien's books.	Lord of the Rings still holds up today as being a cinematic masterpiece, after more than 14 years.  The Hobbit is also loved by many.  J. R. R. Tolkien has written so many inredible books that it would be a shame if nobody presented them on the big screen.	1	0	2018-02-08	0
5	3	I think we need to listen to opinions we disgree with more to be more understanding of eachother.	Too often we live in echo chambers where we only will listen to opinions we disagree with.  This causes us to get uncomfortable or upset when an opinion we disagree with is presented.  We will never become a better world if we can't talk about things that we disagree with in a civil manner.	1	0	2018-02-08	0
7	1	I hope this works	Heres to this working!	1	0	2018-02-14	0
9	1	This site is ok	I'm just kidding	1	0	2018-02-14	0
10	30	I am the greatest	Not muhammed ali!	1	0	2018-02-14	0
11	31	An Interesting and Descriptive Title	Post description	1	0	2018-02-20	0
12	1	This post should be on top	Now shows posts in DESCENDING order, by date!	1	0	2018-02-20	0
\.


--
-- Data for Name: post_comment; Type: TABLE DATA; Schema: public; Owner: bruigbiqkmqflz
--

COPY post_comment (id, post_id, poster_id, votes_agree, votes_disagree, reply_to_comment_id, comment_text, date_commented, changed_minds) FROM stdin;
10	2	4	1	0	\N	I honestly have never visited a better site.	2018-02-09	0
11	2	1	1	0	\N	Inside the DB	2018-02-14	0
13	2	1	1	0	\N	Do you see me?	2018-02-14	0
14	2	1	1	0	\N	Here it is!	2018-02-14	0
16	2	1	1	0	\N	Hope it works!! please	2018-02-14	0
7	2	2	1	0	\N	Yeah, I have to agree.	2018-02-08	0
8	3	1	1	0	\N	I would love to see more movies from that universe!  Lord of the Rings is my favorite trilogy, and The Hobbit is great too!!	2018-02-08	0
9	2	3	1	0	7	Me too	2018-02-08	0
17	2	1	1	0	\N	no	2018-02-14	0
18	2	1	1	0	\N	alright then	2018-02-14	0
19	2	1	1	0	\N	Nope	2018-02-14	0
20	2	1	1	0	\N	Yeah right	2018-02-14	0
21	2	1	1	0	\N	wow ok then	2018-02-14	0
22	2	1	1	0	\N	outside DB	2018-02-14	0
23	2	1	1	0	\N	oooo	2018-02-14	0
26	2	1	1	0	10	sure....	2018-02-14	0
27	5	1	1	0	\N	Wow, totally agree!	2018-02-14	0
28	10	30	1	0	\N	Its true!	2018-02-14	0
29	10	1	1	0	\N	No you aint...	2018-02-14	0
30	10	1	1	0	28	No!	2018-02-14	0
31	10	1	1	0	28	Get out.	2018-02-14	0
32	11	31	1	0	\N	Your reply	2018-02-20	0
33	2	1	1	0	\N	Test reply (should be on top)	2018-02-21	0
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: bruigbiqkmqflz
--

COPY "user" (id, username, password, is_mod, date_registered) FROM stdin;
1	the_opinion	cheesey	t	2018-02-08
2	hard-head	choice	f	2018-02-08
3	listener	hardtop	f	2018-02-08
4	bacon_on_pizza	nopine	f	2018-02-08
6	yell_sub	hahaha	f	2018-02-13
11	a	isforfriends	f	2018-02-13
12	Michelangelo	isdabest	f	2018-02-13
13	hahaha	nononon	f	2018-02-13
14	Nathan	wins	f	2018-02-13
15	no	yes	f	2018-02-13
16	test	this is	f	2018-02-13
17	why	u no work	f	2018-02-13
18	nononona	asd	f	2018-02-13
19	hope	is_peace	f	2018-02-14
20	hooop	is_nive	f	2018-02-14
21	harhar	keee	f	2018-02-14
22	teehee	nooooo	f	2018-02-14
23	please_work		f	2018-02-14
24	:(		f	2018-02-14
25	agsdfads	as	f	2018-02-14
26	test_usr	plzwrk	f	2018-02-14
27	Lambinater	teehehe	f	2018-02-14
28	userrr	kekeke	f	2018-02-14
29	Baconator	nope	f	2018-02-14
30	Sam	yellow	f	2018-02-14
31	ta_test	password	f	2018-02-20
32	lamb	test	f	2018-02-20
\.


--
-- Name: opinion_post_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bruigbiqkmqflz
--

SELECT pg_catalog.setval('opinion_post_id_seq', 14, true);


--
-- Name: post_comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bruigbiqkmqflz
--

SELECT pg_catalog.setval('post_comment_id_seq', 34, true);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bruigbiqkmqflz
--

SELECT pg_catalog.setval('user_id_seq', 32, true);


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
    ADD CONSTRAINT post_comment_reply_to_post_id_fkey FOREIGN KEY (reply_to_comment_id) REFERENCES post_comment(id);


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

