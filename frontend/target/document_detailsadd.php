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
$document_details_add = new document_details_add();

// Run the page
$document_details_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_details_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fdocument_detailsadd = currentForm = new ew.Form("fdocument_detailsadd", "add");

// Validate form
fdocument_detailsadd.validate = function() {
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
		<?php if ($document_details_add->firelink_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_firelink_doc_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->firelink_doc_no->caption(), $document_details->firelink_doc_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_add->client_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_client_doc_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->client_doc_no->caption(), $document_details->client_doc_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_add->document_tittle->Required) { ?>
			elm = this.getElements("x" + infix + "_document_tittle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->document_tittle->caption(), $document_details->document_tittle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_add->project_name->Required) { ?>
			elm = this.getElements("x" + infix + "_project_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->project_name->caption(), $document_details->project_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_add->project_system->Required) { ?>
			elm = this.getElements("x" + infix + "_project_system");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->project_system->caption(), $document_details->project_system->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_add->create_date->Required) { ?>
			elm = this.getElements("x" + infix + "_create_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->create_date->caption(), $document_details->create_date->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_add->planned_date->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->planned_date->caption(), $document_details->planned_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_details->planned_date->errorMessage()) ?>");
		<?php if ($document_details_add->document_type->Required) { ?>
			elm = this.getElements("x" + infix + "_document_type");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->document_type->caption(), $document_details->document_type->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_add->expiry_date->Required) { ?>
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

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fdocument_detailsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_detailsadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdocument_detailsadd.lists["x_project_name"] = <?php echo $document_details_add->project_name->Lookup->toClientList() ?>;
fdocument_detailsadd.lists["x_project_name"].options = <?php echo JsonEncode($document_details_add->project_name->lookupOptions()) ?>;
fdocument_detailsadd.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $document_details_add->showPageHeader(); ?>
<?php
$document_details_add->showMessage();
?>
<form name="fdocument_detailsadd" id="fdocument_detailsadd" class="<?php echo $document_details_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_details_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_details_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_details">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$document_details_add->IsModal ?>">
<?php if (!$document_details_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($document_details_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_document_detailsadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($document_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
<?php if ($document_details_add->IsMobileOrModal) { ?>
	<div id="r_firelink_doc_no" class="form-group row">
		<label id="elh_document_details_firelink_doc_no" for="x_firelink_doc_no" class="<?php echo $document_details_add->LeftColumnClass ?>"><?php echo $document_details->firelink_doc_no->caption() ?><?php echo ($document_details->firelink_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_add->RightColumnClass ?>"><div<?php echo $document_details->firelink_doc_no->cellAttributes() ?>>
<span id="el_document_details_firelink_doc_no">
<input type="text" data-table="document_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->firelink_doc_no->EditValue ?>"<?php echo $document_details->firelink_doc_no->editAttributes() ?>>
</span>
<?php echo $document_details->firelink_doc_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_firelink_doc_no">
		<td class="<?php echo $document_details_add->TableLeftColumnClass ?>"><span id="elh_document_details_firelink_doc_no"><?php echo $document_details->firelink_doc_no->caption() ?><?php echo ($document_details->firelink_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->firelink_doc_no->cellAttributes() ?>>
<span id="el_document_details_firelink_doc_no">
<input type="text" data-table="document_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->firelink_doc_no->EditValue ?>"<?php echo $document_details->firelink_doc_no->editAttributes() ?>>
</span>
<?php echo $document_details->firelink_doc_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->client_doc_no->Visible) { // client_doc_no ?>
<?php if ($document_details_add->IsMobileOrModal) { ?>
	<div id="r_client_doc_no" class="form-group row">
		<label id="elh_document_details_client_doc_no" for="x_client_doc_no" class="<?php echo $document_details_add->LeftColumnClass ?>"><?php echo $document_details->client_doc_no->caption() ?><?php echo ($document_details->client_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_add->RightColumnClass ?>"><div<?php echo $document_details->client_doc_no->cellAttributes() ?>>
<span id="el_document_details_client_doc_no">
<input type="text" data-table="document_details" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->client_doc_no->EditValue ?>"<?php echo $document_details->client_doc_no->editAttributes() ?>>
</span>
<?php echo $document_details->client_doc_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_client_doc_no">
		<td class="<?php echo $document_details_add->TableLeftColumnClass ?>"><span id="elh_document_details_client_doc_no"><?php echo $document_details->client_doc_no->caption() ?><?php echo ($document_details->client_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->client_doc_no->cellAttributes() ?>>
<span id="el_document_details_client_doc_no">
<input type="text" data-table="document_details" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->client_doc_no->EditValue ?>"<?php echo $document_details->client_doc_no->editAttributes() ?>>
</span>
<?php echo $document_details->client_doc_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->document_tittle->Visible) { // document_tittle ?>
<?php if ($document_details_add->IsMobileOrModal) { ?>
	<div id="r_document_tittle" class="form-group row">
		<label id="elh_document_details_document_tittle" for="x_document_tittle" class="<?php echo $document_details_add->LeftColumnClass ?>"><?php echo $document_details->document_tittle->caption() ?><?php echo ($document_details->document_tittle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_add->RightColumnClass ?>"><div<?php echo $document_details->document_tittle->cellAttributes() ?>>
<span id="el_document_details_document_tittle">
<input type="text" data-table="document_details" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_details->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_details->document_tittle->EditValue ?>"<?php echo $document_details->document_tittle->editAttributes() ?>>
</span>
<?php echo $document_details->document_tittle->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_tittle">
		<td class="<?php echo $document_details_add->TableLeftColumnClass ?>"><span id="elh_document_details_document_tittle"><?php echo $document_details->document_tittle->caption() ?><?php echo ($document_details->document_tittle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->document_tittle->cellAttributes() ?>>
<span id="el_document_details_document_tittle">
<input type="text" data-table="document_details" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_details->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_details->document_tittle->EditValue ?>"<?php echo $document_details->document_tittle->editAttributes() ?>>
</span>
<?php echo $document_details->document_tittle->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->project_name->Visible) { // project_name ?>
<?php if ($document_details_add->IsMobileOrModal) { ?>
	<div id="r_project_name" class="form-group row">
		<label id="elh_document_details_project_name" class="<?php echo $document_details_add->LeftColumnClass ?>"><?php echo $document_details->project_name->caption() ?><?php echo ($document_details->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_add->RightColumnClass ?>"><div<?php echo $document_details->project_name->cellAttributes() ?>>
<span id="el_document_details_project_name">
<?php
$wrkonchange = "" . trim(@$document_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x_project_name" class="text-nowrap" style="z-index: 8950">
	<input type="text" class="form-control" name="sv_x_project_name" id="sv_x_project_name" value="<?php echo RemoveHtml($document_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>"<?php echo $document_details->project_name->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" data-value-separator="<?php echo $document_details->project_name->displayValueSeparatorAttribute() ?>" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($document_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailsadd.createAutoSuggest({"id":"x_project_name","forceSelect":true});
</script>
<?php echo $document_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
</span>
<?php echo $document_details->project_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_name">
		<td class="<?php echo $document_details_add->TableLeftColumnClass ?>"><span id="elh_document_details_project_name"><?php echo $document_details->project_name->caption() ?><?php echo ($document_details->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->project_name->cellAttributes() ?>>
<span id="el_document_details_project_name">
<?php
$wrkonchange = "" . trim(@$document_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x_project_name" class="text-nowrap" style="z-index: 8950">
	<input type="text" class="form-control" name="sv_x_project_name" id="sv_x_project_name" value="<?php echo RemoveHtml($document_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>"<?php echo $document_details->project_name->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" data-value-separator="<?php echo $document_details->project_name->displayValueSeparatorAttribute() ?>" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($document_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailsadd.createAutoSuggest({"id":"x_project_name","forceSelect":true});
</script>
<?php echo $document_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
</span>
<?php echo $document_details->project_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->project_system->Visible) { // project_system ?>
<?php if ($document_details_add->IsMobileOrModal) { ?>
	<div id="r_project_system" class="form-group row">
		<label id="elh_document_details_project_system" for="x_project_system" class="<?php echo $document_details_add->LeftColumnClass ?>"><?php echo $document_details->project_system->caption() ?><?php echo ($document_details->project_system->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_add->RightColumnClass ?>"><div<?php echo $document_details->project_system->cellAttributes() ?>>
<span id="el_document_details_project_system">
<input type="text" data-table="document_details" data-field="x_project_system" name="x_project_system" id="x_project_system" size="30" placeholder="<?php echo HtmlEncode($document_details->project_system->getPlaceHolder()) ?>" value="<?php echo $document_details->project_system->EditValue ?>"<?php echo $document_details->project_system->editAttributes() ?>>
</span>
<?php echo $document_details->project_system->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_system">
		<td class="<?php echo $document_details_add->TableLeftColumnClass ?>"><span id="elh_document_details_project_system"><?php echo $document_details->project_system->caption() ?><?php echo ($document_details->project_system->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->project_system->cellAttributes() ?>>
<span id="el_document_details_project_system">
<input type="text" data-table="document_details" data-field="x_project_system" name="x_project_system" id="x_project_system" size="30" placeholder="<?php echo HtmlEncode($document_details->project_system->getPlaceHolder()) ?>" value="<?php echo $document_details->project_system->EditValue ?>"<?php echo $document_details->project_system->editAttributes() ?>>
</span>
<?php echo $document_details->project_system->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->create_date->Visible) { // create_date ?>
<?php if ($document_details_add->IsMobileOrModal) { ?>
	<div id="r_create_date" class="form-group row">
		<label id="elh_document_details_create_date" class="<?php echo $document_details_add->LeftColumnClass ?>"><?php echo $document_details->create_date->caption() ?><?php echo ($document_details->create_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_add->RightColumnClass ?>"><div<?php echo $document_details->create_date->cellAttributes() ?>>
<span id="el_document_details_create_date">
<input type="text" data-table="document_details" data-field="x_create_date" name="x_create_date" id="x_create_date" placeholder="<?php echo HtmlEncode($document_details->create_date->getPlaceHolder()) ?>" value="<?php echo $document_details->create_date->EditValue ?>"<?php echo $document_details->create_date->editAttributes() ?>>
</span>
<?php echo $document_details->create_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_create_date">
		<td class="<?php echo $document_details_add->TableLeftColumnClass ?>"><span id="elh_document_details_create_date"><?php echo $document_details->create_date->caption() ?><?php echo ($document_details->create_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->create_date->cellAttributes() ?>>
<span id="el_document_details_create_date">
<input type="text" data-table="document_details" data-field="x_create_date" name="x_create_date" id="x_create_date" placeholder="<?php echo HtmlEncode($document_details->create_date->getPlaceHolder()) ?>" value="<?php echo $document_details->create_date->EditValue ?>"<?php echo $document_details->create_date->editAttributes() ?>>
</span>
<?php echo $document_details->create_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->planned_date->Visible) { // planned_date ?>
<?php if ($document_details_add->IsMobileOrModal) { ?>
	<div id="r_planned_date" class="form-group row">
		<label id="elh_document_details_planned_date" for="x_planned_date" class="<?php echo $document_details_add->LeftColumnClass ?>"><?php echo $document_details->planned_date->caption() ?><?php echo ($document_details->planned_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_add->RightColumnClass ?>"><div<?php echo $document_details->planned_date->cellAttributes() ?>>
<span id="el_document_details_planned_date">
<input type="text" data-table="document_details" data-field="x_planned_date" name="x_planned_date" id="x_planned_date" placeholder="<?php echo HtmlEncode($document_details->planned_date->getPlaceHolder()) ?>" value="<?php echo $document_details->planned_date->EditValue ?>"<?php echo $document_details->planned_date->editAttributes() ?>>
<?php if (!$document_details->planned_date->ReadOnly && !$document_details->planned_date->Disabled && !isset($document_details->planned_date->EditAttrs["readonly"]) && !isset($document_details->planned_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsadd", "x_planned_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_details->planned_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date">
		<td class="<?php echo $document_details_add->TableLeftColumnClass ?>"><span id="elh_document_details_planned_date"><?php echo $document_details->planned_date->caption() ?><?php echo ($document_details->planned_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->planned_date->cellAttributes() ?>>
<span id="el_document_details_planned_date">
<input type="text" data-table="document_details" data-field="x_planned_date" name="x_planned_date" id="x_planned_date" placeholder="<?php echo HtmlEncode($document_details->planned_date->getPlaceHolder()) ?>" value="<?php echo $document_details->planned_date->EditValue ?>"<?php echo $document_details->planned_date->editAttributes() ?>>
<?php if (!$document_details->planned_date->ReadOnly && !$document_details->planned_date->Disabled && !isset($document_details->planned_date->EditAttrs["readonly"]) && !isset($document_details->planned_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsadd", "x_planned_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_details->planned_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->document_type->Visible) { // document_type ?>
<?php if ($document_details_add->IsMobileOrModal) { ?>
	<div id="r_document_type" class="form-group row">
		<label id="elh_document_details_document_type" for="x_document_type" class="<?php echo $document_details_add->LeftColumnClass ?>"><?php echo $document_details->document_type->caption() ?><?php echo ($document_details->document_type->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_add->RightColumnClass ?>"><div<?php echo $document_details->document_type->cellAttributes() ?>>
<span id="el_document_details_document_type">
<input type="text" data-table="document_details" data-field="x_document_type" name="x_document_type" id="x_document_type" size="30" placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>" value="<?php echo $document_details->document_type->EditValue ?>"<?php echo $document_details->document_type->editAttributes() ?>>
</span>
<?php echo $document_details->document_type->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_type">
		<td class="<?php echo $document_details_add->TableLeftColumnClass ?>"><span id="elh_document_details_document_type"><?php echo $document_details->document_type->caption() ?><?php echo ($document_details->document_type->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->document_type->cellAttributes() ?>>
<span id="el_document_details_document_type">
<input type="text" data-table="document_details" data-field="x_document_type" name="x_document_type" id="x_document_type" size="30" placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>" value="<?php echo $document_details->document_type->EditValue ?>"<?php echo $document_details->document_type->editAttributes() ?>>
</span>
<?php echo $document_details->document_type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->expiry_date->Visible) { // expiry_date ?>
<?php if ($document_details_add->IsMobileOrModal) { ?>
	<div id="r_expiry_date" class="form-group row">
		<label id="elh_document_details_expiry_date" for="x_expiry_date" class="<?php echo $document_details_add->LeftColumnClass ?>"><?php echo $document_details->expiry_date->caption() ?><?php echo ($document_details->expiry_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_add->RightColumnClass ?>"><div<?php echo $document_details->expiry_date->cellAttributes() ?>>
<span id="el_document_details_expiry_date">
<input type="text" data-table="document_details" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" placeholder="<?php echo HtmlEncode($document_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $document_details->expiry_date->EditValue ?>"<?php echo $document_details->expiry_date->editAttributes() ?>>
<?php if (!$document_details->expiry_date->ReadOnly && !$document_details->expiry_date->Disabled && !isset($document_details->expiry_date->EditAttrs["readonly"]) && !isset($document_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsadd", "x_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_details->expiry_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_expiry_date">
		<td class="<?php echo $document_details_add->TableLeftColumnClass ?>"><span id="elh_document_details_expiry_date"><?php echo $document_details->expiry_date->caption() ?><?php echo ($document_details->expiry_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->expiry_date->cellAttributes() ?>>
<span id="el_document_details_expiry_date">
<input type="text" data-table="document_details" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" placeholder="<?php echo HtmlEncode($document_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $document_details->expiry_date->EditValue ?>"<?php echo $document_details->expiry_date->editAttributes() ?>>
<?php if (!$document_details->expiry_date->ReadOnly && !$document_details->expiry_date->Disabled && !isset($document_details->expiry_date->EditAttrs["readonly"]) && !isset($document_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsadd", "x_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_details->expiry_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$document_details_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $document_details_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $document_details_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$document_details_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$document_details_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$document_details_add->terminate();
?>