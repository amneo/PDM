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
		<?php if ($transaction_details_edit->document_native->Required) { ?>
			elm = this.getElements("x" + infix + "_document_native");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->document_native->caption(), $transaction_details->document_native->RequiredErrorMessage)) ?>");
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
ftransaction_detailsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftransaction_detailsedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
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
<?php if ($transaction_details->document_native->Visible) { // document_native ?>
<?php if ($transaction_details_edit->IsMobileOrModal) { ?>
	<div id="r_document_native" class="form-group row">
		<label id="elh_transaction_details_document_native" for="x_document_native" class="<?php echo $transaction_details_edit->LeftColumnClass ?>"><?php echo $transaction_details->document_native->caption() ?><?php echo ($transaction_details->document_native->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_details_edit->RightColumnClass ?>"><div<?php echo $transaction_details->document_native->cellAttributes() ?>>
<?php if (!$transaction_details->isConfirm()) { ?>
<span id="el_transaction_details_document_native">
<textarea data-table="transaction_details" data-field="x_document_native" name="x_document_native" id="x_document_native" cols="35" rows="4" placeholder="<?php echo HtmlEncode($transaction_details->document_native->getPlaceHolder()) ?>"<?php echo $transaction_details->document_native->editAttributes() ?>><?php echo $transaction_details->document_native->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_transaction_details_document_native">
<span<?php echo $transaction_details->document_native->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->document_native->ViewValue) ?>"></span>
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
<textarea data-table="transaction_details" data-field="x_document_native" name="x_document_native" id="x_document_native" cols="35" rows="4" placeholder="<?php echo HtmlEncode($transaction_details->document_native->getPlaceHolder()) ?>"<?php echo $transaction_details->document_native->editAttributes() ?>><?php echo $transaction_details->document_native->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_transaction_details_document_native">
<span<?php echo $transaction_details->document_native->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transaction_details->document_native->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transaction_details" data-field="x_document_native" name="x_document_native" id="x_document_native" value="<?php echo HtmlEncode($transaction_details->document_native->FormValue) ?>">
<?php } ?>
<?php echo $transaction_details->document_native->CustomMsg ?></td>
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