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
$document_log_search = new document_log_search();

// Run the page
$document_log_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_log_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($document_log_search->IsModal) { ?>
var fdocument_logsearch = currentAdvancedSearchForm = new ew.Form("fdocument_logsearch", "search");
<?php } else { ?>
var fdocument_logsearch = currentForm = new ew.Form("fdocument_logsearch", "search");
<?php } ?>

// Form_CustomValidate event
fdocument_logsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_logsearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fdocument_logsearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $document_log_search->showPageHeader(); ?>
<?php
$document_log_search->showMessage();
?>
<form name="fdocument_logsearch" id="fdocument_logsearch" class="<?php echo $document_log_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_log_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_log_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_log">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$document_log_search->IsModal ?>">
<?php if (!$document_log_search->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($document_log_search->IsMobileOrModal) { ?>
<div class="ew-search-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_document_logsearch" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($document_log->firelink_doc_no->Visible) { // firelink_doc_no ?>
<?php if ($document_log_search->IsMobileOrModal) { ?>
	<div id="r_firelink_doc_no" class="form-group row">
		<label for="x_firelink_doc_no" class="<?php echo $document_log_search->LeftColumnClass ?>"><span id="elh_document_log_firelink_doc_no"><?php echo $document_log->firelink_doc_no->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_firelink_doc_no" id="z_firelink_doc_no" value="LIKE"></span>
		</label>
		<div class="<?php echo $document_log_search->RightColumnClass ?>"><div<?php echo $document_log->firelink_doc_no->cellAttributes() ?>>
			<span id="el_document_log_firelink_doc_no">
<input type="text" data-table="document_log" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_log->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_log->firelink_doc_no->EditValue ?>"<?php echo $document_log->firelink_doc_no->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_firelink_doc_no">
		<td class="<?php echo $document_log_search->TableLeftColumnClass ?>"><span id="elh_document_log_firelink_doc_no"><?php echo $document_log->firelink_doc_no->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_firelink_doc_no" id="z_firelink_doc_no" value="LIKE"></span></td>
		<td<?php echo $document_log->firelink_doc_no->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_document_log_firelink_doc_no">
<input type="text" data-table="document_log" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_log->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_log->firelink_doc_no->EditValue ?>"<?php echo $document_log->firelink_doc_no->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->client_doc_no->Visible) { // client_doc_no ?>
<?php if ($document_log_search->IsMobileOrModal) { ?>
	<div id="r_client_doc_no" class="form-group row">
		<label for="x_client_doc_no" class="<?php echo $document_log_search->LeftColumnClass ?>"><span id="elh_document_log_client_doc_no"><?php echo $document_log->client_doc_no->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_client_doc_no" id="z_client_doc_no" value="LIKE"></span>
		</label>
		<div class="<?php echo $document_log_search->RightColumnClass ?>"><div<?php echo $document_log->client_doc_no->cellAttributes() ?>>
			<span id="el_document_log_client_doc_no">
<input type="text" data-table="document_log" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_log->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_log->client_doc_no->EditValue ?>"<?php echo $document_log->client_doc_no->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_client_doc_no">
		<td class="<?php echo $document_log_search->TableLeftColumnClass ?>"><span id="elh_document_log_client_doc_no"><?php echo $document_log->client_doc_no->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_client_doc_no" id="z_client_doc_no" value="LIKE"></span></td>
		<td<?php echo $document_log->client_doc_no->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_document_log_client_doc_no">
<input type="text" data-table="document_log" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_log->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_log->client_doc_no->EditValue ?>"<?php echo $document_log->client_doc_no->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->order_number->Visible) { // order_number ?>
<?php if ($document_log_search->IsMobileOrModal) { ?>
	<div id="r_order_number" class="form-group row">
		<label for="x_order_number" class="<?php echo $document_log_search->LeftColumnClass ?>"><span id="elh_document_log_order_number"><?php echo $document_log->order_number->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_order_number" id="z_order_number" value="LIKE"></span>
		</label>
		<div class="<?php echo $document_log_search->RightColumnClass ?>"><div<?php echo $document_log->order_number->cellAttributes() ?>>
			<span id="el_document_log_order_number">
<input type="text" data-table="document_log" data-field="x_order_number" name="x_order_number" id="x_order_number" size="30" placeholder="<?php echo HtmlEncode($document_log->order_number->getPlaceHolder()) ?>" value="<?php echo $document_log->order_number->EditValue ?>"<?php echo $document_log->order_number->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_order_number">
		<td class="<?php echo $document_log_search->TableLeftColumnClass ?>"><span id="elh_document_log_order_number"><?php echo $document_log->order_number->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_order_number" id="z_order_number" value="LIKE"></span></td>
		<td<?php echo $document_log->order_number->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_document_log_order_number">
<input type="text" data-table="document_log" data-field="x_order_number" name="x_order_number" id="x_order_number" size="30" placeholder="<?php echo HtmlEncode($document_log->order_number->getPlaceHolder()) ?>" value="<?php echo $document_log->order_number->EditValue ?>"<?php echo $document_log->order_number->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->project_name->Visible) { // project_name ?>
<?php if ($document_log_search->IsMobileOrModal) { ?>
	<div id="r_project_name" class="form-group row">
		<label for="x_project_name" class="<?php echo $document_log_search->LeftColumnClass ?>"><span id="elh_document_log_project_name"><?php echo $document_log->project_name->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_project_name" id="z_project_name" value="LIKE"></span>
		</label>
		<div class="<?php echo $document_log_search->RightColumnClass ?>"><div<?php echo $document_log->project_name->cellAttributes() ?>>
			<span id="el_document_log_project_name">
<input type="text" data-table="document_log" data-field="x_project_name" name="x_project_name" id="x_project_name" size="30" placeholder="<?php echo HtmlEncode($document_log->project_name->getPlaceHolder()) ?>" value="<?php echo $document_log->project_name->EditValue ?>"<?php echo $document_log->project_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_name">
		<td class="<?php echo $document_log_search->TableLeftColumnClass ?>"><span id="elh_document_log_project_name"><?php echo $document_log->project_name->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_project_name" id="z_project_name" value="LIKE"></span></td>
		<td<?php echo $document_log->project_name->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_document_log_project_name">
<input type="text" data-table="document_log" data-field="x_project_name" name="x_project_name" id="x_project_name" size="30" placeholder="<?php echo HtmlEncode($document_log->project_name->getPlaceHolder()) ?>" value="<?php echo $document_log->project_name->EditValue ?>"<?php echo $document_log->project_name->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->document_tittle->Visible) { // document_tittle ?>
<?php if ($document_log_search->IsMobileOrModal) { ?>
	<div id="r_document_tittle" class="form-group row">
		<label for="x_document_tittle" class="<?php echo $document_log_search->LeftColumnClass ?>"><span id="elh_document_log_document_tittle"><?php echo $document_log->document_tittle->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_document_tittle" id="z_document_tittle" value="LIKE"></span>
		</label>
		<div class="<?php echo $document_log_search->RightColumnClass ?>"><div<?php echo $document_log->document_tittle->cellAttributes() ?>>
			<span id="el_document_log_document_tittle">
<input type="text" data-table="document_log" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_log->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_log->document_tittle->EditValue ?>"<?php echo $document_log->document_tittle->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_tittle">
		<td class="<?php echo $document_log_search->TableLeftColumnClass ?>"><span id="elh_document_log_document_tittle"><?php echo $document_log->document_tittle->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_document_tittle" id="z_document_tittle" value="LIKE"></span></td>
		<td<?php echo $document_log->document_tittle->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_document_log_document_tittle">
<input type="text" data-table="document_log" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_log->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_log->document_tittle->EditValue ?>"<?php echo $document_log->document_tittle->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->current_status->Visible) { // current_status ?>
<?php if ($document_log_search->IsMobileOrModal) { ?>
	<div id="r_current_status" class="form-group row">
		<label for="x_current_status" class="<?php echo $document_log_search->LeftColumnClass ?>"><span id="elh_document_log_current_status"><?php echo $document_log->current_status->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_current_status" id="z_current_status" value="LIKE"></span>
		</label>
		<div class="<?php echo $document_log_search->RightColumnClass ?>"><div<?php echo $document_log->current_status->cellAttributes() ?>>
			<span id="el_document_log_current_status">
<input type="text" data-table="document_log" data-field="x_current_status" name="x_current_status" id="x_current_status" size="30" placeholder="<?php echo HtmlEncode($document_log->current_status->getPlaceHolder()) ?>" value="<?php echo $document_log->current_status->EditValue ?>"<?php echo $document_log->current_status->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_current_status">
		<td class="<?php echo $document_log_search->TableLeftColumnClass ?>"><span id="elh_document_log_current_status"><?php echo $document_log->current_status->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_current_status" id="z_current_status" value="LIKE"></span></td>
		<td<?php echo $document_log->current_status->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_document_log_current_status">
<input type="text" data-table="document_log" data-field="x_current_status" name="x_current_status" id="x_current_status" size="30" placeholder="<?php echo HtmlEncode($document_log->current_status->getPlaceHolder()) ?>" value="<?php echo $document_log->current_status->EditValue ?>"<?php echo $document_log->current_status->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log_search->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$document_log_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $document_log_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$document_log_search->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$document_log_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$document_log_search->terminate();
?>