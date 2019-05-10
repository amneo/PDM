SELECT *  FROM transaction_details JOIN project_name =CREATE TABLE public.xmittal_mode (
  mode_id BIGSERIAL,
  mode_name VARCHAR NOT NULL,
  CONSTRAINT xmittal_mode_mode_name_key UNIQUE(mode_name),
  CONSTRAINT xmittal_mode_pkey PRIMARY KEY(mode_id)
)
WITH (oids = false);


ALTER TABLE public.xmittal_mode
  OWNER TO webuser;


select * from transaction_details where firelink_doc_no = 'FLK-DMS-2019-0001';


update transaction_details set project_name = document_details.project_name from document_details where document_details.firelink_doc_no = transaction_details.firelink_doc_no;



UPDATE accounts SET contact_first_name = first_name,
                    contact_last_name = last_name
  FROM salesmen WHERE salesmen.id = accounts.sales_id;