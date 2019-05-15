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
$approval_details_edit = new approval_details_edit();

// Run the page
$approval_details_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$approval_details_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fapproval_detailsedit = currentForm = new ew.Form("fapproval_detailsedit", "edit");

// Validate form
fapproval_detailsedit.validate = function() {
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
		<?php if ($approval_details_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $approval_details->id->caption(), $approval_details->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($approval_details_edit->short_code->Required) { ?>
			elm = this.getElements("x" + infix + "_short_code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $approval_details->short_code->caption(), $approval_details->short_code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($approval_details_edit->Description->Required) { ?>
			elm = this.getElements("x" + infix + "_Description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $approval_details->Description->caption(), $approval_details->Description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($approval_details_edit->document_status->Required) { ?>
			elm = this.getElements("x" + infix + "_document_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $approval_details->document_status->caption(), $approval_details->document_status->RequiredErrorMessage)) ?>");
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
fapproval_detailsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fapproval_detailsedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fapproval_detailsedit.lists["x_document_status"] = <?php echo $approval_details_edit->document_status->Lookup->toClientList() ?>;
fapproval_detailsedit.lists["x_document_status"].options = <?php echo JsonEncode($approval_details_edit->document_status->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $approval_details_edit->showPageHeader(); ?>
<?php
$approval_details_edit->showMessage();
?>
<form name="fapproval_detailsedit" id="fapproval_detailsedit" class="<?php echo $approval_details_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($approval_details_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $approval_details_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="approval_details">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$approval_details_edit->IsModal ?>">
<?php if (!$approval_details_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($approval_details_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_approval_detailsedit" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($approval_details->id->Visible) { // id ?>
<?php if ($approval_details_edit->IsMobileOrModal) { ?>
	<div id="r_id" class="form-group row">
		<label id="elh_approval_details_id" class="<?php echo $approval_details_edit->LeftColumnClass ?>"><?php echo $approval_details->id->caption() ?><?php echo ($approval_details->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $approval_details_edit->RightColumnClass ?>"><div<?php echo $approval_details->id->cellAttributes() ?>>
<span id="el_approval_details_id">
<span<?php echo $approval_details->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($approval_details->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="approval_details" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($approval_details->id->CurrentValue) ?>">
<?php echo $approval_details->id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id">
		<td class="<?php echo $approval_details_edit->TableLeftColumnClass ?>"><span id="elh_approval_details_id"><?php echo $approval_details->id->caption() ?><?php echo ($approval_details->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $approval_details->id->cellAttributes() ?>>
<span id="el_approval_details_id">
<span<?php echo $approval_details->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($approval_details->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="approval_details" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($approval_details->id->CurrentValue) ?>">
<?php echo $approval_details->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($approval_details->short_code->Visible) { // short_code ?>
<?php if ($approval_details_edit->IsMobileOrModal) { ?>
	<div id="r_short_code" class="form-group row">
		<label id="elh_approval_details_short_code" for="x_short_code" class="<?php echo $approval_details_edit->LeftColumnClass ?>"><?php echo $approval_details->short_code->caption() ?><?php echo ($approval_details->short_code->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $approval_details_edit->RightColumnClass ?>"><div<?php echo $approval_details->short_code->cellAttributes() ?>>
<span id="el_approval_details_short_code">
<input type="text" data-table="approval_details" data-field="x_short_code" name="x_short_code" id="x_short_code" size="30" placeholder="<?php echo HtmlEncode($approval_details->short_code->getPlaceHolder()) ?>" value="<?php echo $approval_details->short_code->EditValue ?>"<?php echo $approval_details->short_code->editAttributes() ?>>
</span>
<?php echo $approval_details->short_code->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_short_code">
		<td class="<?php echo $approval_details_edit->TableLeftColumnClass ?>"><span id="elh_approval_details_short_code"><?php echo $approval_details->short_code->caption() ?><?php echo ($approval_details->short_code->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $approval_details->short_code->cellAttributes() ?>>
<span id="el_approval_details_short_code">
<input type="text" data-table="approval_details" data-field="x_short_code" name="x_short_code" id="x_short_code" size="30" placeholder="<?php echo HtmlEncode($approval_details->short_code->getPlaceHolder()) ?>" value="<?php echo $approval_details->short_code->EditValue ?>"<?php echo $approval_details->short_code->editAttributes() ?>>
</span>
<?php echo $approval_details->short_code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($approval_details->Description->Visible) { // Description ?>
<?php if ($approval_details_edit->IsMobileOrModal) { ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_approval_details_Description" for="x_Description" class="<?php echo $approval_details_edit->LeftColumnClass ?>"><?php echo $approval_details->Description->caption() ?><?php echo ($approval_details->Description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $approval_details_edit->RightColumnClass ?>"><div<?php echo $approval_details->Description->cellAttributes() ?>>
<span id="el_approval_details_Description">
<textarea data-table="approval_details" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($approval_details->Description->getPlaceHolder()) ?>"<?php echo $approval_details->Description->editAttributes() ?>><?php echo $approval_details->Description->EditValue ?></textarea>
</span>
<?php echo $approval_details->Description->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Description">
		<td class="<?php echo $approval_details_edit->TableLeftColumnClass ?>"><span id="elh_approval_details_Description"><?php echo $approval_details->Description->caption() ?><?php echo ($approval_details->Description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $approval_details->Description->cellAttributes() ?>>
<span id="el_approval_details_Description">
<textarea data-table="approval_details" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($approval_details->Description->getPlaceHolder()) ?>"<?php echo $approval_details->Description->editAttributes() ?>><?php echo $approval_details->Description->EditValue ?></textarea>
</span>
<?php echo $approval_details->Description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($approval_details->document_status->Visible) { // document_status ?>
<?php if ($approval_details_edit->IsMobileOrModal) { ?>
	<div id="r_document_status" class="form-group row">
		<label id="elh_approval_details_document_status" for="x_document_status" class="<?php echo $approval_details_edit->LeftColumnClass ?>"><?php echo $approval_details->document_status->caption() ?><?php echo ($approval_details->document_status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $approval_details_edit->RightColumnClass ?>"><div<?php echo $approval_details->document_status->cellAttributes() ?>>
<span id="el_approval_details_document_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="approval_details" data-field="x_document_status" data-value-separator="<?php echo $approval_details->document_status->displayValueSeparatorAttribute() ?>" id="x_document_status" name="x_document_status"<?php echo $approval_details->document_status->editAttributes() ?>>
		<?php echo $approval_details->document_status->selectOptionListHtml("x_document_status") ?>
	</select>
</div>
</span>
<?php echo $approval_details->document_status->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_status">
		<td class="<?php echo $approval_details_edit->TableLeftColumnClass ?>"><span id="elh_approval_details_document_status"><?php echo $approval_details->document_status->caption() ?><?php echo ($approval_details->document_status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $approval_details->document_status->cellAttributes() ?>>
<span id="el_approval_details_document_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="approval_details" data-field="x_document_status" data-value-separator="<?php echo $approval_details->document_status->displayValueSeparatorAttribute() ?>" id="x_document_status" name="x_document_status"<?php echo $approval_details->document_status->editAttributes() ?>>
		<?php echo $approval_details->document_status->selectOptionListHtml("x_document_status") ?>
	</select>
</div>
</span>
<?php echo $approval_details->document_status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($approval_details_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$approval_details_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $approval_details_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $approval_details_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$approval_details_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$approval_details_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$approval_details_edit->terminate();
?>