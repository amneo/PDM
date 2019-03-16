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
$app_version_list = new app_version_list();

// Run the page
$app_version_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_version_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$app_version->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fapp_versionlist = currentForm = new ew.Form("fapp_versionlist", "list");
fapp_versionlist.formKeyCountName = '<?php echo $app_version_list->FormKeyCountName ?>';

// Form_CustomValidate event
fapp_versionlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fapp_versionlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$app_version->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($app_version_list->TotalRecs > 0 && $app_version_list->ExportOptions->visible()) { ?>
<?php $app_version_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($app_version_list->ImportOptions->visible()) { ?>
<?php $app_version_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$app_version_list->renderOtherOptions();
?>
<?php $app_version_list->showPageHeader(); ?>
<?php
$app_version_list->showMessage();
?>
<?php if ($app_version_list->TotalRecs > 0 || $app_version->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($app_version_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> app_version">
<?php if (!$app_version->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$app_version->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($app_version_list->Pager)) $app_version_list->Pager = new NumericPager($app_version_list->StartRec, $app_version_list->DisplayRecs, $app_version_list->TotalRecs, $app_version_list->RecRange, $app_version_list->AutoHidePager) ?>
<?php if ($app_version_list->Pager->RecordCount > 0 && $app_version_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($app_version_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_list->pageUrl() ?>start=<?php echo $app_version_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($app_version_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_list->pageUrl() ?>start=<?php echo $app_version_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($app_version_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $app_version_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($app_version_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_list->pageUrl() ?>start=<?php echo $app_version_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($app_version_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_list->pageUrl() ?>start=<?php echo $app_version_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($app_version_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $app_version_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $app_version_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $app_version_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($app_version_list->TotalRecs > 0 && (!$app_version_list->AutoHidePageSizeSelector || $app_version_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="app_version">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="50"<?php if ($app_version_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($app_version_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="150"<?php if ($app_version_list->DisplayRecs == 150) { ?> selected<?php } ?>>150</option>
<option value="ALL"<?php if ($app_version->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $app_version_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fapp_versionlist" id="fapp_versionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($app_version_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $app_version_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_version">
<div id="gmp_app_version" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($app_version_list->TotalRecs > 0 || $app_version->isGridEdit()) { ?>
<table id="tbl_app_versionlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$app_version_list->RowType = ROWTYPE_HEADER;

// Render list options
$app_version_list->renderListOptions();

// Render list options (header, left)
$app_version_list->ListOptions->render("header", "left");
?>
<?php if ($app_version->sequence_no->Visible) { // sequence_no ?>
	<?php if ($app_version->sortUrl($app_version->sequence_no) == "") { ?>
		<th data-name="sequence_no" class="<?php echo $app_version->sequence_no->headerCellClass() ?>"><div id="elh_app_version_sequence_no" class="app_version_sequence_no"><div class="ew-table-header-caption"><?php echo $app_version->sequence_no->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sequence_no" class="<?php echo $app_version->sequence_no->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $app_version->SortUrl($app_version->sequence_no) ?>',2);"><div id="elh_app_version_sequence_no" class="app_version_sequence_no">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $app_version->sequence_no->caption() ?></span><span class="ew-table-header-sort"><?php if ($app_version->sequence_no->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($app_version->sequence_no->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_version->release_date->Visible) { // release_date ?>
	<?php if ($app_version->sortUrl($app_version->release_date) == "") { ?>
		<th data-name="release_date" class="<?php echo $app_version->release_date->headerCellClass() ?>"><div id="elh_app_version_release_date" class="app_version_release_date"><div class="ew-table-header-caption"><?php echo $app_version->release_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="release_date" class="<?php echo $app_version->release_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $app_version->SortUrl($app_version->release_date) ?>',2);"><div id="elh_app_version_release_date" class="app_version_release_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $app_version->release_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($app_version->release_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($app_version->release_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($app_version->posted_date->Visible) { // posted_date ?>
	<?php if ($app_version->sortUrl($app_version->posted_date) == "") { ?>
		<th data-name="posted_date" class="<?php echo $app_version->posted_date->headerCellClass() ?>"><div id="elh_app_version_posted_date" class="app_version_posted_date"><div class="ew-table-header-caption"><?php echo $app_version->posted_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="posted_date" class="<?php echo $app_version->posted_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $app_version->SortUrl($app_version->posted_date) ?>',2);"><div id="elh_app_version_posted_date" class="app_version_posted_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $app_version->posted_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($app_version->posted_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($app_version->posted_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$app_version_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($app_version->ExportAll && $app_version->isExport()) {
	$app_version_list->StopRec = $app_version_list->TotalRecs;
} else {

	// Set the last record to display
	if ($app_version_list->TotalRecs > $app_version_list->StartRec + $app_version_list->DisplayRecs - 1)
		$app_version_list->StopRec = $app_version_list->StartRec + $app_version_list->DisplayRecs - 1;
	else
		$app_version_list->StopRec = $app_version_list->TotalRecs;
}
$app_version_list->RecCnt = $app_version_list->StartRec - 1;
if ($app_version_list->Recordset && !$app_version_list->Recordset->EOF) {
	$app_version_list->Recordset->moveFirst();
	$selectLimit = $app_version_list->UseSelectLimit;
	if (!$selectLimit && $app_version_list->StartRec > 1)
		$app_version_list->Recordset->move($app_version_list->StartRec - 1);
} elseif (!$app_version->AllowAddDeleteRow && $app_version_list->StopRec == 0) {
	$app_version_list->StopRec = $app_version->GridAddRowCount;
}

// Initialize aggregate
$app_version->RowType = ROWTYPE_AGGREGATEINIT;
$app_version->resetAttributes();
$app_version_list->renderRow();
while ($app_version_list->RecCnt < $app_version_list->StopRec) {
	$app_version_list->RecCnt++;
	if ($app_version_list->RecCnt >= $app_version_list->StartRec) {
		$app_version_list->RowCnt++;

		// Set up key count
		$app_version_list->KeyCount = $app_version_list->RowIndex;

		// Init row class and style
		$app_version->resetAttributes();
		$app_version->CssClass = "";
		if ($app_version->isGridAdd()) {
		} else {
			$app_version_list->loadRowValues($app_version_list->Recordset); // Load row values
		}
		$app_version->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$app_version->RowAttrs = array_merge($app_version->RowAttrs, array('data-rowindex'=>$app_version_list->RowCnt, 'id'=>'r' . $app_version_list->RowCnt . '_app_version', 'data-rowtype'=>$app_version->RowType));

		// Render row
		$app_version_list->renderRow();

		// Render list options
		$app_version_list->renderListOptions();
?>
	<tr<?php echo $app_version->rowAttributes() ?>>
<?php

// Render list options (body, left)
$app_version_list->ListOptions->render("body", "left", $app_version_list->RowCnt);
?>
	<?php if ($app_version->sequence_no->Visible) { // sequence_no ?>
		<td data-name="sequence_no"<?php echo $app_version->sequence_no->cellAttributes() ?>>
<span id="el<?php echo $app_version_list->RowCnt ?>_app_version_sequence_no" class="app_version_sequence_no">
<span<?php echo $app_version->sequence_no->viewAttributes() ?>>
<?php echo $app_version->sequence_no->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($app_version->release_date->Visible) { // release_date ?>
		<td data-name="release_date"<?php echo $app_version->release_date->cellAttributes() ?>>
<span id="el<?php echo $app_version_list->RowCnt ?>_app_version_release_date" class="app_version_release_date">
<span<?php echo $app_version->release_date->viewAttributes() ?>>
<?php echo $app_version->release_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($app_version->posted_date->Visible) { // posted_date ?>
		<td data-name="posted_date"<?php echo $app_version->posted_date->cellAttributes() ?>>
<span id="el<?php echo $app_version_list->RowCnt ?>_app_version_posted_date" class="app_version_posted_date">
<span<?php echo $app_version->posted_date->viewAttributes() ?>>
<?php echo $app_version->posted_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$app_version_list->ListOptions->render("body", "right", $app_version_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$app_version->isGridAdd())
		$app_version_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$app_version->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($app_version_list->Recordset)
	$app_version_list->Recordset->Close();
?>
<?php if (!$app_version->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$app_version->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($app_version_list->Pager)) $app_version_list->Pager = new NumericPager($app_version_list->StartRec, $app_version_list->DisplayRecs, $app_version_list->TotalRecs, $app_version_list->RecRange, $app_version_list->AutoHidePager) ?>
<?php if ($app_version_list->Pager->RecordCount > 0 && $app_version_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($app_version_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_list->pageUrl() ?>start=<?php echo $app_version_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($app_version_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_list->pageUrl() ?>start=<?php echo $app_version_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($app_version_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $app_version_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($app_version_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_list->pageUrl() ?>start=<?php echo $app_version_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($app_version_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $app_version_list->pageUrl() ?>start=<?php echo $app_version_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($app_version_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $app_version_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $app_version_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $app_version_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($app_version_list->TotalRecs > 0 && (!$app_version_list->AutoHidePageSizeSelector || $app_version_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="app_version">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="50"<?php if ($app_version_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($app_version_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="150"<?php if ($app_version_list->DisplayRecs == 150) { ?> selected<?php } ?>>150</option>
<option value="ALL"<?php if ($app_version->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $app_version_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($app_version_list->TotalRecs == 0 && !$app_version->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $app_version_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$app_version_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$app_version->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$app_version_list->terminate();
?>