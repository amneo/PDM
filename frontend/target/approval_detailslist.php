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
$approval_details_list = new approval_details_list();

// Run the page
$approval_details_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$approval_details_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$approval_details->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fapproval_detailslist = currentForm = new ew.Form("fapproval_detailslist", "list");
fapproval_detailslist.formKeyCountName = '<?php echo $approval_details_list->FormKeyCountName ?>';

// Form_CustomValidate event
fapproval_detailslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fapproval_detailslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$approval_details->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($approval_details_list->TotalRecs > 0 && $approval_details_list->ExportOptions->visible()) { ?>
<?php $approval_details_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($approval_details_list->ImportOptions->visible()) { ?>
<?php $approval_details_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$approval_details_list->renderOtherOptions();
?>
<?php $approval_details_list->showPageHeader(); ?>
<?php
$approval_details_list->showMessage();
?>
<?php if ($approval_details_list->TotalRecs > 0 || $approval_details->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($approval_details_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> approval_details">
<?php if (!$approval_details->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$approval_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($approval_details_list->Pager)) $approval_details_list->Pager = new NumericPager($approval_details_list->StartRec, $approval_details_list->DisplayRecs, $approval_details_list->TotalRecs, $approval_details_list->RecRange, $approval_details_list->AutoHidePager) ?>
<?php if ($approval_details_list->Pager->RecordCount > 0 && $approval_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($approval_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $approval_details_list->pageUrl() ?>start=<?php echo $approval_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($approval_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $approval_details_list->pageUrl() ?>start=<?php echo $approval_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($approval_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $approval_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($approval_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $approval_details_list->pageUrl() ?>start=<?php echo $approval_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($approval_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $approval_details_list->pageUrl() ?>start=<?php echo $approval_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($approval_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $approval_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $approval_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $approval_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $approval_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fapproval_detailslist" id="fapproval_detailslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($approval_details_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $approval_details_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="approval_details">
<div id="gmp_approval_details" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($approval_details_list->TotalRecs > 0 || $approval_details->isGridEdit()) { ?>
<table id="tbl_approval_detailslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$approval_details_list->RowType = ROWTYPE_HEADER;

// Render list options
$approval_details_list->renderListOptions();

// Render list options (header, left)
$approval_details_list->ListOptions->render("header", "left");
?>
<?php if ($approval_details->short_code->Visible) { // short_code ?>
	<?php if ($approval_details->sortUrl($approval_details->short_code) == "") { ?>
		<th data-name="short_code" class="<?php echo $approval_details->short_code->headerCellClass() ?>"><div id="elh_approval_details_short_code" class="approval_details_short_code"><div class="ew-table-header-caption"><?php echo $approval_details->short_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="short_code" class="<?php echo $approval_details->short_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $approval_details->SortUrl($approval_details->short_code) ?>',2);"><div id="elh_approval_details_short_code" class="approval_details_short_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $approval_details->short_code->caption() ?></span><span class="ew-table-header-sort"><?php if ($approval_details->short_code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($approval_details->short_code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($approval_details->Description->Visible) { // Description ?>
	<?php if ($approval_details->sortUrl($approval_details->Description) == "") { ?>
		<th data-name="Description" class="<?php echo $approval_details->Description->headerCellClass() ?>"><div id="elh_approval_details_Description" class="approval_details_Description"><div class="ew-table-header-caption"><?php echo $approval_details->Description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Description" class="<?php echo $approval_details->Description->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $approval_details->SortUrl($approval_details->Description) ?>',2);"><div id="elh_approval_details_Description" class="approval_details_Description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $approval_details->Description->caption() ?></span><span class="ew-table-header-sort"><?php if ($approval_details->Description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($approval_details->Description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($approval_details->out_status->Visible) { // out_status ?>
	<?php if ($approval_details->sortUrl($approval_details->out_status) == "") { ?>
		<th data-name="out_status" class="<?php echo $approval_details->out_status->headerCellClass() ?>"><div id="elh_approval_details_out_status" class="approval_details_out_status"><div class="ew-table-header-caption"><?php echo $approval_details->out_status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="out_status" class="<?php echo $approval_details->out_status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $approval_details->SortUrl($approval_details->out_status) ?>',2);"><div id="elh_approval_details_out_status" class="approval_details_out_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $approval_details->out_status->caption() ?></span><span class="ew-table-header-sort"><?php if ($approval_details->out_status->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($approval_details->out_status->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($approval_details->in_status->Visible) { // in_status ?>
	<?php if ($approval_details->sortUrl($approval_details->in_status) == "") { ?>
		<th data-name="in_status" class="<?php echo $approval_details->in_status->headerCellClass() ?>"><div id="elh_approval_details_in_status" class="approval_details_in_status"><div class="ew-table-header-caption"><?php echo $approval_details->in_status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="in_status" class="<?php echo $approval_details->in_status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $approval_details->SortUrl($approval_details->in_status) ?>',2);"><div id="elh_approval_details_in_status" class="approval_details_in_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $approval_details->in_status->caption() ?></span><span class="ew-table-header-sort"><?php if ($approval_details->in_status->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($approval_details->in_status->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$approval_details_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($approval_details->ExportAll && $approval_details->isExport()) {
	$approval_details_list->StopRec = $approval_details_list->TotalRecs;
} else {

	// Set the last record to display
	if ($approval_details_list->TotalRecs > $approval_details_list->StartRec + $approval_details_list->DisplayRecs - 1)
		$approval_details_list->StopRec = $approval_details_list->StartRec + $approval_details_list->DisplayRecs - 1;
	else
		$approval_details_list->StopRec = $approval_details_list->TotalRecs;
}
$approval_details_list->RecCnt = $approval_details_list->StartRec - 1;
if ($approval_details_list->Recordset && !$approval_details_list->Recordset->EOF) {
	$approval_details_list->Recordset->moveFirst();
	$selectLimit = $approval_details_list->UseSelectLimit;
	if (!$selectLimit && $approval_details_list->StartRec > 1)
		$approval_details_list->Recordset->move($approval_details_list->StartRec - 1);
} elseif (!$approval_details->AllowAddDeleteRow && $approval_details_list->StopRec == 0) {
	$approval_details_list->StopRec = $approval_details->GridAddRowCount;
}

// Initialize aggregate
$approval_details->RowType = ROWTYPE_AGGREGATEINIT;
$approval_details->resetAttributes();
$approval_details_list->renderRow();
while ($approval_details_list->RecCnt < $approval_details_list->StopRec) {
	$approval_details_list->RecCnt++;
	if ($approval_details_list->RecCnt >= $approval_details_list->StartRec) {
		$approval_details_list->RowCnt++;

		// Set up key count
		$approval_details_list->KeyCount = $approval_details_list->RowIndex;

		// Init row class and style
		$approval_details->resetAttributes();
		$approval_details->CssClass = "";
		if ($approval_details->isGridAdd()) {
		} else {
			$approval_details_list->loadRowValues($approval_details_list->Recordset); // Load row values
		}
		$approval_details->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$approval_details->RowAttrs = array_merge($approval_details->RowAttrs, array('data-rowindex'=>$approval_details_list->RowCnt, 'id'=>'r' . $approval_details_list->RowCnt . '_approval_details', 'data-rowtype'=>$approval_details->RowType));

		// Render row
		$approval_details_list->renderRow();

		// Render list options
		$approval_details_list->renderListOptions();
?>
	<tr<?php echo $approval_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$approval_details_list->ListOptions->render("body", "left", $approval_details_list->RowCnt);
?>
	<?php if ($approval_details->short_code->Visible) { // short_code ?>
		<td data-name="short_code"<?php echo $approval_details->short_code->cellAttributes() ?>>
<span id="el<?php echo $approval_details_list->RowCnt ?>_approval_details_short_code" class="approval_details_short_code">
<span<?php echo $approval_details->short_code->viewAttributes() ?>>
<?php echo $approval_details->short_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($approval_details->Description->Visible) { // Description ?>
		<td data-name="Description"<?php echo $approval_details->Description->cellAttributes() ?>>
<span id="el<?php echo $approval_details_list->RowCnt ?>_approval_details_Description" class="approval_details_Description">
<span<?php echo $approval_details->Description->viewAttributes() ?>>
<?php echo $approval_details->Description->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($approval_details->out_status->Visible) { // out_status ?>
		<td data-name="out_status"<?php echo $approval_details->out_status->cellAttributes() ?>>
<span id="el<?php echo $approval_details_list->RowCnt ?>_approval_details_out_status" class="approval_details_out_status">
<span<?php echo $approval_details->out_status->viewAttributes() ?>>
<?php echo $approval_details->out_status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($approval_details->in_status->Visible) { // in_status ?>
		<td data-name="in_status"<?php echo $approval_details->in_status->cellAttributes() ?>>
<span id="el<?php echo $approval_details_list->RowCnt ?>_approval_details_in_status" class="approval_details_in_status">
<span<?php echo $approval_details->in_status->viewAttributes() ?>>
<?php echo $approval_details->in_status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$approval_details_list->ListOptions->render("body", "right", $approval_details_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$approval_details->isGridAdd())
		$approval_details_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$approval_details->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($approval_details_list->Recordset)
	$approval_details_list->Recordset->Close();
?>
<?php if (!$approval_details->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$approval_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($approval_details_list->Pager)) $approval_details_list->Pager = new NumericPager($approval_details_list->StartRec, $approval_details_list->DisplayRecs, $approval_details_list->TotalRecs, $approval_details_list->RecRange, $approval_details_list->AutoHidePager) ?>
<?php if ($approval_details_list->Pager->RecordCount > 0 && $approval_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($approval_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $approval_details_list->pageUrl() ?>start=<?php echo $approval_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($approval_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $approval_details_list->pageUrl() ?>start=<?php echo $approval_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($approval_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $approval_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($approval_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $approval_details_list->pageUrl() ?>start=<?php echo $approval_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($approval_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $approval_details_list->pageUrl() ?>start=<?php echo $approval_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($approval_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $approval_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $approval_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $approval_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $approval_details_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($approval_details_list->TotalRecs == 0 && !$approval_details->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $approval_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$approval_details_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$approval_details->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$approval_details_list->terminate();
?>