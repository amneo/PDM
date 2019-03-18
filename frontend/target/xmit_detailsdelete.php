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
$xmit_details_delete = new xmit_details_delete();

// Run the page
$xmit_details_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$xmit_details_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fxmit_detailsdelete = currentForm = new ew.Form("fxmit_detailsdelete", "delete");

// Form_CustomValidate event
fxmit_detailsdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fxmit_detailsdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $xmit_details_delete->showPageHeader(); ?>
<?php
$xmit_details_delete->showMessage();
?>
<form name="fxmit_detailsdelete" id="fxmit_detailsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($xmit_details_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $xmit_details_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="xmit_details">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($xmit_details_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($xmit_details->xmit_id->Visible) { // xmit_id ?>
		<th class="<?php echo $xmit_details->xmit_id->headerCellClass() ?>"><span id="elh_xmit_details_xmit_id" class="xmit_details_xmit_id"><?php echo $xmit_details->xmit_id->caption() ?></span></th>
<?php } ?>
<?php if ($xmit_details->xmit_mode->Visible) { // xmit_mode ?>
		<th class="<?php echo $xmit_details->xmit_mode->headerCellClass() ?>"><span id="elh_xmit_details_xmit_mode" class="xmit_details_xmit_mode"><?php echo $xmit_details->xmit_mode->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$xmit_details_delete->RecCnt = 0;
$i = 0;
while (!$xmit_details_delete->Recordset->EOF) {
	$xmit_details_delete->RecCnt++;
	$xmit_details_delete->RowCnt++;

	// Set row properties
	$xmit_details->resetAttributes();
	$xmit_details->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$xmit_details_delete->loadRowValues($xmit_details_delete->Recordset);

	// Render row
	$xmit_details_delete->renderRow();
?>
	<tr<?php echo $xmit_details->rowAttributes() ?>>
<?php if ($xmit_details->xmit_id->Visible) { // xmit_id ?>
		<td<?php echo $xmit_details->xmit_id->cellAttributes() ?>>
<span id="el<?php echo $xmit_details_delete->RowCnt ?>_xmit_details_xmit_id" class="xmit_details_xmit_id">
<span<?php echo $xmit_details->xmit_id->viewAttributes() ?>>
<?php echo $xmit_details->xmit_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($xmit_details->xmit_mode->Visible) { // xmit_mode ?>
		<td<?php echo $xmit_details->xmit_mode->cellAttributes() ?>>
<span id="el<?php echo $xmit_details_delete->RowCnt ?>_xmit_details_xmit_mode" class="xmit_details_xmit_mode">
<span<?php echo $xmit_details->xmit_mode->viewAttributes() ?>>
<?php echo $xmit_details->xmit_mode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$xmit_details_delete->Recordset->moveNext();
}
$xmit_details_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $xmit_details_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$xmit_details_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$xmit_details_delete->terminate();
?>