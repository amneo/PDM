<?php
namespace PHPMaker2019\pdm;

/**
 * Page class
 */
class transaction_details_edit extends transaction_details
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{vishal-pdm}";

	// Table name
	public $TableName = 'transaction_details';

	// Page object name
	public $PageObjName = "transaction_details_edit";

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = TRUE;
	public $AuditTrailOnViewData = TRUE;
	public $AuditTrailOnSearch = TRUE;

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

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

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
			if (!$Security->canEdit()) {
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
				if (strval($Security->currentUserID()) == "") {
					$this->setFailureMessage(DeniedMessage()); // Set no permission
					$this->terminate(GetUrl("transaction_detailslist.php"));
					return;
				}
			}
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
		$this->direction->Visible = FALSE;
		$this->approval_status->Visible = FALSE;
		$this->document_link->Visible = FALSE;
		$this->transaction_date->Visible = FALSE;
		$this->document_native->setVisibility();
		$this->username->Visible = FALSE;
		$this->expiry_date->setVisibility();
		$this->hideFieldsForAddEdit();
		$this->firelink_doc_no->Required = FALSE;
		$this->submit_no->Required = FALSE;
		$this->revision_no->Required = FALSE;
		$this->transmit_no->Required = FALSE;
		$this->transmit_date->Required = FALSE;

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
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get action code
			if (!$this->isShow()) // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($CurrentForm->hasValue("x_document_sequence")) {
				$this->document_sequence->setFormValue($CurrentForm->getValue("x_document_sequence"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("document_sequence") !== NULL) {
				$this->document_sequence->setQueryStringValue(Get("document_sequence"));
				$loadByQuery = TRUE;
			} else {
				$this->document_sequence->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->loadRow();

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("transaction_detailslist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = "transaction_detailslist.php";
				if (GetPageName($returnUrl) == "transaction_detailslist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		if ($this->isConfirm()) { // Confirm page
			$this->RowType = ROWTYPE_VIEW; // Render as View
		} else {
			$this->RowType = ROWTYPE_EDIT; // Render as Edit
		}
		$this->resetAttributes();
		$this->renderRow();
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

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
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
		if (!$this->document_sequence->IsDetailKey)
			$this->document_sequence->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->document_sequence->CurrentValue = $this->document_sequence->FormValue;
		$this->firelink_doc_no->CurrentValue = $this->firelink_doc_no->FormValue;
		$this->submit_no->CurrentValue = $this->submit_no->FormValue;
		$this->revision_no->CurrentValue = $this->revision_no->FormValue;
		$this->transmit_no->CurrentValue = $this->transmit_no->FormValue;
		$this->transmit_date->CurrentValue = $this->transmit_date->FormValue;
		$this->transmit_date->CurrentValue = UnFormatDateTime($this->transmit_date->CurrentValue, 0);
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

		// Check if valid User ID
		if ($res) {
			$res = $this->showOptionLink('edit');
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
		$row = [];
		$row['document_sequence'] = NULL;
		$row['firelink_doc_no'] = NULL;
		$row['project_name'] = NULL;
		$row['document_tittle'] = NULL;
		$row['submit_no'] = NULL;
		$row['revision_no'] = NULL;
		$row['transmit_no'] = NULL;
		$row['transmit_date'] = NULL;
		$row['direction'] = NULL;
		$row['approval_status'] = NULL;
		$row['document_link'] = NULL;
		$row['transaction_date'] = NULL;
		$row['document_native'] = NULL;
		$row['username'] = NULL;
		$row['expiry_date'] = NULL;
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
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$arwrk[2] = strtoupper($rswrk->fields('df2'));
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
			$this->document_tittle->ViewValue = strtoupper($this->document_tittle->ViewValue);
			$this->document_tittle->ViewCustomAttributes = "";

			// submit_no
			$this->submit_no->ViewValue = $this->submit_no->CurrentValue;
			$this->submit_no->ViewValue = FormatNumber($this->submit_no->ViewValue, 0, -1, -2, -2);
			$this->submit_no->CellCssStyle .= "text-align: left;";
			$this->submit_no->ViewCustomAttributes = "";

			// revision_no
			$this->revision_no->ViewValue = $this->revision_no->CurrentValue;
			$this->revision_no->ViewValue = strtoupper($this->revision_no->ViewValue);
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
						$arwrk[1] = strtoupper($rswrk->fields('df'));
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
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$arwrk[2] = strtoupper($rswrk->fields('df2'));
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

			// document_native
			$this->document_native->LinkCustomAttributes = "";
			$this->document_native->HrefValue = "";
			$this->document_native->TooltipValue = "";

			// expiry_date
			$this->expiry_date->LinkCustomAttributes = "";
			$this->expiry_date->HrefValue = "";
			$this->expiry_date->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// firelink_doc_no
			$this->firelink_doc_no->EditAttrs["class"] = "form-control";
			$this->firelink_doc_no->EditCustomAttributes = "";
			if ($this->firelink_doc_no->VirtualValue <> "") {
				$this->firelink_doc_no->EditValue = $this->firelink_doc_no->VirtualValue;
			} else {
				$this->firelink_doc_no->EditValue = $this->firelink_doc_no->CurrentValue;
			$curVal = strval($this->firelink_doc_no->CurrentValue);
			if ($curVal <> "") {
				$this->firelink_doc_no->EditValue = $this->firelink_doc_no->lookupCacheOption($curVal);
				if ($this->firelink_doc_no->EditValue === NULL) { // Lookup from database
					$filterWrk = "\"firelink_doc_no\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->firelink_doc_no->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$arwrk[2] = strtoupper($rswrk->fields('df2'));
						$this->firelink_doc_no->EditValue = $this->firelink_doc_no->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->firelink_doc_no->EditValue = $this->firelink_doc_no->CurrentValue;
					}
				}
			} else {
				$this->firelink_doc_no->EditValue = NULL;
			}
			}
			$this->firelink_doc_no->CellCssStyle .= "text-align: left;";
			$this->firelink_doc_no->ViewCustomAttributes = "";

			// submit_no
			$this->submit_no->EditAttrs["class"] = "form-control";
			$this->submit_no->EditCustomAttributes = "";
			$this->submit_no->EditValue = $this->submit_no->CurrentValue;
			$this->submit_no->EditValue = FormatNumber($this->submit_no->EditValue, 0, -1, -2, -2);
			$this->submit_no->CellCssStyle .= "text-align: left;";
			$this->submit_no->ViewCustomAttributes = "";

			// revision_no
			$this->revision_no->EditAttrs["class"] = "form-control";
			$this->revision_no->EditCustomAttributes = "";
			$this->revision_no->EditValue = $this->revision_no->CurrentValue;
			$this->revision_no->EditValue = strtoupper($this->revision_no->EditValue);
			$this->revision_no->ViewCustomAttributes = "";

			// transmit_no
			$this->transmit_no->EditAttrs["class"] = "form-control";
			$this->transmit_no->EditCustomAttributes = "";
			if ($this->transmit_no->VirtualValue <> "") {
				$this->transmit_no->EditValue = $this->transmit_no->VirtualValue;
			} else {
				$this->transmit_no->EditValue = $this->transmit_no->CurrentValue;
			$curVal = strval($this->transmit_no->CurrentValue);
			if ($curVal <> "") {
				$this->transmit_no->EditValue = $this->transmit_no->lookupCacheOption($curVal);
				if ($this->transmit_no->EditValue === NULL) { // Lookup from database
					$filterWrk = "\"transmittal_no\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->transmit_no->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$this->transmit_no->EditValue = $this->transmit_no->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->transmit_no->EditValue = $this->transmit_no->CurrentValue;
					}
				}
			} else {
				$this->transmit_no->EditValue = NULL;
			}
			}
			$this->transmit_no->CellCssStyle .= "text-align: left;";
			$this->transmit_no->ViewCustomAttributes = "";

			// transmit_date
			$this->transmit_date->EditAttrs["class"] = "form-control";
			$this->transmit_date->EditCustomAttributes = "";
			$this->transmit_date->EditValue = $this->transmit_date->CurrentValue;
			$this->transmit_date->EditValue = FormatDateTime($this->transmit_date->EditValue, 0);
			$this->transmit_date->ViewCustomAttributes = "";

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

			// Edit refer script
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
			if (!$this->approval_status->IsDetailKey && $this->approval_status->FormValue != NULL && $this->approval_status->FormValue == "") {
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

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($filter);
		$conn = &$this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// document_native
			$this->document_native->setDbValueDef($rsnew, $this->document_native->CurrentValue, "", $this->document_native->ReadOnly);

			// expiry_date
			$this->expiry_date->setDbValueDef($rsnew, UnFormatDateTime($this->expiry_date->CurrentValue, 0), NULL, $this->expiry_date->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);
			if ($updateRow) {
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Show link optionally based on User ID
	protected function showOptionLink($id = "")
	{
		global $Security;
		if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id))
			return $Security->isValidUserID($this->username->CurrentValue);
		return TRUE;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("transaction_detailslist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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
							$row[1] = strtoupper($row[1]);
							$row['df'] = $row[1];
							$row[2] = strtoupper($row[2]);
							$row['df2'] = $row[2];
							break;
						case "x_transmit_no":
							$row[1] = strtoupper($row[1]);
							$row['df'] = $row[1];
							break;
						case "x_approval_status":
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