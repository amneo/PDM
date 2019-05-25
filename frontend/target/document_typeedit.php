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
$document_type_edit = new document_type_edit();

// Run the page
$document_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_type_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fdocument_typeedit = currentForm = new ew.Form("fdocument_typeedit", "edit");

// Validate form
fdocument_typeedit.validate = function() {
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
		<?php if ($document_type_edit->document_type->Required) { ?>
			elm = this.getElements("x" + infix + "_document_type");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_type->document_type->caption(), $document_type->document_type->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_type_edit->document_category->Required) { ?>
			elm = this.getElements("x" + infix + "_document_category");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_type->document_category->caption(), $document_type->document_category->RequiredErrorMessage)) ?>");
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
fdocument_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_typeedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $document_type_edit->showPageHeader(); ?>
<?php
$document_type_edit->showMessage();
?>
<form name="fdocument_typeedit" id="fdocument_typeedit" class="<?php echo $document_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_type_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_type_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$document_type_edit->IsModal ?>">
<?php if (!$document_type_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($document_type_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_document_typeedit" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($document_type->document_type->Visible) { // document_type ?>
<?php if ($document_type_edit->IsMobileOrModal) { ?>
	<div id="r_document_type" class="form-group row">
		<label id="elh_document_type_document_type" for="x_document_type" class="<?php echo $document_type_edit->LeftColumnClass ?>"><?php echo $document_type->document_type->caption() ?><?php echo ($document_type->document_type->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_type_edit->RightColumnClass ?>"><div<?php echo $document_type->document_type->cellAttributes() ?>>
<span id="el_document_type_document_type">
<input type="text" data-table="document_type" data-field="x_document_type" name="x_document_type" id="x_document_type" size="30" placeholder="<?php echo HtmlEncode($document_type->document_type->getPlaceHolder()) ?>" value="<?php echo $document_type->document_type->EditValue ?>"<?php echo $document_type->document_type->editAttributes() ?>>
</span>
<?php echo $document_type->document_type->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_type">
		<td class="<?php echo $document_type_edit->TableLeftColumnClass ?>"><span id="elh_document_type_document_type"><?php echo $document_type->document_type->caption() ?><?php echo ($document_type->document_type->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_type->document_type->cellAttributes() ?>>
<span id="el_document_type_document_type">
<input type="text" data-table="document_type" data-field="x_document_type" name="x_document_type" id="x_document_type" size="30" placeholder="<?php echo HtmlEncode($document_type->document_type->getPlaceHolder()) ?>" value="<?php echo $document_type->document_type->EditValue ?>"<?php echo $document_type->document_type->editAttributes() ?>>
</span>
<?php echo $document_type->document_type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_type->document_category->Visible) { // document_category ?>
<?php if ($document_type_edit->IsMobileOrModal) { ?>
	<div id="r_document_category" class="form-group row">
		<label id="elh_document_type_document_category" for="x_document_category" class="<?php echo $document_type_edit->LeftColumnClass ?>"><?php echo $document_type->document_category->caption() ?><?php echo ($document_type->document_category->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_type_edit->RightColumnClass ?>"><div<?php echo $document_type->document_category->cellAttributes() ?>>
<span id="el_document_type_document_category">
<input type="text" data-table="document_type" data-field="x_document_category" name="x_document_category" id="x_document_category" size="30" placeholder="<?php echo HtmlEncode($document_type->document_category->getPlaceHolder()) ?>" value="<?php echo $document_type->document_category->EditValue ?>"<?php echo $document_type->document_category->editAttributes() ?>>
</span>
<?php echo $document_type->document_category->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_category">
		<td class="<?php echo $document_type_edit->TableLeftColumnClass ?>"><span id="elh_document_type_document_category"><?php echo $document_type->document_category->caption() ?><?php echo ($document_type->document_category->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_type->document_category->cellAttributes() ?>>
<span id="el_document_type_document_category">
<input type="text" data-table="document_type" data-field="x_document_category" name="x_document_category" id="x_document_category" size="30" placeholder="<?php echo HtmlEncode($document_type->document_category->getPlaceHolder()) ?>" value="<?php echo $document_type->document_category->EditValue ?>"<?php echo $document_type->document_category->editAttributes() ?>>
</span>
<?php echo $document_type->document_category->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_type_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
	<input type="hidden" data-table="document_type" data-field="x_type_id" name="x_type_id" id="x_type_id" value="<?php echo HtmlEncode($document_type->type_id->CurrentValue) ?>">
<?php if (!$document_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $document_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $document_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$document_type_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$document_type_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$document_type_edit->terminate();
?>