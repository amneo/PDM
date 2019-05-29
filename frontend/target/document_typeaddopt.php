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
$document_type_addopt = new document_type_addopt();

// Run the page
$document_type_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_type_addopt->Page_Render();
?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "addopt";
var fdocument_typeaddopt = currentForm = new ew.Form("fdocument_typeaddopt", "addopt");

// Validate form
fdocument_typeaddopt.validate = function() {
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
		<?php if ($document_type_addopt->document_type->Required) { ?>
			elm = this.getElements("x" + infix + "_document_type");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_type->document_type->caption(), $document_type->document_type->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_type_addopt->document_category->Required) { ?>
			elm = this.getElements("x" + infix + "_document_category");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_type->document_category->caption(), $document_type->document_category->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fdocument_typeaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_typeaddopt.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $document_type_addopt->showPageHeader(); ?>
<?php
$document_type_addopt->showMessage();
?>
<form name="fdocument_typeaddopt" id="fdocument_typeaddopt" class="ew-form ew-horizontal" action="<?php echo API_URL ?>" method="post">
<?php //if ($document_type_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_type_addopt->Token ?>">
<?php //} ?>
<input type="hidden" name="<?php echo API_ACTION_NAME ?>" id="<?php echo API_ACTION_NAME ?>" value="<?php echo API_ADD_ACTION ?>">
<input type="hidden" name="<?php echo API_OBJECT_NAME ?>" id="<?php echo API_OBJECT_NAME ?>" value="<?php echo $document_type_addopt->TableVar ?>">
<?php if ($document_type->document_type->Visible) { // document_type ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_document_type"><?php echo $document_type->document_type->caption() ?><?php echo ($document_type->document_type->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="document_type" data-field="x_document_type" name="x_document_type" id="x_document_type" size="30" placeholder="<?php echo HtmlEncode($document_type->document_type->getPlaceHolder()) ?>" value="<?php echo $document_type->document_type->EditValue ?>"<?php echo $document_type->document_type->editAttributes() ?>>
<?php echo $document_type->document_type->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($document_type->document_category->Visible) { // document_category ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_document_category"><?php echo $document_type->document_category->caption() ?><?php echo ($document_type->document_category->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="document_type" data-field="x_document_category" name="x_document_category" id="x_document_category" size="30" placeholder="<?php echo HtmlEncode($document_type->document_category->getPlaceHolder()) ?>" value="<?php echo $document_type->document_category->EditValue ?>"<?php echo $document_type->document_category->editAttributes() ?>>
<?php echo $document_type->document_category->CustomMsg ?></div>
	</div>
<?php } ?>
</form>
<?php
$document_type_addopt->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$document_type_addopt->terminate();
?>