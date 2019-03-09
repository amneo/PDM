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
$document_details_view = new document_details_view();

// Run the page
$document_details_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_details_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$document_details->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fdocument_detailsview = currentForm = new ew.Form("fdocument_detailsview", "view");

// Form_CustomValidate event
fdocument_detailsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_detailsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdocument_detailsview.lists["x_project_name"] = <?php echo $document_details_view->project_name->Lookup->toClientList() ?>;
fdocument_detailsview.lists["x_project_name"].options = <?php echo JsonEncode($document_details_view->project_name->lookupOptions()) ?>;
fdocument_detailsview.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$document_details->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $document_details_view->ExportOptions->render("body") ?>
<?php $document_details_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $document_details_view->showPageHeader(); ?>
<?php
$document_details_view->showMessage();
?>
<form name="fdocument_detailsview" id="fdocument_detailsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_details_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_details_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_details">
<input type="hidden" name="modal" value="<?php echo (int)$document_details_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($document_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
	<tr id="r_firelink_doc_no">
		<td class="<?php echo $document_details_view->TableLeftColumnClass ?>"><span id="elh_document_details_firelink_doc_no"><?php echo $document_details->firelink_doc_no->caption() ?></span></td>
		<td data-name="firelink_doc_no"<?php echo $document_details->firelink_doc_no->cellAttributes() ?>>
<span id="el_document_details_firelink_doc_no">
<span<?php echo $document_details->firelink_doc_no->viewAttributes() ?>>
<?php echo $document_details->firelink_doc_no->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_details->client_doc_no->Visible) { // client_doc_no ?>
	<tr id="r_client_doc_no">
		<td class="<?php echo $document_details_view->TableLeftColumnClass ?>"><span id="elh_document_details_client_doc_no"><?php echo $document_details->client_doc_no->caption() ?></span></td>
		<td data-name="client_doc_no"<?php echo $document_details->client_doc_no->cellAttributes() ?>>
<span id="el_document_details_client_doc_no">
<span<?php echo $document_details->client_doc_no->viewAttributes() ?>>
<?php echo $document_details->client_doc_no->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_details->document_tittle->Visible) { // document_tittle ?>
	<tr id="r_document_tittle">
		<td class="<?php echo $document_details_view->TableLeftColumnClass ?>"><span id="elh_document_details_document_tittle"><?php echo $document_details->document_tittle->caption() ?></span></td>
		<td data-name="document_tittle"<?php echo $document_details->document_tittle->cellAttributes() ?>>
<span id="el_document_details_document_tittle">
<span<?php echo $document_details->document_tittle->viewAttributes() ?>>
<?php echo $document_details->document_tittle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_details->project_name->Visible) { // project_name ?>
	<tr id="r_project_name">
		<td class="<?php echo $document_details_view->TableLeftColumnClass ?>"><span id="elh_document_details_project_name"><?php echo $document_details->project_name->caption() ?></span></td>
		<td data-name="project_name"<?php echo $document_details->project_name->cellAttributes() ?>>
<span id="el_document_details_project_name">
<span<?php echo $document_details->project_name->viewAttributes() ?>>
<?php echo $document_details->project_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_details->project_system->Visible) { // project_system ?>
	<tr id="r_project_system">
		<td class="<?php echo $document_details_view->TableLeftColumnClass ?>"><span id="elh_document_details_project_system"><?php echo $document_details->project_system->caption() ?></span></td>
		<td data-name="project_system"<?php echo $document_details->project_system->cellAttributes() ?>>
<span id="el_document_details_project_system">
<span<?php echo $document_details->project_system->viewAttributes() ?>>
<?php echo $document_details->project_system->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_details->planned_date->Visible) { // planned_date ?>
	<tr id="r_planned_date">
		<td class="<?php echo $document_details_view->TableLeftColumnClass ?>"><span id="elh_document_details_planned_date"><?php echo $document_details->planned_date->caption() ?></span></td>
		<td data-name="planned_date"<?php echo $document_details->planned_date->cellAttributes() ?>>
<span id="el_document_details_planned_date">
<span<?php echo $document_details->planned_date->viewAttributes() ?>>
<?php echo $document_details->planned_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_details->document_type->Visible) { // document_type ?>
	<tr id="r_document_type">
		<td class="<?php echo $document_details_view->TableLeftColumnClass ?>"><span id="elh_document_details_document_type"><?php echo $document_details->document_type->caption() ?></span></td>
		<td data-name="document_type"<?php echo $document_details->document_type->cellAttributes() ?>>
<span id="el_document_details_document_type">
<span<?php echo $document_details->document_type->viewAttributes() ?>>
<?php echo $document_details->document_type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_details->expiry_date->Visible) { // expiry_date ?>
	<tr id="r_expiry_date">
		<td class="<?php echo $document_details_view->TableLeftColumnClass ?>"><span id="elh_document_details_expiry_date"><?php echo $document_details->expiry_date->caption() ?></span></td>
		<td data-name="expiry_date"<?php echo $document_details->expiry_date->cellAttributes() ?>>
<span id="el_document_details_expiry_date">
<span<?php echo $document_details->expiry_date->viewAttributes() ?>>
<?php echo $document_details->expiry_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$document_details_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$document_details->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$document_details_view->terminate();
?>