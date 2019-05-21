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
$approval_details_add = new approval_details_add();

// Run the page
$approval_details_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$approval_details_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fapproval_detailsadd = currentForm = new ew.Form("fapproval_detailsadd", "add");

// Validate form
fapproval_detailsadd.validate = function() {
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
		<?php if ($approval_details_add->short_code->Required) { ?>
			elm = this.getElements("x" + infix + "_short_code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $approval_details->short_code->caption(), $approval_details->short_code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($approval_details_add->Description->Required) { ?>
			elm = this.getElements("x" + infix + "_Description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $approval_details->Description->caption(), $approval_details->Description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($approval_details_add->out_status->Required) { ?>
			elm = this.getElements("x" + infix + "_out_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $approval_details->out_status->caption(), $approval_details->out_status->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($approval_details_add->in_status->Required) { ?>
			elm = this.getElements("x" + infix + "_in_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $approval_details->in_status->caption(), $approval_details->in_status->RequiredErrorMessage)) ?>");
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
fapproval_detailsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fapproval_detailsadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $approval_details_add->showPageHeader(); ?>
<?php
$approval_details_add->showMessage();
?>
<form name="fapproval_detailsadd" id="fapproval_detailsadd" class="<?php echo $approval_details_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($approval_details_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $approval_details_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="approval_details">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$approval_details_add->IsModal ?>">
<?php if (!$approval_details_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($approval_details_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_approval_detailsadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($approval_details->short_code->Visible) { // short_code ?>
<?php if ($approval_details_add->IsMobileOrModal) { ?>
	<div id="r_short_code" class="form-group row">
		<label id="elh_approval_details_short_code" for="x_short_code" class="<?php echo $approval_details_add->LeftColumnClass ?>"><?php echo $approval_details->short_code->caption() ?><?php echo ($approval_details->short_code->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $approval_details_add->RightColumnClass ?>"><div<?php echo $approval_details->short_code->cellAttributes() ?>>
<span id="el_approval_details_short_code">
<input type="text" data-table="approval_details" data-field="x_short_code" name="x_short_code" id="x_short_code" size="30" placeholder="<?php echo HtmlEncode($approval_details->short_code->getPlaceHolder()) ?>" value="<?php echo $approval_details->short_code->EditValue ?>"<?php echo $approval_details->short_code->editAttributes() ?>>
</span>
<?php echo $approval_details->short_code->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_short_code">
		<td class="<?php echo $approval_details_add->TableLeftColumnClass ?>"><span id="elh_approval_details_short_code"><?php echo $approval_details->short_code->caption() ?><?php echo ($approval_details->short_code->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $approval_details->short_code->cellAttributes() ?>>
<span id="el_approval_details_short_code">
<input type="text" data-table="approval_details" data-field="x_short_code" name="x_short_code" id="x_short_code" size="30" placeholder="<?php echo HtmlEncode($approval_details->short_code->getPlaceHolder()) ?>" value="<?php echo $approval_details->short_code->EditValue ?>"<?php echo $approval_details->short_code->editAttributes() ?>>
</span>
<?php echo $approval_details->short_code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($approval_details->Description->Visible) { // Description ?>
<?php if ($approval_details_add->IsMobileOrModal) { ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_approval_details_Description" for="x_Description" class="<?php echo $approval_details_add->LeftColumnClass ?>"><?php echo $approval_details->Description->caption() ?><?php echo ($approval_details->Description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $approval_details_add->RightColumnClass ?>"><div<?php echo $approval_details->Description->cellAttributes() ?>>
<span id="el_approval_details_Description">
<textarea data-table="approval_details" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($approval_details->Description->getPlaceHolder()) ?>"<?php echo $approval_details->Description->editAttributes() ?>><?php echo $approval_details->Description->EditValue ?></textarea>
</span>
<?php echo $approval_details->Description->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Description">
		<td class="<?php echo $approval_details_add->TableLeftColumnClass ?>"><span id="elh_approval_details_Description"><?php echo $approval_details->Description->caption() ?><?php echo ($approval_details->Description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $approval_details->Description->cellAttributes() ?>>
<span id="el_approval_details_Description">
<textarea data-table="approval_details" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($approval_details->Description->getPlaceHolder()) ?>"<?php echo $approval_details->Description->editAttributes() ?>><?php echo $approval_details->Description->EditValue ?></textarea>
</span>
<?php echo $approval_details->Description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($approval_details->out_status->Visible) { // out_status ?>
<?php if ($approval_details_add->IsMobileOrModal) { ?>
	<div id="r_out_status" class="form-group row">
		<label id="elh_approval_details_out_status" for="x_out_status" class="<?php echo $approval_details_add->LeftColumnClass ?>"><?php echo $approval_details->out_status->caption() ?><?php echo ($approval_details->out_status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $approval_details_add->RightColumnClass ?>"><div<?php echo $approval_details->out_status->cellAttributes() ?>>
<span id="el_approval_details_out_status">
<input type="text" data-table="approval_details" data-field="x_out_status" name="x_out_status" id="x_out_status" size="30" placeholder="<?php echo HtmlEncode($approval_details->out_status->getPlaceHolder()) ?>" value="<?php echo $approval_details->out_status->EditValue ?>"<?php echo $approval_details->out_status->editAttributes() ?>>
</span>
<?php echo $approval_details->out_status->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_out_status">
		<td class="<?php echo $approval_details_add->TableLeftColumnClass ?>"><span id="elh_approval_details_out_status"><?php echo $approval_details->out_status->caption() ?><?php echo ($approval_details->out_status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $approval_details->out_status->cellAttributes() ?>>
<span id="el_approval_details_out_status">
<input type="text" data-table="approval_details" data-field="x_out_status" name="x_out_status" id="x_out_status" size="30" placeholder="<?php echo HtmlEncode($approval_details->out_status->getPlaceHolder()) ?>" value="<?php echo $approval_details->out_status->EditValue ?>"<?php echo $approval_details->out_status->editAttributes() ?>>
</span>
<?php echo $approval_details->out_status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($approval_details->in_status->Visible) { // in_status ?>
<?php if ($approval_details_add->IsMobileOrModal) { ?>
	<div id="r_in_status" class="form-group row">
		<label id="elh_approval_details_in_status" for="x_in_status" class="<?php echo $approval_details_add->LeftColumnClass ?>"><?php echo $approval_details->in_status->caption() ?><?php echo ($approval_details->in_status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $approval_details_add->RightColumnClass ?>"><div<?php echo $approval_details->in_status->cellAttributes() ?>>
<span id="el_approval_details_in_status">
<input type="text" data-table="approval_details" data-field="x_in_status" name="x_in_status" id="x_in_status" size="30" placeholder="<?php echo HtmlEncode($approval_details->in_status->getPlaceHolder()) ?>" value="<?php echo $approval_details->in_status->EditValue ?>"<?php echo $approval_details->in_status->editAttributes() ?>>
</span>
<?php echo $approval_details->in_status->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_in_status">
		<td class="<?php echo $approval_details_add->TableLeftColumnClass ?>"><span id="elh_approval_details_in_status"><?php echo $approval_details->in_status->caption() ?><?php echo ($approval_details->in_status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $approval_details->in_status->cellAttributes() ?>>
<span id="el_approval_details_in_status">
<input type="text" data-table="approval_details" data-field="x_in_status" name="x_in_status" id="x_in_status" size="30" placeholder="<?php echo HtmlEncode($approval_details->in_status->getPlaceHolder()) ?>" value="<?php echo $approval_details->in_status->EditValue ?>"<?php echo $approval_details->in_status->editAttributes() ?>>
</span>
<?php echo $approval_details->in_status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($approval_details_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$approval_details_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $approval_details_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $approval_details_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$approval_details_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$approval_details_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$approval_details_add->terminate();
?>