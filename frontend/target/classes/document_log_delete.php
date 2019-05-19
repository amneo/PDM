<?php
namespace PHPMaker2019\pdm;

/**
 * Page class
 */
class document_log_delete extends document_log
{

	// Page ID
	public $PageID = "delete";

	// Project ID
	public $ProjectID = "{vishal-pdm}";

	// Table name
	public $TableName = 'document_log';

	// Page object name
	public $PageObjName = "document_log_delete";

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
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (user_dtls)
		if (!isset($GLOBALS['user_dtls']))
			$GLOBALS['user_dtls'] = new user_dtls();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'delete');

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
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRec;
	public $TotalRecs = 0;
	public $RecCnt;
	public $RecKeys = array();
	public $StartRowCnt = 1;
	public $RowCnt = 0;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm;

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
			if (!$Security->canDelete()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("document_loglist.php"));
				else
					$this->terminate(GetUrl("login.php"));
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
		$this->CurrentAction = Param("action"); // Set up current action
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

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

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

		// Set up lookup cache
		// Set up Breadcrumb

		$this->setupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->getRecordKeys(); // Load record keys
		$filter = $this->getFilterFromRecordKeys();
		if ($filter == "") {
			$this->terminate("document_loglist.php"); // Prevent SQL injection, return to list
			return;
		}

		// Set up filter (WHERE Clause)
		$this->CurrentFilter = $filter;

		// Get action
		if (IsApi()) {
			$this->CurrentAction = "delete"; // Delete record directly
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action");
		} elseif (Get("action") == "1") {
			$this->CurrentAction = "delete"; // Delete record directly
		} else {
			$this->CurrentAction = "show"; // Display record
		}
		if ($this->isDelete()) {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->deleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
				if (IsApi()) {
					$this->terminate(TRUE);
					return;
				} else {
					$this->terminate($this->getReturnUrl()); // Return to caller
				}
			} else { // Delete failed
				if (IsApi()) {
					$this->terminate();
					return;
				}
				$this->CurrentAction = "show"; // Display record
			}
		}
		if ($this->isShow()) { // Load records for display
			if ($this->Recordset = $this->loadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->close();
				$this->terminate("document_loglist.php"); // Return to list
			}
		}
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
		$this->submit_no_1->setDbValue($row['submit_no_1']);
		$this->revision_no_1->setDbValue($row['revision_no_1']);
		$this->direction_1->setDbValue($row['direction_1']);
		$this->planned_date_1->setDbValue($row['planned_date_1']);
		$this->transmit_date_1->setDbValue($row['transmit_date_1']);
		$this->transmit_no_1->setDbValue($row['transmit_no_1']);
		$this->approval_status_1->setDbValue($row['approval_status_1']);
		$this->direction_file_1->setDbValue($row['direction_file_1']);
		$this->submit_no_2->setDbValue($row['submit_no_2']);
		$this->revision_no_2->setDbValue($row['revision_no_2']);
		$this->direction_2->setDbValue($row['direction_2']);
		$this->planned_date_2->setDbValue($row['planned_date_2']);
		$this->transmit_date_2->setDbValue($row['transmit_date_2']);
		$this->transmit_no_2->setDbValue($row['transmit_no_2']);
		$this->approval_status_2->setDbValue($row['approval_status_2']);
		$this->direction_file_2->setDbValue($row['direction_file_2']);
		$this->submit_no_3->setDbValue($row['submit_no_3']);
		$this->revision_no_3->setDbValue($row['revision_no_3']);
		$this->direction_3->setDbValue($row['direction_3']);
		$this->planned_date_3->setDbValue($row['planned_date_3']);
		$this->transmit_date_3->setDbValue($row['transmit_date_3']);
		$this->transmit_no_3->setDbValue($row['transmit_no_3']);
		$this->approval_status_3->setDbValue($row['approval_status_3']);
		$this->direction_file_3->setDbValue($row['direction_file_3']);
		$this->submit_no_4->setDbValue($row['submit_no_4']);
		$this->revision_no_4->setDbValue($row['revision_no_4']);
		$this->direction_4->setDbValue($row['direction_4']);
		$this->planned_date_4->setDbValue($row['planned_date_4']);
		$this->transmit_date_4->setDbValue($row['transmit_date_4']);
		$this->transmit_no_4->setDbValue($row['transmit_no_4']);
		$this->approval_status_4->setDbValue($row['approval_status_4']);
		$this->direction_file_4->setDbValue($row['direction_file_4']);
		$this->submit_no_5->setDbValue($row['submit_no_5']);
		$this->revision_no_5->setDbValue($row['revision_no_5']);
		$this->direction_5->setDbValue($row['direction_5']);
		$this->planned_date_5->setDbValue($row['planned_date_5']);
		$this->transmit_date_5->setDbValue($row['transmit_date_5']);
		$this->transmit_no_5->setDbValue($row['transmit_no_5']);
		$this->approval_status_5->setDbValue($row['approval_status_5']);
		$this->direction_file_5->setDbValue($row['direction_file_5']);
		$this->submit_no_6->setDbValue($row['submit_no_6']);
		$this->revision_no_6->setDbValue($row['revision_no_6']);
		$this->direction_6->setDbValue($row['direction_6']);
		$this->planned_date_6->setDbValue($row['planned_date_6']);
		$this->transmit_date_6->setDbValue($row['transmit_date_6']);
		$this->transmit_no_6->setDbValue($row['transmit_no_6']);
		$this->approval_status_6->setDbValue($row['approval_status_6']);
		$this->direction_file_6->setDbValue($row['direction_file_6']);
		$this->submit_no_7->setDbValue($row['submit_no_7']);
		$this->revision_no_7->setDbValue($row['revision_no_7']);
		$this->direction_7->setDbValue($row['direction_7']);
		$this->planned_date_7->setDbValue($row['planned_date_7']);
		$this->transmit_date_7->setDbValue($row['transmit_date_7']);
		$this->transmit_no_7->setDbValue($row['transmit_no_7']);
		$this->approval_status_7->setDbValue($row['approval_status_7']);
		$this->direction_file_7->setDbValue($row['direction_file_7']);
		$this->submit_no_8->setDbValue($row['submit_no_8']);
		$this->revision_no_8->setDbValue($row['revision_no_8']);
		$this->direction_8->setDbValue($row['direction_8']);
		$this->planned_date_8->setDbValue($row['planned_date_8']);
		$this->transmit_date_8->setDbValue($row['transmit_date_8']);
		$this->transmit_no_8->setDbValue($row['transmit_no_8']);
		$this->approval_status_8->setDbValue($row['approval_status_8']);
		$this->direction_file_8->setDbValue($row['direction_file_8']);
		$this->submit_no_9->setDbValue($row['submit_no_9']);
		$this->revision_no_9->setDbValue($row['revision_no_9']);
		$this->direction_9->setDbValue($row['direction_9']);
		$this->planned_date_9->setDbValue($row['planned_date_9']);
		$this->transmit_date_9->setDbValue($row['transmit_date_9']);
		$this->transmit_no_9->setDbValue($row['transmit_no_9']);
		$this->approval_status_9->setDbValue($row['approval_status_9']);
		$this->direction_file_9->setDbValue($row['direction_file_9']);
		$this->submit_no_10->setDbValue($row['submit_no_10']);
		$this->revision_no_10->setDbValue($row['revision_no_10']);
		$this->direction_10->setDbValue($row['direction_10']);
		$this->planned_date_10->setDbValue($row['planned_date_10']);
		$this->transmit_date_10->setDbValue($row['transmit_date_10']);
		$this->transmit_no_10->setDbValue($row['transmit_no_10']);
		$this->approval_status_10->setDbValue($row['approval_status_10']);
		$this->direction_file_10->setDbValue($row['direction_file_10']);
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

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
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

			// log_updatedon
			$this->log_updatedon->ViewValue = $this->log_updatedon->CurrentValue;
			$this->log_updatedon->ViewValue = FormatDateTime($this->log_updatedon->ViewValue, 115);
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
			$this->approval_status_2->HrefValue = "";
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
			$this->approval_status_3->HrefValue = "";
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
			$this->approval_status_4->HrefValue = "";
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
			$this->approval_status_6->HrefValue = "";
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
			$this->approval_status_7->HrefValue = "";
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
			$this->approval_status_8->HrefValue = "";
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
			$this->approval_status_9->HrefValue = "";
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
			$this->approval_status_10->HrefValue = "";
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
		$conn->beginTrans();

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
				$thisKey .= $row['log_id'];
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
		if ($deleteRows) {
			$conn->commitTrans(); // Commit the changes
		} else {
			$conn->rollbackTrans(); // Rollback changes
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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("document_loglist.php"), "", $this->TableVar, TRUE);
		$pageId = "delete";
		$Breadcrumb->add("delete", $pageId, $url);
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
}
?>