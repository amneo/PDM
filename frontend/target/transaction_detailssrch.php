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
$transaction_details_search = new transaction_details_search();

// Run the page
$transaction_details_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transaction_details_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($transaction_details_search->IsModal) { ?>
var ftransaction_detailssearch = currentAdvancedSearchForm = new ew.Form("ftransaction_detailssearch", "search");
<?php } else { ?>
var ftransaction_detailssearch = currentForm = new ew.Form("ftransaction_detailssearch", "search");
<?php } ?>

// Form_CustomValidate event
ftransaction_detailssearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftransaction_detailssearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftransaction_detailssearch.lists["x_firelink_doc_no"] = <?php echo $transaction_details_search->firelink_doc_no->Lookup->toClientList() ?>;
ftransaction_detailssearch.lists["x_firelink_doc_no"].options = <?php echo JsonEncode($transaction_details_search->firelink_doc_no->lookupOptions()) ?>;
ftransaction_detailssearch.autoSuggests["x_firelink_doc_no"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftransaction_detailssearch.lists["x_transmit_no"] = <?php echo $transaction_details_search->transmit_no->Lookup->toClientList() ?>;
ftransaction_detailssearch.lists["x_transmit_no"].options = <?php echo JsonEncode($transaction_details_search->transmit_no->lookupOptions()) ?>;
ftransaction_detailssearch.autoSuggests["x_transmit_no"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftransaction_detailssearch.lists["x_direction"] = <?php echo $transaction_details_search->direction->Lookup->toClientList() ?>;
ftransaction_detailssearch.lists["x_direction"].options = <?php echo JsonEncode($transaction_details_search->direction->options(FALSE, TRUE)) ?>;
ftransaction_detailssearch.lists["x_approval_status"] = <?php echo $transaction_details_search->approval_status->Lookup->toClientList() ?>;
ftransaction_detailssearch.lists["x_approval_status"].options = <?php echo JsonEncode($transaction_details_search->approval_status->lookupOptions()) ?>;

// Form object for search
// Validate function for search

ftransaction_detailssearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_transmit_date");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($transaction_details->transmit_date->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $transaction_details_search->showPageHeader(); ?>
<?php
$transaction_details_search->showMessage();
?>
<form name="ftransaction_detailssearch" id="ftransaction_detailssearch" class="<?php echo $transaction_details_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($transaction_details_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $transaction_details_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transaction_details">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$transaction_details_search->IsModal ?>">
<?php if (!$transaction_details_search->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($transaction_details_search->IsMobileOrModal) { ?>
<div class="ew-search-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_transaction_detailssearch" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($transaction_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
<?php if ($transaction_details_search->IsMobileOrModal) { ?>
	<div id="r_firelink_doc_no" class="form-group row">
		<label class="<?php echo $transaction_details_search->LeftColumnClass ?>"><span id="elh_transaction_details_firelink_doc_no"><?php echo $transaction_details->firelink_doc_no->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_firelink_doc_no" id="z_firelink_doc_no" value="LIKE"></span>
		</label>
		<div class="<?php echo $transaction_details_search->RightColumnClass ?>"><div<?php echo $transaction_details->firelink_doc_no->cellAttributes() ?>>
			<span id="el_transaction_details_firelink_doc_no">
<?php
$wrkonchange = "" . trim(@$transaction_details->firelink_doc_no->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transaction_details->firelink_doc_no->EditAttrs["onchange"] = "";
?>
<span id="as_x_firelink_doc_no" class="text-nowrap" style="z-index: 8980">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x_firelink_doc_no" id="sv_x_firelink_doc_no" value="<?php echo RemoveHtml($transaction_details->firelink_doc_no->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($transaction_details->firelink_doc_no->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transaction_details->firelink_doc_no->getPlaceHolder()) ?>"<?php echo $transaction_details->firelink_doc_no->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($transaction_details->firelink_doc_no->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_firelink_doc_no',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo (($transaction_details->firelink_doc_no->ReadOnly || $transaction_details->firelink_doc_no->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" data-page="1" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $transaction_details->firelink_doc_no->displayValueSeparatorAttribute() ?>" name="x_firelink_doc_no" id="x_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransaction_detailssearch.createAutoSuggest({"id":"x_firelink_doc_no","forceSelect":false});
</script>
<?php echo $transaction_details->firelink_doc_no->Lookup->getParamTag("p_x_firelink_doc_no") ?>
</span>
			<span class="ew-search-cond btw0_firelink_doc_no"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="v_firelink_doc_no_1" name="v_firelink_doc_no" value="AND"<?php if ($transaction_details->firelink_doc_no->AdvancedSearch->SearchCondition <> "OR") echo " checked" ?>><label class="form-check-label" for="v_firelink_doc_no_1"><?php echo $Language->phrase("AND") ?></label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="v_firelink_doc_no_2" name="v_firelink_doc_no" value="OR"<?php if ($transaction_details->firelink_doc_no->AdvancedSearch->SearchCondition == "OR") echo " checked" ?>><label class="form-check-label" for="v_firelink_doc_no_2"><?php echo $Language->phrase("OR") ?></label></div></span>
			<span class="ew-search-operator btw0_firelink_doc_no"><?php echo $Language->phrase("ENDS WITH") ?><input type="hidden" name="w_firelink_doc_no" id="w_firelink_doc_no" value="ENDS WITH"></span>
			<span id="e2_transaction_details_firelink_doc_no" class="">
<?php
$wrkonchange = "" . trim(@$transaction_details->firelink_doc_no->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transaction_details->firelink_doc_no->EditAttrs["onchange"] = "";
?>
<span id="as_y_firelink_doc_no" class="text-nowrap" style="z-index: 8980">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_y_firelink_doc_no" id="sv_y_firelink_doc_no" value="<?php echo RemoveHtml($transaction_details->firelink_doc_no->EditValue2) ?>" size="30" placeholder="<?php echo HtmlEncode($transaction_details->firelink_doc_no->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transaction_details->firelink_doc_no->getPlaceHolder()) ?>"<?php echo $transaction_details->firelink_doc_no->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($transaction_details->firelink_doc_no->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'y_firelink_doc_no',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo (($transaction_details->firelink_doc_no->ReadOnly || $transaction_details->firelink_doc_no->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" data-page="1" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $transaction_details->firelink_doc_no->displayValueSeparatorAttribute() ?>" name="y_firelink_doc_no" id="y_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->AdvancedSearch->SearchValue2) ?>"<?php echo $wrkonchange ?>>
<script>
ftransaction_detailssearch.createAutoSuggest({"id":"y_firelink_doc_no","forceSelect":false});
</script>
<?php echo $transaction_details->firelink_doc_no->Lookup->getParamTag("p_y_firelink_doc_no") ?>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_firelink_doc_no">
		<td class="<?php echo $transaction_details_search->TableLeftColumnClass ?>"><span id="elh_transaction_details_firelink_doc_no"><?php echo $transaction_details->firelink_doc_no->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_firelink_doc_no" id="z_firelink_doc_no" value="LIKE"></span></td>
		<td<?php echo $transaction_details->firelink_doc_no->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_transaction_details_firelink_doc_no">
<?php
$wrkonchange = "" . trim(@$transaction_details->firelink_doc_no->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transaction_details->firelink_doc_no->EditAttrs["onchange"] = "";
?>
<span id="as_x_firelink_doc_no" class="text-nowrap" style="z-index: 8980">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x_firelink_doc_no" id="sv_x_firelink_doc_no" value="<?php echo RemoveHtml($transaction_details->firelink_doc_no->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($transaction_details->firelink_doc_no->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transaction_details->firelink_doc_no->getPlaceHolder()) ?>"<?php echo $transaction_details->firelink_doc_no->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($transaction_details->firelink_doc_no->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_firelink_doc_no',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo (($transaction_details->firelink_doc_no->ReadOnly || $transaction_details->firelink_doc_no->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" data-page="1" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $transaction_details->firelink_doc_no->displayValueSeparatorAttribute() ?>" name="x_firelink_doc_no" id="x_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransaction_detailssearch.createAutoSuggest({"id":"x_firelink_doc_no","forceSelect":false});
</script>
<?php echo $transaction_details->firelink_doc_no->Lookup->getParamTag("p_x_firelink_doc_no") ?>
</span>
				<span class="ew-search-cond btw0_firelink_doc_no"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="v_firelink_doc_no_1" name="v_firelink_doc_no" value="AND"<?php if ($transaction_details->firelink_doc_no->AdvancedSearch->SearchCondition <> "OR") echo " checked" ?>><label class="form-check-label" for="v_firelink_doc_no_1"><?php echo $Language->phrase("AND") ?></label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="v_firelink_doc_no_2" name="v_firelink_doc_no" value="OR"<?php if ($transaction_details->firelink_doc_no->AdvancedSearch->SearchCondition == "OR") echo " checked" ?>><label class="form-check-label" for="v_firelink_doc_no_2"><?php echo $Language->phrase("OR") ?></label></div></span>
				<span class="ew-search-operator btw0_firelink_doc_no"><?php echo $Language->phrase("ENDS WITH") ?><input type="hidden" name="w_firelink_doc_no" id="w_firelink_doc_no" value="ENDS WITH"></span>
				<span id="e2_transaction_details_firelink_doc_no" class="">
<?php
$wrkonchange = "" . trim(@$transaction_details->firelink_doc_no->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transaction_details->firelink_doc_no->EditAttrs["onchange"] = "";
?>
<span id="as_y_firelink_doc_no" class="text-nowrap" style="z-index: 8980">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_y_firelink_doc_no" id="sv_y_firelink_doc_no" value="<?php echo RemoveHtml($transaction_details->firelink_doc_no->EditValue2) ?>" size="30" placeholder="<?php echo HtmlEncode($transaction_details->firelink_doc_no->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transaction_details->firelink_doc_no->getPlaceHolder()) ?>"<?php echo $transaction_details->firelink_doc_no->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($transaction_details->firelink_doc_no->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'y_firelink_doc_no',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo (($transaction_details->firelink_doc_no->ReadOnly || $transaction_details->firelink_doc_no->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" data-page="1" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $transaction_details->firelink_doc_no->displayValueSeparatorAttribute() ?>" name="y_firelink_doc_no" id="y_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->AdvancedSearch->SearchValue2) ?>"<?php echo $wrkonchange ?>>
<script>
ftransaction_detailssearch.createAutoSuggest({"id":"y_firelink_doc_no","forceSelect":false});
</script>
<?php echo $transaction_details->firelink_doc_no->Lookup->getParamTag("p_y_firelink_doc_no") ?>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->submit_no->Visible) { // submit_no ?>
<?php if ($transaction_details_search->IsMobileOrModal) { ?>
	<div id="r_submit_no" class="form-group row">
		<label for="x_submit_no" class="<?php echo $transaction_details_search->LeftColumnClass ?>"><span id="elh_transaction_details_submit_no"><?php echo $transaction_details->submit_no->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_submit_no" id="z_submit_no" value="LIKE"></span>
		</label>
		<div class="<?php echo $transaction_details_search->RightColumnClass ?>"><div<?php echo $transaction_details->submit_no->cellAttributes() ?>>
			<span id="el_transaction_details_submit_no">
<input type="text" data-table="transaction_details" data-field="x_submit_no" data-page="1" name="x_submit_no" id="x_submit_no" size="30" placeholder="<?php echo HtmlEncode($transaction_details->submit_no->getPlaceHolder()) ?>" value="<?php echo $transaction_details->submit_no->EditValue ?>"<?php echo $transaction_details->submit_no->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no">
		<td class="<?php echo $transaction_details_search->TableLeftColumnClass ?>"><span id="elh_transaction_details_submit_no"><?php echo $transaction_details->submit_no->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_submit_no" id="z_submit_no" value="LIKE"></span></td>
		<td<?php echo $transaction_details->submit_no->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_transaction_details_submit_no">
<input type="text" data-table="transaction_details" data-field="x_submit_no" data-page="1" name="x_submit_no" id="x_submit_no" size="30" placeholder="<?php echo HtmlEncode($transaction_details->submit_no->getPlaceHolder()) ?>" value="<?php echo $transaction_details->submit_no->EditValue ?>"<?php echo $transaction_details->submit_no->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->revision_no->Visible) { // revision_no ?>
<?php if ($transaction_details_search->IsMobileOrModal) { ?>
	<div id="r_revision_no" class="form-group row">
		<label for="x_revision_no" class="<?php echo $transaction_details_search->LeftColumnClass ?>"><span id="elh_transaction_details_revision_no"><?php echo $transaction_details->revision_no->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_revision_no" id="z_revision_no" value="LIKE"></span>
		</label>
		<div class="<?php echo $transaction_details_search->RightColumnClass ?>"><div<?php echo $transaction_details->revision_no->cellAttributes() ?>>
			<span id="el_transaction_details_revision_no">
<input type="text" data-table="transaction_details" data-field="x_revision_no" data-page="1" name="x_revision_no" id="x_revision_no" size="30" placeholder="<?php echo HtmlEncode($transaction_details->revision_no->getPlaceHolder()) ?>" value="<?php echo $transaction_details->revision_no->EditValue ?>"<?php echo $transaction_details->revision_no->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no">
		<td class="<?php echo $transaction_details_search->TableLeftColumnClass ?>"><span id="elh_transaction_details_revision_no"><?php echo $transaction_details->revision_no->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_revision_no" id="z_revision_no" value="LIKE"></span></td>
		<td<?php echo $transaction_details->revision_no->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_transaction_details_revision_no">
<input type="text" data-table="transaction_details" data-field="x_revision_no" data-page="1" name="x_revision_no" id="x_revision_no" size="30" placeholder="<?php echo HtmlEncode($transaction_details->revision_no->getPlaceHolder()) ?>" value="<?php echo $transaction_details->revision_no->EditValue ?>"<?php echo $transaction_details->revision_no->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->transmit_no->Visible) { // transmit_no ?>
<?php if ($transaction_details_search->IsMobileOrModal) { ?>
	<div id="r_transmit_no" class="form-group row">
		<label class="<?php echo $transaction_details_search->LeftColumnClass ?>"><span id="elh_transaction_details_transmit_no"><?php echo $transaction_details->transmit_no->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_transmit_no" id="z_transmit_no" value="LIKE"></span>
		</label>
		<div class="<?php echo $transaction_details_search->RightColumnClass ?>"><div<?php echo $transaction_details->transmit_no->cellAttributes() ?>>
			<span id="el_transaction_details_transmit_no">
<?php
$wrkonchange = "" . trim(@$transaction_details->transmit_no->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transaction_details->transmit_no->EditAttrs["onchange"] = "";
?>
<span id="as_x_transmit_no" class="text-nowrap" style="z-index: 8950">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x_transmit_no" id="sv_x_transmit_no" value="<?php echo RemoveHtml($transaction_details->transmit_no->EditValue) ?>" placeholder="<?php echo HtmlEncode($transaction_details->transmit_no->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transaction_details->transmit_no->getPlaceHolder()) ?>"<?php echo $transaction_details->transmit_no->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($transaction_details->transmit_no->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_transmit_no',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo (($transaction_details->transmit_no->ReadOnly || $transaction_details->transmit_no->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_no" data-page="1" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $transaction_details->transmit_no->displayValueSeparatorAttribute() ?>" name="x_transmit_no" id="x_transmit_no" value="<?php echo HtmlEncode($transaction_details->transmit_no->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransaction_detailssearch.createAutoSuggest({"id":"x_transmit_no","forceSelect":false});
</script>
<?php echo $transaction_details->transmit_no->Lookup->getParamTag("p_x_transmit_no") ?>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no">
		<td class="<?php echo $transaction_details_search->TableLeftColumnClass ?>"><span id="elh_transaction_details_transmit_no"><?php echo $transaction_details->transmit_no->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_transmit_no" id="z_transmit_no" value="LIKE"></span></td>
		<td<?php echo $transaction_details->transmit_no->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_transaction_details_transmit_no">
<?php
$wrkonchange = "" . trim(@$transaction_details->transmit_no->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transaction_details->transmit_no->EditAttrs["onchange"] = "";
?>
<span id="as_x_transmit_no" class="text-nowrap" style="z-index: 8950">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x_transmit_no" id="sv_x_transmit_no" value="<?php echo RemoveHtml($transaction_details->transmit_no->EditValue) ?>" placeholder="<?php echo HtmlEncode($transaction_details->transmit_no->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transaction_details->transmit_no->getPlaceHolder()) ?>"<?php echo $transaction_details->transmit_no->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($transaction_details->transmit_no->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_transmit_no',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo (($transaction_details->transmit_no->ReadOnly || $transaction_details->transmit_no->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_no" data-page="1" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $transaction_details->transmit_no->displayValueSeparatorAttribute() ?>" name="x_transmit_no" id="x_transmit_no" value="<?php echo HtmlEncode($transaction_details->transmit_no->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransaction_detailssearch.createAutoSuggest({"id":"x_transmit_no","forceSelect":false});
</script>
<?php echo $transaction_details->transmit_no->Lookup->getParamTag("p_x_transmit_no") ?>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->transmit_date->Visible) { // transmit_date ?>
<?php if ($transaction_details_search->IsMobileOrModal) { ?>
	<div id="r_transmit_date" class="form-group row">
		<label for="x_transmit_date" class="<?php echo $transaction_details_search->LeftColumnClass ?>"><span id="elh_transaction_details_transmit_date"><?php echo $transaction_details->transmit_date->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_transmit_date" id="z_transmit_date" value="="></span>
		</label>
		<div class="<?php echo $transaction_details_search->RightColumnClass ?>"><div<?php echo $transaction_details->transmit_date->cellAttributes() ?>>
			<span id="el_transaction_details_transmit_date">
<input type="text" data-table="transaction_details" data-field="x_transmit_date" data-page="1" name="x_transmit_date" id="x_transmit_date" placeholder="<?php echo HtmlEncode($transaction_details->transmit_date->getPlaceHolder()) ?>" value="<?php echo $transaction_details->transmit_date->EditValue ?>"<?php echo $transaction_details->transmit_date->editAttributes() ?>>
<?php if (!$transaction_details->transmit_date->ReadOnly && !$transaction_details->transmit_date->Disabled && !isset($transaction_details->transmit_date->EditAttrs["readonly"]) && !isset($transaction_details->transmit_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftransaction_detailssearch", "x_transmit_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date">
		<td class="<?php echo $transaction_details_search->TableLeftColumnClass ?>"><span id="elh_transaction_details_transmit_date"><?php echo $transaction_details->transmit_date->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_transmit_date" id="z_transmit_date" value="="></span></td>
		<td<?php echo $transaction_details->transmit_date->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_transaction_details_transmit_date">
<input type="text" data-table="transaction_details" data-field="x_transmit_date" data-page="1" name="x_transmit_date" id="x_transmit_date" placeholder="<?php echo HtmlEncode($transaction_details->transmit_date->getPlaceHolder()) ?>" value="<?php echo $transaction_details->transmit_date->EditValue ?>"<?php echo $transaction_details->transmit_date->editAttributes() ?>>
<?php if (!$transaction_details->transmit_date->ReadOnly && !$transaction_details->transmit_date->Disabled && !isset($transaction_details->transmit_date->EditAttrs["readonly"]) && !isset($transaction_details->transmit_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftransaction_detailssearch", "x_transmit_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->direction->Visible) { // direction ?>
<?php if ($transaction_details_search->IsMobileOrModal) { ?>
	<div id="r_direction" class="form-group row">
		<label class="<?php echo $transaction_details_search->LeftColumnClass ?>"><span id="elh_transaction_details_direction"><?php echo $transaction_details->direction->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_direction" id="z_direction" value="LIKE"></span>
		</label>
		<div class="<?php echo $transaction_details_search->RightColumnClass ?>"><div<?php echo $transaction_details->direction->cellAttributes() ?>>
			<span id="el_transaction_details_direction">
<div id="tp_x_direction" class="ew-template"><input type="radio" class="form-check-input" data-table="transaction_details" data-field="x_direction" data-page="1" data-value-separator="<?php echo $transaction_details->direction->displayValueSeparatorAttribute() ?>" name="x_direction" id="x_direction" value="{value}"<?php echo $transaction_details->direction->editAttributes() ?>></div>
<div id="dsl_x_direction" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transaction_details->direction->radioButtonListHtml(FALSE, "x_direction", 1) ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction">
		<td class="<?php echo $transaction_details_search->TableLeftColumnClass ?>"><span id="elh_transaction_details_direction"><?php echo $transaction_details->direction->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_direction" id="z_direction" value="LIKE"></span></td>
		<td<?php echo $transaction_details->direction->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_transaction_details_direction">
<div id="tp_x_direction" class="ew-template"><input type="radio" class="form-check-input" data-table="transaction_details" data-field="x_direction" data-page="1" data-value-separator="<?php echo $transaction_details->direction->displayValueSeparatorAttribute() ?>" name="x_direction" id="x_direction" value="{value}"<?php echo $transaction_details->direction->editAttributes() ?>></div>
<div id="dsl_x_direction" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transaction_details->direction->radioButtonListHtml(FALSE, "x_direction", 1) ?>
</div></div>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->approval_status->Visible) { // approval_status ?>
<?php if ($transaction_details_search->IsMobileOrModal) { ?>
	<div id="r_approval_status" class="form-group row">
		<label class="<?php echo $transaction_details_search->LeftColumnClass ?>"><span id="elh_transaction_details_approval_status"><?php echo $transaction_details->approval_status->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_approval_status" id="z_approval_status" value="LIKE"></span>
		</label>
		<div class="<?php echo $transaction_details_search->RightColumnClass ?>"><div<?php echo $transaction_details->approval_status->cellAttributes() ?>>
			<span id="el_transaction_details_approval_status">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($transaction_details->approval_status->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $transaction_details->approval_status->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_approval_status" data-repeatcolumn="5" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $transaction_details->approval_status->radioButtonListHtml(TRUE, "x_approval_status", 1) ?>
			</div><!-- /.ew-items ##-->
		</div><!-- /.dropdown-menu ##-->
		<div id="tp_x_approval_status" class="ew-template"><input type="radio" class="form-check-input" data-table="transaction_details" data-field="x_approval_status" data-page="1" data-value-separator="<?php echo $transaction_details->approval_status->displayValueSeparatorAttribute() ?>" name="x_approval_status" id="x_approval_status" value="{value}"<?php echo $transaction_details->approval_status->editAttributes() ?>></div>
	</div><!-- /.btn-group ##-->
	<?php if (!$transaction_details->approval_status->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fa fa-times ew-icon"></i>
	</button>
<?php echo $transaction_details->approval_status->Lookup->getParamTag("p_x_approval_status") ?>
	<?php } ?>
</div><!-- /.ew-dropdown-list ##-->
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status">
		<td class="<?php echo $transaction_details_search->TableLeftColumnClass ?>"><span id="elh_transaction_details_approval_status"><?php echo $transaction_details->approval_status->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_approval_status" id="z_approval_status" value="LIKE"></span></td>
		<td<?php echo $transaction_details->approval_status->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_transaction_details_approval_status">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($transaction_details->approval_status->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $transaction_details->approval_status->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_approval_status" data-repeatcolumn="5" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $transaction_details->approval_status->radioButtonListHtml(TRUE, "x_approval_status", 1) ?>
			</div><!-- /.ew-items ##-->
		</div><!-- /.dropdown-menu ##-->
		<div id="tp_x_approval_status" class="ew-template"><input type="radio" class="form-check-input" data-table="transaction_details" data-field="x_approval_status" data-page="1" data-value-separator="<?php echo $transaction_details->approval_status->displayValueSeparatorAttribute() ?>" name="x_approval_status" id="x_approval_status" value="{value}"<?php echo $transaction_details->approval_status->editAttributes() ?>></div>
	</div><!-- /.btn-group ##-->
	<?php if (!$transaction_details->approval_status->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fa fa-times ew-icon"></i>
	</button>
<?php echo $transaction_details->approval_status->Lookup->getParamTag("p_x_approval_status") ?>
	<?php } ?>
</div><!-- /.ew-dropdown-list ##-->
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->document_link->Visible) { // document_link ?>
<?php if ($transaction_details_search->IsMobileOrModal) { ?>
	<div id="r_document_link" class="form-group row">
		<label class="<?php echo $transaction_details_search->LeftColumnClass ?>"><span id="elh_transaction_details_document_link"><?php echo $transaction_details->document_link->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_document_link" id="z_document_link" value="LIKE"></span>
		</label>
		<div class="<?php echo $transaction_details_search->RightColumnClass ?>"><div<?php echo $transaction_details->document_link->cellAttributes() ?>>
			<span id="el_transaction_details_document_link">
<input type="text" data-table="transaction_details" data-field="x_document_link" data-page="1" name="x_document_link" id="x_document_link" size="30" placeholder="<?php echo HtmlEncode($transaction_details->document_link->getPlaceHolder()) ?>" value="<?php echo $transaction_details->document_link->EditValue ?>"<?php echo $transaction_details->document_link->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_link">
		<td class="<?php echo $transaction_details_search->TableLeftColumnClass ?>"><span id="elh_transaction_details_document_link"><?php echo $transaction_details->document_link->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_document_link" id="z_document_link" value="LIKE"></span></td>
		<td<?php echo $transaction_details->document_link->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_transaction_details_document_link">
<input type="text" data-table="transaction_details" data-field="x_document_link" data-page="1" name="x_document_link" id="x_document_link" size="30" placeholder="<?php echo HtmlEncode($transaction_details->document_link->getPlaceHolder()) ?>" value="<?php echo $transaction_details->document_link->EditValue ?>"<?php echo $transaction_details->document_link->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->document_native->Visible) { // document_native ?>
<?php if ($transaction_details_search->IsMobileOrModal) { ?>
	<div id="r_document_native" class="form-group row">
		<label for="x_document_native" class="<?php echo $transaction_details_search->LeftColumnClass ?>"><span id="elh_transaction_details_document_native"><?php echo $transaction_details->document_native->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_document_native" id="z_document_native" value="LIKE"></span>
		</label>
		<div class="<?php echo $transaction_details_search->RightColumnClass ?>"><div<?php echo $transaction_details->document_native->cellAttributes() ?>>
			<span id="el_transaction_details_document_native">
<input type="text" data-table="transaction_details" data-field="x_document_native" data-page="1" name="x_document_native" id="x_document_native" size="35" placeholder="<?php echo HtmlEncode($transaction_details->document_native->getPlaceHolder()) ?>" value="<?php echo $transaction_details->document_native->EditValue ?>"<?php echo $transaction_details->document_native->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_native">
		<td class="<?php echo $transaction_details_search->TableLeftColumnClass ?>"><span id="elh_transaction_details_document_native"><?php echo $transaction_details->document_native->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_document_native" id="z_document_native" value="LIKE"></span></td>
		<td<?php echo $transaction_details->document_native->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_transaction_details_document_native">
<input type="text" data-table="transaction_details" data-field="x_document_native" data-page="1" name="x_document_native" id="x_document_native" size="35" placeholder="<?php echo HtmlEncode($transaction_details->document_native->getPlaceHolder()) ?>" value="<?php echo $transaction_details->document_native->EditValue ?>"<?php echo $transaction_details->document_native->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details_search->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$transaction_details_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $transaction_details_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$transaction_details_search->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$transaction_details_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$transaction_details_search->terminate();
?>