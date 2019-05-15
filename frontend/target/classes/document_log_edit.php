<?php
namespace PHPMaker2019\pdm;

/**
 * Page class
 */
class document_log_edit extends document_log
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{vishal-pdm}";

	// Table name
	public $TableName = 'document_log';

	// Page object name
	public $PageObjName = "document_log_edit";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

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

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->log_id->setVisibility();
		$this->firelink_doc_no->setVisibility();
		$this->project_name->setVisibility();
		$this->document_tittle->setVisibility();
		$this->current_status->setVisibility();
		$this->current_status_file->Visible = FALSE;
		$this->submit_no_sub1->setVisibility();
		$this->revision_no_sub1->setVisibility();
		$this->direction_out_sub1->setVisibility();
		$this->planned_date_out_sub1->setVisibility();
		$this->transmit_date_out_sub1->setVisibility();
		$this->transmit_no_out_sub1->setVisibility();
		$this->approval_status_out_sub1->setVisibility();
		$this->direction_out_file_sub1->setVisibility();
		$this->direction_in_sub1->setVisibility();
		$this->transmit_no_in_sub1->setVisibility();
		$this->approval_status_in_sub1->setVisibility();
		$this->direction_in_file_sub1->Visible = FALSE;
		$this->transmit_date_in_sub1->setVisibility();
		$this->submit_no_sub2->setVisibility();
		$this->revision_no_sub2->setVisibility();
		$this->direction_out_sub2->setVisibility();
		$this->planned_date_out_sub2->setVisibility();
		$this->transmit_date_out_sub2->setVisibility();
		$this->transmit_no_out_sub2->setVisibility();
		$this->approval_status_out_sub2->setVisibility();
		$this->direction_out_file_sub2->Visible = FALSE;
		$this->direction_in_sub2->setVisibility();
		$this->transmit_no_in_sub2->setVisibility();
		$this->approval_status_in_sub2->setVisibility();
		$this->direction_in_file_sub2->Visible = FALSE;
		$this->transmit_date_in_sub2->setVisibility();
		$this->submit_no_sub3->setVisibility();
		$this->revision_no_sub3->setVisibility();
		$this->direction_out_sub3->setVisibility();
		$this->planned_date_out_sub3->setVisibility();
		$this->transmit_date_out_sub3->setVisibility();
		$this->transmit_no_out_sub3->setVisibility();
		$this->approval_status_out_sub3->setVisibility();
		$this->direction_out_file_sub3->Visible = FALSE;
		$this->direction_in_sub3->setVisibility();
		$this->transmit_no_in_sub3->setVisibility();
		$this->approval_status_in_sub3->setVisibility();
		$this->direction_in_file_sub3->Visible = FALSE;
		$this->transmit_date_in_sub3->setVisibility();
		$this->submit_no_sub4->setVisibility();
		$this->revision_no_sub4->setVisibility();
		$this->direction_out_sub4->setVisibility();
		$this->planned_date_out_sub4->setVisibility();
		$this->transmit_date_out_sub4->setVisibility();
		$this->transmit_no_out_sub4->setVisibility();
		$this->approval_status_out_sub4->setVisibility();
		$this->direction_out_file_sub4->Visible = FALSE;
		$this->direction_in_sub4->setVisibility();
		$this->transmit_no_in_sub4->setVisibility();
		$this->approval_status_in_sub4->setVisibility();
		$this->direction_in_file_sub4->setVisibility();
		$this->transmit_date_in_sub4->setVisibility();
		$this->submit_no_sub5->setVisibility();
		$this->revision_no_sub5->setVisibility();
		$this->direction_out_sub5->setVisibility();
		$this->planned_date_out_sub5->setVisibility();
		$this->transmit_date_out_sub5->setVisibility();
		$this->transmit_no_out_sub5->setVisibility();
		$this->approval_status_out_sub5->setVisibility();
		$this->direction_out_file_sub5->Visible = FALSE;
		$this->direction_in_sub5->setVisibility();
		$this->transmit_no_in_sub5->setVisibility();
		$this->approval_status_in_sub5->setVisibility();
		$this->direction_in_file_sub5->setVisibility();
		$this->transmit_date_in_sub5->setVisibility();
		$this->submit_no_sub6->setVisibility();
		$this->revision_no_sub6->setVisibility();
		$this->direction_out_sub6->setVisibility();
		$this->planned_date_out_sub6->setVisibility();
		$this->transmit_date_out_sub6->setVisibility();
		$this->transmit_no_out_sub6->setVisibility();
		$this->approval_status_out_sub6->setVisibility();
		$this->direction_out_file_sub6->Visible = FALSE;
		$this->direction_in_sub6->setVisibility();
		$this->transmit_no_in_sub6->setVisibility();
		$this->approval_status_in_sub6->setVisibility();
		$this->direction_in_file_sub6->setVisibility();
		$this->transmit_date_in_sub6->setVisibility();
		$this->submit_no_sub7->setVisibility();
		$this->revision_no_sub7->setVisibility();
		$this->direction_out_sub7->setVisibility();
		$this->planned_date_out_sub7->setVisibility();
		$this->transmit_date_out_sub7->setVisibility();
		$this->transmit_no_out_sub7->setVisibility();
		$this->approval_status_out_sub7->setVisibility();
		$this->direction_out_file_sub7->Visible = FALSE;
		$this->direction_in_sub7->setVisibility();
		$this->transmit_no_in_sub7->setVisibility();
		$this->approval_status_in_sub7->setVisibility();
		$this->direction_in_file_sub7->Visible = FALSE;
		$this->transmit_date_in_sub7->setVisibility();
		$this->submit_no_sub8->setVisibility();
		$this->revision_no_sub8->setVisibility();
		$this->direction_out_sub8->setVisibility();
		$this->planned_date_out_sub8->setVisibility();
		$this->transmit_date_out_sub8->setVisibility();
		$this->transmit_no_out_sub8->setVisibility();
		$this->approval_status_out_sub8->setVisibility();
		$this->direction_out_file_sub8->setVisibility();
		$this->direction_in_sub8->setVisibility();
		$this->transmit_no_in_sub8->setVisibility();
		$this->approval_status_in_sub8->setVisibility();
		$this->direction_in_file_sub8->Visible = FALSE;
		$this->transmit_date_in_sub8->setVisibility();
		$this->submit_no_sub9->setVisibility();
		$this->revision_no_sub9->setVisibility();
		$this->direction_out_sub9->setVisibility();
		$this->planned_date_out_sub9->setVisibility();
		$this->transmit_date_out_sub9->setVisibility();
		$this->transmit_no_out_sub9->setVisibility();
		$this->approval_status_out_sub9->setVisibility();
		$this->direction_out_file_sub9->Visible = FALSE;
		$this->direction_in_sub9->setVisibility();
		$this->transmit_no_in_sub9->setVisibility();
		$this->approval_status_in_sub9->setVisibility();
		$this->direction_in_file_sub9->Visible = FALSE;
		$this->transmit_date_in_sub9->setVisibility();
		$this->submit_no_sub10->setVisibility();
		$this->revision_no_sub10->setVisibility();
		$this->direction_out_sub10->setVisibility();
		$this->planned_date_out_sub10->setVisibility();
		$this->transmit_date_out_sub10->setVisibility();
		$this->transmit_no_out_sub10->setVisibility();
		$this->approval_status_out_sub10->setVisibility();
		$this->direction_out_file_sub10->Visible = FALSE;
		$this->direction_in_sub10->setVisibility();
		$this->transmit_no_in_sub10->setVisibility();
		$this->approval_status_in_sub10->setVisibility();
		$this->direction_in_file_sub10->Visible = FALSE;
		$this->transmit_date_in_sub10->setVisibility();
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
			if ($CurrentForm->hasValue("x_log_id")) {
				$this->log_id->setFormValue($CurrentForm->getValue("x_log_id"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("log_id") !== NULL) {
				$this->log_id->setQueryStringValue(Get("log_id"));
				$loadByQuery = TRUE;
			} else {
				$this->log_id->CurrentValue = NULL;
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
					$this->terminate("document_loglist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "document_loglist.php")
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
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
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

		// Check field name 'log_id' first before field var 'x_log_id'
		$val = $CurrentForm->hasValue("log_id") ? $CurrentForm->getValue("log_id") : $CurrentForm->getValue("x_log_id");
		if (!$this->log_id->IsDetailKey)
			$this->log_id->setFormValue($val);

		// Check field name 'firelink_doc_no' first before field var 'x_firelink_doc_no'
		$val = $CurrentForm->hasValue("firelink_doc_no") ? $CurrentForm->getValue("firelink_doc_no") : $CurrentForm->getValue("x_firelink_doc_no");
		if (!$this->firelink_doc_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->firelink_doc_no->Visible = FALSE; // Disable update for API request
			else
				$this->firelink_doc_no->setFormValue($val);
		}

		// Check field name 'project_name' first before field var 'x_project_name'
		$val = $CurrentForm->hasValue("project_name") ? $CurrentForm->getValue("project_name") : $CurrentForm->getValue("x_project_name");
		if (!$this->project_name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->project_name->Visible = FALSE; // Disable update for API request
			else
				$this->project_name->setFormValue($val);
		}

		// Check field name 'document_tittle' first before field var 'x_document_tittle'
		$val = $CurrentForm->hasValue("document_tittle") ? $CurrentForm->getValue("document_tittle") : $CurrentForm->getValue("x_document_tittle");
		if (!$this->document_tittle->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->document_tittle->Visible = FALSE; // Disable update for API request
			else
				$this->document_tittle->setFormValue($val);
		}

		// Check field name 'current_status' first before field var 'x_current_status'
		$val = $CurrentForm->hasValue("current_status") ? $CurrentForm->getValue("current_status") : $CurrentForm->getValue("x_current_status");
		if (!$this->current_status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->current_status->Visible = FALSE; // Disable update for API request
			else
				$this->current_status->setFormValue($val);
		}

		// Check field name 'submit_no_sub1' first before field var 'x_submit_no_sub1'
		$val = $CurrentForm->hasValue("submit_no_sub1") ? $CurrentForm->getValue("submit_no_sub1") : $CurrentForm->getValue("x_submit_no_sub1");
		if (!$this->submit_no_sub1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->submit_no_sub1->Visible = FALSE; // Disable update for API request
			else
				$this->submit_no_sub1->setFormValue($val);
		}

		// Check field name 'revision_no_sub1' first before field var 'x_revision_no_sub1'
		$val = $CurrentForm->hasValue("revision_no_sub1") ? $CurrentForm->getValue("revision_no_sub1") : $CurrentForm->getValue("x_revision_no_sub1");
		if (!$this->revision_no_sub1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->revision_no_sub1->Visible = FALSE; // Disable update for API request
			else
				$this->revision_no_sub1->setFormValue($val);
		}

		// Check field name 'direction_out_sub1' first before field var 'x_direction_out_sub1'
		$val = $CurrentForm->hasValue("direction_out_sub1") ? $CurrentForm->getValue("direction_out_sub1") : $CurrentForm->getValue("x_direction_out_sub1");
		if (!$this->direction_out_sub1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_out_sub1->Visible = FALSE; // Disable update for API request
			else
				$this->direction_out_sub1->setFormValue($val);
		}

		// Check field name 'planned_date_out_sub1' first before field var 'x_planned_date_out_sub1'
		$val = $CurrentForm->hasValue("planned_date_out_sub1") ? $CurrentForm->getValue("planned_date_out_sub1") : $CurrentForm->getValue("x_planned_date_out_sub1");
		if (!$this->planned_date_out_sub1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->planned_date_out_sub1->Visible = FALSE; // Disable update for API request
			else
				$this->planned_date_out_sub1->setFormValue($val);
			$this->planned_date_out_sub1->CurrentValue = UnFormatDateTime($this->planned_date_out_sub1->CurrentValue, 0);
		}

		// Check field name 'transmit_date_out_sub1' first before field var 'x_transmit_date_out_sub1'
		$val = $CurrentForm->hasValue("transmit_date_out_sub1") ? $CurrentForm->getValue("transmit_date_out_sub1") : $CurrentForm->getValue("x_transmit_date_out_sub1");
		if (!$this->transmit_date_out_sub1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_out_sub1->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_out_sub1->setFormValue($val);
			$this->transmit_date_out_sub1->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub1->CurrentValue, 0);
		}

		// Check field name 'transmit_no_out_sub1' first before field var 'x_transmit_no_out_sub1'
		$val = $CurrentForm->hasValue("transmit_no_out_sub1") ? $CurrentForm->getValue("transmit_no_out_sub1") : $CurrentForm->getValue("x_transmit_no_out_sub1");
		if (!$this->transmit_no_out_sub1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_out_sub1->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_out_sub1->setFormValue($val);
		}

		// Check field name 'approval_status_out_sub1' first before field var 'x_approval_status_out_sub1'
		$val = $CurrentForm->hasValue("approval_status_out_sub1") ? $CurrentForm->getValue("approval_status_out_sub1") : $CurrentForm->getValue("x_approval_status_out_sub1");
		if (!$this->approval_status_out_sub1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_out_sub1->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_out_sub1->setFormValue($val);
		}

		// Check field name 'direction_out_file_sub1' first before field var 'x_direction_out_file_sub1'
		$val = $CurrentForm->hasValue("direction_out_file_sub1") ? $CurrentForm->getValue("direction_out_file_sub1") : $CurrentForm->getValue("x_direction_out_file_sub1");
		if (!$this->direction_out_file_sub1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_out_file_sub1->Visible = FALSE; // Disable update for API request
			else
				$this->direction_out_file_sub1->setFormValue($val);
		}

		// Check field name 'direction_in_sub1' first before field var 'x_direction_in_sub1'
		$val = $CurrentForm->hasValue("direction_in_sub1") ? $CurrentForm->getValue("direction_in_sub1") : $CurrentForm->getValue("x_direction_in_sub1");
		if (!$this->direction_in_sub1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_in_sub1->Visible = FALSE; // Disable update for API request
			else
				$this->direction_in_sub1->setFormValue($val);
		}

		// Check field name 'transmit_no_in_sub1' first before field var 'x_transmit_no_in_sub1'
		$val = $CurrentForm->hasValue("transmit_no_in_sub1") ? $CurrentForm->getValue("transmit_no_in_sub1") : $CurrentForm->getValue("x_transmit_no_in_sub1");
		if (!$this->transmit_no_in_sub1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_in_sub1->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_in_sub1->setFormValue($val);
		}

		// Check field name 'approval_status_in_sub1' first before field var 'x_approval_status_in_sub1'
		$val = $CurrentForm->hasValue("approval_status_in_sub1") ? $CurrentForm->getValue("approval_status_in_sub1") : $CurrentForm->getValue("x_approval_status_in_sub1");
		if (!$this->approval_status_in_sub1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_in_sub1->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_in_sub1->setFormValue($val);
		}

		// Check field name 'transmit_date_in_sub1' first before field var 'x_transmit_date_in_sub1'
		$val = $CurrentForm->hasValue("transmit_date_in_sub1") ? $CurrentForm->getValue("transmit_date_in_sub1") : $CurrentForm->getValue("x_transmit_date_in_sub1");
		if (!$this->transmit_date_in_sub1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_in_sub1->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_in_sub1->setFormValue($val);
			$this->transmit_date_in_sub1->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub1->CurrentValue, 0);
		}

		// Check field name 'submit_no_sub2' first before field var 'x_submit_no_sub2'
		$val = $CurrentForm->hasValue("submit_no_sub2") ? $CurrentForm->getValue("submit_no_sub2") : $CurrentForm->getValue("x_submit_no_sub2");
		if (!$this->submit_no_sub2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->submit_no_sub2->Visible = FALSE; // Disable update for API request
			else
				$this->submit_no_sub2->setFormValue($val);
		}

		// Check field name 'revision_no_sub2' first before field var 'x_revision_no_sub2'
		$val = $CurrentForm->hasValue("revision_no_sub2") ? $CurrentForm->getValue("revision_no_sub2") : $CurrentForm->getValue("x_revision_no_sub2");
		if (!$this->revision_no_sub2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->revision_no_sub2->Visible = FALSE; // Disable update for API request
			else
				$this->revision_no_sub2->setFormValue($val);
		}

		// Check field name 'direction_out_sub2' first before field var 'x_direction_out_sub2'
		$val = $CurrentForm->hasValue("direction_out_sub2") ? $CurrentForm->getValue("direction_out_sub2") : $CurrentForm->getValue("x_direction_out_sub2");
		if (!$this->direction_out_sub2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_out_sub2->Visible = FALSE; // Disable update for API request
			else
				$this->direction_out_sub2->setFormValue($val);
		}

		// Check field name 'planned_date_out_sub2' first before field var 'x_planned_date_out_sub2'
		$val = $CurrentForm->hasValue("planned_date_out_sub2") ? $CurrentForm->getValue("planned_date_out_sub2") : $CurrentForm->getValue("x_planned_date_out_sub2");
		if (!$this->planned_date_out_sub2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->planned_date_out_sub2->Visible = FALSE; // Disable update for API request
			else
				$this->planned_date_out_sub2->setFormValue($val);
			$this->planned_date_out_sub2->CurrentValue = UnFormatDateTime($this->planned_date_out_sub2->CurrentValue, 0);
		}

		// Check field name 'transmit_date_out_sub2' first before field var 'x_transmit_date_out_sub2'
		$val = $CurrentForm->hasValue("transmit_date_out_sub2") ? $CurrentForm->getValue("transmit_date_out_sub2") : $CurrentForm->getValue("x_transmit_date_out_sub2");
		if (!$this->transmit_date_out_sub2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_out_sub2->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_out_sub2->setFormValue($val);
			$this->transmit_date_out_sub2->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub2->CurrentValue, 0);
		}

		// Check field name 'transmit_no_out_sub2' first before field var 'x_transmit_no_out_sub2'
		$val = $CurrentForm->hasValue("transmit_no_out_sub2") ? $CurrentForm->getValue("transmit_no_out_sub2") : $CurrentForm->getValue("x_transmit_no_out_sub2");
		if (!$this->transmit_no_out_sub2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_out_sub2->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_out_sub2->setFormValue($val);
		}

		// Check field name 'approval_status_out_sub2' first before field var 'x_approval_status_out_sub2'
		$val = $CurrentForm->hasValue("approval_status_out_sub2") ? $CurrentForm->getValue("approval_status_out_sub2") : $CurrentForm->getValue("x_approval_status_out_sub2");
		if (!$this->approval_status_out_sub2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_out_sub2->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_out_sub2->setFormValue($val);
		}

		// Check field name 'direction_in_sub2' first before field var 'x_direction_in_sub2'
		$val = $CurrentForm->hasValue("direction_in_sub2") ? $CurrentForm->getValue("direction_in_sub2") : $CurrentForm->getValue("x_direction_in_sub2");
		if (!$this->direction_in_sub2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_in_sub2->Visible = FALSE; // Disable update for API request
			else
				$this->direction_in_sub2->setFormValue($val);
		}

		// Check field name 'transmit_no_in_sub2' first before field var 'x_transmit_no_in_sub2'
		$val = $CurrentForm->hasValue("transmit_no_in_sub2") ? $CurrentForm->getValue("transmit_no_in_sub2") : $CurrentForm->getValue("x_transmit_no_in_sub2");
		if (!$this->transmit_no_in_sub2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_in_sub2->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_in_sub2->setFormValue($val);
		}

		// Check field name 'approval_status_in_sub2' first before field var 'x_approval_status_in_sub2'
		$val = $CurrentForm->hasValue("approval_status_in_sub2") ? $CurrentForm->getValue("approval_status_in_sub2") : $CurrentForm->getValue("x_approval_status_in_sub2");
		if (!$this->approval_status_in_sub2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_in_sub2->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_in_sub2->setFormValue($val);
		}

		// Check field name 'transmit_date_in_sub2' first before field var 'x_transmit_date_in_sub2'
		$val = $CurrentForm->hasValue("transmit_date_in_sub2") ? $CurrentForm->getValue("transmit_date_in_sub2") : $CurrentForm->getValue("x_transmit_date_in_sub2");
		if (!$this->transmit_date_in_sub2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_in_sub2->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_in_sub2->setFormValue($val);
			$this->transmit_date_in_sub2->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub2->CurrentValue, 0);
		}

		// Check field name 'submit_no_sub3' first before field var 'x_submit_no_sub3'
		$val = $CurrentForm->hasValue("submit_no_sub3") ? $CurrentForm->getValue("submit_no_sub3") : $CurrentForm->getValue("x_submit_no_sub3");
		if (!$this->submit_no_sub3->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->submit_no_sub3->Visible = FALSE; // Disable update for API request
			else
				$this->submit_no_sub3->setFormValue($val);
		}

		// Check field name 'revision_no_sub3' first before field var 'x_revision_no_sub3'
		$val = $CurrentForm->hasValue("revision_no_sub3") ? $CurrentForm->getValue("revision_no_sub3") : $CurrentForm->getValue("x_revision_no_sub3");
		if (!$this->revision_no_sub3->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->revision_no_sub3->Visible = FALSE; // Disable update for API request
			else
				$this->revision_no_sub3->setFormValue($val);
		}

		// Check field name 'direction_out_sub3' first before field var 'x_direction_out_sub3'
		$val = $CurrentForm->hasValue("direction_out_sub3") ? $CurrentForm->getValue("direction_out_sub3") : $CurrentForm->getValue("x_direction_out_sub3");
		if (!$this->direction_out_sub3->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_out_sub3->Visible = FALSE; // Disable update for API request
			else
				$this->direction_out_sub3->setFormValue($val);
		}

		// Check field name 'planned_date_out_sub3' first before field var 'x_planned_date_out_sub3'
		$val = $CurrentForm->hasValue("planned_date_out_sub3") ? $CurrentForm->getValue("planned_date_out_sub3") : $CurrentForm->getValue("x_planned_date_out_sub3");
		if (!$this->planned_date_out_sub3->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->planned_date_out_sub3->Visible = FALSE; // Disable update for API request
			else
				$this->planned_date_out_sub3->setFormValue($val);
			$this->planned_date_out_sub3->CurrentValue = UnFormatDateTime($this->planned_date_out_sub3->CurrentValue, 0);
		}

		// Check field name 'transmit_date_out_sub3' first before field var 'x_transmit_date_out_sub3'
		$val = $CurrentForm->hasValue("transmit_date_out_sub3") ? $CurrentForm->getValue("transmit_date_out_sub3") : $CurrentForm->getValue("x_transmit_date_out_sub3");
		if (!$this->transmit_date_out_sub3->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_out_sub3->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_out_sub3->setFormValue($val);
			$this->transmit_date_out_sub3->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub3->CurrentValue, 0);
		}

		// Check field name 'transmit_no_out_sub3' first before field var 'x_transmit_no_out_sub3'
		$val = $CurrentForm->hasValue("transmit_no_out_sub3") ? $CurrentForm->getValue("transmit_no_out_sub3") : $CurrentForm->getValue("x_transmit_no_out_sub3");
		if (!$this->transmit_no_out_sub3->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_out_sub3->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_out_sub3->setFormValue($val);
		}

		// Check field name 'approval_status_out_sub3' first before field var 'x_approval_status_out_sub3'
		$val = $CurrentForm->hasValue("approval_status_out_sub3") ? $CurrentForm->getValue("approval_status_out_sub3") : $CurrentForm->getValue("x_approval_status_out_sub3");
		if (!$this->approval_status_out_sub3->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_out_sub3->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_out_sub3->setFormValue($val);
		}

		// Check field name 'direction_in_sub3' first before field var 'x_direction_in_sub3'
		$val = $CurrentForm->hasValue("direction_in_sub3") ? $CurrentForm->getValue("direction_in_sub3") : $CurrentForm->getValue("x_direction_in_sub3");
		if (!$this->direction_in_sub3->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_in_sub3->Visible = FALSE; // Disable update for API request
			else
				$this->direction_in_sub3->setFormValue($val);
		}

		// Check field name 'transmit_no_in_sub3' first before field var 'x_transmit_no_in_sub3'
		$val = $CurrentForm->hasValue("transmit_no_in_sub3") ? $CurrentForm->getValue("transmit_no_in_sub3") : $CurrentForm->getValue("x_transmit_no_in_sub3");
		if (!$this->transmit_no_in_sub3->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_in_sub3->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_in_sub3->setFormValue($val);
		}

		// Check field name 'approval_status_in_sub3' first before field var 'x_approval_status_in_sub3'
		$val = $CurrentForm->hasValue("approval_status_in_sub3") ? $CurrentForm->getValue("approval_status_in_sub3") : $CurrentForm->getValue("x_approval_status_in_sub3");
		if (!$this->approval_status_in_sub3->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_in_sub3->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_in_sub3->setFormValue($val);
		}

		// Check field name 'transmit_date_in_sub3' first before field var 'x_transmit_date_in_sub3'
		$val = $CurrentForm->hasValue("transmit_date_in_sub3") ? $CurrentForm->getValue("transmit_date_in_sub3") : $CurrentForm->getValue("x_transmit_date_in_sub3");
		if (!$this->transmit_date_in_sub3->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_in_sub3->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_in_sub3->setFormValue($val);
			$this->transmit_date_in_sub3->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub3->CurrentValue, 0);
		}

		// Check field name 'submit_no_sub4' first before field var 'x_submit_no_sub4'
		$val = $CurrentForm->hasValue("submit_no_sub4") ? $CurrentForm->getValue("submit_no_sub4") : $CurrentForm->getValue("x_submit_no_sub4");
		if (!$this->submit_no_sub4->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->submit_no_sub4->Visible = FALSE; // Disable update for API request
			else
				$this->submit_no_sub4->setFormValue($val);
		}

		// Check field name 'revision_no_sub4' first before field var 'x_revision_no_sub4'
		$val = $CurrentForm->hasValue("revision_no_sub4") ? $CurrentForm->getValue("revision_no_sub4") : $CurrentForm->getValue("x_revision_no_sub4");
		if (!$this->revision_no_sub4->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->revision_no_sub4->Visible = FALSE; // Disable update for API request
			else
				$this->revision_no_sub4->setFormValue($val);
		}

		// Check field name 'direction_out_sub4' first before field var 'x_direction_out_sub4'
		$val = $CurrentForm->hasValue("direction_out_sub4") ? $CurrentForm->getValue("direction_out_sub4") : $CurrentForm->getValue("x_direction_out_sub4");
		if (!$this->direction_out_sub4->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_out_sub4->Visible = FALSE; // Disable update for API request
			else
				$this->direction_out_sub4->setFormValue($val);
		}

		// Check field name 'planned_date_out_sub4' first before field var 'x_planned_date_out_sub4'
		$val = $CurrentForm->hasValue("planned_date_out_sub4") ? $CurrentForm->getValue("planned_date_out_sub4") : $CurrentForm->getValue("x_planned_date_out_sub4");
		if (!$this->planned_date_out_sub4->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->planned_date_out_sub4->Visible = FALSE; // Disable update for API request
			else
				$this->planned_date_out_sub4->setFormValue($val);
			$this->planned_date_out_sub4->CurrentValue = UnFormatDateTime($this->planned_date_out_sub4->CurrentValue, 0);
		}

		// Check field name 'transmit_date_out_sub4' first before field var 'x_transmit_date_out_sub4'
		$val = $CurrentForm->hasValue("transmit_date_out_sub4") ? $CurrentForm->getValue("transmit_date_out_sub4") : $CurrentForm->getValue("x_transmit_date_out_sub4");
		if (!$this->transmit_date_out_sub4->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_out_sub4->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_out_sub4->setFormValue($val);
			$this->transmit_date_out_sub4->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub4->CurrentValue, 0);
		}

		// Check field name 'transmit_no_out_sub4' first before field var 'x_transmit_no_out_sub4'
		$val = $CurrentForm->hasValue("transmit_no_out_sub4") ? $CurrentForm->getValue("transmit_no_out_sub4") : $CurrentForm->getValue("x_transmit_no_out_sub4");
		if (!$this->transmit_no_out_sub4->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_out_sub4->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_out_sub4->setFormValue($val);
		}

		// Check field name 'approval_status_out_sub4' first before field var 'x_approval_status_out_sub4'
		$val = $CurrentForm->hasValue("approval_status_out_sub4") ? $CurrentForm->getValue("approval_status_out_sub4") : $CurrentForm->getValue("x_approval_status_out_sub4");
		if (!$this->approval_status_out_sub4->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_out_sub4->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_out_sub4->setFormValue($val);
		}

		// Check field name 'direction_in_sub4' first before field var 'x_direction_in_sub4'
		$val = $CurrentForm->hasValue("direction_in_sub4") ? $CurrentForm->getValue("direction_in_sub4") : $CurrentForm->getValue("x_direction_in_sub4");
		if (!$this->direction_in_sub4->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_in_sub4->Visible = FALSE; // Disable update for API request
			else
				$this->direction_in_sub4->setFormValue($val);
		}

		// Check field name 'transmit_no_in_sub4' first before field var 'x_transmit_no_in_sub4'
		$val = $CurrentForm->hasValue("transmit_no_in_sub4") ? $CurrentForm->getValue("transmit_no_in_sub4") : $CurrentForm->getValue("x_transmit_no_in_sub4");
		if (!$this->transmit_no_in_sub4->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_in_sub4->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_in_sub4->setFormValue($val);
		}

		// Check field name 'approval_status_in_sub4' first before field var 'x_approval_status_in_sub4'
		$val = $CurrentForm->hasValue("approval_status_in_sub4") ? $CurrentForm->getValue("approval_status_in_sub4") : $CurrentForm->getValue("x_approval_status_in_sub4");
		if (!$this->approval_status_in_sub4->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_in_sub4->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_in_sub4->setFormValue($val);
		}

		// Check field name 'direction_in_file_sub4' first before field var 'x_direction_in_file_sub4'
		$val = $CurrentForm->hasValue("direction_in_file_sub4") ? $CurrentForm->getValue("direction_in_file_sub4") : $CurrentForm->getValue("x_direction_in_file_sub4");
		if (!$this->direction_in_file_sub4->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_in_file_sub4->Visible = FALSE; // Disable update for API request
			else
				$this->direction_in_file_sub4->setFormValue($val);
		}

		// Check field name 'transmit_date_in_sub4' first before field var 'x_transmit_date_in_sub4'
		$val = $CurrentForm->hasValue("transmit_date_in_sub4") ? $CurrentForm->getValue("transmit_date_in_sub4") : $CurrentForm->getValue("x_transmit_date_in_sub4");
		if (!$this->transmit_date_in_sub4->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_in_sub4->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_in_sub4->setFormValue($val);
			$this->transmit_date_in_sub4->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub4->CurrentValue, 0);
		}

		// Check field name 'submit_no_sub5' first before field var 'x_submit_no_sub5'
		$val = $CurrentForm->hasValue("submit_no_sub5") ? $CurrentForm->getValue("submit_no_sub5") : $CurrentForm->getValue("x_submit_no_sub5");
		if (!$this->submit_no_sub5->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->submit_no_sub5->Visible = FALSE; // Disable update for API request
			else
				$this->submit_no_sub5->setFormValue($val);
		}

		// Check field name 'revision_no_sub5' first before field var 'x_revision_no_sub5'
		$val = $CurrentForm->hasValue("revision_no_sub5") ? $CurrentForm->getValue("revision_no_sub5") : $CurrentForm->getValue("x_revision_no_sub5");
		if (!$this->revision_no_sub5->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->revision_no_sub5->Visible = FALSE; // Disable update for API request
			else
				$this->revision_no_sub5->setFormValue($val);
		}

		// Check field name 'direction_out_sub5' first before field var 'x_direction_out_sub5'
		$val = $CurrentForm->hasValue("direction_out_sub5") ? $CurrentForm->getValue("direction_out_sub5") : $CurrentForm->getValue("x_direction_out_sub5");
		if (!$this->direction_out_sub5->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_out_sub5->Visible = FALSE; // Disable update for API request
			else
				$this->direction_out_sub5->setFormValue($val);
		}

		// Check field name 'planned_date_out_sub5' first before field var 'x_planned_date_out_sub5'
		$val = $CurrentForm->hasValue("planned_date_out_sub5") ? $CurrentForm->getValue("planned_date_out_sub5") : $CurrentForm->getValue("x_planned_date_out_sub5");
		if (!$this->planned_date_out_sub5->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->planned_date_out_sub5->Visible = FALSE; // Disable update for API request
			else
				$this->planned_date_out_sub5->setFormValue($val);
			$this->planned_date_out_sub5->CurrentValue = UnFormatDateTime($this->planned_date_out_sub5->CurrentValue, 0);
		}

		// Check field name 'transmit_date_out_sub5' first before field var 'x_transmit_date_out_sub5'
		$val = $CurrentForm->hasValue("transmit_date_out_sub5") ? $CurrentForm->getValue("transmit_date_out_sub5") : $CurrentForm->getValue("x_transmit_date_out_sub5");
		if (!$this->transmit_date_out_sub5->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_out_sub5->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_out_sub5->setFormValue($val);
			$this->transmit_date_out_sub5->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub5->CurrentValue, 0);
		}

		// Check field name 'transmit_no_out_sub5' first before field var 'x_transmit_no_out_sub5'
		$val = $CurrentForm->hasValue("transmit_no_out_sub5") ? $CurrentForm->getValue("transmit_no_out_sub5") : $CurrentForm->getValue("x_transmit_no_out_sub5");
		if (!$this->transmit_no_out_sub5->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_out_sub5->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_out_sub5->setFormValue($val);
		}

		// Check field name 'approval_status_out_sub5' first before field var 'x_approval_status_out_sub5'
		$val = $CurrentForm->hasValue("approval_status_out_sub5") ? $CurrentForm->getValue("approval_status_out_sub5") : $CurrentForm->getValue("x_approval_status_out_sub5");
		if (!$this->approval_status_out_sub5->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_out_sub5->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_out_sub5->setFormValue($val);
		}

		// Check field name 'direction_in_sub5' first before field var 'x_direction_in_sub5'
		$val = $CurrentForm->hasValue("direction_in_sub5") ? $CurrentForm->getValue("direction_in_sub5") : $CurrentForm->getValue("x_direction_in_sub5");
		if (!$this->direction_in_sub5->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_in_sub5->Visible = FALSE; // Disable update for API request
			else
				$this->direction_in_sub5->setFormValue($val);
		}

		// Check field name 'transmit_no_in_sub5' first before field var 'x_transmit_no_in_sub5'
		$val = $CurrentForm->hasValue("transmit_no_in_sub5") ? $CurrentForm->getValue("transmit_no_in_sub5") : $CurrentForm->getValue("x_transmit_no_in_sub5");
		if (!$this->transmit_no_in_sub5->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_in_sub5->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_in_sub5->setFormValue($val);
		}

		// Check field name 'approval_status_in_sub5' first before field var 'x_approval_status_in_sub5'
		$val = $CurrentForm->hasValue("approval_status_in_sub5") ? $CurrentForm->getValue("approval_status_in_sub5") : $CurrentForm->getValue("x_approval_status_in_sub5");
		if (!$this->approval_status_in_sub5->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_in_sub5->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_in_sub5->setFormValue($val);
		}

		// Check field name 'direction_in_file_sub5' first before field var 'x_direction_in_file_sub5'
		$val = $CurrentForm->hasValue("direction_in_file_sub5") ? $CurrentForm->getValue("direction_in_file_sub5") : $CurrentForm->getValue("x_direction_in_file_sub5");
		if (!$this->direction_in_file_sub5->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_in_file_sub5->Visible = FALSE; // Disable update for API request
			else
				$this->direction_in_file_sub5->setFormValue($val);
		}

		// Check field name 'transmit_date_in_sub5' first before field var 'x_transmit_date_in_sub5'
		$val = $CurrentForm->hasValue("transmit_date_in_sub5") ? $CurrentForm->getValue("transmit_date_in_sub5") : $CurrentForm->getValue("x_transmit_date_in_sub5");
		if (!$this->transmit_date_in_sub5->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_in_sub5->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_in_sub5->setFormValue($val);
			$this->transmit_date_in_sub5->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub5->CurrentValue, 0);
		}

		// Check field name 'submit_no_sub6' first before field var 'x_submit_no_sub6'
		$val = $CurrentForm->hasValue("submit_no_sub6") ? $CurrentForm->getValue("submit_no_sub6") : $CurrentForm->getValue("x_submit_no_sub6");
		if (!$this->submit_no_sub6->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->submit_no_sub6->Visible = FALSE; // Disable update for API request
			else
				$this->submit_no_sub6->setFormValue($val);
		}

		// Check field name 'revision_no_sub6' first before field var 'x_revision_no_sub6'
		$val = $CurrentForm->hasValue("revision_no_sub6") ? $CurrentForm->getValue("revision_no_sub6") : $CurrentForm->getValue("x_revision_no_sub6");
		if (!$this->revision_no_sub6->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->revision_no_sub6->Visible = FALSE; // Disable update for API request
			else
				$this->revision_no_sub6->setFormValue($val);
		}

		// Check field name 'direction_out_sub6' first before field var 'x_direction_out_sub6'
		$val = $CurrentForm->hasValue("direction_out_sub6") ? $CurrentForm->getValue("direction_out_sub6") : $CurrentForm->getValue("x_direction_out_sub6");
		if (!$this->direction_out_sub6->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_out_sub6->Visible = FALSE; // Disable update for API request
			else
				$this->direction_out_sub6->setFormValue($val);
		}

		// Check field name 'planned_date_out_sub6' first before field var 'x_planned_date_out_sub6'
		$val = $CurrentForm->hasValue("planned_date_out_sub6") ? $CurrentForm->getValue("planned_date_out_sub6") : $CurrentForm->getValue("x_planned_date_out_sub6");
		if (!$this->planned_date_out_sub6->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->planned_date_out_sub6->Visible = FALSE; // Disable update for API request
			else
				$this->planned_date_out_sub6->setFormValue($val);
			$this->planned_date_out_sub6->CurrentValue = UnFormatDateTime($this->planned_date_out_sub6->CurrentValue, 0);
		}

		// Check field name 'transmit_date_out_sub6' first before field var 'x_transmit_date_out_sub6'
		$val = $CurrentForm->hasValue("transmit_date_out_sub6") ? $CurrentForm->getValue("transmit_date_out_sub6") : $CurrentForm->getValue("x_transmit_date_out_sub6");
		if (!$this->transmit_date_out_sub6->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_out_sub6->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_out_sub6->setFormValue($val);
			$this->transmit_date_out_sub6->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub6->CurrentValue, 0);
		}

		// Check field name 'transmit_no_out_sub6' first before field var 'x_transmit_no_out_sub6'
		$val = $CurrentForm->hasValue("transmit_no_out_sub6") ? $CurrentForm->getValue("transmit_no_out_sub6") : $CurrentForm->getValue("x_transmit_no_out_sub6");
		if (!$this->transmit_no_out_sub6->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_out_sub6->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_out_sub6->setFormValue($val);
		}

		// Check field name 'approval_status_out_sub6' first before field var 'x_approval_status_out_sub6'
		$val = $CurrentForm->hasValue("approval_status_out_sub6") ? $CurrentForm->getValue("approval_status_out_sub6") : $CurrentForm->getValue("x_approval_status_out_sub6");
		if (!$this->approval_status_out_sub6->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_out_sub6->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_out_sub6->setFormValue($val);
		}

		// Check field name 'direction_in_sub6' first before field var 'x_direction_in_sub6'
		$val = $CurrentForm->hasValue("direction_in_sub6") ? $CurrentForm->getValue("direction_in_sub6") : $CurrentForm->getValue("x_direction_in_sub6");
		if (!$this->direction_in_sub6->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_in_sub6->Visible = FALSE; // Disable update for API request
			else
				$this->direction_in_sub6->setFormValue($val);
		}

		// Check field name 'transmit_no_in_sub6' first before field var 'x_transmit_no_in_sub6'
		$val = $CurrentForm->hasValue("transmit_no_in_sub6") ? $CurrentForm->getValue("transmit_no_in_sub6") : $CurrentForm->getValue("x_transmit_no_in_sub6");
		if (!$this->transmit_no_in_sub6->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_in_sub6->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_in_sub6->setFormValue($val);
		}

		// Check field name 'approval_status_in_sub6' first before field var 'x_approval_status_in_sub6'
		$val = $CurrentForm->hasValue("approval_status_in_sub6") ? $CurrentForm->getValue("approval_status_in_sub6") : $CurrentForm->getValue("x_approval_status_in_sub6");
		if (!$this->approval_status_in_sub6->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_in_sub6->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_in_sub6->setFormValue($val);
		}

		// Check field name 'direction_in_file_sub6' first before field var 'x_direction_in_file_sub6'
		$val = $CurrentForm->hasValue("direction_in_file_sub6") ? $CurrentForm->getValue("direction_in_file_sub6") : $CurrentForm->getValue("x_direction_in_file_sub6");
		if (!$this->direction_in_file_sub6->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_in_file_sub6->Visible = FALSE; // Disable update for API request
			else
				$this->direction_in_file_sub6->setFormValue($val);
		}

		// Check field name 'transmit_date_in_sub6' first before field var 'x_transmit_date_in_sub6'
		$val = $CurrentForm->hasValue("transmit_date_in_sub6") ? $CurrentForm->getValue("transmit_date_in_sub6") : $CurrentForm->getValue("x_transmit_date_in_sub6");
		if (!$this->transmit_date_in_sub6->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_in_sub6->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_in_sub6->setFormValue($val);
			$this->transmit_date_in_sub6->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub6->CurrentValue, 0);
		}

		// Check field name 'submit_no_sub7' first before field var 'x_submit_no_sub7'
		$val = $CurrentForm->hasValue("submit_no_sub7") ? $CurrentForm->getValue("submit_no_sub7") : $CurrentForm->getValue("x_submit_no_sub7");
		if (!$this->submit_no_sub7->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->submit_no_sub7->Visible = FALSE; // Disable update for API request
			else
				$this->submit_no_sub7->setFormValue($val);
		}

		// Check field name 'revision_no_sub7' first before field var 'x_revision_no_sub7'
		$val = $CurrentForm->hasValue("revision_no_sub7") ? $CurrentForm->getValue("revision_no_sub7") : $CurrentForm->getValue("x_revision_no_sub7");
		if (!$this->revision_no_sub7->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->revision_no_sub7->Visible = FALSE; // Disable update for API request
			else
				$this->revision_no_sub7->setFormValue($val);
		}

		// Check field name 'direction_out_sub7' first before field var 'x_direction_out_sub7'
		$val = $CurrentForm->hasValue("direction_out_sub7") ? $CurrentForm->getValue("direction_out_sub7") : $CurrentForm->getValue("x_direction_out_sub7");
		if (!$this->direction_out_sub7->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_out_sub7->Visible = FALSE; // Disable update for API request
			else
				$this->direction_out_sub7->setFormValue($val);
		}

		// Check field name 'planned_date_out_sub7' first before field var 'x_planned_date_out_sub7'
		$val = $CurrentForm->hasValue("planned_date_out_sub7") ? $CurrentForm->getValue("planned_date_out_sub7") : $CurrentForm->getValue("x_planned_date_out_sub7");
		if (!$this->planned_date_out_sub7->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->planned_date_out_sub7->Visible = FALSE; // Disable update for API request
			else
				$this->planned_date_out_sub7->setFormValue($val);
			$this->planned_date_out_sub7->CurrentValue = UnFormatDateTime($this->planned_date_out_sub7->CurrentValue, 0);
		}

		// Check field name 'transmit_date_out_sub7' first before field var 'x_transmit_date_out_sub7'
		$val = $CurrentForm->hasValue("transmit_date_out_sub7") ? $CurrentForm->getValue("transmit_date_out_sub7") : $CurrentForm->getValue("x_transmit_date_out_sub7");
		if (!$this->transmit_date_out_sub7->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_out_sub7->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_out_sub7->setFormValue($val);
			$this->transmit_date_out_sub7->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub7->CurrentValue, 0);
		}

		// Check field name 'transmit_no_out_sub7' first before field var 'x_transmit_no_out_sub7'
		$val = $CurrentForm->hasValue("transmit_no_out_sub7") ? $CurrentForm->getValue("transmit_no_out_sub7") : $CurrentForm->getValue("x_transmit_no_out_sub7");
		if (!$this->transmit_no_out_sub7->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_out_sub7->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_out_sub7->setFormValue($val);
		}

		// Check field name 'approval_status_out_sub7' first before field var 'x_approval_status_out_sub7'
		$val = $CurrentForm->hasValue("approval_status_out_sub7") ? $CurrentForm->getValue("approval_status_out_sub7") : $CurrentForm->getValue("x_approval_status_out_sub7");
		if (!$this->approval_status_out_sub7->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_out_sub7->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_out_sub7->setFormValue($val);
		}

		// Check field name 'direction_in_sub7' first before field var 'x_direction_in_sub7'
		$val = $CurrentForm->hasValue("direction_in_sub7") ? $CurrentForm->getValue("direction_in_sub7") : $CurrentForm->getValue("x_direction_in_sub7");
		if (!$this->direction_in_sub7->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_in_sub7->Visible = FALSE; // Disable update for API request
			else
				$this->direction_in_sub7->setFormValue($val);
		}

		// Check field name 'transmit_no_in_sub7' first before field var 'x_transmit_no_in_sub7'
		$val = $CurrentForm->hasValue("transmit_no_in_sub7") ? $CurrentForm->getValue("transmit_no_in_sub7") : $CurrentForm->getValue("x_transmit_no_in_sub7");
		if (!$this->transmit_no_in_sub7->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_in_sub7->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_in_sub7->setFormValue($val);
		}

		// Check field name 'approval_status_in_sub7' first before field var 'x_approval_status_in_sub7'
		$val = $CurrentForm->hasValue("approval_status_in_sub7") ? $CurrentForm->getValue("approval_status_in_sub7") : $CurrentForm->getValue("x_approval_status_in_sub7");
		if (!$this->approval_status_in_sub7->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_in_sub7->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_in_sub7->setFormValue($val);
		}

		// Check field name 'transmit_date_in_sub7' first before field var 'x_transmit_date_in_sub7'
		$val = $CurrentForm->hasValue("transmit_date_in_sub7") ? $CurrentForm->getValue("transmit_date_in_sub7") : $CurrentForm->getValue("x_transmit_date_in_sub7");
		if (!$this->transmit_date_in_sub7->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_in_sub7->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_in_sub7->setFormValue($val);
			$this->transmit_date_in_sub7->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub7->CurrentValue, 0);
		}

		// Check field name 'submit_no_sub8' first before field var 'x_submit_no_sub8'
		$val = $CurrentForm->hasValue("submit_no_sub8") ? $CurrentForm->getValue("submit_no_sub8") : $CurrentForm->getValue("x_submit_no_sub8");
		if (!$this->submit_no_sub8->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->submit_no_sub8->Visible = FALSE; // Disable update for API request
			else
				$this->submit_no_sub8->setFormValue($val);
		}

		// Check field name 'revision_no_sub8' first before field var 'x_revision_no_sub8'
		$val = $CurrentForm->hasValue("revision_no_sub8") ? $CurrentForm->getValue("revision_no_sub8") : $CurrentForm->getValue("x_revision_no_sub8");
		if (!$this->revision_no_sub8->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->revision_no_sub8->Visible = FALSE; // Disable update for API request
			else
				$this->revision_no_sub8->setFormValue($val);
		}

		// Check field name 'direction_out_sub8' first before field var 'x_direction_out_sub8'
		$val = $CurrentForm->hasValue("direction_out_sub8") ? $CurrentForm->getValue("direction_out_sub8") : $CurrentForm->getValue("x_direction_out_sub8");
		if (!$this->direction_out_sub8->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_out_sub8->Visible = FALSE; // Disable update for API request
			else
				$this->direction_out_sub8->setFormValue($val);
		}

		// Check field name 'planned_date_out_sub8' first before field var 'x_planned_date_out_sub8'
		$val = $CurrentForm->hasValue("planned_date_out_sub8") ? $CurrentForm->getValue("planned_date_out_sub8") : $CurrentForm->getValue("x_planned_date_out_sub8");
		if (!$this->planned_date_out_sub8->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->planned_date_out_sub8->Visible = FALSE; // Disable update for API request
			else
				$this->planned_date_out_sub8->setFormValue($val);
			$this->planned_date_out_sub8->CurrentValue = UnFormatDateTime($this->planned_date_out_sub8->CurrentValue, 0);
		}

		// Check field name 'transmit_date_out_sub8' first before field var 'x_transmit_date_out_sub8'
		$val = $CurrentForm->hasValue("transmit_date_out_sub8") ? $CurrentForm->getValue("transmit_date_out_sub8") : $CurrentForm->getValue("x_transmit_date_out_sub8");
		if (!$this->transmit_date_out_sub8->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_out_sub8->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_out_sub8->setFormValue($val);
			$this->transmit_date_out_sub8->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub8->CurrentValue, 0);
		}

		// Check field name 'transmit_no_out_sub8' first before field var 'x_transmit_no_out_sub8'
		$val = $CurrentForm->hasValue("transmit_no_out_sub8") ? $CurrentForm->getValue("transmit_no_out_sub8") : $CurrentForm->getValue("x_transmit_no_out_sub8");
		if (!$this->transmit_no_out_sub8->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_out_sub8->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_out_sub8->setFormValue($val);
		}

		// Check field name 'approval_status_out_sub8' first before field var 'x_approval_status_out_sub8'
		$val = $CurrentForm->hasValue("approval_status_out_sub8") ? $CurrentForm->getValue("approval_status_out_sub8") : $CurrentForm->getValue("x_approval_status_out_sub8");
		if (!$this->approval_status_out_sub8->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_out_sub8->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_out_sub8->setFormValue($val);
		}

		// Check field name 'direction_out_file_sub8' first before field var 'x_direction_out_file_sub8'
		$val = $CurrentForm->hasValue("direction_out_file_sub8") ? $CurrentForm->getValue("direction_out_file_sub8") : $CurrentForm->getValue("x_direction_out_file_sub8");
		if (!$this->direction_out_file_sub8->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_out_file_sub8->Visible = FALSE; // Disable update for API request
			else
				$this->direction_out_file_sub8->setFormValue($val);
		}

		// Check field name 'direction_in_sub8' first before field var 'x_direction_in_sub8'
		$val = $CurrentForm->hasValue("direction_in_sub8") ? $CurrentForm->getValue("direction_in_sub8") : $CurrentForm->getValue("x_direction_in_sub8");
		if (!$this->direction_in_sub8->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_in_sub8->Visible = FALSE; // Disable update for API request
			else
				$this->direction_in_sub8->setFormValue($val);
		}

		// Check field name 'transmit_no_in_sub8' first before field var 'x_transmit_no_in_sub8'
		$val = $CurrentForm->hasValue("transmit_no_in_sub8") ? $CurrentForm->getValue("transmit_no_in_sub8") : $CurrentForm->getValue("x_transmit_no_in_sub8");
		if (!$this->transmit_no_in_sub8->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_in_sub8->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_in_sub8->setFormValue($val);
		}

		// Check field name 'approval_status_in_sub8' first before field var 'x_approval_status_in_sub8'
		$val = $CurrentForm->hasValue("approval_status_in_sub8") ? $CurrentForm->getValue("approval_status_in_sub8") : $CurrentForm->getValue("x_approval_status_in_sub8");
		if (!$this->approval_status_in_sub8->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_in_sub8->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_in_sub8->setFormValue($val);
		}

		// Check field name 'transmit_date_in_sub8' first before field var 'x_transmit_date_in_sub8'
		$val = $CurrentForm->hasValue("transmit_date_in_sub8") ? $CurrentForm->getValue("transmit_date_in_sub8") : $CurrentForm->getValue("x_transmit_date_in_sub8");
		if (!$this->transmit_date_in_sub8->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_in_sub8->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_in_sub8->setFormValue($val);
			$this->transmit_date_in_sub8->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub8->CurrentValue, 0);
		}

		// Check field name 'submit_no_sub9' first before field var 'x_submit_no_sub9'
		$val = $CurrentForm->hasValue("submit_no_sub9") ? $CurrentForm->getValue("submit_no_sub9") : $CurrentForm->getValue("x_submit_no_sub9");
		if (!$this->submit_no_sub9->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->submit_no_sub9->Visible = FALSE; // Disable update for API request
			else
				$this->submit_no_sub9->setFormValue($val);
		}

		// Check field name 'revision_no_sub9' first before field var 'x_revision_no_sub9'
		$val = $CurrentForm->hasValue("revision_no_sub9") ? $CurrentForm->getValue("revision_no_sub9") : $CurrentForm->getValue("x_revision_no_sub9");
		if (!$this->revision_no_sub9->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->revision_no_sub9->Visible = FALSE; // Disable update for API request
			else
				$this->revision_no_sub9->setFormValue($val);
		}

		// Check field name 'direction_out_sub9' first before field var 'x_direction_out_sub9'
		$val = $CurrentForm->hasValue("direction_out_sub9") ? $CurrentForm->getValue("direction_out_sub9") : $CurrentForm->getValue("x_direction_out_sub9");
		if (!$this->direction_out_sub9->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_out_sub9->Visible = FALSE; // Disable update for API request
			else
				$this->direction_out_sub9->setFormValue($val);
		}

		// Check field name 'planned_date_out_sub9' first before field var 'x_planned_date_out_sub9'
		$val = $CurrentForm->hasValue("planned_date_out_sub9") ? $CurrentForm->getValue("planned_date_out_sub9") : $CurrentForm->getValue("x_planned_date_out_sub9");
		if (!$this->planned_date_out_sub9->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->planned_date_out_sub9->Visible = FALSE; // Disable update for API request
			else
				$this->planned_date_out_sub9->setFormValue($val);
			$this->planned_date_out_sub9->CurrentValue = UnFormatDateTime($this->planned_date_out_sub9->CurrentValue, 0);
		}

		// Check field name 'transmit_date_out_sub9' first before field var 'x_transmit_date_out_sub9'
		$val = $CurrentForm->hasValue("transmit_date_out_sub9") ? $CurrentForm->getValue("transmit_date_out_sub9") : $CurrentForm->getValue("x_transmit_date_out_sub9");
		if (!$this->transmit_date_out_sub9->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_out_sub9->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_out_sub9->setFormValue($val);
			$this->transmit_date_out_sub9->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub9->CurrentValue, 0);
		}

		// Check field name 'transmit_no_out_sub9' first before field var 'x_transmit_no_out_sub9'
		$val = $CurrentForm->hasValue("transmit_no_out_sub9") ? $CurrentForm->getValue("transmit_no_out_sub9") : $CurrentForm->getValue("x_transmit_no_out_sub9");
		if (!$this->transmit_no_out_sub9->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_out_sub9->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_out_sub9->setFormValue($val);
		}

		// Check field name 'approval_status_out_sub9' first before field var 'x_approval_status_out_sub9'
		$val = $CurrentForm->hasValue("approval_status_out_sub9") ? $CurrentForm->getValue("approval_status_out_sub9") : $CurrentForm->getValue("x_approval_status_out_sub9");
		if (!$this->approval_status_out_sub9->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_out_sub9->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_out_sub9->setFormValue($val);
		}

		// Check field name 'direction_in_sub9' first before field var 'x_direction_in_sub9'
		$val = $CurrentForm->hasValue("direction_in_sub9") ? $CurrentForm->getValue("direction_in_sub9") : $CurrentForm->getValue("x_direction_in_sub9");
		if (!$this->direction_in_sub9->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_in_sub9->Visible = FALSE; // Disable update for API request
			else
				$this->direction_in_sub9->setFormValue($val);
		}

		// Check field name 'transmit_no_in_sub9' first before field var 'x_transmit_no_in_sub9'
		$val = $CurrentForm->hasValue("transmit_no_in_sub9") ? $CurrentForm->getValue("transmit_no_in_sub9") : $CurrentForm->getValue("x_transmit_no_in_sub9");
		if (!$this->transmit_no_in_sub9->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_in_sub9->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_in_sub9->setFormValue($val);
		}

		// Check field name 'approval_status_in_sub9' first before field var 'x_approval_status_in_sub9'
		$val = $CurrentForm->hasValue("approval_status_in_sub9") ? $CurrentForm->getValue("approval_status_in_sub9") : $CurrentForm->getValue("x_approval_status_in_sub9");
		if (!$this->approval_status_in_sub9->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_in_sub9->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_in_sub9->setFormValue($val);
		}

		// Check field name 'transmit_date_in_sub9' first before field var 'x_transmit_date_in_sub9'
		$val = $CurrentForm->hasValue("transmit_date_in_sub9") ? $CurrentForm->getValue("transmit_date_in_sub9") : $CurrentForm->getValue("x_transmit_date_in_sub9");
		if (!$this->transmit_date_in_sub9->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_in_sub9->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_in_sub9->setFormValue($val);
			$this->transmit_date_in_sub9->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub9->CurrentValue, 0);
		}

		// Check field name 'submit_no_sub10' first before field var 'x_submit_no_sub10'
		$val = $CurrentForm->hasValue("submit_no_sub10") ? $CurrentForm->getValue("submit_no_sub10") : $CurrentForm->getValue("x_submit_no_sub10");
		if (!$this->submit_no_sub10->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->submit_no_sub10->Visible = FALSE; // Disable update for API request
			else
				$this->submit_no_sub10->setFormValue($val);
		}

		// Check field name 'revision_no_sub10' first before field var 'x_revision_no_sub10'
		$val = $CurrentForm->hasValue("revision_no_sub10") ? $CurrentForm->getValue("revision_no_sub10") : $CurrentForm->getValue("x_revision_no_sub10");
		if (!$this->revision_no_sub10->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->revision_no_sub10->Visible = FALSE; // Disable update for API request
			else
				$this->revision_no_sub10->setFormValue($val);
		}

		// Check field name 'direction_out_sub10' first before field var 'x_direction_out_sub10'
		$val = $CurrentForm->hasValue("direction_out_sub10") ? $CurrentForm->getValue("direction_out_sub10") : $CurrentForm->getValue("x_direction_out_sub10");
		if (!$this->direction_out_sub10->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_out_sub10->Visible = FALSE; // Disable update for API request
			else
				$this->direction_out_sub10->setFormValue($val);
		}

		// Check field name 'planned_date_out_sub10' first before field var 'x_planned_date_out_sub10'
		$val = $CurrentForm->hasValue("planned_date_out_sub10") ? $CurrentForm->getValue("planned_date_out_sub10") : $CurrentForm->getValue("x_planned_date_out_sub10");
		if (!$this->planned_date_out_sub10->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->planned_date_out_sub10->Visible = FALSE; // Disable update for API request
			else
				$this->planned_date_out_sub10->setFormValue($val);
			$this->planned_date_out_sub10->CurrentValue = UnFormatDateTime($this->planned_date_out_sub10->CurrentValue, 0);
		}

		// Check field name 'transmit_date_out_sub10' first before field var 'x_transmit_date_out_sub10'
		$val = $CurrentForm->hasValue("transmit_date_out_sub10") ? $CurrentForm->getValue("transmit_date_out_sub10") : $CurrentForm->getValue("x_transmit_date_out_sub10");
		if (!$this->transmit_date_out_sub10->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_out_sub10->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_out_sub10->setFormValue($val);
			$this->transmit_date_out_sub10->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub10->CurrentValue, 0);
		}

		// Check field name 'transmit_no_out_sub10' first before field var 'x_transmit_no_out_sub10'
		$val = $CurrentForm->hasValue("transmit_no_out_sub10") ? $CurrentForm->getValue("transmit_no_out_sub10") : $CurrentForm->getValue("x_transmit_no_out_sub10");
		if (!$this->transmit_no_out_sub10->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_out_sub10->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_out_sub10->setFormValue($val);
		}

		// Check field name 'approval_status_out_sub10' first before field var 'x_approval_status_out_sub10'
		$val = $CurrentForm->hasValue("approval_status_out_sub10") ? $CurrentForm->getValue("approval_status_out_sub10") : $CurrentForm->getValue("x_approval_status_out_sub10");
		if (!$this->approval_status_out_sub10->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_out_sub10->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_out_sub10->setFormValue($val);
		}

		// Check field name 'direction_in_sub10' first before field var 'x_direction_in_sub10'
		$val = $CurrentForm->hasValue("direction_in_sub10") ? $CurrentForm->getValue("direction_in_sub10") : $CurrentForm->getValue("x_direction_in_sub10");
		if (!$this->direction_in_sub10->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direction_in_sub10->Visible = FALSE; // Disable update for API request
			else
				$this->direction_in_sub10->setFormValue($val);
		}

		// Check field name 'transmit_no_in_sub10' first before field var 'x_transmit_no_in_sub10'
		$val = $CurrentForm->hasValue("transmit_no_in_sub10") ? $CurrentForm->getValue("transmit_no_in_sub10") : $CurrentForm->getValue("x_transmit_no_in_sub10");
		if (!$this->transmit_no_in_sub10->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_no_in_sub10->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_no_in_sub10->setFormValue($val);
		}

		// Check field name 'approval_status_in_sub10' first before field var 'x_approval_status_in_sub10'
		$val = $CurrentForm->hasValue("approval_status_in_sub10") ? $CurrentForm->getValue("approval_status_in_sub10") : $CurrentForm->getValue("x_approval_status_in_sub10");
		if (!$this->approval_status_in_sub10->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->approval_status_in_sub10->Visible = FALSE; // Disable update for API request
			else
				$this->approval_status_in_sub10->setFormValue($val);
		}

		// Check field name 'transmit_date_in_sub10' first before field var 'x_transmit_date_in_sub10'
		$val = $CurrentForm->hasValue("transmit_date_in_sub10") ? $CurrentForm->getValue("transmit_date_in_sub10") : $CurrentForm->getValue("x_transmit_date_in_sub10");
		if (!$this->transmit_date_in_sub10->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->transmit_date_in_sub10->Visible = FALSE; // Disable update for API request
			else
				$this->transmit_date_in_sub10->setFormValue($val);
			$this->transmit_date_in_sub10->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub10->CurrentValue, 0);
		}

		// Check field name 'log_updatedon' first before field var 'x_log_updatedon'
		$val = $CurrentForm->hasValue("log_updatedon") ? $CurrentForm->getValue("log_updatedon") : $CurrentForm->getValue("x_log_updatedon");
		if (!$this->log_updatedon->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->log_updatedon->Visible = FALSE; // Disable update for API request
			else
				$this->log_updatedon->setFormValue($val);
			$this->log_updatedon->CurrentValue = UnFormatDateTime($this->log_updatedon->CurrentValue, 0);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->log_id->CurrentValue = $this->log_id->FormValue;
		$this->firelink_doc_no->CurrentValue = $this->firelink_doc_no->FormValue;
		$this->project_name->CurrentValue = $this->project_name->FormValue;
		$this->document_tittle->CurrentValue = $this->document_tittle->FormValue;
		$this->current_status->CurrentValue = $this->current_status->FormValue;
		$this->submit_no_sub1->CurrentValue = $this->submit_no_sub1->FormValue;
		$this->revision_no_sub1->CurrentValue = $this->revision_no_sub1->FormValue;
		$this->direction_out_sub1->CurrentValue = $this->direction_out_sub1->FormValue;
		$this->planned_date_out_sub1->CurrentValue = $this->planned_date_out_sub1->FormValue;
		$this->planned_date_out_sub1->CurrentValue = UnFormatDateTime($this->planned_date_out_sub1->CurrentValue, 0);
		$this->transmit_date_out_sub1->CurrentValue = $this->transmit_date_out_sub1->FormValue;
		$this->transmit_date_out_sub1->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub1->CurrentValue, 0);
		$this->transmit_no_out_sub1->CurrentValue = $this->transmit_no_out_sub1->FormValue;
		$this->approval_status_out_sub1->CurrentValue = $this->approval_status_out_sub1->FormValue;
		$this->direction_out_file_sub1->CurrentValue = $this->direction_out_file_sub1->FormValue;
		$this->direction_in_sub1->CurrentValue = $this->direction_in_sub1->FormValue;
		$this->transmit_no_in_sub1->CurrentValue = $this->transmit_no_in_sub1->FormValue;
		$this->approval_status_in_sub1->CurrentValue = $this->approval_status_in_sub1->FormValue;
		$this->transmit_date_in_sub1->CurrentValue = $this->transmit_date_in_sub1->FormValue;
		$this->transmit_date_in_sub1->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub1->CurrentValue, 0);
		$this->submit_no_sub2->CurrentValue = $this->submit_no_sub2->FormValue;
		$this->revision_no_sub2->CurrentValue = $this->revision_no_sub2->FormValue;
		$this->direction_out_sub2->CurrentValue = $this->direction_out_sub2->FormValue;
		$this->planned_date_out_sub2->CurrentValue = $this->planned_date_out_sub2->FormValue;
		$this->planned_date_out_sub2->CurrentValue = UnFormatDateTime($this->planned_date_out_sub2->CurrentValue, 0);
		$this->transmit_date_out_sub2->CurrentValue = $this->transmit_date_out_sub2->FormValue;
		$this->transmit_date_out_sub2->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub2->CurrentValue, 0);
		$this->transmit_no_out_sub2->CurrentValue = $this->transmit_no_out_sub2->FormValue;
		$this->approval_status_out_sub2->CurrentValue = $this->approval_status_out_sub2->FormValue;
		$this->direction_in_sub2->CurrentValue = $this->direction_in_sub2->FormValue;
		$this->transmit_no_in_sub2->CurrentValue = $this->transmit_no_in_sub2->FormValue;
		$this->approval_status_in_sub2->CurrentValue = $this->approval_status_in_sub2->FormValue;
		$this->transmit_date_in_sub2->CurrentValue = $this->transmit_date_in_sub2->FormValue;
		$this->transmit_date_in_sub2->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub2->CurrentValue, 0);
		$this->submit_no_sub3->CurrentValue = $this->submit_no_sub3->FormValue;
		$this->revision_no_sub3->CurrentValue = $this->revision_no_sub3->FormValue;
		$this->direction_out_sub3->CurrentValue = $this->direction_out_sub3->FormValue;
		$this->planned_date_out_sub3->CurrentValue = $this->planned_date_out_sub3->FormValue;
		$this->planned_date_out_sub3->CurrentValue = UnFormatDateTime($this->planned_date_out_sub3->CurrentValue, 0);
		$this->transmit_date_out_sub3->CurrentValue = $this->transmit_date_out_sub3->FormValue;
		$this->transmit_date_out_sub3->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub3->CurrentValue, 0);
		$this->transmit_no_out_sub3->CurrentValue = $this->transmit_no_out_sub3->FormValue;
		$this->approval_status_out_sub3->CurrentValue = $this->approval_status_out_sub3->FormValue;
		$this->direction_in_sub3->CurrentValue = $this->direction_in_sub3->FormValue;
		$this->transmit_no_in_sub3->CurrentValue = $this->transmit_no_in_sub3->FormValue;
		$this->approval_status_in_sub3->CurrentValue = $this->approval_status_in_sub3->FormValue;
		$this->transmit_date_in_sub3->CurrentValue = $this->transmit_date_in_sub3->FormValue;
		$this->transmit_date_in_sub3->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub3->CurrentValue, 0);
		$this->submit_no_sub4->CurrentValue = $this->submit_no_sub4->FormValue;
		$this->revision_no_sub4->CurrentValue = $this->revision_no_sub4->FormValue;
		$this->direction_out_sub4->CurrentValue = $this->direction_out_sub4->FormValue;
		$this->planned_date_out_sub4->CurrentValue = $this->planned_date_out_sub4->FormValue;
		$this->planned_date_out_sub4->CurrentValue = UnFormatDateTime($this->planned_date_out_sub4->CurrentValue, 0);
		$this->transmit_date_out_sub4->CurrentValue = $this->transmit_date_out_sub4->FormValue;
		$this->transmit_date_out_sub4->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub4->CurrentValue, 0);
		$this->transmit_no_out_sub4->CurrentValue = $this->transmit_no_out_sub4->FormValue;
		$this->approval_status_out_sub4->CurrentValue = $this->approval_status_out_sub4->FormValue;
		$this->direction_in_sub4->CurrentValue = $this->direction_in_sub4->FormValue;
		$this->transmit_no_in_sub4->CurrentValue = $this->transmit_no_in_sub4->FormValue;
		$this->approval_status_in_sub4->CurrentValue = $this->approval_status_in_sub4->FormValue;
		$this->direction_in_file_sub4->CurrentValue = $this->direction_in_file_sub4->FormValue;
		$this->transmit_date_in_sub4->CurrentValue = $this->transmit_date_in_sub4->FormValue;
		$this->transmit_date_in_sub4->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub4->CurrentValue, 0);
		$this->submit_no_sub5->CurrentValue = $this->submit_no_sub5->FormValue;
		$this->revision_no_sub5->CurrentValue = $this->revision_no_sub5->FormValue;
		$this->direction_out_sub5->CurrentValue = $this->direction_out_sub5->FormValue;
		$this->planned_date_out_sub5->CurrentValue = $this->planned_date_out_sub5->FormValue;
		$this->planned_date_out_sub5->CurrentValue = UnFormatDateTime($this->planned_date_out_sub5->CurrentValue, 0);
		$this->transmit_date_out_sub5->CurrentValue = $this->transmit_date_out_sub5->FormValue;
		$this->transmit_date_out_sub5->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub5->CurrentValue, 0);
		$this->transmit_no_out_sub5->CurrentValue = $this->transmit_no_out_sub5->FormValue;
		$this->approval_status_out_sub5->CurrentValue = $this->approval_status_out_sub5->FormValue;
		$this->direction_in_sub5->CurrentValue = $this->direction_in_sub5->FormValue;
		$this->transmit_no_in_sub5->CurrentValue = $this->transmit_no_in_sub5->FormValue;
		$this->approval_status_in_sub5->CurrentValue = $this->approval_status_in_sub5->FormValue;
		$this->direction_in_file_sub5->CurrentValue = $this->direction_in_file_sub5->FormValue;
		$this->transmit_date_in_sub5->CurrentValue = $this->transmit_date_in_sub5->FormValue;
		$this->transmit_date_in_sub5->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub5->CurrentValue, 0);
		$this->submit_no_sub6->CurrentValue = $this->submit_no_sub6->FormValue;
		$this->revision_no_sub6->CurrentValue = $this->revision_no_sub6->FormValue;
		$this->direction_out_sub6->CurrentValue = $this->direction_out_sub6->FormValue;
		$this->planned_date_out_sub6->CurrentValue = $this->planned_date_out_sub6->FormValue;
		$this->planned_date_out_sub6->CurrentValue = UnFormatDateTime($this->planned_date_out_sub6->CurrentValue, 0);
		$this->transmit_date_out_sub6->CurrentValue = $this->transmit_date_out_sub6->FormValue;
		$this->transmit_date_out_sub6->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub6->CurrentValue, 0);
		$this->transmit_no_out_sub6->CurrentValue = $this->transmit_no_out_sub6->FormValue;
		$this->approval_status_out_sub6->CurrentValue = $this->approval_status_out_sub6->FormValue;
		$this->direction_in_sub6->CurrentValue = $this->direction_in_sub6->FormValue;
		$this->transmit_no_in_sub6->CurrentValue = $this->transmit_no_in_sub6->FormValue;
		$this->approval_status_in_sub6->CurrentValue = $this->approval_status_in_sub6->FormValue;
		$this->direction_in_file_sub6->CurrentValue = $this->direction_in_file_sub6->FormValue;
		$this->transmit_date_in_sub6->CurrentValue = $this->transmit_date_in_sub6->FormValue;
		$this->transmit_date_in_sub6->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub6->CurrentValue, 0);
		$this->submit_no_sub7->CurrentValue = $this->submit_no_sub7->FormValue;
		$this->revision_no_sub7->CurrentValue = $this->revision_no_sub7->FormValue;
		$this->direction_out_sub7->CurrentValue = $this->direction_out_sub7->FormValue;
		$this->planned_date_out_sub7->CurrentValue = $this->planned_date_out_sub7->FormValue;
		$this->planned_date_out_sub7->CurrentValue = UnFormatDateTime($this->planned_date_out_sub7->CurrentValue, 0);
		$this->transmit_date_out_sub7->CurrentValue = $this->transmit_date_out_sub7->FormValue;
		$this->transmit_date_out_sub7->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub7->CurrentValue, 0);
		$this->transmit_no_out_sub7->CurrentValue = $this->transmit_no_out_sub7->FormValue;
		$this->approval_status_out_sub7->CurrentValue = $this->approval_status_out_sub7->FormValue;
		$this->direction_in_sub7->CurrentValue = $this->direction_in_sub7->FormValue;
		$this->transmit_no_in_sub7->CurrentValue = $this->transmit_no_in_sub7->FormValue;
		$this->approval_status_in_sub7->CurrentValue = $this->approval_status_in_sub7->FormValue;
		$this->transmit_date_in_sub7->CurrentValue = $this->transmit_date_in_sub7->FormValue;
		$this->transmit_date_in_sub7->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub7->CurrentValue, 0);
		$this->submit_no_sub8->CurrentValue = $this->submit_no_sub8->FormValue;
		$this->revision_no_sub8->CurrentValue = $this->revision_no_sub8->FormValue;
		$this->direction_out_sub8->CurrentValue = $this->direction_out_sub8->FormValue;
		$this->planned_date_out_sub8->CurrentValue = $this->planned_date_out_sub8->FormValue;
		$this->planned_date_out_sub8->CurrentValue = UnFormatDateTime($this->planned_date_out_sub8->CurrentValue, 0);
		$this->transmit_date_out_sub8->CurrentValue = $this->transmit_date_out_sub8->FormValue;
		$this->transmit_date_out_sub8->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub8->CurrentValue, 0);
		$this->transmit_no_out_sub8->CurrentValue = $this->transmit_no_out_sub8->FormValue;
		$this->approval_status_out_sub8->CurrentValue = $this->approval_status_out_sub8->FormValue;
		$this->direction_out_file_sub8->CurrentValue = $this->direction_out_file_sub8->FormValue;
		$this->direction_in_sub8->CurrentValue = $this->direction_in_sub8->FormValue;
		$this->transmit_no_in_sub8->CurrentValue = $this->transmit_no_in_sub8->FormValue;
		$this->approval_status_in_sub8->CurrentValue = $this->approval_status_in_sub8->FormValue;
		$this->transmit_date_in_sub8->CurrentValue = $this->transmit_date_in_sub8->FormValue;
		$this->transmit_date_in_sub8->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub8->CurrentValue, 0);
		$this->submit_no_sub9->CurrentValue = $this->submit_no_sub9->FormValue;
		$this->revision_no_sub9->CurrentValue = $this->revision_no_sub9->FormValue;
		$this->direction_out_sub9->CurrentValue = $this->direction_out_sub9->FormValue;
		$this->planned_date_out_sub9->CurrentValue = $this->planned_date_out_sub9->FormValue;
		$this->planned_date_out_sub9->CurrentValue = UnFormatDateTime($this->planned_date_out_sub9->CurrentValue, 0);
		$this->transmit_date_out_sub9->CurrentValue = $this->transmit_date_out_sub9->FormValue;
		$this->transmit_date_out_sub9->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub9->CurrentValue, 0);
		$this->transmit_no_out_sub9->CurrentValue = $this->transmit_no_out_sub9->FormValue;
		$this->approval_status_out_sub9->CurrentValue = $this->approval_status_out_sub9->FormValue;
		$this->direction_in_sub9->CurrentValue = $this->direction_in_sub9->FormValue;
		$this->transmit_no_in_sub9->CurrentValue = $this->transmit_no_in_sub9->FormValue;
		$this->approval_status_in_sub9->CurrentValue = $this->approval_status_in_sub9->FormValue;
		$this->transmit_date_in_sub9->CurrentValue = $this->transmit_date_in_sub9->FormValue;
		$this->transmit_date_in_sub9->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub9->CurrentValue, 0);
		$this->submit_no_sub10->CurrentValue = $this->submit_no_sub10->FormValue;
		$this->revision_no_sub10->CurrentValue = $this->revision_no_sub10->FormValue;
		$this->direction_out_sub10->CurrentValue = $this->direction_out_sub10->FormValue;
		$this->planned_date_out_sub10->CurrentValue = $this->planned_date_out_sub10->FormValue;
		$this->planned_date_out_sub10->CurrentValue = UnFormatDateTime($this->planned_date_out_sub10->CurrentValue, 0);
		$this->transmit_date_out_sub10->CurrentValue = $this->transmit_date_out_sub10->FormValue;
		$this->transmit_date_out_sub10->CurrentValue = UnFormatDateTime($this->transmit_date_out_sub10->CurrentValue, 0);
		$this->transmit_no_out_sub10->CurrentValue = $this->transmit_no_out_sub10->FormValue;
		$this->approval_status_out_sub10->CurrentValue = $this->approval_status_out_sub10->FormValue;
		$this->direction_in_sub10->CurrentValue = $this->direction_in_sub10->FormValue;
		$this->transmit_no_in_sub10->CurrentValue = $this->transmit_no_in_sub10->FormValue;
		$this->approval_status_in_sub10->CurrentValue = $this->approval_status_in_sub10->FormValue;
		$this->transmit_date_in_sub10->CurrentValue = $this->transmit_date_in_sub10->FormValue;
		$this->transmit_date_in_sub10->CurrentValue = UnFormatDateTime($this->transmit_date_in_sub10->CurrentValue, 0);
		$this->log_updatedon->CurrentValue = $this->log_updatedon->FormValue;
		$this->log_updatedon->CurrentValue = UnFormatDateTime($this->log_updatedon->CurrentValue, 0);
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
		$this->project_name->setDbValue($row['project_name']);
		$this->document_tittle->setDbValue($row['document_tittle']);
		$this->current_status->setDbValue($row['current_status']);
		$this->current_status_file->setDbValue($row['current_status_file']);
		$this->submit_no_sub1->setDbValue($row['submit_no_sub1']);
		$this->revision_no_sub1->setDbValue($row['revision_no_sub1']);
		$this->direction_out_sub1->setDbValue($row['direction_out_sub1']);
		$this->planned_date_out_sub1->setDbValue($row['planned_date_out_sub1']);
		$this->transmit_date_out_sub1->setDbValue($row['transmit_date_out_sub1']);
		$this->transmit_no_out_sub1->setDbValue($row['transmit_no_out_sub1']);
		$this->approval_status_out_sub1->setDbValue($row['approval_status_out_sub1']);
		$this->direction_out_file_sub1->setDbValue($row['direction_out_file_sub1']);
		$this->direction_in_sub1->setDbValue($row['direction_in_sub1']);
		$this->transmit_no_in_sub1->setDbValue($row['transmit_no_in_sub1']);
		$this->approval_status_in_sub1->setDbValue($row['approval_status_in_sub1']);
		$this->direction_in_file_sub1->setDbValue($row['direction_in_file_sub1']);
		$this->transmit_date_in_sub1->setDbValue($row['transmit_date_in_sub1']);
		$this->submit_no_sub2->setDbValue($row['submit_no_sub2']);
		$this->revision_no_sub2->setDbValue($row['revision_no_sub2']);
		$this->direction_out_sub2->setDbValue($row['direction_out_sub2']);
		$this->planned_date_out_sub2->setDbValue($row['planned_date_out_sub2']);
		$this->transmit_date_out_sub2->setDbValue($row['transmit_date_out_sub2']);
		$this->transmit_no_out_sub2->setDbValue($row['transmit_no_out_sub2']);
		$this->approval_status_out_sub2->setDbValue($row['approval_status_out_sub2']);
		$this->direction_out_file_sub2->setDbValue($row['direction_out_file_sub2']);
		$this->direction_in_sub2->setDbValue($row['direction_in_sub2']);
		$this->transmit_no_in_sub2->setDbValue($row['transmit_no_in_sub2']);
		$this->approval_status_in_sub2->setDbValue($row['approval_status_in_sub2']);
		$this->direction_in_file_sub2->setDbValue($row['direction_in_file_sub2']);
		$this->transmit_date_in_sub2->setDbValue($row['transmit_date_in_sub2']);
		$this->submit_no_sub3->setDbValue($row['submit_no_sub3']);
		$this->revision_no_sub3->setDbValue($row['revision_no_sub3']);
		$this->direction_out_sub3->setDbValue($row['direction_out_sub3']);
		$this->planned_date_out_sub3->setDbValue($row['planned_date_out_sub3']);
		$this->transmit_date_out_sub3->setDbValue($row['transmit_date_out_sub3']);
		$this->transmit_no_out_sub3->setDbValue($row['transmit_no_out_sub3']);
		$this->approval_status_out_sub3->setDbValue($row['approval_status_out_sub3']);
		$this->direction_out_file_sub3->setDbValue($row['direction_out_file_sub3']);
		$this->direction_in_sub3->setDbValue($row['direction_in_sub3']);
		$this->transmit_no_in_sub3->setDbValue($row['transmit_no_in_sub3']);
		$this->approval_status_in_sub3->setDbValue($row['approval_status_in_sub3']);
		$this->direction_in_file_sub3->setDbValue($row['direction_in_file_sub3']);
		$this->transmit_date_in_sub3->setDbValue($row['transmit_date_in_sub3']);
		$this->submit_no_sub4->setDbValue($row['submit_no_sub4']);
		$this->revision_no_sub4->setDbValue($row['revision_no_sub4']);
		$this->direction_out_sub4->setDbValue($row['direction_out_sub4']);
		$this->planned_date_out_sub4->setDbValue($row['planned_date_out_sub4']);
		$this->transmit_date_out_sub4->setDbValue($row['transmit_date_out_sub4']);
		$this->transmit_no_out_sub4->setDbValue($row['transmit_no_out_sub4']);
		$this->approval_status_out_sub4->setDbValue($row['approval_status_out_sub4']);
		$this->direction_out_file_sub4->setDbValue($row['direction_out_file_sub4']);
		$this->direction_in_sub4->setDbValue($row['direction_in_sub4']);
		$this->transmit_no_in_sub4->setDbValue($row['transmit_no_in_sub4']);
		$this->approval_status_in_sub4->setDbValue($row['approval_status_in_sub4']);
		$this->direction_in_file_sub4->setDbValue($row['direction_in_file_sub4']);
		$this->transmit_date_in_sub4->setDbValue($row['transmit_date_in_sub4']);
		$this->submit_no_sub5->setDbValue($row['submit_no_sub5']);
		$this->revision_no_sub5->setDbValue($row['revision_no_sub5']);
		$this->direction_out_sub5->setDbValue($row['direction_out_sub5']);
		$this->planned_date_out_sub5->setDbValue($row['planned_date_out_sub5']);
		$this->transmit_date_out_sub5->setDbValue($row['transmit_date_out_sub5']);
		$this->transmit_no_out_sub5->setDbValue($row['transmit_no_out_sub5']);
		$this->approval_status_out_sub5->setDbValue($row['approval_status_out_sub5']);
		$this->direction_out_file_sub5->setDbValue($row['direction_out_file_sub5']);
		$this->direction_in_sub5->setDbValue($row['direction_in_sub5']);
		$this->transmit_no_in_sub5->setDbValue($row['transmit_no_in_sub5']);
		$this->approval_status_in_sub5->setDbValue($row['approval_status_in_sub5']);
		$this->direction_in_file_sub5->setDbValue($row['direction_in_file_sub5']);
		$this->transmit_date_in_sub5->setDbValue($row['transmit_date_in_sub5']);
		$this->submit_no_sub6->setDbValue($row['submit_no_sub6']);
		$this->revision_no_sub6->setDbValue($row['revision_no_sub6']);
		$this->direction_out_sub6->setDbValue($row['direction_out_sub6']);
		$this->planned_date_out_sub6->setDbValue($row['planned_date_out_sub6']);
		$this->transmit_date_out_sub6->setDbValue($row['transmit_date_out_sub6']);
		$this->transmit_no_out_sub6->setDbValue($row['transmit_no_out_sub6']);
		$this->approval_status_out_sub6->setDbValue($row['approval_status_out_sub6']);
		$this->direction_out_file_sub6->setDbValue($row['direction_out_file_sub6']);
		$this->direction_in_sub6->setDbValue($row['direction_in_sub6']);
		$this->transmit_no_in_sub6->setDbValue($row['transmit_no_in_sub6']);
		$this->approval_status_in_sub6->setDbValue($row['approval_status_in_sub6']);
		$this->direction_in_file_sub6->setDbValue($row['direction_in_file_sub6']);
		$this->transmit_date_in_sub6->setDbValue($row['transmit_date_in_sub6']);
		$this->submit_no_sub7->setDbValue($row['submit_no_sub7']);
		$this->revision_no_sub7->setDbValue($row['revision_no_sub7']);
		$this->direction_out_sub7->setDbValue($row['direction_out_sub7']);
		$this->planned_date_out_sub7->setDbValue($row['planned_date_out_sub7']);
		$this->transmit_date_out_sub7->setDbValue($row['transmit_date_out_sub7']);
		$this->transmit_no_out_sub7->setDbValue($row['transmit_no_out_sub7']);
		$this->approval_status_out_sub7->setDbValue($row['approval_status_out_sub7']);
		$this->direction_out_file_sub7->setDbValue($row['direction_out_file_sub7']);
		$this->direction_in_sub7->setDbValue($row['direction_in_sub7']);
		$this->transmit_no_in_sub7->setDbValue($row['transmit_no_in_sub7']);
		$this->approval_status_in_sub7->setDbValue($row['approval_status_in_sub7']);
		$this->direction_in_file_sub7->setDbValue($row['direction_in_file_sub7']);
		$this->transmit_date_in_sub7->setDbValue($row['transmit_date_in_sub7']);
		$this->submit_no_sub8->setDbValue($row['submit_no_sub8']);
		$this->revision_no_sub8->setDbValue($row['revision_no_sub8']);
		$this->direction_out_sub8->setDbValue($row['direction_out_sub8']);
		$this->planned_date_out_sub8->setDbValue($row['planned_date_out_sub8']);
		$this->transmit_date_out_sub8->setDbValue($row['transmit_date_out_sub8']);
		$this->transmit_no_out_sub8->setDbValue($row['transmit_no_out_sub8']);
		$this->approval_status_out_sub8->setDbValue($row['approval_status_out_sub8']);
		$this->direction_out_file_sub8->setDbValue($row['direction_out_file_sub8']);
		$this->direction_in_sub8->setDbValue($row['direction_in_sub8']);
		$this->transmit_no_in_sub8->setDbValue($row['transmit_no_in_sub8']);
		$this->approval_status_in_sub8->setDbValue($row['approval_status_in_sub8']);
		$this->direction_in_file_sub8->setDbValue($row['direction_in_file_sub8']);
		$this->transmit_date_in_sub8->setDbValue($row['transmit_date_in_sub8']);
		$this->submit_no_sub9->setDbValue($row['submit_no_sub9']);
		$this->revision_no_sub9->setDbValue($row['revision_no_sub9']);
		$this->direction_out_sub9->setDbValue($row['direction_out_sub9']);
		$this->planned_date_out_sub9->setDbValue($row['planned_date_out_sub9']);
		$this->transmit_date_out_sub9->setDbValue($row['transmit_date_out_sub9']);
		$this->transmit_no_out_sub9->setDbValue($row['transmit_no_out_sub9']);
		$this->approval_status_out_sub9->setDbValue($row['approval_status_out_sub9']);
		$this->direction_out_file_sub9->setDbValue($row['direction_out_file_sub9']);
		$this->direction_in_sub9->setDbValue($row['direction_in_sub9']);
		$this->transmit_no_in_sub9->setDbValue($row['transmit_no_in_sub9']);
		$this->approval_status_in_sub9->setDbValue($row['approval_status_in_sub9']);
		$this->direction_in_file_sub9->setDbValue($row['direction_in_file_sub9']);
		$this->transmit_date_in_sub9->setDbValue($row['transmit_date_in_sub9']);
		$this->submit_no_sub10->setDbValue($row['submit_no_sub10']);
		$this->revision_no_sub10->setDbValue($row['revision_no_sub10']);
		$this->direction_out_sub10->setDbValue($row['direction_out_sub10']);
		$this->planned_date_out_sub10->setDbValue($row['planned_date_out_sub10']);
		$this->transmit_date_out_sub10->setDbValue($row['transmit_date_out_sub10']);
		$this->transmit_no_out_sub10->setDbValue($row['transmit_no_out_sub10']);
		$this->approval_status_out_sub10->setDbValue($row['approval_status_out_sub10']);
		$this->direction_out_file_sub10->setDbValue($row['direction_out_file_sub10']);
		$this->direction_in_sub10->setDbValue($row['direction_in_sub10']);
		$this->transmit_no_in_sub10->setDbValue($row['transmit_no_in_sub10']);
		$this->approval_status_in_sub10->setDbValue($row['approval_status_in_sub10']);
		$this->direction_in_file_sub10->setDbValue($row['direction_in_file_sub10']);
		$this->transmit_date_in_sub10->setDbValue($row['transmit_date_in_sub10']);
		$this->log_updatedon->setDbValue($row['log_updatedon']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['log_id'] = NULL;
		$row['firelink_doc_no'] = NULL;
		$row['project_name'] = NULL;
		$row['document_tittle'] = NULL;
		$row['current_status'] = NULL;
		$row['current_status_file'] = NULL;
		$row['submit_no_sub1'] = NULL;
		$row['revision_no_sub1'] = NULL;
		$row['direction_out_sub1'] = NULL;
		$row['planned_date_out_sub1'] = NULL;
		$row['transmit_date_out_sub1'] = NULL;
		$row['transmit_no_out_sub1'] = NULL;
		$row['approval_status_out_sub1'] = NULL;
		$row['direction_out_file_sub1'] = NULL;
		$row['direction_in_sub1'] = NULL;
		$row['transmit_no_in_sub1'] = NULL;
		$row['approval_status_in_sub1'] = NULL;
		$row['direction_in_file_sub1'] = NULL;
		$row['transmit_date_in_sub1'] = NULL;
		$row['submit_no_sub2'] = NULL;
		$row['revision_no_sub2'] = NULL;
		$row['direction_out_sub2'] = NULL;
		$row['planned_date_out_sub2'] = NULL;
		$row['transmit_date_out_sub2'] = NULL;
		$row['transmit_no_out_sub2'] = NULL;
		$row['approval_status_out_sub2'] = NULL;
		$row['direction_out_file_sub2'] = NULL;
		$row['direction_in_sub2'] = NULL;
		$row['transmit_no_in_sub2'] = NULL;
		$row['approval_status_in_sub2'] = NULL;
		$row['direction_in_file_sub2'] = NULL;
		$row['transmit_date_in_sub2'] = NULL;
		$row['submit_no_sub3'] = NULL;
		$row['revision_no_sub3'] = NULL;
		$row['direction_out_sub3'] = NULL;
		$row['planned_date_out_sub3'] = NULL;
		$row['transmit_date_out_sub3'] = NULL;
		$row['transmit_no_out_sub3'] = NULL;
		$row['approval_status_out_sub3'] = NULL;
		$row['direction_out_file_sub3'] = NULL;
		$row['direction_in_sub3'] = NULL;
		$row['transmit_no_in_sub3'] = NULL;
		$row['approval_status_in_sub3'] = NULL;
		$row['direction_in_file_sub3'] = NULL;
		$row['transmit_date_in_sub3'] = NULL;
		$row['submit_no_sub4'] = NULL;
		$row['revision_no_sub4'] = NULL;
		$row['direction_out_sub4'] = NULL;
		$row['planned_date_out_sub4'] = NULL;
		$row['transmit_date_out_sub4'] = NULL;
		$row['transmit_no_out_sub4'] = NULL;
		$row['approval_status_out_sub4'] = NULL;
		$row['direction_out_file_sub4'] = NULL;
		$row['direction_in_sub4'] = NULL;
		$row['transmit_no_in_sub4'] = NULL;
		$row['approval_status_in_sub4'] = NULL;
		$row['direction_in_file_sub4'] = NULL;
		$row['transmit_date_in_sub4'] = NULL;
		$row['submit_no_sub5'] = NULL;
		$row['revision_no_sub5'] = NULL;
		$row['direction_out_sub5'] = NULL;
		$row['planned_date_out_sub5'] = NULL;
		$row['transmit_date_out_sub5'] = NULL;
		$row['transmit_no_out_sub5'] = NULL;
		$row['approval_status_out_sub5'] = NULL;
		$row['direction_out_file_sub5'] = NULL;
		$row['direction_in_sub5'] = NULL;
		$row['transmit_no_in_sub5'] = NULL;
		$row['approval_status_in_sub5'] = NULL;
		$row['direction_in_file_sub5'] = NULL;
		$row['transmit_date_in_sub5'] = NULL;
		$row['submit_no_sub6'] = NULL;
		$row['revision_no_sub6'] = NULL;
		$row['direction_out_sub6'] = NULL;
		$row['planned_date_out_sub6'] = NULL;
		$row['transmit_date_out_sub6'] = NULL;
		$row['transmit_no_out_sub6'] = NULL;
		$row['approval_status_out_sub6'] = NULL;
		$row['direction_out_file_sub6'] = NULL;
		$row['direction_in_sub6'] = NULL;
		$row['transmit_no_in_sub6'] = NULL;
		$row['approval_status_in_sub6'] = NULL;
		$row['direction_in_file_sub6'] = NULL;
		$row['transmit_date_in_sub6'] = NULL;
		$row['submit_no_sub7'] = NULL;
		$row['revision_no_sub7'] = NULL;
		$row['direction_out_sub7'] = NULL;
		$row['planned_date_out_sub7'] = NULL;
		$row['transmit_date_out_sub7'] = NULL;
		$row['transmit_no_out_sub7'] = NULL;
		$row['approval_status_out_sub7'] = NULL;
		$row['direction_out_file_sub7'] = NULL;
		$row['direction_in_sub7'] = NULL;
		$row['transmit_no_in_sub7'] = NULL;
		$row['approval_status_in_sub7'] = NULL;
		$row['direction_in_file_sub7'] = NULL;
		$row['transmit_date_in_sub7'] = NULL;
		$row['submit_no_sub8'] = NULL;
		$row['revision_no_sub8'] = NULL;
		$row['direction_out_sub8'] = NULL;
		$row['planned_date_out_sub8'] = NULL;
		$row['transmit_date_out_sub8'] = NULL;
		$row['transmit_no_out_sub8'] = NULL;
		$row['approval_status_out_sub8'] = NULL;
		$row['direction_out_file_sub8'] = NULL;
		$row['direction_in_sub8'] = NULL;
		$row['transmit_no_in_sub8'] = NULL;
		$row['approval_status_in_sub8'] = NULL;
		$row['direction_in_file_sub8'] = NULL;
		$row['transmit_date_in_sub8'] = NULL;
		$row['submit_no_sub9'] = NULL;
		$row['revision_no_sub9'] = NULL;
		$row['direction_out_sub9'] = NULL;
		$row['planned_date_out_sub9'] = NULL;
		$row['transmit_date_out_sub9'] = NULL;
		$row['transmit_no_out_sub9'] = NULL;
		$row['approval_status_out_sub9'] = NULL;
		$row['direction_out_file_sub9'] = NULL;
		$row['direction_in_sub9'] = NULL;
		$row['transmit_no_in_sub9'] = NULL;
		$row['approval_status_in_sub9'] = NULL;
		$row['direction_in_file_sub9'] = NULL;
		$row['transmit_date_in_sub9'] = NULL;
		$row['submit_no_sub10'] = NULL;
		$row['revision_no_sub10'] = NULL;
		$row['direction_out_sub10'] = NULL;
		$row['planned_date_out_sub10'] = NULL;
		$row['transmit_date_out_sub10'] = NULL;
		$row['transmit_no_out_sub10'] = NULL;
		$row['approval_status_out_sub10'] = NULL;
		$row['direction_out_file_sub10'] = NULL;
		$row['direction_in_sub10'] = NULL;
		$row['transmit_no_in_sub10'] = NULL;
		$row['approval_status_in_sub10'] = NULL;
		$row['direction_in_file_sub10'] = NULL;
		$row['transmit_date_in_sub10'] = NULL;
		$row['log_updatedon'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("log_id")) <> "")
			$this->log_id->CurrentValue = $this->getKey("log_id"); // log_id
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
		// log_id
		// firelink_doc_no
		// project_name
		// document_tittle
		// current_status
		// current_status_file
		// submit_no_sub1
		// revision_no_sub1
		// direction_out_sub1
		// planned_date_out_sub1
		// transmit_date_out_sub1
		// transmit_no_out_sub1
		// approval_status_out_sub1
		// direction_out_file_sub1
		// direction_in_sub1
		// transmit_no_in_sub1
		// approval_status_in_sub1
		// direction_in_file_sub1
		// transmit_date_in_sub1
		// submit_no_sub2
		// revision_no_sub2
		// direction_out_sub2
		// planned_date_out_sub2
		// transmit_date_out_sub2
		// transmit_no_out_sub2
		// approval_status_out_sub2
		// direction_out_file_sub2
		// direction_in_sub2
		// transmit_no_in_sub2
		// approval_status_in_sub2
		// direction_in_file_sub2
		// transmit_date_in_sub2
		// submit_no_sub3
		// revision_no_sub3
		// direction_out_sub3
		// planned_date_out_sub3
		// transmit_date_out_sub3
		// transmit_no_out_sub3
		// approval_status_out_sub3
		// direction_out_file_sub3
		// direction_in_sub3
		// transmit_no_in_sub3
		// approval_status_in_sub3
		// direction_in_file_sub3
		// transmit_date_in_sub3
		// submit_no_sub4
		// revision_no_sub4
		// direction_out_sub4
		// planned_date_out_sub4
		// transmit_date_out_sub4
		// transmit_no_out_sub4
		// approval_status_out_sub4
		// direction_out_file_sub4
		// direction_in_sub4
		// transmit_no_in_sub4
		// approval_status_in_sub4
		// direction_in_file_sub4
		// transmit_date_in_sub4
		// submit_no_sub5
		// revision_no_sub5
		// direction_out_sub5
		// planned_date_out_sub5
		// transmit_date_out_sub5
		// transmit_no_out_sub5
		// approval_status_out_sub5
		// direction_out_file_sub5
		// direction_in_sub5
		// transmit_no_in_sub5
		// approval_status_in_sub5
		// direction_in_file_sub5
		// transmit_date_in_sub5
		// submit_no_sub6
		// revision_no_sub6
		// direction_out_sub6
		// planned_date_out_sub6
		// transmit_date_out_sub6
		// transmit_no_out_sub6
		// approval_status_out_sub6
		// direction_out_file_sub6
		// direction_in_sub6
		// transmit_no_in_sub6
		// approval_status_in_sub6
		// direction_in_file_sub6
		// transmit_date_in_sub6
		// submit_no_sub7
		// revision_no_sub7
		// direction_out_sub7
		// planned_date_out_sub7
		// transmit_date_out_sub7
		// transmit_no_out_sub7
		// approval_status_out_sub7
		// direction_out_file_sub7
		// direction_in_sub7
		// transmit_no_in_sub7
		// approval_status_in_sub7
		// direction_in_file_sub7
		// transmit_date_in_sub7
		// submit_no_sub8
		// revision_no_sub8
		// direction_out_sub8
		// planned_date_out_sub8
		// transmit_date_out_sub8
		// transmit_no_out_sub8
		// approval_status_out_sub8
		// direction_out_file_sub8
		// direction_in_sub8
		// transmit_no_in_sub8
		// approval_status_in_sub8
		// direction_in_file_sub8
		// transmit_date_in_sub8
		// submit_no_sub9
		// revision_no_sub9
		// direction_out_sub9
		// planned_date_out_sub9
		// transmit_date_out_sub9
		// transmit_no_out_sub9
		// approval_status_out_sub9
		// direction_out_file_sub9
		// direction_in_sub9
		// transmit_no_in_sub9
		// approval_status_in_sub9
		// direction_in_file_sub9
		// transmit_date_in_sub9
		// submit_no_sub10
		// revision_no_sub10
		// direction_out_sub10
		// planned_date_out_sub10
		// transmit_date_out_sub10
		// transmit_no_out_sub10
		// approval_status_out_sub10
		// direction_out_file_sub10
		// direction_in_sub10
		// transmit_no_in_sub10
		// approval_status_in_sub10
		// direction_in_file_sub10
		// transmit_date_in_sub10
		// log_updatedon

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// log_id
			$this->log_id->ViewValue = $this->log_id->CurrentValue;
			$this->log_id->ViewCustomAttributes = "";

			// firelink_doc_no
			$this->firelink_doc_no->ViewValue = $this->firelink_doc_no->CurrentValue;
			$this->firelink_doc_no->ViewCustomAttributes = "";

			// project_name
			$this->project_name->ViewValue = $this->project_name->CurrentValue;
			$this->project_name->ViewCustomAttributes = "";

			// document_tittle
			$this->document_tittle->ViewValue = $this->document_tittle->CurrentValue;
			$this->document_tittle->ViewCustomAttributes = "";

			// current_status
			$this->current_status->ViewValue = $this->current_status->CurrentValue;
			$this->current_status->ViewCustomAttributes = "";

			// submit_no_sub1
			$this->submit_no_sub1->ViewValue = $this->submit_no_sub1->CurrentValue;
			$this->submit_no_sub1->ViewCustomAttributes = "";

			// revision_no_sub1
			$this->revision_no_sub1->ViewValue = $this->revision_no_sub1->CurrentValue;
			$this->revision_no_sub1->ViewCustomAttributes = "";

			// direction_out_sub1
			$this->direction_out_sub1->ViewValue = $this->direction_out_sub1->CurrentValue;
			$this->direction_out_sub1->ViewCustomAttributes = "";

			// planned_date_out_sub1
			$this->planned_date_out_sub1->ViewValue = $this->planned_date_out_sub1->CurrentValue;
			$this->planned_date_out_sub1->ViewValue = FormatDateTime($this->planned_date_out_sub1->ViewValue, 0);
			$this->planned_date_out_sub1->ViewCustomAttributes = "";

			// transmit_date_out_sub1
			$this->transmit_date_out_sub1->ViewValue = $this->transmit_date_out_sub1->CurrentValue;
			$this->transmit_date_out_sub1->ViewValue = FormatDateTime($this->transmit_date_out_sub1->ViewValue, 0);
			$this->transmit_date_out_sub1->ViewCustomAttributes = "";

			// transmit_no_out_sub1
			$this->transmit_no_out_sub1->ViewValue = $this->transmit_no_out_sub1->CurrentValue;
			$this->transmit_no_out_sub1->ViewCustomAttributes = "";

			// approval_status_out_sub1
			$this->approval_status_out_sub1->ViewValue = $this->approval_status_out_sub1->CurrentValue;
			$this->approval_status_out_sub1->ViewCustomAttributes = "";

			// direction_out_file_sub1
			$this->direction_out_file_sub1->ViewValue = $this->direction_out_file_sub1->CurrentValue;
			$this->direction_out_file_sub1->ViewCustomAttributes = "";

			// direction_in_sub1
			$this->direction_in_sub1->ViewValue = $this->direction_in_sub1->CurrentValue;
			$this->direction_in_sub1->ViewCustomAttributes = "";

			// transmit_no_in_sub1
			$this->transmit_no_in_sub1->ViewValue = $this->transmit_no_in_sub1->CurrentValue;
			$this->transmit_no_in_sub1->ViewCustomAttributes = "";

			// approval_status_in_sub1
			$this->approval_status_in_sub1->ViewValue = $this->approval_status_in_sub1->CurrentValue;
			$this->approval_status_in_sub1->ViewCustomAttributes = "";

			// transmit_date_in_sub1
			$this->transmit_date_in_sub1->ViewValue = $this->transmit_date_in_sub1->CurrentValue;
			$this->transmit_date_in_sub1->ViewValue = FormatDateTime($this->transmit_date_in_sub1->ViewValue, 0);
			$this->transmit_date_in_sub1->ViewCustomAttributes = "";

			// submit_no_sub2
			$this->submit_no_sub2->ViewValue = $this->submit_no_sub2->CurrentValue;
			$this->submit_no_sub2->ViewCustomAttributes = "";

			// revision_no_sub2
			$this->revision_no_sub2->ViewValue = $this->revision_no_sub2->CurrentValue;
			$this->revision_no_sub2->ViewCustomAttributes = "";

			// direction_out_sub2
			$this->direction_out_sub2->ViewValue = $this->direction_out_sub2->CurrentValue;
			$this->direction_out_sub2->ViewCustomAttributes = "";

			// planned_date_out_sub2
			$this->planned_date_out_sub2->ViewValue = $this->planned_date_out_sub2->CurrentValue;
			$this->planned_date_out_sub2->ViewValue = FormatDateTime($this->planned_date_out_sub2->ViewValue, 0);
			$this->planned_date_out_sub2->ViewCustomAttributes = "";

			// transmit_date_out_sub2
			$this->transmit_date_out_sub2->ViewValue = $this->transmit_date_out_sub2->CurrentValue;
			$this->transmit_date_out_sub2->ViewValue = FormatDateTime($this->transmit_date_out_sub2->ViewValue, 0);
			$this->transmit_date_out_sub2->ViewCustomAttributes = "";

			// transmit_no_out_sub2
			$this->transmit_no_out_sub2->ViewValue = $this->transmit_no_out_sub2->CurrentValue;
			$this->transmit_no_out_sub2->ViewCustomAttributes = "";

			// approval_status_out_sub2
			$this->approval_status_out_sub2->ViewValue = $this->approval_status_out_sub2->CurrentValue;
			$this->approval_status_out_sub2->ViewCustomAttributes = "";

			// direction_in_sub2
			$this->direction_in_sub2->ViewValue = $this->direction_in_sub2->CurrentValue;
			$this->direction_in_sub2->ViewCustomAttributes = "";

			// transmit_no_in_sub2
			$this->transmit_no_in_sub2->ViewValue = $this->transmit_no_in_sub2->CurrentValue;
			$this->transmit_no_in_sub2->ViewCustomAttributes = "";

			// approval_status_in_sub2
			$this->approval_status_in_sub2->ViewValue = $this->approval_status_in_sub2->CurrentValue;
			$this->approval_status_in_sub2->ViewCustomAttributes = "";

			// transmit_date_in_sub2
			$this->transmit_date_in_sub2->ViewValue = $this->transmit_date_in_sub2->CurrentValue;
			$this->transmit_date_in_sub2->ViewValue = FormatDateTime($this->transmit_date_in_sub2->ViewValue, 0);
			$this->transmit_date_in_sub2->ViewCustomAttributes = "";

			// submit_no_sub3
			$this->submit_no_sub3->ViewValue = $this->submit_no_sub3->CurrentValue;
			$this->submit_no_sub3->ViewCustomAttributes = "";

			// revision_no_sub3
			$this->revision_no_sub3->ViewValue = $this->revision_no_sub3->CurrentValue;
			$this->revision_no_sub3->ViewCustomAttributes = "";

			// direction_out_sub3
			$this->direction_out_sub3->ViewValue = $this->direction_out_sub3->CurrentValue;
			$this->direction_out_sub3->ViewCustomAttributes = "";

			// planned_date_out_sub3
			$this->planned_date_out_sub3->ViewValue = $this->planned_date_out_sub3->CurrentValue;
			$this->planned_date_out_sub3->ViewValue = FormatDateTime($this->planned_date_out_sub3->ViewValue, 0);
			$this->planned_date_out_sub3->ViewCustomAttributes = "";

			// transmit_date_out_sub3
			$this->transmit_date_out_sub3->ViewValue = $this->transmit_date_out_sub3->CurrentValue;
			$this->transmit_date_out_sub3->ViewValue = FormatDateTime($this->transmit_date_out_sub3->ViewValue, 0);
			$this->transmit_date_out_sub3->ViewCustomAttributes = "";

			// transmit_no_out_sub3
			$this->transmit_no_out_sub3->ViewValue = $this->transmit_no_out_sub3->CurrentValue;
			$this->transmit_no_out_sub3->ViewCustomAttributes = "";

			// approval_status_out_sub3
			$this->approval_status_out_sub3->ViewValue = $this->approval_status_out_sub3->CurrentValue;
			$this->approval_status_out_sub3->ViewCustomAttributes = "";

			// direction_in_sub3
			$this->direction_in_sub3->ViewValue = $this->direction_in_sub3->CurrentValue;
			$this->direction_in_sub3->ViewCustomAttributes = "";

			// transmit_no_in_sub3
			$this->transmit_no_in_sub3->ViewValue = $this->transmit_no_in_sub3->CurrentValue;
			$this->transmit_no_in_sub3->ViewCustomAttributes = "";

			// approval_status_in_sub3
			$this->approval_status_in_sub3->ViewValue = $this->approval_status_in_sub3->CurrentValue;
			$this->approval_status_in_sub3->ViewCustomAttributes = "";

			// transmit_date_in_sub3
			$this->transmit_date_in_sub3->ViewValue = $this->transmit_date_in_sub3->CurrentValue;
			$this->transmit_date_in_sub3->ViewValue = FormatDateTime($this->transmit_date_in_sub3->ViewValue, 0);
			$this->transmit_date_in_sub3->ViewCustomAttributes = "";

			// submit_no_sub4
			$this->submit_no_sub4->ViewValue = $this->submit_no_sub4->CurrentValue;
			$this->submit_no_sub4->ViewCustomAttributes = "";

			// revision_no_sub4
			$this->revision_no_sub4->ViewValue = $this->revision_no_sub4->CurrentValue;
			$this->revision_no_sub4->ViewCustomAttributes = "";

			// direction_out_sub4
			$this->direction_out_sub4->ViewValue = $this->direction_out_sub4->CurrentValue;
			$this->direction_out_sub4->ViewCustomAttributes = "";

			// planned_date_out_sub4
			$this->planned_date_out_sub4->ViewValue = $this->planned_date_out_sub4->CurrentValue;
			$this->planned_date_out_sub4->ViewValue = FormatDateTime($this->planned_date_out_sub4->ViewValue, 0);
			$this->planned_date_out_sub4->ViewCustomAttributes = "";

			// transmit_date_out_sub4
			$this->transmit_date_out_sub4->ViewValue = $this->transmit_date_out_sub4->CurrentValue;
			$this->transmit_date_out_sub4->ViewValue = FormatDateTime($this->transmit_date_out_sub4->ViewValue, 0);
			$this->transmit_date_out_sub4->ViewCustomAttributes = "";

			// transmit_no_out_sub4
			$this->transmit_no_out_sub4->ViewValue = $this->transmit_no_out_sub4->CurrentValue;
			$this->transmit_no_out_sub4->ViewCustomAttributes = "";

			// approval_status_out_sub4
			$this->approval_status_out_sub4->ViewValue = $this->approval_status_out_sub4->CurrentValue;
			$this->approval_status_out_sub4->ViewCustomAttributes = "";

			// direction_in_sub4
			$this->direction_in_sub4->ViewValue = $this->direction_in_sub4->CurrentValue;
			$this->direction_in_sub4->ViewCustomAttributes = "";

			// transmit_no_in_sub4
			$this->transmit_no_in_sub4->ViewValue = $this->transmit_no_in_sub4->CurrentValue;
			$this->transmit_no_in_sub4->ViewCustomAttributes = "";

			// approval_status_in_sub4
			$this->approval_status_in_sub4->ViewValue = $this->approval_status_in_sub4->CurrentValue;
			$this->approval_status_in_sub4->ViewCustomAttributes = "";

			// direction_in_file_sub4
			$this->direction_in_file_sub4->ViewValue = $this->direction_in_file_sub4->CurrentValue;
			$this->direction_in_file_sub4->ViewCustomAttributes = "";

			// transmit_date_in_sub4
			$this->transmit_date_in_sub4->ViewValue = $this->transmit_date_in_sub4->CurrentValue;
			$this->transmit_date_in_sub4->ViewValue = FormatDateTime($this->transmit_date_in_sub4->ViewValue, 0);
			$this->transmit_date_in_sub4->ViewCustomAttributes = "";

			// submit_no_sub5
			$this->submit_no_sub5->ViewValue = $this->submit_no_sub5->CurrentValue;
			$this->submit_no_sub5->ViewCustomAttributes = "";

			// revision_no_sub5
			$this->revision_no_sub5->ViewValue = $this->revision_no_sub5->CurrentValue;
			$this->revision_no_sub5->ViewCustomAttributes = "";

			// direction_out_sub5
			$this->direction_out_sub5->ViewValue = $this->direction_out_sub5->CurrentValue;
			$this->direction_out_sub5->ViewCustomAttributes = "";

			// planned_date_out_sub5
			$this->planned_date_out_sub5->ViewValue = $this->planned_date_out_sub5->CurrentValue;
			$this->planned_date_out_sub5->ViewValue = FormatDateTime($this->planned_date_out_sub5->ViewValue, 0);
			$this->planned_date_out_sub5->ViewCustomAttributes = "";

			// transmit_date_out_sub5
			$this->transmit_date_out_sub5->ViewValue = $this->transmit_date_out_sub5->CurrentValue;
			$this->transmit_date_out_sub5->ViewValue = FormatDateTime($this->transmit_date_out_sub5->ViewValue, 0);
			$this->transmit_date_out_sub5->ViewCustomAttributes = "";

			// transmit_no_out_sub5
			$this->transmit_no_out_sub5->ViewValue = $this->transmit_no_out_sub5->CurrentValue;
			$this->transmit_no_out_sub5->ViewCustomAttributes = "";

			// approval_status_out_sub5
			$this->approval_status_out_sub5->ViewValue = $this->approval_status_out_sub5->CurrentValue;
			$this->approval_status_out_sub5->ViewCustomAttributes = "";

			// direction_in_sub5
			$this->direction_in_sub5->ViewValue = $this->direction_in_sub5->CurrentValue;
			$this->direction_in_sub5->ViewCustomAttributes = "";

			// transmit_no_in_sub5
			$this->transmit_no_in_sub5->ViewValue = $this->transmit_no_in_sub5->CurrentValue;
			$this->transmit_no_in_sub5->ViewCustomAttributes = "";

			// approval_status_in_sub5
			$this->approval_status_in_sub5->ViewValue = $this->approval_status_in_sub5->CurrentValue;
			$this->approval_status_in_sub5->ViewCustomAttributes = "";

			// direction_in_file_sub5
			$this->direction_in_file_sub5->ViewValue = $this->direction_in_file_sub5->CurrentValue;
			$this->direction_in_file_sub5->ViewCustomAttributes = "";

			// transmit_date_in_sub5
			$this->transmit_date_in_sub5->ViewValue = $this->transmit_date_in_sub5->CurrentValue;
			$this->transmit_date_in_sub5->ViewValue = FormatDateTime($this->transmit_date_in_sub5->ViewValue, 0);
			$this->transmit_date_in_sub5->ViewCustomAttributes = "";

			// submit_no_sub6
			$this->submit_no_sub6->ViewValue = $this->submit_no_sub6->CurrentValue;
			$this->submit_no_sub6->ViewCustomAttributes = "";

			// revision_no_sub6
			$this->revision_no_sub6->ViewValue = $this->revision_no_sub6->CurrentValue;
			$this->revision_no_sub6->ViewCustomAttributes = "";

			// direction_out_sub6
			$this->direction_out_sub6->ViewValue = $this->direction_out_sub6->CurrentValue;
			$this->direction_out_sub6->ViewCustomAttributes = "";

			// planned_date_out_sub6
			$this->planned_date_out_sub6->ViewValue = $this->planned_date_out_sub6->CurrentValue;
			$this->planned_date_out_sub6->ViewValue = FormatDateTime($this->planned_date_out_sub6->ViewValue, 0);
			$this->planned_date_out_sub6->ViewCustomAttributes = "";

			// transmit_date_out_sub6
			$this->transmit_date_out_sub6->ViewValue = $this->transmit_date_out_sub6->CurrentValue;
			$this->transmit_date_out_sub6->ViewValue = FormatDateTime($this->transmit_date_out_sub6->ViewValue, 0);
			$this->transmit_date_out_sub6->ViewCustomAttributes = "";

			// transmit_no_out_sub6
			$this->transmit_no_out_sub6->ViewValue = $this->transmit_no_out_sub6->CurrentValue;
			$this->transmit_no_out_sub6->ViewCustomAttributes = "";

			// approval_status_out_sub6
			$this->approval_status_out_sub6->ViewValue = $this->approval_status_out_sub6->CurrentValue;
			$this->approval_status_out_sub6->ViewCustomAttributes = "";

			// direction_in_sub6
			$this->direction_in_sub6->ViewValue = $this->direction_in_sub6->CurrentValue;
			$this->direction_in_sub6->ViewCustomAttributes = "";

			// transmit_no_in_sub6
			$this->transmit_no_in_sub6->ViewValue = $this->transmit_no_in_sub6->CurrentValue;
			$this->transmit_no_in_sub6->ViewCustomAttributes = "";

			// approval_status_in_sub6
			$this->approval_status_in_sub6->ViewValue = $this->approval_status_in_sub6->CurrentValue;
			$this->approval_status_in_sub6->ViewCustomAttributes = "";

			// direction_in_file_sub6
			$this->direction_in_file_sub6->ViewValue = $this->direction_in_file_sub6->CurrentValue;
			$this->direction_in_file_sub6->ViewCustomAttributes = "";

			// transmit_date_in_sub6
			$this->transmit_date_in_sub6->ViewValue = $this->transmit_date_in_sub6->CurrentValue;
			$this->transmit_date_in_sub6->ViewValue = FormatDateTime($this->transmit_date_in_sub6->ViewValue, 0);
			$this->transmit_date_in_sub6->ViewCustomAttributes = "";

			// submit_no_sub7
			$this->submit_no_sub7->ViewValue = $this->submit_no_sub7->CurrentValue;
			$this->submit_no_sub7->ViewCustomAttributes = "";

			// revision_no_sub7
			$this->revision_no_sub7->ViewValue = $this->revision_no_sub7->CurrentValue;
			$this->revision_no_sub7->ViewCustomAttributes = "";

			// direction_out_sub7
			$this->direction_out_sub7->ViewValue = $this->direction_out_sub7->CurrentValue;
			$this->direction_out_sub7->ViewCustomAttributes = "";

			// planned_date_out_sub7
			$this->planned_date_out_sub7->ViewValue = $this->planned_date_out_sub7->CurrentValue;
			$this->planned_date_out_sub7->ViewValue = FormatDateTime($this->planned_date_out_sub7->ViewValue, 0);
			$this->planned_date_out_sub7->ViewCustomAttributes = "";

			// transmit_date_out_sub7
			$this->transmit_date_out_sub7->ViewValue = $this->transmit_date_out_sub7->CurrentValue;
			$this->transmit_date_out_sub7->ViewValue = FormatDateTime($this->transmit_date_out_sub7->ViewValue, 0);
			$this->transmit_date_out_sub7->ViewCustomAttributes = "";

			// transmit_no_out_sub7
			$this->transmit_no_out_sub7->ViewValue = $this->transmit_no_out_sub7->CurrentValue;
			$this->transmit_no_out_sub7->ViewCustomAttributes = "";

			// approval_status_out_sub7
			$this->approval_status_out_sub7->ViewValue = $this->approval_status_out_sub7->CurrentValue;
			$this->approval_status_out_sub7->ViewCustomAttributes = "";

			// direction_in_sub7
			$this->direction_in_sub7->ViewValue = $this->direction_in_sub7->CurrentValue;
			$this->direction_in_sub7->ViewCustomAttributes = "";

			// transmit_no_in_sub7
			$this->transmit_no_in_sub7->ViewValue = $this->transmit_no_in_sub7->CurrentValue;
			$this->transmit_no_in_sub7->ViewCustomAttributes = "";

			// approval_status_in_sub7
			$this->approval_status_in_sub7->ViewValue = $this->approval_status_in_sub7->CurrentValue;
			$this->approval_status_in_sub7->ViewCustomAttributes = "";

			// transmit_date_in_sub7
			$this->transmit_date_in_sub7->ViewValue = $this->transmit_date_in_sub7->CurrentValue;
			$this->transmit_date_in_sub7->ViewValue = FormatDateTime($this->transmit_date_in_sub7->ViewValue, 0);
			$this->transmit_date_in_sub7->ViewCustomAttributes = "";

			// submit_no_sub8
			$this->submit_no_sub8->ViewValue = $this->submit_no_sub8->CurrentValue;
			$this->submit_no_sub8->ViewCustomAttributes = "";

			// revision_no_sub8
			$this->revision_no_sub8->ViewValue = $this->revision_no_sub8->CurrentValue;
			$this->revision_no_sub8->ViewCustomAttributes = "";

			// direction_out_sub8
			$this->direction_out_sub8->ViewValue = $this->direction_out_sub8->CurrentValue;
			$this->direction_out_sub8->ViewCustomAttributes = "";

			// planned_date_out_sub8
			$this->planned_date_out_sub8->ViewValue = $this->planned_date_out_sub8->CurrentValue;
			$this->planned_date_out_sub8->ViewValue = FormatDateTime($this->planned_date_out_sub8->ViewValue, 0);
			$this->planned_date_out_sub8->ViewCustomAttributes = "";

			// transmit_date_out_sub8
			$this->transmit_date_out_sub8->ViewValue = $this->transmit_date_out_sub8->CurrentValue;
			$this->transmit_date_out_sub8->ViewValue = FormatDateTime($this->transmit_date_out_sub8->ViewValue, 0);
			$this->transmit_date_out_sub8->ViewCustomAttributes = "";

			// transmit_no_out_sub8
			$this->transmit_no_out_sub8->ViewValue = $this->transmit_no_out_sub8->CurrentValue;
			$this->transmit_no_out_sub8->ViewCustomAttributes = "";

			// approval_status_out_sub8
			$this->approval_status_out_sub8->ViewValue = $this->approval_status_out_sub8->CurrentValue;
			$this->approval_status_out_sub8->ViewCustomAttributes = "";

			// direction_out_file_sub8
			$this->direction_out_file_sub8->ViewValue = $this->direction_out_file_sub8->CurrentValue;
			$this->direction_out_file_sub8->ViewCustomAttributes = "";

			// direction_in_sub8
			$this->direction_in_sub8->ViewValue = $this->direction_in_sub8->CurrentValue;
			$this->direction_in_sub8->ViewCustomAttributes = "";

			// transmit_no_in_sub8
			$this->transmit_no_in_sub8->ViewValue = $this->transmit_no_in_sub8->CurrentValue;
			$this->transmit_no_in_sub8->ViewCustomAttributes = "";

			// approval_status_in_sub8
			$this->approval_status_in_sub8->ViewValue = $this->approval_status_in_sub8->CurrentValue;
			$this->approval_status_in_sub8->ViewCustomAttributes = "";

			// transmit_date_in_sub8
			$this->transmit_date_in_sub8->ViewValue = $this->transmit_date_in_sub8->CurrentValue;
			$this->transmit_date_in_sub8->ViewValue = FormatDateTime($this->transmit_date_in_sub8->ViewValue, 0);
			$this->transmit_date_in_sub8->ViewCustomAttributes = "";

			// submit_no_sub9
			$this->submit_no_sub9->ViewValue = $this->submit_no_sub9->CurrentValue;
			$this->submit_no_sub9->ViewCustomAttributes = "";

			// revision_no_sub9
			$this->revision_no_sub9->ViewValue = $this->revision_no_sub9->CurrentValue;
			$this->revision_no_sub9->ViewCustomAttributes = "";

			// direction_out_sub9
			$this->direction_out_sub9->ViewValue = $this->direction_out_sub9->CurrentValue;
			$this->direction_out_sub9->ViewCustomAttributes = "";

			// planned_date_out_sub9
			$this->planned_date_out_sub9->ViewValue = $this->planned_date_out_sub9->CurrentValue;
			$this->planned_date_out_sub9->ViewValue = FormatDateTime($this->planned_date_out_sub9->ViewValue, 0);
			$this->planned_date_out_sub9->ViewCustomAttributes = "";

			// transmit_date_out_sub9
			$this->transmit_date_out_sub9->ViewValue = $this->transmit_date_out_sub9->CurrentValue;
			$this->transmit_date_out_sub9->ViewValue = FormatDateTime($this->transmit_date_out_sub9->ViewValue, 0);
			$this->transmit_date_out_sub9->ViewCustomAttributes = "";

			// transmit_no_out_sub9
			$this->transmit_no_out_sub9->ViewValue = $this->transmit_no_out_sub9->CurrentValue;
			$this->transmit_no_out_sub9->ViewCustomAttributes = "";

			// approval_status_out_sub9
			$this->approval_status_out_sub9->ViewValue = $this->approval_status_out_sub9->CurrentValue;
			$this->approval_status_out_sub9->ViewCustomAttributes = "";

			// direction_in_sub9
			$this->direction_in_sub9->ViewValue = $this->direction_in_sub9->CurrentValue;
			$this->direction_in_sub9->ViewCustomAttributes = "";

			// transmit_no_in_sub9
			$this->transmit_no_in_sub9->ViewValue = $this->transmit_no_in_sub9->CurrentValue;
			$this->transmit_no_in_sub9->ViewCustomAttributes = "";

			// approval_status_in_sub9
			$this->approval_status_in_sub9->ViewValue = $this->approval_status_in_sub9->CurrentValue;
			$this->approval_status_in_sub9->ViewCustomAttributes = "";

			// transmit_date_in_sub9
			$this->transmit_date_in_sub9->ViewValue = $this->transmit_date_in_sub9->CurrentValue;
			$this->transmit_date_in_sub9->ViewValue = FormatDateTime($this->transmit_date_in_sub9->ViewValue, 0);
			$this->transmit_date_in_sub9->ViewCustomAttributes = "";

			// submit_no_sub10
			$this->submit_no_sub10->ViewValue = $this->submit_no_sub10->CurrentValue;
			$this->submit_no_sub10->ViewCustomAttributes = "";

			// revision_no_sub10
			$this->revision_no_sub10->ViewValue = $this->revision_no_sub10->CurrentValue;
			$this->revision_no_sub10->ViewCustomAttributes = "";

			// direction_out_sub10
			$this->direction_out_sub10->ViewValue = $this->direction_out_sub10->CurrentValue;
			$this->direction_out_sub10->ViewCustomAttributes = "";

			// planned_date_out_sub10
			$this->planned_date_out_sub10->ViewValue = $this->planned_date_out_sub10->CurrentValue;
			$this->planned_date_out_sub10->ViewValue = FormatDateTime($this->planned_date_out_sub10->ViewValue, 0);
			$this->planned_date_out_sub10->ViewCustomAttributes = "";

			// transmit_date_out_sub10
			$this->transmit_date_out_sub10->ViewValue = $this->transmit_date_out_sub10->CurrentValue;
			$this->transmit_date_out_sub10->ViewValue = FormatDateTime($this->transmit_date_out_sub10->ViewValue, 0);
			$this->transmit_date_out_sub10->ViewCustomAttributes = "";

			// transmit_no_out_sub10
			$this->transmit_no_out_sub10->ViewValue = $this->transmit_no_out_sub10->CurrentValue;
			$this->transmit_no_out_sub10->ViewCustomAttributes = "";

			// approval_status_out_sub10
			$this->approval_status_out_sub10->ViewValue = $this->approval_status_out_sub10->CurrentValue;
			$this->approval_status_out_sub10->ViewCustomAttributes = "";

			// direction_in_sub10
			$this->direction_in_sub10->ViewValue = $this->direction_in_sub10->CurrentValue;
			$this->direction_in_sub10->ViewCustomAttributes = "";

			// transmit_no_in_sub10
			$this->transmit_no_in_sub10->ViewValue = $this->transmit_no_in_sub10->CurrentValue;
			$this->transmit_no_in_sub10->ViewCustomAttributes = "";

			// approval_status_in_sub10
			$this->approval_status_in_sub10->ViewValue = $this->approval_status_in_sub10->CurrentValue;
			$this->approval_status_in_sub10->ViewCustomAttributes = "";

			// transmit_date_in_sub10
			$this->transmit_date_in_sub10->ViewValue = $this->transmit_date_in_sub10->CurrentValue;
			$this->transmit_date_in_sub10->ViewValue = FormatDateTime($this->transmit_date_in_sub10->ViewValue, 0);
			$this->transmit_date_in_sub10->ViewCustomAttributes = "";

			// log_updatedon
			$this->log_updatedon->ViewValue = $this->log_updatedon->CurrentValue;
			$this->log_updatedon->ViewValue = FormatDateTime($this->log_updatedon->ViewValue, 0);
			$this->log_updatedon->ViewCustomAttributes = "";

			// log_id
			$this->log_id->LinkCustomAttributes = "";
			$this->log_id->HrefValue = "";
			$this->log_id->TooltipValue = "";

			// firelink_doc_no
			$this->firelink_doc_no->LinkCustomAttributes = "";
			$this->firelink_doc_no->HrefValue = "";
			$this->firelink_doc_no->TooltipValue = "";

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
			$this->current_status->HrefValue = "";
			$this->current_status->TooltipValue = "";

			// submit_no_sub1
			$this->submit_no_sub1->LinkCustomAttributes = "";
			$this->submit_no_sub1->HrefValue = "";
			$this->submit_no_sub1->TooltipValue = "";

			// revision_no_sub1
			$this->revision_no_sub1->LinkCustomAttributes = "";
			$this->revision_no_sub1->HrefValue = "";
			$this->revision_no_sub1->TooltipValue = "";

			// direction_out_sub1
			$this->direction_out_sub1->LinkCustomAttributes = "";
			$this->direction_out_sub1->HrefValue = "";
			$this->direction_out_sub1->TooltipValue = "";

			// planned_date_out_sub1
			$this->planned_date_out_sub1->LinkCustomAttributes = "";
			$this->planned_date_out_sub1->HrefValue = "";
			$this->planned_date_out_sub1->TooltipValue = "";

			// transmit_date_out_sub1
			$this->transmit_date_out_sub1->LinkCustomAttributes = "";
			$this->transmit_date_out_sub1->HrefValue = "";
			$this->transmit_date_out_sub1->TooltipValue = "";

			// transmit_no_out_sub1
			$this->transmit_no_out_sub1->LinkCustomAttributes = "";
			$this->transmit_no_out_sub1->HrefValue = "";
			$this->transmit_no_out_sub1->TooltipValue = "";

			// approval_status_out_sub1
			$this->approval_status_out_sub1->LinkCustomAttributes = "";
			$this->approval_status_out_sub1->HrefValue = "";
			$this->approval_status_out_sub1->TooltipValue = "";

			// direction_out_file_sub1
			$this->direction_out_file_sub1->LinkCustomAttributes = "";
			$this->direction_out_file_sub1->HrefValue = "";
			$this->direction_out_file_sub1->TooltipValue = "";

			// direction_in_sub1
			$this->direction_in_sub1->LinkCustomAttributes = "";
			$this->direction_in_sub1->HrefValue = "";
			$this->direction_in_sub1->TooltipValue = "";

			// transmit_no_in_sub1
			$this->transmit_no_in_sub1->LinkCustomAttributes = "";
			$this->transmit_no_in_sub1->HrefValue = "";
			$this->transmit_no_in_sub1->TooltipValue = "";

			// approval_status_in_sub1
			$this->approval_status_in_sub1->LinkCustomAttributes = "";
			$this->approval_status_in_sub1->HrefValue = "";
			$this->approval_status_in_sub1->TooltipValue = "";

			// transmit_date_in_sub1
			$this->transmit_date_in_sub1->LinkCustomAttributes = "";
			$this->transmit_date_in_sub1->HrefValue = "";
			$this->transmit_date_in_sub1->TooltipValue = "";

			// submit_no_sub2
			$this->submit_no_sub2->LinkCustomAttributes = "";
			$this->submit_no_sub2->HrefValue = "";
			$this->submit_no_sub2->TooltipValue = "";

			// revision_no_sub2
			$this->revision_no_sub2->LinkCustomAttributes = "";
			$this->revision_no_sub2->HrefValue = "";
			$this->revision_no_sub2->TooltipValue = "";

			// direction_out_sub2
			$this->direction_out_sub2->LinkCustomAttributes = "";
			$this->direction_out_sub2->HrefValue = "";
			$this->direction_out_sub2->TooltipValue = "";

			// planned_date_out_sub2
			$this->planned_date_out_sub2->LinkCustomAttributes = "";
			$this->planned_date_out_sub2->HrefValue = "";
			$this->planned_date_out_sub2->TooltipValue = "";

			// transmit_date_out_sub2
			$this->transmit_date_out_sub2->LinkCustomAttributes = "";
			$this->transmit_date_out_sub2->HrefValue = "";
			$this->transmit_date_out_sub2->TooltipValue = "";

			// transmit_no_out_sub2
			$this->transmit_no_out_sub2->LinkCustomAttributes = "";
			$this->transmit_no_out_sub2->HrefValue = "";
			$this->transmit_no_out_sub2->TooltipValue = "";

			// approval_status_out_sub2
			$this->approval_status_out_sub2->LinkCustomAttributes = "";
			$this->approval_status_out_sub2->HrefValue = "";
			$this->approval_status_out_sub2->TooltipValue = "";

			// direction_in_sub2
			$this->direction_in_sub2->LinkCustomAttributes = "";
			$this->direction_in_sub2->HrefValue = "";
			$this->direction_in_sub2->TooltipValue = "";

			// transmit_no_in_sub2
			$this->transmit_no_in_sub2->LinkCustomAttributes = "";
			$this->transmit_no_in_sub2->HrefValue = "";
			$this->transmit_no_in_sub2->TooltipValue = "";

			// approval_status_in_sub2
			$this->approval_status_in_sub2->LinkCustomAttributes = "";
			$this->approval_status_in_sub2->HrefValue = "";
			$this->approval_status_in_sub2->TooltipValue = "";

			// transmit_date_in_sub2
			$this->transmit_date_in_sub2->LinkCustomAttributes = "";
			$this->transmit_date_in_sub2->HrefValue = "";
			$this->transmit_date_in_sub2->TooltipValue = "";

			// submit_no_sub3
			$this->submit_no_sub3->LinkCustomAttributes = "";
			$this->submit_no_sub3->HrefValue = "";
			$this->submit_no_sub3->TooltipValue = "";

			// revision_no_sub3
			$this->revision_no_sub3->LinkCustomAttributes = "";
			$this->revision_no_sub3->HrefValue = "";
			$this->revision_no_sub3->TooltipValue = "";

			// direction_out_sub3
			$this->direction_out_sub3->LinkCustomAttributes = "";
			$this->direction_out_sub3->HrefValue = "";
			$this->direction_out_sub3->TooltipValue = "";

			// planned_date_out_sub3
			$this->planned_date_out_sub3->LinkCustomAttributes = "";
			$this->planned_date_out_sub3->HrefValue = "";
			$this->planned_date_out_sub3->TooltipValue = "";

			// transmit_date_out_sub3
			$this->transmit_date_out_sub3->LinkCustomAttributes = "";
			$this->transmit_date_out_sub3->HrefValue = "";
			$this->transmit_date_out_sub3->TooltipValue = "";

			// transmit_no_out_sub3
			$this->transmit_no_out_sub3->LinkCustomAttributes = "";
			$this->transmit_no_out_sub3->HrefValue = "";
			$this->transmit_no_out_sub3->TooltipValue = "";

			// approval_status_out_sub3
			$this->approval_status_out_sub3->LinkCustomAttributes = "";
			$this->approval_status_out_sub3->HrefValue = "";
			$this->approval_status_out_sub3->TooltipValue = "";

			// direction_in_sub3
			$this->direction_in_sub3->LinkCustomAttributes = "";
			$this->direction_in_sub3->HrefValue = "";
			$this->direction_in_sub3->TooltipValue = "";

			// transmit_no_in_sub3
			$this->transmit_no_in_sub3->LinkCustomAttributes = "";
			$this->transmit_no_in_sub3->HrefValue = "";
			$this->transmit_no_in_sub3->TooltipValue = "";

			// approval_status_in_sub3
			$this->approval_status_in_sub3->LinkCustomAttributes = "";
			$this->approval_status_in_sub3->HrefValue = "";
			$this->approval_status_in_sub3->TooltipValue = "";

			// transmit_date_in_sub3
			$this->transmit_date_in_sub3->LinkCustomAttributes = "";
			$this->transmit_date_in_sub3->HrefValue = "";
			$this->transmit_date_in_sub3->TooltipValue = "";

			// submit_no_sub4
			$this->submit_no_sub4->LinkCustomAttributes = "";
			$this->submit_no_sub4->HrefValue = "";
			$this->submit_no_sub4->TooltipValue = "";

			// revision_no_sub4
			$this->revision_no_sub4->LinkCustomAttributes = "";
			$this->revision_no_sub4->HrefValue = "";
			$this->revision_no_sub4->TooltipValue = "";

			// direction_out_sub4
			$this->direction_out_sub4->LinkCustomAttributes = "";
			$this->direction_out_sub4->HrefValue = "";
			$this->direction_out_sub4->TooltipValue = "";

			// planned_date_out_sub4
			$this->planned_date_out_sub4->LinkCustomAttributes = "";
			$this->planned_date_out_sub4->HrefValue = "";
			$this->planned_date_out_sub4->TooltipValue = "";

			// transmit_date_out_sub4
			$this->transmit_date_out_sub4->LinkCustomAttributes = "";
			$this->transmit_date_out_sub4->HrefValue = "";
			$this->transmit_date_out_sub4->TooltipValue = "";

			// transmit_no_out_sub4
			$this->transmit_no_out_sub4->LinkCustomAttributes = "";
			$this->transmit_no_out_sub4->HrefValue = "";
			$this->transmit_no_out_sub4->TooltipValue = "";

			// approval_status_out_sub4
			$this->approval_status_out_sub4->LinkCustomAttributes = "";
			$this->approval_status_out_sub4->HrefValue = "";
			$this->approval_status_out_sub4->TooltipValue = "";

			// direction_in_sub4
			$this->direction_in_sub4->LinkCustomAttributes = "";
			$this->direction_in_sub4->HrefValue = "";
			$this->direction_in_sub4->TooltipValue = "";

			// transmit_no_in_sub4
			$this->transmit_no_in_sub4->LinkCustomAttributes = "";
			$this->transmit_no_in_sub4->HrefValue = "";
			$this->transmit_no_in_sub4->TooltipValue = "";

			// approval_status_in_sub4
			$this->approval_status_in_sub4->LinkCustomAttributes = "";
			$this->approval_status_in_sub4->HrefValue = "";
			$this->approval_status_in_sub4->TooltipValue = "";

			// direction_in_file_sub4
			$this->direction_in_file_sub4->LinkCustomAttributes = "";
			$this->direction_in_file_sub4->HrefValue = "";
			$this->direction_in_file_sub4->TooltipValue = "";

			// transmit_date_in_sub4
			$this->transmit_date_in_sub4->LinkCustomAttributes = "";
			$this->transmit_date_in_sub4->HrefValue = "";
			$this->transmit_date_in_sub4->TooltipValue = "";

			// submit_no_sub5
			$this->submit_no_sub5->LinkCustomAttributes = "";
			$this->submit_no_sub5->HrefValue = "";
			$this->submit_no_sub5->TooltipValue = "";

			// revision_no_sub5
			$this->revision_no_sub5->LinkCustomAttributes = "";
			$this->revision_no_sub5->HrefValue = "";
			$this->revision_no_sub5->TooltipValue = "";

			// direction_out_sub5
			$this->direction_out_sub5->LinkCustomAttributes = "";
			$this->direction_out_sub5->HrefValue = "";
			$this->direction_out_sub5->TooltipValue = "";

			// planned_date_out_sub5
			$this->planned_date_out_sub5->LinkCustomAttributes = "";
			$this->planned_date_out_sub5->HrefValue = "";
			$this->planned_date_out_sub5->TooltipValue = "";

			// transmit_date_out_sub5
			$this->transmit_date_out_sub5->LinkCustomAttributes = "";
			$this->transmit_date_out_sub5->HrefValue = "";
			$this->transmit_date_out_sub5->TooltipValue = "";

			// transmit_no_out_sub5
			$this->transmit_no_out_sub5->LinkCustomAttributes = "";
			$this->transmit_no_out_sub5->HrefValue = "";
			$this->transmit_no_out_sub5->TooltipValue = "";

			// approval_status_out_sub5
			$this->approval_status_out_sub5->LinkCustomAttributes = "";
			$this->approval_status_out_sub5->HrefValue = "";
			$this->approval_status_out_sub5->TooltipValue = "";

			// direction_in_sub5
			$this->direction_in_sub5->LinkCustomAttributes = "";
			$this->direction_in_sub5->HrefValue = "";
			$this->direction_in_sub5->TooltipValue = "";

			// transmit_no_in_sub5
			$this->transmit_no_in_sub5->LinkCustomAttributes = "";
			$this->transmit_no_in_sub5->HrefValue = "";
			$this->transmit_no_in_sub5->TooltipValue = "";

			// approval_status_in_sub5
			$this->approval_status_in_sub5->LinkCustomAttributes = "";
			$this->approval_status_in_sub5->HrefValue = "";
			$this->approval_status_in_sub5->TooltipValue = "";

			// direction_in_file_sub5
			$this->direction_in_file_sub5->LinkCustomAttributes = "";
			$this->direction_in_file_sub5->HrefValue = "";
			$this->direction_in_file_sub5->TooltipValue = "";

			// transmit_date_in_sub5
			$this->transmit_date_in_sub5->LinkCustomAttributes = "";
			$this->transmit_date_in_sub5->HrefValue = "";
			$this->transmit_date_in_sub5->TooltipValue = "";

			// submit_no_sub6
			$this->submit_no_sub6->LinkCustomAttributes = "";
			$this->submit_no_sub6->HrefValue = "";
			$this->submit_no_sub6->TooltipValue = "";

			// revision_no_sub6
			$this->revision_no_sub6->LinkCustomAttributes = "";
			$this->revision_no_sub6->HrefValue = "";
			$this->revision_no_sub6->TooltipValue = "";

			// direction_out_sub6
			$this->direction_out_sub6->LinkCustomAttributes = "";
			$this->direction_out_sub6->HrefValue = "";
			$this->direction_out_sub6->TooltipValue = "";

			// planned_date_out_sub6
			$this->planned_date_out_sub6->LinkCustomAttributes = "";
			$this->planned_date_out_sub6->HrefValue = "";
			$this->planned_date_out_sub6->TooltipValue = "";

			// transmit_date_out_sub6
			$this->transmit_date_out_sub6->LinkCustomAttributes = "";
			$this->transmit_date_out_sub6->HrefValue = "";
			$this->transmit_date_out_sub6->TooltipValue = "";

			// transmit_no_out_sub6
			$this->transmit_no_out_sub6->LinkCustomAttributes = "";
			$this->transmit_no_out_sub6->HrefValue = "";
			$this->transmit_no_out_sub6->TooltipValue = "";

			// approval_status_out_sub6
			$this->approval_status_out_sub6->LinkCustomAttributes = "";
			$this->approval_status_out_sub6->HrefValue = "";
			$this->approval_status_out_sub6->TooltipValue = "";

			// direction_in_sub6
			$this->direction_in_sub6->LinkCustomAttributes = "";
			$this->direction_in_sub6->HrefValue = "";
			$this->direction_in_sub6->TooltipValue = "";

			// transmit_no_in_sub6
			$this->transmit_no_in_sub6->LinkCustomAttributes = "";
			$this->transmit_no_in_sub6->HrefValue = "";
			$this->transmit_no_in_sub6->TooltipValue = "";

			// approval_status_in_sub6
			$this->approval_status_in_sub6->LinkCustomAttributes = "";
			$this->approval_status_in_sub6->HrefValue = "";
			$this->approval_status_in_sub6->TooltipValue = "";

			// direction_in_file_sub6
			$this->direction_in_file_sub6->LinkCustomAttributes = "";
			$this->direction_in_file_sub6->HrefValue = "";
			$this->direction_in_file_sub6->TooltipValue = "";

			// transmit_date_in_sub6
			$this->transmit_date_in_sub6->LinkCustomAttributes = "";
			$this->transmit_date_in_sub6->HrefValue = "";
			$this->transmit_date_in_sub6->TooltipValue = "";

			// submit_no_sub7
			$this->submit_no_sub7->LinkCustomAttributes = "";
			$this->submit_no_sub7->HrefValue = "";
			$this->submit_no_sub7->TooltipValue = "";

			// revision_no_sub7
			$this->revision_no_sub7->LinkCustomAttributes = "";
			$this->revision_no_sub7->HrefValue = "";
			$this->revision_no_sub7->TooltipValue = "";

			// direction_out_sub7
			$this->direction_out_sub7->LinkCustomAttributes = "";
			$this->direction_out_sub7->HrefValue = "";
			$this->direction_out_sub7->TooltipValue = "";

			// planned_date_out_sub7
			$this->planned_date_out_sub7->LinkCustomAttributes = "";
			$this->planned_date_out_sub7->HrefValue = "";
			$this->planned_date_out_sub7->TooltipValue = "";

			// transmit_date_out_sub7
			$this->transmit_date_out_sub7->LinkCustomAttributes = "";
			$this->transmit_date_out_sub7->HrefValue = "";
			$this->transmit_date_out_sub7->TooltipValue = "";

			// transmit_no_out_sub7
			$this->transmit_no_out_sub7->LinkCustomAttributes = "";
			$this->transmit_no_out_sub7->HrefValue = "";
			$this->transmit_no_out_sub7->TooltipValue = "";

			// approval_status_out_sub7
			$this->approval_status_out_sub7->LinkCustomAttributes = "";
			$this->approval_status_out_sub7->HrefValue = "";
			$this->approval_status_out_sub7->TooltipValue = "";

			// direction_in_sub7
			$this->direction_in_sub7->LinkCustomAttributes = "";
			$this->direction_in_sub7->HrefValue = "";
			$this->direction_in_sub7->TooltipValue = "";

			// transmit_no_in_sub7
			$this->transmit_no_in_sub7->LinkCustomAttributes = "";
			$this->transmit_no_in_sub7->HrefValue = "";
			$this->transmit_no_in_sub7->TooltipValue = "";

			// approval_status_in_sub7
			$this->approval_status_in_sub7->LinkCustomAttributes = "";
			$this->approval_status_in_sub7->HrefValue = "";
			$this->approval_status_in_sub7->TooltipValue = "";

			// transmit_date_in_sub7
			$this->transmit_date_in_sub7->LinkCustomAttributes = "";
			$this->transmit_date_in_sub7->HrefValue = "";
			$this->transmit_date_in_sub7->TooltipValue = "";

			// submit_no_sub8
			$this->submit_no_sub8->LinkCustomAttributes = "";
			$this->submit_no_sub8->HrefValue = "";
			$this->submit_no_sub8->TooltipValue = "";

			// revision_no_sub8
			$this->revision_no_sub8->LinkCustomAttributes = "";
			$this->revision_no_sub8->HrefValue = "";
			$this->revision_no_sub8->TooltipValue = "";

			// direction_out_sub8
			$this->direction_out_sub8->LinkCustomAttributes = "";
			$this->direction_out_sub8->HrefValue = "";
			$this->direction_out_sub8->TooltipValue = "";

			// planned_date_out_sub8
			$this->planned_date_out_sub8->LinkCustomAttributes = "";
			$this->planned_date_out_sub8->HrefValue = "";
			$this->planned_date_out_sub8->TooltipValue = "";

			// transmit_date_out_sub8
			$this->transmit_date_out_sub8->LinkCustomAttributes = "";
			$this->transmit_date_out_sub8->HrefValue = "";
			$this->transmit_date_out_sub8->TooltipValue = "";

			// transmit_no_out_sub8
			$this->transmit_no_out_sub8->LinkCustomAttributes = "";
			$this->transmit_no_out_sub8->HrefValue = "";
			$this->transmit_no_out_sub8->TooltipValue = "";

			// approval_status_out_sub8
			$this->approval_status_out_sub8->LinkCustomAttributes = "";
			$this->approval_status_out_sub8->HrefValue = "";
			$this->approval_status_out_sub8->TooltipValue = "";

			// direction_out_file_sub8
			$this->direction_out_file_sub8->LinkCustomAttributes = "";
			$this->direction_out_file_sub8->HrefValue = "";
			$this->direction_out_file_sub8->TooltipValue = "";

			// direction_in_sub8
			$this->direction_in_sub8->LinkCustomAttributes = "";
			$this->direction_in_sub8->HrefValue = "";
			$this->direction_in_sub8->TooltipValue = "";

			// transmit_no_in_sub8
			$this->transmit_no_in_sub8->LinkCustomAttributes = "";
			$this->transmit_no_in_sub8->HrefValue = "";
			$this->transmit_no_in_sub8->TooltipValue = "";

			// approval_status_in_sub8
			$this->approval_status_in_sub8->LinkCustomAttributes = "";
			$this->approval_status_in_sub8->HrefValue = "";
			$this->approval_status_in_sub8->TooltipValue = "";

			// transmit_date_in_sub8
			$this->transmit_date_in_sub8->LinkCustomAttributes = "";
			$this->transmit_date_in_sub8->HrefValue = "";
			$this->transmit_date_in_sub8->TooltipValue = "";

			// submit_no_sub9
			$this->submit_no_sub9->LinkCustomAttributes = "";
			$this->submit_no_sub9->HrefValue = "";
			$this->submit_no_sub9->TooltipValue = "";

			// revision_no_sub9
			$this->revision_no_sub9->LinkCustomAttributes = "";
			$this->revision_no_sub9->HrefValue = "";
			$this->revision_no_sub9->TooltipValue = "";

			// direction_out_sub9
			$this->direction_out_sub9->LinkCustomAttributes = "";
			$this->direction_out_sub9->HrefValue = "";
			$this->direction_out_sub9->TooltipValue = "";

			// planned_date_out_sub9
			$this->planned_date_out_sub9->LinkCustomAttributes = "";
			$this->planned_date_out_sub9->HrefValue = "";
			$this->planned_date_out_sub9->TooltipValue = "";

			// transmit_date_out_sub9
			$this->transmit_date_out_sub9->LinkCustomAttributes = "";
			$this->transmit_date_out_sub9->HrefValue = "";
			$this->transmit_date_out_sub9->TooltipValue = "";

			// transmit_no_out_sub9
			$this->transmit_no_out_sub9->LinkCustomAttributes = "";
			$this->transmit_no_out_sub9->HrefValue = "";
			$this->transmit_no_out_sub9->TooltipValue = "";

			// approval_status_out_sub9
			$this->approval_status_out_sub9->LinkCustomAttributes = "";
			$this->approval_status_out_sub9->HrefValue = "";
			$this->approval_status_out_sub9->TooltipValue = "";

			// direction_in_sub9
			$this->direction_in_sub9->LinkCustomAttributes = "";
			$this->direction_in_sub9->HrefValue = "";
			$this->direction_in_sub9->TooltipValue = "";

			// transmit_no_in_sub9
			$this->transmit_no_in_sub9->LinkCustomAttributes = "";
			$this->transmit_no_in_sub9->HrefValue = "";
			$this->transmit_no_in_sub9->TooltipValue = "";

			// approval_status_in_sub9
			$this->approval_status_in_sub9->LinkCustomAttributes = "";
			$this->approval_status_in_sub9->HrefValue = "";
			$this->approval_status_in_sub9->TooltipValue = "";

			// transmit_date_in_sub9
			$this->transmit_date_in_sub9->LinkCustomAttributes = "";
			$this->transmit_date_in_sub9->HrefValue = "";
			$this->transmit_date_in_sub9->TooltipValue = "";

			// submit_no_sub10
			$this->submit_no_sub10->LinkCustomAttributes = "";
			$this->submit_no_sub10->HrefValue = "";
			$this->submit_no_sub10->TooltipValue = "";

			// revision_no_sub10
			$this->revision_no_sub10->LinkCustomAttributes = "";
			$this->revision_no_sub10->HrefValue = "";
			$this->revision_no_sub10->TooltipValue = "";

			// direction_out_sub10
			$this->direction_out_sub10->LinkCustomAttributes = "";
			$this->direction_out_sub10->HrefValue = "";
			$this->direction_out_sub10->TooltipValue = "";

			// planned_date_out_sub10
			$this->planned_date_out_sub10->LinkCustomAttributes = "";
			$this->planned_date_out_sub10->HrefValue = "";
			$this->planned_date_out_sub10->TooltipValue = "";

			// transmit_date_out_sub10
			$this->transmit_date_out_sub10->LinkCustomAttributes = "";
			$this->transmit_date_out_sub10->HrefValue = "";
			$this->transmit_date_out_sub10->TooltipValue = "";

			// transmit_no_out_sub10
			$this->transmit_no_out_sub10->LinkCustomAttributes = "";
			$this->transmit_no_out_sub10->HrefValue = "";
			$this->transmit_no_out_sub10->TooltipValue = "";

			// approval_status_out_sub10
			$this->approval_status_out_sub10->LinkCustomAttributes = "";
			$this->approval_status_out_sub10->HrefValue = "";
			$this->approval_status_out_sub10->TooltipValue = "";

			// direction_in_sub10
			$this->direction_in_sub10->LinkCustomAttributes = "";
			$this->direction_in_sub10->HrefValue = "";
			$this->direction_in_sub10->TooltipValue = "";

			// transmit_no_in_sub10
			$this->transmit_no_in_sub10->LinkCustomAttributes = "";
			$this->transmit_no_in_sub10->HrefValue = "";
			$this->transmit_no_in_sub10->TooltipValue = "";

			// approval_status_in_sub10
			$this->approval_status_in_sub10->LinkCustomAttributes = "";
			$this->approval_status_in_sub10->HrefValue = "";
			$this->approval_status_in_sub10->TooltipValue = "";

			// transmit_date_in_sub10
			$this->transmit_date_in_sub10->LinkCustomAttributes = "";
			$this->transmit_date_in_sub10->HrefValue = "";
			$this->transmit_date_in_sub10->TooltipValue = "";

			// log_updatedon
			$this->log_updatedon->LinkCustomAttributes = "";
			$this->log_updatedon->HrefValue = "";
			$this->log_updatedon->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// log_id
			$this->log_id->EditAttrs["class"] = "form-control";
			$this->log_id->EditCustomAttributes = "";
			$this->log_id->EditValue = $this->log_id->CurrentValue;
			$this->log_id->ViewCustomAttributes = "";

			// firelink_doc_no
			$this->firelink_doc_no->EditAttrs["class"] = "form-control";
			$this->firelink_doc_no->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->firelink_doc_no->CurrentValue = HtmlDecode($this->firelink_doc_no->CurrentValue);
			$this->firelink_doc_no->EditValue = HtmlEncode($this->firelink_doc_no->CurrentValue);
			$this->firelink_doc_no->PlaceHolder = RemoveHtml($this->firelink_doc_no->caption());

			// project_name
			$this->project_name->EditAttrs["class"] = "form-control";
			$this->project_name->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->project_name->CurrentValue = HtmlDecode($this->project_name->CurrentValue);
			$this->project_name->EditValue = HtmlEncode($this->project_name->CurrentValue);
			$this->project_name->PlaceHolder = RemoveHtml($this->project_name->caption());

			// document_tittle
			$this->document_tittle->EditAttrs["class"] = "form-control";
			$this->document_tittle->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->document_tittle->CurrentValue = HtmlDecode($this->document_tittle->CurrentValue);
			$this->document_tittle->EditValue = HtmlEncode($this->document_tittle->CurrentValue);
			$this->document_tittle->PlaceHolder = RemoveHtml($this->document_tittle->caption());

			// current_status
			$this->current_status->EditAttrs["class"] = "form-control";
			$this->current_status->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->current_status->CurrentValue = HtmlDecode($this->current_status->CurrentValue);
			$this->current_status->EditValue = HtmlEncode($this->current_status->CurrentValue);
			$this->current_status->PlaceHolder = RemoveHtml($this->current_status->caption());

			// submit_no_sub1
			$this->submit_no_sub1->EditAttrs["class"] = "form-control";
			$this->submit_no_sub1->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->submit_no_sub1->CurrentValue = HtmlDecode($this->submit_no_sub1->CurrentValue);
			$this->submit_no_sub1->EditValue = HtmlEncode($this->submit_no_sub1->CurrentValue);
			$this->submit_no_sub1->PlaceHolder = RemoveHtml($this->submit_no_sub1->caption());

			// revision_no_sub1
			$this->revision_no_sub1->EditAttrs["class"] = "form-control";
			$this->revision_no_sub1->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->revision_no_sub1->CurrentValue = HtmlDecode($this->revision_no_sub1->CurrentValue);
			$this->revision_no_sub1->EditValue = HtmlEncode($this->revision_no_sub1->CurrentValue);
			$this->revision_no_sub1->PlaceHolder = RemoveHtml($this->revision_no_sub1->caption());

			// direction_out_sub1
			$this->direction_out_sub1->EditAttrs["class"] = "form-control";
			$this->direction_out_sub1->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_out_sub1->CurrentValue = HtmlDecode($this->direction_out_sub1->CurrentValue);
			$this->direction_out_sub1->EditValue = HtmlEncode($this->direction_out_sub1->CurrentValue);
			$this->direction_out_sub1->PlaceHolder = RemoveHtml($this->direction_out_sub1->caption());

			// planned_date_out_sub1
			$this->planned_date_out_sub1->EditAttrs["class"] = "form-control";
			$this->planned_date_out_sub1->EditCustomAttributes = "";
			$this->planned_date_out_sub1->EditValue = HtmlEncode(FormatDateTime($this->planned_date_out_sub1->CurrentValue, 8));
			$this->planned_date_out_sub1->PlaceHolder = RemoveHtml($this->planned_date_out_sub1->caption());

			// transmit_date_out_sub1
			$this->transmit_date_out_sub1->EditAttrs["class"] = "form-control";
			$this->transmit_date_out_sub1->EditCustomAttributes = "";
			$this->transmit_date_out_sub1->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_out_sub1->CurrentValue, 8));
			$this->transmit_date_out_sub1->PlaceHolder = RemoveHtml($this->transmit_date_out_sub1->caption());

			// transmit_no_out_sub1
			$this->transmit_no_out_sub1->EditAttrs["class"] = "form-control";
			$this->transmit_no_out_sub1->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_out_sub1->CurrentValue = HtmlDecode($this->transmit_no_out_sub1->CurrentValue);
			$this->transmit_no_out_sub1->EditValue = HtmlEncode($this->transmit_no_out_sub1->CurrentValue);
			$this->transmit_no_out_sub1->PlaceHolder = RemoveHtml($this->transmit_no_out_sub1->caption());

			// approval_status_out_sub1
			$this->approval_status_out_sub1->EditAttrs["class"] = "form-control";
			$this->approval_status_out_sub1->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_out_sub1->CurrentValue = HtmlDecode($this->approval_status_out_sub1->CurrentValue);
			$this->approval_status_out_sub1->EditValue = HtmlEncode($this->approval_status_out_sub1->CurrentValue);
			$this->approval_status_out_sub1->PlaceHolder = RemoveHtml($this->approval_status_out_sub1->caption());

			// direction_out_file_sub1
			$this->direction_out_file_sub1->EditAttrs["class"] = "form-control";
			$this->direction_out_file_sub1->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_out_file_sub1->CurrentValue = HtmlDecode($this->direction_out_file_sub1->CurrentValue);
			$this->direction_out_file_sub1->EditValue = HtmlEncode($this->direction_out_file_sub1->CurrentValue);
			$this->direction_out_file_sub1->PlaceHolder = RemoveHtml($this->direction_out_file_sub1->caption());

			// direction_in_sub1
			$this->direction_in_sub1->EditAttrs["class"] = "form-control";
			$this->direction_in_sub1->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_in_sub1->CurrentValue = HtmlDecode($this->direction_in_sub1->CurrentValue);
			$this->direction_in_sub1->EditValue = HtmlEncode($this->direction_in_sub1->CurrentValue);
			$this->direction_in_sub1->PlaceHolder = RemoveHtml($this->direction_in_sub1->caption());

			// transmit_no_in_sub1
			$this->transmit_no_in_sub1->EditAttrs["class"] = "form-control";
			$this->transmit_no_in_sub1->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_in_sub1->CurrentValue = HtmlDecode($this->transmit_no_in_sub1->CurrentValue);
			$this->transmit_no_in_sub1->EditValue = HtmlEncode($this->transmit_no_in_sub1->CurrentValue);
			$this->transmit_no_in_sub1->PlaceHolder = RemoveHtml($this->transmit_no_in_sub1->caption());

			// approval_status_in_sub1
			$this->approval_status_in_sub1->EditAttrs["class"] = "form-control";
			$this->approval_status_in_sub1->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_in_sub1->CurrentValue = HtmlDecode($this->approval_status_in_sub1->CurrentValue);
			$this->approval_status_in_sub1->EditValue = HtmlEncode($this->approval_status_in_sub1->CurrentValue);
			$this->approval_status_in_sub1->PlaceHolder = RemoveHtml($this->approval_status_in_sub1->caption());

			// transmit_date_in_sub1
			$this->transmit_date_in_sub1->EditAttrs["class"] = "form-control";
			$this->transmit_date_in_sub1->EditCustomAttributes = "";
			$this->transmit_date_in_sub1->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_in_sub1->CurrentValue, 8));
			$this->transmit_date_in_sub1->PlaceHolder = RemoveHtml($this->transmit_date_in_sub1->caption());

			// submit_no_sub2
			$this->submit_no_sub2->EditAttrs["class"] = "form-control";
			$this->submit_no_sub2->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->submit_no_sub2->CurrentValue = HtmlDecode($this->submit_no_sub2->CurrentValue);
			$this->submit_no_sub2->EditValue = HtmlEncode($this->submit_no_sub2->CurrentValue);
			$this->submit_no_sub2->PlaceHolder = RemoveHtml($this->submit_no_sub2->caption());

			// revision_no_sub2
			$this->revision_no_sub2->EditAttrs["class"] = "form-control";
			$this->revision_no_sub2->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->revision_no_sub2->CurrentValue = HtmlDecode($this->revision_no_sub2->CurrentValue);
			$this->revision_no_sub2->EditValue = HtmlEncode($this->revision_no_sub2->CurrentValue);
			$this->revision_no_sub2->PlaceHolder = RemoveHtml($this->revision_no_sub2->caption());

			// direction_out_sub2
			$this->direction_out_sub2->EditAttrs["class"] = "form-control";
			$this->direction_out_sub2->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_out_sub2->CurrentValue = HtmlDecode($this->direction_out_sub2->CurrentValue);
			$this->direction_out_sub2->EditValue = HtmlEncode($this->direction_out_sub2->CurrentValue);
			$this->direction_out_sub2->PlaceHolder = RemoveHtml($this->direction_out_sub2->caption());

			// planned_date_out_sub2
			$this->planned_date_out_sub2->EditAttrs["class"] = "form-control";
			$this->planned_date_out_sub2->EditCustomAttributes = "";
			$this->planned_date_out_sub2->EditValue = HtmlEncode(FormatDateTime($this->planned_date_out_sub2->CurrentValue, 8));
			$this->planned_date_out_sub2->PlaceHolder = RemoveHtml($this->planned_date_out_sub2->caption());

			// transmit_date_out_sub2
			$this->transmit_date_out_sub2->EditAttrs["class"] = "form-control";
			$this->transmit_date_out_sub2->EditCustomAttributes = "";
			$this->transmit_date_out_sub2->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_out_sub2->CurrentValue, 8));
			$this->transmit_date_out_sub2->PlaceHolder = RemoveHtml($this->transmit_date_out_sub2->caption());

			// transmit_no_out_sub2
			$this->transmit_no_out_sub2->EditAttrs["class"] = "form-control";
			$this->transmit_no_out_sub2->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_out_sub2->CurrentValue = HtmlDecode($this->transmit_no_out_sub2->CurrentValue);
			$this->transmit_no_out_sub2->EditValue = HtmlEncode($this->transmit_no_out_sub2->CurrentValue);
			$this->transmit_no_out_sub2->PlaceHolder = RemoveHtml($this->transmit_no_out_sub2->caption());

			// approval_status_out_sub2
			$this->approval_status_out_sub2->EditAttrs["class"] = "form-control";
			$this->approval_status_out_sub2->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_out_sub2->CurrentValue = HtmlDecode($this->approval_status_out_sub2->CurrentValue);
			$this->approval_status_out_sub2->EditValue = HtmlEncode($this->approval_status_out_sub2->CurrentValue);
			$this->approval_status_out_sub2->PlaceHolder = RemoveHtml($this->approval_status_out_sub2->caption());

			// direction_in_sub2
			$this->direction_in_sub2->EditAttrs["class"] = "form-control";
			$this->direction_in_sub2->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_in_sub2->CurrentValue = HtmlDecode($this->direction_in_sub2->CurrentValue);
			$this->direction_in_sub2->EditValue = HtmlEncode($this->direction_in_sub2->CurrentValue);
			$this->direction_in_sub2->PlaceHolder = RemoveHtml($this->direction_in_sub2->caption());

			// transmit_no_in_sub2
			$this->transmit_no_in_sub2->EditAttrs["class"] = "form-control";
			$this->transmit_no_in_sub2->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_in_sub2->CurrentValue = HtmlDecode($this->transmit_no_in_sub2->CurrentValue);
			$this->transmit_no_in_sub2->EditValue = HtmlEncode($this->transmit_no_in_sub2->CurrentValue);
			$this->transmit_no_in_sub2->PlaceHolder = RemoveHtml($this->transmit_no_in_sub2->caption());

			// approval_status_in_sub2
			$this->approval_status_in_sub2->EditAttrs["class"] = "form-control";
			$this->approval_status_in_sub2->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_in_sub2->CurrentValue = HtmlDecode($this->approval_status_in_sub2->CurrentValue);
			$this->approval_status_in_sub2->EditValue = HtmlEncode($this->approval_status_in_sub2->CurrentValue);
			$this->approval_status_in_sub2->PlaceHolder = RemoveHtml($this->approval_status_in_sub2->caption());

			// transmit_date_in_sub2
			$this->transmit_date_in_sub2->EditAttrs["class"] = "form-control";
			$this->transmit_date_in_sub2->EditCustomAttributes = "";
			$this->transmit_date_in_sub2->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_in_sub2->CurrentValue, 8));
			$this->transmit_date_in_sub2->PlaceHolder = RemoveHtml($this->transmit_date_in_sub2->caption());

			// submit_no_sub3
			$this->submit_no_sub3->EditAttrs["class"] = "form-control";
			$this->submit_no_sub3->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->submit_no_sub3->CurrentValue = HtmlDecode($this->submit_no_sub3->CurrentValue);
			$this->submit_no_sub3->EditValue = HtmlEncode($this->submit_no_sub3->CurrentValue);
			$this->submit_no_sub3->PlaceHolder = RemoveHtml($this->submit_no_sub3->caption());

			// revision_no_sub3
			$this->revision_no_sub3->EditAttrs["class"] = "form-control";
			$this->revision_no_sub3->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->revision_no_sub3->CurrentValue = HtmlDecode($this->revision_no_sub3->CurrentValue);
			$this->revision_no_sub3->EditValue = HtmlEncode($this->revision_no_sub3->CurrentValue);
			$this->revision_no_sub3->PlaceHolder = RemoveHtml($this->revision_no_sub3->caption());

			// direction_out_sub3
			$this->direction_out_sub3->EditAttrs["class"] = "form-control";
			$this->direction_out_sub3->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_out_sub3->CurrentValue = HtmlDecode($this->direction_out_sub3->CurrentValue);
			$this->direction_out_sub3->EditValue = HtmlEncode($this->direction_out_sub3->CurrentValue);
			$this->direction_out_sub3->PlaceHolder = RemoveHtml($this->direction_out_sub3->caption());

			// planned_date_out_sub3
			$this->planned_date_out_sub3->EditAttrs["class"] = "form-control";
			$this->planned_date_out_sub3->EditCustomAttributes = "";
			$this->planned_date_out_sub3->EditValue = HtmlEncode(FormatDateTime($this->planned_date_out_sub3->CurrentValue, 8));
			$this->planned_date_out_sub3->PlaceHolder = RemoveHtml($this->planned_date_out_sub3->caption());

			// transmit_date_out_sub3
			$this->transmit_date_out_sub3->EditAttrs["class"] = "form-control";
			$this->transmit_date_out_sub3->EditCustomAttributes = "";
			$this->transmit_date_out_sub3->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_out_sub3->CurrentValue, 8));
			$this->transmit_date_out_sub3->PlaceHolder = RemoveHtml($this->transmit_date_out_sub3->caption());

			// transmit_no_out_sub3
			$this->transmit_no_out_sub3->EditAttrs["class"] = "form-control";
			$this->transmit_no_out_sub3->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_out_sub3->CurrentValue = HtmlDecode($this->transmit_no_out_sub3->CurrentValue);
			$this->transmit_no_out_sub3->EditValue = HtmlEncode($this->transmit_no_out_sub3->CurrentValue);
			$this->transmit_no_out_sub3->PlaceHolder = RemoveHtml($this->transmit_no_out_sub3->caption());

			// approval_status_out_sub3
			$this->approval_status_out_sub3->EditAttrs["class"] = "form-control";
			$this->approval_status_out_sub3->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_out_sub3->CurrentValue = HtmlDecode($this->approval_status_out_sub3->CurrentValue);
			$this->approval_status_out_sub3->EditValue = HtmlEncode($this->approval_status_out_sub3->CurrentValue);
			$this->approval_status_out_sub3->PlaceHolder = RemoveHtml($this->approval_status_out_sub3->caption());

			// direction_in_sub3
			$this->direction_in_sub3->EditAttrs["class"] = "form-control";
			$this->direction_in_sub3->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_in_sub3->CurrentValue = HtmlDecode($this->direction_in_sub3->CurrentValue);
			$this->direction_in_sub3->EditValue = HtmlEncode($this->direction_in_sub3->CurrentValue);
			$this->direction_in_sub3->PlaceHolder = RemoveHtml($this->direction_in_sub3->caption());

			// transmit_no_in_sub3
			$this->transmit_no_in_sub3->EditAttrs["class"] = "form-control";
			$this->transmit_no_in_sub3->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_in_sub3->CurrentValue = HtmlDecode($this->transmit_no_in_sub3->CurrentValue);
			$this->transmit_no_in_sub3->EditValue = HtmlEncode($this->transmit_no_in_sub3->CurrentValue);
			$this->transmit_no_in_sub3->PlaceHolder = RemoveHtml($this->transmit_no_in_sub3->caption());

			// approval_status_in_sub3
			$this->approval_status_in_sub3->EditAttrs["class"] = "form-control";
			$this->approval_status_in_sub3->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_in_sub3->CurrentValue = HtmlDecode($this->approval_status_in_sub3->CurrentValue);
			$this->approval_status_in_sub3->EditValue = HtmlEncode($this->approval_status_in_sub3->CurrentValue);
			$this->approval_status_in_sub3->PlaceHolder = RemoveHtml($this->approval_status_in_sub3->caption());

			// transmit_date_in_sub3
			$this->transmit_date_in_sub3->EditAttrs["class"] = "form-control";
			$this->transmit_date_in_sub3->EditCustomAttributes = "";
			$this->transmit_date_in_sub3->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_in_sub3->CurrentValue, 8));
			$this->transmit_date_in_sub3->PlaceHolder = RemoveHtml($this->transmit_date_in_sub3->caption());

			// submit_no_sub4
			$this->submit_no_sub4->EditAttrs["class"] = "form-control";
			$this->submit_no_sub4->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->submit_no_sub4->CurrentValue = HtmlDecode($this->submit_no_sub4->CurrentValue);
			$this->submit_no_sub4->EditValue = HtmlEncode($this->submit_no_sub4->CurrentValue);
			$this->submit_no_sub4->PlaceHolder = RemoveHtml($this->submit_no_sub4->caption());

			// revision_no_sub4
			$this->revision_no_sub4->EditAttrs["class"] = "form-control";
			$this->revision_no_sub4->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->revision_no_sub4->CurrentValue = HtmlDecode($this->revision_no_sub4->CurrentValue);
			$this->revision_no_sub4->EditValue = HtmlEncode($this->revision_no_sub4->CurrentValue);
			$this->revision_no_sub4->PlaceHolder = RemoveHtml($this->revision_no_sub4->caption());

			// direction_out_sub4
			$this->direction_out_sub4->EditAttrs["class"] = "form-control";
			$this->direction_out_sub4->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_out_sub4->CurrentValue = HtmlDecode($this->direction_out_sub4->CurrentValue);
			$this->direction_out_sub4->EditValue = HtmlEncode($this->direction_out_sub4->CurrentValue);
			$this->direction_out_sub4->PlaceHolder = RemoveHtml($this->direction_out_sub4->caption());

			// planned_date_out_sub4
			$this->planned_date_out_sub4->EditAttrs["class"] = "form-control";
			$this->planned_date_out_sub4->EditCustomAttributes = "";
			$this->planned_date_out_sub4->EditValue = HtmlEncode(FormatDateTime($this->planned_date_out_sub4->CurrentValue, 8));
			$this->planned_date_out_sub4->PlaceHolder = RemoveHtml($this->planned_date_out_sub4->caption());

			// transmit_date_out_sub4
			$this->transmit_date_out_sub4->EditAttrs["class"] = "form-control";
			$this->transmit_date_out_sub4->EditCustomAttributes = "";
			$this->transmit_date_out_sub4->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_out_sub4->CurrentValue, 8));
			$this->transmit_date_out_sub4->PlaceHolder = RemoveHtml($this->transmit_date_out_sub4->caption());

			// transmit_no_out_sub4
			$this->transmit_no_out_sub4->EditAttrs["class"] = "form-control";
			$this->transmit_no_out_sub4->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_out_sub4->CurrentValue = HtmlDecode($this->transmit_no_out_sub4->CurrentValue);
			$this->transmit_no_out_sub4->EditValue = HtmlEncode($this->transmit_no_out_sub4->CurrentValue);
			$this->transmit_no_out_sub4->PlaceHolder = RemoveHtml($this->transmit_no_out_sub4->caption());

			// approval_status_out_sub4
			$this->approval_status_out_sub4->EditAttrs["class"] = "form-control";
			$this->approval_status_out_sub4->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_out_sub4->CurrentValue = HtmlDecode($this->approval_status_out_sub4->CurrentValue);
			$this->approval_status_out_sub4->EditValue = HtmlEncode($this->approval_status_out_sub4->CurrentValue);
			$this->approval_status_out_sub4->PlaceHolder = RemoveHtml($this->approval_status_out_sub4->caption());

			// direction_in_sub4
			$this->direction_in_sub4->EditAttrs["class"] = "form-control";
			$this->direction_in_sub4->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_in_sub4->CurrentValue = HtmlDecode($this->direction_in_sub4->CurrentValue);
			$this->direction_in_sub4->EditValue = HtmlEncode($this->direction_in_sub4->CurrentValue);
			$this->direction_in_sub4->PlaceHolder = RemoveHtml($this->direction_in_sub4->caption());

			// transmit_no_in_sub4
			$this->transmit_no_in_sub4->EditAttrs["class"] = "form-control";
			$this->transmit_no_in_sub4->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_in_sub4->CurrentValue = HtmlDecode($this->transmit_no_in_sub4->CurrentValue);
			$this->transmit_no_in_sub4->EditValue = HtmlEncode($this->transmit_no_in_sub4->CurrentValue);
			$this->transmit_no_in_sub4->PlaceHolder = RemoveHtml($this->transmit_no_in_sub4->caption());

			// approval_status_in_sub4
			$this->approval_status_in_sub4->EditAttrs["class"] = "form-control";
			$this->approval_status_in_sub4->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_in_sub4->CurrentValue = HtmlDecode($this->approval_status_in_sub4->CurrentValue);
			$this->approval_status_in_sub4->EditValue = HtmlEncode($this->approval_status_in_sub4->CurrentValue);
			$this->approval_status_in_sub4->PlaceHolder = RemoveHtml($this->approval_status_in_sub4->caption());

			// direction_in_file_sub4
			$this->direction_in_file_sub4->EditAttrs["class"] = "form-control";
			$this->direction_in_file_sub4->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_in_file_sub4->CurrentValue = HtmlDecode($this->direction_in_file_sub4->CurrentValue);
			$this->direction_in_file_sub4->EditValue = HtmlEncode($this->direction_in_file_sub4->CurrentValue);
			$this->direction_in_file_sub4->PlaceHolder = RemoveHtml($this->direction_in_file_sub4->caption());

			// transmit_date_in_sub4
			$this->transmit_date_in_sub4->EditAttrs["class"] = "form-control";
			$this->transmit_date_in_sub4->EditCustomAttributes = "";
			$this->transmit_date_in_sub4->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_in_sub4->CurrentValue, 8));
			$this->transmit_date_in_sub4->PlaceHolder = RemoveHtml($this->transmit_date_in_sub4->caption());

			// submit_no_sub5
			$this->submit_no_sub5->EditAttrs["class"] = "form-control";
			$this->submit_no_sub5->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->submit_no_sub5->CurrentValue = HtmlDecode($this->submit_no_sub5->CurrentValue);
			$this->submit_no_sub5->EditValue = HtmlEncode($this->submit_no_sub5->CurrentValue);
			$this->submit_no_sub5->PlaceHolder = RemoveHtml($this->submit_no_sub5->caption());

			// revision_no_sub5
			$this->revision_no_sub5->EditAttrs["class"] = "form-control";
			$this->revision_no_sub5->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->revision_no_sub5->CurrentValue = HtmlDecode($this->revision_no_sub5->CurrentValue);
			$this->revision_no_sub5->EditValue = HtmlEncode($this->revision_no_sub5->CurrentValue);
			$this->revision_no_sub5->PlaceHolder = RemoveHtml($this->revision_no_sub5->caption());

			// direction_out_sub5
			$this->direction_out_sub5->EditAttrs["class"] = "form-control";
			$this->direction_out_sub5->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_out_sub5->CurrentValue = HtmlDecode($this->direction_out_sub5->CurrentValue);
			$this->direction_out_sub5->EditValue = HtmlEncode($this->direction_out_sub5->CurrentValue);
			$this->direction_out_sub5->PlaceHolder = RemoveHtml($this->direction_out_sub5->caption());

			// planned_date_out_sub5
			$this->planned_date_out_sub5->EditAttrs["class"] = "form-control";
			$this->planned_date_out_sub5->EditCustomAttributes = "";
			$this->planned_date_out_sub5->EditValue = HtmlEncode(FormatDateTime($this->planned_date_out_sub5->CurrentValue, 8));
			$this->planned_date_out_sub5->PlaceHolder = RemoveHtml($this->planned_date_out_sub5->caption());

			// transmit_date_out_sub5
			$this->transmit_date_out_sub5->EditAttrs["class"] = "form-control";
			$this->transmit_date_out_sub5->EditCustomAttributes = "";
			$this->transmit_date_out_sub5->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_out_sub5->CurrentValue, 8));
			$this->transmit_date_out_sub5->PlaceHolder = RemoveHtml($this->transmit_date_out_sub5->caption());

			// transmit_no_out_sub5
			$this->transmit_no_out_sub5->EditAttrs["class"] = "form-control";
			$this->transmit_no_out_sub5->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_out_sub5->CurrentValue = HtmlDecode($this->transmit_no_out_sub5->CurrentValue);
			$this->transmit_no_out_sub5->EditValue = HtmlEncode($this->transmit_no_out_sub5->CurrentValue);
			$this->transmit_no_out_sub5->PlaceHolder = RemoveHtml($this->transmit_no_out_sub5->caption());

			// approval_status_out_sub5
			$this->approval_status_out_sub5->EditAttrs["class"] = "form-control";
			$this->approval_status_out_sub5->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_out_sub5->CurrentValue = HtmlDecode($this->approval_status_out_sub5->CurrentValue);
			$this->approval_status_out_sub5->EditValue = HtmlEncode($this->approval_status_out_sub5->CurrentValue);
			$this->approval_status_out_sub5->PlaceHolder = RemoveHtml($this->approval_status_out_sub5->caption());

			// direction_in_sub5
			$this->direction_in_sub5->EditAttrs["class"] = "form-control";
			$this->direction_in_sub5->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_in_sub5->CurrentValue = HtmlDecode($this->direction_in_sub5->CurrentValue);
			$this->direction_in_sub5->EditValue = HtmlEncode($this->direction_in_sub5->CurrentValue);
			$this->direction_in_sub5->PlaceHolder = RemoveHtml($this->direction_in_sub5->caption());

			// transmit_no_in_sub5
			$this->transmit_no_in_sub5->EditAttrs["class"] = "form-control";
			$this->transmit_no_in_sub5->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_in_sub5->CurrentValue = HtmlDecode($this->transmit_no_in_sub5->CurrentValue);
			$this->transmit_no_in_sub5->EditValue = HtmlEncode($this->transmit_no_in_sub5->CurrentValue);
			$this->transmit_no_in_sub5->PlaceHolder = RemoveHtml($this->transmit_no_in_sub5->caption());

			// approval_status_in_sub5
			$this->approval_status_in_sub5->EditAttrs["class"] = "form-control";
			$this->approval_status_in_sub5->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_in_sub5->CurrentValue = HtmlDecode($this->approval_status_in_sub5->CurrentValue);
			$this->approval_status_in_sub5->EditValue = HtmlEncode($this->approval_status_in_sub5->CurrentValue);
			$this->approval_status_in_sub5->PlaceHolder = RemoveHtml($this->approval_status_in_sub5->caption());

			// direction_in_file_sub5
			$this->direction_in_file_sub5->EditAttrs["class"] = "form-control";
			$this->direction_in_file_sub5->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_in_file_sub5->CurrentValue = HtmlDecode($this->direction_in_file_sub5->CurrentValue);
			$this->direction_in_file_sub5->EditValue = HtmlEncode($this->direction_in_file_sub5->CurrentValue);
			$this->direction_in_file_sub5->PlaceHolder = RemoveHtml($this->direction_in_file_sub5->caption());

			// transmit_date_in_sub5
			$this->transmit_date_in_sub5->EditAttrs["class"] = "form-control";
			$this->transmit_date_in_sub5->EditCustomAttributes = "";
			$this->transmit_date_in_sub5->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_in_sub5->CurrentValue, 8));
			$this->transmit_date_in_sub5->PlaceHolder = RemoveHtml($this->transmit_date_in_sub5->caption());

			// submit_no_sub6
			$this->submit_no_sub6->EditAttrs["class"] = "form-control";
			$this->submit_no_sub6->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->submit_no_sub6->CurrentValue = HtmlDecode($this->submit_no_sub6->CurrentValue);
			$this->submit_no_sub6->EditValue = HtmlEncode($this->submit_no_sub6->CurrentValue);
			$this->submit_no_sub6->PlaceHolder = RemoveHtml($this->submit_no_sub6->caption());

			// revision_no_sub6
			$this->revision_no_sub6->EditAttrs["class"] = "form-control";
			$this->revision_no_sub6->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->revision_no_sub6->CurrentValue = HtmlDecode($this->revision_no_sub6->CurrentValue);
			$this->revision_no_sub6->EditValue = HtmlEncode($this->revision_no_sub6->CurrentValue);
			$this->revision_no_sub6->PlaceHolder = RemoveHtml($this->revision_no_sub6->caption());

			// direction_out_sub6
			$this->direction_out_sub6->EditAttrs["class"] = "form-control";
			$this->direction_out_sub6->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_out_sub6->CurrentValue = HtmlDecode($this->direction_out_sub6->CurrentValue);
			$this->direction_out_sub6->EditValue = HtmlEncode($this->direction_out_sub6->CurrentValue);
			$this->direction_out_sub6->PlaceHolder = RemoveHtml($this->direction_out_sub6->caption());

			// planned_date_out_sub6
			$this->planned_date_out_sub6->EditAttrs["class"] = "form-control";
			$this->planned_date_out_sub6->EditCustomAttributes = "";
			$this->planned_date_out_sub6->EditValue = HtmlEncode(FormatDateTime($this->planned_date_out_sub6->CurrentValue, 8));
			$this->planned_date_out_sub6->PlaceHolder = RemoveHtml($this->planned_date_out_sub6->caption());

			// transmit_date_out_sub6
			$this->transmit_date_out_sub6->EditAttrs["class"] = "form-control";
			$this->transmit_date_out_sub6->EditCustomAttributes = "";
			$this->transmit_date_out_sub6->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_out_sub6->CurrentValue, 8));
			$this->transmit_date_out_sub6->PlaceHolder = RemoveHtml($this->transmit_date_out_sub6->caption());

			// transmit_no_out_sub6
			$this->transmit_no_out_sub6->EditAttrs["class"] = "form-control";
			$this->transmit_no_out_sub6->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_out_sub6->CurrentValue = HtmlDecode($this->transmit_no_out_sub6->CurrentValue);
			$this->transmit_no_out_sub6->EditValue = HtmlEncode($this->transmit_no_out_sub6->CurrentValue);
			$this->transmit_no_out_sub6->PlaceHolder = RemoveHtml($this->transmit_no_out_sub6->caption());

			// approval_status_out_sub6
			$this->approval_status_out_sub6->EditAttrs["class"] = "form-control";
			$this->approval_status_out_sub6->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_out_sub6->CurrentValue = HtmlDecode($this->approval_status_out_sub6->CurrentValue);
			$this->approval_status_out_sub6->EditValue = HtmlEncode($this->approval_status_out_sub6->CurrentValue);
			$this->approval_status_out_sub6->PlaceHolder = RemoveHtml($this->approval_status_out_sub6->caption());

			// direction_in_sub6
			$this->direction_in_sub6->EditAttrs["class"] = "form-control";
			$this->direction_in_sub6->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_in_sub6->CurrentValue = HtmlDecode($this->direction_in_sub6->CurrentValue);
			$this->direction_in_sub6->EditValue = HtmlEncode($this->direction_in_sub6->CurrentValue);
			$this->direction_in_sub6->PlaceHolder = RemoveHtml($this->direction_in_sub6->caption());

			// transmit_no_in_sub6
			$this->transmit_no_in_sub6->EditAttrs["class"] = "form-control";
			$this->transmit_no_in_sub6->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_in_sub6->CurrentValue = HtmlDecode($this->transmit_no_in_sub6->CurrentValue);
			$this->transmit_no_in_sub6->EditValue = HtmlEncode($this->transmit_no_in_sub6->CurrentValue);
			$this->transmit_no_in_sub6->PlaceHolder = RemoveHtml($this->transmit_no_in_sub6->caption());

			// approval_status_in_sub6
			$this->approval_status_in_sub6->EditAttrs["class"] = "form-control";
			$this->approval_status_in_sub6->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_in_sub6->CurrentValue = HtmlDecode($this->approval_status_in_sub6->CurrentValue);
			$this->approval_status_in_sub6->EditValue = HtmlEncode($this->approval_status_in_sub6->CurrentValue);
			$this->approval_status_in_sub6->PlaceHolder = RemoveHtml($this->approval_status_in_sub6->caption());

			// direction_in_file_sub6
			$this->direction_in_file_sub6->EditAttrs["class"] = "form-control";
			$this->direction_in_file_sub6->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_in_file_sub6->CurrentValue = HtmlDecode($this->direction_in_file_sub6->CurrentValue);
			$this->direction_in_file_sub6->EditValue = HtmlEncode($this->direction_in_file_sub6->CurrentValue);
			$this->direction_in_file_sub6->PlaceHolder = RemoveHtml($this->direction_in_file_sub6->caption());

			// transmit_date_in_sub6
			$this->transmit_date_in_sub6->EditAttrs["class"] = "form-control";
			$this->transmit_date_in_sub6->EditCustomAttributes = "";
			$this->transmit_date_in_sub6->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_in_sub6->CurrentValue, 8));
			$this->transmit_date_in_sub6->PlaceHolder = RemoveHtml($this->transmit_date_in_sub6->caption());

			// submit_no_sub7
			$this->submit_no_sub7->EditAttrs["class"] = "form-control";
			$this->submit_no_sub7->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->submit_no_sub7->CurrentValue = HtmlDecode($this->submit_no_sub7->CurrentValue);
			$this->submit_no_sub7->EditValue = HtmlEncode($this->submit_no_sub7->CurrentValue);
			$this->submit_no_sub7->PlaceHolder = RemoveHtml($this->submit_no_sub7->caption());

			// revision_no_sub7
			$this->revision_no_sub7->EditAttrs["class"] = "form-control";
			$this->revision_no_sub7->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->revision_no_sub7->CurrentValue = HtmlDecode($this->revision_no_sub7->CurrentValue);
			$this->revision_no_sub7->EditValue = HtmlEncode($this->revision_no_sub7->CurrentValue);
			$this->revision_no_sub7->PlaceHolder = RemoveHtml($this->revision_no_sub7->caption());

			// direction_out_sub7
			$this->direction_out_sub7->EditAttrs["class"] = "form-control";
			$this->direction_out_sub7->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_out_sub7->CurrentValue = HtmlDecode($this->direction_out_sub7->CurrentValue);
			$this->direction_out_sub7->EditValue = HtmlEncode($this->direction_out_sub7->CurrentValue);
			$this->direction_out_sub7->PlaceHolder = RemoveHtml($this->direction_out_sub7->caption());

			// planned_date_out_sub7
			$this->planned_date_out_sub7->EditAttrs["class"] = "form-control";
			$this->planned_date_out_sub7->EditCustomAttributes = "";
			$this->planned_date_out_sub7->EditValue = HtmlEncode(FormatDateTime($this->planned_date_out_sub7->CurrentValue, 8));
			$this->planned_date_out_sub7->PlaceHolder = RemoveHtml($this->planned_date_out_sub7->caption());

			// transmit_date_out_sub7
			$this->transmit_date_out_sub7->EditAttrs["class"] = "form-control";
			$this->transmit_date_out_sub7->EditCustomAttributes = "";
			$this->transmit_date_out_sub7->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_out_sub7->CurrentValue, 8));
			$this->transmit_date_out_sub7->PlaceHolder = RemoveHtml($this->transmit_date_out_sub7->caption());

			// transmit_no_out_sub7
			$this->transmit_no_out_sub7->EditAttrs["class"] = "form-control";
			$this->transmit_no_out_sub7->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_out_sub7->CurrentValue = HtmlDecode($this->transmit_no_out_sub7->CurrentValue);
			$this->transmit_no_out_sub7->EditValue = HtmlEncode($this->transmit_no_out_sub7->CurrentValue);
			$this->transmit_no_out_sub7->PlaceHolder = RemoveHtml($this->transmit_no_out_sub7->caption());

			// approval_status_out_sub7
			$this->approval_status_out_sub7->EditAttrs["class"] = "form-control";
			$this->approval_status_out_sub7->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_out_sub7->CurrentValue = HtmlDecode($this->approval_status_out_sub7->CurrentValue);
			$this->approval_status_out_sub7->EditValue = HtmlEncode($this->approval_status_out_sub7->CurrentValue);
			$this->approval_status_out_sub7->PlaceHolder = RemoveHtml($this->approval_status_out_sub7->caption());

			// direction_in_sub7
			$this->direction_in_sub7->EditAttrs["class"] = "form-control";
			$this->direction_in_sub7->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_in_sub7->CurrentValue = HtmlDecode($this->direction_in_sub7->CurrentValue);
			$this->direction_in_sub7->EditValue = HtmlEncode($this->direction_in_sub7->CurrentValue);
			$this->direction_in_sub7->PlaceHolder = RemoveHtml($this->direction_in_sub7->caption());

			// transmit_no_in_sub7
			$this->transmit_no_in_sub7->EditAttrs["class"] = "form-control";
			$this->transmit_no_in_sub7->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_in_sub7->CurrentValue = HtmlDecode($this->transmit_no_in_sub7->CurrentValue);
			$this->transmit_no_in_sub7->EditValue = HtmlEncode($this->transmit_no_in_sub7->CurrentValue);
			$this->transmit_no_in_sub7->PlaceHolder = RemoveHtml($this->transmit_no_in_sub7->caption());

			// approval_status_in_sub7
			$this->approval_status_in_sub7->EditAttrs["class"] = "form-control";
			$this->approval_status_in_sub7->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_in_sub7->CurrentValue = HtmlDecode($this->approval_status_in_sub7->CurrentValue);
			$this->approval_status_in_sub7->EditValue = HtmlEncode($this->approval_status_in_sub7->CurrentValue);
			$this->approval_status_in_sub7->PlaceHolder = RemoveHtml($this->approval_status_in_sub7->caption());

			// transmit_date_in_sub7
			$this->transmit_date_in_sub7->EditAttrs["class"] = "form-control";
			$this->transmit_date_in_sub7->EditCustomAttributes = "";
			$this->transmit_date_in_sub7->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_in_sub7->CurrentValue, 8));
			$this->transmit_date_in_sub7->PlaceHolder = RemoveHtml($this->transmit_date_in_sub7->caption());

			// submit_no_sub8
			$this->submit_no_sub8->EditAttrs["class"] = "form-control";
			$this->submit_no_sub8->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->submit_no_sub8->CurrentValue = HtmlDecode($this->submit_no_sub8->CurrentValue);
			$this->submit_no_sub8->EditValue = HtmlEncode($this->submit_no_sub8->CurrentValue);
			$this->submit_no_sub8->PlaceHolder = RemoveHtml($this->submit_no_sub8->caption());

			// revision_no_sub8
			$this->revision_no_sub8->EditAttrs["class"] = "form-control";
			$this->revision_no_sub8->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->revision_no_sub8->CurrentValue = HtmlDecode($this->revision_no_sub8->CurrentValue);
			$this->revision_no_sub8->EditValue = HtmlEncode($this->revision_no_sub8->CurrentValue);
			$this->revision_no_sub8->PlaceHolder = RemoveHtml($this->revision_no_sub8->caption());

			// direction_out_sub8
			$this->direction_out_sub8->EditAttrs["class"] = "form-control";
			$this->direction_out_sub8->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_out_sub8->CurrentValue = HtmlDecode($this->direction_out_sub8->CurrentValue);
			$this->direction_out_sub8->EditValue = HtmlEncode($this->direction_out_sub8->CurrentValue);
			$this->direction_out_sub8->PlaceHolder = RemoveHtml($this->direction_out_sub8->caption());

			// planned_date_out_sub8
			$this->planned_date_out_sub8->EditAttrs["class"] = "form-control";
			$this->planned_date_out_sub8->EditCustomAttributes = "";
			$this->planned_date_out_sub8->EditValue = HtmlEncode(FormatDateTime($this->planned_date_out_sub8->CurrentValue, 8));
			$this->planned_date_out_sub8->PlaceHolder = RemoveHtml($this->planned_date_out_sub8->caption());

			// transmit_date_out_sub8
			$this->transmit_date_out_sub8->EditAttrs["class"] = "form-control";
			$this->transmit_date_out_sub8->EditCustomAttributes = "";
			$this->transmit_date_out_sub8->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_out_sub8->CurrentValue, 8));
			$this->transmit_date_out_sub8->PlaceHolder = RemoveHtml($this->transmit_date_out_sub8->caption());

			// transmit_no_out_sub8
			$this->transmit_no_out_sub8->EditAttrs["class"] = "form-control";
			$this->transmit_no_out_sub8->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_out_sub8->CurrentValue = HtmlDecode($this->transmit_no_out_sub8->CurrentValue);
			$this->transmit_no_out_sub8->EditValue = HtmlEncode($this->transmit_no_out_sub8->CurrentValue);
			$this->transmit_no_out_sub8->PlaceHolder = RemoveHtml($this->transmit_no_out_sub8->caption());

			// approval_status_out_sub8
			$this->approval_status_out_sub8->EditAttrs["class"] = "form-control";
			$this->approval_status_out_sub8->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_out_sub8->CurrentValue = HtmlDecode($this->approval_status_out_sub8->CurrentValue);
			$this->approval_status_out_sub8->EditValue = HtmlEncode($this->approval_status_out_sub8->CurrentValue);
			$this->approval_status_out_sub8->PlaceHolder = RemoveHtml($this->approval_status_out_sub8->caption());

			// direction_out_file_sub8
			$this->direction_out_file_sub8->EditAttrs["class"] = "form-control";
			$this->direction_out_file_sub8->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_out_file_sub8->CurrentValue = HtmlDecode($this->direction_out_file_sub8->CurrentValue);
			$this->direction_out_file_sub8->EditValue = HtmlEncode($this->direction_out_file_sub8->CurrentValue);
			$this->direction_out_file_sub8->PlaceHolder = RemoveHtml($this->direction_out_file_sub8->caption());

			// direction_in_sub8
			$this->direction_in_sub8->EditAttrs["class"] = "form-control";
			$this->direction_in_sub8->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_in_sub8->CurrentValue = HtmlDecode($this->direction_in_sub8->CurrentValue);
			$this->direction_in_sub8->EditValue = HtmlEncode($this->direction_in_sub8->CurrentValue);
			$this->direction_in_sub8->PlaceHolder = RemoveHtml($this->direction_in_sub8->caption());

			// transmit_no_in_sub8
			$this->transmit_no_in_sub8->EditAttrs["class"] = "form-control";
			$this->transmit_no_in_sub8->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_in_sub8->CurrentValue = HtmlDecode($this->transmit_no_in_sub8->CurrentValue);
			$this->transmit_no_in_sub8->EditValue = HtmlEncode($this->transmit_no_in_sub8->CurrentValue);
			$this->transmit_no_in_sub8->PlaceHolder = RemoveHtml($this->transmit_no_in_sub8->caption());

			// approval_status_in_sub8
			$this->approval_status_in_sub8->EditAttrs["class"] = "form-control";
			$this->approval_status_in_sub8->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_in_sub8->CurrentValue = HtmlDecode($this->approval_status_in_sub8->CurrentValue);
			$this->approval_status_in_sub8->EditValue = HtmlEncode($this->approval_status_in_sub8->CurrentValue);
			$this->approval_status_in_sub8->PlaceHolder = RemoveHtml($this->approval_status_in_sub8->caption());

			// transmit_date_in_sub8
			$this->transmit_date_in_sub8->EditAttrs["class"] = "form-control";
			$this->transmit_date_in_sub8->EditCustomAttributes = "";
			$this->transmit_date_in_sub8->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_in_sub8->CurrentValue, 8));
			$this->transmit_date_in_sub8->PlaceHolder = RemoveHtml($this->transmit_date_in_sub8->caption());

			// submit_no_sub9
			$this->submit_no_sub9->EditAttrs["class"] = "form-control";
			$this->submit_no_sub9->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->submit_no_sub9->CurrentValue = HtmlDecode($this->submit_no_sub9->CurrentValue);
			$this->submit_no_sub9->EditValue = HtmlEncode($this->submit_no_sub9->CurrentValue);
			$this->submit_no_sub9->PlaceHolder = RemoveHtml($this->submit_no_sub9->caption());

			// revision_no_sub9
			$this->revision_no_sub9->EditAttrs["class"] = "form-control";
			$this->revision_no_sub9->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->revision_no_sub9->CurrentValue = HtmlDecode($this->revision_no_sub9->CurrentValue);
			$this->revision_no_sub9->EditValue = HtmlEncode($this->revision_no_sub9->CurrentValue);
			$this->revision_no_sub9->PlaceHolder = RemoveHtml($this->revision_no_sub9->caption());

			// direction_out_sub9
			$this->direction_out_sub9->EditAttrs["class"] = "form-control";
			$this->direction_out_sub9->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_out_sub9->CurrentValue = HtmlDecode($this->direction_out_sub9->CurrentValue);
			$this->direction_out_sub9->EditValue = HtmlEncode($this->direction_out_sub9->CurrentValue);
			$this->direction_out_sub9->PlaceHolder = RemoveHtml($this->direction_out_sub9->caption());

			// planned_date_out_sub9
			$this->planned_date_out_sub9->EditAttrs["class"] = "form-control";
			$this->planned_date_out_sub9->EditCustomAttributes = "";
			$this->planned_date_out_sub9->EditValue = HtmlEncode(FormatDateTime($this->planned_date_out_sub9->CurrentValue, 8));
			$this->planned_date_out_sub9->PlaceHolder = RemoveHtml($this->planned_date_out_sub9->caption());

			// transmit_date_out_sub9
			$this->transmit_date_out_sub9->EditAttrs["class"] = "form-control";
			$this->transmit_date_out_sub9->EditCustomAttributes = "";
			$this->transmit_date_out_sub9->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_out_sub9->CurrentValue, 8));
			$this->transmit_date_out_sub9->PlaceHolder = RemoveHtml($this->transmit_date_out_sub9->caption());

			// transmit_no_out_sub9
			$this->transmit_no_out_sub9->EditAttrs["class"] = "form-control";
			$this->transmit_no_out_sub9->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_out_sub9->CurrentValue = HtmlDecode($this->transmit_no_out_sub9->CurrentValue);
			$this->transmit_no_out_sub9->EditValue = HtmlEncode($this->transmit_no_out_sub9->CurrentValue);
			$this->transmit_no_out_sub9->PlaceHolder = RemoveHtml($this->transmit_no_out_sub9->caption());

			// approval_status_out_sub9
			$this->approval_status_out_sub9->EditAttrs["class"] = "form-control";
			$this->approval_status_out_sub9->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_out_sub9->CurrentValue = HtmlDecode($this->approval_status_out_sub9->CurrentValue);
			$this->approval_status_out_sub9->EditValue = HtmlEncode($this->approval_status_out_sub9->CurrentValue);
			$this->approval_status_out_sub9->PlaceHolder = RemoveHtml($this->approval_status_out_sub9->caption());

			// direction_in_sub9
			$this->direction_in_sub9->EditAttrs["class"] = "form-control";
			$this->direction_in_sub9->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_in_sub9->CurrentValue = HtmlDecode($this->direction_in_sub9->CurrentValue);
			$this->direction_in_sub9->EditValue = HtmlEncode($this->direction_in_sub9->CurrentValue);
			$this->direction_in_sub9->PlaceHolder = RemoveHtml($this->direction_in_sub9->caption());

			// transmit_no_in_sub9
			$this->transmit_no_in_sub9->EditAttrs["class"] = "form-control";
			$this->transmit_no_in_sub9->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_in_sub9->CurrentValue = HtmlDecode($this->transmit_no_in_sub9->CurrentValue);
			$this->transmit_no_in_sub9->EditValue = HtmlEncode($this->transmit_no_in_sub9->CurrentValue);
			$this->transmit_no_in_sub9->PlaceHolder = RemoveHtml($this->transmit_no_in_sub9->caption());

			// approval_status_in_sub9
			$this->approval_status_in_sub9->EditAttrs["class"] = "form-control";
			$this->approval_status_in_sub9->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_in_sub9->CurrentValue = HtmlDecode($this->approval_status_in_sub9->CurrentValue);
			$this->approval_status_in_sub9->EditValue = HtmlEncode($this->approval_status_in_sub9->CurrentValue);
			$this->approval_status_in_sub9->PlaceHolder = RemoveHtml($this->approval_status_in_sub9->caption());

			// transmit_date_in_sub9
			$this->transmit_date_in_sub9->EditAttrs["class"] = "form-control";
			$this->transmit_date_in_sub9->EditCustomAttributes = "";
			$this->transmit_date_in_sub9->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_in_sub9->CurrentValue, 8));
			$this->transmit_date_in_sub9->PlaceHolder = RemoveHtml($this->transmit_date_in_sub9->caption());

			// submit_no_sub10
			$this->submit_no_sub10->EditAttrs["class"] = "form-control";
			$this->submit_no_sub10->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->submit_no_sub10->CurrentValue = HtmlDecode($this->submit_no_sub10->CurrentValue);
			$this->submit_no_sub10->EditValue = HtmlEncode($this->submit_no_sub10->CurrentValue);
			$this->submit_no_sub10->PlaceHolder = RemoveHtml($this->submit_no_sub10->caption());

			// revision_no_sub10
			$this->revision_no_sub10->EditAttrs["class"] = "form-control";
			$this->revision_no_sub10->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->revision_no_sub10->CurrentValue = HtmlDecode($this->revision_no_sub10->CurrentValue);
			$this->revision_no_sub10->EditValue = HtmlEncode($this->revision_no_sub10->CurrentValue);
			$this->revision_no_sub10->PlaceHolder = RemoveHtml($this->revision_no_sub10->caption());

			// direction_out_sub10
			$this->direction_out_sub10->EditAttrs["class"] = "form-control";
			$this->direction_out_sub10->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_out_sub10->CurrentValue = HtmlDecode($this->direction_out_sub10->CurrentValue);
			$this->direction_out_sub10->EditValue = HtmlEncode($this->direction_out_sub10->CurrentValue);
			$this->direction_out_sub10->PlaceHolder = RemoveHtml($this->direction_out_sub10->caption());

			// planned_date_out_sub10
			$this->planned_date_out_sub10->EditAttrs["class"] = "form-control";
			$this->planned_date_out_sub10->EditCustomAttributes = "";
			$this->planned_date_out_sub10->EditValue = HtmlEncode(FormatDateTime($this->planned_date_out_sub10->CurrentValue, 8));
			$this->planned_date_out_sub10->PlaceHolder = RemoveHtml($this->planned_date_out_sub10->caption());

			// transmit_date_out_sub10
			$this->transmit_date_out_sub10->EditAttrs["class"] = "form-control";
			$this->transmit_date_out_sub10->EditCustomAttributes = "";
			$this->transmit_date_out_sub10->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_out_sub10->CurrentValue, 8));
			$this->transmit_date_out_sub10->PlaceHolder = RemoveHtml($this->transmit_date_out_sub10->caption());

			// transmit_no_out_sub10
			$this->transmit_no_out_sub10->EditAttrs["class"] = "form-control";
			$this->transmit_no_out_sub10->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_out_sub10->CurrentValue = HtmlDecode($this->transmit_no_out_sub10->CurrentValue);
			$this->transmit_no_out_sub10->EditValue = HtmlEncode($this->transmit_no_out_sub10->CurrentValue);
			$this->transmit_no_out_sub10->PlaceHolder = RemoveHtml($this->transmit_no_out_sub10->caption());

			// approval_status_out_sub10
			$this->approval_status_out_sub10->EditAttrs["class"] = "form-control";
			$this->approval_status_out_sub10->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_out_sub10->CurrentValue = HtmlDecode($this->approval_status_out_sub10->CurrentValue);
			$this->approval_status_out_sub10->EditValue = HtmlEncode($this->approval_status_out_sub10->CurrentValue);
			$this->approval_status_out_sub10->PlaceHolder = RemoveHtml($this->approval_status_out_sub10->caption());

			// direction_in_sub10
			$this->direction_in_sub10->EditAttrs["class"] = "form-control";
			$this->direction_in_sub10->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direction_in_sub10->CurrentValue = HtmlDecode($this->direction_in_sub10->CurrentValue);
			$this->direction_in_sub10->EditValue = HtmlEncode($this->direction_in_sub10->CurrentValue);
			$this->direction_in_sub10->PlaceHolder = RemoveHtml($this->direction_in_sub10->caption());

			// transmit_no_in_sub10
			$this->transmit_no_in_sub10->EditAttrs["class"] = "form-control";
			$this->transmit_no_in_sub10->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->transmit_no_in_sub10->CurrentValue = HtmlDecode($this->transmit_no_in_sub10->CurrentValue);
			$this->transmit_no_in_sub10->EditValue = HtmlEncode($this->transmit_no_in_sub10->CurrentValue);
			$this->transmit_no_in_sub10->PlaceHolder = RemoveHtml($this->transmit_no_in_sub10->caption());

			// approval_status_in_sub10
			$this->approval_status_in_sub10->EditAttrs["class"] = "form-control";
			$this->approval_status_in_sub10->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->approval_status_in_sub10->CurrentValue = HtmlDecode($this->approval_status_in_sub10->CurrentValue);
			$this->approval_status_in_sub10->EditValue = HtmlEncode($this->approval_status_in_sub10->CurrentValue);
			$this->approval_status_in_sub10->PlaceHolder = RemoveHtml($this->approval_status_in_sub10->caption());

			// transmit_date_in_sub10
			$this->transmit_date_in_sub10->EditAttrs["class"] = "form-control";
			$this->transmit_date_in_sub10->EditCustomAttributes = "";
			$this->transmit_date_in_sub10->EditValue = HtmlEncode(FormatDateTime($this->transmit_date_in_sub10->CurrentValue, 8));
			$this->transmit_date_in_sub10->PlaceHolder = RemoveHtml($this->transmit_date_in_sub10->caption());

			// log_updatedon
			$this->log_updatedon->EditAttrs["class"] = "form-control";
			$this->log_updatedon->EditCustomAttributes = "";
			$this->log_updatedon->EditValue = HtmlEncode(FormatDateTime($this->log_updatedon->CurrentValue, 8));
			$this->log_updatedon->PlaceHolder = RemoveHtml($this->log_updatedon->caption());

			// Edit refer script
			// log_id

			$this->log_id->LinkCustomAttributes = "";
			$this->log_id->HrefValue = "";

			// firelink_doc_no
			$this->firelink_doc_no->LinkCustomAttributes = "";
			$this->firelink_doc_no->HrefValue = "";

			// project_name
			$this->project_name->LinkCustomAttributes = "";
			$this->project_name->HrefValue = "";

			// document_tittle
			$this->document_tittle->LinkCustomAttributes = "";
			$this->document_tittle->HrefValue = "";

			// current_status
			$this->current_status->LinkCustomAttributes = "";
			$this->current_status->HrefValue = "";

			// submit_no_sub1
			$this->submit_no_sub1->LinkCustomAttributes = "";
			$this->submit_no_sub1->HrefValue = "";

			// revision_no_sub1
			$this->revision_no_sub1->LinkCustomAttributes = "";
			$this->revision_no_sub1->HrefValue = "";

			// direction_out_sub1
			$this->direction_out_sub1->LinkCustomAttributes = "";
			$this->direction_out_sub1->HrefValue = "";

			// planned_date_out_sub1
			$this->planned_date_out_sub1->LinkCustomAttributes = "";
			$this->planned_date_out_sub1->HrefValue = "";

			// transmit_date_out_sub1
			$this->transmit_date_out_sub1->LinkCustomAttributes = "";
			$this->transmit_date_out_sub1->HrefValue = "";

			// transmit_no_out_sub1
			$this->transmit_no_out_sub1->LinkCustomAttributes = "";
			$this->transmit_no_out_sub1->HrefValue = "";

			// approval_status_out_sub1
			$this->approval_status_out_sub1->LinkCustomAttributes = "";
			$this->approval_status_out_sub1->HrefValue = "";

			// direction_out_file_sub1
			$this->direction_out_file_sub1->LinkCustomAttributes = "";
			$this->direction_out_file_sub1->HrefValue = "";

			// direction_in_sub1
			$this->direction_in_sub1->LinkCustomAttributes = "";
			$this->direction_in_sub1->HrefValue = "";

			// transmit_no_in_sub1
			$this->transmit_no_in_sub1->LinkCustomAttributes = "";
			$this->transmit_no_in_sub1->HrefValue = "";

			// approval_status_in_sub1
			$this->approval_status_in_sub1->LinkCustomAttributes = "";
			$this->approval_status_in_sub1->HrefValue = "";

			// transmit_date_in_sub1
			$this->transmit_date_in_sub1->LinkCustomAttributes = "";
			$this->transmit_date_in_sub1->HrefValue = "";

			// submit_no_sub2
			$this->submit_no_sub2->LinkCustomAttributes = "";
			$this->submit_no_sub2->HrefValue = "";

			// revision_no_sub2
			$this->revision_no_sub2->LinkCustomAttributes = "";
			$this->revision_no_sub2->HrefValue = "";

			// direction_out_sub2
			$this->direction_out_sub2->LinkCustomAttributes = "";
			$this->direction_out_sub2->HrefValue = "";

			// planned_date_out_sub2
			$this->planned_date_out_sub2->LinkCustomAttributes = "";
			$this->planned_date_out_sub2->HrefValue = "";

			// transmit_date_out_sub2
			$this->transmit_date_out_sub2->LinkCustomAttributes = "";
			$this->transmit_date_out_sub2->HrefValue = "";

			// transmit_no_out_sub2
			$this->transmit_no_out_sub2->LinkCustomAttributes = "";
			$this->transmit_no_out_sub2->HrefValue = "";

			// approval_status_out_sub2
			$this->approval_status_out_sub2->LinkCustomAttributes = "";
			$this->approval_status_out_sub2->HrefValue = "";

			// direction_in_sub2
			$this->direction_in_sub2->LinkCustomAttributes = "";
			$this->direction_in_sub2->HrefValue = "";

			// transmit_no_in_sub2
			$this->transmit_no_in_sub2->LinkCustomAttributes = "";
			$this->transmit_no_in_sub2->HrefValue = "";

			// approval_status_in_sub2
			$this->approval_status_in_sub2->LinkCustomAttributes = "";
			$this->approval_status_in_sub2->HrefValue = "";

			// transmit_date_in_sub2
			$this->transmit_date_in_sub2->LinkCustomAttributes = "";
			$this->transmit_date_in_sub2->HrefValue = "";

			// submit_no_sub3
			$this->submit_no_sub3->LinkCustomAttributes = "";
			$this->submit_no_sub3->HrefValue = "";

			// revision_no_sub3
			$this->revision_no_sub3->LinkCustomAttributes = "";
			$this->revision_no_sub3->HrefValue = "";

			// direction_out_sub3
			$this->direction_out_sub3->LinkCustomAttributes = "";
			$this->direction_out_sub3->HrefValue = "";

			// planned_date_out_sub3
			$this->planned_date_out_sub3->LinkCustomAttributes = "";
			$this->planned_date_out_sub3->HrefValue = "";

			// transmit_date_out_sub3
			$this->transmit_date_out_sub3->LinkCustomAttributes = "";
			$this->transmit_date_out_sub3->HrefValue = "";

			// transmit_no_out_sub3
			$this->transmit_no_out_sub3->LinkCustomAttributes = "";
			$this->transmit_no_out_sub3->HrefValue = "";

			// approval_status_out_sub3
			$this->approval_status_out_sub3->LinkCustomAttributes = "";
			$this->approval_status_out_sub3->HrefValue = "";

			// direction_in_sub3
			$this->direction_in_sub3->LinkCustomAttributes = "";
			$this->direction_in_sub3->HrefValue = "";

			// transmit_no_in_sub3
			$this->transmit_no_in_sub3->LinkCustomAttributes = "";
			$this->transmit_no_in_sub3->HrefValue = "";

			// approval_status_in_sub3
			$this->approval_status_in_sub3->LinkCustomAttributes = "";
			$this->approval_status_in_sub3->HrefValue = "";

			// transmit_date_in_sub3
			$this->transmit_date_in_sub3->LinkCustomAttributes = "";
			$this->transmit_date_in_sub3->HrefValue = "";

			// submit_no_sub4
			$this->submit_no_sub4->LinkCustomAttributes = "";
			$this->submit_no_sub4->HrefValue = "";

			// revision_no_sub4
			$this->revision_no_sub4->LinkCustomAttributes = "";
			$this->revision_no_sub4->HrefValue = "";

			// direction_out_sub4
			$this->direction_out_sub4->LinkCustomAttributes = "";
			$this->direction_out_sub4->HrefValue = "";

			// planned_date_out_sub4
			$this->planned_date_out_sub4->LinkCustomAttributes = "";
			$this->planned_date_out_sub4->HrefValue = "";

			// transmit_date_out_sub4
			$this->transmit_date_out_sub4->LinkCustomAttributes = "";
			$this->transmit_date_out_sub4->HrefValue = "";

			// transmit_no_out_sub4
			$this->transmit_no_out_sub4->LinkCustomAttributes = "";
			$this->transmit_no_out_sub4->HrefValue = "";

			// approval_status_out_sub4
			$this->approval_status_out_sub4->LinkCustomAttributes = "";
			$this->approval_status_out_sub4->HrefValue = "";

			// direction_in_sub4
			$this->direction_in_sub4->LinkCustomAttributes = "";
			$this->direction_in_sub4->HrefValue = "";

			// transmit_no_in_sub4
			$this->transmit_no_in_sub4->LinkCustomAttributes = "";
			$this->transmit_no_in_sub4->HrefValue = "";

			// approval_status_in_sub4
			$this->approval_status_in_sub4->LinkCustomAttributes = "";
			$this->approval_status_in_sub4->HrefValue = "";

			// direction_in_file_sub4
			$this->direction_in_file_sub4->LinkCustomAttributes = "";
			$this->direction_in_file_sub4->HrefValue = "";

			// transmit_date_in_sub4
			$this->transmit_date_in_sub4->LinkCustomAttributes = "";
			$this->transmit_date_in_sub4->HrefValue = "";

			// submit_no_sub5
			$this->submit_no_sub5->LinkCustomAttributes = "";
			$this->submit_no_sub5->HrefValue = "";

			// revision_no_sub5
			$this->revision_no_sub5->LinkCustomAttributes = "";
			$this->revision_no_sub5->HrefValue = "";

			// direction_out_sub5
			$this->direction_out_sub5->LinkCustomAttributes = "";
			$this->direction_out_sub5->HrefValue = "";

			// planned_date_out_sub5
			$this->planned_date_out_sub5->LinkCustomAttributes = "";
			$this->planned_date_out_sub5->HrefValue = "";

			// transmit_date_out_sub5
			$this->transmit_date_out_sub5->LinkCustomAttributes = "";
			$this->transmit_date_out_sub5->HrefValue = "";

			// transmit_no_out_sub5
			$this->transmit_no_out_sub5->LinkCustomAttributes = "";
			$this->transmit_no_out_sub5->HrefValue = "";

			// approval_status_out_sub5
			$this->approval_status_out_sub5->LinkCustomAttributes = "";
			$this->approval_status_out_sub5->HrefValue = "";

			// direction_in_sub5
			$this->direction_in_sub5->LinkCustomAttributes = "";
			$this->direction_in_sub5->HrefValue = "";

			// transmit_no_in_sub5
			$this->transmit_no_in_sub5->LinkCustomAttributes = "";
			$this->transmit_no_in_sub5->HrefValue = "";

			// approval_status_in_sub5
			$this->approval_status_in_sub5->LinkCustomAttributes = "";
			$this->approval_status_in_sub5->HrefValue = "";

			// direction_in_file_sub5
			$this->direction_in_file_sub5->LinkCustomAttributes = "";
			$this->direction_in_file_sub5->HrefValue = "";

			// transmit_date_in_sub5
			$this->transmit_date_in_sub5->LinkCustomAttributes = "";
			$this->transmit_date_in_sub5->HrefValue = "";

			// submit_no_sub6
			$this->submit_no_sub6->LinkCustomAttributes = "";
			$this->submit_no_sub6->HrefValue = "";

			// revision_no_sub6
			$this->revision_no_sub6->LinkCustomAttributes = "";
			$this->revision_no_sub6->HrefValue = "";

			// direction_out_sub6
			$this->direction_out_sub6->LinkCustomAttributes = "";
			$this->direction_out_sub6->HrefValue = "";

			// planned_date_out_sub6
			$this->planned_date_out_sub6->LinkCustomAttributes = "";
			$this->planned_date_out_sub6->HrefValue = "";

			// transmit_date_out_sub6
			$this->transmit_date_out_sub6->LinkCustomAttributes = "";
			$this->transmit_date_out_sub6->HrefValue = "";

			// transmit_no_out_sub6
			$this->transmit_no_out_sub6->LinkCustomAttributes = "";
			$this->transmit_no_out_sub6->HrefValue = "";

			// approval_status_out_sub6
			$this->approval_status_out_sub6->LinkCustomAttributes = "";
			$this->approval_status_out_sub6->HrefValue = "";

			// direction_in_sub6
			$this->direction_in_sub6->LinkCustomAttributes = "";
			$this->direction_in_sub6->HrefValue = "";

			// transmit_no_in_sub6
			$this->transmit_no_in_sub6->LinkCustomAttributes = "";
			$this->transmit_no_in_sub6->HrefValue = "";

			// approval_status_in_sub6
			$this->approval_status_in_sub6->LinkCustomAttributes = "";
			$this->approval_status_in_sub6->HrefValue = "";

			// direction_in_file_sub6
			$this->direction_in_file_sub6->LinkCustomAttributes = "";
			$this->direction_in_file_sub6->HrefValue = "";

			// transmit_date_in_sub6
			$this->transmit_date_in_sub6->LinkCustomAttributes = "";
			$this->transmit_date_in_sub6->HrefValue = "";

			// submit_no_sub7
			$this->submit_no_sub7->LinkCustomAttributes = "";
			$this->submit_no_sub7->HrefValue = "";

			// revision_no_sub7
			$this->revision_no_sub7->LinkCustomAttributes = "";
			$this->revision_no_sub7->HrefValue = "";

			// direction_out_sub7
			$this->direction_out_sub7->LinkCustomAttributes = "";
			$this->direction_out_sub7->HrefValue = "";

			// planned_date_out_sub7
			$this->planned_date_out_sub7->LinkCustomAttributes = "";
			$this->planned_date_out_sub7->HrefValue = "";

			// transmit_date_out_sub7
			$this->transmit_date_out_sub7->LinkCustomAttributes = "";
			$this->transmit_date_out_sub7->HrefValue = "";

			// transmit_no_out_sub7
			$this->transmit_no_out_sub7->LinkCustomAttributes = "";
			$this->transmit_no_out_sub7->HrefValue = "";

			// approval_status_out_sub7
			$this->approval_status_out_sub7->LinkCustomAttributes = "";
			$this->approval_status_out_sub7->HrefValue = "";

			// direction_in_sub7
			$this->direction_in_sub7->LinkCustomAttributes = "";
			$this->direction_in_sub7->HrefValue = "";

			// transmit_no_in_sub7
			$this->transmit_no_in_sub7->LinkCustomAttributes = "";
			$this->transmit_no_in_sub7->HrefValue = "";

			// approval_status_in_sub7
			$this->approval_status_in_sub7->LinkCustomAttributes = "";
			$this->approval_status_in_sub7->HrefValue = "";

			// transmit_date_in_sub7
			$this->transmit_date_in_sub7->LinkCustomAttributes = "";
			$this->transmit_date_in_sub7->HrefValue = "";

			// submit_no_sub8
			$this->submit_no_sub8->LinkCustomAttributes = "";
			$this->submit_no_sub8->HrefValue = "";

			// revision_no_sub8
			$this->revision_no_sub8->LinkCustomAttributes = "";
			$this->revision_no_sub8->HrefValue = "";

			// direction_out_sub8
			$this->direction_out_sub8->LinkCustomAttributes = "";
			$this->direction_out_sub8->HrefValue = "";

			// planned_date_out_sub8
			$this->planned_date_out_sub8->LinkCustomAttributes = "";
			$this->planned_date_out_sub8->HrefValue = "";

			// transmit_date_out_sub8
			$this->transmit_date_out_sub8->LinkCustomAttributes = "";
			$this->transmit_date_out_sub8->HrefValue = "";

			// transmit_no_out_sub8
			$this->transmit_no_out_sub8->LinkCustomAttributes = "";
			$this->transmit_no_out_sub8->HrefValue = "";

			// approval_status_out_sub8
			$this->approval_status_out_sub8->LinkCustomAttributes = "";
			$this->approval_status_out_sub8->HrefValue = "";

			// direction_out_file_sub8
			$this->direction_out_file_sub8->LinkCustomAttributes = "";
			$this->direction_out_file_sub8->HrefValue = "";

			// direction_in_sub8
			$this->direction_in_sub8->LinkCustomAttributes = "";
			$this->direction_in_sub8->HrefValue = "";

			// transmit_no_in_sub8
			$this->transmit_no_in_sub8->LinkCustomAttributes = "";
			$this->transmit_no_in_sub8->HrefValue = "";

			// approval_status_in_sub8
			$this->approval_status_in_sub8->LinkCustomAttributes = "";
			$this->approval_status_in_sub8->HrefValue = "";

			// transmit_date_in_sub8
			$this->transmit_date_in_sub8->LinkCustomAttributes = "";
			$this->transmit_date_in_sub8->HrefValue = "";

			// submit_no_sub9
			$this->submit_no_sub9->LinkCustomAttributes = "";
			$this->submit_no_sub9->HrefValue = "";

			// revision_no_sub9
			$this->revision_no_sub9->LinkCustomAttributes = "";
			$this->revision_no_sub9->HrefValue = "";

			// direction_out_sub9
			$this->direction_out_sub9->LinkCustomAttributes = "";
			$this->direction_out_sub9->HrefValue = "";

			// planned_date_out_sub9
			$this->planned_date_out_sub9->LinkCustomAttributes = "";
			$this->planned_date_out_sub9->HrefValue = "";

			// transmit_date_out_sub9
			$this->transmit_date_out_sub9->LinkCustomAttributes = "";
			$this->transmit_date_out_sub9->HrefValue = "";

			// transmit_no_out_sub9
			$this->transmit_no_out_sub9->LinkCustomAttributes = "";
			$this->transmit_no_out_sub9->HrefValue = "";

			// approval_status_out_sub9
			$this->approval_status_out_sub9->LinkCustomAttributes = "";
			$this->approval_status_out_sub9->HrefValue = "";

			// direction_in_sub9
			$this->direction_in_sub9->LinkCustomAttributes = "";
			$this->direction_in_sub9->HrefValue = "";

			// transmit_no_in_sub9
			$this->transmit_no_in_sub9->LinkCustomAttributes = "";
			$this->transmit_no_in_sub9->HrefValue = "";

			// approval_status_in_sub9
			$this->approval_status_in_sub9->LinkCustomAttributes = "";
			$this->approval_status_in_sub9->HrefValue = "";

			// transmit_date_in_sub9
			$this->transmit_date_in_sub9->LinkCustomAttributes = "";
			$this->transmit_date_in_sub9->HrefValue = "";

			// submit_no_sub10
			$this->submit_no_sub10->LinkCustomAttributes = "";
			$this->submit_no_sub10->HrefValue = "";

			// revision_no_sub10
			$this->revision_no_sub10->LinkCustomAttributes = "";
			$this->revision_no_sub10->HrefValue = "";

			// direction_out_sub10
			$this->direction_out_sub10->LinkCustomAttributes = "";
			$this->direction_out_sub10->HrefValue = "";

			// planned_date_out_sub10
			$this->planned_date_out_sub10->LinkCustomAttributes = "";
			$this->planned_date_out_sub10->HrefValue = "";

			// transmit_date_out_sub10
			$this->transmit_date_out_sub10->LinkCustomAttributes = "";
			$this->transmit_date_out_sub10->HrefValue = "";

			// transmit_no_out_sub10
			$this->transmit_no_out_sub10->LinkCustomAttributes = "";
			$this->transmit_no_out_sub10->HrefValue = "";

			// approval_status_out_sub10
			$this->approval_status_out_sub10->LinkCustomAttributes = "";
			$this->approval_status_out_sub10->HrefValue = "";

			// direction_in_sub10
			$this->direction_in_sub10->LinkCustomAttributes = "";
			$this->direction_in_sub10->HrefValue = "";

			// transmit_no_in_sub10
			$this->transmit_no_in_sub10->LinkCustomAttributes = "";
			$this->transmit_no_in_sub10->HrefValue = "";

			// approval_status_in_sub10
			$this->approval_status_in_sub10->LinkCustomAttributes = "";
			$this->approval_status_in_sub10->HrefValue = "";

			// transmit_date_in_sub10
			$this->transmit_date_in_sub10->LinkCustomAttributes = "";
			$this->transmit_date_in_sub10->HrefValue = "";

			// log_updatedon
			$this->log_updatedon->LinkCustomAttributes = "";
			$this->log_updatedon->HrefValue = "";
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
		if ($this->log_id->Required) {
			if (!$this->log_id->IsDetailKey && $this->log_id->FormValue != NULL && $this->log_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->log_id->caption(), $this->log_id->RequiredErrorMessage));
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
		if ($this->current_status->Required) {
			if (!$this->current_status->IsDetailKey && $this->current_status->FormValue != NULL && $this->current_status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->current_status->caption(), $this->current_status->RequiredErrorMessage));
			}
		}
		if ($this->current_status_file->Required) {
			if (!$this->current_status_file->IsDetailKey && $this->current_status_file->FormValue != NULL && $this->current_status_file->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->current_status_file->caption(), $this->current_status_file->RequiredErrorMessage));
			}
		}
		if ($this->submit_no_sub1->Required) {
			if (!$this->submit_no_sub1->IsDetailKey && $this->submit_no_sub1->FormValue != NULL && $this->submit_no_sub1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->submit_no_sub1->caption(), $this->submit_no_sub1->RequiredErrorMessage));
			}
		}
		if ($this->revision_no_sub1->Required) {
			if (!$this->revision_no_sub1->IsDetailKey && $this->revision_no_sub1->FormValue != NULL && $this->revision_no_sub1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->revision_no_sub1->caption(), $this->revision_no_sub1->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_sub1->Required) {
			if (!$this->direction_out_sub1->IsDetailKey && $this->direction_out_sub1->FormValue != NULL && $this->direction_out_sub1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_sub1->caption(), $this->direction_out_sub1->RequiredErrorMessage));
			}
		}
		if ($this->planned_date_out_sub1->Required) {
			if (!$this->planned_date_out_sub1->IsDetailKey && $this->planned_date_out_sub1->FormValue != NULL && $this->planned_date_out_sub1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->planned_date_out_sub1->caption(), $this->planned_date_out_sub1->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->planned_date_out_sub1->FormValue)) {
			AddMessage($FormError, $this->planned_date_out_sub1->errorMessage());
		}
		if ($this->transmit_date_out_sub1->Required) {
			if (!$this->transmit_date_out_sub1->IsDetailKey && $this->transmit_date_out_sub1->FormValue != NULL && $this->transmit_date_out_sub1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_out_sub1->caption(), $this->transmit_date_out_sub1->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_out_sub1->FormValue)) {
			AddMessage($FormError, $this->transmit_date_out_sub1->errorMessage());
		}
		if ($this->transmit_no_out_sub1->Required) {
			if (!$this->transmit_no_out_sub1->IsDetailKey && $this->transmit_no_out_sub1->FormValue != NULL && $this->transmit_no_out_sub1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_out_sub1->caption(), $this->transmit_no_out_sub1->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_out_sub1->Required) {
			if (!$this->approval_status_out_sub1->IsDetailKey && $this->approval_status_out_sub1->FormValue != NULL && $this->approval_status_out_sub1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_out_sub1->caption(), $this->approval_status_out_sub1->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_file_sub1->Required) {
			if (!$this->direction_out_file_sub1->IsDetailKey && $this->direction_out_file_sub1->FormValue != NULL && $this->direction_out_file_sub1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_file_sub1->caption(), $this->direction_out_file_sub1->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_sub1->Required) {
			if (!$this->direction_in_sub1->IsDetailKey && $this->direction_in_sub1->FormValue != NULL && $this->direction_in_sub1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_sub1->caption(), $this->direction_in_sub1->RequiredErrorMessage));
			}
		}
		if ($this->transmit_no_in_sub1->Required) {
			if (!$this->transmit_no_in_sub1->IsDetailKey && $this->transmit_no_in_sub1->FormValue != NULL && $this->transmit_no_in_sub1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_in_sub1->caption(), $this->transmit_no_in_sub1->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_in_sub1->Required) {
			if (!$this->approval_status_in_sub1->IsDetailKey && $this->approval_status_in_sub1->FormValue != NULL && $this->approval_status_in_sub1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_in_sub1->caption(), $this->approval_status_in_sub1->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_file_sub1->Required) {
			if (!$this->direction_in_file_sub1->IsDetailKey && $this->direction_in_file_sub1->FormValue != NULL && $this->direction_in_file_sub1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_file_sub1->caption(), $this->direction_in_file_sub1->RequiredErrorMessage));
			}
		}
		if ($this->transmit_date_in_sub1->Required) {
			if (!$this->transmit_date_in_sub1->IsDetailKey && $this->transmit_date_in_sub1->FormValue != NULL && $this->transmit_date_in_sub1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_in_sub1->caption(), $this->transmit_date_in_sub1->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_in_sub1->FormValue)) {
			AddMessage($FormError, $this->transmit_date_in_sub1->errorMessage());
		}
		if ($this->submit_no_sub2->Required) {
			if (!$this->submit_no_sub2->IsDetailKey && $this->submit_no_sub2->FormValue != NULL && $this->submit_no_sub2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->submit_no_sub2->caption(), $this->submit_no_sub2->RequiredErrorMessage));
			}
		}
		if ($this->revision_no_sub2->Required) {
			if (!$this->revision_no_sub2->IsDetailKey && $this->revision_no_sub2->FormValue != NULL && $this->revision_no_sub2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->revision_no_sub2->caption(), $this->revision_no_sub2->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_sub2->Required) {
			if (!$this->direction_out_sub2->IsDetailKey && $this->direction_out_sub2->FormValue != NULL && $this->direction_out_sub2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_sub2->caption(), $this->direction_out_sub2->RequiredErrorMessage));
			}
		}
		if ($this->planned_date_out_sub2->Required) {
			if (!$this->planned_date_out_sub2->IsDetailKey && $this->planned_date_out_sub2->FormValue != NULL && $this->planned_date_out_sub2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->planned_date_out_sub2->caption(), $this->planned_date_out_sub2->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->planned_date_out_sub2->FormValue)) {
			AddMessage($FormError, $this->planned_date_out_sub2->errorMessage());
		}
		if ($this->transmit_date_out_sub2->Required) {
			if (!$this->transmit_date_out_sub2->IsDetailKey && $this->transmit_date_out_sub2->FormValue != NULL && $this->transmit_date_out_sub2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_out_sub2->caption(), $this->transmit_date_out_sub2->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_out_sub2->FormValue)) {
			AddMessage($FormError, $this->transmit_date_out_sub2->errorMessage());
		}
		if ($this->transmit_no_out_sub2->Required) {
			if (!$this->transmit_no_out_sub2->IsDetailKey && $this->transmit_no_out_sub2->FormValue != NULL && $this->transmit_no_out_sub2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_out_sub2->caption(), $this->transmit_no_out_sub2->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_out_sub2->Required) {
			if (!$this->approval_status_out_sub2->IsDetailKey && $this->approval_status_out_sub2->FormValue != NULL && $this->approval_status_out_sub2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_out_sub2->caption(), $this->approval_status_out_sub2->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_file_sub2->Required) {
			if (!$this->direction_out_file_sub2->IsDetailKey && $this->direction_out_file_sub2->FormValue != NULL && $this->direction_out_file_sub2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_file_sub2->caption(), $this->direction_out_file_sub2->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_sub2->Required) {
			if (!$this->direction_in_sub2->IsDetailKey && $this->direction_in_sub2->FormValue != NULL && $this->direction_in_sub2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_sub2->caption(), $this->direction_in_sub2->RequiredErrorMessage));
			}
		}
		if ($this->transmit_no_in_sub2->Required) {
			if (!$this->transmit_no_in_sub2->IsDetailKey && $this->transmit_no_in_sub2->FormValue != NULL && $this->transmit_no_in_sub2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_in_sub2->caption(), $this->transmit_no_in_sub2->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_in_sub2->Required) {
			if (!$this->approval_status_in_sub2->IsDetailKey && $this->approval_status_in_sub2->FormValue != NULL && $this->approval_status_in_sub2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_in_sub2->caption(), $this->approval_status_in_sub2->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_file_sub2->Required) {
			if (!$this->direction_in_file_sub2->IsDetailKey && $this->direction_in_file_sub2->FormValue != NULL && $this->direction_in_file_sub2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_file_sub2->caption(), $this->direction_in_file_sub2->RequiredErrorMessage));
			}
		}
		if ($this->transmit_date_in_sub2->Required) {
			if (!$this->transmit_date_in_sub2->IsDetailKey && $this->transmit_date_in_sub2->FormValue != NULL && $this->transmit_date_in_sub2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_in_sub2->caption(), $this->transmit_date_in_sub2->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_in_sub2->FormValue)) {
			AddMessage($FormError, $this->transmit_date_in_sub2->errorMessage());
		}
		if ($this->submit_no_sub3->Required) {
			if (!$this->submit_no_sub3->IsDetailKey && $this->submit_no_sub3->FormValue != NULL && $this->submit_no_sub3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->submit_no_sub3->caption(), $this->submit_no_sub3->RequiredErrorMessage));
			}
		}
		if ($this->revision_no_sub3->Required) {
			if (!$this->revision_no_sub3->IsDetailKey && $this->revision_no_sub3->FormValue != NULL && $this->revision_no_sub3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->revision_no_sub3->caption(), $this->revision_no_sub3->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_sub3->Required) {
			if (!$this->direction_out_sub3->IsDetailKey && $this->direction_out_sub3->FormValue != NULL && $this->direction_out_sub3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_sub3->caption(), $this->direction_out_sub3->RequiredErrorMessage));
			}
		}
		if ($this->planned_date_out_sub3->Required) {
			if (!$this->planned_date_out_sub3->IsDetailKey && $this->planned_date_out_sub3->FormValue != NULL && $this->planned_date_out_sub3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->planned_date_out_sub3->caption(), $this->planned_date_out_sub3->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->planned_date_out_sub3->FormValue)) {
			AddMessage($FormError, $this->planned_date_out_sub3->errorMessage());
		}
		if ($this->transmit_date_out_sub3->Required) {
			if (!$this->transmit_date_out_sub3->IsDetailKey && $this->transmit_date_out_sub3->FormValue != NULL && $this->transmit_date_out_sub3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_out_sub3->caption(), $this->transmit_date_out_sub3->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_out_sub3->FormValue)) {
			AddMessage($FormError, $this->transmit_date_out_sub3->errorMessage());
		}
		if ($this->transmit_no_out_sub3->Required) {
			if (!$this->transmit_no_out_sub3->IsDetailKey && $this->transmit_no_out_sub3->FormValue != NULL && $this->transmit_no_out_sub3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_out_sub3->caption(), $this->transmit_no_out_sub3->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_out_sub3->Required) {
			if (!$this->approval_status_out_sub3->IsDetailKey && $this->approval_status_out_sub3->FormValue != NULL && $this->approval_status_out_sub3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_out_sub3->caption(), $this->approval_status_out_sub3->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_file_sub3->Required) {
			if (!$this->direction_out_file_sub3->IsDetailKey && $this->direction_out_file_sub3->FormValue != NULL && $this->direction_out_file_sub3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_file_sub3->caption(), $this->direction_out_file_sub3->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_sub3->Required) {
			if (!$this->direction_in_sub3->IsDetailKey && $this->direction_in_sub3->FormValue != NULL && $this->direction_in_sub3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_sub3->caption(), $this->direction_in_sub3->RequiredErrorMessage));
			}
		}
		if ($this->transmit_no_in_sub3->Required) {
			if (!$this->transmit_no_in_sub3->IsDetailKey && $this->transmit_no_in_sub3->FormValue != NULL && $this->transmit_no_in_sub3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_in_sub3->caption(), $this->transmit_no_in_sub3->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_in_sub3->Required) {
			if (!$this->approval_status_in_sub3->IsDetailKey && $this->approval_status_in_sub3->FormValue != NULL && $this->approval_status_in_sub3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_in_sub3->caption(), $this->approval_status_in_sub3->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_file_sub3->Required) {
			if (!$this->direction_in_file_sub3->IsDetailKey && $this->direction_in_file_sub3->FormValue != NULL && $this->direction_in_file_sub3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_file_sub3->caption(), $this->direction_in_file_sub3->RequiredErrorMessage));
			}
		}
		if ($this->transmit_date_in_sub3->Required) {
			if (!$this->transmit_date_in_sub3->IsDetailKey && $this->transmit_date_in_sub3->FormValue != NULL && $this->transmit_date_in_sub3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_in_sub3->caption(), $this->transmit_date_in_sub3->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_in_sub3->FormValue)) {
			AddMessage($FormError, $this->transmit_date_in_sub3->errorMessage());
		}
		if ($this->submit_no_sub4->Required) {
			if (!$this->submit_no_sub4->IsDetailKey && $this->submit_no_sub4->FormValue != NULL && $this->submit_no_sub4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->submit_no_sub4->caption(), $this->submit_no_sub4->RequiredErrorMessage));
			}
		}
		if ($this->revision_no_sub4->Required) {
			if (!$this->revision_no_sub4->IsDetailKey && $this->revision_no_sub4->FormValue != NULL && $this->revision_no_sub4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->revision_no_sub4->caption(), $this->revision_no_sub4->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_sub4->Required) {
			if (!$this->direction_out_sub4->IsDetailKey && $this->direction_out_sub4->FormValue != NULL && $this->direction_out_sub4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_sub4->caption(), $this->direction_out_sub4->RequiredErrorMessage));
			}
		}
		if ($this->planned_date_out_sub4->Required) {
			if (!$this->planned_date_out_sub4->IsDetailKey && $this->planned_date_out_sub4->FormValue != NULL && $this->planned_date_out_sub4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->planned_date_out_sub4->caption(), $this->planned_date_out_sub4->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->planned_date_out_sub4->FormValue)) {
			AddMessage($FormError, $this->planned_date_out_sub4->errorMessage());
		}
		if ($this->transmit_date_out_sub4->Required) {
			if (!$this->transmit_date_out_sub4->IsDetailKey && $this->transmit_date_out_sub4->FormValue != NULL && $this->transmit_date_out_sub4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_out_sub4->caption(), $this->transmit_date_out_sub4->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_out_sub4->FormValue)) {
			AddMessage($FormError, $this->transmit_date_out_sub4->errorMessage());
		}
		if ($this->transmit_no_out_sub4->Required) {
			if (!$this->transmit_no_out_sub4->IsDetailKey && $this->transmit_no_out_sub4->FormValue != NULL && $this->transmit_no_out_sub4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_out_sub4->caption(), $this->transmit_no_out_sub4->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_out_sub4->Required) {
			if (!$this->approval_status_out_sub4->IsDetailKey && $this->approval_status_out_sub4->FormValue != NULL && $this->approval_status_out_sub4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_out_sub4->caption(), $this->approval_status_out_sub4->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_file_sub4->Required) {
			if (!$this->direction_out_file_sub4->IsDetailKey && $this->direction_out_file_sub4->FormValue != NULL && $this->direction_out_file_sub4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_file_sub4->caption(), $this->direction_out_file_sub4->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_sub4->Required) {
			if (!$this->direction_in_sub4->IsDetailKey && $this->direction_in_sub4->FormValue != NULL && $this->direction_in_sub4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_sub4->caption(), $this->direction_in_sub4->RequiredErrorMessage));
			}
		}
		if ($this->transmit_no_in_sub4->Required) {
			if (!$this->transmit_no_in_sub4->IsDetailKey && $this->transmit_no_in_sub4->FormValue != NULL && $this->transmit_no_in_sub4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_in_sub4->caption(), $this->transmit_no_in_sub4->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_in_sub4->Required) {
			if (!$this->approval_status_in_sub4->IsDetailKey && $this->approval_status_in_sub4->FormValue != NULL && $this->approval_status_in_sub4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_in_sub4->caption(), $this->approval_status_in_sub4->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_file_sub4->Required) {
			if (!$this->direction_in_file_sub4->IsDetailKey && $this->direction_in_file_sub4->FormValue != NULL && $this->direction_in_file_sub4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_file_sub4->caption(), $this->direction_in_file_sub4->RequiredErrorMessage));
			}
		}
		if ($this->transmit_date_in_sub4->Required) {
			if (!$this->transmit_date_in_sub4->IsDetailKey && $this->transmit_date_in_sub4->FormValue != NULL && $this->transmit_date_in_sub4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_in_sub4->caption(), $this->transmit_date_in_sub4->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_in_sub4->FormValue)) {
			AddMessage($FormError, $this->transmit_date_in_sub4->errorMessage());
		}
		if ($this->submit_no_sub5->Required) {
			if (!$this->submit_no_sub5->IsDetailKey && $this->submit_no_sub5->FormValue != NULL && $this->submit_no_sub5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->submit_no_sub5->caption(), $this->submit_no_sub5->RequiredErrorMessage));
			}
		}
		if ($this->revision_no_sub5->Required) {
			if (!$this->revision_no_sub5->IsDetailKey && $this->revision_no_sub5->FormValue != NULL && $this->revision_no_sub5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->revision_no_sub5->caption(), $this->revision_no_sub5->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_sub5->Required) {
			if (!$this->direction_out_sub5->IsDetailKey && $this->direction_out_sub5->FormValue != NULL && $this->direction_out_sub5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_sub5->caption(), $this->direction_out_sub5->RequiredErrorMessage));
			}
		}
		if ($this->planned_date_out_sub5->Required) {
			if (!$this->planned_date_out_sub5->IsDetailKey && $this->planned_date_out_sub5->FormValue != NULL && $this->planned_date_out_sub5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->planned_date_out_sub5->caption(), $this->planned_date_out_sub5->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->planned_date_out_sub5->FormValue)) {
			AddMessage($FormError, $this->planned_date_out_sub5->errorMessage());
		}
		if ($this->transmit_date_out_sub5->Required) {
			if (!$this->transmit_date_out_sub5->IsDetailKey && $this->transmit_date_out_sub5->FormValue != NULL && $this->transmit_date_out_sub5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_out_sub5->caption(), $this->transmit_date_out_sub5->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_out_sub5->FormValue)) {
			AddMessage($FormError, $this->transmit_date_out_sub5->errorMessage());
		}
		if ($this->transmit_no_out_sub5->Required) {
			if (!$this->transmit_no_out_sub5->IsDetailKey && $this->transmit_no_out_sub5->FormValue != NULL && $this->transmit_no_out_sub5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_out_sub5->caption(), $this->transmit_no_out_sub5->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_out_sub5->Required) {
			if (!$this->approval_status_out_sub5->IsDetailKey && $this->approval_status_out_sub5->FormValue != NULL && $this->approval_status_out_sub5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_out_sub5->caption(), $this->approval_status_out_sub5->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_file_sub5->Required) {
			if (!$this->direction_out_file_sub5->IsDetailKey && $this->direction_out_file_sub5->FormValue != NULL && $this->direction_out_file_sub5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_file_sub5->caption(), $this->direction_out_file_sub5->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_sub5->Required) {
			if (!$this->direction_in_sub5->IsDetailKey && $this->direction_in_sub5->FormValue != NULL && $this->direction_in_sub5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_sub5->caption(), $this->direction_in_sub5->RequiredErrorMessage));
			}
		}
		if ($this->transmit_no_in_sub5->Required) {
			if (!$this->transmit_no_in_sub5->IsDetailKey && $this->transmit_no_in_sub5->FormValue != NULL && $this->transmit_no_in_sub5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_in_sub5->caption(), $this->transmit_no_in_sub5->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_in_sub5->Required) {
			if (!$this->approval_status_in_sub5->IsDetailKey && $this->approval_status_in_sub5->FormValue != NULL && $this->approval_status_in_sub5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_in_sub5->caption(), $this->approval_status_in_sub5->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_file_sub5->Required) {
			if (!$this->direction_in_file_sub5->IsDetailKey && $this->direction_in_file_sub5->FormValue != NULL && $this->direction_in_file_sub5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_file_sub5->caption(), $this->direction_in_file_sub5->RequiredErrorMessage));
			}
		}
		if ($this->transmit_date_in_sub5->Required) {
			if (!$this->transmit_date_in_sub5->IsDetailKey && $this->transmit_date_in_sub5->FormValue != NULL && $this->transmit_date_in_sub5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_in_sub5->caption(), $this->transmit_date_in_sub5->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_in_sub5->FormValue)) {
			AddMessage($FormError, $this->transmit_date_in_sub5->errorMessage());
		}
		if ($this->submit_no_sub6->Required) {
			if (!$this->submit_no_sub6->IsDetailKey && $this->submit_no_sub6->FormValue != NULL && $this->submit_no_sub6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->submit_no_sub6->caption(), $this->submit_no_sub6->RequiredErrorMessage));
			}
		}
		if ($this->revision_no_sub6->Required) {
			if (!$this->revision_no_sub6->IsDetailKey && $this->revision_no_sub6->FormValue != NULL && $this->revision_no_sub6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->revision_no_sub6->caption(), $this->revision_no_sub6->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_sub6->Required) {
			if (!$this->direction_out_sub6->IsDetailKey && $this->direction_out_sub6->FormValue != NULL && $this->direction_out_sub6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_sub6->caption(), $this->direction_out_sub6->RequiredErrorMessage));
			}
		}
		if ($this->planned_date_out_sub6->Required) {
			if (!$this->planned_date_out_sub6->IsDetailKey && $this->planned_date_out_sub6->FormValue != NULL && $this->planned_date_out_sub6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->planned_date_out_sub6->caption(), $this->planned_date_out_sub6->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->planned_date_out_sub6->FormValue)) {
			AddMessage($FormError, $this->planned_date_out_sub6->errorMessage());
		}
		if ($this->transmit_date_out_sub6->Required) {
			if (!$this->transmit_date_out_sub6->IsDetailKey && $this->transmit_date_out_sub6->FormValue != NULL && $this->transmit_date_out_sub6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_out_sub6->caption(), $this->transmit_date_out_sub6->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_out_sub6->FormValue)) {
			AddMessage($FormError, $this->transmit_date_out_sub6->errorMessage());
		}
		if ($this->transmit_no_out_sub6->Required) {
			if (!$this->transmit_no_out_sub6->IsDetailKey && $this->transmit_no_out_sub6->FormValue != NULL && $this->transmit_no_out_sub6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_out_sub6->caption(), $this->transmit_no_out_sub6->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_out_sub6->Required) {
			if (!$this->approval_status_out_sub6->IsDetailKey && $this->approval_status_out_sub6->FormValue != NULL && $this->approval_status_out_sub6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_out_sub6->caption(), $this->approval_status_out_sub6->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_file_sub6->Required) {
			if (!$this->direction_out_file_sub6->IsDetailKey && $this->direction_out_file_sub6->FormValue != NULL && $this->direction_out_file_sub6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_file_sub6->caption(), $this->direction_out_file_sub6->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_sub6->Required) {
			if (!$this->direction_in_sub6->IsDetailKey && $this->direction_in_sub6->FormValue != NULL && $this->direction_in_sub6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_sub6->caption(), $this->direction_in_sub6->RequiredErrorMessage));
			}
		}
		if ($this->transmit_no_in_sub6->Required) {
			if (!$this->transmit_no_in_sub6->IsDetailKey && $this->transmit_no_in_sub6->FormValue != NULL && $this->transmit_no_in_sub6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_in_sub6->caption(), $this->transmit_no_in_sub6->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_in_sub6->Required) {
			if (!$this->approval_status_in_sub6->IsDetailKey && $this->approval_status_in_sub6->FormValue != NULL && $this->approval_status_in_sub6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_in_sub6->caption(), $this->approval_status_in_sub6->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_file_sub6->Required) {
			if (!$this->direction_in_file_sub6->IsDetailKey && $this->direction_in_file_sub6->FormValue != NULL && $this->direction_in_file_sub6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_file_sub6->caption(), $this->direction_in_file_sub6->RequiredErrorMessage));
			}
		}
		if ($this->transmit_date_in_sub6->Required) {
			if (!$this->transmit_date_in_sub6->IsDetailKey && $this->transmit_date_in_sub6->FormValue != NULL && $this->transmit_date_in_sub6->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_in_sub6->caption(), $this->transmit_date_in_sub6->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_in_sub6->FormValue)) {
			AddMessage($FormError, $this->transmit_date_in_sub6->errorMessage());
		}
		if ($this->submit_no_sub7->Required) {
			if (!$this->submit_no_sub7->IsDetailKey && $this->submit_no_sub7->FormValue != NULL && $this->submit_no_sub7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->submit_no_sub7->caption(), $this->submit_no_sub7->RequiredErrorMessage));
			}
		}
		if ($this->revision_no_sub7->Required) {
			if (!$this->revision_no_sub7->IsDetailKey && $this->revision_no_sub7->FormValue != NULL && $this->revision_no_sub7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->revision_no_sub7->caption(), $this->revision_no_sub7->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_sub7->Required) {
			if (!$this->direction_out_sub7->IsDetailKey && $this->direction_out_sub7->FormValue != NULL && $this->direction_out_sub7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_sub7->caption(), $this->direction_out_sub7->RequiredErrorMessage));
			}
		}
		if ($this->planned_date_out_sub7->Required) {
			if (!$this->planned_date_out_sub7->IsDetailKey && $this->planned_date_out_sub7->FormValue != NULL && $this->planned_date_out_sub7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->planned_date_out_sub7->caption(), $this->planned_date_out_sub7->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->planned_date_out_sub7->FormValue)) {
			AddMessage($FormError, $this->planned_date_out_sub7->errorMessage());
		}
		if ($this->transmit_date_out_sub7->Required) {
			if (!$this->transmit_date_out_sub7->IsDetailKey && $this->transmit_date_out_sub7->FormValue != NULL && $this->transmit_date_out_sub7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_out_sub7->caption(), $this->transmit_date_out_sub7->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_out_sub7->FormValue)) {
			AddMessage($FormError, $this->transmit_date_out_sub7->errorMessage());
		}
		if ($this->transmit_no_out_sub7->Required) {
			if (!$this->transmit_no_out_sub7->IsDetailKey && $this->transmit_no_out_sub7->FormValue != NULL && $this->transmit_no_out_sub7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_out_sub7->caption(), $this->transmit_no_out_sub7->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_out_sub7->Required) {
			if (!$this->approval_status_out_sub7->IsDetailKey && $this->approval_status_out_sub7->FormValue != NULL && $this->approval_status_out_sub7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_out_sub7->caption(), $this->approval_status_out_sub7->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_file_sub7->Required) {
			if (!$this->direction_out_file_sub7->IsDetailKey && $this->direction_out_file_sub7->FormValue != NULL && $this->direction_out_file_sub7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_file_sub7->caption(), $this->direction_out_file_sub7->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_sub7->Required) {
			if (!$this->direction_in_sub7->IsDetailKey && $this->direction_in_sub7->FormValue != NULL && $this->direction_in_sub7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_sub7->caption(), $this->direction_in_sub7->RequiredErrorMessage));
			}
		}
		if ($this->transmit_no_in_sub7->Required) {
			if (!$this->transmit_no_in_sub7->IsDetailKey && $this->transmit_no_in_sub7->FormValue != NULL && $this->transmit_no_in_sub7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_in_sub7->caption(), $this->transmit_no_in_sub7->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_in_sub7->Required) {
			if (!$this->approval_status_in_sub7->IsDetailKey && $this->approval_status_in_sub7->FormValue != NULL && $this->approval_status_in_sub7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_in_sub7->caption(), $this->approval_status_in_sub7->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_file_sub7->Required) {
			if (!$this->direction_in_file_sub7->IsDetailKey && $this->direction_in_file_sub7->FormValue != NULL && $this->direction_in_file_sub7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_file_sub7->caption(), $this->direction_in_file_sub7->RequiredErrorMessage));
			}
		}
		if ($this->transmit_date_in_sub7->Required) {
			if (!$this->transmit_date_in_sub7->IsDetailKey && $this->transmit_date_in_sub7->FormValue != NULL && $this->transmit_date_in_sub7->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_in_sub7->caption(), $this->transmit_date_in_sub7->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_in_sub7->FormValue)) {
			AddMessage($FormError, $this->transmit_date_in_sub7->errorMessage());
		}
		if ($this->submit_no_sub8->Required) {
			if (!$this->submit_no_sub8->IsDetailKey && $this->submit_no_sub8->FormValue != NULL && $this->submit_no_sub8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->submit_no_sub8->caption(), $this->submit_no_sub8->RequiredErrorMessage));
			}
		}
		if ($this->revision_no_sub8->Required) {
			if (!$this->revision_no_sub8->IsDetailKey && $this->revision_no_sub8->FormValue != NULL && $this->revision_no_sub8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->revision_no_sub8->caption(), $this->revision_no_sub8->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_sub8->Required) {
			if (!$this->direction_out_sub8->IsDetailKey && $this->direction_out_sub8->FormValue != NULL && $this->direction_out_sub8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_sub8->caption(), $this->direction_out_sub8->RequiredErrorMessage));
			}
		}
		if ($this->planned_date_out_sub8->Required) {
			if (!$this->planned_date_out_sub8->IsDetailKey && $this->planned_date_out_sub8->FormValue != NULL && $this->planned_date_out_sub8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->planned_date_out_sub8->caption(), $this->planned_date_out_sub8->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->planned_date_out_sub8->FormValue)) {
			AddMessage($FormError, $this->planned_date_out_sub8->errorMessage());
		}
		if ($this->transmit_date_out_sub8->Required) {
			if (!$this->transmit_date_out_sub8->IsDetailKey && $this->transmit_date_out_sub8->FormValue != NULL && $this->transmit_date_out_sub8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_out_sub8->caption(), $this->transmit_date_out_sub8->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_out_sub8->FormValue)) {
			AddMessage($FormError, $this->transmit_date_out_sub8->errorMessage());
		}
		if ($this->transmit_no_out_sub8->Required) {
			if (!$this->transmit_no_out_sub8->IsDetailKey && $this->transmit_no_out_sub8->FormValue != NULL && $this->transmit_no_out_sub8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_out_sub8->caption(), $this->transmit_no_out_sub8->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_out_sub8->Required) {
			if (!$this->approval_status_out_sub8->IsDetailKey && $this->approval_status_out_sub8->FormValue != NULL && $this->approval_status_out_sub8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_out_sub8->caption(), $this->approval_status_out_sub8->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_file_sub8->Required) {
			if (!$this->direction_out_file_sub8->IsDetailKey && $this->direction_out_file_sub8->FormValue != NULL && $this->direction_out_file_sub8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_file_sub8->caption(), $this->direction_out_file_sub8->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_sub8->Required) {
			if (!$this->direction_in_sub8->IsDetailKey && $this->direction_in_sub8->FormValue != NULL && $this->direction_in_sub8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_sub8->caption(), $this->direction_in_sub8->RequiredErrorMessage));
			}
		}
		if ($this->transmit_no_in_sub8->Required) {
			if (!$this->transmit_no_in_sub8->IsDetailKey && $this->transmit_no_in_sub8->FormValue != NULL && $this->transmit_no_in_sub8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_in_sub8->caption(), $this->transmit_no_in_sub8->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_in_sub8->Required) {
			if (!$this->approval_status_in_sub8->IsDetailKey && $this->approval_status_in_sub8->FormValue != NULL && $this->approval_status_in_sub8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_in_sub8->caption(), $this->approval_status_in_sub8->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_file_sub8->Required) {
			if (!$this->direction_in_file_sub8->IsDetailKey && $this->direction_in_file_sub8->FormValue != NULL && $this->direction_in_file_sub8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_file_sub8->caption(), $this->direction_in_file_sub8->RequiredErrorMessage));
			}
		}
		if ($this->transmit_date_in_sub8->Required) {
			if (!$this->transmit_date_in_sub8->IsDetailKey && $this->transmit_date_in_sub8->FormValue != NULL && $this->transmit_date_in_sub8->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_in_sub8->caption(), $this->transmit_date_in_sub8->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_in_sub8->FormValue)) {
			AddMessage($FormError, $this->transmit_date_in_sub8->errorMessage());
		}
		if ($this->submit_no_sub9->Required) {
			if (!$this->submit_no_sub9->IsDetailKey && $this->submit_no_sub9->FormValue != NULL && $this->submit_no_sub9->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->submit_no_sub9->caption(), $this->submit_no_sub9->RequiredErrorMessage));
			}
		}
		if ($this->revision_no_sub9->Required) {
			if (!$this->revision_no_sub9->IsDetailKey && $this->revision_no_sub9->FormValue != NULL && $this->revision_no_sub9->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->revision_no_sub9->caption(), $this->revision_no_sub9->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_sub9->Required) {
			if (!$this->direction_out_sub9->IsDetailKey && $this->direction_out_sub9->FormValue != NULL && $this->direction_out_sub9->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_sub9->caption(), $this->direction_out_sub9->RequiredErrorMessage));
			}
		}
		if ($this->planned_date_out_sub9->Required) {
			if (!$this->planned_date_out_sub9->IsDetailKey && $this->planned_date_out_sub9->FormValue != NULL && $this->planned_date_out_sub9->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->planned_date_out_sub9->caption(), $this->planned_date_out_sub9->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->planned_date_out_sub9->FormValue)) {
			AddMessage($FormError, $this->planned_date_out_sub9->errorMessage());
		}
		if ($this->transmit_date_out_sub9->Required) {
			if (!$this->transmit_date_out_sub9->IsDetailKey && $this->transmit_date_out_sub9->FormValue != NULL && $this->transmit_date_out_sub9->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_out_sub9->caption(), $this->transmit_date_out_sub9->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_out_sub9->FormValue)) {
			AddMessage($FormError, $this->transmit_date_out_sub9->errorMessage());
		}
		if ($this->transmit_no_out_sub9->Required) {
			if (!$this->transmit_no_out_sub9->IsDetailKey && $this->transmit_no_out_sub9->FormValue != NULL && $this->transmit_no_out_sub9->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_out_sub9->caption(), $this->transmit_no_out_sub9->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_out_sub9->Required) {
			if (!$this->approval_status_out_sub9->IsDetailKey && $this->approval_status_out_sub9->FormValue != NULL && $this->approval_status_out_sub9->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_out_sub9->caption(), $this->approval_status_out_sub9->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_file_sub9->Required) {
			if (!$this->direction_out_file_sub9->IsDetailKey && $this->direction_out_file_sub9->FormValue != NULL && $this->direction_out_file_sub9->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_file_sub9->caption(), $this->direction_out_file_sub9->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_sub9->Required) {
			if (!$this->direction_in_sub9->IsDetailKey && $this->direction_in_sub9->FormValue != NULL && $this->direction_in_sub9->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_sub9->caption(), $this->direction_in_sub9->RequiredErrorMessage));
			}
		}
		if ($this->transmit_no_in_sub9->Required) {
			if (!$this->transmit_no_in_sub9->IsDetailKey && $this->transmit_no_in_sub9->FormValue != NULL && $this->transmit_no_in_sub9->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_in_sub9->caption(), $this->transmit_no_in_sub9->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_in_sub9->Required) {
			if (!$this->approval_status_in_sub9->IsDetailKey && $this->approval_status_in_sub9->FormValue != NULL && $this->approval_status_in_sub9->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_in_sub9->caption(), $this->approval_status_in_sub9->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_file_sub9->Required) {
			if (!$this->direction_in_file_sub9->IsDetailKey && $this->direction_in_file_sub9->FormValue != NULL && $this->direction_in_file_sub9->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_file_sub9->caption(), $this->direction_in_file_sub9->RequiredErrorMessage));
			}
		}
		if ($this->transmit_date_in_sub9->Required) {
			if (!$this->transmit_date_in_sub9->IsDetailKey && $this->transmit_date_in_sub9->FormValue != NULL && $this->transmit_date_in_sub9->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_in_sub9->caption(), $this->transmit_date_in_sub9->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_in_sub9->FormValue)) {
			AddMessage($FormError, $this->transmit_date_in_sub9->errorMessage());
		}
		if ($this->submit_no_sub10->Required) {
			if (!$this->submit_no_sub10->IsDetailKey && $this->submit_no_sub10->FormValue != NULL && $this->submit_no_sub10->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->submit_no_sub10->caption(), $this->submit_no_sub10->RequiredErrorMessage));
			}
		}
		if ($this->revision_no_sub10->Required) {
			if (!$this->revision_no_sub10->IsDetailKey && $this->revision_no_sub10->FormValue != NULL && $this->revision_no_sub10->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->revision_no_sub10->caption(), $this->revision_no_sub10->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_sub10->Required) {
			if (!$this->direction_out_sub10->IsDetailKey && $this->direction_out_sub10->FormValue != NULL && $this->direction_out_sub10->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_sub10->caption(), $this->direction_out_sub10->RequiredErrorMessage));
			}
		}
		if ($this->planned_date_out_sub10->Required) {
			if (!$this->planned_date_out_sub10->IsDetailKey && $this->planned_date_out_sub10->FormValue != NULL && $this->planned_date_out_sub10->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->planned_date_out_sub10->caption(), $this->planned_date_out_sub10->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->planned_date_out_sub10->FormValue)) {
			AddMessage($FormError, $this->planned_date_out_sub10->errorMessage());
		}
		if ($this->transmit_date_out_sub10->Required) {
			if (!$this->transmit_date_out_sub10->IsDetailKey && $this->transmit_date_out_sub10->FormValue != NULL && $this->transmit_date_out_sub10->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_out_sub10->caption(), $this->transmit_date_out_sub10->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_out_sub10->FormValue)) {
			AddMessage($FormError, $this->transmit_date_out_sub10->errorMessage());
		}
		if ($this->transmit_no_out_sub10->Required) {
			if (!$this->transmit_no_out_sub10->IsDetailKey && $this->transmit_no_out_sub10->FormValue != NULL && $this->transmit_no_out_sub10->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_out_sub10->caption(), $this->transmit_no_out_sub10->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_out_sub10->Required) {
			if (!$this->approval_status_out_sub10->IsDetailKey && $this->approval_status_out_sub10->FormValue != NULL && $this->approval_status_out_sub10->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_out_sub10->caption(), $this->approval_status_out_sub10->RequiredErrorMessage));
			}
		}
		if ($this->direction_out_file_sub10->Required) {
			if (!$this->direction_out_file_sub10->IsDetailKey && $this->direction_out_file_sub10->FormValue != NULL && $this->direction_out_file_sub10->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_out_file_sub10->caption(), $this->direction_out_file_sub10->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_sub10->Required) {
			if (!$this->direction_in_sub10->IsDetailKey && $this->direction_in_sub10->FormValue != NULL && $this->direction_in_sub10->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_sub10->caption(), $this->direction_in_sub10->RequiredErrorMessage));
			}
		}
		if ($this->transmit_no_in_sub10->Required) {
			if (!$this->transmit_no_in_sub10->IsDetailKey && $this->transmit_no_in_sub10->FormValue != NULL && $this->transmit_no_in_sub10->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_no_in_sub10->caption(), $this->transmit_no_in_sub10->RequiredErrorMessage));
			}
		}
		if ($this->approval_status_in_sub10->Required) {
			if (!$this->approval_status_in_sub10->IsDetailKey && $this->approval_status_in_sub10->FormValue != NULL && $this->approval_status_in_sub10->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->approval_status_in_sub10->caption(), $this->approval_status_in_sub10->RequiredErrorMessage));
			}
		}
		if ($this->direction_in_file_sub10->Required) {
			if (!$this->direction_in_file_sub10->IsDetailKey && $this->direction_in_file_sub10->FormValue != NULL && $this->direction_in_file_sub10->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction_in_file_sub10->caption(), $this->direction_in_file_sub10->RequiredErrorMessage));
			}
		}
		if ($this->transmit_date_in_sub10->Required) {
			if (!$this->transmit_date_in_sub10->IsDetailKey && $this->transmit_date_in_sub10->FormValue != NULL && $this->transmit_date_in_sub10->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->transmit_date_in_sub10->caption(), $this->transmit_date_in_sub10->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->transmit_date_in_sub10->FormValue)) {
			AddMessage($FormError, $this->transmit_date_in_sub10->errorMessage());
		}
		if ($this->log_updatedon->Required) {
			if (!$this->log_updatedon->IsDetailKey && $this->log_updatedon->FormValue != NULL && $this->log_updatedon->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->log_updatedon->caption(), $this->log_updatedon->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->log_updatedon->FormValue)) {
			AddMessage($FormError, $this->log_updatedon->errorMessage());
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
		if ($this->document_tittle->CurrentValue <> "") { // Check field with unique index
			$filterChk = "(\"document_tittle\" = '" . AdjustSql($this->document_tittle->CurrentValue, $this->Dbid) . "')";
			$filterChk .= " AND NOT (" . $filter . ")";
			$this->CurrentFilter = $filterChk;
			$sqlChk = $this->getCurrentSql();
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$rsChk = $conn->Execute($sqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->document_tittle->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->document_tittle->CurrentValue, $idxErrMsg);
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
			$this->firelink_doc_no->setDbValueDef($rsnew, $this->firelink_doc_no->CurrentValue, "", $this->firelink_doc_no->ReadOnly);

			// project_name
			$this->project_name->setDbValueDef($rsnew, $this->project_name->CurrentValue, "", $this->project_name->ReadOnly);

			// document_tittle
			$this->document_tittle->setDbValueDef($rsnew, $this->document_tittle->CurrentValue, "", $this->document_tittle->ReadOnly);

			// current_status
			$this->current_status->setDbValueDef($rsnew, $this->current_status->CurrentValue, NULL, $this->current_status->ReadOnly);

			// submit_no_sub1
			$this->submit_no_sub1->setDbValueDef($rsnew, $this->submit_no_sub1->CurrentValue, NULL, $this->submit_no_sub1->ReadOnly);

			// revision_no_sub1
			$this->revision_no_sub1->setDbValueDef($rsnew, $this->revision_no_sub1->CurrentValue, NULL, $this->revision_no_sub1->ReadOnly);

			// direction_out_sub1
			$this->direction_out_sub1->setDbValueDef($rsnew, $this->direction_out_sub1->CurrentValue, NULL, $this->direction_out_sub1->ReadOnly);

			// planned_date_out_sub1
			$this->planned_date_out_sub1->setDbValueDef($rsnew, UnFormatDateTime($this->planned_date_out_sub1->CurrentValue, 0), NULL, $this->planned_date_out_sub1->ReadOnly);

			// transmit_date_out_sub1
			$this->transmit_date_out_sub1->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_out_sub1->CurrentValue, 0), NULL, $this->transmit_date_out_sub1->ReadOnly);

			// transmit_no_out_sub1
			$this->transmit_no_out_sub1->setDbValueDef($rsnew, $this->transmit_no_out_sub1->CurrentValue, NULL, $this->transmit_no_out_sub1->ReadOnly);

			// approval_status_out_sub1
			$this->approval_status_out_sub1->setDbValueDef($rsnew, $this->approval_status_out_sub1->CurrentValue, NULL, $this->approval_status_out_sub1->ReadOnly);

			// direction_out_file_sub1
			$this->direction_out_file_sub1->setDbValueDef($rsnew, $this->direction_out_file_sub1->CurrentValue, NULL, $this->direction_out_file_sub1->ReadOnly);

			// direction_in_sub1
			$this->direction_in_sub1->setDbValueDef($rsnew, $this->direction_in_sub1->CurrentValue, NULL, $this->direction_in_sub1->ReadOnly);

			// transmit_no_in_sub1
			$this->transmit_no_in_sub1->setDbValueDef($rsnew, $this->transmit_no_in_sub1->CurrentValue, NULL, $this->transmit_no_in_sub1->ReadOnly);

			// approval_status_in_sub1
			$this->approval_status_in_sub1->setDbValueDef($rsnew, $this->approval_status_in_sub1->CurrentValue, NULL, $this->approval_status_in_sub1->ReadOnly);

			// transmit_date_in_sub1
			$this->transmit_date_in_sub1->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_in_sub1->CurrentValue, 0), NULL, $this->transmit_date_in_sub1->ReadOnly);

			// submit_no_sub2
			$this->submit_no_sub2->setDbValueDef($rsnew, $this->submit_no_sub2->CurrentValue, NULL, $this->submit_no_sub2->ReadOnly);

			// revision_no_sub2
			$this->revision_no_sub2->setDbValueDef($rsnew, $this->revision_no_sub2->CurrentValue, NULL, $this->revision_no_sub2->ReadOnly);

			// direction_out_sub2
			$this->direction_out_sub2->setDbValueDef($rsnew, $this->direction_out_sub2->CurrentValue, NULL, $this->direction_out_sub2->ReadOnly);

			// planned_date_out_sub2
			$this->planned_date_out_sub2->setDbValueDef($rsnew, UnFormatDateTime($this->planned_date_out_sub2->CurrentValue, 0), NULL, $this->planned_date_out_sub2->ReadOnly);

			// transmit_date_out_sub2
			$this->transmit_date_out_sub2->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_out_sub2->CurrentValue, 0), NULL, $this->transmit_date_out_sub2->ReadOnly);

			// transmit_no_out_sub2
			$this->transmit_no_out_sub2->setDbValueDef($rsnew, $this->transmit_no_out_sub2->CurrentValue, NULL, $this->transmit_no_out_sub2->ReadOnly);

			// approval_status_out_sub2
			$this->approval_status_out_sub2->setDbValueDef($rsnew, $this->approval_status_out_sub2->CurrentValue, NULL, $this->approval_status_out_sub2->ReadOnly);

			// direction_in_sub2
			$this->direction_in_sub2->setDbValueDef($rsnew, $this->direction_in_sub2->CurrentValue, NULL, $this->direction_in_sub2->ReadOnly);

			// transmit_no_in_sub2
			$this->transmit_no_in_sub2->setDbValueDef($rsnew, $this->transmit_no_in_sub2->CurrentValue, NULL, $this->transmit_no_in_sub2->ReadOnly);

			// approval_status_in_sub2
			$this->approval_status_in_sub2->setDbValueDef($rsnew, $this->approval_status_in_sub2->CurrentValue, NULL, $this->approval_status_in_sub2->ReadOnly);

			// transmit_date_in_sub2
			$this->transmit_date_in_sub2->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_in_sub2->CurrentValue, 0), NULL, $this->transmit_date_in_sub2->ReadOnly);

			// submit_no_sub3
			$this->submit_no_sub3->setDbValueDef($rsnew, $this->submit_no_sub3->CurrentValue, NULL, $this->submit_no_sub3->ReadOnly);

			// revision_no_sub3
			$this->revision_no_sub3->setDbValueDef($rsnew, $this->revision_no_sub3->CurrentValue, NULL, $this->revision_no_sub3->ReadOnly);

			// direction_out_sub3
			$this->direction_out_sub3->setDbValueDef($rsnew, $this->direction_out_sub3->CurrentValue, NULL, $this->direction_out_sub3->ReadOnly);

			// planned_date_out_sub3
			$this->planned_date_out_sub3->setDbValueDef($rsnew, UnFormatDateTime($this->planned_date_out_sub3->CurrentValue, 0), NULL, $this->planned_date_out_sub3->ReadOnly);

			// transmit_date_out_sub3
			$this->transmit_date_out_sub3->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_out_sub3->CurrentValue, 0), NULL, $this->transmit_date_out_sub3->ReadOnly);

			// transmit_no_out_sub3
			$this->transmit_no_out_sub3->setDbValueDef($rsnew, $this->transmit_no_out_sub3->CurrentValue, NULL, $this->transmit_no_out_sub3->ReadOnly);

			// approval_status_out_sub3
			$this->approval_status_out_sub3->setDbValueDef($rsnew, $this->approval_status_out_sub3->CurrentValue, NULL, $this->approval_status_out_sub3->ReadOnly);

			// direction_in_sub3
			$this->direction_in_sub3->setDbValueDef($rsnew, $this->direction_in_sub3->CurrentValue, NULL, $this->direction_in_sub3->ReadOnly);

			// transmit_no_in_sub3
			$this->transmit_no_in_sub3->setDbValueDef($rsnew, $this->transmit_no_in_sub3->CurrentValue, NULL, $this->transmit_no_in_sub3->ReadOnly);

			// approval_status_in_sub3
			$this->approval_status_in_sub3->setDbValueDef($rsnew, $this->approval_status_in_sub3->CurrentValue, NULL, $this->approval_status_in_sub3->ReadOnly);

			// transmit_date_in_sub3
			$this->transmit_date_in_sub3->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_in_sub3->CurrentValue, 0), NULL, $this->transmit_date_in_sub3->ReadOnly);

			// submit_no_sub4
			$this->submit_no_sub4->setDbValueDef($rsnew, $this->submit_no_sub4->CurrentValue, NULL, $this->submit_no_sub4->ReadOnly);

			// revision_no_sub4
			$this->revision_no_sub4->setDbValueDef($rsnew, $this->revision_no_sub4->CurrentValue, NULL, $this->revision_no_sub4->ReadOnly);

			// direction_out_sub4
			$this->direction_out_sub4->setDbValueDef($rsnew, $this->direction_out_sub4->CurrentValue, NULL, $this->direction_out_sub4->ReadOnly);

			// planned_date_out_sub4
			$this->planned_date_out_sub4->setDbValueDef($rsnew, UnFormatDateTime($this->planned_date_out_sub4->CurrentValue, 0), NULL, $this->planned_date_out_sub4->ReadOnly);

			// transmit_date_out_sub4
			$this->transmit_date_out_sub4->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_out_sub4->CurrentValue, 0), NULL, $this->transmit_date_out_sub4->ReadOnly);

			// transmit_no_out_sub4
			$this->transmit_no_out_sub4->setDbValueDef($rsnew, $this->transmit_no_out_sub4->CurrentValue, NULL, $this->transmit_no_out_sub4->ReadOnly);

			// approval_status_out_sub4
			$this->approval_status_out_sub4->setDbValueDef($rsnew, $this->approval_status_out_sub4->CurrentValue, NULL, $this->approval_status_out_sub4->ReadOnly);

			// direction_in_sub4
			$this->direction_in_sub4->setDbValueDef($rsnew, $this->direction_in_sub4->CurrentValue, NULL, $this->direction_in_sub4->ReadOnly);

			// transmit_no_in_sub4
			$this->transmit_no_in_sub4->setDbValueDef($rsnew, $this->transmit_no_in_sub4->CurrentValue, NULL, $this->transmit_no_in_sub4->ReadOnly);

			// approval_status_in_sub4
			$this->approval_status_in_sub4->setDbValueDef($rsnew, $this->approval_status_in_sub4->CurrentValue, NULL, $this->approval_status_in_sub4->ReadOnly);

			// direction_in_file_sub4
			$this->direction_in_file_sub4->setDbValueDef($rsnew, $this->direction_in_file_sub4->CurrentValue, NULL, $this->direction_in_file_sub4->ReadOnly);

			// transmit_date_in_sub4
			$this->transmit_date_in_sub4->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_in_sub4->CurrentValue, 0), NULL, $this->transmit_date_in_sub4->ReadOnly);

			// submit_no_sub5
			$this->submit_no_sub5->setDbValueDef($rsnew, $this->submit_no_sub5->CurrentValue, NULL, $this->submit_no_sub5->ReadOnly);

			// revision_no_sub5
			$this->revision_no_sub5->setDbValueDef($rsnew, $this->revision_no_sub5->CurrentValue, NULL, $this->revision_no_sub5->ReadOnly);

			// direction_out_sub5
			$this->direction_out_sub5->setDbValueDef($rsnew, $this->direction_out_sub5->CurrentValue, NULL, $this->direction_out_sub5->ReadOnly);

			// planned_date_out_sub5
			$this->planned_date_out_sub5->setDbValueDef($rsnew, UnFormatDateTime($this->planned_date_out_sub5->CurrentValue, 0), NULL, $this->planned_date_out_sub5->ReadOnly);

			// transmit_date_out_sub5
			$this->transmit_date_out_sub5->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_out_sub5->CurrentValue, 0), NULL, $this->transmit_date_out_sub5->ReadOnly);

			// transmit_no_out_sub5
			$this->transmit_no_out_sub5->setDbValueDef($rsnew, $this->transmit_no_out_sub5->CurrentValue, NULL, $this->transmit_no_out_sub5->ReadOnly);

			// approval_status_out_sub5
			$this->approval_status_out_sub5->setDbValueDef($rsnew, $this->approval_status_out_sub5->CurrentValue, NULL, $this->approval_status_out_sub5->ReadOnly);

			// direction_in_sub5
			$this->direction_in_sub5->setDbValueDef($rsnew, $this->direction_in_sub5->CurrentValue, NULL, $this->direction_in_sub5->ReadOnly);

			// transmit_no_in_sub5
			$this->transmit_no_in_sub5->setDbValueDef($rsnew, $this->transmit_no_in_sub5->CurrentValue, NULL, $this->transmit_no_in_sub5->ReadOnly);

			// approval_status_in_sub5
			$this->approval_status_in_sub5->setDbValueDef($rsnew, $this->approval_status_in_sub5->CurrentValue, NULL, $this->approval_status_in_sub5->ReadOnly);

			// direction_in_file_sub5
			$this->direction_in_file_sub5->setDbValueDef($rsnew, $this->direction_in_file_sub5->CurrentValue, NULL, $this->direction_in_file_sub5->ReadOnly);

			// transmit_date_in_sub5
			$this->transmit_date_in_sub5->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_in_sub5->CurrentValue, 0), NULL, $this->transmit_date_in_sub5->ReadOnly);

			// submit_no_sub6
			$this->submit_no_sub6->setDbValueDef($rsnew, $this->submit_no_sub6->CurrentValue, NULL, $this->submit_no_sub6->ReadOnly);

			// revision_no_sub6
			$this->revision_no_sub6->setDbValueDef($rsnew, $this->revision_no_sub6->CurrentValue, NULL, $this->revision_no_sub6->ReadOnly);

			// direction_out_sub6
			$this->direction_out_sub6->setDbValueDef($rsnew, $this->direction_out_sub6->CurrentValue, NULL, $this->direction_out_sub6->ReadOnly);

			// planned_date_out_sub6
			$this->planned_date_out_sub6->setDbValueDef($rsnew, UnFormatDateTime($this->planned_date_out_sub6->CurrentValue, 0), NULL, $this->planned_date_out_sub6->ReadOnly);

			// transmit_date_out_sub6
			$this->transmit_date_out_sub6->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_out_sub6->CurrentValue, 0), NULL, $this->transmit_date_out_sub6->ReadOnly);

			// transmit_no_out_sub6
			$this->transmit_no_out_sub6->setDbValueDef($rsnew, $this->transmit_no_out_sub6->CurrentValue, NULL, $this->transmit_no_out_sub6->ReadOnly);

			// approval_status_out_sub6
			$this->approval_status_out_sub6->setDbValueDef($rsnew, $this->approval_status_out_sub6->CurrentValue, NULL, $this->approval_status_out_sub6->ReadOnly);

			// direction_in_sub6
			$this->direction_in_sub6->setDbValueDef($rsnew, $this->direction_in_sub6->CurrentValue, NULL, $this->direction_in_sub6->ReadOnly);

			// transmit_no_in_sub6
			$this->transmit_no_in_sub6->setDbValueDef($rsnew, $this->transmit_no_in_sub6->CurrentValue, NULL, $this->transmit_no_in_sub6->ReadOnly);

			// approval_status_in_sub6
			$this->approval_status_in_sub6->setDbValueDef($rsnew, $this->approval_status_in_sub6->CurrentValue, NULL, $this->approval_status_in_sub6->ReadOnly);

			// direction_in_file_sub6
			$this->direction_in_file_sub6->setDbValueDef($rsnew, $this->direction_in_file_sub6->CurrentValue, NULL, $this->direction_in_file_sub6->ReadOnly);

			// transmit_date_in_sub6
			$this->transmit_date_in_sub6->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_in_sub6->CurrentValue, 0), NULL, $this->transmit_date_in_sub6->ReadOnly);

			// submit_no_sub7
			$this->submit_no_sub7->setDbValueDef($rsnew, $this->submit_no_sub7->CurrentValue, NULL, $this->submit_no_sub7->ReadOnly);

			// revision_no_sub7
			$this->revision_no_sub7->setDbValueDef($rsnew, $this->revision_no_sub7->CurrentValue, NULL, $this->revision_no_sub7->ReadOnly);

			// direction_out_sub7
			$this->direction_out_sub7->setDbValueDef($rsnew, $this->direction_out_sub7->CurrentValue, NULL, $this->direction_out_sub7->ReadOnly);

			// planned_date_out_sub7
			$this->planned_date_out_sub7->setDbValueDef($rsnew, UnFormatDateTime($this->planned_date_out_sub7->CurrentValue, 0), NULL, $this->planned_date_out_sub7->ReadOnly);

			// transmit_date_out_sub7
			$this->transmit_date_out_sub7->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_out_sub7->CurrentValue, 0), NULL, $this->transmit_date_out_sub7->ReadOnly);

			// transmit_no_out_sub7
			$this->transmit_no_out_sub7->setDbValueDef($rsnew, $this->transmit_no_out_sub7->CurrentValue, NULL, $this->transmit_no_out_sub7->ReadOnly);

			// approval_status_out_sub7
			$this->approval_status_out_sub7->setDbValueDef($rsnew, $this->approval_status_out_sub7->CurrentValue, NULL, $this->approval_status_out_sub7->ReadOnly);

			// direction_in_sub7
			$this->direction_in_sub7->setDbValueDef($rsnew, $this->direction_in_sub7->CurrentValue, NULL, $this->direction_in_sub7->ReadOnly);

			// transmit_no_in_sub7
			$this->transmit_no_in_sub7->setDbValueDef($rsnew, $this->transmit_no_in_sub7->CurrentValue, NULL, $this->transmit_no_in_sub7->ReadOnly);

			// approval_status_in_sub7
			$this->approval_status_in_sub7->setDbValueDef($rsnew, $this->approval_status_in_sub7->CurrentValue, NULL, $this->approval_status_in_sub7->ReadOnly);

			// transmit_date_in_sub7
			$this->transmit_date_in_sub7->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_in_sub7->CurrentValue, 0), NULL, $this->transmit_date_in_sub7->ReadOnly);

			// submit_no_sub8
			$this->submit_no_sub8->setDbValueDef($rsnew, $this->submit_no_sub8->CurrentValue, NULL, $this->submit_no_sub8->ReadOnly);

			// revision_no_sub8
			$this->revision_no_sub8->setDbValueDef($rsnew, $this->revision_no_sub8->CurrentValue, NULL, $this->revision_no_sub8->ReadOnly);

			// direction_out_sub8
			$this->direction_out_sub8->setDbValueDef($rsnew, $this->direction_out_sub8->CurrentValue, NULL, $this->direction_out_sub8->ReadOnly);

			// planned_date_out_sub8
			$this->planned_date_out_sub8->setDbValueDef($rsnew, UnFormatDateTime($this->planned_date_out_sub8->CurrentValue, 0), NULL, $this->planned_date_out_sub8->ReadOnly);

			// transmit_date_out_sub8
			$this->transmit_date_out_sub8->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_out_sub8->CurrentValue, 0), NULL, $this->transmit_date_out_sub8->ReadOnly);

			// transmit_no_out_sub8
			$this->transmit_no_out_sub8->setDbValueDef($rsnew, $this->transmit_no_out_sub8->CurrentValue, NULL, $this->transmit_no_out_sub8->ReadOnly);

			// approval_status_out_sub8
			$this->approval_status_out_sub8->setDbValueDef($rsnew, $this->approval_status_out_sub8->CurrentValue, NULL, $this->approval_status_out_sub8->ReadOnly);

			// direction_out_file_sub8
			$this->direction_out_file_sub8->setDbValueDef($rsnew, $this->direction_out_file_sub8->CurrentValue, NULL, $this->direction_out_file_sub8->ReadOnly);

			// direction_in_sub8
			$this->direction_in_sub8->setDbValueDef($rsnew, $this->direction_in_sub8->CurrentValue, NULL, $this->direction_in_sub8->ReadOnly);

			// transmit_no_in_sub8
			$this->transmit_no_in_sub8->setDbValueDef($rsnew, $this->transmit_no_in_sub8->CurrentValue, NULL, $this->transmit_no_in_sub8->ReadOnly);

			// approval_status_in_sub8
			$this->approval_status_in_sub8->setDbValueDef($rsnew, $this->approval_status_in_sub8->CurrentValue, NULL, $this->approval_status_in_sub8->ReadOnly);

			// transmit_date_in_sub8
			$this->transmit_date_in_sub8->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_in_sub8->CurrentValue, 0), NULL, $this->transmit_date_in_sub8->ReadOnly);

			// submit_no_sub9
			$this->submit_no_sub9->setDbValueDef($rsnew, $this->submit_no_sub9->CurrentValue, NULL, $this->submit_no_sub9->ReadOnly);

			// revision_no_sub9
			$this->revision_no_sub9->setDbValueDef($rsnew, $this->revision_no_sub9->CurrentValue, NULL, $this->revision_no_sub9->ReadOnly);

			// direction_out_sub9
			$this->direction_out_sub9->setDbValueDef($rsnew, $this->direction_out_sub9->CurrentValue, NULL, $this->direction_out_sub9->ReadOnly);

			// planned_date_out_sub9
			$this->planned_date_out_sub9->setDbValueDef($rsnew, UnFormatDateTime($this->planned_date_out_sub9->CurrentValue, 0), NULL, $this->planned_date_out_sub9->ReadOnly);

			// transmit_date_out_sub9
			$this->transmit_date_out_sub9->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_out_sub9->CurrentValue, 0), NULL, $this->transmit_date_out_sub9->ReadOnly);

			// transmit_no_out_sub9
			$this->transmit_no_out_sub9->setDbValueDef($rsnew, $this->transmit_no_out_sub9->CurrentValue, NULL, $this->transmit_no_out_sub9->ReadOnly);

			// approval_status_out_sub9
			$this->approval_status_out_sub9->setDbValueDef($rsnew, $this->approval_status_out_sub9->CurrentValue, NULL, $this->approval_status_out_sub9->ReadOnly);

			// direction_in_sub9
			$this->direction_in_sub9->setDbValueDef($rsnew, $this->direction_in_sub9->CurrentValue, NULL, $this->direction_in_sub9->ReadOnly);

			// transmit_no_in_sub9
			$this->transmit_no_in_sub9->setDbValueDef($rsnew, $this->transmit_no_in_sub9->CurrentValue, NULL, $this->transmit_no_in_sub9->ReadOnly);

			// approval_status_in_sub9
			$this->approval_status_in_sub9->setDbValueDef($rsnew, $this->approval_status_in_sub9->CurrentValue, NULL, $this->approval_status_in_sub9->ReadOnly);

			// transmit_date_in_sub9
			$this->transmit_date_in_sub9->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_in_sub9->CurrentValue, 0), NULL, $this->transmit_date_in_sub9->ReadOnly);

			// submit_no_sub10
			$this->submit_no_sub10->setDbValueDef($rsnew, $this->submit_no_sub10->CurrentValue, NULL, $this->submit_no_sub10->ReadOnly);

			// revision_no_sub10
			$this->revision_no_sub10->setDbValueDef($rsnew, $this->revision_no_sub10->CurrentValue, NULL, $this->revision_no_sub10->ReadOnly);

			// direction_out_sub10
			$this->direction_out_sub10->setDbValueDef($rsnew, $this->direction_out_sub10->CurrentValue, NULL, $this->direction_out_sub10->ReadOnly);

			// planned_date_out_sub10
			$this->planned_date_out_sub10->setDbValueDef($rsnew, UnFormatDateTime($this->planned_date_out_sub10->CurrentValue, 0), NULL, $this->planned_date_out_sub10->ReadOnly);

			// transmit_date_out_sub10
			$this->transmit_date_out_sub10->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_out_sub10->CurrentValue, 0), NULL, $this->transmit_date_out_sub10->ReadOnly);

			// transmit_no_out_sub10
			$this->transmit_no_out_sub10->setDbValueDef($rsnew, $this->transmit_no_out_sub10->CurrentValue, NULL, $this->transmit_no_out_sub10->ReadOnly);

			// approval_status_out_sub10
			$this->approval_status_out_sub10->setDbValueDef($rsnew, $this->approval_status_out_sub10->CurrentValue, NULL, $this->approval_status_out_sub10->ReadOnly);

			// direction_in_sub10
			$this->direction_in_sub10->setDbValueDef($rsnew, $this->direction_in_sub10->CurrentValue, NULL, $this->direction_in_sub10->ReadOnly);

			// transmit_no_in_sub10
			$this->transmit_no_in_sub10->setDbValueDef($rsnew, $this->transmit_no_in_sub10->CurrentValue, NULL, $this->transmit_no_in_sub10->ReadOnly);

			// approval_status_in_sub10
			$this->approval_status_in_sub10->setDbValueDef($rsnew, $this->approval_status_in_sub10->CurrentValue, NULL, $this->approval_status_in_sub10->ReadOnly);

			// transmit_date_in_sub10
			$this->transmit_date_in_sub10->setDbValueDef($rsnew, UnFormatDateTime($this->transmit_date_in_sub10->CurrentValue, 0), NULL, $this->transmit_date_in_sub10->ReadOnly);

			// log_updatedon
			$this->log_updatedon->setDbValueDef($rsnew, UnFormatDateTime($this->log_updatedon->CurrentValue, 0), NULL, $this->log_updatedon->ReadOnly);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("document_loglist.php"), "", $this->TableVar, TRUE);
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