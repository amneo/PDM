<?php
namespace PHPMaker2019\pdm;

/**
 * Table class for document_details
 */
class document_details extends DbTable
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
	public $client_doc_no;
	public $document_tittle;
	public $project_name;
	public $project_system;
	public $create_date;
	public $planned_date;
	public $document_type;
	public $expiry_date;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'document_details';
		$this->TableName = 'document_details';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "\"public\".\"document_details\"";
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

		// document_sequence
		$this->document_sequence = new DbField('document_details', 'document_details', 'x_document_sequence', 'document_sequence', '"document_sequence"', 'CAST("document_sequence" AS varchar(255))', 3, -1, FALSE, '"document_sequence"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->document_sequence->IsAutoIncrement = TRUE; // Autoincrement field
		$this->document_sequence->IsPrimaryKey = TRUE; // Primary key field
		$this->document_sequence->Nullable = FALSE; // NOT NULL field
		$this->document_sequence->Sortable = FALSE; // Allow sort
		$this->document_sequence->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['document_sequence'] = &$this->document_sequence;

		// firelink_doc_no
		$this->firelink_doc_no = new DbField('document_details', 'document_details', 'x_firelink_doc_no', 'firelink_doc_no', '"firelink_doc_no"', '"firelink_doc_no"', 200, -1, FALSE, '"firelink_doc_no"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->firelink_doc_no->Nullable = FALSE; // NOT NULL field
		$this->firelink_doc_no->Required = TRUE; // Required field
		$this->firelink_doc_no->Sortable = TRUE; // Allow sort
		$this->fields['firelink_doc_no'] = &$this->firelink_doc_no;

		// client_doc_no
		$this->client_doc_no = new DbField('document_details', 'document_details', 'x_client_doc_no', 'client_doc_no', '"client_doc_no"', '"client_doc_no"', 200, -1, FALSE, '"client_doc_no"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->client_doc_no->Nullable = FALSE; // NOT NULL field
		$this->client_doc_no->Required = TRUE; // Required field
		$this->client_doc_no->Sortable = TRUE; // Allow sort
		$this->fields['client_doc_no'] = &$this->client_doc_no;

		// document_tittle
		$this->document_tittle = new DbField('document_details', 'document_details', 'x_document_tittle', 'document_tittle', '"document_tittle"', '"document_tittle"', 200, -1, FALSE, '"document_tittle"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->document_tittle->Nullable = FALSE; // NOT NULL field
		$this->document_tittle->Required = TRUE; // Required field
		$this->document_tittle->Sortable = TRUE; // Allow sort
		$this->fields['document_tittle'] = &$this->document_tittle;

		// project_name
		$this->project_name = new DbField('document_details', 'document_details', 'x_project_name', 'project_name', '"project_name"', '"project_name"', 200, -1, FALSE, '"EV__project_name"', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->project_name->Nullable = FALSE; // NOT NULL field
		$this->project_name->Required = TRUE; // Required field
		$this->project_name->Sortable = TRUE; // Allow sort
		$this->project_name->Lookup = new Lookup('project_name', 'project_details', FALSE, 'project_id', ["project_name","project_id","project_our_client",""], [], [], [], [], [], [], '"project_id" DESC', '');
		$this->fields['project_name'] = &$this->project_name;

		// project_system
		$this->project_system = new DbField('document_details', 'document_details', 'x_project_system', 'project_system', '"project_system"', '"project_system"', 200, -1, FALSE, '"project_system"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->project_system->Nullable = FALSE; // NOT NULL field
		$this->project_system->Required = TRUE; // Required field
		$this->project_system->Sortable = TRUE; // Allow sort
		$this->fields['project_system'] = &$this->project_system;

		// create_date
		$this->create_date = new DbField('document_details', 'document_details', 'x_create_date', 'create_date', '"create_date"', CastDateFieldForLike('"create_date"', 0, "DB"), 135, 0, FALSE, '"create_date"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->create_date->Sortable = FALSE; // Allow sort
		$this->create_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['create_date'] = &$this->create_date;

		// planned_date
		$this->planned_date = new DbField('document_details', 'document_details', 'x_planned_date', 'planned_date', '"planned_date"', CastDateFieldForLike('"planned_date"', 0, "DB"), 133, 0, FALSE, '"planned_date"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->planned_date->Nullable = FALSE; // NOT NULL field
		$this->planned_date->Required = TRUE; // Required field
		$this->planned_date->Sortable = TRUE; // Allow sort
		$this->planned_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['planned_date'] = &$this->planned_date;

		// document_type
		$this->document_type = new DbField('document_details', 'document_details', 'x_document_type', 'document_type', '"document_type"', '"document_type"', 200, -1, FALSE, '"document_type"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->document_type->Nullable = FALSE; // NOT NULL field
		$this->document_type->Required = TRUE; // Required field
		$this->document_type->Sortable = TRUE; // Allow sort
		$this->fields['document_type'] = &$this->document_type;

		// expiry_date
		$this->expiry_date = new DbField('document_details', 'document_details', 'x_expiry_date', 'expiry_date', '"expiry_date"', CastDateFieldForLike('"expiry_date"', 0, "DB"), 133, 0, FALSE, '"expiry_date"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->expiry_date->Required = TRUE; // Required field
		$this->expiry_date->Sortable = TRUE; // Allow sort
		$this->expiry_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['expiry_date'] = &$this->expiry_date;
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
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "\"public\".\"document_details\"";
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
			"SELECT *, (SELECT \"project_name\" || '" . ValueSeparator(1, $this->project_name) . "' || \"project_id\" || '" . ValueSeparator(2, $this->project_name) . "' || \"project_our_client\" FROM \"public\".\"project_details\" \"TMP_LOOKUPTABLE\" WHERE \"TMP_LOOKUPTABLE\".\"project_id\" = \"document_details\".\"project_name\" LIMIT 1) AS \"EV__project_name\" FROM \"public\".\"document_details\"" .
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
		if ($this->project_name->AdvancedSearch->SearchValue <> "" ||
			$this->project_name->AdvancedSearch->SearchValue2 <> "" ||
			ContainsString($where, " " . $this->project_name->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->project_name->VirtualExpression . " "))
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
			$this->document_sequence->setDbValue($conn->getOne("SELECT currval('document_details_document_sequence_seq'::regclass)"));
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
		$this->client_doc_no->DbValue = $row['client_doc_no'];
		$this->document_tittle->DbValue = $row['document_tittle'];
		$this->project_name->DbValue = $row['project_name'];
		$this->project_system->DbValue = $row['project_system'];
		$this->create_date->DbValue = $row['create_date'];
		$this->planned_date->DbValue = $row['planned_date'];
		$this->document_type->DbValue = $row['document_type'];
		$this->expiry_date->DbValue = $row['expiry_date'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
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
			return "document_detailslist.php";
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
		if ($pageName == "document_detailsview.php")
			return $Language->phrase("View");
		elseif ($pageName == "document_detailsedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "document_detailsadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "document_detailslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("document_detailsview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("document_detailsview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "document_detailsadd.php?" . $this->getUrlParm($parm);
		else
			$url = "document_detailsadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("document_detailsedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("document_detailsadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("document_detailsdelete.php", $this->getUrlParm());
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
		$this->client_doc_no->setDbValue($rs->fields('client_doc_no'));
		$this->document_tittle->setDbValue($rs->fields('document_tittle'));
		$this->project_name->setDbValue($rs->fields('project_name'));
		$this->project_system->setDbValue($rs->fields('project_system'));
		$this->create_date->setDbValue($rs->fields('create_date'));
		$this->planned_date->setDbValue($rs->fields('planned_date'));
		$this->document_type->setDbValue($rs->fields('document_type'));
		$this->expiry_date->setDbValue($rs->fields('expiry_date'));
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
		// client_doc_no
		// document_tittle
		// project_name
		// project_system
		// create_date
		// planned_date
		// document_type
		// expiry_date
		// document_sequence

		$this->document_sequence->ViewValue = $this->document_sequence->CurrentValue;
		$this->document_sequence->ViewCustomAttributes = "";

		// firelink_doc_no
		$this->firelink_doc_no->ViewValue = $this->firelink_doc_no->CurrentValue;
		$this->firelink_doc_no->ViewCustomAttributes = "";

		// client_doc_no
		$this->client_doc_no->ViewValue = $this->client_doc_no->CurrentValue;
		$this->client_doc_no->ViewCustomAttributes = "";

		// document_tittle
		$this->document_tittle->ViewValue = $this->document_tittle->CurrentValue;
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
				$filterWrk = "\"project_id\"" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->project_name->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$arwrk[3] = $rswrk->fields('df3');
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
		$this->project_system->ViewValue = $this->project_system->CurrentValue;
		$this->project_system->ViewCustomAttributes = "";

		// create_date
		$this->create_date->ViewValue = $this->create_date->CurrentValue;
		$this->create_date->ViewValue = FormatDateTime($this->create_date->ViewValue, 0);
		$this->create_date->ViewCustomAttributes = "";

		// planned_date
		$this->planned_date->ViewValue = $this->planned_date->CurrentValue;
		$this->planned_date->ViewValue = FormatDateTime($this->planned_date->ViewValue, 0);
		$this->planned_date->ViewCustomAttributes = "";

		// document_type
		$this->document_type->ViewValue = $this->document_type->CurrentValue;
		$this->document_type->ViewCustomAttributes = "";

		// expiry_date
		$this->expiry_date->ViewValue = $this->expiry_date->CurrentValue;
		$this->expiry_date->ViewValue = FormatDateTime($this->expiry_date->ViewValue, 0);
		$this->expiry_date->ViewCustomAttributes = "";

		// document_sequence
		$this->document_sequence->LinkCustomAttributes = "";
		$this->document_sequence->HrefValue = "";
		$this->document_sequence->TooltipValue = "";

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

		// create_date
		$this->create_date->LinkCustomAttributes = "";
		$this->create_date->HrefValue = "";
		$this->create_date->TooltipValue = "";

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
		$this->document_sequence->ViewCustomAttributes = "";

		// firelink_doc_no
		$this->firelink_doc_no->EditAttrs["class"] = "form-control";
		$this->firelink_doc_no->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->firelink_doc_no->CurrentValue = HtmlDecode($this->firelink_doc_no->CurrentValue);
		$this->firelink_doc_no->EditValue = $this->firelink_doc_no->CurrentValue;
		$this->firelink_doc_no->PlaceHolder = RemoveHtml($this->firelink_doc_no->caption());

		// client_doc_no
		$this->client_doc_no->EditAttrs["class"] = "form-control";
		$this->client_doc_no->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->client_doc_no->CurrentValue = HtmlDecode($this->client_doc_no->CurrentValue);
		$this->client_doc_no->EditValue = $this->client_doc_no->CurrentValue;
		$this->client_doc_no->PlaceHolder = RemoveHtml($this->client_doc_no->caption());

		// document_tittle
		$this->document_tittle->EditAttrs["class"] = "form-control";
		$this->document_tittle->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->document_tittle->CurrentValue = HtmlDecode($this->document_tittle->CurrentValue);
		$this->document_tittle->EditValue = $this->document_tittle->CurrentValue;
		$this->document_tittle->PlaceHolder = RemoveHtml($this->document_tittle->caption());

		// project_name
		$this->project_name->EditAttrs["class"] = "form-control";
		$this->project_name->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->project_name->CurrentValue = HtmlDecode($this->project_name->CurrentValue);
		$this->project_name->EditValue = $this->project_name->CurrentValue;
		$this->project_name->PlaceHolder = RemoveHtml($this->project_name->caption());

		// project_system
		$this->project_system->EditAttrs["class"] = "form-control";
		$this->project_system->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->project_system->CurrentValue = HtmlDecode($this->project_system->CurrentValue);
		$this->project_system->EditValue = $this->project_system->CurrentValue;
		$this->project_system->PlaceHolder = RemoveHtml($this->project_system->caption());

		// create_date
		$this->create_date->EditAttrs["class"] = "form-control";
		$this->create_date->EditCustomAttributes = "";
		$this->create_date->EditValue = FormatDateTime($this->create_date->CurrentValue, 8);
		$this->create_date->PlaceHolder = RemoveHtml($this->create_date->caption());

		// planned_date
		$this->planned_date->EditAttrs["class"] = "form-control";
		$this->planned_date->EditCustomAttributes = "";
		$this->planned_date->EditValue = FormatDateTime($this->planned_date->CurrentValue, 8);
		$this->planned_date->PlaceHolder = RemoveHtml($this->planned_date->caption());

		// document_type
		$this->document_type->EditAttrs["class"] = "form-control";
		$this->document_type->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->document_type->CurrentValue = HtmlDecode($this->document_type->CurrentValue);
		$this->document_type->EditValue = $this->document_type->CurrentValue;
		$this->document_type->PlaceHolder = RemoveHtml($this->document_type->caption());

		// expiry_date
		$this->expiry_date->EditAttrs["class"] = "form-control";
		$this->expiry_date->EditCustomAttributes = "";
		$this->expiry_date->EditValue = FormatDateTime($this->expiry_date->CurrentValue, 8);
		$this->expiry_date->PlaceHolder = RemoveHtml($this->expiry_date->caption());

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
					$doc->exportCaption($this->client_doc_no);
					$doc->exportCaption($this->document_tittle);
					$doc->exportCaption($this->project_name);
					$doc->exportCaption($this->project_system);
					$doc->exportCaption($this->planned_date);
					$doc->exportCaption($this->document_type);
					$doc->exportCaption($this->expiry_date);
				} else {
					$doc->exportCaption($this->firelink_doc_no);
					$doc->exportCaption($this->client_doc_no);
					$doc->exportCaption($this->document_tittle);
					$doc->exportCaption($this->project_name);
					$doc->exportCaption($this->project_system);
					$doc->exportCaption($this->create_date);
					$doc->exportCaption($this->planned_date);
					$doc->exportCaption($this->document_type);
					$doc->exportCaption($this->expiry_date);
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
						$doc->exportField($this->client_doc_no);
						$doc->exportField($this->document_tittle);
						$doc->exportField($this->project_name);
						$doc->exportField($this->project_system);
						$doc->exportField($this->planned_date);
						$doc->exportField($this->document_type);
						$doc->exportField($this->expiry_date);
					} else {
						$doc->exportField($this->firelink_doc_no);
						$doc->exportField($this->client_doc_no);
						$doc->exportField($this->document_tittle);
						$doc->exportField($this->project_name);
						$doc->exportField($this->project_system);
						$doc->exportField($this->create_date);
						$doc->exportField($this->planned_date);
						$doc->exportField($this->document_type);
						$doc->exportField($this->expiry_date);
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

		// No binary fields
		return FALSE;
	}

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'document_details';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'document_details';

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
		$table = 'document_details';

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
		$table = 'document_details';

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