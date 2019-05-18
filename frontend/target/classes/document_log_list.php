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

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

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

		// Table object (user_dtls)
		if (!isset($GLOBALS['user_dtls']))
			$GLOBALS['user_dtls'] = new user_dtls();

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

		// User table object (user_dtls)
		if (!isset($UserTable)) {
			$UserTable = new user_dtls();
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
	public $DisplayRecs = 25;
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
		$this->submit_no_sub1->setVisibility();
		$this->revision_no_sub1->setVisibility();
		$this->direction_out_sub1->setVisibility();
		$this->planned_date_out_sub1->setVisibility();
		$this->transmit_date_out_sub1->setVisibility();
		$this->transmit_no_out_sub1->setVisibility();
		$this->approval_status_out_sub1->setVisibility();
		$this->direction_out_file_sub1->Visible = FALSE;
		$this->direction_in_sub1->setVisibility();
		$this->transmit_no_in_sub1->setVisibility();
		$this->approval_status_in_sub1->setVisibility();
		$this->direction_in_file_sub1->Visible = FALSE;
		$this->transmit_date_in_sub1->setVisibility();
		$this->submit_no_sub2->setVisibility();
		$this->revision_no_sub2->setVisibility();
		$this->direction_out_sub2->setVisibility();
		$this->planned_date_out_sub2->setVisibility();
		$this->transmit_date_out_sub2->setVisibility();
		$this->transmit_no_out_sub2->setVisibility();
		$this->approval_status_out_sub2->setVisibility();
		$this->direction_out_file_sub2->Visible = FALSE;
		$this->direction_in_sub2->setVisibility();
		$this->transmit_no_in_sub2->setVisibility();
		$this->approval_status_in_sub2->setVisibility();
		$this->direction_in_file_sub2->Visible = FALSE;
		$this->transmit_date_in_sub2->setVisibility();
		$this->submit_no_sub3->setVisibility();
		$this->revision_no_sub3->setVisibility();
		$this->direction_out_sub3->setVisibility();
		$this->planned_date_out_sub3->setVisibility();
		$this->transmit_date_out_sub3->setVisibility();
		$this->transmit_no_out_sub3->setVisibility();
		$this->approval_status_out_sub3->setVisibility();
		$this->direction_out_file_sub3->Visible = FALSE;
		$this->direction_in_sub3->setVisibility();
		$this->transmit_no_in_sub3->setVisibility();
		$this->approval_status_in_sub3->setVisibility();
		$this->direction_in_file_sub3->Visible = FALSE;
		$this->transmit_date_in_sub3->setVisibility();
		$this->submit_no_sub4->setVisibility();
		$this->revision_no_sub4->setVisibility();
		$this->direction_out_sub4->setVisibility();
		$this->planned_date_out_sub4->setVisibility();
		$this->transmit_date_out_sub4->setVisibility();
		$this->transmit_no_out_sub4->setVisibility();
		$this->approval_status_out_sub4->setVisibility();
		$this->direction_out_file_sub4->Visible = FALSE;
		$this->direction_in_sub4->setVisibility();
		$this->transmit_no_in_sub4->setVisibility();
		$this->approval_status_in_sub4->setVisibility();
		$this->direction_in_file_sub4->setVisibility();
		$this->transmit_date_in_sub4->setVisibility();
		$this->submit_no_sub5->setVisibility();
		$this->revision_no_sub5->setVisibility();
		$this->direction_out_sub5->setVisibility();
		$this->planned_date_out_sub5->setVisibility();
		$this->transmit_date_out_sub5->setVisibility();
		$this->transmit_no_out_sub5->setVisibility();
		$this->approval_status_out_sub5->setVisibility();
		$this->direction_out_file_sub5->Visible = FALSE;
		$this->direction_in_sub5->setVisibility();
		$this->transmit_no_in_sub5->setVisibility();
		$this->approval_status_in_sub5->setVisibility();
		$this->direction_in_file_sub5->setVisibility();
		$this->transmit_date_in_sub5->setVisibility();
		$this->submit_no_sub6->setVisibility();
		$this->revision_no_sub6->setVisibility();
		$this->direction_out_sub6->setVisibility();
		$this->planned_date_out_sub6->setVisibility();
		$this->transmit_date_out_sub6->setVisibility();
		$this->transmit_no_out_sub6->setVisibility();
		$this->approval_status_out_sub6->setVisibility();
		$this->direction_out_file_sub6->Visible = FALSE;
		$this->direction_in_sub6->setVisibility();
		$this->transmit_no_in_sub6->setVisibility();
		$this->approval_status_in_sub6->setVisibility();
		$this->direction_in_file_sub6->setVisibility();
		$this->transmit_date_in_sub6->setVisibility();
		$this->submit_no_sub7->setVisibility();
		$this->revision_no_sub7->setVisibility();
		$this->direction_out_sub7->setVisibility();
		$this->planned_date_out_sub7->setVisibility();
		$this->transmit_date_out_sub7->setVisibility();
		$this->transmit_no_out_sub7->setVisibility();
		$this->approval_status_out_sub7->setVisibility();
		$this->direction_out_file_sub7->Visible = FALSE;
		$this->direction_in_sub7->setVisibility();
		$this->transmit_no_in_sub7->setVisibility();
		$this->approval_status_in_sub7->setVisibility();
		$this->direction_in_file_sub7->Visible = FALSE;
		$this->transmit_date_in_sub7->setVisibility();
		$this->submit_no_sub8->setVisibility();
		$this->revision_no_sub8->setVisibility();
		$this->direction_out_sub8->setVisibility();
		$this->planned_date_out_sub8->setVisibility();
		$this->transmit_date_out_sub8->setVisibility();
		$this->transmit_no_out_sub8->setVisibility();
		$this->approval_status_out_sub8->setVisibility();
		$this->direction_out_file_sub8->setVisibility();
		$this->direction_in_sub8->setVisibility();
		$this->transmit_no_in_sub8->setVisibility();
		$this->approval_status_in_sub8->setVisibility();
		$this->direction_in_file_sub8->Visible = FALSE;
		$this->transmit_date_in_sub8->setVisibility();
		$this->submit_no_sub9->setVisibility();
		$this->revision_no_sub9->setVisibility();
		$this->direction_out_sub9->setVisibility();
		$this->planned_date_out_sub9->setVisibility();
		$this->transmit_date_out_sub9->setVisibility();
		$this->transmit_no_out_sub9->setVisibility();
		$this->approval_status_out_sub9->setVisibility();
		$this->direction_out_file_sub9->Visible = FALSE;
		$this->direction_in_sub9->setVisibility();
		$this->transmit_no_in_sub9->setVisibility();
		$this->approval_status_in_sub9->setVisibility();
		$this->direction_in_file_sub9->Visible = FALSE;
		$this->transmit_date_in_sub9->setVisibility();
		$this->submit_no_sub10->setVisibility();
		$this->revision_no_sub10->setVisibility();
		$this->direction_out_sub10->setVisibility();
		$this->planned_date_out_sub10->setVisibility();
		$this->transmit_date_out_sub10->setVisibility();
		$this->transmit_no_out_sub10->setVisibility();
		$this->approval_status_out_sub10->setVisibility();
		$this->direction_out_file_sub10->Visible = FALSE;
		$this->direction_in_sub10->setVisibility();
		$this->transmit_no_in_sub10->setVisibility();
		$this->approval_status_in_sub10->setVisibility();
		$this->direction_in_file_sub10->Visible = FALSE;
		$this->transmit_date_in_sub10->setVisibility();
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
			$this->DisplayRecs = 25; // Load default
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

			// Audit trail on search
			if ($this->AuditTrailOnSearch && $this->Command == "search" && !$this->RestoreSearch) {
				$searchParm = ServerVar("QUERY_STRING");
				$searchSql = $this->getSessionWhere();
				$this->writeAuditTrailOnSearch($searchParm, $searchSql);
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
		$filterList = Concat($filterList, $this->log_id->AdvancedSearch->toJson(), ","); // Field log_id
		$filterList = Concat($filterList, $this->firelink_doc_no->AdvancedSearch->toJson(), ","); // Field firelink_doc_no
		$filterList = Concat($filterList, $this->client_doc_no->AdvancedSearch->toJson(), ","); // Field client_doc_no
		$filterList = Concat($filterList, $this->order_number->AdvancedSearch->toJson(), ","); // Field order_number
		$filterList = Concat($filterList, $this->project_name->AdvancedSearch->toJson(), ","); // Field project_name
		$filterList = Concat($filterList, $this->document_tittle->AdvancedSearch->toJson(), ","); // Field document_tittle
		$filterList = Concat($filterList, $this->current_status->AdvancedSearch->toJson(), ","); // Field current_status
		$filterList = Concat($filterList, $this->current_status_file->AdvancedSearch->toJson(), ","); // Field current_status_file
		$filterList = Concat($filterList, $this->submit_no_sub1->AdvancedSearch->toJson(), ","); // Field submit_no_sub1
		$filterList = Concat($filterList, $this->revision_no_sub1->AdvancedSearch->toJson(), ","); // Field revision_no_sub1
		$filterList = Concat($filterList, $this->direction_out_sub1->AdvancedSearch->toJson(), ","); // Field direction_out_sub1
		$filterList = Concat($filterList, $this->planned_date_out_sub1->AdvancedSearch->toJson(), ","); // Field planned_date_out_sub1
		$filterList = Concat($filterList, $this->transmit_date_out_sub1->AdvancedSearch->toJson(), ","); // Field transmit_date_out_sub1
		$filterList = Concat($filterList, $this->transmit_no_out_sub1->AdvancedSearch->toJson(), ","); // Field transmit_no_out_sub1
		$filterList = Concat($filterList, $this->approval_status_out_sub1->AdvancedSearch->toJson(), ","); // Field approval_status_out_sub1
		$filterList = Concat($filterList, $this->direction_in_sub1->AdvancedSearch->toJson(), ","); // Field direction_in_sub1
		$filterList = Concat($filterList, $this->transmit_no_in_sub1->AdvancedSearch->toJson(), ","); // Field transmit_no_in_sub1
		$filterList = Concat($filterList, $this->approval_status_in_sub1->AdvancedSearch->toJson(), ","); // Field approval_status_in_sub1
		$filterList = Concat($filterList, $this->transmit_date_in_sub1->AdvancedSearch->toJson(), ","); // Field transmit_date_in_sub1
		$filterList = Concat($filterList, $this->submit_no_sub2->AdvancedSearch->toJson(), ","); // Field submit_no_sub2
		$filterList = Concat($filterList, $this->revision_no_sub2->AdvancedSearch->toJson(), ","); // Field revision_no_sub2
		$filterList = Concat($filterList, $this->direction_out_sub2->AdvancedSearch->toJson(), ","); // Field direction_out_sub2
		$filterList = Concat($filterList, $this->planned_date_out_sub2->AdvancedSearch->toJson(), ","); // Field planned_date_out_sub2
		$filterList = Concat($filterList, $this->transmit_date_out_sub2->AdvancedSearch->toJson(), ","); // Field transmit_date_out_sub2
		$filterList = Concat($filterList, $this->transmit_no_out_sub2->AdvancedSearch->toJson(), ","); // Field transmit_no_out_sub2
		$filterList = Concat($filterList, $this->approval_status_out_sub2->AdvancedSearch->toJson(), ","); // Field approval_status_out_sub2
		$filterList = Concat($filterList, $this->direction_in_sub2->AdvancedSearch->toJson(), ","); // Field direction_in_sub2
		$filterList = Concat($filterList, $this->transmit_no_in_sub2->AdvancedSearch->toJson(), ","); // Field transmit_no_in_sub2
		$filterList = Concat($filterList, $this->approval_status_in_sub2->AdvancedSearch->toJson(), ","); // Field approval_status_in_sub2
		$filterList = Concat($filterList, $this->transmit_date_in_sub2->AdvancedSearch->toJson(), ","); // Field transmit_date_in_sub2
		$filterList = Concat($filterList, $this->submit_no_sub3->AdvancedSearch->toJson(), ","); // Field submit_no_sub3
		$filterList = Concat($filterList, $this->revision_no_sub3->AdvancedSearch->toJson(), ","); // Field revision_no_sub3
		$filterList = Concat($filterList, $this->direction_out_sub3->AdvancedSearch->toJson(), ","); // Field direction_out_sub3
		$filterList = Concat($filterList, $this->planned_date_out_sub3->AdvancedSearch->toJson(), ","); // Field planned_date_out_sub3
		$filterList = Concat($filterList, $this->transmit_date_out_sub3->AdvancedSearch->toJson(), ","); // Field transmit_date_out_sub3
		$filterList = Concat($filterList, $this->transmit_no_out_sub3->AdvancedSearch->toJson(), ","); // Field transmit_no_out_sub3
		$filterList = Concat($filterList, $this->approval_status_out_sub3->AdvancedSearch->toJson(), ","); // Field approval_status_out_sub3
		$filterList = Concat($filterList, $this->direction_in_sub3->AdvancedSearch->toJson(), ","); // Field direction_in_sub3
		$filterList = Concat($filterList, $this->transmit_no_in_sub3->AdvancedSearch->toJson(), ","); // Field transmit_no_in_sub3
		$filterList = Concat($filterList, $this->approval_status_in_sub3->AdvancedSearch->toJson(), ","); // Field approval_status_in_sub3
		$filterList = Concat($filterList, $this->transmit_date_in_sub3->AdvancedSearch->toJson(), ","); // Field transmit_date_in_sub3
		$filterList = Concat($filterList, $this->submit_no_sub4->AdvancedSearch->toJson(), ","); // Field submit_no_sub4
		$filterList = Concat($filterList, $this->revision_no_sub4->AdvancedSearch->toJson(), ","); // Field revision_no_sub4
		$filterList = Concat($filterList, $this->direction_out_sub4->AdvancedSearch->toJson(), ","); // Field direction_out_sub4
		$filterList = Concat($filterList, $this->planned_date_out_sub4->AdvancedSearch->toJson(), ","); // Field planned_date_out_sub4
		$filterList = Concat($filterList, $this->transmit_date_out_sub4->AdvancedSearch->toJson(), ","); // Field transmit_date_out_sub4
		$filterList = Concat($filterList, $this->transmit_no_out_sub4->AdvancedSearch->toJson(), ","); // Field transmit_no_out_sub4
		$filterList = Concat($filterList, $this->approval_status_out_sub4->AdvancedSearch->toJson(), ","); // Field approval_status_out_sub4
		$filterList = Concat($filterList, $this->direction_in_sub4->AdvancedSearch->toJson(), ","); // Field direction_in_sub4
		$filterList = Concat($filterList, $this->transmit_no_in_sub4->AdvancedSearch->toJson(), ","); // Field transmit_no_in_sub4
		$filterList = Concat($filterList, $this->approval_status_in_sub4->AdvancedSearch->toJson(), ","); // Field approval_status_in_sub4
		$filterList = Concat($filterList, $this->direction_in_file_sub4->AdvancedSearch->toJson(), ","); // Field direction_in_file_sub4
		$filterList = Concat($filterList, $this->transmit_date_in_sub4->AdvancedSearch->toJson(), ","); // Field transmit_date_in_sub4
		$filterList = Concat($filterList, $this->submit_no_sub5->AdvancedSearch->toJson(), ","); // Field submit_no_sub5
		$filterList = Concat($filterList, $this->revision_no_sub5->AdvancedSearch->toJson(), ","); // Field revision_no_sub5
		$filterList = Concat($filterList, $this->direction_out_sub5->AdvancedSearch->toJson(), ","); // Field direction_out_sub5
		$filterList = Concat($filterList, $this->planned_date_out_sub5->AdvancedSearch->toJson(), ","); // Field planned_date_out_sub5
		$filterList = Concat($filterList, $this->transmit_date_out_sub5->AdvancedSearch->toJson(), ","); // Field transmit_date_out_sub5
		$filterList = Concat($filterList, $this->transmit_no_out_sub5->AdvancedSearch->toJson(), ","); // Field transmit_no_out_sub5
		$filterList = Concat($filterList, $this->approval_status_out_sub5->AdvancedSearch->toJson(), ","); // Field approval_status_out_sub5
		$filterList = Concat($filterList, $this->direction_in_sub5->AdvancedSearch->toJson(), ","); // Field direction_in_sub5
		$filterList = Concat($filterList, $this->transmit_no_in_sub5->AdvancedSearch->toJson(), ","); // Field transmit_no_in_sub5
		$filterList = Concat($filterList, $this->approval_status_in_sub5->AdvancedSearch->toJson(), ","); // Field approval_status_in_sub5
		$filterList = Concat($filterList, $this->direction_in_file_sub5->AdvancedSearch->toJson(), ","); // Field direction_in_file_sub5
		$filterList = Concat($filterList, $this->transmit_date_in_sub5->AdvancedSearch->toJson(), ","); // Field transmit_date_in_sub5
		$filterList = Concat($filterList, $this->submit_no_sub6->AdvancedSearch->toJson(), ","); // Field submit_no_sub6
		$filterList = Concat($filterList, $this->revision_no_sub6->AdvancedSearch->toJson(), ","); // Field revision_no_sub6
		$filterList = Concat($filterList, $this->direction_out_sub6->AdvancedSearch->toJson(), ","); // Field direction_out_sub6
		$filterList = Concat($filterList, $this->planned_date_out_sub6->AdvancedSearch->toJson(), ","); // Field planned_date_out_sub6
		$filterList = Concat($filterList, $this->transmit_date_out_sub6->AdvancedSearch->toJson(), ","); // Field transmit_date_out_sub6
		$filterList = Concat($filterList, $this->transmit_no_out_sub6->AdvancedSearch->toJson(), ","); // Field transmit_no_out_sub6
		$filterList = Concat($filterList, $this->approval_status_out_sub6->AdvancedSearch->toJson(), ","); // Field approval_status_out_sub6
		$filterList = Concat($filterList, $this->direction_in_sub6->AdvancedSearch->toJson(), ","); // Field direction_in_sub6
		$filterList = Concat($filterList, $this->transmit_no_in_sub6->AdvancedSearch->toJson(), ","); // Field transmit_no_in_sub6
		$filterList = Concat($filterList, $this->approval_status_in_sub6->AdvancedSearch->toJson(), ","); // Field approval_status_in_sub6
		$filterList = Concat($filterList, $this->direction_in_file_sub6->AdvancedSearch->toJson(), ","); // Field direction_in_file_sub6
		$filterList = Concat($filterList, $this->transmit_date_in_sub6->AdvancedSearch->toJson(), ","); // Field transmit_date_in_sub6
		$filterList = Concat($filterList, $this->submit_no_sub7->AdvancedSearch->toJson(), ","); // Field submit_no_sub7
		$filterList = Concat($filterList, $this->revision_no_sub7->AdvancedSearch->toJson(), ","); // Field revision_no_sub7
		$filterList = Concat($filterList, $this->direction_out_sub7->AdvancedSearch->toJson(), ","); // Field direction_out_sub7
		$filterList = Concat($filterList, $this->planned_date_out_sub7->AdvancedSearch->toJson(), ","); // Field planned_date_out_sub7
		$filterList = Concat($filterList, $this->transmit_date_out_sub7->AdvancedSearch->toJson(), ","); // Field transmit_date_out_sub7
		$filterList = Concat($filterList, $this->transmit_no_out_sub7->AdvancedSearch->toJson(), ","); // Field transmit_no_out_sub7
		$filterList = Concat($filterList, $this->approval_status_out_sub7->AdvancedSearch->toJson(), ","); // Field approval_status_out_sub7
		$filterList = Concat($filterList, $this->direction_in_sub7->AdvancedSearch->toJson(), ","); // Field direction_in_sub7
		$filterList = Concat($filterList, $this->transmit_no_in_sub7->AdvancedSearch->toJson(), ","); // Field transmit_no_in_sub7
		$filterList = Concat($filterList, $this->approval_status_in_sub7->AdvancedSearch->toJson(), ","); // Field approval_status_in_sub7
		$filterList = Concat($filterList, $this->transmit_date_in_sub7->AdvancedSearch->toJson(), ","); // Field transmit_date_in_sub7
		$filterList = Concat($filterList, $this->submit_no_sub8->AdvancedSearch->toJson(), ","); // Field submit_no_sub8
		$filterList = Concat($filterList, $this->revision_no_sub8->AdvancedSearch->toJson(), ","); // Field revision_no_sub8
		$filterList = Concat($filterList, $this->direction_out_sub8->AdvancedSearch->toJson(), ","); // Field direction_out_sub8
		$filterList = Concat($filterList, $this->planned_date_out_sub8->AdvancedSearch->toJson(), ","); // Field planned_date_out_sub8
		$filterList = Concat($filterList, $this->transmit_date_out_sub8->AdvancedSearch->toJson(), ","); // Field transmit_date_out_sub8
		$filterList = Concat($filterList, $this->transmit_no_out_sub8->AdvancedSearch->toJson(), ","); // Field transmit_no_out_sub8
		$filterList = Concat($filterList, $this->approval_status_out_sub8->AdvancedSearch->toJson(), ","); // Field approval_status_out_sub8
		$filterList = Concat($filterList, $this->direction_out_file_sub8->AdvancedSearch->toJson(), ","); // Field direction_out_file_sub8
		$filterList = Concat($filterList, $this->direction_in_sub8->AdvancedSearch->toJson(), ","); // Field direction_in_sub8
		$filterList = Concat($filterList, $this->transmit_no_in_sub8->AdvancedSearch->toJson(), ","); // Field transmit_no_in_sub8
		$filterList = Concat($filterList, $this->approval_status_in_sub8->AdvancedSearch->toJson(), ","); // Field approval_status_in_sub8
		$filterList = Concat($filterList, $this->transmit_date_in_sub8->AdvancedSearch->toJson(), ","); // Field transmit_date_in_sub8
		$filterList = Concat($filterList, $this->submit_no_sub9->AdvancedSearch->toJson(), ","); // Field submit_no_sub9
		$filterList = Concat($filterList, $this->revision_no_sub9->AdvancedSearch->toJson(), ","); // Field revision_no_sub9
		$filterList = Concat($filterList, $this->direction_out_sub9->AdvancedSearch->toJson(), ","); // Field direction_out_sub9
		$filterList = Concat($filterList, $this->planned_date_out_sub9->AdvancedSearch->toJson(), ","); // Field planned_date_out_sub9
		$filterList = Concat($filterList, $this->transmit_date_out_sub9->AdvancedSearch->toJson(), ","); // Field transmit_date_out_sub9
		$filterList = Concat($filterList, $this->transmit_no_out_sub9->AdvancedSearch->toJson(), ","); // Field transmit_no_out_sub9
		$filterList = Concat($filterList, $this->approval_status_out_sub9->AdvancedSearch->toJson(), ","); // Field approval_status_out_sub9
		$filterList = Concat($filterList, $this->direction_in_sub9->AdvancedSearch->toJson(), ","); // Field direction_in_sub9
		$filterList = Concat($filterList, $this->transmit_no_in_sub9->AdvancedSearch->toJson(), ","); // Field transmit_no_in_sub9
		$filterList = Concat($filterList, $this->approval_status_in_sub9->AdvancedSearch->toJson(), ","); // Field approval_status_in_sub9
		$filterList = Concat($filterList, $this->transmit_date_in_sub9->AdvancedSearch->toJson(), ","); // Field transmit_date_in_sub9
		$filterList = Concat($filterList, $this->submit_no_sub10->AdvancedSearch->toJson(), ","); // Field submit_no_sub10
		$filterList = Concat($filterList, $this->revision_no_sub10->AdvancedSearch->toJson(), ","); // Field revision_no_sub10
		$filterList = Concat($filterList, $this->direction_out_sub10->AdvancedSearch->toJson(), ","); // Field direction_out_sub10
		$filterList = Concat($filterList, $this->planned_date_out_sub10->AdvancedSearch->toJson(), ","); // Field planned_date_out_sub10
		$filterList = Concat($filterList, $this->transmit_date_out_sub10->AdvancedSearch->toJson(), ","); // Field transmit_date_out_sub10
		$filterList = Concat($filterList, $this->transmit_no_out_sub10->AdvancedSearch->toJson(), ","); // Field transmit_no_out_sub10
		$filterList = Concat($filterList, $this->approval_status_out_sub10->AdvancedSearch->toJson(), ","); // Field approval_status_out_sub10
		$filterList = Concat($filterList, $this->direction_in_sub10->AdvancedSearch->toJson(), ","); // Field direction_in_sub10
		$filterList = Concat($filterList, $this->transmit_no_in_sub10->AdvancedSearch->toJson(), ","); // Field transmit_no_in_sub10
		$filterList = Concat($filterList, $this->approval_status_in_sub10->AdvancedSearch->toJson(), ","); // Field approval_status_in_sub10
		$filterList = Concat($filterList, $this->transmit_date_in_sub10->AdvancedSearch->toJson(), ","); // Field transmit_date_in_sub10
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

		// Field log_id
		$this->log_id->AdvancedSearch->SearchValue = @$filter["x_log_id"];
		$this->log_id->AdvancedSearch->SearchOperator = @$filter["z_log_id"];
		$this->log_id->AdvancedSearch->SearchCondition = @$filter["v_log_id"];
		$this->log_id->AdvancedSearch->SearchValue2 = @$filter["y_log_id"];
		$this->log_id->AdvancedSearch->SearchOperator2 = @$filter["w_log_id"];
		$this->log_id->AdvancedSearch->save();

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

		// Field current_status_file
		$this->current_status_file->AdvancedSearch->SearchValue = @$filter["x_current_status_file"];
		$this->current_status_file->AdvancedSearch->SearchOperator = @$filter["z_current_status_file"];
		$this->current_status_file->AdvancedSearch->SearchCondition = @$filter["v_current_status_file"];
		$this->current_status_file->AdvancedSearch->SearchValue2 = @$filter["y_current_status_file"];
		$this->current_status_file->AdvancedSearch->SearchOperator2 = @$filter["w_current_status_file"];
		$this->current_status_file->AdvancedSearch->save();

		// Field submit_no_sub1
		$this->submit_no_sub1->AdvancedSearch->SearchValue = @$filter["x_submit_no_sub1"];
		$this->submit_no_sub1->AdvancedSearch->SearchOperator = @$filter["z_submit_no_sub1"];
		$this->submit_no_sub1->AdvancedSearch->SearchCondition = @$filter["v_submit_no_sub1"];
		$this->submit_no_sub1->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_sub1"];
		$this->submit_no_sub1->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_sub1"];
		$this->submit_no_sub1->AdvancedSearch->save();

		// Field revision_no_sub1
		$this->revision_no_sub1->AdvancedSearch->SearchValue = @$filter["x_revision_no_sub1"];
		$this->revision_no_sub1->AdvancedSearch->SearchOperator = @$filter["z_revision_no_sub1"];
		$this->revision_no_sub1->AdvancedSearch->SearchCondition = @$filter["v_revision_no_sub1"];
		$this->revision_no_sub1->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_sub1"];
		$this->revision_no_sub1->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_sub1"];
		$this->revision_no_sub1->AdvancedSearch->save();

		// Field direction_out_sub1
		$this->direction_out_sub1->AdvancedSearch->SearchValue = @$filter["x_direction_out_sub1"];
		$this->direction_out_sub1->AdvancedSearch->SearchOperator = @$filter["z_direction_out_sub1"];
		$this->direction_out_sub1->AdvancedSearch->SearchCondition = @$filter["v_direction_out_sub1"];
		$this->direction_out_sub1->AdvancedSearch->SearchValue2 = @$filter["y_direction_out_sub1"];
		$this->direction_out_sub1->AdvancedSearch->SearchOperator2 = @$filter["w_direction_out_sub1"];
		$this->direction_out_sub1->AdvancedSearch->save();

		// Field planned_date_out_sub1
		$this->planned_date_out_sub1->AdvancedSearch->SearchValue = @$filter["x_planned_date_out_sub1"];
		$this->planned_date_out_sub1->AdvancedSearch->SearchOperator = @$filter["z_planned_date_out_sub1"];
		$this->planned_date_out_sub1->AdvancedSearch->SearchCondition = @$filter["v_planned_date_out_sub1"];
		$this->planned_date_out_sub1->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_out_sub1"];
		$this->planned_date_out_sub1->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_out_sub1"];
		$this->planned_date_out_sub1->AdvancedSearch->save();

		// Field transmit_date_out_sub1
		$this->transmit_date_out_sub1->AdvancedSearch->SearchValue = @$filter["x_transmit_date_out_sub1"];
		$this->transmit_date_out_sub1->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_out_sub1"];
		$this->transmit_date_out_sub1->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_out_sub1"];
		$this->transmit_date_out_sub1->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_out_sub1"];
		$this->transmit_date_out_sub1->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_out_sub1"];
		$this->transmit_date_out_sub1->AdvancedSearch->save();

		// Field transmit_no_out_sub1
		$this->transmit_no_out_sub1->AdvancedSearch->SearchValue = @$filter["x_transmit_no_out_sub1"];
		$this->transmit_no_out_sub1->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_out_sub1"];
		$this->transmit_no_out_sub1->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_out_sub1"];
		$this->transmit_no_out_sub1->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_out_sub1"];
		$this->transmit_no_out_sub1->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_out_sub1"];
		$this->transmit_no_out_sub1->AdvancedSearch->save();

		// Field approval_status_out_sub1
		$this->approval_status_out_sub1->AdvancedSearch->SearchValue = @$filter["x_approval_status_out_sub1"];
		$this->approval_status_out_sub1->AdvancedSearch->SearchOperator = @$filter["z_approval_status_out_sub1"];
		$this->approval_status_out_sub1->AdvancedSearch->SearchCondition = @$filter["v_approval_status_out_sub1"];
		$this->approval_status_out_sub1->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_out_sub1"];
		$this->approval_status_out_sub1->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_out_sub1"];
		$this->approval_status_out_sub1->AdvancedSearch->save();

		// Field direction_in_sub1
		$this->direction_in_sub1->AdvancedSearch->SearchValue = @$filter["x_direction_in_sub1"];
		$this->direction_in_sub1->AdvancedSearch->SearchOperator = @$filter["z_direction_in_sub1"];
		$this->direction_in_sub1->AdvancedSearch->SearchCondition = @$filter["v_direction_in_sub1"];
		$this->direction_in_sub1->AdvancedSearch->SearchValue2 = @$filter["y_direction_in_sub1"];
		$this->direction_in_sub1->AdvancedSearch->SearchOperator2 = @$filter["w_direction_in_sub1"];
		$this->direction_in_sub1->AdvancedSearch->save();

		// Field transmit_no_in_sub1
		$this->transmit_no_in_sub1->AdvancedSearch->SearchValue = @$filter["x_transmit_no_in_sub1"];
		$this->transmit_no_in_sub1->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_in_sub1"];
		$this->transmit_no_in_sub1->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_in_sub1"];
		$this->transmit_no_in_sub1->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_in_sub1"];
		$this->transmit_no_in_sub1->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_in_sub1"];
		$this->transmit_no_in_sub1->AdvancedSearch->save();

		// Field approval_status_in_sub1
		$this->approval_status_in_sub1->AdvancedSearch->SearchValue = @$filter["x_approval_status_in_sub1"];
		$this->approval_status_in_sub1->AdvancedSearch->SearchOperator = @$filter["z_approval_status_in_sub1"];
		$this->approval_status_in_sub1->AdvancedSearch->SearchCondition = @$filter["v_approval_status_in_sub1"];
		$this->approval_status_in_sub1->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_in_sub1"];
		$this->approval_status_in_sub1->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_in_sub1"];
		$this->approval_status_in_sub1->AdvancedSearch->save();

		// Field transmit_date_in_sub1
		$this->transmit_date_in_sub1->AdvancedSearch->SearchValue = @$filter["x_transmit_date_in_sub1"];
		$this->transmit_date_in_sub1->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_in_sub1"];
		$this->transmit_date_in_sub1->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_in_sub1"];
		$this->transmit_date_in_sub1->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_in_sub1"];
		$this->transmit_date_in_sub1->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_in_sub1"];
		$this->transmit_date_in_sub1->AdvancedSearch->save();

		// Field submit_no_sub2
		$this->submit_no_sub2->AdvancedSearch->SearchValue = @$filter["x_submit_no_sub2"];
		$this->submit_no_sub2->AdvancedSearch->SearchOperator = @$filter["z_submit_no_sub2"];
		$this->submit_no_sub2->AdvancedSearch->SearchCondition = @$filter["v_submit_no_sub2"];
		$this->submit_no_sub2->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_sub2"];
		$this->submit_no_sub2->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_sub2"];
		$this->submit_no_sub2->AdvancedSearch->save();

		// Field revision_no_sub2
		$this->revision_no_sub2->AdvancedSearch->SearchValue = @$filter["x_revision_no_sub2"];
		$this->revision_no_sub2->AdvancedSearch->SearchOperator = @$filter["z_revision_no_sub2"];
		$this->revision_no_sub2->AdvancedSearch->SearchCondition = @$filter["v_revision_no_sub2"];
		$this->revision_no_sub2->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_sub2"];
		$this->revision_no_sub2->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_sub2"];
		$this->revision_no_sub2->AdvancedSearch->save();

		// Field direction_out_sub2
		$this->direction_out_sub2->AdvancedSearch->SearchValue = @$filter["x_direction_out_sub2"];
		$this->direction_out_sub2->AdvancedSearch->SearchOperator = @$filter["z_direction_out_sub2"];
		$this->direction_out_sub2->AdvancedSearch->SearchCondition = @$filter["v_direction_out_sub2"];
		$this->direction_out_sub2->AdvancedSearch->SearchValue2 = @$filter["y_direction_out_sub2"];
		$this->direction_out_sub2->AdvancedSearch->SearchOperator2 = @$filter["w_direction_out_sub2"];
		$this->direction_out_sub2->AdvancedSearch->save();

		// Field planned_date_out_sub2
		$this->planned_date_out_sub2->AdvancedSearch->SearchValue = @$filter["x_planned_date_out_sub2"];
		$this->planned_date_out_sub2->AdvancedSearch->SearchOperator = @$filter["z_planned_date_out_sub2"];
		$this->planned_date_out_sub2->AdvancedSearch->SearchCondition = @$filter["v_planned_date_out_sub2"];
		$this->planned_date_out_sub2->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_out_sub2"];
		$this->planned_date_out_sub2->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_out_sub2"];
		$this->planned_date_out_sub2->AdvancedSearch->save();

		// Field transmit_date_out_sub2
		$this->transmit_date_out_sub2->AdvancedSearch->SearchValue = @$filter["x_transmit_date_out_sub2"];
		$this->transmit_date_out_sub2->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_out_sub2"];
		$this->transmit_date_out_sub2->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_out_sub2"];
		$this->transmit_date_out_sub2->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_out_sub2"];
		$this->transmit_date_out_sub2->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_out_sub2"];
		$this->transmit_date_out_sub2->AdvancedSearch->save();

		// Field transmit_no_out_sub2
		$this->transmit_no_out_sub2->AdvancedSearch->SearchValue = @$filter["x_transmit_no_out_sub2"];
		$this->transmit_no_out_sub2->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_out_sub2"];
		$this->transmit_no_out_sub2->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_out_sub2"];
		$this->transmit_no_out_sub2->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_out_sub2"];
		$this->transmit_no_out_sub2->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_out_sub2"];
		$this->transmit_no_out_sub2->AdvancedSearch->save();

		// Field approval_status_out_sub2
		$this->approval_status_out_sub2->AdvancedSearch->SearchValue = @$filter["x_approval_status_out_sub2"];
		$this->approval_status_out_sub2->AdvancedSearch->SearchOperator = @$filter["z_approval_status_out_sub2"];
		$this->approval_status_out_sub2->AdvancedSearch->SearchCondition = @$filter["v_approval_status_out_sub2"];
		$this->approval_status_out_sub2->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_out_sub2"];
		$this->approval_status_out_sub2->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_out_sub2"];
		$this->approval_status_out_sub2->AdvancedSearch->save();

		// Field direction_in_sub2
		$this->direction_in_sub2->AdvancedSearch->SearchValue = @$filter["x_direction_in_sub2"];
		$this->direction_in_sub2->AdvancedSearch->SearchOperator = @$filter["z_direction_in_sub2"];
		$this->direction_in_sub2->AdvancedSearch->SearchCondition = @$filter["v_direction_in_sub2"];
		$this->direction_in_sub2->AdvancedSearch->SearchValue2 = @$filter["y_direction_in_sub2"];
		$this->direction_in_sub2->AdvancedSearch->SearchOperator2 = @$filter["w_direction_in_sub2"];
		$this->direction_in_sub2->AdvancedSearch->save();

		// Field transmit_no_in_sub2
		$this->transmit_no_in_sub2->AdvancedSearch->SearchValue = @$filter["x_transmit_no_in_sub2"];
		$this->transmit_no_in_sub2->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_in_sub2"];
		$this->transmit_no_in_sub2->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_in_sub2"];
		$this->transmit_no_in_sub2->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_in_sub2"];
		$this->transmit_no_in_sub2->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_in_sub2"];
		$this->transmit_no_in_sub2->AdvancedSearch->save();

		// Field approval_status_in_sub2
		$this->approval_status_in_sub2->AdvancedSearch->SearchValue = @$filter["x_approval_status_in_sub2"];
		$this->approval_status_in_sub2->AdvancedSearch->SearchOperator = @$filter["z_approval_status_in_sub2"];
		$this->approval_status_in_sub2->AdvancedSearch->SearchCondition = @$filter["v_approval_status_in_sub2"];
		$this->approval_status_in_sub2->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_in_sub2"];
		$this->approval_status_in_sub2->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_in_sub2"];
		$this->approval_status_in_sub2->AdvancedSearch->save();

		// Field transmit_date_in_sub2
		$this->transmit_date_in_sub2->AdvancedSearch->SearchValue = @$filter["x_transmit_date_in_sub2"];
		$this->transmit_date_in_sub2->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_in_sub2"];
		$this->transmit_date_in_sub2->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_in_sub2"];
		$this->transmit_date_in_sub2->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_in_sub2"];
		$this->transmit_date_in_sub2->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_in_sub2"];
		$this->transmit_date_in_sub2->AdvancedSearch->save();

		// Field submit_no_sub3
		$this->submit_no_sub3->AdvancedSearch->SearchValue = @$filter["x_submit_no_sub3"];
		$this->submit_no_sub3->AdvancedSearch->SearchOperator = @$filter["z_submit_no_sub3"];
		$this->submit_no_sub3->AdvancedSearch->SearchCondition = @$filter["v_submit_no_sub3"];
		$this->submit_no_sub3->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_sub3"];
		$this->submit_no_sub3->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_sub3"];
		$this->submit_no_sub3->AdvancedSearch->save();

		// Field revision_no_sub3
		$this->revision_no_sub3->AdvancedSearch->SearchValue = @$filter["x_revision_no_sub3"];
		$this->revision_no_sub3->AdvancedSearch->SearchOperator = @$filter["z_revision_no_sub3"];
		$this->revision_no_sub3->AdvancedSearch->SearchCondition = @$filter["v_revision_no_sub3"];
		$this->revision_no_sub3->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_sub3"];
		$this->revision_no_sub3->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_sub3"];
		$this->revision_no_sub3->AdvancedSearch->save();

		// Field direction_out_sub3
		$this->direction_out_sub3->AdvancedSearch->SearchValue = @$filter["x_direction_out_sub3"];
		$this->direction_out_sub3->AdvancedSearch->SearchOperator = @$filter["z_direction_out_sub3"];
		$this->direction_out_sub3->AdvancedSearch->SearchCondition = @$filter["v_direction_out_sub3"];
		$this->direction_out_sub3->AdvancedSearch->SearchValue2 = @$filter["y_direction_out_sub3"];
		$this->direction_out_sub3->AdvancedSearch->SearchOperator2 = @$filter["w_direction_out_sub3"];
		$this->direction_out_sub3->AdvancedSearch->save();

		// Field planned_date_out_sub3
		$this->planned_date_out_sub3->AdvancedSearch->SearchValue = @$filter["x_planned_date_out_sub3"];
		$this->planned_date_out_sub3->AdvancedSearch->SearchOperator = @$filter["z_planned_date_out_sub3"];
		$this->planned_date_out_sub3->AdvancedSearch->SearchCondition = @$filter["v_planned_date_out_sub3"];
		$this->planned_date_out_sub3->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_out_sub3"];
		$this->planned_date_out_sub3->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_out_sub3"];
		$this->planned_date_out_sub3->AdvancedSearch->save();

		// Field transmit_date_out_sub3
		$this->transmit_date_out_sub3->AdvancedSearch->SearchValue = @$filter["x_transmit_date_out_sub3"];
		$this->transmit_date_out_sub3->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_out_sub3"];
		$this->transmit_date_out_sub3->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_out_sub3"];
		$this->transmit_date_out_sub3->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_out_sub3"];
		$this->transmit_date_out_sub3->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_out_sub3"];
		$this->transmit_date_out_sub3->AdvancedSearch->save();

		// Field transmit_no_out_sub3
		$this->transmit_no_out_sub3->AdvancedSearch->SearchValue = @$filter["x_transmit_no_out_sub3"];
		$this->transmit_no_out_sub3->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_out_sub3"];
		$this->transmit_no_out_sub3->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_out_sub3"];
		$this->transmit_no_out_sub3->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_out_sub3"];
		$this->transmit_no_out_sub3->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_out_sub3"];
		$this->transmit_no_out_sub3->AdvancedSearch->save();

		// Field approval_status_out_sub3
		$this->approval_status_out_sub3->AdvancedSearch->SearchValue = @$filter["x_approval_status_out_sub3"];
		$this->approval_status_out_sub3->AdvancedSearch->SearchOperator = @$filter["z_approval_status_out_sub3"];
		$this->approval_status_out_sub3->AdvancedSearch->SearchCondition = @$filter["v_approval_status_out_sub3"];
		$this->approval_status_out_sub3->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_out_sub3"];
		$this->approval_status_out_sub3->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_out_sub3"];
		$this->approval_status_out_sub3->AdvancedSearch->save();

		// Field direction_in_sub3
		$this->direction_in_sub3->AdvancedSearch->SearchValue = @$filter["x_direction_in_sub3"];
		$this->direction_in_sub3->AdvancedSearch->SearchOperator = @$filter["z_direction_in_sub3"];
		$this->direction_in_sub3->AdvancedSearch->SearchCondition = @$filter["v_direction_in_sub3"];
		$this->direction_in_sub3->AdvancedSearch->SearchValue2 = @$filter["y_direction_in_sub3"];
		$this->direction_in_sub3->AdvancedSearch->SearchOperator2 = @$filter["w_direction_in_sub3"];
		$this->direction_in_sub3->AdvancedSearch->save();

		// Field transmit_no_in_sub3
		$this->transmit_no_in_sub3->AdvancedSearch->SearchValue = @$filter["x_transmit_no_in_sub3"];
		$this->transmit_no_in_sub3->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_in_sub3"];
		$this->transmit_no_in_sub3->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_in_sub3"];
		$this->transmit_no_in_sub3->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_in_sub3"];
		$this->transmit_no_in_sub3->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_in_sub3"];
		$this->transmit_no_in_sub3->AdvancedSearch->save();

		// Field approval_status_in_sub3
		$this->approval_status_in_sub3->AdvancedSearch->SearchValue = @$filter["x_approval_status_in_sub3"];
		$this->approval_status_in_sub3->AdvancedSearch->SearchOperator = @$filter["z_approval_status_in_sub3"];
		$this->approval_status_in_sub3->AdvancedSearch->SearchCondition = @$filter["v_approval_status_in_sub3"];
		$this->approval_status_in_sub3->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_in_sub3"];
		$this->approval_status_in_sub3->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_in_sub3"];
		$this->approval_status_in_sub3->AdvancedSearch->save();

		// Field transmit_date_in_sub3
		$this->transmit_date_in_sub3->AdvancedSearch->SearchValue = @$filter["x_transmit_date_in_sub3"];
		$this->transmit_date_in_sub3->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_in_sub3"];
		$this->transmit_date_in_sub3->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_in_sub3"];
		$this->transmit_date_in_sub3->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_in_sub3"];
		$this->transmit_date_in_sub3->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_in_sub3"];
		$this->transmit_date_in_sub3->AdvancedSearch->save();

		// Field submit_no_sub4
		$this->submit_no_sub4->AdvancedSearch->SearchValue = @$filter["x_submit_no_sub4"];
		$this->submit_no_sub4->AdvancedSearch->SearchOperator = @$filter["z_submit_no_sub4"];
		$this->submit_no_sub4->AdvancedSearch->SearchCondition = @$filter["v_submit_no_sub4"];
		$this->submit_no_sub4->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_sub4"];
		$this->submit_no_sub4->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_sub4"];
		$this->submit_no_sub4->AdvancedSearch->save();

		// Field revision_no_sub4
		$this->revision_no_sub4->AdvancedSearch->SearchValue = @$filter["x_revision_no_sub4"];
		$this->revision_no_sub4->AdvancedSearch->SearchOperator = @$filter["z_revision_no_sub4"];
		$this->revision_no_sub4->AdvancedSearch->SearchCondition = @$filter["v_revision_no_sub4"];
		$this->revision_no_sub4->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_sub4"];
		$this->revision_no_sub4->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_sub4"];
		$this->revision_no_sub4->AdvancedSearch->save();

		// Field direction_out_sub4
		$this->direction_out_sub4->AdvancedSearch->SearchValue = @$filter["x_direction_out_sub4"];
		$this->direction_out_sub4->AdvancedSearch->SearchOperator = @$filter["z_direction_out_sub4"];
		$this->direction_out_sub4->AdvancedSearch->SearchCondition = @$filter["v_direction_out_sub4"];
		$this->direction_out_sub4->AdvancedSearch->SearchValue2 = @$filter["y_direction_out_sub4"];
		$this->direction_out_sub4->AdvancedSearch->SearchOperator2 = @$filter["w_direction_out_sub4"];
		$this->direction_out_sub4->AdvancedSearch->save();

		// Field planned_date_out_sub4
		$this->planned_date_out_sub4->AdvancedSearch->SearchValue = @$filter["x_planned_date_out_sub4"];
		$this->planned_date_out_sub4->AdvancedSearch->SearchOperator = @$filter["z_planned_date_out_sub4"];
		$this->planned_date_out_sub4->AdvancedSearch->SearchCondition = @$filter["v_planned_date_out_sub4"];
		$this->planned_date_out_sub4->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_out_sub4"];
		$this->planned_date_out_sub4->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_out_sub4"];
		$this->planned_date_out_sub4->AdvancedSearch->save();

		// Field transmit_date_out_sub4
		$this->transmit_date_out_sub4->AdvancedSearch->SearchValue = @$filter["x_transmit_date_out_sub4"];
		$this->transmit_date_out_sub4->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_out_sub4"];
		$this->transmit_date_out_sub4->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_out_sub4"];
		$this->transmit_date_out_sub4->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_out_sub4"];
		$this->transmit_date_out_sub4->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_out_sub4"];
		$this->transmit_date_out_sub4->AdvancedSearch->save();

		// Field transmit_no_out_sub4
		$this->transmit_no_out_sub4->AdvancedSearch->SearchValue = @$filter["x_transmit_no_out_sub4"];
		$this->transmit_no_out_sub4->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_out_sub4"];
		$this->transmit_no_out_sub4->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_out_sub4"];
		$this->transmit_no_out_sub4->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_out_sub4"];
		$this->transmit_no_out_sub4->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_out_sub4"];
		$this->transmit_no_out_sub4->AdvancedSearch->save();

		// Field approval_status_out_sub4
		$this->approval_status_out_sub4->AdvancedSearch->SearchValue = @$filter["x_approval_status_out_sub4"];
		$this->approval_status_out_sub4->AdvancedSearch->SearchOperator = @$filter["z_approval_status_out_sub4"];
		$this->approval_status_out_sub4->AdvancedSearch->SearchCondition = @$filter["v_approval_status_out_sub4"];
		$this->approval_status_out_sub4->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_out_sub4"];
		$this->approval_status_out_sub4->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_out_sub4"];
		$this->approval_status_out_sub4->AdvancedSearch->save();

		// Field direction_in_sub4
		$this->direction_in_sub4->AdvancedSearch->SearchValue = @$filter["x_direction_in_sub4"];
		$this->direction_in_sub4->AdvancedSearch->SearchOperator = @$filter["z_direction_in_sub4"];
		$this->direction_in_sub4->AdvancedSearch->SearchCondition = @$filter["v_direction_in_sub4"];
		$this->direction_in_sub4->AdvancedSearch->SearchValue2 = @$filter["y_direction_in_sub4"];
		$this->direction_in_sub4->AdvancedSearch->SearchOperator2 = @$filter["w_direction_in_sub4"];
		$this->direction_in_sub4->AdvancedSearch->save();

		// Field transmit_no_in_sub4
		$this->transmit_no_in_sub4->AdvancedSearch->SearchValue = @$filter["x_transmit_no_in_sub4"];
		$this->transmit_no_in_sub4->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_in_sub4"];
		$this->transmit_no_in_sub4->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_in_sub4"];
		$this->transmit_no_in_sub4->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_in_sub4"];
		$this->transmit_no_in_sub4->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_in_sub4"];
		$this->transmit_no_in_sub4->AdvancedSearch->save();

		// Field approval_status_in_sub4
		$this->approval_status_in_sub4->AdvancedSearch->SearchValue = @$filter["x_approval_status_in_sub4"];
		$this->approval_status_in_sub4->AdvancedSearch->SearchOperator = @$filter["z_approval_status_in_sub4"];
		$this->approval_status_in_sub4->AdvancedSearch->SearchCondition = @$filter["v_approval_status_in_sub4"];
		$this->approval_status_in_sub4->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_in_sub4"];
		$this->approval_status_in_sub4->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_in_sub4"];
		$this->approval_status_in_sub4->AdvancedSearch->save();

		// Field direction_in_file_sub4
		$this->direction_in_file_sub4->AdvancedSearch->SearchValue = @$filter["x_direction_in_file_sub4"];
		$this->direction_in_file_sub4->AdvancedSearch->SearchOperator = @$filter["z_direction_in_file_sub4"];
		$this->direction_in_file_sub4->AdvancedSearch->SearchCondition = @$filter["v_direction_in_file_sub4"];
		$this->direction_in_file_sub4->AdvancedSearch->SearchValue2 = @$filter["y_direction_in_file_sub4"];
		$this->direction_in_file_sub4->AdvancedSearch->SearchOperator2 = @$filter["w_direction_in_file_sub4"];
		$this->direction_in_file_sub4->AdvancedSearch->save();

		// Field transmit_date_in_sub4
		$this->transmit_date_in_sub4->AdvancedSearch->SearchValue = @$filter["x_transmit_date_in_sub4"];
		$this->transmit_date_in_sub4->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_in_sub4"];
		$this->transmit_date_in_sub4->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_in_sub4"];
		$this->transmit_date_in_sub4->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_in_sub4"];
		$this->transmit_date_in_sub4->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_in_sub4"];
		$this->transmit_date_in_sub4->AdvancedSearch->save();

		// Field submit_no_sub5
		$this->submit_no_sub5->AdvancedSearch->SearchValue = @$filter["x_submit_no_sub5"];
		$this->submit_no_sub5->AdvancedSearch->SearchOperator = @$filter["z_submit_no_sub5"];
		$this->submit_no_sub5->AdvancedSearch->SearchCondition = @$filter["v_submit_no_sub5"];
		$this->submit_no_sub5->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_sub5"];
		$this->submit_no_sub5->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_sub5"];
		$this->submit_no_sub5->AdvancedSearch->save();

		// Field revision_no_sub5
		$this->revision_no_sub5->AdvancedSearch->SearchValue = @$filter["x_revision_no_sub5"];
		$this->revision_no_sub5->AdvancedSearch->SearchOperator = @$filter["z_revision_no_sub5"];
		$this->revision_no_sub5->AdvancedSearch->SearchCondition = @$filter["v_revision_no_sub5"];
		$this->revision_no_sub5->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_sub5"];
		$this->revision_no_sub5->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_sub5"];
		$this->revision_no_sub5->AdvancedSearch->save();

		// Field direction_out_sub5
		$this->direction_out_sub5->AdvancedSearch->SearchValue = @$filter["x_direction_out_sub5"];
		$this->direction_out_sub5->AdvancedSearch->SearchOperator = @$filter["z_direction_out_sub5"];
		$this->direction_out_sub5->AdvancedSearch->SearchCondition = @$filter["v_direction_out_sub5"];
		$this->direction_out_sub5->AdvancedSearch->SearchValue2 = @$filter["y_direction_out_sub5"];
		$this->direction_out_sub5->AdvancedSearch->SearchOperator2 = @$filter["w_direction_out_sub5"];
		$this->direction_out_sub5->AdvancedSearch->save();

		// Field planned_date_out_sub5
		$this->planned_date_out_sub5->AdvancedSearch->SearchValue = @$filter["x_planned_date_out_sub5"];
		$this->planned_date_out_sub5->AdvancedSearch->SearchOperator = @$filter["z_planned_date_out_sub5"];
		$this->planned_date_out_sub5->AdvancedSearch->SearchCondition = @$filter["v_planned_date_out_sub5"];
		$this->planned_date_out_sub5->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_out_sub5"];
		$this->planned_date_out_sub5->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_out_sub5"];
		$this->planned_date_out_sub5->AdvancedSearch->save();

		// Field transmit_date_out_sub5
		$this->transmit_date_out_sub5->AdvancedSearch->SearchValue = @$filter["x_transmit_date_out_sub5"];
		$this->transmit_date_out_sub5->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_out_sub5"];
		$this->transmit_date_out_sub5->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_out_sub5"];
		$this->transmit_date_out_sub5->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_out_sub5"];
		$this->transmit_date_out_sub5->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_out_sub5"];
		$this->transmit_date_out_sub5->AdvancedSearch->save();

		// Field transmit_no_out_sub5
		$this->transmit_no_out_sub5->AdvancedSearch->SearchValue = @$filter["x_transmit_no_out_sub5"];
		$this->transmit_no_out_sub5->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_out_sub5"];
		$this->transmit_no_out_sub5->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_out_sub5"];
		$this->transmit_no_out_sub5->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_out_sub5"];
		$this->transmit_no_out_sub5->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_out_sub5"];
		$this->transmit_no_out_sub5->AdvancedSearch->save();

		// Field approval_status_out_sub5
		$this->approval_status_out_sub5->AdvancedSearch->SearchValue = @$filter["x_approval_status_out_sub5"];
		$this->approval_status_out_sub5->AdvancedSearch->SearchOperator = @$filter["z_approval_status_out_sub5"];
		$this->approval_status_out_sub5->AdvancedSearch->SearchCondition = @$filter["v_approval_status_out_sub5"];
		$this->approval_status_out_sub5->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_out_sub5"];
		$this->approval_status_out_sub5->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_out_sub5"];
		$this->approval_status_out_sub5->AdvancedSearch->save();

		// Field direction_in_sub5
		$this->direction_in_sub5->AdvancedSearch->SearchValue = @$filter["x_direction_in_sub5"];
		$this->direction_in_sub5->AdvancedSearch->SearchOperator = @$filter["z_direction_in_sub5"];
		$this->direction_in_sub5->AdvancedSearch->SearchCondition = @$filter["v_direction_in_sub5"];
		$this->direction_in_sub5->AdvancedSearch->SearchValue2 = @$filter["y_direction_in_sub5"];
		$this->direction_in_sub5->AdvancedSearch->SearchOperator2 = @$filter["w_direction_in_sub5"];
		$this->direction_in_sub5->AdvancedSearch->save();

		// Field transmit_no_in_sub5
		$this->transmit_no_in_sub5->AdvancedSearch->SearchValue = @$filter["x_transmit_no_in_sub5"];
		$this->transmit_no_in_sub5->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_in_sub5"];
		$this->transmit_no_in_sub5->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_in_sub5"];
		$this->transmit_no_in_sub5->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_in_sub5"];
		$this->transmit_no_in_sub5->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_in_sub5"];
		$this->transmit_no_in_sub5->AdvancedSearch->save();

		// Field approval_status_in_sub5
		$this->approval_status_in_sub5->AdvancedSearch->SearchValue = @$filter["x_approval_status_in_sub5"];
		$this->approval_status_in_sub5->AdvancedSearch->SearchOperator = @$filter["z_approval_status_in_sub5"];
		$this->approval_status_in_sub5->AdvancedSearch->SearchCondition = @$filter["v_approval_status_in_sub5"];
		$this->approval_status_in_sub5->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_in_sub5"];
		$this->approval_status_in_sub5->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_in_sub5"];
		$this->approval_status_in_sub5->AdvancedSearch->save();

		// Field direction_in_file_sub5
		$this->direction_in_file_sub5->AdvancedSearch->SearchValue = @$filter["x_direction_in_file_sub5"];
		$this->direction_in_file_sub5->AdvancedSearch->SearchOperator = @$filter["z_direction_in_file_sub5"];
		$this->direction_in_file_sub5->AdvancedSearch->SearchCondition = @$filter["v_direction_in_file_sub5"];
		$this->direction_in_file_sub5->AdvancedSearch->SearchValue2 = @$filter["y_direction_in_file_sub5"];
		$this->direction_in_file_sub5->AdvancedSearch->SearchOperator2 = @$filter["w_direction_in_file_sub5"];
		$this->direction_in_file_sub5->AdvancedSearch->save();

		// Field transmit_date_in_sub5
		$this->transmit_date_in_sub5->AdvancedSearch->SearchValue = @$filter["x_transmit_date_in_sub5"];
		$this->transmit_date_in_sub5->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_in_sub5"];
		$this->transmit_date_in_sub5->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_in_sub5"];
		$this->transmit_date_in_sub5->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_in_sub5"];
		$this->transmit_date_in_sub5->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_in_sub5"];
		$this->transmit_date_in_sub5->AdvancedSearch->save();

		// Field submit_no_sub6
		$this->submit_no_sub6->AdvancedSearch->SearchValue = @$filter["x_submit_no_sub6"];
		$this->submit_no_sub6->AdvancedSearch->SearchOperator = @$filter["z_submit_no_sub6"];
		$this->submit_no_sub6->AdvancedSearch->SearchCondition = @$filter["v_submit_no_sub6"];
		$this->submit_no_sub6->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_sub6"];
		$this->submit_no_sub6->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_sub6"];
		$this->submit_no_sub6->AdvancedSearch->save();

		// Field revision_no_sub6
		$this->revision_no_sub6->AdvancedSearch->SearchValue = @$filter["x_revision_no_sub6"];
		$this->revision_no_sub6->AdvancedSearch->SearchOperator = @$filter["z_revision_no_sub6"];
		$this->revision_no_sub6->AdvancedSearch->SearchCondition = @$filter["v_revision_no_sub6"];
		$this->revision_no_sub6->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_sub6"];
		$this->revision_no_sub6->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_sub6"];
		$this->revision_no_sub6->AdvancedSearch->save();

		// Field direction_out_sub6
		$this->direction_out_sub6->AdvancedSearch->SearchValue = @$filter["x_direction_out_sub6"];
		$this->direction_out_sub6->AdvancedSearch->SearchOperator = @$filter["z_direction_out_sub6"];
		$this->direction_out_sub6->AdvancedSearch->SearchCondition = @$filter["v_direction_out_sub6"];
		$this->direction_out_sub6->AdvancedSearch->SearchValue2 = @$filter["y_direction_out_sub6"];
		$this->direction_out_sub6->AdvancedSearch->SearchOperator2 = @$filter["w_direction_out_sub6"];
		$this->direction_out_sub6->AdvancedSearch->save();

		// Field planned_date_out_sub6
		$this->planned_date_out_sub6->AdvancedSearch->SearchValue = @$filter["x_planned_date_out_sub6"];
		$this->planned_date_out_sub6->AdvancedSearch->SearchOperator = @$filter["z_planned_date_out_sub6"];
		$this->planned_date_out_sub6->AdvancedSearch->SearchCondition = @$filter["v_planned_date_out_sub6"];
		$this->planned_date_out_sub6->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_out_sub6"];
		$this->planned_date_out_sub6->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_out_sub6"];
		$this->planned_date_out_sub6->AdvancedSearch->save();

		// Field transmit_date_out_sub6
		$this->transmit_date_out_sub6->AdvancedSearch->SearchValue = @$filter["x_transmit_date_out_sub6"];
		$this->transmit_date_out_sub6->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_out_sub6"];
		$this->transmit_date_out_sub6->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_out_sub6"];
		$this->transmit_date_out_sub6->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_out_sub6"];
		$this->transmit_date_out_sub6->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_out_sub6"];
		$this->transmit_date_out_sub6->AdvancedSearch->save();

		// Field transmit_no_out_sub6
		$this->transmit_no_out_sub6->AdvancedSearch->SearchValue = @$filter["x_transmit_no_out_sub6"];
		$this->transmit_no_out_sub6->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_out_sub6"];
		$this->transmit_no_out_sub6->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_out_sub6"];
		$this->transmit_no_out_sub6->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_out_sub6"];
		$this->transmit_no_out_sub6->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_out_sub6"];
		$this->transmit_no_out_sub6->AdvancedSearch->save();

		// Field approval_status_out_sub6
		$this->approval_status_out_sub6->AdvancedSearch->SearchValue = @$filter["x_approval_status_out_sub6"];
		$this->approval_status_out_sub6->AdvancedSearch->SearchOperator = @$filter["z_approval_status_out_sub6"];
		$this->approval_status_out_sub6->AdvancedSearch->SearchCondition = @$filter["v_approval_status_out_sub6"];
		$this->approval_status_out_sub6->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_out_sub6"];
		$this->approval_status_out_sub6->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_out_sub6"];
		$this->approval_status_out_sub6->AdvancedSearch->save();

		// Field direction_in_sub6
		$this->direction_in_sub6->AdvancedSearch->SearchValue = @$filter["x_direction_in_sub6"];
		$this->direction_in_sub6->AdvancedSearch->SearchOperator = @$filter["z_direction_in_sub6"];
		$this->direction_in_sub6->AdvancedSearch->SearchCondition = @$filter["v_direction_in_sub6"];
		$this->direction_in_sub6->AdvancedSearch->SearchValue2 = @$filter["y_direction_in_sub6"];
		$this->direction_in_sub6->AdvancedSearch->SearchOperator2 = @$filter["w_direction_in_sub6"];
		$this->direction_in_sub6->AdvancedSearch->save();

		// Field transmit_no_in_sub6
		$this->transmit_no_in_sub6->AdvancedSearch->SearchValue = @$filter["x_transmit_no_in_sub6"];
		$this->transmit_no_in_sub6->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_in_sub6"];
		$this->transmit_no_in_sub6->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_in_sub6"];
		$this->transmit_no_in_sub6->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_in_sub6"];
		$this->transmit_no_in_sub6->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_in_sub6"];
		$this->transmit_no_in_sub6->AdvancedSearch->save();

		// Field approval_status_in_sub6
		$this->approval_status_in_sub6->AdvancedSearch->SearchValue = @$filter["x_approval_status_in_sub6"];
		$this->approval_status_in_sub6->AdvancedSearch->SearchOperator = @$filter["z_approval_status_in_sub6"];
		$this->approval_status_in_sub6->AdvancedSearch->SearchCondition = @$filter["v_approval_status_in_sub6"];
		$this->approval_status_in_sub6->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_in_sub6"];
		$this->approval_status_in_sub6->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_in_sub6"];
		$this->approval_status_in_sub6->AdvancedSearch->save();

		// Field direction_in_file_sub6
		$this->direction_in_file_sub6->AdvancedSearch->SearchValue = @$filter["x_direction_in_file_sub6"];
		$this->direction_in_file_sub6->AdvancedSearch->SearchOperator = @$filter["z_direction_in_file_sub6"];
		$this->direction_in_file_sub6->AdvancedSearch->SearchCondition = @$filter["v_direction_in_file_sub6"];
		$this->direction_in_file_sub6->AdvancedSearch->SearchValue2 = @$filter["y_direction_in_file_sub6"];
		$this->direction_in_file_sub6->AdvancedSearch->SearchOperator2 = @$filter["w_direction_in_file_sub6"];
		$this->direction_in_file_sub6->AdvancedSearch->save();

		// Field transmit_date_in_sub6
		$this->transmit_date_in_sub6->AdvancedSearch->SearchValue = @$filter["x_transmit_date_in_sub6"];
		$this->transmit_date_in_sub6->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_in_sub6"];
		$this->transmit_date_in_sub6->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_in_sub6"];
		$this->transmit_date_in_sub6->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_in_sub6"];
		$this->transmit_date_in_sub6->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_in_sub6"];
		$this->transmit_date_in_sub6->AdvancedSearch->save();

		// Field submit_no_sub7
		$this->submit_no_sub7->AdvancedSearch->SearchValue = @$filter["x_submit_no_sub7"];
		$this->submit_no_sub7->AdvancedSearch->SearchOperator = @$filter["z_submit_no_sub7"];
		$this->submit_no_sub7->AdvancedSearch->SearchCondition = @$filter["v_submit_no_sub7"];
		$this->submit_no_sub7->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_sub7"];
		$this->submit_no_sub7->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_sub7"];
		$this->submit_no_sub7->AdvancedSearch->save();

		// Field revision_no_sub7
		$this->revision_no_sub7->AdvancedSearch->SearchValue = @$filter["x_revision_no_sub7"];
		$this->revision_no_sub7->AdvancedSearch->SearchOperator = @$filter["z_revision_no_sub7"];
		$this->revision_no_sub7->AdvancedSearch->SearchCondition = @$filter["v_revision_no_sub7"];
		$this->revision_no_sub7->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_sub7"];
		$this->revision_no_sub7->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_sub7"];
		$this->revision_no_sub7->AdvancedSearch->save();

		// Field direction_out_sub7
		$this->direction_out_sub7->AdvancedSearch->SearchValue = @$filter["x_direction_out_sub7"];
		$this->direction_out_sub7->AdvancedSearch->SearchOperator = @$filter["z_direction_out_sub7"];
		$this->direction_out_sub7->AdvancedSearch->SearchCondition = @$filter["v_direction_out_sub7"];
		$this->direction_out_sub7->AdvancedSearch->SearchValue2 = @$filter["y_direction_out_sub7"];
		$this->direction_out_sub7->AdvancedSearch->SearchOperator2 = @$filter["w_direction_out_sub7"];
		$this->direction_out_sub7->AdvancedSearch->save();

		// Field planned_date_out_sub7
		$this->planned_date_out_sub7->AdvancedSearch->SearchValue = @$filter["x_planned_date_out_sub7"];
		$this->planned_date_out_sub7->AdvancedSearch->SearchOperator = @$filter["z_planned_date_out_sub7"];
		$this->planned_date_out_sub7->AdvancedSearch->SearchCondition = @$filter["v_planned_date_out_sub7"];
		$this->planned_date_out_sub7->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_out_sub7"];
		$this->planned_date_out_sub7->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_out_sub7"];
		$this->planned_date_out_sub7->AdvancedSearch->save();

		// Field transmit_date_out_sub7
		$this->transmit_date_out_sub7->AdvancedSearch->SearchValue = @$filter["x_transmit_date_out_sub7"];
		$this->transmit_date_out_sub7->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_out_sub7"];
		$this->transmit_date_out_sub7->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_out_sub7"];
		$this->transmit_date_out_sub7->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_out_sub7"];
		$this->transmit_date_out_sub7->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_out_sub7"];
		$this->transmit_date_out_sub7->AdvancedSearch->save();

		// Field transmit_no_out_sub7
		$this->transmit_no_out_sub7->AdvancedSearch->SearchValue = @$filter["x_transmit_no_out_sub7"];
		$this->transmit_no_out_sub7->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_out_sub7"];
		$this->transmit_no_out_sub7->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_out_sub7"];
		$this->transmit_no_out_sub7->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_out_sub7"];
		$this->transmit_no_out_sub7->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_out_sub7"];
		$this->transmit_no_out_sub7->AdvancedSearch->save();

		// Field approval_status_out_sub7
		$this->approval_status_out_sub7->AdvancedSearch->SearchValue = @$filter["x_approval_status_out_sub7"];
		$this->approval_status_out_sub7->AdvancedSearch->SearchOperator = @$filter["z_approval_status_out_sub7"];
		$this->approval_status_out_sub7->AdvancedSearch->SearchCondition = @$filter["v_approval_status_out_sub7"];
		$this->approval_status_out_sub7->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_out_sub7"];
		$this->approval_status_out_sub7->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_out_sub7"];
		$this->approval_status_out_sub7->AdvancedSearch->save();

		// Field direction_in_sub7
		$this->direction_in_sub7->AdvancedSearch->SearchValue = @$filter["x_direction_in_sub7"];
		$this->direction_in_sub7->AdvancedSearch->SearchOperator = @$filter["z_direction_in_sub7"];
		$this->direction_in_sub7->AdvancedSearch->SearchCondition = @$filter["v_direction_in_sub7"];
		$this->direction_in_sub7->AdvancedSearch->SearchValue2 = @$filter["y_direction_in_sub7"];
		$this->direction_in_sub7->AdvancedSearch->SearchOperator2 = @$filter["w_direction_in_sub7"];
		$this->direction_in_sub7->AdvancedSearch->save();

		// Field transmit_no_in_sub7
		$this->transmit_no_in_sub7->AdvancedSearch->SearchValue = @$filter["x_transmit_no_in_sub7"];
		$this->transmit_no_in_sub7->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_in_sub7"];
		$this->transmit_no_in_sub7->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_in_sub7"];
		$this->transmit_no_in_sub7->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_in_sub7"];
		$this->transmit_no_in_sub7->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_in_sub7"];
		$this->transmit_no_in_sub7->AdvancedSearch->save();

		// Field approval_status_in_sub7
		$this->approval_status_in_sub7->AdvancedSearch->SearchValue = @$filter["x_approval_status_in_sub7"];
		$this->approval_status_in_sub7->AdvancedSearch->SearchOperator = @$filter["z_approval_status_in_sub7"];
		$this->approval_status_in_sub7->AdvancedSearch->SearchCondition = @$filter["v_approval_status_in_sub7"];
		$this->approval_status_in_sub7->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_in_sub7"];
		$this->approval_status_in_sub7->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_in_sub7"];
		$this->approval_status_in_sub7->AdvancedSearch->save();

		// Field transmit_date_in_sub7
		$this->transmit_date_in_sub7->AdvancedSearch->SearchValue = @$filter["x_transmit_date_in_sub7"];
		$this->transmit_date_in_sub7->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_in_sub7"];
		$this->transmit_date_in_sub7->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_in_sub7"];
		$this->transmit_date_in_sub7->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_in_sub7"];
		$this->transmit_date_in_sub7->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_in_sub7"];
		$this->transmit_date_in_sub7->AdvancedSearch->save();

		// Field submit_no_sub8
		$this->submit_no_sub8->AdvancedSearch->SearchValue = @$filter["x_submit_no_sub8"];
		$this->submit_no_sub8->AdvancedSearch->SearchOperator = @$filter["z_submit_no_sub8"];
		$this->submit_no_sub8->AdvancedSearch->SearchCondition = @$filter["v_submit_no_sub8"];
		$this->submit_no_sub8->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_sub8"];
		$this->submit_no_sub8->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_sub8"];
		$this->submit_no_sub8->AdvancedSearch->save();

		// Field revision_no_sub8
		$this->revision_no_sub8->AdvancedSearch->SearchValue = @$filter["x_revision_no_sub8"];
		$this->revision_no_sub8->AdvancedSearch->SearchOperator = @$filter["z_revision_no_sub8"];
		$this->revision_no_sub8->AdvancedSearch->SearchCondition = @$filter["v_revision_no_sub8"];
		$this->revision_no_sub8->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_sub8"];
		$this->revision_no_sub8->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_sub8"];
		$this->revision_no_sub8->AdvancedSearch->save();

		// Field direction_out_sub8
		$this->direction_out_sub8->AdvancedSearch->SearchValue = @$filter["x_direction_out_sub8"];
		$this->direction_out_sub8->AdvancedSearch->SearchOperator = @$filter["z_direction_out_sub8"];
		$this->direction_out_sub8->AdvancedSearch->SearchCondition = @$filter["v_direction_out_sub8"];
		$this->direction_out_sub8->AdvancedSearch->SearchValue2 = @$filter["y_direction_out_sub8"];
		$this->direction_out_sub8->AdvancedSearch->SearchOperator2 = @$filter["w_direction_out_sub8"];
		$this->direction_out_sub8->AdvancedSearch->save();

		// Field planned_date_out_sub8
		$this->planned_date_out_sub8->AdvancedSearch->SearchValue = @$filter["x_planned_date_out_sub8"];
		$this->planned_date_out_sub8->AdvancedSearch->SearchOperator = @$filter["z_planned_date_out_sub8"];
		$this->planned_date_out_sub8->AdvancedSearch->SearchCondition = @$filter["v_planned_date_out_sub8"];
		$this->planned_date_out_sub8->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_out_sub8"];
		$this->planned_date_out_sub8->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_out_sub8"];
		$this->planned_date_out_sub8->AdvancedSearch->save();

		// Field transmit_date_out_sub8
		$this->transmit_date_out_sub8->AdvancedSearch->SearchValue = @$filter["x_transmit_date_out_sub8"];
		$this->transmit_date_out_sub8->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_out_sub8"];
		$this->transmit_date_out_sub8->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_out_sub8"];
		$this->transmit_date_out_sub8->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_out_sub8"];
		$this->transmit_date_out_sub8->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_out_sub8"];
		$this->transmit_date_out_sub8->AdvancedSearch->save();

		// Field transmit_no_out_sub8
		$this->transmit_no_out_sub8->AdvancedSearch->SearchValue = @$filter["x_transmit_no_out_sub8"];
		$this->transmit_no_out_sub8->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_out_sub8"];
		$this->transmit_no_out_sub8->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_out_sub8"];
		$this->transmit_no_out_sub8->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_out_sub8"];
		$this->transmit_no_out_sub8->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_out_sub8"];
		$this->transmit_no_out_sub8->AdvancedSearch->save();

		// Field approval_status_out_sub8
		$this->approval_status_out_sub8->AdvancedSearch->SearchValue = @$filter["x_approval_status_out_sub8"];
		$this->approval_status_out_sub8->AdvancedSearch->SearchOperator = @$filter["z_approval_status_out_sub8"];
		$this->approval_status_out_sub8->AdvancedSearch->SearchCondition = @$filter["v_approval_status_out_sub8"];
		$this->approval_status_out_sub8->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_out_sub8"];
		$this->approval_status_out_sub8->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_out_sub8"];
		$this->approval_status_out_sub8->AdvancedSearch->save();

		// Field direction_out_file_sub8
		$this->direction_out_file_sub8->AdvancedSearch->SearchValue = @$filter["x_direction_out_file_sub8"];
		$this->direction_out_file_sub8->AdvancedSearch->SearchOperator = @$filter["z_direction_out_file_sub8"];
		$this->direction_out_file_sub8->AdvancedSearch->SearchCondition = @$filter["v_direction_out_file_sub8"];
		$this->direction_out_file_sub8->AdvancedSearch->SearchValue2 = @$filter["y_direction_out_file_sub8"];
		$this->direction_out_file_sub8->AdvancedSearch->SearchOperator2 = @$filter["w_direction_out_file_sub8"];
		$this->direction_out_file_sub8->AdvancedSearch->save();

		// Field direction_in_sub8
		$this->direction_in_sub8->AdvancedSearch->SearchValue = @$filter["x_direction_in_sub8"];
		$this->direction_in_sub8->AdvancedSearch->SearchOperator = @$filter["z_direction_in_sub8"];
		$this->direction_in_sub8->AdvancedSearch->SearchCondition = @$filter["v_direction_in_sub8"];
		$this->direction_in_sub8->AdvancedSearch->SearchValue2 = @$filter["y_direction_in_sub8"];
		$this->direction_in_sub8->AdvancedSearch->SearchOperator2 = @$filter["w_direction_in_sub8"];
		$this->direction_in_sub8->AdvancedSearch->save();

		// Field transmit_no_in_sub8
		$this->transmit_no_in_sub8->AdvancedSearch->SearchValue = @$filter["x_transmit_no_in_sub8"];
		$this->transmit_no_in_sub8->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_in_sub8"];
		$this->transmit_no_in_sub8->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_in_sub8"];
		$this->transmit_no_in_sub8->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_in_sub8"];
		$this->transmit_no_in_sub8->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_in_sub8"];
		$this->transmit_no_in_sub8->AdvancedSearch->save();

		// Field approval_status_in_sub8
		$this->approval_status_in_sub8->AdvancedSearch->SearchValue = @$filter["x_approval_status_in_sub8"];
		$this->approval_status_in_sub8->AdvancedSearch->SearchOperator = @$filter["z_approval_status_in_sub8"];
		$this->approval_status_in_sub8->AdvancedSearch->SearchCondition = @$filter["v_approval_status_in_sub8"];
		$this->approval_status_in_sub8->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_in_sub8"];
		$this->approval_status_in_sub8->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_in_sub8"];
		$this->approval_status_in_sub8->AdvancedSearch->save();

		// Field transmit_date_in_sub8
		$this->transmit_date_in_sub8->AdvancedSearch->SearchValue = @$filter["x_transmit_date_in_sub8"];
		$this->transmit_date_in_sub8->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_in_sub8"];
		$this->transmit_date_in_sub8->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_in_sub8"];
		$this->transmit_date_in_sub8->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_in_sub8"];
		$this->transmit_date_in_sub8->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_in_sub8"];
		$this->transmit_date_in_sub8->AdvancedSearch->save();

		// Field submit_no_sub9
		$this->submit_no_sub9->AdvancedSearch->SearchValue = @$filter["x_submit_no_sub9"];
		$this->submit_no_sub9->AdvancedSearch->SearchOperator = @$filter["z_submit_no_sub9"];
		$this->submit_no_sub9->AdvancedSearch->SearchCondition = @$filter["v_submit_no_sub9"];
		$this->submit_no_sub9->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_sub9"];
		$this->submit_no_sub9->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_sub9"];
		$this->submit_no_sub9->AdvancedSearch->save();

		// Field revision_no_sub9
		$this->revision_no_sub9->AdvancedSearch->SearchValue = @$filter["x_revision_no_sub9"];
		$this->revision_no_sub9->AdvancedSearch->SearchOperator = @$filter["z_revision_no_sub9"];
		$this->revision_no_sub9->AdvancedSearch->SearchCondition = @$filter["v_revision_no_sub9"];
		$this->revision_no_sub9->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_sub9"];
		$this->revision_no_sub9->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_sub9"];
		$this->revision_no_sub9->AdvancedSearch->save();

		// Field direction_out_sub9
		$this->direction_out_sub9->AdvancedSearch->SearchValue = @$filter["x_direction_out_sub9"];
		$this->direction_out_sub9->AdvancedSearch->SearchOperator = @$filter["z_direction_out_sub9"];
		$this->direction_out_sub9->AdvancedSearch->SearchCondition = @$filter["v_direction_out_sub9"];
		$this->direction_out_sub9->AdvancedSearch->SearchValue2 = @$filter["y_direction_out_sub9"];
		$this->direction_out_sub9->AdvancedSearch->SearchOperator2 = @$filter["w_direction_out_sub9"];
		$this->direction_out_sub9->AdvancedSearch->save();

		// Field planned_date_out_sub9
		$this->planned_date_out_sub9->AdvancedSearch->SearchValue = @$filter["x_planned_date_out_sub9"];
		$this->planned_date_out_sub9->AdvancedSearch->SearchOperator = @$filter["z_planned_date_out_sub9"];
		$this->planned_date_out_sub9->AdvancedSearch->SearchCondition = @$filter["v_planned_date_out_sub9"];
		$this->planned_date_out_sub9->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_out_sub9"];
		$this->planned_date_out_sub9->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_out_sub9"];
		$this->planned_date_out_sub9->AdvancedSearch->save();

		// Field transmit_date_out_sub9
		$this->transmit_date_out_sub9->AdvancedSearch->SearchValue = @$filter["x_transmit_date_out_sub9"];
		$this->transmit_date_out_sub9->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_out_sub9"];
		$this->transmit_date_out_sub9->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_out_sub9"];
		$this->transmit_date_out_sub9->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_out_sub9"];
		$this->transmit_date_out_sub9->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_out_sub9"];
		$this->transmit_date_out_sub9->AdvancedSearch->save();

		// Field transmit_no_out_sub9
		$this->transmit_no_out_sub9->AdvancedSearch->SearchValue = @$filter["x_transmit_no_out_sub9"];
		$this->transmit_no_out_sub9->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_out_sub9"];
		$this->transmit_no_out_sub9->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_out_sub9"];
		$this->transmit_no_out_sub9->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_out_sub9"];
		$this->transmit_no_out_sub9->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_out_sub9"];
		$this->transmit_no_out_sub9->AdvancedSearch->save();

		// Field approval_status_out_sub9
		$this->approval_status_out_sub9->AdvancedSearch->SearchValue = @$filter["x_approval_status_out_sub9"];
		$this->approval_status_out_sub9->AdvancedSearch->SearchOperator = @$filter["z_approval_status_out_sub9"];
		$this->approval_status_out_sub9->AdvancedSearch->SearchCondition = @$filter["v_approval_status_out_sub9"];
		$this->approval_status_out_sub9->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_out_sub9"];
		$this->approval_status_out_sub9->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_out_sub9"];
		$this->approval_status_out_sub9->AdvancedSearch->save();

		// Field direction_in_sub9
		$this->direction_in_sub9->AdvancedSearch->SearchValue = @$filter["x_direction_in_sub9"];
		$this->direction_in_sub9->AdvancedSearch->SearchOperator = @$filter["z_direction_in_sub9"];
		$this->direction_in_sub9->AdvancedSearch->SearchCondition = @$filter["v_direction_in_sub9"];
		$this->direction_in_sub9->AdvancedSearch->SearchValue2 = @$filter["y_direction_in_sub9"];
		$this->direction_in_sub9->AdvancedSearch->SearchOperator2 = @$filter["w_direction_in_sub9"];
		$this->direction_in_sub9->AdvancedSearch->save();

		// Field transmit_no_in_sub9
		$this->transmit_no_in_sub9->AdvancedSearch->SearchValue = @$filter["x_transmit_no_in_sub9"];
		$this->transmit_no_in_sub9->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_in_sub9"];
		$this->transmit_no_in_sub9->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_in_sub9"];
		$this->transmit_no_in_sub9->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_in_sub9"];
		$this->transmit_no_in_sub9->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_in_sub9"];
		$this->transmit_no_in_sub9->AdvancedSearch->save();

		// Field approval_status_in_sub9
		$this->approval_status_in_sub9->AdvancedSearch->SearchValue = @$filter["x_approval_status_in_sub9"];
		$this->approval_status_in_sub9->AdvancedSearch->SearchOperator = @$filter["z_approval_status_in_sub9"];
		$this->approval_status_in_sub9->AdvancedSearch->SearchCondition = @$filter["v_approval_status_in_sub9"];
		$this->approval_status_in_sub9->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_in_sub9"];
		$this->approval_status_in_sub9->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_in_sub9"];
		$this->approval_status_in_sub9->AdvancedSearch->save();

		// Field transmit_date_in_sub9
		$this->transmit_date_in_sub9->AdvancedSearch->SearchValue = @$filter["x_transmit_date_in_sub9"];
		$this->transmit_date_in_sub9->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_in_sub9"];
		$this->transmit_date_in_sub9->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_in_sub9"];
		$this->transmit_date_in_sub9->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_in_sub9"];
		$this->transmit_date_in_sub9->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_in_sub9"];
		$this->transmit_date_in_sub9->AdvancedSearch->save();

		// Field submit_no_sub10
		$this->submit_no_sub10->AdvancedSearch->SearchValue = @$filter["x_submit_no_sub10"];
		$this->submit_no_sub10->AdvancedSearch->SearchOperator = @$filter["z_submit_no_sub10"];
		$this->submit_no_sub10->AdvancedSearch->SearchCondition = @$filter["v_submit_no_sub10"];
		$this->submit_no_sub10->AdvancedSearch->SearchValue2 = @$filter["y_submit_no_sub10"];
		$this->submit_no_sub10->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no_sub10"];
		$this->submit_no_sub10->AdvancedSearch->save();

		// Field revision_no_sub10
		$this->revision_no_sub10->AdvancedSearch->SearchValue = @$filter["x_revision_no_sub10"];
		$this->revision_no_sub10->AdvancedSearch->SearchOperator = @$filter["z_revision_no_sub10"];
		$this->revision_no_sub10->AdvancedSearch->SearchCondition = @$filter["v_revision_no_sub10"];
		$this->revision_no_sub10->AdvancedSearch->SearchValue2 = @$filter["y_revision_no_sub10"];
		$this->revision_no_sub10->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no_sub10"];
		$this->revision_no_sub10->AdvancedSearch->save();

		// Field direction_out_sub10
		$this->direction_out_sub10->AdvancedSearch->SearchValue = @$filter["x_direction_out_sub10"];
		$this->direction_out_sub10->AdvancedSearch->SearchOperator = @$filter["z_direction_out_sub10"];
		$this->direction_out_sub10->AdvancedSearch->SearchCondition = @$filter["v_direction_out_sub10"];
		$this->direction_out_sub10->AdvancedSearch->SearchValue2 = @$filter["y_direction_out_sub10"];
		$this->direction_out_sub10->AdvancedSearch->SearchOperator2 = @$filter["w_direction_out_sub10"];
		$this->direction_out_sub10->AdvancedSearch->save();

		// Field planned_date_out_sub10
		$this->planned_date_out_sub10->AdvancedSearch->SearchValue = @$filter["x_planned_date_out_sub10"];
		$this->planned_date_out_sub10->AdvancedSearch->SearchOperator = @$filter["z_planned_date_out_sub10"];
		$this->planned_date_out_sub10->AdvancedSearch->SearchCondition = @$filter["v_planned_date_out_sub10"];
		$this->planned_date_out_sub10->AdvancedSearch->SearchValue2 = @$filter["y_planned_date_out_sub10"];
		$this->planned_date_out_sub10->AdvancedSearch->SearchOperator2 = @$filter["w_planned_date_out_sub10"];
		$this->planned_date_out_sub10->AdvancedSearch->save();

		// Field transmit_date_out_sub10
		$this->transmit_date_out_sub10->AdvancedSearch->SearchValue = @$filter["x_transmit_date_out_sub10"];
		$this->transmit_date_out_sub10->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_out_sub10"];
		$this->transmit_date_out_sub10->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_out_sub10"];
		$this->transmit_date_out_sub10->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_out_sub10"];
		$this->transmit_date_out_sub10->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_out_sub10"];
		$this->transmit_date_out_sub10->AdvancedSearch->save();

		// Field transmit_no_out_sub10
		$this->transmit_no_out_sub10->AdvancedSearch->SearchValue = @$filter["x_transmit_no_out_sub10"];
		$this->transmit_no_out_sub10->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_out_sub10"];
		$this->transmit_no_out_sub10->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_out_sub10"];
		$this->transmit_no_out_sub10->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_out_sub10"];
		$this->transmit_no_out_sub10->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_out_sub10"];
		$this->transmit_no_out_sub10->AdvancedSearch->save();

		// Field approval_status_out_sub10
		$this->approval_status_out_sub10->AdvancedSearch->SearchValue = @$filter["x_approval_status_out_sub10"];
		$this->approval_status_out_sub10->AdvancedSearch->SearchOperator = @$filter["z_approval_status_out_sub10"];
		$this->approval_status_out_sub10->AdvancedSearch->SearchCondition = @$filter["v_approval_status_out_sub10"];
		$this->approval_status_out_sub10->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_out_sub10"];
		$this->approval_status_out_sub10->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_out_sub10"];
		$this->approval_status_out_sub10->AdvancedSearch->save();

		// Field direction_in_sub10
		$this->direction_in_sub10->AdvancedSearch->SearchValue = @$filter["x_direction_in_sub10"];
		$this->direction_in_sub10->AdvancedSearch->SearchOperator = @$filter["z_direction_in_sub10"];
		$this->direction_in_sub10->AdvancedSearch->SearchCondition = @$filter["v_direction_in_sub10"];
		$this->direction_in_sub10->AdvancedSearch->SearchValue2 = @$filter["y_direction_in_sub10"];
		$this->direction_in_sub10->AdvancedSearch->SearchOperator2 = @$filter["w_direction_in_sub10"];
		$this->direction_in_sub10->AdvancedSearch->save();

		// Field transmit_no_in_sub10
		$this->transmit_no_in_sub10->AdvancedSearch->SearchValue = @$filter["x_transmit_no_in_sub10"];
		$this->transmit_no_in_sub10->AdvancedSearch->SearchOperator = @$filter["z_transmit_no_in_sub10"];
		$this->transmit_no_in_sub10->AdvancedSearch->SearchCondition = @$filter["v_transmit_no_in_sub10"];
		$this->transmit_no_in_sub10->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no_in_sub10"];
		$this->transmit_no_in_sub10->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no_in_sub10"];
		$this->transmit_no_in_sub10->AdvancedSearch->save();

		// Field approval_status_in_sub10
		$this->approval_status_in_sub10->AdvancedSearch->SearchValue = @$filter["x_approval_status_in_sub10"];
		$this->approval_status_in_sub10->AdvancedSearch->SearchOperator = @$filter["z_approval_status_in_sub10"];
		$this->approval_status_in_sub10->AdvancedSearch->SearchCondition = @$filter["v_approval_status_in_sub10"];
		$this->approval_status_in_sub10->AdvancedSearch->SearchValue2 = @$filter["y_approval_status_in_sub10"];
		$this->approval_status_in_sub10->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status_in_sub10"];
		$this->approval_status_in_sub10->AdvancedSearch->save();

		// Field transmit_date_in_sub10
		$this->transmit_date_in_sub10->AdvancedSearch->SearchValue = @$filter["x_transmit_date_in_sub10"];
		$this->transmit_date_in_sub10->AdvancedSearch->SearchOperator = @$filter["z_transmit_date_in_sub10"];
		$this->transmit_date_in_sub10->AdvancedSearch->SearchCondition = @$filter["v_transmit_date_in_sub10"];
		$this->transmit_date_in_sub10->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date_in_sub10"];
		$this->transmit_date_in_sub10->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date_in_sub10"];
		$this->transmit_date_in_sub10->AdvancedSearch->save();
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
		$this->buildBasicSearchSql($where, $this->submit_no_sub1, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_sub1, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_out_sub1, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_out_sub1, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_out_sub1, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_in_sub1, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_in_sub1, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_in_sub1, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->submit_no_sub2, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_sub2, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_out_sub2, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_out_sub2, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_out_sub2, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_in_sub2, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_in_sub2, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_in_sub2, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->submit_no_sub3, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_sub3, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_out_sub3, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_out_sub3, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_out_sub3, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_in_sub3, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_in_sub3, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_in_sub3, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->submit_no_sub4, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_sub4, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_out_sub4, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_out_sub4, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_out_sub4, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_in_sub4, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_in_sub4, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_in_sub4, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_in_file_sub4, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->submit_no_sub5, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_sub5, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_out_sub5, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_out_sub5, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_out_sub5, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_in_sub5, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_in_sub5, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_in_sub5, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_in_file_sub5, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->submit_no_sub6, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_sub6, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_out_sub6, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_out_sub6, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_out_sub6, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_in_sub6, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_in_sub6, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_in_sub6, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_in_file_sub6, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->submit_no_sub7, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_sub7, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_out_sub7, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_out_sub7, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_out_sub7, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_in_sub7, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_in_sub7, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_in_sub7, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->submit_no_sub8, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_sub8, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_out_sub8, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_out_sub8, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_out_file_sub8, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_in_sub8, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_in_sub8, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_in_sub8, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->submit_no_sub9, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_sub9, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_out_sub9, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_out_sub9, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_out_sub9, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_in_sub9, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_in_sub9, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_in_sub9, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->submit_no_sub10, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->revision_no_sub10, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_out_sub10, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_out_sub10, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_out_sub10, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction_in_sub10, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no_in_sub10, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status_in_sub10, $arKeywords, $type);
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
			$this->updateSort($this->submit_no_sub1, $ctrl); // submit_no_sub1
			$this->updateSort($this->revision_no_sub1, $ctrl); // revision_no_sub1
			$this->updateSort($this->direction_out_sub1, $ctrl); // direction_out_sub1
			$this->updateSort($this->planned_date_out_sub1, $ctrl); // planned_date_out_sub1
			$this->updateSort($this->transmit_date_out_sub1, $ctrl); // transmit_date_out_sub1
			$this->updateSort($this->transmit_no_out_sub1, $ctrl); // transmit_no_out_sub1
			$this->updateSort($this->approval_status_out_sub1, $ctrl); // approval_status_out_sub1
			$this->updateSort($this->direction_in_sub1, $ctrl); // direction_in_sub1
			$this->updateSort($this->transmit_no_in_sub1, $ctrl); // transmit_no_in_sub1
			$this->updateSort($this->approval_status_in_sub1, $ctrl); // approval_status_in_sub1
			$this->updateSort($this->transmit_date_in_sub1, $ctrl); // transmit_date_in_sub1
			$this->updateSort($this->submit_no_sub2, $ctrl); // submit_no_sub2
			$this->updateSort($this->revision_no_sub2, $ctrl); // revision_no_sub2
			$this->updateSort($this->direction_out_sub2, $ctrl); // direction_out_sub2
			$this->updateSort($this->planned_date_out_sub2, $ctrl); // planned_date_out_sub2
			$this->updateSort($this->transmit_date_out_sub2, $ctrl); // transmit_date_out_sub2
			$this->updateSort($this->transmit_no_out_sub2, $ctrl); // transmit_no_out_sub2
			$this->updateSort($this->approval_status_out_sub2, $ctrl); // approval_status_out_sub2
			$this->updateSort($this->direction_in_sub2, $ctrl); // direction_in_sub2
			$this->updateSort($this->transmit_no_in_sub2, $ctrl); // transmit_no_in_sub2
			$this->updateSort($this->approval_status_in_sub2, $ctrl); // approval_status_in_sub2
			$this->updateSort($this->transmit_date_in_sub2, $ctrl); // transmit_date_in_sub2
			$this->updateSort($this->submit_no_sub3, $ctrl); // submit_no_sub3
			$this->updateSort($this->revision_no_sub3, $ctrl); // revision_no_sub3
			$this->updateSort($this->direction_out_sub3, $ctrl); // direction_out_sub3
			$this->updateSort($this->planned_date_out_sub3, $ctrl); // planned_date_out_sub3
			$this->updateSort($this->transmit_date_out_sub3, $ctrl); // transmit_date_out_sub3
			$this->updateSort($this->transmit_no_out_sub3, $ctrl); // transmit_no_out_sub3
			$this->updateSort($this->approval_status_out_sub3, $ctrl); // approval_status_out_sub3
			$this->updateSort($this->direction_in_sub3, $ctrl); // direction_in_sub3
			$this->updateSort($this->transmit_no_in_sub3, $ctrl); // transmit_no_in_sub3
			$this->updateSort($this->approval_status_in_sub3, $ctrl); // approval_status_in_sub3
			$this->updateSort($this->transmit_date_in_sub3, $ctrl); // transmit_date_in_sub3
			$this->updateSort($this->submit_no_sub4, $ctrl); // submit_no_sub4
			$this->updateSort($this->revision_no_sub4, $ctrl); // revision_no_sub4
			$this->updateSort($this->direction_out_sub4, $ctrl); // direction_out_sub4
			$this->updateSort($this->planned_date_out_sub4, $ctrl); // planned_date_out_sub4
			$this->updateSort($this->transmit_date_out_sub4, $ctrl); // transmit_date_out_sub4
			$this->updateSort($this->transmit_no_out_sub4, $ctrl); // transmit_no_out_sub4
			$this->updateSort($this->approval_status_out_sub4, $ctrl); // approval_status_out_sub4
			$this->updateSort($this->direction_in_sub4, $ctrl); // direction_in_sub4
			$this->updateSort($this->transmit_no_in_sub4, $ctrl); // transmit_no_in_sub4
			$this->updateSort($this->approval_status_in_sub4, $ctrl); // approval_status_in_sub4
			$this->updateSort($this->direction_in_file_sub4, $ctrl); // direction_in_file_sub4
			$this->updateSort($this->transmit_date_in_sub4, $ctrl); // transmit_date_in_sub4
			$this->updateSort($this->submit_no_sub5, $ctrl); // submit_no_sub5
			$this->updateSort($this->revision_no_sub5, $ctrl); // revision_no_sub5
			$this->updateSort($this->direction_out_sub5, $ctrl); // direction_out_sub5
			$this->updateSort($this->planned_date_out_sub5, $ctrl); // planned_date_out_sub5
			$this->updateSort($this->transmit_date_out_sub5, $ctrl); // transmit_date_out_sub5
			$this->updateSort($this->transmit_no_out_sub5, $ctrl); // transmit_no_out_sub5
			$this->updateSort($this->approval_status_out_sub5, $ctrl); // approval_status_out_sub5
			$this->updateSort($this->direction_in_sub5, $ctrl); // direction_in_sub5
			$this->updateSort($this->transmit_no_in_sub5, $ctrl); // transmit_no_in_sub5
			$this->updateSort($this->approval_status_in_sub5, $ctrl); // approval_status_in_sub5
			$this->updateSort($this->direction_in_file_sub5, $ctrl); // direction_in_file_sub5
			$this->updateSort($this->transmit_date_in_sub5, $ctrl); // transmit_date_in_sub5
			$this->updateSort($this->submit_no_sub6, $ctrl); // submit_no_sub6
			$this->updateSort($this->revision_no_sub6, $ctrl); // revision_no_sub6
			$this->updateSort($this->direction_out_sub6, $ctrl); // direction_out_sub6
			$this->updateSort($this->planned_date_out_sub6, $ctrl); // planned_date_out_sub6
			$this->updateSort($this->transmit_date_out_sub6, $ctrl); // transmit_date_out_sub6
			$this->updateSort($this->transmit_no_out_sub6, $ctrl); // transmit_no_out_sub6
			$this->updateSort($this->approval_status_out_sub6, $ctrl); // approval_status_out_sub6
			$this->updateSort($this->direction_in_sub6, $ctrl); // direction_in_sub6
			$this->updateSort($this->transmit_no_in_sub6, $ctrl); // transmit_no_in_sub6
			$this->updateSort($this->approval_status_in_sub6, $ctrl); // approval_status_in_sub6
			$this->updateSort($this->direction_in_file_sub6, $ctrl); // direction_in_file_sub6
			$this->updateSort($this->transmit_date_in_sub6, $ctrl); // transmit_date_in_sub6
			$this->updateSort($this->submit_no_sub7, $ctrl); // submit_no_sub7
			$this->updateSort($this->revision_no_sub7, $ctrl); // revision_no_sub7
			$this->updateSort($this->direction_out_sub7, $ctrl); // direction_out_sub7
			$this->updateSort($this->planned_date_out_sub7, $ctrl); // planned_date_out_sub7
			$this->updateSort($this->transmit_date_out_sub7, $ctrl); // transmit_date_out_sub7
			$this->updateSort($this->transmit_no_out_sub7, $ctrl); // transmit_no_out_sub7
			$this->updateSort($this->approval_status_out_sub7, $ctrl); // approval_status_out_sub7
			$this->updateSort($this->direction_in_sub7, $ctrl); // direction_in_sub7
			$this->updateSort($this->transmit_no_in_sub7, $ctrl); // transmit_no_in_sub7
			$this->updateSort($this->approval_status_in_sub7, $ctrl); // approval_status_in_sub7
			$this->updateSort($this->transmit_date_in_sub7, $ctrl); // transmit_date_in_sub7
			$this->updateSort($this->submit_no_sub8, $ctrl); // submit_no_sub8
			$this->updateSort($this->revision_no_sub8, $ctrl); // revision_no_sub8
			$this->updateSort($this->direction_out_sub8, $ctrl); // direction_out_sub8
			$this->updateSort($this->planned_date_out_sub8, $ctrl); // planned_date_out_sub8
			$this->updateSort($this->transmit_date_out_sub8, $ctrl); // transmit_date_out_sub8
			$this->updateSort($this->transmit_no_out_sub8, $ctrl); // transmit_no_out_sub8
			$this->updateSort($this->approval_status_out_sub8, $ctrl); // approval_status_out_sub8
			$this->updateSort($this->direction_out_file_sub8, $ctrl); // direction_out_file_sub8
			$this->updateSort($this->direction_in_sub8, $ctrl); // direction_in_sub8
			$this->updateSort($this->transmit_no_in_sub8, $ctrl); // transmit_no_in_sub8
			$this->updateSort($this->approval_status_in_sub8, $ctrl); // approval_status_in_sub8
			$this->updateSort($this->transmit_date_in_sub8, $ctrl); // transmit_date_in_sub8
			$this->updateSort($this->submit_no_sub9, $ctrl); // submit_no_sub9
			$this->updateSort($this->revision_no_sub9, $ctrl); // revision_no_sub9
			$this->updateSort($this->direction_out_sub9, $ctrl); // direction_out_sub9
			$this->updateSort($this->planned_date_out_sub9, $ctrl); // planned_date_out_sub9
			$this->updateSort($this->transmit_date_out_sub9, $ctrl); // transmit_date_out_sub9
			$this->updateSort($this->transmit_no_out_sub9, $ctrl); // transmit_no_out_sub9
			$this->updateSort($this->approval_status_out_sub9, $ctrl); // approval_status_out_sub9
			$this->updateSort($this->direction_in_sub9, $ctrl); // direction_in_sub9
			$this->updateSort($this->transmit_no_in_sub9, $ctrl); // transmit_no_in_sub9
			$this->updateSort($this->approval_status_in_sub9, $ctrl); // approval_status_in_sub9
			$this->updateSort($this->transmit_date_in_sub9, $ctrl); // transmit_date_in_sub9
			$this->updateSort($this->submit_no_sub10, $ctrl); // submit_no_sub10
			$this->updateSort($this->revision_no_sub10, $ctrl); // revision_no_sub10
			$this->updateSort($this->direction_out_sub10, $ctrl); // direction_out_sub10
			$this->updateSort($this->planned_date_out_sub10, $ctrl); // planned_date_out_sub10
			$this->updateSort($this->transmit_date_out_sub10, $ctrl); // transmit_date_out_sub10
			$this->updateSort($this->transmit_no_out_sub10, $ctrl); // transmit_no_out_sub10
			$this->updateSort($this->approval_status_out_sub10, $ctrl); // approval_status_out_sub10
			$this->updateSort($this->direction_in_sub10, $ctrl); // direction_in_sub10
			$this->updateSort($this->transmit_no_in_sub10, $ctrl); // transmit_no_in_sub10
			$this->updateSort($this->approval_status_in_sub10, $ctrl); // approval_status_in_sub10
			$this->updateSort($this->transmit_date_in_sub10, $ctrl); // transmit_date_in_sub10
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
				$this->submit_no_sub1->setSort("");
				$this->revision_no_sub1->setSort("");
				$this->direction_out_sub1->setSort("");
				$this->planned_date_out_sub1->setSort("");
				$this->transmit_date_out_sub1->setSort("");
				$this->transmit_no_out_sub1->setSort("");
				$this->approval_status_out_sub1->setSort("");
				$this->direction_in_sub1->setSort("");
				$this->transmit_no_in_sub1->setSort("");
				$this->approval_status_in_sub1->setSort("");
				$this->transmit_date_in_sub1->setSort("");
				$this->submit_no_sub2->setSort("");
				$this->revision_no_sub2->setSort("");
				$this->direction_out_sub2->setSort("");
				$this->planned_date_out_sub2->setSort("");
				$this->transmit_date_out_sub2->setSort("");
				$this->transmit_no_out_sub2->setSort("");
				$this->approval_status_out_sub2->setSort("");
				$this->direction_in_sub2->setSort("");
				$this->transmit_no_in_sub2->setSort("");
				$this->approval_status_in_sub2->setSort("");
				$this->transmit_date_in_sub2->setSort("");
				$this->submit_no_sub3->setSort("");
				$this->revision_no_sub3->setSort("");
				$this->direction_out_sub3->setSort("");
				$this->planned_date_out_sub3->setSort("");
				$this->transmit_date_out_sub3->setSort("");
				$this->transmit_no_out_sub3->setSort("");
				$this->approval_status_out_sub3->setSort("");
				$this->direction_in_sub3->setSort("");
				$this->transmit_no_in_sub3->setSort("");
				$this->approval_status_in_sub3->setSort("");
				$this->transmit_date_in_sub3->setSort("");
				$this->submit_no_sub4->setSort("");
				$this->revision_no_sub4->setSort("");
				$this->direction_out_sub4->setSort("");
				$this->planned_date_out_sub4->setSort("");
				$this->transmit_date_out_sub4->setSort("");
				$this->transmit_no_out_sub4->setSort("");
				$this->approval_status_out_sub4->setSort("");
				$this->direction_in_sub4->setSort("");
				$this->transmit_no_in_sub4->setSort("");
				$this->approval_status_in_sub4->setSort("");
				$this->direction_in_file_sub4->setSort("");
				$this->transmit_date_in_sub4->setSort("");
				$this->submit_no_sub5->setSort("");
				$this->revision_no_sub5->setSort("");
				$this->direction_out_sub5->setSort("");
				$this->planned_date_out_sub5->setSort("");
				$this->transmit_date_out_sub5->setSort("");
				$this->transmit_no_out_sub5->setSort("");
				$this->approval_status_out_sub5->setSort("");
				$this->direction_in_sub5->setSort("");
				$this->transmit_no_in_sub5->setSort("");
				$this->approval_status_in_sub5->setSort("");
				$this->direction_in_file_sub5->setSort("");
				$this->transmit_date_in_sub5->setSort("");
				$this->submit_no_sub6->setSort("");
				$this->revision_no_sub6->setSort("");
				$this->direction_out_sub6->setSort("");
				$this->planned_date_out_sub6->setSort("");
				$this->transmit_date_out_sub6->setSort("");
				$this->transmit_no_out_sub6->setSort("");
				$this->approval_status_out_sub6->setSort("");
				$this->direction_in_sub6->setSort("");
				$this->transmit_no_in_sub6->setSort("");
				$this->approval_status_in_sub6->setSort("");
				$this->direction_in_file_sub6->setSort("");
				$this->transmit_date_in_sub6->setSort("");
				$this->submit_no_sub7->setSort("");
				$this->revision_no_sub7->setSort("");
				$this->direction_out_sub7->setSort("");
				$this->planned_date_out_sub7->setSort("");
				$this->transmit_date_out_sub7->setSort("");
				$this->transmit_no_out_sub7->setSort("");
				$this->approval_status_out_sub7->setSort("");
				$this->direction_in_sub7->setSort("");
				$this->transmit_no_in_sub7->setSort("");
				$this->approval_status_in_sub7->setSort("");
				$this->transmit_date_in_sub7->setSort("");
				$this->submit_no_sub8->setSort("");
				$this->revision_no_sub8->setSort("");
				$this->direction_out_sub8->setSort("");
				$this->planned_date_out_sub8->setSort("");
				$this->transmit_date_out_sub8->setSort("");
				$this->transmit_no_out_sub8->setSort("");
				$this->approval_status_out_sub8->setSort("");
				$this->direction_out_file_sub8->setSort("");
				$this->direction_in_sub8->setSort("");
				$this->transmit_no_in_sub8->setSort("");
				$this->approval_status_in_sub8->setSort("");
				$this->transmit_date_in_sub8->setSort("");
				$this->submit_no_sub9->setSort("");
				$this->revision_no_sub9->setSort("");
				$this->direction_out_sub9->setSort("");
				$this->planned_date_out_sub9->setSort("");
				$this->transmit_date_out_sub9->setSort("");
				$this->transmit_no_out_sub9->setSort("");
				$this->approval_status_out_sub9->setSort("");
				$this->direction_in_sub9->setSort("");
				$this->transmit_no_in_sub9->setSort("");
				$this->approval_status_in_sub9->setSort("");
				$this->transmit_date_in_sub9->setSort("");
				$this->submit_no_sub10->setSort("");
				$this->revision_no_sub10->setSort("");
				$this->direction_out_sub10->setSort("");
				$this->planned_date_out_sub10->setSort("");
				$this->transmit_date_out_sub10->setSort("");
				$this->transmit_no_out_sub10->setSort("");
				$this->approval_status_out_sub10->setSort("");
				$this->direction_in_sub10->setSort("");
				$this->transmit_no_in_sub10->setSort("");
				$this->approval_status_in_sub10->setSort("");
				$this->transmit_date_in_sub10->setSort("");
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

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;

		// "copy"
		$item = &$this->ListOptions->add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canAdd();
		$item->OnLeft = TRUE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canDelete();
		$item->OnLeft = TRUE;

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

		// "edit"
		$opt = &$this->ListOptions->Items["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit()) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "copy"
		$opt = &$this->ListOptions->Items["copy"];
		$copycaption = HtmlTitle($Language->phrase("CopyLink"));
		if ($Security->canAdd()) {
			$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("CopyLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = &$this->ListOptions->Items["delete"];
		if ($Security->canDelete())
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";

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
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("AddLink"));
		$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->canAdd());
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
		$this->current_status_file->setDbValue($row['current_status_file']);
		$this->submit_no_sub1->setDbValue($row['submit_no_sub1']);
		$this->revision_no_sub1->setDbValue($row['revision_no_sub1']);
		$this->direction_out_sub1->setDbValue($row['direction_out_sub1']);
		$this->planned_date_out_sub1->setDbValue($row['planned_date_out_sub1']);
		$this->transmit_date_out_sub1->setDbValue($row['transmit_date_out_sub1']);
		$this->transmit_no_out_sub1->setDbValue($row['transmit_no_out_sub1']);
		$this->approval_status_out_sub1->setDbValue($row['approval_status_out_sub1']);
		$this->direction_out_file_sub1->setDbValue($row['direction_out_file_sub1']);
		$this->direction_in_sub1->setDbValue($row['direction_in_sub1']);
		$this->transmit_no_in_sub1->setDbValue($row['transmit_no_in_sub1']);
		$this->approval_status_in_sub1->setDbValue($row['approval_status_in_sub1']);
		$this->direction_in_file_sub1->setDbValue($row['direction_in_file_sub1']);
		$this->transmit_date_in_sub1->setDbValue($row['transmit_date_in_sub1']);
		$this->submit_no_sub2->setDbValue($row['submit_no_sub2']);
		$this->revision_no_sub2->setDbValue($row['revision_no_sub2']);
		$this->direction_out_sub2->setDbValue($row['direction_out_sub2']);
		$this->planned_date_out_sub2->setDbValue($row['planned_date_out_sub2']);
		$this->transmit_date_out_sub2->setDbValue($row['transmit_date_out_sub2']);
		$this->transmit_no_out_sub2->setDbValue($row['transmit_no_out_sub2']);
		$this->approval_status_out_sub2->setDbValue($row['approval_status_out_sub2']);
		$this->direction_out_file_sub2->setDbValue($row['direction_out_file_sub2']);
		$this->direction_in_sub2->setDbValue($row['direction_in_sub2']);
		$this->transmit_no_in_sub2->setDbValue($row['transmit_no_in_sub2']);
		$this->approval_status_in_sub2->setDbValue($row['approval_status_in_sub2']);
		$this->direction_in_file_sub2->setDbValue($row['direction_in_file_sub2']);
		$this->transmit_date_in_sub2->setDbValue($row['transmit_date_in_sub2']);
		$this->submit_no_sub3->setDbValue($row['submit_no_sub3']);
		$this->revision_no_sub3->setDbValue($row['revision_no_sub3']);
		$this->direction_out_sub3->setDbValue($row['direction_out_sub3']);
		$this->planned_date_out_sub3->setDbValue($row['planned_date_out_sub3']);
		$this->transmit_date_out_sub3->setDbValue($row['transmit_date_out_sub3']);
		$this->transmit_no_out_sub3->setDbValue($row['transmit_no_out_sub3']);
		$this->approval_status_out_sub3->setDbValue($row['approval_status_out_sub3']);
		$this->direction_out_file_sub3->setDbValue($row['direction_out_file_sub3']);
		$this->direction_in_sub3->setDbValue($row['direction_in_sub3']);
		$this->transmit_no_in_sub3->setDbValue($row['transmit_no_in_sub3']);
		$this->approval_status_in_sub3->setDbValue($row['approval_status_in_sub3']);
		$this->direction_in_file_sub3->setDbValue($row['direction_in_file_sub3']);
		$this->transmit_date_in_sub3->setDbValue($row['transmit_date_in_sub3']);
		$this->submit_no_sub4->setDbValue($row['submit_no_sub4']);
		$this->revision_no_sub4->setDbValue($row['revision_no_sub4']);
		$this->direction_out_sub4->setDbValue($row['direction_out_sub4']);
		$this->planned_date_out_sub4->setDbValue($row['planned_date_out_sub4']);
		$this->transmit_date_out_sub4->setDbValue($row['transmit_date_out_sub4']);
		$this->transmit_no_out_sub4->setDbValue($row['transmit_no_out_sub4']);
		$this->approval_status_out_sub4->setDbValue($row['approval_status_out_sub4']);
		$this->direction_out_file_sub4->setDbValue($row['direction_out_file_sub4']);
		$this->direction_in_sub4->setDbValue($row['direction_in_sub4']);
		$this->transmit_no_in_sub4->setDbValue($row['transmit_no_in_sub4']);
		$this->approval_status_in_sub4->setDbValue($row['approval_status_in_sub4']);
		$this->direction_in_file_sub4->setDbValue($row['direction_in_file_sub4']);
		$this->transmit_date_in_sub4->setDbValue($row['transmit_date_in_sub4']);
		$this->submit_no_sub5->setDbValue($row['submit_no_sub5']);
		$this->revision_no_sub5->setDbValue($row['revision_no_sub5']);
		$this->direction_out_sub5->setDbValue($row['direction_out_sub5']);
		$this->planned_date_out_sub5->setDbValue($row['planned_date_out_sub5']);
		$this->transmit_date_out_sub5->setDbValue($row['transmit_date_out_sub5']);
		$this->transmit_no_out_sub5->setDbValue($row['transmit_no_out_sub5']);
		$this->approval_status_out_sub5->setDbValue($row['approval_status_out_sub5']);
		$this->direction_out_file_sub5->setDbValue($row['direction_out_file_sub5']);
		$this->direction_in_sub5->setDbValue($row['direction_in_sub5']);
		$this->transmit_no_in_sub5->setDbValue($row['transmit_no_in_sub5']);
		$this->approval_status_in_sub5->setDbValue($row['approval_status_in_sub5']);
		$this->direction_in_file_sub5->setDbValue($row['direction_in_file_sub5']);
		$this->transmit_date_in_sub5->setDbValue($row['transmit_date_in_sub5']);
		$this->submit_no_sub6->setDbValue($row['submit_no_sub6']);
		$this->revision_no_sub6->setDbValue($row['revision_no_sub6']);
		$this->direction_out_sub6->setDbValue($row['direction_out_sub6']);
		$this->planned_date_out_sub6->setDbValue($row['planned_date_out_sub6']);
		$this->transmit_date_out_sub6->setDbValue($row['transmit_date_out_sub6']);
		$this->transmit_no_out_sub6->setDbValue($row['transmit_no_out_sub6']);
		$this->approval_status_out_sub6->setDbValue($row['approval_status_out_sub6']);
		$this->direction_out_file_sub6->setDbValue($row['direction_out_file_sub6']);
		$this->direction_in_sub6->setDbValue($row['direction_in_sub6']);
		$this->transmit_no_in_sub6->setDbValue($row['transmit_no_in_sub6']);
		$this->approval_status_in_sub6->setDbValue($row['approval_status_in_sub6']);
		$this->direction_in_file_sub6->setDbValue($row['direction_in_file_sub6']);
		$this->transmit_date_in_sub6->setDbValue($row['transmit_date_in_sub6']);
		$this->submit_no_sub7->setDbValue($row['submit_no_sub7']);
		$this->revision_no_sub7->setDbValue($row['revision_no_sub7']);
		$this->direction_out_sub7->setDbValue($row['direction_out_sub7']);
		$this->planned_date_out_sub7->setDbValue($row['planned_date_out_sub7']);
		$this->transmit_date_out_sub7->setDbValue($row['transmit_date_out_sub7']);
		$this->transmit_no_out_sub7->setDbValue($row['transmit_no_out_sub7']);
		$this->approval_status_out_sub7->setDbValue($row['approval_status_out_sub7']);
		$this->direction_out_file_sub7->setDbValue($row['direction_out_file_sub7']);
		$this->direction_in_sub7->setDbValue($row['direction_in_sub7']);
		$this->transmit_no_in_sub7->setDbValue($row['transmit_no_in_sub7']);
		$this->approval_status_in_sub7->setDbValue($row['approval_status_in_sub7']);
		$this->direction_in_file_sub7->setDbValue($row['direction_in_file_sub7']);
		$this->transmit_date_in_sub7->setDbValue($row['transmit_date_in_sub7']);
		$this->submit_no_sub8->setDbValue($row['submit_no_sub8']);
		$this->revision_no_sub8->setDbValue($row['revision_no_sub8']);
		$this->direction_out_sub8->setDbValue($row['direction_out_sub8']);
		$this->planned_date_out_sub8->setDbValue($row['planned_date_out_sub8']);
		$this->transmit_date_out_sub8->setDbValue($row['transmit_date_out_sub8']);
		$this->transmit_no_out_sub8->setDbValue($row['transmit_no_out_sub8']);
		$this->approval_status_out_sub8->setDbValue($row['approval_status_out_sub8']);
		$this->direction_out_file_sub8->setDbValue($row['direction_out_file_sub8']);
		$this->direction_in_sub8->setDbValue($row['direction_in_sub8']);
		$this->transmit_no_in_sub8->setDbValue($row['transmit_no_in_sub8']);
		$this->approval_status_in_sub8->setDbValue($row['approval_status_in_sub8']);
		$this->direction_in_file_sub8->setDbValue($row['direction_in_file_sub8']);
		$this->transmit_date_in_sub8->setDbValue($row['transmit_date_in_sub8']);
		$this->submit_no_sub9->setDbValue($row['submit_no_sub9']);
		$this->revision_no_sub9->setDbValue($row['revision_no_sub9']);
		$this->direction_out_sub9->setDbValue($row['direction_out_sub9']);
		$this->planned_date_out_sub9->setDbValue($row['planned_date_out_sub9']);
		$this->transmit_date_out_sub9->setDbValue($row['transmit_date_out_sub9']);
		$this->transmit_no_out_sub9->setDbValue($row['transmit_no_out_sub9']);
		$this->approval_status_out_sub9->setDbValue($row['approval_status_out_sub9']);
		$this->direction_out_file_sub9->setDbValue($row['direction_out_file_sub9']);
		$this->direction_in_sub9->setDbValue($row['direction_in_sub9']);
		$this->transmit_no_in_sub9->setDbValue($row['transmit_no_in_sub9']);
		$this->approval_status_in_sub9->setDbValue($row['approval_status_in_sub9']);
		$this->direction_in_file_sub9->setDbValue($row['direction_in_file_sub9']);
		$this->transmit_date_in_sub9->setDbValue($row['transmit_date_in_sub9']);
		$this->submit_no_sub10->setDbValue($row['submit_no_sub10']);
		$this->revision_no_sub10->setDbValue($row['revision_no_sub10']);
		$this->direction_out_sub10->setDbValue($row['direction_out_sub10']);
		$this->planned_date_out_sub10->setDbValue($row['planned_date_out_sub10']);
		$this->transmit_date_out_sub10->setDbValue($row['transmit_date_out_sub10']);
		$this->transmit_no_out_sub10->setDbValue($row['transmit_no_out_sub10']);
		$this->approval_status_out_sub10->setDbValue($row['approval_status_out_sub10']);
		$this->direction_out_file_sub10->setDbValue($row['direction_out_file_sub10']);
		$this->direction_in_sub10->setDbValue($row['direction_in_sub10']);
		$this->transmit_no_in_sub10->setDbValue($row['transmit_no_in_sub10']);
		$this->approval_status_in_sub10->setDbValue($row['approval_status_in_sub10']);
		$this->direction_in_file_sub10->setDbValue($row['direction_in_file_sub10']);
		$this->transmit_date_in_sub10->setDbValue($row['transmit_date_in_sub10']);
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
		$row['submit_no_sub1'] = NULL;
		$row['revision_no_sub1'] = NULL;
		$row['direction_out_sub1'] = NULL;
		$row['planned_date_out_sub1'] = NULL;
		$row['transmit_date_out_sub1'] = NULL;
		$row['transmit_no_out_sub1'] = NULL;
		$row['approval_status_out_sub1'] = NULL;
		$row['direction_out_file_sub1'] = NULL;
		$row['direction_in_sub1'] = NULL;
		$row['transmit_no_in_sub1'] = NULL;
		$row['approval_status_in_sub1'] = NULL;
		$row['direction_in_file_sub1'] = NULL;
		$row['transmit_date_in_sub1'] = NULL;
		$row['submit_no_sub2'] = NULL;
		$row['revision_no_sub2'] = NULL;
		$row['direction_out_sub2'] = NULL;
		$row['planned_date_out_sub2'] = NULL;
		$row['transmit_date_out_sub2'] = NULL;
		$row['transmit_no_out_sub2'] = NULL;
		$row['approval_status_out_sub2'] = NULL;
		$row['direction_out_file_sub2'] = NULL;
		$row['direction_in_sub2'] = NULL;
		$row['transmit_no_in_sub2'] = NULL;
		$row['approval_status_in_sub2'] = NULL;
		$row['direction_in_file_sub2'] = NULL;
		$row['transmit_date_in_sub2'] = NULL;
		$row['submit_no_sub3'] = NULL;
		$row['revision_no_sub3'] = NULL;
		$row['direction_out_sub3'] = NULL;
		$row['planned_date_out_sub3'] = NULL;
		$row['transmit_date_out_sub3'] = NULL;
		$row['transmit_no_out_sub3'] = NULL;
		$row['approval_status_out_sub3'] = NULL;
		$row['direction_out_file_sub3'] = NULL;
		$row['direction_in_sub3'] = NULL;
		$row['transmit_no_in_sub3'] = NULL;
		$row['approval_status_in_sub3'] = NULL;
		$row['direction_in_file_sub3'] = NULL;
		$row['transmit_date_in_sub3'] = NULL;
		$row['submit_no_sub4'] = NULL;
		$row['revision_no_sub4'] = NULL;
		$row['direction_out_sub4'] = NULL;
		$row['planned_date_out_sub4'] = NULL;
		$row['transmit_date_out_sub4'] = NULL;
		$row['transmit_no_out_sub4'] = NULL;
		$row['approval_status_out_sub4'] = NULL;
		$row['direction_out_file_sub4'] = NULL;
		$row['direction_in_sub4'] = NULL;
		$row['transmit_no_in_sub4'] = NULL;
		$row['approval_status_in_sub4'] = NULL;
		$row['direction_in_file_sub4'] = NULL;
		$row['transmit_date_in_sub4'] = NULL;
		$row['submit_no_sub5'] = NULL;
		$row['revision_no_sub5'] = NULL;
		$row['direction_out_sub5'] = NULL;
		$row['planned_date_out_sub5'] = NULL;
		$row['transmit_date_out_sub5'] = NULL;
		$row['transmit_no_out_sub5'] = NULL;
		$row['approval_status_out_sub5'] = NULL;
		$row['direction_out_file_sub5'] = NULL;
		$row['direction_in_sub5'] = NULL;
		$row['transmit_no_in_sub5'] = NULL;
		$row['approval_status_in_sub5'] = NULL;
		$row['direction_in_file_sub5'] = NULL;
		$row['transmit_date_in_sub5'] = NULL;
		$row['submit_no_sub6'] = NULL;
		$row['revision_no_sub6'] = NULL;
		$row['direction_out_sub6'] = NULL;
		$row['planned_date_out_sub6'] = NULL;
		$row['transmit_date_out_sub6'] = NULL;
		$row['transmit_no_out_sub6'] = NULL;
		$row['approval_status_out_sub6'] = NULL;
		$row['direction_out_file_sub6'] = NULL;
		$row['direction_in_sub6'] = NULL;
		$row['transmit_no_in_sub6'] = NULL;
		$row['approval_status_in_sub6'] = NULL;
		$row['direction_in_file_sub6'] = NULL;
		$row['transmit_date_in_sub6'] = NULL;
		$row['submit_no_sub7'] = NULL;
		$row['revision_no_sub7'] = NULL;
		$row['direction_out_sub7'] = NULL;
		$row['planned_date_out_sub7'] = NULL;
		$row['transmit_date_out_sub7'] = NULL;
		$row['transmit_no_out_sub7'] = NULL;
		$row['approval_status_out_sub7'] = NULL;
		$row['direction_out_file_sub7'] = NULL;
		$row['direction_in_sub7'] = NULL;
		$row['transmit_no_in_sub7'] = NULL;
		$row['approval_status_in_sub7'] = NULL;
		$row['direction_in_file_sub7'] = NULL;
		$row['transmit_date_in_sub7'] = NULL;
		$row['submit_no_sub8'] = NULL;
		$row['revision_no_sub8'] = NULL;
		$row['direction_out_sub8'] = NULL;
		$row['planned_date_out_sub8'] = NULL;
		$row['transmit_date_out_sub8'] = NULL;
		$row['transmit_no_out_sub8'] = NULL;
		$row['approval_status_out_sub8'] = NULL;
		$row['direction_out_file_sub8'] = NULL;
		$row['direction_in_sub8'] = NULL;
		$row['transmit_no_in_sub8'] = NULL;
		$row['approval_status_in_sub8'] = NULL;
		$row['direction_in_file_sub8'] = NULL;
		$row['transmit_date_in_sub8'] = NULL;
		$row['submit_no_sub9'] = NULL;
		$row['revision_no_sub9'] = NULL;
		$row['direction_out_sub9'] = NULL;
		$row['planned_date_out_sub9'] = NULL;
		$row['transmit_date_out_sub9'] = NULL;
		$row['transmit_no_out_sub9'] = NULL;
		$row['approval_status_out_sub9'] = NULL;
		$row['direction_out_file_sub9'] = NULL;
		$row['direction_in_sub9'] = NULL;
		$row['transmit_no_in_sub9'] = NULL;
		$row['approval_status_in_sub9'] = NULL;
		$row['direction_in_file_sub9'] = NULL;
		$row['transmit_date_in_sub9'] = NULL;
		$row['submit_no_sub10'] = NULL;
		$row['revision_no_sub10'] = NULL;
		$row['direction_out_sub10'] = NULL;
		$row['planned_date_out_sub10'] = NULL;
		$row['transmit_date_out_sub10'] = NULL;
		$row['transmit_no_out_sub10'] = NULL;
		$row['approval_status_out_sub10'] = NULL;
		$row['direction_out_file_sub10'] = NULL;
		$row['direction_in_sub10'] = NULL;
		$row['transmit_no_in_sub10'] = NULL;
		$row['approval_status_in_sub10'] = NULL;
		$row['direction_in_file_sub10'] = NULL;
		$row['transmit_date_in_sub10'] = NULL;
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
		// firelink_doc_no
		// client_doc_no
		// order_number
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

		$this->direction_out_file_sub1->CellCssStyle = "white-space: nowrap;";

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

		$this->log_updatedon->CellCssStyle = "white-space: nowrap;";
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

			// direction_in_sub1
			$this->direction_in_sub1->ViewValue = $this->direction_in_sub1->CurrentValue;
			$this->direction_in_sub1->ViewCustomAttributes = "";

			// transmit_no_in_sub1
			$this->transmit_no_in_sub1->ViewValue = $this->transmit_no_in_sub1->CurrentValue;
			$this->transmit_no_in_sub1->ViewCustomAttributes = "";

			// approval_status_in_sub1
			$this->approval_status_in_sub1->ViewValue = $this->approval_status_in_sub1->CurrentValue;
			$this->approval_status_in_sub1->ViewCustomAttributes = "";

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

			// direction_in_sub2
			$this->direction_in_sub2->ViewValue = $this->direction_in_sub2->CurrentValue;
			$this->direction_in_sub2->ViewCustomAttributes = "";

			// transmit_no_in_sub2
			$this->transmit_no_in_sub2->ViewValue = $this->transmit_no_in_sub2->CurrentValue;
			$this->transmit_no_in_sub2->ViewCustomAttributes = "";

			// approval_status_in_sub2
			$this->approval_status_in_sub2->ViewValue = $this->approval_status_in_sub2->CurrentValue;
			$this->approval_status_in_sub2->ViewCustomAttributes = "";

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

			// direction_in_sub3
			$this->direction_in_sub3->ViewValue = $this->direction_in_sub3->CurrentValue;
			$this->direction_in_sub3->ViewCustomAttributes = "";

			// transmit_no_in_sub3
			$this->transmit_no_in_sub3->ViewValue = $this->transmit_no_in_sub3->CurrentValue;
			$this->transmit_no_in_sub3->ViewCustomAttributes = "";

			// approval_status_in_sub3
			$this->approval_status_in_sub3->ViewValue = $this->approval_status_in_sub3->CurrentValue;
			$this->approval_status_in_sub3->ViewCustomAttributes = "";

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

			// direction_in_sub7
			$this->direction_in_sub7->ViewValue = $this->direction_in_sub7->CurrentValue;
			$this->direction_in_sub7->ViewCustomAttributes = "";

			// transmit_no_in_sub7
			$this->transmit_no_in_sub7->ViewValue = $this->transmit_no_in_sub7->CurrentValue;
			$this->transmit_no_in_sub7->ViewCustomAttributes = "";

			// approval_status_in_sub7
			$this->approval_status_in_sub7->ViewValue = $this->approval_status_in_sub7->CurrentValue;
			$this->approval_status_in_sub7->ViewCustomAttributes = "";

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

			// direction_in_sub9
			$this->direction_in_sub9->ViewValue = $this->direction_in_sub9->CurrentValue;
			$this->direction_in_sub9->ViewCustomAttributes = "";

			// transmit_no_in_sub9
			$this->transmit_no_in_sub9->ViewValue = $this->transmit_no_in_sub9->CurrentValue;
			$this->transmit_no_in_sub9->ViewCustomAttributes = "";

			// approval_status_in_sub9
			$this->approval_status_in_sub9->ViewValue = $this->approval_status_in_sub9->CurrentValue;
			$this->approval_status_in_sub9->ViewCustomAttributes = "";

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

			// direction_in_sub10
			$this->direction_in_sub10->ViewValue = $this->direction_in_sub10->CurrentValue;
			$this->direction_in_sub10->ViewCustomAttributes = "";

			// transmit_no_in_sub10
			$this->transmit_no_in_sub10->ViewValue = $this->transmit_no_in_sub10->CurrentValue;
			$this->transmit_no_in_sub10->ViewCustomAttributes = "";

			// approval_status_in_sub10
			$this->approval_status_in_sub10->ViewValue = $this->approval_status_in_sub10->CurrentValue;
			$this->approval_status_in_sub10->ViewCustomAttributes = "";

			// transmit_date_in_sub10
			$this->transmit_date_in_sub10->ViewValue = $this->transmit_date_in_sub10->CurrentValue;
			$this->transmit_date_in_sub10->ViewValue = FormatDateTime($this->transmit_date_in_sub10->ViewValue, 0);
			$this->transmit_date_in_sub10->ViewCustomAttributes = "";

			// log_updatedon
			$this->log_updatedon->ViewValue = $this->log_updatedon->CurrentValue;
			$this->log_updatedon->ViewValue = FormatDateTime($this->log_updatedon->ViewValue, 9);
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
			if (!EmptyValue($this->current_status_file->CurrentValue)) {
				$this->current_status->HrefValue = ((!empty($this->current_status_file->ViewValue) && !is_array($this->current_status_file->ViewValue)) ? RemoveHtml($this->current_status_file->ViewValue) : $this->current_status_file->CurrentValue); // Add prefix/suffix
				$this->current_status->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->current_status->HrefValue = FullUrl($this->current_status->HrefValue, "href");
			} else {
				$this->current_status->HrefValue = "";
			}
			$this->current_status->TooltipValue = "";

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
			if (!EmptyValue($this->direction_out_file_sub1->CurrentValue)) {
				$this->approval_status_out_sub1->HrefValue = ((!empty($this->direction_out_file_sub1->ViewValue) && !is_array($this->direction_out_file_sub1->ViewValue)) ? RemoveHtml($this->direction_out_file_sub1->ViewValue) : $this->direction_out_file_sub1->CurrentValue); // Add prefix/suffix
				$this->approval_status_out_sub1->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->approval_status_out_sub1->HrefValue = FullUrl($this->approval_status_out_sub1->HrefValue, "href");
			} else {
				$this->approval_status_out_sub1->HrefValue = "";
			}
			$this->approval_status_out_sub1->TooltipValue = "";

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
			if (!EmptyValue($this->direction_out_file_sub1->CurrentValue)) {
				$this->approval_status_in_sub1->HrefValue = ((!empty($this->direction_out_file_sub1->ViewValue) && !is_array($this->direction_out_file_sub1->ViewValue)) ? RemoveHtml($this->direction_out_file_sub1->ViewValue) : $this->direction_out_file_sub1->CurrentValue); // Add prefix/suffix
				$this->approval_status_in_sub1->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->approval_status_in_sub1->HrefValue = FullUrl($this->approval_status_in_sub1->HrefValue, "href");
			} else {
				$this->approval_status_in_sub1->HrefValue = "";
			}
			$this->approval_status_in_sub1->TooltipValue = "";

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

			// transmit_date_in_sub10
			$this->transmit_date_in_sub10->LinkCustomAttributes = "";
			$this->transmit_date_in_sub10->HrefValue = "";
			$this->transmit_date_in_sub10->TooltipValue = "";

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
		$item->Visible = TRUE;

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
		$item->Visible = FALSE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = TRUE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$url = "";
		$item->Body = "<button id=\"emf_document_log\" class=\"ew-export-link ew-email\" title=\"" . $Language->phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->phrase("ExportToEmailText") . "\" onclick=\"ew.emailDialogShow({lnk:'emf_document_log',hdr:ew.language.phrase('ExportToEmailText'),f:document.fdocument_loglist,sel:false" . $url . "});\">" . $Language->phrase("ExportToEmail") . "</button>";
		$item->Visible = TRUE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = TRUE;
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
			if ($return)
				return $doc->Text; // Return email content
			else
				echo $this->exportEmail($doc->Text); // Send email
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

	// Export email
	protected function exportEmail($emailContent)
	{
		global $TempImages, $Language;
		$sender = Post("sender", "");
		$recipient = Post("recipient", "");
		$cc = Post("cc", "");
		$bcc = Post("bcc", "");

		// Subject
		$subject = Post("subject", "");
		$emailSubject = $subject;

		// Message
		$content = Post("message", "");
		$emailMessage = $content;

		// Check sender
		if ($sender == "") {
			return "<p class=\"text-danger\">" . $Language->phrase("EnterSenderEmail") . "</p>";
		}
		if (!CheckEmail($sender)) {
			return "<p class=\"text-danger\">" . $Language->phrase("EnterProperSenderEmail") . "</p>";
		}

		// Check recipient
		if (!CheckEmailList($recipient, MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->phrase("EnterProperRecipientEmail") . "</p>";
		}

		// Check cc
		if (!CheckEmailList($cc, MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->phrase("EnterProperCcEmail") . "</p>";
		}

		// Check bcc
		if (!CheckEmailList($bcc, MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->phrase("EnterProperBccEmail") . "</p>";
		}

		// Check email sent count
		if (!isset($_SESSION[EXPORT_EMAIL_COUNTER]))
			$_SESSION[EXPORT_EMAIL_COUNTER] = 0;
		if ((int)$_SESSION[EXPORT_EMAIL_COUNTER] > MAX_EMAIL_SENT_COUNT) {
			return "<p class=\"text-danger\">" . $Language->phrase("ExceedMaxEmailExport") . "</p>";
		}

		// Send email
		$email = new Email();
		$email->Sender = $sender; // Sender
		$email->Recipient = $recipient; // Recipient
		$email->Cc = $cc; // Cc
		$email->Bcc = $bcc; // Bcc
		$email->Subject = $emailSubject; // Subject
		$email->Format = "html";
		if ($emailMessage <> "")
			$emailMessage = RemoveXss($emailMessage) . "<br><br>";
		foreach ($TempImages as $tmpImage)
			$email->addEmbeddedImage($tmpImage);
		$email->Content = $emailMessage . CleanEmailContent($emailContent); // Content
		$eventArgs = [];
		if ($this->Recordset) {
			$this->RecCnt = $this->StartRec - 1;
			$this->Recordset->moveFirst();
			if ($this->StartRec > 1)
				$this->Recordset->move($this->StartRec - 1);
			$eventArgs["rs"] = &$this->Recordset;
		}
		$emailSent = FALSE;
		if ($this->Email_Sending($email, $eventArgs))
			$emailSent = $email->send();

		// Check email sent status
		if ($emailSent) {

			// Update email sent count
			$_SESSION[EXPORT_EMAIL_COUNTER]++;

			// Sent email success
			return "<p class=\"text-success\">" . $Language->phrase("SendEmailSuccess") . "</p>"; // Set up success message
		} else {

			// Sent email failure
			return "<p class=\"text-danger\">" . $email->SendErrDescription . "</p>";
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