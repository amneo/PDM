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
$document_details_delete = new document_details_delete();

// Run the page
$document_details_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_details_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fdocument_detailsdelete = currentForm = new ew.Form("fdocument_detailsdelete", "delete");

// Form_CustomValidate event
fdocument_detailsdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_detailsdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdocument_detailsdelete.lists["x_project_name"] = <?php echo $document_details_delete->project_name->Lookup->toClientList() ?>;
fdocument_detailsdelete.lists["x_project_name"].options = <?php echo JsonEncode($document_details_delete->project_name->lookupOptions()) ?>;
fdocument_detailsdelete.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdocument_detailsdelete.lists["x_project_system"] = <?php echo $document_details_delete->project_system->Lookup->toClientList() ?>;
fdocument_detailsdelete.lists["x_project_system"].options = <?php echo JsonEncode($document_details_delete->project_system->lookupOptions()) ?>;
fdocument_detailsdelete.lists["x_document_type"] = <?php echo $document_details_delete->document_type->Lookup->toClientList() ?>;
fdocument_detailsdelete.lists["x_document_type"].options = <?php echo JsonEncode($document_details_delete->document_type->lookupOptions()) ?>;
fdocument_detailsdelete.autoSuggests["x_document_type"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $document_details_delete->showPageHeader(); ?>
<?php
$document_details_delete->showMessage();
?>
<form name="fdocument_detailsdelete" id="fdocument_detailsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_details_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_details_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_details">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($document_details_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($document_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
		<th class="<?php echo $document_details->firelink_doc_no->headerCellClass() ?>"><span id="elh_document_details_firelink_doc_no" class="document_details_firelink_doc_no"><?php echo $document_details->firelink_doc_no->caption() ?></span></th>
<?php } ?>
<?php if ($document_details->client_doc_no->Visible) { // client_doc_no ?>
		<th class="<?php echo $document_details->client_doc_no->headerCellClass() ?>"><span id="elh_document_details_client_doc_no" class="document_details_client_doc_no"><?php echo $document_details->client_doc_no->caption() ?></span></th>
<?php } ?>
<?php if ($document_details->document_tittle->Visible) { // document_tittle ?>
		<th class="<?php echo $document_details->document_tittle->headerCellClass() ?>"><span id="elh_document_details_document_tittle" class="document_details_document_tittle"><?php echo $document_details->document_tittle->caption() ?></span></th>
<?php } ?>
<?php if ($document_details->project_name->Visible) { // project_name ?>
		<th class="<?php echo $document_details->project_name->headerCellClass() ?>"><span id="elh_document_details_project_name" class="document_details_project_name"><?php echo $document_details->project_name->caption() ?></span></th>
<?php } ?>
<?php if ($document_details->project_system->Visible) { // project_system ?>
		<th class="<?php echo $document_details->project_system->headerCellClass() ?>"><span id="elh_document_details_project_system" class="document_details_project_system"><?php echo $document_details->project_system->caption() ?></span></th>
<?php } ?>
<?php if ($document_details->planned_date->Visible) { // planned_date ?>
		<th class="<?php echo $document_details->planned_date->headerCellClass() ?>"><span id="elh_document_details_planned_date" class="document_details_planned_date"><?php echo $document_details->planned_date->caption() ?></span></th>
<?php } ?>
<?php if ($document_details->document_type->Visible) { // document_type ?>
		<th class="<?php echo $document_details->document_type->headerCellClass() ?>"><span id="elh_document_details_document_type" class="document_details_document_type"><?php echo $document_details->document_type->caption() ?></span></th>
<?php } ?>
<?php if ($document_details->expiry_date->Visible) { // expiry_date ?>
		<th class="<?php echo $document_details->expiry_date->headerCellClass() ?>"><span id="elh_document_details_expiry_date" class="document_details_expiry_date"><?php echo $document_details->expiry_date->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$document_details_delete->RecCnt = 0;
$i = 0;
while (!$document_details_delete->Recordset->EOF) {
	$document_details_delete->RecCnt++;
	$document_details_delete->RowCnt++;

	// Set row properties
	$document_details->resetAttributes();
	$document_details->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$document_details_delete->loadRowValues($document_details_delete->Recordset);

	// Render row
	$document_details_delete->renderRow();
?>
	<tr<?php echo $document_details->rowAttributes() ?>>
<?php if ($document_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
		<td<?php echo $document_details->firelink_doc_no->cellAttributes() ?>>
<span id="el<?php echo $document_details_delete->RowCnt ?>_document_details_firelink_doc_no" class="document_details_firelink_doc_no">
<span<?php echo $document_details->firelink_doc_no->viewAttributes() ?>>
<?php echo $document_details->firelink_doc_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_details->client_doc_no->Visible) { // client_doc_no ?>
		<td<?php echo $document_details->client_doc_no->cellAttributes() ?>>
<span id="el<?php echo $document_details_delete->RowCnt ?>_document_details_client_doc_no" class="document_details_client_doc_no">
<span<?php echo $document_details->client_doc_no->viewAttributes() ?>>
<?php echo $document_details->client_doc_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_details->document_tittle->Visible) { // document_tittle ?>
		<td<?php echo $document_details->document_tittle->cellAttributes() ?>>
<span id="el<?php echo $document_details_delete->RowCnt ?>_document_details_document_tittle" class="document_details_document_tittle">
<span<?php echo $document_details->document_tittle->viewAttributes() ?>>
<?php echo $document_details->document_tittle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_details->project_name->Visible) { // project_name ?>
		<td<?php echo $document_details->project_name->cellAttributes() ?>>
<span id="el<?php echo $document_details_delete->RowCnt ?>_document_details_project_name" class="document_details_project_name">
<span<?php echo $document_details->project_name->viewAttributes() ?>>
<?php echo $document_details->project_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_details->project_system->Visible) { // project_system ?>
		<td<?php echo $document_details->project_system->cellAttributes() ?>>
<span id="el<?php echo $document_details_delete->RowCnt ?>_document_details_project_system" class="document_details_project_system">
<span<?php echo $document_details->project_system->viewAttributes() ?>>
<?php echo $document_details->project_system->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_details->planned_date->Visible) { // planned_date ?>
		<td<?php echo $document_details->planned_date->cellAttributes() ?>>
<span id="el<?php echo $document_details_delete->RowCnt ?>_document_details_planned_date" class="document_details_planned_date">
<span<?php echo $document_details->planned_date->viewAttributes() ?>>
<?php echo $document_details->planned_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_details->document_type->Visible) { // document_type ?>
		<td<?php echo $document_details->document_type->cellAttributes() ?>>
<span id="el<?php echo $document_details_delete->RowCnt ?>_document_details_document_type" class="document_details_document_type">
<span<?php echo $document_details->document_type->viewAttributes() ?>>
<?php echo $document_details->document_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_details->expiry_date->Visible) { // expiry_date ?>
		<td<?php echo $document_details->expiry_date->cellAttributes() ?>>
<span id="el<?php echo $document_details_delete->RowCnt ?>_document_details_expiry_date" class="document_details_expiry_date">
<span<?php echo $document_details->expiry_date->viewAttributes() ?>>
<?php echo $document_details->expiry_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$document_details_delete->Recordset->moveNext();
}
$document_details_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $document_details_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$document_details_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$document_details_delete->terminate();
?>