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
$document_system_add = new document_system_add();

// Run the page
$document_system_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_system_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fdocument_systemadd = currentForm = new ew.Form("fdocument_systemadd", "add");

// Validate form
fdocument_systemadd.validate = function() {
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
		<?php if ($document_system_add->system_name->Required) { ?>
			elm = this.getElements("x" + infix + "_system_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_system->system_name->caption(), $document_system->system_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_system_add->system_group->Required) { ?>
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
fdocument_systemadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_systemadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $document_system_add->showPageHeader(); ?>
<?php
$document_system_add->showMessage();
?>
<form name="fdocument_systemadd" id="fdocument_systemadd" class="<?php echo $document_system_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_system_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_system_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_system">
<?php if ($document_system->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$document_system_add->IsModal ?>">
<?php if (!$document_system_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($document_system_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_document_systemadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($document_system->system_name->Visible) { // system_name ?>
<?php if ($document_system_add->IsMobileOrModal) { ?>
	<div id="r_system_name" class="form-group row">
		<label id="elh_document_system_system_name" for="x_system_name" class="<?php echo $document_system_add->LeftColumnClass ?>"><?php echo $document_system->system_name->caption() ?><?php echo ($document_system->system_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_system_add->RightColumnClass ?>"><div<?php echo $document_system->system_name->cellAttributes() ?>>
<?php if (!$document_system->isConfirm()) { ?>
<span id="el_document_system_system_name">
<input type="text" data-table="document_system" data-field="x_system_name" name="x_system_name" id="x_system_name" size="30" placeholder="<?php echo HtmlEncode($document_system->system_name->getPlaceHolder()) ?>" value="<?php echo $document_system->system_name->EditValue ?>"<?php echo $document_system->system_name->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_document_system_system_name">
<span<?php echo $document_system->system_name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_system->system_name->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_system" data-field="x_system_name" name="x_system_name" id="x_system_name" value="<?php echo HtmlEncode($document_system->system_name->FormValue) ?>">
<?php } ?>
<?php echo $document_system->system_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_system_name">
		<td class="<?php echo $document_system_add->TableLeftColumnClass ?>"><span id="elh_document_system_system_name"><?php echo $document_system->system_name->caption() ?><?php echo ($document_system->system_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_system->system_name->cellAttributes() ?>>
<?php if (!$document_system->isConfirm()) { ?>
<span id="el_document_system_system_name">
<input type="text" data-table="document_system" data-field="x_system_name" name="x_system_name" id="x_system_name" size="30" placeholder="<?php echo HtmlEncode($document_system->system_name->getPlaceHolder()) ?>" value="<?php echo $document_system->system_name->EditValue ?>"<?php echo $document_system->system_name->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_document_system_system_name">
<span<?php echo $document_system->system_name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_system->system_name->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_system" data-field="x_system_name" name="x_system_name" id="x_system_name" value="<?php echo HtmlEncode($document_system->system_name->FormValue) ?>">
<?php } ?>
<?php echo $document_system->system_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_system->system_group->Visible) { // system_group ?>
<?php if ($document_system_add->IsMobileOrModal) { ?>
	<div id="r_system_group" class="form-group row">
		<label id="elh_document_system_system_group" for="x_system_group" class="<?php echo $document_system_add->LeftColumnClass ?>"><?php echo $document_system->system_group->caption() ?><?php echo ($document_system->system_group->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_system_add->RightColumnClass ?>"><div<?php echo $document_system->system_group->cellAttributes() ?>>
<?php if (!$document_system->isConfirm()) { ?>
<span id="el_document_system_system_group">
<input type="text" data-table="document_system" data-field="x_system_group" name="x_system_group" id="x_system_group" size="30" placeholder="<?php echo HtmlEncode($document_system->system_group->getPlaceHolder()) ?>" value="<?php echo $document_system->system_group->EditValue ?>"<?php echo $document_system->system_group->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_document_system_system_group">
<span<?php echo $document_system->system_group->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_system->system_group->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_system" data-field="x_system_group" name="x_system_group" id="x_system_group" value="<?php echo HtmlEncode($document_system->system_group->FormValue) ?>">
<?php } ?>
<?php echo $document_system->system_group->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_system_group">
		<td class="<?php echo $document_system_add->TableLeftColumnClass ?>"><span id="elh_document_system_system_group"><?php echo $document_system->system_group->caption() ?><?php echo ($document_system->system_group->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_system->system_group->cellAttributes() ?>>
<?php if (!$document_system->isConfirm()) { ?>
<span id="el_document_system_system_group">
<input type="text" data-table="document_system" data-field="x_system_group" name="x_system_group" id="x_system_group" size="30" placeholder="<?php echo HtmlEncode($document_system->system_group->getPlaceHolder()) ?>" value="<?php echo $document_system->system_group->EditValue ?>"<?php echo $document_system->system_group->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_document_system_system_group">
<span<?php echo $document_system->system_group->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($document_system->system_group->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="document_system" data-field="x_system_group" name="x_system_group" id="x_system_group" value="<?php echo HtmlEncode($document_system->system_group->FormValue) ?>">
<?php } ?>
<?php echo $document_system->system_group->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_system_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$document_system_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $document_system_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$document_system->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $document_system_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$document_system_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$document_system_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$document_system_add->terminate();
?>