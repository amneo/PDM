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
$inbox_view = new inbox_view();

// Run the page
$inbox_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inbox_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$inbox->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var finboxview = currentForm = new ew.Form("finboxview", "view");

// Form_CustomValidate event
finboxview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finboxview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$inbox->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $inbox_view->ExportOptions->render("body") ?>
<?php $inbox_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $inbox_view->showPageHeader(); ?>
<?php
$inbox_view->showMessage();
?>
<form name="finboxview" id="finboxview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inbox_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inbox_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inbox">
<input type="hidden" name="modal" value="<?php echo (int)$inbox_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($inbox->from->Visible) { // from ?>
	<tr id="r_from">
		<td class="<?php echo $inbox_view->TableLeftColumnClass ?>"><span id="elh_inbox_from"><?php echo $inbox->from->caption() ?></span></td>
		<td data-name="from"<?php echo $inbox->from->cellAttributes() ?>>
<span id="el_inbox_from">
<span<?php echo $inbox->from->viewAttributes() ?>>
<?php echo $inbox->from->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inbox->project_name->Visible) { // project_name ?>
	<tr id="r_project_name">
		<td class="<?php echo $inbox_view->TableLeftColumnClass ?>"><span id="elh_inbox_project_name"><?php echo $inbox->project_name->caption() ?></span></td>
		<td data-name="project_name"<?php echo $inbox->project_name->cellAttributes() ?>>
<span id="el_inbox_project_name">
<span<?php echo $inbox->project_name->viewAttributes() ?>>
<?php echo $inbox->project_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inbox->client_send_to->Visible) { // client_send_to ?>
	<tr id="r_client_send_to">
		<td class="<?php echo $inbox_view->TableLeftColumnClass ?>"><span id="elh_inbox_client_send_to"><?php echo $inbox->client_send_to->caption() ?></span></td>
		<td data-name="client_send_to"<?php echo $inbox->client_send_to->cellAttributes() ?>>
<span id="el_inbox_client_send_to">
<span<?php echo $inbox->client_send_to->viewAttributes() ?>>
<?php echo $inbox->client_send_to->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inbox->mode_send->Visible) { // mode_send ?>
	<tr id="r_mode_send">
		<td class="<?php echo $inbox_view->TableLeftColumnClass ?>"><span id="elh_inbox_mode_send"><?php echo $inbox->mode_send->caption() ?></span></td>
		<td data-name="mode_send"<?php echo $inbox->mode_send->cellAttributes() ?>>
<span id="el_inbox_mode_send">
<span<?php echo $inbox->mode_send->viewAttributes() ?>>
<?php echo $inbox->mode_send->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inbox->remarks->Visible) { // remarks ?>
	<tr id="r_remarks">
		<td class="<?php echo $inbox_view->TableLeftColumnClass ?>"><span id="elh_inbox_remarks"><?php echo $inbox->remarks->caption() ?></span></td>
		<td data-name="remarks"<?php echo $inbox->remarks->cellAttributes() ?>>
<span id="el_inbox_remarks">
<span<?php echo $inbox->remarks->viewAttributes() ?>>
<?php echo $inbox->remarks->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inbox->document_link->Visible) { // document_link ?>
	<tr id="r_document_link">
		<td class="<?php echo $inbox_view->TableLeftColumnClass ?>"><span id="elh_inbox_document_link"><?php echo $inbox->document_link->caption() ?></span></td>
		<td data-name="document_link"<?php echo $inbox->document_link->cellAttributes() ?>>
<span id="el_inbox_document_link">
<span<?php echo $inbox->document_link->viewAttributes() ?>>
<?php echo GetFileViewTag($inbox->document_link, $inbox->document_link->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inbox->native_file_link->Visible) { // native_file_link ?>
	<tr id="r_native_file_link">
		<td class="<?php echo $inbox_view->TableLeftColumnClass ?>"><span id="elh_inbox_native_file_link"><?php echo $inbox->native_file_link->caption() ?></span></td>
		<td data-name="native_file_link"<?php echo $inbox->native_file_link->cellAttributes() ?>>
<span id="el_inbox_native_file_link">
<span<?php echo $inbox->native_file_link->viewAttributes() ?>>
<?php echo $inbox->native_file_link->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$inbox_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$inbox->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$inbox_view->terminate();
?>