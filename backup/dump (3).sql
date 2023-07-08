--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- Data for Name: all_requests; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY all_requests (id, request_id, request_no, request_for, request_by, request_type, req_date, status, created_by, created_at, updated_at) FROM stdin;
1	1	1	FIKRI KURNIAWAN	company	Cash Advance	2023-01-20	\N	2	2023-01-20 18:47:44	2023-01-20 18:47:44
2	1	2	FIKRI KURNIAWAN	company	Overtime	2023-01-20	Approved	2	2023-01-20 18:51:11	2023-01-20 18:51:11
\.


--
-- Name: all_requests_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('all_requests_id_seq', 2, true);


--
-- Data for Name: allowance_finances; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY allowance_finances (id, employee_id, allowance_type_id, amount, created_by, created_at, updated_at) FROM stdin;
1	2	2	500000	2	2023-01-20 18:48:42	2023-01-20 18:48:42
2	2	3	250000	2	2023-01-20 18:48:56	2023-01-20 18:48:56
\.


--
-- Name: allowance_finances_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('allowance_finances_id_seq', 2, true);


--
-- Data for Name: allowance_options; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY allowance_options (id, name, created_by, created_at, updated_at) FROM stdin;
1	Uang Makan	2	2023-01-20 18:41:33	2023-01-20 18:41:33
2	Bonus	2	2023-01-20 18:41:39	2023-01-20 18:41:39
3	Tunjangan Kesehatan	2	2023-01-20 18:41:47	2023-01-20 18:41:47
\.


--
-- Name: allowance_options_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('allowance_options_id_seq', 3, true);


--
-- Data for Name: allowances; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY allowances (id, employee_id, allowance_option, title, amount, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: allowances_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('allowances_id_seq', 1, false);


--
-- Data for Name: attendance_employees; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY attendance_employees (id, employee_id, date, status, denda, clock_in, clock_out, late, early_leaving, overtime, total_rest, created_by, created_at, updated_at) FROM stdin;
1	2	2023-01-02	Present	\N	07:35:00	16:11:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
2	2	2023-01-03	Present	\N	07:30:00	21:01:00	00:00:00	00:00:00	05:01:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
3	2	2023-01-04	Present	\N	07:28:00	16:01:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
4	2	2023-01-05	Present	\N	07:31:00	16:08:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
5	2	2023-01-06	Present	\N	07:30:00	16:32:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
6	2	2023-01-07	Present	\N	07:30:00	17:06:00	00:00:00	00:00:00	01:06:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
7	2	2023-01-09	Present	\N	07:32:00	16:02:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
8	2	2023-01-10	Present	\N	07:35:00	21:01:00	00:00:00	00:00:00	05:01:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
9	2	2023-01-11	Present	\N	07:30:00	21:00:00	00:00:00	00:00:00	05:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
10	2	2023-01-12	Present	\N	07:35:00	21:00:00	00:00:00	00:00:00	05:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
11	2	2023-01-13	Present	\N	07:37:00	16:33:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
12	2	2023-01-14	Present	\N	07:33:00	13:14:00	00:00:00	02:46:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
13	2	2023-01-16	Present	\N	07:42:00	00:00:00	00:00:00	01:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
14	3	2023-01-02	Present	\N	07:47:00	16:04:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
15	3	2023-01-03	Present	\N	07:37:00	16:06:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
16	3	2023-01-04	Present	\N	07:38:00	16:05:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
17	3	2023-01-06	Present	\N	07:32:00	16:32:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
18	3	2023-01-07	Present	\N	07:33:00	13:05:00	00:00:00	02:55:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
19	3	2023-01-09	Present	\N	07:43:00	16:05:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
20	3	2023-01-10	Present	\N	07:37:00	16:06:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
21	3	2023-01-11	Present	\N	07:37:00	16:04:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
22	3	2023-01-12	Present	\N	07:46:00	16:03:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
23	3	2023-01-13	Present	\N	07:34:00	16:36:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
24	3	2023-01-14	Present	\N	08:19:00	13:04:00	00:19:00	02:56:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
25	3	2023-01-16	Present	\N	07:39:00	00:00:00	00:00:00	01:00:00	00:00:00	00:00:00	2	2023-01-19 10:50:23	2023-01-19 10:50:23
26	4	2023-01-02	Present	\N	08:04:00	16:06:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
27	4	2023-01-03	Present	\N	07:41:00	16:05:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
28	4	2023-01-04	Present	\N	07:41:00	16:05:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
29	4	2023-01-05	Present	\N	07:38:00	16:06:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
30	4	2023-01-06	Present	\N	07:34:00	16:34:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
31	4	2023-01-07	Present	\N	07:42:00	13:05:00	00:00:00	02:55:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
32	4	2023-01-09	Present	\N	07:39:00	16:05:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
33	4	2023-01-10	Present	\N	07:40:00	16:07:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
34	4	2023-01-11	Present	\N	07:38:00	16:04:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
35	4	2023-01-12	Present	\N	07:42:00	16:02:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
36	4	2023-01-13	Present	\N	07:41:00	21:03:00	00:00:00	00:00:00	05:03:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
37	4	2023-01-14	Present	\N	07:43:00	13:02:00	00:00:00	02:58:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
38	4	2023-01-16	Present	\N	07:32:00	00:00:00	00:00:00	01:00:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
39	5	2023-01-02	Present	\N	07:29:00	16:11:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
40	5	2023-01-03	Present	\N	07:20:00	16:08:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
41	5	2023-01-04	Present	\N	07:09:00	16:05:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
42	5	2023-01-05	Present	\N	07:17:00	16:07:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
43	5	2023-01-06	Present	\N	07:28:00	21:04:00	00:00:00	00:00:00	05:04:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
44	5	2023-01-07	Present	\N	07:07:00	17:06:00	00:00:00	00:00:00	01:06:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
45	5	2023-01-09	Present	\N	07:17:00	21:03:00	00:00:00	00:00:00	05:03:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
46	5	2023-01-10	Present	\N	07:17:00	21:01:00	00:00:00	00:00:00	05:01:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
47	5	2023-01-11	Present	\N	07:16:00	21:04:00	00:00:00	00:00:00	05:04:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
48	5	2023-01-12	Present	\N	07:28:00	21:05:00	00:00:00	00:00:00	05:05:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
49	5	2023-01-13	Present	\N	07:18:00	21:05:00	00:00:00	00:00:00	05:05:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
50	5	2023-01-14	Present	\N	07:02:00	17:04:00	00:00:00	00:00:00	01:04:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
51	5	2023-01-16	Present	\N	07:25:00	00:00:00	00:00:00	01:00:00	00:00:00	00:00:00	2	2023-01-19 12:44:00	2023-01-19 12:44:00
52	6	2023-01-02	Present	\N	08:05:00	16:12:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
53	6	2023-01-03	Present	\N	07:48:00	16:04:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
54	6	2023-01-04	Present	\N	07:57:00	16:04:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
55	6	2023-01-05	Present	\N	07:56:00	16:03:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
56	6	2023-01-06	Present	\N	07:47:00	21:02:00	00:00:00	00:00:00	05:02:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
57	6	2023-01-07	Present	\N	07:54:00	13:04:00	00:00:00	02:56:00	00:00:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
58	6	2023-01-09	Present	\N	07:54:00	21:02:00	00:00:00	00:00:00	05:02:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
59	6	2023-01-10	Present	\N	07:56:00	21:03:00	00:00:00	00:00:00	05:03:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
60	6	2023-01-11	Present	\N	07:59:00	21:02:00	00:00:00	00:00:00	05:02:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
61	6	2023-01-12	Present	\N	07:53:00	21:02:00	00:00:00	00:00:00	05:02:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
62	6	2023-01-13	Present	\N	07:53:00	21:02:00	00:00:00	00:00:00	05:02:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
63	6	2023-01-14	Present	\N	07:55:00	17:02:00	00:00:00	00:00:00	01:02:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
64	7	2023-01-02	Present	\N	00:00:00	16:08:00	01:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
65	7	2023-01-03	Present	\N	07:45:00	16:04:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
66	7	2023-01-04	Present	\N	07:43:00	16:01:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
67	7	2023-01-05	Present	\N	07:44:00	16:04:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
68	7	2023-01-06	Present	\N	07:48:00	16:32:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
69	7	2023-01-07	Present	\N	07:40:00	13:05:00	00:00:00	02:55:00	00:00:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
70	7	2023-01-09	Present	\N	07:40:00	16:04:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
71	7	2023-01-10	Present	\N	07:33:00	21:02:00	00:00:00	00:00:00	05:02:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
72	7	2023-01-11	Present	\N	07:48:00	21:01:00	00:00:00	00:00:00	05:01:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
73	7	2023-01-12	Present	\N	07:36:00	16:03:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
74	7	2023-01-13	Present	\N	07:46:00	21:01:00	00:00:00	00:00:00	05:01:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
75	7	2023-01-14	Present	\N	07:40:00	13:03:00	00:00:00	02:57:00	00:00:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
76	7	2023-01-16	Present	\N	07:44:00	00:00:00	00:00:00	01:00:00	00:00:00	00:00:00	2	2023-01-19 13:55:22	2023-01-19 13:55:22
\.


--
-- Name: attendance_employees_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('attendance_employees_id_seq', 76, true);


--
-- Data for Name: branches; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY branches (id, name, created_by, created_at, updated_at) FROM stdin;
1	PT. AR PACKAGING	2	\N	\N
2	PT. KARYA INDAH MULTI GUNA	2	\N	\N
\.


--
-- Name: branches_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('branches_id_seq', 2, true);


--
-- Data for Name: break_times; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY break_times (id, shift_type_id, start_time, end_time, created_by, created_at, updated_at) FROM stdin;
1	2	10:00:00	10:30:00	2	2023-01-20 18:41:15	2023-01-20 18:41:15
\.


--
-- Name: break_times_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('break_times_id_seq', 1, true);


--
-- Data for Name: cashes; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY cashes (id, employee_id, loan_type_id, amount, created_by, created_at, updated_at) FROM stdin;
1	2	1	300000	2	2023-01-20 18:47:44	2023-01-20 18:47:44
\.


--
-- Name: cashes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('cashes_id_seq', 1, true);


--
-- Data for Name: company_holidays; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY company_holidays (id, company_holiday_date, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: company_holidays_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('company_holidays_id_seq', 1, false);


--
-- Data for Name: day_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY day_types (id, name, created_by, created_at, updated_at) FROM stdin;
1	work	2	2023-01-19 10:48:03	2023-01-19 10:48:03
\.


--
-- Name: day_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('day_types_id_seq', 1, true);


--
-- Data for Name: dayoffs; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY dayoffs (id, day, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: dayoffs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('dayoffs_id_seq', 1, false);


--
-- Data for Name: dendas; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY dendas (id, day_type_id, "time", amount, created_by, created_at, updated_at) FROM stdin;
1	1	01:00:00	10000.00	2	2023-01-20 18:45:18	2023-01-20 18:45:18
2	1	02:00:00	20000.00	2	2023-01-20 18:45:18	2023-01-20 18:45:18
\.


--
-- Name: dendas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('dendas_id_seq', 2, true);


--
-- Data for Name: documents; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY documents (id, name, is_required, created_by, created_at, updated_at) FROM stdin;
1	CV	0	2	\N	\N
2	Photo Profile	0	2	\N	\N
\.


--
-- Name: documents_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('documents_id_seq', 2, true);


--
-- Data for Name: employee_documents; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY employee_documents (id, employee_id, document_id, document_value, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: employee_documents_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employee_documents_id_seq', 1, false);


--
-- Data for Name: employee_education; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY employee_education (id, employee_id, start_date, end_date, type, level, institution, address, major, gpa, notes, created_at, updated_at) FROM stdin;
1	1	2014-01-01	2017-03-01	Formal	SMP	SMP DU 2	Peterongan, Jombang	MIPA	\N	\N	\N	\N
2	1	2017-01-01	2020-03-01	Formal	SMA	SMA DU 3	Peterongan, Jombang	MIPA	\N	\N	\N	\N
\.


--
-- Name: employee_education_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employee_education_id_seq', 2, true);


--
-- Data for Name: employee_experiences; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY employee_experiences (id, employee_id, start_date, end_date, sequence, job, "position", address, city, reason_leaving, note, created_at, updated_at) FROM stdin;
1	1	2022-01-01	2022-03-01	1	Programmer	Programmer	Peterongan	Jombang	Boring	\N	2023-01-19 10:48:03	2023-01-19 10:48:03
\.


--
-- Name: employee_experiences_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employee_experiences_id_seq', 1, true);


--
-- Data for Name: employee_medicals; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY employee_medicals (id, employee_id, height, weight, blood_type, medical_test, created_at, updated_at) FROM stdin;
\.


--
-- Name: employee_medicals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employee_medicals_id_seq', 1, false);


--
-- Data for Name: employees; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY employees (id, user_id, name, dob, gender, phone, address, email, password, employee_id, branch_id, department_id, designation_id, company_doj, company_doe, documents, account_holder_name, account_number, bank_name, bank_identifier_code, branch_location, tax_payer_id, salary_type, salary, net_salary, is_active, created_by, created_at, updated_at) FROM stdin;
1	3	accountant	2001-05-01	Male	08119725162	Jl. semampir no.2, Malaysia	accountant@example.com	$2y$10$FdXc1CXWfrfAFUkU2ZHV.uEiVjBUO.AQchviNLaIAysnjq.Sq3MFO	1	1	0	0	2022-12-01	2023-12-01	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1	2	2023-01-19 10:48:03	2023-01-19 10:48:03
3	5	RAGIL WALUYO	\N	\N	\N	\N	adadd@kas.clom	$2y$10$I4prjEb7wdxBmrjsuaqneOV/aVU6L96FaqIUvg.omroqMC85fxRDK	3	1	0	0	2023-01-19	2024-01-19	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1	2	2023-01-19 10:49:47	2023-01-19 10:49:47
4	6	TOPIK HIDAYAT	\N	\N	\N	\N	topik@pehadir.com	$2y$10$MxhUNMf7g/fJENKM2oaUKO8fl60MYUahiqUylFYgvyt4O3dcHh9fG	4	2	0	0	2023-01-19	2024-01-19	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1	2	2023-01-19 12:25:59	2023-01-19 12:25:59
5	7	ACIM SULAEMAN	\N	\N	\N	\N	acim@pehadir.com	$2y$10$4YHtGpRbQzBtXyw/AX/b0ObBcEkzrcfVWNZ/p2vwD1O9iNFFpTI4O	5	2	0	0	2023-01-19	2024-01-19	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1	2	2023-01-19 12:26:43	2023-01-19 12:26:43
6	8	MUHAMAD ENJEN	\N	\N	\N	\N	enjen@pehadir.com	$2y$10$GDTIWcd6mYYbL6lSgWW9seL3pP7K78qgBaXWRGswIQYGdceck9AgW	6	2	0	0	2023-01-19	2024-01-19	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1	2	2023-01-19 13:54:15	2023-01-19 13:54:15
7	9	IRMAN	\N	\N	\N	\N	irman@pehadir.com	$2y$10$wYSNsqzQaWeim9LOqOGBweBivhGwWQf4aIbiSxFc7i.A1R86QJVSW	7	2	0	0	2023-01-19	2024-01-19	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1	2	2023-01-19 13:54:47	2023-01-19 13:54:47
8	10	DEPRI	\N	\N	\N	\N	depri@pehadir.com	$2y$10$T92FUkRf0fKF8dJRt.UrseXq3rnLz0pF3NP7o1Bja.GNQIA5OdqT.	8	1	0	0	2023-01-19	2024-01-19	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1	2	2023-01-19 13:56:21	2023-01-19 13:56:21
9	11	FATONI	\N	\N	\N	\N	fatoni@pehadir.com	$2y$10$twTyAsifwDOk2PqgLyKXNOq6kPr/QRBmyNjya6lQCSKjmznnLxS.i	9	2	0	0	2023-01-19	2024-01-19	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2	4	FIKRI KURNIAWAN	\N	\N	\N	\N	acc@gmail.com	$2y$10$rvYEGJlWxbc6FTlpTCSQhuBVccMZPRDrVwiIPt7PI/kum2DJjVfSK	2	1	0	0	2023-01-19	2024-01-19	\N	\N	\N	\N	\N	\N	\N	Gaji Pokok (Monthly)	5000000	4800000	1	2	2023-01-19 10:49:07	2023-01-20 18:49:14
\.


--
-- Name: employees_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employees_id_seq', 9, true);


--
-- Data for Name: employements; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY employements (id, employee_id, movement_type, area, office, job_level, "position", type, note, created_at, updated_at) FROM stdin;
1	1	Hiring	Tangerang	Tangerang	Accountant	Accountant	KONTRAK	\N	2023-01-19 10:48:03	2023-01-19 10:48:03
\.


--
-- Name: employements_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employements_id_seq', 1, true);


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('failed_jobs_id_seq', 1, false);


--
-- Data for Name: families; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY families (id, employee_id, name, gender, relationship, notes, created_at, updated_at) FROM stdin;
\.


--
-- Name: families_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('families_id_seq', 1, false);


--
-- Data for Name: leave_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY leave_types (id, title, days, created_by, created_at, updated_at) FROM stdin;
1	Sick	3	2	2023-01-19 10:48:03	2023-01-19 10:48:03
\.


--
-- Name: leave_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('leave_types_id_seq', 1, true);


--
-- Data for Name: leaves; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY leaves (id, employee_id, leave_type_id, applied_on, start_date, end_date, total_leave_days, leave_reason, attachment_request_path, remark, status, rejected_reason, attachment_reject, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: leaves_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('leaves_id_seq', 1, false);


--
-- Data for Name: loan_options; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY loan_options (id, name, created_by, created_at, updated_at) FROM stdin;
1	Kredit Motor	2	2023-01-20 18:43:58	2023-01-20 18:43:58
2	Kredit HP	2	2023-01-20 18:48:09	2023-01-20 18:48:09
\.


--
-- Name: loan_options_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('loan_options_id_seq', 2, true);


--
-- Data for Name: loans; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY loans (id, employee_id, loan_type_id, amount, created_by, created_at, updated_at) FROM stdin;
1	2	2	500000	2	2023-01-20 18:48:25	2023-01-20 18:48:25
\.


--
-- Name: loans_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('loans_id_seq', 1, true);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2014_10_12_100000_create_password_resets_table	1
3	2019_08_19_000000_create_failed_jobs_table	1
4	2019_12_14_000001_create_personal_access_tokens_table	1
5	2022_10_21_154523_create_employees_table	1
6	2022_10_21_154801_create_permission_tables	1
7	2022_10_21_160624_add_created_by_to_roles	1
8	2022_10_25_115631_create_branches_table	1
9	2022_10_26_035449_create_settings_table	1
10	2022_10_27_232752_create_employements_table	1
11	2022_10_27_234552_create_employee_education_table	1
12	2022_10_27_234948_create_employee_experiences_table	1
13	2022_10_27_235837_create_documents_table	1
14	2022_10_27_235920_create_employee_documents_table	1
15	2022_10_28_061429_create_payslip_types_table	1
16	2022_11_01_035631_create_leave_types_table	1
17	2022_11_01_074240_create_allowances_table	1
18	2022_11_01_074859_create_reimburstment_options_table	1
19	2022_11_01_105339_create_loan_options_table	1
20	2022_11_04_101940_create_performance_reviews_table	1
21	2022_11_09_153815_create_leaves_table	1
22	2022_11_10_020918_create_overtimes_table	1
23	2022_11_10_021418_create_overtime_types_table	1
24	2022_11_10_021733_create_day_types_table	1
25	2022_11_18_034714_create_shift_types_table	1
26	2022_11_18_174853_create_break_times_table	1
27	2022_11_19_084204_create_req_shift_schedules_table	1
28	2022_11_19_091340_create_shift_schedules_table	1
29	2022_11_24_103223_create_attendance_employees_table	1
30	2022_12_02_004120_create_families_table	1
31	2022_12_02_090204_create_employee_medicals_table	1
32	2022_12_09_210608_create_travel_table	1
33	2022_12_10_172650_create_timesheets_table	1
34	2022_12_14_164046_create_all_requests_table	1
35	2022_12_20_092810_create_payrolls_table	1
36	2022_12_20_092950_create_reimbursts_table	1
37	2022_12_20_093046_create_cashes_table	1
38	2022_12_20_121838_create_allowance_finances_table	1
39	2022_12_25_203619_create_dendas_table	1
40	2022_12_31_075105_create_pay_slips_table	1
41	2022_12_31_175836_create_allowance_options_table	1
42	2023_01_12_063005_create_loans_table	1
43	2023_01_12_113651_create_set_bpjstk_table	1
44	2023_01_15_111356_create_dayoffs_table	1
45	2023_01_15_161856_create_company_holidays_table	1
\.


--
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY permissions (id, name, guard_name, created_at, updated_at) FROM stdin;
1	show hrm dashboard	web	2023-01-19 10:48:02	2023-01-19 10:48:02
2	copy invoice	web	2023-01-19 10:48:02	2023-01-19 10:48:02
3	show project dashboard	web	2023-01-19 10:48:02	2023-01-19 10:48:02
4	show account dashboard	web	2023-01-19 10:48:02	2023-01-19 10:48:02
5	manage user	web	2023-01-19 10:48:02	2023-01-19 10:48:02
6	create user	web	2023-01-19 10:48:02	2023-01-19 10:48:02
7	edit user	web	2023-01-19 10:48:02	2023-01-19 10:48:02
8	delete user	web	2023-01-19 10:48:02	2023-01-19 10:48:02
9	create language	web	2023-01-19 10:48:02	2023-01-19 10:48:02
10	manage role	web	2023-01-19 10:48:02	2023-01-19 10:48:02
11	create role	web	2023-01-19 10:48:02	2023-01-19 10:48:02
12	edit role	web	2023-01-19 10:48:02	2023-01-19 10:48:02
13	delete role	web	2023-01-19 10:48:02	2023-01-19 10:48:02
14	manage permission	web	2023-01-19 10:48:02	2023-01-19 10:48:02
15	create permission	web	2023-01-19 10:48:02	2023-01-19 10:48:02
16	edit permission	web	2023-01-19 10:48:02	2023-01-19 10:48:02
17	delete permission	web	2023-01-19 10:48:02	2023-01-19 10:48:02
18	manage company settings	web	2023-01-19 10:48:02	2023-01-19 10:48:02
19	manage print settings	web	2023-01-19 10:48:02	2023-01-19 10:48:02
20	manage business settings	web	2023-01-19 10:48:02	2023-01-19 10:48:02
21	manage stripe settings	web	2023-01-19 10:48:02	2023-01-19 10:48:02
22	manage expense	web	2023-01-19 10:48:02	2023-01-19 10:48:02
23	create expense	web	2023-01-19 10:48:02	2023-01-19 10:48:02
24	edit expense	web	2023-01-19 10:48:02	2023-01-19 10:48:02
25	delete expense	web	2023-01-19 10:48:02	2023-01-19 10:48:02
26	manage invoice	web	2023-01-19 10:48:02	2023-01-19 10:48:02
27	create invoice	web	2023-01-19 10:48:02	2023-01-19 10:48:02
28	edit invoice	web	2023-01-19 10:48:02	2023-01-19 10:48:02
29	delete invoice	web	2023-01-19 10:48:02	2023-01-19 10:48:02
30	show invoice	web	2023-01-19 10:48:02	2023-01-19 10:48:02
31	create payment invoice	web	2023-01-19 10:48:02	2023-01-19 10:48:02
32	delete payment invoice	web	2023-01-19 10:48:02	2023-01-19 10:48:02
33	send invoice	web	2023-01-19 10:48:02	2023-01-19 10:48:02
34	delete invoice product	web	2023-01-19 10:48:02	2023-01-19 10:48:02
35	convert invoice	web	2023-01-19 10:48:02	2023-01-19 10:48:02
36	manage constant unit	web	2023-01-19 10:48:02	2023-01-19 10:48:02
37	create constant unit	web	2023-01-19 10:48:02	2023-01-19 10:48:02
38	edit constant unit	web	2023-01-19 10:48:02	2023-01-19 10:48:02
39	delete constant unit	web	2023-01-19 10:48:02	2023-01-19 10:48:02
40	manage constant tax	web	2023-01-19 10:48:02	2023-01-19 10:48:02
41	create constant tax	web	2023-01-19 10:48:02	2023-01-19 10:48:02
42	edit constant tax	web	2023-01-19 10:48:02	2023-01-19 10:48:02
43	delete constant tax	web	2023-01-19 10:48:02	2023-01-19 10:48:02
44	manage constant category	web	2023-01-19 10:48:02	2023-01-19 10:48:02
45	create constant category	web	2023-01-19 10:48:02	2023-01-19 10:48:02
46	edit constant category	web	2023-01-19 10:48:02	2023-01-19 10:48:02
47	delete constant category	web	2023-01-19 10:48:02	2023-01-19 10:48:02
48	manage product & service	web	2023-01-19 10:48:02	2023-01-19 10:48:02
49	create product & service	web	2023-01-19 10:48:02	2023-01-19 10:48:02
50	edit product & service	web	2023-01-19 10:48:02	2023-01-19 10:48:02
51	delete product & service	web	2023-01-19 10:48:02	2023-01-19 10:48:02
52	manage customer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
53	create customer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
54	edit customer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
55	delete customer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
56	show customer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
57	manage vender	web	2023-01-19 10:48:02	2023-01-19 10:48:02
58	create vender	web	2023-01-19 10:48:02	2023-01-19 10:48:02
59	edit vender	web	2023-01-19 10:48:02	2023-01-19 10:48:02
60	delete vender	web	2023-01-19 10:48:02	2023-01-19 10:48:02
61	show vender	web	2023-01-19 10:48:02	2023-01-19 10:48:02
62	manage bank account	web	2023-01-19 10:48:02	2023-01-19 10:48:02
63	create bank account	web	2023-01-19 10:48:02	2023-01-19 10:48:02
64	edit bank account	web	2023-01-19 10:48:02	2023-01-19 10:48:02
65	delete bank account	web	2023-01-19 10:48:02	2023-01-19 10:48:02
66	manage bank transfer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
67	create bank transfer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
68	edit bank transfer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
69	delete bank transfer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
70	manage transaction	web	2023-01-19 10:48:02	2023-01-19 10:48:02
71	manage revenue	web	2023-01-19 10:48:02	2023-01-19 10:48:02
72	create revenue	web	2023-01-19 10:48:02	2023-01-19 10:48:02
73	edit revenue	web	2023-01-19 10:48:02	2023-01-19 10:48:02
74	delete revenue	web	2023-01-19 10:48:02	2023-01-19 10:48:02
75	manage bill	web	2023-01-19 10:48:02	2023-01-19 10:48:02
76	create bill	web	2023-01-19 10:48:02	2023-01-19 10:48:02
77	edit bill	web	2023-01-19 10:48:02	2023-01-19 10:48:02
78	delete bill	web	2023-01-19 10:48:02	2023-01-19 10:48:02
79	show bill	web	2023-01-19 10:48:02	2023-01-19 10:48:02
80	manage payment	web	2023-01-19 10:48:02	2023-01-19 10:48:02
81	create payment	web	2023-01-19 10:48:02	2023-01-19 10:48:02
82	edit payment	web	2023-01-19 10:48:02	2023-01-19 10:48:02
83	delete payment	web	2023-01-19 10:48:02	2023-01-19 10:48:02
84	delete bill product	web	2023-01-19 10:48:02	2023-01-19 10:48:02
85	send bill	web	2023-01-19 10:48:02	2023-01-19 10:48:02
86	create payment bill	web	2023-01-19 10:48:02	2023-01-19 10:48:02
87	delete payment bill	web	2023-01-19 10:48:02	2023-01-19 10:48:02
88	manage order	web	2023-01-19 10:48:02	2023-01-19 10:48:02
89	income report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
90	expense report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
91	income vs expense report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
92	invoice report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
93	bill report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
94	stock report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
95	tax report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
96	loss & profit report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
97	manage customer payment	web	2023-01-19 10:48:02	2023-01-19 10:48:02
98	manage customer transaction	web	2023-01-19 10:48:02	2023-01-19 10:48:02
99	manage customer invoice	web	2023-01-19 10:48:02	2023-01-19 10:48:02
100	vender manage bill	web	2023-01-19 10:48:02	2023-01-19 10:48:02
101	manage vender bill	web	2023-01-19 10:48:02	2023-01-19 10:48:02
102	manage vender payment	web	2023-01-19 10:48:02	2023-01-19 10:48:02
103	manage vender transaction	web	2023-01-19 10:48:02	2023-01-19 10:48:02
104	manage credit note	web	2023-01-19 10:48:02	2023-01-19 10:48:02
105	create credit note	web	2023-01-19 10:48:02	2023-01-19 10:48:02
106	edit credit note	web	2023-01-19 10:48:02	2023-01-19 10:48:02
107	delete credit note	web	2023-01-19 10:48:02	2023-01-19 10:48:02
108	manage debit note	web	2023-01-19 10:48:02	2023-01-19 10:48:02
109	create debit note	web	2023-01-19 10:48:02	2023-01-19 10:48:02
110	edit debit note	web	2023-01-19 10:48:02	2023-01-19 10:48:02
111	delete debit note	web	2023-01-19 10:48:02	2023-01-19 10:48:02
112	duplicate invoice	web	2023-01-19 10:48:02	2023-01-19 10:48:02
113	duplicate bill	web	2023-01-19 10:48:02	2023-01-19 10:48:02
114	manage proposal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
115	create proposal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
116	edit proposal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
117	delete proposal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
118	duplicate proposal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
119	show proposal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
120	send proposal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
121	delete proposal product	web	2023-01-19 10:48:02	2023-01-19 10:48:02
122	manage customer proposal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
123	manage goal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
124	create goal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
125	edit goal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
126	delete goal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
127	manage assets	web	2023-01-19 10:48:02	2023-01-19 10:48:02
128	create assets	web	2023-01-19 10:48:02	2023-01-19 10:48:02
129	edit assets	web	2023-01-19 10:48:02	2023-01-19 10:48:02
130	delete assets	web	2023-01-19 10:48:02	2023-01-19 10:48:02
131	statement report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
132	manage constant custom field	web	2023-01-19 10:48:02	2023-01-19 10:48:02
133	create constant custom field	web	2023-01-19 10:48:02	2023-01-19 10:48:02
134	edit constant custom field	web	2023-01-19 10:48:02	2023-01-19 10:48:02
135	delete constant custom field	web	2023-01-19 10:48:02	2023-01-19 10:48:02
136	manage chart of account	web	2023-01-19 10:48:02	2023-01-19 10:48:02
137	create chart of account	web	2023-01-19 10:48:02	2023-01-19 10:48:02
138	edit chart of account	web	2023-01-19 10:48:02	2023-01-19 10:48:02
139	delete chart of account	web	2023-01-19 10:48:02	2023-01-19 10:48:02
140	manage journal entry	web	2023-01-19 10:48:02	2023-01-19 10:48:02
141	create journal entry	web	2023-01-19 10:48:02	2023-01-19 10:48:02
142	edit journal entry	web	2023-01-19 10:48:02	2023-01-19 10:48:02
143	delete journal entry	web	2023-01-19 10:48:02	2023-01-19 10:48:02
144	show journal entry	web	2023-01-19 10:48:02	2023-01-19 10:48:02
145	balance sheet report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
146	ledger report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
147	trial balance report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
148	manage client	web	2023-01-19 10:48:02	2023-01-19 10:48:02
149	create client	web	2023-01-19 10:48:02	2023-01-19 10:48:02
150	edit client	web	2023-01-19 10:48:02	2023-01-19 10:48:02
151	delete client	web	2023-01-19 10:48:02	2023-01-19 10:48:02
152	manage lead	web	2023-01-19 10:48:02	2023-01-19 10:48:02
153	create lead	web	2023-01-19 10:48:02	2023-01-19 10:48:02
154	view lead	web	2023-01-19 10:48:02	2023-01-19 10:48:02
155	edit lead	web	2023-01-19 10:48:02	2023-01-19 10:48:02
156	delete lead	web	2023-01-19 10:48:02	2023-01-19 10:48:02
157	move lead	web	2023-01-19 10:48:02	2023-01-19 10:48:02
158	create lead call	web	2023-01-19 10:48:02	2023-01-19 10:48:02
159	edit lead call	web	2023-01-19 10:48:02	2023-01-19 10:48:02
160	delete lead call	web	2023-01-19 10:48:02	2023-01-19 10:48:02
161	create lead email	web	2023-01-19 10:48:02	2023-01-19 10:48:02
162	manage pipeline	web	2023-01-19 10:48:02	2023-01-19 10:48:02
163	create pipeline	web	2023-01-19 10:48:02	2023-01-19 10:48:02
164	edit pipeline	web	2023-01-19 10:48:02	2023-01-19 10:48:02
165	delete pipeline	web	2023-01-19 10:48:02	2023-01-19 10:48:02
166	manage lead stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
167	create lead stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
168	edit lead stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
169	delete lead stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
170	convert lead to deal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
171	manage source	web	2023-01-19 10:48:02	2023-01-19 10:48:02
172	create source	web	2023-01-19 10:48:02	2023-01-19 10:48:02
173	edit source	web	2023-01-19 10:48:02	2023-01-19 10:48:02
174	delete source	web	2023-01-19 10:48:02	2023-01-19 10:48:02
175	manage label	web	2023-01-19 10:48:02	2023-01-19 10:48:02
176	create label	web	2023-01-19 10:48:02	2023-01-19 10:48:02
177	edit label	web	2023-01-19 10:48:02	2023-01-19 10:48:02
178	delete label	web	2023-01-19 10:48:02	2023-01-19 10:48:02
179	manage deal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
180	create deal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
181	view task	web	2023-01-19 10:48:02	2023-01-19 10:48:02
182	create task	web	2023-01-19 10:48:02	2023-01-19 10:48:02
183	edit task	web	2023-01-19 10:48:02	2023-01-19 10:48:02
184	delete task	web	2023-01-19 10:48:02	2023-01-19 10:48:02
185	edit deal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
186	view deal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
187	delete deal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
188	move deal	web	2023-01-19 10:48:02	2023-01-19 10:48:02
189	create deal call	web	2023-01-19 10:48:02	2023-01-19 10:48:02
190	edit deal call	web	2023-01-19 10:48:02	2023-01-19 10:48:02
191	delete deal call	web	2023-01-19 10:48:02	2023-01-19 10:48:02
192	create deal email	web	2023-01-19 10:48:02	2023-01-19 10:48:02
193	manage stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
194	create stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
195	edit stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
196	delete stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
197	manage employee	web	2023-01-19 10:48:02	2023-01-19 10:48:02
198	create employee	web	2023-01-19 10:48:02	2023-01-19 10:48:02
199	view employee	web	2023-01-19 10:48:02	2023-01-19 10:48:02
200	edit employee	web	2023-01-19 10:48:02	2023-01-19 10:48:02
201	delete employee	web	2023-01-19 10:48:02	2023-01-19 10:48:02
202	manage employee profile	web	2023-01-19 10:48:02	2023-01-19 10:48:02
203	show employee profile	web	2023-01-19 10:48:02	2023-01-19 10:48:02
204	manage department	web	2023-01-19 10:48:02	2023-01-19 10:48:02
205	create department	web	2023-01-19 10:48:02	2023-01-19 10:48:02
206	view department	web	2023-01-19 10:48:02	2023-01-19 10:48:02
207	edit department	web	2023-01-19 10:48:02	2023-01-19 10:48:02
208	delete department	web	2023-01-19 10:48:02	2023-01-19 10:48:02
209	manage designation	web	2023-01-19 10:48:02	2023-01-19 10:48:02
210	create designation	web	2023-01-19 10:48:02	2023-01-19 10:48:02
211	view designation	web	2023-01-19 10:48:02	2023-01-19 10:48:02
212	edit designation	web	2023-01-19 10:48:02	2023-01-19 10:48:02
213	delete designation	web	2023-01-19 10:48:02	2023-01-19 10:48:02
214	manage branch	web	2023-01-19 10:48:02	2023-01-19 10:48:02
215	create branch	web	2023-01-19 10:48:02	2023-01-19 10:48:02
216	edit branch	web	2023-01-19 10:48:02	2023-01-19 10:48:02
217	delete branch	web	2023-01-19 10:48:02	2023-01-19 10:48:02
218	manage document type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
219	create document type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
220	edit document type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
221	delete document type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
222	manage document	web	2023-01-19 10:48:02	2023-01-19 10:48:02
223	create document	web	2023-01-19 10:48:02	2023-01-19 10:48:02
224	edit document	web	2023-01-19 10:48:02	2023-01-19 10:48:02
225	delete document	web	2023-01-19 10:48:02	2023-01-19 10:48:02
226	manage payslip type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
227	create payslip type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
228	edit payslip type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
229	delete payslip type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
230	manage payslip	web	2023-01-19 10:48:02	2023-01-19 10:48:02
231	generate payslip	web	2023-01-19 10:48:02	2023-01-19 10:48:02
232	create reimbursement	web	2023-01-19 10:48:02	2023-01-19 10:48:02
233	edit reimbursement	web	2023-01-19 10:48:02	2023-01-19 10:48:02
234	delete reimbursement	web	2023-01-19 10:48:02	2023-01-19 10:48:02
235	create commission	web	2023-01-19 10:48:02	2023-01-19 10:48:02
236	edit commission	web	2023-01-19 10:48:02	2023-01-19 10:48:02
237	delete commission	web	2023-01-19 10:48:02	2023-01-19 10:48:02
238	manage reimbursement option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
239	create reimbursement option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
240	edit reimbursement option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
241	delete reimbursement option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
242	manage loan option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
243	create loan option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
244	edit loan option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
245	delete loan option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
246	manage deduction option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
247	create deduction option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
248	edit deduction option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
249	delete deduction option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
250	manage loan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
251	create loan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
252	edit loan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
253	delete loan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
254	create saturation deduction	web	2023-01-19 10:48:02	2023-01-19 10:48:02
255	edit saturation deduction	web	2023-01-19 10:48:02	2023-01-19 10:48:02
256	delete saturation deduction	web	2023-01-19 10:48:02	2023-01-19 10:48:02
257	create other payment	web	2023-01-19 10:48:02	2023-01-19 10:48:02
258	edit other payment	web	2023-01-19 10:48:02	2023-01-19 10:48:02
259	delete other payment	web	2023-01-19 10:48:02	2023-01-19 10:48:02
260	manage overtime	web	2023-01-19 10:48:02	2023-01-19 10:48:02
261	create overtime	web	2023-01-19 10:48:02	2023-01-19 10:48:02
262	edit overtime	web	2023-01-19 10:48:02	2023-01-19 10:48:02
263	delete overtime	web	2023-01-19 10:48:02	2023-01-19 10:48:02
264	manage day type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
265	create day type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
266	edit day type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
267	delete day type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
268	manage overtime type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
269	create overtime type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
270	edit overtime type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
271	delete overtime type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
272	manage set salary	web	2023-01-19 10:48:02	2023-01-19 10:48:02
273	edit set salary	web	2023-01-19 10:48:02	2023-01-19 10:48:02
274	manage pay slip	web	2023-01-19 10:48:02	2023-01-19 10:48:02
275	create set salary	web	2023-01-19 10:48:02	2023-01-19 10:48:02
276	create pay slip	web	2023-01-19 10:48:02	2023-01-19 10:48:02
277	manage company policy	web	2023-01-19 10:48:02	2023-01-19 10:48:02
278	create company policy	web	2023-01-19 10:48:02	2023-01-19 10:48:02
279	edit company policy	web	2023-01-19 10:48:02	2023-01-19 10:48:02
280	manage performance review	web	2023-01-19 10:48:02	2023-01-19 10:48:02
281	create performance review	web	2023-01-19 10:48:02	2023-01-19 10:48:02
282	edit performance review	web	2023-01-19 10:48:02	2023-01-19 10:48:02
283	show performance review	web	2023-01-19 10:48:02	2023-01-19 10:48:02
284	delete performance review	web	2023-01-19 10:48:02	2023-01-19 10:48:02
285	manage goal tracking	web	2023-01-19 10:48:02	2023-01-19 10:48:02
286	create goal tracking	web	2023-01-19 10:48:02	2023-01-19 10:48:02
287	edit goal tracking	web	2023-01-19 10:48:02	2023-01-19 10:48:02
288	delete goal tracking	web	2023-01-19 10:48:02	2023-01-19 10:48:02
289	manage goal type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
290	create goal type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
291	edit goal type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
292	delete goal type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
293	manage indicator	web	2023-01-19 10:48:02	2023-01-19 10:48:02
294	create indicator	web	2023-01-19 10:48:02	2023-01-19 10:48:02
295	edit indicator	web	2023-01-19 10:48:02	2023-01-19 10:48:02
296	show indicator	web	2023-01-19 10:48:02	2023-01-19 10:48:02
297	delete indicator	web	2023-01-19 10:48:02	2023-01-19 10:48:02
298	manage training	web	2023-01-19 10:48:02	2023-01-19 10:48:02
299	create training	web	2023-01-19 10:48:02	2023-01-19 10:48:02
300	edit training	web	2023-01-19 10:48:02	2023-01-19 10:48:02
301	delete training	web	2023-01-19 10:48:02	2023-01-19 10:48:02
302	show training	web	2023-01-19 10:48:02	2023-01-19 10:48:02
303	manage trainer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
304	create trainer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
305	edit trainer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
306	delete trainer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
307	manage training type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
308	create training type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
309	edit training type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
310	delete training type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
311	manage award	web	2023-01-19 10:48:02	2023-01-19 10:48:02
312	create award	web	2023-01-19 10:48:02	2023-01-19 10:48:02
313	edit award	web	2023-01-19 10:48:02	2023-01-19 10:48:02
314	delete award	web	2023-01-19 10:48:02	2023-01-19 10:48:02
315	manage award type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
316	create award type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
317	edit award type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
318	delete award type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
319	manage resignation	web	2023-01-19 10:48:02	2023-01-19 10:48:02
320	create resignation	web	2023-01-19 10:48:02	2023-01-19 10:48:02
321	edit resignation	web	2023-01-19 10:48:02	2023-01-19 10:48:02
322	delete resignation	web	2023-01-19 10:48:02	2023-01-19 10:48:02
323	manage on duty	web	2023-01-19 10:48:02	2023-01-19 10:48:02
324	create on duty	web	2023-01-19 10:48:02	2023-01-19 10:48:02
325	edit on duty	web	2023-01-19 10:48:02	2023-01-19 10:48:02
326	delete on duty	web	2023-01-19 10:48:02	2023-01-19 10:48:02
327	manage promotion	web	2023-01-19 10:48:02	2023-01-19 10:48:02
328	create promotion	web	2023-01-19 10:48:02	2023-01-19 10:48:02
329	edit promotion	web	2023-01-19 10:48:02	2023-01-19 10:48:02
330	delete promotion	web	2023-01-19 10:48:02	2023-01-19 10:48:02
331	manage complaint	web	2023-01-19 10:48:02	2023-01-19 10:48:02
332	create complaint	web	2023-01-19 10:48:02	2023-01-19 10:48:02
333	edit complaint	web	2023-01-19 10:48:02	2023-01-19 10:48:02
334	delete complaint	web	2023-01-19 10:48:02	2023-01-19 10:48:02
335	manage warning	web	2023-01-19 10:48:02	2023-01-19 10:48:02
336	create warning	web	2023-01-19 10:48:02	2023-01-19 10:48:02
337	edit warning	web	2023-01-19 10:48:02	2023-01-19 10:48:02
338	delete warning	web	2023-01-19 10:48:02	2023-01-19 10:48:02
339	manage termination	web	2023-01-19 10:48:02	2023-01-19 10:48:02
340	create termination	web	2023-01-19 10:48:02	2023-01-19 10:48:02
341	edit termination	web	2023-01-19 10:48:02	2023-01-19 10:48:02
342	delete termination	web	2023-01-19 10:48:02	2023-01-19 10:48:02
343	manage termination type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
344	create termination type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
345	edit termination type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
346	delete termination type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
347	manage job application	web	2023-01-19 10:48:02	2023-01-19 10:48:02
348	create job application	web	2023-01-19 10:48:02	2023-01-19 10:48:02
349	show job application	web	2023-01-19 10:48:02	2023-01-19 10:48:02
350	delete job application	web	2023-01-19 10:48:02	2023-01-19 10:48:02
351	move job application	web	2023-01-19 10:48:02	2023-01-19 10:48:02
352	add job application skill	web	2023-01-19 10:48:02	2023-01-19 10:48:02
353	add job application note	web	2023-01-19 10:48:02	2023-01-19 10:48:02
354	delete job application note	web	2023-01-19 10:48:02	2023-01-19 10:48:02
355	manage job onBoard	web	2023-01-19 10:48:02	2023-01-19 10:48:02
356	manage job category	web	2023-01-19 10:48:02	2023-01-19 10:48:02
357	create job category	web	2023-01-19 10:48:02	2023-01-19 10:48:02
358	edit job category	web	2023-01-19 10:48:02	2023-01-19 10:48:02
359	delete job category	web	2023-01-19 10:48:02	2023-01-19 10:48:02
360	manage job	web	2023-01-19 10:48:02	2023-01-19 10:48:02
361	create job	web	2023-01-19 10:48:02	2023-01-19 10:48:02
362	edit job	web	2023-01-19 10:48:02	2023-01-19 10:48:02
363	show job	web	2023-01-19 10:48:02	2023-01-19 10:48:02
364	delete job	web	2023-01-19 10:48:02	2023-01-19 10:48:02
365	manage job stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
366	create job stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
367	edit job stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
368	delete job stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
369	Manage Competencies	web	2023-01-19 10:48:02	2023-01-19 10:48:02
370	Create Competencies	web	2023-01-19 10:48:02	2023-01-19 10:48:02
371	Edit Competencies	web	2023-01-19 10:48:02	2023-01-19 10:48:02
372	Delete Competencies	web	2023-01-19 10:48:02	2023-01-19 10:48:02
373	manage custom question	web	2023-01-19 10:48:02	2023-01-19 10:48:02
374	create custom question	web	2023-01-19 10:48:02	2023-01-19 10:48:02
375	edit custom question	web	2023-01-19 10:48:02	2023-01-19 10:48:02
376	delete custom question	web	2023-01-19 10:48:02	2023-01-19 10:48:02
377	create interview schedule	web	2023-01-19 10:48:02	2023-01-19 10:48:02
378	edit interview schedule	web	2023-01-19 10:48:02	2023-01-19 10:48:02
379	delete interview schedule	web	2023-01-19 10:48:02	2023-01-19 10:48:02
380	show interview schedule	web	2023-01-19 10:48:02	2023-01-19 10:48:02
381	create estimation	web	2023-01-19 10:48:02	2023-01-19 10:48:02
382	view estimation	web	2023-01-19 10:48:02	2023-01-19 10:48:02
383	edit estimation	web	2023-01-19 10:48:02	2023-01-19 10:48:02
384	delete estimation	web	2023-01-19 10:48:02	2023-01-19 10:48:02
385	edit holiday	web	2023-01-19 10:48:02	2023-01-19 10:48:02
386	create holiday	web	2023-01-19 10:48:02	2023-01-19 10:48:02
387	delete holiday	web	2023-01-19 10:48:02	2023-01-19 10:48:02
388	manage holiday	web	2023-01-19 10:48:02	2023-01-19 10:48:02
389	show career	web	2023-01-19 10:48:02	2023-01-19 10:48:02
390	manage meeting	web	2023-01-19 10:48:02	2023-01-19 10:48:02
391	create meeting	web	2023-01-19 10:48:02	2023-01-19 10:48:02
392	edit meeting	web	2023-01-19 10:48:02	2023-01-19 10:48:02
393	delete meeting	web	2023-01-19 10:48:02	2023-01-19 10:48:02
394	manage event	web	2023-01-19 10:48:02	2023-01-19 10:48:02
395	create event	web	2023-01-19 10:48:02	2023-01-19 10:48:02
396	edit event	web	2023-01-19 10:48:02	2023-01-19 10:48:02
397	delete event	web	2023-01-19 10:48:02	2023-01-19 10:48:02
398	manage transfer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
399	create transfer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
400	edit transfer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
401	delete transfer	web	2023-01-19 10:48:02	2023-01-19 10:48:02
402	manage announcement	web	2023-01-19 10:48:02	2023-01-19 10:48:02
403	create announcement	web	2023-01-19 10:48:02	2023-01-19 10:48:02
404	edit announcement	web	2023-01-19 10:48:02	2023-01-19 10:48:02
405	delete announcement	web	2023-01-19 10:48:02	2023-01-19 10:48:02
406	manage leave	web	2023-01-19 10:48:02	2023-01-19 10:48:02
407	create leave	web	2023-01-19 10:48:02	2023-01-19 10:48:02
408	edit leave	web	2023-01-19 10:48:02	2023-01-19 10:48:02
409	delete leave	web	2023-01-19 10:48:02	2023-01-19 10:48:02
410	manage leave type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
411	create leave type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
412	edit leave type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
413	delete leave type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
414	manage attendance	web	2023-01-19 10:48:02	2023-01-19 10:48:02
415	create attendance	web	2023-01-19 10:48:02	2023-01-19 10:48:02
416	edit attendance	web	2023-01-19 10:48:02	2023-01-19 10:48:02
417	delete attendance	web	2023-01-19 10:48:02	2023-01-19 10:48:02
418	manage report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
419	manage project	web	2023-01-19 10:48:02	2023-01-19 10:48:02
420	create project	web	2023-01-19 10:48:02	2023-01-19 10:48:02
421	view project	web	2023-01-19 10:48:02	2023-01-19 10:48:02
422	edit project	web	2023-01-19 10:48:02	2023-01-19 10:48:02
423	delete project	web	2023-01-19 10:48:02	2023-01-19 10:48:02
424	create milestone	web	2023-01-19 10:48:02	2023-01-19 10:48:02
425	edit milestone	web	2023-01-19 10:48:02	2023-01-19 10:48:02
426	delete milestone	web	2023-01-19 10:48:02	2023-01-19 10:48:02
427	view milestone	web	2023-01-19 10:48:02	2023-01-19 10:48:02
428	view grant chart	web	2023-01-19 10:48:02	2023-01-19 10:48:02
429	manage project stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
430	create project stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
431	edit project stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
432	delete project stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
433	view expense	web	2023-01-19 10:48:02	2023-01-19 10:48:02
434	manage project task	web	2023-01-19 10:48:02	2023-01-19 10:48:02
435	create project task	web	2023-01-19 10:48:02	2023-01-19 10:48:02
436	edit project task	web	2023-01-19 10:48:02	2023-01-19 10:48:02
437	view project task	web	2023-01-19 10:48:02	2023-01-19 10:48:02
438	delete project task	web	2023-01-19 10:48:02	2023-01-19 10:48:02
439	view activity	web	2023-01-19 10:48:02	2023-01-19 10:48:02
440	view CRM activity	web	2023-01-19 10:48:02	2023-01-19 10:48:02
441	manage project task stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
442	edit project task stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
443	create project task stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
444	delete project task stage	web	2023-01-19 10:48:02	2023-01-19 10:48:02
445	manage timesheet	web	2023-01-19 10:48:02	2023-01-19 10:48:02
446	create timesheet	web	2023-01-19 10:48:02	2023-01-19 10:48:02
447	edit timesheet	web	2023-01-19 10:48:02	2023-01-19 10:48:02
448	delete timesheet	web	2023-01-19 10:48:02	2023-01-19 10:48:02
449	manage bug report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
450	create bug report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
451	edit bug report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
452	delete bug report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
453	move bug report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
454	manage bug status	web	2023-01-19 10:48:02	2023-01-19 10:48:02
455	create bug status	web	2023-01-19 10:48:02	2023-01-19 10:48:02
456	edit bug status	web	2023-01-19 10:48:02	2023-01-19 10:48:02
457	delete bug status	web	2023-01-19 10:48:02	2023-01-19 10:48:02
458	manage client dashboard	web	2023-01-19 10:48:02	2023-01-19 10:48:02
459	manage super admin dashboard	web	2023-01-19 10:48:02	2023-01-19 10:48:02
460	manage system settings	web	2023-01-19 10:48:02	2023-01-19 10:48:02
461	manage plan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
462	create plan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
463	edit plan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
464	manage coupon	web	2023-01-19 10:48:02	2023-01-19 10:48:02
465	create coupon	web	2023-01-19 10:48:02	2023-01-19 10:48:02
466	edit coupon	web	2023-01-19 10:48:02	2023-01-19 10:48:02
467	delete coupon	web	2023-01-19 10:48:02	2023-01-19 10:48:02
468	manage company plan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
469	buy plan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
470	manage form builder	web	2023-01-19 10:48:02	2023-01-19 10:48:02
471	create form builder	web	2023-01-19 10:48:02	2023-01-19 10:48:02
472	edit form builder	web	2023-01-19 10:48:02	2023-01-19 10:48:02
473	delete form builder	web	2023-01-19 10:48:02	2023-01-19 10:48:02
474	manage performance type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
475	create performance type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
476	edit performance type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
477	delete performance type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
478	manage form field	web	2023-01-19 10:48:02	2023-01-19 10:48:02
479	create form field	web	2023-01-19 10:48:02	2023-01-19 10:48:02
480	edit form field	web	2023-01-19 10:48:02	2023-01-19 10:48:02
481	delete form field	web	2023-01-19 10:48:02	2023-01-19 10:48:02
482	view form response	web	2023-01-19 10:48:02	2023-01-19 10:48:02
483	create budget plan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
484	edit budget plan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
485	manage budget plan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
486	delete budget plan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
487	view budget plan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
488	manage warehouse	web	2023-01-19 10:48:02	2023-01-19 10:48:02
489	create warehouse	web	2023-01-19 10:48:02	2023-01-19 10:48:02
490	edit warehouse	web	2023-01-19 10:48:02	2023-01-19 10:48:02
491	show warehouse	web	2023-01-19 10:48:02	2023-01-19 10:48:02
492	delete warehouse	web	2023-01-19 10:48:02	2023-01-19 10:48:02
493	manage purchase	web	2023-01-19 10:48:02	2023-01-19 10:48:02
494	create purchase	web	2023-01-19 10:48:02	2023-01-19 10:48:02
495	edit purchase	web	2023-01-19 10:48:02	2023-01-19 10:48:02
496	show employee request	web	2023-01-19 10:48:02	2023-01-19 10:48:02
497	manage employee request	web	2023-01-19 10:48:02	2023-01-19 10:48:02
498	show purchase	web	2023-01-19 10:48:02	2023-01-19 10:48:02
499	delete purchase	web	2023-01-19 10:48:02	2023-01-19 10:48:02
500	send purchase	web	2023-01-19 10:48:02	2023-01-19 10:48:02
501	create payment purchase	web	2023-01-19 10:48:02	2023-01-19 10:48:02
502	manage pos	web	2023-01-19 10:48:02	2023-01-19 10:48:02
503	manage contract type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
504	create contract type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
505	edit contract type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
506	delete contract type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
507	manage shift type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
508	create shift type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
509	edit shift type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
510	delete shift type	web	2023-01-19 10:48:02	2023-01-19 10:48:02
511	manage request shift schedule	web	2023-01-19 10:48:02	2023-01-19 10:48:02
512	show shift schedule	web	2023-01-19 10:48:02	2023-01-19 10:48:02
513	create shift schedule	web	2023-01-19 10:48:02	2023-01-19 10:48:02
514	edit shift schedule	web	2023-01-19 10:48:02	2023-01-19 10:48:02
515	delete shift schedule	web	2023-01-19 10:48:02	2023-01-19 10:48:02
516	create request shift schedule	web	2023-01-19 10:48:02	2023-01-19 10:48:02
517	edit request shift schedule	web	2023-01-19 10:48:02	2023-01-19 10:48:02
518	delete request shift schedule	web	2023-01-19 10:48:02	2023-01-19 10:48:02
519	manage contract	web	2023-01-19 10:48:02	2023-01-19 10:48:02
520	create contract	web	2023-01-19 10:48:02	2023-01-19 10:48:02
521	edit contract	web	2023-01-19 10:48:02	2023-01-19 10:48:02
522	delete contract	web	2023-01-19 10:48:02	2023-01-19 10:48:02
523	show contract	web	2023-01-19 10:48:02	2023-01-19 10:48:02
524	show time management report	web	2023-01-19 10:48:02	2023-01-19 10:48:02
525	manage payroll	web	2023-01-19 10:48:02	2023-01-19 10:48:02
526	create payroll	web	2023-01-19 10:48:02	2023-01-19 10:48:02
527	edit payroll	web	2023-01-19 10:48:02	2023-01-19 10:48:02
528	delete payroll	web	2023-01-19 10:48:02	2023-01-19 10:48:02
529	show payroll	web	2023-01-19 10:48:02	2023-01-19 10:48:02
530	manage reimburst	web	2023-01-19 10:48:02	2023-01-19 10:48:02
531	create reimburst	web	2023-01-19 10:48:02	2023-01-19 10:48:02
532	edit reimburst	web	2023-01-19 10:48:02	2023-01-19 10:48:02
533	delete reimburst	web	2023-01-19 10:48:02	2023-01-19 10:48:02
534	show reimburst	web	2023-01-19 10:48:02	2023-01-19 10:48:02
535	manage cash	web	2023-01-19 10:48:02	2023-01-19 10:48:02
536	create cash	web	2023-01-19 10:48:02	2023-01-19 10:48:02
537	edit cash	web	2023-01-19 10:48:02	2023-01-19 10:48:02
538	delete cash	web	2023-01-19 10:48:02	2023-01-19 10:48:02
539	manage cash advance	web	2023-01-19 10:48:02	2023-01-19 10:48:02
540	create cash advance	web	2023-01-19 10:48:02	2023-01-19 10:48:02
541	edit cash advance	web	2023-01-19 10:48:02	2023-01-19 10:48:02
542	delete cash advance	web	2023-01-19 10:48:02	2023-01-19 10:48:02
543	show cash	web	2023-01-19 10:48:02	2023-01-19 10:48:02
544	manage allowance	web	2023-01-19 10:48:02	2023-01-19 10:48:02
545	create allowance	web	2023-01-19 10:48:02	2023-01-19 10:48:02
546	edit allowance	web	2023-01-19 10:48:02	2023-01-19 10:48:02
547	delete allowance	web	2023-01-19 10:48:02	2023-01-19 10:48:02
548	manage allowance option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
549	create allowance option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
550	edit allowance option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
551	delete allowance option	web	2023-01-19 10:48:02	2023-01-19 10:48:02
552	manage denda	web	2023-01-19 10:48:02	2023-01-19 10:48:02
553	create denda	web	2023-01-19 10:48:02	2023-01-19 10:48:02
554	edit denda	web	2023-01-19 10:48:02	2023-01-19 10:48:02
555	delete denda	web	2023-01-19 10:48:02	2023-01-19 10:48:02
556	manage setting payroll overtime	web	2023-01-19 10:48:02	2023-01-19 10:48:02
557	create setting payroll overtime	web	2023-01-19 10:48:02	2023-01-19 10:48:02
558	edit setting payroll overtime	web	2023-01-19 10:48:02	2023-01-19 10:48:02
559	delete setting payroll overtime	web	2023-01-19 10:48:02	2023-01-19 10:48:02
560	manage bpjs kesehatan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
561	create bpjs kesehatan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
562	edit bpjs kesehatan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
563	delete bpjs kesehatan	web	2023-01-19 10:48:02	2023-01-19 10:48:02
564	manage pph21	web	2023-01-19 10:48:02	2023-01-19 10:48:02
565	edit pph21	web	2023-01-19 10:48:02	2023-01-19 10:48:02
566	manage jht	web	2023-01-19 10:48:02	2023-01-19 10:48:02
567	edit jht	web	2023-01-19 10:48:02	2023-01-19 10:48:02
568	manage jkk	web	2023-01-19 10:48:02	2023-01-19 10:48:02
569	edit jkk	web	2023-01-19 10:48:02	2023-01-19 10:48:02
570	manage jkm	web	2023-01-19 10:48:02	2023-01-19 10:48:02
571	edit jkm	web	2023-01-19 10:48:02	2023-01-19 10:48:02
572	manage jp	web	2023-01-19 10:48:02	2023-01-19 10:48:02
573	edit jp	web	2023-01-19 10:48:02	2023-01-19 10:48:02
574	manage dayoff	web	2023-01-19 10:48:02	2023-01-19 10:48:02
575	create dayoff	web	2023-01-19 10:48:02	2023-01-19 10:48:02
576	edit dayoff	web	2023-01-19 10:48:02	2023-01-19 10:48:02
577	delete dayoff	web	2023-01-19 10:48:02	2023-01-19 10:48:02
578	manage company holiday	web	2023-01-19 10:48:02	2023-01-19 10:48:02
579	create company holiday	web	2023-01-19 10:48:02	2023-01-19 10:48:02
580	edit company holiday	web	2023-01-19 10:48:02	2023-01-19 10:48:02
581	delete company holiday	web	2023-01-19 10:48:02	2023-01-19 10:48:02
582	show allowance	web	2023-01-19 10:48:02	2023-01-19 10:48:02
\.


--
-- Data for Name: model_has_permissions; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY model_has_permissions (permission_id, model_type, model_id) FROM stdin;
\.


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY roles (id, name, guard_name, created_at, updated_at, created_by) FROM stdin;
1	super admin	web	2023-01-19 10:48:02	2023-01-19 10:48:02	0
2	company	web	2023-01-19 10:48:02	2023-01-19 10:48:02	0
3	accountant	web	2023-01-19 10:48:02	2023-01-19 10:48:02	2
\.


--
-- Data for Name: model_has_roles; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY model_has_roles (role_id, model_type, model_id) FROM stdin;
1	App\\Models\\User	1
2	App\\Models\\User	2
3	App\\Models\\User	3
3	App\\Models\\User	4
3	App\\Models\\User	5
3	App\\Models\\User	6
3	App\\Models\\User	7
3	App\\Models\\User	8
3	App\\Models\\User	9
3	App\\Models\\User	10
3	App\\Models\\User	11
\.


--
-- Data for Name: overtime_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY overtime_types (id, name, created_by, created_at, updated_at) FROM stdin;
1	Lembur Deadline	2	2023-01-19 10:48:03	2023-01-20 18:44:22
\.


--
-- Name: overtime_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('overtime_types_id_seq', 1, true);


--
-- Data for Name: overtimes; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY overtimes (id, employee_id, overtime_type_id, day_type_id, start_date, end_date, start_time, end_time, duration, amount_fee, notes, status, rejected_reason, attachment_reject, created_by, created_at, updated_at) FROM stdin;
1	2	1	1	2023-01-20	2023-01-20	16:00	18:00	02:00:00	0.00	tess	Approved	\N	\N	2	2023-01-20 18:51:11	2023-01-20 18:51:11
\.


--
-- Name: overtimes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('overtimes_id_seq', 1, true);


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: pay_slips; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY pay_slips (id, employee_id, pdf_filename, net_payble, salary_month, status, basic_salary, salary, allowance, reimburst, cash_in_advance, loan, denda, bpjs_kesehatan, pph21, overtime, created_by, created_at, updated_at) FROM stdin;
1	2	Payslip 2023-01.pdf	5000000	2023-01	1	[{"id":1,"employee_id":2,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-01-19T06:59:47.000000Z","updated_at":"2023-01-19T06:59:47.000000Z"}]	5000000	[]	[]	[]	[]	[]	\N	\N	[]	2	2023-01-19 13:59:56	2023-01-19 13:59:56
2	2	Payslip 2023-01.pdf	5099995	2023-01	1	[{"id":1,"employee_id":2,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-01-19T06:59:47.000000Z","updated_at":"2023-01-19T06:59:47.000000Z"}]	5000000	[]	[{"id":1,"employee_id":2,"reimburst_type_id":1,"amount":100000,"created_by":2,"created_at":"2023-01-20T11:46:45.000000Z","updated_at":"2023-01-20T11:46:45.000000Z"}]	[]	[]	[]	{"type":"Fixed","value":"5"}	[{"income":"5000000","percentage":"15"}]	[]	2	2023-01-20 18:46:54	2023-01-20 18:46:54
3	2	Payslip 2023-01.pdf	4800000	2023-01	1	[{"id":1,"employee_id":2,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-01-19T06:59:47.000000Z","updated_at":"2023-01-19T06:59:47.000000Z"}]	5000000	[{"id":1,"employee_id":2,"allowance_type_id":2,"amount":500000,"created_by":2,"created_at":"2023-01-20T11:48:42.000000Z","updated_at":"2023-01-20T11:48:42.000000Z"},{"id":2,"employee_id":2,"allowance_type_id":3,"amount":250000,"created_by":2,"created_at":"2023-01-20T11:48:56.000000Z","updated_at":"2023-01-20T11:48:56.000000Z"}]	[{"id":1,"employee_id":2,"reimburst_type_id":1,"amount":100000,"created_by":2,"created_at":"2023-01-20T11:46:45.000000Z","updated_at":"2023-01-20T11:46:45.000000Z"}]	[{"id":1,"employee_id":2,"loan_type_id":1,"amount":300000,"created_by":2,"created_at":"2023-01-20T11:47:44.000000Z","updated_at":"2023-01-20T11:47:44.000000Z"}]	[{"id":1,"employee_id":2,"loan_type_id":2,"amount":500000,"created_by":2,"created_at":"2023-01-20T11:48:25.000000Z","updated_at":"2023-01-20T11:48:25.000000Z"}]	[]	{"type":"Percentage","value":"5"}	[{"income":"5000000","percentage":"15"}]	[{"id":1,"employee_id":2,"overtime_type_id":1,"day_type_id":1,"start_date":"2023-01-20","end_date":"2023-01-20","start_time":"16:00","end_time":"18:00","duration":"02:00:00","amount_fee":"0.00","notes":"tess","status":"Approved","rejected_reason":null,"attachment_reject":null,"created_by":2,"created_at":"2023-01-20T11:51:11.000000Z","updated_at":"2023-01-20T11:51:11.000000Z"}]	2	2023-01-20 18:51:24	2023-01-20 18:51:24
\.


--
-- Name: pay_slips_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('pay_slips_id_seq', 3, true);


--
-- Data for Name: payrolls; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY payrolls (id, employee_id, payslip_type_id, amount, created_by, created_at, updated_at) FROM stdin;
1	2	1	5000000	2	2023-01-19 13:59:47	2023-01-19 13:59:47
\.


--
-- Name: payrolls_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('payrolls_id_seq', 1, true);


--
-- Data for Name: payslip_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY payslip_types (id, name, type, created_by, created_at, updated_at) FROM stdin;
1	Gaji Pokok	monthly	2	2023-01-19 13:59:32	2023-01-19 13:59:32
\.


--
-- Name: payslip_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('payslip_types_id_seq', 1, true);


--
-- Data for Name: performance_reviews; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY performance_reviews (id, employee_id, knowledge, skill, accuracy, quality, care, reliability, working_method, flexibility, initiative, cooperation, attendance, organizational_commitment, kpi_total_score, review_date, created_by, notes, created_at, updated_at) FROM stdin;
\.


--
-- Name: performance_reviews_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('performance_reviews_id_seq', 1, false);


--
-- Name: permissions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('permissions_id_seq', 582, true);


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
\.


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('personal_access_tokens_id_seq', 1, false);


--
-- Data for Name: reimburstment_options; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY reimburstment_options (id, name, created_by, created_at, updated_at) FROM stdin;
1	Uang Transport	2	2023-01-20 18:43:37	2023-01-20 18:43:37
\.


--
-- Name: reimburstment_options_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('reimburstment_options_id_seq', 1, true);


--
-- Data for Name: reimbursts; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY reimbursts (id, employee_id, reimburst_type_id, amount, created_by, created_at, updated_at) FROM stdin;
1	2	1	100000	2	2023-01-20 18:46:45	2023-01-20 18:46:45
\.


--
-- Name: reimbursts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('reimbursts_id_seq', 1, true);


--
-- Data for Name: req_shift_schedules; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY req_shift_schedules (id, employee_id, remark, requested_date, status, rejected_reason, attachment_reject, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: req_shift_schedules_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('req_shift_schedules_id_seq', 1, false);


--
-- Data for Name: role_has_permissions; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY role_has_permissions (permission_id, role_id) FROM stdin;
459	1
5	1
6	1
7	1
8	1
9	1
460	1
21	1
14	1
15	1
16	1
17	1
461	1
462	1
463	1
88	1
464	1
465	1
466	1
467	1
1	2
496	2
497	2
524	2
3	2
4	2
5	2
6	2
7	2
8	2
10	2
11	2
12	2
13	2
14	2
15	2
16	2
17	2
18	2
20	2
22	2
23	2
24	2
25	2
26	2
27	2
28	2
29	2
30	2
48	2
49	2
51	2
50	2
40	2
41	2
42	2
43	2
44	2
45	2
46	2
47	2
36	2
37	2
38	2
39	2
52	2
53	2
54	2
55	2
56	2
57	2
58	2
59	2
60	2
61	2
62	2
63	2
64	2
65	2
66	2
67	2
68	2
69	2
71	2
72	2
73	2
74	2
75	2
76	2
77	2
78	2
79	2
80	2
81	2
82	2
83	2
34	2
84	2
33	2
31	2
32	2
85	2
86	2
87	2
89	2
90	2
91	2
92	2
93	2
94	2
95	2
96	2
70	2
88	2
104	2
105	2
106	2
107	2
108	2
109	2
110	2
111	2
112	2
35	2
113	2
114	2
115	2
116	2
117	2
118	2
119	2
120	2
121	2
123	2
124	2
125	2
126	2
127	2
128	2
129	2
130	2
131	2
132	2
133	2
134	2
135	2
136	2
137	2
138	2
139	2
140	2
141	2
142	2
143	2
144	2
145	2
146	2
147	2
148	2
149	2
150	2
151	2
152	2
153	2
154	2
155	2
156	2
157	2
158	2
159	2
160	2
161	2
162	2
163	2
164	2
165	2
166	2
167	2
168	2
169	2
170	2
171	2
172	2
173	2
174	2
175	2
176	2
177	2
178	2
179	2
180	2
181	2
182	2
183	2
184	2
185	2
186	2
187	2
188	2
189	2
190	2
191	2
192	2
193	2
194	2
195	2
196	2
197	2
198	2
199	2
200	2
201	2
202	2
203	2
204	2
205	2
206	2
207	2
208	2
209	2
210	2
211	2
212	2
213	2
214	2
215	2
216	2
217	2
218	2
219	2
220	2
221	2
222	2
223	2
224	2
226	2
227	2
228	2
229	2
230	2
231	2
232	2
233	2
234	2
235	2
236	2
237	2
238	2
239	2
240	2
241	2
242	2
243	2
244	2
245	2
246	2
247	2
248	2
249	2
250	2
251	2
252	2
253	2
254	2
255	2
256	2
257	2
258	2
259	2
260	2
261	2
262	2
263	2
268	2
269	2
270	2
271	2
264	2
265	2
266	2
267	2
272	2
273	2
274	2
275	2
276	2
277	2
278	2
279	2
225	2
280	2
281	2
282	2
283	2
284	2
285	2
286	2
287	2
288	2
289	2
290	2
291	2
292	2
293	2
294	2
295	2
296	2
297	2
394	2
395	2
396	2
397	2
390	2
391	2
392	2
393	2
298	2
299	2
300	2
301	2
302	2
303	2
304	2
305	2
306	2
307	2
308	2
309	2
310	2
311	2
312	2
313	2
314	2
315	2
316	2
317	2
318	2
319	2
320	2
321	2
322	2
323	2
324	2
325	2
326	2
327	2
328	2
329	2
330	2
331	2
332	2
333	2
334	2
335	2
336	2
337	2
338	2
339	2
340	2
341	2
342	2
343	2
344	2
345	2
346	2
347	2
348	2
349	2
350	2
351	2
352	2
353	2
354	2
355	2
356	2
357	2
358	2
359	2
360	2
361	2
362	2
363	2
364	2
365	2
366	2
367	2
368	2
369	2
370	2
371	2
372	2
373	2
374	2
375	2
376	2
377	2
378	2
379	2
380	2
381	2
382	2
383	2
384	2
385	2
386	2
387	2
388	2
389	2
398	2
399	2
400	2
401	2
402	2
403	2
404	2
405	2
406	2
407	2
408	2
409	2
410	2
411	2
412	2
413	2
414	2
415	2
416	2
417	2
418	2
419	2
420	2
421	2
422	2
423	2
424	2
425	2
426	2
427	2
428	2
429	2
430	2
431	2
432	2
433	2
434	2
435	2
436	2
437	2
438	2
439	2
440	2
441	2
443	2
442	2
444	2
445	2
446	2
447	2
448	2
449	2
450	2
451	2
452	2
453	2
454	2
455	2
456	2
457	2
19	2
468	2
469	2
2	2
461	2
470	2
471	2
472	2
473	2
474	2
475	2
476	2
477	2
478	2
479	2
480	2
481	2
482	2
485	2
483	2
484	2
486	2
487	2
488	2
489	2
490	2
491	2
492	2
493	2
494	2
495	2
498	2
499	2
500	2
501	2
502	2
503	2
504	2
505	2
506	2
507	2
508	2
509	2
510	2
512	2
513	2
514	2
515	2
511	2
516	2
517	2
518	2
519	2
520	2
521	2
522	2
523	2
525	2
526	2
527	2
528	2
529	2
530	2
531	2
532	2
533	2
534	2
535	2
536	2
537	2
538	2
543	2
539	2
540	2
541	2
542	2
544	2
545	2
546	2
547	2
548	2
549	2
550	2
551	2
552	2
553	2
554	2
555	2
556	2
557	2
558	2
559	2
560	2
561	2
562	2
563	2
564	2
565	2
566	2
567	2
568	2
569	2
570	2
571	2
572	2
573	2
574	2
575	2
576	2
577	2
578	2
579	2
580	2
581	2
582	2
\.


--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('roles_id_seq', 3, true);


--
-- Data for Name: set_bpjstk; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY set_bpjstk (id, employee_id, bpjstk_name, created_by, created_at, updated_at) FROM stdin;
1	2	["JKK","JKM"]	2	2023-01-20 18:49:09	2023-01-20 18:49:09
\.


--
-- Name: set_bpjstk_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('set_bpjstk_id_seq', 1, true);


--
-- Data for Name: settings; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY settings (id, name, value, created_by, created_at, updated_at) FROM stdin;
1	employee_prefix	#PDR	2	2023-01-19 10:48:03	2023-01-19 10:48:03
2	site_time_format	PDR	2	2023-01-19 10:48:03	2023-01-19 10:48:03
3	storage_setting	local	1	2023-01-19 10:48:03	2023-01-19 10:48:03
4	jht	{"type":"JHT","value":"5.7"}	2	2023-01-19 10:48:03	2023-01-19 10:48:03
5	jp	{"type":"JP","value":"3"}	2	2023-01-19 10:48:03	2023-01-19 10:48:03
7	pph21	[{"income":"5000000","percentage":"15"}]	2	2023-01-20 18:45:44	2023-01-20 18:45:44
8	jkm	{"type":"Percentage","value":"4"}	2	2023-01-20 18:46:11	2023-01-20 18:46:11
6	bpjs_tk	{"type":"Percentage","value":"5"}	2	2023-01-20 18:45:29	2023-01-20 18:47:23
\.


--
-- Name: settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('settings_id_seq', 8, true);


--
-- Data for Name: shift_schedules; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY shift_schedules (id, employee_id, req_shift_schedules_id, schedule_date, shift_id, status, is_dayoff, dayoff_type, description, is_active, created_by, created_at, updated_at) FROM stdin;
1	1	\N	2022-12-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
2	1	\N	2022-12-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
3	1	\N	2022-12-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
4	1	\N	2022-12-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
5	1	\N	2022-12-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
6	1	\N	2022-12-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
7	1	\N	2022-12-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
8	1	\N	2022-12-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
9	1	\N	2022-12-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
10	1	\N	2022-12-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
11	1	\N	2022-12-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
12	1	\N	2022-12-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
13	1	\N	2022-12-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
14	1	\N	2022-12-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
15	1	\N	2022-12-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
16	1	\N	2022-12-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
17	1	\N	2022-12-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
18	1	\N	2022-12-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
19	1	\N	2022-12-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
20	1	\N	2022-12-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
21	1	\N	2022-12-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
23	1	\N	2022-12-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
26	1	\N	2022-12-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
27	1	\N	2022-12-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
28	1	\N	2022-12-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
29	1	\N	2022-12-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
30	1	\N	2022-12-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
33	1	\N	2023-01-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
34	1	\N	2023-01-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
35	1	\N	2023-01-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
36	1	\N	2023-01-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
37	1	\N	2023-01-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
38	1	\N	2023-01-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
39	1	\N	2023-01-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
40	1	\N	2023-01-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
41	1	\N	2023-01-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
42	1	\N	2023-01-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
43	1	\N	2023-01-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
44	1	\N	2023-01-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
45	1	\N	2023-01-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
46	1	\N	2023-01-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
47	1	\N	2023-01-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
48	1	\N	2023-01-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
49	1	\N	2023-01-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
50	1	\N	2023-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
51	1	\N	2023-01-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
52	1	\N	2023-01-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
55	1	\N	2023-01-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
56	1	\N	2023-01-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
57	1	\N	2023-01-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
58	1	\N	2023-01-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
59	1	\N	2023-01-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
60	1	\N	2023-01-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
61	1	\N	2023-01-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
62	1	\N	2023-01-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
63	1	\N	2023-02-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
64	1	\N	2023-02-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
65	1	\N	2023-02-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
66	1	\N	2023-02-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
67	1	\N	2023-02-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
68	1	\N	2023-02-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
69	1	\N	2023-02-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
70	1	\N	2023-02-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
71	1	\N	2023-02-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
72	1	\N	2023-02-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
73	1	\N	2023-02-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
74	1	\N	2023-02-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
75	1	\N	2023-02-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
76	1	\N	2023-02-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
77	1	\N	2023-02-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
78	1	\N	2023-02-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
79	1	\N	2023-02-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
81	1	\N	2023-02-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
82	1	\N	2023-02-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
83	1	\N	2023-02-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
84	1	\N	2023-02-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
85	1	\N	2023-02-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
86	1	\N	2023-02-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
87	1	\N	2023-02-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
88	1	\N	2023-02-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
24	1	\N	2022-12-24	1	Approved	t	National Holiday	Malam Natal	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
25	1	\N	2022-12-25	1	Approved	t	National Holiday	Hari Raya Natal	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
32	1	\N	2023-01-01	1	Approved	t	National Holiday	Hari Tahun Baru	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
53	1	\N	2023-01-22	1	Approved	t	National Holiday	Tahun Baru Imlek	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
80	1	\N	2023-02-18	1	Approved	t	National Holiday	Isra Mikraj Nabi Muhammad	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
89	1	\N	2023-02-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
90	1	\N	2023-02-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
91	1	\N	2023-03-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
92	1	\N	2023-03-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
93	1	\N	2023-03-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
94	1	\N	2023-03-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
95	1	\N	2023-03-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
96	1	\N	2023-03-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
97	1	\N	2023-03-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
98	1	\N	2023-03-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
99	1	\N	2023-03-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
100	1	\N	2023-03-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
101	1	\N	2023-03-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
102	1	\N	2023-03-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
103	1	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
104	1	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
105	1	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
106	1	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
107	1	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
108	1	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
109	1	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
110	1	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
111	1	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
114	1	\N	2023-03-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
115	1	\N	2023-03-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
116	1	\N	2023-03-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
117	1	\N	2023-03-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
118	1	\N	2023-03-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
119	1	\N	2023-03-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
120	1	\N	2023-03-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
121	1	\N	2023-03-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
122	1	\N	2023-04-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
123	1	\N	2023-04-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
124	1	\N	2023-04-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
125	1	\N	2023-04-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
126	1	\N	2023-04-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
127	1	\N	2023-04-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
129	1	\N	2023-04-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
131	1	\N	2023-04-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
132	1	\N	2023-04-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
133	1	\N	2023-04-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
134	1	\N	2023-04-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
135	1	\N	2023-04-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
136	1	\N	2023-04-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
137	1	\N	2023-04-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
138	1	\N	2023-04-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
139	1	\N	2023-04-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
140	1	\N	2023-04-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
141	1	\N	2023-04-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
148	1	\N	2023-04-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
149	1	\N	2023-04-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
150	1	\N	2023-04-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
151	1	\N	2023-04-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
153	1	\N	2023-05-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
154	1	\N	2023-05-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
155	1	\N	2023-05-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
156	1	\N	2023-05-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
157	1	\N	2023-05-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
158	1	\N	2023-05-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
159	1	\N	2023-05-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
160	1	\N	2023-05-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
161	1	\N	2023-05-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
162	1	\N	2023-05-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
163	1	\N	2023-05-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
164	1	\N	2023-05-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
165	1	\N	2023-05-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
166	1	\N	2023-05-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
167	1	\N	2023-05-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
168	1	\N	2023-05-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
170	1	\N	2023-05-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
171	1	\N	2023-05-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
172	1	\N	2023-05-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
173	1	\N	2023-05-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
174	1	\N	2023-05-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
175	1	\N	2023-05-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
176	1	\N	2023-05-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
128	1	\N	2023-04-07	1	Approved	t	National Holiday	Wafat Isa Almasih	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
130	1	\N	2023-04-09	1	Approved	t	National Holiday	Hari Paskah	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
142	1	\N	2023-04-21	1	Approved	t	National Holiday	Hari Kartini	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
143	1	\N	2023-04-22	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
145	1	\N	2023-04-24	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
146	1	\N	2023-04-25	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
152	1	\N	2023-05-01	1	Approved	t	National Holiday	Hari Buruh Internasional / Pekerja	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
169	1	\N	2023-05-18	1	Approved	t	National Holiday	Kenaikan Isa Al Masih	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
177	1	\N	2023-05-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
178	1	\N	2023-05-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
179	1	\N	2023-05-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
180	1	\N	2023-05-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
181	1	\N	2023-05-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
182	1	\N	2023-05-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
185	1	\N	2023-06-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
187	1	\N	2023-06-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
188	1	\N	2023-06-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
189	1	\N	2023-06-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
190	1	\N	2023-06-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
191	1	\N	2023-06-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
192	1	\N	2023-06-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
193	1	\N	2023-06-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
194	1	\N	2023-06-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
195	1	\N	2023-06-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
196	1	\N	2023-06-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
197	1	\N	2023-06-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
198	1	\N	2023-06-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
199	1	\N	2023-06-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
200	1	\N	2023-06-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
201	1	\N	2023-06-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
202	1	\N	2023-06-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
203	1	\N	2023-06-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
204	1	\N	2023-06-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
205	1	\N	2023-06-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
206	1	\N	2023-06-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
207	1	\N	2023-06-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
208	1	\N	2023-06-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
209	1	\N	2023-06-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
210	1	\N	2023-06-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
212	1	\N	2023-06-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
213	1	\N	2023-07-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
214	1	\N	2023-07-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
215	1	\N	2023-07-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
216	1	\N	2023-07-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
217	1	\N	2023-07-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
218	1	\N	2023-07-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
219	1	\N	2023-07-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
220	1	\N	2023-07-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
221	1	\N	2023-07-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
222	1	\N	2023-07-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
223	1	\N	2023-07-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
224	1	\N	2023-07-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
225	1	\N	2023-07-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
226	1	\N	2023-07-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
227	1	\N	2023-07-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
228	1	\N	2023-07-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
229	1	\N	2023-07-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
230	1	\N	2023-07-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
232	1	\N	2023-07-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
233	1	\N	2023-07-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
234	1	\N	2023-07-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
235	1	\N	2023-07-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
236	1	\N	2023-07-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
237	1	\N	2023-07-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
238	1	\N	2023-07-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
239	1	\N	2023-07-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
240	1	\N	2023-07-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
241	1	\N	2023-07-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
242	1	\N	2023-07-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
243	1	\N	2023-07-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
244	1	\N	2023-08-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
245	1	\N	2023-08-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
246	1	\N	2023-08-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
247	1	\N	2023-08-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
248	1	\N	2023-08-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
249	1	\N	2023-08-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
250	1	\N	2023-08-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
251	1	\N	2023-08-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
252	1	\N	2023-08-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
253	1	\N	2023-08-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
254	1	\N	2023-08-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
255	1	\N	2023-08-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
256	1	\N	2023-08-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
257	1	\N	2023-08-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
258	1	\N	2023-08-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
259	1	\N	2023-08-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
261	1	\N	2023-08-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
262	1	\N	2023-08-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
263	1	\N	2023-08-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
264	1	\N	2023-08-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
184	1	\N	2023-06-02	1	Approved	t	National Holiday	Cuti Bersama Waisak	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
186	1	\N	2023-06-04	1	Approved	t	National Holiday	Hari Raya Waisak	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
231	1	\N	2023-07-19	1	Approved	t	National Holiday	Satu Muharam / Tahun Baru Hijriah	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
265	1	\N	2023-08-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
266	1	\N	2023-08-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
267	1	\N	2023-08-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
268	1	\N	2023-08-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
269	1	\N	2023-08-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
270	1	\N	2023-08-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
271	1	\N	2023-08-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
272	1	\N	2023-08-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
273	1	\N	2023-08-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
274	1	\N	2023-08-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
275	1	\N	2023-09-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
276	1	\N	2023-09-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
277	1	\N	2023-09-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
278	1	\N	2023-09-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
279	1	\N	2023-09-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
280	1	\N	2023-09-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
281	1	\N	2023-09-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
282	1	\N	2023-09-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
283	1	\N	2023-09-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
284	1	\N	2023-09-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
285	1	\N	2023-09-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
286	1	\N	2023-09-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
287	1	\N	2023-09-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
288	1	\N	2023-09-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
289	1	\N	2023-09-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
290	1	\N	2023-09-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
291	1	\N	2023-09-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
292	1	\N	2023-09-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
293	1	\N	2023-09-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
294	1	\N	2023-09-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
295	1	\N	2023-09-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
296	1	\N	2023-09-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
297	1	\N	2023-09-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
298	1	\N	2023-09-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
299	1	\N	2023-09-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
300	1	\N	2023-09-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
301	1	\N	2023-09-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
303	1	\N	2023-09-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
304	1	\N	2023-09-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
305	1	\N	2023-10-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
307	1	\N	2023-10-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
308	1	\N	2023-10-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
309	1	\N	2023-10-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
310	1	\N	2023-10-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
311	1	\N	2023-10-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
312	1	\N	2023-10-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
313	1	\N	2023-10-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
314	1	\N	2023-10-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
315	1	\N	2023-10-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
316	1	\N	2023-10-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
317	1	\N	2023-10-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
318	1	\N	2023-10-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
319	1	\N	2023-10-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
320	1	\N	2023-10-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
321	1	\N	2023-10-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
322	1	\N	2023-10-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
323	1	\N	2023-10-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
324	1	\N	2023-10-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
325	1	\N	2023-10-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
326	1	\N	2023-10-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
327	1	\N	2023-10-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
328	1	\N	2023-10-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
329	1	\N	2023-10-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
330	1	\N	2023-10-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
331	1	\N	2023-10-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
332	1	\N	2023-10-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
333	1	\N	2023-10-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
334	1	\N	2023-10-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
335	1	\N	2023-10-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
336	1	\N	2023-11-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
337	1	\N	2023-11-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
338	1	\N	2023-11-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
339	1	\N	2023-11-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
340	1	\N	2023-11-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
341	1	\N	2023-11-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
342	1	\N	2023-11-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
343	1	\N	2023-11-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
344	1	\N	2023-11-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
345	1	\N	2023-11-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
346	1	\N	2023-11-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
348	1	\N	2023-11-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
349	1	\N	2023-11-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
350	1	\N	2023-11-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
351	1	\N	2023-11-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
352	1	\N	2023-11-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
306	1	\N	2023-10-02	1	Approved	t	National Holiday	Hari Batik	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
347	1	\N	2023-11-12	1	Approved	t	National Holiday	Diwali / Deepavali	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
353	1	\N	2023-11-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
354	1	\N	2023-11-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
355	1	\N	2023-11-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
356	1	\N	2023-11-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
357	1	\N	2023-11-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
358	1	\N	2023-11-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
359	1	\N	2023-11-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
361	1	\N	2023-11-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
362	1	\N	2023-11-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
363	1	\N	2023-11-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
364	1	\N	2023-11-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
365	1	\N	2023-11-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
366	1	\N	2023-12-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:48:03	2023-01-19 10:48:03
367	2	\N	2023-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
368	2	\N	2023-01-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
369	2	\N	2023-01-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
372	2	\N	2023-01-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
373	2	\N	2023-01-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
374	2	\N	2023-01-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
375	2	\N	2023-01-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
376	2	\N	2023-01-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
377	2	\N	2023-01-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
378	2	\N	2023-01-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
379	2	\N	2023-01-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
380	2	\N	2023-02-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
381	2	\N	2023-02-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
382	2	\N	2023-02-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
383	2	\N	2023-02-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
384	2	\N	2023-02-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
385	2	\N	2023-02-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
386	2	\N	2023-02-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
387	2	\N	2023-02-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
388	2	\N	2023-02-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
389	2	\N	2023-02-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
390	2	\N	2023-02-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
391	2	\N	2023-02-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
392	2	\N	2023-02-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
393	2	\N	2023-02-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
394	2	\N	2023-02-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
395	2	\N	2023-02-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
396	2	\N	2023-02-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
398	2	\N	2023-02-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
399	2	\N	2023-02-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
400	2	\N	2023-02-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
401	2	\N	2023-02-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
402	2	\N	2023-02-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
403	2	\N	2023-02-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
404	2	\N	2023-02-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
405	2	\N	2023-02-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
406	2	\N	2023-02-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
407	2	\N	2023-02-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
408	2	\N	2023-03-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
409	2	\N	2023-03-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
410	2	\N	2023-03-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
411	2	\N	2023-03-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
412	2	\N	2023-03-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
413	2	\N	2023-03-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
414	2	\N	2023-03-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
415	2	\N	2023-03-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
416	2	\N	2023-03-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
417	2	\N	2023-03-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
418	2	\N	2023-03-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
419	2	\N	2023-03-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
420	2	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
421	2	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
422	2	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
423	2	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
424	2	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
425	2	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
426	2	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
427	2	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
428	2	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
431	2	\N	2023-03-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
432	2	\N	2023-03-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
433	2	\N	2023-03-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
434	2	\N	2023-03-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
435	2	\N	2023-03-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
436	2	\N	2023-03-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
437	2	\N	2023-03-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
438	2	\N	2023-03-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
439	2	\N	2023-04-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
440	2	\N	2023-04-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
370	2	\N	2023-01-22	1	Approved	t	National Holiday	Tahun Baru Imlek	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
397	2	\N	2023-02-18	1	Approved	t	National Holiday	Isra Mikraj Nabi Muhammad	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
429	2	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
441	2	\N	2023-04-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
442	2	\N	2023-04-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
443	2	\N	2023-04-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
444	2	\N	2023-04-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
446	2	\N	2023-04-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
448	2	\N	2023-04-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
449	2	\N	2023-04-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
450	2	\N	2023-04-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
451	2	\N	2023-04-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
452	2	\N	2023-04-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
453	2	\N	2023-04-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
454	2	\N	2023-04-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
455	2	\N	2023-04-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
456	2	\N	2023-04-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
457	2	\N	2023-04-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
458	2	\N	2023-04-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
465	2	\N	2023-04-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
466	2	\N	2023-04-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
467	2	\N	2023-04-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
468	2	\N	2023-04-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
470	2	\N	2023-05-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
471	2	\N	2023-05-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
472	2	\N	2023-05-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
473	2	\N	2023-05-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
474	2	\N	2023-05-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
475	2	\N	2023-05-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
476	2	\N	2023-05-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
477	2	\N	2023-05-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
478	2	\N	2023-05-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
479	2	\N	2023-05-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
480	2	\N	2023-05-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
481	2	\N	2023-05-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
482	2	\N	2023-05-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
483	2	\N	2023-05-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
484	2	\N	2023-05-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
485	2	\N	2023-05-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
487	2	\N	2023-05-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
488	2	\N	2023-05-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
489	2	\N	2023-05-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
490	2	\N	2023-05-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
491	2	\N	2023-05-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
492	2	\N	2023-05-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
493	2	\N	2023-05-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
494	2	\N	2023-05-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
495	2	\N	2023-05-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
496	2	\N	2023-05-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
497	2	\N	2023-05-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
498	2	\N	2023-05-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
499	2	\N	2023-05-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
502	2	\N	2023-06-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
504	2	\N	2023-06-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
505	2	\N	2023-06-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
506	2	\N	2023-06-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
507	2	\N	2023-06-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
508	2	\N	2023-06-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
509	2	\N	2023-06-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
510	2	\N	2023-06-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
511	2	\N	2023-06-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
512	2	\N	2023-06-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
513	2	\N	2023-06-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
514	2	\N	2023-06-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
515	2	\N	2023-06-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
516	2	\N	2023-06-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
517	2	\N	2023-06-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
518	2	\N	2023-06-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
519	2	\N	2023-06-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
520	2	\N	2023-06-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
521	2	\N	2023-06-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
522	2	\N	2023-06-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
523	2	\N	2023-06-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
524	2	\N	2023-06-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
525	2	\N	2023-06-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
526	2	\N	2023-06-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
527	2	\N	2023-06-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
447	2	\N	2023-04-09	1	Approved	t	National Holiday	Hari Paskah	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
459	2	\N	2023-04-21	1	Approved	t	National Holiday	Hari Kartini	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
461	2	\N	2023-04-23	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
462	2	\N	2023-04-24	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
464	2	\N	2023-04-26	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
469	2	\N	2023-05-01	1	Approved	t	National Holiday	Hari Buruh Internasional / Pekerja	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
500	2	\N	2023-06-01	1	Approved	t	National Holiday	Hari Lahir Pancasila	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
501	2	\N	2023-06-02	1	Approved	t	National Holiday	Cuti Bersama Waisak	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
528	2	\N	2023-06-29	1	Approved	t	National Holiday	Idul Adha (Lebaran Haji)	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
529	2	\N	2023-06-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
530	2	\N	2023-07-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
531	2	\N	2023-07-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
532	2	\N	2023-07-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
533	2	\N	2023-07-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
534	2	\N	2023-07-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
535	2	\N	2023-07-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
536	2	\N	2023-07-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
537	2	\N	2023-07-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
538	2	\N	2023-07-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
539	2	\N	2023-07-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
540	2	\N	2023-07-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
541	2	\N	2023-07-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
542	2	\N	2023-07-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
543	2	\N	2023-07-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
544	2	\N	2023-07-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
545	2	\N	2023-07-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
546	2	\N	2023-07-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
547	2	\N	2023-07-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
549	2	\N	2023-07-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
550	2	\N	2023-07-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
551	2	\N	2023-07-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
552	2	\N	2023-07-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
553	2	\N	2023-07-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
554	2	\N	2023-07-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
555	2	\N	2023-07-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
556	2	\N	2023-07-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
557	2	\N	2023-07-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
558	2	\N	2023-07-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
559	2	\N	2023-07-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
560	2	\N	2023-07-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
561	2	\N	2023-08-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
562	2	\N	2023-08-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
563	2	\N	2023-08-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
564	2	\N	2023-08-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
565	2	\N	2023-08-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
566	2	\N	2023-08-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
567	2	\N	2023-08-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
568	2	\N	2023-08-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
569	2	\N	2023-08-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
570	2	\N	2023-08-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
571	2	\N	2023-08-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
572	2	\N	2023-08-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
573	2	\N	2023-08-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
574	2	\N	2023-08-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
575	2	\N	2023-08-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
576	2	\N	2023-08-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
578	2	\N	2023-08-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
579	2	\N	2023-08-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
580	2	\N	2023-08-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
581	2	\N	2023-08-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
582	2	\N	2023-08-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
583	2	\N	2023-08-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
584	2	\N	2023-08-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
585	2	\N	2023-08-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
586	2	\N	2023-08-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
587	2	\N	2023-08-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
588	2	\N	2023-08-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
589	2	\N	2023-08-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
590	2	\N	2023-08-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
591	2	\N	2023-08-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
592	2	\N	2023-09-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
593	2	\N	2023-09-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
594	2	\N	2023-09-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
595	2	\N	2023-09-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
596	2	\N	2023-09-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
597	2	\N	2023-09-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
598	2	\N	2023-09-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
599	2	\N	2023-09-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
600	2	\N	2023-09-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
601	2	\N	2023-09-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
602	2	\N	2023-09-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
603	2	\N	2023-09-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
604	2	\N	2023-09-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
605	2	\N	2023-09-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
606	2	\N	2023-09-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
607	2	\N	2023-09-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
608	2	\N	2023-09-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
609	2	\N	2023-09-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
610	2	\N	2023-09-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
611	2	\N	2023-09-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
612	2	\N	2023-09-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
613	2	\N	2023-09-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
614	2	\N	2023-09-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
615	2	\N	2023-09-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
616	2	\N	2023-09-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
577	2	\N	2023-08-17	1	Approved	t	National Holiday	Hari Proklamasi Kemerdekaan R.I.	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
617	2	\N	2023-09-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
618	2	\N	2023-09-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
620	2	\N	2023-09-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
621	2	\N	2023-09-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
622	2	\N	2023-10-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
624	2	\N	2023-10-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
625	2	\N	2023-10-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
626	2	\N	2023-10-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
627	2	\N	2023-10-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
628	2	\N	2023-10-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
629	2	\N	2023-10-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
630	2	\N	2023-10-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
631	2	\N	2023-10-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
632	2	\N	2023-10-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
633	2	\N	2023-10-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
634	2	\N	2023-10-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
635	2	\N	2023-10-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
636	2	\N	2023-10-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
637	2	\N	2023-10-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
638	2	\N	2023-10-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
639	2	\N	2023-10-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
640	2	\N	2023-10-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
641	2	\N	2023-10-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
642	2	\N	2023-10-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
643	2	\N	2023-10-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
644	2	\N	2023-10-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
645	2	\N	2023-10-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
646	2	\N	2023-10-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
647	2	\N	2023-10-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
648	2	\N	2023-10-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
649	2	\N	2023-10-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
650	2	\N	2023-10-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
651	2	\N	2023-10-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
652	2	\N	2023-10-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
653	2	\N	2023-11-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
654	2	\N	2023-11-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
655	2	\N	2023-11-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
656	2	\N	2023-11-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
657	2	\N	2023-11-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
658	2	\N	2023-11-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
659	2	\N	2023-11-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
660	2	\N	2023-11-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
661	2	\N	2023-11-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
662	2	\N	2023-11-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
663	2	\N	2023-11-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
665	2	\N	2023-11-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
666	2	\N	2023-11-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
667	2	\N	2023-11-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
668	2	\N	2023-11-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
669	2	\N	2023-11-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
670	2	\N	2023-11-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
671	2	\N	2023-11-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
672	2	\N	2023-11-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
673	2	\N	2023-11-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
674	2	\N	2023-11-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
675	2	\N	2023-11-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
676	2	\N	2023-11-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
678	2	\N	2023-11-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
679	2	\N	2023-11-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
680	2	\N	2023-11-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
681	2	\N	2023-11-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
682	2	\N	2023-11-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
683	2	\N	2023-12-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
684	2	\N	2023-12-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
685	2	\N	2023-12-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
686	2	\N	2023-12-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
687	2	\N	2023-12-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
688	2	\N	2023-12-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
689	2	\N	2023-12-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
690	2	\N	2023-12-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
691	2	\N	2023-12-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
692	2	\N	2023-12-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
693	2	\N	2023-12-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
694	2	\N	2023-12-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
695	2	\N	2023-12-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
696	2	\N	2023-12-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
697	2	\N	2023-12-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
698	2	\N	2023-12-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
699	2	\N	2023-12-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
700	2	\N	2023-12-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
701	2	\N	2023-12-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
702	2	\N	2023-12-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
703	2	\N	2023-12-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
623	2	\N	2023-10-02	1	Approved	t	National Holiday	Hari Batik	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
664	2	\N	2023-11-12	1	Approved	t	National Holiday	Diwali / Deepavali	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
704	2	\N	2023-12-22	1	Approved	t	National Holiday	Hari Ibu	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
705	2	\N	2023-12-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
709	2	\N	2023-12-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
710	2	\N	2023-12-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
711	2	\N	2023-12-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
712	2	\N	2023-12-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
715	2	\N	2024-01-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
716	2	\N	2024-01-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
717	2	\N	2024-01-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
718	2	\N	2024-01-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
719	2	\N	2024-01-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
720	2	\N	2024-01-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
721	2	\N	2024-01-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
722	2	\N	2024-01-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
723	2	\N	2024-01-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
724	2	\N	2024-01-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
725	2	\N	2024-01-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
726	2	\N	2024-01-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
727	2	\N	2024-01-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
728	2	\N	2024-01-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
729	2	\N	2024-01-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
730	2	\N	2024-01-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
731	2	\N	2024-01-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
732	2	\N	2024-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:07	2023-01-19 10:49:07
733	3	\N	2023-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
734	3	\N	2023-01-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
735	3	\N	2023-01-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
738	3	\N	2023-01-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
739	3	\N	2023-01-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
740	3	\N	2023-01-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
741	3	\N	2023-01-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
742	3	\N	2023-01-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
743	3	\N	2023-01-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
744	3	\N	2023-01-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
745	3	\N	2023-01-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
746	3	\N	2023-02-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
747	3	\N	2023-02-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
748	3	\N	2023-02-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
749	3	\N	2023-02-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
750	3	\N	2023-02-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
751	3	\N	2023-02-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
752	3	\N	2023-02-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
753	3	\N	2023-02-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
754	3	\N	2023-02-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
755	3	\N	2023-02-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
756	3	\N	2023-02-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
757	3	\N	2023-02-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
758	3	\N	2023-02-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
759	3	\N	2023-02-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
760	3	\N	2023-02-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
761	3	\N	2023-02-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
762	3	\N	2023-02-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
764	3	\N	2023-02-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
765	3	\N	2023-02-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
766	3	\N	2023-02-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
767	3	\N	2023-02-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
768	3	\N	2023-02-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
769	3	\N	2023-02-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
770	3	\N	2023-02-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
771	3	\N	2023-02-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
772	3	\N	2023-02-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
773	3	\N	2023-02-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
774	3	\N	2023-03-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
775	3	\N	2023-03-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
776	3	\N	2023-03-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
777	3	\N	2023-03-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
778	3	\N	2023-03-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
779	3	\N	2023-03-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
780	3	\N	2023-03-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
781	3	\N	2023-03-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
782	3	\N	2023-03-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
783	3	\N	2023-03-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
784	3	\N	2023-03-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
785	3	\N	2023-03-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
786	3	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
787	3	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
788	3	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
789	3	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
790	3	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
791	3	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
792	3	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
707	2	\N	2023-12-25	1	Approved	t	National Holiday	Hari Raya Natal	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
713	2	\N	2023-12-31	1	Approved	t	National Holiday	Malam Tahun Baru	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
714	2	\N	2024-01-01	1	Approved	t	National Holiday	Hari Tahun Baru	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
736	3	\N	2023-01-22	1	Approved	t	National Holiday	Tahun Baru Imlek	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
763	3	\N	2023-02-18	1	Approved	t	National Holiday	Isra Mikraj Nabi Muhammad	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
793	3	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
794	3	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
797	3	\N	2023-03-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
798	3	\N	2023-03-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
799	3	\N	2023-03-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
800	3	\N	2023-03-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
801	3	\N	2023-03-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
802	3	\N	2023-03-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
803	3	\N	2023-03-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
804	3	\N	2023-03-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
805	3	\N	2023-04-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
806	3	\N	2023-04-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
807	3	\N	2023-04-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
808	3	\N	2023-04-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
809	3	\N	2023-04-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
810	3	\N	2023-04-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
812	3	\N	2023-04-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
814	3	\N	2023-04-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
815	3	\N	2023-04-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
816	3	\N	2023-04-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
817	3	\N	2023-04-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
818	3	\N	2023-04-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
819	3	\N	2023-04-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
820	3	\N	2023-04-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
821	3	\N	2023-04-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
822	3	\N	2023-04-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
823	3	\N	2023-04-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
824	3	\N	2023-04-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
831	3	\N	2023-04-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
832	3	\N	2023-04-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
833	3	\N	2023-04-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
834	3	\N	2023-04-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
836	3	\N	2023-05-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
837	3	\N	2023-05-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
838	3	\N	2023-05-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
839	3	\N	2023-05-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
840	3	\N	2023-05-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
841	3	\N	2023-05-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
842	3	\N	2023-05-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
843	3	\N	2023-05-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
844	3	\N	2023-05-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
845	3	\N	2023-05-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
846	3	\N	2023-05-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
847	3	\N	2023-05-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
848	3	\N	2023-05-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
849	3	\N	2023-05-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
850	3	\N	2023-05-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
851	3	\N	2023-05-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
853	3	\N	2023-05-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
854	3	\N	2023-05-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
855	3	\N	2023-05-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
856	3	\N	2023-05-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
857	3	\N	2023-05-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
858	3	\N	2023-05-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
859	3	\N	2023-05-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
860	3	\N	2023-05-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
861	3	\N	2023-05-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
862	3	\N	2023-05-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
863	3	\N	2023-05-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
864	3	\N	2023-05-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
865	3	\N	2023-05-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
868	3	\N	2023-06-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
870	3	\N	2023-06-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
871	3	\N	2023-06-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
872	3	\N	2023-06-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
873	3	\N	2023-06-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
874	3	\N	2023-06-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
875	3	\N	2023-06-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
876	3	\N	2023-06-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
877	3	\N	2023-06-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
878	3	\N	2023-06-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
879	3	\N	2023-06-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
880	3	\N	2023-06-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
811	3	\N	2023-04-07	1	Approved	t	National Holiday	Wafat Isa Almasih	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
813	3	\N	2023-04-09	1	Approved	t	National Holiday	Hari Paskah	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
825	3	\N	2023-04-21	1	Approved	t	National Holiday	Hari Kartini	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
826	3	\N	2023-04-22	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
828	3	\N	2023-04-24	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
829	3	\N	2023-04-25	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
835	3	\N	2023-05-01	1	Approved	t	National Holiday	Hari Buruh Internasional / Pekerja	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
852	3	\N	2023-05-18	1	Approved	t	National Holiday	Kenaikan Isa Al Masih	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
867	3	\N	2023-06-02	1	Approved	t	National Holiday	Cuti Bersama Waisak	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
869	3	\N	2023-06-04	1	Approved	t	National Holiday	Hari Raya Waisak	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
881	3	\N	2023-06-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
882	3	\N	2023-06-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
883	3	\N	2023-06-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
884	3	\N	2023-06-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
885	3	\N	2023-06-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
886	3	\N	2023-06-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
887	3	\N	2023-06-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
888	3	\N	2023-06-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
889	3	\N	2023-06-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
890	3	\N	2023-06-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
891	3	\N	2023-06-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
892	3	\N	2023-06-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
893	3	\N	2023-06-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
895	3	\N	2023-06-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
896	3	\N	2023-07-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
897	3	\N	2023-07-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
898	3	\N	2023-07-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
899	3	\N	2023-07-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
900	3	\N	2023-07-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
901	3	\N	2023-07-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
902	3	\N	2023-07-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
903	3	\N	2023-07-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
904	3	\N	2023-07-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
905	3	\N	2023-07-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
906	3	\N	2023-07-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
907	3	\N	2023-07-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
908	3	\N	2023-07-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
909	3	\N	2023-07-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
910	3	\N	2023-07-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
911	3	\N	2023-07-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
912	3	\N	2023-07-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
913	3	\N	2023-07-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
915	3	\N	2023-07-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
916	3	\N	2023-07-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
917	3	\N	2023-07-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
918	3	\N	2023-07-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
919	3	\N	2023-07-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
920	3	\N	2023-07-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
921	3	\N	2023-07-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
922	3	\N	2023-07-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
923	3	\N	2023-07-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
924	3	\N	2023-07-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
925	3	\N	2023-07-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
926	3	\N	2023-07-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
927	3	\N	2023-08-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
928	3	\N	2023-08-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
929	3	\N	2023-08-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
930	3	\N	2023-08-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
931	3	\N	2023-08-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
932	3	\N	2023-08-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
933	3	\N	2023-08-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
934	3	\N	2023-08-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
935	3	\N	2023-08-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
936	3	\N	2023-08-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
937	3	\N	2023-08-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
938	3	\N	2023-08-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
939	3	\N	2023-08-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
940	3	\N	2023-08-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
941	3	\N	2023-08-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
942	3	\N	2023-08-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
944	3	\N	2023-08-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
945	3	\N	2023-08-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
946	3	\N	2023-08-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
947	3	\N	2023-08-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
948	3	\N	2023-08-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
949	3	\N	2023-08-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
950	3	\N	2023-08-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
951	3	\N	2023-08-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
952	3	\N	2023-08-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
953	3	\N	2023-08-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
954	3	\N	2023-08-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
955	3	\N	2023-08-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
956	3	\N	2023-08-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
957	3	\N	2023-08-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
958	3	\N	2023-09-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
959	3	\N	2023-09-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
960	3	\N	2023-09-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
961	3	\N	2023-09-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
962	3	\N	2023-09-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
963	3	\N	2023-09-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
964	3	\N	2023-09-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
965	3	\N	2023-09-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
966	3	\N	2023-09-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
967	3	\N	2023-09-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
968	3	\N	2023-09-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
914	3	\N	2023-07-19	1	Approved	t	National Holiday	Satu Muharam / Tahun Baru Hijriah	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
969	3	\N	2023-09-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
970	3	\N	2023-09-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
971	3	\N	2023-09-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
972	3	\N	2023-09-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
973	3	\N	2023-09-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
974	3	\N	2023-09-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
975	3	\N	2023-09-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
976	3	\N	2023-09-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
977	3	\N	2023-09-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
978	3	\N	2023-09-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
979	3	\N	2023-09-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
980	3	\N	2023-09-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
981	3	\N	2023-09-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
982	3	\N	2023-09-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
983	3	\N	2023-09-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
984	3	\N	2023-09-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
986	3	\N	2023-09-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
987	3	\N	2023-09-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
988	3	\N	2023-10-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
990	3	\N	2023-10-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
991	3	\N	2023-10-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
992	3	\N	2023-10-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
993	3	\N	2023-10-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
994	3	\N	2023-10-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
995	3	\N	2023-10-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
996	3	\N	2023-10-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
997	3	\N	2023-10-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
998	3	\N	2023-10-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
999	3	\N	2023-10-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1000	3	\N	2023-10-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1001	3	\N	2023-10-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1002	3	\N	2023-10-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1003	3	\N	2023-10-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1004	3	\N	2023-10-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1005	3	\N	2023-10-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1006	3	\N	2023-10-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1007	3	\N	2023-10-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1008	3	\N	2023-10-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1009	3	\N	2023-10-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1010	3	\N	2023-10-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1011	3	\N	2023-10-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1012	3	\N	2023-10-25	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1013	3	\N	2023-10-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1014	3	\N	2023-10-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1015	3	\N	2023-10-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1016	3	\N	2023-10-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1017	3	\N	2023-10-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1018	3	\N	2023-10-31	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1019	3	\N	2023-11-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1020	3	\N	2023-11-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1021	3	\N	2023-11-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1022	3	\N	2023-11-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1023	3	\N	2023-11-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1024	3	\N	2023-11-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1025	3	\N	2023-11-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1026	3	\N	2023-11-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1027	3	\N	2023-11-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1028	3	\N	2023-11-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1029	3	\N	2023-11-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1031	3	\N	2023-11-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1032	3	\N	2023-11-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1033	3	\N	2023-11-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1034	3	\N	2023-11-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1035	3	\N	2023-11-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1036	3	\N	2023-11-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1037	3	\N	2023-11-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1038	3	\N	2023-11-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1039	3	\N	2023-11-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1040	3	\N	2023-11-22	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1041	3	\N	2023-11-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1042	3	\N	2023-11-24	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1044	3	\N	2023-11-26	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1045	3	\N	2023-11-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1046	3	\N	2023-11-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1047	3	\N	2023-11-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1048	3	\N	2023-11-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1049	3	\N	2023-12-01	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1050	3	\N	2023-12-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1051	3	\N	2023-12-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1052	3	\N	2023-12-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1053	3	\N	2023-12-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1054	3	\N	2023-12-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1055	3	\N	2023-12-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1056	3	\N	2023-12-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
989	3	\N	2023-10-02	1	Approved	t	National Holiday	Hari Batik	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
1030	3	\N	2023-11-12	1	Approved	t	National Holiday	Diwali / Deepavali	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
1057	3	\N	2023-12-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1058	3	\N	2023-12-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1059	3	\N	2023-12-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1060	3	\N	2023-12-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1061	3	\N	2023-12-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1062	3	\N	2023-12-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1063	3	\N	2023-12-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1064	3	\N	2023-12-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1065	3	\N	2023-12-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1066	3	\N	2023-12-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1067	3	\N	2023-12-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1068	3	\N	2023-12-20	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1069	3	\N	2023-12-21	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1071	3	\N	2023-12-23	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1075	3	\N	2023-12-27	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1076	3	\N	2023-12-28	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1077	3	\N	2023-12-29	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1078	3	\N	2023-12-30	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1081	3	\N	2024-01-02	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1082	3	\N	2024-01-03	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1083	3	\N	2024-01-04	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1084	3	\N	2024-01-05	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1085	3	\N	2024-01-06	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1086	3	\N	2024-01-07	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1087	3	\N	2024-01-08	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1088	3	\N	2024-01-09	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1089	3	\N	2024-01-10	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1090	3	\N	2024-01-11	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1091	3	\N	2024-01-12	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1092	3	\N	2024-01-13	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1093	3	\N	2024-01-14	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1094	3	\N	2024-01-15	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1095	3	\N	2024-01-16	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1096	3	\N	2024-01-17	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1097	3	\N	2024-01-18	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
1098	3	\N	2024-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 10:49:47	2023-01-19 10:49:47
22	1	\N	2022-12-22	1	Approved	t	National Holiday	Hari Ibu	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
31	1	\N	2022-12-31	1	Approved	t	National Holiday	Malam Tahun Baru	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
54	1	\N	2023-01-23	1	Approved	t	National Holiday	Lunar New Year Joint Holiday	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
112	1	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
113	1	\N	2023-03-23	1	Approved	t	National Holiday	Joint Holiday for Bali's Day of Silence and Hindu New Year (Nyepi)	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
144	1	\N	2023-04-23	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
147	1	\N	2023-04-26	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
183	1	\N	2023-06-01	1	Approved	t	National Holiday	Hari Lahir Pancasila	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
211	1	\N	2023-06-29	1	Approved	t	National Holiday	Idul Adha (Lebaran Haji)	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
260	1	\N	2023-08-17	1	Approved	t	National Holiday	Hari Proklamasi Kemerdekaan R.I.	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
302	1	\N	2023-09-28	1	Approved	t	National Holiday	Maulid Nabi Muhammad	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
360	1	\N	2023-11-25	1	Approved	t	National Holiday	Hari Guru	t	2	2023-01-19 10:48:03	2023-01-19 10:51:08
371	2	\N	2023-01-23	1	Approved	t	National Holiday	Lunar New Year Joint Holiday	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
430	2	\N	2023-03-23	1	Approved	t	National Holiday	Joint Holiday for Bali's Day of Silence and Hindu New Year (Nyepi)	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
445	2	\N	2023-04-07	1	Approved	t	National Holiday	Wafat Isa Almasih	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
460	2	\N	2023-04-22	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
463	2	\N	2023-04-25	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
486	2	\N	2023-05-18	1	Approved	t	National Holiday	Kenaikan Isa Al Masih	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
503	2	\N	2023-06-04	1	Approved	t	National Holiday	Hari Raya Waisak	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
548	2	\N	2023-07-19	1	Approved	t	National Holiday	Satu Muharam / Tahun Baru Hijriah	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
619	2	\N	2023-09-28	1	Approved	t	National Holiday	Maulid Nabi Muhammad	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
677	2	\N	2023-11-25	1	Approved	t	National Holiday	Hari Guru	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
706	2	\N	2023-12-24	1	Approved	t	National Holiday	Malam Natal	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
708	2	\N	2023-12-26	1	Approved	t	National Holiday	Cuti Bersama Natal (Hari Tinju)	t	2	2023-01-19 10:49:07	2023-01-19 10:51:08
737	3	\N	2023-01-23	1	Approved	t	National Holiday	Lunar New Year Joint Holiday	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
795	3	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
796	3	\N	2023-03-23	1	Approved	t	National Holiday	Joint Holiday for Bali's Day of Silence and Hindu New Year (Nyepi)	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
827	3	\N	2023-04-23	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
830	3	\N	2023-04-26	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
866	3	\N	2023-06-01	1	Approved	t	National Holiday	Hari Lahir Pancasila	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
894	3	\N	2023-06-29	1	Approved	t	National Holiday	Idul Adha (Lebaran Haji)	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
943	3	\N	2023-08-17	1	Approved	t	National Holiday	Hari Proklamasi Kemerdekaan R.I.	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
1073	3	\N	2023-12-25	1	Approved	t	National Holiday	Hari Raya Natal	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
1074	3	\N	2023-12-26	1	Approved	t	National Holiday	Cuti Bersama Natal (Hari Tinju)	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
1080	3	\N	2024-01-01	1	Approved	t	National Holiday	Hari Tahun Baru	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
985	3	\N	2023-09-28	1	Approved	t	National Holiday	Maulid Nabi Muhammad	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
1043	3	\N	2023-11-25	1	Approved	t	National Holiday	Hari Guru	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
1070	3	\N	2023-12-22	1	Approved	t	National Holiday	Hari Ibu	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
1072	3	\N	2023-12-24	1	Approved	t	National Holiday	Malam Natal	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
1079	3	\N	2023-12-31	1	Approved	t	National Holiday	Malam Tahun Baru	t	2	2023-01-19 10:49:47	2023-01-19 10:51:08
1099	4	\N	2023-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1100	4	\N	2023-01-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1101	4	\N	2023-01-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1104	4	\N	2023-01-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1105	4	\N	2023-01-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1106	4	\N	2023-01-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1107	4	\N	2023-01-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1108	4	\N	2023-01-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1109	4	\N	2023-01-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1110	4	\N	2023-01-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1111	4	\N	2023-01-31	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1112	4	\N	2023-02-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1113	4	\N	2023-02-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1114	4	\N	2023-02-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1115	4	\N	2023-02-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1116	4	\N	2023-02-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1117	4	\N	2023-02-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1118	4	\N	2023-02-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1119	4	\N	2023-02-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1120	4	\N	2023-02-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1121	4	\N	2023-02-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1122	4	\N	2023-02-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1123	4	\N	2023-02-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1124	4	\N	2023-02-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1125	4	\N	2023-02-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1126	4	\N	2023-02-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1127	4	\N	2023-02-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1128	4	\N	2023-02-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1130	4	\N	2023-02-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1131	4	\N	2023-02-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1132	4	\N	2023-02-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1133	4	\N	2023-02-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1134	4	\N	2023-02-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1135	4	\N	2023-02-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1136	4	\N	2023-02-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1137	4	\N	2023-02-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1138	4	\N	2023-02-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1139	4	\N	2023-02-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1140	4	\N	2023-03-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1141	4	\N	2023-03-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1142	4	\N	2023-03-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1143	4	\N	2023-03-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1144	4	\N	2023-03-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1145	4	\N	2023-03-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1146	4	\N	2023-03-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1147	4	\N	2023-03-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1148	4	\N	2023-03-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1149	4	\N	2023-03-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1150	4	\N	2023-03-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1151	4	\N	2023-03-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1152	4	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1153	4	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1154	4	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1155	4	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1156	4	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1157	4	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1158	4	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1159	4	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1160	4	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1163	4	\N	2023-03-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1164	4	\N	2023-03-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1165	4	\N	2023-03-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1166	4	\N	2023-03-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1167	4	\N	2023-03-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1168	4	\N	2023-03-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1169	4	\N	2023-03-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1170	4	\N	2023-03-31	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1171	4	\N	2023-04-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1172	4	\N	2023-04-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1173	4	\N	2023-04-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1174	4	\N	2023-04-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1175	4	\N	2023-04-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1176	4	\N	2023-04-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1178	4	\N	2023-04-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1180	4	\N	2023-04-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1181	4	\N	2023-04-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1182	4	\N	2023-04-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1183	4	\N	2023-04-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1184	4	\N	2023-04-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1185	4	\N	2023-04-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1186	4	\N	2023-04-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1187	4	\N	2023-04-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1188	4	\N	2023-04-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1189	4	\N	2023-04-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1190	4	\N	2023-04-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1197	4	\N	2023-04-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1198	4	\N	2023-04-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1199	4	\N	2023-04-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1161	4	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1177	4	\N	2023-04-07	1	Approved	t	National Holiday	Wafat Isa Almasih	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1179	4	\N	2023-04-09	1	Approved	t	National Holiday	Hari Paskah	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1191	4	\N	2023-04-21	1	Approved	t	National Holiday	Hari Kartini	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1193	4	\N	2023-04-23	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1194	4	\N	2023-04-24	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1196	4	\N	2023-04-26	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1200	4	\N	2023-04-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1202	4	\N	2023-05-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1203	4	\N	2023-05-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1204	4	\N	2023-05-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1205	4	\N	2023-05-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1206	4	\N	2023-05-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1207	4	\N	2023-05-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1208	4	\N	2023-05-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1209	4	\N	2023-05-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1210	4	\N	2023-05-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1211	4	\N	2023-05-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1212	4	\N	2023-05-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1213	4	\N	2023-05-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1214	4	\N	2023-05-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1215	4	\N	2023-05-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1216	4	\N	2023-05-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1217	4	\N	2023-05-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1219	4	\N	2023-05-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1220	4	\N	2023-05-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1221	4	\N	2023-05-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1222	4	\N	2023-05-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1223	4	\N	2023-05-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1224	4	\N	2023-05-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1225	4	\N	2023-05-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1226	4	\N	2023-05-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1227	4	\N	2023-05-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1228	4	\N	2023-05-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1229	4	\N	2023-05-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1230	4	\N	2023-05-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1231	4	\N	2023-05-31	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1234	4	\N	2023-06-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1236	4	\N	2023-06-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1237	4	\N	2023-06-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1238	4	\N	2023-06-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1239	4	\N	2023-06-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1240	4	\N	2023-06-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1241	4	\N	2023-06-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1242	4	\N	2023-06-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1243	4	\N	2023-06-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1244	4	\N	2023-06-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1245	4	\N	2023-06-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1246	4	\N	2023-06-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1247	4	\N	2023-06-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1248	4	\N	2023-06-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1249	4	\N	2023-06-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1250	4	\N	2023-06-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1251	4	\N	2023-06-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1252	4	\N	2023-06-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1253	4	\N	2023-06-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1254	4	\N	2023-06-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1255	4	\N	2023-06-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1256	4	\N	2023-06-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1257	4	\N	2023-06-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1258	4	\N	2023-06-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1259	4	\N	2023-06-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1261	4	\N	2023-06-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1262	4	\N	2023-07-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1263	4	\N	2023-07-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1264	4	\N	2023-07-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1265	4	\N	2023-07-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1266	4	\N	2023-07-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1267	4	\N	2023-07-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1268	4	\N	2023-07-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1269	4	\N	2023-07-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1270	4	\N	2023-07-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1271	4	\N	2023-07-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1272	4	\N	2023-07-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1273	4	\N	2023-07-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1274	4	\N	2023-07-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1275	4	\N	2023-07-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1276	4	\N	2023-07-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1277	4	\N	2023-07-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1278	4	\N	2023-07-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1279	4	\N	2023-07-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1281	4	\N	2023-07-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1282	4	\N	2023-07-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1283	4	\N	2023-07-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1284	4	\N	2023-07-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1285	4	\N	2023-07-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1286	4	\N	2023-07-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1287	4	\N	2023-07-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1218	4	\N	2023-05-18	1	Approved	t	National Holiday	Kenaikan Isa Al Masih	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1233	4	\N	2023-06-02	1	Approved	t	National Holiday	Cuti Bersama Waisak	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1235	4	\N	2023-06-04	1	Approved	t	National Holiday	Hari Raya Waisak	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1260	4	\N	2023-06-29	1	Approved	t	National Holiday	Idul Adha (Lebaran Haji)	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1288	4	\N	2023-07-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1289	4	\N	2023-07-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1290	4	\N	2023-07-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1291	4	\N	2023-07-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1292	4	\N	2023-07-31	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1293	4	\N	2023-08-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1294	4	\N	2023-08-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1295	4	\N	2023-08-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1296	4	\N	2023-08-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1297	4	\N	2023-08-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1298	4	\N	2023-08-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1299	4	\N	2023-08-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1300	4	\N	2023-08-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1301	4	\N	2023-08-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1302	4	\N	2023-08-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1303	4	\N	2023-08-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1304	4	\N	2023-08-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1305	4	\N	2023-08-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1306	4	\N	2023-08-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1307	4	\N	2023-08-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1308	4	\N	2023-08-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1310	4	\N	2023-08-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1311	4	\N	2023-08-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1312	4	\N	2023-08-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1313	4	\N	2023-08-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1314	4	\N	2023-08-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1315	4	\N	2023-08-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1316	4	\N	2023-08-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1317	4	\N	2023-08-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1318	4	\N	2023-08-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1319	4	\N	2023-08-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1320	4	\N	2023-08-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1321	4	\N	2023-08-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1322	4	\N	2023-08-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1323	4	\N	2023-08-31	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1324	4	\N	2023-09-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1325	4	\N	2023-09-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1326	4	\N	2023-09-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1327	4	\N	2023-09-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1328	4	\N	2023-09-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1329	4	\N	2023-09-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1330	4	\N	2023-09-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1331	4	\N	2023-09-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1332	4	\N	2023-09-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1333	4	\N	2023-09-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1334	4	\N	2023-09-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1335	4	\N	2023-09-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1336	4	\N	2023-09-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1337	4	\N	2023-09-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1338	4	\N	2023-09-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1339	4	\N	2023-09-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1340	4	\N	2023-09-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1341	4	\N	2023-09-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1342	4	\N	2023-09-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1343	4	\N	2023-09-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1344	4	\N	2023-09-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1345	4	\N	2023-09-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1346	4	\N	2023-09-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1347	4	\N	2023-09-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1348	4	\N	2023-09-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1349	4	\N	2023-09-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1350	4	\N	2023-09-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1352	4	\N	2023-09-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1353	4	\N	2023-09-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1354	4	\N	2023-10-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1356	4	\N	2023-10-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1357	4	\N	2023-10-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1358	4	\N	2023-10-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1359	4	\N	2023-10-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1360	4	\N	2023-10-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1361	4	\N	2023-10-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1362	4	\N	2023-10-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1363	4	\N	2023-10-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1364	4	\N	2023-10-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1365	4	\N	2023-10-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1366	4	\N	2023-10-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1367	4	\N	2023-10-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1368	4	\N	2023-10-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1369	4	\N	2023-10-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1370	4	\N	2023-10-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1371	4	\N	2023-10-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1372	4	\N	2023-10-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1373	4	\N	2023-10-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1374	4	\N	2023-10-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1375	4	\N	2023-10-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1351	4	\N	2023-09-28	1	Approved	t	National Holiday	Maulid Nabi Muhammad	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1355	4	\N	2023-10-02	1	Approved	t	National Holiday	Hari Batik	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1376	4	\N	2023-10-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1377	4	\N	2023-10-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1378	4	\N	2023-10-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1379	4	\N	2023-10-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1380	4	\N	2023-10-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1381	4	\N	2023-10-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1382	4	\N	2023-10-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1383	4	\N	2023-10-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1384	4	\N	2023-10-31	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1385	4	\N	2023-11-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1386	4	\N	2023-11-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1387	4	\N	2023-11-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1388	4	\N	2023-11-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1389	4	\N	2023-11-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1390	4	\N	2023-11-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1391	4	\N	2023-11-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1392	4	\N	2023-11-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1393	4	\N	2023-11-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1394	4	\N	2023-11-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1395	4	\N	2023-11-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1397	4	\N	2023-11-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1398	4	\N	2023-11-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1399	4	\N	2023-11-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1400	4	\N	2023-11-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1401	4	\N	2023-11-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1402	4	\N	2023-11-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1403	4	\N	2023-11-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1404	4	\N	2023-11-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1405	4	\N	2023-11-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1406	4	\N	2023-11-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1407	4	\N	2023-11-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1408	4	\N	2023-11-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1410	4	\N	2023-11-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1411	4	\N	2023-11-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1412	4	\N	2023-11-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1413	4	\N	2023-11-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1414	4	\N	2023-11-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1415	4	\N	2023-12-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1416	4	\N	2023-12-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1417	4	\N	2023-12-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1418	4	\N	2023-12-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1419	4	\N	2023-12-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1420	4	\N	2023-12-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1421	4	\N	2023-12-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1422	4	\N	2023-12-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1423	4	\N	2023-12-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1424	4	\N	2023-12-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1425	4	\N	2023-12-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1426	4	\N	2023-12-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1427	4	\N	2023-12-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1428	4	\N	2023-12-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1429	4	\N	2023-12-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1430	4	\N	2023-12-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1431	4	\N	2023-12-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1432	4	\N	2023-12-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1433	4	\N	2023-12-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1434	4	\N	2023-12-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1435	4	\N	2023-12-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1437	4	\N	2023-12-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1441	4	\N	2023-12-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1442	4	\N	2023-12-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1443	4	\N	2023-12-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1444	4	\N	2023-12-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1447	4	\N	2024-01-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1448	4	\N	2024-01-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1449	4	\N	2024-01-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1450	4	\N	2024-01-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1451	4	\N	2024-01-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1452	4	\N	2024-01-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1453	4	\N	2024-01-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1454	4	\N	2024-01-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1455	4	\N	2024-01-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1456	4	\N	2024-01-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1457	4	\N	2024-01-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1458	4	\N	2024-01-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1459	4	\N	2024-01-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1460	4	\N	2024-01-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1461	4	\N	2024-01-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1462	4	\N	2024-01-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1463	4	\N	2024-01-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1409	4	\N	2023-11-25	1	Approved	t	National Holiday	Hari Guru	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1436	4	\N	2023-12-22	1	Approved	t	National Holiday	Hari Ibu	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1439	4	\N	2023-12-25	1	Approved	t	National Holiday	Hari Raya Natal	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1440	4	\N	2023-12-26	1	Approved	t	National Holiday	Cuti Bersama Natal (Hari Tinju)	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1446	4	\N	2024-01-01	1	Approved	t	National Holiday	Hari Tahun Baru	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1464	4	\N	2024-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:25:59	2023-01-19 12:25:59
1465	5	\N	2023-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1466	5	\N	2023-01-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1467	5	\N	2023-01-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1470	5	\N	2023-01-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1471	5	\N	2023-01-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1472	5	\N	2023-01-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1473	5	\N	2023-01-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1474	5	\N	2023-01-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1475	5	\N	2023-01-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1476	5	\N	2023-01-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1477	5	\N	2023-01-31	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1478	5	\N	2023-02-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1479	5	\N	2023-02-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1480	5	\N	2023-02-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1481	5	\N	2023-02-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1482	5	\N	2023-02-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1483	5	\N	2023-02-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1484	5	\N	2023-02-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1485	5	\N	2023-02-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1486	5	\N	2023-02-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1487	5	\N	2023-02-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1488	5	\N	2023-02-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1489	5	\N	2023-02-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1490	5	\N	2023-02-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1491	5	\N	2023-02-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1492	5	\N	2023-02-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1493	5	\N	2023-02-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1494	5	\N	2023-02-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1496	5	\N	2023-02-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1497	5	\N	2023-02-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1498	5	\N	2023-02-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1499	5	\N	2023-02-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1500	5	\N	2023-02-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1501	5	\N	2023-02-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1502	5	\N	2023-02-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1503	5	\N	2023-02-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1504	5	\N	2023-02-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1505	5	\N	2023-02-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1506	5	\N	2023-03-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1507	5	\N	2023-03-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1508	5	\N	2023-03-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1509	5	\N	2023-03-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1510	5	\N	2023-03-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1511	5	\N	2023-03-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1512	5	\N	2023-03-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1513	5	\N	2023-03-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1514	5	\N	2023-03-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1515	5	\N	2023-03-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1516	5	\N	2023-03-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1517	5	\N	2023-03-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1518	5	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1519	5	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1520	5	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1521	5	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1522	5	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1523	5	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1524	5	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1525	5	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1526	5	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1529	5	\N	2023-03-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1530	5	\N	2023-03-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1531	5	\N	2023-03-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1532	5	\N	2023-03-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1533	5	\N	2023-03-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1534	5	\N	2023-03-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1535	5	\N	2023-03-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1536	5	\N	2023-03-31	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1537	5	\N	2023-04-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1538	5	\N	2023-04-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1539	5	\N	2023-04-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1540	5	\N	2023-04-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1541	5	\N	2023-04-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1542	5	\N	2023-04-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1544	5	\N	2023-04-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1546	5	\N	2023-04-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1547	5	\N	2023-04-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1548	5	\N	2023-04-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1549	5	\N	2023-04-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1550	5	\N	2023-04-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1551	5	\N	2023-04-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1469	5	\N	2023-01-23	1	Approved	t	National Holiday	Lunar New Year Joint Holiday	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1527	5	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1543	5	\N	2023-04-07	1	Approved	t	National Holiday	Wafat Isa Almasih	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1545	5	\N	2023-04-09	1	Approved	t	National Holiday	Hari Paskah	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1552	5	\N	2023-04-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1553	5	\N	2023-04-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1554	5	\N	2023-04-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1555	5	\N	2023-04-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1556	5	\N	2023-04-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1563	5	\N	2023-04-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1564	5	\N	2023-04-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1565	5	\N	2023-04-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1566	5	\N	2023-04-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1568	5	\N	2023-05-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1569	5	\N	2023-05-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1570	5	\N	2023-05-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1571	5	\N	2023-05-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1572	5	\N	2023-05-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1573	5	\N	2023-05-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1574	5	\N	2023-05-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1575	5	\N	2023-05-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1576	5	\N	2023-05-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1577	5	\N	2023-05-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1578	5	\N	2023-05-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1579	5	\N	2023-05-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1580	5	\N	2023-05-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1581	5	\N	2023-05-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1582	5	\N	2023-05-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1583	5	\N	2023-05-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1585	5	\N	2023-05-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1586	5	\N	2023-05-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1587	5	\N	2023-05-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1588	5	\N	2023-05-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1589	5	\N	2023-05-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1590	5	\N	2023-05-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1591	5	\N	2023-05-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1592	5	\N	2023-05-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1593	5	\N	2023-05-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1594	5	\N	2023-05-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1595	5	\N	2023-05-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1596	5	\N	2023-05-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1597	5	\N	2023-05-31	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1600	5	\N	2023-06-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1602	5	\N	2023-06-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1603	5	\N	2023-06-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1604	5	\N	2023-06-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1605	5	\N	2023-06-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1606	5	\N	2023-06-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1607	5	\N	2023-06-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1608	5	\N	2023-06-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1609	5	\N	2023-06-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1610	5	\N	2023-06-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1611	5	\N	2023-06-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1612	5	\N	2023-06-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1613	5	\N	2023-06-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1614	5	\N	2023-06-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1615	5	\N	2023-06-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1616	5	\N	2023-06-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1617	5	\N	2023-06-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1618	5	\N	2023-06-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1619	5	\N	2023-06-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1620	5	\N	2023-06-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1621	5	\N	2023-06-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1622	5	\N	2023-06-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1623	5	\N	2023-06-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1624	5	\N	2023-06-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1625	5	\N	2023-06-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1627	5	\N	2023-06-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1628	5	\N	2023-07-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1629	5	\N	2023-07-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1630	5	\N	2023-07-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1631	5	\N	2023-07-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1632	5	\N	2023-07-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1633	5	\N	2023-07-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1634	5	\N	2023-07-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1635	5	\N	2023-07-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1636	5	\N	2023-07-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1637	5	\N	2023-07-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1638	5	\N	2023-07-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1639	5	\N	2023-07-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1558	5	\N	2023-04-22	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1559	5	\N	2023-04-23	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1561	5	\N	2023-04-25	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1562	5	\N	2023-04-26	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1584	5	\N	2023-05-18	1	Approved	t	National Holiday	Kenaikan Isa Al Masih	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1598	5	\N	2023-06-01	1	Approved	t	National Holiday	Hari Lahir Pancasila	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1601	5	\N	2023-06-04	1	Approved	t	National Holiday	Hari Raya Waisak	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1626	5	\N	2023-06-29	1	Approved	t	National Holiday	Idul Adha (Lebaran Haji)	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1640	5	\N	2023-07-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1641	5	\N	2023-07-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1642	5	\N	2023-07-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1643	5	\N	2023-07-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1644	5	\N	2023-07-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1645	5	\N	2023-07-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1647	5	\N	2023-07-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1648	5	\N	2023-07-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1649	5	\N	2023-07-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1650	5	\N	2023-07-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1651	5	\N	2023-07-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1652	5	\N	2023-07-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1653	5	\N	2023-07-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1654	5	\N	2023-07-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1655	5	\N	2023-07-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1656	5	\N	2023-07-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1657	5	\N	2023-07-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1658	5	\N	2023-07-31	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1659	5	\N	2023-08-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1660	5	\N	2023-08-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1661	5	\N	2023-08-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1662	5	\N	2023-08-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1663	5	\N	2023-08-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1664	5	\N	2023-08-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1665	5	\N	2023-08-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1666	5	\N	2023-08-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1667	5	\N	2023-08-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1668	5	\N	2023-08-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1669	5	\N	2023-08-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1670	5	\N	2023-08-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1671	5	\N	2023-08-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1672	5	\N	2023-08-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1673	5	\N	2023-08-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1674	5	\N	2023-08-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1676	5	\N	2023-08-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1677	5	\N	2023-08-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1678	5	\N	2023-08-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1679	5	\N	2023-08-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1680	5	\N	2023-08-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1681	5	\N	2023-08-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1682	5	\N	2023-08-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1683	5	\N	2023-08-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1684	5	\N	2023-08-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1685	5	\N	2023-08-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1686	5	\N	2023-08-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1687	5	\N	2023-08-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1688	5	\N	2023-08-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1689	5	\N	2023-08-31	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1690	5	\N	2023-09-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1691	5	\N	2023-09-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1692	5	\N	2023-09-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1693	5	\N	2023-09-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1694	5	\N	2023-09-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1695	5	\N	2023-09-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1696	5	\N	2023-09-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1697	5	\N	2023-09-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1698	5	\N	2023-09-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1699	5	\N	2023-09-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1700	5	\N	2023-09-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1701	5	\N	2023-09-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1702	5	\N	2023-09-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1703	5	\N	2023-09-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1704	5	\N	2023-09-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1705	5	\N	2023-09-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1706	5	\N	2023-09-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1707	5	\N	2023-09-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1708	5	\N	2023-09-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1709	5	\N	2023-09-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1710	5	\N	2023-09-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1711	5	\N	2023-09-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1712	5	\N	2023-09-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1713	5	\N	2023-09-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1714	5	\N	2023-09-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1715	5	\N	2023-09-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1716	5	\N	2023-09-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1718	5	\N	2023-09-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1719	5	\N	2023-09-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1720	5	\N	2023-10-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1722	5	\N	2023-10-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1723	5	\N	2023-10-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1724	5	\N	2023-10-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1725	5	\N	2023-10-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1726	5	\N	2023-10-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1727	5	\N	2023-10-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1675	5	\N	2023-08-17	1	Approved	t	National Holiday	Hari Proklamasi Kemerdekaan R.I.	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1721	5	\N	2023-10-02	1	Approved	t	National Holiday	Hari Batik	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1728	5	\N	2023-10-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1729	5	\N	2023-10-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1730	5	\N	2023-10-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1731	5	\N	2023-10-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1732	5	\N	2023-10-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1733	5	\N	2023-10-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1734	5	\N	2023-10-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1735	5	\N	2023-10-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1736	5	\N	2023-10-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1737	5	\N	2023-10-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1738	5	\N	2023-10-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1739	5	\N	2023-10-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1740	5	\N	2023-10-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1741	5	\N	2023-10-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1742	5	\N	2023-10-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1743	5	\N	2023-10-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1744	5	\N	2023-10-25	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1745	5	\N	2023-10-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1746	5	\N	2023-10-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1747	5	\N	2023-10-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1748	5	\N	2023-10-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1749	5	\N	2023-10-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1750	5	\N	2023-10-31	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1751	5	\N	2023-11-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1752	5	\N	2023-11-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1753	5	\N	2023-11-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1754	5	\N	2023-11-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1755	5	\N	2023-11-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1756	5	\N	2023-11-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1757	5	\N	2023-11-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1758	5	\N	2023-11-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1759	5	\N	2023-11-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1760	5	\N	2023-11-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1761	5	\N	2023-11-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1763	5	\N	2023-11-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1764	5	\N	2023-11-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1765	5	\N	2023-11-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1766	5	\N	2023-11-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1767	5	\N	2023-11-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1768	5	\N	2023-11-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1769	5	\N	2023-11-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1770	5	\N	2023-11-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1771	5	\N	2023-11-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1772	5	\N	2023-11-22	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1773	5	\N	2023-11-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1774	5	\N	2023-11-24	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1776	5	\N	2023-11-26	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1777	5	\N	2023-11-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1778	5	\N	2023-11-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1779	5	\N	2023-11-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1780	5	\N	2023-11-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1781	5	\N	2023-12-01	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1782	5	\N	2023-12-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1783	5	\N	2023-12-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1784	5	\N	2023-12-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1785	5	\N	2023-12-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1786	5	\N	2023-12-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1787	5	\N	2023-12-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1788	5	\N	2023-12-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1789	5	\N	2023-12-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1790	5	\N	2023-12-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1791	5	\N	2023-12-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1792	5	\N	2023-12-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1793	5	\N	2023-12-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1794	5	\N	2023-12-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1795	5	\N	2023-12-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1796	5	\N	2023-12-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1797	5	\N	2023-12-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1798	5	\N	2023-12-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1799	5	\N	2023-12-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1800	5	\N	2023-12-20	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1801	5	\N	2023-12-21	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1803	5	\N	2023-12-23	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1807	5	\N	2023-12-27	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1808	5	\N	2023-12-28	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1809	5	\N	2023-12-29	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1810	5	\N	2023-12-30	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1813	5	\N	2024-01-02	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1814	5	\N	2024-01-03	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1815	5	\N	2024-01-04	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1775	5	\N	2023-11-25	1	Approved	t	National Holiday	Hari Guru	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1802	5	\N	2023-12-22	1	Approved	t	National Holiday	Hari Ibu	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1805	5	\N	2023-12-25	1	Approved	t	National Holiday	Hari Raya Natal	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1806	5	\N	2023-12-26	1	Approved	t	National Holiday	Cuti Bersama Natal (Hari Tinju)	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1812	5	\N	2024-01-01	1	Approved	t	National Holiday	Hari Tahun Baru	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1816	5	\N	2024-01-05	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1817	5	\N	2024-01-06	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1818	5	\N	2024-01-07	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1819	5	\N	2024-01-08	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1820	5	\N	2024-01-09	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1821	5	\N	2024-01-10	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1822	5	\N	2024-01-11	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1823	5	\N	2024-01-12	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1824	5	\N	2024-01-13	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1825	5	\N	2024-01-14	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1826	5	\N	2024-01-15	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1827	5	\N	2024-01-16	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1828	5	\N	2024-01-17	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1829	5	\N	2024-01-18	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1830	5	\N	2024-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 12:26:43	2023-01-19 12:26:43
1831	6	\N	2023-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1832	6	\N	2023-01-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1833	6	\N	2023-01-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1836	6	\N	2023-01-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1837	6	\N	2023-01-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1838	6	\N	2023-01-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1839	6	\N	2023-01-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1840	6	\N	2023-01-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1841	6	\N	2023-01-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1842	6	\N	2023-01-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1843	6	\N	2023-01-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1844	6	\N	2023-02-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1845	6	\N	2023-02-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1846	6	\N	2023-02-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1847	6	\N	2023-02-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1848	6	\N	2023-02-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1849	6	\N	2023-02-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1850	6	\N	2023-02-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1851	6	\N	2023-02-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1852	6	\N	2023-02-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1853	6	\N	2023-02-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1854	6	\N	2023-02-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1855	6	\N	2023-02-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1856	6	\N	2023-02-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1857	6	\N	2023-02-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1858	6	\N	2023-02-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1859	6	\N	2023-02-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1860	6	\N	2023-02-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1862	6	\N	2023-02-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1863	6	\N	2023-02-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1864	6	\N	2023-02-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1865	6	\N	2023-02-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1866	6	\N	2023-02-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1867	6	\N	2023-02-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1868	6	\N	2023-02-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1869	6	\N	2023-02-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1870	6	\N	2023-02-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1871	6	\N	2023-02-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1872	6	\N	2023-03-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1873	6	\N	2023-03-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1874	6	\N	2023-03-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1875	6	\N	2023-03-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1876	6	\N	2023-03-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1877	6	\N	2023-03-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1878	6	\N	2023-03-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1879	6	\N	2023-03-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1880	6	\N	2023-03-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1881	6	\N	2023-03-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1882	6	\N	2023-03-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1883	6	\N	2023-03-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1884	6	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1885	6	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1886	6	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1887	6	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1888	6	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1889	6	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1890	6	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1891	6	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1892	6	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1895	6	\N	2023-03-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1896	6	\N	2023-03-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1897	6	\N	2023-03-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1898	6	\N	2023-03-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1899	6	\N	2023-03-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1900	6	\N	2023-03-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1901	6	\N	2023-03-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1902	6	\N	2023-03-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1903	6	\N	2023-04-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1835	6	\N	2023-01-23	1	Approved	t	National Holiday	Lunar New Year Joint Holiday	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1893	6	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1904	6	\N	2023-04-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1905	6	\N	2023-04-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1906	6	\N	2023-04-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1907	6	\N	2023-04-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1908	6	\N	2023-04-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1910	6	\N	2023-04-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1912	6	\N	2023-04-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1913	6	\N	2023-04-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1914	6	\N	2023-04-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1915	6	\N	2023-04-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1916	6	\N	2023-04-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1917	6	\N	2023-04-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1918	6	\N	2023-04-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1919	6	\N	2023-04-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1920	6	\N	2023-04-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1921	6	\N	2023-04-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1922	6	\N	2023-04-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1929	6	\N	2023-04-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1930	6	\N	2023-04-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1931	6	\N	2023-04-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1932	6	\N	2023-04-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1934	6	\N	2023-05-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1935	6	\N	2023-05-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1936	6	\N	2023-05-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1937	6	\N	2023-05-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1938	6	\N	2023-05-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1939	6	\N	2023-05-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1940	6	\N	2023-05-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1941	6	\N	2023-05-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1942	6	\N	2023-05-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1943	6	\N	2023-05-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1944	6	\N	2023-05-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1945	6	\N	2023-05-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1946	6	\N	2023-05-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1947	6	\N	2023-05-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1948	6	\N	2023-05-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1949	6	\N	2023-05-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1951	6	\N	2023-05-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1952	6	\N	2023-05-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1953	6	\N	2023-05-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1954	6	\N	2023-05-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1955	6	\N	2023-05-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1956	6	\N	2023-05-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1957	6	\N	2023-05-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1958	6	\N	2023-05-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1959	6	\N	2023-05-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1960	6	\N	2023-05-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1961	6	\N	2023-05-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1962	6	\N	2023-05-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1963	6	\N	2023-05-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1966	6	\N	2023-06-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1968	6	\N	2023-06-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1969	6	\N	2023-06-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1970	6	\N	2023-06-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1971	6	\N	2023-06-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1972	6	\N	2023-06-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1973	6	\N	2023-06-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1974	6	\N	2023-06-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1975	6	\N	2023-06-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1976	6	\N	2023-06-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1977	6	\N	2023-06-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1978	6	\N	2023-06-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1979	6	\N	2023-06-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1980	6	\N	2023-06-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1981	6	\N	2023-06-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1982	6	\N	2023-06-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1983	6	\N	2023-06-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1984	6	\N	2023-06-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1985	6	\N	2023-06-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1986	6	\N	2023-06-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1987	6	\N	2023-06-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1988	6	\N	2023-06-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1989	6	\N	2023-06-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1990	6	\N	2023-06-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1991	6	\N	2023-06-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1911	6	\N	2023-04-09	1	Approved	t	National Holiday	Hari Paskah	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1923	6	\N	2023-04-21	1	Approved	t	National Holiday	Hari Kartini	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1925	6	\N	2023-04-23	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1926	6	\N	2023-04-24	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1928	6	\N	2023-04-26	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1933	6	\N	2023-05-01	1	Approved	t	National Holiday	Hari Buruh Internasional / Pekerja	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1964	6	\N	2023-06-01	1	Approved	t	National Holiday	Hari Lahir Pancasila	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1965	6	\N	2023-06-02	1	Approved	t	National Holiday	Cuti Bersama Waisak	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1993	6	\N	2023-06-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1994	6	\N	2023-07-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1995	6	\N	2023-07-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1996	6	\N	2023-07-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1997	6	\N	2023-07-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1998	6	\N	2023-07-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
1999	6	\N	2023-07-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2000	6	\N	2023-07-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2001	6	\N	2023-07-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2002	6	\N	2023-07-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2003	6	\N	2023-07-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2004	6	\N	2023-07-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2005	6	\N	2023-07-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2006	6	\N	2023-07-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2007	6	\N	2023-07-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2008	6	\N	2023-07-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2009	6	\N	2023-07-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2010	6	\N	2023-07-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2011	6	\N	2023-07-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2013	6	\N	2023-07-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2014	6	\N	2023-07-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2015	6	\N	2023-07-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2016	6	\N	2023-07-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2017	6	\N	2023-07-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2018	6	\N	2023-07-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2019	6	\N	2023-07-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2020	6	\N	2023-07-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2021	6	\N	2023-07-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2022	6	\N	2023-07-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2023	6	\N	2023-07-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2024	6	\N	2023-07-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2025	6	\N	2023-08-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2026	6	\N	2023-08-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2027	6	\N	2023-08-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2028	6	\N	2023-08-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2029	6	\N	2023-08-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2030	6	\N	2023-08-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2031	6	\N	2023-08-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2032	6	\N	2023-08-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2033	6	\N	2023-08-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2034	6	\N	2023-08-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2035	6	\N	2023-08-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2036	6	\N	2023-08-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2037	6	\N	2023-08-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2038	6	\N	2023-08-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2039	6	\N	2023-08-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2040	6	\N	2023-08-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2042	6	\N	2023-08-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2043	6	\N	2023-08-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2044	6	\N	2023-08-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2045	6	\N	2023-08-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2046	6	\N	2023-08-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2047	6	\N	2023-08-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2048	6	\N	2023-08-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2049	6	\N	2023-08-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2050	6	\N	2023-08-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2051	6	\N	2023-08-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2052	6	\N	2023-08-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2053	6	\N	2023-08-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2054	6	\N	2023-08-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2055	6	\N	2023-08-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2056	6	\N	2023-09-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2057	6	\N	2023-09-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2058	6	\N	2023-09-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2059	6	\N	2023-09-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2060	6	\N	2023-09-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2061	6	\N	2023-09-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2062	6	\N	2023-09-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2063	6	\N	2023-09-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2064	6	\N	2023-09-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2065	6	\N	2023-09-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2066	6	\N	2023-09-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2067	6	\N	2023-09-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2068	6	\N	2023-09-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2069	6	\N	2023-09-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2070	6	\N	2023-09-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2071	6	\N	2023-09-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2072	6	\N	2023-09-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2073	6	\N	2023-09-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2074	6	\N	2023-09-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2075	6	\N	2023-09-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2076	6	\N	2023-09-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2077	6	\N	2023-09-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2078	6	\N	2023-09-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2079	6	\N	2023-09-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2012	6	\N	2023-07-19	1	Approved	t	National Holiday	Satu Muharam / Tahun Baru Hijriah	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
2080	6	\N	2023-09-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2081	6	\N	2023-09-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2082	6	\N	2023-09-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2084	6	\N	2023-09-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2085	6	\N	2023-09-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2086	6	\N	2023-10-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2088	6	\N	2023-10-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2089	6	\N	2023-10-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2090	6	\N	2023-10-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2091	6	\N	2023-10-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2092	6	\N	2023-10-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2093	6	\N	2023-10-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2094	6	\N	2023-10-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2095	6	\N	2023-10-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2096	6	\N	2023-10-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2097	6	\N	2023-10-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2098	6	\N	2023-10-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2099	6	\N	2023-10-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2100	6	\N	2023-10-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2101	6	\N	2023-10-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2102	6	\N	2023-10-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2103	6	\N	2023-10-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2104	6	\N	2023-10-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2105	6	\N	2023-10-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2106	6	\N	2023-10-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2107	6	\N	2023-10-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2108	6	\N	2023-10-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2109	6	\N	2023-10-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2110	6	\N	2023-10-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2111	6	\N	2023-10-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2112	6	\N	2023-10-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2113	6	\N	2023-10-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2114	6	\N	2023-10-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2115	6	\N	2023-10-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2116	6	\N	2023-10-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2117	6	\N	2023-11-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2118	6	\N	2023-11-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2119	6	\N	2023-11-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2120	6	\N	2023-11-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2121	6	\N	2023-11-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2122	6	\N	2023-11-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2123	6	\N	2023-11-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2124	6	\N	2023-11-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2125	6	\N	2023-11-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2126	6	\N	2023-11-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2127	6	\N	2023-11-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2129	6	\N	2023-11-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2130	6	\N	2023-11-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2131	6	\N	2023-11-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2132	6	\N	2023-11-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2133	6	\N	2023-11-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2134	6	\N	2023-11-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2135	6	\N	2023-11-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2136	6	\N	2023-11-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2137	6	\N	2023-11-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2138	6	\N	2023-11-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2139	6	\N	2023-11-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2140	6	\N	2023-11-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2142	6	\N	2023-11-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2143	6	\N	2023-11-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2144	6	\N	2023-11-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2145	6	\N	2023-11-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2146	6	\N	2023-11-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2147	6	\N	2023-12-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2148	6	\N	2023-12-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2149	6	\N	2023-12-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2150	6	\N	2023-12-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2151	6	\N	2023-12-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2152	6	\N	2023-12-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2153	6	\N	2023-12-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2154	6	\N	2023-12-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2155	6	\N	2023-12-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2156	6	\N	2023-12-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2157	6	\N	2023-12-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2158	6	\N	2023-12-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2159	6	\N	2023-12-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2160	6	\N	2023-12-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2161	6	\N	2023-12-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2162	6	\N	2023-12-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2163	6	\N	2023-12-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2164	6	\N	2023-12-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2165	6	\N	2023-12-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2166	6	\N	2023-12-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2167	6	\N	2023-12-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2087	6	\N	2023-10-02	1	Approved	t	National Holiday	Hari Batik	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
2128	6	\N	2023-11-12	1	Approved	t	National Holiday	Diwali / Deepavali	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
2169	6	\N	2023-12-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2173	6	\N	2023-12-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2174	6	\N	2023-12-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2175	6	\N	2023-12-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2176	6	\N	2023-12-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2179	6	\N	2024-01-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2180	6	\N	2024-01-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2181	6	\N	2024-01-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2182	6	\N	2024-01-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2183	6	\N	2024-01-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2184	6	\N	2024-01-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2185	6	\N	2024-01-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2186	6	\N	2024-01-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2187	6	\N	2024-01-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2188	6	\N	2024-01-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2189	6	\N	2024-01-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2190	6	\N	2024-01-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2191	6	\N	2024-01-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2192	6	\N	2024-01-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2193	6	\N	2024-01-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2194	6	\N	2024-01-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2195	6	\N	2024-01-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2196	6	\N	2024-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:15	2023-01-19 13:54:15
2197	7	\N	2023-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2198	7	\N	2023-01-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2199	7	\N	2023-01-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2202	7	\N	2023-01-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2203	7	\N	2023-01-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2204	7	\N	2023-01-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2205	7	\N	2023-01-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2206	7	\N	2023-01-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2207	7	\N	2023-01-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2208	7	\N	2023-01-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2209	7	\N	2023-01-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2210	7	\N	2023-02-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2211	7	\N	2023-02-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2212	7	\N	2023-02-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2213	7	\N	2023-02-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2214	7	\N	2023-02-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2215	7	\N	2023-02-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2216	7	\N	2023-02-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2217	7	\N	2023-02-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2218	7	\N	2023-02-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2219	7	\N	2023-02-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2220	7	\N	2023-02-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2221	7	\N	2023-02-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2222	7	\N	2023-02-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2223	7	\N	2023-02-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2224	7	\N	2023-02-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2225	7	\N	2023-02-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2226	7	\N	2023-02-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2228	7	\N	2023-02-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2229	7	\N	2023-02-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2230	7	\N	2023-02-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2231	7	\N	2023-02-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2232	7	\N	2023-02-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2233	7	\N	2023-02-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2234	7	\N	2023-02-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2235	7	\N	2023-02-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2236	7	\N	2023-02-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2237	7	\N	2023-02-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2238	7	\N	2023-03-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2239	7	\N	2023-03-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2240	7	\N	2023-03-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2241	7	\N	2023-03-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2242	7	\N	2023-03-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2243	7	\N	2023-03-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2244	7	\N	2023-03-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2245	7	\N	2023-03-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2246	7	\N	2023-03-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2247	7	\N	2023-03-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2248	7	\N	2023-03-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2249	7	\N	2023-03-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2250	7	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2251	7	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2252	7	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2253	7	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2254	7	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2255	7	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2170	6	\N	2023-12-24	1	Approved	t	National Holiday	Malam Natal	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
2171	6	\N	2023-12-25	1	Approved	t	National Holiday	Hari Raya Natal	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
2177	6	\N	2023-12-31	1	Approved	t	National Holiday	Malam Tahun Baru	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
2178	6	\N	2024-01-01	1	Approved	t	National Holiday	Hari Tahun Baru	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
2201	7	\N	2023-01-23	1	Approved	t	National Holiday	Lunar New Year Joint Holiday	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2227	7	\N	2023-02-18	1	Approved	t	National Holiday	Isra Mikraj Nabi Muhammad	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2256	7	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2257	7	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2258	7	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2261	7	\N	2023-03-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2262	7	\N	2023-03-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2263	7	\N	2023-03-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2264	7	\N	2023-03-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2265	7	\N	2023-03-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2266	7	\N	2023-03-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2267	7	\N	2023-03-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2268	7	\N	2023-03-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2269	7	\N	2023-04-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2270	7	\N	2023-04-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2271	7	\N	2023-04-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2272	7	\N	2023-04-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2273	7	\N	2023-04-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2274	7	\N	2023-04-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2276	7	\N	2023-04-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2278	7	\N	2023-04-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2279	7	\N	2023-04-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2280	7	\N	2023-04-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2281	7	\N	2023-04-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2282	7	\N	2023-04-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2283	7	\N	2023-04-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2284	7	\N	2023-04-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2285	7	\N	2023-04-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2286	7	\N	2023-04-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2287	7	\N	2023-04-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2288	7	\N	2023-04-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2295	7	\N	2023-04-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2296	7	\N	2023-04-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2297	7	\N	2023-04-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2298	7	\N	2023-04-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2300	7	\N	2023-05-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2301	7	\N	2023-05-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2302	7	\N	2023-05-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2303	7	\N	2023-05-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2304	7	\N	2023-05-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2305	7	\N	2023-05-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2306	7	\N	2023-05-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2307	7	\N	2023-05-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2308	7	\N	2023-05-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2309	7	\N	2023-05-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2310	7	\N	2023-05-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2311	7	\N	2023-05-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2312	7	\N	2023-05-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2313	7	\N	2023-05-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2314	7	\N	2023-05-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2315	7	\N	2023-05-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2317	7	\N	2023-05-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2318	7	\N	2023-05-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2319	7	\N	2023-05-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2320	7	\N	2023-05-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2321	7	\N	2023-05-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2322	7	\N	2023-05-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2323	7	\N	2023-05-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2324	7	\N	2023-05-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2325	7	\N	2023-05-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2326	7	\N	2023-05-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2327	7	\N	2023-05-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2328	7	\N	2023-05-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2329	7	\N	2023-05-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2332	7	\N	2023-06-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2334	7	\N	2023-06-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2335	7	\N	2023-06-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2336	7	\N	2023-06-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2337	7	\N	2023-06-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2338	7	\N	2023-06-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2339	7	\N	2023-06-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2340	7	\N	2023-06-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2341	7	\N	2023-06-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2342	7	\N	2023-06-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2343	7	\N	2023-06-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2275	7	\N	2023-04-07	1	Approved	t	National Holiday	Wafat Isa Almasih	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2277	7	\N	2023-04-09	1	Approved	t	National Holiday	Hari Paskah	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2289	7	\N	2023-04-21	1	Approved	t	National Holiday	Hari Kartini	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2290	7	\N	2023-04-22	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2292	7	\N	2023-04-24	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2293	7	\N	2023-04-25	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2299	7	\N	2023-05-01	1	Approved	t	National Holiday	Hari Buruh Internasional / Pekerja	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2316	7	\N	2023-05-18	1	Approved	t	National Holiday	Kenaikan Isa Al Masih	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2331	7	\N	2023-06-02	1	Approved	t	National Holiday	Cuti Bersama Waisak	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2333	7	\N	2023-06-04	1	Approved	t	National Holiday	Hari Raya Waisak	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2344	7	\N	2023-06-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2345	7	\N	2023-06-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2346	7	\N	2023-06-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2347	7	\N	2023-06-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2348	7	\N	2023-06-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2349	7	\N	2023-06-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2350	7	\N	2023-06-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2351	7	\N	2023-06-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2352	7	\N	2023-06-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2353	7	\N	2023-06-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2354	7	\N	2023-06-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2355	7	\N	2023-06-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2356	7	\N	2023-06-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2357	7	\N	2023-06-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2359	7	\N	2023-06-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2360	7	\N	2023-07-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2361	7	\N	2023-07-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2362	7	\N	2023-07-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2363	7	\N	2023-07-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2364	7	\N	2023-07-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2365	7	\N	2023-07-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2366	7	\N	2023-07-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2367	7	\N	2023-07-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2368	7	\N	2023-07-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2369	7	\N	2023-07-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2370	7	\N	2023-07-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2371	7	\N	2023-07-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2372	7	\N	2023-07-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2373	7	\N	2023-07-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2374	7	\N	2023-07-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2375	7	\N	2023-07-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2376	7	\N	2023-07-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2377	7	\N	2023-07-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2379	7	\N	2023-07-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2380	7	\N	2023-07-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2381	7	\N	2023-07-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2382	7	\N	2023-07-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2383	7	\N	2023-07-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2384	7	\N	2023-07-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2385	7	\N	2023-07-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2386	7	\N	2023-07-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2387	7	\N	2023-07-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2388	7	\N	2023-07-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2389	7	\N	2023-07-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2390	7	\N	2023-07-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2391	7	\N	2023-08-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2392	7	\N	2023-08-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2393	7	\N	2023-08-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2394	7	\N	2023-08-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2395	7	\N	2023-08-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2396	7	\N	2023-08-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2397	7	\N	2023-08-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2398	7	\N	2023-08-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2399	7	\N	2023-08-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2400	7	\N	2023-08-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2401	7	\N	2023-08-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2402	7	\N	2023-08-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2403	7	\N	2023-08-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2404	7	\N	2023-08-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2405	7	\N	2023-08-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2406	7	\N	2023-08-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2408	7	\N	2023-08-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2409	7	\N	2023-08-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2410	7	\N	2023-08-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2411	7	\N	2023-08-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2412	7	\N	2023-08-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2413	7	\N	2023-08-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2414	7	\N	2023-08-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2415	7	\N	2023-08-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2416	7	\N	2023-08-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2417	7	\N	2023-08-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2418	7	\N	2023-08-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2419	7	\N	2023-08-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2420	7	\N	2023-08-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2421	7	\N	2023-08-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2422	7	\N	2023-09-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2423	7	\N	2023-09-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2424	7	\N	2023-09-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2425	7	\N	2023-09-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2426	7	\N	2023-09-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2427	7	\N	2023-09-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2428	7	\N	2023-09-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2429	7	\N	2023-09-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2430	7	\N	2023-09-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2431	7	\N	2023-09-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2378	7	\N	2023-07-19	1	Approved	t	National Holiday	Satu Muharam / Tahun Baru Hijriah	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2432	7	\N	2023-09-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2433	7	\N	2023-09-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2434	7	\N	2023-09-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2435	7	\N	2023-09-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2436	7	\N	2023-09-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2437	7	\N	2023-09-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2438	7	\N	2023-09-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2439	7	\N	2023-09-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2440	7	\N	2023-09-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2441	7	\N	2023-09-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2442	7	\N	2023-09-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2443	7	\N	2023-09-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2444	7	\N	2023-09-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2445	7	\N	2023-09-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2446	7	\N	2023-09-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2447	7	\N	2023-09-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2448	7	\N	2023-09-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2450	7	\N	2023-09-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2451	7	\N	2023-09-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2452	7	\N	2023-10-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2454	7	\N	2023-10-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2455	7	\N	2023-10-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2456	7	\N	2023-10-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2457	7	\N	2023-10-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2458	7	\N	2023-10-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2459	7	\N	2023-10-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2460	7	\N	2023-10-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2461	7	\N	2023-10-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2462	7	\N	2023-10-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2463	7	\N	2023-10-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2464	7	\N	2023-10-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2465	7	\N	2023-10-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2466	7	\N	2023-10-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2467	7	\N	2023-10-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2468	7	\N	2023-10-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2469	7	\N	2023-10-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2470	7	\N	2023-10-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2471	7	\N	2023-10-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2472	7	\N	2023-10-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2473	7	\N	2023-10-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2474	7	\N	2023-10-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2475	7	\N	2023-10-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2476	7	\N	2023-10-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2477	7	\N	2023-10-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2478	7	\N	2023-10-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2479	7	\N	2023-10-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2480	7	\N	2023-10-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2481	7	\N	2023-10-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2482	7	\N	2023-10-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2483	7	\N	2023-11-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2484	7	\N	2023-11-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2485	7	\N	2023-11-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2486	7	\N	2023-11-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2487	7	\N	2023-11-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2488	7	\N	2023-11-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2489	7	\N	2023-11-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2490	7	\N	2023-11-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2491	7	\N	2023-11-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2492	7	\N	2023-11-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2493	7	\N	2023-11-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2495	7	\N	2023-11-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2496	7	\N	2023-11-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2497	7	\N	2023-11-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2498	7	\N	2023-11-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2499	7	\N	2023-11-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2500	7	\N	2023-11-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2501	7	\N	2023-11-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2502	7	\N	2023-11-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2503	7	\N	2023-11-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2504	7	\N	2023-11-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2505	7	\N	2023-11-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2506	7	\N	2023-11-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2508	7	\N	2023-11-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2509	7	\N	2023-11-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2510	7	\N	2023-11-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2511	7	\N	2023-11-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2512	7	\N	2023-11-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2513	7	\N	2023-12-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2514	7	\N	2023-12-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2515	7	\N	2023-12-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2516	7	\N	2023-12-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2517	7	\N	2023-12-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2518	7	\N	2023-12-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2519	7	\N	2023-12-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2453	7	\N	2023-10-02	1	Approved	t	National Holiday	Hari Batik	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2494	7	\N	2023-11-12	1	Approved	t	National Holiday	Diwali / Deepavali	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2520	7	\N	2023-12-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2521	7	\N	2023-12-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2522	7	\N	2023-12-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2523	7	\N	2023-12-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2524	7	\N	2023-12-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2525	7	\N	2023-12-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2526	7	\N	2023-12-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2527	7	\N	2023-12-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2528	7	\N	2023-12-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2529	7	\N	2023-12-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2530	7	\N	2023-12-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2531	7	\N	2023-12-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2532	7	\N	2023-12-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2533	7	\N	2023-12-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2535	7	\N	2023-12-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2539	7	\N	2023-12-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2540	7	\N	2023-12-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2541	7	\N	2023-12-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2542	7	\N	2023-12-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2545	7	\N	2024-01-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2546	7	\N	2024-01-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2547	7	\N	2024-01-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2548	7	\N	2024-01-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2549	7	\N	2024-01-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2550	7	\N	2024-01-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2551	7	\N	2024-01-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2552	7	\N	2024-01-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2553	7	\N	2024-01-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2554	7	\N	2024-01-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2555	7	\N	2024-01-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2556	7	\N	2024-01-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2557	7	\N	2024-01-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2558	7	\N	2024-01-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2559	7	\N	2024-01-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2560	7	\N	2024-01-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2561	7	\N	2024-01-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2562	7	\N	2024-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:54:47	2023-01-19 13:54:47
2563	8	\N	2023-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2564	8	\N	2023-01-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2565	8	\N	2023-01-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2568	8	\N	2023-01-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2569	8	\N	2023-01-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2570	8	\N	2023-01-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2571	8	\N	2023-01-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2572	8	\N	2023-01-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2573	8	\N	2023-01-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2574	8	\N	2023-01-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2575	8	\N	2023-01-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2576	8	\N	2023-02-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2577	8	\N	2023-02-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2578	8	\N	2023-02-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2579	8	\N	2023-02-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2580	8	\N	2023-02-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2581	8	\N	2023-02-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2582	8	\N	2023-02-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2583	8	\N	2023-02-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2584	8	\N	2023-02-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2585	8	\N	2023-02-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2586	8	\N	2023-02-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2587	8	\N	2023-02-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2588	8	\N	2023-02-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2589	8	\N	2023-02-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2590	8	\N	2023-02-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2591	8	\N	2023-02-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2592	8	\N	2023-02-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2594	8	\N	2023-02-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2595	8	\N	2023-02-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2596	8	\N	2023-02-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2597	8	\N	2023-02-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2598	8	\N	2023-02-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2599	8	\N	2023-02-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2600	8	\N	2023-02-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2601	8	\N	2023-02-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2602	8	\N	2023-02-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2603	8	\N	2023-02-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2604	8	\N	2023-03-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2605	8	\N	2023-03-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2606	8	\N	2023-03-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2607	8	\N	2023-03-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2536	7	\N	2023-12-24	1	Approved	t	National Holiday	Malam Natal	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2537	7	\N	2023-12-25	1	Approved	t	National Holiday	Hari Raya Natal	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2543	7	\N	2023-12-31	1	Approved	t	National Holiday	Malam Tahun Baru	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2544	7	\N	2024-01-01	1	Approved	t	National Holiday	Hari Tahun Baru	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2567	8	\N	2023-01-23	1	Approved	t	National Holiday	Lunar New Year Joint Holiday	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2593	8	\N	2023-02-18	1	Approved	t	National Holiday	Isra Mikraj Nabi Muhammad	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2608	8	\N	2023-03-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2609	8	\N	2023-03-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2610	8	\N	2023-03-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2611	8	\N	2023-03-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2612	8	\N	2023-03-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2613	8	\N	2023-03-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2614	8	\N	2023-03-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2615	8	\N	2023-03-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2616	8	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2617	8	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2618	8	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2619	8	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2620	8	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2621	8	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2622	8	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2623	8	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2624	8	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2627	8	\N	2023-03-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2628	8	\N	2023-03-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2629	8	\N	2023-03-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2630	8	\N	2023-03-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2631	8	\N	2023-03-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2632	8	\N	2023-03-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2633	8	\N	2023-03-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2634	8	\N	2023-03-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2635	8	\N	2023-04-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2636	8	\N	2023-04-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2637	8	\N	2023-04-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2638	8	\N	2023-04-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2639	8	\N	2023-04-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2640	8	\N	2023-04-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2642	8	\N	2023-04-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2644	8	\N	2023-04-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2645	8	\N	2023-04-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2646	8	\N	2023-04-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2647	8	\N	2023-04-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2648	8	\N	2023-04-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2649	8	\N	2023-04-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2650	8	\N	2023-04-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2651	8	\N	2023-04-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2652	8	\N	2023-04-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2653	8	\N	2023-04-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2654	8	\N	2023-04-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2661	8	\N	2023-04-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2662	8	\N	2023-04-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2663	8	\N	2023-04-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2664	8	\N	2023-04-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2666	8	\N	2023-05-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2667	8	\N	2023-05-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2668	8	\N	2023-05-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2669	8	\N	2023-05-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2670	8	\N	2023-05-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2671	8	\N	2023-05-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2672	8	\N	2023-05-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2673	8	\N	2023-05-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2674	8	\N	2023-05-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2675	8	\N	2023-05-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2676	8	\N	2023-05-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2677	8	\N	2023-05-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2678	8	\N	2023-05-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2679	8	\N	2023-05-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2680	8	\N	2023-05-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2681	8	\N	2023-05-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2683	8	\N	2023-05-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2684	8	\N	2023-05-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2685	8	\N	2023-05-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2686	8	\N	2023-05-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2687	8	\N	2023-05-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2688	8	\N	2023-05-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2689	8	\N	2023-05-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2690	8	\N	2023-05-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2691	8	\N	2023-05-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2692	8	\N	2023-05-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2693	8	\N	2023-05-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2694	8	\N	2023-05-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2695	8	\N	2023-05-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2641	8	\N	2023-04-07	1	Approved	t	National Holiday	Wafat Isa Almasih	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2643	8	\N	2023-04-09	1	Approved	t	National Holiday	Hari Paskah	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2655	8	\N	2023-04-21	1	Approved	t	National Holiday	Hari Kartini	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2656	8	\N	2023-04-22	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2658	8	\N	2023-04-24	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2659	8	\N	2023-04-25	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2665	8	\N	2023-05-01	1	Approved	t	National Holiday	Hari Buruh Internasional / Pekerja	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2682	8	\N	2023-05-18	1	Approved	t	National Holiday	Kenaikan Isa Al Masih	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2698	8	\N	2023-06-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2700	8	\N	2023-06-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2701	8	\N	2023-06-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2702	8	\N	2023-06-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2703	8	\N	2023-06-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2704	8	\N	2023-06-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2705	8	\N	2023-06-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2706	8	\N	2023-06-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2707	8	\N	2023-06-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2708	8	\N	2023-06-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2709	8	\N	2023-06-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2710	8	\N	2023-06-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2711	8	\N	2023-06-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2712	8	\N	2023-06-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2713	8	\N	2023-06-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2714	8	\N	2023-06-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2715	8	\N	2023-06-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2716	8	\N	2023-06-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2717	8	\N	2023-06-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2718	8	\N	2023-06-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2719	8	\N	2023-06-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2720	8	\N	2023-06-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2721	8	\N	2023-06-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2722	8	\N	2023-06-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2723	8	\N	2023-06-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2725	8	\N	2023-06-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2726	8	\N	2023-07-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2727	8	\N	2023-07-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2728	8	\N	2023-07-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2729	8	\N	2023-07-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2730	8	\N	2023-07-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2731	8	\N	2023-07-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2732	8	\N	2023-07-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2733	8	\N	2023-07-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2734	8	\N	2023-07-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2735	8	\N	2023-07-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2736	8	\N	2023-07-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2737	8	\N	2023-07-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2738	8	\N	2023-07-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2739	8	\N	2023-07-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2740	8	\N	2023-07-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2741	8	\N	2023-07-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2742	8	\N	2023-07-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2743	8	\N	2023-07-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2745	8	\N	2023-07-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2746	8	\N	2023-07-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2747	8	\N	2023-07-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2748	8	\N	2023-07-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2749	8	\N	2023-07-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2750	8	\N	2023-07-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2751	8	\N	2023-07-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2752	8	\N	2023-07-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2753	8	\N	2023-07-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2754	8	\N	2023-07-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2755	8	\N	2023-07-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2756	8	\N	2023-07-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2757	8	\N	2023-08-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2758	8	\N	2023-08-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2759	8	\N	2023-08-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2760	8	\N	2023-08-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2761	8	\N	2023-08-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2762	8	\N	2023-08-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2763	8	\N	2023-08-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2764	8	\N	2023-08-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2765	8	\N	2023-08-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2766	8	\N	2023-08-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2767	8	\N	2023-08-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2768	8	\N	2023-08-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2769	8	\N	2023-08-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2770	8	\N	2023-08-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2771	8	\N	2023-08-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2772	8	\N	2023-08-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2774	8	\N	2023-08-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2775	8	\N	2023-08-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2776	8	\N	2023-08-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2777	8	\N	2023-08-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2778	8	\N	2023-08-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2779	8	\N	2023-08-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2780	8	\N	2023-08-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2781	8	\N	2023-08-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2782	8	\N	2023-08-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2783	8	\N	2023-08-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2697	8	\N	2023-06-02	1	Approved	t	National Holiday	Cuti Bersama Waisak	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2699	8	\N	2023-06-04	1	Approved	t	National Holiday	Hari Raya Waisak	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2744	8	\N	2023-07-19	1	Approved	t	National Holiday	Satu Muharam / Tahun Baru Hijriah	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2784	8	\N	2023-08-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2785	8	\N	2023-08-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2786	8	\N	2023-08-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2787	8	\N	2023-08-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2788	8	\N	2023-09-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2789	8	\N	2023-09-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2790	8	\N	2023-09-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2791	8	\N	2023-09-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2792	8	\N	2023-09-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2793	8	\N	2023-09-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2794	8	\N	2023-09-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2795	8	\N	2023-09-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2796	8	\N	2023-09-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2797	8	\N	2023-09-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2798	8	\N	2023-09-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2799	8	\N	2023-09-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2800	8	\N	2023-09-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2801	8	\N	2023-09-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2802	8	\N	2023-09-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2803	8	\N	2023-09-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2804	8	\N	2023-09-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2805	8	\N	2023-09-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2806	8	\N	2023-09-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2807	8	\N	2023-09-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2808	8	\N	2023-09-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2809	8	\N	2023-09-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2810	8	\N	2023-09-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2811	8	\N	2023-09-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2812	8	\N	2023-09-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2813	8	\N	2023-09-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2814	8	\N	2023-09-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2816	8	\N	2023-09-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2817	8	\N	2023-09-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2818	8	\N	2023-10-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2820	8	\N	2023-10-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2821	8	\N	2023-10-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2822	8	\N	2023-10-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2823	8	\N	2023-10-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2824	8	\N	2023-10-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2825	8	\N	2023-10-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2826	8	\N	2023-10-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2827	8	\N	2023-10-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2828	8	\N	2023-10-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2829	8	\N	2023-10-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2830	8	\N	2023-10-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2831	8	\N	2023-10-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2832	8	\N	2023-10-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2833	8	\N	2023-10-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2834	8	\N	2023-10-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2835	8	\N	2023-10-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2836	8	\N	2023-10-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2837	8	\N	2023-10-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2838	8	\N	2023-10-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2839	8	\N	2023-10-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2840	8	\N	2023-10-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2841	8	\N	2023-10-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2842	8	\N	2023-10-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2843	8	\N	2023-10-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2844	8	\N	2023-10-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2845	8	\N	2023-10-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2846	8	\N	2023-10-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2847	8	\N	2023-10-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2848	8	\N	2023-10-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2849	8	\N	2023-11-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2850	8	\N	2023-11-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2851	8	\N	2023-11-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2852	8	\N	2023-11-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2853	8	\N	2023-11-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2854	8	\N	2023-11-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2855	8	\N	2023-11-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2856	8	\N	2023-11-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2857	8	\N	2023-11-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2858	8	\N	2023-11-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2859	8	\N	2023-11-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2861	8	\N	2023-11-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2862	8	\N	2023-11-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2863	8	\N	2023-11-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2864	8	\N	2023-11-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2865	8	\N	2023-11-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2866	8	\N	2023-11-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2867	8	\N	2023-11-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2868	8	\N	2023-11-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2869	8	\N	2023-11-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2870	8	\N	2023-11-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2871	8	\N	2023-11-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2819	8	\N	2023-10-02	1	Approved	t	National Holiday	Hari Batik	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2860	8	\N	2023-11-12	1	Approved	t	National Holiday	Diwali / Deepavali	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2872	8	\N	2023-11-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2874	8	\N	2023-11-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2875	8	\N	2023-11-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2876	8	\N	2023-11-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2877	8	\N	2023-11-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2878	8	\N	2023-11-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2879	8	\N	2023-12-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2880	8	\N	2023-12-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2881	8	\N	2023-12-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2882	8	\N	2023-12-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2883	8	\N	2023-12-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2884	8	\N	2023-12-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2885	8	\N	2023-12-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2886	8	\N	2023-12-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2887	8	\N	2023-12-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2888	8	\N	2023-12-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2889	8	\N	2023-12-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2890	8	\N	2023-12-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2891	8	\N	2023-12-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2892	8	\N	2023-12-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2893	8	\N	2023-12-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2894	8	\N	2023-12-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2895	8	\N	2023-12-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2896	8	\N	2023-12-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2897	8	\N	2023-12-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2898	8	\N	2023-12-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2899	8	\N	2023-12-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2901	8	\N	2023-12-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2905	8	\N	2023-12-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2906	8	\N	2023-12-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2907	8	\N	2023-12-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2908	8	\N	2023-12-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2911	8	\N	2024-01-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2912	8	\N	2024-01-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2913	8	\N	2024-01-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2914	8	\N	2024-01-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2915	8	\N	2024-01-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2916	8	\N	2024-01-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2917	8	\N	2024-01-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2918	8	\N	2024-01-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2919	8	\N	2024-01-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2920	8	\N	2024-01-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2921	8	\N	2024-01-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2922	8	\N	2024-01-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2923	8	\N	2024-01-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2924	8	\N	2024-01-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2925	8	\N	2024-01-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2926	8	\N	2024-01-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2927	8	\N	2024-01-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2928	8	\N	2024-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:56:21	2023-01-19 13:56:21
2929	9	\N	2023-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2930	9	\N	2023-01-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2931	9	\N	2023-01-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2934	9	\N	2023-01-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2935	9	\N	2023-01-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2936	9	\N	2023-01-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2937	9	\N	2023-01-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2938	9	\N	2023-01-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2939	9	\N	2023-01-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2940	9	\N	2023-01-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2941	9	\N	2023-01-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2942	9	\N	2023-02-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2943	9	\N	2023-02-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2944	9	\N	2023-02-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2945	9	\N	2023-02-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2946	9	\N	2023-02-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2947	9	\N	2023-02-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2948	9	\N	2023-02-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2949	9	\N	2023-02-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2950	9	\N	2023-02-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2951	9	\N	2023-02-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2952	9	\N	2023-02-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2953	9	\N	2023-02-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2954	9	\N	2023-02-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2955	9	\N	2023-02-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2956	9	\N	2023-02-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2957	9	\N	2023-02-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2958	9	\N	2023-02-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2900	8	\N	2023-12-22	1	Approved	t	National Holiday	Hari Ibu	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2902	8	\N	2023-12-24	1	Approved	t	National Holiday	Malam Natal	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2904	8	\N	2023-12-26	1	Approved	t	National Holiday	Cuti Bersama Natal (Hari Tinju)	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2909	8	\N	2023-12-31	1	Approved	t	National Holiday	Malam Tahun Baru	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2932	9	\N	2023-01-22	1	Approved	t	National Holiday	Tahun Baru Imlek	t	2	2023-01-19 13:57:05	2023-01-20 18:49:39
2933	9	\N	2023-01-23	1	Approved	t	National Holiday	Lunar New Year Joint Holiday	t	2	2023-01-19 13:57:05	2023-01-20 18:49:39
2960	9	\N	2023-02-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2961	9	\N	2023-02-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2962	9	\N	2023-02-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2963	9	\N	2023-02-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2964	9	\N	2023-02-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2965	9	\N	2023-02-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2966	9	\N	2023-02-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2967	9	\N	2023-02-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2968	9	\N	2023-02-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2969	9	\N	2023-02-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2970	9	\N	2023-03-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2971	9	\N	2023-03-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2972	9	\N	2023-03-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2973	9	\N	2023-03-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2974	9	\N	2023-03-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2975	9	\N	2023-03-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2976	9	\N	2023-03-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2977	9	\N	2023-03-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2978	9	\N	2023-03-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2979	9	\N	2023-03-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2980	9	\N	2023-03-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2981	9	\N	2023-03-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2982	9	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2983	9	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2984	9	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2985	9	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2986	9	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2987	9	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2988	9	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2989	9	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2990	9	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2993	9	\N	2023-03-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2994	9	\N	2023-03-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2995	9	\N	2023-03-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2996	9	\N	2023-03-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2997	9	\N	2023-03-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2998	9	\N	2023-03-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
2999	9	\N	2023-03-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3000	9	\N	2023-03-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3001	9	\N	2023-04-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3002	9	\N	2023-04-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3003	9	\N	2023-04-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3004	9	\N	2023-04-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3005	9	\N	2023-04-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3006	9	\N	2023-04-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3008	9	\N	2023-04-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3010	9	\N	2023-04-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3011	9	\N	2023-04-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3012	9	\N	2023-04-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3013	9	\N	2023-04-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3014	9	\N	2023-04-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3015	9	\N	2023-04-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3016	9	\N	2023-04-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3017	9	\N	2023-04-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3018	9	\N	2023-04-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3019	9	\N	2023-04-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3020	9	\N	2023-04-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3027	9	\N	2023-04-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3028	9	\N	2023-04-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3029	9	\N	2023-04-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3030	9	\N	2023-04-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3032	9	\N	2023-05-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3033	9	\N	2023-05-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3034	9	\N	2023-05-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3035	9	\N	2023-05-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3036	9	\N	2023-05-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3037	9	\N	2023-05-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3038	9	\N	2023-05-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3039	9	\N	2023-05-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3040	9	\N	2023-05-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3041	9	\N	2023-05-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3042	9	\N	2023-05-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3043	9	\N	2023-05-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3044	9	\N	2023-05-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3045	9	\N	2023-05-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3046	9	\N	2023-05-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3047	9	\N	2023-05-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3007	9	\N	2023-04-07	1	Approved	t	National Holiday	Wafat Isa Almasih	t	2	2023-01-19 13:57:05	2023-01-20 18:49:39
3009	9	\N	2023-04-09	1	Approved	t	National Holiday	Hari Paskah	t	2	2023-01-19 13:57:05	2023-01-20 18:49:39
3021	9	\N	2023-04-21	1	Approved	t	National Holiday	Hari Kartini	t	2	2023-01-19 13:57:05	2023-01-20 18:49:39
3022	9	\N	2023-04-22	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 13:57:05	2023-01-20 18:49:39
3024	9	\N	2023-04-24	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 13:57:05	2023-01-20 18:49:39
3025	9	\N	2023-04-25	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 13:57:05	2023-01-20 18:49:39
3031	9	\N	2023-05-01	1	Approved	t	National Holiday	Hari Buruh Internasional / Pekerja	t	2	2023-01-19 13:57:05	2023-01-20 18:49:40
3049	9	\N	2023-05-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3050	9	\N	2023-05-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3051	9	\N	2023-05-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3052	9	\N	2023-05-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3053	9	\N	2023-05-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3054	9	\N	2023-05-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3055	9	\N	2023-05-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3056	9	\N	2023-05-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3057	9	\N	2023-05-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3058	9	\N	2023-05-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3059	9	\N	2023-05-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3060	9	\N	2023-05-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3061	9	\N	2023-05-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3064	9	\N	2023-06-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3066	9	\N	2023-06-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3067	9	\N	2023-06-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3068	9	\N	2023-06-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3069	9	\N	2023-06-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3070	9	\N	2023-06-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3071	9	\N	2023-06-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3072	9	\N	2023-06-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3073	9	\N	2023-06-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3074	9	\N	2023-06-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3075	9	\N	2023-06-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3076	9	\N	2023-06-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3077	9	\N	2023-06-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3078	9	\N	2023-06-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3079	9	\N	2023-06-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3080	9	\N	2023-06-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3081	9	\N	2023-06-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3082	9	\N	2023-06-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3083	9	\N	2023-06-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3084	9	\N	2023-06-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3085	9	\N	2023-06-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3086	9	\N	2023-06-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3087	9	\N	2023-06-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3088	9	\N	2023-06-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3089	9	\N	2023-06-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3091	9	\N	2023-06-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3092	9	\N	2023-07-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3093	9	\N	2023-07-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3094	9	\N	2023-07-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3095	9	\N	2023-07-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3096	9	\N	2023-07-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3097	9	\N	2023-07-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3098	9	\N	2023-07-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3099	9	\N	2023-07-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3100	9	\N	2023-07-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:05	2023-01-19 13:57:05
3101	9	\N	2023-07-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3102	9	\N	2023-07-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3103	9	\N	2023-07-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3104	9	\N	2023-07-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3105	9	\N	2023-07-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3106	9	\N	2023-07-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3107	9	\N	2023-07-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3108	9	\N	2023-07-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3109	9	\N	2023-07-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3111	9	\N	2023-07-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3112	9	\N	2023-07-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3113	9	\N	2023-07-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3114	9	\N	2023-07-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3115	9	\N	2023-07-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3116	9	\N	2023-07-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3117	9	\N	2023-07-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3118	9	\N	2023-07-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3119	9	\N	2023-07-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3120	9	\N	2023-07-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3121	9	\N	2023-07-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3122	9	\N	2023-07-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3123	9	\N	2023-08-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3124	9	\N	2023-08-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3125	9	\N	2023-08-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3126	9	\N	2023-08-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3127	9	\N	2023-08-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3128	9	\N	2023-08-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3129	9	\N	2023-08-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3130	9	\N	2023-08-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3131	9	\N	2023-08-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3132	9	\N	2023-08-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3133	9	\N	2023-08-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3134	9	\N	2023-08-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3135	9	\N	2023-08-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3062	9	\N	2023-06-01	1	Approved	t	National Holiday	Hari Lahir Pancasila	t	2	2023-01-19 13:57:05	2023-01-20 18:49:40
3065	9	\N	2023-06-04	1	Approved	t	National Holiday	Hari Raya Waisak	t	2	2023-01-19 13:57:05	2023-01-20 18:49:40
3090	9	\N	2023-06-29	1	Approved	t	National Holiday	Idul Adha (Lebaran Haji)	t	2	2023-01-19 13:57:05	2023-01-20 18:49:40
3136	9	\N	2023-08-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3137	9	\N	2023-08-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3138	9	\N	2023-08-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3140	9	\N	2023-08-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3141	9	\N	2023-08-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3142	9	\N	2023-08-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3143	9	\N	2023-08-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3144	9	\N	2023-08-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3145	9	\N	2023-08-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3146	9	\N	2023-08-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3147	9	\N	2023-08-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3148	9	\N	2023-08-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3149	9	\N	2023-08-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3150	9	\N	2023-08-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3151	9	\N	2023-08-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3152	9	\N	2023-08-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3153	9	\N	2023-08-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3154	9	\N	2023-09-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3155	9	\N	2023-09-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3156	9	\N	2023-09-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3157	9	\N	2023-09-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3158	9	\N	2023-09-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3159	9	\N	2023-09-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3160	9	\N	2023-09-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3161	9	\N	2023-09-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3162	9	\N	2023-09-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3163	9	\N	2023-09-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3164	9	\N	2023-09-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3165	9	\N	2023-09-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3166	9	\N	2023-09-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3167	9	\N	2023-09-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3168	9	\N	2023-09-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3169	9	\N	2023-09-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3170	9	\N	2023-09-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3171	9	\N	2023-09-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3172	9	\N	2023-09-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3173	9	\N	2023-09-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3174	9	\N	2023-09-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3175	9	\N	2023-09-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3176	9	\N	2023-09-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3177	9	\N	2023-09-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3178	9	\N	2023-09-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3179	9	\N	2023-09-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3180	9	\N	2023-09-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3182	9	\N	2023-09-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3183	9	\N	2023-09-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3184	9	\N	2023-10-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3186	9	\N	2023-10-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3187	9	\N	2023-10-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3188	9	\N	2023-10-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3189	9	\N	2023-10-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3190	9	\N	2023-10-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3191	9	\N	2023-10-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3192	9	\N	2023-10-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3193	9	\N	2023-10-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3194	9	\N	2023-10-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3195	9	\N	2023-10-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3196	9	\N	2023-10-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3197	9	\N	2023-10-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3198	9	\N	2023-10-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3199	9	\N	2023-10-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3200	9	\N	2023-10-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3201	9	\N	2023-10-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3202	9	\N	2023-10-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3203	9	\N	2023-10-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3204	9	\N	2023-10-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3205	9	\N	2023-10-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3206	9	\N	2023-10-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3207	9	\N	2023-10-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3208	9	\N	2023-10-25	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3209	9	\N	2023-10-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3210	9	\N	2023-10-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3211	9	\N	2023-10-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3212	9	\N	2023-10-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3213	9	\N	2023-10-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3214	9	\N	2023-10-31	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3215	9	\N	2023-11-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3216	9	\N	2023-11-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3217	9	\N	2023-11-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3218	9	\N	2023-11-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3219	9	\N	2023-11-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3220	9	\N	2023-11-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3221	9	\N	2023-11-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3222	9	\N	2023-11-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3223	9	\N	2023-11-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3181	9	\N	2023-09-28	1	Approved	t	National Holiday	Maulid Nabi Muhammad	t	2	2023-01-19 13:57:06	2023-01-20 18:49:40
3185	9	\N	2023-10-02	1	Approved	t	National Holiday	Hari Batik	t	2	2023-01-19 13:57:06	2023-01-20 18:49:40
3224	9	\N	2023-11-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3225	9	\N	2023-11-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3227	9	\N	2023-11-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3228	9	\N	2023-11-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3229	9	\N	2023-11-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3230	9	\N	2023-11-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3231	9	\N	2023-11-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3232	9	\N	2023-11-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3233	9	\N	2023-11-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3234	9	\N	2023-11-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3235	9	\N	2023-11-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3236	9	\N	2023-11-22	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3237	9	\N	2023-11-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3238	9	\N	2023-11-24	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3240	9	\N	2023-11-26	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3241	9	\N	2023-11-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3242	9	\N	2023-11-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3243	9	\N	2023-11-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3244	9	\N	2023-11-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3245	9	\N	2023-12-01	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3246	9	\N	2023-12-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3247	9	\N	2023-12-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3248	9	\N	2023-12-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3249	9	\N	2023-12-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3250	9	\N	2023-12-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3251	9	\N	2023-12-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3252	9	\N	2023-12-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3253	9	\N	2023-12-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3254	9	\N	2023-12-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3255	9	\N	2023-12-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3256	9	\N	2023-12-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3257	9	\N	2023-12-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3258	9	\N	2023-12-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3259	9	\N	2023-12-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3260	9	\N	2023-12-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3261	9	\N	2023-12-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3262	9	\N	2023-12-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3263	9	\N	2023-12-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3264	9	\N	2023-12-20	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3265	9	\N	2023-12-21	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3267	9	\N	2023-12-23	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3271	9	\N	2023-12-27	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3272	9	\N	2023-12-28	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3273	9	\N	2023-12-29	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3274	9	\N	2023-12-30	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3277	9	\N	2024-01-02	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3278	9	\N	2024-01-03	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3279	9	\N	2024-01-04	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3280	9	\N	2024-01-05	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3281	9	\N	2024-01-06	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3282	9	\N	2024-01-07	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3283	9	\N	2024-01-08	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3284	9	\N	2024-01-09	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3285	9	\N	2024-01-10	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3286	9	\N	2024-01-11	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3287	9	\N	2024-01-12	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3288	9	\N	2024-01-13	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3289	9	\N	2024-01-14	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3290	9	\N	2024-01-15	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3291	9	\N	2024-01-16	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3292	9	\N	2024-01-17	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3293	9	\N	2024-01-18	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
3294	9	\N	2024-01-19	1	Approved	f	\N	\N	t	2	2023-01-19 13:57:06	2023-01-19 13:57:06
1102	4	\N	2023-01-22	1	Approved	t	National Holiday	Tahun Baru Imlek	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1103	4	\N	2023-01-23	1	Approved	t	National Holiday	Lunar New Year Joint Holiday	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1129	4	\N	2023-02-18	1	Approved	t	National Holiday	Isra Mikraj Nabi Muhammad	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1162	4	\N	2023-03-23	1	Approved	t	National Holiday	Joint Holiday for Bali's Day of Silence and Hindu New Year (Nyepi)	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1192	4	\N	2023-04-22	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1195	4	\N	2023-04-25	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1201	4	\N	2023-05-01	1	Approved	t	National Holiday	Hari Buruh Internasional / Pekerja	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1232	4	\N	2023-06-01	1	Approved	t	National Holiday	Hari Lahir Pancasila	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1280	4	\N	2023-07-19	1	Approved	t	National Holiday	Satu Muharam / Tahun Baru Hijriah	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1309	4	\N	2023-08-17	1	Approved	t	National Holiday	Hari Proklamasi Kemerdekaan R.I.	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1396	4	\N	2023-11-12	1	Approved	t	National Holiday	Diwali / Deepavali	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1438	4	\N	2023-12-24	1	Approved	t	National Holiday	Malam Natal	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
3266	9	\N	2023-12-22	1	Approved	t	National Holiday	Hari Ibu	t	2	2023-01-19 13:57:06	2023-01-20 18:49:40
3268	9	\N	2023-12-24	1	Approved	t	National Holiday	Malam Natal	t	2	2023-01-19 13:57:06	2023-01-20 18:49:40
3269	9	\N	2023-12-25	1	Approved	t	National Holiday	Hari Raya Natal	t	2	2023-01-19 13:57:06	2023-01-20 18:49:40
3275	9	\N	2023-12-31	1	Approved	t	National Holiday	Malam Tahun Baru	t	2	2023-01-19 13:57:06	2023-01-20 18:49:40
3276	9	\N	2024-01-01	1	Approved	t	National Holiday	Hari Tahun Baru	t	2	2023-01-19 13:57:06	2023-01-20 18:49:40
1445	4	\N	2023-12-31	1	Approved	t	National Holiday	Malam Tahun Baru	t	2	2023-01-19 12:25:59	2023-01-20 18:49:39
1468	5	\N	2023-01-22	1	Approved	t	National Holiday	Tahun Baru Imlek	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1495	5	\N	2023-02-18	1	Approved	t	National Holiday	Isra Mikraj Nabi Muhammad	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1528	5	\N	2023-03-23	1	Approved	t	National Holiday	Joint Holiday for Bali's Day of Silence and Hindu New Year (Nyepi)	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1557	5	\N	2023-04-21	1	Approved	t	National Holiday	Hari Kartini	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1560	5	\N	2023-04-24	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1567	5	\N	2023-05-01	1	Approved	t	National Holiday	Hari Buruh Internasional / Pekerja	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1599	5	\N	2023-06-02	1	Approved	t	National Holiday	Cuti Bersama Waisak	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1646	5	\N	2023-07-19	1	Approved	t	National Holiday	Satu Muharam / Tahun Baru Hijriah	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1717	5	\N	2023-09-28	1	Approved	t	National Holiday	Maulid Nabi Muhammad	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1762	5	\N	2023-11-12	1	Approved	t	National Holiday	Diwali / Deepavali	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1804	5	\N	2023-12-24	1	Approved	t	National Holiday	Malam Natal	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1811	5	\N	2023-12-31	1	Approved	t	National Holiday	Malam Tahun Baru	t	2	2023-01-19 12:26:43	2023-01-20 18:49:39
1834	6	\N	2023-01-22	1	Approved	t	National Holiday	Tahun Baru Imlek	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1861	6	\N	2023-02-18	1	Approved	t	National Holiday	Isra Mikraj Nabi Muhammad	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1894	6	\N	2023-03-23	1	Approved	t	National Holiday	Joint Holiday for Bali's Day of Silence and Hindu New Year (Nyepi)	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1909	6	\N	2023-04-07	1	Approved	t	National Holiday	Wafat Isa Almasih	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1924	6	\N	2023-04-22	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1927	6	\N	2023-04-25	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1950	6	\N	2023-05-18	1	Approved	t	National Holiday	Kenaikan Isa Al Masih	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1967	6	\N	2023-06-04	1	Approved	t	National Holiday	Hari Raya Waisak	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
1992	6	\N	2023-06-29	1	Approved	t	National Holiday	Idul Adha (Lebaran Haji)	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
2041	6	\N	2023-08-17	1	Approved	t	National Holiday	Hari Proklamasi Kemerdekaan R.I.	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
2083	6	\N	2023-09-28	1	Approved	t	National Holiday	Maulid Nabi Muhammad	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
2141	6	\N	2023-11-25	1	Approved	t	National Holiday	Hari Guru	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
2168	6	\N	2023-12-22	1	Approved	t	National Holiday	Hari Ibu	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
2172	6	\N	2023-12-26	1	Approved	t	National Holiday	Cuti Bersama Natal (Hari Tinju)	t	2	2023-01-19 13:54:15	2023-01-20 18:49:39
2200	7	\N	2023-01-22	1	Approved	t	National Holiday	Tahun Baru Imlek	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2259	7	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2260	7	\N	2023-03-23	1	Approved	t	National Holiday	Joint Holiday for Bali's Day of Silence and Hindu New Year (Nyepi)	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2291	7	\N	2023-04-23	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2294	7	\N	2023-04-26	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2330	7	\N	2023-06-01	1	Approved	t	National Holiday	Hari Lahir Pancasila	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2358	7	\N	2023-06-29	1	Approved	t	National Holiday	Idul Adha (Lebaran Haji)	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2407	7	\N	2023-08-17	1	Approved	t	National Holiday	Hari Proklamasi Kemerdekaan R.I.	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2449	7	\N	2023-09-28	1	Approved	t	National Holiday	Maulid Nabi Muhammad	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2507	7	\N	2023-11-25	1	Approved	t	National Holiday	Hari Guru	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2534	7	\N	2023-12-22	1	Approved	t	National Holiday	Hari Ibu	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2538	7	\N	2023-12-26	1	Approved	t	National Holiday	Cuti Bersama Natal (Hari Tinju)	t	2	2023-01-19 13:54:47	2023-01-20 18:49:39
2566	8	\N	2023-01-22	1	Approved	t	National Holiday	Tahun Baru Imlek	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2625	8	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2626	8	\N	2023-03-23	1	Approved	t	National Holiday	Joint Holiday for Bali's Day of Silence and Hindu New Year (Nyepi)	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2657	8	\N	2023-04-23	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2660	8	\N	2023-04-26	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2696	8	\N	2023-06-01	1	Approved	t	National Holiday	Hari Lahir Pancasila	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2724	8	\N	2023-06-29	1	Approved	t	National Holiday	Idul Adha (Lebaran Haji)	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2773	8	\N	2023-08-17	1	Approved	t	National Holiday	Hari Proklamasi Kemerdekaan R.I.	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2815	8	\N	2023-09-28	1	Approved	t	National Holiday	Maulid Nabi Muhammad	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2873	8	\N	2023-11-25	1	Approved	t	National Holiday	Hari Guru	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2903	8	\N	2023-12-25	1	Approved	t	National Holiday	Hari Raya Natal	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2910	8	\N	2024-01-01	1	Approved	t	National Holiday	Hari Tahun Baru	t	2	2023-01-19 13:56:21	2023-01-20 18:49:39
2959	9	\N	2023-02-18	1	Approved	t	National Holiday	Isra Mikraj Nabi Muhammad	t	2	2023-01-19 13:57:05	2023-01-20 18:49:39
2991	9	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-01-19 13:57:05	2023-01-20 18:49:39
2992	9	\N	2023-03-23	1	Approved	t	National Holiday	Joint Holiday for Bali's Day of Silence and Hindu New Year (Nyepi)	t	2	2023-01-19 13:57:05	2023-01-20 18:49:39
3023	9	\N	2023-04-23	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-19 13:57:05	2023-01-20 18:49:39
3026	9	\N	2023-04-26	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-19 13:57:05	2023-01-20 18:49:40
3048	9	\N	2023-05-18	1	Approved	t	National Holiday	Kenaikan Isa Al Masih	t	2	2023-01-19 13:57:05	2023-01-20 18:49:40
3063	9	\N	2023-06-02	1	Approved	t	National Holiday	Cuti Bersama Waisak	t	2	2023-01-19 13:57:05	2023-01-20 18:49:40
3110	9	\N	2023-07-19	1	Approved	t	National Holiday	Satu Muharam / Tahun Baru Hijriah	t	2	2023-01-19 13:57:06	2023-01-20 18:49:40
3139	9	\N	2023-08-17	1	Approved	t	National Holiday	Hari Proklamasi Kemerdekaan R.I.	t	2	2023-01-19 13:57:06	2023-01-20 18:49:40
3226	9	\N	2023-11-12	1	Approved	t	National Holiday	Diwali / Deepavali	t	2	2023-01-19 13:57:06	2023-01-20 18:49:40
3239	9	\N	2023-11-25	1	Approved	t	National Holiday	Hari Guru	t	2	2023-01-19 13:57:06	2023-01-20 18:49:40
3270	9	\N	2023-12-26	1	Approved	t	National Holiday	Cuti Bersama Natal (Hari Tinju)	t	2	2023-01-19 13:57:06	2023-01-20 18:49:40
\.


--
-- Name: shift_schedules_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('shift_schedules_id_seq', 3294, true);


--
-- Data for Name: shift_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY shift_types (id, day_type_id, name, start_time, end_time, is_wfh, created_by, created_at, updated_at) FROM stdin;
1	1	Reguler	08:00:00	16:00:00	f	2	2023-01-19 10:48:03	2023-01-19 10:48:03
2	1	Shift 1	07:00:00	14:00:00	f	2	2023-01-20 18:41:15	2023-01-20 18:41:15
\.


--
-- Name: shift_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('shift_types_id_seq', 2, true);


--
-- Data for Name: timesheets; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY timesheets (id, employee_id, project_stage, start_date, end_date, start_time, end_time, duration, task_or_project, activity, client_company, label_project, file_attachment, remark, support, status, rejected_reason, attachment_reject, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: timesheets_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('timesheets_id_seq', 1, false);


--
-- Data for Name: travel; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY travel (id, employee_id, start_date, end_date, purpose_of_visit, place_of_visit, description, status, rejected_reason, attachment_reject, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: travel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('travel_id_seq', 1, false);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY users (id, branch_id, name, email, email_verified_at, password, plan, plan_expire_date, type, avatar, lang, created_by, default_pipeline, delete_status, is_active, last_login_at, remember_token, created_at, updated_at) FROM stdin;
1	\N	Super Admin	superadmin@example.com	\N	$2y$10$oQtT.ahEGJ8lYz6T4a/IG.WUcwEvUrfVW.zCYHLhExamr/TOGbwZ2	\N	\N	super admin		en	0	\N	1	1	\N	\N	2023-01-19 10:48:02	2023-01-19 10:48:02
3	\N	accountant	accountant@pehadir.com	\N	$2y$10$qoQp91j5O24PVn4yuwg82ewrS5DGNM6mAZvuIpJYhxYgXLGBRQ/pS	\N	\N	accountant		en	2	1	1	1	\N	\N	2023-01-19 10:48:03	2023-01-19 10:48:03
4	1	FIKRI KURNIAWAN	acc@gmail.com	\N	$2y$10$rvYEGJlWxbc6FTlpTCSQhuBVccMZPRDrVwiIPt7PI/kum2DJjVfSK	\N	\N	accountant	\N	en	2	\N	1	1	\N	\N	2023-01-19 10:49:07	2023-01-19 10:49:07
5	1	RAGIL WALUYO	adadd@kas.clom	\N	$2y$10$I4prjEb7wdxBmrjsuaqneOV/aVU6L96FaqIUvg.omroqMC85fxRDK	\N	\N	accountant	\N	en	2	\N	1	1	\N	\N	2023-01-19 10:49:47	2023-01-19 10:49:47
6	2	TOPIK HIDAYAT	topik@pehadir.com	\N	$2y$10$MxhUNMf7g/fJENKM2oaUKO8fl60MYUahiqUylFYgvyt4O3dcHh9fG	\N	\N	accountant	\N	en	2	\N	1	1	\N	\N	2023-01-19 12:25:59	2023-01-19 12:25:59
7	2	ACIM SULAEMAN	acim@pehadir.com	\N	$2y$10$4YHtGpRbQzBtXyw/AX/b0ObBcEkzrcfVWNZ/p2vwD1O9iNFFpTI4O	\N	\N	accountant	\N	en	2	\N	1	1	\N	\N	2023-01-19 12:26:43	2023-01-19 12:26:43
8	2	MUHAMAD ENJEN	enjen@pehadir.com	\N	$2y$10$GDTIWcd6mYYbL6lSgWW9seL3pP7K78qgBaXWRGswIQYGdceck9AgW	\N	\N	accountant	\N	en	2	\N	1	1	\N	\N	2023-01-19 13:54:15	2023-01-19 13:54:15
9	2	IRMAN	irman@pehadir.com	\N	$2y$10$wYSNsqzQaWeim9LOqOGBweBivhGwWQf4aIbiSxFc7i.A1R86QJVSW	\N	\N	accountant	\N	en	2	\N	1	1	\N	\N	2023-01-19 13:54:47	2023-01-19 13:54:47
10	1	DEPRI	depri@pehadir.com	\N	$2y$10$T92FUkRf0fKF8dJRt.UrseXq3rnLz0pF3NP7o1Bja.GNQIA5OdqT.	\N	\N	accountant	\N	en	2	\N	1	1	\N	\N	2023-01-19 13:56:21	2023-01-19 13:56:21
11	2	FATONI	fatoni@pehadir.com	\N	$2y$10$twTyAsifwDOk2PqgLyKXNOq6kPr/QRBmyNjya6lQCSKjmznnLxS.i	\N	\N	accountant	\N	en	2	\N	1	1	2023-01-19 17:00:02	\N	2023-01-19 13:57:05	2023-01-19 17:00:02
2	\N	company	company@pehadir.com	\N	$2y$10$CdTaOJAfwzVjLzx4WhYyAO0G4at/dQrFfezBHWCbZOFPrTQ3UCT8a	1	\N	company		en	1	1	1	1	2023-01-20 18:40:24	\N	2023-01-19 10:48:02	2023-01-20 18:40:24
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('users_id_seq', 11, true);


--
-- PostgreSQL database dump complete
--

