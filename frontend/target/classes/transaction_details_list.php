<?php
namespace PHPMaker2019\pdm;

/**
 * Page class
 */
class transaction_details_list extends transaction_details
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{vishal-pdm}";

	// Table name
	public $TableName = 'transaction_details';

	// Page object name
	public $PageObjName = "transaction_details_list";

	// Grid form hidden field names
	public $FormName = "ftransaction_detailslist";
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

		// Table object (transaction_details)
		if (!isset($GLOBALS["transaction_details"]) || get_class($GLOBALS["transaction_details"]) == PROJECT_NAMESPACE . "transaction_details") {
			$GLOBALS["transaction_details"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["transaction_details"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->AddUrl = "transaction_detailsadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "transaction_detailsdelete.php";
		$this->MultiUpdateUrl = "transaction_detailsupdate.php";
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (user_dtls)
		if (!isset($GLOBALS['user_dtls']))
			$GLOBALS['user_dtls'] = new user_dtls();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'transaction_details');

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
		$this->FilterOptions->TagClassName = "ew-filter-option ftransaction_detailslistsrch";

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
		global $EXPORT, $transaction_details;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($transaction_details);
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
			$key .= @$ar['document_sequence'];
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
			$this->document_sequence->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->username->Visible = FALSE;
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

		// Create form object
		$CurrentForm = new HttpForm();

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
		$this->document_sequence->Visible = FALSE;
		$this->firelink_doc_no->setVisibility();
		$this->project_name->setVisibility();
		$this->document_tittle->setVisibility();
		$this->submit_no->setVisibility();
		$this->revision_no->setVisibility();
		$this->transmit_no->setVisibility();
		$this->transmit_date->setVisibility();
		$this->direction->setVisibility();
		$this->approval_status->setVisibility();
		$this->document_link->Visible = FALSE;
		$this->transaction_date->Visible = FALSE;
		$this->document_native->setVisibility();
		$this->username->Visible = FALSE;
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
		$this->setupLookupOptions($this->firelink_doc_no);
		$this->setupLookupOptions($this->transmit_no);
		$this->setupLookupOptions($this->approval_status);

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

			// Check QueryString parameters
			if (Get("action") !== NULL) {
				$this->CurrentAction = Get("action");

				// Clear inline mode
				if ($this->isCancel())
					$this->clearInlineMode();

				// Switch to grid add mode
				if ($this->isGridAdd())
					$this->gridAddMode();
			} else {
				if (Post("action") !== NULL) {
					$this->CurrentAction = Post("action"); // Get action

					// Grid Insert
					if ($this->isGridInsert() && @$_SESSION[SESSION_INLINE_MODE] == "gridadd") {
						if ($this->validateGridForm()) {
							$gridInsert = $this->gridInsert();
						} else {
							$gridInsert = FALSE;
							$this->setFailureMessage($FormError);
						}
						if ($gridInsert) {
						} else {
							$this->EventCancelled = TRUE;
							$this->gridAddMode(); // Stay in Grid add mode
						}
					}
				}
			}

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

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = &$this->ListOptions->getItem("griddelete");
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));
			AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->loadSearchValues(); // Get search values

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();
			if (!$this->validateSearch())
				$this->setFailureMessage($SearchError);

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

			// Get search criteria for advanced search
			if ($SearchError == "")
				$srchAdvanced = $this->advancedSearchWhere();
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

			// Load advanced search from default
			if ($this->loadAdvancedSearchDefault()) {
				$srchAdvanced = $this->advancedSearchWhere();
			}
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

	// Exit inline mode
	protected function clearInlineMode()
	{
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	protected function gridAddMode()
	{
		$this->CurrentAction = "gridadd";
		$_SESSION[SESSION_INLINE_MODE] = "gridadd";
		$this->hideFieldsForAddEdit();
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
			$this->document_sequence->setFormValue($arKeyFlds[0]);
			if (!is_numeric($this->document_sequence->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	public function gridInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$rowindex = 1;
		$gridInsert = FALSE;
		$conn = &$this->getConnection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->beginTrans();

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
		if ($this->AuditTrailOnAdd)
			$this->writeAuditTrailDummy($Language->phrase("BatchInsertBegin")); // Batch insert begin
		$key = "";

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			$this->loadFormValues(); // Get form values
			if (!$this->emptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->validateForm()) {
					$gridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($FormError);
				} else {
					$gridInsert = $this->addRow($this->OldRecordset); // Insert this row
				}
				if ($gridInsert) {
					if ($key <> "")
						$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
					$key .= $this->document_sequence->CurrentValue;

					// Add filter for this record
					$filter = $this->getRecordFilter();
					if ($wrkfilter <> "")
						$wrkfilter .= " OR ";
					$wrkfilter .= $filter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->setFailureMessage($Language->phrase("NoAddRecord"));
			$gridInsert = FALSE;
		}
		if ($gridInsert) {
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertSuccess")); // Batch insert success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("InsertSuccess")); // Set up insert success message
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertRollback")); // Batch insert rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_firelink_doc_no") && $CurrentForm->hasValue("o_firelink_doc_no") && $this->firelink_doc_no->CurrentValue <> $this->firelink_doc_no->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_project_name") && $CurrentForm->hasValue("o_project_name") && $this->project_name->CurrentValue <> $this->project_name->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_document_tittle") && $CurrentForm->hasValue("o_document_tittle") && $this->document_tittle->CurrentValue <> $this->document_tittle->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_submit_no") && $CurrentForm->hasValue("o_submit_no") && $this->submit_no->CurrentValue <> $this->submit_no->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_revision_no") && $CurrentForm->hasValue("o_revision_no") && $this->revision_no->CurrentValue <> $this->revision_no->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_transmit_no") && $CurrentForm->hasValue("o_transmit_no") && $this->transmit_no->CurrentValue <> $this->transmit_no->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_transmit_date") && $CurrentForm->hasValue("o_transmit_date") && $this->transmit_date->CurrentValue <> $this->transmit_date->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_direction") && $CurrentForm->hasValue("o_direction") && $this->direction->CurrentValue <> $this->direction->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_approval_status") && $CurrentForm->hasValue("o_approval_status") && $this->approval_status->CurrentValue <> $this->approval_status->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_document_native") && $CurrentForm->hasValue("o_document_native") && $this->document_native->CurrentValue <> $this->document_native->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	public function validateGridForm()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else if (!$this->validateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	public function getGridFormValues()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = array();

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->getFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	public function restoreCurrentRowFormValues($idx)
	{
		global $CurrentForm;

		// Get row based on current index
		$CurrentForm->Index = $idx;
		$this->loadFormValues(); // Load form values
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
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "ftransaction_detailslistsrch");
		$filterList = Concat($filterList, $this->firelink_doc_no->AdvancedSearch->toJson(), ","); // Field firelink_doc_no
		$filterList = Concat($filterList, $this->project_name->AdvancedSearch->toJson(), ","); // Field project_name
		$filterList = Concat($filterList, $this->document_tittle->AdvancedSearch->toJson(), ","); // Field document_tittle
		$filterList = Concat($filterList, $this->submit_no->AdvancedSearch->toJson(), ","); // Field submit_no
		$filterList = Concat($filterList, $this->revision_no->AdvancedSearch->toJson(), ","); // Field revision_no
		$filterList = Concat($filterList, $this->transmit_no->AdvancedSearch->toJson(), ","); // Field transmit_no
		$filterList = Concat($filterList, $this->transmit_date->AdvancedSearch->toJson(), ","); // Field transmit_date
		$filterList = Concat($filterList, $this->direction->AdvancedSearch->toJson(), ","); // Field direction
		$filterList = Concat($filterList, $this->approval_status->AdvancedSearch->toJson(), ","); // Field approval_status
		$filterList = Concat($filterList, $this->document_native->AdvancedSearch->toJson(), ","); // Field document_native
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
			$UserProfile->setSearchFilters(CurrentUserName(), "ftransaction_detailslistsrch", $filters);
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

		// Field submit_no
		$this->submit_no->AdvancedSearch->SearchValue = @$filter["x_submit_no"];
		$this->submit_no->AdvancedSearch->SearchOperator = @$filter["z_submit_no"];
		$this->submit_no->AdvancedSearch->SearchCondition = @$filter["v_submit_no"];
		$this->submit_no->AdvancedSearch->SearchValue2 = @$filter["y_submit_no"];
		$this->submit_no->AdvancedSearch->SearchOperator2 = @$filter["w_submit_no"];
		$this->submit_no->AdvancedSearch->save();

		// Field revision_no
		$this->revision_no->AdvancedSearch->SearchValue = @$filter["x_revision_no"];
		$this->revision_no->AdvancedSearch->SearchOperator = @$filter["z_revision_no"];
		$this->revision_no->AdvancedSearch->SearchCondition = @$filter["v_revision_no"];
		$this->revision_no->AdvancedSearch->SearchValue2 = @$filter["y_revision_no"];
		$this->revision_no->AdvancedSearch->SearchOperator2 = @$filter["w_revision_no"];
		$this->revision_no->AdvancedSearch->save();

		// Field transmit_no
		$this->transmit_no->AdvancedSearch->SearchValue = @$filter["x_transmit_no"];
		$this->transmit_no->AdvancedSearch->SearchOperator = @$filter["z_transmit_no"];
		$this->transmit_no->AdvancedSearch->SearchCondition = @$filter["v_transmit_no"];
		$this->transmit_no->AdvancedSearch->SearchValue2 = @$filter["y_transmit_no"];
		$this->transmit_no->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_no"];
		$this->transmit_no->AdvancedSearch->save();

		// Field transmit_date
		$this->transmit_date->AdvancedSearch->SearchValue = @$filter["x_transmit_date"];
		$this->transmit_date->AdvancedSearch->SearchOperator = @$filter["z_transmit_date"];
		$this->transmit_date->AdvancedSearch->SearchCondition = @$filter["v_transmit_date"];
		$this->transmit_date->AdvancedSearch->SearchValue2 = @$filter["y_transmit_date"];
		$this->transmit_date->AdvancedSearch->SearchOperator2 = @$filter["w_transmit_date"];
		$this->transmit_date->AdvancedSearch->save();

		// Field direction
		$this->direction->AdvancedSearch->SearchValue = @$filter["x_direction"];
		$this->direction->AdvancedSearch->SearchOperator = @$filter["z_direction"];
		$this->direction->AdvancedSearch->SearchCondition = @$filter["v_direction"];
		$this->direction->AdvancedSearch->SearchValue2 = @$filter["y_direction"];
		$this->direction->AdvancedSearch->SearchOperator2 = @$filter["w_direction"];
		$this->direction->AdvancedSearch->save();

		// Field approval_status
		$this->approval_status->AdvancedSearch->SearchValue = @$filter["x_approval_status"];
		$this->approval_status->AdvancedSearch->SearchOperator = @$filter["z_approval_status"];
		$this->approval_status->AdvancedSearch->SearchCondition = @$filter["v_approval_status"];
		$this->approval_status->AdvancedSearch->SearchValue2 = @$filter["y_approval_status"];
		$this->approval_status->AdvancedSearch->SearchOperator2 = @$filter["w_approval_status"];
		$this->approval_status->AdvancedSearch->save();

		// Field document_native
		$this->document_native->AdvancedSearch->SearchValue = @$filter["x_document_native"];
		$this->document_native->AdvancedSearch->SearchOperator = @$filter["z_document_native"];
		$this->document_native->AdvancedSearch->SearchCondition = @$filter["v_document_native"];
		$this->document_native->AdvancedSearch->SearchValue2 = @$filter["y_document_native"];
		$this->document_native->AdvancedSearch->SearchOperator2 = @$filter["w_document_native"];
		$this->document_native->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[TABLE_BASIC_SEARCH_TYPE]);
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->firelink_doc_no, $default, FALSE); // firelink_doc_no
		$this->buildSearchSql($where, $this->project_name, $default, FALSE); // project_name
		$this->buildSearchSql($where, $this->document_tittle, $default, FALSE); // document_tittle
		$this->buildSearchSql($where, $this->submit_no, $default, FALSE); // submit_no
		$this->buildSearchSql($where, $this->revision_no, $default, FALSE); // revision_no
		$this->buildSearchSql($where, $this->transmit_no, $default, FALSE); // transmit_no
		$this->buildSearchSql($where, $this->transmit_date, $default, FALSE); // transmit_date
		$this->buildSearchSql($where, $this->direction, $default, FALSE); // direction
		$this->buildSearchSql($where, $this->approval_status, $default, FALSE); // approval_status
		$this->buildSearchSql($where, $this->document_native, $default, FALSE); // document_native

		// Set up search parm
		if (!$default && $where <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->firelink_doc_no->AdvancedSearch->save(); // firelink_doc_no
			$this->project_name->AdvancedSearch->save(); // project_name
			$this->document_tittle->AdvancedSearch->save(); // document_tittle
			$this->submit_no->AdvancedSearch->save(); // submit_no
			$this->revision_no->AdvancedSearch->save(); // revision_no
			$this->transmit_no->AdvancedSearch->save(); // transmit_no
			$this->transmit_date->AdvancedSearch->save(); // transmit_date
			$this->direction->AdvancedSearch->save(); // direction
			$this->approval_status->AdvancedSearch->save(); // approval_status
			$this->document_native->AdvancedSearch->save(); // document_native
		}
		return $where;
	}

	// Build search SQL
	protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
	{
		$fldParm = $fld->Param;
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$fldOpr = ($default) ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
		$fldCond = ($default) ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
		$fldVal2 = ($default) ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
		$fldOpr2 = ($default) ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
		$wrk = "";
		if (is_array($fldVal))
			$fldVal = implode(",", $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(",", $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		if ($fldOpr == "")
			$fldOpr = "=";
		$fldOpr2 = strtoupper(trim($fldOpr2));
		if ($fldOpr2 == "")
			$fldOpr2 = "=";
		if (SEARCH_MULTI_VALUE_OPTION == 1)
			$multiValue = FALSE;
		if ($multiValue) {
			$wrk1 = ($fldVal <> "") ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
			$wrk2 = ($fldVal2 <> "") ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
			$wrk = $wrk1; // Build final SQL
			if ($wrk2 <> "")
				$wrk = ($wrk <> "") ? "($wrk) $fldCond ($wrk2)" : $wrk2;
		} else {
			$fldVal = $this->convertSearchValue($fld, $fldVal);
			$fldVal2 = $this->convertSearchValue($fld, $fldVal2);
			$wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
		}
		AddFilter($where, $wrk);
	}

	// Convert search value
	protected function convertSearchValue(&$fld, $fldVal)
	{
		if ($fldVal == NULL_VALUE || $fldVal == NOT_NULL_VALUE)
			return $fldVal;
		$value = $fldVal;
		if ($fld->DataType == DATATYPE_BOOLEAN) {
			if ($fldVal <> "")
				$value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
		} elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
			if ($fldVal <> "")
				$value = UnFormatDateTime($fldVal, $fld->DateTimeFormat);
		}
		return $value;
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->firelink_doc_no, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->project_name, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->document_tittle, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->transmit_no, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->direction, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->approval_status, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->document_native, $arKeywords, $type);
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
		if ($this->firelink_doc_no->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->project_name->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->document_tittle->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->submit_no->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->revision_no->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->transmit_no->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->transmit_date->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->direction->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->approval_status->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->document_native->AdvancedSearch->issetSession())
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

		// Clear advanced search parameters
		$this->resetAdvancedSearchParms();
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

	// Clear all advanced search parameters
	protected function resetAdvancedSearchParms()
	{
		$this->firelink_doc_no->AdvancedSearch->unsetSession();
		$this->project_name->AdvancedSearch->unsetSession();
		$this->document_tittle->AdvancedSearch->unsetSession();
		$this->submit_no->AdvancedSearch->unsetSession();
		$this->revision_no->AdvancedSearch->unsetSession();
		$this->transmit_no->AdvancedSearch->unsetSession();
		$this->transmit_date->AdvancedSearch->unsetSession();
		$this->direction->AdvancedSearch->unsetSession();
		$this->approval_status->AdvancedSearch->unsetSession();
		$this->document_native->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->firelink_doc_no->AdvancedSearch->load();
		$this->project_name->AdvancedSearch->load();
		$this->document_tittle->AdvancedSearch->load();
		$this->submit_no->AdvancedSearch->load();
		$this->revision_no->AdvancedSearch->load();
		$this->transmit_no->AdvancedSearch->load();
		$this->transmit_date->AdvancedSearch->load();
		$this->direction->AdvancedSearch->load();
		$this->approval_status->AdvancedSearch->load();
		$this->document_native->AdvancedSearch->load();
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
			$this->updateSort($this->project_name, $ctrl); // project_name
			$this->updateSort($this->document_tittle, $ctrl); // document_tittle
			$this->updateSort($this->submit_no, $ctrl); // submit_no
			$this->updateSort($this->revision_no, $ctrl); // revision_no
			$this->updateSort($this->transmit_no, $ctrl); // transmit_no
			$this->updateSort($this->transmit_date, $ctrl); // transmit_date
			$this->updateSort($this->direction, $ctrl); // direction
			$this->updateSort($this->approval_status, $ctrl); // approval_status
			$this->updateSort($this->document_native, $ctrl); // document_native
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
				$this->setSessionOrderByList($orderBy);
				$this->firelink_doc_no->setSort("");
				$this->project_name->setSort("");
				$this->document_tittle->setSort("");
				$this->submit_no->setSort("");
				$this->revision_no->setSort("");
				$this->transmit_no->setSort("");
				$this->transmit_date->setSort("");
				$this->direction->setSort("");
				$this->approval_status->setSort("");
				$this->document_native->setSort("");
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

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

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

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode <> "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->isGridAdd() || $this->isGridEdit()) {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = &$options->Items["griddelete"];
				if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
				}
			}
		}

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
		$opt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ew-multi-select\" value=\"" . HtmlEncode($this->document_sequence->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\">";
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
		$item = &$option->add("gridadd");
		$item->Body = "<a class=\"ew-add-edit ew-grid-add\" title=\"" . HtmlTitle($Language->phrase("GridAddLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridAddLink")) . "\" href=\"" . HtmlEncode($this->GridAddUrl) . "\">" . $Language->phrase("GridAddLink") . "</a>";
		$item->Visible = ($this->GridAddUrl <> "" && $Security->canAdd());
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"ftransaction_detailslistsrch\" href=\"#\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"ftransaction_detailslistsrch\" href=\"#\">" . $Language->phrase("DeleteFilter") . "</a>";
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
		if (!$this->isGridAdd() && !$this->isGridEdit()) { // Not grid add/edit mode
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({f:document.ftransaction_detailslist}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as &$option)
				$option->hideAllOptions();
			if ($this->isGridAdd()) {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$item = &$option->add("addblankrow");
					$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->canAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;

				// Add grid insert
				$item = &$option->add("gridinsert");
				$item->Body = "<a class=\"ew-action ew-grid-insert\" title=\"" . HtmlTitle($Language->phrase("GridInsertLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridInsertLink")) . "\" href=\"\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->phrase("GridInsertLink") . "</a>";

				// Add grid cancel
				$item = &$option->add("gridcancel");
				$item->Body = "<a class=\"ew-action ew-grid-cancel\" title=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" href=\"" . $this->CancelUrl . "\">" . $Language->phrase("GridCancelLink") . "</a>";
			}
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ftransaction_detailslistsrch\">" . $Language->phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"transaction_detailssrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<button type=\"button\" class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"transaction_details\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" onclick=\"ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'transaction_detailssrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</button>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-highlight active\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"ftransaction_detailslistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</button>";
		$item->Visible = ($this->SearchWhere <> "" && $this->TotalRecs > 0);

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

	// Load default values
	protected function loadDefaultValues()
	{
		$this->document_sequence->CurrentValue = NULL;
		$this->document_sequence->OldValue = $this->document_sequence->CurrentValue;
		$this->firelink_doc_no->CurrentValue = NULL;
		$this->firelink_doc_no->OldValue = $this->firelink_doc_no->CurrentValue;
		$this->project_name->CurrentValue = NULL;
		$this->project_name->OldValue = $this->project_name->CurrentValue;
		$this->document_tittle->CurrentValue = NULL;
		$this->document_tittle->OldValue = $this->document_tittle->CurrentValue;
		$this->submit_no->CurrentValue = NULL;
		$this->submit_no->OldValue = $this->submit_no->CurrentValue;
		$this->revision_no->CurrentValue = NULL;
		$this->revision_no->OldValue = $this->revision_no->CurrentValue;
		$this->transmit_no->CurrentValue = NULL;
		$this->transmit_no->OldValue = $this->transmit_no->CurrentValue;
		$this->transmit_date->CurrentValue = NULL;
		$this->transmit_date->OldValue = $this->transmit_date->CurrentValue;
		$this->direction->CurrentValue = NULL;
		$this->direction->OldValue = $this->direction->CurrentValue;
		$this->approval_status->CurrentValue = "Planning";
		$this->approval_status->OldValue = $this->approval_status->CurrentValue;
		$this->document_link->Upload->DbValue = NULL;
		$this->document_link->OldValue = $this->document_link->Upload->DbValue;
		$this->transaction_date->CurrentValue = NULL;
		$this->transaction_date->OldValue = $this->transaction_date->CurrentValue;
		$this->document_native->CurrentValue = NULL;
		$this->document_native->OldValue = $this->document_native->CurrentValue;
		$this->username->CurrentValue = NULL;
		$this->username->OldValue = $this->username->CurrentValue;
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(TABLE_BASIC_SEARCH, ""), FALSE);
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(TABLE_BASIC_SEARCH_TYPE, ""), FALSE);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{
		global $CurrentForm;

		// Load search values
		// firelink_doc_no

		if (!$this->isAddOrEdit())
			$this->firelink_doc_no->AdvancedSearch->setSearchValue(Get("x_firelink_doc_no", Get("firelink_doc_no", "")));
		if ($this->firelink_doc_no->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->firelink_doc_no->AdvancedSearch->setSearchOperator(Get("z_firelink_doc_no", ""));

		// project_name
		if (!$this->isAddOrEdit())
			$this->project_name->AdvancedSearch->setSearchValue(Get("x_project_name", Get("project_name", "")));
		if ($this->project_name->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->project_name->AdvancedSearch->setSearchOperator(Get("z_project_name", ""));

		// document_tittle
		if (!$this->isAddOrEdit())
			$this->document_tittle->AdvancedSearch->setSearchValue(Get("x_document_tittle", Get("document_tittle", "")));
		if ($this->document_tittle->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->document_tittle->AdvancedSearch->setSearchOperator(Get("z_document_tittle", ""));

		// submit_no
		if (!$this->isAddOrEdit())
			$this->submit_no->AdvancedSearch->setSearchValue(Get("x_submit_no", Get("submit_no", "")));
		if ($this->submit_no->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->submit_no->AdvancedSearch->setSearchOperator(Get("z_submit_no", ""));

		// revision_no
		if (!$this->isAddOrEdit())
			$this->revision_no->AdvancedSearch->setSearchValue(Get("x_revision_no", Get("revision_no", "")));
		if ($this->revision_no->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->revision_no->AdvancedSearch->setSearchOperator(Get("z_revision_no", ""));

		// transmit_no
		if (!$this->isAddOrEdit())
			$this->transmit_no->AdvancedSearch->setSearchValue(Get("x_transmit_no", Get("transmit_no", "")));
		if ($this->transmit_no->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->transmit_no->AdvancedSearch->setSearchOperator(Get("z_transmit_no", ""));

		// transmit_date
		if (!$this->isAddOrEdit())
			$this->transmit_date->AdvancedSearch->setSearchValue(Get("x_transmit_date", Get("transmit_date", "")));
		if ($this->transmit_date->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->transmit_date->AdvancedSearch->setSearchOperator(Get("z_transmit_date", ""));

		// direction
		if (!$this->isAddOrEdit())
			$this->direction->AdvancedSearch->setSearchValue(Get("x_direction", Get("direction", "")));
		if ($this->direction->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->direction->AdvancedSearch->setSearchOperator(Get("z_direction", ""));

		// approval_status
		if (!$this->isAddOrEdit())
			$this->approval_status->AdvancedSearch->setSearchValue(Get("x_approval_status", Get("approval_status", "")));
		if ($this->approval_status->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->approval_status->AdvancedSearch->setSearchOperator(Get("z_approval_status", ""));

		// document_native
		if (!$this->isAddOrEdit())
			$this->document_native->AdvancedSearch->setSearchValue(Get("x_document_native", Get("document_native", "")));
		if ($this->document_native->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->document_native->AdvancedSearch->setSearchOperator(Get("z_document_native", ""));
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'firelink_doc_no' first before field var 'x_firelink_doc_no'
		$val = $CurrentForm->hasValue("firelink_doc_no") ? $CurrentForm->getValue("firelink_doc_no") : $CurrentForm->getValue("x_firelink_doc_no");
		if (!$this->firelink_doc_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->firelink_doc_no->Visible = FALSE; // Disable update for API request
			else
				$this->firelink_doc_no->setFormValue($val);
		}
		$this->firelink_doc_no->setOldValue($CurrentForm->getValue("o_firelink_doc_no"));

		// Check field name 'project_name' first before field var 'x_project_name'
		$val = $CurrentForm->hasValue("project_name") ? $CurrentForm->getValue("project_name") : $CurrentForm->getValue("x_project_name");
		if (!$this->project_name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->project_name->Visible = FALSE; // Disable update for API request
			else
				$this->project_name->setFormValue($val);
		}
		$this->project_name->setOldValue($CurrentForm->getValue("o_project_name"));

		// Check field name 'document_tittle' first before field var 'x_document_tittle'
		$val = $CurrentForm->hasValue("document_tittle") ? $CurrentForm->getValue("document_tittle") : $CurrentForm->getValue("x_document_tittle");
		if (!$this->document_tittle->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->document_tittle->Visible = FALSE; // Disable update for API request
			else
				$this->document_tittle->setFormValue($val);
		}
		$this->document_tittle->setOldValue($CurrentForm->getValue("o_document_tittle"));

		// Check field name 'submit_no' first before field var 'x_submit_no'
		$val = $CurrentForm->hasValue("submit_no") ? $CurrentForm->getValue("submit_no") : $CurrentForm->getValue("x_submit_no");
		if (!$this->submit_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->submit_no->Visible = FALSE; // Disable update for API request
			else
				$this->submit_no->setFormValue($val);
		}
		$this->submit_no->setOldValue($CurrentForm->getValue("o_submit_no"));

		// Check field name 'revision_no' first before field var 'x_revision_no'
		$val = $CurrentForm->hasValue("revision_no") ? $CurrentForm->getValue("revision_no") : $CurrentForm->getValue("x_revision_no");
		if (!$this->revision_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->revision_no->Visible = FALSE; // Disable update for API request
			else
				$this->revision_no->setFormValue($val);
		}
		$this->revision_no->setOldValue($CurrentForm->getValue("o_revision_no"));

		// Check field name 'transmit_no' first before field var 'x_transmit_no'
		$val = $CurrentForm->hasValue("transmit_no") ? $CurrentForm->getValue("transmit_no") : $CurrentForm->getValue("x_transmit_no");
		if (!$this->transmit_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no->setFormValue($val);
		}
		$this->transmit_no->setOldValue($CurrentForm->getValue("o_transmit_no"));

		// Check field name 'transmit_date' first before field var 'x_transmit_date'
		$val = $CurrentForm->hasValue("transmit_date") ? $CurrentForm->getValue("transmit_date") : $CurrentForm->getValue("x_transmit_date");
		if (!$this->transmit_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date->setFormValue($val);
			$this->transmit_date->CurrentValue = UnFormatDateTime($this->transmit_date->CurrentValue, 0);
		}
		$this->transmit_date->setOldValue($CurrentForm->getValue("o_transmit_date"));

		// Check field name 'direction' first before field var 'x_direction'
		$val = $CurrentForm->hasValue("direction") ? $CurrentForm->getValue("direction") : $CurrentForm->getValue("x_direction");
		if (!$this->direction->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction->Visible = FALSE; // Disable update for API request
			else
				$this->direction->setFormValue($val);
		}
		$this->direction->setOldValue($CurrentForm->getValue("o_direction"));

		// Check field name 'approval_status' first before field var 'x_approval_status'
		$val = $CurrentForm->hasValue("approval_status") ? $CurrentForm->getValue("approval_status") : $CurrentForm->getValue("x_approval_status");
		if (!$this->approval_status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status->setFormValue($val);
		}
		$this->approval_status->setOldValue($CurrentForm->getValue("o_approval_status"));

		// Check field name 'document_native' first before field var 'x_document_native'
		$val = $CurrentForm->hasValue("document_native") ? $CurrentForm->getValue("document_native") : $CurrentForm->getValue("x_document_native");
		if (!$this->document_native->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->document_native->Visible = FALSE; // Disable update for API request
			else
				$this->document_native->setFormValue($val);
		}
		$this->document_native->setOldValue($CurrentForm->getValue("o_document_native"));

		// Check field name 'document_sequence' first before field var 'x_document_sequence'
		$val = $CurrentForm->hasValue("document_sequence") ? $CurrentForm->getValue("document_sequence") : $CurrentForm->getValue("x_document_sequence");
		if (!$this->document_sequence->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->document_sequence->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->document_sequence->CurrentValue = $this->document_sequence->FormValue;
		$this->firelink_doc_no->CurrentValue = $this->firelink_doc_no->FormValue;
		$this->project_name->CurrentValue = $this->project_name->FormValue;
		$this->document_tittle->CurrentValue = $this->document_tittle->FormValue;
		$this->submit_no->CurrentValue = $this->submit_no->FormValue;
		$this->revision_no->CurrentValue = $this->revision_no->FormValue;
		$this->transmit_no->CurrentValue = $this->transmit_no->FormValue;
		$this->transmit_date->CurrentValue = $this->transmit_date->FormValue;
		$this->transmit_date->CurrentValue = UnFormatDateTime($this->transmit_date->CurrentValue, 0);
		$this->direction->CurrentValue = $this->direction->FormValue;
		$this->approval_status->CurrentValue = $this->approval_status->FormValue;
		$this->document_native->CurrentValue = $this->document_native->FormValue;
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
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())]);
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
		$this->document_sequence->setDbValue($row['document_sequence']);
		$this->firelink_doc_no->setDbValue($row['firelink_doc_no']);
		if (array_key_exists('EV__firelink_doc_no', $rs->fields)) {
			$this->firelink_doc_no->VirtualValue = $rs->fields('EV__firelink_doc_no'); // Set up virtual field value
		} else {
			$this->firelink_doc_no->VirtualValue = ""; // Clear value
		}
		$this->project_name->setDbValue($row['project_name']);
		$this->document_tittle->setDbValue($row['document_tittle']);
		$this->submit_no->setDbValue($row['submit_no']);
		$this->revision_no->setDbValue($row['revision_no']);
		$this->transmit_no->setDbValue($row['transmit_no']);
		if (array_key_exists('EV__transmit_no', $rs->fields)) {
			$this->transmit_no->VirtualValue = $rs->fields('EV__transmit_no'); // Set up virtual field value
		} else {
			$this->transmit_no->VirtualValue = ""; // Clear value
		}
		$this->transmit_date->setDbValue($row['transmit_date']);
		$this->direction->setDbValue($row['direction']);
		$this->approval_status->setDbValue($row['approval_status']);
		$this->document_link->Upload->DbValue = $row['document_link'];
		$this->document_link->setDbValue($this->document_link->Upload->DbValue);
		$this->transaction_date->setDbValue($row['transaction_date']);
		$this->document_native->setDbValue($row['document_native']);
		$this->username->setDbValue($row['username']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['document_sequence'] = $this->document_sequence->CurrentValue;
		$row['firelink_doc_no'] = $this->firelink_doc_no->CurrentValue;
		$row['project_name'] = $this->project_name->CurrentValue;
		$row['document_tittle'] = $this->document_tittle->CurrentValue;
		$row['submit_no'] = $this->submit_no->CurrentValue;
		$row['revision_no'] = $this->revision_no->CurrentValue;
		$row['transmit_no'] = $this->transmit_no->CurrentValue;
		$row['transmit_date'] = $this->transmit_date->CurrentValue;
		$row['direction'] = $this->direction->CurrentValue;
		$row['approval_status'] = $this->approval_status->CurrentValue;
		$row['document_link'] = $this->document_link->Upload->DbValue;
		$row['transaction_date'] = $this->transaction_date->CurrentValue;
		$row['document_native'] = $this->document_native->CurrentValue;
		$row['username'] = $this->username->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("document_sequence")) <> "")
			$this->document_sequence->CurrentValue = $this->getKey("document_sequence"); // document_sequence
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
		// document_sequence

		$this->document_sequence->CellCssStyle = "white-space: nowrap;";

		// firelink_doc_no
		// project_name
		// document_tittle
		// submit_no
		// revision_no
		// transmit_no
		// transmit_date
		// direction
		// approval_status
		// document_link
		// transaction_date
		// document_native
		// username

		$this->username->CellCssStyle = "white-space: nowrap;";
		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// document_sequence
			$this->document_sequence->ViewValue = $this->document_sequence->CurrentValue;
			$this->document_sequence->CellCssStyle .= "text-align: left;";
			$this->document_sequence->ViewCustomAttributes = "";

			// firelink_doc_no
			if ($this->firelink_doc_no->VirtualValue <> "") {
				$this->firelink_doc_no->ViewValue = $this->firelink_doc_no->VirtualValue;
			} else {
				$this->firelink_doc_no->ViewValue = $this->firelink_doc_no->CurrentValue;
			$curVal = strval($this->firelink_doc_no->CurrentValue);
			if ($curVal <> "") {
				$this->firelink_doc_no->ViewValue = $this->firelink_doc_no->lookupCacheOption($curVal);
				if ($this->firelink_doc_no->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"firelink_doc_no\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->firelink_doc_no->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->firelink_doc_no->ViewValue = $this->firelink_doc_no->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->firelink_doc_no->ViewValue = $this->firelink_doc_no->CurrentValue;
					}
				}
			} else {
				$this->firelink_doc_no->ViewValue = NULL;
			}
			}
			$this->firelink_doc_no->CellCssStyle .= "text-align: left;";
			$this->firelink_doc_no->ViewCustomAttributes = "";

			// project_name
			$this->project_name->ViewValue = $this->project_name->CurrentValue;
			$this->project_name->ViewCustomAttributes = "";

			// document_tittle
			$this->document_tittle->ViewValue = $this->document_tittle->CurrentValue;
			$this->document_tittle->ViewCustomAttributes = "";

			// submit_no
			$this->submit_no->ViewValue = $this->submit_no->CurrentValue;
			$this->submit_no->CellCssStyle .= "text-align: left;";
			$this->submit_no->ViewCustomAttributes = "";

			// revision_no
			$this->revision_no->ViewValue = $this->revision_no->CurrentValue;
			$this->revision_no->ViewCustomAttributes = "";

			// transmit_no
			if ($this->transmit_no->VirtualValue <> "") {
				$this->transmit_no->ViewValue = $this->transmit_no->VirtualValue;
			} else {
				$this->transmit_no->ViewValue = $this->transmit_no->CurrentValue;
			$curVal = strval($this->transmit_no->CurrentValue);
			if ($curVal <> "") {
				$this->transmit_no->ViewValue = $this->transmit_no->lookupCacheOption($curVal);
				if ($this->transmit_no->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"transmittal_no\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->transmit_no->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->transmit_no->ViewValue = $this->transmit_no->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->transmit_no->ViewValue = $this->transmit_no->CurrentValue;
					}
				}
			} else {
				$this->transmit_no->ViewValue = NULL;
			}
			}
			$this->transmit_no->CellCssStyle .= "text-align: left;";
			$this->transmit_no->ViewCustomAttributes = "";

			// transmit_date
			$this->transmit_date->ViewValue = $this->transmit_date->CurrentValue;
			$this->transmit_date->ViewValue = FormatDateTime($this->transmit_date->ViewValue, 0);
			$this->transmit_date->ViewCustomAttributes = "";

			// direction
			if (strval($this->direction->CurrentValue) <> "") {
				$this->direction->ViewValue = $this->direction->optionCaption($this->direction->CurrentValue);
			} else {
				$this->direction->ViewValue = NULL;
			}
			$this->direction->ViewCustomAttributes = "";

			// approval_status
			$curVal = strval($this->approval_status->CurrentValue);
			if ($curVal <> "") {
				$this->approval_status->ViewValue = $this->approval_status->lookupCacheOption($curVal);
				if ($this->approval_status->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"short_code\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->approval_status->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->approval_status->ViewValue = $this->approval_status->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->approval_status->ViewValue = $this->approval_status->CurrentValue;
					}
				}
			} else {
				$this->approval_status->ViewValue = NULL;
			}
			$this->approval_status->ViewCustomAttributes = "";

			// transaction_date
			$this->transaction_date->ViewValue = $this->transaction_date->CurrentValue;
			$this->transaction_date->ViewValue = FormatDateTime($this->transaction_date->ViewValue, 0);
			$this->transaction_date->ViewCustomAttributes = "";

			// document_native
			$this->document_native->ViewValue = $this->document_native->CurrentValue;
			$this->document_native->CellCssStyle .= "text-align: left;";
			$this->document_native->ViewCustomAttributes = "";

			// firelink_doc_no
			$this->firelink_doc_no->LinkCustomAttributes = "";
			if (!EmptyValue($this->document_link->Upload->DbValue)) {
				$this->firelink_doc_no->HrefValue = GetFileUploadUrl($this->document_link, $this->document_link->Upload->DbValue); // Add prefix/suffix
				$this->firelink_doc_no->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->firelink_doc_no->HrefValue = FullUrl($this->firelink_doc_no->HrefValue, "href");
			} else {
				$this->firelink_doc_no->HrefValue = "";
			}
			$this->firelink_doc_no->TooltipValue = "";
			if (!$this->isExport())
				$this->firelink_doc_no->ViewValue = $this->highlightValue($this->firelink_doc_no);

			// project_name
			$this->project_name->LinkCustomAttributes = "";
			$this->project_name->HrefValue = "";
			$this->project_name->TooltipValue = "";
			if (!$this->isExport())
				$this->project_name->ViewValue = $this->highlightValue($this->project_name);

			// document_tittle
			$this->document_tittle->LinkCustomAttributes = "";
			$this->document_tittle->HrefValue = "";
			$this->document_tittle->TooltipValue = "";
			if (!$this->isExport())
				$this->document_tittle->ViewValue = $this->highlightValue($this->document_tittle);

			// submit_no
			$this->submit_no->LinkCustomAttributes = "";
			$this->submit_no->HrefValue = "";
			$this->submit_no->TooltipValue = "";

			// revision_no
			$this->revision_no->LinkCustomAttributes = "";
			$this->revision_no->HrefValue = "";
			$this->revision_no->TooltipValue = "";

			// transmit_no
			$this->transmit_no->LinkCustomAttributes = "";
			$this->transmit_no->HrefValue = "";
			$this->transmit_no->TooltipValue = "";
			if (!$this->isExport())
				$this->transmit_no->ViewValue = $this->highlightValue($this->transmit_no);

			// transmit_date
			$this->transmit_date->LinkCustomAttributes = "";
			$this->transmit_date->HrefValue = "";
			$this->transmit_date->TooltipValue = "";

			// direction
			$this->direction->LinkCustomAttributes = "";
			$this->direction->HrefValue = "";
			$this->direction->TooltipValue = "";

			// approval_status
			$this->approval_status->LinkCustomAttributes = "";
			$this->approval_status->HrefValue = "";
			$this->approval_status->TooltipValue = "";

			// document_native
			$this->document_native->LinkCustomAttributes = "";
			$this->document_native->HrefValue = "";
			$this->document_native->TooltipValue = "";
			if (!$this->isExport())
				$this->document_native->ViewValue = $this->highlightValue($this->document_native);
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// firelink_doc_no
			$this->firelink_doc_no->EditAttrs["class"] = "form-control";
			$this->firelink_doc_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->firelink_doc_no->CurrentValue = HtmlDecode($this->firelink_doc_no->CurrentValue);
			$this->firelink_doc_no->EditValue = HtmlEncode($this->firelink_doc_no->CurrentValue);
			$curVal = strval($this->firelink_doc_no->CurrentValue);
			if ($curVal <> "") {
				$this->firelink_doc_no->EditValue = $this->firelink_doc_no->lookupCacheOption($curVal);
				if ($this->firelink_doc_no->EditValue === NULL) { // Lookup from database
					$filterWrk = "\"firelink_doc_no\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->firelink_doc_no->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->firelink_doc_no->EditValue = $this->firelink_doc_no->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->firelink_doc_no->EditValue = HtmlEncode($this->firelink_doc_no->CurrentValue);
					}
				}
			} else {
				$this->firelink_doc_no->EditValue = NULL;
			}
			$this->firelink_doc_no->PlaceHolder = RemoveHtml($this->firelink_doc_no->caption());

			// project_name
			$this->project_name->EditAttrs["class"] = "form-control";
			$this->project_name->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->project_name->CurrentValue = HtmlDecode($this->project_name->CurrentValue);
			$this->project_name->EditValue = HtmlEncode($this->project_name->CurrentValue);
			$this->project_name->PlaceHolder = RemoveHtml($this->project_name->caption());

			// document_tittle
			$this->document_tittle->EditAttrs["class"] = "form-control";
			$this->document_tittle->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->document_tittle->CurrentValue = HtmlDecode($this->document_tittle->CurrentValue);
			$this->document_tittle->EditValue = HtmlEncode($this->document_tittle->CurrentValue);
			$this->document_tittle->PlaceHolder = RemoveHtml($this->document_tittle->caption());

			// submit_no
			$this->submit_no->EditAttrs["class"] = "form-control";
			$this->submit_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->submit_no->CurrentValue = HtmlDecode($this->submit_no->CurrentValue);
			$this->submit_no->EditValue = HtmlEncode($this->submit_no->CurrentValue);
			$this->submit_no->PlaceHolder = RemoveHtml($this->submit_no->caption());

			// revision_no
			$this->revision_no->EditAttrs["class"] = "form-control";
			$this->revision_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->revision_no->CurrentValue = HtmlDecode($this->revision_no->CurrentValue);
			$this->revision_no->EditValue = HtmlEncode($this->revision_no->CurrentValue);
			$this->revision_no->PlaceHolder = RemoveHtml($this->revision_no->caption());

			// transmit_no
			$this->transmit_no->EditAttrs["class"] = "form-control";
			$this->transmit_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no->CurrentValue = HtmlDecode($this->transmit_no->CurrentValue);
			$this->transmit_no->EditValue = HtmlEncode($this->transmit_no->CurrentValue);
			$curVal = strval($this->transmit_no->CurrentValue);
			if ($curVal <> "") {
				$this->transmit_no->EditValue = $this->transmit_no->lookupCacheOption($curVal);
				if ($this->transmit_no->EditValue === NULL) { // Lookup from database
					$filterWrk = "\"transmittal_no\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->transmit_no->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->transmit_no->EditValue = $this->transmit_no->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->transmit_no->EditValue = HtmlEncode($this->transmit_no->CurrentValue);
					}
				}
			} else {
				$this->transmit_no->EditValue = NULL;
			}
			$this->transmit_no->PlaceHolder = RemoveHtml($this->transmit_no->caption());

			// transmit_date
			$this->transmit_date->EditAttrs["class"] = "form-control";
			$this->transmit_date->EditCustomAttributes = "";
			$this->transmit_date->EditValue = HtmlEncode(FormatDateTime($this->transmit_date->CurrentValue, 8));
			$this->transmit_date->PlaceHolder = RemoveHtml($this->transmit_date->caption());

			// direction
			$this->direction->EditCustomAttributes = "";
			$this->direction->EditValue = $this->direction->options(FALSE);

			// approval_status
			$this->approval_status->EditCustomAttributes = "";
			$curVal = trim(strval($this->approval_status->CurrentValue));
			if ($curVal <> "")
				$this->approval_status->ViewValue = $this->approval_status->lookupCacheOption($curVal);
			else
				$this->approval_status->ViewValue = $this->approval_status->Lookup !== NULL && is_array($this->approval_status->Lookup->Options) ? $curVal : NULL;
			if ($this->approval_status->ViewValue !== NULL) { // Load from cache
				$this->approval_status->EditValue = array_values($this->approval_status->Lookup->Options);
				if ($this->approval_status->ViewValue == "")
					$this->approval_status->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "\"short_code\"" . SearchString("=", $this->approval_status->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->approval_status->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->approval_status->ViewValue = $this->approval_status->displayValue($arwrk);
				} else {
					$this->approval_status->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->approval_status->EditValue = $arwrk;
			}

			// document_native
			$this->document_native->EditAttrs["class"] = "form-control";
			$this->document_native->EditCustomAttributes = "";
			$this->document_native->EditValue = HtmlEncode($this->document_native->CurrentValue);
			$this->document_native->PlaceHolder = RemoveHtml($this->document_native->caption());

			// Add refer script
			// firelink_doc_no

			$this->firelink_doc_no->LinkCustomAttributes = "";
			if (!EmptyValue($this->document_link->Upload->DbValue)) {
				$this->firelink_doc_no->HrefValue = GetFileUploadUrl($this->document_link, $this->document_link->Upload->DbValue); // Add prefix/suffix
				$this->firelink_doc_no->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->firelink_doc_no->HrefValue = FullUrl($this->firelink_doc_no->HrefValue, "href");
			} else {
				$this->firelink_doc_no->HrefValue = "";
			}

			// project_name
			$this->project_name->LinkCustomAttributes = "";
			$this->project_name->HrefValue = "";

			// document_tittle
			$this->document_tittle->LinkCustomAttributes = "";
			$this->document_tittle->HrefValue = "";

			// submit_no
			$this->submit_no->LinkCustomAttributes = "";
			$this->submit_no->HrefValue = "";

			// revision_no
			$this->revision_no->LinkCustomAttributes = "";
			$this->revision_no->HrefValue = "";

			// transmit_no
			$this->transmit_no->LinkCustomAttributes = "";
			$this->transmit_no->HrefValue = "";

			// transmit_date
			$this->transmit_date->LinkCustomAttributes = "";
			$this->transmit_date->HrefValue = "";

			// direction
			$this->direction->LinkCustomAttributes = "";
			$this->direction->HrefValue = "";

			// approval_status
			$this->approval_status->LinkCustomAttributes = "";
			$this->approval_status->HrefValue = "";

			// document_native
			$this->document_native->LinkCustomAttributes = "";
			$this->document_native->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// firelink_doc_no
			$this->firelink_doc_no->EditAttrs["class"] = "form-control";
			$this->firelink_doc_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->firelink_doc_no->AdvancedSearch->SearchValue = HtmlDecode($this->firelink_doc_no->AdvancedSearch->SearchValue);
			$this->firelink_doc_no->EditValue = HtmlEncode($this->firelink_doc_no->AdvancedSearch->SearchValue);
			$this->firelink_doc_no->PlaceHolder = RemoveHtml($this->firelink_doc_no->caption());

			// project_name
			$this->project_name->EditAttrs["class"] = "form-control";
			$this->project_name->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->project_name->AdvancedSearch->SearchValue = HtmlDecode($this->project_name->AdvancedSearch->SearchValue);
			$this->project_name->EditValue = HtmlEncode($this->project_name->AdvancedSearch->SearchValue);
			$this->project_name->PlaceHolder = RemoveHtml($this->project_name->caption());

			// document_tittle
			$this->document_tittle->EditAttrs["class"] = "form-control";
			$this->document_tittle->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->document_tittle->AdvancedSearch->SearchValue = HtmlDecode($this->document_tittle->AdvancedSearch->SearchValue);
			$this->document_tittle->EditValue = HtmlEncode($this->document_tittle->AdvancedSearch->SearchValue);
			$this->document_tittle->PlaceHolder = RemoveHtml($this->document_tittle->caption());

			// submit_no
			$this->submit_no->EditAttrs["class"] = "form-control";
			$this->submit_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->submit_no->AdvancedSearch->SearchValue = HtmlDecode($this->submit_no->AdvancedSearch->SearchValue);
			$this->submit_no->EditValue = HtmlEncode($this->submit_no->AdvancedSearch->SearchValue);
			$this->submit_no->PlaceHolder = RemoveHtml($this->submit_no->caption());

			// revision_no
			$this->revision_no->EditAttrs["class"] = "form-control";
			$this->revision_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->revision_no->AdvancedSearch->SearchValue = HtmlDecode($this->revision_no->AdvancedSearch->SearchValue);
			$this->revision_no->EditValue = HtmlEncode($this->revision_no->AdvancedSearch->SearchValue);
			$this->revision_no->PlaceHolder = RemoveHtml($this->revision_no->caption());

			// transmit_no
			$this->transmit_no->EditAttrs["class"] = "form-control";
			$this->transmit_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no->AdvancedSearch->SearchValue = HtmlDecode($this->transmit_no->AdvancedSearch->SearchValue);
			$this->transmit_no->EditValue = HtmlEncode($this->transmit_no->AdvancedSearch->SearchValue);
			$this->transmit_no->PlaceHolder = RemoveHtml($this->transmit_no->caption());

			// transmit_date
			$this->transmit_date->EditAttrs["class"] = "form-control";
			$this->transmit_date->EditCustomAttributes = "";
			$this->transmit_date->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->transmit_date->AdvancedSearch->SearchValue, 0), 8));
			$this->transmit_date->PlaceHolder = RemoveHtml($this->transmit_date->caption());

			// direction
			$this->direction->EditCustomAttributes = "";
			$this->direction->EditValue = $this->direction->options(FALSE);

			// approval_status
			$this->approval_status->EditCustomAttributes = "";

			// document_native
			$this->document_native->EditAttrs["class"] = "form-control";
			$this->document_native->EditCustomAttributes = "";
			$this->document_native->EditValue = HtmlEncode($this->document_native->AdvancedSearch->SearchValue);
			$this->document_native->PlaceHolder = RemoveHtml($this->document_native->caption());
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->document_sequence->Required) {
			if (!$this->document_sequence->IsDetailKey && $this->document_sequence->FormValue != NULL && $this->document_sequence->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->document_sequence->caption(), $this->document_sequence->RequiredErrorMessage));
			}
		}
		if ($this->firelink_doc_no->Required) {
			if (!$this->firelink_doc_no->IsDetailKey && $this->firelink_doc_no->FormValue != NULL && $this->firelink_doc_no->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->firelink_doc_no->caption(), $this->firelink_doc_no->RequiredErrorMessage));
			}
		}
		if ($this->project_name->Required) {
			if (!$this->project_name->IsDetailKey && $this->project_name->FormValue != NULL && $this->project_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->project_name->caption(), $this->project_name->RequiredErrorMessage));
			}
		}
		if ($this->document_tittle->Required) {
			if (!$this->document_tittle->IsDetailKey && $this->document_tittle->FormValue != NULL && $this->document_tittle->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->document_tittle->caption(), $this->document_tittle->RequiredErrorMessage));
			}
		}
		if ($this->submit_no->Required) {
			if (!$this->submit_no->IsDetailKey && $this->submit_no->FormValue != NULL && $this->submit_no->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->submit_no->caption(), $this->submit_no->RequiredErrorMessage));
			}
		}
		if ($this->revision_no->Required) {
			if (!$this->revision_no->IsDetailKey && $this->revision_no->FormValue != NULL && $this->revision_no->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->revision_no->caption(), $this->revision_no->RequiredErrorMessage));
			}
		}
		if ($this->transmit_no->Required) {
			if (!$this->transmit_no->IsDetailKey && $this->transmit_no->FormValue != NULL && $this->transmit_no->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no->caption(), $this->transmit_no->RequiredErrorMessage));
			}
		}
		if ($this->transmit_date->Required) {
			if (!$this->transmit_date->IsDetailKey && $this->transmit_date->FormValue != NULL && $this->transmit_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date->caption(), $this->transmit_date->RequiredErrorMessage));
			}
		}
		if ($this->direction->Required) {
			if ($this->direction->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction->caption(), $this->direction->RequiredErrorMessage));
			}
		}
		if ($this->approval_status->Required) {
			if ($this->approval_status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status->caption(), $this->approval_status->RequiredErrorMessage));
			}
		}
		if ($this->document_link->Required) {
			if ($this->document_link->Upload->FileName == "" && !$this->document_link->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->document_link->caption(), $this->document_link->RequiredErrorMessage));
			}
		}
		if ($this->transaction_date->Required) {
			if (!$this->transaction_date->IsDetailKey && $this->transaction_date->FormValue != NULL && $this->transaction_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transaction_date->caption(), $this->transaction_date->RequiredErrorMessage));
			}
		}
		if ($this->document_native->Required) {
			if (!$this->document_native->IsDetailKey && $this->document_native->FormValue != NULL && $this->document_native->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->document_native->caption(), $this->document_native->RequiredErrorMessage));
			}
		}
		if ($this->username->Required) {
			if (!$this->username->IsDetailKey && $this->username->FormValue != NULL && $this->username->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->username->caption(), $this->username->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];
		if ($this->AuditTrailOnDelete)
			$this->writeAuditTrailDummy($Language->phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey <> "")
					$thisKey .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
				$thisKey .= $row['document_sequence'];
				if (DELETE_UPLOADED_FILES) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($deleteRows === FALSE)
					break;
				if ($key <> "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// firelink_doc_no
		$this->firelink_doc_no->setDbValueDef($rsnew, $this->firelink_doc_no->CurrentValue, "", FALSE);

		// project_name
		$this->project_name->setDbValueDef($rsnew, $this->project_name->CurrentValue, NULL, FALSE);

		// document_tittle
		$this->document_tittle->setDbValueDef($rsnew, $this->document_tittle->CurrentValue, NULL, FALSE);

		// submit_no
		$this->submit_no->setDbValueDef($rsnew, $this->submit_no->CurrentValue, "", FALSE);

		// revision_no
		$this->revision_no->setDbValueDef($rsnew, $this->revision_no->CurrentValue, "", FALSE);

		// transmit_no
		$this->transmit_no->setDbValueDef($rsnew, $this->transmit_no->CurrentValue, "", FALSE);

		// transmit_date
		$this->transmit_date->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date->CurrentValue, 0), CurrentDate(), FALSE);

		// direction
		$this->direction->setDbValueDef($rsnew, $this->direction->CurrentValue, "", FALSE);

		// approval_status
		$this->approval_status->setDbValueDef($rsnew, $this->approval_status->CurrentValue, "", strval($this->approval_status->CurrentValue) == "");

		// document_native
		$this->document_native->setDbValueDef($rsnew, $this->document_native->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->firelink_doc_no->AdvancedSearch->load();
		$this->project_name->AdvancedSearch->load();
		$this->document_tittle->AdvancedSearch->load();
		$this->submit_no->AdvancedSearch->load();
		$this->revision_no->AdvancedSearch->load();
		$this->transmit_no->AdvancedSearch->load();
		$this->transmit_date->AdvancedSearch->load();
		$this->direction->AdvancedSearch->load();
		$this->approval_status->AdvancedSearch->load();
		$this->document_native->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"ew.export(document.ftransaction_detailslist,'" . $this->ExportExcelUrl . "','excel',true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"ew.export(document.ftransaction_detailslist,'" . $this->ExportWordUrl . "','word',true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"ew.export(document.ftransaction_detailslist,'" . $this->ExportPdfUrl . "','pdf',true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
		$item->Body = "<button id=\"emf_transaction_details\" class=\"ew-export-link ew-email\" title=\"" . $Language->phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->phrase("ExportToEmailText") . "\" onclick=\"ew.emailDialogShow({lnk:'emf_transaction_details',hdr:ew.language.phrase('ExportToEmailText'),f:document.ftransaction_detailslist,sel:false" . $url . "});\">" . $Language->phrase("ExportToEmail") . "</button>";
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
						case "x_firelink_doc_no":
							break;
						case "x_transmit_no":
							break;
						case "x_approval_status":
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