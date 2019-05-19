<?php
namespace PHPMaker2019\pdm;

/**
 * Page class
 */
class document_log_view extends document_log
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{vishal-pdm}";

	// Table name
	public $TableName = 'document_log';

	// Page object name
	public $PageObjName = "document_log_view";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;
	public $CancelUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

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
		$keyUrl = "";
		if (Get("log_id") !== NULL) {
			$this->RecKey["log_id"] = Get("log_id");
			$keyUrl .= "&amp;log_id=" . urlencode($this->RecKey["log_id"]);
		}
		$this->ExportPrintUrl = $this->pageUrl() . "export=print" . $keyUrl;
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html" . $keyUrl;
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel" . $keyUrl;
		$this->ExportWordUrl = $this->pageUrl() . "export=word" . $keyUrl;
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml" . $keyUrl;
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv" . $keyUrl;
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf" . $keyUrl;
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (user_dtls)
		if (!isset($GLOBALS['user_dtls']))
			$GLOBALS['user_dtls'] = new user_dtls();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'view');

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

		// Export options
		$this->ExportOptions = new ListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["action"] = new ListOptions();
		$this->OtherOptions["action"]->Tag = "div";
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";
		$this->OtherOptions["detail"] = new ListOptions();
		$this->OtherOptions["detail"]->Tag = "div";
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
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
	public $ExportOptions; // Export options
	public $OtherOptions; // Other options
	public $DisplayRecs = 1;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $StartRec;
	public $StopRec;
	public $TotalRecs = 0;
	public $RecRange = 10;
	public $Pager;
	public $AutoHidePager = AUTO_HIDE_PAGER;
	public $RecCnt;
	public $RecKey = array();
	public $IsModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$SkipHeaderFooter, $EXPORT;

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
			if (!$Security->canView()) {
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

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		} elseif (IsPost()) {
			if (Post("exporttype") !== NULL)
				$this->Export = Post("exporttype");
			$custom = Post("custom", "");
		} elseif (Get("cmd") == "json") {
			$this->Export = Get("cmd");
		} else {
			$this->setExportReturnUrl(CurrentUrl());
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header
		if (Get("log_id") !== NULL) {
			if ($ExportFileName <> "")
				$ExportFileName .= "_";
			$ExportFileName .= Get("log_id");
		}

		// Get custom export parameters
		if ($this->isExport() && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined(PROJECT_NAMESPACE . "USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined(PROJECT_NAMESPACE . "USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Setup export options
		$this->setupExportOptions();
		$this->log_id->Visible = FALSE;
		$this->firelink_doc_no->setVisibility();
		$this->client_doc_no->setVisibility();
		$this->order_number->setVisibility();
		$this->project_name->setVisibility();
		$this->document_tittle->setVisibility();
		$this->current_status->setVisibility();
		$this->current_status_file->Visible = FALSE;
		$this->submit_no_1->setVisibility();
		$this->revision_no_1->setVisibility();
		$this->direction_1->setVisibility();
		$this->planned_date_1->Visible = FALSE;
		$this->transmit_date_1->Visible = FALSE;
		$this->transmit_no_1->setVisibility();
		$this->approval_status_1->setVisibility();
		$this->direction_file_1->Visible = FALSE;
		$this->submit_no_2->setVisibility();
		$this->revision_no_2->setVisibility();
		$this->direction_2->setVisibility();
		$this->planned_date_2->setVisibility();
		$this->transmit_date_2->setVisibility();
		$this->transmit_no_2->setVisibility();
		$this->approval_status_2->setVisibility();
		$this->direction_file_2->Visible = FALSE;
		$this->submit_no_3->setVisibility();
		$this->revision_no_3->setVisibility();
		$this->direction_3->setVisibility();
		$this->planned_date_3->setVisibility();
		$this->transmit_date_3->setVisibility();
		$this->transmit_no_3->setVisibility();
		$this->approval_status_3->setVisibility();
		$this->direction_file_3->Visible = FALSE;
		$this->submit_no_4->setVisibility();
		$this->revision_no_4->setVisibility();
		$this->direction_4->setVisibility();
		$this->planned_date_4->setVisibility();
		$this->transmit_date_4->setVisibility();
		$this->transmit_no_4->setVisibility();
		$this->approval_status_4->setVisibility();
		$this->direction_file_4->Visible = FALSE;
		$this->submit_no_5->setVisibility();
		$this->revision_no_5->setVisibility();
		$this->direction_5->setVisibility();
		$this->planned_date_5->setVisibility();
		$this->transmit_date_5->setVisibility();
		$this->transmit_no_5->setVisibility();
		$this->approval_status_5->setVisibility();
		$this->direction_file_5->Visible = FALSE;
		$this->submit_no_6->setVisibility();
		$this->revision_no_6->setVisibility();
		$this->direction_6->setVisibility();
		$this->planned_date_6->setVisibility();
		$this->transmit_date_6->setVisibility();
		$this->transmit_no_6->setVisibility();
		$this->approval_status_6->setVisibility();
		$this->direction_file_6->Visible = FALSE;
		$this->submit_no_7->setVisibility();
		$this->revision_no_7->setVisibility();
		$this->direction_7->setVisibility();
		$this->planned_date_7->setVisibility();
		$this->transmit_date_7->setVisibility();
		$this->transmit_no_7->setVisibility();
		$this->approval_status_7->setVisibility();
		$this->direction_file_7->Visible = FALSE;
		$this->submit_no_8->setVisibility();
		$this->revision_no_8->setVisibility();
		$this->direction_8->setVisibility();
		$this->planned_date_8->setVisibility();
		$this->transmit_date_8->setVisibility();
		$this->transmit_no_8->setVisibility();
		$this->approval_status_8->setVisibility();
		$this->direction_file_8->Visible = FALSE;
		$this->submit_no_9->setVisibility();
		$this->revision_no_9->setVisibility();
		$this->direction_9->setVisibility();
		$this->planned_date_9->setVisibility();
		$this->transmit_date_9->setVisibility();
		$this->transmit_no_9->setVisibility();
		$this->approval_status_9->setVisibility();
		$this->direction_file_9->Visible = FALSE;
		$this->submit_no_10->setVisibility();
		$this->revision_no_10->setVisibility();
		$this->direction_10->setVisibility();
		$this->planned_date_10->setVisibility();
		$this->transmit_date_10->setVisibility();
		$this->transmit_no_10->setVisibility();
		$this->approval_status_10->setVisibility();
		$this->direction_file_10->Visible = FALSE;
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

		// Load current record
		$loadCurrentRecord = FALSE;
		$returnUrl = "";
		$matchRecord = FALSE;
		if ($this->isPageRequest()) { // Validate request
			if (Get("log_id") !== NULL) {
				$this->log_id->setQueryStringValue(Get("log_id"));
				$this->RecKey["log_id"] = $this->log_id->QueryStringValue;
			} elseif (IsApi() && Key(0) != NULL) {
				$this->log_id->setQueryStringValue(Key(0));
				$this->RecKey["log_id"] = $this->log_id->QueryStringValue;
			} elseif (Post("log_id") !== NULL) {
				$this->log_id->setFormValue(Post("log_id"));
				$this->RecKey["log_id"] = $this->log_id->FormValue;
			} elseif (IsApi() && Route(2) != NULL) {
				$this->log_id->setFormValue(Route(2));
				$this->RecKey["log_id"] = $this->log_id->FormValue;
			} else {
				$loadCurrentRecord = TRUE;
			}

			// Get action
			$this->CurrentAction = "show"; // Display
			switch ($this->CurrentAction) {
				case "show": // Get a record to display
					$this->StartRec = 1; // Initialize start position
					if ($this->Recordset = $this->loadRecordset()) // Load records
						$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecs <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$this->terminate("document_loglist.php"); // Return to list page
					} elseif ($loadCurrentRecord) { // Load current record position
						$this->setupStartRec(); // Set up start record position

						// Point to current record
						if ($this->StartRec <= $this->TotalRecs) {
							$matchRecord = TRUE;
							$this->Recordset->move($this->StartRec - 1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (SameString($this->log_id->CurrentValue, $this->Recordset->fields('log_id'))) {
								$this->setStartRecordNumber($this->StartRec); // Save record position
								$matchRecord = TRUE;
								break;
							} else {
								$this->StartRec++;
								$this->Recordset->moveNext();
							}
						}
					}
					if (!$matchRecord) {
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$returnUrl = "document_loglist.php"; // No matching record, return to list
					} else {
						$this->loadRowValues($this->Recordset); // Load row values
					}
			}

			// Export data only
			if (!$this->CustomExport && in_array($this->Export, array_keys($EXPORT))) {
				$this->exportData();
				$this->terminate();
			}
		} else {
			$returnUrl = "document_loglist.php"; // Not page request, return to list
		}
		if ($returnUrl <> "") {
			$this->terminate($returnUrl);
			return;
		}

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Render row
		$this->RowType = ROWTYPE_VIEW;
		$this->resetAttributes();
		$this->renderRow();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset, TRUE); // Get current record only
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows]);
			$this->terminate(TRUE);
		}
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = &$options["action"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"javascript:void(0);\" onclick=\"ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->canAdd());

		// Edit
		$item = &$option->add("edit");
		$editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"javascript:void(0);\" onclick=\"ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl <> "" && $Security->canEdit());

		// Copy
		$item = &$option->add("copy");
		$copycaption = HtmlTitle($Language->phrase("ViewPageCopyLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"javascript:void(0);\" onclick=\"ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->CopyUrl) . "'});\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
		$item->Visible = ($this->CopyUrl <> "" && $Security->canAdd());

		// Delete
		$item = &$option->add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew.confirmDelete(this);\" class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(UrlAddQuery($this->DeleteUrl, "action=1")) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl <> "" && $Security->canDelete());

		// Set up action default
		$option = &$options["action"];
		$option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
		$option->UseDropDownButton = FALSE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
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
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
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
		$this->log_id->setDbValue($row['log_id']);
		$this->firelink_doc_no->setDbValue($row['firelink_doc_no']);
		$this->client_doc_no->setDbValue($row['client_doc_no']);
		$this->order_number->setDbValue($row['order_number']);
		$this->project_name->setDbValue($row['project_name']);
		$this->document_tittle->setDbValue($row['document_tittle']);
		$this->current_status->setDbValue($row['current_status']);
		$this->current_status_file->setDbValue($row['current_status_file']);
		$this->submit_no_1->setDbValue($row['submit_no_1']);
		$this->revision_no_1->setDbValue($row['revision_no_1']);
		$this->direction_1->setDbValue($row['direction_1']);
		$this->planned_date_1->setDbValue($row['planned_date_1']);
		$this->transmit_date_1->setDbValue($row['transmit_date_1']);
		$this->transmit_no_1->setDbValue($row['transmit_no_1']);
		$this->approval_status_1->setDbValue($row['approval_status_1']);
		$this->direction_file_1->setDbValue($row['direction_file_1']);
		$this->submit_no_2->setDbValue($row['submit_no_2']);
		$this->revision_no_2->setDbValue($row['revision_no_2']);
		$this->direction_2->setDbValue($row['direction_2']);
		$this->planned_date_2->setDbValue($row['planned_date_2']);
		$this->transmit_date_2->setDbValue($row['transmit_date_2']);
		$this->transmit_no_2->setDbValue($row['transmit_no_2']);
		$this->approval_status_2->setDbValue($row['approval_status_2']);
		$this->direction_file_2->setDbValue($row['direction_file_2']);
		$this->submit_no_3->setDbValue($row['submit_no_3']);
		$this->revision_no_3->setDbValue($row['revision_no_3']);
		$this->direction_3->setDbValue($row['direction_3']);
		$this->planned_date_3->setDbValue($row['planned_date_3']);
		$this->transmit_date_3->setDbValue($row['transmit_date_3']);
		$this->transmit_no_3->setDbValue($row['transmit_no_3']);
		$this->approval_status_3->setDbValue($row['approval_status_3']);
		$this->direction_file_3->setDbValue($row['direction_file_3']);
		$this->submit_no_4->setDbValue($row['submit_no_4']);
		$this->revision_no_4->setDbValue($row['revision_no_4']);
		$this->direction_4->setDbValue($row['direction_4']);
		$this->planned_date_4->setDbValue($row['planned_date_4']);
		$this->transmit_date_4->setDbValue($row['transmit_date_4']);
		$this->transmit_no_4->setDbValue($row['transmit_no_4']);
		$this->approval_status_4->setDbValue($row['approval_status_4']);
		$this->direction_file_4->setDbValue($row['direction_file_4']);
		$this->submit_no_5->setDbValue($row['submit_no_5']);
		$this->revision_no_5->setDbValue($row['revision_no_5']);
		$this->direction_5->setDbValue($row['direction_5']);
		$this->planned_date_5->setDbValue($row['planned_date_5']);
		$this->transmit_date_5->setDbValue($row['transmit_date_5']);
		$this->transmit_no_5->setDbValue($row['transmit_no_5']);
		$this->approval_status_5->setDbValue($row['approval_status_5']);
		$this->direction_file_5->setDbValue($row['direction_file_5']);
		$this->submit_no_6->setDbValue($row['submit_no_6']);
		$this->revision_no_6->setDbValue($row['revision_no_6']);
		$this->direction_6->setDbValue($row['direction_6']);
		$this->planned_date_6->setDbValue($row['planned_date_6']);
		$this->transmit_date_6->setDbValue($row['transmit_date_6']);
		$this->transmit_no_6->setDbValue($row['transmit_no_6']);
		$this->approval_status_6->setDbValue($row['approval_status_6']);
		$this->direction_file_6->setDbValue($row['direction_file_6']);
		$this->submit_no_7->setDbValue($row['submit_no_7']);
		$this->revision_no_7->setDbValue($row['revision_no_7']);
		$this->direction_7->setDbValue($row['direction_7']);
		$this->planned_date_7->setDbValue($row['planned_date_7']);
		$this->transmit_date_7->setDbValue($row['transmit_date_7']);
		$this->transmit_no_7->setDbValue($row['transmit_no_7']);
		$this->approval_status_7->setDbValue($row['approval_status_7']);
		$this->direction_file_7->setDbValue($row['direction_file_7']);
		$this->submit_no_8->setDbValue($row['submit_no_8']);
		$this->revision_no_8->setDbValue($row['revision_no_8']);
		$this->direction_8->setDbValue($row['direction_8']);
		$this->planned_date_8->setDbValue($row['planned_date_8']);
		$this->transmit_date_8->setDbValue($row['transmit_date_8']);
		$this->transmit_no_8->setDbValue($row['transmit_no_8']);
		$this->approval_status_8->setDbValue($row['approval_status_8']);
		$this->direction_file_8->setDbValue($row['direction_file_8']);
		$this->submit_no_9->setDbValue($row['submit_no_9']);
		$this->revision_no_9->setDbValue($row['revision_no_9']);
		$this->direction_9->setDbValue($row['direction_9']);
		$this->planned_date_9->setDbValue($row['planned_date_9']);
		$this->transmit_date_9->setDbValue($row['transmit_date_9']);
		$this->transmit_no_9->setDbValue($row['transmit_no_9']);
		$this->approval_status_9->setDbValue($row['approval_status_9']);
		$this->direction_file_9->setDbValue($row['direction_file_9']);
		$this->submit_no_10->setDbValue($row['submit_no_10']);
		$this->revision_no_10->setDbValue($row['revision_no_10']);
		$this->direction_10->setDbValue($row['direction_10']);
		$this->planned_date_10->setDbValue($row['planned_date_10']);
		$this->transmit_date_10->setDbValue($row['transmit_date_10']);
		$this->transmit_no_10->setDbValue($row['transmit_no_10']);
		$this->approval_status_10->setDbValue($row['approval_status_10']);
		$this->direction_file_10->setDbValue($row['direction_file_10']);
		$this->log_updatedon->setDbValue($row['log_updatedon']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['log_id'] = NULL;
		$row['firelink_doc_no'] = NULL;
		$row['client_doc_no'] = NULL;
		$row['order_number'] = NULL;
		$row['project_name'] = NULL;
		$row['document_tittle'] = NULL;
		$row['current_status'] = NULL;
		$row['current_status_file'] = NULL;
		$row['submit_no_1'] = NULL;
		$row['revision_no_1'] = NULL;
		$row['direction_1'] = NULL;
		$row['planned_date_1'] = NULL;
		$row['transmit_date_1'] = NULL;
		$row['transmit_no_1'] = NULL;
		$row['approval_status_1'] = NULL;
		$row['direction_file_1'] = NULL;
		$row['submit_no_2'] = NULL;
		$row['revision_no_2'] = NULL;
		$row['direction_2'] = NULL;
		$row['planned_date_2'] = NULL;
		$row['transmit_date_2'] = NULL;
		$row['transmit_no_2'] = NULL;
		$row['approval_status_2'] = NULL;
		$row['direction_file_2'] = NULL;
		$row['submit_no_3'] = NULL;
		$row['revision_no_3'] = NULL;
		$row['direction_3'] = NULL;
		$row['planned_date_3'] = NULL;
		$row['transmit_date_3'] = NULL;
		$row['transmit_no_3'] = NULL;
		$row['approval_status_3'] = NULL;
		$row['direction_file_3'] = NULL;
		$row['submit_no_4'] = NULL;
		$row['revision_no_4'] = NULL;
		$row['direction_4'] = NULL;
		$row['planned_date_4'] = NULL;
		$row['transmit_date_4'] = NULL;
		$row['transmit_no_4'] = NULL;
		$row['approval_status_4'] = NULL;
		$row['direction_file_4'] = NULL;
		$row['submit_no_5'] = NULL;
		$row['revision_no_5'] = NULL;
		$row['direction_5'] = NULL;
		$row['planned_date_5'] = NULL;
		$row['transmit_date_5'] = NULL;
		$row['transmit_no_5'] = NULL;
		$row['approval_status_5'] = NULL;
		$row['direction_file_5'] = NULL;
		$row['submit_no_6'] = NULL;
		$row['revision_no_6'] = NULL;
		$row['direction_6'] = NULL;
		$row['planned_date_6'] = NULL;
		$row['transmit_date_6'] = NULL;
		$row['transmit_no_6'] = NULL;
		$row['approval_status_6'] = NULL;
		$row['direction_file_6'] = NULL;
		$row['submit_no_7'] = NULL;
		$row['revision_no_7'] = NULL;
		$row['direction_7'] = NULL;
		$row['planned_date_7'] = NULL;
		$row['transmit_date_7'] = NULL;
		$row['transmit_no_7'] = NULL;
		$row['approval_status_7'] = NULL;
		$row['direction_file_7'] = NULL;
		$row['submit_no_8'] = NULL;
		$row['revision_no_8'] = NULL;
		$row['direction_8'] = NULL;
		$row['planned_date_8'] = NULL;
		$row['transmit_date_8'] = NULL;
		$row['transmit_no_8'] = NULL;
		$row['approval_status_8'] = NULL;
		$row['direction_file_8'] = NULL;
		$row['submit_no_9'] = NULL;
		$row['revision_no_9'] = NULL;
		$row['direction_9'] = NULL;
		$row['planned_date_9'] = NULL;
		$row['transmit_date_9'] = NULL;
		$row['transmit_no_9'] = NULL;
		$row['approval_status_9'] = NULL;
		$row['direction_file_9'] = NULL;
		$row['submit_no_10'] = NULL;
		$row['revision_no_10'] = NULL;
		$row['direction_10'] = NULL;
		$row['planned_date_10'] = NULL;
		$row['transmit_date_10'] = NULL;
		$row['transmit_no_10'] = NULL;
		$row['approval_status_10'] = NULL;
		$row['direction_file_10'] = NULL;
		$row['log_updatedon'] = NULL;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->AddUrl = $this->getAddUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();
		$this->ListUrl = $this->getListUrl();
		$this->setupOtherOptions();

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

			// transmit_no_1
			$this->transmit_no_1->ViewValue = $this->transmit_no_1->CurrentValue;
			$this->transmit_no_1->ViewCustomAttributes = "";

			// approval_status_1
			$this->approval_status_1->ViewValue = $this->approval_status_1->CurrentValue;
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
			$this->planned_date_2->ViewValue = FormatDateTime($this->planned_date_2->ViewValue, 0);
			$this->planned_date_2->ViewCustomAttributes = "";

			// transmit_date_2
			$this->transmit_date_2->ViewValue = $this->transmit_date_2->CurrentValue;
			$this->transmit_date_2->ViewValue = FormatDateTime($this->transmit_date_2->ViewValue, 0);
			$this->transmit_date_2->ViewCustomAttributes = "";

			// transmit_no_2
			$this->transmit_no_2->ViewValue = $this->transmit_no_2->CurrentValue;
			$this->transmit_no_2->ViewCustomAttributes = "";

			// approval_status_2
			$this->approval_status_2->ViewValue = $this->approval_status_2->CurrentValue;
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
			$this->planned_date_3->ViewValue = FormatDateTime($this->planned_date_3->ViewValue, 0);
			$this->planned_date_3->ViewCustomAttributes = "";

			// transmit_date_3
			$this->transmit_date_3->ViewValue = $this->transmit_date_3->CurrentValue;
			$this->transmit_date_3->ViewValue = FormatDateTime($this->transmit_date_3->ViewValue, 0);
			$this->transmit_date_3->ViewCustomAttributes = "";

			// transmit_no_3
			$this->transmit_no_3->ViewValue = $this->transmit_no_3->CurrentValue;
			$this->transmit_no_3->ViewCustomAttributes = "";

			// approval_status_3
			$this->approval_status_3->ViewValue = $this->approval_status_3->CurrentValue;
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
			$this->planned_date_4->ViewValue = FormatDateTime($this->planned_date_4->ViewValue, 0);
			$this->planned_date_4->ViewCustomAttributes = "";

			// transmit_date_4
			$this->transmit_date_4->ViewValue = $this->transmit_date_4->CurrentValue;
			$this->transmit_date_4->ViewValue = FormatDateTime($this->transmit_date_4->ViewValue, 0);
			$this->transmit_date_4->ViewCustomAttributes = "";

			// transmit_no_4
			$this->transmit_no_4->ViewValue = $this->transmit_no_4->CurrentValue;
			$this->transmit_no_4->ViewCustomAttributes = "";

			// approval_status_4
			$this->approval_status_4->ViewValue = $this->approval_status_4->CurrentValue;
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
			$this->planned_date_5->ViewValue = FormatDateTime($this->planned_date_5->ViewValue, 0);
			$this->planned_date_5->ViewCustomAttributes = "";

			// transmit_date_5
			$this->transmit_date_5->ViewValue = $this->transmit_date_5->CurrentValue;
			$this->transmit_date_5->ViewValue = FormatDateTime($this->transmit_date_5->ViewValue, 0);
			$this->transmit_date_5->ViewCustomAttributes = "";

			// transmit_no_5
			$this->transmit_no_5->ViewValue = $this->transmit_no_5->CurrentValue;
			$this->transmit_no_5->ViewCustomAttributes = "";

			// approval_status_5
			$this->approval_status_5->ViewValue = $this->approval_status_5->CurrentValue;
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
			$this->planned_date_6->ViewValue = FormatDateTime($this->planned_date_6->ViewValue, 0);
			$this->planned_date_6->ViewCustomAttributes = "";

			// transmit_date_6
			$this->transmit_date_6->ViewValue = $this->transmit_date_6->CurrentValue;
			$this->transmit_date_6->ViewValue = FormatDateTime($this->transmit_date_6->ViewValue, 0);
			$this->transmit_date_6->ViewCustomAttributes = "";

			// transmit_no_6
			$this->transmit_no_6->ViewValue = $this->transmit_no_6->CurrentValue;
			$this->transmit_no_6->ViewCustomAttributes = "";

			// approval_status_6
			$this->approval_status_6->ViewValue = $this->approval_status_6->CurrentValue;
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
			$this->planned_date_7->ViewValue = FormatDateTime($this->planned_date_7->ViewValue, 0);
			$this->planned_date_7->ViewCustomAttributes = "";

			// transmit_date_7
			$this->transmit_date_7->ViewValue = $this->transmit_date_7->CurrentValue;
			$this->transmit_date_7->ViewValue = FormatDateTime($this->transmit_date_7->ViewValue, 0);
			$this->transmit_date_7->ViewCustomAttributes = "";

			// transmit_no_7
			$this->transmit_no_7->ViewValue = $this->transmit_no_7->CurrentValue;
			$this->transmit_no_7->ViewCustomAttributes = "";

			// approval_status_7
			$this->approval_status_7->ViewValue = $this->approval_status_7->CurrentValue;
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
			$this->planned_date_8->ViewValue = FormatDateTime($this->planned_date_8->ViewValue, 0);
			$this->planned_date_8->ViewCustomAttributes = "";

			// transmit_date_8
			$this->transmit_date_8->ViewValue = $this->transmit_date_8->CurrentValue;
			$this->transmit_date_8->ViewValue = FormatDateTime($this->transmit_date_8->ViewValue, 0);
			$this->transmit_date_8->ViewCustomAttributes = "";

			// transmit_no_8
			$this->transmit_no_8->ViewValue = $this->transmit_no_8->CurrentValue;
			$this->transmit_no_8->ViewCustomAttributes = "";

			// approval_status_8
			$this->approval_status_8->ViewValue = $this->approval_status_8->CurrentValue;
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
			$this->planned_date_9->ViewValue = FormatDateTime($this->planned_date_9->ViewValue, 0);
			$this->planned_date_9->ViewCustomAttributes = "";

			// transmit_date_9
			$this->transmit_date_9->ViewValue = $this->transmit_date_9->CurrentValue;
			$this->transmit_date_9->ViewValue = FormatDateTime($this->transmit_date_9->ViewValue, 0);
			$this->transmit_date_9->ViewCustomAttributes = "";

			// transmit_no_9
			$this->transmit_no_9->ViewValue = $this->transmit_no_9->CurrentValue;
			$this->transmit_no_9->ViewCustomAttributes = "";

			// approval_status_9
			$this->approval_status_9->ViewValue = $this->approval_status_9->CurrentValue;
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
			$this->planned_date_10->ViewValue = FormatDateTime($this->planned_date_10->ViewValue, 0);
			$this->planned_date_10->ViewCustomAttributes = "";

			// transmit_date_10
			$this->transmit_date_10->ViewValue = $this->transmit_date_10->CurrentValue;
			$this->transmit_date_10->ViewValue = FormatDateTime($this->transmit_date_10->ViewValue, 0);
			$this->transmit_date_10->ViewCustomAttributes = "";

			// transmit_no_10
			$this->transmit_no_10->ViewValue = $this->transmit_no_10->CurrentValue;
			$this->transmit_no_10->ViewCustomAttributes = "";

			// approval_status_10
			$this->approval_status_10->ViewValue = $this->approval_status_10->CurrentValue;
			$this->approval_status_10->ViewCustomAttributes = "";

			// log_updatedon
			$this->log_updatedon->ViewValue = $this->log_updatedon->CurrentValue;
			$this->log_updatedon->ViewValue = FormatDateTime($this->log_updatedon->ViewValue, 115);
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
			if (!EmptyValue($this->current_status_file->CurrentValue)) {
				$this->current_status->HrefValue = ((!empty($this->current_status_file->ViewValue) && !is_array($this->current_status_file->ViewValue)) ? RemoveHtml($this->current_status_file->ViewValue) : $this->current_status_file->CurrentValue); // Add prefix/suffix
				$this->current_status->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->current_status->HrefValue = FullUrl($this->current_status->HrefValue, "href");
			} else {
				$this->current_status->HrefValue = "";
			}
			$this->current_status->TooltipValue = "";

			// submit_no_1
			$this->submit_no_1->LinkCustomAttributes = "";
			$this->submit_no_1->HrefValue = "";
			$this->submit_no_1->TooltipValue = "";

			// revision_no_1
			$this->revision_no_1->LinkCustomAttributes = "";
			$this->revision_no_1->HrefValue = "";
			$this->revision_no_1->TooltipValue = "";

			// direction_1
			$this->direction_1->LinkCustomAttributes = "";
			$this->direction_1->HrefValue = "";
			$this->direction_1->TooltipValue = "";

			// transmit_no_1
			$this->transmit_no_1->LinkCustomAttributes = "";
			$this->transmit_no_1->HrefValue = "";
			$this->transmit_no_1->TooltipValue = "";

			// approval_status_1
			$this->approval_status_1->LinkCustomAttributes = "";
			if (!EmptyValue($this->direction_file_1->CurrentValue)) {
				$this->approval_status_1->HrefValue = ((!empty($this->direction_file_1->ViewValue) && !is_array($this->direction_file_1->ViewValue)) ? RemoveHtml($this->direction_file_1->ViewValue) : $this->direction_file_1->CurrentValue); // Add prefix/suffix
				$this->approval_status_1->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->approval_status_1->HrefValue = FullUrl($this->approval_status_1->HrefValue, "href");
			} else {
				$this->approval_status_1->HrefValue = "";
			}
			$this->approval_status_1->TooltipValue = "";

			// submit_no_2
			$this->submit_no_2->LinkCustomAttributes = "";
			$this->submit_no_2->HrefValue = "";
			$this->submit_no_2->TooltipValue = "";

			// revision_no_2
			$this->revision_no_2->LinkCustomAttributes = "";
			$this->revision_no_2->HrefValue = "";
			$this->revision_no_2->TooltipValue = "";

			// direction_2
			$this->direction_2->LinkCustomAttributes = "";
			$this->direction_2->HrefValue = "";
			$this->direction_2->TooltipValue = "";

			// planned_date_2
			$this->planned_date_2->LinkCustomAttributes = "";
			$this->planned_date_2->HrefValue = "";
			$this->planned_date_2->TooltipValue = "";

			// transmit_date_2
			$this->transmit_date_2->LinkCustomAttributes = "";
			$this->transmit_date_2->HrefValue = "";
			$this->transmit_date_2->TooltipValue = "";

			// transmit_no_2
			$this->transmit_no_2->LinkCustomAttributes = "";
			$this->transmit_no_2->HrefValue = "";
			$this->transmit_no_2->TooltipValue = "";

			// approval_status_2
			$this->approval_status_2->LinkCustomAttributes = "";
			$this->approval_status_2->HrefValue = "";
			$this->approval_status_2->TooltipValue = "";

			// submit_no_3
			$this->submit_no_3->LinkCustomAttributes = "";
			$this->submit_no_3->HrefValue = "";
			$this->submit_no_3->TooltipValue = "";

			// revision_no_3
			$this->revision_no_3->LinkCustomAttributes = "";
			$this->revision_no_3->HrefValue = "";
			$this->revision_no_3->TooltipValue = "";

			// direction_3
			$this->direction_3->LinkCustomAttributes = "";
			$this->direction_3->HrefValue = "";
			$this->direction_3->TooltipValue = "";

			// planned_date_3
			$this->planned_date_3->LinkCustomAttributes = "";
			$this->planned_date_3->HrefValue = "";
			$this->planned_date_3->TooltipValue = "";

			// transmit_date_3
			$this->transmit_date_3->LinkCustomAttributes = "";
			$this->transmit_date_3->HrefValue = "";
			$this->transmit_date_3->TooltipValue = "";

			// transmit_no_3
			$this->transmit_no_3->LinkCustomAttributes = "";
			$this->transmit_no_3->HrefValue = "";
			$this->transmit_no_3->TooltipValue = "";

			// approval_status_3
			$this->approval_status_3->LinkCustomAttributes = "";
			$this->approval_status_3->HrefValue = "";
			$this->approval_status_3->TooltipValue = "";

			// submit_no_4
			$this->submit_no_4->LinkCustomAttributes = "";
			$this->submit_no_4->HrefValue = "";
			$this->submit_no_4->TooltipValue = "";

			// revision_no_4
			$this->revision_no_4->LinkCustomAttributes = "";
			$this->revision_no_4->HrefValue = "";
			$this->revision_no_4->TooltipValue = "";

			// direction_4
			$this->direction_4->LinkCustomAttributes = "";
			$this->direction_4->HrefValue = "";
			$this->direction_4->TooltipValue = "";

			// planned_date_4
			$this->planned_date_4->LinkCustomAttributes = "";
			$this->planned_date_4->HrefValue = "";
			$this->planned_date_4->TooltipValue = "";

			// transmit_date_4
			$this->transmit_date_4->LinkCustomAttributes = "";
			$this->transmit_date_4->HrefValue = "";
			$this->transmit_date_4->TooltipValue = "";

			// transmit_no_4
			$this->transmit_no_4->LinkCustomAttributes = "";
			$this->transmit_no_4->HrefValue = "";
			$this->transmit_no_4->TooltipValue = "";

			// approval_status_4
			$this->approval_status_4->LinkCustomAttributes = "";
			$this->approval_status_4->HrefValue = "";
			$this->approval_status_4->TooltipValue = "";

			// submit_no_5
			$this->submit_no_5->LinkCustomAttributes = "";
			$this->submit_no_5->HrefValue = "";
			$this->submit_no_5->TooltipValue = "";

			// revision_no_5
			$this->revision_no_5->LinkCustomAttributes = "";
			$this->revision_no_5->HrefValue = "";
			$this->revision_no_5->TooltipValue = "";

			// direction_5
			$this->direction_5->LinkCustomAttributes = "";
			$this->direction_5->HrefValue = "";
			$this->direction_5->TooltipValue = "";

			// planned_date_5
			$this->planned_date_5->LinkCustomAttributes = "";
			$this->planned_date_5->HrefValue = "";
			$this->planned_date_5->TooltipValue = "";

			// transmit_date_5
			$this->transmit_date_5->LinkCustomAttributes = "";
			$this->transmit_date_5->HrefValue = "";
			$this->transmit_date_5->TooltipValue = "";

			// transmit_no_5
			$this->transmit_no_5->LinkCustomAttributes = "";
			$this->transmit_no_5->HrefValue = "";
			$this->transmit_no_5->TooltipValue = "";

			// approval_status_5
			$this->approval_status_5->LinkCustomAttributes = "";
			$this->approval_status_5->HrefValue = "";
			$this->approval_status_5->TooltipValue = "";

			// submit_no_6
			$this->submit_no_6->LinkCustomAttributes = "";
			$this->submit_no_6->HrefValue = "";
			$this->submit_no_6->TooltipValue = "";

			// revision_no_6
			$this->revision_no_6->LinkCustomAttributes = "";
			$this->revision_no_6->HrefValue = "";
			$this->revision_no_6->TooltipValue = "";

			// direction_6
			$this->direction_6->LinkCustomAttributes = "";
			$this->direction_6->HrefValue = "";
			$this->direction_6->TooltipValue = "";

			// planned_date_6
			$this->planned_date_6->LinkCustomAttributes = "";
			$this->planned_date_6->HrefValue = "";
			$this->planned_date_6->TooltipValue = "";

			// transmit_date_6
			$this->transmit_date_6->LinkCustomAttributes = "";
			$this->transmit_date_6->HrefValue = "";
			$this->transmit_date_6->TooltipValue = "";

			// transmit_no_6
			$this->transmit_no_6->LinkCustomAttributes = "";
			$this->transmit_no_6->HrefValue = "";
			$this->transmit_no_6->TooltipValue = "";

			// approval_status_6
			$this->approval_status_6->LinkCustomAttributes = "";
			$this->approval_status_6->HrefValue = "";
			$this->approval_status_6->TooltipValue = "";

			// submit_no_7
			$this->submit_no_7->LinkCustomAttributes = "";
			$this->submit_no_7->HrefValue = "";
			$this->submit_no_7->TooltipValue = "";

			// revision_no_7
			$this->revision_no_7->LinkCustomAttributes = "";
			$this->revision_no_7->HrefValue = "";
			$this->revision_no_7->TooltipValue = "";

			// direction_7
			$this->direction_7->LinkCustomAttributes = "";
			$this->direction_7->HrefValue = "";
			$this->direction_7->TooltipValue = "";

			// planned_date_7
			$this->planned_date_7->LinkCustomAttributes = "";
			$this->planned_date_7->HrefValue = "";
			$this->planned_date_7->TooltipValue = "";

			// transmit_date_7
			$this->transmit_date_7->LinkCustomAttributes = "";
			$this->transmit_date_7->HrefValue = "";
			$this->transmit_date_7->TooltipValue = "";

			// transmit_no_7
			$this->transmit_no_7->LinkCustomAttributes = "";
			$this->transmit_no_7->HrefValue = "";
			$this->transmit_no_7->TooltipValue = "";

			// approval_status_7
			$this->approval_status_7->LinkCustomAttributes = "";
			$this->approval_status_7->HrefValue = "";
			$this->approval_status_7->TooltipValue = "";

			// submit_no_8
			$this->submit_no_8->LinkCustomAttributes = "";
			$this->submit_no_8->HrefValue = "";
			$this->submit_no_8->TooltipValue = "";

			// revision_no_8
			$this->revision_no_8->LinkCustomAttributes = "";
			$this->revision_no_8->HrefValue = "";
			$this->revision_no_8->TooltipValue = "";

			// direction_8
			$this->direction_8->LinkCustomAttributes = "";
			$this->direction_8->HrefValue = "";
			$this->direction_8->TooltipValue = "";

			// planned_date_8
			$this->planned_date_8->LinkCustomAttributes = "";
			$this->planned_date_8->HrefValue = "";
			$this->planned_date_8->TooltipValue = "";

			// transmit_date_8
			$this->transmit_date_8->LinkCustomAttributes = "";
			$this->transmit_date_8->HrefValue = "";
			$this->transmit_date_8->TooltipValue = "";

			// transmit_no_8
			$this->transmit_no_8->LinkCustomAttributes = "";
			$this->transmit_no_8->HrefValue = "";
			$this->transmit_no_8->TooltipValue = "";

			// approval_status_8
			$this->approval_status_8->LinkCustomAttributes = "";
			$this->approval_status_8->HrefValue = "";
			$this->approval_status_8->TooltipValue = "";

			// submit_no_9
			$this->submit_no_9->LinkCustomAttributes = "";
			$this->submit_no_9->HrefValue = "";
			$this->submit_no_9->TooltipValue = "";

			// revision_no_9
			$this->revision_no_9->LinkCustomAttributes = "";
			$this->revision_no_9->HrefValue = "";
			$this->revision_no_9->TooltipValue = "";

			// direction_9
			$this->direction_9->LinkCustomAttributes = "";
			$this->direction_9->HrefValue = "";
			$this->direction_9->TooltipValue = "";

			// planned_date_9
			$this->planned_date_9->LinkCustomAttributes = "";
			$this->planned_date_9->HrefValue = "";
			$this->planned_date_9->TooltipValue = "";

			// transmit_date_9
			$this->transmit_date_9->LinkCustomAttributes = "";
			$this->transmit_date_9->HrefValue = "";
			$this->transmit_date_9->TooltipValue = "";

			// transmit_no_9
			$this->transmit_no_9->LinkCustomAttributes = "";
			$this->transmit_no_9->HrefValue = "";
			$this->transmit_no_9->TooltipValue = "";

			// approval_status_9
			$this->approval_status_9->LinkCustomAttributes = "";
			$this->approval_status_9->HrefValue = "";
			$this->approval_status_9->TooltipValue = "";

			// submit_no_10
			$this->submit_no_10->LinkCustomAttributes = "";
			$this->submit_no_10->HrefValue = "";
			$this->submit_no_10->TooltipValue = "";

			// revision_no_10
			$this->revision_no_10->LinkCustomAttributes = "";
			$this->revision_no_10->HrefValue = "";
			$this->revision_no_10->TooltipValue = "";

			// direction_10
			$this->direction_10->LinkCustomAttributes = "";
			$this->direction_10->HrefValue = "";
			$this->direction_10->TooltipValue = "";

			// planned_date_10
			$this->planned_date_10->LinkCustomAttributes = "";
			$this->planned_date_10->HrefValue = "";
			$this->planned_date_10->TooltipValue = "";

			// transmit_date_10
			$this->transmit_date_10->LinkCustomAttributes = "";
			$this->transmit_date_10->HrefValue = "";
			$this->transmit_date_10->TooltipValue = "";

			// transmit_no_10
			$this->transmit_no_10->LinkCustomAttributes = "";
			$this->transmit_no_10->HrefValue = "";
			$this->transmit_no_10->TooltipValue = "";

			// approval_status_10
			$this->approval_status_10->LinkCustomAttributes = "";
			$this->approval_status_10->HrefValue = "";
			$this->approval_status_10->TooltipValue = "";

			// log_updatedon
			$this->log_updatedon->LinkCustomAttributes = "";
			$this->log_updatedon->HrefValue = "";
			$this->log_updatedon->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"ew.export(document.fdocument_logview,'" . $this->ExportExcelUrl . "','excel',true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"ew.export(document.fdocument_logview,'" . $this->ExportWordUrl . "','word',true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"ew.export(document.fdocument_logview,'" . $this->ExportPdfUrl . "','pdf',true);\">" . $Language->phrase("ExportToPDF") . "</a>";
			else
				return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
		} elseif (SameText($type, "html")) {
			return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
		} elseif (SameText($type, "xml")) {
			return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
		} elseif (SameText($type, "csv")) {
			return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
		} elseif (SameText($type, "print")) {
			return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = FALSE;

		// Export to Html
		$item = &$this->ExportOptions->add("html");
		$item->Body = $this->getExportTag("html");
		$item->Visible = FALSE;

		// Export to Xml
		$item = &$this->ExportOptions->add("xml");
		$item->Body = $this->getExportTag("xml");
		$item->Visible = FALSE;

		// Export to Csv
		$item = &$this->ExportOptions->add("csv");
		$item->Body = $this->getExportTag("csv");
		$item->Visible = FALSE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$url = "";
		$item->Body = "<button id=\"emf_document_log\" class=\"ew-export-link ew-email\" title=\"" . $Language->phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->phrase("ExportToEmailText") . "\" onclick=\"ew.emailDialogShow({lnk:'emf_document_log',hdr:ew.language.phrase('ExportToEmailText'),f:document.fdocument_logview,key:" . ArrayToJsonAttribute($this->RecKey) . ",sel:false" . $url . "});\">" . $Language->phrase("ExportToEmail") . "</button>";
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = TRUE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->isExport())
			$this->ExportOptions->hideAllOptions();
	}

	/**
	 * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	 *
	 * @param boolean $return Return the data rather than output it
	 * @return mixed 
	 */
	public function exportData($return = FALSE)
	{
		global $Language;
		$utf8 = SameText(PROJECT_CHARSET, "utf-8");
		$selectLimit = FALSE;

		// Load recordset
		if ($selectLimit) {
			$this->TotalRecs = $this->listRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->loadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;
		$this->setupStartRec(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecs <= 0) {
			$this->StopRec = $this->TotalRecs;
		} else {
			$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
		}
		$this->ExportDoc = GetExportDocument($this, "v");
		$doc = &$this->ExportDoc;
		if (!$doc)
			$this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
		if (!$rs || !$doc) {
			RemoveHeader("Content-Type"); // Remove header
			RemoveHeader("Content-Disposition");
			$this->showMessage();
			return;
		}
		if ($selectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		$doc->Text .= $header;
		$this->exportDocument($doc, $rs, $this->StartRec, $this->StopRec, "view");
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		$doc->Text .= $footer;

		// Close recordset
		$rs->close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$doc->exportHeaderAndFooter();

		// Clean output buffer (without destroying output buffer)
		$buffer = ob_get_contents(); // Save the output buffer
		if (!DEBUG_ENABLED && $buffer)
			ob_clean();

		// Write debug message if enabled
		if (DEBUG_ENABLED && !$this->isExport("pdf"))
			echo GetDebugMessage();

		// Output data
		if ($this->isExport("email")) {

			// Export-to-email disabled
		} else {
			$doc->export();
			if ($return) {
				RemoveHeader("Content-Type"); // Remove header
				RemoveHeader("Content-Disposition");
				$content = ob_get_contents();
				if ($content)
					ob_clean();
				if ($buffer)
					echo $buffer; // Resume the output buffer
				return $content;
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("document_loglist.php"), "", $this->TableVar, TRUE);
		$pageId = "view";
		$Breadcrumb->add("view", $pageId, $url);
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

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>