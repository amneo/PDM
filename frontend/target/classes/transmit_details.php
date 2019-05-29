<?php
namespace PHPMaker2019\pdm;

/**
 * Table class for transmit_details
 */
class transmit_details extends DbTable
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
	public $transmit_id;
	public $transmittal_no;
	public $project_name;
	public $delivery_location;
	public $addressed_to;
	public $remarks;
	public $ack_rcvd;
	public $ack_document;
	public $transmital_date;
	public $transmit_mode;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'transmit_details';
		$this->TableName = 'transmit_details';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "\"public\".\"transmit_details\"";
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
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 104; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);
		$this->BasicSearch->TypeDefault = "OR";

		// transmit_id
		$this->transmit_id = new DbField('transmit_details', 'transmit_details', 'x_transmit_id', 'transmit_id', '"transmit_id"', 'CAST("transmit_id" AS varchar(255))', 20, -1, FALSE, '"transmit_id"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->transmit_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->transmit_id->IsPrimaryKey = TRUE; // Primary key field
		$this->transmit_id->Nullable = FALSE; // NOT NULL field
		$this->transmit_id->Sortable = FALSE; // Allow sort
		$this->transmit_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['transmit_id'] = &$this->transmit_id;

		// transmittal_no
		$this->transmittal_no = new DbField('transmit_details', 'transmit_details', 'x_transmittal_no', 'transmittal_no', '"transmittal_no"', '"transmittal_no"', 200, -1, FALSE, '"transmittal_no"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->transmittal_no->Nullable = FALSE; // NOT NULL field
		$this->transmittal_no->Required = TRUE; // Required field
		$this->transmittal_no->Sortable = TRUE; // Allow sort
		$this->fields['transmittal_no'] = &$this->transmittal_no;

		// project_name
		$this->project_name = new DbField('transmit_details', 'transmit_details', 'x_project_name', 'project_name', '"project_name"', '"project_name"', 200, -1, FALSE, '"EV__project_name"', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->project_name->Nullable = FALSE; // NOT NULL field
		$this->project_name->Required = TRUE; // Required field
		$this->project_name->Sortable = TRUE; // Allow sort
		$this->project_name->Lookup = new Lookup('project_name', 'project_details', FALSE, 'project_name', ["project_name","","",""], [], [], [], [], [], [], '"project_id" DESC', '');
		$this->fields['project_name'] = &$this->project_name;

		// delivery_location
		$this->delivery_location = new DbField('transmit_details', 'transmit_details', 'x_delivery_location', 'delivery_location', '"delivery_location"', '"delivery_location"', 200, -1, FALSE, '"delivery_location"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->delivery_location->Required = TRUE; // Required field
		$this->delivery_location->Sortable = TRUE; // Allow sort
		$this->fields['delivery_location'] = &$this->delivery_location;

		// addressed_to
		$this->addressed_to = new DbField('transmit_details', 'transmit_details', 'x_addressed_to', 'addressed_to', '"addressed_to"', '"addressed_to"', 200, -1, FALSE, '"addressed_to"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addressed_to->Sortable = TRUE; // Allow sort
		$this->fields['addressed_to'] = &$this->addressed_to;

		// remarks
		$this->remarks = new DbField('transmit_details', 'transmit_details', 'x_remarks', 'remarks', '"remarks"', '"remarks"', 200, -1, FALSE, '"remarks"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->remarks->Sortable = TRUE; // Allow sort
		$this->fields['remarks'] = &$this->remarks;

		// ack_rcvd
		$this->ack_rcvd = new DbField('transmit_details', 'transmit_details', 'x_ack_rcvd', 'ack_rcvd', '"ack_rcvd"', 'CAST("ack_rcvd" AS varchar(255))', 11, -1, FALSE, '"ack_rcvd"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->ack_rcvd->Sortable = TRUE; // Allow sort
		$this->ack_rcvd->DataType = DATATYPE_BOOLEAN;
		$this->ack_rcvd->Lookup = new Lookup('ack_rcvd', 'transmit_details', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->ack_rcvd->OptionCount = 2;
		$this->fields['ack_rcvd'] = &$this->ack_rcvd;

		// ack_document
		$this->ack_document = new DbField('transmit_details', 'transmit_details', 'x_ack_document', 'ack_document', '"ack_document"', '"ack_document"', 200, -1, TRUE, '"ack_document"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->ack_document->Sortable = TRUE; // Allow sort
		$this->fields['ack_document'] = &$this->ack_document;

		// transmital_date
		$this->transmital_date = new DbField('transmit_details', 'transmit_details', 'x_transmital_date', 'transmital_date', '"transmital_date"', CastDateFieldForLike('"transmital_date"', 0, "DB"), 135, -1, FALSE, '"transmital_date"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->transmital_date->Sortable = FALSE; // Allow sort
		$this->transmital_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['transmital_date'] = &$this->transmital_date;

		// transmit_mode
		$this->transmit_mode = new DbField('transmit_details', 'transmit_details', 'x_transmit_mode', 'transmit_mode', '"transmit_mode"', '"transmit_mode"', 200, -1, FALSE, '"transmit_mode"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->transmit_mode->Sortable = TRUE; // Allow sort
		$this->transmit_mode->Lookup = new Lookup('transmit_mode', 'xmit_details', FALSE, 'xmit_mode', ["xmit_mode","","",""], [], [], [], [], [], [], '', '');
		$this->fields['transmit_mode'] = &$this->transmit_mode;
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
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "\"public\".\"transmit_details\"";
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
			"SELECT *, (SELECT \"project_name\" FROM \"public\".\"project_details\" \"TMP_LOOKUPTABLE\" WHERE \"TMP_LOOKUPTABLE\".\"project_name\" = \"transmit_details\".\"project_name\" LIMIT 1) AS \"EV__project_name\" FROM \"public\".\"transmit_details\"" .
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
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "\"transmit_id\" DESC";
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
			$this->transmit_id->setDbValue($conn->getOne("SELECT currval('transmit_details_transmit_id_seq'::regclass)"));
			$rs['transmit_id'] = $this->transmit_id->DbValue;
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
			$fldname = 'transmit_id';
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
			if (array_key_exists('transmit_id', $rs))
				AddFilter($where, QuotedName('transmit_id', $this->Dbid) . '=' . QuotedValue($rs['transmit_id'], $this->transmit_id->DataType, $this->Dbid));
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
		$this->transmit_id->DbValue = $row['transmit_id'];
		$this->transmittal_no->DbValue = $row['transmittal_no'];
		$this->project_name->DbValue = $row['project_name'];
		$this->delivery_location->DbValue = $row['delivery_location'];
		$this->addressed_to->DbValue = $row['addressed_to'];
		$this->remarks->DbValue = $row['remarks'];
		$this->ack_rcvd->DbValue = (ConvertToBool($row['ack_rcvd']) ? "1" : "0");
		$this->ack_document->Upload->DbValue = $row['ack_document'];
		$this->transmital_date->DbValue = $row['transmital_date'];
		$this->transmit_mode->DbValue = $row['transmit_mode'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['ack_document']) ? [] : [$row['ack_document']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->ack_document->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->ack_document->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "\"transmit_id\" = @transmit_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('transmit_id', $row) ? $row['transmit_id'] : NULL) : $this->transmit_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@transmit_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "transmit_detailslist.php";
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
		if ($pageName == "transmit_detailsview.php")
			return $Language->phrase("View");
		elseif ($pageName == "transmit_detailsedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "transmit_detailsadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "transmit_detailslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("transmit_detailsview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("transmit_detailsview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "transmit_detailsadd.php?" . $this->getUrlParm($parm);
		else
			$url = "transmit_detailsadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("transmit_detailsedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("transmit_detailsadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("transmit_detailsdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "transmit_id:" . JsonEncode($this->transmit_id->CurrentValue, "number");
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
		if ($this->transmit_id->CurrentValue != NULL) {
			$url .= "transmit_id=" . urlencode($this->transmit_id->CurrentValue);
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
			if (Param("transmit_id") !== NULL)
				$arKeys[] = Param("transmit_id");
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
			$this->transmit_id->CurrentValue = $key;
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
		$this->transmit_id->setDbValue($rs->fields('transmit_id'));
		$this->transmittal_no->setDbValue($rs->fields('transmittal_no'));
		$this->project_name->setDbValue($rs->fields('project_name'));
		$this->delivery_location->setDbValue($rs->fields('delivery_location'));
		$this->addressed_to->setDbValue($rs->fields('addressed_to'));
		$this->remarks->setDbValue($rs->fields('remarks'));
		$this->ack_rcvd->setDbValue(ConvertToBool($rs->fields('ack_rcvd')) ? "1" : "0");
		$this->ack_document->Upload->DbValue = $rs->fields('ack_document');
		$this->transmital_date->setDbValue($rs->fields('transmital_date'));
		$this->transmit_mode->setDbValue($rs->fields('transmit_mode'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// transmit_id
		// transmittal_no
		// project_name
		// delivery_location
		// addressed_to
		// remarks
		// ack_rcvd
		// ack_document
		// transmital_date

		$this->transmital_date->CellCssStyle = "white-space: nowrap;";

		// transmit_mode
		// transmit_id

		$this->transmit_id->ViewValue = $this->transmit_id->CurrentValue;
		$this->transmit_id->ViewValue = FormatNumber($this->transmit_id->ViewValue, 0, -2, -2, -2);
		$this->transmit_id->ViewCustomAttributes = "";

		// transmittal_no
		$this->transmittal_no->ViewValue = $this->transmittal_no->CurrentValue;
		$this->transmittal_no->ViewValue = strtoupper($this->transmittal_no->ViewValue);
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
					$arwrk[1] = strtoupper($rswrk->fields('df'));
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
		$this->delivery_location->ViewValue = strtoupper($this->delivery_location->ViewValue);
		$this->delivery_location->ViewCustomAttributes = "";

		// addressed_to
		$this->addressed_to->ViewValue = $this->addressed_to->CurrentValue;
		$this->addressed_to->ViewValue = strtoupper($this->addressed_to->ViewValue);
		$this->addressed_to->ViewCustomAttributes = "";

		// remarks
		$this->remarks->ViewValue = $this->remarks->CurrentValue;
		$this->remarks->ViewValue = strtoupper($this->remarks->ViewValue);
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

		// transmital_date
		$this->transmital_date->ViewValue = $this->transmital_date->CurrentValue;
		$this->transmital_date->ViewCustomAttributes = "";

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
						$arwrk[1] = strtoupper($rswrk->fields('df'));
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

		// transmit_id
		$this->transmit_id->LinkCustomAttributes = "";
		$this->transmit_id->HrefValue = "";
		$this->transmit_id->TooltipValue = "";

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

		// transmital_date
		$this->transmital_date->LinkCustomAttributes = "";
		$this->transmital_date->HrefValue = "";
		$this->transmital_date->TooltipValue = "";

		// transmit_mode
		$this->transmit_mode->LinkCustomAttributes = "";
		$this->transmit_mode->HrefValue = "";
		$this->transmit_mode->TooltipValue = "";

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

		// transmit_id
		$this->transmit_id->EditAttrs["class"] = "form-control";
		$this->transmit_id->EditCustomAttributes = "";
		$this->transmit_id->EditValue = $this->transmit_id->CurrentValue;
		$this->transmit_id->EditValue = FormatNumber($this->transmit_id->EditValue, 0, -2, -2, -2);
		$this->transmit_id->ViewCustomAttributes = "";

		// transmittal_no
		$this->transmittal_no->EditAttrs["class"] = "form-control";
		$this->transmittal_no->EditCustomAttributes = "";
		$this->transmittal_no->EditValue = $this->transmittal_no->CurrentValue;
		$this->transmittal_no->EditValue = strtoupper($this->transmittal_no->EditValue);
		$this->transmittal_no->ViewCustomAttributes = "";

		// project_name
		$this->project_name->EditAttrs["class"] = "form-control";
		$this->project_name->EditCustomAttributes = "";
		if ($this->project_name->VirtualValue <> "") {
			$this->project_name->EditValue = $this->project_name->VirtualValue;
		} else {
			$this->project_name->EditValue = $this->project_name->CurrentValue;
		$curVal = strval($this->project_name->CurrentValue);
		if ($curVal <> "") {
			$this->project_name->EditValue = $this->project_name->lookupCacheOption($curVal);
			if ($this->project_name->EditValue === NULL) { // Lookup from database
				$filterWrk = "\"project_name\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->project_name->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = strtoupper($rswrk->fields('df'));
					$this->project_name->EditValue = $this->project_name->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->project_name->EditValue = $this->project_name->CurrentValue;
				}
			}
		} else {
			$this->project_name->EditValue = NULL;
		}
		}
		$this->project_name->ViewCustomAttributes = "";

		// delivery_location
		$this->delivery_location->EditAttrs["class"] = "form-control";
		$this->delivery_location->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->delivery_location->CurrentValue = HtmlDecode($this->delivery_location->CurrentValue);
		$this->delivery_location->EditValue = $this->delivery_location->CurrentValue;
		$this->delivery_location->PlaceHolder = RemoveHtml($this->delivery_location->caption());

		// addressed_to
		$this->addressed_to->EditAttrs["class"] = "form-control";
		$this->addressed_to->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->addressed_to->CurrentValue = HtmlDecode($this->addressed_to->CurrentValue);
		$this->addressed_to->EditValue = $this->addressed_to->CurrentValue;
		$this->addressed_to->PlaceHolder = RemoveHtml($this->addressed_to->caption());

		// remarks
		$this->remarks->EditAttrs["class"] = "form-control";
		$this->remarks->EditCustomAttributes = "";
		$this->remarks->EditValue = $this->remarks->CurrentValue;
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

		// transmital_date
		$this->transmital_date->EditAttrs["class"] = "form-control";
		$this->transmital_date->EditCustomAttributes = "";
		$this->transmital_date->EditValue = $this->transmital_date->CurrentValue;
		$this->transmital_date->PlaceHolder = RemoveHtml($this->transmital_date->caption());

		// transmit_mode
		$this->transmit_mode->EditCustomAttributes = "";

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
					$doc->exportCaption($this->transmit_mode);
				} else {
					$doc->exportCaption($this->transmit_id);
					$doc->exportCaption($this->transmittal_no);
					$doc->exportCaption($this->project_name);
					$doc->exportCaption($this->delivery_location);
					$doc->exportCaption($this->addressed_to);
					$doc->exportCaption($this->remarks);
					$doc->exportCaption($this->ack_rcvd);
					$doc->exportCaption($this->ack_document);
					$doc->exportCaption($this->transmit_mode);
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
						$doc->exportField($this->transmit_mode);
					} else {
						$doc->exportField($this->transmit_id);
						$doc->exportField($this->transmittal_no);
						$doc->exportField($this->project_name);
						$doc->exportField($this->delivery_location);
						$doc->exportField($this->addressed_to);
						$doc->exportField($this->remarks);
						$doc->exportField($this->ack_rcvd);
						$doc->exportField($this->ack_document);
						$doc->exportField($this->transmit_mode);
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
		if ($fldparm == 'ack_document') {
			$fldName = "ack_document";
			$fileNameFld = "ack_document";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode($COMPOSITE_KEY_SEPARATOR, $key);
		if (count($ar) == 1) {
			$this->transmit_id->CurrentValue = $ar[0];
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
		$table = 'transmit_details';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'transmit_details';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['transmit_id'];

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
		$table = 'transmit_details';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['transmit_id'];

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
		$table = 'transmit_details';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['transmit_id'];

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