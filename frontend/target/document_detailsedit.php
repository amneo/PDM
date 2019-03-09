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
$document_details_edit = new document_details_edit();

// Run the page
$document_details_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_details_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fdocument_detailsedit = currentForm = new ew.Form("fdocument_detailsedit", "edit");

// Validate form
fdocument_detailsedit.validate = function() {
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
		<?php if ($document_details_edit->firelink_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_firelink_doc_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->firelink_doc_no->caption(), $document_details->firelink_doc_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_edit->client_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_client_doc_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->client_doc_no->caption(), $document_details->client_doc_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_edit->document_tittle->Required) { ?>
			elm = this.getElements("x" + infix + "_document_tittle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->document_tittle->caption(), $document_details->document_tittle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_edit->project_name->Required) { ?>
			elm = this.getElements("x" + infix + "_project_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->project_name->caption(), $document_details->project_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_edit->project_system->Required) { ?>
			elm = this.getElements("x" + infix + "_project_system");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->project_system->caption(), $document_details->project_system->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_edit->planned_date->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->planned_date->caption(), $document_details->planned_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_details->planned_date->errorMessage()) ?>");
		<?php if ($document_details_edit->document_type->Required) { ?>
			elm = this.getElements("x" + infix + "_document_type");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->document_type->caption(), $document_details->document_type->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_details_edit->expiry_date->Required) { ?>
			elm = this.getElements("x" + infix + "_expiry_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->expiry_date->caption(), $document_details->expiry_date->RequiredErrorMessage)) ?>");
		<?php } ?>

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
fdocument_detailsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_detailsedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdocument_detailsedit.lists["x_project_name"] = <?php echo $document_details_edit->project_name->Lookup->toClientList() ?>;
fdocument_detailsedit.lists["x_project_name"].options = <?php echo JsonEncode($document_details_edit->project_name->lookupOptions()) ?>;
fdocument_detailsedit.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $document_details_edit->showPageHeader(); ?>
<?php
$document_details_edit->showMessage();
?>
<form name="fdocument_detailsedit" id="fdocument_detailsedit" class="<?php echo $document_details_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_details_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_details_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_details">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$document_details_edit->IsModal ?>">
<?php if (!$document_details_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_document_detailsedit" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($document_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
	<div id="r_firelink_doc_no" class="form-group row">
		<label id="elh_document_details_firelink_doc_no" for="x_firelink_doc_no" class="<?php echo $document_details_edit->LeftColumnClass ?>"><?php echo $document_details->firelink_doc_no->caption() ?><?php echo ($document_details->firelink_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_edit->RightColumnClass ?>"><div<?php echo $document_details->firelink_doc_no->cellAttributes() ?>>
<span id="el_document_details_firelink_doc_no">
<input type="text" data-table="document_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->firelink_doc_no->EditValue ?>"<?php echo $document_details->firelink_doc_no->editAttributes() ?>>
</span>
<?php echo $document_details->firelink_doc_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_firelink_doc_no">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_firelink_doc_no"><?php echo $document_details->firelink_doc_no->caption() ?><?php echo ($document_details->firelink_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->firelink_doc_no->cellAttributes() ?>>
<span id="el_document_details_firelink_doc_no">
<input type="text" data-table="document_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->firelink_doc_no->EditValue ?>"<?php echo $document_details->firelink_doc_no->editAttributes() ?>>
</span>
<?php echo $document_details->firelink_doc_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->client_doc_no->Visible) { // client_doc_no ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
	<div id="r_client_doc_no" class="form-group row">
		<label id="elh_document_details_client_doc_no" for="x_client_doc_no" class="<?php echo $document_details_edit->LeftColumnClass ?>"><?php echo $document_details->client_doc_no->caption() ?><?php echo ($document_details->client_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_edit->RightColumnClass ?>"><div<?php echo $document_details->client_doc_no->cellAttributes() ?>>
<span id="el_document_details_client_doc_no">
<input type="text" data-table="document_details" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->client_doc_no->EditValue ?>"<?php echo $document_details->client_doc_no->editAttributes() ?>>
</span>
<?php echo $document_details->client_doc_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_client_doc_no">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_client_doc_no"><?php echo $document_details->client_doc_no->caption() ?><?php echo ($document_details->client_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->client_doc_no->cellAttributes() ?>>
<span id="el_document_details_client_doc_no">
<input type="text" data-table="document_details" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->client_doc_no->EditValue ?>"<?php echo $document_details->client_doc_no->editAttributes() ?>>
</span>
<?php echo $document_details->client_doc_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->document_tittle->Visible) { // document_tittle ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
	<div id="r_document_tittle" class="form-group row">
		<label id="elh_document_details_document_tittle" for="x_document_tittle" class="<?php echo $document_details_edit->LeftColumnClass ?>"><?php echo $document_details->document_tittle->caption() ?><?php echo ($document_details->document_tittle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_edit->RightColumnClass ?>"><div<?php echo $document_details->document_tittle->cellAttributes() ?>>
<span id="el_document_details_document_tittle">
<input type="text" data-table="document_details" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_details->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_details->document_tittle->EditValue ?>"<?php echo $document_details->document_tittle->editAttributes() ?>>
</span>
<?php echo $document_details->document_tittle->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_tittle">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_document_tittle"><?php echo $document_details->document_tittle->caption() ?><?php echo ($document_details->document_tittle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->document_tittle->cellAttributes() ?>>
<span id="el_document_details_document_tittle">
<input type="text" data-table="document_details" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_details->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_details->document_tittle->EditValue ?>"<?php echo $document_details->document_tittle->editAttributes() ?>>
</span>
<?php echo $document_details->document_tittle->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->project_name->Visible) { // project_name ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
	<div id="r_project_name" class="form-group row">
		<label id="elh_document_details_project_name" class="<?php echo $document_details_edit->LeftColumnClass ?>"><?php echo $document_details->project_name->caption() ?><?php echo ($document_details->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_edit->RightColumnClass ?>"><div<?php echo $document_details->project_name->cellAttributes() ?>>
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
fdocument_detailsedit.createAutoSuggest({"id":"x_project_name","forceSelect":true});
</script>
<?php echo $document_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
</span>
<?php echo $document_details->project_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_name">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_project_name"><?php echo $document_details->project_name->caption() ?><?php echo ($document_details->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
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
fdocument_detailsedit.createAutoSuggest({"id":"x_project_name","forceSelect":true});
</script>
<?php echo $document_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
</span>
<?php echo $document_details->project_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->project_system->Visible) { // project_system ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
	<div id="r_project_system" class="form-group row">
		<label id="elh_document_details_project_system" for="x_project_system" class="<?php echo $document_details_edit->LeftColumnClass ?>"><?php echo $document_details->project_system->caption() ?><?php echo ($document_details->project_system->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_edit->RightColumnClass ?>"><div<?php echo $document_details->project_system->cellAttributes() ?>>
<span id="el_document_details_project_system">
<input type="text" data-table="document_details" data-field="x_project_system" name="x_project_system" id="x_project_system" size="30" placeholder="<?php echo HtmlEncode($document_details->project_system->getPlaceHolder()) ?>" value="<?php echo $document_details->project_system->EditValue ?>"<?php echo $document_details->project_system->editAttributes() ?>>
</span>
<?php echo $document_details->project_system->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_system">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_project_system"><?php echo $document_details->project_system->caption() ?><?php echo ($document_details->project_system->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->project_system->cellAttributes() ?>>
<span id="el_document_details_project_system">
<input type="text" data-table="document_details" data-field="x_project_system" name="x_project_system" id="x_project_system" size="30" placeholder="<?php echo HtmlEncode($document_details->project_system->getPlaceHolder()) ?>" value="<?php echo $document_details->project_system->EditValue ?>"<?php echo $document_details->project_system->editAttributes() ?>>
</span>
<?php echo $document_details->project_system->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->planned_date->Visible) { // planned_date ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
	<div id="r_planned_date" class="form-group row">
		<label id="elh_document_details_planned_date" for="x_planned_date" class="<?php echo $document_details_edit->LeftColumnClass ?>"><?php echo $document_details->planned_date->caption() ?><?php echo ($document_details->planned_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_edit->RightColumnClass ?>"><div<?php echo $document_details->planned_date->cellAttributes() ?>>
<span id="el_document_details_planned_date">
<input type="text" data-table="document_details" data-field="x_planned_date" name="x_planned_date" id="x_planned_date" placeholder="<?php echo HtmlEncode($document_details->planned_date->getPlaceHolder()) ?>" value="<?php echo $document_details->planned_date->EditValue ?>"<?php echo $document_details->planned_date->editAttributes() ?>>
<?php if (!$document_details->planned_date->ReadOnly && !$document_details->planned_date->Disabled && !isset($document_details->planned_date->EditAttrs["readonly"]) && !isset($document_details->planned_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsedit", "x_planned_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_details->planned_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_planned_date"><?php echo $document_details->planned_date->caption() ?><?php echo ($document_details->planned_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->planned_date->cellAttributes() ?>>
<span id="el_document_details_planned_date">
<input type="text" data-table="document_details" data-field="x_planned_date" name="x_planned_date" id="x_planned_date" placeholder="<?php echo HtmlEncode($document_details->planned_date->getPlaceHolder()) ?>" value="<?php echo $document_details->planned_date->EditValue ?>"<?php echo $document_details->planned_date->editAttributes() ?>>
<?php if (!$document_details->planned_date->ReadOnly && !$document_details->planned_date->Disabled && !isset($document_details->planned_date->EditAttrs["readonly"]) && !isset($document_details->planned_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsedit", "x_planned_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_details->planned_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->document_type->Visible) { // document_type ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
	<div id="r_document_type" class="form-group row">
		<label id="elh_document_details_document_type" for="x_document_type" class="<?php echo $document_details_edit->LeftColumnClass ?>"><?php echo $document_details->document_type->caption() ?><?php echo ($document_details->document_type->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_edit->RightColumnClass ?>"><div<?php echo $document_details->document_type->cellAttributes() ?>>
<span id="el_document_details_document_type">
<input type="text" data-table="document_details" data-field="x_document_type" name="x_document_type" id="x_document_type" size="30" placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>" value="<?php echo $document_details->document_type->EditValue ?>"<?php echo $document_details->document_type->editAttributes() ?>>
</span>
<?php echo $document_details->document_type->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_type">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_document_type"><?php echo $document_details->document_type->caption() ?><?php echo ($document_details->document_type->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->document_type->cellAttributes() ?>>
<span id="el_document_details_document_type">
<input type="text" data-table="document_details" data-field="x_document_type" name="x_document_type" id="x_document_type" size="30" placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>" value="<?php echo $document_details->document_type->EditValue ?>"<?php echo $document_details->document_type->editAttributes() ?>>
</span>
<?php echo $document_details->document_type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->expiry_date->Visible) { // expiry_date ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
	<div id="r_expiry_date" class="form-group row">
		<label id="elh_document_details_expiry_date" for="x_expiry_date" class="<?php echo $document_details_edit->LeftColumnClass ?>"><?php echo $document_details->expiry_date->caption() ?><?php echo ($document_details->expiry_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_edit->RightColumnClass ?>"><div<?php echo $document_details->expiry_date->cellAttributes() ?>>
<span id="el_document_details_expiry_date">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($document_details->expiry_date->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $document_details->expiry_date->ViewValue ?></button>
		<div id="dsl_x_expiry_date" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $document_details->expiry_date->radioButtonListHtml(TRUE, "x_expiry_date") ?>
			</div><!-- /.ew-items ##-->
		</div><!-- /.dropdown-menu ##-->
		<div id="tp_x_expiry_date" class="ew-template"><input type="radio" class="form-check-input" data-table="document_details" data-field="x_expiry_date" data-value-separator="<?php echo $document_details->expiry_date->displayValueSeparatorAttribute() ?>" name="x_expiry_date" id="x_expiry_date" value="{value}"<?php echo $document_details->expiry_date->editAttributes() ?>></div>
	</div><!-- /.btn-group ##-->
	<?php if (!$document_details->expiry_date->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fa fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list ##-->
</span>
<?php echo $document_details->expiry_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_expiry_date">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_expiry_date"><?php echo $document_details->expiry_date->caption() ?><?php echo ($document_details->expiry_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->expiry_date->cellAttributes() ?>>
<span id="el_document_details_expiry_date">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($document_details->expiry_date->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $document_details->expiry_date->ViewValue ?></button>
		<div id="dsl_x_expiry_date" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $document_details->expiry_date->radioButtonListHtml(TRUE, "x_expiry_date") ?>
			</div><!-- /.ew-items ##-->
		</div><!-- /.dropdown-menu ##-->
		<div id="tp_x_expiry_date" class="ew-template"><input type="radio" class="form-check-input" data-table="document_details" data-field="x_expiry_date" data-value-separator="<?php echo $document_details->expiry_date->displayValueSeparatorAttribute() ?>" name="x_expiry_date" id="x_expiry_date" value="{value}"<?php echo $document_details->expiry_date->editAttributes() ?>></div>
	</div><!-- /.btn-group ##-->
	<?php if (!$document_details->expiry_date->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fa fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list ##-->
</span>
<?php echo $document_details->expiry_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
	<input type="hidden" data-table="document_details" data-field="x_document_sequence" name="x_document_sequence" id="x_document_sequence" value="<?php echo HtmlEncode($document_details->document_sequence->CurrentValue) ?>">
<?php if (!$document_details_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $document_details_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $document_details_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$document_details_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$document_details_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$document_details_edit->terminate();
?>