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
$document_log_list = new document_log_list();

// Run the page
$document_log_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_log_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$document_log->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fdocument_loglist = currentForm = new ew.Form("fdocument_loglist", "list");
fdocument_loglist.formKeyCountName = '<?php echo $document_log_list->FormKeyCountName ?>';

// Form_CustomValidate event
fdocument_loglist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_loglist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fdocument_loglistsrch = currentSearchForm = new ew.Form("fdocument_loglistsrch");

// Filters
fdocument_loglistsrch.filterList = <?php echo $document_log_list->getFilterList() ?>;
</script>
<script src="phpjs/ewscrolltable.js"></script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$document_log->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($document_log_list->TotalRecs > 0 && $document_log_list->ExportOptions->visible()) { ?>
<?php $document_log_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($document_log_list->ImportOptions->visible()) { ?>
<?php $document_log_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($document_log_list->SearchOptions->visible()) { ?>
<?php $document_log_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($document_log_list->FilterOptions->visible()) { ?>
<?php $document_log_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$document_log_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$document_log->isExport() && !$document_log->CurrentAction) { ?>
<form name="fdocument_loglistsrch" id="fdocument_loglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($document_log_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fdocument_loglistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="document_log">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($document_log_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($document_log_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $document_log_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($document_log_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($document_log_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($document_log_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($document_log_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $document_log_list->showPageHeader(); ?>
<?php
$document_log_list->showMessage();
?>
<?php if ($document_log_list->TotalRecs > 0 || $document_log->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($document_log_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> document_log">
<?php if (!$document_log->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$document_log->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($document_log_list->Pager)) $document_log_list->Pager = new NumericPager($document_log_list->StartRec, $document_log_list->DisplayRecs, $document_log_list->TotalRecs, $document_log_list->RecRange, $document_log_list->AutoHidePager) ?>
<?php if ($document_log_list->Pager->RecordCount > 0 && $document_log_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($document_log_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_list->pageUrl() ?>start=<?php echo $document_log_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($document_log_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_list->pageUrl() ?>start=<?php echo $document_log_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($document_log_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $document_log_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($document_log_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_list->pageUrl() ?>start=<?php echo $document_log_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($document_log_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_list->pageUrl() ?>start=<?php echo $document_log_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($document_log_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $document_log_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $document_log_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $document_log_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $document_log_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdocument_loglist" id="fdocument_loglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_log_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_log_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_log">
<div id="gmp_document_log" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($document_log_list->TotalRecs > 0 || $document_log->isGridEdit()) { ?>
<table id="tbl_document_loglist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$document_log_list->RowType = ROWTYPE_HEADER;

// Render list options
$document_log_list->renderListOptions();

// Render list options (header, left)
$document_log_list->ListOptions->render("header", "left");
?>
<?php if ($document_log->firelink_doc_no->Visible) { // firelink_doc_no ?>
	<?php if ($document_log->sortUrl($document_log->firelink_doc_no) == "") { ?>
		<th data-name="firelink_doc_no" class="<?php echo $document_log->firelink_doc_no->headerCellClass() ?>"><div id="elh_document_log_firelink_doc_no" class="document_log_firelink_doc_no"><div class="ew-table-header-caption"><?php echo $document_log->firelink_doc_no->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="firelink_doc_no" class="<?php echo $document_log->firelink_doc_no->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->firelink_doc_no) ?>',2);"><div id="elh_document_log_firelink_doc_no" class="document_log_firelink_doc_no">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->firelink_doc_no->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->firelink_doc_no->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->firelink_doc_no->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->client_doc_no->Visible) { // client_doc_no ?>
	<?php if ($document_log->sortUrl($document_log->client_doc_no) == "") { ?>
		<th data-name="client_doc_no" class="<?php echo $document_log->client_doc_no->headerCellClass() ?>"><div id="elh_document_log_client_doc_no" class="document_log_client_doc_no"><div class="ew-table-header-caption"><?php echo $document_log->client_doc_no->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="client_doc_no" class="<?php echo $document_log->client_doc_no->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->client_doc_no) ?>',2);"><div id="elh_document_log_client_doc_no" class="document_log_client_doc_no">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->client_doc_no->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->client_doc_no->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->client_doc_no->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->order_number->Visible) { // order_number ?>
	<?php if ($document_log->sortUrl($document_log->order_number) == "") { ?>
		<th data-name="order_number" class="<?php echo $document_log->order_number->headerCellClass() ?>"><div id="elh_document_log_order_number" class="document_log_order_number"><div class="ew-table-header-caption"><?php echo $document_log->order_number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="order_number" class="<?php echo $document_log->order_number->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->order_number) ?>',2);"><div id="elh_document_log_order_number" class="document_log_order_number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->order_number->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->order_number->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->order_number->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->project_name->Visible) { // project_name ?>
	<?php if ($document_log->sortUrl($document_log->project_name) == "") { ?>
		<th data-name="project_name" class="<?php echo $document_log->project_name->headerCellClass() ?>"><div id="elh_document_log_project_name" class="document_log_project_name"><div class="ew-table-header-caption"><?php echo $document_log->project_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="project_name" class="<?php echo $document_log->project_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->project_name) ?>',2);"><div id="elh_document_log_project_name" class="document_log_project_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->project_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->project_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->project_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->document_tittle->Visible) { // document_tittle ?>
	<?php if ($document_log->sortUrl($document_log->document_tittle) == "") { ?>
		<th data-name="document_tittle" class="<?php echo $document_log->document_tittle->headerCellClass() ?>"><div id="elh_document_log_document_tittle" class="document_log_document_tittle"><div class="ew-table-header-caption"><?php echo $document_log->document_tittle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="document_tittle" class="<?php echo $document_log->document_tittle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->document_tittle) ?>',2);"><div id="elh_document_log_document_tittle" class="document_log_document_tittle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->document_tittle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->document_tittle->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->document_tittle->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->current_status->Visible) { // current_status ?>
	<?php if ($document_log->sortUrl($document_log->current_status) == "") { ?>
		<th data-name="current_status" class="<?php echo $document_log->current_status->headerCellClass() ?>"><div id="elh_document_log_current_status" class="document_log_current_status"><div class="ew-table-header-caption"><?php echo $document_log->current_status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="current_status" class="<?php echo $document_log->current_status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->current_status) ?>',2);"><div id="elh_document_log_current_status" class="document_log_current_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->current_status->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->current_status->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->current_status->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub1->Visible) { // submit_no_sub1 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_sub1) == "") { ?>
		<th data-name="submit_no_sub1" class="<?php echo $document_log->submit_no_sub1->headerCellClass() ?>"><div id="elh_document_log_submit_no_sub1" class="document_log_submit_no_sub1"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_sub1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_sub1" class="<?php echo $document_log->submit_no_sub1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_sub1) ?>',2);"><div id="elh_document_log_submit_no_sub1" class="document_log_submit_no_sub1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_sub1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_sub1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_sub1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub1->Visible) { // revision_no_sub1 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_sub1) == "") { ?>
		<th data-name="revision_no_sub1" class="<?php echo $document_log->revision_no_sub1->headerCellClass() ?>"><div id="elh_document_log_revision_no_sub1" class="document_log_revision_no_sub1"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_sub1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_sub1" class="<?php echo $document_log->revision_no_sub1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_sub1) ?>',2);"><div id="elh_document_log_revision_no_sub1" class="document_log_revision_no_sub1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_sub1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_sub1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_sub1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub1->Visible) { // direction_out_sub1 ?>
	<?php if ($document_log->sortUrl($document_log->direction_out_sub1) == "") { ?>
		<th data-name="direction_out_sub1" class="<?php echo $document_log->direction_out_sub1->headerCellClass() ?>"><div id="elh_document_log_direction_out_sub1" class="document_log_direction_out_sub1"><div class="ew-table-header-caption"><?php echo $document_log->direction_out_sub1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_out_sub1" class="<?php echo $document_log->direction_out_sub1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_out_sub1) ?>',2);"><div id="elh_document_log_direction_out_sub1" class="document_log_direction_out_sub1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_out_sub1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_out_sub1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_out_sub1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub1->Visible) { // planned_date_out_sub1 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_out_sub1) == "") { ?>
		<th data-name="planned_date_out_sub1" class="<?php echo $document_log->planned_date_out_sub1->headerCellClass() ?>"><div id="elh_document_log_planned_date_out_sub1" class="document_log_planned_date_out_sub1"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_out_sub1" class="<?php echo $document_log->planned_date_out_sub1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_out_sub1) ?>',2);"><div id="elh_document_log_planned_date_out_sub1" class="document_log_planned_date_out_sub1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub1->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_out_sub1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_out_sub1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub1->Visible) { // transmit_date_out_sub1 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_out_sub1) == "") { ?>
		<th data-name="transmit_date_out_sub1" class="<?php echo $document_log->transmit_date_out_sub1->headerCellClass() ?>"><div id="elh_document_log_transmit_date_out_sub1" class="document_log_transmit_date_out_sub1"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_out_sub1" class="<?php echo $document_log->transmit_date_out_sub1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_out_sub1) ?>',2);"><div id="elh_document_log_transmit_date_out_sub1" class="document_log_transmit_date_out_sub1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub1->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_out_sub1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_out_sub1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub1->Visible) { // transmit_no_out_sub1 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_out_sub1) == "") { ?>
		<th data-name="transmit_no_out_sub1" class="<?php echo $document_log->transmit_no_out_sub1->headerCellClass() ?>"><div id="elh_document_log_transmit_no_out_sub1" class="document_log_transmit_no_out_sub1"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_out_sub1" class="<?php echo $document_log->transmit_no_out_sub1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_out_sub1) ?>',2);"><div id="elh_document_log_transmit_no_out_sub1" class="document_log_transmit_no_out_sub1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_out_sub1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_out_sub1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub1->Visible) { // approval_status_out_sub1 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_out_sub1) == "") { ?>
		<th data-name="approval_status_out_sub1" class="<?php echo $document_log->approval_status_out_sub1->headerCellClass() ?>"><div id="elh_document_log_approval_status_out_sub1" class="document_log_approval_status_out_sub1"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_out_sub1" class="<?php echo $document_log->approval_status_out_sub1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_out_sub1) ?>',2);"><div id="elh_document_log_approval_status_out_sub1" class="document_log_approval_status_out_sub1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_out_sub1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_out_sub1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub1->Visible) { // direction_in_sub1 ?>
	<?php if ($document_log->sortUrl($document_log->direction_in_sub1) == "") { ?>
		<th data-name="direction_in_sub1" class="<?php echo $document_log->direction_in_sub1->headerCellClass() ?>"><div id="elh_document_log_direction_in_sub1" class="document_log_direction_in_sub1"><div class="ew-table-header-caption"><?php echo $document_log->direction_in_sub1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_in_sub1" class="<?php echo $document_log->direction_in_sub1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_in_sub1) ?>',2);"><div id="elh_document_log_direction_in_sub1" class="document_log_direction_in_sub1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_in_sub1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_in_sub1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_in_sub1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub1->Visible) { // transmit_no_in_sub1 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_in_sub1) == "") { ?>
		<th data-name="transmit_no_in_sub1" class="<?php echo $document_log->transmit_no_in_sub1->headerCellClass() ?>"><div id="elh_document_log_transmit_no_in_sub1" class="document_log_transmit_no_in_sub1"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_in_sub1" class="<?php echo $document_log->transmit_no_in_sub1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_in_sub1) ?>',2);"><div id="elh_document_log_transmit_no_in_sub1" class="document_log_transmit_no_in_sub1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_in_sub1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_in_sub1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub1->Visible) { // approval_status_in_sub1 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_in_sub1) == "") { ?>
		<th data-name="approval_status_in_sub1" class="<?php echo $document_log->approval_status_in_sub1->headerCellClass() ?>"><div id="elh_document_log_approval_status_in_sub1" class="document_log_approval_status_in_sub1"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_in_sub1" class="<?php echo $document_log->approval_status_in_sub1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_in_sub1) ?>',2);"><div id="elh_document_log_approval_status_in_sub1" class="document_log_approval_status_in_sub1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_in_sub1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_in_sub1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub1->Visible) { // transmit_date_in_sub1 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_in_sub1) == "") { ?>
		<th data-name="transmit_date_in_sub1" class="<?php echo $document_log->transmit_date_in_sub1->headerCellClass() ?>"><div id="elh_document_log_transmit_date_in_sub1" class="document_log_transmit_date_in_sub1"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_in_sub1" class="<?php echo $document_log->transmit_date_in_sub1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_in_sub1) ?>',2);"><div id="elh_document_log_transmit_date_in_sub1" class="document_log_transmit_date_in_sub1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub1->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_in_sub1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_in_sub1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub2->Visible) { // submit_no_sub2 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_sub2) == "") { ?>
		<th data-name="submit_no_sub2" class="<?php echo $document_log->submit_no_sub2->headerCellClass() ?>"><div id="elh_document_log_submit_no_sub2" class="document_log_submit_no_sub2"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_sub2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_sub2" class="<?php echo $document_log->submit_no_sub2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_sub2) ?>',2);"><div id="elh_document_log_submit_no_sub2" class="document_log_submit_no_sub2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_sub2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_sub2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_sub2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub2->Visible) { // revision_no_sub2 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_sub2) == "") { ?>
		<th data-name="revision_no_sub2" class="<?php echo $document_log->revision_no_sub2->headerCellClass() ?>"><div id="elh_document_log_revision_no_sub2" class="document_log_revision_no_sub2"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_sub2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_sub2" class="<?php echo $document_log->revision_no_sub2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_sub2) ?>',2);"><div id="elh_document_log_revision_no_sub2" class="document_log_revision_no_sub2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_sub2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_sub2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_sub2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub2->Visible) { // direction_out_sub2 ?>
	<?php if ($document_log->sortUrl($document_log->direction_out_sub2) == "") { ?>
		<th data-name="direction_out_sub2" class="<?php echo $document_log->direction_out_sub2->headerCellClass() ?>"><div id="elh_document_log_direction_out_sub2" class="document_log_direction_out_sub2"><div class="ew-table-header-caption"><?php echo $document_log->direction_out_sub2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_out_sub2" class="<?php echo $document_log->direction_out_sub2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_out_sub2) ?>',2);"><div id="elh_document_log_direction_out_sub2" class="document_log_direction_out_sub2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_out_sub2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_out_sub2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_out_sub2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub2->Visible) { // planned_date_out_sub2 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_out_sub2) == "") { ?>
		<th data-name="planned_date_out_sub2" class="<?php echo $document_log->planned_date_out_sub2->headerCellClass() ?>"><div id="elh_document_log_planned_date_out_sub2" class="document_log_planned_date_out_sub2"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_out_sub2" class="<?php echo $document_log->planned_date_out_sub2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_out_sub2) ?>',2);"><div id="elh_document_log_planned_date_out_sub2" class="document_log_planned_date_out_sub2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub2->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_out_sub2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_out_sub2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub2->Visible) { // transmit_date_out_sub2 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_out_sub2) == "") { ?>
		<th data-name="transmit_date_out_sub2" class="<?php echo $document_log->transmit_date_out_sub2->headerCellClass() ?>"><div id="elh_document_log_transmit_date_out_sub2" class="document_log_transmit_date_out_sub2"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_out_sub2" class="<?php echo $document_log->transmit_date_out_sub2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_out_sub2) ?>',2);"><div id="elh_document_log_transmit_date_out_sub2" class="document_log_transmit_date_out_sub2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub2->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_out_sub2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_out_sub2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub2->Visible) { // transmit_no_out_sub2 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_out_sub2) == "") { ?>
		<th data-name="transmit_no_out_sub2" class="<?php echo $document_log->transmit_no_out_sub2->headerCellClass() ?>"><div id="elh_document_log_transmit_no_out_sub2" class="document_log_transmit_no_out_sub2"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_out_sub2" class="<?php echo $document_log->transmit_no_out_sub2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_out_sub2) ?>',2);"><div id="elh_document_log_transmit_no_out_sub2" class="document_log_transmit_no_out_sub2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_out_sub2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_out_sub2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub2->Visible) { // approval_status_out_sub2 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_out_sub2) == "") { ?>
		<th data-name="approval_status_out_sub2" class="<?php echo $document_log->approval_status_out_sub2->headerCellClass() ?>"><div id="elh_document_log_approval_status_out_sub2" class="document_log_approval_status_out_sub2"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_out_sub2" class="<?php echo $document_log->approval_status_out_sub2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_out_sub2) ?>',2);"><div id="elh_document_log_approval_status_out_sub2" class="document_log_approval_status_out_sub2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_out_sub2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_out_sub2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub2->Visible) { // direction_in_sub2 ?>
	<?php if ($document_log->sortUrl($document_log->direction_in_sub2) == "") { ?>
		<th data-name="direction_in_sub2" class="<?php echo $document_log->direction_in_sub2->headerCellClass() ?>"><div id="elh_document_log_direction_in_sub2" class="document_log_direction_in_sub2"><div class="ew-table-header-caption"><?php echo $document_log->direction_in_sub2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_in_sub2" class="<?php echo $document_log->direction_in_sub2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_in_sub2) ?>',2);"><div id="elh_document_log_direction_in_sub2" class="document_log_direction_in_sub2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_in_sub2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_in_sub2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_in_sub2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub2->Visible) { // transmit_no_in_sub2 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_in_sub2) == "") { ?>
		<th data-name="transmit_no_in_sub2" class="<?php echo $document_log->transmit_no_in_sub2->headerCellClass() ?>"><div id="elh_document_log_transmit_no_in_sub2" class="document_log_transmit_no_in_sub2"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_in_sub2" class="<?php echo $document_log->transmit_no_in_sub2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_in_sub2) ?>',2);"><div id="elh_document_log_transmit_no_in_sub2" class="document_log_transmit_no_in_sub2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_in_sub2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_in_sub2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub2->Visible) { // approval_status_in_sub2 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_in_sub2) == "") { ?>
		<th data-name="approval_status_in_sub2" class="<?php echo $document_log->approval_status_in_sub2->headerCellClass() ?>"><div id="elh_document_log_approval_status_in_sub2" class="document_log_approval_status_in_sub2"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_in_sub2" class="<?php echo $document_log->approval_status_in_sub2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_in_sub2) ?>',2);"><div id="elh_document_log_approval_status_in_sub2" class="document_log_approval_status_in_sub2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_in_sub2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_in_sub2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub2->Visible) { // transmit_date_in_sub2 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_in_sub2) == "") { ?>
		<th data-name="transmit_date_in_sub2" class="<?php echo $document_log->transmit_date_in_sub2->headerCellClass() ?>"><div id="elh_document_log_transmit_date_in_sub2" class="document_log_transmit_date_in_sub2"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_in_sub2" class="<?php echo $document_log->transmit_date_in_sub2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_in_sub2) ?>',2);"><div id="elh_document_log_transmit_date_in_sub2" class="document_log_transmit_date_in_sub2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub2->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_in_sub2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_in_sub2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub3->Visible) { // submit_no_sub3 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_sub3) == "") { ?>
		<th data-name="submit_no_sub3" class="<?php echo $document_log->submit_no_sub3->headerCellClass() ?>"><div id="elh_document_log_submit_no_sub3" class="document_log_submit_no_sub3"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_sub3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_sub3" class="<?php echo $document_log->submit_no_sub3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_sub3) ?>',2);"><div id="elh_document_log_submit_no_sub3" class="document_log_submit_no_sub3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_sub3->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_sub3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_sub3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub3->Visible) { // revision_no_sub3 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_sub3) == "") { ?>
		<th data-name="revision_no_sub3" class="<?php echo $document_log->revision_no_sub3->headerCellClass() ?>"><div id="elh_document_log_revision_no_sub3" class="document_log_revision_no_sub3"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_sub3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_sub3" class="<?php echo $document_log->revision_no_sub3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_sub3) ?>',2);"><div id="elh_document_log_revision_no_sub3" class="document_log_revision_no_sub3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_sub3->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_sub3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_sub3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub3->Visible) { // direction_out_sub3 ?>
	<?php if ($document_log->sortUrl($document_log->direction_out_sub3) == "") { ?>
		<th data-name="direction_out_sub3" class="<?php echo $document_log->direction_out_sub3->headerCellClass() ?>"><div id="elh_document_log_direction_out_sub3" class="document_log_direction_out_sub3"><div class="ew-table-header-caption"><?php echo $document_log->direction_out_sub3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_out_sub3" class="<?php echo $document_log->direction_out_sub3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_out_sub3) ?>',2);"><div id="elh_document_log_direction_out_sub3" class="document_log_direction_out_sub3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_out_sub3->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_out_sub3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_out_sub3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub3->Visible) { // planned_date_out_sub3 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_out_sub3) == "") { ?>
		<th data-name="planned_date_out_sub3" class="<?php echo $document_log->planned_date_out_sub3->headerCellClass() ?>"><div id="elh_document_log_planned_date_out_sub3" class="document_log_planned_date_out_sub3"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_out_sub3" class="<?php echo $document_log->planned_date_out_sub3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_out_sub3) ?>',2);"><div id="elh_document_log_planned_date_out_sub3" class="document_log_planned_date_out_sub3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub3->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_out_sub3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_out_sub3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub3->Visible) { // transmit_date_out_sub3 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_out_sub3) == "") { ?>
		<th data-name="transmit_date_out_sub3" class="<?php echo $document_log->transmit_date_out_sub3->headerCellClass() ?>"><div id="elh_document_log_transmit_date_out_sub3" class="document_log_transmit_date_out_sub3"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_out_sub3" class="<?php echo $document_log->transmit_date_out_sub3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_out_sub3) ?>',2);"><div id="elh_document_log_transmit_date_out_sub3" class="document_log_transmit_date_out_sub3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub3->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_out_sub3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_out_sub3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub3->Visible) { // transmit_no_out_sub3 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_out_sub3) == "") { ?>
		<th data-name="transmit_no_out_sub3" class="<?php echo $document_log->transmit_no_out_sub3->headerCellClass() ?>"><div id="elh_document_log_transmit_no_out_sub3" class="document_log_transmit_no_out_sub3"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_out_sub3" class="<?php echo $document_log->transmit_no_out_sub3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_out_sub3) ?>',2);"><div id="elh_document_log_transmit_no_out_sub3" class="document_log_transmit_no_out_sub3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub3->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_out_sub3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_out_sub3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub3->Visible) { // approval_status_out_sub3 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_out_sub3) == "") { ?>
		<th data-name="approval_status_out_sub3" class="<?php echo $document_log->approval_status_out_sub3->headerCellClass() ?>"><div id="elh_document_log_approval_status_out_sub3" class="document_log_approval_status_out_sub3"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_out_sub3" class="<?php echo $document_log->approval_status_out_sub3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_out_sub3) ?>',2);"><div id="elh_document_log_approval_status_out_sub3" class="document_log_approval_status_out_sub3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub3->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_out_sub3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_out_sub3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub3->Visible) { // direction_in_sub3 ?>
	<?php if ($document_log->sortUrl($document_log->direction_in_sub3) == "") { ?>
		<th data-name="direction_in_sub3" class="<?php echo $document_log->direction_in_sub3->headerCellClass() ?>"><div id="elh_document_log_direction_in_sub3" class="document_log_direction_in_sub3"><div class="ew-table-header-caption"><?php echo $document_log->direction_in_sub3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_in_sub3" class="<?php echo $document_log->direction_in_sub3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_in_sub3) ?>',2);"><div id="elh_document_log_direction_in_sub3" class="document_log_direction_in_sub3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_in_sub3->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_in_sub3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_in_sub3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub3->Visible) { // transmit_no_in_sub3 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_in_sub3) == "") { ?>
		<th data-name="transmit_no_in_sub3" class="<?php echo $document_log->transmit_no_in_sub3->headerCellClass() ?>"><div id="elh_document_log_transmit_no_in_sub3" class="document_log_transmit_no_in_sub3"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_in_sub3" class="<?php echo $document_log->transmit_no_in_sub3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_in_sub3) ?>',2);"><div id="elh_document_log_transmit_no_in_sub3" class="document_log_transmit_no_in_sub3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub3->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_in_sub3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_in_sub3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub3->Visible) { // approval_status_in_sub3 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_in_sub3) == "") { ?>
		<th data-name="approval_status_in_sub3" class="<?php echo $document_log->approval_status_in_sub3->headerCellClass() ?>"><div id="elh_document_log_approval_status_in_sub3" class="document_log_approval_status_in_sub3"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_in_sub3" class="<?php echo $document_log->approval_status_in_sub3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_in_sub3) ?>',2);"><div id="elh_document_log_approval_status_in_sub3" class="document_log_approval_status_in_sub3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub3->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_in_sub3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_in_sub3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub3->Visible) { // transmit_date_in_sub3 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_in_sub3) == "") { ?>
		<th data-name="transmit_date_in_sub3" class="<?php echo $document_log->transmit_date_in_sub3->headerCellClass() ?>"><div id="elh_document_log_transmit_date_in_sub3" class="document_log_transmit_date_in_sub3"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_in_sub3" class="<?php echo $document_log->transmit_date_in_sub3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_in_sub3) ?>',2);"><div id="elh_document_log_transmit_date_in_sub3" class="document_log_transmit_date_in_sub3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub3->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_in_sub3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_in_sub3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub4->Visible) { // submit_no_sub4 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_sub4) == "") { ?>
		<th data-name="submit_no_sub4" class="<?php echo $document_log->submit_no_sub4->headerCellClass() ?>"><div id="elh_document_log_submit_no_sub4" class="document_log_submit_no_sub4"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_sub4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_sub4" class="<?php echo $document_log->submit_no_sub4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_sub4) ?>',2);"><div id="elh_document_log_submit_no_sub4" class="document_log_submit_no_sub4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_sub4->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_sub4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_sub4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub4->Visible) { // revision_no_sub4 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_sub4) == "") { ?>
		<th data-name="revision_no_sub4" class="<?php echo $document_log->revision_no_sub4->headerCellClass() ?>"><div id="elh_document_log_revision_no_sub4" class="document_log_revision_no_sub4"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_sub4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_sub4" class="<?php echo $document_log->revision_no_sub4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_sub4) ?>',2);"><div id="elh_document_log_revision_no_sub4" class="document_log_revision_no_sub4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_sub4->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_sub4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_sub4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub4->Visible) { // direction_out_sub4 ?>
	<?php if ($document_log->sortUrl($document_log->direction_out_sub4) == "") { ?>
		<th data-name="direction_out_sub4" class="<?php echo $document_log->direction_out_sub4->headerCellClass() ?>"><div id="elh_document_log_direction_out_sub4" class="document_log_direction_out_sub4"><div class="ew-table-header-caption"><?php echo $document_log->direction_out_sub4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_out_sub4" class="<?php echo $document_log->direction_out_sub4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_out_sub4) ?>',2);"><div id="elh_document_log_direction_out_sub4" class="document_log_direction_out_sub4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_out_sub4->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_out_sub4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_out_sub4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub4->Visible) { // planned_date_out_sub4 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_out_sub4) == "") { ?>
		<th data-name="planned_date_out_sub4" class="<?php echo $document_log->planned_date_out_sub4->headerCellClass() ?>"><div id="elh_document_log_planned_date_out_sub4" class="document_log_planned_date_out_sub4"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_out_sub4" class="<?php echo $document_log->planned_date_out_sub4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_out_sub4) ?>',2);"><div id="elh_document_log_planned_date_out_sub4" class="document_log_planned_date_out_sub4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub4->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_out_sub4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_out_sub4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub4->Visible) { // transmit_date_out_sub4 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_out_sub4) == "") { ?>
		<th data-name="transmit_date_out_sub4" class="<?php echo $document_log->transmit_date_out_sub4->headerCellClass() ?>"><div id="elh_document_log_transmit_date_out_sub4" class="document_log_transmit_date_out_sub4"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_out_sub4" class="<?php echo $document_log->transmit_date_out_sub4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_out_sub4) ?>',2);"><div id="elh_document_log_transmit_date_out_sub4" class="document_log_transmit_date_out_sub4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub4->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_out_sub4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_out_sub4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub4->Visible) { // transmit_no_out_sub4 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_out_sub4) == "") { ?>
		<th data-name="transmit_no_out_sub4" class="<?php echo $document_log->transmit_no_out_sub4->headerCellClass() ?>"><div id="elh_document_log_transmit_no_out_sub4" class="document_log_transmit_no_out_sub4"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_out_sub4" class="<?php echo $document_log->transmit_no_out_sub4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_out_sub4) ?>',2);"><div id="elh_document_log_transmit_no_out_sub4" class="document_log_transmit_no_out_sub4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub4->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_out_sub4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_out_sub4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub4->Visible) { // approval_status_out_sub4 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_out_sub4) == "") { ?>
		<th data-name="approval_status_out_sub4" class="<?php echo $document_log->approval_status_out_sub4->headerCellClass() ?>"><div id="elh_document_log_approval_status_out_sub4" class="document_log_approval_status_out_sub4"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_out_sub4" class="<?php echo $document_log->approval_status_out_sub4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_out_sub4) ?>',2);"><div id="elh_document_log_approval_status_out_sub4" class="document_log_approval_status_out_sub4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub4->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_out_sub4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_out_sub4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub4->Visible) { // direction_in_sub4 ?>
	<?php if ($document_log->sortUrl($document_log->direction_in_sub4) == "") { ?>
		<th data-name="direction_in_sub4" class="<?php echo $document_log->direction_in_sub4->headerCellClass() ?>"><div id="elh_document_log_direction_in_sub4" class="document_log_direction_in_sub4"><div class="ew-table-header-caption"><?php echo $document_log->direction_in_sub4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_in_sub4" class="<?php echo $document_log->direction_in_sub4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_in_sub4) ?>',2);"><div id="elh_document_log_direction_in_sub4" class="document_log_direction_in_sub4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_in_sub4->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_in_sub4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_in_sub4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub4->Visible) { // transmit_no_in_sub4 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_in_sub4) == "") { ?>
		<th data-name="transmit_no_in_sub4" class="<?php echo $document_log->transmit_no_in_sub4->headerCellClass() ?>"><div id="elh_document_log_transmit_no_in_sub4" class="document_log_transmit_no_in_sub4"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_in_sub4" class="<?php echo $document_log->transmit_no_in_sub4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_in_sub4) ?>',2);"><div id="elh_document_log_transmit_no_in_sub4" class="document_log_transmit_no_in_sub4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub4->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_in_sub4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_in_sub4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub4->Visible) { // approval_status_in_sub4 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_in_sub4) == "") { ?>
		<th data-name="approval_status_in_sub4" class="<?php echo $document_log->approval_status_in_sub4->headerCellClass() ?>"><div id="elh_document_log_approval_status_in_sub4" class="document_log_approval_status_in_sub4"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_in_sub4" class="<?php echo $document_log->approval_status_in_sub4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_in_sub4) ?>',2);"><div id="elh_document_log_approval_status_in_sub4" class="document_log_approval_status_in_sub4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub4->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_in_sub4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_in_sub4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_file_sub4->Visible) { // direction_in_file_sub4 ?>
	<?php if ($document_log->sortUrl($document_log->direction_in_file_sub4) == "") { ?>
		<th data-name="direction_in_file_sub4" class="<?php echo $document_log->direction_in_file_sub4->headerCellClass() ?>"><div id="elh_document_log_direction_in_file_sub4" class="document_log_direction_in_file_sub4"><div class="ew-table-header-caption"><?php echo $document_log->direction_in_file_sub4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_in_file_sub4" class="<?php echo $document_log->direction_in_file_sub4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_in_file_sub4) ?>',2);"><div id="elh_document_log_direction_in_file_sub4" class="document_log_direction_in_file_sub4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_in_file_sub4->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_in_file_sub4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_in_file_sub4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub4->Visible) { // transmit_date_in_sub4 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_in_sub4) == "") { ?>
		<th data-name="transmit_date_in_sub4" class="<?php echo $document_log->transmit_date_in_sub4->headerCellClass() ?>"><div id="elh_document_log_transmit_date_in_sub4" class="document_log_transmit_date_in_sub4"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_in_sub4" class="<?php echo $document_log->transmit_date_in_sub4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_in_sub4) ?>',2);"><div id="elh_document_log_transmit_date_in_sub4" class="document_log_transmit_date_in_sub4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub4->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_in_sub4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_in_sub4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub5->Visible) { // submit_no_sub5 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_sub5) == "") { ?>
		<th data-name="submit_no_sub5" class="<?php echo $document_log->submit_no_sub5->headerCellClass() ?>"><div id="elh_document_log_submit_no_sub5" class="document_log_submit_no_sub5"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_sub5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_sub5" class="<?php echo $document_log->submit_no_sub5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_sub5) ?>',2);"><div id="elh_document_log_submit_no_sub5" class="document_log_submit_no_sub5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_sub5->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_sub5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_sub5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub5->Visible) { // revision_no_sub5 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_sub5) == "") { ?>
		<th data-name="revision_no_sub5" class="<?php echo $document_log->revision_no_sub5->headerCellClass() ?>"><div id="elh_document_log_revision_no_sub5" class="document_log_revision_no_sub5"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_sub5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_sub5" class="<?php echo $document_log->revision_no_sub5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_sub5) ?>',2);"><div id="elh_document_log_revision_no_sub5" class="document_log_revision_no_sub5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_sub5->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_sub5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_sub5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub5->Visible) { // direction_out_sub5 ?>
	<?php if ($document_log->sortUrl($document_log->direction_out_sub5) == "") { ?>
		<th data-name="direction_out_sub5" class="<?php echo $document_log->direction_out_sub5->headerCellClass() ?>"><div id="elh_document_log_direction_out_sub5" class="document_log_direction_out_sub5"><div class="ew-table-header-caption"><?php echo $document_log->direction_out_sub5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_out_sub5" class="<?php echo $document_log->direction_out_sub5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_out_sub5) ?>',2);"><div id="elh_document_log_direction_out_sub5" class="document_log_direction_out_sub5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_out_sub5->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_out_sub5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_out_sub5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub5->Visible) { // planned_date_out_sub5 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_out_sub5) == "") { ?>
		<th data-name="planned_date_out_sub5" class="<?php echo $document_log->planned_date_out_sub5->headerCellClass() ?>"><div id="elh_document_log_planned_date_out_sub5" class="document_log_planned_date_out_sub5"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_out_sub5" class="<?php echo $document_log->planned_date_out_sub5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_out_sub5) ?>',2);"><div id="elh_document_log_planned_date_out_sub5" class="document_log_planned_date_out_sub5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub5->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_out_sub5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_out_sub5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub5->Visible) { // transmit_date_out_sub5 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_out_sub5) == "") { ?>
		<th data-name="transmit_date_out_sub5" class="<?php echo $document_log->transmit_date_out_sub5->headerCellClass() ?>"><div id="elh_document_log_transmit_date_out_sub5" class="document_log_transmit_date_out_sub5"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_out_sub5" class="<?php echo $document_log->transmit_date_out_sub5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_out_sub5) ?>',2);"><div id="elh_document_log_transmit_date_out_sub5" class="document_log_transmit_date_out_sub5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub5->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_out_sub5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_out_sub5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub5->Visible) { // transmit_no_out_sub5 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_out_sub5) == "") { ?>
		<th data-name="transmit_no_out_sub5" class="<?php echo $document_log->transmit_no_out_sub5->headerCellClass() ?>"><div id="elh_document_log_transmit_no_out_sub5" class="document_log_transmit_no_out_sub5"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_out_sub5" class="<?php echo $document_log->transmit_no_out_sub5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_out_sub5) ?>',2);"><div id="elh_document_log_transmit_no_out_sub5" class="document_log_transmit_no_out_sub5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub5->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_out_sub5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_out_sub5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub5->Visible) { // approval_status_out_sub5 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_out_sub5) == "") { ?>
		<th data-name="approval_status_out_sub5" class="<?php echo $document_log->approval_status_out_sub5->headerCellClass() ?>"><div id="elh_document_log_approval_status_out_sub5" class="document_log_approval_status_out_sub5"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_out_sub5" class="<?php echo $document_log->approval_status_out_sub5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_out_sub5) ?>',2);"><div id="elh_document_log_approval_status_out_sub5" class="document_log_approval_status_out_sub5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub5->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_out_sub5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_out_sub5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub5->Visible) { // direction_in_sub5 ?>
	<?php if ($document_log->sortUrl($document_log->direction_in_sub5) == "") { ?>
		<th data-name="direction_in_sub5" class="<?php echo $document_log->direction_in_sub5->headerCellClass() ?>"><div id="elh_document_log_direction_in_sub5" class="document_log_direction_in_sub5"><div class="ew-table-header-caption"><?php echo $document_log->direction_in_sub5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_in_sub5" class="<?php echo $document_log->direction_in_sub5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_in_sub5) ?>',2);"><div id="elh_document_log_direction_in_sub5" class="document_log_direction_in_sub5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_in_sub5->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_in_sub5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_in_sub5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub5->Visible) { // transmit_no_in_sub5 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_in_sub5) == "") { ?>
		<th data-name="transmit_no_in_sub5" class="<?php echo $document_log->transmit_no_in_sub5->headerCellClass() ?>"><div id="elh_document_log_transmit_no_in_sub5" class="document_log_transmit_no_in_sub5"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_in_sub5" class="<?php echo $document_log->transmit_no_in_sub5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_in_sub5) ?>',2);"><div id="elh_document_log_transmit_no_in_sub5" class="document_log_transmit_no_in_sub5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub5->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_in_sub5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_in_sub5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub5->Visible) { // approval_status_in_sub5 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_in_sub5) == "") { ?>
		<th data-name="approval_status_in_sub5" class="<?php echo $document_log->approval_status_in_sub5->headerCellClass() ?>"><div id="elh_document_log_approval_status_in_sub5" class="document_log_approval_status_in_sub5"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_in_sub5" class="<?php echo $document_log->approval_status_in_sub5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_in_sub5) ?>',2);"><div id="elh_document_log_approval_status_in_sub5" class="document_log_approval_status_in_sub5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub5->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_in_sub5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_in_sub5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_file_sub5->Visible) { // direction_in_file_sub5 ?>
	<?php if ($document_log->sortUrl($document_log->direction_in_file_sub5) == "") { ?>
		<th data-name="direction_in_file_sub5" class="<?php echo $document_log->direction_in_file_sub5->headerCellClass() ?>"><div id="elh_document_log_direction_in_file_sub5" class="document_log_direction_in_file_sub5"><div class="ew-table-header-caption"><?php echo $document_log->direction_in_file_sub5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_in_file_sub5" class="<?php echo $document_log->direction_in_file_sub5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_in_file_sub5) ?>',2);"><div id="elh_document_log_direction_in_file_sub5" class="document_log_direction_in_file_sub5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_in_file_sub5->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_in_file_sub5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_in_file_sub5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub5->Visible) { // transmit_date_in_sub5 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_in_sub5) == "") { ?>
		<th data-name="transmit_date_in_sub5" class="<?php echo $document_log->transmit_date_in_sub5->headerCellClass() ?>"><div id="elh_document_log_transmit_date_in_sub5" class="document_log_transmit_date_in_sub5"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_in_sub5" class="<?php echo $document_log->transmit_date_in_sub5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_in_sub5) ?>',2);"><div id="elh_document_log_transmit_date_in_sub5" class="document_log_transmit_date_in_sub5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub5->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_in_sub5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_in_sub5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub6->Visible) { // submit_no_sub6 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_sub6) == "") { ?>
		<th data-name="submit_no_sub6" class="<?php echo $document_log->submit_no_sub6->headerCellClass() ?>"><div id="elh_document_log_submit_no_sub6" class="document_log_submit_no_sub6"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_sub6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_sub6" class="<?php echo $document_log->submit_no_sub6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_sub6) ?>',2);"><div id="elh_document_log_submit_no_sub6" class="document_log_submit_no_sub6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_sub6->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_sub6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_sub6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub6->Visible) { // revision_no_sub6 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_sub6) == "") { ?>
		<th data-name="revision_no_sub6" class="<?php echo $document_log->revision_no_sub6->headerCellClass() ?>"><div id="elh_document_log_revision_no_sub6" class="document_log_revision_no_sub6"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_sub6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_sub6" class="<?php echo $document_log->revision_no_sub6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_sub6) ?>',2);"><div id="elh_document_log_revision_no_sub6" class="document_log_revision_no_sub6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_sub6->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_sub6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_sub6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub6->Visible) { // direction_out_sub6 ?>
	<?php if ($document_log->sortUrl($document_log->direction_out_sub6) == "") { ?>
		<th data-name="direction_out_sub6" class="<?php echo $document_log->direction_out_sub6->headerCellClass() ?>"><div id="elh_document_log_direction_out_sub6" class="document_log_direction_out_sub6"><div class="ew-table-header-caption"><?php echo $document_log->direction_out_sub6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_out_sub6" class="<?php echo $document_log->direction_out_sub6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_out_sub6) ?>',2);"><div id="elh_document_log_direction_out_sub6" class="document_log_direction_out_sub6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_out_sub6->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_out_sub6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_out_sub6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub6->Visible) { // planned_date_out_sub6 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_out_sub6) == "") { ?>
		<th data-name="planned_date_out_sub6" class="<?php echo $document_log->planned_date_out_sub6->headerCellClass() ?>"><div id="elh_document_log_planned_date_out_sub6" class="document_log_planned_date_out_sub6"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_out_sub6" class="<?php echo $document_log->planned_date_out_sub6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_out_sub6) ?>',2);"><div id="elh_document_log_planned_date_out_sub6" class="document_log_planned_date_out_sub6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub6->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_out_sub6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_out_sub6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub6->Visible) { // transmit_date_out_sub6 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_out_sub6) == "") { ?>
		<th data-name="transmit_date_out_sub6" class="<?php echo $document_log->transmit_date_out_sub6->headerCellClass() ?>"><div id="elh_document_log_transmit_date_out_sub6" class="document_log_transmit_date_out_sub6"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_out_sub6" class="<?php echo $document_log->transmit_date_out_sub6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_out_sub6) ?>',2);"><div id="elh_document_log_transmit_date_out_sub6" class="document_log_transmit_date_out_sub6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub6->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_out_sub6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_out_sub6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub6->Visible) { // transmit_no_out_sub6 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_out_sub6) == "") { ?>
		<th data-name="transmit_no_out_sub6" class="<?php echo $document_log->transmit_no_out_sub6->headerCellClass() ?>"><div id="elh_document_log_transmit_no_out_sub6" class="document_log_transmit_no_out_sub6"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_out_sub6" class="<?php echo $document_log->transmit_no_out_sub6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_out_sub6) ?>',2);"><div id="elh_document_log_transmit_no_out_sub6" class="document_log_transmit_no_out_sub6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub6->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_out_sub6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_out_sub6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub6->Visible) { // approval_status_out_sub6 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_out_sub6) == "") { ?>
		<th data-name="approval_status_out_sub6" class="<?php echo $document_log->approval_status_out_sub6->headerCellClass() ?>"><div id="elh_document_log_approval_status_out_sub6" class="document_log_approval_status_out_sub6"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_out_sub6" class="<?php echo $document_log->approval_status_out_sub6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_out_sub6) ?>',2);"><div id="elh_document_log_approval_status_out_sub6" class="document_log_approval_status_out_sub6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub6->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_out_sub6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_out_sub6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub6->Visible) { // direction_in_sub6 ?>
	<?php if ($document_log->sortUrl($document_log->direction_in_sub6) == "") { ?>
		<th data-name="direction_in_sub6" class="<?php echo $document_log->direction_in_sub6->headerCellClass() ?>"><div id="elh_document_log_direction_in_sub6" class="document_log_direction_in_sub6"><div class="ew-table-header-caption"><?php echo $document_log->direction_in_sub6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_in_sub6" class="<?php echo $document_log->direction_in_sub6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_in_sub6) ?>',2);"><div id="elh_document_log_direction_in_sub6" class="document_log_direction_in_sub6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_in_sub6->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_in_sub6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_in_sub6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub6->Visible) { // transmit_no_in_sub6 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_in_sub6) == "") { ?>
		<th data-name="transmit_no_in_sub6" class="<?php echo $document_log->transmit_no_in_sub6->headerCellClass() ?>"><div id="elh_document_log_transmit_no_in_sub6" class="document_log_transmit_no_in_sub6"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_in_sub6" class="<?php echo $document_log->transmit_no_in_sub6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_in_sub6) ?>',2);"><div id="elh_document_log_transmit_no_in_sub6" class="document_log_transmit_no_in_sub6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub6->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_in_sub6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_in_sub6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub6->Visible) { // approval_status_in_sub6 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_in_sub6) == "") { ?>
		<th data-name="approval_status_in_sub6" class="<?php echo $document_log->approval_status_in_sub6->headerCellClass() ?>"><div id="elh_document_log_approval_status_in_sub6" class="document_log_approval_status_in_sub6"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_in_sub6" class="<?php echo $document_log->approval_status_in_sub6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_in_sub6) ?>',2);"><div id="elh_document_log_approval_status_in_sub6" class="document_log_approval_status_in_sub6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub6->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_in_sub6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_in_sub6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_file_sub6->Visible) { // direction_in_file_sub6 ?>
	<?php if ($document_log->sortUrl($document_log->direction_in_file_sub6) == "") { ?>
		<th data-name="direction_in_file_sub6" class="<?php echo $document_log->direction_in_file_sub6->headerCellClass() ?>"><div id="elh_document_log_direction_in_file_sub6" class="document_log_direction_in_file_sub6"><div class="ew-table-header-caption"><?php echo $document_log->direction_in_file_sub6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_in_file_sub6" class="<?php echo $document_log->direction_in_file_sub6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_in_file_sub6) ?>',2);"><div id="elh_document_log_direction_in_file_sub6" class="document_log_direction_in_file_sub6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_in_file_sub6->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_in_file_sub6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_in_file_sub6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub6->Visible) { // transmit_date_in_sub6 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_in_sub6) == "") { ?>
		<th data-name="transmit_date_in_sub6" class="<?php echo $document_log->transmit_date_in_sub6->headerCellClass() ?>"><div id="elh_document_log_transmit_date_in_sub6" class="document_log_transmit_date_in_sub6"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_in_sub6" class="<?php echo $document_log->transmit_date_in_sub6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_in_sub6) ?>',2);"><div id="elh_document_log_transmit_date_in_sub6" class="document_log_transmit_date_in_sub6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub6->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_in_sub6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_in_sub6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub7->Visible) { // submit_no_sub7 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_sub7) == "") { ?>
		<th data-name="submit_no_sub7" class="<?php echo $document_log->submit_no_sub7->headerCellClass() ?>"><div id="elh_document_log_submit_no_sub7" class="document_log_submit_no_sub7"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_sub7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_sub7" class="<?php echo $document_log->submit_no_sub7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_sub7) ?>',2);"><div id="elh_document_log_submit_no_sub7" class="document_log_submit_no_sub7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_sub7->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_sub7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_sub7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub7->Visible) { // revision_no_sub7 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_sub7) == "") { ?>
		<th data-name="revision_no_sub7" class="<?php echo $document_log->revision_no_sub7->headerCellClass() ?>"><div id="elh_document_log_revision_no_sub7" class="document_log_revision_no_sub7"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_sub7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_sub7" class="<?php echo $document_log->revision_no_sub7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_sub7) ?>',2);"><div id="elh_document_log_revision_no_sub7" class="document_log_revision_no_sub7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_sub7->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_sub7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_sub7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub7->Visible) { // direction_out_sub7 ?>
	<?php if ($document_log->sortUrl($document_log->direction_out_sub7) == "") { ?>
		<th data-name="direction_out_sub7" class="<?php echo $document_log->direction_out_sub7->headerCellClass() ?>"><div id="elh_document_log_direction_out_sub7" class="document_log_direction_out_sub7"><div class="ew-table-header-caption"><?php echo $document_log->direction_out_sub7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_out_sub7" class="<?php echo $document_log->direction_out_sub7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_out_sub7) ?>',2);"><div id="elh_document_log_direction_out_sub7" class="document_log_direction_out_sub7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_out_sub7->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_out_sub7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_out_sub7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub7->Visible) { // planned_date_out_sub7 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_out_sub7) == "") { ?>
		<th data-name="planned_date_out_sub7" class="<?php echo $document_log->planned_date_out_sub7->headerCellClass() ?>"><div id="elh_document_log_planned_date_out_sub7" class="document_log_planned_date_out_sub7"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_out_sub7" class="<?php echo $document_log->planned_date_out_sub7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_out_sub7) ?>',2);"><div id="elh_document_log_planned_date_out_sub7" class="document_log_planned_date_out_sub7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub7->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_out_sub7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_out_sub7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub7->Visible) { // transmit_date_out_sub7 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_out_sub7) == "") { ?>
		<th data-name="transmit_date_out_sub7" class="<?php echo $document_log->transmit_date_out_sub7->headerCellClass() ?>"><div id="elh_document_log_transmit_date_out_sub7" class="document_log_transmit_date_out_sub7"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_out_sub7" class="<?php echo $document_log->transmit_date_out_sub7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_out_sub7) ?>',2);"><div id="elh_document_log_transmit_date_out_sub7" class="document_log_transmit_date_out_sub7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub7->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_out_sub7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_out_sub7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub7->Visible) { // transmit_no_out_sub7 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_out_sub7) == "") { ?>
		<th data-name="transmit_no_out_sub7" class="<?php echo $document_log->transmit_no_out_sub7->headerCellClass() ?>"><div id="elh_document_log_transmit_no_out_sub7" class="document_log_transmit_no_out_sub7"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_out_sub7" class="<?php echo $document_log->transmit_no_out_sub7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_out_sub7) ?>',2);"><div id="elh_document_log_transmit_no_out_sub7" class="document_log_transmit_no_out_sub7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub7->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_out_sub7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_out_sub7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub7->Visible) { // approval_status_out_sub7 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_out_sub7) == "") { ?>
		<th data-name="approval_status_out_sub7" class="<?php echo $document_log->approval_status_out_sub7->headerCellClass() ?>"><div id="elh_document_log_approval_status_out_sub7" class="document_log_approval_status_out_sub7"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_out_sub7" class="<?php echo $document_log->approval_status_out_sub7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_out_sub7) ?>',2);"><div id="elh_document_log_approval_status_out_sub7" class="document_log_approval_status_out_sub7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub7->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_out_sub7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_out_sub7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub7->Visible) { // direction_in_sub7 ?>
	<?php if ($document_log->sortUrl($document_log->direction_in_sub7) == "") { ?>
		<th data-name="direction_in_sub7" class="<?php echo $document_log->direction_in_sub7->headerCellClass() ?>"><div id="elh_document_log_direction_in_sub7" class="document_log_direction_in_sub7"><div class="ew-table-header-caption"><?php echo $document_log->direction_in_sub7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_in_sub7" class="<?php echo $document_log->direction_in_sub7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_in_sub7) ?>',2);"><div id="elh_document_log_direction_in_sub7" class="document_log_direction_in_sub7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_in_sub7->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_in_sub7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_in_sub7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub7->Visible) { // transmit_no_in_sub7 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_in_sub7) == "") { ?>
		<th data-name="transmit_no_in_sub7" class="<?php echo $document_log->transmit_no_in_sub7->headerCellClass() ?>"><div id="elh_document_log_transmit_no_in_sub7" class="document_log_transmit_no_in_sub7"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_in_sub7" class="<?php echo $document_log->transmit_no_in_sub7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_in_sub7) ?>',2);"><div id="elh_document_log_transmit_no_in_sub7" class="document_log_transmit_no_in_sub7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub7->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_in_sub7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_in_sub7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub7->Visible) { // approval_status_in_sub7 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_in_sub7) == "") { ?>
		<th data-name="approval_status_in_sub7" class="<?php echo $document_log->approval_status_in_sub7->headerCellClass() ?>"><div id="elh_document_log_approval_status_in_sub7" class="document_log_approval_status_in_sub7"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_in_sub7" class="<?php echo $document_log->approval_status_in_sub7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_in_sub7) ?>',2);"><div id="elh_document_log_approval_status_in_sub7" class="document_log_approval_status_in_sub7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub7->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_in_sub7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_in_sub7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub7->Visible) { // transmit_date_in_sub7 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_in_sub7) == "") { ?>
		<th data-name="transmit_date_in_sub7" class="<?php echo $document_log->transmit_date_in_sub7->headerCellClass() ?>"><div id="elh_document_log_transmit_date_in_sub7" class="document_log_transmit_date_in_sub7"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_in_sub7" class="<?php echo $document_log->transmit_date_in_sub7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_in_sub7) ?>',2);"><div id="elh_document_log_transmit_date_in_sub7" class="document_log_transmit_date_in_sub7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub7->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_in_sub7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_in_sub7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub8->Visible) { // submit_no_sub8 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_sub8) == "") { ?>
		<th data-name="submit_no_sub8" class="<?php echo $document_log->submit_no_sub8->headerCellClass() ?>"><div id="elh_document_log_submit_no_sub8" class="document_log_submit_no_sub8"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_sub8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_sub8" class="<?php echo $document_log->submit_no_sub8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_sub8) ?>',2);"><div id="elh_document_log_submit_no_sub8" class="document_log_submit_no_sub8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_sub8->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_sub8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_sub8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub8->Visible) { // revision_no_sub8 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_sub8) == "") { ?>
		<th data-name="revision_no_sub8" class="<?php echo $document_log->revision_no_sub8->headerCellClass() ?>"><div id="elh_document_log_revision_no_sub8" class="document_log_revision_no_sub8"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_sub8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_sub8" class="<?php echo $document_log->revision_no_sub8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_sub8) ?>',2);"><div id="elh_document_log_revision_no_sub8" class="document_log_revision_no_sub8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_sub8->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_sub8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_sub8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub8->Visible) { // direction_out_sub8 ?>
	<?php if ($document_log->sortUrl($document_log->direction_out_sub8) == "") { ?>
		<th data-name="direction_out_sub8" class="<?php echo $document_log->direction_out_sub8->headerCellClass() ?>"><div id="elh_document_log_direction_out_sub8" class="document_log_direction_out_sub8"><div class="ew-table-header-caption"><?php echo $document_log->direction_out_sub8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_out_sub8" class="<?php echo $document_log->direction_out_sub8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_out_sub8) ?>',2);"><div id="elh_document_log_direction_out_sub8" class="document_log_direction_out_sub8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_out_sub8->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_out_sub8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_out_sub8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub8->Visible) { // planned_date_out_sub8 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_out_sub8) == "") { ?>
		<th data-name="planned_date_out_sub8" class="<?php echo $document_log->planned_date_out_sub8->headerCellClass() ?>"><div id="elh_document_log_planned_date_out_sub8" class="document_log_planned_date_out_sub8"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_out_sub8" class="<?php echo $document_log->planned_date_out_sub8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_out_sub8) ?>',2);"><div id="elh_document_log_planned_date_out_sub8" class="document_log_planned_date_out_sub8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub8->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_out_sub8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_out_sub8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub8->Visible) { // transmit_date_out_sub8 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_out_sub8) == "") { ?>
		<th data-name="transmit_date_out_sub8" class="<?php echo $document_log->transmit_date_out_sub8->headerCellClass() ?>"><div id="elh_document_log_transmit_date_out_sub8" class="document_log_transmit_date_out_sub8"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_out_sub8" class="<?php echo $document_log->transmit_date_out_sub8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_out_sub8) ?>',2);"><div id="elh_document_log_transmit_date_out_sub8" class="document_log_transmit_date_out_sub8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub8->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_out_sub8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_out_sub8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub8->Visible) { // transmit_no_out_sub8 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_out_sub8) == "") { ?>
		<th data-name="transmit_no_out_sub8" class="<?php echo $document_log->transmit_no_out_sub8->headerCellClass() ?>"><div id="elh_document_log_transmit_no_out_sub8" class="document_log_transmit_no_out_sub8"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_out_sub8" class="<?php echo $document_log->transmit_no_out_sub8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_out_sub8) ?>',2);"><div id="elh_document_log_transmit_no_out_sub8" class="document_log_transmit_no_out_sub8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub8->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_out_sub8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_out_sub8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub8->Visible) { // approval_status_out_sub8 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_out_sub8) == "") { ?>
		<th data-name="approval_status_out_sub8" class="<?php echo $document_log->approval_status_out_sub8->headerCellClass() ?>"><div id="elh_document_log_approval_status_out_sub8" class="document_log_approval_status_out_sub8"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_out_sub8" class="<?php echo $document_log->approval_status_out_sub8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_out_sub8) ?>',2);"><div id="elh_document_log_approval_status_out_sub8" class="document_log_approval_status_out_sub8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub8->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_out_sub8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_out_sub8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_file_sub8->Visible) { // direction_out_file_sub8 ?>
	<?php if ($document_log->sortUrl($document_log->direction_out_file_sub8) == "") { ?>
		<th data-name="direction_out_file_sub8" class="<?php echo $document_log->direction_out_file_sub8->headerCellClass() ?>"><div id="elh_document_log_direction_out_file_sub8" class="document_log_direction_out_file_sub8"><div class="ew-table-header-caption"><?php echo $document_log->direction_out_file_sub8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_out_file_sub8" class="<?php echo $document_log->direction_out_file_sub8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_out_file_sub8) ?>',2);"><div id="elh_document_log_direction_out_file_sub8" class="document_log_direction_out_file_sub8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_out_file_sub8->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_out_file_sub8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_out_file_sub8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub8->Visible) { // direction_in_sub8 ?>
	<?php if ($document_log->sortUrl($document_log->direction_in_sub8) == "") { ?>
		<th data-name="direction_in_sub8" class="<?php echo $document_log->direction_in_sub8->headerCellClass() ?>"><div id="elh_document_log_direction_in_sub8" class="document_log_direction_in_sub8"><div class="ew-table-header-caption"><?php echo $document_log->direction_in_sub8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_in_sub8" class="<?php echo $document_log->direction_in_sub8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_in_sub8) ?>',2);"><div id="elh_document_log_direction_in_sub8" class="document_log_direction_in_sub8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_in_sub8->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_in_sub8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_in_sub8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub8->Visible) { // transmit_no_in_sub8 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_in_sub8) == "") { ?>
		<th data-name="transmit_no_in_sub8" class="<?php echo $document_log->transmit_no_in_sub8->headerCellClass() ?>"><div id="elh_document_log_transmit_no_in_sub8" class="document_log_transmit_no_in_sub8"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_in_sub8" class="<?php echo $document_log->transmit_no_in_sub8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_in_sub8) ?>',2);"><div id="elh_document_log_transmit_no_in_sub8" class="document_log_transmit_no_in_sub8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub8->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_in_sub8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_in_sub8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub8->Visible) { // approval_status_in_sub8 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_in_sub8) == "") { ?>
		<th data-name="approval_status_in_sub8" class="<?php echo $document_log->approval_status_in_sub8->headerCellClass() ?>"><div id="elh_document_log_approval_status_in_sub8" class="document_log_approval_status_in_sub8"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_in_sub8" class="<?php echo $document_log->approval_status_in_sub8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_in_sub8) ?>',2);"><div id="elh_document_log_approval_status_in_sub8" class="document_log_approval_status_in_sub8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub8->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_in_sub8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_in_sub8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub8->Visible) { // transmit_date_in_sub8 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_in_sub8) == "") { ?>
		<th data-name="transmit_date_in_sub8" class="<?php echo $document_log->transmit_date_in_sub8->headerCellClass() ?>"><div id="elh_document_log_transmit_date_in_sub8" class="document_log_transmit_date_in_sub8"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_in_sub8" class="<?php echo $document_log->transmit_date_in_sub8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_in_sub8) ?>',2);"><div id="elh_document_log_transmit_date_in_sub8" class="document_log_transmit_date_in_sub8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub8->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_in_sub8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_in_sub8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub9->Visible) { // submit_no_sub9 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_sub9) == "") { ?>
		<th data-name="submit_no_sub9" class="<?php echo $document_log->submit_no_sub9->headerCellClass() ?>"><div id="elh_document_log_submit_no_sub9" class="document_log_submit_no_sub9"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_sub9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_sub9" class="<?php echo $document_log->submit_no_sub9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_sub9) ?>',2);"><div id="elh_document_log_submit_no_sub9" class="document_log_submit_no_sub9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_sub9->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_sub9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_sub9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub9->Visible) { // revision_no_sub9 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_sub9) == "") { ?>
		<th data-name="revision_no_sub9" class="<?php echo $document_log->revision_no_sub9->headerCellClass() ?>"><div id="elh_document_log_revision_no_sub9" class="document_log_revision_no_sub9"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_sub9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_sub9" class="<?php echo $document_log->revision_no_sub9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_sub9) ?>',2);"><div id="elh_document_log_revision_no_sub9" class="document_log_revision_no_sub9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_sub9->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_sub9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_sub9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub9->Visible) { // direction_out_sub9 ?>
	<?php if ($document_log->sortUrl($document_log->direction_out_sub9) == "") { ?>
		<th data-name="direction_out_sub9" class="<?php echo $document_log->direction_out_sub9->headerCellClass() ?>"><div id="elh_document_log_direction_out_sub9" class="document_log_direction_out_sub9"><div class="ew-table-header-caption"><?php echo $document_log->direction_out_sub9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_out_sub9" class="<?php echo $document_log->direction_out_sub9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_out_sub9) ?>',2);"><div id="elh_document_log_direction_out_sub9" class="document_log_direction_out_sub9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_out_sub9->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_out_sub9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_out_sub9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub9->Visible) { // planned_date_out_sub9 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_out_sub9) == "") { ?>
		<th data-name="planned_date_out_sub9" class="<?php echo $document_log->planned_date_out_sub9->headerCellClass() ?>"><div id="elh_document_log_planned_date_out_sub9" class="document_log_planned_date_out_sub9"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_out_sub9" class="<?php echo $document_log->planned_date_out_sub9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_out_sub9) ?>',2);"><div id="elh_document_log_planned_date_out_sub9" class="document_log_planned_date_out_sub9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub9->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_out_sub9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_out_sub9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub9->Visible) { // transmit_date_out_sub9 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_out_sub9) == "") { ?>
		<th data-name="transmit_date_out_sub9" class="<?php echo $document_log->transmit_date_out_sub9->headerCellClass() ?>"><div id="elh_document_log_transmit_date_out_sub9" class="document_log_transmit_date_out_sub9"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_out_sub9" class="<?php echo $document_log->transmit_date_out_sub9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_out_sub9) ?>',2);"><div id="elh_document_log_transmit_date_out_sub9" class="document_log_transmit_date_out_sub9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub9->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_out_sub9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_out_sub9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub9->Visible) { // transmit_no_out_sub9 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_out_sub9) == "") { ?>
		<th data-name="transmit_no_out_sub9" class="<?php echo $document_log->transmit_no_out_sub9->headerCellClass() ?>"><div id="elh_document_log_transmit_no_out_sub9" class="document_log_transmit_no_out_sub9"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_out_sub9" class="<?php echo $document_log->transmit_no_out_sub9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_out_sub9) ?>',2);"><div id="elh_document_log_transmit_no_out_sub9" class="document_log_transmit_no_out_sub9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub9->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_out_sub9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_out_sub9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub9->Visible) { // approval_status_out_sub9 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_out_sub9) == "") { ?>
		<th data-name="approval_status_out_sub9" class="<?php echo $document_log->approval_status_out_sub9->headerCellClass() ?>"><div id="elh_document_log_approval_status_out_sub9" class="document_log_approval_status_out_sub9"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_out_sub9" class="<?php echo $document_log->approval_status_out_sub9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_out_sub9) ?>',2);"><div id="elh_document_log_approval_status_out_sub9" class="document_log_approval_status_out_sub9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub9->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_out_sub9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_out_sub9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub9->Visible) { // direction_in_sub9 ?>
	<?php if ($document_log->sortUrl($document_log->direction_in_sub9) == "") { ?>
		<th data-name="direction_in_sub9" class="<?php echo $document_log->direction_in_sub9->headerCellClass() ?>"><div id="elh_document_log_direction_in_sub9" class="document_log_direction_in_sub9"><div class="ew-table-header-caption"><?php echo $document_log->direction_in_sub9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_in_sub9" class="<?php echo $document_log->direction_in_sub9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_in_sub9) ?>',2);"><div id="elh_document_log_direction_in_sub9" class="document_log_direction_in_sub9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_in_sub9->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_in_sub9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_in_sub9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub9->Visible) { // transmit_no_in_sub9 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_in_sub9) == "") { ?>
		<th data-name="transmit_no_in_sub9" class="<?php echo $document_log->transmit_no_in_sub9->headerCellClass() ?>"><div id="elh_document_log_transmit_no_in_sub9" class="document_log_transmit_no_in_sub9"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_in_sub9" class="<?php echo $document_log->transmit_no_in_sub9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_in_sub9) ?>',2);"><div id="elh_document_log_transmit_no_in_sub9" class="document_log_transmit_no_in_sub9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub9->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_in_sub9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_in_sub9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub9->Visible) { // approval_status_in_sub9 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_in_sub9) == "") { ?>
		<th data-name="approval_status_in_sub9" class="<?php echo $document_log->approval_status_in_sub9->headerCellClass() ?>"><div id="elh_document_log_approval_status_in_sub9" class="document_log_approval_status_in_sub9"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_in_sub9" class="<?php echo $document_log->approval_status_in_sub9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_in_sub9) ?>',2);"><div id="elh_document_log_approval_status_in_sub9" class="document_log_approval_status_in_sub9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub9->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_in_sub9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_in_sub9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub9->Visible) { // transmit_date_in_sub9 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_in_sub9) == "") { ?>
		<th data-name="transmit_date_in_sub9" class="<?php echo $document_log->transmit_date_in_sub9->headerCellClass() ?>"><div id="elh_document_log_transmit_date_in_sub9" class="document_log_transmit_date_in_sub9"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_in_sub9" class="<?php echo $document_log->transmit_date_in_sub9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_in_sub9) ?>',2);"><div id="elh_document_log_transmit_date_in_sub9" class="document_log_transmit_date_in_sub9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub9->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_in_sub9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_in_sub9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_sub10->Visible) { // submit_no_sub10 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_sub10) == "") { ?>
		<th data-name="submit_no_sub10" class="<?php echo $document_log->submit_no_sub10->headerCellClass() ?>"><div id="elh_document_log_submit_no_sub10" class="document_log_submit_no_sub10"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_sub10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_sub10" class="<?php echo $document_log->submit_no_sub10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_sub10) ?>',2);"><div id="elh_document_log_submit_no_sub10" class="document_log_submit_no_sub10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_sub10->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_sub10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_sub10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_sub10->Visible) { // revision_no_sub10 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_sub10) == "") { ?>
		<th data-name="revision_no_sub10" class="<?php echo $document_log->revision_no_sub10->headerCellClass() ?>"><div id="elh_document_log_revision_no_sub10" class="document_log_revision_no_sub10"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_sub10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_sub10" class="<?php echo $document_log->revision_no_sub10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_sub10) ?>',2);"><div id="elh_document_log_revision_no_sub10" class="document_log_revision_no_sub10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_sub10->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_sub10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_sub10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_out_sub10->Visible) { // direction_out_sub10 ?>
	<?php if ($document_log->sortUrl($document_log->direction_out_sub10) == "") { ?>
		<th data-name="direction_out_sub10" class="<?php echo $document_log->direction_out_sub10->headerCellClass() ?>"><div id="elh_document_log_direction_out_sub10" class="document_log_direction_out_sub10"><div class="ew-table-header-caption"><?php echo $document_log->direction_out_sub10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_out_sub10" class="<?php echo $document_log->direction_out_sub10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_out_sub10) ?>',2);"><div id="elh_document_log_direction_out_sub10" class="document_log_direction_out_sub10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_out_sub10->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_out_sub10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_out_sub10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_out_sub10->Visible) { // planned_date_out_sub10 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_out_sub10) == "") { ?>
		<th data-name="planned_date_out_sub10" class="<?php echo $document_log->planned_date_out_sub10->headerCellClass() ?>"><div id="elh_document_log_planned_date_out_sub10" class="document_log_planned_date_out_sub10"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_out_sub10" class="<?php echo $document_log->planned_date_out_sub10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_out_sub10) ?>',2);"><div id="elh_document_log_planned_date_out_sub10" class="document_log_planned_date_out_sub10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_out_sub10->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_out_sub10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_out_sub10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_out_sub10->Visible) { // transmit_date_out_sub10 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_out_sub10) == "") { ?>
		<th data-name="transmit_date_out_sub10" class="<?php echo $document_log->transmit_date_out_sub10->headerCellClass() ?>"><div id="elh_document_log_transmit_date_out_sub10" class="document_log_transmit_date_out_sub10"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_out_sub10" class="<?php echo $document_log->transmit_date_out_sub10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_out_sub10) ?>',2);"><div id="elh_document_log_transmit_date_out_sub10" class="document_log_transmit_date_out_sub10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_out_sub10->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_out_sub10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_out_sub10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_out_sub10->Visible) { // transmit_no_out_sub10 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_out_sub10) == "") { ?>
		<th data-name="transmit_no_out_sub10" class="<?php echo $document_log->transmit_no_out_sub10->headerCellClass() ?>"><div id="elh_document_log_transmit_no_out_sub10" class="document_log_transmit_no_out_sub10"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_out_sub10" class="<?php echo $document_log->transmit_no_out_sub10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_out_sub10) ?>',2);"><div id="elh_document_log_transmit_no_out_sub10" class="document_log_transmit_no_out_sub10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_out_sub10->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_out_sub10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_out_sub10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_out_sub10->Visible) { // approval_status_out_sub10 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_out_sub10) == "") { ?>
		<th data-name="approval_status_out_sub10" class="<?php echo $document_log->approval_status_out_sub10->headerCellClass() ?>"><div id="elh_document_log_approval_status_out_sub10" class="document_log_approval_status_out_sub10"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_out_sub10" class="<?php echo $document_log->approval_status_out_sub10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_out_sub10) ?>',2);"><div id="elh_document_log_approval_status_out_sub10" class="document_log_approval_status_out_sub10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_out_sub10->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_out_sub10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_out_sub10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_in_sub10->Visible) { // direction_in_sub10 ?>
	<?php if ($document_log->sortUrl($document_log->direction_in_sub10) == "") { ?>
		<th data-name="direction_in_sub10" class="<?php echo $document_log->direction_in_sub10->headerCellClass() ?>"><div id="elh_document_log_direction_in_sub10" class="document_log_direction_in_sub10"><div class="ew-table-header-caption"><?php echo $document_log->direction_in_sub10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_in_sub10" class="<?php echo $document_log->direction_in_sub10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_in_sub10) ?>',2);"><div id="elh_document_log_direction_in_sub10" class="document_log_direction_in_sub10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_in_sub10->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_in_sub10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_in_sub10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_in_sub10->Visible) { // transmit_no_in_sub10 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_in_sub10) == "") { ?>
		<th data-name="transmit_no_in_sub10" class="<?php echo $document_log->transmit_no_in_sub10->headerCellClass() ?>"><div id="elh_document_log_transmit_no_in_sub10" class="document_log_transmit_no_in_sub10"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_in_sub10" class="<?php echo $document_log->transmit_no_in_sub10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_in_sub10) ?>',2);"><div id="elh_document_log_transmit_no_in_sub10" class="document_log_transmit_no_in_sub10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_in_sub10->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_in_sub10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_in_sub10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_in_sub10->Visible) { // approval_status_in_sub10 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_in_sub10) == "") { ?>
		<th data-name="approval_status_in_sub10" class="<?php echo $document_log->approval_status_in_sub10->headerCellClass() ?>"><div id="elh_document_log_approval_status_in_sub10" class="document_log_approval_status_in_sub10"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_in_sub10" class="<?php echo $document_log->approval_status_in_sub10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_in_sub10) ?>',2);"><div id="elh_document_log_approval_status_in_sub10" class="document_log_approval_status_in_sub10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_in_sub10->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_in_sub10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_in_sub10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_in_sub10->Visible) { // transmit_date_in_sub10 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_in_sub10) == "") { ?>
		<th data-name="transmit_date_in_sub10" class="<?php echo $document_log->transmit_date_in_sub10->headerCellClass() ?>"><div id="elh_document_log_transmit_date_in_sub10" class="document_log_transmit_date_in_sub10"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_in_sub10" class="<?php echo $document_log->transmit_date_in_sub10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_in_sub10) ?>',2);"><div id="elh_document_log_transmit_date_in_sub10" class="document_log_transmit_date_in_sub10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_in_sub10->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_in_sub10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_in_sub10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->log_updatedon->Visible) { // log_updatedon ?>
	<?php if ($document_log->sortUrl($document_log->log_updatedon) == "") { ?>
		<th data-name="log_updatedon" class="<?php echo $document_log->log_updatedon->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_document_log_log_updatedon" class="document_log_log_updatedon"><div class="ew-table-header-caption"><?php echo $document_log->log_updatedon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="log_updatedon" class="<?php echo $document_log->log_updatedon->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->log_updatedon) ?>',2);"><div id="elh_document_log_log_updatedon" class="document_log_log_updatedon">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->log_updatedon->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->log_updatedon->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->log_updatedon->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$document_log_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($document_log->ExportAll && $document_log->isExport()) {
	$document_log_list->StopRec = $document_log_list->TotalRecs;
} else {

	// Set the last record to display
	if ($document_log_list->TotalRecs > $document_log_list->StartRec + $document_log_list->DisplayRecs - 1)
		$document_log_list->StopRec = $document_log_list->StartRec + $document_log_list->DisplayRecs - 1;
	else
		$document_log_list->StopRec = $document_log_list->TotalRecs;
}
$document_log_list->RecCnt = $document_log_list->StartRec - 1;
if ($document_log_list->Recordset && !$document_log_list->Recordset->EOF) {
	$document_log_list->Recordset->moveFirst();
	$selectLimit = $document_log_list->UseSelectLimit;
	if (!$selectLimit && $document_log_list->StartRec > 1)
		$document_log_list->Recordset->move($document_log_list->StartRec - 1);
} elseif (!$document_log->AllowAddDeleteRow && $document_log_list->StopRec == 0) {
	$document_log_list->StopRec = $document_log->GridAddRowCount;
}

// Initialize aggregate
$document_log->RowType = ROWTYPE_AGGREGATEINIT;
$document_log->resetAttributes();
$document_log_list->renderRow();
while ($document_log_list->RecCnt < $document_log_list->StopRec) {
	$document_log_list->RecCnt++;
	if ($document_log_list->RecCnt >= $document_log_list->StartRec) {
		$document_log_list->RowCnt++;

		// Set up key count
		$document_log_list->KeyCount = $document_log_list->RowIndex;

		// Init row class and style
		$document_log->resetAttributes();
		$document_log->CssClass = "";
		if ($document_log->isGridAdd()) {
		} else {
			$document_log_list->loadRowValues($document_log_list->Recordset); // Load row values
		}
		$document_log->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$document_log->RowAttrs = array_merge($document_log->RowAttrs, array('data-rowindex'=>$document_log_list->RowCnt, 'id'=>'r' . $document_log_list->RowCnt . '_document_log', 'data-rowtype'=>$document_log->RowType));

		// Render row
		$document_log_list->renderRow();

		// Render list options
		$document_log_list->renderListOptions();
?>
	<tr<?php echo $document_log->rowAttributes() ?>>
<?php

// Render list options (body, left)
$document_log_list->ListOptions->render("body", "left", $document_log_list->RowCnt);
?>
	<?php if ($document_log->firelink_doc_no->Visible) { // firelink_doc_no ?>
		<td data-name="firelink_doc_no"<?php echo $document_log->firelink_doc_no->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_firelink_doc_no" class="document_log_firelink_doc_no">
<span<?php echo $document_log->firelink_doc_no->viewAttributes() ?>>
<?php echo $document_log->firelink_doc_no->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->client_doc_no->Visible) { // client_doc_no ?>
		<td data-name="client_doc_no"<?php echo $document_log->client_doc_no->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_client_doc_no" class="document_log_client_doc_no">
<span<?php echo $document_log->client_doc_no->viewAttributes() ?>>
<?php echo $document_log->client_doc_no->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->order_number->Visible) { // order_number ?>
		<td data-name="order_number"<?php echo $document_log->order_number->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_order_number" class="document_log_order_number">
<span<?php echo $document_log->order_number->viewAttributes() ?>>
<?php echo $document_log->order_number->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->project_name->Visible) { // project_name ?>
		<td data-name="project_name"<?php echo $document_log->project_name->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_project_name" class="document_log_project_name">
<span<?php echo $document_log->project_name->viewAttributes() ?>>
<?php echo $document_log->project_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->document_tittle->Visible) { // document_tittle ?>
		<td data-name="document_tittle"<?php echo $document_log->document_tittle->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_document_tittle" class="document_log_document_tittle">
<span<?php echo $document_log->document_tittle->viewAttributes() ?>>
<?php echo $document_log->document_tittle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->current_status->Visible) { // current_status ?>
		<td data-name="current_status"<?php echo $document_log->current_status->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_current_status" class="document_log_current_status">
<span<?php echo $document_log->current_status->viewAttributes() ?>>
<?php if ((!EmptyString($document_log->current_status->getViewValue())) && $document_log->current_status->linkAttributes() <> "") { ?>
<a<?php echo $document_log->current_status->linkAttributes() ?>><?php echo $document_log->current_status->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->current_status->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_sub1->Visible) { // submit_no_sub1 ?>
		<td data-name="submit_no_sub1"<?php echo $document_log->submit_no_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_sub1" class="document_log_submit_no_sub1">
<span<?php echo $document_log->submit_no_sub1->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_sub1->Visible) { // revision_no_sub1 ?>
		<td data-name="revision_no_sub1"<?php echo $document_log->revision_no_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_sub1" class="document_log_revision_no_sub1">
<span<?php echo $document_log->revision_no_sub1->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_out_sub1->Visible) { // direction_out_sub1 ?>
		<td data-name="direction_out_sub1"<?php echo $document_log->direction_out_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_out_sub1" class="document_log_direction_out_sub1">
<span<?php echo $document_log->direction_out_sub1->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_out_sub1->Visible) { // planned_date_out_sub1 ?>
		<td data-name="planned_date_out_sub1"<?php echo $document_log->planned_date_out_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_out_sub1" class="document_log_planned_date_out_sub1">
<span<?php echo $document_log->planned_date_out_sub1->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_out_sub1->Visible) { // transmit_date_out_sub1 ?>
		<td data-name="transmit_date_out_sub1"<?php echo $document_log->transmit_date_out_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_out_sub1" class="document_log_transmit_date_out_sub1">
<span<?php echo $document_log->transmit_date_out_sub1->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_out_sub1->Visible) { // transmit_no_out_sub1 ?>
		<td data-name="transmit_no_out_sub1"<?php echo $document_log->transmit_no_out_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_out_sub1" class="document_log_transmit_no_out_sub1">
<span<?php echo $document_log->transmit_no_out_sub1->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_out_sub1->Visible) { // approval_status_out_sub1 ?>
		<td data-name="approval_status_out_sub1"<?php echo $document_log->approval_status_out_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_out_sub1" class="document_log_approval_status_out_sub1">
<span<?php echo $document_log->approval_status_out_sub1->viewAttributes() ?>>
<?php if ((!EmptyString($document_log->approval_status_out_sub1->getViewValue())) && $document_log->approval_status_out_sub1->linkAttributes() <> "") { ?>
<a<?php echo $document_log->approval_status_out_sub1->linkAttributes() ?>><?php echo $document_log->approval_status_out_sub1->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->approval_status_out_sub1->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_in_sub1->Visible) { // direction_in_sub1 ?>
		<td data-name="direction_in_sub1"<?php echo $document_log->direction_in_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_in_sub1" class="document_log_direction_in_sub1">
<span<?php echo $document_log->direction_in_sub1->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_in_sub1->Visible) { // transmit_no_in_sub1 ?>
		<td data-name="transmit_no_in_sub1"<?php echo $document_log->transmit_no_in_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_in_sub1" class="document_log_transmit_no_in_sub1">
<span<?php echo $document_log->transmit_no_in_sub1->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_in_sub1->Visible) { // approval_status_in_sub1 ?>
		<td data-name="approval_status_in_sub1"<?php echo $document_log->approval_status_in_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_in_sub1" class="document_log_approval_status_in_sub1">
<span<?php echo $document_log->approval_status_in_sub1->viewAttributes() ?>>
<?php if ((!EmptyString($document_log->approval_status_in_sub1->getViewValue())) && $document_log->approval_status_in_sub1->linkAttributes() <> "") { ?>
<a<?php echo $document_log->approval_status_in_sub1->linkAttributes() ?>><?php echo $document_log->approval_status_in_sub1->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->approval_status_in_sub1->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_in_sub1->Visible) { // transmit_date_in_sub1 ?>
		<td data-name="transmit_date_in_sub1"<?php echo $document_log->transmit_date_in_sub1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_in_sub1" class="document_log_transmit_date_in_sub1">
<span<?php echo $document_log->transmit_date_in_sub1->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_sub2->Visible) { // submit_no_sub2 ?>
		<td data-name="submit_no_sub2"<?php echo $document_log->submit_no_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_sub2" class="document_log_submit_no_sub2">
<span<?php echo $document_log->submit_no_sub2->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_sub2->Visible) { // revision_no_sub2 ?>
		<td data-name="revision_no_sub2"<?php echo $document_log->revision_no_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_sub2" class="document_log_revision_no_sub2">
<span<?php echo $document_log->revision_no_sub2->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_out_sub2->Visible) { // direction_out_sub2 ?>
		<td data-name="direction_out_sub2"<?php echo $document_log->direction_out_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_out_sub2" class="document_log_direction_out_sub2">
<span<?php echo $document_log->direction_out_sub2->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_out_sub2->Visible) { // planned_date_out_sub2 ?>
		<td data-name="planned_date_out_sub2"<?php echo $document_log->planned_date_out_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_out_sub2" class="document_log_planned_date_out_sub2">
<span<?php echo $document_log->planned_date_out_sub2->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_out_sub2->Visible) { // transmit_date_out_sub2 ?>
		<td data-name="transmit_date_out_sub2"<?php echo $document_log->transmit_date_out_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_out_sub2" class="document_log_transmit_date_out_sub2">
<span<?php echo $document_log->transmit_date_out_sub2->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_out_sub2->Visible) { // transmit_no_out_sub2 ?>
		<td data-name="transmit_no_out_sub2"<?php echo $document_log->transmit_no_out_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_out_sub2" class="document_log_transmit_no_out_sub2">
<span<?php echo $document_log->transmit_no_out_sub2->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_out_sub2->Visible) { // approval_status_out_sub2 ?>
		<td data-name="approval_status_out_sub2"<?php echo $document_log->approval_status_out_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_out_sub2" class="document_log_approval_status_out_sub2">
<span<?php echo $document_log->approval_status_out_sub2->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_in_sub2->Visible) { // direction_in_sub2 ?>
		<td data-name="direction_in_sub2"<?php echo $document_log->direction_in_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_in_sub2" class="document_log_direction_in_sub2">
<span<?php echo $document_log->direction_in_sub2->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_in_sub2->Visible) { // transmit_no_in_sub2 ?>
		<td data-name="transmit_no_in_sub2"<?php echo $document_log->transmit_no_in_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_in_sub2" class="document_log_transmit_no_in_sub2">
<span<?php echo $document_log->transmit_no_in_sub2->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_in_sub2->Visible) { // approval_status_in_sub2 ?>
		<td data-name="approval_status_in_sub2"<?php echo $document_log->approval_status_in_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_in_sub2" class="document_log_approval_status_in_sub2">
<span<?php echo $document_log->approval_status_in_sub2->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_in_sub2->Visible) { // transmit_date_in_sub2 ?>
		<td data-name="transmit_date_in_sub2"<?php echo $document_log->transmit_date_in_sub2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_in_sub2" class="document_log_transmit_date_in_sub2">
<span<?php echo $document_log->transmit_date_in_sub2->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_sub3->Visible) { // submit_no_sub3 ?>
		<td data-name="submit_no_sub3"<?php echo $document_log->submit_no_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_sub3" class="document_log_submit_no_sub3">
<span<?php echo $document_log->submit_no_sub3->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_sub3->Visible) { // revision_no_sub3 ?>
		<td data-name="revision_no_sub3"<?php echo $document_log->revision_no_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_sub3" class="document_log_revision_no_sub3">
<span<?php echo $document_log->revision_no_sub3->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_out_sub3->Visible) { // direction_out_sub3 ?>
		<td data-name="direction_out_sub3"<?php echo $document_log->direction_out_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_out_sub3" class="document_log_direction_out_sub3">
<span<?php echo $document_log->direction_out_sub3->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_out_sub3->Visible) { // planned_date_out_sub3 ?>
		<td data-name="planned_date_out_sub3"<?php echo $document_log->planned_date_out_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_out_sub3" class="document_log_planned_date_out_sub3">
<span<?php echo $document_log->planned_date_out_sub3->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_out_sub3->Visible) { // transmit_date_out_sub3 ?>
		<td data-name="transmit_date_out_sub3"<?php echo $document_log->transmit_date_out_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_out_sub3" class="document_log_transmit_date_out_sub3">
<span<?php echo $document_log->transmit_date_out_sub3->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_out_sub3->Visible) { // transmit_no_out_sub3 ?>
		<td data-name="transmit_no_out_sub3"<?php echo $document_log->transmit_no_out_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_out_sub3" class="document_log_transmit_no_out_sub3">
<span<?php echo $document_log->transmit_no_out_sub3->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_out_sub3->Visible) { // approval_status_out_sub3 ?>
		<td data-name="approval_status_out_sub3"<?php echo $document_log->approval_status_out_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_out_sub3" class="document_log_approval_status_out_sub3">
<span<?php echo $document_log->approval_status_out_sub3->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_in_sub3->Visible) { // direction_in_sub3 ?>
		<td data-name="direction_in_sub3"<?php echo $document_log->direction_in_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_in_sub3" class="document_log_direction_in_sub3">
<span<?php echo $document_log->direction_in_sub3->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_in_sub3->Visible) { // transmit_no_in_sub3 ?>
		<td data-name="transmit_no_in_sub3"<?php echo $document_log->transmit_no_in_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_in_sub3" class="document_log_transmit_no_in_sub3">
<span<?php echo $document_log->transmit_no_in_sub3->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_in_sub3->Visible) { // approval_status_in_sub3 ?>
		<td data-name="approval_status_in_sub3"<?php echo $document_log->approval_status_in_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_in_sub3" class="document_log_approval_status_in_sub3">
<span<?php echo $document_log->approval_status_in_sub3->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_in_sub3->Visible) { // transmit_date_in_sub3 ?>
		<td data-name="transmit_date_in_sub3"<?php echo $document_log->transmit_date_in_sub3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_in_sub3" class="document_log_transmit_date_in_sub3">
<span<?php echo $document_log->transmit_date_in_sub3->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_sub4->Visible) { // submit_no_sub4 ?>
		<td data-name="submit_no_sub4"<?php echo $document_log->submit_no_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_sub4" class="document_log_submit_no_sub4">
<span<?php echo $document_log->submit_no_sub4->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_sub4->Visible) { // revision_no_sub4 ?>
		<td data-name="revision_no_sub4"<?php echo $document_log->revision_no_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_sub4" class="document_log_revision_no_sub4">
<span<?php echo $document_log->revision_no_sub4->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_out_sub4->Visible) { // direction_out_sub4 ?>
		<td data-name="direction_out_sub4"<?php echo $document_log->direction_out_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_out_sub4" class="document_log_direction_out_sub4">
<span<?php echo $document_log->direction_out_sub4->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_out_sub4->Visible) { // planned_date_out_sub4 ?>
		<td data-name="planned_date_out_sub4"<?php echo $document_log->planned_date_out_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_out_sub4" class="document_log_planned_date_out_sub4">
<span<?php echo $document_log->planned_date_out_sub4->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_out_sub4->Visible) { // transmit_date_out_sub4 ?>
		<td data-name="transmit_date_out_sub4"<?php echo $document_log->transmit_date_out_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_out_sub4" class="document_log_transmit_date_out_sub4">
<span<?php echo $document_log->transmit_date_out_sub4->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_out_sub4->Visible) { // transmit_no_out_sub4 ?>
		<td data-name="transmit_no_out_sub4"<?php echo $document_log->transmit_no_out_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_out_sub4" class="document_log_transmit_no_out_sub4">
<span<?php echo $document_log->transmit_no_out_sub4->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_out_sub4->Visible) { // approval_status_out_sub4 ?>
		<td data-name="approval_status_out_sub4"<?php echo $document_log->approval_status_out_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_out_sub4" class="document_log_approval_status_out_sub4">
<span<?php echo $document_log->approval_status_out_sub4->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_in_sub4->Visible) { // direction_in_sub4 ?>
		<td data-name="direction_in_sub4"<?php echo $document_log->direction_in_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_in_sub4" class="document_log_direction_in_sub4">
<span<?php echo $document_log->direction_in_sub4->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_in_sub4->Visible) { // transmit_no_in_sub4 ?>
		<td data-name="transmit_no_in_sub4"<?php echo $document_log->transmit_no_in_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_in_sub4" class="document_log_transmit_no_in_sub4">
<span<?php echo $document_log->transmit_no_in_sub4->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_in_sub4->Visible) { // approval_status_in_sub4 ?>
		<td data-name="approval_status_in_sub4"<?php echo $document_log->approval_status_in_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_in_sub4" class="document_log_approval_status_in_sub4">
<span<?php echo $document_log->approval_status_in_sub4->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_in_file_sub4->Visible) { // direction_in_file_sub4 ?>
		<td data-name="direction_in_file_sub4"<?php echo $document_log->direction_in_file_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_in_file_sub4" class="document_log_direction_in_file_sub4">
<span<?php echo $document_log->direction_in_file_sub4->viewAttributes() ?>>
<?php echo $document_log->direction_in_file_sub4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_in_sub4->Visible) { // transmit_date_in_sub4 ?>
		<td data-name="transmit_date_in_sub4"<?php echo $document_log->transmit_date_in_sub4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_in_sub4" class="document_log_transmit_date_in_sub4">
<span<?php echo $document_log->transmit_date_in_sub4->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_sub5->Visible) { // submit_no_sub5 ?>
		<td data-name="submit_no_sub5"<?php echo $document_log->submit_no_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_sub5" class="document_log_submit_no_sub5">
<span<?php echo $document_log->submit_no_sub5->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_sub5->Visible) { // revision_no_sub5 ?>
		<td data-name="revision_no_sub5"<?php echo $document_log->revision_no_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_sub5" class="document_log_revision_no_sub5">
<span<?php echo $document_log->revision_no_sub5->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_out_sub5->Visible) { // direction_out_sub5 ?>
		<td data-name="direction_out_sub5"<?php echo $document_log->direction_out_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_out_sub5" class="document_log_direction_out_sub5">
<span<?php echo $document_log->direction_out_sub5->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_out_sub5->Visible) { // planned_date_out_sub5 ?>
		<td data-name="planned_date_out_sub5"<?php echo $document_log->planned_date_out_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_out_sub5" class="document_log_planned_date_out_sub5">
<span<?php echo $document_log->planned_date_out_sub5->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_out_sub5->Visible) { // transmit_date_out_sub5 ?>
		<td data-name="transmit_date_out_sub5"<?php echo $document_log->transmit_date_out_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_out_sub5" class="document_log_transmit_date_out_sub5">
<span<?php echo $document_log->transmit_date_out_sub5->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_out_sub5->Visible) { // transmit_no_out_sub5 ?>
		<td data-name="transmit_no_out_sub5"<?php echo $document_log->transmit_no_out_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_out_sub5" class="document_log_transmit_no_out_sub5">
<span<?php echo $document_log->transmit_no_out_sub5->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_out_sub5->Visible) { // approval_status_out_sub5 ?>
		<td data-name="approval_status_out_sub5"<?php echo $document_log->approval_status_out_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_out_sub5" class="document_log_approval_status_out_sub5">
<span<?php echo $document_log->approval_status_out_sub5->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_in_sub5->Visible) { // direction_in_sub5 ?>
		<td data-name="direction_in_sub5"<?php echo $document_log->direction_in_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_in_sub5" class="document_log_direction_in_sub5">
<span<?php echo $document_log->direction_in_sub5->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_in_sub5->Visible) { // transmit_no_in_sub5 ?>
		<td data-name="transmit_no_in_sub5"<?php echo $document_log->transmit_no_in_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_in_sub5" class="document_log_transmit_no_in_sub5">
<span<?php echo $document_log->transmit_no_in_sub5->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_in_sub5->Visible) { // approval_status_in_sub5 ?>
		<td data-name="approval_status_in_sub5"<?php echo $document_log->approval_status_in_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_in_sub5" class="document_log_approval_status_in_sub5">
<span<?php echo $document_log->approval_status_in_sub5->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_in_file_sub5->Visible) { // direction_in_file_sub5 ?>
		<td data-name="direction_in_file_sub5"<?php echo $document_log->direction_in_file_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_in_file_sub5" class="document_log_direction_in_file_sub5">
<span<?php echo $document_log->direction_in_file_sub5->viewAttributes() ?>>
<?php echo $document_log->direction_in_file_sub5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_in_sub5->Visible) { // transmit_date_in_sub5 ?>
		<td data-name="transmit_date_in_sub5"<?php echo $document_log->transmit_date_in_sub5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_in_sub5" class="document_log_transmit_date_in_sub5">
<span<?php echo $document_log->transmit_date_in_sub5->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_sub6->Visible) { // submit_no_sub6 ?>
		<td data-name="submit_no_sub6"<?php echo $document_log->submit_no_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_sub6" class="document_log_submit_no_sub6">
<span<?php echo $document_log->submit_no_sub6->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_sub6->Visible) { // revision_no_sub6 ?>
		<td data-name="revision_no_sub6"<?php echo $document_log->revision_no_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_sub6" class="document_log_revision_no_sub6">
<span<?php echo $document_log->revision_no_sub6->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_out_sub6->Visible) { // direction_out_sub6 ?>
		<td data-name="direction_out_sub6"<?php echo $document_log->direction_out_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_out_sub6" class="document_log_direction_out_sub6">
<span<?php echo $document_log->direction_out_sub6->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_out_sub6->Visible) { // planned_date_out_sub6 ?>
		<td data-name="planned_date_out_sub6"<?php echo $document_log->planned_date_out_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_out_sub6" class="document_log_planned_date_out_sub6">
<span<?php echo $document_log->planned_date_out_sub6->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_out_sub6->Visible) { // transmit_date_out_sub6 ?>
		<td data-name="transmit_date_out_sub6"<?php echo $document_log->transmit_date_out_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_out_sub6" class="document_log_transmit_date_out_sub6">
<span<?php echo $document_log->transmit_date_out_sub6->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_out_sub6->Visible) { // transmit_no_out_sub6 ?>
		<td data-name="transmit_no_out_sub6"<?php echo $document_log->transmit_no_out_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_out_sub6" class="document_log_transmit_no_out_sub6">
<span<?php echo $document_log->transmit_no_out_sub6->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_out_sub6->Visible) { // approval_status_out_sub6 ?>
		<td data-name="approval_status_out_sub6"<?php echo $document_log->approval_status_out_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_out_sub6" class="document_log_approval_status_out_sub6">
<span<?php echo $document_log->approval_status_out_sub6->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_in_sub6->Visible) { // direction_in_sub6 ?>
		<td data-name="direction_in_sub6"<?php echo $document_log->direction_in_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_in_sub6" class="document_log_direction_in_sub6">
<span<?php echo $document_log->direction_in_sub6->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_in_sub6->Visible) { // transmit_no_in_sub6 ?>
		<td data-name="transmit_no_in_sub6"<?php echo $document_log->transmit_no_in_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_in_sub6" class="document_log_transmit_no_in_sub6">
<span<?php echo $document_log->transmit_no_in_sub6->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_in_sub6->Visible) { // approval_status_in_sub6 ?>
		<td data-name="approval_status_in_sub6"<?php echo $document_log->approval_status_in_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_in_sub6" class="document_log_approval_status_in_sub6">
<span<?php echo $document_log->approval_status_in_sub6->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_in_file_sub6->Visible) { // direction_in_file_sub6 ?>
		<td data-name="direction_in_file_sub6"<?php echo $document_log->direction_in_file_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_in_file_sub6" class="document_log_direction_in_file_sub6">
<span<?php echo $document_log->direction_in_file_sub6->viewAttributes() ?>>
<?php echo $document_log->direction_in_file_sub6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_in_sub6->Visible) { // transmit_date_in_sub6 ?>
		<td data-name="transmit_date_in_sub6"<?php echo $document_log->transmit_date_in_sub6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_in_sub6" class="document_log_transmit_date_in_sub6">
<span<?php echo $document_log->transmit_date_in_sub6->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_sub7->Visible) { // submit_no_sub7 ?>
		<td data-name="submit_no_sub7"<?php echo $document_log->submit_no_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_sub7" class="document_log_submit_no_sub7">
<span<?php echo $document_log->submit_no_sub7->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_sub7->Visible) { // revision_no_sub7 ?>
		<td data-name="revision_no_sub7"<?php echo $document_log->revision_no_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_sub7" class="document_log_revision_no_sub7">
<span<?php echo $document_log->revision_no_sub7->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_out_sub7->Visible) { // direction_out_sub7 ?>
		<td data-name="direction_out_sub7"<?php echo $document_log->direction_out_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_out_sub7" class="document_log_direction_out_sub7">
<span<?php echo $document_log->direction_out_sub7->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_out_sub7->Visible) { // planned_date_out_sub7 ?>
		<td data-name="planned_date_out_sub7"<?php echo $document_log->planned_date_out_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_out_sub7" class="document_log_planned_date_out_sub7">
<span<?php echo $document_log->planned_date_out_sub7->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_out_sub7->Visible) { // transmit_date_out_sub7 ?>
		<td data-name="transmit_date_out_sub7"<?php echo $document_log->transmit_date_out_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_out_sub7" class="document_log_transmit_date_out_sub7">
<span<?php echo $document_log->transmit_date_out_sub7->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_out_sub7->Visible) { // transmit_no_out_sub7 ?>
		<td data-name="transmit_no_out_sub7"<?php echo $document_log->transmit_no_out_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_out_sub7" class="document_log_transmit_no_out_sub7">
<span<?php echo $document_log->transmit_no_out_sub7->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_out_sub7->Visible) { // approval_status_out_sub7 ?>
		<td data-name="approval_status_out_sub7"<?php echo $document_log->approval_status_out_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_out_sub7" class="document_log_approval_status_out_sub7">
<span<?php echo $document_log->approval_status_out_sub7->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_in_sub7->Visible) { // direction_in_sub7 ?>
		<td data-name="direction_in_sub7"<?php echo $document_log->direction_in_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_in_sub7" class="document_log_direction_in_sub7">
<span<?php echo $document_log->direction_in_sub7->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_in_sub7->Visible) { // transmit_no_in_sub7 ?>
		<td data-name="transmit_no_in_sub7"<?php echo $document_log->transmit_no_in_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_in_sub7" class="document_log_transmit_no_in_sub7">
<span<?php echo $document_log->transmit_no_in_sub7->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_in_sub7->Visible) { // approval_status_in_sub7 ?>
		<td data-name="approval_status_in_sub7"<?php echo $document_log->approval_status_in_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_in_sub7" class="document_log_approval_status_in_sub7">
<span<?php echo $document_log->approval_status_in_sub7->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_in_sub7->Visible) { // transmit_date_in_sub7 ?>
		<td data-name="transmit_date_in_sub7"<?php echo $document_log->transmit_date_in_sub7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_in_sub7" class="document_log_transmit_date_in_sub7">
<span<?php echo $document_log->transmit_date_in_sub7->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_sub8->Visible) { // submit_no_sub8 ?>
		<td data-name="submit_no_sub8"<?php echo $document_log->submit_no_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_sub8" class="document_log_submit_no_sub8">
<span<?php echo $document_log->submit_no_sub8->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_sub8->Visible) { // revision_no_sub8 ?>
		<td data-name="revision_no_sub8"<?php echo $document_log->revision_no_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_sub8" class="document_log_revision_no_sub8">
<span<?php echo $document_log->revision_no_sub8->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_out_sub8->Visible) { // direction_out_sub8 ?>
		<td data-name="direction_out_sub8"<?php echo $document_log->direction_out_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_out_sub8" class="document_log_direction_out_sub8">
<span<?php echo $document_log->direction_out_sub8->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_out_sub8->Visible) { // planned_date_out_sub8 ?>
		<td data-name="planned_date_out_sub8"<?php echo $document_log->planned_date_out_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_out_sub8" class="document_log_planned_date_out_sub8">
<span<?php echo $document_log->planned_date_out_sub8->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_out_sub8->Visible) { // transmit_date_out_sub8 ?>
		<td data-name="transmit_date_out_sub8"<?php echo $document_log->transmit_date_out_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_out_sub8" class="document_log_transmit_date_out_sub8">
<span<?php echo $document_log->transmit_date_out_sub8->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_out_sub8->Visible) { // transmit_no_out_sub8 ?>
		<td data-name="transmit_no_out_sub8"<?php echo $document_log->transmit_no_out_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_out_sub8" class="document_log_transmit_no_out_sub8">
<span<?php echo $document_log->transmit_no_out_sub8->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_out_sub8->Visible) { // approval_status_out_sub8 ?>
		<td data-name="approval_status_out_sub8"<?php echo $document_log->approval_status_out_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_out_sub8" class="document_log_approval_status_out_sub8">
<span<?php echo $document_log->approval_status_out_sub8->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_out_file_sub8->Visible) { // direction_out_file_sub8 ?>
		<td data-name="direction_out_file_sub8"<?php echo $document_log->direction_out_file_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_out_file_sub8" class="document_log_direction_out_file_sub8">
<span<?php echo $document_log->direction_out_file_sub8->viewAttributes() ?>>
<?php echo $document_log->direction_out_file_sub8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_in_sub8->Visible) { // direction_in_sub8 ?>
		<td data-name="direction_in_sub8"<?php echo $document_log->direction_in_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_in_sub8" class="document_log_direction_in_sub8">
<span<?php echo $document_log->direction_in_sub8->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_in_sub8->Visible) { // transmit_no_in_sub8 ?>
		<td data-name="transmit_no_in_sub8"<?php echo $document_log->transmit_no_in_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_in_sub8" class="document_log_transmit_no_in_sub8">
<span<?php echo $document_log->transmit_no_in_sub8->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_in_sub8->Visible) { // approval_status_in_sub8 ?>
		<td data-name="approval_status_in_sub8"<?php echo $document_log->approval_status_in_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_in_sub8" class="document_log_approval_status_in_sub8">
<span<?php echo $document_log->approval_status_in_sub8->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_in_sub8->Visible) { // transmit_date_in_sub8 ?>
		<td data-name="transmit_date_in_sub8"<?php echo $document_log->transmit_date_in_sub8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_in_sub8" class="document_log_transmit_date_in_sub8">
<span<?php echo $document_log->transmit_date_in_sub8->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_sub9->Visible) { // submit_no_sub9 ?>
		<td data-name="submit_no_sub9"<?php echo $document_log->submit_no_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_sub9" class="document_log_submit_no_sub9">
<span<?php echo $document_log->submit_no_sub9->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_sub9->Visible) { // revision_no_sub9 ?>
		<td data-name="revision_no_sub9"<?php echo $document_log->revision_no_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_sub9" class="document_log_revision_no_sub9">
<span<?php echo $document_log->revision_no_sub9->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_out_sub9->Visible) { // direction_out_sub9 ?>
		<td data-name="direction_out_sub9"<?php echo $document_log->direction_out_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_out_sub9" class="document_log_direction_out_sub9">
<span<?php echo $document_log->direction_out_sub9->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_out_sub9->Visible) { // planned_date_out_sub9 ?>
		<td data-name="planned_date_out_sub9"<?php echo $document_log->planned_date_out_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_out_sub9" class="document_log_planned_date_out_sub9">
<span<?php echo $document_log->planned_date_out_sub9->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_out_sub9->Visible) { // transmit_date_out_sub9 ?>
		<td data-name="transmit_date_out_sub9"<?php echo $document_log->transmit_date_out_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_out_sub9" class="document_log_transmit_date_out_sub9">
<span<?php echo $document_log->transmit_date_out_sub9->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_out_sub9->Visible) { // transmit_no_out_sub9 ?>
		<td data-name="transmit_no_out_sub9"<?php echo $document_log->transmit_no_out_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_out_sub9" class="document_log_transmit_no_out_sub9">
<span<?php echo $document_log->transmit_no_out_sub9->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_out_sub9->Visible) { // approval_status_out_sub9 ?>
		<td data-name="approval_status_out_sub9"<?php echo $document_log->approval_status_out_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_out_sub9" class="document_log_approval_status_out_sub9">
<span<?php echo $document_log->approval_status_out_sub9->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_in_sub9->Visible) { // direction_in_sub9 ?>
		<td data-name="direction_in_sub9"<?php echo $document_log->direction_in_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_in_sub9" class="document_log_direction_in_sub9">
<span<?php echo $document_log->direction_in_sub9->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_in_sub9->Visible) { // transmit_no_in_sub9 ?>
		<td data-name="transmit_no_in_sub9"<?php echo $document_log->transmit_no_in_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_in_sub9" class="document_log_transmit_no_in_sub9">
<span<?php echo $document_log->transmit_no_in_sub9->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_in_sub9->Visible) { // approval_status_in_sub9 ?>
		<td data-name="approval_status_in_sub9"<?php echo $document_log->approval_status_in_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_in_sub9" class="document_log_approval_status_in_sub9">
<span<?php echo $document_log->approval_status_in_sub9->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_in_sub9->Visible) { // transmit_date_in_sub9 ?>
		<td data-name="transmit_date_in_sub9"<?php echo $document_log->transmit_date_in_sub9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_in_sub9" class="document_log_transmit_date_in_sub9">
<span<?php echo $document_log->transmit_date_in_sub9->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_sub10->Visible) { // submit_no_sub10 ?>
		<td data-name="submit_no_sub10"<?php echo $document_log->submit_no_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_sub10" class="document_log_submit_no_sub10">
<span<?php echo $document_log->submit_no_sub10->viewAttributes() ?>>
<?php echo $document_log->submit_no_sub10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_sub10->Visible) { // revision_no_sub10 ?>
		<td data-name="revision_no_sub10"<?php echo $document_log->revision_no_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_sub10" class="document_log_revision_no_sub10">
<span<?php echo $document_log->revision_no_sub10->viewAttributes() ?>>
<?php echo $document_log->revision_no_sub10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_out_sub10->Visible) { // direction_out_sub10 ?>
		<td data-name="direction_out_sub10"<?php echo $document_log->direction_out_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_out_sub10" class="document_log_direction_out_sub10">
<span<?php echo $document_log->direction_out_sub10->viewAttributes() ?>>
<?php echo $document_log->direction_out_sub10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_out_sub10->Visible) { // planned_date_out_sub10 ?>
		<td data-name="planned_date_out_sub10"<?php echo $document_log->planned_date_out_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_out_sub10" class="document_log_planned_date_out_sub10">
<span<?php echo $document_log->planned_date_out_sub10->viewAttributes() ?>>
<?php echo $document_log->planned_date_out_sub10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_out_sub10->Visible) { // transmit_date_out_sub10 ?>
		<td data-name="transmit_date_out_sub10"<?php echo $document_log->transmit_date_out_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_out_sub10" class="document_log_transmit_date_out_sub10">
<span<?php echo $document_log->transmit_date_out_sub10->viewAttributes() ?>>
<?php echo $document_log->transmit_date_out_sub10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_out_sub10->Visible) { // transmit_no_out_sub10 ?>
		<td data-name="transmit_no_out_sub10"<?php echo $document_log->transmit_no_out_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_out_sub10" class="document_log_transmit_no_out_sub10">
<span<?php echo $document_log->transmit_no_out_sub10->viewAttributes() ?>>
<?php echo $document_log->transmit_no_out_sub10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_out_sub10->Visible) { // approval_status_out_sub10 ?>
		<td data-name="approval_status_out_sub10"<?php echo $document_log->approval_status_out_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_out_sub10" class="document_log_approval_status_out_sub10">
<span<?php echo $document_log->approval_status_out_sub10->viewAttributes() ?>>
<?php echo $document_log->approval_status_out_sub10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_in_sub10->Visible) { // direction_in_sub10 ?>
		<td data-name="direction_in_sub10"<?php echo $document_log->direction_in_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_in_sub10" class="document_log_direction_in_sub10">
<span<?php echo $document_log->direction_in_sub10->viewAttributes() ?>>
<?php echo $document_log->direction_in_sub10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_in_sub10->Visible) { // transmit_no_in_sub10 ?>
		<td data-name="transmit_no_in_sub10"<?php echo $document_log->transmit_no_in_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_in_sub10" class="document_log_transmit_no_in_sub10">
<span<?php echo $document_log->transmit_no_in_sub10->viewAttributes() ?>>
<?php echo $document_log->transmit_no_in_sub10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_in_sub10->Visible) { // approval_status_in_sub10 ?>
		<td data-name="approval_status_in_sub10"<?php echo $document_log->approval_status_in_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_in_sub10" class="document_log_approval_status_in_sub10">
<span<?php echo $document_log->approval_status_in_sub10->viewAttributes() ?>>
<?php echo $document_log->approval_status_in_sub10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_in_sub10->Visible) { // transmit_date_in_sub10 ?>
		<td data-name="transmit_date_in_sub10"<?php echo $document_log->transmit_date_in_sub10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_in_sub10" class="document_log_transmit_date_in_sub10">
<span<?php echo $document_log->transmit_date_in_sub10->viewAttributes() ?>>
<?php echo $document_log->transmit_date_in_sub10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->log_updatedon->Visible) { // log_updatedon ?>
		<td data-name="log_updatedon"<?php echo $document_log->log_updatedon->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_log_updatedon" class="document_log_log_updatedon">
<span<?php echo $document_log->log_updatedon->viewAttributes() ?>>
<?php echo $document_log->log_updatedon->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$document_log_list->ListOptions->render("body", "right", $document_log_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$document_log->isGridAdd())
		$document_log_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$document_log->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($document_log_list->Recordset)
	$document_log_list->Recordset->Close();
?>
<?php if (!$document_log->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$document_log->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($document_log_list->Pager)) $document_log_list->Pager = new NumericPager($document_log_list->StartRec, $document_log_list->DisplayRecs, $document_log_list->TotalRecs, $document_log_list->RecRange, $document_log_list->AutoHidePager) ?>
<?php if ($document_log_list->Pager->RecordCount > 0 && $document_log_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($document_log_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_list->pageUrl() ?>start=<?php echo $document_log_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($document_log_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_list->pageUrl() ?>start=<?php echo $document_log_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($document_log_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $document_log_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($document_log_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_list->pageUrl() ?>start=<?php echo $document_log_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($document_log_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_log_list->pageUrl() ?>start=<?php echo $document_log_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($document_log_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $document_log_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $document_log_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $document_log_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $document_log_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($document_log_list->TotalRecs == 0 && !$document_log->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $document_log_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$document_log_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$document_log->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php if (!$document_log->isExport()) { ?>
<script>
ew.scrollableTable("gmp_document_log", "100%", "100%");
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$document_log_list->terminate();
?>