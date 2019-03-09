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
$transaction_details_update = new transaction_details_update();

// Run the page
$transaction_details_update->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transaction_details_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "update";
var ftransaction_detailsupdate = currentForm = new ew.Form("ftransaction_detailsupdate", "update");

// Validate form
ftransaction_detailsupdate.validate = function() {
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
		<?php if ($transaction_details_update->document_native->Required) { ?>
			elm = this.getElements("x" + infix + "_document_native");
			uelm = this.getElements("u" + infix + "_document_native");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_details->document_native->caption(), $transaction_details->document_native->RequiredErrorMessage)) ?>");
			}
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftransaction_detailsupdate.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftransaction_detailsupdate.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $transaction_details_update->showPageHeader(); ?>
<?php
$transaction_details_update->showMessage();
?>
<form name="ftransaction_detailsupdate" id="ftransaction_detailsupdate" class="<?php echo $transaction_details_update->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($transaction_details_update->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $transaction_details_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transaction_details">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$transaction_details_update->IsModal ?>">
<?php foreach ($transaction_details_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<?php if (!$transaction_details_update->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($transaction_details_update->IsMobileOrModal) { ?>
<div id="tbl_transaction_detailsupdate" class="ew-update-div"><!-- page -->
	<div class="form-check">
		<input type="checkbox" class="form-check-input" name="u" id="u" onclick="ew.selectAll(this);"><label class="form-check-label" for="u"><?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php } else { ?>
<table id="tbl_transaction_detailsupdate" class="table table-striped table-sm ew-desktop-table"><!-- desktop table -->
	<thead>
	<tr>
		<th colspan="2"><div class="form-check"><input type="checkbox" class="form-check-input" name="u" id="u" onclick="ew.selectAll(this);"><label class="form-check-label" for="u"><?php echo $Language->Phrase("UpdateSelectAll") ?></label></div></th>
	</tr>
	</thead>
	<tbody>
<?php } ?>
<?php if ($transaction_details->document_native->Visible) { // document_native ?>
<?php if ($transaction_details_update->IsMobileOrModal) { ?>
	<div id="r_document_native" class="form-group row">
		<label for="x_document_native" class="<?php echo $transaction_details_update->LeftColumnClass ?>"><div class="form-check">
<input type="checkbox" name="u_document_native" id="u_document_native" class="form-check-input ew-multi-select" value="1"<?php echo ($transaction_details->document_native->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_document_native"><?php echo $transaction_details->document_native->caption() ?></label></div></label>
		<div class="<?php echo $transaction_details_update->RightColumnClass ?>"><div<?php echo $transaction_details->document_native->cellAttributes() ?>>
<span id="el_transaction_details_document_native">
<textarea data-table="transaction_details" data-field="x_document_native" name="x_document_native" id="x_document_native" cols="35" rows="4" placeholder="<?php echo HtmlEncode($transaction_details->document_native->getPlaceHolder()) ?>"<?php echo $transaction_details->document_native->editAttributes() ?>><?php echo $transaction_details->document_native->EditValue ?></textarea>
</span>
<?php echo $transaction_details->document_native->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_native">
		<td class="<?php echo $transaction_details_update->TableLeftColumnClass ?>"<?php echo $transaction_details->document_native->cellAttributes() ?>><span id="elh_transaction_details_document_native"><div class="form-check">
<input type="checkbox" name="u_document_native" id="u_document_native" class="form-check-input ew-multi-select" value="1"<?php echo ($transaction_details->document_native->MultiUpdate == "1") ? " checked" : "" ?>>
<label class="form-check-label" for="u_document_native"><?php echo $transaction_details->document_native->caption() ?></label></div></span></td>
		<td<?php echo $transaction_details->document_native->cellAttributes() ?>>
<span id="el_transaction_details_document_native">
<textarea data-table="transaction_details" data-field="x_document_native" name="x_document_native" id="x_document_native" cols="35" rows="4" placeholder="<?php echo HtmlEncode($transaction_details->document_native->getPlaceHolder()) ?>"<?php echo $transaction_details->document_native->editAttributes() ?>><?php echo $transaction_details->document_native->EditValue ?></textarea>
</span>
<?php echo $transaction_details->document_native->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transaction_details_update->IsMobileOrModal) { ?>
	</div><!-- /page -->
<?php } else { ?>
	</tbody>
</table><!-- /desktop table -->
<?php } ?>
<?php if (!$transaction_details_update->IsModal) { ?>
	<div class="form-group row"><!-- buttons .form-group -->
		<div class="<?php echo $transaction_details_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("UpdateBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $transaction_details_update->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$transaction_details_update->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$transaction_details_update->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$transaction_details_update->terminate();
?>