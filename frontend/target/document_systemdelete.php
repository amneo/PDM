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
$document_system_delete = new document_system_delete();

// Run the page
$document_system_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_system_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fdocument_systemdelete = currentForm = new ew.Form("fdocument_systemdelete", "delete");

// Form_CustomValidate event
fdocument_systemdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_systemdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $document_system_delete->showPageHeader(); ?>
<?php
$document_system_delete->showMessage();
?>
<form name="fdocument_systemdelete" id="fdocument_systemdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_system_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_system_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_system">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($document_system_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($document_system->system_name->Visible) { // system_name ?>
		<th class="<?php echo $document_system->system_name->headerCellClass() ?>"><span id="elh_document_system_system_name" class="document_system_system_name"><?php echo $document_system->system_name->caption() ?></span></th>
<?php } ?>
<?php if ($document_system->system_group->Visible) { // system_group ?>
		<th class="<?php echo $document_system->system_group->headerCellClass() ?>"><span id="elh_document_system_system_group" class="document_system_system_group"><?php echo $document_system->system_group->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$document_system_delete->RecCnt = 0;
$i = 0;
while (!$document_system_delete->Recordset->EOF) {
	$document_system_delete->RecCnt++;
	$document_system_delete->RowCnt++;

	// Set row properties
	$document_system->resetAttributes();
	$document_system->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$document_system_delete->loadRowValues($document_system_delete->Recordset);

	// Render row
	$document_system_delete->renderRow();
?>
	<tr<?php echo $document_system->rowAttributes() ?>>
<?php if ($document_system->system_name->Visible) { // system_name ?>
		<td<?php echo $document_system->system_name->cellAttributes() ?>>
<span id="el<?php echo $document_system_delete->RowCnt ?>_document_system_system_name" class="document_system_system_name">
<span<?php echo $document_system->system_name->viewAttributes() ?>>
<?php echo $document_system->system_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_system->system_group->Visible) { // system_group ?>
		<td<?php echo $document_system->system_group->cellAttributes() ?>>
<span id="el<?php echo $document_system_delete->RowCnt ?>_document_system_system_group" class="document_system_system_group">
<span<?php echo $document_system->system_group->viewAttributes() ?>>
<?php echo $document_system->system_group->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$document_system_delete->Recordset->moveNext();
}
$document_system_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $document_system_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$document_system_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$document_system_delete->terminate();
?>