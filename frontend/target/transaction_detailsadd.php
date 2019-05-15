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
$transaction_details_add = new transaction_details_add();

// Run the page
$transaction_details_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transaction_details_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftransaction_detailsadd = currentForm = new ew.Form("ftransaction_detailsadd", "add");

// Validate form
ftransaction_detailsadd.validate = function() {
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
		<?php if ($transaction_details_add->firelink_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_firelink_doc_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->firelink_doc_no->caption(), $transaction_details->firelink_doc_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_add->submit_no->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->submit_no->caption(), $transaction_details->submit_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_add->revision_no->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->revision_no->caption(), $transaction_details->revision_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_add->transmit_no->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->transmit_no->caption(), $transaction_details->transmit_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_add->transmit_date->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->transmit_date->caption(), $transaction_details->transmit_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($transaction_details->transmit_date->errorMessage()) ?>");
		<?php if ($transaction_details_add->direction->Required) { ?>
			elm = this.getElements("x" + infix + "_direction");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->direction->caption(), $transaction_details->direction->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_add->approval_status->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->approval_status->caption(), $transaction_details->approval_status->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_add->document_link->Required) { ?>
			felm = this.getElements("x" + infix + "_document_link");
			elm = this.getElements("fn_x" + infix + "_document_link");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $transaction_details->document_link->caption(), $transaction_details->document_link->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_add->document_native->Required) { ?>
			elm = this.getElements("x" + infix + "_document_native");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->document_native->caption(), $transaction_details->document_native->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_add->expiry_date->Required) { ?>
			elm = this.getElements("x" + infix + "_expiry_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->expiry_date->caption(), $transaction_details->expiry_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_expiry_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($transaction_details->expiry_date->errorMessage()) ?>");

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
ftransaction_detailsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftransaction_detailsadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftransaction_detailsadd.lists["x_firelink_doc_no"] = <?php echo $transaction_details_add->firelink_doc_no->Lookup->toClientList() ?>;
ftransaction_detailsadd.lists["x_firelink_doc_no"].options = <?php echo JsonEncode($transaction_details_add->firelink_doc_no->lookupOptions()) ?>;
ftransaction_detailsadd.autoSuggests["x_firelink_doc_no"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftransaction_detailsadd.lists["x_transmit_no"] = <?php echo $transaction_details_add->transmit_no->Lookup->toClientList() ?>;
ftransaction_detailsadd.lists["x_transmit_no"].options = <?php echo JsonEncode($transaction_details_add->transmit_no->lookupOptions()) ?>;
ftransaction_detailsadd.autoSuggests["x_transmit_no"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftransaction_detailsadd.lists["x_direction"] = <?php echo $transaction_details_add->direction->Lookup->toClientList() ?>;
ftransaction_detailsadd.lists["x_direction"].options = <?php echo JsonEncode($transaction_details_add->direction->options(FALSE, TRUE)) ?>;
ftransaction_detailsadd.lists["x_approval_status"] = <?php echo $transaction_details_add->approval_status->Lookup->toClientList() ?>;
ftransaction_detailsadd.lists["x_approval_status"].options = <?php echo JsonEncode($transaction_details_add->approval_status->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $transaction_details_add->showPageHeader(); ?>
<?php
$transaction_details_add->showMessage();
?>
<form name="ftransaction_detailsadd" id="ftransaction_detailsadd" class="<?php echo $transaction_details_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($transaction_details_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $transaction_details_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transaction_details">
<?php if ($transaction_details->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$transaction_details_add->IsModal ?>">
<?php if (!$transaction_details_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($transaction_details_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_transaction_detailsadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($transaction_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
<?php if ($transaction_details_add->IsMobileOrModal) { ?>
	<div id="r_firelink_doc_no" class="form-group row">
		<label id="elh_transaction_details_firelink_doc_no" class="<?php echo $transaction_details_add->LeftColumnClass ?>"><?php echo $transaction_details->firelink_doc_no->caption() ?><?php echo ($transaction_details->firelink_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_add->RightColumnClass ?>"><div<?php echo $transaction_details->firelink_doc_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
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
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($transaction_details->firelink_doc_no->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_firelink_doc_no',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($transaction_details->firelink_doc_no->ReadOnly || $transaction_details->firelink_doc_no->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" data-page="1" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $transaction_details->firelink_doc_no->displayValueSeparatorAttribute() ?>" name="x_firelink_doc_no" id="x_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransaction_detailsadd.createAutoSuggest({"id":"x_firelink_doc_no","forceSelect":true});
</script>
<?php echo $transaction_details->firelink_doc_no->Lookup->getParamTag("p_x_firelink_doc_no") ?>
</span>
<?php } else { ?>
<span id="el_transaction_details_firelink_doc_no">
<span<?php echo $transaction_details->firelink_doc_no->viewAttributes() ?>>
<?php if ((!EmptyString($transaction_details->firelink_doc_no->ViewValue)) && $transaction_details->firelink_doc_no->linkAttributes() <> "") { ?>
<a<?php echo $transaction_details->firelink_doc_no->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->firelink_doc_no->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->firelink_doc_no->ViewValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" data-page="1" name="x_firelink_doc_no" id="x_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->firelink_doc_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_firelink_doc_no">
		<td class="<?php echo $transaction_details_add->TableLeftColumnClass ?>"><span id="elh_transaction_details_firelink_doc_no"><?php echo $transaction_details->firelink_doc_no->caption() ?><?php echo ($transaction_details->firelink_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->firelink_doc_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
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
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($transaction_details->firelink_doc_no->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_firelink_doc_no',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($transaction_details->firelink_doc_no->ReadOnly || $transaction_details->firelink_doc_no->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" data-page="1" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $transaction_details->firelink_doc_no->displayValueSeparatorAttribute() ?>" name="x_firelink_doc_no" id="x_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransaction_detailsadd.createAutoSuggest({"id":"x_firelink_doc_no","forceSelect":true});
</script>
<?php echo $transaction_details->firelink_doc_no->Lookup->getParamTag("p_x_firelink_doc_no") ?>
</span>
<?php } else { ?>
<span id="el_transaction_details_firelink_doc_no">
<span<?php echo $transaction_details->firelink_doc_no->viewAttributes() ?>>
<?php if ((!EmptyString($transaction_details->firelink_doc_no->ViewValue)) && $transaction_details->firelink_doc_no->linkAttributes() <> "") { ?>
<a<?php echo $transaction_details->firelink_doc_no->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->firelink_doc_no->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->firelink_doc_no->ViewValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" data-page="1" name="x_firelink_doc_no" id="x_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->firelink_doc_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->submit_no->Visible) { // submit_no ?>
<?php if ($transaction_details_add->IsMobileOrModal) { ?>
	<div id="r_submit_no" class="form-group row">
		<label id="elh_transaction_details_submit_no" for="x_submit_no" class="<?php echo $transaction_details_add->LeftColumnClass ?>"><?php echo $transaction_details->submit_no->caption() ?><?php echo ($transaction_details->submit_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_add->RightColumnClass ?>"><div<?php echo $transaction_details->submit_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_submit_no">
<input type="text" data-table="transaction_details" data-field="x_submit_no" data-page="1" name="x_submit_no" id="x_submit_no" size="30" placeholder="<?php echo HtmlEncode($transaction_details->submit_no->getPlaceHolder()) ?>" value="<?php echo $transaction_details->submit_no->EditValue ?>"<?php echo $transaction_details->submit_no->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_transaction_details_submit_no">
<span<?php echo $transaction_details->submit_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->submit_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_submit_no" data-page="1" name="x_submit_no" id="x_submit_no" value="<?php echo HtmlEncode($transaction_details->submit_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->submit_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no">
		<td class="<?php echo $transaction_details_add->TableLeftColumnClass ?>"><span id="elh_transaction_details_submit_no"><?php echo $transaction_details->submit_no->caption() ?><?php echo ($transaction_details->submit_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->submit_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_submit_no">
<input type="text" data-table="transaction_details" data-field="x_submit_no" data-page="1" name="x_submit_no" id="x_submit_no" size="30" placeholder="<?php echo HtmlEncode($transaction_details->submit_no->getPlaceHolder()) ?>" value="<?php echo $transaction_details->submit_no->EditValue ?>"<?php echo $transaction_details->submit_no->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_transaction_details_submit_no">
<span<?php echo $transaction_details->submit_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->submit_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_submit_no" data-page="1" name="x_submit_no" id="x_submit_no" value="<?php echo HtmlEncode($transaction_details->submit_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->submit_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->revision_no->Visible) { // revision_no ?>
<?php if ($transaction_details_add->IsMobileOrModal) { ?>
	<div id="r_revision_no" class="form-group row">
		<label id="elh_transaction_details_revision_no" for="x_revision_no" class="<?php echo $transaction_details_add->LeftColumnClass ?>"><?php echo $transaction_details->revision_no->caption() ?><?php echo ($transaction_details->revision_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_add->RightColumnClass ?>"><div<?php echo $transaction_details->revision_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_revision_no">
<input type="text" data-table="transaction_details" data-field="x_revision_no" data-page="1" name="x_revision_no" id="x_revision_no" size="30" placeholder="<?php echo HtmlEncode($transaction_details->revision_no->getPlaceHolder()) ?>" value="<?php echo $transaction_details->revision_no->EditValue ?>"<?php echo $transaction_details->revision_no->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_transaction_details_revision_no">
<span<?php echo $transaction_details->revision_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->revision_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_revision_no" data-page="1" name="x_revision_no" id="x_revision_no" value="<?php echo HtmlEncode($transaction_details->revision_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->revision_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no">
		<td class="<?php echo $transaction_details_add->TableLeftColumnClass ?>"><span id="elh_transaction_details_revision_no"><?php echo $transaction_details->revision_no->caption() ?><?php echo ($transaction_details->revision_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->revision_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_revision_no">
<input type="text" data-table="transaction_details" data-field="x_revision_no" data-page="1" name="x_revision_no" id="x_revision_no" size="30" placeholder="<?php echo HtmlEncode($transaction_details->revision_no->getPlaceHolder()) ?>" value="<?php echo $transaction_details->revision_no->EditValue ?>"<?php echo $transaction_details->revision_no->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_transaction_details_revision_no">
<span<?php echo $transaction_details->revision_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->revision_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_revision_no" data-page="1" name="x_revision_no" id="x_revision_no" value="<?php echo HtmlEncode($transaction_details->revision_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->revision_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->transmit_no->Visible) { // transmit_no ?>
<?php if ($transaction_details_add->IsMobileOrModal) { ?>
	<div id="r_transmit_no" class="form-group row">
		<label id="elh_transaction_details_transmit_no" class="<?php echo $transaction_details_add->LeftColumnClass ?>"><?php echo $transaction_details->transmit_no->caption() ?><?php echo ($transaction_details->transmit_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_add->RightColumnClass ?>"><div<?php echo $transaction_details->transmit_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_transmit_no">
<?php
$wrkonchange = "" . trim(@$transaction_details->transmit_no->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transaction_details->transmit_no->EditAttrs["onchange"] = "";
?>
<span id="as_x_transmit_no" class="text-nowrap" style="z-index: 8930">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x_transmit_no" id="sv_x_transmit_no" value="<?php echo RemoveHtml($transaction_details->transmit_no->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($transaction_details->transmit_no->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transaction_details->transmit_no->getPlaceHolder()) ?>"<?php echo $transaction_details->transmit_no->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($transaction_details->transmit_no->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_transmit_no',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($transaction_details->transmit_no->ReadOnly || $transaction_details->transmit_no->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "transmit_details") && !$transaction_details->transmit_no->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_transmit_no" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $transaction_details->transmit_no->caption() ?>" data-title="<?php echo $transaction_details->transmit_no->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_transmit_no',url:'transmit_detailsaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_no" data-page="1" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $transaction_details->transmit_no->displayValueSeparatorAttribute() ?>" name="x_transmit_no" id="x_transmit_no" value="<?php echo HtmlEncode($transaction_details->transmit_no->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransaction_detailsadd.createAutoSuggest({"id":"x_transmit_no","forceSelect":true});
</script>
<?php echo $transaction_details->transmit_no->Lookup->getParamTag("p_x_transmit_no") ?>
</span>
<?php } else { ?>
<span id="el_transaction_details_transmit_no">
<span<?php echo $transaction_details->transmit_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->transmit_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_no" data-page="1" name="x_transmit_no" id="x_transmit_no" value="<?php echo HtmlEncode($transaction_details->transmit_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->transmit_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no">
		<td class="<?php echo $transaction_details_add->TableLeftColumnClass ?>"><span id="elh_transaction_details_transmit_no"><?php echo $transaction_details->transmit_no->caption() ?><?php echo ($transaction_details->transmit_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->transmit_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_transmit_no">
<?php
$wrkonchange = "" . trim(@$transaction_details->transmit_no->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transaction_details->transmit_no->EditAttrs["onchange"] = "";
?>
<span id="as_x_transmit_no" class="text-nowrap" style="z-index: 8930">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x_transmit_no" id="sv_x_transmit_no" value="<?php echo RemoveHtml($transaction_details->transmit_no->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($transaction_details->transmit_no->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transaction_details->transmit_no->getPlaceHolder()) ?>"<?php echo $transaction_details->transmit_no->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($transaction_details->transmit_no->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_transmit_no',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($transaction_details->transmit_no->ReadOnly || $transaction_details->transmit_no->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "transmit_details") && !$transaction_details->transmit_no->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_transmit_no" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $transaction_details->transmit_no->caption() ?>" data-title="<?php echo $transaction_details->transmit_no->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_transmit_no',url:'transmit_detailsaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_no" data-page="1" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $transaction_details->transmit_no->displayValueSeparatorAttribute() ?>" name="x_transmit_no" id="x_transmit_no" value="<?php echo HtmlEncode($transaction_details->transmit_no->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransaction_detailsadd.createAutoSuggest({"id":"x_transmit_no","forceSelect":true});
</script>
<?php echo $transaction_details->transmit_no->Lookup->getParamTag("p_x_transmit_no") ?>
</span>
<?php } else { ?>
<span id="el_transaction_details_transmit_no">
<span<?php echo $transaction_details->transmit_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->transmit_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_no" data-page="1" name="x_transmit_no" id="x_transmit_no" value="<?php echo HtmlEncode($transaction_details->transmit_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->transmit_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->transmit_date->Visible) { // transmit_date ?>
<?php if ($transaction_details_add->IsMobileOrModal) { ?>
	<div id="r_transmit_date" class="form-group row">
		<label id="elh_transaction_details_transmit_date" for="x_transmit_date" class="<?php echo $transaction_details_add->LeftColumnClass ?>"><?php echo $transaction_details->transmit_date->caption() ?><?php echo ($transaction_details->transmit_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_add->RightColumnClass ?>"><div<?php echo $transaction_details->transmit_date->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_transmit_date">
<input type="text" data-table="transaction_details" data-field="x_transmit_date" data-page="1" name="x_transmit_date" id="x_transmit_date" placeholder="<?php echo HtmlEncode($transaction_details->transmit_date->getPlaceHolder()) ?>" value="<?php echo $transaction_details->transmit_date->EditValue ?>"<?php echo $transaction_details->transmit_date->editAttributes() ?>>
<?php if (!$transaction_details->transmit_date->ReadOnly && !$transaction_details->transmit_date->Disabled && !isset($transaction_details->transmit_date->EditAttrs["readonly"]) && !isset($transaction_details->transmit_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftransaction_detailsadd", "x_transmit_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_transaction_details_transmit_date">
<span<?php echo $transaction_details->transmit_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->transmit_date->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_date" data-page="1" name="x_transmit_date" id="x_transmit_date" value="<?php echo HtmlEncode($transaction_details->transmit_date->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->transmit_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date">
		<td class="<?php echo $transaction_details_add->TableLeftColumnClass ?>"><span id="elh_transaction_details_transmit_date"><?php echo $transaction_details->transmit_date->caption() ?><?php echo ($transaction_details->transmit_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->transmit_date->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_transmit_date">
<input type="text" data-table="transaction_details" data-field="x_transmit_date" data-page="1" name="x_transmit_date" id="x_transmit_date" placeholder="<?php echo HtmlEncode($transaction_details->transmit_date->getPlaceHolder()) ?>" value="<?php echo $transaction_details->transmit_date->EditValue ?>"<?php echo $transaction_details->transmit_date->editAttributes() ?>>
<?php if (!$transaction_details->transmit_date->ReadOnly && !$transaction_details->transmit_date->Disabled && !isset($transaction_details->transmit_date->EditAttrs["readonly"]) && !isset($transaction_details->transmit_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftransaction_detailsadd", "x_transmit_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_transaction_details_transmit_date">
<span<?php echo $transaction_details->transmit_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->transmit_date->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_date" data-page="1" name="x_transmit_date" id="x_transmit_date" value="<?php echo HtmlEncode($transaction_details->transmit_date->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->transmit_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->direction->Visible) { // direction ?>
<?php if ($transaction_details_add->IsMobileOrModal) { ?>
	<div id="r_direction" class="form-group row">
		<label id="elh_transaction_details_direction" class="<?php echo $transaction_details_add->LeftColumnClass ?>"><?php echo $transaction_details->direction->caption() ?><?php echo ($transaction_details->direction->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_add->RightColumnClass ?>"><div<?php echo $transaction_details->direction->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_direction">
<div id="tp_x_direction" class="ew-template"><input type="radio" class="form-check-input" data-table="transaction_details" data-field="x_direction" data-page="1" data-value-separator="<?php echo $transaction_details->direction->displayValueSeparatorAttribute() ?>" name="x_direction" id="x_direction" value="{value}"<?php echo $transaction_details->direction->editAttributes() ?>></div>
<div id="dsl_x_direction" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transaction_details->direction->radioButtonListHtml(FALSE, "x_direction", 1) ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_transaction_details_direction">
<span<?php echo $transaction_details->direction->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->direction->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_direction" data-page="1" name="x_direction" id="x_direction" value="<?php echo HtmlEncode($transaction_details->direction->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->direction->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction">
		<td class="<?php echo $transaction_details_add->TableLeftColumnClass ?>"><span id="elh_transaction_details_direction"><?php echo $transaction_details->direction->caption() ?><?php echo ($transaction_details->direction->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->direction->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_direction">
<div id="tp_x_direction" class="ew-template"><input type="radio" class="form-check-input" data-table="transaction_details" data-field="x_direction" data-page="1" data-value-separator="<?php echo $transaction_details->direction->displayValueSeparatorAttribute() ?>" name="x_direction" id="x_direction" value="{value}"<?php echo $transaction_details->direction->editAttributes() ?>></div>
<div id="dsl_x_direction" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transaction_details->direction->radioButtonListHtml(FALSE, "x_direction", 1) ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_transaction_details_direction">
<span<?php echo $transaction_details->direction->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->direction->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_direction" data-page="1" name="x_direction" id="x_direction" value="<?php echo HtmlEncode($transaction_details->direction->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->direction->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->approval_status->Visible) { // approval_status ?>
<?php if ($transaction_details_add->IsMobileOrModal) { ?>
	<div id="r_approval_status" class="form-group row">
		<label id="elh_transaction_details_approval_status" class="<?php echo $transaction_details_add->LeftColumnClass ?>"><?php echo $transaction_details->approval_status->caption() ?><?php echo ($transaction_details->approval_status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_add->RightColumnClass ?>"><div<?php echo $transaction_details->approval_status->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_approval_status">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($transaction_details->approval_status->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $transaction_details->approval_status->ViewValue ?></button>
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
<?php } else { ?>
<span id="el_transaction_details_approval_status">
<span<?php echo $transaction_details->approval_status->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->approval_status->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_approval_status" data-page="1" name="x_approval_status" id="x_approval_status" value="<?php echo HtmlEncode($transaction_details->approval_status->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->approval_status->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status">
		<td class="<?php echo $transaction_details_add->TableLeftColumnClass ?>"><span id="elh_transaction_details_approval_status"><?php echo $transaction_details->approval_status->caption() ?><?php echo ($transaction_details->approval_status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->approval_status->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_approval_status">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($transaction_details->approval_status->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $transaction_details->approval_status->ViewValue ?></button>
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
<?php } else { ?>
<span id="el_transaction_details_approval_status">
<span<?php echo $transaction_details->approval_status->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->approval_status->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_approval_status" data-page="1" name="x_approval_status" id="x_approval_status" value="<?php echo HtmlEncode($transaction_details->approval_status->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->approval_status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->document_link->Visible) { // document_link ?>
<?php if ($transaction_details_add->IsMobileOrModal) { ?>
	<div id="r_document_link" class="form-group row">
		<label id="elh_transaction_details_document_link" class="<?php echo $transaction_details_add->LeftColumnClass ?>"><?php echo $transaction_details->document_link->caption() ?><?php echo ($transaction_details->document_link->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_add->RightColumnClass ?>"><div<?php echo $transaction_details->document_link->cellAttributes() ?>>
<span id="el_transaction_details_document_link">
<div id="fd_x_document_link">
<span title="<?php echo $transaction_details->document_link->title() ? $transaction_details->document_link->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($transaction_details->document_link->ReadOnly || $transaction_details->document_link->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="transaction_details" data-field="x_document_link" data-page="1" name="x_document_link" id="x_document_link"<?php echo $transaction_details->document_link->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_document_link" id= "fn_x_document_link" value="<?php echo $transaction_details->document_link->Upload->FileName ?>">
<input type="hidden" name="fa_x_document_link" id= "fa_x_document_link" value="0">
<input type="hidden" name="fs_x_document_link" id= "fs_x_document_link" value="0">
<input type="hidden" name="fx_x_document_link" id= "fx_x_document_link" value="<?php echo $transaction_details->document_link->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_document_link" id= "fm_x_document_link" value="<?php echo $transaction_details->document_link->UploadMaxFileSize ?>">
</div>
<table id="ft_x_document_link" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $transaction_details->document_link->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_link">
		<td class="<?php echo $transaction_details_add->TableLeftColumnClass ?>"><span id="elh_transaction_details_document_link"><?php echo $transaction_details->document_link->caption() ?><?php echo ($transaction_details->document_link->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->document_link->cellAttributes() ?>>
<span id="el_transaction_details_document_link">
<div id="fd_x_document_link">
<span title="<?php echo $transaction_details->document_link->title() ? $transaction_details->document_link->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($transaction_details->document_link->ReadOnly || $transaction_details->document_link->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="transaction_details" data-field="x_document_link" data-page="1" name="x_document_link" id="x_document_link"<?php echo $transaction_details->document_link->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_document_link" id= "fn_x_document_link" value="<?php echo $transaction_details->document_link->Upload->FileName ?>">
<input type="hidden" name="fa_x_document_link" id= "fa_x_document_link" value="0">
<input type="hidden" name="fs_x_document_link" id= "fs_x_document_link" value="0">
<input type="hidden" name="fx_x_document_link" id= "fx_x_document_link" value="<?php echo $transaction_details->document_link->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_document_link" id= "fm_x_document_link" value="<?php echo $transaction_details->document_link->UploadMaxFileSize ?>">
</div>
<table id="ft_x_document_link" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $transaction_details->document_link->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->document_native->Visible) { // document_native ?>
<?php if ($transaction_details_add->IsMobileOrModal) { ?>
	<div id="r_document_native" class="form-group row">
		<label id="elh_transaction_details_document_native" for="x_document_native" class="<?php echo $transaction_details_add->LeftColumnClass ?>"><?php echo $transaction_details->document_native->caption() ?><?php echo ($transaction_details->document_native->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_add->RightColumnClass ?>"><div<?php echo $transaction_details->document_native->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_document_native">
<textarea data-table="transaction_details" data-field="x_document_native" data-page="1" name="x_document_native" id="x_document_native" cols="30" rows="4" placeholder="<?php echo HtmlEncode($transaction_details->document_native->getPlaceHolder()) ?>"<?php echo $transaction_details->document_native->editAttributes() ?>><?php echo $transaction_details->document_native->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_transaction_details_document_native">
<span<?php echo $transaction_details->document_native->viewAttributes() ?>>
<?php echo $transaction_details->document_native->ViewValue ?></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_document_native" data-page="1" name="x_document_native" id="x_document_native" value="<?php echo HtmlEncode($transaction_details->document_native->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->document_native->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_native">
		<td class="<?php echo $transaction_details_add->TableLeftColumnClass ?>"><span id="elh_transaction_details_document_native"><?php echo $transaction_details->document_native->caption() ?><?php echo ($transaction_details->document_native->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->document_native->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_document_native">
<textarea data-table="transaction_details" data-field="x_document_native" data-page="1" name="x_document_native" id="x_document_native" cols="30" rows="4" placeholder="<?php echo HtmlEncode($transaction_details->document_native->getPlaceHolder()) ?>"<?php echo $transaction_details->document_native->editAttributes() ?>><?php echo $transaction_details->document_native->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_transaction_details_document_native">
<span<?php echo $transaction_details->document_native->viewAttributes() ?>>
<?php echo $transaction_details->document_native->ViewValue ?></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_document_native" data-page="1" name="x_document_native" id="x_document_native" value="<?php echo HtmlEncode($transaction_details->document_native->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->document_native->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->expiry_date->Visible) { // expiry_date ?>
<?php if ($transaction_details_add->IsMobileOrModal) { ?>
	<div id="r_expiry_date" class="form-group row">
		<label id="elh_transaction_details_expiry_date" for="x_expiry_date" class="<?php echo $transaction_details_add->LeftColumnClass ?>"><?php echo $transaction_details->expiry_date->caption() ?><?php echo ($transaction_details->expiry_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_add->RightColumnClass ?>"><div<?php echo $transaction_details->expiry_date->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_expiry_date">
<input type="text" data-table="transaction_details" data-field="x_expiry_date" data-page="1" name="x_expiry_date" id="x_expiry_date" placeholder="<?php echo HtmlEncode($transaction_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $transaction_details->expiry_date->EditValue ?>"<?php echo $transaction_details->expiry_date->editAttributes() ?>>
<?php if (!$transaction_details->expiry_date->ReadOnly && !$transaction_details->expiry_date->Disabled && !isset($transaction_details->expiry_date->EditAttrs["readonly"]) && !isset($transaction_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftransaction_detailsadd", "x_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_transaction_details_expiry_date">
<span<?php echo $transaction_details->expiry_date->viewAttributes() ?>>
<?php if ((!EmptyString($transaction_details->expiry_date->TooltipValue)) && $transaction_details->expiry_date->linkAttributes() <> "") { ?>
<a<?php echo $transaction_details->expiry_date->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->expiry_date->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->expiry_date->ViewValue) ?>">
<?php } ?>
<span id="tt_transaction_details_x_expiry_date" class="d-none">
<?php echo $transaction_details->expiry_date->TooltipValue ?>
</span></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_expiry_date" data-page="1" name="x_expiry_date" id="x_expiry_date" value="<?php echo HtmlEncode($transaction_details->expiry_date->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->expiry_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_expiry_date">
		<td class="<?php echo $transaction_details_add->TableLeftColumnClass ?>"><span id="elh_transaction_details_expiry_date"><?php echo $transaction_details->expiry_date->caption() ?><?php echo ($transaction_details->expiry_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->expiry_date->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_expiry_date">
<input type="text" data-table="transaction_details" data-field="x_expiry_date" data-page="1" name="x_expiry_date" id="x_expiry_date" placeholder="<?php echo HtmlEncode($transaction_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $transaction_details->expiry_date->EditValue ?>"<?php echo $transaction_details->expiry_date->editAttributes() ?>>
<?php if (!$transaction_details->expiry_date->ReadOnly && !$transaction_details->expiry_date->Disabled && !isset($transaction_details->expiry_date->EditAttrs["readonly"]) && !isset($transaction_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftransaction_detailsadd", "x_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_transaction_details_expiry_date">
<span<?php echo $transaction_details->expiry_date->viewAttributes() ?>>
<?php if ((!EmptyString($transaction_details->expiry_date->TooltipValue)) && $transaction_details->expiry_date->linkAttributes() <> "") { ?>
<a<?php echo $transaction_details->expiry_date->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->expiry_date->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->expiry_date->ViewValue) ?>">
<?php } ?>
<span id="tt_transaction_details_x_expiry_date" class="d-none">
<?php echo $transaction_details->expiry_date->TooltipValue ?>
</span></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_expiry_date" data-page="1" name="x_expiry_date" id="x_expiry_date" value="<?php echo HtmlEncode($transaction_details->expiry_date->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->expiry_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$transaction_details_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $transaction_details_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$transaction_details->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $transaction_details_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$transaction_details_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$transaction_details_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$transaction_details_add->terminate();
?>