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
$distribution_details_delete = new distribution_details_delete();

// Run the page
$distribution_details_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$distribution_details_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fdistribution_detailsdelete = currentForm = new ew.Form("fdistribution_detailsdelete", "delete");

// Form_CustomValidate event
fdistribution_detailsdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdistribution_detailsdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdistribution_detailsdelete.lists["x_project_name"] = <?php echo $distribution_details_delete->project_name->Lookup->toClientList() ?>;
fdistribution_detailsdelete.lists["x_project_name"].options = <?php echo JsonEncode($distribution_details_delete->project_name->lookupOptions()) ?>;
fdistribution_detailsdelete.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdistribution_detailsdelete.lists["x_distribution_valid"] = <?php echo $distribution_details_delete->distribution_valid->Lookup->toClientList() ?>;
fdistribution_detailsdelete.lists["x_distribution_valid"].options = <?php echo JsonEncode($distribution_details_delete->distribution_valid->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $distribution_details_delete->showPageHeader(); ?>
<?php
$distribution_details_delete->showMessage();
?>
<form name="fdistribution_detailsdelete" id="fdistribution_detailsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($distribution_details_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $distribution_details_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="distribution_details">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($distribution_details_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($distribution_details->to_Name->Visible) { // to_Name ?>
		<th class="<?php echo $distribution_details->to_Name->headerCellClass() ?>"><span id="elh_distribution_details_to_Name" class="distribution_details_to_Name"><?php echo $distribution_details->to_Name->caption() ?></span></th>
<?php } ?>
<?php if ($distribution_details->email_address->Visible) { // email_address ?>
		<th class="<?php echo $distribution_details->email_address->headerCellClass() ?>"><span id="elh_distribution_details_email_address" class="distribution_details_email_address"><?php echo $distribution_details->email_address->caption() ?></span></th>
<?php } ?>
<?php if ($distribution_details->project_name->Visible) { // project_name ?>
		<th class="<?php echo $distribution_details->project_name->headerCellClass() ?>"><span id="elh_distribution_details_project_name" class="distribution_details_project_name"><?php echo $distribution_details->project_name->caption() ?></span></th>
<?php } ?>
<?php if ($distribution_details->distribution_valid->Visible) { // distribution_valid ?>
		<th class="<?php echo $distribution_details->distribution_valid->headerCellClass() ?>"><span id="elh_distribution_details_distribution_valid" class="distribution_details_distribution_valid"><?php echo $distribution_details->distribution_valid->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$distribution_details_delete->RecCnt = 0;
$i = 0;
while (!$distribution_details_delete->Recordset->EOF) {
	$distribution_details_delete->RecCnt++;
	$distribution_details_delete->RowCnt++;

	// Set row properties
	$distribution_details->resetAttributes();
	$distribution_details->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$distribution_details_delete->loadRowValues($distribution_details_delete->Recordset);

	// Render row
	$distribution_details_delete->renderRow();
?>
	<tr<?php echo $distribution_details->rowAttributes() ?>>
<?php if ($distribution_details->to_Name->Visible) { // to_Name ?>
		<td<?php echo $distribution_details->to_Name->cellAttributes() ?>>
<span id="el<?php echo $distribution_details_delete->RowCnt ?>_distribution_details_to_Name" class="distribution_details_to_Name">
<span<?php echo $distribution_details->to_Name->viewAttributes() ?>>
<?php echo $distribution_details->to_Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($distribution_details->email_address->Visible) { // email_address ?>
		<td<?php echo $distribution_details->email_address->cellAttributes() ?>>
<span id="el<?php echo $distribution_details_delete->RowCnt ?>_distribution_details_email_address" class="distribution_details_email_address">
<span<?php echo $distribution_details->email_address->viewAttributes() ?>>
<?php echo $distribution_details->email_address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($distribution_details->project_name->Visible) { // project_name ?>
		<td<?php echo $distribution_details->project_name->cellAttributes() ?>>
<span id="el<?php echo $distribution_details_delete->RowCnt ?>_distribution_details_project_name" class="distribution_details_project_name">
<span<?php echo $distribution_details->project_name->viewAttributes() ?>>
<?php echo $distribution_details->project_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($distribution_details->distribution_valid->Visible) { // distribution_valid ?>
		<td<?php echo $distribution_details->distribution_valid->cellAttributes() ?>>
<span id="el<?php echo $distribution_details_delete->RowCnt ?>_distribution_details_distribution_valid" class="distribution_details_distribution_valid">
<span<?php echo $distribution_details->distribution_valid->viewAttributes() ?>>
<?php echo $distribution_details->distribution_valid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$distribution_details_delete->Recordset->moveNext();
}
$distribution_details_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $distribution_details_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$distribution_details_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$distribution_details_delete->terminate();
?>