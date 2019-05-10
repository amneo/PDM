<?php
namespace PHPMaker2019\pdm;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$user_dtls_list = new user_dtls_list();

// Run the page
$user_dtls_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_dtls_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$user_dtls->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fuser_dtlslist = currentForm = new ew.Form("fuser_dtlslist", "list");
fuser_dtlslist.formKeyCountName = '<?php echo $user_dtls_list->FormKeyCountName ?>';

// Form_CustomValidate event
fuser_dtlslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuser_dtlslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fuser_dtlslist.lists["x_account_valid[]"] = <?php echo $user_dtls_list->account_valid->Lookup->toClientList() ?>;
fuser_dtlslist.lists["x_account_valid[]"].options = <?php echo JsonEncode($user_dtls_list->account_valid->options(FALSE, TRUE)) ?>;
fuser_dtlslist.lists["x_UserLevel"] = <?php echo $user_dtls_list->UserLevel->Lookup->toClientList() ?>;
fuser_dtlslist.lists["x_UserLevel"].options = <?php echo JsonEncode($user_dtls_list->UserLevel->lookupOptions()) ?>;
fuser_dtlslist.lists["x_reports_to"] = <?php echo $user_dtls_list->reports_to->Lookup->toClientList() ?>;
fuser_dtlslist.lists["x_reports_to"].options = <?php echo JsonEncode($user_dtls_list->reports_to->lookupOptions()) ?>;
fuser_dtlslist.autoSuggests["x_reports_to"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var fuser_dtlslistsrch = currentSearchForm = new ew.Form("fuser_dtlslistsrch");

// Filters
fuser_dtlslistsrch.filterList = <?php echo $user_dtls_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$user_dtls->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($user_dtls_list->TotalRecs > 0 && $user_dtls_list->ExportOptions->visible()) { ?>
<?php $user_dtls_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($user_dtls_list->ImportOptions->visible()) { ?>
<?php $user_dtls_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($user_dtls_list->SearchOptions->visible()) { ?>
<?php $user_dtls_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($user_dtls_list->FilterOptions->visible()) { ?>
<?php $user_dtls_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$user_dtls_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$user_dtls->isExport() && !$user_dtls->CurrentAction) { ?>
<form name="fuser_dtlslistsrch" id="fuser_dtlslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($user_dtls_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fuser_dtlslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="user_dtls">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($user_dtls_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($user_dtls_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $user_dtls_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($user_dtls_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($user_dtls_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($user_dtls_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($user_dtls_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $user_dtls_list->showPageHeader(); ?>
<?php
$user_dtls_list->showMessage();
?>
<?php if ($user_dtls_list->TotalRecs > 0 || $user_dtls->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($user_dtls_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> user_dtls">
<?php if (!$user_dtls->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$user_dtls->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($user_dtls_list->Pager)) $user_dtls_list->Pager = new NumericPager($user_dtls_list->StartRec, $user_dtls_list->DisplayRecs, $user_dtls_list->TotalRecs, $user_dtls_list->RecRange, $user_dtls_list->AutoHidePager) ?>
<?php if ($user_dtls_list->Pager->RecordCount > 0 && $user_dtls_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($user_dtls_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_dtls_list->pageUrl() ?>start=<?php echo $user_dtls_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($user_dtls_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_dtls_list->pageUrl() ?>start=<?php echo $user_dtls_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($user_dtls_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $user_dtls_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($user_dtls_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_dtls_list->pageUrl() ?>start=<?php echo $user_dtls_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($user_dtls_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_dtls_list->pageUrl() ?>start=<?php echo $user_dtls_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($user_dtls_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $user_dtls_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $user_dtls_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $user_dtls_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $user_dtls_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fuser_dtlslist" id="fuser_dtlslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($user_dtls_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $user_dtls_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user_dtls">
<div id="gmp_user_dtls" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($user_dtls_list->TotalRecs > 0 || $user_dtls->isGridEdit()) { ?>
<table id="tbl_user_dtlslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$user_dtls_list->RowType = ROWTYPE_HEADER;

// Render list options
$user_dtls_list->renderListOptions();

// Render list options (header, left)
$user_dtls_list->ListOptions->render("header", "left");
?>
<?php if ($user_dtls->user_id->Visible) { // user_id ?>
	<?php if ($user_dtls->sortUrl($user_dtls->user_id) == "") { ?>
		<th data-name="user_id" class="<?php echo $user_dtls->user_id->headerCellClass() ?>"><div id="elh_user_dtls_user_id" class="user_dtls_user_id"><div class="ew-table-header-caption"><?php echo $user_dtls->user_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_id" class="<?php echo $user_dtls->user_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user_dtls->SortUrl($user_dtls->user_id) ?>',2);"><div id="elh_user_dtls_user_id" class="user_dtls_user_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_dtls->user_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($user_dtls->user_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user_dtls->user_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user_dtls->username->Visible) { // username ?>
	<?php if ($user_dtls->sortUrl($user_dtls->username) == "") { ?>
		<th data-name="username" class="<?php echo $user_dtls->username->headerCellClass() ?>"><div id="elh_user_dtls_username" class="user_dtls_username"><div class="ew-table-header-caption"><?php echo $user_dtls->username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="username" class="<?php echo $user_dtls->username->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user_dtls->SortUrl($user_dtls->username) ?>',2);"><div id="elh_user_dtls_username" class="user_dtls_username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_dtls->username->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user_dtls->username->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user_dtls->username->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user_dtls->create_login->Visible) { // create_login ?>
	<?php if ($user_dtls->sortUrl($user_dtls->create_login) == "") { ?>
		<th data-name="create_login" class="<?php echo $user_dtls->create_login->headerCellClass() ?>"><div id="elh_user_dtls_create_login" class="user_dtls_create_login"><div class="ew-table-header-caption"><?php echo $user_dtls->create_login->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="create_login" class="<?php echo $user_dtls->create_login->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user_dtls->SortUrl($user_dtls->create_login) ?>',2);"><div id="elh_user_dtls_create_login" class="user_dtls_create_login">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_dtls->create_login->caption() ?></span><span class="ew-table-header-sort"><?php if ($user_dtls->create_login->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user_dtls->create_login->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user_dtls->account_valid->Visible) { // account_valid ?>
	<?php if ($user_dtls->sortUrl($user_dtls->account_valid) == "") { ?>
		<th data-name="account_valid" class="<?php echo $user_dtls->account_valid->headerCellClass() ?>"><div id="elh_user_dtls_account_valid" class="user_dtls_account_valid"><div class="ew-table-header-caption"><?php echo $user_dtls->account_valid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="account_valid" class="<?php echo $user_dtls->account_valid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user_dtls->SortUrl($user_dtls->account_valid) ?>',2);"><div id="elh_user_dtls_account_valid" class="user_dtls_account_valid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_dtls->account_valid->caption() ?></span><span class="ew-table-header-sort"><?php if ($user_dtls->account_valid->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user_dtls->account_valid->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user_dtls->email_addreess->Visible) { // email_addreess ?>
	<?php if ($user_dtls->sortUrl($user_dtls->email_addreess) == "") { ?>
		<th data-name="email_addreess" class="<?php echo $user_dtls->email_addreess->headerCellClass() ?>"><div id="elh_user_dtls_email_addreess" class="user_dtls_email_addreess"><div class="ew-table-header-caption"><?php echo $user_dtls->email_addreess->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="email_addreess" class="<?php echo $user_dtls->email_addreess->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user_dtls->SortUrl($user_dtls->email_addreess) ?>',2);"><div id="elh_user_dtls_email_addreess" class="user_dtls_email_addreess">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_dtls->email_addreess->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user_dtls->email_addreess->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user_dtls->email_addreess->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user_dtls->UserLevel->Visible) { // UserLevel ?>
	<?php if ($user_dtls->sortUrl($user_dtls->UserLevel) == "") { ?>
		<th data-name="UserLevel" class="<?php echo $user_dtls->UserLevel->headerCellClass() ?>"><div id="elh_user_dtls_UserLevel" class="user_dtls_UserLevel"><div class="ew-table-header-caption"><?php echo $user_dtls->UserLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserLevel" class="<?php echo $user_dtls->UserLevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user_dtls->SortUrl($user_dtls->UserLevel) ?>',2);"><div id="elh_user_dtls_UserLevel" class="user_dtls_UserLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_dtls->UserLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($user_dtls->UserLevel->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user_dtls->UserLevel->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user_dtls->reports_to->Visible) { // reports_to ?>
	<?php if ($user_dtls->sortUrl($user_dtls->reports_to) == "") { ?>
		<th data-name="reports_to" class="<?php echo $user_dtls->reports_to->headerCellClass() ?>"><div id="elh_user_dtls_reports_to" class="user_dtls_reports_to"><div class="ew-table-header-caption"><?php echo $user_dtls->reports_to->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="reports_to" class="<?php echo $user_dtls->reports_to->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user_dtls->SortUrl($user_dtls->reports_to) ?>',2);"><div id="elh_user_dtls_reports_to" class="user_dtls_reports_to">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_dtls->reports_to->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user_dtls->reports_to->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user_dtls->reports_to->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user_dtls->name->Visible) { // name ?>
	<?php if ($user_dtls->sortUrl($user_dtls->name) == "") { ?>
		<th data-name="name" class="<?php echo $user_dtls->name->headerCellClass() ?>"><div id="elh_user_dtls_name" class="user_dtls_name"><div class="ew-table-header-caption"><?php echo $user_dtls->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $user_dtls->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user_dtls->SortUrl($user_dtls->name) ?>',2);"><div id="elh_user_dtls_name" class="user_dtls_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_dtls->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user_dtls->name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user_dtls->name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$user_dtls_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($user_dtls->ExportAll && $user_dtls->isExport()) {
	$user_dtls_list->StopRec = $user_dtls_list->TotalRecs;
} else {

	// Set the last record to display
	if ($user_dtls_list->TotalRecs > $user_dtls_list->StartRec + $user_dtls_list->DisplayRecs - 1)
		$user_dtls_list->StopRec = $user_dtls_list->StartRec + $user_dtls_list->DisplayRecs - 1;
	else
		$user_dtls_list->StopRec = $user_dtls_list->TotalRecs;
}
$user_dtls_list->RecCnt = $user_dtls_list->StartRec - 1;
if ($user_dtls_list->Recordset && !$user_dtls_list->Recordset->EOF) {
	$user_dtls_list->Recordset->moveFirst();
	$selectLimit = $user_dtls_list->UseSelectLimit;
	if (!$selectLimit && $user_dtls_list->StartRec > 1)
		$user_dtls_list->Recordset->move($user_dtls_list->StartRec - 1);
} elseif (!$user_dtls->AllowAddDeleteRow && $user_dtls_list->StopRec == 0) {
	$user_dtls_list->StopRec = $user_dtls->GridAddRowCount;
}

// Initialize aggregate
$user_dtls->RowType = ROWTYPE_AGGREGATEINIT;
$user_dtls->resetAttributes();
$user_dtls_list->renderRow();
while ($user_dtls_list->RecCnt < $user_dtls_list->StopRec) {
	$user_dtls_list->RecCnt++;
	if ($user_dtls_list->RecCnt >= $user_dtls_list->StartRec) {
		$user_dtls_list->RowCnt++;

		// Set up key count
		$user_dtls_list->KeyCount = $user_dtls_list->RowIndex;

		// Init row class and style
		$user_dtls->resetAttributes();
		$user_dtls->CssClass = "";
		if ($user_dtls->isGridAdd()) {
		} else {
			$user_dtls_list->loadRowValues($user_dtls_list->Recordset); // Load row values
		}
		$user_dtls->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$user_dtls->RowAttrs = array_merge($user_dtls->RowAttrs, array('data-rowindex'=>$user_dtls_list->RowCnt, 'id'=>'r' . $user_dtls_list->RowCnt . '_user_dtls', 'data-rowtype'=>$user_dtls->RowType));

		// Render row
		$user_dtls_list->renderRow();

		// Render list options
		$user_dtls_list->renderListOptions();
?>
	<tr<?php echo $user_dtls->rowAttributes() ?>>
<?php

// Render list options (body, left)
$user_dtls_list->ListOptions->render("body", "left", $user_dtls_list->RowCnt);
?>
	<?php if ($user_dtls->user_id->Visible) { // user_id ?>
		<td data-name="user_id"<?php echo $user_dtls->user_id->cellAttributes() ?>>
<span id="el<?php echo $user_dtls_list->RowCnt ?>_user_dtls_user_id" class="user_dtls_user_id">
<span<?php echo $user_dtls->user_id->viewAttributes() ?>>
<?php echo $user_dtls->user_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($user_dtls->username->Visible) { // username ?>
		<td data-name="username"<?php echo $user_dtls->username->cellAttributes() ?>>
<span id="el<?php echo $user_dtls_list->RowCnt ?>_user_dtls_username" class="user_dtls_username">
<span<?php echo $user_dtls->username->viewAttributes() ?>>
<?php echo $user_dtls->username->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($user_dtls->create_login->Visible) { // create_login ?>
		<td data-name="create_login"<?php echo $user_dtls->create_login->cellAttributes() ?>>
<span id="el<?php echo $user_dtls_list->RowCnt ?>_user_dtls_create_login" class="user_dtls_create_login">
<span<?php echo $user_dtls->create_login->viewAttributes() ?>>
<?php echo $user_dtls->create_login->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($user_dtls->account_valid->Visible) { // account_valid ?>
		<td data-name="account_valid"<?php echo $user_dtls->account_valid->cellAttributes() ?>>
<span id="el<?php echo $user_dtls_list->RowCnt ?>_user_dtls_account_valid" class="user_dtls_account_valid">
<span<?php echo $user_dtls->account_valid->viewAttributes() ?>>
<?php if (ConvertToBool($user_dtls->account_valid->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $user_dtls->account_valid->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $user_dtls->account_valid->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($user_dtls->email_addreess->Visible) { // email_addreess ?>
		<td data-name="email_addreess"<?php echo $user_dtls->email_addreess->cellAttributes() ?>>
<span id="el<?php echo $user_dtls_list->RowCnt ?>_user_dtls_email_addreess" class="user_dtls_email_addreess">
<span<?php echo $user_dtls->email_addreess->viewAttributes() ?>>
<?php echo $user_dtls->email_addreess->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($user_dtls->UserLevel->Visible) { // UserLevel ?>
		<td data-name="UserLevel"<?php echo $user_dtls->UserLevel->cellAttributes() ?>>
<span id="el<?php echo $user_dtls_list->RowCnt ?>_user_dtls_UserLevel" class="user_dtls_UserLevel">
<span<?php echo $user_dtls->UserLevel->viewAttributes() ?>>
<?php echo $user_dtls->UserLevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($user_dtls->reports_to->Visible) { // reports_to ?>
		<td data-name="reports_to"<?php echo $user_dtls->reports_to->cellAttributes() ?>>
<span id="el<?php echo $user_dtls_list->RowCnt ?>_user_dtls_reports_to" class="user_dtls_reports_to">
<span<?php echo $user_dtls->reports_to->viewAttributes() ?>>
<?php echo $user_dtls->reports_to->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($user_dtls->name->Visible) { // name ?>
		<td data-name="name"<?php echo $user_dtls->name->cellAttributes() ?>>
<span id="el<?php echo $user_dtls_list->RowCnt ?>_user_dtls_name" class="user_dtls_name">
<span<?php echo $user_dtls->name->viewAttributes() ?>>
<?php echo $user_dtls->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$user_dtls_list->ListOptions->render("body", "right", $user_dtls_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$user_dtls->isGridAdd())
		$user_dtls_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$user_dtls->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($user_dtls_list->Recordset)
	$user_dtls_list->Recordset->Close();
?>
<?php if (!$user_dtls->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$user_dtls->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($user_dtls_list->Pager)) $user_dtls_list->Pager = new NumericPager($user_dtls_list->StartRec, $user_dtls_list->DisplayRecs, $user_dtls_list->TotalRecs, $user_dtls_list->RecRange, $user_dtls_list->AutoHidePager) ?>
<?php if ($user_dtls_list->Pager->RecordCount > 0 && $user_dtls_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($user_dtls_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_dtls_list->pageUrl() ?>start=<?php echo $user_dtls_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($user_dtls_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_dtls_list->pageUrl() ?>start=<?php echo $user_dtls_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($user_dtls_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $user_dtls_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($user_dtls_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_dtls_list->pageUrl() ?>start=<?php echo $user_dtls_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($user_dtls_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_dtls_list->pageUrl() ?>start=<?php echo $user_dtls_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($user_dtls_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $user_dtls_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $user_dtls_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $user_dtls_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $user_dtls_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($user_dtls_list->TotalRecs == 0 && !$user_dtls->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $user_dtls_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$user_dtls_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$user_dtls->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$user_dtls_list->terminate();
?>