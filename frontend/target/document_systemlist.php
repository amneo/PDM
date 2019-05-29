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
$document_system_list = new document_system_list();

// Run the page
$document_system_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_system_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$document_system->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fdocument_systemlist = currentForm = new ew.Form("fdocument_systemlist", "list");
fdocument_systemlist.formKeyCountName = '<?php echo $document_system_list->FormKeyCountName ?>';

// Validate form
fdocument_systemlist.validate = function() {
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
		<?php if ($document_system_list->system_name->Required) { ?>
			elm = this.getElements("x" + infix + "_system_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_system->system_name->caption(), $document_system->system_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_system_list->system_group->Required) { ?>
			elm = this.getElements("x" + infix + "_system_group");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_system->system_group->caption(), $document_system->system_group->RequiredErrorMessage)) ?>");
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
fdocument_systemlist.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "system_name", false)) return false;
	if (ew.valueChanged(fobj, infix, "system_group", false)) return false;
	return true;
}

// Form_CustomValidate event
fdocument_systemlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_systemlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$document_system->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($document_system_list->TotalRecs > 0 && $document_system_list->ExportOptions->visible()) { ?>
<?php $document_system_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($document_system_list->ImportOptions->visible()) { ?>
<?php $document_system_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$document_system_list->renderOtherOptions();
?>
<?php $document_system_list->showPageHeader(); ?>
<?php
$document_system_list->showMessage();
?>
<?php if ($document_system_list->TotalRecs > 0 || $document_system->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($document_system_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> document_system">
<?php if (!$document_system->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$document_system->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($document_system_list->Pager)) $document_system_list->Pager = new NumericPager($document_system_list->StartRec, $document_system_list->DisplayRecs, $document_system_list->TotalRecs, $document_system_list->RecRange, $document_system_list->AutoHidePager) ?>
<?php if ($document_system_list->Pager->RecordCount > 0 && $document_system_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($document_system_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($document_system_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($document_system_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $document_system_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($document_system_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($document_system_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($document_system_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $document_system_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $document_system_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $document_system_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $document_system_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdocument_systemlist" id="fdocument_systemlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_system_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_system_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_system">
<div id="gmp_document_system" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($document_system_list->TotalRecs > 0 || $document_system->isGridEdit()) { ?>
<table id="tbl_document_systemlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$document_system_list->RowType = ROWTYPE_HEADER;

// Render list options
$document_system_list->renderListOptions();

// Render list options (header, left)
$document_system_list->ListOptions->render("header", "left");
?>
<?php if ($document_system->system_name->Visible) { // system_name ?>
	<?php if ($document_system->sortUrl($document_system->system_name) == "") { ?>
		<th data-name="system_name" class="<?php echo $document_system->system_name->headerCellClass() ?>"><div id="elh_document_system_system_name" class="document_system_system_name"><div class="ew-table-header-caption"><?php echo $document_system->system_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="system_name" class="<?php echo $document_system->system_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_system->SortUrl($document_system->system_name) ?>',2);"><div id="elh_document_system_system_name" class="document_system_system_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_system->system_name->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_system->system_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_system->system_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_system->system_group->Visible) { // system_group ?>
	<?php if ($document_system->sortUrl($document_system->system_group) == "") { ?>
		<th data-name="system_group" class="<?php echo $document_system->system_group->headerCellClass() ?>"><div id="elh_document_system_system_group" class="document_system_system_group"><div class="ew-table-header-caption"><?php echo $document_system->system_group->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="system_group" class="<?php echo $document_system->system_group->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $document_system->SortUrl($document_system->system_group) ?>',2);"><div id="elh_document_system_system_group" class="document_system_system_group">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_system->system_group->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_system->system_group->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($document_system->system_group->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$document_system_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($document_system->ExportAll && $document_system->isExport()) {
	$document_system_list->StopRec = $document_system_list->TotalRecs;
} else {

	// Set the last record to display
	if ($document_system_list->TotalRecs > $document_system_list->StartRec + $document_system_list->DisplayRecs - 1)
		$document_system_list->StopRec = $document_system_list->StartRec + $document_system_list->DisplayRecs - 1;
	else
		$document_system_list->StopRec = $document_system_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $document_system_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($document_system_list->FormKeyCountName) && ($document_system->isGridAdd() || $document_system->isGridEdit() || $document_system->isConfirm())) {
		$document_system_list->KeyCount = $CurrentForm->getValue($document_system_list->FormKeyCountName);
		$document_system_list->StopRec = $document_system_list->StartRec + $document_system_list->KeyCount - 1;
	}
}
$document_system_list->RecCnt = $document_system_list->StartRec - 1;
if ($document_system_list->Recordset && !$document_system_list->Recordset->EOF) {
	$document_system_list->Recordset->moveFirst();
	$selectLimit = $document_system_list->UseSelectLimit;
	if (!$selectLimit && $document_system_list->StartRec > 1)
		$document_system_list->Recordset->move($document_system_list->StartRec - 1);
} elseif (!$document_system->AllowAddDeleteRow && $document_system_list->StopRec == 0) {
	$document_system_list->StopRec = $document_system->GridAddRowCount;
}

// Initialize aggregate
$document_system->RowType = ROWTYPE_AGGREGATEINIT;
$document_system->resetAttributes();
$document_system_list->renderRow();
if ($document_system->isGridAdd())
	$document_system_list->RowIndex = 0;
if ($document_system->isGridEdit())
	$document_system_list->RowIndex = 0;
while ($document_system_list->RecCnt < $document_system_list->StopRec) {
	$document_system_list->RecCnt++;
	if ($document_system_list->RecCnt >= $document_system_list->StartRec) {
		$document_system_list->RowCnt++;
		if ($document_system->isGridAdd() || $document_system->isGridEdit() || $document_system->isConfirm()) {
			$document_system_list->RowIndex++;
			$CurrentForm->Index = $document_system_list->RowIndex;
			if ($CurrentForm->hasValue($document_system_list->FormActionName) && $document_system_list->EventCancelled)
				$document_system_list->RowAction = strval($CurrentForm->getValue($document_system_list->FormActionName));
			elseif ($document_system->isGridAdd())
				$document_system_list->RowAction = "insert";
			else
				$document_system_list->RowAction = "";
		}

		// Set up key count
		$document_system_list->KeyCount = $document_system_list->RowIndex;

		// Init row class and style
		$document_system->resetAttributes();
		$document_system->CssClass = "";
		if ($document_system->isGridAdd()) {
			$document_system_list->loadRowValues(); // Load default values
		} else {
			$document_system_list->loadRowValues($document_system_list->Recordset); // Load row values
		}
		$document_system->RowType = ROWTYPE_VIEW; // Render view
		if ($document_system->isGridAdd()) // Grid add
			$document_system->RowType = ROWTYPE_ADD; // Render add
		if ($document_system->isGridAdd() && $document_system->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$document_system_list->restoreCurrentRowFormValues($document_system_list->RowIndex); // Restore form values
		if ($document_system->isGridEdit()) { // Grid edit
			if ($document_system->EventCancelled)
				$document_system_list->restoreCurrentRowFormValues($document_system_list->RowIndex); // Restore form values
			if ($document_system_list->RowAction == "insert")
				$document_system->RowType = ROWTYPE_ADD; // Render add
			else
				$document_system->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($document_system->isGridEdit() && ($document_system->RowType == ROWTYPE_EDIT || $document_system->RowType == ROWTYPE_ADD) && $document_system->EventCancelled) // Update failed
			$document_system_list->restoreCurrentRowFormValues($document_system_list->RowIndex); // Restore form values
		if ($document_system->RowType == ROWTYPE_EDIT) // Edit row
			$document_system_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$document_system->RowAttrs = array_merge($document_system->RowAttrs, array('data-rowindex'=>$document_system_list->RowCnt, 'id'=>'r' . $document_system_list->RowCnt . '_document_system', 'data-rowtype'=>$document_system->RowType));

		// Render row
		$document_system_list->renderRow();

		// Render list options
		$document_system_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($document_system_list->RowAction <> "delete" && $document_system_list->RowAction <> "insertdelete" && !($document_system_list->RowAction == "insert" && $document_system->isConfirm() && $document_system_list->emptyRow())) {
?>
	<tr<?php echo $document_system->rowAttributes() ?>>
<?php

// Render list options (body, left)
$document_system_list->ListOptions->render("body", "left", $document_system_list->RowCnt);
?>
	<?php if ($document_system->system_name->Visible) { // system_name ?>
		<td data-name="system_name"<?php echo $document_system->system_name->cellAttributes() ?>>
<?php if ($document_system->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $document_system_list->RowCnt ?>_document_system_system_name" class="form-group document_system_system_name">
<input type="text" data-table="document_system" data-field="x_system_name" name="x<?php echo $document_system_list->RowIndex ?>_system_name" id="x<?php echo $document_system_list->RowIndex ?>_system_name" size="30" placeholder="<?php echo HtmlEncode($document_system->system_name->getPlaceHolder()) ?>" value="<?php echo $document_system->system_name->EditValue ?>"<?php echo $document_system->system_name->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_system" data-field="x_system_name" name="o<?php echo $document_system_list->RowIndex ?>_system_name" id="o<?php echo $document_system_list->RowIndex ?>_system_name" value="<?php echo HtmlEncode($document_system->system_name->OldValue) ?>">
<?php } ?>
<?php if ($document_system->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $document_system_list->RowCnt ?>_document_system_system_name" class="form-group document_system_system_name">
<span<?php echo $document_system->system_name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_system->system_name->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="document_system" data-field="x_system_name" name="x<?php echo $document_system_list->RowIndex ?>_system_name" id="x<?php echo $document_system_list->RowIndex ?>_system_name" value="<?php echo HtmlEncode($document_system->system_name->CurrentValue) ?>">
<?php } ?>
<?php if ($document_system->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $document_system_list->RowCnt ?>_document_system_system_name" class="document_system_system_name">
<span<?php echo $document_system->system_name->viewAttributes() ?>>
<?php echo $document_system->system_name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($document_system->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="document_system" data-field="x_type_id" name="x<?php echo $document_system_list->RowIndex ?>_type_id" id="x<?php echo $document_system_list->RowIndex ?>_type_id" value="<?php echo HtmlEncode($document_system->type_id->CurrentValue) ?>">
<input type="hidden" data-table="document_system" data-field="x_type_id" name="o<?php echo $document_system_list->RowIndex ?>_type_id" id="o<?php echo $document_system_list->RowIndex ?>_type_id" value="<?php echo HtmlEncode($document_system->type_id->OldValue) ?>">
<?php } ?>
<?php if ($document_system->RowType == ROWTYPE_EDIT || $document_system->CurrentMode == "edit") { ?>
<input type="hidden" data-table="document_system" data-field="x_type_id" name="x<?php echo $document_system_list->RowIndex ?>_type_id" id="x<?php echo $document_system_list->RowIndex ?>_type_id" value="<?php echo HtmlEncode($document_system->type_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($document_system->system_group->Visible) { // system_group ?>
		<td data-name="system_group"<?php echo $document_system->system_group->cellAttributes() ?>>
<?php if ($document_system->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $document_system_list->RowCnt ?>_document_system_system_group" class="form-group document_system_system_group">
<input type="text" data-table="document_system" data-field="x_system_group" name="x<?php echo $document_system_list->RowIndex ?>_system_group" id="x<?php echo $document_system_list->RowIndex ?>_system_group" size="30" placeholder="<?php echo HtmlEncode($document_system->system_group->getPlaceHolder()) ?>" value="<?php echo $document_system->system_group->EditValue ?>"<?php echo $document_system->system_group->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_system" data-field="x_system_group" name="o<?php echo $document_system_list->RowIndex ?>_system_group" id="o<?php echo $document_system_list->RowIndex ?>_system_group" value="<?php echo HtmlEncode($document_system->system_group->OldValue) ?>">
<?php } ?>
<?php if ($document_system->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $document_system_list->RowCnt ?>_document_system_system_group" class="form-group document_system_system_group">
<input type="text" data-table="document_system" data-field="x_system_group" name="x<?php echo $document_system_list->RowIndex ?>_system_group" id="x<?php echo $document_system_list->RowIndex ?>_system_group" size="30" placeholder="<?php echo HtmlEncode($document_system->system_group->getPlaceHolder()) ?>" value="<?php echo $document_system->system_group->EditValue ?>"<?php echo $document_system->system_group->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($document_system->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $document_system_list->RowCnt ?>_document_system_system_group" class="document_system_system_group">
<span<?php echo $document_system->system_group->viewAttributes() ?>>
<?php echo $document_system->system_group->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$document_system_list->ListOptions->render("body", "right", $document_system_list->RowCnt);
?>
	</tr>
<?php if ($document_system->RowType == ROWTYPE_ADD || $document_system->RowType == ROWTYPE_EDIT) { ?>
<script>
fdocument_systemlist.updateLists(<?php echo $document_system_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$document_system->isGridAdd())
		if (!$document_system_list->Recordset->EOF)
			$document_system_list->Recordset->moveNext();
}
?>
<?php
	if ($document_system->isGridAdd() || $document_system->isGridEdit()) {
		$document_system_list->RowIndex = '$rowindex$';
		$document_system_list->loadRowValues();

		// Set row properties
		$document_system->resetAttributes();
		$document_system->RowAttrs = array_merge($document_system->RowAttrs, array('data-rowindex'=>$document_system_list->RowIndex, 'id'=>'r0_document_system', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($document_system->RowAttrs["class"], "ew-template");
		$document_system->RowType = ROWTYPE_ADD;

		// Render row
		$document_system_list->renderRow();

		// Render list options
		$document_system_list->renderListOptions();
		$document_system_list->StartRowCnt = 0;
?>
	<tr<?php echo $document_system->rowAttributes() ?>>
<?php

// Render list options (body, left)
$document_system_list->ListOptions->render("body", "left", $document_system_list->RowIndex);
?>
	<?php if ($document_system->system_name->Visible) { // system_name ?>
		<td data-name="system_name">
<span id="el$rowindex$_document_system_system_name" class="form-group document_system_system_name">
<input type="text" data-table="document_system" data-field="x_system_name" name="x<?php echo $document_system_list->RowIndex ?>_system_name" id="x<?php echo $document_system_list->RowIndex ?>_system_name" size="30" placeholder="<?php echo HtmlEncode($document_system->system_name->getPlaceHolder()) ?>" value="<?php echo $document_system->system_name->EditValue ?>"<?php echo $document_system->system_name->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_system" data-field="x_system_name" name="o<?php echo $document_system_list->RowIndex ?>_system_name" id="o<?php echo $document_system_list->RowIndex ?>_system_name" value="<?php echo HtmlEncode($document_system->system_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($document_system->system_group->Visible) { // system_group ?>
		<td data-name="system_group">
<span id="el$rowindex$_document_system_system_group" class="form-group document_system_system_group">
<input type="text" data-table="document_system" data-field="x_system_group" name="x<?php echo $document_system_list->RowIndex ?>_system_group" id="x<?php echo $document_system_list->RowIndex ?>_system_group" size="30" placeholder="<?php echo HtmlEncode($document_system->system_group->getPlaceHolder()) ?>" value="<?php echo $document_system->system_group->EditValue ?>"<?php echo $document_system->system_group->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_system" data-field="x_system_group" name="o<?php echo $document_system_list->RowIndex ?>_system_group" id="o<?php echo $document_system_list->RowIndex ?>_system_group" value="<?php echo HtmlEncode($document_system->system_group->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$document_system_list->ListOptions->render("body", "right", $document_system_list->RowIndex);
?>
<script>
fdocument_systemlist.updateLists(<?php echo $document_system_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($document_system->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $document_system_list->FormKeyCountName ?>" id="<?php echo $document_system_list->FormKeyCountName ?>" value="<?php echo $document_system_list->KeyCount ?>">
<?php echo $document_system_list->MultiSelectKey ?>
<?php } ?>
<?php if ($document_system->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $document_system_list->FormKeyCountName ?>" id="<?php echo $document_system_list->FormKeyCountName ?>" value="<?php echo $document_system_list->KeyCount ?>">
<?php echo $document_system_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$document_system->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($document_system_list->Recordset)
	$document_system_list->Recordset->Close();
?>
<?php if (!$document_system->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$document_system->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($document_system_list->Pager)) $document_system_list->Pager = new NumericPager($document_system_list->StartRec, $document_system_list->DisplayRecs, $document_system_list->TotalRecs, $document_system_list->RecRange, $document_system_list->AutoHidePager) ?>
<?php if ($document_system_list->Pager->RecordCount > 0 && $document_system_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($document_system_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($document_system_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($document_system_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $document_system_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($document_system_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($document_system_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $document_system_list->pageUrl() ?>start=<?php echo $document_system_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($document_system_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $document_system_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $document_system_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $document_system_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $document_system_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($document_system_list->TotalRecs == 0 && !$document_system->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $document_system_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$document_system_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$document_system->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$document_system_list->terminate();
?>