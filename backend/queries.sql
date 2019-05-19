SELECT *  FROM transaction_details JOIN project_name =CREATE TABLE public.xmittal_mode (
  mode_id BIGSERIAL,
  mode_name VARCHAR NOT NULL,
  CONSTRAINT xmittal_mode_mode_name_key UNIQUE(mode_name),
  CONSTRAINT xmittal_mode_pkey PRIMARY KEY(mode_id)
)
WITH (oids = false);


ALTER TABLE public.xmittal_mode
  OWNER TO webuser;


select order_number from project_details where project_name = ~'shield';

select * from transaction_details where firelink_doc_no IN (select firelink_doc_no from document_details) order by document_sequence DESC;
select firelink_doc_no from transaction_details where firelink_doc_no IN (select firelink_doc_no from document_details)group by firelink_doc_no;

SELECT * FROM document_details where firelink_doc_no = 'FLK-OTH-2019-0169';



select * from transaction_details where firelink_doc_no = 'SEG-ME-45-MS-FF-006';
select count(log_id) from document_log where firelink_doc_no = 'SEG-ME-45-MS-FF-006';


update transaction_details set project_name = document_details.project_name from document_details where document_details.firelink_doc_no = transaction_details.firelink_doc_no;
update transaction_details set document_tittle = document_details.document_tittle from document_details where document_details.firelink_doc_no = transaction_details.firelink_doc_no;


insert into project_details

UPDATE accounts SET contact_first_name = first_name,
                    contact_last_name = last_name
  FROM salesmen WHERE salesmen.id = accounts.sales_id;


  select * from transaction_details where project_name = NULL;

  delete  from transaction_details where project_name not in (select project_name from project_details "desc");


CREATE TABLE ct(id SERIAL, rowid TEXT, attribute TEXT, value TEXT);
INSERT INTO ct(rowid, attribute, value) VALUES('test1','att1','val1');
INSERT INTO ct(rowid, attribute, value) VALUES('test1','att2','val2');
INSERT INTO ct(rowid, attribute, value) VALUES('test1','att3','val3');
INSERT INTO ct(rowid, attribute, value) VALUES('test1','att4','val4');
INSERT INTO ct(rowid, attribute, value) VALUES('test2','att1','val5');
INSERT INTO ct(rowid, attribute, value) VALUES('test2','att2','val6');
INSERT INTO ct(rowid, attribute, value) VALUES('test2','att3','val7');
INSERT INTO ct(rowid, attribute, value) VALUES('test2','att4','val8');

update project_details set order_number = 200 ;

SELECT *
FROM crosstab(
  'select rowid, attribute, value
   from ct'
    )
AS ct(row_name text, category_1 text, category_2 text, category_3 text, category_4 text);

select document_sequence from transaction_details where firelink_doc_no = 'SEG-ME-45-MS-FF-001C' group by document_sequence order by document_sequence DESC LIMIT 10;
select firelink_doc_no from document_details where firelink_doc_no NOT IN (select firelink_doc_no from transaction_details)group by firelink_doc_no

SELECT * FROM transaction_details where firelink_doc_no = 'SEG-ME-45-MS-FF-001C' order by document_sequence desc limit 10;
--  Crosstab

delete from document_details where project_name not in (select project_name from project_details)
select * from project_details where project_name = 'FIRE FIGHTING SYSTEM INFRASTRUCTURE AT MAIN CAMPUS - QATAR UNIVERSITY'
order by document_sequence desc
select * from crosstab(
'select firelink_doc_no ,direction,approval_status from transaction_details order by document_sequence,firelink_doc_no')
AS
ct(firelink_doc_no VARCHAR, project VARCHAR, document VARCHAR,approval VARCHAR)

select * from crosstab(
'select firelink_doc_no , project_name, document_tittle,approval_status,submit_no,revision_no,transmit_no,transmit_date,direction from transaction_details order by firelink_doc_no')

delete FROM transaction_details where firelink_doc_no = 'FLK-DWG-2019-0095';

--truncate document_log;
select om_func_03();





