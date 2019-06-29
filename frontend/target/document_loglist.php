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
fdocument_loglist.lists["x_approval_status_1"] = <?php echo $document_log_list->approval_status_1->Lookup->toClientList() ?>;
fdocument_loglist.lists["x_approval_status_1"].options = <?php echo JsonEncode($document_log_list->approval_status_1->lookupOptions()) ?>;
fdocument_loglist.autoSuggests["x_approval_status_1"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdocument_loglist.lists["x_approval_status_2"] = <?php echo $document_log_list->approval_status_2->Lookup->toClientList() ?>;
fdocument_loglist.lists["x_approval_status_2"].options = <?php echo JsonEncode($document_log_list->approval_status_2->lookupOptions()) ?>;
fdocument_loglist.autoSuggests["x_approval_status_2"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdocument_loglist.lists["x_approval_status_3"] = <?php echo $document_log_list->approval_status_3->Lookup->toClientList() ?>;
fdocument_loglist.lists["x_approval_status_3"].options = <?php echo JsonEncode($document_log_list->approval_status_3->lookupOptions()) ?>;
fdocument_loglist.autoSuggests["x_approval_status_3"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdocument_loglist.lists["x_approval_status_4"] = <?php echo $document_log_list->approval_status_4->Lookup->toClientList() ?>;
fdocument_loglist.lists["x_approval_status_4"].options = <?php echo JsonEncode($document_log_list->approval_status_4->lookupOptions()) ?>;
fdocument_loglist.autoSuggests["x_approval_status_4"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdocument_loglist.lists["x_approval_status_5"] = <?php echo $document_log_list->approval_status_5->Lookup->toClientList() ?>;
fdocument_loglist.lists["x_approval_status_5"].options = <?php echo JsonEncode($document_log_list->approval_status_5->lookupOptions()) ?>;
fdocument_loglist.autoSuggests["x_approval_status_5"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdocument_loglist.lists["x_approval_status_6"] = <?php echo $document_log_list->approval_status_6->Lookup->toClientList() ?>;
fdocument_loglist.lists["x_approval_status_6"].options = <?php echo JsonEncode($document_log_list->approval_status_6->lookupOptions()) ?>;
fdocument_loglist.autoSuggests["x_approval_status_6"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdocument_loglist.lists["x_approval_status_7"] = <?php echo $document_log_list->approval_status_7->Lookup->toClientList() ?>;
fdocument_loglist.lists["x_approval_status_7"].options = <?php echo JsonEncode($document_log_list->approval_status_7->lookupOptions()) ?>;
fdocument_loglist.autoSuggests["x_approval_status_7"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdocument_loglist.lists["x_approval_status_8"] = <?php echo $document_log_list->approval_status_8->Lookup->toClientList() ?>;
fdocument_loglist.lists["x_approval_status_8"].options = <?php echo JsonEncode($document_log_list->approval_status_8->lookupOptions()) ?>;
fdocument_loglist.autoSuggests["x_approval_status_8"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdocument_loglist.lists["x_approval_status_9"] = <?php echo $document_log_list->approval_status_9->Lookup->toClientList() ?>;
fdocument_loglist.lists["x_approval_status_9"].options = <?php echo JsonEncode($document_log_list->approval_status_9->lookupOptions()) ?>;
fdocument_loglist.autoSuggests["x_approval_status_9"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdocument_loglist.lists["x_approval_status_10"] = <?php echo $document_log_list->approval_status_10->Lookup->toClientList() ?>;
fdocument_loglist.lists["x_approval_status_10"].options = <?php echo JsonEncode($document_log_list->approval_status_10->lookupOptions()) ?>;
fdocument_loglist.autoSuggests["x_approval_status_10"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var fdocument_loglistsrch = currentSearchForm = new ew.Form("fdocument_loglistsrch");

// Validate function for search
fdocument_loglistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fdocument_loglistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_loglistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
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
<?php
if ($SearchError == "")
	$document_log_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$document_log->RowType = ROWTYPE_SEARCH;

// Render row
$document_log->resetAttributes();
$document_log_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($document_log->firelink_doc_no->Visible) { // firelink_doc_no ?>
	<div id="xsc_firelink_doc_no" class="ew-cell form-group">
		<label for="x_firelink_doc_no" class="ew-search-caption ew-label"><?php echo $document_log->firelink_doc_no->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_firelink_doc_no" id="z_firelink_doc_no" value="LIKE"></span>
		<span class="ew-search-field">
<input type="text" data-table="document_log" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_log->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_log->firelink_doc_no->EditValue ?>"<?php echo $document_log->firelink_doc_no->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($document_log->client_doc_no->Visible) { // client_doc_no ?>
	<div id="xsc_client_doc_no" class="ew-cell form-group">
		<label for="x_client_doc_no" class="ew-search-caption ew-label"><?php echo $document_log->client_doc_no->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_client_doc_no" id="z_client_doc_no" value="LIKE"></span>
		<span class="ew-search-field">
<input type="text" data-table="document_log" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_log->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_log->client_doc_no->EditValue ?>"<?php echo $document_log->client_doc_no->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
<?php if ($document_log->order_number->Visible) { // order_number ?>
	<div id="xsc_order_number" class="ew-cell form-group">
		<label for="x_order_number" class="ew-search-caption ew-label"><?php echo $document_log->order_number->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_order_number" id="z_order_number" value="LIKE"></span>
		<span class="ew-search-field">
<input type="text" data-table="document_log" data-field="x_order_number" name="x_order_number" id="x_order_number" size="30" placeholder="<?php echo HtmlEncode($document_log->order_number->getPlaceHolder()) ?>" value="<?php echo $document_log->order_number->EditValue ?>"<?php echo $document_log->order_number->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_4" class="ew-row d-sm-flex">
<?php if ($document_log->project_name->Visible) { // project_name ?>
	<div id="xsc_project_name" class="ew-cell form-group">
		<label for="x_project_name" class="ew-search-caption ew-label"><?php echo $document_log->project_name->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_project_name" id="z_project_name" value="LIKE"></span>
		<span class="ew-search-field">
<input type="text" data-table="document_log" data-field="x_project_name" name="x_project_name" id="x_project_name" size="30" placeholder="<?php echo HtmlEncode($document_log->project_name->getPlaceHolder()) ?>" value="<?php echo $document_log->project_name->EditValue ?>"<?php echo $document_log->project_name->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_5" class="ew-row d-sm-flex">
<?php if ($document_log->document_tittle->Visible) { // document_tittle ?>
	<div id="xsc_document_tittle" class="ew-cell form-group">
		<label for="x_document_tittle" class="ew-search-caption ew-label"><?php echo $document_log->document_tittle->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_document_tittle" id="z_document_tittle" value="LIKE"></span>
		<span class="ew-search-field">
<input type="text" data-table="document_log" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_log->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_log->document_tittle->EditValue ?>"<?php echo $document_log->document_tittle->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_6" class="ew-row d-sm-flex">
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
<?php if ($document_log->submit_no_1->Visible) { // submit_no_1 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_1) == "") { ?>
		<th data-name="submit_no_1" class="<?php echo $document_log->submit_no_1->headerCellClass() ?>"><div id="elh_document_log_submit_no_1" class="document_log_submit_no_1"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_1" class="<?php echo $document_log->submit_no_1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_1) ?>',2);"><div id="elh_document_log_submit_no_1" class="document_log_submit_no_1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_1->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_1->Visible) { // revision_no_1 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_1) == "") { ?>
		<th data-name="revision_no_1" class="<?php echo $document_log->revision_no_1->headerCellClass() ?>"><div id="elh_document_log_revision_no_1" class="document_log_revision_no_1"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_1" class="<?php echo $document_log->revision_no_1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_1) ?>',2);"><div id="elh_document_log_revision_no_1" class="document_log_revision_no_1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_1->Visible) { // direction_1 ?>
	<?php if ($document_log->sortUrl($document_log->direction_1) == "") { ?>
		<th data-name="direction_1" class="<?php echo $document_log->direction_1->headerCellClass() ?>"><div id="elh_document_log_direction_1" class="document_log_direction_1"><div class="ew-table-header-caption"><?php echo $document_log->direction_1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_1" class="<?php echo $document_log->direction_1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_1) ?>',2);"><div id="elh_document_log_direction_1" class="document_log_direction_1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_1->Visible) { // planned_date_1 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_1) == "") { ?>
		<th data-name="planned_date_1" class="<?php echo $document_log->planned_date_1->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_document_log_planned_date_1" class="document_log_planned_date_1"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_1" class="<?php echo $document_log->planned_date_1->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_1) ?>',2);"><div id="elh_document_log_planned_date_1" class="document_log_planned_date_1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_1->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_1->Visible) { // transmit_date_1 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_1) == "") { ?>
		<th data-name="transmit_date_1" class="<?php echo $document_log->transmit_date_1->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_document_log_transmit_date_1" class="document_log_transmit_date_1"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_1" class="<?php echo $document_log->transmit_date_1->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_1) ?>',2);"><div id="elh_document_log_transmit_date_1" class="document_log_transmit_date_1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_1->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_1->Visible) { // transmit_no_1 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_1) == "") { ?>
		<th data-name="transmit_no_1" class="<?php echo $document_log->transmit_no_1->headerCellClass() ?>"><div id="elh_document_log_transmit_no_1" class="document_log_transmit_no_1"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_1" class="<?php echo $document_log->transmit_no_1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_1) ?>',2);"><div id="elh_document_log_transmit_no_1" class="document_log_transmit_no_1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_1->Visible) { // approval_status_1 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_1) == "") { ?>
		<th data-name="approval_status_1" class="<?php echo $document_log->approval_status_1->headerCellClass() ?>"><div id="elh_document_log_approval_status_1" class="document_log_approval_status_1"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_1" class="<?php echo $document_log->approval_status_1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_1) ?>',2);"><div id="elh_document_log_approval_status_1" class="document_log_approval_status_1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_2->Visible) { // submit_no_2 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_2) == "") { ?>
		<th data-name="submit_no_2" class="<?php echo $document_log->submit_no_2->headerCellClass() ?>"><div id="elh_document_log_submit_no_2" class="document_log_submit_no_2"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_2" class="<?php echo $document_log->submit_no_2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_2) ?>',2);"><div id="elh_document_log_submit_no_2" class="document_log_submit_no_2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_2->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_2->Visible) { // revision_no_2 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_2) == "") { ?>
		<th data-name="revision_no_2" class="<?php echo $document_log->revision_no_2->headerCellClass() ?>"><div id="elh_document_log_revision_no_2" class="document_log_revision_no_2"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_2" class="<?php echo $document_log->revision_no_2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_2) ?>',2);"><div id="elh_document_log_revision_no_2" class="document_log_revision_no_2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_2->Visible) { // direction_2 ?>
	<?php if ($document_log->sortUrl($document_log->direction_2) == "") { ?>
		<th data-name="direction_2" class="<?php echo $document_log->direction_2->headerCellClass() ?>"><div id="elh_document_log_direction_2" class="document_log_direction_2"><div class="ew-table-header-caption"><?php echo $document_log->direction_2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_2" class="<?php echo $document_log->direction_2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_2) ?>',2);"><div id="elh_document_log_direction_2" class="document_log_direction_2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_2->Visible) { // planned_date_2 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_2) == "") { ?>
		<th data-name="planned_date_2" class="<?php echo $document_log->planned_date_2->headerCellClass() ?>"><div id="elh_document_log_planned_date_2" class="document_log_planned_date_2"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_2" class="<?php echo $document_log->planned_date_2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_2) ?>',2);"><div id="elh_document_log_planned_date_2" class="document_log_planned_date_2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_2->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_2->Visible) { // transmit_date_2 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_2) == "") { ?>
		<th data-name="transmit_date_2" class="<?php echo $document_log->transmit_date_2->headerCellClass() ?>"><div id="elh_document_log_transmit_date_2" class="document_log_transmit_date_2"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_2" class="<?php echo $document_log->transmit_date_2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_2) ?>',2);"><div id="elh_document_log_transmit_date_2" class="document_log_transmit_date_2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_2->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_2->Visible) { // transmit_no_2 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_2) == "") { ?>
		<th data-name="transmit_no_2" class="<?php echo $document_log->transmit_no_2->headerCellClass() ?>"><div id="elh_document_log_transmit_no_2" class="document_log_transmit_no_2"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_2" class="<?php echo $document_log->transmit_no_2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_2) ?>',2);"><div id="elh_document_log_transmit_no_2" class="document_log_transmit_no_2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_2->Visible) { // approval_status_2 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_2) == "") { ?>
		<th data-name="approval_status_2" class="<?php echo $document_log->approval_status_2->headerCellClass() ?>"><div id="elh_document_log_approval_status_2" class="document_log_approval_status_2"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_2" class="<?php echo $document_log->approval_status_2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_2) ?>',2);"><div id="elh_document_log_approval_status_2" class="document_log_approval_status_2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_3->Visible) { // submit_no_3 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_3) == "") { ?>
		<th data-name="submit_no_3" class="<?php echo $document_log->submit_no_3->headerCellClass() ?>"><div id="elh_document_log_submit_no_3" class="document_log_submit_no_3"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_3" class="<?php echo $document_log->submit_no_3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_3) ?>',2);"><div id="elh_document_log_submit_no_3" class="document_log_submit_no_3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_3->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_3->Visible) { // revision_no_3 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_3) == "") { ?>
		<th data-name="revision_no_3" class="<?php echo $document_log->revision_no_3->headerCellClass() ?>"><div id="elh_document_log_revision_no_3" class="document_log_revision_no_3"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_3" class="<?php echo $document_log->revision_no_3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_3) ?>',2);"><div id="elh_document_log_revision_no_3" class="document_log_revision_no_3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_3->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_3->Visible) { // direction_3 ?>
	<?php if ($document_log->sortUrl($document_log->direction_3) == "") { ?>
		<th data-name="direction_3" class="<?php echo $document_log->direction_3->headerCellClass() ?>"><div id="elh_document_log_direction_3" class="document_log_direction_3"><div class="ew-table-header-caption"><?php echo $document_log->direction_3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_3" class="<?php echo $document_log->direction_3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_3) ?>',2);"><div id="elh_document_log_direction_3" class="document_log_direction_3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_3->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_3->Visible) { // planned_date_3 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_3) == "") { ?>
		<th data-name="planned_date_3" class="<?php echo $document_log->planned_date_3->headerCellClass() ?>"><div id="elh_document_log_planned_date_3" class="document_log_planned_date_3"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_3" class="<?php echo $document_log->planned_date_3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_3) ?>',2);"><div id="elh_document_log_planned_date_3" class="document_log_planned_date_3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_3->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_3->Visible) { // transmit_date_3 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_3) == "") { ?>
		<th data-name="transmit_date_3" class="<?php echo $document_log->transmit_date_3->headerCellClass() ?>"><div id="elh_document_log_transmit_date_3" class="document_log_transmit_date_3"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_3" class="<?php echo $document_log->transmit_date_3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_3) ?>',2);"><div id="elh_document_log_transmit_date_3" class="document_log_transmit_date_3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_3->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_3->Visible) { // transmit_no_3 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_3) == "") { ?>
		<th data-name="transmit_no_3" class="<?php echo $document_log->transmit_no_3->headerCellClass() ?>"><div id="elh_document_log_transmit_no_3" class="document_log_transmit_no_3"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_3" class="<?php echo $document_log->transmit_no_3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_3) ?>',2);"><div id="elh_document_log_transmit_no_3" class="document_log_transmit_no_3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_3->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_3->Visible) { // approval_status_3 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_3) == "") { ?>
		<th data-name="approval_status_3" class="<?php echo $document_log->approval_status_3->headerCellClass() ?>"><div id="elh_document_log_approval_status_3" class="document_log_approval_status_3"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_3" class="<?php echo $document_log->approval_status_3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_3) ?>',2);"><div id="elh_document_log_approval_status_3" class="document_log_approval_status_3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_3->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_3->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_3->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_4->Visible) { // submit_no_4 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_4) == "") { ?>
		<th data-name="submit_no_4" class="<?php echo $document_log->submit_no_4->headerCellClass() ?>"><div id="elh_document_log_submit_no_4" class="document_log_submit_no_4"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_4" class="<?php echo $document_log->submit_no_4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_4) ?>',2);"><div id="elh_document_log_submit_no_4" class="document_log_submit_no_4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_4->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_4->Visible) { // revision_no_4 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_4) == "") { ?>
		<th data-name="revision_no_4" class="<?php echo $document_log->revision_no_4->headerCellClass() ?>"><div id="elh_document_log_revision_no_4" class="document_log_revision_no_4"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_4" class="<?php echo $document_log->revision_no_4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_4) ?>',2);"><div id="elh_document_log_revision_no_4" class="document_log_revision_no_4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_4->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_4->Visible) { // direction_4 ?>
	<?php if ($document_log->sortUrl($document_log->direction_4) == "") { ?>
		<th data-name="direction_4" class="<?php echo $document_log->direction_4->headerCellClass() ?>"><div id="elh_document_log_direction_4" class="document_log_direction_4"><div class="ew-table-header-caption"><?php echo $document_log->direction_4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_4" class="<?php echo $document_log->direction_4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_4) ?>',2);"><div id="elh_document_log_direction_4" class="document_log_direction_4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_4->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_4->Visible) { // planned_date_4 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_4) == "") { ?>
		<th data-name="planned_date_4" class="<?php echo $document_log->planned_date_4->headerCellClass() ?>"><div id="elh_document_log_planned_date_4" class="document_log_planned_date_4"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_4" class="<?php echo $document_log->planned_date_4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_4) ?>',2);"><div id="elh_document_log_planned_date_4" class="document_log_planned_date_4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_4->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_4->Visible) { // transmit_date_4 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_4) == "") { ?>
		<th data-name="transmit_date_4" class="<?php echo $document_log->transmit_date_4->headerCellClass() ?>"><div id="elh_document_log_transmit_date_4" class="document_log_transmit_date_4"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_4" class="<?php echo $document_log->transmit_date_4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_4) ?>',2);"><div id="elh_document_log_transmit_date_4" class="document_log_transmit_date_4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_4->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_4->Visible) { // transmit_no_4 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_4) == "") { ?>
		<th data-name="transmit_no_4" class="<?php echo $document_log->transmit_no_4->headerCellClass() ?>"><div id="elh_document_log_transmit_no_4" class="document_log_transmit_no_4"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_4" class="<?php echo $document_log->transmit_no_4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_4) ?>',2);"><div id="elh_document_log_transmit_no_4" class="document_log_transmit_no_4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_4->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_4->Visible) { // approval_status_4 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_4) == "") { ?>
		<th data-name="approval_status_4" class="<?php echo $document_log->approval_status_4->headerCellClass() ?>"><div id="elh_document_log_approval_status_4" class="document_log_approval_status_4"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_4" class="<?php echo $document_log->approval_status_4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_4) ?>',2);"><div id="elh_document_log_approval_status_4" class="document_log_approval_status_4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_4->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_4->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_4->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_5->Visible) { // submit_no_5 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_5) == "") { ?>
		<th data-name="submit_no_5" class="<?php echo $document_log->submit_no_5->headerCellClass() ?>"><div id="elh_document_log_submit_no_5" class="document_log_submit_no_5"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_5" class="<?php echo $document_log->submit_no_5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_5) ?>',2);"><div id="elh_document_log_submit_no_5" class="document_log_submit_no_5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_5->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_5->Visible) { // revision_no_5 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_5) == "") { ?>
		<th data-name="revision_no_5" class="<?php echo $document_log->revision_no_5->headerCellClass() ?>"><div id="elh_document_log_revision_no_5" class="document_log_revision_no_5"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_5" class="<?php echo $document_log->revision_no_5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_5) ?>',2);"><div id="elh_document_log_revision_no_5" class="document_log_revision_no_5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_5->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_5->Visible) { // direction_5 ?>
	<?php if ($document_log->sortUrl($document_log->direction_5) == "") { ?>
		<th data-name="direction_5" class="<?php echo $document_log->direction_5->headerCellClass() ?>"><div id="elh_document_log_direction_5" class="document_log_direction_5"><div class="ew-table-header-caption"><?php echo $document_log->direction_5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_5" class="<?php echo $document_log->direction_5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_5) ?>',2);"><div id="elh_document_log_direction_5" class="document_log_direction_5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_5->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_5->Visible) { // planned_date_5 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_5) == "") { ?>
		<th data-name="planned_date_5" class="<?php echo $document_log->planned_date_5->headerCellClass() ?>"><div id="elh_document_log_planned_date_5" class="document_log_planned_date_5"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_5" class="<?php echo $document_log->planned_date_5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_5) ?>',2);"><div id="elh_document_log_planned_date_5" class="document_log_planned_date_5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_5->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_5->Visible) { // transmit_date_5 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_5) == "") { ?>
		<th data-name="transmit_date_5" class="<?php echo $document_log->transmit_date_5->headerCellClass() ?>"><div id="elh_document_log_transmit_date_5" class="document_log_transmit_date_5"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_5" class="<?php echo $document_log->transmit_date_5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_5) ?>',2);"><div id="elh_document_log_transmit_date_5" class="document_log_transmit_date_5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_5->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_5->Visible) { // transmit_no_5 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_5) == "") { ?>
		<th data-name="transmit_no_5" class="<?php echo $document_log->transmit_no_5->headerCellClass() ?>"><div id="elh_document_log_transmit_no_5" class="document_log_transmit_no_5"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_5" class="<?php echo $document_log->transmit_no_5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_5) ?>',2);"><div id="elh_document_log_transmit_no_5" class="document_log_transmit_no_5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_5->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_5->Visible) { // approval_status_5 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_5) == "") { ?>
		<th data-name="approval_status_5" class="<?php echo $document_log->approval_status_5->headerCellClass() ?>"><div id="elh_document_log_approval_status_5" class="document_log_approval_status_5"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_5" class="<?php echo $document_log->approval_status_5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_5) ?>',2);"><div id="elh_document_log_approval_status_5" class="document_log_approval_status_5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_5->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_5->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_5->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_6->Visible) { // submit_no_6 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_6) == "") { ?>
		<th data-name="submit_no_6" class="<?php echo $document_log->submit_no_6->headerCellClass() ?>"><div id="elh_document_log_submit_no_6" class="document_log_submit_no_6"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_6" class="<?php echo $document_log->submit_no_6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_6) ?>',2);"><div id="elh_document_log_submit_no_6" class="document_log_submit_no_6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_6->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_6->Visible) { // revision_no_6 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_6) == "") { ?>
		<th data-name="revision_no_6" class="<?php echo $document_log->revision_no_6->headerCellClass() ?>"><div id="elh_document_log_revision_no_6" class="document_log_revision_no_6"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_6" class="<?php echo $document_log->revision_no_6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_6) ?>',2);"><div id="elh_document_log_revision_no_6" class="document_log_revision_no_6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_6->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_6->Visible) { // direction_6 ?>
	<?php if ($document_log->sortUrl($document_log->direction_6) == "") { ?>
		<th data-name="direction_6" class="<?php echo $document_log->direction_6->headerCellClass() ?>"><div id="elh_document_log_direction_6" class="document_log_direction_6"><div class="ew-table-header-caption"><?php echo $document_log->direction_6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_6" class="<?php echo $document_log->direction_6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_6) ?>',2);"><div id="elh_document_log_direction_6" class="document_log_direction_6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_6->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_6->Visible) { // planned_date_6 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_6) == "") { ?>
		<th data-name="planned_date_6" class="<?php echo $document_log->planned_date_6->headerCellClass() ?>"><div id="elh_document_log_planned_date_6" class="document_log_planned_date_6"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_6" class="<?php echo $document_log->planned_date_6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_6) ?>',2);"><div id="elh_document_log_planned_date_6" class="document_log_planned_date_6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_6->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_6->Visible) { // transmit_date_6 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_6) == "") { ?>
		<th data-name="transmit_date_6" class="<?php echo $document_log->transmit_date_6->headerCellClass() ?>"><div id="elh_document_log_transmit_date_6" class="document_log_transmit_date_6"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_6" class="<?php echo $document_log->transmit_date_6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_6) ?>',2);"><div id="elh_document_log_transmit_date_6" class="document_log_transmit_date_6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_6->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_6->Visible) { // transmit_no_6 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_6) == "") { ?>
		<th data-name="transmit_no_6" class="<?php echo $document_log->transmit_no_6->headerCellClass() ?>"><div id="elh_document_log_transmit_no_6" class="document_log_transmit_no_6"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_6" class="<?php echo $document_log->transmit_no_6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_6) ?>',2);"><div id="elh_document_log_transmit_no_6" class="document_log_transmit_no_6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_6->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_6->Visible) { // approval_status_6 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_6) == "") { ?>
		<th data-name="approval_status_6" class="<?php echo $document_log->approval_status_6->headerCellClass() ?>"><div id="elh_document_log_approval_status_6" class="document_log_approval_status_6"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_6" class="<?php echo $document_log->approval_status_6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_6) ?>',2);"><div id="elh_document_log_approval_status_6" class="document_log_approval_status_6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_6->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_6->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_6->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_7->Visible) { // submit_no_7 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_7) == "") { ?>
		<th data-name="submit_no_7" class="<?php echo $document_log->submit_no_7->headerCellClass() ?>"><div id="elh_document_log_submit_no_7" class="document_log_submit_no_7"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_7" class="<?php echo $document_log->submit_no_7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_7) ?>',2);"><div id="elh_document_log_submit_no_7" class="document_log_submit_no_7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_7->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_7->Visible) { // revision_no_7 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_7) == "") { ?>
		<th data-name="revision_no_7" class="<?php echo $document_log->revision_no_7->headerCellClass() ?>"><div id="elh_document_log_revision_no_7" class="document_log_revision_no_7"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_7" class="<?php echo $document_log->revision_no_7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_7) ?>',2);"><div id="elh_document_log_revision_no_7" class="document_log_revision_no_7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_7->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_7->Visible) { // direction_7 ?>
	<?php if ($document_log->sortUrl($document_log->direction_7) == "") { ?>
		<th data-name="direction_7" class="<?php echo $document_log->direction_7->headerCellClass() ?>"><div id="elh_document_log_direction_7" class="document_log_direction_7"><div class="ew-table-header-caption"><?php echo $document_log->direction_7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_7" class="<?php echo $document_log->direction_7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_7) ?>',2);"><div id="elh_document_log_direction_7" class="document_log_direction_7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_7->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_7->Visible) { // planned_date_7 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_7) == "") { ?>
		<th data-name="planned_date_7" class="<?php echo $document_log->planned_date_7->headerCellClass() ?>"><div id="elh_document_log_planned_date_7" class="document_log_planned_date_7"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_7" class="<?php echo $document_log->planned_date_7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_7) ?>',2);"><div id="elh_document_log_planned_date_7" class="document_log_planned_date_7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_7->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_7->Visible) { // transmit_date_7 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_7) == "") { ?>
		<th data-name="transmit_date_7" class="<?php echo $document_log->transmit_date_7->headerCellClass() ?>"><div id="elh_document_log_transmit_date_7" class="document_log_transmit_date_7"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_7" class="<?php echo $document_log->transmit_date_7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_7) ?>',2);"><div id="elh_document_log_transmit_date_7" class="document_log_transmit_date_7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_7->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_7->Visible) { // transmit_no_7 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_7) == "") { ?>
		<th data-name="transmit_no_7" class="<?php echo $document_log->transmit_no_7->headerCellClass() ?>"><div id="elh_document_log_transmit_no_7" class="document_log_transmit_no_7"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_7" class="<?php echo $document_log->transmit_no_7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_7) ?>',2);"><div id="elh_document_log_transmit_no_7" class="document_log_transmit_no_7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_7->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_7->Visible) { // approval_status_7 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_7) == "") { ?>
		<th data-name="approval_status_7" class="<?php echo $document_log->approval_status_7->headerCellClass() ?>"><div id="elh_document_log_approval_status_7" class="document_log_approval_status_7"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_7" class="<?php echo $document_log->approval_status_7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_7) ?>',2);"><div id="elh_document_log_approval_status_7" class="document_log_approval_status_7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_7->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_7->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_7->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_8->Visible) { // submit_no_8 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_8) == "") { ?>
		<th data-name="submit_no_8" class="<?php echo $document_log->submit_no_8->headerCellClass() ?>"><div id="elh_document_log_submit_no_8" class="document_log_submit_no_8"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_8" class="<?php echo $document_log->submit_no_8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_8) ?>',2);"><div id="elh_document_log_submit_no_8" class="document_log_submit_no_8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_8->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_8->Visible) { // revision_no_8 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_8) == "") { ?>
		<th data-name="revision_no_8" class="<?php echo $document_log->revision_no_8->headerCellClass() ?>"><div id="elh_document_log_revision_no_8" class="document_log_revision_no_8"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_8" class="<?php echo $document_log->revision_no_8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_8) ?>',2);"><div id="elh_document_log_revision_no_8" class="document_log_revision_no_8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_8->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_8->Visible) { // direction_8 ?>
	<?php if ($document_log->sortUrl($document_log->direction_8) == "") { ?>
		<th data-name="direction_8" class="<?php echo $document_log->direction_8->headerCellClass() ?>"><div id="elh_document_log_direction_8" class="document_log_direction_8"><div class="ew-table-header-caption"><?php echo $document_log->direction_8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_8" class="<?php echo $document_log->direction_8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_8) ?>',2);"><div id="elh_document_log_direction_8" class="document_log_direction_8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_8->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_8->Visible) { // planned_date_8 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_8) == "") { ?>
		<th data-name="planned_date_8" class="<?php echo $document_log->planned_date_8->headerCellClass() ?>"><div id="elh_document_log_planned_date_8" class="document_log_planned_date_8"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_8" class="<?php echo $document_log->planned_date_8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_8) ?>',2);"><div id="elh_document_log_planned_date_8" class="document_log_planned_date_8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_8->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_8->Visible) { // transmit_date_8 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_8) == "") { ?>
		<th data-name="transmit_date_8" class="<?php echo $document_log->transmit_date_8->headerCellClass() ?>"><div id="elh_document_log_transmit_date_8" class="document_log_transmit_date_8"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_8" class="<?php echo $document_log->transmit_date_8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_8) ?>',2);"><div id="elh_document_log_transmit_date_8" class="document_log_transmit_date_8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_8->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_8->Visible) { // transmit_no_8 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_8) == "") { ?>
		<th data-name="transmit_no_8" class="<?php echo $document_log->transmit_no_8->headerCellClass() ?>"><div id="elh_document_log_transmit_no_8" class="document_log_transmit_no_8"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_8" class="<?php echo $document_log->transmit_no_8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_8) ?>',2);"><div id="elh_document_log_transmit_no_8" class="document_log_transmit_no_8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_8->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_8->Visible) { // approval_status_8 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_8) == "") { ?>
		<th data-name="approval_status_8" class="<?php echo $document_log->approval_status_8->headerCellClass() ?>"><div id="elh_document_log_approval_status_8" class="document_log_approval_status_8"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_8" class="<?php echo $document_log->approval_status_8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_8) ?>',2);"><div id="elh_document_log_approval_status_8" class="document_log_approval_status_8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_8->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_8->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_8->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_9->Visible) { // submit_no_9 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_9) == "") { ?>
		<th data-name="submit_no_9" class="<?php echo $document_log->submit_no_9->headerCellClass() ?>"><div id="elh_document_log_submit_no_9" class="document_log_submit_no_9"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_9" class="<?php echo $document_log->submit_no_9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_9) ?>',2);"><div id="elh_document_log_submit_no_9" class="document_log_submit_no_9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_9->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_9->Visible) { // revision_no_9 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_9) == "") { ?>
		<th data-name="revision_no_9" class="<?php echo $document_log->revision_no_9->headerCellClass() ?>"><div id="elh_document_log_revision_no_9" class="document_log_revision_no_9"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_9" class="<?php echo $document_log->revision_no_9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_9) ?>',2);"><div id="elh_document_log_revision_no_9" class="document_log_revision_no_9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_9->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_9->Visible) { // direction_9 ?>
	<?php if ($document_log->sortUrl($document_log->direction_9) == "") { ?>
		<th data-name="direction_9" class="<?php echo $document_log->direction_9->headerCellClass() ?>"><div id="elh_document_log_direction_9" class="document_log_direction_9"><div class="ew-table-header-caption"><?php echo $document_log->direction_9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_9" class="<?php echo $document_log->direction_9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_9) ?>',2);"><div id="elh_document_log_direction_9" class="document_log_direction_9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_9->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_9->Visible) { // planned_date_9 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_9) == "") { ?>
		<th data-name="planned_date_9" class="<?php echo $document_log->planned_date_9->headerCellClass() ?>"><div id="elh_document_log_planned_date_9" class="document_log_planned_date_9"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_9" class="<?php echo $document_log->planned_date_9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_9) ?>',2);"><div id="elh_document_log_planned_date_9" class="document_log_planned_date_9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_9->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_9->Visible) { // transmit_date_9 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_9) == "") { ?>
		<th data-name="transmit_date_9" class="<?php echo $document_log->transmit_date_9->headerCellClass() ?>"><div id="elh_document_log_transmit_date_9" class="document_log_transmit_date_9"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_9" class="<?php echo $document_log->transmit_date_9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_9) ?>',2);"><div id="elh_document_log_transmit_date_9" class="document_log_transmit_date_9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_9->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_9->Visible) { // transmit_no_9 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_9) == "") { ?>
		<th data-name="transmit_no_9" class="<?php echo $document_log->transmit_no_9->headerCellClass() ?>"><div id="elh_document_log_transmit_no_9" class="document_log_transmit_no_9"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_9" class="<?php echo $document_log->transmit_no_9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_9) ?>',2);"><div id="elh_document_log_transmit_no_9" class="document_log_transmit_no_9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_9->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_9->Visible) { // approval_status_9 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_9) == "") { ?>
		<th data-name="approval_status_9" class="<?php echo $document_log->approval_status_9->headerCellClass() ?>"><div id="elh_document_log_approval_status_9" class="document_log_approval_status_9"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_9->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_9" class="<?php echo $document_log->approval_status_9->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_9) ?>',2);"><div id="elh_document_log_approval_status_9" class="document_log_approval_status_9">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_9->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_9->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_9->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_10->Visible) { // submit_no_10 ?>
	<?php if ($document_log->sortUrl($document_log->submit_no_10) == "") { ?>
		<th data-name="submit_no_10" class="<?php echo $document_log->submit_no_10->headerCellClass() ?>"><div id="elh_document_log_submit_no_10" class="document_log_submit_no_10"><div class="ew-table-header-caption"><?php echo $document_log->submit_no_10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no_10" class="<?php echo $document_log->submit_no_10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->submit_no_10) ?>',2);"><div id="elh_document_log_submit_no_10" class="document_log_submit_no_10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->submit_no_10->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->submit_no_10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->submit_no_10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_10->Visible) { // revision_no_10 ?>
	<?php if ($document_log->sortUrl($document_log->revision_no_10) == "") { ?>
		<th data-name="revision_no_10" class="<?php echo $document_log->revision_no_10->headerCellClass() ?>"><div id="elh_document_log_revision_no_10" class="document_log_revision_no_10"><div class="ew-table-header-caption"><?php echo $document_log->revision_no_10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no_10" class="<?php echo $document_log->revision_no_10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->revision_no_10) ?>',2);"><div id="elh_document_log_revision_no_10" class="document_log_revision_no_10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->revision_no_10->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->revision_no_10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->revision_no_10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->direction_10->Visible) { // direction_10 ?>
	<?php if ($document_log->sortUrl($document_log->direction_10) == "") { ?>
		<th data-name="direction_10" class="<?php echo $document_log->direction_10->headerCellClass() ?>"><div id="elh_document_log_direction_10" class="document_log_direction_10"><div class="ew-table-header-caption"><?php echo $document_log->direction_10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction_10" class="<?php echo $document_log->direction_10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->direction_10) ?>',2);"><div id="elh_document_log_direction_10" class="document_log_direction_10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->direction_10->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->direction_10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->direction_10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_10->Visible) { // planned_date_10 ?>
	<?php if ($document_log->sortUrl($document_log->planned_date_10) == "") { ?>
		<th data-name="planned_date_10" class="<?php echo $document_log->planned_date_10->headerCellClass() ?>"><div id="elh_document_log_planned_date_10" class="document_log_planned_date_10"><div class="ew-table-header-caption"><?php echo $document_log->planned_date_10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date_10" class="<?php echo $document_log->planned_date_10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->planned_date_10) ?>',2);"><div id="elh_document_log_planned_date_10" class="document_log_planned_date_10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->planned_date_10->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->planned_date_10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->planned_date_10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_10->Visible) { // transmit_date_10 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_date_10) == "") { ?>
		<th data-name="transmit_date_10" class="<?php echo $document_log->transmit_date_10->headerCellClass() ?>"><div id="elh_document_log_transmit_date_10" class="document_log_transmit_date_10"><div class="ew-table-header-caption"><?php echo $document_log->transmit_date_10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date_10" class="<?php echo $document_log->transmit_date_10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_date_10) ?>',2);"><div id="elh_document_log_transmit_date_10" class="document_log_transmit_date_10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_date_10->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_date_10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_date_10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_10->Visible) { // transmit_no_10 ?>
	<?php if ($document_log->sortUrl($document_log->transmit_no_10) == "") { ?>
		<th data-name="transmit_no_10" class="<?php echo $document_log->transmit_no_10->headerCellClass() ?>"><div id="elh_document_log_transmit_no_10" class="document_log_transmit_no_10"><div class="ew-table-header-caption"><?php echo $document_log->transmit_no_10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no_10" class="<?php echo $document_log->transmit_no_10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->transmit_no_10) ?>',2);"><div id="elh_document_log_transmit_no_10" class="document_log_transmit_no_10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->transmit_no_10->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->transmit_no_10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->transmit_no_10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_10->Visible) { // approval_status_10 ?>
	<?php if ($document_log->sortUrl($document_log->approval_status_10) == "") { ?>
		<th data-name="approval_status_10" class="<?php echo $document_log->approval_status_10->headerCellClass() ?>"><div id="elh_document_log_approval_status_10" class="document_log_approval_status_10"><div class="ew-table-header-caption"><?php echo $document_log->approval_status_10->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status_10" class="<?php echo $document_log->approval_status_10->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->approval_status_10) ?>',2);"><div id="elh_document_log_approval_status_10" class="document_log_approval_status_10">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_log->approval_status_10->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_log->approval_status_10->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_log->approval_status_10->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_log->log_updatedon->Visible) { // log_updatedon ?>
	<?php if ($document_log->sortUrl($document_log->log_updatedon) == "") { ?>
		<th data-name="log_updatedon" class="<?php echo $document_log->log_updatedon->headerCellClass() ?>"><div id="elh_document_log_log_updatedon" class="document_log_log_updatedon"><div class="ew-table-header-caption"><?php echo $document_log->log_updatedon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="log_updatedon" class="<?php echo $document_log->log_updatedon->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_log->SortUrl($document_log->log_updatedon) ?>',2);"><div id="elh_document_log_log_updatedon" class="document_log_log_updatedon">
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
	<?php if ($document_log->submit_no_1->Visible) { // submit_no_1 ?>
		<td data-name="submit_no_1"<?php echo $document_log->submit_no_1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_1" class="document_log_submit_no_1">
<span<?php echo $document_log->submit_no_1->viewAttributes() ?>>
<?php echo $document_log->submit_no_1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_1->Visible) { // revision_no_1 ?>
		<td data-name="revision_no_1"<?php echo $document_log->revision_no_1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_1" class="document_log_revision_no_1">
<span<?php echo $document_log->revision_no_1->viewAttributes() ?>>
<?php echo $document_log->revision_no_1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_1->Visible) { // direction_1 ?>
		<td data-name="direction_1"<?php echo $document_log->direction_1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_1" class="document_log_direction_1">
<span<?php echo $document_log->direction_1->viewAttributes() ?>>
<?php echo $document_log->direction_1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_1->Visible) { // planned_date_1 ?>
		<td data-name="planned_date_1"<?php echo $document_log->planned_date_1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_1" class="document_log_planned_date_1">
<span<?php echo $document_log->planned_date_1->viewAttributes() ?>>
<?php echo $document_log->planned_date_1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_1->Visible) { // transmit_date_1 ?>
		<td data-name="transmit_date_1"<?php echo $document_log->transmit_date_1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_1" class="document_log_transmit_date_1">
<span<?php echo $document_log->transmit_date_1->viewAttributes() ?>>
<?php echo $document_log->transmit_date_1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_1->Visible) { // transmit_no_1 ?>
		<td data-name="transmit_no_1"<?php echo $document_log->transmit_no_1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_1" class="document_log_transmit_no_1">
<span<?php echo $document_log->transmit_no_1->viewAttributes() ?>>
<?php echo $document_log->transmit_no_1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_1->Visible) { // approval_status_1 ?>
		<td data-name="approval_status_1"<?php echo $document_log->approval_status_1->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_1" class="document_log_approval_status_1">
<span<?php echo $document_log->approval_status_1->viewAttributes() ?>>
<?php if ((!EmptyString($document_log->approval_status_1->getViewValue())) && $document_log->approval_status_1->linkAttributes() <> "") { ?>
<a<?php echo $document_log->approval_status_1->linkAttributes() ?>><?php echo $document_log->approval_status_1->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->approval_status_1->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_2->Visible) { // submit_no_2 ?>
		<td data-name="submit_no_2"<?php echo $document_log->submit_no_2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_2" class="document_log_submit_no_2">
<span<?php echo $document_log->submit_no_2->viewAttributes() ?>>
<?php echo $document_log->submit_no_2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_2->Visible) { // revision_no_2 ?>
		<td data-name="revision_no_2"<?php echo $document_log->revision_no_2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_2" class="document_log_revision_no_2">
<span<?php echo $document_log->revision_no_2->viewAttributes() ?>>
<?php echo $document_log->revision_no_2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_2->Visible) { // direction_2 ?>
		<td data-name="direction_2"<?php echo $document_log->direction_2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_2" class="document_log_direction_2">
<span<?php echo $document_log->direction_2->viewAttributes() ?>>
<?php echo $document_log->direction_2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_2->Visible) { // planned_date_2 ?>
		<td data-name="planned_date_2"<?php echo $document_log->planned_date_2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_2" class="document_log_planned_date_2">
<span<?php echo $document_log->planned_date_2->viewAttributes() ?>>
<?php echo $document_log->planned_date_2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_2->Visible) { // transmit_date_2 ?>
		<td data-name="transmit_date_2"<?php echo $document_log->transmit_date_2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_2" class="document_log_transmit_date_2">
<span<?php echo $document_log->transmit_date_2->viewAttributes() ?>>
<?php echo $document_log->transmit_date_2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_2->Visible) { // transmit_no_2 ?>
		<td data-name="transmit_no_2"<?php echo $document_log->transmit_no_2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_2" class="document_log_transmit_no_2">
<span<?php echo $document_log->transmit_no_2->viewAttributes() ?>>
<?php echo $document_log->transmit_no_2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_2->Visible) { // approval_status_2 ?>
		<td data-name="approval_status_2"<?php echo $document_log->approval_status_2->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_2" class="document_log_approval_status_2">
<span<?php echo $document_log->approval_status_2->viewAttributes() ?>>
<?php if ((!EmptyString($document_log->approval_status_2->getViewValue())) && $document_log->approval_status_2->linkAttributes() <> "") { ?>
<a<?php echo $document_log->approval_status_2->linkAttributes() ?>><?php echo $document_log->approval_status_2->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->approval_status_2->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_3->Visible) { // submit_no_3 ?>
		<td data-name="submit_no_3"<?php echo $document_log->submit_no_3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_3" class="document_log_submit_no_3">
<span<?php echo $document_log->submit_no_3->viewAttributes() ?>>
<?php echo $document_log->submit_no_3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_3->Visible) { // revision_no_3 ?>
		<td data-name="revision_no_3"<?php echo $document_log->revision_no_3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_3" class="document_log_revision_no_3">
<span<?php echo $document_log->revision_no_3->viewAttributes() ?>>
<?php echo $document_log->revision_no_3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_3->Visible) { // direction_3 ?>
		<td data-name="direction_3"<?php echo $document_log->direction_3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_3" class="document_log_direction_3">
<span<?php echo $document_log->direction_3->viewAttributes() ?>>
<?php echo $document_log->direction_3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_3->Visible) { // planned_date_3 ?>
		<td data-name="planned_date_3"<?php echo $document_log->planned_date_3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_3" class="document_log_planned_date_3">
<span<?php echo $document_log->planned_date_3->viewAttributes() ?>>
<?php echo $document_log->planned_date_3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_3->Visible) { // transmit_date_3 ?>
		<td data-name="transmit_date_3"<?php echo $document_log->transmit_date_3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_3" class="document_log_transmit_date_3">
<span<?php echo $document_log->transmit_date_3->viewAttributes() ?>>
<?php echo $document_log->transmit_date_3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_3->Visible) { // transmit_no_3 ?>
		<td data-name="transmit_no_3"<?php echo $document_log->transmit_no_3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_3" class="document_log_transmit_no_3">
<span<?php echo $document_log->transmit_no_3->viewAttributes() ?>>
<?php echo $document_log->transmit_no_3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_3->Visible) { // approval_status_3 ?>
		<td data-name="approval_status_3"<?php echo $document_log->approval_status_3->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_3" class="document_log_approval_status_3">
<span<?php echo $document_log->approval_status_3->viewAttributes() ?>>
<?php if ((!EmptyString($document_log->approval_status_3->getViewValue())) && $document_log->approval_status_3->linkAttributes() <> "") { ?>
<a<?php echo $document_log->approval_status_3->linkAttributes() ?>><?php echo $document_log->approval_status_3->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->approval_status_3->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_4->Visible) { // submit_no_4 ?>
		<td data-name="submit_no_4"<?php echo $document_log->submit_no_4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_4" class="document_log_submit_no_4">
<span<?php echo $document_log->submit_no_4->viewAttributes() ?>>
<?php echo $document_log->submit_no_4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_4->Visible) { // revision_no_4 ?>
		<td data-name="revision_no_4"<?php echo $document_log->revision_no_4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_4" class="document_log_revision_no_4">
<span<?php echo $document_log->revision_no_4->viewAttributes() ?>>
<?php echo $document_log->revision_no_4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_4->Visible) { // direction_4 ?>
		<td data-name="direction_4"<?php echo $document_log->direction_4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_4" class="document_log_direction_4">
<span<?php echo $document_log->direction_4->viewAttributes() ?>>
<?php echo $document_log->direction_4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_4->Visible) { // planned_date_4 ?>
		<td data-name="planned_date_4"<?php echo $document_log->planned_date_4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_4" class="document_log_planned_date_4">
<span<?php echo $document_log->planned_date_4->viewAttributes() ?>>
<?php echo $document_log->planned_date_4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_4->Visible) { // transmit_date_4 ?>
		<td data-name="transmit_date_4"<?php echo $document_log->transmit_date_4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_4" class="document_log_transmit_date_4">
<span<?php echo $document_log->transmit_date_4->viewAttributes() ?>>
<?php echo $document_log->transmit_date_4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_4->Visible) { // transmit_no_4 ?>
		<td data-name="transmit_no_4"<?php echo $document_log->transmit_no_4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_4" class="document_log_transmit_no_4">
<span<?php echo $document_log->transmit_no_4->viewAttributes() ?>>
<?php echo $document_log->transmit_no_4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_4->Visible) { // approval_status_4 ?>
		<td data-name="approval_status_4"<?php echo $document_log->approval_status_4->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_4" class="document_log_approval_status_4">
<span<?php echo $document_log->approval_status_4->viewAttributes() ?>>
<?php if ((!EmptyString($document_log->approval_status_4->getViewValue())) && $document_log->approval_status_4->linkAttributes() <> "") { ?>
<a<?php echo $document_log->approval_status_4->linkAttributes() ?>><?php echo $document_log->approval_status_4->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->approval_status_4->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_5->Visible) { // submit_no_5 ?>
		<td data-name="submit_no_5"<?php echo $document_log->submit_no_5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_5" class="document_log_submit_no_5">
<span<?php echo $document_log->submit_no_5->viewAttributes() ?>>
<?php echo $document_log->submit_no_5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_5->Visible) { // revision_no_5 ?>
		<td data-name="revision_no_5"<?php echo $document_log->revision_no_5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_5" class="document_log_revision_no_5">
<span<?php echo $document_log->revision_no_5->viewAttributes() ?>>
<?php echo $document_log->revision_no_5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_5->Visible) { // direction_5 ?>
		<td data-name="direction_5"<?php echo $document_log->direction_5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_5" class="document_log_direction_5">
<span<?php echo $document_log->direction_5->viewAttributes() ?>>
<?php echo $document_log->direction_5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_5->Visible) { // planned_date_5 ?>
		<td data-name="planned_date_5"<?php echo $document_log->planned_date_5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_5" class="document_log_planned_date_5">
<span<?php echo $document_log->planned_date_5->viewAttributes() ?>>
<?php echo $document_log->planned_date_5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_5->Visible) { // transmit_date_5 ?>
		<td data-name="transmit_date_5"<?php echo $document_log->transmit_date_5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_5" class="document_log_transmit_date_5">
<span<?php echo $document_log->transmit_date_5->viewAttributes() ?>>
<?php echo $document_log->transmit_date_5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_5->Visible) { // transmit_no_5 ?>
		<td data-name="transmit_no_5"<?php echo $document_log->transmit_no_5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_5" class="document_log_transmit_no_5">
<span<?php echo $document_log->transmit_no_5->viewAttributes() ?>>
<?php echo $document_log->transmit_no_5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_5->Visible) { // approval_status_5 ?>
		<td data-name="approval_status_5"<?php echo $document_log->approval_status_5->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_5" class="document_log_approval_status_5">
<span<?php echo $document_log->approval_status_5->viewAttributes() ?>>
<?php echo $document_log->approval_status_5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_6->Visible) { // submit_no_6 ?>
		<td data-name="submit_no_6"<?php echo $document_log->submit_no_6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_6" class="document_log_submit_no_6">
<span<?php echo $document_log->submit_no_6->viewAttributes() ?>>
<?php echo $document_log->submit_no_6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_6->Visible) { // revision_no_6 ?>
		<td data-name="revision_no_6"<?php echo $document_log->revision_no_6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_6" class="document_log_revision_no_6">
<span<?php echo $document_log->revision_no_6->viewAttributes() ?>>
<?php echo $document_log->revision_no_6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_6->Visible) { // direction_6 ?>
		<td data-name="direction_6"<?php echo $document_log->direction_6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_6" class="document_log_direction_6">
<span<?php echo $document_log->direction_6->viewAttributes() ?>>
<?php echo $document_log->direction_6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_6->Visible) { // planned_date_6 ?>
		<td data-name="planned_date_6"<?php echo $document_log->planned_date_6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_6" class="document_log_planned_date_6">
<span<?php echo $document_log->planned_date_6->viewAttributes() ?>>
<?php echo $document_log->planned_date_6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_6->Visible) { // transmit_date_6 ?>
		<td data-name="transmit_date_6"<?php echo $document_log->transmit_date_6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_6" class="document_log_transmit_date_6">
<span<?php echo $document_log->transmit_date_6->viewAttributes() ?>>
<?php echo $document_log->transmit_date_6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_6->Visible) { // transmit_no_6 ?>
		<td data-name="transmit_no_6"<?php echo $document_log->transmit_no_6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_6" class="document_log_transmit_no_6">
<span<?php echo $document_log->transmit_no_6->viewAttributes() ?>>
<?php echo $document_log->transmit_no_6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_6->Visible) { // approval_status_6 ?>
		<td data-name="approval_status_6"<?php echo $document_log->approval_status_6->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_6" class="document_log_approval_status_6">
<span<?php echo $document_log->approval_status_6->viewAttributes() ?>>
<?php if ((!EmptyString($document_log->approval_status_6->getViewValue())) && $document_log->approval_status_6->linkAttributes() <> "") { ?>
<a<?php echo $document_log->approval_status_6->linkAttributes() ?>><?php echo $document_log->approval_status_6->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->approval_status_6->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_7->Visible) { // submit_no_7 ?>
		<td data-name="submit_no_7"<?php echo $document_log->submit_no_7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_7" class="document_log_submit_no_7">
<span<?php echo $document_log->submit_no_7->viewAttributes() ?>>
<?php echo $document_log->submit_no_7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_7->Visible) { // revision_no_7 ?>
		<td data-name="revision_no_7"<?php echo $document_log->revision_no_7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_7" class="document_log_revision_no_7">
<span<?php echo $document_log->revision_no_7->viewAttributes() ?>>
<?php echo $document_log->revision_no_7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_7->Visible) { // direction_7 ?>
		<td data-name="direction_7"<?php echo $document_log->direction_7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_7" class="document_log_direction_7">
<span<?php echo $document_log->direction_7->viewAttributes() ?>>
<?php echo $document_log->direction_7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_7->Visible) { // planned_date_7 ?>
		<td data-name="planned_date_7"<?php echo $document_log->planned_date_7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_7" class="document_log_planned_date_7">
<span<?php echo $document_log->planned_date_7->viewAttributes() ?>>
<?php echo $document_log->planned_date_7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_7->Visible) { // transmit_date_7 ?>
		<td data-name="transmit_date_7"<?php echo $document_log->transmit_date_7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_7" class="document_log_transmit_date_7">
<span<?php echo $document_log->transmit_date_7->viewAttributes() ?>>
<?php echo $document_log->transmit_date_7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_7->Visible) { // transmit_no_7 ?>
		<td data-name="transmit_no_7"<?php echo $document_log->transmit_no_7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_7" class="document_log_transmit_no_7">
<span<?php echo $document_log->transmit_no_7->viewAttributes() ?>>
<?php echo $document_log->transmit_no_7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_7->Visible) { // approval_status_7 ?>
		<td data-name="approval_status_7"<?php echo $document_log->approval_status_7->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_7" class="document_log_approval_status_7">
<span<?php echo $document_log->approval_status_7->viewAttributes() ?>>
<?php if ((!EmptyString($document_log->approval_status_7->getViewValue())) && $document_log->approval_status_7->linkAttributes() <> "") { ?>
<a<?php echo $document_log->approval_status_7->linkAttributes() ?>><?php echo $document_log->approval_status_7->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->approval_status_7->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_8->Visible) { // submit_no_8 ?>
		<td data-name="submit_no_8"<?php echo $document_log->submit_no_8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_8" class="document_log_submit_no_8">
<span<?php echo $document_log->submit_no_8->viewAttributes() ?>>
<?php echo $document_log->submit_no_8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_8->Visible) { // revision_no_8 ?>
		<td data-name="revision_no_8"<?php echo $document_log->revision_no_8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_8" class="document_log_revision_no_8">
<span<?php echo $document_log->revision_no_8->viewAttributes() ?>>
<?php echo $document_log->revision_no_8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_8->Visible) { // direction_8 ?>
		<td data-name="direction_8"<?php echo $document_log->direction_8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_8" class="document_log_direction_8">
<span<?php echo $document_log->direction_8->viewAttributes() ?>>
<?php echo $document_log->direction_8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_8->Visible) { // planned_date_8 ?>
		<td data-name="planned_date_8"<?php echo $document_log->planned_date_8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_8" class="document_log_planned_date_8">
<span<?php echo $document_log->planned_date_8->viewAttributes() ?>>
<?php echo $document_log->planned_date_8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_8->Visible) { // transmit_date_8 ?>
		<td data-name="transmit_date_8"<?php echo $document_log->transmit_date_8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_8" class="document_log_transmit_date_8">
<span<?php echo $document_log->transmit_date_8->viewAttributes() ?>>
<?php echo $document_log->transmit_date_8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_8->Visible) { // transmit_no_8 ?>
		<td data-name="transmit_no_8"<?php echo $document_log->transmit_no_8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_8" class="document_log_transmit_no_8">
<span<?php echo $document_log->transmit_no_8->viewAttributes() ?>>
<?php echo $document_log->transmit_no_8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_8->Visible) { // approval_status_8 ?>
		<td data-name="approval_status_8"<?php echo $document_log->approval_status_8->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_8" class="document_log_approval_status_8">
<span<?php echo $document_log->approval_status_8->viewAttributes() ?>>
<?php if ((!EmptyString($document_log->approval_status_8->getViewValue())) && $document_log->approval_status_8->linkAttributes() <> "") { ?>
<a<?php echo $document_log->approval_status_8->linkAttributes() ?>><?php echo $document_log->approval_status_8->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->approval_status_8->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_9->Visible) { // submit_no_9 ?>
		<td data-name="submit_no_9"<?php echo $document_log->submit_no_9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_9" class="document_log_submit_no_9">
<span<?php echo $document_log->submit_no_9->viewAttributes() ?>>
<?php echo $document_log->submit_no_9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_9->Visible) { // revision_no_9 ?>
		<td data-name="revision_no_9"<?php echo $document_log->revision_no_9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_9" class="document_log_revision_no_9">
<span<?php echo $document_log->revision_no_9->viewAttributes() ?>>
<?php echo $document_log->revision_no_9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_9->Visible) { // direction_9 ?>
		<td data-name="direction_9"<?php echo $document_log->direction_9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_9" class="document_log_direction_9">
<span<?php echo $document_log->direction_9->viewAttributes() ?>>
<?php echo $document_log->direction_9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_9->Visible) { // planned_date_9 ?>
		<td data-name="planned_date_9"<?php echo $document_log->planned_date_9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_9" class="document_log_planned_date_9">
<span<?php echo $document_log->planned_date_9->viewAttributes() ?>>
<?php echo $document_log->planned_date_9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_9->Visible) { // transmit_date_9 ?>
		<td data-name="transmit_date_9"<?php echo $document_log->transmit_date_9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_9" class="document_log_transmit_date_9">
<span<?php echo $document_log->transmit_date_9->viewAttributes() ?>>
<?php echo $document_log->transmit_date_9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_9->Visible) { // transmit_no_9 ?>
		<td data-name="transmit_no_9"<?php echo $document_log->transmit_no_9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_9" class="document_log_transmit_no_9">
<span<?php echo $document_log->transmit_no_9->viewAttributes() ?>>
<?php echo $document_log->transmit_no_9->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_9->Visible) { // approval_status_9 ?>
		<td data-name="approval_status_9"<?php echo $document_log->approval_status_9->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_9" class="document_log_approval_status_9">
<span<?php echo $document_log->approval_status_9->viewAttributes() ?>>
<?php if ((!EmptyString($document_log->approval_status_9->getViewValue())) && $document_log->approval_status_9->linkAttributes() <> "") { ?>
<a<?php echo $document_log->approval_status_9->linkAttributes() ?>><?php echo $document_log->approval_status_9->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->approval_status_9->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->submit_no_10->Visible) { // submit_no_10 ?>
		<td data-name="submit_no_10"<?php echo $document_log->submit_no_10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_submit_no_10" class="document_log_submit_no_10">
<span<?php echo $document_log->submit_no_10->viewAttributes() ?>>
<?php echo $document_log->submit_no_10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->revision_no_10->Visible) { // revision_no_10 ?>
		<td data-name="revision_no_10"<?php echo $document_log->revision_no_10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_revision_no_10" class="document_log_revision_no_10">
<span<?php echo $document_log->revision_no_10->viewAttributes() ?>>
<?php echo $document_log->revision_no_10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->direction_10->Visible) { // direction_10 ?>
		<td data-name="direction_10"<?php echo $document_log->direction_10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_direction_10" class="document_log_direction_10">
<span<?php echo $document_log->direction_10->viewAttributes() ?>>
<?php echo $document_log->direction_10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->planned_date_10->Visible) { // planned_date_10 ?>
		<td data-name="planned_date_10"<?php echo $document_log->planned_date_10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_planned_date_10" class="document_log_planned_date_10">
<span<?php echo $document_log->planned_date_10->viewAttributes() ?>>
<?php echo $document_log->planned_date_10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_date_10->Visible) { // transmit_date_10 ?>
		<td data-name="transmit_date_10"<?php echo $document_log->transmit_date_10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_date_10" class="document_log_transmit_date_10">
<span<?php echo $document_log->transmit_date_10->viewAttributes() ?>>
<?php echo $document_log->transmit_date_10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->transmit_no_10->Visible) { // transmit_no_10 ?>
		<td data-name="transmit_no_10"<?php echo $document_log->transmit_no_10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_transmit_no_10" class="document_log_transmit_no_10">
<span<?php echo $document_log->transmit_no_10->viewAttributes() ?>>
<?php echo $document_log->transmit_no_10->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_log->approval_status_10->Visible) { // approval_status_10 ?>
		<td data-name="approval_status_10"<?php echo $document_log->approval_status_10->cellAttributes() ?>>
<span id="el<?php echo $document_log_list->RowCnt ?>_document_log_approval_status_10" class="document_log_approval_status_10">
<span<?php echo $document_log->approval_status_10->viewAttributes() ?>>
<?php if ((!EmptyString($document_log->approval_status_10->getViewValue())) && $document_log->approval_status_10->linkAttributes() <> "") { ?>
<a<?php echo $document_log->approval_status_10->linkAttributes() ?>><?php echo $document_log->approval_status_10->getViewValue() ?></a>
<?php } else { ?>
<?php echo $document_log->approval_status_10->getViewValue() ?>
<?php } ?>
</span>
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
ew.scrollableTable("gmp_document_log", "100%", "");
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$document_log_list->terminate();
?>