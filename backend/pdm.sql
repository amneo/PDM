-- SQL Manager Lite for PostgreSQL 5.9.5.52424
-- ---------------------------------------
-- Host      : 192.168.100.70
-- Database  : pdm
-- Version   : PostgreSQL 9.6.13 on x86_64-pc-linux-gnu (Debian 9.6.13-1.pgdg90+1), compiled by gcc (Debian 6.3.0-18+deb9u1) 6.3.0 20170516, 64-bit



SET search_path = public, pg_catalog;
DROP TRIGGER IF EXISTS transaction_details_project ON public.transaction_details;
DROP TABLE IF EXISTS public.document_log;
DROP FUNCTION IF EXISTS public.func_transaction_details_project ();
DROP TABLE IF EXISTS public.transaction_details;
DROP TABLE IF EXISTS public.xmit_details;
DROP TABLE IF EXISTS public.user_dtls;
DROP TABLE IF EXISTS public.userlevelpermissions;
DROP TABLE IF EXISTS public.userlevels;
DROP TABLE IF EXISTS public.document_system;
DROP FUNCTION IF EXISTS public.om_func_01 ();
DROP TABLE IF EXISTS public.f_version;
DROP SEQUENCE IF EXISTS public.app_version_sequence_no_seq;
DROP TABLE IF EXISTS public.approval_details;
DROP TABLE IF EXISTS public.document_details;
DROP TABLE IF EXISTS public.transmit_details;
DROP TABLE IF EXISTS public.audittrail;
DROP TABLE IF EXISTS public.inbox;
DROP TABLE IF EXISTS public.distribution_details;
DROP TABLE IF EXISTS public.project_details;
DROP TABLE IF EXISTS public.app_version;
SET check_function_bodies = false;
--
-- Definition for function om_func_01 (OID = 25697) : 
--
CREATE FUNCTION public.om_func_01 (
)
RETURNS varchar
AS 
$body$
DECLARE
--Frontend_Version VARCHAR;
--Backend_Version VARCHAR;
--Release_Date DATE;
f_version app_version%ROWTYPE; 
BEGIN
SELECT INTO f_version * FROM app_version order by sequence_no desc limit 1;
--Frontend_Version := f_version.frontend_version;
--Backend_Version := f_version.backend_version;
--Release_Date := f_version.release_date;
if f_version.backend_version ISNULL THEN
 RAISE EXCEPTION 'Error code psi_ravan_001 could not get latest version' ;
END IF;
RETURN 'Frontend Version: '  || f_version.frontend_version || ' Backend Version: ' || f_version.backend_version || ' Release Date: ' || f_version.release_date  ;
--RETURN f_version.backend_version ;
END;
$body$
LANGUAGE plpgsql;
--
-- Definition for function func_transaction_details_project (OID = 61778) : 
--
CREATE FUNCTION public.func_transaction_details_project (
)
RETURNS trigger
AS 
$body$
DECLARE
v_project_name VARCHAR;
v_document_tittle VARCHAR;
v_firelink_doc_no VARCHAR ;
BEGIN
v_firelink_doc_no := NEW.firelink_doc_no;
select project_name,document_tittle into v_project_name , v_document_tittle from document_details where firelink_doc_no = v_firelink_doc_no ;
NEW.project_name := v_project_name;
NEW.document_tittle := v_document_tittle;
/*IF v_project_name = NULL
RAISE EXCEPTION Contact Admin with code sai_ravan_001;
END if;*/
RETURN NEW;
END;
$body$
LANGUAGE plpgsql;
--
-- Structure for table app_version (OID = 25384) : 
--
CREATE TABLE public.app_version (
    sequence_no integer DEFAULT nextval(('public.app_version_sequence_no_seq'::text)::regclass) NOT NULL,
    frontend_version varchar NOT NULL,
    backend_version varchar NOT NULL,
    release_date date NOT NULL,
    posted_date timestamp without time zone DEFAULT now(),
    remarks text
)
WITH (oids = false);
--
-- Structure for table project_details (OID = 25427) : 
--
CREATE TABLE public.project_details (
    project_id serial NOT NULL,
    project_name varchar NOT NULL,
    project_our_client varchar NOT NULL,
    project_end_user varchar NOT NULL,
    project_sales_engg varchar NOT NULL,
    project_distribution varchar NOT NULL,
    project_transmittal varchar NOT NULL,
    order_number varchar NOT NULL
)
WITH (oids = true);
--
-- Structure for table distribution_details (OID = 25440) : 
--
CREATE TABLE public.distribution_details (
    distribution_id serial NOT NULL,
    "to_Name" varchar NOT NULL,
    email_address varchar NOT NULL,
    project_name varchar NOT NULL,
    distribution_valid boolean DEFAULT true NOT NULL
)
WITH (oids = true);
--
-- Structure for table inbox (OID = 25452) : 
--
CREATE TABLE public.inbox (
    inbox_id serial NOT NULL,
    "from" varchar NOT NULL,
    project_name varchar NOT NULL,
    client_send_to varchar NOT NULL,
    mode_send varchar NOT NULL,
    remarks varchar NOT NULL,
    document_link varchar NOT NULL,
    native_file_link varchar NOT NULL
)
WITH (oids = true);
--
-- Structure for table audittrail (OID = 25480) : 
--
CREATE TABLE public.audittrail (
    id serial NOT NULL,
    datetime timestamp without time zone NOT NULL,
    script varchar(255),
    "user" varchar(255),
    action varchar(255),
    "table" varchar(255),
    field varchar(255),
    keyvalue text,
    oldvalue text,
    newvalue text
)
WITH (oids = false);
--
-- Structure for table transmit_details (OID = 25559) : 
--
CREATE TABLE public.transmit_details (
    transmit_id bigserial NOT NULL,
    transmittal_no varchar NOT NULL,
    project_name varchar NOT NULL,
    delivery_location varchar,
    addressed_to varchar,
    remarks varchar,
    ack_rcvd boolean DEFAULT false,
    ack_document varchar DEFAULT 'AWAITED'::character varying,
    transmital_date timestamp(6) without time zone DEFAULT now()
)
WITH (oids = false);
--
-- Structure for table document_details (OID = 25615) : 
--
CREATE TABLE public.document_details (
    document_sequence serial NOT NULL,
    firelink_doc_no varchar NOT NULL,
    project_name varchar NOT NULL,
    client_doc_no varchar NOT NULL,
    document_tittle varchar NOT NULL,
    project_system varchar NOT NULL,
    create_date timestamp without time zone DEFAULT now(),
    planned_date date NOT NULL,
    document_type varchar NOT NULL,
    expiry_date date
)
WITH (oids = true);
--
-- Structure for table approval_details (OID = 25632) : 
--
CREATE TABLE public.approval_details (
    id serial NOT NULL,
    short_code varchar NOT NULL,
    "Description" text NOT NULL,
    document_status varchar
)
WITH (oids = false);
--
-- Definition for sequence app_version_sequence_no_seq (OID = 25643) : 
--
CREATE SEQUENCE public.app_version_sequence_no_seq
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 2147483647
    NO MINVALUE
    CACHE 1;
--
-- Structure for table f_version (OID = 25684) : 
--
CREATE TABLE public.f_version (
    sequence_no integer,
    frontend_version varchar,
    backend_version varchar,
    release_date date,
    posted_date timestamp without time zone DEFAULT now(),
    remarks text
)
WITH (oids = false);
--
-- Structure for table document_system (OID = 25741) : 
--
CREATE TABLE public.document_system (
    type_id serial NOT NULL,
    system_name varchar NOT NULL,
    system_group varchar NOT NULL
)
WITH (oids = false);
--
-- Structure for table userlevels (OID = 25780) : 
--
CREATE TABLE public.userlevels (
    userlevelid integer NOT NULL,
    userlevelname varchar(255) NOT NULL
)
WITH (oids = false);
--
-- Structure for table userlevelpermissions (OID = 25785) : 
--
CREATE TABLE public.userlevelpermissions (
    userlevelid integer NOT NULL,
    tablename varchar(255) NOT NULL,
    permission integer NOT NULL
)
WITH (oids = false);
--
-- Structure for table user_dtls (OID = 33912) : 
--
CREATE TABLE public.user_dtls (
    user_id serial NOT NULL,
    name varchar,
    username varchar,
    password varchar,
    create_login timestamp(0) without time zone DEFAULT now(),
    account_valid boolean DEFAULT false,
    last_login date,
    email_addreess varchar,
    "UserLevel" integer DEFAULT 10,
    history varchar,
    reports_to integer
)
WITH (oids = false);
--
-- Structure for table xmit_details (OID = 53124) : 
--
CREATE TABLE public.xmit_details (
    xmit_id bigserial NOT NULL,
    xmit_mode varchar
)
WITH (oids = false);
--
-- Structure for table transaction_details (OID = 60675) : 
--
CREATE TABLE public.transaction_details (
    document_sequence serial NOT NULL,
    firelink_doc_no varchar NOT NULL,
    project_name varchar,
    document_tittle varchar,
    submit_no integer NOT NULL,
    revision_no varchar NOT NULL,
    transmit_no varchar NOT NULL,
    transmit_date date NOT NULL,
    direction varchar NOT NULL,
    approval_status varchar DEFAULT 'Planning'::character varying NOT NULL,
    document_link varchar NOT NULL,
    transaction_date timestamp without time zone DEFAULT now(),
    document_native text NOT NULL,
    username varchar,
    expiry_date date DEFAULT (('now'::text)::date + 3)
)
WITH (oids = true);
--
-- Structure for table document_log (OID = 61831) : 
--
CREATE TABLE public.document_log (
    log_id bigserial NOT NULL,
    firelink_doc_no varchar NOT NULL,
    project_name varchar NOT NULL,
    document_tittle varchar NOT NULL,
    current_status varchar DEFAULT 'PLANNED'::character varying,
    current_status_file varchar,
    submit_no_sub1 varchar,
    revision_no_sub1 varchar,
    direction_out_sub1 varchar,
    planned_date_out_sub1 date,
    transmit_date_out_sub1 date,
    transmit_no_out_sub1 varchar,
    approval_status_out_sub1 varchar,
    direction_out_file_sub1 varchar,
    direction_in_sub1 varchar,
    transmit_no_in_sub1 varchar,
    approval_status_in_sub1 varchar,
    direction_in_file_sub1 varchar,
    transmit_date_in_sub1 date,
    submit_no_sub2 varchar,
    revision_no_sub2 varchar,
    direction_out_sub2 varchar,
    planned_date_out_sub2 date,
    transmit_date_out_sub2 date,
    transmit_no_out_sub2 varchar,
    approval_status_out_sub2 varchar,
    direction_out_file_sub2 varchar,
    direction_in_sub2 varchar,
    transmit_no_in_sub2 varchar,
    approval_status_in_sub2 varchar,
    direction_in_file_sub2 varchar,
    transmit_date_in_sub2 date,
    submit_no_sub3 varchar,
    revision_no_sub3 varchar,
    direction_out_sub3 varchar,
    planned_date_out_sub3 date,
    transmit_date_out_sub3 date,
    transmit_no_out_sub3 varchar,
    approval_status_out_sub3 varchar,
    direction_out_file_sub3 varchar,
    direction_in_sub3 varchar,
    transmit_no_in_sub3 varchar,
    approval_status_in_sub3 varchar,
    direction_in_file_sub3 varchar,
    transmit_date_in_sub3 date,
    submit_no_sub4 varchar,
    revision_no_sub4 varchar,
    direction_out_sub4 varchar,
    planned_date_out_sub4 date,
    transmit_date_out_sub4 date,
    transmit_no_out_sub4 varchar,
    approval_status_out_sub4 varchar,
    direction_out_file_sub4 varchar,
    direction_in_sub4 varchar,
    transmit_no_in_sub4 varchar,
    approval_status_in_sub4 varchar,
    direction_in_file_sub4 varchar,
    transmit_date_in_sub4 date,
    submit_no_sub5 varchar,
    revision_no_sub5 varchar,
    direction_out_sub5 varchar,
    planned_date_out_sub5 date,
    transmit_date_out_sub5 date,
    transmit_no_out_sub5 varchar,
    approval_status_out_sub5 varchar,
    direction_out_file_sub5 varchar,
    direction_in_sub5 varchar,
    transmit_no_in_sub5 varchar,
    approval_status_in_sub5 varchar,
    direction_in_file_sub5 varchar,
    transmit_date_in_sub5 date,
    submit_no_sub6 varchar,
    revision_no_sub6 varchar,
    direction_out_sub6 varchar,
    planned_date_out_sub6 date,
    transmit_date_out_sub6 date,
    transmit_no_out_sub6 varchar,
    approval_status_out_sub6 varchar,
    direction_out_file_sub6 varchar,
    direction_in_sub6 varchar,
    transmit_no_in_sub6 varchar,
    approval_status_in_sub6 varchar,
    direction_in_file_sub6 varchar,
    transmit_date_in_sub6 date,
    submit_no_sub7 varchar,
    revision_no_sub7 varchar,
    direction_out_sub7 varchar,
    planned_date_out_sub7 date,
    transmit_date_out_sub7 date,
    transmit_no_out_sub7 varchar,
    approval_status_out_sub7 varchar,
    direction_out_file_sub7 varchar,
    direction_in_sub7 varchar,
    transmit_no_in_sub7 varchar,
    approval_status_in_sub7 varchar,
    direction_in_file_sub7 varchar,
    transmit_date_in_sub7 date,
    submit_no_sub8 varchar,
    revision_no_sub8 varchar,
    direction_out_sub8 varchar,
    planned_date_out_sub8 date,
    transmit_date_out_sub8 date,
    transmit_no_out_sub8 varchar,
    approval_status_out_sub8 varchar,
    direction_out_file_sub8 varchar,
    direction_in_sub8 varchar,
    transmit_no_in_sub8 varchar,
    approval_status_in_sub8 varchar,
    direction_in_file_sub8 varchar,
    transmit_date_in_sub8 date,
    submit_no_sub9 varchar,
    revision_no_sub9 varchar,
    direction_out_sub9 varchar,
    planned_date_out_sub9 date,
    transmit_date_out_sub9 date,
    transmit_no_out_sub9 varchar,
    approval_status_out_sub9 varchar,
    direction_out_file_sub9 varchar,
    direction_in_sub9 varchar,
    transmit_no_in_sub9 varchar,
    approval_status_in_sub9 varchar,
    direction_in_file_sub9 varchar,
    transmit_date_in_sub9 date,
    submit_no_sub10 varchar,
    revision_no_sub10 varchar,
    direction_out_sub10 varchar,
    planned_date_out_sub10 date,
    transmit_date_out_sub10 date,
    transmit_no_out_sub10 varchar,
    approval_status_out_sub10 varchar,
    direction_out_file_sub10 varchar,
    direction_in_sub10 varchar,
    transmit_no_in_sub10 varchar,
    approval_status_in_sub10 varchar,
    direction_in_file_sub10 varchar,
    transmit_date_in_sub10 date,
    log_updatedon timestamp without time zone DEFAULT ('now'::text)::timestamp(6) with time zone
)
WITH (oids = false);
--
-- Definition for index project_details_pk (OID = 25434) : 
--
ALTER TABLE ONLY project_details
    ADD CONSTRAINT project_details_pk
    PRIMARY KEY (project_id);
--
-- Definition for index project_details_project_name_key (OID = 25436) : 
--
ALTER TABLE ONLY project_details
    ADD CONSTRAINT project_details_project_name_key
    UNIQUE (project_name);
--
-- Definition for index distribution_details_pk (OID = 25448) : 
--
ALTER TABLE ONLY distribution_details
    ADD CONSTRAINT distribution_details_pk
    PRIMARY KEY (distribution_id);
--
-- Definition for index inbox_pk (OID = 25459) : 
--
ALTER TABLE ONLY inbox
    ADD CONSTRAINT inbox_pk
    PRIMARY KEY (inbox_id);
--
-- Definition for index pkaudittrail (OID = 25487) : 
--
ALTER TABLE ONLY audittrail
    ADD CONSTRAINT pkaudittrail
    PRIMARY KEY (id);
--
-- Definition for index transmit_details_pkey (OID = 25568) : 
--
ALTER TABLE ONLY transmit_details
    ADD CONSTRAINT transmit_details_pkey
    PRIMARY KEY (transmit_id);
--
-- Definition for index transmit_details_transmittal_no_key (OID = 25570) : 
--
ALTER TABLE ONLY transmit_details
    ADD CONSTRAINT transmit_details_transmittal_no_key
    UNIQUE (transmittal_no);
--
-- Definition for index document_details_pk (OID = 25623) : 
--
ALTER TABLE ONLY document_details
    ADD CONSTRAINT document_details_pk
    PRIMARY KEY (document_sequence);
--
-- Definition for index document_details_client_doc_no_key (OID = 25625) : 
--
ALTER TABLE ONLY document_details
    ADD CONSTRAINT document_details_client_doc_no_key
    UNIQUE (client_doc_no);
--
-- Definition for index document_details_firelink_doc_no_key (OID = 25627) : 
--
ALTER TABLE ONLY document_details
    ADD CONSTRAINT document_details_firelink_doc_no_key
    UNIQUE (firelink_doc_no);
--
-- Definition for index approval_details_pkey (OID = 25639) : 
--
ALTER TABLE ONLY approval_details
    ADD CONSTRAINT approval_details_pkey
    PRIMARY KEY (id);
--
-- Definition for index app_version_pkey (OID = 25645) : 
--
ALTER TABLE ONLY app_version
    ADD CONSTRAINT app_version_pkey
    PRIMARY KEY (sequence_no);
--
-- Definition for index document_system_pkey (OID = 25748) : 
--
ALTER TABLE ONLY document_system
    ADD CONSTRAINT document_system_pkey
    PRIMARY KEY (type_id);
--
-- Definition for index document_system_system_name_key (OID = 25750) : 
--
ALTER TABLE ONLY document_system
    ADD CONSTRAINT document_system_system_name_key
    UNIQUE (system_name);
--
-- Definition for index pkuserlevels (OID = 25783) : 
--
ALTER TABLE ONLY userlevels
    ADD CONSTRAINT pkuserlevels
    PRIMARY KEY (userlevelid);
--
-- Definition for index pkuserlevelpermissions (OID = 25788) : 
--
ALTER TABLE ONLY userlevelpermissions
    ADD CONSTRAINT pkuserlevelpermissions
    PRIMARY KEY (userlevelid, tablename);
--
-- Definition for index user_dtls_pkey (OID = 33922) : 
--
ALTER TABLE ONLY user_dtls
    ADD CONSTRAINT user_dtls_pkey
    PRIMARY KEY (user_id);
--
-- Definition for index user_dtls_email_addreess_key (OID = 33924) : 
--
ALTER TABLE ONLY user_dtls
    ADD CONSTRAINT user_dtls_email_addreess_key
    UNIQUE (email_addreess);
--
-- Definition for index user_dtls_username_key (OID = 33926) : 
--
ALTER TABLE ONLY user_dtls
    ADD CONSTRAINT user_dtls_username_key
    UNIQUE (username);
--
-- Definition for index xmit_details_pkey (OID = 53131) : 
--
ALTER TABLE ONLY xmit_details
    ADD CONSTRAINT xmit_details_pkey
    PRIMARY KEY (xmit_id);
--
-- Definition for index transaction_details_pk (OID = 60684) : 
--
ALTER TABLE ONLY transaction_details
    ADD CONSTRAINT transaction_details_pk
    PRIMARY KEY (document_sequence);
--
-- Definition for index transaction_details_document_link_key (OID = 60686) : 
--
ALTER TABLE ONLY transaction_details
    ADD CONSTRAINT transaction_details_document_link_key
    UNIQUE (document_link);
--
-- Definition for index transaction_details_fk (OID = 60688) : 
--
ALTER TABLE ONLY transaction_details
    ADD CONSTRAINT transaction_details_fk
    FOREIGN KEY (firelink_doc_no) REFERENCES document_details(firelink_doc_no) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;
--
-- Definition for index transaction_details_project_name (OID = 60693) : 
--
ALTER TABLE ONLY transaction_details
    ADD CONSTRAINT transaction_details_project_name
    FOREIGN KEY (project_name) REFERENCES project_details(project_name) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT;
--
-- Definition for index document_log_pkey (OID = 61839) : 
--
ALTER TABLE ONLY document_log
    ADD CONSTRAINT document_log_pkey
    PRIMARY KEY (log_id);
--
-- Definition for index document_log_firelink_doc_no_key (OID = 61841) : 
--
ALTER TABLE ONLY document_log
    ADD CONSTRAINT document_log_firelink_doc_no_key
    UNIQUE (firelink_doc_no);
--
-- Definition for index document_log_document_tittle_key (OID = 61843) : 
--
ALTER TABLE ONLY document_log
    ADD CONSTRAINT document_log_document_tittle_key
    UNIQUE (document_tittle);
--
-- Definition for trigger transaction_details_project (OID = 61779) : 
--
CREATE TRIGGER transaction_details_project
    BEFORE INSERT ON transaction_details
    FOR EACH ROW
    EXECUTE PROCEDURE func_transaction_details_project ();
--
-- Comments
--
COMMENT ON SCHEMA public IS 'standard public schema';
COMMENT ON COLUMN public.transmit_details.ack_rcvd IS 'Aknowledgement Received';
COMMENT ON COLUMN public.transmit_details.ack_document IS 'SMB file location of the acknolwdgement received';
COMMENT ON COLUMN public.transmit_details.transmital_date IS 'Time stamp for transmittal creation';
COMMENT ON COLUMN public.user_dtls.reports_to IS 'The User ID this guy reports to';
COMMENT ON COLUMN public.transaction_details.document_native IS 'SMB url of the native file';
COMMENT ON COLUMN public.transaction_details.username IS 'frontend user who made the entry';
COMMENT ON COLUMN public.transaction_details.expiry_date IS 'To record expected expiry date for an in document';
COMMENT ON CONSTRAINT transaction_details_project_name ON transaction_details IS 'Data inegrity to ensure project names are same. Cascade on Update and Restrict on insert.';
COMMENT ON TRIGGER transaction_details_project ON transaction_details IS 'Trigger to auto insert the project name and document tittle.';
COMMENT ON COLUMN public.document_log.log_updatedon IS 'Last update when the query was ran';
