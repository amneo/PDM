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
		$item->Visible = TRUE;

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
		$item->Visible = TRUE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$url = "";
		$item->Body = "<button id=\"emf_document_log\" class=\"ew-export-link ew-email\" title=\"" . $Language->phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->phrase("ExportToEmailText") . "\" onclick=\"ew.emailDialogShow({lnk:'emf_document_log',hdr:ew.language.phrase('ExportToEmailText'),f:document.fdocument_logview,key:" . ArrayToJsonAttribute($this->RecKey) . ",sel:false" . $url . "});\">" . $Language->phrase("ExportToEmail") . "</button>";
		$item->Visible = TRUE;

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
			if ($return)
				return $doc->Text; // Return email content
			else
				echo $this->exportEmail($doc->Text); // Send email
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

	// Export email
	protected function exportEmail($emailContent)
	{
		global $TempImages, $Language;
		$sender = Post("sender", "");
		$recipient = Post("recipient", "");
		$cc = Post("cc", "");
		$bcc = Post("bcc", "");

		// Subject
		$subject = Post("subject", "");
		$emailSubject = $subject;

		// Message
		$content = Post("message", "");
		$emailMessage = $content;

		// Check sender
		if ($sender == "") {
			return "<p class=\"text-danger\">" . $Language->phrase("EnterSenderEmail") . "</p>";
		}
		if (!CheckEmail($sender)) {
			return "<p class=\"text-danger\">" . $Language->phrase("EnterProperSenderEmail") . "</p>";
		}

		// Check recipient
		if (!CheckEmailList($recipient, MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->phrase("EnterProperRecipientEmail") . "</p>";
		}

		// Check cc
		if (!CheckEmailList($cc, MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->phrase("EnterProperCcEmail") . "</p>";
		}

		// Check bcc
		if (!CheckEmailList($bcc, MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->phrase("EnterProperBccEmail") . "</p>";
		}

		// Check email sent count
		if (!isset($_SESSION[EXPORT_EMAIL_COUNTER]))
			$_SESSION[EXPORT_EMAIL_COUNTER] = 0;
		if ((int)$_SESSION[EXPORT_EMAIL_COUNTER] > MAX_EMAIL_SENT_COUNT) {
			return "<p class=\"text-danger\">" . $Language->phrase("ExceedMaxEmailExport") . "</p>";
		}

		// Send email
		$email = new Email();
		$email->Sender = $sender; // Sender
		$email->Recipient = $recipient; // Recipient
		$email->Cc = $cc; // Cc
		$email->Bcc = $bcc; // Bcc
		$email->Subject = $emailSubject; // Subject
		$email->Format = "html";
		if ($emailMessage <> "")
			$emailMessage = RemoveXss($emailMessage) . "<br><br>";
		foreach ($TempImages as $tmpImage)
			$email->addEmbeddedImage($tmpImage);
		$email->Content = $emailMessage . CleanEmailContent($emailContent); // Content
		$eventArgs = [];
		if ($this->Recordset) {
			$this->RecCnt = $this->StartRec - 1;
			$this->Recordset->moveFirst();
			if ($this->StartRec > 1)
				$this->Recordset->move($this->StartRec - 1);
			$eventArgs["rs"] = &$this->Recordset;
		}
		$emailSent = FALSE;
		if ($this->Email_Sending($email, $eventArgs))
			$emailSent = $email->send();

		// Check email sent status
		if ($emailSent) {

			// Update email sent count
			$_SESSION[EXPORT_EMAIL_COUNTER]++;

			// Sent email success
			return "<p class=\"text-success\">" . $Language->phrase("SendEmailSuccess") . "</p>"; // Set up success message
		} else {

			// Sent email failure
			return "<p class=\"text-danger\">" . $email->SendErrDescription . "</p>";
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