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
$user_dtls_add = new user_dtls_add();

// Run the page
$user_dtls_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_dtls_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fuser_dtlsadd = currentForm = new ew.Form("fuser_dtlsadd", "add");

// Validate form
fuser_dtlsadd.validate = function() {
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
		<?php if ($user_dtls_add->username->Required) { ?>
			elm = this.getElements("x" + infix + "_username");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_dtls->username->caption(), $user_dtls->username->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_dtls_add->password->Required) { ?>
			elm = this.getElements("x" + infix + "_password");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_dtls->password->caption(), $user_dtls->password->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_dtls_add->account_valid->Required) { ?>
			elm = this.getElements("x" + infix + "_account_valid[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_dtls->account_valid->caption(), $user_dtls->account_valid->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_dtls_add->email_addreess->Required) { ?>
			elm = this.getElements("x" + infix + "_email_addreess");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_dtls->email_addreess->caption(), $user_dtls->email_addreess->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_email_addreess");
			if (elm && !ew.checkEmail(elm.value))
				return this.onError(elm, "<?php echo JsEncode($user_dtls->email_addreess->errorMessage()) ?>");
		<?php if ($user_dtls_add->UserLevel->Required) { ?>
			elm = this.getElements("x" + infix + "_UserLevel");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_dtls->UserLevel->caption(), $user_dtls->UserLevel->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_dtls_add->reports_to->Required) { ?>
			elm = this.getElements("x" + infix + "_reports_to");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_dtls->reports_to->caption(), $user_dtls->reports_to->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_dtls_add->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_dtls->name->caption(), $user_dtls->name->RequiredErrorMessage)) ?>");
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
fuser_dtlsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuser_dtlsadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fuser_dtlsadd.lists["x_account_valid[]"] = <?php echo $user_dtls_add->account_valid->Lookup->toClientList() ?>;
fuser_dtlsadd.lists["x_account_valid[]"].options = <?php echo JsonEncode($user_dtls_add->account_valid->options(FALSE, TRUE)) ?>;
fuser_dtlsadd.lists["x_UserLevel"] = <?php echo $user_dtls_add->UserLevel->Lookup->toClientList() ?>;
fuser_dtlsadd.lists["x_UserLevel"].options = <?php echo JsonEncode($user_dtls_add->UserLevel->lookupOptions()) ?>;
fuser_dtlsadd.lists["x_reports_to"] = <?php echo $user_dtls_add->reports_to->Lookup->toClientList() ?>;
fuser_dtlsadd.lists["x_reports_to"].options = <?php echo JsonEncode($user_dtls_add->reports_to->lookupOptions()) ?>;
fuser_dtlsadd.autoSuggests["x_reports_to"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $user_dtls_add->showPageHeader(); ?>
<?php
$user_dtls_add->showMessage();
?>
<form name="fuser_dtlsadd" id="fuser_dtlsadd" class="<?php echo $user_dtls_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($user_dtls_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $user_dtls_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user_dtls">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$user_dtls_add->IsModal ?>">
<!-- Fields to prevent google autofill -->
<input class="d-none" type="text" name="<?php echo Encrypt(Random()) ?>">
<input class="d-none" type="password" name="<?php echo Encrypt(Random()) ?>">
<?php if (!$user_dtls_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($user_dtls_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_user_dtlsadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($user_dtls->username->Visible) { // username ?>
<?php if ($user_dtls_add->IsMobileOrModal) { ?>
	<div id="r_username" class="form-group row">
		<label id="elh_user_dtls_username" for="x_username" class="<?php echo $user_dtls_add->LeftColumnClass ?>"><?php echo $user_dtls->username->caption() ?><?php echo ($user_dtls->username->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_dtls_add->RightColumnClass ?>"><div<?php echo $user_dtls->username->cellAttributes() ?>>
<span id="el_user_dtls_username">
<input type="text" data-table="user_dtls" data-field="x_username" name="x_username" id="x_username" size="30" placeholder="<?php echo HtmlEncode($user_dtls->username->getPlaceHolder()) ?>" value="<?php echo $user_dtls->username->EditValue ?>"<?php echo $user_dtls->username->editAttributes() ?>>
</span>
<?php echo $user_dtls->username->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_username">
		<td class="<?php echo $user_dtls_add->TableLeftColumnClass ?>"><span id="elh_user_dtls_username"><?php echo $user_dtls->username->caption() ?><?php echo ($user_dtls->username->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $user_dtls->username->cellAttributes() ?>>
<span id="el_user_dtls_username">
<input type="text" data-table="user_dtls" data-field="x_username" name="x_username" id="x_username" size="30" placeholder="<?php echo HtmlEncode($user_dtls->username->getPlaceHolder()) ?>" value="<?php echo $user_dtls->username->EditValue ?>"<?php echo $user_dtls->username->editAttributes() ?>>
</span>
<?php echo $user_dtls->username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($user_dtls->password->Visible) { // password ?>
<?php if ($user_dtls_add->IsMobileOrModal) { ?>
	<div id="r_password" class="form-group row">
		<label id="elh_user_dtls_password" for="x_password" class="<?php echo $user_dtls_add->LeftColumnClass ?>"><?php echo $user_dtls->password->caption() ?><?php echo ($user_dtls->password->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_dtls_add->RightColumnClass ?>"><div<?php echo $user_dtls->password->cellAttributes() ?>>
<span id="el_user_dtls_password">
<input type="password" data-field="x_password" name="x_password" id="x_password" size="30" placeholder="<?php echo HtmlEncode($user_dtls->password->getPlaceHolder()) ?>"<?php echo $user_dtls->password->editAttributes() ?>>
</span>
<?php echo $user_dtls->password->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_password">
		<td class="<?php echo $user_dtls_add->TableLeftColumnClass ?>"><span id="elh_user_dtls_password"><?php echo $user_dtls->password->caption() ?><?php echo ($user_dtls->password->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $user_dtls->password->cellAttributes() ?>>
<span id="el_user_dtls_password">
<input type="password" data-field="x_password" name="x_password" id="x_password" size="30" placeholder="<?php echo HtmlEncode($user_dtls->password->getPlaceHolder()) ?>"<?php echo $user_dtls->password->editAttributes() ?>>
</span>
<?php echo $user_dtls->password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($user_dtls->account_valid->Visible) { // account_valid ?>
<?php if ($user_dtls_add->IsMobileOrModal) { ?>
	<div id="r_account_valid" class="form-group row">
		<label id="elh_user_dtls_account_valid" class="<?php echo $user_dtls_add->LeftColumnClass ?>"><?php echo $user_dtls->account_valid->caption() ?><?php echo ($user_dtls->account_valid->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_dtls_add->RightColumnClass ?>"><div<?php echo $user_dtls->account_valid->cellAttributes() ?>>
<span id="el_user_dtls_account_valid">
<?php
$selwrk = (ConvertToBool($user_dtls->account_valid->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="user_dtls" data-field="x_account_valid" name="x_account_valid[]" id="x_account_valid[]" value="1"<?php echo $selwrk ?><?php echo $user_dtls->account_valid->editAttributes() ?>>
</span>
<?php echo $user_dtls->account_valid->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_account_valid">
		<td class="<?php echo $user_dtls_add->TableLeftColumnClass ?>"><span id="elh_user_dtls_account_valid"><?php echo $user_dtls->account_valid->caption() ?><?php echo ($user_dtls->account_valid->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $user_dtls->account_valid->cellAttributes() ?>>
<span id="el_user_dtls_account_valid">
<?php
$selwrk = (ConvertToBool($user_dtls->account_valid->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="user_dtls" data-field="x_account_valid" name="x_account_valid[]" id="x_account_valid[]" value="1"<?php echo $selwrk ?><?php echo $user_dtls->account_valid->editAttributes() ?>>
</span>
<?php echo $user_dtls->account_valid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($user_dtls->email_addreess->Visible) { // email_addreess ?>
<?php if ($user_dtls_add->IsMobileOrModal) { ?>
	<div id="r_email_addreess" class="form-group row">
		<label id="elh_user_dtls_email_addreess" for="x_email_addreess" class="<?php echo $user_dtls_add->LeftColumnClass ?>"><?php echo $user_dtls->email_addreess->caption() ?><?php echo ($user_dtls->email_addreess->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_dtls_add->RightColumnClass ?>"><div<?php echo $user_dtls->email_addreess->cellAttributes() ?>>
<span id="el_user_dtls_email_addreess">
<input type="text" data-table="user_dtls" data-field="x_email_addreess" name="x_email_addreess" id="x_email_addreess" size="30" placeholder="<?php echo HtmlEncode($user_dtls->email_addreess->getPlaceHolder()) ?>" value="<?php echo $user_dtls->email_addreess->EditValue ?>"<?php echo $user_dtls->email_addreess->editAttributes() ?>>
</span>
<?php echo $user_dtls->email_addreess->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_email_addreess">
		<td class="<?php echo $user_dtls_add->TableLeftColumnClass ?>"><span id="elh_user_dtls_email_addreess"><?php echo $user_dtls->email_addreess->caption() ?><?php echo ($user_dtls->email_addreess->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $user_dtls->email_addreess->cellAttributes() ?>>
<span id="el_user_dtls_email_addreess">
<input type="text" data-table="user_dtls" data-field="x_email_addreess" name="x_email_addreess" id="x_email_addreess" size="30" placeholder="<?php echo HtmlEncode($user_dtls->email_addreess->getPlaceHolder()) ?>" value="<?php echo $user_dtls->email_addreess->EditValue ?>"<?php echo $user_dtls->email_addreess->editAttributes() ?>>
</span>
<?php echo $user_dtls->email_addreess->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($user_dtls->UserLevel->Visible) { // UserLevel ?>
<?php if ($user_dtls_add->IsMobileOrModal) { ?>
	<div id="r_UserLevel" class="form-group row">
		<label id="elh_user_dtls_UserLevel" for="x_UserLevel" class="<?php echo $user_dtls_add->LeftColumnClass ?>"><?php echo $user_dtls->UserLevel->caption() ?><?php echo ($user_dtls->UserLevel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_dtls_add->RightColumnClass ?>"><div<?php echo $user_dtls->UserLevel->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_user_dtls_UserLevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user_dtls->UserLevel->EditValue) ?>">
</span>
<?php } else { ?>
<span id="el_user_dtls_UserLevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user_dtls" data-field="x_UserLevel" data-value-separator="<?php echo $user_dtls->UserLevel->displayValueSeparatorAttribute() ?>" id="x_UserLevel" name="x_UserLevel"<?php echo $user_dtls->UserLevel->editAttributes() ?>>
		<?php echo $user_dtls->UserLevel->selectOptionListHtml("x_UserLevel") ?>
	</select>
</div>
<?php echo $user_dtls->UserLevel->Lookup->getParamTag("p_x_UserLevel") ?>
</span>
<?php } ?>
<?php echo $user_dtls->UserLevel->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_UserLevel">
		<td class="<?php echo $user_dtls_add->TableLeftColumnClass ?>"><span id="elh_user_dtls_UserLevel"><?php echo $user_dtls->UserLevel->caption() ?><?php echo ($user_dtls->UserLevel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $user_dtls->UserLevel->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_user_dtls_UserLevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user_dtls->UserLevel->EditValue) ?>">
</span>
<?php } else { ?>
<span id="el_user_dtls_UserLevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user_dtls" data-field="x_UserLevel" data-value-separator="<?php echo $user_dtls->UserLevel->displayValueSeparatorAttribute() ?>" id="x_UserLevel" name="x_UserLevel"<?php echo $user_dtls->UserLevel->editAttributes() ?>>
		<?php echo $user_dtls->UserLevel->selectOptionListHtml("x_UserLevel") ?>
	</select>
</div>
<?php echo $user_dtls->UserLevel->Lookup->getParamTag("p_x_UserLevel") ?>
</span>
<?php } ?>
<?php echo $user_dtls->UserLevel->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($user_dtls->reports_to->Visible) { // reports_to ?>
<?php if ($user_dtls_add->IsMobileOrModal) { ?>
	<div id="r_reports_to" class="form-group row">
		<label id="elh_user_dtls_reports_to" class="<?php echo $user_dtls_add->LeftColumnClass ?>"><?php echo $user_dtls->reports_to->caption() ?><?php echo ($user_dtls->reports_to->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_dtls_add->RightColumnClass ?>"><div<?php echo $user_dtls->reports_to->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_user_dtls_reports_to">
<?php
$wrkonchange = "" . trim(@$user_dtls->reports_to->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$user_dtls->reports_to->EditAttrs["onchange"] = "";
?>
<span id="as_x_reports_to" class="text-nowrap" style="z-index: 8900">
	<input type="text" class="form-control" name="sv_x_reports_to" id="sv_x_reports_to" value="<?php echo RemoveHtml($user_dtls->reports_to->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($user_dtls->reports_to->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($user_dtls->reports_to->getPlaceHolder()) ?>"<?php echo $user_dtls->reports_to->editAttributes() ?>>
</span>
<input type="hidden" data-table="user_dtls" data-field="x_reports_to" data-value-separator="<?php echo $user_dtls->reports_to->displayValueSeparatorAttribute() ?>" name="x_reports_to" id="x_reports_to" value="<?php echo HtmlEncode($user_dtls->reports_to->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fuser_dtlsadd.createAutoSuggest({"id":"x_reports_to","forceSelect":true});
</script>
<?php echo $user_dtls->reports_to->Lookup->getParamTag("p_x_reports_to") ?>
</span>
<?php } else { ?>
<span id="el_user_dtls_reports_to">
<?php
$wrkonchange = "" . trim(@$user_dtls->reports_to->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$user_dtls->reports_to->EditAttrs["onchange"] = "";
?>
<span id="as_x_reports_to" class="text-nowrap" style="z-index: 8900">
	<input type="text" class="form-control" name="sv_x_reports_to" id="sv_x_reports_to" value="<?php echo RemoveHtml($user_dtls->reports_to->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($user_dtls->reports_to->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($user_dtls->reports_to->getPlaceHolder()) ?>"<?php echo $user_dtls->reports_to->editAttributes() ?>>
</span>
<input type="hidden" data-table="user_dtls" data-field="x_reports_to" data-value-separator="<?php echo $user_dtls->reports_to->displayValueSeparatorAttribute() ?>" name="x_reports_to" id="x_reports_to" value="<?php echo HtmlEncode($user_dtls->reports_to->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fuser_dtlsadd.createAutoSuggest({"id":"x_reports_to","forceSelect":true});
</script>
<?php echo $user_dtls->reports_to->Lookup->getParamTag("p_x_reports_to") ?>
</span>
<?php } ?>
<?php echo $user_dtls->reports_to->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_reports_to">
		<td class="<?php echo $user_dtls_add->TableLeftColumnClass ?>"><span id="elh_user_dtls_reports_to"><?php echo $user_dtls->reports_to->caption() ?><?php echo ($user_dtls->reports_to->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $user_dtls->reports_to->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_user_dtls_reports_to">
<?php
$wrkonchange = "" . trim(@$user_dtls->reports_to->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$user_dtls->reports_to->EditAttrs["onchange"] = "";
?>
<span id="as_x_reports_to" class="text-nowrap" style="z-index: 8900">
	<input type="text" class="form-control" name="sv_x_reports_to" id="sv_x_reports_to" value="<?php echo RemoveHtml($user_dtls->reports_to->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($user_dtls->reports_to->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($user_dtls->reports_to->getPlaceHolder()) ?>"<?php echo $user_dtls->reports_to->editAttributes() ?>>
</span>
<input type="hidden" data-table="user_dtls" data-field="x_reports_to" data-value-separator="<?php echo $user_dtls->reports_to->displayValueSeparatorAttribute() ?>" name="x_reports_to" id="x_reports_to" value="<?php echo HtmlEncode($user_dtls->reports_to->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fuser_dtlsadd.createAutoSuggest({"id":"x_reports_to","forceSelect":true});
</script>
<?php echo $user_dtls->reports_to->Lookup->getParamTag("p_x_reports_to") ?>
</span>
<?php } else { ?>
<span id="el_user_dtls_reports_to">
<?php
$wrkonchange = "" . trim(@$user_dtls->reports_to->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$user_dtls->reports_to->EditAttrs["onchange"] = "";
?>
<span id="as_x_reports_to" class="text-nowrap" style="z-index: 8900">
	<input type="text" class="form-control" name="sv_x_reports_to" id="sv_x_reports_to" value="<?php echo RemoveHtml($user_dtls->reports_to->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($user_dtls->reports_to->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($user_dtls->reports_to->getPlaceHolder()) ?>"<?php echo $user_dtls->reports_to->editAttributes() ?>>
</span>
<input type="hidden" data-table="user_dtls" data-field="x_reports_to" data-value-separator="<?php echo $user_dtls->reports_to->displayValueSeparatorAttribute() ?>" name="x_reports_to" id="x_reports_to" value="<?php echo HtmlEncode($user_dtls->reports_to->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fuser_dtlsadd.createAutoSuggest({"id":"x_reports_to","forceSelect":true});
</script>
<?php echo $user_dtls->reports_to->Lookup->getParamTag("p_x_reports_to") ?>
</span>
<?php } ?>
<?php echo $user_dtls->reports_to->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($user_dtls->name->Visible) { // name ?>
<?php if ($user_dtls_add->IsMobileOrModal) { ?>
	<div id="r_name" class="form-group row">
		<label id="elh_user_dtls_name" for="x_name" class="<?php echo $user_dtls_add->LeftColumnClass ?>"><?php echo $user_dtls->name->caption() ?><?php echo ($user_dtls->name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_dtls_add->RightColumnClass ?>"><div<?php echo $user_dtls->name->cellAttributes() ?>>
<span id="el_user_dtls_name">
<input type="text" data-table="user_dtls" data-field="x_name" name="x_name" id="x_name" size="30" placeholder="<?php echo HtmlEncode($user_dtls->name->getPlaceHolder()) ?>" value="<?php echo $user_dtls->name->EditValue ?>"<?php echo $user_dtls->name->editAttributes() ?>>
</span>
<?php echo $user_dtls->name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_name">
		<td class="<?php echo $user_dtls_add->TableLeftColumnClass ?>"><span id="elh_user_dtls_name"><?php echo $user_dtls->name->caption() ?><?php echo ($user_dtls->name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $user_dtls->name->cellAttributes() ?>>
<span id="el_user_dtls_name">
<input type="text" data-table="user_dtls" data-field="x_name" name="x_name" id="x_name" size="30" placeholder="<?php echo HtmlEncode($user_dtls->name->getPlaceHolder()) ?>" value="<?php echo $user_dtls->name->EditValue ?>"<?php echo $user_dtls->name->editAttributes() ?>>
</span>
<?php echo $user_dtls->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($user_dtls_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$user_dtls_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $user_dtls_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_dtls_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$user_dtls_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$user_dtls_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$user_dtls_add->terminate();
?>