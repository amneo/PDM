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
$transmit_details_update = new transmit_details_update();

// Run the page
$transmit_details_update->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transmit_details_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "update";
var ftransmit_detailsupdate = currentForm = new ew.Form("ftransmit_detailsupdate", "update");

// Validate form
ftransmit_detailsupdate.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	if (!ew.updateSelected(fobj)) {
		ew.alert(ew.language.phrase("NoFieldSelected"));
		return false;
	}
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($transmit_details_update->ack_rcvd->Required) { ?>
			elm = this.getElements("x" + infix + "_ack_rcvd");
			uelm = this.getElements("u" + infix + "_ack_rcvd");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->ack_rcvd->caption(), $transmit_details->ack_rcvd->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
		<?php if ($transmit_details_update->ack_document->Required) { ?>
			felm = this.getElements("x" + infix + "_ack_document");
			elm = this.getElements("fn_x" + infix + "_ack_document");
			uelm = this.getElements("u" + infix + "_ack_document");
			if (uelm && uelm.checked) {
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $transmit_details->ack_document->caption(), $transmit_details->ack_document->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
		<?php if ($transmit_details_update->transmit_mode->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_mode[]");
			uelm = this.getElements("u" + infix + "_transmit_mode");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transmit_details->transmit_mode->caption(), $transmit_details->transmit_mode->RequiredErrorMessage)) ?>");
			}
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftransmit_detailsupdate.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftransmit_detailsupdate.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftransmit_detailsupdate.lists["x_ack_rcvd"] = <?php echo $transmit_details_update->ack_rcvd->Lookup->toClientList() ?>;
ftransmit_detailsupdate.lists["x_ack_rcvd"].options = <?php echo JsonEncode($transmit_details_update->ack_rcvd->options(FALSE, TRUE)) ?>;
ftransmit_detailsupdate.lists["x_transmit_mode[]"] = <?php echo $transmit_details_update->transmit_mode->Lookup->toClientList() ?>;
ftransmit_detailsupdate.lists["x_transmit_mode[]"].options = <?php echo JsonEncode($transmit_details_update->transmit_mode->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $transmit_details_update->showPageHeader(); ?>
<?php
$transmit_details_update->showMessage();
?>
<form name="ftransmit_detailsupdate" id="ftransmit_detailsupdate" class="<?php echo $transmit_details_update->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($transmit_details_update->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $transmit_details_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transmit_details">
<?php if ($transmit_details->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$transmit_details_update->IsModal ?>">
<?php foreach ($transmit_details_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<?php if (!$transmit_details_update->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($transmit_details_update->IsMobileOrModal) { ?>
<div id="tbl_transmit_detailsupdate" class="ew-update-div"><!-- page -->
	<div class="form-check">
		<input type="checkbox" class="form-check-input" name="u" id="u" onclick="ew.selectAll(this);"<?php echo $transmit_details_update->Disabled ?>><label class="form-check-label" for="u"><?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php } else { ?>
<table id="tbl_transmit_detailsupdate" class="table table-striped table-sm ew-desktop-table"><!-- desktop table -->
	<thead>
	<tr>
		<th colspan="2"><div class="form-check"><input type="checkbox" class="form-check-input" name="u" id="u" onclick="ew.selectAll(this);"<?php echo $transmit_details_update->Disabled ?>><label class="form-check-label" for="u"><?php echo $Language->Phrase("UpdateSelectAll") ?></label></div></th>
	</tr>
	</thead>
	<tbody>
<?php } ?>
<?php if ($transmit_details->ack_rcvd->Visible) { // ack_rcvd ?>
<?php if ($transmit_details_update->IsMobileOrModal) { ?>
	<div id="r_ack_rcvd" class="form-group row">
		<label class="<?php echo $transmit_details_update->LeftColumnClass ?>"><div class="form-check">
<?php if (!$transmit_details->isConfirm()) { ?>
<input type="checkbox" name="u_ack_rcvd" id="u_ack_rcvd" class="form-check-input ew-multi-select" value="1"<?php echo ($transmit_details->ack_rcvd->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_ack_rcvd" id="u_ack_rcvd" value="<?php echo $transmit_details->ack_rcvd->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($transmit_details->ack_rcvd->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_ack_rcvd"><?php echo $transmit_details->ack_rcvd->caption() ?></label></div></label>
		<div class="<?php echo $transmit_details_update->RightColumnClass ?>"><div<?php echo $transmit_details->ack_rcvd->cellAttributes() ?>>
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
		<td class="<?php echo $transmit_details_update->TableLeftColumnClass ?>"<?php echo $transmit_details->ack_rcvd->cellAttributes() ?>><span id="elh_transmit_details_ack_rcvd"><div class="form-check">
<?php if (!$transmit_details->isConfirm()) { ?>
<input type="checkbox" name="u_ack_rcvd" id="u_ack_rcvd" class="form-check-input ew-multi-select" value="1"<?php echo ($transmit_details->ack_rcvd->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_ack_rcvd" id="u_ack_rcvd" value="<?php echo $transmit_details->ack_rcvd->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($transmit_details->ack_rcvd->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_ack_rcvd"><?php echo $transmit_details->ack_rcvd->caption() ?></label></div></span></td>
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
<?php if ($transmit_details_update->IsMobileOrModal) { ?>
	<div id="r_ack_document" class="form-group row">
		<label class="<?php echo $transmit_details_update->LeftColumnClass ?>"><div class="form-check">
<?php if (!$transmit_details->isConfirm()) { ?>
<input type="checkbox" name="u_ack_document" id="u_ack_document" class="form-check-input ew-multi-select" value="1"<?php echo ($transmit_details->ack_document->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_ack_document" id="u_ack_document" value="<?php echo $transmit_details->ack_document->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($transmit_details->ack_document->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_ack_document"><?php echo $transmit_details->ack_document->caption() ?></label></div></label>
		<div class="<?php echo $transmit_details_update->RightColumnClass ?>"><div<?php echo $transmit_details->ack_document->cellAttributes() ?>>
<span id="el_transmit_details_ack_document">
<div id="fd_x_ack_document">
<span title="<?php echo $transmit_details->ack_document->title() ? $transmit_details->ack_document->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($transmit_details->ack_document->ReadOnly || $transmit_details->ack_document->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="transmit_details" data-field="x_ack_document" name="x_ack_document" id="x_ack_document"<?php echo $transmit_details->ack_document->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_ack_document" id= "fn_x_ack_document" value="<?php echo $transmit_details->ack_document->Upload->FileName ?>">
<?php if (Post("fa_x_ack_document") == "0") { ?>
<input type="hidden" name="fa_x_ack_document" id= "fa_x_ack_document" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_ack_document" id= "fa_x_ack_document" value="1">
<?php } ?>
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
		<td class="<?php echo $transmit_details_update->TableLeftColumnClass ?>"<?php echo $transmit_details->ack_document->cellAttributes() ?>><span id="elh_transmit_details_ack_document"><div class="form-check">
<?php if (!$transmit_details->isConfirm()) { ?>
<input type="checkbox" name="u_ack_document" id="u_ack_document" class="form-check-input ew-multi-select" value="1"<?php echo ($transmit_details->ack_document->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_ack_document" id="u_ack_document" value="<?php echo $transmit_details->ack_document->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($transmit_details->ack_document->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_ack_document"><?php echo $transmit_details->ack_document->caption() ?></label></div></span></td>
		<td<?php echo $transmit_details->ack_document->cellAttributes() ?>>
<span id="el_transmit_details_ack_document">
<div id="fd_x_ack_document">
<span title="<?php echo $transmit_details->ack_document->title() ? $transmit_details->ack_document->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($transmit_details->ack_document->ReadOnly || $transmit_details->ack_document->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="transmit_details" data-field="x_ack_document" name="x_ack_document" id="x_ack_document"<?php echo $transmit_details->ack_document->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_ack_document" id= "fn_x_ack_document" value="<?php echo $transmit_details->ack_document->Upload->FileName ?>">
<?php if (Post("fa_x_ack_document") == "0") { ?>
<input type="hidden" name="fa_x_ack_document" id= "fa_x_ack_document" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_ack_document" id= "fa_x_ack_document" value="1">
<?php } ?>
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
<?php if ($transmit_details_update->IsMobileOrModal) { ?>
	<div id="r_transmit_mode" class="form-group row">
		<label class="<?php echo $transmit_details_update->LeftColumnClass ?>"><div class="form-check">
<?php if (!$transmit_details->isConfirm()) { ?>
<input type="checkbox" name="u_transmit_mode" id="u_transmit_mode" class="form-check-input ew-multi-select" value="1"<?php echo ($transmit_details->transmit_mode->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_transmit_mode" id="u_transmit_mode" value="<?php echo $transmit_details->transmit_mode->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($transmit_details->transmit_mode->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_transmit_mode"><?php echo $transmit_details->transmit_mode->caption() ?></label></div></label>
		<div class="<?php echo $transmit_details_update->RightColumnClass ?>"><div<?php echo $transmit_details->transmit_mode->cellAttributes() ?>>
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
		<td class="<?php echo $transmit_details_update->TableLeftColumnClass ?>"<?php echo $transmit_details->transmit_mode->cellAttributes() ?>><span id="elh_transmit_details_transmit_mode"><div class="form-check">
<?php if (!$transmit_details->isConfirm()) { ?>
<input type="checkbox" name="u_transmit_mode" id="u_transmit_mode" class="form-check-input ew-multi-select" value="1"<?php echo ($transmit_details->transmit_mode->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_transmit_mode" id="u_transmit_mode" value="<?php echo $transmit_details->transmit_mode->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($transmit_details->transmit_mode->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_transmit_mode"><?php echo $transmit_details->transmit_mode->caption() ?></label></div></span></td>
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
<?php if ($transmit_details_update->IsMobileOrModal) { ?>
	</div><!-- /page -->
<?php } else { ?>
	</tbody>
</table><!-- /desktop table -->
<?php } ?>
<?php if (!$transmit_details_update->IsModal) { ?>
	<div class="form-group row"><!-- buttons .form-group -->
		<div class="<?php echo $transmit_details_update->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$transmit_details->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("UpdateBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $transmit_details_update->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$transmit_details_update->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$transmit_details_update->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$transmit_details_update->terminate();
?>