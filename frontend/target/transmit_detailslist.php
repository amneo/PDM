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

// Validate form
ftransmit_detailslist.validate = function() {
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
		<?php if ($transmit_details_list->transmittal_no->Required) { ?>
			elm = this.getElements("x" + infix + "_transmittal_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->transmittal_no->caption(), $transmit_details->transmittal_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_list->project_name->Required) { ?>
			elm = this.getElements("x" + infix + "_project_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->project_name->caption(), $transmit_details->project_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_list->delivery_location->Required) { ?>
			elm = this.getElements("x" + infix + "_delivery_location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->delivery_location->caption(), $transmit_details->delivery_location->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_list->addressed_to->Required) { ?>
			elm = this.getElements("x" + infix + "_addressed_to");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->addressed_to->caption(), $transmit_details->addressed_to->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_list->remarks->Required) { ?>
			elm = this.getElements("x" + infix + "_remarks");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->remarks->caption(), $transmit_details->remarks->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_list->ack_rcvd->Required) { ?>
			elm = this.getElements("x" + infix + "_ack_rcvd");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->ack_rcvd->caption(), $transmit_details->ack_rcvd->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_list->ack_document->Required) { ?>
			felm = this.getElements("x" + infix + "_ack_document");
			elm = this.getElements("fn_x" + infix + "_ack_document");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $transmit_details->ack_document->caption(), $transmit_details->ack_document->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_list->transmit_mode->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_mode[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->transmit_mode->caption(), $transmit_details->transmit_mode->RequiredErrorMessage)) ?>");
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
ftransmit_detailslist.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "transmittal_no", false)) return false;
	if (ew.valueChanged(fobj, infix, "project_name", false)) return false;
	if (ew.valueChanged(fobj, infix, "delivery_location", false)) return false;
	if (ew.valueChanged(fobj, infix, "addressed_to", false)) return false;
	if (ew.valueChanged(fobj, infix, "remarks", false)) return false;
	if (ew.valueChanged(fobj, infix, "ack_rcvd", true)) return false;
	if (ew.valueChanged(fobj, infix, "ack_document", false)) return false;
	if (ew.valueChanged(fobj, infix, "transmit_mode[]", false)) return false;
	return true;
}

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
ftransmit_detailslist.lists["x_transmit_mode[]"] = <?php echo $transmit_details_list->transmit_mode->Lookup->toClientList() ?>;
ftransmit_detailslist.lists["x_transmit_mode[]"].options = <?php echo JsonEncode($transmit_details_list->transmit_mode->lookupOptions()) ?>;

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
<?php if ($transmit_details->transmit_mode->Visible) { // transmit_mode ?>
	<?php if ($transmit_details->sortUrl($transmit_details->transmit_mode) == "") { ?>
		<th data-name="transmit_mode" class="<?php echo $transmit_details->transmit_mode->headerCellClass() ?>"><div id="elh_transmit_details_transmit_mode" class="transmit_details_transmit_mode"><div class="ew-table-header-caption"><?php echo $transmit_details->transmit_mode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="transmit_mode" class="<?php echo $transmit_details->transmit_mode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $transmit_details->SortUrl($transmit_details->transmit_mode) ?>',2);"><div id="elh_transmit_details_transmit_mode" class="transmit_details_transmit_mode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transmit_details->transmit_mode->caption() ?></span><span class="ew-table-header-sort"><?php if ($transmit_details->transmit_mode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($transmit_details->transmit_mode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
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

// Restore number of post back records
if ($CurrentForm && $transmit_details_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($transmit_details_list->FormKeyCountName) && ($transmit_details->isGridAdd() || $transmit_details->isGridEdit() || $transmit_details->isConfirm())) {
		$transmit_details_list->KeyCount = $CurrentForm->getValue($transmit_details_list->FormKeyCountName);
		$transmit_details_list->StopRec = $transmit_details_list->StartRec + $transmit_details_list->KeyCount - 1;
	}
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
if ($transmit_details->isGridAdd())
	$transmit_details_list->RowIndex = 0;
if ($transmit_details->isGridEdit())
	$transmit_details_list->RowIndex = 0;
while ($transmit_details_list->RecCnt < $transmit_details_list->StopRec) {
	$transmit_details_list->RecCnt++;
	if ($transmit_details_list->RecCnt >= $transmit_details_list->StartRec) {
		$transmit_details_list->RowCnt++;
		if ($transmit_details->isGridAdd() || $transmit_details->isGridEdit() || $transmit_details->isConfirm()) {
			$transmit_details_list->RowIndex++;
			$CurrentForm->Index = $transmit_details_list->RowIndex;
			if ($CurrentForm->hasValue($transmit_details_list->FormActionName) && $transmit_details_list->EventCancelled)
				$transmit_details_list->RowAction = strval($CurrentForm->getValue($transmit_details_list->FormActionName));
			elseif ($transmit_details->isGridAdd())
				$transmit_details_list->RowAction = "insert";
			else
				$transmit_details_list->RowAction = "";
		}

		// Set up key count
		$transmit_details_list->KeyCount = $transmit_details_list->RowIndex;

		// Init row class and style
		$transmit_details->resetAttributes();
		$transmit_details->CssClass = "";
		if ($transmit_details->isGridAdd()) {
			$transmit_details_list->loadRowValues(); // Load default values
		} else {
			$transmit_details_list->loadRowValues($transmit_details_list->Recordset); // Load row values
		}
		$transmit_details->RowType = ROWTYPE_VIEW; // Render view
		if ($transmit_details->isGridAdd()) // Grid add
			$transmit_details->RowType = ROWTYPE_ADD; // Render add
		if ($transmit_details->isGridAdd() && $transmit_details->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$transmit_details_list->restoreCurrentRowFormValues($transmit_details_list->RowIndex); // Restore form values
		if ($transmit_details->isGridEdit()) { // Grid edit
			if ($transmit_details->EventCancelled)
				$transmit_details_list->restoreCurrentRowFormValues($transmit_details_list->RowIndex); // Restore form values
			if ($transmit_details_list->RowAction == "insert")
				$transmit_details->RowType = ROWTYPE_ADD; // Render add
			else
				$transmit_details->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($transmit_details->isGridEdit() && ($transmit_details->RowType == ROWTYPE_EDIT || $transmit_details->RowType == ROWTYPE_ADD) && $transmit_details->EventCancelled) // Update failed
			$transmit_details_list->restoreCurrentRowFormValues($transmit_details_list->RowIndex); // Restore form values
		if ($transmit_details->RowType == ROWTYPE_EDIT) // Edit row
			$transmit_details_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$transmit_details->RowAttrs = array_merge($transmit_details->RowAttrs, array('data-rowindex'=>$transmit_details_list->RowCnt, 'id'=>'r' . $transmit_details_list->RowCnt . '_transmit_details', 'data-rowtype'=>$transmit_details->RowType));

		// Render row
		$transmit_details_list->renderRow();

		// Render list options
		$transmit_details_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($transmit_details_list->RowAction <> "delete" && $transmit_details_list->RowAction <> "insertdelete" && !($transmit_details_list->RowAction == "insert" && $transmit_details->isConfirm() && $transmit_details_list->emptyRow())) {
?>
	<tr<?php echo $transmit_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$transmit_details_list->ListOptions->render("body", "left", $transmit_details_list->RowCnt);
?>
	<?php if ($transmit_details->transmittal_no->Visible) { // transmittal_no ?>
		<td data-name="transmittal_no"<?php echo $transmit_details->transmittal_no->cellAttributes() ?>>
<?php if ($transmit_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_transmittal_no" class="form-group transmit_details_transmittal_no">
<input type="text" data-table="transmit_details" data-field="x_transmittal_no" name="x<?php echo $transmit_details_list->RowIndex ?>_transmittal_no" id="x<?php echo $transmit_details_list->RowIndex ?>_transmittal_no" size="30" placeholder="<?php echo HtmlEncode($transmit_details->transmittal_no->getPlaceHolder()) ?>" value="<?php echo $transmit_details->transmittal_no->EditValue ?>"<?php echo $transmit_details->transmittal_no->editAttributes() ?>>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_transmittal_no" name="o<?php echo $transmit_details_list->RowIndex ?>_transmittal_no" id="o<?php echo $transmit_details_list->RowIndex ?>_transmittal_no" value="<?php echo HtmlEncode($transmit_details->transmittal_no->OldValue) ?>">
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_transmittal_no" class="form-group transmit_details_transmittal_no">
<span<?php echo $transmit_details->transmittal_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transmit_details->transmittal_no->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_transmittal_no" name="x<?php echo $transmit_details_list->RowIndex ?>_transmittal_no" id="x<?php echo $transmit_details_list->RowIndex ?>_transmittal_no" value="<?php echo HtmlEncode($transmit_details->transmittal_no->CurrentValue) ?>">
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_transmittal_no" class="transmit_details_transmittal_no">
<span<?php echo $transmit_details->transmittal_no->viewAttributes() ?>>
<?php echo $transmit_details->transmittal_no->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="transmit_details" data-field="x_transmit_id" name="x<?php echo $transmit_details_list->RowIndex ?>_transmit_id" id="x<?php echo $transmit_details_list->RowIndex ?>_transmit_id" value="<?php echo HtmlEncode($transmit_details->transmit_id->CurrentValue) ?>">
<input type="hidden" data-table="transmit_details" data-field="x_transmit_id" name="o<?php echo $transmit_details_list->RowIndex ?>_transmit_id" id="o<?php echo $transmit_details_list->RowIndex ?>_transmit_id" value="<?php echo HtmlEncode($transmit_details->transmit_id->OldValue) ?>">
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_EDIT || $transmit_details->CurrentMode == "edit") { ?>
<input type="hidden" data-table="transmit_details" data-field="x_transmit_id" name="x<?php echo $transmit_details_list->RowIndex ?>_transmit_id" id="x<?php echo $transmit_details_list->RowIndex ?>_transmit_id" value="<?php echo HtmlEncode($transmit_details->transmit_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($transmit_details->project_name->Visible) { // project_name ?>
		<td data-name="project_name"<?php echo $transmit_details->project_name->cellAttributes() ?>>
<?php if ($transmit_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_project_name" class="form-group transmit_details_project_name">
<?php
$wrkonchange = "" . trim(@$transmit_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transmit_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $transmit_details_list->RowIndex ?>_project_name" class="text-nowrap" style="z-index: <?php echo (9000 - $transmit_details_list->RowCnt * 10) ?>">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $transmit_details_list->RowIndex ?>_project_name" id="sv_x<?php echo $transmit_details_list->RowIndex ?>_project_name" value="<?php echo RemoveHtml($transmit_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($transmit_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transmit_details->project_name->getPlaceHolder()) ?>"<?php echo $transmit_details->project_name->editAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "project_details") && !$transmit_details->project_name->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $transmit_details_list->RowIndex ?>_project_name" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $transmit_details->project_name->caption() ?>" data-title="<?php echo $transmit_details->project_name->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $transmit_details_list->RowIndex ?>_project_name',url:'project_detailsaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
	</div>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_project_name" data-value-separator="<?php echo $transmit_details->project_name->displayValueSeparatorAttribute() ?>" name="x<?php echo $transmit_details_list->RowIndex ?>_project_name" id="x<?php echo $transmit_details_list->RowIndex ?>_project_name" value="<?php echo HtmlEncode($transmit_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransmit_detailslist.createAutoSuggest({"id":"x<?php echo $transmit_details_list->RowIndex ?>_project_name","forceSelect":true});
</script>
<?php echo $transmit_details->project_name->Lookup->getParamTag("p_x" . $transmit_details_list->RowIndex . "_project_name") ?>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_project_name" name="o<?php echo $transmit_details_list->RowIndex ?>_project_name" id="o<?php echo $transmit_details_list->RowIndex ?>_project_name" value="<?php echo HtmlEncode($transmit_details->project_name->OldValue) ?>">
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_project_name" class="form-group transmit_details_project_name">
<span<?php echo $transmit_details->project_name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transmit_details->project_name->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_project_name" name="x<?php echo $transmit_details_list->RowIndex ?>_project_name" id="x<?php echo $transmit_details_list->RowIndex ?>_project_name" value="<?php echo HtmlEncode($transmit_details->project_name->CurrentValue) ?>">
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_project_name" class="transmit_details_project_name">
<span<?php echo $transmit_details->project_name->viewAttributes() ?>>
<?php echo $transmit_details->project_name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($transmit_details->delivery_location->Visible) { // delivery_location ?>
		<td data-name="delivery_location"<?php echo $transmit_details->delivery_location->cellAttributes() ?>>
<?php if ($transmit_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_delivery_location" class="form-group transmit_details_delivery_location">
<input type="text" data-table="transmit_details" data-field="x_delivery_location" name="x<?php echo $transmit_details_list->RowIndex ?>_delivery_location" id="x<?php echo $transmit_details_list->RowIndex ?>_delivery_location" size="30" placeholder="<?php echo HtmlEncode($transmit_details->delivery_location->getPlaceHolder()) ?>" value="<?php echo $transmit_details->delivery_location->EditValue ?>"<?php echo $transmit_details->delivery_location->editAttributes() ?>>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_delivery_location" name="o<?php echo $transmit_details_list->RowIndex ?>_delivery_location" id="o<?php echo $transmit_details_list->RowIndex ?>_delivery_location" value="<?php echo HtmlEncode($transmit_details->delivery_location->OldValue) ?>">
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_delivery_location" class="form-group transmit_details_delivery_location">
<input type="text" data-table="transmit_details" data-field="x_delivery_location" name="x<?php echo $transmit_details_list->RowIndex ?>_delivery_location" id="x<?php echo $transmit_details_list->RowIndex ?>_delivery_location" size="30" placeholder="<?php echo HtmlEncode($transmit_details->delivery_location->getPlaceHolder()) ?>" value="<?php echo $transmit_details->delivery_location->EditValue ?>"<?php echo $transmit_details->delivery_location->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_delivery_location" class="transmit_details_delivery_location">
<span<?php echo $transmit_details->delivery_location->viewAttributes() ?>>
<?php echo $transmit_details->delivery_location->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($transmit_details->addressed_to->Visible) { // addressed_to ?>
		<td data-name="addressed_to"<?php echo $transmit_details->addressed_to->cellAttributes() ?>>
<?php if ($transmit_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_addressed_to" class="form-group transmit_details_addressed_to">
<input type="text" data-table="transmit_details" data-field="x_addressed_to" name="x<?php echo $transmit_details_list->RowIndex ?>_addressed_to" id="x<?php echo $transmit_details_list->RowIndex ?>_addressed_to" size="30" placeholder="<?php echo HtmlEncode($transmit_details->addressed_to->getPlaceHolder()) ?>" value="<?php echo $transmit_details->addressed_to->EditValue ?>"<?php echo $transmit_details->addressed_to->editAttributes() ?>>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_addressed_to" name="o<?php echo $transmit_details_list->RowIndex ?>_addressed_to" id="o<?php echo $transmit_details_list->RowIndex ?>_addressed_to" value="<?php echo HtmlEncode($transmit_details->addressed_to->OldValue) ?>">
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_addressed_to" class="form-group transmit_details_addressed_to">
<input type="text" data-table="transmit_details" data-field="x_addressed_to" name="x<?php echo $transmit_details_list->RowIndex ?>_addressed_to" id="x<?php echo $transmit_details_list->RowIndex ?>_addressed_to" size="30" placeholder="<?php echo HtmlEncode($transmit_details->addressed_to->getPlaceHolder()) ?>" value="<?php echo $transmit_details->addressed_to->EditValue ?>"<?php echo $transmit_details->addressed_to->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_addressed_to" class="transmit_details_addressed_to">
<span<?php echo $transmit_details->addressed_to->viewAttributes() ?>>
<?php echo $transmit_details->addressed_to->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($transmit_details->remarks->Visible) { // remarks ?>
		<td data-name="remarks"<?php echo $transmit_details->remarks->cellAttributes() ?>>
<?php if ($transmit_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_remarks" class="form-group transmit_details_remarks">
<?php AppendClass($transmit_details->remarks->EditAttrs["class"], "editor"); ?>
<textarea data-table="transmit_details" data-field="x_remarks" name="x<?php echo $transmit_details_list->RowIndex ?>_remarks" id="x<?php echo $transmit_details_list->RowIndex ?>_remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($transmit_details->remarks->getPlaceHolder()) ?>"<?php echo $transmit_details->remarks->editAttributes() ?>><?php echo $transmit_details->remarks->EditValue ?></textarea>
<script>
ew.createEditor("ftransmit_detailslist", "x<?php echo $transmit_details_list->RowIndex ?>_remarks", 0, 0, <?php echo ($transmit_details->remarks->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_remarks" name="o<?php echo $transmit_details_list->RowIndex ?>_remarks" id="o<?php echo $transmit_details_list->RowIndex ?>_remarks" value="<?php echo HtmlEncode($transmit_details->remarks->OldValue) ?>">
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_remarks" class="form-group transmit_details_remarks">
<?php AppendClass($transmit_details->remarks->EditAttrs["class"], "editor"); ?>
<textarea data-table="transmit_details" data-field="x_remarks" name="x<?php echo $transmit_details_list->RowIndex ?>_remarks" id="x<?php echo $transmit_details_list->RowIndex ?>_remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($transmit_details->remarks->getPlaceHolder()) ?>"<?php echo $transmit_details->remarks->editAttributes() ?>><?php echo $transmit_details->remarks->EditValue ?></textarea>
<script>
ew.createEditor("ftransmit_detailslist", "x<?php echo $transmit_details_list->RowIndex ?>_remarks", 0, 0, <?php echo ($transmit_details->remarks->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_remarks" class="transmit_details_remarks">
<span<?php echo $transmit_details->remarks->viewAttributes() ?>>
<?php echo $transmit_details->remarks->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($transmit_details->ack_rcvd->Visible) { // ack_rcvd ?>
		<td data-name="ack_rcvd"<?php echo $transmit_details->ack_rcvd->cellAttributes() ?>>
<?php if ($transmit_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_ack_rcvd" class="form-group transmit_details_ack_rcvd">
<div id="tp_x<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" class="ew-template"><input type="radio" class="form-check-input" data-table="transmit_details" data-field="x_ack_rcvd" data-value-separator="<?php echo $transmit_details->ack_rcvd->displayValueSeparatorAttribute() ?>" name="x<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" id="x<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" value="{value}"<?php echo $transmit_details->ack_rcvd->editAttributes() ?>></div>
<div id="dsl_x<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transmit_details->ack_rcvd->radioButtonListHtml(FALSE, "x{$transmit_details_list->RowIndex}_ack_rcvd") ?>
</div></div>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_ack_rcvd" name="o<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" id="o<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" value="<?php echo HtmlEncode($transmit_details->ack_rcvd->OldValue) ?>">
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_ack_rcvd" class="form-group transmit_details_ack_rcvd">
<div id="tp_x<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" class="ew-template"><input type="radio" class="form-check-input" data-table="transmit_details" data-field="x_ack_rcvd" data-value-separator="<?php echo $transmit_details->ack_rcvd->displayValueSeparatorAttribute() ?>" name="x<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" id="x<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" value="{value}"<?php echo $transmit_details->ack_rcvd->editAttributes() ?>></div>
<div id="dsl_x<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transmit_details->ack_rcvd->radioButtonListHtml(FALSE, "x{$transmit_details_list->RowIndex}_ack_rcvd") ?>
</div></div>
</span>
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_ack_rcvd" class="transmit_details_ack_rcvd">
<span<?php echo $transmit_details->ack_rcvd->viewAttributes() ?>>
<?php echo $transmit_details->ack_rcvd->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($transmit_details->ack_document->Visible) { // ack_document ?>
		<td data-name="ack_document"<?php echo $transmit_details->ack_document->cellAttributes() ?>>
<?php if ($transmit_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_ack_document" class="form-group transmit_details_ack_document">
<div id="fd_x<?php echo $transmit_details_list->RowIndex ?>_ack_document">
<span title="<?php echo $transmit_details->ack_document->title() ? $transmit_details->ack_document->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($transmit_details->ack_document->ReadOnly || $transmit_details->ack_document->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="transmit_details" data-field="x_ack_document" name="x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id="x<?php echo $transmit_details_list->RowIndex ?>_ack_document"<?php echo $transmit_details->ack_document->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fn_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="<?php echo $transmit_details->ack_document->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fa_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="0">
<input type="hidden" name="fs_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fs_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="0">
<input type="hidden" name="fx_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fx_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="<?php echo $transmit_details->ack_document->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fm_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="<?php echo $transmit_details->ack_document->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_ack_document" name="o<?php echo $transmit_details_list->RowIndex ?>_ack_document" id="o<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="<?php echo HtmlEncode($transmit_details->ack_document->OldValue) ?>">
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_ack_document" class="form-group transmit_details_ack_document">
<div id="fd_x<?php echo $transmit_details_list->RowIndex ?>_ack_document">
<span title="<?php echo $transmit_details->ack_document->title() ? $transmit_details->ack_document->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($transmit_details->ack_document->ReadOnly || $transmit_details->ack_document->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="transmit_details" data-field="x_ack_document" name="x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id="x<?php echo $transmit_details_list->RowIndex ?>_ack_document"<?php echo $transmit_details->ack_document->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fn_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="<?php echo $transmit_details->ack_document->Upload->FileName ?>">
<?php if (Post("fa_x<?php echo $transmit_details_list->RowIndex ?>_ack_document") == "0") { ?>
<input type="hidden" name="fa_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fa_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fa_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fs_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="0">
<input type="hidden" name="fx_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fx_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="<?php echo $transmit_details->ack_document->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fm_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="<?php echo $transmit_details->ack_document->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_ack_document" class="transmit_details_ack_document">
<span<?php echo $transmit_details->ack_document->viewAttributes() ?>>
<?php echo GetFileViewTag($transmit_details->ack_document, $transmit_details->ack_document->getViewValue()) ?>
</span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($transmit_details->transmit_mode->Visible) { // transmit_mode ?>
		<td data-name="transmit_mode"<?php echo $transmit_details->transmit_mode->cellAttributes() ?>>
<?php if ($transmit_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_transmit_mode" class="form-group transmit_details_transmit_mode">
<div id="tp_x<?php echo $transmit_details_list->RowIndex ?>_transmit_mode" class="ew-template"><input type="checkbox" class="form-check-input" data-table="transmit_details" data-field="x_transmit_mode" data-value-separator="<?php echo $transmit_details->transmit_mode->displayValueSeparatorAttribute() ?>" name="x<?php echo $transmit_details_list->RowIndex ?>_transmit_mode[]" id="x<?php echo $transmit_details_list->RowIndex ?>_transmit_mode[]" value="{value}"<?php echo $transmit_details->transmit_mode->editAttributes() ?>></div>
<div id="dsl_x<?php echo $transmit_details_list->RowIndex ?>_transmit_mode" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transmit_details->transmit_mode->checkBoxListHtml(FALSE, "x{$transmit_details_list->RowIndex}_transmit_mode[]") ?>
</div></div>
<?php echo $transmit_details->transmit_mode->Lookup->getParamTag("p_x" . $transmit_details_list->RowIndex . "_transmit_mode") ?>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_transmit_mode" name="o<?php echo $transmit_details_list->RowIndex ?>_transmit_mode[]" id="o<?php echo $transmit_details_list->RowIndex ?>_transmit_mode[]" value="<?php echo HtmlEncode($transmit_details->transmit_mode->OldValue) ?>">
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_transmit_mode" class="form-group transmit_details_transmit_mode">
<div id="tp_x<?php echo $transmit_details_list->RowIndex ?>_transmit_mode" class="ew-template"><input type="checkbox" class="form-check-input" data-table="transmit_details" data-field="x_transmit_mode" data-value-separator="<?php echo $transmit_details->transmit_mode->displayValueSeparatorAttribute() ?>" name="x<?php echo $transmit_details_list->RowIndex ?>_transmit_mode[]" id="x<?php echo $transmit_details_list->RowIndex ?>_transmit_mode[]" value="{value}"<?php echo $transmit_details->transmit_mode->editAttributes() ?>></div>
<div id="dsl_x<?php echo $transmit_details_list->RowIndex ?>_transmit_mode" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transmit_details->transmit_mode->checkBoxListHtml(FALSE, "x{$transmit_details_list->RowIndex}_transmit_mode[]") ?>
</div></div>
<?php echo $transmit_details->transmit_mode->Lookup->getParamTag("p_x" . $transmit_details_list->RowIndex . "_transmit_mode") ?>
</span>
<?php } ?>
<?php if ($transmit_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $transmit_details_list->RowCnt ?>_transmit_details_transmit_mode" class="transmit_details_transmit_mode">
<span<?php echo $transmit_details->transmit_mode->viewAttributes() ?>>
<?php echo $transmit_details->transmit_mode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$transmit_details_list->ListOptions->render("body", "right", $transmit_details_list->RowCnt);
?>
	</tr>
<?php if ($transmit_details->RowType == ROWTYPE_ADD || $transmit_details->RowType == ROWTYPE_EDIT) { ?>
<script>
ftransmit_detailslist.updateLists(<?php echo $transmit_details_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$transmit_details->isGridAdd())
		if (!$transmit_details_list->Recordset->EOF)
			$transmit_details_list->Recordset->moveNext();
}
?>
<?php
	if ($transmit_details->isGridAdd() || $transmit_details->isGridEdit()) {
		$transmit_details_list->RowIndex = '$rowindex$';
		$transmit_details_list->loadRowValues();

		// Set row properties
		$transmit_details->resetAttributes();
		$transmit_details->RowAttrs = array_merge($transmit_details->RowAttrs, array('data-rowindex'=>$transmit_details_list->RowIndex, 'id'=>'r0_transmit_details', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($transmit_details->RowAttrs["class"], "ew-template");
		$transmit_details->RowType = ROWTYPE_ADD;

		// Render row
		$transmit_details_list->renderRow();

		// Render list options
		$transmit_details_list->renderListOptions();
		$transmit_details_list->StartRowCnt = 0;
?>
	<tr<?php echo $transmit_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$transmit_details_list->ListOptions->render("body", "left", $transmit_details_list->RowIndex);
?>
	<?php if ($transmit_details->transmittal_no->Visible) { // transmittal_no ?>
		<td data-name="transmittal_no">
<span id="el$rowindex$_transmit_details_transmittal_no" class="form-group transmit_details_transmittal_no">
<input type="text" data-table="transmit_details" data-field="x_transmittal_no" name="x<?php echo $transmit_details_list->RowIndex ?>_transmittal_no" id="x<?php echo $transmit_details_list->RowIndex ?>_transmittal_no" size="30" placeholder="<?php echo HtmlEncode($transmit_details->transmittal_no->getPlaceHolder()) ?>" value="<?php echo $transmit_details->transmittal_no->EditValue ?>"<?php echo $transmit_details->transmittal_no->editAttributes() ?>>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_transmittal_no" name="o<?php echo $transmit_details_list->RowIndex ?>_transmittal_no" id="o<?php echo $transmit_details_list->RowIndex ?>_transmittal_no" value="<?php echo HtmlEncode($transmit_details->transmittal_no->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($transmit_details->project_name->Visible) { // project_name ?>
		<td data-name="project_name">
<span id="el$rowindex$_transmit_details_project_name" class="form-group transmit_details_project_name">
<?php
$wrkonchange = "" . trim(@$transmit_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transmit_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $transmit_details_list->RowIndex ?>_project_name" class="text-nowrap" style="z-index: <?php echo (9000 - $transmit_details_list->RowCnt * 10) ?>">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $transmit_details_list->RowIndex ?>_project_name" id="sv_x<?php echo $transmit_details_list->RowIndex ?>_project_name" value="<?php echo RemoveHtml($transmit_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($transmit_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transmit_details->project_name->getPlaceHolder()) ?>"<?php echo $transmit_details->project_name->editAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "project_details") && !$transmit_details->project_name->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $transmit_details_list->RowIndex ?>_project_name" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $transmit_details->project_name->caption() ?>" data-title="<?php echo $transmit_details->project_name->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $transmit_details_list->RowIndex ?>_project_name',url:'project_detailsaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
	</div>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_project_name" data-value-separator="<?php echo $transmit_details->project_name->displayValueSeparatorAttribute() ?>" name="x<?php echo $transmit_details_list->RowIndex ?>_project_name" id="x<?php echo $transmit_details_list->RowIndex ?>_project_name" value="<?php echo HtmlEncode($transmit_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransmit_detailslist.createAutoSuggest({"id":"x<?php echo $transmit_details_list->RowIndex ?>_project_name","forceSelect":true});
</script>
<?php echo $transmit_details->project_name->Lookup->getParamTag("p_x" . $transmit_details_list->RowIndex . "_project_name") ?>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_project_name" name="o<?php echo $transmit_details_list->RowIndex ?>_project_name" id="o<?php echo $transmit_details_list->RowIndex ?>_project_name" value="<?php echo HtmlEncode($transmit_details->project_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($transmit_details->delivery_location->Visible) { // delivery_location ?>
		<td data-name="delivery_location">
<span id="el$rowindex$_transmit_details_delivery_location" class="form-group transmit_details_delivery_location">
<input type="text" data-table="transmit_details" data-field="x_delivery_location" name="x<?php echo $transmit_details_list->RowIndex ?>_delivery_location" id="x<?php echo $transmit_details_list->RowIndex ?>_delivery_location" size="30" placeholder="<?php echo HtmlEncode($transmit_details->delivery_location->getPlaceHolder()) ?>" value="<?php echo $transmit_details->delivery_location->EditValue ?>"<?php echo $transmit_details->delivery_location->editAttributes() ?>>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_delivery_location" name="o<?php echo $transmit_details_list->RowIndex ?>_delivery_location" id="o<?php echo $transmit_details_list->RowIndex ?>_delivery_location" value="<?php echo HtmlEncode($transmit_details->delivery_location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($transmit_details->addressed_to->Visible) { // addressed_to ?>
		<td data-name="addressed_to">
<span id="el$rowindex$_transmit_details_addressed_to" class="form-group transmit_details_addressed_to">
<input type="text" data-table="transmit_details" data-field="x_addressed_to" name="x<?php echo $transmit_details_list->RowIndex ?>_addressed_to" id="x<?php echo $transmit_details_list->RowIndex ?>_addressed_to" size="30" placeholder="<?php echo HtmlEncode($transmit_details->addressed_to->getPlaceHolder()) ?>" value="<?php echo $transmit_details->addressed_to->EditValue ?>"<?php echo $transmit_details->addressed_to->editAttributes() ?>>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_addressed_to" name="o<?php echo $transmit_details_list->RowIndex ?>_addressed_to" id="o<?php echo $transmit_details_list->RowIndex ?>_addressed_to" value="<?php echo HtmlEncode($transmit_details->addressed_to->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($transmit_details->remarks->Visible) { // remarks ?>
		<td data-name="remarks">
<span id="el$rowindex$_transmit_details_remarks" class="form-group transmit_details_remarks">
<?php AppendClass($transmit_details->remarks->EditAttrs["class"], "editor"); ?>
<textarea data-table="transmit_details" data-field="x_remarks" name="x<?php echo $transmit_details_list->RowIndex ?>_remarks" id="x<?php echo $transmit_details_list->RowIndex ?>_remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($transmit_details->remarks->getPlaceHolder()) ?>"<?php echo $transmit_details->remarks->editAttributes() ?>><?php echo $transmit_details->remarks->EditValue ?></textarea>
<script>
ew.createEditor("ftransmit_detailslist", "x<?php echo $transmit_details_list->RowIndex ?>_remarks", 0, 0, <?php echo ($transmit_details->remarks->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_remarks" name="o<?php echo $transmit_details_list->RowIndex ?>_remarks" id="o<?php echo $transmit_details_list->RowIndex ?>_remarks" value="<?php echo HtmlEncode($transmit_details->remarks->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($transmit_details->ack_rcvd->Visible) { // ack_rcvd ?>
		<td data-name="ack_rcvd">
<span id="el$rowindex$_transmit_details_ack_rcvd" class="form-group transmit_details_ack_rcvd">
<div id="tp_x<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" class="ew-template"><input type="radio" class="form-check-input" data-table="transmit_details" data-field="x_ack_rcvd" data-value-separator="<?php echo $transmit_details->ack_rcvd->displayValueSeparatorAttribute() ?>" name="x<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" id="x<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" value="{value}"<?php echo $transmit_details->ack_rcvd->editAttributes() ?>></div>
<div id="dsl_x<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transmit_details->ack_rcvd->radioButtonListHtml(FALSE, "x{$transmit_details_list->RowIndex}_ack_rcvd") ?>
</div></div>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_ack_rcvd" name="o<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" id="o<?php echo $transmit_details_list->RowIndex ?>_ack_rcvd" value="<?php echo HtmlEncode($transmit_details->ack_rcvd->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($transmit_details->ack_document->Visible) { // ack_document ?>
		<td data-name="ack_document">
<span id="el$rowindex$_transmit_details_ack_document" class="form-group transmit_details_ack_document">
<div id="fd_x<?php echo $transmit_details_list->RowIndex ?>_ack_document">
<span title="<?php echo $transmit_details->ack_document->title() ? $transmit_details->ack_document->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($transmit_details->ack_document->ReadOnly || $transmit_details->ack_document->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="transmit_details" data-field="x_ack_document" name="x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id="x<?php echo $transmit_details_list->RowIndex ?>_ack_document"<?php echo $transmit_details->ack_document->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fn_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="<?php echo $transmit_details->ack_document->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fa_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="0">
<input type="hidden" name="fs_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fs_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="0">
<input type="hidden" name="fx_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fx_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="<?php echo $transmit_details->ack_document->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" id= "fm_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="<?php echo $transmit_details->ack_document->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $transmit_details_list->RowIndex ?>_ack_document" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_ack_document" name="o<?php echo $transmit_details_list->RowIndex ?>_ack_document" id="o<?php echo $transmit_details_list->RowIndex ?>_ack_document" value="<?php echo HtmlEncode($transmit_details->ack_document->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($transmit_details->transmit_mode->Visible) { // transmit_mode ?>
		<td data-name="transmit_mode">
<span id="el$rowindex$_transmit_details_transmit_mode" class="form-group transmit_details_transmit_mode">
<div id="tp_x<?php echo $transmit_details_list->RowIndex ?>_transmit_mode" class="ew-template"><input type="checkbox" class="form-check-input" data-table="transmit_details" data-field="x_transmit_mode" data-value-separator="<?php echo $transmit_details->transmit_mode->displayValueSeparatorAttribute() ?>" name="x<?php echo $transmit_details_list->RowIndex ?>_transmit_mode[]" id="x<?php echo $transmit_details_list->RowIndex ?>_transmit_mode[]" value="{value}"<?php echo $transmit_details->transmit_mode->editAttributes() ?>></div>
<div id="dsl_x<?php echo $transmit_details_list->RowIndex ?>_transmit_mode" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transmit_details->transmit_mode->checkBoxListHtml(FALSE, "x{$transmit_details_list->RowIndex}_transmit_mode[]") ?>
</div></div>
<?php echo $transmit_details->transmit_mode->Lookup->getParamTag("p_x" . $transmit_details_list->RowIndex . "_transmit_mode") ?>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_transmit_mode" name="o<?php echo $transmit_details_list->RowIndex ?>_transmit_mode[]" id="o<?php echo $transmit_details_list->RowIndex ?>_transmit_mode[]" value="<?php echo HtmlEncode($transmit_details->transmit_mode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$transmit_details_list->ListOptions->render("body", "right", $transmit_details_list->RowIndex);
?>
<script>
ftransmit_detailslist.updateLists(<?php echo $transmit_details_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($transmit_details->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $transmit_details_list->FormKeyCountName ?>" id="<?php echo $transmit_details_list->FormKeyCountName ?>" value="<?php echo $transmit_details_list->KeyCount ?>">
<?php echo $transmit_details_list->MultiSelectKey ?>
<?php } ?>
<?php if ($transmit_details->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $transmit_details_list->FormKeyCountName ?>" id="<?php echo $transmit_details_list->FormKeyCountName ?>" value="<?php echo $transmit_details_list->KeyCount ?>">
<?php echo $transmit_details_list->MultiSelectKey ?>
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