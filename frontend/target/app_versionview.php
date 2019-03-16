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
$app_version_view = new app_version_view();

// Run the page
$app_version_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_version_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$app_version->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fapp_versionview = currentForm = new ew.Form("fapp_versionview", "view");

// Form_CustomValidate event
fapp_versionview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fapp_versionview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$app_version->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $app_version_view->ExportOptions->render("body") ?>
<?php $app_version_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $app_version_view->showPageHeader(); ?>
<?php
$app_version_view->showMessage();
?>
<form name="fapp_versionview" id="fapp_versionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($app_version_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $app_version_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_version">
<input type="hidden" name="modal" value="<?php echo (int)$app_version_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($app_version->sequence_no->Visible) { // sequence_no ?>
	<tr id="r_sequence_no">
		<td class="<?php echo $app_version_view->TableLeftColumnClass ?>"><span id="elh_app_version_sequence_no"><?php echo $app_version->sequence_no->caption() ?></span></td>
		<td data-name="sequence_no"<?php echo $app_version->sequence_no->cellAttributes() ?>>
<span id="el_app_version_sequence_no">
<span<?php echo $app_version->sequence_no->viewAttributes() ?>>
<?php echo $app_version->sequence_no->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_version->frontend_version->Visible) { // frontend_version ?>
	<tr id="r_frontend_version">
		<td class="<?php echo $app_version_view->TableLeftColumnClass ?>"><span id="elh_app_version_frontend_version"><?php echo $app_version->frontend_version->caption() ?></span></td>
		<td data-name="frontend_version"<?php echo $app_version->frontend_version->cellAttributes() ?>>
<span id="el_app_version_frontend_version">
<span<?php echo $app_version->frontend_version->viewAttributes() ?>>
<?php echo $app_version->frontend_version->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_version->backend_version->Visible) { // backend_version ?>
	<tr id="r_backend_version">
		<td class="<?php echo $app_version_view->TableLeftColumnClass ?>"><span id="elh_app_version_backend_version"><?php echo $app_version->backend_version->caption() ?></span></td>
		<td data-name="backend_version"<?php echo $app_version->backend_version->cellAttributes() ?>>
<span id="el_app_version_backend_version">
<span<?php echo $app_version->backend_version->viewAttributes() ?>>
<?php echo $app_version->backend_version->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_version->release_date->Visible) { // release_date ?>
	<tr id="r_release_date">
		<td class="<?php echo $app_version_view->TableLeftColumnClass ?>"><span id="elh_app_version_release_date"><?php echo $app_version->release_date->caption() ?></span></td>
		<td data-name="release_date"<?php echo $app_version->release_date->cellAttributes() ?>>
<span id="el_app_version_release_date">
<span<?php echo $app_version->release_date->viewAttributes() ?>>
<?php echo $app_version->release_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_version->posted_date->Visible) { // posted_date ?>
	<tr id="r_posted_date">
		<td class="<?php echo $app_version_view->TableLeftColumnClass ?>"><span id="elh_app_version_posted_date"><?php echo $app_version->posted_date->caption() ?></span></td>
		<td data-name="posted_date"<?php echo $app_version->posted_date->cellAttributes() ?>>
<span id="el_app_version_posted_date">
<span<?php echo $app_version->posted_date->viewAttributes() ?>>
<?php echo $app_version->posted_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($app_version->remarks->Visible) { // remarks ?>
	<tr id="r_remarks">
		<td class="<?php echo $app_version_view->TableLeftColumnClass ?>"><span id="elh_app_version_remarks"><?php echo $app_version->remarks->caption() ?></span></td>
		<td data-name="remarks"<?php echo $app_version->remarks->cellAttributes() ?>>
<span id="el_app_version_remarks">
<span<?php echo $app_version->remarks->viewAttributes() ?>>
<?php echo $app_version->remarks->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$app_version_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$app_version->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$app_version_view->terminate();
?>