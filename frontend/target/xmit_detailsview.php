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
$xmit_details_view = new xmit_details_view();

// Run the page
$xmit_details_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$xmit_details_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$xmit_details->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fxmit_detailsview = currentForm = new ew.Form("fxmit_detailsview", "view");

// Form_CustomValidate event
fxmit_detailsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fxmit_detailsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$xmit_details->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $xmit_details_view->ExportOptions->render("body") ?>
<?php $xmit_details_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $xmit_details_view->showPageHeader(); ?>
<?php
$xmit_details_view->showMessage();
?>
<form name="fxmit_detailsview" id="fxmit_detailsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($xmit_details_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $xmit_details_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="xmit_details">
<input type="hidden" name="modal" value="<?php echo (int)$xmit_details_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($xmit_details->xmit_id->Visible) { // xmit_id ?>
	<tr id="r_xmit_id">
		<td class="<?php echo $xmit_details_view->TableLeftColumnClass ?>"><span id="elh_xmit_details_xmit_id"><?php echo $xmit_details->xmit_id->caption() ?></span></td>
		<td data-name="xmit_id"<?php echo $xmit_details->xmit_id->cellAttributes() ?>>
<span id="el_xmit_details_xmit_id">
<span<?php echo $xmit_details->xmit_id->viewAttributes() ?>>
<?php echo $xmit_details->xmit_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($xmit_details->xmit_mode->Visible) { // xmit_mode ?>
	<tr id="r_xmit_mode">
		<td class="<?php echo $xmit_details_view->TableLeftColumnClass ?>"><span id="elh_xmit_details_xmit_mode"><?php echo $xmit_details->xmit_mode->caption() ?></span></td>
		<td data-name="xmit_mode"<?php echo $xmit_details->xmit_mode->cellAttributes() ?>>
<span id="el_xmit_details_xmit_mode">
<span<?php echo $xmit_details->xmit_mode->viewAttributes() ?>>
<?php echo $xmit_details->xmit_mode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$xmit_details_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$xmit_details->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$xmit_details_view->terminate();
?>