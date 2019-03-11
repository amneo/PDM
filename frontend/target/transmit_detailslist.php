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
$transmit_details_list = new transmit_details_list();

// Run the page
$transmit_details_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transmit_details_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$transmit_details->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftransmit_detailslist = currentForm = new ew.Form("ftransmit_detailslist", "list");
ftransmit_detailslist.formKeyCountName = '<?php echo $transmit_details_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftransmit_detailslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftransmit_detailslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftransmit_detailslist.lists["x_project_name"] = <?php echo $transmit_details_list->project_name->Lookup->toClientList() ?>;
ftransmit_detailslist.lists["x_project_name"].options = <?php echo JsonEncode($transmit_details_list->project_name->lookupOptions()) ?>;
ftransmit_detailslist.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftransmit_detailslist.lists["x_ack_rcvd"] = <?php echo $transmit_details_list->ack_rcvd->Lookup->toClientList() ?>;
ftransmit_detailslist.lists["x_ack_rcvd"].options = <?php echo JsonEncode($transmit_details_list->ack_rcvd->options(FALSE, TRUE)) ?>;

// Form object for search
var ftransmit_detailslistsrch = currentSearchForm = new ew.Form("ftransmit_detailslistsrch");

// Filters
ftransmit_detailslistsrch.filterList = <?php echo $transmit_details_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$transmit_details->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($transmit_details_list->TotalRecs > 0 && $transmit_details_list->ExportOptions->visible()) { ?>
<?php $transmit_details_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($transmit_details_list->ImportOptions->visible()) { ?>
<?php $transmit_details_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($transmit_details_list->SearchOptions->visible()) { ?>
<?php $transmit_details_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($transmit_details_list->FilterOptions->visible()) { ?>
<?php $transmit_details_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$transmit_details_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$transmit_details->isExport() && !$transmit_details->CurrentAction) { ?>
<form name="ftransmit_detailslistsrch" id="ftransmit_detailslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($transmit_details_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftransmit_detailslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="transmit_details">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($transmit_details_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($transmit_details_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $transmit_details_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($transmit_details_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($transmit_details_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($transmit_details_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($transmit_details_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $transmit_details_list->showPageHeader(); ?>
<?php
$transmit_details_list->showMessage();
?>
<?php if ($transmit_details_list->TotalRecs > 0 || $transmit_details->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($transmit_details_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> transmit_details">
<?php if (!$transmit_details->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$transmit_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($transmit_details_list->Pager)) $transmit_details_list->Pager = new NumericPager($transmit_details_list->StartRec, $transmit_details_list->DisplayRecs, $transmit_details_list->TotalRecs, $transmit_details_list->RecRange, $transmit_details_list->AutoHidePager) ?>
<?php if ($transmit_details_list->Pager->RecordCount > 0 && $transmit_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($transmit_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_list->pageUrl() ?>start=<?php echo $transmit_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($transmit_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_list->pageUrl() ?>start=<?php echo $transmit_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($transmit_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $transmit_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($transmit_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_list->pageUrl() ?>start=<?php echo $transmit_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($transmit_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_list->pageUrl() ?>start=<?php echo $transmit_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($transmit_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $transmit_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $transmit_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $transmit_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $transmit_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftransmit_detailslist" id="ftransmit_detailslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($transmit_details_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $transmit_details_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transmit_details">
<div id="gmp_transmit_details" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($transmit_details_list->TotalRecs > 0 || $transmit_details->isGridEdit()) { ?>
<table id="tbl_transmit_detailslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$transmit_details_list->RowType = ROWTYPE_HEADER;

// Render list options
$transmit_details_list->renderListOptions();

// Render list options (header, left)
$transmit_details_list->ListOptions->render("header", "left");
?>
<?php if ($transmit_details->transmittal_no->Visible) { // transmittal_no ?>
	<?php if ($transmit_details->sortUrl($transmit_details->transmittal_no) == "") { ?>
		<th data-name="transmittal_no" class="<?php echo $transmit_details->transmittal_no->headerCellClass() ?>"><div id="elh_transmit_details_transmittal_no" class="transmit_details_transmittal_no"><div class="ew-table-header-caption"><?php echo $transmit_details->transmittal_no->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmittal_no" class="<?php echo $transmit_details->transmittal_no->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transmit_details->SortUrl($transmit_details->transmittal_no) ?>',2);"><div id="elh_transmit_details_transmittal_no" class="transmit_details_transmittal_no">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transmit_details->transmittal_no->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transmit_details->transmittal_no->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transmit_details->transmittal_no->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transmit_details->project_name->Visible) { // project_name ?>
	<?php if ($transmit_details->sortUrl($transmit_details->project_name) == "") { ?>
		<th data-name="project_name" class="<?php echo $transmit_details->project_name->headerCellClass() ?>"><div id="elh_transmit_details_project_name" class="transmit_details_project_name"><div class="ew-table-header-caption"><?php echo $transmit_details->project_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="project_name" class="<?php echo $transmit_details->project_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transmit_details->SortUrl($transmit_details->project_name) ?>',2);"><div id="elh_transmit_details_project_name" class="transmit_details_project_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transmit_details->project_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transmit_details->project_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transmit_details->project_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transmit_details->delivery_location->Visible) { // delivery_location ?>
	<?php if ($transmit_details->sortUrl($transmit_details->delivery_location) == "") { ?>
		<th data-name="delivery_location" class="<?php echo $transmit_details->delivery_location->headerCellClass() ?>"><div id="elh_transmit_details_delivery_location" class="transmit_details_delivery_location"><div class="ew-table-header-caption"><?php echo $transmit_details->delivery_location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="delivery_location" class="<?php echo $transmit_details->delivery_location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transmit_details->SortUrl($transmit_details->delivery_location) ?>',2);"><div id="elh_transmit_details_delivery_location" class="transmit_details_delivery_location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transmit_details->delivery_location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transmit_details->delivery_location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transmit_details->delivery_location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transmit_details->addressed_to->Visible) { // addressed_to ?>
	<?php if ($transmit_details->sortUrl($transmit_details->addressed_to) == "") { ?>
		<th data-name="addressed_to" class="<?php echo $transmit_details->addressed_to->headerCellClass() ?>"><div id="elh_transmit_details_addressed_to" class="transmit_details_addressed_to"><div class="ew-table-header-caption"><?php echo $transmit_details->addressed_to->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="addressed_to" class="<?php echo $transmit_details->addressed_to->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transmit_details->SortUrl($transmit_details->addressed_to) ?>',2);"><div id="elh_transmit_details_addressed_to" class="transmit_details_addressed_to">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transmit_details->addressed_to->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transmit_details->addressed_to->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transmit_details->addressed_to->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transmit_details->remarks->Visible) { // remarks ?>
	<?php if ($transmit_details->sortUrl($transmit_details->remarks) == "") { ?>
		<th data-name="remarks" class="<?php echo $transmit_details->remarks->headerCellClass() ?>"><div id="elh_transmit_details_remarks" class="transmit_details_remarks"><div class="ew-table-header-caption"><?php echo $transmit_details->remarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="remarks" class="<?php echo $transmit_details->remarks->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transmit_details->SortUrl($transmit_details->remarks) ?>',2);"><div id="elh_transmit_details_remarks" class="transmit_details_remarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transmit_details->remarks->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transmit_details->remarks->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transmit_details->remarks->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transmit_details->ack_rcvd->Visible) { // ack_rcvd ?>
	<?php if ($transmit_details->sortUrl($transmit_details->ack_rcvd) == "") { ?>
		<th data-name="ack_rcvd" class="<?php echo $transmit_details->ack_rcvd->headerCellClass() ?>"><div id="elh_transmit_details_ack_rcvd" class="transmit_details_ack_rcvd"><div class="ew-table-header-caption"><?php echo $transmit_details->ack_rcvd->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ack_rcvd" class="<?php echo $transmit_details->ack_rcvd->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transmit_details->SortUrl($transmit_details->ack_rcvd) ?>',2);"><div id="elh_transmit_details_ack_rcvd" class="transmit_details_ack_rcvd">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transmit_details->ack_rcvd->caption() ?></span><span class="ew-table-header-sort"><?php if ($transmit_details->ack_rcvd->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transmit_details->ack_rcvd->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transmit_details->ack_document->Visible) { // ack_document ?>
	<?php if ($transmit_details->sortUrl($transmit_details->ack_document) == "") { ?>
		<th data-name="ack_document" class="<?php echo $transmit_details->ack_document->headerCellClass() ?>"><div id="elh_transmit_details_ack_document" class="transmit_details_ack_document"><div class="ew-table-header-caption"><?php echo $transmit_details->ack_document->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ack_document" class="<?php echo $transmit_details->ack_document->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transmit_details->SortUrl($transmit_details->ack_document) ?>',2);"><div id="elh_transmit_details_ack_document" class="transmit_details_ack_document">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transmit_details->ack_document->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transmit_details->ack_document->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transmit_details->ack_document->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transmit_details->transmital_date->Visible) { // transmital_date ?>
	<?php if ($transmit_details->sortUrl($transmit_details->transmital_date) == "") { ?>
		<th data-name="transmital_date" class="<?php echo $transmit_details->transmital_date->headerCellClass() ?>"><div id="elh_transmit_details_transmital_date" class="transmit_details_transmital_date"><div class="ew-table-header-caption"><?php echo $transmit_details->transmital_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmital_date" class="<?php echo $transmit_details->transmital_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transmit_details->SortUrl($transmit_details->transmital_date) ?>',2);"><div id="elh_transmit_details_transmital_date" class="transmit_details_transmital_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transmit_details->transmital_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($transmit_details->transmital_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transmit_details->transmital_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$transmit_details_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($transmit_details->ExportAll && $transmit_details->isExport()) {
	$transmit_details_list->StopRec = $transmit_details_list->TotalRecs;
} else {

	// Set the last record to display
	if ($transmit_details_list->TotalRecs > $transmit_details_list->StartRec + $transmit_details_list->DisplayRecs - 1)
		$transmit_details_list->StopRec = $transmit_details_list->StartRec + $transmit_details_list->DisplayRecs - 1;
	else
		$transmit_details_list->StopRec = $transmit_details_list->TotalRecs;
}
$transmit_details_list->RecCnt = $transmit_details_list->StartRec - 1;
if ($transmit_details_list->Recordset && !$transmit_details_list->Recordset->EOF) {
	$transmit_details_list->Recordset->moveFirst();
	$selectLimit = $transmit_details_list->UseSelectLimit;
	if (!$selectLimit && $transmit_details_list->StartRec > 1)
		$transmit_details_list->Recordset->move($transmit_details_list->StartRec - 1);
} elseif (!$transmit_details->AllowAddDeleteRow && $transmit_details_list->StopRec == 0) {
	$transmit_details_list->StopRec = $transmit_details->GridAddRowCount;
}

// Initialize aggregate
$transmit_details->RowType = ROWTYPE_AGGREGATEINIT;
$transmit_details->resetAttributes();
$transmit_details_list->renderRow();
while ($transmit_details_list->RecCnt < $transmit_details_list->StopRec) {
	$transmit_details_list->RecCnt++;
	if ($transmit_details_list->RecCnt >= $transmit_details_list->StartRec) {
		$transmit_details_list->RowCnt++;

		// Set up key count
		$transmit_details_list->KeyCount = $transmit_details_list->RowIndex;

		// Init row class and style
		$transmit_details->resetAttributes();
		$transmit_details->CssClass = "";
		if ($transmit_details->isGridAdd()) {
		} else {
			$transmit_details_list->loadRowValues($transmit_details_list->Recordset); // Load row values
		}
		$transmit_details->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$transmit_details->RowAttrs = array_merge($transmit_details->RowAttrs, array('data-rowindex'=>$transmit_details_list->RowCnt, 'id'=>'r' . $transmit_details_list->RowCnt . '_transmit_details', 'data-rowtype'=>$transmit_details->RowType));

		// Render row
		$transmit_details_list->renderRow();

		// Render list options
		$transmit_details_list->renderListOptions();
?>
	<tr<?php echo $transmit_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$transmit_details_list->ListOptions->render("body", "left", $transmit_details_list->RowCnt);
?>
	<?php if ($transmit_details->transmittal_no->Visible) { // transmittal_no ?>
		<td data-name="transmittal_no"<?php echo $transmit_details->transmittal_no->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_transmittal_no" class="transmit_details_transmittal_no">
<span<?php echo $transmit_details->transmittal_no->viewAttributes() ?>>
<?php echo $transmit_details->transmittal_no->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transmit_details->project_name->Visible) { // project_name ?>
		<td data-name="project_name"<?php echo $transmit_details->project_name->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_project_name" class="transmit_details_project_name">
<span<?php echo $transmit_details->project_name->viewAttributes() ?>>
<?php echo $transmit_details->project_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transmit_details->delivery_location->Visible) { // delivery_location ?>
		<td data-name="delivery_location"<?php echo $transmit_details->delivery_location->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_delivery_location" class="transmit_details_delivery_location">
<span<?php echo $transmit_details->delivery_location->viewAttributes() ?>>
<?php echo $transmit_details->delivery_location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transmit_details->addressed_to->Visible) { // addressed_to ?>
		<td data-name="addressed_to"<?php echo $transmit_details->addressed_to->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_addressed_to" class="transmit_details_addressed_to">
<span<?php echo $transmit_details->addressed_to->viewAttributes() ?>>
<?php echo $transmit_details->addressed_to->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transmit_details->remarks->Visible) { // remarks ?>
		<td data-name="remarks"<?php echo $transmit_details->remarks->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_remarks" class="transmit_details_remarks">
<span<?php echo $transmit_details->remarks->viewAttributes() ?>>
<?php echo $transmit_details->remarks->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transmit_details->ack_rcvd->Visible) { // ack_rcvd ?>
		<td data-name="ack_rcvd"<?php echo $transmit_details->ack_rcvd->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_ack_rcvd" class="transmit_details_ack_rcvd">
<span<?php echo $transmit_details->ack_rcvd->viewAttributes() ?>>
<?php echo $transmit_details->ack_rcvd->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transmit_details->ack_document->Visible) { // ack_document ?>
		<td data-name="ack_document"<?php echo $transmit_details->ack_document->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_ack_document" class="transmit_details_ack_document">
<span<?php echo $transmit_details->ack_document->viewAttributes() ?>>
<?php echo GetFileViewTag($transmit_details->ack_document, $transmit_details->ack_document->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($transmit_details->transmital_date->Visible) { // transmital_date ?>
		<td data-name="transmital_date"<?php echo $transmit_details->transmital_date->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_transmital_date" class="transmit_details_transmital_date">
<span<?php echo $transmit_details->transmital_date->viewAttributes() ?>>
<?php echo $transmit_details->transmital_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$transmit_details_list->ListOptions->render("body", "right", $transmit_details_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$transmit_details->isGridAdd())
		$transmit_details_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$transmit_details->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($transmit_details_list->Recordset)
	$transmit_details_list->Recordset->Close();
?>
<?php if (!$transmit_details->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$transmit_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($transmit_details_list->Pager)) $transmit_details_list->Pager = new NumericPager($transmit_details_list->StartRec, $transmit_details_list->DisplayRecs, $transmit_details_list->TotalRecs, $transmit_details_list->RecRange, $transmit_details_list->AutoHidePager) ?>
<?php if ($transmit_details_list->Pager->RecordCount > 0 && $transmit_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($transmit_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_list->pageUrl() ?>start=<?php echo $transmit_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($transmit_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_list->pageUrl() ?>start=<?php echo $transmit_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($transmit_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $transmit_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($transmit_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_list->pageUrl() ?>start=<?php echo $transmit_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($transmit_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transmit_details_list->pageUrl() ?>start=<?php echo $transmit_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($transmit_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $transmit_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $transmit_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $transmit_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $transmit_details_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($transmit_details_list->TotalRecs == 0 && !$transmit_details->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $transmit_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$transmit_details_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$transmit_details->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$transmit_details_list->terminate();
?>