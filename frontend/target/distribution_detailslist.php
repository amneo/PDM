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
$distribution_details_list = new distribution_details_list();

// Run the page
$distribution_details_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$distribution_details_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$distribution_details->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fdistribution_detailslist = currentForm = new ew.Form("fdistribution_detailslist", "list");
fdistribution_detailslist.formKeyCountName = '<?php echo $distribution_details_list->FormKeyCountName ?>';

// Form_CustomValidate event
fdistribution_detailslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdistribution_detailslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdistribution_detailslist.lists["x_project_name"] = <?php echo $distribution_details_list->project_name->Lookup->toClientList() ?>;
fdistribution_detailslist.lists["x_project_name"].options = <?php echo JsonEncode($distribution_details_list->project_name->lookupOptions()) ?>;
fdistribution_detailslist.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdistribution_detailslist.lists["x_distribution_valid"] = <?php echo $distribution_details_list->distribution_valid->Lookup->toClientList() ?>;
fdistribution_detailslist.lists["x_distribution_valid"].options = <?php echo JsonEncode($distribution_details_list->distribution_valid->options(FALSE, TRUE)) ?>;

// Form object for search
var fdistribution_detailslistsrch = currentSearchForm = new ew.Form("fdistribution_detailslistsrch");

// Filters
fdistribution_detailslistsrch.filterList = <?php echo $distribution_details_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$distribution_details->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($distribution_details_list->TotalRecs > 0 && $distribution_details_list->ExportOptions->visible()) { ?>
<?php $distribution_details_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($distribution_details_list->ImportOptions->visible()) { ?>
<?php $distribution_details_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($distribution_details_list->SearchOptions->visible()) { ?>
<?php $distribution_details_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($distribution_details_list->FilterOptions->visible()) { ?>
<?php $distribution_details_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$distribution_details_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$distribution_details->isExport() && !$distribution_details->CurrentAction) { ?>
<form name="fdistribution_detailslistsrch" id="fdistribution_detailslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($distribution_details_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fdistribution_detailslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="distribution_details">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($distribution_details_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($distribution_details_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $distribution_details_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($distribution_details_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($distribution_details_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($distribution_details_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($distribution_details_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $distribution_details_list->showPageHeader(); ?>
<?php
$distribution_details_list->showMessage();
?>
<?php if ($distribution_details_list->TotalRecs > 0 || $distribution_details->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($distribution_details_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> distribution_details">
<?php if (!$distribution_details->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$distribution_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($distribution_details_list->Pager)) $distribution_details_list->Pager = new NumericPager($distribution_details_list->StartRec, $distribution_details_list->DisplayRecs, $distribution_details_list->TotalRecs, $distribution_details_list->RecRange, $distribution_details_list->AutoHidePager) ?>
<?php if ($distribution_details_list->Pager->RecordCount > 0 && $distribution_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($distribution_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_list->pageUrl() ?>start=<?php echo $distribution_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($distribution_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_list->pageUrl() ?>start=<?php echo $distribution_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($distribution_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $distribution_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($distribution_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_list->pageUrl() ?>start=<?php echo $distribution_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($distribution_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_list->pageUrl() ?>start=<?php echo $distribution_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($distribution_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $distribution_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $distribution_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $distribution_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($distribution_details_list->TotalRecs > 0 && (!$distribution_details_list->AutoHidePageSizeSelector || $distribution_details_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="distribution_details">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="50"<?php if ($distribution_details_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($distribution_details_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="150"<?php if ($distribution_details_list->DisplayRecs == 150) { ?> selected<?php } ?>>150</option>
<option value="ALL"<?php if ($distribution_details->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $distribution_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdistribution_detailslist" id="fdistribution_detailslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($distribution_details_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $distribution_details_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="distribution_details">
<div id="gmp_distribution_details" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($distribution_details_list->TotalRecs > 0 || $distribution_details->isGridEdit()) { ?>
<table id="tbl_distribution_detailslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$distribution_details_list->RowType = ROWTYPE_HEADER;

// Render list options
$distribution_details_list->renderListOptions();

// Render list options (header, left)
$distribution_details_list->ListOptions->render("header", "left");
?>
<?php if ($distribution_details->to_Name->Visible) { // to_Name ?>
	<?php if ($distribution_details->sortUrl($distribution_details->to_Name) == "") { ?>
		<th data-name="to_Name" class="<?php echo $distribution_details->to_Name->headerCellClass() ?>"><div id="elh_distribution_details_to_Name" class="distribution_details_to_Name"><div class="ew-table-header-caption"><?php echo $distribution_details->to_Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="to_Name" class="<?php echo $distribution_details->to_Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $distribution_details->SortUrl($distribution_details->to_Name) ?>',2);"><div id="elh_distribution_details_to_Name" class="distribution_details_to_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $distribution_details->to_Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($distribution_details->to_Name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($distribution_details->to_Name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($distribution_details->email_address->Visible) { // email_address ?>
	<?php if ($distribution_details->sortUrl($distribution_details->email_address) == "") { ?>
		<th data-name="email_address" class="<?php echo $distribution_details->email_address->headerCellClass() ?>"><div id="elh_distribution_details_email_address" class="distribution_details_email_address"><div class="ew-table-header-caption"><?php echo $distribution_details->email_address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="email_address" class="<?php echo $distribution_details->email_address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $distribution_details->SortUrl($distribution_details->email_address) ?>',2);"><div id="elh_distribution_details_email_address" class="distribution_details_email_address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $distribution_details->email_address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($distribution_details->email_address->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($distribution_details->email_address->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($distribution_details->project_name->Visible) { // project_name ?>
	<?php if ($distribution_details->sortUrl($distribution_details->project_name) == "") { ?>
		<th data-name="project_name" class="<?php echo $distribution_details->project_name->headerCellClass() ?>"><div id="elh_distribution_details_project_name" class="distribution_details_project_name"><div class="ew-table-header-caption"><?php echo $distribution_details->project_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="project_name" class="<?php echo $distribution_details->project_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $distribution_details->SortUrl($distribution_details->project_name) ?>',2);"><div id="elh_distribution_details_project_name" class="distribution_details_project_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $distribution_details->project_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($distribution_details->project_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($distribution_details->project_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($distribution_details->distribution_valid->Visible) { // distribution_valid ?>
	<?php if ($distribution_details->sortUrl($distribution_details->distribution_valid) == "") { ?>
		<th data-name="distribution_valid" class="<?php echo $distribution_details->distribution_valid->headerCellClass() ?>"><div id="elh_distribution_details_distribution_valid" class="distribution_details_distribution_valid"><div class="ew-table-header-caption"><?php echo $distribution_details->distribution_valid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="distribution_valid" class="<?php echo $distribution_details->distribution_valid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $distribution_details->SortUrl($distribution_details->distribution_valid) ?>',2);"><div id="elh_distribution_details_distribution_valid" class="distribution_details_distribution_valid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $distribution_details->distribution_valid->caption() ?></span><span class="ew-table-header-sort"><?php if ($distribution_details->distribution_valid->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($distribution_details->distribution_valid->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$distribution_details_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($distribution_details->ExportAll && $distribution_details->isExport()) {
	$distribution_details_list->StopRec = $distribution_details_list->TotalRecs;
} else {

	// Set the last record to display
	if ($distribution_details_list->TotalRecs > $distribution_details_list->StartRec + $distribution_details_list->DisplayRecs - 1)
		$distribution_details_list->StopRec = $distribution_details_list->StartRec + $distribution_details_list->DisplayRecs - 1;
	else
		$distribution_details_list->StopRec = $distribution_details_list->TotalRecs;
}
$distribution_details_list->RecCnt = $distribution_details_list->StartRec - 1;
if ($distribution_details_list->Recordset && !$distribution_details_list->Recordset->EOF) {
	$distribution_details_list->Recordset->moveFirst();
	$selectLimit = $distribution_details_list->UseSelectLimit;
	if (!$selectLimit && $distribution_details_list->StartRec > 1)
		$distribution_details_list->Recordset->move($distribution_details_list->StartRec - 1);
} elseif (!$distribution_details->AllowAddDeleteRow && $distribution_details_list->StopRec == 0) {
	$distribution_details_list->StopRec = $distribution_details->GridAddRowCount;
}

// Initialize aggregate
$distribution_details->RowType = ROWTYPE_AGGREGATEINIT;
$distribution_details->resetAttributes();
$distribution_details_list->renderRow();
while ($distribution_details_list->RecCnt < $distribution_details_list->StopRec) {
	$distribution_details_list->RecCnt++;
	if ($distribution_details_list->RecCnt >= $distribution_details_list->StartRec) {
		$distribution_details_list->RowCnt++;

		// Set up key count
		$distribution_details_list->KeyCount = $distribution_details_list->RowIndex;

		// Init row class and style
		$distribution_details->resetAttributes();
		$distribution_details->CssClass = "";
		if ($distribution_details->isGridAdd()) {
		} else {
			$distribution_details_list->loadRowValues($distribution_details_list->Recordset); // Load row values
		}
		$distribution_details->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$distribution_details->RowAttrs = array_merge($distribution_details->RowAttrs, array('data-rowindex'=>$distribution_details_list->RowCnt, 'id'=>'r' . $distribution_details_list->RowCnt . '_distribution_details', 'data-rowtype'=>$distribution_details->RowType));

		// Render row
		$distribution_details_list->renderRow();

		// Render list options
		$distribution_details_list->renderListOptions();
?>
	<tr<?php echo $distribution_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$distribution_details_list->ListOptions->render("body", "left", $distribution_details_list->RowCnt);
?>
	<?php if ($distribution_details->to_Name->Visible) { // to_Name ?>
		<td data-name="to_Name"<?php echo $distribution_details->to_Name->cellAttributes() ?>>
<span id="el<?php echo $distribution_details_list->RowCnt ?>_distribution_details_to_Name" class="distribution_details_to_Name">
<span<?php echo $distribution_details->to_Name->viewAttributes() ?>>
<?php echo $distribution_details->to_Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($distribution_details->email_address->Visible) { // email_address ?>
		<td data-name="email_address"<?php echo $distribution_details->email_address->cellAttributes() ?>>
<span id="el<?php echo $distribution_details_list->RowCnt ?>_distribution_details_email_address" class="distribution_details_email_address">
<span<?php echo $distribution_details->email_address->viewAttributes() ?>>
<?php echo $distribution_details->email_address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($distribution_details->project_name->Visible) { // project_name ?>
		<td data-name="project_name"<?php echo $distribution_details->project_name->cellAttributes() ?>>
<span id="el<?php echo $distribution_details_list->RowCnt ?>_distribution_details_project_name" class="distribution_details_project_name">
<span<?php echo $distribution_details->project_name->viewAttributes() ?>>
<?php echo $distribution_details->project_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($distribution_details->distribution_valid->Visible) { // distribution_valid ?>
		<td data-name="distribution_valid"<?php echo $distribution_details->distribution_valid->cellAttributes() ?>>
<span id="el<?php echo $distribution_details_list->RowCnt ?>_distribution_details_distribution_valid" class="distribution_details_distribution_valid">
<span<?php echo $distribution_details->distribution_valid->viewAttributes() ?>>
<?php echo $distribution_details->distribution_valid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$distribution_details_list->ListOptions->render("body", "right", $distribution_details_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$distribution_details->isGridAdd())
		$distribution_details_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$distribution_details->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($distribution_details_list->Recordset)
	$distribution_details_list->Recordset->Close();
?>
<?php if (!$distribution_details->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$distribution_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($distribution_details_list->Pager)) $distribution_details_list->Pager = new NumericPager($distribution_details_list->StartRec, $distribution_details_list->DisplayRecs, $distribution_details_list->TotalRecs, $distribution_details_list->RecRange, $distribution_details_list->AutoHidePager) ?>
<?php if ($distribution_details_list->Pager->RecordCount > 0 && $distribution_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($distribution_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_list->pageUrl() ?>start=<?php echo $distribution_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($distribution_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_list->pageUrl() ?>start=<?php echo $distribution_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($distribution_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $distribution_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($distribution_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_list->pageUrl() ?>start=<?php echo $distribution_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($distribution_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $distribution_details_list->pageUrl() ?>start=<?php echo $distribution_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($distribution_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $distribution_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $distribution_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $distribution_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($distribution_details_list->TotalRecs > 0 && (!$distribution_details_list->AutoHidePageSizeSelector || $distribution_details_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="distribution_details">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="50"<?php if ($distribution_details_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($distribution_details_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="150"<?php if ($distribution_details_list->DisplayRecs == 150) { ?> selected<?php } ?>>150</option>
<option value="ALL"<?php if ($distribution_details->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $distribution_details_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($distribution_details_list->TotalRecs == 0 && !$distribution_details->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $distribution_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$distribution_details_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$distribution_details->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$distribution_details_list->terminate();
?>