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
SetupLoginStatus();
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
fdocument_detailsedit.lists["x_project_system"] = <?php echo $document_details_edit->project_system->Lookup->toClientList() ?>;
fdocument_detailsedit.lists["x_project_system"].options = <?php echo JsonEncode($document_details_edit->project_system->lookupOptions()) ?>;
fdocument_detailsedit.lists["x_document_type"] = <?php echo $document_details_edit->document_type->Lookup->toClientList() ?>;
fdocument_detailsedit.lists["x_document_type"].options = <?php echo JsonEncode($document_details_edit->document_type->lookupOptions()) ?>;
fdocument_detailsedit.autoSuggests["x_document_type"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

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
<?php if ($document_details->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
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
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_firelink_doc_no">
<input type="text" data-table="document_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->firelink_doc_no->EditValue ?>"<?php echo $document_details->firelink_doc_no->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_document_details_firelink_doc_no">
<span<?php echo $document_details->firelink_doc_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->firelink_doc_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" value="<?php echo HtmlEncode($document_details->firelink_doc_no->FormValue) ?>">
<?php } ?>
<?php echo $document_details->firelink_doc_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_firelink_doc_no">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_firelink_doc_no"><?php echo $document_details->firelink_doc_no->caption() ?><?php echo ($document_details->firelink_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->firelink_doc_no->cellAttributes() ?>>
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_firelink_doc_no">
<input type="text" data-table="document_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->firelink_doc_no->EditValue ?>"<?php echo $document_details->firelink_doc_no->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_document_details_firelink_doc_no">
<span<?php echo $document_details->firelink_doc_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->firelink_doc_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" value="<?php echo HtmlEncode($document_details->firelink_doc_no->FormValue) ?>">
<?php } ?>
<?php echo $document_details->firelink_doc_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->client_doc_no->Visible) { // client_doc_no ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
	<div id="r_client_doc_no" class="form-group row">
		<label id="elh_document_details_client_doc_no" for="x_client_doc_no" class="<?php echo $document_details_edit->LeftColumnClass ?>"><?php echo $document_details->client_doc_no->caption() ?><?php echo ($document_details->client_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_edit->RightColumnClass ?>"><div<?php echo $document_details->client_doc_no->cellAttributes() ?>>
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_client_doc_no">
<input type="text" data-table="document_details" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->client_doc_no->EditValue ?>"<?php echo $document_details->client_doc_no->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_document_details_client_doc_no">
<span<?php echo $document_details->client_doc_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->client_doc_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" value="<?php echo HtmlEncode($document_details->client_doc_no->FormValue) ?>">
<?php } ?>
<?php echo $document_details->client_doc_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_client_doc_no">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_client_doc_no"><?php echo $document_details->client_doc_no->caption() ?><?php echo ($document_details->client_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->client_doc_no->cellAttributes() ?>>
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_client_doc_no">
<input type="text" data-table="document_details" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->client_doc_no->EditValue ?>"<?php echo $document_details->client_doc_no->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_document_details_client_doc_no">
<span<?php echo $document_details->client_doc_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->client_doc_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" value="<?php echo HtmlEncode($document_details->client_doc_no->FormValue) ?>">
<?php } ?>
<?php echo $document_details->client_doc_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->document_tittle->Visible) { // document_tittle ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
	<div id="r_document_tittle" class="form-group row">
		<label id="elh_document_details_document_tittle" for="x_document_tittle" class="<?php echo $document_details_edit->LeftColumnClass ?>"><?php echo $document_details->document_tittle->caption() ?><?php echo ($document_details->document_tittle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_edit->RightColumnClass ?>"><div<?php echo $document_details->document_tittle->cellAttributes() ?>>
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_document_tittle">
<input type="text" data-table="document_details" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_details->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_details->document_tittle->EditValue ?>"<?php echo $document_details->document_tittle->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_document_details_document_tittle">
<span<?php echo $document_details->document_tittle->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->document_tittle->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" value="<?php echo HtmlEncode($document_details->document_tittle->FormValue) ?>">
<?php } ?>
<?php echo $document_details->document_tittle->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_tittle">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_document_tittle"><?php echo $document_details->document_tittle->caption() ?><?php echo ($document_details->document_tittle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->document_tittle->cellAttributes() ?>>
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_document_tittle">
<input type="text" data-table="document_details" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_details->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_details->document_tittle->EditValue ?>"<?php echo $document_details->document_tittle->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_document_details_document_tittle">
<span<?php echo $document_details->document_tittle->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->document_tittle->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" value="<?php echo HtmlEncode($document_details->document_tittle->FormValue) ?>">
<?php } ?>
<?php echo $document_details->document_tittle->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->project_name->Visible) { // project_name ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
	<div id="r_project_name" class="form-group row">
		<label id="elh_document_details_project_name" class="<?php echo $document_details_edit->LeftColumnClass ?>"><?php echo $document_details->project_name->caption() ?><?php echo ($document_details->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_edit->RightColumnClass ?>"><div<?php echo $document_details->project_name->cellAttributes() ?>>
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_project_name">
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
<?php if (AllowAdd(CurrentProjectID() . "project_details") && !$document_details->project_name->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_project_name" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $document_details->project_name->caption() ?>" data-title="<?php echo $document_details->project_name->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_project_name',url:'project_detailsaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->project_name->displayValueSeparatorAttribute() ?>" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($document_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailsedit.createAutoSuggest({"id":"x_project_name","forceSelect":true});
</script>
<?php echo $document_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
</span>
<?php } else { ?>
<span id="el_document_details_project_name">
<span<?php echo $document_details->project_name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->project_name->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($document_details->project_name->FormValue) ?>">
<?php } ?>
<?php echo $document_details->project_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_name">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_project_name"><?php echo $document_details->project_name->caption() ?><?php echo ($document_details->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->project_name->cellAttributes() ?>>
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_project_name">
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
<?php if (AllowAdd(CurrentProjectID() . "project_details") && !$document_details->project_name->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_project_name" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $document_details->project_name->caption() ?>" data-title="<?php echo $document_details->project_name->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_project_name',url:'project_detailsaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->project_name->displayValueSeparatorAttribute() ?>" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($document_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailsedit.createAutoSuggest({"id":"x_project_name","forceSelect":true});
</script>
<?php echo $document_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
</span>
<?php } else { ?>
<span id="el_document_details_project_name">
<span<?php echo $document_details->project_name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->project_name->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($document_details->project_name->FormValue) ?>">
<?php } ?>
<?php echo $document_details->project_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->project_system->Visible) { // project_system ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
	<div id="r_project_system" class="form-group row">
		<label id="elh_document_details_project_system" for="x_project_system" class="<?php echo $document_details_edit->LeftColumnClass ?>"><?php echo $document_details->project_system->caption() ?><?php echo ($document_details->project_system->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_edit->RightColumnClass ?>"><div<?php echo $document_details->project_system->cellAttributes() ?>>
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_project_system">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="document_details" data-field="x_project_system" data-value-separator="<?php echo $document_details->project_system->displayValueSeparatorAttribute() ?>" id="x_project_system" name="x_project_system" size=4<?php echo $document_details->project_system->editAttributes() ?>>
		<?php echo $document_details->project_system->selectOptionListHtml("x_project_system") ?>
	</select>
</div>
<?php echo $document_details->project_system->Lookup->getParamTag("p_x_project_system") ?>
</span>
<?php } else { ?>
<span id="el_document_details_project_system">
<span<?php echo $document_details->project_system->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->project_system->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_system" name="x_project_system" id="x_project_system" value="<?php echo HtmlEncode($document_details->project_system->FormValue) ?>">
<?php } ?>
<?php echo $document_details->project_system->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_system">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_project_system"><?php echo $document_details->project_system->caption() ?><?php echo ($document_details->project_system->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->project_system->cellAttributes() ?>>
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_project_system">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="document_details" data-field="x_project_system" data-value-separator="<?php echo $document_details->project_system->displayValueSeparatorAttribute() ?>" id="x_project_system" name="x_project_system" size=4<?php echo $document_details->project_system->editAttributes() ?>>
		<?php echo $document_details->project_system->selectOptionListHtml("x_project_system") ?>
	</select>
</div>
<?php echo $document_details->project_system->Lookup->getParamTag("p_x_project_system") ?>
</span>
<?php } else { ?>
<span id="el_document_details_project_system">
<span<?php echo $document_details->project_system->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->project_system->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_system" name="x_project_system" id="x_project_system" value="<?php echo HtmlEncode($document_details->project_system->FormValue) ?>">
<?php } ?>
<?php echo $document_details->project_system->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->planned_date->Visible) { // planned_date ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
	<div id="r_planned_date" class="form-group row">
		<label id="elh_document_details_planned_date" for="x_planned_date" class="<?php echo $document_details_edit->LeftColumnClass ?>"><?php echo $document_details->planned_date->caption() ?><?php echo ($document_details->planned_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_edit->RightColumnClass ?>"><div<?php echo $document_details->planned_date->cellAttributes() ?>>
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_planned_date">
<input type="text" data-table="document_details" data-field="x_planned_date" name="x_planned_date" id="x_planned_date" placeholder="<?php echo HtmlEncode($document_details->planned_date->getPlaceHolder()) ?>" value="<?php echo $document_details->planned_date->EditValue ?>"<?php echo $document_details->planned_date->editAttributes() ?>>
<?php if (!$document_details->planned_date->ReadOnly && !$document_details->planned_date->Disabled && !isset($document_details->planned_date->EditAttrs["readonly"]) && !isset($document_details->planned_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsedit", "x_planned_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_document_details_planned_date">
<span<?php echo $document_details->planned_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->planned_date->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_planned_date" name="x_planned_date" id="x_planned_date" value="<?php echo HtmlEncode($document_details->planned_date->FormValue) ?>">
<?php } ?>
<?php echo $document_details->planned_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_planned_date"><?php echo $document_details->planned_date->caption() ?><?php echo ($document_details->planned_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->planned_date->cellAttributes() ?>>
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_planned_date">
<input type="text" data-table="document_details" data-field="x_planned_date" name="x_planned_date" id="x_planned_date" placeholder="<?php echo HtmlEncode($document_details->planned_date->getPlaceHolder()) ?>" value="<?php echo $document_details->planned_date->EditValue ?>"<?php echo $document_details->planned_date->editAttributes() ?>>
<?php if (!$document_details->planned_date->ReadOnly && !$document_details->planned_date->Disabled && !isset($document_details->planned_date->EditAttrs["readonly"]) && !isset($document_details->planned_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsedit", "x_planned_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_document_details_planned_date">
<span<?php echo $document_details->planned_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->planned_date->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_planned_date" name="x_planned_date" id="x_planned_date" value="<?php echo HtmlEncode($document_details->planned_date->FormValue) ?>">
<?php } ?>
<?php echo $document_details->planned_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->document_type->Visible) { // document_type ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
	<div id="r_document_type" class="form-group row">
		<label id="elh_document_details_document_type" class="<?php echo $document_details_edit->LeftColumnClass ?>"><?php echo $document_details->document_type->caption() ?><?php echo ($document_details->document_type->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_edit->RightColumnClass ?>"><div<?php echo $document_details->document_type->cellAttributes() ?>>
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_document_type">
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
<?php if (AllowAdd(CurrentProjectID() . "document_type") && !$document_details->document_type->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_document_type" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $document_details->document_type->caption() ?>" data-title="<?php echo $document_details->document_type->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_document_type',url:'document_typeaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->document_type->displayValueSeparatorAttribute() ?>" name="x_document_type" id="x_document_type" value="<?php echo HtmlEncode($document_details->document_type->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailsedit.createAutoSuggest({"id":"x_document_type","forceSelect":true});
</script>
<?php echo $document_details->document_type->Lookup->getParamTag("p_x_document_type") ?>
</span>
<?php } else { ?>
<span id="el_document_details_document_type">
<span<?php echo $document_details->document_type->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->document_type->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" name="x_document_type" id="x_document_type" value="<?php echo HtmlEncode($document_details->document_type->FormValue) ?>">
<?php } ?>
<?php echo $document_details->document_type->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_type">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_document_type"><?php echo $document_details->document_type->caption() ?><?php echo ($document_details->document_type->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->document_type->cellAttributes() ?>>
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_document_type">
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
<?php if (AllowAdd(CurrentProjectID() . "document_type") && !$document_details->document_type->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_document_type" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $document_details->document_type->caption() ?>" data-title="<?php echo $document_details->document_type->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_document_type',url:'document_typeaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->document_type->displayValueSeparatorAttribute() ?>" name="x_document_type" id="x_document_type" value="<?php echo HtmlEncode($document_details->document_type->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailsedit.createAutoSuggest({"id":"x_document_type","forceSelect":true});
</script>
<?php echo $document_details->document_type->Lookup->getParamTag("p_x_document_type") ?>
</span>
<?php } else { ?>
<span id="el_document_details_document_type">
<span<?php echo $document_details->document_type->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->document_type->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" name="x_document_type" id="x_document_type" value="<?php echo HtmlEncode($document_details->document_type->FormValue) ?>">
<?php } ?>
<?php echo $document_details->document_type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->expiry_date->Visible) { // expiry_date ?>
<?php if ($document_details_edit->IsMobileOrModal) { ?>
	<div id="r_expiry_date" class="form-group row">
		<label id="elh_document_details_expiry_date" for="x_expiry_date" class="<?php echo $document_details_edit->LeftColumnClass ?>"><?php echo $document_details->expiry_date->caption() ?><?php echo ($document_details->expiry_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_details_edit->RightColumnClass ?>"><div<?php echo $document_details->expiry_date->cellAttributes() ?>>
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_expiry_date">
<input type="text" data-table="document_details" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" placeholder="<?php echo HtmlEncode($document_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $document_details->expiry_date->EditValue ?>"<?php echo $document_details->expiry_date->editAttributes() ?>>
<?php if (!$document_details->expiry_date->ReadOnly && !$document_details->expiry_date->Disabled && !isset($document_details->expiry_date->EditAttrs["readonly"]) && !isset($document_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsedit", "x_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_document_details_expiry_date">
<span<?php echo $document_details->expiry_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->expiry_date->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" value="<?php echo HtmlEncode($document_details->expiry_date->FormValue) ?>">
<?php } ?>
<?php echo $document_details->expiry_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_expiry_date">
		<td class="<?php echo $document_details_edit->TableLeftColumnClass ?>"><span id="elh_document_details_expiry_date"><?php echo $document_details->expiry_date->caption() ?><?php echo ($document_details->expiry_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_details->expiry_date->cellAttributes() ?>>
<?php if (!$document_details->isConfirm()) { ?>
<span id="el_document_details_expiry_date">
<input type="text" data-table="document_details" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" placeholder="<?php echo HtmlEncode($document_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $document_details->expiry_date->EditValue ?>"<?php echo $document_details->expiry_date->editAttributes() ?>>
<?php if (!$document_details->expiry_date->ReadOnly && !$document_details->expiry_date->Disabled && !isset($document_details->expiry_date->EditAttrs["readonly"]) && !isset($document_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsedit", "x_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_document_details_expiry_date">
<span<?php echo $document_details->expiry_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_details->expiry_date->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_details" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" value="<?php echo HtmlEncode($document_details->expiry_date->FormValue) ?>">
<?php } ?>
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
<?php if (!$document_details->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $document_details_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
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