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
$app_version_add = new app_version_add();

// Run the page
$app_version_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$app_version_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fapp_versionadd = currentForm = new ew.Form("fapp_versionadd", "add");

// Validate form
fapp_versionadd.validate = function() {
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
		<?php if ($app_version_add->frontend_version->Required) { ?>
			elm = this.getElements("x" + infix + "_frontend_version");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $app_version->frontend_version->caption(), $app_version->frontend_version->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($app_version_add->backend_version->Required) { ?>
			elm = this.getElements("x" + infix + "_backend_version");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $app_version->backend_version->caption(), $app_version->backend_version->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($app_version_add->release_date->Required) { ?>
			elm = this.getElements("x" + infix + "_release_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $app_version->release_date->caption(), $app_version->release_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_release_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($app_version->release_date->errorMessage()) ?>");
		<?php if ($app_version_add->posted_date->Required) { ?>
			elm = this.getElements("x" + infix + "_posted_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $app_version->posted_date->caption(), $app_version->posted_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_posted_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($app_version->posted_date->errorMessage()) ?>");
		<?php if ($app_version_add->remarks->Required) { ?>
			elm = this.getElements("x" + infix + "_remarks");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $app_version->remarks->caption(), $app_version->remarks->RequiredErrorMessage)) ?>");
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
fapp_versionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fapp_versionadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $app_version_add->showPageHeader(); ?>
<?php
$app_version_add->showMessage();
?>
<form name="fapp_versionadd" id="fapp_versionadd" class="<?php echo $app_version_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($app_version_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $app_version_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="app_version">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$app_version_add->IsModal ?>">
<?php if (!$app_version_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($app_version_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_app_versionadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($app_version->frontend_version->Visible) { // frontend_version ?>
<?php if ($app_version_add->IsMobileOrModal) { ?>
	<div id="r_frontend_version" class="form-group row">
		<label id="elh_app_version_frontend_version" for="x_frontend_version" class="<?php echo $app_version_add->LeftColumnClass ?>"><?php echo $app_version->frontend_version->caption() ?><?php echo ($app_version->frontend_version->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $app_version_add->RightColumnClass ?>"><div<?php echo $app_version->frontend_version->cellAttributes() ?>>
<span id="el_app_version_frontend_version">
<textarea data-table="app_version" data-field="x_frontend_version" name="x_frontend_version" id="x_frontend_version" cols="35" rows="4" placeholder="<?php echo HtmlEncode($app_version->frontend_version->getPlaceHolder()) ?>"<?php echo $app_version->frontend_version->editAttributes() ?>><?php echo $app_version->frontend_version->EditValue ?></textarea>
</span>
<?php echo $app_version->frontend_version->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_frontend_version">
		<td class="<?php echo $app_version_add->TableLeftColumnClass ?>"><span id="elh_app_version_frontend_version"><?php echo $app_version->frontend_version->caption() ?><?php echo ($app_version->frontend_version->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $app_version->frontend_version->cellAttributes() ?>>
<span id="el_app_version_frontend_version">
<textarea data-table="app_version" data-field="x_frontend_version" name="x_frontend_version" id="x_frontend_version" cols="35" rows="4" placeholder="<?php echo HtmlEncode($app_version->frontend_version->getPlaceHolder()) ?>"<?php echo $app_version->frontend_version->editAttributes() ?>><?php echo $app_version->frontend_version->EditValue ?></textarea>
</span>
<?php echo $app_version->frontend_version->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($app_version->backend_version->Visible) { // backend_version ?>
<?php if ($app_version_add->IsMobileOrModal) { ?>
	<div id="r_backend_version" class="form-group row">
		<label id="elh_app_version_backend_version" for="x_backend_version" class="<?php echo $app_version_add->LeftColumnClass ?>"><?php echo $app_version->backend_version->caption() ?><?php echo ($app_version->backend_version->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $app_version_add->RightColumnClass ?>"><div<?php echo $app_version->backend_version->cellAttributes() ?>>
<span id="el_app_version_backend_version">
<textarea data-table="app_version" data-field="x_backend_version" name="x_backend_version" id="x_backend_version" cols="35" rows="4" placeholder="<?php echo HtmlEncode($app_version->backend_version->getPlaceHolder()) ?>"<?php echo $app_version->backend_version->editAttributes() ?>><?php echo $app_version->backend_version->EditValue ?></textarea>
</span>
<?php echo $app_version->backend_version->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_backend_version">
		<td class="<?php echo $app_version_add->TableLeftColumnClass ?>"><span id="elh_app_version_backend_version"><?php echo $app_version->backend_version->caption() ?><?php echo ($app_version->backend_version->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $app_version->backend_version->cellAttributes() ?>>
<span id="el_app_version_backend_version">
<textarea data-table="app_version" data-field="x_backend_version" name="x_backend_version" id="x_backend_version" cols="35" rows="4" placeholder="<?php echo HtmlEncode($app_version->backend_version->getPlaceHolder()) ?>"<?php echo $app_version->backend_version->editAttributes() ?>><?php echo $app_version->backend_version->EditValue ?></textarea>
</span>
<?php echo $app_version->backend_version->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($app_version->release_date->Visible) { // release_date ?>
<?php if ($app_version_add->IsMobileOrModal) { ?>
	<div id="r_release_date" class="form-group row">
		<label id="elh_app_version_release_date" for="x_release_date" class="<?php echo $app_version_add->LeftColumnClass ?>"><?php echo $app_version->release_date->caption() ?><?php echo ($app_version->release_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $app_version_add->RightColumnClass ?>"><div<?php echo $app_version->release_date->cellAttributes() ?>>
<span id="el_app_version_release_date">
<input type="text" data-table="app_version" data-field="x_release_date" name="x_release_date" id="x_release_date" placeholder="<?php echo HtmlEncode($app_version->release_date->getPlaceHolder()) ?>" value="<?php echo $app_version->release_date->EditValue ?>"<?php echo $app_version->release_date->editAttributes() ?>>
<?php if (!$app_version->release_date->ReadOnly && !$app_version->release_date->Disabled && !isset($app_version->release_date->EditAttrs["readonly"]) && !isset($app_version->release_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fapp_versionadd", "x_release_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $app_version->release_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_release_date">
		<td class="<?php echo $app_version_add->TableLeftColumnClass ?>"><span id="elh_app_version_release_date"><?php echo $app_version->release_date->caption() ?><?php echo ($app_version->release_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $app_version->release_date->cellAttributes() ?>>
<span id="el_app_version_release_date">
<input type="text" data-table="app_version" data-field="x_release_date" name="x_release_date" id="x_release_date" placeholder="<?php echo HtmlEncode($app_version->release_date->getPlaceHolder()) ?>" value="<?php echo $app_version->release_date->EditValue ?>"<?php echo $app_version->release_date->editAttributes() ?>>
<?php if (!$app_version->release_date->ReadOnly && !$app_version->release_date->Disabled && !isset($app_version->release_date->EditAttrs["readonly"]) && !isset($app_version->release_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fapp_versionadd", "x_release_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $app_version->release_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($app_version->posted_date->Visible) { // posted_date ?>
<?php if ($app_version_add->IsMobileOrModal) { ?>
	<div id="r_posted_date" class="form-group row">
		<label id="elh_app_version_posted_date" for="x_posted_date" class="<?php echo $app_version_add->LeftColumnClass ?>"><?php echo $app_version->posted_date->caption() ?><?php echo ($app_version->posted_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $app_version_add->RightColumnClass ?>"><div<?php echo $app_version->posted_date->cellAttributes() ?>>
<span id="el_app_version_posted_date">
<input type="text" data-table="app_version" data-field="x_posted_date" name="x_posted_date" id="x_posted_date" placeholder="<?php echo HtmlEncode($app_version->posted_date->getPlaceHolder()) ?>" value="<?php echo $app_version->posted_date->EditValue ?>"<?php echo $app_version->posted_date->editAttributes() ?>>
<?php if (!$app_version->posted_date->ReadOnly && !$app_version->posted_date->Disabled && !isset($app_version->posted_date->EditAttrs["readonly"]) && !isset($app_version->posted_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fapp_versionadd", "x_posted_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $app_version->posted_date->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_posted_date">
		<td class="<?php echo $app_version_add->TableLeftColumnClass ?>"><span id="elh_app_version_posted_date"><?php echo $app_version->posted_date->caption() ?><?php echo ($app_version->posted_date->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $app_version->posted_date->cellAttributes() ?>>
<span id="el_app_version_posted_date">
<input type="text" data-table="app_version" data-field="x_posted_date" name="x_posted_date" id="x_posted_date" placeholder="<?php echo HtmlEncode($app_version->posted_date->getPlaceHolder()) ?>" value="<?php echo $app_version->posted_date->EditValue ?>"<?php echo $app_version->posted_date->editAttributes() ?>>
<?php if (!$app_version->posted_date->ReadOnly && !$app_version->posted_date->Disabled && !isset($app_version->posted_date->EditAttrs["readonly"]) && !isset($app_version->posted_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fapp_versionadd", "x_posted_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $app_version->posted_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($app_version->remarks->Visible) { // remarks ?>
<?php if ($app_version_add->IsMobileOrModal) { ?>
	<div id="r_remarks" class="form-group row">
		<label id="elh_app_version_remarks" for="x_remarks" class="<?php echo $app_version_add->LeftColumnClass ?>"><?php echo $app_version->remarks->caption() ?><?php echo ($app_version->remarks->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $app_version_add->RightColumnClass ?>"><div<?php echo $app_version->remarks->cellAttributes() ?>>
<span id="el_app_version_remarks">
<textarea data-table="app_version" data-field="x_remarks" name="x_remarks" id="x_remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($app_version->remarks->getPlaceHolder()) ?>"<?php echo $app_version->remarks->editAttributes() ?>><?php echo $app_version->remarks->EditValue ?></textarea>
</span>
<?php echo $app_version->remarks->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_remarks">
		<td class="<?php echo $app_version_add->TableLeftColumnClass ?>"><span id="elh_app_version_remarks"><?php echo $app_version->remarks->caption() ?><?php echo ($app_version->remarks->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $app_version->remarks->cellAttributes() ?>>
<span id="el_app_version_remarks">
<textarea data-table="app_version" data-field="x_remarks" name="x_remarks" id="x_remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($app_version->remarks->getPlaceHolder()) ?>"<?php echo $app_version->remarks->editAttributes() ?>><?php echo $app_version->remarks->EditValue ?></textarea>
</span>
<?php echo $app_version->remarks->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($app_version_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$app_version_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $app_version_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $app_version_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$app_version_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$app_version_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$app_version_add->terminate();
?>