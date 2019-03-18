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
$document_system_edit = new document_system_edit();

// Run the page
$document_system_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_system_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fdocument_systemedit = currentForm = new ew.Form("fdocument_systemedit", "edit");

// Validate form
fdocument_systemedit.validate = function() {
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
		<?php if ($document_system_edit->type_id->Required) { ?>
			elm = this.getElements("x" + infix + "_type_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_system->type_id->caption(), $document_system->type_id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_system_edit->system_name->Required) { ?>
			elm = this.getElements("x" + infix + "_system_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_system->system_name->caption(), $document_system->system_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_system_edit->system_group->Required) { ?>
			elm = this.getElements("x" + infix + "_system_group");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_system->system_group->caption(), $document_system->system_group->RequiredErrorMessage)) ?>");
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
fdocument_systemedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_systemedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $document_system_edit->showPageHeader(); ?>
<?php
$document_system_edit->showMessage();
?>
<form name="fdocument_systemedit" id="fdocument_systemedit" class="<?php echo $document_system_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_system_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_system_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_system">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$document_system_edit->IsModal ?>">
<?php if (!$document_system_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($document_system_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_document_systemedit" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($document_system->type_id->Visible) { // type_id ?>
<?php if ($document_system_edit->IsMobileOrModal) { ?>
	<div id="r_type_id" class="form-group row">
		<label id="elh_document_system_type_id" class="<?php echo $document_system_edit->LeftColumnClass ?>"><?php echo $document_system->type_id->caption() ?><?php echo ($document_system->type_id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_system_edit->RightColumnClass ?>"><div<?php echo $document_system->type_id->cellAttributes() ?>>
<span id="el_document_system_type_id">
<span<?php echo $document_system->type_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_system->type_id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="document_system" data-field="x_type_id" name="x_type_id" id="x_type_id" value="<?php echo HtmlEncode($document_system->type_id->CurrentValue) ?>">
<?php echo $document_system->type_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_type_id">
		<td class="<?php echo $document_system_edit->TableLeftColumnClass ?>"><span id="elh_document_system_type_id"><?php echo $document_system->type_id->caption() ?><?php echo ($document_system->type_id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_system->type_id->cellAttributes() ?>>
<span id="el_document_system_type_id">
<span<?php echo $document_system->type_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_system->type_id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="document_system" data-field="x_type_id" name="x_type_id" id="x_type_id" value="<?php echo HtmlEncode($document_system->type_id->CurrentValue) ?>">
<?php echo $document_system->type_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_system->system_name->Visible) { // system_name ?>
<?php if ($document_system_edit->IsMobileOrModal) { ?>
	<div id="r_system_name" class="form-group row">
		<label id="elh_document_system_system_name" for="x_system_name" class="<?php echo $document_system_edit->LeftColumnClass ?>"><?php echo $document_system->system_name->caption() ?><?php echo ($document_system->system_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_system_edit->RightColumnClass ?>"><div<?php echo $document_system->system_name->cellAttributes() ?>>
<span id="el_document_system_system_name">
<input type="text" data-table="document_system" data-field="x_system_name" name="x_system_name" id="x_system_name" size="30" placeholder="<?php echo HtmlEncode($document_system->system_name->getPlaceHolder()) ?>" value="<?php echo $document_system->system_name->EditValue ?>"<?php echo $document_system->system_name->editAttributes() ?>>
</span>
<?php echo $document_system->system_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_system_name">
		<td class="<?php echo $document_system_edit->TableLeftColumnClass ?>"><span id="elh_document_system_system_name"><?php echo $document_system->system_name->caption() ?><?php echo ($document_system->system_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_system->system_name->cellAttributes() ?>>
<span id="el_document_system_system_name">
<input type="text" data-table="document_system" data-field="x_system_name" name="x_system_name" id="x_system_name" size="30" placeholder="<?php echo HtmlEncode($document_system->system_name->getPlaceHolder()) ?>" value="<?php echo $document_system->system_name->EditValue ?>"<?php echo $document_system->system_name->editAttributes() ?>>
</span>
<?php echo $document_system->system_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_system->system_group->Visible) { // system_group ?>
<?php if ($document_system_edit->IsMobileOrModal) { ?>
	<div id="r_system_group" class="form-group row">
		<label id="elh_document_system_system_group" for="x_system_group" class="<?php echo $document_system_edit->LeftColumnClass ?>"><?php echo $document_system->system_group->caption() ?><?php echo ($document_system->system_group->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_system_edit->RightColumnClass ?>"><div<?php echo $document_system->system_group->cellAttributes() ?>>
<span id="el_document_system_system_group">
<input type="text" data-table="document_system" data-field="x_system_group" name="x_system_group" id="x_system_group" size="30" placeholder="<?php echo HtmlEncode($document_system->system_group->getPlaceHolder()) ?>" value="<?php echo $document_system->system_group->EditValue ?>"<?php echo $document_system->system_group->editAttributes() ?>>
</span>
<?php echo $document_system->system_group->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_system_group">
		<td class="<?php echo $document_system_edit->TableLeftColumnClass ?>"><span id="elh_document_system_system_group"><?php echo $document_system->system_group->caption() ?><?php echo ($document_system->system_group->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_system->system_group->cellAttributes() ?>>
<span id="el_document_system_system_group">
<input type="text" data-table="document_system" data-field="x_system_group" name="x_system_group" id="x_system_group" size="30" placeholder="<?php echo HtmlEncode($document_system->system_group->getPlaceHolder()) ?>" value="<?php echo $document_system->system_group->EditValue ?>"<?php echo $document_system->system_group->editAttributes() ?>>
</span>
<?php echo $document_system->system_group->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_system_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$document_system_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $document_system_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $document_system_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$document_system_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$document_system_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$document_system_edit->terminate();
?>