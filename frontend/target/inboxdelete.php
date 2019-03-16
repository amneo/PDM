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
$inbox_delete = new inbox_delete();

// Run the page
$inbox_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inbox_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var finboxdelete = currentForm = new ew.Form("finboxdelete", "delete");

// Form_CustomValidate event
finboxdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finboxdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $inbox_delete->showPageHeader(); ?>
<?php
$inbox_delete->showMessage();
?>
<form name="finboxdelete" id="finboxdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inbox_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inbox_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inbox">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($inbox_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($inbox->from->Visible) { // from ?>
		<th class="<?php echo $inbox->from->headerCellClass() ?>"><span id="elh_inbox_from" class="inbox_from"><?php echo $inbox->from->caption() ?></span></th>
<?php } ?>
<?php if ($inbox->project_name->Visible) { // project_name ?>
		<th class="<?php echo $inbox->project_name->headerCellClass() ?>"><span id="elh_inbox_project_name" class="inbox_project_name"><?php echo $inbox->project_name->caption() ?></span></th>
<?php } ?>
<?php if ($inbox->client_send_to->Visible) { // client_send_to ?>
		<th class="<?php echo $inbox->client_send_to->headerCellClass() ?>"><span id="elh_inbox_client_send_to" class="inbox_client_send_to"><?php echo $inbox->client_send_to->caption() ?></span></th>
<?php } ?>
<?php if ($inbox->mode_send->Visible) { // mode_send ?>
		<th class="<?php echo $inbox->mode_send->headerCellClass() ?>"><span id="elh_inbox_mode_send" class="inbox_mode_send"><?php echo $inbox->mode_send->caption() ?></span></th>
<?php } ?>
<?php if ($inbox->remarks->Visible) { // remarks ?>
		<th class="<?php echo $inbox->remarks->headerCellClass() ?>"><span id="elh_inbox_remarks" class="inbox_remarks"><?php echo $inbox->remarks->caption() ?></span></th>
<?php } ?>
<?php if ($inbox->document_link->Visible) { // document_link ?>
		<th class="<?php echo $inbox->document_link->headerCellClass() ?>"><span id="elh_inbox_document_link" class="inbox_document_link"><?php echo $inbox->document_link->caption() ?></span></th>
<?php } ?>
<?php if ($inbox->native_file_link->Visible) { // native_file_link ?>
		<th class="<?php echo $inbox->native_file_link->headerCellClass() ?>"><span id="elh_inbox_native_file_link" class="inbox_native_file_link"><?php echo $inbox->native_file_link->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$inbox_delete->RecCnt = 0;
$i = 0;
while (!$inbox_delete->Recordset->EOF) {
	$inbox_delete->RecCnt++;
	$inbox_delete->RowCnt++;

	// Set row properties
	$inbox->resetAttributes();
	$inbox->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$inbox_delete->loadRowValues($inbox_delete->Recordset);

	// Render row
	$inbox_delete->renderRow();
?>
	<tr<?php echo $inbox->rowAttributes() ?>>
<?php if ($inbox->from->Visible) { // from ?>
		<td<?php echo $inbox->from->cellAttributes() ?>>
<span id="el<?php echo $inbox_delete->RowCnt ?>_inbox_from" class="inbox_from">
<span<?php echo $inbox->from->viewAttributes() ?>>
<?php echo $inbox->from->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inbox->project_name->Visible) { // project_name ?>
		<td<?php echo $inbox->project_name->cellAttributes() ?>>
<span id="el<?php echo $inbox_delete->RowCnt ?>_inbox_project_name" class="inbox_project_name">
<span<?php echo $inbox->project_name->viewAttributes() ?>>
<?php echo $inbox->project_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inbox->client_send_to->Visible) { // client_send_to ?>
		<td<?php echo $inbox->client_send_to->cellAttributes() ?>>
<span id="el<?php echo $inbox_delete->RowCnt ?>_inbox_client_send_to" class="inbox_client_send_to">
<span<?php echo $inbox->client_send_to->viewAttributes() ?>>
<?php echo $inbox->client_send_to->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inbox->mode_send->Visible) { // mode_send ?>
		<td<?php echo $inbox->mode_send->cellAttributes() ?>>
<span id="el<?php echo $inbox_delete->RowCnt ?>_inbox_mode_send" class="inbox_mode_send">
<span<?php echo $inbox->mode_send->viewAttributes() ?>>
<?php echo $inbox->mode_send->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inbox->remarks->Visible) { // remarks ?>
		<td<?php echo $inbox->remarks->cellAttributes() ?>>
<span id="el<?php echo $inbox_delete->RowCnt ?>_inbox_remarks" class="inbox_remarks">
<span<?php echo $inbox->remarks->viewAttributes() ?>>
<?php echo $inbox->remarks->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inbox->document_link->Visible) { // document_link ?>
		<td<?php echo $inbox->document_link->cellAttributes() ?>>
<span id="el<?php echo $inbox_delete->RowCnt ?>_inbox_document_link" class="inbox_document_link">
<span<?php echo $inbox->document_link->viewAttributes() ?>>
<?php echo GetFileViewTag($inbox->document_link, $inbox->document_link->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($inbox->native_file_link->Visible) { // native_file_link ?>
		<td<?php echo $inbox->native_file_link->cellAttributes() ?>>
<span id="el<?php echo $inbox_delete->RowCnt ?>_inbox_native_file_link" class="inbox_native_file_link">
<span<?php echo $inbox->native_file_link->viewAttributes() ?>>
<?php echo $inbox->native_file_link->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$inbox_delete->Recordset->moveNext();
}
$inbox_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $inbox_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$inbox_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inbox_delete->terminate();
?>