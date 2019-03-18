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
$document_system_list = new document_system_list();

// Run the page
$document_system_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_system_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$document_system->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fdocument_systemlist = currentForm = new ew.Form("fdocument_systemlist", "list");
fdocument_systemlist.formKeyCountName = '<?php echo $document_system_list->FormKeyCountName ?>';

// Form_CustomValidate event
fdocument_systemlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_systemlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fdocument_systemlistsrch = currentSearchForm = new ew.Form("fdocument_systemlistsrch");

// Filters
fdocument_systemlistsrch.filterList = <?php echo $document_system_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$document_system->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($document_system_list->TotalRecs > 0 && $document_system_list->ExportOptions->visible()) { ?>
<?php $document_system_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($document_system_list->ImportOptions->visible()) { ?>
<?php $document_system_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($document_system_list->SearchOptions->visible()) { ?>
<?php $document_system_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($document_system_list->FilterOptions->visible()) { ?>
<?php $document_system_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$document_system_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$document_system->isExport() && !$document_system->CurrentAction) { ?>
<form name="fdocument_systemlistsrch" id="fdocument_systemlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($document_system_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fdocument_systemlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="document_system">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($document_system_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($document_system_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $document_system_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($document_system_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($document_system_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($document_system_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($document_system_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $document_system_list->showPageHeader(); ?>
<?php
$document_system_list->showMessage();
?>
<?php if ($document_system_list->TotalRecs > 0 || $document_system->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($document_system_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> document_system">
<?php if (!$document_system->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$document_system->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($document_system_list->Pager)) $document_system_list->Pager = new NumericPager($document_system_list->StartRec, $document_system_list->DisplayRecs, $document_system_list->TotalRecs, $document_system_list->RecRange, $document_system_list->AutoHidePager) ?>
<?php if ($document_system_list->Pager->RecordCount > 0 && $document_system_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($document_system_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($document_system_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($document_system_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $document_system_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($document_system_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($document_system_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($document_system_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $document_system_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $document_system_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $document_system_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($document_system_list->TotalRecs > 0 && (!$document_system_list->AutoHidePageSizeSelector || $document_system_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="document_system">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="50"<?php if ($document_system_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($document_system_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="ALL"<?php if ($document_system->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $document_system_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdocument_systemlist" id="fdocument_systemlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_system_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_system_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_system">
<div id="gmp_document_system" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($document_system_list->TotalRecs > 0 || $document_system->isGridEdit()) { ?>
<table id="tbl_document_systemlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$document_system_list->RowType = ROWTYPE_HEADER;

// Render list options
$document_system_list->renderListOptions();

// Render list options (header, left)
$document_system_list->ListOptions->render("header", "left");
?>
<?php if ($document_system->type_id->Visible) { // type_id ?>
	<?php if ($document_system->sortUrl($document_system->type_id) == "") { ?>
		<th data-name="type_id" class="<?php echo $document_system->type_id->headerCellClass() ?>"><div id="elh_document_system_type_id" class="document_system_type_id"><div class="ew-table-header-caption"><?php echo $document_system->type_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="type_id" class="<?php echo $document_system->type_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_system->SortUrl($document_system->type_id) ?>',2);"><div id="elh_document_system_type_id" class="document_system_type_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_system->type_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_system->type_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_system->type_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_system->system_name->Visible) { // system_name ?>
	<?php if ($document_system->sortUrl($document_system->system_name) == "") { ?>
		<th data-name="system_name" class="<?php echo $document_system->system_name->headerCellClass() ?>"><div id="elh_document_system_system_name" class="document_system_system_name"><div class="ew-table-header-caption"><?php echo $document_system->system_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="system_name" class="<?php echo $document_system->system_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_system->SortUrl($document_system->system_name) ?>',2);"><div id="elh_document_system_system_name" class="document_system_system_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_system->system_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_system->system_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_system->system_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_system->system_group->Visible) { // system_group ?>
	<?php if ($document_system->sortUrl($document_system->system_group) == "") { ?>
		<th data-name="system_group" class="<?php echo $document_system->system_group->headerCellClass() ?>"><div id="elh_document_system_system_group" class="document_system_system_group"><div class="ew-table-header-caption"><?php echo $document_system->system_group->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="system_group" class="<?php echo $document_system->system_group->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_system->SortUrl($document_system->system_group) ?>',2);"><div id="elh_document_system_system_group" class="document_system_system_group">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_system->system_group->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_system->system_group->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_system->system_group->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$document_system_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($document_system->ExportAll && $document_system->isExport()) {
	$document_system_list->StopRec = $document_system_list->TotalRecs;
} else {

	// Set the last record to display
	if ($document_system_list->TotalRecs > $document_system_list->StartRec + $document_system_list->DisplayRecs - 1)
		$document_system_list->StopRec = $document_system_list->StartRec + $document_system_list->DisplayRecs - 1;
	else
		$document_system_list->StopRec = $document_system_list->TotalRecs;
}
$document_system_list->RecCnt = $document_system_list->StartRec - 1;
if ($document_system_list->Recordset && !$document_system_list->Recordset->EOF) {
	$document_system_list->Recordset->moveFirst();
	$selectLimit = $document_system_list->UseSelectLimit;
	if (!$selectLimit && $document_system_list->StartRec > 1)
		$document_system_list->Recordset->move($document_system_list->StartRec - 1);
} elseif (!$document_system->AllowAddDeleteRow && $document_system_list->StopRec == 0) {
	$document_system_list->StopRec = $document_system->GridAddRowCount;
}

// Initialize aggregate
$document_system->RowType = ROWTYPE_AGGREGATEINIT;
$document_system->resetAttributes();
$document_system_list->renderRow();
while ($document_system_list->RecCnt < $document_system_list->StopRec) {
	$document_system_list->RecCnt++;
	if ($document_system_list->RecCnt >= $document_system_list->StartRec) {
		$document_system_list->RowCnt++;

		// Set up key count
		$document_system_list->KeyCount = $document_system_list->RowIndex;

		// Init row class and style
		$document_system->resetAttributes();
		$document_system->CssClass = "";
		if ($document_system->isGridAdd()) {
		} else {
			$document_system_list->loadRowValues($document_system_list->Recordset); // Load row values
		}
		$document_system->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$document_system->RowAttrs = array_merge($document_system->RowAttrs, array('data-rowindex'=>$document_system_list->RowCnt, 'id'=>'r' . $document_system_list->RowCnt . '_document_system', 'data-rowtype'=>$document_system->RowType));

		// Render row
		$document_system_list->renderRow();

		// Render list options
		$document_system_list->renderListOptions();
?>
	<tr<?php echo $document_system->rowAttributes() ?>>
<?php

// Render list options (body, left)
$document_system_list->ListOptions->render("body", "left", $document_system_list->RowCnt);
?>
	<?php if ($document_system->type_id->Visible) { // type_id ?>
		<td data-name="type_id"<?php echo $document_system->type_id->cellAttributes() ?>>
<span id="el<?php echo $document_system_list->RowCnt ?>_document_system_type_id" class="document_system_type_id">
<span<?php echo $document_system->type_id->viewAttributes() ?>>
<?php echo $document_system->type_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_system->system_name->Visible) { // system_name ?>
		<td data-name="system_name"<?php echo $document_system->system_name->cellAttributes() ?>>
<span id="el<?php echo $document_system_list->RowCnt ?>_document_system_system_name" class="document_system_system_name">
<span<?php echo $document_system->system_name->viewAttributes() ?>>
<?php echo $document_system->system_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_system->system_group->Visible) { // system_group ?>
		<td data-name="system_group"<?php echo $document_system->system_group->cellAttributes() ?>>
<span id="el<?php echo $document_system_list->RowCnt ?>_document_system_system_group" class="document_system_system_group">
<span<?php echo $document_system->system_group->viewAttributes() ?>>
<?php echo $document_system->system_group->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$document_system_list->ListOptions->render("body", "right", $document_system_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$document_system->isGridAdd())
		$document_system_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$document_system->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($document_system_list->Recordset)
	$document_system_list->Recordset->Close();
?>
<?php if (!$document_system->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$document_system->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($document_system_list->Pager)) $document_system_list->Pager = new NumericPager($document_system_list->StartRec, $document_system_list->DisplayRecs, $document_system_list->TotalRecs, $document_system_list->RecRange, $document_system_list->AutoHidePager) ?>
<?php if ($document_system_list->Pager->RecordCount > 0 && $document_system_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($document_system_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($document_system_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($document_system_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $document_system_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($document_system_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($document_system_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($document_system_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $document_system_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $document_system_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $document_system_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($document_system_list->TotalRecs > 0 && (!$document_system_list->AutoHidePageSizeSelector || $document_system_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="document_system">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="50"<?php if ($document_system_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($document_system_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="ALL"<?php if ($document_system->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $document_system_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($document_system_list->TotalRecs == 0 && !$document_system->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $document_system_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$document_system_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$document_system->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$document_system_list->terminate();
?>