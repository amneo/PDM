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
$app_version_delete = new app_version_delete();

// Run the page
$app_version_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_version_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fapp_versiondelete = currentForm = new ew.Form("fapp_versiondelete", "delete");

// Form_CustomValidate event
fapp_versiondelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fapp_versiondelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $app_version_delete->showPageHeader(); ?>
<?php
$app_version_delete->showMessage();
?>
<form name="fapp_versiondelete" id="fapp_versiondelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($app_version_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $app_version_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_version">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($app_version_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($app_version->release_date->Visible) { // release_date ?>
		<th class="<?php echo $app_version->release_date->headerCellClass() ?>"><span id="elh_app_version_release_date" class="app_version_release_date"><?php echo $app_version->release_date->caption() ?></span></th>
<?php } ?>
<?php if ($app_version->posted_date->Visible) { // posted_date ?>
		<th class="<?php echo $app_version->posted_date->headerCellClass() ?>"><span id="elh_app_version_posted_date" class="app_version_posted_date"><?php echo $app_version->posted_date->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$app_version_delete->RecCnt = 0;
$i = 0;
while (!$app_version_delete->Recordset->EOF) {
	$app_version_delete->RecCnt++;
	$app_version_delete->RowCnt++;

	// Set row properties
	$app_version->resetAttributes();
	$app_version->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$app_version_delete->loadRowValues($app_version_delete->Recordset);

	// Render row
	$app_version_delete->renderRow();
?>
	<tr<?php echo $app_version->rowAttributes() ?>>
<?php if ($app_version->release_date->Visible) { // release_date ?>
		<td<?php echo $app_version->release_date->cellAttributes() ?>>
<span id="el<?php echo $app_version_delete->RowCnt ?>_app_version_release_date" class="app_version_release_date">
<span<?php echo $app_version->release_date->viewAttributes() ?>>
<?php echo $app_version->release_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($app_version->posted_date->Visible) { // posted_date ?>
		<td<?php echo $app_version->posted_date->cellAttributes() ?>>
<span id="el<?php echo $app_version_delete->RowCnt ?>_app_version_posted_date" class="app_version_posted_date">
<span<?php echo $app_version->posted_date->viewAttributes() ?>>
<?php echo $app_version->posted_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$app_version_delete->Recordset->moveNext();
}
$app_version_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $app_version_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$app_version_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_version_delete->terminate();
?>