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
$register = new register();

// Run the page
$register->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$register->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "register";
var fregister = currentForm = new ew.Form("fregister", "register");

// Validate form
fregister.validate = function() {
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
		<?php if ($register->user_id->Required) { ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_dtls->user_id->caption(), $user_dtls->user_id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($register->username->Required) { ?>
			elm = this.getElements("x" + infix + "_username");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, ew.language.phrase("EnterUserName"));
		<?php } ?>
		<?php if ($register->password->Required) { ?>
			elm = this.getElements("x" + infix + "_password");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, ew.language.phrase("EnterPassword"));
		<?php } ?>
			if (fobj.c_password.value != fobj.x_password.value)
				return this.onError(fobj.c_password, ew.language.phrase("MismatchPassword"));
		<?php if ($register->email_addreess->Required) { ?>
			elm = this.getElements("x" + infix + "_email_addreess");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_dtls->email_addreess->caption(), $user_dtls->email_addreess->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_email_addreess");
			if (elm && !ew.checkEmail(elm.value))
				return this.onError(elm, "<?php echo JsEncode($user_dtls->email_addreess->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fregister.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fregister.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $register->showPageHeader(); ?>
<?php
$register->showMessage();
?>
<form name="fregister" id="fregister" class="<?php echo $register->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($register->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $register->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user_dtls">
<input type="hidden" name="action" id="action" value="insert">
<!-- Fields to prevent google autofill -->
<input type="hidden" type="text" name="<?php echo Encrypt(Random()) ?>">
<input type="hidden" type="password" name="<?php echo Encrypt(Random()) ?>">
<?php if ($user_dtls->isConfirm()) { // Confirm page ?>
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } ?>
<?php if (!IsMobile()) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if (IsMobile()) { ?>
<div class="ew-register-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_register" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($user_dtls->username->Visible) { // username ?>
<?php if (IsMobile()) { ?>
	<div id="r_username" class="form-group row">
		<label id="elh_user_dtls_username" for="x_username" class="<?php echo $register->LeftColumnClass ?>"><?php echo $user_dtls->username->caption() ?><?php echo ($user_dtls->username->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $user_dtls->username->cellAttributes() ?>>
<?php if (!$user_dtls->isConfirm()) { ?>
<span id="el_user_dtls_username">
<input type="text" data-table="user_dtls" data-field="x_username" name="x_username" id="x_username" size="30" placeholder="<?php echo HtmlEncode($user_dtls->username->getPlaceHolder()) ?>" value="<?php echo $user_dtls->username->EditValue ?>"<?php echo $user_dtls->username->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_user_dtls_username">
<span<?php echo $user_dtls->username->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user_dtls->username->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user_dtls" data-field="x_username" name="x_username" id="x_username" value="<?php echo HtmlEncode($user_dtls->username->FormValue) ?>">
<?php } ?>
<?php echo $user_dtls->username->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_username">
		<td class="<?php echo $register->TableLeftColumnClass ?>"><span id="elh_user_dtls_username"><?php echo $user_dtls->username->caption() ?><?php echo ($user_dtls->username->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $user_dtls->username->cellAttributes() ?>>
<?php if (!$user_dtls->isConfirm()) { ?>
<span id="el_user_dtls_username">
<input type="text" data-table="user_dtls" data-field="x_username" name="x_username" id="x_username" size="30" placeholder="<?php echo HtmlEncode($user_dtls->username->getPlaceHolder()) ?>" value="<?php echo $user_dtls->username->EditValue ?>"<?php echo $user_dtls->username->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_user_dtls_username">
<span<?php echo $user_dtls->username->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user_dtls->username->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user_dtls" data-field="x_username" name="x_username" id="x_username" value="<?php echo HtmlEncode($user_dtls->username->FormValue) ?>">
<?php } ?>
<?php echo $user_dtls->username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($user_dtls->password->Visible) { // password ?>
<?php if (IsMobile()) { ?>
	<div id="r_password" class="form-group row">
		<label id="elh_user_dtls_password" for="x_password" class="<?php echo $register->LeftColumnClass ?>"><?php echo $user_dtls->password->caption() ?><?php echo ($user_dtls->password->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $user_dtls->password->cellAttributes() ?>>
<?php if (!$user_dtls->isConfirm()) { ?>
<span id="el_user_dtls_password">
<input type="password" data-field="x_password" name="x_password" id="x_password" size="30" placeholder="<?php echo HtmlEncode($user_dtls->password->getPlaceHolder()) ?>"<?php echo $user_dtls->password->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_user_dtls_password">
<span<?php echo $user_dtls->password->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user_dtls->password->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user_dtls" data-field="x_password" name="x_password" id="x_password" value="<?php echo HtmlEncode($user_dtls->password->FormValue) ?>">
<?php } ?>
<?php echo $user_dtls->password->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_password">
		<td class="<?php echo $register->TableLeftColumnClass ?>"><span id="elh_user_dtls_password"><?php echo $user_dtls->password->caption() ?><?php echo ($user_dtls->password->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $user_dtls->password->cellAttributes() ?>>
<?php if (!$user_dtls->isConfirm()) { ?>
<span id="el_user_dtls_password">
<input type="password" data-field="x_password" name="x_password" id="x_password" size="30" placeholder="<?php echo HtmlEncode($user_dtls->password->getPlaceHolder()) ?>"<?php echo $user_dtls->password->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_user_dtls_password">
<span<?php echo $user_dtls->password->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user_dtls->password->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user_dtls" data-field="x_password" name="x_password" id="x_password" value="<?php echo HtmlEncode($user_dtls->password->FormValue) ?>">
<?php } ?>
<?php echo $user_dtls->password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($user_dtls->password->Visible) { // password ?>
<?php if (IsMobile()) { ?>
	<div id="r_c_password" class="form-group row">
		<label id="elh_c_user_dtls_password" for="c_password" class="<?php echo $register->LeftColumnClass ?>"><?php echo $Language->phrase("Confirm") ?> <?php echo $user_dtls->password->caption() ?><?php echo ($user_dtls->password->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $user_dtls->password->cellAttributes() ?>>
<?php if (!$user_dtls->isConfirm()) { ?>
<span id="el_c_user_dtls_password">
<input type="password" data-field="c_password" name="c_password" id="c_password" size="30" placeholder="<?php echo HtmlEncode($user_dtls->password->getPlaceHolder()) ?>"<?php echo $user_dtls->password->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_c_user_dtls_password">
<span<?php echo $user_dtls->password->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user_dtls->password->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user_dtls" data-field="c_password" name="c_password" id="c_password" value="<?php echo HtmlEncode($user_dtls->password->FormValue) ?>">
<?php } ?>
</div></div>
	</div>
<?php } else { ?>
	<tr id="r_c_password">
		<td class="<?php echo $register->TableLeftColumnClass ?>"><span id="elh_c_user_dtls_password" class="ew-confirm-password"><?php echo $Language->phrase("Confirm") ?> <?php echo $user_dtls->password->caption() ?><?php echo ($user_dtls->password->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $user_dtls->password->cellAttributes() ?>>
<?php if (!$user_dtls->isConfirm()) { ?>
<span id="el_c_user_dtls_password">
<input type="password" data-field="c_password" name="c_password" id="c_password" size="30" placeholder="<?php echo HtmlEncode($user_dtls->password->getPlaceHolder()) ?>"<?php echo $user_dtls->password->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_c_user_dtls_password">
<span<?php echo $user_dtls->password->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user_dtls->password->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user_dtls" data-field="c_password" name="c_password" id="c_password" value="<?php echo HtmlEncode($user_dtls->password->FormValue) ?>">
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($user_dtls->email_addreess->Visible) { // email_addreess ?>
<?php if (IsMobile()) { ?>
	<div id="r_email_addreess" class="form-group row">
		<label id="elh_user_dtls_email_addreess" for="x_email_addreess" class="<?php echo $register->LeftColumnClass ?>"><?php echo $user_dtls->email_addreess->caption() ?><?php echo ($user_dtls->email_addreess->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $user_dtls->email_addreess->cellAttributes() ?>>
<?php if (!$user_dtls->isConfirm()) { ?>
<span id="el_user_dtls_email_addreess">
<input type="text" data-table="user_dtls" data-field="x_email_addreess" name="x_email_addreess" id="x_email_addreess" size="30" placeholder="<?php echo HtmlEncode($user_dtls->email_addreess->getPlaceHolder()) ?>" value="<?php echo $user_dtls->email_addreess->EditValue ?>"<?php echo $user_dtls->email_addreess->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_user_dtls_email_addreess">
<span<?php echo $user_dtls->email_addreess->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user_dtls->email_addreess->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user_dtls" data-field="x_email_addreess" name="x_email_addreess" id="x_email_addreess" value="<?php echo HtmlEncode($user_dtls->email_addreess->FormValue) ?>">
<?php } ?>
<?php echo $user_dtls->email_addreess->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_email_addreess">
		<td class="<?php echo $register->TableLeftColumnClass ?>"><span id="elh_user_dtls_email_addreess"><?php echo $user_dtls->email_addreess->caption() ?><?php echo ($user_dtls->email_addreess->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $user_dtls->email_addreess->cellAttributes() ?>>
<?php if (!$user_dtls->isConfirm()) { ?>
<span id="el_user_dtls_email_addreess">
<input type="text" data-table="user_dtls" data-field="x_email_addreess" name="x_email_addreess" id="x_email_addreess" size="30" placeholder="<?php echo HtmlEncode($user_dtls->email_addreess->getPlaceHolder()) ?>" value="<?php echo $user_dtls->email_addreess->EditValue ?>"<?php echo $user_dtls->email_addreess->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_user_dtls_email_addreess">
<span<?php echo $user_dtls->email_addreess->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user_dtls->email_addreess->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user_dtls" data-field="x_email_addreess" name="x_email_addreess" id="x_email_addreess" value="<?php echo HtmlEncode($user_dtls->email_addreess->FormValue) ?>">
<?php } ?>
<?php echo $user_dtls->email_addreess->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if (IsMobile()) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $register->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$user_dtls->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("RegisterBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php if (!IsMobile()) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$register->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$register->terminate();
?>