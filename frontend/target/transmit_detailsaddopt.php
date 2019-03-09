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
$transmit_details_addopt = new transmit_details_addopt();

// Run the page
$transmit_details_addopt->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transmit_details_addopt->Page_Render();
?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "addopt";
var ftransmit_detailsaddopt = currentForm = new ew.Form("ftransmit_detailsaddopt", "addopt");

// Validate form
ftransmit_detailsaddopt.validate = function() {
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
		<?php if ($transmit_details_addopt->transmittal_no->Required) { ?>
			elm = this.getElements("x" + infix + "_transmittal_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->transmittal_no->caption(), $transmit_details->transmittal_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_addopt->project_name->Required) { ?>
			elm = this.getElements("x" + infix + "_project_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->project_name->caption(), $transmit_details->project_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_addopt->delivery_location->Required) { ?>
			elm = this.getElements("x" + infix + "_delivery_location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->delivery_location->caption(), $transmit_details->delivery_location->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_addopt->addressed_to->Required) { ?>
			elm = this.getElements("x" + infix + "_addressed_to");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->addressed_to->caption(), $transmit_details->addressed_to->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_addopt->remarks->Required) { ?>
			elm = this.getElements("x" + infix + "_remarks");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->remarks->caption(), $transmit_details->remarks->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_addopt->transmital_date->Required) { ?>
			elm = this.getElements("x" + infix + "_transmital_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->transmital_date->caption(), $transmit_details->transmital_date->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftransmit_detailsaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftransmit_detailsaddopt.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftransmit_detailsaddopt.lists["x_project_name"] = <?php echo $transmit_details_addopt->project_name->Lookup->toClientList() ?>;
ftransmit_detailsaddopt.lists["x_project_name"].options = <?php echo JsonEncode($transmit_details_addopt->project_name->lookupOptions()) ?>;
ftransmit_detailsaddopt.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $transmit_details_addopt->showPageHeader(); ?>
<?php
$transmit_details_addopt->showMessage();
?>
<form name="ftransmit_detailsaddopt" id="ftransmit_detailsaddopt" class="ew-form ew-horizontal" action="<?php echo API_URL ?>" method="post">
<?php //if ($transmit_details_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $transmit_details_addopt->Token ?>">
<?php //} ?>
<input type="hidden" name="<?php echo API_ACTION_NAME ?>" id="<?php echo API_ACTION_NAME ?>" value="<?php echo API_ADD_ACTION ?>">
<input type="hidden" name="<?php echo API_OBJECT_NAME ?>" id="<?php echo API_OBJECT_NAME ?>" value="<?php echo $transmit_details_addopt->TableVar ?>">
<?php if ($transmit_details->transmittal_no->Visible) { // transmittal_no ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_transmittal_no"><?php echo $transmit_details->transmittal_no->caption() ?><?php echo ($transmit_details->transmittal_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="transmit_details" data-field="x_transmittal_no" name="x_transmittal_no" id="x_transmittal_no" size="30" placeholder="<?php echo HtmlEncode($transmit_details->transmittal_no->getPlaceHolder()) ?>" value="<?php echo $transmit_details->transmittal_no->EditValue ?>"<?php echo $transmit_details->transmittal_no->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($transmit_details->project_name->Visible) { // project_name ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label"><?php echo $transmit_details->project_name->caption() ?><?php echo ($transmit_details->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<?php
$wrkonchange = "" . trim(@$transmit_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transmit_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x_project_name" class="text-nowrap" style="z-index: 8970">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_project_name" id="sv_x_project_name" value="<?php echo RemoveHtml($transmit_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($transmit_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transmit_details->project_name->getPlaceHolder()) ?>"<?php echo $transmit_details->project_name->editAttributes() ?>>
	</div>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_project_name" data-value-separator="<?php echo $transmit_details->project_name->displayValueSeparatorAttribute() ?>" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($transmit_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransmit_detailsaddopt.createAutoSuggest({"id":"x_project_name","forceSelect":false});
</script>
<?php echo $transmit_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
</div>
	</div>
<?php } ?>
<?php if ($transmit_details->delivery_location->Visible) { // delivery_location ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_delivery_location"><?php echo $transmit_details->delivery_location->caption() ?><?php echo ($transmit_details->delivery_location->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="transmit_details" data-field="x_delivery_location" name="x_delivery_location" id="x_delivery_location" size="30" placeholder="<?php echo HtmlEncode($transmit_details->delivery_location->getPlaceHolder()) ?>" value="<?php echo $transmit_details->delivery_location->EditValue ?>"<?php echo $transmit_details->delivery_location->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($transmit_details->addressed_to->Visible) { // addressed_to ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_addressed_to"><?php echo $transmit_details->addressed_to->caption() ?><?php echo ($transmit_details->addressed_to->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="transmit_details" data-field="x_addressed_to" name="x_addressed_to" id="x_addressed_to" size="30" placeholder="<?php echo HtmlEncode($transmit_details->addressed_to->getPlaceHolder()) ?>" value="<?php echo $transmit_details->addressed_to->EditValue ?>"<?php echo $transmit_details->addressed_to->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($transmit_details->remarks->Visible) { // remarks ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_remarks"><?php echo $transmit_details->remarks->caption() ?><?php echo ($transmit_details->remarks->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<textarea data-table="transmit_details" data-field="x_remarks" name="x_remarks" id="x_remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($transmit_details->remarks->getPlaceHolder()) ?>"<?php echo $transmit_details->remarks->editAttributes() ?>><?php echo $transmit_details->remarks->EditValue ?></textarea>
</div>
	</div>
<?php } ?>
<?php if ($transmit_details->transmital_date->Visible) { // transmital_date ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label"><?php echo $transmit_details->transmital_date->caption() ?><?php echo ($transmit_details->transmital_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="transmit_details" data-field="x_transmital_date" name="x_transmital_date" id="x_transmital_date" placeholder="<?php echo HtmlEncode($transmit_details->transmital_date->getPlaceHolder()) ?>" value="<?php echo $transmit_details->transmital_date->EditValue ?>"<?php echo $transmit_details->transmital_date->editAttributes() ?>>
</div>
	</div>
<?php } ?>
</form>
<?php
$transmit_details_addopt->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$transmit_details_addopt->terminate();
?>