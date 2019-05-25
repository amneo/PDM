<?php
namespace PHPMaker2019\pdm;

/**
 * Page class
 */
class document_log_list extends document_log
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{vishal-pdm}";

	// Table name
	public $TableName = 'document_log';

	// Page object name
	public $PageObjName = "document_log_list";

	// Grid form hidden field names
	public $FormName = "fdocument_loglist";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;
	public $CancelUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Page URL
	private $_pageUrl = "";

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		if ($this->_pageUrl == "") {
			$this->_pageUrl = CurrentPageName() . "?";
			if ($this->UseTokenInUrl)
				$this->_pageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		}
		return $this->_pageUrl;
	}

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = array();

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message <> "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage <> "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage <> "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage <> "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = PROJECT_NAMESPACE . CREATE_TOKEN_FUNC; // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $COMPOSITE_KEY_SEPARATOR;
		global $UserTable, $UserTableConn;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (document_log)
		if (!isset($GLOBALS["document_log"]) || get_class($GLOBALS["document_log"]) == PROJECT_NAMESPACE . "document_log") {
			$GLOBALS["document_log"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["document_log"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->AddUrl = "document_logadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "document_logdelete.php";
		$this->MultiUpdateUrl = "document_logupdate.php";
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'document_log');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &$this->getConnection();

		// User table object (users)
		if (!isset($UserTable)) {
			$UserTable = new users();
			$UserTableConn = Conn($UserTable->Dbid);
		}

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new ListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions();
		$this->ImportOptions->Tag = "div";
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions();
		$this->OtherOptions["addedit"]->Tag = "div";
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions();
		$this->OtherOptions["detail"]->Tag = "div";
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions();
		$this->OtherOptions["action"]->Tag = "div";
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ew-filter-option fdocument_loglistsrch";

		// List actions
		$this->ListActions = new ListActions();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT, $document_log;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($document_log);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = array();
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = array();
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {

								//$url = FullUrl($fld->TableVar . "/" . API_FILE_ACTION . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))); // URL rewrite format
								$url = FullUrl(GetPageName(API_URL) . "?" . API_OBJECT_NAME . "=" . $fld->TableVar . "&" . API_ACTION_NAME . "=" . API_FILE_ACTION . "&" . API_FIELD_NAME . "=" . $fld->Param . "&" . API_KEY_NAME . "=" . rawurlencode($this->getRecordKeyValue($ar))); // Query string format
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, MULTIPLE_UPLOAD_SEPARATOR)) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['log_id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->log_id->Visible = FALSE;
	}

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $DisplayRecs = 10;
	public $StartRec;
	public $StopRec;
	public $TotalRecs = 0;
	public $RecRange = 10;
	public $Pager;
	public $AutoHidePager = AUTO_HIDE_PAGER;
	public $AutoHidePageSizeSelector = AUTO_HIDE_PAGE_SIZE_SELECTOR;
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $RecCnt = 0; // Record count
	public $EditRowCnt;
	public $StartRowCnt = 1;
	public $RowCnt = 0;
	public $Attrs = array(); // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SearchError, $EXPORT;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// User profile
		$UserProfile = new UserProfile();

		// Security
		$Security = new AdvancedSecurity();
		$validRequest = FALSE;

		// Check security for API request
		If (IsApi()) {

			// Check token first
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Post(TOKEN_NAME) !== NULL)
				$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			elseif (is_array($RequestSecurity) && @$RequestSecurity["username"] <> "") // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
		}
		if (!$validRequest) {
			if (IsPasswordExpired())
				$this->terminate(GetUrl("changepwd.php"));
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Update last accessed time
		if ($UserProfile->isValidUser(CurrentUserName(), session_id())) {
		} else {
			Write($Language->phrase("UserProfileCorrupted"));
			$this->terminate();
		}

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		} elseif (IsPost()) {
			if (Post("exporttype") !== NULL)
				$this->Export = Post("exporttype");
			$custom = Post("custom", "");
		} elseif (Get("cmd") == "json") {
			$this->Export = Get("cmd");
		} else {
			$this->setExportReturnUrl(CurrentUrl());
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->isExport() && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined(PROJECT_NAMESPACE . "USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined(PROJECT_NAMESPACE . "USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(TABLE_GRID_ADD_ROW_COUNT, "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();

		// Setup export options
		$this->setupExportOptions();
		$this->log_id->Visible = FALSE;
		$this->firelink_doc_no->setVisibility();
		$this->client_doc_no->setVisibility();
		$this->order_number->setVisibility();
		$this->project_name->setVisibility();
		$this->document_tittle->setVisibility();
		$this->current_status->setVisibility();
		$this->current_status_file->Visible = FALSE;
		$this->submit_no_1->setVisibility();
		$this->revision_no_1->setVisibility();
		$this->direction_1->setVisibility();
		$this->planned_date_1->setVisibility();
		$this->transmit_date_1->setVisibility();
		$this->transmit_no_1->setVisibility();
		$this->approval_status_1->setVisibility();
		$this->direction_file_1->Visible = FALSE;
		$this->submit_no_2->setVisibility();
		$this->revision_no_2->setVisibility();
		$this->direction_2->setVisibility();
		$this->planned_date_2->setVisibility();
		$this->transmit_date_2->setVisibility();
		$this->transmit_no_2->setVisibility();
		$this->approval_status_2->setVisibility();
		$this->direction_file_2->Visible = FALSE;
		$this->submit_no_3->setVisibility();
		$this->revision_no_3->setVisibility();
		$this->direction_3->setVisibility();
		$this->planned_date_3->setVisibility();
		$this->transmit_date_3->setVisibility();
		$this->transmit_no_3->setVisibility();
		$this->approval_status_3->setVisibility();
		$this->direction_file_3->Visible = FALSE;
		$this->submit_no_4->setVisibility();
		$this->revision_no_4->setVisibility();
		$this->direction_4->setVisibility();
		$this->planned_date_4->setVisibility();
		$this->transmit_date_4->setVisibility();
		$this->transmit_no_4->setVisibility();
		$this->approval_status_4->setVisibility();
		$this->direction_file_4->Visible = FALSE;
		$this->submit_no_5->setVisibility();
		$this->revision_no_5->setVisibility();
		$this->direction_5->setVisibility();
		$this->planned_date_5->setVisibility();
		$this->transmit_date_5->setVisibility();
		$this->transmit_no_5->setVisibility();
		$this->approval_status_5->setVisibility();
		$this->direction_file_5->Visible = FALSE;
		$this->submit_no_6->setVisibility();
		$this->revision_no_6->setVisibility();
		$this->direction_6->setVisibility();
		$this->planned_date_6->setVisibility();
		$this->transmit_date_6->setVisibility();
		$this->transmit_no_6->setVisibility();
		$this->approval_status_6->setVisibility();
		$this->direction_file_6->Visible = FALSE;
		$this->submit_no_7->setVisibility();
		$this->revision_no_7->setVisibility();
		$this->direction_7->setVisibility();
		$this->planned_date_7->setVisibility();
		$this->transmit_date_7->setVisibility();
		$this->transmit_no_7->setVisibility();
		$this->approval_status_7->setVisibility();
		$this->direction_file_7->Visible = FALSE;
		$this->submit_no_8->setVisibility();
		$this->revision_no_8->setVisibility();
		$this->direction_8->setVisibility();
		$this->planned_date_8->setVisibility();
		$this->transmit_date_8->setVisibility();
		$this->transmit_no_8->setVisibility();
		$this->approval_status_8->setVisibility();
		$this->direction_file_8->Visible = FALSE;
		$this->submit_no_9->setVisibility();
		$this->revision_no_9->setVisibility();
		$this->direction_9->setVisibility();
		$this->planned_date_9->setVisibility();
		$this->transmit_date_9->setVisibility();
		$this->transmit_no_9->setVisibility();
		$this->approval_status_9->setVisibility();
		$this->direction_file_9->Visible = FALSE;
		$this->submit_no_10->setVisibility();
		$this->revision_no_10->setVisibility();
		$this->direction_10->setVisibility();
		$this->planned_date_10->setVisibility();
		$this->transmit_date_10->setVisibility();
		$this->transmit_no_10->setVisibility();
		$this->approval_status_10->setVisibility();
		$this->direction_file_10->Visible = FALSE;
		$this->log_updatedon->setVisibility();
		$this->hideFieldsForAddEdit();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Setup other options
		$this->setupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		$this->setupLookupOptions($this->approval_status_1);
		$this->setupLookupOptions($this->approval_status_2);
		$this->setupLookupOptions($this->approval_status_3);
		$this->setupLookupOptions($this->approval_status_4);
		$this->setupLookupOptions($this->approval_status_5);
		$this->setupLookupOptions($this->approval_status_6);
		$this->setupLookupOptions($this->approval_status_7);
		$this->setupLookupOptions($this->approval_status_8);
		$this->setupLookupOptions($this->approval_status_9);
		$this->setupLookupOptions($this->approval_status_10);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport())
				$this->OtherOptions->hideAllOptions();

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->Command <> "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();
		}

		// Restore display records
		if ($this->Command <> "json" && $this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 10; // Load default
		}

		// Load Sorting Order
		if ($this->Command <> "json")
			$this->loadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();
		}

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->Command <> "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}

		// Export data only
		if (!$this->CustomExport && in_array($this->Export, array_keys($EXPORT))) {
			$this->exportData();
			$this->terminate();
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRec = 1;
			$this->DisplayRecs = $this->GridAddRowCount;
			$this->TotalRecs = $this->DisplayRecs;
			$this->StopRec = $this->DisplayRecs;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecs = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
			$this->StartRec = 1;
			if ($this->DisplayRecs <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecs = $this->TotalRecs;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRec();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRec - 1, $this->DisplayRecs);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecs == 0) {
				if (!$Security->canList())
					$this->setWarningMessage(DeniedMessage());
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->phrase("NoRecord"));
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecs]);
			$this->terminate(TRUE);
		}
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey <> "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter <> "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode($GLOBALS["COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arKeyFlds) >= 1) {
			$this->log_id->setFormValue($arKeyFlds[0]);
			if (!is_numeric($this->log_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";

		// Load server side filters
		if (SEARCH_FILTER_OPTION == "Server" && isset($UserProfile))
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fdocument_loglistsrch");
		$filterList = Concat($filterList, $this->firelink_doc_no->AdvancedSearch->toJson(), ","); // Field firelink_doc_no
		$filterList = Concat($filterList, $this->client_doc_no->AdvancedSearch->toJson(), ","); // Field client_doc_no
		$filterList = Concat($filterList, $this->order_number->AdvancedSearch->toJson(), ","); // Field order_number
		$filterList = Concat($filterList, $this->project_name->AdvancedSearch->toJson(), ","); // Field project_name
		$filterList = Concat($filterList, $this->document_tittle->AdvancedSearch->toJson(), ","); // Field document_tittle
		$filterList = Concat($filterList, $this->current_status->AdvancedSearch->toJson(), ","); // Field current_status
		$filterList = Concat($filterList, $this->submit_no_1->AdvancedSearch->toJson(), ","); // Field submit_no_1
		$filterList = Concat($filterList, $this->revision_no_1->AdvancedSearch->toJson(), ","); // Field revision_no_1
		$filterList = Concat($filterList, $this->direction_1->AdvancedSearch->toJson(), ","); // Field direction_1
		$filterList = Concat($filterList, $this->transmit_no_1->AdvancedSearch->toJson(), ","); // Field transmit_no_1
		$filterList = Concat($filterList, $this->approval_status_1->AdvancedSearch->toJson(), ","); // Field approval_status_1
		$filterList = Concat($filterList, $this->submit_no_2->AdvancedSearch->toJson(), ","); // Field submit_no_2
		$filterList = Concat($filterList, $this->revision_no_2->AdvancedSearch->toJson(), ","); // Field revision_no_2
		$filterList = Concat($filterList, $this->direction_2->AdvancedSearch->toJson(), ","); // Field direction_2
		$filterList = Concat($filterList, $this->planned_date_2->AdvancedSearch->toJson(), ","); // Field planned_date_2
		$filterList = Concat($filterList, $this->transmit_date_2->AdvancedSearch->toJson(), ","); // Field transmit_date_2
		$filterList = Concat($filterList, $this->transmit_no_2->AdvancedSearch->toJson(), ","); // Field transmit_no_2
		$filterList = Concat($filterList, $this->approval_status_2->AdvancedSearch->toJson(), ","); // Field approval_status_2
		$filterList = Concat($filterList, $this->submit_no_3->AdvancedSearch->toJson(), ","); // Field submit_no_3
		$filterList = Concat($filterList, $this->revision_no_3->AdvancedSearch->toJson(), ","); // Field revision_no_3
		$filterList = Concat($filterList, $this->direction_3->AdvancedSearch->toJson(), ","); // Field direction_3
		$filterList = Concat($filterList, $this->transmit_no_3->AdvancedSearch->toJson(), ","); // Field transmit_no_3
		$filterList = Concat($filterList, $this->approval_status_3->AdvancedSearch->toJson(), ","); // Field approval_status_3
		$filterList = Concat($filterList, $this->submit_no_4->AdvancedSearch->toJson(), ","); // Field submit_no_4
		$filterList = Concat($filterList, $this->revision_no_4->AdvancedSearch->toJson(), ","); // Field revision_no_4
		$filterList = Concat($filterList, $this->direction_4->AdvancedSearch->toJson(), ","); // Field direction_4
		$filterList = Concat($filterList, $this->planned_date_4->AdvancedSearch->toJson(), ","); // Field planned_date_4
		$filterList = Concat($filterList, $this->transmit_date_4->AdvancedSearch->toJson(), ","); // Field transmit_date_4
		$filterList = Concat($filterList, $this->transmit_no_4->AdvancedSearch->toJson(), ","); // Field transmit_no_4
		$filterList = Concat($filterList, $this->approval_status_4->AdvancedSearch->toJson(), ","); // Field approval_status_4
		$filterList = Concat($filterList, $this->direction_file_4->AdvancedSearch->toJson(), ","); // Field direction_file_4
		$filterList = Concat($filterList, $this->submit_no_5->AdvancedSearch->toJson(), ","); // Field submit_no_5
		$filterList = Concat($filterList, $this->revision_no_5->AdvancedSearch->toJson(), ","); // Field revision_no_5
		$filterList = Concat($filterList, $this->direction_5->AdvancedSearch->toJson(), ","); // Field direction_5
		$filterList = Concat($filterList, $this->planned_date_5->AdvancedSearch->toJson(), ","); // Field planned_date_5
		$filterList = Concat($filterList, $this->transmit_date_5->AdvancedSearch->toJson(), ","); // Field transmit_date_5
		$filterList = Concat($filterList, $this->transmit_no_5->AdvancedSearch->toJson(), ","); // Field transmit_no_5
		$filterList = Concat($filterList, $this->approval_status_5->AdvancedSearch->toJson(), ","); // Field approval_status_5
		$filterList = Concat($filterList, $this->direction_file_5->AdvancedSearch->toJson(), ","); // Field direction_file_5
		$filterList = Concat($filterList, $this->submit_no_6->AdvancedSearch->toJson(), ","); // Field submit_no_6
		$filterList = Concat($filterList, $this->revision_no_6->AdvancedSearch->toJson(), ","); // Field revision_no_6
		$filterList = Concat($filterList, $this->direction_6->AdvancedSearch->toJson(), ","); // Field direction_6
		$filterList = Concat($filterList, $this->planned_date_6->AdvancedSearch->toJson(), ","); // Field planned_date_6
		$filterList = Concat($filterList, $this->transmit_date_6->AdvancedSearch->toJson(), ","); // Field transmit_date_6
		$filterList = Concat($filterList, $this->transmit_no_6->AdvancedSearch->toJson(), ","); // Field transmit_no_6
		$filterList = Concat($filterList, $this->approval_status_6->AdvancedSearch->toJson(), ","); // Field approval_status_6
		$filterList = Concat($filterList, $this->direction_file_6->AdvancedSearch->toJson(), ","); // Field direction_file_6
		$filterList = Concat($filterList, $this->submit_no_7->AdvancedSearch->toJson(), ","); // Field submit_no_7
		$filterList = Concat($filterList, $this->revision_no_7->AdvancedSearch->toJson(), ","); // Field revision_no_7
		$filterList = Concat($filterList, $this->direction_7->AdvancedSearch->toJson(), ","); // Field direction_7
		$filterList = Concat($filterList, $this->planned_date_7->AdvancedSearch->toJson(), ","); // Field planned_date_7
		$filterList = Concat($filterList, $this->transmit_date_7->AdvancedSearch->toJson(), ","); // Field transmit_date_7
		$filterList = Concat($filterList, $this->transmit_no_7->AdvancedSearch->toJson(), ","); // Field transmit_no_7
		$filterList = Concat($filterList, $this->approval_status_7->AdvancedSearch->toJson(), ","); // Field approval_status_7
		$filterList = Concat($filterList, $this->direction_file_7->AdvancedSearch->toJson(), ","); // Field direction_file_7
		$filterList = Concat($filterList, $this->submit_no_8->AdvancedSearch->toJson(), ","); // Field submit_no_8
		$filterList = Concat($filterList, $this->revision_no_8->AdvancedSearch->toJson(), ","); // Field revision_no_8
		$filterList = Concat($filterList, $this->direction_8->AdvancedSearch->toJson(), ","); // Field direction_8
		$filterList = Concat($filterList, $this->planned_date_8->AdvancedSearch->toJson(), ","); // Field planned_date_8
		$filterList = Concat($filterList, $this->transmit_date_8->AdvancedSearch->toJson(), ","); // Field transmit_date_8
		$filterList = Concat($filterList, $this->transmit_no_8->AdvancedSearch->toJson(), ","); // Field transmit_no_8
		$filterList = Concat($filterList, $this->approval_status_8->AdvancedSearch->toJson(), ","); // Field approval_status_8
		$filterList = Concat($filterList, $this->direction_file_8->AdvancedSearch->toJson(), ","); // Field direction_file_8
		$filterList = Concat($filterList, $this->submit_no_9->AdvancedSearch->toJson(), ","); // Field submit_no_9
		$filterList = Concat($filterList, $this->revision_no_9->AdvancedSearch->toJson(), ","); // Field revision_no_9
		$filterList = Concat($filterList, $this->direction_9->AdvancedSearch->toJson(), ","); // Field direction_9
		$filterList = Concat($filterList, $this->planned_date_9->AdvancedSearch->toJson(), ","); // Field planned_date_9
		$filterList = Concat($filterList, $this->transmit_date_9->AdvancedSearch->toJson(), ","); // Field transmit_date_9
		$filterList = Concat($filterList, $this->transmit_no_9->AdvancedSearch->toJson(), ","); // Field transmit_no_9
		$filterList = Concat($filterList, $this->approval_status_9->AdvancedSearch->toJson(), ","); // Field approval_status_9
		$filterList = Concat($filterList, $this->submit_no_10->AdvancedSearch->toJson(), ","); // Field submit_no_10
		$filterList = Concat($filterList, $this->revision_no_10->AdvancedSearch->toJson(), ","); // Field revision_no_10
		$filterList = Concat($filterList, $this->direction_10->AdvancedSearch->toJson(), ","); // Field direction_10
		$filterList = Concat($filterList, $this->planned_date_10->AdvancedSearch->toJson(), ","); // Field planned_date_10
		$filterList = Concat($filterList, $this->transmit_date_10->AdvancedSearch->toJson(), ","); // Field transmit_date_10
		$filterList = Concat($filterList, $this->transmit_no_10->AdvancedSearch->toJson(), ","); // Field transmit_no_10
		$filterList = Concat($filterList, $this->approval_status_10->AdvancedSearch->toJson(), ","); // Field approval_status_10
		$filterList = Concat($filterList, $this->direction_file_10->AdvancedSearch->toJson(), ","); // Field direction_file_10
		$filterList = Concat($filterList, $this->log_updatedon->AdvancedSearch->toJson(), ","); // Field log_updatedon
		if ($this->BasicSearch->Keyword <> "") {
			$wrk = "\"" . TABLE_BASIC_SEARCH . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . TABLE_BASIC_SEARCH_TYPE . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList <> "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList <> "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList <> "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "fdocument_loglistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field firelink_doc_no
		$this->firelink_doc_no->AdvancedSearch->SearchValue = @$filter["x_firelink_doc_no"];
		$this->firelink_doc_no->AdvancedSearch->SearchOperator = @$filter["z_firelink_doc_no"];
		$this->firelink_doc_no->AdvancedSearch->SearchCondition = @$filter["v_firelink_doc_no"];
		$this->firelink_doc_no->AdvancedSearch->SearchValue2 = @$filter["y_firelink_doc_no"];
		$this->firelink_doc_no->AdvancedSearch->SearchOperator2 = @$filter["w_firelink_doc_no"];
		$this->firelink_doc_no->AdvancedSearch->save();

		// Field client_doc_no
		$this->client_doc_no->AdvancedSearch->SearchValue = @$filter["x_client_doc_no"];
		$this->client_doc_no->AdvancedSearch->SearchOperator = @$filter["z_client_doc_no"];
		$this->client_doc_no->AdvancedSearch->SearchCondition = @$filter["v_client_doc_no"];
		$this->client_doc_no->AdvancedSearch->SearchValue2 = @$filter["y_client_doc_no"];
		$this->client_doc_no->AdvancedSearch->SearchOperator2 = @$filter["w_client_doc_no"];
		$this->client_doc_no->AdvancedSearch->save();

		// Field order_number
		$this->order_number->AdvancedSearch->SearchValue = @$filter["x_order_number"];
		$this->order_number->AdvancedSearch->SearchOperator = @$filter["z_order_number"];
		$this->order_number->AdvancedSearch->SearchCondition = @$filter["v_order_number"];
		$this->order_number->AdvancedSearch->SearchValue2 = @$filter["y_order_number"];
		$this->order_number->AdvancedSearch->SearchOperator2 = @$filter["w_order_number"];
		$this->order_number->AdvancedSearch->save();

		// Field project_name
		$this->project_name->AdvancedSearch->SearchValue = @$filter["x_project_name"];
		$this->project_name->AdvancedSearch->SearchOperator = @$filter["z_project_name"];
		$this->project_name->AdvancedSearch->SearchCondition = @$filter["v_project_name"];
		$this->project_name->AdvancedSearch->SearchValue2 = @$filter["y_project_name"];
		$this->project_name->AdvancedSearch->SearchOperator2 = @$filter["w_project_name"];
		$this->project_name->AdvancedSearch->save();

		// Field document_tittle
		$this->document_tittle->AdvancedSearch->SearchValue = @$filter["x_document_tittle"];
		$this->document_tittle->AdvancedSearch->SearchOperator = @$filter["z_document_tittle"];
		$this->document_tittle->AdvancedSearch->SearchCondition = @$filter["v_document_tittle"];
		$this->document_tittle->AdvancedSearch->SearchValue2 = @$filter["y_document_tittle"];
		$this->document_tittle->AdvancedSearch->SearchOperator2 = @$filter["w_document_tittle"];
		$this->document_tittle->AdvancedSearch->save();

		// Field current_status
		$this->current_status->AdvancedSearch->SearchValue = @$filter["x_current_status"];
		$this->current_status->AdvancedSearch->SearchOperator = @$filter["z_current_status"];
		$this->current_status->AdvancedSearch->SearchCondition = @$filter["v_current_status"];
		$this->current_status->AdvancedSearch->SearchValue2 = @$filter["y_current_status"];
		$this->current_status->AdvancedSearch->SearchOperator2 = @$filter["w_current_status"];
		$this->current_status->AdvancedSearch->save();

		// Field submit_no_1
		$this->submit_no_1->AdvancedSearch->SearchValue = @$filter["x_submit_no_1"];
		$this->submit_no_1->AdvancedSearch->SearchOperator = @$filter["z_submit_no_1"];
		$this->submit_no_1->AdvancedSearch->SearchCondition = @$filter["v_submit_no_1"];
		$this->submit_no_1->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_1"];
		$this->submit_no_1->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_1"];
		$this->submit_no_1->AdvancedSearch->save();

		// Field revision_no_1
		$this->revision_no_1->AdvancedSearch->SearchValue = @$filter["x_revision_no_1"];
		$this->revision_no_1->AdvancedSearch->SearchOperator = @$filter["z_revision_no_1"];
		$this->revision_no_1->AdvancedSearch->SearchCondition = @$filter["v_revision_no_1"];
		$this->revision_no_1->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_1"];
		$this->revision_no_1->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_1"];
		$this->revision_no_1->AdvancedSearch->save();

		// Field direction_1
		$this->direction_1->AdvancedSearch->SearchValue = @$filter["x_direction_1"];
		$this->direction_1->AdvancedSearch->SearchOperator = @$filter["z_direction_1"];
		$this->direction_1->AdvancedSearch->SearchCondition = @$filter["v_direction_1"];
		$this->direction_1->AdvancedSearch->SearchValue2 = @$filter["y_direction_1"];
		$this->direction_1->AdvancedSearch->SearchOperator2 = @$filter["w_direction_1"];
		$this->direction_1->AdvancedSearch->save();

		// Field transmit_no_1
		$this->transmit_no_1->AdvancedSearch->SearchValue = @$filter["x_transmit_no_1"];
		$this->transmit_no_1->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_1"];
		$this->transmit_no_1->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_1"];
		$this->transmit_no_1->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_1"];
		$this->transmit_no_1->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_1"];
		$this->transmit_no_1->AdvancedSearch->save();

		// Field approval_status_1
		$this->approval_status_1->AdvancedSearch->SearchValue = @$filter["x_approval_status_1"];
		$this->approval_status_1->AdvancedSearch->SearchOperator = @$filter["z_approval_status_1"];
		$this->approval_status_1->AdvancedSearch->SearchCondition = @$filter["v_approval_status_1"];
		$this->approval_status_1->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_1"];
		$this->approval_status_1->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_1"];
		$this->approval_status_1->AdvancedSearch->save();

		// Field submit_no_2
		$this->submit_no_2->AdvancedSearch->SearchValue = @$filter["x_submit_no_2"];
		$this->submit_no_2->AdvancedSearch->SearchOperator = @$filter["z_submit_no_2"];
		$this->submit_no_2->AdvancedSearch->SearchCondition = @$filter["v_submit_no_2"];
		$this->submit_no_2->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_2"];
		$this->submit_no_2->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_2"];
		$this->submit_no_2->AdvancedSearch->save();

		// Field revision_no_2
		$this->revision_no_2->AdvancedSearch->SearchValue = @$filter["x_revision_no_2"];
		$this->revision_no_2->AdvancedSearch->SearchOperator = @$filter["z_revision_no_2"];
		$this->revision_no_2->AdvancedSearch->SearchCondition = @$filter["v_revision_no_2"];
		$this->revision_no_2->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_2"];
		$this->revision_no_2->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_2"];
		$this->revision_no_2->AdvancedSearch->save();

		// Field direction_2
		$this->direction_2->AdvancedSearch->SearchValue = @$filter["x_direction_2"];
		$this->direction_2->AdvancedSearch->SearchOperator = @$filter["z_direction_2"];
		$this->direction_2->AdvancedSearch->SearchCondition = @$filter["v_direction_2"];
		$this->direction_2->AdvancedSearch->SearchValue2 = @$filter["y_direction_2"];
		$this->direction_2->AdvancedSearch->SearchOperator2 = @$filter["w_direction_2"];
		$this->direction_2->AdvancedSearch->save();

		// Field planned_date_2
		$this->planned_date_2->AdvancedSearch->SearchValue = @$filter["x_planned_date_2"];
		$this->planned_date_2->AdvancedSearch->SearchOperator = @$filter["z_planned_date_2"];
		$this->planned_date_2->AdvancedSearch->SearchCondition = @$filter["v_planned_date_2"];
		$this->planned_date_2->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_2"];
		$this->planned_date_2->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_2"];
		$this->planned_date_2->AdvancedSearch->save();

		// Field transmit_date_2
		$this->transmit_date_2->AdvancedSearch->SearchValue = @$filter["x_transmit_date_2"];
		$this->transmit_date_2->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_2"];
		$this->transmit_date_2->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_2"];
		$this->transmit_date_2->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_2"];
		$this->transmit_date_2->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_2"];
		$this->transmit_date_2->AdvancedSearch->save();

		// Field transmit_no_2
		$this->transmit_no_2->AdvancedSearch->SearchValue = @$filter["x_transmit_no_2"];
		$this->transmit_no_2->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_2"];
		$this->transmit_no_2->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_2"];
		$this->transmit_no_2->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_2"];
		$this->transmit_no_2->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_2"];
		$this->transmit_no_2->AdvancedSearch->save();

		// Field approval_status_2
		$this->approval_status_2->AdvancedSearch->SearchValue = @$filter["x_approval_status_2"];
		$this->approval_status_2->AdvancedSearch->SearchOperator = @$filter["z_approval_status_2"];
		$this->approval_status_2->AdvancedSearch->SearchCondition = @$filter["v_approval_status_2"];
		$this->approval_status_2->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_2"];
		$this->approval_status_2->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_2"];
		$this->approval_status_2->AdvancedSearch->save();

		// Field submit_no_3
		$this->submit_no_3->AdvancedSearch->SearchValue = @$filter["x_submit_no_3"];
		$this->submit_no_3->AdvancedSearch->SearchOperator = @$filter["z_submit_no_3"];
		$this->submit_no_3->AdvancedSearch->SearchCondition = @$filter["v_submit_no_3"];
		$this->submit_no_3->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_3"];
		$this->submit_no_3->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_3"];
		$this->submit_no_3->AdvancedSearch->save();

		// Field revision_no_3
		$this->revision_no_3->AdvancedSearch->SearchValue = @$filter["x_revision_no_3"];
		$this->revision_no_3->AdvancedSearch->SearchOperator = @$filter["z_revision_no_3"];
		$this->revision_no_3->AdvancedSearch->SearchCondition = @$filter["v_revision_no_3"];
		$this->revision_no_3->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_3"];
		$this->revision_no_3->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_3"];
		$this->revision_no_3->AdvancedSearch->save();

		// Field direction_3
		$this->direction_3->AdvancedSearch->SearchValue = @$filter["x_direction_3"];
		$this->direction_3->AdvancedSearch->SearchOperator = @$filter["z_direction_3"];
		$this->direction_3->AdvancedSearch->SearchCondition = @$filter["v_direction_3"];
		$this->direction_3->AdvancedSearch->SearchValue2 = @$filter["y_direction_3"];
		$this->direction_3->AdvancedSearch->SearchOperator2 = @$filter["w_direction_3"];
		$this->direction_3->AdvancedSearch->save();

		// Field transmit_no_3
		$this->transmit_no_3->AdvancedSearch->SearchValue = @$filter["x_transmit_no_3"];
		$this->transmit_no_3->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_3"];
		$this->transmit_no_3->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_3"];
		$this->transmit_no_3->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_3"];
		$this->transmit_no_3->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_3"];
		$this->transmit_no_3->AdvancedSearch->save();

		// Field approval_status_3
		$this->approval_status_3->AdvancedSearch->SearchValue = @$filter["x_approval_status_3"];
		$this->approval_status_3->AdvancedSearch->SearchOperator = @$filter["z_approval_status_3"];
		$this->approval_status_3->AdvancedSearch->SearchCondition = @$filter["v_approval_status_3"];
		$this->approval_status_3->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_3"];
		$this->approval_status_3->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_3"];
		$this->approval_status_3->AdvancedSearch->save();

		// Field submit_no_4
		$this->submit_no_4->AdvancedSearch->SearchValue = @$filter["x_submit_no_4"];
		$this->submit_no_4->AdvancedSearch->SearchOperator = @$filter["z_submit_no_4"];
		$this->submit_no_4->AdvancedSearch->SearchCondition = @$filter["v_submit_no_4"];
		$this->submit_no_4->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_4"];
		$this->submit_no_4->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_4"];
		$this->submit_no_4->AdvancedSearch->save();

		// Field revision_no_4
		$this->revision_no_4->AdvancedSearch->SearchValue = @$filter["x_revision_no_4"];
		$this->revision_no_4->AdvancedSearch->SearchOperator = @$filter["z_revision_no_4"];
		$this->revision_no_4->AdvancedSearch->SearchCondition = @$filter["v_revision_no_4"];
		$this->revision_no_4->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_4"];
		$this->revision_no_4->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_4"];
		$this->revision_no_4->AdvancedSearch->save();

		// Field direction_4
		$this->direction_4->AdvancedSearch->SearchValue = @$filter["x_direction_4"];
		$this->direction_4->AdvancedSearch->SearchOperator = @$filter["z_direction_4"];
		$this->direction_4->AdvancedSearch->SearchCondition = @$filter["v_direction_4"];
		$this->direction_4->AdvancedSearch->SearchValue2 = @$filter["y_direction_4"];
		$this->direction_4->AdvancedSearch->SearchOperator2 = @$filter["w_direction_4"];
		$this->direction_4->AdvancedSearch->save();

		// Field planned_date_4
		$this->planned_date_4->AdvancedSearch->SearchValue = @$filter["x_planned_date_4"];
		$this->planned_date_4->AdvancedSearch->SearchOperator = @$filter["z_planned_date_4"];
		$this->planned_date_4->AdvancedSearch->SearchCondition = @$filter["v_planned_date_4"];
		$this->planned_date_4->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_4"];
		$this->planned_date_4->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_4"];
		$this->planned_date_4->AdvancedSearch->save();

		// Field transmit_date_4
		$this->transmit_date_4->AdvancedSearch->SearchValue = @$filter["x_transmit_date_4"];
		$this->transmit_date_4->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_4"];
		$this->transmit_date_4->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_4"];
		$this->transmit_date_4->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_4"];
		$this->transmit_date_4->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_4"];
		$this->transmit_date_4->AdvancedSearch->save();

		// Field transmit_no_4
		$this->transmit_no_4->AdvancedSearch->SearchValue = @$filter["x_transmit_no_4"];
		$this->transmit_no_4->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_4"];
		$this->transmit_no_4->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_4"];
		$this->transmit_no_4->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_4"];
		$this->transmit_no_4->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_4"];
		$this->transmit_no_4->AdvancedSearch->save();

		// Field approval_status_4
		$this->approval_status_4->AdvancedSearch->SearchValue = @$filter["x_approval_status_4"];
		$this->approval_status_4->AdvancedSearch->SearchOperator = @$filter["z_approval_status_4"];
		$this->approval_status_4->AdvancedSearch->SearchCondition = @$filter["v_approval_status_4"];
		$this->approval_status_4->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_4"];
		$this->approval_status_4->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_4"];
		$this->approval_status_4->AdvancedSearch->save();

		// Field direction_file_4
		$this->direction_file_4->AdvancedSearch->SearchValue = @$filter["x_direction_file_4"];
		$this->direction_file_4->AdvancedSearch->SearchOperator = @$filter["z_direction_file_4"];
		$this->direction_file_4->AdvancedSearch->SearchCondition = @$filter["v_direction_file_4"];
		$this->direction_file_4->AdvancedSearch->SearchValue2 = @$filter["y_direction_file_4"];
		$this->direction_file_4->AdvancedSearch->SearchOperator2 = @$filter["w_direction_file_4"];
		$this->direction_file_4->AdvancedSearch->save();

		// Field submit_no_5
		$this->submit_no_5->AdvancedSearch->SearchValue = @$filter["x_submit_no_5"];
		$this->submit_no_5->AdvancedSearch->SearchOperator = @$filter["z_submit_no_5"];
		$this->submit_no_5->AdvancedSearch->SearchCondition = @$filter["v_submit_no_5"];
		$this->submit_no_5->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_5"];
		$this->submit_no_5->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_5"];
		$this->submit_no_5->AdvancedSearch->save();

		// Field revision_no_5
		$this->revision_no_5->AdvancedSearch->SearchValue = @$filter["x_revision_no_5"];
		$this->revision_no_5->AdvancedSearch->SearchOperator = @$filter["z_revision_no_5"];
		$this->revision_no_5->AdvancedSearch->SearchCondition = @$filter["v_revision_no_5"];
		$this->revision_no_5->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_5"];
		$this->revision_no_5->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_5"];
		$this->revision_no_5->AdvancedSearch->save();

		// Field direction_5
		$this->direction_5->AdvancedSearch->SearchValue = @$filter["x_direction_5"];
		$this->direction_5->AdvancedSearch->SearchOperator = @$filter["z_direction_5"];
		$this->direction_5->AdvancedSearch->SearchCondition = @$filter["v_direction_5"];
		$this->direction_5->AdvancedSearch->SearchValue2 = @$filter["y_direction_5"];
		$this->direction_5->AdvancedSearch->SearchOperator2 = @$filter["w_direction_5"];
		$this->direction_5->AdvancedSearch->save();

		// Field planned_date_5
		$this->planned_date_5->AdvancedSearch->SearchValue = @$filter["x_planned_date_5"];
		$this->planned_date_5->AdvancedSearch->SearchOperator = @$filter["z_planned_date_5"];
		$this->planned_date_5->AdvancedSearch->SearchCondition = @$filter["v_planned_date_5"];
		$this->planned_date_5->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_5"];
		$this->planned_date_5->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_5"];
		$this->planned_date_5->AdvancedSearch->save();

		// Field transmit_date_5
		$this->transmit_date_5->AdvancedSearch->SearchValue = @$filter["x_transmit_date_5"];
		$this->transmit_date_5->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_5"];
		$this->transmit_date_5->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_5"];
		$this->transmit_date_5->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_5"];
		$this->transmit_date_5->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_5"];
		$this->transmit_date_5->AdvancedSearch->save();

		// Field transmit_no_5
		$this->transmit_no_5->AdvancedSearch->SearchValue = @$filter["x_transmit_no_5"];
		$this->transmit_no_5->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_5"];
		$this->transmit_no_5->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_5"];
		$this->transmit_no_5->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_5"];
		$this->transmit_no_5->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_5"];
		$this->transmit_no_5->AdvancedSearch->save();

		// Field approval_status_5
		$this->approval_status_5->AdvancedSearch->SearchValue = @$filter["x_approval_status_5"];
		$this->approval_status_5->AdvancedSearch->SearchOperator = @$filter["z_approval_status_5"];
		$this->approval_status_5->AdvancedSearch->SearchCondition = @$filter["v_approval_status_5"];
		$this->approval_status_5->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_5"];
		$this->approval_status_5->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_5"];
		$this->approval_status_5->AdvancedSearch->save();

		// Field direction_file_5
		$this->direction_file_5->AdvancedSearch->SearchValue = @$filter["x_direction_file_5"];
		$this->direction_file_5->AdvancedSearch->SearchOperator = @$filter["z_direction_file_5"];
		$this->direction_file_5->AdvancedSearch->SearchCondition = @$filter["v_direction_file_5"];
		$this->direction_file_5->AdvancedSearch->SearchValue2 = @$filter["y_direction_file_5"];
		$this->direction_file_5->AdvancedSearch->SearchOperator2 = @$filter["w_direction_file_5"];
		$this->direction_file_5->AdvancedSearch->save();

		// Field submit_no_6
		$this->submit_no_6->AdvancedSearch->SearchValue = @$filter["x_submit_no_6"];
		$this->submit_no_6->AdvancedSearch->SearchOperator = @$filter["z_submit_no_6"];
		$this->submit_no_6->AdvancedSearch->SearchCondition = @$filter["v_submit_no_6"];
		$this->submit_no_6->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_6"];
		$this->submit_no_6->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_6"];
		$this->submit_no_6->AdvancedSearch->save();

		// Field revision_no_6
		$this->revision_no_6->AdvancedSearch->SearchValue = @$filter["x_revision_no_6"];
		$this->revision_no_6->AdvancedSearch->SearchOperator = @$filter["z_revision_no_6"];
		$this->revision_no_6->AdvancedSearch->SearchCondition = @$filter["v_revision_no_6"];
		$this->revision_no_6->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_6"];
		$this->revision_no_6->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_6"];
		$this->revision_no_6->AdvancedSearch->save();

		// Field direction_6
		$this->direction_6->AdvancedSearch->SearchValue = @$filter["x_direction_6"];
		$this->direction_6->AdvancedSearch->SearchOperator = @$filter["z_direction_6"];
		$this->direction_6->AdvancedSearch->SearchCondition = @$filter["v_direction_6"];
		$this->direction_6->AdvancedSearch->SearchValue2 = @$filter["y_direction_6"];
		$this->direction_6->AdvancedSearch->SearchOperator2 = @$filter["w_direction_6"];
		$this->direction_6->AdvancedSearch->save();

		// Field planned_date_6
		$this->planned_date_6->AdvancedSearch->SearchValue = @$filter["x_planned_date_6"];
		$this->planned_date_6->AdvancedSearch->SearchOperator = @$filter["z_planned_date_6"];
		$this->planned_date_6->AdvancedSearch->SearchCondition = @$filter["v_planned_date_6"];
		$this->planned_date_6->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_6"];
		$this->planned_date_6->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_6"];
		$this->planned_date_6->AdvancedSearch->save();

		// Field transmit_date_6
		$this->transmit_date_6->AdvancedSearch->SearchValue = @$filter["x_transmit_date_6"];
		$this->transmit_date_6->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_6"];
		$this->transmit_date_6->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_6"];
		$this->transmit_date_6->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_6"];
		$this->transmit_date_6->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_6"];
		$this->transmit_date_6->AdvancedSearch->save();

		// Field transmit_no_6
		$this->transmit_no_6->AdvancedSearch->SearchValue = @$filter["x_transmit_no_6"];
		$this->transmit_no_6->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_6"];
		$this->transmit_no_6->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_6"];
		$this->transmit_no_6->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_6"];
		$this->transmit_no_6->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_6"];
		$this->transmit_no_6->AdvancedSearch->save();

		// Field approval_status_6
		$this->approval_status_6->AdvancedSearch->SearchValue = @$filter["x_approval_status_6"];
		$this->approval_status_6->AdvancedSearch->SearchOperator = @$filter["z_approval_status_6"];
		$this->approval_status_6->AdvancedSearch->SearchCondition = @$filter["v_approval_status_6"];
		$this->approval_status_6->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_6"];
		$this->approval_status_6->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_6"];
		$this->approval_status_6->AdvancedSearch->save();

		// Field direction_file_6
		$this->direction_file_6->AdvancedSearch->SearchValue = @$filter["x_direction_file_6"];
		$this->direction_file_6->AdvancedSearch->SearchOperator = @$filter["z_direction_file_6"];
		$this->direction_file_6->AdvancedSearch->SearchCondition = @$filter["v_direction_file_6"];
		$this->direction_file_6->AdvancedSearch->SearchValue2 = @$filter["y_direction_file_6"];
		$this->direction_file_6->AdvancedSearch->SearchOperator2 = @$filter["w_direction_file_6"];
		$this->direction_file_6->AdvancedSearch->save();

		// Field submit_no_7
		$this->submit_no_7->AdvancedSearch->SearchValue = @$filter["x_submit_no_7"];
		$this->submit_no_7->AdvancedSearch->SearchOperator = @$filter["z_submit_no_7"];
		$this->submit_no_7->AdvancedSearch->SearchCondition = @$filter["v_submit_no_7"];
		$this->submit_no_7->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_7"];
		$this->submit_no_7->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_7"];
		$this->submit_no_7->AdvancedSearch->save();

		// Field revision_no_7
		$this->revision_no_7->AdvancedSearch->SearchValue = @$filter["x_revision_no_7"];
		$this->revision_no_7->AdvancedSearch->SearchOperator = @$filter["z_revision_no_7"];
		$this->revision_no_7->AdvancedSearch->SearchCondition = @$filter["v_revision_no_7"];
		$this->revision_no_7->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_7"];
		$this->revision_no_7->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_7"];
		$this->revision_no_7->AdvancedSearch->save();

		// Field direction_7
		$this->direction_7->AdvancedSearch->SearchValue = @$filter["x_direction_7"];
		$this->direction_7->AdvancedSearch->SearchOperator = @$filter["z_direction_7"];
		$this->direction_7->AdvancedSearch->SearchCondition = @$filter["v_direction_7"];
		$this->direction_7->AdvancedSearch->SearchValue2 = @$filter["y_direction_7"];
		$this->direction_7->AdvancedSearch->SearchOperator2 = @$filter["w_direction_7"];
		$this->direction_7->AdvancedSearch->save();

		// Field planned_date_7
		$this->planned_date_7->AdvancedSearch->SearchValue = @$filter["x_planned_date_7"];
		$this->planned_date_7->AdvancedSearch->SearchOperator = @$filter["z_planned_date_7"];
		$this->planned_date_7->AdvancedSearch->SearchCondition = @$filter["v_planned_date_7"];
		$this->planned_date_7->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_7"];
		$this->planned_date_7->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_7"];
		$this->planned_date_7->AdvancedSearch->save();

		// Field transmit_date_7
		$this->transmit_date_7->AdvancedSearch->SearchValue = @$filter["x_transmit_date_7"];
		$this->transmit_date_7->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_7"];
		$this->transmit_date_7->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_7"];
		$this->transmit_date_7->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_7"];
		$this->transmit_date_7->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_7"];
		$this->transmit_date_7->AdvancedSearch->save();

		// Field transmit_no_7
		$this->transmit_no_7->AdvancedSearch->SearchValue = @$filter["x_transmit_no_7"];
		$this->transmit_no_7->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_7"];
		$this->transmit_no_7->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_7"];
		$this->transmit_no_7->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_7"];
		$this->transmit_no_7->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_7"];
		$this->transmit_no_7->AdvancedSearch->save();

		// Field approval_status_7
		$this->approval_status_7->AdvancedSearch->SearchValue = @$filter["x_approval_status_7"];
		$this->approval_status_7->AdvancedSearch->SearchOperator = @$filter["z_approval_status_7"];
		$this->approval_status_7->AdvancedSearch->SearchCondition = @$filter["v_approval_status_7"];
		$this->approval_status_7->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_7"];
		$this->approval_status_7->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_7"];
		$this->approval_status_7->AdvancedSearch->save();

		// Field direction_file_7
		$this->direction_file_7->AdvancedSearch->SearchValue = @$filter["x_direction_file_7"];
		$this->direction_file_7->AdvancedSearch->SearchOperator = @$filter["z_direction_file_7"];
		$this->direction_file_7->AdvancedSearch->SearchCondition = @$filter["v_direction_file_7"];
		$this->direction_file_7->AdvancedSearch->SearchValue2 = @$filter["y_direction_file_7"];
		$this->direction_file_7->AdvancedSearch->SearchOperator2 = @$filter["w_direction_file_7"];
		$this->direction_file_7->AdvancedSearch->save();

		// Field submit_no_8
		$this->submit_no_8->AdvancedSearch->SearchValue = @$filter["x_submit_no_8"];
		$this->submit_no_8->AdvancedSearch->SearchOperator = @$filter["z_submit_no_8"];
		$this->submit_no_8->AdvancedSearch->SearchCondition = @$filter["v_submit_no_8"];
		$this->submit_no_8->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_8"];
		$this->submit_no_8->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_8"];
		$this->submit_no_8->AdvancedSearch->save();

		// Field revision_no_8
		$this->revision_no_8->AdvancedSearch->SearchValue = @$filter["x_revision_no_8"];
		$this->revision_no_8->AdvancedSearch->SearchOperator = @$filter["z_revision_no_8"];
		$this->revision_no_8->AdvancedSearch->SearchCondition = @$filter["v_revision_no_8"];
		$this->revision_no_8->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_8"];
		$this->revision_no_8->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_8"];
		$this->revision_no_8->AdvancedSearch->save();

		// Field direction_8
		$this->direction_8->AdvancedSearch->SearchValue = @$filter["x_direction_8"];
		$this->direction_8->AdvancedSearch->SearchOperator = @$filter["z_direction_8"];
		$this->direction_8->AdvancedSearch->SearchCondition = @$filter["v_direction_8"];
		$this->direction_8->AdvancedSearch->SearchValue2 = @$filter["y_direction_8"];
		$this->direction_8->AdvancedSearch->SearchOperator2 = @$filter["w_direction_8"];
		$this->direction_8->AdvancedSearch->save();

		// Field planned_date_8
		$this->planned_date_8->AdvancedSearch->SearchValue = @$filter["x_planned_date_8"];
		$this->planned_date_8->AdvancedSearch->SearchOperator = @$filter["z_planned_date_8"];
		$this->planned_date_8->AdvancedSearch->SearchCondition = @$filter["v_planned_date_8"];
		$this->planned_date_8->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_8"];
		$this->planned_date_8->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_8"];
		$this->planned_date_8->AdvancedSearch->save();

		// Field transmit_date_8
		$this->transmit_date_8->AdvancedSearch->SearchValue = @$filter["x_transmit_date_8"];
		$this->transmit_date_8->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_8"];
		$this->transmit_date_8->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_8"];
		$this->transmit_date_8->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_8"];
		$this->transmit_date_8->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_8"];
		$this->transmit_date_8->AdvancedSearch->save();

		// Field transmit_no_8
		$this->transmit_no_8->AdvancedSearch->SearchValue = @$filter["x_transmit_no_8"];
		$this->transmit_no_8->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_8"];
		$this->transmit_no_8->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_8"];
		$this->transmit_no_8->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_8"];
		$this->transmit_no_8->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_8"];
		$this->transmit_no_8->AdvancedSearch->save();

		// Field approval_status_8
		$this->approval_status_8->AdvancedSearch->SearchValue = @$filter["x_approval_status_8"];
		$this->approval_status_8->AdvancedSearch->SearchOperator = @$filter["z_approval_status_8"];
		$this->approval_status_8->AdvancedSearch->SearchCondition = @$filter["v_approval_status_8"];
		$this->approval_status_8->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_8"];
		$this->approval_status_8->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_8"];
		$this->approval_status_8->AdvancedSearch->save();

		// Field direction_file_8
		$this->direction_file_8->AdvancedSearch->SearchValue = @$filter["x_direction_file_8"];
		$this->direction_file_8->AdvancedSearch->SearchOperator = @$filter["z_direction_file_8"];
		$this->direction_file_8->AdvancedSearch->SearchCondition = @$filter["v_direction_file_8"];
		$this->direction_file_8->AdvancedSearch->SearchValue2 = @$filter["y_direction_file_8"];
		$this->direction_file_8->AdvancedSearch->SearchOperator2 = @$filter["w_direction_file_8"];
		$this->direction_file_8->AdvancedSearch->save();

		// Field submit_no_9
		$this->submit_no_9->AdvancedSearch->SearchValue = @$filter["x_submit_no_9"];
		$this->submit_no_9->AdvancedSearch->SearchOperator = @$filter["z_submit_no_9"];
		$this->submit_no_9->AdvancedSearch->SearchCondition = @$filter["v_submit_no_9"];
		$this->submit_no_9->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_9"];
		$this->submit_no_9->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_9"];
		$this->submit_no_9->AdvancedSearch->save();

		// Field revision_no_9
		$this->revision_no_9->AdvancedSearch->SearchValue = @$filter["x_revision_no_9"];
		$this->revision_no_9->AdvancedSearch->SearchOperator = @$filter["z_revision_no_9"];
		$this->revision_no_9->AdvancedSearch->SearchCondition = @$filter["v_revision_no_9"];
		$this->revision_no_9->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_9"];
		$this->revision_no_9->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_9"];
		$this->revision_no_9->AdvancedSearch->save();

		// Field direction_9
		$this->direction_9->AdvancedSearch->SearchValue = @$filter["x_direction_9"];
		$this->direction_9->AdvancedSearch->SearchOperator = @$filter["z_direction_9"];
		$this->direction_9->AdvancedSearch->SearchCondition = @$filter["v_direction_9"];
		$this->direction_9->AdvancedSearch->SearchValue2 = @$filter["y_direction_9"];
		$this->direction_9->AdvancedSearch->SearchOperator2 = @$filter["w_direction_9"];
		$this->direction_9->AdvancedSearch->save();

		// Field planned_date_9
		$this->planned_date_9->AdvancedSearch->SearchValue = @$filter["x_planned_date_9"];
		$this->planned_date_9->AdvancedSearch->SearchOperator = @$filter["z_planned_date_9"];
		$this->planned_date_9->AdvancedSearch->SearchCondition = @$filter["v_planned_date_9"];
		$this->planned_date_9->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_9"];
		$this->planned_date_9->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_9"];
		$this->planned_date_9->AdvancedSearch->save();

		// Field transmit_date_9
		$this->transmit_date_9->AdvancedSearch->SearchValue = @$filter["x_transmit_date_9"];
		$this->transmit_date_9->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_9"];
		$this->transmit_date_9->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_9"];
		$this->transmit_date_9->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_9"];
		$this->transmit_date_9->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_9"];
		$this->transmit_date_9->AdvancedSearch->save();

		// Field transmit_no_9
		$this->transmit_no_9->AdvancedSearch->SearchValue = @$filter["x_transmit_no_9"];
		$this->transmit_no_9->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_9"];
		$this->transmit_no_9->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_9"];
		$this->transmit_no_9->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_9"];
		$this->transmit_no_9->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_9"];
		$this->transmit_no_9->AdvancedSearch->save();

		// Field approval_status_9
		$this->approval_status_9->AdvancedSearch->SearchValue = @$filter["x_approval_status_9"];
		$this->approval_status_9->AdvancedSearch->SearchOperator = @$filter["z_approval_status_9"];
		$this->approval_status_9->AdvancedSearch->SearchCondition = @$filter["v_approval_status_9"];
		$this->approval_status_9->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_9"];
		$this->approval_status_9->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_9"];
		$this->approval_status_9->AdvancedSearch->save();

		// Field submit_no_10
		$this->submit_no_10->AdvancedSearch->SearchValue = @$filter["x_submit_no_10"];
		$this->submit_no_10->AdvancedSearch->SearchOperator = @$filter["z_submit_no_10"];
		$this->submit_no_10->AdvancedSearch->SearchCondition = @$filter["v_submit_no_10"];
		$this->submit_no_10->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_10"];
		$this->submit_no_10->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_10"];
		$this->submit_no_10->AdvancedSearch->save();

		// Field revision_no_10
		$this->revision_no_10->AdvancedSearch->SearchValue = @$filter["x_revision_no_10"];
		$this->revision_no_10->AdvancedSearch->SearchOperator = @$filter["z_revision_no_10"];
		$this->revision_no_10->AdvancedSearch->SearchCondition = @$filter["v_revision_no_10"];
		$this->revision_no_10->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_10"];
		$this->revision_no_10->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_10"];
		$this->revision_no_10->AdvancedSearch->save();

		// Field direction_10
		$this->direction_10->AdvancedSearch->SearchValue = @$filter["x_direction_10"];
		$this->direction_10->AdvancedSearch->SearchOperator = @$filter["z_direction_10"];
		$this->direction_10->AdvancedSearch->SearchCondition = @$filter["v_direction_10"];
		$this->direction_10->AdvancedSearch->SearchValue2 = @$filter["y_direction_10"];
		$this->direction_10->AdvancedSearch->SearchOperator2 = @$filter["w_direction_10"];
		$this->direction_10->AdvancedSearch->save();

		// Field planned_date_10
		$this->planned_date_10->AdvancedSearch->SearchValue = @$filter["x_planned_date_10"];
		$this->planned_date_10->AdvancedSearch->SearchOperator = @$filter["z_planned_date_10"];
		$this->planned_date_10->AdvancedSearch->SearchCondition = @$filter["v_planned_date_10"];
		$this->planned_date_10->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_10"];
		$this->planned_date_10->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_10"];
		$this->planned_date_10->AdvancedSearch->save();

		// Field transmit_date_10
		$this->transmit_date_10->AdvancedSearch->SearchValue = @$filter["x_transmit_date_10"];
		$this->transmit_date_10->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_10"];
		$this->transmit_date_10->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_10"];
		$this->transmit_date_10->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_10"];
		$this->transmit_date_10->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_10"];
		$this->transmit_date_10->AdvancedSearch->save();

		// Field transmit_no_10
		$this->transmit_no_10->AdvancedSearch->SearchValue = @$filter["x_transmit_no_10"];
		$this->transmit_no_10->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_10"];
		$this->transmit_no_10->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_10"];
		$this->transmit_no_10->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_10"];
		$this->transmit_no_10->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_10"];
		$this->transmit_no_10->AdvancedSearch->save();

		// Field approval_status_10
		$this->approval_status_10->AdvancedSearch->SearchValue = @$filter["x_approval_status_10"];
		$this->approval_status_10->AdvancedSearch->SearchOperator = @$filter["z_approval_status_10"];
		$this->approval_status_10->AdvancedSearch->SearchCondition = @$filter["v_approval_status_10"];
		$this->approval_status_10->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_10"];
		$this->approval_status_10->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_10"];
		$this->approval_status_10->AdvancedSearch->save();

		// Field direction_file_10
		$this->direction_file_10->AdvancedSearch->SearchValue = @$filter["x_direction_file_10"];
		$this->direction_file_10->AdvancedSearch->SearchOperator = @$filter["z_direction_file_10"];
		$this->direction_file_10->AdvancedSearch->SearchCondition = @$filter["v_direction_file_10"];
		$this->direction_file_10->AdvancedSearch->SearchValue2 = @$filter["y_direction_file_10"];
		$this->direction_file_10->AdvancedSearch->SearchOperator2 = @$filter["w_direction_file_10"];
		$this->direction_file_10->AdvancedSearch->save();

		// Field log_updatedon
		$this->log_updatedon->AdvancedSearch->SearchValue = @$filter["x_log_updatedon"];
		$this->log_updatedon->AdvancedSearch->SearchOperator = @$filter["z_log_updatedon"];
		$this->log_updatedon->AdvancedSearch->SearchCondition = @$filter["v_log_updatedon"];
		$this->log_updatedon->AdvancedSearch->SearchValue2 = @$filter["y_log_updatedon"];
		$this->log_updatedon->AdvancedSearch->SearchOperator2 = @$filter["w_log_updatedon"];
		$this->log_updatedon->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[TABLE_BASIC_SEARCH_TYPE]);
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->firelink_doc_no, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->client_doc_no, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->order_number, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->project_name, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->document_tittle, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->current_status, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_1, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_1, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_1, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_1, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_2, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_2, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_2, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_2, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_3, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_3, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_3, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_3, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_4, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_4, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_4, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_4, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_5, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_5, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_5, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_5, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_6, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_6, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_6, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_6, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_7, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_7, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_7, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_7, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_8, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_8, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_8, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_8, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->submit_no_9, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_9, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_9, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_9, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_9, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_10, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_10, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_10, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_10, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		global $BASIC_SEARCH_IGNORE_PATTERN;
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if ($BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$keyword = preg_replace($BASIC_SEARCH_IGNORE_PATTERN, "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = array($keyword);
			}
			foreach ($ar as $keyword) {
				if ($keyword <> "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == NULL_VALUE) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == NOT_NULL_VALUE) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk <> "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] <> "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql <> "") {
			if ($where <> "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		if (!$Security->canSearch())
			return "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword <> "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword <> "") {
						if ($searchStr <> "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql(array($keyword), $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, array("", "reset", "resetall")))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for Ctrl pressed
		$ctrl = Get("ctrl") !== NULL;

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->firelink_doc_no, $ctrl); // firelink_doc_no
			$this->updateSort($this->client_doc_no, $ctrl); // client_doc_no
			$this->updateSort($this->order_number, $ctrl); // order_number
			$this->updateSort($this->project_name, $ctrl); // project_name
			$this->updateSort($this->document_tittle, $ctrl); // document_tittle
			$this->updateSort($this->current_status, $ctrl); // current_status
			$this->updateSort($this->submit_no_1, $ctrl); // submit_no_1
			$this->updateSort($this->revision_no_1, $ctrl); // revision_no_1
			$this->updateSort($this->direction_1, $ctrl); // direction_1
			$this->updateSort($this->planned_date_1, $ctrl); // planned_date_1
			$this->updateSort($this->transmit_date_1, $ctrl); // transmit_date_1
			$this->updateSort($this->transmit_no_1, $ctrl); // transmit_no_1
			$this->updateSort($this->approval_status_1, $ctrl); // approval_status_1
			$this->updateSort($this->submit_no_2, $ctrl); // submit_no_2
			$this->updateSort($this->revision_no_2, $ctrl); // revision_no_2
			$this->updateSort($this->direction_2, $ctrl); // direction_2
			$this->updateSort($this->planned_date_2, $ctrl); // planned_date_2
			$this->updateSort($this->transmit_date_2, $ctrl); // transmit_date_2
			$this->updateSort($this->transmit_no_2, $ctrl); // transmit_no_2
			$this->updateSort($this->approval_status_2, $ctrl); // approval_status_2
			$this->updateSort($this->submit_no_3, $ctrl); // submit_no_3
			$this->updateSort($this->revision_no_3, $ctrl); // revision_no_3
			$this->updateSort($this->direction_3, $ctrl); // direction_3
			$this->updateSort($this->planned_date_3, $ctrl); // planned_date_3
			$this->updateSort($this->transmit_date_3, $ctrl); // transmit_date_3
			$this->updateSort($this->transmit_no_3, $ctrl); // transmit_no_3
			$this->updateSort($this->approval_status_3, $ctrl); // approval_status_3
			$this->updateSort($this->submit_no_4, $ctrl); // submit_no_4
			$this->updateSort($this->revision_no_4, $ctrl); // revision_no_4
			$this->updateSort($this->direction_4, $ctrl); // direction_4
			$this->updateSort($this->planned_date_4, $ctrl); // planned_date_4
			$this->updateSort($this->transmit_date_4, $ctrl); // transmit_date_4
			$this->updateSort($this->transmit_no_4, $ctrl); // transmit_no_4
			$this->updateSort($this->approval_status_4, $ctrl); // approval_status_4
			$this->updateSort($this->submit_no_5, $ctrl); // submit_no_5
			$this->updateSort($this->revision_no_5, $ctrl); // revision_no_5
			$this->updateSort($this->direction_5, $ctrl); // direction_5
			$this->updateSort($this->planned_date_5, $ctrl); // planned_date_5
			$this->updateSort($this->transmit_date_5, $ctrl); // transmit_date_5
			$this->updateSort($this->transmit_no_5, $ctrl); // transmit_no_5
			$this->updateSort($this->approval_status_5, $ctrl); // approval_status_5
			$this->updateSort($this->submit_no_6, $ctrl); // submit_no_6
			$this->updateSort($this->revision_no_6, $ctrl); // revision_no_6
			$this->updateSort($this->direction_6, $ctrl); // direction_6
			$this->updateSort($this->planned_date_6, $ctrl); // planned_date_6
			$this->updateSort($this->transmit_date_6, $ctrl); // transmit_date_6
			$this->updateSort($this->transmit_no_6, $ctrl); // transmit_no_6
			$this->updateSort($this->approval_status_6, $ctrl); // approval_status_6
			$this->updateSort($this->submit_no_7, $ctrl); // submit_no_7
			$this->updateSort($this->revision_no_7, $ctrl); // revision_no_7
			$this->updateSort($this->direction_7, $ctrl); // direction_7
			$this->updateSort($this->planned_date_7, $ctrl); // planned_date_7
			$this->updateSort($this->transmit_date_7, $ctrl); // transmit_date_7
			$this->updateSort($this->transmit_no_7, $ctrl); // transmit_no_7
			$this->updateSort($this->approval_status_7, $ctrl); // approval_status_7
			$this->updateSort($this->submit_no_8, $ctrl); // submit_no_8
			$this->updateSort($this->revision_no_8, $ctrl); // revision_no_8
			$this->updateSort($this->direction_8, $ctrl); // direction_8
			$this->updateSort($this->planned_date_8, $ctrl); // planned_date_8
			$this->updateSort($this->transmit_date_8, $ctrl); // transmit_date_8
			$this->updateSort($this->transmit_no_8, $ctrl); // transmit_no_8
			$this->updateSort($this->approval_status_8, $ctrl); // approval_status_8
			$this->updateSort($this->submit_no_9, $ctrl); // submit_no_9
			$this->updateSort($this->revision_no_9, $ctrl); // revision_no_9
			$this->updateSort($this->direction_9, $ctrl); // direction_9
			$this->updateSort($this->planned_date_9, $ctrl); // planned_date_9
			$this->updateSort($this->transmit_date_9, $ctrl); // transmit_date_9
			$this->updateSort($this->transmit_no_9, $ctrl); // transmit_no_9
			$this->updateSort($this->approval_status_9, $ctrl); // approval_status_9
			$this->updateSort($this->submit_no_10, $ctrl); // submit_no_10
			$this->updateSort($this->revision_no_10, $ctrl); // revision_no_10
			$this->updateSort($this->direction_10, $ctrl); // direction_10
			$this->updateSort($this->planned_date_10, $ctrl); // planned_date_10
			$this->updateSort($this->transmit_date_10, $ctrl); // transmit_date_10
			$this->updateSort($this->transmit_no_10, $ctrl); // transmit_no_10
			$this->updateSort($this->approval_status_10, $ctrl); // approval_status_10
			$this->updateSort($this->log_updatedon, $ctrl); // log_updatedon
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->firelink_doc_no->setSort("");
				$this->client_doc_no->setSort("");
				$this->order_number->setSort("");
				$this->project_name->setSort("");
				$this->document_tittle->setSort("");
				$this->current_status->setSort("");
				$this->submit_no_1->setSort("");
				$this->revision_no_1->setSort("");
				$this->direction_1->setSort("");
				$this->planned_date_1->setSort("");
				$this->transmit_date_1->setSort("");
				$this->transmit_no_1->setSort("");
				$this->approval_status_1->setSort("");
				$this->submit_no_2->setSort("");
				$this->revision_no_2->setSort("");
				$this->direction_2->setSort("");
				$this->planned_date_2->setSort("");
				$this->transmit_date_2->setSort("");
				$this->transmit_no_2->setSort("");
				$this->approval_status_2->setSort("");
				$this->submit_no_3->setSort("");
				$this->revision_no_3->setSort("");
				$this->direction_3->setSort("");
				$this->planned_date_3->setSort("");
				$this->transmit_date_3->setSort("");
				$this->transmit_no_3->setSort("");
				$this->approval_status_3->setSort("");
				$this->submit_no_4->setSort("");
				$this->revision_no_4->setSort("");
				$this->direction_4->setSort("");
				$this->planned_date_4->setSort("");
				$this->transmit_date_4->setSort("");
				$this->transmit_no_4->setSort("");
				$this->approval_status_4->setSort("");
				$this->submit_no_5->setSort("");
				$this->revision_no_5->setSort("");
				$this->direction_5->setSort("");
				$this->planned_date_5->setSort("");
				$this->transmit_date_5->setSort("");
				$this->transmit_no_5->setSort("");
				$this->approval_status_5->setSort("");
				$this->submit_no_6->setSort("");
				$this->revision_no_6->setSort("");
				$this->direction_6->setSort("");
				$this->planned_date_6->setSort("");
				$this->transmit_date_6->setSort("");
				$this->transmit_no_6->setSort("");
				$this->approval_status_6->setSort("");
				$this->submit_no_7->setSort("");
				$this->revision_no_7->setSort("");
				$this->direction_7->setSort("");
				$this->planned_date_7->setSort("");
				$this->transmit_date_7->setSort("");
				$this->transmit_no_7->setSort("");
				$this->approval_status_7->setSort("");
				$this->submit_no_8->setSort("");
				$this->revision_no_8->setSort("");
				$this->direction_8->setSort("");
				$this->planned_date_8->setSort("");
				$this->transmit_date_8->setSort("");
				$this->transmit_no_8->setSort("");
				$this->approval_status_8->setSort("");
				$this->submit_no_9->setSort("");
				$this->revision_no_9->setSort("");
				$this->direction_9->setSort("");
				$this->planned_date_9->setSort("");
				$this->transmit_date_9->setSort("");
				$this->transmit_no_9->setSort("");
				$this->approval_status_9->setSort("");
				$this->submit_no_10->setSort("");
				$this->revision_no_10->setSort("");
				$this->direction_10->setSort("");
				$this->planned_date_10->setSort("");
				$this->transmit_date_10->setSort("");
				$this->transmit_no_10->setSort("");
				$this->approval_status_10->setSort("");
				$this->log_updatedon->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew.selectAllKey(this);\">";
		$item->moveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// "sequence"
		$item = &$this->ListOptions->add("sequence");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = TRUE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$this->setupListOptionsExt();
		$item = &$this->ListOptions->getItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// "sequence"
		$opt = &$this->ListOptions->Items["sequence"];
		$opt->Body = FormatSequenceNumber($this->RecCnt);

		// Set up list action buttons
		$opt = &$this->ListOptions->getItem("listactions");
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));return false;\">" . $Language->phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}

		// "checkbox"
		$opt = &$this->ListOptions->Items["checkbox"];
		$opt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ew-multi-select\" value=\"" . HtmlEncode($this->log_id->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\">";
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;

			//$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fdocument_loglistsrch\" href=\"#\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fdocument_loglistsrch\" href=\"#\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({f:document.fdocument_loglist}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->getItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->hideAllOptions();
			}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter <> "" && $userAction <> "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions->Items[$userAction]->Caption;
				if (!$this->ListActions->Items[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "" && !ob_get_length()) // No output
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fdocument_loglistsrch\">" . $Language->phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
		global $Security;
		if (!$Security->canSearch()) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}
	}
	protected function setupListOptionsExt()
	{
		global $Security, $Language;
	}
	protected function renderListOptionsExt()
	{
		global $Security, $Language;
	}

	// Set up starting record parameters
	public function setupStartRec()
	{
		if ($this->DisplayRecs == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			if (Get(TABLE_START_REC) !== NULL) { // Check for "start" parameter
				$this->StartRec = Get(TABLE_START_REC);
				$this->setStartRecordNumber($this->StartRec);
			} elseif (Get(TABLE_PAGE_NO) !== NULL) {
				$pageNo = Get(TABLE_PAGE_NO);
				if (is_numeric($pageNo)) {
					$this->StartRec = ($pageNo - 1) * $this->DisplayRecs + 1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1) {
						$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->StartRec > $this->TotalRecs) { // Avoid starting record > total records
			$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
			$this->StartRec = (int)(($this->StartRec - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(TABLE_BASIC_SEARCH, ""), FALSE);
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(TABLE_BASIC_SEARCH_TYPE, ""), FALSE);
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = &$this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->log_id->setDbValue($row['log_id']);
		$this->firelink_doc_no->setDbValue($row['firelink_doc_no']);
		$this->client_doc_no->setDbValue($row['client_doc_no']);
		$this->order_number->setDbValue($row['order_number']);
		$this->project_name->setDbValue($row['project_name']);
		$this->document_tittle->setDbValue($row['document_tittle']);
		$this->current_status->setDbValue($row['current_status']);
		$this->current_status_file->Upload->DbValue = $row['current_status_file'];
		$this->current_status_file->setDbValue($this->current_status_file->Upload->DbValue);
		$this->submit_no_1->setDbValue($row['submit_no_1']);
		$this->revision_no_1->setDbValue($row['revision_no_1']);
		$this->direction_1->setDbValue($row['direction_1']);
		$this->planned_date_1->setDbValue($row['planned_date_1']);
		$this->transmit_date_1->setDbValue($row['transmit_date_1']);
		$this->transmit_no_1->setDbValue($row['transmit_no_1']);
		$this->approval_status_1->setDbValue($row['approval_status_1']);
		$this->direction_file_1->Upload->DbValue = $row['direction_file_1'];
		$this->direction_file_1->setDbValue($this->direction_file_1->Upload->DbValue);
		$this->submit_no_2->setDbValue($row['submit_no_2']);
		$this->revision_no_2->setDbValue($row['revision_no_2']);
		$this->direction_2->setDbValue($row['direction_2']);
		$this->planned_date_2->setDbValue($row['planned_date_2']);
		$this->transmit_date_2->setDbValue($row['transmit_date_2']);
		$this->transmit_no_2->setDbValue($row['transmit_no_2']);
		$this->approval_status_2->setDbValue($row['approval_status_2']);
		$this->direction_file_2->Upload->DbValue = $row['direction_file_2'];
		$this->direction_file_2->setDbValue($this->direction_file_2->Upload->DbValue);
		$this->submit_no_3->setDbValue($row['submit_no_3']);
		$this->revision_no_3->setDbValue($row['revision_no_3']);
		$this->direction_3->setDbValue($row['direction_3']);
		$this->planned_date_3->setDbValue($row['planned_date_3']);
		$this->transmit_date_3->setDbValue($row['transmit_date_3']);
		$this->transmit_no_3->setDbValue($row['transmit_no_3']);
		$this->approval_status_3->setDbValue($row['approval_status_3']);
		$this->direction_file_3->Upload->DbValue = $row['direction_file_3'];
		$this->direction_file_3->setDbValue($this->direction_file_3->Upload->DbValue);
		$this->submit_no_4->setDbValue($row['submit_no_4']);
		$this->revision_no_4->setDbValue($row['revision_no_4']);
		$this->direction_4->setDbValue($row['direction_4']);
		$this->planned_date_4->setDbValue($row['planned_date_4']);
		$this->transmit_date_4->setDbValue($row['transmit_date_4']);
		$this->transmit_no_4->setDbValue($row['transmit_no_4']);
		$this->approval_status_4->setDbValue($row['approval_status_4']);
		$this->direction_file_4->Upload->DbValue = $row['direction_file_4'];
		$this->direction_file_4->setDbValue($this->direction_file_4->Upload->DbValue);
		$this->submit_no_5->setDbValue($row['submit_no_5']);
		$this->revision_no_5->setDbValue($row['revision_no_5']);
		$this->direction_5->setDbValue($row['direction_5']);
		$this->planned_date_5->setDbValue($row['planned_date_5']);
		$this->transmit_date_5->setDbValue($row['transmit_date_5']);
		$this->transmit_no_5->setDbValue($row['transmit_no_5']);
		$this->approval_status_5->setDbValue($row['approval_status_5']);
		$this->direction_file_5->Upload->DbValue = $row['direction_file_5'];
		$this->direction_file_5->setDbValue($this->direction_file_5->Upload->DbValue);
		$this->submit_no_6->setDbValue($row['submit_no_6']);
		$this->revision_no_6->setDbValue($row['revision_no_6']);
		$this->direction_6->setDbValue($row['direction_6']);
		$this->planned_date_6->setDbValue($row['planned_date_6']);
		$this->transmit_date_6->setDbValue($row['transmit_date_6']);
		$this->transmit_no_6->setDbValue($row['transmit_no_6']);
		$this->approval_status_6->setDbValue($row['approval_status_6']);
		$this->direction_file_6->Upload->DbValue = $row['direction_file_6'];
		$this->direction_file_6->setDbValue($this->direction_file_6->Upload->DbValue);
		$this->submit_no_7->setDbValue($row['submit_no_7']);
		$this->revision_no_7->setDbValue($row['revision_no_7']);
		$this->direction_7->setDbValue($row['direction_7']);
		$this->planned_date_7->setDbValue($row['planned_date_7']);
		$this->transmit_date_7->setDbValue($row['transmit_date_7']);
		$this->transmit_no_7->setDbValue($row['transmit_no_7']);
		$this->approval_status_7->setDbValue($row['approval_status_7']);
		$this->direction_file_7->Upload->DbValue = $row['direction_file_7'];
		$this->direction_file_7->setDbValue($this->direction_file_7->Upload->DbValue);
		$this->submit_no_8->setDbValue($row['submit_no_8']);
		$this->revision_no_8->setDbValue($row['revision_no_8']);
		$this->direction_8->setDbValue($row['direction_8']);
		$this->planned_date_8->setDbValue($row['planned_date_8']);
		$this->transmit_date_8->setDbValue($row['transmit_date_8']);
		$this->transmit_no_8->setDbValue($row['transmit_no_8']);
		$this->approval_status_8->setDbValue($row['approval_status_8']);
		$this->direction_file_8->Upload->DbValue = $row['direction_file_8'];
		$this->direction_file_8->setDbValue($this->direction_file_8->Upload->DbValue);
		$this->submit_no_9->setDbValue($row['submit_no_9']);
		$this->revision_no_9->setDbValue($row['revision_no_9']);
		$this->direction_9->setDbValue($row['direction_9']);
		$this->planned_date_9->setDbValue($row['planned_date_9']);
		$this->transmit_date_9->setDbValue($row['transmit_date_9']);
		$this->transmit_no_9->setDbValue($row['transmit_no_9']);
		$this->approval_status_9->setDbValue($row['approval_status_9']);
		$this->direction_file_9->Upload->DbValue = $row['direction_file_9'];
		$this->direction_file_9->setDbValue($this->direction_file_9->Upload->DbValue);
		$this->submit_no_10->setDbValue($row['submit_no_10']);
		$this->revision_no_10->setDbValue($row['revision_no_10']);
		$this->direction_10->setDbValue($row['direction_10']);
		$this->planned_date_10->setDbValue($row['planned_date_10']);
		$this->transmit_date_10->setDbValue($row['transmit_date_10']);
		$this->transmit_no_10->setDbValue($row['transmit_no_10']);
		$this->approval_status_10->setDbValue($row['approval_status_10']);
		$this->direction_file_10->Upload->DbValue = $row['direction_file_10'];
		$this->direction_file_10->setDbValue($this->direction_file_10->Upload->DbValue);
		$this->log_updatedon->setDbValue($row['log_updatedon']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['log_id'] = NULL;
		$row['firelink_doc_no'] = NULL;
		$row['client_doc_no'] = NULL;
		$row['order_number'] = NULL;
		$row['project_name'] = NULL;
		$row['document_tittle'] = NULL;
		$row['current_status'] = NULL;
		$row['current_status_file'] = NULL;
		$row['submit_no_1'] = NULL;
		$row['revision_no_1'] = NULL;
		$row['direction_1'] = NULL;
		$row['planned_date_1'] = NULL;
		$row['transmit_date_1'] = NULL;
		$row['transmit_no_1'] = NULL;
		$row['approval_status_1'] = NULL;
		$row['direction_file_1'] = NULL;
		$row['submit_no_2'] = NULL;
		$row['revision_no_2'] = NULL;
		$row['direction_2'] = NULL;
		$row['planned_date_2'] = NULL;
		$row['transmit_date_2'] = NULL;
		$row['transmit_no_2'] = NULL;
		$row['approval_status_2'] = NULL;
		$row['direction_file_2'] = NULL;
		$row['submit_no_3'] = NULL;
		$row['revision_no_3'] = NULL;
		$row['direction_3'] = NULL;
		$row['planned_date_3'] = NULL;
		$row['transmit_date_3'] = NULL;
		$row['transmit_no_3'] = NULL;
		$row['approval_status_3'] = NULL;
		$row['direction_file_3'] = NULL;
		$row['submit_no_4'] = NULL;
		$row['revision_no_4'] = NULL;
		$row['direction_4'] = NULL;
		$row['planned_date_4'] = NULL;
		$row['transmit_date_4'] = NULL;
		$row['transmit_no_4'] = NULL;
		$row['approval_status_4'] = NULL;
		$row['direction_file_4'] = NULL;
		$row['submit_no_5'] = NULL;
		$row['revision_no_5'] = NULL;
		$row['direction_5'] = NULL;
		$row['planned_date_5'] = NULL;
		$row['transmit_date_5'] = NULL;
		$row['transmit_no_5'] = NULL;
		$row['approval_status_5'] = NULL;
		$row['direction_file_5'] = NULL;
		$row['submit_no_6'] = NULL;
		$row['revision_no_6'] = NULL;
		$row['direction_6'] = NULL;
		$row['planned_date_6'] = NULL;
		$row['transmit_date_6'] = NULL;
		$row['transmit_no_6'] = NULL;
		$row['approval_status_6'] = NULL;
		$row['direction_file_6'] = NULL;
		$row['submit_no_7'] = NULL;
		$row['revision_no_7'] = NULL;
		$row['direction_7'] = NULL;
		$row['planned_date_7'] = NULL;
		$row['transmit_date_7'] = NULL;
		$row['transmit_no_7'] = NULL;
		$row['approval_status_7'] = NULL;
		$row['direction_file_7'] = NULL;
		$row['submit_no_8'] = NULL;
		$row['revision_no_8'] = NULL;
		$row['direction_8'] = NULL;
		$row['planned_date_8'] = NULL;
		$row['transmit_date_8'] = NULL;
		$row['transmit_no_8'] = NULL;
		$row['approval_status_8'] = NULL;
		$row['direction_file_8'] = NULL;
		$row['submit_no_9'] = NULL;
		$row['revision_no_9'] = NULL;
		$row['direction_9'] = NULL;
		$row['planned_date_9'] = NULL;
		$row['transmit_date_9'] = NULL;
		$row['transmit_no_9'] = NULL;
		$row['approval_status_9'] = NULL;
		$row['direction_file_9'] = NULL;
		$row['submit_no_10'] = NULL;
		$row['revision_no_10'] = NULL;
		$row['direction_10'] = NULL;
		$row['planned_date_10'] = NULL;
		$row['transmit_date_10'] = NULL;
		$row['transmit_no_10'] = NULL;
		$row['approval_status_10'] = NULL;
		$row['direction_file_10'] = NULL;
		$row['log_updatedon'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("log_id")) <> "")
			$this->log_id->CurrentValue = $this->getKey("log_id"); // log_id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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
		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
			$this->planned_date_1->ViewValue = FormatDateTime($this->planned_date_1->ViewValue, 5);
			$this->planned_date_1->ViewCustomAttributes = "";

			// transmit_date_1
			$this->transmit_date_1->ViewValue = $this->transmit_date_1->CurrentValue;
			$this->transmit_date_1->ViewValue = FormatDateTime($this->transmit_date_1->ViewValue, 5);
			$this->transmit_date_1->ViewCustomAttributes = "";

			// transmit_no_1
			$this->transmit_no_1->ViewValue = $this->transmit_no_1->CurrentValue;
			$this->transmit_no_1->ViewCustomAttributes = "";

			// approval_status_1
			$this->approval_status_1->ViewValue = $this->approval_status_1->CurrentValue;
			$curVal = strval($this->approval_status_1->CurrentValue);
			if ($curVal <> "") {
				$this->approval_status_1->ViewValue = $this->approval_status_1->lookupCacheOption($curVal);
				if ($this->approval_status_1->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"short_code\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->approval_status_1->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->approval_status_1->ViewValue = $this->approval_status_1->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->approval_status_1->ViewValue = $this->approval_status_1->CurrentValue;
					}
				}
			} else {
				$this->approval_status_1->ViewValue = NULL;
			}
			$this->approval_status_1->ViewCustomAttributes = "";

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
			$this->planned_date_2->ViewValue = FormatDateTime($this->planned_date_2->ViewValue, 5);
			$this->planned_date_2->ViewCustomAttributes = "";

			// transmit_date_2
			$this->transmit_date_2->ViewValue = $this->transmit_date_2->CurrentValue;
			$this->transmit_date_2->ViewValue = FormatDateTime($this->transmit_date_2->ViewValue, 5);
			$this->transmit_date_2->ViewCustomAttributes = "";

			// transmit_no_2
			$this->transmit_no_2->ViewValue = $this->transmit_no_2->CurrentValue;
			$this->transmit_no_2->ViewCustomAttributes = "";

			// approval_status_2
			$this->approval_status_2->ViewValue = $this->approval_status_2->CurrentValue;
			$curVal = strval($this->approval_status_2->CurrentValue);
			if ($curVal <> "") {
				$this->approval_status_2->ViewValue = $this->approval_status_2->lookupCacheOption($curVal);
				if ($this->approval_status_2->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"short_code\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->approval_status_2->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->approval_status_2->ViewValue = $this->approval_status_2->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->approval_status_2->ViewValue = $this->approval_status_2->CurrentValue;
					}
				}
			} else {
				$this->approval_status_2->ViewValue = NULL;
			}
			$this->approval_status_2->ViewCustomAttributes = "";

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
			$this->planned_date_3->ViewValue = FormatDateTime($this->planned_date_3->ViewValue, 5);
			$this->planned_date_3->ViewCustomAttributes = "";

			// transmit_date_3
			$this->transmit_date_3->ViewValue = $this->transmit_date_3->CurrentValue;
			$this->transmit_date_3->ViewValue = FormatDateTime($this->transmit_date_3->ViewValue, 5);
			$this->transmit_date_3->ViewCustomAttributes = "";

			// transmit_no_3
			$this->transmit_no_3->ViewValue = $this->transmit_no_3->CurrentValue;
			$this->transmit_no_3->ViewCustomAttributes = "";

			// approval_status_3
			$this->approval_status_3->ViewValue = $this->approval_status_3->CurrentValue;
			$curVal = strval($this->approval_status_3->CurrentValue);
			if ($curVal <> "") {
				$this->approval_status_3->ViewValue = $this->approval_status_3->lookupCacheOption($curVal);
				if ($this->approval_status_3->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"short_code\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->approval_status_3->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->approval_status_3->ViewValue = $this->approval_status_3->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->approval_status_3->ViewValue = $this->approval_status_3->CurrentValue;
					}
				}
			} else {
				$this->approval_status_3->ViewValue = NULL;
			}
			$this->approval_status_3->ViewCustomAttributes = "";

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
			$this->planned_date_4->ViewValue = FormatDateTime($this->planned_date_4->ViewValue, 5);
			$this->planned_date_4->ViewCustomAttributes = "";

			// transmit_date_4
			$this->transmit_date_4->ViewValue = $this->transmit_date_4->CurrentValue;
			$this->transmit_date_4->ViewValue = FormatDateTime($this->transmit_date_4->ViewValue, 5);
			$this->transmit_date_4->ViewCustomAttributes = "";

			// transmit_no_4
			$this->transmit_no_4->ViewValue = $this->transmit_no_4->CurrentValue;
			$this->transmit_no_4->ViewCustomAttributes = "";

			// approval_status_4
			$this->approval_status_4->ViewValue = $this->approval_status_4->CurrentValue;
			$curVal = strval($this->approval_status_4->CurrentValue);
			if ($curVal <> "") {
				$this->approval_status_4->ViewValue = $this->approval_status_4->lookupCacheOption($curVal);
				if ($this->approval_status_4->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"short_code\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->approval_status_4->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->approval_status_4->ViewValue = $this->approval_status_4->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->approval_status_4->ViewValue = $this->approval_status_4->CurrentValue;
					}
				}
			} else {
				$this->approval_status_4->ViewValue = NULL;
			}
			$this->approval_status_4->ViewCustomAttributes = "";

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
			$this->planned_date_5->ViewValue = FormatDateTime($this->planned_date_5->ViewValue, 5);
			$this->planned_date_5->ViewCustomAttributes = "";

			// transmit_date_5
			$this->transmit_date_5->ViewValue = $this->transmit_date_5->CurrentValue;
			$this->transmit_date_5->ViewValue = FormatDateTime($this->transmit_date_5->ViewValue, 5);
			$this->transmit_date_5->ViewCustomAttributes = "";

			// transmit_no_5
			$this->transmit_no_5->ViewValue = $this->transmit_no_5->CurrentValue;
			$this->transmit_no_5->ViewCustomAttributes = "";

			// approval_status_5
			$this->approval_status_5->ViewValue = $this->approval_status_5->CurrentValue;
			$curVal = strval($this->approval_status_5->CurrentValue);
			if ($curVal <> "") {
				$this->approval_status_5->ViewValue = $this->approval_status_5->lookupCacheOption($curVal);
				if ($this->approval_status_5->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"short_code\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->approval_status_5->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->approval_status_5->ViewValue = $this->approval_status_5->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->approval_status_5->ViewValue = $this->approval_status_5->CurrentValue;
					}
				}
			} else {
				$this->approval_status_5->ViewValue = NULL;
			}
			$this->approval_status_5->ViewCustomAttributes = "";

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
			$this->planned_date_6->ViewValue = FormatDateTime($this->planned_date_6->ViewValue, 5);
			$this->planned_date_6->ViewCustomAttributes = "";

			// transmit_date_6
			$this->transmit_date_6->ViewValue = $this->transmit_date_6->CurrentValue;
			$this->transmit_date_6->ViewValue = FormatDateTime($this->transmit_date_6->ViewValue, 5);
			$this->transmit_date_6->ViewCustomAttributes = "";

			// transmit_no_6
			$this->transmit_no_6->ViewValue = $this->transmit_no_6->CurrentValue;
			$this->transmit_no_6->ViewCustomAttributes = "";

			// approval_status_6
			$this->approval_status_6->ViewValue = $this->approval_status_6->CurrentValue;
			$curVal = strval($this->approval_status_6->CurrentValue);
			if ($curVal <> "") {
				$this->approval_status_6->ViewValue = $this->approval_status_6->lookupCacheOption($curVal);
				if ($this->approval_status_6->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"short_code\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->approval_status_6->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->approval_status_6->ViewValue = $this->approval_status_6->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->approval_status_6->ViewValue = $this->approval_status_6->CurrentValue;
					}
				}
			} else {
				$this->approval_status_6->ViewValue = NULL;
			}
			$this->approval_status_6->ViewCustomAttributes = "";

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
			$this->planned_date_7->ViewValue = FormatDateTime($this->planned_date_7->ViewValue, 5);
			$this->planned_date_7->ViewCustomAttributes = "";

			// transmit_date_7
			$this->transmit_date_7->ViewValue = $this->transmit_date_7->CurrentValue;
			$this->transmit_date_7->ViewValue = FormatDateTime($this->transmit_date_7->ViewValue, 5);
			$this->transmit_date_7->ViewCustomAttributes = "";

			// transmit_no_7
			$this->transmit_no_7->ViewValue = $this->transmit_no_7->CurrentValue;
			$this->transmit_no_7->ViewCustomAttributes = "";

			// approval_status_7
			$this->approval_status_7->ViewValue = $this->approval_status_7->CurrentValue;
			$curVal = strval($this->approval_status_7->CurrentValue);
			if ($curVal <> "") {
				$this->approval_status_7->ViewValue = $this->approval_status_7->lookupCacheOption($curVal);
				if ($this->approval_status_7->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"short_code\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->approval_status_7->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->approval_status_7->ViewValue = $this->approval_status_7->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->approval_status_7->ViewValue = $this->approval_status_7->CurrentValue;
					}
				}
			} else {
				$this->approval_status_7->ViewValue = NULL;
			}
			$this->approval_status_7->ViewCustomAttributes = "";

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
			$this->planned_date_8->ViewValue = FormatDateTime($this->planned_date_8->ViewValue, 5);
			$this->planned_date_8->ViewCustomAttributes = "";

			// transmit_date_8
			$this->transmit_date_8->ViewValue = $this->transmit_date_8->CurrentValue;
			$this->transmit_date_8->ViewValue = FormatDateTime($this->transmit_date_8->ViewValue, 5);
			$this->transmit_date_8->ViewCustomAttributes = "";

			// transmit_no_8
			$this->transmit_no_8->ViewValue = $this->transmit_no_8->CurrentValue;
			$this->transmit_no_8->ViewCustomAttributes = "";

			// approval_status_8
			$this->approval_status_8->ViewValue = $this->approval_status_8->CurrentValue;
			$curVal = strval($this->approval_status_8->CurrentValue);
			if ($curVal <> "") {
				$this->approval_status_8->ViewValue = $this->approval_status_8->lookupCacheOption($curVal);
				if ($this->approval_status_8->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"short_code\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->approval_status_8->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->approval_status_8->ViewValue = $this->approval_status_8->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->approval_status_8->ViewValue = $this->approval_status_8->CurrentValue;
					}
				}
			} else {
				$this->approval_status_8->ViewValue = NULL;
			}
			$this->approval_status_8->ViewCustomAttributes = "";

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
			$this->planned_date_9->ViewValue = FormatDateTime($this->planned_date_9->ViewValue, 5);
			$this->planned_date_9->ViewCustomAttributes = "";

			// transmit_date_9
			$this->transmit_date_9->ViewValue = $this->transmit_date_9->CurrentValue;
			$this->transmit_date_9->ViewValue = FormatDateTime($this->transmit_date_9->ViewValue, 5);
			$this->transmit_date_9->ViewCustomAttributes = "";

			// transmit_no_9
			$this->transmit_no_9->ViewValue = $this->transmit_no_9->CurrentValue;
			$this->transmit_no_9->ViewCustomAttributes = "";

			// approval_status_9
			$this->approval_status_9->ViewValue = $this->approval_status_9->CurrentValue;
			$curVal = strval($this->approval_status_9->CurrentValue);
			if ($curVal <> "") {
				$this->approval_status_9->ViewValue = $this->approval_status_9->lookupCacheOption($curVal);
				if ($this->approval_status_9->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"short_code\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->approval_status_9->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->approval_status_9->ViewValue = $this->approval_status_9->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->approval_status_9->ViewValue = $this->approval_status_9->CurrentValue;
					}
				}
			} else {
				$this->approval_status_9->ViewValue = NULL;
			}
			$this->approval_status_9->ViewCustomAttributes = "";

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
			$this->planned_date_10->ViewValue = FormatDateTime($this->planned_date_10->ViewValue, 5);
			$this->planned_date_10->ViewCustomAttributes = "";

			// transmit_date_10
			$this->transmit_date_10->ViewValue = $this->transmit_date_10->CurrentValue;
			$this->transmit_date_10->ViewValue = FormatDateTime($this->transmit_date_10->ViewValue, 5);
			$this->transmit_date_10->CssClass = "font-italic";
			$this->transmit_date_10->ViewCustomAttributes = "";

			// transmit_no_10
			$this->transmit_no_10->ViewValue = $this->transmit_no_10->CurrentValue;
			$this->transmit_no_10->ViewCustomAttributes = "";

			// approval_status_10
			$this->approval_status_10->ViewValue = $this->approval_status_10->CurrentValue;
			$curVal = strval($this->approval_status_10->CurrentValue);
			if ($curVal <> "") {
				$this->approval_status_10->ViewValue = $this->approval_status_10->lookupCacheOption($curVal);
				if ($this->approval_status_10->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"short_code\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->approval_status_10->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->approval_status_10->ViewValue = $this->approval_status_10->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->approval_status_10->ViewValue = $this->approval_status_10->CurrentValue;
					}
				}
			} else {
				$this->approval_status_10->ViewValue = NULL;
			}
			$this->approval_status_10->ViewCustomAttributes = "";

			// log_updatedon
			$this->log_updatedon->ViewValue = $this->log_updatedon->CurrentValue;
			$this->log_updatedon->ViewValue = FormatDateTime($this->log_updatedon->ViewValue, 109);
			$this->log_updatedon->ViewCustomAttributes = "";

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
			if (!EmptyValue($this->current_status_file->Upload->DbValue)) {
				$this->current_status->HrefValue = GetFileUploadUrl($this->current_status_file, $this->current_status_file->Upload->DbValue); // Add prefix/suffix
				$this->current_status->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->current_status->HrefValue = FullUrl($this->current_status->HrefValue, "href");
			} else {
				$this->current_status->HrefValue = "";
			}
			$this->current_status->TooltipValue = "";

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
			if (!EmptyValue($this->direction_file_1->Upload->DbValue)) {
				$this->approval_status_1->HrefValue = GetFileUploadUrl($this->direction_file_1, $this->direction_file_1->Upload->DbValue); // Add prefix/suffix
				$this->approval_status_1->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->approval_status_1->HrefValue = FullUrl($this->approval_status_1->HrefValue, "href");
			} else {
				$this->approval_status_1->HrefValue = "";
			}
			$this->approval_status_1->TooltipValue = "";

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
			if (!EmptyValue($this->direction_file_2->Upload->DbValue)) {
				$this->approval_status_2->HrefValue = GetFileUploadUrl($this->direction_file_2, $this->direction_file_2->Upload->DbValue); // Add prefix/suffix
				$this->approval_status_2->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->approval_status_2->HrefValue = FullUrl($this->approval_status_2->HrefValue, "href");
			} else {
				$this->approval_status_2->HrefValue = "";
			}
			$this->approval_status_2->TooltipValue = "";

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
			if (!EmptyValue($this->direction_file_3->Upload->DbValue)) {
				$this->approval_status_3->HrefValue = GetFileUploadUrl($this->direction_file_3, $this->direction_file_3->Upload->DbValue); // Add prefix/suffix
				$this->approval_status_3->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->approval_status_3->HrefValue = FullUrl($this->approval_status_3->HrefValue, "href");
			} else {
				$this->approval_status_3->HrefValue = "";
			}
			$this->approval_status_3->TooltipValue = "";

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
			if (!EmptyValue($this->direction_file_4->Upload->DbValue)) {
				$this->approval_status_4->HrefValue = GetFileUploadUrl($this->direction_file_4, $this->direction_file_4->Upload->DbValue); // Add prefix/suffix
				$this->approval_status_4->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->approval_status_4->HrefValue = FullUrl($this->approval_status_4->HrefValue, "href");
			} else {
				$this->approval_status_4->HrefValue = "";
			}
			$this->approval_status_4->TooltipValue = "";

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
			if (!EmptyValue($this->direction_file_6->Upload->DbValue)) {
				$this->approval_status_6->HrefValue = GetFileUploadUrl($this->direction_file_6, $this->direction_file_6->Upload->DbValue); // Add prefix/suffix
				$this->approval_status_6->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->approval_status_6->HrefValue = FullUrl($this->approval_status_6->HrefValue, "href");
			} else {
				$this->approval_status_6->HrefValue = "";
			}
			$this->approval_status_6->TooltipValue = "";

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
			if (!EmptyValue($this->direction_file_7->Upload->DbValue)) {
				$this->approval_status_7->HrefValue = GetFileUploadUrl($this->direction_file_7, $this->direction_file_7->Upload->DbValue); // Add prefix/suffix
				$this->approval_status_7->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->approval_status_7->HrefValue = FullUrl($this->approval_status_7->HrefValue, "href");
			} else {
				$this->approval_status_7->HrefValue = "";
			}
			$this->approval_status_7->TooltipValue = "";

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
			if (!EmptyValue($this->direction_file_8->Upload->DbValue)) {
				$this->approval_status_8->HrefValue = GetFileUploadUrl($this->direction_file_8, $this->direction_file_8->Upload->DbValue); // Add prefix/suffix
				$this->approval_status_8->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->approval_status_8->HrefValue = FullUrl($this->approval_status_8->HrefValue, "href");
			} else {
				$this->approval_status_8->HrefValue = "";
			}
			$this->approval_status_8->TooltipValue = "";

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
			if (!EmptyValue($this->direction_file_9->Upload->DbValue)) {
				$this->approval_status_9->HrefValue = GetFileUploadUrl($this->direction_file_9, $this->direction_file_9->Upload->DbValue); // Add prefix/suffix
				$this->approval_status_9->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->approval_status_9->HrefValue = FullUrl($this->approval_status_9->HrefValue, "href");
			} else {
				$this->approval_status_9->HrefValue = "";
			}
			$this->approval_status_9->TooltipValue = "";

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
			if (!EmptyValue($this->direction_file_10->Upload->DbValue)) {
				$this->approval_status_10->HrefValue = GetFileUploadUrl($this->direction_file_10, $this->direction_file_10->Upload->DbValue); // Add prefix/suffix
				$this->approval_status_10->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->approval_status_10->HrefValue = FullUrl($this->approval_status_10->HrefValue, "href");
			} else {
				$this->approval_status_10->HrefValue = "";
			}
			$this->approval_status_10->TooltipValue = "";

			// log_updatedon
			$this->log_updatedon->LinkCustomAttributes = "";
			$this->log_updatedon->HrefValue = "";
			$this->log_updatedon->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"ew.export(document.fdocument_loglist,'" . $this->ExportExcelUrl . "','excel',true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"ew.export(document.fdocument_loglist,'" . $this->ExportWordUrl . "','word',true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"ew.export(document.fdocument_loglist,'" . $this->ExportPdfUrl . "','pdf',true);\">" . $Language->phrase("ExportToPDF") . "</a>";
			else
				return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
		} elseif (SameText($type, "html")) {
			return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
		} elseif (SameText($type, "xml")) {
			return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
		} elseif (SameText($type, "csv")) {
			return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
		} elseif (SameText($type, "print")) {
			return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = FALSE;

		// Export to Html
		$item = &$this->ExportOptions->add("html");
		$item->Body = $this->getExportTag("html");
		$item->Visible = FALSE;

		// Export to Xml
		$item = &$this->ExportOptions->add("xml");
		$item->Body = $this->getExportTag("xml");
		$item->Visible = FALSE;

		// Export to Csv
		$item = &$this->ExportOptions->add("csv");
		$item->Body = $this->getExportTag("csv");
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$url = "";
		$item->Body = "<button id=\"emf_document_log\" class=\"ew-export-link ew-email\" title=\"" . $Language->phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->phrase("ExportToEmailText") . "\" onclick=\"ew.emailDialogShow({lnk:'emf_document_log',hdr:ew.language.phrase('ExportToEmailText'),f:document.fdocument_loglist,sel:false" . $url . "});\">" . $Language->phrase("ExportToEmail") . "</button>";
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	/**
	 * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	 *
	 * @param boolean $return Return the data rather than output it
	 * @return mixed 
	 */
	public function exportData($return = FALSE)
	{
		global $Language;
		$utf8 = SameText(PROJECT_CHARSET, "utf-8");
		$selectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($selectLimit) {
			$this->TotalRecs = $this->listRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->loadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->setupStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($selectLimit)
			$rs = $this->loadRecordset($this->StartRec - 1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		$this->ExportDoc = GetExportDocument($this, "h");
		$doc = &$this->ExportDoc;
		if (!$doc)
			$this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
		if (!$rs || !$doc) {
			RemoveHeader("Content-Type"); // Remove header
			RemoveHeader("Content-Disposition");
			$this->showMessage();
			return;
		}
		if ($selectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		$doc->Text .= $header;
		$this->exportDocument($doc, $rs, $this->StartRec, $this->StopRec, "");
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		$doc->Text .= $footer;

		// Close recordset
		$rs->close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$doc->exportHeaderAndFooter();

		// Clean output buffer (without destroying output buffer)
		$buffer = ob_get_contents(); // Save the output buffer
		if (!DEBUG_ENABLED && $buffer)
			ob_clean();

		// Write debug message if enabled
		if (DEBUG_ENABLED && !$this->isExport("pdf"))
			echo GetDebugMessage();

		// Output data
		if ($this->isExport("email")) {

			// Export-to-email disabled
		} else {
			$doc->export();
			if ($return) {
				RemoveHeader("Content-Type"); // Remove header
				RemoveHeader("Content-Disposition");
				$content = ob_get_contents();
				if ($content)
					ob_clean();
				if ($buffer)
					echo $buffer; // Resume the output buffer
				return $content;
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->ParentFields) == 0 && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_approval_status_1":
							break;
						case "x_approval_status_2":
							break;
						case "x_approval_status_3":
							break;
						case "x_approval_status_4":
							break;
						case "x_approval_status_5":
							break;
						case "x_approval_status_6":
							break;
						case "x_approval_status_7":
							break;
						case "x_approval_status_8":
							break;
						case "x_approval_status_9":
							break;
						case "x_approval_status_10":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}

	// Page Importing event
	function Page_Importing($reader, &$options) {

		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Row Import event
	function Row_Import(&$row, $cnt) {

		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Page Imported event
	function Page_Imported($reader, $results) {

		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results

	}
}
?>