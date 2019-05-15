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
$transaction_details_edit = new transaction_details_edit();

// Run the page
$transaction_details_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transaction_details_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftransaction_detailsedit = currentForm = new ew.Form("ftransaction_detailsedit", "edit");

// Validate form
ftransaction_detailsedit.validate = function() {
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
		<?php if ($transaction_details_edit->firelink_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_firelink_doc_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->firelink_doc_no->caption(), $transaction_details->firelink_doc_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_edit->submit_no->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->submit_no->caption(), $transaction_details->submit_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_edit->revision_no->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->revision_no->caption(), $transaction_details->revision_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_edit->transmit_no->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->transmit_no->caption(), $transaction_details->transmit_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_edit->transmit_date->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->transmit_date->caption(), $transaction_details->transmit_date->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_edit->document_native->Required) { ?>
			elm = this.getElements("x" + infix + "_document_native");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->document_native->caption(), $transaction_details->document_native->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transaction_details_edit->expiry_date->Required) { ?>
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
ftransaction_detailsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftransaction_detailsedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftransaction_detailsedit.lists["x_firelink_doc_no"] = <?php echo $transaction_details_edit->firelink_doc_no->Lookup->toClientList() ?>;
ftransaction_detailsedit.lists["x_firelink_doc_no"].options = <?php echo JsonEncode($transaction_details_edit->firelink_doc_no->lookupOptions()) ?>;
ftransaction_detailsedit.autoSuggests["x_firelink_doc_no"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftransaction_detailsedit.lists["x_transmit_no"] = <?php echo $transaction_details_edit->transmit_no->Lookup->toClientList() ?>;
ftransaction_detailsedit.lists["x_transmit_no"].options = <?php echo JsonEncode($transaction_details_edit->transmit_no->lookupOptions()) ?>;
ftransaction_detailsedit.autoSuggests["x_transmit_no"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $transaction_details_edit->showPageHeader(); ?>
<?php
$transaction_details_edit->showMessage();
?>
<form name="ftransaction_detailsedit" id="ftransaction_detailsedit" class="<?php echo $transaction_details_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($transaction_details_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $transaction_details_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transaction_details">
<?php if ($transaction_details->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$transaction_details_edit->IsModal ?>">
<?php if (!$transaction_details_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($transaction_details_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_transaction_detailsedit" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($transaction_details->firelink_doc_no->Visible) { // firelink_doc_no ?>
<?php if ($transaction_details_edit->IsMobileOrModal) { ?>
	<div id="r_firelink_doc_no" class="form-group row">
		<label id="elh_transaction_details_firelink_doc_no" class="<?php echo $transaction_details_edit->LeftColumnClass ?>"><?php echo $transaction_details->firelink_doc_no->caption() ?><?php echo ($transaction_details->firelink_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_edit->RightColumnClass ?>"><div<?php echo $transaction_details->firelink_doc_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_firelink_doc_no">
<span<?php echo $transaction_details->firelink_doc_no->viewAttributes() ?>>
<?php if ((!EmptyString($transaction_details->firelink_doc_no->EditValue)) && $transaction_details->firelink_doc_no->linkAttributes() <> "") { ?>
<a<?php echo $transaction_details->firelink_doc_no->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->firelink_doc_no->EditValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->firelink_doc_no->EditValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->CurrentValue) ?>">
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
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->firelink_doc_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_firelink_doc_no">
		<td class="<?php echo $transaction_details_edit->TableLeftColumnClass ?>"><span id="elh_transaction_details_firelink_doc_no"><?php echo $transaction_details->firelink_doc_no->caption() ?><?php echo ($transaction_details->firelink_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->firelink_doc_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_firelink_doc_no">
<span<?php echo $transaction_details->firelink_doc_no->viewAttributes() ?>>
<?php if ((!EmptyString($transaction_details->firelink_doc_no->EditValue)) && $transaction_details->firelink_doc_no->linkAttributes() <> "") { ?>
<a<?php echo $transaction_details->firelink_doc_no->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->firelink_doc_no->EditValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->firelink_doc_no->EditValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->CurrentValue) ?>">
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
<input type="hidden" data-table="transaction_details" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" value="<?php echo HtmlEncode($transaction_details->firelink_doc_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->firelink_doc_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->submit_no->Visible) { // submit_no ?>
<?php if ($transaction_details_edit->IsMobileOrModal) { ?>
	<div id="r_submit_no" class="form-group row">
		<label id="elh_transaction_details_submit_no" for="x_submit_no" class="<?php echo $transaction_details_edit->LeftColumnClass ?>"><?php echo $transaction_details->submit_no->caption() ?><?php echo ($transaction_details->submit_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_edit->RightColumnClass ?>"><div<?php echo $transaction_details->submit_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_submit_no">
<span<?php echo $transaction_details->submit_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->submit_no->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_submit_no" name="x_submit_no" id="x_submit_no" value="<?php echo HtmlEncode($transaction_details->submit_no->CurrentValue) ?>">
<?php } else { ?>
<span id="el_transaction_details_submit_no">
<span<?php echo $transaction_details->submit_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->submit_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_submit_no" name="x_submit_no" id="x_submit_no" value="<?php echo HtmlEncode($transaction_details->submit_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->submit_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no">
		<td class="<?php echo $transaction_details_edit->TableLeftColumnClass ?>"><span id="elh_transaction_details_submit_no"><?php echo $transaction_details->submit_no->caption() ?><?php echo ($transaction_details->submit_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->submit_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_submit_no">
<span<?php echo $transaction_details->submit_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->submit_no->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_submit_no" name="x_submit_no" id="x_submit_no" value="<?php echo HtmlEncode($transaction_details->submit_no->CurrentValue) ?>">
<?php } else { ?>
<span id="el_transaction_details_submit_no">
<span<?php echo $transaction_details->submit_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->submit_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_submit_no" name="x_submit_no" id="x_submit_no" value="<?php echo HtmlEncode($transaction_details->submit_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->submit_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->revision_no->Visible) { // revision_no ?>
<?php if ($transaction_details_edit->IsMobileOrModal) { ?>
	<div id="r_revision_no" class="form-group row">
		<label id="elh_transaction_details_revision_no" for="x_revision_no" class="<?php echo $transaction_details_edit->LeftColumnClass ?>"><?php echo $transaction_details->revision_no->caption() ?><?php echo ($transaction_details->revision_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_edit->RightColumnClass ?>"><div<?php echo $transaction_details->revision_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_revision_no">
<span<?php echo $transaction_details->revision_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->revision_no->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_revision_no" name="x_revision_no" id="x_revision_no" value="<?php echo HtmlEncode($transaction_details->revision_no->CurrentValue) ?>">
<?php } else { ?>
<span id="el_transaction_details_revision_no">
<span<?php echo $transaction_details->revision_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->revision_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_revision_no" name="x_revision_no" id="x_revision_no" value="<?php echo HtmlEncode($transaction_details->revision_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->revision_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no">
		<td class="<?php echo $transaction_details_edit->TableLeftColumnClass ?>"><span id="elh_transaction_details_revision_no"><?php echo $transaction_details->revision_no->caption() ?><?php echo ($transaction_details->revision_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->revision_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_revision_no">
<span<?php echo $transaction_details->revision_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->revision_no->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_revision_no" name="x_revision_no" id="x_revision_no" value="<?php echo HtmlEncode($transaction_details->revision_no->CurrentValue) ?>">
<?php } else { ?>
<span id="el_transaction_details_revision_no">
<span<?php echo $transaction_details->revision_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->revision_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_revision_no" name="x_revision_no" id="x_revision_no" value="<?php echo HtmlEncode($transaction_details->revision_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->revision_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->transmit_no->Visible) { // transmit_no ?>
<?php if ($transaction_details_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_no" class="form-group row">
		<label id="elh_transaction_details_transmit_no" class="<?php echo $transaction_details_edit->LeftColumnClass ?>"><?php echo $transaction_details->transmit_no->caption() ?><?php echo ($transaction_details->transmit_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_edit->RightColumnClass ?>"><div<?php echo $transaction_details->transmit_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_transmit_no">
<span<?php echo $transaction_details->transmit_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->transmit_no->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_no" name="x_transmit_no" id="x_transmit_no" value="<?php echo HtmlEncode($transaction_details->transmit_no->CurrentValue) ?>">
<?php } else { ?>
<span id="el_transaction_details_transmit_no">
<span<?php echo $transaction_details->transmit_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->transmit_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_no" name="x_transmit_no" id="x_transmit_no" value="<?php echo HtmlEncode($transaction_details->transmit_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->transmit_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no">
		<td class="<?php echo $transaction_details_edit->TableLeftColumnClass ?>"><span id="elh_transaction_details_transmit_no"><?php echo $transaction_details->transmit_no->caption() ?><?php echo ($transaction_details->transmit_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->transmit_no->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_transmit_no">
<span<?php echo $transaction_details->transmit_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->transmit_no->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_no" name="x_transmit_no" id="x_transmit_no" value="<?php echo HtmlEncode($transaction_details->transmit_no->CurrentValue) ?>">
<?php } else { ?>
<span id="el_transaction_details_transmit_no">
<span<?php echo $transaction_details->transmit_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->transmit_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_no" name="x_transmit_no" id="x_transmit_no" value="<?php echo HtmlEncode($transaction_details->transmit_no->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->transmit_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->transmit_date->Visible) { // transmit_date ?>
<?php if ($transaction_details_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_date" class="form-group row">
		<label id="elh_transaction_details_transmit_date" for="x_transmit_date" class="<?php echo $transaction_details_edit->LeftColumnClass ?>"><?php echo $transaction_details->transmit_date->caption() ?><?php echo ($transaction_details->transmit_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_edit->RightColumnClass ?>"><div<?php echo $transaction_details->transmit_date->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_transmit_date">
<span<?php echo $transaction_details->transmit_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->transmit_date->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_date" name="x_transmit_date" id="x_transmit_date" value="<?php echo HtmlEncode($transaction_details->transmit_date->CurrentValue) ?>">
<?php } else { ?>
<span id="el_transaction_details_transmit_date">
<span<?php echo $transaction_details->transmit_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->transmit_date->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_date" name="x_transmit_date" id="x_transmit_date" value="<?php echo HtmlEncode($transaction_details->transmit_date->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->transmit_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date">
		<td class="<?php echo $transaction_details_edit->TableLeftColumnClass ?>"><span id="elh_transaction_details_transmit_date"><?php echo $transaction_details->transmit_date->caption() ?><?php echo ($transaction_details->transmit_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->transmit_date->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_transmit_date">
<span<?php echo $transaction_details->transmit_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->transmit_date->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_date" name="x_transmit_date" id="x_transmit_date" value="<?php echo HtmlEncode($transaction_details->transmit_date->CurrentValue) ?>">
<?php } else { ?>
<span id="el_transaction_details_transmit_date">
<span<?php echo $transaction_details->transmit_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->transmit_date->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_transmit_date" name="x_transmit_date" id="x_transmit_date" value="<?php echo HtmlEncode($transaction_details->transmit_date->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->transmit_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->document_native->Visible) { // document_native ?>
<?php if ($transaction_details_edit->IsMobileOrModal) { ?>
	<div id="r_document_native" class="form-group row">
		<label id="elh_transaction_details_document_native" for="x_document_native" class="<?php echo $transaction_details_edit->LeftColumnClass ?>"><?php echo $transaction_details->document_native->caption() ?><?php echo ($transaction_details->document_native->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_edit->RightColumnClass ?>"><div<?php echo $transaction_details->document_native->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_document_native">
<textarea data-table="transaction_details" data-field="x_document_native" name="x_document_native" id="x_document_native" cols="30" rows="4" placeholder="<?php echo HtmlEncode($transaction_details->document_native->getPlaceHolder()) ?>"<?php echo $transaction_details->document_native->editAttributes() ?>><?php echo $transaction_details->document_native->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_transaction_details_document_native">
<span<?php echo $transaction_details->document_native->viewAttributes() ?>>
<?php echo $transaction_details->document_native->ViewValue ?></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_document_native" name="x_document_native" id="x_document_native" value="<?php echo HtmlEncode($transaction_details->document_native->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->document_native->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_native">
		<td class="<?php echo $transaction_details_edit->TableLeftColumnClass ?>"><span id="elh_transaction_details_document_native"><?php echo $transaction_details->document_native->caption() ?><?php echo ($transaction_details->document_native->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->document_native->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_document_native">
<textarea data-table="transaction_details" data-field="x_document_native" name="x_document_native" id="x_document_native" cols="30" rows="4" placeholder="<?php echo HtmlEncode($transaction_details->document_native->getPlaceHolder()) ?>"<?php echo $transaction_details->document_native->editAttributes() ?>><?php echo $transaction_details->document_native->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_transaction_details_document_native">
<span<?php echo $transaction_details->document_native->viewAttributes() ?>>
<?php echo $transaction_details->document_native->ViewValue ?></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_document_native" name="x_document_native" id="x_document_native" value="<?php echo HtmlEncode($transaction_details->document_native->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->document_native->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details->expiry_date->Visible) { // expiry_date ?>
<?php if ($transaction_details_edit->IsMobileOrModal) { ?>
	<div id="r_expiry_date" class="form-group row">
		<label id="elh_transaction_details_expiry_date" for="x_expiry_date" class="<?php echo $transaction_details_edit->LeftColumnClass ?>"><?php echo $transaction_details->expiry_date->caption() ?><?php echo ($transaction_details->expiry_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_edit->RightColumnClass ?>"><div<?php echo $transaction_details->expiry_date->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_expiry_date">
<input type="text" data-table="transaction_details" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" placeholder="<?php echo HtmlEncode($transaction_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $transaction_details->expiry_date->EditValue ?>"<?php echo $transaction_details->expiry_date->editAttributes() ?>>
<?php if (!$transaction_details->expiry_date->ReadOnly && !$transaction_details->expiry_date->Disabled && !isset($transaction_details->expiry_date->EditAttrs["readonly"]) && !isset($transaction_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftransaction_detailsedit", "x_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
<input type="hidden" data-table="transaction_details" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" value="<?php echo HtmlEncode($transaction_details->expiry_date->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->expiry_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_expiry_date">
		<td class="<?php echo $transaction_details_edit->TableLeftColumnClass ?>"><span id="elh_transaction_details_expiry_date"><?php echo $transaction_details->expiry_date->caption() ?><?php echo ($transaction_details->expiry_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transaction_details->expiry_date->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_expiry_date">
<input type="text" data-table="transaction_details" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" placeholder="<?php echo HtmlEncode($transaction_details->expiry_date->getPlaceHolder()) ?>" value="<?php echo $transaction_details->expiry_date->EditValue ?>"<?php echo $transaction_details->expiry_date->editAttributes() ?>>
<?php if (!$transaction_details->expiry_date->ReadOnly && !$transaction_details->expiry_date->Disabled && !isset($transaction_details->expiry_date->EditAttrs["readonly"]) && !isset($transaction_details->expiry_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftransaction_detailsedit", "x_expiry_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
<input type="hidden" data-table="transaction_details" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" value="<?php echo HtmlEncode($transaction_details->expiry_date->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->expiry_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
	<input type="hidden" data-table="transaction_details" data-field="x_document_sequence" name="x_document_sequence" id="x_document_sequence" value="<?php echo HtmlEncode($transaction_details->document_sequence->CurrentValue) ?>">
<?php if (!$transaction_details_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $transaction_details_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$transaction_details->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $transaction_details_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$transaction_details_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$transaction_details_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$transaction_details_edit->terminate();
?>