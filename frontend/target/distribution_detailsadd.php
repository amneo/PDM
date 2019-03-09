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
$distribution_details_add = new distribution_details_add();

// Run the page
$distribution_details_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$distribution_details_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fdistribution_detailsadd = currentForm = new ew.Form("fdistribution_detailsadd", "add");

// Validate form
fdistribution_detailsadd.validate = function() {
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
		<?php if ($distribution_details_add->to_Name->Required) { ?>
			elm = this.getElements("x" + infix + "_to_Name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $distribution_details->to_Name->caption(), $distribution_details->to_Name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($distribution_details_add->email_address->Required) { ?>
			elm = this.getElements("x" + infix + "_email_address");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $distribution_details->email_address->caption(), $distribution_details->email_address->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_email_address");
			if (elm && !ew.checkEmail(elm.value))
				return this.onError(elm, "<?php echo JsEncode($distribution_details->email_address->errorMessage()) ?>");
		<?php if ($distribution_details_add->project_name->Required) { ?>
			elm = this.getElements("x" + infix + "_project_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $distribution_details->project_name->caption(), $distribution_details->project_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($distribution_details_add->distribution_valid->Required) { ?>
			elm = this.getElements("x" + infix + "_distribution_valid");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $distribution_details->distribution_valid->caption(), $distribution_details->distribution_valid->RequiredErrorMessage)) ?>");
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
fdistribution_detailsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdistribution_detailsadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdistribution_detailsadd.lists["x_project_name"] = <?php echo $distribution_details_add->project_name->Lookup->toClientList() ?>;
fdistribution_detailsadd.lists["x_project_name"].options = <?php echo JsonEncode($distribution_details_add->project_name->lookupOptions()) ?>;
fdistribution_detailsadd.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdistribution_detailsadd.lists["x_distribution_valid"] = <?php echo $distribution_details_add->distribution_valid->Lookup->toClientList() ?>;
fdistribution_detailsadd.lists["x_distribution_valid"].options = <?php echo JsonEncode($distribution_details_add->distribution_valid->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $distribution_details_add->showPageHeader(); ?>
<?php
$distribution_details_add->showMessage();
?>
<form name="fdistribution_detailsadd" id="fdistribution_detailsadd" class="<?php echo $distribution_details_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($distribution_details_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $distribution_details_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="distribution_details">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$distribution_details_add->IsModal ?>">
<?php if (!$distribution_details_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($distribution_details_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_distribution_detailsadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($distribution_details->to_Name->Visible) { // to_Name ?>
<?php if ($distribution_details_add->IsMobileOrModal) { ?>
	<div id="r_to_Name" class="form-group row">
		<label id="elh_distribution_details_to_Name" for="x_to_Name" class="<?php echo $distribution_details_add->LeftColumnClass ?>"><?php echo $distribution_details->to_Name->caption() ?><?php echo ($distribution_details->to_Name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $distribution_details_add->RightColumnClass ?>"><div<?php echo $distribution_details->to_Name->cellAttributes() ?>>
<span id="el_distribution_details_to_Name">
<input type="text" data-table="distribution_details" data-field="x_to_Name" name="x_to_Name" id="x_to_Name" size="30" placeholder="<?php echo HtmlEncode($distribution_details->to_Name->getPlaceHolder()) ?>" value="<?php echo $distribution_details->to_Name->EditValue ?>"<?php echo $distribution_details->to_Name->editAttributes() ?>>
</span>
<?php echo $distribution_details->to_Name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_to_Name">
		<td class="<?php echo $distribution_details_add->TableLeftColumnClass ?>"><span id="elh_distribution_details_to_Name"><?php echo $distribution_details->to_Name->caption() ?><?php echo ($distribution_details->to_Name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $distribution_details->to_Name->cellAttributes() ?>>
<span id="el_distribution_details_to_Name">
<input type="text" data-table="distribution_details" data-field="x_to_Name" name="x_to_Name" id="x_to_Name" size="30" placeholder="<?php echo HtmlEncode($distribution_details->to_Name->getPlaceHolder()) ?>" value="<?php echo $distribution_details->to_Name->EditValue ?>"<?php echo $distribution_details->to_Name->editAttributes() ?>>
</span>
<?php echo $distribution_details->to_Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($distribution_details->email_address->Visible) { // email_address ?>
<?php if ($distribution_details_add->IsMobileOrModal) { ?>
	<div id="r_email_address" class="form-group row">
		<label id="elh_distribution_details_email_address" for="x_email_address" class="<?php echo $distribution_details_add->LeftColumnClass ?>"><?php echo $distribution_details->email_address->caption() ?><?php echo ($distribution_details->email_address->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $distribution_details_add->RightColumnClass ?>"><div<?php echo $distribution_details->email_address->cellAttributes() ?>>
<span id="el_distribution_details_email_address">
<input type="text" data-table="distribution_details" data-field="x_email_address" name="x_email_address" id="x_email_address" size="30" placeholder="<?php echo HtmlEncode($distribution_details->email_address->getPlaceHolder()) ?>" value="<?php echo $distribution_details->email_address->EditValue ?>"<?php echo $distribution_details->email_address->editAttributes() ?>>
</span>
<?php echo $distribution_details->email_address->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_email_address">
		<td class="<?php echo $distribution_details_add->TableLeftColumnClass ?>"><span id="elh_distribution_details_email_address"><?php echo $distribution_details->email_address->caption() ?><?php echo ($distribution_details->email_address->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $distribution_details->email_address->cellAttributes() ?>>
<span id="el_distribution_details_email_address">
<input type="text" data-table="distribution_details" data-field="x_email_address" name="x_email_address" id="x_email_address" size="30" placeholder="<?php echo HtmlEncode($distribution_details->email_address->getPlaceHolder()) ?>" value="<?php echo $distribution_details->email_address->EditValue ?>"<?php echo $distribution_details->email_address->editAttributes() ?>>
</span>
<?php echo $distribution_details->email_address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($distribution_details->project_name->Visible) { // project_name ?>
<?php if ($distribution_details_add->IsMobileOrModal) { ?>
	<div id="r_project_name" class="form-group row">
		<label id="elh_distribution_details_project_name" class="<?php echo $distribution_details_add->LeftColumnClass ?>"><?php echo $distribution_details->project_name->caption() ?><?php echo ($distribution_details->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $distribution_details_add->RightColumnClass ?>"><div<?php echo $distribution_details->project_name->cellAttributes() ?>>
<span id="el_distribution_details_project_name">
<?php
$wrkonchange = "" . trim(@$distribution_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$distribution_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x_project_name" class="text-nowrap" style="z-index: 8960">
	<input type="text" class="form-control" name="sv_x_project_name" id="sv_x_project_name" value="<?php echo RemoveHtml($distribution_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($distribution_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($distribution_details->project_name->getPlaceHolder()) ?>"<?php echo $distribution_details->project_name->editAttributes() ?>>
</span>
<input type="hidden" data-table="distribution_details" data-field="x_project_name" data-value-separator="<?php echo $distribution_details->project_name->displayValueSeparatorAttribute() ?>" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($distribution_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdistribution_detailsadd.createAutoSuggest({"id":"x_project_name","forceSelect":true});
</script>
<?php echo $distribution_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
</span>
<?php echo $distribution_details->project_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_name">
		<td class="<?php echo $distribution_details_add->TableLeftColumnClass ?>"><span id="elh_distribution_details_project_name"><?php echo $distribution_details->project_name->caption() ?><?php echo ($distribution_details->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $distribution_details->project_name->cellAttributes() ?>>
<span id="el_distribution_details_project_name">
<?php
$wrkonchange = "" . trim(@$distribution_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$distribution_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x_project_name" class="text-nowrap" style="z-index: 8960">
	<input type="text" class="form-control" name="sv_x_project_name" id="sv_x_project_name" value="<?php echo RemoveHtml($distribution_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($distribution_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($distribution_details->project_name->getPlaceHolder()) ?>"<?php echo $distribution_details->project_name->editAttributes() ?>>
</span>
<input type="hidden" data-table="distribution_details" data-field="x_project_name" data-value-separator="<?php echo $distribution_details->project_name->displayValueSeparatorAttribute() ?>" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($distribution_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdistribution_detailsadd.createAutoSuggest({"id":"x_project_name","forceSelect":true});
</script>
<?php echo $distribution_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
</span>
<?php echo $distribution_details->project_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($distribution_details->distribution_valid->Visible) { // distribution_valid ?>
<?php if ($distribution_details_add->IsMobileOrModal) { ?>
	<div id="r_distribution_valid" class="form-group row">
		<label id="elh_distribution_details_distribution_valid" class="<?php echo $distribution_details_add->LeftColumnClass ?>"><?php echo $distribution_details->distribution_valid->caption() ?><?php echo ($distribution_details->distribution_valid->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $distribution_details_add->RightColumnClass ?>"><div<?php echo $distribution_details->distribution_valid->cellAttributes() ?>>
<span id="el_distribution_details_distribution_valid">
<div id="tp_x_distribution_valid" class="ew-template"><input type="radio" class="form-check-input" data-table="distribution_details" data-field="x_distribution_valid" data-value-separator="<?php echo $distribution_details->distribution_valid->displayValueSeparatorAttribute() ?>" name="x_distribution_valid" id="x_distribution_valid" value="{value}"<?php echo $distribution_details->distribution_valid->editAttributes() ?>></div>
<div id="dsl_x_distribution_valid" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $distribution_details->distribution_valid->radioButtonListHtml(FALSE, "x_distribution_valid") ?>
</div></div>
</span>
<?php echo $distribution_details->distribution_valid->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_distribution_valid">
		<td class="<?php echo $distribution_details_add->TableLeftColumnClass ?>"><span id="elh_distribution_details_distribution_valid"><?php echo $distribution_details->distribution_valid->caption() ?><?php echo ($distribution_details->distribution_valid->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $distribution_details->distribution_valid->cellAttributes() ?>>
<span id="el_distribution_details_distribution_valid">
<div id="tp_x_distribution_valid" class="ew-template"><input type="radio" class="form-check-input" data-table="distribution_details" data-field="x_distribution_valid" data-value-separator="<?php echo $distribution_details->distribution_valid->displayValueSeparatorAttribute() ?>" name="x_distribution_valid" id="x_distribution_valid" value="{value}"<?php echo $distribution_details->distribution_valid->editAttributes() ?>></div>
<div id="dsl_x_distribution_valid" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $distribution_details->distribution_valid->radioButtonListHtml(FALSE, "x_distribution_valid") ?>
</div></div>
</span>
<?php echo $distribution_details->distribution_valid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($distribution_details_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$distribution_details_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $distribution_details_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $distribution_details_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$distribution_details_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$distribution_details_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$distribution_details_add->terminate();
?>