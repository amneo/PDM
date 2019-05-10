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
$xmit_details_list = new xmit_details_list();

// Run the page
$xmit_details_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$xmit_details_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$xmit_details->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fxmit_detailslist = currentForm = new ew.Form("fxmit_detailslist", "list");
fxmit_detailslist.formKeyCountName = '<?php echo $xmit_details_list->FormKeyCountName ?>';

// Form_CustomValidate event
fxmit_detailslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fxmit_detailslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fxmit_detailslistsrch = currentSearchForm = new ew.Form("fxmit_detailslistsrch");

// Filters
fxmit_detailslistsrch.filterList = <?php echo $xmit_details_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$xmit_details->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($xmit_details_list->TotalRecs > 0 && $xmit_details_list->ExportOptions->visible()) { ?>
<?php $xmit_details_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($xmit_details_list->ImportOptions->visible()) { ?>
<?php $xmit_details_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($xmit_details_list->SearchOptions->visible()) { ?>
<?php $xmit_details_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($xmit_details_list->FilterOptions->visible()) { ?>
<?php $xmit_details_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$xmit_details_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$xmit_details->isExport() && !$xmit_details->CurrentAction) { ?>
<form name="fxmit_detailslistsrch" id="fxmit_detailslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($xmit_details_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fxmit_detailslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="xmit_details">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($xmit_details_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($xmit_details_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $xmit_details_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($xmit_details_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($xmit_details_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($xmit_details_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($xmit_details_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $xmit_details_list->showPageHeader(); ?>
<?php
$xmit_details_list->showMessage();
?>
<?php if ($xmit_details_list->TotalRecs > 0 || $xmit_details->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($xmit_details_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> xmit_details">
<?php if (!$xmit_details->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$xmit_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($xmit_details_list->Pager)) $xmit_details_list->Pager = new NumericPager($xmit_details_list->StartRec, $xmit_details_list->DisplayRecs, $xmit_details_list->TotalRecs, $xmit_details_list->RecRange, $xmit_details_list->AutoHidePager) ?>
<?php if ($xmit_details_list->Pager->RecordCount > 0 && $xmit_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($xmit_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($xmit_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($xmit_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $xmit_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($xmit_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($xmit_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($xmit_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $xmit_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $xmit_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $xmit_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $xmit_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fxmit_detailslist" id="fxmit_detailslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($xmit_details_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $xmit_details_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="xmit_details">
<div id="gmp_xmit_details" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($xmit_details_list->TotalRecs > 0 || $xmit_details->isGridEdit()) { ?>
<table id="tbl_xmit_detailslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$xmit_details_list->RowType = ROWTYPE_HEADER;

// Render list options
$xmit_details_list->renderListOptions();

// Render list options (header, left)
$xmit_details_list->ListOptions->render("header", "left");
?>
<?php if ($xmit_details->xmit_id->Visible) { // xmit_id ?>
	<?php if ($xmit_details->sortUrl($xmit_details->xmit_id) == "") { ?>
		<th data-name="xmit_id" class="<?php echo $xmit_details->xmit_id->headerCellClass() ?>"><div id="elh_xmit_details_xmit_id" class="xmit_details_xmit_id"><div class="ew-table-header-caption"><?php echo $xmit_details->xmit_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="xmit_id" class="<?php echo $xmit_details->xmit_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $xmit_details->SortUrl($xmit_details->xmit_id) ?>',2);"><div id="elh_xmit_details_xmit_id" class="xmit_details_xmit_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $xmit_details->xmit_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($xmit_details->xmit_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($xmit_details->xmit_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($xmit_details->xmit_mode->Visible) { // xmit_mode ?>
	<?php if ($xmit_details->sortUrl($xmit_details->xmit_mode) == "") { ?>
		<th data-name="xmit_mode" class="<?php echo $xmit_details->xmit_mode->headerCellClass() ?>"><div id="elh_xmit_details_xmit_mode" class="xmit_details_xmit_mode"><div class="ew-table-header-caption"><?php echo $xmit_details->xmit_mode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="xmit_mode" class="<?php echo $xmit_details->xmit_mode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $xmit_details->SortUrl($xmit_details->xmit_mode) ?>',2);"><div id="elh_xmit_details_xmit_mode" class="xmit_details_xmit_mode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $xmit_details->xmit_mode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($xmit_details->xmit_mode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($xmit_details->xmit_mode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$xmit_details_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($xmit_details->ExportAll && $xmit_details->isExport()) {
	$xmit_details_list->StopRec = $xmit_details_list->TotalRecs;
} else {

	// Set the last record to display
	if ($xmit_details_list->TotalRecs > $xmit_details_list->StartRec + $xmit_details_list->DisplayRecs - 1)
		$xmit_details_list->StopRec = $xmit_details_list->StartRec + $xmit_details_list->DisplayRecs - 1;
	else
		$xmit_details_list->StopRec = $xmit_details_list->TotalRecs;
}
$xmit_details_list->RecCnt = $xmit_details_list->StartRec - 1;
if ($xmit_details_list->Recordset && !$xmit_details_list->Recordset->EOF) {
	$xmit_details_list->Recordset->moveFirst();
	$selectLimit = $xmit_details_list->UseSelectLimit;
	if (!$selectLimit && $xmit_details_list->StartRec > 1)
		$xmit_details_list->Recordset->move($xmit_details_list->StartRec - 1);
} elseif (!$xmit_details->AllowAddDeleteRow && $xmit_details_list->StopRec == 0) {
	$xmit_details_list->StopRec = $xmit_details->GridAddRowCount;
}

// Initialize aggregate
$xmit_details->RowType = ROWTYPE_AGGREGATEINIT;
$xmit_details->resetAttributes();
$xmit_details_list->renderRow();
while ($xmit_details_list->RecCnt < $xmit_details_list->StopRec) {
	$xmit_details_list->RecCnt++;
	if ($xmit_details_list->RecCnt >= $xmit_details_list->StartRec) {
		$xmit_details_list->RowCnt++;

		// Set up key count
		$xmit_details_list->KeyCount = $xmit_details_list->RowIndex;

		// Init row class and style
		$xmit_details->resetAttributes();
		$xmit_details->CssClass = "";
		if ($xmit_details->isGridAdd()) {
		} else {
			$xmit_details_list->loadRowValues($xmit_details_list->Recordset); // Load row values
		}
		$xmit_details->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$xmit_details->RowAttrs = array_merge($xmit_details->RowAttrs, array('data-rowindex'=>$xmit_details_list->RowCnt, 'id'=>'r' . $xmit_details_list->RowCnt . '_xmit_details', 'data-rowtype'=>$xmit_details->RowType));

		// Render row
		$xmit_details_list->renderRow();

		// Render list options
		$xmit_details_list->renderListOptions();
?>
	<tr<?php echo $xmit_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$xmit_details_list->ListOptions->render("body", "left", $xmit_details_list->RowCnt);
?>
	<?php if ($xmit_details->xmit_id->Visible) { // xmit_id ?>
		<td data-name="xmit_id"<?php echo $xmit_details->xmit_id->cellAttributes() ?>>
<span id="el<?php echo $xmit_details_list->RowCnt ?>_xmit_details_xmit_id" class="xmit_details_xmit_id">
<span<?php echo $xmit_details->xmit_id->viewAttributes() ?>>
<?php echo $xmit_details->xmit_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($xmit_details->xmit_mode->Visible) { // xmit_mode ?>
		<td data-name="xmit_mode"<?php echo $xmit_details->xmit_mode->cellAttributes() ?>>
<span id="el<?php echo $xmit_details_list->RowCnt ?>_xmit_details_xmit_mode" class="xmit_details_xmit_mode">
<span<?php echo $xmit_details->xmit_mode->viewAttributes() ?>>
<?php echo $xmit_details->xmit_mode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$xmit_details_list->ListOptions->render("body", "right", $xmit_details_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$xmit_details->isGridAdd())
		$xmit_details_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$xmit_details->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($xmit_details_list->Recordset)
	$xmit_details_list->Recordset->Close();
?>
<?php if (!$xmit_details->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$xmit_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($xmit_details_list->Pager)) $xmit_details_list->Pager = new NumericPager($xmit_details_list->StartRec, $xmit_details_list->DisplayRecs, $xmit_details_list->TotalRecs, $xmit_details_list->RecRange, $xmit_details_list->AutoHidePager) ?>
<?php if ($xmit_details_list->Pager->RecordCount > 0 && $xmit_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($xmit_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($xmit_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($xmit_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $xmit_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($xmit_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($xmit_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($xmit_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $xmit_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $xmit_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $xmit_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $xmit_details_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($xmit_details_list->TotalRecs == 0 && !$xmit_details->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $xmit_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$xmit_details_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$xmit_details->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$xmit_details_list->terminate();
?>