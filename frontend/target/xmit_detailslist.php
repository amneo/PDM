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
$xmit_details_list = new xmit_details_list();

// Run the page
$xmit_details_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$xmit_details_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$xmit_details->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fxmit_detailslist = currentForm = new ew.Form("fxmit_detailslist", "list");
fxmit_detailslist.formKeyCountName = '<?php echo $xmit_details_list->FormKeyCountName ?>';

// Validate form
fxmit_detailslist.validate = function() {
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
		<?php if ($xmit_details_list->xmit_mode->Required) { ?>
			elm = this.getElements("x" + infix + "_xmit_mode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $xmit_details->xmit_mode->caption(), $xmit_details->xmit_mode->RequiredErrorMessage)) ?>");
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
fxmit_detailslist.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "xmit_mode", false)) return false;
	return true;
}

// Form_CustomValidate event
fxmit_detailslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fxmit_detailslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$xmit_details->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($xmit_details_list->TotalRecs > 0 && $xmit_details_list->ExportOptions->visible()) { ?>
<?php $xmit_details_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($xmit_details_list->ImportOptions->visible()) { ?>
<?php $xmit_details_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$xmit_details_list->renderOtherOptions();
?>
<?php $xmit_details_list->showPageHeader(); ?>
<?php
$xmit_details_list->showMessage();
?>
<?php if ($xmit_details_list->TotalRecs > 0 || $xmit_details->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($xmit_details_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> xmit_details">
<?php if (!$xmit_details->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$xmit_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($xmit_details_list->Pager)) $xmit_details_list->Pager = new NumericPager($xmit_details_list->StartRec, $xmit_details_list->DisplayRecs, $xmit_details_list->TotalRecs, $xmit_details_list->RecRange, $xmit_details_list->AutoHidePager) ?>
<?php if ($xmit_details_list->Pager->RecordCount > 0 && $xmit_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($xmit_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($xmit_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($xmit_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $xmit_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($xmit_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($xmit_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($xmit_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $xmit_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $xmit_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $xmit_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $xmit_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fxmit_detailslist" id="fxmit_detailslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($xmit_details_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $xmit_details_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="xmit_details">
<div id="gmp_xmit_details" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($xmit_details_list->TotalRecs > 0 || $xmit_details->isGridEdit()) { ?>
<table id="tbl_xmit_detailslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$xmit_details_list->RowType = ROWTYPE_HEADER;

// Render list options
$xmit_details_list->renderListOptions();

// Render list options (header, left)
$xmit_details_list->ListOptions->render("header", "left");
?>
<?php if ($xmit_details->xmit_mode->Visible) { // xmit_mode ?>
	<?php if ($xmit_details->sortUrl($xmit_details->xmit_mode) == "") { ?>
		<th data-name="xmit_mode" class="<?php echo $xmit_details->xmit_mode->headerCellClass() ?>"><div id="elh_xmit_details_xmit_mode" class="xmit_details_xmit_mode"><div class="ew-table-header-caption"><?php echo $xmit_details->xmit_mode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="xmit_mode" class="<?php echo $xmit_details->xmit_mode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $xmit_details->SortUrl($xmit_details->xmit_mode) ?>',2);"><div id="elh_xmit_details_xmit_mode" class="xmit_details_xmit_mode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $xmit_details->xmit_mode->caption() ?></span><span class="ew-table-header-sort"><?php if ($xmit_details->xmit_mode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($xmit_details->xmit_mode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$xmit_details_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($xmit_details->ExportAll && $xmit_details->isExport()) {
	$xmit_details_list->StopRec = $xmit_details_list->TotalRecs;
} else {

	// Set the last record to display
	if ($xmit_details_list->TotalRecs > $xmit_details_list->StartRec + $xmit_details_list->DisplayRecs - 1)
		$xmit_details_list->StopRec = $xmit_details_list->StartRec + $xmit_details_list->DisplayRecs - 1;
	else
		$xmit_details_list->StopRec = $xmit_details_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $xmit_details_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($xmit_details_list->FormKeyCountName) && ($xmit_details->isGridAdd() || $xmit_details->isGridEdit() || $xmit_details->isConfirm())) {
		$xmit_details_list->KeyCount = $CurrentForm->getValue($xmit_details_list->FormKeyCountName);
		$xmit_details_list->StopRec = $xmit_details_list->StartRec + $xmit_details_list->KeyCount - 1;
	}
}
$xmit_details_list->RecCnt = $xmit_details_list->StartRec - 1;
if ($xmit_details_list->Recordset && !$xmit_details_list->Recordset->EOF) {
	$xmit_details_list->Recordset->moveFirst();
	$selectLimit = $xmit_details_list->UseSelectLimit;
	if (!$selectLimit && $xmit_details_list->StartRec > 1)
		$xmit_details_list->Recordset->move($xmit_details_list->StartRec - 1);
} elseif (!$xmit_details->AllowAddDeleteRow && $xmit_details_list->StopRec == 0) {
	$xmit_details_list->StopRec = $xmit_details->GridAddRowCount;
}

// Initialize aggregate
$xmit_details->RowType = ROWTYPE_AGGREGATEINIT;
$xmit_details->resetAttributes();
$xmit_details_list->renderRow();
if ($xmit_details->isGridAdd())
	$xmit_details_list->RowIndex = 0;
if ($xmit_details->isGridEdit())
	$xmit_details_list->RowIndex = 0;
while ($xmit_details_list->RecCnt < $xmit_details_list->StopRec) {
	$xmit_details_list->RecCnt++;
	if ($xmit_details_list->RecCnt >= $xmit_details_list->StartRec) {
		$xmit_details_list->RowCnt++;
		if ($xmit_details->isGridAdd() || $xmit_details->isGridEdit() || $xmit_details->isConfirm()) {
			$xmit_details_list->RowIndex++;
			$CurrentForm->Index = $xmit_details_list->RowIndex;
			if ($CurrentForm->hasValue($xmit_details_list->FormActionName) && $xmit_details_list->EventCancelled)
				$xmit_details_list->RowAction = strval($CurrentForm->getValue($xmit_details_list->FormActionName));
			elseif ($xmit_details->isGridAdd())
				$xmit_details_list->RowAction = "insert";
			else
				$xmit_details_list->RowAction = "";
		}

		// Set up key count
		$xmit_details_list->KeyCount = $xmit_details_list->RowIndex;

		// Init row class and style
		$xmit_details->resetAttributes();
		$xmit_details->CssClass = "";
		if ($xmit_details->isGridAdd()) {
			$xmit_details_list->loadRowValues(); // Load default values
		} else {
			$xmit_details_list->loadRowValues($xmit_details_list->Recordset); // Load row values
		}
		$xmit_details->RowType = ROWTYPE_VIEW; // Render view
		if ($xmit_details->isGridAdd()) // Grid add
			$xmit_details->RowType = ROWTYPE_ADD; // Render add
		if ($xmit_details->isGridAdd() && $xmit_details->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$xmit_details_list->restoreCurrentRowFormValues($xmit_details_list->RowIndex); // Restore form values
		if ($xmit_details->isGridEdit()) { // Grid edit
			if ($xmit_details->EventCancelled)
				$xmit_details_list->restoreCurrentRowFormValues($xmit_details_list->RowIndex); // Restore form values
			if ($xmit_details_list->RowAction == "insert")
				$xmit_details->RowType = ROWTYPE_ADD; // Render add
			else
				$xmit_details->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($xmit_details->isGridEdit() && ($xmit_details->RowType == ROWTYPE_EDIT || $xmit_details->RowType == ROWTYPE_ADD) && $xmit_details->EventCancelled) // Update failed
			$xmit_details_list->restoreCurrentRowFormValues($xmit_details_list->RowIndex); // Restore form values
		if ($xmit_details->RowType == ROWTYPE_EDIT) // Edit row
			$xmit_details_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$xmit_details->RowAttrs = array_merge($xmit_details->RowAttrs, array('data-rowindex'=>$xmit_details_list->RowCnt, 'id'=>'r' . $xmit_details_list->RowCnt . '_xmit_details', 'data-rowtype'=>$xmit_details->RowType));

		// Render row
		$xmit_details_list->renderRow();

		// Render list options
		$xmit_details_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($xmit_details_list->RowAction <> "delete" && $xmit_details_list->RowAction <> "insertdelete" && !($xmit_details_list->RowAction == "insert" && $xmit_details->isConfirm() && $xmit_details_list->emptyRow())) {
?>
	<tr<?php echo $xmit_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$xmit_details_list->ListOptions->render("body", "left", $xmit_details_list->RowCnt);
?>
	<?php if ($xmit_details->xmit_mode->Visible) { // xmit_mode ?>
		<td data-name="xmit_mode"<?php echo $xmit_details->xmit_mode->cellAttributes() ?>>
<?php if ($xmit_details->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $xmit_details_list->RowCnt ?>_xmit_details_xmit_mode" class="form-group xmit_details_xmit_mode">
<input type="text" data-table="xmit_details" data-field="x_xmit_mode" name="x<?php echo $xmit_details_list->RowIndex ?>_xmit_mode" id="x<?php echo $xmit_details_list->RowIndex ?>_xmit_mode" size="30" placeholder="<?php echo HtmlEncode($xmit_details->xmit_mode->getPlaceHolder()) ?>" value="<?php echo $xmit_details->xmit_mode->EditValue ?>"<?php echo $xmit_details->xmit_mode->editAttributes() ?>>
</span>
<input type="hidden" data-table="xmit_details" data-field="x_xmit_mode" name="o<?php echo $xmit_details_list->RowIndex ?>_xmit_mode" id="o<?php echo $xmit_details_list->RowIndex ?>_xmit_mode" value="<?php echo HtmlEncode($xmit_details->xmit_mode->OldValue) ?>">
<?php } ?>
<?php if ($xmit_details->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $xmit_details_list->RowCnt ?>_xmit_details_xmit_mode" class="form-group xmit_details_xmit_mode">
<input type="text" data-table="xmit_details" data-field="x_xmit_mode" name="x<?php echo $xmit_details_list->RowIndex ?>_xmit_mode" id="x<?php echo $xmit_details_list->RowIndex ?>_xmit_mode" size="30" placeholder="<?php echo HtmlEncode($xmit_details->xmit_mode->getPlaceHolder()) ?>" value="<?php echo $xmit_details->xmit_mode->EditValue ?>"<?php echo $xmit_details->xmit_mode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($xmit_details->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $xmit_details_list->RowCnt ?>_xmit_details_xmit_mode" class="xmit_details_xmit_mode">
<span<?php echo $xmit_details->xmit_mode->viewAttributes() ?>>
<?php echo $xmit_details->xmit_mode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($xmit_details->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="xmit_details" data-field="x_xmit_id" name="x<?php echo $xmit_details_list->RowIndex ?>_xmit_id" id="x<?php echo $xmit_details_list->RowIndex ?>_xmit_id" value="<?php echo HtmlEncode($xmit_details->xmit_id->CurrentValue) ?>">
<input type="hidden" data-table="xmit_details" data-field="x_xmit_id" name="o<?php echo $xmit_details_list->RowIndex ?>_xmit_id" id="o<?php echo $xmit_details_list->RowIndex ?>_xmit_id" value="<?php echo HtmlEncode($xmit_details->xmit_id->OldValue) ?>">
<?php } ?>
<?php if ($xmit_details->RowType == ROWTYPE_EDIT || $xmit_details->CurrentMode == "edit") { ?>
<input type="hidden" data-table="xmit_details" data-field="x_xmit_id" name="x<?php echo $xmit_details_list->RowIndex ?>_xmit_id" id="x<?php echo $xmit_details_list->RowIndex ?>_xmit_id" value="<?php echo HtmlEncode($xmit_details->xmit_id->CurrentValue) ?>">
<?php } ?>
<?php

// Render list options (body, right)
$xmit_details_list->ListOptions->render("body", "right", $xmit_details_list->RowCnt);
?>
	</tr>
<?php if ($xmit_details->RowType == ROWTYPE_ADD || $xmit_details->RowType == ROWTYPE_EDIT) { ?>
<script>
fxmit_detailslist.updateLists(<?php echo $xmit_details_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$xmit_details->isGridAdd())
		if (!$xmit_details_list->Recordset->EOF)
			$xmit_details_list->Recordset->moveNext();
}
?>
<?php
	if ($xmit_details->isGridAdd() || $xmit_details->isGridEdit()) {
		$xmit_details_list->RowIndex = '$rowindex$';
		$xmit_details_list->loadRowValues();

		// Set row properties
		$xmit_details->resetAttributes();
		$xmit_details->RowAttrs = array_merge($xmit_details->RowAttrs, array('data-rowindex'=>$xmit_details_list->RowIndex, 'id'=>'r0_xmit_details', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($xmit_details->RowAttrs["class"], "ew-template");
		$xmit_details->RowType = ROWTYPE_ADD;

		// Render row
		$xmit_details_list->renderRow();

		// Render list options
		$xmit_details_list->renderListOptions();
		$xmit_details_list->StartRowCnt = 0;
?>
	<tr<?php echo $xmit_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$xmit_details_list->ListOptions->render("body", "left", $xmit_details_list->RowIndex);
?>
	<?php if ($xmit_details->xmit_mode->Visible) { // xmit_mode ?>
		<td data-name="xmit_mode">
<span id="el$rowindex$_xmit_details_xmit_mode" class="form-group xmit_details_xmit_mode">
<input type="text" data-table="xmit_details" data-field="x_xmit_mode" name="x<?php echo $xmit_details_list->RowIndex ?>_xmit_mode" id="x<?php echo $xmit_details_list->RowIndex ?>_xmit_mode" size="30" placeholder="<?php echo HtmlEncode($xmit_details->xmit_mode->getPlaceHolder()) ?>" value="<?php echo $xmit_details->xmit_mode->EditValue ?>"<?php echo $xmit_details->xmit_mode->editAttributes() ?>>
</span>
<input type="hidden" data-table="xmit_details" data-field="x_xmit_mode" name="o<?php echo $xmit_details_list->RowIndex ?>_xmit_mode" id="o<?php echo $xmit_details_list->RowIndex ?>_xmit_mode" value="<?php echo HtmlEncode($xmit_details->xmit_mode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$xmit_details_list->ListOptions->render("body", "right", $xmit_details_list->RowIndex);
?>
<script>
fxmit_detailslist.updateLists(<?php echo $xmit_details_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($xmit_details->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $xmit_details_list->FormKeyCountName ?>" id="<?php echo $xmit_details_list->FormKeyCountName ?>" value="<?php echo $xmit_details_list->KeyCount ?>">
<?php echo $xmit_details_list->MultiSelectKey ?>
<?php } ?>
<?php if ($xmit_details->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $xmit_details_list->FormKeyCountName ?>" id="<?php echo $xmit_details_list->FormKeyCountName ?>" value="<?php echo $xmit_details_list->KeyCount ?>">
<?php echo $xmit_details_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$xmit_details->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($xmit_details_list->Recordset)
	$xmit_details_list->Recordset->Close();
?>
<?php if (!$xmit_details->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$xmit_details->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($xmit_details_list->Pager)) $xmit_details_list->Pager = new NumericPager($xmit_details_list->StartRec, $xmit_details_list->DisplayRecs, $xmit_details_list->TotalRecs, $xmit_details_list->RecRange, $xmit_details_list->AutoHidePager) ?>
<?php if ($xmit_details_list->Pager->RecordCount > 0 && $xmit_details_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($xmit_details_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($xmit_details_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($xmit_details_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $xmit_details_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($xmit_details_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($xmit_details_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $xmit_details_list->pageUrl() ?>start=<?php echo $xmit_details_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($xmit_details_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $xmit_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $xmit_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $xmit_details_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $xmit_details_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($xmit_details_list->TotalRecs == 0 && !$xmit_details->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $xmit_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$xmit_details_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$xmit_details->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$xmit_details_list->terminate();
?>