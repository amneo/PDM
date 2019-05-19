<?php
namespace PHPMaker2019\pdm;

/**
 * Table class for document_log
 */
class document_log extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $log_id;
	public $firelink_doc_no;
	public $client_doc_no;
	public $order_number;
	public $project_name;
	public $document_tittle;
	public $current_status;
	public $current_status_file;
	public $submit_no_1;
	public $revision_no_1;
	public $direction_1;
	public $planned_date_1;
	public $transmit_date_1;
	public $transmit_no_1;
	public $approval_status_1;
	public $direction_file_1;
	public $submit_no_2;
	public $revision_no_2;
	public $direction_2;
	public $planned_date_2;
	public $transmit_date_2;
	public $transmit_no_2;
	public $approval_status_2;
	public $direction_file_2;
	public $submit_no_3;
	public $revision_no_3;
	public $direction_3;
	public $planned_date_3;
	public $transmit_date_3;
	public $transmit_no_3;
	public $approval_status_3;
	public $direction_file_3;
	public $submit_no_4;
	public $revision_no_4;
	public $direction_4;
	public $planned_date_4;
	public $transmit_date_4;
	public $transmit_no_4;
	public $approval_status_4;
	public $direction_file_4;
	public $submit_no_5;
	public $revision_no_5;
	public $direction_5;
	public $planned_date_5;
	public $transmit_date_5;
	public $transmit_no_5;
	public $approval_status_5;
	public $direction_file_5;
	public $submit_no_6;
	public $revision_no_6;
	public $direction_6;
	public $planned_date_6;
	public $transmit_date_6;
	public $transmit_no_6;
	public $approval_status_6;
	public $direction_file_6;
	public $submit_no_7;
	public $revision_no_7;
	public $direction_7;
	public $planned_date_7;
	public $transmit_date_7;
	public $transmit_no_7;
	public $approval_status_7;
	public $direction_file_7;
	public $submit_no_8;
	public $revision_no_8;
	public $direction_8;
	public $planned_date_8;
	public $transmit_date_8;
	public $transmit_no_8;
	public $approval_status_8;
	public $direction_file_8;
	public $submit_no_9;
	public $revision_no_9;
	public $direction_9;
	public $planned_date_9;
	public $transmit_date_9;
	public $transmit_no_9;
	public $approval_status_9;
	public $direction_file_9;
	public $submit_no_10;
	public $revision_no_10;
	public $direction_10;
	public $planned_date_10;
	public $transmit_date_10;
	public $transmit_no_10;
	public $approval_status_10;
	public $direction_file_10;
	public $log_updatedon;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'document_log';
		$this->TableName = 'document_log';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "\"public\".\"document_log\"";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// log_id
		$this->log_id = new DbField('document_log', 'document_log', 'x_log_id', 'log_id', '"log_id"', 'CAST("log_id" AS varchar(255))', 20, -1, FALSE, '"log_id"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->log_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->log_id->IsPrimaryKey = TRUE; // Primary key field
		$this->log_id->Nullable = FALSE; // NOT NULL field
		$this->log_id->Sortable = FALSE; // Allow sort
		$this->log_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['log_id'] = &$this->log_id;

		// firelink_doc_no
		$this->firelink_doc_no = new DbField('document_log', 'document_log', 'x_firelink_doc_no', 'firelink_doc_no', '"firelink_doc_no"', '"firelink_doc_no"', 200, -1, FALSE, '"firelink_doc_no"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->firelink_doc_no->Nullable = FALSE; // NOT NULL field
		$this->firelink_doc_no->Required = TRUE; // Required field
		$this->firelink_doc_no->Sortable = TRUE; // Allow sort
		$this->fields['firelink_doc_no'] = &$this->firelink_doc_no;

		// client_doc_no
		$this->client_doc_no = new DbField('document_log', 'document_log', 'x_client_doc_no', 'client_doc_no', '"client_doc_no"', '"client_doc_no"', 200, -1, FALSE, '"client_doc_no"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->client_doc_no->Sortable = TRUE; // Allow sort
		$this->fields['client_doc_no'] = &$this->client_doc_no;

		// order_number
		$this->order_number = new DbField('document_log', 'document_log', 'x_order_number', 'order_number', '"order_number"', '"order_number"', 200, -1, FALSE, '"order_number"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->order_number->Nullable = FALSE; // NOT NULL field
		$this->order_number->Required = TRUE; // Required field
		$this->order_number->Sortable = TRUE; // Allow sort
		$this->fields['order_number'] = &$this->order_number;

		// project_name
		$this->project_name = new DbField('document_log', 'document_log', 'x_project_name', 'project_name', '"project_name"', '"project_name"', 200, -1, FALSE, '"project_name"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->project_name->Nullable = FALSE; // NOT NULL field
		$this->project_name->Required = TRUE; // Required field
		$this->project_name->Sortable = TRUE; // Allow sort
		$this->fields['project_name'] = &$this->project_name;

		// document_tittle
		$this->document_tittle = new DbField('document_log', 'document_log', 'x_document_tittle', 'document_tittle', '"document_tittle"', '"document_tittle"', 200, -1, FALSE, '"document_tittle"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->document_tittle->Nullable = FALSE; // NOT NULL field
		$this->document_tittle->Required = TRUE; // Required field
		$this->document_tittle->Sortable = TRUE; // Allow sort
		$this->fields['document_tittle'] = &$this->document_tittle;

		// current_status
		$this->current_status = new DbField('document_log', 'document_log', 'x_current_status', 'current_status', '"current_status"', '"current_status"', 200, -1, FALSE, '"current_status"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->current_status->Sortable = TRUE; // Allow sort
		$this->fields['current_status'] = &$this->current_status;

		// current_status_file
		$this->current_status_file = new DbField('document_log', 'document_log', 'x_current_status_file', 'current_status_file', '"current_status_file"', '"current_status_file"', 200, -1, FALSE, '"current_status_file"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->current_status_file->Sortable = FALSE; // Allow sort
		$this->fields['current_status_file'] = &$this->current_status_file;

		// submit_no_1
		$this->submit_no_1 = new DbField('document_log', 'document_log', 'x_submit_no_1', 'submit_no_1', '"submit_no_1"', 'CAST("submit_no_1" AS varchar(255))', 3, -1, FALSE, '"submit_no_1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_1->Sortable = TRUE; // Allow sort
		$this->submit_no_1->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['submit_no_1'] = &$this->submit_no_1;

		// revision_no_1
		$this->revision_no_1 = new DbField('document_log', 'document_log', 'x_revision_no_1', 'revision_no_1', '"revision_no_1"', '"revision_no_1"', 200, -1, FALSE, '"revision_no_1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_1->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_1'] = &$this->revision_no_1;

		// direction_1
		$this->direction_1 = new DbField('document_log', 'document_log', 'x_direction_1', 'direction_1', '"direction_1"', '"direction_1"', 200, -1, FALSE, '"direction_1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_1->Sortable = TRUE; // Allow sort
		$this->fields['direction_1'] = &$this->direction_1;

		// planned_date_1
		$this->planned_date_1 = new DbField('document_log', 'document_log', 'x_planned_date_1', 'planned_date_1', '"planned_date_1"', CastDateFieldForLike('"planned_date_1"', 0, "DB"), 133, 0, FALSE, '"planned_date_1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_1->Sortable = FALSE; // Allow sort
		$this->planned_date_1->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_1'] = &$this->planned_date_1;

		// transmit_date_1
		$this->transmit_date_1 = new DbField('document_log', 'document_log', 'x_transmit_date_1', 'transmit_date_1', '"transmit_date_1"', CastDateFieldForLike('"transmit_date_1"', 0, "DB"), 133, 0, FALSE, '"transmit_date_1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_1->Sortable = FALSE; // Allow sort
		$this->transmit_date_1->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_1'] = &$this->transmit_date_1;

		// transmit_no_1
		$this->transmit_no_1 = new DbField('document_log', 'document_log', 'x_transmit_no_1', 'transmit_no_1', '"transmit_no_1"', '"transmit_no_1"', 200, -1, FALSE, '"transmit_no_1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_1->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_1'] = &$this->transmit_no_1;

		// approval_status_1
		$this->approval_status_1 = new DbField('document_log', 'document_log', 'x_approval_status_1', 'approval_status_1', '"approval_status_1"', '"approval_status_1"', 200, -1, FALSE, '"approval_status_1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_1->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_1'] = &$this->approval_status_1;

		// direction_file_1
		$this->direction_file_1 = new DbField('document_log', 'document_log', 'x_direction_file_1', 'direction_file_1', '"direction_file_1"', '"direction_file_1"', 200, -1, FALSE, '"direction_file_1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_file_1->Sortable = FALSE; // Allow sort
		$this->fields['direction_file_1'] = &$this->direction_file_1;

		// submit_no_2
		$this->submit_no_2 = new DbField('document_log', 'document_log', 'x_submit_no_2', 'submit_no_2', '"submit_no_2"', 'CAST("submit_no_2" AS varchar(255))', 3, -1, FALSE, '"submit_no_2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_2->Sortable = TRUE; // Allow sort
		$this->submit_no_2->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['submit_no_2'] = &$this->submit_no_2;

		// revision_no_2
		$this->revision_no_2 = new DbField('document_log', 'document_log', 'x_revision_no_2', 'revision_no_2', '"revision_no_2"', '"revision_no_2"', 200, -1, FALSE, '"revision_no_2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_2->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_2'] = &$this->revision_no_2;

		// direction_2
		$this->direction_2 = new DbField('document_log', 'document_log', 'x_direction_2', 'direction_2', '"direction_2"', '"direction_2"', 200, -1, FALSE, '"direction_2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_2->Sortable = TRUE; // Allow sort
		$this->fields['direction_2'] = &$this->direction_2;

		// planned_date_2
		$this->planned_date_2 = new DbField('document_log', 'document_log', 'x_planned_date_2', 'planned_date_2', '"planned_date_2"', CastDateFieldForLike('"planned_date_2"', 0, "DB"), 133, 0, FALSE, '"planned_date_2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_2->Sortable = TRUE; // Allow sort
		$this->planned_date_2->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_2'] = &$this->planned_date_2;

		// transmit_date_2
		$this->transmit_date_2 = new DbField('document_log', 'document_log', 'x_transmit_date_2', 'transmit_date_2', '"transmit_date_2"', CastDateFieldForLike('"transmit_date_2"', 0, "DB"), 133, 0, FALSE, '"transmit_date_2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_2->Sortable = TRUE; // Allow sort
		$this->transmit_date_2->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_2'] = &$this->transmit_date_2;

		// transmit_no_2
		$this->transmit_no_2 = new DbField('document_log', 'document_log', 'x_transmit_no_2', 'transmit_no_2', '"transmit_no_2"', '"transmit_no_2"', 200, -1, FALSE, '"transmit_no_2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_2->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_2'] = &$this->transmit_no_2;

		// approval_status_2
		$this->approval_status_2 = new DbField('document_log', 'document_log', 'x_approval_status_2', 'approval_status_2', '"approval_status_2"', '"approval_status_2"', 200, -1, FALSE, '"approval_status_2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_2->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_2'] = &$this->approval_status_2;

		// direction_file_2
		$this->direction_file_2 = new DbField('document_log', 'document_log', 'x_direction_file_2', 'direction_file_2', '"direction_file_2"', '"direction_file_2"', 200, -1, FALSE, '"direction_file_2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_file_2->Sortable = FALSE; // Allow sort
		$this->fields['direction_file_2'] = &$this->direction_file_2;

		// submit_no_3
		$this->submit_no_3 = new DbField('document_log', 'document_log', 'x_submit_no_3', 'submit_no_3', '"submit_no_3"', 'CAST("submit_no_3" AS varchar(255))', 3, -1, FALSE, '"submit_no_3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_3->Sortable = TRUE; // Allow sort
		$this->submit_no_3->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['submit_no_3'] = &$this->submit_no_3;

		// revision_no_3
		$this->revision_no_3 = new DbField('document_log', 'document_log', 'x_revision_no_3', 'revision_no_3', '"revision_no_3"', '"revision_no_3"', 200, -1, FALSE, '"revision_no_3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_3->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_3'] = &$this->revision_no_3;

		// direction_3
		$this->direction_3 = new DbField('document_log', 'document_log', 'x_direction_3', 'direction_3', '"direction_3"', '"direction_3"', 200, -1, FALSE, '"direction_3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_3->Sortable = TRUE; // Allow sort
		$this->fields['direction_3'] = &$this->direction_3;

		// planned_date_3
		$this->planned_date_3 = new DbField('document_log', 'document_log', 'x_planned_date_3', 'planned_date_3', '"planned_date_3"', CastDateFieldForLike('"planned_date_3"', 0, "DB"), 133, 0, FALSE, '"planned_date_3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_3->Sortable = TRUE; // Allow sort
		$this->planned_date_3->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_3'] = &$this->planned_date_3;

		// transmit_date_3
		$this->transmit_date_3 = new DbField('document_log', 'document_log', 'x_transmit_date_3', 'transmit_date_3', '"transmit_date_3"', CastDateFieldForLike('"transmit_date_3"', 0, "DB"), 133, 0, FALSE, '"transmit_date_3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_3->Sortable = TRUE; // Allow sort
		$this->transmit_date_3->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_3'] = &$this->transmit_date_3;

		// transmit_no_3
		$this->transmit_no_3 = new DbField('document_log', 'document_log', 'x_transmit_no_3', 'transmit_no_3', '"transmit_no_3"', '"transmit_no_3"', 200, -1, FALSE, '"transmit_no_3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_3->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_3'] = &$this->transmit_no_3;

		// approval_status_3
		$this->approval_status_3 = new DbField('document_log', 'document_log', 'x_approval_status_3', 'approval_status_3', '"approval_status_3"', '"approval_status_3"', 200, -1, FALSE, '"approval_status_3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_3->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_3'] = &$this->approval_status_3;

		// direction_file_3
		$this->direction_file_3 = new DbField('document_log', 'document_log', 'x_direction_file_3', 'direction_file_3', '"direction_file_3"', '"direction_file_3"', 200, -1, FALSE, '"direction_file_3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_file_3->Sortable = FALSE; // Allow sort
		$this->fields['direction_file_3'] = &$this->direction_file_3;

		// submit_no_4
		$this->submit_no_4 = new DbField('document_log', 'document_log', 'x_submit_no_4', 'submit_no_4', '"submit_no_4"', 'CAST("submit_no_4" AS varchar(255))', 3, -1, FALSE, '"submit_no_4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_4->Sortable = TRUE; // Allow sort
		$this->submit_no_4->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['submit_no_4'] = &$this->submit_no_4;

		// revision_no_4
		$this->revision_no_4 = new DbField('document_log', 'document_log', 'x_revision_no_4', 'revision_no_4', '"revision_no_4"', '"revision_no_4"', 200, -1, FALSE, '"revision_no_4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_4->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_4'] = &$this->revision_no_4;

		// direction_4
		$this->direction_4 = new DbField('document_log', 'document_log', 'x_direction_4', 'direction_4', '"direction_4"', '"direction_4"', 200, -1, FALSE, '"direction_4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_4->Sortable = TRUE; // Allow sort
		$this->fields['direction_4'] = &$this->direction_4;

		// planned_date_4
		$this->planned_date_4 = new DbField('document_log', 'document_log', 'x_planned_date_4', 'planned_date_4', '"planned_date_4"', CastDateFieldForLike('"planned_date_4"', 0, "DB"), 133, 0, FALSE, '"planned_date_4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_4->Sortable = TRUE; // Allow sort
		$this->planned_date_4->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_4'] = &$this->planned_date_4;

		// transmit_date_4
		$this->transmit_date_4 = new DbField('document_log', 'document_log', 'x_transmit_date_4', 'transmit_date_4', '"transmit_date_4"', CastDateFieldForLike('"transmit_date_4"', 0, "DB"), 133, 0, FALSE, '"transmit_date_4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_4->Sortable = TRUE; // Allow sort
		$this->transmit_date_4->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_4'] = &$this->transmit_date_4;

		// transmit_no_4
		$this->transmit_no_4 = new DbField('document_log', 'document_log', 'x_transmit_no_4', 'transmit_no_4', '"transmit_no_4"', '"transmit_no_4"', 200, -1, FALSE, '"transmit_no_4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_4->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_4'] = &$this->transmit_no_4;

		// approval_status_4
		$this->approval_status_4 = new DbField('document_log', 'document_log', 'x_approval_status_4', 'approval_status_4', '"approval_status_4"', '"approval_status_4"', 200, -1, FALSE, '"approval_status_4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_4->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_4'] = &$this->approval_status_4;

		// direction_file_4
		$this->direction_file_4 = new DbField('document_log', 'document_log', 'x_direction_file_4', 'direction_file_4', '"direction_file_4"', '"direction_file_4"', 200, -1, FALSE, '"direction_file_4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_file_4->Sortable = FALSE; // Allow sort
		$this->fields['direction_file_4'] = &$this->direction_file_4;

		// submit_no_5
		$this->submit_no_5 = new DbField('document_log', 'document_log', 'x_submit_no_5', 'submit_no_5', '"submit_no_5"', 'CAST("submit_no_5" AS varchar(255))', 3, -1, FALSE, '"submit_no_5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_5->Sortable = TRUE; // Allow sort
		$this->submit_no_5->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['submit_no_5'] = &$this->submit_no_5;

		// revision_no_5
		$this->revision_no_5 = new DbField('document_log', 'document_log', 'x_revision_no_5', 'revision_no_5', '"revision_no_5"', '"revision_no_5"', 200, -1, FALSE, '"revision_no_5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_5->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_5'] = &$this->revision_no_5;

		// direction_5
		$this->direction_5 = new DbField('document_log', 'document_log', 'x_direction_5', 'direction_5', '"direction_5"', '"direction_5"', 200, -1, FALSE, '"direction_5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_5->Sortable = TRUE; // Allow sort
		$this->fields['direction_5'] = &$this->direction_5;

		// planned_date_5
		$this->planned_date_5 = new DbField('document_log', 'document_log', 'x_planned_date_5', 'planned_date_5', '"planned_date_5"', CastDateFieldForLike('"planned_date_5"', 0, "DB"), 133, 0, FALSE, '"planned_date_5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_5->Sortable = TRUE; // Allow sort
		$this->planned_date_5->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_5'] = &$this->planned_date_5;

		// transmit_date_5
		$this->transmit_date_5 = new DbField('document_log', 'document_log', 'x_transmit_date_5', 'transmit_date_5', '"transmit_date_5"', CastDateFieldForLike('"transmit_date_5"', 0, "DB"), 133, 0, FALSE, '"transmit_date_5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_5->Sortable = TRUE; // Allow sort
		$this->transmit_date_5->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_5'] = &$this->transmit_date_5;

		// transmit_no_5
		$this->transmit_no_5 = new DbField('document_log', 'document_log', 'x_transmit_no_5', 'transmit_no_5', '"transmit_no_5"', '"transmit_no_5"', 200, -1, FALSE, '"transmit_no_5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_5->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_5'] = &$this->transmit_no_5;

		// approval_status_5
		$this->approval_status_5 = new DbField('document_log', 'document_log', 'x_approval_status_5', 'approval_status_5', '"approval_status_5"', '"approval_status_5"', 200, -1, FALSE, '"approval_status_5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_5->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_5'] = &$this->approval_status_5;

		// direction_file_5
		$this->direction_file_5 = new DbField('document_log', 'document_log', 'x_direction_file_5', 'direction_file_5', '"direction_file_5"', '"direction_file_5"', 200, -1, FALSE, '"direction_file_5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_file_5->Sortable = FALSE; // Allow sort
		$this->fields['direction_file_5'] = &$this->direction_file_5;

		// submit_no_6
		$this->submit_no_6 = new DbField('document_log', 'document_log', 'x_submit_no_6', 'submit_no_6', '"submit_no_6"', 'CAST("submit_no_6" AS varchar(255))', 3, -1, FALSE, '"submit_no_6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_6->Sortable = TRUE; // Allow sort
		$this->submit_no_6->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['submit_no_6'] = &$this->submit_no_6;

		// revision_no_6
		$this->revision_no_6 = new DbField('document_log', 'document_log', 'x_revision_no_6', 'revision_no_6', '"revision_no_6"', '"revision_no_6"', 200, -1, FALSE, '"revision_no_6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_6->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_6'] = &$this->revision_no_6;

		// direction_6
		$this->direction_6 = new DbField('document_log', 'document_log', 'x_direction_6', 'direction_6', '"direction_6"', '"direction_6"', 200, -1, FALSE, '"direction_6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_6->Sortable = TRUE; // Allow sort
		$this->fields['direction_6'] = &$this->direction_6;

		// planned_date_6
		$this->planned_date_6 = new DbField('document_log', 'document_log', 'x_planned_date_6', 'planned_date_6', '"planned_date_6"', CastDateFieldForLike('"planned_date_6"', 0, "DB"), 133, 0, FALSE, '"planned_date_6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_6->Sortable = TRUE; // Allow sort
		$this->planned_date_6->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_6'] = &$this->planned_date_6;

		// transmit_date_6
		$this->transmit_date_6 = new DbField('document_log', 'document_log', 'x_transmit_date_6', 'transmit_date_6', '"transmit_date_6"', CastDateFieldForLike('"transmit_date_6"', 0, "DB"), 133, 0, FALSE, '"transmit_date_6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_6->Sortable = TRUE; // Allow sort
		$this->transmit_date_6->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_6'] = &$this->transmit_date_6;

		// transmit_no_6
		$this->transmit_no_6 = new DbField('document_log', 'document_log', 'x_transmit_no_6', 'transmit_no_6', '"transmit_no_6"', '"transmit_no_6"', 200, -1, FALSE, '"transmit_no_6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_6->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_6'] = &$this->transmit_no_6;

		// approval_status_6
		$this->approval_status_6 = new DbField('document_log', 'document_log', 'x_approval_status_6', 'approval_status_6', '"approval_status_6"', '"approval_status_6"', 200, -1, FALSE, '"approval_status_6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_6->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_6'] = &$this->approval_status_6;

		// direction_file_6
		$this->direction_file_6 = new DbField('document_log', 'document_log', 'x_direction_file_6', 'direction_file_6', '"direction_file_6"', '"direction_file_6"', 200, -1, FALSE, '"direction_file_6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_file_6->Sortable = FALSE; // Allow sort
		$this->fields['direction_file_6'] = &$this->direction_file_6;

		// submit_no_7
		$this->submit_no_7 = new DbField('document_log', 'document_log', 'x_submit_no_7', 'submit_no_7', '"submit_no_7"', 'CAST("submit_no_7" AS varchar(255))', 3, -1, FALSE, '"submit_no_7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_7->Sortable = TRUE; // Allow sort
		$this->submit_no_7->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['submit_no_7'] = &$this->submit_no_7;

		// revision_no_7
		$this->revision_no_7 = new DbField('document_log', 'document_log', 'x_revision_no_7', 'revision_no_7', '"revision_no_7"', '"revision_no_7"', 200, -1, FALSE, '"revision_no_7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_7->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_7'] = &$this->revision_no_7;

		// direction_7
		$this->direction_7 = new DbField('document_log', 'document_log', 'x_direction_7', 'direction_7', '"direction_7"', '"direction_7"', 200, -1, FALSE, '"direction_7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_7->Sortable = TRUE; // Allow sort
		$this->fields['direction_7'] = &$this->direction_7;

		// planned_date_7
		$this->planned_date_7 = new DbField('document_log', 'document_log', 'x_planned_date_7', 'planned_date_7', '"planned_date_7"', CastDateFieldForLike('"planned_date_7"', 0, "DB"), 133, 0, FALSE, '"planned_date_7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_7->Sortable = TRUE; // Allow sort
		$this->planned_date_7->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_7'] = &$this->planned_date_7;

		// transmit_date_7
		$this->transmit_date_7 = new DbField('document_log', 'document_log', 'x_transmit_date_7', 'transmit_date_7', '"transmit_date_7"', CastDateFieldForLike('"transmit_date_7"', 0, "DB"), 133, 0, FALSE, '"transmit_date_7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_7->Sortable = TRUE; // Allow sort
		$this->transmit_date_7->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_7'] = &$this->transmit_date_7;

		// transmit_no_7
		$this->transmit_no_7 = new DbField('document_log', 'document_log', 'x_transmit_no_7', 'transmit_no_7', '"transmit_no_7"', '"transmit_no_7"', 200, -1, FALSE, '"transmit_no_7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_7->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_7'] = &$this->transmit_no_7;

		// approval_status_7
		$this->approval_status_7 = new DbField('document_log', 'document_log', 'x_approval_status_7', 'approval_status_7', '"approval_status_7"', '"approval_status_7"', 200, -1, FALSE, '"approval_status_7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_7->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_7'] = &$this->approval_status_7;

		// direction_file_7
		$this->direction_file_7 = new DbField('document_log', 'document_log', 'x_direction_file_7', 'direction_file_7', '"direction_file_7"', '"direction_file_7"', 200, -1, FALSE, '"direction_file_7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_file_7->Sortable = FALSE; // Allow sort
		$this->fields['direction_file_7'] = &$this->direction_file_7;

		// submit_no_8
		$this->submit_no_8 = new DbField('document_log', 'document_log', 'x_submit_no_8', 'submit_no_8', '"submit_no_8"', 'CAST("submit_no_8" AS varchar(255))', 3, -1, FALSE, '"submit_no_8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_8->Sortable = TRUE; // Allow sort
		$this->submit_no_8->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['submit_no_8'] = &$this->submit_no_8;

		// revision_no_8
		$this->revision_no_8 = new DbField('document_log', 'document_log', 'x_revision_no_8', 'revision_no_8', '"revision_no_8"', '"revision_no_8"', 200, -1, FALSE, '"revision_no_8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_8->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_8'] = &$this->revision_no_8;

		// direction_8
		$this->direction_8 = new DbField('document_log', 'document_log', 'x_direction_8', 'direction_8', '"direction_8"', '"direction_8"', 200, -1, FALSE, '"direction_8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_8->Sortable = TRUE; // Allow sort
		$this->fields['direction_8'] = &$this->direction_8;

		// planned_date_8
		$this->planned_date_8 = new DbField('document_log', 'document_log', 'x_planned_date_8', 'planned_date_8', '"planned_date_8"', CastDateFieldForLike('"planned_date_8"', 0, "DB"), 133, 0, FALSE, '"planned_date_8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_8->Sortable = TRUE; // Allow sort
		$this->planned_date_8->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_8'] = &$this->planned_date_8;

		// transmit_date_8
		$this->transmit_date_8 = new DbField('document_log', 'document_log', 'x_transmit_date_8', 'transmit_date_8', '"transmit_date_8"', CastDateFieldForLike('"transmit_date_8"', 0, "DB"), 133, 0, FALSE, '"transmit_date_8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_8->Sortable = TRUE; // Allow sort
		$this->transmit_date_8->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_8'] = &$this->transmit_date_8;

		// transmit_no_8
		$this->transmit_no_8 = new DbField('document_log', 'document_log', 'x_transmit_no_8', 'transmit_no_8', '"transmit_no_8"', '"transmit_no_8"', 200, -1, FALSE, '"transmit_no_8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_8->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_8'] = &$this->transmit_no_8;

		// approval_status_8
		$this->approval_status_8 = new DbField('document_log', 'document_log', 'x_approval_status_8', 'approval_status_8', '"approval_status_8"', '"approval_status_8"', 200, -1, FALSE, '"approval_status_8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_8->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_8'] = &$this->approval_status_8;

		// direction_file_8
		$this->direction_file_8 = new DbField('document_log', 'document_log', 'x_direction_file_8', 'direction_file_8', '"direction_file_8"', '"direction_file_8"', 200, -1, FALSE, '"direction_file_8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_file_8->Sortable = FALSE; // Allow sort
		$this->fields['direction_file_8'] = &$this->direction_file_8;

		// submit_no_9
		$this->submit_no_9 = new DbField('document_log', 'document_log', 'x_submit_no_9', 'submit_no_9', '"submit_no_9"', 'CAST("submit_no_9" AS varchar(255))', 3, -1, FALSE, '"submit_no_9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_9->Sortable = TRUE; // Allow sort
		$this->submit_no_9->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['submit_no_9'] = &$this->submit_no_9;

		// revision_no_9
		$this->revision_no_9 = new DbField('document_log', 'document_log', 'x_revision_no_9', 'revision_no_9', '"revision_no_9"', '"revision_no_9"', 200, -1, FALSE, '"revision_no_9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_9->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_9'] = &$this->revision_no_9;

		// direction_9
		$this->direction_9 = new DbField('document_log', 'document_log', 'x_direction_9', 'direction_9', '"direction_9"', '"direction_9"', 200, -1, FALSE, '"direction_9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_9->Sortable = TRUE; // Allow sort
		$this->fields['direction_9'] = &$this->direction_9;

		// planned_date_9
		$this->planned_date_9 = new DbField('document_log', 'document_log', 'x_planned_date_9', 'planned_date_9', '"planned_date_9"', CastDateFieldForLike('"planned_date_9"', 0, "DB"), 133, 0, FALSE, '"planned_date_9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_9->Sortable = TRUE; // Allow sort
		$this->planned_date_9->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_9'] = &$this->planned_date_9;

		// transmit_date_9
		$this->transmit_date_9 = new DbField('document_log', 'document_log', 'x_transmit_date_9', 'transmit_date_9', '"transmit_date_9"', CastDateFieldForLike('"transmit_date_9"', 0, "DB"), 133, 0, FALSE, '"transmit_date_9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_9->Sortable = TRUE; // Allow sort
		$this->transmit_date_9->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_9'] = &$this->transmit_date_9;

		// transmit_no_9
		$this->transmit_no_9 = new DbField('document_log', 'document_log', 'x_transmit_no_9', 'transmit_no_9', '"transmit_no_9"', '"transmit_no_9"', 200, -1, FALSE, '"transmit_no_9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_9->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_9'] = &$this->transmit_no_9;

		// approval_status_9
		$this->approval_status_9 = new DbField('document_log', 'document_log', 'x_approval_status_9', 'approval_status_9', '"approval_status_9"', '"approval_status_9"', 200, -1, FALSE, '"approval_status_9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_9->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_9'] = &$this->approval_status_9;

		// direction_file_9
		$this->direction_file_9 = new DbField('document_log', 'document_log', 'x_direction_file_9', 'direction_file_9', '"direction_file_9"', '"direction_file_9"', 200, -1, FALSE, '"direction_file_9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_file_9->Sortable = FALSE; // Allow sort
		$this->fields['direction_file_9'] = &$this->direction_file_9;

		// submit_no_10
		$this->submit_no_10 = new DbField('document_log', 'document_log', 'x_submit_no_10', 'submit_no_10', '"submit_no_10"', 'CAST("submit_no_10" AS varchar(255))', 3, -1, FALSE, '"submit_no_10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_10->Sortable = TRUE; // Allow sort
		$this->submit_no_10->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['submit_no_10'] = &$this->submit_no_10;

		// revision_no_10
		$this->revision_no_10 = new DbField('document_log', 'document_log', 'x_revision_no_10', 'revision_no_10', '"revision_no_10"', '"revision_no_10"', 200, -1, FALSE, '"revision_no_10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_10->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_10'] = &$this->revision_no_10;

		// direction_10
		$this->direction_10 = new DbField('document_log', 'document_log', 'x_direction_10', 'direction_10', '"direction_10"', '"direction_10"', 200, -1, FALSE, '"direction_10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_10->Sortable = TRUE; // Allow sort
		$this->fields['direction_10'] = &$this->direction_10;

		// planned_date_10
		$this->planned_date_10 = new DbField('document_log', 'document_log', 'x_planned_date_10', 'planned_date_10', '"planned_date_10"', CastDateFieldForLike('"planned_date_10"', 0, "DB"), 133, 0, FALSE, '"planned_date_10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_10->Sortable = TRUE; // Allow sort
		$this->planned_date_10->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_10'] = &$this->planned_date_10;

		// transmit_date_10
		$this->transmit_date_10 = new DbField('document_log', 'document_log', 'x_transmit_date_10', 'transmit_date_10', '"transmit_date_10"', CastDateFieldForLike('"transmit_date_10"', 0, "DB"), 133, 0, FALSE, '"transmit_date_10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_10->Sortable = TRUE; // Allow sort
		$this->transmit_date_10->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_10'] = &$this->transmit_date_10;

		// transmit_no_10
		$this->transmit_no_10 = new DbField('document_log', 'document_log', 'x_transmit_no_10', 'transmit_no_10', '"transmit_no_10"', '"transmit_no_10"', 200, -1, FALSE, '"transmit_no_10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_10->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_10'] = &$this->transmit_no_10;

		// approval_status_10
		$this->approval_status_10 = new DbField('document_log', 'document_log', 'x_approval_status_10', 'approval_status_10', '"approval_status_10"', '"approval_status_10"', 200, -1, FALSE, '"approval_status_10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_10->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_10'] = &$this->approval_status_10;

		// direction_file_10
		$this->direction_file_10 = new DbField('document_log', 'document_log', 'x_direction_file_10', 'direction_file_10', '"direction_file_10"', '"direction_file_10"', 200, -1, FALSE, '"direction_file_10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_file_10->Sortable = FALSE; // Allow sort
		$this->fields['direction_file_10'] = &$this->direction_file_10;

		// log_updatedon
		$this->log_updatedon = new DbField('document_log', 'document_log', 'x_log_updatedon', 'log_updatedon', '"log_updatedon"', CastDateFieldForLike('"log_updatedon"', 109, "DB"), 135, 109, FALSE, '"log_updatedon"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->log_updatedon->Sortable = TRUE; // Allow sort
		$this->log_updatedon->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['log_updatedon'] = &$this->log_updatedon;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Multiple column sort
	public function updateSort(&$fld, $ctrl)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($ctrl) {
				$orderBy = $this->getSessionOrderBy();
				if (ContainsString($orderBy, $sortField . " " . $lastSort)) {
					$orderBy = str_replace($sortField . " " . $lastSort, $sortField . " " . $thisSort, $orderBy);
				} else {
					if ($orderBy <> "")
						$orderBy .= ", ";
					$orderBy .= $sortField . " " . $thisSort;
				}
				$this->setSessionOrderBy($orderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
			}
		} else {
			if (!$ctrl)
				$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "\"public\".\"document_log\"";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->log_id->setDbValue($conn->getOne("SELECT currval('document_log_log_id_seq'::regclass)"));
			$rs['log_id'] = $this->log_id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('log_id', $rs))
				AddFilter($where, QuotedName('log_id', $this->Dbid) . '=' . QuotedValue($rs['log_id'], $this->log_id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->log_id->DbValue = $row['log_id'];
		$this->firelink_doc_no->DbValue = $row['firelink_doc_no'];
		$this->client_doc_no->DbValue = $row['client_doc_no'];
		$this->order_number->DbValue = $row['order_number'];
		$this->project_name->DbValue = $row['project_name'];
		$this->document_tittle->DbValue = $row['document_tittle'];
		$this->current_status->DbValue = $row['current_status'];
		$this->current_status_file->DbValue = $row['current_status_file'];
		$this->submit_no_1->DbValue = $row['submit_no_1'];
		$this->revision_no_1->DbValue = $row['revision_no_1'];
		$this->direction_1->DbValue = $row['direction_1'];
		$this->planned_date_1->DbValue = $row['planned_date_1'];
		$this->transmit_date_1->DbValue = $row['transmit_date_1'];
		$this->transmit_no_1->DbValue = $row['transmit_no_1'];
		$this->approval_status_1->DbValue = $row['approval_status_1'];
		$this->direction_file_1->DbValue = $row['direction_file_1'];
		$this->submit_no_2->DbValue = $row['submit_no_2'];
		$this->revision_no_2->DbValue = $row['revision_no_2'];
		$this->direction_2->DbValue = $row['direction_2'];
		$this->planned_date_2->DbValue = $row['planned_date_2'];
		$this->transmit_date_2->DbValue = $row['transmit_date_2'];
		$this->transmit_no_2->DbValue = $row['transmit_no_2'];
		$this->approval_status_2->DbValue = $row['approval_status_2'];
		$this->direction_file_2->DbValue = $row['direction_file_2'];
		$this->submit_no_3->DbValue = $row['submit_no_3'];
		$this->revision_no_3->DbValue = $row['revision_no_3'];
		$this->direction_3->DbValue = $row['direction_3'];
		$this->planned_date_3->DbValue = $row['planned_date_3'];
		$this->transmit_date_3->DbValue = $row['transmit_date_3'];
		$this->transmit_no_3->DbValue = $row['transmit_no_3'];
		$this->approval_status_3->DbValue = $row['approval_status_3'];
		$this->direction_file_3->DbValue = $row['direction_file_3'];
		$this->submit_no_4->DbValue = $row['submit_no_4'];
		$this->revision_no_4->DbValue = $row['revision_no_4'];
		$this->direction_4->DbValue = $row['direction_4'];
		$this->planned_date_4->DbValue = $row['planned_date_4'];
		$this->transmit_date_4->DbValue = $row['transmit_date_4'];
		$this->transmit_no_4->DbValue = $row['transmit_no_4'];
		$this->approval_status_4->DbValue = $row['approval_status_4'];
		$this->direction_file_4->DbValue = $row['direction_file_4'];
		$this->submit_no_5->DbValue = $row['submit_no_5'];
		$this->revision_no_5->DbValue = $row['revision_no_5'];
		$this->direction_5->DbValue = $row['direction_5'];
		$this->planned_date_5->DbValue = $row['planned_date_5'];
		$this->transmit_date_5->DbValue = $row['transmit_date_5'];
		$this->transmit_no_5->DbValue = $row['transmit_no_5'];
		$this->approval_status_5->DbValue = $row['approval_status_5'];
		$this->direction_file_5->DbValue = $row['direction_file_5'];
		$this->submit_no_6->DbValue = $row['submit_no_6'];
		$this->revision_no_6->DbValue = $row['revision_no_6'];
		$this->direction_6->DbValue = $row['direction_6'];
		$this->planned_date_6->DbValue = $row['planned_date_6'];
		$this->transmit_date_6->DbValue = $row['transmit_date_6'];
		$this->transmit_no_6->DbValue = $row['transmit_no_6'];
		$this->approval_status_6->DbValue = $row['approval_status_6'];
		$this->direction_file_6->DbValue = $row['direction_file_6'];
		$this->submit_no_7->DbValue = $row['submit_no_7'];
		$this->revision_no_7->DbValue = $row['revision_no_7'];
		$this->direction_7->DbValue = $row['direction_7'];
		$this->planned_date_7->DbValue = $row['planned_date_7'];
		$this->transmit_date_7->DbValue = $row['transmit_date_7'];
		$this->transmit_no_7->DbValue = $row['transmit_no_7'];
		$this->approval_status_7->DbValue = $row['approval_status_7'];
		$this->direction_file_7->DbValue = $row['direction_file_7'];
		$this->submit_no_8->DbValue = $row['submit_no_8'];
		$this->revision_no_8->DbValue = $row['revision_no_8'];
		$this->direction_8->DbValue = $row['direction_8'];
		$this->planned_date_8->DbValue = $row['planned_date_8'];
		$this->transmit_date_8->DbValue = $row['transmit_date_8'];
		$this->transmit_no_8->DbValue = $row['transmit_no_8'];
		$this->approval_status_8->DbValue = $row['approval_status_8'];
		$this->direction_file_8->DbValue = $row['direction_file_8'];
		$this->submit_no_9->DbValue = $row['submit_no_9'];
		$this->revision_no_9->DbValue = $row['revision_no_9'];
		$this->direction_9->DbValue = $row['direction_9'];
		$this->planned_date_9->DbValue = $row['planned_date_9'];
		$this->transmit_date_9->DbValue = $row['transmit_date_9'];
		$this->transmit_no_9->DbValue = $row['transmit_no_9'];
		$this->approval_status_9->DbValue = $row['approval_status_9'];
		$this->direction_file_9->DbValue = $row['direction_file_9'];
		$this->submit_no_10->DbValue = $row['submit_no_10'];
		$this->revision_no_10->DbValue = $row['revision_no_10'];
		$this->direction_10->DbValue = $row['direction_10'];
		$this->planned_date_10->DbValue = $row['planned_date_10'];
		$this->transmit_date_10->DbValue = $row['transmit_date_10'];
		$this->transmit_no_10->DbValue = $row['transmit_no_10'];
		$this->approval_status_10->DbValue = $row['approval_status_10'];
		$this->direction_file_10->DbValue = $row['direction_file_10'];
		$this->log_updatedon->DbValue = $row['log_updatedon'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "\"log_id\" = @log_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('log_id', $row) ? $row['log_id'] : NULL) : $this->log_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@log_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "document_loglist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "document_logview.php")
			return $Language->phrase("View");
		elseif ($pageName == "document_logedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "document_logadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "document_loglist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("document_logview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("document_logview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "document_logadd.php?" . $this->getUrlParm($parm);
		else
			$url = "document_logadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("document_logedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("document_logadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("document_logdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "log_id:" . JsonEncode($this->log_id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->log_id->CurrentValue != NULL) {
			$url .= "log_id=" . urlencode($this->log_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("log_id") !== NULL)
				$arKeys[] = Param("log_id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->log_id->CurrentValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->log_id->setDbValue($rs->fields('log_id'));
		$this->firelink_doc_no->setDbValue($rs->fields('firelink_doc_no'));
		$this->client_doc_no->setDbValue($rs->fields('client_doc_no'));
		$this->order_number->setDbValue($rs->fields('order_number'));
		$this->project_name->setDbValue($rs->fields('project_name'));
		$this->document_tittle->setDbValue($rs->fields('document_tittle'));
		$this->current_status->setDbValue($rs->fields('current_status'));
		$this->current_status_file->setDbValue($rs->fields('current_status_file'));
		$this->submit_no_1->setDbValue($rs->fields('submit_no_1'));
		$this->revision_no_1->setDbValue($rs->fields('revision_no_1'));
		$this->direction_1->setDbValue($rs->fields('direction_1'));
		$this->planned_date_1->setDbValue($rs->fields('planned_date_1'));
		$this->transmit_date_1->setDbValue($rs->fields('transmit_date_1'));
		$this->transmit_no_1->setDbValue($rs->fields('transmit_no_1'));
		$this->approval_status_1->setDbValue($rs->fields('approval_status_1'));
		$this->direction_file_1->setDbValue($rs->fields('direction_file_1'));
		$this->submit_no_2->setDbValue($rs->fields('submit_no_2'));
		$this->revision_no_2->setDbValue($rs->fields('revision_no_2'));
		$this->direction_2->setDbValue($rs->fields('direction_2'));
		$this->planned_date_2->setDbValue($rs->fields('planned_date_2'));
		$this->transmit_date_2->setDbValue($rs->fields('transmit_date_2'));
		$this->transmit_no_2->setDbValue($rs->fields('transmit_no_2'));
		$this->approval_status_2->setDbValue($rs->fields('approval_status_2'));
		$this->direction_file_2->setDbValue($rs->fields('direction_file_2'));
		$this->submit_no_3->setDbValue($rs->fields('submit_no_3'));
		$this->revision_no_3->setDbValue($rs->fields('revision_no_3'));
		$this->direction_3->setDbValue($rs->fields('direction_3'));
		$this->planned_date_3->setDbValue($rs->fields('planned_date_3'));
		$this->transmit_date_3->setDbValue($rs->fields('transmit_date_3'));
		$this->transmit_no_3->setDbValue($rs->fields('transmit_no_3'));
		$this->approval_status_3->setDbValue($rs->fields('approval_status_3'));
		$this->direction_file_3->setDbValue($rs->fields('direction_file_3'));
		$this->submit_no_4->setDbValue($rs->fields('submit_no_4'));
		$this->revision_no_4->setDbValue($rs->fields('revision_no_4'));
		$this->direction_4->setDbValue($rs->fields('direction_4'));
		$this->planned_date_4->setDbValue($rs->fields('planned_date_4'));
		$this->transmit_date_4->setDbValue($rs->fields('transmit_date_4'));
		$this->transmit_no_4->setDbValue($rs->fields('transmit_no_4'));
		$this->approval_status_4->setDbValue($rs->fields('approval_status_4'));
		$this->direction_file_4->setDbValue($rs->fields('direction_file_4'));
		$this->submit_no_5->setDbValue($rs->fields('submit_no_5'));
		$this->revision_no_5->setDbValue($rs->fields('revision_no_5'));
		$this->direction_5->setDbValue($rs->fields('direction_5'));
		$this->planned_date_5->setDbValue($rs->fields('planned_date_5'));
		$this->transmit_date_5->setDbValue($rs->fields('transmit_date_5'));
		$this->transmit_no_5->setDbValue($rs->fields('transmit_no_5'));
		$this->approval_status_5->setDbValue($rs->fields('approval_status_5'));
		$this->direction_file_5->setDbValue($rs->fields('direction_file_5'));
		$this->submit_no_6->setDbValue($rs->fields('submit_no_6'));
		$this->revision_no_6->setDbValue($rs->fields('revision_no_6'));
		$this->direction_6->setDbValue($rs->fields('direction_6'));
		$this->planned_date_6->setDbValue($rs->fields('planned_date_6'));
		$this->transmit_date_6->setDbValue($rs->fields('transmit_date_6'));
		$this->transmit_no_6->setDbValue($rs->fields('transmit_no_6'));
		$this->approval_status_6->setDbValue($rs->fields('approval_status_6'));
		$this->direction_file_6->setDbValue($rs->fields('direction_file_6'));
		$this->submit_no_7->setDbValue($rs->fields('submit_no_7'));
		$this->revision_no_7->setDbValue($rs->fields('revision_no_7'));
		$this->direction_7->setDbValue($rs->fields('direction_7'));
		$this->planned_date_7->setDbValue($rs->fields('planned_date_7'));
		$this->transmit_date_7->setDbValue($rs->fields('transmit_date_7'));
		$this->transmit_no_7->setDbValue($rs->fields('transmit_no_7'));
		$this->approval_status_7->setDbValue($rs->fields('approval_status_7'));
		$this->direction_file_7->setDbValue($rs->fields('direction_file_7'));
		$this->submit_no_8->setDbValue($rs->fields('submit_no_8'));
		$this->revision_no_8->setDbValue($rs->fields('revision_no_8'));
		$this->direction_8->setDbValue($rs->fields('direction_8'));
		$this->planned_date_8->setDbValue($rs->fields('planned_date_8'));
		$this->transmit_date_8->setDbValue($rs->fields('transmit_date_8'));
		$this->transmit_no_8->setDbValue($rs->fields('transmit_no_8'));
		$this->approval_status_8->setDbValue($rs->fields('approval_status_8'));
		$this->direction_file_8->setDbValue($rs->fields('direction_file_8'));
		$this->submit_no_9->setDbValue($rs->fields('submit_no_9'));
		$this->revision_no_9->setDbValue($rs->fields('revision_no_9'));
		$this->direction_9->setDbValue($rs->fields('direction_9'));
		$this->planned_date_9->setDbValue($rs->fields('planned_date_9'));
		$this->transmit_date_9->setDbValue($rs->fields('transmit_date_9'));
		$this->transmit_no_9->setDbValue($rs->fields('transmit_no_9'));
		$this->approval_status_9->setDbValue($rs->fields('approval_status_9'));
		$this->direction_file_9->setDbValue($rs->fields('direction_file_9'));
		$this->submit_no_10->setDbValue($rs->fields('submit_no_10'));
		$this->revision_no_10->setDbValue($rs->fields('revision_no_10'));
		$this->direction_10->setDbValue($rs->fields('direction_10'));
		$this->planned_date_10->setDbValue($rs->fields('planned_date_10'));
		$this->transmit_date_10->setDbValue($rs->fields('transmit_date_10'));
		$this->transmit_no_10->setDbValue($rs->fields('transmit_no_10'));
		$this->approval_status_10->setDbValue($rs->fields('approval_status_10'));
		$this->direction_file_10->setDbValue($rs->fields('direction_file_10'));
		$this->log_updatedon->setDbValue($rs->fields('log_updatedon'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// log_id

		$this->log_id->CellCssStyle = "white-space: nowrap;";

		// firelink_doc_no
		// client_doc_no
		// order_number
		// project_name
		// document_tittle
		// current_status
		// current_status_file

		$this->current_status_file->CellCssStyle = "white-space: nowrap;";

		// submit_no_1
		// revision_no_1
		// direction_1
		// planned_date_1

		$this->planned_date_1->CellCssStyle = "white-space: nowrap;";

		// transmit_date_1
		$this->transmit_date_1->CellCssStyle = "white-space: nowrap;";

		// transmit_no_1
		// approval_status_1
		// direction_file_1

		$this->direction_file_1->CellCssStyle = "white-space: nowrap;";

		// submit_no_2
		// revision_no_2
		// direction_2
		// planned_date_2
		// transmit_date_2
		// transmit_no_2
		// approval_status_2
		// direction_file_2

		$this->direction_file_2->CellCssStyle = "white-space: nowrap;";

		// submit_no_3
		// revision_no_3
		// direction_3
		// planned_date_3
		// transmit_date_3
		// transmit_no_3
		// approval_status_3
		// direction_file_3

		$this->direction_file_3->CellCssStyle = "white-space: nowrap;";

		// submit_no_4
		// revision_no_4
		// direction_4
		// planned_date_4
		// transmit_date_4
		// transmit_no_4
		// approval_status_4
		// direction_file_4

		$this->direction_file_4->CellCssStyle = "white-space: nowrap;";

		// submit_no_5
		// revision_no_5
		// direction_5
		// planned_date_5
		// transmit_date_5
		// transmit_no_5
		// approval_status_5
		// direction_file_5

		$this->direction_file_5->CellCssStyle = "white-space: nowrap;";

		// submit_no_6
		// revision_no_6
		// direction_6
		// planned_date_6
		// transmit_date_6
		// transmit_no_6
		// approval_status_6
		// direction_file_6

		$this->direction_file_6->CellCssStyle = "white-space: nowrap;";

		// submit_no_7
		// revision_no_7
		// direction_7
		// planned_date_7
		// transmit_date_7
		// transmit_no_7
		// approval_status_7
		// direction_file_7

		$this->direction_file_7->CellCssStyle = "white-space: nowrap;";

		// submit_no_8
		// revision_no_8
		// direction_8
		// planned_date_8
		// transmit_date_8
		// transmit_no_8
		// approval_status_8
		// direction_file_8

		$this->direction_file_8->CellCssStyle = "white-space: nowrap;";

		// submit_no_9
		// revision_no_9
		// direction_9
		// planned_date_9
		// transmit_date_9
		// transmit_no_9
		// approval_status_9
		// direction_file_9

		$this->direction_file_9->CellCssStyle = "white-space: nowrap;";

		// submit_no_10
		// revision_no_10
		// direction_10
		// planned_date_10
		// transmit_date_10
		// transmit_no_10
		// approval_status_10
		// direction_file_10

		$this->direction_file_10->CellCssStyle = "white-space: nowrap;";

		// log_updatedon
		// log_id

		$this->log_id->ViewValue = $this->log_id->CurrentValue;
		$this->log_id->ViewCustomAttributes = "";

		// firelink_doc_no
		$this->firelink_doc_no->ViewValue = $this->firelink_doc_no->CurrentValue;
		$this->firelink_doc_no->ViewCustomAttributes = "";

		// client_doc_no
		$this->client_doc_no->ViewValue = $this->client_doc_no->CurrentValue;
		$this->client_doc_no->ViewCustomAttributes = "";

		// order_number
		$this->order_number->ViewValue = $this->order_number->CurrentValue;
		$this->order_number->ViewCustomAttributes = "";

		// project_name
		$this->project_name->ViewValue = $this->project_name->CurrentValue;
		$this->project_name->ViewCustomAttributes = "";

		// document_tittle
		$this->document_tittle->ViewValue = $this->document_tittle->CurrentValue;
		$this->document_tittle->ViewCustomAttributes = "";

		// current_status
		$this->current_status->ViewValue = $this->current_status->CurrentValue;
		$this->current_status->ViewCustomAttributes = "";

		// current_status_file
		$this->current_status_file->ViewValue = $this->current_status_file->CurrentValue;
		$this->current_status_file->ViewCustomAttributes = "";

		// submit_no_1
		$this->submit_no_1->ViewValue = $this->submit_no_1->CurrentValue;
		$this->submit_no_1->ViewCustomAttributes = "";

		// revision_no_1
		$this->revision_no_1->ViewValue = $this->revision_no_1->CurrentValue;
		$this->revision_no_1->ViewCustomAttributes = "";

		// direction_1
		$this->direction_1->ViewValue = $this->direction_1->CurrentValue;
		$this->direction_1->ViewCustomAttributes = "";

		// planned_date_1
		$this->planned_date_1->ViewValue = $this->planned_date_1->CurrentValue;
		$this->planned_date_1->ViewValue = FormatDateTime($this->planned_date_1->ViewValue, 0);
		$this->planned_date_1->ViewCustomAttributes = "";

		// transmit_date_1
		$this->transmit_date_1->ViewValue = $this->transmit_date_1->CurrentValue;
		$this->transmit_date_1->ViewValue = FormatDateTime($this->transmit_date_1->ViewValue, 0);
		$this->transmit_date_1->ViewCustomAttributes = "";

		// transmit_no_1
		$this->transmit_no_1->ViewValue = $this->transmit_no_1->CurrentValue;
		$this->transmit_no_1->ViewCustomAttributes = "";

		// approval_status_1
		$this->approval_status_1->ViewValue = $this->approval_status_1->CurrentValue;
		$this->approval_status_1->ViewCustomAttributes = "";

		// direction_file_1
		$this->direction_file_1->ViewValue = $this->direction_file_1->CurrentValue;
		$this->direction_file_1->ViewCustomAttributes = "";

		// submit_no_2
		$this->submit_no_2->ViewValue = $this->submit_no_2->CurrentValue;
		$this->submit_no_2->ViewCustomAttributes = "";

		// revision_no_2
		$this->revision_no_2->ViewValue = $this->revision_no_2->CurrentValue;
		$this->revision_no_2->ViewCustomAttributes = "";

		// direction_2
		$this->direction_2->ViewValue = $this->direction_2->CurrentValue;
		$this->direction_2->ViewCustomAttributes = "";

		// planned_date_2
		$this->planned_date_2->ViewValue = $this->planned_date_2->CurrentValue;
		$this->planned_date_2->ViewValue = FormatDateTime($this->planned_date_2->ViewValue, 0);
		$this->planned_date_2->ViewCustomAttributes = "";

		// transmit_date_2
		$this->transmit_date_2->ViewValue = $this->transmit_date_2->CurrentValue;
		$this->transmit_date_2->ViewValue = FormatDateTime($this->transmit_date_2->ViewValue, 0);
		$this->transmit_date_2->ViewCustomAttributes = "";

		// transmit_no_2
		$this->transmit_no_2->ViewValue = $this->transmit_no_2->CurrentValue;
		$this->transmit_no_2->ViewCustomAttributes = "";

		// approval_status_2
		$this->approval_status_2->ViewValue = $this->approval_status_2->CurrentValue;
		$this->approval_status_2->ViewCustomAttributes = "";

		// direction_file_2
		$this->direction_file_2->ViewValue = $this->direction_file_2->CurrentValue;
		$this->direction_file_2->ViewCustomAttributes = "";

		// submit_no_3
		$this->submit_no_3->ViewValue = $this->submit_no_3->CurrentValue;
		$this->submit_no_3->ViewCustomAttributes = "";

		// revision_no_3
		$this->revision_no_3->ViewValue = $this->revision_no_3->CurrentValue;
		$this->revision_no_3->ViewCustomAttributes = "";

		// direction_3
		$this->direction_3->ViewValue = $this->direction_3->CurrentValue;
		$this->direction_3->ViewCustomAttributes = "";

		// planned_date_3
		$this->planned_date_3->ViewValue = $this->planned_date_3->CurrentValue;
		$this->planned_date_3->ViewValue = FormatDateTime($this->planned_date_3->ViewValue, 0);
		$this->planned_date_3->ViewCustomAttributes = "";

		// transmit_date_3
		$this->transmit_date_3->ViewValue = $this->transmit_date_3->CurrentValue;
		$this->transmit_date_3->ViewValue = FormatDateTime($this->transmit_date_3->ViewValue, 0);
		$this->transmit_date_3->ViewCustomAttributes = "";

		// transmit_no_3
		$this->transmit_no_3->ViewValue = $this->transmit_no_3->CurrentValue;
		$this->transmit_no_3->ViewCustomAttributes = "";

		// approval_status_3
		$this->approval_status_3->ViewValue = $this->approval_status_3->CurrentValue;
		$this->approval_status_3->ViewCustomAttributes = "";

		// direction_file_3
		$this->direction_file_3->ViewValue = $this->direction_file_3->CurrentValue;
		$this->direction_file_3->ViewCustomAttributes = "";

		// submit_no_4
		$this->submit_no_4->ViewValue = $this->submit_no_4->CurrentValue;
		$this->submit_no_4->ViewCustomAttributes = "";

		// revision_no_4
		$this->revision_no_4->ViewValue = $this->revision_no_4->CurrentValue;
		$this->revision_no_4->ViewCustomAttributes = "";

		// direction_4
		$this->direction_4->ViewValue = $this->direction_4->CurrentValue;
		$this->direction_4->ViewCustomAttributes = "";

		// planned_date_4
		$this->planned_date_4->ViewValue = $this->planned_date_4->CurrentValue;
		$this->planned_date_4->ViewValue = FormatDateTime($this->planned_date_4->ViewValue, 0);
		$this->planned_date_4->ViewCustomAttributes = "";

		// transmit_date_4
		$this->transmit_date_4->ViewValue = $this->transmit_date_4->CurrentValue;
		$this->transmit_date_4->ViewValue = FormatDateTime($this->transmit_date_4->ViewValue, 0);
		$this->transmit_date_4->ViewCustomAttributes = "";

		// transmit_no_4
		$this->transmit_no_4->ViewValue = $this->transmit_no_4->CurrentValue;
		$this->transmit_no_4->ViewCustomAttributes = "";

		// approval_status_4
		$this->approval_status_4->ViewValue = $this->approval_status_4->CurrentValue;
		$this->approval_status_4->ViewCustomAttributes = "";

		// direction_file_4
		$this->direction_file_4->ViewValue = $this->direction_file_4->CurrentValue;
		$this->direction_file_4->ViewCustomAttributes = "";

		// submit_no_5
		$this->submit_no_5->ViewValue = $this->submit_no_5->CurrentValue;
		$this->submit_no_5->ViewCustomAttributes = "";

		// revision_no_5
		$this->revision_no_5->ViewValue = $this->revision_no_5->CurrentValue;
		$this->revision_no_5->ViewCustomAttributes = "";

		// direction_5
		$this->direction_5->ViewValue = $this->direction_5->CurrentValue;
		$this->direction_5->ViewCustomAttributes = "";

		// planned_date_5
		$this->planned_date_5->ViewValue = $this->planned_date_5->CurrentValue;
		$this->planned_date_5->ViewValue = FormatDateTime($this->planned_date_5->ViewValue, 0);
		$this->planned_date_5->ViewCustomAttributes = "";

		// transmit_date_5
		$this->transmit_date_5->ViewValue = $this->transmit_date_5->CurrentValue;
		$this->transmit_date_5->ViewValue = FormatDateTime($this->transmit_date_5->ViewValue, 0);
		$this->transmit_date_5->ViewCustomAttributes = "";

		// transmit_no_5
		$this->transmit_no_5->ViewValue = $this->transmit_no_5->CurrentValue;
		$this->transmit_no_5->ViewCustomAttributes = "";

		// approval_status_5
		$this->approval_status_5->ViewValue = $this->approval_status_5->CurrentValue;
		$this->approval_status_5->ViewCustomAttributes = "";

		// direction_file_5
		$this->direction_file_5->ViewValue = $this->direction_file_5->CurrentValue;
		$this->direction_file_5->ViewCustomAttributes = "";

		// submit_no_6
		$this->submit_no_6->ViewValue = $this->submit_no_6->CurrentValue;
		$this->submit_no_6->ViewCustomAttributes = "";

		// revision_no_6
		$this->revision_no_6->ViewValue = $this->revision_no_6->CurrentValue;
		$this->revision_no_6->ViewCustomAttributes = "";

		// direction_6
		$this->direction_6->ViewValue = $this->direction_6->CurrentValue;
		$this->direction_6->ViewCustomAttributes = "";

		// planned_date_6
		$this->planned_date_6->ViewValue = $this->planned_date_6->CurrentValue;
		$this->planned_date_6->ViewValue = FormatDateTime($this->planned_date_6->ViewValue, 0);
		$this->planned_date_6->ViewCustomAttributes = "";

		// transmit_date_6
		$this->transmit_date_6->ViewValue = $this->transmit_date_6->CurrentValue;
		$this->transmit_date_6->ViewValue = FormatDateTime($this->transmit_date_6->ViewValue, 0);
		$this->transmit_date_6->ViewCustomAttributes = "";

		// transmit_no_6
		$this->transmit_no_6->ViewValue = $this->transmit_no_6->CurrentValue;
		$this->transmit_no_6->ViewCustomAttributes = "";

		// approval_status_6
		$this->approval_status_6->ViewValue = $this->approval_status_6->CurrentValue;
		$this->approval_status_6->ViewCustomAttributes = "";

		// direction_file_6
		$this->direction_file_6->ViewValue = $this->direction_file_6->CurrentValue;
		$this->direction_file_6->ViewCustomAttributes = "";

		// submit_no_7
		$this->submit_no_7->ViewValue = $this->submit_no_7->CurrentValue;
		$this->submit_no_7->ViewCustomAttributes = "";

		// revision_no_7
		$this->revision_no_7->ViewValue = $this->revision_no_7->CurrentValue;
		$this->revision_no_7->ViewCustomAttributes = "";

		// direction_7
		$this->direction_7->ViewValue = $this->direction_7->CurrentValue;
		$this->direction_7->ViewCustomAttributes = "";

		// planned_date_7
		$this->planned_date_7->ViewValue = $this->planned_date_7->CurrentValue;
		$this->planned_date_7->ViewValue = FormatDateTime($this->planned_date_7->ViewValue, 0);
		$this->planned_date_7->ViewCustomAttributes = "";

		// transmit_date_7
		$this->transmit_date_7->ViewValue = $this->transmit_date_7->CurrentValue;
		$this->transmit_date_7->ViewValue = FormatDateTime($this->transmit_date_7->ViewValue, 0);
		$this->transmit_date_7->ViewCustomAttributes = "";

		// transmit_no_7
		$this->transmit_no_7->ViewValue = $this->transmit_no_7->CurrentValue;
		$this->transmit_no_7->ViewCustomAttributes = "";

		// approval_status_7
		$this->approval_status_7->ViewValue = $this->approval_status_7->CurrentValue;
		$this->approval_status_7->ViewCustomAttributes = "";

		// direction_file_7
		$this->direction_file_7->ViewValue = $this->direction_file_7->CurrentValue;
		$this->direction_file_7->ViewCustomAttributes = "";

		// submit_no_8
		$this->submit_no_8->ViewValue = $this->submit_no_8->CurrentValue;
		$this->submit_no_8->ViewCustomAttributes = "";

		// revision_no_8
		$this->revision_no_8->ViewValue = $this->revision_no_8->CurrentValue;
		$this->revision_no_8->ViewCustomAttributes = "";

		// direction_8
		$this->direction_8->ViewValue = $this->direction_8->CurrentValue;
		$this->direction_8->ViewCustomAttributes = "";

		// planned_date_8
		$this->planned_date_8->ViewValue = $this->planned_date_8->CurrentValue;
		$this->planned_date_8->ViewValue = FormatDateTime($this->planned_date_8->ViewValue, 0);
		$this->planned_date_8->ViewCustomAttributes = "";

		// transmit_date_8
		$this->transmit_date_8->ViewValue = $this->transmit_date_8->CurrentValue;
		$this->transmit_date_8->ViewValue = FormatDateTime($this->transmit_date_8->ViewValue, 0);
		$this->transmit_date_8->ViewCustomAttributes = "";

		// transmit_no_8
		$this->transmit_no_8->ViewValue = $this->transmit_no_8->CurrentValue;
		$this->transmit_no_8->ViewCustomAttributes = "";

		// approval_status_8
		$this->approval_status_8->ViewValue = $this->approval_status_8->CurrentValue;
		$this->approval_status_8->ViewCustomAttributes = "";

		// direction_file_8
		$this->direction_file_8->ViewValue = $this->direction_file_8->CurrentValue;
		$this->direction_file_8->ViewCustomAttributes = "";

		// submit_no_9
		$this->submit_no_9->ViewValue = $this->submit_no_9->CurrentValue;
		$this->submit_no_9->ViewCustomAttributes = "";

		// revision_no_9
		$this->revision_no_9->ViewValue = $this->revision_no_9->CurrentValue;
		$this->revision_no_9->ViewCustomAttributes = "";

		// direction_9
		$this->direction_9->ViewValue = $this->direction_9->CurrentValue;
		$this->direction_9->ViewCustomAttributes = "";

		// planned_date_9
		$this->planned_date_9->ViewValue = $this->planned_date_9->CurrentValue;
		$this->planned_date_9->ViewValue = FormatDateTime($this->planned_date_9->ViewValue, 0);
		$this->planned_date_9->ViewCustomAttributes = "";

		// transmit_date_9
		$this->transmit_date_9->ViewValue = $this->transmit_date_9->CurrentValue;
		$this->transmit_date_9->ViewValue = FormatDateTime($this->transmit_date_9->ViewValue, 0);
		$this->transmit_date_9->ViewCustomAttributes = "";

		// transmit_no_9
		$this->transmit_no_9->ViewValue = $this->transmit_no_9->CurrentValue;
		$this->transmit_no_9->ViewCustomAttributes = "";

		// approval_status_9
		$this->approval_status_9->ViewValue = $this->approval_status_9->CurrentValue;
		$this->approval_status_9->ViewCustomAttributes = "";

		// direction_file_9
		$this->direction_file_9->ViewValue = $this->direction_file_9->CurrentValue;
		$this->direction_file_9->ViewCustomAttributes = "";

		// submit_no_10
		$this->submit_no_10->ViewValue = $this->submit_no_10->CurrentValue;
		$this->submit_no_10->ViewCustomAttributes = "";

		// revision_no_10
		$this->revision_no_10->ViewValue = $this->revision_no_10->CurrentValue;
		$this->revision_no_10->ViewCustomAttributes = "";

		// direction_10
		$this->direction_10->ViewValue = $this->direction_10->CurrentValue;
		$this->direction_10->ViewCustomAttributes = "";

		// planned_date_10
		$this->planned_date_10->ViewValue = $this->planned_date_10->CurrentValue;
		$this->planned_date_10->ViewValue = FormatDateTime($this->planned_date_10->ViewValue, 0);
		$this->planned_date_10->ViewCustomAttributes = "";

		// transmit_date_10
		$this->transmit_date_10->ViewValue = $this->transmit_date_10->CurrentValue;
		$this->transmit_date_10->ViewValue = FormatDateTime($this->transmit_date_10->ViewValue, 0);
		$this->transmit_date_10->ViewCustomAttributes = "";

		// transmit_no_10
		$this->transmit_no_10->ViewValue = $this->transmit_no_10->CurrentValue;
		$this->transmit_no_10->ViewCustomAttributes = "";

		// approval_status_10
		$this->approval_status_10->ViewValue = $this->approval_status_10->CurrentValue;
		$this->approval_status_10->ViewCustomAttributes = "";

		// direction_file_10
		$this->direction_file_10->ViewValue = $this->direction_file_10->CurrentValue;
		$this->direction_file_10->ViewCustomAttributes = "";

		// log_updatedon
		$this->log_updatedon->ViewValue = $this->log_updatedon->CurrentValue;
		$this->log_updatedon->ViewValue = FormatDateTime($this->log_updatedon->ViewValue, 109);
		$this->log_updatedon->ViewCustomAttributes = "";

		// log_id
		$this->log_id->LinkCustomAttributes = "";
		$this->log_id->HrefValue = "";
		$this->log_id->TooltipValue = "";

		// firelink_doc_no
		$this->firelink_doc_no->LinkCustomAttributes = "";
		$this->firelink_doc_no->HrefValue = "";
		$this->firelink_doc_no->TooltipValue = "";

		// client_doc_no
		$this->client_doc_no->LinkCustomAttributes = "";
		$this->client_doc_no->HrefValue = "";
		$this->client_doc_no->TooltipValue = "";

		// order_number
		$this->order_number->LinkCustomAttributes = "";
		$this->order_number->HrefValue = "";
		$this->order_number->TooltipValue = "";

		// project_name
		$this->project_name->LinkCustomAttributes = "";
		$this->project_name->HrefValue = "";
		$this->project_name->TooltipValue = "";

		// document_tittle
		$this->document_tittle->LinkCustomAttributes = "";
		$this->document_tittle->HrefValue = "";
		$this->document_tittle->TooltipValue = "";

		// current_status
		$this->current_status->LinkCustomAttributes = "";
		if (!EmptyValue($this->current_status_file->CurrentValue)) {
			$this->current_status->HrefValue = ((!empty($this->current_status_file->ViewValue) && !is_array($this->current_status_file->ViewValue)) ? RemoveHtml($this->current_status_file->ViewValue) : $this->current_status_file->CurrentValue); // Add prefix/suffix
			$this->current_status->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->current_status->HrefValue = FullUrl($this->current_status->HrefValue, "href");
		} else {
			$this->current_status->HrefValue = "";
		}
		$this->current_status->TooltipValue = "";

		// current_status_file
		$this->current_status_file->LinkCustomAttributes = "";
		$this->current_status_file->HrefValue = "";
		$this->current_status_file->TooltipValue = "";

		// submit_no_1
		$this->submit_no_1->LinkCustomAttributes = "";
		$this->submit_no_1->HrefValue = "";
		$this->submit_no_1->TooltipValue = "";

		// revision_no_1
		$this->revision_no_1->LinkCustomAttributes = "";
		$this->revision_no_1->HrefValue = "";
		$this->revision_no_1->TooltipValue = "";

		// direction_1
		$this->direction_1->LinkCustomAttributes = "";
		$this->direction_1->HrefValue = "";
		$this->direction_1->TooltipValue = "";

		// planned_date_1
		$this->planned_date_1->LinkCustomAttributes = "";
		$this->planned_date_1->HrefValue = "";
		$this->planned_date_1->TooltipValue = "";

		// transmit_date_1
		$this->transmit_date_1->LinkCustomAttributes = "";
		$this->transmit_date_1->HrefValue = "";
		$this->transmit_date_1->TooltipValue = "";

		// transmit_no_1
		$this->transmit_no_1->LinkCustomAttributes = "";
		$this->transmit_no_1->HrefValue = "";
		$this->transmit_no_1->TooltipValue = "";

		// approval_status_1
		$this->approval_status_1->LinkCustomAttributes = "";
		if (!EmptyValue($this->direction_file_1->CurrentValue)) {
			$this->approval_status_1->HrefValue = ((!empty($this->direction_file_1->ViewValue) && !is_array($this->direction_file_1->ViewValue)) ? RemoveHtml($this->direction_file_1->ViewValue) : $this->direction_file_1->CurrentValue); // Add prefix/suffix
			$this->approval_status_1->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->approval_status_1->HrefValue = FullUrl($this->approval_status_1->HrefValue, "href");
		} else {
			$this->approval_status_1->HrefValue = "";
		}
		$this->approval_status_1->TooltipValue = "";

		// direction_file_1
		$this->direction_file_1->LinkCustomAttributes = "";
		$this->direction_file_1->HrefValue = "";
		$this->direction_file_1->TooltipValue = "";

		// submit_no_2
		$this->submit_no_2->LinkCustomAttributes = "";
		$this->submit_no_2->HrefValue = "";
		$this->submit_no_2->TooltipValue = "";

		// revision_no_2
		$this->revision_no_2->LinkCustomAttributes = "";
		$this->revision_no_2->HrefValue = "";
		$this->revision_no_2->TooltipValue = "";

		// direction_2
		$this->direction_2->LinkCustomAttributes = "";
		$this->direction_2->HrefValue = "";
		$this->direction_2->TooltipValue = "";

		// planned_date_2
		$this->planned_date_2->LinkCustomAttributes = "";
		$this->planned_date_2->HrefValue = "";
		$this->planned_date_2->TooltipValue = "";

		// transmit_date_2
		$this->transmit_date_2->LinkCustomAttributes = "";
		$this->transmit_date_2->HrefValue = "";
		$this->transmit_date_2->TooltipValue = "";

		// transmit_no_2
		$this->transmit_no_2->LinkCustomAttributes = "";
		$this->transmit_no_2->HrefValue = "";
		$this->transmit_no_2->TooltipValue = "";

		// approval_status_2
		$this->approval_status_2->LinkCustomAttributes = "";
		if (!EmptyValue($this->direction_file_2->CurrentValue)) {
			$this->approval_status_2->HrefValue = ((!empty($this->direction_file_2->ViewValue) && !is_array($this->direction_file_2->ViewValue)) ? RemoveHtml($this->direction_file_2->ViewValue) : $this->direction_file_2->CurrentValue); // Add prefix/suffix
			$this->approval_status_2->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->approval_status_2->HrefValue = FullUrl($this->approval_status_2->HrefValue, "href");
		} else {
			$this->approval_status_2->HrefValue = "";
		}
		$this->approval_status_2->TooltipValue = "";

		// direction_file_2
		$this->direction_file_2->LinkCustomAttributes = "";
		$this->direction_file_2->HrefValue = "";
		$this->direction_file_2->TooltipValue = "";

		// submit_no_3
		$this->submit_no_3->LinkCustomAttributes = "";
		$this->submit_no_3->HrefValue = "";
		$this->submit_no_3->TooltipValue = "";

		// revision_no_3
		$this->revision_no_3->LinkCustomAttributes = "";
		$this->revision_no_3->HrefValue = "";
		$this->revision_no_3->TooltipValue = "";

		// direction_3
		$this->direction_3->LinkCustomAttributes = "";
		$this->direction_3->HrefValue = "";
		$this->direction_3->TooltipValue = "";

		// planned_date_3
		$this->planned_date_3->LinkCustomAttributes = "";
		$this->planned_date_3->HrefValue = "";
		$this->planned_date_3->TooltipValue = "";

		// transmit_date_3
		$this->transmit_date_3->LinkCustomAttributes = "";
		$this->transmit_date_3->HrefValue = "";
		$this->transmit_date_3->TooltipValue = "";

		// transmit_no_3
		$this->transmit_no_3->LinkCustomAttributes = "";
		$this->transmit_no_3->HrefValue = "";
		$this->transmit_no_3->TooltipValue = "";

		// approval_status_3
		$this->approval_status_3->LinkCustomAttributes = "";
		if (!EmptyValue($this->direction_file_3->CurrentValue)) {
			$this->approval_status_3->HrefValue = ((!empty($this->direction_file_3->ViewValue) && !is_array($this->direction_file_3->ViewValue)) ? RemoveHtml($this->direction_file_3->ViewValue) : $this->direction_file_3->CurrentValue); // Add prefix/suffix
			$this->approval_status_3->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->approval_status_3->HrefValue = FullUrl($this->approval_status_3->HrefValue, "href");
		} else {
			$this->approval_status_3->HrefValue = "";
		}
		$this->approval_status_3->TooltipValue = "";

		// direction_file_3
		$this->direction_file_3->LinkCustomAttributes = "";
		$this->direction_file_3->HrefValue = "";
		$this->direction_file_3->TooltipValue = "";

		// submit_no_4
		$this->submit_no_4->LinkCustomAttributes = "";
		$this->submit_no_4->HrefValue = "";
		$this->submit_no_4->TooltipValue = "";

		// revision_no_4
		$this->revision_no_4->LinkCustomAttributes = "";
		$this->revision_no_4->HrefValue = "";
		$this->revision_no_4->TooltipValue = "";

		// direction_4
		$this->direction_4->LinkCustomAttributes = "";
		$this->direction_4->HrefValue = "";
		$this->direction_4->TooltipValue = "";

		// planned_date_4
		$this->planned_date_4->LinkCustomAttributes = "";
		$this->planned_date_4->HrefValue = "";
		$this->planned_date_4->TooltipValue = "";

		// transmit_date_4
		$this->transmit_date_4->LinkCustomAttributes = "";
		$this->transmit_date_4->HrefValue = "";
		$this->transmit_date_4->TooltipValue = "";

		// transmit_no_4
		$this->transmit_no_4->LinkCustomAttributes = "";
		$this->transmit_no_4->HrefValue = "";
		$this->transmit_no_4->TooltipValue = "";

		// approval_status_4
		$this->approval_status_4->LinkCustomAttributes = "";
		if (!EmptyValue($this->direction_file_4->CurrentValue)) {
			$this->approval_status_4->HrefValue = ((!empty($this->direction_file_4->ViewValue) && !is_array($this->direction_file_4->ViewValue)) ? RemoveHtml($this->direction_file_4->ViewValue) : $this->direction_file_4->CurrentValue); // Add prefix/suffix
			$this->approval_status_4->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->approval_status_4->HrefValue = FullUrl($this->approval_status_4->HrefValue, "href");
		} else {
			$this->approval_status_4->HrefValue = "";
		}
		$this->approval_status_4->TooltipValue = "";

		// direction_file_4
		$this->direction_file_4->LinkCustomAttributes = "";
		$this->direction_file_4->HrefValue = "";
		$this->direction_file_4->TooltipValue = "";

		// submit_no_5
		$this->submit_no_5->LinkCustomAttributes = "";
		$this->submit_no_5->HrefValue = "";
		$this->submit_no_5->TooltipValue = "";

		// revision_no_5
		$this->revision_no_5->LinkCustomAttributes = "";
		$this->revision_no_5->HrefValue = "";
		$this->revision_no_5->TooltipValue = "";

		// direction_5
		$this->direction_5->LinkCustomAttributes = "";
		$this->direction_5->HrefValue = "";
		$this->direction_5->TooltipValue = "";

		// planned_date_5
		$this->planned_date_5->LinkCustomAttributes = "";
		$this->planned_date_5->HrefValue = "";
		$this->planned_date_5->TooltipValue = "";

		// transmit_date_5
		$this->transmit_date_5->LinkCustomAttributes = "";
		$this->transmit_date_5->HrefValue = "";
		$this->transmit_date_5->TooltipValue = "";

		// transmit_no_5
		$this->transmit_no_5->LinkCustomAttributes = "";
		$this->transmit_no_5->HrefValue = "";
		$this->transmit_no_5->TooltipValue = "";

		// approval_status_5
		$this->approval_status_5->LinkCustomAttributes = "";
		$this->approval_status_5->HrefValue = "";
		$this->approval_status_5->TooltipValue = "";

		// direction_file_5
		$this->direction_file_5->LinkCustomAttributes = "";
		if (!EmptyValue($this->direction_file_5->CurrentValue)) {
			$this->direction_file_5->HrefValue = ((!empty($this->direction_file_5->ViewValue) && !is_array($this->direction_file_5->ViewValue)) ? RemoveHtml($this->direction_file_5->ViewValue) : $this->direction_file_5->CurrentValue); // Add prefix/suffix
			$this->direction_file_5->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->direction_file_5->HrefValue = FullUrl($this->direction_file_5->HrefValue, "href");
		} else {
			$this->direction_file_5->HrefValue = "";
		}
		$this->direction_file_5->TooltipValue = "";

		// submit_no_6
		$this->submit_no_6->LinkCustomAttributes = "";
		$this->submit_no_6->HrefValue = "";
		$this->submit_no_6->TooltipValue = "";

		// revision_no_6
		$this->revision_no_6->LinkCustomAttributes = "";
		$this->revision_no_6->HrefValue = "";
		$this->revision_no_6->TooltipValue = "";

		// direction_6
		$this->direction_6->LinkCustomAttributes = "";
		$this->direction_6->HrefValue = "";
		$this->direction_6->TooltipValue = "";

		// planned_date_6
		$this->planned_date_6->LinkCustomAttributes = "";
		$this->planned_date_6->HrefValue = "";
		$this->planned_date_6->TooltipValue = "";

		// transmit_date_6
		$this->transmit_date_6->LinkCustomAttributes = "";
		$this->transmit_date_6->HrefValue = "";
		$this->transmit_date_6->TooltipValue = "";

		// transmit_no_6
		$this->transmit_no_6->LinkCustomAttributes = "";
		$this->transmit_no_6->HrefValue = "";
		$this->transmit_no_6->TooltipValue = "";

		// approval_status_6
		$this->approval_status_6->LinkCustomAttributes = "";
		if (!EmptyValue($this->direction_file_6->CurrentValue)) {
			$this->approval_status_6->HrefValue = ((!empty($this->direction_file_6->ViewValue) && !is_array($this->direction_file_6->ViewValue)) ? RemoveHtml($this->direction_file_6->ViewValue) : $this->direction_file_6->CurrentValue); // Add prefix/suffix
			$this->approval_status_6->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->approval_status_6->HrefValue = FullUrl($this->approval_status_6->HrefValue, "href");
		} else {
			$this->approval_status_6->HrefValue = "";
		}
		$this->approval_status_6->TooltipValue = "";

		// direction_file_6
		$this->direction_file_6->LinkCustomAttributes = "";
		$this->direction_file_6->HrefValue = "";
		$this->direction_file_6->TooltipValue = "";

		// submit_no_7
		$this->submit_no_7->LinkCustomAttributes = "";
		$this->submit_no_7->HrefValue = "";
		$this->submit_no_7->TooltipValue = "";

		// revision_no_7
		$this->revision_no_7->LinkCustomAttributes = "";
		$this->revision_no_7->HrefValue = "";
		$this->revision_no_7->TooltipValue = "";

		// direction_7
		$this->direction_7->LinkCustomAttributes = "";
		$this->direction_7->HrefValue = "";
		$this->direction_7->TooltipValue = "";

		// planned_date_7
		$this->planned_date_7->LinkCustomAttributes = "";
		$this->planned_date_7->HrefValue = "";
		$this->planned_date_7->TooltipValue = "";

		// transmit_date_7
		$this->transmit_date_7->LinkCustomAttributes = "";
		$this->transmit_date_7->HrefValue = "";
		$this->transmit_date_7->TooltipValue = "";

		// transmit_no_7
		$this->transmit_no_7->LinkCustomAttributes = "";
		$this->transmit_no_7->HrefValue = "";
		$this->transmit_no_7->TooltipValue = "";

		// approval_status_7
		$this->approval_status_7->LinkCustomAttributes = "";
		if (!EmptyValue($this->direction_file_7->CurrentValue)) {
			$this->approval_status_7->HrefValue = ((!empty($this->direction_file_7->ViewValue) && !is_array($this->direction_file_7->ViewValue)) ? RemoveHtml($this->direction_file_7->ViewValue) : $this->direction_file_7->CurrentValue); // Add prefix/suffix
			$this->approval_status_7->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->approval_status_7->HrefValue = FullUrl($this->approval_status_7->HrefValue, "href");
		} else {
			$this->approval_status_7->HrefValue = "";
		}
		$this->approval_status_7->TooltipValue = "";

		// direction_file_7
		$this->direction_file_7->LinkCustomAttributes = "";
		$this->direction_file_7->HrefValue = "";
		$this->direction_file_7->TooltipValue = "";

		// submit_no_8
		$this->submit_no_8->LinkCustomAttributes = "";
		$this->submit_no_8->HrefValue = "";
		$this->submit_no_8->TooltipValue = "";

		// revision_no_8
		$this->revision_no_8->LinkCustomAttributes = "";
		$this->revision_no_8->HrefValue = "";
		$this->revision_no_8->TooltipValue = "";

		// direction_8
		$this->direction_8->LinkCustomAttributes = "";
		$this->direction_8->HrefValue = "";
		$this->direction_8->TooltipValue = "";

		// planned_date_8
		$this->planned_date_8->LinkCustomAttributes = "";
		$this->planned_date_8->HrefValue = "";
		$this->planned_date_8->TooltipValue = "";

		// transmit_date_8
		$this->transmit_date_8->LinkCustomAttributes = "";
		$this->transmit_date_8->HrefValue = "";
		$this->transmit_date_8->TooltipValue = "";

		// transmit_no_8
		$this->transmit_no_8->LinkCustomAttributes = "";
		$this->transmit_no_8->HrefValue = "";
		$this->transmit_no_8->TooltipValue = "";

		// approval_status_8
		$this->approval_status_8->LinkCustomAttributes = "";
		if (!EmptyValue($this->direction_file_8->CurrentValue)) {
			$this->approval_status_8->HrefValue = ((!empty($this->direction_file_8->ViewValue) && !is_array($this->direction_file_8->ViewValue)) ? RemoveHtml($this->direction_file_8->ViewValue) : $this->direction_file_8->CurrentValue); // Add prefix/suffix
			$this->approval_status_8->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->approval_status_8->HrefValue = FullUrl($this->approval_status_8->HrefValue, "href");
		} else {
			$this->approval_status_8->HrefValue = "";
		}
		$this->approval_status_8->TooltipValue = "";

		// direction_file_8
		$this->direction_file_8->LinkCustomAttributes = "";
		$this->direction_file_8->HrefValue = "";
		$this->direction_file_8->TooltipValue = "";

		// submit_no_9
		$this->submit_no_9->LinkCustomAttributes = "";
		$this->submit_no_9->HrefValue = "";
		$this->submit_no_9->TooltipValue = "";

		// revision_no_9
		$this->revision_no_9->LinkCustomAttributes = "";
		$this->revision_no_9->HrefValue = "";
		$this->revision_no_9->TooltipValue = "";

		// direction_9
		$this->direction_9->LinkCustomAttributes = "";
		$this->direction_9->HrefValue = "";
		$this->direction_9->TooltipValue = "";

		// planned_date_9
		$this->planned_date_9->LinkCustomAttributes = "";
		$this->planned_date_9->HrefValue = "";
		$this->planned_date_9->TooltipValue = "";

		// transmit_date_9
		$this->transmit_date_9->LinkCustomAttributes = "";
		$this->transmit_date_9->HrefValue = "";
		$this->transmit_date_9->TooltipValue = "";

		// transmit_no_9
		$this->transmit_no_9->LinkCustomAttributes = "";
		$this->transmit_no_9->HrefValue = "";
		$this->transmit_no_9->TooltipValue = "";

		// approval_status_9
		$this->approval_status_9->LinkCustomAttributes = "";
		if (!EmptyValue($this->direction_file_9->CurrentValue)) {
			$this->approval_status_9->HrefValue = ((!empty($this->direction_file_9->ViewValue) && !is_array($this->direction_file_9->ViewValue)) ? RemoveHtml($this->direction_file_9->ViewValue) : $this->direction_file_9->CurrentValue); // Add prefix/suffix
			$this->approval_status_9->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->approval_status_9->HrefValue = FullUrl($this->approval_status_9->HrefValue, "href");
		} else {
			$this->approval_status_9->HrefValue = "";
		}
		$this->approval_status_9->TooltipValue = "";

		// direction_file_9
		$this->direction_file_9->LinkCustomAttributes = "";
		$this->direction_file_9->HrefValue = "";
		$this->direction_file_9->TooltipValue = "";

		// submit_no_10
		$this->submit_no_10->LinkCustomAttributes = "";
		$this->submit_no_10->HrefValue = "";
		$this->submit_no_10->TooltipValue = "";

		// revision_no_10
		$this->revision_no_10->LinkCustomAttributes = "";
		$this->revision_no_10->HrefValue = "";
		$this->revision_no_10->TooltipValue = "";

		// direction_10
		$this->direction_10->LinkCustomAttributes = "";
		$this->direction_10->HrefValue = "";
		$this->direction_10->TooltipValue = "";

		// planned_date_10
		$this->planned_date_10->LinkCustomAttributes = "";
		$this->planned_date_10->HrefValue = "";
		$this->planned_date_10->TooltipValue = "";

		// transmit_date_10
		$this->transmit_date_10->LinkCustomAttributes = "";
		$this->transmit_date_10->HrefValue = "";
		$this->transmit_date_10->TooltipValue = "";

		// transmit_no_10
		$this->transmit_no_10->LinkCustomAttributes = "";
		$this->transmit_no_10->HrefValue = "";
		$this->transmit_no_10->TooltipValue = "";

		// approval_status_10
		$this->approval_status_10->LinkCustomAttributes = "";
		if (!EmptyValue($this->direction_file_10->CurrentValue)) {
			$this->approval_status_10->HrefValue = ((!empty($this->direction_file_10->ViewValue) && !is_array($this->direction_file_10->ViewValue)) ? RemoveHtml($this->direction_file_10->ViewValue) : $this->direction_file_10->CurrentValue); // Add prefix/suffix
			$this->approval_status_10->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->approval_status_10->HrefValue = FullUrl($this->approval_status_10->HrefValue, "href");
		} else {
			$this->approval_status_10->HrefValue = "";
		}
		$this->approval_status_10->TooltipValue = "";

		// direction_file_10
		$this->direction_file_10->LinkCustomAttributes = "";
		$this->direction_file_10->HrefValue = "";
		$this->direction_file_10->TooltipValue = "";

		// log_updatedon
		$this->log_updatedon->LinkCustomAttributes = "";
		$this->log_updatedon->HrefValue = "";
		$this->log_updatedon->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// log_id
		$this->log_id->EditAttrs["class"] = "form-control";
		$this->log_id->EditCustomAttributes = "";
		$this->log_id->EditValue = $this->log_id->CurrentValue;
		$this->log_id->ViewCustomAttributes = "";

		// firelink_doc_no
		$this->firelink_doc_no->EditAttrs["class"] = "form-control";
		$this->firelink_doc_no->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->firelink_doc_no->CurrentValue = HtmlDecode($this->firelink_doc_no->CurrentValue);
		$this->firelink_doc_no->EditValue = $this->firelink_doc_no->CurrentValue;
		$this->firelink_doc_no->PlaceHolder = RemoveHtml($this->firelink_doc_no->caption());

		// client_doc_no
		$this->client_doc_no->EditAttrs["class"] = "form-control";
		$this->client_doc_no->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->client_doc_no->CurrentValue = HtmlDecode($this->client_doc_no->CurrentValue);
		$this->client_doc_no->EditValue = $this->client_doc_no->CurrentValue;
		$this->client_doc_no->PlaceHolder = RemoveHtml($this->client_doc_no->caption());

		// order_number
		$this->order_number->EditAttrs["class"] = "form-control";
		$this->order_number->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->order_number->CurrentValue = HtmlDecode($this->order_number->CurrentValue);
		$this->order_number->EditValue = $this->order_number->CurrentValue;
		$this->order_number->PlaceHolder = RemoveHtml($this->order_number->caption());

		// project_name
		$this->project_name->EditAttrs["class"] = "form-control";
		$this->project_name->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->project_name->CurrentValue = HtmlDecode($this->project_name->CurrentValue);
		$this->project_name->EditValue = $this->project_name->CurrentValue;
		$this->project_name->PlaceHolder = RemoveHtml($this->project_name->caption());

		// document_tittle
		$this->document_tittle->EditAttrs["class"] = "form-control";
		$this->document_tittle->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->document_tittle->CurrentValue = HtmlDecode($this->document_tittle->CurrentValue);
		$this->document_tittle->EditValue = $this->document_tittle->CurrentValue;
		$this->document_tittle->PlaceHolder = RemoveHtml($this->document_tittle->caption());

		// current_status
		$this->current_status->EditAttrs["class"] = "form-control";
		$this->current_status->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->current_status->CurrentValue = HtmlDecode($this->current_status->CurrentValue);
		$this->current_status->EditValue = $this->current_status->CurrentValue;
		$this->current_status->PlaceHolder = RemoveHtml($this->current_status->caption());

		// current_status_file
		$this->current_status_file->EditAttrs["class"] = "form-control";
		$this->current_status_file->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->current_status_file->CurrentValue = HtmlDecode($this->current_status_file->CurrentValue);
		$this->current_status_file->EditValue = $this->current_status_file->CurrentValue;
		$this->current_status_file->PlaceHolder = RemoveHtml($this->current_status_file->caption());

		// submit_no_1
		$this->submit_no_1->EditAttrs["class"] = "form-control";
		$this->submit_no_1->EditCustomAttributes = "";
		$this->submit_no_1->EditValue = $this->submit_no_1->CurrentValue;
		$this->submit_no_1->PlaceHolder = RemoveHtml($this->submit_no_1->caption());

		// revision_no_1
		$this->revision_no_1->EditAttrs["class"] = "form-control";
		$this->revision_no_1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_1->CurrentValue = HtmlDecode($this->revision_no_1->CurrentValue);
		$this->revision_no_1->EditValue = $this->revision_no_1->CurrentValue;
		$this->revision_no_1->PlaceHolder = RemoveHtml($this->revision_no_1->caption());

		// direction_1
		$this->direction_1->EditAttrs["class"] = "form-control";
		$this->direction_1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_1->CurrentValue = HtmlDecode($this->direction_1->CurrentValue);
		$this->direction_1->EditValue = $this->direction_1->CurrentValue;
		$this->direction_1->PlaceHolder = RemoveHtml($this->direction_1->caption());

		// planned_date_1
		$this->planned_date_1->EditAttrs["class"] = "form-control";
		$this->planned_date_1->EditCustomAttributes = "";
		$this->planned_date_1->EditValue = FormatDateTime($this->planned_date_1->CurrentValue, 8);
		$this->planned_date_1->PlaceHolder = RemoveHtml($this->planned_date_1->caption());

		// transmit_date_1
		$this->transmit_date_1->EditAttrs["class"] = "form-control";
		$this->transmit_date_1->EditCustomAttributes = "";
		$this->transmit_date_1->EditValue = FormatDateTime($this->transmit_date_1->CurrentValue, 8);
		$this->transmit_date_1->PlaceHolder = RemoveHtml($this->transmit_date_1->caption());

		// transmit_no_1
		$this->transmit_no_1->EditAttrs["class"] = "form-control";
		$this->transmit_no_1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_1->CurrentValue = HtmlDecode($this->transmit_no_1->CurrentValue);
		$this->transmit_no_1->EditValue = $this->transmit_no_1->CurrentValue;
		$this->transmit_no_1->PlaceHolder = RemoveHtml($this->transmit_no_1->caption());

		// approval_status_1
		$this->approval_status_1->EditAttrs["class"] = "form-control";
		$this->approval_status_1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_1->CurrentValue = HtmlDecode($this->approval_status_1->CurrentValue);
		$this->approval_status_1->EditValue = $this->approval_status_1->CurrentValue;
		$this->approval_status_1->PlaceHolder = RemoveHtml($this->approval_status_1->caption());

		// direction_file_1
		$this->direction_file_1->EditAttrs["class"] = "form-control";
		$this->direction_file_1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_file_1->CurrentValue = HtmlDecode($this->direction_file_1->CurrentValue);
		$this->direction_file_1->EditValue = $this->direction_file_1->CurrentValue;
		$this->direction_file_1->PlaceHolder = RemoveHtml($this->direction_file_1->caption());

		// submit_no_2
		$this->submit_no_2->EditAttrs["class"] = "form-control";
		$this->submit_no_2->EditCustomAttributes = "";
		$this->submit_no_2->EditValue = $this->submit_no_2->CurrentValue;
		$this->submit_no_2->PlaceHolder = RemoveHtml($this->submit_no_2->caption());

		// revision_no_2
		$this->revision_no_2->EditAttrs["class"] = "form-control";
		$this->revision_no_2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_2->CurrentValue = HtmlDecode($this->revision_no_2->CurrentValue);
		$this->revision_no_2->EditValue = $this->revision_no_2->CurrentValue;
		$this->revision_no_2->PlaceHolder = RemoveHtml($this->revision_no_2->caption());

		// direction_2
		$this->direction_2->EditAttrs["class"] = "form-control";
		$this->direction_2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_2->CurrentValue = HtmlDecode($this->direction_2->CurrentValue);
		$this->direction_2->EditValue = $this->direction_2->CurrentValue;
		$this->direction_2->PlaceHolder = RemoveHtml($this->direction_2->caption());

		// planned_date_2
		$this->planned_date_2->EditAttrs["class"] = "form-control";
		$this->planned_date_2->EditCustomAttributes = "";
		$this->planned_date_2->EditValue = FormatDateTime($this->planned_date_2->CurrentValue, 8);
		$this->planned_date_2->PlaceHolder = RemoveHtml($this->planned_date_2->caption());

		// transmit_date_2
		$this->transmit_date_2->EditAttrs["class"] = "form-control";
		$this->transmit_date_2->EditCustomAttributes = "";
		$this->transmit_date_2->EditValue = FormatDateTime($this->transmit_date_2->CurrentValue, 8);
		$this->transmit_date_2->PlaceHolder = RemoveHtml($this->transmit_date_2->caption());

		// transmit_no_2
		$this->transmit_no_2->EditAttrs["class"] = "form-control";
		$this->transmit_no_2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_2->CurrentValue = HtmlDecode($this->transmit_no_2->CurrentValue);
		$this->transmit_no_2->EditValue = $this->transmit_no_2->CurrentValue;
		$this->transmit_no_2->PlaceHolder = RemoveHtml($this->transmit_no_2->caption());

		// approval_status_2
		$this->approval_status_2->EditAttrs["class"] = "form-control";
		$this->approval_status_2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_2->CurrentValue = HtmlDecode($this->approval_status_2->CurrentValue);
		$this->approval_status_2->EditValue = $this->approval_status_2->CurrentValue;
		$this->approval_status_2->PlaceHolder = RemoveHtml($this->approval_status_2->caption());

		// direction_file_2
		$this->direction_file_2->EditAttrs["class"] = "form-control";
		$this->direction_file_2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_file_2->CurrentValue = HtmlDecode($this->direction_file_2->CurrentValue);
		$this->direction_file_2->EditValue = $this->direction_file_2->CurrentValue;
		$this->direction_file_2->PlaceHolder = RemoveHtml($this->direction_file_2->caption());

		// submit_no_3
		$this->submit_no_3->EditAttrs["class"] = "form-control";
		$this->submit_no_3->EditCustomAttributes = "";
		$this->submit_no_3->EditValue = $this->submit_no_3->CurrentValue;
		$this->submit_no_3->PlaceHolder = RemoveHtml($this->submit_no_3->caption());

		// revision_no_3
		$this->revision_no_3->EditAttrs["class"] = "form-control";
		$this->revision_no_3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_3->CurrentValue = HtmlDecode($this->revision_no_3->CurrentValue);
		$this->revision_no_3->EditValue = $this->revision_no_3->CurrentValue;
		$this->revision_no_3->PlaceHolder = RemoveHtml($this->revision_no_3->caption());

		// direction_3
		$this->direction_3->EditAttrs["class"] = "form-control";
		$this->direction_3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_3->CurrentValue = HtmlDecode($this->direction_3->CurrentValue);
		$this->direction_3->EditValue = $this->direction_3->CurrentValue;
		$this->direction_3->PlaceHolder = RemoveHtml($this->direction_3->caption());

		// planned_date_3
		$this->planned_date_3->EditAttrs["class"] = "form-control";
		$this->planned_date_3->EditCustomAttributes = "";
		$this->planned_date_3->EditValue = FormatDateTime($this->planned_date_3->CurrentValue, 8);
		$this->planned_date_3->PlaceHolder = RemoveHtml($this->planned_date_3->caption());

		// transmit_date_3
		$this->transmit_date_3->EditAttrs["class"] = "form-control";
		$this->transmit_date_3->EditCustomAttributes = "";
		$this->transmit_date_3->EditValue = FormatDateTime($this->transmit_date_3->CurrentValue, 8);
		$this->transmit_date_3->PlaceHolder = RemoveHtml($this->transmit_date_3->caption());

		// transmit_no_3
		$this->transmit_no_3->EditAttrs["class"] = "form-control";
		$this->transmit_no_3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_3->CurrentValue = HtmlDecode($this->transmit_no_3->CurrentValue);
		$this->transmit_no_3->EditValue = $this->transmit_no_3->CurrentValue;
		$this->transmit_no_3->PlaceHolder = RemoveHtml($this->transmit_no_3->caption());

		// approval_status_3
		$this->approval_status_3->EditAttrs["class"] = "form-control";
		$this->approval_status_3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_3->CurrentValue = HtmlDecode($this->approval_status_3->CurrentValue);
		$this->approval_status_3->EditValue = $this->approval_status_3->CurrentValue;
		$this->approval_status_3->PlaceHolder = RemoveHtml($this->approval_status_3->caption());

		// direction_file_3
		$this->direction_file_3->EditAttrs["class"] = "form-control";
		$this->direction_file_3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_file_3->CurrentValue = HtmlDecode($this->direction_file_3->CurrentValue);
		$this->direction_file_3->EditValue = $this->direction_file_3->CurrentValue;
		$this->direction_file_3->PlaceHolder = RemoveHtml($this->direction_file_3->caption());

		// submit_no_4
		$this->submit_no_4->EditAttrs["class"] = "form-control";
		$this->submit_no_4->EditCustomAttributes = "";
		$this->submit_no_4->EditValue = $this->submit_no_4->CurrentValue;
		$this->submit_no_4->PlaceHolder = RemoveHtml($this->submit_no_4->caption());

		// revision_no_4
		$this->revision_no_4->EditAttrs["class"] = "form-control";
		$this->revision_no_4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_4->CurrentValue = HtmlDecode($this->revision_no_4->CurrentValue);
		$this->revision_no_4->EditValue = $this->revision_no_4->CurrentValue;
		$this->revision_no_4->PlaceHolder = RemoveHtml($this->revision_no_4->caption());

		// direction_4
		$this->direction_4->EditAttrs["class"] = "form-control";
		$this->direction_4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_4->CurrentValue = HtmlDecode($this->direction_4->CurrentValue);
		$this->direction_4->EditValue = $this->direction_4->CurrentValue;
		$this->direction_4->PlaceHolder = RemoveHtml($this->direction_4->caption());

		// planned_date_4
		$this->planned_date_4->EditAttrs["class"] = "form-control";
		$this->planned_date_4->EditCustomAttributes = "";
		$this->planned_date_4->EditValue = FormatDateTime($this->planned_date_4->CurrentValue, 8);
		$this->planned_date_4->PlaceHolder = RemoveHtml($this->planned_date_4->caption());

		// transmit_date_4
		$this->transmit_date_4->EditAttrs["class"] = "form-control";
		$this->transmit_date_4->EditCustomAttributes = "";
		$this->transmit_date_4->EditValue = FormatDateTime($this->transmit_date_4->CurrentValue, 8);
		$this->transmit_date_4->PlaceHolder = RemoveHtml($this->transmit_date_4->caption());

		// transmit_no_4
		$this->transmit_no_4->EditAttrs["class"] = "form-control";
		$this->transmit_no_4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_4->CurrentValue = HtmlDecode($this->transmit_no_4->CurrentValue);
		$this->transmit_no_4->EditValue = $this->transmit_no_4->CurrentValue;
		$this->transmit_no_4->PlaceHolder = RemoveHtml($this->transmit_no_4->caption());

		// approval_status_4
		$this->approval_status_4->EditAttrs["class"] = "form-control";
		$this->approval_status_4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_4->CurrentValue = HtmlDecode($this->approval_status_4->CurrentValue);
		$this->approval_status_4->EditValue = $this->approval_status_4->CurrentValue;
		$this->approval_status_4->PlaceHolder = RemoveHtml($this->approval_status_4->caption());

		// direction_file_4
		$this->direction_file_4->EditAttrs["class"] = "form-control";
		$this->direction_file_4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_file_4->CurrentValue = HtmlDecode($this->direction_file_4->CurrentValue);
		$this->direction_file_4->EditValue = $this->direction_file_4->CurrentValue;
		$this->direction_file_4->PlaceHolder = RemoveHtml($this->direction_file_4->caption());

		// submit_no_5
		$this->submit_no_5->EditAttrs["class"] = "form-control";
		$this->submit_no_5->EditCustomAttributes = "";
		$this->submit_no_5->EditValue = $this->submit_no_5->CurrentValue;
		$this->submit_no_5->PlaceHolder = RemoveHtml($this->submit_no_5->caption());

		// revision_no_5
		$this->revision_no_5->EditAttrs["class"] = "form-control";
		$this->revision_no_5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_5->CurrentValue = HtmlDecode($this->revision_no_5->CurrentValue);
		$this->revision_no_5->EditValue = $this->revision_no_5->CurrentValue;
		$this->revision_no_5->PlaceHolder = RemoveHtml($this->revision_no_5->caption());

		// direction_5
		$this->direction_5->EditAttrs["class"] = "form-control";
		$this->direction_5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_5->CurrentValue = HtmlDecode($this->direction_5->CurrentValue);
		$this->direction_5->EditValue = $this->direction_5->CurrentValue;
		$this->direction_5->PlaceHolder = RemoveHtml($this->direction_5->caption());

		// planned_date_5
		$this->planned_date_5->EditAttrs["class"] = "form-control";
		$this->planned_date_5->EditCustomAttributes = "";
		$this->planned_date_5->EditValue = FormatDateTime($this->planned_date_5->CurrentValue, 8);
		$this->planned_date_5->PlaceHolder = RemoveHtml($this->planned_date_5->caption());

		// transmit_date_5
		$this->transmit_date_5->EditAttrs["class"] = "form-control";
		$this->transmit_date_5->EditCustomAttributes = "";
		$this->transmit_date_5->EditValue = FormatDateTime($this->transmit_date_5->CurrentValue, 8);
		$this->transmit_date_5->PlaceHolder = RemoveHtml($this->transmit_date_5->caption());

		// transmit_no_5
		$this->transmit_no_5->EditAttrs["class"] = "form-control";
		$this->transmit_no_5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_5->CurrentValue = HtmlDecode($this->transmit_no_5->CurrentValue);
		$this->transmit_no_5->EditValue = $this->transmit_no_5->CurrentValue;
		$this->transmit_no_5->PlaceHolder = RemoveHtml($this->transmit_no_5->caption());

		// approval_status_5
		$this->approval_status_5->EditAttrs["class"] = "form-control";
		$this->approval_status_5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_5->CurrentValue = HtmlDecode($this->approval_status_5->CurrentValue);
		$this->approval_status_5->EditValue = $this->approval_status_5->CurrentValue;
		$this->approval_status_5->PlaceHolder = RemoveHtml($this->approval_status_5->caption());

		// direction_file_5
		$this->direction_file_5->EditAttrs["class"] = "form-control";
		$this->direction_file_5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_file_5->CurrentValue = HtmlDecode($this->direction_file_5->CurrentValue);
		$this->direction_file_5->EditValue = $this->direction_file_5->CurrentValue;
		$this->direction_file_5->PlaceHolder = RemoveHtml($this->direction_file_5->caption());

		// submit_no_6
		$this->submit_no_6->EditAttrs["class"] = "form-control";
		$this->submit_no_6->EditCustomAttributes = "";
		$this->submit_no_6->EditValue = $this->submit_no_6->CurrentValue;
		$this->submit_no_6->PlaceHolder = RemoveHtml($this->submit_no_6->caption());

		// revision_no_6
		$this->revision_no_6->EditAttrs["class"] = "form-control";
		$this->revision_no_6->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_6->CurrentValue = HtmlDecode($this->revision_no_6->CurrentValue);
		$this->revision_no_6->EditValue = $this->revision_no_6->CurrentValue;
		$this->revision_no_6->PlaceHolder = RemoveHtml($this->revision_no_6->caption());

		// direction_6
		$this->direction_6->EditAttrs["class"] = "form-control";
		$this->direction_6->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_6->CurrentValue = HtmlDecode($this->direction_6->CurrentValue);
		$this->direction_6->EditValue = $this->direction_6->CurrentValue;
		$this->direction_6->PlaceHolder = RemoveHtml($this->direction_6->caption());

		// planned_date_6
		$this->planned_date_6->EditAttrs["class"] = "form-control";
		$this->planned_date_6->EditCustomAttributes = "";
		$this->planned_date_6->EditValue = FormatDateTime($this->planned_date_6->CurrentValue, 8);
		$this->planned_date_6->PlaceHolder = RemoveHtml($this->planned_date_6->caption());

		// transmit_date_6
		$this->transmit_date_6->EditAttrs["class"] = "form-control";
		$this->transmit_date_6->EditCustomAttributes = "";
		$this->transmit_date_6->EditValue = FormatDateTime($this->transmit_date_6->CurrentValue, 8);
		$this->transmit_date_6->PlaceHolder = RemoveHtml($this->transmit_date_6->caption());

		// transmit_no_6
		$this->transmit_no_6->EditAttrs["class"] = "form-control";
		$this->transmit_no_6->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_6->CurrentValue = HtmlDecode($this->transmit_no_6->CurrentValue);
		$this->transmit_no_6->EditValue = $this->transmit_no_6->CurrentValue;
		$this->transmit_no_6->PlaceHolder = RemoveHtml($this->transmit_no_6->caption());

		// approval_status_6
		$this->approval_status_6->EditAttrs["class"] = "form-control";
		$this->approval_status_6->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_6->CurrentValue = HtmlDecode($this->approval_status_6->CurrentValue);
		$this->approval_status_6->EditValue = $this->approval_status_6->CurrentValue;
		$this->approval_status_6->PlaceHolder = RemoveHtml($this->approval_status_6->caption());

		// direction_file_6
		$this->direction_file_6->EditAttrs["class"] = "form-control";
		$this->direction_file_6->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_file_6->CurrentValue = HtmlDecode($this->direction_file_6->CurrentValue);
		$this->direction_file_6->EditValue = $this->direction_file_6->CurrentValue;
		$this->direction_file_6->PlaceHolder = RemoveHtml($this->direction_file_6->caption());

		// submit_no_7
		$this->submit_no_7->EditAttrs["class"] = "form-control";
		$this->submit_no_7->EditCustomAttributes = "";
		$this->submit_no_7->EditValue = $this->submit_no_7->CurrentValue;
		$this->submit_no_7->PlaceHolder = RemoveHtml($this->submit_no_7->caption());

		// revision_no_7
		$this->revision_no_7->EditAttrs["class"] = "form-control";
		$this->revision_no_7->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_7->CurrentValue = HtmlDecode($this->revision_no_7->CurrentValue);
		$this->revision_no_7->EditValue = $this->revision_no_7->CurrentValue;
		$this->revision_no_7->PlaceHolder = RemoveHtml($this->revision_no_7->caption());

		// direction_7
		$this->direction_7->EditAttrs["class"] = "form-control";
		$this->direction_7->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_7->CurrentValue = HtmlDecode($this->direction_7->CurrentValue);
		$this->direction_7->EditValue = $this->direction_7->CurrentValue;
		$this->direction_7->PlaceHolder = RemoveHtml($this->direction_7->caption());

		// planned_date_7
		$this->planned_date_7->EditAttrs["class"] = "form-control";
		$this->planned_date_7->EditCustomAttributes = "";
		$this->planned_date_7->EditValue = FormatDateTime($this->planned_date_7->CurrentValue, 8);
		$this->planned_date_7->PlaceHolder = RemoveHtml($this->planned_date_7->caption());

		// transmit_date_7
		$this->transmit_date_7->EditAttrs["class"] = "form-control";
		$this->transmit_date_7->EditCustomAttributes = "";
		$this->transmit_date_7->EditValue = FormatDateTime($this->transmit_date_7->CurrentValue, 8);
		$this->transmit_date_7->PlaceHolder = RemoveHtml($this->transmit_date_7->caption());

		// transmit_no_7
		$this->transmit_no_7->EditAttrs["class"] = "form-control";
		$this->transmit_no_7->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_7->CurrentValue = HtmlDecode($this->transmit_no_7->CurrentValue);
		$this->transmit_no_7->EditValue = $this->transmit_no_7->CurrentValue;
		$this->transmit_no_7->PlaceHolder = RemoveHtml($this->transmit_no_7->caption());

		// approval_status_7
		$this->approval_status_7->EditAttrs["class"] = "form-control";
		$this->approval_status_7->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_7->CurrentValue = HtmlDecode($this->approval_status_7->CurrentValue);
		$this->approval_status_7->EditValue = $this->approval_status_7->CurrentValue;
		$this->approval_status_7->PlaceHolder = RemoveHtml($this->approval_status_7->caption());

		// direction_file_7
		$this->direction_file_7->EditAttrs["class"] = "form-control";
		$this->direction_file_7->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_file_7->CurrentValue = HtmlDecode($this->direction_file_7->CurrentValue);
		$this->direction_file_7->EditValue = $this->direction_file_7->CurrentValue;
		$this->direction_file_7->PlaceHolder = RemoveHtml($this->direction_file_7->caption());

		// submit_no_8
		$this->submit_no_8->EditAttrs["class"] = "form-control";
		$this->submit_no_8->EditCustomAttributes = "";
		$this->submit_no_8->EditValue = $this->submit_no_8->CurrentValue;
		$this->submit_no_8->PlaceHolder = RemoveHtml($this->submit_no_8->caption());

		// revision_no_8
		$this->revision_no_8->EditAttrs["class"] = "form-control";
		$this->revision_no_8->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_8->CurrentValue = HtmlDecode($this->revision_no_8->CurrentValue);
		$this->revision_no_8->EditValue = $this->revision_no_8->CurrentValue;
		$this->revision_no_8->PlaceHolder = RemoveHtml($this->revision_no_8->caption());

		// direction_8
		$this->direction_8->EditAttrs["class"] = "form-control";
		$this->direction_8->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_8->CurrentValue = HtmlDecode($this->direction_8->CurrentValue);
		$this->direction_8->EditValue = $this->direction_8->CurrentValue;
		$this->direction_8->PlaceHolder = RemoveHtml($this->direction_8->caption());

		// planned_date_8
		$this->planned_date_8->EditAttrs["class"] = "form-control";
		$this->planned_date_8->EditCustomAttributes = "";
		$this->planned_date_8->EditValue = FormatDateTime($this->planned_date_8->CurrentValue, 8);
		$this->planned_date_8->PlaceHolder = RemoveHtml($this->planned_date_8->caption());

		// transmit_date_8
		$this->transmit_date_8->EditAttrs["class"] = "form-control";
		$this->transmit_date_8->EditCustomAttributes = "";
		$this->transmit_date_8->EditValue = FormatDateTime($this->transmit_date_8->CurrentValue, 8);
		$this->transmit_date_8->PlaceHolder = RemoveHtml($this->transmit_date_8->caption());

		// transmit_no_8
		$this->transmit_no_8->EditAttrs["class"] = "form-control";
		$this->transmit_no_8->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_8->CurrentValue = HtmlDecode($this->transmit_no_8->CurrentValue);
		$this->transmit_no_8->EditValue = $this->transmit_no_8->CurrentValue;
		$this->transmit_no_8->PlaceHolder = RemoveHtml($this->transmit_no_8->caption());

		// approval_status_8
		$this->approval_status_8->EditAttrs["class"] = "form-control";
		$this->approval_status_8->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_8->CurrentValue = HtmlDecode($this->approval_status_8->CurrentValue);
		$this->approval_status_8->EditValue = $this->approval_status_8->CurrentValue;
		$this->approval_status_8->PlaceHolder = RemoveHtml($this->approval_status_8->caption());

		// direction_file_8
		$this->direction_file_8->EditAttrs["class"] = "form-control";
		$this->direction_file_8->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_file_8->CurrentValue = HtmlDecode($this->direction_file_8->CurrentValue);
		$this->direction_file_8->EditValue = $this->direction_file_8->CurrentValue;
		$this->direction_file_8->PlaceHolder = RemoveHtml($this->direction_file_8->caption());

		// submit_no_9
		$this->submit_no_9->EditAttrs["class"] = "form-control";
		$this->submit_no_9->EditCustomAttributes = "";
		$this->submit_no_9->EditValue = $this->submit_no_9->CurrentValue;
		$this->submit_no_9->PlaceHolder = RemoveHtml($this->submit_no_9->caption());

		// revision_no_9
		$this->revision_no_9->EditAttrs["class"] = "form-control";
		$this->revision_no_9->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_9->CurrentValue = HtmlDecode($this->revision_no_9->CurrentValue);
		$this->revision_no_9->EditValue = $this->revision_no_9->CurrentValue;
		$this->revision_no_9->PlaceHolder = RemoveHtml($this->revision_no_9->caption());

		// direction_9
		$this->direction_9->EditAttrs["class"] = "form-control";
		$this->direction_9->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_9->CurrentValue = HtmlDecode($this->direction_9->CurrentValue);
		$this->direction_9->EditValue = $this->direction_9->CurrentValue;
		$this->direction_9->PlaceHolder = RemoveHtml($this->direction_9->caption());

		// planned_date_9
		$this->planned_date_9->EditAttrs["class"] = "form-control";
		$this->planned_date_9->EditCustomAttributes = "";
		$this->planned_date_9->EditValue = FormatDateTime($this->planned_date_9->CurrentValue, 8);
		$this->planned_date_9->PlaceHolder = RemoveHtml($this->planned_date_9->caption());

		// transmit_date_9
		$this->transmit_date_9->EditAttrs["class"] = "form-control";
		$this->transmit_date_9->EditCustomAttributes = "";
		$this->transmit_date_9->EditValue = FormatDateTime($this->transmit_date_9->CurrentValue, 8);
		$this->transmit_date_9->PlaceHolder = RemoveHtml($this->transmit_date_9->caption());

		// transmit_no_9
		$this->transmit_no_9->EditAttrs["class"] = "form-control";
		$this->transmit_no_9->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_9->CurrentValue = HtmlDecode($this->transmit_no_9->CurrentValue);
		$this->transmit_no_9->EditValue = $this->transmit_no_9->CurrentValue;
		$this->transmit_no_9->PlaceHolder = RemoveHtml($this->transmit_no_9->caption());

		// approval_status_9
		$this->approval_status_9->EditAttrs["class"] = "form-control";
		$this->approval_status_9->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_9->CurrentValue = HtmlDecode($this->approval_status_9->CurrentValue);
		$this->approval_status_9->EditValue = $this->approval_status_9->CurrentValue;
		$this->approval_status_9->PlaceHolder = RemoveHtml($this->approval_status_9->caption());

		// direction_file_9
		$this->direction_file_9->EditAttrs["class"] = "form-control";
		$this->direction_file_9->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_file_9->CurrentValue = HtmlDecode($this->direction_file_9->CurrentValue);
		$this->direction_file_9->EditValue = $this->direction_file_9->CurrentValue;
		$this->direction_file_9->PlaceHolder = RemoveHtml($this->direction_file_9->caption());

		// submit_no_10
		$this->submit_no_10->EditAttrs["class"] = "form-control";
		$this->submit_no_10->EditCustomAttributes = "";
		$this->submit_no_10->EditValue = $this->submit_no_10->CurrentValue;
		$this->submit_no_10->PlaceHolder = RemoveHtml($this->submit_no_10->caption());

		// revision_no_10
		$this->revision_no_10->EditAttrs["class"] = "form-control";
		$this->revision_no_10->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_10->CurrentValue = HtmlDecode($this->revision_no_10->CurrentValue);
		$this->revision_no_10->EditValue = $this->revision_no_10->CurrentValue;
		$this->revision_no_10->PlaceHolder = RemoveHtml($this->revision_no_10->caption());

		// direction_10
		$this->direction_10->EditAttrs["class"] = "form-control";
		$this->direction_10->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_10->CurrentValue = HtmlDecode($this->direction_10->CurrentValue);
		$this->direction_10->EditValue = $this->direction_10->CurrentValue;
		$this->direction_10->PlaceHolder = RemoveHtml($this->direction_10->caption());

		// planned_date_10
		$this->planned_date_10->EditAttrs["class"] = "form-control";
		$this->planned_date_10->EditCustomAttributes = "";
		$this->planned_date_10->EditValue = FormatDateTime($this->planned_date_10->CurrentValue, 8);
		$this->planned_date_10->PlaceHolder = RemoveHtml($this->planned_date_10->caption());

		// transmit_date_10
		$this->transmit_date_10->EditAttrs["class"] = "form-control";
		$this->transmit_date_10->EditCustomAttributes = "";
		$this->transmit_date_10->EditValue = FormatDateTime($this->transmit_date_10->CurrentValue, 8);
		$this->transmit_date_10->PlaceHolder = RemoveHtml($this->transmit_date_10->caption());

		// transmit_no_10
		$this->transmit_no_10->EditAttrs["class"] = "form-control";
		$this->transmit_no_10->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_10->CurrentValue = HtmlDecode($this->transmit_no_10->CurrentValue);
		$this->transmit_no_10->EditValue = $this->transmit_no_10->CurrentValue;
		$this->transmit_no_10->PlaceHolder = RemoveHtml($this->transmit_no_10->caption());

		// approval_status_10
		$this->approval_status_10->EditAttrs["class"] = "form-control";
		$this->approval_status_10->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_10->CurrentValue = HtmlDecode($this->approval_status_10->CurrentValue);
		$this->approval_status_10->EditValue = $this->approval_status_10->CurrentValue;
		$this->approval_status_10->PlaceHolder = RemoveHtml($this->approval_status_10->caption());

		// direction_file_10
		$this->direction_file_10->EditAttrs["class"] = "form-control";
		$this->direction_file_10->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_file_10->CurrentValue = HtmlDecode($this->direction_file_10->CurrentValue);
		$this->direction_file_10->EditValue = $this->direction_file_10->CurrentValue;
		$this->direction_file_10->PlaceHolder = RemoveHtml($this->direction_file_10->caption());

		// log_updatedon
		$this->log_updatedon->EditAttrs["class"] = "form-control";
		$this->log_updatedon->EditCustomAttributes = "";
		$this->log_updatedon->EditValue = FormatDateTime($this->log_updatedon->CurrentValue, 109);
		$this->log_updatedon->PlaceHolder = RemoveHtml($this->log_updatedon->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->firelink_doc_no);
					$doc->exportCaption($this->client_doc_no);
					$doc->exportCaption($this->order_number);
					$doc->exportCaption($this->project_name);
					$doc->exportCaption($this->document_tittle);
					$doc->exportCaption($this->current_status);
					$doc->exportCaption($this->submit_no_1);
					$doc->exportCaption($this->revision_no_1);
					$doc->exportCaption($this->direction_1);
					$doc->exportCaption($this->transmit_no_1);
					$doc->exportCaption($this->approval_status_1);
					$doc->exportCaption($this->submit_no_2);
					$doc->exportCaption($this->revision_no_2);
					$doc->exportCaption($this->direction_2);
					$doc->exportCaption($this->planned_date_2);
					$doc->exportCaption($this->transmit_date_2);
					$doc->exportCaption($this->transmit_no_2);
					$doc->exportCaption($this->approval_status_2);
					$doc->exportCaption($this->submit_no_3);
					$doc->exportCaption($this->revision_no_3);
					$doc->exportCaption($this->direction_3);
					$doc->exportCaption($this->planned_date_3);
					$doc->exportCaption($this->transmit_date_3);
					$doc->exportCaption($this->transmit_no_3);
					$doc->exportCaption($this->approval_status_3);
					$doc->exportCaption($this->submit_no_4);
					$doc->exportCaption($this->revision_no_4);
					$doc->exportCaption($this->direction_4);
					$doc->exportCaption($this->planned_date_4);
					$doc->exportCaption($this->transmit_date_4);
					$doc->exportCaption($this->transmit_no_4);
					$doc->exportCaption($this->approval_status_4);
					$doc->exportCaption($this->submit_no_5);
					$doc->exportCaption($this->revision_no_5);
					$doc->exportCaption($this->direction_5);
					$doc->exportCaption($this->planned_date_5);
					$doc->exportCaption($this->transmit_date_5);
					$doc->exportCaption($this->transmit_no_5);
					$doc->exportCaption($this->approval_status_5);
					$doc->exportCaption($this->submit_no_6);
					$doc->exportCaption($this->revision_no_6);
					$doc->exportCaption($this->direction_6);
					$doc->exportCaption($this->planned_date_6);
					$doc->exportCaption($this->transmit_date_6);
					$doc->exportCaption($this->transmit_no_6);
					$doc->exportCaption($this->approval_status_6);
					$doc->exportCaption($this->submit_no_7);
					$doc->exportCaption($this->revision_no_7);
					$doc->exportCaption($this->direction_7);
					$doc->exportCaption($this->planned_date_7);
					$doc->exportCaption($this->transmit_date_7);
					$doc->exportCaption($this->transmit_no_7);
					$doc->exportCaption($this->approval_status_7);
					$doc->exportCaption($this->submit_no_8);
					$doc->exportCaption($this->revision_no_8);
					$doc->exportCaption($this->direction_8);
					$doc->exportCaption($this->planned_date_8);
					$doc->exportCaption($this->transmit_date_8);
					$doc->exportCaption($this->transmit_no_8);
					$doc->exportCaption($this->approval_status_8);
					$doc->exportCaption($this->submit_no_9);
					$doc->exportCaption($this->revision_no_9);
					$doc->exportCaption($this->direction_9);
					$doc->exportCaption($this->planned_date_9);
					$doc->exportCaption($this->transmit_date_9);
					$doc->exportCaption($this->transmit_no_9);
					$doc->exportCaption($this->approval_status_9);
					$doc->exportCaption($this->submit_no_10);
					$doc->exportCaption($this->revision_no_10);
					$doc->exportCaption($this->direction_10);
					$doc->exportCaption($this->planned_date_10);
					$doc->exportCaption($this->transmit_date_10);
					$doc->exportCaption($this->transmit_no_10);
					$doc->exportCaption($this->approval_status_10);
					$doc->exportCaption($this->log_updatedon);
				} else {
					$doc->exportCaption($this->firelink_doc_no);
					$doc->exportCaption($this->client_doc_no);
					$doc->exportCaption($this->order_number);
					$doc->exportCaption($this->project_name);
					$doc->exportCaption($this->document_tittle);
					$doc->exportCaption($this->current_status);
					$doc->exportCaption($this->submit_no_1);
					$doc->exportCaption($this->revision_no_1);
					$doc->exportCaption($this->direction_1);
					$doc->exportCaption($this->transmit_no_1);
					$doc->exportCaption($this->approval_status_1);
					$doc->exportCaption($this->submit_no_2);
					$doc->exportCaption($this->revision_no_2);
					$doc->exportCaption($this->direction_2);
					$doc->exportCaption($this->planned_date_2);
					$doc->exportCaption($this->transmit_date_2);
					$doc->exportCaption($this->transmit_no_2);
					$doc->exportCaption($this->approval_status_2);
					$doc->exportCaption($this->submit_no_3);
					$doc->exportCaption($this->revision_no_3);
					$doc->exportCaption($this->direction_3);
					$doc->exportCaption($this->planned_date_3);
					$doc->exportCaption($this->transmit_date_3);
					$doc->exportCaption($this->transmit_no_3);
					$doc->exportCaption($this->approval_status_3);
					$doc->exportCaption($this->submit_no_4);
					$doc->exportCaption($this->revision_no_4);
					$doc->exportCaption($this->direction_4);
					$doc->exportCaption($this->planned_date_4);
					$doc->exportCaption($this->transmit_date_4);
					$doc->exportCaption($this->transmit_no_4);
					$doc->exportCaption($this->approval_status_4);
					$doc->exportCaption($this->submit_no_5);
					$doc->exportCaption($this->revision_no_5);
					$doc->exportCaption($this->direction_5);
					$doc->exportCaption($this->planned_date_5);
					$doc->exportCaption($this->transmit_date_5);
					$doc->exportCaption($this->transmit_no_5);
					$doc->exportCaption($this->approval_status_5);
					$doc->exportCaption($this->submit_no_6);
					$doc->exportCaption($this->revision_no_6);
					$doc->exportCaption($this->direction_6);
					$doc->exportCaption($this->planned_date_6);
					$doc->exportCaption($this->transmit_date_6);
					$doc->exportCaption($this->transmit_no_6);
					$doc->exportCaption($this->approval_status_6);
					$doc->exportCaption($this->submit_no_7);
					$doc->exportCaption($this->revision_no_7);
					$doc->exportCaption($this->direction_7);
					$doc->exportCaption($this->planned_date_7);
					$doc->exportCaption($this->transmit_date_7);
					$doc->exportCaption($this->transmit_no_7);
					$doc->exportCaption($this->approval_status_7);
					$doc->exportCaption($this->submit_no_8);
					$doc->exportCaption($this->revision_no_8);
					$doc->exportCaption($this->direction_8);
					$doc->exportCaption($this->planned_date_8);
					$doc->exportCaption($this->transmit_date_8);
					$doc->exportCaption($this->transmit_no_8);
					$doc->exportCaption($this->approval_status_8);
					$doc->exportCaption($this->submit_no_9);
					$doc->exportCaption($this->revision_no_9);
					$doc->exportCaption($this->direction_9);
					$doc->exportCaption($this->planned_date_9);
					$doc->exportCaption($this->transmit_date_9);
					$doc->exportCaption($this->transmit_no_9);
					$doc->exportCaption($this->approval_status_9);
					$doc->exportCaption($this->submit_no_10);
					$doc->exportCaption($this->revision_no_10);
					$doc->exportCaption($this->direction_10);
					$doc->exportCaption($this->planned_date_10);
					$doc->exportCaption($this->transmit_date_10);
					$doc->exportCaption($this->transmit_no_10);
					$doc->exportCaption($this->approval_status_10);
					$doc->exportCaption($this->log_updatedon);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->firelink_doc_no);
						$doc->exportField($this->client_doc_no);
						$doc->exportField($this->order_number);
						$doc->exportField($this->project_name);
						$doc->exportField($this->document_tittle);
						$doc->exportField($this->current_status);
						$doc->exportField($this->submit_no_1);
						$doc->exportField($this->revision_no_1);
						$doc->exportField($this->direction_1);
						$doc->exportField($this->transmit_no_1);
						$doc->exportField($this->approval_status_1);
						$doc->exportField($this->submit_no_2);
						$doc->exportField($this->revision_no_2);
						$doc->exportField($this->direction_2);
						$doc->exportField($this->planned_date_2);
						$doc->exportField($this->transmit_date_2);
						$doc->exportField($this->transmit_no_2);
						$doc->exportField($this->approval_status_2);
						$doc->exportField($this->submit_no_3);
						$doc->exportField($this->revision_no_3);
						$doc->exportField($this->direction_3);
						$doc->exportField($this->planned_date_3);
						$doc->exportField($this->transmit_date_3);
						$doc->exportField($this->transmit_no_3);
						$doc->exportField($this->approval_status_3);
						$doc->exportField($this->submit_no_4);
						$doc->exportField($this->revision_no_4);
						$doc->exportField($this->direction_4);
						$doc->exportField($this->planned_date_4);
						$doc->exportField($this->transmit_date_4);
						$doc->exportField($this->transmit_no_4);
						$doc->exportField($this->approval_status_4);
						$doc->exportField($this->submit_no_5);
						$doc->exportField($this->revision_no_5);
						$doc->exportField($this->direction_5);
						$doc->exportField($this->planned_date_5);
						$doc->exportField($this->transmit_date_5);
						$doc->exportField($this->transmit_no_5);
						$doc->exportField($this->approval_status_5);
						$doc->exportField($this->submit_no_6);
						$doc->exportField($this->revision_no_6);
						$doc->exportField($this->direction_6);
						$doc->exportField($this->planned_date_6);
						$doc->exportField($this->transmit_date_6);
						$doc->exportField($this->transmit_no_6);
						$doc->exportField($this->approval_status_6);
						$doc->exportField($this->submit_no_7);
						$doc->exportField($this->revision_no_7);
						$doc->exportField($this->direction_7);
						$doc->exportField($this->planned_date_7);
						$doc->exportField($this->transmit_date_7);
						$doc->exportField($this->transmit_no_7);
						$doc->exportField($this->approval_status_7);
						$doc->exportField($this->submit_no_8);
						$doc->exportField($this->revision_no_8);
						$doc->exportField($this->direction_8);
						$doc->exportField($this->planned_date_8);
						$doc->exportField($this->transmit_date_8);
						$doc->exportField($this->transmit_no_8);
						$doc->exportField($this->approval_status_8);
						$doc->exportField($this->submit_no_9);
						$doc->exportField($this->revision_no_9);
						$doc->exportField($this->direction_9);
						$doc->exportField($this->planned_date_9);
						$doc->exportField($this->transmit_date_9);
						$doc->exportField($this->transmit_no_9);
						$doc->exportField($this->approval_status_9);
						$doc->exportField($this->submit_no_10);
						$doc->exportField($this->revision_no_10);
						$doc->exportField($this->direction_10);
						$doc->exportField($this->planned_date_10);
						$doc->exportField($this->transmit_date_10);
						$doc->exportField($this->transmit_no_10);
						$doc->exportField($this->approval_status_10);
						$doc->exportField($this->log_updatedon);
					} else {
						$doc->exportField($this->firelink_doc_no);
						$doc->exportField($this->client_doc_no);
						$doc->exportField($this->order_number);
						$doc->exportField($this->project_name);
						$doc->exportField($this->document_tittle);
						$doc->exportField($this->current_status);
						$doc->exportField($this->submit_no_1);
						$doc->exportField($this->revision_no_1);
						$doc->exportField($this->direction_1);
						$doc->exportField($this->transmit_no_1);
						$doc->exportField($this->approval_status_1);
						$doc->exportField($this->submit_no_2);
						$doc->exportField($this->revision_no_2);
						$doc->exportField($this->direction_2);
						$doc->exportField($this->planned_date_2);
						$doc->exportField($this->transmit_date_2);
						$doc->exportField($this->transmit_no_2);
						$doc->exportField($this->approval_status_2);
						$doc->exportField($this->submit_no_3);
						$doc->exportField($this->revision_no_3);
						$doc->exportField($this->direction_3);
						$doc->exportField($this->planned_date_3);
						$doc->exportField($this->transmit_date_3);
						$doc->exportField($this->transmit_no_3);
						$doc->exportField($this->approval_status_3);
						$doc->exportField($this->submit_no_4);
						$doc->exportField($this->revision_no_4);
						$doc->exportField($this->direction_4);
						$doc->exportField($this->planned_date_4);
						$doc->exportField($this->transmit_date_4);
						$doc->exportField($this->transmit_no_4);
						$doc->exportField($this->approval_status_4);
						$doc->exportField($this->submit_no_5);
						$doc->exportField($this->revision_no_5);
						$doc->exportField($this->direction_5);
						$doc->exportField($this->planned_date_5);
						$doc->exportField($this->transmit_date_5);
						$doc->exportField($this->transmit_no_5);
						$doc->exportField($this->approval_status_5);
						$doc->exportField($this->submit_no_6);
						$doc->exportField($this->revision_no_6);
						$doc->exportField($this->direction_6);
						$doc->exportField($this->planned_date_6);
						$doc->exportField($this->transmit_date_6);
						$doc->exportField($this->transmit_no_6);
						$doc->exportField($this->approval_status_6);
						$doc->exportField($this->submit_no_7);
						$doc->exportField($this->revision_no_7);
						$doc->exportField($this->direction_7);
						$doc->exportField($this->planned_date_7);
						$doc->exportField($this->transmit_date_7);
						$doc->exportField($this->transmit_no_7);
						$doc->exportField($this->approval_status_7);
						$doc->exportField($this->submit_no_8);
						$doc->exportField($this->revision_no_8);
						$doc->exportField($this->direction_8);
						$doc->exportField($this->planned_date_8);
						$doc->exportField($this->transmit_date_8);
						$doc->exportField($this->transmit_no_8);
						$doc->exportField($this->approval_status_8);
						$doc->exportField($this->submit_no_9);
						$doc->exportField($this->revision_no_9);
						$doc->exportField($this->direction_9);
						$doc->exportField($this->planned_date_9);
						$doc->exportField($this->transmit_date_9);
						$doc->exportField($this->transmit_no_9);
						$doc->exportField($this->approval_status_9);
						$doc->exportField($this->submit_no_10);
						$doc->exportField($this->revision_no_10);
						$doc->exportField($this->direction_10);
						$doc->exportField($this->planned_date_10);
						$doc->exportField($this->transmit_date_10);
						$doc->exportField($this->transmit_no_10);
						$doc->exportField($this->approval_status_10);
						$doc->exportField($this->log_updatedon);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Lookup data from table
	public function lookup()
	{
		global $Language, $LANGUAGE_FOLDER, $PROJECT_ID;
		if (!isset($Language))
			$Language = new Language($LANGUAGE_FOLDER, Post("language", ""));
		global $Security, $RequestSecurity;

		// Check token first
		$func = PROJECT_NAMESPACE . "CheckToken";
		$validRequest = FALSE;
		if (is_callable($func) && Post(TOKEN_NAME) !== NULL) {
			$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			if ($validRequest) {
				if (!isset($Security)) {
					if (session_status() !== PHP_SESSION_ACTIVE)
						session_start(); // Init session data
					$Security = new AdvancedSecurity();
					if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
					$Security->loadCurrentUserLevel($PROJECT_ID . $this->TableName);
					if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
					$validRequest = $Security->canList(); // List permission
					if ($validRequest) {
						$Security->UserID_Loading();
						$Security->loadUserID();
						$Security->UserID_Loaded();
					}
				}
			}
		} else {

			// User profile
			$UserProfile = new UserProfile();

			// Security
			$Security = new AdvancedSecurity();
			if (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
			$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(CurrentProjectID() . $this->TableName);
			$Security->TablePermission_Loaded();
			$validRequest = $Security->canList(); // List permission
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");

		// Selected records from modal, skip parent/filter fields and show all records
		if ($keys !== NULL) {
			$parentFields = [];
			$filterFields = [];
			$filterFieldVars = [];
			$offset = 0;
			$pageSize = 0;
		}

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>