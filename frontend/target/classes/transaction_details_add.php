<?php
namespace PHPMaker2019\pdm;

/**
 * Page class
 */
class transaction_details_add extends transaction_details
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{vishal-pdm}";

	// Table name
	public $TableName = 'transaction_details';

	// Page object name
	public $PageObjName = "transaction_details_add";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

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
		$this->project_name->Visible = FALSE;
		$this->document_tittle->Visible = FALSE;
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
		$this->expiry_date->setVisibility();
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
			if (Get("document_sequence") !== NULL) {
				$this->document_sequence->setQueryStringValue(Get("document_sequence"));
				$this->setKey("document_sequence", $this->document_sequence->CurrentValue); // Set up key
			} else {
				$this->setKey("document_sequence", ""); // Clear key
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
					$this->terminate("transaction_detailslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "transaction_detailslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "transaction_detailsview.php")
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
		$this->document_link->Upload->Index = $CurrentForm->Index;
		$this->document_link->Upload->uploadFile();
		$this->document_link->CurrentValue = $this->document_link->Upload->FileName;
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
		$this->document_link->Upload->DbValue = NULL;
		$this->document_link->OldValue = $this->document_link->Upload->DbValue;
		$this->document_link->CurrentValue = NULL; // Clear file related field
		$this->transaction_date->CurrentValue = NULL;
		$this->transaction_date->OldValue = $this->transaction_date->CurrentValue;
		$this->document_native->CurrentValue = NULL;
		$this->document_native->OldValue = $this->document_native->CurrentValue;
		$this->username->CurrentValue = NULL;
		$this->username->OldValue = $this->username->CurrentValue;
		$this->expiry_date->CurrentValue = NULL;
		$this->expiry_date->OldValue = $this->expiry_date->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'firelink_doc_no' first before field var 'x_firelink_doc_no'
		$val = $CurrentForm->hasValue("firelink_doc_no") ? $CurrentForm->getValue("firelink_doc_no") : $CurrentForm->getValue("x_firelink_doc_no");
		if (!$this->firelink_doc_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->firelink_doc_no->Visible = FALSE; // Disable update for API request
			else
				$this->firelink_doc_no->setFormValue($val);
		}

		// Check field name 'submit_no' first before field var 'x_submit_no'
		$val = $CurrentForm->hasValue("submit_no") ? $CurrentForm->getValue("submit_no") : $CurrentForm->getValue("x_submit_no");
		if (!$this->submit_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->submit_no->Visible = FALSE; // Disable update for API request
			else
				$this->submit_no->setFormValue($val);
		}

		// Check field name 'revision_no' first before field var 'x_revision_no'
		$val = $CurrentForm->hasValue("revision_no") ? $CurrentForm->getValue("revision_no") : $CurrentForm->getValue("x_revision_no");
		if (!$this->revision_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->revision_no->Visible = FALSE; // Disable update for API request
			else
				$this->revision_no->setFormValue($val);
		}

		// Check field name 'transmit_no' first before field var 'x_transmit_no'
		$val = $CurrentForm->hasValue("transmit_no") ? $CurrentForm->getValue("transmit_no") : $CurrentForm->getValue("x_transmit_no");
		if (!$this->transmit_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no->setFormValue($val);
		}

		// Check field name 'transmit_date' first before field var 'x_transmit_date'
		$val = $CurrentForm->hasValue("transmit_date") ? $CurrentForm->getValue("transmit_date") : $CurrentForm->getValue("x_transmit_date");
		if (!$this->transmit_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date->setFormValue($val);
			$this->transmit_date->CurrentValue = UnFormatDateTime($this->transmit_date->CurrentValue, 0);
		}

		// Check field name 'direction' first before field var 'x_direction'
		$val = $CurrentForm->hasValue("direction") ? $CurrentForm->getValue("direction") : $CurrentForm->getValue("x_direction");
		if (!$this->direction->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction->Visible = FALSE; // Disable update for API request
			else
				$this->direction->setFormValue($val);
		}

		// Check field name 'approval_status' first before field var 'x_approval_status'
		$val = $CurrentForm->hasValue("approval_status") ? $CurrentForm->getValue("approval_status") : $CurrentForm->getValue("x_approval_status");
		if (!$this->approval_status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status->setFormValue($val);
		}

		// Check field name 'document_native' first before field var 'x_document_native'
		$val = $CurrentForm->hasValue("document_native") ? $CurrentForm->getValue("document_native") : $CurrentForm->getValue("x_document_native");
		if (!$this->document_native->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->document_native->Visible = FALSE; // Disable update for API request
			else
				$this->document_native->setFormValue($val);
		}

		// Check field name 'expiry_date' first before field var 'x_expiry_date'
		$val = $CurrentForm->hasValue("expiry_date") ? $CurrentForm->getValue("expiry_date") : $CurrentForm->getValue("x_expiry_date");
		if (!$this->expiry_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->expiry_date->Visible = FALSE; // Disable update for API request
			else
				$this->expiry_date->setFormValue($val);
			$this->expiry_date->CurrentValue = UnFormatDateTime($this->expiry_date->CurrentValue, 0);
		}

		// Check field name 'document_sequence' first before field var 'x_document_sequence'
		$val = $CurrentForm->hasValue("document_sequence") ? $CurrentForm->getValue("document_sequence") : $CurrentForm->getValue("x_document_sequence");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->firelink_doc_no->CurrentValue = $this->firelink_doc_no->FormValue;
		$this->submit_no->CurrentValue = $this->submit_no->FormValue;
		$this->revision_no->CurrentValue = $this->revision_no->FormValue;
		$this->transmit_no->CurrentValue = $this->transmit_no->FormValue;
		$this->transmit_date->CurrentValue = $this->transmit_date->FormValue;
		$this->transmit_date->CurrentValue = UnFormatDateTime($this->transmit_date->CurrentValue, 0);
		$this->direction->CurrentValue = $this->direction->FormValue;
		$this->approval_status->CurrentValue = $this->approval_status->FormValue;
		$this->document_native->CurrentValue = $this->document_native->FormValue;
		$this->expiry_date->CurrentValue = $this->expiry_date->FormValue;
		$this->expiry_date->CurrentValue = UnFormatDateTime($this->expiry_date->CurrentValue, 0);
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
		$this->expiry_date->setDbValue($row['expiry_date']);
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
		$row['expiry_date'] = $this->expiry_date->CurrentValue;
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// document_sequence
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
		// expiry_date

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
			$this->submit_no->ViewValue = FormatNumber($this->submit_no->ViewValue, 0, -1, -2, -2);
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

			// expiry_date
			$this->expiry_date->ViewValue = $this->expiry_date->CurrentValue;
			$this->expiry_date->ViewValue = FormatDateTime($this->expiry_date->ViewValue, 0);
			$this->expiry_date->ViewCustomAttributes = "";

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

			// expiry_date
			$this->expiry_date->LinkCustomAttributes = "";
			$this->expiry_date->HrefValue = "";
			if (!$this->isExport()) {
				$this->expiry_date->TooltipValue = ($this->expiry_date->ViewValue <> "") ? $this->expiry_date->ViewValue : $this->expiry_date->CurrentValue;
				if ($this->expiry_date->HrefValue == "") $this->expiry_date->HrefValue = "javascript:void(0);";
				AppendClass($this->expiry_date->LinkAttrs["class"], "ew-tooltip-link");
				$this->expiry_date->LinkAttrs["data-tooltip-id"] = "tt_transaction_details_x_expiry_date";
				$this->expiry_date->LinkAttrs["data-tooltip-width"] = $this->expiry_date->TooltipWidth;
				$this->expiry_date->LinkAttrs["data-placement"] = $GLOBALS["CSS_FLIP"] ? "left" : "right";
			}
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

			// submit_no
			$this->submit_no->EditAttrs["class"] = "form-control";
			$this->submit_no->EditCustomAttributes = "";
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

			// document_link
			$this->document_link->EditAttrs["class"] = "form-control";
			$this->document_link->EditCustomAttributes = "";
			if (!EmptyValue($this->document_link->Upload->DbValue)) {
				$this->document_link->EditValue = $this->document_link->Upload->DbValue;
			} else {
				$this->document_link->EditValue = "";
			}
			if (!EmptyValue($this->document_link->CurrentValue))
					$this->document_link->Upload->FileName = $this->document_link->CurrentValue;
			if (($this->isShow() || $this->isCopy()) && !$this->EventCancelled)
				RenderUploadField($this->document_link);

			// document_native
			$this->document_native->EditAttrs["class"] = "form-control";
			$this->document_native->EditCustomAttributes = "";
			$this->document_native->EditValue = HtmlEncode($this->document_native->CurrentValue);
			$this->document_native->PlaceHolder = RemoveHtml($this->document_native->caption());

			// expiry_date
			$this->expiry_date->EditAttrs["class"] = "form-control";
			$this->expiry_date->EditCustomAttributes = "";
			$this->expiry_date->EditValue = HtmlEncode(FormatDateTime($this->expiry_date->CurrentValue, 8));
			$this->expiry_date->PlaceHolder = RemoveHtml($this->expiry_date->caption());

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

			// document_native
			$this->document_native->LinkCustomAttributes = "";
			$this->document_native->HrefValue = "";

			// expiry_date
			$this->expiry_date->LinkCustomAttributes = "";
			$this->expiry_date->HrefValue = "";
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
		if (!CheckInteger($this->submit_no->FormValue)) {
			AddMessage($FormError, $this->submit_no->errorMessage());
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
		if (!CheckDate($this->transmit_date->FormValue)) {
			AddMessage($FormError, $this->transmit_date->errorMessage());
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
		if ($this->expiry_date->Required) {
			if (!$this->expiry_date->IsDetailKey && $this->expiry_date->FormValue != NULL && $this->expiry_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->expiry_date->caption(), $this->expiry_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->expiry_date->FormValue)) {
			AddMessage($FormError, $this->expiry_date->errorMessage());
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
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// firelink_doc_no
		$this->firelink_doc_no->setDbValueDef($rsnew, $this->firelink_doc_no->CurrentValue, "", FALSE);

		// submit_no
		$this->submit_no->setDbValueDef($rsnew, $this->submit_no->CurrentValue, 0, FALSE);

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

		// document_link
		if ($this->document_link->Visible && !$this->document_link->Upload->KeepFile) {
			$this->document_link->Upload->DbValue = ""; // No need to delete old file
			if ($this->document_link->Upload->FileName == "") {
				$rsnew['document_link'] = NULL;
			} else {
				$rsnew['document_link'] = $this->document_link->Upload->FileName;
			}
		}

		// document_native
		$this->document_native->setDbValueDef($rsnew, $this->document_native->CurrentValue, "", FALSE);

		// expiry_date
		$this->expiry_date->setDbValueDef($rsnew, UnFormatDateTime($this->expiry_date->CurrentValue, 0), NULL, strval($this->expiry_date->CurrentValue) == "");
		if ($this->document_link->Visible && !$this->document_link->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->document_link->Upload->DbValue) ? array() : array($this->document_link->Upload->DbValue);
			if (!EmptyValue($this->document_link->Upload->FileName)) {
				$newFiles = array($this->document_link->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->document_link, $this->document_link->Upload->Index) . $file)) {
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
							$file1 = UniqueFilename($this->document_link->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->document_link, $this->document_link->Upload->Index) . $file1) || file_exists($this->document_link->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->document_link->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->document_link, $this->document_link->Upload->Index) . $file, UploadTempPath($this->document_link, $this->document_link->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->document_link->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->document_link->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->document_link->setDbValueDef($rsnew, $this->document_link->Upload->FileName, "", FALSE);
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
				if ($this->document_link->Visible && !$this->document_link->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->document_link->Upload->DbValue) ? array() : array($this->document_link->Upload->DbValue);
					if (!EmptyValue($this->document_link->Upload->FileName)) {
						$newFiles = array($this->document_link->Upload->FileName);
						$newFiles2 = array($rsnew['document_link']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->document_link, $this->document_link->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->document_link->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->document_link->oldPhysicalUploadPath() . $oldFile);
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

		// document_link
		if ($this->document_link->Upload->FileToken <> "")
			CleanUploadTempPath($this->document_link->Upload->FileToken, $this->document_link->Upload->Index);
		else
			CleanUploadTempPath($this->document_link, $this->document_link->Upload->Index);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("transaction_detailslist.php"), "", $this->TableVar, TRUE);
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