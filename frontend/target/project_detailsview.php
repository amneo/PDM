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
$project_details_view = new project_details_view();

// Run the page
$project_details_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_details_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$project_details->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fproject_detailsview = currentForm = new ew.Form("fproject_detailsview", "view");

// Form_CustomValidate event
fproject_detailsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproject_detailsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$project_details->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $project_details_view->ExportOptions->render("body") ?>
<?php $project_details_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $project_details_view->showPageHeader(); ?>
<?php
$project_details_view->showMessage();
?>
<form name="fproject_detailsview" id="fproject_detailsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($project_details_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $project_details_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_details">
<input type="hidden" name="modal" value="<?php echo (int)$project_details_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($project_details->project_name->Visible) { // project_name ?>
	<tr id="r_project_name">
		<td class="<?php echo $project_details_view->TableLeftColumnClass ?>"><span id="elh_project_details_project_name"><?php echo $project_details->project_name->caption() ?></span></td>
		<td data-name="project_name"<?php echo $project_details->project_name->cellAttributes() ?>>
<span id="el_project_details_project_name">
<span<?php echo $project_details->project_name->viewAttributes() ?>>
<?php echo $project_details->project_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_details->project_our_client->Visible) { // project_our_client ?>
	<tr id="r_project_our_client">
		<td class="<?php echo $project_details_view->TableLeftColumnClass ?>"><span id="elh_project_details_project_our_client"><?php echo $project_details->project_our_client->caption() ?></span></td>
		<td data-name="project_our_client"<?php echo $project_details->project_our_client->cellAttributes() ?>>
<span id="el_project_details_project_our_client">
<span<?php echo $project_details->project_our_client->viewAttributes() ?>>
<?php echo $project_details->project_our_client->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_details->project_end_user->Visible) { // project_end_user ?>
	<tr id="r_project_end_user">
		<td class="<?php echo $project_details_view->TableLeftColumnClass ?>"><span id="elh_project_details_project_end_user"><?php echo $project_details->project_end_user->caption() ?></span></td>
		<td data-name="project_end_user"<?php echo $project_details->project_end_user->cellAttributes() ?>>
<span id="el_project_details_project_end_user">
<span<?php echo $project_details->project_end_user->viewAttributes() ?>>
<?php echo $project_details->project_end_user->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_details->project_sales_engg->Visible) { // project_sales_engg ?>
	<tr id="r_project_sales_engg">
		<td class="<?php echo $project_details_view->TableLeftColumnClass ?>"><span id="elh_project_details_project_sales_engg"><?php echo $project_details->project_sales_engg->caption() ?></span></td>
		<td data-name="project_sales_engg"<?php echo $project_details->project_sales_engg->cellAttributes() ?>>
<span id="el_project_details_project_sales_engg">
<span<?php echo $project_details->project_sales_engg->viewAttributes() ?>>
<?php echo $project_details->project_sales_engg->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_details->project_distribution->Visible) { // project_distribution ?>
	<tr id="r_project_distribution">
		<td class="<?php echo $project_details_view->TableLeftColumnClass ?>"><span id="elh_project_details_project_distribution"><?php echo $project_details->project_distribution->caption() ?></span></td>
		<td data-name="project_distribution"<?php echo $project_details->project_distribution->cellAttributes() ?>>
<span id="el_project_details_project_distribution">
<span<?php echo $project_details->project_distribution->viewAttributes() ?>>
<?php echo $project_details->project_distribution->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_details->project_transmittal->Visible) { // project_transmittal ?>
	<tr id="r_project_transmittal">
		<td class="<?php echo $project_details_view->TableLeftColumnClass ?>"><span id="elh_project_details_project_transmittal"><?php echo $project_details->project_transmittal->caption() ?></span></td>
		<td data-name="project_transmittal"<?php echo $project_details->project_transmittal->cellAttributes() ?>>
<span id="el_project_details_project_transmittal">
<span<?php echo $project_details->project_transmittal->viewAttributes() ?>>
<?php echo $project_details->project_transmittal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_details->order_number->Visible) { // order_number ?>
	<tr id="r_order_number">
		<td class="<?php echo $project_details_view->TableLeftColumnClass ?>"><span id="elh_project_details_order_number"><?php echo $project_details->order_number->caption() ?></span></td>
		<td data-name="order_number"<?php echo $project_details->order_number->cellAttributes() ?>>
<span id="el_project_details_order_number">
<span<?php echo $project_details->order_number->viewAttributes() ?>>
<?php echo $project_details->order_number->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$project_details_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$project_details->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$project_details_view->terminate();
?>