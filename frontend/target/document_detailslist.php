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
$document_details_list = new document_details_list();

// Run the page
$document_details_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_details_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$document_details->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fdocument_detailslist = currentForm = new ew.Form("fdocument_detailslist", "list");
fdocument_detailslist.formKeyCountName = '<?php echo $document_details_list->FormKeyCountName ?>';

// Validate form
fdocument_detailslist.validate = function() {
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
		<?php if ($document_details_list->firelink_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_firelink_doc_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->firelink_doc_no->caption(), $document_details->firelink_doc_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_list->client_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_client_doc_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->client_doc_no->caption(), $document_details->client_doc_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_list->document_tittle->Required) { ?>
			elm = this.getElements("x" + infix + "_document_tittle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->document_tittle->caption(), $document_details->document_tittle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_list->project_name->Required) { ?>
			elm = this.getElements("x" + infix + "_project_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->project_name->caption(), $document_details->project_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_list->project_system->Required) { ?>
			elm = this.getElements("x" + infix + "_project_system");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->project_system->caption(), $document_details->project_system->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_list->planned_date->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->planned_date->caption(), $document_details->planned_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_details->planned_date->errorMessage()) ?>");
		<?php if ($document_details_list->document_type->Required) { ?>
			elm = this.getElements("x" + infix + "_document_type");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->document_type->caption(), $document_details->document_type->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_list->expiry_date->Required) { ?>
			elm = this.getElements("x" + infix + "_expiry_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->expiry_date->caption(), $document_details->expiry_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_expiry_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_details->expiry_date->errorMessage()) ?>");

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
fdocument_detailslist.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "firelink_doc_no", false)) return false;
	if (ew.valueChanged(fobj, infix, "client_doc_no", false)) return false;
	if (ew.valueChanged(fobj, infix, "document_tittle", false)) return false;
	if (ew.valueChanged(fobj, infix, "project_name", false)) return false;
	if (ew.valueChanged(fobj, infix, "project_system", false)) return false;
	if (ew.valueChanged(fobj, infix, "planned_date", false)) return false;
	if (ew.valueChanged(fobj, infix, "document_type", false)) return false;
	if (ew.valueChanged(fobj, infix, "expiry_date", false)) return false;
	return true;
}

// Form_CustomValidate event
fdocument_detailslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_detailslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdocument_detailslist.lists["x_project_name"] = <?php echo $document_details_list->project_name->Lookup->toClientList() ?>;
fdocument_detailslist.lists["x_project_name"].options = <?php echo JsonEncode($document_details_list->project_name->lookupOptions()) ?>;
fdocument_detailslist.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdocument_detailslist.lists["x_project_system"] = <?php echo $document_details_list->project_system->Lookup->toClientList() ?>;
fdocument_detailslist.lists["x_project_system"].options = <?php echo JsonEncode($document_details_list->project_system->lookupOptions()) ?>;
fdocument_detailslist.lists["x_document_type"] = <?php echo $document_details_list->document_type->Lookup->toClientList() ?>;
fdocument_detailslist.lists["x_document_type"].options = <?php echo JsonEncode($document_details_list->document_type->lookupOptions()) ?>;
fdocument_detailslist.autoSuggests["x_document_type"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var fdocument_detailslistsrch = currentSearchForm = new ew.Form("fdocument_detailslistsrch");

// Filters
fdocument_detailslistsrch.filterList = <?php echo $document_details_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$document_details->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($document_details_list->TotalRecs > 0 && $document_details_list->ExportOptions->visible()) { ?>
<?php $document_details_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($document_details_list->ImportOptions->visible()) { ?>
<?php $document_details_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($document_details_list->SearchOptions->visible()) { ?>
<?php $document_details_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($document_details_list->FilterOptions->visible()) { ?>
<?php $document_details_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$document_details_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$document_details->isExport() && !$document_details->CurrentAction) { ?>
<form name="fdocument_detailslistsrch" id="fdocument_detailslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($document_details_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fdocument_detailslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="document_details">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($document_details_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($document_details_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $document_details_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($document_details_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($document_details_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($document_details_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($document_details_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $document_details_list->showPageHeader(); ?>
<?php
$document_details_list->showMessage();
?>
<?php if ($document_details_list->TotalRecs > 0 || $document_details->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($document_details_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> document_details">
<?php if (!$document_details->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$document_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($document_details_list->Pager)) $document_details_list->Pager = new NumericPager($document_details_list->StartRec, $document_details_list->DisplayRecs, $document_details_list->TotalRecs, $document_details_list->RecRange, $document_details_list->AutoHidePager) ?>
<?php if ($document_details_list->Pager->RecordCount > 0 && $document_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($document_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_details_list->pageUrl() ?>start=<?php echo $document_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($document_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_details_list->pageUrl() ?>start=<?php echo $document_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($document_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $document_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($document_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_details_list->pageUrl() ?>start=<?php echo $document_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($document_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_details_list->pageUrl() ?>start=<?php echo $document_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($document_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $document_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $document_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $document_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $document_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdocument_detailslist" id="fdocument_detailslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_details_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_details_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_details">
<div id="gmp_document_details" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($document_details_list->TotalRecs > 0 || $document_details->isAdd() || $document_details->isCopy() || $document_details->isGridEdit()) { ?>
<table id="tbl_document_detailslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$document_details_list->RowType = ROWTYPE_HEADER;

// Render list options
$document_details_list->renderListOptions();

// Render list options (header, left)
$document_details_list->ListOptions->render("header", "left");
?>
<?php if ($document_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
	<?php if ($document_details->sortUrl($document_details->firelink_doc_no) == "") { ?>
		<th data-name="firelink_doc_no" class="<?php echo $document_details->firelink_doc_no->headerCellClass() ?>"><div id="elh_document_details_firelink_doc_no" class="document_details_firelink_doc_no"><div class="ew-table-header-caption"><?php echo $document_details->firelink_doc_no->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="firelink_doc_no" class="<?php echo $document_details->firelink_doc_no->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_details->SortUrl($document_details->firelink_doc_no) ?>',2);"><div id="elh_document_details_firelink_doc_no" class="document_details_firelink_doc_no">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_details->firelink_doc_no->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_details->firelink_doc_no->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_details->firelink_doc_no->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_details->client_doc_no->Visible) { // client_doc_no ?>
	<?php if ($document_details->sortUrl($document_details->client_doc_no) == "") { ?>
		<th data-name="client_doc_no" class="<?php echo $document_details->client_doc_no->headerCellClass() ?>"><div id="elh_document_details_client_doc_no" class="document_details_client_doc_no"><div class="ew-table-header-caption"><?php echo $document_details->client_doc_no->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="client_doc_no" class="<?php echo $document_details->client_doc_no->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_details->SortUrl($document_details->client_doc_no) ?>',2);"><div id="elh_document_details_client_doc_no" class="document_details_client_doc_no">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_details->client_doc_no->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_details->client_doc_no->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_details->client_doc_no->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_details->document_tittle->Visible) { // document_tittle ?>
	<?php if ($document_details->sortUrl($document_details->document_tittle) == "") { ?>
		<th data-name="document_tittle" class="<?php echo $document_details->document_tittle->headerCellClass() ?>"><div id="elh_document_details_document_tittle" class="document_details_document_tittle"><div class="ew-table-header-caption"><?php echo $document_details->document_tittle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="document_tittle" class="<?php echo $document_details->document_tittle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_details->SortUrl($document_details->document_tittle) ?>',2);"><div id="elh_document_details_document_tittle" class="document_details_document_tittle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_details->document_tittle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_details->document_tittle->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_details->document_tittle->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_details->project_name->Visible) { // project_name ?>
	<?php if ($document_details->sortUrl($document_details->project_name) == "") { ?>
		<th data-name="project_name" class="<?php echo $document_details->project_name->headerCellClass() ?>"><div id="elh_document_details_project_name" class="document_details_project_name"><div class="ew-table-header-caption"><?php echo $document_details->project_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="project_name" class="<?php echo $document_details->project_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_details->SortUrl($document_details->project_name) ?>',2);"><div id="elh_document_details_project_name" class="document_details_project_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_details->project_name->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_details->project_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_details->project_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_details->project_system->Visible) { // project_system ?>
	<?php if ($document_details->sortUrl($document_details->project_system) == "") { ?>
		<th data-name="project_system" class="<?php echo $document_details->project_system->headerCellClass() ?>"><div id="elh_document_details_project_system" class="document_details_project_system"><div class="ew-table-header-caption"><?php echo $document_details->project_system->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="project_system" class="<?php echo $document_details->project_system->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_details->SortUrl($document_details->project_system) ?>',2);"><div id="elh_document_details_project_system" class="document_details_project_system">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_details->project_system->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_details->project_system->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_details->project_system->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_details->planned_date->Visible) { // planned_date ?>
	<?php if ($document_details->sortUrl($document_details->planned_date) == "") { ?>
		<th data-name="planned_date" class="<?php echo $document_details->planned_date->headerCellClass() ?>"><div id="elh_document_details_planned_date" class="document_details_planned_date"><div class="ew-table-header-caption"><?php echo $document_details->planned_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planned_date" class="<?php echo $document_details->planned_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_details->SortUrl($document_details->planned_date) ?>',2);"><div id="elh_document_details_planned_date" class="document_details_planned_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_details->planned_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_details->planned_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_details->planned_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_details->document_type->Visible) { // document_type ?>
	<?php if ($document_details->sortUrl($document_details->document_type) == "") { ?>
		<th data-name="document_type" class="<?php echo $document_details->document_type->headerCellClass() ?>"><div id="elh_document_details_document_type" class="document_details_document_type"><div class="ew-table-header-caption"><?php echo $document_details->document_type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="document_type" class="<?php echo $document_details->document_type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_details->SortUrl($document_details->document_type) ?>',2);"><div id="elh_document_details_document_type" class="document_details_document_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_details->document_type->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_details->document_type->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_details->document_type->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_details->expiry_date->Visible) { // expiry_date ?>
	<?php if ($document_details->sortUrl($document_details->expiry_date) == "") { ?>
		<th data-name="expiry_date" class="<?php echo $document_details->expiry_date->headerCellClass() ?>"><div id="elh_document_details_expiry_date" class="document_details_expiry_date"><div class="ew-table-header-caption"><?php echo $document_details->expiry_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="expiry_date" class="<?php echo $document_details->expiry_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_details->SortUrl($document_details->expiry_date) ?>',2);"><div id="elh_document_details_expiry_date" class="document_details_expiry_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_details->expiry_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_details->expiry_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_details->expiry_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$document_details_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($document_details->isAdd() || $document_details->isCopy()) {
		$document_details_list->RowIndex = 0;
		$document_details_list->KeyCount = $document_details_list->RowIndex;
		if ($document_details->isCopy() && !$document_details_list->loadRow())
			$document_details->CurrentAction = "add";
		if ($document_details->isAdd())
			$document_details_list->loadRowValues();
		if ($document_details->EventCancelled) // Insert failed
			$document_details_list->restoreFormValues(); // Restore form values

		// Set row properties
		$document_details->resetAttributes();
		$document_details->RowAttrs = array_merge($document_details->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_document_details', 'data-rowtype'=>ROWTYPE_ADD));
		$document_details->RowType = ROWTYPE_ADD;

		// Render row
		$document_details_list->renderRow();

		// Render list options
		$document_details_list->renderListOptions();
		$document_details_list->StartRowCnt = 0;
?>
	<tr<?php echo $document_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$document_details_list->ListOptions->render("body", "left", $document_details_list->RowCnt);
?>
	<?php if ($document_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
		<td data-name="firelink_doc_no">
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_firelink_doc_no" class="form-group document_details_firelink_doc_no">
<input type="text" data-table="document_details" data-field="x_firelink_doc_no" name="x<?php echo $document_details_list->RowIndex ?>_firelink_doc_no" id="x<?php echo $document_details_list->RowIndex ?>_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->firelink_doc_no->EditValue ?>"<?php echo $document_details->firelink_doc_no->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_details" data-field="x_firelink_doc_no" name="o<?php echo $document_details_list->RowIndex ?>_firelink_doc_no" id="o<?php echo $document_details_list->RowIndex ?>_firelink_doc_no" value="<?php echo HtmlEncode($document_details->firelink_doc_no->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($document_details->client_doc_no->Visible) { // client_doc_no ?>
		<td data-name="client_doc_no">
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_client_doc_no" class="form-group document_details_client_doc_no">
<input type="text" data-table="document_details" data-field="x_client_doc_no" name="x<?php echo $document_details_list->RowIndex ?>_client_doc_no" id="x<?php echo $document_details_list->RowIndex ?>_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->client_doc_no->EditValue ?>"<?php echo $document_details->client_doc_no->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_details" data-field="x_client_doc_no" name="o<?php echo $document_details_list->RowIndex ?>_client_doc_no" id="o<?php echo $document_details_list->RowIndex ?>_client_doc_no" value="<?php echo HtmlEncode($document_details->client_doc_no->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($document_details->document_tittle->Visible) { // document_tittle ?>
		<td data-name="document_tittle">
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_document_tittle" class="form-group document_details_document_tittle">
<input type="text" data-table="document_details" data-field="x_document_tittle" name="x<?php echo $document_details_list->RowIndex ?>_document_tittle" id="x<?php echo $document_details_list->RowIndex ?>_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_details->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_details->document_tittle->EditValue ?>"<?php echo $document_details->document_tittle->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_tittle" name="o<?php echo $document_details_list->RowIndex ?>_document_tittle" id="o<?php echo $document_details_list->RowIndex ?>_document_tittle" value="<?php echo HtmlEncode($document_details->document_tittle->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($document_details->project_name->Visible) { // project_name ?>
		<td data-name="project_name">
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_project_name" class="form-group document_details_project_name">
<?php
$wrkonchange = "" . trim(@$document_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $document_details_list->RowIndex ?>_project_name" class="text-nowrap" style="z-index: <?php echo (9000 - $document_details_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $document_details_list->RowIndex ?>_project_name" id="sv_x<?php echo $document_details_list->RowIndex ?>_project_name" value="<?php echo RemoveHtml($document_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>"<?php echo $document_details->project_name->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($document_details->project_name->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_project_name',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($document_details->project_name->ReadOnly || $document_details->project_name->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "project_details") && !$document_details->project_name->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $document_details_list->RowIndex ?>_project_name" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $document_details->project_name->caption() ?>" data-title="<?php echo $document_details->project_name->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_project_name',url:'project_detailsaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->project_name->displayValueSeparatorAttribute() ?>" name="x<?php echo $document_details_list->RowIndex ?>_project_name" id="x<?php echo $document_details_list->RowIndex ?>_project_name" value="<?php echo HtmlEncode($document_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailslist.createAutoSuggest({"id":"x<?php echo $document_details_list->RowIndex ?>_project_name","forceSelect":true});
</script>
<?php echo $document_details->project_name->Lookup->getParamTag("p_x" . $document_details_list->RowIndex . "_project_name") ?>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" name="o<?php echo $document_details_list->RowIndex ?>_project_name" id="o<?php echo $document_details_list->RowIndex ?>_project_name" value="<?php echo HtmlEncode($document_details->project_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($document_details->project_system->Visible) { // project_system ?>
		<td data-name="project_system">
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_project_system" class="form-group document_details_project_system">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="document_details" data-field="x_project_system" data-value-separator="<?php echo $document_details->project_system->displayValueSeparatorAttribute() ?>" id="x<?php echo $document_details_list->RowIndex ?>_project_system" name="x<?php echo $document_details_list->RowIndex ?>_project_system" size=4<?php echo $document_details->project_system->editAttributes() ?>>
		<?php echo $document_details->project_system->selectOptionListHtml("x<?php echo $document_details_list->RowIndex ?>_project_system") ?>
	</select>
</div>
<?php echo $document_details->project_system->Lookup->getParamTag("p_x" . $document_details_list->RowIndex . "_project_system") ?>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_system" name="o<?php echo $document_details_list->RowIndex ?>_project_system" id="o<?php echo $document_details_list->RowIndex ?>_project_system" value="<?php echo HtmlEncode($document_details->project_system->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($document_details->planned_date->Visible) { // planned_date ?>
		<td data-name="planned_date">
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_planned_date" class="form-group document_details_planned_date">
<input type="text" data-table="document_details" data-field="x_planned_date" name="x<?php echo $document_details_list->RowIndex ?>_planned_date" id="x<?php echo $document_details_list->RowIndex ?>_planned_date" placeholder="<?php echo HtmlEncode($document_details->planned_date->getPlaceHolder()) ?>" value="<?php echo $document_details->planned_date->EditValue ?>"<?php echo $document_details->planned_date->editAttributes() ?>>
<?php if (!$document_details->planned_date->ReadOnly && !$document_details->planned_date->Disabled && !isset($document_details->planned_date->EditAttrs["readonly"]) && !isset($document_details->planned_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailslist", "x<?php echo $document_details_list->RowIndex ?>_planned_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="document_details" data-field="x_planned_date" name="o<?php echo $document_details_list->RowIndex ?>_planned_date" id="o<?php echo $document_details_list->RowIndex ?>_planned_date" value="<?php echo HtmlEncode($document_details->planned_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($document_details->document_type->Visible) { // document_type ?>
		<td data-name="document_type">
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_document_type" class="form-group document_details_document_type">
<?php
$wrkonchange = "" . trim(@$document_details->document_type->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->document_type->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $document_details_list->RowIndex ?>_document_type" class="text-nowrap" style="z-index: <?php echo (9000 - $document_details_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $document_details_list->RowIndex ?>_document_type" id="sv_x<?php echo $document_details_list->RowIndex ?>_document_type" value="<?php echo RemoveHtml($document_details->document_type->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>"<?php echo $document_details->document_type->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($document_details->document_type->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_document_type',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($document_details->document_type->ReadOnly || $document_details->document_type->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "document_type") && !$document_details->document_type->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $document_details_list->RowIndex ?>_document_type" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $document_details->document_type->caption() ?>" data-title="<?php echo $document_details->document_type->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_document_type',url:'document_typeaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->document_type->displayValueSeparatorAttribute() ?>" name="x<?php echo $document_details_list->RowIndex ?>_document_type" id="x<?php echo $document_details_list->RowIndex ?>_document_type" value="<?php echo HtmlEncode($document_details->document_type->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailslist.createAutoSuggest({"id":"x<?php echo $document_details_list->RowIndex ?>_document_type","forceSelect":true});
</script>
<?php echo $document_details->document_type->Lookup->getParamTag("p_x" . $document_details_list->RowIndex . "_document_type") ?>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" name="o<?php echo $document_details_list->RowIndex ?>_document_type" id="o<?php echo $document_details_list->RowIndex ?>_document_type" value="<?php echo HtmlEncode($document_details->document_type->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($document_details->expiry_date->Visible) { // expiry_date ?>
		<td data-name="expiry_date">
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_expiry_date" class="form-group document_details_expiry_date">
<input type="text" data-table="document_details" data-field="x_expiry_date" name="x<?php echo $document_details_list->RowIndex ?>_expiry_date" id="x<?php echo $document_details_list->RowIndex ?>_expiry_date" placeholder="<?php echo HtmlEncode($document_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $document_details->expiry_date->EditValue ?>"<?php echo $document_details->expiry_date->editAttributes() ?>>
<?php if (!$document_details->expiry_date->ReadOnly && !$document_details->expiry_date->Disabled && !isset($document_details->expiry_date->EditAttrs["readonly"]) && !isset($document_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailslist", "x<?php echo $document_details_list->RowIndex ?>_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="document_details" data-field="x_expiry_date" name="o<?php echo $document_details_list->RowIndex ?>_expiry_date" id="o<?php echo $document_details_list->RowIndex ?>_expiry_date" value="<?php echo HtmlEncode($document_details->expiry_date->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$document_details_list->ListOptions->render("body", "right", $document_details_list->RowCnt);
?>
<script>
fdocument_detailslist.updateLists(<?php echo $document_details_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($document_details->ExportAll && $document_details->isExport()) {
	$document_details_list->StopRec = $document_details_list->TotalRecs;
} else {

	// Set the last record to display
	if ($document_details_list->TotalRecs > $document_details_list->StartRec + $document_details_list->DisplayRecs - 1)
		$document_details_list->StopRec = $document_details_list->StartRec + $document_details_list->DisplayRecs - 1;
	else
		$document_details_list->StopRec = $document_details_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $document_details_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($document_details_list->FormKeyCountName) && ($document_details->isGridAdd() || $document_details->isGridEdit() || $document_details->isConfirm())) {
		$document_details_list->KeyCount = $CurrentForm->getValue($document_details_list->FormKeyCountName);
		$document_details_list->StopRec = $document_details_list->StartRec + $document_details_list->KeyCount - 1;
	}
}
$document_details_list->RecCnt = $document_details_list->StartRec - 1;
if ($document_details_list->Recordset && !$document_details_list->Recordset->EOF) {
	$document_details_list->Recordset->moveFirst();
	$selectLimit = $document_details_list->UseSelectLimit;
	if (!$selectLimit && $document_details_list->StartRec > 1)
		$document_details_list->Recordset->move($document_details_list->StartRec - 1);
} elseif (!$document_details->AllowAddDeleteRow && $document_details_list->StopRec == 0) {
	$document_details_list->StopRec = $document_details->GridAddRowCount;
}

// Initialize aggregate
$document_details->RowType = ROWTYPE_AGGREGATEINIT;
$document_details->resetAttributes();
$document_details_list->renderRow();
$document_details_list->EditRowCnt = 0;
if ($document_details->isEdit())
	$document_details_list->RowIndex = 1;
if ($document_details->isGridAdd())
	$document_details_list->RowIndex = 0;
if ($document_details->isGridEdit())
	$document_details_list->RowIndex = 0;
while ($document_details_list->RecCnt < $document_details_list->StopRec) {
	$document_details_list->RecCnt++;
	if ($document_details_list->RecCnt >= $document_details_list->StartRec) {
		$document_details_list->RowCnt++;
		if ($document_details->isGridAdd() || $document_details->isGridEdit() || $document_details->isConfirm()) {
			$document_details_list->RowIndex++;
			$CurrentForm->Index = $document_details_list->RowIndex;
			if ($CurrentForm->hasValue($document_details_list->FormActionName) && $document_details_list->EventCancelled)
				$document_details_list->RowAction = strval($CurrentForm->getValue($document_details_list->FormActionName));
			elseif ($document_details->isGridAdd())
				$document_details_list->RowAction = "insert";
			else
				$document_details_list->RowAction = "";
		}

		// Set up key count
		$document_details_list->KeyCount = $document_details_list->RowIndex;

		// Init row class and style
		$document_details->resetAttributes();
		$document_details->CssClass = "";
		if ($document_details->isGridAdd()) {
			$document_details_list->loadRowValues(); // Load default values
		} else {
			$document_details_list->loadRowValues($document_details_list->Recordset); // Load row values
		}
		$document_details->RowType = ROWTYPE_VIEW; // Render view
		if ($document_details->isGridAdd()) // Grid add
			$document_details->RowType = ROWTYPE_ADD; // Render add
		if ($document_details->isGridAdd() && $document_details->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$document_details_list->restoreCurrentRowFormValues($document_details_list->RowIndex); // Restore form values
		if ($document_details->isEdit()) {
			if ($document_details_list->checkInlineEditKey() && $document_details_list->EditRowCnt == 0) { // Inline edit
				$document_details->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($document_details->isGridEdit()) { // Grid edit
			if ($document_details->EventCancelled)
				$document_details_list->restoreCurrentRowFormValues($document_details_list->RowIndex); // Restore form values
			if ($document_details_list->RowAction == "insert")
				$document_details->RowType = ROWTYPE_ADD; // Render add
			else
				$document_details->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($document_details->isEdit() && $document_details->RowType == ROWTYPE_EDIT && $document_details->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$document_details_list->restoreFormValues(); // Restore form values
		}
		if ($document_details->isGridEdit() && ($document_details->RowType == ROWTYPE_EDIT || $document_details->RowType == ROWTYPE_ADD) && $document_details->EventCancelled) // Update failed
			$document_details_list->restoreCurrentRowFormValues($document_details_list->RowIndex); // Restore form values
		if ($document_details->RowType == ROWTYPE_EDIT) // Edit row
			$document_details_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$document_details->RowAttrs = array_merge($document_details->RowAttrs, array('data-rowindex'=>$document_details_list->RowCnt, 'id'=>'r' . $document_details_list->RowCnt . '_document_details', 'data-rowtype'=>$document_details->RowType));

		// Render row
		$document_details_list->renderRow();

		// Render list options
		$document_details_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($document_details_list->RowAction <> "delete" && $document_details_list->RowAction <> "insertdelete" && !($document_details_list->RowAction == "insert" && $document_details->isConfirm() && $document_details_list->emptyRow())) {
?>
	<tr<?php echo $document_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$document_details_list->ListOptions->render("body", "left", $document_details_list->RowCnt);
?>
	<?php if ($document_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
		<td data-name="firelink_doc_no"<?php echo $document_details->firelink_doc_no->cellAttributes() ?>>
<?php if ($document_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_firelink_doc_no" class="form-group document_details_firelink_doc_no">
<input type="text" data-table="document_details" data-field="x_firelink_doc_no" name="x<?php echo $document_details_list->RowIndex ?>_firelink_doc_no" id="x<?php echo $document_details_list->RowIndex ?>_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->firelink_doc_no->EditValue ?>"<?php echo $document_details->firelink_doc_no->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_details" data-field="x_firelink_doc_no" name="o<?php echo $document_details_list->RowIndex ?>_firelink_doc_no" id="o<?php echo $document_details_list->RowIndex ?>_firelink_doc_no" value="<?php echo HtmlEncode($document_details->firelink_doc_no->OldValue) ?>">
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_firelink_doc_no" class="form-group document_details_firelink_doc_no">
<input type="text" data-table="document_details" data-field="x_firelink_doc_no" name="x<?php echo $document_details_list->RowIndex ?>_firelink_doc_no" id="x<?php echo $document_details_list->RowIndex ?>_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->firelink_doc_no->EditValue ?>"<?php echo $document_details->firelink_doc_no->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_firelink_doc_no" class="document_details_firelink_doc_no">
<span<?php echo $document_details->firelink_doc_no->viewAttributes() ?>>
<?php echo $document_details->firelink_doc_no->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="document_details" data-field="x_document_sequence" name="x<?php echo $document_details_list->RowIndex ?>_document_sequence" id="x<?php echo $document_details_list->RowIndex ?>_document_sequence" value="<?php echo HtmlEncode($document_details->document_sequence->CurrentValue) ?>">
<input type="hidden" data-table="document_details" data-field="x_document_sequence" name="o<?php echo $document_details_list->RowIndex ?>_document_sequence" id="o<?php echo $document_details_list->RowIndex ?>_document_sequence" value="<?php echo HtmlEncode($document_details->document_sequence->OldValue) ?>">
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_EDIT || $document_details->CurrentMode == "edit") { ?>
<input type="hidden" data-table="document_details" data-field="x_document_sequence" name="x<?php echo $document_details_list->RowIndex ?>_document_sequence" id="x<?php echo $document_details_list->RowIndex ?>_document_sequence" value="<?php echo HtmlEncode($document_details->document_sequence->CurrentValue) ?>">
<?php } ?>
	<?php if ($document_details->client_doc_no->Visible) { // client_doc_no ?>
		<td data-name="client_doc_no"<?php echo $document_details->client_doc_no->cellAttributes() ?>>
<?php if ($document_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_client_doc_no" class="form-group document_details_client_doc_no">
<input type="text" data-table="document_details" data-field="x_client_doc_no" name="x<?php echo $document_details_list->RowIndex ?>_client_doc_no" id="x<?php echo $document_details_list->RowIndex ?>_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->client_doc_no->EditValue ?>"<?php echo $document_details->client_doc_no->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_details" data-field="x_client_doc_no" name="o<?php echo $document_details_list->RowIndex ?>_client_doc_no" id="o<?php echo $document_details_list->RowIndex ?>_client_doc_no" value="<?php echo HtmlEncode($document_details->client_doc_no->OldValue) ?>">
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_client_doc_no" class="form-group document_details_client_doc_no">
<input type="text" data-table="document_details" data-field="x_client_doc_no" name="x<?php echo $document_details_list->RowIndex ?>_client_doc_no" id="x<?php echo $document_details_list->RowIndex ?>_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->client_doc_no->EditValue ?>"<?php echo $document_details->client_doc_no->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_client_doc_no" class="document_details_client_doc_no">
<span<?php echo $document_details->client_doc_no->viewAttributes() ?>>
<?php echo $document_details->client_doc_no->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($document_details->document_tittle->Visible) { // document_tittle ?>
		<td data-name="document_tittle"<?php echo $document_details->document_tittle->cellAttributes() ?>>
<?php if ($document_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_document_tittle" class="form-group document_details_document_tittle">
<input type="text" data-table="document_details" data-field="x_document_tittle" name="x<?php echo $document_details_list->RowIndex ?>_document_tittle" id="x<?php echo $document_details_list->RowIndex ?>_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_details->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_details->document_tittle->EditValue ?>"<?php echo $document_details->document_tittle->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_tittle" name="o<?php echo $document_details_list->RowIndex ?>_document_tittle" id="o<?php echo $document_details_list->RowIndex ?>_document_tittle" value="<?php echo HtmlEncode($document_details->document_tittle->OldValue) ?>">
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_document_tittle" class="form-group document_details_document_tittle">
<input type="text" data-table="document_details" data-field="x_document_tittle" name="x<?php echo $document_details_list->RowIndex ?>_document_tittle" id="x<?php echo $document_details_list->RowIndex ?>_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_details->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_details->document_tittle->EditValue ?>"<?php echo $document_details->document_tittle->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_document_tittle" class="document_details_document_tittle">
<span<?php echo $document_details->document_tittle->viewAttributes() ?>>
<?php echo $document_details->document_tittle->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($document_details->project_name->Visible) { // project_name ?>
		<td data-name="project_name"<?php echo $document_details->project_name->cellAttributes() ?>>
<?php if ($document_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_project_name" class="form-group document_details_project_name">
<?php
$wrkonchange = "" . trim(@$document_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $document_details_list->RowIndex ?>_project_name" class="text-nowrap" style="z-index: <?php echo (9000 - $document_details_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $document_details_list->RowIndex ?>_project_name" id="sv_x<?php echo $document_details_list->RowIndex ?>_project_name" value="<?php echo RemoveHtml($document_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>"<?php echo $document_details->project_name->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($document_details->project_name->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_project_name',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($document_details->project_name->ReadOnly || $document_details->project_name->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "project_details") && !$document_details->project_name->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $document_details_list->RowIndex ?>_project_name" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $document_details->project_name->caption() ?>" data-title="<?php echo $document_details->project_name->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_project_name',url:'project_detailsaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->project_name->displayValueSeparatorAttribute() ?>" name="x<?php echo $document_details_list->RowIndex ?>_project_name" id="x<?php echo $document_details_list->RowIndex ?>_project_name" value="<?php echo HtmlEncode($document_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailslist.createAutoSuggest({"id":"x<?php echo $document_details_list->RowIndex ?>_project_name","forceSelect":true});
</script>
<?php echo $document_details->project_name->Lookup->getParamTag("p_x" . $document_details_list->RowIndex . "_project_name") ?>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" name="o<?php echo $document_details_list->RowIndex ?>_project_name" id="o<?php echo $document_details_list->RowIndex ?>_project_name" value="<?php echo HtmlEncode($document_details->project_name->OldValue) ?>">
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_project_name" class="form-group document_details_project_name">
<?php
$wrkonchange = "" . trim(@$document_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $document_details_list->RowIndex ?>_project_name" class="text-nowrap" style="z-index: <?php echo (9000 - $document_details_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $document_details_list->RowIndex ?>_project_name" id="sv_x<?php echo $document_details_list->RowIndex ?>_project_name" value="<?php echo RemoveHtml($document_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>"<?php echo $document_details->project_name->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($document_details->project_name->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_project_name',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($document_details->project_name->ReadOnly || $document_details->project_name->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "project_details") && !$document_details->project_name->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $document_details_list->RowIndex ?>_project_name" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $document_details->project_name->caption() ?>" data-title="<?php echo $document_details->project_name->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_project_name',url:'project_detailsaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->project_name->displayValueSeparatorAttribute() ?>" name="x<?php echo $document_details_list->RowIndex ?>_project_name" id="x<?php echo $document_details_list->RowIndex ?>_project_name" value="<?php echo HtmlEncode($document_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailslist.createAutoSuggest({"id":"x<?php echo $document_details_list->RowIndex ?>_project_name","forceSelect":true});
</script>
<?php echo $document_details->project_name->Lookup->getParamTag("p_x" . $document_details_list->RowIndex . "_project_name") ?>
</span>
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_project_name" class="document_details_project_name">
<span<?php echo $document_details->project_name->viewAttributes() ?>>
<?php echo $document_details->project_name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($document_details->project_system->Visible) { // project_system ?>
		<td data-name="project_system"<?php echo $document_details->project_system->cellAttributes() ?>>
<?php if ($document_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_project_system" class="form-group document_details_project_system">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="document_details" data-field="x_project_system" data-value-separator="<?php echo $document_details->project_system->displayValueSeparatorAttribute() ?>" id="x<?php echo $document_details_list->RowIndex ?>_project_system" name="x<?php echo $document_details_list->RowIndex ?>_project_system" size=4<?php echo $document_details->project_system->editAttributes() ?>>
		<?php echo $document_details->project_system->selectOptionListHtml("x<?php echo $document_details_list->RowIndex ?>_project_system") ?>
	</select>
</div>
<?php echo $document_details->project_system->Lookup->getParamTag("p_x" . $document_details_list->RowIndex . "_project_system") ?>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_system" name="o<?php echo $document_details_list->RowIndex ?>_project_system" id="o<?php echo $document_details_list->RowIndex ?>_project_system" value="<?php echo HtmlEncode($document_details->project_system->OldValue) ?>">
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_project_system" class="form-group document_details_project_system">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="document_details" data-field="x_project_system" data-value-separator="<?php echo $document_details->project_system->displayValueSeparatorAttribute() ?>" id="x<?php echo $document_details_list->RowIndex ?>_project_system" name="x<?php echo $document_details_list->RowIndex ?>_project_system" size=4<?php echo $document_details->project_system->editAttributes() ?>>
		<?php echo $document_details->project_system->selectOptionListHtml("x<?php echo $document_details_list->RowIndex ?>_project_system") ?>
	</select>
</div>
<?php echo $document_details->project_system->Lookup->getParamTag("p_x" . $document_details_list->RowIndex . "_project_system") ?>
</span>
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_project_system" class="document_details_project_system">
<span<?php echo $document_details->project_system->viewAttributes() ?>>
<?php echo $document_details->project_system->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($document_details->planned_date->Visible) { // planned_date ?>
		<td data-name="planned_date"<?php echo $document_details->planned_date->cellAttributes() ?>>
<?php if ($document_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_planned_date" class="form-group document_details_planned_date">
<input type="text" data-table="document_details" data-field="x_planned_date" name="x<?php echo $document_details_list->RowIndex ?>_planned_date" id="x<?php echo $document_details_list->RowIndex ?>_planned_date" placeholder="<?php echo HtmlEncode($document_details->planned_date->getPlaceHolder()) ?>" value="<?php echo $document_details->planned_date->EditValue ?>"<?php echo $document_details->planned_date->editAttributes() ?>>
<?php if (!$document_details->planned_date->ReadOnly && !$document_details->planned_date->Disabled && !isset($document_details->planned_date->EditAttrs["readonly"]) && !isset($document_details->planned_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailslist", "x<?php echo $document_details_list->RowIndex ?>_planned_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="document_details" data-field="x_planned_date" name="o<?php echo $document_details_list->RowIndex ?>_planned_date" id="o<?php echo $document_details_list->RowIndex ?>_planned_date" value="<?php echo HtmlEncode($document_details->planned_date->OldValue) ?>">
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_planned_date" class="form-group document_details_planned_date">
<input type="text" data-table="document_details" data-field="x_planned_date" name="x<?php echo $document_details_list->RowIndex ?>_planned_date" id="x<?php echo $document_details_list->RowIndex ?>_planned_date" placeholder="<?php echo HtmlEncode($document_details->planned_date->getPlaceHolder()) ?>" value="<?php echo $document_details->planned_date->EditValue ?>"<?php echo $document_details->planned_date->editAttributes() ?>>
<?php if (!$document_details->planned_date->ReadOnly && !$document_details->planned_date->Disabled && !isset($document_details->planned_date->EditAttrs["readonly"]) && !isset($document_details->planned_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailslist", "x<?php echo $document_details_list->RowIndex ?>_planned_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_planned_date" class="document_details_planned_date">
<span<?php echo $document_details->planned_date->viewAttributes() ?>>
<?php echo $document_details->planned_date->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($document_details->document_type->Visible) { // document_type ?>
		<td data-name="document_type"<?php echo $document_details->document_type->cellAttributes() ?>>
<?php if ($document_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_document_type" class="form-group document_details_document_type">
<?php
$wrkonchange = "" . trim(@$document_details->document_type->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->document_type->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $document_details_list->RowIndex ?>_document_type" class="text-nowrap" style="z-index: <?php echo (9000 - $document_details_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $document_details_list->RowIndex ?>_document_type" id="sv_x<?php echo $document_details_list->RowIndex ?>_document_type" value="<?php echo RemoveHtml($document_details->document_type->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>"<?php echo $document_details->document_type->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($document_details->document_type->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_document_type',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($document_details->document_type->ReadOnly || $document_details->document_type->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "document_type") && !$document_details->document_type->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $document_details_list->RowIndex ?>_document_type" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $document_details->document_type->caption() ?>" data-title="<?php echo $document_details->document_type->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_document_type',url:'document_typeaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->document_type->displayValueSeparatorAttribute() ?>" name="x<?php echo $document_details_list->RowIndex ?>_document_type" id="x<?php echo $document_details_list->RowIndex ?>_document_type" value="<?php echo HtmlEncode($document_details->document_type->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailslist.createAutoSuggest({"id":"x<?php echo $document_details_list->RowIndex ?>_document_type","forceSelect":true});
</script>
<?php echo $document_details->document_type->Lookup->getParamTag("p_x" . $document_details_list->RowIndex . "_document_type") ?>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" name="o<?php echo $document_details_list->RowIndex ?>_document_type" id="o<?php echo $document_details_list->RowIndex ?>_document_type" value="<?php echo HtmlEncode($document_details->document_type->OldValue) ?>">
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_document_type" class="form-group document_details_document_type">
<?php
$wrkonchange = "" . trim(@$document_details->document_type->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->document_type->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $document_details_list->RowIndex ?>_document_type" class="text-nowrap" style="z-index: <?php echo (9000 - $document_details_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $document_details_list->RowIndex ?>_document_type" id="sv_x<?php echo $document_details_list->RowIndex ?>_document_type" value="<?php echo RemoveHtml($document_details->document_type->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>"<?php echo $document_details->document_type->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($document_details->document_type->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_document_type',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($document_details->document_type->ReadOnly || $document_details->document_type->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "document_type") && !$document_details->document_type->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $document_details_list->RowIndex ?>_document_type" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $document_details->document_type->caption() ?>" data-title="<?php echo $document_details->document_type->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_document_type',url:'document_typeaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->document_type->displayValueSeparatorAttribute() ?>" name="x<?php echo $document_details_list->RowIndex ?>_document_type" id="x<?php echo $document_details_list->RowIndex ?>_document_type" value="<?php echo HtmlEncode($document_details->document_type->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailslist.createAutoSuggest({"id":"x<?php echo $document_details_list->RowIndex ?>_document_type","forceSelect":true});
</script>
<?php echo $document_details->document_type->Lookup->getParamTag("p_x" . $document_details_list->RowIndex . "_document_type") ?>
</span>
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_document_type" class="document_details_document_type">
<span<?php echo $document_details->document_type->viewAttributes() ?>>
<?php echo $document_details->document_type->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($document_details->expiry_date->Visible) { // expiry_date ?>
		<td data-name="expiry_date"<?php echo $document_details->expiry_date->cellAttributes() ?>>
<?php if ($document_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_expiry_date" class="form-group document_details_expiry_date">
<input type="text" data-table="document_details" data-field="x_expiry_date" name="x<?php echo $document_details_list->RowIndex ?>_expiry_date" id="x<?php echo $document_details_list->RowIndex ?>_expiry_date" placeholder="<?php echo HtmlEncode($document_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $document_details->expiry_date->EditValue ?>"<?php echo $document_details->expiry_date->editAttributes() ?>>
<?php if (!$document_details->expiry_date->ReadOnly && !$document_details->expiry_date->Disabled && !isset($document_details->expiry_date->EditAttrs["readonly"]) && !isset($document_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailslist", "x<?php echo $document_details_list->RowIndex ?>_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="document_details" data-field="x_expiry_date" name="o<?php echo $document_details_list->RowIndex ?>_expiry_date" id="o<?php echo $document_details_list->RowIndex ?>_expiry_date" value="<?php echo HtmlEncode($document_details->expiry_date->OldValue) ?>">
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_expiry_date" class="form-group document_details_expiry_date">
<input type="text" data-table="document_details" data-field="x_expiry_date" name="x<?php echo $document_details_list->RowIndex ?>_expiry_date" id="x<?php echo $document_details_list->RowIndex ?>_expiry_date" placeholder="<?php echo HtmlEncode($document_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $document_details->expiry_date->EditValue ?>"<?php echo $document_details->expiry_date->editAttributes() ?>>
<?php if (!$document_details->expiry_date->ReadOnly && !$document_details->expiry_date->Disabled && !isset($document_details->expiry_date->EditAttrs["readonly"]) && !isset($document_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailslist", "x<?php echo $document_details_list->RowIndex ?>_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($document_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $document_details_list->RowCnt ?>_document_details_expiry_date" class="document_details_expiry_date">
<span<?php echo $document_details->expiry_date->viewAttributes() ?>>
<?php echo $document_details->expiry_date->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$document_details_list->ListOptions->render("body", "right", $document_details_list->RowCnt);
?>
	</tr>
<?php if ($document_details->RowType == ROWTYPE_ADD || $document_details->RowType == ROWTYPE_EDIT) { ?>
<script>
fdocument_detailslist.updateLists(<?php echo $document_details_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$document_details->isGridAdd())
		if (!$document_details_list->Recordset->EOF)
			$document_details_list->Recordset->moveNext();
}
?>
<?php
	if ($document_details->isGridAdd() || $document_details->isGridEdit()) {
		$document_details_list->RowIndex = '$rowindex$';
		$document_details_list->loadRowValues();

		// Set row properties
		$document_details->resetAttributes();
		$document_details->RowAttrs = array_merge($document_details->RowAttrs, array('data-rowindex'=>$document_details_list->RowIndex, 'id'=>'r0_document_details', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($document_details->RowAttrs["class"], "ew-template");
		$document_details->RowType = ROWTYPE_ADD;

		// Render row
		$document_details_list->renderRow();

		// Render list options
		$document_details_list->renderListOptions();
		$document_details_list->StartRowCnt = 0;
?>
	<tr<?php echo $document_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$document_details_list->ListOptions->render("body", "left", $document_details_list->RowIndex);
?>
	<?php if ($document_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
		<td data-name="firelink_doc_no">
<span id="el$rowindex$_document_details_firelink_doc_no" class="form-group document_details_firelink_doc_no">
<input type="text" data-table="document_details" data-field="x_firelink_doc_no" name="x<?php echo $document_details_list->RowIndex ?>_firelink_doc_no" id="x<?php echo $document_details_list->RowIndex ?>_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->firelink_doc_no->EditValue ?>"<?php echo $document_details->firelink_doc_no->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_details" data-field="x_firelink_doc_no" name="o<?php echo $document_details_list->RowIndex ?>_firelink_doc_no" id="o<?php echo $document_details_list->RowIndex ?>_firelink_doc_no" value="<?php echo HtmlEncode($document_details->firelink_doc_no->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($document_details->client_doc_no->Visible) { // client_doc_no ?>
		<td data-name="client_doc_no">
<span id="el$rowindex$_document_details_client_doc_no" class="form-group document_details_client_doc_no">
<input type="text" data-table="document_details" data-field="x_client_doc_no" name="x<?php echo $document_details_list->RowIndex ?>_client_doc_no" id="x<?php echo $document_details_list->RowIndex ?>_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->client_doc_no->EditValue ?>"<?php echo $document_details->client_doc_no->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_details" data-field="x_client_doc_no" name="o<?php echo $document_details_list->RowIndex ?>_client_doc_no" id="o<?php echo $document_details_list->RowIndex ?>_client_doc_no" value="<?php echo HtmlEncode($document_details->client_doc_no->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($document_details->document_tittle->Visible) { // document_tittle ?>
		<td data-name="document_tittle">
<span id="el$rowindex$_document_details_document_tittle" class="form-group document_details_document_tittle">
<input type="text" data-table="document_details" data-field="x_document_tittle" name="x<?php echo $document_details_list->RowIndex ?>_document_tittle" id="x<?php echo $document_details_list->RowIndex ?>_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_details->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_details->document_tittle->EditValue ?>"<?php echo $document_details->document_tittle->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_tittle" name="o<?php echo $document_details_list->RowIndex ?>_document_tittle" id="o<?php echo $document_details_list->RowIndex ?>_document_tittle" value="<?php echo HtmlEncode($document_details->document_tittle->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($document_details->project_name->Visible) { // project_name ?>
		<td data-name="project_name">
<span id="el$rowindex$_document_details_project_name" class="form-group document_details_project_name">
<?php
$wrkonchange = "" . trim(@$document_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $document_details_list->RowIndex ?>_project_name" class="text-nowrap" style="z-index: <?php echo (9000 - $document_details_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $document_details_list->RowIndex ?>_project_name" id="sv_x<?php echo $document_details_list->RowIndex ?>_project_name" value="<?php echo RemoveHtml($document_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>"<?php echo $document_details->project_name->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($document_details->project_name->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_project_name',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($document_details->project_name->ReadOnly || $document_details->project_name->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "project_details") && !$document_details->project_name->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $document_details_list->RowIndex ?>_project_name" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $document_details->project_name->caption() ?>" data-title="<?php echo $document_details->project_name->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_project_name',url:'project_detailsaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->project_name->displayValueSeparatorAttribute() ?>" name="x<?php echo $document_details_list->RowIndex ?>_project_name" id="x<?php echo $document_details_list->RowIndex ?>_project_name" value="<?php echo HtmlEncode($document_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailslist.createAutoSuggest({"id":"x<?php echo $document_details_list->RowIndex ?>_project_name","forceSelect":true});
</script>
<?php echo $document_details->project_name->Lookup->getParamTag("p_x" . $document_details_list->RowIndex . "_project_name") ?>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" name="o<?php echo $document_details_list->RowIndex ?>_project_name" id="o<?php echo $document_details_list->RowIndex ?>_project_name" value="<?php echo HtmlEncode($document_details->project_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($document_details->project_system->Visible) { // project_system ?>
		<td data-name="project_system">
<span id="el$rowindex$_document_details_project_system" class="form-group document_details_project_system">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="document_details" data-field="x_project_system" data-value-separator="<?php echo $document_details->project_system->displayValueSeparatorAttribute() ?>" id="x<?php echo $document_details_list->RowIndex ?>_project_system" name="x<?php echo $document_details_list->RowIndex ?>_project_system" size=4<?php echo $document_details->project_system->editAttributes() ?>>
		<?php echo $document_details->project_system->selectOptionListHtml("x<?php echo $document_details_list->RowIndex ?>_project_system") ?>
	</select>
</div>
<?php echo $document_details->project_system->Lookup->getParamTag("p_x" . $document_details_list->RowIndex . "_project_system") ?>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_system" name="o<?php echo $document_details_list->RowIndex ?>_project_system" id="o<?php echo $document_details_list->RowIndex ?>_project_system" value="<?php echo HtmlEncode($document_details->project_system->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($document_details->planned_date->Visible) { // planned_date ?>
		<td data-name="planned_date">
<span id="el$rowindex$_document_details_planned_date" class="form-group document_details_planned_date">
<input type="text" data-table="document_details" data-field="x_planned_date" name="x<?php echo $document_details_list->RowIndex ?>_planned_date" id="x<?php echo $document_details_list->RowIndex ?>_planned_date" placeholder="<?php echo HtmlEncode($document_details->planned_date->getPlaceHolder()) ?>" value="<?php echo $document_details->planned_date->EditValue ?>"<?php echo $document_details->planned_date->editAttributes() ?>>
<?php if (!$document_details->planned_date->ReadOnly && !$document_details->planned_date->Disabled && !isset($document_details->planned_date->EditAttrs["readonly"]) && !isset($document_details->planned_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailslist", "x<?php echo $document_details_list->RowIndex ?>_planned_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="document_details" data-field="x_planned_date" name="o<?php echo $document_details_list->RowIndex ?>_planned_date" id="o<?php echo $document_details_list->RowIndex ?>_planned_date" value="<?php echo HtmlEncode($document_details->planned_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($document_details->document_type->Visible) { // document_type ?>
		<td data-name="document_type">
<span id="el$rowindex$_document_details_document_type" class="form-group document_details_document_type">
<?php
$wrkonchange = "" . trim(@$document_details->document_type->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->document_type->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $document_details_list->RowIndex ?>_document_type" class="text-nowrap" style="z-index: <?php echo (9000 - $document_details_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $document_details_list->RowIndex ?>_document_type" id="sv_x<?php echo $document_details_list->RowIndex ?>_document_type" value="<?php echo RemoveHtml($document_details->document_type->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>"<?php echo $document_details->document_type->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($document_details->document_type->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_document_type',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($document_details->document_type->ReadOnly || $document_details->document_type->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "document_type") && !$document_details->document_type->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $document_details_list->RowIndex ?>_document_type" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $document_details->document_type->caption() ?>" data-title="<?php echo $document_details->document_type->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $document_details_list->RowIndex ?>_document_type',url:'document_typeaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->document_type->displayValueSeparatorAttribute() ?>" name="x<?php echo $document_details_list->RowIndex ?>_document_type" id="x<?php echo $document_details_list->RowIndex ?>_document_type" value="<?php echo HtmlEncode($document_details->document_type->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailslist.createAutoSuggest({"id":"x<?php echo $document_details_list->RowIndex ?>_document_type","forceSelect":true});
</script>
<?php echo $document_details->document_type->Lookup->getParamTag("p_x" . $document_details_list->RowIndex . "_document_type") ?>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" name="o<?php echo $document_details_list->RowIndex ?>_document_type" id="o<?php echo $document_details_list->RowIndex ?>_document_type" value="<?php echo HtmlEncode($document_details->document_type->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($document_details->expiry_date->Visible) { // expiry_date ?>
		<td data-name="expiry_date">
<span id="el$rowindex$_document_details_expiry_date" class="form-group document_details_expiry_date">
<input type="text" data-table="document_details" data-field="x_expiry_date" name="x<?php echo $document_details_list->RowIndex ?>_expiry_date" id="x<?php echo $document_details_list->RowIndex ?>_expiry_date" placeholder="<?php echo HtmlEncode($document_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $document_details->expiry_date->EditValue ?>"<?php echo $document_details->expiry_date->editAttributes() ?>>
<?php if (!$document_details->expiry_date->ReadOnly && !$document_details->expiry_date->Disabled && !isset($document_details->expiry_date->EditAttrs["readonly"]) && !isset($document_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailslist", "x<?php echo $document_details_list->RowIndex ?>_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="document_details" data-field="x_expiry_date" name="o<?php echo $document_details_list->RowIndex ?>_expiry_date" id="o<?php echo $document_details_list->RowIndex ?>_expiry_date" value="<?php echo HtmlEncode($document_details->expiry_date->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$document_details_list->ListOptions->render("body", "right", $document_details_list->RowIndex);
?>
<script>
fdocument_detailslist.updateLists(<?php echo $document_details_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($document_details->isAdd() || $document_details->isCopy()) { ?>
<input type="hidden" name="<?php echo $document_details_list->FormKeyCountName ?>" id="<?php echo $document_details_list->FormKeyCountName ?>" value="<?php echo $document_details_list->KeyCount ?>">
<?php } ?>
<?php if ($document_details->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $document_details_list->FormKeyCountName ?>" id="<?php echo $document_details_list->FormKeyCountName ?>" value="<?php echo $document_details_list->KeyCount ?>">
<?php echo $document_details_list->MultiSelectKey ?>
<?php } ?>
<?php if ($document_details->isEdit()) { ?>
<input type="hidden" name="<?php echo $document_details_list->FormKeyCountName ?>" id="<?php echo $document_details_list->FormKeyCountName ?>" value="<?php echo $document_details_list->KeyCount ?>">
<?php } ?>
<?php if ($document_details->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $document_details_list->FormKeyCountName ?>" id="<?php echo $document_details_list->FormKeyCountName ?>" value="<?php echo $document_details_list->KeyCount ?>">
<?php echo $document_details_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$document_details->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($document_details_list->Recordset)
	$document_details_list->Recordset->Close();
?>
<?php if (!$document_details->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$document_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($document_details_list->Pager)) $document_details_list->Pager = new NumericPager($document_details_list->StartRec, $document_details_list->DisplayRecs, $document_details_list->TotalRecs, $document_details_list->RecRange, $document_details_list->AutoHidePager) ?>
<?php if ($document_details_list->Pager->RecordCount > 0 && $document_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($document_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_details_list->pageUrl() ?>start=<?php echo $document_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($document_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_details_list->pageUrl() ?>start=<?php echo $document_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($document_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $document_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($document_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_details_list->pageUrl() ?>start=<?php echo $document_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($document_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_details_list->pageUrl() ?>start=<?php echo $document_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($document_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $document_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $document_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $document_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $document_details_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($document_details_list->TotalRecs == 0 && !$document_details->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $document_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$document_details_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$document_details->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$document_details_list->terminate();
?>