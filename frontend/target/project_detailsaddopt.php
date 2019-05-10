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
$project_details_addopt = new project_details_addopt();

// Run the page
$project_details_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_details_addopt->Page_Render();
?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "addopt";
var fproject_detailsaddopt = currentForm = new ew.Form("fproject_detailsaddopt", "addopt");

// Validate form
fproject_detailsaddopt.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($project_details_addopt->project_id->Required) { ?>
			elm = this.getElements("x" + infix + "_project_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_id->caption(), $project_details->project_id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($project_details_addopt->project_name->Required) { ?>
			elm = this.getElements("x" + infix + "_project_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_name->caption(), $project_details->project_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($project_details_addopt->project_our_client->Required) { ?>
			elm = this.getElements("x" + infix + "_project_our_client");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_our_client->caption(), $project_details->project_our_client->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($project_details_addopt->project_end_user->Required) { ?>
			elm = this.getElements("x" + infix + "_project_end_user");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_end_user->caption(), $project_details->project_end_user->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($project_details_addopt->project_sales_engg->Required) { ?>
			elm = this.getElements("x" + infix + "_project_sales_engg");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_sales_engg->caption(), $project_details->project_sales_engg->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_project_sales_engg");
			if (elm && !ew.checkEmail(elm.value))
				return this.onError(elm, "<?php echo JsEncode($project_details->project_sales_engg->errorMessage()) ?>");
		<?php if ($project_details_addopt->project_distribution->Required) { ?>
			elm = this.getElements("x" + infix + "_project_distribution");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_distribution->caption(), $project_details->project_distribution->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_project_distribution");
			if (elm && !ew.checkEmail(elm.value))
				return this.onError(elm, "<?php echo JsEncode($project_details->project_distribution->errorMessage()) ?>");
		<?php if ($project_details_addopt->project_transmittal->Required) { ?>
			elm = this.getElements("x" + infix + "_project_transmittal");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_transmittal->caption(), $project_details->project_transmittal->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($project_details_addopt->order_number->Required) { ?>
			elm = this.getElements("x" + infix + "_order_number");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->order_number->caption(), $project_details->order_number->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fproject_detailsaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproject_detailsaddopt.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $project_details_addopt->showPageHeader(); ?>
<?php
$project_details_addopt->showMessage();
?>
<form name="fproject_detailsaddopt" id="fproject_detailsaddopt" class="ew-form ew-horizontal" action="<?php echo API_URL ?>" method="post">
<?php //if ($project_details_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $project_details_addopt->Token ?>">
<?php //} ?>
<input type="hidden" name="<?php echo API_ACTION_NAME ?>" id="<?php echo API_ACTION_NAME ?>" value="<?php echo API_ADD_ACTION ?>">
<input type="hidden" name="<?php echo API_OBJECT_NAME ?>" id="<?php echo API_OBJECT_NAME ?>" value="<?php echo $project_details_addopt->TableVar ?>">
<?php if ($project_details->project_id->Visible) { // project_id ?>
<?php } ?>
<?php if ($project_details->project_name->Visible) { // project_name ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_project_name"><?php echo $project_details->project_name->caption() ?><?php echo ($project_details->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="project_details" data-field="x_project_name" name="x_project_name" id="x_project_name" size="30" placeholder="<?php echo HtmlEncode($project_details->project_name->getPlaceHolder()) ?>" value="<?php echo $project_details->project_name->EditValue ?>"<?php echo $project_details->project_name->editAttributes() ?>>
<?php echo $project_details->project_name->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($project_details->project_our_client->Visible) { // project_our_client ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_project_our_client"><?php echo $project_details->project_our_client->caption() ?><?php echo ($project_details->project_our_client->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="project_details" data-field="x_project_our_client" name="x_project_our_client" id="x_project_our_client" size="30" placeholder="<?php echo HtmlEncode($project_details->project_our_client->getPlaceHolder()) ?>" value="<?php echo $project_details->project_our_client->EditValue ?>"<?php echo $project_details->project_our_client->editAttributes() ?>>
<?php echo $project_details->project_our_client->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($project_details->project_end_user->Visible) { // project_end_user ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_project_end_user"><?php echo $project_details->project_end_user->caption() ?><?php echo ($project_details->project_end_user->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="project_details" data-field="x_project_end_user" name="x_project_end_user" id="x_project_end_user" size="30" placeholder="<?php echo HtmlEncode($project_details->project_end_user->getPlaceHolder()) ?>" value="<?php echo $project_details->project_end_user->EditValue ?>"<?php echo $project_details->project_end_user->editAttributes() ?>>
<?php echo $project_details->project_end_user->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($project_details->project_sales_engg->Visible) { // project_sales_engg ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_project_sales_engg"><?php echo $project_details->project_sales_engg->caption() ?><?php echo ($project_details->project_sales_engg->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="project_details" data-field="x_project_sales_engg" name="x_project_sales_engg" id="x_project_sales_engg" size="30" placeholder="<?php echo HtmlEncode($project_details->project_sales_engg->getPlaceHolder()) ?>" value="<?php echo $project_details->project_sales_engg->EditValue ?>"<?php echo $project_details->project_sales_engg->editAttributes() ?>>
<?php echo $project_details->project_sales_engg->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($project_details->project_distribution->Visible) { // project_distribution ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_project_distribution"><?php echo $project_details->project_distribution->caption() ?><?php echo ($project_details->project_distribution->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="project_details" data-field="x_project_distribution" name="x_project_distribution" id="x_project_distribution" size="30" placeholder="<?php echo HtmlEncode($project_details->project_distribution->getPlaceHolder()) ?>" value="<?php echo $project_details->project_distribution->EditValue ?>"<?php echo $project_details->project_distribution->editAttributes() ?>>
<?php echo $project_details->project_distribution->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($project_details->project_transmittal->Visible) { // project_transmittal ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_project_transmittal"><?php echo $project_details->project_transmittal->caption() ?><?php echo ($project_details->project_transmittal->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="project_details" data-field="x_project_transmittal" name="x_project_transmittal" id="x_project_transmittal" size="30" placeholder="<?php echo HtmlEncode($project_details->project_transmittal->getPlaceHolder()) ?>" value="<?php echo $project_details->project_transmittal->EditValue ?>"<?php echo $project_details->project_transmittal->editAttributes() ?>>
<?php echo $project_details->project_transmittal->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($project_details->order_number->Visible) { // order_number ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_order_number"><?php echo $project_details->order_number->caption() ?><?php echo ($project_details->order_number->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="project_details" data-field="x_order_number" name="x_order_number" id="x_order_number" size="30" placeholder="<?php echo HtmlEncode($project_details->order_number->getPlaceHolder()) ?>" value="<?php echo $project_details->order_number->EditValue ?>"<?php echo $project_details->order_number->editAttributes() ?>>
<?php echo $project_details->order_number->CustomMsg ?></div>
	</div>
<?php } ?>
</form>
<?php
$project_details_addopt->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$project_details_addopt->terminate();
?>