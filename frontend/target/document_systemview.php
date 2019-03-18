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
$document_system_view = new document_system_view();

// Run the page
$document_system_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_system_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$document_system->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fdocument_systemview = currentForm = new ew.Form("fdocument_systemview", "view");

// Form_CustomValidate event
fdocument_systemview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_systemview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$document_system->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $document_system_view->ExportOptions->render("body") ?>
<?php $document_system_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $document_system_view->showPageHeader(); ?>
<?php
$document_system_view->showMessage();
?>
<form name="fdocument_systemview" id="fdocument_systemview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_system_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_system_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_system">
<input type="hidden" name="modal" value="<?php echo (int)$document_system_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($document_system->type_id->Visible) { // type_id ?>
	<tr id="r_type_id">
		<td class="<?php echo $document_system_view->TableLeftColumnClass ?>"><span id="elh_document_system_type_id"><?php echo $document_system->type_id->caption() ?></span></td>
		<td data-name="type_id"<?php echo $document_system->type_id->cellAttributes() ?>>
<span id="el_document_system_type_id">
<span<?php echo $document_system->type_id->viewAttributes() ?>>
<?php echo $document_system->type_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_system->system_name->Visible) { // system_name ?>
	<tr id="r_system_name">
		<td class="<?php echo $document_system_view->TableLeftColumnClass ?>"><span id="elh_document_system_system_name"><?php echo $document_system->system_name->caption() ?></span></td>
		<td data-name="system_name"<?php echo $document_system->system_name->cellAttributes() ?>>
<span id="el_document_system_system_name">
<span<?php echo $document_system->system_name->viewAttributes() ?>>
<?php echo $document_system->system_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($document_system->system_group->Visible) { // system_group ?>
	<tr id="r_system_group">
		<td class="<?php echo $document_system_view->TableLeftColumnClass ?>"><span id="elh_document_system_system_group"><?php echo $document_system->system_group->caption() ?></span></td>
		<td data-name="system_group"<?php echo $document_system->system_group->cellAttributes() ?>>
<span id="el_document_system_system_group">
<span<?php echo $document_system->system_group->viewAttributes() ?>>
<?php echo $document_system->system_group->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$document_system_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$document_system->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$document_system_view->terminate();
?>