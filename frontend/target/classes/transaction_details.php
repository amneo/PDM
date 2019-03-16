<?php
namespace PHPMaker2019\pdm;

/**
 * Table class for transaction_details
 */
class transaction_details extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $document_sequence;
	public $firelink_doc_no;
	public $submit_no;
	public $revision_no;
	public $transmit_no;
	public $transmit_date;
	public $direction;
	public $approval_status;
	public $document_link;
	public $transaction_date;
	public $document_native;
	public $username;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'transaction_details';
		$this->TableName = 'transaction_details';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "\"public\".\"transaction_details\"";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 104; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);
		$this->BasicSearch->TypeDefault = "OR";

		// document_sequence
		$this->document_sequence = new DbField('transaction_details', 'transaction_details', 'x_document_sequence', 'document_sequence', '"document_sequence"', 'CAST("document_sequence" AS varchar(255))', 3, -1, FALSE, '"document_sequence"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->document_sequence->IsAutoIncrement = TRUE; // Autoincrement field
		$this->document_sequence->IsPrimaryKey = TRUE; // Primary key field
		$this->document_sequence->Nullable = FALSE; // NOT NULL field
		$this->document_sequence->Sortable = FALSE; // Allow sort
		$this->document_sequence->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['document_sequence'] = &$this->document_sequence;

		// firelink_doc_no
		$this->firelink_doc_no = new DbField('transaction_details', 'transaction_details', 'x_firelink_doc_no', 'firelink_doc_no', '"firelink_doc_no"', '"firelink_doc_no"', 200, -1, FALSE, '"EV__firelink_doc_no"', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->firelink_doc_no->Nullable = FALSE; // NOT NULL field
		$this->firelink_doc_no->Required = TRUE; // Required field
		$this->firelink_doc_no->Sortable = TRUE; // Allow sort
		$this->firelink_doc_no->Lookup = new Lookup('firelink_doc_no', 'document_details', FALSE, 'firelink_doc_no', ["firelink_doc_no","document_tittle","project_name",""], [], [], [], [], [], [], '"document_sequence" DESC', '');
		$this->fields['firelink_doc_no'] = &$this->firelink_doc_no;

		// submit_no
		$this->submit_no = new DbField('transaction_details', 'transaction_details', 'x_submit_no', 'submit_no', '"submit_no"', '"submit_no"', 200, -1, FALSE, '"submit_no"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->submit_no->Nullable = FALSE; // NOT NULL field
		$this->submit_no->Required = TRUE; // Required field
		$this->submit_no->Sortable = TRUE; // Allow sort
		$this->fields['submit_no'] = &$this->submit_no;

		// revision_no
		$this->revision_no = new DbField('transaction_details', 'transaction_details', 'x_revision_no', 'revision_no', '"revision_no"', '"revision_no"', 200, -1, FALSE, '"revision_no"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->revision_no->Nullable = FALSE; // NOT NULL field
		$this->revision_no->Required = TRUE; // Required field
		$this->revision_no->Sortable = TRUE; // Allow sort
		$this->fields['revision_no'] = &$this->revision_no;

		// transmit_no
		$this->transmit_no = new DbField('transaction_details', 'transaction_details', 'x_transmit_no', 'transmit_no', '"transmit_no"', '"transmit_no"', 200, -1, FALSE, '"EV__transmit_no"', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_no->Nullable = FALSE; // NOT NULL field
		$this->transmit_no->Required = TRUE; // Required field
		$this->transmit_no->Sortable = TRUE; // Allow sort
		$this->transmit_no->Lookup = new Lookup('transmit_no', 'transmit_details', FALSE, 'transmittal_no', ["transmittal_no","project_name","",""], [], [], [], [], [], [], '"transmit_id" DESC', '');
		$this->fields['transmit_no'] = &$this->transmit_no;

		// transmit_date
		$this->transmit_date = new DbField('transaction_details', 'transaction_details', 'x_transmit_date', 'transmit_date', '"transmit_date"', CastDateFieldForLike('"transmit_date"', 0, "DB"), 133, 0, FALSE, '"transmit_date"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmit_date->Nullable = FALSE; // NOT NULL field
		$this->transmit_date->Required = TRUE; // Required field
		$this->transmit_date->Sortable = TRUE; // Allow sort
		$this->transmit_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmit_date'] = &$this->transmit_date;

		// direction
		$this->direction = new DbField('transaction_details', 'transaction_details', 'x_direction', 'direction', '"direction"', '"direction"', 200, -1, FALSE, '"direction"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->direction->Nullable = FALSE; // NOT NULL field
		$this->direction->Required = TRUE; // Required field
		$this->direction->Sortable = TRUE; // Allow sort
		$this->direction->Lookup = new Lookup('direction', 'transaction_details', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->direction->OptionCount = 2;
		$this->fields['direction'] = &$this->direction;

		// approval_status
		$this->approval_status = new DbField('transaction_details', 'transaction_details', 'x_approval_status', 'approval_status', '"approval_status"', '"approval_status"', 200, -1, FALSE, '"approval_status"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->approval_status->Nullable = FALSE; // NOT NULL field
		$this->approval_status->Required = TRUE; // Required field
		$this->approval_status->Sortable = TRUE; // Allow sort
		$this->approval_status->Lookup = new Lookup('approval_status', 'approval_details', FALSE, 'short_code', ["short_code","Description","",""], [], [], [], [], [], [], '', '');
		$this->fields['approval_status'] = &$this->approval_status;

		// document_link
		$this->document_link = new DbField('transaction_details', 'transaction_details', 'x_document_link', 'document_link', '"document_link"', '"document_link"', 200, -1, TRUE, '"document_link"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->document_link->Nullable = FALSE; // NOT NULL field
		$this->document_link->Required = TRUE; // Required field
		$this->document_link->Sortable = TRUE; // Allow sort
		$this->document_link->UploadAllowedFileExt = "pdf";
		$this->fields['document_link'] = &$this->document_link;

		// transaction_date
		$this->transaction_date = new DbField('transaction_details', 'transaction_details', 'x_transaction_date', 'transaction_date', '"transaction_date"', CastDateFieldForLike('"transaction_date"', 0, "DB"), 135, 0, FALSE, '"transaction_date"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->transaction_date->Sortable = FALSE; // Allow sort
		$this->transaction_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transaction_date'] = &$this->transaction_date;

		// document_native
		$this->document_native = new DbField('transaction_details', 'transaction_details', 'x_document_native', 'document_native', '"document_native"', '"document_native"', 201, -1, FALSE, '"document_native"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->document_native->Nullable = FALSE; // NOT NULL field
		$this->document_native->Required = TRUE; // Required field
		$this->document_native->Sortable = TRUE; // Allow sort
		$this->fields['document_native'] = &$this->document_native;

		// username
		$this->username = new DbField('transaction_details', 'transaction_details', 'x_username', 'username', '"username"', '"username"', 200, -1, FALSE, '"username"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->username->Sortable = FALSE; // Allow sort
		$this->fields['username'] = &$this->username;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Multiple column sort
	public function updateSort(&$fld, $ctrl)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($ctrl) {
				$orderBy = $this->getSessionOrderBy();
				if (ContainsString($orderBy, $sortField . " " . $lastSort)) {
					$orderBy = str_replace($sortField . " " . $lastSort, $sortField . " " . $thisSort, $orderBy);
				} else {
					if ($orderBy <> "")
						$orderBy .= ", ";
					$orderBy .= $sortField . " " . $thisSort;
				}
				$this->setSessionOrderBy($orderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
			}
			$sortFieldList = ($fld->VirtualExpression <> "") ? $fld->VirtualExpression : $sortField;
			if ($ctrl) {
				$orderByList = $this->getSessionOrderByList();
				if (ContainsString($orderByList, $sortFieldList . " " . $lastSort)) {
					$orderByList = str_replace($sortFieldList . " " . $lastSort, $sortFieldList . " " . $thisSort, $orderByList);
				} else {
					if ($orderByList <> "") $orderByList .= ", ";
					$orderByList .= $sortFieldList . " " . $thisSort;
				}
				$this->setSessionOrderByList($orderByList); // Save to Session
			} else {
				$this->setSessionOrderByList($sortFieldList . " " . $thisSort); // Save to Session
			}
		} else {
			if (!$ctrl)
				$fld->setSort("");
		}
	}

	// Session ORDER BY for List page
	public function getSessionOrderByList()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_ORDER_BY_LIST];
	}
	public function setSessionOrderByList($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_ORDER_BY_LIST] = $v;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "\"public\".\"transaction_details\"";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlSelectList() // Select for List page
	{
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT \"firelink_doc_no\" || '" . ValueSeparator(1, $this->firelink_doc_no) . "' || \"document_tittle\" || '" . ValueSeparator(2, $this->firelink_doc_no) . "' || \"project_name\" FROM \"public\".\"document_details\" \"TMP_LOOKUPTABLE\" WHERE \"TMP_LOOKUPTABLE\".\"firelink_doc_no\" = \"transaction_details\".\"firelink_doc_no\" LIMIT 1) AS \"EV__firelink_doc_no\", (SELECT \"transmittal_no\" || '" . ValueSeparator(1, $this->transmit_no) . "' || \"project_name\" FROM \"public\".\"transmit_details\" \"TMP_LOOKUPTABLE\" WHERE \"TMP_LOOKUPTABLE\".\"transmittal_no\" = \"transaction_details\".\"transmit_no\" LIMIT 1) AS \"EV__transmit_no\" FROM \"public\".\"transaction_details\"" .
			") \"TMP_TABLE\"";
		return ($this->SqlSelectList <> "") ? $this->SqlSelectList : $select;
	}
	public function sqlSelectList() // For backward compatibility
	{
		return $this->getSqlSelectList();
	}
	public function setSqlSelectList($v)
	{
		$this->SqlSelectList = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "\"document_sequence\" DESC";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		if ($this->useVirtualFields()) {
			$select = $this->getSqlSelectList();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		} else {
			$select = $this->getSqlSelect();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		}
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = ($this->useVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Check if virtual fields is used in SQL
	protected function useVirtualFields()
	{
		$where = $this->UseSessionForListSql ? $this->getSessionWhere() : $this->CurrentFilter;
		$orderBy = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		if ($where <> "")
			$where = " " . str_replace(array("(",")"), array("",""), $where) . " ";
		if ($orderBy <> "")
			$orderBy = " " . str_replace(array("(",")"), array("",""), $orderBy) . " ";
		if ($this->BasicSearch->getKeyword() <> "")
			return TRUE;
		if ($this->firelink_doc_no->AdvancedSearch->SearchValue <> "" ||
			$this->firelink_doc_no->AdvancedSearch->SearchValue2 <> "" ||
			ContainsString($where, " " . $this->firelink_doc_no->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->firelink_doc_no->VirtualExpression . " "))
			return TRUE;
		if ($this->transmit_no->AdvancedSearch->SearchValue <> "" ||
			$this->transmit_no->AdvancedSearch->SearchValue2 <> "" ||
			ContainsString($where, " " . $this->transmit_no->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->transmit_no->VirtualExpression . " "))
			return TRUE;
		return FALSE;
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		if ($this->useVirtualFields())
			$sql = BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		else
			$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->document_sequence->setDbValue($conn->getOne("SELECT currval('transaction_details_document_sequence_seq'::regclass)"));
			$rs['document_sequence'] = $this->document_sequence->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'document_sequence';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('document_sequence', $rs))
				AddFilter($where, QuotedName('document_sequence', $this->Dbid) . '=' . QuotedValue($rs['document_sequence'], $this->document_sequence->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->document_sequence->DbValue = $row['document_sequence'];
		$this->firelink_doc_no->DbValue = $row['firelink_doc_no'];
		$this->submit_no->DbValue = $row['submit_no'];
		$this->revision_no->DbValue = $row['revision_no'];
		$this->transmit_no->DbValue = $row['transmit_no'];
		$this->transmit_date->DbValue = $row['transmit_date'];
		$this->direction->DbValue = $row['direction'];
		$this->approval_status->DbValue = $row['approval_status'];
		$this->document_link->Upload->DbValue = $row['document_link'];
		$this->transaction_date->DbValue = $row['transaction_date'];
		$this->document_native->DbValue = $row['document_native'];
		$this->username->DbValue = $row['username'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['document_link']) ? [] : [$row['document_link']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->document_link->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->document_link->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "\"document_sequence\" = @document_sequence@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('document_sequence', $row) ? $row['document_sequence'] : NULL) : $this->document_sequence->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@document_sequence@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "transaction_detailslist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "transaction_detailsview.php")
			return $Language->phrase("View");
		elseif ($pageName == "transaction_detailsedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "transaction_detailsadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "transaction_detailslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("transaction_detailsview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("transaction_detailsview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "transaction_detailsadd.php?" . $this->getUrlParm($parm);
		else
			$url = "transaction_detailsadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("transaction_detailsedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("transaction_detailsadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("transaction_detailsdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "document_sequence:" . JsonEncode($this->document_sequence->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->document_sequence->CurrentValue != NULL) {
			$url .= "document_sequence=" . urlencode($this->document_sequence->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("document_sequence") !== NULL)
				$arKeys[] = Param("document_sequence");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->document_sequence->CurrentValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->document_sequence->setDbValue($rs->fields('document_sequence'));
		$this->firelink_doc_no->setDbValue($rs->fields('firelink_doc_no'));
		$this->submit_no->setDbValue($rs->fields('submit_no'));
		$this->revision_no->setDbValue($rs->fields('revision_no'));
		$this->transmit_no->setDbValue($rs->fields('transmit_no'));
		$this->transmit_date->setDbValue($rs->fields('transmit_date'));
		$this->direction->setDbValue($rs->fields('direction'));
		$this->approval_status->setDbValue($rs->fields('approval_status'));
		$this->document_link->Upload->DbValue = $rs->fields('document_link');
		$this->transaction_date->setDbValue($rs->fields('transaction_date'));
		$this->document_native->setDbValue($rs->fields('document_native'));
		$this->username->setDbValue($rs->fields('username'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// document_sequence

		$this->document_sequence->CellCssStyle = "white-space: nowrap;";

		// firelink_doc_no
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

		$this->username->CellCssStyle = "white-space: nowrap;";

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
					$arwrk[3] = $rswrk->fields('df3');
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

		// submit_no
		$this->submit_no->ViewValue = $this->submit_no->CurrentValue;
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
					$arwrk[2] = $rswrk->fields('df2');
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

		// username
		$this->username->ViewValue = $this->username->CurrentValue;
		$this->username->ViewCustomAttributes = "";

		// document_sequence
		$this->document_sequence->LinkCustomAttributes = "";
		$this->document_sequence->HrefValue = "";
		$this->document_sequence->TooltipValue = "";

		// firelink_doc_no
		$this->firelink_doc_no->LinkCustomAttributes = "";
		$this->firelink_doc_no->HrefValue = "";
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

		// transaction_date
		$this->transaction_date->LinkCustomAttributes = "";
		$this->transaction_date->HrefValue = "";
		$this->transaction_date->TooltipValue = "";

		// document_native
		$this->document_native->LinkCustomAttributes = "";
		$this->document_native->HrefValue = "";
		$this->document_native->TooltipValue = "";

		// username
		$this->username->LinkCustomAttributes = "";
		$this->username->HrefValue = "";
		$this->username->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// document_sequence
		$this->document_sequence->EditAttrs["class"] = "form-control";
		$this->document_sequence->EditCustomAttributes = "";
		$this->document_sequence->EditValue = $this->document_sequence->CurrentValue;
		$this->document_sequence->CellCssStyle .= "text-align: left;";
		$this->document_sequence->ViewCustomAttributes = "";

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
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$arwrk[3] = $rswrk->fields('df3');
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
		$this->submit_no->CellCssStyle .= "text-align: left;";
		$this->submit_no->ViewCustomAttributes = "";

		// revision_no
		$this->revision_no->EditAttrs["class"] = "form-control";
		$this->revision_no->EditCustomAttributes = "";
		$this->revision_no->EditValue = $this->revision_no->CurrentValue;
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
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
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
		$this->transmit_no->ViewCustomAttributes = "";

		// transmit_date
		$this->transmit_date->EditAttrs["class"] = "form-control";
		$this->transmit_date->EditCustomAttributes = "";
		$this->transmit_date->EditValue = $this->transmit_date->CurrentValue;
		$this->transmit_date->EditValue = FormatDateTime($this->transmit_date->EditValue, 0);
		$this->transmit_date->ViewCustomAttributes = "";

		// direction
		$this->direction->EditCustomAttributes = "";
		$this->direction->EditValue = $this->direction->options(FALSE);

		// approval_status
		$this->approval_status->EditCustomAttributes = "";

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

		// transaction_date
		$this->transaction_date->EditAttrs["class"] = "form-control";
		$this->transaction_date->EditCustomAttributes = "";
		$this->transaction_date->EditValue = FormatDateTime($this->transaction_date->CurrentValue, 8);
		$this->transaction_date->PlaceHolder = RemoveHtml($this->transaction_date->caption());

		// document_native
		$this->document_native->EditAttrs["class"] = "form-control";
		$this->document_native->EditCustomAttributes = "";
		$this->document_native->EditValue = $this->document_native->CurrentValue;
		$this->document_native->PlaceHolder = RemoveHtml($this->document_native->caption());

		// username
		// Call Row Rendered event

		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->firelink_doc_no);
					$doc->exportCaption($this->submit_no);
					$doc->exportCaption($this->revision_no);
					$doc->exportCaption($this->transmit_no);
					$doc->exportCaption($this->transmit_date);
					$doc->exportCaption($this->direction);
					$doc->exportCaption($this->approval_status);
					$doc->exportCaption($this->document_link);
					$doc->exportCaption($this->document_native);
				} else {
					$doc->exportCaption($this->document_sequence);
					$doc->exportCaption($this->firelink_doc_no);
					$doc->exportCaption($this->submit_no);
					$doc->exportCaption($this->revision_no);
					$doc->exportCaption($this->transmit_no);
					$doc->exportCaption($this->transmit_date);
					$doc->exportCaption($this->direction);
					$doc->exportCaption($this->approval_status);
					$doc->exportCaption($this->transaction_date);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->firelink_doc_no);
						$doc->exportField($this->submit_no);
						$doc->exportField($this->revision_no);
						$doc->exportField($this->transmit_no);
						$doc->exportField($this->transmit_date);
						$doc->exportField($this->direction);
						$doc->exportField($this->approval_status);
						$doc->exportField($this->document_link);
						$doc->exportField($this->document_native);
					} else {
						$doc->exportField($this->document_sequence);
						$doc->exportField($this->firelink_doc_no);
						$doc->exportField($this->submit_no);
						$doc->exportField($this->revision_no);
						$doc->exportField($this->transmit_no);
						$doc->exportField($this->transmit_date);
						$doc->exportField($this->direction);
						$doc->exportField($this->approval_status);
						$doc->exportField($this->transaction_date);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Lookup data from table
	public function lookup()
	{
		global $Language, $LANGUAGE_FOLDER, $PROJECT_ID;
		if (!isset($Language))
			$Language = new Language($LANGUAGE_FOLDER, Post("language", ""));
		global $Security, $RequestSecurity;

		// Check token first
		$func = PROJECT_NAMESPACE . "CheckToken";
		$validRequest = FALSE;
		if (is_callable($func) && Post(TOKEN_NAME) !== NULL) {
			$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			if ($validRequest) {
				if (!isset($Security)) {
					if (session_status() !== PHP_SESSION_ACTIVE)
						session_start(); // Init session data
					$Security = new AdvancedSecurity();
					if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
					$Security->loadCurrentUserLevel($PROJECT_ID . $this->TableName);
					if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
					$validRequest = $Security->canList(); // List permission
					if ($validRequest) {
						$Security->UserID_Loading();
						$Security->loadUserID();
						$Security->UserID_Loaded();
					}
				}
			}
		} else {

			// User profile
			$UserProfile = new UserProfile();

			// Security
			$Security = new AdvancedSecurity();
			if (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
			$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(CurrentProjectID() . $this->TableName);
			$Security->TablePermission_Loaded();
			$validRequest = $Security->canList(); // List permission
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");

		// Selected records from modal, skip parent/filter fields and show all records
		if ($keys !== NULL) {
			$parentFields = [];
			$filterFields = [];
			$filterFieldVars = [];
			$offset = 0;
			$pageSize = 0;
		}

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{
		global $COMPOSITE_KEY_SEPARATOR;

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'document_link') {
			$fldName = "document_link";
			$fileNameFld = "document_link";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode($COMPOSITE_KEY_SEPARATOR, $key);
		if (count($ar) == 1) {
			$this->document_sequence->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype <> "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld <> "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					if ($fileNameFld <> "" && !EmptyValue($rs->fields($fileNameFld)))
						AddHeader("Content-Disposition", "attachment; filename=\"" . $rs->fields($fileNameFld) . "\"");

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear output buffer
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
		return FALSE;
	}

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'transaction_details';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'transaction_details';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['document_sequence'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 'transaction_details';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['document_sequence'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) <> FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 'transaction_details';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['document_sequence'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE
		//Code to change the file name to our requirement and save the same way at server and database.
		// Code to determine submit numberis less than 2 digits if so pad them with number this is to ensure that the file names are consistant

		if($rsnew["submit_no"] < 10)
		{
		$rsnew["submit_no"] = str_pad($rsnew["submit_no"],2,"0",STR_PAD_LEFT);
		}
		if($rsnew["revision_no"] < 10)
		{
		$rsnew["revision_no"] = str_pad($rsnew["revision_no"],2,"0",STR_PAD_LEFT);
		}
		if($rsnew["direction"] ==  "OUT"){

		//$fExtension = new SplFileInfo($rsnew["document_link"]);
		//$rsnew["document_link"] = $rsnew["firelink_doc_no"]."-".$rsnew["submit_no"]."-".$rsnew["revision_no"].".".$fExtension->getExtension();

		$rsnew["document_link"] = $rsnew["firelink_doc_no"]."-".$rsnew["submit_no"]."-".$rsnew["revision_no"].".pdf";
		}else{

		//$fExtension = new SplFileInfo($rsnew["document_link"]);
		$rsnew["document_link"] = $rsnew["firelink_doc_no"]."-".$rsnew["submit_no"]."_".$rsnew["revision_no"].".pdf";
		}
		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>