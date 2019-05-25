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
$transaction_details_delete = new transaction_details_delete();

// Run the page
$transaction_details_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transaction_details_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftransaction_detailsdelete = currentForm = new ew.Form("ftransaction_detailsdelete", "delete");

// Form_CustomValidate event
ftransaction_detailsdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftransaction_detailsdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftransaction_detailsdelete.lists["x_firelink_doc_no"] = <?php echo $transaction_details_delete->firelink_doc_no->Lookup->toClientList() ?>;
ftransaction_detailsdelete.lists["x_firelink_doc_no"].options = <?php echo JsonEncode($transaction_details_delete->firelink_doc_no->lookupOptions()) ?>;
ftransaction_detailsdelete.autoSuggests["x_firelink_doc_no"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftransaction_detailsdelete.lists["x_transmit_no"] = <?php echo $transaction_details_delete->transmit_no->Lookup->toClientList() ?>;
ftransaction_detailsdelete.lists["x_transmit_no"].options = <?php echo JsonEncode($transaction_details_delete->transmit_no->lookupOptions()) ?>;
ftransaction_detailsdelete.autoSuggests["x_transmit_no"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftransaction_detailsdelete.lists["x_direction"] = <?php echo $transaction_details_delete->direction->Lookup->toClientList() ?>;
ftransaction_detailsdelete.lists["x_direction"].options = <?php echo JsonEncode($transaction_details_delete->direction->options(FALSE, TRUE)) ?>;
ftransaction_detailsdelete.lists["x_approval_status"] = <?php echo $transaction_details_delete->approval_status->Lookup->toClientList() ?>;
ftransaction_detailsdelete.lists["x_approval_status"].options = <?php echo JsonEncode($transaction_details_delete->approval_status->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $transaction_details_delete->showPageHeader(); ?>
<?php
$transaction_details_delete->showMessage();
?>
<form name="ftransaction_detailsdelete" id="ftransaction_detailsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($transaction_details_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $transaction_details_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transaction_details">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($transaction_details_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($transaction_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
		<th class="<?php echo $transaction_details->firelink_doc_no->headerCellClass() ?>"><span id="elh_transaction_details_firelink_doc_no" class="transaction_details_firelink_doc_no"><?php echo $transaction_details->firelink_doc_no->caption() ?></span></th>
<?php } ?>
<?php if ($transaction_details->project_name->Visible) { // project_name ?>
		<th class="<?php echo $transaction_details->project_name->headerCellClass() ?>"><span id="elh_transaction_details_project_name" class="transaction_details_project_name"><?php echo $transaction_details->project_name->caption() ?></span></th>
<?php } ?>
<?php if ($transaction_details->document_tittle->Visible) { // document_tittle ?>
		<th class="<?php echo $transaction_details->document_tittle->headerCellClass() ?>"><span id="elh_transaction_details_document_tittle" class="transaction_details_document_tittle"><?php echo $transaction_details->document_tittle->caption() ?></span></th>
<?php } ?>
<?php if ($transaction_details->submit_no->Visible) { // submit_no ?>
		<th class="<?php echo $transaction_details->submit_no->headerCellClass() ?>"><span id="elh_transaction_details_submit_no" class="transaction_details_submit_no"><?php echo $transaction_details->submit_no->caption() ?></span></th>
<?php } ?>
<?php if ($transaction_details->revision_no->Visible) { // revision_no ?>
		<th class="<?php echo $transaction_details->revision_no->headerCellClass() ?>"><span id="elh_transaction_details_revision_no" class="transaction_details_revision_no"><?php echo $transaction_details->revision_no->caption() ?></span></th>
<?php } ?>
<?php if ($transaction_details->transmit_no->Visible) { // transmit_no ?>
		<th class="<?php echo $transaction_details->transmit_no->headerCellClass() ?>"><span id="elh_transaction_details_transmit_no" class="transaction_details_transmit_no"><?php echo $transaction_details->transmit_no->caption() ?></span></th>
<?php } ?>
<?php if ($transaction_details->transmit_date->Visible) { // transmit_date ?>
		<th class="<?php echo $transaction_details->transmit_date->headerCellClass() ?>"><span id="elh_transaction_details_transmit_date" class="transaction_details_transmit_date"><?php echo $transaction_details->transmit_date->caption() ?></span></th>
<?php } ?>
<?php if ($transaction_details->direction->Visible) { // direction ?>
		<th class="<?php echo $transaction_details->direction->headerCellClass() ?>"><span id="elh_transaction_details_direction" class="transaction_details_direction"><?php echo $transaction_details->direction->caption() ?></span></th>
<?php } ?>
<?php if ($transaction_details->approval_status->Visible) { // approval_status ?>
		<th class="<?php echo $transaction_details->approval_status->headerCellClass() ?>"><span id="elh_transaction_details_approval_status" class="transaction_details_approval_status"><?php echo $transaction_details->approval_status->caption() ?></span></th>
<?php } ?>
<?php if ($transaction_details->document_link->Visible) { // document_link ?>
		<th class="<?php echo $transaction_details->document_link->headerCellClass() ?>"><span id="elh_transaction_details_document_link" class="transaction_details_document_link"><?php echo $transaction_details->document_link->caption() ?></span></th>
<?php } ?>
<?php if ($transaction_details->document_native->Visible) { // document_native ?>
		<th class="<?php echo $transaction_details->document_native->headerCellClass() ?>"><span id="elh_transaction_details_document_native" class="transaction_details_document_native"><?php echo $transaction_details->document_native->caption() ?></span></th>
<?php } ?>
<?php if ($transaction_details->expiry_date->Visible) { // expiry_date ?>
		<th class="<?php echo $transaction_details->expiry_date->headerCellClass() ?>"><span id="elh_transaction_details_expiry_date" class="transaction_details_expiry_date"><?php echo $transaction_details->expiry_date->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$transaction_details_delete->RecCnt = 0;
$i = 0;
while (!$transaction_details_delete->Recordset->EOF) {
	$transaction_details_delete->RecCnt++;
	$transaction_details_delete->RowCnt++;

	// Set row properties
	$transaction_details->resetAttributes();
	$transaction_details->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$transaction_details_delete->loadRowValues($transaction_details_delete->Recordset);

	// Render row
	$transaction_details_delete->renderRow();
?>
	<tr<?php echo $transaction_details->rowAttributes() ?>>
<?php if ($transaction_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
		<td<?php echo $transaction_details->firelink_doc_no->cellAttributes() ?>>
<span id="el<?php echo $transaction_details_delete->RowCnt ?>_transaction_details_firelink_doc_no" class="transaction_details_firelink_doc_no">
<span<?php echo $transaction_details->firelink_doc_no->viewAttributes() ?>>
<?php if ((!EmptyString($transaction_details->firelink_doc_no->getViewValue())) && $transaction_details->firelink_doc_no->linkAttributes() <> "") { ?>
<a<?php echo $transaction_details->firelink_doc_no->linkAttributes() ?>><?php echo $transaction_details->firelink_doc_no->getViewValue() ?></a>
<?php } else { ?>
<?php echo $transaction_details->firelink_doc_no->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($transaction_details->project_name->Visible) { // project_name ?>
		<td<?php echo $transaction_details->project_name->cellAttributes() ?>>
<span id="el<?php echo $transaction_details_delete->RowCnt ?>_transaction_details_project_name" class="transaction_details_project_name">
<span<?php echo $transaction_details->project_name->viewAttributes() ?>>
<?php echo $transaction_details->project_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transaction_details->document_tittle->Visible) { // document_tittle ?>
		<td<?php echo $transaction_details->document_tittle->cellAttributes() ?>>
<span id="el<?php echo $transaction_details_delete->RowCnt ?>_transaction_details_document_tittle" class="transaction_details_document_tittle">
<span<?php echo $transaction_details->document_tittle->viewAttributes() ?>>
<?php echo $transaction_details->document_tittle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transaction_details->submit_no->Visible) { // submit_no ?>
		<td<?php echo $transaction_details->submit_no->cellAttributes() ?>>
<span id="el<?php echo $transaction_details_delete->RowCnt ?>_transaction_details_submit_no" class="transaction_details_submit_no">
<span<?php echo $transaction_details->submit_no->viewAttributes() ?>>
<?php echo $transaction_details->submit_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transaction_details->revision_no->Visible) { // revision_no ?>
		<td<?php echo $transaction_details->revision_no->cellAttributes() ?>>
<span id="el<?php echo $transaction_details_delete->RowCnt ?>_transaction_details_revision_no" class="transaction_details_revision_no">
<span<?php echo $transaction_details->revision_no->viewAttributes() ?>>
<?php echo $transaction_details->revision_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transaction_details->transmit_no->Visible) { // transmit_no ?>
		<td<?php echo $transaction_details->transmit_no->cellAttributes() ?>>
<span id="el<?php echo $transaction_details_delete->RowCnt ?>_transaction_details_transmit_no" class="transaction_details_transmit_no">
<span<?php echo $transaction_details->transmit_no->viewAttributes() ?>>
<?php echo $transaction_details->transmit_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transaction_details->transmit_date->Visible) { // transmit_date ?>
		<td<?php echo $transaction_details->transmit_date->cellAttributes() ?>>
<span id="el<?php echo $transaction_details_delete->RowCnt ?>_transaction_details_transmit_date" class="transaction_details_transmit_date">
<span<?php echo $transaction_details->transmit_date->viewAttributes() ?>>
<?php echo $transaction_details->transmit_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transaction_details->direction->Visible) { // direction ?>
		<td<?php echo $transaction_details->direction->cellAttributes() ?>>
<span id="el<?php echo $transaction_details_delete->RowCnt ?>_transaction_details_direction" class="transaction_details_direction">
<span<?php echo $transaction_details->direction->viewAttributes() ?>>
<?php echo $transaction_details->direction->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transaction_details->approval_status->Visible) { // approval_status ?>
		<td<?php echo $transaction_details->approval_status->cellAttributes() ?>>
<span id="el<?php echo $transaction_details_delete->RowCnt ?>_transaction_details_approval_status" class="transaction_details_approval_status">
<span<?php echo $transaction_details->approval_status->viewAttributes() ?>>
<?php echo $transaction_details->approval_status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transaction_details->document_link->Visible) { // document_link ?>
		<td<?php echo $transaction_details->document_link->cellAttributes() ?>>
<span id="el<?php echo $transaction_details_delete->RowCnt ?>_transaction_details_document_link" class="transaction_details_document_link">
<span<?php echo $transaction_details->document_link->viewAttributes() ?>>
<?php echo GetFileViewTag($transaction_details->document_link, $transaction_details->document_link->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($transaction_details->document_native->Visible) { // document_native ?>
		<td<?php echo $transaction_details->document_native->cellAttributes() ?>>
<span id="el<?php echo $transaction_details_delete->RowCnt ?>_transaction_details_document_native" class="transaction_details_document_native">
<span<?php echo $transaction_details->document_native->viewAttributes() ?>>
<?php echo $transaction_details->document_native->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($transaction_details->expiry_date->Visible) { // expiry_date ?>
		<td<?php echo $transaction_details->expiry_date->cellAttributes() ?>>
<span id="el<?php echo $transaction_details_delete->RowCnt ?>_transaction_details_expiry_date" class="transaction_details_expiry_date">
<span<?php echo $transaction_details->expiry_date->viewAttributes() ?>>
<?php if ((!EmptyString($transaction_details->expiry_date->TooltipValue)) && $transaction_details->expiry_date->linkAttributes() <> "") { ?>
<a<?php echo $transaction_details->expiry_date->linkAttributes() ?>><?php echo $transaction_details->expiry_date->getViewValue() ?></a>
<?php } else { ?>
<?php echo $transaction_details->expiry_date->getViewValue() ?>
<?php } ?>
<span id="tt_transaction_details_x_expiry_date" class="d-none">
<?php echo $transaction_details->expiry_date->TooltipValue ?>
</span></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$transaction_details_delete->Recordset->moveNext();
}
$transaction_details_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $transaction_details_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$transaction_details_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$transaction_details_delete->terminate();
?>