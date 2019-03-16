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
$transaction_details_list = new transaction_details_list();

// Run the page
$transaction_details_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transaction_details_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$transaction_details->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftransaction_detailslist = currentForm = new ew.Form("ftransaction_detailslist", "list");
ftransaction_detailslist.formKeyCountName = '<?php echo $transaction_details_list->FormKeyCountName ?>';

// Validate form
ftransaction_detailslist.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
		<?php if ($transaction_details_list->firelink_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_firelink_doc_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->firelink_doc_no->caption(), $transaction_details->firelink_doc_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_list->submit_no->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->submit_no->caption(), $transaction_details->submit_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_list->revision_no->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->revision_no->caption(), $transaction_details->revision_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_list->transmit_no->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->transmit_no->caption(), $transaction_details->transmit_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_list->transmit_date->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->transmit_date->caption(), $transaction_details->transmit_date->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_list->direction->Required) { ?>
			elm = this.getElements("x" + infix + "_direction");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->direction->caption(), $transaction_details->direction->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_list->approval_status->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->approval_status->caption(), $transaction_details->approval_status->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_list->document_link->Required) { ?>
			felm = this.getElements("x" + infix + "_document_link");
			elm = this.getElements("fn_x" + infix + "_document_link");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $transaction_details->document_link->caption(), $transaction_details->document_link->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	if (gridinsert && addcnt == 0) { // No row added
		ew.alert(ew.language.phrase("NoAddRecord"));
		return false;
	}
	return true;
}

// Check empty row
ftransaction_detailslist.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "firelink_doc_no", false)) return false;
	if (ew.valueChanged(fobj, infix, "submit_no", false)) return false;
	if (ew.valueChanged(fobj, infix, "revision_no", false)) return false;
	if (ew.valueChanged(fobj, infix, "transmit_no", false)) return false;
	if (ew.valueChanged(fobj, infix, "transmit_date", false)) return false;
	if (ew.valueChanged(fobj, infix, "direction", false)) return false;
	if (ew.valueChanged(fobj, infix, "approval_status", false)) return false;
	if (ew.valueChanged(fobj, infix, "document_link", false)) return false;
	return true;
}

// Form_CustomValidate event
ftransaction_detailslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftransaction_detailslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftransaction_detailslist.lists["x_firelink_doc_no"] = <?php echo $transaction_details_list->firelink_doc_no->Lookup->toClientList() ?>;
ftransaction_detailslist.lists["x_firelink_doc_no"].options = <?php echo JsonEncode($transaction_details_list->firelink_doc_no->lookupOptions()) ?>;
ftransaction_detailslist.autoSuggests["x_firelink_doc_no"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftransaction_detailslist.lists["x_transmit_no"] = <?php echo $transaction_details_list->transmit_no->Lookup->toClientList() ?>;
ftransaction_detailslist.lists["x_transmit_no"].options = <?php echo JsonEncode($transaction_details_list->transmit_no->lookupOptions()) ?>;
ftransaction_detailslist.autoSuggests["x_transmit_no"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftransaction_detailslist.lists["x_direction"] = <?php echo $transaction_details_list->direction->Lookup->toClientList() ?>;
ftransaction_detailslist.lists["x_direction"].options = <?php echo JsonEncode($transaction_details_list->direction->options(FALSE, TRUE)) ?>;
ftransaction_detailslist.lists["x_approval_status"] = <?php echo $transaction_details_list->approval_status->Lookup->toClientList() ?>;
ftransaction_detailslist.lists["x_approval_status"].options = <?php echo JsonEncode($transaction_details_list->approval_status->lookupOptions()) ?>;

// Form object for search
var ftransaction_detailslistsrch = currentSearchForm = new ew.Form("ftransaction_detailslistsrch");

// Filters
ftransaction_detailslistsrch.filterList = <?php echo $transaction_details_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$transaction_details->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($transaction_details_list->TotalRecs > 0 && $transaction_details_list->ExportOptions->visible()) { ?>
<?php $transaction_details_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($transaction_details_list->ImportOptions->visible()) { ?>
<?php $transaction_details_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($transaction_details_list->SearchOptions->visible()) { ?>
<?php $transaction_details_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($transaction_details_list->FilterOptions->visible()) { ?>
<?php $transaction_details_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$transaction_details_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$transaction_details->isExport() && !$transaction_details->CurrentAction) { ?>
<form name="ftransaction_detailslistsrch" id="ftransaction_detailslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($transaction_details_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftransaction_detailslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="transaction_details">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($transaction_details_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($transaction_details_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $transaction_details_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($transaction_details_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($transaction_details_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($transaction_details_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($transaction_details_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $transaction_details_list->showPageHeader(); ?>
<?php
$transaction_details_list->showMessage();
?>
<?php if ($transaction_details_list->TotalRecs > 0 || $transaction_details->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($transaction_details_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> transaction_details">
<?php if (!$transaction_details->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$transaction_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($transaction_details_list->Pager)) $transaction_details_list->Pager = new NumericPager($transaction_details_list->StartRec, $transaction_details_list->DisplayRecs, $transaction_details_list->TotalRecs, $transaction_details_list->RecRange, $transaction_details_list->AutoHidePager) ?>
<?php if ($transaction_details_list->Pager->RecordCount > 0 && $transaction_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($transaction_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_list->pageUrl() ?>start=<?php echo $transaction_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($transaction_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_list->pageUrl() ?>start=<?php echo $transaction_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($transaction_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $transaction_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($transaction_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_list->pageUrl() ?>start=<?php echo $transaction_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($transaction_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_list->pageUrl() ?>start=<?php echo $transaction_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($transaction_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $transaction_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $transaction_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $transaction_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($transaction_details_list->TotalRecs > 0 && (!$transaction_details_list->AutoHidePageSizeSelector || $transaction_details_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="transaction_details">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="50"<?php if ($transaction_details_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($transaction_details_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="150"<?php if ($transaction_details_list->DisplayRecs == 150) { ?> selected<?php } ?>>150</option>
<option value="ALL"<?php if ($transaction_details->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $transaction_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftransaction_detailslist" id="ftransaction_detailslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($transaction_details_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $transaction_details_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transaction_details">
<div id="gmp_transaction_details" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($transaction_details_list->TotalRecs > 0 || $transaction_details->isGridEdit()) { ?>
<table id="tbl_transaction_detailslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$transaction_details_list->RowType = ROWTYPE_HEADER;

// Render list options
$transaction_details_list->renderListOptions();

// Render list options (header, left)
$transaction_details_list->ListOptions->render("header", "left");
?>
<?php if ($transaction_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
	<?php if ($transaction_details->sortUrl($transaction_details->firelink_doc_no) == "") { ?>
		<th data-name="firelink_doc_no" class="<?php echo $transaction_details->firelink_doc_no->headerCellClass() ?>"><div id="elh_transaction_details_firelink_doc_no" class="transaction_details_firelink_doc_no"><div class="ew-table-header-caption"><?php echo $transaction_details->firelink_doc_no->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="firelink_doc_no" class="<?php echo $transaction_details->firelink_doc_no->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transaction_details->SortUrl($transaction_details->firelink_doc_no) ?>',2);"><div id="elh_transaction_details_firelink_doc_no" class="transaction_details_firelink_doc_no">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaction_details->firelink_doc_no->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transaction_details->firelink_doc_no->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transaction_details->firelink_doc_no->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaction_details->submit_no->Visible) { // submit_no ?>
	<?php if ($transaction_details->sortUrl($transaction_details->submit_no) == "") { ?>
		<th data-name="submit_no" class="<?php echo $transaction_details->submit_no->headerCellClass() ?>"><div id="elh_transaction_details_submit_no" class="transaction_details_submit_no"><div class="ew-table-header-caption"><?php echo $transaction_details->submit_no->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="submit_no" class="<?php echo $transaction_details->submit_no->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transaction_details->SortUrl($transaction_details->submit_no) ?>',2);"><div id="elh_transaction_details_submit_no" class="transaction_details_submit_no">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaction_details->submit_no->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transaction_details->submit_no->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transaction_details->submit_no->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaction_details->revision_no->Visible) { // revision_no ?>
	<?php if ($transaction_details->sortUrl($transaction_details->revision_no) == "") { ?>
		<th data-name="revision_no" class="<?php echo $transaction_details->revision_no->headerCellClass() ?>"><div id="elh_transaction_details_revision_no" class="transaction_details_revision_no"><div class="ew-table-header-caption"><?php echo $transaction_details->revision_no->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revision_no" class="<?php echo $transaction_details->revision_no->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transaction_details->SortUrl($transaction_details->revision_no) ?>',2);"><div id="elh_transaction_details_revision_no" class="transaction_details_revision_no">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaction_details->revision_no->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transaction_details->revision_no->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transaction_details->revision_no->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaction_details->transmit_no->Visible) { // transmit_no ?>
	<?php if ($transaction_details->sortUrl($transaction_details->transmit_no) == "") { ?>
		<th data-name="transmit_no" class="<?php echo $transaction_details->transmit_no->headerCellClass() ?>"><div id="elh_transaction_details_transmit_no" class="transaction_details_transmit_no"><div class="ew-table-header-caption"><?php echo $transaction_details->transmit_no->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_no" class="<?php echo $transaction_details->transmit_no->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transaction_details->SortUrl($transaction_details->transmit_no) ?>',2);"><div id="elh_transaction_details_transmit_no" class="transaction_details_transmit_no">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaction_details->transmit_no->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transaction_details->transmit_no->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transaction_details->transmit_no->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaction_details->transmit_date->Visible) { // transmit_date ?>
	<?php if ($transaction_details->sortUrl($transaction_details->transmit_date) == "") { ?>
		<th data-name="transmit_date" class="<?php echo $transaction_details->transmit_date->headerCellClass() ?>"><div id="elh_transaction_details_transmit_date" class="transaction_details_transmit_date"><div class="ew-table-header-caption"><?php echo $transaction_details->transmit_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_date" class="<?php echo $transaction_details->transmit_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transaction_details->SortUrl($transaction_details->transmit_date) ?>',2);"><div id="elh_transaction_details_transmit_date" class="transaction_details_transmit_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaction_details->transmit_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($transaction_details->transmit_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transaction_details->transmit_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaction_details->direction->Visible) { // direction ?>
	<?php if ($transaction_details->sortUrl($transaction_details->direction) == "") { ?>
		<th data-name="direction" class="<?php echo $transaction_details->direction->headerCellClass() ?>"><div id="elh_transaction_details_direction" class="transaction_details_direction"><div class="ew-table-header-caption"><?php echo $transaction_details->direction->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction" class="<?php echo $transaction_details->direction->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transaction_details->SortUrl($transaction_details->direction) ?>',2);"><div id="elh_transaction_details_direction" class="transaction_details_direction">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaction_details->direction->caption() ?></span><span class="ew-table-header-sort"><?php if ($transaction_details->direction->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transaction_details->direction->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaction_details->approval_status->Visible) { // approval_status ?>
	<?php if ($transaction_details->sortUrl($transaction_details->approval_status) == "") { ?>
		<th data-name="approval_status" class="<?php echo $transaction_details->approval_status->headerCellClass() ?>"><div id="elh_transaction_details_approval_status" class="transaction_details_approval_status"><div class="ew-table-header-caption"><?php echo $transaction_details->approval_status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="approval_status" class="<?php echo $transaction_details->approval_status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transaction_details->SortUrl($transaction_details->approval_status) ?>',2);"><div id="elh_transaction_details_approval_status" class="transaction_details_approval_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaction_details->approval_status->caption() ?></span><span class="ew-table-header-sort"><?php if ($transaction_details->approval_status->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transaction_details->approval_status->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaction_details->document_link->Visible) { // document_link ?>
	<?php if ($transaction_details->sortUrl($transaction_details->document_link) == "") { ?>
		<th data-name="document_link" class="<?php echo $transaction_details->document_link->headerCellClass() ?>"><div id="elh_transaction_details_document_link" class="transaction_details_document_link"><div class="ew-table-header-caption"><?php echo $transaction_details->document_link->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="document_link" class="<?php echo $transaction_details->document_link->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transaction_details->SortUrl($transaction_details->document_link) ?>',2);"><div id="elh_transaction_details_document_link" class="transaction_details_document_link">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaction_details->document_link->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transaction_details->document_link->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transaction_details->document_link->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$transaction_details_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($transaction_details->ExportAll && $transaction_details->isExport()) {
	$transaction_details_list->StopRec = $transaction_details_list->TotalRecs;
} else {

	// Set the last record to display
	if ($transaction_details_list->TotalRecs > $transaction_details_list->StartRec + $transaction_details_list->DisplayRecs - 1)
		$transaction_details_list->StopRec = $transaction_details_list->StartRec + $transaction_details_list->DisplayRecs - 1;
	else
		$transaction_details_list->StopRec = $transaction_details_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $transaction_details_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($transaction_details_list->FormKeyCountName) && ($transaction_details->isGridAdd() || $transaction_details->isGridEdit() || $transaction_details->isConfirm())) {
		$transaction_details_list->KeyCount = $CurrentForm->getValue($transaction_details_list->FormKeyCountName);
		$transaction_details_list->StopRec = $transaction_details_list->StartRec + $transaction_details_list->KeyCount - 1;
	}
}
$transaction_details_list->RecCnt = $transaction_details_list->StartRec - 1;
if ($transaction_details_list->Recordset && !$transaction_details_list->Recordset->EOF) {
	$transaction_details_list->Recordset->moveFirst();
	$selectLimit = $transaction_details_list->UseSelectLimit;
	if (!$selectLimit && $transaction_details_list->StartRec > 1)
		$transaction_details_list->Recordset->move($transaction_details_list->StartRec - 1);
} elseif (!$transaction_details->AllowAddDeleteRow && $transaction_details_list->StopRec == 0) {
	$transaction_details_list->StopRec = $transaction_details->GridAddRowCount;
}

// Initialize aggregate
$transaction_details->RowType = ROWTYPE_AGGREGATEINIT;
$transaction_details->resetAttributes();
$transaction_details_list->renderRow();
if ($transaction_details->isGridAdd())
	$transaction_details_list->RowIndex = 0;
while ($transaction_details_list->RecCnt < $transaction_details_list->StopRec) {
	$transaction_details_list->RecCnt++;
	if ($transaction_details_list->RecCnt >= $transaction_details_list->StartRec) {
		$transaction_details_list->RowCnt++;
		if ($transaction_details->isGridAdd() || $transaction_details->isGridEdit() || $transaction_details->isConfirm()) {
			$transaction_details_list->RowIndex++;
			$CurrentForm->Index = $transaction_details_list->RowIndex;
			if ($CurrentForm->hasValue($transaction_details_list->FormActionName) && $transaction_details_list->EventCancelled)
				$transaction_details_list->RowAction = strval($CurrentForm->getValue($transaction_details_list->FormActionName));
			elseif ($transaction_details->isGridAdd())
				$transaction_details_list->RowAction = "insert";
			else
				$transaction_details_list->RowAction = "";
		}

		// Set up key count
		$transaction_details_list->KeyCount = $transaction_details_list->RowIndex;

		// Init row class and style
		$transaction_details->resetAttributes();
		$transaction_details->CssClass = "";
		if ($transaction_details->isGridAdd()) {
			$transaction_details_list->loadRowValues(); // Load default values
		} else {
			$transaction_details_list->loadRowValues($transaction_details_list->Recordset); // Load row values
		}
		$transaction_details->RowType = ROWTYPE_VIEW; // Render view
		if ($transaction_details->isGridAdd()) // Grid add
			$transaction_details->RowType = ROWTYPE_ADD; // Render add
		if ($transaction_details->isGridAdd() && $transaction_details->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$transaction_details_list->restoreCurrentRowFormValues($transaction_details_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$transaction_details->RowAttrs = array_merge($transaction_details->RowAttrs, array('data-rowindex'=>$transaction_details_list->RowCnt, 'id'=>'r' . $transaction_details_list->RowCnt . '_transaction_details', 'data-rowtype'=>$transaction_details->RowType));

		// Render row
		$transaction_details_list->renderRow();

		// Render list options
		$transaction_details_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($transaction_details_list->RowAction <> "delete" && $transaction_details_list->RowAction <> "insertdelete" && !($transaction_details_list->RowAction == "insert" && $transaction_details->isConfirm() && $transaction_details_list->emptyRow())) {
?>
	<tr<?php echo $transaction_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$transaction_details_list->ListOptions->render("body", "left", $transaction_details_list->RowCnt);
?>
	<?php if ($transaction_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
		<td data-name="firelink_doc_no"<?php echo $transaction_details->firelink_doc_no->cellAttributes() ?>>
<?php if ($transaction_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_firelink_doc_no" class="form-group transaction_details_firelink_doc_no">
<?php
$wrkonchange = "" . trim(@$transaction_details->firelink_doc_no->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transaction_details->firelink_doc_no->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no" class="text-nowrap" style="z-index: <?php echo (9000 - $transaction_details_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no" id="sv_x<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no" value="<?php echo RemoveHtml($transaction_details->firelink_doc_no->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($transaction_details->firelink_doc_no->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transaction_details->firelink_doc_no->getPlaceHolder()) ?>"<?php echo $transaction_details->firelink_doc_no->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($transaction_details->firelink_doc_no->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($transaction_details->firelink_doc_no->ReadOnly || $transaction_details->firelink_doc_no->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $transaction_details->firelink_doc_no->displayValueSeparatorAttribute() ?>" name="x<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no" id="x<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransaction_detailslist.createAutoSuggest({"id":"x<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no","forceSelect":true});
</script>
<?php echo $transaction_details->firelink_doc_no->Lookup->getParamTag("p_x" . $transaction_details_list->RowIndex . "_firelink_doc_no") ?>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" name="o<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no" id="o<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->OldValue) ?>">
<?php } ?>
<?php if ($transaction_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_firelink_doc_no" class="transaction_details_firelink_doc_no">
<span<?php echo $transaction_details->firelink_doc_no->viewAttributes() ?>>
<?php echo $transaction_details->firelink_doc_no->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($transaction_details->submit_no->Visible) { // submit_no ?>
		<td data-name="submit_no"<?php echo $transaction_details->submit_no->cellAttributes() ?>>
<?php if ($transaction_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_submit_no" class="form-group transaction_details_submit_no">
<input type="text" data-table="transaction_details" data-field="x_submit_no" name="x<?php echo $transaction_details_list->RowIndex ?>_submit_no" id="x<?php echo $transaction_details_list->RowIndex ?>_submit_no" size="30" placeholder="<?php echo HtmlEncode($transaction_details->submit_no->getPlaceHolder()) ?>" value="<?php echo $transaction_details->submit_no->EditValue ?>"<?php echo $transaction_details->submit_no->editAttributes() ?>>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_submit_no" name="o<?php echo $transaction_details_list->RowIndex ?>_submit_no" id="o<?php echo $transaction_details_list->RowIndex ?>_submit_no" value="<?php echo HtmlEncode($transaction_details->submit_no->OldValue) ?>">
<?php } ?>
<?php if ($transaction_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_submit_no" class="transaction_details_submit_no">
<span<?php echo $transaction_details->submit_no->viewAttributes() ?>>
<?php echo $transaction_details->submit_no->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($transaction_details->revision_no->Visible) { // revision_no ?>
		<td data-name="revision_no"<?php echo $transaction_details->revision_no->cellAttributes() ?>>
<?php if ($transaction_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_revision_no" class="form-group transaction_details_revision_no">
<input type="text" data-table="transaction_details" data-field="x_revision_no" name="x<?php echo $transaction_details_list->RowIndex ?>_revision_no" id="x<?php echo $transaction_details_list->RowIndex ?>_revision_no" size="30" placeholder="<?php echo HtmlEncode($transaction_details->revision_no->getPlaceHolder()) ?>" value="<?php echo $transaction_details->revision_no->EditValue ?>"<?php echo $transaction_details->revision_no->editAttributes() ?>>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_revision_no" name="o<?php echo $transaction_details_list->RowIndex ?>_revision_no" id="o<?php echo $transaction_details_list->RowIndex ?>_revision_no" value="<?php echo HtmlEncode($transaction_details->revision_no->OldValue) ?>">
<?php } ?>
<?php if ($transaction_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_revision_no" class="transaction_details_revision_no">
<span<?php echo $transaction_details->revision_no->viewAttributes() ?>>
<?php echo $transaction_details->revision_no->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($transaction_details->transmit_no->Visible) { // transmit_no ?>
		<td data-name="transmit_no"<?php echo $transaction_details->transmit_no->cellAttributes() ?>>
<?php if ($transaction_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_transmit_no" class="form-group transaction_details_transmit_no">
<?php
$wrkonchange = "" . trim(@$transaction_details->transmit_no->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transaction_details->transmit_no->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $transaction_details_list->RowIndex ?>_transmit_no" class="text-nowrap" style="z-index: <?php echo (9000 - $transaction_details_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $transaction_details_list->RowIndex ?>_transmit_no" id="sv_x<?php echo $transaction_details_list->RowIndex ?>_transmit_no" value="<?php echo RemoveHtml($transaction_details->transmit_no->EditValue) ?>" placeholder="<?php echo HtmlEncode($transaction_details->transmit_no->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transaction_details->transmit_no->getPlaceHolder()) ?>"<?php echo $transaction_details->transmit_no->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($transaction_details->transmit_no->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $transaction_details_list->RowIndex ?>_transmit_no',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($transaction_details->transmit_no->ReadOnly || $transaction_details->transmit_no->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "transmit_details") && !$transaction_details->transmit_no->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $transaction_details_list->RowIndex ?>_transmit_no" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $transaction_details->transmit_no->caption() ?>" data-title="<?php echo $transaction_details->transmit_no->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $transaction_details_list->RowIndex ?>_transmit_no',url:'transmit_detailsaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_no" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $transaction_details->transmit_no->displayValueSeparatorAttribute() ?>" name="x<?php echo $transaction_details_list->RowIndex ?>_transmit_no" id="x<?php echo $transaction_details_list->RowIndex ?>_transmit_no" value="<?php echo HtmlEncode($transaction_details->transmit_no->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransaction_detailslist.createAutoSuggest({"id":"x<?php echo $transaction_details_list->RowIndex ?>_transmit_no","forceSelect":true});
</script>
<?php echo $transaction_details->transmit_no->Lookup->getParamTag("p_x" . $transaction_details_list->RowIndex . "_transmit_no") ?>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_no" name="o<?php echo $transaction_details_list->RowIndex ?>_transmit_no" id="o<?php echo $transaction_details_list->RowIndex ?>_transmit_no" value="<?php echo HtmlEncode($transaction_details->transmit_no->OldValue) ?>">
<?php } ?>
<?php if ($transaction_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_transmit_no" class="transaction_details_transmit_no">
<span<?php echo $transaction_details->transmit_no->viewAttributes() ?>>
<?php echo $transaction_details->transmit_no->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($transaction_details->transmit_date->Visible) { // transmit_date ?>
		<td data-name="transmit_date"<?php echo $transaction_details->transmit_date->cellAttributes() ?>>
<?php if ($transaction_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_transmit_date" class="form-group transaction_details_transmit_date">
<input type="text" data-table="transaction_details" data-field="x_transmit_date" name="x<?php echo $transaction_details_list->RowIndex ?>_transmit_date" id="x<?php echo $transaction_details_list->RowIndex ?>_transmit_date" placeholder="<?php echo HtmlEncode($transaction_details->transmit_date->getPlaceHolder()) ?>" value="<?php echo $transaction_details->transmit_date->EditValue ?>"<?php echo $transaction_details->transmit_date->editAttributes() ?>>
<?php if (!$transaction_details->transmit_date->ReadOnly && !$transaction_details->transmit_date->Disabled && !isset($transaction_details->transmit_date->EditAttrs["readonly"]) && !isset($transaction_details->transmit_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftransaction_detailslist", "x<?php echo $transaction_details_list->RowIndex ?>_transmit_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_date" name="o<?php echo $transaction_details_list->RowIndex ?>_transmit_date" id="o<?php echo $transaction_details_list->RowIndex ?>_transmit_date" value="<?php echo HtmlEncode($transaction_details->transmit_date->OldValue) ?>">
<?php } ?>
<?php if ($transaction_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_transmit_date" class="transaction_details_transmit_date">
<span<?php echo $transaction_details->transmit_date->viewAttributes() ?>>
<?php echo $transaction_details->transmit_date->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($transaction_details->direction->Visible) { // direction ?>
		<td data-name="direction"<?php echo $transaction_details->direction->cellAttributes() ?>>
<?php if ($transaction_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_direction" class="form-group transaction_details_direction">
<div id="tp_x<?php echo $transaction_details_list->RowIndex ?>_direction" class="ew-template"><input type="radio" class="form-check-input" data-table="transaction_details" data-field="x_direction" data-value-separator="<?php echo $transaction_details->direction->displayValueSeparatorAttribute() ?>" name="x<?php echo $transaction_details_list->RowIndex ?>_direction" id="x<?php echo $transaction_details_list->RowIndex ?>_direction" value="{value}"<?php echo $transaction_details->direction->editAttributes() ?>></div>
<div id="dsl_x<?php echo $transaction_details_list->RowIndex ?>_direction" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transaction_details->direction->radioButtonListHtml(FALSE, "x{$transaction_details_list->RowIndex}_direction") ?>
</div></div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_direction" name="o<?php echo $transaction_details_list->RowIndex ?>_direction" id="o<?php echo $transaction_details_list->RowIndex ?>_direction" value="<?php echo HtmlEncode($transaction_details->direction->OldValue) ?>">
<?php } ?>
<?php if ($transaction_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_direction" class="transaction_details_direction">
<span<?php echo $transaction_details->direction->viewAttributes() ?>>
<?php echo $transaction_details->direction->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($transaction_details->approval_status->Visible) { // approval_status ?>
		<td data-name="approval_status"<?php echo $transaction_details->approval_status->cellAttributes() ?>>
<?php if ($transaction_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_approval_status" class="form-group transaction_details_approval_status">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($transaction_details->approval_status->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $transaction_details->approval_status->ViewValue ?></button>
		<div id="dsl_x<?php echo $transaction_details_list->RowIndex ?>_approval_status" data-repeatcolumn="5" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $transaction_details->approval_status->radioButtonListHtml(TRUE, "x{$transaction_details_list->RowIndex}_approval_status") ?>
			</div><!-- /.ew-items ##-->
		</div><!-- /.dropdown-menu ##-->
		<div id="tp_x<?php echo $transaction_details_list->RowIndex ?>_approval_status" class="ew-template"><input type="radio" class="form-check-input" data-table="transaction_details" data-field="x_approval_status" data-value-separator="<?php echo $transaction_details->approval_status->displayValueSeparatorAttribute() ?>" name="x<?php echo $transaction_details_list->RowIndex ?>_approval_status" id="x<?php echo $transaction_details_list->RowIndex ?>_approval_status" value="{value}"<?php echo $transaction_details->approval_status->editAttributes() ?>></div>
	</div><!-- /.btn-group ##-->
	<?php if (!$transaction_details->approval_status->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fa fa-times ew-icon"></i>
	</button>
<?php echo $transaction_details->approval_status->Lookup->getParamTag("p_x" . $transaction_details_list->RowIndex . "_approval_status") ?>
	<?php } ?>
</div><!-- /.ew-dropdown-list ##-->
</span>
<input type="hidden" data-table="transaction_details" data-field="x_approval_status" name="o<?php echo $transaction_details_list->RowIndex ?>_approval_status" id="o<?php echo $transaction_details_list->RowIndex ?>_approval_status" value="<?php echo HtmlEncode($transaction_details->approval_status->OldValue) ?>">
<?php } ?>
<?php if ($transaction_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_approval_status" class="transaction_details_approval_status">
<span<?php echo $transaction_details->approval_status->viewAttributes() ?>>
<?php echo $transaction_details->approval_status->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($transaction_details->document_link->Visible) { // document_link ?>
		<td data-name="document_link"<?php echo $transaction_details->document_link->cellAttributes() ?>>
<?php if ($transaction_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_document_link" class="form-group transaction_details_document_link">
<div id="fd_x<?php echo $transaction_details_list->RowIndex ?>_document_link">
<span title="<?php echo $transaction_details->document_link->title() ? $transaction_details->document_link->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($transaction_details->document_link->ReadOnly || $transaction_details->document_link->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="transaction_details" data-field="x_document_link" name="x<?php echo $transaction_details_list->RowIndex ?>_document_link" id="x<?php echo $transaction_details_list->RowIndex ?>_document_link"<?php echo $transaction_details->document_link->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $transaction_details_list->RowIndex ?>_document_link" id= "fn_x<?php echo $transaction_details_list->RowIndex ?>_document_link" value="<?php echo $transaction_details->document_link->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $transaction_details_list->RowIndex ?>_document_link" id= "fa_x<?php echo $transaction_details_list->RowIndex ?>_document_link" value="0">
<input type="hidden" name="fs_x<?php echo $transaction_details_list->RowIndex ?>_document_link" id= "fs_x<?php echo $transaction_details_list->RowIndex ?>_document_link" value="0">
<input type="hidden" name="fx_x<?php echo $transaction_details_list->RowIndex ?>_document_link" id= "fx_x<?php echo $transaction_details_list->RowIndex ?>_document_link" value="<?php echo $transaction_details->document_link->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $transaction_details_list->RowIndex ?>_document_link" id= "fm_x<?php echo $transaction_details_list->RowIndex ?>_document_link" value="<?php echo $transaction_details->document_link->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $transaction_details_list->RowIndex ?>_document_link" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_document_link" name="o<?php echo $transaction_details_list->RowIndex ?>_document_link" id="o<?php echo $transaction_details_list->RowIndex ?>_document_link" value="<?php echo HtmlEncode($transaction_details->document_link->OldValue) ?>">
<?php } ?>
<?php if ($transaction_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transaction_details_list->RowCnt ?>_transaction_details_document_link" class="transaction_details_document_link">
<span<?php echo $transaction_details->document_link->viewAttributes() ?>>
<?php echo GetFileViewTag($transaction_details->document_link, $transaction_details->document_link->getViewValue()) ?>
</span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$transaction_details_list->ListOptions->render("body", "right", $transaction_details_list->RowCnt);
?>
	</tr>
<?php if ($transaction_details->RowType == ROWTYPE_ADD || $transaction_details->RowType == ROWTYPE_EDIT) { ?>
<script>
ftransaction_detailslist.updateLists(<?php echo $transaction_details_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$transaction_details->isGridAdd())
		if (!$transaction_details_list->Recordset->EOF)
			$transaction_details_list->Recordset->moveNext();
}
?>
<?php
	if ($transaction_details->isGridAdd() || $transaction_details->isGridEdit()) {
		$transaction_details_list->RowIndex = '$rowindex$';
		$transaction_details_list->loadRowValues();

		// Set row properties
		$transaction_details->resetAttributes();
		$transaction_details->RowAttrs = array_merge($transaction_details->RowAttrs, array('data-rowindex'=>$transaction_details_list->RowIndex, 'id'=>'r0_transaction_details', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($transaction_details->RowAttrs["class"], "ew-template");
		$transaction_details->RowType = ROWTYPE_ADD;

		// Render row
		$transaction_details_list->renderRow();

		// Render list options
		$transaction_details_list->renderListOptions();
		$transaction_details_list->StartRowCnt = 0;
?>
	<tr<?php echo $transaction_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$transaction_details_list->ListOptions->render("body", "left", $transaction_details_list->RowIndex);
?>
	<?php if ($transaction_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
		<td data-name="firelink_doc_no">
<span id="el$rowindex$_transaction_details_firelink_doc_no" class="form-group transaction_details_firelink_doc_no">
<?php
$wrkonchange = "" . trim(@$transaction_details->firelink_doc_no->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transaction_details->firelink_doc_no->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no" class="text-nowrap" style="z-index: <?php echo (9000 - $transaction_details_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no" id="sv_x<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no" value="<?php echo RemoveHtml($transaction_details->firelink_doc_no->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($transaction_details->firelink_doc_no->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transaction_details->firelink_doc_no->getPlaceHolder()) ?>"<?php echo $transaction_details->firelink_doc_no->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($transaction_details->firelink_doc_no->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($transaction_details->firelink_doc_no->ReadOnly || $transaction_details->firelink_doc_no->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $transaction_details->firelink_doc_no->displayValueSeparatorAttribute() ?>" name="x<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no" id="x<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransaction_detailslist.createAutoSuggest({"id":"x<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no","forceSelect":true});
</script>
<?php echo $transaction_details->firelink_doc_no->Lookup->getParamTag("p_x" . $transaction_details_list->RowIndex . "_firelink_doc_no") ?>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" name="o<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no" id="o<?php echo $transaction_details_list->RowIndex ?>_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($transaction_details->submit_no->Visible) { // submit_no ?>
		<td data-name="submit_no">
<span id="el$rowindex$_transaction_details_submit_no" class="form-group transaction_details_submit_no">
<input type="text" data-table="transaction_details" data-field="x_submit_no" name="x<?php echo $transaction_details_list->RowIndex ?>_submit_no" id="x<?php echo $transaction_details_list->RowIndex ?>_submit_no" size="30" placeholder="<?php echo HtmlEncode($transaction_details->submit_no->getPlaceHolder()) ?>" value="<?php echo $transaction_details->submit_no->EditValue ?>"<?php echo $transaction_details->submit_no->editAttributes() ?>>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_submit_no" name="o<?php echo $transaction_details_list->RowIndex ?>_submit_no" id="o<?php echo $transaction_details_list->RowIndex ?>_submit_no" value="<?php echo HtmlEncode($transaction_details->submit_no->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($transaction_details->revision_no->Visible) { // revision_no ?>
		<td data-name="revision_no">
<span id="el$rowindex$_transaction_details_revision_no" class="form-group transaction_details_revision_no">
<input type="text" data-table="transaction_details" data-field="x_revision_no" name="x<?php echo $transaction_details_list->RowIndex ?>_revision_no" id="x<?php echo $transaction_details_list->RowIndex ?>_revision_no" size="30" placeholder="<?php echo HtmlEncode($transaction_details->revision_no->getPlaceHolder()) ?>" value="<?php echo $transaction_details->revision_no->EditValue ?>"<?php echo $transaction_details->revision_no->editAttributes() ?>>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_revision_no" name="o<?php echo $transaction_details_list->RowIndex ?>_revision_no" id="o<?php echo $transaction_details_list->RowIndex ?>_revision_no" value="<?php echo HtmlEncode($transaction_details->revision_no->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($transaction_details->transmit_no->Visible) { // transmit_no ?>
		<td data-name="transmit_no">
<span id="el$rowindex$_transaction_details_transmit_no" class="form-group transaction_details_transmit_no">
<?php
$wrkonchange = "" . trim(@$transaction_details->transmit_no->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transaction_details->transmit_no->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $transaction_details_list->RowIndex ?>_transmit_no" class="text-nowrap" style="z-index: <?php echo (9000 - $transaction_details_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $transaction_details_list->RowIndex ?>_transmit_no" id="sv_x<?php echo $transaction_details_list->RowIndex ?>_transmit_no" value="<?php echo RemoveHtml($transaction_details->transmit_no->EditValue) ?>" placeholder="<?php echo HtmlEncode($transaction_details->transmit_no->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transaction_details->transmit_no->getPlaceHolder()) ?>"<?php echo $transaction_details->transmit_no->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($transaction_details->transmit_no->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $transaction_details_list->RowIndex ?>_transmit_no',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($transaction_details->transmit_no->ReadOnly || $transaction_details->transmit_no->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "transmit_details") && !$transaction_details->transmit_no->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $transaction_details_list->RowIndex ?>_transmit_no" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $transaction_details->transmit_no->caption() ?>" data-title="<?php echo $transaction_details->transmit_no->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $transaction_details_list->RowIndex ?>_transmit_no',url:'transmit_detailsaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_no" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $transaction_details->transmit_no->displayValueSeparatorAttribute() ?>" name="x<?php echo $transaction_details_list->RowIndex ?>_transmit_no" id="x<?php echo $transaction_details_list->RowIndex ?>_transmit_no" value="<?php echo HtmlEncode($transaction_details->transmit_no->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransaction_detailslist.createAutoSuggest({"id":"x<?php echo $transaction_details_list->RowIndex ?>_transmit_no","forceSelect":true});
</script>
<?php echo $transaction_details->transmit_no->Lookup->getParamTag("p_x" . $transaction_details_list->RowIndex . "_transmit_no") ?>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_no" name="o<?php echo $transaction_details_list->RowIndex ?>_transmit_no" id="o<?php echo $transaction_details_list->RowIndex ?>_transmit_no" value="<?php echo HtmlEncode($transaction_details->transmit_no->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($transaction_details->transmit_date->Visible) { // transmit_date ?>
		<td data-name="transmit_date">
<span id="el$rowindex$_transaction_details_transmit_date" class="form-group transaction_details_transmit_date">
<input type="text" data-table="transaction_details" data-field="x_transmit_date" name="x<?php echo $transaction_details_list->RowIndex ?>_transmit_date" id="x<?php echo $transaction_details_list->RowIndex ?>_transmit_date" placeholder="<?php echo HtmlEncode($transaction_details->transmit_date->getPlaceHolder()) ?>" value="<?php echo $transaction_details->transmit_date->EditValue ?>"<?php echo $transaction_details->transmit_date->editAttributes() ?>>
<?php if (!$transaction_details->transmit_date->ReadOnly && !$transaction_details->transmit_date->Disabled && !isset($transaction_details->transmit_date->EditAttrs["readonly"]) && !isset($transaction_details->transmit_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftransaction_detailslist", "x<?php echo $transaction_details_list->RowIndex ?>_transmit_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_date" name="o<?php echo $transaction_details_list->RowIndex ?>_transmit_date" id="o<?php echo $transaction_details_list->RowIndex ?>_transmit_date" value="<?php echo HtmlEncode($transaction_details->transmit_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($transaction_details->direction->Visible) { // direction ?>
		<td data-name="direction">
<span id="el$rowindex$_transaction_details_direction" class="form-group transaction_details_direction">
<div id="tp_x<?php echo $transaction_details_list->RowIndex ?>_direction" class="ew-template"><input type="radio" class="form-check-input" data-table="transaction_details" data-field="x_direction" data-value-separator="<?php echo $transaction_details->direction->displayValueSeparatorAttribute() ?>" name="x<?php echo $transaction_details_list->RowIndex ?>_direction" id="x<?php echo $transaction_details_list->RowIndex ?>_direction" value="{value}"<?php echo $transaction_details->direction->editAttributes() ?>></div>
<div id="dsl_x<?php echo $transaction_details_list->RowIndex ?>_direction" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transaction_details->direction->radioButtonListHtml(FALSE, "x{$transaction_details_list->RowIndex}_direction") ?>
</div></div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_direction" name="o<?php echo $transaction_details_list->RowIndex ?>_direction" id="o<?php echo $transaction_details_list->RowIndex ?>_direction" value="<?php echo HtmlEncode($transaction_details->direction->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($transaction_details->approval_status->Visible) { // approval_status ?>
		<td data-name="approval_status">
<span id="el$rowindex$_transaction_details_approval_status" class="form-group transaction_details_approval_status">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($transaction_details->approval_status->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $transaction_details->approval_status->ViewValue ?></button>
		<div id="dsl_x<?php echo $transaction_details_list->RowIndex ?>_approval_status" data-repeatcolumn="5" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $transaction_details->approval_status->radioButtonListHtml(TRUE, "x{$transaction_details_list->RowIndex}_approval_status") ?>
			</div><!-- /.ew-items ##-->
		</div><!-- /.dropdown-menu ##-->
		<div id="tp_x<?php echo $transaction_details_list->RowIndex ?>_approval_status" class="ew-template"><input type="radio" class="form-check-input" data-table="transaction_details" data-field="x_approval_status" data-value-separator="<?php echo $transaction_details->approval_status->displayValueSeparatorAttribute() ?>" name="x<?php echo $transaction_details_list->RowIndex ?>_approval_status" id="x<?php echo $transaction_details_list->RowIndex ?>_approval_status" value="{value}"<?php echo $transaction_details->approval_status->editAttributes() ?>></div>
	</div><!-- /.btn-group ##-->
	<?php if (!$transaction_details->approval_status->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fa fa-times ew-icon"></i>
	</button>
<?php echo $transaction_details->approval_status->Lookup->getParamTag("p_x" . $transaction_details_list->RowIndex . "_approval_status") ?>
	<?php } ?>
</div><!-- /.ew-dropdown-list ##-->
</span>
<input type="hidden" data-table="transaction_details" data-field="x_approval_status" name="o<?php echo $transaction_details_list->RowIndex ?>_approval_status" id="o<?php echo $transaction_details_list->RowIndex ?>_approval_status" value="<?php echo HtmlEncode($transaction_details->approval_status->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($transaction_details->document_link->Visible) { // document_link ?>
		<td data-name="document_link">
<span id="el$rowindex$_transaction_details_document_link" class="form-group transaction_details_document_link">
<div id="fd_x<?php echo $transaction_details_list->RowIndex ?>_document_link">
<span title="<?php echo $transaction_details->document_link->title() ? $transaction_details->document_link->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($transaction_details->document_link->ReadOnly || $transaction_details->document_link->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="transaction_details" data-field="x_document_link" name="x<?php echo $transaction_details_list->RowIndex ?>_document_link" id="x<?php echo $transaction_details_list->RowIndex ?>_document_link"<?php echo $transaction_details->document_link->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $transaction_details_list->RowIndex ?>_document_link" id= "fn_x<?php echo $transaction_details_list->RowIndex ?>_document_link" value="<?php echo $transaction_details->document_link->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $transaction_details_list->RowIndex ?>_document_link" id= "fa_x<?php echo $transaction_details_list->RowIndex ?>_document_link" value="0">
<input type="hidden" name="fs_x<?php echo $transaction_details_list->RowIndex ?>_document_link" id= "fs_x<?php echo $transaction_details_list->RowIndex ?>_document_link" value="0">
<input type="hidden" name="fx_x<?php echo $transaction_details_list->RowIndex ?>_document_link" id= "fx_x<?php echo $transaction_details_list->RowIndex ?>_document_link" value="<?php echo $transaction_details->document_link->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $transaction_details_list->RowIndex ?>_document_link" id= "fm_x<?php echo $transaction_details_list->RowIndex ?>_document_link" value="<?php echo $transaction_details->document_link->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $transaction_details_list->RowIndex ?>_document_link" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_document_link" name="o<?php echo $transaction_details_list->RowIndex ?>_document_link" id="o<?php echo $transaction_details_list->RowIndex ?>_document_link" value="<?php echo HtmlEncode($transaction_details->document_link->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$transaction_details_list->ListOptions->render("body", "right", $transaction_details_list->RowIndex);
?>
<script>
ftransaction_detailslist.updateLists(<?php echo $transaction_details_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($transaction_details->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $transaction_details_list->FormKeyCountName ?>" id="<?php echo $transaction_details_list->FormKeyCountName ?>" value="<?php echo $transaction_details_list->KeyCount ?>">
<?php echo $transaction_details_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$transaction_details->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($transaction_details_list->Recordset)
	$transaction_details_list->Recordset->Close();
?>
<?php if (!$transaction_details->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$transaction_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($transaction_details_list->Pager)) $transaction_details_list->Pager = new NumericPager($transaction_details_list->StartRec, $transaction_details_list->DisplayRecs, $transaction_details_list->TotalRecs, $transaction_details_list->RecRange, $transaction_details_list->AutoHidePager) ?>
<?php if ($transaction_details_list->Pager->RecordCount > 0 && $transaction_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($transaction_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_list->pageUrl() ?>start=<?php echo $transaction_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($transaction_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_list->pageUrl() ?>start=<?php echo $transaction_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($transaction_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $transaction_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($transaction_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_list->pageUrl() ?>start=<?php echo $transaction_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($transaction_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $transaction_details_list->pageUrl() ?>start=<?php echo $transaction_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($transaction_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $transaction_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $transaction_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $transaction_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($transaction_details_list->TotalRecs > 0 && (!$transaction_details_list->AutoHidePageSizeSelector || $transaction_details_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="transaction_details">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="50"<?php if ($transaction_details_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($transaction_details_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="150"<?php if ($transaction_details_list->DisplayRecs == 150) { ?> selected<?php } ?>>150</option>
<option value="ALL"<?php if ($transaction_details->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $transaction_details_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($transaction_details_list->TotalRecs == 0 && !$transaction_details->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $transaction_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$transaction_details_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$transaction_details->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$transaction_details_list->terminate();
?>