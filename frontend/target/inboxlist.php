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
$inbox_list = new inbox_list();

// Run the page
$inbox_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inbox_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$inbox->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var finboxlist = currentForm = new ew.Form("finboxlist", "list");
finboxlist.formKeyCountName = '<?php echo $inbox_list->FormKeyCountName ?>';

// Form_CustomValidate event
finboxlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finboxlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var finboxlistsrch = currentSearchForm = new ew.Form("finboxlistsrch");

// Filters
finboxlistsrch.filterList = <?php echo $inbox_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$inbox->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($inbox_list->TotalRecs > 0 && $inbox_list->ExportOptions->visible()) { ?>
<?php $inbox_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($inbox_list->ImportOptions->visible()) { ?>
<?php $inbox_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($inbox_list->SearchOptions->visible()) { ?>
<?php $inbox_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($inbox_list->FilterOptions->visible()) { ?>
<?php $inbox_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$inbox_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$inbox->isExport() && !$inbox->CurrentAction) { ?>
<form name="finboxlistsrch" id="finboxlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($inbox_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="finboxlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="inbox">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($inbox_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($inbox_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $inbox_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($inbox_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($inbox_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($inbox_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($inbox_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $inbox_list->showPageHeader(); ?>
<?php
$inbox_list->showMessage();
?>
<?php if ($inbox_list->TotalRecs > 0 || $inbox->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($inbox_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> inbox">
<?php if (!$inbox->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$inbox->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($inbox_list->Pager)) $inbox_list->Pager = new NumericPager($inbox_list->StartRec, $inbox_list->DisplayRecs, $inbox_list->TotalRecs, $inbox_list->RecRange, $inbox_list->AutoHidePager) ?>
<?php if ($inbox_list->Pager->RecordCount > 0 && $inbox_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($inbox_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $inbox_list->pageUrl() ?>start=<?php echo $inbox_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($inbox_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $inbox_list->pageUrl() ?>start=<?php echo $inbox_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($inbox_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $inbox_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($inbox_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $inbox_list->pageUrl() ?>start=<?php echo $inbox_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($inbox_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $inbox_list->pageUrl() ?>start=<?php echo $inbox_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($inbox_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $inbox_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $inbox_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $inbox_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $inbox_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="finboxlist" id="finboxlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inbox_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inbox_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inbox">
<div id="gmp_inbox" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($inbox_list->TotalRecs > 0 || $inbox->isGridEdit()) { ?>
<table id="tbl_inboxlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$inbox_list->RowType = ROWTYPE_HEADER;

// Render list options
$inbox_list->renderListOptions();

// Render list options (header, left)
$inbox_list->ListOptions->render("header", "left");
?>
<?php if ($inbox->from->Visible) { // from ?>
	<?php if ($inbox->sortUrl($inbox->from) == "") { ?>
		<th data-name="from" class="<?php echo $inbox->from->headerCellClass() ?>"><div id="elh_inbox_from" class="inbox_from"><div class="ew-table-header-caption"><?php echo $inbox->from->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="from" class="<?php echo $inbox->from->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inbox->SortUrl($inbox->from) ?>',2);"><div id="elh_inbox_from" class="inbox_from">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inbox->from->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inbox->from->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inbox->from->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inbox->project_name->Visible) { // project_name ?>
	<?php if ($inbox->sortUrl($inbox->project_name) == "") { ?>
		<th data-name="project_name" class="<?php echo $inbox->project_name->headerCellClass() ?>"><div id="elh_inbox_project_name" class="inbox_project_name"><div class="ew-table-header-caption"><?php echo $inbox->project_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="project_name" class="<?php echo $inbox->project_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inbox->SortUrl($inbox->project_name) ?>',2);"><div id="elh_inbox_project_name" class="inbox_project_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inbox->project_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inbox->project_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inbox->project_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inbox->client_send_to->Visible) { // client_send_to ?>
	<?php if ($inbox->sortUrl($inbox->client_send_to) == "") { ?>
		<th data-name="client_send_to" class="<?php echo $inbox->client_send_to->headerCellClass() ?>"><div id="elh_inbox_client_send_to" class="inbox_client_send_to"><div class="ew-table-header-caption"><?php echo $inbox->client_send_to->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="client_send_to" class="<?php echo $inbox->client_send_to->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inbox->SortUrl($inbox->client_send_to) ?>',2);"><div id="elh_inbox_client_send_to" class="inbox_client_send_to">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inbox->client_send_to->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inbox->client_send_to->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inbox->client_send_to->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inbox->mode_send->Visible) { // mode_send ?>
	<?php if ($inbox->sortUrl($inbox->mode_send) == "") { ?>
		<th data-name="mode_send" class="<?php echo $inbox->mode_send->headerCellClass() ?>"><div id="elh_inbox_mode_send" class="inbox_mode_send"><div class="ew-table-header-caption"><?php echo $inbox->mode_send->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mode_send" class="<?php echo $inbox->mode_send->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inbox->SortUrl($inbox->mode_send) ?>',2);"><div id="elh_inbox_mode_send" class="inbox_mode_send">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inbox->mode_send->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inbox->mode_send->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inbox->mode_send->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inbox->remarks->Visible) { // remarks ?>
	<?php if ($inbox->sortUrl($inbox->remarks) == "") { ?>
		<th data-name="remarks" class="<?php echo $inbox->remarks->headerCellClass() ?>"><div id="elh_inbox_remarks" class="inbox_remarks"><div class="ew-table-header-caption"><?php echo $inbox->remarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="remarks" class="<?php echo $inbox->remarks->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inbox->SortUrl($inbox->remarks) ?>',2);"><div id="elh_inbox_remarks" class="inbox_remarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inbox->remarks->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inbox->remarks->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inbox->remarks->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inbox->document_link->Visible) { // document_link ?>
	<?php if ($inbox->sortUrl($inbox->document_link) == "") { ?>
		<th data-name="document_link" class="<?php echo $inbox->document_link->headerCellClass() ?>"><div id="elh_inbox_document_link" class="inbox_document_link"><div class="ew-table-header-caption"><?php echo $inbox->document_link->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="document_link" class="<?php echo $inbox->document_link->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inbox->SortUrl($inbox->document_link) ?>',2);"><div id="elh_inbox_document_link" class="inbox_document_link">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inbox->document_link->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inbox->document_link->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inbox->document_link->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inbox->native_file_link->Visible) { // native_file_link ?>
	<?php if ($inbox->sortUrl($inbox->native_file_link) == "") { ?>
		<th data-name="native_file_link" class="<?php echo $inbox->native_file_link->headerCellClass() ?>"><div id="elh_inbox_native_file_link" class="inbox_native_file_link"><div class="ew-table-header-caption"><?php echo $inbox->native_file_link->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="native_file_link" class="<?php echo $inbox->native_file_link->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inbox->SortUrl($inbox->native_file_link) ?>',2);"><div id="elh_inbox_native_file_link" class="inbox_native_file_link">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inbox->native_file_link->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inbox->native_file_link->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inbox->native_file_link->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$inbox_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($inbox->ExportAll && $inbox->isExport()) {
	$inbox_list->StopRec = $inbox_list->TotalRecs;
} else {

	// Set the last record to display
	if ($inbox_list->TotalRecs > $inbox_list->StartRec + $inbox_list->DisplayRecs - 1)
		$inbox_list->StopRec = $inbox_list->StartRec + $inbox_list->DisplayRecs - 1;
	else
		$inbox_list->StopRec = $inbox_list->TotalRecs;
}
$inbox_list->RecCnt = $inbox_list->StartRec - 1;
if ($inbox_list->Recordset && !$inbox_list->Recordset->EOF) {
	$inbox_list->Recordset->moveFirst();
	$selectLimit = $inbox_list->UseSelectLimit;
	if (!$selectLimit && $inbox_list->StartRec > 1)
		$inbox_list->Recordset->move($inbox_list->StartRec - 1);
} elseif (!$inbox->AllowAddDeleteRow && $inbox_list->StopRec == 0) {
	$inbox_list->StopRec = $inbox->GridAddRowCount;
}

// Initialize aggregate
$inbox->RowType = ROWTYPE_AGGREGATEINIT;
$inbox->resetAttributes();
$inbox_list->renderRow();
while ($inbox_list->RecCnt < $inbox_list->StopRec) {
	$inbox_list->RecCnt++;
	if ($inbox_list->RecCnt >= $inbox_list->StartRec) {
		$inbox_list->RowCnt++;

		// Set up key count
		$inbox_list->KeyCount = $inbox_list->RowIndex;

		// Init row class and style
		$inbox->resetAttributes();
		$inbox->CssClass = "";
		if ($inbox->isGridAdd()) {
		} else {
			$inbox_list->loadRowValues($inbox_list->Recordset); // Load row values
		}
		$inbox->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$inbox->RowAttrs = array_merge($inbox->RowAttrs, array('data-rowindex'=>$inbox_list->RowCnt, 'id'=>'r' . $inbox_list->RowCnt . '_inbox', 'data-rowtype'=>$inbox->RowType));

		// Render row
		$inbox_list->renderRow();

		// Render list options
		$inbox_list->renderListOptions();
?>
	<tr<?php echo $inbox->rowAttributes() ?>>
<?php

// Render list options (body, left)
$inbox_list->ListOptions->render("body", "left", $inbox_list->RowCnt);
?>
	<?php if ($inbox->from->Visible) { // from ?>
		<td data-name="from"<?php echo $inbox->from->cellAttributes() ?>>
<span id="el<?php echo $inbox_list->RowCnt ?>_inbox_from" class="inbox_from">
<span<?php echo $inbox->from->viewAttributes() ?>>
<?php echo $inbox->from->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inbox->project_name->Visible) { // project_name ?>
		<td data-name="project_name"<?php echo $inbox->project_name->cellAttributes() ?>>
<span id="el<?php echo $inbox_list->RowCnt ?>_inbox_project_name" class="inbox_project_name">
<span<?php echo $inbox->project_name->viewAttributes() ?>>
<?php echo $inbox->project_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inbox->client_send_to->Visible) { // client_send_to ?>
		<td data-name="client_send_to"<?php echo $inbox->client_send_to->cellAttributes() ?>>
<span id="el<?php echo $inbox_list->RowCnt ?>_inbox_client_send_to" class="inbox_client_send_to">
<span<?php echo $inbox->client_send_to->viewAttributes() ?>>
<?php echo $inbox->client_send_to->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inbox->mode_send->Visible) { // mode_send ?>
		<td data-name="mode_send"<?php echo $inbox->mode_send->cellAttributes() ?>>
<span id="el<?php echo $inbox_list->RowCnt ?>_inbox_mode_send" class="inbox_mode_send">
<span<?php echo $inbox->mode_send->viewAttributes() ?>>
<?php echo $inbox->mode_send->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inbox->remarks->Visible) { // remarks ?>
		<td data-name="remarks"<?php echo $inbox->remarks->cellAttributes() ?>>
<span id="el<?php echo $inbox_list->RowCnt ?>_inbox_remarks" class="inbox_remarks">
<span<?php echo $inbox->remarks->viewAttributes() ?>>
<?php echo $inbox->remarks->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inbox->document_link->Visible) { // document_link ?>
		<td data-name="document_link"<?php echo $inbox->document_link->cellAttributes() ?>>
<span id="el<?php echo $inbox_list->RowCnt ?>_inbox_document_link" class="inbox_document_link">
<span<?php echo $inbox->document_link->viewAttributes() ?>>
<?php echo GetFileViewTag($inbox->document_link, $inbox->document_link->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($inbox->native_file_link->Visible) { // native_file_link ?>
		<td data-name="native_file_link"<?php echo $inbox->native_file_link->cellAttributes() ?>>
<span id="el<?php echo $inbox_list->RowCnt ?>_inbox_native_file_link" class="inbox_native_file_link">
<span<?php echo $inbox->native_file_link->viewAttributes() ?>>
<?php echo $inbox->native_file_link->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$inbox_list->ListOptions->render("body", "right", $inbox_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$inbox->isGridAdd())
		$inbox_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$inbox->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($inbox_list->Recordset)
	$inbox_list->Recordset->Close();
?>
<?php if (!$inbox->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$inbox->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($inbox_list->Pager)) $inbox_list->Pager = new NumericPager($inbox_list->StartRec, $inbox_list->DisplayRecs, $inbox_list->TotalRecs, $inbox_list->RecRange, $inbox_list->AutoHidePager) ?>
<?php if ($inbox_list->Pager->RecordCount > 0 && $inbox_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($inbox_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $inbox_list->pageUrl() ?>start=<?php echo $inbox_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($inbox_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $inbox_list->pageUrl() ?>start=<?php echo $inbox_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($inbox_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $inbox_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($inbox_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $inbox_list->pageUrl() ?>start=<?php echo $inbox_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($inbox_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $inbox_list->pageUrl() ?>start=<?php echo $inbox_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($inbox_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $inbox_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $inbox_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $inbox_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $inbox_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($inbox_list->TotalRecs == 0 && !$inbox->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $inbox_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$inbox_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$inbox->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$inbox_list->terminate();
?>