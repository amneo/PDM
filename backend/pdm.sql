-- SQL Manager Lite for PostgreSQL 5.9.5.52424
-- ---------------------------------------
-- Host      : 192.168.100.70
-- Database  : pdm
-- Version   : PostgreSQL 9.6.13 on x86_64-pc-linux-gnu (Debian 9.6.13-1.pgdg90+1), compiled by gcc (Debian 6.3.0-18+deb9u1) 6.3.0 20170516, 64-bit



SET search_path = public, pg_catalog;
DROP TRIGGER IF EXISTS transaction_details_project ON public.transaction_details;
DROP TABLE IF EXISTS public.document_log;
DROP INDEX IF EXISTS public.project_details_project_name_order_number_key;
DROP FUNCTION IF EXISTS public.om_func_03 ();
DROP FUNCTION IF EXISTS public.om_func_04 (f_firelink_doc_no varchar);
DROP FUNCTION IF EXISTS public.om_func_02 ();
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
-- Definition for function om_func_02 (OID = 61778) :
--
CREATE FUNCTION public.om_func_02 (
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
-- Definition for function om_func_04 (OID = 62545) :
--
CREATE FUNCTION public.om_func_04 (
  f_firelink_doc_no character varying
)
RETURNS boolean
AS
$body$
DECLARE
f_transaction_details transaction_details%ROWTYPE; -- get the complete record
f_document_details document_details%ROWTYPE;--get the complete record
f_firelink_doc_no_count INTEGER :=0; --The count of documents in transaction_details
f_firelink_doc_no_count_doc_log INTEGER :=0; --The count of documents in document_log
f_document_status VARCHAR := 'ONGOING';--Determine the over all status of the document
f_order_number VARCHAR := 'TBA';-- Order number for the project
f_counter_no INTEGER := 1;--|Counter for Log
f_counter_array RECORD;--Preparing array for values
/**** DECLARE FOR LARGE TABLE OPERATION*******************/
f_client_doc_no	VARCHAR	:= NULL;
f_project_name	VARCHAR	:= NULL;
f_document_tittle	VARCHAR	:= NULL;
f_current_status	VARCHAR	:= NULL;
f_current_status_file	VARCHAR	:= NULL;
f_submit_no_1	INTEGER	:=NULL	;
f_revision_no_1	VARCHAR	:= NULL	;
f_direction_1	VARCHAR	:= NULL	;
f_planned_date_1	DATE	:=NULL	;
f_transmit_date_1	DATE	:=NULL	;
f_transmit_no_1	VARCHAR	:= NULL	;
f_approval_status_1	VARCHAR	:= NULL	;
f_direction_file_1	VARCHAR	:= NULL	;
f_submit_no_2	INTEGER	:=NULL	;
f_revision_no_2	VARCHAR	:= NULL	;
f_direction_2	VARCHAR	:= NULL	;
f_planned_date_2	DATE	:=NULL	;
f_transmit_date_2	DATE	:=NULL	;
f_transmit_no_2	VARCHAR	:= NULL	;
f_approval_status_2	VARCHAR	:= NULL	;
f_direction_file_2	VARCHAR	:= NULL	;
f_submit_no_3	INTEGER	:=NULL	;
f_revision_no_3	VARCHAR	:= NULL	;
f_direction_3	VARCHAR	:= NULL	;
f_planned_date_3	DATE	:=NULL	;
f_transmit_date_3	DATE	:=NULL	;
f_transmit_no_3	VARCHAR	:= NULL	;
f_approval_status_3	VARCHAR	:= NULL	;
f_direction_file_3	VARCHAR	:= NULL	;
f_submit_no_4	INTEGER	:=NULL	;
f_revision_no_4	VARCHAR	:= NULL	;
f_direction_4	VARCHAR	:= NULL	;
f_planned_date_4	DATE	:=NULL	;
f_transmit_date_4	DATE	:=NULL	;
f_transmit_no_4	VARCHAR	:= NULL	;
f_approval_status_4	VARCHAR	:= NULL	;
f_direction_file_4	VARCHAR	:= NULL	;
f_submit_no_5	INTEGER	:=NULL	;
f_revision_no_5	VARCHAR	:= NULL	;
f_direction_5	VARCHAR	:= NULL	;
f_planned_date_5	DATE	:=NULL	;
f_transmit_date_5	DATE	:=NULL;
f_transmit_no_5	VARCHAR	:= NULL	;
f_approval_status_5	VARCHAR	:= NULL	;
f_direction_file_5	VARCHAR	:= NULL	;
f_submit_no_6	INTEGER	:=NULL;
f_revision_no_6	VARCHAR	:= NULL	;
f_direction_6	VARCHAR	:= NULL	;
f_planned_date_6	DATE	:=NULL	;
f_transmit_date_6	DATE	:=NULL	;
f_transmit_no_6	VARCHAR	:= NULL	;
f_approval_status_6	VARCHAR	:= NULL;
f_direction_file_6	VARCHAR	:= NULL	;
f_submit_no_7	INTEGER	:=NULL;
f_revision_no_7	VARCHAR	:= NULL	;
f_direction_7	VARCHAR	:= NULL	;
f_planned_date_7	DATE	:=NULL;
f_transmit_date_7	DATE	:=NULL	;
f_transmit_no_7	VARCHAR	:= NULL	;
f_approval_status_7	VARCHAR	:= NULL	;
f_direction_file_7	VARCHAR	:= NULL	;
f_submit_no_8	INTEGER	:=NULL;
f_revision_no_8	VARCHAR	:= NULL	;
f_direction_8	VARCHAR	:= NULL	;
f_planned_date_8	DATE	:=NULL	;
f_transmit_date_8	DATE	:=NULL	;
f_transmit_no_8	VARCHAR	:= NULL	;
f_approval_status_8	VARCHAR	:= NULL	;
f_direction_file_8	VARCHAR	:= NULL	;
f_submit_no_9	INTEGER	:=NULL;
f_revision_no_9	VARCHAR	:= NULL	;
f_direction_9	VARCHAR	:= NULL	;
f_planned_date_9	DATE	:=NULL	;
f_transmit_date_9	DATE	:=NULL	;
f_transmit_no_9	VARCHAR	:= NULL	;
f_approval_status_9	VARCHAR	:= NULL	;
f_direction_file_9	VARCHAR	:= NULL	;
f_submit_no_10	INTEGER	:=NULL;
f_revision_no_10	VARCHAR	:= NULL	;
f_direction_10	VARCHAR	:= NULL	;
f_planned_date_10	DATE	:=NULL	;
f_transmit_date_10	DATE	:=NULL	;
f_transmit_no_10	VARCHAR	:= NULL	;
f_approval_status_10	VARCHAR	:= NULL	;
f_direction_file_10	VARCHAR	:= NULL	;

/*****ENDS HERE***/
BEGIN
--Find how many records are avaialble in transaction details table
select into f_firelink_doc_no_count count(document_sequence) from transaction_details where firelink_doc_no = f_firelink_doc_no;
--Find how many records are available in document_log table
select into f_firelink_doc_no_count_doc_log count(log_id) from document_log where firelink_doc_no = f_firelink_doc_no;
--Getting the complete record into the variable.
select into f_transaction_details * from transaction_details where firelink_doc_no = f_firelink_doc_no;
--Getting the client document number from document document_details table
select into f_document_details * from document_details where firelink_doc_no = f_firelink_doc_no;
--Preparing to insert for the first condition i.e Document exists only in transaction_details but not in document_log
IF f_firelink_doc_no_count = 1 AND f_firelink_doc_no_count_doc_log = 0 THEN
  select into f_document_status document_status from approval_details where short_code  = f_transaction_details.approval_status;
  select into f_order_number order_number from project_details where project_name = f_transaction_details.project_name;
  insert into document_log(
    firelink_doc_no,
    client_doc_no,
    order_number,
    project_name,
    document_tittle,
    current_status,
    current_status_file,
    submit_no_1,
    revision_no_1,
    direction_1,
    planned_date_1,
    transmit_date_1,
    transmit_no_1,
    approval_status_1,
    direction_file_1
    )
    values (
    f_firelink_doc_no,
    f_document_details.client_doc_no,
    f_order_number,
    f_transaction_details.project_name,
    f_transaction_details.document_tittle,
    f_document_status,
    f_transaction_details.document_link,
    f_transaction_details.submit_no,
    f_transaction_details.revision_no,
    f_transaction_details.direction,
    f_document_details.planned_date,
    f_transaction_details.transmit_date,
    f_transaction_details.transmit_no,
    f_transaction_details.approval_status,
    f_transaction_details.document_link
    );
RAISE NOTICE'COUNTERIS AT SINGLE VALUE AUTO INCREMENT IS AT % ',f_counter_no;
RETURN TRUE;
-- In case more than 1 no of documentcount in transaction_details and none in document_log then insert them too
ELSIF f_firelink_doc_no_count > 1 AND f_firelink_doc_no_count_doc_log = 0 THEN
    --limit the transaction to 20 only i.e 10 out 10 in
    FOR f_transaction_details IN SELECT * FROM transaction_details where firelink_doc_no = f_firelink_doc_no order by document_sequence DESC limit 10
    LOOP
		--inserting the first instance
        IF f_counter_no = 1 THEN
        	select into f_document_status document_status from approval_details where short_code  = f_transaction_details.approval_status;
			select into f_order_number order_number from project_details where project_name = f_transaction_details.project_name;
            f_firelink_doc_no	:=	  f_firelink_doc_no;
            f_client_doc_no	:=	  f_document_details.client_doc_no;
            f_order_number	:=	  f_order_number;
            f_project_name	:=	  f_transaction_details.project_name;
           	f_document_tittle	:=	  f_transaction_details.document_tittle;
            f_current_status	:=	  f_document_status;
            f_current_status_file	:=	  f_transaction_details.document_link;
            f_submit_no_1	:=	  f_transaction_details.submit_no;
            f_revision_no_1	:=	  f_transaction_details.revision_no;
            f_direction_1	:=	  f_transaction_details.direction;
            f_planned_date_1	:=	  f_document_details.planned_date;
            f_transmit_date_1	:=	  f_transaction_details.transmit_date;
            f_transmit_no_1	:=	  f_transaction_details.transmit_no;
            f_approval_status_1	:=	  f_transaction_details.approval_status;
            f_direction_file_1	:=	  f_transaction_details.document_link;
            RAISE NOTICE'COUNTERIS AT 1 AUTO INCREMENT IS AT % ',f_counter_no;
		ELSIF f_counter_no = 2  THEN
			f_submit_no_2	:=	  f_transaction_details.submit_no;
            f_revision_no_2	:=	  f_transaction_details.revision_no;
            f_direction_2	:=	  f_transaction_details.direction;
            f_planned_date_2	:=	  f_document_details.planned_date;
            f_transmit_date_2	:=	  f_transaction_details.transmit_date;
            f_transmit_no_2	:=	  f_transaction_details.transmit_no;
            f_approval_status_2	:=	  f_transaction_details.approval_status;
            f_direction_file_2	:=	  f_transaction_details.document_link;
             RAISE NOTICE'COUNTERIS AT 2 AUTO INCREMENT IS AT % ',f_counter_no;
		ELSIF f_counter_no = 3  THEN
			f_submit_no_3	:=	  f_transaction_details.submit_no;
            f_revision_no_3	:=	  f_transaction_details.revision_no;
            f_direction_3	:=	  f_transaction_details.direction;
            f_planned_date_3	:=	  f_document_details.planned_date;
            f_transmit_date_3	:=	  f_transaction_details.transmit_date;
            f_transmit_no_3	:=	  f_transaction_details.transmit_no;
            f_approval_status_3	:=	  f_transaction_details.approval_status;
            f_direction_file_3	:=	  f_transaction_details.document_link;
         RAISE NOTICE'COUNTERIS AT 3 AUTO INCREMENT IS AT % ',f_counter_no;
		ELSIF f_counter_no = 4  THEN
			f_submit_no_4	:=	  f_transaction_details.submit_no;
            f_revision_no_4	:=	  f_transaction_details.revision_no;
            f_direction_4	:=	  f_transaction_details.direction;
            f_planned_date_4	:=	  f_document_details.planned_date;
            f_transmit_date_4	:=	  f_transaction_details.transmit_date;
            f_transmit_no_4	:=	  f_transaction_details.transmit_no;
            f_approval_status_4	:=	  f_transaction_details.approval_status;
            f_direction_file_4	:=	  f_transaction_details.document_link;
            RAISE NOTICE'COUNTERIS AT 4 AUTO INCREMENT IS AT % ',f_counter_no;
		ELSIF f_counter_no = 5  THEN
			f_submit_no_5	:=	  f_transaction_details.submit_no;
            f_revision_no_5	:=	  f_transaction_details.revision_no;
            f_direction_5	:=	  f_transaction_details.direction;
            f_planned_date_5	:=	  f_document_details.planned_date;
            f_transmit_date_5	:=	  f_transaction_details.transmit_date;
            f_transmit_no_5	:=	  f_transaction_details.transmit_no;
            f_approval_status_5	:=	  f_transaction_details.approval_status;
            f_direction_file_5	:=	  f_transaction_details.document_link;
            RAISE NOTICE'COUNTERIS AT 5 AUTO INCREMENT IS AT % ',f_counter_no;
		ELSIF f_counter_no = 6  THEN
			f_submit_no_6	:=	  f_transaction_details.submit_no;
            f_revision_no_6	:=	  f_transaction_details.revision_no;
            f_direction_6	:=	  f_transaction_details.direction;
            f_planned_date_6	:=	  f_document_details.planned_date;
            f_transmit_date_6	:=	  f_transaction_details.transmit_date;
            f_transmit_no_6	:=	  f_transaction_details.transmit_no;
            f_approval_status_6	:=	  f_transaction_details.approval_status;
            f_direction_file_6	:=	  f_transaction_details.document_link;
            RAISE NOTICE'COUNTERIS AT 6 AUTO INCREMENT IS AT % ',f_counter_no;
		ELSIF f_counter_no = 7  THEN
			f_submit_no_7	:=	  f_transaction_details.submit_no;
            f_revision_no_7	:=	  f_transaction_details.revision_no;
            f_direction_7	:=	  f_transaction_details.direction;
            f_planned_date_7	:=	  f_document_details.planned_date;
            f_transmit_date_7	:=	  f_transaction_details.transmit_date;
            f_transmit_no_7	:=	  f_transaction_details.transmit_no;
            f_approval_status_7	:=	  f_transaction_details.approval_status;
            f_direction_file_7	:=	  f_transaction_details.document_link;
            RAISE NOTICE'COUNTERIS AT 7 AUTO INCREMENT IS AT % ',f_counter_no;
		ELSIF f_counter_no = 8  THEN
			f_submit_no_8	:=	  f_transaction_details.submit_no;
            f_revision_no_8	:=	  f_transaction_details.revision_no;
            f_direction_8	:=	  f_transaction_details.direction;
            f_planned_date_8	:=	  f_document_details.planned_date;
            f_transmit_date_8	:=	  f_transaction_details.transmit_date;
            f_transmit_no_8	:=	  f_transaction_details.transmit_no;
            f_approval_status_8	:=	  f_transaction_details.approval_status;
            f_direction_file_8	:=	  f_transaction_details.document_link;
            RAISE NOTICE'COUNTERIS AT 8 AUTO INCREMENT IS AT %1 ',f_counter_no;
		ELSIF f_counter_no = 9  THEN
			f_submit_no_9	:=	  f_transaction_details.submit_no;
            f_revision_no_9	:=	  f_transaction_details.revision_no;
            f_direction_9	:=	  f_transaction_details.direction;
            f_planned_date_9	:=	  f_document_details.planned_date;
            f_transmit_date_9	:=	  f_transaction_details.transmit_date;
            f_transmit_no_9	:=	  f_transaction_details.transmit_no;
            f_approval_status_9	:=	  f_transaction_details.approval_status;
            f_direction_file_9	:=	  f_transaction_details.document_link;
            RAISE NOTICE'COUNTERIS AT 9 AUTO INCREMENT IS AT % ',f_counter_no;
		ELSIF f_counter_no = 10  THEN
			f_submit_no_10	:=	  f_transaction_details.submit_no;
            f_revision_no_10	:=	  f_transaction_details.revision_no;
            f_direction_10	:=	  f_transaction_details.direction;
            f_planned_date_10	:=	  f_document_details.planned_date;
            f_transmit_date_10	:=	  f_transaction_details.transmit_date;
            f_transmit_no_10	:=	  f_transaction_details.transmit_no;
            f_approval_status_10	:=	  f_transaction_details.approval_status;
            f_direction_file_10	:=	  f_transaction_details.document_link;
  			RAISE NOTICE'COUNTERIS AT 10 AUTO INCREMENT IS AT % ',f_counter_no;
        ELSE
        RAISE EXCEPTION '<br>UNEXPECTED ERROR OCCURED REPORT WITH ERROR CODE psi_ravan_003 Document number is %',f_firelink_doc_no;

		END IF;
        f_counter_no := f_counter_no + 1::integer; --Increment the counter by 1 to collect the next record

    END LOOP;
  /***Insert starts here***/
INSERT INTO
  public.document_log
(
  firelink_doc_no,
  client_doc_no,
  order_number,
  project_name,
  document_tittle,
  current_status,
  current_status_file,
  submit_no_1,
  revision_no_1,
  direction_1,
  planned_date_1,
  transmit_date_1,
  transmit_no_1,
  approval_status_1,
  direction_file_1,
  submit_no_2,
  revision_no_2,
  direction_2,
  planned_date_2,
  transmit_date_2,
  transmit_no_2,
  approval_status_2,
  direction_file_2,
  submit_no_3,
  revision_no_3,
  direction_3,
  planned_date_3,
  transmit_date_3,
  transmit_no_3,
  approval_status_3,
  direction_file_3,
  submit_no_4,
  revision_no_4,
  direction_4,
  planned_date_4,
  transmit_date_4,
  transmit_no_4,
  approval_status_4,
  direction_file_4,
  submit_no_5,
  revision_no_5,
  direction_5,
  planned_date_5,
  transmit_date_5,
  transmit_no_5,
  approval_status_5,
  direction_file_5,
  submit_no_6,
  revision_no_6,
  direction_6,
  planned_date_6,
  transmit_date_6,
  transmit_no_6,
  approval_status_6,
  direction_file_6,
  submit_no_7,
  revision_no_7,
  direction_7,
  planned_date_7,
  transmit_date_7,
  transmit_no_7,
  approval_status_7,
  direction_file_7,
  submit_no_8,
  revision_no_8,
  direction_8,
  planned_date_8,
  transmit_date_8,
  transmit_no_8,
  approval_status_8,
  direction_file_8,
  submit_no_9,
  revision_no_9,
  direction_9,
  planned_date_9,
  transmit_date_9,
  transmit_no_9,
  approval_status_9,
  direction_file_9,
  submit_no_10,
  revision_no_10,
  direction_10,
  planned_date_10,
  transmit_date_10,
  transmit_no_10,
  approval_status_10,
  direction_file_10

)
VALUES (
  f_firelink_doc_no,
  f_client_doc_no,
  f_order_number,
  f_project_name,
  f_document_tittle,
  f_current_status,
  f_current_status_file,
  f_submit_no_1,
  f_revision_no_1,
  f_direction_1,
  f_planned_date_1,
  f_transmit_date_1,
  f_transmit_no_1,
  f_approval_status_1,
  f_direction_file_1,
  f_submit_no_2,
  f_revision_no_2,
  f_direction_2,
  f_planned_date_2,
  f_transmit_date_2,
  f_transmit_no_2,
  f_approval_status_2,
  f_direction_file_2,
  f_submit_no_3,
  f_revision_no_3,
  f_direction_3,
  f_planned_date_3,
  f_transmit_date_3,
  f_transmit_no_3,
  f_approval_status_3,
  f_direction_file_3,
  f_submit_no_4,
  f_revision_no_4,
  f_direction_4,
  f_planned_date_4,
  f_transmit_date_4,
  f_transmit_no_4,
  f_approval_status_4,
  f_direction_file_4,
  f_submit_no_5,
  f_revision_no_5,
  f_direction_5,
  f_planned_date_5,
  f_transmit_date_5,
  f_transmit_no_5,
  f_approval_status_5,
  f_direction_file_5,
  f_submit_no_6,
  f_revision_no_6,
  f_direction_6,
  f_planned_date_6,
  f_transmit_date_6,
  f_transmit_no_6,
  f_approval_status_6,
  f_direction_file_6,
  f_submit_no_7,
  f_revision_no_7,
  f_direction_7,
  f_planned_date_7,
  f_transmit_date_7,
  f_transmit_no_7,
  f_approval_status_7,
  f_direction_file_7,
  f_submit_no_8,
  f_revision_no_8,
  f_direction_8,
  f_planned_date_8,
  f_transmit_date_8,
  f_transmit_no_8,
  f_approval_status_8,
  f_direction_file_8,
  f_submit_no_9,
  f_revision_no_9,
  f_direction_9,
  f_planned_date_9,
  f_transmit_date_9,
  f_transmit_no_9,
  f_approval_status_9,
  f_direction_file_9,
  f_submit_no_10,
  f_revision_no_10,
  f_direction_10,
  f_planned_date_10,
  f_transmit_date_10,
  f_transmit_no_10,
  f_approval_status_10,
  f_direction_file_10
);
RETURN TRUE;
ELSE
RAISE NOTICE 'NOT EXPECTED';
RETURN FALSE;
END IF;
--RETURN TRUE;
END;
$body$
LANGUAGE plpgsql;
--
-- Definition for function om_func_03 (OID = 62551) :
--
CREATE FUNCTION public.om_func_03 (
)
RETURNS boolean
AS
$body$
DECLARE
f_no_firelink_doc_no VARCHAR ='NO DOCUMENT'; -- documents that has not been transactioned ever i.e no entry in transaction_details table.
f_yes_firelink_doc_no VARCHAR :='NO DOCUMENT'; -- documents that has not been transactioned ever i.e has entry in transaction_details table.
f_firelink_doc_no_count INTEGER := 0 ;
f_om_sai_func_04 BOOLEAN := FALSE;
f_document_status VARCHAR := 'PLANNED';
f_document_details document_details%ROWTYPE;
f_order_number VARCHAR :=NULL;
BEGIN
--Finding the firelink_doc_no that has never been transactioned i.e no entry in transaction_log but have been planned i.e document_details
-- Starting to loop and insert into the transaction_log table
FOR f_yes_firelink_doc_no IN select firelink_doc_no from transaction_details where firelink_doc_no IN (select firelink_doc_no from document_details)group by firelink_doc_no
LOOP
  RAISE NOTICE 'The document is %',f_yes_firelink_doc_no;
  f_om_sai_func_04 := om_func_04(f_yes_firelink_doc_no);
  IF f_om_sai_func_04 = FALSE THEN
  RAISE EXCEPTION
  '<br><h1>Automation Error Code </h1><br><h3>psi_ravan_002</h3>';
  RETURN FALSE;
  END IF;
END LOOP;
FOR f_document_details IN select * from document_details where firelink_doc_no NOT IN (select firelink_doc_no from transaction_details)
LOOP
RAISE NOTICE 'The document has not been transmitted till date is %',f_document_details.firelink_doc_no;
  select into f_order_number order_number from project_details where project_name = f_document_details.project_name;
  insert into document_log(
    firelink_doc_no,
    client_doc_no,
    order_number,
    project_name,
    document_tittle,
    current_status,
    planned_date_1
    )
    values (
    f_document_details.firelink_doc_no,
    f_document_details.client_doc_no,
    f_order_number,
    f_document_details.project_name,
    f_document_details.document_tittle,
    f_document_status,
    f_document_details.planned_date
    );
END LOOP;
RETURN TRUE;
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
-- Structure for table document_log (OID = 62730) :
--
CREATE TABLE public.document_log (
    log_id bigserial NOT NULL,
    firelink_doc_no varchar NOT NULL,
    client_doc_no varchar DEFAULT 'NOT PROVIDED'::character varying,
    order_number varchar NOT NULL,
    project_name varchar NOT NULL,
    document_tittle varchar NOT NULL,
    current_status varchar DEFAULT 'PLANNED'::character varying,
    current_status_file varchar,
    submit_no_1 integer,
    revision_no_1 varchar,
    direction_1 varchar,
    planned_date_1 date,
    transmit_date_1 date,
    transmit_no_1 varchar,
    approval_status_1 varchar,
    direction_file_1 varchar,
    submit_no_2 integer,
    revision_no_2 varchar,
    direction_2 varchar,
    planned_date_2 date,
    transmit_date_2 date,
    transmit_no_2 varchar,
    approval_status_2 varchar,
    direction_file_2 varchar,
    submit_no_3 integer,
    revision_no_3 varchar,
    direction_3 varchar,
    planned_date_3 date,
    transmit_date_3 date,
    transmit_no_3 varchar,
    approval_status_3 varchar,
    direction_file_3 varchar,
    submit_no_4 integer,
    revision_no_4 varchar,
    direction_4 varchar,
    planned_date_4 date,
    transmit_date_4 date,
    transmit_no_4 varchar,
    approval_status_4 varchar,
    direction_file_4 varchar,
    submit_no_5 integer,
    revision_no_5 varchar,
    direction_5 varchar,
    planned_date_5 date,
    transmit_date_5 date,
    transmit_no_5 varchar,
    approval_status_5 varchar,
    direction_file_5 varchar,
    submit_no_6 integer,
    revision_no_6 varchar,
    direction_6 varchar,
    planned_date_6 date,
    transmit_date_6 date,
    transmit_no_6 varchar,
    approval_status_6 varchar,
    direction_file_6 varchar,
    submit_no_7 integer,
    revision_no_7 varchar,
    direction_7 varchar,
    planned_date_7 date,
    transmit_date_7 date,
    transmit_no_7 varchar,
    approval_status_7 varchar,
    direction_file_7 varchar,
    submit_no_8 integer,
    revision_no_8 varchar,
    direction_8 varchar,
    planned_date_8 date,
    transmit_date_8 date,
    transmit_no_8 varchar,
    approval_status_8 varchar,
    direction_file_8 varchar,
    submit_no_9 integer,
    revision_no_9 varchar,
    direction_9 varchar,
    planned_date_9 date,
    transmit_date_9 date,
    transmit_no_9 varchar,
    approval_status_9 varchar,
    direction_file_9 varchar,
    submit_no_10 integer,
    revision_no_10 varchar,
    direction_10 varchar,
    planned_date_10 date,
    transmit_date_10 date,
    transmit_no_10 varchar,
    approval_status_10 varchar,
    direction_file_10 varchar,
    log_updatedon timestamp without time zone DEFAULT ('now'::text)::timestamp(6) with time zone
)
WITH (oids = false);
--
-- Definition for index project_details_project_name_order_number_key (OID = 62602) :
--
CREATE UNIQUE INDEX project_details_project_name_order_number_key ON public.project_details USING btree (project_name, order_number);
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
-- Definition for index document_log_pkey (OID = 62740) :
--
ALTER TABLE ONLY document_log
    ADD CONSTRAINT document_log_pkey
    PRIMARY KEY (log_id);
--
-- Definition for index document_log_firelink_doc_no_key (OID = 62742) :
--
ALTER TABLE ONLY document_log
    ADD CONSTRAINT document_log_firelink_doc_no_key
    UNIQUE (firelink_doc_no);
--
-- Definition for index document_log_fk (OID = 62744) :
--
ALTER TABLE ONLY document_log
    ADD CONSTRAINT document_log_fk
    FOREIGN KEY (project_name, order_number) REFERENCES project_details(project_name, order_number) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT;
--
-- Definition for index document_details_fk (OID = 62914) :
--
ALTER TABLE ONLY document_details
    ADD CONSTRAINT document_details_fk
    FOREIGN KEY (project_name) REFERENCES project_details(project_name) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT;
--
-- Definition for trigger transaction_details_project (OID = 61779) :
--
CREATE TRIGGER transaction_details_project
    BEFORE INSERT ON transaction_details
    FOR EACH ROW
    EXECUTE PROCEDURE om_func_02 ();
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
COMMENT ON FUNCTION public.om_func_04 (f_firelink_doc_no varchar) IS 'Function to insert documents into the document_log that has never been keyed in.';
COMMENT ON FUNCTION public.om_func_03 () IS 'This function is used to decide which documents does not already exists in table documet_log ad then insert them or update with latest updates
 ';
COMMENT ON COLUMN public.document_log.log_updatedon IS 'Last update when the query was ran';
