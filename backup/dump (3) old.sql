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
\.


--
-- Name: all_requests_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('all_requests_id_seq', 1, false);


--
-- Data for Name: allowance_finances; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY allowance_finances (id, employee_id, allowance_type_id, amount, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: allowance_finances_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('allowance_finances_id_seq', 1, false);


--
-- Data for Name: allowance_options; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY allowance_options (id, name, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: allowance_options_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('allowance_options_id_seq', 1, false);


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
\.


--
-- Name: cashes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('cashes_id_seq', 1, false);


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
1	work	2	2023-01-16 10:43:49	2023-01-16 10:43:49
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

SELECT pg_catalog.setval('dayoffs_id_seq', 1, true);


--
-- Data for Name: dendas; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY dendas (id, day_type_id, "time", amount, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: dendas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('dendas_id_seq', 1, false);


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
1	1	2022-01-01	2022-03-01	1	Programmer	Programmer	Peterongan	Jombang	Boring	\N	2023-01-16 10:43:49	2023-01-16 10:43:49
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
1	3	accountant	2001-05-01	Male	08119725162	Jl. semampir no.2, Malaysia	accountant@example.com	$2y$10$g2r0TdKZV1i.OoUqdqQeXebqX2Stz9T.l8LB2jb3pPzvhPwd9qBoS	1	1	0	0	2022-12-01	2023-12-01	\N	\N	\N	\N	\N	\N	\N	Gaji Pokok	2000000	-4000000	1	2	2023-01-16 10:43:49	2023-01-16 11:07:30
\.


--
-- Name: employees_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employees_id_seq', 1, true);


--
-- Data for Name: employements; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY employements (id, employee_id, movement_type, area, office, job_level, "position", type, note, created_at, updated_at) FROM stdin;
1	1	Hiring	Tangerang	Tangerang	Accountant	Accountant	KONTRAK	\N	2023-01-16 10:43:49	2023-01-16 10:43:49
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
1	Sick	3	2	2023-01-16 10:43:49	2023-01-16 10:43:49
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
\.


--
-- Name: loan_options_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('loan_options_id_seq', 1, false);


--
-- Data for Name: loans; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY loans (id, employee_id, loan_type_id, amount, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: loans_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('loans_id_seq', 1, false);


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
1	show hrm dashboard	web	2023-01-16 10:43:49	2023-01-16 10:43:49
2	copy invoice	web	2023-01-16 10:43:49	2023-01-16 10:43:49
3	show project dashboard	web	2023-01-16 10:43:49	2023-01-16 10:43:49
4	show account dashboard	web	2023-01-16 10:43:49	2023-01-16 10:43:49
5	manage user	web	2023-01-16 10:43:49	2023-01-16 10:43:49
6	create user	web	2023-01-16 10:43:49	2023-01-16 10:43:49
7	edit user	web	2023-01-16 10:43:49	2023-01-16 10:43:49
8	delete user	web	2023-01-16 10:43:49	2023-01-16 10:43:49
9	create language	web	2023-01-16 10:43:49	2023-01-16 10:43:49
10	manage role	web	2023-01-16 10:43:49	2023-01-16 10:43:49
11	create role	web	2023-01-16 10:43:49	2023-01-16 10:43:49
12	edit role	web	2023-01-16 10:43:49	2023-01-16 10:43:49
13	delete role	web	2023-01-16 10:43:49	2023-01-16 10:43:49
14	manage permission	web	2023-01-16 10:43:49	2023-01-16 10:43:49
15	create permission	web	2023-01-16 10:43:49	2023-01-16 10:43:49
16	edit permission	web	2023-01-16 10:43:49	2023-01-16 10:43:49
17	delete permission	web	2023-01-16 10:43:49	2023-01-16 10:43:49
18	manage company settings	web	2023-01-16 10:43:49	2023-01-16 10:43:49
19	manage print settings	web	2023-01-16 10:43:49	2023-01-16 10:43:49
20	manage business settings	web	2023-01-16 10:43:49	2023-01-16 10:43:49
21	manage stripe settings	web	2023-01-16 10:43:49	2023-01-16 10:43:49
22	manage expense	web	2023-01-16 10:43:49	2023-01-16 10:43:49
23	create expense	web	2023-01-16 10:43:49	2023-01-16 10:43:49
24	edit expense	web	2023-01-16 10:43:49	2023-01-16 10:43:49
25	delete expense	web	2023-01-16 10:43:49	2023-01-16 10:43:49
26	manage invoice	web	2023-01-16 10:43:49	2023-01-16 10:43:49
27	create invoice	web	2023-01-16 10:43:49	2023-01-16 10:43:49
28	edit invoice	web	2023-01-16 10:43:49	2023-01-16 10:43:49
29	delete invoice	web	2023-01-16 10:43:49	2023-01-16 10:43:49
30	show invoice	web	2023-01-16 10:43:49	2023-01-16 10:43:49
31	create payment invoice	web	2023-01-16 10:43:49	2023-01-16 10:43:49
32	delete payment invoice	web	2023-01-16 10:43:49	2023-01-16 10:43:49
33	send invoice	web	2023-01-16 10:43:49	2023-01-16 10:43:49
34	delete invoice product	web	2023-01-16 10:43:49	2023-01-16 10:43:49
35	convert invoice	web	2023-01-16 10:43:49	2023-01-16 10:43:49
36	manage constant unit	web	2023-01-16 10:43:49	2023-01-16 10:43:49
37	create constant unit	web	2023-01-16 10:43:49	2023-01-16 10:43:49
38	edit constant unit	web	2023-01-16 10:43:49	2023-01-16 10:43:49
39	delete constant unit	web	2023-01-16 10:43:49	2023-01-16 10:43:49
40	manage constant tax	web	2023-01-16 10:43:49	2023-01-16 10:43:49
41	create constant tax	web	2023-01-16 10:43:49	2023-01-16 10:43:49
42	edit constant tax	web	2023-01-16 10:43:49	2023-01-16 10:43:49
43	delete constant tax	web	2023-01-16 10:43:49	2023-01-16 10:43:49
44	manage constant category	web	2023-01-16 10:43:49	2023-01-16 10:43:49
45	create constant category	web	2023-01-16 10:43:49	2023-01-16 10:43:49
46	edit constant category	web	2023-01-16 10:43:49	2023-01-16 10:43:49
47	delete constant category	web	2023-01-16 10:43:49	2023-01-16 10:43:49
48	manage product & service	web	2023-01-16 10:43:49	2023-01-16 10:43:49
49	create product & service	web	2023-01-16 10:43:49	2023-01-16 10:43:49
50	edit product & service	web	2023-01-16 10:43:49	2023-01-16 10:43:49
51	delete product & service	web	2023-01-16 10:43:49	2023-01-16 10:43:49
52	manage customer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
53	create customer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
54	edit customer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
55	delete customer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
56	show customer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
57	manage vender	web	2023-01-16 10:43:49	2023-01-16 10:43:49
58	create vender	web	2023-01-16 10:43:49	2023-01-16 10:43:49
59	edit vender	web	2023-01-16 10:43:49	2023-01-16 10:43:49
60	delete vender	web	2023-01-16 10:43:49	2023-01-16 10:43:49
61	show vender	web	2023-01-16 10:43:49	2023-01-16 10:43:49
62	manage bank account	web	2023-01-16 10:43:49	2023-01-16 10:43:49
63	create bank account	web	2023-01-16 10:43:49	2023-01-16 10:43:49
64	edit bank account	web	2023-01-16 10:43:49	2023-01-16 10:43:49
65	delete bank account	web	2023-01-16 10:43:49	2023-01-16 10:43:49
66	manage bank transfer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
67	create bank transfer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
68	edit bank transfer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
69	delete bank transfer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
70	manage transaction	web	2023-01-16 10:43:49	2023-01-16 10:43:49
71	manage revenue	web	2023-01-16 10:43:49	2023-01-16 10:43:49
72	create revenue	web	2023-01-16 10:43:49	2023-01-16 10:43:49
73	edit revenue	web	2023-01-16 10:43:49	2023-01-16 10:43:49
74	delete revenue	web	2023-01-16 10:43:49	2023-01-16 10:43:49
75	manage bill	web	2023-01-16 10:43:49	2023-01-16 10:43:49
76	create bill	web	2023-01-16 10:43:49	2023-01-16 10:43:49
77	edit bill	web	2023-01-16 10:43:49	2023-01-16 10:43:49
78	delete bill	web	2023-01-16 10:43:49	2023-01-16 10:43:49
79	show bill	web	2023-01-16 10:43:49	2023-01-16 10:43:49
80	manage payment	web	2023-01-16 10:43:49	2023-01-16 10:43:49
81	create payment	web	2023-01-16 10:43:49	2023-01-16 10:43:49
82	edit payment	web	2023-01-16 10:43:49	2023-01-16 10:43:49
83	delete payment	web	2023-01-16 10:43:49	2023-01-16 10:43:49
84	delete bill product	web	2023-01-16 10:43:49	2023-01-16 10:43:49
85	send bill	web	2023-01-16 10:43:49	2023-01-16 10:43:49
86	create payment bill	web	2023-01-16 10:43:49	2023-01-16 10:43:49
87	delete payment bill	web	2023-01-16 10:43:49	2023-01-16 10:43:49
88	manage order	web	2023-01-16 10:43:49	2023-01-16 10:43:49
89	income report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
90	expense report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
91	income vs expense report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
92	invoice report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
93	bill report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
94	stock report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
95	tax report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
96	loss & profit report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
97	manage customer payment	web	2023-01-16 10:43:49	2023-01-16 10:43:49
98	manage customer transaction	web	2023-01-16 10:43:49	2023-01-16 10:43:49
99	manage customer invoice	web	2023-01-16 10:43:49	2023-01-16 10:43:49
100	vender manage bill	web	2023-01-16 10:43:49	2023-01-16 10:43:49
101	manage vender bill	web	2023-01-16 10:43:49	2023-01-16 10:43:49
102	manage vender payment	web	2023-01-16 10:43:49	2023-01-16 10:43:49
103	manage vender transaction	web	2023-01-16 10:43:49	2023-01-16 10:43:49
104	manage credit note	web	2023-01-16 10:43:49	2023-01-16 10:43:49
105	create credit note	web	2023-01-16 10:43:49	2023-01-16 10:43:49
106	edit credit note	web	2023-01-16 10:43:49	2023-01-16 10:43:49
107	delete credit note	web	2023-01-16 10:43:49	2023-01-16 10:43:49
108	manage debit note	web	2023-01-16 10:43:49	2023-01-16 10:43:49
109	create debit note	web	2023-01-16 10:43:49	2023-01-16 10:43:49
110	edit debit note	web	2023-01-16 10:43:49	2023-01-16 10:43:49
111	delete debit note	web	2023-01-16 10:43:49	2023-01-16 10:43:49
112	duplicate invoice	web	2023-01-16 10:43:49	2023-01-16 10:43:49
113	duplicate bill	web	2023-01-16 10:43:49	2023-01-16 10:43:49
114	manage proposal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
115	create proposal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
116	edit proposal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
117	delete proposal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
118	duplicate proposal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
119	show proposal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
120	send proposal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
121	delete proposal product	web	2023-01-16 10:43:49	2023-01-16 10:43:49
122	manage customer proposal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
123	manage goal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
124	create goal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
125	edit goal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
126	delete goal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
127	manage assets	web	2023-01-16 10:43:49	2023-01-16 10:43:49
128	create assets	web	2023-01-16 10:43:49	2023-01-16 10:43:49
129	edit assets	web	2023-01-16 10:43:49	2023-01-16 10:43:49
130	delete assets	web	2023-01-16 10:43:49	2023-01-16 10:43:49
131	statement report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
132	manage constant custom field	web	2023-01-16 10:43:49	2023-01-16 10:43:49
133	create constant custom field	web	2023-01-16 10:43:49	2023-01-16 10:43:49
134	edit constant custom field	web	2023-01-16 10:43:49	2023-01-16 10:43:49
135	delete constant custom field	web	2023-01-16 10:43:49	2023-01-16 10:43:49
136	manage chart of account	web	2023-01-16 10:43:49	2023-01-16 10:43:49
137	create chart of account	web	2023-01-16 10:43:49	2023-01-16 10:43:49
138	edit chart of account	web	2023-01-16 10:43:49	2023-01-16 10:43:49
139	delete chart of account	web	2023-01-16 10:43:49	2023-01-16 10:43:49
140	manage journal entry	web	2023-01-16 10:43:49	2023-01-16 10:43:49
141	create journal entry	web	2023-01-16 10:43:49	2023-01-16 10:43:49
142	edit journal entry	web	2023-01-16 10:43:49	2023-01-16 10:43:49
143	delete journal entry	web	2023-01-16 10:43:49	2023-01-16 10:43:49
144	show journal entry	web	2023-01-16 10:43:49	2023-01-16 10:43:49
145	balance sheet report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
146	ledger report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
147	trial balance report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
148	manage client	web	2023-01-16 10:43:49	2023-01-16 10:43:49
149	create client	web	2023-01-16 10:43:49	2023-01-16 10:43:49
150	edit client	web	2023-01-16 10:43:49	2023-01-16 10:43:49
151	delete client	web	2023-01-16 10:43:49	2023-01-16 10:43:49
152	manage lead	web	2023-01-16 10:43:49	2023-01-16 10:43:49
153	create lead	web	2023-01-16 10:43:49	2023-01-16 10:43:49
154	view lead	web	2023-01-16 10:43:49	2023-01-16 10:43:49
155	edit lead	web	2023-01-16 10:43:49	2023-01-16 10:43:49
156	delete lead	web	2023-01-16 10:43:49	2023-01-16 10:43:49
157	move lead	web	2023-01-16 10:43:49	2023-01-16 10:43:49
158	create lead call	web	2023-01-16 10:43:49	2023-01-16 10:43:49
159	edit lead call	web	2023-01-16 10:43:49	2023-01-16 10:43:49
160	delete lead call	web	2023-01-16 10:43:49	2023-01-16 10:43:49
161	create lead email	web	2023-01-16 10:43:49	2023-01-16 10:43:49
162	manage pipeline	web	2023-01-16 10:43:49	2023-01-16 10:43:49
163	create pipeline	web	2023-01-16 10:43:49	2023-01-16 10:43:49
164	edit pipeline	web	2023-01-16 10:43:49	2023-01-16 10:43:49
165	delete pipeline	web	2023-01-16 10:43:49	2023-01-16 10:43:49
166	manage lead stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
167	create lead stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
168	edit lead stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
169	delete lead stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
170	convert lead to deal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
171	manage source	web	2023-01-16 10:43:49	2023-01-16 10:43:49
172	create source	web	2023-01-16 10:43:49	2023-01-16 10:43:49
173	edit source	web	2023-01-16 10:43:49	2023-01-16 10:43:49
174	delete source	web	2023-01-16 10:43:49	2023-01-16 10:43:49
175	manage label	web	2023-01-16 10:43:49	2023-01-16 10:43:49
176	create label	web	2023-01-16 10:43:49	2023-01-16 10:43:49
177	edit label	web	2023-01-16 10:43:49	2023-01-16 10:43:49
178	delete label	web	2023-01-16 10:43:49	2023-01-16 10:43:49
179	manage deal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
180	create deal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
181	view task	web	2023-01-16 10:43:49	2023-01-16 10:43:49
182	create task	web	2023-01-16 10:43:49	2023-01-16 10:43:49
183	edit task	web	2023-01-16 10:43:49	2023-01-16 10:43:49
184	delete task	web	2023-01-16 10:43:49	2023-01-16 10:43:49
185	edit deal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
186	view deal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
187	delete deal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
188	move deal	web	2023-01-16 10:43:49	2023-01-16 10:43:49
189	create deal call	web	2023-01-16 10:43:49	2023-01-16 10:43:49
190	edit deal call	web	2023-01-16 10:43:49	2023-01-16 10:43:49
191	delete deal call	web	2023-01-16 10:43:49	2023-01-16 10:43:49
192	create deal email	web	2023-01-16 10:43:49	2023-01-16 10:43:49
193	manage stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
194	create stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
195	edit stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
196	delete stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
197	manage employee	web	2023-01-16 10:43:49	2023-01-16 10:43:49
198	create employee	web	2023-01-16 10:43:49	2023-01-16 10:43:49
199	view employee	web	2023-01-16 10:43:49	2023-01-16 10:43:49
200	edit employee	web	2023-01-16 10:43:49	2023-01-16 10:43:49
201	delete employee	web	2023-01-16 10:43:49	2023-01-16 10:43:49
202	manage employee profile	web	2023-01-16 10:43:49	2023-01-16 10:43:49
203	show employee profile	web	2023-01-16 10:43:49	2023-01-16 10:43:49
204	manage department	web	2023-01-16 10:43:49	2023-01-16 10:43:49
205	create department	web	2023-01-16 10:43:49	2023-01-16 10:43:49
206	view department	web	2023-01-16 10:43:49	2023-01-16 10:43:49
207	edit department	web	2023-01-16 10:43:49	2023-01-16 10:43:49
208	delete department	web	2023-01-16 10:43:49	2023-01-16 10:43:49
209	manage designation	web	2023-01-16 10:43:49	2023-01-16 10:43:49
210	create designation	web	2023-01-16 10:43:49	2023-01-16 10:43:49
211	view designation	web	2023-01-16 10:43:49	2023-01-16 10:43:49
212	edit designation	web	2023-01-16 10:43:49	2023-01-16 10:43:49
213	delete designation	web	2023-01-16 10:43:49	2023-01-16 10:43:49
214	manage branch	web	2023-01-16 10:43:49	2023-01-16 10:43:49
215	create branch	web	2023-01-16 10:43:49	2023-01-16 10:43:49
216	edit branch	web	2023-01-16 10:43:49	2023-01-16 10:43:49
217	delete branch	web	2023-01-16 10:43:49	2023-01-16 10:43:49
218	manage document type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
219	create document type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
220	edit document type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
221	delete document type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
222	manage document	web	2023-01-16 10:43:49	2023-01-16 10:43:49
223	create document	web	2023-01-16 10:43:49	2023-01-16 10:43:49
224	edit document	web	2023-01-16 10:43:49	2023-01-16 10:43:49
225	delete document	web	2023-01-16 10:43:49	2023-01-16 10:43:49
226	manage payslip type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
227	create payslip type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
228	edit payslip type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
229	delete payslip type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
230	manage payslip	web	2023-01-16 10:43:49	2023-01-16 10:43:49
231	generate payslip	web	2023-01-16 10:43:49	2023-01-16 10:43:49
232	create reimbursement	web	2023-01-16 10:43:49	2023-01-16 10:43:49
233	edit reimbursement	web	2023-01-16 10:43:49	2023-01-16 10:43:49
234	delete reimbursement	web	2023-01-16 10:43:49	2023-01-16 10:43:49
235	create commission	web	2023-01-16 10:43:49	2023-01-16 10:43:49
236	edit commission	web	2023-01-16 10:43:49	2023-01-16 10:43:49
237	delete commission	web	2023-01-16 10:43:49	2023-01-16 10:43:49
238	manage reimbursement option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
239	create reimbursement option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
240	edit reimbursement option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
241	delete reimbursement option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
242	manage loan option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
243	create loan option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
244	edit loan option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
245	delete loan option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
246	manage deduction option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
247	create deduction option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
248	edit deduction option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
249	delete deduction option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
250	manage loan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
251	create loan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
252	edit loan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
253	delete loan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
254	create saturation deduction	web	2023-01-16 10:43:49	2023-01-16 10:43:49
255	edit saturation deduction	web	2023-01-16 10:43:49	2023-01-16 10:43:49
256	delete saturation deduction	web	2023-01-16 10:43:49	2023-01-16 10:43:49
257	create other payment	web	2023-01-16 10:43:49	2023-01-16 10:43:49
258	edit other payment	web	2023-01-16 10:43:49	2023-01-16 10:43:49
259	delete other payment	web	2023-01-16 10:43:49	2023-01-16 10:43:49
260	manage overtime	web	2023-01-16 10:43:49	2023-01-16 10:43:49
261	create overtime	web	2023-01-16 10:43:49	2023-01-16 10:43:49
262	edit overtime	web	2023-01-16 10:43:49	2023-01-16 10:43:49
263	delete overtime	web	2023-01-16 10:43:49	2023-01-16 10:43:49
264	manage day type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
265	create day type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
266	edit day type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
267	delete day type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
268	manage overtime type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
269	create overtime type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
270	edit overtime type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
271	delete overtime type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
272	manage set salary	web	2023-01-16 10:43:49	2023-01-16 10:43:49
273	edit set salary	web	2023-01-16 10:43:49	2023-01-16 10:43:49
274	manage pay slip	web	2023-01-16 10:43:49	2023-01-16 10:43:49
275	create set salary	web	2023-01-16 10:43:49	2023-01-16 10:43:49
276	create pay slip	web	2023-01-16 10:43:49	2023-01-16 10:43:49
277	manage company policy	web	2023-01-16 10:43:49	2023-01-16 10:43:49
278	create company policy	web	2023-01-16 10:43:49	2023-01-16 10:43:49
279	edit company policy	web	2023-01-16 10:43:49	2023-01-16 10:43:49
280	manage performance review	web	2023-01-16 10:43:49	2023-01-16 10:43:49
281	create performance review	web	2023-01-16 10:43:49	2023-01-16 10:43:49
282	edit performance review	web	2023-01-16 10:43:49	2023-01-16 10:43:49
283	show performance review	web	2023-01-16 10:43:49	2023-01-16 10:43:49
284	delete performance review	web	2023-01-16 10:43:49	2023-01-16 10:43:49
285	manage goal tracking	web	2023-01-16 10:43:49	2023-01-16 10:43:49
286	create goal tracking	web	2023-01-16 10:43:49	2023-01-16 10:43:49
287	edit goal tracking	web	2023-01-16 10:43:49	2023-01-16 10:43:49
288	delete goal tracking	web	2023-01-16 10:43:49	2023-01-16 10:43:49
289	manage goal type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
290	create goal type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
291	edit goal type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
292	delete goal type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
293	manage indicator	web	2023-01-16 10:43:49	2023-01-16 10:43:49
294	create indicator	web	2023-01-16 10:43:49	2023-01-16 10:43:49
295	edit indicator	web	2023-01-16 10:43:49	2023-01-16 10:43:49
296	show indicator	web	2023-01-16 10:43:49	2023-01-16 10:43:49
297	delete indicator	web	2023-01-16 10:43:49	2023-01-16 10:43:49
298	manage training	web	2023-01-16 10:43:49	2023-01-16 10:43:49
299	create training	web	2023-01-16 10:43:49	2023-01-16 10:43:49
300	edit training	web	2023-01-16 10:43:49	2023-01-16 10:43:49
301	delete training	web	2023-01-16 10:43:49	2023-01-16 10:43:49
302	show training	web	2023-01-16 10:43:49	2023-01-16 10:43:49
303	manage trainer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
304	create trainer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
305	edit trainer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
306	delete trainer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
307	manage training type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
308	create training type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
309	edit training type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
310	delete training type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
311	manage award	web	2023-01-16 10:43:49	2023-01-16 10:43:49
312	create award	web	2023-01-16 10:43:49	2023-01-16 10:43:49
313	edit award	web	2023-01-16 10:43:49	2023-01-16 10:43:49
314	delete award	web	2023-01-16 10:43:49	2023-01-16 10:43:49
315	manage award type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
316	create award type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
317	edit award type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
318	delete award type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
319	manage resignation	web	2023-01-16 10:43:49	2023-01-16 10:43:49
320	create resignation	web	2023-01-16 10:43:49	2023-01-16 10:43:49
321	edit resignation	web	2023-01-16 10:43:49	2023-01-16 10:43:49
322	delete resignation	web	2023-01-16 10:43:49	2023-01-16 10:43:49
323	manage on duty	web	2023-01-16 10:43:49	2023-01-16 10:43:49
324	create on duty	web	2023-01-16 10:43:49	2023-01-16 10:43:49
325	edit on duty	web	2023-01-16 10:43:49	2023-01-16 10:43:49
326	delete on duty	web	2023-01-16 10:43:49	2023-01-16 10:43:49
327	manage promotion	web	2023-01-16 10:43:49	2023-01-16 10:43:49
328	create promotion	web	2023-01-16 10:43:49	2023-01-16 10:43:49
329	edit promotion	web	2023-01-16 10:43:49	2023-01-16 10:43:49
330	delete promotion	web	2023-01-16 10:43:49	2023-01-16 10:43:49
331	manage complaint	web	2023-01-16 10:43:49	2023-01-16 10:43:49
332	create complaint	web	2023-01-16 10:43:49	2023-01-16 10:43:49
333	edit complaint	web	2023-01-16 10:43:49	2023-01-16 10:43:49
334	delete complaint	web	2023-01-16 10:43:49	2023-01-16 10:43:49
335	manage warning	web	2023-01-16 10:43:49	2023-01-16 10:43:49
336	create warning	web	2023-01-16 10:43:49	2023-01-16 10:43:49
337	edit warning	web	2023-01-16 10:43:49	2023-01-16 10:43:49
338	delete warning	web	2023-01-16 10:43:49	2023-01-16 10:43:49
339	manage termination	web	2023-01-16 10:43:49	2023-01-16 10:43:49
340	create termination	web	2023-01-16 10:43:49	2023-01-16 10:43:49
341	edit termination	web	2023-01-16 10:43:49	2023-01-16 10:43:49
342	delete termination	web	2023-01-16 10:43:49	2023-01-16 10:43:49
343	manage termination type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
344	create termination type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
345	edit termination type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
346	delete termination type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
347	manage job application	web	2023-01-16 10:43:49	2023-01-16 10:43:49
348	create job application	web	2023-01-16 10:43:49	2023-01-16 10:43:49
349	show job application	web	2023-01-16 10:43:49	2023-01-16 10:43:49
350	delete job application	web	2023-01-16 10:43:49	2023-01-16 10:43:49
351	move job application	web	2023-01-16 10:43:49	2023-01-16 10:43:49
352	add job application skill	web	2023-01-16 10:43:49	2023-01-16 10:43:49
353	add job application note	web	2023-01-16 10:43:49	2023-01-16 10:43:49
354	delete job application note	web	2023-01-16 10:43:49	2023-01-16 10:43:49
355	manage job onBoard	web	2023-01-16 10:43:49	2023-01-16 10:43:49
356	manage job category	web	2023-01-16 10:43:49	2023-01-16 10:43:49
357	create job category	web	2023-01-16 10:43:49	2023-01-16 10:43:49
358	edit job category	web	2023-01-16 10:43:49	2023-01-16 10:43:49
359	delete job category	web	2023-01-16 10:43:49	2023-01-16 10:43:49
360	manage job	web	2023-01-16 10:43:49	2023-01-16 10:43:49
361	create job	web	2023-01-16 10:43:49	2023-01-16 10:43:49
362	edit job	web	2023-01-16 10:43:49	2023-01-16 10:43:49
363	show job	web	2023-01-16 10:43:49	2023-01-16 10:43:49
364	delete job	web	2023-01-16 10:43:49	2023-01-16 10:43:49
365	manage job stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
366	create job stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
367	edit job stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
368	delete job stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
369	Manage Competencies	web	2023-01-16 10:43:49	2023-01-16 10:43:49
370	Create Competencies	web	2023-01-16 10:43:49	2023-01-16 10:43:49
371	Edit Competencies	web	2023-01-16 10:43:49	2023-01-16 10:43:49
372	Delete Competencies	web	2023-01-16 10:43:49	2023-01-16 10:43:49
373	manage custom question	web	2023-01-16 10:43:49	2023-01-16 10:43:49
374	create custom question	web	2023-01-16 10:43:49	2023-01-16 10:43:49
375	edit custom question	web	2023-01-16 10:43:49	2023-01-16 10:43:49
376	delete custom question	web	2023-01-16 10:43:49	2023-01-16 10:43:49
377	create interview schedule	web	2023-01-16 10:43:49	2023-01-16 10:43:49
378	edit interview schedule	web	2023-01-16 10:43:49	2023-01-16 10:43:49
379	delete interview schedule	web	2023-01-16 10:43:49	2023-01-16 10:43:49
380	show interview schedule	web	2023-01-16 10:43:49	2023-01-16 10:43:49
381	create estimation	web	2023-01-16 10:43:49	2023-01-16 10:43:49
382	view estimation	web	2023-01-16 10:43:49	2023-01-16 10:43:49
383	edit estimation	web	2023-01-16 10:43:49	2023-01-16 10:43:49
384	delete estimation	web	2023-01-16 10:43:49	2023-01-16 10:43:49
385	edit holiday	web	2023-01-16 10:43:49	2023-01-16 10:43:49
386	create holiday	web	2023-01-16 10:43:49	2023-01-16 10:43:49
387	delete holiday	web	2023-01-16 10:43:49	2023-01-16 10:43:49
388	manage holiday	web	2023-01-16 10:43:49	2023-01-16 10:43:49
389	show career	web	2023-01-16 10:43:49	2023-01-16 10:43:49
390	manage meeting	web	2023-01-16 10:43:49	2023-01-16 10:43:49
391	create meeting	web	2023-01-16 10:43:49	2023-01-16 10:43:49
392	edit meeting	web	2023-01-16 10:43:49	2023-01-16 10:43:49
393	delete meeting	web	2023-01-16 10:43:49	2023-01-16 10:43:49
394	manage event	web	2023-01-16 10:43:49	2023-01-16 10:43:49
395	create event	web	2023-01-16 10:43:49	2023-01-16 10:43:49
396	edit event	web	2023-01-16 10:43:49	2023-01-16 10:43:49
397	delete event	web	2023-01-16 10:43:49	2023-01-16 10:43:49
398	manage transfer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
399	create transfer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
400	edit transfer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
401	delete transfer	web	2023-01-16 10:43:49	2023-01-16 10:43:49
402	manage announcement	web	2023-01-16 10:43:49	2023-01-16 10:43:49
403	create announcement	web	2023-01-16 10:43:49	2023-01-16 10:43:49
404	edit announcement	web	2023-01-16 10:43:49	2023-01-16 10:43:49
405	delete announcement	web	2023-01-16 10:43:49	2023-01-16 10:43:49
406	manage leave	web	2023-01-16 10:43:49	2023-01-16 10:43:49
407	create leave	web	2023-01-16 10:43:49	2023-01-16 10:43:49
408	edit leave	web	2023-01-16 10:43:49	2023-01-16 10:43:49
409	delete leave	web	2023-01-16 10:43:49	2023-01-16 10:43:49
410	manage leave type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
411	create leave type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
412	edit leave type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
413	delete leave type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
414	manage attendance	web	2023-01-16 10:43:49	2023-01-16 10:43:49
415	create attendance	web	2023-01-16 10:43:49	2023-01-16 10:43:49
416	edit attendance	web	2023-01-16 10:43:49	2023-01-16 10:43:49
417	delete attendance	web	2023-01-16 10:43:49	2023-01-16 10:43:49
418	manage report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
419	manage project	web	2023-01-16 10:43:49	2023-01-16 10:43:49
420	create project	web	2023-01-16 10:43:49	2023-01-16 10:43:49
421	view project	web	2023-01-16 10:43:49	2023-01-16 10:43:49
422	edit project	web	2023-01-16 10:43:49	2023-01-16 10:43:49
423	delete project	web	2023-01-16 10:43:49	2023-01-16 10:43:49
424	create milestone	web	2023-01-16 10:43:49	2023-01-16 10:43:49
425	edit milestone	web	2023-01-16 10:43:49	2023-01-16 10:43:49
426	delete milestone	web	2023-01-16 10:43:49	2023-01-16 10:43:49
427	view milestone	web	2023-01-16 10:43:49	2023-01-16 10:43:49
428	view grant chart	web	2023-01-16 10:43:49	2023-01-16 10:43:49
429	manage project stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
430	create project stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
431	edit project stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
432	delete project stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
433	view expense	web	2023-01-16 10:43:49	2023-01-16 10:43:49
434	manage project task	web	2023-01-16 10:43:49	2023-01-16 10:43:49
435	create project task	web	2023-01-16 10:43:49	2023-01-16 10:43:49
436	edit project task	web	2023-01-16 10:43:49	2023-01-16 10:43:49
437	view project task	web	2023-01-16 10:43:49	2023-01-16 10:43:49
438	delete project task	web	2023-01-16 10:43:49	2023-01-16 10:43:49
439	view activity	web	2023-01-16 10:43:49	2023-01-16 10:43:49
440	view CRM activity	web	2023-01-16 10:43:49	2023-01-16 10:43:49
441	manage project task stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
442	edit project task stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
443	create project task stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
444	delete project task stage	web	2023-01-16 10:43:49	2023-01-16 10:43:49
445	manage timesheet	web	2023-01-16 10:43:49	2023-01-16 10:43:49
446	create timesheet	web	2023-01-16 10:43:49	2023-01-16 10:43:49
447	edit timesheet	web	2023-01-16 10:43:49	2023-01-16 10:43:49
448	delete timesheet	web	2023-01-16 10:43:49	2023-01-16 10:43:49
449	manage bug report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
450	create bug report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
451	edit bug report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
452	delete bug report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
453	move bug report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
454	manage bug status	web	2023-01-16 10:43:49	2023-01-16 10:43:49
455	create bug status	web	2023-01-16 10:43:49	2023-01-16 10:43:49
456	edit bug status	web	2023-01-16 10:43:49	2023-01-16 10:43:49
457	delete bug status	web	2023-01-16 10:43:49	2023-01-16 10:43:49
458	manage client dashboard	web	2023-01-16 10:43:49	2023-01-16 10:43:49
459	manage super admin dashboard	web	2023-01-16 10:43:49	2023-01-16 10:43:49
460	manage system settings	web	2023-01-16 10:43:49	2023-01-16 10:43:49
461	manage plan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
462	create plan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
463	edit plan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
464	manage coupon	web	2023-01-16 10:43:49	2023-01-16 10:43:49
465	create coupon	web	2023-01-16 10:43:49	2023-01-16 10:43:49
466	edit coupon	web	2023-01-16 10:43:49	2023-01-16 10:43:49
467	delete coupon	web	2023-01-16 10:43:49	2023-01-16 10:43:49
468	manage company plan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
469	buy plan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
470	manage form builder	web	2023-01-16 10:43:49	2023-01-16 10:43:49
471	create form builder	web	2023-01-16 10:43:49	2023-01-16 10:43:49
472	edit form builder	web	2023-01-16 10:43:49	2023-01-16 10:43:49
473	delete form builder	web	2023-01-16 10:43:49	2023-01-16 10:43:49
474	manage performance type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
475	create performance type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
476	edit performance type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
477	delete performance type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
478	manage form field	web	2023-01-16 10:43:49	2023-01-16 10:43:49
479	create form field	web	2023-01-16 10:43:49	2023-01-16 10:43:49
480	edit form field	web	2023-01-16 10:43:49	2023-01-16 10:43:49
481	delete form field	web	2023-01-16 10:43:49	2023-01-16 10:43:49
482	view form response	web	2023-01-16 10:43:49	2023-01-16 10:43:49
483	create budget plan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
484	edit budget plan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
485	manage budget plan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
486	delete budget plan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
487	view budget plan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
488	manage warehouse	web	2023-01-16 10:43:49	2023-01-16 10:43:49
489	create warehouse	web	2023-01-16 10:43:49	2023-01-16 10:43:49
490	edit warehouse	web	2023-01-16 10:43:49	2023-01-16 10:43:49
491	show warehouse	web	2023-01-16 10:43:49	2023-01-16 10:43:49
492	delete warehouse	web	2023-01-16 10:43:49	2023-01-16 10:43:49
493	manage purchase	web	2023-01-16 10:43:49	2023-01-16 10:43:49
494	create purchase	web	2023-01-16 10:43:49	2023-01-16 10:43:49
495	edit purchase	web	2023-01-16 10:43:49	2023-01-16 10:43:49
496	show employee request	web	2023-01-16 10:43:49	2023-01-16 10:43:49
497	manage employee request	web	2023-01-16 10:43:49	2023-01-16 10:43:49
498	show purchase	web	2023-01-16 10:43:49	2023-01-16 10:43:49
499	delete purchase	web	2023-01-16 10:43:49	2023-01-16 10:43:49
500	send purchase	web	2023-01-16 10:43:49	2023-01-16 10:43:49
501	create payment purchase	web	2023-01-16 10:43:49	2023-01-16 10:43:49
502	manage pos	web	2023-01-16 10:43:49	2023-01-16 10:43:49
503	manage contract type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
504	create contract type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
505	edit contract type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
506	delete contract type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
507	manage shift type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
508	create shift type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
509	edit shift type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
510	delete shift type	web	2023-01-16 10:43:49	2023-01-16 10:43:49
511	manage request shift schedule	web	2023-01-16 10:43:49	2023-01-16 10:43:49
512	show shift schedule	web	2023-01-16 10:43:49	2023-01-16 10:43:49
513	create shift schedule	web	2023-01-16 10:43:49	2023-01-16 10:43:49
514	edit shift schedule	web	2023-01-16 10:43:49	2023-01-16 10:43:49
515	delete shift schedule	web	2023-01-16 10:43:49	2023-01-16 10:43:49
516	create request shift schedule	web	2023-01-16 10:43:49	2023-01-16 10:43:49
517	edit request shift schedule	web	2023-01-16 10:43:49	2023-01-16 10:43:49
518	delete request shift schedule	web	2023-01-16 10:43:49	2023-01-16 10:43:49
519	manage contract	web	2023-01-16 10:43:49	2023-01-16 10:43:49
520	create contract	web	2023-01-16 10:43:49	2023-01-16 10:43:49
521	edit contract	web	2023-01-16 10:43:49	2023-01-16 10:43:49
522	delete contract	web	2023-01-16 10:43:49	2023-01-16 10:43:49
523	show contract	web	2023-01-16 10:43:49	2023-01-16 10:43:49
524	show time management report	web	2023-01-16 10:43:49	2023-01-16 10:43:49
525	manage payroll	web	2023-01-16 10:43:49	2023-01-16 10:43:49
526	create payroll	web	2023-01-16 10:43:49	2023-01-16 10:43:49
527	edit payroll	web	2023-01-16 10:43:49	2023-01-16 10:43:49
528	delete payroll	web	2023-01-16 10:43:49	2023-01-16 10:43:49
529	show payroll	web	2023-01-16 10:43:49	2023-01-16 10:43:49
530	manage reimburst	web	2023-01-16 10:43:49	2023-01-16 10:43:49
531	create reimburst	web	2023-01-16 10:43:49	2023-01-16 10:43:49
532	edit reimburst	web	2023-01-16 10:43:49	2023-01-16 10:43:49
533	delete reimburst	web	2023-01-16 10:43:49	2023-01-16 10:43:49
534	show reimburst	web	2023-01-16 10:43:49	2023-01-16 10:43:49
535	manage cash	web	2023-01-16 10:43:49	2023-01-16 10:43:49
536	create cash	web	2023-01-16 10:43:49	2023-01-16 10:43:49
537	edit cash	web	2023-01-16 10:43:49	2023-01-16 10:43:49
538	delete cash	web	2023-01-16 10:43:49	2023-01-16 10:43:49
539	manage cash advance	web	2023-01-16 10:43:49	2023-01-16 10:43:49
540	create cash advance	web	2023-01-16 10:43:49	2023-01-16 10:43:49
541	edit cash advance	web	2023-01-16 10:43:49	2023-01-16 10:43:49
542	delete cash advance	web	2023-01-16 10:43:49	2023-01-16 10:43:49
543	show cash	web	2023-01-16 10:43:49	2023-01-16 10:43:49
544	manage allowance	web	2023-01-16 10:43:49	2023-01-16 10:43:49
545	create allowance	web	2023-01-16 10:43:49	2023-01-16 10:43:49
546	edit allowance	web	2023-01-16 10:43:49	2023-01-16 10:43:49
547	delete allowance	web	2023-01-16 10:43:49	2023-01-16 10:43:49
548	manage allowance option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
549	create allowance option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
550	edit allowance option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
551	delete allowance option	web	2023-01-16 10:43:49	2023-01-16 10:43:49
552	manage denda	web	2023-01-16 10:43:49	2023-01-16 10:43:49
553	create denda	web	2023-01-16 10:43:49	2023-01-16 10:43:49
554	edit denda	web	2023-01-16 10:43:49	2023-01-16 10:43:49
555	delete denda	web	2023-01-16 10:43:49	2023-01-16 10:43:49
556	manage setting payroll overtime	web	2023-01-16 10:43:49	2023-01-16 10:43:49
557	create setting payroll overtime	web	2023-01-16 10:43:49	2023-01-16 10:43:49
558	edit setting payroll overtime	web	2023-01-16 10:43:49	2023-01-16 10:43:49
559	delete setting payroll overtime	web	2023-01-16 10:43:49	2023-01-16 10:43:49
560	manage bpjs kesehatan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
561	create bpjs kesehatan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
562	edit bpjs kesehatan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
563	delete bpjs kesehatan	web	2023-01-16 10:43:49	2023-01-16 10:43:49
564	manage pph21	web	2023-01-16 10:43:49	2023-01-16 10:43:49
565	edit pph21	web	2023-01-16 10:43:49	2023-01-16 10:43:49
566	manage jht	web	2023-01-16 10:43:49	2023-01-16 10:43:49
567	edit jht	web	2023-01-16 10:43:49	2023-01-16 10:43:49
568	manage jkk	web	2023-01-16 10:43:49	2023-01-16 10:43:49
569	edit jkk	web	2023-01-16 10:43:49	2023-01-16 10:43:49
570	manage jkm	web	2023-01-16 10:43:49	2023-01-16 10:43:49
571	edit jkm	web	2023-01-16 10:43:49	2023-01-16 10:43:49
572	manage jp	web	2023-01-16 10:43:49	2023-01-16 10:43:49
573	edit jp	web	2023-01-16 10:43:49	2023-01-16 10:43:49
574	manage dayoff	web	2023-01-16 10:43:49	2023-01-16 10:43:49
575	create dayoff	web	2023-01-16 10:43:49	2023-01-16 10:43:49
576	edit dayoff	web	2023-01-16 10:43:49	2023-01-16 10:43:49
577	delete dayoff	web	2023-01-16 10:43:49	2023-01-16 10:43:49
578	manage company holiday	web	2023-01-16 10:43:49	2023-01-16 10:43:49
579	create company holiday	web	2023-01-16 10:43:49	2023-01-16 10:43:49
580	edit company holiday	web	2023-01-16 10:43:49	2023-01-16 10:43:49
581	delete company holiday	web	2023-01-16 10:43:49	2023-01-16 10:43:49
582	show allowance	web	2023-01-16 10:43:49	2023-01-16 10:43:49
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
1	super admin	web	2023-01-16 10:43:49	2023-01-16 10:43:49	0
2	company	web	2023-01-16 10:43:49	2023-01-16 10:43:49	0
3	accountant	web	2023-01-16 10:43:49	2023-01-16 10:43:49	2
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
1	overtime1	2	2023-01-16 10:43:49	2023-01-16 10:43:49
\.


--
-- Name: overtime_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('overtime_types_id_seq', 1, true);


--
-- Data for Name: overtimes; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY overtimes (id, employee_id, overtime_type_id, day_type_id, start_date, end_date, start_time, end_time, duration, amount_fee, notes, status, rejected_reason, attachment_reject, created_by, created_at, updated_at) FROM stdin;
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
-- Data for Name: pay_slips; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY pay_slips (id, employee_id, pdf_filename, net_payble, salary_month, status, basic_salary, salary, allowance, reimburst, cash_in_advance, loan, denda, bpjs_kesehatan, pph21, overtime, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: pay_slips_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('pay_slips_id_seq', 1, false);


--
-- Data for Name: payrolls; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY payrolls (id, employee_id, payslip_type_id, amount, created_by, created_at, updated_at) FROM stdin;
3	1	1	2000000	2	2023-01-16 11:07:30	2023-01-16 11:07:30
\.


--
-- Name: payrolls_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('payrolls_id_seq', 3, true);


--
-- Data for Name: payslip_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY payslip_types (id, name, created_by, created_at, updated_at) FROM stdin;
1	Gaji Pokok	2	2023-01-16 11:02:40	2023-01-16 11:02:40
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
\.


--
-- Name: reimburstment_options_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('reimburstment_options_id_seq', 1, false);


--
-- Data for Name: reimbursts; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY reimbursts (id, employee_id, reimburst_type_id, amount, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: reimbursts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('reimbursts_id_seq', 1, false);


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
\.


--
-- Name: set_bpjstk_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('set_bpjstk_id_seq', 1, false);


--
-- Data for Name: settings; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY settings (id, name, value, created_by, created_at, updated_at) FROM stdin;
1	employee_prefix	#PDR	2	2023-01-16 10:43:49	2023-01-16 10:43:49
2	site_time_format	PDR	2	2023-01-16 10:43:49	2023-01-16 10:43:49
3	storage_setting	local	1	2023-01-16 10:43:49	2023-01-16 10:43:49
4	jht	{"type":"JHT","value":"5.7"}	2	2023-01-16 10:43:49	2023-01-16 10:43:49
5	jp	{"type":"JP","value":"3"}	2	2023-01-16 10:43:49	2023-01-16 10:43:49
\.


--
-- Name: settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('settings_id_seq', 5, true);


--
-- Data for Name: shift_schedules; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY shift_schedules (id, employee_id, req_shift_schedules_id, schedule_date, shift_id, status, is_dayoff, dayoff_type, description, is_active, created_by, created_at, updated_at) FROM stdin;
1	1	\N	2022-12-01	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
2	1	\N	2022-12-02	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
4	1	\N	2022-12-04	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
5	1	\N	2022-12-05	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
6	1	\N	2022-12-06	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
7	1	\N	2022-12-07	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
8	1	\N	2022-12-08	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
9	1	\N	2022-12-09	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
11	1	\N	2022-12-11	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
12	1	\N	2022-12-12	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
13	1	\N	2022-12-13	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
14	1	\N	2022-12-14	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
15	1	\N	2022-12-15	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
16	1	\N	2022-12-16	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
18	1	\N	2022-12-18	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
19	1	\N	2022-12-19	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
20	1	\N	2022-12-20	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
21	1	\N	2022-12-21	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
23	1	\N	2022-12-23	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
26	1	\N	2022-12-26	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
27	1	\N	2022-12-27	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
28	1	\N	2022-12-28	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
29	1	\N	2022-12-29	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
30	1	\N	2022-12-30	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
33	1	\N	2023-01-02	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
34	1	\N	2023-01-03	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
35	1	\N	2023-01-04	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
36	1	\N	2023-01-05	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
37	1	\N	2023-01-06	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
39	1	\N	2023-01-08	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
40	1	\N	2023-01-09	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
41	1	\N	2023-01-10	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
42	1	\N	2023-01-11	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
43	1	\N	2023-01-12	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
44	1	\N	2023-01-13	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
46	1	\N	2023-01-15	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
47	1	\N	2023-01-16	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
48	1	\N	2023-01-17	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
49	1	\N	2023-01-18	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
50	1	\N	2023-01-19	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
51	1	\N	2023-01-20	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
55	1	\N	2023-01-24	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
56	1	\N	2023-01-25	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
57	1	\N	2023-01-26	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
58	1	\N	2023-01-27	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
60	1	\N	2023-01-29	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
61	1	\N	2023-01-30	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
62	1	\N	2023-01-31	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
63	1	\N	2023-02-01	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
64	1	\N	2023-02-02	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
65	1	\N	2023-02-03	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
67	1	\N	2023-02-05	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
68	1	\N	2023-02-06	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
69	1	\N	2023-02-07	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
70	1	\N	2023-02-08	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
71	1	\N	2023-02-09	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
72	1	\N	2023-02-10	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
74	1	\N	2023-02-12	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
75	1	\N	2023-02-13	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
76	1	\N	2023-02-14	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
77	1	\N	2023-02-15	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
78	1	\N	2023-02-16	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
79	1	\N	2023-02-17	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
81	1	\N	2023-02-19	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
82	1	\N	2023-02-20	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
83	1	\N	2023-02-21	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
84	1	\N	2023-02-22	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
85	1	\N	2023-02-23	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
86	1	\N	2023-02-24	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
88	1	\N	2023-02-26	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
3	1	\N	2022-12-03	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
25	1	\N	2022-12-25	1	Approved	t	National Holiday	Hari Raya Natal	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
32	1	\N	2023-01-01	1	Approved	t	National Holiday	Hari Tahun Baru	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
53	1	\N	2023-01-22	1	Approved	t	National Holiday	Tahun Baru Imlek	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
24	1	\N	2022-12-24	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
80	1	\N	2023-02-18	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
89	1	\N	2023-02-27	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
90	1	\N	2023-02-28	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
91	1	\N	2023-03-01	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
92	1	\N	2023-03-02	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
93	1	\N	2023-03-03	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
95	1	\N	2023-03-05	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
96	1	\N	2023-03-06	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
97	1	\N	2023-03-07	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
98	1	\N	2023-03-08	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
99	1	\N	2023-03-09	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
100	1	\N	2023-03-10	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
102	1	\N	2023-03-12	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
103	1	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
104	1	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
105	1	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
106	1	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
107	1	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
109	1	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
110	1	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
111	1	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
114	1	\N	2023-03-24	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
116	1	\N	2023-03-26	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
117	1	\N	2023-03-27	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
118	1	\N	2023-03-28	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
119	1	\N	2023-03-29	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
120	1	\N	2023-03-30	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
121	1	\N	2023-03-31	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
123	1	\N	2023-04-02	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
124	1	\N	2023-04-03	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
125	1	\N	2023-04-04	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
126	1	\N	2023-04-05	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
127	1	\N	2023-04-06	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
131	1	\N	2023-04-10	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
132	1	\N	2023-04-11	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
133	1	\N	2023-04-12	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
134	1	\N	2023-04-13	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
135	1	\N	2023-04-14	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
137	1	\N	2023-04-16	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
138	1	\N	2023-04-17	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
139	1	\N	2023-04-18	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
140	1	\N	2023-04-19	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
141	1	\N	2023-04-20	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
148	1	\N	2023-04-27	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
149	1	\N	2023-04-28	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
151	1	\N	2023-04-30	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
153	1	\N	2023-05-02	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
154	1	\N	2023-05-03	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
155	1	\N	2023-05-04	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
156	1	\N	2023-05-05	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
158	1	\N	2023-05-07	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
159	1	\N	2023-05-08	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
160	1	\N	2023-05-09	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
161	1	\N	2023-05-10	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
162	1	\N	2023-05-11	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
163	1	\N	2023-05-12	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
165	1	\N	2023-05-14	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
166	1	\N	2023-05-15	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
167	1	\N	2023-05-16	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
168	1	\N	2023-05-17	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
170	1	\N	2023-05-19	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
172	1	\N	2023-05-21	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
173	1	\N	2023-05-22	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
174	1	\N	2023-05-23	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
175	1	\N	2023-05-24	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
176	1	\N	2023-05-25	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
128	1	\N	2023-04-07	1	Approved	t	National Holiday	Wafat Isa Almasih	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
130	1	\N	2023-04-09	1	Approved	t	National Holiday	Hari Paskah	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
142	1	\N	2023-04-21	1	Approved	t	National Holiday	Hari Kartini	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
145	1	\N	2023-04-24	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
146	1	\N	2023-04-25	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
152	1	\N	2023-05-01	1	Approved	t	National Holiday	Hari Buruh Internasional / Pekerja	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
169	1	\N	2023-05-18	1	Approved	t	National Holiday	Kenaikan Isa Al Masih	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
143	1	\N	2023-04-22	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
177	1	\N	2023-05-26	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
179	1	\N	2023-05-28	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
180	1	\N	2023-05-29	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
181	1	\N	2023-05-30	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
182	1	\N	2023-05-31	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
187	1	\N	2023-06-05	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
188	1	\N	2023-06-06	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
189	1	\N	2023-06-07	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
190	1	\N	2023-06-08	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
191	1	\N	2023-06-09	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
193	1	\N	2023-06-11	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
194	1	\N	2023-06-12	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
195	1	\N	2023-06-13	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
196	1	\N	2023-06-14	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
197	1	\N	2023-06-15	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
198	1	\N	2023-06-16	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
200	1	\N	2023-06-18	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
201	1	\N	2023-06-19	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
202	1	\N	2023-06-20	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
203	1	\N	2023-06-21	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
204	1	\N	2023-06-22	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
205	1	\N	2023-06-23	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
207	1	\N	2023-06-25	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
208	1	\N	2023-06-26	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
209	1	\N	2023-06-27	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
210	1	\N	2023-06-28	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
212	1	\N	2023-06-30	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
214	1	\N	2023-07-02	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
215	1	\N	2023-07-03	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
216	1	\N	2023-07-04	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
217	1	\N	2023-07-05	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
218	1	\N	2023-07-06	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
219	1	\N	2023-07-07	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
221	1	\N	2023-07-09	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
222	1	\N	2023-07-10	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
223	1	\N	2023-07-11	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
224	1	\N	2023-07-12	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
225	1	\N	2023-07-13	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
226	1	\N	2023-07-14	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
228	1	\N	2023-07-16	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
229	1	\N	2023-07-17	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
230	1	\N	2023-07-18	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
232	1	\N	2023-07-20	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
233	1	\N	2023-07-21	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
235	1	\N	2023-07-23	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
236	1	\N	2023-07-24	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
237	1	\N	2023-07-25	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
238	1	\N	2023-07-26	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
239	1	\N	2023-07-27	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
240	1	\N	2023-07-28	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
242	1	\N	2023-07-30	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
243	1	\N	2023-07-31	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
244	1	\N	2023-08-01	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
245	1	\N	2023-08-02	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
246	1	\N	2023-08-03	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
247	1	\N	2023-08-04	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
249	1	\N	2023-08-06	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
250	1	\N	2023-08-07	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
251	1	\N	2023-08-08	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
252	1	\N	2023-08-09	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
253	1	\N	2023-08-10	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
254	1	\N	2023-08-11	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
256	1	\N	2023-08-13	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
257	1	\N	2023-08-14	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
258	1	\N	2023-08-15	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
259	1	\N	2023-08-16	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
261	1	\N	2023-08-18	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
263	1	\N	2023-08-20	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
264	1	\N	2023-08-21	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
184	1	\N	2023-06-02	1	Approved	t	National Holiday	Cuti Bersama Waisak	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
186	1	\N	2023-06-04	1	Approved	t	National Holiday	Hari Raya Waisak	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
231	1	\N	2023-07-19	1	Approved	t	National Holiday	Satu Muharam / Tahun Baru Hijriah	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
178	1	\N	2023-05-27	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
265	1	\N	2023-08-22	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
266	1	\N	2023-08-23	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
267	1	\N	2023-08-24	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
268	1	\N	2023-08-25	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
270	1	\N	2023-08-27	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
271	1	\N	2023-08-28	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
272	1	\N	2023-08-29	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
273	1	\N	2023-08-30	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
274	1	\N	2023-08-31	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
275	1	\N	2023-09-01	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
277	1	\N	2023-09-03	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
278	1	\N	2023-09-04	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
279	1	\N	2023-09-05	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
280	1	\N	2023-09-06	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
281	1	\N	2023-09-07	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
282	1	\N	2023-09-08	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
284	1	\N	2023-09-10	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
285	1	\N	2023-09-11	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
286	1	\N	2023-09-12	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
287	1	\N	2023-09-13	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
288	1	\N	2023-09-14	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
289	1	\N	2023-09-15	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
291	1	\N	2023-09-17	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
292	1	\N	2023-09-18	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
293	1	\N	2023-09-19	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
294	1	\N	2023-09-20	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
295	1	\N	2023-09-21	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
296	1	\N	2023-09-22	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
298	1	\N	2023-09-24	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
299	1	\N	2023-09-25	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
300	1	\N	2023-09-26	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
301	1	\N	2023-09-27	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
303	1	\N	2023-09-29	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
305	1	\N	2023-10-01	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
307	1	\N	2023-10-03	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
308	1	\N	2023-10-04	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
309	1	\N	2023-10-05	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
310	1	\N	2023-10-06	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
312	1	\N	2023-10-08	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
313	1	\N	2023-10-09	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
314	1	\N	2023-10-10	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
315	1	\N	2023-10-11	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
316	1	\N	2023-10-12	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
317	1	\N	2023-10-13	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
319	1	\N	2023-10-15	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
320	1	\N	2023-10-16	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
321	1	\N	2023-10-17	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
322	1	\N	2023-10-18	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
323	1	\N	2023-10-19	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
324	1	\N	2023-10-20	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
326	1	\N	2023-10-22	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
327	1	\N	2023-10-23	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
328	1	\N	2023-10-24	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
329	1	\N	2023-10-25	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
330	1	\N	2023-10-26	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
331	1	\N	2023-10-27	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
333	1	\N	2023-10-29	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
334	1	\N	2023-10-30	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
335	1	\N	2023-10-31	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
336	1	\N	2023-11-01	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
337	1	\N	2023-11-02	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
338	1	\N	2023-11-03	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
340	1	\N	2023-11-05	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
341	1	\N	2023-11-06	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
342	1	\N	2023-11-07	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
343	1	\N	2023-11-08	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
344	1	\N	2023-11-09	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
345	1	\N	2023-11-10	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
348	1	\N	2023-11-13	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
349	1	\N	2023-11-14	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
350	1	\N	2023-11-15	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
351	1	\N	2023-11-16	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
352	1	\N	2023-11-17	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
306	1	\N	2023-10-02	1	Approved	t	National Holiday	Hari Batik	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
347	1	\N	2023-11-12	1	Approved	t	National Holiday	Diwali / Deepavali	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
354	1	\N	2023-11-19	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
355	1	\N	2023-11-20	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
356	1	\N	2023-11-21	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
357	1	\N	2023-11-22	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
358	1	\N	2023-11-23	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
359	1	\N	2023-11-24	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
361	1	\N	2023-11-26	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
362	1	\N	2023-11-27	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
363	1	\N	2023-11-28	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
364	1	\N	2023-11-29	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
365	1	\N	2023-11-30	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
366	1	\N	2023-12-01	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 10:43:49
22	1	\N	2022-12-22	1	Approved	t	National Holiday	Hari Ibu	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
54	1	\N	2023-01-23	1	Approved	t	National Holiday	Lunar New Year Joint Holiday	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
112	1	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
113	1	\N	2023-03-23	1	Approved	t	National Holiday	Joint Holiday for Bali's Day of Silence and Hindu New Year (Nyepi)	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
144	1	\N	2023-04-23	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
147	1	\N	2023-04-26	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
183	1	\N	2023-06-01	1	Approved	t	National Holiday	Hari Lahir Pancasila	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
211	1	\N	2023-06-29	1	Approved	t	National Holiday	Idul Adha (Lebaran Haji)	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
260	1	\N	2023-08-17	1	Approved	t	National Holiday	Hari Proklamasi Kemerdekaan R.I.	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
302	1	\N	2023-09-28	1	Approved	t	National Holiday	Maulid Nabi Muhammad	t	2	2023-01-16 10:43:49	2023-01-16 11:01:51
10	1	\N	2022-12-10	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
31	1	\N	2022-12-31	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
360	1	\N	2023-11-25	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
17	1	\N	2022-12-17	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
38	1	\N	2023-01-07	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
45	1	\N	2023-01-14	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
52	1	\N	2023-01-21	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
59	1	\N	2023-01-28	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
66	1	\N	2023-02-04	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
73	1	\N	2023-02-11	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
87	1	\N	2023-02-25	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
94	1	\N	2023-03-04	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
101	1	\N	2023-03-11	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
108	1	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
115	1	\N	2023-03-25	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
122	1	\N	2023-04-01	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
129	1	\N	2023-04-08	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
136	1	\N	2023-04-15	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
150	1	\N	2023-04-29	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
157	1	\N	2023-05-06	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
164	1	\N	2023-05-13	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
171	1	\N	2023-05-20	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
185	1	\N	2023-06-03	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
192	1	\N	2023-06-10	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
199	1	\N	2023-06-17	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
206	1	\N	2023-06-24	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
213	1	\N	2023-07-01	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
220	1	\N	2023-07-08	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
227	1	\N	2023-07-15	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
234	1	\N	2023-07-22	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
241	1	\N	2023-07-29	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
248	1	\N	2023-08-05	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
255	1	\N	2023-08-12	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
262	1	\N	2023-08-19	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
269	1	\N	2023-08-26	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
276	1	\N	2023-09-02	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
283	1	\N	2023-09-09	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
290	1	\N	2023-09-16	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
297	1	\N	2023-09-23	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
304	1	\N	2023-09-30	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
311	1	\N	2023-10-07	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
318	1	\N	2023-10-14	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
325	1	\N	2023-10-21	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
332	1	\N	2023-10-28	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
339	1	\N	2023-11-04	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
346	1	\N	2023-11-11	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
353	1	\N	2023-11-18	1	Approved	f	\N	\N	t	2	2023-01-16 10:43:49	2023-01-16 11:02:18
\.


--
-- Name: shift_schedules_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('shift_schedules_id_seq', 366, true);


--
-- Data for Name: shift_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY shift_types (id, day_type_id, name, start_time, end_time, is_wfh, created_by, created_at, updated_at) FROM stdin;
1	1	Reguler	07:00:00	15:00:00	f	2	2023-01-16 10:43:49	2023-01-16 10:43:49
2	1	WFH	08:00:00	16:00:00	f	2	2023-01-16 10:43:49	2023-01-16 10:43:49
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
1	\N	Super Admin	superadmin@example.com	\N	$2y$10$ocT4SQxTFKbJcDmzFUTDquRj5k9PtajhJPO8./uKWRvAkj6f5QWNe	\N	\N	super admin		en	0	\N	1	1	\N	\N	2023-01-16 10:43:49	2023-01-16 10:43:49
3	\N	accountant	accountant@pehadir.com	\N	$2y$10$vkbkDIlwn3Gv7Y/7wZfNWOodpj/NGL2LD/eYyjeU0Wpfnf3yArSWa	\N	\N	accountant		en	2	1	1	1	\N	\N	2023-01-16 10:43:49	2023-01-16 10:43:49
2	\N	company	company@pehadir.com	\N	$2y$10$hnoJ0F1cmVR4MIF6lZ95V.n.VVOBbXiyHXc.gzmAa66h4zM..OVbm	1	\N	company		en	1	1	1	1	2023-01-16 11:10:52	\N	2023-01-16 10:43:49	2023-01-16 11:10:52
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('users_id_seq', 3, true);


--
-- PostgreSQL database dump complete
--

