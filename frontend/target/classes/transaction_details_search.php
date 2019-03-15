<?php
namespace PHPMaker2019\pdm;

/**
 * Page class
 */
class transaction_details_search extends transaction_details
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "vishal-pdm";

	// Table name
	public $TableName = 'transaction_details';

	// Page object name
	public $PageObjName = "transaction_details_search";

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
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (user_dtls)
		if (!isset($GLOBALS['user_dtls']))
			$GLOBALS['user_dtls'] = new user_dtls();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "transaction_detailsview.php")
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
					$this->terminate(GetUrl("transaction_detailslist.php"));
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

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->document_sequence->Visible = FALSE;
		$this->firelink_doc_no->setVisibility();
		$this->submit_no->setVisibility();
		$this->revision_no->setVisibility();
		$this->transmit_no->setVisibility();
		$this->transmit_date->setVisibility();
		$this->direction->setVisibility();
		$this->approval_status->setVisibility();
		$this->document_link->setVisibility();
		$this->transaction_date->Visible = FALSE;
		$this->document_native->setVisibility();
		$this->username->Visible = FALSE;
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
		$this->setupLookupOptions($this->firelink_doc_no);
		$this->setupLookupOptions($this->transmit_no);
		$this->setupLookupOptions($this->approval_status);

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
					$srchStr = "transaction_detailslist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->submit_no); // submit_no
		$this->buildSearchUrl($srchUrl, $this->revision_no); // revision_no
		$this->buildSearchUrl($srchUrl, $this->transmit_no); // transmit_no
		$this->buildSearchUrl($srchUrl, $this->transmit_date); // transmit_date
		$this->buildSearchUrl($srchUrl, $this->direction); // direction
		$this->buildSearchUrl($srchUrl, $this->approval_status); // approval_status
		$this->buildSearchUrl($srchUrl, $this->document_link); // document_link
		$this->buildSearchUrl($srchUrl, $this->document_native); // document_native
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
		$this->firelink_doc_no->AdvancedSearch->setSearchCondition($CurrentForm->getValue("v_firelink_doc_no"));
		$this->firelink_doc_no->AdvancedSearch->setSearchValue2($CurrentForm->getValue("y_firelink_doc_no"));
		$this->firelink_doc_no->AdvancedSearch->setSearchOperator2($CurrentForm->getValue("w_firelink_doc_no"));

		// submit_no
		if (!$this->isAddOrEdit())
			$this->submit_no->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_submit_no"));
		$this->submit_no->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_submit_no"));

		// revision_no
		if (!$this->isAddOrEdit())
			$this->revision_no->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_revision_no"));
		$this->revision_no->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_revision_no"));

		// transmit_no
		if (!$this->isAddOrEdit())
			$this->transmit_no->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_transmit_no"));
		$this->transmit_no->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_transmit_no"));

		// transmit_date
		if (!$this->isAddOrEdit())
			$this->transmit_date->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_transmit_date"));
		$this->transmit_date->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_transmit_date"));

		// direction
		if (!$this->isAddOrEdit())
			$this->direction->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_direction"));
		$this->direction->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_direction"));

		// approval_status
		if (!$this->isAddOrEdit())
			$this->approval_status->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_approval_status"));
		$this->approval_status->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_approval_status"));

		// document_link
		if (!$this->isAddOrEdit())
			$this->document_link->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_document_link"));
		$this->document_link->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_document_link"));

		// document_native
		if (!$this->isAddOrEdit())
			$this->document_native->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_document_native"));
		$this->document_native->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_document_native"));
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// document_sequence
		// firelink_doc_no
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
						$arwrk[3] = $rswrk->fields('df3');
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
						$arwrk[2] = $rswrk->fields('df2');
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

			// document_link
			if (!EmptyValue($this->document_link->Upload->DbValue)) {
				$this->document_link->ViewValue = $this->document_link->Upload->DbValue;
			} else {
				$this->document_link->ViewValue = "";
			}
			$this->document_link->ViewCustomAttributes = "";

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
			$this->firelink_doc_no->HrefValue = "";
			$this->firelink_doc_no->TooltipValue = "";

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

			// document_link
			$this->document_link->LinkCustomAttributes = "";
			if (!EmptyValue($this->document_link->Upload->DbValue)) {
				$this->document_link->HrefValue = GetFileUploadUrl($this->document_link, $this->document_link->Upload->DbValue); // Add prefix/suffix
				$this->document_link->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->document_link->HrefValue = FullUrl($this->document_link->HrefValue, "href");
			} else {
				$this->document_link->HrefValue = "";
			}
			$this->document_link->ExportHrefValue = $this->document_link->UploadPath . $this->document_link->Upload->DbValue;
			$this->document_link->TooltipValue = "";

			// document_native
			$this->document_native->LinkCustomAttributes = "";
			$this->document_native->HrefValue = "";
			$this->document_native->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// firelink_doc_no
			$this->firelink_doc_no->EditAttrs["class"] = "form-control";
			$this->firelink_doc_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->firelink_doc_no->AdvancedSearch->SearchValue = HtmlDecode($this->firelink_doc_no->AdvancedSearch->SearchValue);
			$this->firelink_doc_no->EditValue = HtmlEncode($this->firelink_doc_no->AdvancedSearch->SearchValue);
			$this->firelink_doc_no->PlaceHolder = RemoveHtml($this->firelink_doc_no->caption());
			$this->firelink_doc_no->EditAttrs["class"] = "form-control";
			$this->firelink_doc_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->firelink_doc_no->AdvancedSearch->SearchValue2 = HtmlDecode($this->firelink_doc_no->AdvancedSearch->SearchValue2);
			$this->firelink_doc_no->EditValue2 = HtmlEncode($this->firelink_doc_no->AdvancedSearch->SearchValue2);
			$this->firelink_doc_no->PlaceHolder = RemoveHtml($this->firelink_doc_no->caption());

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
			$curVal = trim(strval($this->approval_status->AdvancedSearch->SearchValue));
			if ($curVal <> "")
				$this->approval_status->AdvancedSearch->ViewValue = $this->approval_status->lookupCacheOption($curVal);
			else
				$this->approval_status->AdvancedSearch->ViewValue = $this->approval_status->Lookup !== NULL && is_array($this->approval_status->Lookup->Options) ? $curVal : NULL;
			if ($this->approval_status->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->approval_status->EditValue = array_values($this->approval_status->Lookup->Options);
				if ($this->approval_status->AdvancedSearch->ViewValue == "")
					$this->approval_status->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "\"short_code\"" . SearchString("=", $this->approval_status->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->approval_status->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->approval_status->AdvancedSearch->ViewValue = $this->approval_status->displayValue($arwrk);
				} else {
					$this->approval_status->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->approval_status->EditValue = $arwrk;
			}

			// document_link
			$this->document_link->EditAttrs["class"] = "form-control";
			$this->document_link->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->document_link->AdvancedSearch->SearchValue = HtmlDecode($this->document_link->AdvancedSearch->SearchValue);
			$this->document_link->EditValue = HtmlEncode($this->document_link->AdvancedSearch->SearchValue);
			$this->document_link->PlaceHolder = RemoveHtml($this->document_link->caption());

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
		if (!CheckDate($this->transmit_date->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->transmit_date->errorMessage());
		}

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
		$this->submit_no->AdvancedSearch->load();
		$this->revision_no->AdvancedSearch->load();
		$this->transmit_no->AdvancedSearch->load();
		$this->transmit_date->AdvancedSearch->load();
		$this->direction->AdvancedSearch->load();
		$this->approval_status->AdvancedSearch->load();
		$this->document_link->AdvancedSearch->load();
		$this->document_native->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("transaction_detailslist.php"), "", $this->TableVar, TRUE);
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
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->Options) == 0) {
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
}
?>