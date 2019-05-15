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
	public $project_name;
	public $document_tittle;
	public $current_status;
	public $current_status_file;
	public $submit_no_sub1;
	public $revision_no_sub1;
	public $direction_out_sub1;
	public $planned_date_out_sub1;
	public $transmit_date_out_sub1;
	public $transmit_no_out_sub1;
	public $approval_status_out_sub1;
	public $direction_out_file_sub1;
	public $direction_in_sub1;
	public $transmit_no_in_sub1;
	public $approval_status_in_sub1;
	public $direction_in_file_sub1;
	public $transmit_date_in_sub1;
	public $submit_no_sub2;
	public $revision_no_sub2;
	public $direction_out_sub2;
	public $planned_date_out_sub2;
	public $transmit_date_out_sub2;
	public $transmit_no_out_sub2;
	public $approval_status_out_sub2;
	public $direction_out_file_sub2;
	public $direction_in_sub2;
	public $transmit_no_in_sub2;
	public $approval_status_in_sub2;
	public $direction_in_file_sub2;
	public $transmit_date_in_sub2;
	public $submit_no_sub3;
	public $revision_no_sub3;
	public $direction_out_sub3;
	public $planned_date_out_sub3;
	public $transmit_date_out_sub3;
	public $transmit_no_out_sub3;
	public $approval_status_out_sub3;
	public $direction_out_file_sub3;
	public $direction_in_sub3;
	public $transmit_no_in_sub3;
	public $approval_status_in_sub3;
	public $direction_in_file_sub3;
	public $transmit_date_in_sub3;
	public $submit_no_sub4;
	public $revision_no_sub4;
	public $direction_out_sub4;
	public $planned_date_out_sub4;
	public $transmit_date_out_sub4;
	public $transmit_no_out_sub4;
	public $approval_status_out_sub4;
	public $direction_out_file_sub4;
	public $direction_in_sub4;
	public $transmit_no_in_sub4;
	public $approval_status_in_sub4;
	public $direction_in_file_sub4;
	public $transmit_date_in_sub4;
	public $submit_no_sub5;
	public $revision_no_sub5;
	public $direction_out_sub5;
	public $planned_date_out_sub5;
	public $transmit_date_out_sub5;
	public $transmit_no_out_sub5;
	public $approval_status_out_sub5;
	public $direction_out_file_sub5;
	public $direction_in_sub5;
	public $transmit_no_in_sub5;
	public $approval_status_in_sub5;
	public $direction_in_file_sub5;
	public $transmit_date_in_sub5;
	public $submit_no_sub6;
	public $revision_no_sub6;
	public $direction_out_sub6;
	public $planned_date_out_sub6;
	public $transmit_date_out_sub6;
	public $transmit_no_out_sub6;
	public $approval_status_out_sub6;
	public $direction_out_file_sub6;
	public $direction_in_sub6;
	public $transmit_no_in_sub6;
	public $approval_status_in_sub6;
	public $direction_in_file_sub6;
	public $transmit_date_in_sub6;
	public $submit_no_sub7;
	public $revision_no_sub7;
	public $direction_out_sub7;
	public $planned_date_out_sub7;
	public $transmit_date_out_sub7;
	public $transmit_no_out_sub7;
	public $approval_status_out_sub7;
	public $direction_out_file_sub7;
	public $direction_in_sub7;
	public $transmit_no_in_sub7;
	public $approval_status_in_sub7;
	public $direction_in_file_sub7;
	public $transmit_date_in_sub7;
	public $submit_no_sub8;
	public $revision_no_sub8;
	public $direction_out_sub8;
	public $planned_date_out_sub8;
	public $transmit_date_out_sub8;
	public $transmit_no_out_sub8;
	public $approval_status_out_sub8;
	public $direction_out_file_sub8;
	public $direction_in_sub8;
	public $transmit_no_in_sub8;
	public $approval_status_in_sub8;
	public $direction_in_file_sub8;
	public $transmit_date_in_sub8;
	public $submit_no_sub9;
	public $revision_no_sub9;
	public $direction_out_sub9;
	public $planned_date_out_sub9;
	public $transmit_date_out_sub9;
	public $transmit_no_out_sub9;
	public $approval_status_out_sub9;
	public $direction_out_file_sub9;
	public $direction_in_sub9;
	public $transmit_no_in_sub9;
	public $approval_status_in_sub9;
	public $direction_in_file_sub9;
	public $transmit_date_in_sub9;
	public $submit_no_sub10;
	public $revision_no_sub10;
	public $direction_out_sub10;
	public $planned_date_out_sub10;
	public $transmit_date_out_sub10;
	public $transmit_no_out_sub10;
	public $approval_status_out_sub10;
	public $direction_out_file_sub10;
	public $direction_in_sub10;
	public $transmit_no_in_sub10;
	public $approval_status_in_sub10;
	public $direction_in_file_sub10;
	public $transmit_date_in_sub10;
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

		// submit_no_sub1
		$this->submit_no_sub1 = new DbField('document_log', 'document_log', 'x_submit_no_sub1', 'submit_no_sub1', '"submit_no_sub1"', '"submit_no_sub1"', 200, -1, FALSE, '"submit_no_sub1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_sub1->Sortable = TRUE; // Allow sort
		$this->fields['submit_no_sub1'] = &$this->submit_no_sub1;

		// revision_no_sub1
		$this->revision_no_sub1 = new DbField('document_log', 'document_log', 'x_revision_no_sub1', 'revision_no_sub1', '"revision_no_sub1"', '"revision_no_sub1"', 200, -1, FALSE, '"revision_no_sub1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_sub1->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_sub1'] = &$this->revision_no_sub1;

		// direction_out_sub1
		$this->direction_out_sub1 = new DbField('document_log', 'document_log', 'x_direction_out_sub1', 'direction_out_sub1', '"direction_out_sub1"', '"direction_out_sub1"', 200, -1, FALSE, '"direction_out_sub1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_sub1->Sortable = TRUE; // Allow sort
		$this->fields['direction_out_sub1'] = &$this->direction_out_sub1;

		// planned_date_out_sub1
		$this->planned_date_out_sub1 = new DbField('document_log', 'document_log', 'x_planned_date_out_sub1', 'planned_date_out_sub1', '"planned_date_out_sub1"', CastDateFieldForLike('"planned_date_out_sub1"', 0, "DB"), 133, 0, FALSE, '"planned_date_out_sub1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_out_sub1->Sortable = TRUE; // Allow sort
		$this->planned_date_out_sub1->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_out_sub1'] = &$this->planned_date_out_sub1;

		// transmit_date_out_sub1
		$this->transmit_date_out_sub1 = new DbField('document_log', 'document_log', 'x_transmit_date_out_sub1', 'transmit_date_out_sub1', '"transmit_date_out_sub1"', CastDateFieldForLike('"transmit_date_out_sub1"', 0, "DB"), 133, 0, FALSE, '"transmit_date_out_sub1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_out_sub1->Sortable = TRUE; // Allow sort
		$this->transmit_date_out_sub1->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_out_sub1'] = &$this->transmit_date_out_sub1;

		// transmit_no_out_sub1
		$this->transmit_no_out_sub1 = new DbField('document_log', 'document_log', 'x_transmit_no_out_sub1', 'transmit_no_out_sub1', '"transmit_no_out_sub1"', '"transmit_no_out_sub1"', 200, -1, FALSE, '"transmit_no_out_sub1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_out_sub1->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_out_sub1'] = &$this->transmit_no_out_sub1;

		// approval_status_out_sub1
		$this->approval_status_out_sub1 = new DbField('document_log', 'document_log', 'x_approval_status_out_sub1', 'approval_status_out_sub1', '"approval_status_out_sub1"', '"approval_status_out_sub1"', 200, -1, FALSE, '"approval_status_out_sub1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_out_sub1->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_out_sub1'] = &$this->approval_status_out_sub1;

		// direction_out_file_sub1
		$this->direction_out_file_sub1 = new DbField('document_log', 'document_log', 'x_direction_out_file_sub1', 'direction_out_file_sub1', '"direction_out_file_sub1"', '"direction_out_file_sub1"', 200, -1, FALSE, '"direction_out_file_sub1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_file_sub1->Sortable = TRUE; // Allow sort
		$this->fields['direction_out_file_sub1'] = &$this->direction_out_file_sub1;

		// direction_in_sub1
		$this->direction_in_sub1 = new DbField('document_log', 'document_log', 'x_direction_in_sub1', 'direction_in_sub1', '"direction_in_sub1"', '"direction_in_sub1"', 200, -1, FALSE, '"direction_in_sub1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_sub1->Sortable = TRUE; // Allow sort
		$this->fields['direction_in_sub1'] = &$this->direction_in_sub1;

		// transmit_no_in_sub1
		$this->transmit_no_in_sub1 = new DbField('document_log', 'document_log', 'x_transmit_no_in_sub1', 'transmit_no_in_sub1', '"transmit_no_in_sub1"', '"transmit_no_in_sub1"', 200, -1, FALSE, '"transmit_no_in_sub1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_in_sub1->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_in_sub1'] = &$this->transmit_no_in_sub1;

		// approval_status_in_sub1
		$this->approval_status_in_sub1 = new DbField('document_log', 'document_log', 'x_approval_status_in_sub1', 'approval_status_in_sub1', '"approval_status_in_sub1"', '"approval_status_in_sub1"', 200, -1, FALSE, '"approval_status_in_sub1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_in_sub1->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_in_sub1'] = &$this->approval_status_in_sub1;

		// direction_in_file_sub1
		$this->direction_in_file_sub1 = new DbField('document_log', 'document_log', 'x_direction_in_file_sub1', 'direction_in_file_sub1', '"direction_in_file_sub1"', '"direction_in_file_sub1"', 200, -1, FALSE, '"direction_in_file_sub1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_file_sub1->Sortable = FALSE; // Allow sort
		$this->fields['direction_in_file_sub1'] = &$this->direction_in_file_sub1;

		// transmit_date_in_sub1
		$this->transmit_date_in_sub1 = new DbField('document_log', 'document_log', 'x_transmit_date_in_sub1', 'transmit_date_in_sub1', '"transmit_date_in_sub1"', CastDateFieldForLike('"transmit_date_in_sub1"', 0, "DB"), 133, 0, FALSE, '"transmit_date_in_sub1"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_in_sub1->Sortable = TRUE; // Allow sort
		$this->transmit_date_in_sub1->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_in_sub1'] = &$this->transmit_date_in_sub1;

		// submit_no_sub2
		$this->submit_no_sub2 = new DbField('document_log', 'document_log', 'x_submit_no_sub2', 'submit_no_sub2', '"submit_no_sub2"', '"submit_no_sub2"', 200, -1, FALSE, '"submit_no_sub2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_sub2->Sortable = TRUE; // Allow sort
		$this->fields['submit_no_sub2'] = &$this->submit_no_sub2;

		// revision_no_sub2
		$this->revision_no_sub2 = new DbField('document_log', 'document_log', 'x_revision_no_sub2', 'revision_no_sub2', '"revision_no_sub2"', '"revision_no_sub2"', 200, -1, FALSE, '"revision_no_sub2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_sub2->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_sub2'] = &$this->revision_no_sub2;

		// direction_out_sub2
		$this->direction_out_sub2 = new DbField('document_log', 'document_log', 'x_direction_out_sub2', 'direction_out_sub2', '"direction_out_sub2"', '"direction_out_sub2"', 200, -1, FALSE, '"direction_out_sub2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_sub2->Sortable = TRUE; // Allow sort
		$this->fields['direction_out_sub2'] = &$this->direction_out_sub2;

		// planned_date_out_sub2
		$this->planned_date_out_sub2 = new DbField('document_log', 'document_log', 'x_planned_date_out_sub2', 'planned_date_out_sub2', '"planned_date_out_sub2"', CastDateFieldForLike('"planned_date_out_sub2"', 0, "DB"), 133, 0, FALSE, '"planned_date_out_sub2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_out_sub2->Sortable = TRUE; // Allow sort
		$this->planned_date_out_sub2->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_out_sub2'] = &$this->planned_date_out_sub2;

		// transmit_date_out_sub2
		$this->transmit_date_out_sub2 = new DbField('document_log', 'document_log', 'x_transmit_date_out_sub2', 'transmit_date_out_sub2', '"transmit_date_out_sub2"', CastDateFieldForLike('"transmit_date_out_sub2"', 0, "DB"), 133, 0, FALSE, '"transmit_date_out_sub2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_out_sub2->Sortable = TRUE; // Allow sort
		$this->transmit_date_out_sub2->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_out_sub2'] = &$this->transmit_date_out_sub2;

		// transmit_no_out_sub2
		$this->transmit_no_out_sub2 = new DbField('document_log', 'document_log', 'x_transmit_no_out_sub2', 'transmit_no_out_sub2', '"transmit_no_out_sub2"', '"transmit_no_out_sub2"', 200, -1, FALSE, '"transmit_no_out_sub2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_out_sub2->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_out_sub2'] = &$this->transmit_no_out_sub2;

		// approval_status_out_sub2
		$this->approval_status_out_sub2 = new DbField('document_log', 'document_log', 'x_approval_status_out_sub2', 'approval_status_out_sub2', '"approval_status_out_sub2"', '"approval_status_out_sub2"', 200, -1, FALSE, '"approval_status_out_sub2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_out_sub2->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_out_sub2'] = &$this->approval_status_out_sub2;

		// direction_out_file_sub2
		$this->direction_out_file_sub2 = new DbField('document_log', 'document_log', 'x_direction_out_file_sub2', 'direction_out_file_sub2', '"direction_out_file_sub2"', '"direction_out_file_sub2"', 200, -1, FALSE, '"direction_out_file_sub2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_file_sub2->Sortable = FALSE; // Allow sort
		$this->fields['direction_out_file_sub2'] = &$this->direction_out_file_sub2;

		// direction_in_sub2
		$this->direction_in_sub2 = new DbField('document_log', 'document_log', 'x_direction_in_sub2', 'direction_in_sub2', '"direction_in_sub2"', '"direction_in_sub2"', 200, -1, FALSE, '"direction_in_sub2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_sub2->Sortable = TRUE; // Allow sort
		$this->fields['direction_in_sub2'] = &$this->direction_in_sub2;

		// transmit_no_in_sub2
		$this->transmit_no_in_sub2 = new DbField('document_log', 'document_log', 'x_transmit_no_in_sub2', 'transmit_no_in_sub2', '"transmit_no_in_sub2"', '"transmit_no_in_sub2"', 200, -1, FALSE, '"transmit_no_in_sub2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_in_sub2->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_in_sub2'] = &$this->transmit_no_in_sub2;

		// approval_status_in_sub2
		$this->approval_status_in_sub2 = new DbField('document_log', 'document_log', 'x_approval_status_in_sub2', 'approval_status_in_sub2', '"approval_status_in_sub2"', '"approval_status_in_sub2"', 200, -1, FALSE, '"approval_status_in_sub2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_in_sub2->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_in_sub2'] = &$this->approval_status_in_sub2;

		// direction_in_file_sub2
		$this->direction_in_file_sub2 = new DbField('document_log', 'document_log', 'x_direction_in_file_sub2', 'direction_in_file_sub2', '"direction_in_file_sub2"', '"direction_in_file_sub2"', 200, -1, FALSE, '"direction_in_file_sub2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_file_sub2->Sortable = FALSE; // Allow sort
		$this->fields['direction_in_file_sub2'] = &$this->direction_in_file_sub2;

		// transmit_date_in_sub2
		$this->transmit_date_in_sub2 = new DbField('document_log', 'document_log', 'x_transmit_date_in_sub2', 'transmit_date_in_sub2', '"transmit_date_in_sub2"', CastDateFieldForLike('"transmit_date_in_sub2"', 0, "DB"), 133, 0, FALSE, '"transmit_date_in_sub2"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_in_sub2->Sortable = TRUE; // Allow sort
		$this->transmit_date_in_sub2->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_in_sub2'] = &$this->transmit_date_in_sub2;

		// submit_no_sub3
		$this->submit_no_sub3 = new DbField('document_log', 'document_log', 'x_submit_no_sub3', 'submit_no_sub3', '"submit_no_sub3"', '"submit_no_sub3"', 200, -1, FALSE, '"submit_no_sub3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_sub3->Sortable = TRUE; // Allow sort
		$this->fields['submit_no_sub3'] = &$this->submit_no_sub3;

		// revision_no_sub3
		$this->revision_no_sub3 = new DbField('document_log', 'document_log', 'x_revision_no_sub3', 'revision_no_sub3', '"revision_no_sub3"', '"revision_no_sub3"', 200, -1, FALSE, '"revision_no_sub3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_sub3->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_sub3'] = &$this->revision_no_sub3;

		// direction_out_sub3
		$this->direction_out_sub3 = new DbField('document_log', 'document_log', 'x_direction_out_sub3', 'direction_out_sub3', '"direction_out_sub3"', '"direction_out_sub3"', 200, -1, FALSE, '"direction_out_sub3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_sub3->Sortable = TRUE; // Allow sort
		$this->fields['direction_out_sub3'] = &$this->direction_out_sub3;

		// planned_date_out_sub3
		$this->planned_date_out_sub3 = new DbField('document_log', 'document_log', 'x_planned_date_out_sub3', 'planned_date_out_sub3', '"planned_date_out_sub3"', CastDateFieldForLike('"planned_date_out_sub3"', 0, "DB"), 133, 0, FALSE, '"planned_date_out_sub3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_out_sub3->Sortable = TRUE; // Allow sort
		$this->planned_date_out_sub3->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_out_sub3'] = &$this->planned_date_out_sub3;

		// transmit_date_out_sub3
		$this->transmit_date_out_sub3 = new DbField('document_log', 'document_log', 'x_transmit_date_out_sub3', 'transmit_date_out_sub3', '"transmit_date_out_sub3"', CastDateFieldForLike('"transmit_date_out_sub3"', 0, "DB"), 133, 0, FALSE, '"transmit_date_out_sub3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_out_sub3->Sortable = TRUE; // Allow sort
		$this->transmit_date_out_sub3->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_out_sub3'] = &$this->transmit_date_out_sub3;

		// transmit_no_out_sub3
		$this->transmit_no_out_sub3 = new DbField('document_log', 'document_log', 'x_transmit_no_out_sub3', 'transmit_no_out_sub3', '"transmit_no_out_sub3"', '"transmit_no_out_sub3"', 200, -1, FALSE, '"transmit_no_out_sub3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_out_sub3->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_out_sub3'] = &$this->transmit_no_out_sub3;

		// approval_status_out_sub3
		$this->approval_status_out_sub3 = new DbField('document_log', 'document_log', 'x_approval_status_out_sub3', 'approval_status_out_sub3', '"approval_status_out_sub3"', '"approval_status_out_sub3"', 200, -1, FALSE, '"approval_status_out_sub3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_out_sub3->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_out_sub3'] = &$this->approval_status_out_sub3;

		// direction_out_file_sub3
		$this->direction_out_file_sub3 = new DbField('document_log', 'document_log', 'x_direction_out_file_sub3', 'direction_out_file_sub3', '"direction_out_file_sub3"', '"direction_out_file_sub3"', 200, -1, FALSE, '"direction_out_file_sub3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_file_sub3->Sortable = FALSE; // Allow sort
		$this->fields['direction_out_file_sub3'] = &$this->direction_out_file_sub3;

		// direction_in_sub3
		$this->direction_in_sub3 = new DbField('document_log', 'document_log', 'x_direction_in_sub3', 'direction_in_sub3', '"direction_in_sub3"', '"direction_in_sub3"', 200, -1, FALSE, '"direction_in_sub3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_sub3->Sortable = TRUE; // Allow sort
		$this->fields['direction_in_sub3'] = &$this->direction_in_sub3;

		// transmit_no_in_sub3
		$this->transmit_no_in_sub3 = new DbField('document_log', 'document_log', 'x_transmit_no_in_sub3', 'transmit_no_in_sub3', '"transmit_no_in_sub3"', '"transmit_no_in_sub3"', 200, -1, FALSE, '"transmit_no_in_sub3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_in_sub3->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_in_sub3'] = &$this->transmit_no_in_sub3;

		// approval_status_in_sub3
		$this->approval_status_in_sub3 = new DbField('document_log', 'document_log', 'x_approval_status_in_sub3', 'approval_status_in_sub3', '"approval_status_in_sub3"', '"approval_status_in_sub3"', 200, -1, FALSE, '"approval_status_in_sub3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_in_sub3->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_in_sub3'] = &$this->approval_status_in_sub3;

		// direction_in_file_sub3
		$this->direction_in_file_sub3 = new DbField('document_log', 'document_log', 'x_direction_in_file_sub3', 'direction_in_file_sub3', '"direction_in_file_sub3"', '"direction_in_file_sub3"', 200, -1, FALSE, '"direction_in_file_sub3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_file_sub3->Sortable = FALSE; // Allow sort
		$this->fields['direction_in_file_sub3'] = &$this->direction_in_file_sub3;

		// transmit_date_in_sub3
		$this->transmit_date_in_sub3 = new DbField('document_log', 'document_log', 'x_transmit_date_in_sub3', 'transmit_date_in_sub3', '"transmit_date_in_sub3"', CastDateFieldForLike('"transmit_date_in_sub3"', 0, "DB"), 133, 0, FALSE, '"transmit_date_in_sub3"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_in_sub3->Sortable = TRUE; // Allow sort
		$this->transmit_date_in_sub3->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_in_sub3'] = &$this->transmit_date_in_sub3;

		// submit_no_sub4
		$this->submit_no_sub4 = new DbField('document_log', 'document_log', 'x_submit_no_sub4', 'submit_no_sub4', '"submit_no_sub4"', '"submit_no_sub4"', 200, -1, FALSE, '"submit_no_sub4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_sub4->Sortable = TRUE; // Allow sort
		$this->fields['submit_no_sub4'] = &$this->submit_no_sub4;

		// revision_no_sub4
		$this->revision_no_sub4 = new DbField('document_log', 'document_log', 'x_revision_no_sub4', 'revision_no_sub4', '"revision_no_sub4"', '"revision_no_sub4"', 200, -1, FALSE, '"revision_no_sub4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_sub4->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_sub4'] = &$this->revision_no_sub4;

		// direction_out_sub4
		$this->direction_out_sub4 = new DbField('document_log', 'document_log', 'x_direction_out_sub4', 'direction_out_sub4', '"direction_out_sub4"', '"direction_out_sub4"', 200, -1, FALSE, '"direction_out_sub4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_sub4->Sortable = TRUE; // Allow sort
		$this->fields['direction_out_sub4'] = &$this->direction_out_sub4;

		// planned_date_out_sub4
		$this->planned_date_out_sub4 = new DbField('document_log', 'document_log', 'x_planned_date_out_sub4', 'planned_date_out_sub4', '"planned_date_out_sub4"', CastDateFieldForLike('"planned_date_out_sub4"', 0, "DB"), 133, 0, FALSE, '"planned_date_out_sub4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_out_sub4->Sortable = TRUE; // Allow sort
		$this->planned_date_out_sub4->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_out_sub4'] = &$this->planned_date_out_sub4;

		// transmit_date_out_sub4
		$this->transmit_date_out_sub4 = new DbField('document_log', 'document_log', 'x_transmit_date_out_sub4', 'transmit_date_out_sub4', '"transmit_date_out_sub4"', CastDateFieldForLike('"transmit_date_out_sub4"', 0, "DB"), 133, 0, FALSE, '"transmit_date_out_sub4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_out_sub4->Sortable = TRUE; // Allow sort
		$this->transmit_date_out_sub4->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_out_sub4'] = &$this->transmit_date_out_sub4;

		// transmit_no_out_sub4
		$this->transmit_no_out_sub4 = new DbField('document_log', 'document_log', 'x_transmit_no_out_sub4', 'transmit_no_out_sub4', '"transmit_no_out_sub4"', '"transmit_no_out_sub4"', 200, -1, FALSE, '"transmit_no_out_sub4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_out_sub4->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_out_sub4'] = &$this->transmit_no_out_sub4;

		// approval_status_out_sub4
		$this->approval_status_out_sub4 = new DbField('document_log', 'document_log', 'x_approval_status_out_sub4', 'approval_status_out_sub4', '"approval_status_out_sub4"', '"approval_status_out_sub4"', 200, -1, FALSE, '"approval_status_out_sub4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_out_sub4->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_out_sub4'] = &$this->approval_status_out_sub4;

		// direction_out_file_sub4
		$this->direction_out_file_sub4 = new DbField('document_log', 'document_log', 'x_direction_out_file_sub4', 'direction_out_file_sub4', '"direction_out_file_sub4"', '"direction_out_file_sub4"', 200, -1, FALSE, '"direction_out_file_sub4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_file_sub4->Sortable = FALSE; // Allow sort
		$this->fields['direction_out_file_sub4'] = &$this->direction_out_file_sub4;

		// direction_in_sub4
		$this->direction_in_sub4 = new DbField('document_log', 'document_log', 'x_direction_in_sub4', 'direction_in_sub4', '"direction_in_sub4"', '"direction_in_sub4"', 200, -1, FALSE, '"direction_in_sub4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_sub4->Sortable = TRUE; // Allow sort
		$this->fields['direction_in_sub4'] = &$this->direction_in_sub4;

		// transmit_no_in_sub4
		$this->transmit_no_in_sub4 = new DbField('document_log', 'document_log', 'x_transmit_no_in_sub4', 'transmit_no_in_sub4', '"transmit_no_in_sub4"', '"transmit_no_in_sub4"', 200, -1, FALSE, '"transmit_no_in_sub4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_in_sub4->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_in_sub4'] = &$this->transmit_no_in_sub4;

		// approval_status_in_sub4
		$this->approval_status_in_sub4 = new DbField('document_log', 'document_log', 'x_approval_status_in_sub4', 'approval_status_in_sub4', '"approval_status_in_sub4"', '"approval_status_in_sub4"', 200, -1, FALSE, '"approval_status_in_sub4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_in_sub4->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_in_sub4'] = &$this->approval_status_in_sub4;

		// direction_in_file_sub4
		$this->direction_in_file_sub4 = new DbField('document_log', 'document_log', 'x_direction_in_file_sub4', 'direction_in_file_sub4', '"direction_in_file_sub4"', '"direction_in_file_sub4"', 200, -1, FALSE, '"direction_in_file_sub4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_file_sub4->Sortable = TRUE; // Allow sort
		$this->fields['direction_in_file_sub4'] = &$this->direction_in_file_sub4;

		// transmit_date_in_sub4
		$this->transmit_date_in_sub4 = new DbField('document_log', 'document_log', 'x_transmit_date_in_sub4', 'transmit_date_in_sub4', '"transmit_date_in_sub4"', CastDateFieldForLike('"transmit_date_in_sub4"', 0, "DB"), 133, 0, FALSE, '"transmit_date_in_sub4"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_in_sub4->Sortable = TRUE; // Allow sort
		$this->transmit_date_in_sub4->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_in_sub4'] = &$this->transmit_date_in_sub4;

		// submit_no_sub5
		$this->submit_no_sub5 = new DbField('document_log', 'document_log', 'x_submit_no_sub5', 'submit_no_sub5', '"submit_no_sub5"', '"submit_no_sub5"', 200, -1, FALSE, '"submit_no_sub5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_sub5->Sortable = TRUE; // Allow sort
		$this->fields['submit_no_sub5'] = &$this->submit_no_sub5;

		// revision_no_sub5
		$this->revision_no_sub5 = new DbField('document_log', 'document_log', 'x_revision_no_sub5', 'revision_no_sub5', '"revision_no_sub5"', '"revision_no_sub5"', 200, -1, FALSE, '"revision_no_sub5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_sub5->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_sub5'] = &$this->revision_no_sub5;

		// direction_out_sub5
		$this->direction_out_sub5 = new DbField('document_log', 'document_log', 'x_direction_out_sub5', 'direction_out_sub5', '"direction_out_sub5"', '"direction_out_sub5"', 200, -1, FALSE, '"direction_out_sub5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_sub5->Sortable = TRUE; // Allow sort
		$this->fields['direction_out_sub5'] = &$this->direction_out_sub5;

		// planned_date_out_sub5
		$this->planned_date_out_sub5 = new DbField('document_log', 'document_log', 'x_planned_date_out_sub5', 'planned_date_out_sub5', '"planned_date_out_sub5"', CastDateFieldForLike('"planned_date_out_sub5"', 0, "DB"), 133, 0, FALSE, '"planned_date_out_sub5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_out_sub5->Sortable = TRUE; // Allow sort
		$this->planned_date_out_sub5->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_out_sub5'] = &$this->planned_date_out_sub5;

		// transmit_date_out_sub5
		$this->transmit_date_out_sub5 = new DbField('document_log', 'document_log', 'x_transmit_date_out_sub5', 'transmit_date_out_sub5', '"transmit_date_out_sub5"', CastDateFieldForLike('"transmit_date_out_sub5"', 0, "DB"), 133, 0, FALSE, '"transmit_date_out_sub5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_out_sub5->Sortable = TRUE; // Allow sort
		$this->transmit_date_out_sub5->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_out_sub5'] = &$this->transmit_date_out_sub5;

		// transmit_no_out_sub5
		$this->transmit_no_out_sub5 = new DbField('document_log', 'document_log', 'x_transmit_no_out_sub5', 'transmit_no_out_sub5', '"transmit_no_out_sub5"', '"transmit_no_out_sub5"', 200, -1, FALSE, '"transmit_no_out_sub5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_out_sub5->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_out_sub5'] = &$this->transmit_no_out_sub5;

		// approval_status_out_sub5
		$this->approval_status_out_sub5 = new DbField('document_log', 'document_log', 'x_approval_status_out_sub5', 'approval_status_out_sub5', '"approval_status_out_sub5"', '"approval_status_out_sub5"', 200, -1, FALSE, '"approval_status_out_sub5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_out_sub5->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_out_sub5'] = &$this->approval_status_out_sub5;

		// direction_out_file_sub5
		$this->direction_out_file_sub5 = new DbField('document_log', 'document_log', 'x_direction_out_file_sub5', 'direction_out_file_sub5', '"direction_out_file_sub5"', '"direction_out_file_sub5"', 200, -1, FALSE, '"direction_out_file_sub5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_file_sub5->Sortable = FALSE; // Allow sort
		$this->fields['direction_out_file_sub5'] = &$this->direction_out_file_sub5;

		// direction_in_sub5
		$this->direction_in_sub5 = new DbField('document_log', 'document_log', 'x_direction_in_sub5', 'direction_in_sub5', '"direction_in_sub5"', '"direction_in_sub5"', 200, -1, FALSE, '"direction_in_sub5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_sub5->Sortable = TRUE; // Allow sort
		$this->fields['direction_in_sub5'] = &$this->direction_in_sub5;

		// transmit_no_in_sub5
		$this->transmit_no_in_sub5 = new DbField('document_log', 'document_log', 'x_transmit_no_in_sub5', 'transmit_no_in_sub5', '"transmit_no_in_sub5"', '"transmit_no_in_sub5"', 200, -1, FALSE, '"transmit_no_in_sub5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_in_sub5->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_in_sub5'] = &$this->transmit_no_in_sub5;

		// approval_status_in_sub5
		$this->approval_status_in_sub5 = new DbField('document_log', 'document_log', 'x_approval_status_in_sub5', 'approval_status_in_sub5', '"approval_status_in_sub5"', '"approval_status_in_sub5"', 200, -1, FALSE, '"approval_status_in_sub5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_in_sub5->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_in_sub5'] = &$this->approval_status_in_sub5;

		// direction_in_file_sub5
		$this->direction_in_file_sub5 = new DbField('document_log', 'document_log', 'x_direction_in_file_sub5', 'direction_in_file_sub5', '"direction_in_file_sub5"', '"direction_in_file_sub5"', 200, -1, FALSE, '"direction_in_file_sub5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_file_sub5->Sortable = TRUE; // Allow sort
		$this->fields['direction_in_file_sub5'] = &$this->direction_in_file_sub5;

		// transmit_date_in_sub5
		$this->transmit_date_in_sub5 = new DbField('document_log', 'document_log', 'x_transmit_date_in_sub5', 'transmit_date_in_sub5', '"transmit_date_in_sub5"', CastDateFieldForLike('"transmit_date_in_sub5"', 0, "DB"), 133, 0, FALSE, '"transmit_date_in_sub5"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_in_sub5->Sortable = TRUE; // Allow sort
		$this->transmit_date_in_sub5->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_in_sub5'] = &$this->transmit_date_in_sub5;

		// submit_no_sub6
		$this->submit_no_sub6 = new DbField('document_log', 'document_log', 'x_submit_no_sub6', 'submit_no_sub6', '"submit_no_sub6"', '"submit_no_sub6"', 200, -1, FALSE, '"submit_no_sub6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_sub6->Sortable = TRUE; // Allow sort
		$this->fields['submit_no_sub6'] = &$this->submit_no_sub6;

		// revision_no_sub6
		$this->revision_no_sub6 = new DbField('document_log', 'document_log', 'x_revision_no_sub6', 'revision_no_sub6', '"revision_no_sub6"', '"revision_no_sub6"', 200, -1, FALSE, '"revision_no_sub6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_sub6->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_sub6'] = &$this->revision_no_sub6;

		// direction_out_sub6
		$this->direction_out_sub6 = new DbField('document_log', 'document_log', 'x_direction_out_sub6', 'direction_out_sub6', '"direction_out_sub6"', '"direction_out_sub6"', 200, -1, FALSE, '"direction_out_sub6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_sub6->Sortable = TRUE; // Allow sort
		$this->fields['direction_out_sub6'] = &$this->direction_out_sub6;

		// planned_date_out_sub6
		$this->planned_date_out_sub6 = new DbField('document_log', 'document_log', 'x_planned_date_out_sub6', 'planned_date_out_sub6', '"planned_date_out_sub6"', CastDateFieldForLike('"planned_date_out_sub6"', 0, "DB"), 133, 0, FALSE, '"planned_date_out_sub6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_out_sub6->Sortable = TRUE; // Allow sort
		$this->planned_date_out_sub6->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_out_sub6'] = &$this->planned_date_out_sub6;

		// transmit_date_out_sub6
		$this->transmit_date_out_sub6 = new DbField('document_log', 'document_log', 'x_transmit_date_out_sub6', 'transmit_date_out_sub6', '"transmit_date_out_sub6"', CastDateFieldForLike('"transmit_date_out_sub6"', 0, "DB"), 133, 0, FALSE, '"transmit_date_out_sub6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_out_sub6->Sortable = TRUE; // Allow sort
		$this->transmit_date_out_sub6->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_out_sub6'] = &$this->transmit_date_out_sub6;

		// transmit_no_out_sub6
		$this->transmit_no_out_sub6 = new DbField('document_log', 'document_log', 'x_transmit_no_out_sub6', 'transmit_no_out_sub6', '"transmit_no_out_sub6"', '"transmit_no_out_sub6"', 200, -1, FALSE, '"transmit_no_out_sub6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_out_sub6->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_out_sub6'] = &$this->transmit_no_out_sub6;

		// approval_status_out_sub6
		$this->approval_status_out_sub6 = new DbField('document_log', 'document_log', 'x_approval_status_out_sub6', 'approval_status_out_sub6', '"approval_status_out_sub6"', '"approval_status_out_sub6"', 200, -1, FALSE, '"approval_status_out_sub6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_out_sub6->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_out_sub6'] = &$this->approval_status_out_sub6;

		// direction_out_file_sub6
		$this->direction_out_file_sub6 = new DbField('document_log', 'document_log', 'x_direction_out_file_sub6', 'direction_out_file_sub6', '"direction_out_file_sub6"', '"direction_out_file_sub6"', 200, -1, FALSE, '"direction_out_file_sub6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_file_sub6->Sortable = FALSE; // Allow sort
		$this->fields['direction_out_file_sub6'] = &$this->direction_out_file_sub6;

		// direction_in_sub6
		$this->direction_in_sub6 = new DbField('document_log', 'document_log', 'x_direction_in_sub6', 'direction_in_sub6', '"direction_in_sub6"', '"direction_in_sub6"', 200, -1, FALSE, '"direction_in_sub6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_sub6->Sortable = TRUE; // Allow sort
		$this->fields['direction_in_sub6'] = &$this->direction_in_sub6;

		// transmit_no_in_sub6
		$this->transmit_no_in_sub6 = new DbField('document_log', 'document_log', 'x_transmit_no_in_sub6', 'transmit_no_in_sub6', '"transmit_no_in_sub6"', '"transmit_no_in_sub6"', 200, -1, FALSE, '"transmit_no_in_sub6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_in_sub6->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_in_sub6'] = &$this->transmit_no_in_sub6;

		// approval_status_in_sub6
		$this->approval_status_in_sub6 = new DbField('document_log', 'document_log', 'x_approval_status_in_sub6', 'approval_status_in_sub6', '"approval_status_in_sub6"', '"approval_status_in_sub6"', 200, -1, FALSE, '"approval_status_in_sub6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_in_sub6->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_in_sub6'] = &$this->approval_status_in_sub6;

		// direction_in_file_sub6
		$this->direction_in_file_sub6 = new DbField('document_log', 'document_log', 'x_direction_in_file_sub6', 'direction_in_file_sub6', '"direction_in_file_sub6"', '"direction_in_file_sub6"', 200, -1, FALSE, '"direction_in_file_sub6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_file_sub6->Sortable = TRUE; // Allow sort
		$this->fields['direction_in_file_sub6'] = &$this->direction_in_file_sub6;

		// transmit_date_in_sub6
		$this->transmit_date_in_sub6 = new DbField('document_log', 'document_log', 'x_transmit_date_in_sub6', 'transmit_date_in_sub6', '"transmit_date_in_sub6"', CastDateFieldForLike('"transmit_date_in_sub6"', 0, "DB"), 133, 0, FALSE, '"transmit_date_in_sub6"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_in_sub6->Sortable = TRUE; // Allow sort
		$this->transmit_date_in_sub6->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_in_sub6'] = &$this->transmit_date_in_sub6;

		// submit_no_sub7
		$this->submit_no_sub7 = new DbField('document_log', 'document_log', 'x_submit_no_sub7', 'submit_no_sub7', '"submit_no_sub7"', '"submit_no_sub7"', 200, -1, FALSE, '"submit_no_sub7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_sub7->Sortable = TRUE; // Allow sort
		$this->fields['submit_no_sub7'] = &$this->submit_no_sub7;

		// revision_no_sub7
		$this->revision_no_sub7 = new DbField('document_log', 'document_log', 'x_revision_no_sub7', 'revision_no_sub7', '"revision_no_sub7"', '"revision_no_sub7"', 200, -1, FALSE, '"revision_no_sub7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_sub7->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_sub7'] = &$this->revision_no_sub7;

		// direction_out_sub7
		$this->direction_out_sub7 = new DbField('document_log', 'document_log', 'x_direction_out_sub7', 'direction_out_sub7', '"direction_out_sub7"', '"direction_out_sub7"', 200, -1, FALSE, '"direction_out_sub7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_sub7->Sortable = TRUE; // Allow sort
		$this->fields['direction_out_sub7'] = &$this->direction_out_sub7;

		// planned_date_out_sub7
		$this->planned_date_out_sub7 = new DbField('document_log', 'document_log', 'x_planned_date_out_sub7', 'planned_date_out_sub7', '"planned_date_out_sub7"', CastDateFieldForLike('"planned_date_out_sub7"', 0, "DB"), 133, 0, FALSE, '"planned_date_out_sub7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_out_sub7->Sortable = TRUE; // Allow sort
		$this->planned_date_out_sub7->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_out_sub7'] = &$this->planned_date_out_sub7;

		// transmit_date_out_sub7
		$this->transmit_date_out_sub7 = new DbField('document_log', 'document_log', 'x_transmit_date_out_sub7', 'transmit_date_out_sub7', '"transmit_date_out_sub7"', CastDateFieldForLike('"transmit_date_out_sub7"', 0, "DB"), 133, 0, FALSE, '"transmit_date_out_sub7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_out_sub7->Sortable = TRUE; // Allow sort
		$this->transmit_date_out_sub7->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_out_sub7'] = &$this->transmit_date_out_sub7;

		// transmit_no_out_sub7
		$this->transmit_no_out_sub7 = new DbField('document_log', 'document_log', 'x_transmit_no_out_sub7', 'transmit_no_out_sub7', '"transmit_no_out_sub7"', '"transmit_no_out_sub7"', 200, -1, FALSE, '"transmit_no_out_sub7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_out_sub7->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_out_sub7'] = &$this->transmit_no_out_sub7;

		// approval_status_out_sub7
		$this->approval_status_out_sub7 = new DbField('document_log', 'document_log', 'x_approval_status_out_sub7', 'approval_status_out_sub7', '"approval_status_out_sub7"', '"approval_status_out_sub7"', 200, -1, FALSE, '"approval_status_out_sub7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_out_sub7->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_out_sub7'] = &$this->approval_status_out_sub7;

		// direction_out_file_sub7
		$this->direction_out_file_sub7 = new DbField('document_log', 'document_log', 'x_direction_out_file_sub7', 'direction_out_file_sub7', '"direction_out_file_sub7"', '"direction_out_file_sub7"', 200, -1, FALSE, '"direction_out_file_sub7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_file_sub7->Sortable = FALSE; // Allow sort
		$this->fields['direction_out_file_sub7'] = &$this->direction_out_file_sub7;

		// direction_in_sub7
		$this->direction_in_sub7 = new DbField('document_log', 'document_log', 'x_direction_in_sub7', 'direction_in_sub7', '"direction_in_sub7"', '"direction_in_sub7"', 200, -1, FALSE, '"direction_in_sub7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_sub7->Sortable = TRUE; // Allow sort
		$this->fields['direction_in_sub7'] = &$this->direction_in_sub7;

		// transmit_no_in_sub7
		$this->transmit_no_in_sub7 = new DbField('document_log', 'document_log', 'x_transmit_no_in_sub7', 'transmit_no_in_sub7', '"transmit_no_in_sub7"', '"transmit_no_in_sub7"', 200, -1, FALSE, '"transmit_no_in_sub7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_in_sub7->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_in_sub7'] = &$this->transmit_no_in_sub7;

		// approval_status_in_sub7
		$this->approval_status_in_sub7 = new DbField('document_log', 'document_log', 'x_approval_status_in_sub7', 'approval_status_in_sub7', '"approval_status_in_sub7"', '"approval_status_in_sub7"', 200, -1, FALSE, '"approval_status_in_sub7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_in_sub7->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_in_sub7'] = &$this->approval_status_in_sub7;

		// direction_in_file_sub7
		$this->direction_in_file_sub7 = new DbField('document_log', 'document_log', 'x_direction_in_file_sub7', 'direction_in_file_sub7', '"direction_in_file_sub7"', '"direction_in_file_sub7"', 200, -1, FALSE, '"direction_in_file_sub7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_file_sub7->Sortable = FALSE; // Allow sort
		$this->fields['direction_in_file_sub7'] = &$this->direction_in_file_sub7;

		// transmit_date_in_sub7
		$this->transmit_date_in_sub7 = new DbField('document_log', 'document_log', 'x_transmit_date_in_sub7', 'transmit_date_in_sub7', '"transmit_date_in_sub7"', CastDateFieldForLike('"transmit_date_in_sub7"', 0, "DB"), 133, 0, FALSE, '"transmit_date_in_sub7"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_in_sub7->Sortable = TRUE; // Allow sort
		$this->transmit_date_in_sub7->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_in_sub7'] = &$this->transmit_date_in_sub7;

		// submit_no_sub8
		$this->submit_no_sub8 = new DbField('document_log', 'document_log', 'x_submit_no_sub8', 'submit_no_sub8', '"submit_no_sub8"', '"submit_no_sub8"', 200, -1, FALSE, '"submit_no_sub8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_sub8->Sortable = TRUE; // Allow sort
		$this->fields['submit_no_sub8'] = &$this->submit_no_sub8;

		// revision_no_sub8
		$this->revision_no_sub8 = new DbField('document_log', 'document_log', 'x_revision_no_sub8', 'revision_no_sub8', '"revision_no_sub8"', '"revision_no_sub8"', 200, -1, FALSE, '"revision_no_sub8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_sub8->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_sub8'] = &$this->revision_no_sub8;

		// direction_out_sub8
		$this->direction_out_sub8 = new DbField('document_log', 'document_log', 'x_direction_out_sub8', 'direction_out_sub8', '"direction_out_sub8"', '"direction_out_sub8"', 200, -1, FALSE, '"direction_out_sub8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_sub8->Sortable = TRUE; // Allow sort
		$this->fields['direction_out_sub8'] = &$this->direction_out_sub8;

		// planned_date_out_sub8
		$this->planned_date_out_sub8 = new DbField('document_log', 'document_log', 'x_planned_date_out_sub8', 'planned_date_out_sub8', '"planned_date_out_sub8"', CastDateFieldForLike('"planned_date_out_sub8"', 0, "DB"), 133, 0, FALSE, '"planned_date_out_sub8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_out_sub8->Sortable = TRUE; // Allow sort
		$this->planned_date_out_sub8->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_out_sub8'] = &$this->planned_date_out_sub8;

		// transmit_date_out_sub8
		$this->transmit_date_out_sub8 = new DbField('document_log', 'document_log', 'x_transmit_date_out_sub8', 'transmit_date_out_sub8', '"transmit_date_out_sub8"', CastDateFieldForLike('"transmit_date_out_sub8"', 0, "DB"), 133, 0, FALSE, '"transmit_date_out_sub8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_out_sub8->Sortable = TRUE; // Allow sort
		$this->transmit_date_out_sub8->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_out_sub8'] = &$this->transmit_date_out_sub8;

		// transmit_no_out_sub8
		$this->transmit_no_out_sub8 = new DbField('document_log', 'document_log', 'x_transmit_no_out_sub8', 'transmit_no_out_sub8', '"transmit_no_out_sub8"', '"transmit_no_out_sub8"', 200, -1, FALSE, '"transmit_no_out_sub8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_out_sub8->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_out_sub8'] = &$this->transmit_no_out_sub8;

		// approval_status_out_sub8
		$this->approval_status_out_sub8 = new DbField('document_log', 'document_log', 'x_approval_status_out_sub8', 'approval_status_out_sub8', '"approval_status_out_sub8"', '"approval_status_out_sub8"', 200, -1, FALSE, '"approval_status_out_sub8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_out_sub8->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_out_sub8'] = &$this->approval_status_out_sub8;

		// direction_out_file_sub8
		$this->direction_out_file_sub8 = new DbField('document_log', 'document_log', 'x_direction_out_file_sub8', 'direction_out_file_sub8', '"direction_out_file_sub8"', '"direction_out_file_sub8"', 200, -1, FALSE, '"direction_out_file_sub8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_file_sub8->Sortable = TRUE; // Allow sort
		$this->fields['direction_out_file_sub8'] = &$this->direction_out_file_sub8;

		// direction_in_sub8
		$this->direction_in_sub8 = new DbField('document_log', 'document_log', 'x_direction_in_sub8', 'direction_in_sub8', '"direction_in_sub8"', '"direction_in_sub8"', 200, -1, FALSE, '"direction_in_sub8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_sub8->Sortable = TRUE; // Allow sort
		$this->fields['direction_in_sub8'] = &$this->direction_in_sub8;

		// transmit_no_in_sub8
		$this->transmit_no_in_sub8 = new DbField('document_log', 'document_log', 'x_transmit_no_in_sub8', 'transmit_no_in_sub8', '"transmit_no_in_sub8"', '"transmit_no_in_sub8"', 200, -1, FALSE, '"transmit_no_in_sub8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_in_sub8->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_in_sub8'] = &$this->transmit_no_in_sub8;

		// approval_status_in_sub8
		$this->approval_status_in_sub8 = new DbField('document_log', 'document_log', 'x_approval_status_in_sub8', 'approval_status_in_sub8', '"approval_status_in_sub8"', '"approval_status_in_sub8"', 200, -1, FALSE, '"approval_status_in_sub8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_in_sub8->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_in_sub8'] = &$this->approval_status_in_sub8;

		// direction_in_file_sub8
		$this->direction_in_file_sub8 = new DbField('document_log', 'document_log', 'x_direction_in_file_sub8', 'direction_in_file_sub8', '"direction_in_file_sub8"', '"direction_in_file_sub8"', 200, -1, FALSE, '"direction_in_file_sub8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_file_sub8->Sortable = FALSE; // Allow sort
		$this->fields['direction_in_file_sub8'] = &$this->direction_in_file_sub8;

		// transmit_date_in_sub8
		$this->transmit_date_in_sub8 = new DbField('document_log', 'document_log', 'x_transmit_date_in_sub8', 'transmit_date_in_sub8', '"transmit_date_in_sub8"', CastDateFieldForLike('"transmit_date_in_sub8"', 0, "DB"), 133, 0, FALSE, '"transmit_date_in_sub8"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_in_sub8->Sortable = TRUE; // Allow sort
		$this->transmit_date_in_sub8->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_in_sub8'] = &$this->transmit_date_in_sub8;

		// submit_no_sub9
		$this->submit_no_sub9 = new DbField('document_log', 'document_log', 'x_submit_no_sub9', 'submit_no_sub9', '"submit_no_sub9"', '"submit_no_sub9"', 200, -1, FALSE, '"submit_no_sub9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_sub9->Sortable = TRUE; // Allow sort
		$this->fields['submit_no_sub9'] = &$this->submit_no_sub9;

		// revision_no_sub9
		$this->revision_no_sub9 = new DbField('document_log', 'document_log', 'x_revision_no_sub9', 'revision_no_sub9', '"revision_no_sub9"', '"revision_no_sub9"', 200, -1, FALSE, '"revision_no_sub9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_sub9->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_sub9'] = &$this->revision_no_sub9;

		// direction_out_sub9
		$this->direction_out_sub9 = new DbField('document_log', 'document_log', 'x_direction_out_sub9', 'direction_out_sub9', '"direction_out_sub9"', '"direction_out_sub9"', 200, -1, FALSE, '"direction_out_sub9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_sub9->Sortable = TRUE; // Allow sort
		$this->fields['direction_out_sub9'] = &$this->direction_out_sub9;

		// planned_date_out_sub9
		$this->planned_date_out_sub9 = new DbField('document_log', 'document_log', 'x_planned_date_out_sub9', 'planned_date_out_sub9', '"planned_date_out_sub9"', CastDateFieldForLike('"planned_date_out_sub9"', 0, "DB"), 133, 0, FALSE, '"planned_date_out_sub9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_out_sub9->Sortable = TRUE; // Allow sort
		$this->planned_date_out_sub9->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_out_sub9'] = &$this->planned_date_out_sub9;

		// transmit_date_out_sub9
		$this->transmit_date_out_sub9 = new DbField('document_log', 'document_log', 'x_transmit_date_out_sub9', 'transmit_date_out_sub9', '"transmit_date_out_sub9"', CastDateFieldForLike('"transmit_date_out_sub9"', 0, "DB"), 133, 0, FALSE, '"transmit_date_out_sub9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_out_sub9->Sortable = TRUE; // Allow sort
		$this->transmit_date_out_sub9->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_out_sub9'] = &$this->transmit_date_out_sub9;

		// transmit_no_out_sub9
		$this->transmit_no_out_sub9 = new DbField('document_log', 'document_log', 'x_transmit_no_out_sub9', 'transmit_no_out_sub9', '"transmit_no_out_sub9"', '"transmit_no_out_sub9"', 200, -1, FALSE, '"transmit_no_out_sub9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_out_sub9->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_out_sub9'] = &$this->transmit_no_out_sub9;

		// approval_status_out_sub9
		$this->approval_status_out_sub9 = new DbField('document_log', 'document_log', 'x_approval_status_out_sub9', 'approval_status_out_sub9', '"approval_status_out_sub9"', '"approval_status_out_sub9"', 200, -1, FALSE, '"approval_status_out_sub9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_out_sub9->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_out_sub9'] = &$this->approval_status_out_sub9;

		// direction_out_file_sub9
		$this->direction_out_file_sub9 = new DbField('document_log', 'document_log', 'x_direction_out_file_sub9', 'direction_out_file_sub9', '"direction_out_file_sub9"', '"direction_out_file_sub9"', 200, -1, FALSE, '"direction_out_file_sub9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_file_sub9->Sortable = FALSE; // Allow sort
		$this->fields['direction_out_file_sub9'] = &$this->direction_out_file_sub9;

		// direction_in_sub9
		$this->direction_in_sub9 = new DbField('document_log', 'document_log', 'x_direction_in_sub9', 'direction_in_sub9', '"direction_in_sub9"', '"direction_in_sub9"', 200, -1, FALSE, '"direction_in_sub9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_sub9->Sortable = TRUE; // Allow sort
		$this->fields['direction_in_sub9'] = &$this->direction_in_sub9;

		// transmit_no_in_sub9
		$this->transmit_no_in_sub9 = new DbField('document_log', 'document_log', 'x_transmit_no_in_sub9', 'transmit_no_in_sub9', '"transmit_no_in_sub9"', '"transmit_no_in_sub9"', 200, -1, FALSE, '"transmit_no_in_sub9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_in_sub9->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_in_sub9'] = &$this->transmit_no_in_sub9;

		// approval_status_in_sub9
		$this->approval_status_in_sub9 = new DbField('document_log', 'document_log', 'x_approval_status_in_sub9', 'approval_status_in_sub9', '"approval_status_in_sub9"', '"approval_status_in_sub9"', 200, -1, FALSE, '"approval_status_in_sub9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_in_sub9->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_in_sub9'] = &$this->approval_status_in_sub9;

		// direction_in_file_sub9
		$this->direction_in_file_sub9 = new DbField('document_log', 'document_log', 'x_direction_in_file_sub9', 'direction_in_file_sub9', '"direction_in_file_sub9"', '"direction_in_file_sub9"', 200, -1, FALSE, '"direction_in_file_sub9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_file_sub9->Sortable = FALSE; // Allow sort
		$this->fields['direction_in_file_sub9'] = &$this->direction_in_file_sub9;

		// transmit_date_in_sub9
		$this->transmit_date_in_sub9 = new DbField('document_log', 'document_log', 'x_transmit_date_in_sub9', 'transmit_date_in_sub9', '"transmit_date_in_sub9"', CastDateFieldForLike('"transmit_date_in_sub9"', 0, "DB"), 133, 0, FALSE, '"transmit_date_in_sub9"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_in_sub9->Sortable = TRUE; // Allow sort
		$this->transmit_date_in_sub9->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_in_sub9'] = &$this->transmit_date_in_sub9;

		// submit_no_sub10
		$this->submit_no_sub10 = new DbField('document_log', 'document_log', 'x_submit_no_sub10', 'submit_no_sub10', '"submit_no_sub10"', '"submit_no_sub10"', 200, -1, FALSE, '"submit_no_sub10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no_sub10->Sortable = TRUE; // Allow sort
		$this->fields['submit_no_sub10'] = &$this->submit_no_sub10;

		// revision_no_sub10
		$this->revision_no_sub10 = new DbField('document_log', 'document_log', 'x_revision_no_sub10', 'revision_no_sub10', '"revision_no_sub10"', '"revision_no_sub10"', 200, -1, FALSE, '"revision_no_sub10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no_sub10->Sortable = TRUE; // Allow sort
		$this->fields['revision_no_sub10'] = &$this->revision_no_sub10;

		// direction_out_sub10
		$this->direction_out_sub10 = new DbField('document_log', 'document_log', 'x_direction_out_sub10', 'direction_out_sub10', '"direction_out_sub10"', '"direction_out_sub10"', 200, -1, FALSE, '"direction_out_sub10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_sub10->Sortable = TRUE; // Allow sort
		$this->fields['direction_out_sub10'] = &$this->direction_out_sub10;

		// planned_date_out_sub10
		$this->planned_date_out_sub10 = new DbField('document_log', 'document_log', 'x_planned_date_out_sub10', 'planned_date_out_sub10', '"planned_date_out_sub10"', CastDateFieldForLike('"planned_date_out_sub10"', 0, "DB"), 133, 0, FALSE, '"planned_date_out_sub10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date_out_sub10->Sortable = TRUE; // Allow sort
		$this->planned_date_out_sub10->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date_out_sub10'] = &$this->planned_date_out_sub10;

		// transmit_date_out_sub10
		$this->transmit_date_out_sub10 = new DbField('document_log', 'document_log', 'x_transmit_date_out_sub10', 'transmit_date_out_sub10', '"transmit_date_out_sub10"', CastDateFieldForLike('"transmit_date_out_sub10"', 0, "DB"), 133, 0, FALSE, '"transmit_date_out_sub10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_out_sub10->Sortable = TRUE; // Allow sort
		$this->transmit_date_out_sub10->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_out_sub10'] = &$this->transmit_date_out_sub10;

		// transmit_no_out_sub10
		$this->transmit_no_out_sub10 = new DbField('document_log', 'document_log', 'x_transmit_no_out_sub10', 'transmit_no_out_sub10', '"transmit_no_out_sub10"', '"transmit_no_out_sub10"', 200, -1, FALSE, '"transmit_no_out_sub10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_out_sub10->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_out_sub10'] = &$this->transmit_no_out_sub10;

		// approval_status_out_sub10
		$this->approval_status_out_sub10 = new DbField('document_log', 'document_log', 'x_approval_status_out_sub10', 'approval_status_out_sub10', '"approval_status_out_sub10"', '"approval_status_out_sub10"', 200, -1, FALSE, '"approval_status_out_sub10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_out_sub10->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_out_sub10'] = &$this->approval_status_out_sub10;

		// direction_out_file_sub10
		$this->direction_out_file_sub10 = new DbField('document_log', 'document_log', 'x_direction_out_file_sub10', 'direction_out_file_sub10', '"direction_out_file_sub10"', '"direction_out_file_sub10"', 200, -1, FALSE, '"direction_out_file_sub10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_out_file_sub10->Sortable = FALSE; // Allow sort
		$this->fields['direction_out_file_sub10'] = &$this->direction_out_file_sub10;

		// direction_in_sub10
		$this->direction_in_sub10 = new DbField('document_log', 'document_log', 'x_direction_in_sub10', 'direction_in_sub10', '"direction_in_sub10"', '"direction_in_sub10"', 200, -1, FALSE, '"direction_in_sub10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_sub10->Sortable = TRUE; // Allow sort
		$this->fields['direction_in_sub10'] = &$this->direction_in_sub10;

		// transmit_no_in_sub10
		$this->transmit_no_in_sub10 = new DbField('document_log', 'document_log', 'x_transmit_no_in_sub10', 'transmit_no_in_sub10', '"transmit_no_in_sub10"', '"transmit_no_in_sub10"', 200, -1, FALSE, '"transmit_no_in_sub10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no_in_sub10->Sortable = TRUE; // Allow sort
		$this->fields['transmit_no_in_sub10'] = &$this->transmit_no_in_sub10;

		// approval_status_in_sub10
		$this->approval_status_in_sub10 = new DbField('document_log', 'document_log', 'x_approval_status_in_sub10', 'approval_status_in_sub10', '"approval_status_in_sub10"', '"approval_status_in_sub10"', 200, -1, FALSE, '"approval_status_in_sub10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->approval_status_in_sub10->Sortable = TRUE; // Allow sort
		$this->fields['approval_status_in_sub10'] = &$this->approval_status_in_sub10;

		// direction_in_file_sub10
		$this->direction_in_file_sub10 = new DbField('document_log', 'document_log', 'x_direction_in_file_sub10', 'direction_in_file_sub10', '"direction_in_file_sub10"', '"direction_in_file_sub10"', 200, -1, FALSE, '"direction_in_file_sub10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direction_in_file_sub10->Sortable = FALSE; // Allow sort
		$this->fields['direction_in_file_sub10'] = &$this->direction_in_file_sub10;

		// transmit_date_in_sub10
		$this->transmit_date_in_sub10 = new DbField('document_log', 'document_log', 'x_transmit_date_in_sub10', 'transmit_date_in_sub10', '"transmit_date_in_sub10"', CastDateFieldForLike('"transmit_date_in_sub10"', 0, "DB"), 133, 0, FALSE, '"transmit_date_in_sub10"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date_in_sub10->Sortable = TRUE; // Allow sort
		$this->transmit_date_in_sub10->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date_in_sub10'] = &$this->transmit_date_in_sub10;

		// log_updatedon
		$this->log_updatedon = new DbField('document_log', 'document_log', 'x_log_updatedon', 'log_updatedon', '"log_updatedon"', CastDateFieldForLike('"log_updatedon"', 0, "DB"), 135, 0, FALSE, '"log_updatedon"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->project_name->DbValue = $row['project_name'];
		$this->document_tittle->DbValue = $row['document_tittle'];
		$this->current_status->DbValue = $row['current_status'];
		$this->current_status_file->DbValue = $row['current_status_file'];
		$this->submit_no_sub1->DbValue = $row['submit_no_sub1'];
		$this->revision_no_sub1->DbValue = $row['revision_no_sub1'];
		$this->direction_out_sub1->DbValue = $row['direction_out_sub1'];
		$this->planned_date_out_sub1->DbValue = $row['planned_date_out_sub1'];
		$this->transmit_date_out_sub1->DbValue = $row['transmit_date_out_sub1'];
		$this->transmit_no_out_sub1->DbValue = $row['transmit_no_out_sub1'];
		$this->approval_status_out_sub1->DbValue = $row['approval_status_out_sub1'];
		$this->direction_out_file_sub1->DbValue = $row['direction_out_file_sub1'];
		$this->direction_in_sub1->DbValue = $row['direction_in_sub1'];
		$this->transmit_no_in_sub1->DbValue = $row['transmit_no_in_sub1'];
		$this->approval_status_in_sub1->DbValue = $row['approval_status_in_sub1'];
		$this->direction_in_file_sub1->DbValue = $row['direction_in_file_sub1'];
		$this->transmit_date_in_sub1->DbValue = $row['transmit_date_in_sub1'];
		$this->submit_no_sub2->DbValue = $row['submit_no_sub2'];
		$this->revision_no_sub2->DbValue = $row['revision_no_sub2'];
		$this->direction_out_sub2->DbValue = $row['direction_out_sub2'];
		$this->planned_date_out_sub2->DbValue = $row['planned_date_out_sub2'];
		$this->transmit_date_out_sub2->DbValue = $row['transmit_date_out_sub2'];
		$this->transmit_no_out_sub2->DbValue = $row['transmit_no_out_sub2'];
		$this->approval_status_out_sub2->DbValue = $row['approval_status_out_sub2'];
		$this->direction_out_file_sub2->DbValue = $row['direction_out_file_sub2'];
		$this->direction_in_sub2->DbValue = $row['direction_in_sub2'];
		$this->transmit_no_in_sub2->DbValue = $row['transmit_no_in_sub2'];
		$this->approval_status_in_sub2->DbValue = $row['approval_status_in_sub2'];
		$this->direction_in_file_sub2->DbValue = $row['direction_in_file_sub2'];
		$this->transmit_date_in_sub2->DbValue = $row['transmit_date_in_sub2'];
		$this->submit_no_sub3->DbValue = $row['submit_no_sub3'];
		$this->revision_no_sub3->DbValue = $row['revision_no_sub3'];
		$this->direction_out_sub3->DbValue = $row['direction_out_sub3'];
		$this->planned_date_out_sub3->DbValue = $row['planned_date_out_sub3'];
		$this->transmit_date_out_sub3->DbValue = $row['transmit_date_out_sub3'];
		$this->transmit_no_out_sub3->DbValue = $row['transmit_no_out_sub3'];
		$this->approval_status_out_sub3->DbValue = $row['approval_status_out_sub3'];
		$this->direction_out_file_sub3->DbValue = $row['direction_out_file_sub3'];
		$this->direction_in_sub3->DbValue = $row['direction_in_sub3'];
		$this->transmit_no_in_sub3->DbValue = $row['transmit_no_in_sub3'];
		$this->approval_status_in_sub3->DbValue = $row['approval_status_in_sub3'];
		$this->direction_in_file_sub3->DbValue = $row['direction_in_file_sub3'];
		$this->transmit_date_in_sub3->DbValue = $row['transmit_date_in_sub3'];
		$this->submit_no_sub4->DbValue = $row['submit_no_sub4'];
		$this->revision_no_sub4->DbValue = $row['revision_no_sub4'];
		$this->direction_out_sub4->DbValue = $row['direction_out_sub4'];
		$this->planned_date_out_sub4->DbValue = $row['planned_date_out_sub4'];
		$this->transmit_date_out_sub4->DbValue = $row['transmit_date_out_sub4'];
		$this->transmit_no_out_sub4->DbValue = $row['transmit_no_out_sub4'];
		$this->approval_status_out_sub4->DbValue = $row['approval_status_out_sub4'];
		$this->direction_out_file_sub4->DbValue = $row['direction_out_file_sub4'];
		$this->direction_in_sub4->DbValue = $row['direction_in_sub4'];
		$this->transmit_no_in_sub4->DbValue = $row['transmit_no_in_sub4'];
		$this->approval_status_in_sub4->DbValue = $row['approval_status_in_sub4'];
		$this->direction_in_file_sub4->DbValue = $row['direction_in_file_sub4'];
		$this->transmit_date_in_sub4->DbValue = $row['transmit_date_in_sub4'];
		$this->submit_no_sub5->DbValue = $row['submit_no_sub5'];
		$this->revision_no_sub5->DbValue = $row['revision_no_sub5'];
		$this->direction_out_sub5->DbValue = $row['direction_out_sub5'];
		$this->planned_date_out_sub5->DbValue = $row['planned_date_out_sub5'];
		$this->transmit_date_out_sub5->DbValue = $row['transmit_date_out_sub5'];
		$this->transmit_no_out_sub5->DbValue = $row['transmit_no_out_sub5'];
		$this->approval_status_out_sub5->DbValue = $row['approval_status_out_sub5'];
		$this->direction_out_file_sub5->DbValue = $row['direction_out_file_sub5'];
		$this->direction_in_sub5->DbValue = $row['direction_in_sub5'];
		$this->transmit_no_in_sub5->DbValue = $row['transmit_no_in_sub5'];
		$this->approval_status_in_sub5->DbValue = $row['approval_status_in_sub5'];
		$this->direction_in_file_sub5->DbValue = $row['direction_in_file_sub5'];
		$this->transmit_date_in_sub5->DbValue = $row['transmit_date_in_sub5'];
		$this->submit_no_sub6->DbValue = $row['submit_no_sub6'];
		$this->revision_no_sub6->DbValue = $row['revision_no_sub6'];
		$this->direction_out_sub6->DbValue = $row['direction_out_sub6'];
		$this->planned_date_out_sub6->DbValue = $row['planned_date_out_sub6'];
		$this->transmit_date_out_sub6->DbValue = $row['transmit_date_out_sub6'];
		$this->transmit_no_out_sub6->DbValue = $row['transmit_no_out_sub6'];
		$this->approval_status_out_sub6->DbValue = $row['approval_status_out_sub6'];
		$this->direction_out_file_sub6->DbValue = $row['direction_out_file_sub6'];
		$this->direction_in_sub6->DbValue = $row['direction_in_sub6'];
		$this->transmit_no_in_sub6->DbValue = $row['transmit_no_in_sub6'];
		$this->approval_status_in_sub6->DbValue = $row['approval_status_in_sub6'];
		$this->direction_in_file_sub6->DbValue = $row['direction_in_file_sub6'];
		$this->transmit_date_in_sub6->DbValue = $row['transmit_date_in_sub6'];
		$this->submit_no_sub7->DbValue = $row['submit_no_sub7'];
		$this->revision_no_sub7->DbValue = $row['revision_no_sub7'];
		$this->direction_out_sub7->DbValue = $row['direction_out_sub7'];
		$this->planned_date_out_sub7->DbValue = $row['planned_date_out_sub7'];
		$this->transmit_date_out_sub7->DbValue = $row['transmit_date_out_sub7'];
		$this->transmit_no_out_sub7->DbValue = $row['transmit_no_out_sub7'];
		$this->approval_status_out_sub7->DbValue = $row['approval_status_out_sub7'];
		$this->direction_out_file_sub7->DbValue = $row['direction_out_file_sub7'];
		$this->direction_in_sub7->DbValue = $row['direction_in_sub7'];
		$this->transmit_no_in_sub7->DbValue = $row['transmit_no_in_sub7'];
		$this->approval_status_in_sub7->DbValue = $row['approval_status_in_sub7'];
		$this->direction_in_file_sub7->DbValue = $row['direction_in_file_sub7'];
		$this->transmit_date_in_sub7->DbValue = $row['transmit_date_in_sub7'];
		$this->submit_no_sub8->DbValue = $row['submit_no_sub8'];
		$this->revision_no_sub8->DbValue = $row['revision_no_sub8'];
		$this->direction_out_sub8->DbValue = $row['direction_out_sub8'];
		$this->planned_date_out_sub8->DbValue = $row['planned_date_out_sub8'];
		$this->transmit_date_out_sub8->DbValue = $row['transmit_date_out_sub8'];
		$this->transmit_no_out_sub8->DbValue = $row['transmit_no_out_sub8'];
		$this->approval_status_out_sub8->DbValue = $row['approval_status_out_sub8'];
		$this->direction_out_file_sub8->DbValue = $row['direction_out_file_sub8'];
		$this->direction_in_sub8->DbValue = $row['direction_in_sub8'];
		$this->transmit_no_in_sub8->DbValue = $row['transmit_no_in_sub8'];
		$this->approval_status_in_sub8->DbValue = $row['approval_status_in_sub8'];
		$this->direction_in_file_sub8->DbValue = $row['direction_in_file_sub8'];
		$this->transmit_date_in_sub8->DbValue = $row['transmit_date_in_sub8'];
		$this->submit_no_sub9->DbValue = $row['submit_no_sub9'];
		$this->revision_no_sub9->DbValue = $row['revision_no_sub9'];
		$this->direction_out_sub9->DbValue = $row['direction_out_sub9'];
		$this->planned_date_out_sub9->DbValue = $row['planned_date_out_sub9'];
		$this->transmit_date_out_sub9->DbValue = $row['transmit_date_out_sub9'];
		$this->transmit_no_out_sub9->DbValue = $row['transmit_no_out_sub9'];
		$this->approval_status_out_sub9->DbValue = $row['approval_status_out_sub9'];
		$this->direction_out_file_sub9->DbValue = $row['direction_out_file_sub9'];
		$this->direction_in_sub9->DbValue = $row['direction_in_sub9'];
		$this->transmit_no_in_sub9->DbValue = $row['transmit_no_in_sub9'];
		$this->approval_status_in_sub9->DbValue = $row['approval_status_in_sub9'];
		$this->direction_in_file_sub9->DbValue = $row['direction_in_file_sub9'];
		$this->transmit_date_in_sub9->DbValue = $row['transmit_date_in_sub9'];
		$this->submit_no_sub10->DbValue = $row['submit_no_sub10'];
		$this->revision_no_sub10->DbValue = $row['revision_no_sub10'];
		$this->direction_out_sub10->DbValue = $row['direction_out_sub10'];
		$this->planned_date_out_sub10->DbValue = $row['planned_date_out_sub10'];
		$this->transmit_date_out_sub10->DbValue = $row['transmit_date_out_sub10'];
		$this->transmit_no_out_sub10->DbValue = $row['transmit_no_out_sub10'];
		$this->approval_status_out_sub10->DbValue = $row['approval_status_out_sub10'];
		$this->direction_out_file_sub10->DbValue = $row['direction_out_file_sub10'];
		$this->direction_in_sub10->DbValue = $row['direction_in_sub10'];
		$this->transmit_no_in_sub10->DbValue = $row['transmit_no_in_sub10'];
		$this->approval_status_in_sub10->DbValue = $row['approval_status_in_sub10'];
		$this->direction_in_file_sub10->DbValue = $row['direction_in_file_sub10'];
		$this->transmit_date_in_sub10->DbValue = $row['transmit_date_in_sub10'];
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
		$this->project_name->setDbValue($rs->fields('project_name'));
		$this->document_tittle->setDbValue($rs->fields('document_tittle'));
		$this->current_status->setDbValue($rs->fields('current_status'));
		$this->current_status_file->setDbValue($rs->fields('current_status_file'));
		$this->submit_no_sub1->setDbValue($rs->fields('submit_no_sub1'));
		$this->revision_no_sub1->setDbValue($rs->fields('revision_no_sub1'));
		$this->direction_out_sub1->setDbValue($rs->fields('direction_out_sub1'));
		$this->planned_date_out_sub1->setDbValue($rs->fields('planned_date_out_sub1'));
		$this->transmit_date_out_sub1->setDbValue($rs->fields('transmit_date_out_sub1'));
		$this->transmit_no_out_sub1->setDbValue($rs->fields('transmit_no_out_sub1'));
		$this->approval_status_out_sub1->setDbValue($rs->fields('approval_status_out_sub1'));
		$this->direction_out_file_sub1->setDbValue($rs->fields('direction_out_file_sub1'));
		$this->direction_in_sub1->setDbValue($rs->fields('direction_in_sub1'));
		$this->transmit_no_in_sub1->setDbValue($rs->fields('transmit_no_in_sub1'));
		$this->approval_status_in_sub1->setDbValue($rs->fields('approval_status_in_sub1'));
		$this->direction_in_file_sub1->setDbValue($rs->fields('direction_in_file_sub1'));
		$this->transmit_date_in_sub1->setDbValue($rs->fields('transmit_date_in_sub1'));
		$this->submit_no_sub2->setDbValue($rs->fields('submit_no_sub2'));
		$this->revision_no_sub2->setDbValue($rs->fields('revision_no_sub2'));
		$this->direction_out_sub2->setDbValue($rs->fields('direction_out_sub2'));
		$this->planned_date_out_sub2->setDbValue($rs->fields('planned_date_out_sub2'));
		$this->transmit_date_out_sub2->setDbValue($rs->fields('transmit_date_out_sub2'));
		$this->transmit_no_out_sub2->setDbValue($rs->fields('transmit_no_out_sub2'));
		$this->approval_status_out_sub2->setDbValue($rs->fields('approval_status_out_sub2'));
		$this->direction_out_file_sub2->setDbValue($rs->fields('direction_out_file_sub2'));
		$this->direction_in_sub2->setDbValue($rs->fields('direction_in_sub2'));
		$this->transmit_no_in_sub2->setDbValue($rs->fields('transmit_no_in_sub2'));
		$this->approval_status_in_sub2->setDbValue($rs->fields('approval_status_in_sub2'));
		$this->direction_in_file_sub2->setDbValue($rs->fields('direction_in_file_sub2'));
		$this->transmit_date_in_sub2->setDbValue($rs->fields('transmit_date_in_sub2'));
		$this->submit_no_sub3->setDbValue($rs->fields('submit_no_sub3'));
		$this->revision_no_sub3->setDbValue($rs->fields('revision_no_sub3'));
		$this->direction_out_sub3->setDbValue($rs->fields('direction_out_sub3'));
		$this->planned_date_out_sub3->setDbValue($rs->fields('planned_date_out_sub3'));
		$this->transmit_date_out_sub3->setDbValue($rs->fields('transmit_date_out_sub3'));
		$this->transmit_no_out_sub3->setDbValue($rs->fields('transmit_no_out_sub3'));
		$this->approval_status_out_sub3->setDbValue($rs->fields('approval_status_out_sub3'));
		$this->direction_out_file_sub3->setDbValue($rs->fields('direction_out_file_sub3'));
		$this->direction_in_sub3->setDbValue($rs->fields('direction_in_sub3'));
		$this->transmit_no_in_sub3->setDbValue($rs->fields('transmit_no_in_sub3'));
		$this->approval_status_in_sub3->setDbValue($rs->fields('approval_status_in_sub3'));
		$this->direction_in_file_sub3->setDbValue($rs->fields('direction_in_file_sub3'));
		$this->transmit_date_in_sub3->setDbValue($rs->fields('transmit_date_in_sub3'));
		$this->submit_no_sub4->setDbValue($rs->fields('submit_no_sub4'));
		$this->revision_no_sub4->setDbValue($rs->fields('revision_no_sub4'));
		$this->direction_out_sub4->setDbValue($rs->fields('direction_out_sub4'));
		$this->planned_date_out_sub4->setDbValue($rs->fields('planned_date_out_sub4'));
		$this->transmit_date_out_sub4->setDbValue($rs->fields('transmit_date_out_sub4'));
		$this->transmit_no_out_sub4->setDbValue($rs->fields('transmit_no_out_sub4'));
		$this->approval_status_out_sub4->setDbValue($rs->fields('approval_status_out_sub4'));
		$this->direction_out_file_sub4->setDbValue($rs->fields('direction_out_file_sub4'));
		$this->direction_in_sub4->setDbValue($rs->fields('direction_in_sub4'));
		$this->transmit_no_in_sub4->setDbValue($rs->fields('transmit_no_in_sub4'));
		$this->approval_status_in_sub4->setDbValue($rs->fields('approval_status_in_sub4'));
		$this->direction_in_file_sub4->setDbValue($rs->fields('direction_in_file_sub4'));
		$this->transmit_date_in_sub4->setDbValue($rs->fields('transmit_date_in_sub4'));
		$this->submit_no_sub5->setDbValue($rs->fields('submit_no_sub5'));
		$this->revision_no_sub5->setDbValue($rs->fields('revision_no_sub5'));
		$this->direction_out_sub5->setDbValue($rs->fields('direction_out_sub5'));
		$this->planned_date_out_sub5->setDbValue($rs->fields('planned_date_out_sub5'));
		$this->transmit_date_out_sub5->setDbValue($rs->fields('transmit_date_out_sub5'));
		$this->transmit_no_out_sub5->setDbValue($rs->fields('transmit_no_out_sub5'));
		$this->approval_status_out_sub5->setDbValue($rs->fields('approval_status_out_sub5'));
		$this->direction_out_file_sub5->setDbValue($rs->fields('direction_out_file_sub5'));
		$this->direction_in_sub5->setDbValue($rs->fields('direction_in_sub5'));
		$this->transmit_no_in_sub5->setDbValue($rs->fields('transmit_no_in_sub5'));
		$this->approval_status_in_sub5->setDbValue($rs->fields('approval_status_in_sub5'));
		$this->direction_in_file_sub5->setDbValue($rs->fields('direction_in_file_sub5'));
		$this->transmit_date_in_sub5->setDbValue($rs->fields('transmit_date_in_sub5'));
		$this->submit_no_sub6->setDbValue($rs->fields('submit_no_sub6'));
		$this->revision_no_sub6->setDbValue($rs->fields('revision_no_sub6'));
		$this->direction_out_sub6->setDbValue($rs->fields('direction_out_sub6'));
		$this->planned_date_out_sub6->setDbValue($rs->fields('planned_date_out_sub6'));
		$this->transmit_date_out_sub6->setDbValue($rs->fields('transmit_date_out_sub6'));
		$this->transmit_no_out_sub6->setDbValue($rs->fields('transmit_no_out_sub6'));
		$this->approval_status_out_sub6->setDbValue($rs->fields('approval_status_out_sub6'));
		$this->direction_out_file_sub6->setDbValue($rs->fields('direction_out_file_sub6'));
		$this->direction_in_sub6->setDbValue($rs->fields('direction_in_sub6'));
		$this->transmit_no_in_sub6->setDbValue($rs->fields('transmit_no_in_sub6'));
		$this->approval_status_in_sub6->setDbValue($rs->fields('approval_status_in_sub6'));
		$this->direction_in_file_sub6->setDbValue($rs->fields('direction_in_file_sub6'));
		$this->transmit_date_in_sub6->setDbValue($rs->fields('transmit_date_in_sub6'));
		$this->submit_no_sub7->setDbValue($rs->fields('submit_no_sub7'));
		$this->revision_no_sub7->setDbValue($rs->fields('revision_no_sub7'));
		$this->direction_out_sub7->setDbValue($rs->fields('direction_out_sub7'));
		$this->planned_date_out_sub7->setDbValue($rs->fields('planned_date_out_sub7'));
		$this->transmit_date_out_sub7->setDbValue($rs->fields('transmit_date_out_sub7'));
		$this->transmit_no_out_sub7->setDbValue($rs->fields('transmit_no_out_sub7'));
		$this->approval_status_out_sub7->setDbValue($rs->fields('approval_status_out_sub7'));
		$this->direction_out_file_sub7->setDbValue($rs->fields('direction_out_file_sub7'));
		$this->direction_in_sub7->setDbValue($rs->fields('direction_in_sub7'));
		$this->transmit_no_in_sub7->setDbValue($rs->fields('transmit_no_in_sub7'));
		$this->approval_status_in_sub7->setDbValue($rs->fields('approval_status_in_sub7'));
		$this->direction_in_file_sub7->setDbValue($rs->fields('direction_in_file_sub7'));
		$this->transmit_date_in_sub7->setDbValue($rs->fields('transmit_date_in_sub7'));
		$this->submit_no_sub8->setDbValue($rs->fields('submit_no_sub8'));
		$this->revision_no_sub8->setDbValue($rs->fields('revision_no_sub8'));
		$this->direction_out_sub8->setDbValue($rs->fields('direction_out_sub8'));
		$this->planned_date_out_sub8->setDbValue($rs->fields('planned_date_out_sub8'));
		$this->transmit_date_out_sub8->setDbValue($rs->fields('transmit_date_out_sub8'));
		$this->transmit_no_out_sub8->setDbValue($rs->fields('transmit_no_out_sub8'));
		$this->approval_status_out_sub8->setDbValue($rs->fields('approval_status_out_sub8'));
		$this->direction_out_file_sub8->setDbValue($rs->fields('direction_out_file_sub8'));
		$this->direction_in_sub8->setDbValue($rs->fields('direction_in_sub8'));
		$this->transmit_no_in_sub8->setDbValue($rs->fields('transmit_no_in_sub8'));
		$this->approval_status_in_sub8->setDbValue($rs->fields('approval_status_in_sub8'));
		$this->direction_in_file_sub8->setDbValue($rs->fields('direction_in_file_sub8'));
		$this->transmit_date_in_sub8->setDbValue($rs->fields('transmit_date_in_sub8'));
		$this->submit_no_sub9->setDbValue($rs->fields('submit_no_sub9'));
		$this->revision_no_sub9->setDbValue($rs->fields('revision_no_sub9'));
		$this->direction_out_sub9->setDbValue($rs->fields('direction_out_sub9'));
		$this->planned_date_out_sub9->setDbValue($rs->fields('planned_date_out_sub9'));
		$this->transmit_date_out_sub9->setDbValue($rs->fields('transmit_date_out_sub9'));
		$this->transmit_no_out_sub9->setDbValue($rs->fields('transmit_no_out_sub9'));
		$this->approval_status_out_sub9->setDbValue($rs->fields('approval_status_out_sub9'));
		$this->direction_out_file_sub9->setDbValue($rs->fields('direction_out_file_sub9'));
		$this->direction_in_sub9->setDbValue($rs->fields('direction_in_sub9'));
		$this->transmit_no_in_sub9->setDbValue($rs->fields('transmit_no_in_sub9'));
		$this->approval_status_in_sub9->setDbValue($rs->fields('approval_status_in_sub9'));
		$this->direction_in_file_sub9->setDbValue($rs->fields('direction_in_file_sub9'));
		$this->transmit_date_in_sub9->setDbValue($rs->fields('transmit_date_in_sub9'));
		$this->submit_no_sub10->setDbValue($rs->fields('submit_no_sub10'));
		$this->revision_no_sub10->setDbValue($rs->fields('revision_no_sub10'));
		$this->direction_out_sub10->setDbValue($rs->fields('direction_out_sub10'));
		$this->planned_date_out_sub10->setDbValue($rs->fields('planned_date_out_sub10'));
		$this->transmit_date_out_sub10->setDbValue($rs->fields('transmit_date_out_sub10'));
		$this->transmit_no_out_sub10->setDbValue($rs->fields('transmit_no_out_sub10'));
		$this->approval_status_out_sub10->setDbValue($rs->fields('approval_status_out_sub10'));
		$this->direction_out_file_sub10->setDbValue($rs->fields('direction_out_file_sub10'));
		$this->direction_in_sub10->setDbValue($rs->fields('direction_in_sub10'));
		$this->transmit_no_in_sub10->setDbValue($rs->fields('transmit_no_in_sub10'));
		$this->approval_status_in_sub10->setDbValue($rs->fields('approval_status_in_sub10'));
		$this->direction_in_file_sub10->setDbValue($rs->fields('direction_in_file_sub10'));
		$this->transmit_date_in_sub10->setDbValue($rs->fields('transmit_date_in_sub10'));
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
		// firelink_doc_no
		// project_name
		// document_tittle
		// current_status
		// current_status_file

		$this->current_status_file->CellCssStyle = "white-space: nowrap;";

		// submit_no_sub1
		// revision_no_sub1
		// direction_out_sub1
		// planned_date_out_sub1
		// transmit_date_out_sub1
		// transmit_no_out_sub1
		// approval_status_out_sub1
		// direction_out_file_sub1
		// direction_in_sub1
		// transmit_no_in_sub1
		// approval_status_in_sub1
		// direction_in_file_sub1

		$this->direction_in_file_sub1->CellCssStyle = "white-space: nowrap;";

		// transmit_date_in_sub1
		// submit_no_sub2
		// revision_no_sub2
		// direction_out_sub2
		// planned_date_out_sub2
		// transmit_date_out_sub2
		// transmit_no_out_sub2
		// approval_status_out_sub2
		// direction_out_file_sub2

		$this->direction_out_file_sub2->CellCssStyle = "white-space: nowrap;";

		// direction_in_sub2
		// transmit_no_in_sub2
		// approval_status_in_sub2
		// direction_in_file_sub2

		$this->direction_in_file_sub2->CellCssStyle = "white-space: nowrap;";

		// transmit_date_in_sub2
		// submit_no_sub3
		// revision_no_sub3
		// direction_out_sub3
		// planned_date_out_sub3
		// transmit_date_out_sub3
		// transmit_no_out_sub3
		// approval_status_out_sub3
		// direction_out_file_sub3

		$this->direction_out_file_sub3->CellCssStyle = "white-space: nowrap;";

		// direction_in_sub3
		// transmit_no_in_sub3
		// approval_status_in_sub3
		// direction_in_file_sub3

		$this->direction_in_file_sub3->CellCssStyle = "white-space: nowrap;";

		// transmit_date_in_sub3
		// submit_no_sub4
		// revision_no_sub4
		// direction_out_sub4
		// planned_date_out_sub4
		// transmit_date_out_sub4
		// transmit_no_out_sub4
		// approval_status_out_sub4
		// direction_out_file_sub4

		$this->direction_out_file_sub4->CellCssStyle = "white-space: nowrap;";

		// direction_in_sub4
		// transmit_no_in_sub4
		// approval_status_in_sub4
		// direction_in_file_sub4
		// transmit_date_in_sub4
		// submit_no_sub5
		// revision_no_sub5
		// direction_out_sub5
		// planned_date_out_sub5
		// transmit_date_out_sub5
		// transmit_no_out_sub5
		// approval_status_out_sub5
		// direction_out_file_sub5

		$this->direction_out_file_sub5->CellCssStyle = "white-space: nowrap;";

		// direction_in_sub5
		// transmit_no_in_sub5
		// approval_status_in_sub5
		// direction_in_file_sub5
		// transmit_date_in_sub5
		// submit_no_sub6
		// revision_no_sub6
		// direction_out_sub6
		// planned_date_out_sub6
		// transmit_date_out_sub6
		// transmit_no_out_sub6
		// approval_status_out_sub6
		// direction_out_file_sub6

		$this->direction_out_file_sub6->CellCssStyle = "white-space: nowrap;";

		// direction_in_sub6
		// transmit_no_in_sub6
		// approval_status_in_sub6
		// direction_in_file_sub6
		// transmit_date_in_sub6
		// submit_no_sub7
		// revision_no_sub7
		// direction_out_sub7
		// planned_date_out_sub7
		// transmit_date_out_sub7
		// transmit_no_out_sub7
		// approval_status_out_sub7
		// direction_out_file_sub7

		$this->direction_out_file_sub7->CellCssStyle = "white-space: nowrap;";

		// direction_in_sub7
		// transmit_no_in_sub7
		// approval_status_in_sub7
		// direction_in_file_sub7

		$this->direction_in_file_sub7->CellCssStyle = "white-space: nowrap;";

		// transmit_date_in_sub7
		// submit_no_sub8
		// revision_no_sub8
		// direction_out_sub8
		// planned_date_out_sub8
		// transmit_date_out_sub8
		// transmit_no_out_sub8
		// approval_status_out_sub8
		// direction_out_file_sub8
		// direction_in_sub8
		// transmit_no_in_sub8
		// approval_status_in_sub8
		// direction_in_file_sub8

		$this->direction_in_file_sub8->CellCssStyle = "white-space: nowrap;";

		// transmit_date_in_sub8
		// submit_no_sub9
		// revision_no_sub9
		// direction_out_sub9
		// planned_date_out_sub9
		// transmit_date_out_sub9
		// transmit_no_out_sub9
		// approval_status_out_sub9
		// direction_out_file_sub9

		$this->direction_out_file_sub9->CellCssStyle = "white-space: nowrap;";

		// direction_in_sub9
		// transmit_no_in_sub9
		// approval_status_in_sub9
		// direction_in_file_sub9

		$this->direction_in_file_sub9->CellCssStyle = "white-space: nowrap;";

		// transmit_date_in_sub9
		// submit_no_sub10
		// revision_no_sub10
		// direction_out_sub10
		// planned_date_out_sub10
		// transmit_date_out_sub10
		// transmit_no_out_sub10
		// approval_status_out_sub10
		// direction_out_file_sub10

		$this->direction_out_file_sub10->CellCssStyle = "white-space: nowrap;";

		// direction_in_sub10
		// transmit_no_in_sub10
		// approval_status_in_sub10
		// direction_in_file_sub10

		$this->direction_in_file_sub10->CellCssStyle = "white-space: nowrap;";

		// transmit_date_in_sub10
		// log_updatedon
		// log_id

		$this->log_id->ViewValue = $this->log_id->CurrentValue;
		$this->log_id->ViewCustomAttributes = "";

		// firelink_doc_no
		$this->firelink_doc_no->ViewValue = $this->firelink_doc_no->CurrentValue;
		$this->firelink_doc_no->ViewCustomAttributes = "";

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

		// submit_no_sub1
		$this->submit_no_sub1->ViewValue = $this->submit_no_sub1->CurrentValue;
		$this->submit_no_sub1->ViewCustomAttributes = "";

		// revision_no_sub1
		$this->revision_no_sub1->ViewValue = $this->revision_no_sub1->CurrentValue;
		$this->revision_no_sub1->ViewCustomAttributes = "";

		// direction_out_sub1
		$this->direction_out_sub1->ViewValue = $this->direction_out_sub1->CurrentValue;
		$this->direction_out_sub1->ViewCustomAttributes = "";

		// planned_date_out_sub1
		$this->planned_date_out_sub1->ViewValue = $this->planned_date_out_sub1->CurrentValue;
		$this->planned_date_out_sub1->ViewValue = FormatDateTime($this->planned_date_out_sub1->ViewValue, 0);
		$this->planned_date_out_sub1->ViewCustomAttributes = "";

		// transmit_date_out_sub1
		$this->transmit_date_out_sub1->ViewValue = $this->transmit_date_out_sub1->CurrentValue;
		$this->transmit_date_out_sub1->ViewValue = FormatDateTime($this->transmit_date_out_sub1->ViewValue, 0);
		$this->transmit_date_out_sub1->ViewCustomAttributes = "";

		// transmit_no_out_sub1
		$this->transmit_no_out_sub1->ViewValue = $this->transmit_no_out_sub1->CurrentValue;
		$this->transmit_no_out_sub1->ViewCustomAttributes = "";

		// approval_status_out_sub1
		$this->approval_status_out_sub1->ViewValue = $this->approval_status_out_sub1->CurrentValue;
		$this->approval_status_out_sub1->ViewCustomAttributes = "";

		// direction_out_file_sub1
		$this->direction_out_file_sub1->ViewValue = $this->direction_out_file_sub1->CurrentValue;
		$this->direction_out_file_sub1->ViewCustomAttributes = "";

		// direction_in_sub1
		$this->direction_in_sub1->ViewValue = $this->direction_in_sub1->CurrentValue;
		$this->direction_in_sub1->ViewCustomAttributes = "";

		// transmit_no_in_sub1
		$this->transmit_no_in_sub1->ViewValue = $this->transmit_no_in_sub1->CurrentValue;
		$this->transmit_no_in_sub1->ViewCustomAttributes = "";

		// approval_status_in_sub1
		$this->approval_status_in_sub1->ViewValue = $this->approval_status_in_sub1->CurrentValue;
		$this->approval_status_in_sub1->ViewCustomAttributes = "";

		// direction_in_file_sub1
		$this->direction_in_file_sub1->ViewValue = $this->direction_in_file_sub1->CurrentValue;
		$this->direction_in_file_sub1->ViewCustomAttributes = "";

		// transmit_date_in_sub1
		$this->transmit_date_in_sub1->ViewValue = $this->transmit_date_in_sub1->CurrentValue;
		$this->transmit_date_in_sub1->ViewValue = FormatDateTime($this->transmit_date_in_sub1->ViewValue, 0);
		$this->transmit_date_in_sub1->ViewCustomAttributes = "";

		// submit_no_sub2
		$this->submit_no_sub2->ViewValue = $this->submit_no_sub2->CurrentValue;
		$this->submit_no_sub2->ViewCustomAttributes = "";

		// revision_no_sub2
		$this->revision_no_sub2->ViewValue = $this->revision_no_sub2->CurrentValue;
		$this->revision_no_sub2->ViewCustomAttributes = "";

		// direction_out_sub2
		$this->direction_out_sub2->ViewValue = $this->direction_out_sub2->CurrentValue;
		$this->direction_out_sub2->ViewCustomAttributes = "";

		// planned_date_out_sub2
		$this->planned_date_out_sub2->ViewValue = $this->planned_date_out_sub2->CurrentValue;
		$this->planned_date_out_sub2->ViewValue = FormatDateTime($this->planned_date_out_sub2->ViewValue, 0);
		$this->planned_date_out_sub2->ViewCustomAttributes = "";

		// transmit_date_out_sub2
		$this->transmit_date_out_sub2->ViewValue = $this->transmit_date_out_sub2->CurrentValue;
		$this->transmit_date_out_sub2->ViewValue = FormatDateTime($this->transmit_date_out_sub2->ViewValue, 0);
		$this->transmit_date_out_sub2->ViewCustomAttributes = "";

		// transmit_no_out_sub2
		$this->transmit_no_out_sub2->ViewValue = $this->transmit_no_out_sub2->CurrentValue;
		$this->transmit_no_out_sub2->ViewCustomAttributes = "";

		// approval_status_out_sub2
		$this->approval_status_out_sub2->ViewValue = $this->approval_status_out_sub2->CurrentValue;
		$this->approval_status_out_sub2->ViewCustomAttributes = "";

		// direction_out_file_sub2
		$this->direction_out_file_sub2->ViewValue = $this->direction_out_file_sub2->CurrentValue;
		$this->direction_out_file_sub2->ViewCustomAttributes = "";

		// direction_in_sub2
		$this->direction_in_sub2->ViewValue = $this->direction_in_sub2->CurrentValue;
		$this->direction_in_sub2->ViewCustomAttributes = "";

		// transmit_no_in_sub2
		$this->transmit_no_in_sub2->ViewValue = $this->transmit_no_in_sub2->CurrentValue;
		$this->transmit_no_in_sub2->ViewCustomAttributes = "";

		// approval_status_in_sub2
		$this->approval_status_in_sub2->ViewValue = $this->approval_status_in_sub2->CurrentValue;
		$this->approval_status_in_sub2->ViewCustomAttributes = "";

		// direction_in_file_sub2
		$this->direction_in_file_sub2->ViewValue = $this->direction_in_file_sub2->CurrentValue;
		$this->direction_in_file_sub2->ViewCustomAttributes = "";

		// transmit_date_in_sub2
		$this->transmit_date_in_sub2->ViewValue = $this->transmit_date_in_sub2->CurrentValue;
		$this->transmit_date_in_sub2->ViewValue = FormatDateTime($this->transmit_date_in_sub2->ViewValue, 0);
		$this->transmit_date_in_sub2->ViewCustomAttributes = "";

		// submit_no_sub3
		$this->submit_no_sub3->ViewValue = $this->submit_no_sub3->CurrentValue;
		$this->submit_no_sub3->ViewCustomAttributes = "";

		// revision_no_sub3
		$this->revision_no_sub3->ViewValue = $this->revision_no_sub3->CurrentValue;
		$this->revision_no_sub3->ViewCustomAttributes = "";

		// direction_out_sub3
		$this->direction_out_sub3->ViewValue = $this->direction_out_sub3->CurrentValue;
		$this->direction_out_sub3->ViewCustomAttributes = "";

		// planned_date_out_sub3
		$this->planned_date_out_sub3->ViewValue = $this->planned_date_out_sub3->CurrentValue;
		$this->planned_date_out_sub3->ViewValue = FormatDateTime($this->planned_date_out_sub3->ViewValue, 0);
		$this->planned_date_out_sub3->ViewCustomAttributes = "";

		// transmit_date_out_sub3
		$this->transmit_date_out_sub3->ViewValue = $this->transmit_date_out_sub3->CurrentValue;
		$this->transmit_date_out_sub3->ViewValue = FormatDateTime($this->transmit_date_out_sub3->ViewValue, 0);
		$this->transmit_date_out_sub3->ViewCustomAttributes = "";

		// transmit_no_out_sub3
		$this->transmit_no_out_sub3->ViewValue = $this->transmit_no_out_sub3->CurrentValue;
		$this->transmit_no_out_sub3->ViewCustomAttributes = "";

		// approval_status_out_sub3
		$this->approval_status_out_sub3->ViewValue = $this->approval_status_out_sub3->CurrentValue;
		$this->approval_status_out_sub3->ViewCustomAttributes = "";

		// direction_out_file_sub3
		$this->direction_out_file_sub3->ViewValue = $this->direction_out_file_sub3->CurrentValue;
		$this->direction_out_file_sub3->ViewCustomAttributes = "";

		// direction_in_sub3
		$this->direction_in_sub3->ViewValue = $this->direction_in_sub3->CurrentValue;
		$this->direction_in_sub3->ViewCustomAttributes = "";

		// transmit_no_in_sub3
		$this->transmit_no_in_sub3->ViewValue = $this->transmit_no_in_sub3->CurrentValue;
		$this->transmit_no_in_sub3->ViewCustomAttributes = "";

		// approval_status_in_sub3
		$this->approval_status_in_sub3->ViewValue = $this->approval_status_in_sub3->CurrentValue;
		$this->approval_status_in_sub3->ViewCustomAttributes = "";

		// direction_in_file_sub3
		$this->direction_in_file_sub3->ViewValue = $this->direction_in_file_sub3->CurrentValue;
		$this->direction_in_file_sub3->ViewCustomAttributes = "";

		// transmit_date_in_sub3
		$this->transmit_date_in_sub3->ViewValue = $this->transmit_date_in_sub3->CurrentValue;
		$this->transmit_date_in_sub3->ViewValue = FormatDateTime($this->transmit_date_in_sub3->ViewValue, 0);
		$this->transmit_date_in_sub3->ViewCustomAttributes = "";

		// submit_no_sub4
		$this->submit_no_sub4->ViewValue = $this->submit_no_sub4->CurrentValue;
		$this->submit_no_sub4->ViewCustomAttributes = "";

		// revision_no_sub4
		$this->revision_no_sub4->ViewValue = $this->revision_no_sub4->CurrentValue;
		$this->revision_no_sub4->ViewCustomAttributes = "";

		// direction_out_sub4
		$this->direction_out_sub4->ViewValue = $this->direction_out_sub4->CurrentValue;
		$this->direction_out_sub4->ViewCustomAttributes = "";

		// planned_date_out_sub4
		$this->planned_date_out_sub4->ViewValue = $this->planned_date_out_sub4->CurrentValue;
		$this->planned_date_out_sub4->ViewValue = FormatDateTime($this->planned_date_out_sub4->ViewValue, 0);
		$this->planned_date_out_sub4->ViewCustomAttributes = "";

		// transmit_date_out_sub4
		$this->transmit_date_out_sub4->ViewValue = $this->transmit_date_out_sub4->CurrentValue;
		$this->transmit_date_out_sub4->ViewValue = FormatDateTime($this->transmit_date_out_sub4->ViewValue, 0);
		$this->transmit_date_out_sub4->ViewCustomAttributes = "";

		// transmit_no_out_sub4
		$this->transmit_no_out_sub4->ViewValue = $this->transmit_no_out_sub4->CurrentValue;
		$this->transmit_no_out_sub4->ViewCustomAttributes = "";

		// approval_status_out_sub4
		$this->approval_status_out_sub4->ViewValue = $this->approval_status_out_sub4->CurrentValue;
		$this->approval_status_out_sub4->ViewCustomAttributes = "";

		// direction_out_file_sub4
		$this->direction_out_file_sub4->ViewValue = $this->direction_out_file_sub4->CurrentValue;
		$this->direction_out_file_sub4->ViewCustomAttributes = "";

		// direction_in_sub4
		$this->direction_in_sub4->ViewValue = $this->direction_in_sub4->CurrentValue;
		$this->direction_in_sub4->ViewCustomAttributes = "";

		// transmit_no_in_sub4
		$this->transmit_no_in_sub4->ViewValue = $this->transmit_no_in_sub4->CurrentValue;
		$this->transmit_no_in_sub4->ViewCustomAttributes = "";

		// approval_status_in_sub4
		$this->approval_status_in_sub4->ViewValue = $this->approval_status_in_sub4->CurrentValue;
		$this->approval_status_in_sub4->ViewCustomAttributes = "";

		// direction_in_file_sub4
		$this->direction_in_file_sub4->ViewValue = $this->direction_in_file_sub4->CurrentValue;
		$this->direction_in_file_sub4->ViewCustomAttributes = "";

		// transmit_date_in_sub4
		$this->transmit_date_in_sub4->ViewValue = $this->transmit_date_in_sub4->CurrentValue;
		$this->transmit_date_in_sub4->ViewValue = FormatDateTime($this->transmit_date_in_sub4->ViewValue, 0);
		$this->transmit_date_in_sub4->ViewCustomAttributes = "";

		// submit_no_sub5
		$this->submit_no_sub5->ViewValue = $this->submit_no_sub5->CurrentValue;
		$this->submit_no_sub5->ViewCustomAttributes = "";

		// revision_no_sub5
		$this->revision_no_sub5->ViewValue = $this->revision_no_sub5->CurrentValue;
		$this->revision_no_sub5->ViewCustomAttributes = "";

		// direction_out_sub5
		$this->direction_out_sub5->ViewValue = $this->direction_out_sub5->CurrentValue;
		$this->direction_out_sub5->ViewCustomAttributes = "";

		// planned_date_out_sub5
		$this->planned_date_out_sub5->ViewValue = $this->planned_date_out_sub5->CurrentValue;
		$this->planned_date_out_sub5->ViewValue = FormatDateTime($this->planned_date_out_sub5->ViewValue, 0);
		$this->planned_date_out_sub5->ViewCustomAttributes = "";

		// transmit_date_out_sub5
		$this->transmit_date_out_sub5->ViewValue = $this->transmit_date_out_sub5->CurrentValue;
		$this->transmit_date_out_sub5->ViewValue = FormatDateTime($this->transmit_date_out_sub5->ViewValue, 0);
		$this->transmit_date_out_sub5->ViewCustomAttributes = "";

		// transmit_no_out_sub5
		$this->transmit_no_out_sub5->ViewValue = $this->transmit_no_out_sub5->CurrentValue;
		$this->transmit_no_out_sub5->ViewCustomAttributes = "";

		// approval_status_out_sub5
		$this->approval_status_out_sub5->ViewValue = $this->approval_status_out_sub5->CurrentValue;
		$this->approval_status_out_sub5->ViewCustomAttributes = "";

		// direction_out_file_sub5
		$this->direction_out_file_sub5->ViewValue = $this->direction_out_file_sub5->CurrentValue;
		$this->direction_out_file_sub5->ViewCustomAttributes = "";

		// direction_in_sub5
		$this->direction_in_sub5->ViewValue = $this->direction_in_sub5->CurrentValue;
		$this->direction_in_sub5->ViewCustomAttributes = "";

		// transmit_no_in_sub5
		$this->transmit_no_in_sub5->ViewValue = $this->transmit_no_in_sub5->CurrentValue;
		$this->transmit_no_in_sub5->ViewCustomAttributes = "";

		// approval_status_in_sub5
		$this->approval_status_in_sub5->ViewValue = $this->approval_status_in_sub5->CurrentValue;
		$this->approval_status_in_sub5->ViewCustomAttributes = "";

		// direction_in_file_sub5
		$this->direction_in_file_sub5->ViewValue = $this->direction_in_file_sub5->CurrentValue;
		$this->direction_in_file_sub5->ViewCustomAttributes = "";

		// transmit_date_in_sub5
		$this->transmit_date_in_sub5->ViewValue = $this->transmit_date_in_sub5->CurrentValue;
		$this->transmit_date_in_sub5->ViewValue = FormatDateTime($this->transmit_date_in_sub5->ViewValue, 0);
		$this->transmit_date_in_sub5->ViewCustomAttributes = "";

		// submit_no_sub6
		$this->submit_no_sub6->ViewValue = $this->submit_no_sub6->CurrentValue;
		$this->submit_no_sub6->ViewCustomAttributes = "";

		// revision_no_sub6
		$this->revision_no_sub6->ViewValue = $this->revision_no_sub6->CurrentValue;
		$this->revision_no_sub6->ViewCustomAttributes = "";

		// direction_out_sub6
		$this->direction_out_sub6->ViewValue = $this->direction_out_sub6->CurrentValue;
		$this->direction_out_sub6->ViewCustomAttributes = "";

		// planned_date_out_sub6
		$this->planned_date_out_sub6->ViewValue = $this->planned_date_out_sub6->CurrentValue;
		$this->planned_date_out_sub6->ViewValue = FormatDateTime($this->planned_date_out_sub6->ViewValue, 0);
		$this->planned_date_out_sub6->ViewCustomAttributes = "";

		// transmit_date_out_sub6
		$this->transmit_date_out_sub6->ViewValue = $this->transmit_date_out_sub6->CurrentValue;
		$this->transmit_date_out_sub6->ViewValue = FormatDateTime($this->transmit_date_out_sub6->ViewValue, 0);
		$this->transmit_date_out_sub6->ViewCustomAttributes = "";

		// transmit_no_out_sub6
		$this->transmit_no_out_sub6->ViewValue = $this->transmit_no_out_sub6->CurrentValue;
		$this->transmit_no_out_sub6->ViewCustomAttributes = "";

		// approval_status_out_sub6
		$this->approval_status_out_sub6->ViewValue = $this->approval_status_out_sub6->CurrentValue;
		$this->approval_status_out_sub6->ViewCustomAttributes = "";

		// direction_out_file_sub6
		$this->direction_out_file_sub6->ViewValue = $this->direction_out_file_sub6->CurrentValue;
		$this->direction_out_file_sub6->ViewCustomAttributes = "";

		// direction_in_sub6
		$this->direction_in_sub6->ViewValue = $this->direction_in_sub6->CurrentValue;
		$this->direction_in_sub6->ViewCustomAttributes = "";

		// transmit_no_in_sub6
		$this->transmit_no_in_sub6->ViewValue = $this->transmit_no_in_sub6->CurrentValue;
		$this->transmit_no_in_sub6->ViewCustomAttributes = "";

		// approval_status_in_sub6
		$this->approval_status_in_sub6->ViewValue = $this->approval_status_in_sub6->CurrentValue;
		$this->approval_status_in_sub6->ViewCustomAttributes = "";

		// direction_in_file_sub6
		$this->direction_in_file_sub6->ViewValue = $this->direction_in_file_sub6->CurrentValue;
		$this->direction_in_file_sub6->ViewCustomAttributes = "";

		// transmit_date_in_sub6
		$this->transmit_date_in_sub6->ViewValue = $this->transmit_date_in_sub6->CurrentValue;
		$this->transmit_date_in_sub6->ViewValue = FormatDateTime($this->transmit_date_in_sub6->ViewValue, 0);
		$this->transmit_date_in_sub6->ViewCustomAttributes = "";

		// submit_no_sub7
		$this->submit_no_sub7->ViewValue = $this->submit_no_sub7->CurrentValue;
		$this->submit_no_sub7->ViewCustomAttributes = "";

		// revision_no_sub7
		$this->revision_no_sub7->ViewValue = $this->revision_no_sub7->CurrentValue;
		$this->revision_no_sub7->ViewCustomAttributes = "";

		// direction_out_sub7
		$this->direction_out_sub7->ViewValue = $this->direction_out_sub7->CurrentValue;
		$this->direction_out_sub7->ViewCustomAttributes = "";

		// planned_date_out_sub7
		$this->planned_date_out_sub7->ViewValue = $this->planned_date_out_sub7->CurrentValue;
		$this->planned_date_out_sub7->ViewValue = FormatDateTime($this->planned_date_out_sub7->ViewValue, 0);
		$this->planned_date_out_sub7->ViewCustomAttributes = "";

		// transmit_date_out_sub7
		$this->transmit_date_out_sub7->ViewValue = $this->transmit_date_out_sub7->CurrentValue;
		$this->transmit_date_out_sub7->ViewValue = FormatDateTime($this->transmit_date_out_sub7->ViewValue, 0);
		$this->transmit_date_out_sub7->ViewCustomAttributes = "";

		// transmit_no_out_sub7
		$this->transmit_no_out_sub7->ViewValue = $this->transmit_no_out_sub7->CurrentValue;
		$this->transmit_no_out_sub7->ViewCustomAttributes = "";

		// approval_status_out_sub7
		$this->approval_status_out_sub7->ViewValue = $this->approval_status_out_sub7->CurrentValue;
		$this->approval_status_out_sub7->ViewCustomAttributes = "";

		// direction_out_file_sub7
		$this->direction_out_file_sub7->ViewValue = $this->direction_out_file_sub7->CurrentValue;
		$this->direction_out_file_sub7->ViewCustomAttributes = "";

		// direction_in_sub7
		$this->direction_in_sub7->ViewValue = $this->direction_in_sub7->CurrentValue;
		$this->direction_in_sub7->ViewCustomAttributes = "";

		// transmit_no_in_sub7
		$this->transmit_no_in_sub7->ViewValue = $this->transmit_no_in_sub7->CurrentValue;
		$this->transmit_no_in_sub7->ViewCustomAttributes = "";

		// approval_status_in_sub7
		$this->approval_status_in_sub7->ViewValue = $this->approval_status_in_sub7->CurrentValue;
		$this->approval_status_in_sub7->ViewCustomAttributes = "";

		// direction_in_file_sub7
		$this->direction_in_file_sub7->ViewValue = $this->direction_in_file_sub7->CurrentValue;
		$this->direction_in_file_sub7->ViewCustomAttributes = "";

		// transmit_date_in_sub7
		$this->transmit_date_in_sub7->ViewValue = $this->transmit_date_in_sub7->CurrentValue;
		$this->transmit_date_in_sub7->ViewValue = FormatDateTime($this->transmit_date_in_sub7->ViewValue, 0);
		$this->transmit_date_in_sub7->ViewCustomAttributes = "";

		// submit_no_sub8
		$this->submit_no_sub8->ViewValue = $this->submit_no_sub8->CurrentValue;
		$this->submit_no_sub8->ViewCustomAttributes = "";

		// revision_no_sub8
		$this->revision_no_sub8->ViewValue = $this->revision_no_sub8->CurrentValue;
		$this->revision_no_sub8->ViewCustomAttributes = "";

		// direction_out_sub8
		$this->direction_out_sub8->ViewValue = $this->direction_out_sub8->CurrentValue;
		$this->direction_out_sub8->ViewCustomAttributes = "";

		// planned_date_out_sub8
		$this->planned_date_out_sub8->ViewValue = $this->planned_date_out_sub8->CurrentValue;
		$this->planned_date_out_sub8->ViewValue = FormatDateTime($this->planned_date_out_sub8->ViewValue, 0);
		$this->planned_date_out_sub8->ViewCustomAttributes = "";

		// transmit_date_out_sub8
		$this->transmit_date_out_sub8->ViewValue = $this->transmit_date_out_sub8->CurrentValue;
		$this->transmit_date_out_sub8->ViewValue = FormatDateTime($this->transmit_date_out_sub8->ViewValue, 0);
		$this->transmit_date_out_sub8->ViewCustomAttributes = "";

		// transmit_no_out_sub8
		$this->transmit_no_out_sub8->ViewValue = $this->transmit_no_out_sub8->CurrentValue;
		$this->transmit_no_out_sub8->ViewCustomAttributes = "";

		// approval_status_out_sub8
		$this->approval_status_out_sub8->ViewValue = $this->approval_status_out_sub8->CurrentValue;
		$this->approval_status_out_sub8->ViewCustomAttributes = "";

		// direction_out_file_sub8
		$this->direction_out_file_sub8->ViewValue = $this->direction_out_file_sub8->CurrentValue;
		$this->direction_out_file_sub8->ViewCustomAttributes = "";

		// direction_in_sub8
		$this->direction_in_sub8->ViewValue = $this->direction_in_sub8->CurrentValue;
		$this->direction_in_sub8->ViewCustomAttributes = "";

		// transmit_no_in_sub8
		$this->transmit_no_in_sub8->ViewValue = $this->transmit_no_in_sub8->CurrentValue;
		$this->transmit_no_in_sub8->ViewCustomAttributes = "";

		// approval_status_in_sub8
		$this->approval_status_in_sub8->ViewValue = $this->approval_status_in_sub8->CurrentValue;
		$this->approval_status_in_sub8->ViewCustomAttributes = "";

		// direction_in_file_sub8
		$this->direction_in_file_sub8->ViewValue = $this->direction_in_file_sub8->CurrentValue;
		$this->direction_in_file_sub8->ViewCustomAttributes = "";

		// transmit_date_in_sub8
		$this->transmit_date_in_sub8->ViewValue = $this->transmit_date_in_sub8->CurrentValue;
		$this->transmit_date_in_sub8->ViewValue = FormatDateTime($this->transmit_date_in_sub8->ViewValue, 0);
		$this->transmit_date_in_sub8->ViewCustomAttributes = "";

		// submit_no_sub9
		$this->submit_no_sub9->ViewValue = $this->submit_no_sub9->CurrentValue;
		$this->submit_no_sub9->ViewCustomAttributes = "";

		// revision_no_sub9
		$this->revision_no_sub9->ViewValue = $this->revision_no_sub9->CurrentValue;
		$this->revision_no_sub9->ViewCustomAttributes = "";

		// direction_out_sub9
		$this->direction_out_sub9->ViewValue = $this->direction_out_sub9->CurrentValue;
		$this->direction_out_sub9->ViewCustomAttributes = "";

		// planned_date_out_sub9
		$this->planned_date_out_sub9->ViewValue = $this->planned_date_out_sub9->CurrentValue;
		$this->planned_date_out_sub9->ViewValue = FormatDateTime($this->planned_date_out_sub9->ViewValue, 0);
		$this->planned_date_out_sub9->ViewCustomAttributes = "";

		// transmit_date_out_sub9
		$this->transmit_date_out_sub9->ViewValue = $this->transmit_date_out_sub9->CurrentValue;
		$this->transmit_date_out_sub9->ViewValue = FormatDateTime($this->transmit_date_out_sub9->ViewValue, 0);
		$this->transmit_date_out_sub9->ViewCustomAttributes = "";

		// transmit_no_out_sub9
		$this->transmit_no_out_sub9->ViewValue = $this->transmit_no_out_sub9->CurrentValue;
		$this->transmit_no_out_sub9->ViewCustomAttributes = "";

		// approval_status_out_sub9
		$this->approval_status_out_sub9->ViewValue = $this->approval_status_out_sub9->CurrentValue;
		$this->approval_status_out_sub9->ViewCustomAttributes = "";

		// direction_out_file_sub9
		$this->direction_out_file_sub9->ViewValue = $this->direction_out_file_sub9->CurrentValue;
		$this->direction_out_file_sub9->ViewCustomAttributes = "";

		// direction_in_sub9
		$this->direction_in_sub9->ViewValue = $this->direction_in_sub9->CurrentValue;
		$this->direction_in_sub9->ViewCustomAttributes = "";

		// transmit_no_in_sub9
		$this->transmit_no_in_sub9->ViewValue = $this->transmit_no_in_sub9->CurrentValue;
		$this->transmit_no_in_sub9->ViewCustomAttributes = "";

		// approval_status_in_sub9
		$this->approval_status_in_sub9->ViewValue = $this->approval_status_in_sub9->CurrentValue;
		$this->approval_status_in_sub9->ViewCustomAttributes = "";

		// direction_in_file_sub9
		$this->direction_in_file_sub9->ViewValue = $this->direction_in_file_sub9->CurrentValue;
		$this->direction_in_file_sub9->ViewCustomAttributes = "";

		// transmit_date_in_sub9
		$this->transmit_date_in_sub9->ViewValue = $this->transmit_date_in_sub9->CurrentValue;
		$this->transmit_date_in_sub9->ViewValue = FormatDateTime($this->transmit_date_in_sub9->ViewValue, 0);
		$this->transmit_date_in_sub9->ViewCustomAttributes = "";

		// submit_no_sub10
		$this->submit_no_sub10->ViewValue = $this->submit_no_sub10->CurrentValue;
		$this->submit_no_sub10->ViewCustomAttributes = "";

		// revision_no_sub10
		$this->revision_no_sub10->ViewValue = $this->revision_no_sub10->CurrentValue;
		$this->revision_no_sub10->ViewCustomAttributes = "";

		// direction_out_sub10
		$this->direction_out_sub10->ViewValue = $this->direction_out_sub10->CurrentValue;
		$this->direction_out_sub10->ViewCustomAttributes = "";

		// planned_date_out_sub10
		$this->planned_date_out_sub10->ViewValue = $this->planned_date_out_sub10->CurrentValue;
		$this->planned_date_out_sub10->ViewValue = FormatDateTime($this->planned_date_out_sub10->ViewValue, 0);
		$this->planned_date_out_sub10->ViewCustomAttributes = "";

		// transmit_date_out_sub10
		$this->transmit_date_out_sub10->ViewValue = $this->transmit_date_out_sub10->CurrentValue;
		$this->transmit_date_out_sub10->ViewValue = FormatDateTime($this->transmit_date_out_sub10->ViewValue, 0);
		$this->transmit_date_out_sub10->ViewCustomAttributes = "";

		// transmit_no_out_sub10
		$this->transmit_no_out_sub10->ViewValue = $this->transmit_no_out_sub10->CurrentValue;
		$this->transmit_no_out_sub10->ViewCustomAttributes = "";

		// approval_status_out_sub10
		$this->approval_status_out_sub10->ViewValue = $this->approval_status_out_sub10->CurrentValue;
		$this->approval_status_out_sub10->ViewCustomAttributes = "";

		// direction_out_file_sub10
		$this->direction_out_file_sub10->ViewValue = $this->direction_out_file_sub10->CurrentValue;
		$this->direction_out_file_sub10->ViewCustomAttributes = "";

		// direction_in_sub10
		$this->direction_in_sub10->ViewValue = $this->direction_in_sub10->CurrentValue;
		$this->direction_in_sub10->ViewCustomAttributes = "";

		// transmit_no_in_sub10
		$this->transmit_no_in_sub10->ViewValue = $this->transmit_no_in_sub10->CurrentValue;
		$this->transmit_no_in_sub10->ViewCustomAttributes = "";

		// approval_status_in_sub10
		$this->approval_status_in_sub10->ViewValue = $this->approval_status_in_sub10->CurrentValue;
		$this->approval_status_in_sub10->ViewCustomAttributes = "";

		// direction_in_file_sub10
		$this->direction_in_file_sub10->ViewValue = $this->direction_in_file_sub10->CurrentValue;
		$this->direction_in_file_sub10->ViewCustomAttributes = "";

		// transmit_date_in_sub10
		$this->transmit_date_in_sub10->ViewValue = $this->transmit_date_in_sub10->CurrentValue;
		$this->transmit_date_in_sub10->ViewValue = FormatDateTime($this->transmit_date_in_sub10->ViewValue, 0);
		$this->transmit_date_in_sub10->ViewCustomAttributes = "";

		// log_updatedon
		$this->log_updatedon->ViewValue = $this->log_updatedon->CurrentValue;
		$this->log_updatedon->ViewValue = FormatDateTime($this->log_updatedon->ViewValue, 0);
		$this->log_updatedon->ViewCustomAttributes = "";

		// log_id
		$this->log_id->LinkCustomAttributes = "";
		$this->log_id->HrefValue = "";
		$this->log_id->TooltipValue = "";

		// firelink_doc_no
		$this->firelink_doc_no->LinkCustomAttributes = "";
		$this->firelink_doc_no->HrefValue = "";
		$this->firelink_doc_no->TooltipValue = "";

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
		$this->current_status->HrefValue = "";
		$this->current_status->TooltipValue = "";

		// current_status_file
		$this->current_status_file->LinkCustomAttributes = "";
		$this->current_status_file->HrefValue = "";
		$this->current_status_file->TooltipValue = "";

		// submit_no_sub1
		$this->submit_no_sub1->LinkCustomAttributes = "";
		$this->submit_no_sub1->HrefValue = "";
		$this->submit_no_sub1->TooltipValue = "";

		// revision_no_sub1
		$this->revision_no_sub1->LinkCustomAttributes = "";
		$this->revision_no_sub1->HrefValue = "";
		$this->revision_no_sub1->TooltipValue = "";

		// direction_out_sub1
		$this->direction_out_sub1->LinkCustomAttributes = "";
		$this->direction_out_sub1->HrefValue = "";
		$this->direction_out_sub1->TooltipValue = "";

		// planned_date_out_sub1
		$this->planned_date_out_sub1->LinkCustomAttributes = "";
		$this->planned_date_out_sub1->HrefValue = "";
		$this->planned_date_out_sub1->TooltipValue = "";

		// transmit_date_out_sub1
		$this->transmit_date_out_sub1->LinkCustomAttributes = "";
		$this->transmit_date_out_sub1->HrefValue = "";
		$this->transmit_date_out_sub1->TooltipValue = "";

		// transmit_no_out_sub1
		$this->transmit_no_out_sub1->LinkCustomAttributes = "";
		$this->transmit_no_out_sub1->HrefValue = "";
		$this->transmit_no_out_sub1->TooltipValue = "";

		// approval_status_out_sub1
		$this->approval_status_out_sub1->LinkCustomAttributes = "";
		$this->approval_status_out_sub1->HrefValue = "";
		$this->approval_status_out_sub1->TooltipValue = "";

		// direction_out_file_sub1
		$this->direction_out_file_sub1->LinkCustomAttributes = "";
		$this->direction_out_file_sub1->HrefValue = "";
		$this->direction_out_file_sub1->TooltipValue = "";

		// direction_in_sub1
		$this->direction_in_sub1->LinkCustomAttributes = "";
		$this->direction_in_sub1->HrefValue = "";
		$this->direction_in_sub1->TooltipValue = "";

		// transmit_no_in_sub1
		$this->transmit_no_in_sub1->LinkCustomAttributes = "";
		$this->transmit_no_in_sub1->HrefValue = "";
		$this->transmit_no_in_sub1->TooltipValue = "";

		// approval_status_in_sub1
		$this->approval_status_in_sub1->LinkCustomAttributes = "";
		$this->approval_status_in_sub1->HrefValue = "";
		$this->approval_status_in_sub1->TooltipValue = "";

		// direction_in_file_sub1
		$this->direction_in_file_sub1->LinkCustomAttributes = "";
		$this->direction_in_file_sub1->HrefValue = "";
		$this->direction_in_file_sub1->TooltipValue = "";

		// transmit_date_in_sub1
		$this->transmit_date_in_sub1->LinkCustomAttributes = "";
		$this->transmit_date_in_sub1->HrefValue = "";
		$this->transmit_date_in_sub1->TooltipValue = "";

		// submit_no_sub2
		$this->submit_no_sub2->LinkCustomAttributes = "";
		$this->submit_no_sub2->HrefValue = "";
		$this->submit_no_sub2->TooltipValue = "";

		// revision_no_sub2
		$this->revision_no_sub2->LinkCustomAttributes = "";
		$this->revision_no_sub2->HrefValue = "";
		$this->revision_no_sub2->TooltipValue = "";

		// direction_out_sub2
		$this->direction_out_sub2->LinkCustomAttributes = "";
		$this->direction_out_sub2->HrefValue = "";
		$this->direction_out_sub2->TooltipValue = "";

		// planned_date_out_sub2
		$this->planned_date_out_sub2->LinkCustomAttributes = "";
		$this->planned_date_out_sub2->HrefValue = "";
		$this->planned_date_out_sub2->TooltipValue = "";

		// transmit_date_out_sub2
		$this->transmit_date_out_sub2->LinkCustomAttributes = "";
		$this->transmit_date_out_sub2->HrefValue = "";
		$this->transmit_date_out_sub2->TooltipValue = "";

		// transmit_no_out_sub2
		$this->transmit_no_out_sub2->LinkCustomAttributes = "";
		$this->transmit_no_out_sub2->HrefValue = "";
		$this->transmit_no_out_sub2->TooltipValue = "";

		// approval_status_out_sub2
		$this->approval_status_out_sub2->LinkCustomAttributes = "";
		$this->approval_status_out_sub2->HrefValue = "";
		$this->approval_status_out_sub2->TooltipValue = "";

		// direction_out_file_sub2
		$this->direction_out_file_sub2->LinkCustomAttributes = "";
		$this->direction_out_file_sub2->HrefValue = "";
		$this->direction_out_file_sub2->TooltipValue = "";

		// direction_in_sub2
		$this->direction_in_sub2->LinkCustomAttributes = "";
		$this->direction_in_sub2->HrefValue = "";
		$this->direction_in_sub2->TooltipValue = "";

		// transmit_no_in_sub2
		$this->transmit_no_in_sub2->LinkCustomAttributes = "";
		$this->transmit_no_in_sub2->HrefValue = "";
		$this->transmit_no_in_sub2->TooltipValue = "";

		// approval_status_in_sub2
		$this->approval_status_in_sub2->LinkCustomAttributes = "";
		$this->approval_status_in_sub2->HrefValue = "";
		$this->approval_status_in_sub2->TooltipValue = "";

		// direction_in_file_sub2
		$this->direction_in_file_sub2->LinkCustomAttributes = "";
		$this->direction_in_file_sub2->HrefValue = "";
		$this->direction_in_file_sub2->TooltipValue = "";

		// transmit_date_in_sub2
		$this->transmit_date_in_sub2->LinkCustomAttributes = "";
		$this->transmit_date_in_sub2->HrefValue = "";
		$this->transmit_date_in_sub2->TooltipValue = "";

		// submit_no_sub3
		$this->submit_no_sub3->LinkCustomAttributes = "";
		$this->submit_no_sub3->HrefValue = "";
		$this->submit_no_sub3->TooltipValue = "";

		// revision_no_sub3
		$this->revision_no_sub3->LinkCustomAttributes = "";
		$this->revision_no_sub3->HrefValue = "";
		$this->revision_no_sub3->TooltipValue = "";

		// direction_out_sub3
		$this->direction_out_sub3->LinkCustomAttributes = "";
		$this->direction_out_sub3->HrefValue = "";
		$this->direction_out_sub3->TooltipValue = "";

		// planned_date_out_sub3
		$this->planned_date_out_sub3->LinkCustomAttributes = "";
		$this->planned_date_out_sub3->HrefValue = "";
		$this->planned_date_out_sub3->TooltipValue = "";

		// transmit_date_out_sub3
		$this->transmit_date_out_sub3->LinkCustomAttributes = "";
		$this->transmit_date_out_sub3->HrefValue = "";
		$this->transmit_date_out_sub3->TooltipValue = "";

		// transmit_no_out_sub3
		$this->transmit_no_out_sub3->LinkCustomAttributes = "";
		$this->transmit_no_out_sub3->HrefValue = "";
		$this->transmit_no_out_sub3->TooltipValue = "";

		// approval_status_out_sub3
		$this->approval_status_out_sub3->LinkCustomAttributes = "";
		$this->approval_status_out_sub3->HrefValue = "";
		$this->approval_status_out_sub3->TooltipValue = "";

		// direction_out_file_sub3
		$this->direction_out_file_sub3->LinkCustomAttributes = "";
		$this->direction_out_file_sub3->HrefValue = "";
		$this->direction_out_file_sub3->TooltipValue = "";

		// direction_in_sub3
		$this->direction_in_sub3->LinkCustomAttributes = "";
		$this->direction_in_sub3->HrefValue = "";
		$this->direction_in_sub3->TooltipValue = "";

		// transmit_no_in_sub3
		$this->transmit_no_in_sub3->LinkCustomAttributes = "";
		$this->transmit_no_in_sub3->HrefValue = "";
		$this->transmit_no_in_sub3->TooltipValue = "";

		// approval_status_in_sub3
		$this->approval_status_in_sub3->LinkCustomAttributes = "";
		$this->approval_status_in_sub3->HrefValue = "";
		$this->approval_status_in_sub3->TooltipValue = "";

		// direction_in_file_sub3
		$this->direction_in_file_sub3->LinkCustomAttributes = "";
		$this->direction_in_file_sub3->HrefValue = "";
		$this->direction_in_file_sub3->TooltipValue = "";

		// transmit_date_in_sub3
		$this->transmit_date_in_sub3->LinkCustomAttributes = "";
		$this->transmit_date_in_sub3->HrefValue = "";
		$this->transmit_date_in_sub3->TooltipValue = "";

		// submit_no_sub4
		$this->submit_no_sub4->LinkCustomAttributes = "";
		$this->submit_no_sub4->HrefValue = "";
		$this->submit_no_sub4->TooltipValue = "";

		// revision_no_sub4
		$this->revision_no_sub4->LinkCustomAttributes = "";
		$this->revision_no_sub4->HrefValue = "";
		$this->revision_no_sub4->TooltipValue = "";

		// direction_out_sub4
		$this->direction_out_sub4->LinkCustomAttributes = "";
		$this->direction_out_sub4->HrefValue = "";
		$this->direction_out_sub4->TooltipValue = "";

		// planned_date_out_sub4
		$this->planned_date_out_sub4->LinkCustomAttributes = "";
		$this->planned_date_out_sub4->HrefValue = "";
		$this->planned_date_out_sub4->TooltipValue = "";

		// transmit_date_out_sub4
		$this->transmit_date_out_sub4->LinkCustomAttributes = "";
		$this->transmit_date_out_sub4->HrefValue = "";
		$this->transmit_date_out_sub4->TooltipValue = "";

		// transmit_no_out_sub4
		$this->transmit_no_out_sub4->LinkCustomAttributes = "";
		$this->transmit_no_out_sub4->HrefValue = "";
		$this->transmit_no_out_sub4->TooltipValue = "";

		// approval_status_out_sub4
		$this->approval_status_out_sub4->LinkCustomAttributes = "";
		$this->approval_status_out_sub4->HrefValue = "";
		$this->approval_status_out_sub4->TooltipValue = "";

		// direction_out_file_sub4
		$this->direction_out_file_sub4->LinkCustomAttributes = "";
		$this->direction_out_file_sub4->HrefValue = "";
		$this->direction_out_file_sub4->TooltipValue = "";

		// direction_in_sub4
		$this->direction_in_sub4->LinkCustomAttributes = "";
		$this->direction_in_sub4->HrefValue = "";
		$this->direction_in_sub4->TooltipValue = "";

		// transmit_no_in_sub4
		$this->transmit_no_in_sub4->LinkCustomAttributes = "";
		$this->transmit_no_in_sub4->HrefValue = "";
		$this->transmit_no_in_sub4->TooltipValue = "";

		// approval_status_in_sub4
		$this->approval_status_in_sub4->LinkCustomAttributes = "";
		$this->approval_status_in_sub4->HrefValue = "";
		$this->approval_status_in_sub4->TooltipValue = "";

		// direction_in_file_sub4
		$this->direction_in_file_sub4->LinkCustomAttributes = "";
		$this->direction_in_file_sub4->HrefValue = "";
		$this->direction_in_file_sub4->TooltipValue = "";

		// transmit_date_in_sub4
		$this->transmit_date_in_sub4->LinkCustomAttributes = "";
		$this->transmit_date_in_sub4->HrefValue = "";
		$this->transmit_date_in_sub4->TooltipValue = "";

		// submit_no_sub5
		$this->submit_no_sub5->LinkCustomAttributes = "";
		$this->submit_no_sub5->HrefValue = "";
		$this->submit_no_sub5->TooltipValue = "";

		// revision_no_sub5
		$this->revision_no_sub5->LinkCustomAttributes = "";
		$this->revision_no_sub5->HrefValue = "";
		$this->revision_no_sub5->TooltipValue = "";

		// direction_out_sub5
		$this->direction_out_sub5->LinkCustomAttributes = "";
		$this->direction_out_sub5->HrefValue = "";
		$this->direction_out_sub5->TooltipValue = "";

		// planned_date_out_sub5
		$this->planned_date_out_sub5->LinkCustomAttributes = "";
		$this->planned_date_out_sub5->HrefValue = "";
		$this->planned_date_out_sub5->TooltipValue = "";

		// transmit_date_out_sub5
		$this->transmit_date_out_sub5->LinkCustomAttributes = "";
		$this->transmit_date_out_sub5->HrefValue = "";
		$this->transmit_date_out_sub5->TooltipValue = "";

		// transmit_no_out_sub5
		$this->transmit_no_out_sub5->LinkCustomAttributes = "";
		$this->transmit_no_out_sub5->HrefValue = "";
		$this->transmit_no_out_sub5->TooltipValue = "";

		// approval_status_out_sub5
		$this->approval_status_out_sub5->LinkCustomAttributes = "";
		$this->approval_status_out_sub5->HrefValue = "";
		$this->approval_status_out_sub5->TooltipValue = "";

		// direction_out_file_sub5
		$this->direction_out_file_sub5->LinkCustomAttributes = "";
		$this->direction_out_file_sub5->HrefValue = "";
		$this->direction_out_file_sub5->TooltipValue = "";

		// direction_in_sub5
		$this->direction_in_sub5->LinkCustomAttributes = "";
		$this->direction_in_sub5->HrefValue = "";
		$this->direction_in_sub5->TooltipValue = "";

		// transmit_no_in_sub5
		$this->transmit_no_in_sub5->LinkCustomAttributes = "";
		$this->transmit_no_in_sub5->HrefValue = "";
		$this->transmit_no_in_sub5->TooltipValue = "";

		// approval_status_in_sub5
		$this->approval_status_in_sub5->LinkCustomAttributes = "";
		$this->approval_status_in_sub5->HrefValue = "";
		$this->approval_status_in_sub5->TooltipValue = "";

		// direction_in_file_sub5
		$this->direction_in_file_sub5->LinkCustomAttributes = "";
		$this->direction_in_file_sub5->HrefValue = "";
		$this->direction_in_file_sub5->TooltipValue = "";

		// transmit_date_in_sub5
		$this->transmit_date_in_sub5->LinkCustomAttributes = "";
		$this->transmit_date_in_sub5->HrefValue = "";
		$this->transmit_date_in_sub5->TooltipValue = "";

		// submit_no_sub6
		$this->submit_no_sub6->LinkCustomAttributes = "";
		$this->submit_no_sub6->HrefValue = "";
		$this->submit_no_sub6->TooltipValue = "";

		// revision_no_sub6
		$this->revision_no_sub6->LinkCustomAttributes = "";
		$this->revision_no_sub6->HrefValue = "";
		$this->revision_no_sub6->TooltipValue = "";

		// direction_out_sub6
		$this->direction_out_sub6->LinkCustomAttributes = "";
		$this->direction_out_sub6->HrefValue = "";
		$this->direction_out_sub6->TooltipValue = "";

		// planned_date_out_sub6
		$this->planned_date_out_sub6->LinkCustomAttributes = "";
		$this->planned_date_out_sub6->HrefValue = "";
		$this->planned_date_out_sub6->TooltipValue = "";

		// transmit_date_out_sub6
		$this->transmit_date_out_sub6->LinkCustomAttributes = "";
		$this->transmit_date_out_sub6->HrefValue = "";
		$this->transmit_date_out_sub6->TooltipValue = "";

		// transmit_no_out_sub6
		$this->transmit_no_out_sub6->LinkCustomAttributes = "";
		$this->transmit_no_out_sub6->HrefValue = "";
		$this->transmit_no_out_sub6->TooltipValue = "";

		// approval_status_out_sub6
		$this->approval_status_out_sub6->LinkCustomAttributes = "";
		$this->approval_status_out_sub6->HrefValue = "";
		$this->approval_status_out_sub6->TooltipValue = "";

		// direction_out_file_sub6
		$this->direction_out_file_sub6->LinkCustomAttributes = "";
		$this->direction_out_file_sub6->HrefValue = "";
		$this->direction_out_file_sub6->TooltipValue = "";

		// direction_in_sub6
		$this->direction_in_sub6->LinkCustomAttributes = "";
		$this->direction_in_sub6->HrefValue = "";
		$this->direction_in_sub6->TooltipValue = "";

		// transmit_no_in_sub6
		$this->transmit_no_in_sub6->LinkCustomAttributes = "";
		$this->transmit_no_in_sub6->HrefValue = "";
		$this->transmit_no_in_sub6->TooltipValue = "";

		// approval_status_in_sub6
		$this->approval_status_in_sub6->LinkCustomAttributes = "";
		$this->approval_status_in_sub6->HrefValue = "";
		$this->approval_status_in_sub6->TooltipValue = "";

		// direction_in_file_sub6
		$this->direction_in_file_sub6->LinkCustomAttributes = "";
		$this->direction_in_file_sub6->HrefValue = "";
		$this->direction_in_file_sub6->TooltipValue = "";

		// transmit_date_in_sub6
		$this->transmit_date_in_sub6->LinkCustomAttributes = "";
		$this->transmit_date_in_sub6->HrefValue = "";
		$this->transmit_date_in_sub6->TooltipValue = "";

		// submit_no_sub7
		$this->submit_no_sub7->LinkCustomAttributes = "";
		$this->submit_no_sub7->HrefValue = "";
		$this->submit_no_sub7->TooltipValue = "";

		// revision_no_sub7
		$this->revision_no_sub7->LinkCustomAttributes = "";
		$this->revision_no_sub7->HrefValue = "";
		$this->revision_no_sub7->TooltipValue = "";

		// direction_out_sub7
		$this->direction_out_sub7->LinkCustomAttributes = "";
		$this->direction_out_sub7->HrefValue = "";
		$this->direction_out_sub7->TooltipValue = "";

		// planned_date_out_sub7
		$this->planned_date_out_sub7->LinkCustomAttributes = "";
		$this->planned_date_out_sub7->HrefValue = "";
		$this->planned_date_out_sub7->TooltipValue = "";

		// transmit_date_out_sub7
		$this->transmit_date_out_sub7->LinkCustomAttributes = "";
		$this->transmit_date_out_sub7->HrefValue = "";
		$this->transmit_date_out_sub7->TooltipValue = "";

		// transmit_no_out_sub7
		$this->transmit_no_out_sub7->LinkCustomAttributes = "";
		$this->transmit_no_out_sub7->HrefValue = "";
		$this->transmit_no_out_sub7->TooltipValue = "";

		// approval_status_out_sub7
		$this->approval_status_out_sub7->LinkCustomAttributes = "";
		$this->approval_status_out_sub7->HrefValue = "";
		$this->approval_status_out_sub7->TooltipValue = "";

		// direction_out_file_sub7
		$this->direction_out_file_sub7->LinkCustomAttributes = "";
		$this->direction_out_file_sub7->HrefValue = "";
		$this->direction_out_file_sub7->TooltipValue = "";

		// direction_in_sub7
		$this->direction_in_sub7->LinkCustomAttributes = "";
		$this->direction_in_sub7->HrefValue = "";
		$this->direction_in_sub7->TooltipValue = "";

		// transmit_no_in_sub7
		$this->transmit_no_in_sub7->LinkCustomAttributes = "";
		$this->transmit_no_in_sub7->HrefValue = "";
		$this->transmit_no_in_sub7->TooltipValue = "";

		// approval_status_in_sub7
		$this->approval_status_in_sub7->LinkCustomAttributes = "";
		$this->approval_status_in_sub7->HrefValue = "";
		$this->approval_status_in_sub7->TooltipValue = "";

		// direction_in_file_sub7
		$this->direction_in_file_sub7->LinkCustomAttributes = "";
		$this->direction_in_file_sub7->HrefValue = "";
		$this->direction_in_file_sub7->TooltipValue = "";

		// transmit_date_in_sub7
		$this->transmit_date_in_sub7->LinkCustomAttributes = "";
		$this->transmit_date_in_sub7->HrefValue = "";
		$this->transmit_date_in_sub7->TooltipValue = "";

		// submit_no_sub8
		$this->submit_no_sub8->LinkCustomAttributes = "";
		$this->submit_no_sub8->HrefValue = "";
		$this->submit_no_sub8->TooltipValue = "";

		// revision_no_sub8
		$this->revision_no_sub8->LinkCustomAttributes = "";
		$this->revision_no_sub8->HrefValue = "";
		$this->revision_no_sub8->TooltipValue = "";

		// direction_out_sub8
		$this->direction_out_sub8->LinkCustomAttributes = "";
		$this->direction_out_sub8->HrefValue = "";
		$this->direction_out_sub8->TooltipValue = "";

		// planned_date_out_sub8
		$this->planned_date_out_sub8->LinkCustomAttributes = "";
		$this->planned_date_out_sub8->HrefValue = "";
		$this->planned_date_out_sub8->TooltipValue = "";

		// transmit_date_out_sub8
		$this->transmit_date_out_sub8->LinkCustomAttributes = "";
		$this->transmit_date_out_sub8->HrefValue = "";
		$this->transmit_date_out_sub8->TooltipValue = "";

		// transmit_no_out_sub8
		$this->transmit_no_out_sub8->LinkCustomAttributes = "";
		$this->transmit_no_out_sub8->HrefValue = "";
		$this->transmit_no_out_sub8->TooltipValue = "";

		// approval_status_out_sub8
		$this->approval_status_out_sub8->LinkCustomAttributes = "";
		$this->approval_status_out_sub8->HrefValue = "";
		$this->approval_status_out_sub8->TooltipValue = "";

		// direction_out_file_sub8
		$this->direction_out_file_sub8->LinkCustomAttributes = "";
		$this->direction_out_file_sub8->HrefValue = "";
		$this->direction_out_file_sub8->TooltipValue = "";

		// direction_in_sub8
		$this->direction_in_sub8->LinkCustomAttributes = "";
		$this->direction_in_sub8->HrefValue = "";
		$this->direction_in_sub8->TooltipValue = "";

		// transmit_no_in_sub8
		$this->transmit_no_in_sub8->LinkCustomAttributes = "";
		$this->transmit_no_in_sub8->HrefValue = "";
		$this->transmit_no_in_sub8->TooltipValue = "";

		// approval_status_in_sub8
		$this->approval_status_in_sub8->LinkCustomAttributes = "";
		$this->approval_status_in_sub8->HrefValue = "";
		$this->approval_status_in_sub8->TooltipValue = "";

		// direction_in_file_sub8
		$this->direction_in_file_sub8->LinkCustomAttributes = "";
		$this->direction_in_file_sub8->HrefValue = "";
		$this->direction_in_file_sub8->TooltipValue = "";

		// transmit_date_in_sub8
		$this->transmit_date_in_sub8->LinkCustomAttributes = "";
		$this->transmit_date_in_sub8->HrefValue = "";
		$this->transmit_date_in_sub8->TooltipValue = "";

		// submit_no_sub9
		$this->submit_no_sub9->LinkCustomAttributes = "";
		$this->submit_no_sub9->HrefValue = "";
		$this->submit_no_sub9->TooltipValue = "";

		// revision_no_sub9
		$this->revision_no_sub9->LinkCustomAttributes = "";
		$this->revision_no_sub9->HrefValue = "";
		$this->revision_no_sub9->TooltipValue = "";

		// direction_out_sub9
		$this->direction_out_sub9->LinkCustomAttributes = "";
		$this->direction_out_sub9->HrefValue = "";
		$this->direction_out_sub9->TooltipValue = "";

		// planned_date_out_sub9
		$this->planned_date_out_sub9->LinkCustomAttributes = "";
		$this->planned_date_out_sub9->HrefValue = "";
		$this->planned_date_out_sub9->TooltipValue = "";

		// transmit_date_out_sub9
		$this->transmit_date_out_sub9->LinkCustomAttributes = "";
		$this->transmit_date_out_sub9->HrefValue = "";
		$this->transmit_date_out_sub9->TooltipValue = "";

		// transmit_no_out_sub9
		$this->transmit_no_out_sub9->LinkCustomAttributes = "";
		$this->transmit_no_out_sub9->HrefValue = "";
		$this->transmit_no_out_sub9->TooltipValue = "";

		// approval_status_out_sub9
		$this->approval_status_out_sub9->LinkCustomAttributes = "";
		$this->approval_status_out_sub9->HrefValue = "";
		$this->approval_status_out_sub9->TooltipValue = "";

		// direction_out_file_sub9
		$this->direction_out_file_sub9->LinkCustomAttributes = "";
		$this->direction_out_file_sub9->HrefValue = "";
		$this->direction_out_file_sub9->TooltipValue = "";

		// direction_in_sub9
		$this->direction_in_sub9->LinkCustomAttributes = "";
		$this->direction_in_sub9->HrefValue = "";
		$this->direction_in_sub9->TooltipValue = "";

		// transmit_no_in_sub9
		$this->transmit_no_in_sub9->LinkCustomAttributes = "";
		$this->transmit_no_in_sub9->HrefValue = "";
		$this->transmit_no_in_sub9->TooltipValue = "";

		// approval_status_in_sub9
		$this->approval_status_in_sub9->LinkCustomAttributes = "";
		$this->approval_status_in_sub9->HrefValue = "";
		$this->approval_status_in_sub9->TooltipValue = "";

		// direction_in_file_sub9
		$this->direction_in_file_sub9->LinkCustomAttributes = "";
		$this->direction_in_file_sub9->HrefValue = "";
		$this->direction_in_file_sub9->TooltipValue = "";

		// transmit_date_in_sub9
		$this->transmit_date_in_sub9->LinkCustomAttributes = "";
		$this->transmit_date_in_sub9->HrefValue = "";
		$this->transmit_date_in_sub9->TooltipValue = "";

		// submit_no_sub10
		$this->submit_no_sub10->LinkCustomAttributes = "";
		$this->submit_no_sub10->HrefValue = "";
		$this->submit_no_sub10->TooltipValue = "";

		// revision_no_sub10
		$this->revision_no_sub10->LinkCustomAttributes = "";
		$this->revision_no_sub10->HrefValue = "";
		$this->revision_no_sub10->TooltipValue = "";

		// direction_out_sub10
		$this->direction_out_sub10->LinkCustomAttributes = "";
		$this->direction_out_sub10->HrefValue = "";
		$this->direction_out_sub10->TooltipValue = "";

		// planned_date_out_sub10
		$this->planned_date_out_sub10->LinkCustomAttributes = "";
		$this->planned_date_out_sub10->HrefValue = "";
		$this->planned_date_out_sub10->TooltipValue = "";

		// transmit_date_out_sub10
		$this->transmit_date_out_sub10->LinkCustomAttributes = "";
		$this->transmit_date_out_sub10->HrefValue = "";
		$this->transmit_date_out_sub10->TooltipValue = "";

		// transmit_no_out_sub10
		$this->transmit_no_out_sub10->LinkCustomAttributes = "";
		$this->transmit_no_out_sub10->HrefValue = "";
		$this->transmit_no_out_sub10->TooltipValue = "";

		// approval_status_out_sub10
		$this->approval_status_out_sub10->LinkCustomAttributes = "";
		$this->approval_status_out_sub10->HrefValue = "";
		$this->approval_status_out_sub10->TooltipValue = "";

		// direction_out_file_sub10
		$this->direction_out_file_sub10->LinkCustomAttributes = "";
		$this->direction_out_file_sub10->HrefValue = "";
		$this->direction_out_file_sub10->TooltipValue = "";

		// direction_in_sub10
		$this->direction_in_sub10->LinkCustomAttributes = "";
		$this->direction_in_sub10->HrefValue = "";
		$this->direction_in_sub10->TooltipValue = "";

		// transmit_no_in_sub10
		$this->transmit_no_in_sub10->LinkCustomAttributes = "";
		$this->transmit_no_in_sub10->HrefValue = "";
		$this->transmit_no_in_sub10->TooltipValue = "";

		// approval_status_in_sub10
		$this->approval_status_in_sub10->LinkCustomAttributes = "";
		$this->approval_status_in_sub10->HrefValue = "";
		$this->approval_status_in_sub10->TooltipValue = "";

		// direction_in_file_sub10
		$this->direction_in_file_sub10->LinkCustomAttributes = "";
		$this->direction_in_file_sub10->HrefValue = "";
		$this->direction_in_file_sub10->TooltipValue = "";

		// transmit_date_in_sub10
		$this->transmit_date_in_sub10->LinkCustomAttributes = "";
		$this->transmit_date_in_sub10->HrefValue = "";
		$this->transmit_date_in_sub10->TooltipValue = "";

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

		// submit_no_sub1
		$this->submit_no_sub1->EditAttrs["class"] = "form-control";
		$this->submit_no_sub1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->submit_no_sub1->CurrentValue = HtmlDecode($this->submit_no_sub1->CurrentValue);
		$this->submit_no_sub1->EditValue = $this->submit_no_sub1->CurrentValue;
		$this->submit_no_sub1->PlaceHolder = RemoveHtml($this->submit_no_sub1->caption());

		// revision_no_sub1
		$this->revision_no_sub1->EditAttrs["class"] = "form-control";
		$this->revision_no_sub1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_sub1->CurrentValue = HtmlDecode($this->revision_no_sub1->CurrentValue);
		$this->revision_no_sub1->EditValue = $this->revision_no_sub1->CurrentValue;
		$this->revision_no_sub1->PlaceHolder = RemoveHtml($this->revision_no_sub1->caption());

		// direction_out_sub1
		$this->direction_out_sub1->EditAttrs["class"] = "form-control";
		$this->direction_out_sub1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_sub1->CurrentValue = HtmlDecode($this->direction_out_sub1->CurrentValue);
		$this->direction_out_sub1->EditValue = $this->direction_out_sub1->CurrentValue;
		$this->direction_out_sub1->PlaceHolder = RemoveHtml($this->direction_out_sub1->caption());

		// planned_date_out_sub1
		$this->planned_date_out_sub1->EditAttrs["class"] = "form-control";
		$this->planned_date_out_sub1->EditCustomAttributes = "";
		$this->planned_date_out_sub1->EditValue = FormatDateTime($this->planned_date_out_sub1->CurrentValue, 8);
		$this->planned_date_out_sub1->PlaceHolder = RemoveHtml($this->planned_date_out_sub1->caption());

		// transmit_date_out_sub1
		$this->transmit_date_out_sub1->EditAttrs["class"] = "form-control";
		$this->transmit_date_out_sub1->EditCustomAttributes = "";
		$this->transmit_date_out_sub1->EditValue = FormatDateTime($this->transmit_date_out_sub1->CurrentValue, 8);
		$this->transmit_date_out_sub1->PlaceHolder = RemoveHtml($this->transmit_date_out_sub1->caption());

		// transmit_no_out_sub1
		$this->transmit_no_out_sub1->EditAttrs["class"] = "form-control";
		$this->transmit_no_out_sub1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_out_sub1->CurrentValue = HtmlDecode($this->transmit_no_out_sub1->CurrentValue);
		$this->transmit_no_out_sub1->EditValue = $this->transmit_no_out_sub1->CurrentValue;
		$this->transmit_no_out_sub1->PlaceHolder = RemoveHtml($this->transmit_no_out_sub1->caption());

		// approval_status_out_sub1
		$this->approval_status_out_sub1->EditAttrs["class"] = "form-control";
		$this->approval_status_out_sub1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_out_sub1->CurrentValue = HtmlDecode($this->approval_status_out_sub1->CurrentValue);
		$this->approval_status_out_sub1->EditValue = $this->approval_status_out_sub1->CurrentValue;
		$this->approval_status_out_sub1->PlaceHolder = RemoveHtml($this->approval_status_out_sub1->caption());

		// direction_out_file_sub1
		$this->direction_out_file_sub1->EditAttrs["class"] = "form-control";
		$this->direction_out_file_sub1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_file_sub1->CurrentValue = HtmlDecode($this->direction_out_file_sub1->CurrentValue);
		$this->direction_out_file_sub1->EditValue = $this->direction_out_file_sub1->CurrentValue;
		$this->direction_out_file_sub1->PlaceHolder = RemoveHtml($this->direction_out_file_sub1->caption());

		// direction_in_sub1
		$this->direction_in_sub1->EditAttrs["class"] = "form-control";
		$this->direction_in_sub1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_sub1->CurrentValue = HtmlDecode($this->direction_in_sub1->CurrentValue);
		$this->direction_in_sub1->EditValue = $this->direction_in_sub1->CurrentValue;
		$this->direction_in_sub1->PlaceHolder = RemoveHtml($this->direction_in_sub1->caption());

		// transmit_no_in_sub1
		$this->transmit_no_in_sub1->EditAttrs["class"] = "form-control";
		$this->transmit_no_in_sub1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_in_sub1->CurrentValue = HtmlDecode($this->transmit_no_in_sub1->CurrentValue);
		$this->transmit_no_in_sub1->EditValue = $this->transmit_no_in_sub1->CurrentValue;
		$this->transmit_no_in_sub1->PlaceHolder = RemoveHtml($this->transmit_no_in_sub1->caption());

		// approval_status_in_sub1
		$this->approval_status_in_sub1->EditAttrs["class"] = "form-control";
		$this->approval_status_in_sub1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_in_sub1->CurrentValue = HtmlDecode($this->approval_status_in_sub1->CurrentValue);
		$this->approval_status_in_sub1->EditValue = $this->approval_status_in_sub1->CurrentValue;
		$this->approval_status_in_sub1->PlaceHolder = RemoveHtml($this->approval_status_in_sub1->caption());

		// direction_in_file_sub1
		$this->direction_in_file_sub1->EditAttrs["class"] = "form-control";
		$this->direction_in_file_sub1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_file_sub1->CurrentValue = HtmlDecode($this->direction_in_file_sub1->CurrentValue);
		$this->direction_in_file_sub1->EditValue = $this->direction_in_file_sub1->CurrentValue;
		$this->direction_in_file_sub1->PlaceHolder = RemoveHtml($this->direction_in_file_sub1->caption());

		// transmit_date_in_sub1
		$this->transmit_date_in_sub1->EditAttrs["class"] = "form-control";
		$this->transmit_date_in_sub1->EditCustomAttributes = "";
		$this->transmit_date_in_sub1->EditValue = FormatDateTime($this->transmit_date_in_sub1->CurrentValue, 8);
		$this->transmit_date_in_sub1->PlaceHolder = RemoveHtml($this->transmit_date_in_sub1->caption());

		// submit_no_sub2
		$this->submit_no_sub2->EditAttrs["class"] = "form-control";
		$this->submit_no_sub2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->submit_no_sub2->CurrentValue = HtmlDecode($this->submit_no_sub2->CurrentValue);
		$this->submit_no_sub2->EditValue = $this->submit_no_sub2->CurrentValue;
		$this->submit_no_sub2->PlaceHolder = RemoveHtml($this->submit_no_sub2->caption());

		// revision_no_sub2
		$this->revision_no_sub2->EditAttrs["class"] = "form-control";
		$this->revision_no_sub2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_sub2->CurrentValue = HtmlDecode($this->revision_no_sub2->CurrentValue);
		$this->revision_no_sub2->EditValue = $this->revision_no_sub2->CurrentValue;
		$this->revision_no_sub2->PlaceHolder = RemoveHtml($this->revision_no_sub2->caption());

		// direction_out_sub2
		$this->direction_out_sub2->EditAttrs["class"] = "form-control";
		$this->direction_out_sub2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_sub2->CurrentValue = HtmlDecode($this->direction_out_sub2->CurrentValue);
		$this->direction_out_sub2->EditValue = $this->direction_out_sub2->CurrentValue;
		$this->direction_out_sub2->PlaceHolder = RemoveHtml($this->direction_out_sub2->caption());

		// planned_date_out_sub2
		$this->planned_date_out_sub2->EditAttrs["class"] = "form-control";
		$this->planned_date_out_sub2->EditCustomAttributes = "";
		$this->planned_date_out_sub2->EditValue = FormatDateTime($this->planned_date_out_sub2->CurrentValue, 8);
		$this->planned_date_out_sub2->PlaceHolder = RemoveHtml($this->planned_date_out_sub2->caption());

		// transmit_date_out_sub2
		$this->transmit_date_out_sub2->EditAttrs["class"] = "form-control";
		$this->transmit_date_out_sub2->EditCustomAttributes = "";
		$this->transmit_date_out_sub2->EditValue = FormatDateTime($this->transmit_date_out_sub2->CurrentValue, 8);
		$this->transmit_date_out_sub2->PlaceHolder = RemoveHtml($this->transmit_date_out_sub2->caption());

		// transmit_no_out_sub2
		$this->transmit_no_out_sub2->EditAttrs["class"] = "form-control";
		$this->transmit_no_out_sub2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_out_sub2->CurrentValue = HtmlDecode($this->transmit_no_out_sub2->CurrentValue);
		$this->transmit_no_out_sub2->EditValue = $this->transmit_no_out_sub2->CurrentValue;
		$this->transmit_no_out_sub2->PlaceHolder = RemoveHtml($this->transmit_no_out_sub2->caption());

		// approval_status_out_sub2
		$this->approval_status_out_sub2->EditAttrs["class"] = "form-control";
		$this->approval_status_out_sub2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_out_sub2->CurrentValue = HtmlDecode($this->approval_status_out_sub2->CurrentValue);
		$this->approval_status_out_sub2->EditValue = $this->approval_status_out_sub2->CurrentValue;
		$this->approval_status_out_sub2->PlaceHolder = RemoveHtml($this->approval_status_out_sub2->caption());

		// direction_out_file_sub2
		$this->direction_out_file_sub2->EditAttrs["class"] = "form-control";
		$this->direction_out_file_sub2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_file_sub2->CurrentValue = HtmlDecode($this->direction_out_file_sub2->CurrentValue);
		$this->direction_out_file_sub2->EditValue = $this->direction_out_file_sub2->CurrentValue;
		$this->direction_out_file_sub2->PlaceHolder = RemoveHtml($this->direction_out_file_sub2->caption());

		// direction_in_sub2
		$this->direction_in_sub2->EditAttrs["class"] = "form-control";
		$this->direction_in_sub2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_sub2->CurrentValue = HtmlDecode($this->direction_in_sub2->CurrentValue);
		$this->direction_in_sub2->EditValue = $this->direction_in_sub2->CurrentValue;
		$this->direction_in_sub2->PlaceHolder = RemoveHtml($this->direction_in_sub2->caption());

		// transmit_no_in_sub2
		$this->transmit_no_in_sub2->EditAttrs["class"] = "form-control";
		$this->transmit_no_in_sub2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_in_sub2->CurrentValue = HtmlDecode($this->transmit_no_in_sub2->CurrentValue);
		$this->transmit_no_in_sub2->EditValue = $this->transmit_no_in_sub2->CurrentValue;
		$this->transmit_no_in_sub2->PlaceHolder = RemoveHtml($this->transmit_no_in_sub2->caption());

		// approval_status_in_sub2
		$this->approval_status_in_sub2->EditAttrs["class"] = "form-control";
		$this->approval_status_in_sub2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_in_sub2->CurrentValue = HtmlDecode($this->approval_status_in_sub2->CurrentValue);
		$this->approval_status_in_sub2->EditValue = $this->approval_status_in_sub2->CurrentValue;
		$this->approval_status_in_sub2->PlaceHolder = RemoveHtml($this->approval_status_in_sub2->caption());

		// direction_in_file_sub2
		$this->direction_in_file_sub2->EditAttrs["class"] = "form-control";
		$this->direction_in_file_sub2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_file_sub2->CurrentValue = HtmlDecode($this->direction_in_file_sub2->CurrentValue);
		$this->direction_in_file_sub2->EditValue = $this->direction_in_file_sub2->CurrentValue;
		$this->direction_in_file_sub2->PlaceHolder = RemoveHtml($this->direction_in_file_sub2->caption());

		// transmit_date_in_sub2
		$this->transmit_date_in_sub2->EditAttrs["class"] = "form-control";
		$this->transmit_date_in_sub2->EditCustomAttributes = "";
		$this->transmit_date_in_sub2->EditValue = FormatDateTime($this->transmit_date_in_sub2->CurrentValue, 8);
		$this->transmit_date_in_sub2->PlaceHolder = RemoveHtml($this->transmit_date_in_sub2->caption());

		// submit_no_sub3
		$this->submit_no_sub3->EditAttrs["class"] = "form-control";
		$this->submit_no_sub3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->submit_no_sub3->CurrentValue = HtmlDecode($this->submit_no_sub3->CurrentValue);
		$this->submit_no_sub3->EditValue = $this->submit_no_sub3->CurrentValue;
		$this->submit_no_sub3->PlaceHolder = RemoveHtml($this->submit_no_sub3->caption());

		// revision_no_sub3
		$this->revision_no_sub3->EditAttrs["class"] = "form-control";
		$this->revision_no_sub3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_sub3->CurrentValue = HtmlDecode($this->revision_no_sub3->CurrentValue);
		$this->revision_no_sub3->EditValue = $this->revision_no_sub3->CurrentValue;
		$this->revision_no_sub3->PlaceHolder = RemoveHtml($this->revision_no_sub3->caption());

		// direction_out_sub3
		$this->direction_out_sub3->EditAttrs["class"] = "form-control";
		$this->direction_out_sub3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_sub3->CurrentValue = HtmlDecode($this->direction_out_sub3->CurrentValue);
		$this->direction_out_sub3->EditValue = $this->direction_out_sub3->CurrentValue;
		$this->direction_out_sub3->PlaceHolder = RemoveHtml($this->direction_out_sub3->caption());

		// planned_date_out_sub3
		$this->planned_date_out_sub3->EditAttrs["class"] = "form-control";
		$this->planned_date_out_sub3->EditCustomAttributes = "";
		$this->planned_date_out_sub3->EditValue = FormatDateTime($this->planned_date_out_sub3->CurrentValue, 8);
		$this->planned_date_out_sub3->PlaceHolder = RemoveHtml($this->planned_date_out_sub3->caption());

		// transmit_date_out_sub3
		$this->transmit_date_out_sub3->EditAttrs["class"] = "form-control";
		$this->transmit_date_out_sub3->EditCustomAttributes = "";
		$this->transmit_date_out_sub3->EditValue = FormatDateTime($this->transmit_date_out_sub3->CurrentValue, 8);
		$this->transmit_date_out_sub3->PlaceHolder = RemoveHtml($this->transmit_date_out_sub3->caption());

		// transmit_no_out_sub3
		$this->transmit_no_out_sub3->EditAttrs["class"] = "form-control";
		$this->transmit_no_out_sub3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_out_sub3->CurrentValue = HtmlDecode($this->transmit_no_out_sub3->CurrentValue);
		$this->transmit_no_out_sub3->EditValue = $this->transmit_no_out_sub3->CurrentValue;
		$this->transmit_no_out_sub3->PlaceHolder = RemoveHtml($this->transmit_no_out_sub3->caption());

		// approval_status_out_sub3
		$this->approval_status_out_sub3->EditAttrs["class"] = "form-control";
		$this->approval_status_out_sub3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_out_sub3->CurrentValue = HtmlDecode($this->approval_status_out_sub3->CurrentValue);
		$this->approval_status_out_sub3->EditValue = $this->approval_status_out_sub3->CurrentValue;
		$this->approval_status_out_sub3->PlaceHolder = RemoveHtml($this->approval_status_out_sub3->caption());

		// direction_out_file_sub3
		$this->direction_out_file_sub3->EditAttrs["class"] = "form-control";
		$this->direction_out_file_sub3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_file_sub3->CurrentValue = HtmlDecode($this->direction_out_file_sub3->CurrentValue);
		$this->direction_out_file_sub3->EditValue = $this->direction_out_file_sub3->CurrentValue;
		$this->direction_out_file_sub3->PlaceHolder = RemoveHtml($this->direction_out_file_sub3->caption());

		// direction_in_sub3
		$this->direction_in_sub3->EditAttrs["class"] = "form-control";
		$this->direction_in_sub3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_sub3->CurrentValue = HtmlDecode($this->direction_in_sub3->CurrentValue);
		$this->direction_in_sub3->EditValue = $this->direction_in_sub3->CurrentValue;
		$this->direction_in_sub3->PlaceHolder = RemoveHtml($this->direction_in_sub3->caption());

		// transmit_no_in_sub3
		$this->transmit_no_in_sub3->EditAttrs["class"] = "form-control";
		$this->transmit_no_in_sub3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_in_sub3->CurrentValue = HtmlDecode($this->transmit_no_in_sub3->CurrentValue);
		$this->transmit_no_in_sub3->EditValue = $this->transmit_no_in_sub3->CurrentValue;
		$this->transmit_no_in_sub3->PlaceHolder = RemoveHtml($this->transmit_no_in_sub3->caption());

		// approval_status_in_sub3
		$this->approval_status_in_sub3->EditAttrs["class"] = "form-control";
		$this->approval_status_in_sub3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_in_sub3->CurrentValue = HtmlDecode($this->approval_status_in_sub3->CurrentValue);
		$this->approval_status_in_sub3->EditValue = $this->approval_status_in_sub3->CurrentValue;
		$this->approval_status_in_sub3->PlaceHolder = RemoveHtml($this->approval_status_in_sub3->caption());

		// direction_in_file_sub3
		$this->direction_in_file_sub3->EditAttrs["class"] = "form-control";
		$this->direction_in_file_sub3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_file_sub3->CurrentValue = HtmlDecode($this->direction_in_file_sub3->CurrentValue);
		$this->direction_in_file_sub3->EditValue = $this->direction_in_file_sub3->CurrentValue;
		$this->direction_in_file_sub3->PlaceHolder = RemoveHtml($this->direction_in_file_sub3->caption());

		// transmit_date_in_sub3
		$this->transmit_date_in_sub3->EditAttrs["class"] = "form-control";
		$this->transmit_date_in_sub3->EditCustomAttributes = "";
		$this->transmit_date_in_sub3->EditValue = FormatDateTime($this->transmit_date_in_sub3->CurrentValue, 8);
		$this->transmit_date_in_sub3->PlaceHolder = RemoveHtml($this->transmit_date_in_sub3->caption());

		// submit_no_sub4
		$this->submit_no_sub4->EditAttrs["class"] = "form-control";
		$this->submit_no_sub4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->submit_no_sub4->CurrentValue = HtmlDecode($this->submit_no_sub4->CurrentValue);
		$this->submit_no_sub4->EditValue = $this->submit_no_sub4->CurrentValue;
		$this->submit_no_sub4->PlaceHolder = RemoveHtml($this->submit_no_sub4->caption());

		// revision_no_sub4
		$this->revision_no_sub4->EditAttrs["class"] = "form-control";
		$this->revision_no_sub4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_sub4->CurrentValue = HtmlDecode($this->revision_no_sub4->CurrentValue);
		$this->revision_no_sub4->EditValue = $this->revision_no_sub4->CurrentValue;
		$this->revision_no_sub4->PlaceHolder = RemoveHtml($this->revision_no_sub4->caption());

		// direction_out_sub4
		$this->direction_out_sub4->EditAttrs["class"] = "form-control";
		$this->direction_out_sub4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_sub4->CurrentValue = HtmlDecode($this->direction_out_sub4->CurrentValue);
		$this->direction_out_sub4->EditValue = $this->direction_out_sub4->CurrentValue;
		$this->direction_out_sub4->PlaceHolder = RemoveHtml($this->direction_out_sub4->caption());

		// planned_date_out_sub4
		$this->planned_date_out_sub4->EditAttrs["class"] = "form-control";
		$this->planned_date_out_sub4->EditCustomAttributes = "";
		$this->planned_date_out_sub4->EditValue = FormatDateTime($this->planned_date_out_sub4->CurrentValue, 8);
		$this->planned_date_out_sub4->PlaceHolder = RemoveHtml($this->planned_date_out_sub4->caption());

		// transmit_date_out_sub4
		$this->transmit_date_out_sub4->EditAttrs["class"] = "form-control";
		$this->transmit_date_out_sub4->EditCustomAttributes = "";
		$this->transmit_date_out_sub4->EditValue = FormatDateTime($this->transmit_date_out_sub4->CurrentValue, 8);
		$this->transmit_date_out_sub4->PlaceHolder = RemoveHtml($this->transmit_date_out_sub4->caption());

		// transmit_no_out_sub4
		$this->transmit_no_out_sub4->EditAttrs["class"] = "form-control";
		$this->transmit_no_out_sub4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_out_sub4->CurrentValue = HtmlDecode($this->transmit_no_out_sub4->CurrentValue);
		$this->transmit_no_out_sub4->EditValue = $this->transmit_no_out_sub4->CurrentValue;
		$this->transmit_no_out_sub4->PlaceHolder = RemoveHtml($this->transmit_no_out_sub4->caption());

		// approval_status_out_sub4
		$this->approval_status_out_sub4->EditAttrs["class"] = "form-control";
		$this->approval_status_out_sub4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_out_sub4->CurrentValue = HtmlDecode($this->approval_status_out_sub4->CurrentValue);
		$this->approval_status_out_sub4->EditValue = $this->approval_status_out_sub4->CurrentValue;
		$this->approval_status_out_sub4->PlaceHolder = RemoveHtml($this->approval_status_out_sub4->caption());

		// direction_out_file_sub4
		$this->direction_out_file_sub4->EditAttrs["class"] = "form-control";
		$this->direction_out_file_sub4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_file_sub4->CurrentValue = HtmlDecode($this->direction_out_file_sub4->CurrentValue);
		$this->direction_out_file_sub4->EditValue = $this->direction_out_file_sub4->CurrentValue;
		$this->direction_out_file_sub4->PlaceHolder = RemoveHtml($this->direction_out_file_sub4->caption());

		// direction_in_sub4
		$this->direction_in_sub4->EditAttrs["class"] = "form-control";
		$this->direction_in_sub4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_sub4->CurrentValue = HtmlDecode($this->direction_in_sub4->CurrentValue);
		$this->direction_in_sub4->EditValue = $this->direction_in_sub4->CurrentValue;
		$this->direction_in_sub4->PlaceHolder = RemoveHtml($this->direction_in_sub4->caption());

		// transmit_no_in_sub4
		$this->transmit_no_in_sub4->EditAttrs["class"] = "form-control";
		$this->transmit_no_in_sub4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_in_sub4->CurrentValue = HtmlDecode($this->transmit_no_in_sub4->CurrentValue);
		$this->transmit_no_in_sub4->EditValue = $this->transmit_no_in_sub4->CurrentValue;
		$this->transmit_no_in_sub4->PlaceHolder = RemoveHtml($this->transmit_no_in_sub4->caption());

		// approval_status_in_sub4
		$this->approval_status_in_sub4->EditAttrs["class"] = "form-control";
		$this->approval_status_in_sub4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_in_sub4->CurrentValue = HtmlDecode($this->approval_status_in_sub4->CurrentValue);
		$this->approval_status_in_sub4->EditValue = $this->approval_status_in_sub4->CurrentValue;
		$this->approval_status_in_sub4->PlaceHolder = RemoveHtml($this->approval_status_in_sub4->caption());

		// direction_in_file_sub4
		$this->direction_in_file_sub4->EditAttrs["class"] = "form-control";
		$this->direction_in_file_sub4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_file_sub4->CurrentValue = HtmlDecode($this->direction_in_file_sub4->CurrentValue);
		$this->direction_in_file_sub4->EditValue = $this->direction_in_file_sub4->CurrentValue;
		$this->direction_in_file_sub4->PlaceHolder = RemoveHtml($this->direction_in_file_sub4->caption());

		// transmit_date_in_sub4
		$this->transmit_date_in_sub4->EditAttrs["class"] = "form-control";
		$this->transmit_date_in_sub4->EditCustomAttributes = "";
		$this->transmit_date_in_sub4->EditValue = FormatDateTime($this->transmit_date_in_sub4->CurrentValue, 8);
		$this->transmit_date_in_sub4->PlaceHolder = RemoveHtml($this->transmit_date_in_sub4->caption());

		// submit_no_sub5
		$this->submit_no_sub5->EditAttrs["class"] = "form-control";
		$this->submit_no_sub5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->submit_no_sub5->CurrentValue = HtmlDecode($this->submit_no_sub5->CurrentValue);
		$this->submit_no_sub5->EditValue = $this->submit_no_sub5->CurrentValue;
		$this->submit_no_sub5->PlaceHolder = RemoveHtml($this->submit_no_sub5->caption());

		// revision_no_sub5
		$this->revision_no_sub5->EditAttrs["class"] = "form-control";
		$this->revision_no_sub5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_sub5->CurrentValue = HtmlDecode($this->revision_no_sub5->CurrentValue);
		$this->revision_no_sub5->EditValue = $this->revision_no_sub5->CurrentValue;
		$this->revision_no_sub5->PlaceHolder = RemoveHtml($this->revision_no_sub5->caption());

		// direction_out_sub5
		$this->direction_out_sub5->EditAttrs["class"] = "form-control";
		$this->direction_out_sub5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_sub5->CurrentValue = HtmlDecode($this->direction_out_sub5->CurrentValue);
		$this->direction_out_sub5->EditValue = $this->direction_out_sub5->CurrentValue;
		$this->direction_out_sub5->PlaceHolder = RemoveHtml($this->direction_out_sub5->caption());

		// planned_date_out_sub5
		$this->planned_date_out_sub5->EditAttrs["class"] = "form-control";
		$this->planned_date_out_sub5->EditCustomAttributes = "";
		$this->planned_date_out_sub5->EditValue = FormatDateTime($this->planned_date_out_sub5->CurrentValue, 8);
		$this->planned_date_out_sub5->PlaceHolder = RemoveHtml($this->planned_date_out_sub5->caption());

		// transmit_date_out_sub5
		$this->transmit_date_out_sub5->EditAttrs["class"] = "form-control";
		$this->transmit_date_out_sub5->EditCustomAttributes = "";
		$this->transmit_date_out_sub5->EditValue = FormatDateTime($this->transmit_date_out_sub5->CurrentValue, 8);
		$this->transmit_date_out_sub5->PlaceHolder = RemoveHtml($this->transmit_date_out_sub5->caption());

		// transmit_no_out_sub5
		$this->transmit_no_out_sub5->EditAttrs["class"] = "form-control";
		$this->transmit_no_out_sub5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_out_sub5->CurrentValue = HtmlDecode($this->transmit_no_out_sub5->CurrentValue);
		$this->transmit_no_out_sub5->EditValue = $this->transmit_no_out_sub5->CurrentValue;
		$this->transmit_no_out_sub5->PlaceHolder = RemoveHtml($this->transmit_no_out_sub5->caption());

		// approval_status_out_sub5
		$this->approval_status_out_sub5->EditAttrs["class"] = "form-control";
		$this->approval_status_out_sub5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_out_sub5->CurrentValue = HtmlDecode($this->approval_status_out_sub5->CurrentValue);
		$this->approval_status_out_sub5->EditValue = $this->approval_status_out_sub5->CurrentValue;
		$this->approval_status_out_sub5->PlaceHolder = RemoveHtml($this->approval_status_out_sub5->caption());

		// direction_out_file_sub5
		$this->direction_out_file_sub5->EditAttrs["class"] = "form-control";
		$this->direction_out_file_sub5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_file_sub5->CurrentValue = HtmlDecode($this->direction_out_file_sub5->CurrentValue);
		$this->direction_out_file_sub5->EditValue = $this->direction_out_file_sub5->CurrentValue;
		$this->direction_out_file_sub5->PlaceHolder = RemoveHtml($this->direction_out_file_sub5->caption());

		// direction_in_sub5
		$this->direction_in_sub5->EditAttrs["class"] = "form-control";
		$this->direction_in_sub5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_sub5->CurrentValue = HtmlDecode($this->direction_in_sub5->CurrentValue);
		$this->direction_in_sub5->EditValue = $this->direction_in_sub5->CurrentValue;
		$this->direction_in_sub5->PlaceHolder = RemoveHtml($this->direction_in_sub5->caption());

		// transmit_no_in_sub5
		$this->transmit_no_in_sub5->EditAttrs["class"] = "form-control";
		$this->transmit_no_in_sub5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_in_sub5->CurrentValue = HtmlDecode($this->transmit_no_in_sub5->CurrentValue);
		$this->transmit_no_in_sub5->EditValue = $this->transmit_no_in_sub5->CurrentValue;
		$this->transmit_no_in_sub5->PlaceHolder = RemoveHtml($this->transmit_no_in_sub5->caption());

		// approval_status_in_sub5
		$this->approval_status_in_sub5->EditAttrs["class"] = "form-control";
		$this->approval_status_in_sub5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_in_sub5->CurrentValue = HtmlDecode($this->approval_status_in_sub5->CurrentValue);
		$this->approval_status_in_sub5->EditValue = $this->approval_status_in_sub5->CurrentValue;
		$this->approval_status_in_sub5->PlaceHolder = RemoveHtml($this->approval_status_in_sub5->caption());

		// direction_in_file_sub5
		$this->direction_in_file_sub5->EditAttrs["class"] = "form-control";
		$this->direction_in_file_sub5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_file_sub5->CurrentValue = HtmlDecode($this->direction_in_file_sub5->CurrentValue);
		$this->direction_in_file_sub5->EditValue = $this->direction_in_file_sub5->CurrentValue;
		$this->direction_in_file_sub5->PlaceHolder = RemoveHtml($this->direction_in_file_sub5->caption());

		// transmit_date_in_sub5
		$this->transmit_date_in_sub5->EditAttrs["class"] = "form-control";
		$this->transmit_date_in_sub5->EditCustomAttributes = "";
		$this->transmit_date_in_sub5->EditValue = FormatDateTime($this->transmit_date_in_sub5->CurrentValue, 8);
		$this->transmit_date_in_sub5->PlaceHolder = RemoveHtml($this->transmit_date_in_sub5->caption());

		// submit_no_sub6
		$this->submit_no_sub6->EditAttrs["class"] = "form-control";
		$this->submit_no_sub6->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->submit_no_sub6->CurrentValue = HtmlDecode($this->submit_no_sub6->CurrentValue);
		$this->submit_no_sub6->EditValue = $this->submit_no_sub6->CurrentValue;
		$this->submit_no_sub6->PlaceHolder = RemoveHtml($this->submit_no_sub6->caption());

		// revision_no_sub6
		$this->revision_no_sub6->EditAttrs["class"] = "form-control";
		$this->revision_no_sub6->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_sub6->CurrentValue = HtmlDecode($this->revision_no_sub6->CurrentValue);
		$this->revision_no_sub6->EditValue = $this->revision_no_sub6->CurrentValue;
		$this->revision_no_sub6->PlaceHolder = RemoveHtml($this->revision_no_sub6->caption());

		// direction_out_sub6
		$this->direction_out_sub6->EditAttrs["class"] = "form-control";
		$this->direction_out_sub6->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_sub6->CurrentValue = HtmlDecode($this->direction_out_sub6->CurrentValue);
		$this->direction_out_sub6->EditValue = $this->direction_out_sub6->CurrentValue;
		$this->direction_out_sub6->PlaceHolder = RemoveHtml($this->direction_out_sub6->caption());

		// planned_date_out_sub6
		$this->planned_date_out_sub6->EditAttrs["class"] = "form-control";
		$this->planned_date_out_sub6->EditCustomAttributes = "";
		$this->planned_date_out_sub6->EditValue = FormatDateTime($this->planned_date_out_sub6->CurrentValue, 8);
		$this->planned_date_out_sub6->PlaceHolder = RemoveHtml($this->planned_date_out_sub6->caption());

		// transmit_date_out_sub6
		$this->transmit_date_out_sub6->EditAttrs["class"] = "form-control";
		$this->transmit_date_out_sub6->EditCustomAttributes = "";
		$this->transmit_date_out_sub6->EditValue = FormatDateTime($this->transmit_date_out_sub6->CurrentValue, 8);
		$this->transmit_date_out_sub6->PlaceHolder = RemoveHtml($this->transmit_date_out_sub6->caption());

		// transmit_no_out_sub6
		$this->transmit_no_out_sub6->EditAttrs["class"] = "form-control";
		$this->transmit_no_out_sub6->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_out_sub6->CurrentValue = HtmlDecode($this->transmit_no_out_sub6->CurrentValue);
		$this->transmit_no_out_sub6->EditValue = $this->transmit_no_out_sub6->CurrentValue;
		$this->transmit_no_out_sub6->PlaceHolder = RemoveHtml($this->transmit_no_out_sub6->caption());

		// approval_status_out_sub6
		$this->approval_status_out_sub6->EditAttrs["class"] = "form-control";
		$this->approval_status_out_sub6->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_out_sub6->CurrentValue = HtmlDecode($this->approval_status_out_sub6->CurrentValue);
		$this->approval_status_out_sub6->EditValue = $this->approval_status_out_sub6->CurrentValue;
		$this->approval_status_out_sub6->PlaceHolder = RemoveHtml($this->approval_status_out_sub6->caption());

		// direction_out_file_sub6
		$this->direction_out_file_sub6->EditAttrs["class"] = "form-control";
		$this->direction_out_file_sub6->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_file_sub6->CurrentValue = HtmlDecode($this->direction_out_file_sub6->CurrentValue);
		$this->direction_out_file_sub6->EditValue = $this->direction_out_file_sub6->CurrentValue;
		$this->direction_out_file_sub6->PlaceHolder = RemoveHtml($this->direction_out_file_sub6->caption());

		// direction_in_sub6
		$this->direction_in_sub6->EditAttrs["class"] = "form-control";
		$this->direction_in_sub6->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_sub6->CurrentValue = HtmlDecode($this->direction_in_sub6->CurrentValue);
		$this->direction_in_sub6->EditValue = $this->direction_in_sub6->CurrentValue;
		$this->direction_in_sub6->PlaceHolder = RemoveHtml($this->direction_in_sub6->caption());

		// transmit_no_in_sub6
		$this->transmit_no_in_sub6->EditAttrs["class"] = "form-control";
		$this->transmit_no_in_sub6->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_in_sub6->CurrentValue = HtmlDecode($this->transmit_no_in_sub6->CurrentValue);
		$this->transmit_no_in_sub6->EditValue = $this->transmit_no_in_sub6->CurrentValue;
		$this->transmit_no_in_sub6->PlaceHolder = RemoveHtml($this->transmit_no_in_sub6->caption());

		// approval_status_in_sub6
		$this->approval_status_in_sub6->EditAttrs["class"] = "form-control";
		$this->approval_status_in_sub6->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_in_sub6->CurrentValue = HtmlDecode($this->approval_status_in_sub6->CurrentValue);
		$this->approval_status_in_sub6->EditValue = $this->approval_status_in_sub6->CurrentValue;
		$this->approval_status_in_sub6->PlaceHolder = RemoveHtml($this->approval_status_in_sub6->caption());

		// direction_in_file_sub6
		$this->direction_in_file_sub6->EditAttrs["class"] = "form-control";
		$this->direction_in_file_sub6->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_file_sub6->CurrentValue = HtmlDecode($this->direction_in_file_sub6->CurrentValue);
		$this->direction_in_file_sub6->EditValue = $this->direction_in_file_sub6->CurrentValue;
		$this->direction_in_file_sub6->PlaceHolder = RemoveHtml($this->direction_in_file_sub6->caption());

		// transmit_date_in_sub6
		$this->transmit_date_in_sub6->EditAttrs["class"] = "form-control";
		$this->transmit_date_in_sub6->EditCustomAttributes = "";
		$this->transmit_date_in_sub6->EditValue = FormatDateTime($this->transmit_date_in_sub6->CurrentValue, 8);
		$this->transmit_date_in_sub6->PlaceHolder = RemoveHtml($this->transmit_date_in_sub6->caption());

		// submit_no_sub7
		$this->submit_no_sub7->EditAttrs["class"] = "form-control";
		$this->submit_no_sub7->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->submit_no_sub7->CurrentValue = HtmlDecode($this->submit_no_sub7->CurrentValue);
		$this->submit_no_sub7->EditValue = $this->submit_no_sub7->CurrentValue;
		$this->submit_no_sub7->PlaceHolder = RemoveHtml($this->submit_no_sub7->caption());

		// revision_no_sub7
		$this->revision_no_sub7->EditAttrs["class"] = "form-control";
		$this->revision_no_sub7->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_sub7->CurrentValue = HtmlDecode($this->revision_no_sub7->CurrentValue);
		$this->revision_no_sub7->EditValue = $this->revision_no_sub7->CurrentValue;
		$this->revision_no_sub7->PlaceHolder = RemoveHtml($this->revision_no_sub7->caption());

		// direction_out_sub7
		$this->direction_out_sub7->EditAttrs["class"] = "form-control";
		$this->direction_out_sub7->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_sub7->CurrentValue = HtmlDecode($this->direction_out_sub7->CurrentValue);
		$this->direction_out_sub7->EditValue = $this->direction_out_sub7->CurrentValue;
		$this->direction_out_sub7->PlaceHolder = RemoveHtml($this->direction_out_sub7->caption());

		// planned_date_out_sub7
		$this->planned_date_out_sub7->EditAttrs["class"] = "form-control";
		$this->planned_date_out_sub7->EditCustomAttributes = "";
		$this->planned_date_out_sub7->EditValue = FormatDateTime($this->planned_date_out_sub7->CurrentValue, 8);
		$this->planned_date_out_sub7->PlaceHolder = RemoveHtml($this->planned_date_out_sub7->caption());

		// transmit_date_out_sub7
		$this->transmit_date_out_sub7->EditAttrs["class"] = "form-control";
		$this->transmit_date_out_sub7->EditCustomAttributes = "";
		$this->transmit_date_out_sub7->EditValue = FormatDateTime($this->transmit_date_out_sub7->CurrentValue, 8);
		$this->transmit_date_out_sub7->PlaceHolder = RemoveHtml($this->transmit_date_out_sub7->caption());

		// transmit_no_out_sub7
		$this->transmit_no_out_sub7->EditAttrs["class"] = "form-control";
		$this->transmit_no_out_sub7->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_out_sub7->CurrentValue = HtmlDecode($this->transmit_no_out_sub7->CurrentValue);
		$this->transmit_no_out_sub7->EditValue = $this->transmit_no_out_sub7->CurrentValue;
		$this->transmit_no_out_sub7->PlaceHolder = RemoveHtml($this->transmit_no_out_sub7->caption());

		// approval_status_out_sub7
		$this->approval_status_out_sub7->EditAttrs["class"] = "form-control";
		$this->approval_status_out_sub7->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_out_sub7->CurrentValue = HtmlDecode($this->approval_status_out_sub7->CurrentValue);
		$this->approval_status_out_sub7->EditValue = $this->approval_status_out_sub7->CurrentValue;
		$this->approval_status_out_sub7->PlaceHolder = RemoveHtml($this->approval_status_out_sub7->caption());

		// direction_out_file_sub7
		$this->direction_out_file_sub7->EditAttrs["class"] = "form-control";
		$this->direction_out_file_sub7->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_file_sub7->CurrentValue = HtmlDecode($this->direction_out_file_sub7->CurrentValue);
		$this->direction_out_file_sub7->EditValue = $this->direction_out_file_sub7->CurrentValue;
		$this->direction_out_file_sub7->PlaceHolder = RemoveHtml($this->direction_out_file_sub7->caption());

		// direction_in_sub7
		$this->direction_in_sub7->EditAttrs["class"] = "form-control";
		$this->direction_in_sub7->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_sub7->CurrentValue = HtmlDecode($this->direction_in_sub7->CurrentValue);
		$this->direction_in_sub7->EditValue = $this->direction_in_sub7->CurrentValue;
		$this->direction_in_sub7->PlaceHolder = RemoveHtml($this->direction_in_sub7->caption());

		// transmit_no_in_sub7
		$this->transmit_no_in_sub7->EditAttrs["class"] = "form-control";
		$this->transmit_no_in_sub7->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_in_sub7->CurrentValue = HtmlDecode($this->transmit_no_in_sub7->CurrentValue);
		$this->transmit_no_in_sub7->EditValue = $this->transmit_no_in_sub7->CurrentValue;
		$this->transmit_no_in_sub7->PlaceHolder = RemoveHtml($this->transmit_no_in_sub7->caption());

		// approval_status_in_sub7
		$this->approval_status_in_sub7->EditAttrs["class"] = "form-control";
		$this->approval_status_in_sub7->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_in_sub7->CurrentValue = HtmlDecode($this->approval_status_in_sub7->CurrentValue);
		$this->approval_status_in_sub7->EditValue = $this->approval_status_in_sub7->CurrentValue;
		$this->approval_status_in_sub7->PlaceHolder = RemoveHtml($this->approval_status_in_sub7->caption());

		// direction_in_file_sub7
		$this->direction_in_file_sub7->EditAttrs["class"] = "form-control";
		$this->direction_in_file_sub7->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_file_sub7->CurrentValue = HtmlDecode($this->direction_in_file_sub7->CurrentValue);
		$this->direction_in_file_sub7->EditValue = $this->direction_in_file_sub7->CurrentValue;
		$this->direction_in_file_sub7->PlaceHolder = RemoveHtml($this->direction_in_file_sub7->caption());

		// transmit_date_in_sub7
		$this->transmit_date_in_sub7->EditAttrs["class"] = "form-control";
		$this->transmit_date_in_sub7->EditCustomAttributes = "";
		$this->transmit_date_in_sub7->EditValue = FormatDateTime($this->transmit_date_in_sub7->CurrentValue, 8);
		$this->transmit_date_in_sub7->PlaceHolder = RemoveHtml($this->transmit_date_in_sub7->caption());

		// submit_no_sub8
		$this->submit_no_sub8->EditAttrs["class"] = "form-control";
		$this->submit_no_sub8->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->submit_no_sub8->CurrentValue = HtmlDecode($this->submit_no_sub8->CurrentValue);
		$this->submit_no_sub8->EditValue = $this->submit_no_sub8->CurrentValue;
		$this->submit_no_sub8->PlaceHolder = RemoveHtml($this->submit_no_sub8->caption());

		// revision_no_sub8
		$this->revision_no_sub8->EditAttrs["class"] = "form-control";
		$this->revision_no_sub8->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_sub8->CurrentValue = HtmlDecode($this->revision_no_sub8->CurrentValue);
		$this->revision_no_sub8->EditValue = $this->revision_no_sub8->CurrentValue;
		$this->revision_no_sub8->PlaceHolder = RemoveHtml($this->revision_no_sub8->caption());

		// direction_out_sub8
		$this->direction_out_sub8->EditAttrs["class"] = "form-control";
		$this->direction_out_sub8->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_sub8->CurrentValue = HtmlDecode($this->direction_out_sub8->CurrentValue);
		$this->direction_out_sub8->EditValue = $this->direction_out_sub8->CurrentValue;
		$this->direction_out_sub8->PlaceHolder = RemoveHtml($this->direction_out_sub8->caption());

		// planned_date_out_sub8
		$this->planned_date_out_sub8->EditAttrs["class"] = "form-control";
		$this->planned_date_out_sub8->EditCustomAttributes = "";
		$this->planned_date_out_sub8->EditValue = FormatDateTime($this->planned_date_out_sub8->CurrentValue, 8);
		$this->planned_date_out_sub8->PlaceHolder = RemoveHtml($this->planned_date_out_sub8->caption());

		// transmit_date_out_sub8
		$this->transmit_date_out_sub8->EditAttrs["class"] = "form-control";
		$this->transmit_date_out_sub8->EditCustomAttributes = "";
		$this->transmit_date_out_sub8->EditValue = FormatDateTime($this->transmit_date_out_sub8->CurrentValue, 8);
		$this->transmit_date_out_sub8->PlaceHolder = RemoveHtml($this->transmit_date_out_sub8->caption());

		// transmit_no_out_sub8
		$this->transmit_no_out_sub8->EditAttrs["class"] = "form-control";
		$this->transmit_no_out_sub8->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_out_sub8->CurrentValue = HtmlDecode($this->transmit_no_out_sub8->CurrentValue);
		$this->transmit_no_out_sub8->EditValue = $this->transmit_no_out_sub8->CurrentValue;
		$this->transmit_no_out_sub8->PlaceHolder = RemoveHtml($this->transmit_no_out_sub8->caption());

		// approval_status_out_sub8
		$this->approval_status_out_sub8->EditAttrs["class"] = "form-control";
		$this->approval_status_out_sub8->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_out_sub8->CurrentValue = HtmlDecode($this->approval_status_out_sub8->CurrentValue);
		$this->approval_status_out_sub8->EditValue = $this->approval_status_out_sub8->CurrentValue;
		$this->approval_status_out_sub8->PlaceHolder = RemoveHtml($this->approval_status_out_sub8->caption());

		// direction_out_file_sub8
		$this->direction_out_file_sub8->EditAttrs["class"] = "form-control";
		$this->direction_out_file_sub8->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_file_sub8->CurrentValue = HtmlDecode($this->direction_out_file_sub8->CurrentValue);
		$this->direction_out_file_sub8->EditValue = $this->direction_out_file_sub8->CurrentValue;
		$this->direction_out_file_sub8->PlaceHolder = RemoveHtml($this->direction_out_file_sub8->caption());

		// direction_in_sub8
		$this->direction_in_sub8->EditAttrs["class"] = "form-control";
		$this->direction_in_sub8->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_sub8->CurrentValue = HtmlDecode($this->direction_in_sub8->CurrentValue);
		$this->direction_in_sub8->EditValue = $this->direction_in_sub8->CurrentValue;
		$this->direction_in_sub8->PlaceHolder = RemoveHtml($this->direction_in_sub8->caption());

		// transmit_no_in_sub8
		$this->transmit_no_in_sub8->EditAttrs["class"] = "form-control";
		$this->transmit_no_in_sub8->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_in_sub8->CurrentValue = HtmlDecode($this->transmit_no_in_sub8->CurrentValue);
		$this->transmit_no_in_sub8->EditValue = $this->transmit_no_in_sub8->CurrentValue;
		$this->transmit_no_in_sub8->PlaceHolder = RemoveHtml($this->transmit_no_in_sub8->caption());

		// approval_status_in_sub8
		$this->approval_status_in_sub8->EditAttrs["class"] = "form-control";
		$this->approval_status_in_sub8->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_in_sub8->CurrentValue = HtmlDecode($this->approval_status_in_sub8->CurrentValue);
		$this->approval_status_in_sub8->EditValue = $this->approval_status_in_sub8->CurrentValue;
		$this->approval_status_in_sub8->PlaceHolder = RemoveHtml($this->approval_status_in_sub8->caption());

		// direction_in_file_sub8
		$this->direction_in_file_sub8->EditAttrs["class"] = "form-control";
		$this->direction_in_file_sub8->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_file_sub8->CurrentValue = HtmlDecode($this->direction_in_file_sub8->CurrentValue);
		$this->direction_in_file_sub8->EditValue = $this->direction_in_file_sub8->CurrentValue;
		$this->direction_in_file_sub8->PlaceHolder = RemoveHtml($this->direction_in_file_sub8->caption());

		// transmit_date_in_sub8
		$this->transmit_date_in_sub8->EditAttrs["class"] = "form-control";
		$this->transmit_date_in_sub8->EditCustomAttributes = "";
		$this->transmit_date_in_sub8->EditValue = FormatDateTime($this->transmit_date_in_sub8->CurrentValue, 8);
		$this->transmit_date_in_sub8->PlaceHolder = RemoveHtml($this->transmit_date_in_sub8->caption());

		// submit_no_sub9
		$this->submit_no_sub9->EditAttrs["class"] = "form-control";
		$this->submit_no_sub9->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->submit_no_sub9->CurrentValue = HtmlDecode($this->submit_no_sub9->CurrentValue);
		$this->submit_no_sub9->EditValue = $this->submit_no_sub9->CurrentValue;
		$this->submit_no_sub9->PlaceHolder = RemoveHtml($this->submit_no_sub9->caption());

		// revision_no_sub9
		$this->revision_no_sub9->EditAttrs["class"] = "form-control";
		$this->revision_no_sub9->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_sub9->CurrentValue = HtmlDecode($this->revision_no_sub9->CurrentValue);
		$this->revision_no_sub9->EditValue = $this->revision_no_sub9->CurrentValue;
		$this->revision_no_sub9->PlaceHolder = RemoveHtml($this->revision_no_sub9->caption());

		// direction_out_sub9
		$this->direction_out_sub9->EditAttrs["class"] = "form-control";
		$this->direction_out_sub9->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_sub9->CurrentValue = HtmlDecode($this->direction_out_sub9->CurrentValue);
		$this->direction_out_sub9->EditValue = $this->direction_out_sub9->CurrentValue;
		$this->direction_out_sub9->PlaceHolder = RemoveHtml($this->direction_out_sub9->caption());

		// planned_date_out_sub9
		$this->planned_date_out_sub9->EditAttrs["class"] = "form-control";
		$this->planned_date_out_sub9->EditCustomAttributes = "";
		$this->planned_date_out_sub9->EditValue = FormatDateTime($this->planned_date_out_sub9->CurrentValue, 8);
		$this->planned_date_out_sub9->PlaceHolder = RemoveHtml($this->planned_date_out_sub9->caption());

		// transmit_date_out_sub9
		$this->transmit_date_out_sub9->EditAttrs["class"] = "form-control";
		$this->transmit_date_out_sub9->EditCustomAttributes = "";
		$this->transmit_date_out_sub9->EditValue = FormatDateTime($this->transmit_date_out_sub9->CurrentValue, 8);
		$this->transmit_date_out_sub9->PlaceHolder = RemoveHtml($this->transmit_date_out_sub9->caption());

		// transmit_no_out_sub9
		$this->transmit_no_out_sub9->EditAttrs["class"] = "form-control";
		$this->transmit_no_out_sub9->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_out_sub9->CurrentValue = HtmlDecode($this->transmit_no_out_sub9->CurrentValue);
		$this->transmit_no_out_sub9->EditValue = $this->transmit_no_out_sub9->CurrentValue;
		$this->transmit_no_out_sub9->PlaceHolder = RemoveHtml($this->transmit_no_out_sub9->caption());

		// approval_status_out_sub9
		$this->approval_status_out_sub9->EditAttrs["class"] = "form-control";
		$this->approval_status_out_sub9->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_out_sub9->CurrentValue = HtmlDecode($this->approval_status_out_sub9->CurrentValue);
		$this->approval_status_out_sub9->EditValue = $this->approval_status_out_sub9->CurrentValue;
		$this->approval_status_out_sub9->PlaceHolder = RemoveHtml($this->approval_status_out_sub9->caption());

		// direction_out_file_sub9
		$this->direction_out_file_sub9->EditAttrs["class"] = "form-control";
		$this->direction_out_file_sub9->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_file_sub9->CurrentValue = HtmlDecode($this->direction_out_file_sub9->CurrentValue);
		$this->direction_out_file_sub9->EditValue = $this->direction_out_file_sub9->CurrentValue;
		$this->direction_out_file_sub9->PlaceHolder = RemoveHtml($this->direction_out_file_sub9->caption());

		// direction_in_sub9
		$this->direction_in_sub9->EditAttrs["class"] = "form-control";
		$this->direction_in_sub9->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_sub9->CurrentValue = HtmlDecode($this->direction_in_sub9->CurrentValue);
		$this->direction_in_sub9->EditValue = $this->direction_in_sub9->CurrentValue;
		$this->direction_in_sub9->PlaceHolder = RemoveHtml($this->direction_in_sub9->caption());

		// transmit_no_in_sub9
		$this->transmit_no_in_sub9->EditAttrs["class"] = "form-control";
		$this->transmit_no_in_sub9->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_in_sub9->CurrentValue = HtmlDecode($this->transmit_no_in_sub9->CurrentValue);
		$this->transmit_no_in_sub9->EditValue = $this->transmit_no_in_sub9->CurrentValue;
		$this->transmit_no_in_sub9->PlaceHolder = RemoveHtml($this->transmit_no_in_sub9->caption());

		// approval_status_in_sub9
		$this->approval_status_in_sub9->EditAttrs["class"] = "form-control";
		$this->approval_status_in_sub9->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_in_sub9->CurrentValue = HtmlDecode($this->approval_status_in_sub9->CurrentValue);
		$this->approval_status_in_sub9->EditValue = $this->approval_status_in_sub9->CurrentValue;
		$this->approval_status_in_sub9->PlaceHolder = RemoveHtml($this->approval_status_in_sub9->caption());

		// direction_in_file_sub9
		$this->direction_in_file_sub9->EditAttrs["class"] = "form-control";
		$this->direction_in_file_sub9->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_file_sub9->CurrentValue = HtmlDecode($this->direction_in_file_sub9->CurrentValue);
		$this->direction_in_file_sub9->EditValue = $this->direction_in_file_sub9->CurrentValue;
		$this->direction_in_file_sub9->PlaceHolder = RemoveHtml($this->direction_in_file_sub9->caption());

		// transmit_date_in_sub9
		$this->transmit_date_in_sub9->EditAttrs["class"] = "form-control";
		$this->transmit_date_in_sub9->EditCustomAttributes = "";
		$this->transmit_date_in_sub9->EditValue = FormatDateTime($this->transmit_date_in_sub9->CurrentValue, 8);
		$this->transmit_date_in_sub9->PlaceHolder = RemoveHtml($this->transmit_date_in_sub9->caption());

		// submit_no_sub10
		$this->submit_no_sub10->EditAttrs["class"] = "form-control";
		$this->submit_no_sub10->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->submit_no_sub10->CurrentValue = HtmlDecode($this->submit_no_sub10->CurrentValue);
		$this->submit_no_sub10->EditValue = $this->submit_no_sub10->CurrentValue;
		$this->submit_no_sub10->PlaceHolder = RemoveHtml($this->submit_no_sub10->caption());

		// revision_no_sub10
		$this->revision_no_sub10->EditAttrs["class"] = "form-control";
		$this->revision_no_sub10->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->revision_no_sub10->CurrentValue = HtmlDecode($this->revision_no_sub10->CurrentValue);
		$this->revision_no_sub10->EditValue = $this->revision_no_sub10->CurrentValue;
		$this->revision_no_sub10->PlaceHolder = RemoveHtml($this->revision_no_sub10->caption());

		// direction_out_sub10
		$this->direction_out_sub10->EditAttrs["class"] = "form-control";
		$this->direction_out_sub10->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_sub10->CurrentValue = HtmlDecode($this->direction_out_sub10->CurrentValue);
		$this->direction_out_sub10->EditValue = $this->direction_out_sub10->CurrentValue;
		$this->direction_out_sub10->PlaceHolder = RemoveHtml($this->direction_out_sub10->caption());

		// planned_date_out_sub10
		$this->planned_date_out_sub10->EditAttrs["class"] = "form-control";
		$this->planned_date_out_sub10->EditCustomAttributes = "";
		$this->planned_date_out_sub10->EditValue = FormatDateTime($this->planned_date_out_sub10->CurrentValue, 8);
		$this->planned_date_out_sub10->PlaceHolder = RemoveHtml($this->planned_date_out_sub10->caption());

		// transmit_date_out_sub10
		$this->transmit_date_out_sub10->EditAttrs["class"] = "form-control";
		$this->transmit_date_out_sub10->EditCustomAttributes = "";
		$this->transmit_date_out_sub10->EditValue = FormatDateTime($this->transmit_date_out_sub10->CurrentValue, 8);
		$this->transmit_date_out_sub10->PlaceHolder = RemoveHtml($this->transmit_date_out_sub10->caption());

		// transmit_no_out_sub10
		$this->transmit_no_out_sub10->EditAttrs["class"] = "form-control";
		$this->transmit_no_out_sub10->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_out_sub10->CurrentValue = HtmlDecode($this->transmit_no_out_sub10->CurrentValue);
		$this->transmit_no_out_sub10->EditValue = $this->transmit_no_out_sub10->CurrentValue;
		$this->transmit_no_out_sub10->PlaceHolder = RemoveHtml($this->transmit_no_out_sub10->caption());

		// approval_status_out_sub10
		$this->approval_status_out_sub10->EditAttrs["class"] = "form-control";
		$this->approval_status_out_sub10->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_out_sub10->CurrentValue = HtmlDecode($this->approval_status_out_sub10->CurrentValue);
		$this->approval_status_out_sub10->EditValue = $this->approval_status_out_sub10->CurrentValue;
		$this->approval_status_out_sub10->PlaceHolder = RemoveHtml($this->approval_status_out_sub10->caption());

		// direction_out_file_sub10
		$this->direction_out_file_sub10->EditAttrs["class"] = "form-control";
		$this->direction_out_file_sub10->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_out_file_sub10->CurrentValue = HtmlDecode($this->direction_out_file_sub10->CurrentValue);
		$this->direction_out_file_sub10->EditValue = $this->direction_out_file_sub10->CurrentValue;
		$this->direction_out_file_sub10->PlaceHolder = RemoveHtml($this->direction_out_file_sub10->caption());

		// direction_in_sub10
		$this->direction_in_sub10->EditAttrs["class"] = "form-control";
		$this->direction_in_sub10->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_sub10->CurrentValue = HtmlDecode($this->direction_in_sub10->CurrentValue);
		$this->direction_in_sub10->EditValue = $this->direction_in_sub10->CurrentValue;
		$this->direction_in_sub10->PlaceHolder = RemoveHtml($this->direction_in_sub10->caption());

		// transmit_no_in_sub10
		$this->transmit_no_in_sub10->EditAttrs["class"] = "form-control";
		$this->transmit_no_in_sub10->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->transmit_no_in_sub10->CurrentValue = HtmlDecode($this->transmit_no_in_sub10->CurrentValue);
		$this->transmit_no_in_sub10->EditValue = $this->transmit_no_in_sub10->CurrentValue;
		$this->transmit_no_in_sub10->PlaceHolder = RemoveHtml($this->transmit_no_in_sub10->caption());

		// approval_status_in_sub10
		$this->approval_status_in_sub10->EditAttrs["class"] = "form-control";
		$this->approval_status_in_sub10->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->approval_status_in_sub10->CurrentValue = HtmlDecode($this->approval_status_in_sub10->CurrentValue);
		$this->approval_status_in_sub10->EditValue = $this->approval_status_in_sub10->CurrentValue;
		$this->approval_status_in_sub10->PlaceHolder = RemoveHtml($this->approval_status_in_sub10->caption());

		// direction_in_file_sub10
		$this->direction_in_file_sub10->EditAttrs["class"] = "form-control";
		$this->direction_in_file_sub10->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direction_in_file_sub10->CurrentValue = HtmlDecode($this->direction_in_file_sub10->CurrentValue);
		$this->direction_in_file_sub10->EditValue = $this->direction_in_file_sub10->CurrentValue;
		$this->direction_in_file_sub10->PlaceHolder = RemoveHtml($this->direction_in_file_sub10->caption());

		// transmit_date_in_sub10
		$this->transmit_date_in_sub10->EditAttrs["class"] = "form-control";
		$this->transmit_date_in_sub10->EditCustomAttributes = "";
		$this->transmit_date_in_sub10->EditValue = FormatDateTime($this->transmit_date_in_sub10->CurrentValue, 8);
		$this->transmit_date_in_sub10->PlaceHolder = RemoveHtml($this->transmit_date_in_sub10->caption());

		// log_updatedon
		$this->log_updatedon->EditAttrs["class"] = "form-control";
		$this->log_updatedon->EditCustomAttributes = "";
		$this->log_updatedon->EditValue = FormatDateTime($this->log_updatedon->CurrentValue, 8);
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
					$doc->exportCaption($this->log_id);
					$doc->exportCaption($this->firelink_doc_no);
					$doc->exportCaption($this->project_name);
					$doc->exportCaption($this->document_tittle);
					$doc->exportCaption($this->current_status);
					$doc->exportCaption($this->submit_no_sub1);
					$doc->exportCaption($this->revision_no_sub1);
					$doc->exportCaption($this->direction_out_sub1);
					$doc->exportCaption($this->planned_date_out_sub1);
					$doc->exportCaption($this->transmit_date_out_sub1);
					$doc->exportCaption($this->transmit_no_out_sub1);
					$doc->exportCaption($this->approval_status_out_sub1);
					$doc->exportCaption($this->direction_out_file_sub1);
					$doc->exportCaption($this->direction_in_sub1);
					$doc->exportCaption($this->transmit_no_in_sub1);
					$doc->exportCaption($this->approval_status_in_sub1);
					$doc->exportCaption($this->transmit_date_in_sub1);
					$doc->exportCaption($this->submit_no_sub2);
					$doc->exportCaption($this->revision_no_sub2);
					$doc->exportCaption($this->direction_out_sub2);
					$doc->exportCaption($this->planned_date_out_sub2);
					$doc->exportCaption($this->transmit_date_out_sub2);
					$doc->exportCaption($this->transmit_no_out_sub2);
					$doc->exportCaption($this->approval_status_out_sub2);
					$doc->exportCaption($this->direction_in_sub2);
					$doc->exportCaption($this->transmit_no_in_sub2);
					$doc->exportCaption($this->approval_status_in_sub2);
					$doc->exportCaption($this->transmit_date_in_sub2);
					$doc->exportCaption($this->submit_no_sub3);
					$doc->exportCaption($this->revision_no_sub3);
					$doc->exportCaption($this->direction_out_sub3);
					$doc->exportCaption($this->planned_date_out_sub3);
					$doc->exportCaption($this->transmit_date_out_sub3);
					$doc->exportCaption($this->transmit_no_out_sub3);
					$doc->exportCaption($this->approval_status_out_sub3);
					$doc->exportCaption($this->direction_in_sub3);
					$doc->exportCaption($this->transmit_no_in_sub3);
					$doc->exportCaption($this->approval_status_in_sub3);
					$doc->exportCaption($this->transmit_date_in_sub3);
					$doc->exportCaption($this->submit_no_sub4);
					$doc->exportCaption($this->revision_no_sub4);
					$doc->exportCaption($this->direction_out_sub4);
					$doc->exportCaption($this->planned_date_out_sub4);
					$doc->exportCaption($this->transmit_date_out_sub4);
					$doc->exportCaption($this->transmit_no_out_sub4);
					$doc->exportCaption($this->approval_status_out_sub4);
					$doc->exportCaption($this->direction_in_sub4);
					$doc->exportCaption($this->transmit_no_in_sub4);
					$doc->exportCaption($this->approval_status_in_sub4);
					$doc->exportCaption($this->direction_in_file_sub4);
					$doc->exportCaption($this->transmit_date_in_sub4);
					$doc->exportCaption($this->submit_no_sub5);
					$doc->exportCaption($this->revision_no_sub5);
					$doc->exportCaption($this->direction_out_sub5);
					$doc->exportCaption($this->planned_date_out_sub5);
					$doc->exportCaption($this->transmit_date_out_sub5);
					$doc->exportCaption($this->transmit_no_out_sub5);
					$doc->exportCaption($this->approval_status_out_sub5);
					$doc->exportCaption($this->direction_in_sub5);
					$doc->exportCaption($this->transmit_no_in_sub5);
					$doc->exportCaption($this->approval_status_in_sub5);
					$doc->exportCaption($this->direction_in_file_sub5);
					$doc->exportCaption($this->transmit_date_in_sub5);
					$doc->exportCaption($this->submit_no_sub6);
					$doc->exportCaption($this->revision_no_sub6);
					$doc->exportCaption($this->direction_out_sub6);
					$doc->exportCaption($this->planned_date_out_sub6);
					$doc->exportCaption($this->transmit_date_out_sub6);
					$doc->exportCaption($this->transmit_no_out_sub6);
					$doc->exportCaption($this->approval_status_out_sub6);
					$doc->exportCaption($this->direction_in_sub6);
					$doc->exportCaption($this->transmit_no_in_sub6);
					$doc->exportCaption($this->approval_status_in_sub6);
					$doc->exportCaption($this->direction_in_file_sub6);
					$doc->exportCaption($this->transmit_date_in_sub6);
					$doc->exportCaption($this->submit_no_sub7);
					$doc->exportCaption($this->revision_no_sub7);
					$doc->exportCaption($this->direction_out_sub7);
					$doc->exportCaption($this->planned_date_out_sub7);
					$doc->exportCaption($this->transmit_date_out_sub7);
					$doc->exportCaption($this->transmit_no_out_sub7);
					$doc->exportCaption($this->approval_status_out_sub7);
					$doc->exportCaption($this->direction_in_sub7);
					$doc->exportCaption($this->transmit_no_in_sub7);
					$doc->exportCaption($this->approval_status_in_sub7);
					$doc->exportCaption($this->transmit_date_in_sub7);
					$doc->exportCaption($this->submit_no_sub8);
					$doc->exportCaption($this->revision_no_sub8);
					$doc->exportCaption($this->direction_out_sub8);
					$doc->exportCaption($this->planned_date_out_sub8);
					$doc->exportCaption($this->transmit_date_out_sub8);
					$doc->exportCaption($this->transmit_no_out_sub8);
					$doc->exportCaption($this->approval_status_out_sub8);
					$doc->exportCaption($this->direction_out_file_sub8);
					$doc->exportCaption($this->direction_in_sub8);
					$doc->exportCaption($this->transmit_no_in_sub8);
					$doc->exportCaption($this->approval_status_in_sub8);
					$doc->exportCaption($this->transmit_date_in_sub8);
					$doc->exportCaption($this->submit_no_sub9);
					$doc->exportCaption($this->revision_no_sub9);
					$doc->exportCaption($this->direction_out_sub9);
					$doc->exportCaption($this->planned_date_out_sub9);
					$doc->exportCaption($this->transmit_date_out_sub9);
					$doc->exportCaption($this->transmit_no_out_sub9);
					$doc->exportCaption($this->approval_status_out_sub9);
					$doc->exportCaption($this->direction_in_sub9);
					$doc->exportCaption($this->transmit_no_in_sub9);
					$doc->exportCaption($this->approval_status_in_sub9);
					$doc->exportCaption($this->transmit_date_in_sub9);
					$doc->exportCaption($this->submit_no_sub10);
					$doc->exportCaption($this->revision_no_sub10);
					$doc->exportCaption($this->direction_out_sub10);
					$doc->exportCaption($this->planned_date_out_sub10);
					$doc->exportCaption($this->transmit_date_out_sub10);
					$doc->exportCaption($this->transmit_no_out_sub10);
					$doc->exportCaption($this->approval_status_out_sub10);
					$doc->exportCaption($this->direction_in_sub10);
					$doc->exportCaption($this->transmit_no_in_sub10);
					$doc->exportCaption($this->approval_status_in_sub10);
					$doc->exportCaption($this->transmit_date_in_sub10);
					$doc->exportCaption($this->log_updatedon);
				} else {
					$doc->exportCaption($this->firelink_doc_no);
					$doc->exportCaption($this->project_name);
					$doc->exportCaption($this->document_tittle);
					$doc->exportCaption($this->current_status);
					$doc->exportCaption($this->submit_no_sub1);
					$doc->exportCaption($this->revision_no_sub1);
					$doc->exportCaption($this->direction_out_sub1);
					$doc->exportCaption($this->planned_date_out_sub1);
					$doc->exportCaption($this->transmit_date_out_sub1);
					$doc->exportCaption($this->transmit_no_out_sub1);
					$doc->exportCaption($this->approval_status_out_sub1);
					$doc->exportCaption($this->direction_out_file_sub1);
					$doc->exportCaption($this->direction_in_sub1);
					$doc->exportCaption($this->transmit_no_in_sub1);
					$doc->exportCaption($this->approval_status_in_sub1);
					$doc->exportCaption($this->transmit_date_in_sub1);
					$doc->exportCaption($this->submit_no_sub2);
					$doc->exportCaption($this->revision_no_sub2);
					$doc->exportCaption($this->direction_out_sub2);
					$doc->exportCaption($this->planned_date_out_sub2);
					$doc->exportCaption($this->transmit_date_out_sub2);
					$doc->exportCaption($this->transmit_no_out_sub2);
					$doc->exportCaption($this->approval_status_out_sub2);
					$doc->exportCaption($this->direction_in_sub2);
					$doc->exportCaption($this->transmit_no_in_sub2);
					$doc->exportCaption($this->approval_status_in_sub2);
					$doc->exportCaption($this->transmit_date_in_sub2);
					$doc->exportCaption($this->submit_no_sub3);
					$doc->exportCaption($this->revision_no_sub3);
					$doc->exportCaption($this->direction_out_sub3);
					$doc->exportCaption($this->planned_date_out_sub3);
					$doc->exportCaption($this->transmit_date_out_sub3);
					$doc->exportCaption($this->transmit_no_out_sub3);
					$doc->exportCaption($this->approval_status_out_sub3);
					$doc->exportCaption($this->direction_in_sub3);
					$doc->exportCaption($this->transmit_no_in_sub3);
					$doc->exportCaption($this->approval_status_in_sub3);
					$doc->exportCaption($this->transmit_date_in_sub3);
					$doc->exportCaption($this->submit_no_sub4);
					$doc->exportCaption($this->revision_no_sub4);
					$doc->exportCaption($this->direction_out_sub4);
					$doc->exportCaption($this->planned_date_out_sub4);
					$doc->exportCaption($this->transmit_date_out_sub4);
					$doc->exportCaption($this->transmit_no_out_sub4);
					$doc->exportCaption($this->approval_status_out_sub4);
					$doc->exportCaption($this->direction_in_sub4);
					$doc->exportCaption($this->transmit_no_in_sub4);
					$doc->exportCaption($this->approval_status_in_sub4);
					$doc->exportCaption($this->direction_in_file_sub4);
					$doc->exportCaption($this->transmit_date_in_sub4);
					$doc->exportCaption($this->submit_no_sub5);
					$doc->exportCaption($this->revision_no_sub5);
					$doc->exportCaption($this->direction_out_sub5);
					$doc->exportCaption($this->planned_date_out_sub5);
					$doc->exportCaption($this->transmit_date_out_sub5);
					$doc->exportCaption($this->transmit_no_out_sub5);
					$doc->exportCaption($this->approval_status_out_sub5);
					$doc->exportCaption($this->direction_in_sub5);
					$doc->exportCaption($this->transmit_no_in_sub5);
					$doc->exportCaption($this->approval_status_in_sub5);
					$doc->exportCaption($this->direction_in_file_sub5);
					$doc->exportCaption($this->transmit_date_in_sub5);
					$doc->exportCaption($this->submit_no_sub6);
					$doc->exportCaption($this->revision_no_sub6);
					$doc->exportCaption($this->direction_out_sub6);
					$doc->exportCaption($this->planned_date_out_sub6);
					$doc->exportCaption($this->transmit_date_out_sub6);
					$doc->exportCaption($this->transmit_no_out_sub6);
					$doc->exportCaption($this->approval_status_out_sub6);
					$doc->exportCaption($this->direction_in_sub6);
					$doc->exportCaption($this->transmit_no_in_sub6);
					$doc->exportCaption($this->approval_status_in_sub6);
					$doc->exportCaption($this->direction_in_file_sub6);
					$doc->exportCaption($this->transmit_date_in_sub6);
					$doc->exportCaption($this->submit_no_sub7);
					$doc->exportCaption($this->revision_no_sub7);
					$doc->exportCaption($this->direction_out_sub7);
					$doc->exportCaption($this->planned_date_out_sub7);
					$doc->exportCaption($this->transmit_date_out_sub7);
					$doc->exportCaption($this->transmit_no_out_sub7);
					$doc->exportCaption($this->approval_status_out_sub7);
					$doc->exportCaption($this->direction_in_sub7);
					$doc->exportCaption($this->transmit_no_in_sub7);
					$doc->exportCaption($this->approval_status_in_sub7);
					$doc->exportCaption($this->transmit_date_in_sub7);
					$doc->exportCaption($this->submit_no_sub8);
					$doc->exportCaption($this->revision_no_sub8);
					$doc->exportCaption($this->direction_out_sub8);
					$doc->exportCaption($this->planned_date_out_sub8);
					$doc->exportCaption($this->transmit_date_out_sub8);
					$doc->exportCaption($this->transmit_no_out_sub8);
					$doc->exportCaption($this->approval_status_out_sub8);
					$doc->exportCaption($this->direction_out_file_sub8);
					$doc->exportCaption($this->direction_in_sub8);
					$doc->exportCaption($this->transmit_no_in_sub8);
					$doc->exportCaption($this->approval_status_in_sub8);
					$doc->exportCaption($this->transmit_date_in_sub8);
					$doc->exportCaption($this->submit_no_sub9);
					$doc->exportCaption($this->revision_no_sub9);
					$doc->exportCaption($this->direction_out_sub9);
					$doc->exportCaption($this->planned_date_out_sub9);
					$doc->exportCaption($this->transmit_date_out_sub9);
					$doc->exportCaption($this->transmit_no_out_sub9);
					$doc->exportCaption($this->approval_status_out_sub9);
					$doc->exportCaption($this->direction_in_sub9);
					$doc->exportCaption($this->transmit_no_in_sub9);
					$doc->exportCaption($this->approval_status_in_sub9);
					$doc->exportCaption($this->transmit_date_in_sub9);
					$doc->exportCaption($this->submit_no_sub10);
					$doc->exportCaption($this->revision_no_sub10);
					$doc->exportCaption($this->direction_out_sub10);
					$doc->exportCaption($this->planned_date_out_sub10);
					$doc->exportCaption($this->transmit_date_out_sub10);
					$doc->exportCaption($this->transmit_no_out_sub10);
					$doc->exportCaption($this->approval_status_out_sub10);
					$doc->exportCaption($this->direction_in_sub10);
					$doc->exportCaption($this->transmit_no_in_sub10);
					$doc->exportCaption($this->approval_status_in_sub10);
					$doc->exportCaption($this->transmit_date_in_sub10);
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
						$doc->exportField($this->log_id);
						$doc->exportField($this->firelink_doc_no);
						$doc->exportField($this->project_name);
						$doc->exportField($this->document_tittle);
						$doc->exportField($this->current_status);
						$doc->exportField($this->submit_no_sub1);
						$doc->exportField($this->revision_no_sub1);
						$doc->exportField($this->direction_out_sub1);
						$doc->exportField($this->planned_date_out_sub1);
						$doc->exportField($this->transmit_date_out_sub1);
						$doc->exportField($this->transmit_no_out_sub1);
						$doc->exportField($this->approval_status_out_sub1);
						$doc->exportField($this->direction_out_file_sub1);
						$doc->exportField($this->direction_in_sub1);
						$doc->exportField($this->transmit_no_in_sub1);
						$doc->exportField($this->approval_status_in_sub1);
						$doc->exportField($this->transmit_date_in_sub1);
						$doc->exportField($this->submit_no_sub2);
						$doc->exportField($this->revision_no_sub2);
						$doc->exportField($this->direction_out_sub2);
						$doc->exportField($this->planned_date_out_sub2);
						$doc->exportField($this->transmit_date_out_sub2);
						$doc->exportField($this->transmit_no_out_sub2);
						$doc->exportField($this->approval_status_out_sub2);
						$doc->exportField($this->direction_in_sub2);
						$doc->exportField($this->transmit_no_in_sub2);
						$doc->exportField($this->approval_status_in_sub2);
						$doc->exportField($this->transmit_date_in_sub2);
						$doc->exportField($this->submit_no_sub3);
						$doc->exportField($this->revision_no_sub3);
						$doc->exportField($this->direction_out_sub3);
						$doc->exportField($this->planned_date_out_sub3);
						$doc->exportField($this->transmit_date_out_sub3);
						$doc->exportField($this->transmit_no_out_sub3);
						$doc->exportField($this->approval_status_out_sub3);
						$doc->exportField($this->direction_in_sub3);
						$doc->exportField($this->transmit_no_in_sub3);
						$doc->exportField($this->approval_status_in_sub3);
						$doc->exportField($this->transmit_date_in_sub3);
						$doc->exportField($this->submit_no_sub4);
						$doc->exportField($this->revision_no_sub4);
						$doc->exportField($this->direction_out_sub4);
						$doc->exportField($this->planned_date_out_sub4);
						$doc->exportField($this->transmit_date_out_sub4);
						$doc->exportField($this->transmit_no_out_sub4);
						$doc->exportField($this->approval_status_out_sub4);
						$doc->exportField($this->direction_in_sub4);
						$doc->exportField($this->transmit_no_in_sub4);
						$doc->exportField($this->approval_status_in_sub4);
						$doc->exportField($this->direction_in_file_sub4);
						$doc->exportField($this->transmit_date_in_sub4);
						$doc->exportField($this->submit_no_sub5);
						$doc->exportField($this->revision_no_sub5);
						$doc->exportField($this->direction_out_sub5);
						$doc->exportField($this->planned_date_out_sub5);
						$doc->exportField($this->transmit_date_out_sub5);
						$doc->exportField($this->transmit_no_out_sub5);
						$doc->exportField($this->approval_status_out_sub5);
						$doc->exportField($this->direction_in_sub5);
						$doc->exportField($this->transmit_no_in_sub5);
						$doc->exportField($this->approval_status_in_sub5);
						$doc->exportField($this->direction_in_file_sub5);
						$doc->exportField($this->transmit_date_in_sub5);
						$doc->exportField($this->submit_no_sub6);
						$doc->exportField($this->revision_no_sub6);
						$doc->exportField($this->direction_out_sub6);
						$doc->exportField($this->planned_date_out_sub6);
						$doc->exportField($this->transmit_date_out_sub6);
						$doc->exportField($this->transmit_no_out_sub6);
						$doc->exportField($this->approval_status_out_sub6);
						$doc->exportField($this->direction_in_sub6);
						$doc->exportField($this->transmit_no_in_sub6);
						$doc->exportField($this->approval_status_in_sub6);
						$doc->exportField($this->direction_in_file_sub6);
						$doc->exportField($this->transmit_date_in_sub6);
						$doc->exportField($this->submit_no_sub7);
						$doc->exportField($this->revision_no_sub7);
						$doc->exportField($this->direction_out_sub7);
						$doc->exportField($this->planned_date_out_sub7);
						$doc->exportField($this->transmit_date_out_sub7);
						$doc->exportField($this->transmit_no_out_sub7);
						$doc->exportField($this->approval_status_out_sub7);
						$doc->exportField($this->direction_in_sub7);
						$doc->exportField($this->transmit_no_in_sub7);
						$doc->exportField($this->approval_status_in_sub7);
						$doc->exportField($this->transmit_date_in_sub7);
						$doc->exportField($this->submit_no_sub8);
						$doc->exportField($this->revision_no_sub8);
						$doc->exportField($this->direction_out_sub8);
						$doc->exportField($this->planned_date_out_sub8);
						$doc->exportField($this->transmit_date_out_sub8);
						$doc->exportField($this->transmit_no_out_sub8);
						$doc->exportField($this->approval_status_out_sub8);
						$doc->exportField($this->direction_out_file_sub8);
						$doc->exportField($this->direction_in_sub8);
						$doc->exportField($this->transmit_no_in_sub8);
						$doc->exportField($this->approval_status_in_sub8);
						$doc->exportField($this->transmit_date_in_sub8);
						$doc->exportField($this->submit_no_sub9);
						$doc->exportField($this->revision_no_sub9);
						$doc->exportField($this->direction_out_sub9);
						$doc->exportField($this->planned_date_out_sub9);
						$doc->exportField($this->transmit_date_out_sub9);
						$doc->exportField($this->transmit_no_out_sub9);
						$doc->exportField($this->approval_status_out_sub9);
						$doc->exportField($this->direction_in_sub9);
						$doc->exportField($this->transmit_no_in_sub9);
						$doc->exportField($this->approval_status_in_sub9);
						$doc->exportField($this->transmit_date_in_sub9);
						$doc->exportField($this->submit_no_sub10);
						$doc->exportField($this->revision_no_sub10);
						$doc->exportField($this->direction_out_sub10);
						$doc->exportField($this->planned_date_out_sub10);
						$doc->exportField($this->transmit_date_out_sub10);
						$doc->exportField($this->transmit_no_out_sub10);
						$doc->exportField($this->approval_status_out_sub10);
						$doc->exportField($this->direction_in_sub10);
						$doc->exportField($this->transmit_no_in_sub10);
						$doc->exportField($this->approval_status_in_sub10);
						$doc->exportField($this->transmit_date_in_sub10);
						$doc->exportField($this->log_updatedon);
					} else {
						$doc->exportField($this->firelink_doc_no);
						$doc->exportField($this->project_name);
						$doc->exportField($this->document_tittle);
						$doc->exportField($this->current_status);
						$doc->exportField($this->submit_no_sub1);
						$doc->exportField($this->revision_no_sub1);
						$doc->exportField($this->direction_out_sub1);
						$doc->exportField($this->planned_date_out_sub1);
						$doc->exportField($this->transmit_date_out_sub1);
						$doc->exportField($this->transmit_no_out_sub1);
						$doc->exportField($this->approval_status_out_sub1);
						$doc->exportField($this->direction_out_file_sub1);
						$doc->exportField($this->direction_in_sub1);
						$doc->exportField($this->transmit_no_in_sub1);
						$doc->exportField($this->approval_status_in_sub1);
						$doc->exportField($this->transmit_date_in_sub1);
						$doc->exportField($this->submit_no_sub2);
						$doc->exportField($this->revision_no_sub2);
						$doc->exportField($this->direction_out_sub2);
						$doc->exportField($this->planned_date_out_sub2);
						$doc->exportField($this->transmit_date_out_sub2);
						$doc->exportField($this->transmit_no_out_sub2);
						$doc->exportField($this->approval_status_out_sub2);
						$doc->exportField($this->direction_in_sub2);
						$doc->exportField($this->transmit_no_in_sub2);
						$doc->exportField($this->approval_status_in_sub2);
						$doc->exportField($this->transmit_date_in_sub2);
						$doc->exportField($this->submit_no_sub3);
						$doc->exportField($this->revision_no_sub3);
						$doc->exportField($this->direction_out_sub3);
						$doc->exportField($this->planned_date_out_sub3);
						$doc->exportField($this->transmit_date_out_sub3);
						$doc->exportField($this->transmit_no_out_sub3);
						$doc->exportField($this->approval_status_out_sub3);
						$doc->exportField($this->direction_in_sub3);
						$doc->exportField($this->transmit_no_in_sub3);
						$doc->exportField($this->approval_status_in_sub3);
						$doc->exportField($this->transmit_date_in_sub3);
						$doc->exportField($this->submit_no_sub4);
						$doc->exportField($this->revision_no_sub4);
						$doc->exportField($this->direction_out_sub4);
						$doc->exportField($this->planned_date_out_sub4);
						$doc->exportField($this->transmit_date_out_sub4);
						$doc->exportField($this->transmit_no_out_sub4);
						$doc->exportField($this->approval_status_out_sub4);
						$doc->exportField($this->direction_in_sub4);
						$doc->exportField($this->transmit_no_in_sub4);
						$doc->exportField($this->approval_status_in_sub4);
						$doc->exportField($this->direction_in_file_sub4);
						$doc->exportField($this->transmit_date_in_sub4);
						$doc->exportField($this->submit_no_sub5);
						$doc->exportField($this->revision_no_sub5);
						$doc->exportField($this->direction_out_sub5);
						$doc->exportField($this->planned_date_out_sub5);
						$doc->exportField($this->transmit_date_out_sub5);
						$doc->exportField($this->transmit_no_out_sub5);
						$doc->exportField($this->approval_status_out_sub5);
						$doc->exportField($this->direction_in_sub5);
						$doc->exportField($this->transmit_no_in_sub5);
						$doc->exportField($this->approval_status_in_sub5);
						$doc->exportField($this->direction_in_file_sub5);
						$doc->exportField($this->transmit_date_in_sub5);
						$doc->exportField($this->submit_no_sub6);
						$doc->exportField($this->revision_no_sub6);
						$doc->exportField($this->direction_out_sub6);
						$doc->exportField($this->planned_date_out_sub6);
						$doc->exportField($this->transmit_date_out_sub6);
						$doc->exportField($this->transmit_no_out_sub6);
						$doc->exportField($this->approval_status_out_sub6);
						$doc->exportField($this->direction_in_sub6);
						$doc->exportField($this->transmit_no_in_sub6);
						$doc->exportField($this->approval_status_in_sub6);
						$doc->exportField($this->direction_in_file_sub6);
						$doc->exportField($this->transmit_date_in_sub6);
						$doc->exportField($this->submit_no_sub7);
						$doc->exportField($this->revision_no_sub7);
						$doc->exportField($this->direction_out_sub7);
						$doc->exportField($this->planned_date_out_sub7);
						$doc->exportField($this->transmit_date_out_sub7);
						$doc->exportField($this->transmit_no_out_sub7);
						$doc->exportField($this->approval_status_out_sub7);
						$doc->exportField($this->direction_in_sub7);
						$doc->exportField($this->transmit_no_in_sub7);
						$doc->exportField($this->approval_status_in_sub7);
						$doc->exportField($this->transmit_date_in_sub7);
						$doc->exportField($this->submit_no_sub8);
						$doc->exportField($this->revision_no_sub8);
						$doc->exportField($this->direction_out_sub8);
						$doc->exportField($this->planned_date_out_sub8);
						$doc->exportField($this->transmit_date_out_sub8);
						$doc->exportField($this->transmit_no_out_sub8);
						$doc->exportField($this->approval_status_out_sub8);
						$doc->exportField($this->direction_out_file_sub8);
						$doc->exportField($this->direction_in_sub8);
						$doc->exportField($this->transmit_no_in_sub8);
						$doc->exportField($this->approval_status_in_sub8);
						$doc->exportField($this->transmit_date_in_sub8);
						$doc->exportField($this->submit_no_sub9);
						$doc->exportField($this->revision_no_sub9);
						$doc->exportField($this->direction_out_sub9);
						$doc->exportField($this->planned_date_out_sub9);
						$doc->exportField($this->transmit_date_out_sub9);
						$doc->exportField($this->transmit_no_out_sub9);
						$doc->exportField($this->approval_status_out_sub9);
						$doc->exportField($this->direction_in_sub9);
						$doc->exportField($this->transmit_no_in_sub9);
						$doc->exportField($this->approval_status_in_sub9);
						$doc->exportField($this->transmit_date_in_sub9);
						$doc->exportField($this->submit_no_sub10);
						$doc->exportField($this->revision_no_sub10);
						$doc->exportField($this->direction_out_sub10);
						$doc->exportField($this->planned_date_out_sub10);
						$doc->exportField($this->transmit_date_out_sub10);
						$doc->exportField($this->transmit_no_out_sub10);
						$doc->exportField($this->approval_status_out_sub10);
						$doc->exportField($this->direction_in_sub10);
						$doc->exportField($this->transmit_no_in_sub10);
						$doc->exportField($this->approval_status_in_sub10);
						$doc->exportField($this->transmit_date_in_sub10);
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