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
$project_details_list = new project_details_list();

// Run the page
$project_details_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_details_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$project_details->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fproject_detailslist = currentForm = new ew.Form("fproject_detailslist", "list");
fproject_detailslist.formKeyCountName = '<?php echo $project_details_list->FormKeyCountName ?>';

// Validate form
fproject_detailslist.validate = function() {
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
		<?php if ($project_details_list->project_name->Required) { ?>
			elm = this.getElements("x" + infix + "_project_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_name->caption(), $project_details->project_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($project_details_list->project_our_client->Required) { ?>
			elm = this.getElements("x" + infix + "_project_our_client");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_our_client->caption(), $project_details->project_our_client->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($project_details_list->project_end_user->Required) { ?>
			elm = this.getElements("x" + infix + "_project_end_user");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_end_user->caption(), $project_details->project_end_user->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($project_details_list->project_sales_engg->Required) { ?>
			elm = this.getElements("x" + infix + "_project_sales_engg");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_sales_engg->caption(), $project_details->project_sales_engg->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_project_sales_engg");
			if (elm && !ew.checkEmail(elm.value))
				return this.onError(elm, "<?php echo JsEncode($project_details->project_sales_engg->errorMessage()) ?>");
		<?php if ($project_details_list->project_distribution->Required) { ?>
			elm = this.getElements("x" + infix + "_project_distribution");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_distribution->caption(), $project_details->project_distribution->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_project_distribution");
			if (elm && !ew.checkEmail(elm.value))
				return this.onError(elm, "<?php echo JsEncode($project_details->project_distribution->errorMessage()) ?>");
		<?php if ($project_details_list->project_transmittal->Required) { ?>
			elm = this.getElements("x" + infix + "_project_transmittal");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_transmittal->caption(), $project_details->project_transmittal->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($project_details_list->order_number->Required) { ?>
			elm = this.getElements("x" + infix + "_order_number");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->order_number->caption(), $project_details->order_number->RequiredErrorMessage)) ?>");
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
fproject_detailslist.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "project_name", false)) return false;
	if (ew.valueChanged(fobj, infix, "project_our_client", false)) return false;
	if (ew.valueChanged(fobj, infix, "project_end_user", false)) return false;
	if (ew.valueChanged(fobj, infix, "project_sales_engg", false)) return false;
	if (ew.valueChanged(fobj, infix, "project_distribution", false)) return false;
	if (ew.valueChanged(fobj, infix, "project_transmittal", false)) return false;
	if (ew.valueChanged(fobj, infix, "order_number", false)) return false;
	return true;
}

// Form_CustomValidate event
fproject_detailslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproject_detailslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fproject_detailslistsrch = currentSearchForm = new ew.Form("fproject_detailslistsrch");

// Filters
fproject_detailslistsrch.filterList = <?php echo $project_details_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$project_details->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($project_details_list->TotalRecs > 0 && $project_details_list->ExportOptions->visible()) { ?>
<?php $project_details_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($project_details_list->ImportOptions->visible()) { ?>
<?php $project_details_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($project_details_list->SearchOptions->visible()) { ?>
<?php $project_details_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($project_details_list->FilterOptions->visible()) { ?>
<?php $project_details_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$project_details_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$project_details->isExport() && !$project_details->CurrentAction) { ?>
<form name="fproject_detailslistsrch" id="fproject_detailslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($project_details_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fproject_detailslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="project_details">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($project_details_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($project_details_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $project_details_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($project_details_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($project_details_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($project_details_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($project_details_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $project_details_list->showPageHeader(); ?>
<?php
$project_details_list->showMessage();
?>
<?php if ($project_details_list->TotalRecs > 0 || $project_details->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($project_details_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> project_details">
<?php if (!$project_details->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$project_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($project_details_list->Pager)) $project_details_list->Pager = new NumericPager($project_details_list->StartRec, $project_details_list->DisplayRecs, $project_details_list->TotalRecs, $project_details_list->RecRange, $project_details_list->AutoHidePager) ?>
<?php if ($project_details_list->Pager->RecordCount > 0 && $project_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($project_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $project_details_list->pageUrl() ?>start=<?php echo $project_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($project_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $project_details_list->pageUrl() ?>start=<?php echo $project_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($project_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $project_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($project_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $project_details_list->pageUrl() ?>start=<?php echo $project_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($project_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $project_details_list->pageUrl() ?>start=<?php echo $project_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($project_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $project_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $project_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $project_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $project_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproject_detailslist" id="fproject_detailslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($project_details_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $project_details_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_details">
<div id="gmp_project_details" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($project_details_list->TotalRecs > 0 || $project_details->isGridEdit()) { ?>
<table id="tbl_project_detailslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$project_details_list->RowType = ROWTYPE_HEADER;

// Render list options
$project_details_list->renderListOptions();

// Render list options (header, left)
$project_details_list->ListOptions->render("header", "left");
?>
<?php if ($project_details->project_name->Visible) { // project_name ?>
	<?php if ($project_details->sortUrl($project_details->project_name) == "") { ?>
		<th data-name="project_name" class="<?php echo $project_details->project_name->headerCellClass() ?>"><div id="elh_project_details_project_name" class="project_details_project_name"><div class="ew-table-header-caption"><?php echo $project_details->project_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="project_name" class="<?php echo $project_details->project_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $project_details->SortUrl($project_details->project_name) ?>',2);"><div id="elh_project_details_project_name" class="project_details_project_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_details->project_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($project_details->project_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($project_details->project_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_details->project_our_client->Visible) { // project_our_client ?>
	<?php if ($project_details->sortUrl($project_details->project_our_client) == "") { ?>
		<th data-name="project_our_client" class="<?php echo $project_details->project_our_client->headerCellClass() ?>"><div id="elh_project_details_project_our_client" class="project_details_project_our_client"><div class="ew-table-header-caption"><?php echo $project_details->project_our_client->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="project_our_client" class="<?php echo $project_details->project_our_client->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $project_details->SortUrl($project_details->project_our_client) ?>',2);"><div id="elh_project_details_project_our_client" class="project_details_project_our_client">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_details->project_our_client->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($project_details->project_our_client->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($project_details->project_our_client->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_details->project_end_user->Visible) { // project_end_user ?>
	<?php if ($project_details->sortUrl($project_details->project_end_user) == "") { ?>
		<th data-name="project_end_user" class="<?php echo $project_details->project_end_user->headerCellClass() ?>"><div id="elh_project_details_project_end_user" class="project_details_project_end_user"><div class="ew-table-header-caption"><?php echo $project_details->project_end_user->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="project_end_user" class="<?php echo $project_details->project_end_user->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $project_details->SortUrl($project_details->project_end_user) ?>',2);"><div id="elh_project_details_project_end_user" class="project_details_project_end_user">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_details->project_end_user->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($project_details->project_end_user->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($project_details->project_end_user->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_details->project_sales_engg->Visible) { // project_sales_engg ?>
	<?php if ($project_details->sortUrl($project_details->project_sales_engg) == "") { ?>
		<th data-name="project_sales_engg" class="<?php echo $project_details->project_sales_engg->headerCellClass() ?>"><div id="elh_project_details_project_sales_engg" class="project_details_project_sales_engg"><div class="ew-table-header-caption"><?php echo $project_details->project_sales_engg->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="project_sales_engg" class="<?php echo $project_details->project_sales_engg->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $project_details->SortUrl($project_details->project_sales_engg) ?>',2);"><div id="elh_project_details_project_sales_engg" class="project_details_project_sales_engg">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_details->project_sales_engg->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($project_details->project_sales_engg->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($project_details->project_sales_engg->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_details->project_distribution->Visible) { // project_distribution ?>
	<?php if ($project_details->sortUrl($project_details->project_distribution) == "") { ?>
		<th data-name="project_distribution" class="<?php echo $project_details->project_distribution->headerCellClass() ?>"><div id="elh_project_details_project_distribution" class="project_details_project_distribution"><div class="ew-table-header-caption"><?php echo $project_details->project_distribution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="project_distribution" class="<?php echo $project_details->project_distribution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $project_details->SortUrl($project_details->project_distribution) ?>',2);"><div id="elh_project_details_project_distribution" class="project_details_project_distribution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_details->project_distribution->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($project_details->project_distribution->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($project_details->project_distribution->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_details->project_transmittal->Visible) { // project_transmittal ?>
	<?php if ($project_details->sortUrl($project_details->project_transmittal) == "") { ?>
		<th data-name="project_transmittal" class="<?php echo $project_details->project_transmittal->headerCellClass() ?>"><div id="elh_project_details_project_transmittal" class="project_details_project_transmittal"><div class="ew-table-header-caption"><?php echo $project_details->project_transmittal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="project_transmittal" class="<?php echo $project_details->project_transmittal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $project_details->SortUrl($project_details->project_transmittal) ?>',2);"><div id="elh_project_details_project_transmittal" class="project_details_project_transmittal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_details->project_transmittal->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($project_details->project_transmittal->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($project_details->project_transmittal->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_details->order_number->Visible) { // order_number ?>
	<?php if ($project_details->sortUrl($project_details->order_number) == "") { ?>
		<th data-name="order_number" class="<?php echo $project_details->order_number->headerCellClass() ?>"><div id="elh_project_details_order_number" class="project_details_order_number"><div class="ew-table-header-caption"><?php echo $project_details->order_number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="order_number" class="<?php echo $project_details->order_number->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $project_details->SortUrl($project_details->order_number) ?>',2);"><div id="elh_project_details_order_number" class="project_details_order_number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_details->order_number->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($project_details->order_number->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($project_details->order_number->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$project_details_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($project_details->ExportAll && $project_details->isExport()) {
	$project_details_list->StopRec = $project_details_list->TotalRecs;
} else {

	// Set the last record to display
	if ($project_details_list->TotalRecs > $project_details_list->StartRec + $project_details_list->DisplayRecs - 1)
		$project_details_list->StopRec = $project_details_list->StartRec + $project_details_list->DisplayRecs - 1;
	else
		$project_details_list->StopRec = $project_details_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $project_details_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($project_details_list->FormKeyCountName) && ($project_details->isGridAdd() || $project_details->isGridEdit() || $project_details->isConfirm())) {
		$project_details_list->KeyCount = $CurrentForm->getValue($project_details_list->FormKeyCountName);
		$project_details_list->StopRec = $project_details_list->StartRec + $project_details_list->KeyCount - 1;
	}
}
$project_details_list->RecCnt = $project_details_list->StartRec - 1;
if ($project_details_list->Recordset && !$project_details_list->Recordset->EOF) {
	$project_details_list->Recordset->moveFirst();
	$selectLimit = $project_details_list->UseSelectLimit;
	if (!$selectLimit && $project_details_list->StartRec > 1)
		$project_details_list->Recordset->move($project_details_list->StartRec - 1);
} elseif (!$project_details->AllowAddDeleteRow && $project_details_list->StopRec == 0) {
	$project_details_list->StopRec = $project_details->GridAddRowCount;
}

// Initialize aggregate
$project_details->RowType = ROWTYPE_AGGREGATEINIT;
$project_details->resetAttributes();
$project_details_list->renderRow();
if ($project_details->isGridAdd())
	$project_details_list->RowIndex = 0;
while ($project_details_list->RecCnt < $project_details_list->StopRec) {
	$project_details_list->RecCnt++;
	if ($project_details_list->RecCnt >= $project_details_list->StartRec) {
		$project_details_list->RowCnt++;
		if ($project_details->isGridAdd() || $project_details->isGridEdit() || $project_details->isConfirm()) {
			$project_details_list->RowIndex++;
			$CurrentForm->Index = $project_details_list->RowIndex;
			if ($CurrentForm->hasValue($project_details_list->FormActionName) && $project_details_list->EventCancelled)
				$project_details_list->RowAction = strval($CurrentForm->getValue($project_details_list->FormActionName));
			elseif ($project_details->isGridAdd())
				$project_details_list->RowAction = "insert";
			else
				$project_details_list->RowAction = "";
		}

		// Set up key count
		$project_details_list->KeyCount = $project_details_list->RowIndex;

		// Init row class and style
		$project_details->resetAttributes();
		$project_details->CssClass = "";
		if ($project_details->isGridAdd()) {
			$project_details_list->loadRowValues(); // Load default values
		} else {
			$project_details_list->loadRowValues($project_details_list->Recordset); // Load row values
		}
		$project_details->RowType = ROWTYPE_VIEW; // Render view
		if ($project_details->isGridAdd()) // Grid add
			$project_details->RowType = ROWTYPE_ADD; // Render add
		if ($project_details->isGridAdd() && $project_details->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$project_details_list->restoreCurrentRowFormValues($project_details_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$project_details->RowAttrs = array_merge($project_details->RowAttrs, array('data-rowindex'=>$project_details_list->RowCnt, 'id'=>'r' . $project_details_list->RowCnt . '_project_details', 'data-rowtype'=>$project_details->RowType));

		// Render row
		$project_details_list->renderRow();

		// Render list options
		$project_details_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($project_details_list->RowAction <> "delete" && $project_details_list->RowAction <> "insertdelete" && !($project_details_list->RowAction == "insert" && $project_details->isConfirm() && $project_details_list->emptyRow())) {
?>
	<tr<?php echo $project_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$project_details_list->ListOptions->render("body", "left", $project_details_list->RowCnt);
?>
	<?php if ($project_details->project_name->Visible) { // project_name ?>
		<td data-name="project_name"<?php echo $project_details->project_name->cellAttributes() ?>>
<?php if ($project_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_details_list->RowCnt ?>_project_details_project_name" class="form-group project_details_project_name">
<input type="text" data-table="project_details" data-field="x_project_name" name="x<?php echo $project_details_list->RowIndex ?>_project_name" id="x<?php echo $project_details_list->RowIndex ?>_project_name" size="30" placeholder="<?php echo HtmlEncode($project_details->project_name->getPlaceHolder()) ?>" value="<?php echo $project_details->project_name->EditValue ?>"<?php echo $project_details->project_name->editAttributes() ?>>
</span>
<input type="hidden" data-table="project_details" data-field="x_project_name" name="o<?php echo $project_details_list->RowIndex ?>_project_name" id="o<?php echo $project_details_list->RowIndex ?>_project_name" value="<?php echo HtmlEncode($project_details->project_name->OldValue) ?>">
<?php } ?>
<?php if ($project_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_details_list->RowCnt ?>_project_details_project_name" class="project_details_project_name">
<span<?php echo $project_details->project_name->viewAttributes() ?>>
<?php echo $project_details->project_name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_details->project_our_client->Visible) { // project_our_client ?>
		<td data-name="project_our_client"<?php echo $project_details->project_our_client->cellAttributes() ?>>
<?php if ($project_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_details_list->RowCnt ?>_project_details_project_our_client" class="form-group project_details_project_our_client">
<input type="text" data-table="project_details" data-field="x_project_our_client" name="x<?php echo $project_details_list->RowIndex ?>_project_our_client" id="x<?php echo $project_details_list->RowIndex ?>_project_our_client" size="30" placeholder="<?php echo HtmlEncode($project_details->project_our_client->getPlaceHolder()) ?>" value="<?php echo $project_details->project_our_client->EditValue ?>"<?php echo $project_details->project_our_client->editAttributes() ?>>
</span>
<input type="hidden" data-table="project_details" data-field="x_project_our_client" name="o<?php echo $project_details_list->RowIndex ?>_project_our_client" id="o<?php echo $project_details_list->RowIndex ?>_project_our_client" value="<?php echo HtmlEncode($project_details->project_our_client->OldValue) ?>">
<?php } ?>
<?php if ($project_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_details_list->RowCnt ?>_project_details_project_our_client" class="project_details_project_our_client">
<span<?php echo $project_details->project_our_client->viewAttributes() ?>>
<?php echo $project_details->project_our_client->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_details->project_end_user->Visible) { // project_end_user ?>
		<td data-name="project_end_user"<?php echo $project_details->project_end_user->cellAttributes() ?>>
<?php if ($project_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_details_list->RowCnt ?>_project_details_project_end_user" class="form-group project_details_project_end_user">
<input type="text" data-table="project_details" data-field="x_project_end_user" name="x<?php echo $project_details_list->RowIndex ?>_project_end_user" id="x<?php echo $project_details_list->RowIndex ?>_project_end_user" size="30" placeholder="<?php echo HtmlEncode($project_details->project_end_user->getPlaceHolder()) ?>" value="<?php echo $project_details->project_end_user->EditValue ?>"<?php echo $project_details->project_end_user->editAttributes() ?>>
</span>
<input type="hidden" data-table="project_details" data-field="x_project_end_user" name="o<?php echo $project_details_list->RowIndex ?>_project_end_user" id="o<?php echo $project_details_list->RowIndex ?>_project_end_user" value="<?php echo HtmlEncode($project_details->project_end_user->OldValue) ?>">
<?php } ?>
<?php if ($project_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_details_list->RowCnt ?>_project_details_project_end_user" class="project_details_project_end_user">
<span<?php echo $project_details->project_end_user->viewAttributes() ?>>
<?php echo $project_details->project_end_user->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_details->project_sales_engg->Visible) { // project_sales_engg ?>
		<td data-name="project_sales_engg"<?php echo $project_details->project_sales_engg->cellAttributes() ?>>
<?php if ($project_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_details_list->RowCnt ?>_project_details_project_sales_engg" class="form-group project_details_project_sales_engg">
<input type="text" data-table="project_details" data-field="x_project_sales_engg" name="x<?php echo $project_details_list->RowIndex ?>_project_sales_engg" id="x<?php echo $project_details_list->RowIndex ?>_project_sales_engg" size="30" placeholder="<?php echo HtmlEncode($project_details->project_sales_engg->getPlaceHolder()) ?>" value="<?php echo $project_details->project_sales_engg->EditValue ?>"<?php echo $project_details->project_sales_engg->editAttributes() ?>>
</span>
<input type="hidden" data-table="project_details" data-field="x_project_sales_engg" name="o<?php echo $project_details_list->RowIndex ?>_project_sales_engg" id="o<?php echo $project_details_list->RowIndex ?>_project_sales_engg" value="<?php echo HtmlEncode($project_details->project_sales_engg->OldValue) ?>">
<?php } ?>
<?php if ($project_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_details_list->RowCnt ?>_project_details_project_sales_engg" class="project_details_project_sales_engg">
<span<?php echo $project_details->project_sales_engg->viewAttributes() ?>>
<?php echo $project_details->project_sales_engg->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_details->project_distribution->Visible) { // project_distribution ?>
		<td data-name="project_distribution"<?php echo $project_details->project_distribution->cellAttributes() ?>>
<?php if ($project_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_details_list->RowCnt ?>_project_details_project_distribution" class="form-group project_details_project_distribution">
<input type="text" data-table="project_details" data-field="x_project_distribution" name="x<?php echo $project_details_list->RowIndex ?>_project_distribution" id="x<?php echo $project_details_list->RowIndex ?>_project_distribution" size="30" placeholder="<?php echo HtmlEncode($project_details->project_distribution->getPlaceHolder()) ?>" value="<?php echo $project_details->project_distribution->EditValue ?>"<?php echo $project_details->project_distribution->editAttributes() ?>>
</span>
<input type="hidden" data-table="project_details" data-field="x_project_distribution" name="o<?php echo $project_details_list->RowIndex ?>_project_distribution" id="o<?php echo $project_details_list->RowIndex ?>_project_distribution" value="<?php echo HtmlEncode($project_details->project_distribution->OldValue) ?>">
<?php } ?>
<?php if ($project_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_details_list->RowCnt ?>_project_details_project_distribution" class="project_details_project_distribution">
<span<?php echo $project_details->project_distribution->viewAttributes() ?>>
<?php echo $project_details->project_distribution->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_details->project_transmittal->Visible) { // project_transmittal ?>
		<td data-name="project_transmittal"<?php echo $project_details->project_transmittal->cellAttributes() ?>>
<?php if ($project_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_details_list->RowCnt ?>_project_details_project_transmittal" class="form-group project_details_project_transmittal">
<input type="text" data-table="project_details" data-field="x_project_transmittal" name="x<?php echo $project_details_list->RowIndex ?>_project_transmittal" id="x<?php echo $project_details_list->RowIndex ?>_project_transmittal" size="30" placeholder="<?php echo HtmlEncode($project_details->project_transmittal->getPlaceHolder()) ?>" value="<?php echo $project_details->project_transmittal->EditValue ?>"<?php echo $project_details->project_transmittal->editAttributes() ?>>
</span>
<input type="hidden" data-table="project_details" data-field="x_project_transmittal" name="o<?php echo $project_details_list->RowIndex ?>_project_transmittal" id="o<?php echo $project_details_list->RowIndex ?>_project_transmittal" value="<?php echo HtmlEncode($project_details->project_transmittal->OldValue) ?>">
<?php } ?>
<?php if ($project_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_details_list->RowCnt ?>_project_details_project_transmittal" class="project_details_project_transmittal">
<span<?php echo $project_details->project_transmittal->viewAttributes() ?>>
<?php echo $project_details->project_transmittal->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_details->order_number->Visible) { // order_number ?>
		<td data-name="order_number"<?php echo $project_details->order_number->cellAttributes() ?>>
<?php if ($project_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_details_list->RowCnt ?>_project_details_order_number" class="form-group project_details_order_number">
<input type="text" data-table="project_details" data-field="x_order_number" name="x<?php echo $project_details_list->RowIndex ?>_order_number" id="x<?php echo $project_details_list->RowIndex ?>_order_number" size="30" placeholder="<?php echo HtmlEncode($project_details->order_number->getPlaceHolder()) ?>" value="<?php echo $project_details->order_number->EditValue ?>"<?php echo $project_details->order_number->editAttributes() ?>>
</span>
<input type="hidden" data-table="project_details" data-field="x_order_number" name="o<?php echo $project_details_list->RowIndex ?>_order_number" id="o<?php echo $project_details_list->RowIndex ?>_order_number" value="<?php echo HtmlEncode($project_details->order_number->OldValue) ?>">
<?php } ?>
<?php if ($project_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_details_list->RowCnt ?>_project_details_order_number" class="project_details_order_number">
<span<?php echo $project_details->order_number->viewAttributes() ?>>
<?php echo $project_details->order_number->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$project_details_list->ListOptions->render("body", "right", $project_details_list->RowCnt);
?>
	</tr>
<?php if ($project_details->RowType == ROWTYPE_ADD || $project_details->RowType == ROWTYPE_EDIT) { ?>
<script>
fproject_detailslist.updateLists(<?php echo $project_details_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$project_details->isGridAdd())
		if (!$project_details_list->Recordset->EOF)
			$project_details_list->Recordset->moveNext();
}
?>
<?php
	if ($project_details->isGridAdd() || $project_details->isGridEdit()) {
		$project_details_list->RowIndex = '$rowindex$';
		$project_details_list->loadRowValues();

		// Set row properties
		$project_details->resetAttributes();
		$project_details->RowAttrs = array_merge($project_details->RowAttrs, array('data-rowindex'=>$project_details_list->RowIndex, 'id'=>'r0_project_details', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($project_details->RowAttrs["class"], "ew-template");
		$project_details->RowType = ROWTYPE_ADD;

		// Render row
		$project_details_list->renderRow();

		// Render list options
		$project_details_list->renderListOptions();
		$project_details_list->StartRowCnt = 0;
?>
	<tr<?php echo $project_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$project_details_list->ListOptions->render("body", "left", $project_details_list->RowIndex);
?>
	<?php if ($project_details->project_name->Visible) { // project_name ?>
		<td data-name="project_name">
<span id="el$rowindex$_project_details_project_name" class="form-group project_details_project_name">
<input type="text" data-table="project_details" data-field="x_project_name" name="x<?php echo $project_details_list->RowIndex ?>_project_name" id="x<?php echo $project_details_list->RowIndex ?>_project_name" size="30" placeholder="<?php echo HtmlEncode($project_details->project_name->getPlaceHolder()) ?>" value="<?php echo $project_details->project_name->EditValue ?>"<?php echo $project_details->project_name->editAttributes() ?>>
</span>
<input type="hidden" data-table="project_details" data-field="x_project_name" name="o<?php echo $project_details_list->RowIndex ?>_project_name" id="o<?php echo $project_details_list->RowIndex ?>_project_name" value="<?php echo HtmlEncode($project_details->project_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_details->project_our_client->Visible) { // project_our_client ?>
		<td data-name="project_our_client">
<span id="el$rowindex$_project_details_project_our_client" class="form-group project_details_project_our_client">
<input type="text" data-table="project_details" data-field="x_project_our_client" name="x<?php echo $project_details_list->RowIndex ?>_project_our_client" id="x<?php echo $project_details_list->RowIndex ?>_project_our_client" size="30" placeholder="<?php echo HtmlEncode($project_details->project_our_client->getPlaceHolder()) ?>" value="<?php echo $project_details->project_our_client->EditValue ?>"<?php echo $project_details->project_our_client->editAttributes() ?>>
</span>
<input type="hidden" data-table="project_details" data-field="x_project_our_client" name="o<?php echo $project_details_list->RowIndex ?>_project_our_client" id="o<?php echo $project_details_list->RowIndex ?>_project_our_client" value="<?php echo HtmlEncode($project_details->project_our_client->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_details->project_end_user->Visible) { // project_end_user ?>
		<td data-name="project_end_user">
<span id="el$rowindex$_project_details_project_end_user" class="form-group project_details_project_end_user">
<input type="text" data-table="project_details" data-field="x_project_end_user" name="x<?php echo $project_details_list->RowIndex ?>_project_end_user" id="x<?php echo $project_details_list->RowIndex ?>_project_end_user" size="30" placeholder="<?php echo HtmlEncode($project_details->project_end_user->getPlaceHolder()) ?>" value="<?php echo $project_details->project_end_user->EditValue ?>"<?php echo $project_details->project_end_user->editAttributes() ?>>
</span>
<input type="hidden" data-table="project_details" data-field="x_project_end_user" name="o<?php echo $project_details_list->RowIndex ?>_project_end_user" id="o<?php echo $project_details_list->RowIndex ?>_project_end_user" value="<?php echo HtmlEncode($project_details->project_end_user->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_details->project_sales_engg->Visible) { // project_sales_engg ?>
		<td data-name="project_sales_engg">
<span id="el$rowindex$_project_details_project_sales_engg" class="form-group project_details_project_sales_engg">
<input type="text" data-table="project_details" data-field="x_project_sales_engg" name="x<?php echo $project_details_list->RowIndex ?>_project_sales_engg" id="x<?php echo $project_details_list->RowIndex ?>_project_sales_engg" size="30" placeholder="<?php echo HtmlEncode($project_details->project_sales_engg->getPlaceHolder()) ?>" value="<?php echo $project_details->project_sales_engg->EditValue ?>"<?php echo $project_details->project_sales_engg->editAttributes() ?>>
</span>
<input type="hidden" data-table="project_details" data-field="x_project_sales_engg" name="o<?php echo $project_details_list->RowIndex ?>_project_sales_engg" id="o<?php echo $project_details_list->RowIndex ?>_project_sales_engg" value="<?php echo HtmlEncode($project_details->project_sales_engg->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_details->project_distribution->Visible) { // project_distribution ?>
		<td data-name="project_distribution">
<span id="el$rowindex$_project_details_project_distribution" class="form-group project_details_project_distribution">
<input type="text" data-table="project_details" data-field="x_project_distribution" name="x<?php echo $project_details_list->RowIndex ?>_project_distribution" id="x<?php echo $project_details_list->RowIndex ?>_project_distribution" size="30" placeholder="<?php echo HtmlEncode($project_details->project_distribution->getPlaceHolder()) ?>" value="<?php echo $project_details->project_distribution->EditValue ?>"<?php echo $project_details->project_distribution->editAttributes() ?>>
</span>
<input type="hidden" data-table="project_details" data-field="x_project_distribution" name="o<?php echo $project_details_list->RowIndex ?>_project_distribution" id="o<?php echo $project_details_list->RowIndex ?>_project_distribution" value="<?php echo HtmlEncode($project_details->project_distribution->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_details->project_transmittal->Visible) { // project_transmittal ?>
		<td data-name="project_transmittal">
<span id="el$rowindex$_project_details_project_transmittal" class="form-group project_details_project_transmittal">
<input type="text" data-table="project_details" data-field="x_project_transmittal" name="x<?php echo $project_details_list->RowIndex ?>_project_transmittal" id="x<?php echo $project_details_list->RowIndex ?>_project_transmittal" size="30" placeholder="<?php echo HtmlEncode($project_details->project_transmittal->getPlaceHolder()) ?>" value="<?php echo $project_details->project_transmittal->EditValue ?>"<?php echo $project_details->project_transmittal->editAttributes() ?>>
</span>
<input type="hidden" data-table="project_details" data-field="x_project_transmittal" name="o<?php echo $project_details_list->RowIndex ?>_project_transmittal" id="o<?php echo $project_details_list->RowIndex ?>_project_transmittal" value="<?php echo HtmlEncode($project_details->project_transmittal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_details->order_number->Visible) { // order_number ?>
		<td data-name="order_number">
<span id="el$rowindex$_project_details_order_number" class="form-group project_details_order_number">
<input type="text" data-table="project_details" data-field="x_order_number" name="x<?php echo $project_details_list->RowIndex ?>_order_number" id="x<?php echo $project_details_list->RowIndex ?>_order_number" size="30" placeholder="<?php echo HtmlEncode($project_details->order_number->getPlaceHolder()) ?>" value="<?php echo $project_details->order_number->EditValue ?>"<?php echo $project_details->order_number->editAttributes() ?>>
</span>
<input type="hidden" data-table="project_details" data-field="x_order_number" name="o<?php echo $project_details_list->RowIndex ?>_order_number" id="o<?php echo $project_details_list->RowIndex ?>_order_number" value="<?php echo HtmlEncode($project_details->order_number->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$project_details_list->ListOptions->render("body", "right", $project_details_list->RowIndex);
?>
<script>
fproject_detailslist.updateLists(<?php echo $project_details_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($project_details->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $project_details_list->FormKeyCountName ?>" id="<?php echo $project_details_list->FormKeyCountName ?>" value="<?php echo $project_details_list->KeyCount ?>">
<?php echo $project_details_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$project_details->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($project_details_list->Recordset)
	$project_details_list->Recordset->Close();
?>
<?php if (!$project_details->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$project_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($project_details_list->Pager)) $project_details_list->Pager = new NumericPager($project_details_list->StartRec, $project_details_list->DisplayRecs, $project_details_list->TotalRecs, $project_details_list->RecRange, $project_details_list->AutoHidePager) ?>
<?php if ($project_details_list->Pager->RecordCount > 0 && $project_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($project_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $project_details_list->pageUrl() ?>start=<?php echo $project_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($project_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $project_details_list->pageUrl() ?>start=<?php echo $project_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($project_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $project_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($project_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $project_details_list->pageUrl() ?>start=<?php echo $project_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($project_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $project_details_list->pageUrl() ?>start=<?php echo $project_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($project_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $project_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $project_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $project_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $project_details_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($project_details_list->TotalRecs == 0 && !$project_details->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $project_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$project_details_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$project_details->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$project_details_list->terminate();
?>