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
1	2	1	accountant	company	Payroll	2022-12-21	\N	2	2022-12-21 10:21:17	2022-12-21 10:21:17
2	3	2	accountant	company	Payroll	2022-12-21	\N	2	2022-12-21 10:21:28	2022-12-21 10:21:28
3	4	3	accountant	company	Payroll	2022-12-21	\N	2	2022-12-21 10:22:37	2022-12-21 10:22:37
4	1	4	accountant	company	Reimburst	2022-12-21	\N	2	2022-12-21 10:22:52	2022-12-21 10:22:52
5	1	5	accountant	company	Cash Advance	2022-12-21	\N	2	2022-12-21 10:23:16	2022-12-21 10:23:16
6	1	6	accountant	company	Allowance	2022-12-21	\N	2	2022-12-21 10:23:30	2022-12-21 10:23:30
7	5	7	accountant	company	Payroll	2022-12-21	\N	2	2022-12-21 10:36:30	2022-12-21 10:36:30
8	2	8	accountant	company	Reimburst	2022-12-21	\N	2	2022-12-21 10:36:44	2022-12-21 10:36:44
9	2	9	accountant	company	Cash Advance	2022-12-21	\N	2	2022-12-21 10:36:59	2022-12-21 10:36:59
10	3	10	accountant	company	Cash Advance	2022-12-21	\N	2	2022-12-21 20:00:03	2022-12-21 20:00:03
11	4	11	accountant	company	Cash Advance	2022-12-21	\N	2	2022-12-21 20:00:17	2022-12-21 20:00:17
\.


--
-- Name: all_requests_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('all_requests_id_seq', 11, true);


--
-- Data for Name: allowance_finances; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY allowance_finances (id, employee_id, allowance_type_id, amount, created_by, created_at, updated_at) FROM stdin;
1	1	1	1	2	2022-12-21 10:23:30	2022-12-21 10:23:30
\.


--
-- Name: allowance_finances_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('allowance_finances_id_seq', 1, true);


--
-- Data for Name: allowance_options; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY allowance_options (id, name, created_by, created_at, updated_at) FROM stdin;
1	my reimburst one	2	2022-12-20 18:03:06	2022-12-20 18:03:06
2	Transportation	2	2022-12-20 18:16:32	2022-12-20 18:16:32
\.


--
-- Name: allowance_options_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('allowance_options_id_seq', 2, true);


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

COPY attendance_employees (id, employee_id, date, status, clock_in, clock_out, late, early_leaving, overtime, total_rest, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: attendance_employees_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('attendance_employees_id_seq', 1, false);


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
\.


--
-- Name: break_times_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('break_times_id_seq', 1, false);


--
-- Data for Name: cashes; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY cashes (id, employee_id, loan_type_id, amount, created_by, created_at, updated_at) FROM stdin;
1	1	1	22	2	2022-12-21 10:23:16	2022-12-21 10:23:16
2	1	2	400000	2	2022-12-21 10:36:59	2022-12-21 10:36:59
3	1	2	40000	2	2022-12-21 20:00:03	2022-12-21 20:00:03
4	1	2	60000	2	2022-12-21 20:00:17	2022-12-21 20:00:17
\.


--
-- Name: cashes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('cashes_id_seq', 4, true);


--
-- Data for Name: day_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY day_types (id, name, created_by, created_at, updated_at) FROM stdin;
1	work	2	2022-12-20 14:57:42	2022-12-20 14:57:42
\.


--
-- Name: day_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('day_types_id_seq', 1, true);


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
1	1	2022-01-01	2022-03-01	1	Programmer	Programmer	Peterongan	Jombang	Boring	\N	2022-12-20 14:57:42	2022-12-20 14:57:42
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

COPY employees (id, user_id, name, dob, gender, phone, address, email, password, employee_id, branch_id, department_id, designation_id, company_doj, company_doe, documents, account_holder_name, account_number, bank_name, bank_identifier_code, branch_location, tax_payer_id, salary_type, salary, is_active, created_by, created_at, updated_at) FROM stdin;
1	3	accountant	2001-05-01	Male	08119725162	Jl. semampir no.2, Malaysia	accountant@example.com	$2y$10$zyganaWgxsKTJM3ZfgJMaOy0C.g19.B40dEqEm9lNPqGBPKRPLW6q	1	1	0	0	2022-12-02	2023-12-02	\N	\N	\N	\N	\N	\N	\N	\N	\N	1	2	2022-12-20 14:57:41	2022-12-20 14:57:41
\.


--
-- Name: employees_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employees_id_seq', 1, true);


--
-- Data for Name: employements; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY employements (id, employee_id, movement_type, area, office, job_level, "position", type, note, created_at, updated_at) FROM stdin;
1	1	Hiring	Tangerang	Tangerang	Accountant	Accountant	KONTRAK	\N	2022-12-20 14:57:42	2022-12-20 14:57:42
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
1	Sick	3	2	2022-12-20 14:57:42	2022-12-20 14:57:42
\.


--
-- Name: leave_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('leave_types_id_seq', 1, true);


--
-- Data for Name: leaves; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY leaves (id, employee_id, leave_type_id, applied_on, start_date, end_date, total_leave_days, leave_reason, remark, status, rejected_reason, attachment_reject, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: leaves_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('leaves_id_seq', 1, false);


--
-- Data for Name: loan_options; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY loan_options (id, name, created_by, created_at, updated_at) FROM stdin;
1	my loan test	2	2022-12-20 18:05:31	2022-12-20 18:05:31
2	Fee Checkup	2	2022-12-20 18:16:26	2022-12-20 18:16:26
\.


--
-- Name: loan_options_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('loan_options_id_seq', 2, true);


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
18	2022_11_01_074859_create_allowance_options_table	1
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
\.


--
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY permissions (id, name, guard_name, created_at, updated_at) FROM stdin;
1	show hrm dashboard	web	2022-12-20 14:57:38	2022-12-20 14:57:38
2	copy invoice	web	2022-12-20 14:57:38	2022-12-20 14:57:38
3	show project dashboard	web	2022-12-20 14:57:38	2022-12-20 14:57:38
4	show account dashboard	web	2022-12-20 14:57:38	2022-12-20 14:57:38
5	manage user	web	2022-12-20 14:57:38	2022-12-20 14:57:38
6	create user	web	2022-12-20 14:57:38	2022-12-20 14:57:38
7	edit user	web	2022-12-20 14:57:38	2022-12-20 14:57:38
8	delete user	web	2022-12-20 14:57:38	2022-12-20 14:57:38
9	create language	web	2022-12-20 14:57:38	2022-12-20 14:57:38
10	manage role	web	2022-12-20 14:57:38	2022-12-20 14:57:38
11	create role	web	2022-12-20 14:57:38	2022-12-20 14:57:38
12	edit role	web	2022-12-20 14:57:38	2022-12-20 14:57:38
13	delete role	web	2022-12-20 14:57:38	2022-12-20 14:57:38
14	manage permission	web	2022-12-20 14:57:38	2022-12-20 14:57:38
15	create permission	web	2022-12-20 14:57:38	2022-12-20 14:57:38
16	edit permission	web	2022-12-20 14:57:38	2022-12-20 14:57:38
17	delete permission	web	2022-12-20 14:57:38	2022-12-20 14:57:38
18	manage company settings	web	2022-12-20 14:57:38	2022-12-20 14:57:38
19	manage print settings	web	2022-12-20 14:57:38	2022-12-20 14:57:38
20	manage business settings	web	2022-12-20 14:57:38	2022-12-20 14:57:38
21	manage stripe settings	web	2022-12-20 14:57:38	2022-12-20 14:57:38
22	manage expense	web	2022-12-20 14:57:38	2022-12-20 14:57:38
23	create expense	web	2022-12-20 14:57:38	2022-12-20 14:57:38
24	edit expense	web	2022-12-20 14:57:38	2022-12-20 14:57:38
25	delete expense	web	2022-12-20 14:57:38	2022-12-20 14:57:38
26	manage invoice	web	2022-12-20 14:57:38	2022-12-20 14:57:38
27	create invoice	web	2022-12-20 14:57:38	2022-12-20 14:57:38
28	edit invoice	web	2022-12-20 14:57:38	2022-12-20 14:57:38
29	delete invoice	web	2022-12-20 14:57:38	2022-12-20 14:57:38
30	show invoice	web	2022-12-20 14:57:38	2022-12-20 14:57:38
31	create payment invoice	web	2022-12-20 14:57:38	2022-12-20 14:57:38
32	delete payment invoice	web	2022-12-20 14:57:38	2022-12-20 14:57:38
33	send invoice	web	2022-12-20 14:57:38	2022-12-20 14:57:38
34	delete invoice product	web	2022-12-20 14:57:38	2022-12-20 14:57:38
35	convert invoice	web	2022-12-20 14:57:38	2022-12-20 14:57:38
36	manage constant unit	web	2022-12-20 14:57:38	2022-12-20 14:57:38
37	create constant unit	web	2022-12-20 14:57:38	2022-12-20 14:57:38
38	edit constant unit	web	2022-12-20 14:57:38	2022-12-20 14:57:38
39	delete constant unit	web	2022-12-20 14:57:38	2022-12-20 14:57:38
40	manage constant tax	web	2022-12-20 14:57:38	2022-12-20 14:57:38
41	create constant tax	web	2022-12-20 14:57:38	2022-12-20 14:57:38
42	edit constant tax	web	2022-12-20 14:57:38	2022-12-20 14:57:38
43	delete constant tax	web	2022-12-20 14:57:38	2022-12-20 14:57:38
44	manage constant category	web	2022-12-20 14:57:38	2022-12-20 14:57:38
45	create constant category	web	2022-12-20 14:57:38	2022-12-20 14:57:38
46	edit constant category	web	2022-12-20 14:57:38	2022-12-20 14:57:38
47	delete constant category	web	2022-12-20 14:57:38	2022-12-20 14:57:38
48	manage product & service	web	2022-12-20 14:57:38	2022-12-20 14:57:38
49	create product & service	web	2022-12-20 14:57:38	2022-12-20 14:57:38
50	edit product & service	web	2022-12-20 14:57:38	2022-12-20 14:57:38
51	delete product & service	web	2022-12-20 14:57:38	2022-12-20 14:57:38
52	manage customer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
53	create customer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
54	edit customer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
55	delete customer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
56	show customer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
57	manage vender	web	2022-12-20 14:57:38	2022-12-20 14:57:38
58	create vender	web	2022-12-20 14:57:38	2022-12-20 14:57:38
59	edit vender	web	2022-12-20 14:57:38	2022-12-20 14:57:38
60	delete vender	web	2022-12-20 14:57:38	2022-12-20 14:57:38
61	show vender	web	2022-12-20 14:57:38	2022-12-20 14:57:38
62	manage bank account	web	2022-12-20 14:57:38	2022-12-20 14:57:38
63	create bank account	web	2022-12-20 14:57:38	2022-12-20 14:57:38
64	edit bank account	web	2022-12-20 14:57:38	2022-12-20 14:57:38
65	delete bank account	web	2022-12-20 14:57:38	2022-12-20 14:57:38
66	manage bank transfer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
67	create bank transfer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
68	edit bank transfer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
69	delete bank transfer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
70	manage transaction	web	2022-12-20 14:57:38	2022-12-20 14:57:38
71	manage revenue	web	2022-12-20 14:57:38	2022-12-20 14:57:38
72	create revenue	web	2022-12-20 14:57:38	2022-12-20 14:57:38
73	edit revenue	web	2022-12-20 14:57:38	2022-12-20 14:57:38
74	delete revenue	web	2022-12-20 14:57:38	2022-12-20 14:57:38
75	manage bill	web	2022-12-20 14:57:38	2022-12-20 14:57:38
76	create bill	web	2022-12-20 14:57:38	2022-12-20 14:57:38
77	edit bill	web	2022-12-20 14:57:38	2022-12-20 14:57:38
78	delete bill	web	2022-12-20 14:57:38	2022-12-20 14:57:38
79	show bill	web	2022-12-20 14:57:38	2022-12-20 14:57:38
80	manage payment	web	2022-12-20 14:57:38	2022-12-20 14:57:38
81	create payment	web	2022-12-20 14:57:38	2022-12-20 14:57:38
82	edit payment	web	2022-12-20 14:57:38	2022-12-20 14:57:38
83	delete payment	web	2022-12-20 14:57:38	2022-12-20 14:57:38
84	delete bill product	web	2022-12-20 14:57:38	2022-12-20 14:57:38
85	send bill	web	2022-12-20 14:57:38	2022-12-20 14:57:38
86	create payment bill	web	2022-12-20 14:57:38	2022-12-20 14:57:38
87	delete payment bill	web	2022-12-20 14:57:38	2022-12-20 14:57:38
88	manage order	web	2022-12-20 14:57:38	2022-12-20 14:57:38
89	income report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
90	expense report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
91	income vs expense report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
92	invoice report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
93	bill report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
94	stock report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
95	tax report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
96	loss & profit report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
97	manage customer payment	web	2022-12-20 14:57:38	2022-12-20 14:57:38
98	manage customer transaction	web	2022-12-20 14:57:38	2022-12-20 14:57:38
99	manage customer invoice	web	2022-12-20 14:57:38	2022-12-20 14:57:38
100	vender manage bill	web	2022-12-20 14:57:38	2022-12-20 14:57:38
101	manage vender bill	web	2022-12-20 14:57:38	2022-12-20 14:57:38
102	manage vender payment	web	2022-12-20 14:57:38	2022-12-20 14:57:38
103	manage vender transaction	web	2022-12-20 14:57:38	2022-12-20 14:57:38
104	manage credit note	web	2022-12-20 14:57:38	2022-12-20 14:57:38
105	create credit note	web	2022-12-20 14:57:38	2022-12-20 14:57:38
106	edit credit note	web	2022-12-20 14:57:38	2022-12-20 14:57:38
107	delete credit note	web	2022-12-20 14:57:38	2022-12-20 14:57:38
108	manage debit note	web	2022-12-20 14:57:38	2022-12-20 14:57:38
109	create debit note	web	2022-12-20 14:57:38	2022-12-20 14:57:38
110	edit debit note	web	2022-12-20 14:57:38	2022-12-20 14:57:38
111	delete debit note	web	2022-12-20 14:57:38	2022-12-20 14:57:38
112	duplicate invoice	web	2022-12-20 14:57:38	2022-12-20 14:57:38
113	duplicate bill	web	2022-12-20 14:57:38	2022-12-20 14:57:38
114	manage proposal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
115	create proposal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
116	edit proposal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
117	delete proposal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
118	duplicate proposal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
119	show proposal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
120	send proposal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
121	delete proposal product	web	2022-12-20 14:57:38	2022-12-20 14:57:38
122	manage customer proposal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
123	manage goal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
124	create goal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
125	edit goal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
126	delete goal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
127	manage assets	web	2022-12-20 14:57:38	2022-12-20 14:57:38
128	create assets	web	2022-12-20 14:57:38	2022-12-20 14:57:38
129	edit assets	web	2022-12-20 14:57:38	2022-12-20 14:57:38
130	delete assets	web	2022-12-20 14:57:38	2022-12-20 14:57:38
131	statement report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
132	manage constant custom field	web	2022-12-20 14:57:38	2022-12-20 14:57:38
133	create constant custom field	web	2022-12-20 14:57:38	2022-12-20 14:57:38
134	edit constant custom field	web	2022-12-20 14:57:38	2022-12-20 14:57:38
135	delete constant custom field	web	2022-12-20 14:57:38	2022-12-20 14:57:38
136	manage chart of account	web	2022-12-20 14:57:38	2022-12-20 14:57:38
137	create chart of account	web	2022-12-20 14:57:38	2022-12-20 14:57:38
138	edit chart of account	web	2022-12-20 14:57:38	2022-12-20 14:57:38
139	delete chart of account	web	2022-12-20 14:57:38	2022-12-20 14:57:38
140	manage journal entry	web	2022-12-20 14:57:38	2022-12-20 14:57:38
141	create journal entry	web	2022-12-20 14:57:38	2022-12-20 14:57:38
142	edit journal entry	web	2022-12-20 14:57:38	2022-12-20 14:57:38
143	delete journal entry	web	2022-12-20 14:57:38	2022-12-20 14:57:38
144	show journal entry	web	2022-12-20 14:57:38	2022-12-20 14:57:38
145	balance sheet report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
146	ledger report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
147	trial balance report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
148	manage client	web	2022-12-20 14:57:38	2022-12-20 14:57:38
149	create client	web	2022-12-20 14:57:38	2022-12-20 14:57:38
150	edit client	web	2022-12-20 14:57:38	2022-12-20 14:57:38
151	delete client	web	2022-12-20 14:57:38	2022-12-20 14:57:38
152	manage lead	web	2022-12-20 14:57:38	2022-12-20 14:57:38
153	create lead	web	2022-12-20 14:57:38	2022-12-20 14:57:38
154	view lead	web	2022-12-20 14:57:38	2022-12-20 14:57:38
155	edit lead	web	2022-12-20 14:57:38	2022-12-20 14:57:38
156	delete lead	web	2022-12-20 14:57:38	2022-12-20 14:57:38
157	move lead	web	2022-12-20 14:57:38	2022-12-20 14:57:38
158	create lead call	web	2022-12-20 14:57:38	2022-12-20 14:57:38
159	edit lead call	web	2022-12-20 14:57:38	2022-12-20 14:57:38
160	delete lead call	web	2022-12-20 14:57:38	2022-12-20 14:57:38
161	create lead email	web	2022-12-20 14:57:38	2022-12-20 14:57:38
162	manage pipeline	web	2022-12-20 14:57:38	2022-12-20 14:57:38
163	create pipeline	web	2022-12-20 14:57:38	2022-12-20 14:57:38
164	edit pipeline	web	2022-12-20 14:57:38	2022-12-20 14:57:38
165	delete pipeline	web	2022-12-20 14:57:38	2022-12-20 14:57:38
166	manage lead stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
167	create lead stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
168	edit lead stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
169	delete lead stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
170	convert lead to deal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
171	manage source	web	2022-12-20 14:57:38	2022-12-20 14:57:38
172	create source	web	2022-12-20 14:57:38	2022-12-20 14:57:38
173	edit source	web	2022-12-20 14:57:38	2022-12-20 14:57:38
174	delete source	web	2022-12-20 14:57:38	2022-12-20 14:57:38
175	manage label	web	2022-12-20 14:57:38	2022-12-20 14:57:38
176	create label	web	2022-12-20 14:57:38	2022-12-20 14:57:38
177	edit label	web	2022-12-20 14:57:38	2022-12-20 14:57:38
178	delete label	web	2022-12-20 14:57:38	2022-12-20 14:57:38
179	manage deal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
180	create deal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
181	view task	web	2022-12-20 14:57:38	2022-12-20 14:57:38
182	create task	web	2022-12-20 14:57:38	2022-12-20 14:57:38
183	edit task	web	2022-12-20 14:57:38	2022-12-20 14:57:38
184	delete task	web	2022-12-20 14:57:38	2022-12-20 14:57:38
185	edit deal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
186	view deal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
187	delete deal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
188	move deal	web	2022-12-20 14:57:38	2022-12-20 14:57:38
189	create deal call	web	2022-12-20 14:57:38	2022-12-20 14:57:38
190	edit deal call	web	2022-12-20 14:57:38	2022-12-20 14:57:38
191	delete deal call	web	2022-12-20 14:57:38	2022-12-20 14:57:38
192	create deal email	web	2022-12-20 14:57:38	2022-12-20 14:57:38
193	manage stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
194	create stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
195	edit stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
196	delete stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
197	manage employee	web	2022-12-20 14:57:38	2022-12-20 14:57:38
198	create employee	web	2022-12-20 14:57:38	2022-12-20 14:57:38
199	view employee	web	2022-12-20 14:57:38	2022-12-20 14:57:38
200	edit employee	web	2022-12-20 14:57:38	2022-12-20 14:57:38
201	delete employee	web	2022-12-20 14:57:38	2022-12-20 14:57:38
202	manage employee profile	web	2022-12-20 14:57:38	2022-12-20 14:57:38
203	show employee profile	web	2022-12-20 14:57:38	2022-12-20 14:57:38
204	manage department	web	2022-12-20 14:57:38	2022-12-20 14:57:38
205	create department	web	2022-12-20 14:57:38	2022-12-20 14:57:38
206	view department	web	2022-12-20 14:57:38	2022-12-20 14:57:38
207	edit department	web	2022-12-20 14:57:38	2022-12-20 14:57:38
208	delete department	web	2022-12-20 14:57:38	2022-12-20 14:57:38
209	manage designation	web	2022-12-20 14:57:38	2022-12-20 14:57:38
210	create designation	web	2022-12-20 14:57:38	2022-12-20 14:57:38
211	view designation	web	2022-12-20 14:57:38	2022-12-20 14:57:38
212	edit designation	web	2022-12-20 14:57:38	2022-12-20 14:57:38
213	delete designation	web	2022-12-20 14:57:38	2022-12-20 14:57:38
214	manage branch	web	2022-12-20 14:57:38	2022-12-20 14:57:38
215	create branch	web	2022-12-20 14:57:38	2022-12-20 14:57:38
216	edit branch	web	2022-12-20 14:57:38	2022-12-20 14:57:38
217	delete branch	web	2022-12-20 14:57:38	2022-12-20 14:57:38
218	manage document type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
219	create document type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
220	edit document type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
221	delete document type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
222	manage document	web	2022-12-20 14:57:38	2022-12-20 14:57:38
223	create document	web	2022-12-20 14:57:38	2022-12-20 14:57:38
224	edit document	web	2022-12-20 14:57:38	2022-12-20 14:57:38
225	delete document	web	2022-12-20 14:57:38	2022-12-20 14:57:38
226	manage payslip type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
227	create payslip type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
228	edit payslip type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
229	delete payslip type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
230	create reimbursement	web	2022-12-20 14:57:38	2022-12-20 14:57:38
231	edit reimbursement	web	2022-12-20 14:57:38	2022-12-20 14:57:38
232	delete reimbursement	web	2022-12-20 14:57:38	2022-12-20 14:57:38
233	create commission	web	2022-12-20 14:57:38	2022-12-20 14:57:38
234	edit commission	web	2022-12-20 14:57:38	2022-12-20 14:57:38
235	delete commission	web	2022-12-20 14:57:38	2022-12-20 14:57:38
236	manage reimbursement option	web	2022-12-20 14:57:38	2022-12-20 14:57:38
237	create reimbursement option	web	2022-12-20 14:57:38	2022-12-20 14:57:38
238	edit reimbursement option	web	2022-12-20 14:57:38	2022-12-20 14:57:38
239	delete reimbursement option	web	2022-12-20 14:57:38	2022-12-20 14:57:38
240	manage loan option	web	2022-12-20 14:57:38	2022-12-20 14:57:38
241	create loan option	web	2022-12-20 14:57:38	2022-12-20 14:57:38
242	edit loan option	web	2022-12-20 14:57:38	2022-12-20 14:57:38
243	delete loan option	web	2022-12-20 14:57:38	2022-12-20 14:57:38
244	manage deduction option	web	2022-12-20 14:57:38	2022-12-20 14:57:38
245	create deduction option	web	2022-12-20 14:57:38	2022-12-20 14:57:38
246	edit deduction option	web	2022-12-20 14:57:38	2022-12-20 14:57:38
247	delete deduction option	web	2022-12-20 14:57:38	2022-12-20 14:57:38
248	create loan	web	2022-12-20 14:57:38	2022-12-20 14:57:38
249	edit loan	web	2022-12-20 14:57:38	2022-12-20 14:57:38
250	delete loan	web	2022-12-20 14:57:38	2022-12-20 14:57:38
251	create saturation deduction	web	2022-12-20 14:57:38	2022-12-20 14:57:38
252	edit saturation deduction	web	2022-12-20 14:57:38	2022-12-20 14:57:38
253	delete saturation deduction	web	2022-12-20 14:57:38	2022-12-20 14:57:38
254	create other payment	web	2022-12-20 14:57:38	2022-12-20 14:57:38
255	edit other payment	web	2022-12-20 14:57:38	2022-12-20 14:57:38
256	delete other payment	web	2022-12-20 14:57:38	2022-12-20 14:57:38
257	manage overtime	web	2022-12-20 14:57:38	2022-12-20 14:57:38
258	create overtime	web	2022-12-20 14:57:38	2022-12-20 14:57:38
259	edit overtime	web	2022-12-20 14:57:38	2022-12-20 14:57:38
260	delete overtime	web	2022-12-20 14:57:38	2022-12-20 14:57:38
261	manage day type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
262	create day type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
263	edit day type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
264	delete day type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
265	manage overtime type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
266	create overtime type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
267	edit overtime type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
268	delete overtime type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
269	manage set salary	web	2022-12-20 14:57:38	2022-12-20 14:57:38
270	edit set salary	web	2022-12-20 14:57:38	2022-12-20 14:57:38
271	manage pay slip	web	2022-12-20 14:57:38	2022-12-20 14:57:38
272	create set salary	web	2022-12-20 14:57:38	2022-12-20 14:57:38
273	create pay slip	web	2022-12-20 14:57:38	2022-12-20 14:57:38
274	manage company policy	web	2022-12-20 14:57:38	2022-12-20 14:57:38
275	create company policy	web	2022-12-20 14:57:38	2022-12-20 14:57:38
276	edit company policy	web	2022-12-20 14:57:38	2022-12-20 14:57:38
277	manage performance review	web	2022-12-20 14:57:38	2022-12-20 14:57:38
278	create performance review	web	2022-12-20 14:57:38	2022-12-20 14:57:38
279	edit performance review	web	2022-12-20 14:57:38	2022-12-20 14:57:38
280	show performance review	web	2022-12-20 14:57:38	2022-12-20 14:57:38
281	delete performance review	web	2022-12-20 14:57:38	2022-12-20 14:57:38
282	manage goal tracking	web	2022-12-20 14:57:38	2022-12-20 14:57:38
283	create goal tracking	web	2022-12-20 14:57:38	2022-12-20 14:57:38
284	edit goal tracking	web	2022-12-20 14:57:38	2022-12-20 14:57:38
285	delete goal tracking	web	2022-12-20 14:57:38	2022-12-20 14:57:38
286	manage goal type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
287	create goal type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
288	edit goal type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
289	delete goal type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
290	manage indicator	web	2022-12-20 14:57:38	2022-12-20 14:57:38
291	create indicator	web	2022-12-20 14:57:38	2022-12-20 14:57:38
292	edit indicator	web	2022-12-20 14:57:38	2022-12-20 14:57:38
293	show indicator	web	2022-12-20 14:57:38	2022-12-20 14:57:38
294	delete indicator	web	2022-12-20 14:57:38	2022-12-20 14:57:38
295	manage training	web	2022-12-20 14:57:38	2022-12-20 14:57:38
296	create training	web	2022-12-20 14:57:38	2022-12-20 14:57:38
297	edit training	web	2022-12-20 14:57:38	2022-12-20 14:57:38
298	delete training	web	2022-12-20 14:57:38	2022-12-20 14:57:38
299	show training	web	2022-12-20 14:57:38	2022-12-20 14:57:38
300	manage trainer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
301	create trainer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
302	edit trainer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
303	delete trainer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
304	manage training type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
305	create training type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
306	edit training type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
307	delete training type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
308	manage award	web	2022-12-20 14:57:38	2022-12-20 14:57:38
309	create award	web	2022-12-20 14:57:38	2022-12-20 14:57:38
310	edit award	web	2022-12-20 14:57:38	2022-12-20 14:57:38
311	delete award	web	2022-12-20 14:57:38	2022-12-20 14:57:38
312	manage award type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
313	create award type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
314	edit award type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
315	delete award type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
316	manage resignation	web	2022-12-20 14:57:38	2022-12-20 14:57:38
317	create resignation	web	2022-12-20 14:57:38	2022-12-20 14:57:38
318	edit resignation	web	2022-12-20 14:57:38	2022-12-20 14:57:38
319	delete resignation	web	2022-12-20 14:57:38	2022-12-20 14:57:38
320	manage on duty	web	2022-12-20 14:57:38	2022-12-20 14:57:38
321	create on duty	web	2022-12-20 14:57:38	2022-12-20 14:57:38
322	edit on duty	web	2022-12-20 14:57:38	2022-12-20 14:57:38
323	delete on duty	web	2022-12-20 14:57:38	2022-12-20 14:57:38
324	manage promotion	web	2022-12-20 14:57:38	2022-12-20 14:57:38
325	create promotion	web	2022-12-20 14:57:38	2022-12-20 14:57:38
326	edit promotion	web	2022-12-20 14:57:38	2022-12-20 14:57:38
327	delete promotion	web	2022-12-20 14:57:38	2022-12-20 14:57:38
328	manage complaint	web	2022-12-20 14:57:38	2022-12-20 14:57:38
329	create complaint	web	2022-12-20 14:57:38	2022-12-20 14:57:38
330	edit complaint	web	2022-12-20 14:57:38	2022-12-20 14:57:38
331	delete complaint	web	2022-12-20 14:57:38	2022-12-20 14:57:38
332	manage warning	web	2022-12-20 14:57:38	2022-12-20 14:57:38
333	create warning	web	2022-12-20 14:57:38	2022-12-20 14:57:38
334	edit warning	web	2022-12-20 14:57:38	2022-12-20 14:57:38
335	delete warning	web	2022-12-20 14:57:38	2022-12-20 14:57:38
336	manage termination	web	2022-12-20 14:57:38	2022-12-20 14:57:38
337	create termination	web	2022-12-20 14:57:38	2022-12-20 14:57:38
338	edit termination	web	2022-12-20 14:57:38	2022-12-20 14:57:38
339	delete termination	web	2022-12-20 14:57:38	2022-12-20 14:57:38
340	manage termination type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
341	create termination type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
342	edit termination type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
343	delete termination type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
344	manage job application	web	2022-12-20 14:57:38	2022-12-20 14:57:38
345	create job application	web	2022-12-20 14:57:38	2022-12-20 14:57:38
346	show job application	web	2022-12-20 14:57:38	2022-12-20 14:57:38
347	delete job application	web	2022-12-20 14:57:38	2022-12-20 14:57:38
348	move job application	web	2022-12-20 14:57:38	2022-12-20 14:57:38
349	add job application skill	web	2022-12-20 14:57:38	2022-12-20 14:57:38
350	add job application note	web	2022-12-20 14:57:38	2022-12-20 14:57:38
351	delete job application note	web	2022-12-20 14:57:38	2022-12-20 14:57:38
352	manage job onBoard	web	2022-12-20 14:57:38	2022-12-20 14:57:38
353	manage job category	web	2022-12-20 14:57:38	2022-12-20 14:57:38
354	create job category	web	2022-12-20 14:57:38	2022-12-20 14:57:38
355	edit job category	web	2022-12-20 14:57:38	2022-12-20 14:57:38
356	delete job category	web	2022-12-20 14:57:38	2022-12-20 14:57:38
357	manage job	web	2022-12-20 14:57:38	2022-12-20 14:57:38
358	create job	web	2022-12-20 14:57:38	2022-12-20 14:57:38
359	edit job	web	2022-12-20 14:57:38	2022-12-20 14:57:38
360	show job	web	2022-12-20 14:57:38	2022-12-20 14:57:38
361	delete job	web	2022-12-20 14:57:38	2022-12-20 14:57:38
362	manage job stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
363	create job stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
364	edit job stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
365	delete job stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
366	Manage Competencies	web	2022-12-20 14:57:38	2022-12-20 14:57:38
367	Create Competencies	web	2022-12-20 14:57:38	2022-12-20 14:57:38
368	Edit Competencies	web	2022-12-20 14:57:38	2022-12-20 14:57:38
369	Delete Competencies	web	2022-12-20 14:57:38	2022-12-20 14:57:38
370	manage custom question	web	2022-12-20 14:57:38	2022-12-20 14:57:38
371	create custom question	web	2022-12-20 14:57:38	2022-12-20 14:57:38
372	edit custom question	web	2022-12-20 14:57:38	2022-12-20 14:57:38
373	delete custom question	web	2022-12-20 14:57:38	2022-12-20 14:57:38
374	create interview schedule	web	2022-12-20 14:57:38	2022-12-20 14:57:38
375	edit interview schedule	web	2022-12-20 14:57:38	2022-12-20 14:57:38
376	delete interview schedule	web	2022-12-20 14:57:38	2022-12-20 14:57:38
377	show interview schedule	web	2022-12-20 14:57:38	2022-12-20 14:57:38
378	create estimation	web	2022-12-20 14:57:38	2022-12-20 14:57:38
379	view estimation	web	2022-12-20 14:57:38	2022-12-20 14:57:38
380	edit estimation	web	2022-12-20 14:57:38	2022-12-20 14:57:38
381	delete estimation	web	2022-12-20 14:57:38	2022-12-20 14:57:38
382	edit holiday	web	2022-12-20 14:57:38	2022-12-20 14:57:38
383	create holiday	web	2022-12-20 14:57:38	2022-12-20 14:57:38
384	delete holiday	web	2022-12-20 14:57:38	2022-12-20 14:57:38
385	manage holiday	web	2022-12-20 14:57:38	2022-12-20 14:57:38
386	show career	web	2022-12-20 14:57:38	2022-12-20 14:57:38
387	manage meeting	web	2022-12-20 14:57:38	2022-12-20 14:57:38
388	create meeting	web	2022-12-20 14:57:38	2022-12-20 14:57:38
389	edit meeting	web	2022-12-20 14:57:38	2022-12-20 14:57:38
390	delete meeting	web	2022-12-20 14:57:38	2022-12-20 14:57:38
391	manage event	web	2022-12-20 14:57:38	2022-12-20 14:57:38
392	create event	web	2022-12-20 14:57:38	2022-12-20 14:57:38
393	edit event	web	2022-12-20 14:57:38	2022-12-20 14:57:38
394	delete event	web	2022-12-20 14:57:38	2022-12-20 14:57:38
395	manage transfer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
396	create transfer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
397	edit transfer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
398	delete transfer	web	2022-12-20 14:57:38	2022-12-20 14:57:38
399	manage announcement	web	2022-12-20 14:57:38	2022-12-20 14:57:38
400	create announcement	web	2022-12-20 14:57:38	2022-12-20 14:57:38
401	edit announcement	web	2022-12-20 14:57:38	2022-12-20 14:57:38
402	delete announcement	web	2022-12-20 14:57:38	2022-12-20 14:57:38
403	manage leave	web	2022-12-20 14:57:38	2022-12-20 14:57:38
404	create leave	web	2022-12-20 14:57:38	2022-12-20 14:57:38
405	edit leave	web	2022-12-20 14:57:38	2022-12-20 14:57:38
406	delete leave	web	2022-12-20 14:57:38	2022-12-20 14:57:38
407	manage leave type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
408	create leave type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
409	edit leave type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
410	delete leave type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
411	manage attendance	web	2022-12-20 14:57:38	2022-12-20 14:57:38
412	create attendance	web	2022-12-20 14:57:38	2022-12-20 14:57:38
413	edit attendance	web	2022-12-20 14:57:38	2022-12-20 14:57:38
414	delete attendance	web	2022-12-20 14:57:38	2022-12-20 14:57:38
415	manage report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
416	manage project	web	2022-12-20 14:57:38	2022-12-20 14:57:38
417	create project	web	2022-12-20 14:57:38	2022-12-20 14:57:38
418	view project	web	2022-12-20 14:57:38	2022-12-20 14:57:38
419	edit project	web	2022-12-20 14:57:38	2022-12-20 14:57:38
420	delete project	web	2022-12-20 14:57:38	2022-12-20 14:57:38
421	create milestone	web	2022-12-20 14:57:38	2022-12-20 14:57:38
422	edit milestone	web	2022-12-20 14:57:38	2022-12-20 14:57:38
423	delete milestone	web	2022-12-20 14:57:38	2022-12-20 14:57:38
424	view milestone	web	2022-12-20 14:57:38	2022-12-20 14:57:38
425	view grant chart	web	2022-12-20 14:57:38	2022-12-20 14:57:38
426	manage project stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
427	create project stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
428	edit project stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
429	delete project stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
430	view expense	web	2022-12-20 14:57:38	2022-12-20 14:57:38
431	manage project task	web	2022-12-20 14:57:38	2022-12-20 14:57:38
432	create project task	web	2022-12-20 14:57:38	2022-12-20 14:57:38
433	edit project task	web	2022-12-20 14:57:38	2022-12-20 14:57:38
434	view project task	web	2022-12-20 14:57:38	2022-12-20 14:57:38
435	delete project task	web	2022-12-20 14:57:38	2022-12-20 14:57:38
436	view activity	web	2022-12-20 14:57:38	2022-12-20 14:57:38
437	view CRM activity	web	2022-12-20 14:57:38	2022-12-20 14:57:38
438	manage project task stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
439	edit project task stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
440	create project task stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
441	delete project task stage	web	2022-12-20 14:57:38	2022-12-20 14:57:38
442	manage timesheet	web	2022-12-20 14:57:38	2022-12-20 14:57:38
443	create timesheet	web	2022-12-20 14:57:38	2022-12-20 14:57:38
444	edit timesheet	web	2022-12-20 14:57:38	2022-12-20 14:57:38
445	delete timesheet	web	2022-12-20 14:57:38	2022-12-20 14:57:38
446	manage bug report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
447	create bug report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
448	edit bug report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
449	delete bug report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
450	move bug report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
451	manage bug status	web	2022-12-20 14:57:38	2022-12-20 14:57:38
452	create bug status	web	2022-12-20 14:57:38	2022-12-20 14:57:38
453	edit bug status	web	2022-12-20 14:57:38	2022-12-20 14:57:38
454	delete bug status	web	2022-12-20 14:57:38	2022-12-20 14:57:38
455	manage client dashboard	web	2022-12-20 14:57:38	2022-12-20 14:57:38
456	manage super admin dashboard	web	2022-12-20 14:57:38	2022-12-20 14:57:38
457	manage system settings	web	2022-12-20 14:57:38	2022-12-20 14:57:38
458	manage plan	web	2022-12-20 14:57:38	2022-12-20 14:57:38
459	create plan	web	2022-12-20 14:57:38	2022-12-20 14:57:38
460	edit plan	web	2022-12-20 14:57:38	2022-12-20 14:57:38
461	manage coupon	web	2022-12-20 14:57:38	2022-12-20 14:57:38
462	create coupon	web	2022-12-20 14:57:38	2022-12-20 14:57:38
463	edit coupon	web	2022-12-20 14:57:38	2022-12-20 14:57:38
464	delete coupon	web	2022-12-20 14:57:38	2022-12-20 14:57:38
465	manage company plan	web	2022-12-20 14:57:38	2022-12-20 14:57:38
466	buy plan	web	2022-12-20 14:57:38	2022-12-20 14:57:38
467	manage form builder	web	2022-12-20 14:57:38	2022-12-20 14:57:38
468	create form builder	web	2022-12-20 14:57:38	2022-12-20 14:57:38
469	edit form builder	web	2022-12-20 14:57:38	2022-12-20 14:57:38
470	delete form builder	web	2022-12-20 14:57:38	2022-12-20 14:57:38
471	manage performance type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
472	create performance type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
473	edit performance type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
474	delete performance type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
475	manage form field	web	2022-12-20 14:57:38	2022-12-20 14:57:38
476	create form field	web	2022-12-20 14:57:38	2022-12-20 14:57:38
477	edit form field	web	2022-12-20 14:57:38	2022-12-20 14:57:38
478	delete form field	web	2022-12-20 14:57:38	2022-12-20 14:57:38
479	view form response	web	2022-12-20 14:57:38	2022-12-20 14:57:38
480	create budget plan	web	2022-12-20 14:57:38	2022-12-20 14:57:38
481	edit budget plan	web	2022-12-20 14:57:38	2022-12-20 14:57:38
482	manage budget plan	web	2022-12-20 14:57:38	2022-12-20 14:57:38
483	delete budget plan	web	2022-12-20 14:57:38	2022-12-20 14:57:38
484	view budget plan	web	2022-12-20 14:57:38	2022-12-20 14:57:38
485	manage warehouse	web	2022-12-20 14:57:38	2022-12-20 14:57:38
486	create warehouse	web	2022-12-20 14:57:38	2022-12-20 14:57:38
487	edit warehouse	web	2022-12-20 14:57:38	2022-12-20 14:57:38
488	show warehouse	web	2022-12-20 14:57:38	2022-12-20 14:57:38
489	delete warehouse	web	2022-12-20 14:57:38	2022-12-20 14:57:38
490	manage purchase	web	2022-12-20 14:57:38	2022-12-20 14:57:38
491	create purchase	web	2022-12-20 14:57:38	2022-12-20 14:57:38
492	edit purchase	web	2022-12-20 14:57:38	2022-12-20 14:57:38
493	show employee request	web	2022-12-20 14:57:38	2022-12-20 14:57:38
494	manage employee request	web	2022-12-20 14:57:38	2022-12-20 14:57:38
495	show purchase	web	2022-12-20 14:57:38	2022-12-20 14:57:38
496	delete purchase	web	2022-12-20 14:57:38	2022-12-20 14:57:38
497	send purchase	web	2022-12-20 14:57:38	2022-12-20 14:57:38
498	create payment purchase	web	2022-12-20 14:57:38	2022-12-20 14:57:38
499	manage pos	web	2022-12-20 14:57:38	2022-12-20 14:57:38
500	manage contract type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
501	create contract type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
502	edit contract type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
503	delete contract type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
504	manage shift type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
505	create shift type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
506	edit shift type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
507	delete shift type	web	2022-12-20 14:57:38	2022-12-20 14:57:38
508	manage request shift schedule	web	2022-12-20 14:57:38	2022-12-20 14:57:38
509	show shift schedule	web	2022-12-20 14:57:38	2022-12-20 14:57:38
510	create shift schedule	web	2022-12-20 14:57:38	2022-12-20 14:57:38
511	edit shift schedule	web	2022-12-20 14:57:38	2022-12-20 14:57:38
512	delete shift schedule	web	2022-12-20 14:57:38	2022-12-20 14:57:38
513	create request shift schedule	web	2022-12-20 14:57:38	2022-12-20 14:57:38
514	edit request shift schedule	web	2022-12-20 14:57:38	2022-12-20 14:57:38
515	delete request shift schedule	web	2022-12-20 14:57:38	2022-12-20 14:57:38
516	manage contract	web	2022-12-20 14:57:38	2022-12-20 14:57:38
517	create contract	web	2022-12-20 14:57:38	2022-12-20 14:57:38
518	edit contract	web	2022-12-20 14:57:38	2022-12-20 14:57:38
519	delete contract	web	2022-12-20 14:57:38	2022-12-20 14:57:38
520	show contract	web	2022-12-20 14:57:38	2022-12-20 14:57:38
521	show time management report	web	2022-12-20 14:57:38	2022-12-20 14:57:38
522	manage payroll	web	2022-12-20 14:57:38	2022-12-20 14:57:38
523	create payroll	web	2022-12-20 14:57:38	2022-12-20 14:57:38
524	edit payroll	web	2022-12-20 14:57:38	2022-12-20 14:57:38
525	delete payroll	web	2022-12-20 14:57:38	2022-12-20 14:57:38
526	show payroll	web	2022-12-20 14:57:38	2022-12-20 14:57:38
527	manage reimburst	web	2022-12-20 14:57:38	2022-12-20 14:57:38
528	create reimburst	web	2022-12-20 14:57:38	2022-12-20 14:57:38
529	edit reimburst	web	2022-12-20 14:57:38	2022-12-20 14:57:38
530	delete reimburst	web	2022-12-20 14:57:38	2022-12-20 14:57:38
531	show reimburst	web	2022-12-20 14:57:38	2022-12-20 14:57:38
532	manage cash	web	2022-12-20 14:57:38	2022-12-20 14:57:38
533	create cash	web	2022-12-20 14:57:38	2022-12-20 14:57:38
534	edit cash	web	2022-12-20 14:57:38	2022-12-20 14:57:38
535	delete cash	web	2022-12-20 14:57:38	2022-12-20 14:57:38
536	show cash	web	2022-12-20 14:57:38	2022-12-20 14:57:38
537	manage allowance	web	2022-12-20 14:57:38	2022-12-20 14:57:38
538	create allowance	web	2022-12-20 14:57:38	2022-12-20 14:57:38
539	edit allowance	web	2022-12-20 14:57:38	2022-12-20 14:57:38
540	delete allowance	web	2022-12-20 14:57:38	2022-12-20 14:57:38
541	show allowance	web	2022-12-20 14:57:38	2022-12-20 14:57:38
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
1	super admin	web	2022-12-20 14:57:38	2022-12-20 14:57:38	0
2	company	web	2022-12-20 14:57:38	2022-12-20 14:57:38	0
3	accountant	web	2022-12-20 14:57:41	2022-12-20 14:57:41	2
\.


--
-- Data for Name: model_has_roles; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY model_has_roles (role_id, model_type, model_id) FROM stdin;
1	App\\Models\\User	1
2	App\\Models\\User	2
3	App\\Models\\User	3
\.


--
-- Data for Name: overtime_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY overtime_types (id, name, created_by, created_at, updated_at) FROM stdin;
1	overtime1	2	2022-12-20 14:57:42	2022-12-20 14:57:42
\.


--
-- Name: overtime_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('overtime_types_id_seq', 1, true);


--
-- Data for Name: overtimes; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY overtimes (id, employee_id, overtime_type_id, day_type_id, start_date, end_date, start_time, end_time, duration, notes, status, rejected_reason, attachment_reject, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: overtimes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('overtimes_id_seq', 1, false);


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: payrolls; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY payrolls (id, employee_id, payslip_type_id, amount, created_by, created_at, updated_at) FROM stdin;
2	1	3	123	2	2022-12-21 10:21:17	2022-12-21 10:21:17
3	1	3	123	2	2022-12-21 10:21:28	2022-12-21 10:21:28
4	1	3	120000	2	2022-12-21 10:22:37	2022-12-21 10:22:37
5	1	4	350000	2	2022-12-21 10:36:30	2022-12-21 10:36:30
\.


--
-- Name: payrolls_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('payrolls_id_seq', 5, true);


--
-- Data for Name: payslip_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY payslip_types (id, name, created_by, created_at, updated_at) FROM stdin;
3	my test slip	2	2022-12-20 18:00:49	2022-12-20 18:00:49
4	Gaji Pokok	2	2022-12-20 18:16:11	2022-12-20 18:16:11
\.


--
-- Name: payslip_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('payslip_types_id_seq', 4, true);


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

SELECT pg_catalog.setval('permissions_id_seq', 541, true);


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
-- Data for Name: reimbursts; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY reimbursts (id, employee_id, reimburst_type_id, amount, created_by, created_at, updated_at) FROM stdin;
1	1	1	120000	2	2022-12-21 10:22:52	2022-12-21 10:22:52
2	1	2	20000	2	2022-12-21 10:36:44	2022-12-21 10:36:44
\.


--
-- Name: reimbursts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('reimbursts_id_seq', 2, true);


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
456	1
5	1
6	1
7	1
8	1
9	1
457	1
21	1
14	1
15	1
16	1
17	1
458	1
459	1
460	1
88	1
461	1
462	1
463	1
464	1
1	2
493	2
494	2
521	2
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
265	2
266	2
267	2
268	2
261	2
262	2
263	2
264	2
269	2
270	2
271	2
272	2
273	2
274	2
275	2
276	2
225	2
277	2
278	2
279	2
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
391	2
392	2
393	2
394	2
387	2
388	2
389	2
390	2
295	2
296	2
297	2
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
395	2
396	2
397	2
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
440	2
439	2
441	2
442	2
443	2
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
19	2
465	2
466	2
2	2
458	2
467	2
468	2
469	2
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
482	2
480	2
481	2
483	2
484	2
485	2
486	2
487	2
488	2
489	2
490	2
491	2
492	2
495	2
496	2
497	2
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
509	2
510	2
511	2
512	2
508	2
513	2
514	2
515	2
516	2
517	2
518	2
519	2
520	2
522	2
523	2
524	2
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
539	2
540	2
541	2
\.


--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('roles_id_seq', 3, true);


--
-- Data for Name: settings; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY settings (id, name, value, created_by, created_at, updated_at) FROM stdin;
1	employee_prefix	#PDR	2	2022-12-20 14:57:41	2022-12-20 14:57:41
2	site_time_format	PDR	2	2022-12-20 14:57:41	2022-12-20 14:57:41
3	storage_setting	local	1	2022-12-20 14:57:41	2022-12-20 14:57:41
\.


--
-- Name: settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('settings_id_seq', 3, true);


--
-- Data for Name: shift_schedules; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY shift_schedules (id, employee_id, req_shift_schedules_id, schedule_date, shift_id, status, created_by, created_at, updated_at) FROM stdin;
1	1	\N	2022-12-20	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
2	1	\N	2022-12-21	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
3	1	\N	2022-12-22	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
4	1	\N	2022-12-23	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
5	1	\N	2022-12-24	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
6	1	\N	2022-12-25	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
7	1	\N	2022-12-26	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
8	1	\N	2022-12-27	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
9	1	\N	2022-12-28	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
10	1	\N	2022-12-29	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
11	1	\N	2022-12-30	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
12	1	\N	2022-12-31	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
13	1	\N	2023-01-01	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
14	1	\N	2023-01-02	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
15	1	\N	2023-01-03	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
16	1	\N	2023-01-04	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
17	1	\N	2023-01-05	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
18	1	\N	2023-01-06	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
19	1	\N	2023-01-07	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
20	1	\N	2023-01-08	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
21	1	\N	2023-01-09	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
22	1	\N	2023-01-10	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
23	1	\N	2023-01-11	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
24	1	\N	2023-01-12	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
25	1	\N	2023-01-13	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
26	1	\N	2023-01-14	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
27	1	\N	2023-01-15	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
28	1	\N	2023-01-16	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
29	1	\N	2023-01-17	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
30	1	\N	2023-01-18	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
31	1	\N	2023-01-19	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
32	1	\N	2023-01-20	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
33	1	\N	2023-01-21	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
34	1	\N	2023-01-22	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
35	1	\N	2023-01-23	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
36	1	\N	2023-01-24	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
37	1	\N	2023-01-25	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
38	1	\N	2023-01-26	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
39	1	\N	2023-01-27	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
40	1	\N	2023-01-28	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
41	1	\N	2023-01-29	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
42	1	\N	2023-01-30	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
43	1	\N	2023-01-31	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
44	1	\N	2023-02-01	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
45	1	\N	2023-02-02	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
46	1	\N	2023-02-03	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
47	1	\N	2023-02-04	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
48	1	\N	2023-02-05	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
49	1	\N	2023-02-06	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
50	1	\N	2023-02-07	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
51	1	\N	2023-02-08	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
52	1	\N	2023-02-09	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
53	1	\N	2023-02-10	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
54	1	\N	2023-02-11	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
55	1	\N	2023-02-12	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
56	1	\N	2023-02-13	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
57	1	\N	2023-02-14	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
58	1	\N	2023-02-15	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
59	1	\N	2023-02-16	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
60	1	\N	2023-02-17	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
61	1	\N	2023-02-18	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
62	1	\N	2023-02-19	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
63	1	\N	2023-02-20	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
64	1	\N	2023-02-21	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
65	1	\N	2023-02-22	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
66	1	\N	2023-02-23	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
67	1	\N	2023-02-24	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
68	1	\N	2023-02-25	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
69	1	\N	2023-02-26	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
70	1	\N	2023-02-27	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
71	1	\N	2023-02-28	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
72	1	\N	2023-03-01	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
73	1	\N	2023-03-02	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
74	1	\N	2023-03-03	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
75	1	\N	2023-03-04	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
76	1	\N	2023-03-05	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
77	1	\N	2023-03-06	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
78	1	\N	2023-03-07	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
79	1	\N	2023-03-08	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
80	1	\N	2023-03-09	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
81	1	\N	2023-03-10	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
82	1	\N	2023-03-11	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
83	1	\N	2023-03-12	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
84	1	\N	2023-03-13	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
85	1	\N	2023-03-14	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
86	1	\N	2023-03-15	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
87	1	\N	2023-03-16	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
88	1	\N	2023-03-17	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
89	1	\N	2023-03-18	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
90	1	\N	2023-03-19	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
91	1	\N	2023-03-20	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
92	1	\N	2023-03-21	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
93	1	\N	2023-03-22	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
94	1	\N	2023-03-23	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
95	1	\N	2023-03-24	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
96	1	\N	2023-03-25	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
97	1	\N	2023-03-26	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
98	1	\N	2023-03-27	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
99	1	\N	2023-03-28	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
100	1	\N	2023-03-29	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
101	1	\N	2023-03-30	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
102	1	\N	2023-03-31	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
103	1	\N	2023-04-01	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
104	1	\N	2023-04-02	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
105	1	\N	2023-04-03	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
106	1	\N	2023-04-04	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
107	1	\N	2023-04-05	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
108	1	\N	2023-04-06	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
109	1	\N	2023-04-07	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
110	1	\N	2023-04-08	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
111	1	\N	2023-04-09	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
112	1	\N	2023-04-10	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
113	1	\N	2023-04-11	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
114	1	\N	2023-04-12	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
115	1	\N	2023-04-13	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
116	1	\N	2023-04-14	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
117	1	\N	2023-04-15	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
118	1	\N	2023-04-16	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
119	1	\N	2023-04-17	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
120	1	\N	2023-04-18	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
121	1	\N	2023-04-19	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
122	1	\N	2023-04-20	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
123	1	\N	2023-04-21	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
124	1	\N	2023-04-22	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
125	1	\N	2023-04-23	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
126	1	\N	2023-04-24	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
127	1	\N	2023-04-25	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
128	1	\N	2023-04-26	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
129	1	\N	2023-04-27	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
130	1	\N	2023-04-28	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
131	1	\N	2023-04-29	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
132	1	\N	2023-04-30	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
133	1	\N	2023-05-01	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
134	1	\N	2023-05-02	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
135	1	\N	2023-05-03	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
136	1	\N	2023-05-04	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
137	1	\N	2023-05-05	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
138	1	\N	2023-05-06	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
139	1	\N	2023-05-07	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
140	1	\N	2023-05-08	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
141	1	\N	2023-05-09	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
142	1	\N	2023-05-10	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
143	1	\N	2023-05-11	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
144	1	\N	2023-05-12	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
145	1	\N	2023-05-13	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
146	1	\N	2023-05-14	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
147	1	\N	2023-05-15	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
148	1	\N	2023-05-16	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
149	1	\N	2023-05-17	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
150	1	\N	2023-05-18	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
151	1	\N	2023-05-19	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
152	1	\N	2023-05-20	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
153	1	\N	2023-05-21	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
154	1	\N	2023-05-22	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
155	1	\N	2023-05-23	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
156	1	\N	2023-05-24	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
157	1	\N	2023-05-25	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
158	1	\N	2023-05-26	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
159	1	\N	2023-05-27	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
160	1	\N	2023-05-28	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
161	1	\N	2023-05-29	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
162	1	\N	2023-05-30	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
163	1	\N	2023-05-31	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
164	1	\N	2023-06-01	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
165	1	\N	2023-06-02	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
166	1	\N	2023-06-03	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
167	1	\N	2023-06-04	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
168	1	\N	2023-06-05	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
169	1	\N	2023-06-06	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
170	1	\N	2023-06-07	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
171	1	\N	2023-06-08	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
172	1	\N	2023-06-09	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
173	1	\N	2023-06-10	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
174	1	\N	2023-06-11	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
175	1	\N	2023-06-12	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
176	1	\N	2023-06-13	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
177	1	\N	2023-06-14	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
178	1	\N	2023-06-15	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
179	1	\N	2023-06-16	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
180	1	\N	2023-06-17	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
181	1	\N	2023-06-18	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
182	1	\N	2023-06-19	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
183	1	\N	2023-06-20	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
184	1	\N	2023-06-21	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
185	1	\N	2023-06-22	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
186	1	\N	2023-06-23	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
187	1	\N	2023-06-24	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
188	1	\N	2023-06-25	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
189	1	\N	2023-06-26	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
190	1	\N	2023-06-27	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
191	1	\N	2023-06-28	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
192	1	\N	2023-06-29	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
193	1	\N	2023-06-30	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
194	1	\N	2023-07-01	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
195	1	\N	2023-07-02	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
196	1	\N	2023-07-03	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
197	1	\N	2023-07-04	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
198	1	\N	2023-07-05	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
199	1	\N	2023-07-06	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
200	1	\N	2023-07-07	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
201	1	\N	2023-07-08	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
202	1	\N	2023-07-09	1	Approved	2	2022-12-20 14:57:41	2022-12-20 14:57:41
203	1	\N	2023-07-10	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
204	1	\N	2023-07-11	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
205	1	\N	2023-07-12	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
206	1	\N	2023-07-13	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
207	1	\N	2023-07-14	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
208	1	\N	2023-07-15	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
209	1	\N	2023-07-16	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
210	1	\N	2023-07-17	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
211	1	\N	2023-07-18	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
212	1	\N	2023-07-19	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
213	1	\N	2023-07-20	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
214	1	\N	2023-07-21	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
215	1	\N	2023-07-22	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
216	1	\N	2023-07-23	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
217	1	\N	2023-07-24	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
218	1	\N	2023-07-25	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
219	1	\N	2023-07-26	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
220	1	\N	2023-07-27	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
221	1	\N	2023-07-28	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
222	1	\N	2023-07-29	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
223	1	\N	2023-07-30	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
224	1	\N	2023-07-31	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
225	1	\N	2023-08-01	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
226	1	\N	2023-08-02	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
227	1	\N	2023-08-03	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
228	1	\N	2023-08-04	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
229	1	\N	2023-08-05	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
230	1	\N	2023-08-06	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
231	1	\N	2023-08-07	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
232	1	\N	2023-08-08	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
233	1	\N	2023-08-09	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
234	1	\N	2023-08-10	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
235	1	\N	2023-08-11	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
236	1	\N	2023-08-12	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
237	1	\N	2023-08-13	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
238	1	\N	2023-08-14	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
239	1	\N	2023-08-15	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
240	1	\N	2023-08-16	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
241	1	\N	2023-08-17	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
242	1	\N	2023-08-18	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
243	1	\N	2023-08-19	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
244	1	\N	2023-08-20	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
245	1	\N	2023-08-21	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
246	1	\N	2023-08-22	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
247	1	\N	2023-08-23	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
248	1	\N	2023-08-24	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
249	1	\N	2023-08-25	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
250	1	\N	2023-08-26	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
251	1	\N	2023-08-27	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
252	1	\N	2023-08-28	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
253	1	\N	2023-08-29	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
254	1	\N	2023-08-30	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
255	1	\N	2023-08-31	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
256	1	\N	2023-09-01	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
257	1	\N	2023-09-02	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
258	1	\N	2023-09-03	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
259	1	\N	2023-09-04	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
260	1	\N	2023-09-05	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
261	1	\N	2023-09-06	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
262	1	\N	2023-09-07	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
263	1	\N	2023-09-08	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
264	1	\N	2023-09-09	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
265	1	\N	2023-09-10	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
266	1	\N	2023-09-11	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
267	1	\N	2023-09-12	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
268	1	\N	2023-09-13	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
269	1	\N	2023-09-14	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
270	1	\N	2023-09-15	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
271	1	\N	2023-09-16	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
272	1	\N	2023-09-17	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
273	1	\N	2023-09-18	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
274	1	\N	2023-09-19	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
275	1	\N	2023-09-20	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
276	1	\N	2023-09-21	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
277	1	\N	2023-09-22	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
278	1	\N	2023-09-23	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
279	1	\N	2023-09-24	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
280	1	\N	2023-09-25	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
281	1	\N	2023-09-26	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
282	1	\N	2023-09-27	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
283	1	\N	2023-09-28	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
284	1	\N	2023-09-29	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
285	1	\N	2023-09-30	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
286	1	\N	2023-10-01	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
287	1	\N	2023-10-02	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
288	1	\N	2023-10-03	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
289	1	\N	2023-10-04	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
290	1	\N	2023-10-05	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
291	1	\N	2023-10-06	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
292	1	\N	2023-10-07	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
293	1	\N	2023-10-08	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
294	1	\N	2023-10-09	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
295	1	\N	2023-10-10	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
296	1	\N	2023-10-11	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
297	1	\N	2023-10-12	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
298	1	\N	2023-10-13	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
299	1	\N	2023-10-14	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
300	1	\N	2023-10-15	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
301	1	\N	2023-10-16	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
302	1	\N	2023-10-17	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
303	1	\N	2023-10-18	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
304	1	\N	2023-10-19	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
305	1	\N	2023-10-20	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
306	1	\N	2023-10-21	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
307	1	\N	2023-10-22	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
308	1	\N	2023-10-23	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
309	1	\N	2023-10-24	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
310	1	\N	2023-10-25	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
311	1	\N	2023-10-26	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
312	1	\N	2023-10-27	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
313	1	\N	2023-10-28	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
314	1	\N	2023-10-29	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
315	1	\N	2023-10-30	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
316	1	\N	2023-10-31	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
317	1	\N	2023-11-01	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
318	1	\N	2023-11-02	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
319	1	\N	2023-11-03	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
320	1	\N	2023-11-04	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
321	1	\N	2023-11-05	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
322	1	\N	2023-11-06	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
323	1	\N	2023-11-07	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
324	1	\N	2023-11-08	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
325	1	\N	2023-11-09	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
326	1	\N	2023-11-10	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
327	1	\N	2023-11-11	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
328	1	\N	2023-11-12	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
329	1	\N	2023-11-13	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
330	1	\N	2023-11-14	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
331	1	\N	2023-11-15	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
332	1	\N	2023-11-16	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
333	1	\N	2023-11-17	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
334	1	\N	2023-11-18	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
335	1	\N	2023-11-19	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
336	1	\N	2023-11-20	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
337	1	\N	2023-11-21	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
338	1	\N	2023-11-22	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
339	1	\N	2023-11-23	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
340	1	\N	2023-11-24	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
341	1	\N	2023-11-25	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
342	1	\N	2023-11-26	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
343	1	\N	2023-11-27	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
344	1	\N	2023-11-28	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
345	1	\N	2023-11-29	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
346	1	\N	2023-11-30	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
347	1	\N	2023-12-01	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
348	1	\N	2023-12-02	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
349	1	\N	2023-12-03	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
350	1	\N	2023-12-04	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
351	1	\N	2023-12-05	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
352	1	\N	2023-12-06	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
353	1	\N	2023-12-07	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
354	1	\N	2023-12-08	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
355	1	\N	2023-12-09	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
356	1	\N	2023-12-10	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
357	1	\N	2023-12-11	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
358	1	\N	2023-12-12	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
359	1	\N	2023-12-13	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
360	1	\N	2023-12-14	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
361	1	\N	2023-12-15	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
362	1	\N	2023-12-16	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
363	1	\N	2023-12-17	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
364	1	\N	2023-12-18	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
365	1	\N	2023-12-19	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
366	1	\N	2023-12-20	1	Approved	2	2022-12-20 14:57:42	2022-12-20 14:57:42
\.


--
-- Name: shift_schedules_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('shift_schedules_id_seq', 366, true);


--
-- Data for Name: shift_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY shift_types (id, day_type_id, name, start_time, end_time, is_wfh, created_by, created_at, updated_at) FROM stdin;
1	1	Reguler	07:00:00	15:00:00	f	2	2022-12-20 14:57:42	2022-12-20 14:57:42
2	1	WFH	08:00:00	16:00:00	f	2	2022-12-20 14:57:42	2022-12-20 14:57:42
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
1	\N	Super Admin	superadmin@example.com	\N	$2y$10$VsIzPF6XZifYgb/iRYr.ROMYNWjhkJuE99BQfnBd6xHTGldlWiGi6	\N	\N	super admin		en	0	\N	1	1	\N	\N	2022-12-20 14:57:38	2022-12-20 14:57:38
3	\N	accountant	accountant@pehadir.com	\N	$2y$10$Z0SVSDVpKSqP8iH5bcqQsu3m.3gshHyANFeHq67ZexC8paJ7xoXa6	\N	\N	accountant		en	2	1	1	1	\N	\N	2022-12-20 14:57:41	2022-12-20 14:57:41
2	\N	company	company@pehadir.com	\N	$2y$10$eET77PolzMNZBDHoPpfYeuVB6StfptQSgNKdVyh8VfNkBpf0vMcUa	1	\N	company		en	1	1	1	1	2022-12-25 11:43:07	\N	2022-12-20 14:57:41	2022-12-25 11:43:07
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('users_id_seq', 3, true);


--
-- PostgreSQL database dump complete
--

