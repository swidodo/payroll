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
    branch_id integer,
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

COPY all_requests (id, request_id, request_no, request_for, request_by, request_type, req_date, status, created_by, created_at, updated_at) FROM stdin;
1	1	1	acc123	company	Overtime	2023-03-17	Approved	2	2023-03-17 15:56:46	2023-03-17 15:56:46
2	2	2	acc123	company	Overtime	2023-03-22	Approved	2	2023-03-22 10:49:45	2023-03-22 10:49:45
3	1	3	Suali	company	Timesheet	2023-03-22	Approved	2	2023-03-22 10:54:24	2023-03-22 10:54:24
4	1	4	acc123	company	On Duty	2023-03-22	Approved	2	2023-03-22 10:56:14	2023-03-22 10:56:14
5	1	5	george	company	Cash Advance	2023-03-22	ongoing	2	2023-03-22 11:16:28	2023-03-22 11:16:28
\.


--
-- Name: all_requests_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('all_requests_id_seq', 5, true);


--
-- Data for Name: allowance_finances; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY allowance_finances (id, employee_id, allowance_type_id, amount, created_by, created_at, updated_at) FROM stdin;
1	8	1	100000	2	2023-03-22 11:17:43	2023-03-22 11:17:43
\.


--
-- Name: allowance_finances_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('allowance_finances_id_seq', 1, true);


--
-- Data for Name: allowance_options; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY allowance_options (id, name, created_by, created_at, updated_at) FROM stdin;
1	Uang Makan	2	2023-03-22 10:38:09	2023-03-22 10:38:09
\.


--
-- Name: allowance_options_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('allowance_options_id_seq', 1, true);


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

COPY attendance_employees (id, employee_id, date, status, denda, clock_in, clock_out, break_in, break_out, late, early_leaving, overtime, total_rest, created_by, created_at, updated_at) FROM stdin;
1	6	2023-01-02	Present	\N	07:35:00	16:11:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
2	6	2023-01-03	Present	\N	07:30:00	21:01:00	00:00:00	00:00:00	00:00:00	00:00:00	05:01:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
3	6	2023-01-04	Present	\N	07:28:00	16:01:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
4	6	2023-01-05	Present	\N	07:31:00	16:08:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
5	6	2023-01-06	Present	\N	07:30:00	16:32:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
6	6	2023-01-07	Present	\N	07:30:00	17:06:00	00:00:00	00:00:00	00:00:00	00:00:00	01:06:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
7	6	2023-01-09	Present	\N	07:32:00	16:02:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
8	6	2023-01-10	Present	\N	07:35:00	21:01:00	00:00:00	00:00:00	00:00:00	00:00:00	05:01:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
9	6	2023-01-11	Present	\N	07:30:00	21:00:00	00:00:00	00:00:00	00:00:00	00:00:00	05:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
10	6	2023-01-12	Present	\N	07:35:00	21:00:00	00:00:00	00:00:00	00:00:00	00:00:00	05:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
11	6	2023-01-13	Present	\N	07:37:00	16:33:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
12	6	2023-01-14	Present	\N	07:33:00	13:14:00	00:00:00	00:00:00	00:00:00	02:46:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
13	6	2023-01-16	Present	\N	07:42:00	00:00:00	00:00:00	00:00:00	00:00:00	01:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
14	4	2023-01-02	Present	\N	08:04:00	16:06:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
15	4	2023-01-03	Present	\N	07:41:00	16:05:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
16	4	2023-01-04	Present	\N	07:41:00	16:05:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
17	4	2023-01-05	Present	\N	07:38:00	16:06:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
18	4	2023-01-06	Present	\N	07:34:00	16:34:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
19	4	2023-01-07	Present	\N	07:42:00	13:05:00	00:00:00	00:00:00	00:00:00	02:55:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
20	4	2023-01-09	Present	\N	07:39:00	16:05:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
21	4	2023-01-10	Present	\N	07:40:00	16:07:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
22	4	2023-01-11	Present	\N	07:38:00	16:04:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
23	4	2023-01-12	Present	\N	07:42:00	16:02:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
24	4	2023-01-13	Present	\N	07:41:00	21:03:00	00:00:00	00:00:00	00:00:00	00:00:00	05:03:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
25	4	2023-01-14	Present	\N	07:43:00	13:02:00	00:00:00	00:00:00	00:00:00	02:58:00	00:00:00	00:00:00	2	2023-03-13 18:57:40	2023-03-13 18:57:40
26	4	2023-01-16	Present	\N	07:32:00	00:00:00	00:00:00	00:00:00	00:00:00	01:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:41	2023-03-13 18:57:41
27	5	2023-01-02	Present	\N	07:29:00	16:11:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:41	2023-03-13 18:57:41
28	5	2023-01-03	Present	\N	07:20:00	16:08:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:41	2023-03-13 18:57:41
29	5	2023-01-04	Present	\N	07:09:00	16:05:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:41	2023-03-13 18:57:41
30	5	2023-01-05	Present	\N	07:17:00	16:07:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:41	2023-03-13 18:57:41
31	5	2023-01-06	Present	\N	07:28:00	21:04:00	00:00:00	00:00:00	00:00:00	00:00:00	05:04:00	00:00:00	2	2023-03-13 18:57:41	2023-03-13 18:57:41
32	5	2023-01-07	Present	\N	07:07:00	17:06:00	00:00:00	00:00:00	00:00:00	00:00:00	01:06:00	00:00:00	2	2023-03-13 18:57:41	2023-03-13 18:57:41
33	5	2023-01-09	Present	\N	07:17:00	21:03:00	00:00:00	00:00:00	00:00:00	00:00:00	05:03:00	00:00:00	2	2023-03-13 18:57:41	2023-03-13 18:57:41
34	5	2023-01-10	Present	\N	07:17:00	21:01:00	00:00:00	00:00:00	00:00:00	00:00:00	05:01:00	00:00:00	2	2023-03-13 18:57:41	2023-03-13 18:57:41
35	5	2023-01-11	Present	\N	07:16:00	21:04:00	00:00:00	00:00:00	00:00:00	00:00:00	05:04:00	00:00:00	2	2023-03-13 18:57:41	2023-03-13 18:57:41
36	5	2023-01-12	Present	\N	07:28:00	21:05:00	00:00:00	00:00:00	00:00:00	00:00:00	05:05:00	00:00:00	2	2023-03-13 18:57:41	2023-03-13 18:57:41
37	5	2023-01-13	Present	\N	07:18:00	21:05:00	00:00:00	00:00:00	00:00:00	00:00:00	05:05:00	00:00:00	2	2023-03-13 18:57:41	2023-03-13 18:57:41
38	5	2023-01-14	Present	\N	07:02:00	17:04:00	00:00:00	00:00:00	00:00:00	00:00:00	01:04:00	00:00:00	2	2023-03-13 18:57:41	2023-03-13 18:57:41
39	5	2023-01-16	Present	\N	07:25:00	00:00:00	00:00:00	00:00:00	00:00:00	01:00:00	00:00:00	00:00:00	2	2023-03-13 18:57:41	2023-03-13 18:57:41
40	5	2023-01-21	Present	\N	07:23:00	17:08:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
41	5	2023-01-23	Present	\N	07:11:00	19:14:00	00:00:00	00:00:00	00:00:00	00:00:00	02:14:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
42	5	2023-01-24	Present	\N	07:29:00	18:13:00	00:00:00	00:00:00	00:00:00	00:00:00	01:13:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
43	5	2023-01-25	Present	\N	07:17:00	17:21:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
44	5	2023-01-26	Present	\N	07:20:00	17:19:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
45	5	2023-01-27	Present	\N	07:28:00	21:06:00	00:00:00	00:00:00	00:00:00	00:00:00	04:06:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
46	5	2023-01-28	Present	\N	07:27:00	17:03:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
47	5	2023-01-30	Present	\N	07:18:00	18:18:00	00:00:00	00:00:00	00:00:00	00:00:00	01:18:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
48	5	2023-02-06	Present	\N	07:16:00	21:06:00	00:00:00	00:00:00	00:00:00	00:00:00	04:06:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
49	5	2023-02-07	Present	\N	07:24:00	21:04:00	00:00:00	00:00:00	00:00:00	00:00:00	04:04:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
50	5	2023-02-08	Present	\N	07:20:00	21:02:00	00:00:00	00:00:00	00:00:00	00:00:00	04:02:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
51	5	2023-02-09	Present	\N	07:12:00	20:11:00	00:00:00	00:00:00	00:00:00	00:00:00	03:11:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
52	5	2023-02-10	Present	\N	07:18:00	21:04:00	00:00:00	00:00:00	00:00:00	00:00:00	04:04:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
53	5	2023-02-11	Present	\N	07:23:00	17:05:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
54	5	2023-02-13	Present	\N	07:20:00	20:17:00	00:00:00	00:00:00	00:00:00	00:00:00	03:17:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
55	5	2023-02-14	Present	\N	07:13:00	17:10:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
56	5	2023-02-15	Present	\N	07:14:00	21:08:00	00:00:00	00:00:00	00:00:00	00:00:00	04:08:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
57	5	2023-02-16	Present	\N	07:18:00	21:13:00	00:00:00	00:00:00	00:00:00	00:00:00	04:13:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
58	5	2023-02-17	Present	\N	07:17:00	21:04:00	00:00:00	00:00:00	00:00:00	00:00:00	04:04:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
59	5	2023-02-20	Present	\N	07:14:00	21:13:00	00:00:00	00:00:00	00:00:00	00:00:00	04:13:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
60	6	2023-01-21	Present	\N	00:00:00	14:15:00	00:00:00	00:00:00	01:00:00	02:45:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
61	6	2023-01-23	Present	\N	07:57:00	17:14:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
62	6	2023-01-24	Present	\N	07:55:00	17:13:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
63	6	2023-01-25	Present	\N	07:55:00	17:33:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
64	6	2023-01-26	Present	\N	07:57:00	17:22:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
65	6	2023-01-27	Present	\N	07:50:00	17:04:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
66	6	2023-01-28	Present	\N	07:55:00	13:57:00	00:00:00	00:00:00	00:00:00	03:03:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
67	6	2023-01-30	Present	\N	07:48:00	17:39:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
68	6	2023-01-31	Present	\N	07:52:00	17:27:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
69	6	2023-02-01	Present	\N	07:56:00	17:10:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
70	6	2023-02-02	Present	\N	07:58:00	18:51:00	00:00:00	00:00:00	00:00:00	00:00:00	01:51:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
71	6	2023-02-03	Present	\N	07:58:00	17:15:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
72	6	2023-02-04	Present	\N	07:36:00	13:02:00	00:00:00	00:00:00	00:00:00	03:58:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
73	6	2023-02-06	Present	\N	07:57:00	17:02:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
74	6	2023-02-07	Present	\N	08:00:00	17:05:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
75	6	2023-02-08	Present	\N	07:54:00	17:42:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
76	6	2023-02-09	Present	\N	07:54:00	17:12:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
77	6	2023-02-13	Present	\N	07:45:00	17:33:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
78	6	2023-02-14	Present	\N	07:54:00	17:29:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
79	6	2023-02-15	Present	\N	07:53:00	17:07:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
80	6	2023-02-16	Present	\N	07:50:00	17:07:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
81	7	2023-01-21	Present	\N	07:53:00	13:43:00	00:00:00	00:00:00	00:00:00	03:17:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
82	7	2023-01-23	Present	\N	07:51:00	17:04:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
83	7	2023-01-24	Present	\N	07:54:00	21:04:00	00:00:00	00:00:00	00:00:00	00:00:00	04:04:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
84	7	2023-01-25	Present	\N	07:59:00	21:01:00	00:00:00	00:00:00	00:00:00	00:00:00	04:01:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
85	7	2023-01-26	Present	\N	08:03:00	21:01:00	00:00:00	00:00:00	00:03:00	00:00:00	04:01:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
86	7	2023-01-27	Present	\N	07:51:00	17:09:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
87	7	2023-01-28	Present	\N	07:53:00	14:11:00	00:00:00	00:00:00	00:00:00	02:49:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
88	7	2023-01-30	Present	\N	07:55:00	17:07:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
89	7	2023-01-31	Present	\N	07:54:00	17:03:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
90	7	2023-02-01	Present	\N	06:46:00	17:04:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
91	7	2023-02-02	Present	\N	07:55:00	17:05:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
92	7	2023-02-03	Present	\N	07:58:00	17:02:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
93	7	2023-02-04	Present	\N	07:52:00	13:12:00	00:00:00	00:00:00	00:00:00	03:48:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
94	7	2023-02-06	Present	\N	07:52:00	17:06:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
95	7	2023-02-07	Present	\N	07:53:00	17:04:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
96	7	2023-02-08	Present	\N	07:49:00	17:05:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
97	7	2023-02-09	Present	\N	07:53:00	17:03:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
98	7	2023-02-10	Present	\N	07:53:00	17:02:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
99	7	2023-02-11	Present	\N	07:51:00	00:00:00	00:00:00	00:00:00	00:00:00	01:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
100	7	2023-02-13	Present	\N	07:55:00	21:01:00	00:00:00	00:00:00	00:00:00	00:00:00	04:01:00	00:00:00	2	2023-03-17 23:23:45	2023-03-17 23:23:45
101	7	2023-02-14	Present	\N	07:52:00	21:02:00	00:00:00	00:00:00	00:00:00	00:00:00	04:02:00	00:00:00	2	2023-03-17 23:23:46	2023-03-17 23:23:46
102	7	2023-02-16	Present	\N	07:58:00	21:04:00	00:00:00	00:00:00	00:00:00	00:00:00	04:04:00	00:00:00	2	2023-03-17 23:23:46	2023-03-17 23:23:46
103	7	2023-02-17	Present	\N	07:55:00	21:02:00	00:00:00	00:00:00	00:00:00	00:00:00	04:02:00	00:00:00	2	2023-03-17 23:23:46	2023-03-17 23:23:46
104	7	2023-02-18	Present	\N	07:43:00	17:03:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:46	2023-03-17 23:23:46
105	7	2023-02-19	Present	\N	07:53:00	12:19:00	00:00:00	00:00:00	00:00:00	04:41:00	00:00:00	00:00:00	2	2023-03-17 23:23:46	2023-03-17 23:23:46
106	7	2023-02-20	Present	\N	07:51:00	21:03:00	00:00:00	00:00:00	00:00:00	00:00:00	04:03:00	00:00:00	2	2023-03-17 23:23:46	2023-03-17 23:23:46
107	6	2023-02-10	Present	\N	07:34:00	16:33:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:47	2023-03-17 23:23:47
108	6	2023-02-11	Present	\N	07:48:00	17:06:00	00:00:00	00:00:00	00:00:00	00:00:00	01:06:00	00:00:00	2	2023-03-17 23:23:47	2023-03-17 23:23:47
109	6	2023-02-17	Present	\N	07:43:00	21:01:00	00:00:00	00:00:00	00:00:00	00:00:00	05:01:00	00:00:00	2	2023-03-17 23:23:47	2023-03-17 23:23:47
110	6	2023-02-18	Present	\N	07:47:00	17:01:00	00:00:00	00:00:00	00:00:00	00:00:00	01:01:00	00:00:00	2	2023-03-17 23:23:47	2023-03-17 23:23:47
111	6	2023-02-20	Present	\N	22:55:00	07:08:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-17 23:23:47	2023-03-17 23:23:47
117	8	2023-01-21	Present	\N	07:32:00	13:44:00	00:00:00	00:00:00	00:00:00	03:16:00	00:00:00	00:00:00	2	2023-03-22 10:59:30	2023-03-22 10:59:30
118	8	2023-01-23	Present	\N	08:00:00	17:09:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-22 10:59:30	2023-03-22 10:59:30
119	8	2023-01-24	Present	\N	07:52:00	17:32:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-22 10:59:30	2023-03-22 10:59:30
120	8	2023-01-25	Present	\N	07:31:00	17:25:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-22 10:59:30	2023-03-22 10:59:30
121	5	2023-03-22	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-22 18:00:08	2023-03-22 18:00:08
122	7	2023-03-22	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-22 18:00:08	2023-03-22 18:00:08
123	2	2023-03-22	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-22 18:00:08	2023-03-22 18:00:08
124	4	2023-03-22	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-22 18:00:08	2023-03-22 18:00:08
125	8	2023-03-22	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-22 18:00:08	2023-03-22 18:00:08
126	6	2023-03-22	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-22 18:00:08	2023-03-22 18:00:08
127	5	2023-03-23	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-23 18:00:06	2023-03-23 18:00:06
128	7	2023-03-23	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-23 18:00:06	2023-03-23 18:00:06
129	2	2023-03-23	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-23 18:00:06	2023-03-23 18:00:06
130	4	2023-03-23	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-23 18:00:06	2023-03-23 18:00:06
131	8	2023-03-23	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-23 18:00:06	2023-03-23 18:00:06
132	6	2023-03-23	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-23 18:00:06	2023-03-23 18:00:06
133	5	2023-03-24	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-24 18:00:09	2023-03-24 18:00:09
134	7	2023-03-24	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-24 18:00:09	2023-03-24 18:00:09
135	2	2023-03-24	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-24 18:00:09	2023-03-24 18:00:09
136	4	2023-03-24	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-24 18:00:09	2023-03-24 18:00:09
137	8	2023-03-24	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-24 18:00:09	2023-03-24 18:00:09
138	6	2023-03-24	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-24 18:00:09	2023-03-24 18:00:09
139	5	2023-03-25	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-25 18:00:06	2023-03-25 18:00:06
140	7	2023-03-25	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-25 18:00:06	2023-03-25 18:00:06
141	2	2023-03-25	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-25 18:00:06	2023-03-25 18:00:06
143	8	2023-03-25	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-25 18:00:06	2023-03-25 18:00:06
144	6	2023-03-25	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-25 18:00:06	2023-03-25 18:00:06
145	5	2023-03-26	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-26 18:00:06	2023-03-26 18:00:06
146	7	2023-03-26	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-26 18:00:06	2023-03-26 18:00:06
147	2	2023-03-26	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-26 18:00:06	2023-03-26 18:00:06
148	4	2023-03-26	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-26 18:00:06	2023-03-26 18:00:06
149	8	2023-03-26	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-26 18:00:06	2023-03-26 18:00:06
150	6	2023-03-26	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-26 18:00:06	2023-03-26 18:00:06
151	5	2023-03-27	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-27 18:00:06	2023-03-27 18:00:06
152	7	2023-03-27	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-27 18:00:06	2023-03-27 18:00:06
153	2	2023-03-27	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-27 18:00:06	2023-03-27 18:00:06
154	4	2023-03-27	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-27 18:00:06	2023-03-27 18:00:06
155	8	2023-03-27	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-27 18:00:06	2023-03-27 18:00:06
156	6	2023-03-27	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-27 18:00:06	2023-03-27 18:00:06
157	5	2023-03-28	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-28 18:00:06	2023-03-28 18:00:06
158	7	2023-03-28	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-28 18:00:07	2023-03-28 18:00:07
159	2	2023-03-28	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-28 18:00:07	2023-03-28 18:00:07
160	4	2023-03-28	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-28 18:00:07	2023-03-28 18:00:07
161	8	2023-03-28	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-28 18:00:07	2023-03-28 18:00:07
162	6	2023-03-28	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-28 18:00:07	2023-03-28 18:00:07
163	5	2023-03-29	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-29 18:00:07	2023-03-29 18:00:07
164	7	2023-03-29	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-29 18:00:07	2023-03-29 18:00:07
165	2	2023-03-29	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-29 18:00:07	2023-03-29 18:00:07
166	4	2023-03-29	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-29 18:00:07	2023-03-29 18:00:07
167	8	2023-03-29	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-29 18:00:07	2023-03-29 18:00:07
168	6	2023-03-29	Alpha	\N	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	00:00:00	2	2023-03-29 18:00:07	2023-03-29 18:00:07
\.


--
-- Name: attendance_employees_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('attendance_employees_id_seq', 168, true);


--
-- Data for Name: branches; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY branches (id, name, created_by, created_at, updated_at) FROM stdin;
1	PT. AR PACKAGING	2	\N	\N
2	PT. KARYA INDAH MULTI GUNA	2	\N	\N
3	PT ABC	2	2023-03-22 10:35:27	2023-03-22 10:35:27
\.


--
-- Name: branches_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('branches_id_seq', 3, true);


--
-- Data for Name: break_times; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY break_times (id, shift_type_id, start_time, end_time, created_by, created_at, updated_at) FROM stdin;
1	2	10:00:00	10:30:00	2	2023-03-22 10:37:25	2023-03-22 10:37:25
\.


--
-- Name: break_times_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('break_times_id_seq', 1, true);


--
-- Data for Name: cashes; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY cashes (id, employee_id, loan_type_id, amount, installment, number_of_installment, status, created_by, created_at, updated_at) FROM stdin;
1	8	1	5000000	10	6	ongoing	2	2023-03-22 11:16:28	2023-03-26 15:59:24
\.


--
-- Name: cashes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('cashes_id_seq', 1, true);


--
-- Data for Name: checklist_attendance_summaries; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY checklist_attendance_summaries (id, name, is_displayed, created_by, created_at, updated_at) FROM stdin;
13	actual_working_day	t	2	2023-03-22 10:24:35	2023-03-22 10:24:35
14	schedule_working_day	t	2	2023-03-22 10:24:35	2023-03-22 10:24:35
15	dayoff	t	2	2023-03-22 10:24:35	2023-03-22 10:24:35
16	national_holiday	t	2	2023-03-22 10:24:35	2023-03-22 10:24:35
17	company_holiday	t	2	2023-03-22 10:24:35	2023-03-22 10:24:35
18	timeoff_code	t	2	2023-03-22 10:24:35	2023-03-22 10:24:35
\.


--
-- Name: checklist_attendance_summaries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('checklist_attendance_summaries_id_seq', 18, true);


--
-- Data for Name: company_holidays; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY company_holidays (id, company_holiday_date, "desc", created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: company_holidays_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('company_holidays_id_seq', 1, false);


--
-- Data for Name: day_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY day_types (id, name, created_by, created_at, updated_at) FROM stdin;
1	work	2	2023-03-11 14:51:15	2023-03-11 14:51:15
2	WFH	2	2023-03-22 10:41:37	2023-03-22 10:41:37
\.


--
-- Name: day_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('day_types_id_seq', 2, true);


--
-- Data for Name: dayoffs; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY dayoffs (id, date, created_by, created_at, updated_at) FROM stdin;
1	2023-03-22	2	2023-03-22 10:56:27	2023-03-22 10:56:27
\.


--
-- Name: dayoffs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('dayoffs_id_seq', 1, true);


--
-- Data for Name: dendas; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY dendas (id, day_type_id, "time", amount, created_by, created_at, updated_at) FROM stdin;
1	1	01:00:00	10000.00	2	2023-03-22 10:25:37	2023-03-22 10:25:37
\.


--
-- Name: dendas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('dendas_id_seq', 1, true);


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
3	2	2014-01-01	2017-03-01	Formal	SMP	SMP DU 2	Peterongan, Jombang	MIPA	\N	\N	\N	\N
4	2	2017-01-01	2020-03-01	Formal	SMA	SMA DU 3	Peterongan, Jombang	MIPA	\N	\N	\N	\N
\.


--
-- Name: employee_education_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employee_education_id_seq', 4, true);


--
-- Data for Name: employee_experiences; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY employee_experiences (id, employee_id, start_date, end_date, sequence, job, "position", address, city, reason_leaving, note, created_at, updated_at) FROM stdin;
2	2	2022-01-01	2022-03-01	1	Programmer	Programmer	Peterongan	Jombang	Boring	\N	2023-03-11 14:51:15	2023-03-11 14:51:15
1	1	2022-01-01	2022-03-01	1	Programmer	Programmer	Peterongan	Jombang	Boring		2023-03-11 14:51:14	2023-03-11 15:06:03
\.


--
-- Name: employee_experiences_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employee_experiences_id_seq', 2, true);


--
-- Data for Name: employee_medicals; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY employee_medicals (id, employee_id, height, weight, blood_type, medical_test, created_at, updated_at) FROM stdin;
1	1	\N	\N	\N	\N	2023-03-11 15:06:03	2023-03-11 15:06:03
2	3	\N	\N	\N	\N	2023-03-13 10:25:34	2023-03-13 10:25:34
\.


--
-- Name: employee_medicals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employee_medicals_id_seq', 2, true);


--
-- Data for Name: employees; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY employees (id, user_id, name, dob, gender, phone, address, email, password, employee_id, branch_id, department_id, designation_id, company_doj, company_doe, documents, account_holder_name, account_number, bank_name, bank_identifier_code, branch_location, tax_payer_id, salary_type, salary, net_salary, is_active, created_by, level_approval, leave_type, employee_type, marital_status, total_leave, total_leave_remaining, out_date, status, created_at, updated_at) FROM stdin;
5	7	Suali	\N	\N	\N	\N	suali@gmail.com	$2y$10$a.K0W7pfuFwRa0TKzlr3F.hLMBgVDXzxpPjy81UUGId87eR6Fecai	4	1	0	0	2023-03-13	2024-03-13	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	t	2	\N	\N	jobholder	\N	0	\N	\N	active	2023-03-13 18:52:39	2023-03-13 19:59:51
7	9	JoyJoy	\N	\N	\N	\N	JoyJoy@pehadir.com	$2y$10$hsZTFfUhqmiXK5cfGpsMn.SDKITeOz30TrLpHk/DQb7DWVkZTFjFy	6	1	0	0	2022-10-01	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	t	2	\N	\N	outsourcing	\N	0	\N	\N	active	2023-03-17 23:23:24	2023-03-18 13:53:50
2	4	accountant2	2001-05-01	Male	08119725162	Jl. semampir no.2, Malaysia	accountant@example.com	$2y$10$Ivx0JNia0VS0MU5m31h6IOzNSri2JV7QUHPenUUOs.EIC6zik/1ou	2	1	0	0	2022-12-01	2023-12-01	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	t	2	1	\N	\N	\N	0	\N	\N	active	2023-03-11 14:51:14	2023-03-22 10:24:03
1	3	accountant	2001-05-01	Male	08119725162	Jl. semampir no.2, Malaysia	accountant@example.com	$2y$10$WjKSzWTr6/QMsXhJYYMyV.hIFxuE.BDbDLcGd/.9W412dYEQ1Pl3y	1	1	0	0	2022-12-01	2023-12-01	\N	\N	\N	\N	\N	\N	\N	Gaji Pokok (Monthly)	10000000	18477600	f	2	\N	\N	\N	\N	0	\N	2023-03-11	pension	2023-03-11 14:51:14	2023-03-22 11:03:28
4	6	acc123	\N	\N	\N	\N	acc123@karyaindah.com	$2y$10$WEaGF1eunh9eHbIKztqBluRVGurv7Qqn0wjP6XIRH0yDPWtklmBXG	3	1	0	0	2023-03-13	2023-03-31	\N	\N	\N	\N	\N	\N	\N	Gaji Pokok (Monthly)	5000000	4750000	t	2	\N	\N	jobholder	\N	0	\N	\N	active	2023-03-13 10:36:47	2023-03-22 11:03:28
8	10	george	\N	\N	\N	\N	george@pehadir.com	$2y$10$/344laxqHnQKOu.Ln6X0lOpE8ITuh9YkZCht5Q/Hy3JGUg8IpU8k.	7	1	0	0	2023-03-01	\N	\N	\N	\N	\N	\N	\N	\N	Gaji Pokok (Monthly)	6000000	4908750	t	2	3	\N	jobholder	\N	0	\N	\N	active	2023-03-22 10:23:31	2023-03-22 11:45:35
6	8	FIKRI KURNIAWAN	\N	\N	\N	\N	fikri@pehadir.com	$2y$10$NLkpPYpX7OqlqE9oPJjmi.GhG89eWJLdDohm0eD5Yx1VOgRm/Fkmy	5	1	0	0	2023-03-13	2024-03-14	\N	\N	\N	\N	\N	\N	\N	Gaji Pokok (Monthly)	6000000	5557500	t	2	2	\N	jobholder	\N	0	\N	\N	active	2023-03-13 18:56:43	2023-03-22 11:55:32
\.


--
-- Name: employees_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employees_id_seq', 10, true);


--
-- Data for Name: employements; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY employements (id, employee_id, movement_type, area, office, job_level, "position", type, note, created_at, updated_at) FROM stdin;
1	1	Hiring	Tangerang	Tangerang	Accountant	Accountant	KONTRAK	\N	2023-03-11 14:51:14	2023-03-11 14:51:14
2	2	Hiring	Tangerang	Tangerang	Accountant	Accountant	KONTRAK	\N	2023-03-11 14:51:15	2023-03-11 14:51:15
\.


--
-- Name: employements_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('employements_id_seq', 2, true);


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
-- Data for Name: history_leaves; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY history_leaves (id, employee_id, leave_type_id, applied_on, start_date, end_date, total_leave_days, leave_reason, attachment_request_path, remark, status, rejected_reason, attachment_reject, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: history_leaves_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('history_leaves_id_seq', 1, false);


--
-- Data for Name: leave_approvals; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY leave_approvals (id, leave_id, level, is_approver_company, approver_id, status, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: leave_approvals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('leave_approvals_id_seq', 1, false);


--
-- Data for Name: leave_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY leave_types (id, title, days, created_by, created_at, updated_at) FROM stdin;
1	Sick	3	2	2023-03-11 14:51:15	2023-03-11 14:51:15
2	Ijin	3	2	2023-03-22 10:38:31	2023-03-22 10:38:31
\.


--
-- Name: leave_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('leave_types_id_seq', 2, true);


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
-- Data for Name: level_approvals; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY level_approvals (id, level, employee_id, company_id, created_by, created_at, updated_at) FROM stdin;
1	1	2	\N	2	2023-03-22 10:24:03	2023-03-22 10:24:03
2	2	6	\N	2	2023-03-22 10:24:03	2023-03-22 10:24:03
3	3	8	\N	2	2023-03-22 10:24:03	2023-03-22 10:24:03
\.


--
-- Name: level_approvals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('level_approvals_id_seq', 3, true);


--
-- Data for Name: loan_options; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY loan_options (id, name, created_by, created_at, updated_at) FROM stdin;
1	Cicilan KPR	2	\N	\N
2	Medical Checkup	2	2023-03-22 10:40:08	2023-03-22 10:40:08
\.


--
-- Name: loan_options_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('loan_options_id_seq', 2, true);


--
-- Data for Name: loans; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY loans (id, employee_id, loan_type_id, installment, number_of_installment, status, amount, created_by, created_at, updated_at) FROM stdin;
1	8	2	10	6	ongoing	4000000	2	2023-03-22 11:17:27	2023-03-26 15:59:24
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
21	2022_11_09_153815_create_history_leaves_table	1
22	2022_11_09_153815_create_leaves_table	1
23	2022_11_10_020918_create_overtimes_table	1
24	2022_11_10_021418_create_overtime_types_table	1
25	2022_11_10_021733_create_day_types_table	1
26	2022_11_18_034714_create_shift_types_table	1
27	2022_11_18_174853_create_break_times_table	1
28	2022_11_19_084204_create_req_shift_schedules_table	1
29	2022_11_19_091340_create_shift_schedules_table	1
30	2022_11_24_103223_create_attendance_employees_table	1
31	2022_12_02_004120_create_families_table	1
32	2022_12_02_090204_create_employee_medicals_table	1
33	2022_12_09_210608_create_travel_table	1
34	2022_12_10_172650_create_timesheets_table	1
35	2022_12_14_164046_create_all_requests_table	1
36	2022_12_20_092810_create_payrolls_table	1
37	2022_12_20_092950_create_reimbursts_table	1
38	2022_12_20_093046_create_cashes_table	1
39	2022_12_20_121838_create_allowance_finances_table	1
40	2022_12_25_203619_create_dendas_table	1
41	2022_12_31_075105_create_pay_slips_table	1
42	2022_12_31_175836_create_allowance_options_table	1
43	2023_01_12_063005_create_loans_table	1
44	2023_01_12_113651_create_set_bpjstk_table	1
45	2023_01_15_111356_create_dayoffs_table	1
46	2023_01_15_161856_create_company_holidays_table	1
47	2023_01_28_103125_create_projects_table	1
48	2023_01_28_222714_create_project_users_table	1
49	2023_02_04_100208_create_payslip_code_pins_table	1
50	2023_02_04_212344_create_checklist_attendance_summaries_table	1
51	2023_02_14_202014_create_level_approvals_table	1
52	2023_02_15_201314_create_leave_approvals_table	1
53	2023_02_17_062055_create_overtime_approvals_table	1
54	2023_02_17_110113_create_request_shift_schedule_approvals_table	1
55	2023_02_18_080506_create_timesheet_approvals_table	1
56	2023_02_18_101017_create_on_duty_approvals_table	1
57	2023_02_18_120015_create_ptkp_table	1
58	2023_02_18_154302_create_set_ptkp_table	1
\.


--
-- Data for Name: model_has_permissions; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY model_has_permissions (permission_id, model_type, model_id) FROM stdin;
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
5	App\\Models\\User	8
3	App\\Models\\User	9
6	App\\Models\\User	10
\.


--
-- Data for Name: on_duty_approvals; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY on_duty_approvals (id, travel_id, level, is_approver_company, approver_id, status, created_by, created_at, updated_at) FROM stdin;
1	1	1	f	2	Pending	2	2023-03-22 10:56:14	2023-03-22 10:56:14
2	1	2	f	6	Pending	2	2023-03-22 10:56:14	2023-03-22 10:56:14
3	1	3	f	8	Pending	2	2023-03-22 10:56:14	2023-03-22 10:56:14
\.


--
-- Name: on_duty_approvals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('on_duty_approvals_id_seq', 3, true);


--
-- Data for Name: overtime_approvals; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY overtime_approvals (id, overtime_id, level, is_approver_company, approver_id, status, created_by, created_at, updated_at) FROM stdin;
1	2	1	f	2	Pending	2	2023-03-22 10:49:45	2023-03-22 10:49:45
2	2	2	f	6	Pending	2	2023-03-22 10:49:45	2023-03-22 10:49:45
3	2	3	f	8	Pending	2	2023-03-22 10:49:45	2023-03-22 10:49:45
\.


--
-- Name: overtime_approvals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('overtime_approvals_id_seq', 3, true);


--
-- Data for Name: overtime_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY overtime_types (id, name, created_by, created_at, updated_at) FROM stdin;
1	overtime1	2	2023-03-11 14:51:15	2023-03-11 14:51:15
2	Lembur	2	2023-03-22 10:40:50	2023-03-22 10:40:50
\.


--
-- Name: overtime_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('overtime_types_id_seq', 2, true);


--
-- Data for Name: overtimes; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY overtimes (id, employee_id, overtime_type_id, day_type_id, start_date, end_date, start_time, end_time, duration, amount_fee, notes, status, rejected_reason, attachment_reject, created_by, created_at, updated_at) FROM stdin;
1	4	1	1	2023-03-17	2023-03-17	21:00	23:59	02:59:00	0.00	\N	Approved	\N	\N	2	2023-03-17 15:56:46	2023-03-17 15:56:46
2	4	1	1	2023-03-22	2023-03-22	16:00	17:00	01:00:00	0.00	tes	Approved	\N	\N	2	2023-03-22 10:49:45	2023-03-22 10:49:45
\.


--
-- Name: overtimes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('overtimes_id_seq', 2, true);


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: pay_slips; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY pay_slips (id, employee_id, pdf_filename, net_payble, salary_month, status, basic_salary, salary, allowance, reimburst, cash_in_advance, loan, denda, bpjs_kesehatan, pph21, overtime, created_by, created_at, updated_at) FROM stdin;
2	1	Payslip accountant 2023-03-11.pdf	18977600	2023-03-11	1	[{"id":1,"employee_id":1,"payslip_type_id":1,"amount":10000000,"created_by":2,"created_at":"2023-03-11T08:05:32.000000Z","updated_at":"2023-03-11T08:05:32.000000Z"}]	10000000	[]	[]	[]	[]	[]	\N	\N	[]	2	2023-03-11 22:32:50	2023-03-11 22:32:50
3	4	Payslip acc123 2023-03.pdf	5000000	2023-03	1	[{"id":2,"employee_id":4,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-03-17T08:54:34.000000Z","updated_at":"2023-03-17T08:54:34.000000Z"}]	5000000	[]	[]	[]	[]	[]	\N	\N	[{"id":1,"employee_id":4,"overtime_type_id":1,"day_type_id":1,"start_date":"2023-03-17","end_date":"2023-03-17","start_time":"21:00","end_time":"23:59","duration":"02:59:00","amount_fee":"0.00","notes":null,"status":"Approved","rejected_reason":null,"attachment_reject":null,"created_by":2,"created_at":"2023-03-17T08:56:46.000000Z","updated_at":"2023-03-17T08:56:46.000000Z"}]	2	2023-03-17 21:50:28	2023-03-17 21:50:28
4	8	Payslip george 2023-03.pdf	5700000	2023-03	1	[{"id":3,"employee_id":8,"payslip_type_id":1,"amount":6000000,"created_by":2,"created_at":"2023-03-22T04:03:24.000000Z","updated_at":"2023-03-22T04:03:24.000000Z"}]	6000000	[]	[]	[]	[]	[]	{"type":"Percentage","value":"5","maximum_salary":"12000000"}	\N	[]	2	2023-03-22 11:04:47	2023-03-22 11:04:47
5	4	Payslip acc123 2023-03.pdf	4750000	2023-03	1	[{"id":2,"employee_id":4,"payslip_type_id":1,"amount":5000000,"created_by":2,"created_at":"2023-03-17T08:54:34.000000Z","updated_at":"2023-03-17T08:54:34.000000Z"}]	5000000	[]	[]	[]	[]	[]	{"type":"Percentage","value":"5","maximum_salary":"12000000"}	\N	[{"id":1,"employee_id":4,"overtime_type_id":1,"day_type_id":1,"start_date":"2023-03-17","end_date":"2023-03-17","start_time":"21:00","end_time":"23:59","duration":"02:59:00","amount_fee":"0.00","notes":null,"status":"Approved","rejected_reason":null,"attachment_reject":null,"created_by":2,"created_at":"2023-03-17T08:56:46.000000Z","updated_at":"2023-03-17T08:56:46.000000Z"},{"id":2,"employee_id":4,"overtime_type_id":1,"day_type_id":1,"start_date":"2023-03-22","end_date":"2023-03-22","start_time":"16:00","end_time":"17:00","duration":"01:00:00","amount_fee":"0.00","notes":"tes","status":"Approved","rejected_reason":null,"attachment_reject":null,"created_by":2,"created_at":"2023-03-22T03:49:45.000000Z","updated_at":"2023-03-22T03:49:45.000000Z"}]	2	2023-03-22 11:08:16	2023-03-22 11:08:16
6	8	Payslip george 2023-03.pdf	4950000	2023-03	1	[{"id":3,"employee_id":8,"payslip_type_id":1,"amount":6000000,"created_by":2,"created_at":"2023-03-22T04:03:24.000000Z","updated_at":"2023-03-22T04:03:24.000000Z"}]	6000000	[{"id":1,"employee_id":8,"allowance_type_id":1,"amount":100000,"created_by":2,"created_at":"2023-03-22T04:17:43.000000Z","updated_at":"2023-03-22T04:17:43.000000Z"}]	[{"id":1,"employee_id":8,"reimburst_type_id":1,"amount":50000,"created_by":2,"created_at":"2023-03-22T04:12:50.000000Z","updated_at":"2023-03-22T04:12:50.000000Z"}]	[{"id":1,"employee_id":8,"loan_type_id":1,"amount":5000000,"installment":10,"number_of_installment":1,"status":"ongoing","created_by":2,"created_at":"2023-03-22T04:16:28.000000Z","updated_at":"2023-03-22T04:16:28.000000Z"}]	[{"id":1,"employee_id":8,"loan_type_id":2,"installment":10,"number_of_installment":1,"status":"ongoing","amount":4000000,"created_by":2,"created_at":"2023-03-22T04:17:27.000000Z","updated_at":"2023-03-22T04:17:27.000000Z"}]	[]	{"type":"Percentage","value":"5","maximum_salary":"12000000"}	\N	[]	2	2023-03-22 11:18:54	2023-03-22 11:18:54
7	8	Payslip george 2023-03.pdf	4908750	2023-03	1	[{"id":3,"employee_id":8,"payslip_type_id":1,"amount":6000000,"created_by":2,"created_at":"2023-03-22T04:03:24.000000Z","updated_at":"2023-03-22T04:03:24.000000Z"}]	6000000	[{"id":1,"employee_id":8,"allowance_type_id":1,"amount":100000,"created_by":2,"created_at":"2023-03-22T04:17:43.000000Z","updated_at":"2023-03-22T04:17:43.000000Z"}]	[{"id":1,"employee_id":8,"reimburst_type_id":1,"amount":50000,"created_by":2,"created_at":"2023-03-22T04:12:50.000000Z","updated_at":"2023-03-22T04:12:50.000000Z"}]	[{"id":1,"employee_id":8,"loan_type_id":1,"amount":5000000,"installment":10,"number_of_installment":2,"status":"ongoing","created_by":2,"created_at":"2023-03-22T04:16:28.000000Z","updated_at":"2023-03-22T04:18:54.000000Z"}]	[{"id":1,"employee_id":8,"loan_type_id":2,"installment":10,"number_of_installment":2,"status":"ongoing","amount":4000000,"created_by":2,"created_at":"2023-03-22T04:17:27.000000Z","updated_at":"2023-03-22T04:18:54.000000Z"}]	[]	{"type":"Percentage","value":"5","maximum_salary":"12000000"}	\N	[]	2	2023-03-22 11:45:41	2023-03-22 11:45:41
8	6	Payslip FIKRI KURNIAWAN 2023-03.pdf	5557500	2023-03	1	[{"id":4,"employee_id":6,"payslip_type_id":1,"amount":6000000,"created_by":2,"created_at":"2023-03-22T04:49:17.000000Z","updated_at":"2023-03-22T04:49:17.000000Z"}]	6000000	[]	[]	[]	[]	[]	{"type":"Percentage","value":"5","maximum_salary":"12000000"}	\N	[]	2	2023-03-22 11:55:47	2023-03-22 11:55:47
9	8	Payslip george 2023-03.pdf	4908750	2023-03	1	[{"id":3,"employee_id":8,"payslip_type_id":1,"amount":6000000,"created_by":2,"created_at":"2023-03-22T04:03:24.000000Z","updated_at":"2023-03-22T04:03:24.000000Z"}]	6000000	[{"id":1,"employee_id":8,"allowance_type_id":1,"amount":100000,"created_by":2,"created_at":"2023-03-22T04:17:43.000000Z","updated_at":"2023-03-22T04:17:43.000000Z"}]	[{"id":1,"employee_id":8,"reimburst_type_id":1,"amount":50000,"created_by":2,"created_at":"2023-03-22T04:12:50.000000Z","updated_at":"2023-03-22T04:12:50.000000Z"}]	[{"id":1,"employee_id":8,"loan_type_id":1,"amount":5000000,"installment":10,"number_of_installment":3,"status":"ongoing","created_by":2,"created_at":"2023-03-22T04:16:28.000000Z","updated_at":"2023-03-22T04:45:41.000000Z"}]	[{"id":1,"employee_id":8,"loan_type_id":2,"installment":10,"number_of_installment":3,"status":"ongoing","amount":4000000,"created_by":2,"created_at":"2023-03-22T04:17:27.000000Z","updated_at":"2023-03-22T04:45:41.000000Z"}]	[]	{"type":"Percentage","value":"5","maximum_salary":"12000000"}	\N	[]	2	2023-03-22 11:56:05	2023-03-22 11:56:05
10	8	Payslip george 2023-03.pdf	4908750	2023-03	1	[{"id":3,"employee_id":8,"payslip_type_id":1,"amount":6000000,"created_by":2,"created_at":"2023-03-22T04:03:24.000000Z","updated_at":"2023-03-22T04:03:24.000000Z"}]	6000000	[{"id":1,"employee_id":8,"allowance_type_id":1,"amount":100000,"created_by":2,"created_at":"2023-03-22T04:17:43.000000Z","updated_at":"2023-03-22T04:17:43.000000Z"}]	[{"id":1,"employee_id":8,"reimburst_type_id":1,"amount":50000,"created_by":2,"created_at":"2023-03-22T04:12:50.000000Z","updated_at":"2023-03-22T04:12:50.000000Z"}]	[{"id":1,"employee_id":8,"loan_type_id":1,"amount":5000000,"installment":10,"number_of_installment":4,"status":"ongoing","created_by":2,"created_at":"2023-03-22T04:16:28.000000Z","updated_at":"2023-03-22T04:56:05.000000Z"}]	[{"id":1,"employee_id":8,"loan_type_id":2,"installment":10,"number_of_installment":4,"status":"ongoing","amount":4000000,"created_by":2,"created_at":"2023-03-22T04:17:27.000000Z","updated_at":"2023-03-22T04:56:05.000000Z"}]	[]	{"type":"Percentage","value":"5","maximum_salary":"12000000"}	\N	[]	2	2023-03-26 15:56:04	2023-03-26 15:56:04
11	6	Payslip FIKRI KURNIAWAN 2023-03.pdf	5557500	2023-03	1	[{"id":4,"employee_id":6,"payslip_type_id":1,"amount":6000000,"created_by":2,"created_at":"2023-03-22T04:49:17.000000Z","updated_at":"2023-03-22T04:49:17.000000Z"}]	6000000	[]	[]	[]	[]	[]	{"type":"Percentage","value":"5","maximum_salary":"12000000"}	\N	[]	2	2023-03-26 15:59:07	2023-03-26 15:59:07
12	8	Payslip george 2023-03.pdf	4908750	2023-03	1	[{"id":3,"employee_id":8,"payslip_type_id":1,"amount":6000000,"created_by":2,"created_at":"2023-03-22T04:03:24.000000Z","updated_at":"2023-03-22T04:03:24.000000Z"}]	6000000	[{"id":1,"employee_id":8,"allowance_type_id":1,"amount":100000,"created_by":2,"created_at":"2023-03-22T04:17:43.000000Z","updated_at":"2023-03-22T04:17:43.000000Z"}]	[{"id":1,"employee_id":8,"reimburst_type_id":1,"amount":50000,"created_by":2,"created_at":"2023-03-22T04:12:50.000000Z","updated_at":"2023-03-22T04:12:50.000000Z"}]	[{"id":1,"employee_id":8,"loan_type_id":1,"amount":5000000,"installment":10,"number_of_installment":5,"status":"ongoing","created_by":2,"created_at":"2023-03-22T04:16:28.000000Z","updated_at":"2023-03-26T08:56:04.000000Z"}]	[{"id":1,"employee_id":8,"loan_type_id":2,"installment":10,"number_of_installment":5,"status":"ongoing","amount":4000000,"created_by":2,"created_at":"2023-03-22T04:17:27.000000Z","updated_at":"2023-03-26T08:56:04.000000Z"}]	[]	{"type":"Percentage","value":"5","maximum_salary":"12000000"}	\N	[]	2	2023-03-26 15:59:24	2023-03-26 15:59:24
\.


--
-- Name: pay_slips_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('pay_slips_id_seq', 12, true);


--
-- Data for Name: payrolls; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY payrolls (id, employee_id, payslip_type_id, amount, created_by, created_at, updated_at) FROM stdin;
1	1	1	10000000	2	2023-03-11 15:05:32	2023-03-11 15:05:32
2	4	1	5000000	2	2023-03-17 15:54:34	2023-03-17 15:54:34
3	8	1	6000000	2	2023-03-22 11:03:24	2023-03-22 11:03:24
4	6	1	6000000	2	2023-03-22 11:49:17	2023-03-22 11:49:17
\.


--
-- Name: payrolls_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('payrolls_id_seq', 4, true);


--
-- Data for Name: payslip_code_pins; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY payslip_code_pins (id, pin, created_by, created_at, updated_at) FROM stdin;
1	$2y$10$n1wRVyJe5/DES1wfpC9EKO0YxM43T8iIgCcMYCEfEEO1GOwQqsP0i	2	2023-03-11 15:05:40	2023-03-22 10:24:54
\.


--
-- Name: payslip_code_pins_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('payslip_code_pins_id_seq', 1, true);


--
-- Data for Name: payslip_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY payslip_types (id, name, type, created_by, created_at, updated_at) FROM stdin;
1	Gaji Pokok	monthly	2	2023-03-11 14:51:15	2023-03-11 14:51:15
2	Gaji Harian	daily	2	2023-03-22 10:40:35	2023-03-22 10:40:35
\.


--
-- Name: payslip_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('payslip_types_id_seq', 2, true);


--
-- Data for Name: performance_reviews; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY performance_reviews (id, employee_id, knowledge, skill, accuracy, quality, care, reliability, working_method, flexibility, initiative, cooperation, attendance, organizational_commitment, kpi_total_score, review_date, created_by, notes, created_at, updated_at) FROM stdin;
1	8	5	4	3	5	4	4	5	4	2	5	4	4	4.08	\N	2	test	2023-03-22 11:01:51	2023-03-22 11:01:51
\.


--
-- Name: performance_reviews_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('performance_reviews_id_seq', 1, true);


--
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY permissions (id, name, guard_name, created_at, updated_at) FROM stdin;
1	show hrm dashboard	web	2023-03-11 14:51:14	2023-03-11 14:51:14
2	copy invoice	web	2023-03-11 14:51:14	2023-03-11 14:51:14
3	show project dashboard	web	2023-03-11 14:51:14	2023-03-11 14:51:14
4	show account dashboard	web	2023-03-11 14:51:14	2023-03-11 14:51:14
5	manage user	web	2023-03-11 14:51:14	2023-03-11 14:51:14
6	create user	web	2023-03-11 14:51:14	2023-03-11 14:51:14
7	edit user	web	2023-03-11 14:51:14	2023-03-11 14:51:14
8	delete user	web	2023-03-11 14:51:14	2023-03-11 14:51:14
9	create language	web	2023-03-11 14:51:14	2023-03-11 14:51:14
10	manage role	web	2023-03-11 14:51:14	2023-03-11 14:51:14
11	create role	web	2023-03-11 14:51:14	2023-03-11 14:51:14
12	edit role	web	2023-03-11 14:51:14	2023-03-11 14:51:14
13	delete role	web	2023-03-11 14:51:14	2023-03-11 14:51:14
14	manage permission	web	2023-03-11 14:51:14	2023-03-11 14:51:14
15	create permission	web	2023-03-11 14:51:14	2023-03-11 14:51:14
16	edit permission	web	2023-03-11 14:51:14	2023-03-11 14:51:14
17	delete permission	web	2023-03-11 14:51:14	2023-03-11 14:51:14
18	manage company settings	web	2023-03-11 14:51:14	2023-03-11 14:51:14
19	manage print settings	web	2023-03-11 14:51:14	2023-03-11 14:51:14
20	manage business settings	web	2023-03-11 14:51:14	2023-03-11 14:51:14
21	manage stripe settings	web	2023-03-11 14:51:14	2023-03-11 14:51:14
22	manage expense	web	2023-03-11 14:51:14	2023-03-11 14:51:14
23	create expense	web	2023-03-11 14:51:14	2023-03-11 14:51:14
24	edit expense	web	2023-03-11 14:51:14	2023-03-11 14:51:14
25	delete expense	web	2023-03-11 14:51:14	2023-03-11 14:51:14
26	manage invoice	web	2023-03-11 14:51:14	2023-03-11 14:51:14
27	create invoice	web	2023-03-11 14:51:14	2023-03-11 14:51:14
28	edit invoice	web	2023-03-11 14:51:14	2023-03-11 14:51:14
29	delete invoice	web	2023-03-11 14:51:14	2023-03-11 14:51:14
30	show invoice	web	2023-03-11 14:51:14	2023-03-11 14:51:14
31	create payment invoice	web	2023-03-11 14:51:14	2023-03-11 14:51:14
32	delete payment invoice	web	2023-03-11 14:51:14	2023-03-11 14:51:14
33	send invoice	web	2023-03-11 14:51:14	2023-03-11 14:51:14
34	delete invoice product	web	2023-03-11 14:51:14	2023-03-11 14:51:14
35	convert invoice	web	2023-03-11 14:51:14	2023-03-11 14:51:14
36	manage constant unit	web	2023-03-11 14:51:14	2023-03-11 14:51:14
37	create constant unit	web	2023-03-11 14:51:14	2023-03-11 14:51:14
38	edit constant unit	web	2023-03-11 14:51:14	2023-03-11 14:51:14
39	delete constant unit	web	2023-03-11 14:51:14	2023-03-11 14:51:14
40	manage constant tax	web	2023-03-11 14:51:14	2023-03-11 14:51:14
41	create constant tax	web	2023-03-11 14:51:14	2023-03-11 14:51:14
42	edit constant tax	web	2023-03-11 14:51:14	2023-03-11 14:51:14
43	delete constant tax	web	2023-03-11 14:51:14	2023-03-11 14:51:14
44	manage constant category	web	2023-03-11 14:51:14	2023-03-11 14:51:14
45	create constant category	web	2023-03-11 14:51:14	2023-03-11 14:51:14
46	edit constant category	web	2023-03-11 14:51:14	2023-03-11 14:51:14
47	delete constant category	web	2023-03-11 14:51:14	2023-03-11 14:51:14
48	manage product & service	web	2023-03-11 14:51:14	2023-03-11 14:51:14
49	create product & service	web	2023-03-11 14:51:14	2023-03-11 14:51:14
50	edit product & service	web	2023-03-11 14:51:14	2023-03-11 14:51:14
51	delete product & service	web	2023-03-11 14:51:14	2023-03-11 14:51:14
52	manage customer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
53	create customer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
54	edit customer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
55	delete customer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
56	show customer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
57	manage vender	web	2023-03-11 14:51:14	2023-03-11 14:51:14
58	create vender	web	2023-03-11 14:51:14	2023-03-11 14:51:14
59	edit vender	web	2023-03-11 14:51:14	2023-03-11 14:51:14
60	delete vender	web	2023-03-11 14:51:14	2023-03-11 14:51:14
61	show vender	web	2023-03-11 14:51:14	2023-03-11 14:51:14
62	manage bank account	web	2023-03-11 14:51:14	2023-03-11 14:51:14
63	create bank account	web	2023-03-11 14:51:14	2023-03-11 14:51:14
64	edit bank account	web	2023-03-11 14:51:14	2023-03-11 14:51:14
65	delete bank account	web	2023-03-11 14:51:14	2023-03-11 14:51:14
66	manage bank transfer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
67	create bank transfer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
68	edit bank transfer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
69	delete bank transfer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
70	manage transaction	web	2023-03-11 14:51:14	2023-03-11 14:51:14
71	manage revenue	web	2023-03-11 14:51:14	2023-03-11 14:51:14
72	create revenue	web	2023-03-11 14:51:14	2023-03-11 14:51:14
73	edit revenue	web	2023-03-11 14:51:14	2023-03-11 14:51:14
74	delete revenue	web	2023-03-11 14:51:14	2023-03-11 14:51:14
75	manage bill	web	2023-03-11 14:51:14	2023-03-11 14:51:14
76	create bill	web	2023-03-11 14:51:14	2023-03-11 14:51:14
77	edit bill	web	2023-03-11 14:51:14	2023-03-11 14:51:14
78	delete bill	web	2023-03-11 14:51:14	2023-03-11 14:51:14
79	show bill	web	2023-03-11 14:51:14	2023-03-11 14:51:14
80	manage payment	web	2023-03-11 14:51:14	2023-03-11 14:51:14
81	create payment	web	2023-03-11 14:51:14	2023-03-11 14:51:14
82	edit payment	web	2023-03-11 14:51:14	2023-03-11 14:51:14
83	delete payment	web	2023-03-11 14:51:14	2023-03-11 14:51:14
84	delete bill product	web	2023-03-11 14:51:14	2023-03-11 14:51:14
85	send bill	web	2023-03-11 14:51:14	2023-03-11 14:51:14
86	create payment bill	web	2023-03-11 14:51:14	2023-03-11 14:51:14
87	delete payment bill	web	2023-03-11 14:51:14	2023-03-11 14:51:14
88	manage order	web	2023-03-11 14:51:14	2023-03-11 14:51:14
89	income report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
90	expense report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
91	income vs expense report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
92	invoice report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
93	bill report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
94	stock report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
95	tax report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
96	loss & profit report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
97	manage customer payment	web	2023-03-11 14:51:14	2023-03-11 14:51:14
98	manage customer transaction	web	2023-03-11 14:51:14	2023-03-11 14:51:14
99	manage customer invoice	web	2023-03-11 14:51:14	2023-03-11 14:51:14
100	vender manage bill	web	2023-03-11 14:51:14	2023-03-11 14:51:14
101	manage vender bill	web	2023-03-11 14:51:14	2023-03-11 14:51:14
102	manage vender payment	web	2023-03-11 14:51:14	2023-03-11 14:51:14
103	manage vender transaction	web	2023-03-11 14:51:14	2023-03-11 14:51:14
104	manage credit note	web	2023-03-11 14:51:14	2023-03-11 14:51:14
105	create credit note	web	2023-03-11 14:51:14	2023-03-11 14:51:14
106	edit credit note	web	2023-03-11 14:51:14	2023-03-11 14:51:14
107	delete credit note	web	2023-03-11 14:51:14	2023-03-11 14:51:14
108	manage debit note	web	2023-03-11 14:51:14	2023-03-11 14:51:14
109	create debit note	web	2023-03-11 14:51:14	2023-03-11 14:51:14
110	edit debit note	web	2023-03-11 14:51:14	2023-03-11 14:51:14
111	delete debit note	web	2023-03-11 14:51:14	2023-03-11 14:51:14
112	duplicate invoice	web	2023-03-11 14:51:14	2023-03-11 14:51:14
113	duplicate bill	web	2023-03-11 14:51:14	2023-03-11 14:51:14
114	manage proposal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
115	create proposal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
116	edit proposal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
117	delete proposal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
118	duplicate proposal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
119	show proposal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
120	send proposal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
121	delete proposal product	web	2023-03-11 14:51:14	2023-03-11 14:51:14
122	manage customer proposal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
123	manage goal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
124	create goal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
125	edit goal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
126	delete goal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
127	manage assets	web	2023-03-11 14:51:14	2023-03-11 14:51:14
128	create assets	web	2023-03-11 14:51:14	2023-03-11 14:51:14
129	edit assets	web	2023-03-11 14:51:14	2023-03-11 14:51:14
130	delete assets	web	2023-03-11 14:51:14	2023-03-11 14:51:14
131	statement report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
132	manage constant custom field	web	2023-03-11 14:51:14	2023-03-11 14:51:14
133	create constant custom field	web	2023-03-11 14:51:14	2023-03-11 14:51:14
134	edit constant custom field	web	2023-03-11 14:51:14	2023-03-11 14:51:14
135	delete constant custom field	web	2023-03-11 14:51:14	2023-03-11 14:51:14
136	manage chart of account	web	2023-03-11 14:51:14	2023-03-11 14:51:14
137	create chart of account	web	2023-03-11 14:51:14	2023-03-11 14:51:14
138	edit chart of account	web	2023-03-11 14:51:14	2023-03-11 14:51:14
139	delete chart of account	web	2023-03-11 14:51:14	2023-03-11 14:51:14
140	manage journal entry	web	2023-03-11 14:51:14	2023-03-11 14:51:14
141	create journal entry	web	2023-03-11 14:51:14	2023-03-11 14:51:14
142	edit journal entry	web	2023-03-11 14:51:14	2023-03-11 14:51:14
143	delete journal entry	web	2023-03-11 14:51:14	2023-03-11 14:51:14
144	show journal entry	web	2023-03-11 14:51:14	2023-03-11 14:51:14
145	balance sheet report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
146	ledger report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
147	trial balance report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
148	manage client	web	2023-03-11 14:51:14	2023-03-11 14:51:14
149	create client	web	2023-03-11 14:51:14	2023-03-11 14:51:14
150	edit client	web	2023-03-11 14:51:14	2023-03-11 14:51:14
151	delete client	web	2023-03-11 14:51:14	2023-03-11 14:51:14
152	manage lead	web	2023-03-11 14:51:14	2023-03-11 14:51:14
153	create lead	web	2023-03-11 14:51:14	2023-03-11 14:51:14
154	view lead	web	2023-03-11 14:51:14	2023-03-11 14:51:14
155	edit lead	web	2023-03-11 14:51:14	2023-03-11 14:51:14
156	delete lead	web	2023-03-11 14:51:14	2023-03-11 14:51:14
157	move lead	web	2023-03-11 14:51:14	2023-03-11 14:51:14
158	create lead call	web	2023-03-11 14:51:14	2023-03-11 14:51:14
159	edit lead call	web	2023-03-11 14:51:14	2023-03-11 14:51:14
160	delete lead call	web	2023-03-11 14:51:14	2023-03-11 14:51:14
161	create lead email	web	2023-03-11 14:51:14	2023-03-11 14:51:14
162	manage pipeline	web	2023-03-11 14:51:14	2023-03-11 14:51:14
163	create pipeline	web	2023-03-11 14:51:14	2023-03-11 14:51:14
164	edit pipeline	web	2023-03-11 14:51:14	2023-03-11 14:51:14
165	delete pipeline	web	2023-03-11 14:51:14	2023-03-11 14:51:14
166	manage lead stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
167	create lead stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
168	edit lead stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
169	delete lead stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
170	convert lead to deal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
171	manage source	web	2023-03-11 14:51:14	2023-03-11 14:51:14
172	create source	web	2023-03-11 14:51:14	2023-03-11 14:51:14
173	edit source	web	2023-03-11 14:51:14	2023-03-11 14:51:14
174	delete source	web	2023-03-11 14:51:14	2023-03-11 14:51:14
175	manage label	web	2023-03-11 14:51:14	2023-03-11 14:51:14
176	create label	web	2023-03-11 14:51:14	2023-03-11 14:51:14
177	edit label	web	2023-03-11 14:51:14	2023-03-11 14:51:14
178	delete label	web	2023-03-11 14:51:14	2023-03-11 14:51:14
179	manage deal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
180	create deal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
181	view task	web	2023-03-11 14:51:14	2023-03-11 14:51:14
182	create task	web	2023-03-11 14:51:14	2023-03-11 14:51:14
183	edit task	web	2023-03-11 14:51:14	2023-03-11 14:51:14
184	delete task	web	2023-03-11 14:51:14	2023-03-11 14:51:14
185	edit deal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
186	view deal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
187	delete deal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
188	move deal	web	2023-03-11 14:51:14	2023-03-11 14:51:14
189	create deal call	web	2023-03-11 14:51:14	2023-03-11 14:51:14
190	edit deal call	web	2023-03-11 14:51:14	2023-03-11 14:51:14
191	delete deal call	web	2023-03-11 14:51:14	2023-03-11 14:51:14
192	create deal email	web	2023-03-11 14:51:14	2023-03-11 14:51:14
193	manage stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
194	create stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
195	edit stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
196	delete stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
197	manage employee	web	2023-03-11 14:51:14	2023-03-11 14:51:14
198	create employee	web	2023-03-11 14:51:14	2023-03-11 14:51:14
199	view employee	web	2023-03-11 14:51:14	2023-03-11 14:51:14
200	edit employee	web	2023-03-11 14:51:14	2023-03-11 14:51:14
201	delete employee	web	2023-03-11 14:51:14	2023-03-11 14:51:14
202	manage employee profile	web	2023-03-11 14:51:14	2023-03-11 14:51:14
203	show employee profile	web	2023-03-11 14:51:14	2023-03-11 14:51:14
204	manage department	web	2023-03-11 14:51:14	2023-03-11 14:51:14
205	create department	web	2023-03-11 14:51:14	2023-03-11 14:51:14
206	view department	web	2023-03-11 14:51:14	2023-03-11 14:51:14
207	edit department	web	2023-03-11 14:51:14	2023-03-11 14:51:14
208	delete department	web	2023-03-11 14:51:14	2023-03-11 14:51:14
209	manage designation	web	2023-03-11 14:51:14	2023-03-11 14:51:14
210	create designation	web	2023-03-11 14:51:14	2023-03-11 14:51:14
211	view designation	web	2023-03-11 14:51:14	2023-03-11 14:51:14
212	edit designation	web	2023-03-11 14:51:14	2023-03-11 14:51:14
213	delete designation	web	2023-03-11 14:51:14	2023-03-11 14:51:14
214	manage branch	web	2023-03-11 14:51:14	2023-03-11 14:51:14
215	create branch	web	2023-03-11 14:51:14	2023-03-11 14:51:14
216	edit branch	web	2023-03-11 14:51:14	2023-03-11 14:51:14
217	delete branch	web	2023-03-11 14:51:14	2023-03-11 14:51:14
218	manage document type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
219	create document type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
220	edit document type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
221	delete document type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
222	manage document	web	2023-03-11 14:51:14	2023-03-11 14:51:14
223	create document	web	2023-03-11 14:51:14	2023-03-11 14:51:14
224	edit document	web	2023-03-11 14:51:14	2023-03-11 14:51:14
225	delete document	web	2023-03-11 14:51:14	2023-03-11 14:51:14
226	manage payslip type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
227	create payslip type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
228	edit payslip type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
229	delete payslip type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
230	manage payslip	web	2023-03-11 14:51:14	2023-03-11 14:51:14
231	generate payslip	web	2023-03-11 14:51:14	2023-03-11 14:51:14
232	create reimbursement	web	2023-03-11 14:51:14	2023-03-11 14:51:14
233	edit reimbursement	web	2023-03-11 14:51:14	2023-03-11 14:51:14
234	delete reimbursement	web	2023-03-11 14:51:14	2023-03-11 14:51:14
235	create commission	web	2023-03-11 14:51:14	2023-03-11 14:51:14
236	edit commission	web	2023-03-11 14:51:14	2023-03-11 14:51:14
237	delete commission	web	2023-03-11 14:51:14	2023-03-11 14:51:14
238	manage reimbursement option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
239	create reimbursement option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
240	edit reimbursement option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
241	delete reimbursement option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
242	manage loan option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
243	create loan option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
244	edit loan option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
245	delete loan option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
246	manage deduction option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
247	create deduction option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
248	edit deduction option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
249	delete deduction option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
250	manage loan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
251	create loan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
252	edit loan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
253	delete loan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
254	create saturation deduction	web	2023-03-11 14:51:14	2023-03-11 14:51:14
255	edit saturation deduction	web	2023-03-11 14:51:14	2023-03-11 14:51:14
256	delete saturation deduction	web	2023-03-11 14:51:14	2023-03-11 14:51:14
257	create other payment	web	2023-03-11 14:51:14	2023-03-11 14:51:14
258	edit other payment	web	2023-03-11 14:51:14	2023-03-11 14:51:14
259	delete other payment	web	2023-03-11 14:51:14	2023-03-11 14:51:14
260	manage overtime	web	2023-03-11 14:51:14	2023-03-11 14:51:14
261	create overtime	web	2023-03-11 14:51:14	2023-03-11 14:51:14
262	edit overtime	web	2023-03-11 14:51:14	2023-03-11 14:51:14
263	delete overtime	web	2023-03-11 14:51:14	2023-03-11 14:51:14
264	manage day type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
265	create day type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
266	edit day type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
267	delete day type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
268	manage overtime type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
269	create overtime type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
270	edit overtime type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
271	delete overtime type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
272	manage set salary	web	2023-03-11 14:51:14	2023-03-11 14:51:14
273	edit set salary	web	2023-03-11 14:51:14	2023-03-11 14:51:14
274	manage pay slip	web	2023-03-11 14:51:14	2023-03-11 14:51:14
275	create set salary	web	2023-03-11 14:51:14	2023-03-11 14:51:14
276	create pay slip	web	2023-03-11 14:51:14	2023-03-11 14:51:14
277	manage company policy	web	2023-03-11 14:51:14	2023-03-11 14:51:14
278	create company policy	web	2023-03-11 14:51:14	2023-03-11 14:51:14
279	edit company policy	web	2023-03-11 14:51:14	2023-03-11 14:51:14
280	manage performance review	web	2023-03-11 14:51:14	2023-03-11 14:51:14
281	create performance review	web	2023-03-11 14:51:14	2023-03-11 14:51:14
282	edit performance review	web	2023-03-11 14:51:14	2023-03-11 14:51:14
283	show performance review	web	2023-03-11 14:51:14	2023-03-11 14:51:14
284	delete performance review	web	2023-03-11 14:51:14	2023-03-11 14:51:14
285	manage goal tracking	web	2023-03-11 14:51:14	2023-03-11 14:51:14
286	create goal tracking	web	2023-03-11 14:51:14	2023-03-11 14:51:14
287	edit goal tracking	web	2023-03-11 14:51:14	2023-03-11 14:51:14
288	delete goal tracking	web	2023-03-11 14:51:14	2023-03-11 14:51:14
289	manage goal type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
290	create goal type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
291	edit goal type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
292	delete goal type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
293	manage indicator	web	2023-03-11 14:51:14	2023-03-11 14:51:14
294	create indicator	web	2023-03-11 14:51:14	2023-03-11 14:51:14
295	edit indicator	web	2023-03-11 14:51:14	2023-03-11 14:51:14
296	show indicator	web	2023-03-11 14:51:14	2023-03-11 14:51:14
297	delete indicator	web	2023-03-11 14:51:14	2023-03-11 14:51:14
298	manage training	web	2023-03-11 14:51:14	2023-03-11 14:51:14
299	create training	web	2023-03-11 14:51:14	2023-03-11 14:51:14
300	edit training	web	2023-03-11 14:51:14	2023-03-11 14:51:14
301	delete training	web	2023-03-11 14:51:14	2023-03-11 14:51:14
302	show training	web	2023-03-11 14:51:14	2023-03-11 14:51:14
303	manage trainer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
304	create trainer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
305	edit trainer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
306	delete trainer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
307	manage training type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
308	create training type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
309	edit training type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
310	delete training type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
311	manage award	web	2023-03-11 14:51:14	2023-03-11 14:51:14
312	create award	web	2023-03-11 14:51:14	2023-03-11 14:51:14
313	edit award	web	2023-03-11 14:51:14	2023-03-11 14:51:14
314	delete award	web	2023-03-11 14:51:14	2023-03-11 14:51:14
315	manage award type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
316	create award type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
317	edit award type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
318	delete award type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
319	manage resignation	web	2023-03-11 14:51:14	2023-03-11 14:51:14
320	create resignation	web	2023-03-11 14:51:14	2023-03-11 14:51:14
321	edit resignation	web	2023-03-11 14:51:14	2023-03-11 14:51:14
322	delete resignation	web	2023-03-11 14:51:14	2023-03-11 14:51:14
323	manage on duty	web	2023-03-11 14:51:14	2023-03-11 14:51:14
324	create on duty	web	2023-03-11 14:51:14	2023-03-11 14:51:14
325	edit on duty	web	2023-03-11 14:51:14	2023-03-11 14:51:14
326	delete on duty	web	2023-03-11 14:51:14	2023-03-11 14:51:14
327	manage promotion	web	2023-03-11 14:51:14	2023-03-11 14:51:14
328	create promotion	web	2023-03-11 14:51:14	2023-03-11 14:51:14
329	edit promotion	web	2023-03-11 14:51:14	2023-03-11 14:51:14
330	delete promotion	web	2023-03-11 14:51:14	2023-03-11 14:51:14
331	manage complaint	web	2023-03-11 14:51:14	2023-03-11 14:51:14
332	create complaint	web	2023-03-11 14:51:14	2023-03-11 14:51:14
333	edit complaint	web	2023-03-11 14:51:14	2023-03-11 14:51:14
334	delete complaint	web	2023-03-11 14:51:14	2023-03-11 14:51:14
335	manage warning	web	2023-03-11 14:51:14	2023-03-11 14:51:14
336	create warning	web	2023-03-11 14:51:14	2023-03-11 14:51:14
337	edit warning	web	2023-03-11 14:51:14	2023-03-11 14:51:14
338	delete warning	web	2023-03-11 14:51:14	2023-03-11 14:51:14
339	manage termination	web	2023-03-11 14:51:14	2023-03-11 14:51:14
340	create termination	web	2023-03-11 14:51:14	2023-03-11 14:51:14
341	edit termination	web	2023-03-11 14:51:14	2023-03-11 14:51:14
342	delete termination	web	2023-03-11 14:51:14	2023-03-11 14:51:14
343	manage termination type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
344	create termination type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
345	edit termination type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
346	delete termination type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
347	manage job application	web	2023-03-11 14:51:14	2023-03-11 14:51:14
348	create job application	web	2023-03-11 14:51:14	2023-03-11 14:51:14
349	show job application	web	2023-03-11 14:51:14	2023-03-11 14:51:14
350	delete job application	web	2023-03-11 14:51:14	2023-03-11 14:51:14
351	move job application	web	2023-03-11 14:51:14	2023-03-11 14:51:14
352	add job application skill	web	2023-03-11 14:51:14	2023-03-11 14:51:14
353	add job application note	web	2023-03-11 14:51:14	2023-03-11 14:51:14
354	delete job application note	web	2023-03-11 14:51:14	2023-03-11 14:51:14
355	manage job onBoard	web	2023-03-11 14:51:14	2023-03-11 14:51:14
356	manage job category	web	2023-03-11 14:51:14	2023-03-11 14:51:14
357	create job category	web	2023-03-11 14:51:14	2023-03-11 14:51:14
358	edit job category	web	2023-03-11 14:51:14	2023-03-11 14:51:14
359	delete job category	web	2023-03-11 14:51:14	2023-03-11 14:51:14
360	manage job	web	2023-03-11 14:51:14	2023-03-11 14:51:14
361	create job	web	2023-03-11 14:51:14	2023-03-11 14:51:14
362	edit job	web	2023-03-11 14:51:14	2023-03-11 14:51:14
363	show job	web	2023-03-11 14:51:14	2023-03-11 14:51:14
364	delete job	web	2023-03-11 14:51:14	2023-03-11 14:51:14
365	manage job stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
366	create job stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
367	edit job stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
368	delete job stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
369	Manage Competencies	web	2023-03-11 14:51:14	2023-03-11 14:51:14
370	Create Competencies	web	2023-03-11 14:51:14	2023-03-11 14:51:14
371	Edit Competencies	web	2023-03-11 14:51:14	2023-03-11 14:51:14
372	Delete Competencies	web	2023-03-11 14:51:14	2023-03-11 14:51:14
373	manage custom question	web	2023-03-11 14:51:14	2023-03-11 14:51:14
374	create custom question	web	2023-03-11 14:51:14	2023-03-11 14:51:14
375	edit custom question	web	2023-03-11 14:51:14	2023-03-11 14:51:14
376	delete custom question	web	2023-03-11 14:51:14	2023-03-11 14:51:14
377	create interview schedule	web	2023-03-11 14:51:14	2023-03-11 14:51:14
378	edit interview schedule	web	2023-03-11 14:51:14	2023-03-11 14:51:14
379	delete interview schedule	web	2023-03-11 14:51:14	2023-03-11 14:51:14
380	show interview schedule	web	2023-03-11 14:51:14	2023-03-11 14:51:14
381	create estimation	web	2023-03-11 14:51:14	2023-03-11 14:51:14
382	view estimation	web	2023-03-11 14:51:14	2023-03-11 14:51:14
383	edit estimation	web	2023-03-11 14:51:14	2023-03-11 14:51:14
384	delete estimation	web	2023-03-11 14:51:14	2023-03-11 14:51:14
385	edit holiday	web	2023-03-11 14:51:14	2023-03-11 14:51:14
386	create holiday	web	2023-03-11 14:51:14	2023-03-11 14:51:14
387	delete holiday	web	2023-03-11 14:51:14	2023-03-11 14:51:14
388	manage holiday	web	2023-03-11 14:51:14	2023-03-11 14:51:14
389	show career	web	2023-03-11 14:51:14	2023-03-11 14:51:14
390	manage meeting	web	2023-03-11 14:51:14	2023-03-11 14:51:14
391	create meeting	web	2023-03-11 14:51:14	2023-03-11 14:51:14
392	edit meeting	web	2023-03-11 14:51:14	2023-03-11 14:51:14
393	delete meeting	web	2023-03-11 14:51:14	2023-03-11 14:51:14
394	manage event	web	2023-03-11 14:51:14	2023-03-11 14:51:14
395	create event	web	2023-03-11 14:51:14	2023-03-11 14:51:14
396	edit event	web	2023-03-11 14:51:14	2023-03-11 14:51:14
397	delete event	web	2023-03-11 14:51:14	2023-03-11 14:51:14
398	manage transfer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
399	create transfer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
400	edit transfer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
401	delete transfer	web	2023-03-11 14:51:14	2023-03-11 14:51:14
402	manage announcement	web	2023-03-11 14:51:14	2023-03-11 14:51:14
403	create announcement	web	2023-03-11 14:51:14	2023-03-11 14:51:14
404	edit announcement	web	2023-03-11 14:51:14	2023-03-11 14:51:14
405	delete announcement	web	2023-03-11 14:51:14	2023-03-11 14:51:14
406	manage leave	web	2023-03-11 14:51:14	2023-03-11 14:51:14
407	create leave	web	2023-03-11 14:51:14	2023-03-11 14:51:14
408	edit leave	web	2023-03-11 14:51:14	2023-03-11 14:51:14
409	delete leave	web	2023-03-11 14:51:14	2023-03-11 14:51:14
410	manage leave type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
411	create leave type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
412	edit leave type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
413	delete leave type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
414	manage attendance	web	2023-03-11 14:51:14	2023-03-11 14:51:14
415	create attendance	web	2023-03-11 14:51:14	2023-03-11 14:51:14
416	edit attendance	web	2023-03-11 14:51:14	2023-03-11 14:51:14
417	delete attendance	web	2023-03-11 14:51:14	2023-03-11 14:51:14
418	manage report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
419	manage project	web	2023-03-11 14:51:14	2023-03-11 14:51:14
420	create project	web	2023-03-11 14:51:14	2023-03-11 14:51:14
421	view project	web	2023-03-11 14:51:14	2023-03-11 14:51:14
422	edit project	web	2023-03-11 14:51:14	2023-03-11 14:51:14
423	delete project	web	2023-03-11 14:51:14	2023-03-11 14:51:14
424	create milestone	web	2023-03-11 14:51:14	2023-03-11 14:51:14
425	edit milestone	web	2023-03-11 14:51:14	2023-03-11 14:51:14
426	delete milestone	web	2023-03-11 14:51:14	2023-03-11 14:51:14
427	view milestone	web	2023-03-11 14:51:14	2023-03-11 14:51:14
428	view grant chart	web	2023-03-11 14:51:14	2023-03-11 14:51:14
429	manage project stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
430	create project stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
431	edit project stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
432	delete project stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
433	view expense	web	2023-03-11 14:51:14	2023-03-11 14:51:14
434	manage project task	web	2023-03-11 14:51:14	2023-03-11 14:51:14
435	create project task	web	2023-03-11 14:51:14	2023-03-11 14:51:14
436	edit project task	web	2023-03-11 14:51:14	2023-03-11 14:51:14
437	view project task	web	2023-03-11 14:51:14	2023-03-11 14:51:14
438	delete project task	web	2023-03-11 14:51:14	2023-03-11 14:51:14
439	view activity	web	2023-03-11 14:51:14	2023-03-11 14:51:14
440	view CRM activity	web	2023-03-11 14:51:14	2023-03-11 14:51:14
441	manage project task stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
442	edit project task stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
443	create project task stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
444	delete project task stage	web	2023-03-11 14:51:14	2023-03-11 14:51:14
445	manage timesheet	web	2023-03-11 14:51:14	2023-03-11 14:51:14
446	create timesheet	web	2023-03-11 14:51:14	2023-03-11 14:51:14
447	edit timesheet	web	2023-03-11 14:51:14	2023-03-11 14:51:14
448	delete timesheet	web	2023-03-11 14:51:14	2023-03-11 14:51:14
449	manage bug report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
450	create bug report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
451	edit bug report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
452	delete bug report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
453	move bug report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
454	manage bug status	web	2023-03-11 14:51:14	2023-03-11 14:51:14
455	create bug status	web	2023-03-11 14:51:14	2023-03-11 14:51:14
456	edit bug status	web	2023-03-11 14:51:14	2023-03-11 14:51:14
457	delete bug status	web	2023-03-11 14:51:14	2023-03-11 14:51:14
458	manage client dashboard	web	2023-03-11 14:51:14	2023-03-11 14:51:14
459	manage super admin dashboard	web	2023-03-11 14:51:14	2023-03-11 14:51:14
460	manage system settings	web	2023-03-11 14:51:14	2023-03-11 14:51:14
461	manage plan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
462	create plan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
463	edit plan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
464	manage coupon	web	2023-03-11 14:51:14	2023-03-11 14:51:14
465	create coupon	web	2023-03-11 14:51:14	2023-03-11 14:51:14
466	edit coupon	web	2023-03-11 14:51:14	2023-03-11 14:51:14
467	delete coupon	web	2023-03-11 14:51:14	2023-03-11 14:51:14
468	manage company plan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
469	buy plan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
470	manage form builder	web	2023-03-11 14:51:14	2023-03-11 14:51:14
471	create form builder	web	2023-03-11 14:51:14	2023-03-11 14:51:14
472	edit form builder	web	2023-03-11 14:51:14	2023-03-11 14:51:14
473	delete form builder	web	2023-03-11 14:51:14	2023-03-11 14:51:14
474	manage performance type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
475	create performance type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
476	edit performance type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
477	delete performance type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
478	manage form field	web	2023-03-11 14:51:14	2023-03-11 14:51:14
479	create form field	web	2023-03-11 14:51:14	2023-03-11 14:51:14
480	edit form field	web	2023-03-11 14:51:14	2023-03-11 14:51:14
481	delete form field	web	2023-03-11 14:51:14	2023-03-11 14:51:14
482	view form response	web	2023-03-11 14:51:14	2023-03-11 14:51:14
483	create budget plan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
484	edit budget plan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
485	manage budget plan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
486	delete budget plan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
487	view budget plan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
488	manage warehouse	web	2023-03-11 14:51:14	2023-03-11 14:51:14
489	create warehouse	web	2023-03-11 14:51:14	2023-03-11 14:51:14
490	edit warehouse	web	2023-03-11 14:51:14	2023-03-11 14:51:14
491	show warehouse	web	2023-03-11 14:51:14	2023-03-11 14:51:14
492	delete warehouse	web	2023-03-11 14:51:14	2023-03-11 14:51:14
493	manage purchase	web	2023-03-11 14:51:14	2023-03-11 14:51:14
494	create purchase	web	2023-03-11 14:51:14	2023-03-11 14:51:14
495	edit purchase	web	2023-03-11 14:51:14	2023-03-11 14:51:14
496	show employee request	web	2023-03-11 14:51:14	2023-03-11 14:51:14
497	manage employee request	web	2023-03-11 14:51:14	2023-03-11 14:51:14
498	show purchase	web	2023-03-11 14:51:14	2023-03-11 14:51:14
499	delete purchase	web	2023-03-11 14:51:14	2023-03-11 14:51:14
500	send purchase	web	2023-03-11 14:51:14	2023-03-11 14:51:14
501	create payment purchase	web	2023-03-11 14:51:14	2023-03-11 14:51:14
502	manage pos	web	2023-03-11 14:51:14	2023-03-11 14:51:14
503	manage contract type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
504	create contract type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
505	edit contract type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
506	delete contract type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
507	manage shift type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
508	create shift type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
509	edit shift type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
510	delete shift type	web	2023-03-11 14:51:14	2023-03-11 14:51:14
511	manage request shift schedule	web	2023-03-11 14:51:14	2023-03-11 14:51:14
512	show shift schedule	web	2023-03-11 14:51:14	2023-03-11 14:51:14
513	create shift schedule	web	2023-03-11 14:51:14	2023-03-11 14:51:14
514	edit shift schedule	web	2023-03-11 14:51:14	2023-03-11 14:51:14
515	delete shift schedule	web	2023-03-11 14:51:14	2023-03-11 14:51:14
516	create request shift schedule	web	2023-03-11 14:51:14	2023-03-11 14:51:14
517	edit request shift schedule	web	2023-03-11 14:51:14	2023-03-11 14:51:14
518	delete request shift schedule	web	2023-03-11 14:51:14	2023-03-11 14:51:14
519	manage contract	web	2023-03-11 14:51:14	2023-03-11 14:51:14
520	create contract	web	2023-03-11 14:51:14	2023-03-11 14:51:14
521	edit contract	web	2023-03-11 14:51:14	2023-03-11 14:51:14
522	delete contract	web	2023-03-11 14:51:14	2023-03-11 14:51:14
523	show contract	web	2023-03-11 14:51:14	2023-03-11 14:51:14
524	show time management report	web	2023-03-11 14:51:14	2023-03-11 14:51:14
525	manage payroll	web	2023-03-11 14:51:14	2023-03-11 14:51:14
526	create payroll	web	2023-03-11 14:51:14	2023-03-11 14:51:14
527	edit payroll	web	2023-03-11 14:51:14	2023-03-11 14:51:14
528	delete payroll	web	2023-03-11 14:51:14	2023-03-11 14:51:14
529	show payroll	web	2023-03-11 14:51:14	2023-03-11 14:51:14
530	manage reimburst	web	2023-03-11 14:51:14	2023-03-11 14:51:14
531	create reimburst	web	2023-03-11 14:51:14	2023-03-11 14:51:14
532	edit reimburst	web	2023-03-11 14:51:14	2023-03-11 14:51:14
533	delete reimburst	web	2023-03-11 14:51:14	2023-03-11 14:51:14
534	show reimburst	web	2023-03-11 14:51:14	2023-03-11 14:51:14
535	manage cash	web	2023-03-11 14:51:14	2023-03-11 14:51:14
536	create cash	web	2023-03-11 14:51:14	2023-03-11 14:51:14
537	edit cash	web	2023-03-11 14:51:14	2023-03-11 14:51:14
538	delete cash	web	2023-03-11 14:51:14	2023-03-11 14:51:14
539	manage cash advance	web	2023-03-11 14:51:14	2023-03-11 14:51:14
540	create cash advance	web	2023-03-11 14:51:14	2023-03-11 14:51:14
541	edit cash advance	web	2023-03-11 14:51:14	2023-03-11 14:51:14
542	delete cash advance	web	2023-03-11 14:51:14	2023-03-11 14:51:14
543	show cash	web	2023-03-11 14:51:14	2023-03-11 14:51:14
544	manage allowance	web	2023-03-11 14:51:14	2023-03-11 14:51:14
545	create allowance	web	2023-03-11 14:51:14	2023-03-11 14:51:14
546	edit allowance	web	2023-03-11 14:51:14	2023-03-11 14:51:14
547	delete allowance	web	2023-03-11 14:51:14	2023-03-11 14:51:14
548	manage allowance option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
549	create allowance option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
550	edit allowance option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
551	delete allowance option	web	2023-03-11 14:51:14	2023-03-11 14:51:14
552	manage denda	web	2023-03-11 14:51:14	2023-03-11 14:51:14
553	create denda	web	2023-03-11 14:51:14	2023-03-11 14:51:14
554	edit denda	web	2023-03-11 14:51:14	2023-03-11 14:51:14
555	delete denda	web	2023-03-11 14:51:14	2023-03-11 14:51:14
556	manage setting payroll overtime	web	2023-03-11 14:51:14	2023-03-11 14:51:14
557	create setting payroll overtime	web	2023-03-11 14:51:14	2023-03-11 14:51:14
558	edit setting payroll overtime	web	2023-03-11 14:51:14	2023-03-11 14:51:14
559	delete setting payroll overtime	web	2023-03-11 14:51:14	2023-03-11 14:51:14
560	manage bpjs kesehatan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
561	create bpjs kesehatan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
562	edit bpjs kesehatan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
563	delete bpjs kesehatan	web	2023-03-11 14:51:14	2023-03-11 14:51:14
564	manage pph21	web	2023-03-11 14:51:14	2023-03-11 14:51:14
565	edit pph21	web	2023-03-11 14:51:14	2023-03-11 14:51:14
566	manage jht	web	2023-03-11 14:51:14	2023-03-11 14:51:14
567	edit jht	web	2023-03-11 14:51:14	2023-03-11 14:51:14
568	manage jkk	web	2023-03-11 14:51:14	2023-03-11 14:51:14
569	edit jkk	web	2023-03-11 14:51:14	2023-03-11 14:51:14
570	manage jkm	web	2023-03-11 14:51:14	2023-03-11 14:51:14
571	edit jkm	web	2023-03-11 14:51:14	2023-03-11 14:51:14
572	manage jp	web	2023-03-11 14:51:14	2023-03-11 14:51:14
573	edit jp	web	2023-03-11 14:51:14	2023-03-11 14:51:14
574	manage dayoff	web	2023-03-11 14:51:14	2023-03-11 14:51:14
575	create dayoff	web	2023-03-11 14:51:14	2023-03-11 14:51:14
576	edit dayoff	web	2023-03-11 14:51:14	2023-03-11 14:51:14
577	delete dayoff	web	2023-03-11 14:51:14	2023-03-11 14:51:14
578	manage company holiday	web	2023-03-11 14:51:14	2023-03-11 14:51:14
579	create company holiday	web	2023-03-11 14:51:14	2023-03-11 14:51:14
580	edit company holiday	web	2023-03-11 14:51:14	2023-03-11 14:51:14
581	delete company holiday	web	2023-03-11 14:51:14	2023-03-11 14:51:14
582	manage payslip code pin	web	2023-03-11 14:51:14	2023-03-11 14:51:14
583	edit payslip code pin	web	2023-03-11 14:51:14	2023-03-11 14:51:14
584	manage payslip checklist attendance summary	web	2023-03-11 14:51:14	2023-03-11 14:51:14
585	edit payslip checklist attendance summary	web	2023-03-11 14:51:14	2023-03-11 14:51:14
586	manage level approval	web	2023-03-11 14:51:14	2023-03-11 14:51:14
587	edit level approval	web	2023-03-11 14:51:14	2023-03-11 14:51:14
588	manage ptkp	web	2023-03-11 14:51:14	2023-03-11 14:51:14
589	edit ptkp	web	2023-03-11 14:51:14	2023-03-11 14:51:14
590	manage set ptkp	web	2023-03-11 14:51:14	2023-03-11 14:51:14
591	create set ptkp	web	2023-03-11 14:51:14	2023-03-11 14:51:14
592	edit set ptkp	web	2023-03-11 14:51:14	2023-03-11 14:51:14
593	delete set ptkp	web	2023-03-11 14:51:14	2023-03-11 14:51:14
594	show allowance	web	2023-03-11 14:51:14	2023-03-11 14:51:14
595	view history leave	web	2023-03-11 14:51:14	2023-03-11 14:51:14
\.


--
-- Name: permissions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('permissions_id_seq', 595, true);


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
-- Data for Name: project_users; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY project_users (id, project_id, user_id, invited_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: project_users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('project_users_id_seq', 1, false);


--
-- Data for Name: projects; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY projects (id, project_name, start_date, end_date, project_image, budget, estimated_hrs, client, description, status, tags, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: projects_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('projects_id_seq', 1, false);


--
-- Data for Name: ptkp; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY ptkp (id, status_name, ptkp_amount, created_by, created_at, updated_at) FROM stdin;
1	tk_0	54000000	2	\N	\N
2	tk_1	58500000	2	\N	\N
3	tk_2	63000000	2	\N	\N
4	tk_3	67500000	2	\N	\N
5	k_0	58500000	2	\N	\N
6	k_1	63000000	2	\N	\N
7	k_2	67500000	2	\N	\N
8	k_3	72000000	2	\N	\N
\.


--
-- Name: ptkp_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('ptkp_id_seq', 8, true);


--
-- Data for Name: reimburstment_options; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY reimburstment_options (id, name, created_by, created_at, updated_at) FROM stdin;
1	Uang Transport	2	2023-03-22 10:38:48	2023-03-22 10:38:48
\.


--
-- Name: reimburstment_options_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('reimburstment_options_id_seq', 1, true);


--
-- Data for Name: reimbursts; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY reimbursts (id, employee_id, reimburst_type_id, amount, created_by, created_at, updated_at) FROM stdin;
1	8	1	50000	2	2023-03-22 11:12:50	2023-03-22 11:12:50
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

SELECT pg_catalog.setval('req_shift_schedules_id_seq', 1, true);


--
-- Data for Name: request_shift_schedule_approvals; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY request_shift_schedule_approvals (id, req_shift_schedule_id, level, is_approver_company, approver_id, status, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: request_shift_schedule_approvals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('request_shift_schedule_approvals_id_seq', 3, true);


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
583	2
584	2
585	2
586	2
587	2
588	2
589	2
590	2
591	2
592	2
593	2
594	2
595	2
5	5
6	5
7	5
8	5
10	5
11	5
12	5
13	5
497	5
496	5
497	6
496	6
414	6
415	6
416	6
417	6
406	6
407	6
260	6
261	6
262	6
263	6
511	6
516	6
517	6
518	6
513	6
514	6
515	6
512	6
242	6
243	6
244	6
245	6
552	6
553	6
554	6
555	6
560	6
561	6
562	6
563	6
548	6
549	6
550	6
551	6
230	6
231	6
226	6
227	6
228	6
229	6
525	6
526	6
527	6
528	6
529	6
\.


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY roles (id, name, guard_name, created_at, updated_at, created_by) FROM stdin;
1	super admin	web	2023-03-11 14:51:14	2023-03-11 14:51:14	0
2	company	web	2023-03-11 14:51:14	2023-03-11 14:51:14	0
3	accountant	web	2023-03-11 14:51:14	2023-03-11 14:51:14	2
5	acc123	web	2023-03-13 10:41:51	2023-03-13 10:41:51	2
6	Finance	web	2023-03-22 10:22:33	2023-03-22 10:22:33	2
\.


--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('roles_id_seq', 6, true);


--
-- Data for Name: set_bpjstk; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY set_bpjstk (id, employee_id, bpjstk_name, created_by, created_at, updated_at) FROM stdin;
1	1	["JP"]	2	2023-03-11 15:05:49	2023-03-11 15:05:49
2	8	["JKK","JKM"]	2	2023-03-22 11:45:32	2023-03-22 11:45:32
3	6	["JHT","JKK"]	2	2023-03-22 11:47:23	2023-03-22 11:47:23
\.


--
-- Name: set_bpjstk_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('set_bpjstk_id_seq', 3, true);


--
-- Data for Name: set_ptkp; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY set_ptkp (id, employee_id, ptkp_name, created_by, created_at, updated_at) FROM stdin;
1	5	["tk_0"]	2	2023-03-22 10:31:11	2023-03-22 10:31:11
2	8	["tk_1"]	2	2023-03-22 11:44:53	2023-03-22 11:45:09
3	6	["tk_2"]	2	2023-03-22 11:46:27	2023-03-22 11:46:27
\.


--
-- Name: set_ptkp_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('set_ptkp_id_seq', 3, true);


--
-- Data for Name: settings; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY settings (id, name, value, created_by, created_at, updated_at) FROM stdin;
1	employee_prefix	#PDR	2	2023-03-11 14:51:14	2023-03-11 14:51:14
2	site_time_format	PDR	2	2023-03-11 14:51:14	2023-03-11 14:51:14
3	storage_setting	local	1	2023-03-11 14:51:14	2023-03-11 14:51:14
4	jht	{"type":"JHT","value":"5.7"}	2	2023-03-11 14:51:15	2023-03-11 14:51:15
5	jp	{"type":"JP","value":"3","maximum_limit_value":9077600}	2	2023-03-11 14:51:15	2023-03-11 14:51:15
6	pph21	[{"income":60000000,"percentage":5},{"income":250000000,"percentage":15},{"income":500000000,"percentage":25},{"income":5000000000,"percentage":30},{"income":5000000000000,"percentage":35}]	2	2023-03-11 14:51:15	2023-03-11 14:51:15
7	bpjs_tk	{"type":"Percentage","value":"5","maximum_salary":"12000000"}	2	2023-03-22 10:27:09	2023-03-22 10:29:35
\.


--
-- Name: settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('settings_id_seq', 7, true);


--
-- Data for Name: shift_schedules; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY shift_schedules (id, employee_id, req_shift_schedules_id, schedule_date, shift_id, status, is_dayoff, dayoff_type, description, is_active, created_by, created_at, updated_at) FROM stdin;
1	1	\N	2022-12-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
2	1	\N	2022-12-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
3	1	\N	2022-12-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
4	1	\N	2022-12-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
5	1	\N	2022-12-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
6	1	\N	2022-12-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
7	1	\N	2022-12-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
8	1	\N	2022-12-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
9	1	\N	2022-12-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
10	1	\N	2022-12-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
11	1	\N	2022-12-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
12	1	\N	2022-12-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
13	1	\N	2022-12-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
14	1	\N	2022-12-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
15	1	\N	2022-12-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
16	1	\N	2022-12-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
17	1	\N	2022-12-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
18	1	\N	2022-12-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
19	1	\N	2022-12-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
20	1	\N	2022-12-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
21	1	\N	2022-12-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
23	1	\N	2022-12-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
26	1	\N	2022-12-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
27	1	\N	2022-12-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
28	1	\N	2022-12-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
29	1	\N	2022-12-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
30	1	\N	2022-12-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
33	1	\N	2023-01-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
34	1	\N	2023-01-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
35	1	\N	2023-01-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
36	1	\N	2023-01-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
37	1	\N	2023-01-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
38	1	\N	2023-01-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
39	1	\N	2023-01-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
40	1	\N	2023-01-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
41	1	\N	2023-01-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
42	1	\N	2023-01-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
43	1	\N	2023-01-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
44	1	\N	2023-01-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
45	1	\N	2023-01-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
46	1	\N	2023-01-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
47	1	\N	2023-01-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
48	1	\N	2023-01-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
49	1	\N	2023-01-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
50	1	\N	2023-01-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
51	1	\N	2023-01-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
52	1	\N	2023-01-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
55	1	\N	2023-01-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
56	1	\N	2023-01-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
57	1	\N	2023-01-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
58	1	\N	2023-01-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
59	1	\N	2023-01-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
60	1	\N	2023-01-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
61	1	\N	2023-01-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
62	1	\N	2023-01-31	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
63	1	\N	2023-02-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
64	1	\N	2023-02-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
65	1	\N	2023-02-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
66	1	\N	2023-02-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
67	1	\N	2023-02-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
68	1	\N	2023-02-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
69	1	\N	2023-02-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
70	1	\N	2023-02-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
71	1	\N	2023-02-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
72	1	\N	2023-02-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
73	1	\N	2023-02-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
74	1	\N	2023-02-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
75	1	\N	2023-02-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
76	1	\N	2023-02-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
77	1	\N	2023-02-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
78	1	\N	2023-02-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
79	1	\N	2023-02-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
81	1	\N	2023-02-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
82	1	\N	2023-02-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
83	1	\N	2023-02-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
84	1	\N	2023-02-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
85	1	\N	2023-02-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
86	1	\N	2023-02-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
87	1	\N	2023-02-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
88	1	\N	2023-02-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
24	1	\N	2022-12-24	1	Approved	t	National Holiday	Malam Natal	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
25	1	\N	2022-12-25	1	Approved	t	National Holiday	Hari Raya Natal	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
32	1	\N	2023-01-01	1	Approved	t	National Holiday	Hari Tahun Baru	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
53	1	\N	2023-01-22	1	Approved	t	National Holiday	Tahun Baru Imlek	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
80	1	\N	2023-02-18	1	Approved	t	National Holiday	Isra Mikraj Nabi Muhammad	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
89	1	\N	2023-02-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
90	1	\N	2023-02-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
91	1	\N	2023-03-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
92	1	\N	2023-03-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
93	1	\N	2023-03-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
94	1	\N	2023-03-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
95	1	\N	2023-03-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
96	1	\N	2023-03-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
97	1	\N	2023-03-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
98	1	\N	2023-03-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
99	1	\N	2023-03-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
100	1	\N	2023-03-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
101	1	\N	2023-03-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
102	1	\N	2023-03-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
103	1	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
104	1	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
105	1	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
106	1	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
107	1	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
108	1	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
109	1	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
110	1	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
111	1	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
114	1	\N	2023-03-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
115	1	\N	2023-03-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
116	1	\N	2023-03-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
117	1	\N	2023-03-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
118	1	\N	2023-03-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
119	1	\N	2023-03-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
120	1	\N	2023-03-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
121	1	\N	2023-03-31	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
122	1	\N	2023-04-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
123	1	\N	2023-04-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
124	1	\N	2023-04-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
125	1	\N	2023-04-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
126	1	\N	2023-04-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
127	1	\N	2023-04-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
129	1	\N	2023-04-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
131	1	\N	2023-04-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
132	1	\N	2023-04-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
133	1	\N	2023-04-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
134	1	\N	2023-04-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
135	1	\N	2023-04-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
136	1	\N	2023-04-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
137	1	\N	2023-04-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
138	1	\N	2023-04-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
139	1	\N	2023-04-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
140	1	\N	2023-04-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
141	1	\N	2023-04-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
148	1	\N	2023-04-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
149	1	\N	2023-04-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
150	1	\N	2023-04-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
151	1	\N	2023-04-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
153	1	\N	2023-05-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
154	1	\N	2023-05-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
155	1	\N	2023-05-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
156	1	\N	2023-05-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
157	1	\N	2023-05-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
158	1	\N	2023-05-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
159	1	\N	2023-05-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
160	1	\N	2023-05-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
161	1	\N	2023-05-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
162	1	\N	2023-05-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
163	1	\N	2023-05-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
164	1	\N	2023-05-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
165	1	\N	2023-05-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
166	1	\N	2023-05-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
167	1	\N	2023-05-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
168	1	\N	2023-05-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
170	1	\N	2023-05-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
171	1	\N	2023-05-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
172	1	\N	2023-05-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
173	1	\N	2023-05-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
174	1	\N	2023-05-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
175	1	\N	2023-05-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
176	1	\N	2023-05-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
113	1	\N	2023-03-23	1	Approved	t	National Holiday	Cuti Bersama Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
130	1	\N	2023-04-09	1	Approved	t	National Holiday	Hari Paskah	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
142	1	\N	2023-04-21	1	Approved	t	National Holiday	Hari Kartini	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
144	1	\N	2023-04-23	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
145	1	\N	2023-04-24	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
147	1	\N	2023-04-26	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
152	1	\N	2023-05-01	1	Approved	t	National Holiday	Hari Buruh Internasional / Pekerja	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
177	1	\N	2023-05-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
178	1	\N	2023-05-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
179	1	\N	2023-05-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
180	1	\N	2023-05-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
181	1	\N	2023-05-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
182	1	\N	2023-05-31	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
185	1	\N	2023-06-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
187	1	\N	2023-06-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
188	1	\N	2023-06-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
189	1	\N	2023-06-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
190	1	\N	2023-06-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
191	1	\N	2023-06-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
192	1	\N	2023-06-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
193	1	\N	2023-06-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
194	1	\N	2023-06-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
195	1	\N	2023-06-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
196	1	\N	2023-06-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
197	1	\N	2023-06-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
198	1	\N	2023-06-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
199	1	\N	2023-06-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
200	1	\N	2023-06-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
201	1	\N	2023-06-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
202	1	\N	2023-06-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
203	1	\N	2023-06-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
204	1	\N	2023-06-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
205	1	\N	2023-06-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
206	1	\N	2023-06-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
207	1	\N	2023-06-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
208	1	\N	2023-06-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
209	1	\N	2023-06-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
210	1	\N	2023-06-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
212	1	\N	2023-06-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
213	1	\N	2023-07-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
214	1	\N	2023-07-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
215	1	\N	2023-07-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
216	1	\N	2023-07-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
217	1	\N	2023-07-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
218	1	\N	2023-07-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
219	1	\N	2023-07-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
220	1	\N	2023-07-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
221	1	\N	2023-07-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
222	1	\N	2023-07-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
223	1	\N	2023-07-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
224	1	\N	2023-07-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
225	1	\N	2023-07-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
226	1	\N	2023-07-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
227	1	\N	2023-07-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
228	1	\N	2023-07-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
229	1	\N	2023-07-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
230	1	\N	2023-07-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
232	1	\N	2023-07-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
233	1	\N	2023-07-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
234	1	\N	2023-07-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
235	1	\N	2023-07-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
236	1	\N	2023-07-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
237	1	\N	2023-07-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
238	1	\N	2023-07-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
239	1	\N	2023-07-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
240	1	\N	2023-07-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
241	1	\N	2023-07-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
242	1	\N	2023-07-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
243	1	\N	2023-07-31	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
244	1	\N	2023-08-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
245	1	\N	2023-08-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
246	1	\N	2023-08-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
247	1	\N	2023-08-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
248	1	\N	2023-08-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
249	1	\N	2023-08-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
250	1	\N	2023-08-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
251	1	\N	2023-08-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
252	1	\N	2023-08-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
253	1	\N	2023-08-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
254	1	\N	2023-08-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
255	1	\N	2023-08-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
256	1	\N	2023-08-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
257	1	\N	2023-08-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
258	1	\N	2023-08-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
259	1	\N	2023-08-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
261	1	\N	2023-08-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
262	1	\N	2023-08-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
263	1	\N	2023-08-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
264	1	\N	2023-08-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
184	1	\N	2023-06-02	1	Approved	t	National Holiday	Cuti Bersama Waisak	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
186	1	\N	2023-06-04	1	Approved	t	National Holiday	Hari Raya Waisak	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
231	1	\N	2023-07-19	1	Approved	t	National Holiday	Satu Muharam / Tahun Baru Hijriah	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
265	1	\N	2023-08-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
266	1	\N	2023-08-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
267	1	\N	2023-08-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
268	1	\N	2023-08-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
269	1	\N	2023-08-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
270	1	\N	2023-08-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
271	1	\N	2023-08-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
272	1	\N	2023-08-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
273	1	\N	2023-08-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
274	1	\N	2023-08-31	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
275	1	\N	2023-09-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
276	1	\N	2023-09-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
277	1	\N	2023-09-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
278	1	\N	2023-09-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
279	1	\N	2023-09-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
280	1	\N	2023-09-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
281	1	\N	2023-09-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
282	1	\N	2023-09-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
283	1	\N	2023-09-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
284	1	\N	2023-09-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
285	1	\N	2023-09-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
286	1	\N	2023-09-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
287	1	\N	2023-09-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
288	1	\N	2023-09-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
289	1	\N	2023-09-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
290	1	\N	2023-09-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
291	1	\N	2023-09-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
292	1	\N	2023-09-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
293	1	\N	2023-09-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
294	1	\N	2023-09-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
295	1	\N	2023-09-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
296	1	\N	2023-09-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
297	1	\N	2023-09-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
298	1	\N	2023-09-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
299	1	\N	2023-09-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
300	1	\N	2023-09-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
301	1	\N	2023-09-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
303	1	\N	2023-09-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
304	1	\N	2023-09-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
305	1	\N	2023-10-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
307	1	\N	2023-10-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
308	1	\N	2023-10-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
309	1	\N	2023-10-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
310	1	\N	2023-10-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
311	1	\N	2023-10-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
312	1	\N	2023-10-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
313	1	\N	2023-10-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
314	1	\N	2023-10-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
315	1	\N	2023-10-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
316	1	\N	2023-10-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
317	1	\N	2023-10-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
318	1	\N	2023-10-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
319	1	\N	2023-10-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
320	1	\N	2023-10-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
321	1	\N	2023-10-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
322	1	\N	2023-10-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
323	1	\N	2023-10-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
324	1	\N	2023-10-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
325	1	\N	2023-10-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
326	1	\N	2023-10-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
327	1	\N	2023-10-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
328	1	\N	2023-10-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
329	1	\N	2023-10-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
330	1	\N	2023-10-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
331	1	\N	2023-10-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
332	1	\N	2023-10-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
333	1	\N	2023-10-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
334	1	\N	2023-10-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
335	1	\N	2023-10-31	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
336	1	\N	2023-11-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
337	1	\N	2023-11-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
338	1	\N	2023-11-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
339	1	\N	2023-11-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
340	1	\N	2023-11-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
341	1	\N	2023-11-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
342	1	\N	2023-11-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
343	1	\N	2023-11-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
344	1	\N	2023-11-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
345	1	\N	2023-11-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
346	1	\N	2023-11-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
348	1	\N	2023-11-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
349	1	\N	2023-11-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
350	1	\N	2023-11-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
351	1	\N	2023-11-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
352	1	\N	2023-11-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
306	1	\N	2023-10-02	1	Approved	t	National Holiday	Hari Batik	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
347	1	\N	2023-11-12	1	Approved	t	National Holiday	Hari Ayah	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
353	1	\N	2023-11-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
354	1	\N	2023-11-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
355	1	\N	2023-11-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
356	1	\N	2023-11-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
357	1	\N	2023-11-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
358	1	\N	2023-11-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
359	1	\N	2023-11-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
361	1	\N	2023-11-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
362	1	\N	2023-11-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
363	1	\N	2023-11-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
364	1	\N	2023-11-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
365	1	\N	2023-11-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
366	1	\N	2023-12-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
367	2	\N	2022-12-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
368	2	\N	2022-12-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
369	2	\N	2022-12-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
370	2	\N	2022-12-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
371	2	\N	2022-12-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
372	2	\N	2022-12-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
373	2	\N	2022-12-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
374	2	\N	2022-12-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
375	2	\N	2022-12-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
376	2	\N	2022-12-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
377	2	\N	2022-12-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
378	2	\N	2022-12-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
379	2	\N	2022-12-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
380	2	\N	2022-12-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
381	2	\N	2022-12-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
382	2	\N	2022-12-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
383	2	\N	2022-12-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
384	2	\N	2022-12-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
385	2	\N	2022-12-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
386	2	\N	2022-12-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
387	2	\N	2022-12-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
389	2	\N	2022-12-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
392	2	\N	2022-12-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
393	2	\N	2022-12-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
394	2	\N	2022-12-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
395	2	\N	2022-12-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
396	2	\N	2022-12-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
399	2	\N	2023-01-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
400	2	\N	2023-01-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
401	2	\N	2023-01-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
402	2	\N	2023-01-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
403	2	\N	2023-01-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
404	2	\N	2023-01-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
405	2	\N	2023-01-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
406	2	\N	2023-01-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
407	2	\N	2023-01-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
408	2	\N	2023-01-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
409	2	\N	2023-01-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
410	2	\N	2023-01-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
411	2	\N	2023-01-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
412	2	\N	2023-01-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
413	2	\N	2023-01-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
414	2	\N	2023-01-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
415	2	\N	2023-01-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
416	2	\N	2023-01-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
417	2	\N	2023-01-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
418	2	\N	2023-01-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
421	2	\N	2023-01-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
422	2	\N	2023-01-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
423	2	\N	2023-01-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
424	2	\N	2023-01-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
425	2	\N	2023-01-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
426	2	\N	2023-01-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
427	2	\N	2023-01-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
428	2	\N	2023-01-31	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
429	2	\N	2023-02-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
430	2	\N	2023-02-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
431	2	\N	2023-02-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
432	2	\N	2023-02-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
433	2	\N	2023-02-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
434	2	\N	2023-02-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
435	2	\N	2023-02-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
436	2	\N	2023-02-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
437	2	\N	2023-02-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
438	2	\N	2023-02-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
439	2	\N	2023-02-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
440	2	\N	2023-02-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
388	2	\N	2022-12-22	1	Approved	t	National Holiday	Hari Ibu	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
390	2	\N	2022-12-24	1	Approved	t	National Holiday	Malam Natal	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
397	2	\N	2022-12-31	1	Approved	t	National Holiday	Malam Tahun Baru	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
398	2	\N	2023-01-01	1	Approved	t	National Holiday	Hari Tahun Baru	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
420	2	\N	2023-01-23	1	Approved	t	National Holiday	Cuti Bersama Tahun Baru Imlek	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
441	2	\N	2023-02-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
442	2	\N	2023-02-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
443	2	\N	2023-02-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
444	2	\N	2023-02-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
445	2	\N	2023-02-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
447	2	\N	2023-02-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
448	2	\N	2023-02-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
449	2	\N	2023-02-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
450	2	\N	2023-02-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
451	2	\N	2023-02-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
452	2	\N	2023-02-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
453	2	\N	2023-02-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
454	2	\N	2023-02-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
455	2	\N	2023-02-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
456	2	\N	2023-02-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
457	2	\N	2023-03-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
458	2	\N	2023-03-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
459	2	\N	2023-03-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
460	2	\N	2023-03-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
461	2	\N	2023-03-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
462	2	\N	2023-03-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
463	2	\N	2023-03-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
464	2	\N	2023-03-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
465	2	\N	2023-03-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
466	2	\N	2023-03-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
467	2	\N	2023-03-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
468	2	\N	2023-03-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
469	2	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
470	2	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
471	2	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
472	2	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
473	2	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
474	2	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
475	2	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
476	2	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
477	2	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
480	2	\N	2023-03-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
481	2	\N	2023-03-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
482	2	\N	2023-03-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
483	2	\N	2023-03-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
484	2	\N	2023-03-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
485	2	\N	2023-03-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
486	2	\N	2023-03-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
487	2	\N	2023-03-31	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
488	2	\N	2023-04-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
489	2	\N	2023-04-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
490	2	\N	2023-04-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
491	2	\N	2023-04-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
492	2	\N	2023-04-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
493	2	\N	2023-04-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
495	2	\N	2023-04-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
497	2	\N	2023-04-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
498	2	\N	2023-04-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
499	2	\N	2023-04-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
500	2	\N	2023-04-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
501	2	\N	2023-04-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
502	2	\N	2023-04-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
503	2	\N	2023-04-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
504	2	\N	2023-04-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
505	2	\N	2023-04-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
506	2	\N	2023-04-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
507	2	\N	2023-04-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
514	2	\N	2023-04-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
515	2	\N	2023-04-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
516	2	\N	2023-04-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
517	2	\N	2023-04-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
519	2	\N	2023-05-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
520	2	\N	2023-05-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
521	2	\N	2023-05-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
522	2	\N	2023-05-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
523	2	\N	2023-05-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
524	2	\N	2023-05-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
525	2	\N	2023-05-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
526	2	\N	2023-05-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
527	2	\N	2023-05-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
528	2	\N	2023-05-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
478	2	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
494	2	\N	2023-04-07	1	Approved	t	National Holiday	Wafat Isa Almasih	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
496	2	\N	2023-04-09	1	Approved	t	National Holiday	Hari Paskah	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
508	2	\N	2023-04-21	1	Approved	t	National Holiday	Hari Kartini	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
510	2	\N	2023-04-23	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
511	2	\N	2023-04-24	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
513	2	\N	2023-04-26	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
518	2	\N	2023-05-01	1	Approved	t	National Holiday	Hari Buruh Internasional / Pekerja	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
529	2	\N	2023-05-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
530	2	\N	2023-05-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
531	2	\N	2023-05-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
532	2	\N	2023-05-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
533	2	\N	2023-05-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
534	2	\N	2023-05-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
536	2	\N	2023-05-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
537	2	\N	2023-05-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
538	2	\N	2023-05-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
539	2	\N	2023-05-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
540	2	\N	2023-05-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
541	2	\N	2023-05-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
542	2	\N	2023-05-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
543	2	\N	2023-05-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
544	2	\N	2023-05-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
545	2	\N	2023-05-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
546	2	\N	2023-05-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
547	2	\N	2023-05-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
548	2	\N	2023-05-31	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
551	2	\N	2023-06-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
553	2	\N	2023-06-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
554	2	\N	2023-06-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
555	2	\N	2023-06-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
556	2	\N	2023-06-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
557	2	\N	2023-06-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
558	2	\N	2023-06-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
559	2	\N	2023-06-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:14	2023-03-11 14:51:14
560	2	\N	2023-06-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
561	2	\N	2023-06-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
562	2	\N	2023-06-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
563	2	\N	2023-06-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
564	2	\N	2023-06-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
565	2	\N	2023-06-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
566	2	\N	2023-06-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
567	2	\N	2023-06-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
568	2	\N	2023-06-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
569	2	\N	2023-06-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
570	2	\N	2023-06-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
571	2	\N	2023-06-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
572	2	\N	2023-06-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
573	2	\N	2023-06-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
574	2	\N	2023-06-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
575	2	\N	2023-06-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
576	2	\N	2023-06-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
578	2	\N	2023-06-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
579	2	\N	2023-07-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
580	2	\N	2023-07-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
581	2	\N	2023-07-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
582	2	\N	2023-07-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
583	2	\N	2023-07-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
584	2	\N	2023-07-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
585	2	\N	2023-07-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
586	2	\N	2023-07-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
587	2	\N	2023-07-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
588	2	\N	2023-07-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
589	2	\N	2023-07-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
590	2	\N	2023-07-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
591	2	\N	2023-07-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
592	2	\N	2023-07-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
593	2	\N	2023-07-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
594	2	\N	2023-07-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
595	2	\N	2023-07-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
596	2	\N	2023-07-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
598	2	\N	2023-07-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
599	2	\N	2023-07-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
600	2	\N	2023-07-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
601	2	\N	2023-07-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
602	2	\N	2023-07-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
603	2	\N	2023-07-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
604	2	\N	2023-07-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
605	2	\N	2023-07-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
606	2	\N	2023-07-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
607	2	\N	2023-07-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
608	2	\N	2023-07-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
609	2	\N	2023-07-31	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
610	2	\N	2023-08-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
611	2	\N	2023-08-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
612	2	\N	2023-08-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
613	2	\N	2023-08-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
614	2	\N	2023-08-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
615	2	\N	2023-08-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
616	2	\N	2023-08-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
549	2	\N	2023-06-01	1	Approved	t	National Holiday	Hari Lahir Pancasila	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
552	2	\N	2023-06-04	1	Approved	t	National Holiday	Hari Raya Waisak	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
577	2	\N	2023-06-29	1	Approved	t	National Holiday	Idul Adha (Lebaran Haji)	t	2	2023-03-11 14:51:15	2023-03-13 08:54:33
617	2	\N	2023-08-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
618	2	\N	2023-08-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
619	2	\N	2023-08-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
620	2	\N	2023-08-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
621	2	\N	2023-08-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
622	2	\N	2023-08-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
623	2	\N	2023-08-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
624	2	\N	2023-08-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
625	2	\N	2023-08-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
627	2	\N	2023-08-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
628	2	\N	2023-08-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
629	2	\N	2023-08-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
630	2	\N	2023-08-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
631	2	\N	2023-08-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
632	2	\N	2023-08-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
633	2	\N	2023-08-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
634	2	\N	2023-08-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
635	2	\N	2023-08-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
636	2	\N	2023-08-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
637	2	\N	2023-08-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
638	2	\N	2023-08-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
639	2	\N	2023-08-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
640	2	\N	2023-08-31	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
641	2	\N	2023-09-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
642	2	\N	2023-09-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
643	2	\N	2023-09-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
644	2	\N	2023-09-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
645	2	\N	2023-09-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
646	2	\N	2023-09-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
647	2	\N	2023-09-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
648	2	\N	2023-09-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
649	2	\N	2023-09-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
650	2	\N	2023-09-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
651	2	\N	2023-09-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
652	2	\N	2023-09-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
653	2	\N	2023-09-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
654	2	\N	2023-09-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
655	2	\N	2023-09-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
656	2	\N	2023-09-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
657	2	\N	2023-09-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
658	2	\N	2023-09-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
659	2	\N	2023-09-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
660	2	\N	2023-09-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
661	2	\N	2023-09-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
662	2	\N	2023-09-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
663	2	\N	2023-09-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
664	2	\N	2023-09-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
665	2	\N	2023-09-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
666	2	\N	2023-09-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
667	2	\N	2023-09-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
669	2	\N	2023-09-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
670	2	\N	2023-09-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
671	2	\N	2023-10-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
673	2	\N	2023-10-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
674	2	\N	2023-10-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
675	2	\N	2023-10-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
676	2	\N	2023-10-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
677	2	\N	2023-10-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
678	2	\N	2023-10-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
679	2	\N	2023-10-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
680	2	\N	2023-10-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
681	2	\N	2023-10-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
682	2	\N	2023-10-12	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
683	2	\N	2023-10-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
684	2	\N	2023-10-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
685	2	\N	2023-10-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
686	2	\N	2023-10-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
687	2	\N	2023-10-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
688	2	\N	2023-10-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
689	2	\N	2023-10-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
690	2	\N	2023-10-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
691	2	\N	2023-10-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
692	2	\N	2023-10-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
693	2	\N	2023-10-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
694	2	\N	2023-10-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
695	2	\N	2023-10-25	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
696	2	\N	2023-10-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
697	2	\N	2023-10-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
698	2	\N	2023-10-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
699	2	\N	2023-10-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
700	2	\N	2023-10-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
701	2	\N	2023-10-31	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
702	2	\N	2023-11-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
703	2	\N	2023-11-02	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
704	2	\N	2023-11-03	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
668	2	\N	2023-09-28	1	Approved	t	National Holiday	Maulid Nabi Muhammad	t	2	2023-03-11 14:51:15	2023-03-13 08:54:33
672	2	\N	2023-10-02	1	Approved	t	National Holiday	Hari Batik	t	2	2023-03-11 14:51:15	2023-03-13 08:54:33
705	2	\N	2023-11-04	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
706	2	\N	2023-11-05	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
707	2	\N	2023-11-06	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
708	2	\N	2023-11-07	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
709	2	\N	2023-11-08	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
710	2	\N	2023-11-09	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
711	2	\N	2023-11-10	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
712	2	\N	2023-11-11	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
714	2	\N	2023-11-13	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
715	2	\N	2023-11-14	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
716	2	\N	2023-11-15	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
717	2	\N	2023-11-16	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
718	2	\N	2023-11-17	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
719	2	\N	2023-11-18	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
720	2	\N	2023-11-19	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
721	2	\N	2023-11-20	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
722	2	\N	2023-11-21	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
723	2	\N	2023-11-22	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
724	2	\N	2023-11-23	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
725	2	\N	2023-11-24	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
727	2	\N	2023-11-26	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
728	2	\N	2023-11-27	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
729	2	\N	2023-11-28	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
730	2	\N	2023-11-29	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
731	2	\N	2023-11-30	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
732	2	\N	2023-12-01	1	Approved	f	\N	\N	t	2	2023-03-11 14:51:15	2023-03-11 14:51:15
22	1	\N	2022-12-22	1	Approved	t	National Holiday	Hari Ibu	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
31	1	\N	2022-12-31	1	Approved	t	National Holiday	Malam Tahun Baru	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
54	1	\N	2023-01-23	1	Approved	t	National Holiday	Cuti Bersama Tahun Baru Imlek	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
112	1	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
128	1	\N	2023-04-07	1	Approved	t	National Holiday	Wafat Isa Almasih	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
143	1	\N	2023-04-22	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
146	1	\N	2023-04-25	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
169	1	\N	2023-05-18	1	Approved	t	National Holiday	Kenaikan Isa Al Masih	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
183	1	\N	2023-06-01	1	Approved	t	National Holiday	Hari Lahir Pancasila	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
211	1	\N	2023-06-29	1	Approved	t	National Holiday	Idul Adha (Lebaran Haji)	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
260	1	\N	2023-08-17	1	Approved	t	National Holiday	Hari Proklamasi Kemerdekaan R.I.	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
302	1	\N	2023-09-28	1	Approved	t	National Holiday	Maulid Nabi Muhammad	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
360	1	\N	2023-11-25	1	Approved	t	National Holiday	Hari Guru	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
391	2	\N	2022-12-25	1	Approved	t	National Holiday	Hari Raya Natal	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
419	2	\N	2023-01-22	1	Approved	t	National Holiday	Tahun Baru Imlek	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
446	2	\N	2023-02-18	1	Approved	t	National Holiday	Isra Mikraj Nabi Muhammad	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
479	2	\N	2023-03-23	1	Approved	t	National Holiday	Cuti Bersama Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
509	2	\N	2023-04-22	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
512	2	\N	2023-04-25	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
535	2	\N	2023-05-18	1	Approved	t	National Holiday	Kenaikan Isa Al Masih	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
550	2	\N	2023-06-02	1	Approved	t	National Holiday	Cuti Bersama Waisak	t	2	2023-03-11 14:51:14	2023-03-13 08:54:33
597	2	\N	2023-07-19	1	Approved	t	National Holiday	Satu Muharam / Tahun Baru Hijriah	t	2	2023-03-11 14:51:15	2023-03-13 08:54:33
626	2	\N	2023-08-17	1	Approved	t	National Holiday	Hari Proklamasi Kemerdekaan R.I.	t	2	2023-03-11 14:51:15	2023-03-13 08:54:33
713	2	\N	2023-11-12	1	Approved	t	National Holiday	Hari Ayah	t	2	2023-03-11 14:51:15	2023-03-13 08:54:33
726	2	\N	2023-11-25	1	Approved	t	National Holiday	Hari Guru	t	2	2023-03-11 14:51:15	2023-03-13 08:54:33
733	3	\N	2023-03-13	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
734	3	\N	2023-03-14	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
735	3	\N	2023-03-15	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
736	3	\N	2023-03-16	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
737	3	\N	2023-03-17	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
738	3	\N	2023-03-18	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
739	3	\N	2023-03-19	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
740	3	\N	2023-03-20	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
741	3	\N	2023-03-21	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
744	3	\N	2023-03-24	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
745	3	\N	2023-03-25	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
746	3	\N	2023-03-26	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
747	3	\N	2023-03-27	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
748	3	\N	2023-03-28	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
749	3	\N	2023-03-29	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
750	3	\N	2023-03-30	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
751	3	\N	2023-03-31	1	Approved	f	\N	\N	f	2	2023-03-13 10:20:05	2023-03-13 10:26:27
752	4	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
753	4	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
754	4	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
755	4	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
756	4	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
757	4	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
758	4	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
759	4	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
760	4	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
763	4	\N	2023-03-24	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
764	4	\N	2023-03-25	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
765	4	\N	2023-03-26	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
766	4	\N	2023-03-27	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
767	4	\N	2023-03-28	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
768	4	\N	2023-03-29	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
769	4	\N	2023-03-30	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
770	4	\N	2023-03-31	1	Approved	f	\N	\N	t	2	2023-03-13 10:36:47	2023-03-13 10:36:47
742	3	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	f	2	2023-03-13 10:20:05	2023-03-13 12:33:53
743	3	\N	2023-03-23	1	Approved	t	National Holiday	Cuti Bersama Hari Suci Nyepi (Tahun Baru Saka)	f	2	2023-03-13 10:20:05	2023-03-13 12:33:53
761	4	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-03-13 10:36:47	2023-03-13 12:33:53
762	4	\N	2023-03-23	1	Approved	t	National Holiday	Cuti Bersama Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-03-13 10:36:47	2023-03-13 12:33:53
771	5	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
772	5	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
773	5	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
774	5	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
775	5	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
776	5	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
777	5	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
778	5	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
779	5	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
782	5	\N	2023-03-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
783	5	\N	2023-03-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
784	5	\N	2023-03-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
785	5	\N	2023-03-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
786	5	\N	2023-03-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
787	5	\N	2023-03-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
788	5	\N	2023-03-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
789	5	\N	2023-03-31	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
790	5	\N	2023-04-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
791	5	\N	2023-04-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
792	5	\N	2023-04-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
793	5	\N	2023-04-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
794	5	\N	2023-04-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
795	5	\N	2023-04-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
797	5	\N	2023-04-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
799	5	\N	2023-04-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
800	5	\N	2023-04-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
801	5	\N	2023-04-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
802	5	\N	2023-04-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
803	5	\N	2023-04-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
804	5	\N	2023-04-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
805	5	\N	2023-04-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
806	5	\N	2023-04-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
807	5	\N	2023-04-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
808	5	\N	2023-04-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
809	5	\N	2023-04-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
816	5	\N	2023-04-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
817	5	\N	2023-04-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
818	5	\N	2023-04-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
819	5	\N	2023-04-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
821	5	\N	2023-05-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
822	5	\N	2023-05-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
780	5	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-03-13 18:52:39	2023-03-14 09:29:50
781	5	\N	2023-03-23	1	Approved	t	National Holiday	Cuti Bersama Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-03-13 18:52:39	2023-03-14 09:29:50
796	5	\N	2023-04-07	1	Approved	t	National Holiday	Wafat Isa Almasih	t	2	2023-03-13 18:52:39	2023-03-14 09:29:50
798	5	\N	2023-04-09	1	Approved	t	National Holiday	Hari Paskah	t	2	2023-03-13 18:52:39	2023-03-14 09:29:50
810	5	\N	2023-04-21	1	Approved	t	National Holiday	Hari Kartini	t	2	2023-03-13 18:52:39	2023-03-14 09:29:50
811	5	\N	2023-04-22	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-03-13 18:52:39	2023-03-14 09:29:50
812	5	\N	2023-04-23	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-03-13 18:52:39	2023-03-14 09:29:50
814	5	\N	2023-04-25	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
815	5	\N	2023-04-26	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
823	5	\N	2023-05-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
824	5	\N	2023-05-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
825	5	\N	2023-05-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
826	5	\N	2023-05-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
827	5	\N	2023-05-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
828	5	\N	2023-05-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
829	5	\N	2023-05-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
830	5	\N	2023-05-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
831	5	\N	2023-05-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
832	5	\N	2023-05-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
833	5	\N	2023-05-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
834	5	\N	2023-05-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
835	5	\N	2023-05-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
836	5	\N	2023-05-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
838	5	\N	2023-05-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
839	5	\N	2023-05-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
840	5	\N	2023-05-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
841	5	\N	2023-05-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
842	5	\N	2023-05-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
843	5	\N	2023-05-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
844	5	\N	2023-05-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
845	5	\N	2023-05-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
846	5	\N	2023-05-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
847	5	\N	2023-05-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
848	5	\N	2023-05-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
849	5	\N	2023-05-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
850	5	\N	2023-05-31	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
853	5	\N	2023-06-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
855	5	\N	2023-06-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
856	5	\N	2023-06-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
857	5	\N	2023-06-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
858	5	\N	2023-06-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
859	5	\N	2023-06-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
860	5	\N	2023-06-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
861	5	\N	2023-06-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
862	5	\N	2023-06-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
863	5	\N	2023-06-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
864	5	\N	2023-06-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
865	5	\N	2023-06-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
866	5	\N	2023-06-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
867	5	\N	2023-06-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
868	5	\N	2023-06-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
869	5	\N	2023-06-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
870	5	\N	2023-06-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
871	5	\N	2023-06-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
872	5	\N	2023-06-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
873	5	\N	2023-06-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
874	5	\N	2023-06-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
875	5	\N	2023-06-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
876	5	\N	2023-06-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
877	5	\N	2023-06-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
878	5	\N	2023-06-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
880	5	\N	2023-06-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
881	5	\N	2023-07-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
882	5	\N	2023-07-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
883	5	\N	2023-07-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
884	5	\N	2023-07-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
885	5	\N	2023-07-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
886	5	\N	2023-07-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
887	5	\N	2023-07-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
888	5	\N	2023-07-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
889	5	\N	2023-07-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
890	5	\N	2023-07-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
891	5	\N	2023-07-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
892	5	\N	2023-07-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
893	5	\N	2023-07-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
894	5	\N	2023-07-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
895	5	\N	2023-07-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
896	5	\N	2023-07-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
897	5	\N	2023-07-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
898	5	\N	2023-07-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
900	5	\N	2023-07-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
901	5	\N	2023-07-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
902	5	\N	2023-07-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
903	5	\N	2023-07-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
904	5	\N	2023-07-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
905	5	\N	2023-07-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
906	5	\N	2023-07-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
907	5	\N	2023-07-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
908	5	\N	2023-07-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
909	5	\N	2023-07-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
910	5	\N	2023-07-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
851	5	\N	2023-06-01	1	Approved	t	National Holiday	Hari Lahir Pancasila	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
854	5	\N	2023-06-04	1	Approved	t	National Holiday	Hari Raya Waisak	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
879	5	\N	2023-06-29	1	Approved	t	National Holiday	Idul Adha (Lebaran Haji)	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
911	5	\N	2023-07-31	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
912	5	\N	2023-08-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
913	5	\N	2023-08-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
914	5	\N	2023-08-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
915	5	\N	2023-08-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
916	5	\N	2023-08-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
917	5	\N	2023-08-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
918	5	\N	2023-08-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
919	5	\N	2023-08-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
920	5	\N	2023-08-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
921	5	\N	2023-08-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
922	5	\N	2023-08-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
923	5	\N	2023-08-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
924	5	\N	2023-08-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
925	5	\N	2023-08-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
926	5	\N	2023-08-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
927	5	\N	2023-08-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
929	5	\N	2023-08-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
930	5	\N	2023-08-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
931	5	\N	2023-08-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
932	5	\N	2023-08-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
933	5	\N	2023-08-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
934	5	\N	2023-08-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
935	5	\N	2023-08-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
936	5	\N	2023-08-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
937	5	\N	2023-08-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
938	5	\N	2023-08-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
939	5	\N	2023-08-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
940	5	\N	2023-08-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
941	5	\N	2023-08-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
942	5	\N	2023-08-31	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
943	5	\N	2023-09-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
944	5	\N	2023-09-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
945	5	\N	2023-09-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
946	5	\N	2023-09-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
947	5	\N	2023-09-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
948	5	\N	2023-09-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
949	5	\N	2023-09-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
950	5	\N	2023-09-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
951	5	\N	2023-09-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
952	5	\N	2023-09-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
953	5	\N	2023-09-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
954	5	\N	2023-09-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
955	5	\N	2023-09-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
956	5	\N	2023-09-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
957	5	\N	2023-09-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
958	5	\N	2023-09-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
959	5	\N	2023-09-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
960	5	\N	2023-09-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
961	5	\N	2023-09-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
962	5	\N	2023-09-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
963	5	\N	2023-09-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
964	5	\N	2023-09-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
965	5	\N	2023-09-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
966	5	\N	2023-09-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
967	5	\N	2023-09-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
968	5	\N	2023-09-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
969	5	\N	2023-09-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
971	5	\N	2023-09-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
972	5	\N	2023-09-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
973	5	\N	2023-10-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
975	5	\N	2023-10-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
976	5	\N	2023-10-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
977	5	\N	2023-10-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
978	5	\N	2023-10-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
979	5	\N	2023-10-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
980	5	\N	2023-10-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
981	5	\N	2023-10-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
982	5	\N	2023-10-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
983	5	\N	2023-10-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
984	5	\N	2023-10-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
985	5	\N	2023-10-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
986	5	\N	2023-10-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
987	5	\N	2023-10-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
988	5	\N	2023-10-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
989	5	\N	2023-10-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
990	5	\N	2023-10-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
991	5	\N	2023-10-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
992	5	\N	2023-10-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
993	5	\N	2023-10-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
994	5	\N	2023-10-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
995	5	\N	2023-10-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
996	5	\N	2023-10-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
997	5	\N	2023-10-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
998	5	\N	2023-10-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
970	5	\N	2023-09-28	1	Approved	t	National Holiday	Maulid Nabi Muhammad	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
974	5	\N	2023-10-02	1	Approved	t	National Holiday	Hari Batik	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
999	5	\N	2023-10-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1000	5	\N	2023-10-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1001	5	\N	2023-10-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1002	5	\N	2023-10-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1003	5	\N	2023-10-31	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1004	5	\N	2023-11-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1005	5	\N	2023-11-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1006	5	\N	2023-11-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1007	5	\N	2023-11-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1008	5	\N	2023-11-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1009	5	\N	2023-11-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1010	5	\N	2023-11-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1011	5	\N	2023-11-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1012	5	\N	2023-11-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1013	5	\N	2023-11-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1014	5	\N	2023-11-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1016	5	\N	2023-11-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1017	5	\N	2023-11-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1018	5	\N	2023-11-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1019	5	\N	2023-11-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1020	5	\N	2023-11-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1021	5	\N	2023-11-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1022	5	\N	2023-11-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1023	5	\N	2023-11-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1024	5	\N	2023-11-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1025	5	\N	2023-11-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1026	5	\N	2023-11-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1027	5	\N	2023-11-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1029	5	\N	2023-11-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1030	5	\N	2023-11-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1031	5	\N	2023-11-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1032	5	\N	2023-11-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1033	5	\N	2023-11-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1034	5	\N	2023-12-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1035	5	\N	2023-12-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1036	5	\N	2023-12-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1037	5	\N	2023-12-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1038	5	\N	2023-12-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1039	5	\N	2023-12-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1040	5	\N	2023-12-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1041	5	\N	2023-12-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1042	5	\N	2023-12-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1043	5	\N	2023-12-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1044	5	\N	2023-12-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1045	5	\N	2023-12-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1046	5	\N	2023-12-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1047	5	\N	2023-12-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1048	5	\N	2023-12-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1049	5	\N	2023-12-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1050	5	\N	2023-12-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1051	5	\N	2023-12-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1052	5	\N	2023-12-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1053	5	\N	2023-12-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1054	5	\N	2023-12-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1056	5	\N	2023-12-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1060	5	\N	2023-12-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1061	5	\N	2023-12-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1062	5	\N	2023-12-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1063	5	\N	2023-12-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1066	5	\N	2024-01-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1067	5	\N	2024-01-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1068	5	\N	2024-01-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1069	5	\N	2024-01-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1070	5	\N	2024-01-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1071	5	\N	2024-01-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1072	5	\N	2024-01-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1073	5	\N	2024-01-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1074	5	\N	2024-01-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1075	5	\N	2024-01-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1076	5	\N	2024-01-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1077	5	\N	2024-01-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1078	5	\N	2024-01-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1079	5	\N	2024-01-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1080	5	\N	2024-01-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1081	5	\N	2024-01-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1082	5	\N	2024-01-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1083	5	\N	2024-01-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1084	5	\N	2024-01-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1085	5	\N	2024-01-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1086	5	\N	2024-01-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1028	5	\N	2023-11-25	1	Approved	t	National Holiday	Hari Guru	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
1055	5	\N	2023-12-22	1	Approved	t	National Holiday	Hari Ibu	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
1058	5	\N	2023-12-25	1	Approved	t	National Holiday	Hari Raya Natal	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
1059	5	\N	2023-12-26	1	Approved	t	National Holiday	Cuti Bersama Natal (Hari Tinju)	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
1065	5	\N	2024-01-01	1	Approved	t	National Holiday	Hari Tahun Baru	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
1087	5	\N	2024-01-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1088	5	\N	2024-01-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1089	5	\N	2024-01-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1090	5	\N	2024-01-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1091	5	\N	2024-01-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1092	5	\N	2024-01-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1093	5	\N	2024-01-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1094	5	\N	2024-01-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1095	5	\N	2024-01-31	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1096	5	\N	2024-02-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1097	5	\N	2024-02-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1098	5	\N	2024-02-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1099	5	\N	2024-02-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1100	5	\N	2024-02-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:39	2023-03-13 18:52:39
1101	5	\N	2024-02-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1102	5	\N	2024-02-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1104	5	\N	2024-02-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1106	5	\N	2024-02-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1107	5	\N	2024-02-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1108	5	\N	2024-02-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1109	5	\N	2024-02-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1110	5	\N	2024-02-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1111	5	\N	2024-02-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1112	5	\N	2024-02-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1113	5	\N	2024-02-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1114	5	\N	2024-02-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1115	5	\N	2024-02-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1116	5	\N	2024-02-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1117	5	\N	2024-02-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1118	5	\N	2024-02-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1119	5	\N	2024-02-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1120	5	\N	2024-02-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1121	5	\N	2024-02-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1122	5	\N	2024-02-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1123	5	\N	2024-02-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1124	5	\N	2024-02-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1125	5	\N	2024-03-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1126	5	\N	2024-03-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1127	5	\N	2024-03-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1128	5	\N	2024-03-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1129	5	\N	2024-03-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1130	5	\N	2024-03-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1131	5	\N	2024-03-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1132	5	\N	2024-03-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1133	5	\N	2024-03-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1134	5	\N	2024-03-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1135	5	\N	2024-03-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1136	5	\N	2024-03-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1137	5	\N	2024-03-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:52:40	2023-03-13 18:52:40
1138	6	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1139	6	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1140	6	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1141	6	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1142	6	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1143	6	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1144	6	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1145	6	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1146	6	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1149	6	\N	2023-03-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1150	6	\N	2023-03-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1151	6	\N	2023-03-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1152	6	\N	2023-03-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1153	6	\N	2023-03-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1154	6	\N	2023-03-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1155	6	\N	2023-03-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1156	6	\N	2023-03-31	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1157	6	\N	2023-04-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1158	6	\N	2023-04-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1159	6	\N	2023-04-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1160	6	\N	2023-04-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1161	6	\N	2023-04-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1162	6	\N	2023-04-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1164	6	\N	2023-04-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1166	6	\N	2023-04-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1167	6	\N	2023-04-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1168	6	\N	2023-04-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1169	6	\N	2023-04-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1170	6	\N	2023-04-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1171	6	\N	2023-04-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1172	6	\N	2023-04-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1173	6	\N	2023-04-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1174	6	\N	2023-04-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1105	5	\N	2024-02-10	1	Approved	t	National Holiday	Tahun Baru Imlek	t	2	2023-03-13 18:52:40	2023-03-14 09:29:51
1148	6	\N	2023-03-23	1	Approved	t	National Holiday	Cuti Bersama Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1163	6	\N	2023-04-07	1	Approved	t	National Holiday	Wafat Isa Almasih	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1175	6	\N	2023-04-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1176	6	\N	2023-04-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1183	6	\N	2023-04-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1184	6	\N	2023-04-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1185	6	\N	2023-04-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1186	6	\N	2023-04-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1188	6	\N	2023-05-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1189	6	\N	2023-05-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1190	6	\N	2023-05-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1191	6	\N	2023-05-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1192	6	\N	2023-05-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1193	6	\N	2023-05-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1194	6	\N	2023-05-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1195	6	\N	2023-05-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1196	6	\N	2023-05-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1197	6	\N	2023-05-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1198	6	\N	2023-05-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1199	6	\N	2023-05-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1200	6	\N	2023-05-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1201	6	\N	2023-05-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1202	6	\N	2023-05-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1203	6	\N	2023-05-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1205	6	\N	2023-05-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1206	6	\N	2023-05-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1207	6	\N	2023-05-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1208	6	\N	2023-05-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1209	6	\N	2023-05-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1210	6	\N	2023-05-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1211	6	\N	2023-05-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1212	6	\N	2023-05-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1213	6	\N	2023-05-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1214	6	\N	2023-05-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1215	6	\N	2023-05-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1216	6	\N	2023-05-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1217	6	\N	2023-05-31	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1220	6	\N	2023-06-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1222	6	\N	2023-06-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1223	6	\N	2023-06-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1224	6	\N	2023-06-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1225	6	\N	2023-06-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1226	6	\N	2023-06-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1227	6	\N	2023-06-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1228	6	\N	2023-06-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1229	6	\N	2023-06-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1230	6	\N	2023-06-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1231	6	\N	2023-06-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1232	6	\N	2023-06-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1233	6	\N	2023-06-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1234	6	\N	2023-06-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1235	6	\N	2023-06-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1236	6	\N	2023-06-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1237	6	\N	2023-06-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1238	6	\N	2023-06-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1239	6	\N	2023-06-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1240	6	\N	2023-06-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1241	6	\N	2023-06-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1242	6	\N	2023-06-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1243	6	\N	2023-06-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1244	6	\N	2023-06-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1245	6	\N	2023-06-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1247	6	\N	2023-06-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1248	6	\N	2023-07-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1249	6	\N	2023-07-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1250	6	\N	2023-07-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1251	6	\N	2023-07-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1252	6	\N	2023-07-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1253	6	\N	2023-07-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1254	6	\N	2023-07-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1255	6	\N	2023-07-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1256	6	\N	2023-07-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1257	6	\N	2023-07-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1258	6	\N	2023-07-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1259	6	\N	2023-07-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1260	6	\N	2023-07-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1261	6	\N	2023-07-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1262	6	\N	2023-07-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1178	6	\N	2023-04-22	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1179	6	\N	2023-04-23	1	Approved	t	National Holiday	Hari Idul Fitri	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1181	6	\N	2023-04-25	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1182	6	\N	2023-04-26	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1204	6	\N	2023-05-18	1	Approved	t	National Holiday	Kenaikan Isa Al Masih	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1218	6	\N	2023-06-01	1	Approved	t	National Holiday	Hari Lahir Pancasila	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1221	6	\N	2023-06-04	1	Approved	t	National Holiday	Hari Raya Waisak	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1246	6	\N	2023-06-29	1	Approved	t	National Holiday	Idul Adha (Lebaran Haji)	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1263	6	\N	2023-07-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1264	6	\N	2023-07-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1265	6	\N	2023-07-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1267	6	\N	2023-07-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1268	6	\N	2023-07-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1269	6	\N	2023-07-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1270	6	\N	2023-07-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1271	6	\N	2023-07-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1272	6	\N	2023-07-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1273	6	\N	2023-07-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1274	6	\N	2023-07-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1275	6	\N	2023-07-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1276	6	\N	2023-07-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1277	6	\N	2023-07-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1278	6	\N	2023-07-31	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1279	6	\N	2023-08-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1280	6	\N	2023-08-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1281	6	\N	2023-08-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1282	6	\N	2023-08-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1283	6	\N	2023-08-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1284	6	\N	2023-08-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1285	6	\N	2023-08-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1286	6	\N	2023-08-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1287	6	\N	2023-08-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1288	6	\N	2023-08-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1289	6	\N	2023-08-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1290	6	\N	2023-08-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1291	6	\N	2023-08-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1292	6	\N	2023-08-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1293	6	\N	2023-08-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1294	6	\N	2023-08-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1296	6	\N	2023-08-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1297	6	\N	2023-08-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1298	6	\N	2023-08-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1299	6	\N	2023-08-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1300	6	\N	2023-08-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1301	6	\N	2023-08-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1302	6	\N	2023-08-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1303	6	\N	2023-08-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1304	6	\N	2023-08-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1305	6	\N	2023-08-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1306	6	\N	2023-08-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1307	6	\N	2023-08-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1308	6	\N	2023-08-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1309	6	\N	2023-08-31	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1310	6	\N	2023-09-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1311	6	\N	2023-09-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1312	6	\N	2023-09-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1313	6	\N	2023-09-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1314	6	\N	2023-09-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1315	6	\N	2023-09-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1316	6	\N	2023-09-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1317	6	\N	2023-09-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1318	6	\N	2023-09-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1319	6	\N	2023-09-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1320	6	\N	2023-09-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1321	6	\N	2023-09-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1322	6	\N	2023-09-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1323	6	\N	2023-09-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1324	6	\N	2023-09-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1325	6	\N	2023-09-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1326	6	\N	2023-09-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1327	6	\N	2023-09-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1328	6	\N	2023-09-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1329	6	\N	2023-09-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1330	6	\N	2023-09-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1331	6	\N	2023-09-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1332	6	\N	2023-09-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1333	6	\N	2023-09-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1334	6	\N	2023-09-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1335	6	\N	2023-09-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1336	6	\N	2023-09-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1338	6	\N	2023-09-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1339	6	\N	2023-09-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1340	6	\N	2023-10-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1342	6	\N	2023-10-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1343	6	\N	2023-10-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1344	6	\N	2023-10-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1345	6	\N	2023-10-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1346	6	\N	2023-10-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1347	6	\N	2023-10-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1348	6	\N	2023-10-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1349	6	\N	2023-10-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1350	6	\N	2023-10-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1295	6	\N	2023-08-17	1	Approved	t	National Holiday	Hari Proklamasi Kemerdekaan R.I.	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1341	6	\N	2023-10-02	1	Approved	t	National Holiday	Hari Batik	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1351	6	\N	2023-10-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1352	6	\N	2023-10-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1353	6	\N	2023-10-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1354	6	\N	2023-10-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1355	6	\N	2023-10-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1356	6	\N	2023-10-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1357	6	\N	2023-10-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1358	6	\N	2023-10-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1359	6	\N	2023-10-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1360	6	\N	2023-10-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1361	6	\N	2023-10-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1362	6	\N	2023-10-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1363	6	\N	2023-10-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1364	6	\N	2023-10-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1365	6	\N	2023-10-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1366	6	\N	2023-10-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1367	6	\N	2023-10-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1368	6	\N	2023-10-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1369	6	\N	2023-10-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1370	6	\N	2023-10-31	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1371	6	\N	2023-11-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1372	6	\N	2023-11-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1373	6	\N	2023-11-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1374	6	\N	2023-11-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1375	6	\N	2023-11-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1376	6	\N	2023-11-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1377	6	\N	2023-11-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1378	6	\N	2023-11-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1379	6	\N	2023-11-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1380	6	\N	2023-11-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1381	6	\N	2023-11-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1383	6	\N	2023-11-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1384	6	\N	2023-11-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1385	6	\N	2023-11-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1386	6	\N	2023-11-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1387	6	\N	2023-11-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1388	6	\N	2023-11-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1389	6	\N	2023-11-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1390	6	\N	2023-11-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1391	6	\N	2023-11-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1392	6	\N	2023-11-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1393	6	\N	2023-11-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1394	6	\N	2023-11-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1396	6	\N	2023-11-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1397	6	\N	2023-11-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1398	6	\N	2023-11-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1399	6	\N	2023-11-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1400	6	\N	2023-11-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1401	6	\N	2023-12-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1402	6	\N	2023-12-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1403	6	\N	2023-12-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1404	6	\N	2023-12-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1405	6	\N	2023-12-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1406	6	\N	2023-12-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1407	6	\N	2023-12-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1408	6	\N	2023-12-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1409	6	\N	2023-12-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1410	6	\N	2023-12-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1411	6	\N	2023-12-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1412	6	\N	2023-12-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1413	6	\N	2023-12-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1414	6	\N	2023-12-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1415	6	\N	2023-12-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1416	6	\N	2023-12-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1417	6	\N	2023-12-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1418	6	\N	2023-12-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1419	6	\N	2023-12-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1420	6	\N	2023-12-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1421	6	\N	2023-12-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1423	6	\N	2023-12-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1427	6	\N	2023-12-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1428	6	\N	2023-12-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1429	6	\N	2023-12-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1430	6	\N	2023-12-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1433	6	\N	2024-01-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1434	6	\N	2024-01-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1435	6	\N	2024-01-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1436	6	\N	2024-01-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1437	6	\N	2024-01-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1438	6	\N	2024-01-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1395	6	\N	2023-11-25	1	Approved	t	National Holiday	Hari Guru	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1422	6	\N	2023-12-22	1	Approved	t	National Holiday	Hari Ibu	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1425	6	\N	2023-12-25	1	Approved	t	National Holiday	Hari Raya Natal	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1426	6	\N	2023-12-26	1	Approved	t	National Holiday	Cuti Bersama Natal (Hari Tinju)	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1432	6	\N	2024-01-01	1	Approved	t	National Holiday	Hari Tahun Baru	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1439	6	\N	2024-01-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1440	6	\N	2024-01-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1441	6	\N	2024-01-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1442	6	\N	2024-01-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1443	6	\N	2024-01-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1444	6	\N	2024-01-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1445	6	\N	2024-01-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1446	6	\N	2024-01-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1447	6	\N	2024-01-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1448	6	\N	2024-01-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1449	6	\N	2024-01-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1450	6	\N	2024-01-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1451	6	\N	2024-01-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1452	6	\N	2024-01-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1453	6	\N	2024-01-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1454	6	\N	2024-01-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1455	6	\N	2024-01-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1456	6	\N	2024-01-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1457	6	\N	2024-01-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1458	6	\N	2024-01-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1459	6	\N	2024-01-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1460	6	\N	2024-01-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1461	6	\N	2024-01-30	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1462	6	\N	2024-01-31	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1463	6	\N	2024-02-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1464	6	\N	2024-02-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1465	6	\N	2024-02-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1466	6	\N	2024-02-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1467	6	\N	2024-02-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1468	6	\N	2024-02-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1469	6	\N	2024-02-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1471	6	\N	2024-02-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1473	6	\N	2024-02-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1474	6	\N	2024-02-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1475	6	\N	2024-02-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1476	6	\N	2024-02-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1477	6	\N	2024-02-15	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1478	6	\N	2024-02-16	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1479	6	\N	2024-02-17	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1480	6	\N	2024-02-18	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1481	6	\N	2024-02-19	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1482	6	\N	2024-02-20	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1483	6	\N	2024-02-21	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1484	6	\N	2024-02-22	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1485	6	\N	2024-02-23	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1486	6	\N	2024-02-24	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1487	6	\N	2024-02-25	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1488	6	\N	2024-02-26	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1489	6	\N	2024-02-27	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1490	6	\N	2024-02-28	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1491	6	\N	2024-02-29	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1492	6	\N	2024-03-01	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1493	6	\N	2024-03-02	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1494	6	\N	2024-03-03	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1495	6	\N	2024-03-04	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1496	6	\N	2024-03-05	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1497	6	\N	2024-03-06	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1498	6	\N	2024-03-07	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1499	6	\N	2024-03-08	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1500	6	\N	2024-03-09	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1501	6	\N	2024-03-10	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1502	6	\N	2024-03-11	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1503	6	\N	2024-03-12	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1504	6	\N	2024-03-13	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
1505	6	\N	2024-03-14	1	Approved	f	\N	\N	t	2	2023-03-13 18:56:43	2023-03-13 18:56:43
813	5	\N	2023-04-24	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
820	5	\N	2023-05-01	1	Approved	t	National Holiday	Hari Buruh Internasional / Pekerja	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
837	5	\N	2023-05-18	1	Approved	t	National Holiday	Kenaikan Isa Al Masih	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
852	5	\N	2023-06-02	1	Approved	t	National Holiday	Cuti Bersama Waisak	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
899	5	\N	2023-07-19	1	Approved	t	National Holiday	Satu Muharam / Tahun Baru Hijriah	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
928	5	\N	2023-08-17	1	Approved	t	National Holiday	Hari Proklamasi Kemerdekaan R.I.	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
1015	5	\N	2023-11-12	1	Approved	t	National Holiday	Hari Ayah	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
1057	5	\N	2023-12-24	1	Approved	t	National Holiday	Malam Natal	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
1064	5	\N	2023-12-31	1	Approved	t	National Holiday	Malam Tahun Baru	t	2	2023-03-13 18:52:39	2023-03-14 09:29:51
1103	5	\N	2024-02-08	1	Approved	t	National Holiday	Isra Mikraj Nabi Muhammad	t	2	2023-03-13 18:52:40	2023-03-14 09:29:51
1147	6	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1165	6	\N	2023-04-09	1	Approved	t	National Holiday	Hari Paskah	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1177	6	\N	2023-04-21	1	Approved	t	National Holiday	Hari Kartini	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1180	6	\N	2023-04-24	1	Approved	t	National Holiday	Cuti Bersama Idul Fitri	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1187	6	\N	2023-05-01	1	Approved	t	National Holiday	Hari Buruh Internasional / Pekerja	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1472	6	\N	2024-02-10	1	Approved	t	National Holiday	Tahun Baru Imlek	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1219	6	\N	2023-06-02	1	Approved	t	National Holiday	Cuti Bersama Waisak	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1266	6	\N	2023-07-19	1	Approved	t	National Holiday	Satu Muharam / Tahun Baru Hijriah	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1337	6	\N	2023-09-28	1	Approved	t	National Holiday	Maulid Nabi Muhammad	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1382	6	\N	2023-11-12	1	Approved	t	National Holiday	Hari Ayah	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1424	6	\N	2023-12-24	1	Approved	t	National Holiday	Malam Natal	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1431	6	\N	2023-12-31	1	Approved	t	National Holiday	Malam Tahun Baru	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1470	6	\N	2024-02-08	1	Approved	t	National Holiday	Isra Mikraj Nabi Muhammad	t	2	2023-03-13 18:56:43	2023-03-14 09:29:51
1506	7	\N	2022-10-01	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1508	7	\N	2022-10-03	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1509	7	\N	2022-10-04	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1510	7	\N	2022-10-05	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1511	7	\N	2022-10-06	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1512	7	\N	2022-10-07	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1514	7	\N	2022-10-09	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1515	7	\N	2022-10-10	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1516	7	\N	2022-10-11	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1517	7	\N	2022-10-12	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1518	7	\N	2022-10-13	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1519	7	\N	2022-10-14	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1520	7	\N	2022-10-15	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1521	7	\N	2022-10-16	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1522	7	\N	2022-10-17	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1523	7	\N	2022-10-18	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1524	7	\N	2022-10-19	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1525	7	\N	2022-10-20	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1526	7	\N	2022-10-21	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1527	7	\N	2022-10-22	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1528	7	\N	2022-10-23	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1530	7	\N	2022-10-25	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1531	7	\N	2022-10-26	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1532	7	\N	2022-10-27	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1533	7	\N	2022-10-28	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1534	7	\N	2022-10-29	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1535	7	\N	2022-10-30	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1536	7	\N	2022-10-31	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1537	7	\N	2022-11-01	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1538	7	\N	2022-11-02	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1539	7	\N	2022-11-03	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1540	7	\N	2022-11-04	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1541	7	\N	2022-11-05	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1542	7	\N	2022-11-06	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1543	7	\N	2022-11-07	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:24	2023-03-17 23:23:24
1544	7	\N	2022-11-08	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1545	7	\N	2022-11-09	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1546	7	\N	2022-11-10	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1547	7	\N	2022-11-11	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1549	7	\N	2022-11-13	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1550	7	\N	2022-11-14	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1551	7	\N	2022-11-15	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1552	7	\N	2022-11-16	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1553	7	\N	2022-11-17	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1554	7	\N	2022-11-18	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1555	7	\N	2022-11-19	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1556	7	\N	2022-11-20	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1557	7	\N	2022-11-21	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1558	7	\N	2022-11-22	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1559	7	\N	2022-11-23	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1560	7	\N	2022-11-24	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1562	7	\N	2022-11-26	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1563	7	\N	2022-11-27	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1564	7	\N	2022-11-28	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1565	7	\N	2022-11-29	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1566	7	\N	2022-11-30	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1567	7	\N	2022-12-01	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1568	7	\N	2022-12-02	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1569	7	\N	2022-12-03	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1570	7	\N	2022-12-04	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1571	7	\N	2022-12-05	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1572	7	\N	2022-12-06	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1573	7	\N	2022-12-07	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1574	7	\N	2022-12-08	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1575	7	\N	2022-12-09	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1576	7	\N	2022-12-10	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1577	7	\N	2022-12-11	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1578	7	\N	2022-12-12	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1579	7	\N	2022-12-13	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1580	7	\N	2022-12-14	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1581	7	\N	2022-12-15	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1582	7	\N	2022-12-16	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1583	7	\N	2022-12-17	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1584	7	\N	2022-12-18	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1529	7	\N	2022-10-24	1	Approved	t	National Holiday	Diwali	t	2	2023-03-17 23:23:24	2023-03-22 10:51:51
1548	7	\N	2022-11-12	1	Approved	t	National Holiday	Hari Ayah	t	2	2023-03-17 23:23:25	2023-03-22 10:51:51
1561	7	\N	2022-11-25	1	Approved	t	National Holiday	Hari Guru	t	2	2023-03-17 23:23:25	2023-03-22 10:51:51
1585	7	\N	2022-12-19	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1586	7	\N	2022-12-20	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1587	7	\N	2022-12-21	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1589	7	\N	2022-12-23	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1592	7	\N	2022-12-26	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1593	7	\N	2022-12-27	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1594	7	\N	2022-12-28	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1595	7	\N	2022-12-29	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1596	7	\N	2022-12-30	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1599	7	\N	2023-01-02	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1600	7	\N	2023-01-03	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1601	7	\N	2023-01-04	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1602	7	\N	2023-01-05	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1603	7	\N	2023-01-06	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1604	7	\N	2023-01-07	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1605	7	\N	2023-01-08	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1606	7	\N	2023-01-09	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1607	7	\N	2023-01-10	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1608	7	\N	2023-01-11	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1609	7	\N	2023-01-12	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1610	7	\N	2023-01-13	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1611	7	\N	2023-01-14	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1612	7	\N	2023-01-15	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1613	7	\N	2023-01-16	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1614	7	\N	2023-01-17	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1615	7	\N	2023-01-18	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1616	7	\N	2023-01-19	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1617	7	\N	2023-01-20	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1618	7	\N	2023-01-21	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1621	7	\N	2023-01-24	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1622	7	\N	2023-01-25	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1623	7	\N	2023-01-26	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1624	7	\N	2023-01-27	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1625	7	\N	2023-01-28	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1626	7	\N	2023-01-29	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1627	7	\N	2023-01-30	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1628	7	\N	2023-01-31	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1629	7	\N	2023-02-01	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1630	7	\N	2023-02-02	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1631	7	\N	2023-02-03	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1632	7	\N	2023-02-04	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1633	7	\N	2023-02-05	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1634	7	\N	2023-02-06	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1635	7	\N	2023-02-07	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1636	7	\N	2023-02-08	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1637	7	\N	2023-02-09	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1638	7	\N	2023-02-10	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1639	7	\N	2023-02-11	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1640	7	\N	2023-02-12	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1641	7	\N	2023-02-13	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1642	7	\N	2023-02-14	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1643	7	\N	2023-02-15	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1644	7	\N	2023-02-16	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1645	7	\N	2023-02-17	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1647	7	\N	2023-02-19	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1648	7	\N	2023-02-20	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1649	7	\N	2023-02-21	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1650	7	\N	2023-02-22	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1651	7	\N	2023-02-23	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1652	7	\N	2023-02-24	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1653	7	\N	2023-02-25	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1654	7	\N	2023-02-26	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1655	7	\N	2023-02-27	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1656	7	\N	2023-02-28	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1657	7	\N	2023-03-01	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1658	7	\N	2023-03-02	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1659	7	\N	2023-03-03	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1660	7	\N	2023-03-04	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1661	7	\N	2023-03-05	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1662	7	\N	2023-03-06	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1663	7	\N	2023-03-07	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1664	7	\N	2023-03-08	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1665	7	\N	2023-03-09	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1666	7	\N	2023-03-10	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1667	7	\N	2023-03-11	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1668	7	\N	2023-03-12	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1669	7	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1670	7	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1671	7	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1672	7	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1590	7	\N	2022-12-24	1	Approved	t	National Holiday	Malam Natal	t	2	2023-03-17 23:23:25	2023-03-22 10:51:51
1591	7	\N	2022-12-25	1	Approved	t	National Holiday	Hari Raya Natal	t	2	2023-03-17 23:23:25	2023-03-22 10:51:51
1598	7	\N	2023-01-01	1	Approved	t	National Holiday	Hari Tahun Baru	t	2	2023-03-17 23:23:25	2023-03-22 10:51:51
1619	7	\N	2023-01-22	1	Approved	t	National Holiday	Tahun Baru Imlek	t	2	2023-03-17 23:23:25	2023-03-22 10:51:51
1646	7	\N	2023-02-18	1	Approved	t	National Holiday	Isra Mikraj Nabi Muhammad	t	2	2023-03-17 23:23:25	2023-03-22 10:51:51
1673	7	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-03-17 23:23:25	2023-03-17 23:23:25
1674	8	\N	2023-03-01	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1675	8	\N	2023-03-02	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1676	8	\N	2023-03-03	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1677	8	\N	2023-03-04	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1678	8	\N	2023-03-05	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1679	8	\N	2023-03-06	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1680	8	\N	2023-03-07	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1681	8	\N	2023-03-08	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1682	8	\N	2023-03-09	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1683	8	\N	2023-03-10	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1684	8	\N	2023-03-11	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1685	8	\N	2023-03-12	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1686	8	\N	2023-03-13	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1687	8	\N	2023-03-14	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1688	8	\N	2023-03-15	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1689	8	\N	2023-03-16	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1690	8	\N	2023-03-17	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1691	8	\N	2023-03-18	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1692	8	\N	2023-03-19	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1693	8	\N	2023-03-20	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1694	8	\N	2023-03-21	1	Approved	f	\N	\N	t	2	2023-03-22 10:23:31	2023-03-22 10:23:31
1507	7	\N	2022-10-02	1	Approved	t	National Holiday	Hari Batik	t	2	2023-03-17 23:23:24	2023-03-22 10:51:51
1513	7	\N	2022-10-08	1	Approved	t	National Holiday	Maulid Nabi Muhammad	t	2	2023-03-17 23:23:24	2023-03-22 10:51:51
1588	7	\N	2022-12-22	1	Approved	t	National Holiday	Hari Ibu	t	2	2023-03-17 23:23:25	2023-03-22 10:51:51
1597	7	\N	2022-12-31	1	Approved	t	National Holiday	Malam Tahun Baru	t	2	2023-03-17 23:23:25	2023-03-22 10:51:51
1620	7	\N	2023-01-23	1	Approved	t	National Holiday	Cuti Bersama Tahun Baru Imlek	t	2	2023-03-17 23:23:25	2023-03-22 10:51:51
1695	8	\N	2023-03-22	1	Approved	t	National Holiday	Hari Suci Nyepi (Tahun Baru Saka)	t	2	2023-03-22 10:23:31	2023-03-22 10:51:51
\.


--
-- Name: shift_schedules_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('shift_schedules_id_seq', 1815, true);


--
-- Data for Name: shift_types; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY shift_types (id, day_type_id, name, start_time, end_time, is_wfh, created_by, created_at, updated_at) FROM stdin;
1	1	Reguler	08:00:00	16:00:00	f	2	2023-03-11 14:51:15	2023-03-11 14:51:15
2	1	Shift 1	08:00:00	16:00:00	f	2	2023-03-22 10:37:25	2023-03-22 10:37:25
\.


--
-- Name: shift_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('shift_types_id_seq', 2, true);


--
-- Data for Name: timesheet_approvals; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY timesheet_approvals (id, timesheet_id, level, is_approver_company, approver_id, status, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Name: timesheet_approvals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('timesheet_approvals_id_seq', 1, false);


--
-- Data for Name: timesheets; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY timesheets (id, employee_id, project_stage, start_date, end_date, start_time, end_time, duration, task_or_project, activity, client_company, label_project, file_attachment, remark, support, status, rejected_reason, attachment_reject, created_by, created_at, updated_at) FROM stdin;
1	5	Dinas Luar Kota	2023-03-22	2023-03-23	\N	\N	\N	maintenance server	maintenance	PT asd	maintain	storage/1679457263_New Timeline Pehadir Revisi 6 mar.xlsx	aaa	maintain	Approved	\N	\N	2	2023-03-22 10:54:24	2023-03-22 10:54:24
\.


--
-- Name: timesheets_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('timesheets_id_seq', 1, true);


--
-- Data for Name: travel; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY travel (id, employee_id, start_date, end_date, purpose_of_visit, place_of_visit, description, status, rejected_reason, attachment_reject, created_by, created_at, updated_at) FROM stdin;
1	4	2023-03-22	2023-03-22	Workshop	Indonesia	aaa	Approved	\N	\N	2	2023-03-22 10:56:14	2023-03-22 10:56:14
\.


--
-- Name: travel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('travel_id_seq', 1, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: pehadirm
--

COPY users (id, branch_id, name, email, email_verified_at, password, plan, plan_expire_date, type, avatar, lang, created_by, default_pipeline, delete_status, is_active, last_login_at, remember_token, created_at, updated_at) FROM stdin;
1	\N	Super Admin	superadmin@example.com	\N	$2y$10$O9aPc/tY07dNTaN9vOEtcurtDruSHjMPPoi0m7/68CK7f/UnBKJjm	\N	\N	super admin		en	0	\N	1	1	\N	\N	2023-03-11 14:51:14	2023-03-11 14:51:14
4	\N	accountant2	accountant2@pehadir.com	\N	$2y$10$k0dkySDfJr1VbRoSllMUy.EUxU5guh.9nU6RfRqFzR3Ca.sjC0o1u	\N	\N	accountant		en	2	1	1	1	\N	\N	2023-03-11 14:51:14	2023-03-11 14:51:14
3	\N	accountant	accountant@example.com	\N	$2y$10$Xxg30ybJEJpFemUXcS5wZ.d65VrIwmW9.IgtTQ3GK.QPSJDQZa5K6	\N	\N	accountant		en	2	1	1	1	\N	\N	2023-03-11 14:51:14	2023-03-11 15:06:03
9	1	JoyJoy	JoyJoy@pehadir.com	\N	$2y$10$hsZTFfUhqmiXK5cfGpsMn.SDKITeOz30TrLpHk/DQb7DWVkZTFjFy	\N	\N	accountant	\N	en	2	\N	1	1	2023-03-18 02:17:59	\N	2023-03-17 23:23:24	2023-03-18 02:17:59
6	1	acc123	acc123@karyaindah.com	\N	$2y$10$WEaGF1eunh9eHbIKztqBluRVGurv7Qqn0wjP6XIRH0yDPWtklmBXG	\N	\N	accountant	\N	en	2	\N	1	1	\N	\N	2023-03-13 10:36:47	2023-03-13 10:36:47
7	1	Suali	suali@gmail.com	\N	$2y$10$a.K0W7pfuFwRa0TKzlr3F.hLMBgVDXzxpPjy81UUGId87eR6Fecai	\N	\N	accountant	\N	en	2	\N	1	1	\N	\N	2023-03-13 18:52:39	2023-03-13 18:52:39
8	1	FIKRI KURNIAWAN	fikri@pehadir.com	\N	$2y$10$NLkpPYpX7OqlqE9oPJjmi.GhG89eWJLdDohm0eD5Yx1VOgRm/Fkmy	\N	\N	acc123	\N	en	2	\N	1	1	\N	\N	2023-03-13 18:56:43	2023-03-13 18:58:10
10	1	george	george@pehadir.com	\N	$2y$10$/344laxqHnQKOu.Ln6X0lOpE8ITuh9YkZCht5Q/Hy3JGUg8IpU8k.	\N	\N	Finance	\N	en	2	\N	1	1	\N	\N	2023-03-22 10:23:31	2023-03-25 19:51:41
2	\N	company	company@pehadir.com	\N	$2y$10$gyaMrC9zLd8BRFblJXRpFOrwezXqxk6ySfK2EauM1VzhfnkqKXkAa	1	\N	company		en	1	1	1	1	2023-03-29 19:14:22	\N	2023-03-11 14:51:14	2023-03-29 19:14:22
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pehadirm
--

SELECT pg_catalog.setval('users_id_seq', 12, true);


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


--
-- Name: loans_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE loans_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE loans_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE loans_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE loans_id_seq TO pehadirm_pehadir_user;


--
-- Name: migrations; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE migrations FROM PUBLIC;
REVOKE ALL ON TABLE migrations FROM pehadirm;
GRANT ALL ON TABLE migrations TO pehadirm;
GRANT ALL ON TABLE migrations TO pehadirm_pehadir_user;


--
-- Name: model_has_permissions; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE model_has_permissions FROM PUBLIC;
REVOKE ALL ON TABLE model_has_permissions FROM pehadirm;
GRANT ALL ON TABLE model_has_permissions TO pehadirm;
GRANT ALL ON TABLE model_has_permissions TO pehadirm_pehadir_user;


--
-- Name: model_has_roles; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE model_has_roles FROM PUBLIC;
REVOKE ALL ON TABLE model_has_roles FROM pehadirm;
GRANT ALL ON TABLE model_has_roles TO pehadirm;
GRANT ALL ON TABLE model_has_roles TO pehadirm_pehadir_user;


--
-- Name: on_duty_approvals; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE on_duty_approvals FROM PUBLIC;
REVOKE ALL ON TABLE on_duty_approvals FROM pehadirm;
GRANT ALL ON TABLE on_duty_approvals TO pehadirm;
GRANT ALL ON TABLE on_duty_approvals TO pehadirm_pehadir_user;


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


--
-- Name: pay_slips; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE pay_slips FROM PUBLIC;
REVOKE ALL ON TABLE pay_slips FROM pehadirm;
GRANT ALL ON TABLE pay_slips TO pehadirm;
GRANT ALL ON TABLE pay_slips TO pehadirm_pehadir_user;


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


--
-- Name: roles; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON TABLE roles FROM PUBLIC;
REVOKE ALL ON TABLE roles FROM pehadirm;
GRANT ALL ON TABLE roles TO pehadirm;
GRANT ALL ON TABLE roles TO pehadirm_pehadir_user;


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


--
-- Name: users_id_seq; Type: ACL; Schema: public; Owner: pehadirm
--

REVOKE ALL ON SEQUENCE users_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE users_id_seq FROM pehadirm;
GRANT ALL ON SEQUENCE users_id_seq TO pehadirm;
GRANT SELECT,USAGE ON SEQUENCE users_id_seq TO pehadirm_pehadir_user;


--
-- PostgreSQL database dump complete
--

