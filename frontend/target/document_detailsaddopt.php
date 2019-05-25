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
$document_details_addopt = new document_details_addopt();

// Run the page
$document_details_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_details_addopt->Page_Render();
?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "addopt";
var fdocument_detailsaddopt = currentForm = new ew.Form("fdocument_detailsaddopt", "addopt");

// Validate form
fdocument_detailsaddopt.validate = function() {
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
		<?php if ($document_details_addopt->firelink_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_firelink_doc_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->firelink_doc_no->caption(), $document_details->firelink_doc_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_addopt->client_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_client_doc_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->client_doc_no->caption(), $document_details->client_doc_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_addopt->document_tittle->Required) { ?>
			elm = this.getElements("x" + infix + "_document_tittle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->document_tittle->caption(), $document_details->document_tittle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_addopt->project_name->Required) { ?>
			elm = this.getElements("x" + infix + "_project_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->project_name->caption(), $document_details->project_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_addopt->project_system->Required) { ?>
			elm = this.getElements("x" + infix + "_project_system");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->project_system->caption(), $document_details->project_system->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_addopt->planned_date->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->planned_date->caption(), $document_details->planned_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date");
			if (elm && !ew.checkDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_details->planned_date->errorMessage()) ?>");
		<?php if ($document_details_addopt->document_type->Required) { ?>
			elm = this.getElements("x" + infix + "_document_type");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->document_type->caption(), $document_details->document_type->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_addopt->expiry_date->Required) { ?>
			elm = this.getElements("x" + infix + "_expiry_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->expiry_date->caption(), $document_details->expiry_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_expiry_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_details->expiry_date->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fdocument_detailsaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_detailsaddopt.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdocument_detailsaddopt.lists["x_project_name"] = <?php echo $document_details_addopt->project_name->Lookup->toClientList() ?>;
fdocument_detailsaddopt.lists["x_project_name"].options = <?php echo JsonEncode($document_details_addopt->project_name->lookupOptions()) ?>;
fdocument_detailsaddopt.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdocument_detailsaddopt.lists["x_project_system"] = <?php echo $document_details_addopt->project_system->Lookup->toClientList() ?>;
fdocument_detailsaddopt.lists["x_project_system"].options = <?php echo JsonEncode($document_details_addopt->project_system->lookupOptions()) ?>;
fdocument_detailsaddopt.lists["x_document_type"] = <?php echo $document_details_addopt->document_type->Lookup->toClientList() ?>;
fdocument_detailsaddopt.lists["x_document_type"].options = <?php echo JsonEncode($document_details_addopt->document_type->lookupOptions()) ?>;
fdocument_detailsaddopt.autoSuggests["x_document_type"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $document_details_addopt->showPageHeader(); ?>
<?php
$document_details_addopt->showMessage();
?>
<form name="fdocument_detailsaddopt" id="fdocument_detailsaddopt" class="ew-form ew-horizontal" action="<?php echo API_URL ?>" method="post">
<?php //if ($document_details_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_details_addopt->Token ?>">
<?php //} ?>
<input type="hidden" name="<?php echo API_ACTION_NAME ?>" id="<?php echo API_ACTION_NAME ?>" value="<?php echo API_ADD_ACTION ?>">
<input type="hidden" name="<?php echo API_OBJECT_NAME ?>" id="<?php echo API_OBJECT_NAME ?>" value="<?php echo $document_details_addopt->TableVar ?>">
<?php if ($document_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_firelink_doc_no"><?php echo $document_details->firelink_doc_no->caption() ?><?php echo ($document_details->firelink_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="document_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->firelink_doc_no->EditValue ?>"<?php echo $document_details->firelink_doc_no->editAttributes() ?>>
<?php echo $document_details->firelink_doc_no->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($document_details->client_doc_no->Visible) { // client_doc_no ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_client_doc_no"><?php echo $document_details->client_doc_no->caption() ?><?php echo ($document_details->client_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="document_details" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->client_doc_no->EditValue ?>"<?php echo $document_details->client_doc_no->editAttributes() ?>>
<?php echo $document_details->client_doc_no->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($document_details->document_tittle->Visible) { // document_tittle ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_document_tittle"><?php echo $document_details->document_tittle->caption() ?><?php echo ($document_details->document_tittle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="document_details" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_details->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_details->document_tittle->EditValue ?>"<?php echo $document_details->document_tittle->editAttributes() ?>>
<?php echo $document_details->document_tittle->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($document_details->project_name->Visible) { // project_name ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label"><?php echo $document_details->project_name->caption() ?><?php echo ($document_details->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<?php
$wrkonchange = "" . trim(@$document_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x_project_name" class="text-nowrap" style="z-index: 8950">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x_project_name" id="sv_x_project_name" value="<?php echo RemoveHtml($document_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>"<?php echo $document_details->project_name->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($document_details->project_name->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_project_name',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($document_details->project_name->ReadOnly || $document_details->project_name->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->project_name->displayValueSeparatorAttribute() ?>" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($document_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailsaddopt.createAutoSuggest({"id":"x_project_name","forceSelect":true});
</script>
<?php echo $document_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
<?php echo $document_details->project_name->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($document_details->project_system->Visible) { // project_system ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_project_system"><?php echo $document_details->project_system->caption() ?><?php echo ($document_details->project_system->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="document_details" data-field="x_project_system" data-value-separator="<?php echo $document_details->project_system->displayValueSeparatorAttribute() ?>" id="x_project_system" name="x_project_system" size=4<?php echo $document_details->project_system->editAttributes() ?>>
		<?php echo $document_details->project_system->selectOptionListHtml("x_project_system") ?>
	</select>
</div>
<?php echo $document_details->project_system->Lookup->getParamTag("p_x_project_system") ?>
<?php echo $document_details->project_system->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($document_details->planned_date->Visible) { // planned_date ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_planned_date"><?php echo $document_details->planned_date->caption() ?><?php echo ($document_details->planned_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="document_details" data-field="x_planned_date" data-format="5" name="x_planned_date" id="x_planned_date" placeholder="<?php echo HtmlEncode($document_details->planned_date->getPlaceHolder()) ?>" value="<?php echo $document_details->planned_date->EditValue ?>"<?php echo $document_details->planned_date->editAttributes() ?>>
<?php if (!$document_details->planned_date->ReadOnly && !$document_details->planned_date->Disabled && !isset($document_details->planned_date->EditAttrs["readonly"]) && !isset($document_details->planned_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsaddopt", "x_planned_date", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
<?php echo $document_details->planned_date->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($document_details->document_type->Visible) { // document_type ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label"><?php echo $document_details->document_type->caption() ?><?php echo ($document_details->document_type->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<?php
$wrkonchange = "" . trim(@$document_details->document_type->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->document_type->EditAttrs["onchange"] = "";
?>
<span id="as_x_document_type" class="text-nowrap" style="z-index: 8910">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x_document_type" id="sv_x_document_type" value="<?php echo RemoveHtml($document_details->document_type->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>"<?php echo $document_details->document_type->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($document_details->document_type->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_document_type',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($document_details->document_type->ReadOnly || $document_details->document_type->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->document_type->displayValueSeparatorAttribute() ?>" name="x_document_type" id="x_document_type" value="<?php echo HtmlEncode($document_details->document_type->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailsaddopt.createAutoSuggest({"id":"x_document_type","forceSelect":true});
</script>
<?php echo $document_details->document_type->Lookup->getParamTag("p_x_document_type") ?>
<?php echo $document_details->document_type->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($document_details->expiry_date->Visible) { // expiry_date ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_expiry_date"><?php echo $document_details->expiry_date->caption() ?><?php echo ($document_details->expiry_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="document_details" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" placeholder="<?php echo HtmlEncode($document_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $document_details->expiry_date->EditValue ?>"<?php echo $document_details->expiry_date->editAttributes() ?>>
<?php if (!$document_details->expiry_date->ReadOnly && !$document_details->expiry_date->Disabled && !isset($document_details->expiry_date->EditAttrs["readonly"]) && !isset($document_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsaddopt", "x_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
<?php echo $document_details->expiry_date->CustomMsg ?></div>
	</div>
<?php } ?>
</form>
<?php
$document_details_addopt->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$document_details_addopt->terminate();
?>