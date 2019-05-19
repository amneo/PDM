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
$document_log_edit = new document_log_edit();

// Run the page
$document_log_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_log_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fdocument_logedit = currentForm = new ew.Form("fdocument_logedit", "edit");

// Validate form
fdocument_logedit.validate = function() {
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
		<?php if ($document_log_edit->firelink_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_firelink_doc_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->firelink_doc_no->caption(), $document_log->firelink_doc_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->client_doc_no->Required) { ?>
			elm = this.getElements("x" + infix + "_client_doc_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->client_doc_no->caption(), $document_log->client_doc_no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->order_number->Required) { ?>
			elm = this.getElements("x" + infix + "_order_number");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->order_number->caption(), $document_log->order_number->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->project_name->Required) { ?>
			elm = this.getElements("x" + infix + "_project_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->project_name->caption(), $document_log->project_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->document_tittle->Required) { ?>
			elm = this.getElements("x" + infix + "_document_tittle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->document_tittle->caption(), $document_log->document_tittle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->current_status->Required) { ?>
			elm = this.getElements("x" + infix + "_current_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->current_status->caption(), $document_log->current_status->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->submit_no_1->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_1->caption(), $document_log->submit_no_1->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_submit_no_1");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->submit_no_1->errorMessage()) ?>");
		<?php if ($document_log_edit->revision_no_1->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_1->caption(), $document_log->revision_no_1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->direction_1->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_1->caption(), $document_log->direction_1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->transmit_no_1->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_1->caption(), $document_log->transmit_no_1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->approval_status_1->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_1->caption(), $document_log->approval_status_1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->submit_no_2->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_2->caption(), $document_log->submit_no_2->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_submit_no_2");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->submit_no_2->errorMessage()) ?>");
		<?php if ($document_log_edit->revision_no_2->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_2->caption(), $document_log->revision_no_2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->direction_2->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_2->caption(), $document_log->direction_2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->planned_date_2->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_2->caption(), $document_log->planned_date_2->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_2");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_2->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_date_2->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_2->caption(), $document_log->transmit_date_2->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_2");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_2->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_no_2->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_2->caption(), $document_log->transmit_no_2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->approval_status_2->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_2->caption(), $document_log->approval_status_2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->submit_no_3->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_3->caption(), $document_log->submit_no_3->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_submit_no_3");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->submit_no_3->errorMessage()) ?>");
		<?php if ($document_log_edit->revision_no_3->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_3->caption(), $document_log->revision_no_3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->direction_3->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_3->caption(), $document_log->direction_3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->planned_date_3->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_3->caption(), $document_log->planned_date_3->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_3");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_3->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_date_3->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_3->caption(), $document_log->transmit_date_3->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_3");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_3->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_no_3->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_3->caption(), $document_log->transmit_no_3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->approval_status_3->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_3->caption(), $document_log->approval_status_3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->submit_no_4->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_4->caption(), $document_log->submit_no_4->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_submit_no_4");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->submit_no_4->errorMessage()) ?>");
		<?php if ($document_log_edit->revision_no_4->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_4->caption(), $document_log->revision_no_4->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->direction_4->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_4->caption(), $document_log->direction_4->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->planned_date_4->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_4->caption(), $document_log->planned_date_4->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_4");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_4->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_date_4->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_4->caption(), $document_log->transmit_date_4->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_4");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_4->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_no_4->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_4->caption(), $document_log->transmit_no_4->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->approval_status_4->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_4->caption(), $document_log->approval_status_4->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->submit_no_5->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_5->caption(), $document_log->submit_no_5->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_submit_no_5");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->submit_no_5->errorMessage()) ?>");
		<?php if ($document_log_edit->revision_no_5->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_5->caption(), $document_log->revision_no_5->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->direction_5->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_5->caption(), $document_log->direction_5->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->planned_date_5->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_5->caption(), $document_log->planned_date_5->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_5");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_5->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_date_5->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_5->caption(), $document_log->transmit_date_5->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_5");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_5->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_no_5->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_5->caption(), $document_log->transmit_no_5->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->approval_status_5->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_5->caption(), $document_log->approval_status_5->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->submit_no_6->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_6->caption(), $document_log->submit_no_6->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_submit_no_6");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->submit_no_6->errorMessage()) ?>");
		<?php if ($document_log_edit->revision_no_6->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_6->caption(), $document_log->revision_no_6->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->direction_6->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_6->caption(), $document_log->direction_6->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->planned_date_6->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_6->caption(), $document_log->planned_date_6->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_6");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_6->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_date_6->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_6->caption(), $document_log->transmit_date_6->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_6");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_6->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_no_6->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_6->caption(), $document_log->transmit_no_6->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->approval_status_6->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_6");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_6->caption(), $document_log->approval_status_6->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->submit_no_7->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_7->caption(), $document_log->submit_no_7->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_submit_no_7");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->submit_no_7->errorMessage()) ?>");
		<?php if ($document_log_edit->revision_no_7->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_7->caption(), $document_log->revision_no_7->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->direction_7->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_7->caption(), $document_log->direction_7->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->planned_date_7->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_7->caption(), $document_log->planned_date_7->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_7");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_7->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_date_7->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_7->caption(), $document_log->transmit_date_7->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_7");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_7->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_no_7->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_7->caption(), $document_log->transmit_no_7->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->approval_status_7->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_7");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_7->caption(), $document_log->approval_status_7->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->submit_no_8->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_8->caption(), $document_log->submit_no_8->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_submit_no_8");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->submit_no_8->errorMessage()) ?>");
		<?php if ($document_log_edit->revision_no_8->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_8->caption(), $document_log->revision_no_8->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->direction_8->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_8->caption(), $document_log->direction_8->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->planned_date_8->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_8->caption(), $document_log->planned_date_8->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_8");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_8->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_date_8->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_8->caption(), $document_log->transmit_date_8->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_8");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_8->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_no_8->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_8->caption(), $document_log->transmit_no_8->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->approval_status_8->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_8");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_8->caption(), $document_log->approval_status_8->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->submit_no_9->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_9->caption(), $document_log->submit_no_9->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_submit_no_9");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->submit_no_9->errorMessage()) ?>");
		<?php if ($document_log_edit->revision_no_9->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_9->caption(), $document_log->revision_no_9->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->direction_9->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_9->caption(), $document_log->direction_9->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->planned_date_9->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_9->caption(), $document_log->planned_date_9->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_9");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_9->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_date_9->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_9->caption(), $document_log->transmit_date_9->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_9");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_9->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_no_9->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_9->caption(), $document_log->transmit_no_9->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->approval_status_9->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_9");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_9->caption(), $document_log->approval_status_9->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->submit_no_10->Required) { ?>
			elm = this.getElements("x" + infix + "_submit_no_10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->submit_no_10->caption(), $document_log->submit_no_10->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_submit_no_10");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->submit_no_10->errorMessage()) ?>");
		<?php if ($document_log_edit->revision_no_10->Required) { ?>
			elm = this.getElements("x" + infix + "_revision_no_10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->revision_no_10->caption(), $document_log->revision_no_10->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->direction_10->Required) { ?>
			elm = this.getElements("x" + infix + "_direction_10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->direction_10->caption(), $document_log->direction_10->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->planned_date_10->Required) { ?>
			elm = this.getElements("x" + infix + "_planned_date_10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->planned_date_10->caption(), $document_log->planned_date_10->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_planned_date_10");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->planned_date_10->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_date_10->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_date_10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_date_10->caption(), $document_log->transmit_date_10->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_transmit_date_10");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->transmit_date_10->errorMessage()) ?>");
		<?php if ($document_log_edit->transmit_no_10->Required) { ?>
			elm = this.getElements("x" + infix + "_transmit_no_10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->transmit_no_10->caption(), $document_log->transmit_no_10->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->approval_status_10->Required) { ?>
			elm = this.getElements("x" + infix + "_approval_status_10");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->approval_status_10->caption(), $document_log->approval_status_10->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($document_log_edit->log_updatedon->Required) { ?>
			elm = this.getElements("x" + infix + "_log_updatedon");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_log->log_updatedon->caption(), $document_log->log_updatedon->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_log_updatedon");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($document_log->log_updatedon->errorMessage()) ?>");

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
fdocument_logedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdocument_logedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $document_log_edit->showPageHeader(); ?>
<?php
$document_log_edit->showMessage();
?>
<form name="fdocument_logedit" id="fdocument_logedit" class="<?php echo $document_log_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($document_log_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $document_log_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_log">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$document_log_edit->IsModal ?>">
<?php if (!$document_log_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_document_logedit" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($document_log->firelink_doc_no->Visible) { // firelink_doc_no ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_firelink_doc_no" class="form-group row">
		<label id="elh_document_log_firelink_doc_no" for="x_firelink_doc_no" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->firelink_doc_no->caption() ?><?php echo ($document_log->firelink_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->firelink_doc_no->cellAttributes() ?>>
<span id="el_document_log_firelink_doc_no">
<input type="text" data-table="document_log" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_log->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_log->firelink_doc_no->EditValue ?>"<?php echo $document_log->firelink_doc_no->editAttributes() ?>>
</span>
<?php echo $document_log->firelink_doc_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_firelink_doc_no">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_firelink_doc_no"><?php echo $document_log->firelink_doc_no->caption() ?><?php echo ($document_log->firelink_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->firelink_doc_no->cellAttributes() ?>>
<span id="el_document_log_firelink_doc_no">
<input type="text" data-table="document_log" data-field="x_firelink_doc_no" name="x_firelink_doc_no" id="x_firelink_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_log->firelink_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_log->firelink_doc_no->EditValue ?>"<?php echo $document_log->firelink_doc_no->editAttributes() ?>>
</span>
<?php echo $document_log->firelink_doc_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->client_doc_no->Visible) { // client_doc_no ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_client_doc_no" class="form-group row">
		<label id="elh_document_log_client_doc_no" for="x_client_doc_no" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->client_doc_no->caption() ?><?php echo ($document_log->client_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->client_doc_no->cellAttributes() ?>>
<span id="el_document_log_client_doc_no">
<input type="text" data-table="document_log" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_log->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_log->client_doc_no->EditValue ?>"<?php echo $document_log->client_doc_no->editAttributes() ?>>
</span>
<?php echo $document_log->client_doc_no->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_client_doc_no">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_client_doc_no"><?php echo $document_log->client_doc_no->caption() ?><?php echo ($document_log->client_doc_no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->client_doc_no->cellAttributes() ?>>
<span id="el_document_log_client_doc_no">
<input type="text" data-table="document_log" data-field="x_client_doc_no" name="x_client_doc_no" id="x_client_doc_no" size="30" placeholder="<?php echo HtmlEncode($document_log->client_doc_no->getPlaceHolder()) ?>" value="<?php echo $document_log->client_doc_no->EditValue ?>"<?php echo $document_log->client_doc_no->editAttributes() ?>>
</span>
<?php echo $document_log->client_doc_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->order_number->Visible) { // order_number ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_order_number" class="form-group row">
		<label id="elh_document_log_order_number" for="x_order_number" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->order_number->caption() ?><?php echo ($document_log->order_number->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->order_number->cellAttributes() ?>>
<span id="el_document_log_order_number">
<input type="text" data-table="document_log" data-field="x_order_number" name="x_order_number" id="x_order_number" size="30" placeholder="<?php echo HtmlEncode($document_log->order_number->getPlaceHolder()) ?>" value="<?php echo $document_log->order_number->EditValue ?>"<?php echo $document_log->order_number->editAttributes() ?>>
</span>
<?php echo $document_log->order_number->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_order_number">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_order_number"><?php echo $document_log->order_number->caption() ?><?php echo ($document_log->order_number->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->order_number->cellAttributes() ?>>
<span id="el_document_log_order_number">
<input type="text" data-table="document_log" data-field="x_order_number" name="x_order_number" id="x_order_number" size="30" placeholder="<?php echo HtmlEncode($document_log->order_number->getPlaceHolder()) ?>" value="<?php echo $document_log->order_number->EditValue ?>"<?php echo $document_log->order_number->editAttributes() ?>>
</span>
<?php echo $document_log->order_number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->project_name->Visible) { // project_name ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_project_name" class="form-group row">
		<label id="elh_document_log_project_name" for="x_project_name" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->project_name->caption() ?><?php echo ($document_log->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->project_name->cellAttributes() ?>>
<span id="el_document_log_project_name">
<input type="text" data-table="document_log" data-field="x_project_name" name="x_project_name" id="x_project_name" size="30" placeholder="<?php echo HtmlEncode($document_log->project_name->getPlaceHolder()) ?>" value="<?php echo $document_log->project_name->EditValue ?>"<?php echo $document_log->project_name->editAttributes() ?>>
</span>
<?php echo $document_log->project_name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_project_name">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_project_name"><?php echo $document_log->project_name->caption() ?><?php echo ($document_log->project_name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->project_name->cellAttributes() ?>>
<span id="el_document_log_project_name">
<input type="text" data-table="document_log" data-field="x_project_name" name="x_project_name" id="x_project_name" size="30" placeholder="<?php echo HtmlEncode($document_log->project_name->getPlaceHolder()) ?>" value="<?php echo $document_log->project_name->EditValue ?>"<?php echo $document_log->project_name->editAttributes() ?>>
</span>
<?php echo $document_log->project_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->document_tittle->Visible) { // document_tittle ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_document_tittle" class="form-group row">
		<label id="elh_document_log_document_tittle" for="x_document_tittle" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->document_tittle->caption() ?><?php echo ($document_log->document_tittle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->document_tittle->cellAttributes() ?>>
<span id="el_document_log_document_tittle">
<input type="text" data-table="document_log" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_log->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_log->document_tittle->EditValue ?>"<?php echo $document_log->document_tittle->editAttributes() ?>>
</span>
<?php echo $document_log->document_tittle->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_document_tittle">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_document_tittle"><?php echo $document_log->document_tittle->caption() ?><?php echo ($document_log->document_tittle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->document_tittle->cellAttributes() ?>>
<span id="el_document_log_document_tittle">
<input type="text" data-table="document_log" data-field="x_document_tittle" name="x_document_tittle" id="x_document_tittle" size="30" placeholder="<?php echo HtmlEncode($document_log->document_tittle->getPlaceHolder()) ?>" value="<?php echo $document_log->document_tittle->EditValue ?>"<?php echo $document_log->document_tittle->editAttributes() ?>>
</span>
<?php echo $document_log->document_tittle->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->current_status->Visible) { // current_status ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_current_status" class="form-group row">
		<label id="elh_document_log_current_status" for="x_current_status" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->current_status->caption() ?><?php echo ($document_log->current_status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->current_status->cellAttributes() ?>>
<span id="el_document_log_current_status">
<input type="text" data-table="document_log" data-field="x_current_status" name="x_current_status" id="x_current_status" size="30" placeholder="<?php echo HtmlEncode($document_log->current_status->getPlaceHolder()) ?>" value="<?php echo $document_log->current_status->EditValue ?>"<?php echo $document_log->current_status->editAttributes() ?>>
</span>
<?php echo $document_log->current_status->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_current_status">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_current_status"><?php echo $document_log->current_status->caption() ?><?php echo ($document_log->current_status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->current_status->cellAttributes() ?>>
<span id="el_document_log_current_status">
<input type="text" data-table="document_log" data-field="x_current_status" name="x_current_status" id="x_current_status" size="30" placeholder="<?php echo HtmlEncode($document_log->current_status->getPlaceHolder()) ?>" value="<?php echo $document_log->current_status->EditValue ?>"<?php echo $document_log->current_status->editAttributes() ?>>
</span>
<?php echo $document_log->current_status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_1->Visible) { // submit_no_1 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_submit_no_1" class="form-group row">
		<label id="elh_document_log_submit_no_1" for="x_submit_no_1" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->submit_no_1->caption() ?><?php echo ($document_log->submit_no_1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->submit_no_1->cellAttributes() ?>>
<span id="el_document_log_submit_no_1">
<input type="text" data-table="document_log" data-field="x_submit_no_1" name="x_submit_no_1" id="x_submit_no_1" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_1->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_1->EditValue ?>"<?php echo $document_log->submit_no_1->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_1">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_1"><?php echo $document_log->submit_no_1->caption() ?><?php echo ($document_log->submit_no_1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_1->cellAttributes() ?>>
<span id="el_document_log_submit_no_1">
<input type="text" data-table="document_log" data-field="x_submit_no_1" name="x_submit_no_1" id="x_submit_no_1" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_1->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_1->EditValue ?>"<?php echo $document_log->submit_no_1->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_1->Visible) { // revision_no_1 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_revision_no_1" class="form-group row">
		<label id="elh_document_log_revision_no_1" for="x_revision_no_1" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->revision_no_1->caption() ?><?php echo ($document_log->revision_no_1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->revision_no_1->cellAttributes() ?>>
<span id="el_document_log_revision_no_1">
<input type="text" data-table="document_log" data-field="x_revision_no_1" name="x_revision_no_1" id="x_revision_no_1" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_1->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_1->EditValue ?>"<?php echo $document_log->revision_no_1->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_1">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_1"><?php echo $document_log->revision_no_1->caption() ?><?php echo ($document_log->revision_no_1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_1->cellAttributes() ?>>
<span id="el_document_log_revision_no_1">
<input type="text" data-table="document_log" data-field="x_revision_no_1" name="x_revision_no_1" id="x_revision_no_1" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_1->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_1->EditValue ?>"<?php echo $document_log->revision_no_1->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_1->Visible) { // direction_1 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_direction_1" class="form-group row">
		<label id="elh_document_log_direction_1" for="x_direction_1" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->direction_1->caption() ?><?php echo ($document_log->direction_1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->direction_1->cellAttributes() ?>>
<span id="el_document_log_direction_1">
<input type="text" data-table="document_log" data-field="x_direction_1" name="x_direction_1" id="x_direction_1" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_1->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_1->EditValue ?>"<?php echo $document_log->direction_1->editAttributes() ?>>
</span>
<?php echo $document_log->direction_1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_1">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_direction_1"><?php echo $document_log->direction_1->caption() ?><?php echo ($document_log->direction_1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_1->cellAttributes() ?>>
<span id="el_document_log_direction_1">
<input type="text" data-table="document_log" data-field="x_direction_1" name="x_direction_1" id="x_direction_1" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_1->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_1->EditValue ?>"<?php echo $document_log->direction_1->editAttributes() ?>>
</span>
<?php echo $document_log->direction_1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_1->Visible) { // transmit_no_1 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_no_1" class="form-group row">
		<label id="elh_document_log_transmit_no_1" for="x_transmit_no_1" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_no_1->caption() ?><?php echo ($document_log->transmit_no_1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_1->cellAttributes() ?>>
<span id="el_document_log_transmit_no_1">
<input type="text" data-table="document_log" data-field="x_transmit_no_1" name="x_transmit_no_1" id="x_transmit_no_1" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_1->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_1->EditValue ?>"<?php echo $document_log->transmit_no_1->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_1">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_1"><?php echo $document_log->transmit_no_1->caption() ?><?php echo ($document_log->transmit_no_1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_1->cellAttributes() ?>>
<span id="el_document_log_transmit_no_1">
<input type="text" data-table="document_log" data-field="x_transmit_no_1" name="x_transmit_no_1" id="x_transmit_no_1" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_1->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_1->EditValue ?>"<?php echo $document_log->transmit_no_1->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_1->Visible) { // approval_status_1 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_approval_status_1" class="form-group row">
		<label id="elh_document_log_approval_status_1" for="x_approval_status_1" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->approval_status_1->caption() ?><?php echo ($document_log->approval_status_1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->approval_status_1->cellAttributes() ?>>
<span id="el_document_log_approval_status_1">
<input type="text" data-table="document_log" data-field="x_approval_status_1" name="x_approval_status_1" id="x_approval_status_1" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_1->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_1->EditValue ?>"<?php echo $document_log->approval_status_1->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_1->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_1">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_1"><?php echo $document_log->approval_status_1->caption() ?><?php echo ($document_log->approval_status_1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_1->cellAttributes() ?>>
<span id="el_document_log_approval_status_1">
<input type="text" data-table="document_log" data-field="x_approval_status_1" name="x_approval_status_1" id="x_approval_status_1" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_1->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_1->EditValue ?>"<?php echo $document_log->approval_status_1->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_2->Visible) { // submit_no_2 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_submit_no_2" class="form-group row">
		<label id="elh_document_log_submit_no_2" for="x_submit_no_2" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->submit_no_2->caption() ?><?php echo ($document_log->submit_no_2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->submit_no_2->cellAttributes() ?>>
<span id="el_document_log_submit_no_2">
<input type="text" data-table="document_log" data-field="x_submit_no_2" name="x_submit_no_2" id="x_submit_no_2" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_2->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_2->EditValue ?>"<?php echo $document_log->submit_no_2->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_2">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_2"><?php echo $document_log->submit_no_2->caption() ?><?php echo ($document_log->submit_no_2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_2->cellAttributes() ?>>
<span id="el_document_log_submit_no_2">
<input type="text" data-table="document_log" data-field="x_submit_no_2" name="x_submit_no_2" id="x_submit_no_2" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_2->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_2->EditValue ?>"<?php echo $document_log->submit_no_2->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_2->Visible) { // revision_no_2 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_revision_no_2" class="form-group row">
		<label id="elh_document_log_revision_no_2" for="x_revision_no_2" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->revision_no_2->caption() ?><?php echo ($document_log->revision_no_2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->revision_no_2->cellAttributes() ?>>
<span id="el_document_log_revision_no_2">
<input type="text" data-table="document_log" data-field="x_revision_no_2" name="x_revision_no_2" id="x_revision_no_2" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_2->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_2->EditValue ?>"<?php echo $document_log->revision_no_2->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_2">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_2"><?php echo $document_log->revision_no_2->caption() ?><?php echo ($document_log->revision_no_2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_2->cellAttributes() ?>>
<span id="el_document_log_revision_no_2">
<input type="text" data-table="document_log" data-field="x_revision_no_2" name="x_revision_no_2" id="x_revision_no_2" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_2->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_2->EditValue ?>"<?php echo $document_log->revision_no_2->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_2->Visible) { // direction_2 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_direction_2" class="form-group row">
		<label id="elh_document_log_direction_2" for="x_direction_2" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->direction_2->caption() ?><?php echo ($document_log->direction_2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->direction_2->cellAttributes() ?>>
<span id="el_document_log_direction_2">
<input type="text" data-table="document_log" data-field="x_direction_2" name="x_direction_2" id="x_direction_2" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_2->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_2->EditValue ?>"<?php echo $document_log->direction_2->editAttributes() ?>>
</span>
<?php echo $document_log->direction_2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_2">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_direction_2"><?php echo $document_log->direction_2->caption() ?><?php echo ($document_log->direction_2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_2->cellAttributes() ?>>
<span id="el_document_log_direction_2">
<input type="text" data-table="document_log" data-field="x_direction_2" name="x_direction_2" id="x_direction_2" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_2->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_2->EditValue ?>"<?php echo $document_log->direction_2->editAttributes() ?>>
</span>
<?php echo $document_log->direction_2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_2->Visible) { // planned_date_2 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_planned_date_2" class="form-group row">
		<label id="elh_document_log_planned_date_2" for="x_planned_date_2" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->planned_date_2->caption() ?><?php echo ($document_log->planned_date_2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->planned_date_2->cellAttributes() ?>>
<span id="el_document_log_planned_date_2">
<input type="text" data-table="document_log" data-field="x_planned_date_2" name="x_planned_date_2" id="x_planned_date_2" placeholder="<?php echo HtmlEncode($document_log->planned_date_2->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_2->EditValue ?>"<?php echo $document_log->planned_date_2->editAttributes() ?>>
<?php if (!$document_log->planned_date_2->ReadOnly && !$document_log->planned_date_2->Disabled && !isset($document_log->planned_date_2->EditAttrs["readonly"]) && !isset($document_log->planned_date_2->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_2", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_2">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_2"><?php echo $document_log->planned_date_2->caption() ?><?php echo ($document_log->planned_date_2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_2->cellAttributes() ?>>
<span id="el_document_log_planned_date_2">
<input type="text" data-table="document_log" data-field="x_planned_date_2" name="x_planned_date_2" id="x_planned_date_2" placeholder="<?php echo HtmlEncode($document_log->planned_date_2->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_2->EditValue ?>"<?php echo $document_log->planned_date_2->editAttributes() ?>>
<?php if (!$document_log->planned_date_2->ReadOnly && !$document_log->planned_date_2->Disabled && !isset($document_log->planned_date_2->EditAttrs["readonly"]) && !isset($document_log->planned_date_2->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_2", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_2->Visible) { // transmit_date_2 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_date_2" class="form-group row">
		<label id="elh_document_log_transmit_date_2" for="x_transmit_date_2" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_date_2->caption() ?><?php echo ($document_log->transmit_date_2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_2->cellAttributes() ?>>
<span id="el_document_log_transmit_date_2">
<input type="text" data-table="document_log" data-field="x_transmit_date_2" name="x_transmit_date_2" id="x_transmit_date_2" placeholder="<?php echo HtmlEncode($document_log->transmit_date_2->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_2->EditValue ?>"<?php echo $document_log->transmit_date_2->editAttributes() ?>>
<?php if (!$document_log->transmit_date_2->ReadOnly && !$document_log->transmit_date_2->Disabled && !isset($document_log->transmit_date_2->EditAttrs["readonly"]) && !isset($document_log->transmit_date_2->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_2", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_2">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_2"><?php echo $document_log->transmit_date_2->caption() ?><?php echo ($document_log->transmit_date_2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_2->cellAttributes() ?>>
<span id="el_document_log_transmit_date_2">
<input type="text" data-table="document_log" data-field="x_transmit_date_2" name="x_transmit_date_2" id="x_transmit_date_2" placeholder="<?php echo HtmlEncode($document_log->transmit_date_2->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_2->EditValue ?>"<?php echo $document_log->transmit_date_2->editAttributes() ?>>
<?php if (!$document_log->transmit_date_2->ReadOnly && !$document_log->transmit_date_2->Disabled && !isset($document_log->transmit_date_2->EditAttrs["readonly"]) && !isset($document_log->transmit_date_2->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_2", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_2->Visible) { // transmit_no_2 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_no_2" class="form-group row">
		<label id="elh_document_log_transmit_no_2" for="x_transmit_no_2" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_no_2->caption() ?><?php echo ($document_log->transmit_no_2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_2->cellAttributes() ?>>
<span id="el_document_log_transmit_no_2">
<input type="text" data-table="document_log" data-field="x_transmit_no_2" name="x_transmit_no_2" id="x_transmit_no_2" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_2->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_2->EditValue ?>"<?php echo $document_log->transmit_no_2->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_2">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_2"><?php echo $document_log->transmit_no_2->caption() ?><?php echo ($document_log->transmit_no_2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_2->cellAttributes() ?>>
<span id="el_document_log_transmit_no_2">
<input type="text" data-table="document_log" data-field="x_transmit_no_2" name="x_transmit_no_2" id="x_transmit_no_2" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_2->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_2->EditValue ?>"<?php echo $document_log->transmit_no_2->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_2->Visible) { // approval_status_2 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_approval_status_2" class="form-group row">
		<label id="elh_document_log_approval_status_2" for="x_approval_status_2" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->approval_status_2->caption() ?><?php echo ($document_log->approval_status_2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->approval_status_2->cellAttributes() ?>>
<span id="el_document_log_approval_status_2">
<input type="text" data-table="document_log" data-field="x_approval_status_2" name="x_approval_status_2" id="x_approval_status_2" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_2->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_2->EditValue ?>"<?php echo $document_log->approval_status_2->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_2">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_2"><?php echo $document_log->approval_status_2->caption() ?><?php echo ($document_log->approval_status_2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_2->cellAttributes() ?>>
<span id="el_document_log_approval_status_2">
<input type="text" data-table="document_log" data-field="x_approval_status_2" name="x_approval_status_2" id="x_approval_status_2" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_2->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_2->EditValue ?>"<?php echo $document_log->approval_status_2->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_3->Visible) { // submit_no_3 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_submit_no_3" class="form-group row">
		<label id="elh_document_log_submit_no_3" for="x_submit_no_3" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->submit_no_3->caption() ?><?php echo ($document_log->submit_no_3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->submit_no_3->cellAttributes() ?>>
<span id="el_document_log_submit_no_3">
<input type="text" data-table="document_log" data-field="x_submit_no_3" name="x_submit_no_3" id="x_submit_no_3" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_3->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_3->EditValue ?>"<?php echo $document_log->submit_no_3->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_3">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_3"><?php echo $document_log->submit_no_3->caption() ?><?php echo ($document_log->submit_no_3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_3->cellAttributes() ?>>
<span id="el_document_log_submit_no_3">
<input type="text" data-table="document_log" data-field="x_submit_no_3" name="x_submit_no_3" id="x_submit_no_3" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_3->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_3->EditValue ?>"<?php echo $document_log->submit_no_3->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_3->Visible) { // revision_no_3 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_revision_no_3" class="form-group row">
		<label id="elh_document_log_revision_no_3" for="x_revision_no_3" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->revision_no_3->caption() ?><?php echo ($document_log->revision_no_3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->revision_no_3->cellAttributes() ?>>
<span id="el_document_log_revision_no_3">
<input type="text" data-table="document_log" data-field="x_revision_no_3" name="x_revision_no_3" id="x_revision_no_3" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_3->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_3->EditValue ?>"<?php echo $document_log->revision_no_3->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_3">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_3"><?php echo $document_log->revision_no_3->caption() ?><?php echo ($document_log->revision_no_3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_3->cellAttributes() ?>>
<span id="el_document_log_revision_no_3">
<input type="text" data-table="document_log" data-field="x_revision_no_3" name="x_revision_no_3" id="x_revision_no_3" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_3->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_3->EditValue ?>"<?php echo $document_log->revision_no_3->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_3->Visible) { // direction_3 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_direction_3" class="form-group row">
		<label id="elh_document_log_direction_3" for="x_direction_3" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->direction_3->caption() ?><?php echo ($document_log->direction_3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->direction_3->cellAttributes() ?>>
<span id="el_document_log_direction_3">
<input type="text" data-table="document_log" data-field="x_direction_3" name="x_direction_3" id="x_direction_3" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_3->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_3->EditValue ?>"<?php echo $document_log->direction_3->editAttributes() ?>>
</span>
<?php echo $document_log->direction_3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_3">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_direction_3"><?php echo $document_log->direction_3->caption() ?><?php echo ($document_log->direction_3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_3->cellAttributes() ?>>
<span id="el_document_log_direction_3">
<input type="text" data-table="document_log" data-field="x_direction_3" name="x_direction_3" id="x_direction_3" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_3->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_3->EditValue ?>"<?php echo $document_log->direction_3->editAttributes() ?>>
</span>
<?php echo $document_log->direction_3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_3->Visible) { // planned_date_3 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_planned_date_3" class="form-group row">
		<label id="elh_document_log_planned_date_3" for="x_planned_date_3" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->planned_date_3->caption() ?><?php echo ($document_log->planned_date_3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->planned_date_3->cellAttributes() ?>>
<span id="el_document_log_planned_date_3">
<input type="text" data-table="document_log" data-field="x_planned_date_3" name="x_planned_date_3" id="x_planned_date_3" placeholder="<?php echo HtmlEncode($document_log->planned_date_3->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_3->EditValue ?>"<?php echo $document_log->planned_date_3->editAttributes() ?>>
<?php if (!$document_log->planned_date_3->ReadOnly && !$document_log->planned_date_3->Disabled && !isset($document_log->planned_date_3->EditAttrs["readonly"]) && !isset($document_log->planned_date_3->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_3", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_3">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_3"><?php echo $document_log->planned_date_3->caption() ?><?php echo ($document_log->planned_date_3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_3->cellAttributes() ?>>
<span id="el_document_log_planned_date_3">
<input type="text" data-table="document_log" data-field="x_planned_date_3" name="x_planned_date_3" id="x_planned_date_3" placeholder="<?php echo HtmlEncode($document_log->planned_date_3->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_3->EditValue ?>"<?php echo $document_log->planned_date_3->editAttributes() ?>>
<?php if (!$document_log->planned_date_3->ReadOnly && !$document_log->planned_date_3->Disabled && !isset($document_log->planned_date_3->EditAttrs["readonly"]) && !isset($document_log->planned_date_3->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_3", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_3->Visible) { // transmit_date_3 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_date_3" class="form-group row">
		<label id="elh_document_log_transmit_date_3" for="x_transmit_date_3" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_date_3->caption() ?><?php echo ($document_log->transmit_date_3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_3->cellAttributes() ?>>
<span id="el_document_log_transmit_date_3">
<input type="text" data-table="document_log" data-field="x_transmit_date_3" name="x_transmit_date_3" id="x_transmit_date_3" placeholder="<?php echo HtmlEncode($document_log->transmit_date_3->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_3->EditValue ?>"<?php echo $document_log->transmit_date_3->editAttributes() ?>>
<?php if (!$document_log->transmit_date_3->ReadOnly && !$document_log->transmit_date_3->Disabled && !isset($document_log->transmit_date_3->EditAttrs["readonly"]) && !isset($document_log->transmit_date_3->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_3", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_3">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_3"><?php echo $document_log->transmit_date_3->caption() ?><?php echo ($document_log->transmit_date_3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_3->cellAttributes() ?>>
<span id="el_document_log_transmit_date_3">
<input type="text" data-table="document_log" data-field="x_transmit_date_3" name="x_transmit_date_3" id="x_transmit_date_3" placeholder="<?php echo HtmlEncode($document_log->transmit_date_3->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_3->EditValue ?>"<?php echo $document_log->transmit_date_3->editAttributes() ?>>
<?php if (!$document_log->transmit_date_3->ReadOnly && !$document_log->transmit_date_3->Disabled && !isset($document_log->transmit_date_3->EditAttrs["readonly"]) && !isset($document_log->transmit_date_3->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_3", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_3->Visible) { // transmit_no_3 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_no_3" class="form-group row">
		<label id="elh_document_log_transmit_no_3" for="x_transmit_no_3" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_no_3->caption() ?><?php echo ($document_log->transmit_no_3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_3->cellAttributes() ?>>
<span id="el_document_log_transmit_no_3">
<input type="text" data-table="document_log" data-field="x_transmit_no_3" name="x_transmit_no_3" id="x_transmit_no_3" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_3->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_3->EditValue ?>"<?php echo $document_log->transmit_no_3->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_3">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_3"><?php echo $document_log->transmit_no_3->caption() ?><?php echo ($document_log->transmit_no_3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_3->cellAttributes() ?>>
<span id="el_document_log_transmit_no_3">
<input type="text" data-table="document_log" data-field="x_transmit_no_3" name="x_transmit_no_3" id="x_transmit_no_3" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_3->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_3->EditValue ?>"<?php echo $document_log->transmit_no_3->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_3->Visible) { // approval_status_3 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_approval_status_3" class="form-group row">
		<label id="elh_document_log_approval_status_3" for="x_approval_status_3" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->approval_status_3->caption() ?><?php echo ($document_log->approval_status_3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->approval_status_3->cellAttributes() ?>>
<span id="el_document_log_approval_status_3">
<input type="text" data-table="document_log" data-field="x_approval_status_3" name="x_approval_status_3" id="x_approval_status_3" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_3->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_3->EditValue ?>"<?php echo $document_log->approval_status_3->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_3->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_3">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_3"><?php echo $document_log->approval_status_3->caption() ?><?php echo ($document_log->approval_status_3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_3->cellAttributes() ?>>
<span id="el_document_log_approval_status_3">
<input type="text" data-table="document_log" data-field="x_approval_status_3" name="x_approval_status_3" id="x_approval_status_3" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_3->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_3->EditValue ?>"<?php echo $document_log->approval_status_3->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_4->Visible) { // submit_no_4 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_submit_no_4" class="form-group row">
		<label id="elh_document_log_submit_no_4" for="x_submit_no_4" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->submit_no_4->caption() ?><?php echo ($document_log->submit_no_4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->submit_no_4->cellAttributes() ?>>
<span id="el_document_log_submit_no_4">
<input type="text" data-table="document_log" data-field="x_submit_no_4" name="x_submit_no_4" id="x_submit_no_4" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_4->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_4->EditValue ?>"<?php echo $document_log->submit_no_4->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_4">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_4"><?php echo $document_log->submit_no_4->caption() ?><?php echo ($document_log->submit_no_4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_4->cellAttributes() ?>>
<span id="el_document_log_submit_no_4">
<input type="text" data-table="document_log" data-field="x_submit_no_4" name="x_submit_no_4" id="x_submit_no_4" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_4->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_4->EditValue ?>"<?php echo $document_log->submit_no_4->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_4->Visible) { // revision_no_4 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_revision_no_4" class="form-group row">
		<label id="elh_document_log_revision_no_4" for="x_revision_no_4" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->revision_no_4->caption() ?><?php echo ($document_log->revision_no_4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->revision_no_4->cellAttributes() ?>>
<span id="el_document_log_revision_no_4">
<input type="text" data-table="document_log" data-field="x_revision_no_4" name="x_revision_no_4" id="x_revision_no_4" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_4->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_4->EditValue ?>"<?php echo $document_log->revision_no_4->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_4">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_4"><?php echo $document_log->revision_no_4->caption() ?><?php echo ($document_log->revision_no_4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_4->cellAttributes() ?>>
<span id="el_document_log_revision_no_4">
<input type="text" data-table="document_log" data-field="x_revision_no_4" name="x_revision_no_4" id="x_revision_no_4" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_4->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_4->EditValue ?>"<?php echo $document_log->revision_no_4->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_4->Visible) { // direction_4 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_direction_4" class="form-group row">
		<label id="elh_document_log_direction_4" for="x_direction_4" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->direction_4->caption() ?><?php echo ($document_log->direction_4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->direction_4->cellAttributes() ?>>
<span id="el_document_log_direction_4">
<input type="text" data-table="document_log" data-field="x_direction_4" name="x_direction_4" id="x_direction_4" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_4->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_4->EditValue ?>"<?php echo $document_log->direction_4->editAttributes() ?>>
</span>
<?php echo $document_log->direction_4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_4">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_direction_4"><?php echo $document_log->direction_4->caption() ?><?php echo ($document_log->direction_4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_4->cellAttributes() ?>>
<span id="el_document_log_direction_4">
<input type="text" data-table="document_log" data-field="x_direction_4" name="x_direction_4" id="x_direction_4" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_4->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_4->EditValue ?>"<?php echo $document_log->direction_4->editAttributes() ?>>
</span>
<?php echo $document_log->direction_4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_4->Visible) { // planned_date_4 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_planned_date_4" class="form-group row">
		<label id="elh_document_log_planned_date_4" for="x_planned_date_4" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->planned_date_4->caption() ?><?php echo ($document_log->planned_date_4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->planned_date_4->cellAttributes() ?>>
<span id="el_document_log_planned_date_4">
<input type="text" data-table="document_log" data-field="x_planned_date_4" name="x_planned_date_4" id="x_planned_date_4" placeholder="<?php echo HtmlEncode($document_log->planned_date_4->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_4->EditValue ?>"<?php echo $document_log->planned_date_4->editAttributes() ?>>
<?php if (!$document_log->planned_date_4->ReadOnly && !$document_log->planned_date_4->Disabled && !isset($document_log->planned_date_4->EditAttrs["readonly"]) && !isset($document_log->planned_date_4->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_4", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_4">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_4"><?php echo $document_log->planned_date_4->caption() ?><?php echo ($document_log->planned_date_4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_4->cellAttributes() ?>>
<span id="el_document_log_planned_date_4">
<input type="text" data-table="document_log" data-field="x_planned_date_4" name="x_planned_date_4" id="x_planned_date_4" placeholder="<?php echo HtmlEncode($document_log->planned_date_4->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_4->EditValue ?>"<?php echo $document_log->planned_date_4->editAttributes() ?>>
<?php if (!$document_log->planned_date_4->ReadOnly && !$document_log->planned_date_4->Disabled && !isset($document_log->planned_date_4->EditAttrs["readonly"]) && !isset($document_log->planned_date_4->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_4", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_4->Visible) { // transmit_date_4 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_date_4" class="form-group row">
		<label id="elh_document_log_transmit_date_4" for="x_transmit_date_4" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_date_4->caption() ?><?php echo ($document_log->transmit_date_4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_4->cellAttributes() ?>>
<span id="el_document_log_transmit_date_4">
<input type="text" data-table="document_log" data-field="x_transmit_date_4" name="x_transmit_date_4" id="x_transmit_date_4" placeholder="<?php echo HtmlEncode($document_log->transmit_date_4->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_4->EditValue ?>"<?php echo $document_log->transmit_date_4->editAttributes() ?>>
<?php if (!$document_log->transmit_date_4->ReadOnly && !$document_log->transmit_date_4->Disabled && !isset($document_log->transmit_date_4->EditAttrs["readonly"]) && !isset($document_log->transmit_date_4->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_4", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_4">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_4"><?php echo $document_log->transmit_date_4->caption() ?><?php echo ($document_log->transmit_date_4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_4->cellAttributes() ?>>
<span id="el_document_log_transmit_date_4">
<input type="text" data-table="document_log" data-field="x_transmit_date_4" name="x_transmit_date_4" id="x_transmit_date_4" placeholder="<?php echo HtmlEncode($document_log->transmit_date_4->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_4->EditValue ?>"<?php echo $document_log->transmit_date_4->editAttributes() ?>>
<?php if (!$document_log->transmit_date_4->ReadOnly && !$document_log->transmit_date_4->Disabled && !isset($document_log->transmit_date_4->EditAttrs["readonly"]) && !isset($document_log->transmit_date_4->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_4", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_4->Visible) { // transmit_no_4 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_no_4" class="form-group row">
		<label id="elh_document_log_transmit_no_4" for="x_transmit_no_4" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_no_4->caption() ?><?php echo ($document_log->transmit_no_4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_4->cellAttributes() ?>>
<span id="el_document_log_transmit_no_4">
<input type="text" data-table="document_log" data-field="x_transmit_no_4" name="x_transmit_no_4" id="x_transmit_no_4" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_4->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_4->EditValue ?>"<?php echo $document_log->transmit_no_4->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_4">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_4"><?php echo $document_log->transmit_no_4->caption() ?><?php echo ($document_log->transmit_no_4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_4->cellAttributes() ?>>
<span id="el_document_log_transmit_no_4">
<input type="text" data-table="document_log" data-field="x_transmit_no_4" name="x_transmit_no_4" id="x_transmit_no_4" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_4->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_4->EditValue ?>"<?php echo $document_log->transmit_no_4->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_4->Visible) { // approval_status_4 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_approval_status_4" class="form-group row">
		<label id="elh_document_log_approval_status_4" for="x_approval_status_4" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->approval_status_4->caption() ?><?php echo ($document_log->approval_status_4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->approval_status_4->cellAttributes() ?>>
<span id="el_document_log_approval_status_4">
<input type="text" data-table="document_log" data-field="x_approval_status_4" name="x_approval_status_4" id="x_approval_status_4" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_4->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_4->EditValue ?>"<?php echo $document_log->approval_status_4->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_4->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_4">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_4"><?php echo $document_log->approval_status_4->caption() ?><?php echo ($document_log->approval_status_4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_4->cellAttributes() ?>>
<span id="el_document_log_approval_status_4">
<input type="text" data-table="document_log" data-field="x_approval_status_4" name="x_approval_status_4" id="x_approval_status_4" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_4->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_4->EditValue ?>"<?php echo $document_log->approval_status_4->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_4->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_5->Visible) { // submit_no_5 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_submit_no_5" class="form-group row">
		<label id="elh_document_log_submit_no_5" for="x_submit_no_5" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->submit_no_5->caption() ?><?php echo ($document_log->submit_no_5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->submit_no_5->cellAttributes() ?>>
<span id="el_document_log_submit_no_5">
<input type="text" data-table="document_log" data-field="x_submit_no_5" name="x_submit_no_5" id="x_submit_no_5" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_5->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_5->EditValue ?>"<?php echo $document_log->submit_no_5->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_5">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_5"><?php echo $document_log->submit_no_5->caption() ?><?php echo ($document_log->submit_no_5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_5->cellAttributes() ?>>
<span id="el_document_log_submit_no_5">
<input type="text" data-table="document_log" data-field="x_submit_no_5" name="x_submit_no_5" id="x_submit_no_5" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_5->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_5->EditValue ?>"<?php echo $document_log->submit_no_5->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_5->Visible) { // revision_no_5 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_revision_no_5" class="form-group row">
		<label id="elh_document_log_revision_no_5" for="x_revision_no_5" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->revision_no_5->caption() ?><?php echo ($document_log->revision_no_5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->revision_no_5->cellAttributes() ?>>
<span id="el_document_log_revision_no_5">
<input type="text" data-table="document_log" data-field="x_revision_no_5" name="x_revision_no_5" id="x_revision_no_5" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_5->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_5->EditValue ?>"<?php echo $document_log->revision_no_5->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_5">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_5"><?php echo $document_log->revision_no_5->caption() ?><?php echo ($document_log->revision_no_5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_5->cellAttributes() ?>>
<span id="el_document_log_revision_no_5">
<input type="text" data-table="document_log" data-field="x_revision_no_5" name="x_revision_no_5" id="x_revision_no_5" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_5->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_5->EditValue ?>"<?php echo $document_log->revision_no_5->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_5->Visible) { // direction_5 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_direction_5" class="form-group row">
		<label id="elh_document_log_direction_5" for="x_direction_5" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->direction_5->caption() ?><?php echo ($document_log->direction_5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->direction_5->cellAttributes() ?>>
<span id="el_document_log_direction_5">
<input type="text" data-table="document_log" data-field="x_direction_5" name="x_direction_5" id="x_direction_5" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_5->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_5->EditValue ?>"<?php echo $document_log->direction_5->editAttributes() ?>>
</span>
<?php echo $document_log->direction_5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_5">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_direction_5"><?php echo $document_log->direction_5->caption() ?><?php echo ($document_log->direction_5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_5->cellAttributes() ?>>
<span id="el_document_log_direction_5">
<input type="text" data-table="document_log" data-field="x_direction_5" name="x_direction_5" id="x_direction_5" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_5->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_5->EditValue ?>"<?php echo $document_log->direction_5->editAttributes() ?>>
</span>
<?php echo $document_log->direction_5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_5->Visible) { // planned_date_5 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_planned_date_5" class="form-group row">
		<label id="elh_document_log_planned_date_5" for="x_planned_date_5" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->planned_date_5->caption() ?><?php echo ($document_log->planned_date_5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->planned_date_5->cellAttributes() ?>>
<span id="el_document_log_planned_date_5">
<input type="text" data-table="document_log" data-field="x_planned_date_5" name="x_planned_date_5" id="x_planned_date_5" placeholder="<?php echo HtmlEncode($document_log->planned_date_5->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_5->EditValue ?>"<?php echo $document_log->planned_date_5->editAttributes() ?>>
<?php if (!$document_log->planned_date_5->ReadOnly && !$document_log->planned_date_5->Disabled && !isset($document_log->planned_date_5->EditAttrs["readonly"]) && !isset($document_log->planned_date_5->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_5", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_5">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_5"><?php echo $document_log->planned_date_5->caption() ?><?php echo ($document_log->planned_date_5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_5->cellAttributes() ?>>
<span id="el_document_log_planned_date_5">
<input type="text" data-table="document_log" data-field="x_planned_date_5" name="x_planned_date_5" id="x_planned_date_5" placeholder="<?php echo HtmlEncode($document_log->planned_date_5->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_5->EditValue ?>"<?php echo $document_log->planned_date_5->editAttributes() ?>>
<?php if (!$document_log->planned_date_5->ReadOnly && !$document_log->planned_date_5->Disabled && !isset($document_log->planned_date_5->EditAttrs["readonly"]) && !isset($document_log->planned_date_5->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_5", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_5->Visible) { // transmit_date_5 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_date_5" class="form-group row">
		<label id="elh_document_log_transmit_date_5" for="x_transmit_date_5" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_date_5->caption() ?><?php echo ($document_log->transmit_date_5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_5->cellAttributes() ?>>
<span id="el_document_log_transmit_date_5">
<input type="text" data-table="document_log" data-field="x_transmit_date_5" name="x_transmit_date_5" id="x_transmit_date_5" placeholder="<?php echo HtmlEncode($document_log->transmit_date_5->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_5->EditValue ?>"<?php echo $document_log->transmit_date_5->editAttributes() ?>>
<?php if (!$document_log->transmit_date_5->ReadOnly && !$document_log->transmit_date_5->Disabled && !isset($document_log->transmit_date_5->EditAttrs["readonly"]) && !isset($document_log->transmit_date_5->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_5", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_5">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_5"><?php echo $document_log->transmit_date_5->caption() ?><?php echo ($document_log->transmit_date_5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_5->cellAttributes() ?>>
<span id="el_document_log_transmit_date_5">
<input type="text" data-table="document_log" data-field="x_transmit_date_5" name="x_transmit_date_5" id="x_transmit_date_5" placeholder="<?php echo HtmlEncode($document_log->transmit_date_5->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_5->EditValue ?>"<?php echo $document_log->transmit_date_5->editAttributes() ?>>
<?php if (!$document_log->transmit_date_5->ReadOnly && !$document_log->transmit_date_5->Disabled && !isset($document_log->transmit_date_5->EditAttrs["readonly"]) && !isset($document_log->transmit_date_5->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_5", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_5->Visible) { // transmit_no_5 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_no_5" class="form-group row">
		<label id="elh_document_log_transmit_no_5" for="x_transmit_no_5" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_no_5->caption() ?><?php echo ($document_log->transmit_no_5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_5->cellAttributes() ?>>
<span id="el_document_log_transmit_no_5">
<input type="text" data-table="document_log" data-field="x_transmit_no_5" name="x_transmit_no_5" id="x_transmit_no_5" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_5->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_5->EditValue ?>"<?php echo $document_log->transmit_no_5->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_5">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_5"><?php echo $document_log->transmit_no_5->caption() ?><?php echo ($document_log->transmit_no_5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_5->cellAttributes() ?>>
<span id="el_document_log_transmit_no_5">
<input type="text" data-table="document_log" data-field="x_transmit_no_5" name="x_transmit_no_5" id="x_transmit_no_5" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_5->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_5->EditValue ?>"<?php echo $document_log->transmit_no_5->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_5->Visible) { // approval_status_5 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_approval_status_5" class="form-group row">
		<label id="elh_document_log_approval_status_5" for="x_approval_status_5" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->approval_status_5->caption() ?><?php echo ($document_log->approval_status_5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->approval_status_5->cellAttributes() ?>>
<span id="el_document_log_approval_status_5">
<input type="text" data-table="document_log" data-field="x_approval_status_5" name="x_approval_status_5" id="x_approval_status_5" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_5->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_5->EditValue ?>"<?php echo $document_log->approval_status_5->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_5->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_5">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_5"><?php echo $document_log->approval_status_5->caption() ?><?php echo ($document_log->approval_status_5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_5->cellAttributes() ?>>
<span id="el_document_log_approval_status_5">
<input type="text" data-table="document_log" data-field="x_approval_status_5" name="x_approval_status_5" id="x_approval_status_5" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_5->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_5->EditValue ?>"<?php echo $document_log->approval_status_5->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_5->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_6->Visible) { // submit_no_6 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_submit_no_6" class="form-group row">
		<label id="elh_document_log_submit_no_6" for="x_submit_no_6" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->submit_no_6->caption() ?><?php echo ($document_log->submit_no_6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->submit_no_6->cellAttributes() ?>>
<span id="el_document_log_submit_no_6">
<input type="text" data-table="document_log" data-field="x_submit_no_6" name="x_submit_no_6" id="x_submit_no_6" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_6->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_6->EditValue ?>"<?php echo $document_log->submit_no_6->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_6">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_6"><?php echo $document_log->submit_no_6->caption() ?><?php echo ($document_log->submit_no_6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_6->cellAttributes() ?>>
<span id="el_document_log_submit_no_6">
<input type="text" data-table="document_log" data-field="x_submit_no_6" name="x_submit_no_6" id="x_submit_no_6" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_6->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_6->EditValue ?>"<?php echo $document_log->submit_no_6->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_6->Visible) { // revision_no_6 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_revision_no_6" class="form-group row">
		<label id="elh_document_log_revision_no_6" for="x_revision_no_6" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->revision_no_6->caption() ?><?php echo ($document_log->revision_no_6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->revision_no_6->cellAttributes() ?>>
<span id="el_document_log_revision_no_6">
<input type="text" data-table="document_log" data-field="x_revision_no_6" name="x_revision_no_6" id="x_revision_no_6" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_6->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_6->EditValue ?>"<?php echo $document_log->revision_no_6->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_6">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_6"><?php echo $document_log->revision_no_6->caption() ?><?php echo ($document_log->revision_no_6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_6->cellAttributes() ?>>
<span id="el_document_log_revision_no_6">
<input type="text" data-table="document_log" data-field="x_revision_no_6" name="x_revision_no_6" id="x_revision_no_6" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_6->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_6->EditValue ?>"<?php echo $document_log->revision_no_6->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_6->Visible) { // direction_6 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_direction_6" class="form-group row">
		<label id="elh_document_log_direction_6" for="x_direction_6" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->direction_6->caption() ?><?php echo ($document_log->direction_6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->direction_6->cellAttributes() ?>>
<span id="el_document_log_direction_6">
<input type="text" data-table="document_log" data-field="x_direction_6" name="x_direction_6" id="x_direction_6" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_6->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_6->EditValue ?>"<?php echo $document_log->direction_6->editAttributes() ?>>
</span>
<?php echo $document_log->direction_6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_6">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_direction_6"><?php echo $document_log->direction_6->caption() ?><?php echo ($document_log->direction_6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_6->cellAttributes() ?>>
<span id="el_document_log_direction_6">
<input type="text" data-table="document_log" data-field="x_direction_6" name="x_direction_6" id="x_direction_6" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_6->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_6->EditValue ?>"<?php echo $document_log->direction_6->editAttributes() ?>>
</span>
<?php echo $document_log->direction_6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_6->Visible) { // planned_date_6 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_planned_date_6" class="form-group row">
		<label id="elh_document_log_planned_date_6" for="x_planned_date_6" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->planned_date_6->caption() ?><?php echo ($document_log->planned_date_6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->planned_date_6->cellAttributes() ?>>
<span id="el_document_log_planned_date_6">
<input type="text" data-table="document_log" data-field="x_planned_date_6" name="x_planned_date_6" id="x_planned_date_6" placeholder="<?php echo HtmlEncode($document_log->planned_date_6->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_6->EditValue ?>"<?php echo $document_log->planned_date_6->editAttributes() ?>>
<?php if (!$document_log->planned_date_6->ReadOnly && !$document_log->planned_date_6->Disabled && !isset($document_log->planned_date_6->EditAttrs["readonly"]) && !isset($document_log->planned_date_6->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_6", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_6">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_6"><?php echo $document_log->planned_date_6->caption() ?><?php echo ($document_log->planned_date_6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_6->cellAttributes() ?>>
<span id="el_document_log_planned_date_6">
<input type="text" data-table="document_log" data-field="x_planned_date_6" name="x_planned_date_6" id="x_planned_date_6" placeholder="<?php echo HtmlEncode($document_log->planned_date_6->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_6->EditValue ?>"<?php echo $document_log->planned_date_6->editAttributes() ?>>
<?php if (!$document_log->planned_date_6->ReadOnly && !$document_log->planned_date_6->Disabled && !isset($document_log->planned_date_6->EditAttrs["readonly"]) && !isset($document_log->planned_date_6->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_6", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_6->Visible) { // transmit_date_6 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_date_6" class="form-group row">
		<label id="elh_document_log_transmit_date_6" for="x_transmit_date_6" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_date_6->caption() ?><?php echo ($document_log->transmit_date_6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_6->cellAttributes() ?>>
<span id="el_document_log_transmit_date_6">
<input type="text" data-table="document_log" data-field="x_transmit_date_6" name="x_transmit_date_6" id="x_transmit_date_6" placeholder="<?php echo HtmlEncode($document_log->transmit_date_6->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_6->EditValue ?>"<?php echo $document_log->transmit_date_6->editAttributes() ?>>
<?php if (!$document_log->transmit_date_6->ReadOnly && !$document_log->transmit_date_6->Disabled && !isset($document_log->transmit_date_6->EditAttrs["readonly"]) && !isset($document_log->transmit_date_6->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_6", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_6">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_6"><?php echo $document_log->transmit_date_6->caption() ?><?php echo ($document_log->transmit_date_6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_6->cellAttributes() ?>>
<span id="el_document_log_transmit_date_6">
<input type="text" data-table="document_log" data-field="x_transmit_date_6" name="x_transmit_date_6" id="x_transmit_date_6" placeholder="<?php echo HtmlEncode($document_log->transmit_date_6->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_6->EditValue ?>"<?php echo $document_log->transmit_date_6->editAttributes() ?>>
<?php if (!$document_log->transmit_date_6->ReadOnly && !$document_log->transmit_date_6->Disabled && !isset($document_log->transmit_date_6->EditAttrs["readonly"]) && !isset($document_log->transmit_date_6->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_6", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_6->Visible) { // transmit_no_6 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_no_6" class="form-group row">
		<label id="elh_document_log_transmit_no_6" for="x_transmit_no_6" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_no_6->caption() ?><?php echo ($document_log->transmit_no_6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_6->cellAttributes() ?>>
<span id="el_document_log_transmit_no_6">
<input type="text" data-table="document_log" data-field="x_transmit_no_6" name="x_transmit_no_6" id="x_transmit_no_6" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_6->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_6->EditValue ?>"<?php echo $document_log->transmit_no_6->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_6">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_6"><?php echo $document_log->transmit_no_6->caption() ?><?php echo ($document_log->transmit_no_6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_6->cellAttributes() ?>>
<span id="el_document_log_transmit_no_6">
<input type="text" data-table="document_log" data-field="x_transmit_no_6" name="x_transmit_no_6" id="x_transmit_no_6" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_6->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_6->EditValue ?>"<?php echo $document_log->transmit_no_6->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_6->Visible) { // approval_status_6 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_approval_status_6" class="form-group row">
		<label id="elh_document_log_approval_status_6" for="x_approval_status_6" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->approval_status_6->caption() ?><?php echo ($document_log->approval_status_6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->approval_status_6->cellAttributes() ?>>
<span id="el_document_log_approval_status_6">
<input type="text" data-table="document_log" data-field="x_approval_status_6" name="x_approval_status_6" id="x_approval_status_6" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_6->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_6->EditValue ?>"<?php echo $document_log->approval_status_6->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_6->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_6">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_6"><?php echo $document_log->approval_status_6->caption() ?><?php echo ($document_log->approval_status_6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_6->cellAttributes() ?>>
<span id="el_document_log_approval_status_6">
<input type="text" data-table="document_log" data-field="x_approval_status_6" name="x_approval_status_6" id="x_approval_status_6" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_6->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_6->EditValue ?>"<?php echo $document_log->approval_status_6->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_6->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_7->Visible) { // submit_no_7 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_submit_no_7" class="form-group row">
		<label id="elh_document_log_submit_no_7" for="x_submit_no_7" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->submit_no_7->caption() ?><?php echo ($document_log->submit_no_7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->submit_no_7->cellAttributes() ?>>
<span id="el_document_log_submit_no_7">
<input type="text" data-table="document_log" data-field="x_submit_no_7" name="x_submit_no_7" id="x_submit_no_7" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_7->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_7->EditValue ?>"<?php echo $document_log->submit_no_7->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_7">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_7"><?php echo $document_log->submit_no_7->caption() ?><?php echo ($document_log->submit_no_7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_7->cellAttributes() ?>>
<span id="el_document_log_submit_no_7">
<input type="text" data-table="document_log" data-field="x_submit_no_7" name="x_submit_no_7" id="x_submit_no_7" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_7->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_7->EditValue ?>"<?php echo $document_log->submit_no_7->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_7->Visible) { // revision_no_7 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_revision_no_7" class="form-group row">
		<label id="elh_document_log_revision_no_7" for="x_revision_no_7" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->revision_no_7->caption() ?><?php echo ($document_log->revision_no_7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->revision_no_7->cellAttributes() ?>>
<span id="el_document_log_revision_no_7">
<input type="text" data-table="document_log" data-field="x_revision_no_7" name="x_revision_no_7" id="x_revision_no_7" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_7->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_7->EditValue ?>"<?php echo $document_log->revision_no_7->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_7">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_7"><?php echo $document_log->revision_no_7->caption() ?><?php echo ($document_log->revision_no_7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_7->cellAttributes() ?>>
<span id="el_document_log_revision_no_7">
<input type="text" data-table="document_log" data-field="x_revision_no_7" name="x_revision_no_7" id="x_revision_no_7" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_7->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_7->EditValue ?>"<?php echo $document_log->revision_no_7->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_7->Visible) { // direction_7 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_direction_7" class="form-group row">
		<label id="elh_document_log_direction_7" for="x_direction_7" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->direction_7->caption() ?><?php echo ($document_log->direction_7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->direction_7->cellAttributes() ?>>
<span id="el_document_log_direction_7">
<input type="text" data-table="document_log" data-field="x_direction_7" name="x_direction_7" id="x_direction_7" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_7->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_7->EditValue ?>"<?php echo $document_log->direction_7->editAttributes() ?>>
</span>
<?php echo $document_log->direction_7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_7">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_direction_7"><?php echo $document_log->direction_7->caption() ?><?php echo ($document_log->direction_7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_7->cellAttributes() ?>>
<span id="el_document_log_direction_7">
<input type="text" data-table="document_log" data-field="x_direction_7" name="x_direction_7" id="x_direction_7" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_7->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_7->EditValue ?>"<?php echo $document_log->direction_7->editAttributes() ?>>
</span>
<?php echo $document_log->direction_7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_7->Visible) { // planned_date_7 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_planned_date_7" class="form-group row">
		<label id="elh_document_log_planned_date_7" for="x_planned_date_7" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->planned_date_7->caption() ?><?php echo ($document_log->planned_date_7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->planned_date_7->cellAttributes() ?>>
<span id="el_document_log_planned_date_7">
<input type="text" data-table="document_log" data-field="x_planned_date_7" name="x_planned_date_7" id="x_planned_date_7" placeholder="<?php echo HtmlEncode($document_log->planned_date_7->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_7->EditValue ?>"<?php echo $document_log->planned_date_7->editAttributes() ?>>
<?php if (!$document_log->planned_date_7->ReadOnly && !$document_log->planned_date_7->Disabled && !isset($document_log->planned_date_7->EditAttrs["readonly"]) && !isset($document_log->planned_date_7->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_7", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_7">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_7"><?php echo $document_log->planned_date_7->caption() ?><?php echo ($document_log->planned_date_7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_7->cellAttributes() ?>>
<span id="el_document_log_planned_date_7">
<input type="text" data-table="document_log" data-field="x_planned_date_7" name="x_planned_date_7" id="x_planned_date_7" placeholder="<?php echo HtmlEncode($document_log->planned_date_7->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_7->EditValue ?>"<?php echo $document_log->planned_date_7->editAttributes() ?>>
<?php if (!$document_log->planned_date_7->ReadOnly && !$document_log->planned_date_7->Disabled && !isset($document_log->planned_date_7->EditAttrs["readonly"]) && !isset($document_log->planned_date_7->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_7", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_7->Visible) { // transmit_date_7 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_date_7" class="form-group row">
		<label id="elh_document_log_transmit_date_7" for="x_transmit_date_7" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_date_7->caption() ?><?php echo ($document_log->transmit_date_7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_7->cellAttributes() ?>>
<span id="el_document_log_transmit_date_7">
<input type="text" data-table="document_log" data-field="x_transmit_date_7" name="x_transmit_date_7" id="x_transmit_date_7" placeholder="<?php echo HtmlEncode($document_log->transmit_date_7->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_7->EditValue ?>"<?php echo $document_log->transmit_date_7->editAttributes() ?>>
<?php if (!$document_log->transmit_date_7->ReadOnly && !$document_log->transmit_date_7->Disabled && !isset($document_log->transmit_date_7->EditAttrs["readonly"]) && !isset($document_log->transmit_date_7->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_7", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_7">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_7"><?php echo $document_log->transmit_date_7->caption() ?><?php echo ($document_log->transmit_date_7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_7->cellAttributes() ?>>
<span id="el_document_log_transmit_date_7">
<input type="text" data-table="document_log" data-field="x_transmit_date_7" name="x_transmit_date_7" id="x_transmit_date_7" placeholder="<?php echo HtmlEncode($document_log->transmit_date_7->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_7->EditValue ?>"<?php echo $document_log->transmit_date_7->editAttributes() ?>>
<?php if (!$document_log->transmit_date_7->ReadOnly && !$document_log->transmit_date_7->Disabled && !isset($document_log->transmit_date_7->EditAttrs["readonly"]) && !isset($document_log->transmit_date_7->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_7", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_7->Visible) { // transmit_no_7 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_no_7" class="form-group row">
		<label id="elh_document_log_transmit_no_7" for="x_transmit_no_7" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_no_7->caption() ?><?php echo ($document_log->transmit_no_7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_7->cellAttributes() ?>>
<span id="el_document_log_transmit_no_7">
<input type="text" data-table="document_log" data-field="x_transmit_no_7" name="x_transmit_no_7" id="x_transmit_no_7" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_7->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_7->EditValue ?>"<?php echo $document_log->transmit_no_7->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_7">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_7"><?php echo $document_log->transmit_no_7->caption() ?><?php echo ($document_log->transmit_no_7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_7->cellAttributes() ?>>
<span id="el_document_log_transmit_no_7">
<input type="text" data-table="document_log" data-field="x_transmit_no_7" name="x_transmit_no_7" id="x_transmit_no_7" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_7->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_7->EditValue ?>"<?php echo $document_log->transmit_no_7->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_7->Visible) { // approval_status_7 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_approval_status_7" class="form-group row">
		<label id="elh_document_log_approval_status_7" for="x_approval_status_7" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->approval_status_7->caption() ?><?php echo ($document_log->approval_status_7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->approval_status_7->cellAttributes() ?>>
<span id="el_document_log_approval_status_7">
<input type="text" data-table="document_log" data-field="x_approval_status_7" name="x_approval_status_7" id="x_approval_status_7" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_7->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_7->EditValue ?>"<?php echo $document_log->approval_status_7->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_7->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_7">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_7"><?php echo $document_log->approval_status_7->caption() ?><?php echo ($document_log->approval_status_7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_7->cellAttributes() ?>>
<span id="el_document_log_approval_status_7">
<input type="text" data-table="document_log" data-field="x_approval_status_7" name="x_approval_status_7" id="x_approval_status_7" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_7->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_7->EditValue ?>"<?php echo $document_log->approval_status_7->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_7->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_8->Visible) { // submit_no_8 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_submit_no_8" class="form-group row">
		<label id="elh_document_log_submit_no_8" for="x_submit_no_8" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->submit_no_8->caption() ?><?php echo ($document_log->submit_no_8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->submit_no_8->cellAttributes() ?>>
<span id="el_document_log_submit_no_8">
<input type="text" data-table="document_log" data-field="x_submit_no_8" name="x_submit_no_8" id="x_submit_no_8" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_8->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_8->EditValue ?>"<?php echo $document_log->submit_no_8->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_8">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_8"><?php echo $document_log->submit_no_8->caption() ?><?php echo ($document_log->submit_no_8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_8->cellAttributes() ?>>
<span id="el_document_log_submit_no_8">
<input type="text" data-table="document_log" data-field="x_submit_no_8" name="x_submit_no_8" id="x_submit_no_8" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_8->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_8->EditValue ?>"<?php echo $document_log->submit_no_8->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_8->Visible) { // revision_no_8 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_revision_no_8" class="form-group row">
		<label id="elh_document_log_revision_no_8" for="x_revision_no_8" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->revision_no_8->caption() ?><?php echo ($document_log->revision_no_8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->revision_no_8->cellAttributes() ?>>
<span id="el_document_log_revision_no_8">
<input type="text" data-table="document_log" data-field="x_revision_no_8" name="x_revision_no_8" id="x_revision_no_8" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_8->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_8->EditValue ?>"<?php echo $document_log->revision_no_8->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_8">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_8"><?php echo $document_log->revision_no_8->caption() ?><?php echo ($document_log->revision_no_8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_8->cellAttributes() ?>>
<span id="el_document_log_revision_no_8">
<input type="text" data-table="document_log" data-field="x_revision_no_8" name="x_revision_no_8" id="x_revision_no_8" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_8->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_8->EditValue ?>"<?php echo $document_log->revision_no_8->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_8->Visible) { // direction_8 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_direction_8" class="form-group row">
		<label id="elh_document_log_direction_8" for="x_direction_8" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->direction_8->caption() ?><?php echo ($document_log->direction_8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->direction_8->cellAttributes() ?>>
<span id="el_document_log_direction_8">
<input type="text" data-table="document_log" data-field="x_direction_8" name="x_direction_8" id="x_direction_8" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_8->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_8->EditValue ?>"<?php echo $document_log->direction_8->editAttributes() ?>>
</span>
<?php echo $document_log->direction_8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_8">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_direction_8"><?php echo $document_log->direction_8->caption() ?><?php echo ($document_log->direction_8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_8->cellAttributes() ?>>
<span id="el_document_log_direction_8">
<input type="text" data-table="document_log" data-field="x_direction_8" name="x_direction_8" id="x_direction_8" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_8->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_8->EditValue ?>"<?php echo $document_log->direction_8->editAttributes() ?>>
</span>
<?php echo $document_log->direction_8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_8->Visible) { // planned_date_8 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_planned_date_8" class="form-group row">
		<label id="elh_document_log_planned_date_8" for="x_planned_date_8" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->planned_date_8->caption() ?><?php echo ($document_log->planned_date_8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->planned_date_8->cellAttributes() ?>>
<span id="el_document_log_planned_date_8">
<input type="text" data-table="document_log" data-field="x_planned_date_8" name="x_planned_date_8" id="x_planned_date_8" placeholder="<?php echo HtmlEncode($document_log->planned_date_8->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_8->EditValue ?>"<?php echo $document_log->planned_date_8->editAttributes() ?>>
<?php if (!$document_log->planned_date_8->ReadOnly && !$document_log->planned_date_8->Disabled && !isset($document_log->planned_date_8->EditAttrs["readonly"]) && !isset($document_log->planned_date_8->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_8", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_8">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_8"><?php echo $document_log->planned_date_8->caption() ?><?php echo ($document_log->planned_date_8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_8->cellAttributes() ?>>
<span id="el_document_log_planned_date_8">
<input type="text" data-table="document_log" data-field="x_planned_date_8" name="x_planned_date_8" id="x_planned_date_8" placeholder="<?php echo HtmlEncode($document_log->planned_date_8->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_8->EditValue ?>"<?php echo $document_log->planned_date_8->editAttributes() ?>>
<?php if (!$document_log->planned_date_8->ReadOnly && !$document_log->planned_date_8->Disabled && !isset($document_log->planned_date_8->EditAttrs["readonly"]) && !isset($document_log->planned_date_8->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_8", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_8->Visible) { // transmit_date_8 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_date_8" class="form-group row">
		<label id="elh_document_log_transmit_date_8" for="x_transmit_date_8" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_date_8->caption() ?><?php echo ($document_log->transmit_date_8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_8->cellAttributes() ?>>
<span id="el_document_log_transmit_date_8">
<input type="text" data-table="document_log" data-field="x_transmit_date_8" name="x_transmit_date_8" id="x_transmit_date_8" placeholder="<?php echo HtmlEncode($document_log->transmit_date_8->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_8->EditValue ?>"<?php echo $document_log->transmit_date_8->editAttributes() ?>>
<?php if (!$document_log->transmit_date_8->ReadOnly && !$document_log->transmit_date_8->Disabled && !isset($document_log->transmit_date_8->EditAttrs["readonly"]) && !isset($document_log->transmit_date_8->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_8", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_8">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_8"><?php echo $document_log->transmit_date_8->caption() ?><?php echo ($document_log->transmit_date_8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_8->cellAttributes() ?>>
<span id="el_document_log_transmit_date_8">
<input type="text" data-table="document_log" data-field="x_transmit_date_8" name="x_transmit_date_8" id="x_transmit_date_8" placeholder="<?php echo HtmlEncode($document_log->transmit_date_8->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_8->EditValue ?>"<?php echo $document_log->transmit_date_8->editAttributes() ?>>
<?php if (!$document_log->transmit_date_8->ReadOnly && !$document_log->transmit_date_8->Disabled && !isset($document_log->transmit_date_8->EditAttrs["readonly"]) && !isset($document_log->transmit_date_8->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_8", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_8->Visible) { // transmit_no_8 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_no_8" class="form-group row">
		<label id="elh_document_log_transmit_no_8" for="x_transmit_no_8" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_no_8->caption() ?><?php echo ($document_log->transmit_no_8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_8->cellAttributes() ?>>
<span id="el_document_log_transmit_no_8">
<input type="text" data-table="document_log" data-field="x_transmit_no_8" name="x_transmit_no_8" id="x_transmit_no_8" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_8->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_8->EditValue ?>"<?php echo $document_log->transmit_no_8->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_8">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_8"><?php echo $document_log->transmit_no_8->caption() ?><?php echo ($document_log->transmit_no_8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_8->cellAttributes() ?>>
<span id="el_document_log_transmit_no_8">
<input type="text" data-table="document_log" data-field="x_transmit_no_8" name="x_transmit_no_8" id="x_transmit_no_8" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_8->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_8->EditValue ?>"<?php echo $document_log->transmit_no_8->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_8->Visible) { // approval_status_8 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_approval_status_8" class="form-group row">
		<label id="elh_document_log_approval_status_8" for="x_approval_status_8" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->approval_status_8->caption() ?><?php echo ($document_log->approval_status_8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->approval_status_8->cellAttributes() ?>>
<span id="el_document_log_approval_status_8">
<input type="text" data-table="document_log" data-field="x_approval_status_8" name="x_approval_status_8" id="x_approval_status_8" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_8->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_8->EditValue ?>"<?php echo $document_log->approval_status_8->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_8->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_8">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_8"><?php echo $document_log->approval_status_8->caption() ?><?php echo ($document_log->approval_status_8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_8->cellAttributes() ?>>
<span id="el_document_log_approval_status_8">
<input type="text" data-table="document_log" data-field="x_approval_status_8" name="x_approval_status_8" id="x_approval_status_8" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_8->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_8->EditValue ?>"<?php echo $document_log->approval_status_8->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_8->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_9->Visible) { // submit_no_9 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_submit_no_9" class="form-group row">
		<label id="elh_document_log_submit_no_9" for="x_submit_no_9" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->submit_no_9->caption() ?><?php echo ($document_log->submit_no_9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->submit_no_9->cellAttributes() ?>>
<span id="el_document_log_submit_no_9">
<input type="text" data-table="document_log" data-field="x_submit_no_9" name="x_submit_no_9" id="x_submit_no_9" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_9->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_9->EditValue ?>"<?php echo $document_log->submit_no_9->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_9">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_9"><?php echo $document_log->submit_no_9->caption() ?><?php echo ($document_log->submit_no_9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_9->cellAttributes() ?>>
<span id="el_document_log_submit_no_9">
<input type="text" data-table="document_log" data-field="x_submit_no_9" name="x_submit_no_9" id="x_submit_no_9" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_9->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_9->EditValue ?>"<?php echo $document_log->submit_no_9->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_9->Visible) { // revision_no_9 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_revision_no_9" class="form-group row">
		<label id="elh_document_log_revision_no_9" for="x_revision_no_9" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->revision_no_9->caption() ?><?php echo ($document_log->revision_no_9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->revision_no_9->cellAttributes() ?>>
<span id="el_document_log_revision_no_9">
<input type="text" data-table="document_log" data-field="x_revision_no_9" name="x_revision_no_9" id="x_revision_no_9" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_9->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_9->EditValue ?>"<?php echo $document_log->revision_no_9->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_9">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_9"><?php echo $document_log->revision_no_9->caption() ?><?php echo ($document_log->revision_no_9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_9->cellAttributes() ?>>
<span id="el_document_log_revision_no_9">
<input type="text" data-table="document_log" data-field="x_revision_no_9" name="x_revision_no_9" id="x_revision_no_9" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_9->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_9->EditValue ?>"<?php echo $document_log->revision_no_9->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_9->Visible) { // direction_9 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_direction_9" class="form-group row">
		<label id="elh_document_log_direction_9" for="x_direction_9" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->direction_9->caption() ?><?php echo ($document_log->direction_9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->direction_9->cellAttributes() ?>>
<span id="el_document_log_direction_9">
<input type="text" data-table="document_log" data-field="x_direction_9" name="x_direction_9" id="x_direction_9" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_9->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_9->EditValue ?>"<?php echo $document_log->direction_9->editAttributes() ?>>
</span>
<?php echo $document_log->direction_9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_9">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_direction_9"><?php echo $document_log->direction_9->caption() ?><?php echo ($document_log->direction_9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_9->cellAttributes() ?>>
<span id="el_document_log_direction_9">
<input type="text" data-table="document_log" data-field="x_direction_9" name="x_direction_9" id="x_direction_9" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_9->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_9->EditValue ?>"<?php echo $document_log->direction_9->editAttributes() ?>>
</span>
<?php echo $document_log->direction_9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_9->Visible) { // planned_date_9 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_planned_date_9" class="form-group row">
		<label id="elh_document_log_planned_date_9" for="x_planned_date_9" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->planned_date_9->caption() ?><?php echo ($document_log->planned_date_9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->planned_date_9->cellAttributes() ?>>
<span id="el_document_log_planned_date_9">
<input type="text" data-table="document_log" data-field="x_planned_date_9" name="x_planned_date_9" id="x_planned_date_9" placeholder="<?php echo HtmlEncode($document_log->planned_date_9->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_9->EditValue ?>"<?php echo $document_log->planned_date_9->editAttributes() ?>>
<?php if (!$document_log->planned_date_9->ReadOnly && !$document_log->planned_date_9->Disabled && !isset($document_log->planned_date_9->EditAttrs["readonly"]) && !isset($document_log->planned_date_9->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_9", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_9">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_9"><?php echo $document_log->planned_date_9->caption() ?><?php echo ($document_log->planned_date_9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_9->cellAttributes() ?>>
<span id="el_document_log_planned_date_9">
<input type="text" data-table="document_log" data-field="x_planned_date_9" name="x_planned_date_9" id="x_planned_date_9" placeholder="<?php echo HtmlEncode($document_log->planned_date_9->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_9->EditValue ?>"<?php echo $document_log->planned_date_9->editAttributes() ?>>
<?php if (!$document_log->planned_date_9->ReadOnly && !$document_log->planned_date_9->Disabled && !isset($document_log->planned_date_9->EditAttrs["readonly"]) && !isset($document_log->planned_date_9->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_9", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_9->Visible) { // transmit_date_9 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_date_9" class="form-group row">
		<label id="elh_document_log_transmit_date_9" for="x_transmit_date_9" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_date_9->caption() ?><?php echo ($document_log->transmit_date_9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_9->cellAttributes() ?>>
<span id="el_document_log_transmit_date_9">
<input type="text" data-table="document_log" data-field="x_transmit_date_9" name="x_transmit_date_9" id="x_transmit_date_9" placeholder="<?php echo HtmlEncode($document_log->transmit_date_9->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_9->EditValue ?>"<?php echo $document_log->transmit_date_9->editAttributes() ?>>
<?php if (!$document_log->transmit_date_9->ReadOnly && !$document_log->transmit_date_9->Disabled && !isset($document_log->transmit_date_9->EditAttrs["readonly"]) && !isset($document_log->transmit_date_9->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_9", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_9">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_9"><?php echo $document_log->transmit_date_9->caption() ?><?php echo ($document_log->transmit_date_9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_9->cellAttributes() ?>>
<span id="el_document_log_transmit_date_9">
<input type="text" data-table="document_log" data-field="x_transmit_date_9" name="x_transmit_date_9" id="x_transmit_date_9" placeholder="<?php echo HtmlEncode($document_log->transmit_date_9->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_9->EditValue ?>"<?php echo $document_log->transmit_date_9->editAttributes() ?>>
<?php if (!$document_log->transmit_date_9->ReadOnly && !$document_log->transmit_date_9->Disabled && !isset($document_log->transmit_date_9->EditAttrs["readonly"]) && !isset($document_log->transmit_date_9->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_9", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_9->Visible) { // transmit_no_9 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_no_9" class="form-group row">
		<label id="elh_document_log_transmit_no_9" for="x_transmit_no_9" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_no_9->caption() ?><?php echo ($document_log->transmit_no_9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_9->cellAttributes() ?>>
<span id="el_document_log_transmit_no_9">
<input type="text" data-table="document_log" data-field="x_transmit_no_9" name="x_transmit_no_9" id="x_transmit_no_9" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_9->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_9->EditValue ?>"<?php echo $document_log->transmit_no_9->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_9">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_9"><?php echo $document_log->transmit_no_9->caption() ?><?php echo ($document_log->transmit_no_9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_9->cellAttributes() ?>>
<span id="el_document_log_transmit_no_9">
<input type="text" data-table="document_log" data-field="x_transmit_no_9" name="x_transmit_no_9" id="x_transmit_no_9" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_9->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_9->EditValue ?>"<?php echo $document_log->transmit_no_9->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_9->Visible) { // approval_status_9 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_approval_status_9" class="form-group row">
		<label id="elh_document_log_approval_status_9" for="x_approval_status_9" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->approval_status_9->caption() ?><?php echo ($document_log->approval_status_9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->approval_status_9->cellAttributes() ?>>
<span id="el_document_log_approval_status_9">
<input type="text" data-table="document_log" data-field="x_approval_status_9" name="x_approval_status_9" id="x_approval_status_9" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_9->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_9->EditValue ?>"<?php echo $document_log->approval_status_9->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_9->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_9">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_9"><?php echo $document_log->approval_status_9->caption() ?><?php echo ($document_log->approval_status_9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_9->cellAttributes() ?>>
<span id="el_document_log_approval_status_9">
<input type="text" data-table="document_log" data-field="x_approval_status_9" name="x_approval_status_9" id="x_approval_status_9" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_9->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_9->EditValue ?>"<?php echo $document_log->approval_status_9->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_9->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->submit_no_10->Visible) { // submit_no_10 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_submit_no_10" class="form-group row">
		<label id="elh_document_log_submit_no_10" for="x_submit_no_10" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->submit_no_10->caption() ?><?php echo ($document_log->submit_no_10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->submit_no_10->cellAttributes() ?>>
<span id="el_document_log_submit_no_10">
<input type="text" data-table="document_log" data-field="x_submit_no_10" name="x_submit_no_10" id="x_submit_no_10" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_10->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_10->EditValue ?>"<?php echo $document_log->submit_no_10->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_submit_no_10">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_submit_no_10"><?php echo $document_log->submit_no_10->caption() ?><?php echo ($document_log->submit_no_10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->submit_no_10->cellAttributes() ?>>
<span id="el_document_log_submit_no_10">
<input type="text" data-table="document_log" data-field="x_submit_no_10" name="x_submit_no_10" id="x_submit_no_10" size="30" placeholder="<?php echo HtmlEncode($document_log->submit_no_10->getPlaceHolder()) ?>" value="<?php echo $document_log->submit_no_10->EditValue ?>"<?php echo $document_log->submit_no_10->editAttributes() ?>>
</span>
<?php echo $document_log->submit_no_10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->revision_no_10->Visible) { // revision_no_10 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_revision_no_10" class="form-group row">
		<label id="elh_document_log_revision_no_10" for="x_revision_no_10" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->revision_no_10->caption() ?><?php echo ($document_log->revision_no_10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->revision_no_10->cellAttributes() ?>>
<span id="el_document_log_revision_no_10">
<input type="text" data-table="document_log" data-field="x_revision_no_10" name="x_revision_no_10" id="x_revision_no_10" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_10->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_10->EditValue ?>"<?php echo $document_log->revision_no_10->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_revision_no_10">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_revision_no_10"><?php echo $document_log->revision_no_10->caption() ?><?php echo ($document_log->revision_no_10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->revision_no_10->cellAttributes() ?>>
<span id="el_document_log_revision_no_10">
<input type="text" data-table="document_log" data-field="x_revision_no_10" name="x_revision_no_10" id="x_revision_no_10" size="30" placeholder="<?php echo HtmlEncode($document_log->revision_no_10->getPlaceHolder()) ?>" value="<?php echo $document_log->revision_no_10->EditValue ?>"<?php echo $document_log->revision_no_10->editAttributes() ?>>
</span>
<?php echo $document_log->revision_no_10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->direction_10->Visible) { // direction_10 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_direction_10" class="form-group row">
		<label id="elh_document_log_direction_10" for="x_direction_10" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->direction_10->caption() ?><?php echo ($document_log->direction_10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->direction_10->cellAttributes() ?>>
<span id="el_document_log_direction_10">
<input type="text" data-table="document_log" data-field="x_direction_10" name="x_direction_10" id="x_direction_10" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_10->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_10->EditValue ?>"<?php echo $document_log->direction_10->editAttributes() ?>>
</span>
<?php echo $document_log->direction_10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direction_10">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_direction_10"><?php echo $document_log->direction_10->caption() ?><?php echo ($document_log->direction_10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->direction_10->cellAttributes() ?>>
<span id="el_document_log_direction_10">
<input type="text" data-table="document_log" data-field="x_direction_10" name="x_direction_10" id="x_direction_10" size="30" placeholder="<?php echo HtmlEncode($document_log->direction_10->getPlaceHolder()) ?>" value="<?php echo $document_log->direction_10->EditValue ?>"<?php echo $document_log->direction_10->editAttributes() ?>>
</span>
<?php echo $document_log->direction_10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->planned_date_10->Visible) { // planned_date_10 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_planned_date_10" class="form-group row">
		<label id="elh_document_log_planned_date_10" for="x_planned_date_10" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->planned_date_10->caption() ?><?php echo ($document_log->planned_date_10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->planned_date_10->cellAttributes() ?>>
<span id="el_document_log_planned_date_10">
<input type="text" data-table="document_log" data-field="x_planned_date_10" name="x_planned_date_10" id="x_planned_date_10" placeholder="<?php echo HtmlEncode($document_log->planned_date_10->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_10->EditValue ?>"<?php echo $document_log->planned_date_10->editAttributes() ?>>
<?php if (!$document_log->planned_date_10->ReadOnly && !$document_log->planned_date_10->Disabled && !isset($document_log->planned_date_10->EditAttrs["readonly"]) && !isset($document_log->planned_date_10->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_10", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_planned_date_10">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_planned_date_10"><?php echo $document_log->planned_date_10->caption() ?><?php echo ($document_log->planned_date_10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->planned_date_10->cellAttributes() ?>>
<span id="el_document_log_planned_date_10">
<input type="text" data-table="document_log" data-field="x_planned_date_10" name="x_planned_date_10" id="x_planned_date_10" placeholder="<?php echo HtmlEncode($document_log->planned_date_10->getPlaceHolder()) ?>" value="<?php echo $document_log->planned_date_10->EditValue ?>"<?php echo $document_log->planned_date_10->editAttributes() ?>>
<?php if (!$document_log->planned_date_10->ReadOnly && !$document_log->planned_date_10->Disabled && !isset($document_log->planned_date_10->EditAttrs["readonly"]) && !isset($document_log->planned_date_10->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_planned_date_10", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->planned_date_10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_date_10->Visible) { // transmit_date_10 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_date_10" class="form-group row">
		<label id="elh_document_log_transmit_date_10" for="x_transmit_date_10" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_date_10->caption() ?><?php echo ($document_log->transmit_date_10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_date_10->cellAttributes() ?>>
<span id="el_document_log_transmit_date_10">
<input type="text" data-table="document_log" data-field="x_transmit_date_10" name="x_transmit_date_10" id="x_transmit_date_10" placeholder="<?php echo HtmlEncode($document_log->transmit_date_10->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_10->EditValue ?>"<?php echo $document_log->transmit_date_10->editAttributes() ?>>
<?php if (!$document_log->transmit_date_10->ReadOnly && !$document_log->transmit_date_10->Disabled && !isset($document_log->transmit_date_10->EditAttrs["readonly"]) && !isset($document_log->transmit_date_10->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_10", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_date_10">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_date_10"><?php echo $document_log->transmit_date_10->caption() ?><?php echo ($document_log->transmit_date_10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_date_10->cellAttributes() ?>>
<span id="el_document_log_transmit_date_10">
<input type="text" data-table="document_log" data-field="x_transmit_date_10" name="x_transmit_date_10" id="x_transmit_date_10" placeholder="<?php echo HtmlEncode($document_log->transmit_date_10->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_date_10->EditValue ?>"<?php echo $document_log->transmit_date_10->editAttributes() ?>>
<?php if (!$document_log->transmit_date_10->ReadOnly && !$document_log->transmit_date_10->Disabled && !isset($document_log->transmit_date_10->EditAttrs["readonly"]) && !isset($document_log->transmit_date_10->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_transmit_date_10", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->transmit_date_10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->transmit_no_10->Visible) { // transmit_no_10 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_transmit_no_10" class="form-group row">
		<label id="elh_document_log_transmit_no_10" for="x_transmit_no_10" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->transmit_no_10->caption() ?><?php echo ($document_log->transmit_no_10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->transmit_no_10->cellAttributes() ?>>
<span id="el_document_log_transmit_no_10">
<input type="text" data-table="document_log" data-field="x_transmit_no_10" name="x_transmit_no_10" id="x_transmit_no_10" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_10->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_10->EditValue ?>"<?php echo $document_log->transmit_no_10->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_transmit_no_10">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_transmit_no_10"><?php echo $document_log->transmit_no_10->caption() ?><?php echo ($document_log->transmit_no_10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->transmit_no_10->cellAttributes() ?>>
<span id="el_document_log_transmit_no_10">
<input type="text" data-table="document_log" data-field="x_transmit_no_10" name="x_transmit_no_10" id="x_transmit_no_10" size="30" placeholder="<?php echo HtmlEncode($document_log->transmit_no_10->getPlaceHolder()) ?>" value="<?php echo $document_log->transmit_no_10->EditValue ?>"<?php echo $document_log->transmit_no_10->editAttributes() ?>>
</span>
<?php echo $document_log->transmit_no_10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->approval_status_10->Visible) { // approval_status_10 ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_approval_status_10" class="form-group row">
		<label id="elh_document_log_approval_status_10" for="x_approval_status_10" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->approval_status_10->caption() ?><?php echo ($document_log->approval_status_10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->approval_status_10->cellAttributes() ?>>
<span id="el_document_log_approval_status_10">
<input type="text" data-table="document_log" data-field="x_approval_status_10" name="x_approval_status_10" id="x_approval_status_10" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_10->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_10->EditValue ?>"<?php echo $document_log->approval_status_10->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_10->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_approval_status_10">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_approval_status_10"><?php echo $document_log->approval_status_10->caption() ?><?php echo ($document_log->approval_status_10->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->approval_status_10->cellAttributes() ?>>
<span id="el_document_log_approval_status_10">
<input type="text" data-table="document_log" data-field="x_approval_status_10" name="x_approval_status_10" id="x_approval_status_10" size="30" placeholder="<?php echo HtmlEncode($document_log->approval_status_10->getPlaceHolder()) ?>" value="<?php echo $document_log->approval_status_10->EditValue ?>"<?php echo $document_log->approval_status_10->editAttributes() ?>>
</span>
<?php echo $document_log->approval_status_10->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log->log_updatedon->Visible) { // log_updatedon ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
	<div id="r_log_updatedon" class="form-group row">
		<label id="elh_document_log_log_updatedon" for="x_log_updatedon" class="<?php echo $document_log_edit->LeftColumnClass ?>"><?php echo $document_log->log_updatedon->caption() ?><?php echo ($document_log->log_updatedon->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_log_edit->RightColumnClass ?>"><div<?php echo $document_log->log_updatedon->cellAttributes() ?>>
<span id="el_document_log_log_updatedon">
<input type="text" data-table="document_log" data-field="x_log_updatedon" data-format="115" name="x_log_updatedon" id="x_log_updatedon" placeholder="<?php echo HtmlEncode($document_log->log_updatedon->getPlaceHolder()) ?>" value="<?php echo $document_log->log_updatedon->EditValue ?>"<?php echo $document_log->log_updatedon->editAttributes() ?>>
<?php if (!$document_log->log_updatedon->ReadOnly && !$document_log->log_updatedon->Disabled && !isset($document_log->log_updatedon->EditAttrs["readonly"]) && !isset($document_log->log_updatedon->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_log_updatedon", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->log_updatedon->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_log_updatedon">
		<td class="<?php echo $document_log_edit->TableLeftColumnClass ?>"><span id="elh_document_log_log_updatedon"><?php echo $document_log->log_updatedon->caption() ?><?php echo ($document_log->log_updatedon->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $document_log->log_updatedon->cellAttributes() ?>>
<span id="el_document_log_log_updatedon">
<input type="text" data-table="document_log" data-field="x_log_updatedon" data-format="115" name="x_log_updatedon" id="x_log_updatedon" placeholder="<?php echo HtmlEncode($document_log->log_updatedon->getPlaceHolder()) ?>" value="<?php echo $document_log->log_updatedon->EditValue ?>"<?php echo $document_log->log_updatedon->editAttributes() ?>>
<?php if (!$document_log->log_updatedon->ReadOnly && !$document_log->log_updatedon->Disabled && !isset($document_log->log_updatedon->EditAttrs["readonly"]) && !isset($document_log->log_updatedon->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdocument_logedit", "x_log_updatedon", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $document_log->log_updatedon->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($document_log_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
	<input type="hidden" data-table="document_log" data-field="x_log_id" name="x_log_id" id="x_log_id" value="<?php echo HtmlEncode($document_log->log_id->CurrentValue) ?>">
<?php if (!$document_log_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $document_log_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $document_log_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$document_log_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$document_log_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$document_log_edit->terminate();
?>