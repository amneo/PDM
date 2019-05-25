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
$transmit_details_add = new transmit_details_add();

// Run the page
$transmit_details_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transmit_details_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftransmit_detailsadd = currentForm = new ew.Form("ftransmit_detailsadd", "add");

// Validate form
ftransmit_detailsadd.validate = function() {
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
		<?php if ($transmit_details_add->transmittal_no->Required) { ?>
			elm = this.getElements("x" + infix + "_transmittal_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->transmittal_no->caption(), $transmit_details->transmittal_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_add->project_name->Required) { ?>
			elm = this.getElements("x" + infix + "_project_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->project_name->caption(), $transmit_details->project_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_add->delivery_location->Required) { ?>
			elm = this.getElements("x" + infix + "_delivery_location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->delivery_location->caption(), $transmit_details->delivery_location->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_add->addressed_to->Required) { ?>
			elm = this.getElements("x" + infix + "_addressed_to");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->addressed_to->caption(), $transmit_details->addressed_to->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_add->remarks->Required) { ?>
			elm = this.getElements("x" + infix + "_remarks");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->remarks->caption(), $transmit_details->remarks->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_add->ack_rcvd->Required) { ?>
			elm = this.getElements("x" + infix + "_ack_rcvd");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->ack_rcvd->caption(), $transmit_details->ack_rcvd->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_add->ack_document->Required) { ?>
			felm = this.getElements("x" + infix + "_ack_document");
			elm = this.getElements("fn_x" + infix + "_ack_document");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $transmit_details->ack_document->caption(), $transmit_details->ack_document->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($transmit_details_add->transmit_mode->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_mode[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->transmit_mode->caption(), $transmit_details->transmit_mode->RequiredErrorMessage)) ?>");
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
ftransmit_detailsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftransmit_detailsadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftransmit_detailsadd.lists["x_project_name"] = <?php echo $transmit_details_add->project_name->Lookup->toClientList() ?>;
ftransmit_detailsadd.lists["x_project_name"].options = <?php echo JsonEncode($transmit_details_add->project_name->lookupOptions()) ?>;
ftransmit_detailsadd.autoSuggests["x_project_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftransmit_detailsadd.lists["x_ack_rcvd"] = <?php echo $transmit_details_add->ack_rcvd->Lookup->toClientList() ?>;
ftransmit_detailsadd.lists["x_ack_rcvd"].options = <?php echo JsonEncode($transmit_details_add->ack_rcvd->options(FALSE, TRUE)) ?>;
ftransmit_detailsadd.lists["x_transmit_mode[]"] = <?php echo $transmit_details_add->transmit_mode->Lookup->toClientList() ?>;
ftransmit_detailsadd.lists["x_transmit_mode[]"].options = <?php echo JsonEncode($transmit_details_add->transmit_mode->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $transmit_details_add->showPageHeader(); ?>
<?php
$transmit_details_add->showMessage();
?>
<form name="ftransmit_detailsadd" id="ftransmit_detailsadd" class="<?php echo $transmit_details_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($transmit_details_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $transmit_details_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transmit_details">
<?php if ($transmit_details->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$transmit_details_add->IsModal ?>">
<?php if (!$transmit_details_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($transmit_details_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_transmit_detailsadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($transmit_details->transmittal_no->Visible) { // transmittal_no ?>
<?php if ($transmit_details_add->IsMobileOrModal) { ?>
	<div id="r_transmittal_no" class="form-group row">
		<label id="elh_transmit_details_transmittal_no" for="x_transmittal_no" class="<?php echo $transmit_details_add->LeftColumnClass ?>"><?php echo $transmit_details->transmittal_no->caption() ?><?php echo ($transmit_details->transmittal_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transmit_details_add->RightColumnClass ?>"><div<?php echo $transmit_details->transmittal_no->cellAttributes() ?>>
<?php if (!$transmit_details->isConfirm()) { ?>
<span id="el_transmit_details_transmittal_no">
<input type="text" data-table="transmit_details" data-field="x_transmittal_no" name="x_transmittal_no" id="x_transmittal_no" size="30" placeholder="<?php echo HtmlEncode($transmit_details->transmittal_no->getPlaceHolder()) ?>" value="<?php echo $transmit_details->transmittal_no->EditValue ?>"<?php echo $transmit_details->transmittal_no->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_transmit_details_transmittal_no">
<span<?php echo $transmit_details->transmittal_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transmit_details->transmittal_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_transmittal_no" name="x_transmittal_no" id="x_transmittal_no" value="<?php echo HtmlEncode($transmit_details->transmittal_no->FormValue) ?>">
<?php } ?>
<?php echo $transmit_details->transmittal_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmittal_no">
		<td class="<?php echo $transmit_details_add->TableLeftColumnClass ?>"><span id="elh_transmit_details_transmittal_no"><?php echo $transmit_details->transmittal_no->caption() ?><?php echo ($transmit_details->transmittal_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transmit_details->transmittal_no->cellAttributes() ?>>
<?php if (!$transmit_details->isConfirm()) { ?>
<span id="el_transmit_details_transmittal_no">
<input type="text" data-table="transmit_details" data-field="x_transmittal_no" name="x_transmittal_no" id="x_transmittal_no" size="30" placeholder="<?php echo HtmlEncode($transmit_details->transmittal_no->getPlaceHolder()) ?>" value="<?php echo $transmit_details->transmittal_no->EditValue ?>"<?php echo $transmit_details->transmittal_no->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_transmit_details_transmittal_no">
<span<?php echo $transmit_details->transmittal_no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transmit_details->transmittal_no->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_transmittal_no" name="x_transmittal_no" id="x_transmittal_no" value="<?php echo HtmlEncode($transmit_details->transmittal_no->FormValue) ?>">
<?php } ?>
<?php echo $transmit_details->transmittal_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transmit_details->project_name->Visible) { // project_name ?>
<?php if ($transmit_details_add->IsMobileOrModal) { ?>
	<div id="r_project_name" class="form-group row">
		<label id="elh_transmit_details_project_name" class="<?php echo $transmit_details_add->LeftColumnClass ?>"><?php echo $transmit_details->project_name->caption() ?><?php echo ($transmit_details->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transmit_details_add->RightColumnClass ?>"><div<?php echo $transmit_details->project_name->cellAttributes() ?>>
<?php if (!$transmit_details->isConfirm()) { ?>
<span id="el_transmit_details_project_name">
<?php
$wrkonchange = "" . trim(@$transmit_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transmit_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x_project_name" class="text-nowrap" style="z-index: 8970">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_project_name" id="sv_x_project_name" value="<?php echo RemoveHtml($transmit_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($transmit_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transmit_details->project_name->getPlaceHolder()) ?>"<?php echo $transmit_details->project_name->editAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "project_details") && !$transmit_details->project_name->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_project_name" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $transmit_details->project_name->caption() ?>" data-title="<?php echo $transmit_details->project_name->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_project_name',url:'project_detailsaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
	</div>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_project_name" data-value-separator="<?php echo $transmit_details->project_name->displayValueSeparatorAttribute() ?>" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($transmit_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransmit_detailsadd.createAutoSuggest({"id":"x_project_name","forceSelect":true});
</script>
<?php echo $transmit_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
</span>
<?php } else { ?>
<span id="el_transmit_details_project_name">
<span<?php echo $transmit_details->project_name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transmit_details->project_name->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_project_name" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($transmit_details->project_name->FormValue) ?>">
<?php } ?>
<?php echo $transmit_details->project_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_name">
		<td class="<?php echo $transmit_details_add->TableLeftColumnClass ?>"><span id="elh_transmit_details_project_name"><?php echo $transmit_details->project_name->caption() ?><?php echo ($transmit_details->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transmit_details->project_name->cellAttributes() ?>>
<?php if (!$transmit_details->isConfirm()) { ?>
<span id="el_transmit_details_project_name">
<?php
$wrkonchange = "" . trim(@$transmit_details->project_name->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$transmit_details->project_name->EditAttrs["onchange"] = "";
?>
<span id="as_x_project_name" class="text-nowrap" style="z-index: 8970">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_project_name" id="sv_x_project_name" value="<?php echo RemoveHtml($transmit_details->project_name->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($transmit_details->project_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transmit_details->project_name->getPlaceHolder()) ?>"<?php echo $transmit_details->project_name->editAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "project_details") && !$transmit_details->project_name->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_project_name" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $transmit_details->project_name->caption() ?>" data-title="<?php echo $transmit_details->project_name->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_project_name',url:'project_detailsaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
	</div>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_project_name" data-value-separator="<?php echo $transmit_details->project_name->displayValueSeparatorAttribute() ?>" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($transmit_details->project_name->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftransmit_detailsadd.createAutoSuggest({"id":"x_project_name","forceSelect":true});
</script>
<?php echo $transmit_details->project_name->Lookup->getParamTag("p_x_project_name") ?>
</span>
<?php } else { ?>
<span id="el_transmit_details_project_name">
<span<?php echo $transmit_details->project_name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transmit_details->project_name->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_project_name" name="x_project_name" id="x_project_name" value="<?php echo HtmlEncode($transmit_details->project_name->FormValue) ?>">
<?php } ?>
<?php echo $transmit_details->project_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transmit_details->delivery_location->Visible) { // delivery_location ?>
<?php if ($transmit_details_add->IsMobileOrModal) { ?>
	<div id="r_delivery_location" class="form-group row">
		<label id="elh_transmit_details_delivery_location" for="x_delivery_location" class="<?php echo $transmit_details_add->LeftColumnClass ?>"><?php echo $transmit_details->delivery_location->caption() ?><?php echo ($transmit_details->delivery_location->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transmit_details_add->RightColumnClass ?>"><div<?php echo $transmit_details->delivery_location->cellAttributes() ?>>
<?php if (!$transmit_details->isConfirm()) { ?>
<span id="el_transmit_details_delivery_location">
<input type="text" data-table="transmit_details" data-field="x_delivery_location" name="x_delivery_location" id="x_delivery_location" size="30" placeholder="<?php echo HtmlEncode($transmit_details->delivery_location->getPlaceHolder()) ?>" value="<?php echo $transmit_details->delivery_location->EditValue ?>"<?php echo $transmit_details->delivery_location->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_transmit_details_delivery_location">
<span<?php echo $transmit_details->delivery_location->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transmit_details->delivery_location->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_delivery_location" name="x_delivery_location" id="x_delivery_location" value="<?php echo HtmlEncode($transmit_details->delivery_location->FormValue) ?>">
<?php } ?>
<?php echo $transmit_details->delivery_location->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_delivery_location">
		<td class="<?php echo $transmit_details_add->TableLeftColumnClass ?>"><span id="elh_transmit_details_delivery_location"><?php echo $transmit_details->delivery_location->caption() ?><?php echo ($transmit_details->delivery_location->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transmit_details->delivery_location->cellAttributes() ?>>
<?php if (!$transmit_details->isConfirm()) { ?>
<span id="el_transmit_details_delivery_location">
<input type="text" data-table="transmit_details" data-field="x_delivery_location" name="x_delivery_location" id="x_delivery_location" size="30" placeholder="<?php echo HtmlEncode($transmit_details->delivery_location->getPlaceHolder()) ?>" value="<?php echo $transmit_details->delivery_location->EditValue ?>"<?php echo $transmit_details->delivery_location->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_transmit_details_delivery_location">
<span<?php echo $transmit_details->delivery_location->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transmit_details->delivery_location->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_delivery_location" name="x_delivery_location" id="x_delivery_location" value="<?php echo HtmlEncode($transmit_details->delivery_location->FormValue) ?>">
<?php } ?>
<?php echo $transmit_details->delivery_location->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transmit_details->addressed_to->Visible) { // addressed_to ?>
<?php if ($transmit_details_add->IsMobileOrModal) { ?>
	<div id="r_addressed_to" class="form-group row">
		<label id="elh_transmit_details_addressed_to" for="x_addressed_to" class="<?php echo $transmit_details_add->LeftColumnClass ?>"><?php echo $transmit_details->addressed_to->caption() ?><?php echo ($transmit_details->addressed_to->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transmit_details_add->RightColumnClass ?>"><div<?php echo $transmit_details->addressed_to->cellAttributes() ?>>
<?php if (!$transmit_details->isConfirm()) { ?>
<span id="el_transmit_details_addressed_to">
<input type="text" data-table="transmit_details" data-field="x_addressed_to" name="x_addressed_to" id="x_addressed_to" size="30" placeholder="<?php echo HtmlEncode($transmit_details->addressed_to->getPlaceHolder()) ?>" value="<?php echo $transmit_details->addressed_to->EditValue ?>"<?php echo $transmit_details->addressed_to->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_transmit_details_addressed_to">
<span<?php echo $transmit_details->addressed_to->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transmit_details->addressed_to->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_addressed_to" name="x_addressed_to" id="x_addressed_to" value="<?php echo HtmlEncode($transmit_details->addressed_to->FormValue) ?>">
<?php } ?>
<?php echo $transmit_details->addressed_to->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_addressed_to">
		<td class="<?php echo $transmit_details_add->TableLeftColumnClass ?>"><span id="elh_transmit_details_addressed_to"><?php echo $transmit_details->addressed_to->caption() ?><?php echo ($transmit_details->addressed_to->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transmit_details->addressed_to->cellAttributes() ?>>
<?php if (!$transmit_details->isConfirm()) { ?>
<span id="el_transmit_details_addressed_to">
<input type="text" data-table="transmit_details" data-field="x_addressed_to" name="x_addressed_to" id="x_addressed_to" size="30" placeholder="<?php echo HtmlEncode($transmit_details->addressed_to->getPlaceHolder()) ?>" value="<?php echo $transmit_details->addressed_to->EditValue ?>"<?php echo $transmit_details->addressed_to->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_transmit_details_addressed_to">
<span<?php echo $transmit_details->addressed_to->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transmit_details->addressed_to->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_addressed_to" name="x_addressed_to" id="x_addressed_to" value="<?php echo HtmlEncode($transmit_details->addressed_to->FormValue) ?>">
<?php } ?>
<?php echo $transmit_details->addressed_to->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transmit_details->remarks->Visible) { // remarks ?>
<?php if ($transmit_details_add->IsMobileOrModal) { ?>
	<div id="r_remarks" class="form-group row">
		<label id="elh_transmit_details_remarks" class="<?php echo $transmit_details_add->LeftColumnClass ?>"><?php echo $transmit_details->remarks->caption() ?><?php echo ($transmit_details->remarks->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transmit_details_add->RightColumnClass ?>"><div<?php echo $transmit_details->remarks->cellAttributes() ?>>
<?php if (!$transmit_details->isConfirm()) { ?>
<span id="el_transmit_details_remarks">
<?php AppendClass($transmit_details->remarks->EditAttrs["class"], "editor"); ?>
<textarea data-table="transmit_details" data-field="x_remarks" name="x_remarks" id="x_remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($transmit_details->remarks->getPlaceHolder()) ?>"<?php echo $transmit_details->remarks->editAttributes() ?>><?php echo $transmit_details->remarks->EditValue ?></textarea>
<script>
ew.createEditor("ftransmit_detailsadd", "x_remarks", 0, 0, <?php echo ($transmit_details->remarks->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } else { ?>
<span id="el_transmit_details_remarks">
<span<?php echo $transmit_details->remarks->viewAttributes() ?>>
<?php echo $transmit_details->remarks->ViewValue ?></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_remarks" name="x_remarks" id="x_remarks" value="<?php echo HtmlEncode($transmit_details->remarks->FormValue) ?>">
<?php } ?>
<?php echo $transmit_details->remarks->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_remarks">
		<td class="<?php echo $transmit_details_add->TableLeftColumnClass ?>"><span id="elh_transmit_details_remarks"><?php echo $transmit_details->remarks->caption() ?><?php echo ($transmit_details->remarks->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transmit_details->remarks->cellAttributes() ?>>
<?php if (!$transmit_details->isConfirm()) { ?>
<span id="el_transmit_details_remarks">
<?php AppendClass($transmit_details->remarks->EditAttrs["class"], "editor"); ?>
<textarea data-table="transmit_details" data-field="x_remarks" name="x_remarks" id="x_remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($transmit_details->remarks->getPlaceHolder()) ?>"<?php echo $transmit_details->remarks->editAttributes() ?>><?php echo $transmit_details->remarks->EditValue ?></textarea>
<script>
ew.createEditor("ftransmit_detailsadd", "x_remarks", 0, 0, <?php echo ($transmit_details->remarks->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php } else { ?>
<span id="el_transmit_details_remarks">
<span<?php echo $transmit_details->remarks->viewAttributes() ?>>
<?php echo $transmit_details->remarks->ViewValue ?></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_remarks" name="x_remarks" id="x_remarks" value="<?php echo HtmlEncode($transmit_details->remarks->FormValue) ?>">
<?php } ?>
<?php echo $transmit_details->remarks->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transmit_details->ack_rcvd->Visible) { // ack_rcvd ?>
<?php if ($transmit_details_add->IsMobileOrModal) { ?>
	<div id="r_ack_rcvd" class="form-group row">
		<label id="elh_transmit_details_ack_rcvd" class="<?php echo $transmit_details_add->LeftColumnClass ?>"><?php echo $transmit_details->ack_rcvd->caption() ?><?php echo ($transmit_details->ack_rcvd->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transmit_details_add->RightColumnClass ?>"><div<?php echo $transmit_details->ack_rcvd->cellAttributes() ?>>
<?php if (!$transmit_details->isConfirm()) { ?>
<span id="el_transmit_details_ack_rcvd">
<div id="tp_x_ack_rcvd" class="ew-template"><input type="radio" class="form-check-input" data-table="transmit_details" data-field="x_ack_rcvd" data-value-separator="<?php echo $transmit_details->ack_rcvd->displayValueSeparatorAttribute() ?>" name="x_ack_rcvd" id="x_ack_rcvd" value="{value}"<?php echo $transmit_details->ack_rcvd->editAttributes() ?>></div>
<div id="dsl_x_ack_rcvd" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transmit_details->ack_rcvd->radioButtonListHtml(FALSE, "x_ack_rcvd") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_transmit_details_ack_rcvd">
<span<?php echo $transmit_details->ack_rcvd->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transmit_details->ack_rcvd->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_ack_rcvd" name="x_ack_rcvd" id="x_ack_rcvd" value="<?php echo HtmlEncode($transmit_details->ack_rcvd->FormValue) ?>">
<?php } ?>
<?php echo $transmit_details->ack_rcvd->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ack_rcvd">
		<td class="<?php echo $transmit_details_add->TableLeftColumnClass ?>"><span id="elh_transmit_details_ack_rcvd"><?php echo $transmit_details->ack_rcvd->caption() ?><?php echo ($transmit_details->ack_rcvd->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transmit_details->ack_rcvd->cellAttributes() ?>>
<?php if (!$transmit_details->isConfirm()) { ?>
<span id="el_transmit_details_ack_rcvd">
<div id="tp_x_ack_rcvd" class="ew-template"><input type="radio" class="form-check-input" data-table="transmit_details" data-field="x_ack_rcvd" data-value-separator="<?php echo $transmit_details->ack_rcvd->displayValueSeparatorAttribute() ?>" name="x_ack_rcvd" id="x_ack_rcvd" value="{value}"<?php echo $transmit_details->ack_rcvd->editAttributes() ?>></div>
<div id="dsl_x_ack_rcvd" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transmit_details->ack_rcvd->radioButtonListHtml(FALSE, "x_ack_rcvd") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_transmit_details_ack_rcvd">
<span<?php echo $transmit_details->ack_rcvd->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transmit_details->ack_rcvd->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_ack_rcvd" name="x_ack_rcvd" id="x_ack_rcvd" value="<?php echo HtmlEncode($transmit_details->ack_rcvd->FormValue) ?>">
<?php } ?>
<?php echo $transmit_details->ack_rcvd->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transmit_details->ack_document->Visible) { // ack_document ?>
<?php if ($transmit_details_add->IsMobileOrModal) { ?>
	<div id="r_ack_document" class="form-group row">
		<label id="elh_transmit_details_ack_document" class="<?php echo $transmit_details_add->LeftColumnClass ?>"><?php echo $transmit_details->ack_document->caption() ?><?php echo ($transmit_details->ack_document->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transmit_details_add->RightColumnClass ?>"><div<?php echo $transmit_details->ack_document->cellAttributes() ?>>
<span id="el_transmit_details_ack_document">
<div id="fd_x_ack_document">
<span title="<?php echo $transmit_details->ack_document->title() ? $transmit_details->ack_document->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($transmit_details->ack_document->ReadOnly || $transmit_details->ack_document->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="transmit_details" data-field="x_ack_document" name="x_ack_document" id="x_ack_document"<?php echo $transmit_details->ack_document->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_ack_document" id= "fn_x_ack_document" value="<?php echo $transmit_details->ack_document->Upload->FileName ?>">
<input type="hidden" name="fa_x_ack_document" id= "fa_x_ack_document" value="0">
<input type="hidden" name="fs_x_ack_document" id= "fs_x_ack_document" value="0">
<input type="hidden" name="fx_x_ack_document" id= "fx_x_ack_document" value="<?php echo $transmit_details->ack_document->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_ack_document" id= "fm_x_ack_document" value="<?php echo $transmit_details->ack_document->UploadMaxFileSize ?>">
</div>
<table id="ft_x_ack_document" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $transmit_details->ack_document->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ack_document">
		<td class="<?php echo $transmit_details_add->TableLeftColumnClass ?>"><span id="elh_transmit_details_ack_document"><?php echo $transmit_details->ack_document->caption() ?><?php echo ($transmit_details->ack_document->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transmit_details->ack_document->cellAttributes() ?>>
<span id="el_transmit_details_ack_document">
<div id="fd_x_ack_document">
<span title="<?php echo $transmit_details->ack_document->title() ? $transmit_details->ack_document->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($transmit_details->ack_document->ReadOnly || $transmit_details->ack_document->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="transmit_details" data-field="x_ack_document" name="x_ack_document" id="x_ack_document"<?php echo $transmit_details->ack_document->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_ack_document" id= "fn_x_ack_document" value="<?php echo $transmit_details->ack_document->Upload->FileName ?>">
<input type="hidden" name="fa_x_ack_document" id= "fa_x_ack_document" value="0">
<input type="hidden" name="fs_x_ack_document" id= "fs_x_ack_document" value="0">
<input type="hidden" name="fx_x_ack_document" id= "fx_x_ack_document" value="<?php echo $transmit_details->ack_document->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_ack_document" id= "fm_x_ack_document" value="<?php echo $transmit_details->ack_document->UploadMaxFileSize ?>">
</div>
<table id="ft_x_ack_document" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $transmit_details->ack_document->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transmit_details->transmit_mode->Visible) { // transmit_mode ?>
<?php if ($transmit_details_add->IsMobileOrModal) { ?>
	<div id="r_transmit_mode" class="form-group row">
		<label id="elh_transmit_details_transmit_mode" class="<?php echo $transmit_details_add->LeftColumnClass ?>"><?php echo $transmit_details->transmit_mode->caption() ?><?php echo ($transmit_details->transmit_mode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transmit_details_add->RightColumnClass ?>"><div<?php echo $transmit_details->transmit_mode->cellAttributes() ?>>
<?php if (!$transmit_details->isConfirm()) { ?>
<span id="el_transmit_details_transmit_mode">
<div id="tp_x_transmit_mode" class="ew-template"><input type="checkbox" class="form-check-input" data-table="transmit_details" data-field="x_transmit_mode" data-value-separator="<?php echo $transmit_details->transmit_mode->displayValueSeparatorAttribute() ?>" name="x_transmit_mode[]" id="x_transmit_mode[]" value="{value}"<?php echo $transmit_details->transmit_mode->editAttributes() ?>></div>
<div id="dsl_x_transmit_mode" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transmit_details->transmit_mode->checkBoxListHtml(FALSE, "x_transmit_mode[]") ?>
</div></div>
<?php echo $transmit_details->transmit_mode->Lookup->getParamTag("p_x_transmit_mode") ?>
</span>
<?php } else { ?>
<span id="el_transmit_details_transmit_mode">
<span<?php echo $transmit_details->transmit_mode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transmit_details->transmit_mode->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_transmit_mode" name="x_transmit_mode" id="x_transmit_mode" value="<?php echo HtmlEncode($transmit_details->transmit_mode->FormValue) ?>">
<?php } ?>
<?php echo $transmit_details->transmit_mode->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_mode">
		<td class="<?php echo $transmit_details_add->TableLeftColumnClass ?>"><span id="elh_transmit_details_transmit_mode"><?php echo $transmit_details->transmit_mode->caption() ?><?php echo ($transmit_details->transmit_mode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $transmit_details->transmit_mode->cellAttributes() ?>>
<?php if (!$transmit_details->isConfirm()) { ?>
<span id="el_transmit_details_transmit_mode">
<div id="tp_x_transmit_mode" class="ew-template"><input type="checkbox" class="form-check-input" data-table="transmit_details" data-field="x_transmit_mode" data-value-separator="<?php echo $transmit_details->transmit_mode->displayValueSeparatorAttribute() ?>" name="x_transmit_mode[]" id="x_transmit_mode[]" value="{value}"<?php echo $transmit_details->transmit_mode->editAttributes() ?>></div>
<div id="dsl_x_transmit_mode" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $transmit_details->transmit_mode->checkBoxListHtml(FALSE, "x_transmit_mode[]") ?>
</div></div>
<?php echo $transmit_details->transmit_mode->Lookup->getParamTag("p_x_transmit_mode") ?>
</span>
<?php } else { ?>
<span id="el_transmit_details_transmit_mode">
<span<?php echo $transmit_details->transmit_mode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($transmit_details->transmit_mode->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="transmit_details" data-field="x_transmit_mode" name="x_transmit_mode" id="x_transmit_mode" value="<?php echo HtmlEncode($transmit_details->transmit_mode->FormValue) ?>">
<?php } ?>
<?php echo $transmit_details->transmit_mode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($transmit_details_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$transmit_details_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $transmit_details_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$transmit_details->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $transmit_details_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$transmit_details_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$transmit_details_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$transmit_details_add->terminate();
?>