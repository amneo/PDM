<?php
namespace PHPMaker2019\pdm;

/**
 * Page class
 */
class document_log_search extends document_log
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{vishal-pdm}";

	// Table name
	public $TableName = 'document_log';

	// Page object name
	public $PageObjName = "document_log_search";

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

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "document_logview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
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
	public $FormClassName = "ew-horizontal ew-form ew-search-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$SearchError, $SkipHeaderFooter;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// Is modal
		$this->IsModal = (Param("modal") == "1");

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
			if (!$Security->canSearch()) {
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

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->log_id->Visible = FALSE;
		$this->firelink_doc_no->setVisibility();
		$this->client_doc_no->setVisibility();
		$this->order_number->setVisibility();
		$this->project_name->setVisibility();
		$this->document_tittle->setVisibility();
		$this->current_status->setVisibility();
		$this->current_status_file->Visible = FALSE;
		$this->submit_no_1->Visible = FALSE;
		$this->revision_no_1->Visible = FALSE;
		$this->direction_1->Visible = FALSE;
		$this->planned_date_1->Visible = FALSE;
		$this->transmit_date_1->Visible = FALSE;
		$this->transmit_no_1->Visible = FALSE;
		$this->approval_status_1->Visible = FALSE;
		$this->direction_file_1->Visible = FALSE;
		$this->submit_no_2->Visible = FALSE;
		$this->revision_no_2->Visible = FALSE;
		$this->direction_2->Visible = FALSE;
		$this->planned_date_2->Visible = FALSE;
		$this->transmit_date_2->Visible = FALSE;
		$this->transmit_no_2->Visible = FALSE;
		$this->approval_status_2->Visible = FALSE;
		$this->direction_file_2->Visible = FALSE;
		$this->submit_no_3->Visible = FALSE;
		$this->revision_no_3->Visible = FALSE;
		$this->direction_3->Visible = FALSE;
		$this->planned_date_3->Visible = FALSE;
		$this->transmit_date_3->Visible = FALSE;
		$this->transmit_no_3->Visible = FALSE;
		$this->approval_status_3->Visible = FALSE;
		$this->direction_file_3->Visible = FALSE;
		$this->submit_no_4->Visible = FALSE;
		$this->revision_no_4->Visible = FALSE;
		$this->direction_4->Visible = FALSE;
		$this->planned_date_4->Visible = FALSE;
		$this->transmit_date_4->Visible = FALSE;
		$this->transmit_no_4->Visible = FALSE;
		$this->approval_status_4->Visible = FALSE;
		$this->direction_file_4->Visible = FALSE;
		$this->submit_no_5->Visible = FALSE;
		$this->revision_no_5->Visible = FALSE;
		$this->direction_5->Visible = FALSE;
		$this->planned_date_5->Visible = FALSE;
		$this->transmit_date_5->Visible = FALSE;
		$this->transmit_no_5->Visible = FALSE;
		$this->approval_status_5->Visible = FALSE;
		$this->direction_file_5->Visible = FALSE;
		$this->submit_no_6->Visible = FALSE;
		$this->revision_no_6->Visible = FALSE;
		$this->direction_6->Visible = FALSE;
		$this->planned_date_6->Visible = FALSE;
		$this->transmit_date_6->Visible = FALSE;
		$this->transmit_no_6->Visible = FALSE;
		$this->approval_status_6->Visible = FALSE;
		$this->direction_file_6->Visible = FALSE;
		$this->submit_no_7->Visible = FALSE;
		$this->revision_no_7->Visible = FALSE;
		$this->direction_7->Visible = FALSE;
		$this->planned_date_7->Visible = FALSE;
		$this->transmit_date_7->Visible = FALSE;
		$this->transmit_no_7->Visible = FALSE;
		$this->approval_status_7->Visible = FALSE;
		$this->direction_file_7->Visible = FALSE;
		$this->submit_no_8->Visible = FALSE;
		$this->revision_no_8->Visible = FALSE;
		$this->direction_8->Visible = FALSE;
		$this->planned_date_8->Visible = FALSE;
		$this->transmit_date_8->Visible = FALSE;
		$this->transmit_no_8->Visible = FALSE;
		$this->approval_status_8->Visible = FALSE;
		$this->direction_file_8->Visible = FALSE;
		$this->submit_no_9->Visible = FALSE;
		$this->revision_no_9->Visible = FALSE;
		$this->direction_9->Visible = FALSE;
		$this->planned_date_9->Visible = FALSE;
		$this->transmit_date_9->Visible = FALSE;
		$this->transmit_no_9->Visible = FALSE;
		$this->approval_status_9->Visible = FALSE;
		$this->direction_file_9->Visible = FALSE;
		$this->submit_no_10->Visible = FALSE;
		$this->revision_no_10->Visible = FALSE;
		$this->direction_10->Visible = FALSE;
		$this->planned_date_10->Visible = FALSE;
		$this->transmit_date_10->Visible = FALSE;
		$this->transmit_no_10->Visible = FALSE;
		$this->approval_status_10->Visible = FALSE;
		$this->direction_file_10->Visible = FALSE;
		$this->log_updatedon->Visible = FALSE;
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

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-search-form ew-horizontal";
		if ($this->isPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = Post("action");
			if ($this->isSearch()) {

				// Build search string for advanced search, remove blank field
				$this->loadSearchValues(); // Get search values
				if ($this->validateSearch()) {
					$srchStr = $this->buildAdvancedSearch();
				} else {
					$srchStr = "";
					$this->setFailureMessage($SearchError);
				}
				if ($srchStr <> "") {
					$srchStr = $this->getUrlParm($srchStr);
					$srchStr = "document_loglist.php" . "?" . $srchStr;
					$this->terminate($srchStr); // Go to list page
				}
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Render row for search
		$this->RowType = ROWTYPE_SEARCH;
		$this->resetAttributes();
		$this->renderRow();
	}

	// Build advanced search
	protected function buildAdvancedSearch()
	{
		$srchUrl = "";
		$this->buildSearchUrl($srchUrl, $this->firelink_doc_no); // firelink_doc_no
		$this->buildSearchUrl($srchUrl, $this->client_doc_no); // client_doc_no
		$this->buildSearchUrl($srchUrl, $this->order_number); // order_number
		$this->buildSearchUrl($srchUrl, $this->project_name); // project_name
		$this->buildSearchUrl($srchUrl, $this->document_tittle); // document_tittle
		$this->buildSearchUrl($srchUrl, $this->current_status); // current_status
		if ($srchUrl <> "")
			$srchUrl .= "&";
		$srchUrl .= "cmd=search";
		return $srchUrl;
	}

	// Build search URL
	protected function buildSearchUrl(&$url, &$fld, $oprOnly = FALSE)
	{
		global $CurrentForm;
		$wrk = "";
		$fldParm = $fld->Param;
		$fldVal = $CurrentForm->getValue("x_$fldParm");
		$fldOpr = $CurrentForm->getValue("z_$fldParm");
		$fldCond = $CurrentForm->getValue("v_$fldParm");
		$fldVal2 = $CurrentForm->getValue("y_$fldParm");
		$fldOpr2 = $CurrentForm->getValue("w_$fldParm");
		if (is_array($fldVal))
			$fldVal = implode(",", $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(",", $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		$fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
		if ($fldOpr == "BETWEEN") {
			$isValidValue = ($fldDataType <> DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal <> "" && $fldVal2 <> "" && $isValidValue) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			}
		} else {
			$isValidValue = ($fldDataType <> DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
			if ($fldVal <> "" && $isValidValue && IsValidOpr($fldOpr, $fldDataType)) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			} elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr <> "" && $oprOnly && IsValidOpr($fldOpr, $fldDataType))) {
				$wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
			}
			$isValidValue = ($fldDataType <> DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal2 <> "" && $isValidValue && IsValidOpr($fldOpr2, $fldDataType)) {
				if ($wrk <> "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&w_" . $fldParm . "=" . urlencode($fldOpr2);
			} elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 <> "" && $oprOnly && IsValidOpr($fldOpr2, $fldDataType))) {
				if ($wrk <> "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
			}
		}
		if ($wrk <> "") {
			if ($url <> "")
				$url .= "&";
			$url .= $wrk;
		}
	}
	protected function searchValueIsNumeric($fld, $value)
	{
		if (IsFloatFormat($fld->Type))
			$value = ConvertToFloatString($value);
		return is_numeric($value);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{
		global $CurrentForm;

		// Load search values
		// firelink_doc_no

		if (!$this->isAddOrEdit())
			$this->firelink_doc_no->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_firelink_doc_no"));
		$this->firelink_doc_no->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_firelink_doc_no"));

		// client_doc_no
		if (!$this->isAddOrEdit())
			$this->client_doc_no->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_client_doc_no"));
		$this->client_doc_no->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_client_doc_no"));

		// order_number
		if (!$this->isAddOrEdit())
			$this->order_number->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_order_number"));
		$this->order_number->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_order_number"));

		// project_name
		if (!$this->isAddOrEdit())
			$this->project_name->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_project_name"));
		$this->project_name->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_project_name"));

		// document_tittle
		if (!$this->isAddOrEdit())
			$this->document_tittle->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_document_tittle"));
		$this->document_tittle->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_document_tittle"));

		// current_status
		if (!$this->isAddOrEdit())
			$this->current_status->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_current_status"));
		$this->current_status->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_current_status"));
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
		// firelink_doc_no
		// client_doc_no
		// order_number
		// project_name
		// document_tittle
		// current_status
		// current_status_file
		// submit_no_1
		// revision_no_1
		// direction_1
		// planned_date_1
		// transmit_date_1
		// transmit_no_1
		// approval_status_1
		// direction_file_1
		// submit_no_2
		// revision_no_2
		// direction_2
		// planned_date_2
		// transmit_date_2
		// transmit_no_2
		// approval_status_2
		// direction_file_2
		// submit_no_3
		// revision_no_3
		// direction_3
		// planned_date_3
		// transmit_date_3
		// transmit_no_3
		// approval_status_3
		// direction_file_3
		// submit_no_4
		// revision_no_4
		// direction_4
		// planned_date_4
		// transmit_date_4
		// transmit_no_4
		// approval_status_4
		// direction_file_4
		// submit_no_5
		// revision_no_5
		// direction_5
		// planned_date_5
		// transmit_date_5
		// transmit_no_5
		// approval_status_5
		// direction_file_5
		// submit_no_6
		// revision_no_6
		// direction_6
		// planned_date_6
		// transmit_date_6
		// transmit_no_6
		// approval_status_6
		// direction_file_6
		// submit_no_7
		// revision_no_7
		// direction_7
		// planned_date_7
		// transmit_date_7
		// transmit_no_7
		// approval_status_7
		// direction_file_7
		// submit_no_8
		// revision_no_8
		// direction_8
		// planned_date_8
		// transmit_date_8
		// transmit_no_8
		// approval_status_8
		// direction_file_8
		// submit_no_9
		// revision_no_9
		// direction_9
		// planned_date_9
		// transmit_date_9
		// transmit_no_9
		// approval_status_9
		// direction_file_9
		// submit_no_10
		// revision_no_10
		// direction_10
		// planned_date_10
		// transmit_date_10
		// transmit_no_10
		// approval_status_10
		// direction_file_10
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
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$arwrk[2] = strtoupper($rswrk->fields('df2'));
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
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$arwrk[2] = strtoupper($rswrk->fields('df2'));
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
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$arwrk[2] = strtoupper($rswrk->fields('df2'));
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
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$arwrk[2] = strtoupper($rswrk->fields('df2'));
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
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$arwrk[2] = strtoupper($rswrk->fields('df2'));
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
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$arwrk[2] = strtoupper($rswrk->fields('df2'));
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
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$arwrk[2] = strtoupper($rswrk->fields('df2'));
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
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$arwrk[2] = strtoupper($rswrk->fields('df2'));
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
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$arwrk[2] = strtoupper($rswrk->fields('df2'));
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
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$arwrk[2] = strtoupper($rswrk->fields('df2'));
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
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// firelink_doc_no
			$this->firelink_doc_no->EditAttrs["class"] = "form-control";
			$this->firelink_doc_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->firelink_doc_no->AdvancedSearch->SearchValue = HtmlDecode($this->firelink_doc_no->AdvancedSearch->SearchValue);
			$this->firelink_doc_no->EditValue = HtmlEncode($this->firelink_doc_no->AdvancedSearch->SearchValue);
			$this->firelink_doc_no->PlaceHolder = RemoveHtml($this->firelink_doc_no->caption());

			// client_doc_no
			$this->client_doc_no->EditAttrs["class"] = "form-control";
			$this->client_doc_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->client_doc_no->AdvancedSearch->SearchValue = HtmlDecode($this->client_doc_no->AdvancedSearch->SearchValue);
			$this->client_doc_no->EditValue = HtmlEncode($this->client_doc_no->AdvancedSearch->SearchValue);
			$this->client_doc_no->PlaceHolder = RemoveHtml($this->client_doc_no->caption());

			// order_number
			$this->order_number->EditAttrs["class"] = "form-control";
			$this->order_number->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->order_number->AdvancedSearch->SearchValue = HtmlDecode($this->order_number->AdvancedSearch->SearchValue);
			$this->order_number->EditValue = HtmlEncode($this->order_number->AdvancedSearch->SearchValue);
			$this->order_number->PlaceHolder = RemoveHtml($this->order_number->caption());

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

			// current_status
			$this->current_status->EditAttrs["class"] = "form-control";
			$this->current_status->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->current_status->AdvancedSearch->SearchValue = HtmlDecode($this->current_status->AdvancedSearch->SearchValue);
			$this->current_status->EditValue = HtmlEncode($this->current_status->AdvancedSearch->SearchValue);
			$this->current_status->PlaceHolder = RemoveHtml($this->current_status->caption());
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

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->firelink_doc_no->AdvancedSearch->load();
		$this->client_doc_no->AdvancedSearch->load();
		$this->order_number->AdvancedSearch->load();
		$this->project_name->AdvancedSearch->load();
		$this->document_tittle->AdvancedSearch->load();
		$this->current_status->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("document_loglist.php"), "", $this->TableVar, TRUE);
		$pageId = "search";
		$Breadcrumb->add("search", $pageId, $url);
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
							$row[1] = strtoupper($row[1]);
							$row['df'] = $row[1];
							$row[2] = strtoupper($row[2]);
							$row['df2'] = $row[2];
							break;
						case "x_approval_status_2":
							$row[1] = strtoupper($row[1]);
							$row['df'] = $row[1];
							$row[2] = strtoupper($row[2]);
							$row['df2'] = $row[2];
							break;
						case "x_approval_status_3":
							$row[1] = strtoupper($row[1]);
							$row['df'] = $row[1];
							$row[2] = strtoupper($row[2]);
							$row['df2'] = $row[2];
							break;
						case "x_approval_status_4":
							$row[1] = strtoupper($row[1]);
							$row['df'] = $row[1];
							$row[2] = strtoupper($row[2]);
							$row['df2'] = $row[2];
							break;
						case "x_approval_status_5":
							$row[1] = strtoupper($row[1]);
							$row['df'] = $row[1];
							$row[2] = strtoupper($row[2]);
							$row['df2'] = $row[2];
							break;
						case "x_approval_status_6":
							$row[1] = strtoupper($row[1]);
							$row['df'] = $row[1];
							$row[2] = strtoupper($row[2]);
							$row['df2'] = $row[2];
							break;
						case "x_approval_status_7":
							$row[1] = strtoupper($row[1]);
							$row['df'] = $row[1];
							$row[2] = strtoupper($row[2]);
							$row['df2'] = $row[2];
							break;
						case "x_approval_status_8":
							$row[1] = strtoupper($row[1]);
							$row['df'] = $row[1];
							$row[2] = strtoupper($row[2]);
							$row['df2'] = $row[2];
							break;
						case "x_approval_status_9":
							$row[1] = strtoupper($row[1]);
							$row['df'] = $row[1];
							$row[2] = strtoupper($row[2]);
							$row['df2'] = $row[2];
							break;
						case "x_approval_status_10":
							$row[1] = strtoupper($row[1]);
							$row['df'] = $row[1];
							$row[2] = strtoupper($row[2]);
							$row['df2'] = $row[2];
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
}
?>