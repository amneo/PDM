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
$approval_details_delete = new approval_details_delete();

// Run the page
$approval_details_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$approval_details_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fapproval_detailsdelete = currentForm = new ew.Form("fapproval_detailsdelete", "delete");

// Form_CustomValidate event
fapproval_detailsdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fapproval_detailsdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapproval_detailsdelete.lists["x_document_status"] = <?php echo $approval_details_delete->document_status->Lookup->toClientList() ?>;
fapproval_detailsdelete.lists["x_document_status"].options = <?php echo JsonEncode($approval_details_delete->document_status->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $approval_details_delete->showPageHeader(); ?>
<?php
$approval_details_delete->showMessage();
?>
<form name="fapproval_detailsdelete" id="fapproval_detailsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($approval_details_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $approval_details_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="approval_details">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($approval_details_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($approval_details->id->Visible) { // id ?>
		<th class="<?php echo $approval_details->id->headerCellClass() ?>"><span id="elh_approval_details_id" class="approval_details_id"><?php echo $approval_details->id->caption() ?></span></th>
<?php } ?>
<?php if ($approval_details->short_code->Visible) { // short_code ?>
		<th class="<?php echo $approval_details->short_code->headerCellClass() ?>"><span id="elh_approval_details_short_code" class="approval_details_short_code"><?php echo $approval_details->short_code->caption() ?></span></th>
<?php } ?>
<?php if ($approval_details->Description->Visible) { // Description ?>
		<th class="<?php echo $approval_details->Description->headerCellClass() ?>"><span id="elh_approval_details_Description" class="approval_details_Description"><?php echo $approval_details->Description->caption() ?></span></th>
<?php } ?>
<?php if ($approval_details->document_status->Visible) { // document_status ?>
		<th class="<?php echo $approval_details->document_status->headerCellClass() ?>"><span id="elh_approval_details_document_status" class="approval_details_document_status"><?php echo $approval_details->document_status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$approval_details_delete->RecCnt = 0;
$i = 0;
while (!$approval_details_delete->Recordset->EOF) {
	$approval_details_delete->RecCnt++;
	$approval_details_delete->RowCnt++;

	// Set row properties
	$approval_details->resetAttributes();
	$approval_details->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$approval_details_delete->loadRowValues($approval_details_delete->Recordset);

	// Render row
	$approval_details_delete->renderRow();
?>
	<tr<?php echo $approval_details->rowAttributes() ?>>
<?php if ($approval_details->id->Visible) { // id ?>
		<td<?php echo $approval_details->id->cellAttributes() ?>>
<span id="el<?php echo $approval_details_delete->RowCnt ?>_approval_details_id" class="approval_details_id">
<span<?php echo $approval_details->id->viewAttributes() ?>>
<?php echo $approval_details->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($approval_details->short_code->Visible) { // short_code ?>
		<td<?php echo $approval_details->short_code->cellAttributes() ?>>
<span id="el<?php echo $approval_details_delete->RowCnt ?>_approval_details_short_code" class="approval_details_short_code">
<span<?php echo $approval_details->short_code->viewAttributes() ?>>
<?php echo $approval_details->short_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($approval_details->Description->Visible) { // Description ?>
		<td<?php echo $approval_details->Description->cellAttributes() ?>>
<span id="el<?php echo $approval_details_delete->RowCnt ?>_approval_details_Description" class="approval_details_Description">
<span<?php echo $approval_details->Description->viewAttributes() ?>>
<?php echo $approval_details->Description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($approval_details->document_status->Visible) { // document_status ?>
		<td<?php echo $approval_details->document_status->cellAttributes() ?>>
<span id="el<?php echo $approval_details_delete->RowCnt ?>_approval_details_document_status" class="approval_details_document_status">
<span<?php echo $approval_details->document_status->viewAttributes() ?>>
<?php echo $approval_details->document_status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$approval_details_delete->Recordset->moveNext();
}
$approval_details_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $approval_details_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$approval_details_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$approval_details_delete->terminate();
?>