<?php
namespace PHPMaker2019\pdm;

/**
 * Page class
 */
class transmit_details_add extends transmit_details
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{vishal-pdm}";

	// Table name
	public $TableName = 'transmit_details';

	// Page object name
	public $PageObjName = "transmit_details_add";

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

		// Table object (transmit_details)
		if (!isset($GLOBALS["transmit_details"]) || get_class($GLOBALS["transmit_details"]) == PROJECT_NAMESPACE . "transmit_details") {
			$GLOBALS["transmit_details"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["transmit_details"];
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'transmit_details');

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
		global $EXPORT, $transmit_details;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($transmit_details);
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
					if ($pageName == "transmit_detailsview.php")
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
			$key .= @$ar['transmit_id'];
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
			$this->transmit_id->Visible = FALSE;
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
					$this->terminate(GetUrl("transmit_detailslist.php"));
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
		$this->transmit_id->Visible = FALSE;
		$this->transmittal_no->setVisibility();
		$this->project_name->setVisibility();
		$this->delivery_location->setVisibility();
		$this->addressed_to->setVisibility();
		$this->remarks->setVisibility();
		$this->ack_rcvd->setVisibility();
		$this->ack_document->setVisibility();
		$this->transmital_date->Visible = FALSE;
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
		$this->setupLookupOptions($this->project_name);

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
			if (Get("transmit_id") !== NULL) {
				$this->transmit_id->setQueryStringValue(Get("transmit_id"));
				$this->setKey("transmit_id", $this->transmit_id->CurrentValue); // Set up key
			} else {
				$this->setKey("transmit_id", ""); // Clear key
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
					$this->terminate("transmit_detailslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "transmit_detailslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "transmit_detailsview.php")
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
		if ($this->isConfirm()) { // Confirm page
			$this->RowType = ROWTYPE_VIEW; // Render view type
		} else {
			$this->RowType = ROWTYPE_ADD; // Render add type
		}

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
		$this->ack_document->Upload->Index = $CurrentForm->Index;
		$this->ack_document->Upload->uploadFile();
		$this->ack_document->CurrentValue = $this->ack_document->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->transmit_id->CurrentValue = NULL;
		$this->transmit_id->OldValue = $this->transmit_id->CurrentValue;
		$this->transmittal_no->CurrentValue = NULL;
		$this->transmittal_no->OldValue = $this->transmittal_no->CurrentValue;
		$this->project_name->CurrentValue = NULL;
		$this->project_name->OldValue = $this->project_name->CurrentValue;
		$this->delivery_location->CurrentValue = NULL;
		$this->delivery_location->OldValue = $this->delivery_location->CurrentValue;
		$this->addressed_to->CurrentValue = NULL;
		$this->addressed_to->OldValue = $this->addressed_to->CurrentValue;
		$this->remarks->CurrentValue = NULL;
		$this->remarks->OldValue = $this->remarks->CurrentValue;
		$this->ack_rcvd->CurrentValue = NULL;
		$this->ack_rcvd->OldValue = $this->ack_rcvd->CurrentValue;
		$this->ack_document->Upload->DbValue = NULL;
		$this->ack_document->OldValue = $this->ack_document->Upload->DbValue;
		$this->ack_document->CurrentValue = NULL; // Clear file related field
		$this->transmital_date->CurrentValue = NULL;
		$this->transmital_date->OldValue = $this->transmital_date->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'transmittal_no' first before field var 'x_transmittal_no'
		$val = $CurrentForm->hasValue("transmittal_no") ? $CurrentForm->getValue("transmittal_no") : $CurrentForm->getValue("x_transmittal_no");
		if (!$this->transmittal_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmittal_no->Visible = FALSE; // Disable update for API request
			else
				$this->transmittal_no->setFormValue($val);
		}

		// Check field name 'project_name' first before field var 'x_project_name'
		$val = $CurrentForm->hasValue("project_name") ? $CurrentForm->getValue("project_name") : $CurrentForm->getValue("x_project_name");
		if (!$this->project_name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->project_name->Visible = FALSE; // Disable update for API request
			else
				$this->project_name->setFormValue($val);
		}

		// Check field name 'delivery_location' first before field var 'x_delivery_location'
		$val = $CurrentForm->hasValue("delivery_location") ? $CurrentForm->getValue("delivery_location") : $CurrentForm->getValue("x_delivery_location");
		if (!$this->delivery_location->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->delivery_location->Visible = FALSE; // Disable update for API request
			else
				$this->delivery_location->setFormValue($val);
		}

		// Check field name 'addressed_to' first before field var 'x_addressed_to'
		$val = $CurrentForm->hasValue("addressed_to") ? $CurrentForm->getValue("addressed_to") : $CurrentForm->getValue("x_addressed_to");
		if (!$this->addressed_to->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->addressed_to->Visible = FALSE; // Disable update for API request
			else
				$this->addressed_to->setFormValue($val);
		}

		// Check field name 'remarks' first before field var 'x_remarks'
		$val = $CurrentForm->hasValue("remarks") ? $CurrentForm->getValue("remarks") : $CurrentForm->getValue("x_remarks");
		if (!$this->remarks->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->remarks->Visible = FALSE; // Disable update for API request
			else
				$this->remarks->setFormValue($val);
		}

		// Check field name 'ack_rcvd' first before field var 'x_ack_rcvd'
		$val = $CurrentForm->hasValue("ack_rcvd") ? $CurrentForm->getValue("ack_rcvd") : $CurrentForm->getValue("x_ack_rcvd");
		if (!$this->ack_rcvd->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ack_rcvd->Visible = FALSE; // Disable update for API request
			else
				$this->ack_rcvd->setFormValue($val);
		}

		// Check field name 'transmit_id' first before field var 'x_transmit_id'
		$val = $CurrentForm->hasValue("transmit_id") ? $CurrentForm->getValue("transmit_id") : $CurrentForm->getValue("x_transmit_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->transmittal_no->CurrentValue = $this->transmittal_no->FormValue;
		$this->project_name->CurrentValue = $this->project_name->FormValue;
		$this->delivery_location->CurrentValue = $this->delivery_location->FormValue;
		$this->addressed_to->CurrentValue = $this->addressed_to->FormValue;
		$this->remarks->CurrentValue = $this->remarks->FormValue;
		$this->ack_rcvd->CurrentValue = $this->ack_rcvd->FormValue;
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
		$this->transmit_id->setDbValue($row['transmit_id']);
		$this->transmittal_no->setDbValue($row['transmittal_no']);
		$this->project_name->setDbValue($row['project_name']);
		if (array_key_exists('EV__project_name', $rs->fields)) {
			$this->project_name->VirtualValue = $rs->fields('EV__project_name'); // Set up virtual field value
		} else {
			$this->project_name->VirtualValue = ""; // Clear value
		}
		$this->delivery_location->setDbValue($row['delivery_location']);
		$this->addressed_to->setDbValue($row['addressed_to']);
		$this->remarks->setDbValue($row['remarks']);
		$this->ack_rcvd->setDbValue((ConvertToBool($row['ack_rcvd']) ? "1" : "0"));
		$this->ack_document->Upload->DbValue = $row['ack_document'];
		$this->ack_document->setDbValue($this->ack_document->Upload->DbValue);
		$this->transmital_date->setDbValue($row['transmital_date']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['transmit_id'] = $this->transmit_id->CurrentValue;
		$row['transmittal_no'] = $this->transmittal_no->CurrentValue;
		$row['project_name'] = $this->project_name->CurrentValue;
		$row['delivery_location'] = $this->delivery_location->CurrentValue;
		$row['addressed_to'] = $this->addressed_to->CurrentValue;
		$row['remarks'] = $this->remarks->CurrentValue;
		$row['ack_rcvd'] = $this->ack_rcvd->CurrentValue;
		$row['ack_document'] = $this->ack_document->Upload->DbValue;
		$row['transmital_date'] = $this->transmital_date->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("transmit_id")) <> "")
			$this->transmit_id->CurrentValue = $this->getKey("transmit_id"); // transmit_id
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
		// transmit_id
		// transmittal_no
		// project_name
		// delivery_location
		// addressed_to
		// remarks
		// ack_rcvd
		// ack_document
		// transmital_date

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// transmit_id
			$this->transmit_id->ViewValue = $this->transmit_id->CurrentValue;
			$this->transmit_id->ViewValue = FormatNumber($this->transmit_id->ViewValue, 0, -2, -2, -2);
			$this->transmit_id->ViewCustomAttributes = "";

			// transmittal_no
			$this->transmittal_no->ViewValue = $this->transmittal_no->CurrentValue;
			$this->transmittal_no->ViewCustomAttributes = "";

			// project_name
			if ($this->project_name->VirtualValue <> "") {
				$this->project_name->ViewValue = $this->project_name->VirtualValue;
			} else {
				$this->project_name->ViewValue = $this->project_name->CurrentValue;
			$curVal = strval($this->project_name->CurrentValue);
			if ($curVal <> "") {
				$this->project_name->ViewValue = $this->project_name->lookupCacheOption($curVal);
				if ($this->project_name->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"project_name\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->project_name->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->project_name->ViewValue = $this->project_name->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->project_name->ViewValue = $this->project_name->CurrentValue;
					}
				}
			} else {
				$this->project_name->ViewValue = NULL;
			}
			}
			$this->project_name->ViewCustomAttributes = "";

			// delivery_location
			$this->delivery_location->ViewValue = $this->delivery_location->CurrentValue;
			$this->delivery_location->ViewCustomAttributes = "";

			// addressed_to
			$this->addressed_to->ViewValue = $this->addressed_to->CurrentValue;
			$this->addressed_to->ViewCustomAttributes = "";

			// remarks
			$this->remarks->ViewValue = $this->remarks->CurrentValue;
			$this->remarks->ViewCustomAttributes = "";

			// ack_rcvd
			if (ConvertToBool($this->ack_rcvd->CurrentValue)) {
				$this->ack_rcvd->ViewValue = $this->ack_rcvd->tagCaption(1) <> "" ? $this->ack_rcvd->tagCaption(1) : "Y";
			} else {
				$this->ack_rcvd->ViewValue = $this->ack_rcvd->tagCaption(2) <> "" ? $this->ack_rcvd->tagCaption(2) : "N";
			}
			$this->ack_rcvd->ViewCustomAttributes = "";

			// ack_document
			if (!EmptyValue($this->ack_document->Upload->DbValue)) {
				$this->ack_document->ViewValue = $this->ack_document->Upload->DbValue;
			} else {
				$this->ack_document->ViewValue = "";
			}
			$this->ack_document->ViewCustomAttributes = "";

			// transmittal_no
			$this->transmittal_no->LinkCustomAttributes = "";
			$this->transmittal_no->HrefValue = "";
			$this->transmittal_no->TooltipValue = "";

			// project_name
			$this->project_name->LinkCustomAttributes = "";
			$this->project_name->HrefValue = "";
			$this->project_name->TooltipValue = "";

			// delivery_location
			$this->delivery_location->LinkCustomAttributes = "";
			$this->delivery_location->HrefValue = "";
			$this->delivery_location->TooltipValue = "";

			// addressed_to
			$this->addressed_to->LinkCustomAttributes = "";
			$this->addressed_to->HrefValue = "";
			$this->addressed_to->TooltipValue = "";

			// remarks
			$this->remarks->LinkCustomAttributes = "";
			$this->remarks->HrefValue = "";
			$this->remarks->TooltipValue = "";

			// ack_rcvd
			$this->ack_rcvd->LinkCustomAttributes = "";
			$this->ack_rcvd->HrefValue = "";
			$this->ack_rcvd->TooltipValue = "";

			// ack_document
			$this->ack_document->LinkCustomAttributes = "";
			if (!EmptyValue($this->ack_document->Upload->DbValue)) {
				$this->ack_document->HrefValue = GetFileUploadUrl($this->ack_document, $this->ack_document->Upload->DbValue); // Add prefix/suffix
				$this->ack_document->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->ack_document->HrefValue = FullUrl($this->ack_document->HrefValue, "href");
			} else {
				$this->ack_document->HrefValue = "";
			}
			$this->ack_document->ExportHrefValue = $this->ack_document->UploadPath . $this->ack_document->Upload->DbValue;
			$this->ack_document->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// transmittal_no
			$this->transmittal_no->EditAttrs["class"] = "form-control";
			$this->transmittal_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmittal_no->CurrentValue = HtmlDecode($this->transmittal_no->CurrentValue);
			$this->transmittal_no->EditValue = HtmlEncode($this->transmittal_no->CurrentValue);
			$this->transmittal_no->PlaceHolder = RemoveHtml($this->transmittal_no->caption());

			// project_name
			$this->project_name->EditAttrs["class"] = "form-control";
			$this->project_name->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->project_name->CurrentValue = HtmlDecode($this->project_name->CurrentValue);
			$this->project_name->EditValue = HtmlEncode($this->project_name->CurrentValue);
			$this->project_name->PlaceHolder = RemoveHtml($this->project_name->caption());

			// delivery_location
			$this->delivery_location->EditAttrs["class"] = "form-control";
			$this->delivery_location->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->delivery_location->CurrentValue = HtmlDecode($this->delivery_location->CurrentValue);
			$this->delivery_location->EditValue = HtmlEncode($this->delivery_location->CurrentValue);
			$this->delivery_location->PlaceHolder = RemoveHtml($this->delivery_location->caption());

			// addressed_to
			$this->addressed_to->EditAttrs["class"] = "form-control";
			$this->addressed_to->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->addressed_to->CurrentValue = HtmlDecode($this->addressed_to->CurrentValue);
			$this->addressed_to->EditValue = HtmlEncode($this->addressed_to->CurrentValue);
			$this->addressed_to->PlaceHolder = RemoveHtml($this->addressed_to->caption());

			// remarks
			$this->remarks->EditAttrs["class"] = "form-control";
			$this->remarks->EditCustomAttributes = "";
			$this->remarks->EditValue = HtmlEncode($this->remarks->CurrentValue);
			$this->remarks->PlaceHolder = RemoveHtml($this->remarks->caption());

			// ack_rcvd
			$this->ack_rcvd->EditCustomAttributes = "";
			$this->ack_rcvd->EditValue = $this->ack_rcvd->options(FALSE);

			// ack_document
			$this->ack_document->EditAttrs["class"] = "form-control";
			$this->ack_document->EditCustomAttributes = "";
			if (!EmptyValue($this->ack_document->Upload->DbValue)) {
				$this->ack_document->EditValue = $this->ack_document->Upload->DbValue;
			} else {
				$this->ack_document->EditValue = "";
			}
			if (!EmptyValue($this->ack_document->CurrentValue))
					$this->ack_document->Upload->FileName = $this->ack_document->CurrentValue;
			if (($this->isShow() || $this->isCopy()) && !$this->EventCancelled)
				RenderUploadField($this->ack_document);

			// Add refer script
			// transmittal_no

			$this->transmittal_no->LinkCustomAttributes = "";
			$this->transmittal_no->HrefValue = "";

			// project_name
			$this->project_name->LinkCustomAttributes = "";
			$this->project_name->HrefValue = "";

			// delivery_location
			$this->delivery_location->LinkCustomAttributes = "";
			$this->delivery_location->HrefValue = "";

			// addressed_to
			$this->addressed_to->LinkCustomAttributes = "";
			$this->addressed_to->HrefValue = "";

			// remarks
			$this->remarks->LinkCustomAttributes = "";
			$this->remarks->HrefValue = "";

			// ack_rcvd
			$this->ack_rcvd->LinkCustomAttributes = "";
			$this->ack_rcvd->HrefValue = "";

			// ack_document
			$this->ack_document->LinkCustomAttributes = "";
			if (!EmptyValue($this->ack_document->Upload->DbValue)) {
				$this->ack_document->HrefValue = GetFileUploadUrl($this->ack_document, $this->ack_document->Upload->DbValue); // Add prefix/suffix
				$this->ack_document->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->ack_document->HrefValue = FullUrl($this->ack_document->HrefValue, "href");
			} else {
				$this->ack_document->HrefValue = "";
			}
			$this->ack_document->ExportHrefValue = $this->ack_document->UploadPath . $this->ack_document->Upload->DbValue;
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
		if ($this->transmit_id->Required) {
			if (!$this->transmit_id->IsDetailKey && $this->transmit_id->FormValue != NULL && $this->transmit_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_id->caption(), $this->transmit_id->RequiredErrorMessage));
			}
		}
		if ($this->transmittal_no->Required) {
			if (!$this->transmittal_no->IsDetailKey && $this->transmittal_no->FormValue != NULL && $this->transmittal_no->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmittal_no->caption(), $this->transmittal_no->RequiredErrorMessage));
			}
		}
		if ($this->project_name->Required) {
			if (!$this->project_name->IsDetailKey && $this->project_name->FormValue != NULL && $this->project_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->project_name->caption(), $this->project_name->RequiredErrorMessage));
			}
		}
		if ($this->delivery_location->Required) {
			if (!$this->delivery_location->IsDetailKey && $this->delivery_location->FormValue != NULL && $this->delivery_location->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->delivery_location->caption(), $this->delivery_location->RequiredErrorMessage));
			}
		}
		if ($this->addressed_to->Required) {
			if (!$this->addressed_to->IsDetailKey && $this->addressed_to->FormValue != NULL && $this->addressed_to->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->addressed_to->caption(), $this->addressed_to->RequiredErrorMessage));
			}
		}
		if ($this->remarks->Required) {
			if (!$this->remarks->IsDetailKey && $this->remarks->FormValue != NULL && $this->remarks->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->remarks->caption(), $this->remarks->RequiredErrorMessage));
			}
		}
		if ($this->ack_rcvd->Required) {
			if ($this->ack_rcvd->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ack_rcvd->caption(), $this->ack_rcvd->RequiredErrorMessage));
			}
		}
		if ($this->ack_document->Required) {
			if ($this->ack_document->Upload->FileName == "" && !$this->ack_document->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->ack_document->caption(), $this->ack_document->RequiredErrorMessage));
			}
		}
		if ($this->transmital_date->Required) {
			if (!$this->transmital_date->IsDetailKey && $this->transmital_date->FormValue != NULL && $this->transmital_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmital_date->caption(), $this->transmital_date->RequiredErrorMessage));
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
		if ($this->transmittal_no->CurrentValue <> "") { // Check field with unique index
			$filter = "(transmittal_no = '" . AdjustSql($this->transmittal_no->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->transmittal_no->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->transmittal_no->CurrentValue, $idxErrMsg);
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

		// transmittal_no
		$this->transmittal_no->setDbValueDef($rsnew, $this->transmittal_no->CurrentValue, "", FALSE);

		// project_name
		$this->project_name->setDbValueDef($rsnew, $this->project_name->CurrentValue, "", FALSE);

		// delivery_location
		$this->delivery_location->setDbValueDef($rsnew, $this->delivery_location->CurrentValue, NULL, FALSE);

		// addressed_to
		$this->addressed_to->setDbValueDef($rsnew, $this->addressed_to->CurrentValue, NULL, FALSE);

		// remarks
		$this->remarks->setDbValueDef($rsnew, $this->remarks->CurrentValue, NULL, FALSE);

		// ack_rcvd
		$this->ack_rcvd->setDbValueDef($rsnew, ((strval($this->ack_rcvd->CurrentValue) == "1") ? "1" : "0"), NULL, strval($this->ack_rcvd->CurrentValue) == "");

		// ack_document
		if ($this->ack_document->Visible && !$this->ack_document->Upload->KeepFile) {
			$this->ack_document->Upload->DbValue = ""; // No need to delete old file
			if ($this->ack_document->Upload->FileName == "") {
				$rsnew['ack_document'] = NULL;
			} else {
				$rsnew['ack_document'] = $this->ack_document->Upload->FileName;
			}
		}
		if ($this->ack_document->Visible && !$this->ack_document->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->ack_document->Upload->DbValue) ? array() : array($this->ack_document->Upload->DbValue);
			if (!EmptyValue($this->ack_document->Upload->FileName)) {
				$newFiles = array($this->ack_document->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->ack_document, $this->ack_document->Upload->Index) . $file)) {
							if (DELETE_UPLOADED_FILES) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										unset($oldFiles[$j]);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->ack_document->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->ack_document, $this->ack_document->Upload->Index) . $file1) || file_exists($this->ack_document->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->ack_document->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->ack_document, $this->ack_document->Upload->Index) . $file, UploadTempPath($this->ack_document, $this->ack_document->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->ack_document->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->ack_document->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->ack_document->setDbValueDef($rsnew, $this->ack_document->Upload->FileName, NULL, strval($this->ack_document->CurrentValue) == "");
			}
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
				if ($this->ack_document->Visible && !$this->ack_document->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->ack_document->Upload->DbValue) ? array() : array($this->ack_document->Upload->DbValue);
					if (!EmptyValue($this->ack_document->Upload->FileName)) {
						$newFiles = array($this->ack_document->Upload->FileName);
						$newFiles2 = array($rsnew['ack_document']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->ack_document, $this->ack_document->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->ack_document->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = array();
					}
					if (DELETE_UPLOADED_FILES) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile <> "" && !in_array($oldFile, $newFiles))
								@unlink($this->ack_document->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
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

		// ack_document
		if ($this->ack_document->Upload->FileToken <> "")
			CleanUploadTempPath($this->ack_document->Upload->FileToken, $this->ack_document->Upload->Index);
		else
			CleanUploadTempPath($this->ack_document, $this->ack_document->Upload->Index);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("transmit_detailslist.php"), "", $this->TableVar, TRUE);
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
						case "x_project_name":
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