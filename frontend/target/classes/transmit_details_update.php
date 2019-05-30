<?php
namespace PHPMaker2019\pdm;

/**
 * Page class
 */
class transmit_details_update extends transmit_details
{

	// Page ID
	public $PageID = "update";

	// Project ID
	public $ProjectID = "{vishal-pdm}";

	// Table name
	public $TableName = 'transmit_details';

	// Page object name
	public $PageObjName = "transmit_details_update";

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

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'update');

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
		$this->transmittal_no->Visible = FALSE;
		$this->project_name->Visible = FALSE;
		$this->delivery_location->Visible = FALSE;
		$this->addressed_to->Visible = FALSE;
		$this->remarks->Visible = FALSE;
		$this->ack_rcvd->setVisibility();
		$this->ack_document->setVisibility();
		$this->transmital_date->Visible = FALSE;
		$this->transmit_mode->setVisibility();
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
		$this->setupLookupOptions($this->transmit_mode);

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
			$this->terminate("transmit_detailslist.php"); // No records selected, return to list
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
		if ($this->isConfirm()) { // Confirm page
			$this->RowType = ROWTYPE_VIEW; // Render view
			$this->Disabled = " disabled";
		} else {
			$this->RowType = ROWTYPE_EDIT; // Render edit
			$this->Disabled = "";
		}
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
					$this->ack_rcvd->setDbValue($this->Recordset->fields('ack_rcvd'));
					$this->transmit_mode->setDbValue($this->Recordset->fields('transmit_mode'));
				} else {
					if (!CompareValue($this->ack_rcvd->DbValue, $this->Recordset->fields('ack_rcvd')))
						$this->ack_rcvd->CurrentValue = NULL;
					if (!CompareValue($this->transmit_mode->DbValue, $this->Recordset->fields('transmit_mode')))
						$this->transmit_mode->CurrentValue = NULL;
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
		$this->transmit_id->CurrentValue = $keyFld;
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
		$this->ack_document->Upload->Index = $CurrentForm->Index;
		$this->ack_document->Upload->uploadFile();
		$this->ack_document->CurrentValue = $this->ack_document->Upload->FileName;
		$this->ack_document->MultiUpdate = $CurrentForm->getValue("u_ack_document");
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'ack_rcvd' first before field var 'x_ack_rcvd'
		$val = $CurrentForm->hasValue("ack_rcvd") ? $CurrentForm->getValue("ack_rcvd") : $CurrentForm->getValue("x_ack_rcvd");
		if (!$this->ack_rcvd->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ack_rcvd->Visible = FALSE; // Disable update for API request
			else
				$this->ack_rcvd->setFormValue($val);
		}
		$this->ack_rcvd->MultiUpdate = $CurrentForm->getValue("u_ack_rcvd");

		// Check field name 'transmit_mode' first before field var 'x_transmit_mode'
		$val = $CurrentForm->hasValue("transmit_mode") ? $CurrentForm->getValue("transmit_mode") : $CurrentForm->getValue("x_transmit_mode");
		if (!$this->transmit_mode->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_mode->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_mode->setFormValue($val);
		}
		$this->transmit_mode->MultiUpdate = $CurrentForm->getValue("u_transmit_mode");

		// Check field name 'transmit_id' first before field var 'x_transmit_id'
		$val = $CurrentForm->hasValue("transmit_id") ? $CurrentForm->getValue("transmit_id") : $CurrentForm->getValue("x_transmit_id");
		if (!$this->transmit_id->IsDetailKey)
			$this->transmit_id->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->transmit_id->CurrentValue = $this->transmit_id->FormValue;
		$this->ack_rcvd->CurrentValue = $this->ack_rcvd->FormValue;
		$this->transmit_mode->CurrentValue = $this->transmit_mode->FormValue;
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
		$this->transmit_mode->setDbValue($row['transmit_mode']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['transmit_id'] = NULL;
		$row['transmittal_no'] = NULL;
		$row['project_name'] = NULL;
		$row['delivery_location'] = NULL;
		$row['addressed_to'] = NULL;
		$row['remarks'] = NULL;
		$row['ack_rcvd'] = NULL;
		$row['ack_document'] = NULL;
		$row['transmital_date'] = NULL;
		$row['transmit_mode'] = NULL;
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
		// transmit_id
		// transmittal_no
		// project_name
		// delivery_location
		// addressed_to
		// remarks
		// ack_rcvd
		// ack_document
		// transmital_date
		// transmit_mode

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

			// transmit_mode
			$curVal = strval($this->transmit_mode->CurrentValue);
			if ($curVal <> "") {
				$this->transmit_mode->ViewValue = $this->transmit_mode->lookupCacheOption($curVal);
				if ($this->transmit_mode->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk <> "")
							$filterWrk .= " OR ";
						$filterWrk .= "\"xmit_mode\"" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
					$sqlWrk = $this->transmit_mode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->transmit_mode->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = array();
							$arwrk[1] = $rswrk->fields('df');
							$this->transmit_mode->ViewValue->add($this->transmit_mode->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->transmit_mode->ViewValue = $this->transmit_mode->CurrentValue;
					}
				}
			} else {
				$this->transmit_mode->ViewValue = NULL;
			}
			$this->transmit_mode->ViewCustomAttributes = "";

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

			// transmit_mode
			$this->transmit_mode->LinkCustomAttributes = "";
			$this->transmit_mode->HrefValue = "";
			$this->transmit_mode->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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

			// transmit_mode
			$this->transmit_mode->EditCustomAttributes = "";
			$curVal = trim(strval($this->transmit_mode->CurrentValue));
			if ($curVal <> "")
				$this->transmit_mode->ViewValue = $this->transmit_mode->lookupCacheOption($curVal);
			else
				$this->transmit_mode->ViewValue = $this->transmit_mode->Lookup !== NULL && is_array($this->transmit_mode->Lookup->Options) ? $curVal : NULL;
			if ($this->transmit_mode->ViewValue !== NULL) { // Load from cache
				$this->transmit_mode->EditValue = array_values($this->transmit_mode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk <> "") $filterWrk .= " OR ";
						$filterWrk .= "\"xmit_mode\"" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
				}
				$sqlWrk = $this->transmit_mode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->transmit_mode->EditValue = $arwrk;
			}

			// Edit refer script
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

			// transmit_mode
			$this->transmit_mode->LinkCustomAttributes = "";
			$this->transmit_mode->HrefValue = "";
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
		if ($this->ack_rcvd->MultiUpdate == "1")
			$updateCnt++;
		if ($this->ack_document->MultiUpdate == "1")
			$updateCnt++;
		if ($this->transmit_mode->MultiUpdate == "1")
			$updateCnt++;
		if ($updateCnt == 0) {
			$FormError = $Language->phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->transmit_id->Required) {
			if ($this->transmit_id->MultiUpdate <> "" && !$this->transmit_id->IsDetailKey && $this->transmit_id->FormValue != NULL && $this->transmit_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_id->caption(), $this->transmit_id->RequiredErrorMessage));
			}
		}
		if ($this->transmittal_no->Required) {
			if ($this->transmittal_no->MultiUpdate <> "" && !$this->transmittal_no->IsDetailKey && $this->transmittal_no->FormValue != NULL && $this->transmittal_no->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmittal_no->caption(), $this->transmittal_no->RequiredErrorMessage));
			}
		}
		if ($this->project_name->Required) {
			if ($this->project_name->MultiUpdate <> "" && !$this->project_name->IsDetailKey && $this->project_name->FormValue != NULL && $this->project_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->project_name->caption(), $this->project_name->RequiredErrorMessage));
			}
		}
		if ($this->delivery_location->Required) {
			if ($this->delivery_location->MultiUpdate <> "" && !$this->delivery_location->IsDetailKey && $this->delivery_location->FormValue != NULL && $this->delivery_location->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->delivery_location->caption(), $this->delivery_location->RequiredErrorMessage));
			}
		}
		if ($this->addressed_to->Required) {
			if ($this->addressed_to->MultiUpdate <> "" && !$this->addressed_to->IsDetailKey && $this->addressed_to->FormValue != NULL && $this->addressed_to->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->addressed_to->caption(), $this->addressed_to->RequiredErrorMessage));
			}
		}
		if ($this->remarks->Required) {
			if ($this->remarks->MultiUpdate <> "" && !$this->remarks->IsDetailKey && $this->remarks->FormValue != NULL && $this->remarks->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->remarks->caption(), $this->remarks->RequiredErrorMessage));
			}
		}
		if ($this->ack_rcvd->Required) {
			if ($this->ack_rcvd->MultiUpdate <> "" && $this->ack_rcvd->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ack_rcvd->caption(), $this->ack_rcvd->RequiredErrorMessage));
			}
		}
		if ($this->ack_document->Required) {
			if ($this->ack_document->MultiUpdate <> "" && $this->ack_document->Upload->FileName == "" && !$this->ack_document->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->ack_document->caption(), $this->ack_document->RequiredErrorMessage));
			}
		}
		if ($this->transmital_date->Required) {
			if ($this->transmital_date->MultiUpdate <> "" && !$this->transmital_date->IsDetailKey && $this->transmital_date->FormValue != NULL && $this->transmital_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmital_date->caption(), $this->transmital_date->RequiredErrorMessage));
			}
		}
		if ($this->transmit_mode->Required) {
			if ($this->transmit_mode->MultiUpdate <> "" && $this->transmit_mode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_mode->caption(), $this->transmit_mode->RequiredErrorMessage));
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

			// ack_rcvd
			$this->ack_rcvd->setDbValueDef($rsnew, ((strval($this->ack_rcvd->CurrentValue) == "1") ? "1" : "0"), NULL, $this->ack_rcvd->ReadOnly || $this->ack_rcvd->MultiUpdate <> "1");

			// ack_document
			if ($this->ack_document->Visible && !$this->ack_document->ReadOnly && strval($this->ack_document->MultiUpdate) == "1" && !$this->ack_document->Upload->KeepFile) {
				$this->ack_document->Upload->DbValue = $rsold['ack_document']; // Get original value
				if ($this->ack_document->Upload->FileName == "") {
					$rsnew['ack_document'] = NULL;
				} else {
					$rsnew['ack_document'] = $this->ack_document->Upload->FileName;
				}
			}

			// transmit_mode
			$this->transmit_mode->setDbValueDef($rsnew, $this->transmit_mode->CurrentValue, NULL, $this->transmit_mode->ReadOnly || $this->transmit_mode->MultiUpdate <> "1");
			if ($this->ack_document->Visible && !$this->ack_document->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->ack_document->Upload->DbValue) ? array() : array($this->ack_document->Upload->DbValue);
				if (!EmptyValue($this->ack_document->Upload->FileName) && $this->UpdateCount == 1) {
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
					$this->ack_document->setDbValueDef($rsnew, $this->ack_document->Upload->FileName, NULL, $this->ack_document->ReadOnly || $this->ack_document->MultiUpdate <> "1");
				}
			}

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
					if ($this->ack_document->Visible && !$this->ack_document->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->ack_document->Upload->DbValue) ? array() : array($this->ack_document->Upload->DbValue);
						if (!EmptyValue($this->ack_document->Upload->FileName) && $this->UpdateCount == 1) {
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
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// ack_document
		if ($this->ack_document->Upload->FileToken <> "")
			CleanUploadTempPath($this->ack_document->Upload->FileToken, $this->ack_document->Upload->Index);
		else
			CleanUploadTempPath($this->ack_document, $this->ack_document->Upload->Index);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("transmit_detailslist.php"), "", $this->TableVar, TRUE);
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
							break;
						case "x_transmit_mode":
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