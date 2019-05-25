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
$document_details_update = new document_details_update();

// Run the page
$document_details_update->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_details_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "update";
var fdocument_detailsupdate = currentForm = new ew.Form("fdocument_detailsupdate", "update");

// Validate form
fdocument_detailsupdate.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	if (!ew.updateSelected(fobj)) {
		ew.alert(ew.language.phrase("NoFieldSelected"));
		return false;
	}
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($document_details_update->firelink_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_firelink_doc_no");
			uelm = this.getElements("u" + infix + "_firelink_doc_no");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->firelink_doc_no->caption(), $document_details->firelink_doc_no->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
		<?php if ($document_details_update->client_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_client_doc_no");
			uelm = this.getElements("u" + infix + "_client_doc_no");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->client_doc_no->caption(), $document_details->client_doc_no->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
		<?php if ($document_details_update->document_tittle->Required) { ?>
			elm = this.getElements("x" + infix + "_document_tittle");
			uelm = this.getElements("u" + infix + "_document_tittle");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->document_tittle->caption(), $document_details->document_tittle->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
		<?php if ($document_details_update->project_name->Required) { ?>
			elm = this.getElements("x" + infix + "_project_name");
			uelm = this.getElements("u" + infix + "_project_name");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->project_name->caption(), $document_details->project_name->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
		<?php if ($document_details_update->project_system->Required) { ?>
			elm = this.getElements("x" + infix + "_project_system");
			uelm = this.getElements("u" + infix + "_project_system");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->project_system->caption(), $document_details->project_system->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
		<?php if ($document_details_update->planned_date->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date");
			uelm = this.getElements("u" + infix + "_planned_date");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->planned_date->caption(), $document_details->planned_date->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date");
			uelm = this.getElements("u" + infix + "_planned_date");
			if (uelm && uelm.checked && elm && !ew.checkDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_details->planned_date->errorMessage()) ?>");
		<?php if ($document_details_update->document_type->Required) { ?>
			elm = this.getElements("x" + infix + "_document_type");
			uelm = this.getElements("u" + infix + "_document_type");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->document_type->caption(), $document_details->document_type->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
		<?php if ($document_details_update->expiry_date->Required) { ?>
			elm = this.getElements("x" + infix + "_expiry_date");
			uelm = this.getElements("u" + infix + "_expiry_date");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_details->expiry_date->caption(), $document_details->expiry_date->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
			elm = this.getElements("x" + infix + "_expiry_date");
			uelm = this.getElements("u" + infix + "_expiry_date");
			if (uelm && uelm.checked && elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_details->expiry_date->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fdocument_detailsupdate.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_detailsupdate.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdocument_detailsupdate.lists["x_project_name"] = <?php echo $document_details_update->project_name->Lookup->toClientList() ?>;
fdocument_detailsupdate.lists["x_project_name"].options = <?php echo JsonEncode($document_details_update->project_name->lookupOptions()) ?>;
fdocument_detailsupdate.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdocument_detailsupdate.lists["x_project_system"] = <?php echo $document_details_update->project_system->Lookup->toClientList() ?>;
fdocument_detailsupdate.lists["x_project_system"].options = <?php echo JsonEncode($document_details_update->project_system->lookupOptions()) ?>;
fdocument_detailsupdate.lists["x_document_type"] = <?php echo $document_details_update->document_type->Lookup->toClientList() ?>;
fdocument_detailsupdate.lists["x_document_type"].options = <?php echo JsonEncode($document_details_update->document_type->lookupOptions()) ?>;
fdocument_detailsupdate.autoSuggests["x_document_type"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $document_details_update->showPageHeader(); ?>
<?php
$document_details_update->showMessage();
?>
<form name="fdocument_detailsupdate" id="fdocument_detailsupdate" class="<?php echo $document_details_update->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_details_update->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_details_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_details">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$document_details_update->IsModal ?>">
<?php foreach ($document_details_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<?php if (!$document_details_update->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($document_details_update->IsMobileOrModal) { ?>
<div id="tbl_document_detailsupdate" class="ew-update-div"><!-- page -->
	<div class="form-check">
		<input type="checkbox" class="form-check-input" name="u" id="u" onclick="ew.selectAll(this);"><label class="form-check-label" for="u"><?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php } else { ?>
<table id="tbl_document_detailsupdate" class="table table-striped table-sm ew-desktop-table"><!-- desktop table -->
	<thead>
	<tr>
		<th colspan="2"><div class="form-check"><input type="checkbox" class="form-check-input" name="u" id="u" onclick="ew.selectAll(this);"><label class="form-check-label" for="u"><?php echo $Language->Phrase("UpdateSelectAll") ?></label></div></th>
	</tr>
	</thead>
	<tbody>
<?php } ?>
<?php if ($document_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
<?php if ($document_details_update->IsMobileOrModal) { ?>
	<div id="r_firelink_doc_no" class="form-group row">
		<label for="x_firelink_doc_no" class="<?php echo $document_details_update->LeftColumnClass ?>"><div class="form-check">
<input type="checkbox" name="u_firelink_doc_no" id="u_firelink_doc_no" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->firelink_doc_no->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_firelink_doc_no"><?php echo $document_details->firelink_doc_no->caption() ?></label></div></label>
		<div class="<?php echo $document_details_update->RightColumnClass ?>"><div<?php echo $document_details->firelink_doc_no->cellAttributes() ?>>
<span id="el_document_details_firelink_doc_no">
<input type="text" data-table="document_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->firelink_doc_no->EditValue ?>"<?php echo $document_details->firelink_doc_no->editAttributes() ?>>
</span>
<?php echo $document_details->firelink_doc_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_firelink_doc_no">
		<td class="<?php echo $document_details_update->TableLeftColumnClass ?>"<?php echo $document_details->firelink_doc_no->cellAttributes() ?>><span id="elh_document_details_firelink_doc_no"><div class="form-check">
<input type="checkbox" name="u_firelink_doc_no" id="u_firelink_doc_no" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->firelink_doc_no->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_firelink_doc_no"><?php echo $document_details->firelink_doc_no->caption() ?></label></div></span></td>
		<td<?php echo $document_details->firelink_doc_no->cellAttributes() ?>>
<span id="el_document_details_firelink_doc_no">
<input type="text" data-table="document_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->firelink_doc_no->EditValue ?>"<?php echo $document_details->firelink_doc_no->editAttributes() ?>>
</span>
<?php echo $document_details->firelink_doc_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->client_doc_no->Visible) { // client_doc_no ?>
<?php if ($document_details_update->IsMobileOrModal) { ?>
	<div id="r_client_doc_no" class="form-group row">
		<label for="x_client_doc_no" class="<?php echo $document_details_update->LeftColumnClass ?>"><div class="form-check">
<input type="checkbox" name="u_client_doc_no" id="u_client_doc_no" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->client_doc_no->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_client_doc_no"><?php echo $document_details->client_doc_no->caption() ?></label></div></label>
		<div class="<?php echo $document_details_update->RightColumnClass ?>"><div<?php echo $document_details->client_doc_no->cellAttributes() ?>>
<span id="el_document_details_client_doc_no">
<input type="text" data-table="document_details" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->client_doc_no->EditValue ?>"<?php echo $document_details->client_doc_no->editAttributes() ?>>
</span>
<?php echo $document_details->client_doc_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_client_doc_no">
		<td class="<?php echo $document_details_update->TableLeftColumnClass ?>"<?php echo $document_details->client_doc_no->cellAttributes() ?>><span id="elh_document_details_client_doc_no"><div class="form-check">
<input type="checkbox" name="u_client_doc_no" id="u_client_doc_no" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->client_doc_no->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_client_doc_no"><?php echo $document_details->client_doc_no->caption() ?></label></div></span></td>
		<td<?php echo $document_details->client_doc_no->cellAttributes() ?>>
<span id="el_document_details_client_doc_no">
<input type="text" data-table="document_details" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->client_doc_no->EditValue ?>"<?php echo $document_details->client_doc_no->editAttributes() ?>>
</span>
<?php echo $document_details->client_doc_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->document_tittle->Visible) { // document_tittle ?>
<?php if ($document_details_update->IsMobileOrModal) { ?>
	<div id="r_document_tittle" class="form-group row">
		<label for="x_document_tittle" class="<?php echo $document_details_update->LeftColumnClass ?>"><div class="form-check">
<input type="checkbox" name="u_document_tittle" id="u_document_tittle" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->document_tittle->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_document_tittle"><?php echo $document_details->document_tittle->caption() ?></label></div></label>
		<div class="<?php echo $document_details_update->RightColumnClass ?>"><div<?php echo $document_details->document_tittle->cellAttributes() ?>>
<span id="el_document_details_document_tittle">
<input type="text" data-table="document_details" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_details->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_details->document_tittle->EditValue ?>"<?php echo $document_details->document_tittle->editAttributes() ?>>
</span>
<?php echo $document_details->document_tittle->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_tittle">
		<td class="<?php echo $document_details_update->TableLeftColumnClass ?>"<?php echo $document_details->document_tittle->cellAttributes() ?>><span id="elh_document_details_document_tittle"><div class="form-check">
<input type="checkbox" name="u_document_tittle" id="u_document_tittle" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->document_tittle->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_document_tittle"><?php echo $document_details->document_tittle->caption() ?></label></div></span></td>
		<td<?php echo $document_details->document_tittle->cellAttributes() ?>>
<span id="el_document_details_document_tittle">
<input type="text" data-table="document_details" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_details->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_details->document_tittle->EditValue ?>"<?php echo $document_details->document_tittle->editAttributes() ?>>
</span>
<?php echo $document_details->document_tittle->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->project_name->Visible) { // project_name ?>
<?php if ($document_details_update->IsMobileOrModal) { ?>
	<div id="r_project_name" class="form-group row">
		<label class="<?php echo $document_details_update->LeftColumnClass ?>"><div class="form-check">
<input type="checkbox" name="u_project_name" id="u_project_name" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->project_name->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_project_name"><?php echo $document_details->project_name->caption() ?></label></div></label>
		<div class="<?php echo $document_details_update->RightColumnClass ?>"><div<?php echo $document_details->project_name->cellAttributes() ?>>
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
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->project_name->displayValueSeparatorAttribute() ?>" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($document_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailsupdate.createAutoSuggest({"id":"x_project_name","forceSelect":true});
</script>
<?php echo $document_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
</span>
<?php echo $document_details->project_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_name">
		<td class="<?php echo $document_details_update->TableLeftColumnClass ?>"<?php echo $document_details->project_name->cellAttributes() ?>><span id="elh_document_details_project_name"><div class="form-check">
<input type="checkbox" name="u_project_name" id="u_project_name" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->project_name->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_project_name"><?php echo $document_details->project_name->caption() ?></label></div></span></td>
		<td<?php echo $document_details->project_name->cellAttributes() ?>>
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
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->project_name->displayValueSeparatorAttribute() ?>" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($document_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailsupdate.createAutoSuggest({"id":"x_project_name","forceSelect":true});
</script>
<?php echo $document_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
</span>
<?php echo $document_details->project_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->project_system->Visible) { // project_system ?>
<?php if ($document_details_update->IsMobileOrModal) { ?>
	<div id="r_project_system" class="form-group row">
		<label for="x_project_system" class="<?php echo $document_details_update->LeftColumnClass ?>"><div class="form-check">
<input type="checkbox" name="u_project_system" id="u_project_system" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->project_system->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_project_system"><?php echo $document_details->project_system->caption() ?></label></div></label>
		<div class="<?php echo $document_details_update->RightColumnClass ?>"><div<?php echo $document_details->project_system->cellAttributes() ?>>
<span id="el_document_details_project_system">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="document_details" data-field="x_project_system" data-value-separator="<?php echo $document_details->project_system->displayValueSeparatorAttribute() ?>" id="x_project_system" name="x_project_system" size=4<?php echo $document_details->project_system->editAttributes() ?>>
		<?php echo $document_details->project_system->selectOptionListHtml("x_project_system") ?>
	</select>
</div>
<?php echo $document_details->project_system->Lookup->getParamTag("p_x_project_system") ?>
</span>
<?php echo $document_details->project_system->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_system">
		<td class="<?php echo $document_details_update->TableLeftColumnClass ?>"<?php echo $document_details->project_system->cellAttributes() ?>><span id="elh_document_details_project_system"><div class="form-check">
<input type="checkbox" name="u_project_system" id="u_project_system" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->project_system->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_project_system"><?php echo $document_details->project_system->caption() ?></label></div></span></td>
		<td<?php echo $document_details->project_system->cellAttributes() ?>>
<span id="el_document_details_project_system">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="document_details" data-field="x_project_system" data-value-separator="<?php echo $document_details->project_system->displayValueSeparatorAttribute() ?>" id="x_project_system" name="x_project_system" size=4<?php echo $document_details->project_system->editAttributes() ?>>
		<?php echo $document_details->project_system->selectOptionListHtml("x_project_system") ?>
	</select>
</div>
<?php echo $document_details->project_system->Lookup->getParamTag("p_x_project_system") ?>
</span>
<?php echo $document_details->project_system->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->planned_date->Visible) { // planned_date ?>
<?php if ($document_details_update->IsMobileOrModal) { ?>
	<div id="r_planned_date" class="form-group row">
		<label for="x_planned_date" class="<?php echo $document_details_update->LeftColumnClass ?>"><div class="form-check">
<input type="checkbox" name="u_planned_date" id="u_planned_date" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->planned_date->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_planned_date"><?php echo $document_details->planned_date->caption() ?></label></div></label>
		<div class="<?php echo $document_details_update->RightColumnClass ?>"><div<?php echo $document_details->planned_date->cellAttributes() ?>>
<span id="el_document_details_planned_date">
<input type="text" data-table="document_details" data-field="x_planned_date" data-format="5" name="x_planned_date" id="x_planned_date" placeholder="<?php echo HtmlEncode($document_details->planned_date->getPlaceHolder()) ?>" value="<?php echo $document_details->planned_date->EditValue ?>"<?php echo $document_details->planned_date->editAttributes() ?>>
<?php if (!$document_details->planned_date->ReadOnly && !$document_details->planned_date->Disabled && !isset($document_details->planned_date->EditAttrs["readonly"]) && !isset($document_details->planned_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsupdate", "x_planned_date", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<?php echo $document_details->planned_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date">
		<td class="<?php echo $document_details_update->TableLeftColumnClass ?>"<?php echo $document_details->planned_date->cellAttributes() ?>><span id="elh_document_details_planned_date"><div class="form-check">
<input type="checkbox" name="u_planned_date" id="u_planned_date" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->planned_date->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_planned_date"><?php echo $document_details->planned_date->caption() ?></label></div></span></td>
		<td<?php echo $document_details->planned_date->cellAttributes() ?>>
<span id="el_document_details_planned_date">
<input type="text" data-table="document_details" data-field="x_planned_date" data-format="5" name="x_planned_date" id="x_planned_date" placeholder="<?php echo HtmlEncode($document_details->planned_date->getPlaceHolder()) ?>" value="<?php echo $document_details->planned_date->EditValue ?>"<?php echo $document_details->planned_date->editAttributes() ?>>
<?php if (!$document_details->planned_date->ReadOnly && !$document_details->planned_date->Disabled && !isset($document_details->planned_date->EditAttrs["readonly"]) && !isset($document_details->planned_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsupdate", "x_planned_date", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<?php echo $document_details->planned_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->document_type->Visible) { // document_type ?>
<?php if ($document_details_update->IsMobileOrModal) { ?>
	<div id="r_document_type" class="form-group row">
		<label class="<?php echo $document_details_update->LeftColumnClass ?>"><div class="form-check">
<input type="checkbox" name="u_document_type" id="u_document_type" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->document_type->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_document_type"><?php echo $document_details->document_type->caption() ?></label></div></label>
		<div class="<?php echo $document_details_update->RightColumnClass ?>"><div<?php echo $document_details->document_type->cellAttributes() ?>>
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
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->document_type->displayValueSeparatorAttribute() ?>" name="x_document_type" id="x_document_type" value="<?php echo HtmlEncode($document_details->document_type->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailsupdate.createAutoSuggest({"id":"x_document_type","forceSelect":true});
</script>
<?php echo $document_details->document_type->Lookup->getParamTag("p_x_document_type") ?>
</span>
<?php echo $document_details->document_type->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_type">
		<td class="<?php echo $document_details_update->TableLeftColumnClass ?>"<?php echo $document_details->document_type->cellAttributes() ?>><span id="elh_document_details_document_type"><div class="form-check">
<input type="checkbox" name="u_document_type" id="u_document_type" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->document_type->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_document_type"><?php echo $document_details->document_type->caption() ?></label></div></span></td>
		<td<?php echo $document_details->document_type->cellAttributes() ?>>
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
		</div>
	</div>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $document_details->document_type->displayValueSeparatorAttribute() ?>" name="x_document_type" id="x_document_type" value="<?php echo HtmlEncode($document_details->document_type->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailsupdate.createAutoSuggest({"id":"x_document_type","forceSelect":true});
</script>
<?php echo $document_details->document_type->Lookup->getParamTag("p_x_document_type") ?>
</span>
<?php echo $document_details->document_type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->expiry_date->Visible) { // expiry_date ?>
<?php if ($document_details_update->IsMobileOrModal) { ?>
	<div id="r_expiry_date" class="form-group row">
		<label for="x_expiry_date" class="<?php echo $document_details_update->LeftColumnClass ?>"><div class="form-check">
<input type="checkbox" name="u_expiry_date" id="u_expiry_date" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->expiry_date->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_expiry_date"><?php echo $document_details->expiry_date->caption() ?></label></div></label>
		<div class="<?php echo $document_details_update->RightColumnClass ?>"><div<?php echo $document_details->expiry_date->cellAttributes() ?>>
<span id="el_document_details_expiry_date">
<input type="text" data-table="document_details" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" placeholder="<?php echo HtmlEncode($document_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $document_details->expiry_date->EditValue ?>"<?php echo $document_details->expiry_date->editAttributes() ?>>
<?php if (!$document_details->expiry_date->ReadOnly && !$document_details->expiry_date->Disabled && !isset($document_details->expiry_date->EditAttrs["readonly"]) && !isset($document_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsupdate", "x_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_details->expiry_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_expiry_date">
		<td class="<?php echo $document_details_update->TableLeftColumnClass ?>"<?php echo $document_details->expiry_date->cellAttributes() ?>><span id="elh_document_details_expiry_date"><div class="form-check">
<input type="checkbox" name="u_expiry_date" id="u_expiry_date" class="form-check-input ew-multi-select" value="1"<?php echo ($document_details->expiry_date->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_expiry_date"><?php echo $document_details->expiry_date->caption() ?></label></div></span></td>
		<td<?php echo $document_details->expiry_date->cellAttributes() ?>>
<span id="el_document_details_expiry_date">
<input type="text" data-table="document_details" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" placeholder="<?php echo HtmlEncode($document_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $document_details->expiry_date->EditValue ?>"<?php echo $document_details->expiry_date->editAttributes() ?>>
<?php if (!$document_details->expiry_date->ReadOnly && !$document_details->expiry_date->Disabled && !isset($document_details->expiry_date->EditAttrs["readonly"]) && !isset($document_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailsupdate", "x_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_details->expiry_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details_update->IsMobileOrModal) { ?>
	</div><!-- /page -->
<?php } else { ?>
	</tbody>
</table><!-- /desktop table -->
<?php } ?>
<?php if (!$document_details_update->IsModal) { ?>
	<div class="form-group row"><!-- buttons .form-group -->
		<div class="<?php echo $document_details_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("UpdateBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $document_details_update->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$document_details_update->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$document_details_update->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$document_details_update->terminate();
?>