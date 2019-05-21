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
$document_type_list = new document_type_list();

// Run the page
$document_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_type_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$document_type->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fdocument_typelist = currentForm = new ew.Form("fdocument_typelist", "list");
fdocument_typelist.formKeyCountName = '<?php echo $document_type_list->FormKeyCountName ?>';

// Form_CustomValidate event
fdocument_typelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_typelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fdocument_typelistsrch = currentSearchForm = new ew.Form("fdocument_typelistsrch");

// Filters
fdocument_typelistsrch.filterList = <?php echo $document_type_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$document_type->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($document_type_list->TotalRecs > 0 && $document_type_list->ExportOptions->visible()) { ?>
<?php $document_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($document_type_list->ImportOptions->visible()) { ?>
<?php $document_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($document_type_list->SearchOptions->visible()) { ?>
<?php $document_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($document_type_list->FilterOptions->visible()) { ?>
<?php $document_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$document_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$document_type->isExport() && !$document_type->CurrentAction) { ?>
<form name="fdocument_typelistsrch" id="fdocument_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($document_type_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fdocument_typelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="document_type">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($document_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($document_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $document_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($document_type_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($document_type_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($document_type_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($document_type_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $document_type_list->showPageHeader(); ?>
<?php
$document_type_list->showMessage();
?>
<?php if ($document_type_list->TotalRecs > 0 || $document_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($document_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> document_type">
<?php if (!$document_type->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$document_type->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($document_type_list->Pager)) $document_type_list->Pager = new NumericPager($document_type_list->StartRec, $document_type_list->DisplayRecs, $document_type_list->TotalRecs, $document_type_list->RecRange, $document_type_list->AutoHidePager) ?>
<?php if ($document_type_list->Pager->RecordCount > 0 && $document_type_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($document_type_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_list->pageUrl() ?>start=<?php echo $document_type_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($document_type_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_list->pageUrl() ?>start=<?php echo $document_type_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($document_type_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $document_type_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($document_type_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_list->pageUrl() ?>start=<?php echo $document_type_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($document_type_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_list->pageUrl() ?>start=<?php echo $document_type_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($document_type_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $document_type_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $document_type_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $document_type_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $document_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdocument_typelist" id="fdocument_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_type_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_type_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_type">
<div id="gmp_document_type" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($document_type_list->TotalRecs > 0 || $document_type->isGridEdit()) { ?>
<table id="tbl_document_typelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$document_type_list->RowType = ROWTYPE_HEADER;

// Render list options
$document_type_list->renderListOptions();

// Render list options (header, left)
$document_type_list->ListOptions->render("header", "left");
?>
<?php if ($document_type->type_id->Visible) { // type_id ?>
	<?php if ($document_type->sortUrl($document_type->type_id) == "") { ?>
		<th data-name="type_id" class="<?php echo $document_type->type_id->headerCellClass() ?>"><div id="elh_document_type_type_id" class="document_type_type_id"><div class="ew-table-header-caption"><?php echo $document_type->type_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="type_id" class="<?php echo $document_type->type_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_type->SortUrl($document_type->type_id) ?>',2);"><div id="elh_document_type_type_id" class="document_type_type_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_type->type_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_type->type_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_type->type_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_type->document_type->Visible) { // document_type ?>
	<?php if ($document_type->sortUrl($document_type->document_type) == "") { ?>
		<th data-name="document_type" class="<?php echo $document_type->document_type->headerCellClass() ?>"><div id="elh_document_type_document_type" class="document_type_document_type"><div class="ew-table-header-caption"><?php echo $document_type->document_type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="document_type" class="<?php echo $document_type->document_type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_type->SortUrl($document_type->document_type) ?>',2);"><div id="elh_document_type_document_type" class="document_type_document_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_type->document_type->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_type->document_type->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_type->document_type->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_type->document_category->Visible) { // document_category ?>
	<?php if ($document_type->sortUrl($document_type->document_category) == "") { ?>
		<th data-name="document_category" class="<?php echo $document_type->document_category->headerCellClass() ?>"><div id="elh_document_type_document_category" class="document_type_document_category"><div class="ew-table-header-caption"><?php echo $document_type->document_category->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="document_category" class="<?php echo $document_type->document_category->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_type->SortUrl($document_type->document_category) ?>',2);"><div id="elh_document_type_document_category" class="document_type_document_category">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_type->document_category->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_type->document_category->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_type->document_category->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$document_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($document_type->ExportAll && $document_type->isExport()) {
	$document_type_list->StopRec = $document_type_list->TotalRecs;
} else {

	// Set the last record to display
	if ($document_type_list->TotalRecs > $document_type_list->StartRec + $document_type_list->DisplayRecs - 1)
		$document_type_list->StopRec = $document_type_list->StartRec + $document_type_list->DisplayRecs - 1;
	else
		$document_type_list->StopRec = $document_type_list->TotalRecs;
}
$document_type_list->RecCnt = $document_type_list->StartRec - 1;
if ($document_type_list->Recordset && !$document_type_list->Recordset->EOF) {
	$document_type_list->Recordset->moveFirst();
	$selectLimit = $document_type_list->UseSelectLimit;
	if (!$selectLimit && $document_type_list->StartRec > 1)
		$document_type_list->Recordset->move($document_type_list->StartRec - 1);
} elseif (!$document_type->AllowAddDeleteRow && $document_type_list->StopRec == 0) {
	$document_type_list->StopRec = $document_type->GridAddRowCount;
}

// Initialize aggregate
$document_type->RowType = ROWTYPE_AGGREGATEINIT;
$document_type->resetAttributes();
$document_type_list->renderRow();
while ($document_type_list->RecCnt < $document_type_list->StopRec) {
	$document_type_list->RecCnt++;
	if ($document_type_list->RecCnt >= $document_type_list->StartRec) {
		$document_type_list->RowCnt++;

		// Set up key count
		$document_type_list->KeyCount = $document_type_list->RowIndex;

		// Init row class and style
		$document_type->resetAttributes();
		$document_type->CssClass = "";
		if ($document_type->isGridAdd()) {
		} else {
			$document_type_list->loadRowValues($document_type_list->Recordset); // Load row values
		}
		$document_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$document_type->RowAttrs = array_merge($document_type->RowAttrs, array('data-rowindex'=>$document_type_list->RowCnt, 'id'=>'r' . $document_type_list->RowCnt . '_document_type', 'data-rowtype'=>$document_type->RowType));

		// Render row
		$document_type_list->renderRow();

		// Render list options
		$document_type_list->renderListOptions();
?>
	<tr<?php echo $document_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$document_type_list->ListOptions->render("body", "left", $document_type_list->RowCnt);
?>
	<?php if ($document_type->type_id->Visible) { // type_id ?>
		<td data-name="type_id"<?php echo $document_type->type_id->cellAttributes() ?>>
<span id="el<?php echo $document_type_list->RowCnt ?>_document_type_type_id" class="document_type_type_id">
<span<?php echo $document_type->type_id->viewAttributes() ?>>
<?php echo $document_type->type_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_type->document_type->Visible) { // document_type ?>
		<td data-name="document_type"<?php echo $document_type->document_type->cellAttributes() ?>>
<span id="el<?php echo $document_type_list->RowCnt ?>_document_type_document_type" class="document_type_document_type">
<span<?php echo $document_type->document_type->viewAttributes() ?>>
<?php echo $document_type->document_type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_type->document_category->Visible) { // document_category ?>
		<td data-name="document_category"<?php echo $document_type->document_category->cellAttributes() ?>>
<span id="el<?php echo $document_type_list->RowCnt ?>_document_type_document_category" class="document_type_document_category">
<span<?php echo $document_type->document_category->viewAttributes() ?>>
<?php echo $document_type->document_category->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$document_type_list->ListOptions->render("body", "right", $document_type_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$document_type->isGridAdd())
		$document_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$document_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($document_type_list->Recordset)
	$document_type_list->Recordset->Close();
?>
<?php if (!$document_type->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$document_type->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($document_type_list->Pager)) $document_type_list->Pager = new NumericPager($document_type_list->StartRec, $document_type_list->DisplayRecs, $document_type_list->TotalRecs, $document_type_list->RecRange, $document_type_list->AutoHidePager) ?>
<?php if ($document_type_list->Pager->RecordCount > 0 && $document_type_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($document_type_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_list->pageUrl() ?>start=<?php echo $document_type_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($document_type_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_list->pageUrl() ?>start=<?php echo $document_type_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($document_type_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $document_type_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($document_type_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_list->pageUrl() ?>start=<?php echo $document_type_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($document_type_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_type_list->pageUrl() ?>start=<?php echo $document_type_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($document_type_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $document_type_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $document_type_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $document_type_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $document_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($document_type_list->TotalRecs == 0 && !$document_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $document_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$document_type_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$document_type->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$document_type_list->terminate();
?>