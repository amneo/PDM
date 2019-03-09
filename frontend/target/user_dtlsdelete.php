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
$user_dtls_delete = new user_dtls_delete();

// Run the page
$user_dtls_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_dtls_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fuser_dtlsdelete = currentForm = new ew.Form("fuser_dtlsdelete", "delete");

// Form_CustomValidate event
fuser_dtlsdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuser_dtlsdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fuser_dtlsdelete.lists["x_account_valid[]"] = <?php echo $user_dtls_delete->account_valid->Lookup->toClientList() ?>;
fuser_dtlsdelete.lists["x_account_valid[]"].options = <?php echo JsonEncode($user_dtls_delete->account_valid->options(FALSE, TRUE)) ?>;
fuser_dtlsdelete.lists["x_UserLevel"] = <?php echo $user_dtls_delete->UserLevel->Lookup->toClientList() ?>;
fuser_dtlsdelete.lists["x_UserLevel"].options = <?php echo JsonEncode($user_dtls_delete->UserLevel->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $user_dtls_delete->showPageHeader(); ?>
<?php
$user_dtls_delete->showMessage();
?>
<form name="fuser_dtlsdelete" id="fuser_dtlsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($user_dtls_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $user_dtls_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user_dtls">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($user_dtls_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($user_dtls->user_id->Visible) { // user_id ?>
		<th class="<?php echo $user_dtls->user_id->headerCellClass() ?>"><span id="elh_user_dtls_user_id" class="user_dtls_user_id"><?php echo $user_dtls->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($user_dtls->username->Visible) { // username ?>
		<th class="<?php echo $user_dtls->username->headerCellClass() ?>"><span id="elh_user_dtls_username" class="user_dtls_username"><?php echo $user_dtls->username->caption() ?></span></th>
<?php } ?>
<?php if ($user_dtls->create_login->Visible) { // create_login ?>
		<th class="<?php echo $user_dtls->create_login->headerCellClass() ?>"><span id="elh_user_dtls_create_login" class="user_dtls_create_login"><?php echo $user_dtls->create_login->caption() ?></span></th>
<?php } ?>
<?php if ($user_dtls->account_valid->Visible) { // account_valid ?>
		<th class="<?php echo $user_dtls->account_valid->headerCellClass() ?>"><span id="elh_user_dtls_account_valid" class="user_dtls_account_valid"><?php echo $user_dtls->account_valid->caption() ?></span></th>
<?php } ?>
<?php if ($user_dtls->last_login->Visible) { // last_login ?>
		<th class="<?php echo $user_dtls->last_login->headerCellClass() ?>"><span id="elh_user_dtls_last_login" class="user_dtls_last_login"><?php echo $user_dtls->last_login->caption() ?></span></th>
<?php } ?>
<?php if ($user_dtls->email_addreess->Visible) { // email_addreess ?>
		<th class="<?php echo $user_dtls->email_addreess->headerCellClass() ?>"><span id="elh_user_dtls_email_addreess" class="user_dtls_email_addreess"><?php echo $user_dtls->email_addreess->caption() ?></span></th>
<?php } ?>
<?php if ($user_dtls->UserLevel->Visible) { // UserLevel ?>
		<th class="<?php echo $user_dtls->UserLevel->headerCellClass() ?>"><span id="elh_user_dtls_UserLevel" class="user_dtls_UserLevel"><?php echo $user_dtls->UserLevel->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$user_dtls_delete->RecCnt = 0;
$i = 0;
while (!$user_dtls_delete->Recordset->EOF) {
	$user_dtls_delete->RecCnt++;
	$user_dtls_delete->RowCnt++;

	// Set row properties
	$user_dtls->resetAttributes();
	$user_dtls->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$user_dtls_delete->loadRowValues($user_dtls_delete->Recordset);

	// Render row
	$user_dtls_delete->renderRow();
?>
	<tr<?php echo $user_dtls->rowAttributes() ?>>
<?php if ($user_dtls->user_id->Visible) { // user_id ?>
		<td<?php echo $user_dtls->user_id->cellAttributes() ?>>
<span id="el<?php echo $user_dtls_delete->RowCnt ?>_user_dtls_user_id" class="user_dtls_user_id">
<span<?php echo $user_dtls->user_id->viewAttributes() ?>>
<?php echo $user_dtls->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_dtls->username->Visible) { // username ?>
		<td<?php echo $user_dtls->username->cellAttributes() ?>>
<span id="el<?php echo $user_dtls_delete->RowCnt ?>_user_dtls_username" class="user_dtls_username">
<span<?php echo $user_dtls->username->viewAttributes() ?>>
<?php echo $user_dtls->username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_dtls->create_login->Visible) { // create_login ?>
		<td<?php echo $user_dtls->create_login->cellAttributes() ?>>
<span id="el<?php echo $user_dtls_delete->RowCnt ?>_user_dtls_create_login" class="user_dtls_create_login">
<span<?php echo $user_dtls->create_login->viewAttributes() ?>>
<?php echo $user_dtls->create_login->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_dtls->account_valid->Visible) { // account_valid ?>
		<td<?php echo $user_dtls->account_valid->cellAttributes() ?>>
<span id="el<?php echo $user_dtls_delete->RowCnt ?>_user_dtls_account_valid" class="user_dtls_account_valid">
<span<?php echo $user_dtls->account_valid->viewAttributes() ?>>
<?php if (ConvertToBool($user_dtls->account_valid->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $user_dtls->account_valid->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $user_dtls->account_valid->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($user_dtls->last_login->Visible) { // last_login ?>
		<td<?php echo $user_dtls->last_login->cellAttributes() ?>>
<span id="el<?php echo $user_dtls_delete->RowCnt ?>_user_dtls_last_login" class="user_dtls_last_login">
<span<?php echo $user_dtls->last_login->viewAttributes() ?>>
<?php echo $user_dtls->last_login->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_dtls->email_addreess->Visible) { // email_addreess ?>
		<td<?php echo $user_dtls->email_addreess->cellAttributes() ?>>
<span id="el<?php echo $user_dtls_delete->RowCnt ?>_user_dtls_email_addreess" class="user_dtls_email_addreess">
<span<?php echo $user_dtls->email_addreess->viewAttributes() ?>>
<?php echo $user_dtls->email_addreess->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_dtls->UserLevel->Visible) { // UserLevel ?>
		<td<?php echo $user_dtls->UserLevel->cellAttributes() ?>>
<span id="el<?php echo $user_dtls_delete->RowCnt ?>_user_dtls_UserLevel" class="user_dtls_UserLevel">
<span<?php echo $user_dtls->UserLevel->viewAttributes() ?>>
<?php echo $user_dtls->UserLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$user_dtls_delete->Recordset->moveNext();
}
$user_dtls_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_dtls_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$user_dtls_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$user_dtls_delete->terminate();
?>