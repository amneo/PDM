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
$document_details_search = new document_details_search();

// Run the page
$document_details_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_details_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($document_details_search->IsModal) { ?>
var fdocument_detailssearch = currentAdvancedSearchForm = new ew.Form("fdocument_detailssearch", "search");
<?php } else { ?>
var fdocument_detailssearch = currentForm = new ew.Form("fdocument_detailssearch", "search");
<?php } ?>

// Form_CustomValidate event
fdocument_detailssearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_detailssearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdocument_detailssearch.lists["x_project_name"] = <?php echo $document_details_search->project_name->Lookup->toClientList() ?>;
fdocument_detailssearch.lists["x_project_name"].options = <?php echo JsonEncode($document_details_search->project_name->lookupOptions()) ?>;
fdocument_detailssearch.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdocument_detailssearch.lists["x_document_type"] = <?php echo $document_details_search->document_type->Lookup->toClientList() ?>;
fdocument_detailssearch.lists["x_document_type"].options = <?php echo JsonEncode($document_details_search->document_type->lookupOptions()) ?>;
fdocument_detailssearch.autoSuggests["x_document_type"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
// Validate function for search

fdocument_detailssearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_planned_date");
	if (elm && !ew.checkDate(elm.value))
		return this.onError(elm, "<?php echo JsEncode($document_details->planned_date->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_expiry_date");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($document_details->expiry_date->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $document_details_search->showPageHeader(); ?>
<?php
$document_details_search->showMessage();
?>
<form name="fdocument_detailssearch" id="fdocument_detailssearch" class="<?php echo $document_details_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_details_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_details_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_details">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$document_details_search->IsModal ?>">
<?php if (!$document_details_search->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($document_details_search->IsMobileOrModal) { ?>
<div class="ew-search-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_document_detailssearch" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($document_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
<?php if ($document_details_search->IsMobileOrModal) { ?>
	<div id="r_firelink_doc_no" class="form-group row">
		<label for="x_firelink_doc_no" class="<?php echo $document_details_search->LeftColumnClass ?>"><span id="elh_document_details_firelink_doc_no"><?php echo $document_details->firelink_doc_no->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_firelink_doc_no" id="z_firelink_doc_no" value="LIKE"></span>
		</label>
		<div class="<?php echo $document_details_search->RightColumnClass ?>"><div<?php echo $document_details->firelink_doc_no->cellAttributes() ?>>
			<span id="el_document_details_firelink_doc_no">
<input type="text" data-table="document_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->firelink_doc_no->EditValue ?>"<?php echo $document_details->firelink_doc_no->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_firelink_doc_no">
		<td class="<?php echo $document_details_search->TableLeftColumnClass ?>"><span id="elh_document_details_firelink_doc_no"><?php echo $document_details->firelink_doc_no->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_firelink_doc_no" id="z_firelink_doc_no" value="LIKE"></span></td>
		<td<?php echo $document_details->firelink_doc_no->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_document_details_firelink_doc_no">
<input type="text" data-table="document_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->firelink_doc_no->EditValue ?>"<?php echo $document_details->firelink_doc_no->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->client_doc_no->Visible) { // client_doc_no ?>
<?php if ($document_details_search->IsMobileOrModal) { ?>
	<div id="r_client_doc_no" class="form-group row">
		<label for="x_client_doc_no" class="<?php echo $document_details_search->LeftColumnClass ?>"><span id="elh_document_details_client_doc_no"><?php echo $document_details->client_doc_no->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_client_doc_no" id="z_client_doc_no" value="LIKE"></span>
		</label>
		<div class="<?php echo $document_details_search->RightColumnClass ?>"><div<?php echo $document_details->client_doc_no->cellAttributes() ?>>
			<span id="el_document_details_client_doc_no">
<input type="text" data-table="document_details" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->client_doc_no->EditValue ?>"<?php echo $document_details->client_doc_no->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_client_doc_no">
		<td class="<?php echo $document_details_search->TableLeftColumnClass ?>"><span id="elh_document_details_client_doc_no"><?php echo $document_details->client_doc_no->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_client_doc_no" id="z_client_doc_no" value="LIKE"></span></td>
		<td<?php echo $document_details->client_doc_no->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_document_details_client_doc_no">
<input type="text" data-table="document_details" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_details->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_details->client_doc_no->EditValue ?>"<?php echo $document_details->client_doc_no->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->document_tittle->Visible) { // document_tittle ?>
<?php if ($document_details_search->IsMobileOrModal) { ?>
	<div id="r_document_tittle" class="form-group row">
		<label for="x_document_tittle" class="<?php echo $document_details_search->LeftColumnClass ?>"><span id="elh_document_details_document_tittle"><?php echo $document_details->document_tittle->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_document_tittle" id="z_document_tittle" value="LIKE"></span>
		</label>
		<div class="<?php echo $document_details_search->RightColumnClass ?>"><div<?php echo $document_details->document_tittle->cellAttributes() ?>>
			<span id="el_document_details_document_tittle">
<input type="text" data-table="document_details" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_details->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_details->document_tittle->EditValue ?>"<?php echo $document_details->document_tittle->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_tittle">
		<td class="<?php echo $document_details_search->TableLeftColumnClass ?>"><span id="elh_document_details_document_tittle"><?php echo $document_details->document_tittle->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_document_tittle" id="z_document_tittle" value="LIKE"></span></td>
		<td<?php echo $document_details->document_tittle->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_document_details_document_tittle">
<input type="text" data-table="document_details" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_details->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_details->document_tittle->EditValue ?>"<?php echo $document_details->document_tittle->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->project_name->Visible) { // project_name ?>
<?php if ($document_details_search->IsMobileOrModal) { ?>
	<div id="r_project_name" class="form-group row">
		<label class="<?php echo $document_details_search->LeftColumnClass ?>"><span id="elh_document_details_project_name"><?php echo $document_details->project_name->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_project_name" id="z_project_name" value="LIKE"></span>
		</label>
		<div class="<?php echo $document_details_search->RightColumnClass ?>"><div<?php echo $document_details->project_name->cellAttributes() ?>>
			<span id="el_document_details_project_name">
<?php
$wrkonchange = "" . trim(@$document_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x_project_name" class="text-nowrap" style="z-index: 8950">
	<input type="text" class="form-control" name="sv_x_project_name" id="sv_x_project_name" value="<?php echo RemoveHtml($document_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>"<?php echo $document_details->project_name->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" data-value-separator="<?php echo $document_details->project_name->displayValueSeparatorAttribute() ?>" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($document_details->project_name->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailssearch.createAutoSuggest({"id":"x_project_name","forceSelect":false});
</script>
<?php echo $document_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_name">
		<td class="<?php echo $document_details_search->TableLeftColumnClass ?>"><span id="elh_document_details_project_name"><?php echo $document_details->project_name->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_project_name" id="z_project_name" value="LIKE"></span></td>
		<td<?php echo $document_details->project_name->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_document_details_project_name">
<?php
$wrkonchange = "" . trim(@$document_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x_project_name" class="text-nowrap" style="z-index: 8950">
	<input type="text" class="form-control" name="sv_x_project_name" id="sv_x_project_name" value="<?php echo RemoveHtml($document_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->project_name->getPlaceHolder()) ?>"<?php echo $document_details->project_name->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_details" data-field="x_project_name" data-value-separator="<?php echo $document_details->project_name->displayValueSeparatorAttribute() ?>" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($document_details->project_name->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailssearch.createAutoSuggest({"id":"x_project_name","forceSelect":false});
</script>
<?php echo $document_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->project_system->Visible) { // project_system ?>
<?php if ($document_details_search->IsMobileOrModal) { ?>
	<div id="r_project_system" class="form-group row">
		<label for="x_project_system" class="<?php echo $document_details_search->LeftColumnClass ?>"><span id="elh_document_details_project_system"><?php echo $document_details->project_system->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_project_system" id="z_project_system" value="LIKE"></span>
		</label>
		<div class="<?php echo $document_details_search->RightColumnClass ?>"><div<?php echo $document_details->project_system->cellAttributes() ?>>
			<span id="el_document_details_project_system">
<input type="text" data-table="document_details" data-field="x_project_system" name="x_project_system" id="x_project_system" size="30" placeholder="<?php echo HtmlEncode($document_details->project_system->getPlaceHolder()) ?>" value="<?php echo $document_details->project_system->EditValue ?>"<?php echo $document_details->project_system->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_system">
		<td class="<?php echo $document_details_search->TableLeftColumnClass ?>"><span id="elh_document_details_project_system"><?php echo $document_details->project_system->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_project_system" id="z_project_system" value="LIKE"></span></td>
		<td<?php echo $document_details->project_system->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_document_details_project_system">
<input type="text" data-table="document_details" data-field="x_project_system" name="x_project_system" id="x_project_system" size="30" placeholder="<?php echo HtmlEncode($document_details->project_system->getPlaceHolder()) ?>" value="<?php echo $document_details->project_system->EditValue ?>"<?php echo $document_details->project_system->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->planned_date->Visible) { // planned_date ?>
<?php if ($document_details_search->IsMobileOrModal) { ?>
	<div id="r_planned_date" class="form-group row">
		<label for="x_planned_date" class="<?php echo $document_details_search->LeftColumnClass ?>"><span id="elh_document_details_planned_date"><?php echo $document_details->planned_date->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_planned_date" id="z_planned_date" value="="></span>
		</label>
		<div class="<?php echo $document_details_search->RightColumnClass ?>"><div<?php echo $document_details->planned_date->cellAttributes() ?>>
			<span id="el_document_details_planned_date">
<input type="text" data-table="document_details" data-field="x_planned_date" data-format="5" name="x_planned_date" id="x_planned_date" placeholder="<?php echo HtmlEncode($document_details->planned_date->getPlaceHolder()) ?>" value="<?php echo $document_details->planned_date->EditValue ?>"<?php echo $document_details->planned_date->editAttributes() ?>>
<?php if (!$document_details->planned_date->ReadOnly && !$document_details->planned_date->Disabled && !isset($document_details->planned_date->EditAttrs["readonly"]) && !isset($document_details->planned_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailssearch", "x_planned_date", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date">
		<td class="<?php echo $document_details_search->TableLeftColumnClass ?>"><span id="elh_document_details_planned_date"><?php echo $document_details->planned_date->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_planned_date" id="z_planned_date" value="="></span></td>
		<td<?php echo $document_details->planned_date->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_document_details_planned_date">
<input type="text" data-table="document_details" data-field="x_planned_date" data-format="5" name="x_planned_date" id="x_planned_date" placeholder="<?php echo HtmlEncode($document_details->planned_date->getPlaceHolder()) ?>" value="<?php echo $document_details->planned_date->EditValue ?>"<?php echo $document_details->planned_date->editAttributes() ?>>
<?php if (!$document_details->planned_date->ReadOnly && !$document_details->planned_date->Disabled && !isset($document_details->planned_date->EditAttrs["readonly"]) && !isset($document_details->planned_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailssearch", "x_planned_date", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->document_type->Visible) { // document_type ?>
<?php if ($document_details_search->IsMobileOrModal) { ?>
	<div id="r_document_type" class="form-group row">
		<label class="<?php echo $document_details_search->LeftColumnClass ?>"><span id="elh_document_details_document_type"><?php echo $document_details->document_type->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_document_type" id="z_document_type" value="LIKE"></span>
		</label>
		<div class="<?php echo $document_details_search->RightColumnClass ?>"><div<?php echo $document_details->document_type->cellAttributes() ?>>
			<span id="el_document_details_document_type">
<?php
$wrkonchange = "" . trim(@$document_details->document_type->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->document_type->EditAttrs["onchange"] = "";
?>
<span id="as_x_document_type" class="text-nowrap" style="z-index: 8910">
	<input type="text" class="form-control" name="sv_x_document_type" id="sv_x_document_type" value="<?php echo RemoveHtml($document_details->document_type->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>"<?php echo $document_details->document_type->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" data-value-separator="<?php echo $document_details->document_type->displayValueSeparatorAttribute() ?>" name="x_document_type" id="x_document_type" value="<?php echo HtmlEncode($document_details->document_type->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailssearch.createAutoSuggest({"id":"x_document_type","forceSelect":false});
</script>
<?php echo $document_details->document_type->Lookup->getParamTag("p_x_document_type") ?>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_type">
		<td class="<?php echo $document_details_search->TableLeftColumnClass ?>"><span id="elh_document_details_document_type"><?php echo $document_details->document_type->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_document_type" id="z_document_type" value="LIKE"></span></td>
		<td<?php echo $document_details->document_type->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_document_details_document_type">
<?php
$wrkonchange = "" . trim(@$document_details->document_type->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$document_details->document_type->EditAttrs["onchange"] = "";
?>
<span id="as_x_document_type" class="text-nowrap" style="z-index: 8910">
	<input type="text" class="form-control" name="sv_x_document_type" id="sv_x_document_type" value="<?php echo RemoveHtml($document_details->document_type->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($document_details->document_type->getPlaceHolder()) ?>"<?php echo $document_details->document_type->editAttributes() ?>>
</span>
<input type="hidden" data-table="document_details" data-field="x_document_type" data-value-separator="<?php echo $document_details->document_type->displayValueSeparatorAttribute() ?>" name="x_document_type" id="x_document_type" value="<?php echo HtmlEncode($document_details->document_type->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdocument_detailssearch.createAutoSuggest({"id":"x_document_type","forceSelect":false});
</script>
<?php echo $document_details->document_type->Lookup->getParamTag("p_x_document_type") ?>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details->expiry_date->Visible) { // expiry_date ?>
<?php if ($document_details_search->IsMobileOrModal) { ?>
	<div id="r_expiry_date" class="form-group row">
		<label for="x_expiry_date" class="<?php echo $document_details_search->LeftColumnClass ?>"><span id="elh_document_details_expiry_date"><?php echo $document_details->expiry_date->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_expiry_date" id="z_expiry_date" value="="></span>
		</label>
		<div class="<?php echo $document_details_search->RightColumnClass ?>"><div<?php echo $document_details->expiry_date->cellAttributes() ?>>
			<span id="el_document_details_expiry_date">
<input type="text" data-table="document_details" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" placeholder="<?php echo HtmlEncode($document_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $document_details->expiry_date->EditValue ?>"<?php echo $document_details->expiry_date->editAttributes() ?>>
<?php if (!$document_details->expiry_date->ReadOnly && !$document_details->expiry_date->Disabled && !isset($document_details->expiry_date->EditAttrs["readonly"]) && !isset($document_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailssearch", "x_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_expiry_date">
		<td class="<?php echo $document_details_search->TableLeftColumnClass ?>"><span id="elh_document_details_expiry_date"><?php echo $document_details->expiry_date->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_expiry_date" id="z_expiry_date" value="="></span></td>
		<td<?php echo $document_details->expiry_date->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_document_details_expiry_date">
<input type="text" data-table="document_details" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" placeholder="<?php echo HtmlEncode($document_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $document_details->expiry_date->EditValue ?>"<?php echo $document_details->expiry_date->editAttributes() ?>>
<?php if (!$document_details->expiry_date->ReadOnly && !$document_details->expiry_date->Disabled && !isset($document_details->expiry_date->EditAttrs["readonly"]) && !isset($document_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_detailssearch", "x_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_details_search->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$document_details_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $document_details_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$document_details_search->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$document_details_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$document_details_search->terminate();
?>