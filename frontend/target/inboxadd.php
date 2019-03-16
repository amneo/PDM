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
$inbox_add = new inbox_add();

// Run the page
$inbox_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inbox_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var finboxadd = currentForm = new ew.Form("finboxadd", "add");

// Validate form
finboxadd.validate = function() {
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
		<?php if ($inbox_add->from->Required) { ?>
			elm = this.getElements("x" + infix + "_from");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inbox->from->caption(), $inbox->from->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inbox_add->project_name->Required) { ?>
			elm = this.getElements("x" + infix + "_project_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inbox->project_name->caption(), $inbox->project_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inbox_add->client_send_to->Required) { ?>
			elm = this.getElements("x" + infix + "_client_send_to");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inbox->client_send_to->caption(), $inbox->client_send_to->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inbox_add->mode_send->Required) { ?>
			elm = this.getElements("x" + infix + "_mode_send");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inbox->mode_send->caption(), $inbox->mode_send->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inbox_add->remarks->Required) { ?>
			elm = this.getElements("x" + infix + "_remarks");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inbox->remarks->caption(), $inbox->remarks->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inbox_add->document_link->Required) { ?>
			felm = this.getElements("x" + infix + "_document_link");
			elm = this.getElements("fn_x" + infix + "_document_link");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $inbox->document_link->caption(), $inbox->document_link->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inbox_add->native_file_link->Required) { ?>
			elm = this.getElements("x" + infix + "_native_file_link");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inbox->native_file_link->caption(), $inbox->native_file_link->RequiredErrorMessage)) ?>");
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
finboxadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finboxadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $inbox_add->showPageHeader(); ?>
<?php
$inbox_add->showMessage();
?>
<form name="finboxadd" id="finboxadd" class="<?php echo $inbox_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inbox_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inbox_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inbox">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$inbox_add->IsModal ?>">
<?php if (!$inbox_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($inbox_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_inboxadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($inbox->from->Visible) { // from ?>
<?php if ($inbox_add->IsMobileOrModal) { ?>
	<div id="r_from" class="form-group row">
		<label id="elh_inbox_from" for="x_from" class="<?php echo $inbox_add->LeftColumnClass ?>"><?php echo $inbox->from->caption() ?><?php echo ($inbox->from->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inbox_add->RightColumnClass ?>"><div<?php echo $inbox->from->cellAttributes() ?>>
<span id="el_inbox_from">
<input type="text" data-table="inbox" data-field="x_from" name="x_from" id="x_from" size="30" placeholder="<?php echo HtmlEncode($inbox->from->getPlaceHolder()) ?>" value="<?php echo $inbox->from->EditValue ?>"<?php echo $inbox->from->editAttributes() ?>>
</span>
<?php echo $inbox->from->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_from">
		<td class="<?php echo $inbox_add->TableLeftColumnClass ?>"><span id="elh_inbox_from"><?php echo $inbox->from->caption() ?><?php echo ($inbox->from->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $inbox->from->cellAttributes() ?>>
<span id="el_inbox_from">
<input type="text" data-table="inbox" data-field="x_from" name="x_from" id="x_from" size="30" placeholder="<?php echo HtmlEncode($inbox->from->getPlaceHolder()) ?>" value="<?php echo $inbox->from->EditValue ?>"<?php echo $inbox->from->editAttributes() ?>>
</span>
<?php echo $inbox->from->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($inbox->project_name->Visible) { // project_name ?>
<?php if ($inbox_add->IsMobileOrModal) { ?>
	<div id="r_project_name" class="form-group row">
		<label id="elh_inbox_project_name" for="x_project_name" class="<?php echo $inbox_add->LeftColumnClass ?>"><?php echo $inbox->project_name->caption() ?><?php echo ($inbox->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inbox_add->RightColumnClass ?>"><div<?php echo $inbox->project_name->cellAttributes() ?>>
<span id="el_inbox_project_name">
<input type="text" data-table="inbox" data-field="x_project_name" name="x_project_name" id="x_project_name" size="30" placeholder="<?php echo HtmlEncode($inbox->project_name->getPlaceHolder()) ?>" value="<?php echo $inbox->project_name->EditValue ?>"<?php echo $inbox->project_name->editAttributes() ?>>
</span>
<?php echo $inbox->project_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_name">
		<td class="<?php echo $inbox_add->TableLeftColumnClass ?>"><span id="elh_inbox_project_name"><?php echo $inbox->project_name->caption() ?><?php echo ($inbox->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $inbox->project_name->cellAttributes() ?>>
<span id="el_inbox_project_name">
<input type="text" data-table="inbox" data-field="x_project_name" name="x_project_name" id="x_project_name" size="30" placeholder="<?php echo HtmlEncode($inbox->project_name->getPlaceHolder()) ?>" value="<?php echo $inbox->project_name->EditValue ?>"<?php echo $inbox->project_name->editAttributes() ?>>
</span>
<?php echo $inbox->project_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($inbox->client_send_to->Visible) { // client_send_to ?>
<?php if ($inbox_add->IsMobileOrModal) { ?>
	<div id="r_client_send_to" class="form-group row">
		<label id="elh_inbox_client_send_to" for="x_client_send_to" class="<?php echo $inbox_add->LeftColumnClass ?>"><?php echo $inbox->client_send_to->caption() ?><?php echo ($inbox->client_send_to->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inbox_add->RightColumnClass ?>"><div<?php echo $inbox->client_send_to->cellAttributes() ?>>
<span id="el_inbox_client_send_to">
<input type="text" data-table="inbox" data-field="x_client_send_to" name="x_client_send_to" id="x_client_send_to" size="30" placeholder="<?php echo HtmlEncode($inbox->client_send_to->getPlaceHolder()) ?>" value="<?php echo $inbox->client_send_to->EditValue ?>"<?php echo $inbox->client_send_to->editAttributes() ?>>
</span>
<?php echo $inbox->client_send_to->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_client_send_to">
		<td class="<?php echo $inbox_add->TableLeftColumnClass ?>"><span id="elh_inbox_client_send_to"><?php echo $inbox->client_send_to->caption() ?><?php echo ($inbox->client_send_to->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $inbox->client_send_to->cellAttributes() ?>>
<span id="el_inbox_client_send_to">
<input type="text" data-table="inbox" data-field="x_client_send_to" name="x_client_send_to" id="x_client_send_to" size="30" placeholder="<?php echo HtmlEncode($inbox->client_send_to->getPlaceHolder()) ?>" value="<?php echo $inbox->client_send_to->EditValue ?>"<?php echo $inbox->client_send_to->editAttributes() ?>>
</span>
<?php echo $inbox->client_send_to->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($inbox->mode_send->Visible) { // mode_send ?>
<?php if ($inbox_add->IsMobileOrModal) { ?>
	<div id="r_mode_send" class="form-group row">
		<label id="elh_inbox_mode_send" for="x_mode_send" class="<?php echo $inbox_add->LeftColumnClass ?>"><?php echo $inbox->mode_send->caption() ?><?php echo ($inbox->mode_send->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inbox_add->RightColumnClass ?>"><div<?php echo $inbox->mode_send->cellAttributes() ?>>
<span id="el_inbox_mode_send">
<input type="text" data-table="inbox" data-field="x_mode_send" name="x_mode_send" id="x_mode_send" size="30" placeholder="<?php echo HtmlEncode($inbox->mode_send->getPlaceHolder()) ?>" value="<?php echo $inbox->mode_send->EditValue ?>"<?php echo $inbox->mode_send->editAttributes() ?>>
</span>
<?php echo $inbox->mode_send->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_mode_send">
		<td class="<?php echo $inbox_add->TableLeftColumnClass ?>"><span id="elh_inbox_mode_send"><?php echo $inbox->mode_send->caption() ?><?php echo ($inbox->mode_send->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $inbox->mode_send->cellAttributes() ?>>
<span id="el_inbox_mode_send">
<input type="text" data-table="inbox" data-field="x_mode_send" name="x_mode_send" id="x_mode_send" size="30" placeholder="<?php echo HtmlEncode($inbox->mode_send->getPlaceHolder()) ?>" value="<?php echo $inbox->mode_send->EditValue ?>"<?php echo $inbox->mode_send->editAttributes() ?>>
</span>
<?php echo $inbox->mode_send->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($inbox->remarks->Visible) { // remarks ?>
<?php if ($inbox_add->IsMobileOrModal) { ?>
	<div id="r_remarks" class="form-group row">
		<label id="elh_inbox_remarks" for="x_remarks" class="<?php echo $inbox_add->LeftColumnClass ?>"><?php echo $inbox->remarks->caption() ?><?php echo ($inbox->remarks->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inbox_add->RightColumnClass ?>"><div<?php echo $inbox->remarks->cellAttributes() ?>>
<span id="el_inbox_remarks">
<input type="text" data-table="inbox" data-field="x_remarks" name="x_remarks" id="x_remarks" size="30" placeholder="<?php echo HtmlEncode($inbox->remarks->getPlaceHolder()) ?>" value="<?php echo $inbox->remarks->EditValue ?>"<?php echo $inbox->remarks->editAttributes() ?>>
</span>
<?php echo $inbox->remarks->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_remarks">
		<td class="<?php echo $inbox_add->TableLeftColumnClass ?>"><span id="elh_inbox_remarks"><?php echo $inbox->remarks->caption() ?><?php echo ($inbox->remarks->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $inbox->remarks->cellAttributes() ?>>
<span id="el_inbox_remarks">
<input type="text" data-table="inbox" data-field="x_remarks" name="x_remarks" id="x_remarks" size="30" placeholder="<?php echo HtmlEncode($inbox->remarks->getPlaceHolder()) ?>" value="<?php echo $inbox->remarks->EditValue ?>"<?php echo $inbox->remarks->editAttributes() ?>>
</span>
<?php echo $inbox->remarks->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($inbox->document_link->Visible) { // document_link ?>
<?php if ($inbox_add->IsMobileOrModal) { ?>
	<div id="r_document_link" class="form-group row">
		<label id="elh_inbox_document_link" class="<?php echo $inbox_add->LeftColumnClass ?>"><?php echo $inbox->document_link->caption() ?><?php echo ($inbox->document_link->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inbox_add->RightColumnClass ?>"><div<?php echo $inbox->document_link->cellAttributes() ?>>
<span id="el_inbox_document_link">
<div id="fd_x_document_link">
<span title="<?php echo $inbox->document_link->title() ? $inbox->document_link->title() : $Language->phrase("ChooseFiles") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($inbox->document_link->ReadOnly || $inbox->document_link->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="inbox" data-field="x_document_link" name="x_document_link" id="x_document_link" multiple="multiple"<?php echo $inbox->document_link->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_document_link" id= "fn_x_document_link" value="<?php echo $inbox->document_link->Upload->FileName ?>">
<input type="hidden" name="fa_x_document_link" id= "fa_x_document_link" value="0">
<input type="hidden" name="fs_x_document_link" id= "fs_x_document_link" value="0">
<input type="hidden" name="fx_x_document_link" id= "fx_x_document_link" value="<?php echo $inbox->document_link->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_document_link" id= "fm_x_document_link" value="<?php echo $inbox->document_link->UploadMaxFileSize ?>">
<input type="hidden" name="fc_x_document_link" id= "fc_x_document_link" value="<?php echo $inbox->document_link->UploadMaxFileCount ?>">
</div>
<table id="ft_x_document_link" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $inbox->document_link->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_link">
		<td class="<?php echo $inbox_add->TableLeftColumnClass ?>"><span id="elh_inbox_document_link"><?php echo $inbox->document_link->caption() ?><?php echo ($inbox->document_link->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $inbox->document_link->cellAttributes() ?>>
<span id="el_inbox_document_link">
<div id="fd_x_document_link">
<span title="<?php echo $inbox->document_link->title() ? $inbox->document_link->title() : $Language->phrase("ChooseFiles") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($inbox->document_link->ReadOnly || $inbox->document_link->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="inbox" data-field="x_document_link" name="x_document_link" id="x_document_link" multiple="multiple"<?php echo $inbox->document_link->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_document_link" id= "fn_x_document_link" value="<?php echo $inbox->document_link->Upload->FileName ?>">
<input type="hidden" name="fa_x_document_link" id= "fa_x_document_link" value="0">
<input type="hidden" name="fs_x_document_link" id= "fs_x_document_link" value="0">
<input type="hidden" name="fx_x_document_link" id= "fx_x_document_link" value="<?php echo $inbox->document_link->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_document_link" id= "fm_x_document_link" value="<?php echo $inbox->document_link->UploadMaxFileSize ?>">
<input type="hidden" name="fc_x_document_link" id= "fc_x_document_link" value="<?php echo $inbox->document_link->UploadMaxFileCount ?>">
</div>
<table id="ft_x_document_link" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $inbox->document_link->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($inbox->native_file_link->Visible) { // native_file_link ?>
<?php if ($inbox_add->IsMobileOrModal) { ?>
	<div id="r_native_file_link" class="form-group row">
		<label id="elh_inbox_native_file_link" for="x_native_file_link" class="<?php echo $inbox_add->LeftColumnClass ?>"><?php echo $inbox->native_file_link->caption() ?><?php echo ($inbox->native_file_link->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inbox_add->RightColumnClass ?>"><div<?php echo $inbox->native_file_link->cellAttributes() ?>>
<span id="el_inbox_native_file_link">
<input type="text" data-table="inbox" data-field="x_native_file_link" name="x_native_file_link" id="x_native_file_link" size="30" placeholder="<?php echo HtmlEncode($inbox->native_file_link->getPlaceHolder()) ?>" value="<?php echo $inbox->native_file_link->EditValue ?>"<?php echo $inbox->native_file_link->editAttributes() ?>>
</span>
<?php echo $inbox->native_file_link->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_native_file_link">
		<td class="<?php echo $inbox_add->TableLeftColumnClass ?>"><span id="elh_inbox_native_file_link"><?php echo $inbox->native_file_link->caption() ?><?php echo ($inbox->native_file_link->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $inbox->native_file_link->cellAttributes() ?>>
<span id="el_inbox_native_file_link">
<input type="text" data-table="inbox" data-field="x_native_file_link" name="x_native_file_link" id="x_native_file_link" size="30" placeholder="<?php echo HtmlEncode($inbox->native_file_link->getPlaceHolder()) ?>" value="<?php echo $inbox->native_file_link->EditValue ?>"<?php echo $inbox->native_file_link->editAttributes() ?>>
</span>
<?php echo $inbox->native_file_link->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($inbox_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$inbox_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $inbox_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $inbox_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$inbox_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$inbox_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inbox_add->terminate();
?>