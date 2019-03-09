<?php
namespace PHPMaker2019\pdm;

/**
 * Page class
 */
class project_details_add extends project_details
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{37CEA32F-BBE5-43A7-9AC0-4A3946EEAB80}";

	// Table name
	public $TableName = 'project_details';

	// Page object name
	public $PageObjName = "project_details_add";

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

		// Table object (project_details)
		if (!isset($GLOBALS["project_details"]) || get_class($GLOBALS["project_details"]) == PROJECT_NAMESPACE . "project_details") {
			$GLOBALS["project_details"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["project_details"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (user_dtls)
		if (!isset($GLOBALS['user_dtls']))
			$GLOBALS['user_dtls'] = new user_dtls();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'project_details');

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
		global $EXPORT, $project_details;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($project_details);
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
					if ($pageName == "project_detailsview.php")
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
			$key .= @$ar['project_id'];
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
			$this->project_id->Visible = FALSE;
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
					$this->terminate(GetUrl("project_detailslist.php"));
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
		$this->project_id->Visible = FALSE;
		$this->project_name->setVisibility();
		$this->project_our_client->setVisibility();
		$this->project_end_user->setVisibility();
		$this->project_sales_engg->setVisibility();
		$this->project_distribution->setVisibility();
		$this->project_transmittal->setVisibility();
		$this->order_number->setVisibility();
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
			if (Get("project_id") !== NULL) {
				$this->project_id->setQueryStringValue(Get("project_id"));
				$this->setKey("project_id", $this->project_id->CurrentValue); // Set up key
			} else {
				$this->setKey("project_id", ""); // Clear key
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
					$this->terminate("project_detailslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->GetAddUrl();
					if (GetPageName($returnUrl) == "project_detailslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "project_detailsview.php")
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
		$this->project_id->CurrentValue = NULL;
		$this->project_id->OldValue = $this->project_id->CurrentValue;
		$this->project_name->CurrentValue = NULL;
		$this->project_name->OldValue = $this->project_name->CurrentValue;
		$this->project_our_client->CurrentValue = NULL;
		$this->project_our_client->OldValue = $this->project_our_client->CurrentValue;
		$this->project_end_user->CurrentValue = NULL;
		$this->project_end_user->OldValue = $this->project_end_user->CurrentValue;
		$this->project_sales_engg->CurrentValue = NULL;
		$this->project_sales_engg->OldValue = $this->project_sales_engg->CurrentValue;
		$this->project_distribution->CurrentValue = NULL;
		$this->project_distribution->OldValue = $this->project_distribution->CurrentValue;
		$this->project_transmittal->CurrentValue = NULL;
		$this->project_transmittal->OldValue = $this->project_transmittal->CurrentValue;
		$this->order_number->CurrentValue = NULL;
		$this->order_number->OldValue = $this->order_number->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'project_name' first before field var 'x_project_name'
		$val = $CurrentForm->hasValue("project_name") ? $CurrentForm->getValue("project_name") : $CurrentForm->getValue("x_project_name");
		if (!$this->project_name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->project_name->Visible = FALSE; // Disable update for API request
			else
				$this->project_name->setFormValue($val);
		}

		// Check field name 'project_our_client' first before field var 'x_project_our_client'
		$val = $CurrentForm->hasValue("project_our_client") ? $CurrentForm->getValue("project_our_client") : $CurrentForm->getValue("x_project_our_client");
		if (!$this->project_our_client->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->project_our_client->Visible = FALSE; // Disable update for API request
			else
				$this->project_our_client->setFormValue($val);
		}

		// Check field name 'project_end_user' first before field var 'x_project_end_user'
		$val = $CurrentForm->hasValue("project_end_user") ? $CurrentForm->getValue("project_end_user") : $CurrentForm->getValue("x_project_end_user");
		if (!$this->project_end_user->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->project_end_user->Visible = FALSE; // Disable update for API request
			else
				$this->project_end_user->setFormValue($val);
		}

		// Check field name 'project_sales_engg' first before field var 'x_project_sales_engg'
		$val = $CurrentForm->hasValue("project_sales_engg") ? $CurrentForm->getValue("project_sales_engg") : $CurrentForm->getValue("x_project_sales_engg");
		if (!$this->project_sales_engg->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->project_sales_engg->Visible = FALSE; // Disable update for API request
			else
				$this->project_sales_engg->setFormValue($val);
		}

		// Check field name 'project_distribution' first before field var 'x_project_distribution'
		$val = $CurrentForm->hasValue("project_distribution") ? $CurrentForm->getValue("project_distribution") : $CurrentForm->getValue("x_project_distribution");
		if (!$this->project_distribution->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->project_distribution->Visible = FALSE; // Disable update for API request
			else
				$this->project_distribution->setFormValue($val);
		}

		// Check field name 'project_transmittal' first before field var 'x_project_transmittal'
		$val = $CurrentForm->hasValue("project_transmittal") ? $CurrentForm->getValue("project_transmittal") : $CurrentForm->getValue("x_project_transmittal");
		if (!$this->project_transmittal->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->project_transmittal->Visible = FALSE; // Disable update for API request
			else
				$this->project_transmittal->setFormValue($val);
		}

		// Check field name 'order_number' first before field var 'x_order_number'
		$val = $CurrentForm->hasValue("order_number") ? $CurrentForm->getValue("order_number") : $CurrentForm->getValue("x_order_number");
		if (!$this->order_number->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->order_number->Visible = FALSE; // Disable update for API request
			else
				$this->order_number->setFormValue($val);
		}

		// Check field name 'project_id' first before field var 'x_project_id'
		$val = $CurrentForm->hasValue("project_id") ? $CurrentForm->getValue("project_id") : $CurrentForm->getValue("x_project_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->project_name->CurrentValue = $this->project_name->FormValue;
		$this->project_our_client->CurrentValue = $this->project_our_client->FormValue;
		$this->project_end_user->CurrentValue = $this->project_end_user->FormValue;
		$this->project_sales_engg->CurrentValue = $this->project_sales_engg->FormValue;
		$this->project_distribution->CurrentValue = $this->project_distribution->FormValue;
		$this->project_transmittal->CurrentValue = $this->project_transmittal->FormValue;
		$this->order_number->CurrentValue = $this->order_number->FormValue;
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
		$this->project_id->setDbValue($row['project_id']);
		$this->project_name->setDbValue($row['project_name']);
		$this->project_our_client->setDbValue($row['project_our_client']);
		$this->project_end_user->setDbValue($row['project_end_user']);
		$this->project_sales_engg->setDbValue($row['project_sales_engg']);
		$this->project_distribution->setDbValue($row['project_distribution']);
		$this->project_transmittal->setDbValue($row['project_transmittal']);
		$this->order_number->setDbValue($row['order_number']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['project_id'] = $this->project_id->CurrentValue;
		$row['project_name'] = $this->project_name->CurrentValue;
		$row['project_our_client'] = $this->project_our_client->CurrentValue;
		$row['project_end_user'] = $this->project_end_user->CurrentValue;
		$row['project_sales_engg'] = $this->project_sales_engg->CurrentValue;
		$row['project_distribution'] = $this->project_distribution->CurrentValue;
		$row['project_transmittal'] = $this->project_transmittal->CurrentValue;
		$row['order_number'] = $this->order_number->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("project_id")) <> "")
			$this->project_id->CurrentValue = $this->getKey("project_id"); // project_id
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
		// project_id
		// project_name
		// project_our_client
		// project_end_user
		// project_sales_engg
		// project_distribution
		// project_transmittal
		// order_number

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// project_id
			$this->project_id->ViewValue = $this->project_id->CurrentValue;
			$this->project_id->ViewCustomAttributes = "";

			// project_name
			$this->project_name->ViewValue = $this->project_name->CurrentValue;
			$this->project_name->ViewCustomAttributes = "";

			// project_our_client
			$this->project_our_client->ViewValue = $this->project_our_client->CurrentValue;
			$this->project_our_client->ViewCustomAttributes = "";

			// project_end_user
			$this->project_end_user->ViewValue = $this->project_end_user->CurrentValue;
			$this->project_end_user->ViewCustomAttributes = "";

			// project_sales_engg
			$this->project_sales_engg->ViewValue = $this->project_sales_engg->CurrentValue;
			$this->project_sales_engg->ViewCustomAttributes = "";

			// project_distribution
			$this->project_distribution->ViewValue = $this->project_distribution->CurrentValue;
			$this->project_distribution->ViewCustomAttributes = "";

			// project_transmittal
			$this->project_transmittal->ViewValue = $this->project_transmittal->CurrentValue;
			$this->project_transmittal->ViewCustomAttributes = "";

			// order_number
			$this->order_number->ViewValue = $this->order_number->CurrentValue;
			$this->order_number->ViewCustomAttributes = "";

			// project_name
			$this->project_name->LinkCustomAttributes = "";
			$this->project_name->HrefValue = "";
			$this->project_name->TooltipValue = "";

			// project_our_client
			$this->project_our_client->LinkCustomAttributes = "";
			$this->project_our_client->HrefValue = "";
			$this->project_our_client->TooltipValue = "";

			// project_end_user
			$this->project_end_user->LinkCustomAttributes = "";
			$this->project_end_user->HrefValue = "";
			$this->project_end_user->TooltipValue = "";

			// project_sales_engg
			$this->project_sales_engg->LinkCustomAttributes = "";
			$this->project_sales_engg->HrefValue = "";
			$this->project_sales_engg->TooltipValue = "";

			// project_distribution
			$this->project_distribution->LinkCustomAttributes = "";
			$this->project_distribution->HrefValue = "";
			$this->project_distribution->TooltipValue = "";

			// project_transmittal
			$this->project_transmittal->LinkCustomAttributes = "";
			$this->project_transmittal->HrefValue = "";
			$this->project_transmittal->TooltipValue = "";

			// order_number
			$this->order_number->LinkCustomAttributes = "";
			$this->order_number->HrefValue = "";
			$this->order_number->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// project_name
			$this->project_name->EditAttrs["class"] = "form-control";
			$this->project_name->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->project_name->CurrentValue = HtmlDecode($this->project_name->CurrentValue);
			$this->project_name->EditValue = HtmlEncode($this->project_name->CurrentValue);
			$this->project_name->PlaceHolder = RemoveHtml($this->project_name->caption());

			// project_our_client
			$this->project_our_client->EditAttrs["class"] = "form-control";
			$this->project_our_client->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->project_our_client->CurrentValue = HtmlDecode($this->project_our_client->CurrentValue);
			$this->project_our_client->EditValue = HtmlEncode($this->project_our_client->CurrentValue);
			$this->project_our_client->PlaceHolder = RemoveHtml($this->project_our_client->caption());

			// project_end_user
			$this->project_end_user->EditAttrs["class"] = "form-control";
			$this->project_end_user->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->project_end_user->CurrentValue = HtmlDecode($this->project_end_user->CurrentValue);
			$this->project_end_user->EditValue = HtmlEncode($this->project_end_user->CurrentValue);
			$this->project_end_user->PlaceHolder = RemoveHtml($this->project_end_user->caption());

			// project_sales_engg
			$this->project_sales_engg->EditAttrs["class"] = "form-control";
			$this->project_sales_engg->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->project_sales_engg->CurrentValue = HtmlDecode($this->project_sales_engg->CurrentValue);
			$this->project_sales_engg->EditValue = HtmlEncode($this->project_sales_engg->CurrentValue);
			$this->project_sales_engg->PlaceHolder = RemoveHtml($this->project_sales_engg->caption());

			// project_distribution
			$this->project_distribution->EditAttrs["class"] = "form-control";
			$this->project_distribution->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->project_distribution->CurrentValue = HtmlDecode($this->project_distribution->CurrentValue);
			$this->project_distribution->EditValue = HtmlEncode($this->project_distribution->CurrentValue);
			$this->project_distribution->PlaceHolder = RemoveHtml($this->project_distribution->caption());

			// project_transmittal
			$this->project_transmittal->EditAttrs["class"] = "form-control";
			$this->project_transmittal->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->project_transmittal->CurrentValue = HtmlDecode($this->project_transmittal->CurrentValue);
			$this->project_transmittal->EditValue = HtmlEncode($this->project_transmittal->CurrentValue);
			$this->project_transmittal->PlaceHolder = RemoveHtml($this->project_transmittal->caption());

			// order_number
			$this->order_number->EditAttrs["class"] = "form-control";
			$this->order_number->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->order_number->CurrentValue = HtmlDecode($this->order_number->CurrentValue);
			$this->order_number->EditValue = HtmlEncode($this->order_number->CurrentValue);
			$this->order_number->PlaceHolder = RemoveHtml($this->order_number->caption());

			// Add refer script
			// project_name

			$this->project_name->LinkCustomAttributes = "";
			$this->project_name->HrefValue = "";

			// project_our_client
			$this->project_our_client->LinkCustomAttributes = "";
			$this->project_our_client->HrefValue = "";

			// project_end_user
			$this->project_end_user->LinkCustomAttributes = "";
			$this->project_end_user->HrefValue = "";

			// project_sales_engg
			$this->project_sales_engg->LinkCustomAttributes = "";
			$this->project_sales_engg->HrefValue = "";

			// project_distribution
			$this->project_distribution->LinkCustomAttributes = "";
			$this->project_distribution->HrefValue = "";

			// project_transmittal
			$this->project_transmittal->LinkCustomAttributes = "";
			$this->project_transmittal->HrefValue = "";

			// order_number
			$this->order_number->LinkCustomAttributes = "";
			$this->order_number->HrefValue = "";
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
		if ($this->project_id->Required) {
			if (!$this->project_id->IsDetailKey && $this->project_id->FormValue != NULL && $this->project_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->project_id->caption(), $this->project_id->RequiredErrorMessage));
			}
		}
		if ($this->project_name->Required) {
			if (!$this->project_name->IsDetailKey && $this->project_name->FormValue != NULL && $this->project_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->project_name->caption(), $this->project_name->RequiredErrorMessage));
			}
		}
		if ($this->project_our_client->Required) {
			if (!$this->project_our_client->IsDetailKey && $this->project_our_client->FormValue != NULL && $this->project_our_client->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->project_our_client->caption(), $this->project_our_client->RequiredErrorMessage));
			}
		}
		if ($this->project_end_user->Required) {
			if (!$this->project_end_user->IsDetailKey && $this->project_end_user->FormValue != NULL && $this->project_end_user->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->project_end_user->caption(), $this->project_end_user->RequiredErrorMessage));
			}
		}
		if ($this->project_sales_engg->Required) {
			if (!$this->project_sales_engg->IsDetailKey && $this->project_sales_engg->FormValue != NULL && $this->project_sales_engg->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->project_sales_engg->caption(), $this->project_sales_engg->RequiredErrorMessage));
			}
		}
		if ($this->project_distribution->Required) {
			if (!$this->project_distribution->IsDetailKey && $this->project_distribution->FormValue != NULL && $this->project_distribution->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->project_distribution->caption(), $this->project_distribution->RequiredErrorMessage));
			}
		}
		if ($this->project_transmittal->Required) {
			if (!$this->project_transmittal->IsDetailKey && $this->project_transmittal->FormValue != NULL && $this->project_transmittal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->project_transmittal->caption(), $this->project_transmittal->RequiredErrorMessage));
			}
		}
		if ($this->order_number->Required) {
			if (!$this->order_number->IsDetailKey && $this->order_number->FormValue != NULL && $this->order_number->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->order_number->caption(), $this->order_number->RequiredErrorMessage));
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
		if ($this->project_name->CurrentValue <> "") { // Check field with unique index
			$filter = "(project_name = '" . AdjustSql($this->project_name->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->project_name->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->project_name->CurrentValue, $idxErrMsg);
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

		// project_name
		$this->project_name->setDbValueDef($rsnew, $this->project_name->CurrentValue, "", FALSE);

		// project_our_client
		$this->project_our_client->setDbValueDef($rsnew, $this->project_our_client->CurrentValue, "", FALSE);

		// project_end_user
		$this->project_end_user->setDbValueDef($rsnew, $this->project_end_user->CurrentValue, "", FALSE);

		// project_sales_engg
		$this->project_sales_engg->setDbValueDef($rsnew, $this->project_sales_engg->CurrentValue, "", FALSE);

		// project_distribution
		$this->project_distribution->setDbValueDef($rsnew, $this->project_distribution->CurrentValue, "", FALSE);

		// project_transmittal
		$this->project_transmittal->setDbValueDef($rsnew, $this->project_transmittal->CurrentValue, "", FALSE);

		// order_number
		$this->order_number->setDbValueDef($rsnew, $this->order_number->CurrentValue, "", FALSE);

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("project_detailslist.php"), "", $this->TableVar, TRUE);
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