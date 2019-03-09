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
$project_details_add = new project_details_add();

// Run the page
$project_details_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_details_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fproject_detailsadd = currentForm = new ew.Form("fproject_detailsadd", "add");

// Validate form
fproject_detailsadd.validate = function() {
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
		<?php if ($project_details_add->project_name->Required) { ?>
			elm = this.getElements("x" + infix + "_project_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_name->caption(), $project_details->project_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($project_details_add->project_our_client->Required) { ?>
			elm = this.getElements("x" + infix + "_project_our_client");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_our_client->caption(), $project_details->project_our_client->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($project_details_add->project_end_user->Required) { ?>
			elm = this.getElements("x" + infix + "_project_end_user");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_end_user->caption(), $project_details->project_end_user->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($project_details_add->project_sales_engg->Required) { ?>
			elm = this.getElements("x" + infix + "_project_sales_engg");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_sales_engg->caption(), $project_details->project_sales_engg->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($project_details_add->project_distribution->Required) { ?>
			elm = this.getElements("x" + infix + "_project_distribution");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_distribution->caption(), $project_details->project_distribution->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($project_details_add->project_transmittal->Required) { ?>
			elm = this.getElements("x" + infix + "_project_transmittal");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->project_transmittal->caption(), $project_details->project_transmittal->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($project_details_add->order_number->Required) { ?>
			elm = this.getElements("x" + infix + "_order_number");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_details->order_number->caption(), $project_details->order_number->RequiredErrorMessage)) ?>");
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
fproject_detailsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproject_detailsadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $project_details_add->showPageHeader(); ?>
<?php
$project_details_add->showMessage();
?>
<form name="fproject_detailsadd" id="fproject_detailsadd" class="<?php echo $project_details_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($project_details_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $project_details_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_details">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$project_details_add->IsModal ?>">
<?php if (!$project_details_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($project_details_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_project_detailsadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($project_details->project_name->Visible) { // project_name ?>
<?php if ($project_details_add->IsMobileOrModal) { ?>
	<div id="r_project_name" class="form-group row">
		<label id="elh_project_details_project_name" for="x_project_name" class="<?php echo $project_details_add->LeftColumnClass ?>"><?php echo $project_details->project_name->caption() ?><?php echo ($project_details->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_details_add->RightColumnClass ?>"><div<?php echo $project_details->project_name->cellAttributes() ?>>
<span id="el_project_details_project_name">
<input type="text" data-table="project_details" data-field="x_project_name" data-page="1" name="x_project_name" id="x_project_name" size="30" placeholder="<?php echo HtmlEncode($project_details->project_name->getPlaceHolder()) ?>" value="<?php echo $project_details->project_name->EditValue ?>"<?php echo $project_details->project_name->editAttributes() ?>>
</span>
<?php echo $project_details->project_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_name">
		<td class="<?php echo $project_details_add->TableLeftColumnClass ?>"><span id="elh_project_details_project_name"><?php echo $project_details->project_name->caption() ?><?php echo ($project_details->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $project_details->project_name->cellAttributes() ?>>
<span id="el_project_details_project_name">
<input type="text" data-table="project_details" data-field="x_project_name" data-page="1" name="x_project_name" id="x_project_name" size="30" placeholder="<?php echo HtmlEncode($project_details->project_name->getPlaceHolder()) ?>" value="<?php echo $project_details->project_name->EditValue ?>"<?php echo $project_details->project_name->editAttributes() ?>>
</span>
<?php echo $project_details->project_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($project_details->project_our_client->Visible) { // project_our_client ?>
<?php if ($project_details_add->IsMobileOrModal) { ?>
	<div id="r_project_our_client" class="form-group row">
		<label id="elh_project_details_project_our_client" for="x_project_our_client" class="<?php echo $project_details_add->LeftColumnClass ?>"><?php echo $project_details->project_our_client->caption() ?><?php echo ($project_details->project_our_client->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_details_add->RightColumnClass ?>"><div<?php echo $project_details->project_our_client->cellAttributes() ?>>
<span id="el_project_details_project_our_client">
<input type="text" data-table="project_details" data-field="x_project_our_client" data-page="1" name="x_project_our_client" id="x_project_our_client" size="30" placeholder="<?php echo HtmlEncode($project_details->project_our_client->getPlaceHolder()) ?>" value="<?php echo $project_details->project_our_client->EditValue ?>"<?php echo $project_details->project_our_client->editAttributes() ?>>
</span>
<?php echo $project_details->project_our_client->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_our_client">
		<td class="<?php echo $project_details_add->TableLeftColumnClass ?>"><span id="elh_project_details_project_our_client"><?php echo $project_details->project_our_client->caption() ?><?php echo ($project_details->project_our_client->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $project_details->project_our_client->cellAttributes() ?>>
<span id="el_project_details_project_our_client">
<input type="text" data-table="project_details" data-field="x_project_our_client" data-page="1" name="x_project_our_client" id="x_project_our_client" size="30" placeholder="<?php echo HtmlEncode($project_details->project_our_client->getPlaceHolder()) ?>" value="<?php echo $project_details->project_our_client->EditValue ?>"<?php echo $project_details->project_our_client->editAttributes() ?>>
</span>
<?php echo $project_details->project_our_client->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($project_details->project_end_user->Visible) { // project_end_user ?>
<?php if ($project_details_add->IsMobileOrModal) { ?>
	<div id="r_project_end_user" class="form-group row">
		<label id="elh_project_details_project_end_user" for="x_project_end_user" class="<?php echo $project_details_add->LeftColumnClass ?>"><?php echo $project_details->project_end_user->caption() ?><?php echo ($project_details->project_end_user->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_details_add->RightColumnClass ?>"><div<?php echo $project_details->project_end_user->cellAttributes() ?>>
<span id="el_project_details_project_end_user">
<input type="text" data-table="project_details" data-field="x_project_end_user" data-page="1" name="x_project_end_user" id="x_project_end_user" size="30" placeholder="<?php echo HtmlEncode($project_details->project_end_user->getPlaceHolder()) ?>" value="<?php echo $project_details->project_end_user->EditValue ?>"<?php echo $project_details->project_end_user->editAttributes() ?>>
</span>
<?php echo $project_details->project_end_user->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_end_user">
		<td class="<?php echo $project_details_add->TableLeftColumnClass ?>"><span id="elh_project_details_project_end_user"><?php echo $project_details->project_end_user->caption() ?><?php echo ($project_details->project_end_user->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $project_details->project_end_user->cellAttributes() ?>>
<span id="el_project_details_project_end_user">
<input type="text" data-table="project_details" data-field="x_project_end_user" data-page="1" name="x_project_end_user" id="x_project_end_user" size="30" placeholder="<?php echo HtmlEncode($project_details->project_end_user->getPlaceHolder()) ?>" value="<?php echo $project_details->project_end_user->EditValue ?>"<?php echo $project_details->project_end_user->editAttributes() ?>>
</span>
<?php echo $project_details->project_end_user->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($project_details->project_sales_engg->Visible) { // project_sales_engg ?>
<?php if ($project_details_add->IsMobileOrModal) { ?>
	<div id="r_project_sales_engg" class="form-group row">
		<label id="elh_project_details_project_sales_engg" for="x_project_sales_engg" class="<?php echo $project_details_add->LeftColumnClass ?>"><?php echo $project_details->project_sales_engg->caption() ?><?php echo ($project_details->project_sales_engg->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_details_add->RightColumnClass ?>"><div<?php echo $project_details->project_sales_engg->cellAttributes() ?>>
<span id="el_project_details_project_sales_engg">
<input type="text" data-table="project_details" data-field="x_project_sales_engg" data-page="1" name="x_project_sales_engg" id="x_project_sales_engg" size="30" placeholder="<?php echo HtmlEncode($project_details->project_sales_engg->getPlaceHolder()) ?>" value="<?php echo $project_details->project_sales_engg->EditValue ?>"<?php echo $project_details->project_sales_engg->editAttributes() ?>>
</span>
<?php echo $project_details->project_sales_engg->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_sales_engg">
		<td class="<?php echo $project_details_add->TableLeftColumnClass ?>"><span id="elh_project_details_project_sales_engg"><?php echo $project_details->project_sales_engg->caption() ?><?php echo ($project_details->project_sales_engg->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $project_details->project_sales_engg->cellAttributes() ?>>
<span id="el_project_details_project_sales_engg">
<input type="text" data-table="project_details" data-field="x_project_sales_engg" data-page="1" name="x_project_sales_engg" id="x_project_sales_engg" size="30" placeholder="<?php echo HtmlEncode($project_details->project_sales_engg->getPlaceHolder()) ?>" value="<?php echo $project_details->project_sales_engg->EditValue ?>"<?php echo $project_details->project_sales_engg->editAttributes() ?>>
</span>
<?php echo $project_details->project_sales_engg->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($project_details->project_distribution->Visible) { // project_distribution ?>
<?php if ($project_details_add->IsMobileOrModal) { ?>
	<div id="r_project_distribution" class="form-group row">
		<label id="elh_project_details_project_distribution" for="x_project_distribution" class="<?php echo $project_details_add->LeftColumnClass ?>"><?php echo $project_details->project_distribution->caption() ?><?php echo ($project_details->project_distribution->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_details_add->RightColumnClass ?>"><div<?php echo $project_details->project_distribution->cellAttributes() ?>>
<span id="el_project_details_project_distribution">
<input type="text" data-table="project_details" data-field="x_project_distribution" data-page="1" name="x_project_distribution" id="x_project_distribution" size="30" placeholder="<?php echo HtmlEncode($project_details->project_distribution->getPlaceHolder()) ?>" value="<?php echo $project_details->project_distribution->EditValue ?>"<?php echo $project_details->project_distribution->editAttributes() ?>>
</span>
<?php echo $project_details->project_distribution->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_distribution">
		<td class="<?php echo $project_details_add->TableLeftColumnClass ?>"><span id="elh_project_details_project_distribution"><?php echo $project_details->project_distribution->caption() ?><?php echo ($project_details->project_distribution->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $project_details->project_distribution->cellAttributes() ?>>
<span id="el_project_details_project_distribution">
<input type="text" data-table="project_details" data-field="x_project_distribution" data-page="1" name="x_project_distribution" id="x_project_distribution" size="30" placeholder="<?php echo HtmlEncode($project_details->project_distribution->getPlaceHolder()) ?>" value="<?php echo $project_details->project_distribution->EditValue ?>"<?php echo $project_details->project_distribution->editAttributes() ?>>
</span>
<?php echo $project_details->project_distribution->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($project_details->project_transmittal->Visible) { // project_transmittal ?>
<?php if ($project_details_add->IsMobileOrModal) { ?>
	<div id="r_project_transmittal" class="form-group row">
		<label id="elh_project_details_project_transmittal" for="x_project_transmittal" class="<?php echo $project_details_add->LeftColumnClass ?>"><?php echo $project_details->project_transmittal->caption() ?><?php echo ($project_details->project_transmittal->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_details_add->RightColumnClass ?>"><div<?php echo $project_details->project_transmittal->cellAttributes() ?>>
<span id="el_project_details_project_transmittal">
<input type="text" data-table="project_details" data-field="x_project_transmittal" data-page="1" name="x_project_transmittal" id="x_project_transmittal" size="30" placeholder="<?php echo HtmlEncode($project_details->project_transmittal->getPlaceHolder()) ?>" value="<?php echo $project_details->project_transmittal->EditValue ?>"<?php echo $project_details->project_transmittal->editAttributes() ?>>
</span>
<?php echo $project_details->project_transmittal->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_transmittal">
		<td class="<?php echo $project_details_add->TableLeftColumnClass ?>"><span id="elh_project_details_project_transmittal"><?php echo $project_details->project_transmittal->caption() ?><?php echo ($project_details->project_transmittal->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $project_details->project_transmittal->cellAttributes() ?>>
<span id="el_project_details_project_transmittal">
<input type="text" data-table="project_details" data-field="x_project_transmittal" data-page="1" name="x_project_transmittal" id="x_project_transmittal" size="30" placeholder="<?php echo HtmlEncode($project_details->project_transmittal->getPlaceHolder()) ?>" value="<?php echo $project_details->project_transmittal->EditValue ?>"<?php echo $project_details->project_transmittal->editAttributes() ?>>
</span>
<?php echo $project_details->project_transmittal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($project_details->order_number->Visible) { // order_number ?>
<?php if ($project_details_add->IsMobileOrModal) { ?>
	<div id="r_order_number" class="form-group row">
		<label id="elh_project_details_order_number" for="x_order_number" class="<?php echo $project_details_add->LeftColumnClass ?>"><?php echo $project_details->order_number->caption() ?><?php echo ($project_details->order_number->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_details_add->RightColumnClass ?>"><div<?php echo $project_details->order_number->cellAttributes() ?>>
<span id="el_project_details_order_number">
<input type="text" data-table="project_details" data-field="x_order_number" data-page="1" name="x_order_number" id="x_order_number" size="30" placeholder="<?php echo HtmlEncode($project_details->order_number->getPlaceHolder()) ?>" value="<?php echo $project_details->order_number->EditValue ?>"<?php echo $project_details->order_number->editAttributes() ?>>
</span>
<?php echo $project_details->order_number->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_order_number">
		<td class="<?php echo $project_details_add->TableLeftColumnClass ?>"><span id="elh_project_details_order_number"><?php echo $project_details->order_number->caption() ?><?php echo ($project_details->order_number->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $project_details->order_number->cellAttributes() ?>>
<span id="el_project_details_order_number">
<input type="text" data-table="project_details" data-field="x_order_number" data-page="1" name="x_order_number" id="x_order_number" size="30" placeholder="<?php echo HtmlEncode($project_details->order_number->getPlaceHolder()) ?>" value="<?php echo $project_details->order_number->EditValue ?>"<?php echo $project_details->order_number->editAttributes() ?>>
</span>
<?php echo $project_details->order_number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($project_details_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$project_details_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $project_details_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $project_details_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$project_details_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$project_details_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$project_details_add->terminate();
?>