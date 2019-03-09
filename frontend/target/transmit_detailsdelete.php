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
$transmit_details_delete = new transmit_details_delete();

// Run the page
$transmit_details_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transmit_details_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftransmit_detailsdelete = currentForm = new ew.Form("ftransmit_detailsdelete", "delete");

// Form_CustomValidate event
ftransmit_detailsdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftransmit_detailsdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftransmit_detailsdelete.lists["x_project_name"] = <?php echo $transmit_details_delete->project_name->Lookup->toClientList() ?>;
ftransmit_detailsdelete.lists["x_project_name"].options = <?php echo JsonEncode($transmit_details_delete->project_name->lookupOptions()) ?>;
ftransmit_detailsdelete.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftransmit_detailsdelete.lists["x_ack_rcvd"] = <?php echo $transmit_details_delete->ack_rcvd->Lookup->toClientList() ?>;
ftransmit_detailsdelete.lists["x_ack_rcvd"].options = <?php echo JsonEncode($transmit_details_delete->ack_rcvd->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $transmit_details_delete->showPageHeader(); ?>
<?php
$transmit_details_delete->showMessage();
?>
<form name="ftransmit_detailsdelete" id="ftransmit_detailsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($transmit_details_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $transmit_details_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transmit_details">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($transmit_details_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($transmit_details->transmit_id->Visible) { // transmit_id ?>
		<th class="<?php echo $transmit_details->transmit_id->headerCellClass() ?>"><span id="elh_transmit_details_transmit_id" class="transmit_details_transmit_id"><?php echo $transmit_details->transmit_id->caption() ?></span></th>
<?php } ?>
<?php if ($transmit_details->transmittal_no->Visible) { // transmittal_no ?>
		<th class="<?php echo $transmit_details->transmittal_no->headerCellClass() ?>"><span id="elh_transmit_details_transmittal_no" class="transmit_details_transmittal_no"><?php echo $transmit_details->transmittal_no->caption() ?></span></th>
<?php } ?>
<?php if ($transmit_details->project_name->Visible) { // project_name ?>
		<th class="<?php echo $transmit_details->project_name->headerCellClass() ?>"><span id="elh_transmit_details_project_name" class="transmit_details_project_name"><?php echo $transmit_details->project_name->caption() ?></span></th>
<?php } ?>
<?php if ($transmit_details->delivery_location->Visible) { // delivery_location ?>
		<th class="<?php echo $transmit_details->delivery_location->headerCellClass() ?>"><span id="elh_transmit_details_delivery_location" class="transmit_details_delivery_location"><?php echo $transmit_details->delivery_location->caption() ?></span></th>
<?php } ?>
<?php if ($transmit_details->addressed_to->Visible) { // addressed_to ?>
		<th class="<?php echo $transmit_details->addressed_to->headerCellClass() ?>"><span id="elh_transmit_details_addressed_to" class="transmit_details_addressed_to"><?php echo $transmit_details->addressed_to->caption() ?></span></th>
<?php } ?>
<?php if ($transmit_details->remarks->Visible) { // remarks ?>
		<th class="<?php echo $transmit_details->remarks->headerCellClass() ?>"><span id="elh_transmit_details_remarks" class="transmit_details_remarks"><?php echo $transmit_details->remarks->caption() ?></span></th>
<?php } ?>
<?php if ($transmit_details->ack_rcvd->Visible) { // ack_rcvd ?>
		<th class="<?php echo $transmit_details->ack_rcvd->headerCellClass() ?>"><span id="elh_transmit_details_ack_rcvd" class="transmit_details_ack_rcvd"><?php echo $transmit_details->ack_rcvd->caption() ?></span></th>
<?php } ?>
<?php if ($transmit_details->ack_document->Visible) { // ack_document ?>
		<th class="<?php echo $transmit_details->ack_document->headerCellClass() ?>"><span id="elh_transmit_details_ack_document" class="transmit_details_ack_document"><?php echo $transmit_details->ack_document->caption() ?></span></th>
<?php } ?>
<?php if ($transmit_details->transmital_date->Visible) { // transmital_date ?>
		<th class="<?php echo $transmit_details->transmital_date->headerCellClass() ?>"><span id="elh_transmit_details_transmital_date" class="transmit_details_transmital_date"><?php echo $transmit_details->transmital_date->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$transmit_details_delete->RecCnt = 0;
$i = 0;
while (!$transmit_details_delete->Recordset->EOF) {
	$transmit_details_delete->RecCnt++;
	$transmit_details_delete->RowCnt++;

	// Set row properties
	$transmit_details->resetAttributes();
	$transmit_details->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$transmit_details_delete->loadRowValues($transmit_details_delete->Recordset);

	// Render row
	$transmit_details_delete->renderRow();
?>
	<tr<?php echo $transmit_details->rowAttributes() ?>>
<?php if ($transmit_details->transmit_id->Visible) { // transmit_id ?>
		<td<?php echo $transmit_details->transmit_id->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_delete->RowCnt ?>_transmit_details_transmit_id" class="transmit_details_transmit_id">
<span<?php echo $transmit_details->transmit_id->viewAttributes() ?>>
<?php echo $transmit_details->transmit_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transmit_details->transmittal_no->Visible) { // transmittal_no ?>
		<td<?php echo $transmit_details->transmittal_no->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_delete->RowCnt ?>_transmit_details_transmittal_no" class="transmit_details_transmittal_no">
<span<?php echo $transmit_details->transmittal_no->viewAttributes() ?>>
<?php echo $transmit_details->transmittal_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transmit_details->project_name->Visible) { // project_name ?>
		<td<?php echo $transmit_details->project_name->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_delete->RowCnt ?>_transmit_details_project_name" class="transmit_details_project_name">
<span<?php echo $transmit_details->project_name->viewAttributes() ?>>
<?php echo $transmit_details->project_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transmit_details->delivery_location->Visible) { // delivery_location ?>
		<td<?php echo $transmit_details->delivery_location->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_delete->RowCnt ?>_transmit_details_delivery_location" class="transmit_details_delivery_location">
<span<?php echo $transmit_details->delivery_location->viewAttributes() ?>>
<?php echo $transmit_details->delivery_location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transmit_details->addressed_to->Visible) { // addressed_to ?>
		<td<?php echo $transmit_details->addressed_to->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_delete->RowCnt ?>_transmit_details_addressed_to" class="transmit_details_addressed_to">
<span<?php echo $transmit_details->addressed_to->viewAttributes() ?>>
<?php echo $transmit_details->addressed_to->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transmit_details->remarks->Visible) { // remarks ?>
		<td<?php echo $transmit_details->remarks->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_delete->RowCnt ?>_transmit_details_remarks" class="transmit_details_remarks">
<span<?php echo $transmit_details->remarks->viewAttributes() ?>>
<?php echo $transmit_details->remarks->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transmit_details->ack_rcvd->Visible) { // ack_rcvd ?>
		<td<?php echo $transmit_details->ack_rcvd->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_delete->RowCnt ?>_transmit_details_ack_rcvd" class="transmit_details_ack_rcvd">
<span<?php echo $transmit_details->ack_rcvd->viewAttributes() ?>>
<?php echo $transmit_details->ack_rcvd->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transmit_details->ack_document->Visible) { // ack_document ?>
		<td<?php echo $transmit_details->ack_document->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_delete->RowCnt ?>_transmit_details_ack_document" class="transmit_details_ack_document">
<span<?php echo $transmit_details->ack_document->viewAttributes() ?>>
<?php echo GetFileViewTag($transmit_details->ack_document, $transmit_details->ack_document->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($transmit_details->transmital_date->Visible) { // transmital_date ?>
		<td<?php echo $transmit_details->transmital_date->cellAttributes() ?>>
<span id="el<?php echo $transmit_details_delete->RowCnt ?>_transmit_details_transmital_date" class="transmit_details_transmital_date">
<span<?php echo $transmit_details->transmital_date->viewAttributes() ?>>
<?php echo $transmit_details->transmital_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$transmit_details_delete->Recordset->moveNext();
}
$transmit_details_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $transmit_details_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$transmit_details_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$transmit_details_delete->terminate();
?>