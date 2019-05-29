<?php
namespace PHPMaker2019\pdm;

/**
 * Page class
 */
class document_details_update extends document_details
{

	// Page ID
	public $PageID = "update";

	// Project ID
	public $ProjectID = "{vishal-pdm}";

	// Table name
	public $TableName = 'document_details';

	// Page object name
	public $PageObjName = "document_details_update";

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

		// Table object (document_details)
		if (!isset($GLOBALS["document_details"]) || get_class($GLOBALS["document_details"]) == PROJECT_NAMESPACE . "document_details") {
			$GLOBALS["document_details"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["document_details"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'update');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'document_details');

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
		global $EXPORT, $document_details;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($document_details);
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
					if ($pageName == "document_detailsview.php")
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
	public $FormClassName = "ew-horizontal ew-form ew-update-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $RecKeys;
	public $Disabled;
	public $UpdateCount = 0;

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
					$this->terminate(GetUrl("document_detailslist.php"));
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
		$this->client_doc_no->setVisibility();
		$this->document_tittle->setVisibility();
		$this->project_name->setVisibility();
		$this->project_system->setVisibility();
		$this->create_date->Visible = FALSE;
		$this->planned_date->setVisibility();
		$this->document_type->setVisibility();
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
		$this->setupLookupOptions($this->project_name);
		$this->setupLookupOptions($this->project_system);
		$this->setupLookupOptions($this->document_type);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-update-form ew-horizontal";

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Try to load keys from list form
		$this->RecKeys = $this->getRecordKeys(); // Load record keys
		if (Post("action") !== NULL && Post("action") !== "") {

			// Get action
			$this->CurrentAction = Post("action");
			$this->loadFormValues(); // Get form values

			// Validate form
			if (!$this->validateForm()) {
				$this->CurrentAction = "show"; // Form error, reset action
				$this->setFailureMessage($FormError);
			}
		} else {
			$this->loadMultiUpdateValues(); // Load initial values to form
		}
		if (count($this->RecKeys) <= 0)
			$this->terminate("document_detailslist.php"); // No records selected, return to list
		if ($this->isUpdate()) {
				if ($this->updateRows()) { // Update Records based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Set up update success message
					$this->terminate($this->getReturnUrl()); // Return to caller
				} else {
					$this->restoreFormValues(); // Restore form values
				}
		}

		// Render row
		$this->RowType = ROWTYPE_EDIT; // Render edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	protected function loadMultiUpdateValues()
	{
		$this->CurrentFilter = $this->getFilterFromRecordKeys();

		// Load recordset
		if ($this->Recordset = $this->loadRecordset()) {
			$i = 1;
			while (!$this->Recordset->EOF) {
				if ($i == 1) {
					$this->firelink_doc_no->setDbValue($this->Recordset->fields('firelink_doc_no'));
					$this->client_doc_no->setDbValue($this->Recordset->fields('client_doc_no'));
					$this->document_tittle->setDbValue($this->Recordset->fields('document_tittle'));
					$this->project_name->setDbValue($this->Recordset->fields('project_name'));
					$this->project_system->setDbValue($this->Recordset->fields('project_system'));
					$this->planned_date->setDbValue($this->Recordset->fields('planned_date'));
					$this->document_type->setDbValue($this->Recordset->fields('document_type'));
					$this->expiry_date->setDbValue($this->Recordset->fields('expiry_date'));
				} else {
					if (!CompareValue($this->firelink_doc_no->DbValue, $this->Recordset->fields('firelink_doc_no')))
						$this->firelink_doc_no->CurrentValue = NULL;
					if (!CompareValue($this->client_doc_no->DbValue, $this->Recordset->fields('client_doc_no')))
						$this->client_doc_no->CurrentValue = NULL;
					if (!CompareValue($this->document_tittle->DbValue, $this->Recordset->fields('document_tittle')))
						$this->document_tittle->CurrentValue = NULL;
					if (!CompareValue($this->project_name->DbValue, $this->Recordset->fields('project_name')))
						$this->project_name->CurrentValue = NULL;
					if (!CompareValue($this->project_system->DbValue, $this->Recordset->fields('project_system')))
						$this->project_system->CurrentValue = NULL;
					if (!CompareValue($this->planned_date->DbValue, $this->Recordset->fields('planned_date')))
						$this->planned_date->CurrentValue = NULL;
					if (!CompareValue($this->document_type->DbValue, $this->Recordset->fields('document_type')))
						$this->document_type->CurrentValue = NULL;
					if (!CompareValue($this->expiry_date->DbValue, $this->Recordset->fields('expiry_date')))
						$this->expiry_date->CurrentValue = NULL;
				}
				$i++;
				$this->Recordset->moveNext();
			}
			$this->Recordset->close();
		}
	}

	// Set up key value
	protected function setupKeyValues($key)
	{
		$keyFld = $key;
		if (!is_numeric($keyFld))
			return FALSE;
		$this->document_sequence->CurrentValue = $keyFld;
		return TRUE;
	}

	// Update all selected rows
	protected function updateRows()
	{
		global $Language;
		$conn = &$this->getConnection();
		$conn->beginTrans();
		if ($this->AuditTrailOnEdit)
			$this->writeAuditTrailDummy($Language->phrase("BatchUpdateBegin")); // Batch update begin

		// Get old recordset
		$this->CurrentFilter = $this->getFilterFromRecordKeys();
		$sql = $this->getCurrentSql();
		$rsold = $conn->execute($sql);

		// Update all rows
		$key = "";
		foreach ($this->RecKeys as $reckey) {
			if ($this->setupKeyValues($reckey)) {
				$thisKey = $reckey;
				$this->SendEmail = FALSE; // Do not send email on update success
				$this->UpdateCount += 1; // Update record count for records being updated
				$updateRows = $this->editRow(); // Update this row
			} else {
				$updateRows = FALSE;
			}
			if (!$updateRows)
				break; // Update failed
			if ($key <> "")
				$key .= ", ";
			$key .= $thisKey;
		}

		// Check if all rows updated
		if ($updateRows) {
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			$rsnew = $conn->execute($sql);
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateSuccess")); // Batch update success
		} else {
			$conn->rollbackTrans(); // Rollback transaction
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateRollback")); // Batch update rollback
		}
		return $updateRows;
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
		$this->firelink_doc_no->MultiUpdate = $CurrentForm->getValue("u_firelink_doc_no");

		// Check field name 'client_doc_no' first before field var 'x_client_doc_no'
		$val = $CurrentForm->hasValue("client_doc_no") ? $CurrentForm->getValue("client_doc_no") : $CurrentForm->getValue("x_client_doc_no");
		if (!$this->client_doc_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->client_doc_no->Visible = FALSE; // Disable update for API request
			else
				$this->client_doc_no->setFormValue($val);
		}
		$this->client_doc_no->MultiUpdate = $CurrentForm->getValue("u_client_doc_no");

		// Check field name 'document_tittle' first before field var 'x_document_tittle'
		$val = $CurrentForm->hasValue("document_tittle") ? $CurrentForm->getValue("document_tittle") : $CurrentForm->getValue("x_document_tittle");
		if (!$this->document_tittle->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->document_tittle->Visible = FALSE; // Disable update for API request
			else
				$this->document_tittle->setFormValue($val);
		}
		$this->document_tittle->MultiUpdate = $CurrentForm->getValue("u_document_tittle");

		// Check field name 'project_name' first before field var 'x_project_name'
		$val = $CurrentForm->hasValue("project_name") ? $CurrentForm->getValue("project_name") : $CurrentForm->getValue("x_project_name");
		if (!$this->project_name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->project_name->Visible = FALSE; // Disable update for API request
			else
				$this->project_name->setFormValue($val);
		}
		$this->project_name->MultiUpdate = $CurrentForm->getValue("u_project_name");

		// Check field name 'project_system' first before field var 'x_project_system'
		$val = $CurrentForm->hasValue("project_system") ? $CurrentForm->getValue("project_system") : $CurrentForm->getValue("x_project_system");
		if (!$this->project_system->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->project_system->Visible = FALSE; // Disable update for API request
			else
				$this->project_system->setFormValue($val);
		}
		$this->project_system->MultiUpdate = $CurrentForm->getValue("u_project_system");

		// Check field name 'planned_date' first before field var 'x_planned_date'
		$val = $CurrentForm->hasValue("planned_date") ? $CurrentForm->getValue("planned_date") : $CurrentForm->getValue("x_planned_date");
		if (!$this->planned_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->planned_date->Visible = FALSE; // Disable update for API request
			else
				$this->planned_date->setFormValue($val);
			$this->planned_date->CurrentValue = UnFormatDateTime($this->planned_date->CurrentValue, 0);
		}
		$this->planned_date->MultiUpdate = $CurrentForm->getValue("u_planned_date");

		// Check field name 'document_type' first before field var 'x_document_type'
		$val = $CurrentForm->hasValue("document_type") ? $CurrentForm->getValue("document_type") : $CurrentForm->getValue("x_document_type");
		if (!$this->document_type->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->document_type->Visible = FALSE; // Disable update for API request
			else
				$this->document_type->setFormValue($val);
		}
		$this->document_type->MultiUpdate = $CurrentForm->getValue("u_document_type");

		// Check field name 'expiry_date' first before field var 'x_expiry_date'
		$val = $CurrentForm->hasValue("expiry_date") ? $CurrentForm->getValue("expiry_date") : $CurrentForm->getValue("x_expiry_date");
		if (!$this->expiry_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->expiry_date->Visible = FALSE; // Disable update for API request
			else
				$this->expiry_date->setFormValue($val);
			$this->expiry_date->CurrentValue = UnFormatDateTime($this->expiry_date->CurrentValue, 0);
		}
		$this->expiry_date->MultiUpdate = $CurrentForm->getValue("u_expiry_date");

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
		$this->client_doc_no->CurrentValue = $this->client_doc_no->FormValue;
		$this->document_tittle->CurrentValue = $this->document_tittle->FormValue;
		$this->project_name->CurrentValue = $this->project_name->FormValue;
		$this->project_system->CurrentValue = $this->project_system->FormValue;
		$this->planned_date->CurrentValue = $this->planned_date->FormValue;
		$this->planned_date->CurrentValue = UnFormatDateTime($this->planned_date->CurrentValue, 0);
		$this->document_type->CurrentValue = $this->document_type->FormValue;
		$this->expiry_date->CurrentValue = $this->expiry_date->FormValue;
		$this->expiry_date->CurrentValue = UnFormatDateTime($this->expiry_date->CurrentValue, 0);
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
		$this->client_doc_no->setDbValue($row['client_doc_no']);
		$this->document_tittle->setDbValue($row['document_tittle']);
		$this->project_name->setDbValue($row['project_name']);
		if (array_key_exists('EV__project_name', $rs->fields)) {
			$this->project_name->VirtualValue = $rs->fields('EV__project_name'); // Set up virtual field value
		} else {
			$this->project_name->VirtualValue = ""; // Clear value
		}
		$this->project_system->setDbValue($row['project_system']);
		$this->create_date->setDbValue($row['create_date']);
		$this->planned_date->setDbValue($row['planned_date']);
		$this->document_type->setDbValue($row['document_type']);
		if (array_key_exists('EV__document_type', $rs->fields)) {
			$this->document_type->VirtualValue = $rs->fields('EV__document_type'); // Set up virtual field value
		} else {
			$this->document_type->VirtualValue = ""; // Clear value
		}
		$this->expiry_date->setDbValue($row['expiry_date']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['document_sequence'] = NULL;
		$row['firelink_doc_no'] = NULL;
		$row['client_doc_no'] = NULL;
		$row['document_tittle'] = NULL;
		$row['project_name'] = NULL;
		$row['project_system'] = NULL;
		$row['create_date'] = NULL;
		$row['planned_date'] = NULL;
		$row['document_type'] = NULL;
		$row['expiry_date'] = NULL;
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
		// document_sequence
		// firelink_doc_no
		// client_doc_no
		// document_tittle
		// project_name
		// project_system
		// create_date
		// planned_date
		// document_type
		// expiry_date

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// firelink_doc_no
			$this->firelink_doc_no->ViewValue = $this->firelink_doc_no->CurrentValue;
			$this->firelink_doc_no->ViewValue = strtoupper($this->firelink_doc_no->ViewValue);
			$this->firelink_doc_no->ViewCustomAttributes = "";

			// client_doc_no
			$this->client_doc_no->ViewValue = $this->client_doc_no->CurrentValue;
			$this->client_doc_no->ViewValue = strtoupper($this->client_doc_no->ViewValue);
			$this->client_doc_no->ViewCustomAttributes = "";

			// document_tittle
			$this->document_tittle->ViewValue = $this->document_tittle->CurrentValue;
			$this->document_tittle->ViewValue = strtoupper($this->document_tittle->ViewValue);
			$this->document_tittle->ViewCustomAttributes = "";

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
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$arwrk[2] = $rswrk->fields('df2');
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

			// project_system
			$curVal = strval($this->project_system->CurrentValue);
			if ($curVal <> "") {
				$this->project_system->ViewValue = $this->project_system->lookupCacheOption($curVal);
				if ($this->project_system->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"system_name\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->project_system->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->project_system->ViewValue = $this->project_system->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->project_system->ViewValue = $this->project_system->CurrentValue;
					}
				}
			} else {
				$this->project_system->ViewValue = NULL;
			}
			$this->project_system->ViewCustomAttributes = "";

			// planned_date
			$this->planned_date->ViewValue = $this->planned_date->CurrentValue;
			$this->planned_date->ViewCustomAttributes = "";

			// document_type
			if ($this->document_type->VirtualValue <> "") {
				$this->document_type->ViewValue = $this->document_type->VirtualValue;
			} else {
				$this->document_type->ViewValue = $this->document_type->CurrentValue;
			$curVal = strval($this->document_type->CurrentValue);
			if ($curVal <> "") {
				$this->document_type->ViewValue = $this->document_type->lookupCacheOption($curVal);
				if ($this->document_type->ViewValue === NULL) { // Lookup from database
					$filterWrk = "\"document_type\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->document_type->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = strtoupper($rswrk->fields('df'));
						$this->document_type->ViewValue = $this->document_type->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->document_type->ViewValue = $this->document_type->CurrentValue;
					}
				}
			} else {
				$this->document_type->ViewValue = NULL;
			}
			}
			$this->document_type->ViewCustomAttributes = "";

			// expiry_date
			$this->expiry_date->ViewValue = $this->expiry_date->CurrentValue;
			$this->expiry_date->ViewValue = FormatDateTime($this->expiry_date->ViewValue, 0);
			$this->expiry_date->ViewCustomAttributes = "";

			// firelink_doc_no
			$this->firelink_doc_no->LinkCustomAttributes = "";
			$this->firelink_doc_no->HrefValue = "";
			$this->firelink_doc_no->TooltipValue = "";

			// client_doc_no
			$this->client_doc_no->LinkCustomAttributes = "";
			$this->client_doc_no->HrefValue = "";
			$this->client_doc_no->TooltipValue = "";

			// document_tittle
			$this->document_tittle->LinkCustomAttributes = "";
			$this->document_tittle->HrefValue = "";
			$this->document_tittle->TooltipValue = "";

			// project_name
			$this->project_name->LinkCustomAttributes = "";
			$this->project_name->HrefValue = "";
			$this->project_name->TooltipValue = "";

			// project_system
			$this->project_system->LinkCustomAttributes = "";
			$this->project_system->HrefValue = "";
			$this->project_system->TooltipValue = "";

			// planned_date
			$this->planned_date->LinkCustomAttributes = "";
			$this->planned_date->HrefValue = "";
			$this->planned_date->TooltipValue = "";

			// document_type
			$this->document_type->LinkCustomAttributes = "";
			$this->document_type->HrefValue = "";
			$this->document_type->TooltipValue = "";

			// expiry_date
			$this->expiry_date->LinkCustomAttributes = "";
			$this->expiry_date->HrefValue = "";
			$this->expiry_date->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// firelink_doc_no
			$this->firelink_doc_no->EditAttrs["class"] = "form-control";
			$this->firelink_doc_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->firelink_doc_no->CurrentValue = HtmlDecode($this->firelink_doc_no->CurrentValue);
			$this->firelink_doc_no->EditValue = HtmlEncode($this->firelink_doc_no->CurrentValue);
			$this->firelink_doc_no->PlaceHolder = RemoveHtml($this->firelink_doc_no->caption());

			// client_doc_no
			$this->client_doc_no->EditAttrs["class"] = "form-control";
			$this->client_doc_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->client_doc_no->CurrentValue = HtmlDecode($this->client_doc_no->CurrentValue);
			$this->client_doc_no->EditValue = HtmlEncode($this->client_doc_no->CurrentValue);
			$this->client_doc_no->PlaceHolder = RemoveHtml($this->client_doc_no->caption());

			// document_tittle
			$this->document_tittle->EditAttrs["class"] = "form-control";
			$this->document_tittle->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->document_tittle->CurrentValue = HtmlDecode($this->document_tittle->CurrentValue);
			$this->document_tittle->EditValue = HtmlEncode($this->document_tittle->CurrentValue);
			$this->document_tittle->PlaceHolder = RemoveHtml($this->document_tittle->caption());

			// project_name
			$this->project_name->EditAttrs["class"] = "form-control";
			$this->project_name->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->project_name->CurrentValue = HtmlDecode($this->project_name->CurrentValue);
			$this->project_name->EditValue = HtmlEncode($this->project_name->CurrentValue);
			$curVal = strval($this->project_name->CurrentValue);
			if ($curVal <> "") {
				$this->project_name->EditValue = $this->project_name->lookupCacheOption($curVal);
				if ($this->project_name->EditValue === NULL) { // Lookup from database
					$filterWrk = "\"project_name\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->project_name->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode(strtoupper($rswrk->fields('df')));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->project_name->EditValue = $this->project_name->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->project_name->EditValue = HtmlEncode($this->project_name->CurrentValue);
					}
				}
			} else {
				$this->project_name->EditValue = NULL;
			}
			$this->project_name->PlaceHolder = RemoveHtml($this->project_name->caption());

			// project_system
			$this->project_system->EditAttrs["class"] = "form-control";
			$this->project_system->EditCustomAttributes = "";
			$curVal = trim(strval($this->project_system->CurrentValue));
			if ($curVal <> "")
				$this->project_system->ViewValue = $this->project_system->lookupCacheOption($curVal);
			else
				$this->project_system->ViewValue = $this->project_system->Lookup !== NULL && is_array($this->project_system->Lookup->Options) ? $curVal : NULL;
			if ($this->project_system->ViewValue !== NULL) { // Load from cache
				$this->project_system->EditValue = array_values($this->project_system->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "\"system_name\"" . SearchString("=", $this->project_system->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->project_system->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->project_system->EditValue = $arwrk;
			}

			// planned_date
			$this->planned_date->EditAttrs["class"] = "form-control";
			$this->planned_date->EditCustomAttributes = "";
			$this->planned_date->EditValue = HtmlEncode($this->planned_date->CurrentValue);
			$this->planned_date->PlaceHolder = RemoveHtml($this->planned_date->caption());

			// document_type
			$this->document_type->EditAttrs["class"] = "form-control";
			$this->document_type->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->document_type->CurrentValue = HtmlDecode($this->document_type->CurrentValue);
			$this->document_type->EditValue = HtmlEncode($this->document_type->CurrentValue);
			$curVal = strval($this->document_type->CurrentValue);
			if ($curVal <> "") {
				$this->document_type->EditValue = $this->document_type->lookupCacheOption($curVal);
				if ($this->document_type->EditValue === NULL) { // Lookup from database
					$filterWrk = "\"document_type\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->document_type->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode(strtoupper($rswrk->fields('df')));
						$this->document_type->EditValue = $this->document_type->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->document_type->EditValue = HtmlEncode($this->document_type->CurrentValue);
					}
				}
			} else {
				$this->document_type->EditValue = NULL;
			}
			$this->document_type->PlaceHolder = RemoveHtml($this->document_type->caption());

			// expiry_date
			$this->expiry_date->EditAttrs["class"] = "form-control";
			$this->expiry_date->EditCustomAttributes = "";
			$this->expiry_date->EditValue = HtmlEncode(FormatDateTime($this->expiry_date->CurrentValue, 8));
			$this->expiry_date->PlaceHolder = RemoveHtml($this->expiry_date->caption());

			// Edit refer script
			// firelink_doc_no

			$this->firelink_doc_no->LinkCustomAttributes = "";
			$this->firelink_doc_no->HrefValue = "";

			// client_doc_no
			$this->client_doc_no->LinkCustomAttributes = "";
			$this->client_doc_no->HrefValue = "";

			// document_tittle
			$this->document_tittle->LinkCustomAttributes = "";
			$this->document_tittle->HrefValue = "";

			// project_name
			$this->project_name->LinkCustomAttributes = "";
			$this->project_name->HrefValue = "";

			// project_system
			$this->project_system->LinkCustomAttributes = "";
			$this->project_system->HrefValue = "";

			// planned_date
			$this->planned_date->LinkCustomAttributes = "";
			$this->planned_date->HrefValue = "";

			// document_type
			$this->document_type->LinkCustomAttributes = "";
			$this->document_type->HrefValue = "";

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
		$updateCnt = 0;
		if ($this->firelink_doc_no->MultiUpdate == "1")
			$updateCnt++;
		if ($this->client_doc_no->MultiUpdate == "1")
			$updateCnt++;
		if ($this->document_tittle->MultiUpdate == "1")
			$updateCnt++;
		if ($this->project_name->MultiUpdate == "1")
			$updateCnt++;
		if ($this->project_system->MultiUpdate == "1")
			$updateCnt++;
		if ($this->planned_date->MultiUpdate == "1")
			$updateCnt++;
		if ($this->document_type->MultiUpdate == "1")
			$updateCnt++;
		if ($this->expiry_date->MultiUpdate == "1")
			$updateCnt++;
		if ($updateCnt == 0) {
			$FormError = $Language->phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->document_sequence->Required) {
			if ($this->document_sequence->MultiUpdate <> "" && !$this->document_sequence->IsDetailKey && $this->document_sequence->FormValue != NULL && $this->document_sequence->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->document_sequence->caption(), $this->document_sequence->RequiredErrorMessage));
			}
		}
		if ($this->firelink_doc_no->Required) {
			if ($this->firelink_doc_no->MultiUpdate <> "" && !$this->firelink_doc_no->IsDetailKey && $this->firelink_doc_no->FormValue != NULL && $this->firelink_doc_no->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->firelink_doc_no->caption(), $this->firelink_doc_no->RequiredErrorMessage));
			}
		}
		if ($this->client_doc_no->Required) {
			if ($this->client_doc_no->MultiUpdate <> "" && !$this->client_doc_no->IsDetailKey && $this->client_doc_no->FormValue != NULL && $this->client_doc_no->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->client_doc_no->caption(), $this->client_doc_no->RequiredErrorMessage));
			}
		}
		if ($this->document_tittle->Required) {
			if ($this->document_tittle->MultiUpdate <> "" && !$this->document_tittle->IsDetailKey && $this->document_tittle->FormValue != NULL && $this->document_tittle->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->document_tittle->caption(), $this->document_tittle->RequiredErrorMessage));
			}
		}
		if ($this->project_name->Required) {
			if ($this->project_name->MultiUpdate <> "" && !$this->project_name->IsDetailKey && $this->project_name->FormValue != NULL && $this->project_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->project_name->caption(), $this->project_name->RequiredErrorMessage));
			}
		}
		if ($this->project_system->Required) {
			if ($this->project_system->MultiUpdate <> "" && !$this->project_system->IsDetailKey && $this->project_system->FormValue != NULL && $this->project_system->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->project_system->caption(), $this->project_system->RequiredErrorMessage));
			}
		}
		if ($this->create_date->Required) {
			if ($this->create_date->MultiUpdate <> "" && !$this->create_date->IsDetailKey && $this->create_date->FormValue != NULL && $this->create_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->create_date->caption(), $this->create_date->RequiredErrorMessage));
			}
		}
		if ($this->planned_date->Required) {
			if ($this->planned_date->MultiUpdate <> "" && !$this->planned_date->IsDetailKey && $this->planned_date->FormValue != NULL && $this->planned_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->planned_date->caption(), $this->planned_date->RequiredErrorMessage));
			}
		}
		if ($this->planned_date->MultiUpdate <> "") {
			if (!CheckDate($this->planned_date->FormValue)) {
				AddMessage($FormError, $this->planned_date->errorMessage());
			}
		}
		if ($this->document_type->Required) {
			if ($this->document_type->MultiUpdate <> "" && !$this->document_type->IsDetailKey && $this->document_type->FormValue != NULL && $this->document_type->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->document_type->caption(), $this->document_type->RequiredErrorMessage));
			}
		}
		if ($this->expiry_date->Required) {
			if ($this->expiry_date->MultiUpdate <> "" && !$this->expiry_date->IsDetailKey && $this->expiry_date->FormValue != NULL && $this->expiry_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->expiry_date->caption(), $this->expiry_date->RequiredErrorMessage));
			}
		}
		if ($this->expiry_date->MultiUpdate <> "") {
			if (!CheckDate($this->expiry_date->FormValue)) {
				AddMessage($FormError, $this->expiry_date->errorMessage());
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

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($filter);
		$conn = &$this->getConnection();
		if ($this->firelink_doc_no->CurrentValue <> "") { // Check field with unique index
			$filterChk = "(\"firelink_doc_no\" = '" . AdjustSql($this->firelink_doc_no->CurrentValue, $this->Dbid) . "')";
			$filterChk .= " AND NOT (" . $filter . ")";
			$this->CurrentFilter = $filterChk;
			$sqlChk = $this->getCurrentSql();
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$rsChk = $conn->Execute($sqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->firelink_doc_no->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->firelink_doc_no->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
			$rsChk->close();
		}
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

			// firelink_doc_no
			$this->firelink_doc_no->setDbValueDef($rsnew, $this->firelink_doc_no->CurrentValue, "", $this->firelink_doc_no->ReadOnly || $this->firelink_doc_no->MultiUpdate <> "1");

			// client_doc_no
			$this->client_doc_no->setDbValueDef($rsnew, $this->client_doc_no->CurrentValue, NULL, $this->client_doc_no->ReadOnly || $this->client_doc_no->MultiUpdate <> "1");

			// document_tittle
			$this->document_tittle->setDbValueDef($rsnew, $this->document_tittle->CurrentValue, "", $this->document_tittle->ReadOnly || $this->document_tittle->MultiUpdate <> "1");

			// project_name
			$this->project_name->setDbValueDef($rsnew, $this->project_name->CurrentValue, "", $this->project_name->ReadOnly || $this->project_name->MultiUpdate <> "1");

			// project_system
			$this->project_system->setDbValueDef($rsnew, $this->project_system->CurrentValue, "", $this->project_system->ReadOnly || $this->project_system->MultiUpdate <> "1");

			// planned_date
			$this->planned_date->setDbValueDef($rsnew, $this->planned_date->CurrentValue, CurrentDate(), $this->planned_date->ReadOnly || $this->planned_date->MultiUpdate <> "1");

			// document_type
			$this->document_type->setDbValueDef($rsnew, $this->document_type->CurrentValue, "", $this->document_type->ReadOnly || $this->document_type->MultiUpdate <> "1");

			// expiry_date
			$this->expiry_date->setDbValueDef($rsnew, UnFormatDateTime($this->expiry_date->CurrentValue, 0), NULL, $this->expiry_date->ReadOnly || $this->expiry_date->MultiUpdate <> "1");

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("document_detailslist.php"), "", $this->TableVar, TRUE);
		$pageId = "update";
		$Breadcrumb->add("update", $pageId, $url);
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
							$row[1] = strtoupper($row[1]);
							$row['df'] = $row[1];
							break;
						case "x_project_system":
							break;
						case "x_document_type":
							$row[1] = strtoupper($row[1]);
							$row['df'] = $row[1];
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