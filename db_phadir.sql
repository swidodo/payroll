--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

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
-- Name: all_requests; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE all_requests (
    id bigint NOT NULL,
    request_id integer,
    request_no character varying(255),
    request_for character varying(255),
    request_by character varying(255),
    request_type character varying(255),
    req_date date,
    status character varying(255),
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.all_requests OWNER TO pehadirm;

--
-- Name: all_requests_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE all_requests_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.all_requests_id_seq OWNER TO pehadirm;

--
-- Name: all_requests_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE all_requests_id_seq OWNED BY all_requests.id;


--
-- Name: allowance_finances; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE allowance_finances (
    id bigint NOT NULL,
    employee_id integer NOT NULL,
    allowance_type_id integer NOT NULL,
    amount integer NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.allowance_finances OWNER TO pehadirm;

--
-- Name: allowance_finances_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE allowance_finances_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.allowance_finances_id_seq OWNER TO pehadirm;

--
-- Name: allowance_finances_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE allowance_finances_id_seq OWNED BY allowance_finances.id;


--
-- Name: allowance_options; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE allowance_options (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.allowance_options OWNER TO pehadirm;

--
-- Name: allowance_options_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE allowance_options_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.allowance_options_id_seq OWNER TO pehadirm;

--
-- Name: allowance_options_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE allowance_options_id_seq OWNED BY allowance_options.id;


--
-- Name: allowances; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE allowances (
    id bigint NOT NULL,
    employee_id integer NOT NULL,
    allowance_option integer NOT NULL,
    title character varying(255) NOT NULL,
    amount integer NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.allowances OWNER TO pehadirm;

--
-- Name: allowances_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE allowances_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.allowances_id_seq OWNER TO pehadirm;

--
-- Name: allowances_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE allowances_id_seq OWNED BY allowances.id;


--
-- Name: attendance_employees; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE attendance_employees (
    id bigint NOT NULL,
    employee_id integer NOT NULL,
    date date NOT NULL,
    status character varying(255) NOT NULL,
    denda integer,
    clock_in time(0) without time zone NOT NULL,
    clock_out time(0) without time zone NOT NULL,
    break_in time(0) without time zone DEFAULT '00:00:00'::time without time zone NOT NULL,
    break_out time(0) without time zone DEFAULT '00:00:00'::time without time zone NOT NULL,
    late time(0) without time zone NOT NULL,
    early_leaving time(0) without time zone NOT NULL,
    overtime time(0) without time zone NOT NULL,
    total_rest time(0) without time zone NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.attendance_employees OWNER TO pehadirm;

--
-- Name: attendance_employees_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE attendance_employees_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.attendance_employees_id_seq OWNER TO pehadirm;

--
-- Name: attendance_employees_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE attendance_employees_id_seq OWNED BY attendance_employees.id;


--
-- Name: branches; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE branches (
    id bigint NOT NULL,
    name character varying(255),
    alias character varying(255),
    created_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.branches OWNER TO pehadirm;

--
-- Name: branches_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE branches_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.branches_id_seq OWNER TO pehadirm;

--
-- Name: branches_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE branches_id_seq OWNED BY branches.id;


--
-- Name: break_times; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE break_times (
    id bigint NOT NULL,
    shift_type_id integer,
    start_time time(0) without time zone,
    end_time time(0) without time zone,
    created_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.break_times OWNER TO pehadirm;

--
-- Name: break_times_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE break_times_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.break_times_id_seq OWNER TO pehadirm;

--
-- Name: break_times_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE break_times_id_seq OWNED BY break_times.id;


--
-- Name: cashes; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE cashes (
    id bigint NOT NULL,
    employee_id integer NOT NULL,
    loan_type_id integer NOT NULL,
    amount integer NOT NULL,
    installment integer NOT NULL,
    number_of_installment integer NOT NULL,
    status character varying(255) NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT cashes_status_check CHECK (((status)::text = ANY (ARRAY[('paid off'::character varying)::text, ('ongoing'::character varying)::text])))
);


ALTER TABLE public.cashes OWNER TO pehadirm;

--
-- Name: cashes_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE cashes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cashes_id_seq OWNER TO pehadirm;

--
-- Name: cashes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE cashes_id_seq OWNED BY cashes.id;


--
-- Name: checklist_attendance_summaries; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE checklist_attendance_summaries (
    id bigint NOT NULL,
    name character varying(255),
    is_displayed boolean,
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.checklist_attendance_summaries OWNER TO pehadirm;

--
-- Name: checklist_attendance_summaries_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE checklist_attendance_summaries_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.checklist_attendance_summaries_id_seq OWNER TO pehadirm;

--
-- Name: checklist_attendance_summaries_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE checklist_attendance_summaries_id_seq OWNED BY checklist_attendance_summaries.id;


--
-- Name: company_holidays; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE company_holidays (
    id bigint NOT NULL,
    company_holiday_date date NOT NULL,
    "desc" character varying(255) NOT NULL,
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.company_holidays OWNER TO pehadirm;

--
-- Name: company_holidays_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE company_holidays_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.company_holidays_id_seq OWNER TO pehadirm;

--
-- Name: company_holidays_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE company_holidays_id_seq OWNED BY company_holidays.id;


--
-- Name: day_types; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE day_types (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.day_types OWNER TO pehadirm;

--
-- Name: day_types_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE day_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.day_types_id_seq OWNER TO pehadirm;

--
-- Name: day_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE day_types_id_seq OWNED BY day_types.id;


--
-- Name: dayoffs; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE dayoffs (
    id bigint NOT NULL,
    date date NOT NULL,
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.dayoffs OWNER TO pehadirm;

--
-- Name: dayoffs_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE dayoffs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dayoffs_id_seq OWNER TO pehadirm;

--
-- Name: dayoffs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE dayoffs_id_seq OWNED BY dayoffs.id;


--
-- Name: dendas; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE dendas (
    id bigint NOT NULL,
    day_type_id integer,
    "time" time(0) without time zone,
    amount numeric(8,2),
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.dendas OWNER TO pehadirm;

--
-- Name: dendas_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE dendas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dendas_id_seq OWNER TO pehadirm;

--
-- Name: dendas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE dendas_id_seq OWNED BY dendas.id;


--
-- Name: documents; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE documents (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    is_required character varying(255) NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.documents OWNER TO pehadirm;

--
-- Name: documents_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE documents_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.documents_id_seq OWNER TO pehadirm;

--
-- Name: documents_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE documents_id_seq OWNED BY documents.id;


--
-- Name: employee_documents; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE employee_documents (
    id bigint NOT NULL,
    employee_id integer NOT NULL,
    document_id integer NOT NULL,
    document_value character varying(255) NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.employee_documents OWNER TO pehadirm;

--
-- Name: employee_documents_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE employee_documents_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.employee_documents_id_seq OWNER TO pehadirm;

--
-- Name: employee_documents_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE employee_documents_id_seq OWNED BY employee_documents.id;


--
-- Name: employee_education; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE employee_education (
    id bigint NOT NULL,
    employee_id integer,
    start_date date,
    end_date date,
    type character varying(255),
    level character varying(255),
    institution character varying(255),
    address character varying(255),
    major character varying(255),
    gpa character varying(255),
    notes character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.employee_education OWNER TO pehadirm;

--
-- Name: employee_education_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE employee_education_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.employee_education_id_seq OWNER TO pehadirm;

--
-- Name: employee_education_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE employee_education_id_seq OWNED BY employee_education.id;


--
-- Name: employee_experiences; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE employee_experiences (
    id bigint NOT NULL,
    employee_id integer,
    start_date date,
    end_date date,
    sequence integer,
    job character varying(255),
    "position" character varying(255),
    address character varying(255),
    city character varying(255),
    reason_leaving character varying(255),
    note character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.employee_experiences OWNER TO pehadirm;

--
-- Name: employee_experiences_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE employee_experiences_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.employee_experiences_id_seq OWNER TO pehadirm;

--
-- Name: employee_experiences_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE employee_experiences_id_seq OWNED BY employee_experiences.id;


--
-- Name: employee_medicals; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE employee_medicals (
    id bigint NOT NULL,
    employee_id integer,
    height character varying(255),
    weight character varying(255),
    blood_type character varying(255),
    medical_test character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.employee_medicals OWNER TO pehadirm;

--
-- Name: employee_medicals_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE employee_medicals_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.employee_medicals_id_seq OWNER TO pehadirm;

--
-- Name: employee_medicals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE employee_medicals_id_seq OWNED BY employee_medicals.id;


--
-- Name: employees; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE employees (
    id bigint NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    name character varying(255),
    dob date,
    gender character varying(255),
    phone character varying(255),
    address character varying(255),
    email character varying(255),
    password character varying(255),
    employee_id character varying(255) DEFAULT '0'::character varying NOT NULL,
    branch_id integer DEFAULT 0 NOT NULL,
    department_id integer DEFAULT 0 NOT NULL,
    designation_id integer DEFAULT 0 NOT NULL,
    company_doj character varying(255),
    company_doe character varying(255),
    documents character varying(255),
    account_holder_name character varying(255),
    account_number character varying(255),
    bank_name character varying(255),
    bank_identifier_code character varying(255),
    branch_location character varying(255),
    tax_payer_id character varying(255),
    salary_type character varying(255),
    salary integer,
    net_salary integer,
    is_active boolean DEFAULT true NOT NULL,
    created_by integer NOT NULL,
    level_approval integer,
    leave_type character varying(255),
    employee_type character varying(255),
    marital_status character varying(255),
    total_leave integer DEFAULT 0 NOT NULL,
    total_leave_remaining integer,
    out_date date,
    status character varying(255) DEFAULT 'active'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    identity_card character varying(16),
    family_card character varying(18),
    npwp_number character varying(20),
    religion character varying(20),
    CONSTRAINT employees_leave_type_check CHECK (((leave_type)::text = ANY (ARRAY[('monthly'::character varying)::text, ('annual'::character varying)::text]))),
    CONSTRAINT employees_marital_status_check CHECK (((marital_status)::text = ANY (ARRAY[('single'::character varying)::text, ('married'::character varying)::text]))),
    CONSTRAINT employees_status_check CHECK (((status)::text = ANY (ARRAY[('pension'::character varying)::text, ('fired'::character varying)::text, ('active'::character varying)::text])))
);


ALTER TABLE public.employees OWNER TO pehadirm;

--
-- Name: employees_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE employees_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.employees_id_seq OWNER TO pehadirm;

--
-- Name: employees_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE employees_id_seq OWNED BY employees.id;


--
-- Name: employements; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE employements (
    id bigint NOT NULL,
    employee_id integer,
    movement_type character varying(255),
    area character varying(255),
    office character varying(255),
    job_level character varying(255),
    "position" character varying(255),
    type character varying(255),
    note character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.employements OWNER TO pehadirm;

--
-- Name: employements_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE employements_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.employements_id_seq OWNER TO pehadirm;

--
-- Name: employements_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE employements_id_seq OWNED BY employements.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO pehadirm;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO pehadirm;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE failed_jobs_id_seq OWNED BY failed_jobs.id;


--
-- Name: families; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE families (
    id bigint NOT NULL,
    employee_id integer,
    name character varying(255),
    gender character varying(255),
    relationship character varying(255),
    notes character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.families OWNER TO pehadirm;

--
-- Name: families_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE families_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.families_id_seq OWNER TO pehadirm;

--
-- Name: families_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE families_id_seq OWNED BY families.id;


--
-- Name: history_leaves; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE history_leaves (
    id bigint NOT NULL,
    employee_id integer,
    leave_type_id integer,
    applied_on date,
    start_date date,
    end_date date,
    total_leave_days character varying(255),
    leave_reason character varying(255),
    attachment_request_path character varying(255),
    remark character varying(255),
    status character varying(255),
    rejected_reason character varying(255),
    attachment_reject character varying(255),
    created_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.history_leaves OWNER TO pehadirm;

--
-- Name: history_leaves_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE history_leaves_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.history_leaves_id_seq OWNER TO pehadirm;

--
-- Name: history_leaves_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE history_leaves_id_seq OWNED BY history_leaves.id;


--
-- Name: leave_approvals; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE leave_approvals (
    id bigint NOT NULL,
    leave_id integer NOT NULL,
    level integer NOT NULL,
    is_approver_company boolean NOT NULL,
    approver_id integer NOT NULL,
    status character varying(255) NOT NULL,
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT leave_approvals_status_check CHECK (((status)::text = ANY (ARRAY[('Approved'::character varying)::text, ('Pending'::character varying)::text, ('Rejected'::character varying)::text])))
);


ALTER TABLE public.leave_approvals OWNER TO pehadirm;

--
-- Name: leave_approvals_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE leave_approvals_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.leave_approvals_id_seq OWNER TO pehadirm;

--
-- Name: leave_approvals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE leave_approvals_id_seq OWNED BY leave_approvals.id;


--
-- Name: leave_types; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE leave_types (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    days integer NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.leave_types OWNER TO pehadirm;

--
-- Name: leave_types_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE leave_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.leave_types_id_seq OWNER TO pehadirm;

--
-- Name: leave_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE leave_types_id_seq OWNED BY leave_types.id;


--
-- Name: leaves; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE leaves (
    id bigint NOT NULL,
    employee_id integer,
    leave_type_id integer,
    applied_on date,
    start_date date,
    end_date date,
    total_leave_days character varying(255),
    leave_reason character varying(255),
    attachment_request_path character varying(255),
    remark character varying(255),
    status character varying(255),
    rejected_reason character varying(255),
    attachment_reject character varying(255),
    created_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.leaves OWNER TO pehadirm;

--
-- Name: leaves_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE leaves_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.leaves_id_seq OWNER TO pehadirm;

--
-- Name: leaves_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE leaves_id_seq OWNED BY leaves.id;


--
-- Name: level_approvals; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE level_approvals (
    id bigint NOT NULL,
    level integer NOT NULL,
    employee_id integer,
    company_id integer,
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.level_approvals OWNER TO pehadirm;

--
-- Name: level_approvals_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE level_approvals_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.level_approvals_id_seq OWNER TO pehadirm;

--
-- Name: level_approvals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE level_approvals_id_seq OWNED BY level_approvals.id;


--
-- Name: loan_options; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE loan_options (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.loan_options OWNER TO pehadirm;

--
-- Name: loan_options_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE loan_options_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.loan_options_id_seq OWNER TO pehadirm;

--
-- Name: loan_options_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE loan_options_id_seq OWNED BY loan_options.id;


--
-- Name: loans; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE loans (
    id bigint NOT NULL,
    employee_id integer NOT NULL,
    loan_type_id integer NOT NULL,
    installment integer NOT NULL,
    number_of_installment integer NOT NULL,
    status character varying(255) NOT NULL,
    amount integer NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT loans_status_check CHECK (((status)::text = ANY (ARRAY[('paid off'::character varying)::text, ('ongoing'::character varying)::text])))
);


ALTER TABLE public.loans OWNER TO pehadirm;

--
-- Name: loans_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE loans_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.loans_id_seq OWNER TO pehadirm;

--
-- Name: loans_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE loans_id_seq OWNED BY loans.id;


--
-- Name: log_attendances; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE log_attendances (
    id bigint NOT NULL,
    employee_id integer NOT NULL,
    date timestamp(0) without time zone NOT NULL,
    activity character varying(255) NOT NULL,
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.log_attendances OWNER TO pehadirm;

--
-- Name: log_attendances_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE log_attendances_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.log_attendances_id_seq OWNER TO pehadirm;

--
-- Name: log_attendances_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE log_attendances_id_seq OWNED BY log_attendances.id;


--
-- Name: log_employee_resumes; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE log_employee_resumes (
    id bigint NOT NULL,
    branch_id integer NOT NULL,
    date date NOT NULL,
    activity character varying(255) NOT NULL,
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.log_employee_resumes OWNER TO pehadirm;

--
-- Name: log_employee_resumes_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE log_employee_resumes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.log_employee_resumes_id_seq OWNER TO pehadirm;

--
-- Name: log_employee_resumes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE log_employee_resumes_id_seq OWNED BY log_employee_resumes.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO pehadirm;

--
-- Name: model_has_permissions; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE model_has_permissions (
    permission_id bigint NOT NULL,
    model_type character varying(255) NOT NULL,
    model_id bigint NOT NULL
);


ALTER TABLE public.model_has_permissions OWNER TO pehadirm;

--
-- Name: model_has_roles; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE model_has_roles (
    role_id bigint NOT NULL,
    model_type character varying(255) NOT NULL,
    model_id bigint NOT NULL
);


ALTER TABLE public.model_has_roles OWNER TO pehadirm;

--
-- Name: on_duty_approvals; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE on_duty_approvals (
    id bigint NOT NULL,
    travel_id integer NOT NULL,
    level integer NOT NULL,
    is_approver_company boolean NOT NULL,
    approver_id integer NOT NULL,
    status character varying(255) NOT NULL,
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT on_duty_approvals_status_check CHECK (((status)::text = ANY (ARRAY[('Approved'::character varying)::text, ('Pending'::character varying)::text, ('Rejected'::character varying)::text])))
);


ALTER TABLE public.on_duty_approvals OWNER TO pehadirm;

--
-- Name: on_duty_approvals_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE on_duty_approvals_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.on_duty_approvals_id_seq OWNER TO pehadirm;

--
-- Name: on_duty_approvals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE on_duty_approvals_id_seq OWNED BY on_duty_approvals.id;


--
-- Name: overtime_approvals; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE overtime_approvals (
    id bigint NOT NULL,
    overtime_id integer NOT NULL,
    level integer NOT NULL,
    is_approver_company boolean NOT NULL,
    approver_id integer NOT NULL,
    status character varying(255) NOT NULL,
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT overtime_approvals_status_check CHECK (((status)::text = ANY (ARRAY[('Approved'::character varying)::text, ('Pending'::character varying)::text, ('Rejected'::character varying)::text])))
);


ALTER TABLE public.overtime_approvals OWNER TO pehadirm;

--
-- Name: overtime_approvals_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE overtime_approvals_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.overtime_approvals_id_seq OWNER TO pehadirm;

--
-- Name: overtime_approvals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE overtime_approvals_id_seq OWNED BY overtime_approvals.id;


--
-- Name: overtime_types; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE overtime_types (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.overtime_types OWNER TO pehadirm;

--
-- Name: overtime_types_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE overtime_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.overtime_types_id_seq OWNER TO pehadirm;

--
-- Name: overtime_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE overtime_types_id_seq OWNED BY overtime_types.id;


--
-- Name: overtimes; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE overtimes (
    id bigint NOT NULL,
    employee_id integer,
    overtime_type_id integer,
    day_type_id integer,
    start_date date,
    end_date date,
    start_time character varying(255),
    end_time character varying(255),
    duration time(0) without time zone,
    amount_fee numeric(8,2),
    notes character varying(255),
    status character varying(255),
    rejected_reason character varying(255),
    attachment_reject character varying(255),
    created_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.overtimes OWNER TO pehadirm;

--
-- Name: overtimes_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE overtimes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.overtimes_id_seq OWNER TO pehadirm;

--
-- Name: overtimes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE overtimes_id_seq OWNED BY overtimes.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO pehadirm;

--
-- Name: pay_slips; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE pay_slips (
    id bigint NOT NULL,
    employee_id integer NOT NULL,
    pdf_filename character varying(255) NOT NULL,
    net_payble integer NOT NULL,
    salary_month character varying(255) NOT NULL,
    status integer NOT NULL,
    basic_salary text NOT NULL,
    salary integer NOT NULL,
    allowance text NOT NULL,
    reimburst text NOT NULL,
    cash_in_advance text NOT NULL,
    loan text NOT NULL,
    denda text NOT NULL,
    bpjs_kesehatan text,
    pph21 text,
    overtime text NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.pay_slips OWNER TO pehadirm;

--
-- Name: pay_slips_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE pay_slips_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pay_slips_id_seq OWNER TO pehadirm;

--
-- Name: pay_slips_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE pay_slips_id_seq OWNED BY pay_slips.id;


--
-- Name: payrolls; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE payrolls (
    id bigint NOT NULL,
    employee_id integer NOT NULL,
    payslip_type_id integer NOT NULL,
    amount integer NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.payrolls OWNER TO pehadirm;

--
-- Name: payrolls_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE payrolls_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.payrolls_id_seq OWNER TO pehadirm;

--
-- Name: payrolls_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE payrolls_id_seq OWNED BY payrolls.id;


--
-- Name: payslip_code_pins; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE payslip_code_pins (
    id bigint NOT NULL,
    employee_id integer,
    pin character varying(255) NOT NULL,
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.payslip_code_pins OWNER TO pehadirm;

--
-- Name: payslip_code_pins_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE payslip_code_pins_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.payslip_code_pins_id_seq OWNER TO pehadirm;

--
-- Name: payslip_code_pins_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE payslip_code_pins_id_seq OWNED BY payslip_code_pins.id;


--
-- Name: payslip_types; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE payslip_types (
    id bigint NOT NULL,
    name character varying(255),
    type character varying(255) NOT NULL,
    created_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT payslip_types_type_check CHECK (((type)::text = ANY (ARRAY[('monthly'::character varying)::text, ('daily'::character varying)::text])))
);


ALTER TABLE public.payslip_types OWNER TO pehadirm;

--
-- Name: payslip_types_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE payslip_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.payslip_types_id_seq OWNER TO pehadirm;

--
-- Name: payslip_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE payslip_types_id_seq OWNED BY payslip_types.id;


--
-- Name: performance_reviews; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE performance_reviews (
    id bigint NOT NULL,
    employee_id integer,
    knowledge integer,
    skill integer,
    accuracy integer,
    quality integer,
    care integer,
    reliability integer,
    working_method integer,
    flexibility integer,
    initiative integer,
    cooperation integer,
    attendance integer,
    organizational_commitment integer,
    kpi_total_score numeric(8,2),
    review_date date,
    created_by integer,
    notes character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.performance_reviews OWNER TO pehadirm;

--
-- Name: performance_reviews_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE performance_reviews_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.performance_reviews_id_seq OWNER TO pehadirm;

--
-- Name: performance_reviews_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE performance_reviews_id_seq OWNED BY performance_reviews.id;


--
-- Name: permissions; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE permissions (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    guard_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.permissions OWNER TO pehadirm;

--
-- Name: permissions_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE permissions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permissions_id_seq OWNER TO pehadirm;

--
-- Name: permissions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE permissions_id_seq OWNED BY permissions.id;


--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO pehadirm;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_access_tokens_id_seq OWNER TO pehadirm;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE personal_access_tokens_id_seq OWNED BY personal_access_tokens.id;


--
-- Name: project_users; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE project_users (
    id bigint NOT NULL,
    project_id integer NOT NULL,
    user_id integer NOT NULL,
    invited_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.project_users OWNER TO pehadirm;

--
-- Name: project_users_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE project_users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.project_users_id_seq OWNER TO pehadirm;

--
-- Name: project_users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE project_users_id_seq OWNED BY project_users.id;


--
-- Name: projects; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE projects (
    id bigint NOT NULL,
    project_name character varying(255) NOT NULL,
    start_date date,
    end_date date,
    project_image character varying(255),
    budget integer,
    estimated_hrs integer,
    client character varying(255) NOT NULL,
    description text,
    status character varying(255) NOT NULL,
    tags text,
    created_by bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.projects OWNER TO pehadirm;

--
-- Name: projects_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE projects_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.projects_id_seq OWNER TO pehadirm;

--
-- Name: projects_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE projects_id_seq OWNED BY projects.id;


--
-- Name: ptkp; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE ptkp (
    id bigint NOT NULL,
    status_name character varying(255),
    ptkp_amount integer DEFAULT 0 NOT NULL,
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.ptkp OWNER TO pehadirm;

--
-- Name: ptkp_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE ptkp_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ptkp_id_seq OWNER TO pehadirm;

--
-- Name: ptkp_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE ptkp_id_seq OWNED BY ptkp.id;


--
-- Name: reimburstment_options; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE reimburstment_options (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.reimburstment_options OWNER TO pehadirm;

--
-- Name: reimburstment_options_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE reimburstment_options_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reimburstment_options_id_seq OWNER TO pehadirm;

--
-- Name: reimburstment_options_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE reimburstment_options_id_seq OWNED BY reimburstment_options.id;


--
-- Name: reimbursts; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE reimbursts (
    id bigint NOT NULL,
    employee_id integer NOT NULL,
    reimburst_type_id integer NOT NULL,
    amount integer NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.reimbursts OWNER TO pehadirm;

--
-- Name: reimbursts_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE reimbursts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reimbursts_id_seq OWNER TO pehadirm;

--
-- Name: reimbursts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE reimbursts_id_seq OWNED BY reimbursts.id;


--
-- Name: req_shift_schedules; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE req_shift_schedules (
    id bigint NOT NULL,
    employee_id integer,
    remark character varying(255),
    requested_date date,
    status character varying(255),
    rejected_reason character varying(255),
    attachment_reject character varying(255),
    created_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.req_shift_schedules OWNER TO pehadirm;

--
-- Name: req_shift_schedules_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE req_shift_schedules_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_shift_schedules_id_seq OWNER TO pehadirm;

--
-- Name: req_shift_schedules_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE req_shift_schedules_id_seq OWNED BY req_shift_schedules.id;


--
-- Name: request_shift_schedule_approvals; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE request_shift_schedule_approvals (
    id bigint NOT NULL,
    req_shift_schedule_id integer NOT NULL,
    level integer NOT NULL,
    is_approver_company boolean NOT NULL,
    approver_id integer NOT NULL,
    status character varying(255) NOT NULL,
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT request_shift_schedule_approvals_status_check CHECK (((status)::text = ANY (ARRAY[('Approved'::character varying)::text, ('Pending'::character varying)::text, ('Rejected'::character varying)::text])))
);


ALTER TABLE public.request_shift_schedule_approvals OWNER TO pehadirm;

--
-- Name: request_shift_schedule_approvals_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE request_shift_schedule_approvals_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.request_shift_schedule_approvals_id_seq OWNER TO pehadirm;

--
-- Name: request_shift_schedule_approvals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE request_shift_schedule_approvals_id_seq OWNED BY request_shift_schedule_approvals.id;


--
-- Name: role_has_permissions; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE role_has_permissions (
    permission_id bigint NOT NULL,
    role_id bigint NOT NULL
);


ALTER TABLE public.role_has_permissions OWNER TO pehadirm;

--
-- Name: roles; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE roles (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    guard_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    created_by integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.roles OWNER TO pehadirm;

--
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roles_id_seq OWNER TO pehadirm;

--
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE roles_id_seq OWNED BY roles.id;


--
-- Name: set_bpjstk; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE set_bpjstk (
    id bigint NOT NULL,
    employee_id integer NOT NULL,
    bpjstk_name character varying(255) NOT NULL,
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.set_bpjstk OWNER TO pehadirm;

--
-- Name: set_bpjstk_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE set_bpjstk_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.set_bpjstk_id_seq OWNER TO pehadirm;

--
-- Name: set_bpjstk_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE set_bpjstk_id_seq OWNED BY set_bpjstk.id;


--
-- Name: set_ptkp; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE set_ptkp (
    id bigint NOT NULL,
    employee_id integer NOT NULL,
    ptkp_name character varying(255) NOT NULL,
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.set_ptkp OWNER TO pehadirm;

--
-- Name: set_ptkp_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE set_ptkp_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.set_ptkp_id_seq OWNER TO pehadirm;

--
-- Name: set_ptkp_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE set_ptkp_id_seq OWNED BY set_ptkp.id;


--
-- Name: settings; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE settings (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    value character varying(255) NOT NULL,
    created_by integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.settings OWNER TO pehadirm;

--
-- Name: settings_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE settings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.settings_id_seq OWNER TO pehadirm;

--
-- Name: settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE settings_id_seq OWNED BY settings.id;


--
-- Name: shift_schedules; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE shift_schedules (
    id bigint NOT NULL,
    employee_id integer,
    req_shift_schedules_id integer,
    schedule_date date,
    shift_id integer,
    status character varying(255),
    is_dayoff boolean DEFAULT false NOT NULL,
    dayoff_type character varying(255),
    description character varying(255),
    is_active boolean DEFAULT true NOT NULL,
    created_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.shift_schedules OWNER TO pehadirm;

--
-- Name: shift_schedules_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE shift_schedules_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.shift_schedules_id_seq OWNER TO pehadirm;

--
-- Name: shift_schedules_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE shift_schedules_id_seq OWNED BY shift_schedules.id;


--
-- Name: shift_types; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE shift_types (
    id bigint NOT NULL,
    day_type_id integer,
    name character varying(255),
    start_time time(0) without time zone,
    end_time time(0) without time zone,
    is_wfh boolean,
    created_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.shift_types OWNER TO pehadirm;

--
-- Name: shift_types_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE shift_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.shift_types_id_seq OWNER TO pehadirm;

--
-- Name: shift_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE shift_types_id_seq OWNED BY shift_types.id;


--
-- Name: timesheet_approvals; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE timesheet_approvals (
    id bigint NOT NULL,
    timesheet_id integer NOT NULL,
    level integer NOT NULL,
    is_approver_company boolean NOT NULL,
    approver_id integer NOT NULL,
    status character varying(255) NOT NULL,
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT timesheet_approvals_status_check CHECK (((status)::text = ANY (ARRAY[('Approved'::character varying)::text, ('Pending'::character varying)::text, ('Rejected'::character varying)::text])))
);


ALTER TABLE public.timesheet_approvals OWNER TO pehadirm;

--
-- Name: timesheet_approvals_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE timesheet_approvals_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.timesheet_approvals_id_seq OWNER TO pehadirm;

--
-- Name: timesheet_approvals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE timesheet_approvals_id_seq OWNED BY timesheet_approvals.id;


--
-- Name: timesheets; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE timesheets (
    id bigint NOT NULL,
    employee_id integer,
    project_stage character varying(255),
    start_date date,
    end_date date,
    start_time time(0) without time zone,
    end_time time(0) without time zone,
    duration time(0) without time zone,
    task_or_project character varying(255),
    activity character varying(255),
    client_company character varying(255),
    label_project character varying(255),
    file_attachment character varying(255),
    remark character varying(255),
    support character varying(255),
    status character varying(255),
    rejected_reason character varying(255),
    attachment_reject character varying(255),
    created_by integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.timesheets OWNER TO pehadirm;

--
-- Name: timesheets_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE timesheets_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.timesheets_id_seq OWNER TO pehadirm;

--
-- Name: timesheets_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE timesheets_id_seq OWNED BY timesheets.id;


--
-- Name: travel; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE travel (
    id bigint NOT NULL,
    employee_id integer,
    start_date date,
    end_date date,
    purpose_of_visit character varying(255),
    place_of_visit character varying(255),
    description character varying(255),
    status character varying(255),
    rejected_reason character varying(255),
    attachment_reject character varying(255),
    created_by character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.travel OWNER TO pehadirm;

--
-- Name: travel_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE travel_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.travel_id_seq OWNER TO pehadirm;

--
-- Name: travel_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE travel_id_seq OWNED BY travel.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE TABLE users (
    id bigint NOT NULL,
    name character varying(255),
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255),
    plan integer,
    plan_expire_date date,
    type character varying(20),
    avatar character varying(100),
    lang character varying(100),
    created_by integer DEFAULT 0 NOT NULL,
    default_pipeline integer,
    delete_status integer DEFAULT 1 NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    last_login_at timestamp(0) without time zone,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO pehadirm;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: pehadirm
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO pehadirm;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pehadirm
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: v_all_active_staf; Type: VIEW; Schema: public; Owner: pehadirm
--

CREATE VIEW v_all_active_staf AS
    SELECT b.branch_id, a.employee_id, to_char((a.date)::timestamp with time zone, 'mm'::text) AS bulan FROM (attendance_employees a LEFT JOIN employees b ON ((b.id = a.employee_id))) WHERE (((to_char((a.date)::timestamp with time zone, 'YYYY'::text) = to_char(((now())::date)::timestamp with time zone, 'YYYY'::text)) AND (b.is_active = true)) AND ((b.status)::text = 'active'::text)) GROUP BY a.employee_id, to_char((a.date)::timestamp with time zone, 'mm'::text), b.branch_id ORDER BY a.employee_id;


ALTER TABLE public.v_all_active_staf OWNER TO pehadirm;

--
-- Name: v_all_attendance; Type: VIEW; Schema: public; Owner: pehadirm
--

CREATE VIEW v_all_attendance AS
    SELECT b.employee_id, b.name, d.start_time AS jam_masuk, d.end_time AS jam_pulang, a.date, a.clock_in AS scan_masuk, a.clock_out AS scan_pulang, a.late AS terlambat, a.early_leaving AS pulang_cepat, a.overtime AS lembur, ((d.end_time - d.start_time) - '01:00:00'::interval) AS jam_kerja, (a.clock_out - d.start_time) AS jml_hadir FROM (((attendance_employees a LEFT JOIN employees b ON ((a.employee_id = b.id))) LEFT JOIN shift_schedules c ON (((c.employee_id = b.id) AND (c.schedule_date = a.date)))) LEFT JOIN shift_types d ON ((d.id = c.shift_id))) WHERE ((b.is_active = true) AND ((b.status)::text = 'active'::text));


ALTER TABLE public.v_all_attendance OWNER TO pehadirm;

--
-- Name: v_all_service_branch; Type: VIEW; Schema: public; Owner: pehadirm
--

CREATE VIEW v_all_service_branch AS
    SELECT employees.branch_id, (date_part('year'::text, now()) - date_part('year'::text, employees.created_at)) AS service FROM employees WHERE ((employees.is_active = true) AND ((employees.status)::text = 'active'::text));


ALTER TABLE public.v_all_service_branch OWNER TO pehadirm;

--
-- Name: v_employee_active_staff; Type: VIEW; Schema: public; Owner: pehadirm
--

CREATE VIEW v_employee_active_staff AS
    SELECT v_all_active_staf.branch_id, count(v_all_active_staf.employee_id) AS subtotal, v_all_active_staf.bulan, CASE WHEN (v_all_active_staf.bulan = '01'::text) THEN 'Jan'::text WHEN (v_all_active_staf.bulan = '02'::text) THEN 'Feb'::text WHEN (v_all_active_staf.bulan = '03'::text) THEN 'Mar'::text WHEN (v_all_active_staf.bulan = '04'::text) THEN 'Apr'::text WHEN (v_all_active_staf.bulan = '05'::text) THEN 'Mey'::text WHEN (v_all_active_staf.bulan = '06'::text) THEN 'Jun'::text WHEN (v_all_active_staf.bulan = '07'::text) THEN 'Jul'::text WHEN (v_all_active_staf.bulan = '08'::text) THEN 'Aug'::text WHEN (v_all_active_staf.bulan = '09'::text) THEN 'Sep'::text WHEN (v_all_active_staf.bulan = '10'::text) THEN 'Okt'::text WHEN (v_all_active_staf.bulan = '11'::text) THEN 'nov'::text ELSE 'Des'::text END AS bulan_des FROM v_all_active_staf GROUP BY v_all_active_staf.branch_id, v_all_active_staf.bulan ORDER BY v_all_active_staf.bulan;


ALTER TABLE public.v_employee_active_staff OWNER TO pehadirm;

--
-- Name: v_employee_age_average; Type: VIEW; Schema: public; Owner: pehadirm
--

CREATE VIEW v_employee_age_average AS
    SELECT ((((SELECT count(employees_1.dob) AS count FROM employees employees_1 WHERE (((((date_part('year'::text, date(now())) - date_part('year'::text, employees_1.dob)) <= (18)::double precision) AND (employees_1.is_active = true)) AND ((employees_1.status)::text = 'active'::text)) AND (employees_1.branch_id = a.branch_id))) / count(a.employee_id)))::double precision * (100)::double precision) AS range_18, ((((SELECT count(employees_1.dob) AS count FROM employees employees_1 WHERE ((((((date_part('year'::text, date(now())) - date_part('year'::text, employees_1.dob)) >= (20)::double precision) AND ((date_part('year'::text, date(now())) - date_part('year'::text, employees_1.dob)) <= (30)::double precision)) AND (employees_1.is_active = true)) AND ((employees_1.status)::text = 'active'::text)) AND (employees_1.branch_id = a.branch_id))) / count(a.employee_id)))::double precision * (100)::double precision) AS range_20_30, ((((SELECT count(employees_1.dob) AS count FROM employees employees_1 WHERE ((((((date_part('year'::text, date(now())) - date_part('year'::text, employees_1.dob)) >= (31)::double precision) AND ((date_part('year'::text, date(now())) - date_part('year'::text, employees_1.dob)) <= (40)::double precision)) AND (employees_1.is_active = true)) AND ((employees_1.status)::text = 'active'::text)) AND (employees_1.branch_id = a.branch_id))) / count(a.employee_id)))::double precision * (100)::double precision) AS range_31_40, ((((SELECT count(employees_1.dob) AS count FROM employees employees_1 WHERE ((((((date_part('year'::text, date(now())) - date_part('year'::text, employees_1.dob)) >= (41)::double precision) AND ((date_part('year'::text, date(now())) - date_part('year'::text, employees_1.dob)) <= (50)::double precision)) AND (employees_1.is_active = true)) AND ((employees_1.status)::text = 'active'::text)) AND (employees_1.branch_id = a.branch_id))) / count(a.employee_id)))::double precision * (100)::double precision) AS range_41_50, a.branch_id FROM employees a WHERE ((a.is_active = true) AND ((a.status)::text = 'active'::text)) GROUP BY a.branch_id;


ALTER TABLE public.v_employee_age_average OWNER TO pehadirm;

--
-- Name: v_employee_education; Type: VIEW; Schema: public; Owner: pehadirm
--

CREATE VIEW v_employee_education AS
    SELECT a.branch_id, (SELECT employee_education.level FROM employee_education WHERE (employee_education.employee_id = a.id) ORDER BY employee_education.id DESC LIMIT 1) AS level, count(a.employee_id) AS count FROM employees a WHERE ((a.is_active = true) AND ((a.status)::text = 'active'::text)) GROUP BY a.branch_id, a.id;


ALTER TABLE public.v_employee_education OWNER TO pehadirm;

--
-- Name: v_employee_gender; Type: VIEW; Schema: public; Owner: pehadirm
--

CREATE VIEW v_employee_gender AS
    SELECT employees.gender AS label, count(employees.gender) AS value FROM employees GROUP BY employees.gender;


ALTER TABLE public.v_employee_gender OWNER TO pehadirm;

--
-- Name: v_employee_joblevel; Type: VIEW; Schema: public; Owner: pehadirm
--

CREATE VIEW v_employee_joblevel AS
    SELECT b.job_level, (((count(b.employee_id))::double precision / ((SELECT count(employees.employee_id) AS count FROM employees WHERE (((employees.is_active = true) AND ((employees.status)::text = 'active'::text)) AND (employees.branch_id = a.branch_id))))::double precision) * (100)::double precision) AS subtotal, a.branch_id FROM (employees a LEFT JOIN employements b ON ((a.id = b.employee_id))) WHERE ((a.is_active = true) AND ((a.status)::text = 'active'::text)) GROUP BY b.job_level, a.branch_id;


ALTER TABLE public.v_employee_joblevel OWNER TO pehadirm;

--
-- Name: v_employee_religion; Type: VIEW; Schema: public; Owner: pehadirm
--

CREATE VIEW v_employee_religion AS
    SELECT ((((SELECT count(employees.religion) AS count FROM employees WHERE ((((employees.is_active = true) AND ((employees.status)::text = 'active'::text)) AND (employees.branch_id = a.branch_id)) AND ((employees.religion)::text = 'ISLAM'::text))) / (SELECT count(employees.employee_id) AS count FROM employees WHERE (((employees.is_active = true) AND ((employees.status)::text = 'active'::text)) AND (employees.branch_id = a.branch_id)))))::double precision * (100)::double precision) AS islam, ((((SELECT count(employees.religion) AS count FROM employees WHERE ((((employees.is_active = true) AND ((employees.status)::text = 'active'::text)) AND (employees.branch_id = a.branch_id)) AND ((employees.religion)::text = 'KATHOLIK'::text))) / (SELECT count(employees.employee_id) AS count FROM employees WHERE (((employees.is_active = true) AND ((employees.status)::text = 'active'::text)) AND (employees.branch_id = a.branch_id)))))::double precision * (100)::double precision) AS katholik, ((((SELECT count(employees.religion) AS count FROM employees WHERE ((((employees.is_active = true) AND ((employees.status)::text = 'active'::text)) AND (employees.branch_id = a.branch_id)) AND ((employees.religion)::text = 'KRISTEN'::text))) / (SELECT count(employees.employee_id) AS count FROM employees WHERE (((employees.is_active = true) AND ((employees.status)::text = 'active'::text)) AND (employees.branch_id = a.branch_id)))))::double precision * (100)::double precision) AS kristen, ((((SELECT count(employees.religion) AS count FROM employees WHERE ((((employees.is_active = true) AND ((employees.status)::text = 'active'::text)) AND (employees.branch_id = a.branch_id)) AND ((employees.religion)::text = 'HINDU'::text))) / (SELECT count(employees.employee_id) AS count FROM employees WHERE (((employees.is_active = true) AND ((employees.status)::text = 'active'::text)) AND (employees.branch_id = a.branch_id)))))::double precision * (100)::double precision) AS hindu, ((((SELECT count(employees.religion) AS count FROM employees WHERE ((((employees.is_active = true) AND ((employees.status)::text = 'active'::text)) AND (employees.branch_id = a.branch_id)) AND ((employees.religion)::text = 'BUDHA'::text))) / (SELECT count(employees.employee_id) AS count FROM employees WHERE (((employees.is_active = true) AND ((employees.status)::text = 'active'::text)) AND (employees.branch_id = a.branch_id)))))::double precision * (100)::double precision) AS budha, ((((SELECT count(employees.religion) AS count FROM employees WHERE ((((employees.is_active = true) AND ((employees.status)::text = 'active'::text)) AND (employees.branch_id = a.branch_id)) AND ((employees.religion)::text = 'LAIN'::text))) / (SELECT count(employees.employee_id) AS count FROM employees WHERE (((employees.is_active = true) AND ((employees.status)::text = 'active'::text)) AND (employees.branch_id = a.branch_id)))))::double precision * (100)::double precision) AS lain, a.branch_id FROM employees a GROUP BY a.branch_id;


ALTER TABLE public.v_employee_religion OWNER TO pehadirm;

--
-- Name: v_employee_status; Type: VIEW; Schema: public; Owner: pehadirm
--

CREATE VIEW v_employee_status AS
    SELECT (SELECT count(employees_1.user_id) AS count FROM employees employees_1 WHERE (((((employees_1.employee_type)::text = 'jobholder'::text) AND (employees_1.is_active = true)) AND ((employees_1.status)::text = 'active'::text)) AND (employees_1.branch_id = employees.branch_id))) AS jobholders, (SELECT count(employees_1.user_id) AS count FROM employees employees_1 WHERE (((((employees_1.employee_type)::text = ANY (ARRAY[('outsourcing'::character varying)::text, ('parttime'::character varying)::text])) AND (employees_1.is_active = true)) AND ((employees_1.status)::text = 'active'::text)) AND (employees_1.branch_id = employees.branch_id))) AS contract, (SELECT count(employees_1.user_id) AS count FROM employees employees_1 WHERE (((((employees_1.employee_type)::text = 'freelancers'::text) AND (employees_1.is_active = true)) AND ((employees_1.status)::text = 'active'::text)) AND (employees_1.branch_id = employees.branch_id))) AS freelance, employees.branch_id FROM employees GROUP BY employees.branch_id;


ALTER TABLE public.v_employee_status OWNER TO pehadirm;

--
-- Name: v_lenght_of_service; Type: VIEW; Schema: public; Owner: pehadirm
--

CREATE VIEW v_lenght_of_service AS
    SELECT v_all_service_branch.branch_id, v_all_service_branch.service, count(v_all_service_branch.service) AS subtotal FROM v_all_service_branch GROUP BY v_all_service_branch.branch_id, v_all_service_branch.service;


ALTER TABLE public.v_lenght_of_service OWNER TO pehadirm;

--
-- Name: v_monthly_resign; Type: VIEW; Schema: public; Owner: pehadirm
--

CREATE VIEW v_monthly_resign AS
    SELECT employees.branch_id, CASE WHEN (to_char(((employees.company_doe)::date)::timestamp with time zone, 'mm'::text) = '1'::text) THEN 'jan'::text WHEN (to_char(((employees.company_doe)::date)::timestamp with time zone, 'mm'::text) = '2'::text) THEN 'feb'::text WHEN (to_char(((employees.company_doe)::date)::timestamp with time zone, 'mm'::text) = '3'::text) THEN 'mar'::text WHEN (to_char(((employees.company_doe)::date)::timestamp with time zone, 'mm'::text) = '4'::text) THEN 'apr'::text WHEN (to_char(((employees.company_doe)::date)::timestamp with time zone, 'mm'::text) = '5'::text) THEN 'may'::text WHEN (to_char(((employees.company_doe)::date)::timestamp with time zone, 'mm'::text) = '6'::text) THEN 'jun'::text WHEN (to_char(((employees.company_doe)::date)::timestamp with time zone, 'mm'::text) = '7'::text) THEN 'jul'::text WHEN (to_char(((employees.company_doe)::date)::timestamp with time zone, 'mm'::text) = '8'::text) THEN 'aug'::text WHEN (to_char(((employees.company_doe)::date)::timestamp with time zone, 'mm'::text) = '9'::text) THEN 'sep'::text WHEN (to_char(((employees.company_doe)::date)::timestamp with time zone, 'mm'::text) = '10'::text) THEN 'okt'::text WHEN (to_char(((employees.company_doe)::date)::timestamp with time zone, 'mm'::text) = '11'::text) THEN 'nov'::text ELSE 'des'::text END AS bulan, count(employees.company_doe) AS resign FROM employees WHERE (((to_char(((employees.company_doe)::date)::timestamp with time zone, 'YYYY'::text) = to_char(((now())::date)::timestamp with time zone, 'YYYY'::text)) AND (employees.is_active = true)) AND ((employees.status)::text = 'active'::text)) GROUP BY employees.branch_id, to_char(((employees.company_doe)::date)::timestamp with time zone, 'mm'::text);


ALTER TABLE public.v_monthly_resign OWNER TO pehadirm;

--
-- Name: v_monthly_trunover; Type: VIEW; Schema: public; Owner: pehadirm
--

CREATE VIEW v_monthly_trunover AS
    SELECT v_monthly_resign.branch_id, v_monthly_resign.bulan, v_monthly_resign.resign, round((((v_monthly_resign.resign)::double precision / ((SELECT count(employees.employee_id) AS count FROM employees))::double precision) * (100)::double precision)) AS turnover FROM v_monthly_resign ORDER BY v_monthly_resign.bulan;


ALTER TABLE public.v_monthly_trunover OWNER TO pehadirm;

--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY all_requests ALTER COLUMN id SET DEFAULT nextval('all_requests_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY allowance_finances ALTER COLUMN id SET DEFAULT nextval('allowance_finances_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY allowance_options ALTER COLUMN id SET DEFAULT nextval('allowance_options_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY allowances ALTER COLUMN id SET DEFAULT nextval('allowances_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY attendance_employees ALTER COLUMN id SET DEFAULT nextval('attendance_employees_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY branches ALTER COLUMN id SET DEFAULT nextval('branches_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY break_times ALTER COLUMN id SET DEFAULT nextval('break_times_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY cashes ALTER COLUMN id SET DEFAULT nextval('cashes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY checklist_attendance_summaries ALTER COLUMN id SET DEFAULT nextval('checklist_attendance_summaries_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY company_holidays ALTER COLUMN id SET DEFAULT nextval('company_holidays_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY day_types ALTER COLUMN id SET DEFAULT nextval('day_types_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY dayoffs ALTER COLUMN id SET DEFAULT nextval('dayoffs_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY dendas ALTER COLUMN id SET DEFAULT nextval('dendas_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY documents ALTER COLUMN id SET DEFAULT nextval('documents_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY employee_documents ALTER COLUMN id SET DEFAULT nextval('employee_documents_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY employee_education ALTER COLUMN id SET DEFAULT nextval('employee_education_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY employee_experiences ALTER COLUMN id SET DEFAULT nextval('employee_experiences_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY employee_medicals ALTER COLUMN id SET DEFAULT nextval('employee_medicals_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY employees ALTER COLUMN id SET DEFAULT nextval('employees_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY employements ALTER COLUMN id SET DEFAULT nextval('employements_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY failed_jobs ALTER COLUMN id SET DEFAULT nextval('failed_jobs_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY families ALTER COLUMN id SET DEFAULT nextval('families_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY history_leaves ALTER COLUMN id SET DEFAULT nextval('history_leaves_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY leave_approvals ALTER COLUMN id SET DEFAULT nextval('leave_approvals_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY leave_types ALTER COLUMN id SET DEFAULT nextval('leave_types_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY leaves ALTER COLUMN id SET DEFAULT nextval('leaves_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY level_approvals ALTER COLUMN id SET DEFAULT nextval('level_approvals_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY loan_options ALTER COLUMN id SET DEFAULT nextval('loan_options_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY loans ALTER COLUMN id SET DEFAULT nextval('loans_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY log_attendances ALTER COLUMN id SET DEFAULT nextval('log_attendances_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY log_employee_resumes ALTER COLUMN id SET DEFAULT nextval('log_employee_resumes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY on_duty_approvals ALTER COLUMN id SET DEFAULT nextval('on_duty_approvals_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY overtime_approvals ALTER COLUMN id SET DEFAULT nextval('overtime_approvals_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY overtime_types ALTER COLUMN id SET DEFAULT nextval('overtime_types_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY overtimes ALTER COLUMN id SET DEFAULT nextval('overtimes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY pay_slips ALTER COLUMN id SET DEFAULT nextval('pay_slips_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY payrolls ALTER COLUMN id SET DEFAULT nextval('payrolls_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY payslip_code_pins ALTER COLUMN id SET DEFAULT nextval('payslip_code_pins_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY payslip_types ALTER COLUMN id SET DEFAULT nextval('payslip_types_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY performance_reviews ALTER COLUMN id SET DEFAULT nextval('performance_reviews_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY permissions ALTER COLUMN id SET DEFAULT nextval('permissions_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('personal_access_tokens_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY project_users ALTER COLUMN id SET DEFAULT nextval('project_users_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY projects ALTER COLUMN id SET DEFAULT nextval('projects_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY ptkp ALTER COLUMN id SET DEFAULT nextval('ptkp_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY reimburstment_options ALTER COLUMN id SET DEFAULT nextval('reimburstment_options_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY reimbursts ALTER COLUMN id SET DEFAULT nextval('reimbursts_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY req_shift_schedules ALTER COLUMN id SET DEFAULT nextval('req_shift_schedules_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY request_shift_schedule_approvals ALTER COLUMN id SET DEFAULT nextval('request_shift_schedule_approvals_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY roles ALTER COLUMN id SET DEFAULT nextval('roles_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY set_bpjstk ALTER COLUMN id SET DEFAULT nextval('set_bpjstk_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY set_ptkp ALTER COLUMN id SET DEFAULT nextval('set_ptkp_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY settings ALTER COLUMN id SET DEFAULT nextval('settings_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY shift_schedules ALTER COLUMN id SET DEFAULT nextval('shift_schedules_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY shift_types ALTER COLUMN id SET DEFAULT nextval('shift_types_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY timesheet_approvals ALTER COLUMN id SET DEFAULT nextval('timesheet_approvals_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY timesheets ALTER COLUMN id SET DEFAULT nextval('timesheets_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY travel ALTER COLUMN id SET DEFAULT nextval('travel_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Data for Name: all_requests; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: all_requests_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('all_requests_id_seq', 1, false);


--
-- Data for Name: allowance_finances; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO allowance_finances VALUES (1, 3, 1, 1500000, 2, '2023-07-02 18:15:02', '2023-07-02 18:15:02');
INSERT INTO allowance_finances VALUES (2, 3, 2, 1000000, 2, '2023-07-02 18:15:29', '2023-07-02 18:15:29');
INSERT INTO allowance_finances VALUES (3, 3, 3, 500000, 2, '2023-07-02 18:15:51', '2023-07-02 18:15:51');
INSERT INTO allowance_finances VALUES (4, 3, 4, 2000000, 2, '2023-07-02 18:16:11', '2023-07-02 18:16:11');
INSERT INTO allowance_finances VALUES (5, 2, 1, 10000000, 2, '2023-07-02 18:38:18', '2023-07-02 18:38:18');
INSERT INTO allowance_finances VALUES (6, 2, 2, 500000, 2, '2023-07-02 18:38:32', '2023-07-02 18:38:32');
INSERT INTO allowance_finances VALUES (7, 1, 3, 500000, 2, '2023-07-02 18:38:47', '2023-07-02 18:38:47');
INSERT INTO allowance_finances VALUES (8, 1, 4, 1000000, 2, '2023-07-02 18:38:59', '2023-07-02 18:38:59');
INSERT INTO allowance_finances VALUES (9, 5, 1, 500000, 2, '2023-07-02 19:49:00', '2023-07-02 19:49:00');
INSERT INTO allowance_finances VALUES (10, 5, 2, 300000, 2, '2023-07-02 19:49:17', '2023-07-02 19:49:17');
INSERT INTO allowance_finances VALUES (12, 4, 1, 100000, 2, NULL, NULL);
INSERT INTO allowance_finances VALUES (13, 4, 2, 300000, 2, NULL, NULL);
INSERT INTO allowance_finances VALUES (14, 4, 3, 200000, 2, NULL, NULL);
INSERT INTO allowance_finances VALUES (15, 4, 4, 100000, 2, NULL, '2023-07-08 02:16:11');


--
-- Name: allowance_finances_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('allowance_finances_id_seq', 15, true);


--
-- Data for Name: allowance_options; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO allowance_options VALUES (1, 'TUNJANGAN JABATAN', 2, '2023-07-02 18:12:32', '2023-07-02 18:12:32');
INSERT INTO allowance_options VALUES (2, 'TUNJANGAN TRANSPORT', 2, '2023-07-02 18:13:33', '2023-07-02 18:13:33');
INSERT INTO allowance_options VALUES (3, 'TUNJANGAN KOMUNIKASI', 2, '2023-07-02 18:13:49', '2023-07-02 18:13:49');
INSERT INTO allowance_options VALUES (4, 'TUNJANGAN LAIN-LAIN', 2, '2023-07-02 18:13:58', '2023-07-02 18:13:58');


--
-- Name: allowance_options_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('allowance_options_id_seq', 4, true);


--
-- Data for Name: allowances; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: allowances_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('allowances_id_seq', 1, false);


--
-- Data for Name: attendance_employees; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO attendance_employees VALUES (1, 2, '2023-04-11', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-11 18:00:06', '2023-04-11 18:00:06');
INSERT INTO attendance_employees VALUES (2, 1, '2023-04-11', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-11 18:00:06', '2023-04-11 18:00:06');
INSERT INTO attendance_employees VALUES (3, 2, '2023-04-12', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-12 18:00:09', '2023-04-12 18:00:09');
INSERT INTO attendance_employees VALUES (4, 1, '2023-04-12', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-12 18:00:09', '2023-04-12 18:00:09');
INSERT INTO attendance_employees VALUES (5, 2, '2023-01-21', 'Present', NULL, '07:23:00', '17:08:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (6, 2, '2023-01-23', 'Present', NULL, '07:11:00', '19:14:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '02:14:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (7, 2, '2023-01-24', 'Present', NULL, '07:29:00', '18:13:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '01:13:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (8, 2, '2023-01-25', 'Present', NULL, '07:17:00', '17:21:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (9, 2, '2023-01-26', 'Present', NULL, '07:20:00', '17:19:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (10, 2, '2023-01-27', 'Present', NULL, '07:28:00', '21:06:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '04:06:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (11, 2, '2023-01-28', 'Present', NULL, '07:27:00', '17:03:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (12, 2, '2023-01-30', 'Present', NULL, '07:18:00', '18:18:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '01:18:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (13, 2, '2023-02-06', 'Present', NULL, '07:16:00', '21:06:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '04:06:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (14, 2, '2023-02-07', 'Present', NULL, '07:24:00', '21:04:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '04:04:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (15, 2, '2023-02-08', 'Present', NULL, '07:20:00', '21:02:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '04:02:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (16, 2, '2023-02-09', 'Present', NULL, '07:12:00', '20:11:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '03:11:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (17, 2, '2023-02-10', 'Present', NULL, '07:18:00', '21:04:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '04:04:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (18, 2, '2023-02-11', 'Present', NULL, '07:23:00', '17:05:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (19, 2, '2023-02-13', 'Present', NULL, '07:20:00', '20:17:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '03:17:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (20, 2, '2023-02-14', 'Present', NULL, '07:13:00', '17:10:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (21, 2, '2023-02-15', 'Present', NULL, '07:14:00', '21:08:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '04:08:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (22, 2, '2023-02-16', 'Present', NULL, '07:18:00', '21:13:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '04:13:00', '00:00:00', 2, '2023-04-12 20:50:58', '2023-04-12 20:50:58');
INSERT INTO attendance_employees VALUES (23, 2, '2023-03-21', 'Present', NULL, '07:23:00', '17:08:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-12 21:02:10', '2023-04-12 21:02:10');
INSERT INTO attendance_employees VALUES (24, 2, '2023-03-23', 'Present', NULL, '07:11:00', '19:14:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '02:14:00', '00:00:00', 2, '2023-04-12 21:02:10', '2023-04-12 21:02:10');
INSERT INTO attendance_employees VALUES (25, 2, '2023-03-24', 'Present', NULL, '07:29:00', '18:13:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '01:13:00', '00:00:00', 2, '2023-04-12 21:02:10', '2023-04-12 21:02:10');
INSERT INTO attendance_employees VALUES (26, 2, '2023-03-25', 'Present', NULL, '07:17:00', '17:21:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-12 21:02:10', '2023-04-12 21:02:10');
INSERT INTO attendance_employees VALUES (27, 2, '2023-03-26', 'Present', NULL, '07:20:00', '17:19:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-12 21:02:10', '2023-04-12 21:02:10');
INSERT INTO attendance_employees VALUES (28, 2, '2023-03-27', 'Present', NULL, '07:28:00', '21:06:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '04:06:00', '00:00:00', 2, '2023-04-12 21:02:10', '2023-04-12 21:02:10');
INSERT INTO attendance_employees VALUES (29, 2, '2023-03-28', 'Present', NULL, '07:27:00', '17:03:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-12 21:02:10', '2023-04-12 21:02:10');
INSERT INTO attendance_employees VALUES (30, 2, '2023-03-29', 'Present', NULL, '07:18:00', '18:18:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '01:18:00', '00:00:00', 2, '2023-04-12 21:02:10', '2023-04-12 21:02:10');
INSERT INTO attendance_employees VALUES (31, 3, '2023-04-13', 'Present', NULL, '07:57:48', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-13 07:57:48', '2023-04-13 07:57:48');
INSERT INTO attendance_employees VALUES (32, 2, '2023-04-13', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-13 18:00:07', '2023-04-13 18:00:07');
INSERT INTO attendance_employees VALUES (33, 1, '2023-04-13', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-13 18:00:07', '2023-04-13 18:00:07');
INSERT INTO attendance_employees VALUES (34, 2, '2023-04-14', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-14 18:00:05', '2023-04-14 18:00:05');
INSERT INTO attendance_employees VALUES (35, 1, '2023-04-14', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-14 18:00:05', '2023-04-14 18:00:05');
INSERT INTO attendance_employees VALUES (36, 3, '2023-04-14', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-14 18:00:05', '2023-04-14 18:00:05');
INSERT INTO attendance_employees VALUES (37, 2, '2023-04-15', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-15 18:00:06', '2023-04-15 18:00:06');
INSERT INTO attendance_employees VALUES (38, 1, '2023-04-15', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-15 18:00:06', '2023-04-15 18:00:06');
INSERT INTO attendance_employees VALUES (39, 3, '2023-04-15', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-15 18:00:06', '2023-04-15 18:00:06');
INSERT INTO attendance_employees VALUES (40, 2, '2023-04-16', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-16 18:00:05', '2023-04-16 18:00:05');
INSERT INTO attendance_employees VALUES (41, 1, '2023-04-16', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-16 18:00:05', '2023-04-16 18:00:05');
INSERT INTO attendance_employees VALUES (42, 3, '2023-04-16', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-16 18:00:05', '2023-04-16 18:00:05');
INSERT INTO attendance_employees VALUES (43, 2, '2023-04-17', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-17 18:00:07', '2023-04-17 18:00:07');
INSERT INTO attendance_employees VALUES (44, 1, '2023-04-17', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-17 18:00:07', '2023-04-17 18:00:07');
INSERT INTO attendance_employees VALUES (45, 3, '2023-04-17', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-17 18:00:07', '2023-04-17 18:00:07');
INSERT INTO attendance_employees VALUES (46, 2, '2023-04-18', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-18 18:00:06', '2023-04-18 18:00:06');
INSERT INTO attendance_employees VALUES (47, 1, '2023-04-18', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-18 18:00:06', '2023-04-18 18:00:06');
INSERT INTO attendance_employees VALUES (48, 3, '2023-04-18', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-18 18:00:06', '2023-04-18 18:00:06');
INSERT INTO attendance_employees VALUES (49, 2, '2023-04-19', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-19 18:00:06', '2023-04-19 18:00:06');
INSERT INTO attendance_employees VALUES (50, 1, '2023-04-19', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-19 18:00:06', '2023-04-19 18:00:06');
INSERT INTO attendance_employees VALUES (51, 3, '2023-04-19', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-19 18:00:06', '2023-04-19 18:00:06');
INSERT INTO attendance_employees VALUES (52, 2, '2023-04-20', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-20 18:00:06', '2023-04-20 18:00:06');
INSERT INTO attendance_employees VALUES (53, 1, '2023-04-20', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-20 18:00:06', '2023-04-20 18:00:06');
INSERT INTO attendance_employees VALUES (54, 3, '2023-04-20', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-20 18:00:06', '2023-04-20 18:00:06');
INSERT INTO attendance_employees VALUES (55, 2, '2023-04-21', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-21 18:00:06', '2023-04-21 18:00:06');
INSERT INTO attendance_employees VALUES (56, 1, '2023-04-21', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-21 18:00:06', '2023-04-21 18:00:06');
INSERT INTO attendance_employees VALUES (57, 3, '2023-04-21', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-21 18:00:06', '2023-04-21 18:00:06');
INSERT INTO attendance_employees VALUES (58, 2, '2023-04-22', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-22 18:00:05', '2023-04-22 18:00:05');
INSERT INTO attendance_employees VALUES (59, 1, '2023-04-22', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-22 18:00:05', '2023-04-22 18:00:05');
INSERT INTO attendance_employees VALUES (60, 3, '2023-04-22', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-22 18:00:05', '2023-04-22 18:00:05');
INSERT INTO attendance_employees VALUES (61, 2, '2023-04-23', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-23 18:00:06', '2023-04-23 18:00:06');
INSERT INTO attendance_employees VALUES (62, 1, '2023-04-23', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-23 18:00:06', '2023-04-23 18:00:06');
INSERT INTO attendance_employees VALUES (63, 3, '2023-04-23', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-23 18:00:06', '2023-04-23 18:00:06');
INSERT INTO attendance_employees VALUES (64, 2, '2023-04-24', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-24 18:00:07', '2023-04-24 18:00:07');
INSERT INTO attendance_employees VALUES (65, 1, '2023-04-24', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-24 18:00:07', '2023-04-24 18:00:07');
INSERT INTO attendance_employees VALUES (66, 3, '2023-04-24', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-24 18:00:07', '2023-04-24 18:00:07');
INSERT INTO attendance_employees VALUES (67, 2, '2023-04-25', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-25 18:00:06', '2023-04-25 18:00:06');
INSERT INTO attendance_employees VALUES (68, 1, '2023-04-25', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-25 18:00:06', '2023-04-25 18:00:06');
INSERT INTO attendance_employees VALUES (69, 3, '2023-04-25', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-25 18:00:06', '2023-04-25 18:00:06');
INSERT INTO attendance_employees VALUES (70, 2, '2023-04-26', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-26 18:00:05', '2023-04-26 18:00:05');
INSERT INTO attendance_employees VALUES (71, 1, '2023-04-26', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-26 18:00:05', '2023-04-26 18:00:05');
INSERT INTO attendance_employees VALUES (72, 3, '2023-04-26', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-26 18:00:05', '2023-04-26 18:00:05');
INSERT INTO attendance_employees VALUES (73, 2, '2023-04-27', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-27 18:00:06', '2023-04-27 18:00:06');
INSERT INTO attendance_employees VALUES (74, 1, '2023-04-27', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-27 18:00:06', '2023-04-27 18:00:06');
INSERT INTO attendance_employees VALUES (75, 3, '2023-04-27', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-27 18:00:06', '2023-04-27 18:00:06');
INSERT INTO attendance_employees VALUES (76, 2, '2023-04-28', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-28 18:00:06', '2023-04-28 18:00:06');
INSERT INTO attendance_employees VALUES (77, 1, '2023-04-28', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-28 18:00:06', '2023-04-28 18:00:06');
INSERT INTO attendance_employees VALUES (78, 3, '2023-04-28', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-28 18:00:06', '2023-04-28 18:00:06');
INSERT INTO attendance_employees VALUES (79, 2, '2023-04-29', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-29 18:00:07', '2023-04-29 18:00:07');
INSERT INTO attendance_employees VALUES (80, 1, '2023-04-29', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-29 18:00:07', '2023-04-29 18:00:07');
INSERT INTO attendance_employees VALUES (81, 3, '2023-04-29', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-29 18:00:07', '2023-04-29 18:00:07');
INSERT INTO attendance_employees VALUES (82, 2, '2023-04-30', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-30 18:00:06', '2023-04-30 18:00:06');
INSERT INTO attendance_employees VALUES (83, 1, '2023-04-30', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-30 18:00:06', '2023-04-30 18:00:06');
INSERT INTO attendance_employees VALUES (84, 3, '2023-04-30', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-04-30 18:00:06', '2023-04-30 18:00:06');
INSERT INTO attendance_employees VALUES (85, 2, '2023-05-01', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-01 18:00:16', '2023-05-01 18:00:16');
INSERT INTO attendance_employees VALUES (86, 1, '2023-05-01', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-01 18:00:16', '2023-05-01 18:00:16');
INSERT INTO attendance_employees VALUES (87, 3, '2023-05-01', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-01 18:00:16', '2023-05-01 18:00:16');
INSERT INTO attendance_employees VALUES (88, 2, '2023-05-02', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-02 18:00:06', '2023-05-02 18:00:06');
INSERT INTO attendance_employees VALUES (89, 1, '2023-05-02', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-02 18:00:06', '2023-05-02 18:00:06');
INSERT INTO attendance_employees VALUES (90, 3, '2023-05-02', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-02 18:00:06', '2023-05-02 18:00:06');
INSERT INTO attendance_employees VALUES (91, 2, '2023-05-03', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-03 18:00:09', '2023-05-03 18:00:09');
INSERT INTO attendance_employees VALUES (92, 1, '2023-05-03', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-03 18:00:09', '2023-05-03 18:00:09');
INSERT INTO attendance_employees VALUES (93, 3, '2023-05-03', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-03 18:00:09', '2023-05-03 18:00:09');
INSERT INTO attendance_employees VALUES (94, 2, '2023-05-04', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-04 18:00:05', '2023-05-04 18:00:05');
INSERT INTO attendance_employees VALUES (95, 1, '2023-05-04', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-04 18:00:05', '2023-05-04 18:00:05');
INSERT INTO attendance_employees VALUES (96, 3, '2023-05-04', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-04 18:00:05', '2023-05-04 18:00:05');
INSERT INTO attendance_employees VALUES (97, 2, '2023-05-05', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-05 18:00:06', '2023-05-05 18:00:06');
INSERT INTO attendance_employees VALUES (98, 1, '2023-05-05', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-05 18:00:06', '2023-05-05 18:00:06');
INSERT INTO attendance_employees VALUES (99, 3, '2023-05-05', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-05 18:00:06', '2023-05-05 18:00:06');
INSERT INTO attendance_employees VALUES (100, 2, '2023-05-06', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-06 18:00:06', '2023-05-06 18:00:06');
INSERT INTO attendance_employees VALUES (101, 1, '2023-05-06', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-06 18:00:06', '2023-05-06 18:00:06');
INSERT INTO attendance_employees VALUES (102, 3, '2023-05-06', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-06 18:00:06', '2023-05-06 18:00:06');
INSERT INTO attendance_employees VALUES (103, 2, '2023-05-07', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-07 18:00:07', '2023-05-07 18:00:07');
INSERT INTO attendance_employees VALUES (104, 1, '2023-05-07', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-07 18:00:07', '2023-05-07 18:00:07');
INSERT INTO attendance_employees VALUES (105, 3, '2023-05-07', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-07 18:00:07', '2023-05-07 18:00:07');
INSERT INTO attendance_employees VALUES (106, 2, '2023-05-08', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-08 18:00:06', '2023-05-08 18:00:06');
INSERT INTO attendance_employees VALUES (107, 1, '2023-05-08', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-08 18:00:06', '2023-05-08 18:00:06');
INSERT INTO attendance_employees VALUES (108, 3, '2023-05-08', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-08 18:00:06', '2023-05-08 18:00:06');
INSERT INTO attendance_employees VALUES (109, 2, '2023-05-09', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-09 18:00:06', '2023-05-09 18:00:06');
INSERT INTO attendance_employees VALUES (110, 1, '2023-05-09', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-09 18:00:06', '2023-05-09 18:00:06');
INSERT INTO attendance_employees VALUES (111, 3, '2023-05-09', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-09 18:00:06', '2023-05-09 18:00:06');
INSERT INTO attendance_employees VALUES (112, 2, '2023-05-10', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-10 18:00:06', '2023-05-10 18:00:06');
INSERT INTO attendance_employees VALUES (113, 1, '2023-05-10', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-10 18:00:06', '2023-05-10 18:00:06');
INSERT INTO attendance_employees VALUES (114, 3, '2023-05-10', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-10 18:00:06', '2023-05-10 18:00:06');
INSERT INTO attendance_employees VALUES (115, 2, '2023-05-11', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-11 18:00:07', '2023-05-11 18:00:07');
INSERT INTO attendance_employees VALUES (116, 1, '2023-05-11', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-11 18:00:07', '2023-05-11 18:00:07');
INSERT INTO attendance_employees VALUES (117, 3, '2023-05-11', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-11 18:00:07', '2023-05-11 18:00:07');
INSERT INTO attendance_employees VALUES (118, 2, '2023-05-12', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-12 18:00:12', '2023-05-12 18:00:12');
INSERT INTO attendance_employees VALUES (119, 1, '2023-05-12', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-12 18:00:12', '2023-05-12 18:00:12');
INSERT INTO attendance_employees VALUES (120, 3, '2023-05-12', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-12 18:00:12', '2023-05-12 18:00:12');
INSERT INTO attendance_employees VALUES (121, 2, '2023-05-13', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-13 18:00:06', '2023-05-13 18:00:06');
INSERT INTO attendance_employees VALUES (122, 1, '2023-05-13', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-13 18:00:06', '2023-05-13 18:00:06');
INSERT INTO attendance_employees VALUES (123, 3, '2023-05-13', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-13 18:00:06', '2023-05-13 18:00:06');
INSERT INTO attendance_employees VALUES (124, 2, '2023-05-14', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-14 18:00:06', '2023-05-14 18:00:06');
INSERT INTO attendance_employees VALUES (125, 1, '2023-05-14', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-14 18:00:06', '2023-05-14 18:00:06');
INSERT INTO attendance_employees VALUES (126, 3, '2023-05-14', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-14 18:00:06', '2023-05-14 18:00:06');
INSERT INTO attendance_employees VALUES (127, 2, '2023-05-15', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-15 18:00:06', '2023-05-15 18:00:06');
INSERT INTO attendance_employees VALUES (128, 1, '2023-05-15', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-15 18:00:06', '2023-05-15 18:00:06');
INSERT INTO attendance_employees VALUES (129, 3, '2023-05-15', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-15 18:00:06', '2023-05-15 18:00:06');
INSERT INTO attendance_employees VALUES (130, 2, '2023-05-16', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-16 18:00:06', '2023-05-16 18:00:06');
INSERT INTO attendance_employees VALUES (131, 1, '2023-05-16', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-16 18:00:06', '2023-05-16 18:00:06');
INSERT INTO attendance_employees VALUES (132, 3, '2023-05-16', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-16 18:00:06', '2023-05-16 18:00:06');
INSERT INTO attendance_employees VALUES (133, 2, '2023-05-17', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-17 18:00:06', '2023-05-17 18:00:06');
INSERT INTO attendance_employees VALUES (134, 1, '2023-05-17', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-17 18:00:06', '2023-05-17 18:00:06');
INSERT INTO attendance_employees VALUES (135, 3, '2023-05-17', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-17 18:00:06', '2023-05-17 18:00:06');
INSERT INTO attendance_employees VALUES (136, 2, '2023-05-18', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-18 18:00:06', '2023-05-18 18:00:06');
INSERT INTO attendance_employees VALUES (137, 1, '2023-05-18', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-18 18:00:06', '2023-05-18 18:00:06');
INSERT INTO attendance_employees VALUES (138, 3, '2023-05-18', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-18 18:00:06', '2023-05-18 18:00:06');
INSERT INTO attendance_employees VALUES (139, 2, '2023-05-19', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-19 18:00:06', '2023-05-19 18:00:06');
INSERT INTO attendance_employees VALUES (140, 1, '2023-05-19', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-19 18:00:06', '2023-05-19 18:00:06');
INSERT INTO attendance_employees VALUES (141, 3, '2023-05-19', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-19 18:00:06', '2023-05-19 18:00:06');
INSERT INTO attendance_employees VALUES (142, 2, '2023-05-20', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-20 18:00:06', '2023-05-20 18:00:06');
INSERT INTO attendance_employees VALUES (143, 1, '2023-05-20', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-20 18:00:06', '2023-05-20 18:00:06');
INSERT INTO attendance_employees VALUES (144, 3, '2023-05-20', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-20 18:00:06', '2023-05-20 18:00:06');
INSERT INTO attendance_employees VALUES (145, 2, '2023-05-21', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-21 18:00:06', '2023-05-21 18:00:06');
INSERT INTO attendance_employees VALUES (146, 1, '2023-05-21', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-21 18:00:07', '2023-05-21 18:00:07');
INSERT INTO attendance_employees VALUES (147, 3, '2023-05-21', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-21 18:00:07', '2023-05-21 18:00:07');
INSERT INTO attendance_employees VALUES (148, 2, '2023-05-22', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-22 18:00:05', '2023-05-22 18:00:05');
INSERT INTO attendance_employees VALUES (149, 1, '2023-05-22', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-22 18:00:05', '2023-05-22 18:00:05');
INSERT INTO attendance_employees VALUES (150, 3, '2023-05-22', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-22 18:00:05', '2023-05-22 18:00:05');
INSERT INTO attendance_employees VALUES (151, 2, '2023-05-23', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-23 18:00:06', '2023-05-23 18:00:06');
INSERT INTO attendance_employees VALUES (152, 1, '2023-05-23', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-23 18:00:06', '2023-05-23 18:00:06');
INSERT INTO attendance_employees VALUES (153, 3, '2023-05-23', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-23 18:00:06', '2023-05-23 18:00:06');
INSERT INTO attendance_employees VALUES (154, 2, '2023-05-24', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-24 18:00:05', '2023-05-24 18:00:05');
INSERT INTO attendance_employees VALUES (155, 1, '2023-05-24', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-24 18:00:05', '2023-05-24 18:00:05');
INSERT INTO attendance_employees VALUES (156, 3, '2023-05-24', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-24 18:00:05', '2023-05-24 18:00:05');
INSERT INTO attendance_employees VALUES (157, 2, '2023-05-25', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-25 18:00:06', '2023-05-25 18:00:06');
INSERT INTO attendance_employees VALUES (158, 1, '2023-05-25', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-25 18:00:06', '2023-05-25 18:00:06');
INSERT INTO attendance_employees VALUES (159, 3, '2023-05-25', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-25 18:00:06', '2023-05-25 18:00:06');
INSERT INTO attendance_employees VALUES (160, 2, '2023-05-26', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-26 18:00:06', '2023-05-26 18:00:06');
INSERT INTO attendance_employees VALUES (161, 1, '2023-05-26', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-26 18:00:06', '2023-05-26 18:00:06');
INSERT INTO attendance_employees VALUES (162, 3, '2023-05-26', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-26 18:00:06', '2023-05-26 18:00:06');
INSERT INTO attendance_employees VALUES (163, 2, '2023-05-27', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-27 18:00:06', '2023-05-27 18:00:06');
INSERT INTO attendance_employees VALUES (164, 1, '2023-05-27', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-27 18:00:06', '2023-05-27 18:00:06');
INSERT INTO attendance_employees VALUES (165, 3, '2023-05-27', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-27 18:00:06', '2023-05-27 18:00:06');
INSERT INTO attendance_employees VALUES (166, 2, '2023-05-28', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-28 18:00:06', '2023-05-28 18:00:06');
INSERT INTO attendance_employees VALUES (167, 1, '2023-05-28', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-28 18:00:06', '2023-05-28 18:00:06');
INSERT INTO attendance_employees VALUES (168, 3, '2023-05-28', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-28 18:00:06', '2023-05-28 18:00:06');
INSERT INTO attendance_employees VALUES (169, 2, '2023-05-29', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-29 18:00:06', '2023-05-29 18:00:06');
INSERT INTO attendance_employees VALUES (170, 1, '2023-05-29', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-29 18:00:06', '2023-05-29 18:00:06');
INSERT INTO attendance_employees VALUES (171, 3, '2023-05-29', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-29 18:00:06', '2023-05-29 18:00:06');
INSERT INTO attendance_employees VALUES (172, 2, '2023-05-30', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-30 18:00:05', '2023-05-30 18:00:05');
INSERT INTO attendance_employees VALUES (173, 1, '2023-05-30', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-30 18:00:05', '2023-05-30 18:00:05');
INSERT INTO attendance_employees VALUES (174, 3, '2023-05-30', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-30 18:00:05', '2023-05-30 18:00:05');
INSERT INTO attendance_employees VALUES (175, 2, '2023-05-31', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-31 18:00:06', '2023-05-31 18:00:06');
INSERT INTO attendance_employees VALUES (176, 1, '2023-05-31', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-31 18:00:06', '2023-05-31 18:00:06');
INSERT INTO attendance_employees VALUES (177, 3, '2023-05-31', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-05-31 18:00:06', '2023-05-31 18:00:06');
INSERT INTO attendance_employees VALUES (178, 2, '2023-06-01', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-01 18:00:06', '2023-06-01 18:00:06');
INSERT INTO attendance_employees VALUES (179, 1, '2023-06-01', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-01 18:00:06', '2023-06-01 18:00:06');
INSERT INTO attendance_employees VALUES (180, 3, '2023-06-01', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-01 18:00:06', '2023-06-01 18:00:06');
INSERT INTO attendance_employees VALUES (181, 2, '2023-06-02', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-02 18:00:06', '2023-06-02 18:00:06');
INSERT INTO attendance_employees VALUES (182, 1, '2023-06-02', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-02 18:00:06', '2023-06-02 18:00:06');
INSERT INTO attendance_employees VALUES (183, 3, '2023-06-02', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-02 18:00:06', '2023-06-02 18:00:06');
INSERT INTO attendance_employees VALUES (184, 2, '2023-06-03', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-03 18:00:05', '2023-06-03 18:00:05');
INSERT INTO attendance_employees VALUES (185, 1, '2023-06-03', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-03 18:00:05', '2023-06-03 18:00:05');
INSERT INTO attendance_employees VALUES (186, 3, '2023-06-03', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-03 18:00:05', '2023-06-03 18:00:05');
INSERT INTO attendance_employees VALUES (187, 2, '2023-06-04', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-04 18:00:05', '2023-06-04 18:00:05');
INSERT INTO attendance_employees VALUES (188, 1, '2023-06-04', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-04 18:00:05', '2023-06-04 18:00:05');
INSERT INTO attendance_employees VALUES (189, 3, '2023-06-04', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-04 18:00:05', '2023-06-04 18:00:05');
INSERT INTO attendance_employees VALUES (190, 2, '2023-06-05', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-05 18:00:06', '2023-06-05 18:00:06');
INSERT INTO attendance_employees VALUES (191, 1, '2023-06-05', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-05 18:00:06', '2023-06-05 18:00:06');
INSERT INTO attendance_employees VALUES (192, 3, '2023-06-05', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-05 18:00:06', '2023-06-05 18:00:06');
INSERT INTO attendance_employees VALUES (193, 2, '2023-06-06', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-06 18:00:05', '2023-06-06 18:00:05');
INSERT INTO attendance_employees VALUES (194, 1, '2023-06-06', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-06 18:00:05', '2023-06-06 18:00:05');
INSERT INTO attendance_employees VALUES (195, 3, '2023-06-06', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-06 18:00:05', '2023-06-06 18:00:05');
INSERT INTO attendance_employees VALUES (196, 2, '2023-06-07', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-07 18:00:06', '2023-06-07 18:00:06');
INSERT INTO attendance_employees VALUES (197, 1, '2023-06-07', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-07 18:00:06', '2023-06-07 18:00:06');
INSERT INTO attendance_employees VALUES (198, 3, '2023-06-07', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-07 18:00:06', '2023-06-07 18:00:06');
INSERT INTO attendance_employees VALUES (199, 2, '2023-06-08', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-08 18:00:06', '2023-06-08 18:00:06');
INSERT INTO attendance_employees VALUES (200, 1, '2023-06-08', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-08 18:00:06', '2023-06-08 18:00:06');
INSERT INTO attendance_employees VALUES (201, 3, '2023-06-08', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-08 18:00:06', '2023-06-08 18:00:06');
INSERT INTO attendance_employees VALUES (202, 2, '2023-06-09', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-09 18:00:06', '2023-06-09 18:00:06');
INSERT INTO attendance_employees VALUES (203, 1, '2023-06-09', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-09 18:00:06', '2023-06-09 18:00:06');
INSERT INTO attendance_employees VALUES (204, 3, '2023-06-09', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-09 18:00:06', '2023-06-09 18:00:06');
INSERT INTO attendance_employees VALUES (205, 2, '2023-06-10', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-10 18:00:05', '2023-06-10 18:00:05');
INSERT INTO attendance_employees VALUES (206, 1, '2023-06-10', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-10 18:00:05', '2023-06-10 18:00:05');
INSERT INTO attendance_employees VALUES (207, 3, '2023-06-10', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-10 18:00:05', '2023-06-10 18:00:05');
INSERT INTO attendance_employees VALUES (208, 2, '2023-06-11', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-11 18:00:06', '2023-06-11 18:00:06');
INSERT INTO attendance_employees VALUES (209, 1, '2023-06-11', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-11 18:00:06', '2023-06-11 18:00:06');
INSERT INTO attendance_employees VALUES (210, 3, '2023-06-11', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-11 18:00:06', '2023-06-11 18:00:06');
INSERT INTO attendance_employees VALUES (211, 2, '2023-06-12', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-12 18:00:05', '2023-06-12 18:00:05');
INSERT INTO attendance_employees VALUES (212, 1, '2023-06-12', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-12 18:00:05', '2023-06-12 18:00:05');
INSERT INTO attendance_employees VALUES (213, 3, '2023-06-12', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-12 18:00:05', '2023-06-12 18:00:05');
INSERT INTO attendance_employees VALUES (214, 2, '2023-06-13', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-13 18:00:05', '2023-06-13 18:00:05');
INSERT INTO attendance_employees VALUES (215, 1, '2023-06-13', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-13 18:00:05', '2023-06-13 18:00:05');
INSERT INTO attendance_employees VALUES (216, 3, '2023-06-13', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-13 18:00:05', '2023-06-13 18:00:05');
INSERT INTO attendance_employees VALUES (217, 2, '2023-06-14', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-14 18:00:06', '2023-06-14 18:00:06');
INSERT INTO attendance_employees VALUES (218, 1, '2023-06-14', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-14 18:00:06', '2023-06-14 18:00:06');
INSERT INTO attendance_employees VALUES (219, 3, '2023-06-14', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-14 18:00:06', '2023-06-14 18:00:06');
INSERT INTO attendance_employees VALUES (220, 2, '2023-06-15', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-15 18:00:07', '2023-06-15 18:00:07');
INSERT INTO attendance_employees VALUES (221, 1, '2023-06-15', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-15 18:00:07', '2023-06-15 18:00:07');
INSERT INTO attendance_employees VALUES (222, 3, '2023-06-15', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-15 18:00:07', '2023-06-15 18:00:07');
INSERT INTO attendance_employees VALUES (223, 2, '2023-06-16', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-16 18:00:05', '2023-06-16 18:00:05');
INSERT INTO attendance_employees VALUES (224, 1, '2023-06-16', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-16 18:00:05', '2023-06-16 18:00:05');
INSERT INTO attendance_employees VALUES (225, 3, '2023-06-16', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-16 18:00:05', '2023-06-16 18:00:05');
INSERT INTO attendance_employees VALUES (226, 2, '2023-06-17', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-17 18:00:05', '2023-06-17 18:00:05');
INSERT INTO attendance_employees VALUES (227, 1, '2023-06-17', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-17 18:00:05', '2023-06-17 18:00:05');
INSERT INTO attendance_employees VALUES (228, 3, '2023-06-17', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-17 18:00:05', '2023-06-17 18:00:05');
INSERT INTO attendance_employees VALUES (229, 2, '2023-06-18', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-18 18:00:05', '2023-06-18 18:00:05');
INSERT INTO attendance_employees VALUES (230, 3, '2023-06-18', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-18 18:00:05', '2023-06-18 18:00:05');
INSERT INTO attendance_employees VALUES (231, 1, '2023-06-18', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-18 18:00:05', '2023-06-18 18:00:05');
INSERT INTO attendance_employees VALUES (232, 2, '2023-06-19', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-19 18:00:05', '2023-06-19 18:00:05');
INSERT INTO attendance_employees VALUES (233, 3, '2023-06-19', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-19 18:00:05', '2023-06-19 18:00:05');
INSERT INTO attendance_employees VALUES (234, 1, '2023-06-19', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-19 18:00:05', '2023-06-19 18:00:05');
INSERT INTO attendance_employees VALUES (235, 2, '2023-06-20', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-20 18:00:06', '2023-06-20 18:00:06');
INSERT INTO attendance_employees VALUES (236, 3, '2023-06-20', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-20 18:00:06', '2023-06-20 18:00:06');
INSERT INTO attendance_employees VALUES (237, 1, '2023-06-20', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-20 18:00:06', '2023-06-20 18:00:06');
INSERT INTO attendance_employees VALUES (238, 2, '2023-06-21', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-21 18:00:05', '2023-06-21 18:00:05');
INSERT INTO attendance_employees VALUES (239, 3, '2023-06-21', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-21 18:00:06', '2023-06-21 18:00:06');
INSERT INTO attendance_employees VALUES (240, 1, '2023-06-21', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-21 18:00:06', '2023-06-21 18:00:06');
INSERT INTO attendance_employees VALUES (241, 2, '2023-06-22', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-22 18:00:05', '2023-06-22 18:00:05');
INSERT INTO attendance_employees VALUES (242, 3, '2023-06-22', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-22 18:00:05', '2023-06-22 18:00:05');
INSERT INTO attendance_employees VALUES (243, 1, '2023-06-22', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-22 18:00:05', '2023-06-22 18:00:05');
INSERT INTO attendance_employees VALUES (244, 2, '2023-06-23', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-23 18:00:06', '2023-06-23 18:00:06');
INSERT INTO attendance_employees VALUES (245, 3, '2023-06-23', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-23 18:00:06', '2023-06-23 18:00:06');
INSERT INTO attendance_employees VALUES (246, 1, '2023-06-23', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-23 18:00:06', '2023-06-23 18:00:06');
INSERT INTO attendance_employees VALUES (247, 2, '2023-06-24', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-24 18:00:05', '2023-06-24 18:00:05');
INSERT INTO attendance_employees VALUES (248, 3, '2023-06-24', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-24 18:00:05', '2023-06-24 18:00:05');
INSERT INTO attendance_employees VALUES (249, 1, '2023-06-24', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-24 18:00:05', '2023-06-24 18:00:05');
INSERT INTO attendance_employees VALUES (250, 2, '2023-06-25', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-25 18:00:05', '2023-06-25 18:00:05');
INSERT INTO attendance_employees VALUES (251, 3, '2023-06-25', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-25 18:00:06', '2023-06-25 18:00:06');
INSERT INTO attendance_employees VALUES (252, 1, '2023-06-25', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-25 18:00:06', '2023-06-25 18:00:06');
INSERT INTO attendance_employees VALUES (253, 2, '2023-06-26', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-26 18:00:05', '2023-06-26 18:00:05');
INSERT INTO attendance_employees VALUES (254, 3, '2023-06-26', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-26 18:00:06', '2023-06-26 18:00:06');
INSERT INTO attendance_employees VALUES (255, 1, '2023-06-26', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-26 18:00:06', '2023-06-26 18:00:06');
INSERT INTO attendance_employees VALUES (256, 2, '2023-06-27', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-27 18:00:05', '2023-06-27 18:00:05');
INSERT INTO attendance_employees VALUES (257, 3, '2023-06-27', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-27 18:00:05', '2023-06-27 18:00:05');
INSERT INTO attendance_employees VALUES (258, 1, '2023-06-27', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-27 18:00:05', '2023-06-27 18:00:05');
INSERT INTO attendance_employees VALUES (259, 2, '2023-06-28', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-28 18:00:05', '2023-06-28 18:00:05');
INSERT INTO attendance_employees VALUES (260, 3, '2023-06-28', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-28 18:00:05', '2023-06-28 18:00:05');
INSERT INTO attendance_employees VALUES (261, 1, '2023-06-28', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-28 18:00:05', '2023-06-28 18:00:05');
INSERT INTO attendance_employees VALUES (262, 2, '2023-06-29', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-29 18:00:06', '2023-06-29 18:00:06');
INSERT INTO attendance_employees VALUES (263, 3, '2023-06-29', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-29 18:00:06', '2023-06-29 18:00:06');
INSERT INTO attendance_employees VALUES (264, 1, '2023-06-29', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-29 18:00:06', '2023-06-29 18:00:06');
INSERT INTO attendance_employees VALUES (265, 2, '2023-06-30', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-30 18:00:07', '2023-06-30 18:00:07');
INSERT INTO attendance_employees VALUES (266, 3, '2023-06-30', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-30 18:00:07', '2023-06-30 18:00:07');
INSERT INTO attendance_employees VALUES (267, 1, '2023-06-30', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-06-30 18:00:08', '2023-06-30 18:00:08');
INSERT INTO attendance_employees VALUES (268, 2, '2023-07-01', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-01 18:00:05', '2023-07-01 18:00:05');
INSERT INTO attendance_employees VALUES (269, 3, '2023-07-01', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-01 18:00:05', '2023-07-01 18:00:05');
INSERT INTO attendance_employees VALUES (270, 1, '2023-07-01', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-01 18:00:05', '2023-07-01 18:00:05');
INSERT INTO attendance_employees VALUES (271, 2, '2023-07-02', 'Present', NULL, '08:00:00', '17:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-02 16:53:18', '2023-07-02 16:53:18');
INSERT INTO attendance_employees VALUES (272, 3, '2023-07-02', 'Present', NULL, '08:00:00', '17:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-02 16:53:18', '2023-07-02 16:53:18');
INSERT INTO attendance_employees VALUES (273, 1, '2023-07-02', 'Present', NULL, '08:00:00', '17:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-02 16:53:18', '2023-07-02 16:53:18');
INSERT INTO attendance_employees VALUES (274, 5, '2023-03-01', 'Sick Without Letter', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-02 19:28:37', '2023-07-02 19:28:37');
INSERT INTO attendance_employees VALUES (275, 5, '2023-03-07', 'Sick Without Letter', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-02 19:34:12', '2023-07-02 19:34:12');
INSERT INTO attendance_employees VALUES (276, 3, '2023-07-03', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-03 18:00:05', '2023-07-03 18:00:05');
INSERT INTO attendance_employees VALUES (277, 1, '2023-07-03', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-03 18:00:05', '2023-07-03 18:00:05');
INSERT INTO attendance_employees VALUES (278, 2, '2023-07-03', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-03 18:00:05', '2023-07-03 18:00:05');
INSERT INTO attendance_employees VALUES (279, 5, '2023-07-03', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-03 18:00:05', '2023-07-03 18:00:05');
INSERT INTO attendance_employees VALUES (280, 4, '2023-07-03', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-03 18:00:05', '2023-07-03 18:00:05');
INSERT INTO attendance_employees VALUES (281, 3, '2023-07-04', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-04 18:00:04', '2023-07-04 18:00:04');
INSERT INTO attendance_employees VALUES (282, 1, '2023-07-04', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-04 18:00:04', '2023-07-04 18:00:04');
INSERT INTO attendance_employees VALUES (283, 2, '2023-07-04', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-04 18:00:04', '2023-07-04 18:00:04');
INSERT INTO attendance_employees VALUES (284, 5, '2023-07-04', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-04 18:00:05', '2023-07-04 18:00:05');
INSERT INTO attendance_employees VALUES (285, 4, '2023-07-04', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-04 18:00:05', '2023-07-04 18:00:05');
INSERT INTO attendance_employees VALUES (286, 3, '2023-07-05', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-05 18:00:05', '2023-07-05 18:00:05');
INSERT INTO attendance_employees VALUES (287, 1, '2023-07-05', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-05 18:00:05', '2023-07-05 18:00:05');
INSERT INTO attendance_employees VALUES (288, 2, '2023-07-05', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-05 18:00:05', '2023-07-05 18:00:05');
INSERT INTO attendance_employees VALUES (289, 5, '2023-07-05', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-05 18:00:05', '2023-07-05 18:00:05');
INSERT INTO attendance_employees VALUES (290, 4, '2023-07-05', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-05 18:00:05', '2023-07-05 18:00:05');
INSERT INTO attendance_employees VALUES (291, 3, '2023-07-06', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-06 18:00:05', '2023-07-06 18:00:05');
INSERT INTO attendance_employees VALUES (292, 1, '2023-07-06', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-06 18:00:05', '2023-07-06 18:00:05');
INSERT INTO attendance_employees VALUES (293, 2, '2023-07-06', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-06 18:00:05', '2023-07-06 18:00:05');
INSERT INTO attendance_employees VALUES (294, 5, '2023-07-06', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-06 18:00:05', '2023-07-06 18:00:05');
INSERT INTO attendance_employees VALUES (295, 4, '2023-07-06', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-06 18:00:05', '2023-07-06 18:00:05');
INSERT INTO attendance_employees VALUES (296, 3, '2023-07-07', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-07 18:00:07', '2023-07-07 18:00:07');
INSERT INTO attendance_employees VALUES (297, 1, '2023-07-07', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-07 18:00:07', '2023-07-07 18:00:07');
INSERT INTO attendance_employees VALUES (298, 2, '2023-07-07', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-07 18:00:07', '2023-07-07 18:00:07');
INSERT INTO attendance_employees VALUES (299, 5, '2023-07-07', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-07 18:00:07', '2023-07-07 18:00:07');
INSERT INTO attendance_employees VALUES (300, 4, '2023-07-07', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-07 18:00:07', '2023-07-07 18:00:07');
INSERT INTO attendance_employees VALUES (301, 2, '2023-07-08', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-08 18:00:07', '2023-07-08 18:00:07');
INSERT INTO attendance_employees VALUES (302, 3, '2023-07-08', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-08 18:00:07', '2023-07-08 18:00:07');
INSERT INTO attendance_employees VALUES (303, 6, '2023-07-08', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '2023-07-08 18:00:07', '2023-07-08 18:00:07');
INSERT INTO attendance_employees VALUES (304, 4, '2023-07-08', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-08 18:00:07', '2023-07-08 18:00:07');
INSERT INTO attendance_employees VALUES (305, 5, '2023-07-08', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-08 18:00:07', '2023-07-08 18:00:07');
INSERT INTO attendance_employees VALUES (306, 1, '2023-07-08', 'Alpha', NULL, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 2, '2023-07-08 18:00:07', '2023-07-08 18:00:07');


--
-- Name: attendance_employees_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('attendance_employees_id_seq', 306, true);


--
-- Data for Name: branches; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO branches VALUES (1, 'PT. AR PACKAGING', 'ARP', 2, NULL, NULL);
INSERT INTO branches VALUES (2, 'PT. KARYA INDAH MULTI GUNA', 'KIM', 2, NULL, NULL);


--
-- Name: branches_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('branches_id_seq', 2, true);


--
-- Data for Name: break_times; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: break_times_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('break_times_id_seq', 1, false);


--
-- Data for Name: cashes; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: cashes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('cashes_id_seq', 1, false);


--
-- Data for Name: checklist_attendance_summaries; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO checklist_attendance_summaries VALUES (7, 'national_holiday', true, 2, '2023-04-11 06:53:39', '2023-04-11 06:53:39');
INSERT INTO checklist_attendance_summaries VALUES (8, 'company_holiday', true, 2, '2023-04-11 06:53:39', '2023-04-11 06:53:39');
INSERT INTO checklist_attendance_summaries VALUES (9, 'timeoff_code', true, 2, '2023-04-11 06:53:39', '2023-04-11 06:53:39');


--
-- Name: checklist_attendance_summaries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('checklist_attendance_summaries_id_seq', 9, true);


--
-- Data for Name: company_holidays; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: company_holidays_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('company_holidays_id_seq', 1, false);


--
-- Data for Name: day_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO day_types VALUES (1, 'work', 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');


--
-- Name: day_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('day_types_id_seq', 1, true);


--
-- Data for Name: dayoffs; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: dayoffs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('dayoffs_id_seq', 1, false);


--
-- Data for Name: dendas; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO dendas VALUES (1, 1, '00:30:00', 2000.00, 2, '2023-06-29 01:16:19', '2023-06-29 01:16:19');


--
-- Name: dendas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('dendas_id_seq', 1, true);


--
-- Data for Name: documents; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO documents VALUES (1, 'CV', '0', 2, NULL, NULL);
INSERT INTO documents VALUES (2, 'Photo Profile', '0', 2, NULL, NULL);


--
-- Name: documents_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('documents_id_seq', 2, true);


--
-- Data for Name: employee_documents; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: employee_documents_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employee_documents_id_seq', 1, false);


--
-- Data for Name: employee_education; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO employee_education VALUES (1, 1, '2014-01-01', '2017-03-01', 'Formal', 'SMP', 'SMP DU 2', 'Peterongan, Jombang', 'MIPA', NULL, NULL, NULL, NULL);
INSERT INTO employee_education VALUES (2, 1, '2017-01-01', '2020-03-01', 'Formal', 'SMA', 'SMA DU 3', 'Peterongan, Jombang', 'MIPA', NULL, NULL, NULL, NULL);
INSERT INTO employee_education VALUES (3, 2, '2014-01-01', '2017-03-01', 'Formal', 'SMP', 'SMP DU 2', 'Peterongan, Jombang', 'MIPA', NULL, NULL, NULL, NULL);
INSERT INTO employee_education VALUES (4, 2, '2017-01-01', '2020-03-01', 'Formal', 'SMA', 'SMA DU 3', 'Peterongan, Jombang', 'MIPA', NULL, NULL, NULL, NULL);
INSERT INTO employee_education VALUES (5, 5, '1997-07-01', '2000-07-01', 'SMA', 'SENIOR HIGH SCHOOL', 'SMA NEGERI 1', 'JL. RAYA PANJANG', 'IPA', NULL, NULL, '2023-07-02 19:23:55', '2023-07-02 19:23:55');


--
-- Name: employee_education_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employee_education_id_seq', 5, true);


--
-- Data for Name: employee_experiences; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO employee_experiences VALUES (1, 1, '2022-01-01', '2022-03-01', 1, 'Programmer', 'Programmer', 'Peterongan', 'Jombang', 'Boring', '', '2023-04-10 12:14:14', '2023-04-11 10:16:35');
INSERT INTO employee_experiences VALUES (3, 5, '2008-02-01', '2010-02-01', 2, 'MANAGEMENT', 'MANAGER', 'JL. JALAN', 'YOGYAKARTA', 'PANDEMI', '', '2023-07-02 19:23:55', '2023-07-02 19:23:55');
INSERT INTO employee_experiences VALUES (2, 2, '2022-01-01', '2022-03-01', 1, 'Programmer', 'Programmer', 'Peterongan', 'Jombang', 'Boring', '', '2023-04-10 12:14:14', '2023-07-08 11:18:05');


--
-- Name: employee_experiences_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employee_experiences_id_seq', 3, true);


--
-- Data for Name: employee_medicals; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO employee_medicals VALUES (1, 1, NULL, NULL, NULL, NULL, '2023-04-11 10:16:35', '2023-04-11 10:16:35');
INSERT INTO employee_medicals VALUES (2, 3, NULL, NULL, NULL, NULL, '2023-04-18 12:24:10', '2023-04-18 12:24:10');
INSERT INTO employee_medicals VALUES (3, 5, '160', '60', 'B', 'PASSED', '2023-07-02 19:13:52', '2023-07-02 19:23:55');
INSERT INTO employee_medicals VALUES (4, 2, NULL, NULL, NULL, NULL, '2023-07-08 11:18:05', '2023-07-08 11:18:05');


--
-- Name: employee_medicals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employee_medicals_id_seq', 4, true);


--
-- Data for Name: employees; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO employees VALUES (2, 4, 'accountant2', '2001-05-01', 'Female', '08119725162', 'Jl. semampir no.2, Malaysia', 'accountant@example.com', '$2y$10$TDtun8kBSsCMr3We/q/o/.5//kdVpTlu7sTFu77MBrQG2JHwUSOjC', 'ARP00002', 1, 0, 0, '2022-12-01', '2023-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Gaji Pokok (Monthly)', 7000000, 17430000, true, 2, 2, 'monthly', 'jobholder', NULL, 11, NULL, NULL, 'active', '2023-04-10 12:14:14', '2023-07-08 11:30:58', NULL, NULL, NULL, 'ISLAM');
INSERT INTO employees VALUES (3, 5, 'Suali', NULL, 'Female', '123123', NULL, 'suali@gmail.com', '$2y$10$U7hMbDCHPrwL/hxZrUyNBO6xKu5bdkOM3LfjbzT7EaqA6tNDomdde', 'KIM00003', 2, 0, 0, '2023-04-13', '2024-04-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Gaji Pokok (Monthly)', 5000000, 9950000, true, 2, 1, NULL, 'jobholder', NULL, 0, NULL, NULL, 'active', '2023-04-13 07:55:17', '2023-07-02 19:32:28', NULL, NULL, NULL, NULL);
INSERT INTO employees VALUES (6, 11, 'slametw', '2023-11-26', 'male', '9876', 'comal', 'spt@gmail.com', NULL, 'ARP00006', 1, 1, 1, '2023-02-10', '2024-02-10', NULL, '', '', '', '', '', NULL, NULL, NULL, 0, true, 2, NULL, NULL, 'jobholders', 'married', 0, NULL, '2024-02-10', 'active', NULL, '2023-07-08 12:47:06', '1234', '212', '12', 'keristen');
INSERT INTO employees VALUES (4, 6, 'jovi', NULL, NULL, NULL, NULL, 'jov@gmail.com', '$2y$10$lWt/Smm1kfuiyp2MDwZqvuYRMARyXsnN5RWi1kiO928an//j48VPG', 'ARP00004', 1, 0, 0, '2023-07-02', '2024-06-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, true, 2, NULL, NULL, 'outsourcing', NULL, 0, NULL, NULL, 'active', '2023-07-02 19:05:28', '2023-07-03 16:51:08', NULL, NULL, NULL, NULL);
INSERT INTO employees VALUES (5, 7, 'coba', '1982-01-01', 'Male', '08123456789', 'JL. RAYA', 'coba@gmail.com', '$2y$10$x1EEAcOS2f3/9KjGznQc8eqtmsWCyyjwBggTxpnRJ/Co3dpwiLXV.', 'KIM00005', 1, 0, 0, '2022-03-03', '2023-03-02', NULL, NULL, '123543234', NULL, NULL, NULL, NULL, 'Gaji Pokok (Monthly)', 6500000, 7235000, true, 2, 1, 'annual', 'outsourcing', 'married', 11, 8, NULL, 'active', '2023-07-02 19:08:40', '2023-07-08 11:16:12', '1234567890987654', '1234567890123456', '54.000.123-000.111', 'ISLAM');
INSERT INTO employees VALUES (1, 3, 'accountant', '2001-05-01', 'Male', '08119725162', 'Jl. semampir no.2, Malaysia', 'accountant@example.com', '$2y$10$IWr./O57ukJiLx1injns6edlKyoV45SH4RWkyfU/OYZmxjhJ/hdhS', 'ARP00001', 1, 0, 0, '2022-12-12', '2023-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Gaji Pokok (Monthly)', 5000000, 6300000, true, 2, 2, 'annual', 'jobholder', 'single', 11, NULL, NULL, 'active', '2023-04-10 12:14:13', '2023-07-08 11:17:38', NULL, NULL, NULL, 'ISLAM');


--
-- Name: employees_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employees_id_seq', 6, true);


--
-- Data for Name: employements; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO employements VALUES (1, 1, 'Hiring', 'Tangerang', 'Tangerang', 'Accountant', 'Accountant', 'KONTRAK', NULL, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO employements VALUES (2, 2, 'Hiring', 'Tangerang', 'Tangerang', 'Accountant', 'Accountant', 'KONTRAK', NULL, '2023-04-10 12:14:14', '2023-04-10 12:14:14');


--
-- Name: employements_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employements_id_seq', 2, true);


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('failed_jobs_id_seq', 1, false);


--
-- Data for Name: families; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO families VALUES (1, 1, 'aaa', 'male', 'aunt', 'ada', '2023-04-11 10:16:35', '2023-04-11 10:16:35');
INSERT INTO families VALUES (2, 5, 'RANGER', 'MALE', 'AUNT', 'OK', '2023-07-02 19:23:55', '2023-07-02 19:23:55');


--
-- Name: families_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('families_id_seq', 2, true);


--
-- Data for Name: history_leaves; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO history_leaves VALUES (1, 5, 1, '2023-07-02', '2023-03-01', '2023-03-03', '2', 'SAKIT', NULL, NULL, 'Approved', NULL, NULL, 2, '2023-07-02 19:28:37', '2023-07-02 19:28:37');
INSERT INTO history_leaves VALUES (3, 5, 1, '2023-07-02', '2023-03-07', '2023-03-10', '3', 'SAKIT LAGI', NULL, NULL, 'Approved', NULL, NULL, 2, '2023-07-02 19:34:12', '2023-07-02 19:34:12');


--
-- Name: history_leaves_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('history_leaves_id_seq', 3, true);


--
-- Data for Name: leave_approvals; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO leave_approvals VALUES (3, 3, 1, false, 3, 'Pending', 2, '2023-07-02 19:34:12', '2023-07-02 19:34:12');
INSERT INTO leave_approvals VALUES (4, 3, 2, false, 1, 'Pending', 2, '2023-07-02 19:34:12', '2023-07-02 19:34:12');


--
-- Name: leave_approvals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('leave_approvals_id_seq', 4, true);


--
-- Data for Name: leave_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO leave_types VALUES (1, 'Sick', 12, 2, '2023-04-10 12:14:14', '2023-07-02 19:28:03');


--
-- Name: leave_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('leave_types_id_seq', 1, true);


--
-- Data for Name: leaves; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO leaves VALUES (1, 5, 1, '2023-07-02', '2023-03-01', '2023-03-03', '2', 'SAKIT', NULL, NULL, 'Approved', NULL, NULL, 2, '2023-07-02 19:28:37', '2023-07-02 19:28:37');
INSERT INTO leaves VALUES (3, 5, 1, '2023-07-02', '2023-03-07', '2023-03-10', '3', 'SAKIT LAGI', NULL, NULL, 'Approved', NULL, NULL, 2, '2023-07-02 19:34:12', '2023-07-02 19:34:12');


--
-- Name: leaves_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('leaves_id_seq', 3, true);


--
-- Data for Name: level_approvals; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO level_approvals VALUES (1, 1, 5, NULL, 2, '2023-07-02 19:32:28', '2023-07-02 19:36:58');
INSERT INTO level_approvals VALUES (2, 2, 2, NULL, 2, '2023-07-02 19:32:28', '2023-07-02 19:36:58');


--
-- Name: level_approvals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('level_approvals_id_seq', 2, true);


--
-- Data for Name: loan_options; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO loan_options VALUES (1, 'Cicilan KPR', 2, NULL, NULL);
INSERT INTO loan_options VALUES (2, 'OPERATION', 2, '2023-05-07 12:24:58', '2023-05-07 12:24:58');
INSERT INTO loan_options VALUES (3, 'BUSINESS TRAVELLING', 2, '2023-05-07 12:25:09', '2023-05-07 12:25:09');
INSERT INTO loan_options VALUES (4, 'PROJECT', 2, '2023-05-07 12:25:16', '2023-05-07 12:25:16');


--
-- Name: loan_options_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('loan_options_id_seq', 4, true);


--
-- Data for Name: loans; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: loans_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('loans_id_seq', 1, false);


--
-- Data for Name: log_attendances; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO log_attendances VALUES (1, 3, '2023-04-13 07:57:48', 'Suali Has Clocked In', 2, '2023-04-13 07:57:48', '2023-04-13 07:57:48');


--
-- Name: log_attendances_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('log_attendances_id_seq', 1, true);


--
-- Data for Name: log_employee_resumes; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO log_employee_resumes VALUES (1, 1, '2023-04-30', 'accountant2 will have a birthday on Tue 1st May', 2, '2023-04-30 00:01:03', '2023-04-30 00:01:03');
INSERT INTO log_employee_resumes VALUES (2, 1, '2023-04-30', 'accountant will have a birthday on Tue 1st May', 2, '2023-04-30 00:01:03', '2023-04-30 00:01:03');


--
-- Name: log_employee_resumes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('log_employee_resumes_id_seq', 2, true);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO migrations VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO migrations VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO migrations VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO migrations VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO migrations VALUES (5, '2022_10_21_154523_create_employees_table', 1);
INSERT INTO migrations VALUES (6, '2022_10_21_154801_create_permission_tables', 1);
INSERT INTO migrations VALUES (7, '2022_10_21_160624_add_created_by_to_roles', 1);
INSERT INTO migrations VALUES (8, '2022_10_25_115631_create_branches_table', 1);
INSERT INTO migrations VALUES (9, '2022_10_26_035449_create_settings_table', 1);
INSERT INTO migrations VALUES (10, '2022_10_27_232752_create_employements_table', 1);
INSERT INTO migrations VALUES (11, '2022_10_27_234552_create_employee_education_table', 1);
INSERT INTO migrations VALUES (12, '2022_10_27_234948_create_employee_experiences_table', 1);
INSERT INTO migrations VALUES (13, '2022_10_27_235837_create_documents_table', 1);
INSERT INTO migrations VALUES (14, '2022_10_27_235920_create_employee_documents_table', 1);
INSERT INTO migrations VALUES (15, '2022_10_28_061429_create_payslip_types_table', 1);
INSERT INTO migrations VALUES (16, '2022_11_01_035631_create_leave_types_table', 1);
INSERT INTO migrations VALUES (17, '2022_11_01_074240_create_allowances_table', 1);
INSERT INTO migrations VALUES (18, '2022_11_01_074859_create_reimburstment_options_table', 1);
INSERT INTO migrations VALUES (19, '2022_11_01_105339_create_loan_options_table', 1);
INSERT INTO migrations VALUES (20, '2022_11_04_101940_create_performance_reviews_table', 1);
INSERT INTO migrations VALUES (21, '2022_11_09_153815_create_history_leaves_table', 1);
INSERT INTO migrations VALUES (22, '2022_11_09_153815_create_leaves_table', 1);
INSERT INTO migrations VALUES (23, '2022_11_10_020918_create_overtimes_table', 1);
INSERT INTO migrations VALUES (24, '2022_11_10_021418_create_overtime_types_table', 1);
INSERT INTO migrations VALUES (25, '2022_11_10_021733_create_day_types_table', 1);
INSERT INTO migrations VALUES (26, '2022_11_18_034714_create_shift_types_table', 1);
INSERT INTO migrations VALUES (27, '2022_11_18_174853_create_break_times_table', 1);
INSERT INTO migrations VALUES (28, '2022_11_19_084204_create_req_shift_schedules_table', 1);
INSERT INTO migrations VALUES (29, '2022_11_19_091340_create_shift_schedules_table', 1);
INSERT INTO migrations VALUES (30, '2022_11_24_103223_create_attendance_employees_table', 1);
INSERT INTO migrations VALUES (31, '2022_12_02_004120_create_families_table', 1);
INSERT INTO migrations VALUES (32, '2022_12_02_090204_create_employee_medicals_table', 1);
INSERT INTO migrations VALUES (33, '2022_12_09_210608_create_travel_table', 1);
INSERT INTO migrations VALUES (34, '2022_12_10_172650_create_timesheets_table', 1);
INSERT INTO migrations VALUES (35, '2022_12_14_164046_create_all_requests_table', 1);
INSERT INTO migrations VALUES (36, '2022_12_20_092810_create_payrolls_table', 1);
INSERT INTO migrations VALUES (37, '2022_12_20_092950_create_reimbursts_table', 1);
INSERT INTO migrations VALUES (38, '2022_12_20_093046_create_cashes_table', 1);
INSERT INTO migrations VALUES (39, '2022_12_20_121838_create_allowance_finances_table', 1);
INSERT INTO migrations VALUES (40, '2022_12_25_203619_create_dendas_table', 1);
INSERT INTO migrations VALUES (41, '2022_12_31_075105_create_pay_slips_table', 1);
INSERT INTO migrations VALUES (42, '2022_12_31_175836_create_allowance_options_table', 1);
INSERT INTO migrations VALUES (43, '2023_01_12_063005_create_loans_table', 1);
INSERT INTO migrations VALUES (44, '2023_01_12_113651_create_set_bpjstk_table', 1);
INSERT INTO migrations VALUES (45, '2023_01_15_111356_create_dayoffs_table', 1);
INSERT INTO migrations VALUES (46, '2023_01_15_161856_create_company_holidays_table', 1);
INSERT INTO migrations VALUES (47, '2023_01_28_103125_create_projects_table', 1);
INSERT INTO migrations VALUES (48, '2023_01_28_222714_create_project_users_table', 1);
INSERT INTO migrations VALUES (49, '2023_02_04_100208_create_payslip_code_pins_table', 1);
INSERT INTO migrations VALUES (50, '2023_02_04_212344_create_checklist_attendance_summaries_table', 1);
INSERT INTO migrations VALUES (51, '2023_02_14_202014_create_level_approvals_table', 1);
INSERT INTO migrations VALUES (52, '2023_02_15_201314_create_leave_approvals_table', 1);
INSERT INTO migrations VALUES (53, '2023_02_17_062055_create_overtime_approvals_table', 1);
INSERT INTO migrations VALUES (54, '2023_02_17_110113_create_request_shift_schedule_approvals_table', 1);
INSERT INTO migrations VALUES (55, '2023_02_18_080506_create_timesheet_approvals_table', 1);
INSERT INTO migrations VALUES (56, '2023_02_18_101017_create_on_duty_approvals_table', 1);
INSERT INTO migrations VALUES (57, '2023_02_18_120015_create_ptkp_table', 1);
INSERT INTO migrations VALUES (58, '2023_02_18_154302_create_set_ptkp_table', 1);
INSERT INTO migrations VALUES (59, '2023_04_08_214415_create_log_attendances_table', 1);
INSERT INTO migrations VALUES (60, '2023_04_09_084802_create_log_employee_resumes_table', 1);


--
-- Data for Name: model_has_permissions; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Data for Name: model_has_roles; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO model_has_roles VALUES (1, 'App\Models\User', 1);
INSERT INTO model_has_roles VALUES (2, 'App\Models\User', 2);
INSERT INTO model_has_roles VALUES (3, 'App\Models\User', 3);
INSERT INTO model_has_roles VALUES (3, 'App\Models\User', 4);
INSERT INTO model_has_roles VALUES (3, 'App\Models\User', 5);
INSERT INTO model_has_roles VALUES (4, 'App\Models\User', 6);
INSERT INTO model_has_roles VALUES (4, 'App\Models\User', 7);


--
-- Data for Name: on_duty_approvals; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: on_duty_approvals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('on_duty_approvals_id_seq', 1, false);


--
-- Data for Name: overtime_approvals; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: overtime_approvals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('overtime_approvals_id_seq', 1, false);


--
-- Data for Name: overtime_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO overtime_types VALUES (1, 'overtime1', 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');


--
-- Name: overtime_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('overtime_types_id_seq', 1, true);


--
-- Data for Name: overtimes; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: overtimes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('overtimes_id_seq', 1, false);


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Data for Name: pay_slips; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO pay_slips VALUES (1, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:23:48', '2023-04-11 04:23:48');
INSERT INTO pay_slips VALUES (2, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:27:10', '2023-04-11 04:27:10');
INSERT INTO pay_slips VALUES (3, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:27:57', '2023-04-11 04:27:57');
INSERT INTO pay_slips VALUES (4, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:28:53', '2023-04-11 04:28:53');
INSERT INTO pay_slips VALUES (5, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:30:22', '2023-04-11 04:30:22');
INSERT INTO pay_slips VALUES (6, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:30:37', '2023-04-11 04:30:37');
INSERT INTO pay_slips VALUES (7, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:31:32', '2023-04-11 04:31:32');
INSERT INTO pay_slips VALUES (8, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:31:57', '2023-04-11 04:31:57');
INSERT INTO pay_slips VALUES (9, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:32:33', '2023-04-11 04:32:33');
INSERT INTO pay_slips VALUES (10, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:34:47', '2023-04-11 04:34:47');
INSERT INTO pay_slips VALUES (11, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:35:04', '2023-04-11 04:35:04');
INSERT INTO pay_slips VALUES (12, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:35:28', '2023-04-11 04:35:28');
INSERT INTO pay_slips VALUES (13, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:36:01', '2023-04-11 04:36:01');
INSERT INTO pay_slips VALUES (14, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:36:16', '2023-04-11 04:36:16');
INSERT INTO pay_slips VALUES (15, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:36:56', '2023-04-11 04:36:56');
INSERT INTO pay_slips VALUES (16, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:37:21', '2023-04-11 04:37:21');
INSERT INTO pay_slips VALUES (17, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:37:44', '2023-04-11 04:37:44');
INSERT INTO pay_slips VALUES (18, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:38:12', '2023-04-11 04:38:12');
INSERT INTO pay_slips VALUES (19, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:38:33', '2023-04-11 04:38:33');
INSERT INTO pay_slips VALUES (20, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:39:03', '2023-04-11 04:39:03');
INSERT INTO pay_slips VALUES (21, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:39:57', '2023-04-11 04:39:57');
INSERT INTO pay_slips VALUES (22, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:40:17', '2023-04-11 04:40:17');
INSERT INTO pay_slips VALUES (23, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:41:05', '2023-04-11 04:41:05');
INSERT INTO pay_slips VALUES (24, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:44:34', '2023-04-11 04:44:34');
INSERT INTO pay_slips VALUES (25, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:45:44', '2023-04-11 04:45:44');
INSERT INTO pay_slips VALUES (26, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:48:42', '2023-04-11 04:48:42');
INSERT INTO pay_slips VALUES (27, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:50:03', '2023-04-11 04:50:03');
INSERT INTO pay_slips VALUES (28, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:50:15', '2023-04-11 04:50:15');
INSERT INTO pay_slips VALUES (29, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:51:01', '2023-04-11 04:51:01');
INSERT INTO pay_slips VALUES (30, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:51:12', '2023-04-11 04:51:12');
INSERT INTO pay_slips VALUES (31, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:51:35', '2023-04-11 04:51:35');
INSERT INTO pay_slips VALUES (32, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:51:47', '2023-04-11 04:51:47');
INSERT INTO pay_slips VALUES (33, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:52:06', '2023-04-11 04:52:06');
INSERT INTO pay_slips VALUES (34, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:52:36', '2023-04-11 04:52:36');
INSERT INTO pay_slips VALUES (35, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:52:56', '2023-04-11 04:52:56');
INSERT INTO pay_slips VALUES (36, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:53:17', '2023-04-11 04:53:17');
INSERT INTO pay_slips VALUES (37, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 04:53:27', '2023-04-11 04:53:27');
INSERT INTO pay_slips VALUES (38, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 05:31:00', '2023-04-11 05:31:00');
INSERT INTO pay_slips VALUES (39, 1, 'Payslip accountant 2023-04.pdf', 4987500, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 05:31:42', '2023-04-11 05:31:42');
INSERT INTO pay_slips VALUES (40, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 06:53:26', '2023-04-11 06:53:26');
INSERT INTO pay_slips VALUES (41, 1, 'Payslip accountant 2023-04.pdf', 5000000, '2023-04', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', NULL, NULL, '[]', 2, '2023-04-11 06:53:49', '2023-04-11 06:53:49');
INSERT INTO pay_slips VALUES (42, 1, 'Payslip accountant 2023-06.pdf', 4750000, '2023-06', 1, '[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-04-10T21:23:22.000000Z","updated_at":"2023-04-10T21:23:22.000000Z"}]', 5000000, '[]', '[]', '[]', '[]', '[]', '{"type":"Percentage","value":"2","maximum_salary":"5000000"}', NULL, '[]', 2, '2023-06-29 01:18:30', '2023-06-29 01:18:30');
INSERT INTO pay_slips VALUES (43, 3, 'Payslip Suali 2023-07.pdf', 9900000, '2023-07', 1, '[{"id":2,"employee_id":3,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-07-02T11:14:45.000000Z","updated_at":"2023-07-02T11:14:45.000000Z"}]', 5000000, '[{"id":1,"employee_id":3,"allowance_type_id":1,"amount":1500000,"created_by":2,"created_at":"2023-07-02T11:15:02.000000Z","updated_at":"2023-07-02T11:15:02.000000Z"},{"id":2,"employee_id":3,"allowance_type_id":2,"amount":1000000,"created_by":2,"created_at":"2023-07-02T11:15:29.000000Z","updated_at":"2023-07-02T11:15:29.000000Z"},{"id":3,"employee_id":3,"allowance_type_id":3,"amount":500000,"created_by":2,"created_at":"2023-07-02T11:15:51.000000Z","updated_at":"2023-07-02T11:15:51.000000Z"},{"id":4,"employee_id":3,"allowance_type_id":4,"amount":2000000,"created_by":2,"created_at":"2023-07-02T11:16:11.000000Z","updated_at":"2023-07-02T11:16:11.000000Z"}]', '[]', '[]', '[]', '[]', '{"type":"Percentage","value":"2","maximum_salary":"5000000"}', NULL, '[]', 2, '2023-07-02 18:18:27', '2023-07-02 18:18:27');
INSERT INTO pay_slips VALUES (44, 5, 'Payslip coba 2023-07.pdf', 7235000, '2023-07', 1, '[{"id":4,"employee_id":5,"payslip_type_id":1,"amount":6500000,"created_by":2,"created_at":"2023-07-02T12:47:55.000000Z","updated_at":"2023-07-02T12:47:55.000000Z"}]', 6500000, '[{"id":9,"employee_id":5,"allowance_type_id":1,"amount":500000,"created_by":2,"created_at":"2023-07-02T12:49:00.000000Z","updated_at":"2023-07-02T12:49:00.000000Z"},{"id":10,"employee_id":5,"allowance_type_id":2,"amount":300000,"created_by":2,"created_at":"2023-07-02T12:49:17.000000Z","updated_at":"2023-07-02T12:49:17.000000Z"}]', '[]', '[]', '[]', '[]', '{"type":"Percentage","value":"1","maximum_salary":"12000000"}', NULL, '[]', 2, '2023-07-02 19:50:14', '2023-07-02 19:50:14');


--
-- Name: pay_slips_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('pay_slips_id_seq', 44, true);


--
-- Data for Name: payrolls; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO payrolls VALUES (1, 1, 1, 5000000, 2, '2023-04-11 04:23:22', '2023-04-11 04:23:22');
INSERT INTO payrolls VALUES (2, 3, 1, 5000000, 2, '2023-07-02 18:14:45', '2023-07-02 18:14:45');
INSERT INTO payrolls VALUES (3, 2, 1, 7000000, 2, '2023-07-02 18:40:39', '2023-07-02 18:40:39');
INSERT INTO payrolls VALUES (4, 5, 1, 6500000, 2, '2023-07-02 19:47:55', '2023-07-02 19:47:55');


--
-- Name: payrolls_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('payrolls_id_seq', 4, true);


--
-- Data for Name: payslip_code_pins; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO payslip_code_pins VALUES (1, NULL, '$2y$10$tnhQRswwEDtcgyiqtPsmy.viY6R6OFWbLgcI.HBf/cBMlXp7cZtvW', 2, '2023-04-11 04:23:39', '2023-06-29 01:18:14');


--
-- Name: payslip_code_pins_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('payslip_code_pins_id_seq', 1, true);


--
-- Data for Name: payslip_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO payslip_types VALUES (1, 'Gaji Pokok', 'monthly', 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');


--
-- Name: payslip_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('payslip_types_id_seq', 1, true);


--
-- Data for Name: performance_reviews; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: performance_reviews_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('performance_reviews_id_seq', 1, false);


--
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO permissions VALUES (1, 'show hrm dashboard', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (2, 'copy invoice', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (3, 'show project dashboard', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (4, 'show account dashboard', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (5, 'manage user', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (6, 'create user', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (7, 'edit user', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (8, 'delete user', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (9, 'create language', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (10, 'manage role', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (11, 'create role', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (12, 'edit role', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (13, 'delete role', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (14, 'manage permission', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (15, 'create permission', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (16, 'edit permission', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (17, 'delete permission', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (18, 'manage company settings', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (19, 'manage print settings', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (20, 'manage business settings', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (21, 'manage stripe settings', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (22, 'manage expense', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (23, 'create expense', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (24, 'edit expense', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (25, 'delete expense', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (26, 'manage invoice', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (27, 'create invoice', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (28, 'edit invoice', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (29, 'delete invoice', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (30, 'show invoice', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (31, 'create payment invoice', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (32, 'delete payment invoice', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (33, 'send invoice', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (34, 'delete invoice product', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (35, 'convert invoice', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (36, 'manage constant unit', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (37, 'create constant unit', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (38, 'edit constant unit', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (39, 'delete constant unit', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (40, 'manage constant tax', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (41, 'create constant tax', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (42, 'edit constant tax', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (43, 'delete constant tax', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (44, 'manage constant category', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (45, 'create constant category', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (46, 'edit constant category', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (47, 'delete constant category', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (48, 'manage product & service', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (49, 'create product & service', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (50, 'edit product & service', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (51, 'delete product & service', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (52, 'manage customer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (53, 'create customer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (54, 'edit customer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (55, 'delete customer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (56, 'show customer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (57, 'manage vender', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (58, 'create vender', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (59, 'edit vender', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (60, 'delete vender', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (61, 'show vender', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (62, 'manage bank account', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (63, 'create bank account', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (64, 'edit bank account', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (65, 'delete bank account', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (66, 'manage bank transfer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (67, 'create bank transfer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (68, 'edit bank transfer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (69, 'delete bank transfer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (70, 'manage transaction', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (71, 'manage revenue', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (72, 'create revenue', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (73, 'edit revenue', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (74, 'delete revenue', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (75, 'manage bill', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (76, 'create bill', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (77, 'edit bill', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (78, 'delete bill', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (79, 'show bill', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (80, 'manage payment', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (81, 'create payment', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (82, 'edit payment', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (83, 'delete payment', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (84, 'delete bill product', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (85, 'send bill', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (86, 'create payment bill', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (87, 'delete payment bill', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (88, 'manage order', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (89, 'income report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (90, 'expense report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (91, 'income vs expense report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (92, 'invoice report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (93, 'bill report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (94, 'stock report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (95, 'tax report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (96, 'loss & profit report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (97, 'manage customer payment', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (98, 'manage customer transaction', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (99, 'manage customer invoice', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (100, 'vender manage bill', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (101, 'manage vender bill', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (102, 'manage vender payment', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (103, 'manage vender transaction', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (104, 'manage credit note', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (105, 'create credit note', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (106, 'edit credit note', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (107, 'delete credit note', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (108, 'manage debit note', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (109, 'create debit note', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (110, 'edit debit note', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (111, 'delete debit note', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (112, 'duplicate invoice', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (113, 'duplicate bill', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (114, 'manage proposal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (115, 'create proposal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (116, 'edit proposal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (117, 'delete proposal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (118, 'duplicate proposal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (119, 'show proposal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (120, 'send proposal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (121, 'delete proposal product', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (122, 'manage customer proposal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (123, 'manage goal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (124, 'create goal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (125, 'edit goal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (126, 'delete goal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (127, 'manage assets', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (128, 'create assets', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (129, 'edit assets', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (130, 'delete assets', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (131, 'statement report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (132, 'manage constant custom field', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (133, 'create constant custom field', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (134, 'edit constant custom field', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (135, 'delete constant custom field', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (136, 'manage chart of account', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (137, 'create chart of account', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (138, 'edit chart of account', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (139, 'delete chart of account', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (140, 'manage journal entry', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (141, 'create journal entry', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (142, 'edit journal entry', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (143, 'delete journal entry', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (144, 'show journal entry', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (145, 'balance sheet report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (146, 'ledger report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (147, 'trial balance report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (148, 'manage client', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (149, 'create client', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (150, 'edit client', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (151, 'delete client', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (152, 'manage lead', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (153, 'create lead', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (154, 'view lead', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (155, 'edit lead', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (156, 'delete lead', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (157, 'move lead', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (158, 'create lead call', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (159, 'edit lead call', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (160, 'delete lead call', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (161, 'create lead email', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (162, 'manage pipeline', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (163, 'create pipeline', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (164, 'edit pipeline', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (165, 'delete pipeline', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (166, 'manage lead stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (167, 'create lead stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (168, 'edit lead stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (169, 'delete lead stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (170, 'convert lead to deal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (171, 'manage source', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (172, 'create source', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (173, 'edit source', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (174, 'delete source', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (175, 'manage label', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (176, 'create label', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (177, 'edit label', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (178, 'delete label', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (179, 'manage deal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (180, 'create deal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (181, 'view task', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (182, 'create task', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (183, 'edit task', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (184, 'delete task', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (185, 'edit deal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (186, 'view deal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (187, 'delete deal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (188, 'move deal', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (189, 'create deal call', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (190, 'edit deal call', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (191, 'delete deal call', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (192, 'create deal email', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (193, 'manage stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (194, 'create stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (195, 'edit stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (196, 'delete stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (197, 'manage employee', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (198, 'create employee', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (199, 'view employee', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (200, 'edit employee', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (201, 'delete employee', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (202, 'manage employee profile', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (203, 'show employee profile', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (204, 'manage department', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (205, 'create department', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (206, 'view department', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (207, 'edit department', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (208, 'delete department', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (209, 'manage designation', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (210, 'create designation', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (211, 'view designation', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (212, 'edit designation', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (213, 'delete designation', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (214, 'manage branch', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (215, 'create branch', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (216, 'edit branch', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (217, 'delete branch', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (218, 'manage document type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (219, 'create document type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (220, 'edit document type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (221, 'delete document type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (222, 'manage document', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (223, 'create document', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (224, 'edit document', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (225, 'delete document', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (226, 'manage payslip type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (227, 'create payslip type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (228, 'edit payslip type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (229, 'delete payslip type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (230, 'manage payslip', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (231, 'generate payslip', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (232, 'create reimbursement', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (233, 'edit reimbursement', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (234, 'delete reimbursement', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (235, 'create commission', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (236, 'edit commission', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (237, 'delete commission', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (238, 'manage reimbursement option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (239, 'create reimbursement option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (240, 'edit reimbursement option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (241, 'delete reimbursement option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (242, 'manage loan option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (243, 'create loan option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (244, 'edit loan option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (245, 'delete loan option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (246, 'manage deduction option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (247, 'create deduction option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (248, 'edit deduction option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (249, 'delete deduction option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (250, 'manage loan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (251, 'create loan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (252, 'edit loan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (253, 'delete loan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (254, 'create saturation deduction', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (255, 'edit saturation deduction', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (256, 'delete saturation deduction', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (257, 'create other payment', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (258, 'edit other payment', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (259, 'delete other payment', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (260, 'manage overtime', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (261, 'create overtime', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (262, 'edit overtime', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (263, 'delete overtime', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (264, 'manage day type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (265, 'create day type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (266, 'edit day type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (267, 'delete day type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (268, 'manage overtime type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (269, 'create overtime type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (270, 'edit overtime type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (271, 'delete overtime type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (272, 'manage set salary', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (273, 'edit set salary', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (274, 'manage pay slip', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (275, 'create set salary', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (276, 'create pay slip', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (277, 'manage company policy', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (278, 'create company policy', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (279, 'edit company policy', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (280, 'manage performance review', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (281, 'create performance review', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (282, 'edit performance review', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (283, 'show performance review', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (284, 'delete performance review', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (285, 'manage goal tracking', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (286, 'create goal tracking', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (287, 'edit goal tracking', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (288, 'delete goal tracking', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (289, 'manage goal type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (290, 'create goal type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (291, 'edit goal type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (292, 'delete goal type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (293, 'manage indicator', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (294, 'create indicator', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (295, 'edit indicator', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (296, 'show indicator', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (297, 'delete indicator', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (298, 'manage training', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (299, 'create training', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (300, 'edit training', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (301, 'delete training', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (302, 'show training', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (303, 'manage trainer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (304, 'create trainer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (305, 'edit trainer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (306, 'delete trainer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (307, 'manage training type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (308, 'create training type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (309, 'edit training type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (310, 'delete training type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (311, 'manage award', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (312, 'create award', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (313, 'edit award', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (314, 'delete award', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (315, 'manage award type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (316, 'create award type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (317, 'edit award type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (318, 'delete award type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (319, 'manage resignation', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (320, 'create resignation', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (321, 'edit resignation', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (322, 'delete resignation', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (323, 'manage on duty', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (324, 'create on duty', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (325, 'edit on duty', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (326, 'delete on duty', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (327, 'manage promotion', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (328, 'create promotion', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (329, 'edit promotion', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (330, 'delete promotion', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (331, 'manage complaint', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (332, 'create complaint', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (333, 'edit complaint', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (334, 'delete complaint', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (335, 'manage warning', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (336, 'create warning', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (337, 'edit warning', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (338, 'delete warning', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (339, 'manage termination', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (340, 'create termination', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (341, 'edit termination', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (342, 'delete termination', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (343, 'manage termination type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (344, 'create termination type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (345, 'edit termination type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (346, 'delete termination type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (347, 'manage job application', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (348, 'create job application', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (349, 'show job application', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (350, 'delete job application', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (351, 'move job application', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (352, 'add job application skill', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (353, 'add job application note', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (354, 'delete job application note', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (355, 'manage job onBoard', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (356, 'manage job category', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (357, 'create job category', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (358, 'edit job category', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (359, 'delete job category', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (360, 'manage job', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (361, 'create job', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (362, 'edit job', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (363, 'show job', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (364, 'delete job', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (365, 'manage job stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (366, 'create job stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (367, 'edit job stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (368, 'delete job stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (369, 'Manage Competencies', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (370, 'Create Competencies', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (371, 'Edit Competencies', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (372, 'Delete Competencies', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (373, 'manage custom question', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (374, 'create custom question', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (375, 'edit custom question', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (376, 'delete custom question', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (377, 'create interview schedule', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (378, 'edit interview schedule', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (379, 'delete interview schedule', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (380, 'show interview schedule', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (381, 'create estimation', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (382, 'view estimation', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (383, 'edit estimation', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (384, 'delete estimation', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (385, 'edit holiday', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (386, 'create holiday', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (387, 'delete holiday', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (388, 'manage holiday', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (389, 'show career', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (390, 'manage meeting', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (391, 'create meeting', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (392, 'edit meeting', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (393, 'delete meeting', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (394, 'manage event', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (395, 'create event', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (396, 'edit event', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (397, 'delete event', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (398, 'manage transfer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (399, 'create transfer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (400, 'edit transfer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (401, 'delete transfer', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (402, 'manage announcement', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (403, 'create announcement', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (404, 'edit announcement', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (405, 'delete announcement', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (406, 'manage leave', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (407, 'create leave', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (408, 'edit leave', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (409, 'delete leave', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (410, 'manage leave type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (411, 'create leave type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (412, 'edit leave type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (413, 'delete leave type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (414, 'manage attendance', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (415, 'create attendance', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (416, 'edit attendance', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (417, 'delete attendance', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (418, 'manage report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (419, 'manage project', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (420, 'create project', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (421, 'view project', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (422, 'edit project', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (423, 'delete project', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (424, 'create milestone', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (425, 'edit milestone', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (426, 'delete milestone', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (427, 'view milestone', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (428, 'view grant chart', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (429, 'manage project stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (430, 'create project stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (431, 'edit project stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (432, 'delete project stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (433, 'view expense', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (434, 'manage project task', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (435, 'create project task', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (436, 'edit project task', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (437, 'view project task', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (438, 'delete project task', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (439, 'view activity', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (440, 'view CRM activity', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (441, 'manage project task stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (442, 'edit project task stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (443, 'create project task stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (444, 'delete project task stage', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (445, 'manage timesheet', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (446, 'create timesheet', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (447, 'edit timesheet', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (448, 'delete timesheet', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (449, 'manage bug report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (450, 'create bug report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (451, 'edit bug report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (452, 'delete bug report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (453, 'move bug report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (454, 'manage bug status', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (455, 'create bug status', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (456, 'edit bug status', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (457, 'delete bug status', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (458, 'manage client dashboard', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (459, 'manage super admin dashboard', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (460, 'manage system settings', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (461, 'manage plan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (462, 'create plan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (463, 'edit plan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (464, 'manage coupon', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (465, 'create coupon', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (466, 'edit coupon', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (467, 'delete coupon', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (468, 'manage company plan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (469, 'buy plan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (470, 'manage form builder', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (471, 'create form builder', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (472, 'edit form builder', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (473, 'delete form builder', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (474, 'manage performance type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (475, 'create performance type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (476, 'edit performance type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (477, 'delete performance type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (478, 'manage form field', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (479, 'create form field', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (480, 'edit form field', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (481, 'delete form field', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (482, 'view form response', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (483, 'create budget plan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (484, 'edit budget plan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (485, 'manage budget plan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (486, 'delete budget plan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (487, 'view budget plan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (488, 'manage warehouse', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (489, 'create warehouse', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (490, 'edit warehouse', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (491, 'show warehouse', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (492, 'delete warehouse', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (493, 'manage purchase', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (494, 'create purchase', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (495, 'edit purchase', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (496, 'show employee request', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (497, 'manage employee request', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (498, 'show purchase', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (499, 'delete purchase', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (500, 'send purchase', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (501, 'create payment purchase', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (502, 'manage pos', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (503, 'manage contract type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (504, 'create contract type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (505, 'edit contract type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (506, 'delete contract type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (507, 'manage shift type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (508, 'create shift type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (509, 'edit shift type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (510, 'delete shift type', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (511, 'manage request shift schedule', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (512, 'show shift schedule', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (513, 'create shift schedule', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (514, 'edit shift schedule', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (515, 'delete shift schedule', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (516, 'create request shift schedule', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (517, 'edit request shift schedule', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (518, 'delete request shift schedule', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (519, 'manage contract', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (520, 'create contract', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (521, 'edit contract', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (522, 'delete contract', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (523, 'show contract', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (524, 'show time management report', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (525, 'manage payroll', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (526, 'create payroll', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (527, 'edit payroll', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (528, 'delete payroll', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (529, 'show payroll', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (530, 'manage reimburst', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (531, 'create reimburst', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (532, 'edit reimburst', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (533, 'delete reimburst', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (534, 'show reimburst', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (535, 'manage cash', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (536, 'create cash', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (537, 'edit cash', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (538, 'delete cash', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (539, 'manage cash advance', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (540, 'create cash advance', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (541, 'edit cash advance', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (542, 'delete cash advance', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (543, 'show cash', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (544, 'manage allowance', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (545, 'create allowance', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (546, 'edit allowance', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (547, 'delete allowance', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (548, 'manage allowance option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (549, 'create allowance option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (550, 'edit allowance option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (551, 'delete allowance option', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (552, 'manage denda', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (553, 'create denda', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (554, 'edit denda', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (555, 'delete denda', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (556, 'manage setting payroll overtime', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (557, 'create setting payroll overtime', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (558, 'edit setting payroll overtime', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (559, 'delete setting payroll overtime', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (560, 'manage bpjs kesehatan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (561, 'create bpjs kesehatan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (562, 'edit bpjs kesehatan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (563, 'delete bpjs kesehatan', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (564, 'manage pph21', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (565, 'edit pph21', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (566, 'manage jht', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (567, 'edit jht', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (568, 'manage jkk', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (569, 'edit jkk', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (570, 'manage jkm', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (571, 'edit jkm', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (572, 'manage jp', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (573, 'edit jp', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (574, 'manage dayoff', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (575, 'create dayoff', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (576, 'edit dayoff', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (577, 'delete dayoff', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (578, 'manage company holiday', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (579, 'create company holiday', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (580, 'edit company holiday', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (581, 'delete company holiday', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (582, 'manage payslip code pin', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (583, 'edit payslip code pin', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (584, 'manage payslip checklist attendance summary', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (585, 'edit payslip checklist attendance summary', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (586, 'manage level approval', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (587, 'edit level approval', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (588, 'manage ptkp', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (589, 'edit ptkp', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (590, 'manage set ptkp', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (591, 'create set ptkp', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (592, 'edit set ptkp', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (593, 'delete set ptkp', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (594, 'show allowance', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO permissions VALUES (595, 'view history leave', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13');


--
-- Name: permissions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('permissions_id_seq', 595, true);


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('personal_access_tokens_id_seq', 1, false);


--
-- Data for Name: project_users; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: project_users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('project_users_id_seq', 1, false);


--
-- Data for Name: projects; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: projects_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('projects_id_seq', 1, false);


--
-- Data for Name: ptkp; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO ptkp VALUES (1, 'tk_0', 54000000, 2, NULL, NULL);
INSERT INTO ptkp VALUES (2, 'tk_1', 58500000, 2, NULL, NULL);
INSERT INTO ptkp VALUES (3, 'tk_2', 63000000, 2, NULL, NULL);
INSERT INTO ptkp VALUES (4, 'tk_3', 67500000, 2, NULL, NULL);
INSERT INTO ptkp VALUES (5, 'k_0', 58500000, 2, NULL, NULL);
INSERT INTO ptkp VALUES (6, 'k_1', 63000000, 2, NULL, NULL);
INSERT INTO ptkp VALUES (7, 'k_2', 67500000, 2, NULL, NULL);
INSERT INTO ptkp VALUES (8, 'k_3', 72000000, 2, NULL, NULL);


--
-- Name: ptkp_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('ptkp_id_seq', 8, true);


--
-- Data for Name: reimburstment_options; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO reimburstment_options VALUES (1, 'OPERATION', 2, '2023-05-07 13:29:37', '2023-05-07 13:29:37');
INSERT INTO reimburstment_options VALUES (2, 'BUSINESS TRAVELLING', 2, '2023-05-07 13:29:44', '2023-05-07 13:29:44');
INSERT INTO reimburstment_options VALUES (3, 'PROJECT', 2, '2023-05-07 13:29:49', '2023-05-07 13:29:49');
INSERT INTO reimburstment_options VALUES (4, 'Fixed Assets', 2, '2023-05-07 13:30:04', '2023-05-07 13:30:04');


--
-- Name: reimburstment_options_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('reimburstment_options_id_seq', 5, true);


--
-- Data for Name: reimbursts; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: reimbursts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('reimbursts_id_seq', 1, false);


--
-- Data for Name: req_shift_schedules; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: req_shift_schedules_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('req_shift_schedules_id_seq', 1, false);


--
-- Data for Name: request_shift_schedule_approvals; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: request_shift_schedule_approvals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('request_shift_schedule_approvals_id_seq', 1, false);


--
-- Data for Name: role_has_permissions; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO role_has_permissions VALUES (459, 1);
INSERT INTO role_has_permissions VALUES (5, 1);
INSERT INTO role_has_permissions VALUES (6, 1);
INSERT INTO role_has_permissions VALUES (7, 1);
INSERT INTO role_has_permissions VALUES (8, 1);
INSERT INTO role_has_permissions VALUES (9, 1);
INSERT INTO role_has_permissions VALUES (460, 1);
INSERT INTO role_has_permissions VALUES (21, 1);
INSERT INTO role_has_permissions VALUES (14, 1);
INSERT INTO role_has_permissions VALUES (15, 1);
INSERT INTO role_has_permissions VALUES (16, 1);
INSERT INTO role_has_permissions VALUES (17, 1);
INSERT INTO role_has_permissions VALUES (461, 1);
INSERT INTO role_has_permissions VALUES (462, 1);
INSERT INTO role_has_permissions VALUES (463, 1);
INSERT INTO role_has_permissions VALUES (88, 1);
INSERT INTO role_has_permissions VALUES (464, 1);
INSERT INTO role_has_permissions VALUES (465, 1);
INSERT INTO role_has_permissions VALUES (466, 1);
INSERT INTO role_has_permissions VALUES (467, 1);
INSERT INTO role_has_permissions VALUES (1, 2);
INSERT INTO role_has_permissions VALUES (496, 2);
INSERT INTO role_has_permissions VALUES (497, 2);
INSERT INTO role_has_permissions VALUES (524, 2);
INSERT INTO role_has_permissions VALUES (3, 2);
INSERT INTO role_has_permissions VALUES (4, 2);
INSERT INTO role_has_permissions VALUES (5, 2);
INSERT INTO role_has_permissions VALUES (6, 2);
INSERT INTO role_has_permissions VALUES (7, 2);
INSERT INTO role_has_permissions VALUES (8, 2);
INSERT INTO role_has_permissions VALUES (10, 2);
INSERT INTO role_has_permissions VALUES (11, 2);
INSERT INTO role_has_permissions VALUES (12, 2);
INSERT INTO role_has_permissions VALUES (13, 2);
INSERT INTO role_has_permissions VALUES (14, 2);
INSERT INTO role_has_permissions VALUES (15, 2);
INSERT INTO role_has_permissions VALUES (16, 2);
INSERT INTO role_has_permissions VALUES (17, 2);
INSERT INTO role_has_permissions VALUES (18, 2);
INSERT INTO role_has_permissions VALUES (20, 2);
INSERT INTO role_has_permissions VALUES (22, 2);
INSERT INTO role_has_permissions VALUES (23, 2);
INSERT INTO role_has_permissions VALUES (24, 2);
INSERT INTO role_has_permissions VALUES (25, 2);
INSERT INTO role_has_permissions VALUES (26, 2);
INSERT INTO role_has_permissions VALUES (27, 2);
INSERT INTO role_has_permissions VALUES (28, 2);
INSERT INTO role_has_permissions VALUES (29, 2);
INSERT INTO role_has_permissions VALUES (30, 2);
INSERT INTO role_has_permissions VALUES (48, 2);
INSERT INTO role_has_permissions VALUES (49, 2);
INSERT INTO role_has_permissions VALUES (51, 2);
INSERT INTO role_has_permissions VALUES (50, 2);
INSERT INTO role_has_permissions VALUES (40, 2);
INSERT INTO role_has_permissions VALUES (41, 2);
INSERT INTO role_has_permissions VALUES (42, 2);
INSERT INTO role_has_permissions VALUES (43, 2);
INSERT INTO role_has_permissions VALUES (44, 2);
INSERT INTO role_has_permissions VALUES (45, 2);
INSERT INTO role_has_permissions VALUES (46, 2);
INSERT INTO role_has_permissions VALUES (47, 2);
INSERT INTO role_has_permissions VALUES (36, 2);
INSERT INTO role_has_permissions VALUES (37, 2);
INSERT INTO role_has_permissions VALUES (38, 2);
INSERT INTO role_has_permissions VALUES (39, 2);
INSERT INTO role_has_permissions VALUES (52, 2);
INSERT INTO role_has_permissions VALUES (53, 2);
INSERT INTO role_has_permissions VALUES (54, 2);
INSERT INTO role_has_permissions VALUES (55, 2);
INSERT INTO role_has_permissions VALUES (56, 2);
INSERT INTO role_has_permissions VALUES (57, 2);
INSERT INTO role_has_permissions VALUES (58, 2);
INSERT INTO role_has_permissions VALUES (59, 2);
INSERT INTO role_has_permissions VALUES (60, 2);
INSERT INTO role_has_permissions VALUES (61, 2);
INSERT INTO role_has_permissions VALUES (62, 2);
INSERT INTO role_has_permissions VALUES (63, 2);
INSERT INTO role_has_permissions VALUES (64, 2);
INSERT INTO role_has_permissions VALUES (65, 2);
INSERT INTO role_has_permissions VALUES (66, 2);
INSERT INTO role_has_permissions VALUES (67, 2);
INSERT INTO role_has_permissions VALUES (68, 2);
INSERT INTO role_has_permissions VALUES (69, 2);
INSERT INTO role_has_permissions VALUES (71, 2);
INSERT INTO role_has_permissions VALUES (72, 2);
INSERT INTO role_has_permissions VALUES (73, 2);
INSERT INTO role_has_permissions VALUES (74, 2);
INSERT INTO role_has_permissions VALUES (75, 2);
INSERT INTO role_has_permissions VALUES (76, 2);
INSERT INTO role_has_permissions VALUES (77, 2);
INSERT INTO role_has_permissions VALUES (78, 2);
INSERT INTO role_has_permissions VALUES (79, 2);
INSERT INTO role_has_permissions VALUES (80, 2);
INSERT INTO role_has_permissions VALUES (81, 2);
INSERT INTO role_has_permissions VALUES (82, 2);
INSERT INTO role_has_permissions VALUES (83, 2);
INSERT INTO role_has_permissions VALUES (34, 2);
INSERT INTO role_has_permissions VALUES (84, 2);
INSERT INTO role_has_permissions VALUES (33, 2);
INSERT INTO role_has_permissions VALUES (31, 2);
INSERT INTO role_has_permissions VALUES (32, 2);
INSERT INTO role_has_permissions VALUES (85, 2);
INSERT INTO role_has_permissions VALUES (86, 2);
INSERT INTO role_has_permissions VALUES (87, 2);
INSERT INTO role_has_permissions VALUES (89, 2);
INSERT INTO role_has_permissions VALUES (90, 2);
INSERT INTO role_has_permissions VALUES (91, 2);
INSERT INTO role_has_permissions VALUES (92, 2);
INSERT INTO role_has_permissions VALUES (93, 2);
INSERT INTO role_has_permissions VALUES (94, 2);
INSERT INTO role_has_permissions VALUES (95, 2);
INSERT INTO role_has_permissions VALUES (96, 2);
INSERT INTO role_has_permissions VALUES (70, 2);
INSERT INTO role_has_permissions VALUES (88, 2);
INSERT INTO role_has_permissions VALUES (104, 2);
INSERT INTO role_has_permissions VALUES (105, 2);
INSERT INTO role_has_permissions VALUES (106, 2);
INSERT INTO role_has_permissions VALUES (107, 2);
INSERT INTO role_has_permissions VALUES (108, 2);
INSERT INTO role_has_permissions VALUES (109, 2);
INSERT INTO role_has_permissions VALUES (110, 2);
INSERT INTO role_has_permissions VALUES (111, 2);
INSERT INTO role_has_permissions VALUES (112, 2);
INSERT INTO role_has_permissions VALUES (35, 2);
INSERT INTO role_has_permissions VALUES (113, 2);
INSERT INTO role_has_permissions VALUES (114, 2);
INSERT INTO role_has_permissions VALUES (115, 2);
INSERT INTO role_has_permissions VALUES (116, 2);
INSERT INTO role_has_permissions VALUES (117, 2);
INSERT INTO role_has_permissions VALUES (118, 2);
INSERT INTO role_has_permissions VALUES (119, 2);
INSERT INTO role_has_permissions VALUES (120, 2);
INSERT INTO role_has_permissions VALUES (121, 2);
INSERT INTO role_has_permissions VALUES (123, 2);
INSERT INTO role_has_permissions VALUES (124, 2);
INSERT INTO role_has_permissions VALUES (125, 2);
INSERT INTO role_has_permissions VALUES (126, 2);
INSERT INTO role_has_permissions VALUES (127, 2);
INSERT INTO role_has_permissions VALUES (128, 2);
INSERT INTO role_has_permissions VALUES (129, 2);
INSERT INTO role_has_permissions VALUES (130, 2);
INSERT INTO role_has_permissions VALUES (131, 2);
INSERT INTO role_has_permissions VALUES (132, 2);
INSERT INTO role_has_permissions VALUES (133, 2);
INSERT INTO role_has_permissions VALUES (134, 2);
INSERT INTO role_has_permissions VALUES (135, 2);
INSERT INTO role_has_permissions VALUES (136, 2);
INSERT INTO role_has_permissions VALUES (137, 2);
INSERT INTO role_has_permissions VALUES (138, 2);
INSERT INTO role_has_permissions VALUES (139, 2);
INSERT INTO role_has_permissions VALUES (140, 2);
INSERT INTO role_has_permissions VALUES (141, 2);
INSERT INTO role_has_permissions VALUES (142, 2);
INSERT INTO role_has_permissions VALUES (143, 2);
INSERT INTO role_has_permissions VALUES (144, 2);
INSERT INTO role_has_permissions VALUES (145, 2);
INSERT INTO role_has_permissions VALUES (146, 2);
INSERT INTO role_has_permissions VALUES (147, 2);
INSERT INTO role_has_permissions VALUES (148, 2);
INSERT INTO role_has_permissions VALUES (149, 2);
INSERT INTO role_has_permissions VALUES (150, 2);
INSERT INTO role_has_permissions VALUES (151, 2);
INSERT INTO role_has_permissions VALUES (152, 2);
INSERT INTO role_has_permissions VALUES (153, 2);
INSERT INTO role_has_permissions VALUES (154, 2);
INSERT INTO role_has_permissions VALUES (155, 2);
INSERT INTO role_has_permissions VALUES (156, 2);
INSERT INTO role_has_permissions VALUES (157, 2);
INSERT INTO role_has_permissions VALUES (158, 2);
INSERT INTO role_has_permissions VALUES (159, 2);
INSERT INTO role_has_permissions VALUES (160, 2);
INSERT INTO role_has_permissions VALUES (161, 2);
INSERT INTO role_has_permissions VALUES (162, 2);
INSERT INTO role_has_permissions VALUES (163, 2);
INSERT INTO role_has_permissions VALUES (164, 2);
INSERT INTO role_has_permissions VALUES (165, 2);
INSERT INTO role_has_permissions VALUES (166, 2);
INSERT INTO role_has_permissions VALUES (167, 2);
INSERT INTO role_has_permissions VALUES (168, 2);
INSERT INTO role_has_permissions VALUES (169, 2);
INSERT INTO role_has_permissions VALUES (170, 2);
INSERT INTO role_has_permissions VALUES (171, 2);
INSERT INTO role_has_permissions VALUES (172, 2);
INSERT INTO role_has_permissions VALUES (173, 2);
INSERT INTO role_has_permissions VALUES (174, 2);
INSERT INTO role_has_permissions VALUES (175, 2);
INSERT INTO role_has_permissions VALUES (176, 2);
INSERT INTO role_has_permissions VALUES (177, 2);
INSERT INTO role_has_permissions VALUES (178, 2);
INSERT INTO role_has_permissions VALUES (179, 2);
INSERT INTO role_has_permissions VALUES (180, 2);
INSERT INTO role_has_permissions VALUES (181, 2);
INSERT INTO role_has_permissions VALUES (182, 2);
INSERT INTO role_has_permissions VALUES (183, 2);
INSERT INTO role_has_permissions VALUES (184, 2);
INSERT INTO role_has_permissions VALUES (185, 2);
INSERT INTO role_has_permissions VALUES (186, 2);
INSERT INTO role_has_permissions VALUES (187, 2);
INSERT INTO role_has_permissions VALUES (188, 2);
INSERT INTO role_has_permissions VALUES (189, 2);
INSERT INTO role_has_permissions VALUES (190, 2);
INSERT INTO role_has_permissions VALUES (191, 2);
INSERT INTO role_has_permissions VALUES (192, 2);
INSERT INTO role_has_permissions VALUES (193, 2);
INSERT INTO role_has_permissions VALUES (194, 2);
INSERT INTO role_has_permissions VALUES (195, 2);
INSERT INTO role_has_permissions VALUES (196, 2);
INSERT INTO role_has_permissions VALUES (197, 2);
INSERT INTO role_has_permissions VALUES (198, 2);
INSERT INTO role_has_permissions VALUES (199, 2);
INSERT INTO role_has_permissions VALUES (200, 2);
INSERT INTO role_has_permissions VALUES (201, 2);
INSERT INTO role_has_permissions VALUES (202, 2);
INSERT INTO role_has_permissions VALUES (203, 2);
INSERT INTO role_has_permissions VALUES (204, 2);
INSERT INTO role_has_permissions VALUES (205, 2);
INSERT INTO role_has_permissions VALUES (206, 2);
INSERT INTO role_has_permissions VALUES (207, 2);
INSERT INTO role_has_permissions VALUES (208, 2);
INSERT INTO role_has_permissions VALUES (209, 2);
INSERT INTO role_has_permissions VALUES (210, 2);
INSERT INTO role_has_permissions VALUES (211, 2);
INSERT INTO role_has_permissions VALUES (212, 2);
INSERT INTO role_has_permissions VALUES (213, 2);
INSERT INTO role_has_permissions VALUES (214, 2);
INSERT INTO role_has_permissions VALUES (215, 2);
INSERT INTO role_has_permissions VALUES (216, 2);
INSERT INTO role_has_permissions VALUES (217, 2);
INSERT INTO role_has_permissions VALUES (218, 2);
INSERT INTO role_has_permissions VALUES (219, 2);
INSERT INTO role_has_permissions VALUES (220, 2);
INSERT INTO role_has_permissions VALUES (221, 2);
INSERT INTO role_has_permissions VALUES (222, 2);
INSERT INTO role_has_permissions VALUES (223, 2);
INSERT INTO role_has_permissions VALUES (224, 2);
INSERT INTO role_has_permissions VALUES (226, 2);
INSERT INTO role_has_permissions VALUES (227, 2);
INSERT INTO role_has_permissions VALUES (228, 2);
INSERT INTO role_has_permissions VALUES (229, 2);
INSERT INTO role_has_permissions VALUES (230, 2);
INSERT INTO role_has_permissions VALUES (231, 2);
INSERT INTO role_has_permissions VALUES (232, 2);
INSERT INTO role_has_permissions VALUES (233, 2);
INSERT INTO role_has_permissions VALUES (234, 2);
INSERT INTO role_has_permissions VALUES (235, 2);
INSERT INTO role_has_permissions VALUES (236, 2);
INSERT INTO role_has_permissions VALUES (237, 2);
INSERT INTO role_has_permissions VALUES (238, 2);
INSERT INTO role_has_permissions VALUES (239, 2);
INSERT INTO role_has_permissions VALUES (240, 2);
INSERT INTO role_has_permissions VALUES (241, 2);
INSERT INTO role_has_permissions VALUES (242, 2);
INSERT INTO role_has_permissions VALUES (243, 2);
INSERT INTO role_has_permissions VALUES (244, 2);
INSERT INTO role_has_permissions VALUES (245, 2);
INSERT INTO role_has_permissions VALUES (246, 2);
INSERT INTO role_has_permissions VALUES (247, 2);
INSERT INTO role_has_permissions VALUES (248, 2);
INSERT INTO role_has_permissions VALUES (249, 2);
INSERT INTO role_has_permissions VALUES (250, 2);
INSERT INTO role_has_permissions VALUES (251, 2);
INSERT INTO role_has_permissions VALUES (252, 2);
INSERT INTO role_has_permissions VALUES (253, 2);
INSERT INTO role_has_permissions VALUES (254, 2);
INSERT INTO role_has_permissions VALUES (255, 2);
INSERT INTO role_has_permissions VALUES (256, 2);
INSERT INTO role_has_permissions VALUES (257, 2);
INSERT INTO role_has_permissions VALUES (258, 2);
INSERT INTO role_has_permissions VALUES (259, 2);
INSERT INTO role_has_permissions VALUES (260, 2);
INSERT INTO role_has_permissions VALUES (261, 2);
INSERT INTO role_has_permissions VALUES (262, 2);
INSERT INTO role_has_permissions VALUES (263, 2);
INSERT INTO role_has_permissions VALUES (268, 2);
INSERT INTO role_has_permissions VALUES (269, 2);
INSERT INTO role_has_permissions VALUES (270, 2);
INSERT INTO role_has_permissions VALUES (271, 2);
INSERT INTO role_has_permissions VALUES (264, 2);
INSERT INTO role_has_permissions VALUES (265, 2);
INSERT INTO role_has_permissions VALUES (266, 2);
INSERT INTO role_has_permissions VALUES (267, 2);
INSERT INTO role_has_permissions VALUES (272, 2);
INSERT INTO role_has_permissions VALUES (273, 2);
INSERT INTO role_has_permissions VALUES (274, 2);
INSERT INTO role_has_permissions VALUES (275, 2);
INSERT INTO role_has_permissions VALUES (276, 2);
INSERT INTO role_has_permissions VALUES (277, 2);
INSERT INTO role_has_permissions VALUES (278, 2);
INSERT INTO role_has_permissions VALUES (279, 2);
INSERT INTO role_has_permissions VALUES (225, 2);
INSERT INTO role_has_permissions VALUES (280, 2);
INSERT INTO role_has_permissions VALUES (281, 2);
INSERT INTO role_has_permissions VALUES (282, 2);
INSERT INTO role_has_permissions VALUES (283, 2);
INSERT INTO role_has_permissions VALUES (284, 2);
INSERT INTO role_has_permissions VALUES (285, 2);
INSERT INTO role_has_permissions VALUES (286, 2);
INSERT INTO role_has_permissions VALUES (287, 2);
INSERT INTO role_has_permissions VALUES (288, 2);
INSERT INTO role_has_permissions VALUES (289, 2);
INSERT INTO role_has_permissions VALUES (290, 2);
INSERT INTO role_has_permissions VALUES (291, 2);
INSERT INTO role_has_permissions VALUES (292, 2);
INSERT INTO role_has_permissions VALUES (293, 2);
INSERT INTO role_has_permissions VALUES (294, 2);
INSERT INTO role_has_permissions VALUES (295, 2);
INSERT INTO role_has_permissions VALUES (296, 2);
INSERT INTO role_has_permissions VALUES (297, 2);
INSERT INTO role_has_permissions VALUES (394, 2);
INSERT INTO role_has_permissions VALUES (395, 2);
INSERT INTO role_has_permissions VALUES (396, 2);
INSERT INTO role_has_permissions VALUES (397, 2);
INSERT INTO role_has_permissions VALUES (390, 2);
INSERT INTO role_has_permissions VALUES (391, 2);
INSERT INTO role_has_permissions VALUES (392, 2);
INSERT INTO role_has_permissions VALUES (393, 2);
INSERT INTO role_has_permissions VALUES (298, 2);
INSERT INTO role_has_permissions VALUES (299, 2);
INSERT INTO role_has_permissions VALUES (300, 2);
INSERT INTO role_has_permissions VALUES (301, 2);
INSERT INTO role_has_permissions VALUES (302, 2);
INSERT INTO role_has_permissions VALUES (303, 2);
INSERT INTO role_has_permissions VALUES (304, 2);
INSERT INTO role_has_permissions VALUES (305, 2);
INSERT INTO role_has_permissions VALUES (306, 2);
INSERT INTO role_has_permissions VALUES (307, 2);
INSERT INTO role_has_permissions VALUES (308, 2);
INSERT INTO role_has_permissions VALUES (309, 2);
INSERT INTO role_has_permissions VALUES (310, 2);
INSERT INTO role_has_permissions VALUES (311, 2);
INSERT INTO role_has_permissions VALUES (312, 2);
INSERT INTO role_has_permissions VALUES (313, 2);
INSERT INTO role_has_permissions VALUES (314, 2);
INSERT INTO role_has_permissions VALUES (315, 2);
INSERT INTO role_has_permissions VALUES (316, 2);
INSERT INTO role_has_permissions VALUES (317, 2);
INSERT INTO role_has_permissions VALUES (318, 2);
INSERT INTO role_has_permissions VALUES (319, 2);
INSERT INTO role_has_permissions VALUES (320, 2);
INSERT INTO role_has_permissions VALUES (321, 2);
INSERT INTO role_has_permissions VALUES (322, 2);
INSERT INTO role_has_permissions VALUES (323, 2);
INSERT INTO role_has_permissions VALUES (324, 2);
INSERT INTO role_has_permissions VALUES (325, 2);
INSERT INTO role_has_permissions VALUES (326, 2);
INSERT INTO role_has_permissions VALUES (327, 2);
INSERT INTO role_has_permissions VALUES (328, 2);
INSERT INTO role_has_permissions VALUES (329, 2);
INSERT INTO role_has_permissions VALUES (330, 2);
INSERT INTO role_has_permissions VALUES (331, 2);
INSERT INTO role_has_permissions VALUES (332, 2);
INSERT INTO role_has_permissions VALUES (333, 2);
INSERT INTO role_has_permissions VALUES (334, 2);
INSERT INTO role_has_permissions VALUES (335, 2);
INSERT INTO role_has_permissions VALUES (336, 2);
INSERT INTO role_has_permissions VALUES (337, 2);
INSERT INTO role_has_permissions VALUES (338, 2);
INSERT INTO role_has_permissions VALUES (339, 2);
INSERT INTO role_has_permissions VALUES (340, 2);
INSERT INTO role_has_permissions VALUES (341, 2);
INSERT INTO role_has_permissions VALUES (342, 2);
INSERT INTO role_has_permissions VALUES (343, 2);
INSERT INTO role_has_permissions VALUES (344, 2);
INSERT INTO role_has_permissions VALUES (345, 2);
INSERT INTO role_has_permissions VALUES (346, 2);
INSERT INTO role_has_permissions VALUES (347, 2);
INSERT INTO role_has_permissions VALUES (348, 2);
INSERT INTO role_has_permissions VALUES (349, 2);
INSERT INTO role_has_permissions VALUES (350, 2);
INSERT INTO role_has_permissions VALUES (351, 2);
INSERT INTO role_has_permissions VALUES (352, 2);
INSERT INTO role_has_permissions VALUES (353, 2);
INSERT INTO role_has_permissions VALUES (354, 2);
INSERT INTO role_has_permissions VALUES (355, 2);
INSERT INTO role_has_permissions VALUES (356, 2);
INSERT INTO role_has_permissions VALUES (357, 2);
INSERT INTO role_has_permissions VALUES (358, 2);
INSERT INTO role_has_permissions VALUES (359, 2);
INSERT INTO role_has_permissions VALUES (360, 2);
INSERT INTO role_has_permissions VALUES (361, 2);
INSERT INTO role_has_permissions VALUES (362, 2);
INSERT INTO role_has_permissions VALUES (363, 2);
INSERT INTO role_has_permissions VALUES (364, 2);
INSERT INTO role_has_permissions VALUES (365, 2);
INSERT INTO role_has_permissions VALUES (366, 2);
INSERT INTO role_has_permissions VALUES (367, 2);
INSERT INTO role_has_permissions VALUES (368, 2);
INSERT INTO role_has_permissions VALUES (369, 2);
INSERT INTO role_has_permissions VALUES (370, 2);
INSERT INTO role_has_permissions VALUES (371, 2);
INSERT INTO role_has_permissions VALUES (372, 2);
INSERT INTO role_has_permissions VALUES (373, 2);
INSERT INTO role_has_permissions VALUES (374, 2);
INSERT INTO role_has_permissions VALUES (375, 2);
INSERT INTO role_has_permissions VALUES (376, 2);
INSERT INTO role_has_permissions VALUES (377, 2);
INSERT INTO role_has_permissions VALUES (378, 2);
INSERT INTO role_has_permissions VALUES (379, 2);
INSERT INTO role_has_permissions VALUES (380, 2);
INSERT INTO role_has_permissions VALUES (381, 2);
INSERT INTO role_has_permissions VALUES (382, 2);
INSERT INTO role_has_permissions VALUES (383, 2);
INSERT INTO role_has_permissions VALUES (384, 2);
INSERT INTO role_has_permissions VALUES (385, 2);
INSERT INTO role_has_permissions VALUES (386, 2);
INSERT INTO role_has_permissions VALUES (387, 2);
INSERT INTO role_has_permissions VALUES (388, 2);
INSERT INTO role_has_permissions VALUES (389, 2);
INSERT INTO role_has_permissions VALUES (398, 2);
INSERT INTO role_has_permissions VALUES (399, 2);
INSERT INTO role_has_permissions VALUES (400, 2);
INSERT INTO role_has_permissions VALUES (401, 2);
INSERT INTO role_has_permissions VALUES (402, 2);
INSERT INTO role_has_permissions VALUES (403, 2);
INSERT INTO role_has_permissions VALUES (404, 2);
INSERT INTO role_has_permissions VALUES (405, 2);
INSERT INTO role_has_permissions VALUES (406, 2);
INSERT INTO role_has_permissions VALUES (407, 2);
INSERT INTO role_has_permissions VALUES (408, 2);
INSERT INTO role_has_permissions VALUES (409, 2);
INSERT INTO role_has_permissions VALUES (410, 2);
INSERT INTO role_has_permissions VALUES (411, 2);
INSERT INTO role_has_permissions VALUES (412, 2);
INSERT INTO role_has_permissions VALUES (413, 2);
INSERT INTO role_has_permissions VALUES (414, 2);
INSERT INTO role_has_permissions VALUES (415, 2);
INSERT INTO role_has_permissions VALUES (416, 2);
INSERT INTO role_has_permissions VALUES (417, 2);
INSERT INTO role_has_permissions VALUES (418, 2);
INSERT INTO role_has_permissions VALUES (419, 2);
INSERT INTO role_has_permissions VALUES (420, 2);
INSERT INTO role_has_permissions VALUES (421, 2);
INSERT INTO role_has_permissions VALUES (422, 2);
INSERT INTO role_has_permissions VALUES (423, 2);
INSERT INTO role_has_permissions VALUES (424, 2);
INSERT INTO role_has_permissions VALUES (425, 2);
INSERT INTO role_has_permissions VALUES (426, 2);
INSERT INTO role_has_permissions VALUES (427, 2);
INSERT INTO role_has_permissions VALUES (428, 2);
INSERT INTO role_has_permissions VALUES (429, 2);
INSERT INTO role_has_permissions VALUES (430, 2);
INSERT INTO role_has_permissions VALUES (431, 2);
INSERT INTO role_has_permissions VALUES (432, 2);
INSERT INTO role_has_permissions VALUES (433, 2);
INSERT INTO role_has_permissions VALUES (434, 2);
INSERT INTO role_has_permissions VALUES (435, 2);
INSERT INTO role_has_permissions VALUES (436, 2);
INSERT INTO role_has_permissions VALUES (437, 2);
INSERT INTO role_has_permissions VALUES (438, 2);
INSERT INTO role_has_permissions VALUES (439, 2);
INSERT INTO role_has_permissions VALUES (440, 2);
INSERT INTO role_has_permissions VALUES (441, 2);
INSERT INTO role_has_permissions VALUES (443, 2);
INSERT INTO role_has_permissions VALUES (442, 2);
INSERT INTO role_has_permissions VALUES (444, 2);
INSERT INTO role_has_permissions VALUES (445, 2);
INSERT INTO role_has_permissions VALUES (446, 2);
INSERT INTO role_has_permissions VALUES (447, 2);
INSERT INTO role_has_permissions VALUES (448, 2);
INSERT INTO role_has_permissions VALUES (449, 2);
INSERT INTO role_has_permissions VALUES (450, 2);
INSERT INTO role_has_permissions VALUES (451, 2);
INSERT INTO role_has_permissions VALUES (452, 2);
INSERT INTO role_has_permissions VALUES (453, 2);
INSERT INTO role_has_permissions VALUES (454, 2);
INSERT INTO role_has_permissions VALUES (455, 2);
INSERT INTO role_has_permissions VALUES (456, 2);
INSERT INTO role_has_permissions VALUES (457, 2);
INSERT INTO role_has_permissions VALUES (19, 2);
INSERT INTO role_has_permissions VALUES (468, 2);
INSERT INTO role_has_permissions VALUES (469, 2);
INSERT INTO role_has_permissions VALUES (2, 2);
INSERT INTO role_has_permissions VALUES (461, 2);
INSERT INTO role_has_permissions VALUES (470, 2);
INSERT INTO role_has_permissions VALUES (471, 2);
INSERT INTO role_has_permissions VALUES (472, 2);
INSERT INTO role_has_permissions VALUES (473, 2);
INSERT INTO role_has_permissions VALUES (474, 2);
INSERT INTO role_has_permissions VALUES (475, 2);
INSERT INTO role_has_permissions VALUES (476, 2);
INSERT INTO role_has_permissions VALUES (477, 2);
INSERT INTO role_has_permissions VALUES (478, 2);
INSERT INTO role_has_permissions VALUES (479, 2);
INSERT INTO role_has_permissions VALUES (480, 2);
INSERT INTO role_has_permissions VALUES (481, 2);
INSERT INTO role_has_permissions VALUES (482, 2);
INSERT INTO role_has_permissions VALUES (485, 2);
INSERT INTO role_has_permissions VALUES (483, 2);
INSERT INTO role_has_permissions VALUES (484, 2);
INSERT INTO role_has_permissions VALUES (486, 2);
INSERT INTO role_has_permissions VALUES (487, 2);
INSERT INTO role_has_permissions VALUES (488, 2);
INSERT INTO role_has_permissions VALUES (489, 2);
INSERT INTO role_has_permissions VALUES (490, 2);
INSERT INTO role_has_permissions VALUES (491, 2);
INSERT INTO role_has_permissions VALUES (492, 2);
INSERT INTO role_has_permissions VALUES (493, 2);
INSERT INTO role_has_permissions VALUES (494, 2);
INSERT INTO role_has_permissions VALUES (495, 2);
INSERT INTO role_has_permissions VALUES (498, 2);
INSERT INTO role_has_permissions VALUES (499, 2);
INSERT INTO role_has_permissions VALUES (500, 2);
INSERT INTO role_has_permissions VALUES (501, 2);
INSERT INTO role_has_permissions VALUES (502, 2);
INSERT INTO role_has_permissions VALUES (503, 2);
INSERT INTO role_has_permissions VALUES (504, 2);
INSERT INTO role_has_permissions VALUES (505, 2);
INSERT INTO role_has_permissions VALUES (506, 2);
INSERT INTO role_has_permissions VALUES (507, 2);
INSERT INTO role_has_permissions VALUES (508, 2);
INSERT INTO role_has_permissions VALUES (509, 2);
INSERT INTO role_has_permissions VALUES (510, 2);
INSERT INTO role_has_permissions VALUES (512, 2);
INSERT INTO role_has_permissions VALUES (513, 2);
INSERT INTO role_has_permissions VALUES (514, 2);
INSERT INTO role_has_permissions VALUES (515, 2);
INSERT INTO role_has_permissions VALUES (511, 2);
INSERT INTO role_has_permissions VALUES (516, 2);
INSERT INTO role_has_permissions VALUES (517, 2);
INSERT INTO role_has_permissions VALUES (518, 2);
INSERT INTO role_has_permissions VALUES (519, 2);
INSERT INTO role_has_permissions VALUES (520, 2);
INSERT INTO role_has_permissions VALUES (521, 2);
INSERT INTO role_has_permissions VALUES (522, 2);
INSERT INTO role_has_permissions VALUES (523, 2);
INSERT INTO role_has_permissions VALUES (525, 2);
INSERT INTO role_has_permissions VALUES (526, 2);
INSERT INTO role_has_permissions VALUES (527, 2);
INSERT INTO role_has_permissions VALUES (528, 2);
INSERT INTO role_has_permissions VALUES (529, 2);
INSERT INTO role_has_permissions VALUES (530, 2);
INSERT INTO role_has_permissions VALUES (531, 2);
INSERT INTO role_has_permissions VALUES (532, 2);
INSERT INTO role_has_permissions VALUES (533, 2);
INSERT INTO role_has_permissions VALUES (534, 2);
INSERT INTO role_has_permissions VALUES (535, 2);
INSERT INTO role_has_permissions VALUES (536, 2);
INSERT INTO role_has_permissions VALUES (537, 2);
INSERT INTO role_has_permissions VALUES (538, 2);
INSERT INTO role_has_permissions VALUES (543, 2);
INSERT INTO role_has_permissions VALUES (539, 2);
INSERT INTO role_has_permissions VALUES (540, 2);
INSERT INTO role_has_permissions VALUES (541, 2);
INSERT INTO role_has_permissions VALUES (542, 2);
INSERT INTO role_has_permissions VALUES (544, 2);
INSERT INTO role_has_permissions VALUES (545, 2);
INSERT INTO role_has_permissions VALUES (546, 2);
INSERT INTO role_has_permissions VALUES (547, 2);
INSERT INTO role_has_permissions VALUES (548, 2);
INSERT INTO role_has_permissions VALUES (549, 2);
INSERT INTO role_has_permissions VALUES (550, 2);
INSERT INTO role_has_permissions VALUES (551, 2);
INSERT INTO role_has_permissions VALUES (552, 2);
INSERT INTO role_has_permissions VALUES (553, 2);
INSERT INTO role_has_permissions VALUES (554, 2);
INSERT INTO role_has_permissions VALUES (555, 2);
INSERT INTO role_has_permissions VALUES (556, 2);
INSERT INTO role_has_permissions VALUES (557, 2);
INSERT INTO role_has_permissions VALUES (558, 2);
INSERT INTO role_has_permissions VALUES (559, 2);
INSERT INTO role_has_permissions VALUES (560, 2);
INSERT INTO role_has_permissions VALUES (561, 2);
INSERT INTO role_has_permissions VALUES (562, 2);
INSERT INTO role_has_permissions VALUES (563, 2);
INSERT INTO role_has_permissions VALUES (564, 2);
INSERT INTO role_has_permissions VALUES (565, 2);
INSERT INTO role_has_permissions VALUES (566, 2);
INSERT INTO role_has_permissions VALUES (567, 2);
INSERT INTO role_has_permissions VALUES (568, 2);
INSERT INTO role_has_permissions VALUES (569, 2);
INSERT INTO role_has_permissions VALUES (570, 2);
INSERT INTO role_has_permissions VALUES (571, 2);
INSERT INTO role_has_permissions VALUES (572, 2);
INSERT INTO role_has_permissions VALUES (573, 2);
INSERT INTO role_has_permissions VALUES (574, 2);
INSERT INTO role_has_permissions VALUES (575, 2);
INSERT INTO role_has_permissions VALUES (576, 2);
INSERT INTO role_has_permissions VALUES (577, 2);
INSERT INTO role_has_permissions VALUES (578, 2);
INSERT INTO role_has_permissions VALUES (579, 2);
INSERT INTO role_has_permissions VALUES (580, 2);
INSERT INTO role_has_permissions VALUES (581, 2);
INSERT INTO role_has_permissions VALUES (582, 2);
INSERT INTO role_has_permissions VALUES (583, 2);
INSERT INTO role_has_permissions VALUES (584, 2);
INSERT INTO role_has_permissions VALUES (585, 2);
INSERT INTO role_has_permissions VALUES (586, 2);
INSERT INTO role_has_permissions VALUES (587, 2);
INSERT INTO role_has_permissions VALUES (588, 2);
INSERT INTO role_has_permissions VALUES (589, 2);
INSERT INTO role_has_permissions VALUES (590, 2);
INSERT INTO role_has_permissions VALUES (591, 2);
INSERT INTO role_has_permissions VALUES (592, 2);
INSERT INTO role_has_permissions VALUES (593, 2);
INSERT INTO role_has_permissions VALUES (594, 2);
INSERT INTO role_has_permissions VALUES (595, 2);
INSERT INTO role_has_permissions VALUES (5, 3);
INSERT INTO role_has_permissions VALUES (6, 3);
INSERT INTO role_has_permissions VALUES (7, 3);
INSERT INTO role_has_permissions VALUES (8, 3);
INSERT INTO role_has_permissions VALUES (5, 4);
INSERT INTO role_has_permissions VALUES (6, 4);
INSERT INTO role_has_permissions VALUES (7, 4);
INSERT INTO role_has_permissions VALUES (8, 4);
INSERT INTO role_has_permissions VALUES (414, 4);
INSERT INTO role_has_permissions VALUES (415, 4);
INSERT INTO role_has_permissions VALUES (416, 4);
INSERT INTO role_has_permissions VALUES (417, 4);
INSERT INTO role_has_permissions VALUES (406, 4);
INSERT INTO role_has_permissions VALUES (407, 4);
INSERT INTO role_has_permissions VALUES (408, 4);
INSERT INTO role_has_permissions VALUES (409, 4);
INSERT INTO role_has_permissions VALUES (260, 4);
INSERT INTO role_has_permissions VALUES (261, 4);
INSERT INTO role_has_permissions VALUES (262, 4);
INSERT INTO role_has_permissions VALUES (263, 4);
INSERT INTO role_has_permissions VALUES (511, 4);
INSERT INTO role_has_permissions VALUES (516, 4);
INSERT INTO role_has_permissions VALUES (517, 4);
INSERT INTO role_has_permissions VALUES (518, 4);
INSERT INTO role_has_permissions VALUES (513, 4);
INSERT INTO role_has_permissions VALUES (514, 4);
INSERT INTO role_has_permissions VALUES (515, 4);
INSERT INTO role_has_permissions VALUES (512, 4);
INSERT INTO role_has_permissions VALUES (238, 4);
INSERT INTO role_has_permissions VALUES (239, 4);
INSERT INTO role_has_permissions VALUES (240, 4);
INSERT INTO role_has_permissions VALUES (241, 4);
INSERT INTO role_has_permissions VALUES (214, 4);
INSERT INTO role_has_permissions VALUES (215, 4);
INSERT INTO role_has_permissions VALUES (216, 4);
INSERT INTO role_has_permissions VALUES (217, 4);
INSERT INTO role_has_permissions VALUES (410, 4);
INSERT INTO role_has_permissions VALUES (411, 4);
INSERT INTO role_has_permissions VALUES (412, 4);
INSERT INTO role_has_permissions VALUES (413, 4);
INSERT INTO role_has_permissions VALUES (280, 4);
INSERT INTO role_has_permissions VALUES (281, 4);
INSERT INTO role_has_permissions VALUES (282, 4);
INSERT INTO role_has_permissions VALUES (284, 4);
INSERT INTO role_has_permissions VALUES (283, 4);
INSERT INTO role_has_permissions VALUES (242, 4);
INSERT INTO role_has_permissions VALUES (243, 4);
INSERT INTO role_has_permissions VALUES (244, 4);
INSERT INTO role_has_permissions VALUES (245, 4);
INSERT INTO role_has_permissions VALUES (552, 4);
INSERT INTO role_has_permissions VALUES (553, 4);
INSERT INTO role_has_permissions VALUES (554, 4);
INSERT INTO role_has_permissions VALUES (555, 4);
INSERT INTO role_has_permissions VALUES (560, 4);
INSERT INTO role_has_permissions VALUES (561, 4);
INSERT INTO role_has_permissions VALUES (562, 4);
INSERT INTO role_has_permissions VALUES (563, 4);
INSERT INTO role_has_permissions VALUES (548, 4);
INSERT INTO role_has_permissions VALUES (549, 4);
INSERT INTO role_has_permissions VALUES (550, 4);
INSERT INTO role_has_permissions VALUES (551, 4);
INSERT INTO role_has_permissions VALUES (230, 4);
INSERT INTO role_has_permissions VALUES (231, 4);
INSERT INTO role_has_permissions VALUES (226, 4);
INSERT INTO role_has_permissions VALUES (227, 4);
INSERT INTO role_has_permissions VALUES (228, 4);
INSERT INTO role_has_permissions VALUES (229, 4);
INSERT INTO role_has_permissions VALUES (264, 4);
INSERT INTO role_has_permissions VALUES (265, 4);
INSERT INTO role_has_permissions VALUES (266, 4);
INSERT INTO role_has_permissions VALUES (267, 4);
INSERT INTO role_has_permissions VALUES (268, 4);
INSERT INTO role_has_permissions VALUES (269, 4);
INSERT INTO role_has_permissions VALUES (270, 4);
INSERT INTO role_has_permissions VALUES (271, 4);
INSERT INTO role_has_permissions VALUES (507, 4);
INSERT INTO role_has_permissions VALUES (508, 4);
INSERT INTO role_has_permissions VALUES (509, 4);
INSERT INTO role_has_permissions VALUES (510, 4);
INSERT INTO role_has_permissions VALUES (323, 4);
INSERT INTO role_has_permissions VALUES (324, 4);
INSERT INTO role_has_permissions VALUES (325, 4);
INSERT INTO role_has_permissions VALUES (326, 4);
INSERT INTO role_has_permissions VALUES (445, 4);
INSERT INTO role_has_permissions VALUES (446, 4);
INSERT INTO role_has_permissions VALUES (447, 4);
INSERT INTO role_has_permissions VALUES (448, 4);
INSERT INTO role_has_permissions VALUES (525, 4);
INSERT INTO role_has_permissions VALUES (526, 4);
INSERT INTO role_has_permissions VALUES (527, 4);
INSERT INTO role_has_permissions VALUES (528, 4);
INSERT INTO role_has_permissions VALUES (529, 4);
INSERT INTO role_has_permissions VALUES (582, 4);
INSERT INTO role_has_permissions VALUES (583, 4);
INSERT INTO role_has_permissions VALUES (5, 5);
INSERT INTO role_has_permissions VALUES (6, 5);
INSERT INTO role_has_permissions VALUES (7, 5);
INSERT INTO role_has_permissions VALUES (8, 5);
INSERT INTO role_has_permissions VALUES (10, 5);
INSERT INTO role_has_permissions VALUES (11, 5);
INSERT INTO role_has_permissions VALUES (12, 5);
INSERT INTO role_has_permissions VALUES (13, 5);
INSERT INTO role_has_permissions VALUES (497, 5);
INSERT INTO role_has_permissions VALUES (496, 5);


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO roles VALUES (1, 'super admin', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13', 0);
INSERT INTO roles VALUES (2, 'company', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13', 0);
INSERT INTO roles VALUES (3, 'accountant', 'web', '2023-04-10 12:14:13', '2023-04-10 12:14:13', 2);
INSERT INTO roles VALUES (4, 'coba', 'web', '2023-05-07 12:23:11', '2023-07-02 19:40:19', 2);
INSERT INTO roles VALUES (5, 'user', 'web', '2023-07-02 19:42:29', '2023-07-02 19:42:29', 2);


--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('roles_id_seq', 5, true);


--
-- Data for Name: set_bpjstk; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO set_bpjstk VALUES (1, 1, '["JHT","JKK","JKM","JP"]', 2, '2023-06-29 01:13:30', '2023-06-29 01:13:30');


--
-- Name: set_bpjstk_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('set_bpjstk_id_seq', 1, true);


--
-- Data for Name: set_ptkp; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO set_ptkp VALUES (1, 1, '["tk_0"]', 2, '2023-04-11 05:31:34', '2023-04-11 05:31:34');
INSERT INTO set_ptkp VALUES (2, 1, '["tk_0"]', 2, '2023-06-29 01:14:55', '2023-06-29 01:14:55');


--
-- Name: set_ptkp_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('set_ptkp_id_seq', 2, true);


--
-- Data for Name: settings; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO settings VALUES (1, 'employee_prefix', '#PDR', 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO settings VALUES (2, 'site_time_format', 'PDR', 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO settings VALUES (3, 'storage_setting', 'local', 1, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO settings VALUES (4, 'jht', '{"type":"JHT","value":"5.7"}', 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO settings VALUES (5, 'jp', '{"type":"JP","value":"3","maximum_limit_value":9077600}', 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO settings VALUES (6, 'pph21', '[{"income":"60000000","percentage":"5"},{"income":"250000000","percentage":"15"},{"income":"500000000","percentage":"25"},{"income":"5000000000","percentage":"30"},{"income":"5000000000000","percentage":"35"}]', 2, '2023-04-10 12:14:14', '2023-04-11 05:32:10');
INSERT INTO settings VALUES (7, 'is_paid_by_employee_themselve', '1', 2, '2023-04-10 12:14:14', '2023-06-29 01:15:34');
INSERT INTO settings VALUES (8, 'bpjs_tk', '{"type":"Percentage","value":"1","maximum_salary":"12000000"}', 2, '2023-06-29 01:17:06', '2023-07-02 18:23:22');


--
-- Name: settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('settings_id_seq', 8, true);


--
-- Data for Name: shift_schedules; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO shift_schedules VALUES (1, 1, NULL, '2022-12-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (2, 1, NULL, '2022-12-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (3, 1, NULL, '2022-12-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (4, 1, NULL, '2022-12-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (5, 1, NULL, '2022-12-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (6, 1, NULL, '2022-12-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (7, 1, NULL, '2022-12-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (8, 1, NULL, '2022-12-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (9, 1, NULL, '2022-12-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (10, 1, NULL, '2022-12-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (11, 1, NULL, '2022-12-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (12, 1, NULL, '2022-12-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (13, 1, NULL, '2022-12-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (14, 1, NULL, '2022-12-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (15, 1, NULL, '2022-12-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (16, 1, NULL, '2022-12-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (17, 1, NULL, '2022-12-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (18, 1, NULL, '2022-12-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (19, 1, NULL, '2022-12-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (20, 1, NULL, '2022-12-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (21, 1, NULL, '2022-12-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (23, 1, NULL, '2022-12-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (26, 1, NULL, '2022-12-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (27, 1, NULL, '2022-12-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (28, 1, NULL, '2022-12-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (29, 1, NULL, '2022-12-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (30, 1, NULL, '2022-12-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (33, 1, NULL, '2023-01-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (34, 1, NULL, '2023-01-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (35, 1, NULL, '2023-01-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (36, 1, NULL, '2023-01-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (37, 1, NULL, '2023-01-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (38, 1, NULL, '2023-01-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (39, 1, NULL, '2023-01-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (40, 1, NULL, '2023-01-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (41, 1, NULL, '2023-01-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (42, 1, NULL, '2023-01-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (43, 1, NULL, '2023-01-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (44, 1, NULL, '2023-01-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (45, 1, NULL, '2023-01-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (46, 1, NULL, '2023-01-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (47, 1, NULL, '2023-01-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (48, 1, NULL, '2023-01-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (49, 1, NULL, '2023-01-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (50, 1, NULL, '2023-01-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (51, 1, NULL, '2023-01-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (52, 1, NULL, '2023-01-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (55, 1, NULL, '2023-01-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (56, 1, NULL, '2023-01-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (57, 1, NULL, '2023-01-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (58, 1, NULL, '2023-01-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (59, 1, NULL, '2023-01-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (60, 1, NULL, '2023-01-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (61, 1, NULL, '2023-01-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (62, 1, NULL, '2023-01-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (63, 1, NULL, '2023-02-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (64, 1, NULL, '2023-02-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (65, 1, NULL, '2023-02-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (66, 1, NULL, '2023-02-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (67, 1, NULL, '2023-02-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (68, 1, NULL, '2023-02-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (69, 1, NULL, '2023-02-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (70, 1, NULL, '2023-02-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (71, 1, NULL, '2023-02-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (72, 1, NULL, '2023-02-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (73, 1, NULL, '2023-02-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (74, 1, NULL, '2023-02-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (75, 1, NULL, '2023-02-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (76, 1, NULL, '2023-02-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (77, 1, NULL, '2023-02-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (78, 1, NULL, '2023-02-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (79, 1, NULL, '2023-02-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (81, 1, NULL, '2023-02-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (82, 1, NULL, '2023-02-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO shift_schedules VALUES (83, 1, NULL, '2023-02-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (84, 1, NULL, '2023-02-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (85, 1, NULL, '2023-02-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (86, 1, NULL, '2023-02-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (87, 1, NULL, '2023-02-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (88, 1, NULL, '2023-02-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (25, 1, NULL, '2022-12-25', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:13', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (32, 1, NULL, '2023-01-01', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:13', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (80, 1, NULL, '2023-02-18', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:13', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (89, 1, NULL, '2023-02-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (90, 1, NULL, '2023-02-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (91, 1, NULL, '2023-03-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (92, 1, NULL, '2023-03-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (93, 1, NULL, '2023-03-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (94, 1, NULL, '2023-03-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (95, 1, NULL, '2023-03-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (96, 1, NULL, '2023-03-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (97, 1, NULL, '2023-03-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (98, 1, NULL, '2023-03-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (99, 1, NULL, '2023-03-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (100, 1, NULL, '2023-03-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (101, 1, NULL, '2023-03-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (102, 1, NULL, '2023-03-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (103, 1, NULL, '2023-03-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (104, 1, NULL, '2023-03-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (105, 1, NULL, '2023-03-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (106, 1, NULL, '2023-03-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (107, 1, NULL, '2023-03-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (108, 1, NULL, '2023-03-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (109, 1, NULL, '2023-03-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (110, 1, NULL, '2023-03-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (111, 1, NULL, '2023-03-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (114, 1, NULL, '2023-03-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (115, 1, NULL, '2023-03-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (116, 1, NULL, '2023-03-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (117, 1, NULL, '2023-03-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (118, 1, NULL, '2023-03-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (119, 1, NULL, '2023-03-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (120, 1, NULL, '2023-03-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (121, 1, NULL, '2023-03-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (122, 1, NULL, '2023-04-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (123, 1, NULL, '2023-04-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (124, 1, NULL, '2023-04-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (125, 1, NULL, '2023-04-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (126, 1, NULL, '2023-04-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (127, 1, NULL, '2023-04-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (129, 1, NULL, '2023-04-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (131, 1, NULL, '2023-04-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (132, 1, NULL, '2023-04-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (133, 1, NULL, '2023-04-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (134, 1, NULL, '2023-04-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (135, 1, NULL, '2023-04-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (136, 1, NULL, '2023-04-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (137, 1, NULL, '2023-04-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (138, 1, NULL, '2023-04-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (139, 1, NULL, '2023-04-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (140, 1, NULL, '2023-04-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (141, 1, NULL, '2023-04-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (148, 1, NULL, '2023-04-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (149, 1, NULL, '2023-04-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (150, 1, NULL, '2023-04-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (151, 1, NULL, '2023-04-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (153, 1, NULL, '2023-05-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (154, 1, NULL, '2023-05-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (155, 1, NULL, '2023-05-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (156, 1, NULL, '2023-05-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (157, 1, NULL, '2023-05-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (158, 1, NULL, '2023-05-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (159, 1, NULL, '2023-05-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (160, 1, NULL, '2023-05-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (161, 1, NULL, '2023-05-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (162, 1, NULL, '2023-05-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (163, 1, NULL, '2023-05-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (164, 1, NULL, '2023-05-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (165, 1, NULL, '2023-05-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (166, 1, NULL, '2023-05-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (167, 1, NULL, '2023-05-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (168, 1, NULL, '2023-05-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (170, 1, NULL, '2023-05-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (171, 1, NULL, '2023-05-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (172, 1, NULL, '2023-05-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (173, 1, NULL, '2023-05-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (174, 1, NULL, '2023-05-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (175, 1, NULL, '2023-05-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (176, 1, NULL, '2023-05-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (142, 1, NULL, '2023-04-21', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (144, 1, NULL, '2023-04-23', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (147, 1, NULL, '2023-04-26', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (152, 1, NULL, '2023-05-01', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (113, 1, NULL, '2023-03-23', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (177, 1, NULL, '2023-05-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (178, 1, NULL, '2023-05-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (179, 1, NULL, '2023-05-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (180, 1, NULL, '2023-05-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (181, 1, NULL, '2023-05-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (182, 1, NULL, '2023-05-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (185, 1, NULL, '2023-06-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (187, 1, NULL, '2023-06-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (188, 1, NULL, '2023-06-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (189, 1, NULL, '2023-06-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (190, 1, NULL, '2023-06-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (191, 1, NULL, '2023-06-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (192, 1, NULL, '2023-06-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (193, 1, NULL, '2023-06-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (194, 1, NULL, '2023-06-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (195, 1, NULL, '2023-06-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (196, 1, NULL, '2023-06-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (197, 1, NULL, '2023-06-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (198, 1, NULL, '2023-06-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (199, 1, NULL, '2023-06-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (200, 1, NULL, '2023-06-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (201, 1, NULL, '2023-06-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (202, 1, NULL, '2023-06-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (203, 1, NULL, '2023-06-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (204, 1, NULL, '2023-06-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (205, 1, NULL, '2023-06-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (206, 1, NULL, '2023-06-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (207, 1, NULL, '2023-06-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (208, 1, NULL, '2023-06-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (209, 1, NULL, '2023-06-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (210, 1, NULL, '2023-06-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (212, 1, NULL, '2023-06-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (213, 1, NULL, '2023-07-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (214, 1, NULL, '2023-07-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (215, 1, NULL, '2023-07-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (216, 1, NULL, '2023-07-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (217, 1, NULL, '2023-07-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (218, 1, NULL, '2023-07-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (219, 1, NULL, '2023-07-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (220, 1, NULL, '2023-07-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (221, 1, NULL, '2023-07-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (222, 1, NULL, '2023-07-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (223, 1, NULL, '2023-07-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (224, 1, NULL, '2023-07-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (225, 1, NULL, '2023-07-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (226, 1, NULL, '2023-07-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (227, 1, NULL, '2023-07-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (228, 1, NULL, '2023-07-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (229, 1, NULL, '2023-07-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (230, 1, NULL, '2023-07-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (232, 1, NULL, '2023-07-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (233, 1, NULL, '2023-07-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (234, 1, NULL, '2023-07-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (235, 1, NULL, '2023-07-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (236, 1, NULL, '2023-07-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (237, 1, NULL, '2023-07-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (238, 1, NULL, '2023-07-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (239, 1, NULL, '2023-07-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (240, 1, NULL, '2023-07-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (241, 1, NULL, '2023-07-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (242, 1, NULL, '2023-07-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (243, 1, NULL, '2023-07-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (244, 1, NULL, '2023-08-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (245, 1, NULL, '2023-08-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (246, 1, NULL, '2023-08-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (247, 1, NULL, '2023-08-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (248, 1, NULL, '2023-08-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (249, 1, NULL, '2023-08-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (250, 1, NULL, '2023-08-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (251, 1, NULL, '2023-08-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (252, 1, NULL, '2023-08-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (253, 1, NULL, '2023-08-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (254, 1, NULL, '2023-08-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (255, 1, NULL, '2023-08-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (256, 1, NULL, '2023-08-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (257, 1, NULL, '2023-08-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (258, 1, NULL, '2023-08-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (259, 1, NULL, '2023-08-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (261, 1, NULL, '2023-08-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (262, 1, NULL, '2023-08-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (263, 1, NULL, '2023-08-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (264, 1, NULL, '2023-08-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (231, 1, NULL, '2023-07-19', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (184, 1, NULL, '2023-06-02', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (265, 1, NULL, '2023-08-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (266, 1, NULL, '2023-08-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (267, 1, NULL, '2023-08-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (268, 1, NULL, '2023-08-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (269, 1, NULL, '2023-08-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (270, 1, NULL, '2023-08-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (271, 1, NULL, '2023-08-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (272, 1, NULL, '2023-08-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (273, 1, NULL, '2023-08-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (274, 1, NULL, '2023-08-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (275, 1, NULL, '2023-09-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (276, 1, NULL, '2023-09-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (277, 1, NULL, '2023-09-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (278, 1, NULL, '2023-09-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (279, 1, NULL, '2023-09-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (280, 1, NULL, '2023-09-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (281, 1, NULL, '2023-09-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (282, 1, NULL, '2023-09-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (283, 1, NULL, '2023-09-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (284, 1, NULL, '2023-09-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (285, 1, NULL, '2023-09-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (286, 1, NULL, '2023-09-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (287, 1, NULL, '2023-09-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (288, 1, NULL, '2023-09-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (289, 1, NULL, '2023-09-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (290, 1, NULL, '2023-09-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (291, 1, NULL, '2023-09-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (292, 1, NULL, '2023-09-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (293, 1, NULL, '2023-09-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (294, 1, NULL, '2023-09-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (295, 1, NULL, '2023-09-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (296, 1, NULL, '2023-09-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (297, 1, NULL, '2023-09-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (298, 1, NULL, '2023-09-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (299, 1, NULL, '2023-09-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (300, 1, NULL, '2023-09-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (301, 1, NULL, '2023-09-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (303, 1, NULL, '2023-09-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (304, 1, NULL, '2023-09-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (305, 1, NULL, '2023-10-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (307, 1, NULL, '2023-10-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (308, 1, NULL, '2023-10-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (309, 1, NULL, '2023-10-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (310, 1, NULL, '2023-10-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (311, 1, NULL, '2023-10-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (312, 1, NULL, '2023-10-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (313, 1, NULL, '2023-10-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (314, 1, NULL, '2023-10-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (315, 1, NULL, '2023-10-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (316, 1, NULL, '2023-10-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (317, 1, NULL, '2023-10-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (318, 1, NULL, '2023-10-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (319, 1, NULL, '2023-10-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (320, 1, NULL, '2023-10-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (321, 1, NULL, '2023-10-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (322, 1, NULL, '2023-10-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (323, 1, NULL, '2023-10-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (324, 1, NULL, '2023-10-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (325, 1, NULL, '2023-10-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (326, 1, NULL, '2023-10-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (327, 1, NULL, '2023-10-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (328, 1, NULL, '2023-10-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (329, 1, NULL, '2023-10-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (330, 1, NULL, '2023-10-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (331, 1, NULL, '2023-10-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (332, 1, NULL, '2023-10-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (333, 1, NULL, '2023-10-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (334, 1, NULL, '2023-10-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (335, 1, NULL, '2023-10-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (336, 1, NULL, '2023-11-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (337, 1, NULL, '2023-11-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (338, 1, NULL, '2023-11-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (339, 1, NULL, '2023-11-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (340, 1, NULL, '2023-11-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (341, 1, NULL, '2023-11-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (342, 1, NULL, '2023-11-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (343, 1, NULL, '2023-11-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (344, 1, NULL, '2023-11-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (345, 1, NULL, '2023-11-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (346, 1, NULL, '2023-11-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (348, 1, NULL, '2023-11-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (349, 1, NULL, '2023-11-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (350, 1, NULL, '2023-11-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (351, 1, NULL, '2023-11-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (352, 1, NULL, '2023-11-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (347, 1, NULL, '2023-11-12', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (353, 1, NULL, '2023-11-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (354, 1, NULL, '2023-11-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (355, 1, NULL, '2023-11-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (356, 1, NULL, '2023-11-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (357, 1, NULL, '2023-11-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (358, 1, NULL, '2023-11-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (359, 1, NULL, '2023-11-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (361, 1, NULL, '2023-11-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (362, 1, NULL, '2023-11-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (363, 1, NULL, '2023-11-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (364, 1, NULL, '2023-11-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (365, 1, NULL, '2023-11-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (366, 1, NULL, '2023-12-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (367, 2, NULL, '2022-12-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (368, 2, NULL, '2022-12-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (369, 2, NULL, '2022-12-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (370, 2, NULL, '2022-12-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (371, 2, NULL, '2022-12-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (372, 2, NULL, '2022-12-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (373, 2, NULL, '2022-12-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (374, 2, NULL, '2022-12-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (375, 2, NULL, '2022-12-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (376, 2, NULL, '2022-12-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (377, 2, NULL, '2022-12-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (378, 2, NULL, '2022-12-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (379, 2, NULL, '2022-12-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (380, 2, NULL, '2022-12-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (381, 2, NULL, '2022-12-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (382, 2, NULL, '2022-12-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (383, 2, NULL, '2022-12-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (384, 2, NULL, '2022-12-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (385, 2, NULL, '2022-12-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (386, 2, NULL, '2022-12-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (387, 2, NULL, '2022-12-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (389, 2, NULL, '2022-12-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (392, 2, NULL, '2022-12-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (393, 2, NULL, '2022-12-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (394, 2, NULL, '2022-12-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (395, 2, NULL, '2022-12-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (396, 2, NULL, '2022-12-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (399, 2, NULL, '2023-01-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (400, 2, NULL, '2023-01-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (401, 2, NULL, '2023-01-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (402, 2, NULL, '2023-01-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (403, 2, NULL, '2023-01-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (404, 2, NULL, '2023-01-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (405, 2, NULL, '2023-01-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (406, 2, NULL, '2023-01-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (407, 2, NULL, '2023-01-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (408, 2, NULL, '2023-01-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (409, 2, NULL, '2023-01-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (410, 2, NULL, '2023-01-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (411, 2, NULL, '2023-01-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (412, 2, NULL, '2023-01-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (413, 2, NULL, '2023-01-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (414, 2, NULL, '2023-01-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (415, 2, NULL, '2023-01-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (416, 2, NULL, '2023-01-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (417, 2, NULL, '2023-01-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (418, 2, NULL, '2023-01-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (421, 2, NULL, '2023-01-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (422, 2, NULL, '2023-01-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (423, 2, NULL, '2023-01-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (424, 2, NULL, '2023-01-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (425, 2, NULL, '2023-01-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (426, 2, NULL, '2023-01-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (427, 2, NULL, '2023-01-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (428, 2, NULL, '2023-01-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (429, 2, NULL, '2023-02-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (430, 2, NULL, '2023-02-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (431, 2, NULL, '2023-02-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (432, 2, NULL, '2023-02-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (433, 2, NULL, '2023-02-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (434, 2, NULL, '2023-02-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (435, 2, NULL, '2023-02-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (436, 2, NULL, '2023-02-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (437, 2, NULL, '2023-02-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (438, 2, NULL, '2023-02-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (439, 2, NULL, '2023-02-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (440, 2, NULL, '2023-02-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (390, 2, NULL, '2022-12-24', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (397, 2, NULL, '2022-12-31', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (420, 2, NULL, '2023-01-23', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (441, 2, NULL, '2023-02-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (442, 2, NULL, '2023-02-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (443, 2, NULL, '2023-02-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (444, 2, NULL, '2023-02-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (445, 2, NULL, '2023-02-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (447, 2, NULL, '2023-02-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (448, 2, NULL, '2023-02-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (449, 2, NULL, '2023-02-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (450, 2, NULL, '2023-02-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (451, 2, NULL, '2023-02-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (452, 2, NULL, '2023-02-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (453, 2, NULL, '2023-02-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (454, 2, NULL, '2023-02-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (455, 2, NULL, '2023-02-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (456, 2, NULL, '2023-02-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (457, 2, NULL, '2023-03-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (458, 2, NULL, '2023-03-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (459, 2, NULL, '2023-03-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (460, 2, NULL, '2023-03-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (461, 2, NULL, '2023-03-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (462, 2, NULL, '2023-03-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (463, 2, NULL, '2023-03-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (464, 2, NULL, '2023-03-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (465, 2, NULL, '2023-03-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (466, 2, NULL, '2023-03-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (467, 2, NULL, '2023-03-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (468, 2, NULL, '2023-03-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (469, 2, NULL, '2023-03-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (470, 2, NULL, '2023-03-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (471, 2, NULL, '2023-03-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (472, 2, NULL, '2023-03-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (473, 2, NULL, '2023-03-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (474, 2, NULL, '2023-03-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (475, 2, NULL, '2023-03-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (476, 2, NULL, '2023-03-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (477, 2, NULL, '2023-03-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (480, 2, NULL, '2023-03-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (481, 2, NULL, '2023-03-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (482, 2, NULL, '2023-03-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (483, 2, NULL, '2023-03-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (484, 2, NULL, '2023-03-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (485, 2, NULL, '2023-03-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (486, 2, NULL, '2023-03-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (487, 2, NULL, '2023-03-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (488, 2, NULL, '2023-04-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (489, 2, NULL, '2023-04-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (490, 2, NULL, '2023-04-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (491, 2, NULL, '2023-04-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (492, 2, NULL, '2023-04-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (493, 2, NULL, '2023-04-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (495, 2, NULL, '2023-04-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (497, 2, NULL, '2023-04-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (498, 2, NULL, '2023-04-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (499, 2, NULL, '2023-04-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (500, 2, NULL, '2023-04-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (501, 2, NULL, '2023-04-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (502, 2, NULL, '2023-04-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (503, 2, NULL, '2023-04-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (504, 2, NULL, '2023-04-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (505, 2, NULL, '2023-04-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (506, 2, NULL, '2023-04-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (507, 2, NULL, '2023-04-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (514, 2, NULL, '2023-04-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (515, 2, NULL, '2023-04-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (516, 2, NULL, '2023-04-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (517, 2, NULL, '2023-04-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (519, 2, NULL, '2023-05-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (520, 2, NULL, '2023-05-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (521, 2, NULL, '2023-05-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (522, 2, NULL, '2023-05-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (523, 2, NULL, '2023-05-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (524, 2, NULL, '2023-05-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (525, 2, NULL, '2023-05-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (526, 2, NULL, '2023-05-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (527, 2, NULL, '2023-05-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (528, 2, NULL, '2023-05-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (494, 2, NULL, '2023-04-07', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (508, 2, NULL, '2023-04-21', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (510, 2, NULL, '2023-04-23', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (513, 2, NULL, '2023-04-26', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (518, 2, NULL, '2023-05-01', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (529, 2, NULL, '2023-05-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (530, 2, NULL, '2023-05-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (531, 2, NULL, '2023-05-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (532, 2, NULL, '2023-05-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (533, 2, NULL, '2023-05-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (534, 2, NULL, '2023-05-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (536, 2, NULL, '2023-05-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (537, 2, NULL, '2023-05-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (538, 2, NULL, '2023-05-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (539, 2, NULL, '2023-05-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (540, 2, NULL, '2023-05-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (541, 2, NULL, '2023-05-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (542, 2, NULL, '2023-05-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (543, 2, NULL, '2023-05-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (544, 2, NULL, '2023-05-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (545, 2, NULL, '2023-05-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (546, 2, NULL, '2023-05-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (547, 2, NULL, '2023-05-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (548, 2, NULL, '2023-05-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (551, 2, NULL, '2023-06-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (553, 2, NULL, '2023-06-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (554, 2, NULL, '2023-06-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (555, 2, NULL, '2023-06-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (556, 2, NULL, '2023-06-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (557, 2, NULL, '2023-06-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (558, 2, NULL, '2023-06-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (559, 2, NULL, '2023-06-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (560, 2, NULL, '2023-06-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (561, 2, NULL, '2023-06-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (562, 2, NULL, '2023-06-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (563, 2, NULL, '2023-06-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (564, 2, NULL, '2023-06-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (565, 2, NULL, '2023-06-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (566, 2, NULL, '2023-06-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (567, 2, NULL, '2023-06-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (568, 2, NULL, '2023-06-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (569, 2, NULL, '2023-06-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (570, 2, NULL, '2023-06-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (571, 2, NULL, '2023-06-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (572, 2, NULL, '2023-06-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (573, 2, NULL, '2023-06-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (574, 2, NULL, '2023-06-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (575, 2, NULL, '2023-06-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (576, 2, NULL, '2023-06-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (578, 2, NULL, '2023-06-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (579, 2, NULL, '2023-07-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (580, 2, NULL, '2023-07-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (581, 2, NULL, '2023-07-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (582, 2, NULL, '2023-07-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (583, 2, NULL, '2023-07-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (584, 2, NULL, '2023-07-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (585, 2, NULL, '2023-07-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (586, 2, NULL, '2023-07-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (587, 2, NULL, '2023-07-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (588, 2, NULL, '2023-07-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (589, 2, NULL, '2023-07-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (590, 2, NULL, '2023-07-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (591, 2, NULL, '2023-07-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (592, 2, NULL, '2023-07-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (593, 2, NULL, '2023-07-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (594, 2, NULL, '2023-07-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (595, 2, NULL, '2023-07-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (596, 2, NULL, '2023-07-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (598, 2, NULL, '2023-07-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (599, 2, NULL, '2023-07-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (600, 2, NULL, '2023-07-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (601, 2, NULL, '2023-07-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (602, 2, NULL, '2023-07-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (603, 2, NULL, '2023-07-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (604, 2, NULL, '2023-07-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (605, 2, NULL, '2023-07-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (606, 2, NULL, '2023-07-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (607, 2, NULL, '2023-07-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (608, 2, NULL, '2023-07-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (609, 2, NULL, '2023-07-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (610, 2, NULL, '2023-08-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (611, 2, NULL, '2023-08-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (612, 2, NULL, '2023-08-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (613, 2, NULL, '2023-08-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (614, 2, NULL, '2023-08-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (615, 2, NULL, '2023-08-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (616, 2, NULL, '2023-08-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (577, 2, NULL, '2023-06-29', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (549, 2, NULL, '2023-06-01', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (617, 2, NULL, '2023-08-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (618, 2, NULL, '2023-08-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (619, 2, NULL, '2023-08-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (620, 2, NULL, '2023-08-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (621, 2, NULL, '2023-08-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (622, 2, NULL, '2023-08-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (623, 2, NULL, '2023-08-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (624, 2, NULL, '2023-08-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (625, 2, NULL, '2023-08-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (627, 2, NULL, '2023-08-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (628, 2, NULL, '2023-08-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (629, 2, NULL, '2023-08-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (630, 2, NULL, '2023-08-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (631, 2, NULL, '2023-08-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (632, 2, NULL, '2023-08-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (633, 2, NULL, '2023-08-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (634, 2, NULL, '2023-08-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (635, 2, NULL, '2023-08-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (636, 2, NULL, '2023-08-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (637, 2, NULL, '2023-08-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (638, 2, NULL, '2023-08-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (639, 2, NULL, '2023-08-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (640, 2, NULL, '2023-08-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (641, 2, NULL, '2023-09-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (642, 2, NULL, '2023-09-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (643, 2, NULL, '2023-09-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (644, 2, NULL, '2023-09-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (645, 2, NULL, '2023-09-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (646, 2, NULL, '2023-09-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (647, 2, NULL, '2023-09-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (648, 2, NULL, '2023-09-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (649, 2, NULL, '2023-09-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (650, 2, NULL, '2023-09-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (651, 2, NULL, '2023-09-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (652, 2, NULL, '2023-09-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (653, 2, NULL, '2023-09-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (654, 2, NULL, '2023-09-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (655, 2, NULL, '2023-09-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (656, 2, NULL, '2023-09-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (657, 2, NULL, '2023-09-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (658, 2, NULL, '2023-09-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (659, 2, NULL, '2023-09-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (660, 2, NULL, '2023-09-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (661, 2, NULL, '2023-09-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (662, 2, NULL, '2023-09-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (663, 2, NULL, '2023-09-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (664, 2, NULL, '2023-09-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (665, 2, NULL, '2023-09-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (666, 2, NULL, '2023-09-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (667, 2, NULL, '2023-09-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (669, 2, NULL, '2023-09-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (670, 2, NULL, '2023-09-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (671, 2, NULL, '2023-10-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (673, 2, NULL, '2023-10-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (674, 2, NULL, '2023-10-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (675, 2, NULL, '2023-10-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (676, 2, NULL, '2023-10-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (677, 2, NULL, '2023-10-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (678, 2, NULL, '2023-10-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (679, 2, NULL, '2023-10-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (680, 2, NULL, '2023-10-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (681, 2, NULL, '2023-10-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (682, 2, NULL, '2023-10-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (683, 2, NULL, '2023-10-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (684, 2, NULL, '2023-10-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (685, 2, NULL, '2023-10-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (686, 2, NULL, '2023-10-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (687, 2, NULL, '2023-10-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (688, 2, NULL, '2023-10-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (689, 2, NULL, '2023-10-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (690, 2, NULL, '2023-10-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (691, 2, NULL, '2023-10-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (692, 2, NULL, '2023-10-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (693, 2, NULL, '2023-10-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (694, 2, NULL, '2023-10-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (695, 2, NULL, '2023-10-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (696, 2, NULL, '2023-10-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (697, 2, NULL, '2023-10-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (698, 2, NULL, '2023-10-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (699, 2, NULL, '2023-10-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (700, 2, NULL, '2023-10-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (701, 2, NULL, '2023-10-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (702, 2, NULL, '2023-11-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (703, 2, NULL, '2023-11-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (704, 2, NULL, '2023-11-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (672, 2, NULL, '2023-10-02', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (705, 2, NULL, '2023-11-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (706, 2, NULL, '2023-11-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (707, 2, NULL, '2023-11-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (708, 2, NULL, '2023-11-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (709, 2, NULL, '2023-11-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (710, 2, NULL, '2023-11-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (711, 2, NULL, '2023-11-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (712, 2, NULL, '2023-11-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (714, 2, NULL, '2023-11-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (715, 2, NULL, '2023-11-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (716, 2, NULL, '2023-11-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (717, 2, NULL, '2023-11-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (718, 2, NULL, '2023-11-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (719, 2, NULL, '2023-11-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (720, 2, NULL, '2023-11-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (721, 2, NULL, '2023-11-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (722, 2, NULL, '2023-11-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (723, 2, NULL, '2023-11-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (724, 2, NULL, '2023-11-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (725, 2, NULL, '2023-11-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (727, 2, NULL, '2023-11-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (728, 2, NULL, '2023-11-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (729, 2, NULL, '2023-11-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (730, 2, NULL, '2023-11-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (731, 2, NULL, '2023-11-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (732, 2, NULL, '2023-12-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-10 12:14:14', '2023-04-10 12:14:14');
INSERT INTO shift_schedules VALUES (741, 3, NULL, '2023-04-21', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:17', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (742, 3, NULL, '2023-04-22', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:17', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (733, 3, NULL, '2023-04-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (734, 3, NULL, '2023-04-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (735, 3, NULL, '2023-04-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (736, 3, NULL, '2023-04-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (737, 3, NULL, '2023-04-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (738, 3, NULL, '2023-04-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (739, 3, NULL, '2023-04-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (740, 3, NULL, '2023-04-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (747, 3, NULL, '2023-04-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (748, 3, NULL, '2023-04-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (749, 3, NULL, '2023-04-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (750, 3, NULL, '2023-04-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (752, 3, NULL, '2023-05-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (753, 3, NULL, '2023-05-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (754, 3, NULL, '2023-05-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (755, 3, NULL, '2023-05-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (756, 3, NULL, '2023-05-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (757, 3, NULL, '2023-05-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (745, 3, NULL, '2023-04-25', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:17', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (746, 3, NULL, '2023-04-26', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:17', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (22, 1, NULL, '2022-12-22', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:13', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (54, 1, NULL, '2023-01-23', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:13', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (112, 1, NULL, '2023-03-22', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (143, 1, NULL, '2023-04-22', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (146, 1, NULL, '2023-04-25', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (183, 1, NULL, '2023-06-01', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (211, 1, NULL, '2023-06-29', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (260, 1, NULL, '2023-08-17', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (360, 1, NULL, '2023-11-25', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (391, 2, NULL, '2022-12-25', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (446, 2, NULL, '2023-02-18', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (479, 2, NULL, '2023-03-23', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (509, 2, NULL, '2023-04-22', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (535, 2, NULL, '2023-05-18', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (550, 2, NULL, '2023-06-02', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (626, 2, NULL, '2023-08-17', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (713, 2, NULL, '2023-11-12', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (758, 3, NULL, '2023-05-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (759, 3, NULL, '2023-05-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (760, 3, NULL, '2023-05-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (761, 3, NULL, '2023-05-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (762, 3, NULL, '2023-05-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (763, 3, NULL, '2023-05-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (764, 3, NULL, '2023-05-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (765, 3, NULL, '2023-05-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (766, 3, NULL, '2023-05-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (767, 3, NULL, '2023-05-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:17', '2023-04-13 07:55:17');
INSERT INTO shift_schedules VALUES (769, 3, NULL, '2023-05-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (770, 3, NULL, '2023-05-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (771, 3, NULL, '2023-05-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (772, 3, NULL, '2023-05-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (773, 3, NULL, '2023-05-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (774, 3, NULL, '2023-05-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (775, 3, NULL, '2023-05-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (776, 3, NULL, '2023-05-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (777, 3, NULL, '2023-05-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (778, 3, NULL, '2023-05-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (779, 3, NULL, '2023-05-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (780, 3, NULL, '2023-05-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (781, 3, NULL, '2023-05-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (784, 3, NULL, '2023-06-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (786, 3, NULL, '2023-06-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (787, 3, NULL, '2023-06-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (788, 3, NULL, '2023-06-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (789, 3, NULL, '2023-06-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (790, 3, NULL, '2023-06-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (791, 3, NULL, '2023-06-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (792, 3, NULL, '2023-06-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (793, 3, NULL, '2023-06-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (794, 3, NULL, '2023-06-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (795, 3, NULL, '2023-06-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (796, 3, NULL, '2023-06-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (797, 3, NULL, '2023-06-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (798, 3, NULL, '2023-06-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (799, 3, NULL, '2023-06-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (800, 3, NULL, '2023-06-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (801, 3, NULL, '2023-06-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (802, 3, NULL, '2023-06-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (803, 3, NULL, '2023-06-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (804, 3, NULL, '2023-06-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (805, 3, NULL, '2023-06-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (806, 3, NULL, '2023-06-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (807, 3, NULL, '2023-06-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (808, 3, NULL, '2023-06-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (809, 3, NULL, '2023-06-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (811, 3, NULL, '2023-06-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (812, 3, NULL, '2023-07-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (813, 3, NULL, '2023-07-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (814, 3, NULL, '2023-07-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (815, 3, NULL, '2023-07-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (816, 3, NULL, '2023-07-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (817, 3, NULL, '2023-07-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (818, 3, NULL, '2023-07-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (819, 3, NULL, '2023-07-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (820, 3, NULL, '2023-07-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (821, 3, NULL, '2023-07-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (822, 3, NULL, '2023-07-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (823, 3, NULL, '2023-07-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (824, 3, NULL, '2023-07-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (825, 3, NULL, '2023-07-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (826, 3, NULL, '2023-07-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (827, 3, NULL, '2023-07-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (828, 3, NULL, '2023-07-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (829, 3, NULL, '2023-07-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (831, 3, NULL, '2023-07-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (832, 3, NULL, '2023-07-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (833, 3, NULL, '2023-07-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (834, 3, NULL, '2023-07-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (835, 3, NULL, '2023-07-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (836, 3, NULL, '2023-07-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (837, 3, NULL, '2023-07-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (838, 3, NULL, '2023-07-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (839, 3, NULL, '2023-07-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (840, 3, NULL, '2023-07-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (841, 3, NULL, '2023-07-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (842, 3, NULL, '2023-07-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (843, 3, NULL, '2023-08-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (844, 3, NULL, '2023-08-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (845, 3, NULL, '2023-08-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (810, 3, NULL, '2023-06-29', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (782, 3, NULL, '2023-06-01', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (846, 3, NULL, '2023-08-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (847, 3, NULL, '2023-08-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (848, 3, NULL, '2023-08-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (849, 3, NULL, '2023-08-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (850, 3, NULL, '2023-08-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (851, 3, NULL, '2023-08-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (852, 3, NULL, '2023-08-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (853, 3, NULL, '2023-08-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (854, 3, NULL, '2023-08-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (855, 3, NULL, '2023-08-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (856, 3, NULL, '2023-08-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (857, 3, NULL, '2023-08-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (858, 3, NULL, '2023-08-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (860, 3, NULL, '2023-08-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (861, 3, NULL, '2023-08-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (862, 3, NULL, '2023-08-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (863, 3, NULL, '2023-08-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (864, 3, NULL, '2023-08-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (865, 3, NULL, '2023-08-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (866, 3, NULL, '2023-08-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (867, 3, NULL, '2023-08-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (868, 3, NULL, '2023-08-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (869, 3, NULL, '2023-08-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (870, 3, NULL, '2023-08-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (871, 3, NULL, '2023-08-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (872, 3, NULL, '2023-08-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (873, 3, NULL, '2023-08-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (874, 3, NULL, '2023-09-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (875, 3, NULL, '2023-09-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (876, 3, NULL, '2023-09-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (877, 3, NULL, '2023-09-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (878, 3, NULL, '2023-09-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (879, 3, NULL, '2023-09-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (880, 3, NULL, '2023-09-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (881, 3, NULL, '2023-09-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (882, 3, NULL, '2023-09-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (883, 3, NULL, '2023-09-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (884, 3, NULL, '2023-09-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (885, 3, NULL, '2023-09-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (886, 3, NULL, '2023-09-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (887, 3, NULL, '2023-09-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (888, 3, NULL, '2023-09-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (889, 3, NULL, '2023-09-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (890, 3, NULL, '2023-09-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (891, 3, NULL, '2023-09-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (892, 3, NULL, '2023-09-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (893, 3, NULL, '2023-09-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (894, 3, NULL, '2023-09-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (895, 3, NULL, '2023-09-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (896, 3, NULL, '2023-09-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (897, 3, NULL, '2023-09-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (898, 3, NULL, '2023-09-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (899, 3, NULL, '2023-09-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (900, 3, NULL, '2023-09-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (902, 3, NULL, '2023-09-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (903, 3, NULL, '2023-09-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (904, 3, NULL, '2023-10-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (906, 3, NULL, '2023-10-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (907, 3, NULL, '2023-10-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (908, 3, NULL, '2023-10-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (909, 3, NULL, '2023-10-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (910, 3, NULL, '2023-10-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (911, 3, NULL, '2023-10-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (912, 3, NULL, '2023-10-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (913, 3, NULL, '2023-10-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (914, 3, NULL, '2023-10-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (915, 3, NULL, '2023-10-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (916, 3, NULL, '2023-10-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (917, 3, NULL, '2023-10-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (918, 3, NULL, '2023-10-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (919, 3, NULL, '2023-10-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (920, 3, NULL, '2023-10-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (921, 3, NULL, '2023-10-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (922, 3, NULL, '2023-10-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (923, 3, NULL, '2023-10-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (924, 3, NULL, '2023-10-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (925, 3, NULL, '2023-10-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (926, 3, NULL, '2023-10-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (927, 3, NULL, '2023-10-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (928, 3, NULL, '2023-10-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (929, 3, NULL, '2023-10-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (930, 3, NULL, '2023-10-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (931, 3, NULL, '2023-10-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (932, 3, NULL, '2023-10-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (933, 3, NULL, '2023-10-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (905, 3, NULL, '2023-10-02', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (934, 3, NULL, '2023-10-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (935, 3, NULL, '2023-11-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (936, 3, NULL, '2023-11-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (937, 3, NULL, '2023-11-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (938, 3, NULL, '2023-11-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (939, 3, NULL, '2023-11-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (940, 3, NULL, '2023-11-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (941, 3, NULL, '2023-11-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (942, 3, NULL, '2023-11-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (943, 3, NULL, '2023-11-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (944, 3, NULL, '2023-11-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (945, 3, NULL, '2023-11-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (947, 3, NULL, '2023-11-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (948, 3, NULL, '2023-11-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (949, 3, NULL, '2023-11-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (950, 3, NULL, '2023-11-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (951, 3, NULL, '2023-11-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (952, 3, NULL, '2023-11-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (953, 3, NULL, '2023-11-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (954, 3, NULL, '2023-11-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (955, 3, NULL, '2023-11-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (956, 3, NULL, '2023-11-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (957, 3, NULL, '2023-11-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (958, 3, NULL, '2023-11-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (960, 3, NULL, '2023-11-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (961, 3, NULL, '2023-11-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (962, 3, NULL, '2023-11-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (963, 3, NULL, '2023-11-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (964, 3, NULL, '2023-11-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (965, 3, NULL, '2023-12-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (966, 3, NULL, '2023-12-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (967, 3, NULL, '2023-12-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (968, 3, NULL, '2023-12-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (969, 3, NULL, '2023-12-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (970, 3, NULL, '2023-12-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (971, 3, NULL, '2023-12-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (972, 3, NULL, '2023-12-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (973, 3, NULL, '2023-12-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (974, 3, NULL, '2023-12-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (975, 3, NULL, '2023-12-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (976, 3, NULL, '2023-12-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (977, 3, NULL, '2023-12-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (978, 3, NULL, '2023-12-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (979, 3, NULL, '2023-12-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (980, 3, NULL, '2023-12-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (981, 3, NULL, '2023-12-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (982, 3, NULL, '2023-12-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (983, 3, NULL, '2023-12-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (984, 3, NULL, '2023-12-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (985, 3, NULL, '2023-12-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (987, 3, NULL, '2023-12-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (991, 3, NULL, '2023-12-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (992, 3, NULL, '2023-12-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (993, 3, NULL, '2023-12-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (994, 3, NULL, '2023-12-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (997, 3, NULL, '2024-01-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (998, 3, NULL, '2024-01-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (999, 3, NULL, '2024-01-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1000, 3, NULL, '2024-01-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1001, 3, NULL, '2024-01-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1002, 3, NULL, '2024-01-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1003, 3, NULL, '2024-01-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1004, 3, NULL, '2024-01-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1005, 3, NULL, '2024-01-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1006, 3, NULL, '2024-01-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1007, 3, NULL, '2024-01-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1008, 3, NULL, '2024-01-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1009, 3, NULL, '2024-01-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1010, 3, NULL, '2024-01-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1011, 3, NULL, '2024-01-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1012, 3, NULL, '2024-01-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1013, 3, NULL, '2024-01-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1014, 3, NULL, '2024-01-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1015, 3, NULL, '2024-01-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1016, 3, NULL, '2024-01-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1017, 3, NULL, '2024-01-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1018, 3, NULL, '2024-01-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1019, 3, NULL, '2024-01-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1020, 3, NULL, '2024-01-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1021, 3, NULL, '2024-01-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (986, 3, NULL, '2023-12-22', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (989, 3, NULL, '2023-12-25', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:18');
INSERT INTO shift_schedules VALUES (996, 3, NULL, '2024-01-01', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:18');
INSERT INTO shift_schedules VALUES (1022, 3, NULL, '2024-01-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1023, 3, NULL, '2024-01-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1024, 3, NULL, '2024-01-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1025, 3, NULL, '2024-01-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1026, 3, NULL, '2024-01-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1027, 3, NULL, '2024-02-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1028, 3, NULL, '2024-02-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1029, 3, NULL, '2024-02-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1030, 3, NULL, '2024-02-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1031, 3, NULL, '2024-02-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1032, 3, NULL, '2024-02-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1033, 3, NULL, '2024-02-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1035, 3, NULL, '2024-02-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1037, 3, NULL, '2024-02-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1038, 3, NULL, '2024-02-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1039, 3, NULL, '2024-02-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1040, 3, NULL, '2024-02-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1041, 3, NULL, '2024-02-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1042, 3, NULL, '2024-02-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1043, 3, NULL, '2024-02-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1044, 3, NULL, '2024-02-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1045, 3, NULL, '2024-02-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1046, 3, NULL, '2024-02-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1047, 3, NULL, '2024-02-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1048, 3, NULL, '2024-02-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1049, 3, NULL, '2024-02-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1050, 3, NULL, '2024-02-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1051, 3, NULL, '2024-02-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1052, 3, NULL, '2024-02-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1053, 3, NULL, '2024-02-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1054, 3, NULL, '2024-02-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1055, 3, NULL, '2024-02-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1056, 3, NULL, '2024-03-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1057, 3, NULL, '2024-03-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1058, 3, NULL, '2024-03-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1059, 3, NULL, '2024-03-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1060, 3, NULL, '2024-03-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1061, 3, NULL, '2024-03-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1062, 3, NULL, '2024-03-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1063, 3, NULL, '2024-03-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1064, 3, NULL, '2024-03-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1065, 3, NULL, '2024-03-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1066, 3, NULL, '2024-03-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1068, 3, NULL, '2024-03-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1069, 3, NULL, '2024-03-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1070, 3, NULL, '2024-03-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1071, 3, NULL, '2024-03-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1072, 3, NULL, '2024-03-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1073, 3, NULL, '2024-03-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1074, 3, NULL, '2024-03-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1075, 3, NULL, '2024-03-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1076, 3, NULL, '2024-03-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1077, 3, NULL, '2024-03-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1078, 3, NULL, '2024-03-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1079, 3, NULL, '2024-03-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1080, 3, NULL, '2024-03-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1081, 3, NULL, '2024-03-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1082, 3, NULL, '2024-03-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1083, 3, NULL, '2024-03-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1085, 3, NULL, '2024-03-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1087, 3, NULL, '2024-04-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1088, 3, NULL, '2024-04-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-04-13 07:55:18', '2023-04-13 07:55:18');
INSERT INTO shift_schedules VALUES (1036, 3, NULL, '2024-02-10', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:18');
INSERT INTO shift_schedules VALUES (1084, 3, NULL, '2024-03-29', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:18');
INSERT INTO shift_schedules VALUES (1067, 3, NULL, '2024-03-12', 1, 'Approved', true, 'National Holiday', 'Ramadan Start', true, 2, '2023-04-13 07:55:18', '2023-04-15 14:46:26');
INSERT INTO shift_schedules VALUES (1086, 3, NULL, '2024-03-31', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:18');
INSERT INTO shift_schedules VALUES (1124, 4, NULL, '2023-08-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (24, 1, NULL, '2022-12-24', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:13', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (31, 1, NULL, '2022-12-31', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:13', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (53, 1, NULL, '2023-01-22', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:13', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (751, 3, NULL, '2023-05-01', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:17', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (768, 3, NULL, '2023-05-18', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:17', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (830, 3, NULL, '2023-07-19', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (859, 3, NULL, '2023-08-17', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (946, 3, NULL, '2023-11-12', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (995, 3, NULL, '2023-12-31', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:18');
INSERT INTO shift_schedules VALUES (128, 1, NULL, '2023-04-07', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (130, 1, NULL, '2023-04-09', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (145, 1, NULL, '2023-04-24', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (169, 1, NULL, '2023-05-18', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (186, 1, NULL, '2023-06-04', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (302, 1, NULL, '2023-09-28', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (306, 1, NULL, '2023-10-02', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (388, 2, NULL, '2022-12-22', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (398, 2, NULL, '2023-01-01', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (419, 2, NULL, '2023-01-22', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (478, 2, NULL, '2023-03-22', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (496, 2, NULL, '2023-04-09', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (511, 2, NULL, '2023-04-24', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (512, 2, NULL, '2023-04-25', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (552, 2, NULL, '2023-06-04', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (597, 2, NULL, '2023-07-19', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (668, 2, NULL, '2023-09-28', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (726, 2, NULL, '2023-11-25', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-10 12:14:14', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (743, 3, NULL, '2023-04-23', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:17', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (744, 3, NULL, '2023-04-24', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:17', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (783, 3, NULL, '2023-06-02', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (785, 3, NULL, '2023-06-04', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (901, 3, NULL, '2023-09-28', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (959, 3, NULL, '2023-11-25', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (988, 3, NULL, '2023-12-24', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:17');
INSERT INTO shift_schedules VALUES (990, 3, NULL, '2023-12-26', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:18');
INSERT INTO shift_schedules VALUES (1034, 3, NULL, '2024-02-08', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-04-13 07:55:18', '2023-06-05 15:59:18');
INSERT INTO shift_schedules VALUES (1089, 4, NULL, '2023-07-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1090, 4, NULL, '2023-07-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1091, 4, NULL, '2023-07-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1092, 4, NULL, '2023-07-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1093, 4, NULL, '2023-07-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1094, 4, NULL, '2023-07-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1095, 4, NULL, '2023-07-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1096, 4, NULL, '2023-07-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1097, 4, NULL, '2023-07-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1098, 4, NULL, '2023-07-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1099, 4, NULL, '2023-07-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1100, 4, NULL, '2023-07-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1101, 4, NULL, '2023-07-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1102, 4, NULL, '2023-07-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1103, 4, NULL, '2023-07-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1104, 4, NULL, '2023-07-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1105, 4, NULL, '2023-07-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1107, 4, NULL, '2023-07-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1108, 4, NULL, '2023-07-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1109, 4, NULL, '2023-07-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1110, 4, NULL, '2023-07-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1111, 4, NULL, '2023-07-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1112, 4, NULL, '2023-07-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1113, 4, NULL, '2023-07-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1114, 4, NULL, '2023-07-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1115, 4, NULL, '2023-07-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1116, 4, NULL, '2023-07-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1117, 4, NULL, '2023-07-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1118, 4, NULL, '2023-07-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1119, 4, NULL, '2023-08-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1120, 4, NULL, '2023-08-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1121, 4, NULL, '2023-08-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1122, 4, NULL, '2023-08-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1123, 4, NULL, '2023-08-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1125, 4, NULL, '2023-08-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1126, 4, NULL, '2023-08-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1127, 4, NULL, '2023-08-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1128, 4, NULL, '2023-08-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1129, 4, NULL, '2023-08-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1130, 4, NULL, '2023-08-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1131, 4, NULL, '2023-08-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1132, 4, NULL, '2023-08-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1133, 4, NULL, '2023-08-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1134, 4, NULL, '2023-08-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1136, 4, NULL, '2023-08-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1137, 4, NULL, '2023-08-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1138, 4, NULL, '2023-08-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1139, 4, NULL, '2023-08-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1140, 4, NULL, '2023-08-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1141, 4, NULL, '2023-08-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1142, 4, NULL, '2023-08-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1143, 4, NULL, '2023-08-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1144, 4, NULL, '2023-08-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1145, 4, NULL, '2023-08-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1146, 4, NULL, '2023-08-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1147, 4, NULL, '2023-08-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1148, 4, NULL, '2023-08-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1149, 4, NULL, '2023-08-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1150, 4, NULL, '2023-09-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1151, 4, NULL, '2023-09-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1152, 4, NULL, '2023-09-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1153, 4, NULL, '2023-09-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1154, 4, NULL, '2023-09-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1155, 4, NULL, '2023-09-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1156, 4, NULL, '2023-09-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1157, 4, NULL, '2023-09-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1158, 4, NULL, '2023-09-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1159, 4, NULL, '2023-09-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1160, 4, NULL, '2023-09-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1161, 4, NULL, '2023-09-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1162, 4, NULL, '2023-09-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1163, 4, NULL, '2023-09-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1164, 4, NULL, '2023-09-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1165, 4, NULL, '2023-09-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1166, 4, NULL, '2023-09-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1167, 4, NULL, '2023-09-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1168, 4, NULL, '2023-09-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1169, 4, NULL, '2023-09-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1170, 4, NULL, '2023-09-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1171, 4, NULL, '2023-09-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1172, 4, NULL, '2023-09-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1173, 4, NULL, '2023-09-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1174, 4, NULL, '2023-09-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1175, 4, NULL, '2023-09-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1176, 4, NULL, '2023-09-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1178, 4, NULL, '2023-09-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1179, 4, NULL, '2023-09-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1180, 4, NULL, '2023-10-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1182, 4, NULL, '2023-10-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1183, 4, NULL, '2023-10-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1184, 4, NULL, '2023-10-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1185, 4, NULL, '2023-10-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1186, 4, NULL, '2023-10-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1187, 4, NULL, '2023-10-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1188, 4, NULL, '2023-10-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1189, 4, NULL, '2023-10-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1190, 4, NULL, '2023-10-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1191, 4, NULL, '2023-10-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1192, 4, NULL, '2023-10-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1193, 4, NULL, '2023-10-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1194, 4, NULL, '2023-10-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1195, 4, NULL, '2023-10-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1196, 4, NULL, '2023-10-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1197, 4, NULL, '2023-10-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1198, 4, NULL, '2023-10-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1199, 4, NULL, '2023-10-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1200, 4, NULL, '2023-10-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1201, 4, NULL, '2023-10-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1202, 4, NULL, '2023-10-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1203, 4, NULL, '2023-10-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1204, 4, NULL, '2023-10-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1205, 4, NULL, '2023-10-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1206, 4, NULL, '2023-10-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1207, 4, NULL, '2023-10-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1208, 4, NULL, '2023-10-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1209, 4, NULL, '2023-10-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1210, 4, NULL, '2023-10-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1211, 4, NULL, '2023-11-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1212, 4, NULL, '2023-11-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1181, 4, NULL, '2023-10-02', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:57');
INSERT INTO shift_schedules VALUES (1213, 4, NULL, '2023-11-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1214, 4, NULL, '2023-11-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1215, 4, NULL, '2023-11-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1216, 4, NULL, '2023-11-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1217, 4, NULL, '2023-11-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1218, 4, NULL, '2023-11-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1219, 4, NULL, '2023-11-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1220, 4, NULL, '2023-11-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1221, 4, NULL, '2023-11-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1223, 4, NULL, '2023-11-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1224, 4, NULL, '2023-11-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1225, 4, NULL, '2023-11-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1226, 4, NULL, '2023-11-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1227, 4, NULL, '2023-11-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1228, 4, NULL, '2023-11-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1229, 4, NULL, '2023-11-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1230, 4, NULL, '2023-11-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1231, 4, NULL, '2023-11-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1232, 4, NULL, '2023-11-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1233, 4, NULL, '2023-11-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1234, 4, NULL, '2023-11-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1236, 4, NULL, '2023-11-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1237, 4, NULL, '2023-11-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1238, 4, NULL, '2023-11-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1239, 4, NULL, '2023-11-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1240, 4, NULL, '2023-11-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1241, 4, NULL, '2023-12-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1242, 4, NULL, '2023-12-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1243, 4, NULL, '2023-12-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1244, 4, NULL, '2023-12-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1245, 4, NULL, '2023-12-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1246, 4, NULL, '2023-12-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1247, 4, NULL, '2023-12-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1248, 4, NULL, '2023-12-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1249, 4, NULL, '2023-12-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1250, 4, NULL, '2023-12-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1251, 4, NULL, '2023-12-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1252, 4, NULL, '2023-12-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1253, 4, NULL, '2023-12-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1254, 4, NULL, '2023-12-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1255, 4, NULL, '2023-12-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1256, 4, NULL, '2023-12-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1257, 4, NULL, '2023-12-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1258, 4, NULL, '2023-12-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1259, 4, NULL, '2023-12-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1260, 4, NULL, '2023-12-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1261, 4, NULL, '2023-12-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1263, 4, NULL, '2023-12-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1267, 4, NULL, '2023-12-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1268, 4, NULL, '2023-12-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1269, 4, NULL, '2023-12-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1270, 4, NULL, '2023-12-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1273, 4, NULL, '2024-01-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1274, 4, NULL, '2024-01-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1275, 4, NULL, '2024-01-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1276, 4, NULL, '2024-01-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1277, 4, NULL, '2024-01-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1278, 4, NULL, '2024-01-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1279, 4, NULL, '2024-01-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1280, 4, NULL, '2024-01-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1281, 4, NULL, '2024-01-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1282, 4, NULL, '2024-01-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1283, 4, NULL, '2024-01-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1284, 4, NULL, '2024-01-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1285, 4, NULL, '2024-01-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1286, 4, NULL, '2024-01-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1287, 4, NULL, '2024-01-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1288, 4, NULL, '2024-01-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1289, 4, NULL, '2024-01-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1290, 4, NULL, '2024-01-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1291, 4, NULL, '2024-01-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1292, 4, NULL, '2024-01-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1293, 4, NULL, '2024-01-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1294, 4, NULL, '2024-01-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1295, 4, NULL, '2024-01-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1296, 4, NULL, '2024-01-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1297, 4, NULL, '2024-01-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1298, 4, NULL, '2024-01-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1299, 4, NULL, '2024-01-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1300, 4, NULL, '2024-01-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1262, 4, NULL, '2023-12-22', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:57');
INSERT INTO shift_schedules VALUES (1265, 4, NULL, '2023-12-25', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:57');
INSERT INTO shift_schedules VALUES (1271, 4, NULL, '2023-12-31', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1301, 4, NULL, '2024-01-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1302, 4, NULL, '2024-01-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1303, 4, NULL, '2024-02-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1304, 4, NULL, '2024-02-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1305, 4, NULL, '2024-02-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1306, 4, NULL, '2024-02-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1307, 4, NULL, '2024-02-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1308, 4, NULL, '2024-02-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1309, 4, NULL, '2024-02-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1311, 4, NULL, '2024-02-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1313, 4, NULL, '2024-02-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1314, 4, NULL, '2024-02-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1315, 4, NULL, '2024-02-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1316, 4, NULL, '2024-02-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1317, 4, NULL, '2024-02-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1318, 4, NULL, '2024-02-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1319, 4, NULL, '2024-02-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1320, 4, NULL, '2024-02-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1321, 4, NULL, '2024-02-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1322, 4, NULL, '2024-02-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1323, 4, NULL, '2024-02-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1324, 4, NULL, '2024-02-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1325, 4, NULL, '2024-02-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1326, 4, NULL, '2024-02-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1327, 4, NULL, '2024-02-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1328, 4, NULL, '2024-02-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1329, 4, NULL, '2024-02-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1330, 4, NULL, '2024-02-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1331, 4, NULL, '2024-02-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1332, 4, NULL, '2024-03-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1333, 4, NULL, '2024-03-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1334, 4, NULL, '2024-03-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1335, 4, NULL, '2024-03-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1336, 4, NULL, '2024-03-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1337, 4, NULL, '2024-03-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1338, 4, NULL, '2024-03-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1339, 4, NULL, '2024-03-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1340, 4, NULL, '2024-03-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1341, 4, NULL, '2024-03-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1342, 4, NULL, '2024-03-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1343, 4, NULL, '2024-03-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1344, 4, NULL, '2024-03-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1345, 4, NULL, '2024-03-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1346, 4, NULL, '2024-03-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1347, 4, NULL, '2024-03-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1348, 4, NULL, '2024-03-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1349, 4, NULL, '2024-03-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1350, 4, NULL, '2024-03-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1351, 4, NULL, '2024-03-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1352, 4, NULL, '2024-03-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1353, 4, NULL, '2024-03-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1354, 4, NULL, '2024-03-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1355, 4, NULL, '2024-03-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1356, 4, NULL, '2024-03-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1357, 4, NULL, '2024-03-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1358, 4, NULL, '2024-03-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1359, 4, NULL, '2024-03-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1361, 4, NULL, '2024-03-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1363, 4, NULL, '2024-04-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1364, 4, NULL, '2024-04-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1365, 4, NULL, '2024-04-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1366, 4, NULL, '2024-04-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1367, 4, NULL, '2024-04-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1368, 4, NULL, '2024-04-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1369, 4, NULL, '2024-04-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1370, 4, NULL, '2024-04-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1371, 4, NULL, '2024-04-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1372, 4, NULL, '2024-04-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1375, 4, NULL, '2024-04-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1376, 4, NULL, '2024-04-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1377, 4, NULL, '2024-04-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1378, 4, NULL, '2024-04-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1379, 4, NULL, '2024-04-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1380, 4, NULL, '2024-04-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1381, 4, NULL, '2024-04-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1382, 4, NULL, '2024-04-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1384, 4, NULL, '2024-04-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1385, 4, NULL, '2024-04-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1386, 4, NULL, '2024-04-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1387, 4, NULL, '2024-04-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1388, 4, NULL, '2024-04-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1360, 4, NULL, '2024-03-29', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1373, 4, NULL, '2024-04-11', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1383, 4, NULL, '2024-04-21', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1389, 4, NULL, '2024-04-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1390, 4, NULL, '2024-04-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1391, 4, NULL, '2024-04-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1392, 4, NULL, '2024-04-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1394, 4, NULL, '2024-05-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1395, 4, NULL, '2024-05-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1396, 4, NULL, '2024-05-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1397, 4, NULL, '2024-05-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1398, 4, NULL, '2024-05-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1399, 4, NULL, '2024-05-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1400, 4, NULL, '2024-05-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1402, 4, NULL, '2024-05-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1403, 4, NULL, '2024-05-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1404, 4, NULL, '2024-05-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1405, 4, NULL, '2024-05-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1406, 4, NULL, '2024-05-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1407, 4, NULL, '2024-05-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1408, 4, NULL, '2024-05-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1409, 4, NULL, '2024-05-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1410, 4, NULL, '2024-05-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1411, 4, NULL, '2024-05-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1412, 4, NULL, '2024-05-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1413, 4, NULL, '2024-05-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1414, 4, NULL, '2024-05-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1415, 4, NULL, '2024-05-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1416, 4, NULL, '2024-05-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1417, 4, NULL, '2024-05-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1418, 4, NULL, '2024-05-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1419, 4, NULL, '2024-05-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1420, 4, NULL, '2024-05-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1421, 4, NULL, '2024-05-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1422, 4, NULL, '2024-05-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1423, 4, NULL, '2024-05-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1425, 4, NULL, '2024-06-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:05:28', '2023-07-02 19:05:28');
INSERT INTO shift_schedules VALUES (1427, 5, NULL, '2022-03-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1428, 5, NULL, '2022-03-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1429, 5, NULL, '2022-03-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1430, 5, NULL, '2022-03-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1431, 5, NULL, '2022-03-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1432, 5, NULL, '2022-03-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1433, 5, NULL, '2022-03-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1434, 5, NULL, '2022-03-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1435, 5, NULL, '2022-03-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1436, 5, NULL, '2022-03-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1437, 5, NULL, '2022-03-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1438, 5, NULL, '2022-03-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1439, 5, NULL, '2022-03-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1440, 5, NULL, '2022-03-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1441, 5, NULL, '2022-03-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1442, 5, NULL, '2022-03-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1443, 5, NULL, '2022-03-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1444, 5, NULL, '2022-03-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1445, 5, NULL, '2022-03-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1446, 5, NULL, '2022-03-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1447, 5, NULL, '2022-03-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1448, 5, NULL, '2022-03-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1449, 5, NULL, '2022-03-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1450, 5, NULL, '2022-03-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1451, 5, NULL, '2022-03-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1452, 5, NULL, '2022-03-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1453, 5, NULL, '2022-03-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1454, 5, NULL, '2022-03-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1455, 5, NULL, '2022-04-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1456, 5, NULL, '2022-04-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1457, 5, NULL, '2022-04-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1458, 5, NULL, '2022-04-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1459, 5, NULL, '2022-04-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1460, 5, NULL, '2022-04-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1461, 5, NULL, '2022-04-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1462, 5, NULL, '2022-04-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1463, 5, NULL, '2022-04-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1464, 5, NULL, '2022-04-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1465, 5, NULL, '2022-04-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1466, 5, NULL, '2022-04-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1467, 5, NULL, '2022-04-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1468, 5, NULL, '2022-04-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1470, 5, NULL, '2022-04-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1472, 5, NULL, '2022-04-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1473, 5, NULL, '2022-04-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1474, 5, NULL, '2022-04-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1476, 5, NULL, '2022-04-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1424, 4, NULL, '2024-06-01', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1469, 5, NULL, '2022-04-15', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1475, 5, NULL, '2022-04-21', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1477, 5, NULL, '2022-04-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1478, 5, NULL, '2022-04-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1479, 5, NULL, '2022-04-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1480, 5, NULL, '2022-04-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1481, 5, NULL, '2022-04-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1482, 5, NULL, '2022-04-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1484, 5, NULL, '2022-04-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1491, 5, NULL, '2022-05-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1492, 5, NULL, '2022-05-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1493, 5, NULL, '2022-05-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1494, 5, NULL, '2022-05-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1495, 5, NULL, '2022-05-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1496, 5, NULL, '2022-05-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1497, 5, NULL, '2022-05-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1498, 5, NULL, '2022-05-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1499, 5, NULL, '2022-05-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1501, 5, NULL, '2022-05-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1502, 5, NULL, '2022-05-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1503, 5, NULL, '2022-05-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1504, 5, NULL, '2022-05-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1505, 5, NULL, '2022-05-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1506, 5, NULL, '2022-05-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1507, 5, NULL, '2022-05-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1508, 5, NULL, '2022-05-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1509, 5, NULL, '2022-05-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1511, 5, NULL, '2022-05-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1512, 5, NULL, '2022-05-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1513, 5, NULL, '2022-05-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1514, 5, NULL, '2022-05-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1515, 5, NULL, '2022-05-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1517, 5, NULL, '2022-06-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1518, 5, NULL, '2022-06-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1519, 5, NULL, '2022-06-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1520, 5, NULL, '2022-06-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1521, 5, NULL, '2022-06-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1522, 5, NULL, '2022-06-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1523, 5, NULL, '2022-06-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1524, 5, NULL, '2022-06-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1525, 5, NULL, '2022-06-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1526, 5, NULL, '2022-06-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1527, 5, NULL, '2022-06-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1528, 5, NULL, '2022-06-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1529, 5, NULL, '2022-06-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1530, 5, NULL, '2022-06-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1531, 5, NULL, '2022-06-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1532, 5, NULL, '2022-06-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1533, 5, NULL, '2022-06-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1534, 5, NULL, '2022-06-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1535, 5, NULL, '2022-06-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1536, 5, NULL, '2022-06-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1537, 5, NULL, '2022-06-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1538, 5, NULL, '2022-06-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1539, 5, NULL, '2022-06-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1540, 5, NULL, '2022-06-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1541, 5, NULL, '2022-06-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1542, 5, NULL, '2022-06-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1543, 5, NULL, '2022-06-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1544, 5, NULL, '2022-06-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1545, 5, NULL, '2022-06-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1546, 5, NULL, '2022-07-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1547, 5, NULL, '2022-07-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1548, 5, NULL, '2022-07-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1549, 5, NULL, '2022-07-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1550, 5, NULL, '2022-07-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1551, 5, NULL, '2022-07-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1552, 5, NULL, '2022-07-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1553, 5, NULL, '2022-07-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1554, 5, NULL, '2022-07-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1556, 5, NULL, '2022-07-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1557, 5, NULL, '2022-07-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1558, 5, NULL, '2022-07-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1559, 5, NULL, '2022-07-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1560, 5, NULL, '2022-07-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1561, 5, NULL, '2022-07-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1562, 5, NULL, '2022-07-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1563, 5, NULL, '2022-07-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1564, 5, NULL, '2022-07-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1486, 5, NULL, '2022-05-02', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1488, 5, NULL, '2022-05-04', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1490, 5, NULL, '2022-05-06', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1510, 5, NULL, '2022-05-26', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1555, 5, NULL, '2022-07-10', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1565, 5, NULL, '2022-07-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1566, 5, NULL, '2022-07-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1567, 5, NULL, '2022-07-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1568, 5, NULL, '2022-07-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1569, 5, NULL, '2022-07-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1570, 5, NULL, '2022-07-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1571, 5, NULL, '2022-07-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1572, 5, NULL, '2022-07-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1573, 5, NULL, '2022-07-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1574, 5, NULL, '2022-07-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1576, 5, NULL, '2022-07-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1577, 5, NULL, '2022-08-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1578, 5, NULL, '2022-08-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1579, 5, NULL, '2022-08-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1580, 5, NULL, '2022-08-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1581, 5, NULL, '2022-08-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1582, 5, NULL, '2022-08-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1583, 5, NULL, '2022-08-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1584, 5, NULL, '2022-08-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1585, 5, NULL, '2022-08-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1586, 5, NULL, '2022-08-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1587, 5, NULL, '2022-08-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1588, 5, NULL, '2022-08-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1589, 5, NULL, '2022-08-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1590, 5, NULL, '2022-08-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1591, 5, NULL, '2022-08-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1592, 5, NULL, '2022-08-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1594, 5, NULL, '2022-08-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1595, 5, NULL, '2022-08-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1596, 5, NULL, '2022-08-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1597, 5, NULL, '2022-08-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1598, 5, NULL, '2022-08-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1599, 5, NULL, '2022-08-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1600, 5, NULL, '2022-08-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1601, 5, NULL, '2022-08-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1602, 5, NULL, '2022-08-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1603, 5, NULL, '2022-08-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1604, 5, NULL, '2022-08-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1605, 5, NULL, '2022-08-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1606, 5, NULL, '2022-08-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1607, 5, NULL, '2022-08-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1608, 5, NULL, '2022-09-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1609, 5, NULL, '2022-09-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1610, 5, NULL, '2022-09-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1611, 5, NULL, '2022-09-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1612, 5, NULL, '2022-09-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1613, 5, NULL, '2022-09-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1614, 5, NULL, '2022-09-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1615, 5, NULL, '2022-09-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1616, 5, NULL, '2022-09-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1617, 5, NULL, '2022-09-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1618, 5, NULL, '2022-09-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1619, 5, NULL, '2022-09-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1620, 5, NULL, '2022-09-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1621, 5, NULL, '2022-09-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1622, 5, NULL, '2022-09-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1623, 5, NULL, '2022-09-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1624, 5, NULL, '2022-09-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1625, 5, NULL, '2022-09-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1626, 5, NULL, '2022-09-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1627, 5, NULL, '2022-09-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1628, 5, NULL, '2022-09-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1629, 5, NULL, '2022-09-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1630, 5, NULL, '2022-09-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1631, 5, NULL, '2022-09-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1632, 5, NULL, '2022-09-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1633, 5, NULL, '2022-09-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1634, 5, NULL, '2022-09-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1635, 5, NULL, '2022-09-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1636, 5, NULL, '2022-09-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1637, 5, NULL, '2022-09-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1638, 5, NULL, '2022-10-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1640, 5, NULL, '2022-10-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1641, 5, NULL, '2022-10-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1642, 5, NULL, '2022-10-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1643, 5, NULL, '2022-10-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1644, 5, NULL, '2022-10-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1646, 5, NULL, '2022-10-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1647, 5, NULL, '2022-10-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1648, 5, NULL, '2022-10-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1649, 5, NULL, '2022-10-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1650, 5, NULL, '2022-10-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1651, 5, NULL, '2022-10-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1652, 5, NULL, '2022-10-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1639, 5, NULL, '2022-10-02', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1653, 5, NULL, '2022-10-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1654, 5, NULL, '2022-10-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1655, 5, NULL, '2022-10-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1656, 5, NULL, '2022-10-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1657, 5, NULL, '2022-10-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1658, 5, NULL, '2022-10-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1659, 5, NULL, '2022-10-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1660, 5, NULL, '2022-10-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1662, 5, NULL, '2022-10-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1663, 5, NULL, '2022-10-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1664, 5, NULL, '2022-10-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1665, 5, NULL, '2022-10-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1666, 5, NULL, '2022-10-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1667, 5, NULL, '2022-10-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1668, 5, NULL, '2022-10-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1669, 5, NULL, '2022-11-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1670, 5, NULL, '2022-11-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1671, 5, NULL, '2022-11-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1672, 5, NULL, '2022-11-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1673, 5, NULL, '2022-11-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1674, 5, NULL, '2022-11-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1675, 5, NULL, '2022-11-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1676, 5, NULL, '2022-11-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1677, 5, NULL, '2022-11-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1678, 5, NULL, '2022-11-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1679, 5, NULL, '2022-11-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1681, 5, NULL, '2022-11-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1682, 5, NULL, '2022-11-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1683, 5, NULL, '2022-11-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1684, 5, NULL, '2022-11-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1685, 5, NULL, '2022-11-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1686, 5, NULL, '2022-11-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1687, 5, NULL, '2022-11-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1688, 5, NULL, '2022-11-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1689, 5, NULL, '2022-11-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1690, 5, NULL, '2022-11-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1691, 5, NULL, '2022-11-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1692, 5, NULL, '2022-11-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1694, 5, NULL, '2022-11-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1695, 5, NULL, '2022-11-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1696, 5, NULL, '2022-11-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1697, 5, NULL, '2022-11-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1698, 5, NULL, '2022-11-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1699, 5, NULL, '2022-12-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1700, 5, NULL, '2022-12-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1701, 5, NULL, '2022-12-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1702, 5, NULL, '2022-12-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1703, 5, NULL, '2022-12-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1704, 5, NULL, '2022-12-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1705, 5, NULL, '2022-12-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1706, 5, NULL, '2022-12-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1707, 5, NULL, '2022-12-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1708, 5, NULL, '2022-12-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1709, 5, NULL, '2022-12-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1710, 5, NULL, '2022-12-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1711, 5, NULL, '2022-12-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1712, 5, NULL, '2022-12-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1713, 5, NULL, '2022-12-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1714, 5, NULL, '2022-12-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1715, 5, NULL, '2022-12-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1716, 5, NULL, '2022-12-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1717, 5, NULL, '2022-12-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1718, 5, NULL, '2022-12-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1719, 5, NULL, '2022-12-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1721, 5, NULL, '2022-12-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1724, 5, NULL, '2022-12-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1725, 5, NULL, '2022-12-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1726, 5, NULL, '2022-12-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1727, 5, NULL, '2022-12-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1728, 5, NULL, '2022-12-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1731, 5, NULL, '2023-01-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1732, 5, NULL, '2023-01-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1733, 5, NULL, '2023-01-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1734, 5, NULL, '2023-01-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1735, 5, NULL, '2023-01-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1736, 5, NULL, '2023-01-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1737, 5, NULL, '2023-01-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1738, 5, NULL, '2023-01-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1739, 5, NULL, '2023-01-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1740, 5, NULL, '2023-01-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1693, 5, NULL, '2022-11-25', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1722, 5, NULL, '2022-12-24', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1729, 5, NULL, '2022-12-31', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1741, 5, NULL, '2023-01-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1742, 5, NULL, '2023-01-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1743, 5, NULL, '2023-01-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1744, 5, NULL, '2023-01-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1745, 5, NULL, '2023-01-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1746, 5, NULL, '2023-01-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1747, 5, NULL, '2023-01-18', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1748, 5, NULL, '2023-01-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1749, 5, NULL, '2023-01-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1750, 5, NULL, '2023-01-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1753, 5, NULL, '2023-01-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1754, 5, NULL, '2023-01-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1755, 5, NULL, '2023-01-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1756, 5, NULL, '2023-01-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1757, 5, NULL, '2023-01-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1758, 5, NULL, '2023-01-29', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1759, 5, NULL, '2023-01-30', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1760, 5, NULL, '2023-01-31', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1761, 5, NULL, '2023-02-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1762, 5, NULL, '2023-02-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1763, 5, NULL, '2023-02-03', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1764, 5, NULL, '2023-02-04', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1765, 5, NULL, '2023-02-05', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1766, 5, NULL, '2023-02-06', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1767, 5, NULL, '2023-02-07', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1768, 5, NULL, '2023-02-08', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1769, 5, NULL, '2023-02-09', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1770, 5, NULL, '2023-02-10', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1771, 5, NULL, '2023-02-11', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1772, 5, NULL, '2023-02-12', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1773, 5, NULL, '2023-02-13', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1774, 5, NULL, '2023-02-14', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1775, 5, NULL, '2023-02-15', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1776, 5, NULL, '2023-02-16', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1777, 5, NULL, '2023-02-17', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1779, 5, NULL, '2023-02-19', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1780, 5, NULL, '2023-02-20', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1781, 5, NULL, '2023-02-21', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1782, 5, NULL, '2023-02-22', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1783, 5, NULL, '2023-02-23', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1784, 5, NULL, '2023-02-24', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1785, 5, NULL, '2023-02-25', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1786, 5, NULL, '2023-02-26', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1787, 5, NULL, '2023-02-27', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1788, 5, NULL, '2023-02-28', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1789, 5, NULL, '2023-03-01', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1790, 5, NULL, '2023-03-02', 1, 'Approved', false, NULL, NULL, true, 2, '2023-07-02 19:08:40', '2023-07-02 19:08:40');
INSERT INTO shift_schedules VALUES (1106, 4, NULL, '2023-07-19', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:57');
INSERT INTO shift_schedules VALUES (1135, 4, NULL, '2023-08-17', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:57');
INSERT INTO shift_schedules VALUES (1177, 4, NULL, '2023-09-28', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:57');
INSERT INTO shift_schedules VALUES (1222, 4, NULL, '2023-11-12', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:57');
INSERT INTO shift_schedules VALUES (1235, 4, NULL, '2023-11-25', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:57');
INSERT INTO shift_schedules VALUES (1264, 4, NULL, '2023-12-24', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:57');
INSERT INTO shift_schedules VALUES (1266, 4, NULL, '2023-12-26', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:57');
INSERT INTO shift_schedules VALUES (1272, 4, NULL, '2024-01-01', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1310, 4, NULL, '2024-02-08', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1312, 4, NULL, '2024-02-10', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1362, 4, NULL, '2024-03-31', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1374, 4, NULL, '2024-04-12', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1393, 4, NULL, '2024-05-01', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1401, 4, NULL, '2024-05-09', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:05:28', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1426, 5, NULL, '2022-03-03', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1471, 5, NULL, '2022-04-17', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1483, 5, NULL, '2022-04-29', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1485, 5, NULL, '2022-05-01', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1487, 5, NULL, '2022-05-03', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1752, 5, NULL, '2023-01-23', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1489, 5, NULL, '2022-05-05', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1500, 5, NULL, '2022-05-16', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1516, 5, NULL, '2022-06-01', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1575, 5, NULL, '2022-07-30', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1593, 5, NULL, '2022-08-17', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1645, 5, NULL, '2022-10-08', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1661, 5, NULL, '2022-10-24', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1680, 5, NULL, '2022-11-12', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1720, 5, NULL, '2022-12-22', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1723, 5, NULL, '2022-12-25', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1730, 5, NULL, '2023-01-01', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1751, 5, NULL, '2023-01-22', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');
INSERT INTO shift_schedules VALUES (1778, 5, NULL, '2023-02-18', 1, 'Approved', true, 'National Holiday', 'Deprecated! please use V2 https://github.com/guangrei/APIHariLibur_V2', true, 2, '2023-07-02 19:08:40', '2023-07-05 16:08:58');


--
-- Name: shift_schedules_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('shift_schedules_id_seq', 1790, true);


--
-- Data for Name: shift_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO shift_types VALUES (1, 1, 'Reguler', '08:00:00', '17:00:00', false, 2, '2023-04-10 12:14:14', '2023-05-07 13:28:56');


--
-- Name: shift_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('shift_types_id_seq', 1, true);


--
-- Data for Name: timesheet_approvals; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: timesheet_approvals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('timesheet_approvals_id_seq', 1, false);


--
-- Data for Name: timesheets; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: timesheets_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('timesheets_id_seq', 1, false);


--
-- Data for Name: travel; Type: TABLE DATA; Schema: public; Owner: pehadirm
--



--
-- Name: travel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('travel_id_seq', 1, false);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

INSERT INTO users VALUES (1, 'Super Admin', 'superadmin@example.com', NULL, '$2y$10$Gx0NOpysEhZny7ZAmNcCa.ySYD.S1aX/EN/ni2U1u8FwZu1sy2iFW', NULL, NULL, 'super admin', '', 'en', 0, NULL, 1, 1, NULL, NULL, '2023-04-10 12:14:13', '2023-04-10 12:14:13');
INSERT INTO users VALUES (8, 'slametw', 'stt@gmail.com', NULL, 'phadir123', NULL, NULL, 'user', NULL, NULL, 0, NULL, 1, 1, NULL, NULL, '2023-07-08 12:39:45', '2023-07-08 12:39:45');
INSERT INTO users VALUES (4, 'accountant2', 'accountant2@pehadir.com', NULL, '$2y$10$4N7EvOGk3bW1zLmxCsqMVuDmAOO77qhPKfAbNDwwV40zxB1GkZZtO', NULL, NULL, 'accountant', '', 'en', 2, 1, 1, 1, NULL, NULL, '2023-04-10 12:14:13', '2023-04-12 11:41:26');
INSERT INTO users VALUES (3, 'accountant', 'accountant@example.com', NULL, '$2y$10$Da2tDscOyIJa8UkKnuXm8ebUNfKpAA/H4XyiaZXKmLQdvoNXZVo9C', NULL, NULL, 'accountant', '', 'en', 2, 1, 1, 1, NULL, NULL, '2023-04-10 12:14:13', '2023-04-12 11:41:26');
INSERT INTO users VALUES (11, 'slametw', 'spt@gmail.com', NULL, 'phadir123', NULL, NULL, 'user', NULL, NULL, 0, NULL, 1, 1, NULL, NULL, '2023-07-08 12:41:42', '2023-07-08 12:41:42');
INSERT INTO users VALUES (5, 'Suali', 'suali@gmail.com', NULL, '$2y$10$U7hMbDCHPrwL/hxZrUyNBO6xKu5bdkOM3LfjbzT7EaqA6tNDomdde', NULL, NULL, 'accountant', NULL, 'en', 2, NULL, 1, 1, '2023-04-13 07:57:42', NULL, '2023-04-13 07:55:17', '2023-04-13 07:57:42');
INSERT INTO users VALUES (2, 'company', 'company@pehadir.com', NULL, '$2y$10$5WoKU7nQQPuv9E7EFnQ/C.x5f5BVb3VPGXgqNGrLoinvTRnMLlO8e', 1, NULL, 'company', '', 'en', 1, 1, 1, 1, '2023-07-09 03:09:57', NULL, '2023-04-10 12:14:13', '2023-07-09 03:09:57');
INSERT INTO users VALUES (6, 'jovi', 'jov@gmail.com', NULL, '$2y$10$lWt/Smm1kfuiyp2MDwZqvuYRMARyXsnN5RWi1kiO928an//j48VPG', NULL, NULL, 'coba', NULL, 'en', 2, NULL, 1, 1, NULL, NULL, '2023-07-02 19:05:28', '2023-07-02 19:40:19');
INSERT INTO users VALUES (7, 'coba', 'coba@gmail.com', NULL, '$2y$10$x1EEAcOS2f3/9KjGznQc8eqtmsWCyyjwBggTxpnRJ/Co3dpwiLXV.', NULL, NULL, 'coba', NULL, 'en', 2, NULL, 1, 1, '2023-07-02 19:43:35', NULL, '2023-07-02 19:08:40', '2023-07-02 19:43:35');


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('users_id_seq', 11, true);


--
-- Name: all_requests_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY all_requests
    ADD CONSTRAINT all_requests_pkey PRIMARY KEY (id);


--
-- Name: allowance_finances_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY allowance_finances
    ADD CONSTRAINT allowance_finances_pkey PRIMARY KEY (id);


--
-- Name: allowance_options_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY allowance_options
    ADD CONSTRAINT allowance_options_pkey PRIMARY KEY (id);


--
-- Name: allowances_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY allowances
    ADD CONSTRAINT allowances_pkey PRIMARY KEY (id);


--
-- Name: attendance_employees_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY attendance_employees
    ADD CONSTRAINT attendance_employees_pkey PRIMARY KEY (id);


--
-- Name: branches_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY branches
    ADD CONSTRAINT branches_pkey PRIMARY KEY (id);


--
-- Name: break_times_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY break_times
    ADD CONSTRAINT break_times_pkey PRIMARY KEY (id);


--
-- Name: cashes_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY cashes
    ADD CONSTRAINT cashes_pkey PRIMARY KEY (id);


--
-- Name: checklist_attendance_summaries_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY checklist_attendance_summaries
    ADD CONSTRAINT checklist_attendance_summaries_pkey PRIMARY KEY (id);


--
-- Name: company_holidays_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY company_holidays
    ADD CONSTRAINT company_holidays_pkey PRIMARY KEY (id);


--
-- Name: day_types_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY day_types
    ADD CONSTRAINT day_types_pkey PRIMARY KEY (id);


--
-- Name: dayoffs_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY dayoffs
    ADD CONSTRAINT dayoffs_pkey PRIMARY KEY (id);


--
-- Name: dendas_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY dendas
    ADD CONSTRAINT dendas_pkey PRIMARY KEY (id);


--
-- Name: documents_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY documents
    ADD CONSTRAINT documents_pkey PRIMARY KEY (id);


--
-- Name: employee_documents_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY employee_documents
    ADD CONSTRAINT employee_documents_pkey PRIMARY KEY (id);


--
-- Name: employee_education_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY employee_education
    ADD CONSTRAINT employee_education_pkey PRIMARY KEY (id);


--
-- Name: employee_experiences_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY employee_experiences
    ADD CONSTRAINT employee_experiences_pkey PRIMARY KEY (id);


--
-- Name: employee_medicals_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY employee_medicals
    ADD CONSTRAINT employee_medicals_pkey PRIMARY KEY (id);


--
-- Name: employees_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY employees
    ADD CONSTRAINT employees_pkey PRIMARY KEY (id);


--
-- Name: employements_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY employements
    ADD CONSTRAINT employements_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: families_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY families
    ADD CONSTRAINT families_pkey PRIMARY KEY (id);


--
-- Name: history_leaves_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY history_leaves
    ADD CONSTRAINT history_leaves_pkey PRIMARY KEY (id);


--
-- Name: leave_approvals_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY leave_approvals
    ADD CONSTRAINT leave_approvals_pkey PRIMARY KEY (id);


--
-- Name: leave_types_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY leave_types
    ADD CONSTRAINT leave_types_pkey PRIMARY KEY (id);


--
-- Name: leaves_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY leaves
    ADD CONSTRAINT leaves_pkey PRIMARY KEY (id);


--
-- Name: level_approvals_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY level_approvals
    ADD CONSTRAINT level_approvals_pkey PRIMARY KEY (id);


--
-- Name: loan_options_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY loan_options
    ADD CONSTRAINT loan_options_pkey PRIMARY KEY (id);


--
-- Name: loans_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY loans
    ADD CONSTRAINT loans_pkey PRIMARY KEY (id);


--
-- Name: log_attendances_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY log_attendances
    ADD CONSTRAINT log_attendances_pkey PRIMARY KEY (id);


--
-- Name: log_employee_resumes_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY log_employee_resumes
    ADD CONSTRAINT log_employee_resumes_pkey PRIMARY KEY (id);


--
-- Name: migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: model_has_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY model_has_permissions
    ADD CONSTRAINT model_has_permissions_pkey PRIMARY KEY (permission_id, model_id, model_type);


--
-- Name: model_has_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY model_has_roles
    ADD CONSTRAINT model_has_roles_pkey PRIMARY KEY (role_id, model_id, model_type);


--
-- Name: on_duty_approvals_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY on_duty_approvals
    ADD CONSTRAINT on_duty_approvals_pkey PRIMARY KEY (id);


--
-- Name: overtime_approvals_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY overtime_approvals
    ADD CONSTRAINT overtime_approvals_pkey PRIMARY KEY (id);


--
-- Name: overtime_types_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY overtime_types
    ADD CONSTRAINT overtime_types_pkey PRIMARY KEY (id);


--
-- Name: overtimes_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY overtimes
    ADD CONSTRAINT overtimes_pkey PRIMARY KEY (id);


--
-- Name: pay_slips_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY pay_slips
    ADD CONSTRAINT pay_slips_pkey PRIMARY KEY (id);


--
-- Name: payrolls_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY payrolls
    ADD CONSTRAINT payrolls_pkey PRIMARY KEY (id);


--
-- Name: payslip_code_pins_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY payslip_code_pins
    ADD CONSTRAINT payslip_code_pins_pkey PRIMARY KEY (id);


--
-- Name: payslip_types_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY payslip_types
    ADD CONSTRAINT payslip_types_pkey PRIMARY KEY (id);


--
-- Name: performance_reviews_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY performance_reviews
    ADD CONSTRAINT performance_reviews_pkey PRIMARY KEY (id);


--
-- Name: permissions_name_guard_name_unique; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY permissions
    ADD CONSTRAINT permissions_name_guard_name_unique UNIQUE (name, guard_name);


--
-- Name: permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY permissions
    ADD CONSTRAINT permissions_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: project_users_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY project_users
    ADD CONSTRAINT project_users_pkey PRIMARY KEY (id);


--
-- Name: projects_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY projects
    ADD CONSTRAINT projects_pkey PRIMARY KEY (id);


--
-- Name: ptkp_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY ptkp
    ADD CONSTRAINT ptkp_pkey PRIMARY KEY (id);


--
-- Name: reimburstment_options_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY reimburstment_options
    ADD CONSTRAINT reimburstment_options_pkey PRIMARY KEY (id);


--
-- Name: reimbursts_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY reimbursts
    ADD CONSTRAINT reimbursts_pkey PRIMARY KEY (id);


--
-- Name: req_shift_schedules_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY req_shift_schedules
    ADD CONSTRAINT req_shift_schedules_pkey PRIMARY KEY (id);


--
-- Name: request_shift_schedule_approvals_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY request_shift_schedule_approvals
    ADD CONSTRAINT request_shift_schedule_approvals_pkey PRIMARY KEY (id);


--
-- Name: role_has_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY role_has_permissions
    ADD CONSTRAINT role_has_permissions_pkey PRIMARY KEY (permission_id, role_id);


--
-- Name: roles_name_guard_name_unique; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY roles
    ADD CONSTRAINT roles_name_guard_name_unique UNIQUE (name, guard_name);


--
-- Name: roles_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- Name: set_bpjstk_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY set_bpjstk
    ADD CONSTRAINT set_bpjstk_pkey PRIMARY KEY (id);


--
-- Name: set_ptkp_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY set_ptkp
    ADD CONSTRAINT set_ptkp_pkey PRIMARY KEY (id);


--
-- Name: settings_name_created_by_unique; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY settings
    ADD CONSTRAINT settings_name_created_by_unique UNIQUE (name, created_by);


--
-- Name: settings_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY settings
    ADD CONSTRAINT settings_pkey PRIMARY KEY (id);


--
-- Name: shift_schedules_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY shift_schedules
    ADD CONSTRAINT shift_schedules_pkey PRIMARY KEY (id);


--
-- Name: shift_types_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY shift_types
    ADD CONSTRAINT shift_types_pkey PRIMARY KEY (id);


--
-- Name: timesheet_approvals_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY timesheet_approvals
    ADD CONSTRAINT timesheet_approvals_pkey PRIMARY KEY (id);


--
-- Name: timesheets_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY timesheets
    ADD CONSTRAINT timesheets_pkey PRIMARY KEY (id);


--
-- Name: travel_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY travel
    ADD CONSTRAINT travel_pkey PRIMARY KEY (id);


--
-- Name: users_email_unique; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: pehadirm; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: model_has_permissions_model_id_model_type_index; Type: INDEX; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE INDEX model_has_permissions_model_id_model_type_index ON model_has_permissions USING btree (model_id, model_type);


--
-- Name: model_has_roles_model_id_model_type_index; Type: INDEX; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE INDEX model_has_roles_model_id_model_type_index ON model_has_roles USING btree (model_id, model_type);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE INDEX password_resets_email_index ON password_resets USING btree (email);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: pehadirm; Tablespace: 
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: model_has_permissions_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY model_has_permissions
    ADD CONSTRAINT model_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE;


--
-- Name: model_has_roles_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY model_has_roles
    ADD CONSTRAINT model_has_roles_role_id_foreign FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE;


--
-- Name: role_has_permissions_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY role_has_permissions
    ADD CONSTRAINT role_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE;


--
-- Name: role_has_permissions_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: pehadirm
--

ALTER TABLE ONLY role_has_permissions
    ADD CONSTRAINT role_has_permissions_role_id_foreign FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: all_requests; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE all_requests FROM PUBLIC;
REVOKE ALL ON TABLE all_requests FROM pehadirm;
GRANT ALL ON TABLE all_requests TO pehadirm;
GRANT ALL ON TABLE all_requests TO pehadirm_pehadir_user;
GRANT ALL ON TABLE all_requests TO pehadirm_pehadir_new;


--
-- Name: all_requests_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE all_requests_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE all_requests_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE all_requests_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE all_requests_id_seq TO pehadirm_pehadir_user;


--
-- Name: allowance_finances; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE allowance_finances FROM PUBLIC;
REVOKE ALL ON TABLE allowance_finances FROM pehadirm;
GRANT ALL ON TABLE allowance_finances TO pehadirm;
GRANT ALL ON TABLE allowance_finances TO pehadirm_pehadir_user;
GRANT ALL ON TABLE allowance_finances TO pehadirm_pehadir_new;


--
-- Name: allowance_finances_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE allowance_finances_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE allowance_finances_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE allowance_finances_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE allowance_finances_id_seq TO pehadirm_pehadir_user;


--
-- Name: allowance_options; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE allowance_options FROM PUBLIC;
REVOKE ALL ON TABLE allowance_options FROM pehadirm;
GRANT ALL ON TABLE allowance_options TO pehadirm;
GRANT ALL ON TABLE allowance_options TO pehadirm_pehadir_user;
GRANT ALL ON TABLE allowance_options TO pehadirm_pehadir_new;


--
-- Name: allowance_options_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE allowance_options_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE allowance_options_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE allowance_options_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE allowance_options_id_seq TO pehadirm_pehadir_user;


--
-- Name: allowances; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE allowances FROM PUBLIC;
REVOKE ALL ON TABLE allowances FROM pehadirm;
GRANT ALL ON TABLE allowances TO pehadirm;
GRANT ALL ON TABLE allowances TO pehadirm_pehadir_user;
GRANT ALL ON TABLE allowances TO pehadirm_pehadir_new;


--
-- Name: allowances_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE allowances_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE allowances_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE allowances_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE allowances_id_seq TO pehadirm_pehadir_user;


--
-- Name: attendance_employees; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE attendance_employees FROM PUBLIC;
REVOKE ALL ON TABLE attendance_employees FROM pehadirm;
GRANT ALL ON TABLE attendance_employees TO pehadirm;
GRANT ALL ON TABLE attendance_employees TO pehadirm_pehadir_user;
GRANT ALL ON TABLE attendance_employees TO pehadirm_pehadir_new;


--
-- Name: attendance_employees_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE attendance_employees_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE attendance_employees_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE attendance_employees_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE attendance_employees_id_seq TO pehadirm_pehadir_user;


--
-- Name: branches; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE branches FROM PUBLIC;
REVOKE ALL ON TABLE branches FROM pehadirm;
GRANT ALL ON TABLE branches TO pehadirm;
GRANT ALL ON TABLE branches TO pehadirm_pehadir_user;
GRANT ALL ON TABLE branches TO pehadirm_pehadir_new;


--
-- Name: branches_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE branches_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE branches_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE branches_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE branches_id_seq TO pehadirm_pehadir_user;


--
-- Name: break_times; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE break_times FROM PUBLIC;
REVOKE ALL ON TABLE break_times FROM pehadirm;
GRANT ALL ON TABLE break_times TO pehadirm;
GRANT ALL ON TABLE break_times TO pehadirm_pehadir_user;
GRANT ALL ON TABLE break_times TO pehadirm_pehadir_new;


--
-- Name: break_times_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE break_times_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE break_times_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE break_times_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE break_times_id_seq TO pehadirm_pehadir_user;


--
-- Name: cashes; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE cashes FROM PUBLIC;
REVOKE ALL ON TABLE cashes FROM pehadirm;
GRANT ALL ON TABLE cashes TO pehadirm;
GRANT ALL ON TABLE cashes TO pehadirm_pehadir_user;
GRANT ALL ON TABLE cashes TO pehadirm_pehadir_new;


--
-- Name: cashes_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE cashes_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE cashes_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE cashes_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE cashes_id_seq TO pehadirm_pehadir_user;


--
-- Name: checklist_attendance_summaries; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE checklist_attendance_summaries FROM PUBLIC;
REVOKE ALL ON TABLE checklist_attendance_summaries FROM pehadirm;
GRANT ALL ON TABLE checklist_attendance_summaries TO pehadirm;
GRANT ALL ON TABLE checklist_attendance_summaries TO pehadirm_pehadir_user;
GRANT ALL ON TABLE checklist_attendance_summaries TO pehadirm_pehadir_new;


--
-- Name: checklist_attendance_summaries_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE checklist_attendance_summaries_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE checklist_attendance_summaries_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE checklist_attendance_summaries_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE checklist_attendance_summaries_id_seq TO pehadirm_pehadir_user;


--
-- Name: company_holidays; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE company_holidays FROM PUBLIC;
REVOKE ALL ON TABLE company_holidays FROM pehadirm;
GRANT ALL ON TABLE company_holidays TO pehadirm;
GRANT ALL ON TABLE company_holidays TO pehadirm_pehadir_user;
GRANT ALL ON TABLE company_holidays TO pehadirm_pehadir_new;


--
-- Name: company_holidays_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE company_holidays_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE company_holidays_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE company_holidays_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE company_holidays_id_seq TO pehadirm_pehadir_user;


--
-- Name: day_types; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE day_types FROM PUBLIC;
REVOKE ALL ON TABLE day_types FROM pehadirm;
GRANT ALL ON TABLE day_types TO pehadirm;
GRANT ALL ON TABLE day_types TO pehadirm_pehadir_user;
GRANT ALL ON TABLE day_types TO pehadirm_pehadir_new;


--
-- Name: day_types_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE day_types_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE day_types_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE day_types_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE day_types_id_seq TO pehadirm_pehadir_user;


--
-- Name: dayoffs; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE dayoffs FROM PUBLIC;
REVOKE ALL ON TABLE dayoffs FROM pehadirm;
GRANT ALL ON TABLE dayoffs TO pehadirm;
GRANT ALL ON TABLE dayoffs TO pehadirm_pehadir_user;
GRANT ALL ON TABLE dayoffs TO pehadirm_pehadir_new;


--
-- Name: dayoffs_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE dayoffs_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE dayoffs_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE dayoffs_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE dayoffs_id_seq TO pehadirm_pehadir_user;


--
-- Name: dendas; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE dendas FROM PUBLIC;
REVOKE ALL ON TABLE dendas FROM pehadirm;
GRANT ALL ON TABLE dendas TO pehadirm;
GRANT ALL ON TABLE dendas TO pehadirm_pehadir_user;
GRANT ALL ON TABLE dendas TO pehadirm_pehadir_new;


--
-- Name: dendas_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE dendas_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE dendas_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE dendas_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE dendas_id_seq TO pehadirm_pehadir_user;


--
-- Name: documents; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE documents FROM PUBLIC;
REVOKE ALL ON TABLE documents FROM pehadirm;
GRANT ALL ON TABLE documents TO pehadirm;
GRANT ALL ON TABLE documents TO pehadirm_pehadir_user;
GRANT ALL ON TABLE documents TO pehadirm_pehadir_new;


--
-- Name: documents_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE documents_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE documents_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE documents_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE documents_id_seq TO pehadirm_pehadir_user;


--
-- Name: employee_documents; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE employee_documents FROM PUBLIC;
REVOKE ALL ON TABLE employee_documents FROM pehadirm;
GRANT ALL ON TABLE employee_documents TO pehadirm;
GRANT ALL ON TABLE employee_documents TO pehadirm_pehadir_user;
GRANT ALL ON TABLE employee_documents TO pehadirm_pehadir_new;


--
-- Name: employee_documents_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE employee_documents_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE employee_documents_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE employee_documents_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE employee_documents_id_seq TO pehadirm_pehadir_user;


--
-- Name: employee_education; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE employee_education FROM PUBLIC;
REVOKE ALL ON TABLE employee_education FROM pehadirm;
GRANT ALL ON TABLE employee_education TO pehadirm;
GRANT ALL ON TABLE employee_education TO pehadirm_pehadir_user;
GRANT ALL ON TABLE employee_education TO pehadirm_pehadir_new;


--
-- Name: employee_education_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE employee_education_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE employee_education_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE employee_education_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE employee_education_id_seq TO pehadirm_pehadir_user;


--
-- Name: employee_experiences; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE employee_experiences FROM PUBLIC;
REVOKE ALL ON TABLE employee_experiences FROM pehadirm;
GRANT ALL ON TABLE employee_experiences TO pehadirm;
GRANT ALL ON TABLE employee_experiences TO pehadirm_pehadir_user;
GRANT ALL ON TABLE employee_experiences TO pehadirm_pehadir_new;


--
-- Name: employee_experiences_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE employee_experiences_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE employee_experiences_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE employee_experiences_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE employee_experiences_id_seq TO pehadirm_pehadir_user;


--
-- Name: employee_medicals; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE employee_medicals FROM PUBLIC;
REVOKE ALL ON TABLE employee_medicals FROM pehadirm;
GRANT ALL ON TABLE employee_medicals TO pehadirm;
GRANT ALL ON TABLE employee_medicals TO pehadirm_pehadir_user;
GRANT ALL ON TABLE employee_medicals TO pehadirm_pehadir_new;


--
-- Name: employee_medicals_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE employee_medicals_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE employee_medicals_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE employee_medicals_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE employee_medicals_id_seq TO pehadirm_pehadir_user;


--
-- Name: employees; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE employees FROM PUBLIC;
REVOKE ALL ON TABLE employees FROM pehadirm;
GRANT ALL ON TABLE employees TO pehadirm;
GRANT ALL ON TABLE employees TO pehadirm_pehadir_user;
GRANT ALL ON TABLE employees TO pehadirm_pehadir_new;


--
-- Name: employees_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE employees_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE employees_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE employees_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE employees_id_seq TO pehadirm_pehadir_user;


--
-- Name: employements; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE employements FROM PUBLIC;
REVOKE ALL ON TABLE employements FROM pehadirm;
GRANT ALL ON TABLE employements TO pehadirm;
GRANT ALL ON TABLE employements TO pehadirm_pehadir_user;
GRANT ALL ON TABLE employements TO pehadirm_pehadir_new;


--
-- Name: employements_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE employements_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE employements_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE employements_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE employements_id_seq TO pehadirm_pehadir_user;


--
-- Name: failed_jobs; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE failed_jobs FROM PUBLIC;
REVOKE ALL ON TABLE failed_jobs FROM pehadirm;
GRANT ALL ON TABLE failed_jobs TO pehadirm;
GRANT ALL ON TABLE failed_jobs TO pehadirm_pehadir_user;
GRANT ALL ON TABLE failed_jobs TO pehadirm_pehadir_new;


--
-- Name: failed_jobs_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE failed_jobs_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE failed_jobs_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE failed_jobs_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE failed_jobs_id_seq TO pehadirm_pehadir_user;


--
-- Name: families; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE families FROM PUBLIC;
REVOKE ALL ON TABLE families FROM pehadirm;
GRANT ALL ON TABLE families TO pehadirm;
GRANT ALL ON TABLE families TO pehadirm_pehadir_user;
GRANT ALL ON TABLE families TO pehadirm_pehadir_new;


--
-- Name: families_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE families_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE families_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE families_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE families_id_seq TO pehadirm_pehadir_user;


--
-- Name: history_leaves; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE history_leaves FROM PUBLIC;
REVOKE ALL ON TABLE history_leaves FROM pehadirm;
GRANT ALL ON TABLE history_leaves TO pehadirm;
GRANT ALL ON TABLE history_leaves TO pehadirm_pehadir_user;
GRANT ALL ON TABLE history_leaves TO pehadirm_pehadir_new;


--
-- Name: history_leaves_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE history_leaves_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE history_leaves_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE history_leaves_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE history_leaves_id_seq TO pehadirm_pehadir_user;


--
-- Name: leave_approvals; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE leave_approvals FROM PUBLIC;
REVOKE ALL ON TABLE leave_approvals FROM pehadirm;
GRANT ALL ON TABLE leave_approvals TO pehadirm;
GRANT ALL ON TABLE leave_approvals TO pehadirm_pehadir_user;
GRANT ALL ON TABLE leave_approvals TO pehadirm_pehadir_new;


--
-- Name: leave_approvals_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE leave_approvals_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE leave_approvals_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE leave_approvals_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE leave_approvals_id_seq TO pehadirm_pehadir_user;


--
-- Name: leave_types; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE leave_types FROM PUBLIC;
REVOKE ALL ON TABLE leave_types FROM pehadirm;
GRANT ALL ON TABLE leave_types TO pehadirm;
GRANT ALL ON TABLE leave_types TO pehadirm_pehadir_user;
GRANT ALL ON TABLE leave_types TO pehadirm_pehadir_new;


--
-- Name: leave_types_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE leave_types_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE leave_types_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE leave_types_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE leave_types_id_seq TO pehadirm_pehadir_user;


--
-- Name: leaves; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE leaves FROM PUBLIC;
REVOKE ALL ON TABLE leaves FROM pehadirm;
GRANT ALL ON TABLE leaves TO pehadirm;
GRANT ALL ON TABLE leaves TO pehadirm_pehadir_user;
GRANT ALL ON TABLE leaves TO pehadirm_pehadir_new;


--
-- Name: leaves_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE leaves_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE leaves_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE leaves_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE leaves_id_seq TO pehadirm_pehadir_user;


--
-- Name: level_approvals; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE level_approvals FROM PUBLIC;
REVOKE ALL ON TABLE level_approvals FROM pehadirm;
GRANT ALL ON TABLE level_approvals TO pehadirm;
GRANT ALL ON TABLE level_approvals TO pehadirm_pehadir_user;
GRANT ALL ON TABLE level_approvals TO pehadirm_pehadir_new;


--
-- Name: level_approvals_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE level_approvals_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE level_approvals_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE level_approvals_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE level_approvals_id_seq TO pehadirm_pehadir_user;


--
-- Name: loan_options; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE loan_options FROM PUBLIC;
REVOKE ALL ON TABLE loan_options FROM pehadirm;
GRANT ALL ON TABLE loan_options TO pehadirm;
GRANT ALL ON TABLE loan_options TO pehadirm_pehadir_user;
GRANT ALL ON TABLE loan_options TO pehadirm_pehadir_new;


--
-- Name: loan_options_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE loan_options_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE loan_options_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE loan_options_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE loan_options_id_seq TO pehadirm_pehadir_user;


--
-- Name: loans; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE loans FROM PUBLIC;
REVOKE ALL ON TABLE loans FROM pehadirm;
GRANT ALL ON TABLE loans TO pehadirm;
GRANT ALL ON TABLE loans TO pehadirm_pehadir_user;
GRANT ALL ON TABLE loans TO pehadirm_pehadir_new;


--
-- Name: loans_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE loans_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE loans_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE loans_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE loans_id_seq TO pehadirm_pehadir_user;


--
-- Name: log_attendances; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE log_attendances FROM PUBLIC;
REVOKE ALL ON TABLE log_attendances FROM pehadirm;
GRANT ALL ON TABLE log_attendances TO pehadirm;
GRANT ALL ON TABLE log_attendances TO pehadirm_pehadir_user;
GRANT ALL ON TABLE log_attendances TO pehadirm_pehadir_new;


--
-- Name: log_attendances_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE log_attendances_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE log_attendances_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE log_attendances_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE log_attendances_id_seq TO pehadirm_pehadir_user;


--
-- Name: log_employee_resumes; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE log_employee_resumes FROM PUBLIC;
REVOKE ALL ON TABLE log_employee_resumes FROM pehadirm;
GRANT ALL ON TABLE log_employee_resumes TO pehadirm;
GRANT ALL ON TABLE log_employee_resumes TO pehadirm_pehadir_user;
GRANT ALL ON TABLE log_employee_resumes TO pehadirm_pehadir_new;


--
-- Name: log_employee_resumes_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE log_employee_resumes_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE log_employee_resumes_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE log_employee_resumes_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE log_employee_resumes_id_seq TO pehadirm_pehadir_user;


--
-- Name: migrations; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE migrations FROM PUBLIC;
REVOKE ALL ON TABLE migrations FROM pehadirm;
GRANT ALL ON TABLE migrations TO pehadirm;
GRANT ALL ON TABLE migrations TO pehadirm_pehadir_user;
GRANT ALL ON TABLE migrations TO pehadirm_pehadir_new;


--
-- Name: model_has_permissions; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE model_has_permissions FROM PUBLIC;
REVOKE ALL ON TABLE model_has_permissions FROM pehadirm;
GRANT ALL ON TABLE model_has_permissions TO pehadirm;
GRANT ALL ON TABLE model_has_permissions TO pehadirm_pehadir_user;
GRANT ALL ON TABLE model_has_permissions TO pehadirm_pehadir_new;


--
-- Name: model_has_roles; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE model_has_roles FROM PUBLIC;
REVOKE ALL ON TABLE model_has_roles FROM pehadirm;
GRANT ALL ON TABLE model_has_roles TO pehadirm;
GRANT ALL ON TABLE model_has_roles TO pehadirm_pehadir_user;
GRANT ALL ON TABLE model_has_roles TO pehadirm_pehadir_new;


--
-- Name: on_duty_approvals; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE on_duty_approvals FROM PUBLIC;
REVOKE ALL ON TABLE on_duty_approvals FROM pehadirm;
GRANT ALL ON TABLE on_duty_approvals TO pehadirm;
GRANT ALL ON TABLE on_duty_approvals TO pehadirm_pehadir_user;
GRANT ALL ON TABLE on_duty_approvals TO pehadirm_pehadir_new;


--
-- Name: on_duty_approvals_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE on_duty_approvals_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE on_duty_approvals_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE on_duty_approvals_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE on_duty_approvals_id_seq TO pehadirm_pehadir_user;


--
-- Name: overtime_approvals; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE overtime_approvals FROM PUBLIC;
REVOKE ALL ON TABLE overtime_approvals FROM pehadirm;
GRANT ALL ON TABLE overtime_approvals TO pehadirm;
GRANT ALL ON TABLE overtime_approvals TO pehadirm_pehadir_user;
GRANT ALL ON TABLE overtime_approvals TO pehadirm_pehadir_new;


--
-- Name: overtime_approvals_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE overtime_approvals_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE overtime_approvals_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE overtime_approvals_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE overtime_approvals_id_seq TO pehadirm_pehadir_user;


--
-- Name: overtime_types; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE overtime_types FROM PUBLIC;
REVOKE ALL ON TABLE overtime_types FROM pehadirm;
GRANT ALL ON TABLE overtime_types TO pehadirm;
GRANT ALL ON TABLE overtime_types TO pehadirm_pehadir_user;
GRANT ALL ON TABLE overtime_types TO pehadirm_pehadir_new;


--
-- Name: overtime_types_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE overtime_types_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE overtime_types_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE overtime_types_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE overtime_types_id_seq TO pehadirm_pehadir_user;


--
-- Name: overtimes; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE overtimes FROM PUBLIC;
REVOKE ALL ON TABLE overtimes FROM pehadirm;
GRANT ALL ON TABLE overtimes TO pehadirm;
GRANT ALL ON TABLE overtimes TO pehadirm_pehadir_user;
GRANT ALL ON TABLE overtimes TO pehadirm_pehadir_new;


--
-- Name: overtimes_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE overtimes_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE overtimes_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE overtimes_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE overtimes_id_seq TO pehadirm_pehadir_user;


--
-- Name: password_resets; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE password_resets FROM PUBLIC;
REVOKE ALL ON TABLE password_resets FROM pehadirm;
GRANT ALL ON TABLE password_resets TO pehadirm;
GRANT ALL ON TABLE password_resets TO pehadirm_pehadir_user;
GRANT ALL ON TABLE password_resets TO pehadirm_pehadir_new;


--
-- Name: pay_slips; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE pay_slips FROM PUBLIC;
REVOKE ALL ON TABLE pay_slips FROM pehadirm;
GRANT ALL ON TABLE pay_slips TO pehadirm;
GRANT ALL ON TABLE pay_slips TO pehadirm_pehadir_user;
GRANT ALL ON TABLE pay_slips TO pehadirm_pehadir_new;


--
-- Name: pay_slips_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE pay_slips_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE pay_slips_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE pay_slips_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE pay_slips_id_seq TO pehadirm_pehadir_user;


--
-- Name: payrolls; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE payrolls FROM PUBLIC;
REVOKE ALL ON TABLE payrolls FROM pehadirm;
GRANT ALL ON TABLE payrolls TO pehadirm;
GRANT ALL ON TABLE payrolls TO pehadirm_pehadir_user;
GRANT ALL ON TABLE payrolls TO pehadirm_pehadir_new;


--
-- Name: payrolls_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE payrolls_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE payrolls_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE payrolls_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE payrolls_id_seq TO pehadirm_pehadir_user;


--
-- Name: payslip_code_pins; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE payslip_code_pins FROM PUBLIC;
REVOKE ALL ON TABLE payslip_code_pins FROM pehadirm;
GRANT ALL ON TABLE payslip_code_pins TO pehadirm;
GRANT ALL ON TABLE payslip_code_pins TO pehadirm_pehadir_user;
GRANT ALL ON TABLE payslip_code_pins TO pehadirm_pehadir_new;


--
-- Name: payslip_code_pins_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE payslip_code_pins_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE payslip_code_pins_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE payslip_code_pins_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE payslip_code_pins_id_seq TO pehadirm_pehadir_user;


--
-- Name: payslip_types; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE payslip_types FROM PUBLIC;
REVOKE ALL ON TABLE payslip_types FROM pehadirm;
GRANT ALL ON TABLE payslip_types TO pehadirm;
GRANT ALL ON TABLE payslip_types TO pehadirm_pehadir_user;
GRANT ALL ON TABLE payslip_types TO pehadirm_pehadir_new;


--
-- Name: payslip_types_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE payslip_types_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE payslip_types_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE payslip_types_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE payslip_types_id_seq TO pehadirm_pehadir_user;


--
-- Name: performance_reviews; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE performance_reviews FROM PUBLIC;
REVOKE ALL ON TABLE performance_reviews FROM pehadirm;
GRANT ALL ON TABLE performance_reviews TO pehadirm;
GRANT ALL ON TABLE performance_reviews TO pehadirm_pehadir_user;
GRANT ALL ON TABLE performance_reviews TO pehadirm_pehadir_new;


--
-- Name: performance_reviews_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE performance_reviews_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE performance_reviews_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE performance_reviews_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE performance_reviews_id_seq TO pehadirm_pehadir_user;


--
-- Name: permissions; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE permissions FROM PUBLIC;
REVOKE ALL ON TABLE permissions FROM pehadirm;
GRANT ALL ON TABLE permissions TO pehadirm;
GRANT ALL ON TABLE permissions TO pehadirm_pehadir_user;
GRANT ALL ON TABLE permissions TO pehadirm_pehadir_new;


--
-- Name: permissions_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE permissions_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE permissions_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE permissions_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE permissions_id_seq TO pehadirm_pehadir_user;


--
-- Name: personal_access_tokens; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE personal_access_tokens FROM PUBLIC;
REVOKE ALL ON TABLE personal_access_tokens FROM pehadirm;
GRANT ALL ON TABLE personal_access_tokens TO pehadirm;
GRANT ALL ON TABLE personal_access_tokens TO pehadirm_pehadir_user;
GRANT ALL ON TABLE personal_access_tokens TO pehadirm_pehadir_new;


--
-- Name: personal_access_tokens_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE personal_access_tokens_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE personal_access_tokens_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE personal_access_tokens_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE personal_access_tokens_id_seq TO pehadirm_pehadir_user;


--
-- Name: project_users; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE project_users FROM PUBLIC;
REVOKE ALL ON TABLE project_users FROM pehadirm;
GRANT ALL ON TABLE project_users TO pehadirm;
GRANT ALL ON TABLE project_users TO pehadirm_pehadir_user;
GRANT ALL ON TABLE project_users TO pehadirm_pehadir_new;


--
-- Name: project_users_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE project_users_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE project_users_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE project_users_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE project_users_id_seq TO pehadirm_pehadir_user;


--
-- Name: projects; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE projects FROM PUBLIC;
REVOKE ALL ON TABLE projects FROM pehadirm;
GRANT ALL ON TABLE projects TO pehadirm;
GRANT ALL ON TABLE projects TO pehadirm_pehadir_user;
GRANT ALL ON TABLE projects TO pehadirm_pehadir_new;


--
-- Name: projects_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE projects_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE projects_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE projects_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE projects_id_seq TO pehadirm_pehadir_user;


--
-- Name: ptkp; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE ptkp FROM PUBLIC;
REVOKE ALL ON TABLE ptkp FROM pehadirm;
GRANT ALL ON TABLE ptkp TO pehadirm;
GRANT ALL ON TABLE ptkp TO pehadirm_pehadir_user;
GRANT ALL ON TABLE ptkp TO pehadirm_pehadir_new;


--
-- Name: ptkp_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE ptkp_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE ptkp_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE ptkp_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE ptkp_id_seq TO pehadirm_pehadir_user;


--
-- Name: reimburstment_options; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE reimburstment_options FROM PUBLIC;
REVOKE ALL ON TABLE reimburstment_options FROM pehadirm;
GRANT ALL ON TABLE reimburstment_options TO pehadirm;
GRANT ALL ON TABLE reimburstment_options TO pehadirm_pehadir_user;
GRANT ALL ON TABLE reimburstment_options TO pehadirm_pehadir_new;


--
-- Name: reimburstment_options_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE reimburstment_options_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE reimburstment_options_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE reimburstment_options_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE reimburstment_options_id_seq TO pehadirm_pehadir_user;


--
-- Name: reimbursts; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE reimbursts FROM PUBLIC;
REVOKE ALL ON TABLE reimbursts FROM pehadirm;
GRANT ALL ON TABLE reimbursts TO pehadirm;
GRANT ALL ON TABLE reimbursts TO pehadirm_pehadir_user;
GRANT ALL ON TABLE reimbursts TO pehadirm_pehadir_new;


--
-- Name: reimbursts_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE reimbursts_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE reimbursts_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE reimbursts_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE reimbursts_id_seq TO pehadirm_pehadir_user;


--
-- Name: req_shift_schedules; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE req_shift_schedules FROM PUBLIC;
REVOKE ALL ON TABLE req_shift_schedules FROM pehadirm;
GRANT ALL ON TABLE req_shift_schedules TO pehadirm;
GRANT ALL ON TABLE req_shift_schedules TO pehadirm_pehadir_user;
GRANT ALL ON TABLE req_shift_schedules TO pehadirm_pehadir_new;


--
-- Name: req_shift_schedules_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE req_shift_schedules_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE req_shift_schedules_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE req_shift_schedules_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE req_shift_schedules_id_seq TO pehadirm_pehadir_user;


--
-- Name: request_shift_schedule_approvals; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE request_shift_schedule_approvals FROM PUBLIC;
REVOKE ALL ON TABLE request_shift_schedule_approvals FROM pehadirm;
GRANT ALL ON TABLE request_shift_schedule_approvals TO pehadirm;
GRANT ALL ON TABLE request_shift_schedule_approvals TO pehadirm_pehadir_user;
GRANT ALL ON TABLE request_shift_schedule_approvals TO pehadirm_pehadir_new;


--
-- Name: request_shift_schedule_approvals_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE request_shift_schedule_approvals_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE request_shift_schedule_approvals_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE request_shift_schedule_approvals_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE request_shift_schedule_approvals_id_seq TO pehadirm_pehadir_user;


--
-- Name: role_has_permissions; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE role_has_permissions FROM PUBLIC;
REVOKE ALL ON TABLE role_has_permissions FROM pehadirm;
GRANT ALL ON TABLE role_has_permissions TO pehadirm;
GRANT ALL ON TABLE role_has_permissions TO pehadirm_pehadir_user;
GRANT ALL ON TABLE role_has_permissions TO pehadirm_pehadir_new;


--
-- Name: roles; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE roles FROM PUBLIC;
REVOKE ALL ON TABLE roles FROM pehadirm;
GRANT ALL ON TABLE roles TO pehadirm;
GRANT ALL ON TABLE roles TO pehadirm_pehadir_user;
GRANT ALL ON TABLE roles TO pehadirm_pehadir_new;


--
-- Name: roles_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE roles_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE roles_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE roles_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE roles_id_seq TO pehadirm_pehadir_user;


--
-- Name: set_bpjstk; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE set_bpjstk FROM PUBLIC;
REVOKE ALL ON TABLE set_bpjstk FROM pehadirm;
GRANT ALL ON TABLE set_bpjstk TO pehadirm;
GRANT ALL ON TABLE set_bpjstk TO pehadirm_pehadir_user;
GRANT ALL ON TABLE set_bpjstk TO pehadirm_pehadir_new;


--
-- Name: set_bpjstk_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE set_bpjstk_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE set_bpjstk_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE set_bpjstk_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE set_bpjstk_id_seq TO pehadirm_pehadir_user;


--
-- Name: set_ptkp; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE set_ptkp FROM PUBLIC;
REVOKE ALL ON TABLE set_ptkp FROM pehadirm;
GRANT ALL ON TABLE set_ptkp TO pehadirm;
GRANT ALL ON TABLE set_ptkp TO pehadirm_pehadir_user;
GRANT ALL ON TABLE set_ptkp TO pehadirm_pehadir_new;


--
-- Name: set_ptkp_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE set_ptkp_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE set_ptkp_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE set_ptkp_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE set_ptkp_id_seq TO pehadirm_pehadir_user;


--
-- Name: settings; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE settings FROM PUBLIC;
REVOKE ALL ON TABLE settings FROM pehadirm;
GRANT ALL ON TABLE settings TO pehadirm;
GRANT ALL ON TABLE settings TO pehadirm_pehadir_user;
GRANT ALL ON TABLE settings TO pehadirm_pehadir_new;


--
-- Name: settings_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE settings_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE settings_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE settings_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE settings_id_seq TO pehadirm_pehadir_user;


--
-- Name: shift_schedules; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE shift_schedules FROM PUBLIC;
REVOKE ALL ON TABLE shift_schedules FROM pehadirm;
GRANT ALL ON TABLE shift_schedules TO pehadirm;
GRANT ALL ON TABLE shift_schedules TO pehadirm_pehadir_user;
GRANT ALL ON TABLE shift_schedules TO pehadirm_pehadir_new;


--
-- Name: shift_schedules_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE shift_schedules_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE shift_schedules_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE shift_schedules_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE shift_schedules_id_seq TO pehadirm_pehadir_user;


--
-- Name: shift_types; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE shift_types FROM PUBLIC;
REVOKE ALL ON TABLE shift_types FROM pehadirm;
GRANT ALL ON TABLE shift_types TO pehadirm;
GRANT ALL ON TABLE shift_types TO pehadirm_pehadir_user;
GRANT ALL ON TABLE shift_types TO pehadirm_pehadir_new;


--
-- Name: shift_types_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE shift_types_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE shift_types_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE shift_types_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE shift_types_id_seq TO pehadirm_pehadir_user;


--
-- Name: timesheet_approvals; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE timesheet_approvals FROM PUBLIC;
REVOKE ALL ON TABLE timesheet_approvals FROM pehadirm;
GRANT ALL ON TABLE timesheet_approvals TO pehadirm;
GRANT ALL ON TABLE timesheet_approvals TO pehadirm_pehadir_user;
GRANT ALL ON TABLE timesheet_approvals TO pehadirm_pehadir_new;


--
-- Name: timesheet_approvals_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE timesheet_approvals_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE timesheet_approvals_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE timesheet_approvals_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE timesheet_approvals_id_seq TO pehadirm_pehadir_user;


--
-- Name: timesheets; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE timesheets FROM PUBLIC;
REVOKE ALL ON TABLE timesheets FROM pehadirm;
GRANT ALL ON TABLE timesheets TO pehadirm;
GRANT ALL ON TABLE timesheets TO pehadirm_pehadir_user;
GRANT ALL ON TABLE timesheets TO pehadirm_pehadir_new;


--
-- Name: timesheets_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE timesheets_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE timesheets_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE timesheets_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE timesheets_id_seq TO pehadirm_pehadir_user;


--
-- Name: travel; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE travel FROM PUBLIC;
REVOKE ALL ON TABLE travel FROM pehadirm;
GRANT ALL ON TABLE travel TO pehadirm;
GRANT ALL ON TABLE travel TO pehadirm_pehadir_user;
GRANT ALL ON TABLE travel TO pehadirm_pehadir_new;


--
-- Name: travel_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE travel_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE travel_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE travel_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE travel_id_seq TO pehadirm_pehadir_user;


--
-- Name: users; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE users FROM PUBLIC;
REVOKE ALL ON TABLE users FROM pehadirm;
GRANT ALL ON TABLE users TO pehadirm;
GRANT ALL ON TABLE users TO pehadirm_pehadir_user;
GRANT ALL ON TABLE users TO pehadirm_pehadir_new;


--
-- Name: users_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE users_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE users_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE users_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE users_id_seq TO pehadirm_pehadir_user;


--
-- Name: v_all_active_staf; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE v_all_active_staf FROM PUBLIC;
REVOKE ALL ON TABLE v_all_active_staf FROM pehadirm;
GRANT ALL ON TABLE v_all_active_staf TO pehadirm;
GRANT ALL ON TABLE v_all_active_staf TO PUBLIC;


--
-- Name: v_all_attendance; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE v_all_attendance FROM PUBLIC;
REVOKE ALL ON TABLE v_all_attendance FROM pehadirm;
GRANT ALL ON TABLE v_all_attendance TO pehadirm;
GRANT ALL ON TABLE v_all_attendance TO PUBLIC;


--
-- Name: v_all_service_branch; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE v_all_service_branch FROM PUBLIC;
REVOKE ALL ON TABLE v_all_service_branch FROM pehadirm;
GRANT ALL ON TABLE v_all_service_branch TO pehadirm;
GRANT ALL ON TABLE v_all_service_branch TO PUBLIC;


--
-- Name: v_employee_active_staff; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE v_employee_active_staff FROM PUBLIC;
REVOKE ALL ON TABLE v_employee_active_staff FROM pehadirm;
GRANT ALL ON TABLE v_employee_active_staff TO pehadirm;
GRANT ALL ON TABLE v_employee_active_staff TO PUBLIC;


--
-- Name: v_employee_age_average; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE v_employee_age_average FROM PUBLIC;
REVOKE ALL ON TABLE v_employee_age_average FROM pehadirm;
GRANT ALL ON TABLE v_employee_age_average TO pehadirm;
GRANT ALL ON TABLE v_employee_age_average TO PUBLIC;


--
-- Name: v_employee_education; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE v_employee_education FROM PUBLIC;
REVOKE ALL ON TABLE v_employee_education FROM pehadirm;
GRANT ALL ON TABLE v_employee_education TO pehadirm;
GRANT ALL ON TABLE v_employee_education TO PUBLIC;


--
-- Name: v_employee_gender; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE v_employee_gender FROM PUBLIC;
REVOKE ALL ON TABLE v_employee_gender FROM pehadirm;
GRANT ALL ON TABLE v_employee_gender TO pehadirm;
GRANT ALL ON TABLE v_employee_gender TO PUBLIC;


--
-- Name: v_employee_joblevel; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE v_employee_joblevel FROM PUBLIC;
REVOKE ALL ON TABLE v_employee_joblevel FROM pehadirm;
GRANT ALL ON TABLE v_employee_joblevel TO pehadirm;
GRANT ALL ON TABLE v_employee_joblevel TO PUBLIC;


--
-- Name: v_employee_religion; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE v_employee_religion FROM PUBLIC;
REVOKE ALL ON TABLE v_employee_religion FROM pehadirm;
GRANT ALL ON TABLE v_employee_religion TO pehadirm;
GRANT ALL ON TABLE v_employee_religion TO PUBLIC;


--
-- Name: v_employee_status; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE v_employee_status FROM PUBLIC;
REVOKE ALL ON TABLE v_employee_status FROM pehadirm;
GRANT ALL ON TABLE v_employee_status TO pehadirm;
GRANT ALL ON TABLE v_employee_status TO abyaktal;
GRANT ALL ON TABLE v_employee_status TO PUBLIC;


--
-- Name: v_lenght_of_service; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE v_lenght_of_service FROM PUBLIC;
REVOKE ALL ON TABLE v_lenght_of_service FROM pehadirm;
GRANT ALL ON TABLE v_lenght_of_service TO pehadirm;
GRANT ALL ON TABLE v_lenght_of_service TO PUBLIC;


--
-- Name: v_monthly_resign; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE v_monthly_resign FROM PUBLIC;
REVOKE ALL ON TABLE v_monthly_resign FROM pehadirm;
GRANT ALL ON TABLE v_monthly_resign TO pehadirm;
GRANT ALL ON TABLE v_monthly_resign TO PUBLIC;


--
-- Name: v_monthly_trunover; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE v_monthly_trunover FROM PUBLIC;
REVOKE ALL ON TABLE v_monthly_trunover FROM pehadirm;
GRANT ALL ON TABLE v_monthly_trunover TO pehadirm;
GRANT ALL ON TABLE v_monthly_trunover TO PUBLIC;


--
-- PostgreSQL database dump complete
--

