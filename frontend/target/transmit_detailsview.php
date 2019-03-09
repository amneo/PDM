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
$transmit_details_view = new transmit_details_view();

// Run the page
$transmit_details_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transmit_details_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$transmit_details->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftransmit_detailsview = currentForm = new ew.Form("ftransmit_detailsview", "view");

// Form_CustomValidate event
ftransmit_detailsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftransmit_detailsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftransmit_detailsview.lists["x_project_name"] = <?php echo $transmit_details_view->project_name->Lookup->toClientList() ?>;
ftransmit_detailsview.lists["x_project_name"].options = <?php echo JsonEncode($transmit_details_view->project_name->lookupOptions()) ?>;
ftransmit_detailsview.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftransmit_detailsview.lists["x_ack_rcvd"] = <?php echo $transmit_details_view->ack_rcvd->Lookup->toClientList() ?>;
ftransmit_detailsview.lists["x_ack_rcvd"].options = <?php echo JsonEncode($transmit_details_view->ack_rcvd->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$transmit_details->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $transmit_details_view->ExportOptions->render("body") ?>
<?php $transmit_details_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $transmit_details_view->showPageHeader(); ?>
<?php
$transmit_details_view->showMessage();
?>
<form name="ftransmit_detailsview" id="ftransmit_detailsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($transmit_details_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $transmit_details_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transmit_details">
<input type="hidden" name="modal" value="<?php echo (int)$transmit_details_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($transmit_details->transmittal_no->Visible) { // transmittal_no ?>
	<tr id="r_transmittal_no">
		<td class="<?php echo $transmit_details_view->TableLeftColumnClass ?>"><span id="elh_transmit_details_transmittal_no"><?php echo $transmit_details->transmittal_no->caption() ?></span></td>
		<td data-name="transmittal_no"<?php echo $transmit_details->transmittal_no->cellAttributes() ?>>
<span id="el_transmit_details_transmittal_no">
<span<?php echo $transmit_details->transmittal_no->viewAttributes() ?>>
<?php echo $transmit_details->transmittal_no->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transmit_details->project_name->Visible) { // project_name ?>
	<tr id="r_project_name">
		<td class="<?php echo $transmit_details_view->TableLeftColumnClass ?>"><span id="elh_transmit_details_project_name"><?php echo $transmit_details->project_name->caption() ?></span></td>
		<td data-name="project_name"<?php echo $transmit_details->project_name->cellAttributes() ?>>
<span id="el_transmit_details_project_name">
<span<?php echo $transmit_details->project_name->viewAttributes() ?>>
<?php echo $transmit_details->project_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transmit_details->delivery_location->Visible) { // delivery_location ?>
	<tr id="r_delivery_location">
		<td class="<?php echo $transmit_details_view->TableLeftColumnClass ?>"><span id="elh_transmit_details_delivery_location"><?php echo $transmit_details->delivery_location->caption() ?></span></td>
		<td data-name="delivery_location"<?php echo $transmit_details->delivery_location->cellAttributes() ?>>
<span id="el_transmit_details_delivery_location">
<span<?php echo $transmit_details->delivery_location->viewAttributes() ?>>
<?php echo $transmit_details->delivery_location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transmit_details->addressed_to->Visible) { // addressed_to ?>
	<tr id="r_addressed_to">
		<td class="<?php echo $transmit_details_view->TableLeftColumnClass ?>"><span id="elh_transmit_details_addressed_to"><?php echo $transmit_details->addressed_to->caption() ?></span></td>
		<td data-name="addressed_to"<?php echo $transmit_details->addressed_to->cellAttributes() ?>>
<span id="el_transmit_details_addressed_to">
<span<?php echo $transmit_details->addressed_to->viewAttributes() ?>>
<?php echo $transmit_details->addressed_to->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transmit_details->remarks->Visible) { // remarks ?>
	<tr id="r_remarks">
		<td class="<?php echo $transmit_details_view->TableLeftColumnClass ?>"><span id="elh_transmit_details_remarks"><?php echo $transmit_details->remarks->caption() ?></span></td>
		<td data-name="remarks"<?php echo $transmit_details->remarks->cellAttributes() ?>>
<span id="el_transmit_details_remarks">
<span<?php echo $transmit_details->remarks->viewAttributes() ?>>
<?php echo $transmit_details->remarks->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transmit_details->ack_rcvd->Visible) { // ack_rcvd ?>
	<tr id="r_ack_rcvd">
		<td class="<?php echo $transmit_details_view->TableLeftColumnClass ?>"><span id="elh_transmit_details_ack_rcvd"><?php echo $transmit_details->ack_rcvd->caption() ?></span></td>
		<td data-name="ack_rcvd"<?php echo $transmit_details->ack_rcvd->cellAttributes() ?>>
<span id="el_transmit_details_ack_rcvd">
<span<?php echo $transmit_details->ack_rcvd->viewAttributes() ?>>
<?php echo $transmit_details->ack_rcvd->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transmit_details->ack_document->Visible) { // ack_document ?>
	<tr id="r_ack_document">
		<td class="<?php echo $transmit_details_view->TableLeftColumnClass ?>"><span id="elh_transmit_details_ack_document"><?php echo $transmit_details->ack_document->caption() ?></span></td>
		<td data-name="ack_document"<?php echo $transmit_details->ack_document->cellAttributes() ?>>
<span id="el_transmit_details_ack_document">
<span<?php echo $transmit_details->ack_document->viewAttributes() ?>>
<?php echo GetFileViewTag($transmit_details->ack_document, $transmit_details->ack_document->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transmit_details->transmital_date->Visible) { // transmital_date ?>
	<tr id="r_transmital_date">
		<td class="<?php echo $transmit_details_view->TableLeftColumnClass ?>"><span id="elh_transmit_details_transmital_date"><?php echo $transmit_details->transmital_date->caption() ?></span></td>
		<td data-name="transmital_date"<?php echo $transmit_details->transmital_date->cellAttributes() ?>>
<span id="el_transmit_details_transmital_date">
<span<?php echo $transmit_details->transmital_date->viewAttributes() ?>>
<?php echo $transmit_details->transmital_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$transmit_details_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$transmit_details->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$transmit_details_view->terminate();
?>