<?php
namespace PHPMaker2019\pdm;

/**
 * Page class
 */
class user_dtls_add extends user_dtls
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{vishal-pdm}";

	// Table name
	public $TableName = 'user_dtls';

	// Page object name
	public $PageObjName = "user_dtls_add";

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

		// Table object (user_dtls)
		if (!isset($GLOBALS["user_dtls"]) || get_class($GLOBALS["user_dtls"]) == PROJECT_NAMESPACE . "user_dtls") {
			$GLOBALS["user_dtls"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["user_dtls"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'user_dtls');

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
		global $EXPORT, $user_dtls;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($user_dtls);
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
					if ($pageName == "user_dtlsview.php")
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
			$key .= @$ar['user_id'];
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
			$this->user_id->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRec;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SkipHeaderFooter;

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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("user_dtlslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
				if (strval($Security->currentUserID()) == "") {
					$this->setFailureMessage(DeniedMessage()); // Set no permission
					$this->terminate(GetUrl("user_dtlslist.php"));
					return;
				}
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
		$this->user_id->Visible = FALSE;
		$this->username->setVisibility();
		$this->password->setVisibility();
		$this->create_login->Visible = FALSE;
		$this->account_valid->setVisibility();
		$this->last_login->Visible = FALSE;
		$this->email_addreess->setVisibility();
		$this->UserLevel->setVisibility();
		$this->history->Visible = FALSE;
		$this->reports_to->setVisibility();
		$this->name->setVisibility();
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
		$this->setupLookupOptions($this->UserLevel);
		$this->setupLookupOptions($this->reports_to);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("user_id") !== NULL) {
				$this->user_id->setQueryStringValue(Get("user_id"));
				$this->setKey("user_id", $this->user_id->CurrentValue); // Set up key
			} else {
				$this->setKey("user_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("user_dtlslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->GetAddUrl();
					if (GetPageName($returnUrl) == "user_dtlslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "user_dtlsview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->user_id->CurrentValue = NULL;
		$this->user_id->OldValue = $this->user_id->CurrentValue;
		$this->username->CurrentValue = NULL;
		$this->username->OldValue = $this->username->CurrentValue;
		$this->password->CurrentValue = NULL;
		$this->password->OldValue = $this->password->CurrentValue;
		$this->create_login->CurrentValue = NULL;
		$this->create_login->OldValue = $this->create_login->CurrentValue;
		$this->account_valid->CurrentValue = false;
		$this->last_login->CurrentValue = NULL;
		$this->last_login->OldValue = $this->last_login->CurrentValue;
		$this->email_addreess->CurrentValue = NULL;
		$this->email_addreess->OldValue = $this->email_addreess->CurrentValue;
		$this->UserLevel->CurrentValue = 10;
		$this->history->CurrentValue = NULL;
		$this->history->OldValue = $this->history->CurrentValue;
		$this->reports_to->CurrentValue = NULL;
		$this->reports_to->OldValue = $this->reports_to->CurrentValue;
		$this->name->CurrentValue = NULL;
		$this->name->OldValue = $this->name->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'username' first before field var 'x_username'
		$val = $CurrentForm->hasValue("username") ? $CurrentForm->getValue("username") : $CurrentForm->getValue("x_username");
		if (!$this->username->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->username->Visible = FALSE; // Disable update for API request
			else
				$this->username->setFormValue($val);
		}

		// Check field name 'password' first before field var 'x_password'
		$val = $CurrentForm->hasValue("password") ? $CurrentForm->getValue("password") : $CurrentForm->getValue("x_password");
		if (!$this->password->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->password->Visible = FALSE; // Disable update for API request
			else
				$this->password->setFormValue($val);
		}

		// Check field name 'account_valid' first before field var 'x_account_valid'
		$val = $CurrentForm->hasValue("account_valid") ? $CurrentForm->getValue("account_valid") : $CurrentForm->getValue("x_account_valid");
		if (!$this->account_valid->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->account_valid->Visible = FALSE; // Disable update for API request
			else
				$this->account_valid->setFormValue($val);
		}

		// Check field name 'email_addreess' first before field var 'x_email_addreess'
		$val = $CurrentForm->hasValue("email_addreess") ? $CurrentForm->getValue("email_addreess") : $CurrentForm->getValue("x_email_addreess");
		if (!$this->email_addreess->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->email_addreess->Visible = FALSE; // Disable update for API request
			else
				$this->email_addreess->setFormValue($val);
		}

		// Check field name 'UserLevel' first before field var 'x_UserLevel'
		$val = $CurrentForm->hasValue("UserLevel") ? $CurrentForm->getValue("UserLevel") : $CurrentForm->getValue("x_UserLevel");
		if (!$this->UserLevel->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->UserLevel->Visible = FALSE; // Disable update for API request
			else
				$this->UserLevel->setFormValue($val);
		}

		// Check field name 'reports_to' first before field var 'x_reports_to'
		$val = $CurrentForm->hasValue("reports_to") ? $CurrentForm->getValue("reports_to") : $CurrentForm->getValue("x_reports_to");
		if (!$this->reports_to->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->reports_to->Visible = FALSE; // Disable update for API request
			else
				$this->reports_to->setFormValue($val);
		}

		// Check field name 'name' first before field var 'x_name'
		$val = $CurrentForm->hasValue("name") ? $CurrentForm->getValue("name") : $CurrentForm->getValue("x_name");
		if (!$this->name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->name->Visible = FALSE; // Disable update for API request
			else
				$this->name->setFormValue($val);
		}

		// Check field name 'user_id' first before field var 'x_user_id'
		$val = $CurrentForm->hasValue("user_id") ? $CurrentForm->getValue("user_id") : $CurrentForm->getValue("x_user_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->username->CurrentValue = $this->username->FormValue;
		$this->password->CurrentValue = $this->password->FormValue;
		$this->account_valid->CurrentValue = $this->account_valid->FormValue;
		$this->email_addreess->CurrentValue = $this->email_addreess->FormValue;
		$this->UserLevel->CurrentValue = $this->UserLevel->FormValue;
		$this->reports_to->CurrentValue = $this->reports_to->FormValue;
		$this->name->CurrentValue = $this->name->FormValue;
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

		// Check if valid User ID
		if ($res) {
			$res = $this->showOptionLink('add');
			if (!$res) {
				$userIdMsg = DeniedMessage();
				$this->setFailureMessage($userIdMsg);
			}
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
		$this->user_id->setDbValue($row['user_id']);
		$this->username->setDbValue($row['username']);
		$this->password->setDbValue($row['password']);
		$this->create_login->setDbValue($row['create_login']);
		$this->account_valid->setDbValue((ConvertToBool($row['account_valid']) ? "1" : "0"));
		$this->last_login->setDbValue($row['last_login']);
		$this->email_addreess->setDbValue($row['email_addreess']);
		$this->UserLevel->setDbValue($row['UserLevel']);
		$this->history->setDbValue($row['history']);
		$this->reports_to->setDbValue($row['reports_to']);
		if (array_key_exists('EV__reports_to', $rs->fields)) {
			$this->reports_to->VirtualValue = $rs->fields('EV__reports_to'); // Set up virtual field value
		} else {
			$this->reports_to->VirtualValue = ""; // Clear value
		}
		$this->name->setDbValue($row['name']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['user_id'] = $this->user_id->CurrentValue;
		$row['username'] = $this->username->CurrentValue;
		$row['password'] = $this->password->CurrentValue;
		$row['create_login'] = $this->create_login->CurrentValue;
		$row['account_valid'] = $this->account_valid->CurrentValue;
		$row['last_login'] = $this->last_login->CurrentValue;
		$row['email_addreess'] = $this->email_addreess->CurrentValue;
		$row['UserLevel'] = $this->UserLevel->CurrentValue;
		$row['history'] = $this->history->CurrentValue;
		$row['reports_to'] = $this->reports_to->CurrentValue;
		$row['name'] = $this->name->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("user_id")) <> "")
			$this->user_id->CurrentValue = $this->getKey("user_id"); // user_id
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// user_id
		// username
		// password
		// create_login
		// account_valid
		// last_login
		// email_addreess
		// UserLevel
		// history
		// reports_to
		// name

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// user_id
			$this->user_id->ViewValue = $this->user_id->CurrentValue;
			$this->user_id->ViewCustomAttributes = "";

			// username
			$this->username->ViewValue = $this->username->CurrentValue;
			$this->username->ViewCustomAttributes = "";

			// password
			$this->password->ViewValue = $Language->phrase("PasswordMask");
			$this->password->ViewCustomAttributes = "";

			// create_login
			$this->create_login->ViewValue = $this->create_login->CurrentValue;
			$this->create_login->ViewValue = FormatDateTime($this->create_login->ViewValue, 0);
			$this->create_login->ViewCustomAttributes = "";

			// account_valid
			if (ConvertToBool($this->account_valid->CurrentValue)) {
				$this->account_valid->ViewValue = $this->account_valid->tagCaption(1) <> "" ? $this->account_valid->tagCaption(1) : "Yes";
			} else {
				$this->account_valid->ViewValue = $this->account_valid->tagCaption(2) <> "" ? $this->account_valid->tagCaption(2) : "No";
			}
			$this->account_valid->ViewCustomAttributes = "";

			// last_login
			$this->last_login->ViewValue = $this->last_login->CurrentValue;
			$this->last_login->ViewValue = FormatDateTime($this->last_login->ViewValue, 0);
			$this->last_login->ViewCustomAttributes = "";

			// email_addreess
			$this->email_addreess->ViewValue = $this->email_addreess->CurrentValue;
			$this->email_addreess->ViewCustomAttributes = "";

			// UserLevel
			if ($Security->canAdmin()) { // System admin
			$curVal = strval($this->UserLevel->CurrentValue);
			if ($curVal <> "") {
				$this->UserLevel->ViewValue = $this->UserLevel->lookupCacheOption($curVal);
				if ($this->UserLevel->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"userlevelid\"" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->UserLevel->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->UserLevel->ViewValue = $this->UserLevel->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->UserLevel->ViewValue = $this->UserLevel->CurrentValue;
					}
				}
			} else {
				$this->UserLevel->ViewValue = NULL;
			}
			} else {
				$this->UserLevel->ViewValue = $Language->phrase("PasswordMask");
			}
			$this->UserLevel->ViewCustomAttributes = "";

			// reports_to
			if ($this->reports_to->VirtualValue <> "") {
				$this->reports_to->ViewValue = $this->reports_to->VirtualValue;
			} else {
				$this->reports_to->ViewValue = $this->reports_to->CurrentValue;
			$curVal = strval($this->reports_to->CurrentValue);
			if ($curVal <> "") {
				$this->reports_to->ViewValue = $this->reports_to->lookupCacheOption($curVal);
				if ($this->reports_to->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"user_id\"" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->reports_to->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->reports_to->ViewValue = $this->reports_to->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->reports_to->ViewValue = $this->reports_to->CurrentValue;
					}
				}
			} else {
				$this->reports_to->ViewValue = NULL;
			}
			}
			$this->reports_to->ViewCustomAttributes = "";

			// name
			$this->name->ViewValue = $this->name->CurrentValue;
			$this->name->ViewCustomAttributes = "";

			// username
			$this->username->LinkCustomAttributes = "";
			$this->username->HrefValue = "";
			$this->username->TooltipValue = "";

			// password
			$this->password->LinkCustomAttributes = "";
			$this->password->HrefValue = "";
			$this->password->TooltipValue = "";

			// account_valid
			$this->account_valid->LinkCustomAttributes = "";
			$this->account_valid->HrefValue = "";
			$this->account_valid->TooltipValue = "";

			// email_addreess
			$this->email_addreess->LinkCustomAttributes = "";
			$this->email_addreess->HrefValue = "";
			$this->email_addreess->TooltipValue = "";

			// UserLevel
			$this->UserLevel->LinkCustomAttributes = "";
			$this->UserLevel->HrefValue = "";
			$this->UserLevel->TooltipValue = "";

			// reports_to
			$this->reports_to->LinkCustomAttributes = "";
			$this->reports_to->HrefValue = "";
			$this->reports_to->TooltipValue = "";

			// name
			$this->name->LinkCustomAttributes = "";
			$this->name->HrefValue = "";
			$this->name->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// username
			$this->username->EditAttrs["class"] = "form-control";
			$this->username->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->username->CurrentValue = HtmlDecode($this->username->CurrentValue);
			$this->username->EditValue = HtmlEncode($this->username->CurrentValue);
			$this->username->PlaceHolder = RemoveHtml($this->username->caption());

			// password
			$this->password->EditAttrs["class"] = "form-control";
			$this->password->EditCustomAttributes = "";
			$this->password->EditValue = HtmlEncode($this->password->CurrentValue);
			$this->password->PlaceHolder = RemoveHtml($this->password->caption());

			// account_valid
			$this->account_valid->EditCustomAttributes = "";
			$this->account_valid->EditValue = $this->account_valid->options(FALSE);

			// email_addreess
			$this->email_addreess->EditAttrs["class"] = "form-control";
			$this->email_addreess->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->email_addreess->CurrentValue = HtmlDecode($this->email_addreess->CurrentValue);
			$this->email_addreess->EditValue = HtmlEncode($this->email_addreess->CurrentValue);
			$this->email_addreess->PlaceHolder = RemoveHtml($this->email_addreess->caption());

			// UserLevel
			$this->UserLevel->EditAttrs["class"] = "form-control";
			$this->UserLevel->EditCustomAttributes = "";
			if (!$Security->canAdmin()) { // System admin
				$this->UserLevel->EditValue = $Language->phrase("PasswordMask");
			} else {
			$curVal = trim(strval($this->UserLevel->CurrentValue));
			if ($curVal <> "")
				$this->UserLevel->ViewValue = $this->UserLevel->lookupCacheOption($curVal);
			else
				$this->UserLevel->ViewValue = $this->UserLevel->Lookup !== NULL && is_array($this->UserLevel->Lookup->Options) ? $curVal : NULL;
			if ($this->UserLevel->ViewValue !== NULL) { // Load from cache
				$this->UserLevel->EditValue = array_values($this->UserLevel->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "\"userlevelid\"" . SearchString("=", $this->UserLevel->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->UserLevel->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->UserLevel->EditValue = $arwrk;
			}
			}

			// reports_to
			$this->reports_to->EditAttrs["class"] = "form-control";
			$this->reports_to->EditCustomAttributes = "";
			if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin
			if (trim(strval($this->reports_to->CurrentValue)) == "") {
				$filterWrk = "0=1";
			} else {
				$filterWrk = "\"user_id\"" . SearchString("=", $this->reports_to->CurrentValue, DATATYPE_NUMBER, "");
			}
			AddFilter($filterWrk, $GLOBALS["user_dtls"]->addParentUserIDFilter(""));
			$sqlWrk = $this->reports_to->Lookup->getSql(TRUE, $filterWrk, '', $this);
			$rswrk = Conn()->execute($sqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = HtmlEncode($rswrk->fields('df'));
				$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
				$this->reports_to->ViewValue = $this->reports_to->displayValue($arwrk);
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->reports_to->EditValue = $this->reports_to->ViewValue;
			} else {
			$this->reports_to->EditValue = HtmlEncode($this->reports_to->CurrentValue);
			$curVal = strval($this->reports_to->CurrentValue);
			if ($curVal <> "") {
				$this->reports_to->EditValue = $this->reports_to->lookupCacheOption($curVal);
				if ($this->reports_to->EditValue === NULL) { // Lookup from database
					$filterWrk = "\"user_id\"" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->reports_to->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->reports_to->EditValue = $this->reports_to->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->reports_to->EditValue = HtmlEncode($this->reports_to->CurrentValue);
					}
				}
			} else {
				$this->reports_to->EditValue = NULL;
			}
			$this->reports_to->PlaceHolder = RemoveHtml($this->reports_to->caption());
			}

			// name
			$this->name->EditAttrs["class"] = "form-control";
			$this->name->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->name->CurrentValue = HtmlDecode($this->name->CurrentValue);
			$this->name->EditValue = HtmlEncode($this->name->CurrentValue);
			$this->name->PlaceHolder = RemoveHtml($this->name->caption());

			// Add refer script
			// username

			$this->username->LinkCustomAttributes = "";
			$this->username->HrefValue = "";

			// password
			$this->password->LinkCustomAttributes = "";
			$this->password->HrefValue = "";

			// account_valid
			$this->account_valid->LinkCustomAttributes = "";
			$this->account_valid->HrefValue = "";

			// email_addreess
			$this->email_addreess->LinkCustomAttributes = "";
			$this->email_addreess->HrefValue = "";

			// UserLevel
			$this->UserLevel->LinkCustomAttributes = "";
			$this->UserLevel->HrefValue = "";

			// reports_to
			$this->reports_to->LinkCustomAttributes = "";
			$this->reports_to->HrefValue = "";

			// name
			$this->name->LinkCustomAttributes = "";
			$this->name->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
		if ($this->user_id->Required) {
			if (!$this->user_id->IsDetailKey && $this->user_id->FormValue != NULL && $this->user_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_id->caption(), $this->user_id->RequiredErrorMessage));
			}
		}
		if ($this->username->Required) {
			if (!$this->username->IsDetailKey && $this->username->FormValue != NULL && $this->username->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->username->caption(), $this->username->RequiredErrorMessage));
			}
		}
		if ($this->password->Required) {
			if (!$this->password->IsDetailKey && $this->password->FormValue != NULL && $this->password->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->password->caption(), $this->password->RequiredErrorMessage));
			}
		}
		if ($this->create_login->Required) {
			if (!$this->create_login->IsDetailKey && $this->create_login->FormValue != NULL && $this->create_login->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->create_login->caption(), $this->create_login->RequiredErrorMessage));
			}
		}
		if ($this->account_valid->Required) {
			if ($this->account_valid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->account_valid->caption(), $this->account_valid->RequiredErrorMessage));
			}
		}
		if ($this->last_login->Required) {
			if (!$this->last_login->IsDetailKey && $this->last_login->FormValue != NULL && $this->last_login->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->last_login->caption(), $this->last_login->RequiredErrorMessage));
			}
		}
		if ($this->email_addreess->Required) {
			if (!$this->email_addreess->IsDetailKey && $this->email_addreess->FormValue != NULL && $this->email_addreess->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->email_addreess->caption(), $this->email_addreess->RequiredErrorMessage));
			}
		}
		if (!CheckEmail($this->email_addreess->FormValue)) {
			AddMessage($FormError, $this->email_addreess->errorMessage());
		}
		if ($this->UserLevel->Required) {
			if (!$this->UserLevel->IsDetailKey && $this->UserLevel->FormValue != NULL && $this->UserLevel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UserLevel->caption(), $this->UserLevel->RequiredErrorMessage));
			}
		}
		if ($this->history->Required) {
			if (!$this->history->IsDetailKey && $this->history->FormValue != NULL && $this->history->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->history->caption(), $this->history->RequiredErrorMessage));
			}
		}
		if ($this->reports_to->Required) {
			if (!$this->reports_to->IsDetailKey && $this->reports_to->FormValue != NULL && $this->reports_to->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->reports_to->caption(), $this->reports_to->RequiredErrorMessage));
			}
		}
		if ($this->name->Required) {
			if (!$this->name->IsDetailKey && $this->name->FormValue != NULL && $this->name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->name->caption(), $this->name->RequiredErrorMessage));
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Check if valid User ID
		$validUser = FALSE;
		if ($Security->currentUserID() <> "" && !EmptyValue($this->user_id->CurrentValue) && !$Security->isAdmin()) { // Non system admin
			$validUser = $Security->isValidUserID($this->user_id->CurrentValue);
			if (!$validUser) {
				$userIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedUserID"));
				$userIdMsg = str_replace("%u", $this->user_id->CurrentValue, $userIdMsg);
				$this->setFailureMessage($userIdMsg);
				return FALSE;
			}
		}

		// Check if valid Parent User ID
		$validParentUser = FALSE;
		if ($Security->currentUserID() <> "" && !EmptyValue($this->reports_to->CurrentValue) && !$Security->isAdmin()) { // Non system admin
			$validParentUser = $Security->isValidUserID($this->reports_to->CurrentValue);
			if (!$validParentUser) {
				$parentUserIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedParentUserID"));
				$parentUserIdMsg = str_replace("%p", $this->reports_to->CurrentValue, $parentUserIdMsg);
				$this->setFailureMessage($parentUserIdMsg);
				return FALSE;
			}
		}
		if ($this->username->CurrentValue <> "") { // Check field with unique index
			$filter = "(username = '" . AdjustSql($this->username->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->username->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->username->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
		}
		if ($this->email_addreess->CurrentValue <> "") { // Check field with unique index
			$filter = "(email_addreess = '" . AdjustSql($this->email_addreess->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->email_addreess->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->email_addreess->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
		}
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// username
		$this->username->setDbValueDef($rsnew, $this->username->CurrentValue, NULL, FALSE);

		// password
		$this->password->setDbValueDef($rsnew, $this->password->CurrentValue, NULL, FALSE);

		// account_valid
		$tmpBool = $this->account_valid->CurrentValue;
		if ($tmpBool <> "1" && $tmpBool <> "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->account_valid->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->account_valid->CurrentValue) == "");

		// email_addreess
		$this->email_addreess->setDbValueDef($rsnew, $this->email_addreess->CurrentValue, NULL, FALSE);

		// UserLevel
		if ($Security->canAdmin()) { // System admin
			$this->UserLevel->setDbValueDef($rsnew, $this->UserLevel->CurrentValue, NULL, strval($this->UserLevel->CurrentValue) == "");
		}

		// reports_to
		$this->reports_to->setDbValueDef($rsnew, $this->reports_to->CurrentValue, NULL, FALSE);

		// name
		$this->name->setDbValueDef($rsnew, $this->name->CurrentValue, NULL, FALSE);

		// user_id
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

	// Show link optionally based on User ID
	protected function showOptionLink($id = "")
	{
		global $Security;
		if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id))
			return $Security->isValidUserID($this->user_id->CurrentValue);
		return TRUE;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("user_dtlslist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
						case "x_UserLevel":
							break;
						case "x_reports_to":
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