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
$xmit_details_edit = new xmit_details_edit();

// Run the page
$xmit_details_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$xmit_details_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fxmit_detailsedit = currentForm = new ew.Form("fxmit_detailsedit", "edit");

// Validate form
fxmit_detailsedit.validate = function() {
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
		<?php if ($xmit_details_edit->xmit_id->Required) { ?>
			elm = this.getElements("x" + infix + "_xmit_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $xmit_details->xmit_id->caption(), $xmit_details->xmit_id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($xmit_details_edit->xmit_mode->Required) { ?>
			elm = this.getElements("x" + infix + "_xmit_mode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $xmit_details->xmit_mode->caption(), $xmit_details->xmit_mode->RequiredErrorMessage)) ?>");
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
fxmit_detailsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fxmit_detailsedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $xmit_details_edit->showPageHeader(); ?>
<?php
$xmit_details_edit->showMessage();
?>
<form name="fxmit_detailsedit" id="fxmit_detailsedit" class="<?php echo $xmit_details_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($xmit_details_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $xmit_details_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="xmit_details">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$xmit_details_edit->IsModal ?>">
<?php if (!$xmit_details_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($xmit_details_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_xmit_detailsedit" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($xmit_details->xmit_id->Visible) { // xmit_id ?>
<?php if ($xmit_details_edit->IsMobileOrModal) { ?>
	<div id="r_xmit_id" class="form-group row">
		<label id="elh_xmit_details_xmit_id" class="<?php echo $xmit_details_edit->LeftColumnClass ?>"><?php echo $xmit_details->xmit_id->caption() ?><?php echo ($xmit_details->xmit_id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $xmit_details_edit->RightColumnClass ?>"><div<?php echo $xmit_details->xmit_id->cellAttributes() ?>>
<span id="el_xmit_details_xmit_id">
<span<?php echo $xmit_details->xmit_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($xmit_details->xmit_id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="xmit_details" data-field="x_xmit_id" name="x_xmit_id" id="x_xmit_id" value="<?php echo HtmlEncode($xmit_details->xmit_id->CurrentValue) ?>">
<?php echo $xmit_details->xmit_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_xmit_id">
		<td class="<?php echo $xmit_details_edit->TableLeftColumnClass ?>"><span id="elh_xmit_details_xmit_id"><?php echo $xmit_details->xmit_id->caption() ?><?php echo ($xmit_details->xmit_id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $xmit_details->xmit_id->cellAttributes() ?>>
<span id="el_xmit_details_xmit_id">
<span<?php echo $xmit_details->xmit_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($xmit_details->xmit_id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="xmit_details" data-field="x_xmit_id" name="x_xmit_id" id="x_xmit_id" value="<?php echo HtmlEncode($xmit_details->xmit_id->CurrentValue) ?>">
<?php echo $xmit_details->xmit_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($xmit_details->xmit_mode->Visible) { // xmit_mode ?>
<?php if ($xmit_details_edit->IsMobileOrModal) { ?>
	<div id="r_xmit_mode" class="form-group row">
		<label id="elh_xmit_details_xmit_mode" for="x_xmit_mode" class="<?php echo $xmit_details_edit->LeftColumnClass ?>"><?php echo $xmit_details->xmit_mode->caption() ?><?php echo ($xmit_details->xmit_mode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $xmit_details_edit->RightColumnClass ?>"><div<?php echo $xmit_details->xmit_mode->cellAttributes() ?>>
<span id="el_xmit_details_xmit_mode">
<input type="text" data-table="xmit_details" data-field="x_xmit_mode" name="x_xmit_mode" id="x_xmit_mode" size="30" placeholder="<?php echo HtmlEncode($xmit_details->xmit_mode->getPlaceHolder()) ?>" value="<?php echo $xmit_details->xmit_mode->EditValue ?>"<?php echo $xmit_details->xmit_mode->editAttributes() ?>>
</span>
<?php echo $xmit_details->xmit_mode->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_xmit_mode">
		<td class="<?php echo $xmit_details_edit->TableLeftColumnClass ?>"><span id="elh_xmit_details_xmit_mode"><?php echo $xmit_details->xmit_mode->caption() ?><?php echo ($xmit_details->xmit_mode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $xmit_details->xmit_mode->cellAttributes() ?>>
<span id="el_xmit_details_xmit_mode">
<input type="text" data-table="xmit_details" data-field="x_xmit_mode" name="x_xmit_mode" id="x_xmit_mode" size="30" placeholder="<?php echo HtmlEncode($xmit_details->xmit_mode->getPlaceHolder()) ?>" value="<?php echo $xmit_details->xmit_mode->EditValue ?>"<?php echo $xmit_details->xmit_mode->editAttributes() ?>>
</span>
<?php echo $xmit_details->xmit_mode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($xmit_details_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$xmit_details_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $xmit_details_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $xmit_details_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$xmit_details_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$xmit_details_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$xmit_details_edit->terminate();
?>